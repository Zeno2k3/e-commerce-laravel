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
        // Auto-increment Product Code (PRxx)
        $lastProduct = Product::latest('product_id')->first();
        $nextCode = 'PR01';

        if ($lastProduct && $lastProduct->product_code) {
            // Extract number from PRxx
            if (preg_match('/PR(\d+)/', $lastProduct->product_code, $matches)) {
                $number = intval($matches[1]) + 1;
                $nextCode = 'PR' . str_pad($number, 2, '0', STR_PAD_LEFT);
            }
        }

        $products = Product::with(['category', 'variants'])->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories', 'nextCode'));
    }

    public function create()
    {
        // Auto-increment Product Code (PRxx)
        $lastProduct = Product::latest('product_id')->first();
        $nextCode = 'PR01';

        if ($lastProduct && $lastProduct->product_code) {
            // Extract number from PRxx
            if (preg_match('/PR(\d+)/', $lastProduct->product_code, $matches)) {
                $number = intval($matches[1]) + 1;
                $nextCode = 'PR' . str_pad($number, 2, '0', STR_PAD_LEFT);
            }
        }

        $categories = Category::all();
        return view('admin.products.create', compact('categories', 'nextCode'));
    }

    public function store(Request $request)
    {
        // 1. Validate Product Info
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:category,category_id',
            'product_code' => 'required|string|unique:product,product_code',
            'product_type' => 'required|string',
            'status' => 'nullable|string',
            'variants' => 'required|array|min:1',
            'variants.*.price' => 'required|numeric|min:0',
            'variants.*.stock' => 'required|integer|min:0',
            'variants.*.size' => 'nullable|string|max:50',
            'variants.*.color' => 'nullable|string|max:50',
            'variants.*.material' => 'nullable|string|max:50',
            'variants.*.url_image' => 'nullable|image|max:2048',
        ]);

        // 2. Create Product (wrapped in try-catch)
        try {
            $product = Product::create([
                'product_name' => $validated['product_name'],
                'product_code' => $validated['product_code'],
                'description' => $validated['description'] ?? null,
                'category_id' => $validated['category_id'] ?? null,
                'product_type' => $validated['product_type'],
                'status' => $validated['status'] ?? 'active',
            ]);

            // 3. Create Variants
            foreach ($request->variants as $index => $variantData) {
                $imageUrl = null;
                if ($request->hasFile("variants.$index.url_image")) {
                    $image = $request->file("variants.$index.url_image");
                    $filename = time() . '_' . $index . '_' . $image->getClientOriginalName();
                    $image->move(public_path('storage/products'), $filename);
                    $imageUrl = 'storage/products/' . $filename;
                }

                $product->variants()->create([
                    'size' => $variantData['size'] ?? null,
                    'color' => $variantData['color'] ?? null,
                    'material' => $variantData['material'] ?? null,
                    'price' => $variantData['price'],
                    'stock' => $variantData['stock'],
                    'url_image' => $imageUrl,
                ]);
            }

            return redirect()->route('admin.products.index')->with('success', 'Tạo sản phẩm thành công!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi khi tạo sản phẩm: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $product = Product::with('variants')->findOrFail($id);
        if (request()->wantsJson()) {
            return response()->json([
                'product' => $product,
                'variants' => $product->variants
            ]);
        }
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:category,category_id',
            'product_type' => 'required|string',
            'status' => 'nullable|string',
            'variants' => 'nullable|array',
        ]);

        // 1. Update Product
        $product->update([
            'product_name' => $validated['product_name'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'] ?? null,
            'product_type' => $validated['product_type'],
            'status' => $validated['status'] ?? 'active',
        ]);

        // 2. Sync Variants
        // Strategy: 
        // - Loop through submitted variants
        // - If has ID, update
        // - If no ID, create
        // - (Optional) Delete missing variants? For now user only deletes manually in UI which sends specific delete request? 
        //   Actually, in the UI if user removes a row, it's not sent here. So we should probably find existing variants and delete those not in the request? 
        //   For simplicity and safety, let's just update/create for now. If user deleted in UI, that variance won't be sent. 
        //   If we want "Sync", we need to know all IDs sent.

        if ($request->has('variants')) {
            $sentVariantIds = [];

            foreach ($request->variants as $index => $variantData) {
                $imageUrl = null;
                // Handle Image Upload
                if ($request->hasFile("variants.$index.url_image")) {
                    $image = $request->file("variants.$index.url_image");
                    $filename = time() . '_' . $index . '_' . $image->getClientOriginalName();
                    $image->move(public_path('storage/products'), $filename);
                    $imageUrl = 'storage/products/' . $filename;
                }

                if (isset($variantData['id'])) {
                    $variant = $product->variants()->find($variantData['id']);
                    if ($variant) {
                        $updateData = [
                            'size' => $variantData['size'] ?? null,
                            'color' => $variantData['color'] ?? null,
                            'material' => $variantData['material'] ?? null,
                            'price' => $variantData['price'],
                            'stock' => $variantData['stock'],
                        ];
                        if ($imageUrl) {
                            $updateData['url_image'] = $imageUrl;
                        }
                        $variant->update($updateData);
                        $sentVariantIds[] = $variantData['id'];
                    }
                } else {
                    // Create new
                    $newVariant = $product->variants()->create([
                        'size' => $variantData['size'] ?? null,
                        'color' => $variantData['color'] ?? null,
                        'material' => $variantData['material'] ?? null,
                        'price' => $variantData['price'],
                        'stock' => $variantData['stock'],
                        'url_image' => $imageUrl,
                    ]);
                    $sentVariantIds[] = $newVariant->variant_id;
                }
            }
            
            // Delete variants not in the request
            // $product->variants()->whereNotIn('variant_id', $sentVariantIds)->delete(); 
            // Uncomment above line if we want to delete variants removed from UI
            // But let's act based on user intent - assuming UI removal means delete:
             $product->variants()->whereNotIn('variant_id', $sentVariantIds)->delete(); 
        }

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Product $product)
    {
        $product->variants()->delete();
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xóa thành công!');
    }
}
