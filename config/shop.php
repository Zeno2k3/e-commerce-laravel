<?php

return [
    /**
     * Category IDs mapping
     * Update these values based on your actual category IDs in database
     */
    'categories' => [
        'men' => 1,          // ID của category "Nam"
        'women' => 2,        // ID của category "Nữ"
        'accessories' => 3,  // ID của category "Phụ kiện"
    ],
    
    /**
     * Product settings
     */
    'products' => [
        'per_page' => 12,                    // Số sản phẩm mỗi trang
        'default_image' => 'images/no-image.png',  // Ảnh mặc định khi không có ảnh
    ],
    
    /**
     * Default brand and origin
     */
    'default_brand' => 'FlexStyle',
    'default_origin' => 'Việt Nam',
];
