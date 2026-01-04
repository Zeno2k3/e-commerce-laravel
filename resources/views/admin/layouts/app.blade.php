<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Quản lý hệ thống') - Administration</title>
    
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}?v={{ time() }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: #f1f5f9; 
        }
        
        .sidebar-link {
            transition: all 0.2s ease;
            border-radius: 12px;
            margin: 4px 12px;
        }
        .sidebar-link.active {
            background: #6366f1;
            color: white;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="flex h-screen overflow-hidden">

    <aside class="w-72 bg-white border-r border-slate-200 flex flex-col flex-shrink-0 hidden lg:flex">
        <div class="p-8 pb-4 flex items-center space-x-4">
    <div class="w-16 h-16 flex-shrink-0 flex items-center justify-center overflow-hidden">
        <img src="https://laravelnews.s3.amazonaws.com/images/laravel-featured.png" 
             alt="FlexStyle Logo" 
             class="w-full h-full object-contain transform scale-125 drop-shadow-md">
    </div>
    <div class="flex flex-col">
        <span class="text-slate-900 font-extrabold tracking-tight text-2xl uppercase italic leading-none">Laravel Shop</span>
        <span class="text-[11px] text-indigo-500 font-bold tracking-[0.2em] mt-1.5">Trang của Admin</span>
    </div>
</div>

        <nav class="flex-1 overflow-y-auto custom-scrollbar pt-4">
            <div class="px-6 mb-2 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Menu chính</div>
            
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center p-3 text-sm font-bold text-slate-600 hover:bg-slate-50 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house-chimney mr-3 w-5"></i> Tổng quan
            </a>

            <a href="{{ route('admin.products.index') }}" class="sidebar-link flex items-center p-3 text-sm font-bold text-slate-600 hover:bg-slate-50 {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="fa-solid fa-store mr-3 w-5"></i> Sản phẩm
            </a>

            <a href="{{ route('admin.orders.index') }}" class="sidebar-link flex items-center p-3 text-sm font-bold text-slate-600 hover:bg-slate-50 {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="fa-solid fa-receipt mr-3 w-5"></i> Đơn hàng
                <span class="ml-auto bg-red-100 text-red-600 text-[10px] px-2 py-0.5 rounded-full font-black">2</span>
            </a>

            <a href="{{ route('admin.customers.index') }}" class="sidebar-link flex items-center p-3 text-sm font-bold text-slate-600 hover:bg-slate-50 {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-group mr-3 w-5"></i> Khách hàng
            </a>

            <div class="px-6 mt-8 mb-2 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Hệ thống</div>
            
            <a href="{{ route('admin.settings') }}" class="sidebar-link flex items-center p-3 text-sm font-bold text-slate-600 hover:bg-slate-50 {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <i class="fa-solid fa-sliders mr-3 w-5"></i> Cài đặt
            </a>
        </nav>

        <!-- <div class="p-6 border-t border-slate-100">
    <div class="flex items-center space-x-3 p-3 bg-slate-50 rounded-2xl border border-slate-100">
        <div class="w-9 h-9 rounded-full bg-indigo-600 flex items-center justify-center font-black text-white text-xs shadow-sm">AD</div>
        <div class="flex-1 overflow-hidden">
            <p class="text-xs font-bold text-slate-800 truncate">Administrator</p>
            <p class="text-[10px] text-slate-400 font-medium truncate">admin@shop.com</p>
        </div>
        
        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                class="text-slate-400 hover:text-red-500 transition-colors p-2 hover:bg-red-50 rounded-lg"
                title="Đăng xuất">
            <i class="fa-solid fa-right-from-bracket"></i>
        </button>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div> -->
<div class="p-6 border-t border-slate-100">
    <div class="flex items-center space-x-3 p-3 bg-slate-50 rounded-2xl border border-slate-100">
        <div class="w-9 h-9 rounded-full bg-indigo-600 flex items-center justify-center font-black text-white text-xs shadow-sm">
            {{ strtoupper(substr(Auth::user()->full_name ?? 'AD', 0, 1)) }}
        </div>

        <div class="flex-1 overflow-hidden">
            <p class="text-xs font-bold text-slate-800 truncate">{{ Auth::user()->full_name ?? '' }}</p>
            <p class="text-[10px] text-slate-400 font-medium truncate">{{ Auth::user()->email ?? '' }}</p>
        </div>
        
        <form action="{{ route('logout') }}" method="POST" class="flex items-center">
            @csrf
            <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors p-2 hover:bg-red-50 rounded-lg" title="Đăng xuất">
                <i class="fa-solid fa-right-from-bracket"></i>
            </button>
        </form>
    </div>
</div>
    </aside>

    <main class="flex-1 flex flex-col min-w-0 bg-[#f8fafc] overflow-hidden">
        <header class="h-20 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-10 z-10">
            <div class="relative w-1/3">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                <input type="text" placeholder="Tìm kiếm tài khoản, đơn hàng..." class="w-full bg-slate-100/50 border-none rounded-2xl py-2.5 pl-11 pr-4 text-xs font-medium focus:ring-2 focus:ring-indigo-500/20 transition">
            </div>
            
            <div class="flex items-center space-x-6">
                <button class="relative text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-bell text-lg"></i>
                    <span class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                </button>
                <div class="w-px h-6 bg-slate-200"></div>
                <div class="flex items-center space-x-3">
    @auth
        <span class="text-xs font-bold text-slate-700">Hi, {{ Auth::user()->full_name }}!</span>
        <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-black text-[10px]">
            {{ substr(Auth::user()->full_name, 0, 1) }}
        </div>
    @endauth
</div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-10 custom-scrollbar">
            @yield('content')
        </div>
    </main>

</body>
</html>