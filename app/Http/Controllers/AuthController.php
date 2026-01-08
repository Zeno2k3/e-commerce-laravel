<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Passport\Token;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Exception;

class AuthController extends Controller
{
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $findUser = User::where('email', $googleUser->email)->first();
            if ($findUser) {
                Auth::login($findUser);
                return redirect('/')->with('success', 'Đăng nhập thành công bằng Google.');
            }
            $newUser = User::create(
                [
                    'full_name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => bcrypt(Str::random(16)),
                ]
            );
            Auth::login($newUser);
            return redirect('/')->with('success', 'Đăng nhập thành công bằng Google.');;
        } catch (Exception $e) {
            return redirect('/auth/login')->with('error', 'Đăng nhập bằng Google thất bại. Vui lòng thử lại.');
        }
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if ($user->role === 'admin') {
                return redirect()->route('admin.employees.index')->with('success', 'Chào mừng quản trị viên quay trở lại.');
            }

            return redirect('/')->with('success', 'Đăng nhập thành công.');
        }

        return redirect('/auth/login')->with('error', 'Đăng nhập thất bại. Vui lòng kiểm tra lại thông tin.');
    }
    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);
        Auth::login($user);
        return redirect('/')->with('success', 'Đăng ký thành công.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Đăng xuất thành công.');
    }
}
