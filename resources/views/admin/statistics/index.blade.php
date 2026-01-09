@extends('admin.layouts.app')
@section('title', 'Thống kê')

@section('content')
<div class="p-6">
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Thống kê</h1>
                <p class="text-gray-500 text-sm mt-1">Tổng quan hoạt động kinh doanh</p>
            </div>
            
            {{-- Filters --}}
            <div class="flex gap-4">
                <select id="yearFilter" class="bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block p-2.5 shadow-sm">
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>Năm {{ $year }}</option>
                    @endforeach
                </select>
                <select id="monthFilter" class="bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block p-2.5 shadow-sm">
                    <option value="all">Cả năm</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">Tháng {{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gray-50 rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-500 text-sm font-medium">Tổng doanh thu</h3>
                    <div class="p-2 bg-purple-100 rounded-lg text-purple-600">
                        <i class="fa-solid fa-sack-dollar text-xl"></i>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <span id="totalRevenue" class="text-3xl font-bold text-gray-800">0 đ</span>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-500 text-sm font-medium">Tổng đơn hàng</h3>
                    <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                        <i class="fa-solid fa-cart-shopping text-xl"></i>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <span id="totalOrders" class="text-3xl font-bold text-gray-800">0</span>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-gray-500 text-sm font-medium">Khách hàng mới</h3>
                    <div class="p-2 bg-pink-100 rounded-lg text-pink-600">
                        <i class="fa-solid fa-users text-xl"></i>
                    </div>
                </div>
                <div class="flex items-end justify-between">
                    <div>
                        <span id="newCustomers" class="text-3xl font-bold text-gray-800">0</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Charts Row 1 --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Revenue Chart --}}
            <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Biểu đồ doanh thu</h3>
                <div class="relative h-80">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>

            {{-- Orders Chart --}}
            <div class="bg-gray-50 rounded-2xl p-6 shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Số lượng đơn hàng</h3>
                <div class="relative h-80">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Top Products Table/Chart --}}
        <div class="bg-gray-50 rounded-2xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Sản phẩm bán chạy nhất</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Tên sản phẩm</th>
                            <th class="px-4 py-3 text-right">Số lượng bán</th>
                            <th class="px-4 py-3 text-right">Doanh thu</th>
                        </tr>
                    </thead>
                    <tbody id="topProductsBody">
                        {{-- JS Loads Data --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let revenueChartInstance = null;
    let ordersChartInstance = null;

    document.addEventListener('DOMContentLoaded', function() {
        loadData();

        document.getElementById('yearFilter').addEventListener('change', loadData);
        document.getElementById('monthFilter').addEventListener('change', loadData);
    });

    function loadData() {
        const year = document.getElementById('yearFilter').value;
        const month = document.getElementById('monthFilter').value;

        fetch(`{{ route('admin.statistics.data') }}?year=${year}&month=${month}`)
            .then(res => res.json())
            .then(data => {
                if (data.error) {
                    console.error("Server Error:", data.error);
                    return;
                }
                updateSummary(data.summary);
                renderRevenueChart(data.revenue);
                renderOrdersChart(data.orders);
                renderTopProducts(data.top_products);
            })
            .catch(error => console.error("Error loading statistics:", error));
    }

    function updateSummary(summary) {
        document.getElementById('totalRevenue').innerText = summary.total_revenue;
        document.getElementById('totalOrders').innerText = summary.total_orders;
        document.getElementById('newCustomers').innerText = summary.new_customers;
    }

    function renderRevenueChart(data) {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        
        if (revenueChartInstance) {
            revenueChartInstance.destroy();
        }

        revenueChartInstance = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Doanh thu',
                    data: data.data,
                    borderColor: '#9333ea',
                    backgroundColor: 'rgba(147, 51, 234, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [2, 4], color: '#f3f4f6' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    }

    function renderOrdersChart(data) {
        const ctx = document.getElementById('ordersChart').getContext('2d');
        
        if (ordersChartInstance) {
            ordersChartInstance.destroy();
        }

        ordersChartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Đơn hàng',
                    data: data.data,
                    backgroundColor: '#3b82f6',
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { display: false }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    }

    function renderTopProducts(products) {
        const tbody = document.getElementById('topProductsBody');
        tbody.innerHTML = '';

        if (products.length === 0) {
            tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4">Không có dữ liệu</td></tr>';
            return;
        }

        products.forEach((product, index) => {
            tbody.innerHTML += `
                <tr class="bg-white border-b hover:bg-gray-50 text-gray-900">
                    <td class="px-4 py-3 font-medium text-gray-500">${index + 1}</td>
                    <td class="px-4 py-3 font-medium">${product.name}</td>
                    <td class="px-4 py-3 text-right">${product.total_qty}</td>
                    <td class="px-4 py-3 text-right font-medium text-purple-600">
                        ${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.total_revenue)}
                    </td>
                </tr>
            `;
        });
    }
</script>
@endpush
