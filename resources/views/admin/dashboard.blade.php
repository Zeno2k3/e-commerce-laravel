@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
        <div class="flex justify-between mb-6">
            <div>
                <div class="flex items-center mb-1">
                    <div class="text-2xl font-black italic tracking-tighter text-slate-800">1,245</div>
                </div>
                <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Đơn hàng mới</div>
            </div>
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-blue-50 text-blue-500 shadow-sm">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
        </div>
        <a href="javascript:void(0)" onclick="alert('Tính năng xem chi tiết đơn hàng sắp ra mắt!')" class="inline-flex items-center text-blue-500 font-black text-[10px] uppercase tracking-widest hover:text-blue-700 active:scale-95 transition-all">
            Xem chi tiết <i class="fa-solid fa-arrow-right ml-2 text-[8px]"></i>
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
        <div class="flex justify-between mb-6">
             <div>
                <div class="flex items-center mb-1">
                    <div class="text-2xl font-black italic tracking-tighter text-slate-800">$54,300</div>
                    <span class="p-1 rounded bg-green-100 text-green-600 text-[10px] font-black leading-none ml-2">+12%</span>
                </div>
                <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Doanh thu</div>
            </div>
             <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-green-50 text-green-500 shadow-sm">
                <i class="fa-solid fa-dollar-sign"></i>
            </div>
        </div>
         <a href="javascript:void(0)" onclick="alert('Tính năng xem báo cáo doanh thu sắp ra mắt!')" class="inline-flex items-center text-green-600 font-black text-[10px] uppercase tracking-widest hover:text-green-700 active:scale-95 transition-all">
            Xem báo cáo <i class="fa-solid fa-arrow-right ml-2 text-[8px]"></i>
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
        <div class="flex justify-between mb-6">
            <div>
                <div class="flex items-center mb-1">
                    <div class="text-2xl font-black italic tracking-tighter text-slate-800">2,150</div>
                     <span class="p-1 rounded bg-red-100 text-red-600 text-[10px] font-black leading-none ml-2">-2%</span>
                </div>
                <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Sản phẩm</div>
            </div>
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-yellow-50 text-yellow-500 shadow-sm">
               <i class="fa-solid fa-box"></i>
            </div>
        </div>
         <a href="javascript:void(0)" onclick="alert('Tính năng quản lý kho sắp ra mắt!')" class="inline-flex items-center text-yellow-600 font-black text-[10px] uppercase tracking-widest hover:text-yellow-700 active:scale-95 transition-all">
            Quản lý kho <i class="fa-solid fa-arrow-right ml-2 text-[8px]"></i>
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-md shadow-black/5">
        <div class="flex justify-between mb-6">
            <div>
                <div class="flex items-center mb-1">
                    <div class="text-2xl font-black italic tracking-tighter text-slate-800">15,300</div>
                </div>
                <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Khách hàng</div>
            </div>
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-50 text-indigo-500 shadow-sm">
              <i class="fa-solid fa-users"></i>
            </div>
        </div>
         <a href="javascript:void(0)" onclick="alert('Tính năng xem danh sách khách hàng sắp ra mắt!')" class="inline-flex items-center text-indigo-600 font-black text-[10px] uppercase tracking-widest hover:text-indigo-700 active:scale-95 transition-all">
            Xem khách hàng <i class="fa-solid fa-arrow-right ml-2 text-[8px]"></i>
        </a>
    </div>
</div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
            <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">Thống kê doanh thu</div>
            </div>
            <div class="overflow-hidden">
                <canvas id="revenueChart" width="100%" height="300"></canvas>
            </div>
        </div>
        <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
             <div class="flex justify-between mb-4 items-start">
                <div class="font-medium">Đơn hàng theo tháng</div>
            </div>
             <div class="overflow-hidden">
                 <canvas id="orderChart" width="100%" height="300"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Revenue Chart
        new Chart(document.getElementById('revenueChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Doanh thu ($)',
                    data: [12000, 19000, 3000, 5000, 2000, 3000],
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Order Chart
        new Chart(document.getElementById('orderChart'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Đơn hàng',
                    data: [65, 59, 80, 81, 56, 55],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
             options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
@endsection
