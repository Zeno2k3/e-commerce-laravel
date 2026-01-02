@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-semibold">1,245</div>
                    </div>
                    <div class="text-sm font-medium text-gray-400">Đơn hàng mới</div>
                </div>
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-50 text-blue-500">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>
            <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">Xem chi tiết</a>
        </div>
        <!-- Card 2 -->
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                 <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-semibold">$54,300</div>
                        <span class="p-1 rounded bg-green-100 text-green-600 text-[10px] font-semibold leading-none ml-2">+12%</span>
                    </div>
                    <div class="text-sm font-medium text-gray-400">Doanh thu</div>
                </div>
                 <div class="flex items-center justify-center w-10 h-10 rounded-full bg-green-50 text-green-500">
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>
            </div>
             <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">Xem chi tiết</a>
        </div>
        <!-- Card 3 -->
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-semibold">2,150</div>
                         <span class="p-1 rounded bg-red-100 text-red-600 text-[10px] font-semibold leading-none ml-2">-2%</span>
                    </div>
                    <div class="text-sm font-medium text-gray-400">Sản phẩm</div>
                </div>
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-yellow-50 text-yellow-500">
                   <i class="fa-solid fa-box"></i>
                </div>
            </div>
             <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">Xem chi tiết</a>
        </div>
        <!-- Card 4 -->
         <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-semibold">15,300</div>
                    </div>
                    <div class="text-sm font-medium text-gray-400">Khách hàng</div>
                </div>
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-50 text-indigo-500">
                  <i class="fa-solid fa-users"></i>
                </div>
            </div>
             <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">Xem chi tiết</a>
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
