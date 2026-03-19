-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 19, 2026 at 07:13 AM
-- Server version: 9.3.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garments`
--

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Al habib bank', 6, '2026-02-17 13:56:52', '2026-02-17 14:10:38', '2026-02-17 14:10:38'),
(2, 'Al habib bank', 6, '2026-02-17 13:57:34', '2026-02-17 14:10:30', '2026-02-17 14:10:30'),
(3, 'CBANK', 6, '2026-02-17 13:58:15', '2026-02-17 14:15:34', '2026-02-17 14:15:34'),
(4, 'MCB', 6, '2026-02-17 14:06:16', '2026-02-17 14:06:16', NULL),
(5, 'Meezan Bank', 6, '2026-02-17 14:11:18', '2026-02-17 14:11:18', NULL),
(6, 'UBL', 6, '2026-02-20 12:38:07', '2026-02-20 12:38:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int NOT NULL,
  `bill_no` varchar(255) DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `total_amount` bigint DEFAULT NULL,
  `status` int DEFAULT '0',
  `is_cash` int DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bill_products`
--

CREATE TABLE `bill_products` (
  `id` int NOT NULL,
  `bill_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `qty` bigint DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bill_products`
--

INSERT INTO `bill_products` (`id`, `bill_id`, `product_id`, `qty`, `price`, `amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 8, 4, 100, '1900', '190000', '2026-02-22 01:19:56', '2026-02-22 01:39:35', '2026-02-22 01:39:35'),
(2, 8, 4, 180, '3400', '612000', '2026-02-22 01:19:56', '2026-02-22 01:39:35', '2026-02-22 01:39:35'),
(3, 8, 4, 100, '1900', '190000', '2026-02-22 01:39:35', '2026-02-22 01:48:52', '2026-02-22 01:48:52'),
(4, 8, 4, 180, '3400', '612000', '2026-02-22 01:39:35', '2026-02-22 01:48:52', '2026-02-22 01:48:52'),
(5, 8, 4, 100, '1900', '190000', '2026-02-22 01:48:52', '2026-02-22 01:56:26', '2026-02-22 01:56:26'),
(6, 8, 4, 180, '3400', '612000', '2026-02-22 01:48:52', '2026-02-22 01:56:26', '2026-02-22 01:56:26'),
(7, 8, 4, 100, '1900', '190000', '2026-02-22 01:56:26', '2026-02-22 01:57:09', '2026-02-22 01:57:09'),
(8, 8, 4, 120, '3400', '408000', '2026-02-22 01:56:26', '2026-02-22 01:57:09', '2026-02-22 01:57:09'),
(9, 8, 4, 100, '1900', '190000', '2026-02-22 01:57:09', '2026-02-22 01:57:09', NULL),
(10, 8, 4, 40, '3400', '136000', '2026-02-22 01:57:09', '2026-02-22 01:57:09', NULL),
(11, 9, 4, 144, '2300', '331200', '2026-02-22 12:46:26', '2026-02-22 12:46:26', NULL),
(12, 9, 5, 200, '1900', '380000', '2026-02-22 12:46:26', '2026-02-22 12:46:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `link`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Barnes Noble Publish', 'https://www.barnesnoblepublish.com/', '1762454289_logo.webp', '2025-10-26 02:58:31', '2025-11-06 18:38:09'),
(4, 'Key Stone Digital Press', 'https://keystonedigital.press/', '1762618012_keystoone.webp', '2025-10-29 17:24:21', '2025-11-08 16:06:52'),
(5, 'Book Publishers Den', 'https://bookpublishersden.com/', '1762454380_r22-e1705500455978.webp', '2025-11-06 16:56:23', '2025-11-06 18:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:35:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"role-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"role-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:9:\"role-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"role-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:12:\"product-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:14:\"product-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:12:\"product-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:14:\"product-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:9:\"user-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:11:\"user-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:11:\"user-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:9:\"user-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:11:\"bill-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:9:\"bill-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:13:\"customer-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:15:\"customer-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:15:\"customer-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:13:\"customer-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:9:\"bill-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:11:\"bill-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:14:\"customer-laser\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:15:\"expenses-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:13:\"expenses-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:13:\"expenses-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:15:\"expenses-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:11:\"bank-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:9:\"bank-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:11:\"bank-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:9:\"bank-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:29;a:4:{s:1:\"a\";i:30;s:1:\"b\";s:14:\"payment-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:30;a:4:{s:1:\"a\";i:31;s:1:\"b\";s:12:\"payment-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:31;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:12:\"payment-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:32;a:4:{s:1:\"a\";i:33;s:1:\"b\";s:14:\"payment-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:33;a:4:{s:1:\"a\";i:34;s:1:\"b\";s:9:\"roznamcha\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:34;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:9:\"bill-show\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"Admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:8:\"Employee\";s:1:\"c\";s:3:\"web\";}}}', 1773827602);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_records`
--

CREATE TABLE `cash_records` (
  `id` int NOT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `primary_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'Vickey', 'Careem Center', 6, '2026-02-04 04:21:20', '2026-02-04 05:28:16', NULL),
(5, 'Mana Careem Center', NULL, 6, '2026-02-07 08:05:58', '2026-02-07 08:05:58', NULL),
(6, 'ubaid', 'makah center', 6, '2026-02-20 12:33:17', '2026-02-20 12:33:17', NULL),
(7, 'cash', NULL, 6, '2026-02-20 12:36:15', '2026-02-22 00:58:14', '2026-02-22 00:58:14');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

CREATE TABLE `customer_payments` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `amount` bigint DEFAULT NULL,
  `reference` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `is_cheque` int NOT NULL DEFAULT '0',
  `bank_id` int DEFAULT NULL,
  `cheque_no` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `amount` bigint DEFAULT NULL,
  `description` text,
  `refrence` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `brand_id` int DEFAULT NULL,
  `secrete_id` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Completed','Failed','') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `first_name`, `last_name`, `email_address`, `phone_number`, `zip_code`, `address`, `user_id`, `url`, `brand_id`, `secrete_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 'Kyle', 'Ashley', 'depo@mailinator.com', '+1 (712) 657-4342', '82424', 'Placeat dolores dis', 1, 'https://invoice-system.vastreachtechnologies.com/paypal/pay/Key_Stone_Digital/I-939936', 4, 'I-939936', 'Pending', '2025-11-03 17:38:12', '2025-11-04 18:52:47', '2025-11-04 18:03:42'),
(18, 'hanzala', 'ahmed', 'hanzala.ahmed.a2z@gmail.com', '03456985741', '75500', '64 C, 2nd floor 21st Commercial Street, 2 Ext, Phase Defence Housing Authority, Karachi,', 6, 'https://invoice-system.vastreachtechnologies.com/paypal/pay/Barnes_Noble_Publish/I-828527', 1, 'I-828527', 'Completed', '2025-11-03 18:14:31', '2025-11-05 17:02:15', NULL),
(19, 'Libby', 'Foreman', 'abc@gmil.com', '03216905568', '100', 'Lorem non enim disti', 1, 'https://invoice-system.vastreachtechnologies.com/paypal/pay/Key_Stone_Digital/I-848124', 4, 'I-848124', 'Completed', '2025-11-03 19:04:45', '2025-11-04 19:14:57', NULL),
(20, 'test', 'invoice', 'test23@gmail.com', '324234234234', '23423', '343 Noah Dr, US', 6, 'https://invoice-system.vastreachtechnologies.com/paypal/pay/Barnes_Noble_Publish/I-320377', 1, 'I-320377', 'Completed', '2025-11-05 13:59:23', '2025-11-05 16:57:50', NULL),
(21, 'test', 'Invoice', 'test23@gmail.com', '23423423432', '12312', '343 Noah Dr, US', 6, 'https://invoice-system.vastreachtechnologies.com/paypal/pay/Key_Stone_Digital/I-396444', 4, 'I-396444', 'Pending', '2025-11-05 14:05:47', '2025-11-05 14:05:47', NULL),
(22, 'Test', 'Invoie', 'test123@gmail.com', '234234234234', '12312', 'test123@gmail.com', 8, 'https://invoice-system.vastreachtechnologies.com/paypal/pay/Key_Stone_Digital/I-430111', 4, 'I-430111', 'Pending', '2025-11-05 14:20:10', '2025-11-05 14:20:10', NULL),
(23, 'Test Invoice', 'Invoice', 'test123@gmail.com', '23423423', '23422', 'noah dr', 9, 'https://invoice-system.vastreachtechnologies.com/paypal/pay/Barnes_Noble_Publish/I-524805', 1, 'I-524805', 'Pending', '2025-11-05 17:17:59', '2025-11-05 17:17:59', NULL),
(24, 'test', 'invoice', 'test23@gmail.com', '24223423423', '24323', '343 Noah Dr, US', 6, 'https://invoice-system.vastreachtechnologies.com/paypal/pay/Book_Publishers_Den/I-684332', 5, 'I-684332', 'Pending', '2025-11-07 14:11:38', '2025-11-07 14:11:38', NULL),
(25, 'Test', 'Invocie', 'test123@gmail.com', '2243242', '24324', '343 Noah Dr, US', 6, 'https://invoice-system.vastreachtechnologies.com/paypal/pay/Barnes_Noble_Publish/I-585107', 1, 'I-585107', 'Pending', '2025-11-07 14:15:38', '2025-11-07 14:15:38', NULL),
(26, 'hanzala Test', 'Ahmed', 'hanzala.ahmed.promos@gmail.com', '03456985741', '75500', '64 C, 2nd floor 21st Commercial Street, 2 Ext, Phase Defence Housing Authority, Karachi,', 1, 'https://invoice-system.vastreachtechnologies.com/paypal/pay/Key_Stone_Digital_Press/I-906661', 4, 'I-906661', 'Pending', '2025-11-08 16:08:03', '2025-11-08 16:08:03', NULL),
(27, 'test', 'Invoice', 'test23@gmail.com', '42344234234', '23412', '343 Noah Dr, US', 6, 'https://invoice-system.vastreachtechnologies.com/paypal/pay/Book_Publishers_Den/I-705366', 5, 'I-705366', 'Pending', '2025-11-12 21:25:10', '2025-11-12 21:25:10', NULL),
(28, 'test', 'invpoice', 'test23@gmail.com', '2342342342424', '23412', '343 Noah Dr, US', 6, 'https://invoice-system.vastreachtechnologies.com/paypal/pay/Barnes_Noble_Publish/I-123749', 1, 'I-123749', 'Pending', '2025-12-03 15:32:02', '2025-12-03 15:32:02', NULL),
(33, 'Yardley', 'Buckner', 'digig@mailinator.com', '+1 (359) 724-1237', '71117', 'Dolor minus sint duc', 1, '/https://www.barnesnoblepublish.com//I-189595', 1, 'I-189595', 'Pending', '2026-01-27 17:02:12', '2026-01-27 17:02:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_amount`
--

CREATE TABLE `invoice_amount` (
  `id` int NOT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `balance_amount` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `invoice_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `invoice_amount`
--

INSERT INTO `invoice_amount` (`id`, `currency`, `balance_amount`, `discount`, `tax`, `total_amount`, `invoice_id`, `created_at`, `updated_at`) VALUES
(11, 'USD', 0.00, 0.00, 0.00, 56.00, 11, '2025-11-02 12:02:31', '2025-11-02 12:02:31'),
(12, 'USD', 0.00, NULL, NULL, 100.00, 12, '2025-11-03 14:54:21', '2025-11-03 14:54:21'),
(13, 'USD', 0.00, NULL, NULL, 100.00, 13, '2025-11-03 15:13:09', '2025-11-03 15:13:09'),
(14, 'USD', 56.00, 0.00, 42.00, 33.46, 14, '2025-11-03 17:22:22', '2025-11-03 17:22:22'),
(15, 'CAD', 6.00, 0.00, 0.00, 69.00, 15, '2025-11-03 17:31:30', '2025-11-03 17:31:30'),
(16, 'AUD', 44.00, 46.00, 3.00, 3.38, 16, '2025-11-03 17:34:12', '2025-11-03 17:34:12'),
(17, 'AUD', 0.00, NULL, 88.00, 47.00, 17, '2025-11-03 17:38:12', '2025-11-03 17:38:12'),
(18, 'USD', 10.00, 10.00, 10.00, 89.00, 18, '2025-11-03 18:14:31', '2025-11-04 17:19:22'),
(19, 'Select Currency', 0.00, 0.00, 0.00, 165.00, 19, '2025-11-03 19:04:45', '2025-11-04 18:38:42'),
(20, 'USD', 0.00, 0.00, 0.00, 234.00, 20, '2025-11-05 13:59:23', '2025-11-05 13:59:23'),
(21, 'USD', 0.00, 0.00, 0.00, 234.00, 21, '2025-11-05 14:05:47', '2025-11-05 14:05:47'),
(22, 'USD', 0.00, 0.00, 0.00, 234.00, 22, '2025-11-05 14:20:10', '2025-11-05 14:20:10'),
(23, 'USD', 0.00, 0.00, 0.00, 234.00, 23, '2025-11-05 17:17:59', '2025-11-05 17:17:59'),
(24, 'USD', 0.00, 0.00, 0.00, 2342.00, 24, '2025-11-07 14:11:38', '2025-11-07 14:11:38'),
(25, 'USD', 0.00, 0.00, 0.00, 250.00, 25, '2025-11-07 14:15:38', '2025-11-07 14:15:38'),
(26, 'USD', 10.00, 10.00, 10.00, 89.00, 26, '2025-11-08 16:08:03', '2025-11-08 16:08:03'),
(27, 'USD', 0.00, 0.00, 0.00, 299.00, 27, '2025-11-12 21:25:10', '2025-11-12 21:25:10'),
(28, 'USD', 0.00, 0.00, 4.00, 518.96, 28, '2025-12-03 15:32:02', '2025-12-03 15:32:02'),
(33, 'Select Currency', 95.00, 8.00, 89.00, 267.88, 33, '2026-01-27 17:02:12', '2026-01-27 17:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE `ledger` (
  `id` int NOT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `primary_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_24_210712_create_permission_tables', 1),
(5, '2025_10_24_211008_create_products_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(1, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 7),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 9);

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int NOT NULL,
  `description` text,
  `amount` decimal(11,2) DEFAULT NULL,
  `invoice_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `description`, `amount`, `invoice_id`, `created_at`, `updated_at`) VALUES
(12, 'Laborum quae consequ', 56.00, 11, '2025-11-02 12:02:31', '2025-11-02 12:02:31'),
(13, 'Test Service', 100.00, 12, '2025-11-03 14:54:21', '2025-11-03 14:54:21'),
(14, 'Test Invoice', 100.00, 13, '2025-11-03 15:13:09', '2025-11-03 15:13:09'),
(15, 'Enim in dolores corp', 63.00, 14, '2025-11-03 17:22:22', '2025-11-03 17:22:22'),
(16, 'Odio eu ea laboriosa', 75.00, 15, '2025-11-03 17:31:30', '2025-11-03 17:31:30'),
(17, 'Lorem quasi numquam', 92.00, 16, '2025-11-03 17:34:12', '2025-11-03 17:34:12'),
(18, 'Quos aut minus conse', 25.00, 17, '2025-11-03 17:38:12', '2025-11-03 17:38:12'),
(19, 'Test', 100.00, 18, '2025-11-03 18:14:31', '2025-11-03 18:14:31'),
(25, 'Adipisicing laboris', 65.00, 19, '2025-11-04 18:38:42', '2025-11-04 18:38:42'),
(26, 'test', 100.00, 19, '2025-11-04 18:38:42', '2025-11-04 18:38:42'),
(27, 'Test Invoice', 234.00, 20, '2025-11-05 13:59:23', '2025-11-05 13:59:23'),
(28, 'test', 234.00, 21, '2025-11-05 14:05:47', '2025-11-05 14:05:47'),
(29, 'Test', 234.00, 22, '2025-11-05 14:20:10', '2025-11-05 14:20:10'),
(30, 'test', 234.00, 23, '2025-11-05 17:17:59', '2025-11-05 17:17:59'),
(31, 'test invoice', 2342.00, 24, '2025-11-07 14:11:38', '2025-11-07 14:11:38'),
(32, 'test product', 250.00, 25, '2025-11-07 14:15:38', '2025-11-07 14:15:38'),
(33, 'Test', 100.00, 26, '2025-11-08 16:08:03', '2025-11-08 16:08:03'),
(34, 'Test Package', 299.00, 27, '2025-11-12 21:25:10', '2025-11-12 21:25:10'),
(35, 'test', 499.00, 28, '2025-12-03 15:32:02', '2025-12-03 15:32:02'),
(40, 'Aliquip sint modi e', 200.00, 33, '2026-01-27 17:02:12', '2026-01-27 17:02:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2025-10-24 16:23:39', '2025-10-24 16:23:39'),
(2, 'role-create', 'web', '2025-10-24 16:23:39', '2025-10-24 16:23:39'),
(3, 'role-edit', 'web', '2025-10-24 16:23:39', '2025-10-24 16:23:39'),
(4, 'role-delete', 'web', '2025-10-24 16:23:39', '2025-10-24 16:23:39'),
(5, 'product-list', 'web', '2025-10-24 16:23:39', '2025-10-24 16:23:39'),
(6, 'product-create', 'web', '2025-10-24 16:23:39', '2025-10-24 16:23:39'),
(7, 'product-edit', 'web', '2025-10-24 16:23:39', '2025-10-24 16:23:39'),
(8, 'product-delete', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(9, 'user-list', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(10, 'user-create', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(11, 'user-delete', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(12, 'user-edit', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(13, 'bill-create', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(14, 'bill-list', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(15, 'customer-list', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(16, 'customer-create', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(17, 'customer-delete', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(18, 'customer-edit', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(19, 'bill-edit', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(20, 'bill-delete', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(21, 'customer-laser', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(22, 'expenses-create', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(23, 'expenses-list', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(24, 'expenses-edit', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(25, 'expenses-delete', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(26, 'bank-delete', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(27, 'bank-edit', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(28, 'bank-create', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(29, 'bank-list', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(30, 'payment-create', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(31, 'payment-list', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(32, 'payment-edit', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(33, 'payment-delete', 'web', '2025-10-24 16:23:40', '2025-10-24 16:23:40'),
(34, 'roznamcha', 'web', '2025-10-24 16:23:39', '2025-10-24 16:23:39'),
(35, 'bill-show', 'web', '2025-10-24 16:23:39', '2025-10-24 16:23:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int DEFAULT NULL,
  `size_id` int DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `detail`, `user_id`, `size_id`, `amount`, `created_at`, `updated_at`) VALUES
(4, 'Hayfa Case', NULL, 6, 1, NULL, '2026-02-06 07:40:09', '2026-02-06 07:40:09'),
(5, 'KALI  WALA', NULL, 6, 2, NULL, '2026-02-08 13:00:46', '2026-02-08 13:00:46'),
(6, 'Contrast Dobapata', NULL, 6, 2, '16300', '2026-03-17 05:06:53', '2026-03-18 01:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_cost`
--

CREATE TABLE `product_cost` (
  `id` int NOT NULL,
  `description` text,
  `amount` varchar(255) DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_cost`
--

INSERT INTO `product_cost` (`id`, `description`, `amount`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(5, 'crincal kapra', '14300', 6, 6, '2026-03-18 01:23:08', '2026-03-18 01:23:08'),
(6, 'malai 4*500', '2000', 6, 6, '2026-03-18 01:23:44', '2026-03-18 01:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2025-10-24 16:24:42', '2025-10-24 16:24:42'),
(2, 'Employee', 'web', '2025-10-24 16:32:21', '2025-10-25 04:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(13, 2),
(14, 2),
(19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('sEwjMZu7JalYOGXH8j2uhmuMRHu1jEVnwT9QhZNi', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMlBOQUdGTDFrOE0zbHJaQ1J1UUk5TTZFVG9qbFEyS2hnUEVzcVRQYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9wcmFjdGljZS50ZXN0L3Byb2R1Y3RzLzYvZWRpdCI7czo1OiJyb3V0ZSI7czoxMzoicHJvZHVjdHMuZWRpdCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjY7fQ==', 1773815040);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `id` int NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`id`, `size`, `created_at`, `updated_at`) VALUES
(1, '16/22', '2026-03-17 09:57:09', NULL),
(2, '24/30', '2026-03-17 09:57:21', NULL),
(3, '36/38', '2026-03-17 09:57:38', NULL),
(4, 'Free size', '2026-03-17 09:57:38', NULL),
(5, '32/38', '2026-03-17 09:57:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `old_email`, `email_verified_at`, `password`, `profile`, `deleted_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'shoaib', 'shoaibnasir315@gmail.com', NULL, NULL, '$2y$12$/aQ6Ef.Tm69MS1wKiSkVXeseTx1glpiXnVJ.FQD5BotB4o9xpLkI2', NULL, NULL, NULL, '2025-10-24 16:32:54', '2025-11-03 17:23:05'),
(5, 'Demo', 'demo@gmail.com_2025-11-03 17:14:26', 'demo@gmail.com', NULL, '$2y$12$nYsrHtLG.5xWUXFHd6VM9uhblujw19I2/lFCfMNciCbBx9GAEm/AG', NULL, '2025-11-03 17:14:26', NULL, '2025-10-29 17:19:53', '2025-11-03 17:14:26'),
(6, 'Super Admin', 'superadmin@gmail.com', NULL, NULL, '$2y$12$/aQ6Ef.Tm69MS1wKiSkVXeseTx1glpiXnVJ.FQD5BotB4o9xpLkI2', NULL, NULL, NULL, '2025-11-01 16:25:44', '2025-11-01 16:25:44'),
(7, 'demo', 'hanzala.ahmed.a2z@gmail.com', NULL, NULL, '$2y$12$i6qZ3aDg3JDZZPPjuS3GDOoJ/nEObnfKmvAH9ATyp1VLUS8mPaV0y', NULL, NULL, NULL, '2025-11-03 18:08:38', '2025-12-01 15:04:37'),
(8, 'test user', 'test23@gmail.com_2025-11-05 14:31:06', 'test23@gmail.com', NULL, '$2y$12$oGy6wZOdAWUetXej0GItlO9g7Ko3zpk.aSoFub3Pb/QmsrSvJP7/S', NULL, '2025-11-05 14:31:06', NULL, '2025-11-05 14:16:00', '2025-11-05 14:31:06'),
(9, 'Test User', 'test123@gmail.com', NULL, NULL, '$2y$12$duHTM9U8hWToOM88kmseQOu8f8L6I3W0qh5RspL81jNk/TEE2kMuC', NULL, NULL, NULL, '2025-11-05 17:15:01', '2025-11-05 17:15:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill_products`
--
ALTER TABLE `bill_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `cash_records`
--
ALTER TABLE `cash_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_amount`
--
ALTER TABLE `invoice_amount`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `ledger`
--
ALTER TABLE `ledger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_cost`
--
ALTER TABLE `product_cost`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
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
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bill_products`
--
ALTER TABLE `bill_products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cash_records`
--
ALTER TABLE `cash_records`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_payments`
--
ALTER TABLE `customer_payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `invoice_amount`
--
ALTER TABLE `invoice_amount`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledger`
--
ALTER TABLE `ledger`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_cost`
--
ALTER TABLE `product_cost`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
