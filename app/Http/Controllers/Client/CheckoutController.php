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
            'payment_method' => 'required|in:card,momo,cod',
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
            $order->total_amount = $total; // Save total amount
            $order->discount_amount = $discount; // Save discount amount
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

            // 4. Clear Cart
            CartItem::where('cart_id', $cart->cart_id)->delete();

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Đặt hàng thành công!',
                'redirect_url' => route('client.cart.success')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }
}
