<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller {
    public function index() {
        // Đếm tổng số đơn hàng
        $totalOrders = DB::table('order')->count();
        
        // Đếm tổng sản phẩm hiện có
        $totalProducts = DB::table('product')->count();
        
        // Đếm tổng khách hàng (user)
        $totalUsers = DB::table('user')->count();
        
        // Tính doanh thu từ các đơn hàng có trạng thái 'completed'
        $totalRevenue = DB::table('order_detail')
            ->join('order', 'order_detail.order_id', '=', 'order.order_id')
            ->where('order.status', 'completed')
            ->sum('order_detail.total_price');

        return view('admin.dashboard', compact('totalOrders', 'totalProducts', 'totalUsers', 'totalRevenue'));
    }
}