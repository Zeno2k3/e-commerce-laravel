<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductVariant;
class CartController extends Controller
{
    public function index()
    {
        return view('client.cart.index');
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $variant_id = $request->input('variant_id');
        
        $product = Product::findOrFail($product_id);
        $variant = ProductVariant::findOrFail($variant_id);
        
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Sản phẩm đã được thêm!',
                'total_items' => $currentCartCount // Trả về số lượng mới để JS cập nhật
            ]);
        }

        // Nếu JS bị tắt hoặc lỗi, fallback về redirect truyền thống
        return redirect()->back()->with('success', 'Đã thêm sản phẩm!');
    }
}
