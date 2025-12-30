<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Administration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-gray-50 text-gray-800">
        
        <div class="fixed flex flex-col top-0 left-0 w-64 bg-slate-900 h-full border-r transition-all duration-300 z-50">
            <div class="flex items-center justify-center h-14 border-b border-gray-800">
              <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 group">
                <svg class="w-8 h-8 transition-transform group-hover:rotate-12" viewBox="0 0 62 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M61.8548 14.6253L29.7534 0.138246C29.1112 -0.141314 28.3888 -0.141314 27.7466 0.138246L1.35484 12.0253C0.514436 12.4042 0 13.242 0 14.1613V50.8387C0 51.758 0.514436 52.5958 1.35484 52.9747L27.7466 64.8618C28.068 65.0039 28.412 65.0741 28.7534 65.0741C29.0948 65.0741 29.4388 65.0039 29.7602 64.8618L60.6452 50.9747C61.4856 50.5958 62 49.758 62 48.8387V16.1613C62 15.242 61.4856 14.4042 60.6452 14.0253L61.8548 14.6253Z" fill="#FF2D20"/>
                  <path d="M54.5 50.5L31 61V37L54.5 26.5V50.5Z" fill="white" fill-opacity="0.3"/>
                  <path d="M7.5 50.5L31 61V37L7.5 26.5V50.5Z" fill="white" fill-opacity="0.6"/>
                </svg>
                <span class="text-white text-lg font-black tracking-tighter uppercase group-hover:text-red-500 transition-colors">Laravel</span>
              </a>
            </div>
            <div class="overflow-y-auto overflow-x-hidden flex-grow">
                <ul class="flex flex-col py-4 space-y-1">
                    <li class="px-5">
                        <div class="flex flex-row items-center h-8">
                            <div class="text-xs font-bold tracking-widest text-gray-500 uppercase">Menu</div>
                        </div>
                    </li>
                    
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-slate-800 text-white border-l-4 border-transparent hover:border-blue-500 pr-6 transition-all {{ request()->is('admin/dashboard') ? 'bg-slate-800 border-blue-500' : '' }}">
                            <span class="inline-flex justify-center items-center ml-4">
                                <i class="fa-solid fa-house"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.products.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-slate-800 text-white border-l-4 border-transparent hover:border-blue-500 pr-6 transition-all {{ request()->is('admin/products*') ? 'bg-slate-800 border-blue-500' : '' }}">
                            <span class="inline-flex justify-center items-center ml-4">
                                <i class="fa-solid fa-box-open"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Sản phẩm</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.orders.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-slate-800 text-white border-l-4 border-transparent hover:border-blue-500 pr-6 transition-all {{ request()->is('admin/orders*') ? 'bg-slate-800 border-blue-500' : '' }}">
                            <span class="inline-flex justify-center items-center ml-4">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Đơn hàng</span>
                            <span class="px-2 py-0.5 ml-auto text-[10px] font-bold tracking-wide text-red-500 bg-red-100 rounded-full">NEW</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.customers.index') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-slate-800 text-white border-l-4 border-transparent hover:border-blue-500 pr-6 transition-all {{ request()->is('admin/customers*') ? 'bg-slate-800 border-blue-500' : '' }}">
                            <span class="inline-flex justify-center items-center ml-4">
                              <i class="fa-solid fa-users"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Khách hàng</span>
                        </a>
                    </li>

                    <li class="px-5 pt-4">
                        <div class="flex flex-row items-center h-8">
                            <div class="text-xs font-bold tracking-widest text-gray-500 uppercase">Hệ thống</div>
                        </div>
                    </li>

                    <li>
                        <a href="{{ route('admin.settings') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-slate-800 text-white border-l-4 border-transparent hover:border-blue-500 pr-6 transition-all {{ request()->is('admin/settings') ? 'bg-slate-800 border-blue-500' : '' }}">
                            <span class="inline-flex justify-center items-center ml-4">
                                <i class="fa-solid fa-gear"></i>
                            </span>
                            <span class="ml-2 text-sm tracking-wide truncate">Cài đặt</span>
                        </a>
                    </li>

                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 text-white border-l-4 border-transparent hover:border-red-500 pr-6 transition-all">
                                <span class="inline-flex justify-center items-center ml-4">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Đăng xuất</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="fixed w-full flex items-center justify-between h-14 text-white z-10">
            <div class="flex items-center justify-start md:justify-center pl-3 w-14 md:w-64 h-14 bg-slate-900 border-none">
                <img class="w-7 h-7 md:w-9 md:h-9 mr-2 rounded-lg overflow-hidden border border-gray-700" src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff" />
                <span class="hidden md:block font-bold text-sm tracking-wider uppercase text-blue-400">Quản trị viên</span>
            </div>
            <div class="flex justify-between items-center h-14 bg-white pl-64 w-full shadow-sm border-b border-gray-200">
                <div class="bg-gray-50 rounded-xl flex items-center w-full max-w-xl ml-6 px-4 py-1.5 border border-gray-200 focus-within:ring-2 focus-within:ring-blue-500/20 transition-all">
                    <button class="outline-none focus:outline-none text-gray-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </button>
                    <input type="search" placeholder="Tìm kiếm dữ liệu..." class="w-full pl-3 text-xs text-black outline-none bg-transparent" />
                </div>
                <ul class="flex items-center px-6 space-x-4">
                    <li>
                        <a href="#" class="relative p-2 text-gray-400 hover:text-blue-600 transition-colors">
                            <i class="fa-solid fa-bell text-lg"></i>
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                        </a>
                    </li>
                    <li>
                        <div class="block w-px h-6 bg-gray-200"></div>
                    </li>
                    <li class="flex items-center">
                        <span class="text-xs font-bold text-gray-600 mr-2 italic">{{ Auth::user()->name ?? 'Quản trị viên' }}</span>
                        <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-[10px] font-bold">AD</div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="h-full ml-64 mt-14 p-8">
             @yield('content')
        </div>
    </div>
</body>
</html>