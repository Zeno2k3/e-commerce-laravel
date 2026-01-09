<header class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
    <div class="container mx-auto px-4 h-20 flex items-center justify-between">

        <div class="flex-shrink-0">
            <a href="/">
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
            <div class="relative hidden md:block w-72 lg:w-96 group" id="search-container">
                <form action="{{ route('client.products.index') }}" method="GET">
                    <input type="text"
                           name="search"
                           id="search-input"
                           autocomplete="off"
                           placeholder="Tìm kiếm sản phẩm..."
                           class="w-full pl-12 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-purple-500 focus:bg-white transition text-base">
                    
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-gray-400 text-lg"></i>
                    </div>
                </form>

                {{-- Dropdown Results --}}
                <div id="search-results" class="absolute top-full left-0 w-full bg-white shadow-xl rounded-2xl mt-2 z-50 hidden border border-gray-100 overflow-hidden">
                    {{-- Content injected via JS --}}
                </div>
            </div>

            <div class="flex items-center space-x-6 text-gray-700">

                @guest
                <a href="{{ route('login') }}" class="hover:text-purple-600 transition" title="Đăng nhập">
                <i class="fa-regular fa-user text-2xl"></i>
                </a>
                @endguest

                @auth
                <div class="relative group">
                    <a href="{{ route('client.profile.index') }}" class="flex items-center gap-2 hover:text-purple-600 transition">
                        <i class="fa-solid fa-user-check text-2xl text-purple-600"></i>
                        
                        <span class="text-sm font-medium hidden md:block">
                            {{ Auth::user()->full_name }}
                        </span>
                    </a>

                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden group-hover:block border border-gray-100">
                        <a href="{{ route('client.profile.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50">Hồ sơ cá nhân</a>
                    </div>
                </div>
                @endauth
                @auth   
                <a href="{{ route('client.cart.index') }}" class="relative hover:text-purple-600 transition">
                    <i class="fa-solid fa-bag-shopping text-2xl"></i>

                    <span id="cart-count" class="absolute -top-2 -right-2 bg-purple-600 text-white text-[11px] font-black rounded-full h-5 min-w-[1.25rem] px-1 flex items-center justify-center border-2 border-white">
                        {{ $globalCartCount ?? 0 }}
                    </span>
                </a>
                @endauth

                
                <button class="lg:hidden text-gray-800" id="mobile-menu-btn">
                    <i class="fa-solid fa-bars text-3xl"></i>
                </button>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        const searchResults = document.getElementById('search-results');
        const searchContainer = document.getElementById('search-container');
        let timeout = null;

        // Hide results when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchContainer.contains(e.target)) {
                searchResults.classList.add('hidden');
            }
        });

        // Show results when focusing input if it has value
        searchInput.addEventListener('focus', function() {
            if (this.value.length > 0) {
                searchResults.classList.remove('hidden');
            }
        });

        searchInput.addEventListener('input', function() {
            const keyword = this.value.trim();
            
            // Clear previous timeout
            if (timeout) clearTimeout(timeout);

            if (keyword.length < 2) {
                searchResults.classList.add('hidden');
                searchResults.innerHTML = '';
                return;
            }

            // Debounce 300ms
            timeout = setTimeout(() => {
                // Show loading State
                searchResults.classList.remove('hidden');
                searchResults.innerHTML = `
                    <div class="p-4 text-center text-gray-500">
                        <i class="fa-solid fa-spinner fa-spin mr-2"></i> Đang tìm...
                    </div>
                `;

                fetch(`{{ route('client.ajax.search') }}?keyword=${encodeURIComponent(keyword)}`)
                    .then(response => response.json())
                    .then(data => {
                        let html = '';

                        // Categories - REMOVED as per user request
                        /*
                        if (data.categories.length > 0) {
                            html += `<div class="p-3 bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider">Danh mục gợi ý</div>`;
                            data.categories.forEach(cat => {
                                html += `
                                    <a href="${cat.url}" class="block px-4 py-2 text-gray-700 hover:bg-purple-50 hover:text-purple-600 transition">
                                        <i class="fa-solid fa-folder-open mr-2 text-gray-400"></i> ${cat.name}
                                    </a>
                                `;
                            });
                        }
                        */

                        // Products
                        if (data.products.length > 0) {
                            html += `<div class="p-3 bg-gray-50 border-b border-gray-100 text-xs font-bold text-gray-500 uppercase tracking-wider border-t">Sản phẩm gợi ý</div>`;
                            data.products.forEach(product => {
                                html += `
                                    <a href="${product.url}" class="flex items-center gap-3 px-4 py-3 hover:bg-purple-50 transition border-b border-gray-50 last:border-0">
                                        <img src="${product.image}" alt="${product.name}" class="w-10 h-10 object-cover rounded-md shadow-sm">
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-sm font-medium text-gray-900 truncate group-hover:text-purple-600">${product.name}</h4>
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs font-bold text-purple-600">${product.price}</span>
                                                ${product.original_price ? `<span class="text-xs text-gray-400 line-through">${product.original_price}</span>` : ''}
                                            </div>
                                        </div>
                                    </a>
                                `;
                            });
                        }

                        // No results (Check products only)
                        if (data.products.length === 0) {
                            html = `
                                <div class="p-4 text-center text-gray-500 text-sm">
                                    Không tìm thấy sản phẩm nào cho "<b>${keyword}</b>"
                                </div>
                            `;
                        } else {
                            // View all link
                             html += `
                                <a href="{{ route('client.products.index') }}?search=${encodeURIComponent(keyword)}" class="block p-3 text-center text-sm font-bold text-purple-600 hover:bg-purple-50 border-t border-gray-100 transition">
                                    Xem tất cả kết quả <i class="fa-solid fa-arrow-right ml-1"></i>
                                </a>
                            `;
                        }

                        searchResults.innerHTML = html;
                    })
                    .catch(err => {
                        console.error('Search Error:', err);
                        searchResults.innerHTML = '<div class="p-4 text-center text-red-500">Lỗi kết nối!</div>';
                    });
            }, 300);
        });
    });
</script>
