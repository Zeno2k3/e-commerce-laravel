<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;

class CartController extends Controller
{
    /**
     * Display the user's cart
     */
    public function index()
    {
        // Debug logging
        \Illuminate\Support\Facades\Log::info('Cart Index: User ID = ' . auth()->id());
        
        $cart = Cart::with(['cartItem.product', 'cartItem.variant'])
            ->where('user_id', auth()->id())
            ->first();
        
        if ($cart) {
            \Illuminate\Support\Facades\Log::info('Cart Index: Cart ID = ' . $cart->cart_id . ', Items count = ' . ($cart->cartItem ? $cart->cartItem->count() : 0));
        } else {
            \Illuminate\Support\Facades\Log::warning('Cart Index: No cart found for user ' . auth()->id());
        }
        // Calculate subtotal
        $subtotal = 0;
        $totalItems = 0;
        
        if ($cart && $cart->cartItem) {
            foreach ($cart->cartItem as $item) {
                $subtotal += $item->total_price;
                $totalItems += $item->quantity;
            }
        }
        return view('client.cart.index', [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'totalItems' => $totalItems
        ]);
    }

    /**
     * Show checkout/payment page
     */
    public function checkout()
    {
        // Debug logging
        \Illuminate\Support\Facades\Log::info('Cart Checkout: User ID = ' . auth()->id());
        
        $cart = Cart::with(['cartItem.product', 'cartItem.variant'])
            ->where('user_id', auth()->id())
            ->first();
        
        if ($cart) {
            $itemCount = $cart->cartItem ? $cart->cartItem->count() : 0;
            \Illuminate\Support\Facades\Log::info('Cart Checkout: Cart ID = ' . $cart->cart_id . ', Items count = ' . $itemCount);
        } else {
            \Illuminate\Support\Facades\Log::warning('Cart Checkout: No cart found for user ' . auth()->id());
        }

        // Calculate subtotal
        $subtotal = 0;
        
        if ($cart && $cart->cartItem) {
            foreach ($cart->cartItem as $item) {
                $subtotal += $item->total_price;
            }
        }

        // If cart is empty, redirect back to cart
        if (!$cart || $cart->cartItem->isEmpty()) {
            return redirect()->route('client.cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        return view('client.cart.payment', [
            'cart' => $cart,
            'subtotal' => $subtotal
        ]);
    }
    /**
     * Add product to cart (AJAX)
     */
    public function addToCart(Request $request)
    {
        // Validate input
        $request->validate([
            'product_id' => 'required|exists:product,product_id',
            'variant_id' => 'required|exists:product_variant,variant_id',
            'quantity' => 'nullable|integer|min:1'
        ]);

        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id');
        $quantity = $request->input('quantity', 1);

        // Get product and variant
        $product = Product::findOrFail($productId);
        $variant = ProductVariant::findOrFail($variantId);

        // Check stock
        if ($variant->stock < $quantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không đủ hàng trong kho!'
            ], 400);
        }
        // Find or create cart for user
        $cart = Cart::firstOrCreate(
            ['user_id' => auth()->id()]
        );
        // Check if item already exists in cart
        $cartItem = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $productId)
            ->where('variant_id', $variantId)
            ->first();
        if ($cartItem) {
            // Update existing item
            $newQuantity = $cartItem->quantity + $quantity;
            
            // Check stock for new quantity
            if ($variant->stock < $newQuantity) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Không đủ hàng trong kho!'
                ], 400);
            }

            $cartItem->quantity = $newQuantity;
            $cartItem->total_price = $newQuantity * $variant->price;
            $cartItem->save();
        } else {
            // Create new cart item
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $productId,
                'variant_id' => $variantId,
                'quantity' => $quantity,
                'unit_price' => $variant->price,
                'total_price' => $quantity * $variant->price
            ]);
        }

        // Get total items count
        $totalItems = CartItem::where('cart_id', $cart->cart_id)->sum('quantity');

        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Sản phẩm đã được thêm vào giỏ hàng!',
                'total_items' => $totalItems
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    /**
     * Update cart item quantity (AJAX)
     */
    public function updateQuantity(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_item,cart_item_id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::findOrFail($request->cart_item_id);

        // Security: Verify the cart item belongs to the authenticated user
        if ($cartItem->cart->user_id !== auth()->id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 403);
        }

        // Check stock
        $variant = $cartItem->variant;
        if ($variant->stock < $request->quantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không đủ hàng trong kho!'
            ], 400);
        }

        // Update quantity and total price
        $cartItem->quantity = $request->quantity;
        $cartItem->total_price = $request->quantity * $cartItem->unit_price;
        $cartItem->save();

        // Calculate new cart subtotal
        $subtotal = CartItem::where('cart_id', $cartItem->cart_id)->sum('total_price');
        $totalItems = CartItem::where('cart_id', $cartItem->cart_id)->sum('quantity');

        return response()->json([
            'status' => 'success',
            'item_total' => $cartItem->total_price,
            'cart_subtotal' => $subtotal,
            'total_items' => $totalItems,
            'message' => 'Đã cập nhật số lượng!'
        ]);
    }

    /**
     * Remove item from cart (AJAX)
     */
    public function removeItem(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_item,cart_item_id'
        ]);

        $cartItem = CartItem::findOrFail($request->cart_item_id);

        // Security: Verify the cart item belongs to the authenticated user
        if ($cartItem->cart->user_id !== auth()->id()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized'
            ], 403);
        }

        $cartId = $cartItem->cart_id;
        $cartItem->delete();

        // Calculate new cart subtotal
        $subtotal = CartItem::where('cart_id', $cartId)->sum('total_price');
        $totalItems = CartItem::where('cart_id', $cartId)->sum('quantity');

        return response()->json([
            'status' => 'success',
            'cart_subtotal' => $subtotal,
            'total_items' => $totalItems,
            'message' => 'Đã xóa sản phẩm khỏi giỏ hàng!'
        ]);
    }

    /**
     * Clear all items from cart
     */
    public function clearCart()
    {
        $cart = Cart::where('user_id', auth()->id())->first();

        if ($cart) {
            CartItem::where('cart_id', $cart->cart_id)->delete();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Đã xóa tất cả sản phẩm!'
        ]);
    }


    /**
     * Show success page
     */
    public function success()
    {
        // Get order ID from session (flashed from CheckoutController)
        $orderId = session('success_order_id');
        
        return view('client.cart.success', [
            'orderId' => $orderId
        ]);
    }
}
