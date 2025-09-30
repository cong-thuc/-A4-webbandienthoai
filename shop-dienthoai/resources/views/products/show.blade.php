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

    <!-- Đánh giá & bình luận -->
    <div class="mt-4">
        <!-- Hiển thị điểm trung bình và nút viết đánh giá -->
        <div class="mb-3">
            <h5>Đánh giá sản phẩm</h5>
            <div>
                <span style="font-size:2rem; font-weight:bold;">
                    {{ number_format($product->reviews->avg('rating'), 1) }}/5
                </span>
                <span>
                    @for($i=1; $i<=5; $i++)
                        <i class="fas fa-star {{ $i <= round($product->reviews->avg('rating')) ? 'text-warning' : 'text-secondary' }}"></i>
                    @endfor
                </span>
                <span class="ms-2">{{ $product->reviews->count() }} lượt đánh giá</span>
            </div>
            <button class="btn btn-danger mt-2" data-bs-toggle="modal" data-bs-target="#reviewModal">
                Viết đánh giá
            </button>
        </div>

        <!-- Modal Viết Đánh Giá -->
        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="modal-content">
              @csrf
              <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Đánh giá & nhận xét</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3 text-center">
                  <label class="form-label fw-bold">Đánh giá chung:</label>
                  <div id="starRating">
                    @for($i=1; $i<=5; $i++)
                      <i class="fas fa-star star-select text-secondary" data-value="{{ $i }}" style="font-size:2rem; cursor:pointer;"></i>
                    @endfor
                  </div>
                  <input type="hidden" name="rating" id="ratingInput" required>
                </div>
                <div class="mb-3">
                  <label for="comment" class="form-label">Nhận xét của bạn:</label>
                  <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-danger w-100">Gửi đánh giá</button>
              </div>
            </form>
          </div>
        </div>

        <!-- Hiển thị các đánh giá -->
        <div>
            @foreach($product->reviews as $review)
                <div class="border rounded-3 p-2 mb-2">
                    <strong>{{ $review->user->name }}</strong> 
                    <span>
                        @for($i=1; $i<=5; $i++)
                            <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}"></i>
                        @endfor
                    </span>
                    <p class="mb-0">{{ $review->comment }}</p>
                    <small class="text-muted">{{ $review->created_at->format('d/m/Y H:i') }}</small>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Xử lý hiện/ẩn mô tả sản phẩm
    const toggleBtn = document.getElementById('toggleDescriptionBtn');
    const descriptionContent = document.getElementById('descriptionContent');
    if (toggleBtn && descriptionContent) {
        toggleBtn.addEventListener('click', function() {
            if (descriptionContent.style.display === 'none' || descriptionContent.style.display === '') {
                descriptionContent.style.display = 'block';
                toggleBtn.innerHTML = '<i class="fas fa-times"></i> Ẩn thông tin sản phẩm';
            } else {
                descriptionContent.style.display = 'none';
                toggleBtn.innerHTML = '<i class="fas fa-info-circle"></i> Thông tin sản phẩm';
            }
        });
    }

    // Xử lý chọn sao trong modal đánh giá
    var reviewModal = document.getElementById('reviewModal');
    if (reviewModal) {
        // Gán sự kiện click cho các ngôi sao ngay khi DOMContentLoaded,
        // không cần chờ 'shown.bs.modal' để tránh lỗi xung đột sự kiện (Z-index blocking).
        document.querySelectorAll('.star-select').forEach(function(star) {
            star.addEventListener('click', function() { // Dùng addEventListener thay vì onclick
                let value = parseInt(this.getAttribute('data-value')); // Lấy giá trị và chuyển sang số
                document.getElementById('ratingInput').value = value;
                
                // Tô màu các sao
                document.querySelectorAll('.star-select').forEach(function(s) {
                    let starValue = parseInt(s.getAttribute('data-value'));
                    // LOGIC ĐÃ SỬA: Tô màu nếu giá trị sao <= giá trị được chọn
                    s.classList.toggle('text-warning', starValue <= value);
                    s.classList.toggle('text-secondary', starValue > value);
                });
            });
        });

        // (Tùy chọn) Thêm logic reset màu sao khi modal đóng hoặc mở
        reviewModal.addEventListener('hidden.bs.modal', function () {
            // Đặt lại ngôi sao về màu xám khi modal đóng
            document.querySelectorAll('.star-select').forEach(function(s) {
                s.classList.remove('text-warning');
                s.classList.add('text-secondary');
            });
            document.getElementById('ratingInput').value = ''; // Reset giá trị
            document.getElementById('comment').value = ''; // Reset bình luận
        });
    }
});
</script>
@endsection