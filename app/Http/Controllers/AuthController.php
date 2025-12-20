<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
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
                    'asset_token' => $googleUser->token,
                    'refresh_token' => $googleUser->refreshToken,
                ]
            );

            Auth::login($newUser);
            return redirect('/')->with('success', 'Đăng nhập thành công bằng Google.');;
        } catch (Exception $e) {
            return dd($e->getMessage(), $e->getLine(), $e->getFile());
            //return redirect('/auth/login')->with('error', 'Đăng nhập bằng Google thất bại. Vui lòng thử lại.');
        }
    }
}
