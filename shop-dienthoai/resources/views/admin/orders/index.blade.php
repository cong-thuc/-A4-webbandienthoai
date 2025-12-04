@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">
            <i class="fas fa-shopping-cart me-2"></i> Danh sách Đơn hàng
        </h4>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.orders.export') }}" class="btn btn-success">
                <i class="fas fa-file-excel me-1"></i> Xuất Excel
            </a>
        </div>
    </div>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="fas fa-search text-muted"></i>
                </span>
                <input type="text" name="keyword" value="{{ request('keyword') }}" 
                       class="form-control border-start-0" placeholder="Tìm theo tên, SĐT hoặc địa chỉ...">
            </div>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-filter me-1"></i> Lọc
            </button>
        </div>
    </form>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%" class="py-3">#</th>
                            <th class="py-3">Khách hàng</th>
                            <th class="py-3">SĐT</th>
                            <th class="py-3">Trạng thái</th>
                            <th class="py-3">PT Thanh toán</th>
                            <th class="py-3">Ngày đặt</th>
                            <th width="15%" class="py-3 text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $index => $order)
                            <tr class="align-middle">
                                <td class="fw-semibold">{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $order->name }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>
                                    @php
                                        $statusClass = 'bg-secondary';
                                        $statusIcon = 'fa-question-circle';
                                        switch ($order->status) {
                                            case 'Chờ xác nhận': $statusClass = 'bg-warning text-dark'; $statusIcon = 'fa-clock'; break;
                                            case 'Chờ thanh toán': $statusClass = 'bg-primary'; $statusIcon = 'fa-credit-card'; break;
                                            case 'Đang giao': $statusClass = 'bg-info text-dark'; $statusIcon = 'fa-truck'; break;
                                            case 'Đã giao': case 'Đã thanh toán': $statusClass = 'bg-success'; $statusIcon = 'fa-check-circle'; break;
                                            case 'Đã hủy': case 'Thanh toán thất bại': $statusClass = 'bg-danger'; $statusIcon = 'fa-times-circle'; break;
                                        }
                                    @endphp
                                    <span class="badge rounded-pill py-2 px-3 {{ $statusClass }}">
                                        <i class="fas {{ $statusIcon }} me-1"></i> {{ $order->status }}
                                    </span>
                                </td>
                                <td>
                                    {{-- Chuyển về chữ thường trước khi so sánh để chính xác nhất --}}
                                    @if(strtolower($order->payment_method) == 'momo')
                                        <span class="badge" style="background-color: #A60067; color: white;">MoMo</span>
                                    @else
                                        <span class="badge bg-secondary">COD</span>
                                    @endif
                                </td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary px-3 rounded-pill" title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        
                                        <button type="button" class="btn btn-sm btn-warning px-3 rounded-pill" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#updateStatusModal-{{ $order->id }}" 
                                                title="Cập nhật trạng thái">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </div>

                                    {{-- MODAL CẬP NHẬT TRẠNG THÁI --}}
                                    <div class="modal fade" id="updateStatusModal-{{ $order->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning text-dark">
                                                    <h5 class="modal-title fw-bold">Cập nhật đơn hàng #{{ $order->id }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body text-start">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Trạng thái hiện tại:</label>
                                                            <span class="badge {{ $statusClass }} ms-2">{{ $order->status }}</span>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="status-{{ $order->id }}" class="form-label fw-bold">Chọn trạng thái mới:</label>
                                                            <select name="status" id="status-{{ $order->id }}" class="form-select">
                                                                @php
                                                                    // 1. Xác định danh sách trạng thái theo quy trình
                                                                    if ($order->payment_method == 'momo') {
                                                                        $availableStatuses = [
                                                                            'Chờ thanh toán', 
                                                                            'Thanh toán thất bại', 
                                                                            'Đã thanh toán', 
                                                                            'Đang giao', 
                                                                            'Đã giao', 
                                                                            'Đã hủy'
                                                                        ];
                                                                    } else {
                                                                        $availableStatuses = [
                                                                            'Chờ xác nhận', 
                                                                            'Đang giao', 
                                                                            'Đã giao', 
                                                                            'Đã hủy'
                                                                        ];
                                                                    }

                                                                    // 2. Tìm vị trí (index) của trạng thái hiện tại trong mảng
                                                                    // Nếu không tìm thấy (ví dụ trạng thái lạ), mặc định là -1
                                                                    $currentIndex = array_search($order->status, $availableStatuses);
                                                                    if ($currentIndex === false) {
                                                                        $currentIndex = -1;
                                                                    }
                                                                @endphp

                                                                @foreach($availableStatuses as $index => $status)
                                                                    @php
                                                                        // Logic khóa:
                                                                        // 1. Nếu trạng thái là bước cũ (index < currentIndex) -> KHÓA
                                                                        // 2. Nếu trạng thái hiện tại là 'Đã giao' và tùy chọn là 'Đã hủy' -> KHÓA CHẶT
                                                                        $isDisabled = ($index < $currentIndex) || ($order->status == 'Đã giao' && $status == 'Đã hủy');
                                                                    @endphp

                                                                    <option value="{{ $status }}" 
                                                                        {{ $order->status == $status ? 'selected' : '' }}
                                                                        {{ $isDisabled ? 'disabled' : '' }}>
                                                                        
                                                                        {{ $status }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @if($currentIndex >= 0)
                                                                <div class="form-text text-muted small mt-1">
                                                                    <i class="fas fa-info-circle"></i> Các trạng thái trước đó đã bị khóa theo quy trình.
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- KẾT THÚC MODAL --}}

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <span class="text-muted">Không có đơn hàng nào</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="d-flex justify-content-center mt-3">
                {{-- {{ $orders->links() }} --}}
            </div>
        </div>
    </div>
</div>
@endsection