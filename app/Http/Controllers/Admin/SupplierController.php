<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        Supplier::create($validated);

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Thêm nhà cung cấp thành công!');
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $supplier->update($validated);

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Cập nhật nhà cung cấp thành công!');
    }

    public function destroy(Supplier $supplier)
    {
        if ($supplier->importReceipts()->exists()) {
            return redirect()->route('admin.suppliers.index')
                ->with('error', 'Không thể xóa nhà cung cấp đã có phiếu nhập hàng!');
        }

        $supplier->delete();

        return redirect()->route('admin.suppliers.index')
            ->with('success', 'Xóa nhà cung cấp thành công!');
    }
}
