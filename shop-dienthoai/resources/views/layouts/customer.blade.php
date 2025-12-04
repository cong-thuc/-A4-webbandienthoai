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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    
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
                    <li class="nav-item dropdown me-2">
                        <a class="nav-link dropdown-toggle position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell fa-lg"></i>
                            {{-- Badge for notification count --}}
                            <span id="notification-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none; font-size: 0.6rem;">
                                0
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationDropdown" style="width: 300px; max-height: 400px; overflow-y: auto;">
                            <li><h6 class="dropdown-header">Thông báo mới</h6></li>
                            <li><hr class="dropdown-divider"></li>

                            {{-- Container for notification list --}}
                            <div id="notification-list">
                                <li class="text-center text-muted small py-2">Không có thông báo mới</li>
                            </div>
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

@auth
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let unreadCount = 0;

        function checkNewNotifications() {
            fetch('/notifications/check')
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        // 1. Cập nhật số lượng trên chuông
                        unreadCount += data.length;
                        updateNotificationBadge(unreadCount);

                        // 2. Xử lý từng thông báo
                        data.forEach(notification => {
                            
                            // ✅ ĐÃ XÓA: window.showToast (Không hiện bảng nổi nữa)

                            // ✅ GIỮ LẠI: Phát âm thanh
                            playNotificationSound();

                            // ✅ GIỮ LẠI: Thêm vào danh sách dropdown của chuông
                            addNotificationToDropdown(notification);
                        });
                    }
                })
                .catch(error => console.log('Lỗi:', error));
        }

        // Hàm cập nhật số đỏ trên chuông
        function updateNotificationBadge(count) {
            const badge = document.getElementById('notification-badge');
            if (count > 0) {
                badge.innerText = count;
                badge.style.display = 'block'; 
            } else {
                badge.style.display = 'none';
            }
        }

        // Hàm thêm thông báo vào danh sách xổ xuống
        function addNotificationToDropdown(notification) {
            const list = document.getElementById('notification-list');
            
            // Xóa dòng "Không có thông báo" nếu có
            if (list.querySelector('.text-muted')) {
                list.innerHTML = ''; 
            }

            // Tạo HTML cho thông báo mới
            const itemHtml = `
                <li>
                    <a class="dropdown-item d-flex align-items-start py-2" href="#">
                        <div class="me-2 text-success"><i class="fas fa-check-circle"></i></div>
                        <div>
                            <div class="small fw-bold">${notification.data.title}</div>
                            <div class="small text-muted text-wrap">${notification.data.message}</div>
                            <div class="small text-muted" style="font-size: 0.75rem;">Vừa xong</div>
                        </div>
                    </a>
                </li>
                <li><hr class="dropdown-divider m-0"></li>
            `;

            // Chèn lên đầu danh sách
            list.insertAdjacentHTML('afterbegin', itemHtml);
        }

        // Hàm phát âm thanh
        function playNotificationSound() {
            const audio = new Audio('https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3');
            audio.volume = 0.5;
            audio.play().catch(e => console.log('Chưa tương tác, không phát tiếng'));
        }

        // Chạy mỗi 5 giây
        setInterval(checkNewNotifications, 5000);
    });
</script>
@endauth

@yield('scripts')
</body>
</html>

