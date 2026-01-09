<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản lý hệ thống') - Admin</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-link { transition: all 0.2s ease; }
        .sidebar-link.active { background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 100%); color: white; }
        .sidebar-link:not(.active):hover { background: #f3f4f6; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-gray-50">
    <div class="flex flex-1">
        {{-- Sidebar --}}
        <aside id="sidebar" class="w-60 bg-white border-r border-gray-100 flex flex-col flex-shrink-0 transition-all duration-300">
            <div class="p-4 flex items-center gap-3 border-b border-gray-100">
                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center">
                    @auth
                        <span class="text-purple-600 font-bold text-sm">{{ strtoupper(substr(Auth::user()->full_name ?? 'AD', 0, 2)) }}</span>
                    @else
                        <span class="text-purple-600 font-bold text-sm">AD</span>
                    @endauth
                </div>
                <span class="font-bold text-gray-800 sidebar-text">Admin</span>
                <button onclick="toggleSidebar()" class="ml-auto text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-chevron-left text-sm" id="sidebar-toggle-icon"></i>
                </button>
            </div>
            <nav class="flex-1 overflow-y-auto custom-scrollbar py-4 px-3">
                {{-- 1. Quản lý nhân viên --}}
                <a href="{{ route('admin.employees.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-1 {{ request()->routeIs('admin.employees.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-tie w-5 text-center"></i>
                    <span class="sidebar-text">Quản lý nhân viên</span>
                </a>
                
                {{-- 2. Quản lý sản phẩm --}}
                <a href="{{ route('admin.products.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-1 {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-box w-5 text-center"></i>
                    <span class="sidebar-text">Quản lý sản phẩm</span>
                </a>
                
                {{-- 3. Quản lý đơn hàng --}}
                <a href="{{ route('admin.orders.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-1 {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-receipt w-5 text-center"></i>
                    <span class="sidebar-text">Quản lý đơn hàng</span>
                </a>
                
                {{-- 4. Danh mục sản phẩm --}}
                <a href="{{ route('admin.categories.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-1 {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-folder w-5 text-center"></i>
                    <span class="sidebar-text">Danh mục sản phẩm</span>
                </a>
                
                {{-- 5. Quản lý voucher --}}
                <a href="{{ route('admin.vouchers.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-1 {{ request()->routeIs('admin.vouchers.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-ticket w-5 text-center"></i>
                    <span class="sidebar-text">Quản lý voucher</span>
                </a>
                
                {{-- 6. Quản lý người dùng --}}
                <a href="{{ route('admin.customers.index') }}" 
                   class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-1 {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users w-5 text-center"></i>
                    <span class="sidebar-text">Quản lý người dùng</span>
                </a>
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <header class="h-16 bg-white border-b border-gray-100 flex items-center justify-between px-6">
                <div class="flex items-center gap-3 w-96">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    <input type="text" placeholder="Tìm kiếm..." class="flex-1 bg-transparent border-b border-gray-200 py-2 text-sm focus:outline-none focus:border-purple-400 transition">
                </div>
                <div class="flex items-center gap-4">
                    @hasSection('add_button')
                        @yield('add_button')
                    @endif
                    <button class="text-gray-400 hover:text-gray-600 transition"><i class="fa-solid fa-user text-xl"></i></button>
                    <button class="relative text-gray-400 hover:text-gray-600 transition">
                        <i class="fa-solid fa-bell text-xl"></i>
                        <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                </div>
            </header>
            <div class="flex-1 overflow-y-auto custom-scrollbar">@yield('content')</div>
        </main>
    </div>
    

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const icon = document.getElementById('sidebar-toggle-icon');
            const texts = document.querySelectorAll('.sidebar-text');
            sidebar.classList.toggle('w-60');
            sidebar.classList.toggle('w-16');
            icon.classList.toggle('fa-chevron-left');
            icon.classList.toggle('fa-chevron-right');
            texts.forEach(text => text.classList.toggle('hidden'));
        }
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</body>
</html>