# 🛒 Laravel E-Commerce

Dự án website thương mại điện tử được xây dựng bằng Laravel 11 với giao diện hiện đại sử dụng TailwindCSS v4.

## 📌 Tính năng chính

### 🛍️ Khách hàng (Client)
- Trang chủ với banner, sản phẩm nổi bật, danh mục
- Danh sách sản phẩm với bộ lọc và sắp xếp
- Chi tiết sản phẩm với đánh giá và sản phẩm liên quan
- Giỏ hàng và thanh toán
- Quản lý tài khoản và lịch sử đơn hàng
- Trang thông tin: Giới thiệu, Liên hệ, Chính sách

### 🔐 Quản trị (Admin)
- Quản lý nhân viên
- Quản lý sản phẩm
- Quản lý đơn hàng
- Quản lý danh mục
- Quản lý voucher/khuyến mãi
- Quản lý khách hàng

---

## 🚀 Cài đặt

### 1. Clone repository

```bash
git clone <repository-url> <folder-name>
cd <folder-name>
```

### 2. Cài đặt dependencies

```bash
composer install
npm install
```

### 3. Cấu hình môi trường

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Cấu hình database

Chỉnh sửa file `.env` với thông tin database của bạn:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecommerce_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migrate và seed database

```bash
php artisan migrate
php artisan db:seed
```

### 6. Build assets và chạy server

```bash
npm run build
npm run dev          # Development với hot reload
php artisan serve    # Chạy server Laravel
```

---

## 📁 Cấu trúc thư mục Resources

```
resources/
├── css/
│   ├── _base.css              # Styles chung (Tailwind imports, @source)
│   ├── admin.css              # Styles riêng cho Admin
│   └── client.css             # Styles riêng cho Client + Font
│
├── js/
│   ├── admin.js               # JavaScript cho Admin
│   ├── client.js              # JavaScript cho Client
│   ├── bootstrap.js           # Axios config
│   └── client/
│       └── cart.js            # Logic giỏ hàng
│
└── views/
    ├── admin/                 # Giao diện Admin
    │   ├── layouts/
    │   │   ├── app.blade.php          # Layout chính Admin
    │   │   └── partials/
    │   │       ├── sidebar.blade.php
    │   │       ├── navbar.blade.php
    │   │       └── footer.blade.php
    │   ├── dashboard.blade.php
    │   ├── employees/
    │   ├── products/
    │   ├── orders/
    │   ├── categories/
    │   ├── vouchers/
    │   └── customers/
    │
    ├── client/                # Giao diện Client
    │   ├── layouts/
    │   │   ├── app.blade.php          # Layout chính Client
    │   │   ├── voucher.blade.php
    │   │   └── partials/
    │   │       ├── header.blade.php
    │   │       ├── navbar.blade.php
    │   │       └── footer.blade.php
    │   ├── pages/                     # Các trang tĩnh
    │   │   ├── home.blade.php
    │   │   ├── about.blade.php
    │   │   ├── contact.blade.php
    │   │   ├── sale.blade.php
    │   │   ├── privacy-policy.blade.php
    │   │   ├── shipping-policy.blade.php
    │   │   └── return-policy.blade.php
    │   ├── products/                  # Trang sản phẩm
    │   │   ├── index.blade.php
    │   │   ├── show.blade.php
    │   │   ├── men.blade.php
    │   │   ├── women.blade.php
    │   │   ├── phu-kien.blade.php
    │   │   └── search.blade.php
    │   ├── carts/                     # Giỏ hàng
    │   │   ├── index.blade.php
    │   │   ├── payment.blade.php
    │   │   └── success.blade.php
    │   └── account/                   # Tài khoản
    │       ├── profile.blade.php
    │       └── orders.blade.php
    │
    ├── auth/                  # Xác thực
    │   ├── layout.blade.php
    │   ├── login.blade.php
    │   └── register.blade.php
    │
    └── components/            # Blade Components tái sử dụng
        ├── product-card.blade.php
        ├── alert.blade.php
        ├── breadcrumb.blade.php
        ├── button.blade.php
        ├── pagination.blade.php
        │
        ├── admin/             # Components cho Admin
        │   ├── card.blade.php
        │   ├── form-modal.blade.php
        │   ├── input.blade.php
        │   ├── select.blade.php
        │   ├── status-badge.blade.php
        │   └── action-buttons.blade.php
        │
        └── client/            # Components cho Client
            ├── page-header.blade.php      # Header section (tag, title, highlight)
            ├── category-filter.blade.php  # Buttons lọc danh mục
            ├── sort-bar.blade.php         # Thanh sắp xếp
            ├── pagination.blade.php       # Phân trang
            ├── features-bar.blade.php     # Cam kết dịch vụ
            ├── newsletter.blade.php       # Form đăng ký nhận tin
            ├── cta-section.blade.php      # Call-to-action section
            ├── contact-card.blade.php     # Card thông tin liên hệ
            ├── faq-item.blade.php         # Item FAQ
            ├── info-card.blade.php        # Card thông tin
            └── rights-card.blade.php      # Card quyền lợi
```

---

## 🎨 Components Guide

### Client Components

Các component Client được thiết kế với tính năng tùy chỉnh màu sắc (purple, pink, amber, red, blue):

```blade
{{-- Page Header với màu tím --}}
<x-client.page-header 
    icon="fa-solid fa-star"
    tag="VỀ CHÚNG TÔI"
    title="Câu Chuyện Của"
    highlight="LaravelShop"
    description="Mô tả ngắn"
    color="purple" />

{{-- Category Filter với màu hồng --}}
<x-client.category-filter 
    :categories="$categories" 
    activeCategory="all"
    color="pink" />

{{-- Sort Bar --}}
<x-client.sort-bar 
    title="Sản phẩm"
    :count="10"
    :sortOptions="['Nổi bật', 'Giá thấp', 'Giá cao']"
    :activeSort="0"
    color="purple" />

{{-- Pagination --}}
<x-client.pagination 
    :currentPage="1" 
    :totalPages="5"
    color="purple" />

{{-- Features Bar --}}
<x-client.features-bar />

{{-- Newsletter --}}
<x-client.newsletter />

{{-- CTA Section --}}
<x-client.cta-section 
    title="Tiêu đề"
    description="Mô tả"
    :buttons="[
        ['text' => 'Khám Phá', 'url' => '/products', 'primary' => true],
        ['text' => 'Liên Hệ', 'url' => '/contact', 'primary' => false]
    ]" />
```

### Admin Components

```blade
{{-- Form Modal --}}
<x-admin.form-modal 
    id="createModal" 
    title="Tạo mới" 
    action="{{ route('admin.items.store') }}" 
    method="POST">
    <x-admin.input name="name" label="Tên" required />
    <x-admin.select name="status" label="Trạng thái" :options="['1' => 'Active', '0' => 'Inactive']" />
</x-admin.form-modal>

{{-- Status Badge --}}
<x-admin.status-badge :status="$item->status" />

{{-- Action Buttons --}}
<x-admin.action-buttons :item="$item" edit-modal="editModal" />
```

---

## 🛠️ Tech Stack

- **Backend:** Laravel 11
- **Frontend:** Blade Templates, TailwindCSS v4
- **Icons:** Font Awesome 6
- **JavaScript:** Alpine.js (cho interactions)
- **Database:** MySQL

---

## 📝 License

MIT License

---

## 👥 Team

- Developed by **LaravelShop Team**
