<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        // Get available years from orders
        $years = Order::select(DB::raw('YEAR(created_at) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        if ($years->isEmpty()) {
            $years = [date('Y')];
        }

        return view('admin.statistics.index', compact('years'));
    }

    public function getData(Request $request)
    {
        try {
            $year = $request->input('year', date('Y'));
            $month = $request->input('month');

            return response()->json([
                'revenue' => $this->getRevenueData($year, $month),
                'orders' => $this->getOrdersData($year, $month),
                'top_products' => $this->getTopProducts($year, $month),
                'summary' => $this->getSummary($year, $month)
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Lỗi server: ' . $e->getMessage()], 500);
        }
    }

    // ... (other methods)

    private function getTopProducts($year, $month)
    {
        // Fix tables and joins: order_detail -> product_variant -> product
        $query = OrderDetail::join('order', 'order_detail.order_id', '=', 'order.order_id')
            ->join('product_variant', 'order_detail.variant_id', '=', 'product_variant.variant_id')
            ->join('product', 'product_variant.product_id', '=', 'product.product_id')
            ->whereYear('order.created_at', $year)
            ->where('order.status', 'completed');

        if ($month && $month !== 'all') {
            $query->whereMonth('order.created_at', $month);
        }

        return $query->select(
            'product.product_name as name',
            DB::raw('SUM(order_detail.quantity) as total_qty'),
            DB::raw('SUM(order_detail.total_price) as total_revenue')
        )
        ->groupBy('product.product_id', 'product.product_name')
        ->orderByDesc('total_qty')
        ->limit(10)
        ->get();
    }

    private function getRevenueData($year, $month)
    {
        // Join order_detail to calculate actual revenue sum
        $query = DB::table('order')
            ->join('order_detail', 'order.order_id', '=', 'order_detail.order_id')
            ->whereYear('order.created_at', $year)
            ->where('order.status', 'completed'); 

        if ($month && $month !== 'all') {
            $query->whereMonth('order.created_at', $month);
            $groupBy = "DAY(order.created_at)";
            $labels = range(1, Carbon::create($year, $month)->daysInMonth);
        } else {
            $groupBy = "MONTH(order.created_at)";
            $labels = range(1, 12);
        }

        $data = $query->selectRaw("$groupBy as label, SUM(order_detail.total_price) as total")
            ->groupBy(DB::raw($groupBy))
            ->pluck('total', 'label')
            ->toArray();

        // Fill missing labels with 0
        $dataset = [];
        foreach ($labels as $label) {
            $dataset[] = $data[$label] ?? 0;
        }

        return [
            'labels' => $labels,
            'data' => $dataset
        ];
    }

    private function getOrdersData($year, $month)
    {
         // ... (keep existing) ...
        $query = Order::whereYear('created_at', $year);

        if ($month && $month !== 'all') {
            $query->whereMonth('created_at', $month);
            $groupBy = "DAY(created_at)";
            $labels = range(1, Carbon::create($year, $month)->daysInMonth);
        } else {
            $groupBy = "MONTH(created_at)";
            $labels = range(1, 12);
        }

        $data = $query->selectRaw("$groupBy as label, COUNT(*) as count")
            ->groupBy(DB::raw($groupBy))
            ->pluck('count', 'label')
            ->toArray();

        $dataset = [];
        foreach ($labels as $label) {
            $dataset[] = $data[$label] ?? 0;
        }

        return [
            'labels' => $labels,
            'data' => $dataset
        ];
    }



    private function getSummary($year, $month)
    {
        // Independent queries to avoid builder state issues
        $orderQuery = Order::whereYear('created_at', $year);
        if ($month && $month !== 'all') {
            $orderQuery->whereMonth('created_at', $month);
        }
        $totalOrders = $orderQuery->count();

        // Calculate revenue from order_detail instead of order.total_price
        $revenueQuery = DB::table('order')
            ->join('order_detail', 'order.order_id', '=', 'order_detail.order_id')
            ->whereYear('order.created_at', $year)
            ->where('order.status', 'completed');
        if ($month && $month !== 'all') {
            $revenueQuery->whereMonth('order.created_at', $month);
        }
        $totalRevenue = $revenueQuery->sum('order_detail.total_price');
        
        $customerQuery = User::where('role', 'user')->whereYear('created_at', $year);
        if ($month && $month !== 'all') {
            $customerQuery->whereMonth('created_at', $month);
        }
        $newCustomers = $customerQuery->count();

        return [
            'total_revenue' => number_format($totalRevenue) . ' đ',
            'total_orders' => number_format($totalOrders),
            'new_customers' => number_format($newCustomers)
        ];
    }
}
