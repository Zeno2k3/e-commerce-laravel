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

                @guest
                    <a href="{{ route('login') }}" class="hover:text-purple-600 transition" title="Đăng nhập">
                        <i class="fa-regular fa-user text-2xl"></i>
                    </a>
                @endguest

                @auth
                    <div class="relative group">
                        <a href="/profile" class="flex items-center gap-2 hover:text-purple-600 transition">
                            <i class="fa-solid fa-user-check text-2xl text-purple-600"></i>

                            <span class="text-sm font-medium hidden md:block">
                                {{ Auth::user()->full_name }}
                            </span>
                        </a>

                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden group-hover:block border border-gray-100">
                            <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50">Hồ sơ cá nhân</a>
                        </div>
                    </div>
                @endauth

                <a href="{{ route('client.carts.index') }}" class="relative hover:text-purple-600 transition">
                    <i class="fa-solid fa-bag-shopping text-2xl"></i>

                    <span id="cart-count" class="absolute -top-2 -right-2 bg-purple-600 text-white text-[11px] font-black rounded-full h-5 w-5 flex items-center justify-center border-2 border-white">
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
