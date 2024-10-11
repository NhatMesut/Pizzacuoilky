-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2024 at 03:47 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizza`
--

-- --------------------------------------------------------

--
-- Table structure for table `borders`
--

CREATE TABLE `borders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borders`
--

INSERT INTO `borders` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Rounded', 0, NULL, NULL),
(2, 'Flat', 0, NULL, NULL),
(3, 'Tròn', 0, NULL, '2024-07-25 01:10:23'),
(8, 'Rounded', 15000, '2024-07-31 11:15:33', '2024-07-31 11:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `border_id` bigint(20) UNSIGNED DEFAULT NULL,
  `topping_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `slug`, `created_at`, `updated_at`) VALUES
(2, 'Hải Sản', 'images/8UYMdhd435FGRY2YMHu2dPyH8gOpCEzUy9JVfMfV.jpg', 'hai-san', NULL, '2024-07-26 08:27:48'),
(3, 'Category 3', 'images/cdLMa9UlQ0U6G3CZDqd42L0cP2hNpKKNPafwEnRB.jpg', 'category-3', NULL, '2024-07-24 04:27:21'),
(14, 'Category 4', 'images/Ck7fnFicBCZo2l1bWLM2EDZQJd3NUeOAr2xxRlKK.jpg', 'category-4', '2024-07-25 00:28:21', '2024-07-25 00:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(14) NOT NULL,
  `description` text DEFAULT NULL,
  `value` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `description`, `value`, `quantity`, `expiry_date`, `created_at`, `updated_at`) VALUES
