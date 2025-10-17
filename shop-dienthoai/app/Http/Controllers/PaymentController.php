<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}

    // ✅ Thanh toán MoMo
    public function momo_payment(Request $request)
    {
        $order = \App\Models\Order::where('user_id', auth()->id())
            ->where('status', 'Chờ xác nhận')
            ->latest()
            ->first();

        if (!$order) {
            $order = \App\Models\Order::create([
                'user_id' => auth()->id(),
                'amount' => $request->input('total_momo'),
                'status' => 'Chờ xác nhận',
                'payment_method' => 'Thanh Toán qua MoMo', // ✅ thêm dòng này để lưu phương thức luôn
                'name' => auth()->user()->name ?? 'Khách hàng',
                'phone' => auth()->user()->phone ?? '0123456789',
                'address' => auth()->user()->address ?? 'Chưa cập nhật',
            ]);

            $cartItems = session('cart', []);
            foreach ($cartItems as $productId => $item) {
                $order->orderItems()->create([
                    'product_id' => $productId,
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);
            }
        }

        $orderId = $order->id . '_' . time();
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        $orderInfo = "Thanh toán qua MoMo";
        $amount = "$_POST[total_momo]";
        $orderId = time() ."";
        $redirectUrl = "http://127.0.0.1:8000/orders";
        $ipnUrl = "http://127.0.0.1:8000/orders/ipn";
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";

        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
      'partnerCode' => $partnerCode,
      'partnerName' => "Test",
      "storeId" => "MomoTestStore",
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
    );
    $result = $this->execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);  // decode json

    //Just a example, please check more in there
    return redirect()->to($jsonResult['payUrl']);

    header('Location: ' . $jsonResult['payUrl']);
  }

    // ✅ Callback MoMo
    public function momoReturn(Request $request)
    {
        if ($request->resultCode == 0) {
            $orderId = $request->extraData;
            $order = \App\Models\Order::find($orderId);

            if ($order) {
                $order->status = 'Đã thanh toán';
                $order->payment_method = 'momo';
                $order->save();
            }

            session()->forget('cart');

            return redirect()->route('orders.show', $orderId)
                ->with('success', 'Thanh toán MoMo thành công!');
        }

        return redirect()->route('orders.index')
            ->with('error', 'Thanh toán thất bại hoặc bị hủy.');
    }

    // ✅ Thêm mới: Thanh toán khi nhận hàng (COD)
    public function cod_payment(Request $request)
    {
        $order = \App\Models\Order::create([
            'user_id' => auth()->id(),
            'amount' => $request->input('total_cod'),
            'status' => 'Chờ xác nhận',
            'payment_method' => 'cod', // ✅ thêm phương thức thanh toán
            'name' => auth()->user()->name ?? 'Khách hàng',
            'phone' => auth()->user()->phone ?? '0123456789',
            'address' => auth()->user()->address ?? 'Chưa cập nhật',
        ]);

        $cartItems = session('cart', []);
        foreach ($cartItems as $productId => $item) {
            $order->orderItems()->create([
                'product_id' => $productId,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Đặt hàng thành công! Thanh toán khi nhận hàng.');
    }
}
