<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\View\View;

class HomeController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Show the application homepage.
     */
    public function index(): View
    {
        // Fetch "Featured" products - for now, we'll take the 8 newest items.
        // We can easily change this logic later (e.g., sort by views, or specific flag)
        $featuredProducts = $this->productService->getProducts([
            'sort' => 'newest',
            'per_page' => 8,
            'min_rating' => 4
        ]);

        $transformedProducts = $this->productService->transformCollection($featuredProducts);

        return view('client.pages.home', [
            'products' => $transformedProducts
        ]);
    }
}
