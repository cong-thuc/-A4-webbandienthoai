<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhoneShop - Website bán điện thoại</title>
    <meta name="description" content="PhoneShop - Chuyên cung cấp điện thoại di động chính hãng với giá tốt nhất thị trường">
    <meta name="keywords" content="điện thoại, smartphone, mua điện thoại, giá rẻ, chính hãng">
    <meta name="author" content="PhoneShop">
    
    <!-- Preconnect to external resources -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- CSS thuần -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Store",
      "name": "PhoneShop",
      "description": "Chuyên cung cấp điện thoại di động chính hãng với giá tốt nhất thị trường",
      "url": "https://phoneshop.vn",
      "logo": "https://phoneshop.vn/images/logo.png",
      "telephone": "+841900113114",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "123 Đường ABC",
        "addressLocality": "Hà Nội",
        "addressRegion": "HN",
        "postalCode": "100000",
        "addressCountry": "VN"
        },
    }
    </script>
    
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand animate-hover" href="/">
            <img src="{{ asset('storage/products/logo-phoneshop-xp.png') }}" alt="Phone Shop" style="height: 50px; width: auto; margin-right: 10px;">
            <span class="d-none d-xl-inline" style="font-size: 1.4rem; font-weight: 700; color: var(--primary-color);">PhoneShop</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                        <i class="fas fa-home d-lg-none me-2"></i> Trang chủ
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="/products">
                        <i class="fas fa-boxes d-lg-none me-2"></i> Sản phẩm
                    </a>
                </li>
                <li class="nav-item position-relative">
                    <a class="nav-link {{ request()->is('cart') ? 'active' : '' }}" href="/cart">
                        <i class="fas fa-shopping-cart me-1"></i> Giỏ hàng
                        @php
                            $cartCount = array_sum(array_column(session('cart', []), 'quantity'));
                        @endphp
                        @if($cartCount > 0)
                            <span class="badge bg-danger rounded-pill badge-cart-count">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('orders') ? 'active' : '' }}" href="/orders">
                        <i class="fas fa-clipboard-list d-lg-none me-2"></i> Đơn hàng
                    </a>
                </li>
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarAccountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarAccountDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('account.index') }}">
                                    <i class="fas fa-user me-2"></i> Tài khoản của tôi
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="dropdown-item" type="submit">
                                        <i class="fas fa-sign-out-alt me-2"></i> Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="/login">
                            <i class="fas fa-sign-in-alt d-lg-none me-2"></i> Đăng nhập
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="/register">
                            <i class="fas fa-user-plus d-lg-none me-2"></i> Đăng ký
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Main content -->
<main class="">
    <div class="container">
        @yield('content')
    </div>
</main>

<!-- Footer -->
<footer class="pt-5">
    <div class="container">
        <div class="row g-4">
            <!-- Cột 1: Tổng đài hỗ trợ -->
            <div class="col-lg-4 col-md-6">
                <h5><i class="fas fa-headset me-2"></i> Tổng đài hỗ trợ</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-phone-alt me-2"></i> Gọi mua: <a href="tel:1900232460">1900 113 114</a> (8:00 - 21:30)</li>
                    <li><i class="fas fa-exclamation-circle me-2"></i> Khiếu nại: <a href="tel:18001062">1800 1000</a> (8:00 - 21:30)</li>
                    <li><i class="fas fa-shield-alt me-2"></i> Bảo hành: <a href="tel:1900232464">1900 222 368</a> (8:00 - 21:00)</li>
                </ul>
                
                <div class="mt-4">
                    <h6 class="mb-3">Kết nối với chúng tôi</h6>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white fs-5" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white fs-5" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white fs-5" title="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-white fs-5" title="TikTok"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>

            <!-- Cột 2: Về công ty -->
            <div class="col-lg-4 col-md-6">
                <h5><i class="fas fa-building me-2"></i> Về công ty</h5>
                <ul class="list-unstyled">
                    <li><a href="#"><i class="fas fa-chevron-right me-2"></i> Giới thiệu công ty</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right me-2"></i> Tuyển dụng</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right me-2"></i> Gửi góp ý, khiếu nại</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right me-2"></i> Hệ thống cửa hàng</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right me-2"></i> Chính sách bảo mật</a></li>
                </ul>
            </div>

            <!-- Cột 3: Thông tin khác -->
            <div class="col-lg-4 col-md-6">
                <h5><i class="fas fa-info-circle me-2"></i> Thông tin khác</h5>
                <ul class="list-unstyled">
                    <li><a href="#"><i class="fas fa-chevron-right me-2"></i> Tích điểm Quà tặng VIP</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right me-2"></i> Bán hàng CTV chiết khấu cao</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right me-2"></i> Chính sách bảo hành</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right me-2"></i> Hướng dẫn mua hàng</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right me-2"></i> Chính sách đổi trả</a></li>
                </ul>
                
                <div class="mt-4">
                    <h6 class="mb-3">Đăng ký nhận khuyến mãi</h6>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Email của bạn">
                        <button class="btn btn-primary" type="button">Đăng ký</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom mt-5">
        <div class="container text-center py-3">
            <p class="mb-0">&copy; 2025 <strong>PhoneShop</strong>. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Back to top button -->
<div class="back-to-top">
    <i class="fas fa-arrow-up"></i>
</div>

<!-- Toast notification placeholder -->
<div id="toast-notification" class="toast-notification" style="display: none;">
    <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto" id="toast-title">Thông báo</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-message"></div>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="{{ asset('js/app.js') }}"></script>

<script>
// Navbar scroll effect
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');
    const backToTop = document.querySelector('.back-to-top');
    
    // Scroll event for navbar
    window.addEventListener('scroll', function() {
        if (window.scrollY > 30) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        // Back to top button
        if (window.scrollY > 300) {
            backToTop.classList.add('show');
        } else {
            backToTop.classList.remove('show');
        }
    });
    
    // Back to top functionality
    backToTop.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Toast notification function
    window.showToast = function(title, message, type = 'info') {
        const toastEl = document.getElementById('toast-notification');
        const toastTitle = document.getElementById('toast-title');
        const toastMessage = document.getElementById('toast-message');
        
        toastTitle.textContent = title;
        toastMessage.textContent = message;
        
        // Set type (you can add more types as needed)
        const toast = toastEl.querySelector('.toast');
        toast.className = 'toast show';
        if (type === 'success') {
            toast.classList.add('bg-success', 'text-white');
        } else if (type === 'error') {
            toast.classList.add('bg-danger', 'text-white');
        }
        
        toastEl.style.display = 'block';
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            toastEl.style.display = 'none';
        }, 5000);
    };
    
    // Close toast when clicking close button
    document.querySelector('.btn-close').addEventListener('click', function() {
        document.getElementById('toast-notification').style.display = 'none';
    });
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
</script>

@yield('scripts')
</body>
</html>