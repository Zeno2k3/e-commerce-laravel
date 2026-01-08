<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
}
