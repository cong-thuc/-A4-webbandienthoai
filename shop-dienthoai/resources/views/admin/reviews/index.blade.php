@extends('layouts.admin')
@section('content')
<h3>Quản lý đánh giá sản phẩm</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Khách hàng</th>
            <th>Đánh giá</th>
            <th>Bình luận</th>
            <th>Phản hồi admin</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reviews as $review)
        <tr>
            <td>{{ $review->product->name }}</td>
            <td>{{ $review->user->name }}</td>
            <td>
                @for($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}"></i>
                @endfor
            </td>
            <td>{{ $review->comment }}</td>
            <td>{{ $review->admin_reply }}</td>
            <td>
                <a href="{{ route('admin.reviews.show', $review->id) }}" class="btn btn-sm btn-primary">Phản hồi</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $reviews->links() }}
@endsection