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
        
        // Calculate Rating (Always use relation count to ensure freshness)
        $reviewsCount = $product->reviews->count();
        $avgRating = $reviewsCount > 0 ? $product->reviews->avg('rating') : 0;

        return [
            'id' => $product->product_id,
            'name' => $product->product_name,
            'image' => $firstVariant?->url_image ?? 'images/no-image.png',
            'price' => $price,
            'old_price' => $oldPrice,
            'discount' => $discount,
            'rating' => $avgRating > 0 ? (float)number_format($avgRating, 1) : 0,
            'reviews_count' => $reviewsCount,
            'reviews' => $reviewsCount, // Map for backward compatibility with component
            'is_favorited' => auth()->check() ? $product->favorites()->where('user_id', auth()->id())->exists() : false,
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
            $q->orderBy('price', 'asc');
        }, 'reviews']);

        // Filter: Product Types (supports array or string)
        if (!empty($filters['product_types'])) {
            $types = is_array($filters['product_types']) ? $filters['product_types'] : [$filters['product_types']];
            $query->whereIn('product_type', $types);
        } elseif (!empty($filters['product_type'])) {
             $query->where('product_type', $filters['product_type']);
        }

        // Filter: Categories (supports array or string)
        if (!empty($filters['categories'])) {
             $cats = is_array($filters['categories']) ? $filters['categories'] : [$filters['categories']];
             $query->whereIn('category_id', $cats);
        } elseif (!empty($filters['category_id'])) {
             $query->where('category_id', $filters['category_id']);
        }
        
        // Filter products on sale
        if (!empty($filters['on_sale'])) {
            $query->where('discount_percentage', '>', 0);
        }

        // Filter: Search
        if (!empty($filters['search'])) {
            $query->where(function($q) use ($filters) {
                $q->where('product_name', 'like', '%' . $filters['search'] . '%')
                  ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        }
        
        // Filter by stock and Price Range
        $query->whereHas('variants', function ($q) use ($filters) {
            $q->where('stock', '>', 0);
            
            if (!empty($filters['price_min'])) {
                $q->where('price', '>=', $filters['price_min']);
            }
            if (!empty($filters['price_max'])) {
                $q->where('price', '<=', $filters['price_max']);
            }
        });

        // Filter: Minimum Rating
        if (isset($filters['min_rating'])) {
            $query->withAvg('reviews', 'rating')
                  ->havingRaw('COALESCE(reviews_avg_rating, 0) >= ?', [$filters['min_rating']]);
        }

        // Sorting
        $sort = $filters['sort'] ?? 'newest';
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price_asc':
                // Sort by the lowest price of variants
                $query->orderBy(
                    \App\Models\ProductVariant::select('price')
                        ->whereColumn('product_variant.product_id', 'product.product_id')
                        ->orderBy('price', 'asc')
                        ->limit(1),
                    'asc'
                );
                break;
            case 'price_desc':
                // Sort by the lowest price of variants (listing price)
                $query->orderBy(
                    \App\Models\ProductVariant::select('price')
                        ->whereColumn('product_variant.product_id', 'product.product_id')
                        ->orderBy('price', 'asc')
                        ->limit(1),
                    'desc'
                );
                break;
            case 'name':
                $query->orderBy('product_name', 'asc');
                break;
            default: // newest
                $query->orderBy('created_at', 'desc');
                break;
        }
        
        $perPage = $filters['per_page'] ?? 12;
        
        return $query->paginate($perPage)->withQueryString();
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
            
        if (empty($gallery)) {
            $gallery = ['images/no-image.png'];
        }
        
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
                    'variant_id' => $v?->variant_id,
                ];
            })
            ->toArray();
        
        // Fetch Real Reviews (Eager loaded in separate query if not already loaded)
        // Accessing via relation: $product->reviews
        // We need to ensuring we load user info: $product->load('reviews.user');
        $product->load(['reviews.user' => function($q) {
            $q->select('user_id', 'full_name');
        }]);

        $reviews = $product->reviews->sortByDesc('created_at')->map(function($review) {
            return [
                'id' => $review->review_id,
                'user_id' => $review->user_id, // Add this for ownership check
                'user' => $review->user->full_name ?? 'Người dùng ẩn danh',
                'rating' => $review->rating,
                'content' => $review->content,
                'time' => $review->created_at->diffForHumans(), // Requires Carbon
            ];
        })->values()->toArray();

        $reviewsCount = $product->reviews->count();
        $avgRating = $reviewsCount > 0 ? $product->reviews->avg('rating') : 0;
        
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
            'rating' => $avgRating > 0 ? number_format($avgRating, 1) : 0,
            'reviews_count' => $reviewsCount,
            'variants' => $product->variants,
            'sku' => 'SKU' . str_pad($product->product_id, 6, '0', STR_PAD_LEFT),
            'specs' => [
                'material' => $firstVariant?->material ?? 'Đang cập nhật',
                'origin' => 'Việt Nam',
                'brand' => 'FlexStyle',
                'style' => 'Modern',
            ],
            'reviews' => $reviews,
            'reviews' => $reviews,
            'related_products' => $relatedProducts,
            'is_favorited' => auth()->check() ? $product->favorites()->where('user_id', auth()->id())->exists() : false,
        ];
    }
}
