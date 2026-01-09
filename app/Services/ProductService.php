<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProductService
{
    /**
     * Transform product từ database sang format component
     * 
     * @param Product $product
     * @return array
     */
    public function transformForCard($product): array
    {
        // Lấy variant đầu tiên hoặc variant có giá thấp nhất
        $firstVariant = $product->variants->sortBy('price')->first();
        
        // Tính giá hiển thị
        $price = $firstVariant?->price ?? 0;
        
        // Nếu product có old_price thì dùng, không thì lấy từ variant
        $oldPrice = $product->old_price;
        
        // Lấy discount từ product (có thể tính từ old_price và variant price)
        $discount = $product->discount;
        
        return [
            'id' => $product->product_id,
            'name' => $product->product_name,
            'image' => $firstVariant?->url_image ?? 'images/no-image.png',
            'price' => $price,
            'old_price' => $oldPrice,
            'discount' => $discount,
            'rating' => $product->rating ?? 0,
            'reviews' => $product->reviews_count ?? 0,
        ];
    }

    /**
     * Get products với filters và pagination
     * 
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getProducts(array $filters = []): LengthAwarePaginator
    {
        $query = Product::with(['variants' => function ($q) {
            // Sắp xếp variants theo giá để lấy giá thấp nhất
            $q->orderBy('price', 'asc');
        }])->orderBy('created_at', 'desc');
        
        // Filter by product_type (nam, nu, phu-kien)
        if (!empty($filters['product_type'])) {
            $query->where('product_type', $filters['product_type']);
        }
        
        // Filter by category (optional - for sub-categories like Áo khoác, Quần...)
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }
        
        // Filter products on sale
        if (!empty($filters['on_sale'])) {
            $query->where('discount_percentage', '>', 0);
        }
        
        // Filter by stock (chỉ lấy sản phẩm có variant còn hàng)
        $query->whereHas('variants', function ($q) {
            $q->where('stock', '>', 0);
        });
        
        $perPage = $filters['per_page'] ?? 12;
        
        return $query->paginate($perPage);
    }

    /**
     * Transform collection of products
     * 
     * @param mixed $products
     * @return Collection
     */
    public function transformCollection($products): Collection
    {
        $items = $products instanceof LengthAwarePaginator 
            ? $products->getCollection() 
            : $products;
            
        return $items->map(function ($product) {
            return $this->transformForCard($product);
        });
    }

    /**
     * Get product by ID với all relationships
     * 
     * @param int $id
     * @return Product
     */
    public function getProductById(int $id): Product
    {
        return Product::with(['variants', 'category'])->findOrFail($id);
    }

    /**
     * Transform product for detail page
     * 
     * @param Product $product
     * @return array
     */
    public function transformForDetail(Product $product): array
    {
        $firstVariant = $product->variants->first();
        
        // Get all variant images for gallery
        $gallery = $product->variants
            ->pluck('url_image')
            ->filter()
            ->take(4)
            ->toArray();
            
        // If no variant images, use placeholder
        if (empty($gallery)) {
            $gallery = ['images/no-image.png'];
        }
        
        // Get related products (same category, different product, limit 4)
        $relatedProducts = Product::with('variants')
            ->where('category_id', $product->category_id)
            ->where('product_id', '!=', $product->product_id)
            ->where('product_type', $product->product_type)
            ->whereHas('variants', function($q) {
                $q->where('stock', '>', 0);
            })
            ->take(4)
            ->get()
            ->map(function($p) {
                $v = $p->variants->first();
                return [
                    'id' => $p->product_id,
                    'name' => $p->product_name,
                    'price' => $v?->price ?? 0,
                    'image' => $v?->url_image ?? 'images/no-image.png',
                    'discount' => $p->discount,
                ];
            })
            ->toArray();
        
        // TODO: Implement Review model
        // For now, return empty reviews array
        $reviews = [];
        
        return [
            'id' => $product->product_id,
            'name' => $product->product_name,
            'description' => $product->description ?? 'Chưa có mô tả cho sản phẩm này.',
            'category' => $product->category?->category_name ?? '',
            'category_id' => $product->category_id,
            'image' => $firstVariant?->url_image ?? 'images/no-image.png',
            'gallery' => $gallery,
            'price' => $firstVariant?->price ?? 0,
            'old_price' => $product->old_price,
            'discount' => $product->discount,
            'rating' => $product->rating ?? 0,
            'reviews_count' => $product->reviews_count ?? 0,
            'variants' => $product->variants,
            'sku' => 'SKU' . str_pad($product->product_id, 6, '0', STR_PAD_LEFT), // Generate SKU from ID
            'specs' => [
                'material' => $firstVariant?->material ?? 'Đang cập nhật',
                'origin' => 'Việt Nam',
                'brand' => 'FlexStyle',
                'style' => 'Modern',
            ],
            'reviews' => $reviews,
            'related_products' => $relatedProducts,
        ];
    }
}
