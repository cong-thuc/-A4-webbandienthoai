@extends('layouts.customer')

@section('content')
<div class="row mb-4">
    <div class="col-12 text-center">
        <h2 class="fw-bold">Chi tiết đơn hàng</h2>
    </div>
</div>

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body">
        <div class="mb-4">
            <h5 class="fw-bold">Thông tin giao hàng</h5>
            <p><strong>Họ tên:</strong> {{ $order->name }}</p>
            <p><strong>Số điện thoại:</strong> {{ $order->phone }}</p>
            <p><strong>Địa chỉ giao hàng:</strong> {{ $order->address }}</p>
            <p><strong>Trạng thái:</strong>
                <span class="badge bg-{{
                    $order->status == 'Chờ xác nhận' ? 'warning' :
                    ($order->status == 'Đang giao' ? 'info' :
                    ($order->status == 'Đã giao' ? 'success' : 'danger'))
                }}">
                    {{ $order->status }}
                </span>
            </p>
            <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <hr>

        <h5 class="fw-bold mb-3">Danh sách sản phẩm</h5>
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
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
                            <td class="fw-bold">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-end mt-4">
            <h4 class="fw-bold">Tổng tiền: <span class="text-danger">
                {{ number_format($order->orderItems->sum(fn($item) => $item->price * $item->quantity), 0, ',', '.') }}₫
            </span></h4>
        </div>
    </div>
</div>
@endsection
