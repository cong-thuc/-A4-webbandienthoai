<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function create()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // ✅ Tính tổng tiền
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // ✅ Gửi cả $cart và $total sang view
        return view('checkout', compact('cart', 'total'));
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

        // ✅ Tính tổng tiền
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // ✅ Lấy phương thức thanh toán (nếu không có thì mặc định là COD)
        $paymentMethod = $request->input('payment_method', 'COD');

        // ✅ Tạo đơn hàng
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->customer_name,
            'phone' => $request->customer_phone,
            'address' => $request->customer_address,
            'status' => 'Chờ xác nhận',
            'total_price' => $total,
            'payment_method' => $paymentMethod,
        ]);

        // ✅ Lưu chi tiết sản phẩm
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);

            // ✅ Trừ số lượng sản phẩm trong kho
            $product = \App\Models\Product::find($id);
            if ($product) {
                $product->quantity -= $item['quantity'];
                if ($product->quantity < 0) $product->quantity = 0;
                $product->save();
            }
        }

        // ✅ Xóa giỏ hàng sau khi đặt
        session()->forget('cart');

        // ✅ Thông báo cảm ơn
        session()->flash('order_success', 'Cảm ơn bạn đã đặt hàng! Chúng tôi sẽ xử lý đơn hàng sớm nhất.');

        return redirect('/orders');
    }

// ✅ Thanh toán MoMo (tạo đơn + redirect sang cổng MoMo)
    public function momoPayment(Request $request)
    {
        // ⭐ BƯỚC 1: THÊM KHỐI VALIDATE NÀY VÀO ĐẦU HÀM
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:255',
            'payment_method' => 'required|string', // Đảm bảo phương thức thanh toán được gửi
        ]);
        // ⭐ KẾT THÚC THÊM VALIDATE

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // ✅ Tính tổng tiền
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // ✅ Tạo đơn hàng trước (pending)
        // ⭐ BƯỚC 2: SỬA LẠI HÀM CREATE (BỎ CÁC GIÁ TRỊ DỰ PHÒNG ??)
        $order = Order::create([
            'user_id' => Auth::id(),
            'name' => $request->customer_name,     // Bỏ '?? Khách hàng MoMo'
            'phone' => $request->customer_phone,   // Bỏ '?? ''
            'address' => $request->customer_address, // Bỏ '?? ''
            'status' => 'Chờ thanh toán',
            'payment_method' => $request->payment_method, // Lấy từ form
            'total_price' => $total,
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        // ✅ Gọi API MoMo
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = "MOMO";
        $accessKey = "F8BBA842ECF85";
        $secretKey = "K951B6PE1waDMi640xX08PD3vg6EkVlz";
        $orderInfo = "Thanh toán đơn hàng #" . $order->id;
        $amount = $total;
        $orderId = 'ORDER_' . $order->id . '_' . time();
        $redirectUrl = route('momo.callback');
        $ipnUrl = route('momo.callback');
        $extraData = "";

        $requestId = (string)time();
        $requestType = "payWithATM";

        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData
            . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo
            . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl
            . "&requestId=" . $requestId . "&requestType=" . $requestType;

        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "MoMo Test",
            'storeId' => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post($endpoint, $data);

        $result = $response->json();

        if (isset($result['payUrl'])) {
            session()->forget('cart');
            return redirect($result['payUrl']);
        }

        return back()->with('error', 'Không thể kết nối với MoMo. ' . json_encode($result));
    }
    // ✅ Callback từ MoMo (sau khi thanh toán)
    public function momoCallback(Request $request)
    {
        $orderId = $request->orderId;
        $resultCode = $request->resultCode;

        $idParts = explode('_', $orderId);
        $realOrderId = isset($idParts[1]) ? (int)$idParts[1] : null;

        $order = Order::find($realOrderId);
        if (!$order) {
            return redirect('/')->with('error', 'Không tìm thấy đơn hàng.');
        }

        if ($resultCode == 0) {
            $order->update(['status' => 'Đã thanh toán', 'payment_method' => 'MoMo']);

            foreach ($order->orderItems as $item) {
                $product = \App\Models\Product::find($item->product_id);
                if ($product) {
                    $product->quantity -= $item->quantity;
                    if ($product->quantity < 0) $product->quantity = 0;
                    $product->save();
                }
            }

            session()->forget('cart');
            session()->flash('order_success', 'Thanh toán MoMo thành công! Cảm ơn bạn đã mua hàng.');
            return redirect('/orders');
        } else {
            $order->update(['status' => 'Thanh toán thất bại']);
            return redirect('/checkout')->with('error', 'Thanh toán MoMo thất bại, vui lòng thử lại.');
        }
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
