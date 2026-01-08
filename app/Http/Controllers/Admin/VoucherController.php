<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VoucherRequest;
use App\Models\Voucher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the vouchers.
     * GET /admin/vouchers
     */
    public function index(Request $request): JsonResponse
    {
        $query = Voucher::query();

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->boolean('status'));
        }

        // Filter by valid (còn hạn và còn số lượng)
        if ($request->boolean('valid_only')) {
            $query->valid();
        }

        // Search by voucher_code or description
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('voucher_code', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        // Order by
        $orderBy = $request->input('order_by', 'created_at');
        $orderDirection = $request->input('order_direction', 'desc');
        $query->orderBy($orderBy, $orderDirection);

        // Pagination
        $perPage = $request->input('per_page', 15);
        $vouchers = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Lấy danh sách voucher thành công.',
            'data' => $vouchers,
        ]);
    }

    /**
     * Store a newly created voucher in storage.
     * POST /admin/vouchers
     */
    public function store(VoucherRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $voucher = Voucher::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tạo voucher thành công.',
            'data' => $voucher,
        ], 201);
    }

    /**
     * Display the specified voucher.
     * GET /admin/vouchers/{voucher}
     * 
     * Route Model Binding: Laravel tự động inject Voucher model
     */
    public function show(Voucher $voucher): JsonResponse
    {
        // Eager load usages với user info
        $voucher->load(['usages.user:user_id,full_name,email']);

        return response()->json([
            'success' => true,
            'message' => 'Lấy thông tin voucher thành công.',
            'data' => $voucher,
        ]);
    }

    /**
     * Update the specified voucher in storage.
     * PUT/PATCH /admin/vouchers/{voucher}
     * 
     * Route Model Binding: Laravel tự động inject Voucher model
     */
    public function update(VoucherRequest $request, Voucher $voucher): JsonResponse
    {
        $validated = $request->validated();

        $voucher->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật voucher thành công.',
            'data' => $voucher->fresh(),
        ]);
    }

    /**
     * Remove the specified voucher from storage.
     * DELETE /admin/vouchers/{voucher}
     * 
     * Route Model Binding: Laravel tự động inject Voucher model
     */
    public function destroy(Voucher $voucher): JsonResponse
    {
        // Kiểm tra nếu voucher đã được sử dụng
        if ($voucher->usages()->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa voucher đã được sử dụng. Hãy vô hiệu hóa thay vì xóa.',
            ], 422);
        }

        $voucher->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa voucher thành công.',
        ]);
    }

    /**
     * Toggle the status of the specified voucher.
     * PATCH /admin/vouchers/{voucher}/toggle-status
     * 
     * Route Model Binding: Laravel tự động inject Voucher model
     */
    public function toggleStatus(Voucher $voucher): JsonResponse
    {
        $voucher->update([
            'status' => !$voucher->status,
        ]);

        $statusText = $voucher->status ? 'kích hoạt' : 'vô hiệu hóa';

        return response()->json([
            'success' => true,
            'message' => "Đã {$statusText} voucher thành công.",
            'data' => $voucher->fresh(),
        ]);
    }

    /**
     * Get voucher statistics.
     * GET /admin/vouchers/statistics
     */
    public function statistics(): JsonResponse
    {
        $stats = [
            'total' => Voucher::count(),
            'active' => Voucher::active()->count(),
            'valid' => Voucher::active()->valid()->count(),
            'expired' => Voucher::where('end_date', '<', now())->count(),
            'out_of_stock' => Voucher::where('quantity', '<=', 0)->count(),
        ];

        return response()->json([
            'success' => true,
            'message' => 'Lấy thống kê voucher thành công.',
            'data' => $stats,
        ]);
    }
}
