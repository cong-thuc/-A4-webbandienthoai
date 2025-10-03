@extends('layouts.admin')
@section('content')
<h4>Phản hồi đánh giá của khách hàng</h4>
<div class="mb-3">
    <strong>Sản phẩm:</strong> {{ $review->product->name }} <br>
    <strong>Khách hàng:</strong> {{ $review->user->name }} <br>
    <strong>Số sao:</strong> {{ $review->rating }} <br>
    <strong>Bình luận:</strong> {{ $review->comment }} <br>
</div>
<form method="POST" action="{{ route('admin.reviews.update', $review->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="admin_reply" class="form-label">Phản hồi của admin:</label>
        <textarea name="admin_reply" id="admin_reply" class="form-control" rows="3">{{ $review->admin_reply }}</textarea>
    </div>
    <button type="submit" class="btn btn-success">Gửi phản hồi</button>
    <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary ms-2">Quay lại</a>
</form>
@endsection