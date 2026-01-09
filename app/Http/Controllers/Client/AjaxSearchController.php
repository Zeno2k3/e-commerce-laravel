<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class AjaxSearchController extends Controller
{
    /**
     * Handle Ajax search request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $keyword = $request->input('keyword');

        if (empty($keyword)) {
            return response()->json([
                'categories' => [],
                'products' => []
            ]);
        }

        // Search Categories (limit 3)
        $categories = Category::where('category_name', 'like', "%{$keyword}%")
            ->take(3)
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->category_name,
                    'url' => route('client.products.get_product_by_category_id', ['category_id' => $category->category_id]), // Assuming this route maps to filtering by category
                ];
            });

        // Search Products (limit 5)
        $products = Product::with('variants')
            ->where('product_name', 'like', "%{$keyword}%")
            ->take(5)
            ->get()
            ->map(function ($product) {
                $firstVariant = $product->variants->sortBy('price')->first();
                return [
                    'name' => $product->product_name,
                    'url' => route('client.products.show', ['id' => $product->product_id]),
                    'image' => asset($firstVariant?->url_image ?? 'images/no-image.png'),
                    'price' => number_format($firstVariant?->price ?? 0) . 'đ',
                    'original_price' => $product->old_price ? number_format($product->old_price) . 'đ' : null,
                ];
            });

        return response()->json([
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
