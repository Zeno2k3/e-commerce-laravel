<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductClientController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm
     * GET /products
     */
    public function index(): View
    {
        $products = Product::all();
        return view('client.products.index', compact('products'));
    }

    /**
     * Hiển thị thông tin chi tiết sản phẩm
     * GET /products/{id}
     */
    public function show(int $id): View
    {
        $product = Product::findOrFail($id);

        return view('client.products.show', compact('product'));
    }

    public function getAll(): JsonResponse
    {
        $products = Product::all();
        return response()->json($products);
    }
    public function get_product_by_category_id(int $id): JsonResponse
{
    // 1. Query sản phẩm
    $products = Product::where('category_id', $id)
        // 2. Lọc: Chỉ lấy sản phẩm có ít nhất 1 biến thể còn hàng (stock > 0)
        ->whereHas('variants', function ($query) {
            $query->where('stock', '>', 0);
        })
        // 3. Eager Loading: Lấy kèm biến thể để hiển thị giá
        ->with(['variants' => function ($query) {
            // Sắp xếp biến thể theo giá tăng dần để lấy giá thấp nhất hiển thị ra ngoài
            $query->orderBy('price', 'asc');
            // Chỉ lấy các cột cần thiết để query nhẹ hơn
            $query->select('variant_id', 'product_id', 'size', 'color', 'price', 'stock', 'image'); 
        }])
        ->paginate(10); // Phân trang

    // 4. Trả về JSON
    return response()->json([
        'success' => true,
        'data' => $products
    ]);
}
}
