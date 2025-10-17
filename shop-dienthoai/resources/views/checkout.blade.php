@extends('layouts.customer')

@section('content')
<div class="row mb-4">
    <div class="col-12 text-center">
        <h2 class="fw-bold">Thanh toán đơn hàng</h2>
    </div>
</div>

@if(!empty($cart) && count($cart) > 0)
@php
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
@endphp

<div class="row">
    <!-- Form thông tin giao hàng -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="card-title mb-4 text-primary">Thông tin giao hàng</h5>

                {{-- ✅ GỘP FORM CHUNG cho COD và MOMO --}}
                <form id="checkout-form" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Họ và tên người nhận</label>
                        <input type="text" name="customer_name" id="customer_name"
                               class="form-control @error('customer_name') is-invalid @enderror"
                               value="{{ old('customer_name') }}" required>
                        @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="customer_phone" class="form-label">Số điện thoại</label>
                        <input type="text" name="customer_phone" id="customer_phone"
                               class="form-control @error('customer_phone') is-invalid @enderror"
                               value="{{ old('customer_phone') }}" required>
                        @error('customer_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="customer_address" class="form-label">Địa chỉ giao hàng</label>
                        <textarea name="customer_address" id="customer_address"
                                  class="form-control @error('customer_address') is-invalid @enderror"
                                  rows="3" required>{{ old('customer_address') }}</textarea>
                        @error('customer_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ✅ input ẩn để lưu phương thức thanh toán --}}
                    <input type="hidden" name="payment_method" id="payment_method" value="">

                    {{-- ✅ Nút thanh toán COD --}}
                    <button type="submit" formaction="{{ route('orders.store') }}" 
                            id="checkout-cod" class="btn btn-success w-100 py-2 mb-3">
                        <span><i class="fas fa-money-check-alt"></i> Xác nhận đặt hàng (COD)</span>
                    </button>

                    {{-- ✅ Nút thanh toán MoMo --}}
                    <input type="hidden" name="total_momo" value="{{ $total }}">
                    <button type="submit" formaction="{{ route('momo.payment') }}" 
                            id="checkout-momo" class="btn btn-outline-danger w-100 py-2">
                        <i class="fas fa-wallet"></i> Thanh toán bằng MoMo
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Tóm tắt đơn hàng -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <h5 class="card-title mb-4 text-primary">Đơn hàng của bạn</h5>

                <ul class="list-group list-group-flush">
                    @foreach($cart as $id => $item)
                        @php $subtotal = $item['price'] * $item['quantity']; @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $item['name'] }} (x{{ $item['quantity'] }})
                            <span class="fw-bold">{{ number_format($subtotal, 0, ',', '.') }}₫</span>
                        </li>
                    @endforeach
                </ul>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h5 class="fw-bold">Tổng tiền:</h5>
                    <h4 class="text-danger fw-bold">{{ number_format($total, 0, ',', '.') }}₫</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="text-center mt-5">
    <h4>Giỏ hàng của bạn đang trống</h4>
    <a href="{{ route('home') }}" class="btn btn-primary mt-3">
        <i class="fas fa-arrow-left"></i> Quay lại mua sắm
    </a>
</div>
@endif
@endsection

@section('scripts')
<script>
    // ✅ Gán phương thức thanh toán đúng khi người dùng nhấn nút
    document.getElementById('checkout-cod').addEventListener('click', function() {
        document.getElementById('payment_method').value = 'COD';
    });

    document.getElementById('checkout-momo').addEventListener('click', function() {
        document.getElementById('payment_method').value = 'MoMo';
    });
</script>
@endsection
