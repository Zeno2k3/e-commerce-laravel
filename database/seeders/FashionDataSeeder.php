<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;

class FashionDataSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Category::truncate();
        Product::truncate();
        ProductVariant::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // 1. Tạo Danh Mục (Categories)
        $categories = [
            ['name' => 'Áo Nam', 'desc' => 'Thời trang áo nam đa dạng'],
            ['name' => 'Quần Nam', 'desc' => 'Quần nam phong cách'],
            ['name' => 'Đầm Nữ', 'desc' => 'Đầm váy thời trang cho nữ'],
            ['name' => 'Áo Nữ', 'desc' => 'Áo kiểu, áo thun nữ'],
            ['name' => 'Giày Dép', 'desc' => 'Giày sneaker, giày tây, cao gót'],
            ['name' => 'Phụ Kiện', 'desc' => 'Túi xách, thắt lưng, mũ nón'],
        ];

        $catIds = [];
        foreach ($categories as $c) {
            $cat = Category::create([
                'category_name' => $c['name'],
                'description' => $c['desc']
            ]);
            $catIds[$c['name']] = $cat->category_id;
        }

        // 2. Tạo Sản Phẩm (Products) & Biến Thể (Variants)
        $products = [
            // --- NAM ---
            [
                'name' => 'Áo Thun Basic Cotton',
                'code' => 'PR01',
                'cat' => 'Áo Nam',
                'type' => 'nam',
                'price' => 150000,
                'desc' => 'Áo thun trơn basic chất liệu cotton 100% thoáng mát.',
                'variants' => [
                    ['size' => 'M', 'color' => 'Trắng', 'stock' => 50],
                    ['size' => 'L', 'color' => 'Trắng', 'stock' => 50],
                    ['size' => 'XL', 'color' => 'Đen', 'stock' => 30],
                ]
            ],
            [
                'name' => 'Áo Sơ Mi Oxford',
                'code' => 'PR02',
                'cat' => 'Áo Nam',
                'type' => 'nam',
                'price' => 350000,
                'desc' => 'Áo sơ mi vải Oxford đứng form, lịch lãm công sở.',
                'variants' => [
                    ['size' => '39', 'color' => 'Xanh Nhạt', 'stock' => 20],
                    ['size' => '40', 'color' => 'Xanh Nhạt', 'stock' => 20],
                    ['size' => '41', 'color' => 'Trắng', 'stock' => 15],
                ]
            ],
            [
                'name' => 'Quần Jean Slim Fit',
                'code' => 'PR03',
                'cat' => 'Quần Nam',
                'type' => 'nam',
                'price' => 450000,
                'desc' => 'Quần Jean dáng ôm vừa vặn, co giãn nhẹ thoải mái.',
                'variants' => [
                    ['size' => '29', 'color' => 'Xanh Đậm', 'stock' => 40],
                    ['size' => '30', 'color' => 'Xanh Đậm', 'stock' => 40],
                    ['size' => '31', 'color' => 'Đen', 'stock' => 30],
                ]
            ],

            // --- NỮ ---
            [
                'name' => 'Đầm Hoa Nhí Vintage',
                'code' => 'PR04',
                'cat' => 'Đầm Nữ',
                'type' => 'nu',
                'price' => 320000,
                'desc' => 'Đầm voan họa tiết hoa nhí phong cách vintage nhẹ nhàng.',
                'variants' => [
                    ['size' => 'S', 'color' => 'Hồng Nhạt', 'stock' => 20],
                    ['size' => 'M', 'color' => 'Hồng Nhạt', 'stock' => 25],
                    ['size' => 'L', 'color' => 'Xanh Pastel', 'stock' => 10],
                ]
            ],
            [
                'name' => 'Áo Croptop Tay Phồng',
                'code' => 'PR05',
                'cat' => 'Áo Nữ',
                'type' => 'nu',
                'price' => 180000,
                'desc' => 'Áo kiểu croptop tay phồng xinh xắn, năng động.',
                'variants' => [
                    ['size' => 'Free', 'color' => 'Trắng', 'stock' => 100],
                    ['size' => 'Free', 'color' => 'Vàng', 'stock' => 50],
                ]
            ],
            [
                'name' => 'Chân Váy Xếp Ly Dài',
                'code' => 'PR06',
                'cat' => 'Đầm Nữ', // Or create a separate category if wanted, reusing 'Đầm Nữ' for demo
                'type' => 'nu',
                'price' => 250000,
                'desc' => 'Chân váy xếp ly dáng dài thanh lịch.',
                'variants' => [
                    ['size' => 'S', 'color' => 'Nâu Tây', 'stock' => 30],
                    ['size' => 'M', 'color' => 'Đen', 'stock' => 40],
                ]
            ],

            // --- PHỤ KIỆN ---
            [
                'name' => 'Giày Sneaker Chunky',
                'code' => 'PR07',
                'cat' => 'Giày Dép',
                'type' => 'phu-kien',
                'price' => 550000,
                'desc' => 'Giày sneaker đế độn phong cách Hàn Quốc.',
                'variants' => [
                    ['size' => '36', 'color' => 'Trắng/Kem', 'stock' => 15],
                    ['size' => '37', 'color' => 'Trắng/Kem', 'stock' => 15],
                    ['size' => '38', 'color' => 'Trắng/Kem', 'stock' => 10],
                ]
            ],
            [
                'name' => 'Túi Đeo Chéo Canvas',
                'code' => 'PR08',
                'cat' => 'Phụ Kiện',
                'type' => 'phu-kien',
                'price' => 120000,
                'desc' => 'Túi vải canvas đeo chéo tiện lợi đi học đi chơi.',
                'variants' => [
                    ['size' => 'One Size', 'color' => 'Be', 'stock' => 80],
                    ['size' => 'One Size', 'color' => 'Đen', 'stock' => 60],
                ]
            ],
        ];

        foreach ($products as $p) {
            $product = Product::create([
                'product_name' => $p['name'],
                'product_code' => $p['code'],
                'description' => $p['desc'],
                'category_id' => $catIds[$p['cat']] ?? null,
                'product_type' => $p['type'],
                'status' => 'active',
                'rating' => 5.0,
                'reviews_count' => 0,
                'discount_percentage' => 0,
                'old_price' => 0,
            ]);

            foreach ($p['variants'] as $v) {
                ProductVariant::create([
                    'product_id' => $product->product_id,
                    'size' => $v['size'],
                    'color' => $v['color'],
                    'price' => $p['price'], // Simple: all variants same price
                    'stock' => $v['stock'],
                    'url_image' => null // No image for now, or use placeholder if desired
                ]);
            }
        }
    }
}
