<header class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
    <div class="container mx-auto px-4 h-20 flex items-center justify-between">

        <div class="flex-shrink-0">
            <a href="/san-pham">
                <img src="{{ asset('images/logo.png') }}" alt="FlexStyle Logo" class="h-20 w-auto">
            </a>
        </div>

        <nav class="hidden lg:flex items-center space-x-10 font-bold text-gray-800">
            <a href="{{ route('client.men') }}" class="hover:text-purple-600 transition tracking-wide text-xl">Nam</a>

            <a href="{{ route('client.women') }}" class="hover:text-purple-600 transition tracking-wide text-xl">Nữ</a>

            <a href="{{ route('client.accessories') }}" class="hover:text-purple-600 transition tracking-wide text-xl">Phụ kiện</a>

            <a href="{{ route('client.sale') }}" class="text-red-600 hover:text-red-700 transition text-xl">Khuyến mãi</a>

            <a href="{{ route('client.voucher') }}" class="text-[#7d3cff] hover:opacity-80 transition text-xl">Voucher</a>
        </nav>

        <div class="flex items-center space-x-6">
            <div class="relative hidden md:block w-72 lg:w-96">
                <input type="text"
                       placeholder="Tìm kiếm..."
                       class="w-full pl-12 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition text-base">

                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-gray-400 text-lg"></i>
                </div>
            </div>

            <div class="flex items-center space-x-6 text-gray-700">
                <button class="hover:text-purple-600 transition cursor-pointer">
                    <i class="fa-solid fa-globe text-2xl"></i>
                </button>

                {{-- BỌC NGOÀI BẰNG DIV RELATIVE ĐỂ CHỨA DROPDOWN --}}
            <div class="relative" x-data="{ open: false }">

                {{-- 1. NÚT KÍCH HOẠT (TRIGGER) --}}
                <button @click="open = !open" class="hover:text-purple-600 transition-colors outline-none pt-1">
                    <i class="fa-regular fa-user text-2xl"></i>
                </button>

                {{-- 2. MENU DROPDOWN --}}
                <div x-show="open"
                    @click.outside="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50 overflow-hidden"
                    style="display: none;">

                    {{-- KIỂM TRA TRẠNG THÁI ĐĂNG NHẬP --}}
                    @auth
                        {{-- TRƯỜNG HỢP 1: ĐÃ ĐĂNG NHẬP --}}

                        {{-- Tên người dùng --}}
                        <div class="px-4 py-3 border-b border-gray-100 bg-gray-50">
                            <p class="text-xs text-gray-500 uppercase font-bold">Xin chào,</p>
                            <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name ?? 'Bạn' }}</p>
                        </div>

                        {{-- Link Lịch sử đơn hàng --}}
                        <a href="{{ route('client.history') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors">
                            <i class="fa-solid fa-clock-rotate-left text-gray-400"></i>
                            Lịch sử đơn hàng
                        </a>

                        {{-- Link Thông tin tài khoản (Optional - thêm cho đầy đủ) --}}
                        <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors">
                            <i class="fa-regular fa-address-card text-gray-400"></i>
                            Thông tin cá nhân
                        </a>

                        <div class="border-t border-gray-100 my-1"></div>

                        {{-- Nút Đăng xuất --}}
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-colors text-left">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                Đăng xuất
                            </button>
                        </form>

                    @else
                        {{-- TRƯỜNG HỢP 2: CHƯA ĐĂNG NHẬP --}}

                        <div class="px-4 py-3 text-center">
                            <p class="text-sm text-gray-500 mb-3">Vui lòng đăng nhập để xem đơn hàng</p>
                        </div>

                        {{-- Link Đăng nhập --}}
                        <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors">
                            <i class="fa-solid fa-right-to-bracket text-gray-400"></i>
                            Đăng nhập
                        </a>

                        {{-- Link Đăng ký --}}
                        <a href="{{ route('register') }}" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition-colors">
                            <i class="fa-solid fa-user-plus text-gray-400"></i>
                            Đăng ký
                        </a>

                    @endauth

                </div>
            </div>

                <a href="{{ route('client.carts.index') }}" class="relative hover:text-purple-600 transition">
                    <i class="fa-solid fa-bag-shopping text-2xl"></i>
                    <span class="absolute -top-2 -right-2 bg-purple-600 text-white text-[11px] font-black rounded-full h-5 w-5 flex items-center justify-center border-2 border-white">
                        0
                    </span>
                </a>

                <button class="lg:hidden text-gray-800" id="mobile-menu-btn">
                    <i class="fa-solid fa-bars text-3xl"></i>
                </button>
            </div>
        </div>
    </div>
</header>
