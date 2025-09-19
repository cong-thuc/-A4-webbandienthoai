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
                            <th class="py-3">Địa chỉ</th>
                            <th class="py-3">Trạng thái</th>
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
                                <td class="text-truncate" style="max-width: 200px;" title="{{ $order->address }}">
                                    {{ $order->address }}
                                </td>
                                <td>
                                    <span class="badge rounded-pill py-2 px-3 bg-{{ 
                                        $order->status == 'Chờ xác nhận' ? 'warning' : 
                                        ($order->status == 'Đang giao' ? 'info' : 
                                        ($order->status == 'Đã giao' ? 'success' : 'danger')) 
                                    }}">
                                        <i class="fas {{ 
                                            $order->status == 'Chờ xác nhận' ? 'fa-clock' : 
                                            ($order->status == 'Đang giao' ? 'fa-truck' : 
                                            ($order->status == 'Đã giao' ? 'fa-check-circle' : 'fa-times-circle')) 
                                        }} me-1"></i>
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" 
                                           class="btn btn-sm btn-primary px-3 rounded-pill"
                                           title="Xem chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.orders.edit', $order->id) }}" 
                                           class="btn btn-sm btn-warning px-3 rounded-pill"
                                           title="Cập nhật">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-shopping-cart fa-2x text-muted mb-2"></i>
                                        <span class="text-muted">Không có đơn hàng nào</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection