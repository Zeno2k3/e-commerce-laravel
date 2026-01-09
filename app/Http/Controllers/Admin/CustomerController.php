<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'user')
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'phone_number' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'status' => 'required|in:active,inactive',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'user';
        User::create($validated);
        return redirect()->route('manager.customers.index')->with('success', 'Tạo tài khoản thành công!');
    }

    public function update(Request $request, User $customer)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . $customer->user_id . ',user_id',
            'phone_number' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
            'status' => 'required|in:active,inactive',
        ]);
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }
        $customer->update($validated);
        return redirect()->route('manager.customers.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(User $customer)
    {
        $customer->delete();
        return redirect()->route('manager.customers.index')->with('success', 'Xóa thành công!');
    }
}
