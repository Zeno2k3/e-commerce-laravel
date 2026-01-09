<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function issues()
    {
        // Đơn hàng lỗi: cancelled hoặc pending quá 24h
        $orders = Order::with('user')
            ->where(function ($query) {
                $query->where('status', 'cancelled')
                    ->orWhere(function ($q) {
                        $q->where('status', 'pending')
                          ->where('created_at', '<', now()->subHours(24));
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.orders.issues', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,shipping,completed,cancelled',
        ]);
        $order->update($validated);
        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái thành công!');
    }

    public function show(Order $order)
    {
        $order->load(['user', 'address', 'voucher', 'orderDetails.product', 'statusHistory']);
        return view('admin.orders.show', compact('order'));
    }
}
