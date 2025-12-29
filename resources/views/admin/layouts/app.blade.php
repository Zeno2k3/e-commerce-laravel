<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Administration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-gray-50 text-gray-800">
        <!-- Sidebar -->
        <div class="fixed flex flex-col top-0 left-0 w-64 bg-slate-900 h-full border-r hover:w-64 transform transition-all duration-300 z-50">
            <div class="flex items-center justify-center h-14 border-b border-gray-800">
                <div class="text-white text-xl font-bold">Admin Panel</div>
            </div>
            <div class="overflow-y-auto overflow-x-hidden flex-grow">
                <ul class="flex flex-col py-4 space-y-1">
                    <li class="px-5">
                      <div class="flex flex-row items-center h-8">
                        <div class="text-sm font-light tracking-wide text-gray-400">Menu</div>
                      </div>
                    </li>
                    <li>
                      <a href="{{ route('admin.dashboard') }}" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-slate-800 text-white border-l-4 border-transparent hover:border-blue-500 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                          <i class="fa-solid fa-house"></i>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-slate-800 text-white border-l-4 border-transparent hover:border-blue-500 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                          <i class="fa-solid fa-box-open"></i>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Sản phẩm</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-slate-800 text-white border-l-4 border-transparent hover:border-blue-500 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                          <i class="fa-solid fa-list"></i>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Danh mục</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-slate-800 text-white border-l-4 border-transparent hover:border-blue-500 pr-6">
                         <span class="inline-flex justify-center items-center ml-4">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Đơn hàng</span>
                        <span class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-500 bg-red-100 rounded-full">New</span>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-slate-800 text-white border-l-4 border-transparent hover:border-blue-500 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                           <i class="fa-solid fa-users"></i>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Khách hàng</span>
                      </a>
                    </li>
                    <li class="px-5">
                      <div class="flex flex-row items-center h-8">
                        <div class="text-sm font-light tracking-wide text-gray-400">Hệ thống</div>
                      </div>
                    </li>
                     <li>
                      <a href="#" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-slate-800 text-white border-l-4 border-transparent hover:border-blue-500 pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                          <i class="fa-solid fa-gear"></i>
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Cài đặt</span>
                      </a>
                    </li>
                    <li>
                      <!-- Logout -->
                      <form method="POST" action="{{ route('logout') }}" class="block">
                          @csrf
                          <button type="submit" class="w-full relative flex flex-row items-center h-11 focus:outline-none hover:bg-red-800 text-white border-l-4 border-transparent hover:border-red-500 pr-6">
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

        <!-- Header -->
        <div class="fixed w-full flex items-center justify-between h-14 text-white z-10">
            <div class="flex items-center justify-start md:justify-center pl-3 w-14 md:w-64 h-14 bg-slate-900 border-none">
                <!-- Mobile Menu Button -->
                <img class="w-7 h-7 md:w-10 md:h-10 mr-2 rounded-md overflow-hidden" src="https://ui-avatars.com/api/?name=Admin&background=random" />
                <span class="hidden md:block">Admin</span>
            </div>
            <div class="flex justify-between items-center h-14 bg-white header-right pl-64 w-full shadow-sm">
                 <div class="bg-white rounded flex items-center w-full max-w-xl mr-4 p-2 shadow-sm border border-gray-200">
                    <button class="outline-none focus:outline-none p-2 text-gray-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <input type="search" name="" id="" placeholder="Tìm kiếm..." class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent" />
                </div>
                <ul class="flex items-center">
                    <li>
                        <div class="block w-px h-6 mx-3 bg-gray-400"></div>
                    </li>
                    <li>
                        <a href="#" class="flex items-center mr-4 hover:text-blue-100">
                            <span class="inline-flex mr-1">
                              <i class="fa-solid fa-bell text-gray-500 text-lg"></i>
                            </span>
                        </a>
                    </li>
                    <li>
                       <a href="#" class="flex items-center mr-4 hover:text-blue-100">
                            <span class="inline-flex mr-1">
                                <i class="fa-solid fa-envelope text-gray-500 text-lg"></i>
                            </span>
                       </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="h-full ml-64 mt-14 mb-10 md:ml-64 p-4">
             @yield('content')
        </div>
    </div>
</body>
</html>
