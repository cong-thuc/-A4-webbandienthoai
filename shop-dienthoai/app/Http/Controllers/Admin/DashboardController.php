<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ⭐ Thống kê nhanh
        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', 'customer')->count();

        // ⭐ Tổng doanh thu chỉ tính đơn "Đã giao"
        $totalRevenue = OrderItem::whereHas('order', function ($query) {
            $query->where('status', 'Đã giao');
        })->sum(DB::raw('quantity * price'));

        // ⭐ Thống kê trạng thái đơn hàng
        $pendingOrders = Order::where('status', 'Chờ xác nhận')->count();
        $shippingOrders = Order::where('status', 'Đang giao')->count();
        $completedOrders = Order::where('status', 'Đã giao')->count();
        $cancelledOrders = Order::where('status', 'Đã hủy')->count();

        // ⭐ Dữ liệu biểu đồ doanh thu theo tháng
        $revenueData = Order::where('status', 'Đã giao')
            ->selectRaw('MONTH(orders.created_at) as month, SUM(order_items.price * order_items.quantity) as revenue')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('revenue', 'month')
            ->toArray();

        // ⭐ Dữ liệu biểu đồ trạng thái đơn hàng
        $orderStatusData = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalCategories',
            'totalProducts',
            'totalOrders',
            'totalCustomers',
            'totalRevenue',
            'pendingOrders',
            'shippingOrders',
            'completedOrders',
            'cancelledOrders',
            'revenueData',
            'orderStatusData'
        ));
        
    }
}
