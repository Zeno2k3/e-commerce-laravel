<header class="sticky top-0 z-50 bg-white shadow-sm font-sans">

    <div class="bg-[#7d3cff] text-white text-xs py-2">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="hidden md:flex gap-4">
                <span><i class="fa-solid fa-phone mr-1"></i> Hotline: 1900 1234</span>
                <span><i class="fa-solid fa-envelope mr-1"></i> support@fashionstore.com</span>
            </div>
            <div class="flex gap-4 w-full md:w-auto justify-between md:justify-end">
                <span class="font-bold">Miễn phí vận chuyển cho đơn từ 500k!</span>
                <div class="flex gap-3">
                    <a href="#" class="hover:text-purple-200">Trợ giúp</a>
                    <a href="#" class="hover:text-purple-200">Tiếng Việt</a>
                </div>
            </div>
        </div>
    </div>

    <div class="border-b border-gray-100 py-4">
        <div class="container mx-auto px-4 flex items-center justify-between gap-4 lg:gap-8">

            <a href="/" class="flex items-center gap-2 shrink-0">
                <div class="w-10 h-10 bg-[#7d3cff] rounded-lg flex items-center justify-center text-white text-xl font-black shadow-lg shadow-purple-200">
                    F
                </div>
                <div class="flex flex-col">
                    <span class="text-2xl font-black text-gray-900 leading-none tracking-tight">FASHION</span>
                    <span class="text-xs font-bold text-gray-400 tracking-widest">STORE</span>
                </div>
            </a>

            <div class="hidden md:flex flex-1 max-w-2xl relative">
                <input type="text"
                       placeholder="Bạn đang tìm kiếm gì hôm nay?..."
                       class="w-full bg-[#f3f4f6] border border-transparent text-gray-900 text-sm rounded-full pl-5 pr-14 py-3 focus:outline-none focus:bg-white focus:border-[#7d3cff] focus:ring-1 focus:ring-[#7d3cff] transition-all">
                <button class="absolute right-2 top-1/2 -translate-y-1/2 w-9 h-9 bg-[#7d3cff] text-white rounded-full flex items-center justify-center hover:bg-[#6c2bd9] transition shadow-md">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </button>
            </div>

            <div class="flex items-center gap-4 lg:gap-6">
                <div class="group relative cursor-pointer">
                    <div class="flex items-center gap-2 text-gray-700 hover:text-[#7d3cff] transition">
                        <i class="fa-regular fa-user text-2xl"></i>
                        <div class="hidden lg:flex flex-col text-xs">
                            <span class="text-gray-400">Xin chào,</span>
                            <span class="font-bold">Đăng nhập</span>
                        </div>
                    </div>
                    <div class="absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 transform translate-y-2 group-hover:translate-y-0">
                        <a href="#" class="block px-4 py-2 hover:bg-purple-50 hover:text-[#7d3cff] rounded-t-xl text-sm">Đăng nhập</a>
                        <a href="#" class="block px-4 py-2 hover:bg-purple-50 hover:text-[#7d3cff] text-sm">Đăng ký</a>
                        <a href="#" class="block px-4 py-2 hover:bg-purple-50 hover:text-[#7d3cff] rounded-b-xl text-sm">Đơn hàng của tôi</a>
                    </div>
                </div>

                <a href="#" class="relative text-gray-700 hover:text-[#7d3cff] transition">
                    <i class="fa-regular fa-heart text-2xl"></i>
                    <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold h-4 w-4 flex items-center justify-center rounded-full border-2 border-white">2</span>
                </a>

                <a href="{{ route('client.cart') }}" class="relative text-gray-700 hover:text-[#7d3cff] transition flex items-center gap-2">
                    <div class="relative">
                        <i class="fa-solid fa-bag-shopping text-2xl"></i>
                        <span class="absolute -top-1 -right-1 bg-[#7d3cff] text-white text-[10px] font-bold h-4 w-4 flex items-center justify-center rounded-full border-2 border-white shadow-sm">
                            {{-- Số lượng giỏ hàng (Logic PHP sau này) --}}
                            {{ isset($cart) ? count($cart) : 0 }}
                        </span>
                    </div>
                    <div class="hidden lg:flex flex-col text-xs">
                        <span class="text-gray-400">Giỏ hàng</span>
                        <span class="font-bold text-[#7d3cff]">0₫</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="border-b border-gray-100 bg-white">
        <div class="container mx-auto px-4">
            <nav class="flex items-center justify-between">

                <ul class="flex items-center gap-8 overflow-x-auto whitespace-nowrap py-3 no-scrollbar">

                    {{-- TRANG CHỦ --}}
                    <li>
                        <a href="/" class="text-sm font-bold uppercase tracking-wide hover:text-[#7d3cff] transition {{ request()->is('/') ? 'text-[#7d3cff]' : 'text-gray-700' }}">
                            Trang chủ
                        </a>
                    </li>

                    {{-- SẢN PHẨM (Có Dropdown) --}}
                    <li class="group relative">
                        <a href="{{ route('client.products.index') }}" class="flex items-center gap-1 text-sm font-bold uppercase tracking-wide hover:text-[#7d3cff] transition {{ request()->routeIs('client.products.*') ? 'text-[#7d3cff]' : 'text-gray-700' }}">
                            Sản phẩm <i class="fa-solid fa-chevron-down text-[10px] opacity-50"></i>
                        </a>
                        <div class="absolute left-0 top-full pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="bg-white rounded-xl shadow-xl border border-gray-100 w-48 p-2">
                                <a href="{{ route('client.men') }}" class="block px-4 py-2.5 rounded-lg hover:bg-purple-50 hover:text-[#7d3cff] text-sm font-medium transition">
                                    <i class="fa-solid fa-person mr-2 text-gray-400"></i> Thời trang Nam
                                </a>
                                <a href="{{ route('client.women') }}" class="block px-4 py-2.5 rounded-lg hover:bg-purple-50 hover:text-[#7d3cff] text-sm font-medium transition">
                                    <i class="fa-solid fa-person-dress mr-2 text-gray-400"></i> Thời trang Nữ
                                </a>
                                <a href="{{ route('client.accessories') }}" class="block px-4 py-2.5 rounded-lg hover:bg-purple-50 hover:text-[#7d3cff] text-sm font-medium transition">
                                    <i class="fa-solid fa-hat-cowboy mr-2 text-gray-400"></i> Phụ kiện
                                </a>
                            </div>
                        </div>
                    </li>

                    {{-- CÁC LINK RIÊNG LẺ --}}
                    <li>
                        <a href="{{ route('client.men') }}" class="text-sm font-bold uppercase tracking-wide hover:text-[#7d3cff] transition {{ request()->routeIs('client.men') ? 'text-[#7d3cff]' : 'text-gray-700' }}">
                            Nam
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.women') }}" class="text-sm font-bold uppercase tracking-wide hover:text-[#7d3cff] transition {{ request()->routeIs('client.women') ? 'text-[#7d3cff]' : 'text-gray-700' }}">
                            Nữ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.accessories') }}" class="text-sm font-bold uppercase tracking-wide hover:text-[#7d3cff] transition {{ request()->routeIs('client.accessories') ? 'text-[#7d3cff]' : 'text-gray-700' }}">
                            Phụ kiện
                        </a>
                    </li>

                    {{-- VOUCHER (Link bạn đã làm) --}}
                    <li>
                        <a href="{{ route('client.voucher') }}" class="flex items-center gap-1 text-sm font-bold uppercase tracking-wide hover:text-[#7d3cff] transition {{ request()->routeIs('client.voucher') ? 'text-[#7d3cff]' : 'text-gray-700' }}">
                            <i class="fa-solid fa-ticket text-[#7d3cff]"></i> Voucher
                        </a>
                    </li>
                </ul>

                <a href="#" class="hidden lg:flex items-center gap-2 bg-red-50 text-red-600 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider hover:bg-red-600 hover:text-white transition">
                    <i class="fa-solid fa-bolt"></i> Flash Sale
                </a>

                <button class="lg:hidden text-gray-700 text-2xl">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </nav>
        </div>
    </div>
</header>
