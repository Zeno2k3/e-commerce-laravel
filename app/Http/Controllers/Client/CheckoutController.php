<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // 1. Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward' => 'required|string',
            'payment_method' => 'required|in:card,paypal,cod',
            'note' => 'nullable|string',
            'voucher_code' => 'nullable|string' 
        ]);

        try {
            // DB::beginTransaction(); // Moved down

            $user = Auth::user();

            \Log::info('Checkout user', [
                'user' => $user,
                'session_id' => session()->getId()
            ]);

            
            // Enhanced debugging for authentication
            if (!$user) {
                \Illuminate\Support\Facades\Log::error('Checkout Process: User not authenticated. Session ID: ' . request()->session()->getId());
                return response()->json([
                    'status' => 'error',
                    'message' => 'Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.'
                ], 401);
            }

            $cart = Cart::with(['cartItem.variant', 'cartItem.product'])->where('user_id', Auth::id())->first();
            
            if ($cart) {
                 \Illuminate\Support\Facades\Log::info('Checkout Process: Cart ID ' . $cart->cart_id . ' | Items Count: ' . ($cart->cartItem ? $cart->cartItem->count() : 0));
            } else {
                 \Illuminate\Support\Facades\Log::warning('Checkout Process: Cart NOT found for user ' . $user->id);
            }

            if (!$cart || $cart->cartItem->isEmpty()) {
                $debugMsg = '';
                if ($cart) $debugMsg .= '(Lỗi: Tìm thấy giỏ hàng trong DB nhưng không có sản phẩm. Cart ID: '.$cart->cart_id.')';
                else $debugMsg .= ' (Lỗi: Không tìm thấy giỏ hàng trong DB cho User ID: '.$user->id.')';

                return response()->json([
                    'status' => 'error',
                    'message' => $debugMsg . ' Vui lòng kiểm tra lại.'
                ], 400);
            }

            // Start Transaction only after validation
            DB::beginTransaction();

            // Calculate Totals
            $subtotal = 0;
            foreach ($cart->cartItem as $item) {
                $subtotal += $item->total_price;
            }

            $shippingFee = ($request->shipping_method === 'fast') ? 50000 : 30000;
            $discount = 0; // Logic voucher server-side cần được implement sau
            
            // Basic mock voucher logic to match frontend
            if ($request->voucher_code) {
                // TODO: Validate voucher real logic
                $discount = 100000; 
            }

            $total = $subtotal + $shippingFee - $discount;

            // 2. Create Order
            // Lưu ý: bảng 'order' có thể có trường 'status' mặc định là 'pending'
            $order = new Order();
            $order->user_id = Auth::id();
            // $order->address_id = ...; // Nếu dùng bảng address riêng, cần tạo address trước. Ở đây lưu thẳng vào note hoặc bảng customer?
            // Tạm thời lưu địa chỉ full vào note hoặc trường address nếu có. 
            // Model Order hiện tại có: user_id, address_id, voucher_id, order_date, shipping_fee, note, status
            // Chưa có trường address text trực tiếp. Để đơn giản, ta sẽ tạo một bản ghi Address mới hoặc mock nó.
            
            // Giả sử ta cần tạo Address records hoặc lưu tạm vào 'note' vì schema Order yêu cầu address_id?
            // Check lại schema: public function address() { return $this->belongsTo(Address::class...); }
            // Nếu bắt buộc address_id, ta cần tạo Address. 
            // Tuy nhiên, để nhanh chóng đáp ứng yêu cầu "lưu trữ đơn hàng", ta sẽ dùng note để chứa info địa chỉ full nếu chưa có bảng Address hoàn chỉnh logic.
            
            $order->order_date = now();
            $order->shipping_fee = $shippingFee;
            $order->note = "Khách hàng: {$validated['name']} - SĐT: {$validated['phone']}\n" .
                           "Địa chỉ: {$validated['address']}, {$validated['ward']}, {$validated['district']}, {$validated['province']}\n" .
                           "Ghi chú: " . ($request->note ?? '');
            $order->status = 'pending'; // Trạng thái chờ xử lý
            $order->save();

            // 3. Create Order Details
            foreach ($cart->cartItem as $item) {
                OrderDetail::create([
                    'order_id' => $order->order_id,
                    'variant_id' => $item->variant_id, // OrderDetail model cần variant_id
                    'quantity' => $item->quantity,
                    'unit_price' => $item->unit_price,
                    'total_price' => $item->total_price
                ]);
            }

            // PAYPAL PAYMENT PROCESS
            if ($request->payment_method === 'paypal') {
                DB::commit(); // Commit Order Local first
                
                // Convert VND to USD (Approx 24,000)
                $totalUSD = round($total / 24000, 2);

                $provider = new PayPalClient;
                $provider->setApiCredentials(config('paypal'));
                $provider->getAccessToken();

                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('client.paypal.success'),
                        "cancel_url" => route('client.paypal.cancel'),
                    ],
                    "purchase_units" => [
                        0 => [
                            "amount" => [
                                "currency_code" => "USD",
                                "value" => $totalUSD
                            ]
                        ]
                    ]
                ]);

                if (isset($response['id']) && $response['id'] != null) {
                    // Save Order ID to session to update status later
                    session()->put('paypal_order_id', $order->order_id);

                    // Redirect to approve href
                    foreach ($response['links'] as $link) {
                        if ($link['rel'] === 'approve') {
                            return response()->json([
                                'status' => 'success',
                                'message' => 'Chuyển hướng đến PayPal...',
                                'redirect_url' => $link['href']
                            ]);
                        }
                    }
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Lỗi kết nối PayPal.'
                    ], 500);
                }
            }

            // 4. Clear Cart (Only if not Paypal, as Paypal clears after success)
            CartItem::where('cart_id', $cart->cart_id)->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Đặt hàng thành công!',
                'redirect_url' => route('client.cart.success')
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Checkout Error: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    public function paypalSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            
            
            $orderId = session()->get('paypal_order_id');

            session()->forget('paypal_order_id');
            
            $successOrderId = null;
            
            if ($orderId) {
                // Update Order Status
                $order = Order::find($orderId);
                if ($order) {
                    $order->status = 'pending'; // Or 'paid' depending on your logic
                    $order->note .= "\n[PayPal Transaction ID: " . $response['id'] . "]";
                    $order->save();
                    
                    $successOrderId = $order->order_id;
                    
                    // Clear Cart
                    $cart = Cart::where('user_id', $order->user_id)->first();
                    if ($cart) {
                        CartItem::where('cart_id', $cart->cart_id)->delete();
                    }
                }
            }

            return redirect()->route('client.cart.success')
                ->with('success', 'Thanh toán PayPal thành công!')
                ->with('success_order_id', $successOrderId);
        } else {
            return redirect()->route('client.cart.payment')->with('error', 'Thanh toán PayPal không thành công.');
        }
    }

    public function paypalCancel()
    {
        return redirect()->route('client.cart.payment')->with('error', 'Bạn đã hủy thanh toán PayPal.');
    }
}
