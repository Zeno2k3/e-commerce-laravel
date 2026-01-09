<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\PromotionEvent;
use App\Models\Voucher;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::with(['event', 'voucher', 'creator'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        $events = PromotionEvent::active()->get();
        $vouchers = Voucher::where('status', true)->get();

        return view('admin.notifications.index', compact('notifications', 'events', 'vouchers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:promotion,policy,general',
            'event_id' => 'nullable|exists:promotion_event,event_id',
            'voucher_id' => 'nullable|exists:voucher,voucher_id',
        ]);

        $validated['created_by'] = auth()->id();

        Notification::create($validated);

        return redirect()->route('vanhanh.notifications.index')
            ->with('success', 'Đăng thông báo thành công!');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();

        return redirect()->route('vanhanh.notifications.index')
            ->with('success', 'Xóa thông báo thành công!');
    }
}
