<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        
        // Build query with filters
        $query = Product::with(['category', 'variants']);
        
        // Filter by categories
        if ($request->has('categories') && !empty($request->categories)) {
            $query->whereIn('category_id', $request->categories);
        }
        
        // Filter by price range
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
        
        // Search by product name
        if ($request->filled('search')) {
            $query->where('product_name', 'like', '%' . $request->search . '%');
        }
        
        // Sort
        $sort = $request->get('sort', 'newest');
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name':
                $query->orderBy('product_name', 'asc');
                break;
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $products = $query->paginate(12)->withQueryString();
        
        return view('admin.categories.index', compact('categories', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        Category::create($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Tạo danh mục thành công!');
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $category->update($validated);
        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Xóa thành công!');
    }
}
