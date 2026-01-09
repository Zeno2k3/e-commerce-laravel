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
        $products = Product::with('category')->orderBy('created_at', 'desc')->paginate(10);
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
            'variants' => 'required|array|min:1',
            'variants.*.size' => 'nullable|string|max:50',
            'variants.*.color' => 'nullable|string|max:50',
            'variants.*.material' => 'nullable|string|max:50',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.url_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
        ]);

        \DB::beginTransaction();
        
        try {
            // Create Product
            $product = Product::create([
                'product_name' => $validated['product_name'],
                'description' => $validated['description'] ?? null,
                'category_id' => $validated['category_id'] ?? null,
            ]);

            // Create Variants with image handling
            foreach ($request->variants as $index => $variantData) {
                $imagePath = null;
                
                // Handle image upload if present
                if ($request->hasFile("variants.{$index}.url_image")) {
                    $image = $request->file("variants.{$index}.url_image");
                    $imageName = time() . '_' . $index . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads/products'), $imageName);
                    $imagePath = 'uploads/products/' . $imageName;
                }

                $product->variants()->create([
                    'size' => $variantData['size'] ?? null,
                    'color' => $variantData['color'] ?? null,
                    'material' => $variantData['material'] ?? null,
                    'price' => $variantData['price'],
                    'stock' => $variantData['stock'],
                    'url_image' => $imagePath,
                ]);
            }

            \DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Tạo sản phẩm thành công!');
            
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Lỗi khi tạo sản phẩm: ' . $e->getMessage());
        }
    }

    public function edit(Request $request, Product $product)
    {
        $product->load('variants');
        $categories = Category::all();
        
        // If AJAX request, return JSON
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'product' => $product,
                'variants' => $product->variants,
                'categories' => $categories
            ]);
        }
        
        // Otherwise return view
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:category,category_id',
            'variants' => 'nullable|array',
            'variants.*.id' => 'nullable|integer|exists:product_variant,variant_id',
            'variants.*.size' => 'nullable|string|max:50',
            'variants.*.color' => 'nullable|string|max:50',
            'variants.*.material' => 'nullable|string|max:50',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.url_image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:2048',
        ]);

        \DB::beginTransaction();
        
        try {
            $product->update([
                'product_name' => $validated['product_name'],
                'description' => $validated['description'] ?? null,
                'category_id' => $validated['category_id'] ?? null,
            ]);

            // Handle variants
            if (isset($request->variants)) {
                // Get current variant IDs
                $existingIds = $product->variants->pluck('variant_id')->toArray();
                $submittedIds = [];
                
                foreach ($request->variants as $key => $variantData) {
                    if (isset($variantData['id'])) {
                        $submittedIds[] = $variantData['id'];
                    }
                }

                // Delete removed variants
                $toDelete = array_diff($existingIds, $submittedIds);
                \App\Models\ProductVariant::destroy($toDelete);

                foreach ($request->variants as $index => $variantData) {
                    $imagePath = null;
                    
                    // Handle image upload if present
                    if ($request->hasFile("variants.{$index}.url_image")) {
                        $image = $request->file("variants.{$index}.url_image");
                        $imageName = time() . '_' . $index . '_' . $image->getClientOriginalName();
                        $image->move(public_path('uploads/products'), $imageName);
                        $imagePath = 'uploads/products/' . $imageName;
                    }
                    
                    if (isset($variantData['id'])) {
                        // Update existing
                        $updateData = [
                            'size' => $variantData['size'] ?? null,
                            'color' => $variantData['color'] ?? null,
                            'material' => $variantData['material'] ?? null,
                            'price' => $variantData['price'],
                            'stock' => $variantData['stock'],
                        ];
                        
                        // Only update image if new one was uploaded
                        if ($imagePath) {
                            $updateData['url_image'] = $imagePath;
                        }
                        
                        $product->variants()->where('variant_id', $variantData['id'])->update($updateData);
                    } else {
                        // Create new
                        $product->variants()->create([
                            'size' => $variantData['size'] ?? null,
                            'color' => $variantData['color'] ?? null,
                            'material' => $variantData['material'] ?? null,
                            'price' => $variantData['price'],
                            'stock' => $variantData['stock'],
                            'url_image' => $imagePath,
                        ]);
                    }
                }
            }

            \DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công!');
            
        } catch (\Exception $e) {
            \DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Lỗi khi cập nhật sản phẩm: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xóa thành công!');
    }
}