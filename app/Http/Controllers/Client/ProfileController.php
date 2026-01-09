<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('client.account.profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('user', 'email')->ignore($user->user_id, 'user_id'),
            ],
            'phone_number' => 'nullable|string|max:20',
        ]);

        $user->update([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
        ]);

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

    public function favorited(Request $request)
    {
        $user = Auth::user();
        
        // Eager load favorites with products and their variants to prevent N+1
        // We need to transform them similar to ProductService
        
        $favorites = $user->favorites()->with(['product.variants', 'product.reviews'])->paginate(12);

        // Transform logic (ideally leverage ProductService, but for now specific mapping)
        $productService = new \App\Services\ProductService();
        
        $products = $favorites->getCollection()->map(function ($fav) use ($productService) {
            return $productService->transformForCard($fav->product);
        });

        // Paginate the transformed collection
        $products = new \Illuminate\Pagination\LengthAwarePaginator(
            $products,
            $favorites->total(),
            $favorites->perPage(),
            $favorites->currentPage(),
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        return view('client.profile.favorites', compact('products'));
    }

    public function orders()
    {
        $user = Auth::user();
        
        $orders = \App\Models\Order::where('user_id', $user->user_id)
            ->with(['orderDetails.variant.product']) // Eager load nested relationships
            ->orderBy('order_date', 'desc') // Change to order_date
            ->paginate(10);

        return view('client.account.orders', compact('orders'));
    }
}
