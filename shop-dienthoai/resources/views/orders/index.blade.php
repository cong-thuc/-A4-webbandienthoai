@extends('layouts.customer')

@section('content')
<div class="row mb-4">
    <div class="col-12 text-center">
        <h2 class="fw-bold">Đơn hàng của tôi</h2>
    </div>
</div>

@if($orders->count() > 0)
<div class="table-responsive shadow-sm rounded-4 p-3 bg-white">
    <table class="table table-hover align-middle text-center">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Ngày đặt</th>
                <th>Trạng thái</th>
                <th>Tổng tiền</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @foreach ($order->orderItems as $item)
                             {{ $item->product_name ?? ($item->product->name ?? '[Đã xóa]') }}{{ !$loop->last ? ', ' : '' }}
                        @endforeach
                    </td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <span class="badge bg-{{
                            $order->status == 'Chờ xác nhận' ? 'warning' :
                            ($order->status == 'Đang giao' ? 'info' :
                            ($order->status == 'Đã giao' ? 'success' : 'danger'))
                        }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="fw-bold text-danger">
                        {{ number_format($order->orderItems->sum(fn($item) => $item->price * $item->quantity), 0, ',', '.') }}₫
                    </td>
                    <td>
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill">
                            <i class="fas fa-eye"></i> Xem
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="text-center mt-5">
    <h4>Bạn chưa có đơn hàng nào</h4>
    <a href="{{ route('home') }}" class="btn btn-primary mt-3">
        <i class="fas fa-arrow-left"></i> Mua sắm ngay
    </a>
</div>
@endif
@endsection
