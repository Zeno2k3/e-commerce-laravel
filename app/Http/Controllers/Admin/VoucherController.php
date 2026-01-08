<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'voucher_code' => 'required|string|max:50|unique:voucher,voucher_code',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'max_discount_value' => 'nullable|numeric|min:0',
            'usage_conditions' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'boolean',
        ]);
        Voucher::create($validated);
        return redirect()->route('admin.vouchers.index')->with('success', 'Tạo voucher thành công!');
    }

    public function update(Request $request, Voucher $voucher)
    {
        $validated = $request->validate([
            'voucher_code' => 'required|string|max:50|unique:voucher,voucher_code,' . $voucher->voucher_id . ',voucher_id',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'max_discount_value' => 'nullable|numeric|min:0',
            'usage_conditions' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'boolean',
        ]);
        $voucher->update($validated);
        return redirect()->route('admin.vouchers.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Voucher $voucher)
    {
        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Xóa thành công!');
    }
}
