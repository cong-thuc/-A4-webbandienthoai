@extends('layouts.customer')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <form action="{{ route('products.index') }}" method="GET" class="d-flex justify-content-center">
            <input type="text" name="search" class="form-control w-50 me-2" placeholder="Tìm kiếm sản phẩm..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-outline-primary rounded-pill">Tìm kiếm</button>
        </form>
    </div>
    <!-- Bộ lọc danh mục -->
    <div class="mb-5 d-flex flex-wrap gap-2 justify-content-center">
        <a href="{{ route('products.index') }}" class="btn btn-outline-primary rounded-pill px-4 {{ request()->routeIs('products.index') ? 'active' : '' }}">
            Tất cả
        </a>
        @foreach($categories as $category)
            <a href="{{ route('products.category', $category->id) }}"
               class="btn btn-outline-primary rounded-pill px-4 {{ (isset($currentCategory) && $currentCategory->id == $category->id) ? 'active' : '' }}">
                {{ $category->name }}
            </a>
        @endforeach
    </div>

    <!-- Thanh tìm kiếm -->
    @if(request('search'))
    <div class="alert alert-info text-center">
        Kết quả tìm kiếm cho từ khóa: <strong>{{ request('search') }}</strong>
    </div>
    @endif

    <!-- Danh sách sản phẩm -->
    <div class="row g-3">
        @forelse ($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm border-0 rounded-4 product-card overflow-hidden position-relative">
                    <a href="{{ route('products.show', $product->id) }}">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top p-3" style="height: 250px; object-fit: contain;" alt="{{ $product->name }}">
                        @else
                            <img src="https://via.placeholder.com/250x250?text=No+Image" class="card-img-top p-3" alt="No Image">
                        @endif
                    </a>
                    <div class="card-body d-flex flex-column text-center">
                        <h5 class="card-title text-truncate">{{ $product->name }}</h5>
                        {{-- <p class="card-text small text-muted mb-2">
                            @if(!empty($product->description))
                                {{ Str::limit(strip_tags($product->description), 40) }}
                            @else
                                Mẫu mã đẹp, hiệu năng mạnh.
                            @endif
                        </p> --}}
                        <p class="text-danger fw-bold mb-3">{{ number_format($product->price, 0, ',', '.') }}₫</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary mt-auto rounded-pill">
                            <i class="fas fa-eye"></i> Xem chi tiết
                        </a>
                        <a href="{{ route('cart.buyNow', $product->id) }}" class="btn btn-danger mt-2 rounded-pill">
                            <i class="fas fa-shopping-cart me-1"></i>Mua ngay
                        </a>          
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <h4>Không tìm thấy sản phẩm nào.</h4>
            </div>
        @endforelse
    </div>

    <!-- Phân trang -->
    @if($products->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>
@endsection

@section('scripts')
<style>
/* Hover zoom */
.product-card img {
    transition: transform 0.3s ease;
}
.product-card:hover img {
    transform: scale(1.05);
}

/* Hover card đổ bóng */
.product-card:hover {
    box-shadow: 0 0 15px rgba(0,0,0,0.15);
}

/* Danh mục active */
.btn.active {
    background-color: #0d6efd;
    color: #fff;
}

/* Card spacing fix */
.card-body {
    padding: 1.2rem;
}
</style>
@endsection
