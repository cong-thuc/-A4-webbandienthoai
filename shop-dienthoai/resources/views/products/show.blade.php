@extends('layouts.customer')

@section('content')
<div class="container py-5">

    <div class="row g-5 align-items-center">
        <!-- Ảnh sản phẩm -->
        <div class="col-md-6 text-center">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-4" style="max-height: 450px; object-fit: contain;" alt="{{ $product->name }}">
            @else
                <img src="https://via.placeholder.com/400x400?text=No+Image" class="img-fluid rounded-4" alt="No Image">
            @endif
        </div>

        <!-- Thông tin sản phẩm -->
        <div class="col-md-6">
            <h2 class="fw-bold mb-3">{{ $product->name }}</h2>

            <h4 class="text-danger fw-bold mb-4">{{ number_format($product->price, 0, ',', '.') }}₫</h4>

            <p>
                <strong>Số lượng trong kho:</strong>
                <span class="badge bg-info">{{ $product->quantity }}</span>
            </p>

            <!-- Nút bấm hiện mô tả & Thêm vào giỏ hàng cùng hàng -->
            <div class="d-flex flex-wrap gap-3 mb-3">
                <button id="toggleDescriptionBtn" class="btn btn-outline-primary rounded-pill">
                    <i class="fas fa-info-circle"></i> Thông tin sản phẩm
                </button>

                <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success rounded-pill">
                    <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
                </a>

                <a href="{{ route('cart.buyNow', $product->id) }}" class="btn btn-danger rounded-pill">
                    <i class="fas fa-shopping-cart me-1"></i>Mua ngay
                </a>
                
            </div>

            <!-- Khối mô tả -->
            <div id="descriptionContent" class="text-muted border rounded-4 p-3 mb-4" style="display: none; white-space: pre-line;">
                {{ $product->description ?? 'Đang cập nhật mô tả sản phẩm...' }}
            </div>

            <!-- Quay lại -->
            <div>

            </div>
        </div>
    </div>
    <a href="{{ route('products.index') }}" class="btn btn-link">
        <i class="fas fa-arrow-left"></i> Quay lại danh sách sản phẩm
    </a>

</div>
@endsection

@section('scripts')
<script>
// Toggle hiện/ẩn mô tả sản phẩm
const toggleBtn = document.getElementById('toggleDescriptionBtn');
const descriptionContent = document.getElementById('descriptionContent');

toggleBtn.addEventListener('click', function() {
    if (descriptionContent.style.display === 'none') {
        descriptionContent.style.display = 'block';
        toggleBtn.innerHTML = '<i class="fas fa-times"></i> Ẩn thông tin sản phẩm';
    } else {
        descriptionContent.style.display = 'none';
        toggleBtn.innerHTML = '<i class="fas fa-info-circle"></i> Thông tin sản phẩm';
    }
});
</script>
@endsection
