<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller {
    public function index() {
        // Fix lỗi 1055 bằng cách liệt kê cụ thể các cột
        $products = DB::table('product')
            ->leftJoin('category', 'product.category_id', '=', 'category.category_id')
            ->leftJoin('product_variant', 'product.product_id', '=', 'product_variant.product_id')
            ->select(
                'product.product_id', 
                'product.product_name', 
                'product.category_id',
                'category.category_name',
                DB::raw('SUM(product_variant.stock) as total_stock'),
                DB::raw('MIN(product_variant.price) as min_price')
            )
            ->groupBy(
                'product.product_id', 
                'product.product_name', 
                'product.category_id',
                'category.category_name'
            )
            ->get();

        return view('admin.products.index', compact('products'));
    }

    public function create() {
        $categories = DB::table('category')->get();
        return view('admin.products.create', compact('categories'));
    }
}