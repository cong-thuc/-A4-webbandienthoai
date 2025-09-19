@extends('layouts.customer')

@section('content')
<div class="row mb-4">
    <div class="col-12 text-center">
        <h2 class="fw-bold">Giỏ hàng của bạn</h2>
    </div>
</div>

@if(session('error'))
    <div class="alert alert-danger text-center">{{ session('error') }}</div>
@endif

@if(!empty($cartItems) && count($cartItems) > 0)
<div class="table-responsive">
    <table class="table table-hover align-middle shadow-sm bg-white rounded-4 overflow-hidden">
        <thead class="table-light">
            <tr class="text-center">
                <th>Ảnh</th>
                <th>Sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach ($cartItems as $item)
                @php
                    $subtotal = $item['product']->price * $item['quantity'];
                    $total += $subtotal;
                @endphp
                <tr class="text-center">
                    <td>
                        @if($item['product']->image)
                            <img src="{{ asset('storage/' . $item['product']->image) }}" class="rounded-3 img-thumbnail" style="width: 70px; height: 70px; object-fit: cover;" alt="{{ $item['product']->name }}">
                        @else
                            <img src="https://via.placeholder.com/70x70?text=No+Image" class="rounded-3 img-thumbnail" alt="No Image">
                        @endif
                    </td>
                    <td class="fw-bold">{{ $item['product']->name }}</td>
                    <td class="text-danger">{{ number_format($item['product']->price, 0, ',', '.') }}₫</td>
                    <td>
                        <form action="{{ route('cart.update', $item['product']->id) }}" method="POST" class="d-flex align-items-center justify-content-center gap-2">
                            @csrf
                            <input type="number" name="quantity" min="1" value="{{ $item['quantity'] }}" class="form-control form-control-sm text-center quantity-input" style="width: 70px;">
                            {{-- Đã bỏ nút cập nhật --}}
                        </form>
                    </td>
                    <td>{{ number_format($subtotal, 0, ',', '.') }}₫</td>
                    <td>
                        <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-between align-items-center mt-4">
    <h4 class="fw-bold">
        Tổng cộng: <span class="text-danger">{{ number_format($total, 0, ',', '.') }}₫</span>
    </h4>
    <a href="{{ route('orders.create') }}" class="btn btn-success btn-lg rounded-pill">
        <i class="fas fa-money-check-alt"></i> Tiến hành thanh toán
    </a>
</div>
@else
<div class="text-center mt-5">
    <h4>Giỏ hàng của bạn đang trống</h4>
    <a href="{{ route('home') }}" class="btn btn-primary mt-3">
        <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
    </a>
</div>
@endif
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.quantity-input').forEach(function(input) {
        input.addEventListener('change', function() {
            let form = this.form;
            let url = form.action;
            let data = new FormData(form);

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': data.get('_token'),
                },
                body: data
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    // cập nhật lại subtotal trong hàng
                    this.closest('tr').querySelector('td:nth-child(5)').innerText = res.subtotal;
                    // cập nhật lại tổng cộng
                    document.querySelector('h4 .text-danger').innerText = res.total;
                } else {
                    alert(res.message);
                }
            })
            .catch(err => console.error(err));
        });
        input.form.addEventListener('submit', function(e) {
            e.preventDefault();
        });
    });
});
</script>