(2, 'GIAMGIA22', 'Mã giảm giá lên đến 21%', 22, 5, '2024-11-16', '2024-07-20 08:18:19', '2024-07-26 08:28:44'),
(3, 'GIAMGIA50', 'Mã khuyến mãi giảm giá lên đến 50%', 50, 15, '2024-07-26', '2024-07-25 00:37:51', '2024-07-25 08:24:02');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(2, 3, 'Nguyễn Văn Khách', '0999888999', 'Hà Nội', '2024-07-31 17:48:15', '2024-07-31 17:48:18'),
(3, 2, 'Nguyễn Văn Bánh', '0555666777', 'Hà Nội', '2024-07-31 18:44:22', '2024-07-31 13:18:16'),
(4, 7, 'Nguyen Van Em', '0999888777', 'Hà Nội', '2024-08-02 11:53:09', '2024-08-02 11:53:09'),
(5, 8, 'Nam Nguyễn Văn', '0666777999', 'Hà Nội', '2024-08-02 12:04:22', '2024-08-02 12:04:22'),
(6, 9, 'Nguyễn Văn Z', '0379962045', 'Hà Nội', '2024-08-02 12:06:14', '2024-08-02 12:06:14'),
(7, 10, 'le trong tan', '0555999777', 'Hà Nam', '2024-08-02 12:07:07', '2024-08-02 12:07:07'),
(8, 11, 'NGUYEN VAN HUNG', '0399888999', 'Hà Tây', '2024-08-02 12:09:38', '2024-08-02 12:09:38'),
(9, 12, 'Nguyễn Văn Giang', '0222333555', 'Hà Nội', '2024-08-02 12:11:06', '2024-08-02 12:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `detail_orders`
--

CREATE TABLE `detail_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail_product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `border_id` bigint(20) UNSIGNED DEFAULT NULL,
  `topping_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_orders`
--

INSERT INTO `detail_orders` (`id`, `detail_product_id`, `order_id`, `border_id`, `topping_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, 1, 2, '2024-07-25 22:55:53', '2024-07-25 22:55:53'),
(2, 7, 1, 8, 2, 2, '2024-07-25 22:56:06', '2024-07-25 22:56:06'),
(7, 4, 6, 8, 3, 2, '2024-08-02 17:19:32', '2024-08-02 17:19:32'),
(8, 7, 6, 3, 2, 1, '2024-08-02 17:19:32', '2024-08-02 17:19:32'),
(9, 4, 7, 8, 2, 2, '2024-08-02 17:25:30', '2024-08-02 17:25:30'),
(10, 7, 7, 8, 1, 2, '2024-08-02 17:25:30', '2024-08-02 17:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `detail_products`
--

CREATE TABLE `detail_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail_products`
--

INSERT INTO `detail_products` (`id`, `product_id`, `size_id`, `price`, `created_at`, `updated_at`) VALUES
(4, 9, 5, 12000, '2024-08-01 02:54:02', '2024-08-01 02:54:02'),
(7, 9, 12, 15000, '2024-08-01 03:05:53', '2024-08-01 03:05:53');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `id_card_number` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `salary` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `name`, `phone`, `address`, `position`, `date_of_birth`, `id_card_number`, `start_date`, `salary`, `created_at`, `updated_at`) VALUES
(1, 1, 'Quản Trị Viên', '0555444666', 'Hà Nội', 'Quản Lý', '2024-08-01', '001202020202', '2024-08-01', 1500000, '2024-07-31 19:55:37', '2024-07-31 13:19:02'),
(2, 2, 'Nguyễn Văn Bình', '0999888999', 'Hồ Chí Minh', 'Nhân Viên', '2024-08-02', '001202020202', '2024-08-01', 1000000, '2024-08-01 20:49:46', '2024-08-02 20:49:46'),
(5, 6, 'Nguyễn Văn Chung', '0888999888', 'Tầng 1, Tòa ABC, Đường XYZ, Quận JQK', 'Nhân Viên Thu Ngân', '2024-08-02', '001202020205', '2024-08-10', 1500000, '2024-08-01 14:27:00', '2024-08-01 14:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_07_19_090535_create_products_table', 2),
(6, '2024_07_19_090947_create_categories_table', 3),
(7, '2024_07_19_091142_create_sizes_table', 4),
(8, '2024_07_19_091444_create_borders_table', 5),
(9, '2024_07_19_091533_create_soles_table', 6),
(10, '2024_07_19_091923_create_product_size_table', 7),
(11, '2024_07_19_091950_create_product_border_table', 8),
(12, '2024_07_19_092011_create_product_sole_table', 9),
(13, '2024_07_19_092526_alter_products_table', 10),
(14, '2024_07_19_093007_alter_product_category_foreign', 11),
(17, '2024_07_19_153518_create_coupons_table', 12),
(18, '2024_07_19_153928_create_carts_table', 12),
(19, '2024_07_19_154231_create_orders_table', 13),
(20, '2024_07_19_154431_create_detail_orders_table', 14),
(21, '2024_07_19_161739_add_coupon_id_to_orders_table', 15),
(22, '2024_07_20_154815_add_status_user', 16),
(23, '2024_07_31_115023_create_roles_table', 17),
(24, '2024_07_31_115422_create_customers_table', 18),
(25, '2024_07_31_115917_create_employees_table', 19),
(26, '2024_07_31_121031_add_role_id_to_users_table', 20),
(29, '2024_08_01_081053_create_detail_products_table', 21),
(30, '2024_08_01_082546_add_detail_product_id_to_detail_orders_table', 22),
(31, '2024_08_01_084044_add_detail_product_id_to_carts_table', 23),
(32, '2024_08_01_213736_add_employee_id_to_orders', 24);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `payment` tinyint(1) NOT NULL DEFAULT 0,
  `total_amount` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_code`, `customer_id`, `employee_id`, `address`, `phone`, `payment`, `total_amount`, `status`, `coupon_id`, `created_at`, `updated_at`) VALUES
(1, 'A2B3108AC4C503', 2, 2, 'Hà Nội', '0999888999', 1, 150000, 3, 3, '2024-07-23 05:09:43', '2024-08-02 18:07:47'),
(2, 'C1D7C8B978B91C', 2, 1, 'Hà Nội', '0999888999', 1, 150000, 1, NULL, '2024-07-23 05:10:09', '2024-07-25 10:58:04'),
(6, '1EF0335B7AE113', 2, 2, 'Tầng 1, Tòa ABC, Đường XYZ, Quận JQK', '0999888999', 1, 115000, 1, NULL, '2024-08-02 17:19:32', '2024-08-02 18:08:13'),
(7, '1081C297B3C420', 2, 2, 'Tầng 1, Tòa ABC, Đường XYZ, Quận JQK', '0999888999', 0, 100000, 2, NULL, '2024-08-02 17:25:30', '2024-08-02 18:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` text NOT NULL,
  `detailed_description` longtext NOT NULL,
  `image` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `short_description`, `detailed_description`, `image`, `slug`, `quantity`, `created_at`, `updated_at`, `category_id`) VALUES
