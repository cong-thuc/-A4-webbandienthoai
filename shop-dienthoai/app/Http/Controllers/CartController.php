<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $sessionCart = session()->get('cart', []);
        $cartItems = [];

        foreach ($sessionCart as $id => $details) {
            if ($product = Product::find($id)) {
                $cartItems[] = [
                    'product'  => $product,
                    'quantity' => $details['quantity'],
                ];
            }
        }

        return view('cart.index', compact('cartItems'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name'     => $product->name,
                'price'    => $product->price,
                'image'    => $product->image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ');
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $quantity = (int) $request->input('quantity', 1);

        // Kiểm tra số lượng tồn kho
        if ($quantity > $product->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Số lượng sản phẩm trong kho không đủ!'
            ], 400);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, $quantity);
            session()->put('cart', $cart);
        }

        // Tính lại subtotal và total
        $subtotal = $product->price * $cart[$id]['quantity'];
        $total = collect($cart)->reduce(function ($carry, $item) {
            return $carry + $item['price'] * $item['quantity'];
        }, 0);

        return response()->json([
            'success'  => true,
            'message'  => 'Cập nhật giỏ hàng thành công',
            'subtotal' => number_format($subtotal, 0, ',', '.') . '₫',
            'total'    => number_format($total, 0, ',', '.') . '₫'
        ]);
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
        }

        return redirect()->route('cart.index')->with('error', 'Sản phẩm không tồn tại trong giỏ hàng');
    }



    // Mua ngay - thêm sản phẩm vào giỏ và chuyển đến trang checkout
    public function buyNow($id)
    {
        $product = \App\Models\Product::findOrFail($id);

        // Tạo session 'cart' chỉ chứa sản phẩm này với số lượng 1
        $cart = [
            $product->id => [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image,
            ]
        ];
        session(['cart' => $cart]);

        // Chuyển đến trang checkout
        return redirect()->route('orders.create');
    }
}
