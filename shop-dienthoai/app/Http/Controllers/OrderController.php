<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        return view('checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:255',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect('/')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->customer_name,
            'phone' => $request->customer_phone,
            'address' => $request->customer_address,
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'status' => 'Chờ xác nhận',
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'product_name' => $item['name'], // Lưu tên sản phẩm tại thời điểm đặt
                'price' => $item['price'],       // Lưu giá tại thời điểm đặt
                'quantity' => $item['quantity'],
            ]);

            // Trừ số lượng sản phẩm trong kho
            $product = \App\Models\Product::find($id);
            if ($product) {
                $product->quantity -= $item['quantity'];
                if ($product->quantity < 0) $product->quantity = 0;
                $product->save();
            }
        }
        
        
        session()->forget('cart');

        // ⭐ THÊM dòng này để hiện popup cảm ơn
        session()->flash('order_success', 'Cảm ơn bạn đã đặt hàng! Chúng tôi sẽ xử lý đơn hàng sớm nhất.');

        return redirect('/orders');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('orderItems.product')->where('user_id', Auth::id())->findOrFail($id);
        return view('orders.show', compact('order'));
    }
}
