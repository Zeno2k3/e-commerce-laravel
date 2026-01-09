<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 bg-gray-50/50">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden border-2 border-white shadow-sm">
                @if(Auth::user()->avatar)
                    <img src="{{ Str::startsWith(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset('storage/' . Auth::user()->avatar) }}" 
                         alt="Avatar" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-purple-100 text-purple-600 font-bold text-lg">
                        {{ strtoupper(substr(Auth::user()->full_name ?? 'U', 0, 1)) }}
                    </div>
                @endif
            </div>
            <div class="overflow-hidden">
                <h4 class="font-bold text-gray-900 truncate">{{ Auth::user()->full_name }}</h4>
                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>
    
    <div class="p-2">
        <a href="{{ route('client.profile.index') }}" 
           class="{{ request()->routeIs('client.profile.index') ? 'bg-purple-50 text-purple-700 font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-4 py-3 text-sm rounded-xl transition-all mb-1">
            <span class="{{ request()->routeIs('client.profile.index') ? 'text-purple-600' : 'text-gray-400 group-hover:text-purple-600' }} w-8 text-lg transition-colors">
                <i class="fa-regular fa-id-card"></i>
            </span>
            Thông tin tài khoản
        </a>

        <a href="{{ route('client.account.orders') }}" 
           class="{{ request()->routeIs('client.account.orders') ? 'bg-purple-50 text-purple-700 font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-4 py-3 text-sm rounded-xl transition-all mb-1">
            <span class="{{ request()->routeIs('client.account.orders') ? 'text-purple-600' : 'text-gray-400 group-hover:text-purple-600' }} w-8 text-lg transition-colors">
                <i class="fa-solid fa-box-open"></i>
            </span>
            Đơn hàng của tôi
        </a>

        <a href="{{ route('client.profile.favorites') }}" 
           class="{{ request()->routeIs('client.profile.favorites') ? 'bg-purple-50 text-purple-700 font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-4 py-3 text-sm rounded-xl transition-all mb-1">
            <span class="{{ request()->routeIs('client.profile.favorites') ? 'text-purple-600' : 'text-gray-400 group-hover:text-purple-600' }} w-8 text-lg transition-colors">
                <i class="fa-solid fa-heart"></i>
            </span>
            Sản phẩm yêu thích
            <span class="ml-auto bg-gray-100 text-gray-600 text-xs font-bold px-2 py-0.5 rounded-full">
                {{ Auth::user()->favorites()->count() }}
            </span>
        </a>

        <form action="{{ route('logout') }}" method="POST" class="mt-4 border-t border-gray-100 pt-2">
            @csrf
            <button type="submit" class="w-full text-left group flex items-center px-4 py-3 text-sm rounded-xl transition-all text-red-600 hover:bg-red-50 hover:text-red-700">
                <span class="text-red-400 group-hover:text-red-600 w-8 text-lg transition-colors">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </span>
                Đăng xuất
            </button>
        </form>
    </div>
</div>