<style>
    /* CSS cơ bản cho Chat Widget (Giữ nguyên) */
    .chatbot-icon {
        position: fixed; bottom: 20px; right: 20px; z-index: 1000; cursor: pointer;
        background-color: #007bff; color: white; border-radius: 50%; width: 60px; height: 60px;
        display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    .chat-container {
        position: fixed; bottom: 90px; right: 20px; width: 350px; height: 450px;
        background-color: white; border: 1px solid #ccc; border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3); display: none; flex-direction: column; z-index: 999;
    }
    .chat-header {
        background-color: #007bff; color: white; padding: 10px; border-top-left-radius: 9px;
        border-top-right-radius: 9px; font-weight: bold; display: flex; justify-content: space-between;
        align-items: center;
    }
    .chat-body {
        flex-grow: 1; padding: 15px; overflow-y: auto;
    }
    .chat-input {
        padding: 10px; border-top: 1px solid #eee; display: flex;
    }
    .chat-input input {
        flex-grow: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-right: 5px;
    }
    .message-user { text-align: right; margin-bottom: 8px; }
    .message-ai { text-align: left; margin-bottom: 8px; }
    .message-user span { background-color: #dcf8c6; padding: 8px; border-radius: 10px; display: inline-block; }
    .message-ai span { background-color: #f1f0f0; padding: 8px; border-radius: 10px; display: inline-block; }
    /* CSS Mới cho Quick Replies */
    .quick-replies {
        padding: 10px;
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        border-top: 1px solid #eee;
    }
    .quick-replies button {
        padding: 5px 10px;
        border: 1px solid #007bff;
        background-color: white;
        color: #007bff;
        border-radius: 20px;
        cursor: pointer;
        font-size: 12px;
        transition: background-color 0.2s;
    }
    .quick-replies button:hover {
        background-color: #e6f0ff;
    }
</style>

<div class="chatbot-icon" id="toggleChat">
    <i class="fas fa-comment-dots fa-2x"></i>
</div>

<div class="chat-container" id="chatWidget">
    <div class="chat-header">
        <span>🤖 Trợ lý AI Phone Shop</span>
        <span style="cursor: pointer;" onclick="document.getElementById('chatWidget').style.display = 'none';">X</span>
    </div>
    <div class="chat-body" id="chatBody">
        <div class="message-ai">
            <span>Xin chào Anh/Chị! Em là trợ lý AI của Phone Shop. Em rất sẵn lòng hỗ trợ Anh/Chị 😊</span>
        </div>
    </div>
    
    <div class="quick-replies">
        <button onclick="sendQuickReply('iPhone mới nhất là gì?')">📱 iPhone Mới</button>
        <button onclick="sendQuickReply('Điện thoại Android nào tốt?')">🤖 Android Giá Tốt</button>
        <button onclick="sendQuickReply('Chính sách bảo hành như thế nào?')">🛡️ Bảo hành</button>
        <button onclick="sendQuickReply('Phương thức thanh toán?')">💳 Thanh toán</button>
    </div>
    <div class="chat-input">
        <input type="text" id="chatInput" placeholder="Nhập tin nhắn..." onkeypress="if(event.keyCode==13) sendMessage()">
        <button class="btn btn-primary" onclick="sendMessage()">Gửi</button>
    </div>
</div>

<script>
    // Hàm hiển thị/ẩn chat widget (Giữ nguyên)
    document.getElementById('toggleChat').onclick = function() {
        var chatWidget = document.getElementById('chatWidget');
        chatWidget.style.display = chatWidget.style.display === 'flex' ? 'none' : 'flex';
    };

    // Hàm MỚI: Dùng để gửi câu hỏi nhanh
    function sendQuickReply(message) {
        // Đặt nội dung câu hỏi vào ô input và gọi hàm sendMessage
        document.getElementById('chatInput').value = message;
        sendMessage();
    }

    // Hàm gửi tin nhắn (Đã sửa lỗi trước đó)
    function sendMessage() {
        const input = document.getElementById('chatInput');
        const message = input.value.trim();
        const chatBody = document.getElementById('chatBody');

        if (message === '') return;

        // 1. Hiển thị tin nhắn của User
        chatBody.innerHTML += `<div class="message-user"><span>${message}</span></div>`;
        input.value = '';
        chatBody.scrollTop = chatBody.scrollHeight;

        // Lấy CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // 2. Gọi API Laravel
        fetch('/chatbot/ask', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken 
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // 3. Hiển thị phản hồi của AI
            const aiResponse = data.answer || "Xin lỗi, tôi không hiểu câu hỏi này.";
            chatBody.innerHTML += `<div class="message-ai"><span>${aiResponse}</span></div>`;
            chatBody.scrollTop = chatBody.scrollHeight;
        })
        .catch(error => {
            console.error('Lỗi khi gọi API Chatbot:', error);
            // Thông báo lỗi thân thiện hơn
            let errorMsg = "Hệ thống đang gặp sự cố. Vui lòng kiểm tra Laravel Log hoặc cấu hình API AI.";
            if (error.message.includes('404')) {
                 errorMsg = "Lỗi: Không tìm thấy đường dẫn (404). Vui lòng kiểm tra lại Route trong web.php.";
            } else if (error.message.includes('500')) {
                 errorMsg = "Lỗi: Server (500). Vui lòng kiểm tra Laravel Log.";
            }
            
            chatBody.innerHTML += `<div class="message-ai"><span>${errorMsg}</span></div>`;
            chatBody.scrollTop = chatBody.scrollHeight;
        });
    }
</script>

