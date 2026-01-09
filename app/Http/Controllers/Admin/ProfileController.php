<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index', [
            'user' => Auth::user()
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => [
                'required',
                'email',
                Rule::unique('user', 'email')->ignore($user->user_id, 'user_id'),
            ],
        ]);

        $user->update($validated);

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|current_password',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }
}
