<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::whereIn('role', ['admin', 'employee'])
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);
        return view('admin.employees.index', compact('employees'));
    }

    public function byRole($role)
    {
        $employees = User::where('role', $role)->orderBy('created_at', 'desc')->get();
        return response()->json($employees);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email',
            'phone_number' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,employee',
            'status' => 'required|in:active,inactive',
        ]);
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        
        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Tạo tài khoản thành công!', 'user' => $user]);
        }
        
        return redirect()->route('manager.employees.index')->with('success', 'Tạo tài khoản thành công!');
    }

    public function update(Request $request, User $employee)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . $employee->user_id . ',user_id',
            'phone_number' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:admin,employee',
            'status' => 'required|in:active,inactive',
        ]);
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }
        $employee->update($validated);
        
        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Cập nhật thành công!', 'user' => $employee]);
        }

        return redirect()->route('manager.employees.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(User $employee)
    {
        $employee->delete();
        
        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Xóa thành công!']);
        }
        
        return redirect()->route('manager.employees.index')->with('success', 'Xóa thành công!');
    }
}
