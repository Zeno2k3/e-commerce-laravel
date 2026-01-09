<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'variants'])->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:category,category_id',
            'selling_price' => 'required|numeric|min:0',
            'color' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive',
            'images' => 'nullable|array',
        ]);
        $data = $validated;
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                // Store in public/products folder
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage/products'), $filename);
                $imagePaths[] = 'storage/products/' . $filename;
            }
            $data['images'] = $imagePaths; // Store array directly (casted to json in model)
        }
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Tạo sản phẩm thành công!');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:category,category_id',
            'selling_price' => 'required|numeric|min:0',
            'color' => 'nullable|string|max:50',
            'status' => 'required|in:active,inactive',
            'images' => 'nullable|array',
        ]);
        $data = $validated;
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage/products'), $filename);
                $imagePaths[] = 'storage/products/' . $filename;
            }
            $data['images'] = $imagePaths;
        } else {
            // Keep old images if no new ones uploaded
            // Note: If you want to delete images, you need more complex logic.
            // For now, if no file is uploaded, we update other fields but keep images.
            unset($data['images']); 
        }
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xóa thành công!');
    }
}
