<aside class="w-72 bg-[#0f172a] text-slate-400 flex flex-col h-full shadow-2xl">
    <div class="p-6 flex items-center space-x-3 border-b border-slate-800">
        <div class="w-10 h-10 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center">
            <i class="fas fa-shopping-bag text-white text-xl"></i>
        </div>
        <span class="text-white font-bold text-xl tracking-tight">LUXE SHOP</span>
    </div>

    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-2">
        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] px-4 mb-4">Hệ thống</p>
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-2xl hover:bg-slate-800 hover:text-white transition group {{ request()->is('admin/dashboard') ? 'bg-blue-600 text-white' : '' }}">
            <i class="fas fa-th-large"></i>
            <span>Dashboard</span>
        </a>

        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] px-4 mt-8 mb-4">Quản trị</p>
        <a href="{{ route('admin.roles.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-2xl transition group {{ request()->routeIs('admin.roles.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-user-shield"></i>
            <span>Quản lý chức vụ</span>
        </a>
        <a href="{{ route('admin.suppliers.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-2xl transition group {{ request()->routeIs('admin.suppliers.*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-truck"></i>
            <span>Quản lý nhà cung cấp</span>
        </a>

        <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] px-4 mt-8 mb-4">Cửa hàng</p>
        <a href="{{ route('admin.products.index') }}" class="flex items-center justify-between px-4 py-3 rounded-2xl transition group {{ request()->is('admin/products*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
            <div class="flex items-center space-x-3">
                <i class="fas fa-box"></i>
                <span class="font-bold">Sản phẩm</span>
            </div>
        </a>

        <a href="{{ route('admin.orders.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-2xl transition group {{ request()->is('admin/orders*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 hover:text-white' }}">
            <i class="fas fa-receipt"></i>
            <span>Đơn hàng</span>
        </a>
    </nav>
</aside>
