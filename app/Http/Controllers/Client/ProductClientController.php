<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class ProductClientController extends Controller
{
    protected ProductService $productService;
    protected CategoryService $categoryService;

    public function __construct(ProductService $productService, CategoryService $categoryService)
    {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    /**
     * Base method cho product listing (DRY principle)
     * 
     * @param string $view
     * @param array $filters
     * @return View
     */
    private function productListing(string $view, array $filters = []): View
    {
        // Get paginated products
        $paginatedProducts = $this->productService->getProducts($filters);
        
        // Transform products to component format
        $products = $this->productService->transformCollection($paginatedProducts);
        
        // Get categories with counts
        $categories = $this->categoryService->getCategoriesWithCount();
        
        return view($view, [
            'products' => $products,
            'categories' => $categories,
            'pagination' => $paginatedProducts, // Untuk pagination links
        ]);
    }

    /**
     * Hiển thị danh sách sản phẩm
     * GET /san-pham
     */
    public function index(Request $request): View
    {
        return $this->productListing('client.products.index', $request->all());
    }

    /**
     * Hiển thị sản phẩm nam
     * GET /men
     */
    public function men(Request $request): View
    {
        return $this->productListing('client.products.men', array_merge($request->all(), [
            'product_type' => 'nam'
        ]));
    }

    /**
     * Hiển thị sản phẩm nữ
     * GET /women
     */
    public function women(Request $request): View
    {
        return $this->productListing('client.products.women', array_merge($request->all(), [
            'product_type' => 'nu'
        ]));
    }

    /**
     * Hiển thị phụ kiện
     * GET /phu-kien
     */
    public function accessories(Request $request): View
    {
        return $this->productListing('client.products.phu-kien', array_merge($request->all(), [
            'product_type' => 'phu-kien'
        ]));
    }

    /**
     * Hiển thị sản phẩm sale
     * GET /khuyen-mai
     */
    public function sale(Request $request): View
    {
        return $this->productListing('client.pages.sale', array_merge($request->all(), [
            'on_sale' => true
        ]));
    }

    /**
     * Hiển thị thông tin chi tiết sản phẩm
     * GET /san-pham/{id}
     */
    public function show(int $id): View
    {
        $product = $this->productService->getProductById($id);
        $transformedProduct = $this->productService->transformForDetail($product);
        
        return view('client.products.show', [
            'product' => $transformedProduct
        ]);
    }

    /**
     * API: Get all products
     * GET /api/products
     */
    public function getAll(): JsonResponse
    {
        $products = $this->productService->getProducts(['per_page' => 1000]);
        $transformed = $this->productService->transformCollection($products);
        
        return response()->json([
            'success' => true,
            'data' => $transformed
        ]);
    }
    
    /**
     * API: Get products by category ID
     * GET /api/products/category/{id}
     */
    public function get_product_by_category_id(int $id): JsonResponse
    {
        $paginatedProducts = $this->productService->getProducts([
            'category_id' => $id,
            'per_page' => 10
        ]);
        
        $products = $this->productService->transformCollection($paginatedProducts);
        
        return response()->json([
            'success' => true,
            'data' => [
                'products' => $products,
                'pagination' => [
                    'current_page' => $paginatedProducts->currentPage(),
                    'last_page' => $paginatedProducts->lastPage(),
                    'per_page' => $paginatedProducts->perPage(),
                    'total' => $paginatedProducts->total(),
                ]
            ]
        ]);
    }
}
