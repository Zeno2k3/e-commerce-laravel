<?php

use App\Models\Product;
use App\Models\Review;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$p = Product::with('reviews')->find(8);
echo "Product 8: " . ($p ? $p->product_name : 'Not Found') . "\n";
if ($p) {
    echo "Reviews Count: " . $p->reviews->count() . "\n";
    foreach ($p->reviews as $r) {
        echo "Review: Rating=" . $r->rating . ", Content=" . $r->content . "\n";
    }
}

echo "\nAll Reviews:\n";
foreach(Review::all() as $r) {
    echo "Review ID: " . $r->review_id . " - Product ID: " . $r->product_id . " - Rating: " . $r->rating . "\n";
}
