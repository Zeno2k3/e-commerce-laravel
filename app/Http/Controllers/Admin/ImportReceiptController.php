<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImportReceipt;
use App\Models\ImportReceiptDetail;
use App\Models\Supplier;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ImportReceiptController extends Controller
{
    public function index()
    {
        $receipts = ImportReceipt::with(['supplier', 'creator', 'confirmer'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        $suppliers = Supplier::where('status', 'active')->get();
        $variants = ProductVariant::with('product')->get();

        return view('admin.imports.index', compact('receipts', 'suppliers', 'variants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:supplier,supplier_id',
            'content' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.variant_id' => 'required|exists:product_variant,variant_id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $receipt = ImportReceipt::create([
            'supplier_id' => $validated['supplier_id'],
            'created_by' => auth()->id(),
            'content' => $validated['content'],
            'quantity' => collect($validated['items'])->sum('quantity'),
            'status' => 'pending',
        ]);

        foreach ($validated['items'] as $item) {
            ImportReceiptDetail::create([
                'receipt_id' => $receipt->receipt_id,
                'variant_id' => $item['variant_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
            ]);
        }

            return redirect()->route('admin.imports.index')
            ->with('success', 'Tạo phiếu nhập hàng thành công!');
    }

    public function confirm(ImportReceipt $receipt)
    {
        if ($receipt->status !== 'pending') {
                return redirect()->route('admin.imports.index')
                ->with('error', 'Chỉ có thể xác nhận phiếu nhập đang chờ xử lý!');
        }

        // Update stock for each variant
        foreach ($receipt->details as $detail) {
            $detail->variant->increment('stock', $detail->quantity);
        }

        $receipt->update([
            'status' => 'confirmed',
            'confirmed_by' => auth()->id(),
        ]);

            return redirect()->route('admin.imports.index')
            ->with('success', 'Xác nhận phiếu nhập hàng thành công! Đã cập nhật tồn kho.');
    }
}
