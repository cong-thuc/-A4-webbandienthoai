@extends('layouts.customer')

@section('content')
<!-- Banner Hero -->
<div class="hero-section">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Chào mừng đến với Phone Shop</h1>
        <p>Khám phá sản phẩm mới nhất & ưu đãi cực hấp dẫn</p>
        <a href="#products" class="hero-button">Mua sắm ngay</a>
    </div>
    <div class="hero-slideshow">
        <img src="{{ asset('storage/products/banner1.jpg') }}" alt="Banner 1" width="100%" class="slide active">
        <img src="{{ asset('storage/products/banner2.jpg') }}" alt="Banner 2" width="100%" class="slide active">
        <img src="{{ asset('storage/products/banner3.jpg') }}" alt="Banner 3" width="100%" class="slide active">
    </div>
</div>

<!-- Sản phẩm mới nhất -->
<div class="container" id="products">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h2 class="fw-bold">SẢN PHẨM NỔI BẬT</h2>
        </div>
    </div>

    <div class="row g-4">
        @foreach ($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm border-0 rounded-4 product-card overflow-hidden">
                    <a href="{{ route('products.show', $product->id) }}">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top p-3" style="height: 250px; object-fit: contain;" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/250x250?text=No+Image" class="card-img-top p-3" alt="No Image">
                        @endif
                    </a>
                    <div class="card-body d-flex flex-column text-center">
                        <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                        <p class="card-text text-danger fw-bold">{{ number_format($product->price, 0, ',', '.') }}₫</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary mt-auto rounded-pill">
                            <i class="fas fa-eye me-1"></i>Xem chi tiết
                        </a>
                        <a href="{{ route('cart.buyNow', $product->id) }}" class="btn btn-danger mt-2 rounded-pill">
                            <i class="fas fa-shopping-cart me-1"></i>Mua ngay
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

<!-- CSS -->
<style>
.hero-section {
    position: relative;
    height: 500px;
    overflow: hidden;
    border-radius: 12px;
    margin-bottom: 40px;
}
.hero-slideshow {
    position: absolute;
    width: 100%;
    height: 100%;
    z-index: 1;
}
.hero-slideshow img.slide {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    opacity: 0;
    transition: opacity 1s ease-in-out;
}
.hero-slideshow img.active {
    opacity: 1;
}
.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 2;
}
.hero-content {
    position: absolute;
    z-index: 3;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: #fff;
}
.hero-content h1 {
    font-size: 48px;
    font-weight: bold;
}
.hero-content p {
    font-size: 18px;
    margin: 20px 0;
}
.hero-button {
    background: #fff;
    color: #0d6efd;
    padding: 12px 30px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.3s, color 0.3s;
}
.hero-button:hover {
    background: #0d6efd;
    color: #fff;
}
/* Hiệu ứng hover cho ảnh sản phẩm */
.product-card img {
    transition: transform 0.3s ease;
}
.product-card:hover img {
    transform: scale(1.05);
}
</style>

<!-- JS -->
@section('scripts')
<script>
// Chuyển slideshow tự động
let slides = document.querySelectorAll('.hero-slideshow .slide');
let index = 0;

setInterval(() => {
    slides[index].classList.remove('active');
    index = (index + 1) % slides.length;
    slides[index].classList.add('active');
}, 5000);
</script>
@endsection
