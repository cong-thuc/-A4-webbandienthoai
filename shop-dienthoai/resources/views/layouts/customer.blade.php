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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- FontAwesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- CSS thuần -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

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

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
            --text-color: #334155;
            --text-light: #64748b;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            background-color: #f5f7fa;
            line-height: 1.6;
            scroll-behavior: smooth;
        }
        
        /* Navbar */
        .navbar {
            background-color: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            padding: 0.8rem 0;
            transition: var(--transition);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .navbar.scrolled {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: var(--transition);
            padding: 0;
            margin-right: 2rem;
        }
        
        .navbar-brand:hover {
            color: var(--primary-hover);
        }
        
        .navbar-brand i {
            font-size: 1.8rem;
        }
        
        .navbar-brand img {
            height: 40px;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover img {
            transform: scale(1.05);
        }
        
        .nav-item {
            margin: 0 0.3rem;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--text-color);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: var(--transition);
            position: relative;
            font-size: 0.95rem;
        }
        
        .nav-link:hover {
            color: var(--primary-color);
            transform: translateY(-2px);
            background-color: rgba(37, 99, 235, 0.1);
        }
        
        .nav-link.active {
            color: var(--primary-color);
            font-weight: 600;
            background-color: rgba(37, 99, 235, 0.15);
        }
        
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60%;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 3px;
        }
        
        .nav-link i {
            margin-right: 0.3rem;
        }
        
        .navbar-nav {
            gap: 0.5rem;
        }
        
        .badge-cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            font-size: 0.65rem;
            min-width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }
        
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 0.5rem;
            border-radius: 0.5rem;
        }
        
        .dropdown-item {
            padding: 0.5rem 1.5rem;
            transition: all 0.2s;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
            padding-left: 1.7rem;
        }
        
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            font-size: 1.25rem;
        }
        
        .navbar-toggler:focus {
            box-shadow: none;
        }
        
        /* Main content */
        main {
            padding-top: 5rem;
            min-height: calc(100vh - 300px);
        }
        
        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark-color), #0f172a);
            color: var(--light-color);
            position: relative;
        }
        
        footer h5 {
            font-weight: 600;
            margin-bottom: 1.2rem;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        footer h5::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background-color: var(--accent-color);
            transition: width 0.3s ease;
        }
        
        footer h5:hover::after {
            width: 70px;
        }
        
        footer a {
            color: #cbd5e1;
            text-decoration: none;
            transition: var(--transition);
            display: inline-block;
            margin-bottom: 0.5rem;
        }
        
        footer a:hover {
            color: white;
            transform: translateX(5px);
        }
        
        .footer-bottom {
            background-color: rgba(0, 0, 0, 0.2);
            padding: 1rem 0;
        }
        
        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            z-index: 999;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        
        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            background-color: var(--primary-hover);
            transform: translateY(-3px);
        }
        
        /* Toast notification */
        .toast-notification {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            min-width: 300px;
        }
        
        /* Animation */
        .animate-hover:hover {
            animation: pulse 1s;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        /* Responsive adjustments */
        @media (min-width: 992px) {
            .navbar-expand-lg .navbar-nav .nav-link {
                padding: 0.5rem 1rem;
            }
            
            .dropdown-menu {
                min-width: 200px;
            }
        }
        
        @media (max-width: 1199.98px) {
            .navbar-brand span {
                font-size: 1.2rem;
            }
        }
        
        @media (max-width: 991.98px) {
            .navbar-collapse {
                padding: 1rem;
                background-color: white;
                border-radius: 0.5rem;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                margin-top: 1rem;
            }
            
            .nav-link {
                padding: 0.75rem 1.25rem;
                border-radius: 0.5rem;
                margin-bottom: 0.25rem;
            }
            
            .nav-link.active {
                background-color: rgba(37, 99, 235, 0.1);
            }
            
            .nav-link.active::after {
                display: none;
            }
            
            .back-to-top {
                width: 40px;
                height: 40px;
                font-size: 1rem;
                bottom: 20px;
                right: 20px;
            }
        }
        
        @media (max-width: 767.98px) {
            main {
                padding-top: 4rem;
            }
            
            footer .col-md-6 {
                margin-bottom: 2rem;
            }
        }
    </style>
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
<main class="animate__animated animate__fadeIn">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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