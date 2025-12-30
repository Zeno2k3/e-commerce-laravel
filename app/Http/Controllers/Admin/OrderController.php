<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller {
    public function index() {
        // Liệt kê chi tiết từng cột để vượt qua kiểm tra Strict Mode
        $orders = DB::table('order')
            ->join('user', 'order.user_id', '=', 'user.user_id')
            ->leftJoin('order_detail', 'order.order_id', '=', 'order_detail.order_id')
            ->select(
                'order.order_id', 
                'order.user_id', 
                'order.address_id',
                'order.status', 
                'order.created_at',
                'user.full_name', 
                DB::raw('SUM(order_detail.total_price) as final_total')
            )
            ->groupBy(
                'order.order_id', 
                'order.user_id', 
                'order.address_id',
                'order.status', 
                'order.created_at', 
                'user.full_name'
            ) 
            ->orderBy('order.created_at', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id) 
{
    $order = DB::table('order')
        ->join('user', 'order.user_id', '=', 'user.user_id')
        ->where('order.order_id', $id)
        ->select('order.*', 'user.full_name', 'user.email')
        ->first();

    if (!$order) {
        return redirect()->route('admin.orders.index')->with('error', 'Không tìm thấy đơn hàng!');
    }

    $orderDetails = DB::table('order_detail')
        ->join('product_variant', 'order_detail.variant_id', '=', 'product_variant.variant_id')
        ->join('product', 'product_variant.product_id', '=', 'product.product_id')
        ->where('order_detail.order_id', $id)
        // Sửa chỗ này: Lấy unit_price thay vì price
        ->select('order_detail.*', 'product.product_name', 'product_variant.color', 'product_variant.size')
        ->get();

    return view('admin.orders.show', compact('order', 'orderDetails'));
}
}