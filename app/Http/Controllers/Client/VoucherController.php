<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VoucherController extends Controller
{
    /**
     * Hiển thị danh sách voucher cho client
     * GET /voucher
     */
    public function index(): View
    {
        // Lấy tất cả voucher đang active và còn hạn sử dụng
        $vouchers = Voucher::active()
            ->valid()
            ->orderBy('end_date', 'asc')
            ->get();

        return view('client.layouts.voucher', compact('vouchers'));
    }

    /**
     * Lấy tất cả voucher (kể cả hết hạn) để hiển thị
     * GET /voucher/all
     */
    public function all(): View
    {
        $vouchers = Voucher::orderBy('created_at', 'desc')->get();

        return view('client.layouts.voucher', compact('vouchers'));
    }

    /**
     * API: Lấy danh sách voucher dạng JSON
     * GET /api/vouchers
     */
    public function getVouchersJson(Request $request)
    {
        $query = Voucher::active()->valid();

        // Tìm kiếm theo mã voucher
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('voucher_code', 'like', "%{$search}%");
        }

        $vouchers = $query->orderBy('end_date', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $vouchers,
        ]);
    }

    /**
     * API: Kiểm tra chi tiết một voucher theo mã code
     * GET /api/vouchers/{code}
     */
    public function checkVoucherByCode(string $code)
    {
        $voucher = Voucher::where('voucher_code', $code)->first();

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy voucher với mã này.',
            ], 404);
        }

        // Kiểm tra trạng thái voucher
        $status = [
            'is_active' => $voucher->status,
            'is_valid' => $voucher->isUsable(),
            'is_expired' => $voucher->end_date < now(),
            'is_not_started' => $voucher->start_date > now(),
            'is_out_of_stock' => $voucher->quantity <= 0,
        ];

        return response()->json([
            'success' => true,
            'data' => [
                'voucher' => $voucher,
                'status' => $status,
                'can_use' => $status['is_valid'],
                'message' => $this->getVoucherStatusMessage($status),
            ],
        ]);
    }

    /**
     * Lấy thông báo trạng thái voucher
     */
    private function getVoucherStatusMessage(array $status): string
    {
        if (!$status['is_active']) {
            return 'Voucher đã bị vô hiệu hóa.';
        }
        if ($status['is_expired']) {
            return 'Voucher đã hết hạn sử dụng.';
        }
        if ($status['is_not_started']) {
            return 'Voucher chưa đến thời gian sử dụng.';
        }
        if ($status['is_out_of_stock']) {
            return 'Voucher đã hết lượt sử dụng.';
        }
        return 'Voucher có thể sử dụng.';
    }

    /**
     * Kiểm tra và áp dụng voucher
     * POST /voucher/apply
     */
    public function applyVoucher(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string',
            'order_total' => 'required|numeric|min:0',
        ]);

        $voucher = Voucher::where('voucher_code', $request->voucher_code)
            ->active()
            ->valid()
            ->first();

        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Mã voucher không hợp lệ hoặc đã hết hạn.',
            ], 404);
        }

        // Tính giảm giá
        $orderTotal = $request->order_total;
        $discountAmount = ($orderTotal * $voucher->discount_percentage) / 100;

        // Áp dụng giới hạn giảm tối đa
        if ($voucher->max_discount_value && $discountAmount > $voucher->max_discount_value) {
            $discountAmount = $voucher->max_discount_value;
        }

        $finalTotal = $orderTotal - $discountAmount;

        return response()->json([
            'success' => true,
            'message' => 'Áp dụng voucher thành công!',
            'data' => [
                'voucher' => $voucher,
                'original_total' => $orderTotal,
                'discount_amount' => $discountAmount,
                'final_total' => max(0, $finalTotal),
            ],
        ]);
    }
}
