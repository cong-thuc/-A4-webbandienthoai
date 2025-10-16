<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quản trị Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #4e73df;
            --primary-dark: #224abe;
            --secondary-color: #f8f9fc;
            --accent-color: #36b9cc;
            --dark-color: #5a5c69;
            --sidebar-width: 250px;
            --sidebar-collapsed-width: 80px;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        /* Sidebar nâng cấp */
        .sidebar {
            min-height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            padding-top: 1rem;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            z-index: 100;
            overflow-x: hidden;         /* ✅ Ngăn chặn co giật chiều ngang */
            transition: width 0.3s ease; /* ✅ Chỉ chuyển động width */
            will-change: width;         /* ✅ Tối ưu chuyển động */
        }


        
        .sidebar-collapsed {
            width: var(--sidebar-collapsed-width);
        }
        
        .sidebar-collapsed .sidebar-text {
            display: none;
        }
        
        .sidebar a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 0.8rem 1.2rem;
            margin: 0.3rem 0.8rem;
            border-radius: 0.35rem;
            transition: all 0.3s ease;
        }
        
        .sidebar a:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }
        
        .sidebar a.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.25);
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar i {
            font-size: 1.1rem;
            margin-right: 0.75rem;
            min-width: 20px;
            text-align: center;
        }
        
        .sidebar-brand {
            padding: 1.2rem 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .sidebar-brand h4 {
            margin: 0;
            font-weight: 700;
            white-space: nowrap;
        }
        
        .sidebar-toggle {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1.2rem;
        }
        
        /* Phần còn lại giữ nguyên */
        .content-area {
            margin-left: var(--sidebar-width);
            padding: 1.5rem;
            padding-top: 80px;
            transition: all 0.3s;
        }
        
        .content-collapsed {
            margin-left: var(--sidebar-collapsed-width);
        }
        
        /* Navbar */
        .navbar {
            width: calc(100% - var(--sidebar-width));
            margin-left: var(--sidebar-width);
            padding: 0.8rem 1.5rem;
            background: white;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            position: fixed;
            top: 0;
            z-index: 99;
            transition: all 0.3s;
        }

        .navbar-collapsed {
            width: calc(100% - var(--sidebar-collapsed-width));
            margin-left: var(--sidebar-collapsed-width);
        }


        
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: var(--sidebar-collapsed-width);
            }
            
            .sidebar-text {
                display: none;
            }
            
            .content-area {
                margin-left: var(--sidebar-collapsed-width);
            }
            
            .navbar {
                left: var(--sidebar-collapsed-width);
            }
        }
    </style>

    @yield('styles')
</head>
<body>
    <!-- Sidebar nâng cấp -->
    <div class="sidebar" id="sidebar">
        <div class="d-flex flex-column h-100">
            <div class="sidebar-brand">
                <h4 class="text-white sidebar-text">Admin Panel</h4>
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <div class="flex-grow-1">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
                
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fas fa-list"></i>
                    <span class="sidebar-text">Quản lý danh mục</span>
                </a>
                
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fas fa-box"></i>
                    <span class="sidebar-text">Quản lý sản phẩm</span>
                </a>
                
                <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="sidebar-text">Quản lý đơn hàng</span>
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    <span class="sidebar-text">Quản lý tài khoản</span>
                </a>
                
                <a href="{{ route('admin.reviews.index') }}" class="{{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
                    <i class="fas fa-star"></i>
                    <span class="sidebar-text">Quản lý đánh giá</span>
                </a>
            </div>
        </div>
    </div>

    
    <nav class="navbar navbar-expand navbar-light" id="navbar">
        <div class="container-fluid">
            <button class="navbar-toggler d-md-none" type="button" id="mobileSidebarToggle">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            {{-- DÁN ĐOẠN CODE MỚI NÀY VÀO THAY THẾ --}}

            <div class="d-flex align-items-center ms-auto gap-3">
                @if(Auth::check())
                    <div class="position-relative">
                        <a href="{{ route('admin.orders.index') }}" class="text-secondary" title="Đơn hàng mới">
                            <i class="fas fa-bell fa-lg"></i>
                            @if($newOrdersCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                    {{ $newOrdersCount }}
                                </span>
                            @endif
                        </a>
                    </div>

                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; font-weight: 500;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }} 
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.profile.password.edit') }}">
                                    <i class="fas fa-key fa-sm fa-fw me-2 text-gray-400"></i>
                                    Đổi mật khẩu
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                                    Đăng xuất
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <div class="content-area" id="contentArea">
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Thêm chức năng thu gọn sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const contentArea = document.getElementById('contentArea');
            const navbar = document.getElementById('navbar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
            
            // Toggle sidebar
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('sidebar-collapsed');
                contentArea.classList.toggle('content-collapsed');
                navbar.classList.toggle('navbar-collapsed');
                
                // Lưu trạng thái vào localStorage
                const isCollapsed = sidebar.classList.contains('sidebar-collapsed');
                localStorage.setItem('sidebarCollapsed', isCollapsed);
            });
            
            // Kiểm tra trạng thái khi tải trang
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add('sidebar-collapsed');
                contentArea.classList.add('content-collapsed');
                navbar.classList.add('navbar-collapsed');
            }
            
            // Mobile toggle
            mobileSidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('sidebar-collapsed');
                contentArea.classList.toggle('content-collapsed');
                navbar.classList.toggle('navbar-collapsed');
            });
        });
    </script>
    @yield('scripts')
</body>
</html>