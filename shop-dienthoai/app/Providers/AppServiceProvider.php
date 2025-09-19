<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Order;

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
    public function boot(): void //Thông báo số lượng đơn hàng mới
    {
        View::composer('layouts.admin', function ($view) {
            $newOrdersCount = Order::where('status', 'Chờ xác nhận')->count();
            $view->with('newOrdersCount', $newOrdersCount);
        });
    }
}
