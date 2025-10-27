@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Chi tiết Đơn hàng</h4>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <p><strong>Khách hàng:</strong> {{ $order->name }}</p>
        <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
        <p><strong>Địa chỉ:</strong> {{ $order->address }}</p>
        <p><strong>Trạng thái:</strong> {{ $order->status }}</p>
        <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

                <p>
        <strong>Phương thức thanh toán:</strong>
        @php
            $method = strtolower($order->payment_method);
        @endphp

        @if ($method === 'momo')
            Thanh toán qua MoMo
        @elseif ($method === 'cod')
            Thanh toán khi nhận hàng (COD)
        @else
            {{ $order->payment_method ?? 'Không xác định' }}
        @endif
    </p>

    <hr>

        <h5>Danh sách sản phẩm:</h5>

        <div class="table-responsive mt-3">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product_name ??'[Đã xóa]' }}</td>
                            <td>{{ number_format($item->price, 0, ',', '.') }}₫</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end mt-4">
            <h5><strong>Tổng tiền:</strong>
                {{ number_format($order->orderItems->sum(fn($item) => $item->price * $item->quantity), 0, ',', '.') }}₫
            </h5>
        </div>
    </div>
</div>
@endsection
