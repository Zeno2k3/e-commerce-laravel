<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class CategoryService
{
    /**
     * Get all categories với product count
     * 
     * @return array
     */
    public function getCategoriesWithCount(): array
    {
        $categories = Category::withCount(['products' => function ($query) {
            // Chỉ đếm products còn hàng
            $query->whereHas('variants', function ($q) {
                $q->where('stock', '>', 0);
            });
        }])->get();
        
        // Thêm "Tất cả" vào đầu danh sách
        $allCategory = [
            'name' => 'Tất cả',
            'slug' => 'all',
            'count' => $categories->sum('products_count'),
            'id' => null,
        ];
        
        $categoryList = $categories->map(function ($category) {
            return [
                'name' => $category->category_name,
                'slug' => Str::slug($category->category_name),
                'count' => $category->products_count ?? 0,
                'id' => $category->category_id,
            ];
        })->toArray();
        
        // Thêm "Tất cả" vào đầu
        array_unshift($categoryList, $allCategory);
        
        return $categoryList;
    }

    /**
     * Get category by ID
     * 
     * @param int $id
     * @return Category
     */
    public function getCategoryById(int $id): Category
    {
        return Category::findOrFail($id);
    }

    /**
     * Get category by slug
     * 
     * @param string $slug
     * @return Category|null
     */
    public function getCategoryBySlug(string $slug): ?Category
    {
        return Category::where('category_name', 'like', '%' . str_replace('-', ' ', $slug) . '%')->first();
    }
}
