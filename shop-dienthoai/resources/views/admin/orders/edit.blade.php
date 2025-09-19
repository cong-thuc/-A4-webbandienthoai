@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Cập nhật trạng thái Đơn hàng</h4>
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
                <label for="status" class="form-label">Trạng thái</label>
                @php
                    $statuses = ['Chờ xác nhận', 'Đang giao', 'Đã giao', 'Đã hủy'];
                    $currentIndex = array_search($order->status, $statuses);
                @endphp
                <select name="status" id="status" class="form-select" required>
                    @foreach($statuses as $index => $status)
                        <option value="{{ $status }}"
                            {{ $order->status == $status ? 'selected' : '' }}
                            {{ $index < $currentIndex ? 'disabled' : '' }}>
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
