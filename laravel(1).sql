-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2025 at 09:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'bola', 'a', '2025-01-13 21:52:20', '2025-01-13 21:52:20');

-- --------------------------------------------------------

--
-- Table structure for table `consumables`
--

CREATE TABLE `consumables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consumables`
--

INSERT INTO `consumables` (`id`, `name`, `description`, `category_id`, `stock`, `reorder_level`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Coffee', 'Hot drink made from brewed coffee beans.', 1, 150, 20, 5.00, '2025-01-14 16:30:32', '2025-01-14 16:30:32'),
(2, 'Tea', 'Hot drink made from steeped tea leaves.', 1, 120, 15, 3.50, '2025-01-14 16:30:32', '2025-01-14 16:30:32'),
(3, 'Broom', 'Tool for sweeping the floor.', 2, 50, 5, 8.00, '2025-01-14 16:30:32', '2025-01-14 16:30:32'),
(4, 'Mop', 'Used for cleaning floors with a wet cloth.', 2, 80, 10, 7.00, '2025-01-14 16:30:32', '2025-01-14 16:30:32'),
(5, 'Pen', 'A tool for writing or drawing with ink.', 3, 200, 30, 1.50, '2025-01-14 16:30:32', '2025-01-14 16:30:32'),
(6, 'Notebook', 'A book of paper for writing or drawing in.', 3, 100, 20, 2.00, '2025-01-14 16:30:32', '2025-01-14 16:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `consumable_allocations`
--

CREATE TABLE `consumable_allocations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `consumable_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `allocated_by` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `allocated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'dalam pemakaian',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consumable_categories`
--

CREATE TABLE `consumable_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consumable_categories`
--

INSERT INTO `consumable_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'e', 'e', '2025-01-13 21:56:49', '2025-01-13 21:56:49'),
(2, 'eeee', 'e', '2025-01-13 22:02:02', '2025-01-13 22:02:02'),
(3, 'Beverages', 'Category for drink items.', '2025-01-14 16:27:25', '2025-01-14 16:27:25'),
(4, 'Cleaning Supplies', 'Category for cleaning-related items.', '2025-01-14 16:27:25', '2025-01-14 16:27:25'),
(5, 'Stationery', 'Category for office supplies.', '2025-01-14 16:27:25', '2025-01-14 16:27:25');

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
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `hp` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`guest_id`, `name`, `email`, `hp`, `address`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'johndoe@example.com', '081234567890', 'Jl. Merdeka No. 10', '2025-01-14 15:48:12', '2025-01-14 15:48:12'),
(2, 'Jane Smith', 'janesmith@example.com', '082345678901', 'Jl. Raya No. 20', '2025-01-14 15:48:12', '2025-01-14 15:48:12'),
(3, 'Alice Johnson', 'alicejohnson@example.com', '083456789012', 'Jl. Kebon Jeruk No. 30', '2025-01-14 15:48:12', '2025-01-14 15:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `status` enum('baik','rusak','hilang') NOT NULL DEFAULT 'baik',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_allocations`
--

CREATE TABLE `inventory_allocations` (
  `allocation_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `inventory_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_categories`
--

CREATE TABLE `inventory_categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_11_02_110536_create_items_table', 1),
(5, '2024_11_02_110735_create_categories_table', 1),
(6, '2024_11_02_110850_create_suppliers_table', 1),
(7, '2024_11_04_040122_create_transactions_table', 1),
(8, '2024_11_08_074729_create_room_types_table', 1),
(9, '2024_11_08_091927_create_rooms_table', 1),
(10, '2024_11_08_102549_create_inventory_categories_table', 1),
(11, '2024_11_08_141423_create_inventories_table', 1),
(12, '2024_11_08_143542_create_inventory_allocations_table', 1),
(13, '2024_11_09_012325_create_guests_table', 1),
(14, '2024_11_09_022856_create_reservations_table', 1),
(15, '2024_11_16_073815_create_consumables_table', 1),
(16, '2024_11_16_074045_create_consumable_categories_table', 1),
(17, '2024_11_16_085047_create_consumable_allocations_table', 1),
(18, '2025_01_13_172306_create_unconsumable_categories_table', 1),
(19, '2025_01_13_182934_create_unconsumable_allocations_table', 1),
(20, '2025_01_14_044353_create_unconsumables_table', 1),
(21, '2025_01_14_072444_add_quantity_to_unconsumable_allocations_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` bigint(20) UNSIGNED NOT NULL,
  `guest_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `status` enum('reserved','checked_in','checked_out','cancelled') NOT NULL DEFAULT 'reserved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `guest_id`, `room_id`, `check_in_date`, `check_out_date`, `status`, `created_at`, `updated_at`) VALUES
(19, 1, 64, '2025-02-01', '2025-02-07', 'reserved', '2025-01-14 15:51:58', '2025-01-14 15:51:58'),
(20, 2, 66, '2025-02-03', '2025-02-10', 'reserved', '2025-01-14 15:51:58', '2025-01-14 15:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `room_type_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('available','occupied','maintenance') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_number`, `room_type_id`, `status`, `created_at`, `updated_at`) VALUES
(63, '201', 2, 'occupied', '2025-01-14 15:40:53', '2025-01-14 15:40:53'),
(64, '202', 2, 'available', '2025-01-14 15:40:53', '2025-01-14 15:40:53'),
(65, '301', 3, 'maintenance', '2025-01-14 15:40:53', '2025-01-14 15:40:53'),
(66, '302', 3, 'available', '2025-01-14 15:40:53', '2025-01-14 15:40:53'),
(67, '401', 4, 'available', '2025-01-14 15:40:53', '2025-01-14 15:40:53'),
(68, '402', 4, 'occupied', '2025-01-14 15:40:53', '2025-01-14 15:40:53'),
(69, '501', 5, 'available', '2025-01-14 15:40:53', '2025-01-14 15:40:53'),
(70, '502', 5, 'available', '2025-01-14 15:40:53', '2025-01-14 15:40:53');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

CREATE TABLE `room_types` (
  `room_type_id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(12,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`room_type_id`, `type_name`, `description`, `price`, `created_at`, `updated_at`) VALUES
(2, 'Standard Single', 'Basic room with single bed', 500000, '2025-01-14 15:29:26', '2025-01-14 15:29:26'),
(3, 'Standard Double', 'Basic room with double bed', 750000, '2025-01-14 15:29:26', '2025-01-14 15:29:26'),
(4, 'Deluxe Single', 'Deluxe room with single bed', 1000000, '2025-01-14 15:29:26', '2025-01-14 15:29:26'),
(5, 'Deluxe Double', 'Deluxe room with double bed', 1250000, '2025-01-14 15:29:26', '2025-01-14 15:29:26'),
(6, 'Suite', 'Luxury suite with living room', 2000000, '2025-01-14 15:29:26', '2025-01-14 15:29:26'),
(7, 'Executive Suite', 'Premium suite with workspace', 2500000, '2025-01-14 15:29:26', '2025-01-14 15:29:26'),
(8, 'Family Room', 'Large room for families', 1800000, '2025-01-14 15:29:26', '2025-01-14 15:29:26'),
(9, 'Presidential Suite', 'Top-tier luxury accommodation', 5000000, '2025-01-14 15:29:26', '2025-01-14 15:29:26'),
(10, 'Twin Room', 'Room with two single beds', 900000, '2025-01-14 15:29:26', '2025-01-14 15:29:26'),
(11, 'Connecting Room', 'Two connected rooms', 1600000, '2025-01-14 15:29:26', '2025-01-14 15:29:26'),
(12, 'Standard Single', 'Basic room with single bed', 500000, '2025-01-14 15:34:09', '2025-01-14 15:34:09'),
(13, 'Standard Double', 'Basic room with double bed', 750000, '2025-01-14 15:34:09', '2025-01-14 15:34:09'),
(14, 'Deluxe Single', 'Deluxe room with single bed', 1000000, '2025-01-14 15:34:09', '2025-01-14 15:34:09'),
(15, 'Deluxe Double', 'Deluxe room with double bed', 1250000, '2025-01-14 15:34:09', '2025-01-14 15:34:09'),
(16, 'Suite', 'Luxury suite with living room', 2000000, '2025-01-14 15:34:09', '2025-01-14 15:34:09'),
(17, 'Executive Suite', 'Premium suite with workspace', 2500000, '2025-01-14 15:34:09', '2025-01-14 15:34:09'),
(18, 'Family Room', 'Large room for families', 1800000, '2025-01-14 15:34:09', '2025-01-14 15:34:09'),
(19, 'Presidential Suite', 'Top-tier luxury accommodation', 5000000, '2025-01-14 15:34:09', '2025-01-14 15:34:09'),
(20, 'Twin Room', 'Room with two single beds', 900000, '2025-01-14 15:34:09', '2025-01-14 15:34:09'),
(21, 'Connecting Room', 'Two connected rooms', 1600000, '2025-01-14 15:34:09', '2025-01-14 15:34:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5ic6su7yUaEufmFVtf3yQSfJoWyH97es9cSflVC2', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:134.0) Gecko/20100101 Firefox/134.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiY1VwRk1EN0xiUFFEVXJpQWg3UnAxWEJwWkVBVGdqSWRZMUs4S0ttYyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0NjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3VuY29uc3VtYWJsZV9hbGxvY2F0aW9ucyI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMyOiJodHRwOi8vMTI3LjAuMC4xOjgwMDEvY2F0ZWdvcmllcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1736872396),
('O0k8Oqtsa6QSywvuTK7YqULoMSjVj63OQFxoAoxH', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:134.0) Gecko/20100101 Firefox/134.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaFJWc1l1aW51cjJDU1Q2c3J2UjB5eGVPTWRDRjAyRmdNd0x3Qm9aeCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMToiaHR0cDovLzEyNy4wLjAuMTo4MDAxL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDEvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1736870866),
('ZAKR5utkHfYFrVa9j4XnW6hEIB38uIT9wEOWpiKr', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:134.0) Gecko/20100101 Firefox/134.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicHozaG1UNzUwdkR4WjA1cU1PcjcxT21LYmp5WE5zTmhCa1ZHbFlPZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1736870866);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_info` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact_info`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Supplier A', '081234567890', 'Jl. Raya No. 5, Jakarta', '2025-01-14 15:53:54', '2025-01-14 15:53:54'),
(2, 'Supplier B', 'supplierb@example.com', 'Jl. Merdeka No. 10, Bandung', '2025-01-14 15:53:54', '2025-01-14 15:53:54'),
(3, 'Supplier C', '085678912345', 'Jl. Kebon Jeruk No. 15, Surabaya', '2025-01-14 15:53:54', '2025-01-14 15:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `transaction_type` enum('IN','OUT') NOT NULL,
  `quantity` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unconsumables`
--

CREATE TABLE `unconsumables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL,
  `reorder_level` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unconsumables`
--

INSERT INTO `unconsumables` (`id`, `name`, `description`, `category_id`, `stock`, `reorder_level`, `price`, `created_at`, `updated_at`) VALUES
(1, 'kasur', NULL, 1, 43, 1, 1111111.00, '2025-01-13 22:39:44', '2025-01-14 02:01:44'),
(2, 'r', NULL, 1, 51, 3, 1000000.00, '2025-01-13 22:51:34', '2025-01-14 00:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `unconsumable_allocations`
--

CREATE TABLE `unconsumable_allocations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unconsumable_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `allocated_by` bigint(20) UNSIGNED NOT NULL,
  `allocated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'dalam pemakaian',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `damage_reported_at` timestamp NULL DEFAULT NULL,
  `damage_description` text DEFAULT NULL,
  `is_damaged` tinyint(1) NOT NULL DEFAULT 0,
  `deskripsi` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unconsumable_categories`
--

CREATE TABLE `unconsumable_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unconsumable_categories`
--

INSERT INTO `unconsumable_categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'w', 'w', '2025-01-13 22:36:59', '2025-01-13 22:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'budi', 'budi@gmail.com', NULL, '$2y$12$EOfeGqaFgZOF10O.454Zhuap/PUja5Owh2MzQjW71c6HrUJPUJKbu', NULL, '2025-01-13 21:50:33', '2025-01-13 21:50:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumables`
--
ALTER TABLE `consumables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumable_allocations`
--
ALTER TABLE `consumable_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consumable_allocations_consumable_id_foreign` (`consumable_id`),
  ADD KEY `consumable_allocations_room_id_foreign` (`room_id`),
  ADD KEY `consumable_allocations_allocated_by_foreign` (`allocated_by`);

--
-- Indexes for table `consumable_categories`
--
ALTER TABLE `consumable_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`),
  ADD UNIQUE KEY `guests_email_unique` (`email`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `inventories_category_id_foreign` (`category_id`);

--
-- Indexes for table `inventory_allocations`
--
ALTER TABLE `inventory_allocations`
  ADD PRIMARY KEY (`allocation_id`),
  ADD KEY `inventory_allocations_room_id_foreign` (`room_id`),
  ADD KEY `inventory_allocations_inventory_id_foreign` (`inventory_id`);

--
-- Indexes for table `inventory_categories`
--
ALTER TABLE `inventory_categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `inventory_categories_category_name_unique` (`category_name`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `reservations_guest_id_foreign` (`guest_id`),
  ADD KEY `reservations_room_id_foreign` (`room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD UNIQUE KEY `rooms_room_number_unique` (`room_number`),
  ADD KEY `rooms_room_type_id_foreign` (`room_type_id`);

--
-- Indexes for table `room_types`
--
ALTER TABLE `room_types`
  ADD PRIMARY KEY (`room_type_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `transactions_item_id_foreign` (`item_id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `unconsumables`
--
ALTER TABLE `unconsumables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `unconsumable_allocations`
--
ALTER TABLE `unconsumable_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unconsumable_id` (`unconsumable_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `allocated_by` (`allocated_by`);

--
-- Indexes for table `unconsumable_categories`
--
ALTER TABLE `unconsumable_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `consumables`
--
ALTER TABLE `consumables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `consumable_allocations`
--
ALTER TABLE `consumable_allocations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `consumable_categories`
--
ALTER TABLE `consumable_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `inventory_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_allocations`
--
ALTER TABLE `inventory_allocations`
  MODIFY `allocation_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_categories`
--
ALTER TABLE `inventory_categories`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `room_types`
--
ALTER TABLE `room_types`
  MODIFY `room_type_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unconsumables`
--
ALTER TABLE `unconsumables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unconsumable_allocations`
--
ALTER TABLE `unconsumable_allocations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unconsumable_categories`
--
ALTER TABLE `unconsumable_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consumable_allocations`
--
ALTER TABLE `consumable_allocations`
  ADD CONSTRAINT `consumable_allocations_allocated_by_foreign` FOREIGN KEY (`allocated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `consumable_allocations_consumable_id_foreign` FOREIGN KEY (`consumable_id`) REFERENCES `consumables` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `consumable_allocations_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE;

--
-- Constraints for table `inventories`
--
ALTER TABLE `inventories`
  ADD CONSTRAINT `inventories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `inventory_categories` (`category_id`) ON DELETE SET NULL;

--
-- Constraints for table `inventory_allocations`
--
ALTER TABLE `inventory_allocations`
  ADD CONSTRAINT `inventory_allocations_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`inventory_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `inventory_allocations_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_room_type_id_foreign` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`room_type_id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `unconsumables`
--
ALTER TABLE `unconsumables`
  ADD CONSTRAINT `unconsumables_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `unconsumable_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `unconsumable_allocations`
--
ALTER TABLE `unconsumable_allocations`
  ADD CONSTRAINT `unconsumable_allocations_ibfk_1` FOREIGN KEY (`unconsumable_id`) REFERENCES `unconsumable_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `unconsumable_allocations_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `unconsumable_allocations_ibfk_3` FOREIGN KEY (`allocated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
