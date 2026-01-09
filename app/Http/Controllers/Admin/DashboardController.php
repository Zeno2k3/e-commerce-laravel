<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\OrderDetail;

class DashboardController extends Controller {
    public function index() {
        // Đếm tổng số đơn hàng
        $totalOrders = Order::count();
        
        // Đếm tổng sản phẩm hiện có
        $totalProducts = Product::count();
        
        // Đếm tổng khách hàng (user với role = 'user')
        $totalUsers = User::where('role', 'user')->count();
        
        // Tính doanh thu từ các đơn hàng có trạng thái 'completed'
        $totalRevenue = OrderDetail::whereHas('order', function ($query) {
            $query->where('status', 'completed');
        })->sum('total_price');

        return view('admin.dashboard', compact('totalOrders', 'totalProducts', 'totalUsers', 'totalRevenue'));
    }
}
