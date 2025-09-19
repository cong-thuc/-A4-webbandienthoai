-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 17, 2025 lúc 02:51 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop-dienthoai`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(5, 'IPHONE', '2025-04-28 02:48:34', '2025-04-28 02:48:34'),
(6, 'SAMSUNG', '2025-04-28 02:48:54', '2025-04-28 02:48:54'),
(7, 'OPPO', '2025-04-28 02:49:04', '2025-04-28 02:49:04'),
(8, 'REALME', '2025-04-28 02:49:11', '2025-04-28 02:49:11'),
(9, 'XIAOMI', '2025-04-28 07:44:17', '2025-04-28 07:44:17'),
(10, 'VIVO', '2025-04-28 07:44:34', '2025-04-28 07:44:34'),
(13, 'NOKIA', '2025-04-29 03:18:29', '2025-04-30 06:22:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_04_27_165208_create_categories_table', 1),
(6, '2025_04_27_165234_create_products_table', 1),
(7, '2025_04_27_202547_create_orders_table', 1),
(8, '2025_04_27_202640_create_order_items_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Chờ xác nhận',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Nguyễn Minh Triều', '0386302325', 'cần thơ', 'Đã hủy', '2025-04-27 13:48:27', '2025-04-27 14:14:38'),
(2, 2, 'Nguyễn Minh Triều', '0386302325', 'bfbxfb', 'Đã giao', '2025-04-27 14:05:35', '2025-04-27 15:37:53'),
(3, 2, 'Tạ Đình Trí', '0386302325', 'hdff', 'Đã giao', '2025-04-27 14:06:21', '2025-04-27 15:37:45'),
(4, 1, 'ông hổ', '123456', 'sdfdfdf', 'Đã giao', '2025-04-27 14:18:16', '2025-04-27 14:18:48'),
(5, 2, 'Nguyễn Tuấn Kiệt', '0386302325', 'gsgs', 'Đã giao', '2025-04-28 02:20:59', '2025-04-28 02:35:07'),
(6, 1, 'rử', 'ưewe', 'ewwe', 'Đã giao', '2025-04-28 02:57:10', '2025-04-28 02:57:35'),
(7, 4, 'Tạ Đình Trí', '0386302325', 'An Giang', 'Chờ xác nhận', '2025-04-28 11:11:13', '2025-04-28 11:11:13'),
(8, 4, 'tri', '0788706377', 'AN Giang', 'Đã giao', '2025-04-28 12:51:46', '2025-04-28 12:52:20'),
(9, 6, 'meo', '0123456789', 'cathouse', 'Chờ xác nhận', '2025-04-28 12:58:24', '2025-04-28 12:58:24'),
(10, 8, 'mẹ', '0123456789', 'Vĩnh Long', 'Chờ xác nhận', '2025-04-28 15:03:20', '2025-04-28 15:03:20'),
(11, 3, 'khách 1', '123456789', 'cần thơ', 'Chờ xác nhận', '2025-04-28 22:24:23', '2025-04-28 22:24:23'),
(12, 4, 'mẹ', '0123456789', 'Cần Thơ', 'Đã giao', '2025-04-29 03:16:22', '2025-04-29 03:22:20');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(7, 7, 13, 1, 17000000.00, '2025-04-28 11:11:13', '2025-04-28 11:11:13'),
(8, 8, 27, 1, 5300000.00, '2025-04-28 12:51:46', '2025-04-28 12:51:46'),
(9, 9, 19, 1, 45000000.00, '2025-04-28 12:58:24', '2025-04-28 12:58:24'),
(10, 10, 33, 1, 9000000.00, '2025-04-28 15:03:20', '2025-04-28 15:03:20'),
(11, 11, 12, 1, 27000000.00, '2025-04-28 22:24:23', '2025-04-28 22:24:23'),
(12, 12, 32, 1, 4000000.00, '2025-04-29 03:16:22', '2025-04-29 03:16:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('tadinhtri2004@gmail.com', '$2y$10$Ws4SHi1JmCoe6OL/hb8ez.ySmj4aB/49DfidRuWJ4ByDolGxmDAKK', '2025-04-28 14:47:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `quantity`, `description`, `image`, `created_at`, `updated_at`) VALUES
(12, 5, 'iPhone 15 Pro Max 256GB', 27000000.00, 10, 'Màn hình: 6.7 inch Super Retina XDR OLED, 120Hz\r\n\r\nChip: Apple A17 Pro (3nm)\r\n\r\nRAM: 8GB\r\n\r\nBộ nhớ: 256GB\r\n\r\nCamera sau: 48MP (chính) + 12MP (tele 5x) + 12MP (góc rộng) + cảm biến LiDAR\r\n\r\nCamera trước: 12MP\r\n\r\nPin: ~4422mAh, sạc nhanh 25W, MagSafe 15W\r\n\r\nChất liệu: Khung titan, nhẹ và bền\r\n\r\nCổng sạc: USB-C (chuẩn USB 3.0)\r\n\r\nHệ điều hành: iOS 17\r\n\r\nMàu sắc: Titan tự nhiên, đen, trắng, xanh', 'products/lpSN333tDaBcWZ07NuGp5u0LOnQjfJEc10Okb979.jpg', '2025-04-28 07:59:13', '2025-04-28 08:00:33'),
(13, 5, 'iPhone 14 Plus 128GB', 17000000.00, 10, 'Màn hình: 6.7 inch Super Retina XDR OLED\r\n\r\nChip: Apple A15 Bionic\r\n\r\nRAM: 6GB\r\n\r\nBộ nhớ: 128GB\r\n\r\nCamera sau: 12MP (chính) + 12MP (góc rộng)\r\n\r\nCamera trước: 12MP\r\n\r\nPin: 4325mAh, sạc nhanh 20W, MagSafe 15W\r\n\r\nHệ điều hành: iOS 16 (nâng cấp lên iOS 18)\r\n\r\nKháng nước: IP68\r\n\r\nKết nối: 5G, Wi-Fi 6, Bluetooth 5.3\r\n\r\nMàu sắc: Đen, trắng, xanh dương, đỏ, tím, vàng', 'products/iSsPF8pAh9aFdG6IUDWBlFyVWQn9oD0yqdxrZACU.jpg', '2025-04-28 08:05:20', '2025-04-28 08:05:20'),
(14, 5, 'iPhone 12 64GB', 9900000.00, 10, 'Màn hình: 6.1 inch Super Retina XDR OLED\r\n\r\nChip: Apple A14 Bionic\r\n\r\nRAM: 4GB\r\n\r\nBộ nhớ: 64GB\r\n\r\nCamera sau: 12MP (chính) + 12MP (góc rộng)\r\n\r\nCamera trước: 12MP\r\n\r\nPin: ~2815mAh, sạc nhanh 20W, MagSafe 15W\r\n\r\nHệ điều hành: iOS 14 (nâng cấp lên iOS 18)\r\n\r\nKháng nước: IP68\r\n\r\nKết nối: 5G, Wi-Fi 6, Bluetooth 5.0\r\n\r\nMàu sắc: Đen, trắng, đỏ, xanh dương, xanh lá, tím', 'products/pAnwQH3CAHE78IEbq5EUY3GWlpL07vArEHcdOpR4.jpg', '2025-04-28 08:08:45', '2025-04-28 08:08:45'),
(15, 6, 'Samsung Galaxy S25 Ultra 5G 12GB/256GB', 29000000.00, 10, 'Màn hình: 6.9 inch Dynamic AMOLED 2X, QHD+, 120Hz\r\n\r\nChip: Snapdragon 8 Elite (3nm)\r\n\r\nRAM: 12GB\r\n\r\nBộ nhớ: 256GB\r\n\r\nCamera sau: 200MP + 50MP (5x) + 10MP (3x) + 50MP (góc rộng)\r\n\r\nCamera trước: 12MP\r\n\r\nPin: 5000mAh, sạc nhanh 45W, sạc không dây 15W\r\n\r\nHệ điều hành: Android 15, One UI 7\r\n\r\nTính năng: Hỗ trợ S Pen, khung titan, chống nước IP68', 'products/FjENWdeJB6HFFQK4UhKIWtuavZPwpHSJU3iAm5JC.jpg', '2025-04-28 08:10:22', '2025-04-28 08:10:22'),
(16, 6, 'Samsung Galaxy A56 5G 8GB/128GB', 9400000.00, 10, 'Màn hình: 6.7 inch Super AMOLED FHD+, 120Hz\r\n\r\nChip: Exynos 1580 (8 nhân, 4nm)\r\n\r\nRAM: 8GB\r\n\r\nBộ nhớ: 128GB\r\n\r\nCamera sau: 50MP (chính) + 12MP (góc rộng) + 5MP (macro)\r\n\r\nCamera trước: 12MP\r\n\r\nPin: 5000mAh, sạc nhanh 45W\r\n\r\nHệ điều hành: Android 15, One UI 7', 'products/AsqbvYYbbqV77nszOLl6auSHDLETWApqdKnGdyU2.jpg', '2025-04-28 08:11:47', '2025-04-28 08:11:47'),
(17, 6, 'Samsung Galaxy Z Fold6 5G 12GB/256GB', 38000000.00, 10, 'Màn hình: 7.6 inch Dynamic AMOLED 2X (chính), 6.3 inch Dynamic AMOLED 2X (phụ), tần số quét 120Hz\r\n\r\nChip: Qualcomm Snapdragon 8 Gen 3\r\n\r\nRAM: 12GB LPDDR5X\r\n\r\nBộ nhớ: 256GB (UFS 4.0)\r\n\r\nCamera sau: 50MP (chính), 12MP (góc rộng), 10MP (telephoto, zoom 3x)\r\n\r\nCamera trước: 10MP, 4MP (dưới màn hình)\r\n\r\nPin: 4400mAh, sạc nhanh 25W, sạc không dây 15W\r\n\r\nHệ điều hành: Android 14, One UI 6.1.1\r\n\r\nKháng nước: IP48\r\n\r\nKết nối: 5G, Wi-Fi 6E, Bluetooth 5.3', 'products/t5oSM19YxJCs6NaxtjJ97v9f6qFueK6hNja2IuiE.jpg', '2025-04-28 08:15:39', '2025-04-28 08:15:39'),
(18, 6, 'Samsung Galaxy Z Flip6 5G 12GB/256GB', 19000000.00, 10, 'Màn hình: 6.7 inch Dynamic AMOLED 2X, tần số quét 120Hz (màn hình chính), 3.4 inch Super AMOLED (màn hình phụ)\r\n\r\nChip: Qualcomm Snapdragon 8 Gen 3\r\n\r\nRAM: 12GB LPDDR5X\r\n\r\nBộ nhớ: 256GB (UFS 4.0)\r\n\r\nCamera sau: 12MP (chính), 12MP (góc rộng)\r\n\r\nCamera trước: 10MP\r\n\r\nPin: 3700mAh, sạc nhanh 25W, sạc không dây 15W\r\n\r\nHệ điều hành: Android 14, One UI 6.1.1\r\n\r\nKháng nước: IP68\r\n\r\nKết nối: 5G, Wi-Fi 6E, Bluetooth 5.3', 'products/3TPGgAGcei90yB5OFOW3xngjpkq6dGmm4AxVIIJS.jpg', '2025-04-28 08:17:02', '2025-04-28 08:17:02'),
(19, 7, 'OPPO Find N5 5G 16GB/512GB', 45000000.00, 10, 'Màn hình: 8.12 inch LTPO3 OLED (chính), 6.62 inch LTPO3 OLED (phụ), tần số quét 120Hz\r\n\r\nChip: Qualcomm Snapdragon 8 Elite (3nm)\r\n\r\nRAM: 16GB LPDDR5X\r\n\r\nBộ nhớ: 512GB UFS 4.0\r\n\r\nCamera sau: 50MP (chính), 48MP (góc rộng), 13MP (telephoto)\r\n\r\nPin: 4500mAh, sạc nhanh 80W\r\n\r\nHệ điều hành: Android 14, ColorOS', 'products/I6bHRlsKwzqDkaBt0bNvEjBF8EEJPgnOGvf3WI77.jpg', '2025-04-28 08:18:46', '2025-04-28 08:18:46'),
(20, 7, 'OPPO Reno13 5G 12GB/256GB', 15000000.00, 10, 'Màn hình: 6.59 inch AMOLED, độ phân giải 1256 x 2760, tần số quét 120Hz\r\n\r\nChip xử lý: MediaTek Dimensity 8350 (4nm)\r\n\r\nRAM: 12GB LPDDR5\r\n\r\nBộ nhớ trong: 256GB UFS 3.1 (không hỗ trợ thẻ nhớ ngoài)\r\n\r\nCamera sau: 50MP (chính, f/1.8, OIS) + 8MP (góc rộng, f/2.2)\r\n\r\nCamera trước: 50MP (f/2.4)\r\n\r\nPin: 5600mAh, hỗ trợ sạc nhanh 80W\r\n\r\nHệ điều hành: Android 15 với giao diện ColorOS 15\r\n\r\nKháng nước: IP69 (chống bụi và nước, có thể ngâm dưới 2m trong 30 phút)\r\n\r\nKết nối: 5G, Wi-Fi 6, Bluetooth 5.3\r\n\r\nTính năng AI: AI Eraser 2.0, AI Clarity Enhancer, AI Night Portrait', 'products/revnBGxOCPqjEGNctTNU38X01ZwA6iBtip3bRPUO.jpg', '2025-04-28 08:20:22', '2025-04-28 08:20:22'),
(21, 7, 'OPPO A3 8GB/128GB', 5500000.00, 10, 'Màn hình: 6.67 inch IPS LCD, độ phân giải 720 x 1604 pixels, tần số quét 90Hz, độ sáng tối đa 1000 nits\r\n\r\nChip xử lý: Qualcomm Snapdragon 6s Gen 1 (4G)\r\n\r\nRAM: 8GB\r\n\r\nBộ nhớ trong: 128GB, hỗ trợ thẻ nhớ microSDXC\r\n\r\nCamera sau: 50MP (chính), hỗ trợ quay video 1080p@30/60fps\r\n\r\nCamera trước: 5MP, hỗ trợ quay video 1080p@30fps\r\n\r\nPin: 5100mAh, hỗ trợ sạc nhanh 45W\r\n\r\nHệ điều hành: Android 14 với giao diện ColorOS 14\r\n\r\nKháng nước: IP54 (chống nước văng nhẹ)\r\n\r\nKết nối: 4G LTE, Wi-Fi 802.11 a/b/g/n/ac, Bluetooth 5.3, USB Type-C 2.0\r\n\r\nMàu sắc: Sparkle Black, Starry Purple, Starlight White', 'products/0qn6qrKu6qU7azsuQUOBRwdPxYeGZJZLE8ACi9F0.jpg', '2025-04-28 08:22:15', '2025-04-28 08:22:15'),
(22, 7, 'OPPO Find X8 Pro 5G 16GB/512GB', 30000000.00, 10, 'Màn hình: 6.78 inch LTPO AMOLED, độ phân giải 1264 x 2780 pixels, tần số quét 120Hz\r\n\r\nChip xử lý: MediaTek Dimensity 9400 (3nm)\r\n\r\nRAM: 16GB LPDDR5X\r\n\r\nBộ nhớ trong: 512GB UFS 4.0 (không hỗ trợ thẻ nhớ ngoài)\r\n\r\nCamera sau: 4 camera 50MP (chính, góc rộng, telephoto 3x, telephoto 6x)\r\n\r\nCamera trước: 32MP\r\n\r\nPin: 5910mAh, hỗ trợ sạc nhanh 80W và sạc không dây 50W\r\n\r\nHệ điều hành: Android 15 với giao diện ColorOS 15\r\n\r\nKháng nước: IP68\r\n\r\nKết nối: 5G, Wi-Fi 6E, Bluetooth 5.3', 'products/7b57nDadu4BNj7fZZ7ytTACzH5pDFkiEt0rvCvsf.jpg', '2025-04-28 08:23:43', '2025-04-28 08:23:43'),
(23, 8, 'Realme C75 8GB/128GB', 5300000.00, 10, 'Màn hình: 6.72 inch IPS LCD, độ phân giải FHD+ (2400 x 1080), tần số quét 90Hz, độ sáng tối đa 690 nits.\r\n\r\nChip xử lý: MediaTek Helio G92 Max (8 nhân, 2x Cortex-A75 2.0GHz + 6x Cortex-A55 1.8GHz), GPU Mali-G52 MC2.\r\n\r\nRAM: 8GB LPDDR4X, hỗ trợ mở rộng RAM ảo lên đến 16GB.\r\n\r\nBộ nhớ trong: 128GB UFS 2.2, hỗ trợ thẻ nhớ microSDXC (lên đến 2TB).\r\n\r\nCamera sau: 50MP (f/1.8, PDAF), hỗ trợ quay video 1080p@30fps.\r\n\r\nCamera trước: 8MP (f/2.0), hỗ trợ quay video 1080p@30fps.\r\n\r\nPin: 6000mAh, hỗ trợ sạc nhanh 45W SUPERVOOC, sạc ngược (reverse charging).\r\n\r\nHệ điều hành: Android 14 với giao diện Realme UI 5.0.\r\n\r\nKháng nước: IP69 (chống bụi và nước, có thể ngâm dưới 2m trong 60 giờ).\r\n\r\nKết nối: 4G LTE, Wi-Fi 802.11 a/b/g/n/ac, Bluetooth 5.0, USB Type-C 2.0, OTG.', 'products/cy2HAYJqVx1R4wTjFSJThORCweDMDpF7tMfy58gZ.jpg', '2025-04-28 08:26:00', '2025-04-28 08:26:00'),
(24, 8, 'Realme 13+ 5G 12GB/256GB', 7800000.00, 10, 'Màn hình: 6.67 inch OLED, độ phân giải FHD+ (1080 x 2400), tần số quét 120Hz, độ sáng tối đa 2000 nits, hỗ trợ HDR10+.\r\n\r\nChip xử lý: MediaTek Dimensity 7300 Energy (4nm), 8 nhân, GPU Mali-G615 MC2.\r\n\r\nRAM: 12GB LPDDR4X, hỗ trợ mở rộng RAM ảo lên đến 14GB.\r\n\r\nBộ nhớ trong: 256GB UFS 3.1, hỗ trợ thẻ nhớ microSDXC (lên đến 2TB).\r\n\r\nCamera sau: 50MP (f/1.9, OIS), 2MP (độ sâu).\r\n\r\nCamera trước: 16MP (f/2.4).\r\n\r\nPin: 5000mAh, sạc nhanh 80W SUPERVOOC, sạc ngược.\r\n\r\nHệ điều hành: Android 14, giao diện Realme UI 5.0.\r\n\r\nKháng nước: IP65.\r\n\r\nKết nối: 5G, Wi-Fi 6, Bluetooth 5.3, USB Type-C', 'products/4rdmYQiMmZphWfp2CqhEhhb7rmPnN7CqA89nrOrW.jpg', '2025-04-28 08:27:42', '2025-04-28 08:27:42'),
(25, 8, 'Realme Note 60 6GB/128GB', 3500000.00, 10, 'Màn hình: 6.74 inch IPS LCD, độ phân giải HD+ (720 x 1600), tần số quét 90Hz, độ sáng tối đa 560 nits.\r\n\r\nChip xử lý: Unisoc Tiger T612 (8 nhân, 2x Cortex-A75 1.8GHz + 6x Cortex-A55 1.8GHz), GPU Mali-G57.\r\n\r\nRAM: 6GB LPDDR4X, hỗ trợ mở rộng RAM ảo lên đến 12GB.\r\n\r\nBộ nhớ trong: 128GB eMMC 5.1, hỗ trợ thẻ nhớ microSDXC (lên đến 2TB).\r\n\r\nCamera sau: 32MP (f/1.8), quay video 1080p@30fps.\r\n\r\nCamera trước: 5MP (f/2.2), quay video 1080p@30fps.\r\n\r\nPin: 5000mAh, sạc 10W.\r\n\r\nHệ điều hành: Android 14, giao diện Realme UI 5.0.\r\n\r\nKháng nước: IP64.\r\n\r\nKết nối: 4G LTE, Wi-Fi 5, Bluetooth 5.0, USB Type-C', 'products/cHAA4bnDFBYukBJeA3AowBbWqWiVHsbsV4gDyrMZ.jpg', '2025-04-28 08:29:54', '2025-04-28 08:29:54'),
(26, 8, 'Realme 12 8GB/256GB', 4500000.00, 10, 'Màn hình: 6.67 inch AMOLED, độ phân giải FHD+ (1080 x 2400), tần số quét 120Hz, độ sáng tối đa 2000 nits.\r\n\r\nChip xử lý: MediaTek Dimensity 6100+ (6nm), 8 nhân, GPU Mali-G57 MC2.\r\n\r\nRAM: 8GB LPDDR4X, hỗ trợ mở rộng RAM ảo lên đến 8GB.\r\n\r\nBộ nhớ trong: 256GB UFS 2.2, hỗ trợ thẻ nhớ microSDXC (lên đến 2TB).\r\n\r\nCamera sau: 50MP (f/1.8), 2MP (độ sâu), hỗ trợ quay video 1080p@30fps.\r\n\r\nCamera trước: 16MP (f/2.4), hỗ trợ quay video 1080p@30fps.\r\n\r\nPin: 5000mAh, hỗ trợ sạc nhanh 67W SUPERVOOC.\r\n\r\nHệ điều hành: Android 14 với giao diện Realme UI 5.0.\r\n\r\nKháng nước: IP64.\r\n\r\nKết nối: 5G, Wi-Fi 6, Bluetooth 5.3, USB Type-C.\r\n\r\nKích thước và trọng lượng: 162.95 x 75.45 x 7.92 mm, nặng 187g.\r\n\r\nMàu sắc: Skyline Silver, Pioneer Green', 'products/xaVydP8w6d4V3LPacT2Pa3lTGppEdciHqjU10aWC.jpg', '2025-04-28 08:32:03', '2025-04-28 08:32:03'),
(27, 9, 'Xiaomi Redmi Note 14 8GB/128GB', 5300000.00, 10, 'Màn hình: 6.67 inch AMOLED, độ phân giải FHD+ (1080 x 2400), tần số quét 120Hz, độ sáng tối đa 2100 nits, bảo vệ bằng kính Corning Gorilla Glass 5.\r\n\r\nChip xử lý: MediaTek Dimensity 7025 Ultra (6nm), 8 nhân (2x Cortex-A78 2.5GHz + 6x Cortex-A55 2.0GHz), GPU IMG BXM-8-256.\r\n\r\nRAM: 8GB LPDDR4X.\r\n\r\nBộ nhớ trong: 128GB UFS 2.2, hỗ trợ thẻ nhớ microSDXC (lên đến 1TB).\r\n\r\nCamera sau: 50MP (f/1.7, 24mm, PDAF, OIS), 8MP (ultrawide), 2MP (macro), quay video 1080p@30fps, hỗ trợ EIS.\r\n\r\nCamera trước: 20MP.\r\n\r\nPin: 5110mAh, hỗ trợ sạc nhanh 45W.\r\n\r\nHệ điều hành: Android 14 với giao diện HyperOS 1.0.\r\n\r\nKháng nước: IP64.\r\n\r\nKết nối: 5G, Wi-Fi 5, Bluetooth 5.3, USB Type-C.\r\n\r\nKích thước và trọng lượng: 163.3 x 76.6 x 8.2 mm, nặng 196.5g', 'products/Qt1e5ae3jMjLEtjlqcGxDIXK1CgQzZ679HF7YqMQ.jpg', '2025-04-28 08:34:41', '2025-04-28 08:34:41'),
(28, 9, 'Xiaomi 15 5G 12GB/512GB', 2400000.00, 10, 'Màn hình: 6.36 inch LTPO AMOLED, độ phân giải 1200 x 2670, tần số quét 120Hz, độ sáng tối đa 3200 nits, hỗ trợ Dolby Vision và HDR10+.​\r\n\r\nChip xử lý: Snapdragon 8 Elite (3nm), CPU 8 nhân (2x Oryon V2 Phoenix L 4.32GHz + 6x Oryon V2 Phoenix M 3.53GHz), GPU Adreno 830.​\r\n\r\nRAM: 12GB LPDDR5X, tốc độ 8533Mbps.​\r\n\r\nBộ nhớ trong: 512GB UFS 4.0, không hỗ trợ thẻ nhớ microSD.​\r\n\r\nCamera sau: 50MP (f/1.6, cảm biến OVX9000, OIS), 50MP (telephoto, f/2.0, OIS), 50MP (ultrawide, f/2.2).​\r\n\r\nCamera trước: 32MP (f/2.0).​\r\n\r\nPin: 5240mAh, sạc nhanh 90W, sạc không dây 50W.​\r\n\r\nHệ điều hành: Android 15 với giao diện HyperOS 2.0.​\r\n\r\nKết nối: 5G, Wi-Fi 7, Bluetooth 5.3, USB Type-C 3.2 Gen 2, NFC.​\r\n\r\nKháng nước: IP68.​\r\n\r\nKích thước và trọng lượng: 152.3 x 71.2 x 8.08 mm, nặng 191g', 'products/y3CrSL8UpMGhLQDlf9TrJpWnRsS1yDU4HoWuxtex.jpg', '2025-04-28 08:37:14', '2025-04-28 08:37:14'),
(29, 9, 'Xiaomi Redmi A3 3GB/64GB', 1700000.00, 10, 'Màn hình: 6.71 inch IPS LCD, HD+ (720 x 1650), tần số quét 90Hz, kính Gorilla Glass 3.\r\n\r\nChip: MediaTek Helio G36 (8 nhân, 12nm).\r\n\r\nRAM: 3GB, hỗ trợ mở rộng RAM ảo.\r\n\r\nBộ nhớ: 64GB, hỗ trợ thẻ nhớ microSD lên tới 1TB.\r\n\r\nCamera sau: 8MP + cảm biến phụ 0.08MP.\r\n\r\nCamera trước: 5MP.\r\n\r\nPin: 5000mAh, sạc 10W (USB-C).\r\n\r\nHệ điều hành: Android 14 (Go Edition).\r\n\r\nKết nối: 4G LTE, Wi-Fi 5, Bluetooth 5.4, GPS, jack 3.5mm.\r\n\r\nKích thước & trọng lượng: 168.3 x 76.3 x 8.32 mm, 199g', 'products/t5Y3aLijC4EDVFKcieewQjk4h9TDm9DHqEe4kMKy.jpg', '2025-04-28 14:30:56', '2025-04-28 14:30:56'),
(30, 9, 'Xiaomi 15 Ultra 5G 16GB/512GB', 33000000.00, 10, 'Màn hình: 6.73 inch AMOLED LTPO, WQHD+ (3200 x 1440), 120Hz, Gorilla Glass Victus 2.\r\n\r\nChip: Snapdragon 8 Gen 3 Elite, tiến trình 3nm.\r\n\r\nRAM/Bộ nhớ: 16GB RAM LPDDR5X, 512GB UFS 4.1.\r\n\r\nCamera sau: 4 camera 50MP (chính, góc rộng, tele 3.2x, tiềm vọng 5x), hợp tác Leica.\r\n\r\nCamera trước: 32MP.\r\n\r\nPin: 5410mAh, sạc nhanh 90W có dây, 80W không dây.\r\n\r\nHệ điều hành: Android 15, giao diện HyperOS 2.\r\n\r\nTính năng khác: IP68 kháng nước, Wi-Fi 7, loa stereo Dolby Atmos.', 'products/A3lWfZcCGJYox8OJyXhzGRWHt1ttfGBBf7As8i0E.jpg', '2025-04-28 14:33:53', '2025-04-28 14:33:53'),
(31, 10, 'vivo V30 5G 12GB/512GB', 13000000.00, 10, 'Màn hình: 6.78 inch AMOLED cong, độ phân giải 1260 x 2800 (1.5K), tần số quét 120Hz, độ sáng tối đa 2800 nits, hỗ trợ HDR10+.\r\n\r\nVi xử lý: Qualcomm Snapdragon 7 Gen 3 (4nm), CPU 8 nhân (1x2.63 GHz, 3x2.4 GHz, 4x1.8 GHz), GPU Adreno 720.\r\n\r\nRAM/Bộ nhớ: 12GB LPDDR4X, hỗ trợ mở rộng RAM ảo thêm 12GB; bộ nhớ trong 512GB UFS 2.2, không hỗ trợ thẻ nhớ ngoài.\r\n\r\nCamera sau: Cảm biến chính 50MP (f/1.9, 1/1.55\", OIS), cảm biến góc siêu rộng 50MP (f/2.0, 119°), hỗ trợ Aura Light 3.0 và quay video 4K.\r\n\r\nCamera trước: 50MP (f/2.0, góc rộng 92°), hỗ trợ lấy nét tự động và quay video 4K.\r\n\r\nPin: 5000mAh, hỗ trợ sạc nhanh 80W, sạc đầy 100% trong khoảng 48 phút.\r\n\r\nHệ điều hành: Android 14 với giao diện Funtouch OS 14.\r\n\r\nKháng nước/bụi: Chuẩn IP54.\r\n\r\nKích thước & Trọng lượng: 7.45mm độ dày, nặng 186g', 'products/NfjOX1PsEHxzRUEKuwpbofGJNpEGnMyeMK4RBOhQ.jpg', '2025-04-28 14:37:24', '2025-04-28 14:37:24'),
(32, 10, 'vivo Y28 8GB/128GB', 4000000.00, 10, 'Màn hình: 6.56 inch IPS LCD, độ phân giải HD+ (720 x 1612), tần số quét 90Hz.\r\n\r\nVi xử lý: MediaTek Dimensity 6020 (7nm), CPU 8 nhân (2x2.2 GHz Cortex-A76 & 6x2.0 GHz Cortex-A55), GPU Mali-G57 MC2.\r\n\r\nRAM/Bộ nhớ: 8GB RAM LPDDR4X, hỗ trợ mở rộng RAM ảo thêm 8GB; bộ nhớ trong 128GB UFS 2.2, hỗ trợ thẻ nhớ microSD lên đến 1TB.\r\n\r\nCamera sau: Cảm biến chính 50MP (f/1.8, PDAF) kết hợp với cảm biến độ sâu 2MP (f/2.4), hỗ trợ quay video 1080p@30fps.\r\n\r\nCamera trước: 8MP (f/2.0), hỗ trợ quay video 1080p@30fps.\r\n\r\nPin: 5000mAh, hỗ trợ sạc nhanh 15W qua cổng USB-C.\r\n\r\nHệ điều hành: Android 13 với giao diện Funtouch OS 13.\r\n\r\nKết nối: Hỗ trợ 5G, Wi-Fi 5, Bluetooth 5.1, GPS, giắc cắm tai nghe 3.5mm.\r\n\r\nKháng nước/bụi: Chuẩn IP54.\r\n\r\nKích thước & Trọng lượng: 163.7 x 75.4 x 8.1 mm, nặng 186g.', 'products/Dd4o30xTcUk3oDc3GDOrrcNBTh4qOS6Jso5hsCTX.jpg', '2025-04-28 14:39:44', '2025-04-28 14:39:44'),
(33, 10, 'vivo V30e 5G 12GB/256GB', 9000000.00, 10, 'Màn hình: 6.78 inch AMOLED cong 3D, độ phân giải 2400 x 1080 (FHD+), tần số quét 120Hz, độ sáng tối đa 1300 nits, hỗ trợ 100% DCI-P3, 105% NTSC.\r\n\r\nVi xử lý: Qualcomm Snapdragon 6 Gen 1 (4nm), CPU 8 nhân (4x2.2 GHz Cortex-A78 & 4x1.8 GHz Cortex-A55), GPU Adreno 710.\r\n\r\nRAM/Bộ nhớ: 12GB RAM LPDDR4X, hỗ trợ mở rộng RAM ảo thêm 12GB; bộ nhớ trong 256GB UFS 2.2, hỗ trợ thẻ nhớ microSD lên đến 1TB.\r\n\r\nCamera sau: Cảm biến chính 50MP Sony IMX882 (f/1.79, PDAF, OIS), cảm biến góc siêu rộng 8MP (f/2.2, 120°), hỗ trợ Aura Light 3.0 và quay video 4K@30fps.\r\n\r\nCamera trước: 32MP (f/2.0), hỗ trợ quay video 4K@30fps.\r\n\r\nPin: 5500mAh, hỗ trợ sạc nhanh 44W qua cổng USB-C.\r\n\r\nHệ điều hành: Android 14 với giao diện Funtouch OS 14.\r\n\r\nKháng nước/bụi: Chuẩn IP64.\r\n\r\nKích thước & Trọng lượng: 164.36 x 74.75 x 7.65 mm, nặng 179g.', 'products/zvD4TRVSpnUkBjGEz5cd9DFGy7Tamr303aDfonYY.jpg', '2025-04-28 14:43:18', '2025-04-28 14:43:18'),
(34, 10, 'vivo Y19s 6GB/128GB', 5000000.00, 10, 'Màn hình: 6.68 inch IPS LCD, độ phân giải 720 x 1608 (HD+), tần số quét 90Hz, độ sáng tối đa 1000 nits.\r\n\r\nVi xử lý: Unisoc Tiger T612 (12nm), CPU 8 nhân (2x1.8 GHz Cortex-A75 & 6x1.8 GHz Cortex-A55), GPU Mali-G57.\r\n\r\nRAM/Bộ nhớ: 6GB RAM LPDDR4X, hỗ trợ mở rộng RAM ảo thêm 6GB; bộ nhớ trong 128GB eMMC 5.1, hỗ trợ thẻ nhớ microSD lên đến 1TB.\r\n\r\nCamera sau: Cảm biến chính 50MP (f/1.8, PDAF) kết hợp với cảm biến phụ 0.08MP, hỗ trợ quay video 1080p@30fps.\r\n\r\nCamera trước: 5MP (f/2.2), hỗ trợ quay video 1080p@30fps.\r\n\r\nPin: 5500mAh, hỗ trợ sạc nhanh 15W qua cổng USB-C.\r\n\r\nHệ điều hành: Android 14 với giao diện Funtouch OS 14.\r\n\r\nKháng nước/bụi: Chuẩn IP64.\r\n\r\nKích thước & Trọng lượng: 165.75 x 76.1 x 8.1 mm, nặng 198g', 'products/AzGStowzj07AXREAowArYyvLTmkwZe5U4FTHEt3Z.jpg', '2025-04-28 14:46:16', '2025-04-28 14:46:16'),
(46, 13, 'minh trieu', 50000.00, 55, 'djgd', NULL, '2025-04-30 08:22:46', '2025-04-30 08:22:46');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$NdMYTDVgcePPLd3d4k9IQeehpqTfNQfn.mfAa3z8KKC5d7ofxiCM2', NULL, '2025-04-27 13:27:09', '2025-04-27 13:27:09', 'admin'),
(2, 'trieu', 'trieu@gmail.com', NULL, '$2y$10$A.zSH0jz.4/n/D7FYpZFM.6MTAzlOBJjg5y/sJsZUojod4n5QMA5m', NULL, '2025-04-27 14:04:11', '2025-04-27 14:04:11', 'customer'),
(3, 'tri', 'tri@gmail.com', NULL, '$2y$10$X//1aVZJfdlJ6ivF4b5JiOjH1KXOR3hOBTdNyu4tdq2idFTsvI/i2', NULL, '2025-04-27 14:52:54', '2025-04-27 14:52:54', 'customer'),
(4, 'trita', 'trita@gmail.com', NULL, '$2y$10$sLofE3UZeBCi2JekBJD75.ft3OPyw3K0tiW8iJBwnDGgxSWx4juXu', NULL, '2025-04-28 09:45:49', '2025-04-28 09:45:49', 'customer'),
(5, '123', '123@gmail.com', NULL, '$2y$10$q2Aa5e1cDIAUphCMFO04nu2xXduFvJSX/5Ys1fuowe9gBOFvdPxCe', NULL, '2025-04-28 09:51:27', '2025-04-28 09:51:27', 'customer'),
(6, 'meo', 'meo@gmail.com', NULL, '$2y$10$Nh/Hfrt6.a/t13dCjkXa4eALoKQSwBMtuagcK6bTOPt6uyr62HeXa', NULL, '2025-04-28 10:05:46', '2025-04-28 10:05:46', 'customer'),
(7, 'tui', 'tui@gmail.com', NULL, '$2y$10$PgIKJC3qf08ST1xgoNERFutofAXsMlav0Y5Hw3JQiz.X0K.cqeqS6', NULL, '2025-04-28 11:12:41', '2025-04-28 11:12:41', 'customer'),
(8, 'tritadinh', 'tadinhtri2004@gmail.com', NULL, '$2y$10$bC0rWAb8jjQSecx9PEVSf.X9RbJTHBk0T/3YF5ZtCG0q1wQWBcl4K', NULL, '2025-04-28 14:47:45', '2025-04-28 14:47:45', 'customer');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
