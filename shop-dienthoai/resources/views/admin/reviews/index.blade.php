@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Quản lý Đánh giá Sản phẩm</h1>
    <p class="mb-4">Danh sách các đánh giá từ khách hàng.</p>

    {{-- Hiển thị thông báo thành công --}}

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách Đánh giá</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Khách hàng</th>
                            <th class="text-center">Đánh giá</th>
                            <th>Bình luận</th>
                            <th>Phản hồi admin</th>
                            <th class="text-center">Trạng thái</th> {{-- <-- THÊM CỘT NÀY --}}
                            <th class="text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reviews as $review)
                        {{-- Thêm class để làm mờ dòng nếu bị ẩn --}}
                        <tr class="{{ !$review->is_visible ? 'table-secondary text-muted' : '' }}">
                            <td>{{ $review->product->name ?? 'N/A' }}</td>
                            <td>{{ $review->user->name ?? 'N/A' }}</td>
                            <td class="text-center">
                                @if($review->rating)
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                    @endfor
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>{{ Str::limit($review->comment, 100) }}</td>
                            <td>{{ $review->admin_reply }}</td>
                            
                            {{-- THÊM TD HIỂN THỊ TRẠNG THÁI --}}
                            <td class="text-center">
                                @if($review->is_visible)
                                    <span class="badge bg-success">Đang hiển thị</span>
                                @else
                                    <span class="badge bg-danger">Đang ẩn</span>
                                @endif
                            </td>
                            
                            {{-- CẬP NHẬT TD THAO TÁC --}}
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Giữ lại nút Phản hồi nếu bạn có chức năng này --}}
                                    <a href="{{ route('admin.reviews.show', $review->id) }}" class="btn btn-sm btn-info" title="Xem & Phản hồi"><i class="fas fa-reply"></i></a>

                                    {{-- Form Ẩn/Hiện --}}
                                    <form action="{{ route('admin.reviews.toggleVisibility', $review->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn {{ $review->is_visible ? 'ẩn' : 'hiện' }} đánh giá này?');">
                                        @csrf
                                        <button type="submit" class="btn btn-sm {{ $review->is_visible ? 'btn-warning' : 'btn-success' }}" title="{{ $review->is_visible ? 'Ẩn đánh giá' : 'Hiện đánh giá' }}">
                                            <i class="fas {{ $review->is_visible ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            {{-- Cập nhật colspan cho đúng số cột --}}
                            <td colspan="7" class="text-center">Chưa có đánh giá nào.</td> 
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{-- Phân trang --}}
            <div class="d-flex justify-content-center">
                {{ $reviews->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- Thêm script nếu cần --}}
@endsection