<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Notifications\OrderStatusUpdated;

class OrderController extends Controller
{
    // Hiển thị danh sách đơn hàng và lọc đơn hàng theo từ khóa
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%")
                ->orWhere('address', 'like', "%$keyword%");
            });
        }

        $orders = $query->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Hiển thị chi tiết đơn hàng
    public function show(Order $order)
    {
        // 👉 Load thêm orderItems và product cho chi tiết
        $order->load('orderItems.product');
        return view('admin.orders.show', compact('order'));
    }

    // Hiển thị form chỉnh sửa trạng thái đơn hàng
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    // Cập nhật trạng thái đơn hàng
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|max:255'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        // ✅ 2. THÊM ĐOẠN NÀY ĐỂ GỬI THÔNG BÁO
        // Kiểm tra nếu đơn hàng này có người dùng (user_id không null)
        if ($order->user) {
            // Gửi thông báo đến người dùng đó
            $order->user->notify(new OrderStatusUpdated($order));
        }

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công');
    }
}
