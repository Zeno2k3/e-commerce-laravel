-- ============================================
-- SQL INSERT DATA FOR E-COMMERCE LARAVEL
-- Run in TablePlus (MySQL)
-- ============================================

-- Disable foreign key checks during insert
SET FOREIGN_KEY_CHECKS = 0;

-- ============================================
-- XÓA DỮ LIỆU CŨ (chạy trước khi insert)
-- ============================================
TRUNCATE TABLE `notification`;
TRUNCATE TABLE `promotion_event`;
TRUNCATE TABLE `import_receipt_detail`;
TRUNCATE TABLE `import_receipt`;
TRUNCATE TABLE `supplier`;
TRUNCATE TABLE `order_detail`;
TRUNCATE TABLE `order`;
TRUNCATE TABLE `cart_item`;
TRUNCATE TABLE `cart`;
TRUNCATE TABLE `product_variant`;
TRUNCATE TABLE `product`;
TRUNCATE TABLE `voucher`;
TRUNCATE TABLE `address`;
TRUNCATE TABLE `category`;
TRUNCATE TABLE `sessions`;
TRUNCATE TABLE `user`;

-- ============================================
-- 1. USER (admin, employee, customers)
-- ============================================
-- Password: password123 (bcrypt hash)
INSERT INTO `user` (`user_id`, `full_name`, `email`, `password`, `phone_number`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin Master', 'admin@gmail.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0901234567', 'admin', 'active', NOW(), NOW()),
(2, 'Nhân Viên A', 'nhanvien1@gmail.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0902345678', 'employee', 'active', NOW(), NOW()),
(3, 'Nhân Viên B', 'nhanvien2@gmail.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0903456789', 'employee', 'active', NOW(), NOW()),
(4, 'Nguyễn Văn Khách', 'khach1@gmail.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0904567890', 'user', 'active', NOW(), NOW()),
(5, 'Trần Thị Hương', 'khach2@gmail.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0905678901', 'user', 'active', NOW(), NOW()),
(6, 'Lê Minh Tuấn', 'khach3@gmail.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0906789012', 'user', 'active', NOW(), NOW()),
(7, 'Phạm Thị Mai', 'khach4@gmail.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0907890123', 'user', 'active', NOW(), NOW()),
(8, 'Hoàng Văn Long', 'khach5@gmail.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0908901234', 'user', 'active', NOW(), NOW());

-- ============================================
-- 2. CATEGORY
-- ============================================
INSERT INTO `category` (`category_id`, `category_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Áo Nam', 'Các loại áo dành cho nam giới', NOW(), NOW()),
(2, 'Áo Nữ', 'Các loại áo dành cho nữ giới', NOW(), NOW()),
(3, 'Quần Nam', 'Các loại quần dành cho nam', NOW(), NOW()),
(4, 'Quần Nữ', 'Các loại quần dành cho nữ', NOW(), NOW()),
(5, 'Phụ Kiện', 'Túi xách, mũ nón, thắt lưng...', NOW(), NOW()),
(6, 'Giày Dép', 'Giày thể thao, giày da, dép...', NOW(), NOW());

-- ============================================
-- 3. VOUCHER
-- ============================================
INSERT INTO `voucher` (`voucher_id`, `voucher_code`, `description`, `quantity`, `discount_percentage`, `max_discount_value`, `usage_conditions`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'WELCOME10', 'Chào mừng thành viên mới', 100, 10, 50000.00, 'Đơn tối thiểu 200.000đ', '2026-01-01 00:00:00', '2026-12-31 23:59:59', 1, NOW(), NOW()),
(2, 'SALE20', 'Giảm 20% toàn bộ sản phẩm', 50, 20, 100000.00, 'Đơn tối thiểu 500.000đ', '2026-01-01 00:00:00', '2026-06-30 23:59:59', 1, NOW(), NOW()),
(3, 'FREESHIP', 'Miễn phí vận chuyển', 200, 0, 30000.00, 'Áp dụng cho mọi đơn hàng', '2026-01-01 00:00:00', '2026-03-31 23:59:59', 1, NOW(), NOW()),
(4, 'VIP30', 'Giảm 30% cho khách VIP', 20, 30, 200000.00, 'Đơn tối thiểu 1.000.000đ', '2026-01-01 00:00:00', '2026-12-31 23:59:59', 1, NOW(), NOW()),
(5, 'FLASH50', 'Flash Sale giảm 50%', 10, 50, 300000.00, 'Đơn tối thiểu 800.000đ', '2026-01-15 00:00:00', '2026-01-16 23:59:59', 0, NOW(), NOW());

-- ============================================
-- 4. ADDRESS
-- ============================================
INSERT INTO `address` (`address_id`, `user_id`, `address`, `created_at`, `updated_at`) VALUES
(1, 4, '123 Nguyễn Huệ, Quận 1, TP.HCM', NOW(), NOW()),
(2, 4, '456 Lê Lợi, Quận 3, TP.HCM', NOW(), NOW()),
(3, 5, '789 Trần Hưng Đạo, Quận 5, TP.HCM', NOW(), NOW()),
(4, 6, '12 Lý Tự Trọng, Quận 1, TP.HCM', NOW(), NOW()),
(5, 7, '34 Phan Đình Phùng, Phú Nhuận, TP.HCM', NOW(), NOW()),
(6, 8, '56 Võ Văn Tần, Quận 3, TP.HCM', NOW(), NOW());

-- ============================================
-- 5. PRODUCT
-- ============================================
INSERT INTO `product` (`product_id`, `category_id`, `product_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Áo Polo Nam Classic', 'Áo polo nam chất liệu cotton mềm mại, thoáng mát', NOW(), NOW()),
(2, 1, 'Áo Sơ Mi Nam Công Sở', 'Áo sơ mi nam form regular fit, chất vải cao cấp', NOW(), NOW()),
(3, 1, 'Áo Thun Nam Basic', 'Áo thun nam cổ tròn, chất cotton 100%', NOW(), NOW()),
(4, 2, 'Áo Kiểu Nữ Vintage', 'Áo kiểu nữ phong cách retro, họa tiết độc đáo', NOW(), NOW()),
(5, 2, 'Áo Sơ Mi Nữ Thanh Lịch', 'Áo sơ mi nữ chất liệu lụa cao cấp', NOW(), NOW()),
(6, 3, 'Quần Jeans Nam Slim Fit', 'Quần jeans nam ống côn, chất denim co giãn', NOW(), NOW()),
(7, 3, 'Quần Kaki Nam', 'Quần kaki nam công sở, chống nhăn', NOW(), NOW()),
(8, 4, 'Quần Culottes Nữ', 'Quần culottes nữ ống rộng, thoáng mát', NOW(), NOW()),
(9, 5, 'Túi Xách Nữ Da Bò', 'Túi xách nữ da bò thật, thiết kế sang trọng', NOW(), NOW()),
(10, 6, 'Giày Thể Thao Nam', 'Giày thể thao nam đế êm, thoáng khí', NOW(), NOW());

-- ============================================
-- 6. PRODUCT_VARIANT
-- ============================================
INSERT INTO `product_variant` (`variant_id`, `product_id`, `size`, `color`, `material`, `price`, `stock`, `url_image`, `created_at`, `updated_at`) VALUES
-- Áo Polo Nam Classic
(1, 1, 'S', 'Trắng', 'Cotton', 299000.00, 50, 'images/products/polo-white-1.jpg', NOW(), NOW()),
(2, 1, 'M', 'Trắng', 'Cotton', 299000.00, 45, 'images/products/polo-white-2.jpg', NOW(), NOW()),
(3, 1, 'L', 'Đen', 'Cotton', 299000.00, 40, 'images/products/polo-black.jpg', NOW(), NOW()),
(4, 1, 'XL', 'Xanh Navy', 'Cotton', 319000.00, 35, 'images/products/polo-navy.jpg', NOW(), NOW()),
-- Áo Sơ Mi Nam
(5, 2, 'M', 'Trắng', 'Cotton Blend', 450000.00, 30, 'images/products/shirt-white.jpg', NOW(), NOW()),
(6, 2, 'L', 'Xanh Nhạt', 'Cotton Blend', 450000.00, 25, 'images/products/shirt-blue.jpg', NOW(), NOW()),
(7, 2, 'XL', 'Hồng', 'Cotton Blend', 470000.00, 20, 'images/products/shirt-pink.jpg', NOW(), NOW()),
-- Áo Thun Nam Basic
(8, 3, 'S', 'Đen', 'Cotton', 199000.00, 100, 'images/products/tshirt-black.jpg', NOW(), NOW()),
(9, 3, 'M', 'Trắng', 'Cotton', 199000.00, 80, 'images/products/tshirt-white.jpg', NOW(), NOW()),
(10, 3, 'L', 'Xám', 'Cotton', 199000.00, 60, 'images/products/tshirt-gray.jpg', NOW(), NOW()),
-- Áo Kiểu Nữ
(11, 4, 'S', 'Hồng', 'Polyester', 350000.00, 30, 'images/products/blouse-pink.jpg', NOW(), NOW()),
(12, 4, 'M', 'Trắng', 'Polyester', 350000.00, 25, 'images/products/blouse-white.jpg', NOW(), NOW()),
-- Áo Sơ Mi Nữ
(13, 5, 'S', 'Trắng', 'Lụa', 550000.00, 20, 'images/products/silk-shirt-white.jpg', NOW(), NOW()),
(14, 5, 'M', 'Đen', 'Lụa', 550000.00, 15, 'images/products/silk-shirt-black.jpg', NOW(), NOW()),
-- Quần Jeans Nam
(15, 6, '30', 'Xanh Đậm', 'Denim', 650000.00, 40, 'images/products/jeans-dark.jpg', NOW(), NOW()),
(16, 6, '32', 'Xanh Nhạt', 'Denim', 650000.00, 35, 'images/products/jeans-light.jpg', NOW(), NOW()),
-- Quần Kaki Nam
(17, 7, '30', 'Be', 'Cotton', 450000.00, 30, 'images/products/khaki-beige.jpg', NOW(), NOW()),
(18, 7, '32', 'Đen', 'Cotton', 450000.00, 25, 'images/products/khaki-black.jpg', NOW(), NOW()),
-- Quần Culottes Nữ
(19, 8, 'S', 'Đen', 'Linen', 400000.00, 20, 'images/products/culottes-black.jpg', NOW(), NOW()),
(20, 8, 'M', 'Trắng', 'Linen', 400000.00, 15, 'images/products/culottes-white.jpg', NOW(), NOW()),
-- Túi Xách Nữ
(21, 9, 'Free Size', 'Nâu', 'Da Bò', 1200000.00, 10, 'images/products/bag-brown.jpg', NOW(), NOW()),
(22, 9, 'Free Size', 'Đen', 'Da Bò', 1200000.00, 8, 'images/products/bag-black.jpg', NOW(), NOW()),
-- Giày Thể Thao Nam
(23, 10, '40', 'Trắng', 'Mesh', 890000.00, 25, 'images/products/sneaker-white.jpg', NOW(), NOW()),
(24, 10, '42', 'Đen', 'Mesh', 890000.00, 20, 'images/products/sneaker-black.jpg', NOW(), NOW()),
(25, 10, '43', 'Xám', 'Mesh', 890000.00, 15, 'images/products/sneaker-gray.jpg', NOW(), NOW());

-- ============================================
-- 7. ORDER
-- ============================================
INSERT INTO `order` (`order_id`, `user_id`, `address_id`, `voucher_id`, `order_date`, `shipping_fee`, `note`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, '2026-01-05 10:30:00', 30000.00, 'Giao giờ hành chính', 'completed', NOW(), NOW()),
(2, 5, 3, NULL, '2026-01-06 14:20:00', 25000.00, NULL, 'completed', NOW(), NOW()),
(3, 6, 4, 2, '2026-01-07 09:15:00', 30000.00, 'Gọi trước khi giao', 'shipping', NOW(), NOW()),
(4, 7, 5, NULL, '2026-01-08 16:45:00', 20000.00, NULL, 'pending', NOW(), NOW()),
(5, 8, 6, 3, '2026-01-09 11:00:00', 0.00, 'Gói quà', 'pending', NOW(), NOW()),
(6, 4, 2, NULL, '2026-01-04 08:30:00', 30000.00, NULL, 'cancelled', NOW(), NOW());

-- ============================================
-- 8. ORDER_DETAIL
-- ============================================
INSERT INTO `order_detail` (`order_id`, `variant_id`, `quantity`, `unit_price`, `total_price`, `created_at`, `updated_at`) VALUES
-- Order 1
(1, 1, 2, 299000.00, 598000.00, NOW(), NOW()),
(1, 8, 1, 199000.00, 199000.00, NOW(), NOW()),
-- Order 2
(2, 11, 1, 350000.00, 350000.00, NOW(), NOW()),
(2, 19, 1, 400000.00, 400000.00, NOW(), NOW()),
-- Order 3
(3, 15, 1, 650000.00, 650000.00, NOW(), NOW()),
(3, 23, 1, 890000.00, 890000.00, NOW(), NOW()),
-- Order 4
(4, 5, 2, 450000.00, 900000.00, NOW(), NOW()),
-- Order 5
(5, 21, 1, 1200000.00, 1200000.00, NOW(), NOW()),
(5, 13, 1, 550000.00, 550000.00, NOW(), NOW()),
-- Order 6
(6, 3, 3, 299000.00, 897000.00, NOW(), NOW());

-- ============================================
-- 9. SUPPLIER
-- ============================================
INSERT INTO `supplier` (`supplier_id`, `name`, `email`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Công Ty May Mặc ABC', 'abc@supplier.com', '0281234567', '100 Khu Công Nghiệp Tân Bình, TP.HCM', 'active', NOW(), NOW()),
(2, 'Xưởng Dệt May XYZ', 'xyz@supplier.com', '0282345678', '200 Khu Công Nghiệp Bình Dương', 'active', NOW(), NOW()),
(3, 'Nhà Cung Cấp Vải 123', 'vai123@supplier.com', '0283456789', '50 Quận Tân Phú, TP.HCM', 'active', NOW(), NOW()),
(4, 'Công Ty Giày Da DEF', 'def@supplier.com', '0284567890', '80 Biên Hòa, Đồng Nai', 'inactive', NOW(), NOW());

-- ============================================
-- 10. IMPORT_RECEIPT
-- ============================================
INSERT INTO `import_receipt` (`receipt_id`, `supplier_id`, `created_by`, `confirmed_by`, `content`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'Nhập áo polo mùa xuân', 100, 'confirmed', NOW(), NOW()),
(2, 2, 2, NULL, 'Nhập quần jeans tháng 1', 50, 'pending', NOW(), NOW()),
(3, 3, 3, 1, 'Nhập vải cotton cao cấp', 200, 'confirmed', NOW(), NOW());

-- ============================================
-- 11. IMPORT_RECEIPT_DETAIL
-- ============================================
INSERT INTO `import_receipt_detail` (`detail_id`, `receipt_id`, `variant_id`, `quantity`, `unit_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 30, 150000.00, NOW(), NOW()),
(2, 1, 2, 30, 150000.00, NOW(), NOW()),
(3, 1, 3, 20, 150000.00, NOW(), NOW()),
(4, 1, 4, 20, 160000.00, NOW(), NOW()),
(5, 2, 15, 25, 350000.00, NOW(), NOW()),
(6, 2, 16, 25, 350000.00, NOW(), NOW()),
(7, 3, 8, 100, 100000.00, NOW(), NOW()),
(8, 3, 9, 50, 100000.00, NOW(), NOW()),
(9, 3, 10, 50, 100000.00, NOW(), NOW());

-- ============================================
-- 12. PROMOTION_EVENT
-- ============================================
INSERT INTO `promotion_event` (`event_id`, `name`, `description`, `discount_percent`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Flash Sale 11/11', 'Siêu sale ngày độc thân', 50, '2026-01-11 00:00:00', '2026-01-11 23:59:59', 'inactive', NOW(), NOW()),
(2, 'Sale Tết 2026', 'Giảm giá mừng Tết Nguyên Đán', 30, '2026-01-20 00:00:00', '2026-02-10 23:59:59', 'active', NOW(), NOW()),
(3, 'Black Friday', 'Siêu giảm giá cuối năm', 40, '2026-11-25 00:00:00', '2026-11-30 23:59:59', 'inactive', NOW(), NOW());

-- ============================================
-- 13. NOTIFICATION
-- ============================================
INSERT INTO `notification` (`notification_id`, `title`, `content`, `type`, `event_id`, `voucher_id`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Chào mừng bạn đến với Shop!', 'Cảm ơn bạn đã đăng ký. Nhận ngay voucher WELCOME10 giảm 10% cho đơn hàng đầu tiên!', 'promotion', NULL, 1, 1, NOW(), NOW()),
(2, 'Sale Tết 2026 đã bắt đầu!', 'Giảm đến 30% tất cả sản phẩm. Nhanh tay mua sắm ngay!', 'promotion', 2, NULL, 1, NOW(), NOW()),
(3, 'Cập nhật chính sách đổi trả', 'Từ ngày 01/01/2026, chúng tôi áp dụng chính sách đổi trả trong 30 ngày.', 'policy', NULL, NULL, 1, NOW(), NOW()),
(4, 'Thông báo bảo trì hệ thống', 'Hệ thống sẽ bảo trì từ 2:00 - 4:00 ngày 15/01/2026.', 'general', NULL, NULL, 2, NOW(), NOW());

-- Re-enable foreign key checks
SET FOREIGN_KEY_CHECKS = 1;

-- ============================================
-- DONE! All data inserted successfully
-- ============================================
-- Login credentials:
-- Admin: admin@gmail.com / password
-- Employee: nhanvien1@gmail.com / password
-- Customer: khach1@gmail.com / password
-- ============================================
