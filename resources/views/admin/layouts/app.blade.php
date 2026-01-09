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
<body class="flex flex-col min-h-screen bg-white">
    <div class="flex flex-1">
        {{-- Sidebar --}}
        <aside id="sidebar" class="w-60 bg-gray-50 border-r border-gray-100 flex flex-col flex-shrink-0 transition-all duration-300">
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
                @php
                    $userRole = auth()->user()->role ?? 'user';
                @endphp
                
                {{-- ADMIN & EMPLOYEE MENU --}}
                @if(in_array($userRole, ['admin', 'employee']))
                    <p class="text-xs font-semibold text-gray-400 uppercase px-3 mb-4 sidebar-text">Tổng quan</p>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-3 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-gauge w-5 text-center"></i>
                        <span class="sidebar-text">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.statistics.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-3 {{ request()->routeIs('admin.statistics.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-chart-line w-5 text-center"></i>
                        <span class="sidebar-text">Thống kê</span>
                    </a>
                    
                    <p class="text-xs font-semibold text-gray-400 uppercase px-3 mb-4 mt-4 sidebar-text">Quản lý</p>
                    <a href="{{ route('admin.products.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-3 {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-box w-5 text-center"></i>
                        <span class="sidebar-text">Sản phẩm</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-3 {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-folder w-5 text-center"></i>
                        <span class="sidebar-text">Danh mục</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-3 {{ request()->routeIs('admin.orders.index') || request()->routeIs('admin.orders.show') ? 'active' : '' }}">
                        <i class="fa-solid fa-receipt w-5 text-center"></i>
                        <span class="sidebar-text">Đơn hàng</span>
                    </a>
                    <a href="{{ route('admin.orders.issues') }}" 
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-3 {{ request()->routeIs('admin.orders.issues') ? 'active' : '' }}">
                        <i class="fa-solid fa-triangle-exclamation w-5 text-center"></i>
                        <span class="sidebar-text">Đơn hàng lỗi</span>
                    </a>
                    <a href="{{ route('admin.customers.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-3 {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-users w-5 text-center"></i>
                        <span class="sidebar-text">Khách hàng</span>
                    </a>
                    
                    <p class="text-xs font-semibold text-gray-400 uppercase px-3 mb-4 mt-4 sidebar-text">Marketing</p>
                    <a href="{{ route('admin.vouchers.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-3 {{ request()->routeIs('admin.vouchers.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-ticket w-5 text-center"></i>
                        <span class="sidebar-text">Voucher</span>
                    </a>
                    <a href="{{ route('admin.events.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-3 {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-gift w-5 text-center"></i>
                        <span class="sidebar-text">Sự kiện ưu đãi</span>
                    </a>
                    <a href="{{ route('admin.notifications.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-3 {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-bell w-5 text-center"></i>
                        <span class="sidebar-text">Thông báo</span>
                    </a>
                    
                    <p class="text-xs font-semibold text-gray-400 uppercase px-3 mb-4 mt-4 sidebar-text">Kho hàng</p>
                    <a href="{{ route('admin.suppliers.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-3 {{ request()->routeIs('admin.suppliers.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-truck w-5 text-center"></i>
                        <span class="sidebar-text">Nhà cung cấp</span>
                    </a>
                    <a href="{{ route('admin.imports.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-3 {{ request()->routeIs('admin.imports.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-file-invoice w-5 text-center"></i>
                        <span class="sidebar-text">Phiếu nhập hàng</span>
                    </a>
                @endif
                
                {{-- ADMIN ONLY --}}
                @if($userRole === 'admin')
                    <p class="text-xs font-semibold text-gray-400 uppercase px-3 mb-4 mt-4 sidebar-text">Hệ thống</p>
                    <a href="{{ route('admin.roles.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-3 {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-shield w-5 text-center"></i>
                        <span class="sidebar-text">Chức vụ</span>
                    </a>
                    <a href="{{ route('admin.employees.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-gray-600 mb-3 {{ request()->routeIs('admin.employees.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-tie w-5 text-center"></i>
                        <span class="sidebar-text">Nhân viên</span>
                    </a>
                @endif
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <header class="h-16 bg-white border-b border-gray-100 flex items-center justify-end px-6">

                <div class="flex items-center gap-4">
                    @hasSection('add_button')
                        @yield('add_button')
                    @endif
                    <a href="{{ route('admin.profile.index') }}" class="text-gray-400 hover:text-purple-600 transition" title="Hồ sơ cá nhân">
                        <i class="fa-solid fa-user text-xl"></i>
                    </a>
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
            const links = document.querySelectorAll('.sidebar-link');
            
            sidebar.classList.toggle('w-60');
            sidebar.classList.toggle('w-16');
            icon.classList.toggle('fa-chevron-left');
            icon.classList.toggle('fa-chevron-right');
            texts.forEach(text => text.classList.toggle('hidden'));
            links.forEach(link => link.classList.toggle('justify-center'));
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
    @stack('scripts')
</body>
</html>
