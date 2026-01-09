<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromotionEvent;
use Illuminate\Http\Request;

class PromotionEventController extends Controller
{
    public function index()
    {
        $events = PromotionEvent::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string',
            'discount_percent' => 'required|integer|min:1|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive',
        ]);

        PromotionEvent::create($validated);

        return redirect()->route('vanhanh.events.index')
            ->with('success', 'Tạo sự kiện ưu đãi thành công!');
    }

    public function update(Request $request, PromotionEvent $event)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string',
            'discount_percent' => 'required|integer|min:1|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive,expired',
        ]);

        $event->update($validated);

        return redirect()->route('vanhanh.events.index')
            ->with('success', 'Cập nhật sự kiện ưu đãi thành công!');
    }

    public function destroy(PromotionEvent $event)
    {
        $event->delete();

        return redirect()->route('vanhanh.events.index')
            ->with('success', 'Xóa sự kiện ưu đãi thành công!');
    }
}
