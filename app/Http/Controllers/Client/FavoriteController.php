<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vui lòng đăng nhập để thực hiện chức năng này!',
                'redirect' => route('login')
            ], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:product,product_id'
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;

        $favorite = Favorite::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($favorite) {
            // Fix: Delete directly using query because Model has no primary key
            Favorite::where('user_id', $userId)
                ->where('product_id', $productId)
                ->delete();
                
            $action = 'removed';
            $message = 'Đã xóa khỏi danh sách yêu thích';
        } else {
            Favorite::create([
                'user_id' => $userId,
                'product_id' => $productId
            ]);
            $action = 'added';
            $message = 'Đã thêm vào danh sách yêu thích';
        }

        return response()->json([
            'status' => 'success',
            'action' => $action,
            'message' => $message
        ]);
    }
}
