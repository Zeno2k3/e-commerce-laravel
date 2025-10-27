## SETUP

#### Clone github

```bash
git clone url <name-folder>
cd name-folder

```

#### Download packe

```bash
composer i
npm i
```

#### build tallwindCSS

```bash
run build
npm run dev
```

#### Generate key

```bash
cp .env.example .env
php artisan key:generate
php artisan serve
```

## Folder detail fontend

```bash
resources/
├── lang/                                  # File đa ngôn ngữ (nếu cần)
│   ├── vi/                                # Ngôn ngữ tiếng Việt
│   │   ├── messages.php                   # Chuỗi văn bản dùng chung
│   │   └── auth.php                       # Chuỗi xác thực dùng chung
├── views/                                 # Blade templates
│   ├── admin/                             # Giao diện admin
│   │   ├── dashboard.blade.php            # Trang tổng quan (dashboard) của admin
│   │   ├── products/                      # Quản lý sản phẩm
│   │   │   ├── index.blade.php            # Hiển thị danh sách sản phẩm ở trang admin để quản lý (CRUD).
│   │   │   ├── form.blade.php             # Form chung cho create/edit
│   │   │   └── show.blade.php             # Hiển thị chi tiết một sản phẩm ở trang admin.
│   │   ├── orders/                        # Quản lý đơn hàng
│   │   │   ├── index.blade.php            # Hiển thị danh sách đơn hàng ở trang admin để quản lý.
│   │   │   └── show.blade.php             # Hiển thị chi tiết một đơn hàng ở trang admin.
│   │   └── layouts/                       # Layout admin
│   │       ├── app.blade.php              # Layout chính admin, chung cho tất cả các trang admin.
│   │       └── partials/                  # Thành phần tái sử dụng
│   │           ├── sidebar.blade.php      # Thanh điều hướng bên trái (sidebar) cho giao diện admin.
│   │           └── navbar.blade.php       # Thanh điều hướng trên cùng (navbar) cho giao diện admin.
│   ├── client/                            # Giao diện người dùng
│   │   ├── home.blade.php                 # Trang chủ của trang web bán hàng.
│   │   ├── products/                      # Sản phẩm
│   │   │   ├── index.blade.php            # Hiển thị danh sách sản phẩm cho người dùng.
│   │   │   ├── show.blade.php             # Hiển thị chi tiết một sản phẩm cho người dùng.
│   │   │   └── search.blade.php           # Hiển thị kết quả tìm kiếm sản phẩm.
│   │   ├── cart/                          # Giỏ hàng
│   │   │   ├── index.blade.php            # Hiển thị giỏ hàng của người dùng.
│   │   │   └── checkout.blade.php         # Hiển thị form thanh toán để hoàn tất đơn hàng.
│   │   ├── account/                       # Tài khoản người dùng
│   │   │   ├── profile.blade.php          # Hiển thị và chỉnh sửa thông tin cá nhân của người dùng.
│   │   │   └── orders.blade.php           # Hiển thị lịch sử đơn hàng của người dùng.
│   │   └── layouts/                       # Layout frontend
│   │       ├── app.blade.php              # Layout chính client, cấu trúc chung cho các trang người dùng.
│   │       ├── partials/                  # Thành phần tái sử dụng
│   │       │   ├── header.blade.php       # Phần đầu trang (header)
│   │       │   ├── footer.blade.php       # Phần chân trang (footer)
│   │       │   └── navbar.blade.php       # Thanh điều hướng (navbar)
│   ├── auth/                              # Giao diện xác thực
│   │   ├── login.blade.php                # Form đăng nhập cho người dùng
│   │   ├── register.blade.php             # Form đăng ký tài khoản mới
│   │   └── password/                      # Reset mật khẩu
│   │       ├── forgot.blade.php           # Form yêu cầu reset mật khẩu.
│   │       └── reset.blade.php            # Form đặt lại mật khẩu sau khi nhận link reset.
│   ├── components/                        # Blade components tái sử dụng
│   │   ├── product-card.blade.php         # Hiển thị thông tin một sản phẩm (hình ảnh, tên, giá, nút hành động).
│   │   ├── alert.blade.php                # Component hiển thị thông báo (success, error, warning).
│   │   ├── pagination.blade.php           # Component hiển thị phân trang cho danh sách dữ liệu.
│   │   └── breadcrumb.blade.php           # Component hiển thị điều hướng breadcrumb (đường dẫn phân cấp).
│   └── layouts/                           # Layout chung
│       ├── app.blade.php                  # Layout chính cho các trang yêu cầu đăng nhập (cả admin và client).
│       └── guest.blade.php                # Layout cho các trang không yêu cầu đăng nhập (đăng nhập, đăng ký, quên mật khẩu).
├── js/                                # JavaScript
│   └── app.js
└── css/                     # CSS
    └── app.css
```
