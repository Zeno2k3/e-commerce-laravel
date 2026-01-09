<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share cart count with all views
        view()->composer('*', function ($view) {
            $cartItemCount = 0;
            
            if (auth()->check()) {
                $cart = \App\Models\Cart::where('user_id', auth()->id())->first();
                if ($cart) {
                    $cartItemCount = $cart->cartItem()->sum('quantity');
                }
            }
            
            $view->with('globalCartCount', $cartItemCount);
        });
    }
}
