@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Cập nhật trạng thái Đơn hàng #{{ $order->id }}</h4>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="status" class="form-label fw-bold">Trạng thái đơn hàng</label>
                @php
                    // DANH SÁCH MỚI: Bao gồm TẤT CẢ các trạng thái có thể có
                    $allStatuses = [
                        'Chờ xác nhận',       // Trạng thái mặc định cho COD
                        'Chờ thanh toán',      // Trạng thái chờ của MoMo
                        'Đã thanh toán',       // Trạng thái MoMo thành công (admin có thể chuyển sang 'Đang giao')
                        'Đang giao',
                        'Đã giao',
                        'Đã hủy',
                        'Thanh toán thất bại' // Trạng thái MoMo thất bại (admin có thể chuyển sang 'Đã hủy')
                    ];
                @endphp
                <select name="status" id="status" class="form-select" required>
                    @foreach($allStatuses as $status)
                        {{-- Hiển thị tất cả trạng thái, và chọn trạng thái hiện tại của đơn hàng --}}
                        <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>

                @error('status')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Cập nhật
            </button>
        </form>
    </div>
</div>
@endsection