(9, 'Pizza 2', 'Mô tả ngắn', 'Mô tả dài', 'images/vQPtg4Oou2bi2wCZXU2uXjPzr2iJZYy1fdrt7EMm.jpg', 'pizza-21', 15, '2024-07-23 08:00:34', '2024-07-26 05:05:45', 14),
(10, 'Pizza 3', 'Mô tả ngắn', 'Mô tả dài', 'images/Ue95s35KDQtWUaPRcFwYRUX51LdAyWI2QrLlTOUL.jpg', 'pizza-3', 15, '2024-07-23 08:00:57', '2024-07-23 08:00:57', 3),
(12, 'Bánh Pizza giao diện', 'abcde', '<p>Để làm nên chiếc bánh pizza thì mình cần có các nguyên liệu chính như: <a href=\"https://www.bachhoaxanh.com/bot-da-dung-bot-mi\">Bột mì</a>, men nở, <a href=\"https://www.bachhoaxanh.com/dau-an-dau-olive\">dầu oliu</a>. Phần làm nên hương vị của bánh chính là lớp <a href=\"https://www.bachhoaxanh.com/gia-vi-nem-san-sot-ca-mi-y\">sốt cà chua</a> phủ lên trên đế bánh trước khi cho xúc xích, rau củ và cuối cùng chính là phủ lên lớp <a href=\"https://www.bachhoaxanh.com/pho-mai-an/pho-mai-mozzarella-khoi-bottega-zelachi-goi-200g\">phô mai béo mozzarella</a>, <a href=\"https://www.bachhoaxanh.com/pho-mai-an/pho-mai-bottega-zelachi-cheddar-goi-200g-16-mieng\">Cheddar</a>,...</p><p>&nbsp;</p><figure class=\"image\"><img style=\"aspect-ratio:762/429;\" src=\"https://cdn.tgdd.vn/Files/2021/12/07/1402760/tong-hop-cac-cach-lam-pizza-chi-can-o-nha-cung-co-the-thuong-thuc-202112070702477965.jpg\" alt=\"Nguyên liệu làm đế bánh pizza\" width=\"762\" height=\"429\"><figcaption>&nbsp;</figcaption></figure><p><br>&nbsp;</p>', 'images/A8PFK2gN3AhWaAM7hvlgu2B3yWSNEapKfwvJhp3E.jpg', 'banh-pizza-giao-dien', 15, '2024-07-26 05:04:04', '2024-08-02 12:23:02', 2),
(13, 'Pizza Hải Sản', 'Bánh pizza hải sản thơm ngon lắm', '<p>Bánh pizza hải sản thơm ngon,Bánh pizza hải sản thơm ngon,Bánh pizza hải sản thơm ngon</p>', 'images/065LZp2rzU462TeAMx8t1hMqB7v1nxOpVivBgrNx.jpg', 'pizza-hai-san', 15, '2024-07-26 08:26:47', '2024-07-26 08:27:07', 2),
(14, 'Pizza1111', 'abcde', '<p>abcde</p>', 'images/8kcPwk4EQkAXyvZwjAt08Q66mhhmdsD3gm4Cr4lt.png', 'pizza111', 244, '2024-08-01 02:15:44', '2024-08-01 02:16:06', 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_borders`
--

CREATE TABLE `product_borders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `border_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_borders`
--

INSERT INTO `product_borders` (`id`, `product_id`, `border_id`, `created_at`, `updated_at`) VALUES
(5, 9, 8, '2024-08-01 12:30:00', '2024-08-01 12:30:00'),
(7, 9, 3, '2024-08-01 12:31:19', '2024-08-01 12:31:19'),
(8, 9, 8, '2024-08-01 12:31:20', '2024-08-01 12:31:20');

-- --------------------------------------------------------

--
-- Table structure for table `product_toppings`
--

CREATE TABLE `product_toppings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `topping_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_toppings`
--

INSERT INTO `product_toppings` (`id`, `product_id`, `topping_id`, `created_at`, `updated_at`) VALUES
(7, 9, 2, '2024-08-01 12:52:19', '2024-08-01 12:52:19'),
(8, 9, 3, '2024-08-01 12:52:20', '2024-08-01 12:52:20'),
(9, 9, 1, '2024-08-01 12:52:23', '2024-08-01 12:52:23'),
(11, 10, 1, '2024-08-01 12:52:54', '2024-08-01 12:52:54'),
(12, 10, 2, '2024-08-01 12:52:56', '2024-08-01 12:52:56'),
(13, 9, 2, '2024-08-02 07:24:44', '2024-08-02 07:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'manager', '2024-07-31 12:04:42', '2024-07-31 12:04:42'),
(2, 'employee', '2024-07-31 12:04:54', '2024-07-31 12:04:54'),
(3, 'customer', '2024-07-31 12:05:05', '2024-07-31 12:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(5, '30mm', NULL, '2024-08-01 03:09:17'),
(6, 'Medium 1', NULL, '2024-07-25 01:02:25'),
(7, 'Large', NULL, NULL),
(8, 'Extra Large', NULL, NULL),
(10, '15mm', '2024-07-25 00:57:49', '2024-07-25 00:57:49'),
(11, '50mm', '2024-07-25 00:58:17', '2024-07-25 01:01:44'),
(12, 'Rounded', '2024-07-31 11:08:30', '2024-07-31 11:09:58'),
(13, 'Món Nhậu', '2024-07-31 11:08:33', '2024-07-31 11:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `toppings`
--

CREATE TABLE `toppings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `toppings`
--

INSERT INTO `toppings` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Rubber', 0, NULL, NULL),
(2, 'Leather', 16000, NULL, '2024-07-31 11:38:28'),
(3, 'Canvas11', 15000, NULL, '2024-07-31 11:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin@gmail.com', NULL, '$2y$10$Q1WwZ2ryq7/Z0oMaajJOoug0Be8ijiky8aB.3hvxk2gX5.PATlZ0y', 1, NULL, '2024-07-19 11:32:07', '2024-08-01 04:00:15'),
(2, 2, 'nguyenvanb@gmail.com', NULL, '$2y$10$cz1BxdnUoDdzhHRcFtzo3.eyd7EnH5zx1tX7HsnsTu3ewt61mMevi', 1, NULL, '2024-07-20 16:13:26', '2024-07-31 13:18:16'),
(3, 3, 'khachhang@gmail.com', NULL, '$2y$10$tkOwHK6UxxCCs19y5jX9x./Q7rYfva08JnAttEl7p/zZM/7jnI8AC', 1, NULL, '2024-07-31 17:38:06', '2024-07-31 10:58:05'),
(6, 2, 'nguyenvanc@gmail.com', NULL, '$2y$10$lu42guEmbhrOlwRab5Y0WuIOFQncvO95b9Jd8fhOZFVqyWobU15oS', 1, NULL, '2024-08-01 14:27:00', '2024-08-01 14:30:51'),
(7, 3, 'nguyenvane@gmail.com', NULL, '$2y$10$TfFK12F80pApfoWwwOxL2u./dGLYl1GfD5JOr1ZvpK5g0vpZDr.NS', 1, NULL, '2024-08-02 11:53:09', '2024-08-02 11:53:09'),
(8, 3, 'namnguyenvan@gmail.com', NULL, '$2y$10$40tuOW4OduGmHWQ3l0sbs.aCJdWI3Z6i9/.T0uJlG1kcue8kN4f6i', 1, NULL, '2024-08-02 12:04:22', '2024-08-02 12:04:22'),
(9, 3, 'letrunghieu@gmail.com', NULL, '$2y$10$Zs5/Ejc7u7W2l.25a2lI0eG/pX9b04zFTdqmQ0Xs2O0klGUdskDiy', 1, NULL, '2024-08-02 12:06:14', '2024-08-02 12:06:14'),
(10, 3, 'letrongtan@gmail.com', NULL, '$2y$10$wiLdGz39G0FvtQ/rtrxuluhPY.q5usgS1xoIBtAIpQ20VNbghYmya', 1, NULL, '2024-08-02 12:07:07', '2024-08-02 12:07:07'),
(11, 3, 'nguyenvanhung@gmail.com', NULL, '$2y$10$qia83M4b8D8sQRv5JRvl1.EuhpcrdxUA/xm6ZIPnDQ7QUZPQNriyq', 1, NULL, '2024-08-02 12:09:38', '2024-08-02 12:09:38'),
(12, 3, 'nguyenvangiang@gmail.com', NULL, '$2y$10$TupiU/lh3EpUeF6hJb.riOjr51wONg8HKjd13O73iMcKRhufKiW8.', 1, NULL, '2024-08-02 12:11:06', '2024-08-02 12:11:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borders`
--
ALTER TABLE `borders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `carts_detail_product_id_foreign` (`detail_product_id`),
  ADD KEY `border_id` (`border_id`,`topping_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_orders_order_id_foreign` (`order_id`),
  ADD KEY `detail_orders_detail_product_id_foreign` (`detail_product_id`),
  ADD KEY `border_id` (`border_id`,`topping_id`);

--
-- Indexes for table `detail_products`
--
ALTER TABLE `detail_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_products_product_id_foreign` (`product_id`),
  ADD KEY `detail_products_size_id_foreign` (`size_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employees_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`),
  ADD KEY `orders_coupon_id_foreign` (`coupon_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `orders_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_borders`
--
ALTER TABLE `product_borders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_border_product_id_foreign` (`product_id`),
  ADD KEY `product_border_border_id_foreign` (`border_id`);

--
-- Indexes for table `product_toppings`
--
ALTER TABLE `product_toppings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_sole_product_id_foreign` (`product_id`),
  ADD KEY `product_sole_sole_id_foreign` (`topping_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toppings`
--
ALTER TABLE `toppings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borders`
--
ALTER TABLE `borders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `detail_orders`
--
ALTER TABLE `detail_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_products`
--
ALTER TABLE `detail_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_borders`
--
ALTER TABLE `product_borders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_toppings`
--
ALTER TABLE `product_toppings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `toppings`
--
ALTER TABLE `toppings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_detail_product_id_foreign` FOREIGN KEY (`detail_product_id`) REFERENCES `detail_products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_orders`
--
ALTER TABLE `detail_orders`
  ADD CONSTRAINT `detail_orders_detail_product_id_foreign` FOREIGN KEY (`detail_product_id`) REFERENCES `detail_products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_products`
--
ALTER TABLE `detail_products`
  ADD CONSTRAINT `detail_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_products_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_borders`
--
ALTER TABLE `product_borders`
  ADD CONSTRAINT `product_border_border_id_foreign` FOREIGN KEY (`border_id`) REFERENCES `borders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_border_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_toppings`
--
ALTER TABLE `product_toppings`
  ADD CONSTRAINT `product_sole_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_sole_sole_id_foreign` FOREIGN KEY (`topping_id`) REFERENCES `toppings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
