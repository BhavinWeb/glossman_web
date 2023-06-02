-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: db5010664370.hosting-data.io
-- Generation Time: Feb 01, 2023 at 09:51 AM
-- Server version: 8.0.26
-- PHP Version: 7.0.33-0+deb9u12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbs9022635`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint UNSIGNED NOT NULL,
  `addressable_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `addressable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('home','office','other') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_charge` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `addressable_id`, `user_id`, `addressable_type`, `first_name`, `last_name`, `company_name`, `address`, `area`, `country_id`, `state_id`, `city_id`, `zip_code`, `email`, `country_code`, `phone`, `type`, `shipping_charge`, `created_at`, `updated_at`) VALUES
(1, NULL, 2, NULL, 'Tanvi', 'morker', NULL, 'madhuvan circle', 'adajan', '38', '659', '10060', '395009', 'tanvi.morker@freshcodes.in', '+(91)', '9898989898', 'home', '23.22', NULL, NULL),
(2, NULL, 6, NULL, 'madhuri', 'test', NULL, 'add the address name', 'add the area name', '38', '658', '10053', 'test11', 'test@gmail.com', '+(91)', '9876543210', 'other', '23.22', NULL, NULL),
(3, NULL, 8, NULL, 'joshi', 'bhushan', NULL, 'canb', 'test', '38', '661', '48324', '1uuwuw', 'joshi@yopmail.com', '+(91)', '9985033903', 'home', '23.22', NULL, NULL),
(4, NULL, 7, NULL, 'tanvi', 'morker', NULL, 'madhuvan circle', 'adajan', '38', '659', '10062', '395009', 'tanvi.morker@freshcodes.in', '+(91)', '8799585740', 'home', '23.22', NULL, NULL),
(5, NULL, 10, NULL, 'Madhuri', 'Test', NULL, 'lp savani road surat', 'Please add the area', '38', '659', '10061', 'A1A1A1', 'madhuri.waghel@freshcodes.in', NULL, '9876543210', 'home', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'backend/image/default.png',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@mail.com', '2022-10-05 05:33:07', '$2y$10$idAPlH5V5z2xqZWtS18do.2L/RfcJpUKwtsveDvw4Yf8zaLATjOOq', 'user/FILE_63b7e2cbc0c9463b7e2cb.png', '0k07q1YBJqrPqJ4hfYceso1SQyeyNPSqhqQ2jl8237j8YrWLbhlk0wpuvyp7', '2022-10-05 05:33:07', '2023-01-06 13:58:51'),
(2, 'an', 'an@yopmail.com', NULL, '$2y$10$vYJGWM8x3us7teYhwGEgWOrliantd.s539zQM7M28SrD77QiiB076', 'backend/image/default.png', NULL, '2022-12-23 09:54:10', '2022-12-23 09:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `admin_searches`
--

CREATE TABLE `admin_searches` (
  `id` bigint UNSIGNED NOT NULL,
  `page_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `frontend_type` enum('select','radio') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint UNSIGNED NOT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `discount`, `created_at`, `updated_at`) VALUES
(2, 'brand 1', 'brand-1', NULL, '2022-11-18 17:51:48', '2022-11-18 17:51:48'),
(3, 'Brand 2', 'brand-2', NULL, '2022-11-18 17:51:56', '2022-11-18 17:51:56'),
(4, 'Brand 3', 'brand-3', NULL, '2022-11-18 17:52:06', '2022-11-18 17:52:06'),
(5, 'Brand 4', 'brand-4', NULL, '2022-11-18 17:52:17', '2022-11-18 17:52:17'),
(6, 'Brand 6', 'brand-6', NULL, '2022-11-18 17:52:37', '2022-11-18 17:52:37'),
(8, 'Brand7', 'brand7', NULL, '2022-11-25 20:17:10', '2022-11-25 20:17:10'),
(9, 'brand 42', 'brand-42', NULL, '2023-01-02 11:29:35', '2023-01-02 11:29:35'),
(10, 'new brand', 'new-brand', NULL, '2023-01-27 17:01:31', '2023-01-27 17:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `browsing_histories`
--

CREATE TABLE `browsing_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `device_ip` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `discount_type` enum('percentage','amount') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_value` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `title`, `slug`, `image`, `start_date`, `end_date`, `discount_type`, `discount_value`, `status`, `created_at`, `updated_at`) VALUES
(3, 'test', 'test', 'uploads/campaign/image/1671791535_63a583afee9ec.png', '2022-12-01', '2022-12-31', 'amount', 10, 1, '2022-12-23 10:32:15', '2022-12-24 13:52:03');

-- --------------------------------------------------------

--
-- Table structure for table `campaign_offers`
--

CREATE TABLE `campaign_offers` (
  `id` bigint UNSIGNED NOT NULL,
  `home_page_content_id` bigint UNSIGNED NOT NULL,
  `campaign_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaign_products`
--

CREATE TABLE `campaign_products` (
  `id` bigint UNSIGNED NOT NULL,
  `campaign_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `card_number` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_holder_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_date` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `user_id`, `card_number`, `card_holder_name`, `card_type`, `expire_date`, `created_at`, `updated_at`) VALUES
(1, 15, '1234123412341239', '1sdfsdf', 'visa', '27/02', NULL, '2022-12-14 10:12:19'),
(2, 19, '2222555577774444', 'test user name', 'mastercard', '03/30', NULL, NULL),
(3, NULL, '1234123412341234', 'bhavin patel', 'visa', '27/89', '2022-11-25 18:34:34', '2022-11-25 18:34:34'),
(4, NULL, '1234123412341234', 'bhavin patel', 'visa', '27/89', '2022-11-25 18:35:15', '2022-11-25 18:35:15'),
(5, NULL, '1234123412341234', 'bhavin patel', 'visa', '27/89', '2022-11-25 18:50:07', '2022-11-25 18:50:07'),
(6, NULL, '1234123412341234', 'bhavin patel', 'visa', '27/89', '2022-11-25 18:50:27', '2022-11-25 18:50:27'),
(7, NULL, '1234123412341234', 'bhavin patel', 'visa', '27/89', '2022-11-25 18:55:23', '2022-11-25 18:55:23'),
(8, NULL, '1234123412341234', 'bhavin patel', 'visa', '27/89', '2022-11-25 18:56:25', '2022-11-25 18:56:25'),
(9, NULL, '1234123412341234', 'bhavin patel', 'visa', '27/89', '2022-11-25 18:57:06', '2022-11-25 18:57:06'),
(10, NULL, '1234123412341234', 'bhavin patel', 'visa', '27/89', '2022-11-25 19:00:39', '2022-11-25 19:00:39'),
(11, NULL, '1234123412341234', 'bhavin patel', 'visa', '27/89', '2022-11-25 19:03:07', '2022-11-25 19:03:07'),
(12, 19, '5234123412341234', 'bhavin patel', 'visa', '27/89', '2022-11-28 11:03:01', '2022-11-28 11:03:01'),
(13, 19, '1234123412341234', 'bhavin patel', 'visa', '27/89', '2022-11-28 11:03:10', '2022-11-28 11:03:10'),
(14, 19, '5034123412341234', 'bhavin patel', 'visa', '27/89', '2022-11-28 11:05:22', '2022-11-28 11:05:22'),
(15, 19, '1234123412341234', 'bhavin patel', 'visa', '27/89', '2022-11-28 11:07:05', '2022-11-28 11:07:05'),
(16, 15, '1234123412341234', 'bhavin patel', 'visa', '27/89', '2022-11-28 11:15:26', '2022-11-28 11:15:26'),
(17, 15, '1234123412341235', 'bhavin patel', 'visa', '27/89', '2022-11-28 11:30:06', '2022-11-28 11:30:06'),
(18, 15, '1234123412341235', 'bhavin patel', 'visa', '27/89', '2022-11-28 11:30:14', '2022-11-28 11:30:14'),
(19, 15, '1234123412341239', '1sdfsdf', 'visa', '27/02', '2022-11-28 11:40:14', '2022-11-28 11:40:14'),
(20, 15, '4242424242424242', 'bhavin patel', 'visa', '27/89', '2022-11-28 12:20:57', '2022-11-28 12:20:57'),
(21, 15, '5555555555554444', 'bhavin patel', 'visa', '27/89', '2022-11-28 12:21:05', '2022-11-28 12:21:05'),
(22, 15, '1234123412341230', '1sdfsdf', 'visa', '27/02', '2022-11-28 16:32:57', '2022-11-28 16:32:57'),
(23, 15, '1234123412341231', '1sdfsdf', 'visa', '27/02', '2022-11-28 16:35:28', '2022-11-28 16:35:28'),
(24, 15, '1234123412341237', '1sdfsdf', 'visa', '27/02', '2022-11-28 17:30:15', '2022-11-28 17:30:15'),
(26, 97, '1234123412341014', '1sdfsdf', 'visa', '27/02', '2022-11-28 17:31:10', '2022-11-28 17:31:10'),
(27, 15, '1234123412342014', '1sdfsdf', 'visa', '27/02', '2022-11-28 17:34:27', '2022-11-28 17:34:27'),
(28, 15, '1234123412342114', '1sdfsdf', 'visa', '27/02', '2022-11-28 17:35:29', '2022-11-28 17:35:29'),
(29, 20, '00000000000000000', 'abc', 'visa', '11/23', '2022-11-29 12:22:29', '2022-11-29 12:22:29'),
(30, 20, '8080808080808080808', 'done', 'visa', '11/23', '2022-11-29 12:26:18', '2022-11-29 12:26:18'),
(31, 61, '4000056655665556', 'jdjdms', 'visa', '11/23', '2022-12-01 12:10:47', '2022-12-01 12:10:47'),
(32, 61, '5200828282828210', 'test test', 'visa', 'null/null', '2022-12-01 12:13:44', '2022-12-01 12:13:44'),
(33, 61, '2223003122003222', 'demo', 'visa', 'null/null', '2022-12-01 12:15:47', '2022-12-01 12:15:47'),
(34, 61, '378282246310005', 'demo', 'visa', '11/24', '2022-12-01 12:17:11', '2022-12-01 12:17:11'),
(35, 61, '6011000990139424', 'testing test', 'visa', '12/25', '2022-12-01 12:21:02', '2022-12-01 12:21:02'),
(36, 48, '371449635398431', 'Hellow World', 'visa', 'null/null', '2022-12-01 12:37:47', '2022-12-01 12:37:47'),
(37, 13, '1234123412342123', '1sdfsdf', 'visa', '27/02', '2022-12-01 12:47:41', '2022-12-01 12:47:41'),
(39, 12, '1234123412342121', '1sdfsdf', 'visa', '27/02', '2022-12-01 13:30:44', '2022-12-01 13:30:44'),
(40, 13, '1234123412342121', '1sdfsdf', 'visa', '27/02', '2022-12-01 13:32:05', '2022-12-01 13:32:05'),
(41, 48, '5105105105105100', 'card name', 'visa', '12/23', '2022-12-01 14:07:05', '2022-12-01 14:07:05'),
(42, 54, '4242424242424242', 'Keyur Tailor', 'visa', '12/23', '2022-12-02 16:00:35', '2022-12-02 16:00:35'),
(43, 19, '12341234123412391', '1sdfsdf', 'visa', '27/02', '2022-12-05 13:59:31', '2022-12-05 13:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int DEFAULT NULL,
  `order` int UNSIGNED NOT NULL DEFAULT '0',
  `discount` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `show_on_homepage_shop_categories` tinyint(1) NOT NULL DEFAULT '0',
  `show_on_homepage_custom_category` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `slug`, `parent_id`, `order`, `discount`, `status`, `show_on_homepage_shop_categories`, `show_on_homepage_custom_category`, `created_at`, `updated_at`) VALUES
(15, 'BATTERY REPLACEMENT', 'uploads/category/61AH1SuK3GzM17YhI3LjwpiuI3DIbFkQY03xfZ0E.png', 'battery-replacement', NULL, 0, NULL, 1, 0, 0, '2022-11-14 18:09:22', '2023-01-27 11:13:31'),
(16, 'Car Wash & Dry', 'uploads/category/dZ1rJXzFD7QWFcSDq6mduYCEi2ZWrPvQDIlRf7tq.png', 'car-wash-dry', NULL, 0, NULL, 1, 0, 0, '2022-11-14 18:11:34', '2023-01-23 12:11:08'),
(17, 'Polish Wax & Detailing', 'uploads/category/z6qZj6jpoi3JNHaYKrQXxQvEFekbK5daTuoX0qK8.png', 'polish-wax-detailing', NULL, 0, NULL, 1, 0, 0, '2022-11-14 18:12:12', '2022-11-14 18:12:12'),
(18, 'Car Cleaning Kits', 'uploads/category/jwBhIjrXCkVsx72OFCVtRc7C0mgQZ7d0K5ZKFqyV.png', 'car-cleaning-kits', NULL, 0, NULL, 1, 0, 0, '2022-11-14 18:12:26', '2022-11-14 18:12:26'),
(19, 'Car Vacuums', 'uploads/category/jBtsHIRHrBq9Q88X1obZt95YNSPAsB116TuilAxb.png', 'car-vacuums', NULL, 0, NULL, 1, 0, 0, '2022-11-14 18:13:00', '2022-11-14 18:13:00'),
(20, 'Scratch Removal', 'uploads/category/7S6H0z8xMPLGdrirFYylmsZXVm2HTE4Kuphsn5Wc.png', 'scratch-removal', NULL, 0, NULL, 1, 0, 0, '2022-11-14 18:13:13', '2022-11-14 18:13:13'),
(21, 'Leather Care', 'uploads/category/bP5ws12YCG9rqFl8TsIzvwNNeyPyL18FF6luPsrS.png', 'leather-care', NULL, 0, NULL, 1, 0, 0, '2022-11-14 18:13:24', '2022-11-14 18:13:24'),
(22, 'Carpet & Upholstery Care', 'uploads/category/5fMyKlm5e2yFDsFKGogrTmUvzkORjztk8nrgBRpD.png', 'carpet-upholstery-care', NULL, 0, NULL, 1, 0, 0, '2022-11-14 18:13:36', '2022-11-14 18:13:36'),
(23, 'Tire, Wheel & Rim Cleaners', 'uploads/category/cIRAO0PhlerzWotEEwdxmrt7zmpfdifJpMhIirYd.png', 'tire-wheel-rim-cleaners', NULL, 0, NULL, 1, 0, 0, '2022-11-14 18:13:48', '2022-11-14 18:13:48'),
(24, 'Bug & Tar Removers', 'uploads/category/TvZSh9pLwMhVzfd9fl8cNvda9l0jjpxbX726H2AF.png', 'bug-tar-removers', NULL, 0, NULL, 1, 0, 0, '2022-11-14 18:14:02', '2022-11-14 18:14:02'),
(25, 'TEes', 'uploads/category/nPlCjeQxvSLXupJ3ucNqUclL2xzgdNhEXgGDH7Gx.png', 'tees', NULL, 0, NULL, 1, 0, 0, '2022-11-25 11:38:26', '2022-11-25 11:38:26'),
(26, 'test one', 'uploads/category/8J3EUS5f4dLnQ1sufJPN9bDW6fWUvUbPfKlERves.png', 'test-one', NULL, 0, NULL, 1, 0, 0, '2022-11-25 11:38:47', '2022-11-25 11:38:47'),
(27, 'Glossman service', 'uploads/category/OtdO4FvoPZAxMCUqRSsBbEDizOJQEzZQvvTtglVl.png', 'glossman-service', NULL, 0, NULL, 1, 0, 0, '2022-12-05 14:41:22', '2022-12-05 14:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `state_id`, `slug`, `created_at`, `updated_at`) VALUES
(10053, 'Figuif', 658, 'figuif', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10054, 'Garoua', 658, 'garoua', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10055, 'Guider', 658, 'guider', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10056, 'Lagdo', 658, 'lagdo', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10057, 'Poli', 658, 'poli', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10058, 'Rey Bouba', 658, 'rey-bouba', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10059, 'Tchollire', 658, 'tchollire', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10060, 'Bamenda', 659, 'bamenda', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10061, 'Kumbo', 659, 'kumbo', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10062, 'Mbengwi', 659, 'mbengwi', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10063, 'Mme', 659, 'mme', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10064, 'Njinikom', 659, 'njinikom', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10065, 'Nkambe', 659, 'nkambe', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10066, 'Wum', 659, 'wum', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10067, 'Bafang', 660, 'bafang', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10068, 'Bafoussam', 660, 'bafoussam', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10069, 'Bafut', 660, 'bafut', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10070, 'Bali', 660, 'bali', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10071, 'Bana', 660, 'bana', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10072, 'Bangangte', 660, 'bangangte', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10073, 'Djang', 660, 'djang', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10074, 'Fontem', 660, 'fontem', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10075, 'Foumban', 660, 'foumban', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10076, 'Foumbot', 660, 'foumbot', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10077, 'Mbouda', 660, 'mbouda', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10078, 'Akom', 661, 'akom', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10079, 'Ambam', 661, 'ambam', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10080, 'Ebolowa', 661, 'ebolowa', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10081, 'Kribi', 661, 'kribi', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10082, 'Lolodorf', 661, 'lolodorf', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10083, 'Moloundou', 661, 'moloundou', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10084, 'Mvangue', 661, 'mvangue', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10085, 'Sangmelima', 661, 'sangmelima', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10086, 'Buea', 662, 'buea', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10087, 'Idenao', 662, 'idenao', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10088, 'Kumba', 662, 'kumba', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10089, 'Limbe', 662, 'limbe', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10090, 'Mamfe', 662, 'mamfe', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10091, 'Muyuka', 662, 'muyuka', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10092, 'Tiko', 662, 'tiko', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10093, 'Airdrie', 663, 'airdrie', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10094, 'Athabasca', 663, 'athabasca', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10095, 'Banff', 663, 'banff', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10096, 'Barrhead', 663, 'barrhead', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10097, 'Bassano', 663, 'bassano', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10098, 'Beaumont', 663, 'beaumont', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10099, 'Beaverlodge', 663, 'beaverlodge', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10100, 'Black Diamond', 663, 'black-diamond', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10101, 'Blackfalds', 663, 'blackfalds', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10102, 'Blairmore', 663, 'blairmore', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10103, 'Bon Accord', 663, 'bon-accord', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10104, 'Bonnyville', 663, 'bonnyville', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10105, 'Bow Island', 663, 'bow-island', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10106, 'Brooks', 663, 'brooks', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10107, 'Calgary', 663, 'calgary', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10108, 'Calmar', 663, 'calmar', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10109, 'Camrose', 663, 'camrose', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10110, 'Canmore', 663, 'canmore', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10111, 'Cardston', 663, 'cardston', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10112, 'Carstairs', 663, 'carstairs', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10113, 'Chateau Lake Louise', 663, 'chateau-lake-louise', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10114, 'Chestermere', 663, 'chestermere', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10115, 'Clairmont', 663, 'clairmont', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10116, 'Claresholm', 663, 'claresholm', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10117, 'Coaldale', 663, 'coaldale', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10118, 'Coalhurst', 663, 'coalhurst', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10119, 'Cochrane', 663, 'cochrane', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10120, 'Crossfield', 663, 'crossfield', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10121, 'Devon', 663, 'devon', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10122, 'Didsbury', 663, 'didsbury', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10123, 'Drayton Valley', 663, 'drayton-valley', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10124, 'Drumheller', 663, 'drumheller', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10125, 'Edmonton', 663, 'edmonton', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10126, 'Edson', 663, 'edson', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10127, 'Elk Point', 663, 'elk-point', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10128, 'Fairview', 663, 'fairview', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10129, 'Falher', 663, 'falher', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10130, 'Fort MacLeod', 663, 'fort-macleod', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10131, 'Fox Creek', 663, 'fox-creek', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10132, 'Gibbons', 663, 'gibbons', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10133, 'Grand Centre', 663, 'grand-centre', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10134, 'Grande Cache', 663, 'grande-cache', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10135, 'Grande Prairie', 663, 'grande-prairie', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10136, 'Grimshaw', 663, 'grimshaw', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10137, 'Hanna', 663, 'hanna', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10138, 'High Level', 663, 'high-level', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10139, 'High Prairie', 663, 'high-prairie', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10140, 'High River', 663, 'high-river', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10141, 'Hinton', 663, 'hinton', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10142, 'Irricana', 663, 'irricana', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10143, 'Jasper', 663, 'jasper', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10144, 'Killam', 663, 'killam', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10145, 'La Crete', 663, 'la-crete', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10146, 'Lac la Biche', 663, 'lac-la-biche', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10147, 'Lacombe', 663, 'lacombe', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10148, 'Lamont', 663, 'lamont', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10149, 'Leduc', 663, 'leduc', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10150, 'Lethbridge', 663, 'lethbridge', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10151, 'Lloydminster', 663, 'lloydminster', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10152, 'Magrath', 663, 'magrath', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10153, 'Manning', 663, 'manning', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10154, 'Mayerthorpe', 663, 'mayerthorpe', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10155, 'McMurray', 663, 'mcmurray', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10156, 'Medicine Hat', 663, 'medicine-hat', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10157, 'Millet', 663, 'millet', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10158, 'Morinville', 663, 'morinville', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10159, 'Nanton', 663, 'nanton', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10160, 'Okotoks', 663, 'okotoks', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10161, 'Olds', 663, 'olds', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10162, 'Peace River', 663, 'peace-river', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10163, 'Penhold', 663, 'penhold', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10164, 'Picture Butte', 663, 'picture-butte', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10165, 'Pincher Creek', 663, 'pincher-creek', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10166, 'Ponoka', 663, 'ponoka', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10167, 'Provost', 663, 'provost', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10168, 'Raymond', 663, 'raymond', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10169, 'Red Deer', 663, 'red-deer', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10170, 'Redwater', 663, 'redwater', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10171, 'Rimbey', 663, 'rimbey', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10172, 'Rocky Mountain House', 663, 'rocky-mountain-house', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10173, 'Rocky View', 663, 'rocky-view', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10174, 'Saint Paul', 663, 'saint-paul', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10175, 'Sexsmith', 663, 'sexsmith', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10176, 'Sherwood Park', 663, 'sherwood-park', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10177, 'Slave Lake', 663, 'slave-lake', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10178, 'Smoky Lake', 663, 'smoky-lake', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10179, 'Spirit River', 663, 'spirit-river', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10180, 'Spruce Grove', 663, 'spruce-grove', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10181, 'Stettler', 663, 'stettler', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10182, 'Stony Plain', 663, 'stony-plain', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10183, 'Strathmore', 663, 'strathmore', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10184, 'Sundre', 663, 'sundre', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10185, 'Swan Hills', 663, 'swan-hills', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10186, 'Sylvan Lake', 663, 'sylvan-lake', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10187, 'Taber', 663, 'taber', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10188, 'Three Hills', 663, 'three-hills', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10189, 'Tofield', 663, 'tofield', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10190, 'Two Hills', 663, 'two-hills', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10191, 'Valleyview', 663, 'valleyview', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10192, 'Vegreville', 663, 'vegreville', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10193, 'Vermilion', 663, 'vermilion', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10194, 'Viking', 663, 'viking', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10195, 'Vulcan', 663, 'vulcan', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10196, 'Wainwright', 663, 'wainwright', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10197, 'Wembley', 663, 'wembley', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10198, 'Westlock', 663, 'westlock', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10199, 'Wetaskiwin', 663, 'wetaskiwin', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10200, 'Whitecourt', 663, 'whitecourt', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10201, 'Wood Buffalo', 663, 'wood-buffalo', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10202, 'Altona', 665, 'altona', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10203, 'Beausejour', 665, 'beausejour', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10204, 'Boissevain', 665, 'boissevain', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10205, 'Brandon', 665, 'brandon', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10206, 'Carberry', 665, 'carberry', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10207, 'Carman', 665, 'carman', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10208, 'Dauphin', 665, 'dauphin', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10209, 'Deloraine', 665, 'deloraine', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10210, 'Dugald', 665, 'dugald', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10211, 'Flin Flon', 665, 'flin-flon', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10212, 'Gimli', 665, 'gimli', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10213, 'Hamiota', 665, 'hamiota', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10214, 'Killarney', 665, 'killarney', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10215, 'Lac du Bonnet', 665, 'lac-du-bonnet', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10216, 'Leaf Rapids', 665, 'leaf-rapids', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10217, 'Lorette', 665, 'lorette', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10218, 'Melita', 665, 'melita', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10219, 'Minnedosa', 665, 'minnedosa', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10220, 'Morden', 665, 'morden', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10221, 'Morris', 665, 'morris', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10222, 'Neepawa', 665, 'neepawa', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10223, 'Niverville', 665, 'niverville', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10224, 'Pinawa', 665, 'pinawa', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10225, 'Portage la Prairie', 665, 'portage-la-prairie', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10226, 'Ritchot', 665, 'ritchot', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10227, 'Rivers', 665, 'rivers', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10228, 'Roblin', 665, 'roblin', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10229, 'Saint Adolphe', 665, 'saint-adolphe', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10230, 'Sainte Anne', 665, 'sainte-anne', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10231, 'Sainte Rose du Lac', 665, 'sainte-rose-du-lac', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10232, 'Selkirk', 665, 'selkirk', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10233, 'Shilo', 665, 'shilo', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10234, 'Snow Lake', 665, 'snow-lake', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10235, 'Souris', 665, 'souris', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10236, 'Springfield', 665, 'springfield', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10237, 'Steinbach', 665, 'steinbach', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10238, 'Stonewall', 665, 'stonewall', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10239, 'Stony Mountain', 665, 'stony-mountain', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10240, 'Swan River', 665, 'swan-river', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10241, 'The Pas', 665, 'the-pas', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10242, 'Thompson', 665, 'thompson', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10243, 'Virden', 665, 'virden', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10244, 'Winkler', 665, 'winkler', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10245, 'Winnipeg', 665, 'winnipeg', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10246, 'Clyde River', 670, 'clyde-river', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10247, 'Iqaluit', 670, 'iqaluit', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10248, 'Kangerdlinerk', 670, 'kangerdlinerk', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10249, 'Oqsuqtooq', 670, 'oqsuqtooq', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10250, 'Pangnirtung', 670, 'pangnirtung', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(10251, 'Tununirusiq', 670, 'tununirusiq', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(48324, 'dippie', 661, 'dippie', '2023-01-06 15:43:59', '2023-01-06 15:43:59'),
(48327, 'Hamilton', 666, 'hamilton', '2023-01-06 15:46:55', '2023-01-06 15:46:55'),
(48328, 'Saint John', 661, 'saint-john', '2023-01-06 15:47:53', '2023-01-06 15:47:53'),
(48329, 'DIE', 661, 'die', '2023-01-06 21:09:34', '2023-01-06 21:09:34'),
(48330, 'Toronto', 666, 'toronto', '2023-01-31 18:42:15', '2023-01-31 18:42:15'),
(48331, 'Brampton', 666, 'brampton', '2023-01-31 18:42:33', '2023-01-31 18:42:33'),
(48332, 'Mississauga', 666, 'mississauga', '2023-01-31 18:45:13', '2023-01-31 18:45:13'),
(48333, 'Oshawa', 666, 'oshawa', '2023-01-31 18:45:33', '2023-01-31 18:45:33'),
(48334, 'Ottawa', 666, 'ottawa', '2023-01-31 18:45:56', '2023-01-31 18:45:56'),
(48335, 'Burlington', 666, 'burlington', '2023-01-31 18:46:27', '2023-01-31 18:46:27'),
(48336, 'Kingston', 666, 'kingston', '2023-01-31 18:46:45', '2023-01-31 18:46:45'),
(48337, 'Timmins', 666, 'timmins', '2023-01-31 18:47:01', '2023-01-31 18:47:01'),
(48338, 'Brantford', 666, 'brantford', '2023-01-31 18:47:30', '2023-01-31 18:47:30'),
(48339, 'Niagra', 666, 'niagra', '2023-01-31 18:47:57', '2023-01-31 18:47:57'),
(48340, 'Vaughan', 666, 'vaughan', '2023-01-31 18:48:56', '2023-01-31 18:48:56'),
(48341, 'Markham', 666, 'markham', '2023-01-31 18:49:11', '2023-01-31 18:49:11'),
(48342, 'St Catharines', 666, 'st-catharines', '2023-01-31 18:49:40', '2023-01-31 18:49:40'),
(48343, 'Cornwall', 666, 'cornwall', '2023-01-31 18:49:54', '2023-01-31 18:49:54'),
(48344, 'Barrie', 666, 'barrie', '2023-01-31 18:50:08', '2023-01-31 18:50:08'),
(48345, 'Coburgh', 666, 'coburgh', '2023-01-31 18:50:30', '2023-01-31 18:50:30'),
(48346, 'Moncton', 661, 'moncton', '2023-01-31 18:51:20', '2023-01-31 18:51:20'),
(48347, 'Fredericton', 661, 'fredericton', '2023-01-31 18:51:37', '2023-01-31 18:51:37'),
(48348, 'Vancouver', 659, 'vancouver', '2023-01-31 18:56:35', '2023-01-31 18:56:35'),
(48349, 'Kelowna', 659, 'kelowna', '2023-01-31 18:56:45', '2023-01-31 18:56:45'),
(48350, 'Victoria', 659, 'victoria', '2023-01-31 18:56:56', '2023-01-31 18:56:56'),
(48351, 'Calgary', 658, 'calgary', '2023-01-31 18:57:27', '2023-01-31 18:57:27'),
(48352, 'Edmonton', 658, 'edmonton', '2023-01-31 18:57:38', '2023-01-31 18:57:38'),
(48353, 'Fort Mcmurray', 658, 'fort-mcmurray', '2023-01-31 18:58:03', '2023-01-31 18:58:03');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `id` bigint UNSIGNED NOT NULL,
  `footer_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_contact_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `android_app_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ios_app_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_brand_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `privary_page` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms_page` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `refund_policy_page` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `welcome_message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_facebook` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_twitter` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_pinterest` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_reddit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_youtube` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_instagram` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_feature_step1_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_feature_step1_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_feature_step1_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_feature_step2_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_feature_step2_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_feature_step2_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_feature_step3_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_feature_step3_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_feature_step3_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_feature_step4_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_feature_step4_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_feature_step4_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_methods_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/frontend/image/payment-method.png',
  `page403_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page403_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page403_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page404_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page404_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page404_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page500_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page500_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page500_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `page503_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page503_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page503_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comingsoon_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comingsoon_subtitle` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `maintenance_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `maintenance_subtitle` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`id`, `footer_logo`, `footer_title`, `footer_contact_number`, `footer_address`, `footer_email`, `android_app_link`, `ios_app_link`, `about_title`, `about_sub_title`, `about_description`, `about_brand_logo`, `privary_page`, `terms_page`, `refund_policy_page`, `welcome_message`, `social_facebook`, `social_twitter`, `social_pinterest`, `social_reddit`, `social_youtube`, `social_instagram`, `shop_feature_step1_image`, `shop_feature_step1_title`, `shop_feature_step1_subtitle`, `shop_feature_step2_image`, `shop_feature_step2_title`, `shop_feature_step2_subtitle`, `shop_feature_step3_image`, `shop_feature_step3_title`, `shop_feature_step3_subtitle`, `shop_feature_step4_image`, `shop_feature_step4_title`, `shop_feature_step4_subtitle`, `payment_methods_logo`, `page403_title`, `page403_subtitle`, `page403_image`, `page404_title`, `page404_subtitle`, `page404_image`, `page500_title`, `page500_subtitle`, `page500_image`, `page503_title`, `page503_subtitle`, `page503_image`, `comingsoon_title`, `comingsoon_subtitle`, `maintenance_title`, `maintenance_subtitle`, `created_at`, `updated_at`) VALUES
(1, 'uploads/footer/logo-primary.png', 'Customer Supports:', '(629) 555-0129', '4517 Washington Ave.Manchester, Kentucky 39495', 'info@clicon.com', 'https://play.google.com/store/apps/details?id=com.zakirsoft', 'https://play.google.com/store/apps/details?id=com.zakirsoft', 'Clicon - largest electronics retail shop in the world.', 'WHO WE ARE', 'Pellentesque ultrices, dui vel hendrerit iaculis, ipsum velit vestibulum risus, ac tincidunt diam lectus id magna. Praesent maximus lobortis neque sit amet rhoncus. Nullam tempus lectus a dui aliquet, non ultricies nibh elementum. Nulla ac nulla dolor.\n        Great 24/7 customer services.\n        600+ Dedicated employe.\n        50+ Branches all over the world.\n        Over 1 Million Electronics Products', '/frontend/image/about/about.png', '<h2>01. Privacy Policy</h2><p>Praesent placerat dictum elementum. Nam pulvinar urna vel lectus maximus, eget faucibus turpis hendrerit. Sed iaculis molestie arcu, et accumsan nisi. Quisque molestie velit vitae ligula luctus bibendum. Duis sit amet eros mollis, viverra ipsum sed, convallis sapien. Donec justo erat, pulvinar vitae dui ut, finibus euismod enim. Donec velit tortor, mollis eu tortor euismod, gravida lacinia arcu.</p><ul><li>In ac turpis mi. Donec quis semper neque. Nulla cursus gravida interdum.</li><li>Curabitur luctus sapien augue, mattis faucibus nisl vehicula nec. Mauris at scelerisque lorem. Nullam tempus felis ipsum, sagittis malesuada nulla vulputate et.</li><li>Aenean vel metus leo. Vivamus nec neque a libero sodales aliquam a et dolor.</li><li>Vestibulum rhoncus sagittis dolor vel finibus.</li><li>Integer feugiat lacus ut efficitur mattis. Sed quis molestie velit.</li></ul><h2>02. Limitations</h2><p>Praesent placerat dictum elementum. Nam pulvinar urna vel lectus maximus, eget faucibus turpis hendrerit. Sed iaculis molestie arcu, et accumsan nisi. Quisque molestie velit vitae ligula luctus bibendum. Duis sit amet eros mollis, viverra ipsum sed, convallis sapien. Donec justo erat, pulvinar vitae dui ut, finibus euismod enim. Donec velit tortor, mollis eu tortor euismod, gravida lacinia arcu.</p><ul><li>In ac turpis mi. Donec quis semper neque. Nulla cursus gravida interdum.</li><li>Curabitur luctus sapien augue.</li><li>mattis faucibus nisl vehicula nec, Mauris at scelerisque lorem.</li><li>Nullam tempus felis ipsum, sagittis malesuada nulla vulputate et. Aenean vel metus leo.</li><li>Vivamus nec neque a libero sodales aliquam a et dolor.</li></ul><h2>03. Security</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ex neque, elementum eu blandit in, ornare eu purus. Fusce eu rhoncus mi, quis ultrices lacus. Phasellus id pellentesque nulla. Cras erat nisi, mattis et efficitur et, iaculis a lacus. Fusce gravida augue quis leo facilisis.</p><h2>04. Privacy Policy</h2><p>Praesent non sem facilisis, hendrerit nisi vitae, volutpat quam. Aliquam metus mauris, semper eu eros vitae, blandit tristique metus. Vestibulum maximus nec justo sed maximus. Vivamus sit amet turpis sem. Integer vitae tortor ac ex scelerisque facilisis ac vitae urna. In hac habitasse platea dictumst. Maecenas imperdiet tortor arcu, nec tincidunt neque malesuada volutpat.</p><ul><li>In ac turpis mi. Donec quis semper neque. Nulla cursus gravida interdum.</li><li>Mauris at scelerisque lorem. Nullam tempus felis ipsum, sagittis malesuada nulla vulputate et.</li><li>Aenean vel metus leo.</li><li>Vestibulum rhoncus sagittis dolor vel finibus.</li><li>Integer feugiat lacus ut efficitur mattis. Sed quis molestie velit.</li></ul><p>Fusce rutrum mauris sit amet justo rutrum, ut sodales lorem ullamcorper. Aliquam vitae iaculis urna. Nulla vitae mi vel nisl viverra ullamcorper vel elementum est. Mauris vitae elit nec enim tincidunt aliquet. Donec ultrices nulla a enim pulvinar, quis pulvinar lacus consectetur. Donec dignissim, risus nec mollis efficitur, turpis erat blandit urna, eget elementum lacus lectus eget lorem.</p><p><br>&nbsp;</p>', '<h2>01. Terms and Conditions Policy</h2><p>Praesent placerat dictum elementum. Nam pulvinar urna vel lectus maximus, eget faucibus turpis hendrerit. Sed iaculis molestie arcu, et accumsan nisi. Quisque molestie velit vitae ligula luctus bibendum. Duis sit amet eros mollis, viverra ipsum sed, convallis sapien. Donec justo erat, pulvinar vitae dui ut, finibus euismod enim. Donec velit tortor, mollis eu tortor euismod, gravida lacinia arcu.</p><ul><li>In ac turpis mi. Donec quis semper neque. Nulla cursus gravida interdum.</li><li>Curabitur luctus sapien augue, mattis faucibus nisl vehicula nec. Mauris at scelerisque lorem. Nullam tempus felis ipsum, sagittis malesuada nulla vulputate et.</li><li>Aenean vel metus leo. Vivamus nec neque a libero sodales aliquam a et dolor.</li><li>Vestibulum rhoncus sagittis dolor vel finibus.</li><li>Integer feugiat lacus ut efficitur mattis. Sed quis molestie velit.</li></ul><h2>02. Limitations</h2><p>Praesent placerat dictum elementum. Nam pulvinar urna vel lectus maximus, eget faucibus turpis hendrerit. Sed iaculis molestie arcu, et accumsan nisi. Quisque molestie velit vitae ligula luctus bibendum. Duis sit amet eros mollis, viverra ipsum sed, convallis sapien. Donec justo erat, pulvinar vitae dui ut, finibus euismod enim. Donec velit tortor, mollis eu tortor euismod, gravida lacinia arcu.</p><ul><li>In ac turpis mi. Donec quis semper neque. Nulla cursus gravida interdum.</li><li>Curabitur luctus sapien augue.</li><li>mattis faucibus nisl vehicula nec, Mauris at scelerisque lorem.</li><li>Nullam tempus felis ipsum, sagittis malesuada nulla vulputate et. Aenean vel metus leo.</li><li>Vivamus nec neque a libero sodales aliquam a et dolor.</li></ul><h2>03. Security</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ex neque, elementum eu blandit in, ornare eu purus. Fusce eu rhoncus mi, quis ultrices lacus. Phasellus id pellentesque nulla. Cras erat nisi, mattis et efficitur et, iaculis a lacus. Fusce gravida augue quis leo facilisis.</p><h2>04. Privacy Policy</h2><p>Praesent non sem facilisis, hendrerit nisi vitae, volutpat quam. Aliquam metus mauris, semper eu eros vitae, blandit tristique metus. Vestibulum maximus nec justo sed maximus. Vivamus sit amet turpis sem. Integer vitae tortor ac ex scelerisque facilisis ac vitae urna. In hac habitasse platea dictumst. Maecenas imperdiet tortor arcu, nec tincidunt neque malesuada volutpat.</p><ul><li>In ac turpis mi. Donec quis semper neque. Nulla cursus gravida interdum.</li><li>Mauris at scelerisque lorem. Nullam tempus felis ipsum, sagittis malesuada nulla vulputate et.</li><li>Aenean vel metus leo.</li><li>Vestibulum rhoncus sagittis dolor vel finibus.</li><li>Integer feugiat lacus ut efficitur mattis. Sed quis molestie velit.</li></ul><p>Fusce rutrum mauris sit amet justo rutrum, ut sodales lorem ullamcorper. Aliquam vitae iaculis urna. Nulla vitae mi vel nisl viverra ullamcorper vel elementum est. Mauris vitae elit nec enim tincidunt aliquet. Donec ultrices nulla a enim pulvinar, quis pulvinar lacus consectetur. Donec dignissim, risus nec mollis efficitur, turpis erat blandit urna, eget elementum lacus lectus eget lorem.</p><p><br>&nbsp;</p>', '<h2>01. Refund Policy</h2><p>Praesent placerat dictum elementum. Nam pulvinar urna vel lectus maximus, eget faucibus turpis hendrerit. Sed iaculis molestie arcu, et accumsan nisi. Quisque molestie velit vitae ligula luctus bibendum. Duis sit amet eros mollis, viverra ipsum sed, convallis sapien. Donec justo erat, pulvinar vitae dui ut, finibus euismod enim. Donec velit tortor, mollis eu tortor euismod, gravida lacinia arcu.</p><ul><li>In ac turpis mi. Donec quis semper neque. Nulla cursus gravida interdum.</li><li>Curabitur luctus sapien augue, mattis faucibus nisl vehicula nec. Mauris at scelerisque lorem. Nullam tempus felis ipsum, sagittis malesuada nulla vulputate et.</li><li>Aenean vel metus leo. Vivamus nec neque a libero sodales aliquam a et dolor.</li><li>Vestibulum rhoncus sagittis dolor vel finibus.</li><li>Integer feugiat lacus ut efficitur mattis. Sed quis molestie velit.</li></ul><h2>02. Limitations</h2><p>Praesent placerat dictum elementum. Nam pulvinar urna vel lectus maximus, eget faucibus turpis hendrerit. Sed iaculis molestie arcu, et accumsan nisi. Quisque molestie velit vitae ligula luctus bibendum. Duis sit amet eros mollis, viverra ipsum sed, convallis sapien. Donec justo erat, pulvinar vitae dui ut, finibus euismod enim. Donec velit tortor, mollis eu tortor euismod, gravida lacinia arcu.</p><ul><li>In ac turpis mi. Donec quis semper neque. Nulla cursus gravida interdum.</li><li>Curabitur luctus sapien augue.</li><li>mattis faucibus nisl vehicula nec, Mauris at scelerisque lorem.</li><li>Nullam tempus felis ipsum, sagittis malesuada nulla vulputate et. Aenean vel metus leo.</li><li>Vivamus nec neque a libero sodales aliquam a et dolor.</li></ul><h2>03. Security</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ex neque, elementum eu blandit in, ornare eu purus. Fusce eu rhoncus mi, quis ultrices lacus. Phasellus id pellentesque nulla. Cras erat nisi, mattis et efficitur et, iaculis a lacus. Fusce gravida augue quis leo facilisis.</p><h2>04. Privacy Policy</h2><p>Praesent non sem facilisis, hendrerit nisi vitae, volutpat quam. Aliquam metus mauris, semper eu eros vitae, blandit tristique metus. Vestibulum maximus nec justo sed maximus. Vivamus sit amet turpis sem. Integer vitae tortor ac ex scelerisque facilisis ac vitae urna. In hac habitasse platea dictumst. Maecenas imperdiet tortor arcu, nec tincidunt neque malesuada volutpat.</p><ul><li>In ac turpis mi. Donec quis semper neque. Nulla cursus gravida interdum.</li><li>Mauris at scelerisque lorem. Nullam tempus felis ipsum, sagittis malesuada nulla vulputate et.</li><li>Aenean vel metus leo.</li><li>Vestibulum rhoncus sagittis dolor vel finibus.</li><li>Integer feugiat lacus ut efficitur mattis. Sed quis molestie velit.</li></ul><p>Fusce rutrum mauris sit amet justo rutrum, ut sodales lorem ullamcorper. Aliquam vitae iaculis urna. Nulla vitae mi vel nisl viverra ullamcorper vel elementum est. Mauris vitae elit nec enim tincidunt aliquet. Donec ultrices nulla a enim pulvinar, quis pulvinar lacus consectetur. Donec dignissim, risus nec mollis efficitur, turpis erat blandit urna, eget elementum lacus lectus eget lorem.</p><p><br>&nbsp;</p>', 'Welcome to Clicon online eCommerce store.', 'https://www.facebook.com/zakirsoft20', 'https://www.facebook.com/zakirsoft20', 'https://www.facebook.com/zakirsoft20', 'https://www.facebook.com/zakirsoft20', 'https://www.facebook.com/zakirsoft20', 'https://www.facebook.com/zakirsoft20', 'frontend/image/features/package.png', 'Fasted Delivery', 'Delivery in 24/H', 'frontend/image/features/trophy.png', '24 Hours Return', '100% money-back guarantee', 'frontend/image/features/creditcard.png', 'Secure Payment', 'Your money is safe', 'frontend/image/features/headphones.png', 'Support 24/7', 'Live contact/message', '/frontend/image/payment-method.png', '403, Access Denied', 'Something went wrong. It\'s look like you don\'t have access.', 'frontend/image/error.png', '404, Page not found', 'Something went wrong. It\'s look that your requested could not be found.', 'frontend/image/error.png', 'Internal Server Error', 'Something went wrong. It\'s look like the Internal Server has some errors.', 'frontend/image/error.png', 'Service Unavailable', 'Something went wrong. It\'s look like  the server is unavailable and the visitor, bot or human.', 'frontend/image/error.png', 'Our website is not ready yet', 'We are working on it. We will be back coming soon', 'Our website is under construction', 'We are working hard to make our website ready for you. We will be back soon', '2022-10-05 05:33:07', '2022-10-05 05:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `contactuses`
--

CREATE TABLE `contactuses` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contactuses`
--

INSERT INTO `contactuses` (`id`, `full_name`, `email`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'test user', 'testuser@gmail.com', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil ullam blanditiis ipsa, neque tempore earum suscipit ut nobis deleniti repellendus pariatur magnam est tenetur, ducimus, dolores odio asperiores non magni.', 1, '2022-11-14 16:52:54', '2022-11-14 16:52:54'),
(2, 'test user', 'testuser@gmail.com', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil ullam blanditiis ipsa, neque tempore earum suscipit ut nobis deleniti repellendus pariatur magnam est tenetur, ducimus, dolores odio asperiores non magni.', 1, '2022-11-16 12:06:33', '2022-11-16 12:06:33'),
(3, 'test user', 'testuser@gmail.com', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil ullam blanditiis ipsa, neque tempore earum suscipit ut nobis deleniti repellendus pariatur magnam est tenetur, ducimus, dolores odio asperiores non magni.', 1, '2022-11-17 11:26:44', '2022-11-17 11:26:44'),
(4, 'test user', 'testuser@gmail.com', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil ullam blanditiis ipsa, neque tempore earum suscipit ut nobis deleniti repellendus pariatur magnam est tenetur, ducimus, dolores odio asperiores non magni.', 1, '2022-11-17 11:36:41', '2022-11-17 11:36:41'),
(5, 'test user', 'testuser@gmail.com', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil ullam blanditiis ipsa, neque tempore earum suscipit ut nobis deleniti repellendus pariatur magnam est tenetur, ducimus, dolores odio asperiores non magni.', 1, '2022-11-25 18:00:48', '2022-11-25 18:00:48'),
(6, 'test user', 'testuser@gmail.com', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nihil ullam blanditiis ipsa, neque tempore earum suscipit ut nobis deleniti repellendus pariatur magnam est tenetur, ducimus, dolores odio asperiores non magni.', 1, '2022-11-28 10:58:47', '2022-11-28 10:58:47'),
(7, 'tanvji', 'hshshg@gmail.com', 'hhehbe', 1, '2022-11-28 11:49:47', '2022-11-28 11:49:47'),
(8, 'tfvv', 'vxff@gmail.com', 'hgcfggggh', 1, '2022-11-28 12:02:38', '2022-11-28 12:02:38'),
(9, 'Name', 'tailorkeyur@gmail.co', 'Messagg', 1, '2022-12-02 17:57:20', '2022-12-02 17:57:20'),
(10, 'ssse', 'ttr@gg.com', 'yyy', 1, '2022-12-05 14:58:25', '2022-12-05 14:58:25'),
(11, 'anji', 'anjji@gmail.com', 'heyyy', 1, '2022-12-05 21:19:35', '2022-12-05 21:19:35'),
(12, 'test', 'rest', 'test', 1, '2022-12-06 12:48:05', '2022-12-06 12:48:05'),
(13, 'test', 'rest', 'test', 1, '2022-12-06 12:48:06', '2022-12-06 12:48:06'),
(14, 'test', 'test@', 'test', 1, '2022-12-06 12:48:11', '2022-12-06 12:48:11'),
(15, 'test', 'test@gmail', 'test', 1, '2022-12-06 12:48:15', '2022-12-06 12:48:15'),
(16, 'test', 'test@gmail.com', 'test', 1, '2022-12-06 12:48:18', '2022-12-06 12:48:18'),
(17, 'test', 'test', 'test', 1, '2022-12-06 15:36:37', '2022-12-06 15:36:37'),
(18, 'test', 'test@', 'test', 1, '2022-12-06 15:36:41', '2022-12-06 15:36:41'),
(19, 'test', 'test@gmail.com', 'test', 1, '2022-12-06 15:36:49', '2022-12-06 15:36:49'),
(20, 'demo', 'demo@gmail.com', 'demo', 1, '2022-12-06 15:37:17', '2022-12-06 15:37:17'),
(21, 'name', 'test', 'teat', 1, '2022-12-08 18:16:06', '2022-12-08 18:16:06'),
(22, 'name', 'test@demo.com', 'teat', 1, '2022-12-08 18:16:11', '2022-12-08 18:16:11'),
(23, 'asdasd', 'bhavin@freshcodes.in', 'Messageasdada sdadasd*', 1, '2022-12-09 12:32:25', '2022-12-09 12:32:25'),
(24, 'sdfsd', 'bhavin@freshcodes.in', 'Message*sdf sdfsdf', 1, '2022-12-09 12:33:46', '2022-12-09 12:33:46'),
(25, 'sdfsdf', 'admin@admin.com', 'Messaas dadasdasdge*', 1, '2022-12-09 12:34:37', '2022-12-09 12:34:37'),
(26, 'test', 'test', 'test', 1, '2022-12-15 15:14:59', '2022-12-15 15:14:59'),
(27, 'test', 'test@gmaio.com', 'test', 1, '2022-12-15 15:15:04', '2022-12-15 15:15:04'),
(28, 'test', 'test@gmail.com', 'test Message*', 1, '2022-12-19 18:37:17', '2022-12-19 18:37:17'),
(29, 'test', 'twst@gmail.com', 'tests yfgcbslfhnpawf Message*', 1, '2022-12-19 18:38:11', '2022-12-19 18:38:11'),
(30, 'test', 'test@gmail.com', 'test', 1, '2022-12-22 17:21:49', '2022-12-22 17:21:49'),
(31, 'test', 'tets', 'test', 1, '2022-12-27 16:23:39', '2022-12-27 16:23:39'),
(32, 'test', 'test@', 'test', 1, '2022-12-27 16:23:45', '2022-12-27 16:23:45'),
(33, 'test', 'test@gmail.com', 'test', 1, '2022-12-27 16:23:52', '2022-12-27 16:23:52'),
(34, 'tanvi', 'tanvi.morker@freshcodes.in', 'testing', 1, '2022-12-30 18:34:53', '2022-12-30 18:34:53'),
(35, 'test', 'test66@gmail.com', 'testing', 1, '2023-01-06 18:33:29', '2023-01-06 18:33:29'),
(36, 'test', 'testing', 'tesg', 1, '2023-01-12 17:30:26', '2023-01-12 17:30:26'),
(37, 'test', 'testing@', 'tesg', 1, '2023-01-12 17:30:29', '2023-01-12 17:30:29'),
(38, 'test', 'testing@gmail', 'tesg', 1, '2023-01-12 17:30:32', '2023-01-12 17:30:32'),
(39, 'test', 'testing@gmail.com', 'tesg', 1, '2023-01-12 17:30:34', '2023-01-12 17:30:34'),
(40, 'test', 'test@gmail.in', 'test', 1, '2023-01-19 17:22:57', '2023-01-19 17:22:57'),
(41, 'test', 'test01@gmail.com', 'test', 1, '2023-01-24 12:05:38', '2023-01-24 12:05:38'),
(42, 'test', 'test01@gmail.com', 'test', 1, '2023-01-25 17:48:49', '2023-01-25 17:48:49'),
(43, 'userb', 'userb@yopmail.com', 'test', 1, '2023-01-30 14:29:54', '2023-01-30 14:29:54'),
(44, 'test', 'test01@gmail.com', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2023-01-31 16:46:24', '2023-01-31 16:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE `cookies` (
  `id` bigint UNSIGNED NOT NULL,
  `allow_cookies` tinyint(1) NOT NULL DEFAULT '1',
  `cookie_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'gdpr_cookie',
  `cookie_expiration` tinyint NOT NULL DEFAULT '30',
  `force_consent` tinyint(1) NOT NULL DEFAULT '0',
  `darkmode` tinyint(1) NOT NULL DEFAULT '0',
  `language` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `approve_button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `decline_button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cookies`
--

INSERT INTO `cookies` (`id`, `allow_cookies`, `cookie_name`, `cookie_expiration`, `force_consent`, `darkmode`, `language`, `title`, `description`, `approve_button_text`, `decline_button_text`, `created_at`, `updated_at`) VALUES
(1, 1, 'gdpr_cookie', 30, 0, 0, 'en', 'We use cookies!', 'Hi, this website uses essential cookies to ensure its proper operation and tracking cookies to understand how you interact with it. The latter will be set only after consent. <button type=\"button\" data-cc=\"c-settings\" class=\"cc-link\">Let me choose</button>', 'Allow all Cookies', 'Reject all Cookies', '2022-10-05 05:33:07', '2022-10-05 05:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sortname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `image`, `slug`, `icon`, `sortname`, `created_at`, `updated_at`) VALUES
(38, 'Canada', 'backend/image/flags/flag-of-Canada.jpg', 'canada', 'flag-icon-ca', 'CA', '2022-10-05 05:33:06', '2022-10-05 05:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint UNSIGNED NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT 'promotion_5.png',
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_use` int DEFAULT NULL,
  `total_uses` int NOT NULL DEFAULT '0',
  `discount` int NOT NULL,
  `expire_date` date NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `image`, `code`, `max_use`, `total_uses`, `discount`, `expire_date`, `type`, `status`, `created_at`, `updated_at`, `category_id`) VALUES
(1, 'promotion_5.png', 'QWERT', 300, 37, 43, '2023-03-16', 'Percentage', 1, '2022-11-15 23:39:44', '2023-01-31 10:48:04', 18),
(2, 'promotion_5.png', '5c61hk', 300, 4, 12, '2022-12-30', 'Percentage', 1, '2022-11-17 03:11:21', '2022-12-15 18:28:37', 16),
(3, 'promotion_5.png', 'j5gmhq', 300, 0, 22, '2022-12-29', 'Percentage', 1, '2022-11-17 03:11:32', '2022-11-17 03:11:32', 15),
(5, 'promotion_5.png', 'po9uie', 52, 0, 111, '2022-11-29', 'Number', 1, '2022-11-17 03:11:55', '2022-11-17 03:11:55', 18),
(6, 'promotion_5.png', 'abcd1', 15, 2, 25, '2023-02-28', 'Percentage', 1, '2022-11-25 11:34:56', '2023-01-23 16:34:11', 18),
(8, 'promotion_5.png', 'moxn2', 15, 11, 10, '2023-02-22', 'Percentage', 1, '2022-12-05 14:47:07', '2023-02-01 11:13:20', 16),
(9, 'promotion_5.png', 'QABC1', 10000, 4, 100, '2023-02-10', 'Percentage', 1, '2023-01-23 12:14:51', '2023-01-27 15:56:09', 16),
(10, 'promotion_5.png', 'akspeu', 1000, 5, 80, '2024-12-31', 'Percentage', 1, '2023-01-24 14:13:55', '2023-01-27 16:04:38', 16),
(14, 'promotion_5.png', 'ABCDF2', 20, 0, 100, '2023-02-16', 'Percentage', 1, '2023-01-31 15:16:04', '2023-01-31 15:16:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `symbol_position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'left',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `symbol`, `symbol_position`, `created_at`, `updated_at`) VALUES
(1, 'United State Dollar', 'USD', '$', 'left', '2022-10-05 05:33:07', '2022-10-05 05:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `database_backups`
--

CREATE TABLE `database_backups` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `database_backups`
--

INSERT INTO `database_backups` (`id`, `name`, `file_path`, `created_at`, `updated_at`) VALUES
(2, 'database-backup-2022-11-25-46.gz', '/homepages/22/d904869214/htdocs/glossman/storage/app/backup/database/database-backup-2022-11-25-46.gz', '2022-11-25 20:28:46', '2022-11-25 20:28:46');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(3, 'What are the features of E-commerce?', 'The features of e-commerce are non-cash payment, service availability (24*7), Improved sales, support, advertising and marketing, inventory management, communication efficient, faster, reliable, less time consuming, on the go service and saving time. It is available at any time and anywhere, helps in making better management of product and services.', 1, '2022-11-17 04:42:40', '2022-11-17 04:42:40'),
(4, 'What are the features of E-commerce?', 'The features of e-commerce are non-cash payment, service availability (24*7), Improved sales, support, advertising and marketing, inventory management, communication efficient, faster, reliable, less time consuming, on the go service and saving time. It is available at any time and anywhere, helps in making better management of product and services.', 1, NULL, NULL),
(5, 'Difference between E-commerce and Traditional Commerce?', 'Traditional Commerce is mainly dependent on exchanging information from one person to another, whereas E-commerce has very less dependency on the same. In traditional commerce, transactions or communication are done synchronously. It means manual intervention is required for any communication or transaction, but in e-commerce, transactions or communications can be done asynchronously. Mainly all the process is an automated one. Traditional communications of business depend on individual skills but in e-commerce, there is no manual intervention. I', 1, NULL, NULL),
(6, 'What are the advantages to the organization?', 'With the help of e-commerce, organizations can extend their business or markets to national or international markets by investing less capital. It can easily locate more customers, suppliers, and partners as well. It helps the organizations to reduce their cost on process creation, distribute and manage the paper-based information. It also helps in improving the brand image of the company. E-commerce generally helps provide better customer service, simplify the business process, and make it faster, secure, and efficient. It helps in automating the deliveries and reducing other unnecessary work.', 1, NULL, NULL),
(7, 'What are the different e-commerce business models?', 'These are the common E-commerce Interview Questions asked in an interview. The different e-commerce business models are Business to Business (B2B), Business to Consumer (B2C), Consumer to Consumer (C2C), Consumer to Business (C2B), Business to Government (B2G), Government to Business (G2B) and Government to Citizen (G2C).', 1, NULL, NULL),
(8, 'Explain the technical disadvantages of e-commerce?', 'In e-commerce, there can be a lack of security of data, system, reliability, and poor standards of implementation. It is still getting or finding it and keeps on changing rapidly. There can be issues with the network in some areas; high-speed internet connectivity is required for accessing the websites on the desktop or mobile or any other gadgets. Existing applications and databases are difficult to integrate with e-commerce applications or software. There can be issues with software compatibility and hardware with some operating system or might be any other incompatibility with the system.', 1, NULL, NULL),
(9, 'Explain the advantages to society because of e-commerce?', 'It helps reduce the cost of products because more and more people can use the product. It helps to enable the rural areas to access the service and products because they can use any product what all others are using in town or cities. It helps the government deliver public services such as healthcare, education, and social service at minimal cost and better. Most importantly, no need to travel anywhere; the products will be delivered to the defined address and benefits the customer, organization, and environment.', 1, NULL, NULL),
(10, 'Tell us which different sector e-commerce applications are available in the market?', 'The applications are mainly available for many different sectors or areas, from those areas, some are like books, music, financial services, home electronics, mobiles, entertainment, apparels, travel services, toys, movie tickets, information, gifts and computer products, accessories etc.', 1, NULL, NULL),
(11, 'What are the short-comings of e-commerce?', 'E-commerce required a lot of initial set up cost for creating the website of the application. There can be a trust issue on-site as traditional buyers like to go for traditional commerce with interaction or communication. It is really difficult to ensure the security or privacy of online transactions and stored data. We can just view the product virtually, not in reality, as sometimes the delivered product looks different from the expectation. Internet access is still not available for everyone and everywhere, making it difficult for an organization to reach there and expand their market like remote villages. There can be a delay in launching the application or website because of mistakes, issues or unavoidable circumstance and lack of experience.', 1, NULL, NULL),
(12, 'Explain the B2C business model briefly?', 'These are the advanced E-commerce Interview Questions asked in an interview. This B2C business model sells the product directly to customers. The customers can easily view the products on the website, choose the product from the different varieties, and order the product accordingly. The ordered product will be delivered to the address, and in between, all the transit updates are sent to the customer via SMS or email notification as per the customer’s choice only.', 1, NULL, NULL),
(13, 'How does e-commerce work?', 'When a customer needs any product to buy, a customer goes to the website and chooses the product they want to buy. After the selection of the product, a customer will select the mode of payment, whether it is online or offline and after that product will checkout and ordered. The ordered products information has been exchanged with customer and delivery logistics. This process is being done in just a matter of minutes only. ', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favourite_products`
--

CREATE TABLE `favourite_products` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_page_contents`
--

CREATE TABLE `home_page_contents` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `show_body` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_page_contents`
--

INSERT INTO `home_page_contents` (`id`, `name`, `slug`, `order`, `status`, `show_body`, `created_at`, `updated_at`) VALUES
(1, 'Top Header', 'top-header', 0, 1, 1, '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(2, 'Banner', 'banner', 1, 1, 1, '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(3, 'Application Feature', 'application-feature', 2, 1, 1, '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(4, 'Today\'s Deals', 'todays-deals', 3, 1, 1, '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(5, 'Shop With Category', 'shop-with-categories', 4, 1, 1, '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(6, 'Featured Products', 'featured-products', 5, 1, 1, '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(7, 'Offer Ads', 'offer-ads', 6, 1, 1, '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(8, 'Custom Category', 'custom-category', 7, 1, 1, '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(9, 'Highlight Products', 'highlight-products', 8, 1, 0, '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(10, 'Offer Ads 2', 'offer-ads-2', 9, 1, 1, '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(11, 'Latest Posts', 'latest-posts', 10, 1, 0, '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(12, 'Newsletter', 'newsletter', 11, 1, 0, '2022-10-05 05:33:07', '2022-10-05 05:33:07');

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
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ltr',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `code`, `icon`, `direction`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 'flag-icon-gb', 'ltr', '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(3, 'French', 'ab', 'flag-icon-ge', 'ltr', '2022-11-25 20:26:10', '2022-11-25 20:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `manual_payments`
--

CREATE TABLE `manual_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `type` enum('bank_payment','cash_payment','check_payment','custom_payment') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manual_payments`
--

INSERT INTO `manual_payments` (`id`, `type`, `name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'cash_payment', 'test', '<p>sfsiudfsidfuh</p>', 1, '2022-11-17 18:41:41', '2022-11-17 18:41:41');

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
(1, '2012_06_12_121442_create_countries_table', 1),
(2, '2012_06_12_121452_create_states_table', 1),
(3, '2012_06_12_121453_create_cities_table', 1),
(4, '2012_07_14_154223_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2020_11_12_184107_create_permission_tables', 1),
(8, '2020_12_20_121145_create_categories_table', 1),
(9, '2020_12_20_161857_create_brands_table', 1),
(10, '2020_12_21_175516_create_products_table', 1),
(11, '2020_12_23_185928_create_product_galleries_table', 1),
(12, '2021_02_09_060512_create_attributes_table', 1),
(13, '2021_02_09_060523_create_attribute_values_table', 1),
(14, '2021_02_11_123140_create_product_attributes_table', 1),
(15, '2021_02_18_112239_create_admins_table', 1),
(16, '2021_05_02_104321_create_coupons_table', 1),
(17, '2021_06_12_125002_create_sliders_table', 1),
(18, '2021_08_23_115402_create_settings_table', 1),
(19, '2021_08_25_061331_create_languages_table', 1),
(20, '2021_12_14_142236_create_emails_table', 1),
(21, '2021_12_19_152529_create_faq_categories_table', 1),
(22, '2021_12_21_105713_create_faqs_table', 1),
(23, '2022_01_25_131111_add_fields_to_settings_table', 1),
(24, '2022_01_26_091457_add_social_login_fields_to_users_table', 1),
(25, '2022_01_30_051177_create_post_categories_table', 1),
(26, '2022_01_30_051199_create_posts_table', 1),
(27, '2022_02_22_114329_create_post_comments_table', 1),
(28, '2022_03_05_125615_create_currencies_table', 1),
(29, '2022_03_28_093629_add_socialite_column_to_users_table', 1),
(30, '2022_03_29_100616_create_timezones_table', 1),
(31, '2022_03_29_121851_create_admin_searches_table', 1),
(32, '2022_03_30_082959_create_cookies_table', 1),
(33, '2022_03_30_114924_create_seos_table', 1),
(34, '2022_03_30_121200_create_database_backups_table', 1),
(35, '2022_04_05_091403_create_orders_table', 1),
(36, '2022_04_05_091411_create_order_products_table', 1),
(37, '2022_04_10_040925_create_addresses_table', 1),
(38, '2022_04_13_043352_create_transactions_table', 1),
(39, '2022_04_13_063925_create_ssl_orders_table', 1),
(40, '2022_04_13_081554_create_browsing_histories_table', 1),
(41, '2022_04_16_050614_create_cms_table', 1),
(42, '2022_04_17_040726_create_product_tags_table', 1),
(43, '2022_04_17_042859_create_product_tag_table', 1),
(44, '2022_04_17_093531_create_notifications_table', 1),
(45, '2022_04_17_093641_create_jobs_table', 1),
(46, '2022_04_19_080006_create_order_product_attributes_table', 1),
(47, '2022_04_24_033606_create_wishlists_table', 1),
(48, '2022_04_25_132657_create_setup_guides_table', 1),
(49, '2022_05_23_052159_create_home_page_contents_table', 1),
(50, '2022_05_24_030453_create_campaigns_table', 1),
(51, '2022_05_24_031005_create_campaign_products_table', 1),
(52, '2022_05_24_041350_create_shipping_methods_table', 1),
(53, '2022_05_24_042506_create_pickup_points_table', 1),
(54, '2022_05_24_083439_create_campaign_offers_table', 1),
(55, '2022_05_26_104108_create_partners_table', 1),
(56, '2022_05_29_095213_create_todays_deal_products_table', 1),
(57, '2022_07_14_155901_create_reviews_table', 1),
(58, '2022_07_24_030426_add_payment_setting_to_settings', 1),
(59, '2022_08_22_100744_create_manual_payments_table', 1),
(60, '2022_08_22_101117_add_manual_payment_field_to_transactions_table', 1),
(61, '2022_08_23_033747_add_remove_column_orders_table', 1),
(62, '2022_08_23_054343_change_settings_table_column', 1),
(63, '2022_09_10_024738_drop_header_footer_css_js_columns_from_settings_table', 1),
(64, '2022_09_10_024802_add_header_footer_css_js_columns_from_settings_table', 1),
(65, '2022_10_05_053310_add_field_to_orders_table', 1),
(66, '2022_10_14_054332_create_packages_table', 2);

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
(1, 'App\\Models\\Admin', 1),
(3, 'App\\Models\\Admin', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `notifiable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notifiable_id` bigint UNSIGNED DEFAULT NULL,
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `user_id`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Notifications\\Frontend\\OrderTrackNotification', 19, 'aasdsad', 0, 'Your Order #63A59BCF8729Ehas been Placed!', '0000-00-00 00:00:00', NULL, NULL),
(2, 'App\\Notifications\\Frontend\\OrderTrackNotification', 19, 'aasdsad', 0, 'Your Order #63A59D40DE60A has been Placed!', '0000-00-00 00:00:00', '2022-12-23 12:21:22', '2022-12-23 12:21:22'),
(3, 'App\\Notifications\\Frontend\\OrderTrackNotification', 19, 'aasdsad', 0, 'Your Order #63A59D40DE60A has beenon_the_way !', '0000-00-00 00:00:00', '2022-12-23 12:27:31', '2022-12-23 12:27:31'),
(4, 'App\\Notifications\\Frontend\\OrderTrackNotification', NULL, 'Modules\\Order\\Entities\\Order', 125, '{\"title\":\"Your order is now in on the way.\",\"order\":{\"id\":125,\"order_no\":\"63A59D40DE60A\",\"user_id\":19,\"coupon_type\":null,\"coupon_discount_amount\":null,\"subtotal_price\":10,\"total_price\":110,\"discount_price\":null,\"payment_status\":\"paid\",\"order_status\":\"on_the_way\",\"notes\":\"order place\",\"shipping_method_id\":1,\"shipping_pickup_point_id\":0,\"shipping_price\":100,\"snap_token\":null,\"created_at\":\"2022-12-23T12:21:22.000000Z\",\"updated_at\":\"2022-12-23T12:26:56.000000Z\",\"payment_method\":\"\",\"manual_payment_id\":0,\"guest_email\":\"bhavinpatel0asd717@gmail.com\",\"guest_name\":\"bhavasdain patasdel\",\"address_type\":null,\"transaction_id\":null}}', NULL, '2022-12-23 12:27:32', '2022-12-23 12:27:32'),
(5, 'App\\Notifications\\Frontend\\OrderTrackNotification', 107, 'aasdsad', 0, 'Your Order #63A5ACE8B914D has been Placed!', '0000-00-00 00:00:00', '2022-12-23 13:28:09', '2022-12-23 13:28:09'),
(6, 'App\\Notifications\\Frontend\\OrderTrackNotification', 111, 'aasdsad', 0, 'Your Order #63A5D1D8BF366 has been Placed!', '0000-00-00 00:00:00', '2022-12-24 02:35:46', '2022-12-24 02:35:46'),
(7, 'App\\Notifications\\Frontend\\OrderTrackNotification', 112, 'aasdsad', 0, 'Your Order #63A619AD42C3A has been Placed!', '0000-00-00 00:00:00', '2022-12-24 07:42:14', '2022-12-24 07:42:14'),
(8, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A6C298A1D23 has been Placed!', '0000-00-00 00:00:00', '2022-12-24 19:42:58', '2022-12-24 19:42:58'),
(9, 'App\\Notifications\\Frontend\\OrderTrackNotification', 112, 'aasdsad', 0, 'Your Order #63A6C2CB5E3A5 has been Placed!', '0000-00-00 00:00:00', '2022-12-24 19:43:48', '2022-12-24 19:43:48'),
(10, 'App\\Notifications\\Frontend\\OrderTrackNotification', 112, 'aasdsad', 0, 'Your Order #63A70196B75B1 has been Placed!', '0000-00-00 00:00:00', '2022-12-25 00:11:44', '2022-12-25 00:11:44'),
(11, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A80F169B7B0 has been Placed!', '0000-00-00 00:00:00', '2022-12-25 19:21:36', '2022-12-25 19:21:36'),
(12, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A81307734BB has been Placed!', '0000-00-00 00:00:00', '2022-12-25 19:38:24', '2022-12-25 19:38:24'),
(13, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A8130835B62 has been Placed!', '0000-00-00 00:00:00', '2022-12-25 19:38:25', '2022-12-25 19:38:25'),
(14, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A8130835B62 has beenpending !', '0000-00-00 00:00:00', '2022-12-25 20:54:35', '2022-12-25 20:54:35'),
(15, 'App\\Notifications\\Frontend\\OrderTrackNotification', NULL, 'Modules\\Order\\Entities\\Order', 136, '{\"title\":\"Your order is pending.\",\"order\":{\"id\":136,\"order_no\":\"63A8130835B62\",\"user_id\":109,\"coupon_type\":null,\"coupon_discount_amount\":null,\"subtotal_price\":110,\"total_price\":210,\"discount_price\":0,\"payment_status\":\"paid\",\"order_status\":\"pending\",\"notes\":\"order place\",\"shipping_method_id\":1,\"shipping_pickup_point_id\":0,\"shipping_price\":100,\"snap_token\":null,\"created_at\":\"2022-12-25T09:08:25.000000Z\",\"updated_at\":\"2022-12-25T04:54:35.000000Z\",\"payment_method\":\"\",\"manual_payment_id\":0,\"guest_email\":\"test@gmail.com\",\"guest_name\":\"madhuri test\",\"address_type\":null,\"transaction_id\":null}}', NULL, '2022-12-25 20:54:36', '2022-12-25 20:54:36'),
(16, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A8130835B62 has beenon_the_way !', '0000-00-00 00:00:00', '2022-12-25 20:54:52', '2022-12-25 20:54:52'),
(18, 'App\\Notifications\\Frontend\\OrderTrackNotification', NULL, 'Modules\\Order\\Entities\\Order', 132, '{\"title\":\"Your order is pending.\",\"order\":{\"id\":132,\"order_no\":\"63A6C2CB5E3A5\",\"user_id\":112,\"coupon_type\":null,\"coupon_discount_amount\":null,\"subtotal_price\":360,\"total_price\":460,\"discount_price\":null,\"payment_status\":\"paid\",\"order_status\":\"pending\",\"notes\":\"order place\",\"shipping_method_id\":1,\"shipping_pickup_point_id\":0,\"shipping_price\":100,\"snap_token\":null,\"created_at\":\"2022-12-24T09:13:48.000000Z\",\"updated_at\":\"2022-12-25T05:01:25.000000Z\",\"payment_method\":\"\",\"manual_payment_id\":0,\"guest_email\":\"bpatel1asd234@gmil.com\",\"guest_name\":\"aasd asd\",\"address_type\":null,\"transaction_id\":null}}', NULL, '2022-12-25 21:01:25', '2022-12-25 21:01:25'),
(24, 'App\\Notifications\\Frontend\\OrderTrackNotification', NULL, 'Modules\\Order\\Entities\\Order', 136, '{\"title\":\"Your order is now in on the way.\",\"order\":{\"id\":136,\"order_no\":\"63A8130835B62\",\"user_id\":109,\"coupon_type\":null,\"coupon_discount_amount\":null,\"subtotal_price\":110,\"total_price\":210,\"discount_price\":0,\"payment_status\":\"paid\",\"order_status\":\"on_the_way\",\"notes\":\"order place\",\"shipping_method_id\":1,\"shipping_pickup_point_id\":0,\"shipping_price\":100,\"snap_token\":null,\"created_at\":\"2022-12-25T09:08:25.000000Z\",\"updated_at\":\"2022-12-25T04:54:52.000000Z\",\"payment_method\":\"\",\"manual_payment_id\":0,\"guest_email\":\"test@gmail.com\",\"guest_name\":\"madhuri test\",\"address_type\":null,\"transaction_id\":null}}', NULL, '2022-12-25 20:54:52', '2022-12-25 20:54:52'),
(25, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A8130835B62 has beendelivered !', '0000-00-00 00:00:00', '2022-12-25 21:00:00', '2022-12-25 21:00:00'),
(26, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A8130835B62 has beendelivered !', '0000-00-00 00:00:00', '2022-12-25 21:00:42', '2022-12-25 21:00:42'),
(517, 'App\\Notifications\\Frontend\\OrderTrackNotification', NULL, 'Modules\\Order\\Entities\\Order', 136, '{\"title\":\"Your order has been delivered. Thank you for shopping with Glossman!\",\"order\":{\"id\":136,\"order_no\":\"63A8130835B62\",\"user_id\":109,\"coupon_type\":null,\"coupon_discount_amount\":null,\"subtotal_price\":110,\"total_price\":210,\"discount_price\":0,\"payment_status\":\"paid\",\"order_status\":\"delivered\",\"notes\":\"order place\",\"shipping_method_id\":1,\"shipping_pickup_point_id\":0,\"shipping_price\":100,\"snap_token\":null,\"created_at\":\"2022-12-25T09:08:25.000000Z\",\"updated_at\":\"2022-12-25T05:00:00.000000Z\",\"payment_method\":\"\",\"manual_payment_id\":0,\"guest_email\":\"test@gmail.com\",\"guest_name\":\"madhuri test\",\"address_type\":null,\"transaction_id\":null}}', NULL, '2022-12-25 21:00:42', '2022-12-25 21:00:42'),
(518, 'App\\Notifications\\Frontend\\OrderTrackNotification', 112, 'aasdsad', 0, 'Your Order #63A6C2CB5E3A5 has beenpending !', '0000-00-00 00:00:00', '2022-12-25 21:01:25', '2022-12-25 21:01:25'),
(519, 'App\\Notifications\\Frontend\\OrderTrackNotification', 112, 'aasdsad', 0, 'Your Order #63A6C2CB5E3A5 has beenon_the_way !', '0000-00-00 00:00:00', '2022-12-25 21:01:32', '2022-12-25 21:01:32'),
(9578, 'App\\Notifications\\Frontend\\OrderTrackNotification', NULL, 'Modules\\Order\\Entities\\Order', 132, '{\"title\":\"Your order is now in on the way.\",\"order\":{\"id\":132,\"order_no\":\"63A6C2CB5E3A5\",\"user_id\":112,\"coupon_type\":null,\"coupon_discount_amount\":null,\"subtotal_price\":360,\"total_price\":460,\"discount_price\":null,\"payment_status\":\"paid\",\"order_status\":\"on_the_way\",\"notes\":\"order place\",\"shipping_method_id\":1,\"shipping_pickup_point_id\":0,\"shipping_price\":100,\"snap_token\":null,\"created_at\":\"2022-12-24T09:13:48.000000Z\",\"updated_at\":\"2022-12-25T05:01:32.000000Z\",\"payment_method\":\"\",\"manual_payment_id\":0,\"guest_email\":\"bpatel1asd234@gmil.com\",\"guest_name\":\"aasd asd\",\"address_type\":null,\"transaction_id\":null}}', NULL, '2022-12-25 21:01:32', '2022-12-25 21:01:32'),
(9579, 'App\\Notifications\\Frontend\\OrderTrackNotification', 112, 'aasdsad', 0, 'Your Order #63A6C2CB5E3A5 has beendelivered !', '0000-00-00 00:00:00', '2022-12-25 21:01:38', '2022-12-25 21:01:38'),
(9580, 'App\\Notifications\\Frontend\\OrderTrackNotification', 112, 'aasdsad', 0, 'Your Order #63A6C2CB5E3A5 has beendelivered !', '0000-00-00 00:00:00', '2022-12-25 21:01:47', '2022-12-25 21:01:47'),
(9581, 'App\\Notifications\\Frontend\\OrderTrackNotification', NULL, 'Modules\\Order\\Entities\\Order', 132, '{\"title\":\"Your order has been delivered. Thank you for shopping with Glossman!\",\"order\":{\"id\":132,\"order_no\":\"63A6C2CB5E3A5\",\"user_id\":112,\"coupon_type\":null,\"coupon_discount_amount\":null,\"subtotal_price\":360,\"total_price\":460,\"discount_price\":null,\"payment_status\":\"paid\",\"order_status\":\"delivered\",\"notes\":\"order place\",\"shipping_method_id\":1,\"shipping_pickup_point_id\":0,\"shipping_price\":100,\"snap_token\":null,\"created_at\":\"2022-12-24T09:13:48.000000Z\",\"updated_at\":\"2022-12-25T05:01:38.000000Z\",\"payment_method\":\"\",\"manual_payment_id\":0,\"guest_email\":\"bpatel1asd234@gmil.com\",\"guest_name\":\"aasd asd\",\"address_type\":null,\"transaction_id\":null}}', NULL, '2022-12-25 21:01:47', '2022-12-25 21:01:47'),
(9582, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A8130835B62 has beenpending !', '0000-00-00 00:00:00', '2022-12-25 21:31:09', '2022-12-25 21:31:09'),
(98783, 'App\\Notifications\\Frontend\\OrderTrackNotification', NULL, 'Modules\\Order\\Entities\\Order', 136, '{\"title\":\"Your order is pending.\",\"order\":{\"id\":136,\"order_no\":\"63A8130835B62\",\"user_id\":109,\"coupon_type\":null,\"coupon_discount_amount\":null,\"subtotal_price\":110,\"total_price\":210,\"discount_price\":0,\"payment_status\":\"paid\",\"order_status\":\"pending\",\"notes\":\"order place\",\"shipping_method_id\":1,\"shipping_pickup_point_id\":0,\"shipping_price\":100,\"snap_token\":null,\"created_at\":\"2022-12-25T09:08:25.000000Z\",\"updated_at\":\"2022-12-25T05:31:09.000000Z\",\"payment_method\":\"\",\"manual_payment_id\":0,\"guest_email\":\"test@gmail.com\",\"guest_name\":\"madhuri test\",\"address_type\":null,\"transaction_id\":null}}', NULL, '2022-12-25 21:31:09', '2022-12-25 21:31:09'),
(98784, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A8130835B62 has beenon_the_way !', '0000-00-00 00:00:00', '2022-12-25 21:31:16', '2022-12-25 21:31:16'),
(98785, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A8130835B62 has beendelivered !', '0000-00-00 00:00:00', '2022-12-25 21:31:23', '2022-12-25 21:31:23'),
(98786, 'App\\Notifications\\Frontend\\OrderTrackNotification', NULL, 'Modules\\Order\\Entities\\Order', 136, '{\"title\":\"Your order has been delivered. Thank you for shopping with Glossman!\",\"order\":{\"id\":136,\"order_no\":\"63A8130835B62\",\"user_id\":109,\"coupon_type\":null,\"coupon_discount_amount\":null,\"subtotal_price\":110,\"total_price\":210,\"discount_price\":0,\"payment_status\":\"paid\",\"order_status\":\"delivered\",\"notes\":\"order place\",\"shipping_method_id\":1,\"shipping_pickup_point_id\":0,\"shipping_price\":100,\"snap_token\":null,\"created_at\":\"2022-12-25T09:08:25.000000Z\",\"updated_at\":\"2022-12-25T05:31:23.000000Z\",\"payment_method\":\"\",\"manual_payment_id\":0,\"guest_email\":\"test@gmail.com\",\"guest_name\":\"madhuri test\",\"address_type\":null,\"transaction_id\":null}}', NULL, '2022-12-25 21:31:23', '2022-12-25 21:31:23'),
(98787, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A6C298A1D23 has beenpending !', '0000-00-00 00:00:00', '2022-12-25 21:36:48', '2022-12-25 21:36:48'),
(758879, 'App\\Notifications\\Frontend\\OrderTrackNotification', NULL, 'Modules\\Order\\Entities\\Order', 131, '{\"title\":\"Your order is pending.\",\"order\":{\"id\":131,\"order_no\":\"63A6C298A1D23\",\"user_id\":109,\"coupon_type\":null,\"coupon_discount_amount\":null,\"subtotal_price\":50,\"total_price\":150,\"discount_price\":null,\"payment_status\":\"paid\",\"order_status\":\"pending\",\"notes\":\"order place\",\"shipping_method_id\":1,\"shipping_pickup_point_id\":0,\"shipping_price\":100,\"snap_token\":null,\"created_at\":\"2022-12-24T09:12:58.000000Z\",\"updated_at\":\"2022-12-25T05:36:48.000000Z\",\"payment_method\":\"\",\"manual_payment_id\":0,\"guest_email\":\"test@gmail.com\",\"guest_name\":\"Madhuri test\",\"address_type\":null,\"transaction_id\":null}}', NULL, '2022-12-25 21:36:48', '2022-12-25 21:36:48'),
(758880, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A6C298A1D23 has beenprocessing !', '0000-00-00 00:00:00', '2022-12-25 21:36:56', '2022-12-25 21:36:56'),
(758881, 'App\\Notifications\\Frontend\\OrderTrackNotification', NULL, 'Modules\\Order\\Entities\\Order', 131, '{\"title\":\"Your order is now processing.\",\"order\":{\"id\":131,\"order_no\":\"63A6C298A1D23\",\"user_id\":109,\"coupon_type\":null,\"coupon_discount_amount\":null,\"subtotal_price\":50,\"total_price\":150,\"discount_price\":null,\"payment_status\":\"paid\",\"order_status\":\"processing\",\"notes\":\"order place\",\"shipping_method_id\":1,\"shipping_pickup_point_id\":0,\"shipping_price\":100,\"snap_token\":null,\"created_at\":\"2022-12-24T09:12:58.000000Z\",\"updated_at\":\"2022-12-25T05:36:56.000000Z\",\"payment_method\":\"\",\"manual_payment_id\":0,\"guest_email\":\"test@gmail.com\",\"guest_name\":\"Madhuri test\",\"address_type\":null,\"transaction_id\":null}}', NULL, '2022-12-25 21:36:56', '2022-12-25 21:36:56'),
(758882, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A6C298A1D23 has beenon_the_way !', '0000-00-00 00:00:00', '2022-12-25 21:37:02', '2022-12-25 21:37:02'),
(758883, 'App\\Notifications\\Frontend\\OrderTrackNotification', NULL, 'Modules\\Order\\Entities\\Order', 131, '{\"title\":\"Your order is now in on the way.\",\"order\":{\"id\":131,\"order_no\":\"63A6C298A1D23\",\"user_id\":109,\"coupon_type\":null,\"coupon_discount_amount\":null,\"subtotal_price\":50,\"total_price\":150,\"discount_price\":null,\"payment_status\":\"paid\",\"order_status\":\"on_the_way\",\"notes\":\"order place\",\"shipping_method_id\":1,\"shipping_pickup_point_id\":0,\"shipping_price\":100,\"snap_token\":null,\"created_at\":\"2022-12-24T09:12:58.000000Z\",\"updated_at\":\"2022-12-25T05:37:02.000000Z\",\"payment_method\":\"\",\"manual_payment_id\":0,\"guest_email\":\"test@gmail.com\",\"guest_name\":\"Madhuri test\",\"address_type\":null,\"transaction_id\":null}}', NULL, '2022-12-25 21:37:02', '2022-12-25 21:37:02'),
(758884, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A6C298A1D23 has beendelivered !', '0000-00-00 00:00:00', '2022-12-25 21:37:11', '2022-12-25 21:37:11'),
(758885, 'App\\Notifications\\Frontend\\OrderTrackNotification', NULL, 'Modules\\Order\\Entities\\Order', 131, '{\"title\":\"Your order has been delivered. Thank you for shopping with Glossman!\",\"order\":{\"id\":131,\"order_no\":\"63A6C298A1D23\",\"user_id\":109,\"coupon_type\":null,\"coupon_discount_amount\":null,\"subtotal_price\":50,\"total_price\":150,\"discount_price\":null,\"payment_status\":\"paid\",\"order_status\":\"delivered\",\"notes\":\"order place\",\"shipping_method_id\":1,\"shipping_pickup_point_id\":0,\"shipping_price\":100,\"snap_token\":null,\"created_at\":\"2022-12-24T09:12:58.000000Z\",\"updated_at\":\"2022-12-25T05:37:11.000000Z\",\"payment_method\":\"\",\"manual_payment_id\":0,\"guest_email\":\"test@gmail.com\",\"guest_name\":\"Madhuri test\",\"address_type\":null,\"transaction_id\":null}}', NULL, '2022-12-25 21:37:11', '2022-12-25 21:37:11'),
(758886, 'App\\Notifications\\Frontend\\OrderTrackNotification', 109, 'aasdsad', 0, 'Your Order #63A6C298A1D23 has beencancelled !', '0000-00-00 00:00:00', '2022-12-25 21:37:18', '2022-12-25 21:37:18'),
(758887, 'App\\Notifications\\Frontend\\OrderTrackNotification', 19, 'aasdsad', 0, 'Your Order #63A59BCF8729E has beenon_the_way !', '0000-00-00 00:00:00', '2022-12-26 16:30:23', '2022-12-26 16:30:23'),
(758888, 'App\\Notifications\\Frontend\\OrderTrackNotification', 19, 'aasdsad', 0, 'Your Order #63A59BCF8729E has beenon_the_way !', '0000-00-00 00:00:00', '2022-12-26 16:32:51', '2022-12-26 16:32:51'),
(758889, 'App\\Notifications\\Frontend\\OrderTrackNotification', 19, 'aasdsad', 0, 'Your Order #63A9505DD3181 has been Placed!', '0000-00-00 00:00:00', '2022-12-26 18:12:23', '2022-12-26 18:12:23'),
(758890, 'App\\Notifications\\Frontend\\OrderTrackNotification', 19, 'aasdsad', 0, 'Your Order #63A958FC73158 has been Placed!', '0000-00-00 00:00:00', '2022-12-26 18:49:09', '2022-12-26 18:49:09'),
(758891, 'App\\Notifications\\Frontend\\OrderTrackNotification', 19, 'aasdsad', 0, 'Your Order #63A95B4D495E8 has been Placed!', '0000-00-00 00:00:00', '2022-12-26 18:59:02', '2022-12-26 18:59:02'),
(758892, 'App\\Notifications\\Frontend\\OrderTrackNotification', 19, 'aasdsad', 0, 'Your Order #63A995A5C20DB has been Placed!', '0000-00-00 00:00:00', '2022-12-26 23:07:59', '2022-12-26 23:07:59'),
(758893, 'App\\Notifications\\Frontend\\OrderTrackNotification', 114, 'aasdsad', 0, 'Your Order #63A99D6FCE42A has been Placed!', '0000-00-00 00:00:00', '2022-12-26 23:41:13', '2022-12-26 23:41:13'),
(758894, 'App\\Notifications\\Frontend\\OrderTrackNotification', 114, 'aasdsad', 0, 'Your Order #63A99D6FCE42A has beendelivered !', '0000-00-00 00:00:00', '2022-12-26 23:49:59', '2022-12-26 23:49:59'),
(758895, 'App\\Notifications\\Frontend\\OrderTrackNotification', 114, 'aasdsad', 0, 'Your Order #63A99D6FCE42A has beendelivered !', '0000-00-00 00:00:00', '2022-12-26 23:50:04', '2022-12-26 23:50:04'),
(758896, 'App\\Notifications\\Frontend\\OrderTrackNotification', 114, 'aasdsad', 0, 'Your Order #63A99D6FCE42A has beenon_the_way !', '0000-00-00 00:00:00', '2022-12-26 23:52:04', '2022-12-26 23:52:04'),
(758897, 'App\\Notifications\\Frontend\\OrderTrackNotification', 114, 'aasdsad', 0, 'Your Order #63A99D6FCE42A has beendelivered !', '0000-00-00 00:00:00', '2022-12-26 23:52:10', '2022-12-26 23:52:10'),
(758898, 'App\\Notifications\\Frontend\\OrderTrackNotification', 19, 'aasdsad', 0, 'Your Order #63A9C8B9EF209 has been Placed!', '0000-00-00 00:00:00', '2022-12-27 02:45:55', '2022-12-27 02:45:55'),
(758899, 'App\\Notifications\\Frontend\\OrderTrackNotification', 19, 'aasdsad', 0, 'Your Order #63A9CB7706D0E has been Placed!', '0000-00-00 00:00:00', '2022-12-27 02:57:36', '2022-12-27 02:57:36'),
(758900, 'App\\Notifications\\Frontend\\OrderTrackNotification', 19, 'aasdsad', 0, 'Your Order #63A9CB7706D0E has beenon_the_way !', '0000-00-00 00:00:00', '2022-12-27 02:58:34', '2022-12-27 02:58:34'),
(758901, 'App\\Notifications\\Frontend\\OrderTrackNotification', 19, 'aasdsad', 0, 'Your Order #63A9CB7706D0E has beendelivered !', '0000-00-00 00:00:00', '2022-12-27 02:58:50', '2022-12-27 02:58:50'),
(758902, 'App\\Notifications\\Frontend\\OrderTrackNotification', 114, 'aasdsad', 0, 'Your Order #63AA89FA602C8 has been Placed!', '0000-00-00 00:00:00', '2022-12-27 16:30:27', '2022-12-27 16:30:27'),
(758903, 'App\\Notifications\\Frontend\\OrderTrackNotification', 120, 'aasdsad', 0, 'Your Order #63AAD542A6FBE has been Placed!', '0000-00-00 00:00:00', '2022-12-27 21:51:40', '2022-12-27 21:51:40'),
(758904, 'App\\Notifications\\Frontend\\OrderTrackNotification', 121, 'aasdsad', 0, 'Your Order #63AAE33F16B7B has been Placed!', '0000-00-00 00:00:00', '2022-12-27 22:51:20', '2022-12-27 22:51:20'),
(758905, 'App\\Notifications\\Frontend\\OrderTrackNotification', 129, 'aasdsad', 0, 'Your Order #63AC20AFBA25F has been Placed!', '0000-00-00 00:00:00', '2022-12-28 21:25:45', '2022-12-28 21:25:45'),
(758906, 'App\\Notifications\\Frontend\\OrderTrackNotification', 131, 'aasdsad', 0, 'Your Order #63AC31D9B6E31 has been Placed!', '0000-00-00 00:00:00', '2022-12-28 22:38:59', '2022-12-28 22:38:59'),
(758907, 'App\\Notifications\\Frontend\\OrderTrackNotification', 131, 'aasdsad', 0, 'Your Order #63AD35103A0CC has been Placed!', '0000-00-00 00:00:00', '2022-12-29 17:04:57', '2022-12-29 17:04:57'),
(758908, 'App\\Notifications\\Frontend\\OrderTrackNotification', 131, 'aasdsad', 0, 'Your Order #63AD6BD7B3230 has been Placed!', '0000-00-00 00:00:00', '2022-12-29 20:58:41', '2022-12-29 20:58:41'),
(758909, 'App\\Notifications\\Frontend\\OrderTrackNotification', 19, 'aasdsad', 0, 'Your Order #63AE7B12028F5 has been Placed!', '0000-00-00 00:00:00', '2022-12-30 16:15:55', '2022-12-30 16:15:55'),
(758910, 'App\\Notifications\\Frontend\\OrderTrackNotification', 136, 'aasdsad', 0, 'Your Order #63AEC2983A133 has been Placed!', '0000-00-00 00:00:00', '2022-12-30 21:21:05', '2022-12-30 21:21:05'),
(758911, 'App\\Notifications\\Frontend\\OrderTrackNotification', 131, 'aasdsad', 0, 'Your Order #63AED289CE244 has been Placed!', '0000-00-00 00:00:00', '2022-12-30 22:29:07', '2022-12-30 22:29:07'),
(758912, 'App\\Notifications\\Frontend\\OrderTrackNotification', 137, 'aasdsad', 0, 'Your Order #63AEE8B21EF22 has been Placed!', '0000-00-00 00:00:00', '2022-12-31 00:03:39', '2022-12-31 00:03:39'),
(758913, 'App\\Notifications\\Frontend\\OrderTrackNotification', 137, 'aasdsad', 0, 'Your Order #63AEE8B21EF22 has beenon_the_way !', '0000-00-00 00:00:00', '2023-01-02 17:11:21', '2023-01-02 17:11:21'),
(758914, 'App\\Notifications\\Frontend\\OrderTrackNotification', 136, 'aasdsad', 0, 'Your Order #63B66FE4BF87A has been Placed!', '0000-00-00 00:00:00', '2023-01-05 17:06:23', '2023-01-05 17:06:23'),
(758915, 'App\\Notifications\\Frontend\\OrderTrackNotification', 136, 'aasdsad', 0, 'Your Order #63B67092C10DE has been Placed!', '0000-00-00 00:00:00', '2023-01-05 17:09:16', '2023-01-05 17:09:16'),
(758916, 'App\\Notifications\\Frontend\\OrderTrackNotification', 136, 'aasdsad', 0, 'Your Order #63B67125ADC1C has been Placed!', '0000-00-00 00:00:00', '2023-01-05 17:11:44', '2023-01-05 17:11:44'),
(758917, 'App\\Notifications\\Frontend\\OrderTrackNotification', 136, 'aasdsad', 0, 'Your Order #63B6B5CD87920 has been Placed!', '0000-00-00 00:00:00', '2023-01-05 22:04:40', '2023-01-05 22:04:40'),
(758918, 'App\\Notifications\\Frontend\\OrderTrackNotification', 138, 'aasdsad', 0, 'Your Order #63B7EDE284746 has been Placed!', '0000-00-00 00:00:00', '2023-01-06 20:16:12', '2023-01-06 20:16:12'),
(758919, 'App\\Notifications\\Frontend\\OrderTrackNotification', 136, 'aasdsad', 0, 'Your Order #63B8206B0ABCA has been Placed!', '0000-00-00 00:00:00', '2023-01-06 23:51:48', '2023-01-06 23:51:48'),
(758920, 'App\\Notifications\\Frontend\\OrderTrackNotification', 136, 'aasdsad', 0, 'Your Order #63B8214AAF1BA has been Placed!', '0000-00-00 00:00:00', '2023-01-06 23:55:33', '2023-01-06 23:55:33'),
(758921, 'App\\Notifications\\Frontend\\OrderTrackNotification', 136, 'aasdsad', 0, 'Your Order #63B821A201BE5 has been Placed!', '0000-00-00 00:00:00', '2023-01-06 23:56:59', '2023-01-06 23:56:59'),
(758922, 'App\\Notifications\\Frontend\\OrderTrackNotification', 136, 'aasdsad', 0, 'Your Order #63BBAEF4CF5D6 has been Placed!', '0000-00-00 00:00:00', '2023-01-09 16:36:46', '2023-01-09 16:36:46'),
(758923, 'App\\Notifications\\Frontend\\OrderTrackNotification', 136, 'aasdsad', 0, 'Your Order #63BBB4D5AC931 has been Placed!', '0000-00-00 00:00:00', '2023-01-09 17:01:51', '2023-01-09 17:01:51'),
(758924, 'App\\Notifications\\Frontend\\OrderTrackNotification', 136, 'aasdsad', 0, 'Your Order #63BBD4F1F2F25 has been Placed!', '0000-00-00 00:00:00', '2023-01-09 19:18:52', '2023-01-09 19:18:52'),
(758925, 'App\\Notifications\\Frontend\\OrderTrackNotification', 127, 'aasdsad', 0, 'Your Order #63BC03BE2D0DC has been Placed!', '0000-00-00 00:00:00', '2023-01-09 22:38:31', '2023-01-09 22:38:31'),
(758926, 'App\\Notifications\\Frontend\\OrderTrackNotification', 141, 'aasdsad', 0, 'Your Order #63BD4CD04B636 has been Placed!', '0000-00-00 00:00:00', '2023-01-10 22:02:34', '2023-01-10 22:02:34'),
(758927, 'App\\Notifications\\Frontend\\OrderTrackNotification', 141, 'aasdsad', 0, 'Your Order #63BD4EE68D914 has been Placed!', '0000-00-00 00:00:00', '2023-01-10 22:11:28', '2023-01-10 22:11:28'),
(758928, 'App\\Notifications\\Frontend\\OrderTrackNotification', 141, 'aasdsad', 0, 'Your Order #63BD5449EDEF0 has been Placed!', '0000-00-00 00:00:00', '2023-01-10 22:34:27', '2023-01-10 22:34:27'),
(758929, 'App\\Notifications\\Frontend\\OrderTrackNotification', 127, 'aasdsad', 0, 'Your Order #63C12B3F942F0 has been Placed!', '0000-00-00 00:00:00', '2023-01-13 20:28:24', '2023-01-13 20:28:24'),
(758930, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63C51F4D66992 has been Placed!', '0000-00-00 00:00:00', '2023-01-16 20:26:32', '2023-01-16 20:26:32'),
(758931, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63C521C4D6A50 has been Placed!', '0000-00-00 00:00:00', '2023-01-16 20:37:03', '2023-01-16 20:37:03'),
(758932, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63C526D05695A has been Placed!', '0000-00-00 00:00:00', '2023-01-16 20:58:35', '2023-01-16 20:58:35'),
(758933, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63C61D840B00F has been Placed!', '0000-00-00 00:00:00', '2023-01-17 14:31:11', '2023-01-17 14:31:11'),
(758934, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63C62D20A6C8D has been Placed!', '0000-00-00 00:00:00', '2023-01-17 15:37:46', '2023-01-17 15:37:46'),
(758935, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63C62D20A6C8D has beenon_the_way !', '0000-00-00 00:00:00', '2023-01-17 15:53:17', '2023-01-17 15:53:17'),
(758936, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63C62D20A6C8D has beendelivered !', '0000-00-00 00:00:00', '2023-01-17 15:54:31', '2023-01-17 15:54:31'),
(758937, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63C6492B5F033 has been Placed!', '0000-00-00 00:00:00', '2023-01-17 17:37:24', '2023-01-17 17:37:24'),
(758938, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63C64BCE7F57E has been Placed!', '0000-00-00 00:00:00', '2023-01-17 17:48:39', '2023-01-17 17:48:39'),
(758939, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63C64BCE7F57E has beenon_the_way !', '0000-00-00 00:00:00', '2023-01-17 18:04:17', '2023-01-17 18:04:17'),
(758940, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63C64BCE7F57E has beendelivered !', '0000-00-00 00:00:00', '2023-01-17 19:08:09', '2023-01-17 19:08:09'),
(758941, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63C8DA05D6945 has been Placed!', '0000-00-00 00:00:00', '2023-01-19 16:19:59', '2023-01-19 16:19:59'),
(758942, 'App\\Notifications\\Frontend\\OrderTrackNotification', 146, 'aasdsad', 0, 'Your Order #63C8EE69A2225 has been Placed!', '0000-00-00 00:00:00', '2023-01-19 17:46:59', '2023-01-19 17:46:59'),
(758943, 'App\\Notifications\\Frontend\\OrderTrackNotification', 146, 'aasdsad', 0, 'Your Order #63C8F05E41BE0 has been Placed!', '0000-00-00 00:00:00', '2023-01-19 17:55:19', '2023-01-19 17:55:19'),
(758944, 'App\\Notifications\\Frontend\\OrderTrackNotification', 146, 'aasdsad', 0, 'Your Order #63C8F1CBCEDEA has been Placed!', '0000-00-00 00:00:00', '2023-01-19 18:01:25', '2023-01-19 18:01:25'),
(758945, 'App\\Notifications\\Frontend\\OrderTrackNotification', 146, 'aasdsad', 0, 'Your Order #63C8F2C860BB1 has been Placed!', '0000-00-00 00:00:00', '2023-01-19 18:05:37', '2023-01-19 18:05:37'),
(758946, 'App\\Notifications\\Frontend\\OrderTrackNotification', 148, 'aasdsad', 0, 'Your Order #63CA2E4CE1C6E has been Placed!', '0000-00-00 00:00:00', '2023-01-20 16:31:50', '2023-01-20 16:31:50'),
(758947, 'App\\Notifications\\Frontend\\OrderTrackNotification', 148, 'aasdsad', 0, 'Your Order #63CA2E4CE1C6E has beenon_the_way !', '0000-00-00 00:00:00', '2023-01-20 17:09:24', '2023-01-20 17:09:24'),
(758948, 'App\\Notifications\\Frontend\\OrderTrackNotification', 148, 'aasdsad', 0, 'Your Order #63CA2E4CE1C6E has beendelivered !', '0000-00-00 00:00:00', '2023-01-20 17:09:56', '2023-01-20 17:09:56'),
(758949, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63CA381634F32 has been Placed!', '0000-00-00 00:00:00', '2023-01-20 17:13:35', '2023-01-20 17:13:35'),
(758950, 'App\\Notifications\\Frontend\\OrderTrackNotification', 127, 'aasdsad', 0, 'Your Order #63CA709FEB30B has been Placed!', '0000-00-00 00:00:00', '2023-01-20 21:14:49', '2023-01-20 21:14:49'),
(758951, 'App\\Notifications\\Frontend\\OrderTrackNotification', 127, 'aasdsad', 0, 'Your Order #63CA76EF8544F has been Placed!', '0000-00-00 00:00:00', '2023-01-20 21:41:45', '2023-01-20 21:41:45'),
(758952, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63CA7A0E74561 has been Placed!', '0000-00-00 00:00:00', '2023-01-20 21:55:03', '2023-01-20 21:55:03'),
(758953, 'App\\Notifications\\Frontend\\OrderTrackNotification', 127, 'aasdsad', 0, 'Your Order #63CA7DDE952D8 has been Placed!', '0000-00-00 00:00:00', '2023-01-20 22:11:20', '2023-01-20 22:11:20'),
(758954, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63CA80B2BE946 has been Placed!', '0000-00-00 00:00:00', '2023-01-20 22:23:24', '2023-01-20 22:23:24'),
(758955, 'App\\Notifications\\Frontend\\OrderTrackNotification', 127, 'aasdsad', 0, 'Your Order #63CA81ABA8A0A has been Placed!', '0000-00-00 00:00:00', '2023-01-20 22:27:33', '2023-01-20 22:27:33'),
(758956, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63CA80B2BE946 has beenon_the_way !', '0000-00-00 00:00:00', '2023-01-23 16:49:24', '2023-01-23 16:49:24'),
(758957, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63CE2C68B5F7F has been Placed!', '0000-00-00 00:00:00', '2023-01-23 17:12:50', '2023-01-23 17:12:50'),
(758958, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63CE30343D9B1 has been Placed!', '0000-00-00 00:00:00', '2023-01-23 17:29:01', '2023-01-23 17:29:01'),
(758959, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63CE31D620383 has been Placed!', '0000-00-00 00:00:00', '2023-01-23 17:35:59', '2023-01-23 17:35:59'),
(758960, 'App\\Notifications\\Frontend\\OrderTrackNotification', 150, 'aasdsad', 0, 'Your Order #63CE325706F45 has been Placed!', '0000-00-00 00:00:00', '2023-01-23 17:38:08', '2023-01-23 17:38:08'),
(758961, 'App\\Notifications\\Frontend\\OrderTrackNotification', 150, 'aasdsad', 0, 'Your Order #63CE350BCFE45 has been Placed!', '0000-00-00 00:00:00', '2023-01-23 17:49:41', '2023-01-23 17:49:41'),
(758962, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63CE35F422375 has been Placed!', '0000-00-00 00:00:00', '2023-01-23 17:53:33', '2023-01-23 17:53:33'),
(758963, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63CE35F422375 has beenon_the_way !', '0000-00-00 00:00:00', '2023-01-23 18:54:44', '2023-01-23 18:54:44'),
(758964, 'App\\Notifications\\Frontend\\OrderTrackNotification', 143, 'aasdsad', 0, 'Your Order #63CE35F422375 has beendelivered !', '0000-00-00 00:00:00', '2023-01-23 18:58:27', '2023-01-23 18:58:27'),
(758965, 'App\\Notifications\\Frontend\\OrderTrackNotification', 127, 'aasdsad', 0, 'Your Order #63CE5028692F0 has been Placed!', '0000-00-00 00:00:00', '2023-01-23 19:45:21', '2023-01-23 19:45:21'),
(758966, 'App\\Notifications\\Frontend\\OrderTrackNotification', 127, 'aasdsad', 0, 'Your Order #63CE52F8F1044 has been Placed!', '0000-00-00 00:00:00', '2023-01-23 19:57:22', '2023-01-23 19:57:22'),
(758967, 'App\\Notifications\\Frontend\\OrderTrackNotification', 127, 'aasdsad', 0, 'Your Order #63CE543940D61 has been Placed!', '0000-00-00 00:00:00', '2023-01-23 20:02:42', '2023-01-23 20:02:42'),
(758968, 'App\\Notifications\\Frontend\\OrderTrackNotification', 151, 'aasdsad', 0, 'Your Order #63CE5F6592C7D has been Placed!', '0000-00-00 00:00:00', '2023-01-23 20:50:23', '2023-01-23 20:50:23'),
(758969, 'App\\Notifications\\Frontend\\OrderTrackNotification', 151, 'aasdsad', 0, 'Your Order #63CE75F1A412F has been Placed!', '0000-00-00 00:00:00', '2023-01-23 22:26:35', '2023-01-23 22:26:35'),
(758970, 'App\\Notifications\\Frontend\\OrderTrackNotification', 151, 'aasdsad', 0, 'Your Order #63CE77CC67757 has been Placed!', '0000-00-00 00:00:00', '2023-01-23 22:34:29', '2023-01-23 22:34:29'),
(758971, 'App\\Notifications\\Frontend\\OrderTrackNotification', 151, 'aasdsad', 0, 'Your Order #63CE7F1E7E937 has been Placed!', '0000-00-00 00:00:00', '2023-01-23 23:05:43', '2023-01-23 23:05:43'),
(758972, 'App\\Notifications\\Frontend\\OrderTrackNotification', 151, 'aasdsad', 0, 'Your Order #63CE7F8D75FC4 has been Placed!', '0000-00-00 00:00:00', '2023-01-23 23:07:34', '2023-01-23 23:07:34'),
(758973, 'App\\Notifications\\Frontend\\OrderTrackNotification', 151, 'aasdsad', 0, 'Your Order #63CF66B9E2EDD has been Placed!', '0000-00-00 00:00:00', '2023-01-24 15:33:55', '2023-01-24 15:33:55'),
(758974, 'App\\Notifications\\Frontend\\OrderTrackNotification', 153, 'aasdsad', 0, 'Your Order #63CF6F66EBC21 has been Placed!', '0000-00-00 00:00:00', '2023-01-24 16:10:56', '2023-01-24 16:10:56'),
(758975, 'App\\Notifications\\Frontend\\OrderTrackNotification', 153, 'aasdsad', 0, 'Your Order #63CF737DA2D27 has been Placed!', '0000-00-00 00:00:00', '2023-01-24 16:28:23', '2023-01-24 16:28:23'),
(758976, 'App\\Notifications\\Frontend\\OrderTrackNotification', 153, 'aasdsad', 0, 'Your Order #63CF76CD7E9F2 has been Placed!', '0000-00-00 00:00:00', '2023-01-24 16:42:30', '2023-01-24 16:42:30'),
(758977, 'App\\Notifications\\Frontend\\OrderTrackNotification', 160, 'aasdsad', 0, 'Your Order #63CF9B9894FE3 has been Placed!', '0000-00-00 00:00:00', '2023-01-24 19:19:30', '2023-01-24 19:19:30'),
(758978, 'App\\Notifications\\Frontend\\OrderTrackNotification', 160, 'aasdsad', 0, 'Your Order #63CF9B9894FE3 has beenon_the_way !', '0000-00-00 00:00:00', '2023-01-24 19:47:41', '2023-01-24 19:47:41'),
(758979, 'App\\Notifications\\Frontend\\OrderTrackNotification', 160, 'aasdsad', 0, 'Your Order #63CF9B9894FE3 has beendelivered !', '0000-00-00 00:00:00', '2023-01-24 19:48:10', '2023-01-24 19:48:10'),
(758980, 'App\\Notifications\\Frontend\\OrderTrackNotification', 160, 'aasdsad', 0, 'Your Order #63CFBCB39860B has been Placed!', '0000-00-00 00:00:00', '2023-01-24 21:40:45', '2023-01-24 21:40:45'),
(758981, 'App\\Notifications\\Frontend\\OrderTrackNotification', 153, 'aasdsad', 0, 'Your Order #63CFC567A8263 has been Placed!', '0000-00-00 00:00:00', '2023-01-24 22:17:53', '2023-01-24 22:17:53'),
(758982, 'App\\Notifications\\Frontend\\OrderTrackNotification', 161, 'aasdsad', 0, 'Your Order #63D0F1170669A has been Placed!', '0000-00-00 00:00:00', '2023-01-25 19:36:32', '2023-01-25 19:36:32'),
(758983, 'App\\Notifications\\Frontend\\OrderTrackNotification', 161, 'aasdsad', 0, 'Your Order #63D0F1170669A has beenon_the_way !', '0000-00-00 00:00:00', '2023-01-25 19:42:10', '2023-01-25 19:42:10'),
(758984, 'App\\Notifications\\Frontend\\OrderTrackNotification', 161, 'aasdsad', 0, 'Your Order #63D0F1170669A has beendelivered !', '0000-00-00 00:00:00', '2023-01-25 19:43:30', '2023-01-25 19:43:30'),
(758985, 'App\\Notifications\\Frontend\\OrderTrackNotification', 161, 'aasdsad', 0, 'Your Order #63D0F50B9AA87 has been Placed!', '0000-00-00 00:00:00', '2023-01-25 19:53:25', '2023-01-25 19:53:25'),
(758986, 'App\\Notifications\\Frontend\\OrderTrackNotification', 160, 'aasdsad', 0, 'Your Order #63D0F7552465B has been Placed!', '0000-00-00 00:00:00', '2023-01-25 20:03:10', '2023-01-25 20:03:10'),
(758987, 'App\\Notifications\\Frontend\\OrderTrackNotification', 160, 'aasdsad', 0, 'Your Order #63D0F825AE8D8 has been Placed!', '0000-00-00 00:00:00', '2023-01-25 20:06:39', '2023-01-25 20:06:39'),
(758988, 'App\\Notifications\\Frontend\\OrderTrackNotification', 163, 'aasdsad', 0, 'Your Order #63D3AECB8FD3B has been Placed!', '0000-00-00 00:00:00', '2023-01-27 21:30:28', '2023-01-27 21:30:28'),
(758989, 'App\\Notifications\\Frontend\\OrderTrackNotification', 163, 'aasdsad', 0, 'Your Order #63D3AFE9D7472 has been Placed!', '0000-00-00 00:00:00', '2023-01-27 21:35:15', '2023-01-27 21:35:15'),
(758990, 'App\\Notifications\\Frontend\\OrderTrackNotification', 163, 'aasdsad', 0, 'Your Order #63D3AECB8FD3B has beenon_the_way !', '0000-00-00 00:00:00', '2023-01-27 21:43:26', '2023-01-27 21:43:26'),
(758991, 'App\\Notifications\\Frontend\\OrderTrackNotification', 163, 'aasdsad', 0, 'Your Order #63D3AECB8FD3B has beendelivered !', '0000-00-00 00:00:00', '2023-01-27 21:44:26', '2023-01-27 21:44:26'),
(758992, 'App\\Notifications\\Frontend\\OrderTrackNotification', 164, 'aasdsad', 0, 'Your Order #63D78CEABE2F8 has been Placed!', '0000-00-00 00:00:00', '2023-01-30 19:55:00', '2023-01-30 19:55:00'),
(758993, 'App\\Notifications\\Frontend\\OrderTrackNotification', 164, 'aasdsad', 0, 'Your Order #63D78CEABE2F8 has beenon_the_way !', '0000-00-00 00:00:00', '2023-01-30 19:56:44', '2023-01-30 19:56:44'),
(758994, 'App\\Notifications\\Frontend\\OrderTrackNotification', 164, 'aasdsad', 0, 'Your Order #63D78CEABE2F8 has beenprocessing !', '0000-00-00 00:00:00', '2023-01-30 19:58:02', '2023-01-30 19:58:02'),
(758995, 'App\\Notifications\\Frontend\\OrderTrackNotification', 164, 'aasdsad', 0, 'Your Order #63D78CEABE2F8 has beendelivered !', '0000-00-00 00:00:00', '2023-01-30 19:58:23', '2023-01-30 19:58:23'),
(758996, 'App\\Notifications\\Frontend\\OrderTrackNotification', 164, 'aasdsad', 0, 'Your Order #63D79184311AF has been Placed!', '0000-00-00 00:00:00', '2023-01-30 20:14:37', '2023-01-30 20:14:37'),
(758997, 'App\\Notifications\\Frontend\\OrderTrackNotification', 153, 'aasdsad', 0, 'Your Order #63D7A73023156 has been Placed!', '0000-00-00 00:00:00', '2023-01-30 21:47:05', '2023-01-30 21:47:05'),
(758998, 'App\\Notifications\\Frontend\\OrderTrackNotification', 153, 'aasdsad', 0, 'Your Order #63D7A923B35FD has been Placed!', '0000-00-00 00:00:00', '2023-01-30 21:55:25', '2023-01-30 21:55:25'),
(758999, 'App\\Notifications\\Frontend\\OrderTrackNotification', 6, 'aasdsad', 0, 'Your Order #63D8DD327459F has been Placed!', '0000-00-00 00:00:00', '2023-01-31 19:49:47', '2023-01-31 19:49:47'),
(759000, 'App\\Notifications\\Frontend\\OrderTrackNotification', 6, 'aasdsad', 0, 'Your Order #63D8DD327459F has beenon_the_way !', '0000-00-00 00:00:00', '2023-01-31 19:59:59', '2023-01-31 19:59:59'),
(759001, 'App\\Notifications\\Frontend\\OrderTrackNotification', 6, 'aasdsad', 0, 'Your Order #63D8DD327459F has beendelivered !', '0000-00-00 00:00:00', '2023-01-31 20:01:50', '2023-01-31 20:01:50'),
(759002, 'App\\Notifications\\Frontend\\OrderTrackNotification', 8, 'aasdsad', 0, 'Your Order #63D8E8D9C977F has been Placed!', '0000-00-00 00:00:00', '2023-01-31 20:39:31', '2023-01-31 20:39:31'),
(759003, 'App\\Notifications\\Frontend\\OrderTrackNotification', 8, 'aasdsad', 0, 'Your Order #63D8E8D9C977F has beenpending !', '0000-00-00 00:00:00', '2023-01-31 20:43:03', '2023-01-31 20:43:03'),
(759004, 'App\\Notifications\\Frontend\\OrderTrackNotification', 10, 'aasdsad', 0, 'Your Order #63D90D19E5C01 has been Placed!', '0000-00-00 00:00:00', '2023-01-31 23:14:11', '2023-01-31 23:14:11'),
(759005, 'App\\Notifications\\Frontend\\OrderTrackNotification', 10, 'aasdsad', 0, 'Your Order #63D90D19E5C01 has beenon_the_way !', '0000-00-00 00:00:00', '2023-02-01 16:53:07', '2023-02-01 16:53:07'),
(759006, 'App\\Notifications\\Frontend\\OrderTrackNotification', 10, 'aasdsad', 0, 'Your Order #63D90D19E5C01 has beendelivered !', '0000-00-00 00:00:00', '2023-02-01 16:53:28', '2023-02-01 16:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `notifications_b`
--

CREATE TABLE `notifications` (
  `id` int NOT NULL,
  `type` int NOT NULL DEFAULT '1',
  `user_id` int NOT NULL DEFAULT '0',
  `message` varchar(500) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `notifiable_type` int DEFAULT NULL,
  `notifiable_id` int DEFAULT NULL,
  `read_at` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `notifications_b`
--

INSERT INTO `notifications` (`id`, `type`, `user_id`, `message`, `status`, `notifiable_type`, `notifiable_id`, `read_at`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 'Your Order #12345 has been shipped!', 1, NULL, NULL, NULL, '2022-11-18 06:06:47', '2022-11-18 06:06:47'),
(2, 1, 13, 'Happy Birthdat To you! gift a 15% to you!', 1, NULL, NULL, NULL, '2022-11-18 06:06:47', '2022-11-18 06:06:47'),
(3, 1, 0, 'Special offer 50% all product balloons to day.', 1, NULL, NULL, NULL, '2022-11-18 06:06:47', '2022-11-18 06:06:47'),
(4, 1, 12, 'Your Order #12345444 has been shipped!', 1, NULL, NULL, NULL, '2022-11-18 06:06:47', '2022-11-18 06:06:47'),
(5, 1, 0, 'Special offer 15% all product Godiva  chocolate crepes party box to day', 1, NULL, NULL, NULL, '2022-11-18 06:06:47', '2022-11-18 06:06:47'),
(6, 1, 0, 'Special offer 10% all product  artificial flowers to day.', 1, NULL, NULL, NULL, '2022-11-18 06:06:47', '2022-11-18 06:06:47'),
(7, 1, 0, 'Special Offer 25% all product chocoflowers to day.', 1, NULL, NULL, NULL, '2022-11-18 06:06:47', '2022-11-18 06:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `order_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `coupon_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_discount_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal_price` double(8,2) NOT NULL,
  `total_price` double(8,2) NOT NULL,
  `discount_price` double(8,2) DEFAULT '0.00',
  `payment_status` enum('unpaid','paid') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid',
  `order_status` enum('pending','processing','on_the_way','delivered','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `note` longtext COLLATE utf8mb4_unicode_ci,
  `shipping_method_id` bigint UNSIGNED DEFAULT NULL,
  `shipping_pickup_point_id` bigint UNSIGNED DEFAULT NULL,
  `shipping_price` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT '100',
  `snap_token` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `payment_method` enum('creditcard','paypal','stripe','razorpay','paystack','flutterwave','mollie','sslcommerz') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'creditcard',
  `manual_payment_id` bigint UNSIGNED DEFAULT NULL,
  `guest_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guest_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipment_number` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `user_id`, `coupon_type`, `coupon_discount_amount`, `subtotal_price`, `total_price`, `discount_price`, `payment_status`, `order_status`, `notes`, `note`, `shipping_method_id`, `shipping_pickup_point_id`, `shipping_price`, `snap_token`, `created_at`, `updated_at`, `payment_method`, `manual_payment_id`, `guest_email`, `guest_name`, `address_type`, `transaction_id`, `shipment_number`) VALUES
(1, '63D8DD327459F', 6, NULL, NULL, 120.00, 143.00, 0.00, 'paid', 'delivered', 'order place', NULL, 1, 0, '23', NULL, '2023-01-31 14:49:47', '2023-01-31 09:31:50', '', 0, 'test@gmail.com', 'madhuri test', NULL, NULL, '0'),
(2, '63D8E8D9C977F', 8, NULL, NULL, 120.00, 143.00, 0.00, 'paid', 'pending', 'order place', NULL, 1, 0, '23', NULL, '2023-01-31 15:39:31', '2023-01-31 10:13:03', '', 0, 'joshi@yopmail.com', 'joshi bhushan', NULL, NULL, '0'),
(3, '63D90D19E5C01', 10, NULL, NULL, 840.00, 865.43, 0.00, 'paid', 'delivered', 'order place', NULL, 1, 0, '25.43', NULL, '2023-01-31 18:14:11', '2023-02-01 06:23:28', '', 0, 'madhuri.waghel@freshcodes.in', 'Madhuri Test', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `id` int NOT NULL,
  `order_id` int DEFAULT NULL,
  `addressable_id` bigint UNSIGNED DEFAULT NULL,
  `addressable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('home','office','other') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`id`, `order_id`, `addressable_id`, `addressable_type`, `first_name`, `last_name`, `company_name`, `address`, `country_id`, `state_id`, `city_id`, `zip_code`, `email`, `phone`, `type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 'madhuri', 'test', NULL, 'add the address name', '38', '658', '10053', 'test11', 'test@gmail.com', '+(91)9876543210', 'other', 6, '2023-01-31 09:19:47', '2023-01-31 09:19:47'),
(2, 2, NULL, NULL, 'joshi', 'bhushan', NULL, 'canb', '38', '661', '48324', '1uuwuw', 'joshi@yopmail.com', '+(91)9985033903', 'home', 8, '2023-01-31 10:09:31', '2023-01-31 10:09:31'),
(3, 3, NULL, NULL, 'Madhuri', 'Test', 'adsd', 'lp savani road surat', '100', '50', '10061', 'A1A1A1', 'madhuri.waghel@freshcodes.in', '9876543210', 'home', 10, '2023-01-31 12:44:11', '2023-01-31 12:44:11');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `user_id`, `product_id`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 37, '120', '1', '2023-01-31 19:49:47', '2023-01-31 19:49:47'),
(2, 2, 8, 37, '120', '1', '2023-01-31 20:39:31', '2023-01-31 20:39:31'),
(3, 3, 10, 37, '840', '7', '2023-01-31 23:14:11', '2023-01-31 23:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `order_product_attributes`
--

CREATE TABLE `order_product_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `order_product_id` bigint UNSIGNED NOT NULL,
  `attribute` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `duration_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `price`, `duration`, `duration_type`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 'BASIC', 30, 3, 'month', 1, '<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem in quas, tempora, laboriosam ullam delectus deserunt ab ratione cumque officia ipsa dolore voluptatum officiis unde commodi ut possimus, corrupti id?</p>', '2022-11-17 00:00:00', '2022-12-25 10:48:48'),
(2, 'ESSENTIAL', 50, 6, 'month', 1, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Exercitationem in quas, tempora, laboriosam ullam delectus deserunt ab ratione cumque officia ipsa dolore voluptatum officiis unde commodi ut possimus, corrupti id?', '2022-11-17 00:00:00', '2022-11-17 00:00:00'),
(3, 'PREMIUM', 100, 12, 'month', 1, '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2022-11-17 00:00:00', '2023-01-12 09:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `package_services`
--

CREATE TABLE `package_services` (
  `id` bigint UNSIGNED NOT NULL,
  `package_id` int NOT NULL,
  `service_id` int NOT NULL,
  `service_count` int NOT NULL,
  `service_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discription` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_services`
--

INSERT INTO `package_services` (`id`, `package_id`, `service_id`, `service_count`, `service_name`, `discription`, `created_at`, `updated_at`) VALUES
(5, 2, 1, 10, 'cleaning', 'car cleaning', NULL, NULL),
(6, 2, 2, 10, 'Polishing', 'Polishing', NULL, NULL),
(7, 2, 3, 10, 'Waxing', 'Waxing', NULL, NULL),
(8, 2, 4, 10, 'Interior Cleaning', 'Interior Cleaning', NULL, NULL),
(9, 2, 8, 10, 'Tire & Wheel Services', 'Tire & Wheel Services', NULL, NULL),
(62, 22, 1, 12, 'Cleaning', 'Cleaning', '2022-12-22 11:43:54', '2022-12-22 11:43:54'),
(63, 23, 3, 12, 'Waxing', 'Waxing', '2022-12-22 04:46:25', '2022-12-22 04:46:25'),
(64, 24, 2, 234, 'Polishing', 'Polishing', '2022-12-22 04:49:00', '2022-12-22 04:49:00'),
(65, 25, 2, 234, 'Polishing', 'Polishing', '2022-12-22 10:20:09', '2022-12-22 10:20:09'),
(66, 26, 3, 234, 'Waxing', 'Waxing', '2022-12-22 04:52:05', '2022-12-22 04:52:05'),
(67, 27, 3, 123, 'Waxing', 'Waxing', '2022-12-22 10:34:15', '2022-12-22 10:34:15'),
(68, 28, 1, 234, 'Cleaning', 'Cleaning', '2022-12-22 10:37:26', '2022-12-22 10:37:26'),
(69, 29, 3, 234, 'Waxing', 'Waxing', '2022-12-22 10:39:27', '2022-12-22 10:39:27'),
(70, 30, 2, 234, 'Polishing', 'Polishing', '2022-12-22 07:14:54', '2022-12-22 07:14:54'),
(71, 31, 3, 123, 'Waxing', 'Waxing', '2022-12-22 10:51:20', '2022-12-22 10:51:20'),
(72, 32, 3, 234, 'Waxing', 'Waxing', '2022-12-22 10:58:45', '2022-12-22 10:58:45'),
(73, 34, 1, 234, 'Cleaning', 'Cleaning', '2022-12-22 11:29:01', '2022-12-22 11:29:01'),
(74, 35, 2, 324, 'Polishing', 'Polishing', '2022-12-22 11:30:20', '2022-12-22 11:30:20'),
(75, 36, 1, 234, 'Cleaning', 'Cleaning', '2022-12-22 11:31:20', '2022-12-22 11:31:20'),
(76, 37, 2, 234, 'Polishing', 'Polishing', '2022-12-22 11:33:11', '2022-12-22 11:33:11'),
(77, 38, 3, 234, 'Waxing', 'Waxing', '2022-12-22 11:34:04', '2022-12-22 11:34:04'),
(78, 39, 1, 3, 'Cleaning', 'Cleaning', '2022-12-23 09:57:55', '2022-12-23 09:57:55'),
(79, 39, 1, 3, 'Cleaning', 'Cleaning', '2022-12-23 09:57:55', '2022-12-23 09:57:55'),
(80, 39, 7, 3, 'OIL CHANGE', 'OIL CHANGE', '2022-12-23 09:57:55', '2022-12-23 09:57:55'),
(83, 40, 1, 2, 'Cleaning', 'Cleaning', '2022-12-24 10:35:17', '2022-12-24 10:35:17'),
(84, 40, 1, 2, 'Cleaning', 'Cleaning', '2022-12-24 10:35:17', '2022-12-24 10:35:17'),
(85, 1, 1, 5, 'Cleaning', 'Cleaning', '2022-12-25 15:48:48', '2022-12-25 15:48:48'),
(86, 1, 2, 5, 'Polishing', 'Polishing', '2022-12-25 15:48:48', '2022-12-25 15:48:48'),
(87, 1, 3, 5, 'Waxing', 'Waxing', '2022-12-25 15:48:48', '2022-12-25 15:48:48'),
(88, 1, 4, 5, 'Interior Cleaning', 'Interior Cleaning', '2022-12-25 15:48:48', '2022-12-25 15:48:48'),
(89, 1, 5, 5, 'Brakes', 'Brakes', '2022-12-25 15:48:48', '2022-12-25 15:48:48'),
(98, 3, 1, 20, 'Cleaning', 'Cleaning', '2023-01-12 14:37:48', '2023-01-12 14:37:48'),
(99, 3, 2, 20, 'Polishing', 'Polishing', '2023-01-12 14:37:48', '2023-01-12 14:37:48'),
(100, 3, 3, 20, 'Waxing', 'Waxing', '2023-01-12 14:37:48', '2023-01-12 14:37:48'),
(101, 3, 4, 20, 'Interior Cleaning', 'Interior Cleaning', '2023-01-12 14:37:48', '2023-01-12 14:37:48'),
(102, 3, 8, 20, 'TIRE & WHEEL SERVICES', 'TIRE & WHEEL SERVICES', '2023-01-12 14:37:48', '2023-01-12 14:37:48'),
(103, 3, 7, 20, 'OIL CHANGE', 'OIL CHANGE', '2023-01-12 14:37:48', '2023-01-12 14:37:48'),
(104, 3, 9, 20, 'BATTERY REPLACEMENT', 'BATTERY REPLACEMENT', '2023-01-12 14:37:48', '2023-01-12 14:37:48'),
(105, 3, 8, 20, 'TIRE & WHEEL SERVICES', 'TIRE & WHEEL SERVICES', '2023-01-12 14:37:48', '2023-01-12 14:37:48'),
(106, 41, 1, 200, 'Cleaning', 'Cleaning', '2023-01-27 13:06:47', '2023-01-27 13:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `package_visits`
--

CREATE TABLE `package_visits` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL,
  `purchesd_package_id` int NOT NULL,
  `date` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `service_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_visits`
--

INSERT INTO `package_visits` (`id`, `user_id`, `purchesd_package_id`, `date`, `time`, `service_name`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, '2023-01-31', '06:00 PM', 'Cleaning', '2023-01-31 14:29:10', '2023-01-31 14:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@mail.com', '$2y$10$QRC.hxqavcqSCnDgwONWM.u7oHSuXfDzXFPJE1vdlIvWzQph6V502', '2022-11-25 11:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `group_name`, `created_at`, `updated_at`) VALUES
(1, 'dashboard.view', 'admin', 'dashboard', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(2, 'order.view', 'admin', 'order', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(3, 'order.details', 'admin', 'order', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(4, 'order.download', 'admin', 'order', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(5, 'order.statusUpdate', 'admin', 'order', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(6, 'customer.view', 'admin', 'customer', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(7, 'customer.create', 'admin', 'customer', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(8, 'customer.update', 'admin', 'customer', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(9, 'customer.delete', 'admin', 'customer', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(10, 'coupon.view', 'admin', 'coupon', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(11, 'coupon.create', 'admin', 'coupon', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(12, 'coupon.update', 'admin', 'coupon', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(13, 'coupon.delete', 'admin', 'coupon', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(14, 'campaign.view', 'admin', 'campaign', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(15, 'campaign.create', 'admin', 'campaign', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(16, 'campaign.update', 'admin', 'campaign', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(17, 'campaign.delete', 'admin', 'campaign', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(18, 'product.view', 'admin', 'product', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(19, 'product.create', 'admin', 'product', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(20, 'product.update', 'admin', 'product', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(21, 'product.delete', 'admin', 'product', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(22, 'variant.view', 'admin', 'variant', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(23, 'variant.create', 'admin', 'variant', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(24, 'variant.update', 'admin', 'variant', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(25, 'variant.delete', 'admin', 'variant', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(26, 'category.view', 'admin', 'category', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(27, 'category.create', 'admin', 'category', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(28, 'category.update', 'admin', 'category', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(29, 'category.delete', 'admin', 'category', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(30, 'brand.view', 'admin', 'brand', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(31, 'brand.create', 'admin', 'brand', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(32, 'brand.update', 'admin', 'brand', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(33, 'brand.delete', 'admin', 'brand', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(34, 'review.view', 'admin', 'review', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(35, 'review.update', 'admin', 'review', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(36, 'review.delete', 'admin', 'review', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(37, 'slider.view', 'admin', 'slider', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(38, 'slider.create', 'admin', 'slider', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(39, 'slider.update', 'admin', 'slider', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(40, 'slider.delete', 'admin', 'slider', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(41, 'postCategory.view', 'admin', 'blog', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(42, 'postCategory.create', 'admin', 'blog', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(43, 'postCategory.update', 'admin', 'blog', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(44, 'postCategory.delete', 'admin', 'blog', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(45, 'post.view', 'admin', 'blog', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(46, 'post.create', 'admin', 'blog', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(47, 'post.update', 'admin', 'blog', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(48, 'post.delete', 'admin', 'blog', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(49, 'country.view', 'admin', 'location', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(50, 'country.create', 'admin', 'location', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(51, 'country.update', 'admin', 'location', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(52, 'country.delete', 'admin', 'location', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(53, 'state.view', 'admin', 'location', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(54, 'state.create', 'admin', 'location', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(55, 'state.update', 'admin', 'location', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(56, 'state.delete', 'admin', 'location', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(57, 'city.view', 'admin', 'location', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(58, 'city.create', 'admin', 'location', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(59, 'city.update', 'admin', 'location', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(60, 'city.delete', 'admin', 'location', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(61, 'faq.view', 'admin', 'faq', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(62, 'faq.create', 'admin', 'faq', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(63, 'faq.update', 'admin', 'faq', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(64, 'faq.delete', 'admin', 'faq', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(65, 'faqCategory.create', 'admin', 'faq', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(66, 'faqCategory.view', 'admin', 'faq', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(67, 'faqCategory.update', 'admin', 'faq', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(68, 'faqCategory.delete', 'admin', 'faq', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(69, 'newsletter.view', 'admin', 'newsletter', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(70, 'newsletter.sendmail', 'admin', 'newsletter', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(71, 'newsletter.delete', 'admin', 'newsletter', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(72, 'admin.view', 'admin', 'admin', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(73, 'admin.create', 'admin', 'admin', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(74, 'admin.update', 'admin', 'admin', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(75, 'admin.delete', 'admin', 'admin', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(76, 'role.view', 'admin', 'role', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(77, 'role.create', 'admin', 'role', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(78, 'role.update', 'admin', 'role', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(79, 'role.delete', 'admin', 'role', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(80, 'setting.view', 'admin', 'settings', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(81, 'setting.update', 'admin', 'settings', '2022-10-05 05:33:06', '2022-10-05 05:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(5, 'App\\Models\\User', 5, 'MyAuthApp', '2ab028be7e6ca877ecdf5243c705dd1448229bbb8210fc3608fc7e72b3275e30', '[\"*\"]', NULL, '2022-10-13 04:21:28', '2022-10-13 04:21:28'),
(6, 'App\\Models\\User', 5, 'MyAuthApp', 'f079933f6651e2606a422593e0c0887d42653cd95c4ab51c19983a0993549e03', '[\"*\"]', NULL, '2022-10-13 04:32:17', '2022-10-13 04:32:17'),
(7, 'App\\Models\\User', 5, 'MyAuthApp', '6f9fc769f0db6bc23b3d17c250253a8bc086414b0331f1831ce4ee7ac85e76fa', '[\"*\"]', NULL, '2022-10-13 04:34:09', '2022-10-13 04:34:09'),
(16, 'App\\Models\\User', 6, 'MyAuthApp', 'cd1e319907b1bb7a05833e3368ca55d9e8f64184d4ced3b291fc144f30be0df4', '[\"*\"]', NULL, '2022-10-13 06:11:01', '2022-10-13 06:11:01'),
(17, 'App\\Models\\User', 7, 'MyAuthApp', '831e16859695a19d9a7593fe02d51e371f421e6267257f61be22064c37026cff', '[\"*\"]', NULL, '2022-10-13 06:11:25', '2022-10-13 06:11:25'),
(18, 'App\\Models\\User', 8, 'MyAuthApp', 'e510fdb5196733c282ef77e5af5a4057e7a829d35a9294278700a130998bcf17', '[\"*\"]', NULL, '2022-10-13 06:11:49', '2022-10-13 06:11:49'),
(19, 'App\\Models\\User', 9, 'MyAuthApp', 'e8d9ab7b7d2ebee98e14ec9128f655515a07e0a15cef058f4e59290b4f9d1358', '[\"*\"]', NULL, '2022-10-13 06:13:16', '2022-10-13 06:13:16'),
(28, 'App\\Models\\User', 10, 'MyAuthApp', '785e8f0e07aaa3c2864c911711cae6eb51e7390e026bbbf4ec7becb9599c9687', '[\"*\"]', NULL, '2022-10-31 14:50:08', '2022-10-31 14:50:08'),
(29, 'App\\Models\\User', 10, 'MyAuthApp', 'b75dd55d5d518336d536db8cc14dabafb21ba0b5e14217c0fc00d34343fadcbb', '[\"*\"]', NULL, '2022-10-31 15:10:48', '2022-10-31 15:10:48'),
(30, 'App\\Models\\User', 10, 'MyAuthApp', '8379131b20765e3e62b4652e7265dbd0082c9d31818aad538d4d546363ef86cb', '[\"*\"]', NULL, '2022-10-31 15:13:15', '2022-10-31 15:13:15'),
(38, 'App\\Models\\User', 11, 'MyAuthApp', '377aa3d4d56e3c76ba64a610c7eb171b0d389177d7a44baa1a8401b44c543365', '[\"*\"]', NULL, '2022-11-01 09:53:08', '2022-11-01 09:53:08'),
(40, 'App\\Models\\User', 12, 'MyAuthApp', 'a2cecfbc98939be54165ccb88d4120d7952e3c72ce305f7fd161296ac2d76fce', '[\"*\"]', NULL, '2022-11-01 10:59:04', '2022-11-01 10:59:04'),
(41, 'App\\Models\\User', 13, 'MyAuthApp', '3308bb4b845dd158319ae52e6484fb11405ea2ed3d15bbcd9746c12083e6ab92', '[\"*\"]', NULL, '2022-11-01 12:41:55', '2022-11-01 12:41:55'),
(42, 'App\\Models\\User', 14, 'MyAuthApp', '05b55684e89e6e1c220b724231aa16ba93666d3b15ad1b12b6d9d86350a26ae3', '[\"*\"]', NULL, '2022-11-01 12:49:44', '2022-11-01 12:49:44'),
(43, 'App\\Models\\User', 15, 'MyAuthApp', '4edc7b2451c0574eb11a6eb7caea9adb650a653671373ca6760e0b6e3915b357', '[\"*\"]', NULL, '2022-11-01 13:27:17', '2022-11-01 13:27:17'),
(44, 'App\\Models\\User', 16, 'MyAuthApp', '25c7981c53e984431163e9bcc86598ef239d929913bfac0a1d090a6069773755', '[\"*\"]', NULL, '2022-11-01 13:28:16', '2022-11-01 13:28:16'),
(45, 'App\\Models\\User', 17, 'MyAuthApp', 'e3405996b683c0682c36b1076ffbd9653b77cda1e0c4e3ba3b71ab44b3286f4e', '[\"*\"]', NULL, '2022-11-01 13:52:29', '2022-11-01 13:52:29'),
(46, 'App\\Models\\User', 18, 'MyAuthApp', 'c1b3e6c76aa6e5398ffa7e66043916eb8e56b514244e264c5c79bbea95137309', '[\"*\"]', NULL, '2022-11-01 14:00:00', '2022-11-01 14:00:00'),
(47, 'App\\Models\\User', 19, 'MyAuthApp', '1a117e67d4c22423829180d70999205382654f7eaaae12a94a47fd89f9a9ea19', '[\"*\"]', NULL, '2022-11-01 14:00:44', '2022-11-01 14:00:44'),
(48, 'App\\Models\\User', 19, 'MyAuthApp', '6424bfc6e33327c00ba7bba30742918b0b3f401dced10231f209656d46867ae0', '[\"*\"]', NULL, '2022-11-01 14:01:26', '2022-11-01 14:01:26'),
(49, 'App\\Models\\User', 20, 'MyAuthApp', '323d0235eaa8b4d912fd822d77609be2c6512ea17bef497ad1ca099544233be5', '[\"*\"]', NULL, '2022-11-01 14:07:10', '2022-11-01 14:07:10'),
(50, 'App\\Models\\User', 19, 'MyAuthApp', '4f9955fa44f21b3ef17facabfd3bef3d7a9e3e057453cb37c4186afa349f17fb', '[\"*\"]', NULL, '2022-11-01 15:00:45', '2022-11-01 15:00:45'),
(51, 'App\\Models\\User', 21, 'MyAuthApp', '703754a26c3b9a379ab7d4ab9aed3b590a862eda4c72ef2fea5c4481cfc91e81', '[\"*\"]', NULL, '2022-11-01 15:01:05', '2022-11-01 15:01:05'),
(52, 'App\\Models\\User', 22, 'MyAuthApp', 'd5552179c381ba3714c7e1482d85b4e99d888cc119a759fd2d1c9fe4de8f2bb3', '[\"*\"]', NULL, '2022-11-01 15:01:27', '2022-11-01 15:01:27'),
(53, 'App\\Models\\User', 23, 'MyAuthApp', 'd7f2de515456b281fb70a4240ce827ab3329ffc64efb58439275a3ac3851c95f', '[\"*\"]', NULL, '2022-11-01 15:14:33', '2022-11-01 15:14:33'),
(54, 'App\\Models\\User', 24, 'MyAuthApp', '7e4beb81323b0253cc594c20243769c977c11bdf0608ba38b5b8ba751c7363cc', '[\"*\"]', NULL, '2022-11-01 15:17:32', '2022-11-01 15:17:32'),
(55, 'App\\Models\\User', 25, 'MyAuthApp', '67f46c75a3b57329b3e8b05273730d94b6e23f367810400c127a8cbfcad002d2', '[\"*\"]', NULL, '2022-11-01 15:25:24', '2022-11-01 15:25:24'),
(56, 'App\\Models\\User', 26, 'MyAuthApp', 'ecd506333052f1fafe1ae358dd90e1c968d9b61756a327019e4c3a651c8e90d6', '[\"*\"]', NULL, '2022-11-01 15:27:35', '2022-11-01 15:27:35'),
(57, 'App\\Models\\User', 27, 'MyAuthApp', 'dc3ef0a56e5c0abe12bf1d70ad8e53b18bdf4b2c0573f3beed2292389fb9dc22', '[\"*\"]', NULL, '2022-11-01 15:31:16', '2022-11-01 15:31:16'),
(58, 'App\\Models\\User', 27, 'MyAuthApp', 'f785fd7b50ae13d18c02311c331153c828f7d64d624104a64ff6d9ae5ef567fc', '[\"*\"]', NULL, '2022-11-01 15:31:53', '2022-11-01 15:31:53'),
(59, 'App\\Models\\User', 28, 'MyAuthApp', '63f7f0fa3166bdf0b68d0451141618dce9967df7b789b269b45eb74958912c1f', '[\"*\"]', NULL, '2022-11-01 15:40:24', '2022-11-01 15:40:24'),
(60, 'App\\Models\\User', 28, 'MyAuthApp', '11dfe212d691cb3d9051a262b3de0a1d6acb253eea776985864a14f36367a53b', '[\"*\"]', NULL, '2022-11-01 15:40:46', '2022-11-01 15:40:46'),
(61, 'App\\Models\\User', 28, 'MyAuthApp', '209781da6e12cc24e4234aa6f33def08e57bb8c72283c79686a7aab6c7608d3b', '[\"*\"]', NULL, '2022-11-01 15:51:25', '2022-11-01 15:51:25'),
(62, 'App\\Models\\User', 29, 'MyAuthApp', '80e497c4c638b50748b1bfa882cf165a81004560278f033568231de9d0b6b9ba', '[\"*\"]', NULL, '2022-11-01 16:07:20', '2022-11-01 16:07:20'),
(63, 'App\\Models\\User', 29, 'MyAuthApp', '46f67f8eade47d4b80bba6933dd32d8deb0b62419fe9b9f774169162addbac46', '[\"*\"]', NULL, '2022-11-01 16:07:53', '2022-11-01 16:07:53'),
(64, 'App\\Models\\User', 29, 'MyAuthApp', '837be92ae165285925823b5ac0e0cc60204f8798f7252663a6ba1e7ef2b1b5a6', '[\"*\"]', NULL, '2022-11-01 16:08:24', '2022-11-01 16:08:24'),
(65, 'App\\Models\\User', 29, 'MyAuthApp', 'b4f90b07cbf4e73afd9c41e38d22bec23c53f32bdde46ab2b247ca93c7d1d24b', '[\"*\"]', NULL, '2022-11-01 16:44:18', '2022-11-01 16:44:18'),
(66, 'App\\Models\\User', 30, 'MyAuthApp', '56d23462e1a496616bb3761e1a3ced5e9f3556c738b5f25e57238c603ef65461', '[\"*\"]', NULL, '2022-11-01 17:38:48', '2022-11-01 17:38:48'),
(67, 'App\\Models\\User', 30, 'MyAuthApp', '9f7ff5ab3cb583bde94fb15b677ee2833ff64c85c59cf6eb0802e579073fb06e', '[\"*\"]', NULL, '2022-11-01 17:39:33', '2022-11-01 17:39:33'),
(68, 'App\\Models\\User', 30, 'MyAuthApp', '70d56f1b744a85b43857682ec184c1521b54e51342920fd6b397997d52bb6d08', '[\"*\"]', NULL, '2022-11-01 17:39:39', '2022-11-01 17:39:39'),
(69, 'App\\Models\\User', 30, 'MyAuthApp', 'dc53f3fe8c3ac68c3bfb424c9fc17f31272dff77f2992fc2447e60fbee149a41', '[\"*\"]', NULL, '2022-11-01 18:01:00', '2022-11-01 18:01:00'),
(70, 'App\\Models\\User', 30, 'MyAuthApp', 'f60f6fc01f7aeb3f2fdb7bb374451d1468c5f61088cb346ab86628a319138f2c', '[\"*\"]', NULL, '2022-11-01 18:03:59', '2022-11-01 18:03:59'),
(71, 'App\\Models\\User', 30, 'MyAuthApp', '00069314e44fc5dd3e28845c5a05ebdc59aefebb5913b9ed26479ba9aa729efb', '[\"*\"]', NULL, '2022-11-01 18:04:17', '2022-11-01 18:04:17'),
(72, 'App\\Models\\User', 31, 'MyAuthApp', '4a641f67c9fcf98a8776b111e5d7acbe2259d13337c2edc4f5592ee6dc747656', '[\"*\"]', NULL, '2022-11-02 08:41:06', '2022-11-02 08:41:06'),
(73, 'App\\Models\\User', 32, 'MyAuthApp', '3a5f7ce6df1208c0409645c5e622cc9b817b41b1287b70952ad829ef3d1ab74b', '[\"*\"]', NULL, '2022-11-02 08:56:55', '2022-11-02 08:56:55'),
(74, 'App\\Models\\User', 32, 'MyAuthApp', '4a54cb051de6cd120007de5fa870b711faadbc017d99f2554ca71a4616b90399', '[\"*\"]', NULL, '2022-11-02 08:59:39', '2022-11-02 08:59:39'),
(75, 'App\\Models\\User', 32, 'MyAuthApp', '4a10d4fc3840549c2fa9862e301f2232ffda78e7e5cfb4b180e2314182d22b2e', '[\"*\"]', NULL, '2022-11-02 08:59:49', '2022-11-02 08:59:49'),
(76, 'App\\Models\\User', 33, 'MyAuthApp', '2973ab177c3163455869504bc331435fa035d792992bf3d5923df41a435c6384', '[\"*\"]', NULL, '2022-11-02 09:16:04', '2022-11-02 09:16:04'),
(77, 'App\\Models\\User', 32, 'MyAuthApp', '345acf8470d060e6b660f30e40328410b954a7267dac93827a4986f6be400e65', '[\"*\"]', NULL, '2022-11-02 10:58:58', '2022-11-02 10:58:58'),
(78, 'App\\Models\\User', 34, 'MyAuthApp', '72fb9be8eafaafa3ff59c256dc7a5eb832df0f214ae378415af8efbedd57500a', '[\"*\"]', NULL, '2022-11-02 14:06:56', '2022-11-02 14:06:56'),
(79, 'App\\Models\\User', 34, 'MyAuthApp', 'd8e9d717bd949a8e946d7a313b538d6bd3f9da3780d3e13fc4f529420ec770ea', '[\"*\"]', NULL, '2022-11-02 14:09:20', '2022-11-02 14:09:20'),
(80, 'App\\Models\\User', 34, 'MyAuthApp', '3af8b4cfcdd593d442029dca7fc2ed0ede2c28a2ac8a8db0d162b9f48f085c2a', '[\"*\"]', '2022-11-02 14:20:47', '2022-11-02 14:09:32', '2022-11-02 14:20:47'),
(81, 'App\\Models\\User', 35, 'MyAuthApp', '017ea0b755fd04756892042dbcaf272633d6f7851f13c0bec5139df92ee4cc69', '[\"*\"]', NULL, '2022-11-02 16:47:17', '2022-11-02 16:47:17'),
(82, 'App\\Models\\User', 35, 'MyAuthApp', '46329965cb2a27aa6b44572a93e0d3bf8cbaadc2dda366296cab4b6792314c93', '[\"*\"]', NULL, '2022-11-02 16:47:56', '2022-11-02 16:47:56'),
(83, 'App\\Models\\User', 35, 'MyAuthApp', '2ea360befe6a762377d9274481f31474e9f25471fd0b51026fa45e33588e1014', '[\"*\"]', '2022-11-02 17:17:05', '2022-11-02 16:48:12', '2022-11-02 17:17:05'),
(84, 'App\\Models\\User', 35, 'MyAuthApp', 'bd03ba42f8f4834d451f5e2fe260c068bf56997c3fc394c1c4cfdde4891ae4ea', '[\"*\"]', NULL, '2022-11-02 16:48:28', '2022-11-02 16:48:28'),
(85, 'App\\Models\\User', 35, 'MyAuthApp', 'cdc5c80fd5a5d7d041dac3d5c5dfd1b0790b92898bc37512afd44a5242e67942', '[\"*\"]', NULL, '2022-11-02 16:49:46', '2022-11-02 16:49:46'),
(86, 'App\\Models\\User', 35, 'MyAuthApp', '237eb21e4c436828aea3b8f7fd1ef91d628ffa065e3a60409c2d1459715835b4', '[\"*\"]', NULL, '2022-11-02 16:50:16', '2022-11-02 16:50:16'),
(87, 'App\\Models\\User', 35, 'MyAuthApp', '3b04d598627d2c7ecf79047cf9708bb313833c3cbf808126515299171803c577', '[\"*\"]', NULL, '2022-11-02 17:12:15', '2022-11-02 17:12:15'),
(88, 'App\\Models\\User', 35, 'MyAuthApp', 'e16f4add320b656e56f9cff336e01d48d3824ce885af002471159df430fb2f6c', '[\"*\"]', NULL, '2022-11-03 09:01:16', '2022-11-03 09:01:16'),
(89, 'App\\Models\\User', 35, 'MyAuthApp', 'bcefb278ae05bf4ec355e946131ebff6c03d90ba5ba80647f80ac01382632115', '[\"*\"]', NULL, '2022-11-03 09:02:02', '2022-11-03 09:02:02'),
(90, 'App\\Models\\User', 36, 'MyAuthApp', '90fa2b894025a203ad3ce6492442fd00171804442289fac6b29ce2a650e7fd91', '[\"*\"]', NULL, '2022-11-03 09:03:18', '2022-11-03 09:03:18'),
(91, 'App\\Models\\User', 36, 'MyAuthApp', '81e03832c7b40fe0470dcbe818e7826af6b45e0cf3fac76ad8f1eca0f7134052', '[\"*\"]', NULL, '2022-11-03 09:03:47', '2022-11-03 09:03:47'),
(92, 'App\\Models\\User', 36, 'MyAuthApp', '2fb61b7b0341003f015cc1e09354b1e8b508c2ed38d5df210956bd4093c29b7e', '[\"*\"]', '2022-11-03 09:05:33', '2022-11-03 09:04:41', '2022-11-03 09:05:33'),
(93, 'App\\Models\\User', 36, 'MyAuthApp', '983c9e54c61514894d744103d2d90776745cbfa3a10dd375182e1efc35c40eab', '[\"*\"]', NULL, '2022-11-03 09:17:29', '2022-11-03 09:17:29'),
(94, 'App\\Models\\User', 36, 'MyAuthApp', '609ff2a7a128e54221f67c19ffb21679eee46f3896246ea1a59265aecd72bdd6', '[\"*\"]', NULL, '2022-11-03 09:17:32', '2022-11-03 09:17:32'),
(95, 'App\\Models\\User', 36, 'MyAuthApp', '243b597a9681bde8d89f44129055bbc71b2d0fd39fee36000c902a71fc6f0457', '[\"*\"]', NULL, '2022-11-03 09:17:32', '2022-11-03 09:17:32'),
(96, 'App\\Models\\User', 36, 'MyAuthApp', 'a6e53369f568ccde923081801a48d8d0670f214f6585f5b46dbed484acc0204a', '[\"*\"]', NULL, '2022-11-03 09:52:14', '2022-11-03 09:52:14'),
(97, 'App\\Models\\User', 36, 'MyAuthApp', '74ae587b0a83546a07ef456557bba3132e0c933c9777acb43e93b81f51b70c57', '[\"*\"]', NULL, '2022-11-03 09:52:14', '2022-11-03 09:52:14'),
(98, 'App\\Models\\User', 36, 'MyAuthApp', '73d4d23833520158b3881e71133d079545d6c440cecd6d343d28cda9403e57a2', '[\"*\"]', NULL, '2022-11-03 09:58:42', '2022-11-03 09:58:42'),
(99, 'App\\Models\\User', 36, 'MyAuthApp', 'c61174eec0f25323b746043aef3ae938a95c69f13be36b2576a2a6effe5532c6', '[\"*\"]', NULL, '2022-11-03 10:12:18', '2022-11-03 10:12:18'),
(100, 'App\\Models\\User', 36, 'MyAuthApp', '506095acb1b4de2244fc1a6aadf8672030bec8bbe8fda9a1bb0fe9f8233b36f8', '[\"*\"]', NULL, '2022-11-03 10:43:02', '2022-11-03 10:43:02'),
(101, 'App\\Models\\User', 36, 'MyAuthApp', '2a548f7a8d0800353ac67b982c5c7fea8e3cbe61823825babff8fb8c42a78143', '[\"*\"]', NULL, '2022-11-03 11:05:09', '2022-11-03 11:05:09'),
(102, 'App\\Models\\User', 36, 'MyAuthApp', '4c12a85aecae62bafa7c9d1cf0d0d1ce952cb20d81a69ee55a97371039d79785', '[\"*\"]', NULL, '2022-11-03 11:05:09', '2022-11-03 11:05:09'),
(103, 'App\\Models\\User', 37, 'MyAuthApp', '3bbb62e9286f294ca8d7b0e6bb429436e4814f878eb45640a40a5f3b13ce9401', '[\"*\"]', NULL, '2022-11-03 11:05:28', '2022-11-03 11:05:28'),
(104, 'App\\Models\\User', 37, 'MyAuthApp', '6ddd6b6541c6211000ee828ca7fe972717b84b59a455573801dae0faa62581ed', '[\"*\"]', NULL, '2022-11-03 11:06:35', '2022-11-03 11:06:35'),
(105, 'App\\Models\\User', 37, 'MyAuthApp', '95b31c0dbacb5a886925e816b49cc9d41cb3b92130d339f41822961b8a5351fa', '[\"*\"]', '2022-11-03 11:40:01', '2022-11-03 11:06:41', '2022-11-03 11:40:01'),
(106, 'App\\Models\\User', 37, 'MyAuthApp', '95107de2f84dfd685c919c2add5a4996dcb2c6a453d4c56758f8030cdf8c5d69', '[\"*\"]', NULL, '2022-11-03 11:08:39', '2022-11-03 11:08:39'),
(107, 'App\\Models\\User', 37, 'MyAuthApp', 'b1cb04681e9981098a5ac036a673b2a4c70f90cdc10253432404b3cdfed9eacc', '[\"*\"]', NULL, '2022-11-03 11:19:39', '2022-11-03 11:19:39'),
(108, 'App\\Models\\User', 37, 'MyAuthApp', 'f9106e8384f2b580c7585e3af9333474903ca799502028f5107ae977bb8ee66e', '[\"*\"]', NULL, '2022-11-03 11:30:01', '2022-11-03 11:30:01'),
(109, 'App\\Models\\User', 37, 'MyAuthApp', '32098f1b16c75044c95f3ee7e56bc3e0d220a23ec6c892fcb9bfa3db9481a05c', '[\"*\"]', '2022-11-07 18:22:54', '2022-11-03 11:34:34', '2022-11-07 18:22:54'),
(110, 'App\\Models\\User', 38, 'MyAuthApp', '0f6539a2d8bd45ed32f7021f15b9508b6b433e9cd15cff61d17d11c7e5b41ad1', '[\"*\"]', NULL, '2022-11-08 09:58:22', '2022-11-08 09:58:22'),
(111, 'App\\Models\\User', 39, 'MyAuthApp', '2a193b9ecfc8222c927fd7b256bbc18df8efd91fb1d1f8700fe19012f40a0f8d', '[\"*\"]', NULL, '2022-11-08 10:02:47', '2022-11-08 10:02:47'),
(112, 'App\\Models\\User', 39, 'MyAuthApp', 'f9fac772fdbfd379de4064f943c5743bd072f50252e250caabdc5b24c119c7f2', '[\"*\"]', NULL, '2022-11-08 10:03:35', '2022-11-08 10:03:35'),
(113, 'App\\Models\\User', 39, 'MyAuthApp', 'aa612ab0f023b6a5f021ff51b4558672a24d9b98f9bb94e8f200caa2c7a9e9ee', '[\"*\"]', NULL, '2022-11-08 10:03:44', '2022-11-08 10:03:44'),
(114, 'App\\Models\\User', 39, 'MyAuthApp', 'e2ca81461ea775e7ced65622c433459a8c9665f65baf28e14f8773df5a2e4e49', '[\"*\"]', '2022-11-08 10:06:27', '2022-11-08 10:05:33', '2022-11-08 10:06:27'),
(115, 'App\\Models\\User', 39, 'MyAuthApp', '355dfbb4271221e3c960355a09bd8841ab7bab99304503cc274ed0a996895952', '[\"*\"]', '2022-11-11 17:26:09', '2022-11-08 10:09:49', '2022-11-11 17:26:09'),
(116, 'App\\Models\\User', 40, 'MyAuthApp', '4400d67d68d80f3e00e89d6cbc8bb4f5dc8908cece58b2730d8816144cbd2240', '[\"*\"]', NULL, '2022-11-08 17:04:35', '2022-11-08 17:04:35'),
(117, 'App\\Models\\User', 40, 'MyAuthApp', '137c5d0519260e21369c6ee4255347b7de2442373bdd5fdbdb7a510edbbb47ad', '[\"*\"]', NULL, '2022-11-08 17:05:32', '2022-11-08 17:05:32'),
(118, 'App\\Models\\User', 40, 'MyAuthApp', '30bd10e28c8c5ca1b4bf6c6a124788f54eb9434e733a9a06852f4203a695dd7b', '[\"*\"]', NULL, '2022-11-08 17:05:38', '2022-11-08 17:05:38'),
(119, 'App\\Models\\User', 41, 'MyAuthApp', '23a2fbc6d61bb3d3b3956b5fc92598534a84c23f00754739e8c720a095d16f1b', '[\"*\"]', NULL, '2022-11-09 14:24:06', '2022-11-09 14:24:06'),
(120, 'App\\Models\\User', 42, 'MyAuthApp', '5b888b5cf0b823173f5bc7dd26fa1406fe644b44fc7816e574f110c2f31f4a91', '[\"*\"]', NULL, '2022-11-09 14:24:17', '2022-11-09 14:24:17'),
(121, 'App\\Models\\User', 42, 'MyAuthApp', '47bd74ac315f1961b27528d7e073da2dbd7f65dc00f5e98a568527bf55687221', '[\"*\"]', NULL, '2022-11-09 14:24:51', '2022-11-09 14:24:51'),
(122, 'App\\Models\\User', 42, 'MyAuthApp', 'a64ce3e9fcee1be78613c13e96f414de649906e53b48bcdc73e8f3034429cd21', '[\"*\"]', '2022-11-15 15:44:27', '2022-11-09 14:25:15', '2022-11-15 15:44:27'),
(123, 'App\\Models\\User', 43, 'MyAuthApp', '862f50d440106cadb5b72fe3567fee55d39cbea5445fffc7aee2b54e1a65d2d9', '[\"*\"]', NULL, '2022-11-10 12:26:59', '2022-11-10 12:26:59'),
(124, 'App\\Models\\User', 42, 'MyAuthApp', 'a7ae2dffbcb8e54dc3890666308a2e20b54ec1a20d72f0c9b271ab2257875ddf', '[\"*\"]', NULL, '2022-11-10 12:28:38', '2022-11-10 12:28:38'),
(125, 'App\\Models\\User', 44, 'MyAuthApp', '9d4eebd522ece89b7cc6f03cfb39ca74a085f052dd7e2ddc3ef145967ac43861', '[\"*\"]', NULL, '2022-11-10 15:39:48', '2022-11-10 15:39:48'),
(126, 'App\\Models\\User', 44, 'MyAuthApp', '13ae62f9d8b96ecdca26a0e172119647a4dbc966791fb57f82dcc61f16546cf1', '[\"*\"]', NULL, '2022-11-10 15:40:29', '2022-11-10 15:40:29'),
(127, 'App\\Models\\User', 44, 'MyAuthApp', '4fc89c0ca3c935f11794abdb60f18b0bff4a0e4f56156852c10042b777b53eab', '[\"*\"]', '2022-11-11 11:06:57', '2022-11-11 11:05:31', '2022-11-11 11:06:57'),
(128, 'App\\Models\\User', 45, 'MyAuthApp', '4defcbd9284f928c9545461c35ae15600309c03ba18d131b8ad2d25a15da2104', '[\"*\"]', NULL, '2022-11-11 12:29:42', '2022-11-11 12:29:42'),
(129, 'App\\Models\\User', 42, 'MyAuthApp', 'fe87f27958176dda8aae58e03979ea98326b57cd3c46fcfc9879545f8194fa8f', '[\"*\"]', NULL, '2022-11-11 13:44:58', '2022-11-11 13:44:58'),
(130, 'App\\Models\\User', 42, 'MyAuthApp', '32e127d9d25acbe70e3954f22693dd4dd8c57fe5e1c2df960676bc4998c0c144', '[\"*\"]', NULL, '2022-11-11 13:45:14', '2022-11-11 13:45:14'),
(131, 'App\\Models\\User', 42, 'MyAuthApp', '6135ad4ee6a69384c13dd228280297badc1e78bf78ecaec45d462c75f9ab3220', '[\"*\"]', NULL, '2022-11-11 13:45:24', '2022-11-11 13:45:24'),
(132, 'App\\Models\\User', 42, 'MyAuthApp', '2e62a32813182b3b71214c0ad7004723a276d1de4f2c10459c0194844046d022', '[\"*\"]', '2022-11-11 13:48:15', '2022-11-11 13:48:14', '2022-11-11 13:48:15'),
(133, 'App\\Models\\User', 42, 'MyAuthApp', '7adb51def1eb991c361efead365c63fdd5e74d6068723bd31336cc801d1c206a', '[\"*\"]', '2022-11-11 13:48:48', '2022-11-11 13:48:46', '2022-11-11 13:48:48'),
(134, 'App\\Models\\User', 42, 'MyAuthApp', '2a98b2f61312e6c90f9f326ca36a583de1b44c1862746daeca57743b586bb59c', '[\"*\"]', '2022-11-11 13:52:55', '2022-11-11 13:52:53', '2022-11-11 13:52:55'),
(135, 'App\\Models\\User', 42, 'MyAuthApp', 'b2465df53cc037214dc2fd9bf44cff6e56db180921c2edd6d986e59ec1d09039', '[\"*\"]', '2022-11-11 13:53:09', '2022-11-11 13:53:08', '2022-11-11 13:53:09'),
(136, 'App\\Models\\User', 42, 'MyAuthApp', 'c6fa4d24629ba03ea4b44b9999d7dc525445da43dbd8b174f7d37ea62685ffce', '[\"*\"]', '2022-11-11 13:53:51', '2022-11-11 13:53:50', '2022-11-11 13:53:51'),
(137, 'App\\Models\\User', 42, 'MyAuthApp', '84a03e6b4733792f8c1dee1f7a94970d4a8f39ebe5c245e072ef50649742d717', '[\"*\"]', '2022-11-11 13:59:00', '2022-11-11 13:56:35', '2022-11-11 13:59:00'),
(138, 'App\\Models\\User', 42, 'MyAuthApp', '484b5d08f6e7dd432958111be3bee9b22580705035456bf045f986bab2f4286a', '[\"*\"]', '2022-11-11 14:13:42', '2022-11-11 14:13:41', '2022-11-11 14:13:42'),
(139, 'App\\Models\\User', 42, 'MyAuthApp', 'a42feddd9d66e163a5a67fdbec21acdd865abcb6786ec9ddc2df0cf73863e06b', '[\"*\"]', '2022-11-11 14:33:10', '2022-11-11 14:33:08', '2022-11-11 14:33:10'),
(140, 'App\\Models\\User', 42, 'MyAuthApp', '6951ce0542014ed2ff668387440a522927c1bd4ddacb4cc8ffc090fd030a8de4', '[\"*\"]', '2022-11-11 18:01:13', '2022-11-11 14:34:16', '2022-11-11 18:01:13'),
(141, 'App\\Models\\User', 46, 'MyAuthApp', 'e426de1cf2887ff52baaeb636d96266f48b54d94ded9b806728f93bc3d778ab8', '[\"*\"]', NULL, '2022-11-11 17:37:50', '2022-11-11 17:37:50'),
(142, 'App\\Models\\User', 47, 'MyAuthApp', '023d88077114171bbaf60105da0171f590f782677fa0996aca8ee6ffe909105f', '[\"*\"]', NULL, '2022-11-11 17:39:48', '2022-11-11 17:39:48'),
(143, 'App\\Models\\User', 42, 'MyAuthApp', '68dae1ba94fe2eee6fd54a8b361716e45b21f9989a783eb2c9bec25d079e8e89', '[\"*\"]', '2022-11-14 10:13:46', '2022-11-11 17:58:44', '2022-11-14 10:13:46'),
(144, 'App\\Models\\User', 42, 'MyAuthApp', '1ae5c356fdc39f4068c9bfc5f1e00c84d0479644d8cebe1434d88e5de8c2b545', '[\"*\"]', '2022-11-11 18:02:46', '2022-11-11 18:01:26', '2022-11-11 18:02:46'),
(145, 'App\\Models\\User', 48, 'MyAuthApp', 'f7371fd512a7f2b010155c9532813773c0796d1b026028bcf7f88ebfd243c6ad', '[\"*\"]', NULL, '2022-11-14 10:23:53', '2022-11-14 10:23:53'),
(146, 'App\\Models\\User', 48, 'MyAuthApp', '10df6a060708b3ce5153a03f72d76aaf7af249b2c21f6f921ce2f5a93bf3f262', '[\"*\"]', NULL, '2022-11-14 10:24:44', '2022-11-14 10:24:44'),
(147, 'App\\Models\\User', 48, 'MyAuthApp', '352d51eeeae807fba8a6852c17631479c87b9192aad99454470c7223b7abcc58', '[\"*\"]', NULL, '2022-11-14 10:25:07', '2022-11-14 10:25:07'),
(148, 'App\\Models\\User', 48, 'MyAuthApp', 'd07ba008e643f18c1d0efde52b4e5d4bbe1f0a07553a4e5081afcfd15c14dcf8', '[\"*\"]', '2022-11-14 10:28:20', '2022-11-14 10:28:16', '2022-11-14 10:28:20'),
(149, 'App\\Models\\User', 48, 'MyAuthApp', '5a8cb15aa7962439265a33a8e9e10ed953dcaccb19f4ad8a62adee4f348293c1', '[\"*\"]', '2022-11-14 10:42:30', '2022-11-14 10:42:12', '2022-11-14 10:42:30'),
(150, 'App\\Models\\User', 48, 'MyAuthApp', '117fcfe4d232484a337567ab4774d6fbb8a331765981d58be3093ac8bd0d6680', '[\"*\"]', '2022-11-14 10:43:02', '2022-11-14 10:43:00', '2022-11-14 10:43:02'),
(151, 'App\\Models\\User', 48, 'MyAuthApp', '18d2d4a1d1c73ea5323e9ea5cf5ee59bea2e1a2204552bea209b94c0e9341f32', '[\"*\"]', '2022-11-14 10:45:13', '2022-11-14 10:45:11', '2022-11-14 10:45:13'),
(152, 'App\\Models\\User', 48, 'MyAuthApp', '057e65234375f64c741128f574e16a4f5af61d614e49ea4df5c356c8e8df3e0a', '[\"*\"]', '2022-11-14 15:18:20', '2022-11-14 10:46:24', '2022-11-14 15:18:20'),
(153, 'App\\Models\\User', 49, 'MyAuthApp', 'fbe2bd97e650006ecef7c691e9c9ea9f600f12f566c9caf841514b7734a5039b', '[\"*\"]', NULL, '2022-11-14 10:56:43', '2022-11-14 10:56:43'),
(154, 'App\\Models\\User', 48, 'MyAuthApp', 'fb8bd4b1f4c71233b1b21da66fdeb31ed93c295962e8e3c97cc581d307f2b353', '[\"*\"]', '2022-11-14 15:28:47', '2022-11-14 15:22:15', '2022-11-14 15:28:47'),
(155, 'App\\Models\\User', 48, 'MyAuthApp', '1016042b1e0d56508820ab2c90249c94da99a093312aca1d4358be9dd5f9dded', '[\"*\"]', '2022-11-14 15:47:01', '2022-11-14 15:30:19', '2022-11-14 15:47:01'),
(156, 'App\\Models\\User', 50, 'MyAuthApp', '24a7b4a5893736e416e600cf987a6a892e488e5e0db293d3027759308e85184d', '[\"*\"]', NULL, '2022-11-14 15:58:46', '2022-11-14 15:58:46'),
(157, 'App\\Models\\User', 51, 'MyAuthApp', '8834188190abd2d0686cea0f678f727120db6c9272840404be3ed419890627a1', '[\"*\"]', NULL, '2022-11-14 16:06:21', '2022-11-14 16:06:21'),
(158, 'App\\Models\\User', 52, 'MyAuthApp', '327106c0a429c11b88d21adfa42e91d1b46a6357a3e165ac8cc6abdb038da7d0', '[\"*\"]', NULL, '2022-11-14 16:08:39', '2022-11-14 16:08:39'),
(159, 'App\\Models\\User', 52, 'MyAuthApp', 'b13dd07090a537a10f7e629d72d3406ccffb71c735d7494f31a585b1ead6e510', '[\"*\"]', NULL, '2022-11-14 16:11:20', '2022-11-14 16:11:20'),
(160, 'App\\Models\\User', 52, 'MyAuthApp', 'f643c8b511497cc98083a4166df2e0bd50ad162805a0430d976e5febc703f442', '[\"*\"]', '2022-11-15 11:30:21', '2022-11-14 16:12:00', '2022-11-15 11:30:21'),
(161, 'App\\Models\\User', 53, 'MyAuthApp', 'c0193a3eb0202d6b96aced6c8a7ce51a72cf10f85f67f9711a53264626bdb869', '[\"*\"]', NULL, '2022-11-14 16:14:02', '2022-11-14 16:14:02'),
(162, 'App\\Models\\User', 53, 'MyAuthApp', '9187499dee95e05f58f0c6aec313f8f175a759fd6c9d0cd83831c2df36126610', '[\"*\"]', NULL, '2022-11-14 16:14:19', '2022-11-14 16:14:19'),
(163, 'App\\Models\\User', 53, 'MyAuthApp', 'f4897f64d2798bd5186228f345ad6334700b4c067dbfc6eee65c7aeed86d12c8', '[\"*\"]', '2022-11-14 16:17:41', '2022-11-14 16:17:36', '2022-11-14 16:17:41'),
(164, 'App\\Models\\User', 53, 'MyAuthApp', '500ebfc1d30334eece0fcd834d7204a278a1ee76a3bae70c2fc61a980ef1eab3', '[\"*\"]', '2022-11-14 16:49:29', '2022-11-14 16:18:34', '2022-11-14 16:49:29'),
(165, 'App\\Models\\User', 54, 'MyAuthApp', '26f768a17d6f470fccc6bc690db478c3a86149f2279afd525caeefdc63b5785d', '[\"*\"]', NULL, '2022-11-14 16:31:19', '2022-11-14 16:31:19'),
(166, 'App\\Models\\User', 54, 'MyAuthApp', '9882a70aeb4f39c82588de9d5793aa0e1c3586485e3edf12d08a64d68ccf5219', '[\"*\"]', NULL, '2022-11-14 16:31:30', '2022-11-14 16:31:30'),
(167, 'App\\Models\\User', 54, 'MyAuthApp', 'd4b96831066fbfd2e26ef19e5fb28146c88fac5bcfef39dd803ca6035b9a9bfc', '[\"*\"]', '2022-11-14 16:33:19', '2022-11-14 16:33:16', '2022-11-14 16:33:19'),
(168, 'App\\Models\\User', 55, 'MyAuthApp', 'bb09cf1a074d73904da0a03ae43e3c73ae2ad6ef7cdf19ff5a0c7576f69fcaa1', '[\"*\"]', NULL, '2022-11-14 16:35:51', '2022-11-14 16:35:51'),
(169, 'App\\Models\\User', 18, 'MyAuthApp', '2b53990d5a3991576227191de7cb455842978f7ad85711a7230a4e11b3caf504', '[\"*\"]', '2022-11-28 10:58:47', '2022-11-14 16:49:00', '2022-11-28 10:58:47'),
(170, 'App\\Models\\User', 56, 'MyAuthApp', 'b20287300af1cdb41a22c5d986dee662433fd9d2fbf33e54dfcfca3fa3163f85', '[\"*\"]', NULL, '2022-11-14 16:50:50', '2022-11-14 16:50:50'),
(171, 'App\\Models\\User', 57, 'MyAuthApp', '9de4a77958c2b4129535572f11ffa9164d3ac460dc15ad1dbc459c6f150ea118', '[\"*\"]', NULL, '2022-11-14 16:58:18', '2022-11-14 16:58:18'),
(172, 'App\\Models\\User', 58, 'MyAuthApp', 'f3c198a08fa97b046a555211e72c39c034e486bdf721de0e72be683c1df16853', '[\"*\"]', NULL, '2022-11-14 17:08:25', '2022-11-14 17:08:25'),
(173, 'App\\Models\\User', 59, 'MyAuthApp', '8436718489d0122fdf5faf4c1210d78fee7ca7d33fecb4a0c026619ec7cf837c', '[\"*\"]', NULL, '2022-11-14 17:41:54', '2022-11-14 17:41:54'),
(174, 'App\\Models\\User', 60, 'MyAuthApp', 'b018bc7efe2da28941995e0d612fe0989e6fbc21c4826f5e67cb5ab3184855fe', '[\"*\"]', NULL, '2022-11-14 17:45:42', '2022-11-14 17:45:42'),
(175, 'App\\Models\\User', 53, 'MyAuthApp', '37982faa94aad8550fefaa9a987a6bde5fb6a7bb38732361424241187016f1f6', '[\"*\"]', '2022-11-14 17:49:09', '2022-11-14 17:49:01', '2022-11-14 17:49:09'),
(176, 'App\\Models\\User', 61, 'MyAuthApp', 'c4d85ea6767bef05333f821e1fda9787fdee3e6528af29ccba7bb2407ca9b728', '[\"*\"]', NULL, '2022-11-14 17:51:15', '2022-11-14 17:51:15'),
(177, 'App\\Models\\User', 53, 'MyAuthApp', 'e15e53b4ae162af51d5e82a04ca40362f14f9b1c530145b5dff169e26ff6cf0c', '[\"*\"]', '2022-11-14 17:51:35', '2022-11-14 17:51:28', '2022-11-14 17:51:35'),
(178, 'App\\Models\\User', 62, 'MyAuthApp', '474e01ccdd00b77dd805884cf7bc3ae4917c7ca4c04f69d2a2f5b5db246d1396', '[\"*\"]', NULL, '2022-11-14 17:54:20', '2022-11-14 17:54:20'),
(179, 'App\\Models\\User', 63, 'MyAuthApp', '6b93c0011847eab33c0f451bae6ba2ac5eb67aeac7ee26f879e85e829f00e359', '[\"*\"]', NULL, '2022-11-14 17:54:58', '2022-11-14 17:54:58'),
(180, 'App\\Models\\User', 53, 'MyAuthApp', '3ea3055e7ed48df2ddf9baba717071055f251f4cd14631aba6827c5aaa27174a', '[\"*\"]', '2022-11-14 18:31:01', '2022-11-14 17:56:46', '2022-11-14 18:31:01'),
(181, 'App\\Models\\User', 64, 'MyAuthApp', '101c2cd059e8f86a9e0fa46df52a0cf06fd59b12a6c1a94dd138d927759e4965', '[\"*\"]', NULL, '2022-11-14 18:04:40', '2022-11-14 18:04:40'),
(182, 'App\\Models\\User', 65, 'MyAuthApp', '9e219e11c883b6677b431f901c9cab96808938a90569a8e96452fa7be37b9712', '[\"*\"]', NULL, '2022-11-14 18:06:38', '2022-11-14 18:06:38'),
(183, 'App\\Models\\User', 18, 'MyAuthApp', '5b2560613faa07c7fae062dba24df4e8b40dcd37ad48212fde1a5ae098f746ff', '[\"*\"]', NULL, '2022-11-14 18:10:04', '2022-11-14 18:10:04'),
(184, 'App\\Models\\User', 65, 'MyAuthApp', '0b641c5456cfccae739880fb5281ff22052467cc8baab134e817b8dc4d45fb96', '[\"*\"]', NULL, '2022-11-14 18:11:07', '2022-11-14 18:11:07'),
(185, 'App\\Models\\User', 65, 'MyAuthApp', '95dd04c68c683ffc82bc947061edd78a4c8f8c27dd809ab7fe68641272a34cec', '[\"*\"]', NULL, '2022-11-14 18:14:02', '2022-11-14 18:14:02'),
(186, 'App\\Models\\User', 53, 'MyAuthApp', '6af5f5f7206d7e54aeae54a1a2feb8007f06adcdd2f8740f12211d7bade4d9b1', '[\"*\"]', NULL, '2022-11-14 18:15:02', '2022-11-14 18:15:02'),
(187, 'App\\Models\\User', 66, 'MyAuthApp', '9fc47eb12881391e4b8764f3c4f98227d53e94d85a953c9b4748678c29082198', '[\"*\"]', NULL, '2022-11-14 18:23:01', '2022-11-14 18:23:01'),
(188, 'App\\Models\\User', 66, 'MyAuthApp', '1c4021b9c5bc06a282de86d5defac01c497762fe6e8b08082c058b7b62e795cd', '[\"*\"]', '2022-11-14 18:23:18', '2022-11-14 18:23:14', '2022-11-14 18:23:18'),
(189, 'App\\Models\\User', 67, 'MyAuthApp', '1497597df1f5da9d5ccd72a9b0af1a78ac08416862cdda38fa97417713379a90', '[\"*\"]', NULL, '2022-11-14 18:30:58', '2022-11-14 18:30:58'),
(190, 'App\\Models\\User', 18, 'MyAuthApp', '5f0b3deed3c9da9e44e8dfc2fa5586382ec19b36cb9b6c1cb7d658d3d3a7c1c8', '[\"*\"]', NULL, '2022-11-15 10:00:42', '2022-11-15 10:00:42'),
(191, 'App\\Models\\User', 68, 'MyAuthApp', 'd083ea887019c9bdccae762a4d30c937a231f7872b2e420f78469e58315d5b5c', '[\"*\"]', NULL, '2022-11-15 10:00:56', '2022-11-15 10:00:56'),
(192, 'App\\Models\\User', 68, 'MyAuthApp', 'a683eeece10160fa7989e0e855ef81eec989311ae7a093e62e6962c69e9f24e3', '[\"*\"]', NULL, '2022-11-15 10:01:17', '2022-11-15 10:01:17'),
(193, 'App\\Models\\User', 53, 'MyAuthApp', '0d85ca7984225f950a35e2ee62f84b805d43b419a8a306db1742c9aa939734ce', '[\"*\"]', NULL, '2022-11-15 10:06:23', '2022-11-15 10:06:23'),
(194, 'App\\Models\\User', 69, 'MyAuthApp', 'cf580ee83c15c6c0f04d4a5960e75b19663ae560e048aeccadc8067758d1c049', '[\"*\"]', NULL, '2022-11-15 10:17:23', '2022-11-15 10:17:23'),
(195, 'App\\Models\\User', 69, 'MyAuthApp', 'c64cc1e93f9716a645c9a5ad4d01ddb2f1e5782a4e0050a7fb16d83b0166c6f7', '[\"*\"]', '2022-11-15 10:17:38', '2022-11-15 10:17:33', '2022-11-15 10:17:38'),
(196, 'App\\Models\\User', 69, 'MyAuthApp', '892f1af459dcf678deef26fa4d6b8e018d0d0b4574d77870bdd324cb441382b3', '[\"*\"]', '2022-11-15 10:18:26', '2022-11-15 10:18:23', '2022-11-15 10:18:26'),
(197, 'App\\Models\\User', 69, 'MyAuthApp', '4a232dac4eb2c53c12957d2fcc8cff15a0bc80565a8cfd58349b54f4de041c71', '[\"*\"]', '2022-11-15 11:24:15', '2022-11-15 10:24:36', '2022-11-15 11:24:15'),
(198, 'App\\Models\\User', 70, 'MyAuthApp', 'a3c9e322bcfbe760ef80f9e9ffcb409e7a0dc459fd21d71ef7f813c9504990c1', '[\"*\"]', NULL, '2022-11-15 11:50:44', '2022-11-15 11:50:44'),
(199, 'App\\Models\\User', 69, 'MyAuthApp', 'e51a92b4cd510d11067ff02fb2edfc9e6895195a9758cc31e9367b2bf5f9932d', '[\"*\"]', '2022-11-15 12:11:08', '2022-11-15 11:59:46', '2022-11-15 12:11:08'),
(200, 'App\\Models\\User', 18, 'MyAuthApp', 'de1f391df6a93c1d23abccf81caac2e760d317617c9e52cc261e00ee08a31eb4', '[\"*\"]', NULL, '2022-11-15 12:01:05', '2022-11-15 12:01:05'),
(201, 'App\\Models\\User', 53, 'MyAuthApp', 'bbe7d492111dc1841e5690786ae8194b77d28c35000c8d2f06a233ac9b371ce9', '[\"*\"]', NULL, '2022-11-15 12:06:13', '2022-11-15 12:06:13'),
(202, 'App\\Models\\User', 69, 'MyAuthApp', '4e94d4d32f172b9b4983607387a85112de4e795db082cc9a34677dd9df9a38ef', '[\"*\"]', '2022-11-15 12:27:31', '2022-11-15 12:13:19', '2022-11-15 12:27:31'),
(203, 'App\\Models\\User', 53, 'MyAuthApp', '36b52e6e8ac93eba75e1ee9599dbbdf9951dac0d20734abdb0dfe5881e4c231b', '[\"*\"]', NULL, '2022-11-15 12:22:22', '2022-11-15 12:22:22'),
(204, 'App\\Models\\User', 53, 'MyAuthApp', '80b30d937f3a39c16fdc2a9406a7fa2615ee54bb7816a8e9d6aa7c8e9e04c34b', '[\"*\"]', NULL, '2022-11-15 13:27:21', '2022-11-15 13:27:21'),
(205, 'App\\Models\\User', 53, 'MyAuthApp', '6ebafa333e82e3a759f348e18f9423719e9234950b68480d4afeec217828c9dc', '[\"*\"]', NULL, '2022-11-15 13:27:35', '2022-11-15 13:27:35'),
(206, 'App\\Models\\User', 18, 'MyAuthApp', '0b9af96636323d3a944a129a067edc4e694e37cf21b3307dfd543b8da8d56c53', '[\"*\"]', NULL, '2022-11-15 13:27:35', '2022-11-15 13:27:35'),
(207, 'App\\Models\\User', 18, 'MyAuthApp', 'd2cb15ee6e40d661ea3ed5de5eaf2a1a66c23d329189a2148a4eb8fab618a24c', '[\"*\"]', NULL, '2022-11-15 13:29:51', '2022-11-15 13:29:51'),
(208, 'App\\Models\\User', 53, 'MyAuthApp', '59801d8240999dad0f7335ad09d74291dae9bd3f5f17817ad551097b5a63c766', '[\"*\"]', NULL, '2022-11-15 13:30:02', '2022-11-15 13:30:02'),
(209, 'App\\Models\\User', 71, 'MyAuthApp', '30b25cb7426e2f2e568e27469b919c57dc63d156724ebab25be2b8262bad85e4', '[\"*\"]', NULL, '2022-11-15 13:30:19', '2022-11-15 13:30:19'),
(210, 'App\\Models\\User', 53, 'MyAuthApp', '90257e060bef6132f7a67dd233d4018a202f05a70018d29e1bca6bbfd109805b', '[\"*\"]', NULL, '2022-11-15 13:30:43', '2022-11-15 13:30:43'),
(211, 'App\\Models\\User', 53, 'MyAuthApp', '276327b0bb8891ee8766d37e354167dea25083102244d6e6bfe8cae3222be439', '[\"*\"]', NULL, '2022-11-15 13:39:23', '2022-11-15 13:39:23'),
(212, 'App\\Models\\User', 53, 'MyAuthApp', '7a13008405cfe312d050cfc97ee37b9687c86e0d290021965706ac28081cd672', '[\"*\"]', NULL, '2022-11-15 13:59:58', '2022-11-15 13:59:58'),
(213, 'App\\Models\\User', 72, 'MyAuthApp', '7e237c0fcad3cd905de19d633405ea986c927f35303174f1f955af58c86b7b87', '[\"*\"]', NULL, '2022-11-15 15:02:34', '2022-11-15 15:02:34'),
(214, 'App\\Models\\User', 72, 'MyAuthApp', '361ebe06c6a4c12d35a59f78c3010ef0ca3ce5369ab1db0dde17d7de84394a42', '[\"*\"]', NULL, '2022-11-15 15:02:45', '2022-11-15 15:02:45'),
(215, 'App\\Models\\User', 72, 'MyAuthApp', 'effc80a3d02a78b6ca9a60ece94b7bec3228c64cf9d71b79c4bed6d9405917f0', '[\"*\"]', '2022-11-15 15:17:03', '2022-11-15 15:14:03', '2022-11-15 15:17:03'),
(216, 'App\\Models\\User', 73, 'MyAuthApp', '41ae440f4be4fd296bdb78919ec57a21bc1c215ddfa7e3003d4f5e92dc77721a', '[\"*\"]', NULL, '2022-11-15 15:27:15', '2022-11-15 15:27:15'),
(217, 'App\\Models\\User', 74, 'MyAuthApp', 'd890a1994fb9410535efcb6f4ac61de226d8b1ffc649c095e215b64f9528d648', '[\"*\"]', NULL, '2022-11-15 15:31:37', '2022-11-15 15:31:37'),
(218, 'App\\Models\\User', 74, 'MyAuthApp', '97b7443fa504cf5f9dae6ffc61c903f367160966eb4f49b741966b3718809421', '[\"*\"]', '2022-11-15 15:32:11', '2022-11-15 15:32:08', '2022-11-15 15:32:11'),
(219, 'App\\Models\\User', 69, 'MyAuthApp', '53d9fb9f7a00474c1f4e895839191f13ce21efc8bb9d69ddc9a82c0417fdc12f', '[\"*\"]', '2022-11-15 15:40:56', '2022-11-15 15:40:53', '2022-11-15 15:40:56'),
(220, 'App\\Models\\User', 69, 'MyAuthApp', '90c51e44efd11f0a354a6fee705a49e817a1e1ed6acebc731ac5163103a48498', '[\"*\"]', '2022-11-15 15:59:02', '2022-11-15 15:58:58', '2022-11-15 15:59:02'),
(221, 'App\\Models\\User', 69, 'MyAuthApp', 'b5714042ac2f069e494fb6cf8e9b30ac63d455c576e185e987712c9e763730ad', '[\"*\"]', '2022-11-16 10:31:14', '2022-11-15 16:16:36', '2022-11-16 10:31:14'),
(222, 'App\\Models\\User', 75, 'MyAuthApp', '7dc7e1c45dcfd6a4a2a299d91ca3701b7a92cd735db4a80beab8e2b5b2a107e3', '[\"*\"]', NULL, '2022-11-16 10:26:58', '2022-11-16 10:26:58'),
(223, 'App\\Models\\User', 69, 'MyAuthApp', 'ea28051e93f0d3ff5e370e70e4471bfea8792f93423f8ffb6e2ae101dda67c65', '[\"*\"]', '2022-11-16 15:26:08', '2022-11-16 10:50:34', '2022-11-16 15:26:08'),
(224, 'App\\Models\\User', 44, 'MyAuthApp', 'f0d2e4a4fecb7fab3e97e147f105c45595d312ebe21b08d85bdf483d54d23e8f', '[\"*\"]', '2022-11-16 12:10:50', '2022-11-16 11:29:58', '2022-11-16 12:10:50'),
(225, 'App\\Models\\User', 44, 'MyAuthApp', 'a580abaf42d20c6607f98ad6611315448679fa0f6e2831b40b035ce9be0ba840', '[\"*\"]', '2022-11-16 12:16:08', '2022-11-16 12:15:38', '2022-11-16 12:16:08'),
(226, 'App\\Models\\User', 44, 'MyAuthApp', 'e7207ea36e02430db5c049d98ee89b1b03f5731dd0e5624e59760de2cd908dfe', '[\"*\"]', '2022-11-16 13:31:07', '2022-11-16 13:31:05', '2022-11-16 13:31:07'),
(227, 'App\\Models\\User', 18, 'MyAuthApp', '2817eae9c25388267661adc7cb7f9efc7b5512792791d15474d7ca9e157cfa43', '[\"*\"]', NULL, '2022-11-16 13:36:00', '2022-11-16 13:36:00'),
(228, 'App\\Models\\User', 44, 'MyAuthApp', '857a96ec644c72bc069074c88a214efcc209db94ed3dc3bbb4b37355f505d3d3', '[\"*\"]', '2022-11-16 13:59:54', '2022-11-16 13:55:30', '2022-11-16 13:59:54'),
(229, 'App\\Models\\User', 44, 'MyAuthApp', '4c36d0b7ff3b9a0e125d5bad7c8f21311a00fcd8ccbd9074639666fe7db1e171', '[\"*\"]', '2022-11-17 15:27:20', '2022-11-16 14:00:59', '2022-11-17 15:27:20'),
(230, 'App\\Models\\User', 44, 'MyAuthApp', '6dd5869bd5dbd2b6a1dc7fb3e0989123686562c29bcd4131f3327eec5739481b', '[\"*\"]', '2022-11-16 14:11:15', '2022-11-16 14:02:30', '2022-11-16 14:11:15'),
(231, 'App\\Models\\User', 18, 'MyAuthApp', 'a5713d9397bc0f72daed3a84d8f00f99d890aeebbe665cd7b99e802e49b83b1f', '[\"*\"]', NULL, '2022-11-16 14:22:25', '2022-11-16 14:22:25'),
(232, 'App\\Models\\User', 18, 'MyAuthApp', 'd91d6036017e2f35e70f06eeac9b5302f3f9a6291a41e032da66a1791bea1ff5', '[\"*\"]', '2022-11-17 15:28:27', '2022-11-16 14:25:02', '2022-11-17 15:28:27'),
(233, 'App\\Models\\User', 18, 'MyAuthApp', '4833c722292831c29b6944403c990ae80397e8019abb2b328c155a7c4545ecb7', '[\"*\"]', '2022-12-22 11:08:54', '2022-11-16 14:29:15', '2022-12-22 11:08:54'),
(234, 'App\\Models\\User', 76, 'MyAuthApp', 'af3f412d07637cae031bb4e874ea61cbc90ff33ba284bc4b8d77e25a9c100c28', '[\"*\"]', NULL, '2022-11-16 14:46:35', '2022-11-16 14:46:35'),
(235, 'App\\Models\\User', 77, 'MyAuthApp', '113315f43a0965b3a1492d22963a5fbcdf7b3ad13bc7e76b59bd2b43066be9bf', '[\"*\"]', NULL, '2022-11-16 14:50:00', '2022-11-16 14:50:00'),
(236, 'App\\Models\\User', 78, 'MyAuthApp', 'f420bd3e21c03c7684a87188132c60faa53b301eb5223551c34958c3395349ae', '[\"*\"]', NULL, '2022-11-16 14:52:05', '2022-11-16 14:52:05'),
(237, 'App\\Models\\User', 79, 'MyAuthApp', '3eb1ff9f131696a2160809712ca88e4ee27036553c4973b43f29c82e13438b2b', '[\"*\"]', NULL, '2022-11-16 14:57:32', '2022-11-16 14:57:32'),
(238, 'App\\Models\\User', 44, 'MyAuthApp', '4ada162b175c0eb6939ef5c7154e6723ec3c9557d74978c87f855c955e673052', '[\"*\"]', '2022-11-16 17:34:05', '2022-11-16 15:03:18', '2022-11-16 17:34:05'),
(239, 'App\\Models\\User', 79, 'MyAuthApp', '70784fb69d923113144b0348a4cd2d31701d5a67d6a7e6852bdee4b98a4bca77', '[\"*\"]', '2022-11-16 15:09:44', '2022-11-16 15:08:57', '2022-11-16 15:09:44'),
(240, 'App\\Models\\User', 53, 'MyAuthApp', 'c33b1159e3b61bea2400b6fc05f9f2a02cda0633510002b69a8b6f335426dd91', '[\"*\"]', NULL, '2022-11-16 15:36:32', '2022-11-16 15:36:32'),
(241, 'App\\Models\\User', 53, 'MyAuthApp', '76d93141ddbbcdead705274eaef0052dee447b34dc1a4affe03fea097a1a1030', '[\"*\"]', '2022-11-17 18:26:42', '2022-11-16 15:40:24', '2022-11-17 18:26:42'),
(242, 'App\\Models\\User', 53, 'MyAuthApp', '97c262ac2f74ff7a5223247ddf05c254d03da73e5fb31f7edd60d554f02f01e6', '[\"*\"]', '2022-11-16 17:33:39', '2022-11-16 15:41:15', '2022-11-16 17:33:39'),
(243, 'App\\Models\\User', 80, 'MyAuthApp', '8d026a80508664998758e1af9563321a49d67a886f78dc9fbf86c7a873fbce74', '[\"*\"]', NULL, '2022-11-16 17:43:12', '2022-11-16 17:43:12'),
(244, 'App\\Models\\User', 80, 'MyAuthApp', 'def4ceb1e45a4f82a6544866d8a7fd023fafd63db297570fa37a5e6bf6165dbd', '[\"*\"]', '2022-11-16 17:43:33', '2022-11-16 17:43:31', '2022-11-16 17:43:33'),
(245, 'App\\Models\\User', 80, 'MyAuthApp', '41ae20b97857c39a1a7f6111be592d51c31cbd380436ed52bec46bc9a55d65b5', '[\"*\"]', '2022-11-16 17:46:11', '2022-11-16 17:46:10', '2022-11-16 17:46:11'),
(246, 'App\\Models\\User', 81, 'MyAuthApp', '2a0ea5771ba9c21af7906eb990e01502d9743f9d97630229a1298c5b5c08e0cb', '[\"*\"]', NULL, '2022-11-16 17:49:30', '2022-11-16 17:49:30'),
(247, 'App\\Models\\User', 81, 'MyAuthApp', '5fe6d301f612b736d6ba35cedb8ddd71ed763f61ccfce652c03b0194fee076bc', '[\"*\"]', '2022-11-16 17:49:44', '2022-11-16 17:49:42', '2022-11-16 17:49:44'),
(248, 'App\\Models\\User', 82, 'MyAuthApp', 'e444d52135e048f931a7ee9b60e5ccc78959576231700fea6ad5b84239a931b5', '[\"*\"]', NULL, '2022-11-16 18:20:25', '2022-11-16 18:20:25'),
(249, 'App\\Models\\User', 82, 'MyAuthApp', '39f30899384a2b4d3f5c55c1438f94d32d41ebdfe3eabf6c9b97a7e44976a084', '[\"*\"]', '2022-11-16 18:20:35', '2022-11-16 18:20:33', '2022-11-16 18:20:35'),
(250, 'App\\Models\\User', 82, 'MyAuthApp', 'f9fb04f4b719e9f0401b5474facb0dbb9316037ab8d55b5d81a253b63ae4fc8b', '[\"*\"]', '2022-11-16 18:21:40', '2022-11-16 18:21:37', '2022-11-16 18:21:40'),
(251, 'App\\Models\\User', 83, 'MyAuthApp', '81f85bf5eea45cbeed2dea37d8e4e7188d85b8c2c9e598b4f1d7d86ddb3d8c8c', '[\"*\"]', NULL, '2022-11-16 18:22:27', '2022-11-16 18:22:27'),
(252, 'App\\Models\\User', 83, 'MyAuthApp', 'e3768397df63d7f847323af278c980ec34355e31ac8880155ff7913b8e051cd3', '[\"*\"]', '2022-11-16 18:22:57', '2022-11-16 18:22:56', '2022-11-16 18:22:57'),
(253, 'App\\Models\\User', 83, 'MyAuthApp', '4cf2bbe97f12de6d25c03374b70ae0535abddd8aa77a7f927e1cc9e9a2f76d32', '[\"*\"]', '2022-11-16 18:23:47', '2022-11-16 18:23:46', '2022-11-16 18:23:47'),
(254, 'App\\Models\\User', 44, 'MyAuthApp', 'a1749b8abba8ca8439676bbdfde1617ed4889dcf2135780888bc632b1c7bda03', '[\"*\"]', '2022-11-16 18:26:33', '2022-11-16 18:25:30', '2022-11-16 18:26:33'),
(255, 'App\\Models\\User', 84, 'MyAuthApp', '14fbb5899b65a3ec042ec33c82c54ec9daedf5bac82c2b40c467384698b636b7', '[\"*\"]', NULL, '2022-11-16 18:28:33', '2022-11-16 18:28:33'),
(256, 'App\\Models\\User', 83, 'MyAuthApp', '100bdafc6639f03fa7a9dad2704a109e2e6b0dedd0b7aa23375c6df7f06fad21', '[\"*\"]', '2022-11-16 18:34:50', '2022-11-16 18:32:40', '2022-11-16 18:34:50'),
(257, 'App\\Models\\User', 85, 'MyAuthApp', '3a1a646155019fc07230c6b7ec101f008f1009898e174369fb94b8cd2dd9d504', '[\"*\"]', NULL, '2022-11-16 18:36:16', '2022-11-16 18:36:16'),
(258, 'App\\Models\\User', 86, 'MyAuthApp', 'efa9a7050f0e27d0a0644ffb846af397a1a2ae0eed652cadbd89b393fa6dee3f', '[\"*\"]', NULL, '2022-11-16 18:45:09', '2022-11-16 18:45:09'),
(259, 'App\\Models\\User', 86, 'MyAuthApp', 'a6f38eb170c7b0308a369151883c274f629902ccee0ae7ebefceadf5e75f94a5', '[\"*\"]', '2022-11-16 18:45:20', '2022-11-16 18:45:18', '2022-11-16 18:45:20'),
(260, 'App\\Models\\User', 86, 'MyAuthApp', '0c9f24f43f24389b7cb7598dee8b28a09c2e790704ef442ea09225ba8ec89ce0', '[\"*\"]', '2022-11-17 12:16:46', '2022-11-16 18:47:06', '2022-11-17 12:16:46'),
(261, 'App\\Models\\User', 44, 'MyAuthApp', 'ff0029a1c4b65c1091bb3c949aae3e46f2b81596f9f69f8cf57d8a2b262abea6', '[\"*\"]', '2022-11-17 17:41:30', '2022-11-17 09:57:30', '2022-11-17 17:41:30'),
(262, 'App\\Models\\User', 18, 'MyAuthApp', '236ec477662c52f8992fbf6b7d3048d1ceac2b6ba067cc64c99c772929803d98', '[\"*\"]', '2022-11-17 10:57:17', '2022-11-17 10:53:51', '2022-11-17 10:57:17'),
(263, 'App\\Models\\User', 18, 'MyAuthApp', '0b62957a0cd0c8d851e53d574bdd6ec0ce848b51914074d890fe1d77d7d736ed', '[\"*\"]', '2022-11-17 13:40:35', '2022-11-17 13:38:51', '2022-11-17 13:40:35'),
(264, 'App\\Models\\User', 18, 'MyAuthApp', '70186157fcded08845d7bdd84ed4b3c2ba2c62565113654d0e4a3460f1e9fdbd', '[\"*\"]', '2022-11-17 13:57:00', '2022-11-17 13:51:14', '2022-11-17 13:57:00'),
(265, 'App\\Models\\User', 18, 'MyAuthApp', '65ece17382aa0b67d5c77f7d70f22597ea87e1994650f3263295e608e916ba85', '[\"*\"]', '2022-12-05 10:00:13', '2022-11-17 14:30:01', '2022-12-05 10:00:13'),
(266, 'App\\Models\\User', 18, 'MyAuthApp', '65da1a585f9a8725f450cf3f9c2405ee91a9450c5548251d0bc77e4c91e2c3a7', '[\"*\"]', '2022-11-17 16:00:01', '2022-11-17 15:59:49', '2022-11-17 16:00:01'),
(267, 'App\\Models\\User', 69, 'MyAuthApp', '778402a8b56610b0cfa9c493d88da7b9c472f44eab500804e7585cca40fdbf06', '[\"*\"]', '2022-11-17 16:17:53', '2022-11-17 16:00:32', '2022-11-17 16:17:53'),
(268, 'App\\Models\\User', 44, 'MyAuthApp', '5a16816678eb02e8373015d33d2dda4a7a8602760b517fda230a2d94b8128ebc', '[\"*\"]', '2022-11-17 16:11:22', '2022-11-17 16:11:20', '2022-11-17 16:11:22'),
(269, 'App\\Models\\User', 44, 'MyAuthApp', 'c71fd82423eff6b6ae93d871e7e0b13847616ba10fda0e6efbcdcfe463ef6b9b', '[\"*\"]', '2022-11-17 16:19:28', '2022-11-17 16:19:26', '2022-11-17 16:19:28'),
(270, 'App\\Models\\User', 44, 'MyAuthApp', 'c3a10c23dc5c7ec2c9bcd4ccbab28314039f41b9273ae0aad9a213e8d0647c9f', '[\"*\"]', '2022-11-17 16:58:04', '2022-11-17 16:52:15', '2022-11-17 16:58:04'),
(271, 'App\\Models\\User', 44, 'MyAuthApp', '2534aa3b8184ac7080003caaf8d86f5980130755160f20fb304febee33ce891d', '[\"*\"]', '2022-11-17 18:04:19', '2022-11-17 17:53:00', '2022-11-17 18:04:19'),
(272, 'App\\Models\\User', 44, 'MyAuthApp', '778588fdc03f6daee4661a6b79bbd135803510cf877eb93bf8b0744e00fa3d29', '[\"*\"]', '2022-11-17 18:41:53', '2022-11-17 18:41:52', '2022-11-17 18:41:53'),
(273, 'App\\Models\\User', 13, 'MyAuthApp', 'b869409af6e9afc397d332782c8123dcd9deaf208473d84724c2b86ab0068eff', '[\"*\"]', '2022-12-27 16:46:31', '2022-11-18 10:35:36', '2022-12-27 16:46:31'),
(274, 'App\\Models\\User', 14, 'MyAuthApp', '60b3238976ca5be17a27beb42fbe3b0678d2ca3fbc31a7f117081428a3c9effa', '[\"*\"]', NULL, '2022-11-18 10:39:59', '2022-11-18 10:39:59'),
(275, 'App\\Models\\User', 15, 'MyAuthApp', '3a170acc40ed6566551a2e8a357b28623da542307c034ed86b0f90d5f491f41c', '[\"*\"]', NULL, '2022-11-18 10:40:19', '2022-11-18 10:40:19'),
(276, 'App\\Models\\User', 15, 'MyAuthApp', '9aa12acec442a940fa44250af35605a41a902ec1450d47ef506a521e50ca7681', '[\"*\"]', '2022-12-20 12:11:46', '2022-11-18 10:40:26', '2022-12-20 12:11:46'),
(277, 'App\\Models\\User', 16, 'MyAuthApp', 'ce0cbe7f80f918c8b4a68a69f2644a986941834b86c0bbb07c99737876363d7f', '[\"*\"]', NULL, '2022-11-18 10:54:25', '2022-11-18 10:54:25'),
(278, 'App\\Models\\User', 16, 'MyAuthApp', '158725713801c3f707d9e35b18de356ab884c82790acc31c5ae8969617f44480', '[\"*\"]', '2022-11-18 18:32:38', '2022-11-18 10:54:37', '2022-11-18 18:32:38'),
(279, 'App\\Models\\User', 16, 'MyAuthApp', 'ba6e90d39b17e468d27e14453de93aa1799265f5b6b41f4dcbe008c4413654f1', '[\"*\"]', '2022-11-23 16:58:37', '2022-11-18 11:09:53', '2022-11-23 16:58:37'),
(280, 'App\\Models\\User', 16, 'MyAuthApp', 'da1bbc6300fbd48677b6208f932da1f2c9c9cb4c53f81c0bfd976d1c04882c25', '[\"*\"]', '2022-11-18 17:02:27', '2022-11-18 14:20:55', '2022-11-18 17:02:27'),
(281, 'App\\Models\\User', 17, 'MyAuthApp', '7881cceff2134a98003f407d2ed645f9892ae8682dfafb7428642e60639ad94f', '[\"*\"]', NULL, '2022-11-18 14:23:03', '2022-11-18 14:23:03'),
(282, 'App\\Models\\User', 17, 'MyAuthApp', '534dc364ee032f6078ac725f615a105f6148e757230f276ae0e7118b3fa1f928', '[\"*\"]', '2022-11-18 14:23:42', '2022-11-18 14:23:11', '2022-11-18 14:23:42'),
(283, 'App\\Models\\User', 18, 'MyAuthApp', '8f543758ddbdbe5622f7104a3ce32c7c5b8fa441aaa03fa465aed1ee85d937a6', '[\"*\"]', NULL, '2022-11-18 14:26:44', '2022-11-18 14:26:44'),
(284, 'App\\Models\\User', 18, 'MyAuthApp', '25cfcb3fe84f79b4a91d8c66021c77a78163870472c51eaf7eb75c83bfdaebad', '[\"*\"]', '2022-11-18 14:26:52', '2022-11-18 14:26:50', '2022-11-18 14:26:52'),
(285, 'App\\Models\\User', 18, 'MyAuthApp', '89e2759a7bb0a5b58b20bd82a232fc6cf9e7b416fcf67fd609bd8dae47bec869', '[\"*\"]', '2022-11-18 14:27:38', '2022-11-18 14:27:36', '2022-11-18 14:27:38'),
(286, 'App\\Models\\User', 15, 'MyAuthApp', '8d2f39ad8076505c96fc7a0ce4f1bd09cae5b12754f60268363b686a2ae06fda', '[\"*\"]', '2022-11-21 16:14:28', '2022-11-18 16:36:15', '2022-11-21 16:14:28'),
(287, 'App\\Models\\User', 13, 'MyAuthApp', '3fec71341f6c7a1ea6610e3ce867abcaabdfd2eae1d52dde9397d6e253b28f71', '[\"*\"]', '2022-11-21 10:28:52', '2022-11-21 10:18:25', '2022-11-21 10:28:52'),
(288, 'App\\Models\\User', 13, 'MyAuthApp', '51b3b0bad26f0ad6fc72135bf8669289447048d9a6d06922fe1dd922cd2d434a', '[\"*\"]', '2022-12-26 18:21:24', '2022-11-21 10:30:49', '2022-12-26 18:21:24'),
(289, 'App\\Models\\User', 15, 'MyAuthApp', '204239792ae015848ca9055b634d7d8403e642e12c0a548fb13e5d74db0d0e60', '[\"*\"]', '2022-11-21 10:48:03', '2022-11-21 10:47:07', '2022-11-21 10:48:03'),
(290, 'App\\Models\\User', 15, 'MyAuthApp', '9b52ff8a927366db44afb5d0ea565c13cfe96c06da2eff0071e83f554452de01', '[\"*\"]', '2022-11-21 12:43:14', '2022-11-21 10:57:04', '2022-11-21 12:43:14'),
(291, 'App\\Models\\User', 19, 'MyAuthApp', '62457e4e196bd3cdbbbb7e829f5ee3974f72a577fc304e583efcdf03268748eb', '[\"*\"]', NULL, '2022-11-21 11:02:09', '2022-11-21 11:02:09'),
(292, 'App\\Models\\User', 19, 'MyAuthApp', '78c3045f6599f623dbae75ec7f3ba946a2bfa867f7a14fc08cc6792fe7e2e64a', '[\"*\"]', NULL, '2022-11-21 11:07:49', '2022-11-21 11:07:49'),
(293, 'App\\Models\\User', 19, 'MyAuthApp', 'f0db6018fa552f99f05bd49247f645177030b2284e95357b9949b39b37030c61', '[\"*\"]', NULL, '2022-11-21 11:10:30', '2022-11-21 11:10:30'),
(294, 'App\\Models\\User', 15, 'MyAuthApp', '0288ea0ff3008be7b2feb1e69428bca1c04e3717fd6a33c6d2ec7f6cb9017fef', '[\"*\"]', NULL, '2022-11-21 11:12:34', '2022-11-21 11:12:34'),
(295, 'App\\Models\\User', 19, 'MyAuthApp', 'c82669fbf10b8cb12de7b20fba95eebea8dcbc63d90d6148d34ca84df1fb844c', '[\"*\"]', '2022-11-21 11:26:20', '2022-11-21 11:21:39', '2022-11-21 11:26:20'),
(296, 'App\\Models\\User', 19, 'MyAuthApp', '3d72bd03b3ce82d0c5504cec3a759ee7c2d803adb71cd8f4ca762ae89996c01c', '[\"*\"]', '2022-12-13 14:10:21', '2022-11-21 11:24:49', '2022-12-13 14:10:21'),
(297, 'App\\Models\\User', 19, 'MyAuthApp', '00c7a6324aa049f6a4bb34b2160868d8a226179781d354f328fd6d1de12eb8d4', '[\"*\"]', '2022-11-21 11:37:09', '2022-11-21 11:26:54', '2022-11-21 11:37:09'),
(298, 'App\\Models\\User', 16, 'MyAuthApp', '77bd91214fa7ae0876ea2a60591f8136ef53e89a234396db3ae000cdd8ebd4f6', '[\"*\"]', '2022-11-29 10:23:20', '2022-11-21 14:01:39', '2022-11-29 10:23:20'),
(299, 'App\\Models\\User', 16, 'MyAuthApp', '33466276bfe02de79adc111ba903570c10d6b2bd395a4cef13a1961209de4b5d', '[\"*\"]', '2022-11-21 14:17:37', '2022-11-21 14:17:24', '2022-11-21 14:17:37'),
(300, 'App\\Models\\User', 19, 'MyAuthApp', '7c000b8e64b238393a7f53e279fa9b5d5fdd456b684a00159db7ad5f85e949f7', '[\"*\"]', '2022-11-23 18:40:15', '2022-11-22 10:48:09', '2022-11-23 18:40:15'),
(301, 'App\\Models\\User', 20, 'MyAuthApp', '8e73ce6477e36009ef01cd4abd8608e2790659d65711e9600645d9385fe4cd71', '[\"*\"]', NULL, '2022-11-22 11:46:13', '2022-11-22 11:46:13'),
(302, 'App\\Models\\User', 20, 'MyAuthApp', '3dd64895dadc9c31ec0142dd39d6eb9cdd6ec53f29812b7ae2e279a850f459c7', '[\"*\"]', '2022-11-22 11:47:25', '2022-11-22 11:46:20', '2022-11-22 11:47:25'),
(303, 'App\\Models\\User', 20, 'MyAuthApp', '9766b79c5609262cd81d946d25383a5afa86c29b3bbca20915ea92d137f3708a', '[\"*\"]', '2022-11-22 11:47:43', '2022-11-22 11:47:41', '2022-11-22 11:47:43'),
(304, 'App\\Models\\User', 20, 'MyAuthApp', 'efb38f846cf32aa0fa450c88ea3dbe7f9c04ce5cb97b27cc0915904a238f747c', '[\"*\"]', '2022-11-22 13:05:51', '2022-11-22 11:49:01', '2022-11-22 13:05:51');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(305, 'App\\Models\\User', 20, 'MyAuthApp', '0921c595bc1af4c3840cb18cbbaebd982a2ae0a5ddbea928111b84f1bba3bbf4', '[\"*\"]', '2022-11-29 11:30:54', '2022-11-22 13:07:25', '2022-11-29 11:30:54'),
(306, 'App\\Models\\User', 15, 'MyAuthApp', '063b5982cbc0d1c9258ed72083c0559f5cccf0fa9489d8443b75499ce8795051', '[\"*\"]', '2023-01-09 12:38:54', '2022-11-22 17:34:53', '2023-01-09 12:38:54'),
(307, 'App\\Models\\User', 15, 'MyAuthApp', '74720099fcb6be94fd85808e0d1c6aecb22e6d2a8c6766b2cfa06ad9c89af736', '[\"*\"]', '2022-11-30 17:16:16', '2022-11-22 17:47:43', '2022-11-30 17:16:16'),
(308, 'App\\Models\\User', 19, 'MyAuthApp', '3c946cb8a2891da2361ca8befd385b4094b46525593eaf7129810e99910d1c41', '[\"*\"]', '2022-12-28 10:37:41', '2022-11-23 18:23:56', '2022-12-28 10:37:41'),
(309, 'App\\Models\\User', 21, 'MyAuthApp', '051d6f32458a31698e3eee01810e20b4a07b7158d5c789ea46486703ff2cb6ba', '[\"*\"]', NULL, '2022-11-25 10:36:38', '2022-11-25 10:36:38'),
(310, 'App\\Models\\User', 21, 'MyAuthApp', '1b81d94f8a779c0ffdcd8451fcd664de425a6adf58657bad038374d3b337a299', '[\"*\"]', '2022-11-25 10:51:22', '2022-11-25 10:36:54', '2022-11-25 10:51:22'),
(311, 'App\\Models\\User', 19, 'MyAuthApp', '48b4a618d07a8cb5b442da5fd39f24dce9a27095f4e20277c7fd82dfd929f7d3', '[\"*\"]', NULL, '2022-11-25 10:46:13', '2022-11-25 10:46:13'),
(312, 'App\\Models\\User', 22, 'MyAuthApp', '5a8ecff1654acbeb1ccd1cca2df8f21f7b78ee2a413e51974bdde107927a5d53', '[\"*\"]', NULL, '2022-11-25 10:48:34', '2022-11-25 10:48:34'),
(313, 'App\\Models\\User', 23, 'MyAuthApp', '4a7acac142486423363c06e2978c07249a2fc611a188480c7a689b038d4fbeda', '[\"*\"]', NULL, '2022-11-25 10:48:51', '2022-11-25 10:48:51'),
(314, 'App\\Models\\User', 24, 'MyAuthApp', 'b9ef8072aa371e1ec64fc51e10ae7ed5592d977f4e105159ceeac48b622fd488', '[\"*\"]', NULL, '2022-11-25 10:49:20', '2022-11-25 10:49:20'),
(315, 'App\\Models\\User', 25, 'MyAuthApp', '276749da7e92b5f97ffce3c1e3b42e76c750e8190b0afdafd1b75c32d7577055', '[\"*\"]', NULL, '2022-11-25 10:50:32', '2022-11-25 10:50:32'),
(316, 'App\\Models\\User', 26, 'MyAuthApp', '1b4aaf517ba92c0557a290bd688a461428d29efcf1d38cedabd68c55cd7da508', '[\"*\"]', NULL, '2022-11-25 10:51:02', '2022-11-25 10:51:02'),
(317, 'App\\Models\\User', 27, 'MyAuthApp', 'ec977f639bbfb98dbbda3577eba0d49bc1112c6a5ed4041c2ee1bca232ed3f71', '[\"*\"]', NULL, '2022-11-25 10:53:31', '2022-11-25 10:53:31'),
(318, 'App\\Models\\User', 28, 'MyAuthApp', 'f3c6430d71b5ae193f99ab60a91a1cc4c6d4100716a625d7fcbd2a3ca6da2f08', '[\"*\"]', NULL, '2022-11-25 10:54:41', '2022-11-25 10:54:41'),
(319, 'App\\Models\\User', 28, 'MyAuthApp', 'e1c473c42e92191bd54a1a22512ef7b5c0180c7b5eb595e0efe363c8aec1cb2c', '[\"*\"]', NULL, '2022-11-25 10:55:07', '2022-11-25 10:55:07'),
(320, 'App\\Models\\User', 28, 'MyAuthApp', '5692f245e693cc6aed0bafdd14ef4cd4d05e55b1ce0677ed6022868cb7085531', '[\"*\"]', NULL, '2022-11-25 10:55:53', '2022-11-25 10:55:53'),
(321, 'App\\Models\\User', 28, 'MyAuthApp', '73e108e1f00ca7522f9801633859e16c30b718161df48b6dd3468ac14eccc92c', '[\"*\"]', NULL, '2022-11-25 10:57:06', '2022-11-25 10:57:06'),
(322, 'App\\Models\\User', 28, 'MyAuthApp', '36d7f259ea66435e0f03e49aec5218d0b6799039dc6d2df5a764e42c0cf0e727', '[\"*\"]', NULL, '2022-11-25 10:58:01', '2022-11-25 10:58:01'),
(323, 'App\\Models\\User', 19, 'MyAuthApp', 'a574e51d0690b0acf45b905c6b7fdff626ff85966e6a6de56f9a82efdecfd773', '[\"*\"]', '2022-12-16 10:20:32', '2022-11-25 11:34:53', '2022-12-16 10:20:32'),
(324, 'App\\Models\\User', 29, 'MyAuthApp', '592cb6ee3170e5988806b0ef5feb819ad2de1cea8c18009328600a67b1855fc9', '[\"*\"]', NULL, '2022-11-28 10:35:20', '2022-11-28 10:35:20'),
(325, 'App\\Models\\User', 30, 'MyAuthApp', 'f45a29451e46f2e44254bf6ff4ee7ac451a06a93b846ac92eaf95732f740886f', '[\"*\"]', NULL, '2022-11-28 10:35:35', '2022-11-28 10:35:35'),
(326, 'App\\Models\\User', 31, 'MyAuthApp', 'fd09a56da9670d9d211f9c35409511df1cbfce9fe6f6724b97481ecc277150b1', '[\"*\"]', NULL, '2022-11-28 10:36:11', '2022-11-28 10:36:11'),
(327, 'App\\Models\\User', 32, 'MyAuthApp', '96a86bd69699e95373ca9d6b391f661715904da6469da8010baabe3204df4bf0', '[\"*\"]', NULL, '2022-11-28 10:36:30', '2022-11-28 10:36:30'),
(328, 'App\\Models\\User', 33, 'MyAuthApp', 'a0576cfca8b77671165455ee81eb3fc6f1ef35ade39cef5f060c2db5637b391d', '[\"*\"]', NULL, '2022-11-28 10:41:30', '2022-11-28 10:41:30'),
(329, 'App\\Models\\User', 15, 'MyAuthApp', '1efc959d89e35a8ed4c058ce8916c9d2096766c35c2ef372f4bf708feabea040', '[\"*\"]', NULL, '2022-11-28 14:15:14', '2022-11-28 14:15:14'),
(330, 'App\\Models\\User', 15, 'MyAuthApp', '5593173370625877e7e7d6652e517f3855f1af55fd79840554c542ca62308a8f', '[\"*\"]', NULL, '2022-11-28 14:15:52', '2022-11-28 14:15:52'),
(331, 'App\\Models\\User', 15, 'MyAuthApp', '802eb553fec676acf95ea40c490069122d17e4808df6c821ced53682b513fa2c', '[\"*\"]', NULL, '2022-11-28 14:16:54', '2022-11-28 14:16:54'),
(332, 'App\\Models\\User', 15, 'MyAuthApp', '3a8d01b3f43bdb247ea8ebd3911126cf495a5022f7d62fcb4db7b891e9279693', '[\"*\"]', NULL, '2022-11-28 14:17:32', '2022-11-28 14:17:32'),
(333, 'App\\Models\\User', 15, 'MyAuthApp', 'cd4856da57f7ad710b2c58d751ce9b10c8c1c22e62f6286742dcbb41ded36ec0', '[\"*\"]', '2022-11-30 15:48:49', '2022-11-28 14:18:08', '2022-11-30 15:48:49'),
(334, 'App\\Models\\User', 34, 'MyAuthApp', '91698bc4a8767350edff9a509fe223fb3187c2bab41a53fb3a2cd3c7f59a8735', '[\"*\"]', NULL, '2022-11-28 18:05:18', '2022-11-28 18:05:18'),
(335, 'App\\Models\\User', 34, 'MyAuthApp', '484ddc207e60b0519f786458f5052bd898e72f624a879ebc1f9468cc5bdb5854', '[\"*\"]', '2023-01-02 16:28:26', '2022-11-28 18:05:39', '2023-01-02 16:28:26'),
(336, 'App\\Models\\User', 28, 'MyAuthApp', '0f9adc5d9e88fbb036110bc8dec02c3b5fc924493362fa40ebd7070efff50867', '[\"*\"]', NULL, '2022-11-29 10:25:19', '2022-11-29 10:25:19'),
(337, 'App\\Models\\User', 28, 'MyAuthApp', 'e8d9f745e98d9aa52ae93479b431ac93ecd73d87d705dc8d6879c71a78f65b08', '[\"*\"]', '2022-11-29 16:31:28', '2022-11-29 10:25:58', '2022-11-29 16:31:28'),
(338, 'App\\Models\\User', 15, 'MyAuthApp', '09191d2de9393cc7b181b16e2560485dadd66367b6818fe9e763cf90c09abc4b', '[\"*\"]', '2022-11-29 11:19:01', '2022-11-29 10:31:17', '2022-11-29 11:19:01'),
(339, 'App\\Models\\User', 20, 'MyAuthApp', 'bf75262d4b3abedaf4efbf7cc15a28c46f9deb3af87cff60139313e913ae02d8', '[\"*\"]', '2022-11-29 10:50:44', '2022-11-29 10:50:42', '2022-11-29 10:50:44'),
(340, 'App\\Models\\User', 35, 'MyAuthApp', '1982261970965fd1b355b70488033260f575832eb38d90deae8da7c23db009a5', '[\"*\"]', NULL, '2022-11-29 11:15:15', '2022-11-29 11:15:15'),
(341, 'App\\Models\\User', 36, 'MyAuthApp', '3eae05b575daaf4c7f2ea908dbd1472891124f193e19868b83c8b4f5dea1a623', '[\"*\"]', NULL, '2022-11-29 11:17:37', '2022-11-29 11:17:37'),
(342, 'App\\Models\\User', 37, 'MyAuthApp', '3771f2937e640310412d43ce37f94f58e5bb97d020a23fd142d4846a841f5746', '[\"*\"]', NULL, '2022-11-29 11:18:09', '2022-11-29 11:18:09'),
(343, 'App\\Models\\User', 20, 'MyAuthApp', 'ddd2468525bf1109eb1fed4c54921f75a4458d00b7129909ef12f8bfde5c7471', '[\"*\"]', '2022-11-29 11:19:20', '2022-11-29 11:19:18', '2022-11-29 11:19:20'),
(344, 'App\\Models\\User', 38, 'MyAuthApp', 'd7ceee5a1e576159a3936d7b9d7fc0799fac8e960c037c030c8d50058953373d', '[\"*\"]', NULL, '2022-11-29 11:26:27', '2022-11-29 11:26:27'),
(345, 'App\\Models\\User', 39, 'MyAuthApp', '5f12f668a3bcf9e862b989cd1ebc9b4c6c73de5b2627659599dcc6cb5abc2503', '[\"*\"]', NULL, '2022-11-29 11:26:59', '2022-11-29 11:26:59'),
(346, 'App\\Models\\User', 39, 'MyAuthApp', '9ce43f536151bd0bc61df098a8acbd589c53685f1bd73133365c8777cc62ee52', '[\"*\"]', NULL, '2022-11-29 11:28:02', '2022-11-29 11:28:02'),
(347, 'App\\Models\\User', 39, 'MyAuthApp', '8feec318941c970ab45873702e5a80bbbae4e064ec50f304d49864f131c03cc3', '[\"*\"]', NULL, '2022-11-29 11:29:13', '2022-11-29 11:29:13'),
(348, 'App\\Models\\User', 40, 'MyAuthApp', '4cd58ef33457674b0eb0f79a1aa3927a205afc79593fe781de7684be227bd74f', '[\"*\"]', NULL, '2022-11-29 11:36:39', '2022-11-29 11:36:39'),
(349, 'App\\Models\\User', 41, 'MyAuthApp', '1a4473615f04544a274c9c23fb1dcef05bbaeb3168bcca118e0fcb18dd5a61c2', '[\"*\"]', NULL, '2022-11-29 11:36:53', '2022-11-29 11:36:53'),
(350, 'App\\Models\\User', 41, 'MyAuthApp', 'ff25c373f43410c99734f783573e63d78099ae3a98c00e96882fa6fc166ad29e', '[\"*\"]', NULL, '2022-11-29 11:37:01', '2022-11-29 11:37:01'),
(351, 'App\\Models\\User', 42, 'MyAuthApp', '303f13f4604ecd9e5681964efff1ca91d26150423392c86912064e91ea9b3491', '[\"*\"]', NULL, '2022-11-29 11:37:43', '2022-11-29 11:37:43'),
(352, 'App\\Models\\User', 41, 'MyAuthApp', 'c8bf8072658dc8120bcb30220e35cbf945457de06de0e187283ba58d32fc0fa1', '[\"*\"]', NULL, '2022-11-29 11:37:49', '2022-11-29 11:37:49'),
(353, 'App\\Models\\User', 41, 'MyAuthApp', 'fa5a58916a4dd011495983ff89a0c953986ec6c43e652a2b0106407842982882', '[\"*\"]', '2022-11-29 11:48:34', '2022-11-29 11:41:55', '2022-11-29 11:48:34'),
(354, 'App\\Models\\User', 43, 'MyAuthApp', 'eba76bf5ecbc2705b23fc8012d641bcab4c252acdb69ce13adc440b494228238', '[\"*\"]', NULL, '2022-11-29 11:51:51', '2022-11-29 11:51:51'),
(355, 'App\\Models\\User', 44, 'MyAuthApp', 'bda94fa73e9046f1433e356b2de4dced31d7e8a7b224716aa34965fc4bcf48a6', '[\"*\"]', NULL, '2022-11-29 11:55:14', '2022-11-29 11:55:14'),
(356, 'App\\Models\\User', 44, 'MyAuthApp', '002246b6e4ae22217094074efa7ee4c071e8d432d802aa8ae5ecc2e79ece9b7f', '[\"*\"]', '2022-11-29 11:55:27', '2022-11-29 11:55:20', '2022-11-29 11:55:27'),
(357, 'App\\Models\\User', 45, 'MyAuthApp', 'fdffff6ec1bdba17539232c844efae9a5abb1a819352c75e54b40c8b8d437445', '[\"*\"]', NULL, '2022-11-29 12:12:12', '2022-11-29 12:12:12'),
(358, 'App\\Models\\User', 20, 'MyAuthApp', 'db87d71647d26cce6bc27f7c57481f6da111707a9dae1a2bcdb5d5bc771c6240', '[\"*\"]', '2022-11-29 13:26:24', '2022-11-29 12:12:19', '2022-11-29 13:26:24'),
(359, 'App\\Models\\User', 46, 'MyAuthApp', 'ac9cb9996341971fdb98aa2c2179e1ac75083dc97503c73003f26687ed6be5ae', '[\"*\"]', NULL, '2022-11-29 13:40:05', '2022-11-29 13:40:05'),
(360, 'App\\Models\\User', 20, 'MyAuthApp', '5b5e9b53c6cebe4c988787bd1d082d939110ea383e33a5223341caf4a396ff2f', '[\"*\"]', '2022-11-29 13:42:35', '2022-11-29 13:42:33', '2022-11-29 13:42:35'),
(361, 'App\\Models\\User', 20, 'MyAuthApp', 'b2c31f539b2abf87e6b7db2b475eb22b5fb23a89e573325244a23aad88e9b3e6', '[\"*\"]', '2022-11-29 14:24:45', '2022-11-29 13:50:25', '2022-11-29 14:24:45'),
(362, 'App\\Models\\User', 15, 'MyAuthApp', '349b8ede75183568bead37cc4191e8a015bca9ad444e9cecfcee7aa07757cb31', '[\"*\"]', '2022-11-29 16:27:59', '2022-11-29 15:42:35', '2022-11-29 16:27:59'),
(363, 'App\\Models\\User', 28, 'MyAuthApp', 'ea43a6fe0585703e89310a86f76517070e22717e659e2f0c6cbeb2d98221880c', '[\"*\"]', '2022-12-09 11:40:51', '2022-11-29 16:07:01', '2022-12-09 11:40:51'),
(364, 'App\\Models\\User', 47, 'MyAuthApp', '26994828783b3f7587d166b6080b03ec3418e6e6b741c5cd35b76dc42acc3c8a', '[\"*\"]', NULL, '2022-11-29 16:32:29', '2022-11-29 16:32:29'),
(365, 'App\\Models\\User', 47, 'MyAuthApp', 'b77e0174270fdf79f51cbe7536dafa316c70292c883d6e9a61b82a38d831d92c', '[\"*\"]', NULL, '2022-11-29 16:40:05', '2022-11-29 16:40:05'),
(366, 'App\\Models\\User', 47, 'MyAuthApp', '3fa22fabc4844419587153aea1bfd67264e525efefaf0d848eb48e0adeb72010', '[\"*\"]', NULL, '2022-11-29 16:40:12', '2022-11-29 16:40:12'),
(367, 'App\\Models\\User', 47, 'MyAuthApp', '4f7689f9af073d83510eae806d7d73311dbb194263d1790190aa592b67c3a908', '[\"*\"]', '2022-11-29 16:41:54', '2022-11-29 16:41:01', '2022-11-29 16:41:54'),
(368, 'App\\Models\\User', 47, 'MyAuthApp', 'e12654c52b55af0ecd8fc366ca6795e7d1651e0165cd85f85071bae28802c665', '[\"*\"]', '2022-11-30 10:38:13', '2022-11-29 16:45:17', '2022-11-30 10:38:13'),
(369, 'App\\Models\\User', 47, 'MyAuthApp', 'b78875c8035152d2efcce230e193be15289b95568aa6940578488c903ccb788a', '[\"*\"]', '2022-11-30 13:55:32', '2022-11-29 18:21:32', '2022-11-30 13:55:32'),
(370, 'App\\Models\\User', 47, 'MyAuthApp', '9dcc82092b7095616038bc7524b164fd0ded35f68f9e371142a4e75c0023371f', '[\"*\"]', '2022-11-30 10:57:57', '2022-11-30 10:45:39', '2022-11-30 10:57:57'),
(371, 'App\\Models\\User', 47, 'MyAuthApp', '5c41ceac947160f1638f1fde5f952cc4a8f99f175b074e371b721fd7978c0a83', '[\"*\"]', '2022-11-30 11:13:06', '2022-11-30 10:59:21', '2022-11-30 11:13:06'),
(372, 'App\\Models\\User', 47, 'MyAuthApp', '0f7510446c96b6755929b48d0b3b288481023a62c38e58e0aba5346faff93452', '[\"*\"]', '2022-12-06 14:13:34', '2022-11-30 11:14:10', '2022-12-06 14:13:34'),
(373, 'App\\Models\\User', 19, 'MyAuthApp', 'b303faf039121adf58c3594017384bac3fa8863c189aa215acfa78b6ebfbaaaf', '[\"*\"]', '2022-12-02 16:28:03', '2022-11-30 11:25:21', '2022-12-02 16:28:03'),
(374, 'App\\Models\\User', 47, 'MyAuthApp', '577b875b1fa72ef412d74cb036206c6677de259329962c92c2183ff0572dd08b', '[\"*\"]', '2022-11-30 18:14:49', '2022-11-30 12:11:06', '2022-11-30 18:14:49'),
(375, 'App\\Models\\User', 20, 'MyAuthApp', '0f4402b7112d48e313bcb319393695e35530f21616717dfc234164e8fea765f3', '[\"*\"]', NULL, '2022-11-30 13:47:08', '2022-11-30 13:47:08'),
(376, 'App\\Models\\User', 20, 'MyAuthApp', '532c9417554a40b62bb4e52c8473b2dd89119069f6e04f490b9e3c17ec86569d', '[\"*\"]', NULL, '2022-11-30 13:47:13', '2022-11-30 13:47:13'),
(377, 'App\\Models\\User', 20, 'MyAuthApp', '1387be71c3906cfe9144e32249080cb292006f5834161a04d913bb5c54cfc572', '[\"*\"]', NULL, '2022-11-30 13:47:16', '2022-11-30 13:47:16'),
(378, 'App\\Models\\User', 47, 'MyAuthApp', 'f8c61aff2e689a3dcc72dbfccef27319d14d5018990101c309656ad4322f3c3d', '[\"*\"]', '2022-11-30 17:50:36', '2022-11-30 13:58:06', '2022-11-30 17:50:36'),
(379, 'App\\Models\\User', 20, 'MyAuthApp', 'caf71ba36eebefd28132c17ca01a17e8cc357944c772ea83fe26852e078602a8', '[\"*\"]', NULL, '2022-11-30 14:20:18', '2022-11-30 14:20:18'),
(380, 'App\\Models\\User', 20, 'MyAuthApp', 'ef03b2fdc06866352d197ed09d0e3c6285dd12eebd5ed2647eb56a58052e7238', '[\"*\"]', NULL, '2022-11-30 14:26:55', '2022-11-30 14:26:55'),
(381, 'App\\Models\\User', 20, 'MyAuthApp', '202abccf036d871704f9ad387521ea2b41947db65eed8c518cad32b97fc538ae', '[\"*\"]', NULL, '2022-11-30 14:30:30', '2022-11-30 14:30:30'),
(382, 'App\\Models\\User', 20, 'MyAuthApp', '9975c710dfa52b39235d5e816cffd96c6efaf55d2b30f2a8316ca9e6ebec117f', '[\"*\"]', NULL, '2022-11-30 14:32:46', '2022-11-30 14:32:46'),
(383, 'App\\Models\\User', 20, 'MyAuthApp', '6e2609a8db23c91fed5a6e6b10f98b1509dc4c4b58688b41670237b866ac9601', '[\"*\"]', NULL, '2022-11-30 14:33:40', '2022-11-30 14:33:40'),
(384, 'App\\Models\\User', 20, 'MyAuthApp', '6580854bb684af316db2d61ceed377edc8f9d266ed3b823b3296f1e60af37225', '[\"*\"]', NULL, '2022-11-30 14:33:44', '2022-11-30 14:33:44'),
(385, 'App\\Models\\User', 20, 'MyAuthApp', '183f224ea6bfe5800c63f68ea6d111577b00041ba1b58bdf27662cba715a86f4', '[\"*\"]', NULL, '2022-11-30 14:33:58', '2022-11-30 14:33:58'),
(386, 'App\\Models\\User', 20, 'MyAuthApp', '220aa2f5d0529267bade52ff7830d541209c02543e491f9c9b6bed8fc20db27c', '[\"*\"]', NULL, '2022-11-30 14:35:36', '2022-11-30 14:35:36'),
(387, 'App\\Models\\User', 20, 'MyAuthApp', 'a4b05743727c63ea399b5a715e78210a5cc37c75bc2478f72ccc47e666ae5798', '[\"*\"]', NULL, '2022-11-30 14:43:15', '2022-11-30 14:43:15'),
(388, 'App\\Models\\User', 20, 'MyAuthApp', 'b530d47f4a94932300329fd459786955f42ecbc5ebb9b28781a54346ec974b3a', '[\"*\"]', NULL, '2022-11-30 14:49:47', '2022-11-30 14:49:47'),
(389, 'App\\Models\\User', 20, 'MyAuthApp', '4ae9cae1ef7be8a6664a506ca675f27c8fc8c76dfc10630fea5e7b69c7c0919c', '[\"*\"]', NULL, '2022-11-30 14:50:31', '2022-11-30 14:50:31'),
(390, 'App\\Models\\User', 20, 'MyAuthApp', 'd7e0dff7ad5d2c9b4d3f6e9c74624629228640431e8e26048f317018b6f5902b', '[\"*\"]', '2022-11-30 15:06:39', '2022-11-30 14:57:52', '2022-11-30 15:06:39'),
(391, 'App\\Models\\User', 20, 'MyAuthApp', '846bf19b74da40ce3cf87295d01d1b2d83b43307c48922aa58cc1aea7248c041', '[\"*\"]', '2022-12-13 11:24:23', '2022-11-30 14:59:30', '2022-12-13 11:24:23'),
(392, 'App\\Models\\User', 48, 'MyAuthApp', '8e5880c3b63482c2fb9f619561f9dd0320636a40b19f3ed1e3c691e144052102', '[\"*\"]', NULL, '2022-11-30 15:04:15', '2022-11-30 15:04:15'),
(393, 'App\\Models\\User', 48, 'MyAuthApp', '44c44d172497dc022314e56c3279686e26a6b359dd06d0ae9882860ec2a57c00', '[\"*\"]', NULL, '2022-11-30 15:04:27', '2022-11-30 15:04:27'),
(394, 'App\\Models\\User', 48, 'MyAuthApp', '4bd0ca5fb810532f9ed65ec11ef4d68ac78db4eba15b44688f69edb1dbade526', '[\"*\"]', NULL, '2022-11-30 15:04:36', '2022-11-30 15:04:36'),
(395, 'App\\Models\\User', 48, 'MyAuthApp', '1bee04b2c239859e5dca9b4a29592e73ccd6bcd096247f7c05a456db3fa15973', '[\"*\"]', NULL, '2022-11-30 15:04:48', '2022-11-30 15:04:48'),
(396, 'App\\Models\\User', 48, 'MyAuthApp', '68ae95b9a76cc5b33fbf2931977415b87f22fb03480233e71bb28045cf511f25', '[\"*\"]', NULL, '2022-11-30 15:04:57', '2022-11-30 15:04:57'),
(397, 'App\\Models\\User', 48, 'MyAuthApp', 'aedc79ac74aed45049dc36aa648cb1b2e8f099d83b1c8db7b57e7d06ac8cc64f', '[\"*\"]', NULL, '2022-11-30 15:05:17', '2022-11-30 15:05:17'),
(398, 'App\\Models\\User', 48, 'MyAuthApp', '236080f0b37bab4facca193423181eeabc19e55a7a2745fc68485840a870c311', '[\"*\"]', NULL, '2022-11-30 15:05:33', '2022-11-30 15:05:33'),
(399, 'App\\Models\\User', 48, 'MyAuthApp', 'ea3c3bc7241c6ef39fdd9f0fea5ab36c82019e0c81b6e89c8b4f72404024f814', '[\"*\"]', NULL, '2022-11-30 15:05:43', '2022-11-30 15:05:43'),
(400, 'App\\Models\\User', 48, 'MyAuthApp', '832074f46aa845fad886459b356fa74f590396f22eeb47fbe9b05ac2dfd85810', '[\"*\"]', NULL, '2022-11-30 15:05:55', '2022-11-30 15:05:55'),
(401, 'App\\Models\\User', 49, 'MyAuthApp', '1f2523bb125ac6cdac6e1ed945fdc0234156d783e074a79603ef768fc13fc406', '[\"*\"]', NULL, '2022-11-30 15:07:42', '2022-11-30 15:07:42'),
(402, 'App\\Models\\User', 49, 'MyAuthApp', '0be39dd7c0a18bc72abe0ed89d9463ba1cc8e18347a64f8dfd6e523fba0d6a6e', '[\"*\"]', NULL, '2022-11-30 15:07:48', '2022-11-30 15:07:48'),
(403, 'App\\Models\\User', 49, 'MyAuthApp', '4c5160ab0dad0170959f22504aee7753fef06e3fdf4b75b18ef575c29f3dc8e1', '[\"*\"]', '2022-11-30 15:13:18', '2022-11-30 15:07:58', '2022-11-30 15:13:18'),
(404, 'App\\Models\\User', 50, 'MyAuthApp', 'e93cea38aecbac09244cef549861f8b3aa75ee8c27378c1ddb7651e784b6f4f0', '[\"*\"]', NULL, '2022-11-30 15:10:09', '2022-11-30 15:10:09'),
(405, 'App\\Models\\User', 50, 'MyAuthApp', '06f6e9011830bea731c1b0057845e2d0f0a61867d1db4d4e355692fe9eb0aac0', '[\"*\"]', '2022-11-30 15:10:16', '2022-11-30 15:10:14', '2022-11-30 15:10:16'),
(406, 'App\\Models\\User', 51, 'MyAuthApp', '10538a37effe2c3b817519993834790d437444a71ba8f4880135e405775a8783', '[\"*\"]', NULL, '2022-11-30 15:11:55', '2022-11-30 15:11:55'),
(407, 'App\\Models\\User', 51, 'MyAuthApp', '68b8d57e9039d7fa2723e38988f440b227d1e34c48160d7dc95d061e46f62a39', '[\"*\"]', '2022-11-30 15:12:04', '2022-11-30 15:12:03', '2022-11-30 15:12:04'),
(408, 'App\\Models\\User', 52, 'MyAuthApp', 'ce760b0a732bbe6ce0396011b6c0eb5fe4eec6610c5f650005e487b6cfe99962', '[\"*\"]', NULL, '2022-11-30 15:14:57', '2022-11-30 15:14:57'),
(409, 'App\\Models\\User', 52, 'MyAuthApp', 'aa50c24c1568e47df163df498f9b9eb40ae18ddbfee28688d8e9f6391f2d846f', '[\"*\"]', NULL, '2022-11-30 15:15:03', '2022-11-30 15:15:03'),
(410, 'App\\Models\\User', 52, 'MyAuthApp', '2df5a243f8003fb8e053a41026a8f47eb171a45580238d20ba23d976d5a9a816', '[\"*\"]', '2022-11-30 15:15:32', '2022-11-30 15:15:17', '2022-11-30 15:15:32'),
(411, 'App\\Models\\User', 53, 'MyAuthApp', 'd96a889ecf992c6a11e5dfd050978783ee1f89998b450c3407106d0b2ee47119', '[\"*\"]', NULL, '2022-11-30 15:17:07', '2022-11-30 15:17:07'),
(412, 'App\\Models\\User', 54, 'MyAuthApp', '66f843df1725fdce284ed1b100325bcd97cfb2153e25cbaa3312ca20fbae0338', '[\"*\"]', NULL, '2022-11-30 15:18:28', '2022-11-30 15:18:28'),
(413, 'App\\Models\\User', 54, 'MyAuthApp', '1b0e938dd04d596c34d1811bb208f5445264ee2154daac8d61e6fa7fc054774c', '[\"*\"]', '2022-11-30 15:18:36', '2022-11-30 15:18:34', '2022-11-30 15:18:36'),
(414, 'App\\Models\\User', 55, 'MyAuthApp', '4292c88bea3e4feab4f3dc908216074ae38b8c6d1746ccdf786bcced88a9fe0d', '[\"*\"]', NULL, '2022-11-30 15:19:08', '2022-11-30 15:19:08'),
(415, 'App\\Models\\User', 55, 'MyAuthApp', '930b8cb45aaa4d23342cc7ecc94df58d33320321f6a915fa09cfef3cad3dda1d', '[\"*\"]', '2022-11-30 15:20:46', '2022-11-30 15:19:14', '2022-11-30 15:20:46'),
(416, 'App\\Models\\User', 56, 'MyAuthApp', '3e9e500eaf299eb64b3b9e3522f36e776a2e645a99bb64fb552a4b90f1f2b34c', '[\"*\"]', NULL, '2022-11-30 15:21:01', '2022-11-30 15:21:01'),
(417, 'App\\Models\\User', 56, 'MyAuthApp', '5568bce9011aaf49bb580dfa055d1131a5984b9b03f58a9bfb1e7424e3d64c9f', '[\"*\"]', NULL, '2022-11-30 15:21:07', '2022-11-30 15:21:07'),
(418, 'App\\Models\\User', 56, 'MyAuthApp', '946415dab997404a7073324505ebb05320666974cc2378c6fad88ebb54248081', '[\"*\"]', NULL, '2022-11-30 15:21:17', '2022-11-30 15:21:17'),
(419, 'App\\Models\\User', 56, 'MyAuthApp', '36a8cf8308b81b90d56552b6c9af3cbbea936be131bb6248e3e707bff0d4d710', '[\"*\"]', '2022-11-30 15:25:33', '2022-11-30 15:21:26', '2022-11-30 15:25:33'),
(420, 'App\\Models\\User', 57, 'MyAuthApp', 'd0a5b479f4c1b8ee42c887ba34347e17ba3f4438bb7d717b63717458f2cb4ce3', '[\"*\"]', NULL, '2022-11-30 15:27:18', '2022-11-30 15:27:18'),
(421, 'App\\Models\\User', 57, 'MyAuthApp', '1a85913d73e742c44bdb353887940b735630ad0c1b26e6ebb00f4ee4127aed51', '[\"*\"]', '2022-11-30 15:27:26', '2022-11-30 15:27:24', '2022-11-30 15:27:26'),
(422, 'App\\Models\\User', 58, 'MyAuthApp', '5aaa8961f7dbf4990f8ab7a54767042cd210f33eea574e4378ae8e6f1a80ed2d', '[\"*\"]', NULL, '2022-11-30 15:29:07', '2022-11-30 15:29:07'),
(423, 'App\\Models\\User', 58, 'MyAuthApp', 'f6b2a5482137e5e0c3d31cac1c9a7fcfb38105b726738b0c84e9253571e38479', '[\"*\"]', '2022-11-30 15:29:15', '2022-11-30 15:29:13', '2022-11-30 15:29:15'),
(424, 'App\\Models\\User', 59, 'MyAuthApp', '3461ea8b7139b7e59ebd7f00b0cd93fa8a4c50b45da41fc9a34a7c7d738e53ca', '[\"*\"]', NULL, '2022-11-30 15:33:15', '2022-11-30 15:33:15'),
(425, 'App\\Models\\User', 59, 'MyAuthApp', '98ed927a70535bc65ff3c917603facd5cfe28b66e32a4bfef408bc76a4a96a05', '[\"*\"]', NULL, '2022-11-30 15:33:22', '2022-11-30 15:33:22'),
(426, 'App\\Models\\User', 59, 'MyAuthApp', '003011326a27a92c9ce539f3b6c31bde933be0c5adc703cd4046bb5ddb0f062f', '[\"*\"]', NULL, '2022-11-30 15:33:41', '2022-11-30 15:33:41'),
(427, 'App\\Models\\User', 59, 'MyAuthApp', '91a5c7847c09d0c0486eb5efcfc0acec92f5b9d9c0c481de2062bfa72db3794b', '[\"*\"]', '2022-11-30 15:34:11', '2022-11-30 15:33:49', '2022-11-30 15:34:11'),
(428, 'App\\Models\\User', 60, 'MyAuthApp', '7a4a74dc1106449d48e29ef68f4dbfff4fed1515369716429d0c4eea772adcdb', '[\"*\"]', NULL, '2022-11-30 15:34:44', '2022-11-30 15:34:44'),
(429, 'App\\Models\\User', 60, 'MyAuthApp', '4e86942bd8374a92f675192db6af6146978f57fdecec89718fbc3bf37734912f', '[\"*\"]', '2022-11-30 15:35:03', '2022-11-30 15:34:49', '2022-11-30 15:35:03'),
(430, 'App\\Models\\User', 20, 'MyAuthApp', '10c4e14734a67bbe56b6afc2595274d5a7ee3855ca3b77ac115a0cf701d61ca7', '[\"*\"]', NULL, '2022-11-30 15:36:14', '2022-11-30 15:36:14'),
(431, 'App\\Models\\User', 20, 'MyAuthApp', '092bc48a109624daccd80cb4ea591138bb0c6c0d5cccf54d1fdc708c2a2bec31', '[\"*\"]', '2022-11-30 15:36:57', '2022-11-30 15:36:17', '2022-11-30 15:36:57'),
(432, 'App\\Models\\User', 20, 'MyAuthApp', '650f6f8f0fd129393fdbe60a282e3db47470fbba468b507a372c577184b31f46', '[\"*\"]', '2022-11-30 15:37:40', '2022-11-30 15:37:23', '2022-11-30 15:37:40'),
(433, 'App\\Models\\User', 20, 'MyAuthApp', '2bad310d4c8ac934d4157f9fdcb3dde9b1fedf95cda3ed422e36493091da546d', '[\"*\"]', '2022-11-30 15:37:50', '2022-11-30 15:37:49', '2022-11-30 15:37:50'),
(434, 'App\\Models\\User', 20, 'MyAuthApp', '66059c032b672d372479a298da414504de1fc4e9b0f8b2e04cd9cfe20fdd2ed3', '[\"*\"]', '2022-11-30 15:38:07', '2022-11-30 15:38:05', '2022-11-30 15:38:07'),
(435, 'App\\Models\\User', 20, 'MyAuthApp', 'c39cc4718eca3ab19396801780bc51f7ed66cd1a8080d77e62e995728b42a2c9', '[\"*\"]', NULL, '2022-11-30 15:39:41', '2022-11-30 15:39:41'),
(436, 'App\\Models\\User', 20, 'MyAuthApp', 'ab6d37a4b3d870ab77929f8c54f6122c63cc88c286c704d7c4abf0f96fc63705', '[\"*\"]', NULL, '2022-11-30 15:39:54', '2022-11-30 15:39:54'),
(437, 'App\\Models\\User', 20, 'MyAuthApp', 'e0b5fa426e27fea78130510ff7141a5dc4019a135c173377d15f71b19fb2b525', '[\"*\"]', '2022-11-30 15:41:00', '2022-11-30 15:40:15', '2022-11-30 15:41:00'),
(438, 'App\\Models\\User', 20, 'MyAuthApp', '29785014563cf9d039f487f79d640d7ab9b9b85aeea69de0ec5f81fdd3244ad1', '[\"*\"]', '2022-11-30 15:42:17', '2022-11-30 15:42:15', '2022-11-30 15:42:17'),
(439, 'App\\Models\\User', 20, 'MyAuthApp', '69bc24e059c7f596729a4c06b6abb80b2458e15a39e66724241fa9fa3e2a527e', '[\"*\"]', '2022-11-30 15:42:30', '2022-11-30 15:42:28', '2022-11-30 15:42:30'),
(440, 'App\\Models\\User', 20, 'MyAuthApp', '5d6bc6c50d4453d64ef6927658f6a6e452948e591f4a8307ecc98ce4fbfca88d', '[\"*\"]', '2022-11-30 15:42:49', '2022-11-30 15:42:48', '2022-11-30 15:42:49'),
(441, 'App\\Models\\User', 20, 'MyAuthApp', 'f4fe2d022ff30026d81577c193de966f30f336fe2bb0a79e273aa00ae7bef37b', '[\"*\"]', '2022-11-30 15:43:03', '2022-11-30 15:43:01', '2022-11-30 15:43:03'),
(442, 'App\\Models\\User', 20, 'MyAuthApp', '5ca16e48010eb11a8a3ebf6e39c97640a8b182c261bd72d9eff978aca497f43c', '[\"*\"]', '2022-11-30 15:44:48', '2022-11-30 15:43:22', '2022-11-30 15:44:48'),
(443, 'App\\Models\\User', 20, 'MyAuthApp', '4dd23184855aa93242f0066222d9bf2d978b0667162644434a39df7f177f8e53', '[\"*\"]', '2022-11-30 15:45:05', '2022-11-30 15:45:03', '2022-11-30 15:45:05'),
(444, 'App\\Models\\User', 20, 'MyAuthApp', 'b6976ae692631391a7f3a0be755420102a04af327cb014884be5c6ef022ed524', '[\"*\"]', '2022-11-30 15:58:42', '2022-11-30 15:58:08', '2022-11-30 15:58:42'),
(445, 'App\\Models\\User', 20, 'MyAuthApp', 'a743a97fb294569f75b8a45539ba182427f7fd43398e59bf54b717c1472fd9fc', '[\"*\"]', '2022-11-30 15:59:02', '2022-11-30 15:59:00', '2022-11-30 15:59:02'),
(446, 'App\\Models\\User', 61, 'MyAuthApp', '7cdbfc064ecdd76918c15c5b179555628a0df78aa32fcc9a23b810d80c5e8ff5', '[\"*\"]', NULL, '2022-11-30 16:00:15', '2022-11-30 16:00:15'),
(447, 'App\\Models\\User', 61, 'MyAuthApp', '0a0374c228ec662bc143165ead5d06cff3314a6bec620f69d27bb90b4a0aa590', '[\"*\"]', '2022-11-30 16:00:42', '2022-11-30 16:00:21', '2022-11-30 16:00:42'),
(448, 'App\\Models\\User', 61, 'MyAuthApp', '210acf8531e52d1130c0b944164a18aec3704ccca0fda792af082ab1cb90f6a2', '[\"*\"]', '2022-11-30 16:16:12', '2022-11-30 16:01:23', '2022-11-30 16:16:12'),
(449, 'App\\Models\\User', 61, 'MyAuthApp', '596947311576bbb87ed24b99e88c12b0b5a40710b761c81e865258d563abecfe', '[\"*\"]', '2022-11-30 17:10:43', '2022-11-30 16:17:37', '2022-11-30 17:10:43'),
(450, 'App\\Models\\User', 47, 'MyAuthApp', 'a4e93d7d941e5c234c8a1eb77e5438dda567070267df8ab36f4244e9dfe86360', '[\"*\"]', '2022-12-02 14:44:49', '2022-11-30 16:39:46', '2022-12-02 14:44:49'),
(451, 'App\\Models\\User', 19, 'MyAuthApp', '07fd5cb904a643126f03ad5d4ac92031ba68416ff81edd83a387b673db6f9893', '[\"*\"]', '2022-12-01 12:09:22', '2022-11-30 16:47:23', '2022-12-01 12:09:22'),
(452, 'App\\Models\\User', 61, 'MyAuthApp', 'cd90551d1df7dd5d096dc567f38a25658be0c7f40f8fcc7ce0c187d0fa9e353a', '[\"*\"]', '2022-11-30 17:14:33', '2022-11-30 17:12:25', '2022-11-30 17:14:33'),
(453, 'App\\Models\\User', 61, 'MyAuthApp', '254ffe34a3ec634fab9cda19004235a5ef240240326ba5faedceb7df268af331', '[\"*\"]', '2022-11-30 17:18:11', '2022-11-30 17:16:30', '2022-11-30 17:18:11'),
(454, 'App\\Models\\User', 20, 'MyAuthApp', 'bbd0796961ff84821beb59b180dfe0eeaefb5fcf079657b869422e2895223397', '[\"*\"]', '2022-12-02 09:58:57', '2022-11-30 17:16:32', '2022-12-02 09:58:57'),
(455, 'App\\Models\\User', 61, 'MyAuthApp', '011e0fd713f38958b473d5d5a8e26387116c277cee05c6a267ac6925ca35eea3', '[\"*\"]', '2022-12-01 10:13:29', '2022-11-30 17:20:37', '2022-12-01 10:13:29'),
(456, 'App\\Models\\User', 20, 'MyAuthApp', 'bb2b38e1cbd8428424484ed9477e16ece113b7559112861ef9afb6b95351ee56', '[\"*\"]', '2022-12-01 18:37:54', '2022-11-30 17:44:27', '2022-12-01 18:37:54'),
(457, 'App\\Models\\User', 20, 'MyAuthApp', '7a01fe9ea04901df509a8b4f577af4e9a02391ce2c341d0fa031f6d1f25c6606', '[\"*\"]', '2022-12-02 14:52:59', '2022-11-30 17:53:45', '2022-12-02 14:52:59'),
(458, 'App\\Models\\User', 61, 'MyAuthApp', '385f6cf934c66f24d1878a88709ae89afb404d232fa15a4865cee56af9e20b22', '[\"*\"]', '2022-12-01 12:31:17', '2022-12-01 10:36:02', '2022-12-01 12:31:17'),
(459, 'App\\Models\\User', 20, 'MyAuthApp', '398bd22def1cb969e64290cb5b0045f3679dd430576c70899be6b7e6911268d5', '[\"*\"]', '2022-12-01 12:32:09', '2022-12-01 12:32:02', '2022-12-01 12:32:09'),
(460, 'App\\Models\\User', 48, 'MyAuthApp', '4bdac7d2df254c87ceba7ced2f7f5cfeb34448466b5902ceaf5b5b3067ab7538', '[\"*\"]', '2022-12-01 16:23:42', '2022-12-01 12:32:57', '2022-12-01 16:23:42'),
(461, 'App\\Models\\User', 62, 'MyAuthApp', 'ee5eaaa5df09bf046c97cfbf407fe179dcd43367e111853a38dbd98bb8fa0cce', '[\"*\"]', NULL, '2022-12-01 14:34:44', '2022-12-01 14:34:44'),
(462, 'App\\Models\\User', 63, 'MyAuthApp', '2b46d088aebe7bcf5e7c87e6d5f75a441d6e6ee40a34517e4b946bc9dc9ba8b7', '[\"*\"]', NULL, '2022-12-01 17:46:19', '2022-12-01 17:46:19'),
(463, 'App\\Models\\User', 19, 'MyAuthApp', '8123099103495ba8ec4d66e98472656247e93dc5d3d955750003829b00b0ff7b', '[\"*\"]', NULL, '2022-12-01 18:21:33', '2022-12-01 18:21:33'),
(464, 'App\\Models\\User', 50, 'MyAuthApp', 'f23cd403ae0503918e76de74787b863ed0f5bfe18743c475a7f0859f64c57015', '[\"*\"]', '2022-12-02 11:15:24', '2022-12-02 10:21:25', '2022-12-02 11:15:24'),
(465, 'App\\Models\\User', 54, 'MyAuthApp', 'e4c67f7eff2cf09585cd0444a9a56a2f1123dc44a6656287271814fe9e32b005', '[\"*\"]', '2023-01-12 11:37:42', '2022-12-02 10:41:45', '2023-01-12 11:37:42'),
(466, 'App\\Models\\User', 61, 'MyAuthApp', '67a5b6fb8a87d1f177a45c7278df7827123dbb95e782959620fa4c4c5a8597b5', '[\"*\"]', '2022-12-02 12:38:20', '2022-12-02 12:31:51', '2022-12-02 12:38:20'),
(467, 'App\\Models\\User', 61, 'MyAuthApp', '489c4c0869075282d4b81924a66ee7bb8beeed11e6dbff106affc66fbef5d5b8', '[\"*\"]', '2022-12-02 13:48:35', '2022-12-02 13:48:20', '2022-12-02 13:48:35'),
(468, 'App\\Models\\User', 64, 'MyAuthApp', 'f6c4254dd8cf63da8bf239524223ee178b86c0e4bfc5cdd0bfab9e8ceffb7af6', '[\"*\"]', NULL, '2022-12-02 13:49:24', '2022-12-02 13:49:24'),
(469, 'App\\Models\\User', 64, 'MyAuthApp', '9e250cbad15fc5aba93fc06d19c712c21b034408496e429ce00235732f666792', '[\"*\"]', '2022-12-02 13:58:52', '2022-12-02 13:49:29', '2022-12-02 13:58:52'),
(470, 'App\\Models\\User', 19, 'MyAuthApp', '22c9cd45bcaf78483bdc9381b390b00537d149e6e80ab933f5050be3206970b9', '[\"*\"]', '2022-12-02 14:07:17', '2022-12-02 13:53:47', '2022-12-02 14:07:17'),
(471, 'App\\Models\\User', 64, 'MyAuthApp', 'd6ef6fe566cd65f9711d2bacdc571e9ca4aa1674eb54156b7f83fe367557733f', '[\"*\"]', '2022-12-02 13:59:09', '2022-12-02 13:59:08', '2022-12-02 13:59:09'),
(472, 'App\\Models\\User', 64, 'MyAuthApp', '22b7aaf8da275def32f26214591cc00bc7d7d1e822f0e324882709e59f8d2ed6', '[\"*\"]', '2022-12-02 18:18:46', '2022-12-02 14:00:53', '2022-12-02 18:18:46'),
(473, 'App\\Models\\User', 65, 'MyAuthApp', 'e0594606c082759fcc118f53162cd7fc833feaf26f60a6bf4f7ddd1d0628ba78', '[\"*\"]', NULL, '2022-12-02 15:10:58', '2022-12-02 15:10:58'),
(474, 'App\\Models\\User', 65, 'MyAuthApp', 'a8ed01d71d0b1e4e91b3a1fd31a434b8682f5184c818a1ada767ed35eb0e21e5', '[\"*\"]', '2022-12-12 12:23:53', '2022-12-02 15:11:06', '2022-12-12 12:23:53'),
(475, 'App\\Models\\User', 48, 'MyAuthApp', '3f5c98287ecbfddb6bcc456b03b899eb2f840e457b715a0c84babf703a0e72ad', '[\"*\"]', '2022-12-02 18:19:11', '2022-12-02 18:19:09', '2022-12-02 18:19:11'),
(476, 'App\\Models\\User', 61, 'MyAuthApp', 'f68780a814320cfa15149101a23ace8bba63ad13d56f4986998afad54ab17ad2', '[\"*\"]', '2022-12-05 17:38:37', '2022-12-02 18:25:28', '2022-12-05 17:38:37'),
(477, 'App\\Models\\User', 19, 'MyAuthApp', 'b4305aaf62af9293b7ec2f06c99fabb236808b8f23defdad945e1d2fe489f519', '[\"*\"]', '2022-12-05 10:26:14', '2022-12-05 10:26:05', '2022-12-05 10:26:14'),
(478, 'App\\Models\\User', 19, 'MyAuthApp', '8a32b93758fffaf0cf50b5fcdd81c59050335fcc3add43050eee2aff79e226ae', '[\"*\"]', '2022-12-17 15:55:33', '2022-12-05 11:10:46', '2022-12-17 15:55:33'),
(479, 'App\\Models\\User', 66, 'MyAuthApp', '2571013f874c97065775864f781ded267ca9c27af5fc8b1d67b0b617c4e80b6b', '[\"*\"]', NULL, '2022-12-05 12:14:36', '2022-12-05 12:14:36'),
(480, 'App\\Models\\User', 66, 'MyAuthApp', '5765ad2888bfabf859c46760bb60e942963f864518acf9bdba2689ac6b1e8c9e', '[\"*\"]', NULL, '2022-12-05 12:15:17', '2022-12-05 12:15:17'),
(481, 'App\\Models\\User', 67, 'MyAuthApp', '42bd8dcb7883dcad7939f7a25f5b1e53e8a2e94a31490077b0c838c9d13cbbbc', '[\"*\"]', NULL, '2022-12-05 15:00:59', '2022-12-05 15:00:59'),
(482, 'App\\Models\\User', 67, 'MyAuthApp', '345c91ed8efa5594b5aeb286c605c696ca49ca6f22083108d5dd13aae1a3977c', '[\"*\"]', NULL, '2022-12-05 15:01:09', '2022-12-05 15:01:09'),
(483, 'App\\Models\\User', 67, 'MyAuthApp', 'd1bff2ac8553f598b43950d1e49ba9662a896bd4022864694fe7684fafb08e83', '[\"*\"]', NULL, '2022-12-05 15:03:54', '2022-12-05 15:03:54'),
(484, 'App\\Models\\User', 68, 'MyAuthApp', '312c77b7f5b47a90d20d4250a3cf103abdc0c9a14b1999bc70e284286c36b61c', '[\"*\"]', NULL, '2022-12-05 15:12:55', '2022-12-05 15:12:55'),
(485, 'App\\Models\\User', 68, 'MyAuthApp', 'd8f01d7fa5b1c72b04cd0140f57cb0dfd99c9f5e561e5f70c89dc4b3fff460bf', '[\"*\"]', NULL, '2022-12-05 15:13:11', '2022-12-05 15:13:11'),
(486, 'App\\Models\\User', 69, 'MyAuthApp', '1a2e762e2c2f8ffe91a47260e5ad1d6e80da7b90db4166869393d0c24d328297', '[\"*\"]', NULL, '2022-12-05 15:14:17', '2022-12-05 15:14:17'),
(487, 'App\\Models\\User', 64, 'MyAuthApp', '4c0a225529667c3d30e733c8d4470dff85d01f68c76731da6f2fe71d4e1391c7', '[\"*\"]', '2022-12-05 17:59:03', '2022-12-05 17:39:04', '2022-12-05 17:59:03'),
(488, 'App\\Models\\User', 70, 'MyAuthApp', '8d38e621ccd8a405dd8e7e660783e56c5b0ce4f929a966248211b87f9714068a', '[\"*\"]', NULL, '2022-12-05 21:22:14', '2022-12-05 21:22:14'),
(489, 'App\\Models\\User', 70, 'MyAuthApp', 'ff21473373214fedb5c394a11e226216deee99df155008fe78604656f2edb350', '[\"*\"]', NULL, '2022-12-05 21:22:55', '2022-12-05 21:22:55'),
(490, 'App\\Models\\User', 64, 'MyAuthApp', 'ba2a02abd8477c92fefd8adb513c04e9422f5fce8e10bbae3a13f0536ee650b7', '[\"*\"]', '2022-12-06 13:39:53', '2022-12-06 12:11:18', '2022-12-06 13:39:53'),
(491, 'App\\Models\\User', 61, 'MyAuthApp', '523f2a0a77b652ad2213c44818a15439ecf59d580c81bedd27c6fd30e96e6143', '[\"*\"]', '2022-12-06 15:39:11', '2022-12-06 13:41:17', '2022-12-06 15:39:11'),
(492, 'App\\Models\\User', 61, 'MyAuthApp', '737a04420fe4536a1cb36ed093815909e6b0a085840ba6f6cc86cc581e36c4e1', '[\"*\"]', '2022-12-06 14:18:32', '2022-12-06 13:51:01', '2022-12-06 14:18:32'),
(493, 'App\\Models\\User', 61, 'MyAuthApp', 'c3828d565ff62b86a08d8a1feaae42011fb6c49b6e241b159b9ecef493338ddf', '[\"*\"]', '2022-12-07 11:07:23', '2022-12-06 14:09:49', '2022-12-07 11:07:23'),
(494, 'App\\Models\\User', 61, 'MyAuthApp', '2b89bfc0a7c6145e47a3a955f77499c41ddd9a69c8693bd8b8aa4137ebb9b4b0', '[\"*\"]', '2022-12-06 14:15:13', '2022-12-06 14:14:53', '2022-12-06 14:15:13'),
(495, 'App\\Models\\User', 71, 'MyAuthApp', '7da3e40781d311feaba42bd14ea9c6ccfe0fa43f5562639ba4fb5a0c3d373938', '[\"*\"]', NULL, '2022-12-06 14:20:54', '2022-12-06 14:20:54'),
(496, 'App\\Models\\User', 71, 'MyAuthApp', '0014c2bb75e019c8e807721c774a1c0b7cf416da52abfd5aacc5757e3d6a604e', '[\"*\"]', NULL, '2022-12-06 14:21:18', '2022-12-06 14:21:18'),
(497, 'App\\Models\\User', 71, 'MyAuthApp', 'a14359c2cb693feae6b3af95436a3fec6abc8e87f857ee1150f008d4eae9aba8', '[\"*\"]', NULL, '2022-12-06 14:21:39', '2022-12-06 14:21:39'),
(498, 'App\\Models\\User', 71, 'MyAuthApp', 'a1e3c1daee0bca981c2bdeb918887a345f0bbf01763ac56a8c0d497a28e5e277', '[\"*\"]', '2022-12-06 15:26:51', '2022-12-06 14:22:48', '2022-12-06 15:26:51'),
(499, 'App\\Models\\User', 15, 'MyAuthApp', '7d8d86c4bde28c0683f85c01d7f00d8359f51b0f4c22698ae917fc9f4be763b1', '[\"*\"]', '2022-12-06 14:29:09', '2022-12-06 14:27:01', '2022-12-06 14:29:09'),
(500, 'App\\Models\\User', 61, 'MyAuthApp', '841aae5ebd6c44512cd7c9d670c4f4f0755711a61424bcecee6c69513c73d7f1', '[\"*\"]', '2022-12-06 15:45:24', '2022-12-06 15:40:06', '2022-12-06 15:45:24'),
(501, 'App\\Models\\User', 59, 'MyAuthApp', 'beb259c0bfba7d3d6b683a9e4a861598e8e7d4c147d50da27198a6d4a2c07f84', '[\"*\"]', '2022-12-06 16:04:44', '2022-12-06 15:47:40', '2022-12-06 16:04:44'),
(502, 'App\\Models\\User', 59, 'MyAuthApp', 'd1ca4bf4dc7333711689942318eb192c67f50dbd17eaf61ece125d1cf7d87b4e', '[\"*\"]', '2022-12-06 16:05:24', '2022-12-06 16:05:11', '2022-12-06 16:05:24'),
(503, 'App\\Models\\User', 61, 'MyAuthApp', 'f099e406301b8f2fc864e113ba315907e0c21ca57563addfdb8113c9a5355a95', '[\"*\"]', '2022-12-06 16:24:43', '2022-12-06 16:05:45', '2022-12-06 16:24:43'),
(504, 'App\\Models\\User', 59, 'MyAuthApp', '0be23de28564b04f75ecf69d9915ef831b49cd41f52379d12b031415ffb0bb1e', '[\"*\"]', '2022-12-06 16:26:42', '2022-12-06 16:26:41', '2022-12-06 16:26:42'),
(505, 'App\\Models\\User', 61, 'MyAuthApp', 'f3736d3bf3b8377f18d46ffec33a232733a17c0ea73cd55bb05e5f12d495a282', '[\"*\"]', '2022-12-07 15:44:05', '2022-12-06 16:30:37', '2022-12-07 15:44:05'),
(506, 'App\\Models\\User', 19, 'MyAuthApp', '78e7a880c5d5d5d0ac3e63b1ccde05dbe2c373bfadd1cb70e88ff665360e8d2c', '[\"*\"]', NULL, '2022-12-07 12:41:04', '2022-12-07 12:41:04'),
(507, 'App\\Models\\User', 19, 'MyAuthApp', '699ec084e4e87508a25d6aa3317472e3c1dd711469208763ada7f45e56e598af', '[\"*\"]', NULL, '2022-12-07 12:41:44', '2022-12-07 12:41:44'),
(508, 'App\\Models\\User', 19, 'MyAuthApp', '19f10dd6d2d8c53c060dbe739c6bb52de6d6c5ca3506f6bcb848d15733b937e7', '[\"*\"]', NULL, '2022-12-07 12:43:37', '2022-12-07 12:43:37'),
(509, 'App\\Models\\User', 19, 'MyAuthApp', 'e230985d4c8af40feca5b5948abc5a623726af6cf52ab71e79a0b15dae8d1d4c', '[\"*\"]', NULL, '2022-12-07 12:44:23', '2022-12-07 12:44:23'),
(510, 'App\\Models\\User', 72, 'MyAuthApp', '0cfd0de1583ea2496ea82c13edfb3c49079afa27f22ac7e820dcfd9b3815e645', '[\"*\"]', NULL, '2022-12-07 15:50:00', '2022-12-07 15:50:00'),
(511, 'App\\Models\\User', 61, 'MyAuthApp', 'e83d3c609fbcc6ae55d0416350b3b024436813cb03a60fbb26027d90946f1a1a', '[\"*\"]', '2022-12-08 18:24:57', '2022-12-08 16:36:35', '2022-12-08 18:24:57'),
(512, 'App\\Models\\User', 59, 'MyAuthApp', '7625749877a8aafc9d780511beebe4b2a353f1713161332bee3b2124dfc49e4f', '[\"*\"]', '2022-12-14 10:07:32', '2022-12-08 18:25:52', '2022-12-14 10:07:32'),
(513, 'App\\Models\\User', 73, 'MyAuthApp', 'fc152c4486d7a6c1610440b0bd3ef9a5d4b2be1072523cbc0cb8f1c09a66cd33', '[\"*\"]', NULL, '2022-12-09 17:46:37', '2022-12-09 17:46:37'),
(514, 'App\\Models\\User', 19, 'MyAuthApp', 'a023b17f72344beecb3802aec019d917b0f55908aabd236e010e9758dd9ea1f2', '[\"*\"]', NULL, '2022-12-12 11:23:47', '2022-12-12 11:23:47'),
(515, 'App\\Models\\User', 19, 'MyAuthApp', 'a21d29a1784b5d9bad20e38ae99c15dad6764e78a0a04805602ca9cd79e44703', '[\"*\"]', NULL, '2022-12-12 11:35:09', '2022-12-12 11:35:09'),
(516, 'App\\Models\\User', 19, 'MyAuthApp', '884c5aa57ae4459a0afd3b1ca0604a339cef6a63ae795c4869287262e024a7d7', '[\"*\"]', NULL, '2022-12-12 11:58:15', '2022-12-12 11:58:15'),
(517, 'App\\Models\\User', 19, 'MyAuthApp', '84705abd08158fe6cc0cb3847c5b39e265044e4a1e6304b7396afcf084f88bfe', '[\"*\"]', NULL, '2022-12-12 12:06:09', '2022-12-12 12:06:09'),
(518, 'App\\Models\\User', 74, 'MyAuthApp', 'b5b998596366e3c917ddfd694571ecf637af2f622336808fb387deadc3fdd5e5', '[\"*\"]', NULL, '2022-12-12 12:28:20', '2022-12-12 12:28:20'),
(519, 'App\\Models\\User', 19, 'MyAuthApp', '9676e02e3adab3020cee322c2d51a4fcaf65c304080de9926d9c40ffe0825c1e', '[\"*\"]', NULL, '2022-12-12 13:40:03', '2022-12-12 13:40:03'),
(520, 'App\\Models\\User', 19, 'MyAuthApp', 'ff903728813c4586865eb672438459485b0046c886510efb0e827c70123ac00f', '[\"*\"]', NULL, '2022-12-12 14:20:32', '2022-12-12 14:20:32'),
(521, 'App\\Models\\User', 19, 'MyAuthApp', 'd35ca668aca7b86456bcfc1d73529f5542c32d9a89aa65331dcb3af77b41ed75', '[\"*\"]', NULL, '2022-12-12 14:22:11', '2022-12-12 14:22:11'),
(522, 'App\\Models\\User', 19, 'MyAuthApp', 'c1cdb67273f4882c1cfb0c905225f504b5891b7cf6d73db33b7c9bd8a3e4872b', '[\"*\"]', NULL, '2022-12-12 14:27:53', '2022-12-12 14:27:53'),
(523, 'App\\Models\\User', 75, 'MyAuthApp', 'a45ff0883ff96606a36a19c8ae00e5b6d5439c042206ce4cea91bfb7a89debea', '[\"*\"]', NULL, '2022-12-12 15:06:27', '2022-12-12 15:06:27'),
(524, 'App\\Models\\User', 76, 'MyAuthApp', '23768ac6c6ed4f31acff9c29236e5dc160e5bb15481189759c8f7ee9af998a73', '[\"*\"]', NULL, '2022-12-12 15:15:03', '2022-12-12 15:15:03'),
(525, 'App\\Models\\User', 77, 'MyAuthApp', '5e4013039e97bfec2dab6b46b1a454cbb37f41d3f0171f7ccd00b522b81b1067', '[\"*\"]', NULL, '2022-12-12 16:01:30', '2022-12-12 16:01:30'),
(526, 'App\\Models\\User', 78, 'MyAuthApp', 'f71554d8f98939f1722a227ff2573b8628fb135edb90751dc4b1fe92bc524c02', '[\"*\"]', NULL, '2022-12-12 16:04:27', '2022-12-12 16:04:27'),
(527, 'App\\Models\\User', 19, 'MyAuthApp', 'e4b292cd0225b6515682d49fc8a16ecb1ba8ce6039afcbc0ca4e9e6a819602b2', '[\"*\"]', '2022-12-12 18:55:27', '2022-12-12 18:53:06', '2022-12-12 18:55:27'),
(528, 'App\\Models\\User', 79, 'MyAuthApp', '40b523377844494bf2fd93e3f4ef24b923fcb7f9397d1ce3dfc5fa9c0d7d5f47', '[\"*\"]', NULL, '2022-12-13 10:22:23', '2022-12-13 10:22:23'),
(529, 'App\\Models\\User', 80, 'MyAuthApp', '9cfd9341d3f2e4f2feeab307b2abc36c99e57228976e7468d1c064efccc532d6', '[\"*\"]', NULL, '2022-12-13 10:23:09', '2022-12-13 10:23:09'),
(530, 'App\\Models\\User', 28, 'MyAuthApp', '38dce14ff9ecaeec80040f7fc067e23a835f4c9bb34e4171059efd9f871b505b', '[\"*\"]', NULL, '2022-12-13 10:27:50', '2022-12-13 10:27:50'),
(531, 'App\\Models\\User', 28, 'MyAuthApp', '776d535e329dba018a9b8f73c40fccc0ddbcb2cb4b449dd680988ac5b2b65f33', '[\"*\"]', '2022-12-15 11:33:29', '2022-12-13 10:28:32', '2022-12-15 11:33:29'),
(532, 'App\\Models\\User', 19, 'MyAuthApp', 'b3f4e411a9d8760f6068e7638ec597d000246e7da76bfed22c82356c52a33d82', '[\"*\"]', '2022-12-13 10:48:29', '2022-12-13 10:45:41', '2022-12-13 10:48:29'),
(533, 'App\\Models\\User', 81, 'MyAuthApp', 'd9108891ed347c62299cb08081bcf679dada8a188b67009eec14d659552d85c9', '[\"*\"]', NULL, '2022-12-13 11:53:55', '2022-12-13 11:53:55'),
(534, 'App\\Models\\User', 82, 'MyAuthApp', '9526d702d0ee67946a132cdbf828050888879502fd511c4e060113c16e40499f', '[\"*\"]', NULL, '2022-12-13 12:04:10', '2022-12-13 12:04:10'),
(535, 'App\\Models\\User', 83, 'MyAuthApp', 'dbfb989ed46197e9812d97338a53eb3cb1060c611068c0dd68d88ff334dc1c08', '[\"*\"]', NULL, '2022-12-13 12:07:07', '2022-12-13 12:07:07'),
(536, 'App\\Models\\User', 84, 'MyAuthApp', 'bd6fee29539dee6afac919de4e0d35bd4a71b08ecf69797ac94a7c403ec6f461', '[\"*\"]', NULL, '2022-12-13 12:09:54', '2022-12-13 12:09:54'),
(537, 'App\\Models\\User', 85, 'MyAuthApp', 'b140c64c63fab6435ffe3d17b6c2fc0891380246cfa26be5ff63513421e8d934', '[\"*\"]', NULL, '2022-12-13 12:11:56', '2022-12-13 12:11:56'),
(538, 'App\\Models\\User', 89, 'MyAuthApp', '7fd4aa6d7210e4147567807a56b4e574610503b714c5242c5fdb4317dd80b527', '[\"*\"]', NULL, '2022-12-13 12:36:32', '2022-12-13 12:36:32'),
(539, 'App\\Models\\User', 87, 'MyAuthApp', '411b39e1905b806004ff0d9266d181304055bdcedd79c5d7ae3198f56524423d', '[\"*\"]', '2022-12-13 12:36:34', '2022-12-13 12:36:32', '2022-12-13 12:36:34'),
(540, 'App\\Models\\User', 86, 'MyAuthApp', '8ae3bb0a47ec6d82f5d92deb9c2bdd72ab62389abc4d2c9471a8bfb362225121', '[\"*\"]', NULL, '2022-12-13 12:36:32', '2022-12-13 12:36:32'),
(541, 'App\\Models\\User', 88, 'MyAuthApp', '62c73bc40a05f953d1840dbbec17ab8a6ce373b705d4916a026ebec4572a8f2c', '[\"*\"]', NULL, '2022-12-13 12:36:32', '2022-12-13 12:36:32'),
(542, 'App\\Models\\User', 90, 'MyAuthApp', '99dde2f344622e1cb474a949fddf3f1f5c19761e464eaae94447cf2820d0b779', '[\"*\"]', '2022-12-13 12:41:27', '2022-12-13 12:38:57', '2022-12-13 12:41:27'),
(543, 'App\\Models\\User', 91, 'MyAuthApp', '83031492402bb7658ed757b23d080fbc4564e35e5b1231f3c51f0a20267d1efd', '[\"*\"]', '2022-12-13 12:47:32', '2022-12-13 12:47:30', '2022-12-13 12:47:32'),
(544, 'App\\Models\\User', 92, 'MyAuthApp', '4ef5678a13bcc6170ed8aa4411cfc7fc74824398fe3587166001bbcbed24a8fe', '[\"*\"]', '2022-12-13 13:02:40', '2022-12-13 13:02:03', '2022-12-13 13:02:40'),
(545, 'App\\Models\\User', 92, 'MyAuthApp', '22a6bfeb188cf84553f76d086aa946124a1b0fb65d160e25c93586102e634e71', '[\"*\"]', '2022-12-13 13:03:33', '2022-12-13 13:03:30', '2022-12-13 13:03:33'),
(546, 'App\\Models\\User', 93, 'MyAuthApp', '55278016e7b708e945921541e41cdeea7ba315d41924fda8523932b35a1fbfd6', '[\"*\"]', NULL, '2022-12-13 16:31:21', '2022-12-13 16:31:21'),
(547, 'App\\Models\\User', 94, 'MyAuthApp', 'e923f34741acb4763c4d98df3bc712f71fc9655716718d786fa62ea12a23c06a', '[\"*\"]', '2022-12-13 17:10:15', '2022-12-13 17:10:13', '2022-12-13 17:10:15'),
(548, 'App\\Models\\User', 95, 'MyAuthApp', 'c4a9d84a67746de80ba75e6641538bb3a28ad157f39e2a03ca6b74c30466d69b', '[\"*\"]', '2022-12-13 17:22:27', '2022-12-13 17:22:26', '2022-12-13 17:22:27'),
(549, 'App\\Models\\User', 96, 'MyAuthApp', 'fce28970c941dcb3a04ead4511bae81a5d9f5d31bebf6337d154534c2db09b89', '[\"*\"]', NULL, '2022-12-13 17:28:56', '2022-12-13 17:28:56'),
(550, 'App\\Models\\User', 97, 'MyAuthApp', 'da3bdb5e17425f9b71d937242b59742f3df9529b9620e7fa17102b5f0d1e0ade', '[\"*\"]', NULL, '2022-12-13 17:30:10', '2022-12-13 17:30:10'),
(551, 'App\\Models\\User', 98, 'MyAuthApp', '529cb15786a0247bbc2c24f4344916a232796dd0060ab7b1adcf38c847d64954', '[\"*\"]', '2022-12-13 17:55:48', '2022-12-13 17:55:46', '2022-12-13 17:55:48'),
(552, 'App\\Models\\User', 19, 'MyAuthApp', '82009a8ce43b27a297fb167660f1107fff0fc5bc3590041cbbb61883b0992396', '[\"*\"]', '2022-12-14 18:35:55', '2022-12-14 10:08:13', '2022-12-14 18:35:55'),
(553, 'App\\Models\\User', 20, 'MyAuthApp', 'a1e5effd9922b015f43da47b57b3f7aa83c2b2ff436a82b5837c3e5a6728bdea', '[\"*\"]', '2022-12-14 16:35:52', '2022-12-14 10:31:28', '2022-12-14 16:35:52'),
(554, 'App\\Models\\User', 20, 'MyAuthApp', '21add2fd5da7f67c75839ea99758d21c1ebeae281db14033edbfe30ce0b84575', '[\"*\"]', '2022-12-15 10:24:41', '2022-12-14 11:01:10', '2022-12-15 10:24:41'),
(555, 'App\\Models\\User', 99, 'MyAuthApp', '052ee91c840ae288d9ee56f1904c2e1e7a2867126630f9881cee432c51a5b1bf', '[\"*\"]', '2022-12-14 14:02:43', '2022-12-14 14:02:41', '2022-12-14 14:02:43'),
(556, 'App\\Models\\User', 99, 'MyAuthApp', 'b447fdaf6b6bcc5d9e369d554510d37cdc5fcffe8f662a9088c27d33bd4de057', '[\"*\"]', '2022-12-14 14:12:08', '2022-12-14 14:11:14', '2022-12-14 14:12:08'),
(557, 'App\\Models\\User', 99, 'MyAuthApp', '7b8d78f325309dd6b6d9091a372c8a1e88258d2577185ba4323dd3a864e3c028', '[\"*\"]', '2022-12-14 18:42:21', '2022-12-14 14:12:33', '2022-12-14 18:42:21'),
(558, 'App\\Models\\User', 19, 'MyAuthApp', '4cc38466e6a1d24d22ac254346f6b08f30f25cac705f0ef4681761d49a2d8773', '[\"*\"]', '2022-12-15 18:57:27', '2022-12-14 15:38:13', '2022-12-15 18:57:27'),
(559, 'App\\Models\\User', 97, 'MyAuthApp', '0f202c02e96e1b8531a79c45676570dfb379f0a2b73f657c0c04f1295ac72876', '[\"*\"]', '2022-12-16 09:53:46', '2022-12-14 17:22:21', '2022-12-16 09:53:46'),
(560, 'App\\Models\\User', 20, 'MyAuthApp', '2f73e0840ecd1c7f64fc338f122aedae7112004e0d4593d4137ae8add71c1036', '[\"*\"]', '2022-12-15 12:16:44', '2022-12-15 10:55:33', '2022-12-15 12:16:44'),
(561, 'App\\Models\\User', 99, 'MyAuthApp', 'a32ad2ce8503a03cff83799564bf4a1f40355b37a09f4371c88f2f626f441ce7', '[\"*\"]', '2022-12-15 11:29:37', '2022-12-15 11:26:23', '2022-12-15 11:29:37'),
(562, 'App\\Models\\User', 100, 'MyAuthApp', 'fddfaf36d96ea11cfe16a5e5b45ad129605a307b1027558d3b8af28580083d55', '[\"*\"]', '2022-12-15 11:58:38', '2022-12-15 11:58:36', '2022-12-15 11:58:38'),
(563, 'App\\Models\\User', 100, 'MyAuthApp', '441c033cad8fadcf8f13dd1c275407efc85e3e315b27b4c8a8ff6c9b91f4c392', '[\"*\"]', '2022-12-15 12:02:06', '2022-12-15 12:02:04', '2022-12-15 12:02:06'),
(564, 'App\\Models\\User', 100, 'MyAuthApp', '9d03ca1174ad511f5604866d75e20ac1a5f6e2f7f29feb27bb0ed92e98ec8c94', '[\"*\"]', '2022-12-15 12:03:22', '2022-12-15 12:02:43', '2022-12-15 12:03:22'),
(565, 'App\\Models\\User', 100, 'MyAuthApp', 'c0967326cda20e8d5a4991e6133717ef5576cc3cda7836e2ad9a708c40a99078', '[\"*\"]', '2022-12-15 12:22:43', '2022-12-15 12:03:44', '2022-12-15 12:22:43'),
(566, 'App\\Models\\User', 54, 'MyAuthApp', '9a6384c377e1710b87d8a1921f78d523785a9094c7e0d87686cd157c52560486', '[\"*\"]', NULL, '2022-12-15 12:19:02', '2022-12-15 12:19:02'),
(567, 'App\\Models\\User', 54, 'MyAuthApp', '34145a71083746b3a88228667cf20067795dfdaa8605c05b6ed164ff72d12783', '[\"*\"]', '2022-12-16 16:12:53', '2022-12-15 12:19:22', '2022-12-16 16:12:53'),
(568, 'App\\Models\\User', 101, 'MyAuthApp', '7b1b233b3a08f6334b53c3d355da0a3d25054a4365f8e5d71b3810deb2a7b8b6', '[\"*\"]', '2022-12-15 12:38:22', '2022-12-15 12:27:32', '2022-12-15 12:38:22'),
(569, 'App\\Models\\User', 102, 'MyAuthApp', '07452747d8ac3958c0414326dc1a1dbacc59448c801f686c44663c8c078463a2', '[\"*\"]', '2022-12-15 17:48:30', '2022-12-15 12:41:47', '2022-12-15 17:48:30'),
(570, 'App\\Models\\User', 20, 'MyAuthApp', 'e3c30b9641fedc78c457ad5cef43b1e3bbb3571ba24c14b8248390a9eead6f3a', '[\"*\"]', '2022-12-15 15:59:55', '2022-12-15 13:48:34', '2022-12-15 15:59:55'),
(571, 'App\\Models\\User', 54, 'MyAuthApp', '6b5be29c415f06655095cc03db837b4a47d7a8c94e8bcbd90b7e8ddb1b147b0c', '[\"*\"]', '2022-12-15 17:43:23', '2022-12-15 16:23:18', '2022-12-15 17:43:23'),
(572, 'App\\Models\\User', 103, 'MyAuthApp', 'e88ba14d392cf06c380c5a49a9f873659fc61d7e352b62411ce525cfdbd95dd2', '[\"*\"]', '2022-12-15 18:05:58', '2022-12-15 18:05:55', '2022-12-15 18:05:58'),
(573, 'App\\Models\\User', 103, 'MyAuthApp', 'fc388804571430605b60e37bf3dca091437b38bec5cef264dbb9896685ab73c0', '[\"*\"]', '2022-12-15 18:07:20', '2022-12-15 18:06:40', '2022-12-15 18:07:20'),
(574, 'App\\Models\\User', 103, 'MyAuthApp', '3226c2a0d09577c803d29cf12caca63c922f3cbfaf3f26be5c6e1f1820188afe', '[\"*\"]', '2022-12-15 18:53:10', '2022-12-15 18:07:54', '2022-12-15 18:53:10'),
(575, 'App\\Models\\User', 103, 'MyAuthApp', 'cdf8f2639c4c89f8edc9c15ab8d630cd363cab437dffb90297cbfcbeb175eacf', '[\"*\"]', '2022-12-15 19:18:01', '2022-12-15 18:31:00', '2022-12-15 19:18:01'),
(576, 'App\\Models\\User', 103, 'MyAuthApp', 'f776373b54dde56ecf6e03af1f622bb6b8d98617acdcdc34869b7c151f7edaf2', '[\"*\"]', '2022-12-15 21:36:01', '2022-12-15 19:57:42', '2022-12-15 21:36:01'),
(577, 'App\\Models\\User', 19, 'MyAuthApp', 'd93f676b625203cedc1e275d96e15a42b88f954861769d551a5745eb4e4ad517', '[\"*\"]', '2022-12-16 10:19:17', '2022-12-16 09:57:01', '2022-12-16 10:19:17');
INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(578, 'App\\Models\\User', 54, 'MyAuthApp', '776dd313c56c7e3eb531a19024f319262593362a9ab14ceb341db3c84ae267eb', '[\"*\"]', '2022-12-26 17:19:11', '2022-12-16 10:32:38', '2022-12-26 17:19:11'),
(579, 'App\\Models\\User', 54, 'MyAuthApp', '946a64a8dea2ec9427a4fc800632a6e2fad4e701937ba43ae86c6d3399d6b6ef', '[\"*\"]', '2022-12-19 15:16:06', '2022-12-16 10:42:21', '2022-12-19 15:16:06'),
(580, 'App\\Models\\User', 54, 'MyAuthApp', '94e177f36da21f7e9c1bf7816f1e9a2c12435032eb3bad8aea3b702e860d4ebe', '[\"*\"]', '2022-12-19 16:29:21', '2022-12-16 16:13:38', '2022-12-19 16:29:21'),
(581, 'App\\Models\\User', 54, 'MyAuthApp', 'ee04aeace3850d503ead2019eaad062640fe46b083f5c88a7e21595fd5fe121d', '[\"*\"]', '2022-12-16 17:02:02', '2022-12-16 16:43:35', '2022-12-16 17:02:02'),
(582, 'App\\Models\\User', 103, 'MyAuthApp', 'bfb5b8fcd8937a5f08f3733ff0501e84bc378ae0f5474ccef519c23cae19a002', '[\"*\"]', '2022-12-19 14:48:24', '2022-12-19 14:47:45', '2022-12-19 14:48:24'),
(583, 'App\\Models\\User', 18, 'MyAuthApp', '0a8e10a341e96d47070e941d53c4c058b1f0434842816e3f9487f348ebd185eb', '[\"*\"]', '2022-12-19 16:09:03', '2022-12-19 14:48:50', '2022-12-19 16:09:03'),
(584, 'App\\Models\\User', 54, 'MyAuthApp', '528732fdd48240fc26c70a8038bb79b633f2dff898438a76a6e8a556e7de911b', '[\"*\"]', '2022-12-19 16:38:10', '2022-12-19 16:33:39', '2022-12-19 16:38:10'),
(585, 'App\\Models\\User', 104, 'MyAuthApp', '6aea197d9857df2e33e8010d868d382a1944f2f20782f72ff66c56e2aca56515', '[\"*\"]', '2022-12-20 10:24:17', '2022-12-19 16:40:30', '2022-12-20 10:24:17'),
(586, 'App\\Models\\User', 104, 'MyAuthApp', 'c26226f03450a0ff563471b233322405f139f9da3c2b678202ec41d2e48895b6', '[\"*\"]', '2022-12-22 11:56:51', '2022-12-19 17:10:44', '2022-12-22 11:56:51'),
(587, 'App\\Models\\User', 105, 'MyAuthApp', '879ccf1f098c70d08c6b2684cf5aacbaefb59a14f199b8092f33d4a8f63f5c1a', '[\"*\"]', NULL, '2022-12-19 17:45:32', '2022-12-19 17:45:32'),
(588, 'App\\Models\\User', 104, 'MyAuthApp', '61b9faddb17547c6926e456f28a852cc90199733c08459b8fbbc7f0416cd1167', '[\"*\"]', '2022-12-20 13:59:46', '2022-12-20 10:09:45', '2022-12-20 13:59:46'),
(589, 'App\\Models\\User', 54, 'MyAuthApp', '785e9924d9b6a7b71b627bd72ce951d9c545270a61b721a24cc79823ed65df2d', '[\"*\"]', '2022-12-20 10:50:02', '2022-12-20 10:28:26', '2022-12-20 10:50:02'),
(590, 'App\\Models\\User', 104, 'MyAuthApp', '63903cdf0e15d7c5300371e01090c0859a8fe4d03f2716d0af7150be98387fc3', '[\"*\"]', '2022-12-22 11:24:27', '2022-12-20 10:50:52', '2022-12-22 11:24:27'),
(591, 'App\\Models\\User', 106, 'MyAuthApp', 'fd681beeaab9b6dd6291e94ac9b64552a011af5b315d551facacf67c0ff255e5', '[\"*\"]', '2022-12-22 11:34:53', '2022-12-22 11:34:50', '2022-12-22 11:34:53'),
(592, 'App\\Models\\User', 19, 'MyAuthApp', 'f9beafb65e6c0ce08f19e2bd985e7d274b9d4bd1f171af07fcb0b7c653fc7e20', '[\"*\"]', '2022-12-23 12:27:39', '2022-12-22 14:43:33', '2022-12-23 12:27:39'),
(593, 'App\\Models\\User', 19, 'MyAuthApp', '1ffd86b3b186135a5c224dec05654fe2f0169d7d0bf78da9f2340c70423b3f67', '[\"*\"]', '2022-12-22 12:58:38', '2022-12-22 10:04:28', '2022-12-22 12:58:38'),
(594, 'App\\Models\\User', 106, 'MyAuthApp', '4c302f51ee12a66784a10d7255a587b64b51f24165c075c4e90b514bfe345888', '[\"*\"]', '2022-12-22 10:08:45', '2022-12-22 10:08:42', '2022-12-22 10:08:45'),
(595, 'App\\Models\\User', 106, 'MyAuthApp', 'e413454ebd28204e67385b6edac03937c2dbbed92b0335762ce47341c40d3027', '[\"*\"]', '2022-12-22 11:57:06', '2022-12-22 04:52:47', '2022-12-22 11:57:06'),
(596, 'App\\Models\\User', 56, 'MyAuthApp', '5252334c4a54321c10bd0010b8a96c88b9f8fd30c5eae136e9825a36bf9bc97d', '[\"*\"]', '2022-12-22 12:37:43', '2022-12-22 11:04:42', '2022-12-22 12:37:43'),
(597, 'App\\Models\\User', 104, 'MyAuthApp', '2159735eaade9ae711bbcf7aa7c25cc3ccb08ea3e4a3270fe8bb8ffa4d3d860e', '[\"*\"]', '2022-12-22 11:59:44', '2022-12-22 11:58:35', '2022-12-22 11:59:44'),
(598, 'App\\Models\\User', 106, 'MyAuthApp', 'e684848cb8310202f119571c0ee03924a378ac9c63ac3974afa0f951dfc667f6', '[\"*\"]', '2022-12-22 12:04:28', '2022-12-22 12:00:40', '2022-12-22 12:04:28'),
(599, 'App\\Models\\User', 106, 'MyAuthApp', 'cb693df93a56ede7a2354f6d95eedde93ceb905701e02a0efc31129ccdc5bd9c', '[\"*\"]', '2022-12-22 13:35:47', '2022-12-22 12:19:53', '2022-12-22 13:35:47'),
(600, 'App\\Models\\User', 107, 'MyAuthApp', '631113b13989690ee70d36da7515ab935701e798530ad06e13b6340288674f93', '[\"*\"]', '2022-12-23 05:41:44', '2022-12-23 05:31:37', '2022-12-23 05:41:44'),
(601, 'App\\Models\\User', 107, 'MyAuthApp', 'b9bca80b05a29f41ed76007e8877b0262e156980d1879a7464925836b979fdc0', '[\"*\"]', '2022-12-23 06:09:01', '2022-12-23 05:43:48', '2022-12-23 06:09:01'),
(602, 'App\\Models\\User', 108, 'MyAuthApp', '272dd7c5339ddd6baa8311b18af5d950dc79021ad63a1ab98a73ec1f9b07ac01', '[\"*\"]', '2022-12-23 07:21:14', '2022-12-23 06:19:39', '2022-12-23 07:21:14'),
(603, 'App\\Models\\User', 107, 'MyAuthApp', '7eac451d9bc11556730871292966f98264ad51451ce42e40155b94acd26c3046', '[\"*\"]', '2022-12-23 20:44:36', '2022-12-23 07:21:40', '2022-12-23 20:44:36'),
(604, 'App\\Models\\User', 19, 'MyAuthApp', '714f4013df6f877a7f7bfadcb42c7dd8674c2dcad5c982692c2f51b61e16a26c', '[\"*\"]', '2022-12-26 16:47:28', '2022-12-23 11:44:29', '2022-12-26 16:47:28'),
(605, 'App\\Models\\User', 19, 'MyAuthApp', 'b8ddf649386f38df8980980a1abb8356b9f247244cc296093615e236cb780a97', '[\"*\"]', '2022-12-23 12:01:04', '2022-12-23 12:01:02', '2022-12-23 12:01:04'),
(606, 'App\\Models\\User', 109, 'MyAuthApp', 'f7dcf695998fb1a5f5e2ec600f623b7d1ba9b5ddeb7835312e1e614c135845f0', '[\"*\"]', NULL, '2022-12-23 12:36:44', '2022-12-23 12:36:44'),
(607, 'App\\Models\\User', 110, 'MyAuthApp', 'b3c8638ddc454650a3838af52afc5260ea9a3490dccf54a79758824351a1ad6e', '[\"*\"]', '2022-12-23 20:45:50', '2022-12-23 20:45:48', '2022-12-23 20:45:50'),
(608, 'App\\Models\\User', 111, 'MyAuthApp', '379707f63c911596c7d638d9376782b772a914b7049b32c7a8914bb4db31c05f', '[\"*\"]', '2022-12-26 11:54:53', '2022-12-23 21:02:14', '2022-12-26 11:54:53'),
(609, 'App\\Models\\User', 112, 'MyAuthApp', 'd7693aeaeb96dc2ea7821d14013d8e340e1c64a2526842d729a997e1e23f20c3', '[\"*\"]', NULL, '2022-12-23 22:40:40', '2022-12-23 22:40:40'),
(610, 'App\\Models\\User', 113, 'MyAuthApp', '87559972ddeccec916d600ce0abfa635c7b1fe0f867bea5cad72df71fee9591a', '[\"*\"]', '2022-12-25 15:24:38', '2022-12-25 14:31:07', '2022-12-25 15:24:38'),
(611, 'App\\Models\\User', 114, 'MyAuthApp', '546c24ac828484888bd6bd5c633c9113e6fb8f44d3930067cce7b31a83134399', '[\"*\"]', '2022-12-26 11:09:36', '2022-12-26 10:31:08', '2022-12-26 11:09:36'),
(612, 'App\\Models\\User', 114, 'MyAuthApp', 'a03b6cf9bd6fa4192a5fa163b4913a1e379a0edd9c2e26f7e69a2daebfc1be55', '[\"*\"]', '2022-12-26 11:25:50', '2022-12-26 11:14:53', '2022-12-26 11:25:50'),
(613, 'App\\Models\\User', 114, 'MyAuthApp', 'ed56803a43c9bde21e653d4ddde7e24ce9c6b8f19c4394962c3e921c7c70ae58', '[\"*\"]', NULL, '2022-12-26 11:36:07', '2022-12-26 11:36:07'),
(614, 'App\\Models\\User', 114, 'MyAuthApp', 'ce20e854dbac92d6c24cbf1c392818eb47d5793cf1bb74b5f3ab052a0d0bb572', '[\"*\"]', '2022-12-27 11:25:50', '2022-12-26 11:37:15', '2022-12-27 11:25:50'),
(615, 'App\\Models\\User', 111, 'MyAuthApp', '3cbb5cd41e3b411159cac40efd4ecbe6ed8603bfd21ad52591506e1d7059db73', '[\"*\"]', '2022-12-26 15:16:27', '2022-12-26 15:16:18', '2022-12-26 15:16:27'),
(616, 'App\\Models\\User', 111, 'MyAuthApp', '42e32d0e0cbad28d6eb8592cfd9cee964de5fa059e9d6826b71d6581ac34c46d', '[\"*\"]', '2022-12-26 21:12:05', '2022-12-26 16:05:59', '2022-12-26 21:12:05'),
(617, 'App\\Models\\User', 115, 'MyAuthApp', 'ec29a0d138d06dfb41d4ac4cfe0f95cc26307cce3cb0560cbddd6e184b7c99c2', '[\"*\"]', NULL, '2022-12-27 11:23:57', '2022-12-27 11:23:57'),
(618, 'App\\Models\\User', 54, 'MyAuthApp', 'adc3d50d3ee7500e8e29b036508ae09ca3fb0a6291a4d60fe980f2b89a94ef9d', '[\"*\"]', '2022-12-27 15:52:00', '2022-12-27 12:17:39', '2022-12-27 15:52:00'),
(619, 'App\\Models\\User', 116, 'MyAuthApp', '49e6920bb2c98da756a595635281b9e10104604992f565ef2a1b06d4d4ed6652', '[\"*\"]', NULL, '2022-12-27 13:59:04', '2022-12-27 13:59:04'),
(620, 'App\\Models\\User', 117, 'MyAuthApp', '560bc4b67b25ed55df4c0e12507dd8708dbb446d55b199e19328373ce28ecd61', '[\"*\"]', NULL, '2022-12-27 14:03:21', '2022-12-27 14:03:21'),
(621, 'App\\Models\\User', 118, 'MyAuthApp', 'b53fd6e912264309ae3a4de2e8897b0140182f06ca0f6e7286d9c23bffe9dd31', '[\"*\"]', NULL, '2022-12-27 14:47:36', '2022-12-27 14:47:36'),
(622, 'App\\Models\\User', 119, 'MyAuthApp', '406dda674026d41883ef3350daeeb1ebef36f6cef98ebc9a201212a1c14785c6', '[\"*\"]', '2022-12-27 14:56:47', '2022-12-27 14:56:44', '2022-12-27 14:56:47'),
(623, 'App\\Models\\User', 120, 'MyAuthApp', '8ae8ad6933466005e762efbdf7f250692e93691cea5f84c67d6b3f0ed36144b6', '[\"*\"]', '2022-12-27 15:58:19', '2022-12-27 15:58:17', '2022-12-27 15:58:19'),
(624, 'App\\Models\\User', 120, 'MyAuthApp', '8afec9aff8cf72672170b3d37b3c1fffb2547c613f8ed9ba6371e862ab81cb1c', '[\"*\"]', '2022-12-27 15:59:28', '2022-12-27 15:59:00', '2022-12-27 15:59:28'),
(625, 'App\\Models\\User', 120, 'MyAuthApp', '8a3860c7f6042986a2842d962a6a7b6e6e3e709b8c16baeb3b50808f62215015', '[\"*\"]', '2022-12-27 16:01:27', '2022-12-27 16:00:02', '2022-12-27 16:01:27'),
(626, 'App\\Models\\User', 120, 'MyAuthApp', 'c5bad32167b1d0d53cb02bc1df185b5ac9f950940c6602791c91a4b461f4b3bd', '[\"*\"]', '2022-12-27 16:36:22', '2022-12-27 16:01:51', '2022-12-27 16:36:22'),
(627, 'App\\Models\\User', 19, 'MyAuthApp', '245e2636aa001b365d8334639eda25fd6bbac671dc597049c68f28d437aa1c55', '[\"*\"]', NULL, '2022-12-27 16:34:47', '2022-12-27 16:34:47'),
(628, 'App\\Models\\User', 19, 'MyAuthApp', 'f95483639395e925dfde671707c029e37721621ffd9461144072060fc2fe25d8', '[\"*\"]', '2022-12-27 16:35:26', '2022-12-27 16:35:23', '2022-12-27 16:35:26'),
(629, 'App\\Models\\User', 120, 'MyAuthApp', '404dd95c2d2bfc1867d5814f7bb005954d5d61af6b8e298178a7ddf5deedda58', '[\"*\"]', '2022-12-27 17:40:05', '2022-12-27 16:41:10', '2022-12-27 17:40:05'),
(630, 'App\\Models\\User', 19, 'MyAuthApp', 'fd76313ba6f4fbb0927725fc3f2313e8c46cc7d0f87b1c699ab178694b4164b4', '[\"*\"]', '2022-12-27 16:55:56', '2022-12-27 16:46:44', '2022-12-27 16:55:56'),
(631, 'App\\Models\\User', 19, 'MyAuthApp', '982fc04906e96f594c44f85b3fa24540034d7b83fb2edf3b18a5429df9c4018a', '[\"*\"]', '2022-12-27 16:55:23', '2022-12-27 16:47:56', '2022-12-27 16:55:23'),
(632, 'App\\Models\\User', 117, 'MyAuthApp', 'ff50e2af8a2bebbdc8f82ab59aa7fc70fbd06080e5aeaf94ddf3e796e9e64b84', '[\"*\"]', '2022-12-27 17:00:41', '2022-12-27 16:58:00', '2022-12-27 17:00:41'),
(633, 'App\\Models\\User', 121, 'MyAuthApp', '385ba204ad0d0251e02c3493aee710c6dee700b62ca6479537ad8b1b48fbc3e9', '[\"*\"]', '2022-12-27 17:22:04', '2022-12-27 16:59:01', '2022-12-27 17:22:04'),
(634, 'App\\Models\\User', 121, 'MyAuthApp', 'f6c26964bb9aface4679ce27ab91e51c53f4b6a6693680a719cb9b4fc54a1455', '[\"*\"]', '2022-12-27 17:11:58', '2022-12-27 17:11:31', '2022-12-27 17:11:58'),
(635, 'App\\Models\\User', 121, 'MyAuthApp', '35cefb218d0e10320d3ab0827b78f718352d47ee081960d8951ce07c1ee58f67', '[\"*\"]', '2022-12-27 17:34:49', '2022-12-27 17:34:47', '2022-12-27 17:34:49'),
(636, 'App\\Models\\User', 122, 'MyAuthApp', '3a6885cce1b7a19272acbbc48d0a8530ba6506b2cc5b56715411bef8e1aa987d', '[\"*\"]', NULL, '2022-12-27 18:15:10', '2022-12-27 18:15:10'),
(637, 'App\\Models\\User', 123, 'MyAuthApp', 'a37f382a02cdedc3e40d20737d3ccba51b3e66e78f80ffb9735927a0928b6fb1', '[\"*\"]', NULL, '2022-12-27 18:42:35', '2022-12-27 18:42:35'),
(638, 'App\\Models\\User', 124, 'MyAuthApp', '6ec0b5323fdd20c73bc20a23016af0f65d02527dc4662c249f284823fab59b73', '[\"*\"]', NULL, '2022-12-27 19:02:36', '2022-12-27 19:02:36'),
(639, 'App\\Models\\User', 121, 'MyAuthApp', '2ae5a3cd3807693ab8c36c386f9cd3f08f36cd2153a7ce79859b5a84a6def5ca', '[\"*\"]', '2022-12-28 11:26:04', '2022-12-28 10:19:06', '2022-12-28 11:26:04'),
(640, 'App\\Models\\User', 125, 'MyAuthApp', '5a8235995c0c9268ed36e5f150785c673717f81a31b3bf5fd9ee6141c0514034', '[\"*\"]', NULL, '2022-12-28 10:42:41', '2022-12-28 10:42:41'),
(641, 'App\\Models\\User', 121, 'MyAuthApp', '4b094d0cd4cf1413d2df80a7681a15c9c01639e85989311ea46e5882f10d7e3f', '[\"*\"]', '2022-12-28 10:45:16', '2022-12-28 10:44:08', '2022-12-28 10:45:16'),
(642, 'App\\Models\\User', 19, 'MyAuthApp', '863895d6debc2ca6d5a17347e3b55e087f08bf8d044d46c7f92dd4f003a6aaa6', '[\"*\"]', '2022-12-28 10:52:31', '2022-12-28 10:51:48', '2022-12-28 10:52:31'),
(643, 'App\\Models\\User', 126, 'MyAuthApp', '1a477ff86ef9075a1938a8729ad4e6f1c0800ec9c53d6d05a0cc499b1f868f18', '[\"*\"]', NULL, '2022-12-28 11:29:54', '2022-12-28 11:29:54'),
(644, 'App\\Models\\User', 127, 'MyAuthApp', '0ed5617fe6d8533f0281f33debebc7a749f7e3ccf0ae44262adab9e93a6de021', '[\"*\"]', '2022-12-28 12:00:29', '2022-12-28 12:00:26', '2022-12-28 12:00:29'),
(645, 'App\\Models\\User', 128, 'MyAuthApp', '7d640e5fac7f14b60347095baf693b60235339dd7f863eb233fed0e6de313ed2', '[\"*\"]', '2022-12-28 12:19:01', '2022-12-28 12:09:54', '2022-12-28 12:19:01'),
(646, 'App\\Models\\User', 127, 'MyAuthApp', 'ee3d421e2324189284f3d5fee0636edaa86a1e489fa7f048b1db5f7a63855af7', '[\"*\"]', '2022-12-28 12:21:17', '2022-12-28 12:21:15', '2022-12-28 12:21:17'),
(647, 'App\\Models\\User', 127, 'MyAuthApp', '9f79de8dcffd42a74e870b63ebc5ffa3545d7633f31d148724031e0a7e9a8a09', '[\"*\"]', '2022-12-28 14:36:54', '2022-12-28 13:48:03', '2022-12-28 14:36:54'),
(648, 'App\\Models\\User', 129, 'MyAuthApp', '1b2c9b9185b2f041ed6ae7602da98e2289faebecf213e1e916da9556ba6941a4', '[\"*\"]', '2022-12-28 16:12:09', '2022-12-28 14:50:46', '2022-12-28 16:12:09'),
(649, 'App\\Models\\User', 130, 'MyAuthApp', '516ca901e5b78e554627df6b4a084f727689174e36755b61cffaf621c09ebdd8', '[\"*\"]', '2022-12-28 16:23:58', '2022-12-28 16:23:55', '2022-12-28 16:23:58'),
(650, 'App\\Models\\User', 131, 'MyAuthApp', 'b4e0092e2cdd1538f20c744362d6b8690212111a7ce909eb62fde4ead897f368', '[\"*\"]', '2022-12-30 18:01:04', '2022-12-28 16:31:33', '2022-12-30 18:01:04'),
(651, 'App\\Models\\User', 132, 'MyAuthApp', '882da391c2c10f6f2345e0827f926a78bfeb31cb1ac79cb6fa30d91e549d0374', '[\"*\"]', '2022-12-28 20:31:53', '2022-12-28 20:24:46', '2022-12-28 20:31:53'),
(652, 'App\\Models\\User', 132, 'MyAuthApp', 'e60ce6f8236dc4336fe7ee8b487cfdbb1d4917b39daf27cf58f6c0fdefa5967c', '[\"*\"]', '2023-01-22 04:08:45', '2022-12-28 20:32:38', '2023-01-22 04:08:45'),
(653, 'App\\Models\\User', 133, 'MyAuthApp', '954e55ead205f1c85b087b63c53b7a6e2c36b4fa916bb214bb0038a55b9cde94', '[\"*\"]', '2022-12-29 05:24:33', '2022-12-29 05:21:27', '2022-12-29 05:24:33'),
(654, 'App\\Models\\User', 133, 'MyAuthApp', 'beb9b256c739f20306a62741d3e96813ed66a97cf64371bac77a4ef2582c9f3d', '[\"*\"]', '2023-01-25 03:16:20', '2022-12-29 05:35:34', '2023-01-25 03:16:20'),
(655, 'App\\Models\\User', 134, 'MyAuthApp', 'df264d13c454093170d0a36913c7c6acca596da3d69e1bc19f8d96b14db48adf', '[\"*\"]', NULL, '2022-12-29 10:39:36', '2022-12-29 10:39:36'),
(656, 'App\\Models\\User', 132, 'MyAuthApp', '24cb2de2a612b0a68e93b2f0540b8028a3ca71a7a01fb9dd1ccb0522028704e2', '[\"*\"]', '2023-01-30 08:47:12', '2022-12-29 20:37:00', '2023-01-30 08:47:12'),
(657, 'App\\Models\\User', 135, 'MyAuthApp', '1edbb7a589770d59fd42372d470d19bb0a01659133ba1137822dc38c39611629', '[\"*\"]', '2022-12-30 12:42:16', '2022-12-30 12:24:20', '2022-12-30 12:42:16'),
(658, 'App\\Models\\User', 136, 'MyAuthApp', '1d694fb8428f59dd55f69d99f290611dd9403698a8232acf9cf21ac1f764eb4b', '[\"*\"]', NULL, '2022-12-30 13:47:16', '2022-12-30 13:47:16'),
(659, 'App\\Models\\User', 135, 'MyAuthApp', '1fd5478bfff67a91737da36e4708d3245ada22438bfc7056ebf0efb7f6677b1b', '[\"*\"]', '2022-12-30 18:26:25', '2022-12-30 18:02:44', '2022-12-30 18:26:25'),
(660, 'App\\Models\\User', 135, 'MyAuthApp', '2f3fc162527b60e90d88ef7a1c0c9ca9d7991c3d0a77135c2f2fa4760236f463', '[\"*\"]', '2022-12-30 18:05:08', '2022-12-30 18:04:53', '2022-12-30 18:05:08'),
(661, 'App\\Models\\User', 136, 'MyAuthApp', '24afb75bd4a6debaaf3a15f730eab64d2e1ff5ca448520216877b8f3a6d1d22a', '[\"*\"]', '2022-12-30 18:06:27', '2022-12-30 18:05:58', '2022-12-30 18:06:27'),
(662, 'App\\Models\\User', 111, 'MyAuthApp', 'c47d3c500b00b857669724e577655e6ee39e00d5b5e7c9feaf70c100e57c0f44', '[\"*\"]', '2023-01-03 10:39:45', '2022-12-30 18:19:11', '2023-01-03 10:39:45'),
(663, 'App\\Models\\User', 137, 'MyAuthApp', 'b95a30a89fcca75d594d061b7b564afe22e26903ab5d9e6e6245422ff4c5782e', '[\"*\"]', '2022-12-30 18:49:34', '2022-12-30 18:29:57', '2022-12-30 18:49:34'),
(664, 'App\\Models\\User', 127, 'MyAuthApp', '8f7b4a278dbddd1f4f64adaf1403a95e875d1361189392cc9ea2b96b92011232', '[\"*\"]', NULL, '2023-01-02 10:15:59', '2023-01-02 10:15:59'),
(665, 'App\\Models\\User', 127, 'MyAuthApp', 'a9a7ac3c8e6c2fbfe07ab3df3d7bf42caadf0caa82af102c824a36b8189f8b9d', '[\"*\"]', '2023-01-05 14:34:30', '2023-01-02 10:16:38', '2023-01-05 14:34:30'),
(666, 'App\\Models\\User', 127, 'MyAuthApp', 'd4035ff3fce872f72f27436dd3bf57bf2a5a9a12cec151329d099419a38e8806', '[\"*\"]', '2023-01-17 11:36:58', '2023-01-02 12:28:13', '2023-01-17 11:36:58'),
(667, 'App\\Models\\User', 136, 'MyAuthApp', '0e1385285f764d55219b1d69649d2eaf6a6f4e257e580245ef1d94f0651a7fbc', '[\"*\"]', '2023-01-06 10:11:28', '2023-01-02 15:45:55', '2023-01-06 10:11:28'),
(668, 'App\\Models\\User', 127, 'MyAuthApp', 'f28ca66dab87f924b35b40f1367c3a3d99f803d44e1cb896f70080badcb6349b', '[\"*\"]', '2023-01-20 12:24:31', '2023-01-03 10:17:56', '2023-01-20 12:24:31'),
(669, 'App\\Models\\User', 136, 'MyAuthApp', '42cb508a5869e318d974c02beb37247243533ad15276243a87ddc0df0a4105ce', '[\"*\"]', '2023-01-05 10:36:12', '2023-01-03 14:42:11', '2023-01-05 10:36:12'),
(670, 'App\\Models\\User', 127, 'MyAuthApp', 'e89769664935dcd813a07d0ff70b17090cd0a439aea4e4090d0fb163dd601a40', '[\"*\"]', '2023-01-06 13:49:07', '2023-01-03 17:58:04', '2023-01-06 13:49:07'),
(671, 'App\\Models\\User', 127, 'MyAuthApp', '966a1da24df191e04da4c7f1375b809e97c7a59717c6bbf503739f7be68ba00a', '[\"*\"]', '2023-01-11 11:31:46', '2023-01-04 11:48:16', '2023-01-11 11:31:46'),
(672, 'App\\Models\\User', 127, 'MyAuthApp', '59aaf543b60a83b2c95bb6232bbfb0a0e88a55c601d2cfc42c3c66364a3b022f', '[\"*\"]', '2023-01-13 12:05:18', '2023-01-05 15:27:43', '2023-01-13 12:05:18'),
(673, 'App\\Models\\User', 136, 'MyAuthApp', '8290d07389d5eb7c7dd20425d04f280b62b4e089ed94f6cb0b926756be5adad7', '[\"*\"]', '2023-01-06 10:37:36', '2023-01-06 10:33:45', '2023-01-06 10:37:36'),
(674, 'App\\Models\\User', 127, 'MyAuthApp', '1f7a5c415baae11d1b92e75eb375fa3baed84a62461c28615d781e0f4bfbb959', '[\"*\"]', '2023-01-12 15:47:47', '2023-01-06 11:00:46', '2023-01-12 15:47:47'),
(675, 'App\\Models\\User', 136, 'MyAuthApp', '18785a16991f16cb04a39f5e511853e5c2c8917909b72bc6509ce08b54857d52', '[\"*\"]', '2023-01-06 18:16:38', '2023-01-06 11:32:10', '2023-01-06 18:16:38'),
(676, 'App\\Models\\User', 127, 'MyAuthApp', '098a78cdf30c65a6a65e9f24c126edc958889514580cd8ed05f43f45779997c2', '[\"*\"]', '2023-01-09 10:11:05', '2023-01-06 13:56:57', '2023-01-09 10:11:05'),
(677, 'App\\Models\\User', 138, 'MyAuthApp', '1ae7b7e38588e9a3b074635fa0ee0da6a3f0ef4b21222c95882cc5b4f6cb77ae', '[\"*\"]', '2023-01-06 15:08:40', '2023-01-06 14:18:46', '2023-01-06 15:08:40'),
(678, 'App\\Models\\User', 139, 'MyAuthApp', '4a1acc54330f8c4a67629506450e3dabbc6d69f7543c711e8dd44816d74811ff', '[\"*\"]', '2023-01-06 15:50:33', '2023-01-06 15:12:30', '2023-01-06 15:50:33'),
(679, 'App\\Models\\User', 138, 'MyAuthApp', '242d4d6b86c8ff16843e6e5c08e243801521ac454210b6f1baad993140f39883', '[\"*\"]', '2023-01-06 15:52:07', '2023-01-06 15:51:45', '2023-01-06 15:52:07'),
(680, 'App\\Models\\User', 138, 'MyAuthApp', 'ebaa9f459e96cf5f3cf956241208e58c017d2691f191928da83f73a734019361', '[\"*\"]', '2023-01-06 21:07:19', '2023-01-06 16:10:31', '2023-01-06 21:07:19'),
(681, 'App\\Models\\User', 54, 'MyAuthApp', 'b3a444a5482b9c60c110b9e3a84e9db748daa0dba9a408ac6efdc1aa7df4888a', '[\"*\"]', '2023-01-06 16:32:55', '2023-01-06 16:19:34', '2023-01-06 16:32:55'),
(682, 'App\\Models\\User', 136, 'MyAuthApp', '240e0a4fff771cabba7bcb389b567fdd850f689ae3ea380e7406729436f96b8a', '[\"*\"]', '2023-01-06 18:27:03', '2023-01-06 17:56:13', '2023-01-06 18:27:03'),
(683, 'App\\Models\\User', 127, 'MyAuthApp', '1138dcec5cd0e325ef08014f64a6cc2665fc53611be63eff0f2d922fda8b1095', '[\"*\"]', '2023-01-20 15:12:22', '2023-01-09 10:17:06', '2023-01-20 15:12:22'),
(684, 'App\\Models\\User', 127, 'MyAuthApp', '1bd1393b3635e9ebd742ddb27bc589b487bec9b6683ea71035b2ad9701f0f356', '[\"*\"]', '2023-01-10 14:52:39', '2023-01-09 10:17:21', '2023-01-10 14:52:39'),
(685, 'App\\Models\\User', 136, 'MyAuthApp', '14ced0498fad4e57d89b87ac92304126dcacf4a257ce087fee42f75ea803d9af', '[\"*\"]', '2023-01-09 15:27:54', '2023-01-09 15:09:34', '2023-01-09 15:27:54'),
(686, 'App\\Models\\User', 140, 'MyAuthApp', 'aa8917236b58da2da2f00a4bf6b918c072aa17358b7dde5df2ed63d6b8f4ec1c', '[\"*\"]', '2023-01-09 16:00:36', '2023-01-09 16:00:35', '2023-01-09 16:00:36'),
(687, 'App\\Models\\User', 140, 'MyAuthApp', '445083d2795e635d7c1e0c675dd08ecda19c5066252198c2ec1fbf69940d83ec', '[\"*\"]', '2023-01-09 16:03:46', '2023-01-09 16:02:44', '2023-01-09 16:03:46'),
(688, 'App\\Models\\User', 140, 'MyAuthApp', '07a74e4e3e6b9470530b65e895f8d0ee52b8e22ef711a727f71b2abd0ff727ff', '[\"*\"]', '2023-01-09 16:04:09', '2023-01-09 16:04:07', '2023-01-09 16:04:09'),
(689, 'App\\Models\\User', 140, 'MyAuthApp', '4c8fbfed286eca7d865cd6b2b609bbf9dfec6dbd5eb0e0bd854dcce715a4806b', '[\"*\"]', '2023-01-09 16:07:45', '2023-01-09 16:07:43', '2023-01-09 16:07:45'),
(690, 'App\\Models\\User', 140, 'MyAuthApp', '869b64baa9cb3e0be3b6575256230f4e72533498f40440b064765dcab161584e', '[\"*\"]', '2023-01-09 21:20:28', '2023-01-09 21:18:42', '2023-01-09 21:20:28'),
(691, 'App\\Models\\User', 140, 'MyAuthApp', '12c0306a73089db32dc80fac0227c1fd586f67aa50425ac3a042b252f97baa4d', '[\"*\"]', '2023-01-09 21:30:33', '2023-01-09 21:28:49', '2023-01-09 21:30:33'),
(692, 'App\\Models\\User', 140, 'MyAuthApp', '3f6a1686e1b0a0aa4d963c043389300318cff56f138ccf79be2558e6d7dce12f', '[\"*\"]', '2023-01-09 21:37:26', '2023-01-09 21:33:42', '2023-01-09 21:37:26'),
(693, 'App\\Models\\User', 140, 'MyAuthApp', '1a2812547d4150391a83cec4461ad2d85a9b5531936e9ee91804ab6d47b6f01f', '[\"*\"]', '2023-01-09 21:45:30', '2023-01-09 21:39:35', '2023-01-09 21:45:30'),
(694, 'App\\Models\\User', 127, 'MyAuthApp', '4709226d12692154e1c0663dffe283bca684bc4ca6da4100a40c68c6d4cb05fa', '[\"*\"]', NULL, '2023-01-10 09:56:05', '2023-01-10 09:56:05'),
(695, 'App\\Models\\User', 141, 'MyAuthApp', '7678ac10ee4f89a1a44ee303dbf64330816ae2b843c473ec135ece847fa6a1a9', '[\"*\"]', NULL, '2023-01-10 14:32:39', '2023-01-10 14:32:39'),
(696, 'App\\Models\\User', 127, 'MyAuthApp', 'ad9767cda66054754c8b43b85f4dc296f9e64632473d502d9e39204f1feb051f', '[\"*\"]', '2023-01-10 15:14:54', '2023-01-10 15:03:34', '2023-01-10 15:14:54'),
(697, 'App\\Models\\User', 127, 'MyAuthApp', '995142817e9f9c49d961b6e24e6967f070e1cef20db3c2d792052a704195426a', '[\"*\"]', '2023-01-10 15:55:02', '2023-01-10 15:23:05', '2023-01-10 15:55:02'),
(698, 'App\\Models\\User', 127, 'MyAuthApp', 'c676d735fc0cc5dc8fbaaf65eb88f2774ec32becef4773c454d2e743ae717eeb', '[\"*\"]', '2023-01-10 17:26:31', '2023-01-10 15:57:04', '2023-01-10 17:26:31'),
(699, 'App\\Models\\User', 127, 'MyAuthApp', 'a4fe1ccdb6a398c3385c1ad52badb609dde46dc15d0f6f534e97f01eeb5656c0', '[\"*\"]', '2023-01-10 18:13:32', '2023-01-10 17:31:19', '2023-01-10 18:13:32'),
(700, 'App\\Models\\User', 127, 'MyAuthApp', '9468e1c8dd99980a3980ae2f6b74b83e025a2022dbe5bbc7774d4c432918f0e3', '[\"*\"]', '2023-01-16 10:54:24', '2023-01-10 18:19:46', '2023-01-16 10:54:24'),
(701, 'App\\Models\\User', 142, 'MyAuthApp', '3070b49b7e004d010d3cd981eb2a39d6c46ebc77620f0a9b43bf12d335d1c135', '[\"*\"]', NULL, '2023-01-11 16:35:15', '2023-01-11 16:35:15'),
(702, 'App\\Models\\User', 143, 'MyAuthApp', '74592e97516ffc1a5730683f817c41311facff1377ed8c1fc4b0d3b7942ecb60', '[\"*\"]', NULL, '2023-01-11 17:21:24', '2023-01-11 17:21:24'),
(703, 'App\\Models\\User', 144, 'MyAuthApp', '0410432f8f004e0438e969c8047c34bdeade06b6e8182a4868098ae0c07adc4f', '[\"*\"]', '2023-01-12 14:18:17', '2023-01-12 14:15:03', '2023-01-12 14:18:17'),
(704, 'App\\Models\\User', 144, 'MyAuthApp', '8a4afc8c23b5070326898ea60e2a6a2b331c8418b2ef5b79503a068d083b8cc9', '[\"*\"]', '2023-01-12 14:19:31', '2023-01-12 14:18:51', '2023-01-12 14:19:31'),
(705, 'App\\Models\\User', 144, 'MyAuthApp', 'e206eac2259eecae0ae0701db5f64973ccc75756d64c4929c7179bd55cffc7b0', '[\"*\"]', '2023-01-12 14:19:58', '2023-01-12 14:19:57', '2023-01-12 14:19:58'),
(706, 'App\\Models\\User', 144, 'MyAuthApp', '0950968022b5a0981f1ef39df558e59c2b371d51b0314abdb998bbeb98a6996e', '[\"*\"]', '2023-01-12 16:27:36', '2023-01-12 14:33:10', '2023-01-12 16:27:36'),
(707, 'App\\Models\\User', 127, 'MyAuthApp', '3b97e579eb3fa184796fdedbcafa82bd411b5d1933f61d86511c1c49b651eb87', '[\"*\"]', '2023-01-12 15:48:14', '2023-01-12 15:47:59', '2023-01-12 15:48:14'),
(708, 'App\\Models\\User', 143, 'MyAuthApp', 'b1068a3f3531f3f11b1f68b782ef51b5cbb37984f94900cdf4e36182b723d882', '[\"*\"]', '2023-01-12 15:59:59', '2023-01-12 15:55:35', '2023-01-12 15:59:59'),
(709, 'App\\Models\\User', 144, 'MyAuthApp', 'df35ac5ba773bd343d0a0853e6549ccb32a1515d8a3eaef5aa5176017865972c', '[\"*\"]', '2023-01-12 16:47:25', '2023-01-12 16:28:51', '2023-01-12 16:47:25'),
(710, 'App\\Models\\User', 144, 'MyAuthApp', '08d35d72a62582617bd897953c8e2f99938c69cf1a0988e296ab3ed747dea3d9', '[\"*\"]', '2023-01-12 16:50:24', '2023-01-12 16:50:23', '2023-01-12 16:50:24'),
(711, 'App\\Models\\User', 144, 'MyAuthApp', '7b8ce897f27b0e34be8728ee0040059a10bc435352e09cedf15bdd148e8b9440', '[\"*\"]', '2023-01-12 18:23:22', '2023-01-12 16:51:30', '2023-01-12 18:23:22'),
(712, 'App\\Models\\User', 127, 'MyAuthApp', '1ba1bb05f605f57bba4b5c86bf6828a4eeaf42e3c8343766a8cf8cde8b0e0c35', '[\"*\"]', '2023-01-18 12:04:42', '2023-01-13 13:47:12', '2023-01-18 12:04:42'),
(713, 'App\\Models\\User', 127, 'MyAuthApp', '71e43a41e63276cd4d3d212e552d6ad091967cd9979a63c6dd373b3cd0354c6d', '[\"*\"]', '2023-01-16 16:38:57', '2023-01-16 11:16:06', '2023-01-16 16:38:57'),
(714, 'App\\Models\\User', 127, 'MyAuthApp', 'a113a894062d2fedddc5cd91c40e641afa2ba997e3d36b39004e7eb205c48683', '[\"*\"]', '2023-01-16 15:40:21', '2023-01-16 15:40:02', '2023-01-16 15:40:21'),
(715, 'App\\Models\\User', 145, 'MyAuthApp', 'ceec56ce807e0e8542828aac888120ddb128bccb938de2e5b518ef58cc348b0f', '[\"*\"]', '2023-01-16 16:26:13', '2023-01-16 16:26:11', '2023-01-16 16:26:13'),
(716, 'App\\Models\\User', 145, 'MyAuthApp', '3350e01ab64842aa69590ca409abb4176ef860c4446afe579e9687421cbad3b6', '[\"*\"]', '2023-01-16 16:29:15', '2023-01-16 16:28:39', '2023-01-16 16:29:15'),
(717, 'App\\Models\\User', 145, 'MyAuthApp', '5443fe5a34e9791a674d34f5c406f8ff7295e22e8b4e6922b8187ab9886d5086', '[\"*\"]', '2023-01-16 16:29:35', '2023-01-16 16:29:34', '2023-01-16 16:29:35'),
(718, 'App\\Models\\User', 127, 'MyAuthApp', '69df5bacdd62dfe252d67f64ab49fe992af5e2458499c0f1518bdff0c8140abe', '[\"*\"]', '2023-01-17 11:16:12', '2023-01-16 18:14:32', '2023-01-17 11:16:12'),
(719, 'App\\Models\\User', 146, 'MyAuthApp', 'f1e115e15a477980fc72dac6416c29c9dd96bf366b682f88d1bdfd4294e8aaf9', '[\"*\"]', '2023-01-17 10:35:45', '2023-01-17 10:35:42', '2023-01-17 10:35:45'),
(720, 'App\\Models\\User', 146, 'MyAuthApp', 'b96646048ebcebf446b92e74e6930b4d6914a5faee387fb4e004b6f61ed16d37', '[\"*\"]', '2023-01-17 10:36:06', '2023-01-17 10:36:04', '2023-01-17 10:36:06'),
(721, 'App\\Models\\User', 146, 'MyAuthApp', 'bf3e9d0739744b051d4487ecd2c3962d52b2c030b500b1bfd1f037bd34b9a50e', '[\"*\"]', '2023-01-17 10:38:21', '2023-01-17 10:37:47', '2023-01-17 10:38:21'),
(722, 'App\\Models\\User', 146, 'MyAuthApp', '5b1b183c6af36fdcfd87282f5d9bb9581dda861bfe2e12741013246ea0dc6ad6', '[\"*\"]', '2023-01-17 11:04:53', '2023-01-17 10:38:42', '2023-01-17 11:04:53'),
(723, 'App\\Models\\User', 146, 'MyAuthApp', '072e2b1c0b0ad73c7f2f45c65c8f065445a0fbdac275f0e4066e439da543ecac', '[\"*\"]', '2023-01-17 11:30:53', '2023-01-17 11:24:11', '2023-01-17 11:30:53'),
(724, 'App\\Models\\User', 146, 'MyAuthApp', 'bbff37bd15670d6fc5b0a3573d5306619050a1c1d6723e78cf55aa011db8b55d', '[\"*\"]', '2023-01-17 11:31:59', '2023-01-17 11:31:18', '2023-01-17 11:31:59'),
(725, 'App\\Models\\User', 146, 'MyAuthApp', '8ee129e13505e23b55415f9b082c7e9723e2d89e777c26fe1cf84fca794032e8', '[\"*\"]', '2023-01-17 11:33:50', '2023-01-17 11:32:58', '2023-01-17 11:33:50'),
(726, 'App\\Models\\User', 127, 'MyAuthApp', '786f418df68a5d50f77ba1c736b378c60030ce9776b80a097a5cd927d573c5c6', '[\"*\"]', '2023-01-17 11:39:50', '2023-01-17 11:34:25', '2023-01-17 11:39:50'),
(727, 'App\\Models\\User', 143, 'MyAuthApp', 'a21b9b8eaf4e83823340be2a173b6ca5e2ee23ad3c1a5f76b21d2ce2f71ded78', '[\"*\"]', '2023-01-19 17:23:00', '2023-01-17 11:35:33', '2023-01-19 17:23:00'),
(728, 'App\\Models\\User', 127, 'MyAuthApp', 'b28d87f164ffb82e4f0c6a7a1ca334d1881af5586e5838936b383d1717485cb9', '[\"*\"]', '2023-01-17 11:41:22', '2023-01-17 11:37:07', '2023-01-17 11:41:22'),
(729, 'App\\Models\\User', 127, 'MyAuthApp', '8541368c49f0a77fdac19bea608077ab0cf47fa598fa470ccb0d500e66d7d737', '[\"*\"]', '2023-01-17 15:57:00', '2023-01-17 11:53:12', '2023-01-17 15:57:00'),
(730, 'App\\Models\\User', 146, 'MyAuthApp', '69a4d8bbf1f51ba9638dfc61726da12d06103df739df8d70b55fb170180714bd', '[\"*\"]', '2023-01-19 09:56:04', '2023-01-17 15:59:13', '2023-01-19 09:56:04'),
(731, 'App\\Models\\User', 127, 'MyAuthApp', '1e3b273bd73b062afa6d88e221430a76ead0dd6c39792f31fb6859235a8d4a3e', '[\"*\"]', '2023-01-20 10:06:12', '2023-01-18 14:34:54', '2023-01-20 10:06:12'),
(732, 'App\\Models\\User', 147, 'MyAuthApp', 'bae6119c9b9f050d555a723d0ca8b25496340433210a6c368a6b46b6a0e7f3cb', '[\"*\"]', '2023-01-24 20:18:07', '2023-01-18 18:56:42', '2023-01-24 20:18:07'),
(733, 'App\\Models\\User', 146, 'MyAuthApp', '46b91ae188b3a8ecee4f125bdb57c4a1a403125d8320ff876abba4fc2967d97e', '[\"*\"]', '2023-01-19 11:43:31', '2023-01-19 10:05:15', '2023-01-19 11:43:31'),
(734, 'App\\Models\\User', 146, 'MyAuthApp', '15f650e5981b4a00f533a468a2da2274eab13a82dc3705306cd949d2d9e66434', '[\"*\"]', '2023-01-19 11:32:50', '2023-01-19 10:38:41', '2023-01-19 11:32:50'),
(735, 'App\\Models\\User', 127, 'MyAuthApp', '59586a08ccc4fbc2b458df3a0e7bf09de47372a7b7808285c5a656b812033ac8', '[\"*\"]', '2023-01-19 10:40:09', '2023-01-19 10:39:53', '2023-01-19 10:40:09'),
(736, 'App\\Models\\User', 146, 'MyAuthApp', '68b7bcd2a567cb59e36720a1ab968ab6929df15bc817918cd612f3bf517b6724', '[\"*\"]', '2023-01-19 14:12:08', '2023-01-19 10:42:57', '2023-01-19 14:12:08'),
(737, 'App\\Models\\User', 146, 'MyAuthApp', 'a6b0090f152f1989a559e22334cf29dedd15ecaa8775df92a3f76fe9ffd9ce85', '[\"*\"]', '2023-01-19 10:57:43', '2023-01-19 10:43:27', '2023-01-19 10:57:43'),
(738, 'App\\Models\\User', 127, 'MyAuthApp', '144d06219665ef9f452b52149475ff128a3855e31ad18a6e536bd5f8d44f3a91', '[\"*\"]', '2023-01-19 11:48:59', '2023-01-19 11:48:15', '2023-01-19 11:48:59'),
(739, 'App\\Models\\User', 146, 'MyAuthApp', 'fb0b77af03bdf77ae913943ad0961562aa7a8d100d1781c74ea3faedff671d19', '[\"*\"]', '2023-01-19 16:56:44', '2023-01-19 11:51:54', '2023-01-19 16:56:44'),
(740, 'App\\Models\\User', 146, 'MyAuthApp', 'd3fab6eb33c9403ce5295472a1f803159bddef4c5c8ee4866f36ad0df9c7a404', '[\"*\"]', '2023-01-19 17:57:11', '2023-01-19 17:16:52', '2023-01-19 17:57:11'),
(741, 'App\\Models\\User', 143, 'MyAuthApp', '59a2fc6d65839afde69e304ab6d69f1ecb4ae6b4fd2f342e814e79c11f5db975', '[\"*\"]', '2023-01-19 18:13:22', '2023-01-19 17:50:52', '2023-01-19 18:13:22'),
(742, 'App\\Models\\User', 148, 'MyAuthApp', '5c148d89510f90011e0c4463a800a46fac56f34c9e407b1a989ba7a2a4443130', '[\"*\"]', '2023-01-19 18:23:51', '2023-01-19 18:21:20', '2023-01-19 18:23:51'),
(743, 'App\\Models\\User', 148, 'MyAuthApp', '51b04e3834b5e38f56ab8adc96122faf75a015208086943dc22e176800021f44', '[\"*\"]', '2023-01-19 18:24:09', '2023-01-19 18:24:07', '2023-01-19 18:24:09'),
(744, 'App\\Models\\User', 148, 'MyAuthApp', 'dd13618f3013496888fdcb1193a441dd8fe3e7d89a00c6cc1b8a1659a22977dd', '[\"*\"]', '2023-01-19 18:25:44', '2023-01-19 18:25:42', '2023-01-19 18:25:44'),
(745, 'App\\Models\\User', 148, 'MyAuthApp', '285eeea2ca2a41ae565f02b05ac556258ed2f02d11899be7165a6c320aa3616f', '[\"*\"]', '2023-01-20 17:02:11', '2023-01-19 18:27:23', '2023-01-20 17:02:11'),
(746, 'App\\Models\\User', 143, 'MyAuthApp', 'cd00ba10c38a7f456fcc0caf97437bb9651b47e90e3a18ccde6e2f8f1136c4b7', '[\"*\"]', '2023-01-19 18:40:49', '2023-01-19 18:40:27', '2023-01-19 18:40:49'),
(747, 'App\\Models\\User', 143, 'MyAuthApp', '0f3b57d52bc9f748c4a1722e7c35543d672e2614035409d16656bfbf4a2b43ad', '[\"*\"]', '2023-01-24 12:07:48', '2023-01-20 09:53:15', '2023-01-24 12:07:48'),
(748, 'App\\Models\\User', 127, 'MyAuthApp', 'a9696bdd57ee62804f92d104bf645d4fb72de47ee2fd5100d3697a893fbbbb52', '[\"*\"]', '2023-01-20 16:57:51', '2023-01-20 13:55:35', '2023-01-20 16:57:51'),
(749, 'App\\Models\\User', 127, 'MyAuthApp', '120d593d3391a1f1e563ad08fdad2c2c0f2c0bce96fec54d47587a4007ff7951', '[\"*\"]', '2023-01-23 12:30:01', '2023-01-20 15:50:06', '2023-01-23 12:30:01'),
(750, 'App\\Models\\User', 143, 'MyAuthApp', '66f4bea2d9bef206f889f89dd740ab9d38b9b449cd1efaa614ed98c2cf20e6df', '[\"*\"]', '2023-01-20 16:22:28', '2023-01-20 16:21:17', '2023-01-20 16:22:28'),
(751, 'App\\Models\\User', 143, 'MyAuthApp', '90ca6678d25f87fc48d66e333ba6493aca9ad79c3aa25b23c0827b455f8fbb15', '[\"*\"]', '2023-01-23 11:10:00', '2023-01-20 16:24:11', '2023-01-23 11:10:00'),
(752, 'App\\Models\\User', 149, 'MyAuthApp', 'f0ce18d67f59af8b55dcf5b0927327ab8cbbdafe3aeffb949eeb3aec1c1db00c', '[\"*\"]', '2023-01-20 18:02:29', '2023-01-20 17:11:43', '2023-01-20 18:02:29'),
(753, 'App\\Models\\User', 127, 'MyAuthApp', '0ad9346d3516737062952239250eb2053d170475986eee5c9dcda1685693c16a', '[\"*\"]', '2023-01-23 10:47:58', '2023-01-20 18:11:31', '2023-01-23 10:47:58'),
(754, 'App\\Models\\User', 148, 'MyAuthApp', '7b588c31fa17aed3f1b475e87e94caa8b57051a2fdf0763a723d41d8b7d18016', '[\"*\"]', '2023-01-23 10:56:55', '2023-01-23 10:56:43', '2023-01-23 10:56:55'),
(755, 'App\\Models\\User', 127, 'MyAuthApp', 'cdfc289683feea8389a31b547a3dfacb26455a09d6c1d31231ece1d040168bf0', '[\"*\"]', '2023-01-23 10:57:18', '2023-01-23 10:57:16', '2023-01-23 10:57:18'),
(756, 'App\\Models\\User', 148, 'MyAuthApp', 'bf2f2ce546dfa89ee3fda381741e3162912cba2a737929b2acfedbb97b1dec88', '[\"*\"]', '2023-01-23 10:57:47', '2023-01-23 10:57:45', '2023-01-23 10:57:47'),
(757, 'App\\Models\\User', 127, 'MyAuthApp', '483f65fe076c6debbb243cae551930fbcccf0e4cd1bf460aa35806b75b4cb93b', '[\"*\"]', '2023-01-23 11:26:12', '2023-01-23 11:02:47', '2023-01-23 11:26:12'),
(758, 'App\\Models\\User', 150, 'MyAuthApp', '59ed1ea83a4a037905411b8d66d2203bb0afb3976561d3be786afc6bcb2e58b4', '[\"*\"]', '2023-01-23 11:18:24', '2023-01-23 11:18:22', '2023-01-23 11:18:24'),
(759, 'App\\Models\\User', 150, 'MyAuthApp', '9e90b2a4b044689ed719fbbfb8ed31e9ee9c519100e3acfbc05ec93783a9b1a0', '[\"*\"]', '2023-01-23 12:17:30', '2023-01-23 11:20:54', '2023-01-23 12:17:30'),
(760, 'App\\Models\\User', 127, 'MyAuthApp', 'dd3b5a198ec5a03703c22304ecda9c0a50933da7afa691a82fb19e6997386ae8', '[\"*\"]', '2023-01-23 11:36:20', '2023-01-23 11:33:28', '2023-01-23 11:36:20'),
(761, 'App\\Models\\User', 127, 'MyAuthApp', '08957ad0acd0adfcd5be54ac3fa139a105e7e45de37d9b3cebe7160170d1edb5', '[\"*\"]', '2023-01-23 11:45:51', '2023-01-23 11:45:20', '2023-01-23 11:45:51'),
(762, 'App\\Models\\User', 127, 'MyAuthApp', '110061359dad8d57961e297e746d4826ce998ab05ad8c5d93b73a9e4709f3896', '[\"*\"]', '2023-01-23 14:57:46', '2023-01-23 12:01:17', '2023-01-23 14:57:46'),
(763, 'App\\Models\\User', 143, 'MyAuthApp', '7587f6384b1e6a0556916a2480efbc93e87a769e87d4448841f5bdbadabc4895', '[\"*\"]', '2023-01-25 14:28:04', '2023-01-23 12:07:04', '2023-01-25 14:28:04'),
(764, 'App\\Models\\User', 150, 'MyAuthApp', 'c35bf9e5ad95f451e0c0b00c9eeb8d2a055d925ef3f6cfa43f65fed70cec5a8a', '[\"*\"]', '2023-01-23 12:27:09', '2023-01-23 12:17:42', '2023-01-23 12:27:09'),
(765, 'App\\Models\\User', 150, 'MyAuthApp', 'ea23823ca75e6e3d53da0fb47410ab5c6ae2c6478c8cc01b9de6dd6b3e60380e', '[\"*\"]', '2023-01-23 18:32:43', '2023-01-23 13:47:44', '2023-01-23 18:32:43'),
(766, 'App\\Models\\User', 127, 'MyAuthApp', '00a0e42b279cd8dfd4b8ffb0435d5814cf39cf2a4ad7415b75d2d408d8c33951', '[\"*\"]', '2023-01-23 14:58:45', '2023-01-23 14:52:48', '2023-01-23 14:58:45'),
(767, 'App\\Models\\User', 151, 'MyAuthApp', '689ea3e34f1d5f5a57b5d143dcf581a8c3b6ed85a37490bc3ab399b4b328a240', '[\"*\"]', '2023-01-24 10:10:35', '2023-01-23 15:16:34', '2023-01-24 10:10:35'),
(768, 'App\\Models\\User', 151, 'MyAuthApp', '8c4f8df4b93582bbc3abeef3db0f2f20d0841505a87b4c1db058d7a75c2af67a', '[\"*\"]', '2023-01-23 18:38:39', '2023-01-23 15:37:33', '2023-01-23 18:38:39'),
(769, 'App\\Models\\User', 152, 'MyAuthApp', '6fe6fcb93682cef254f2a5a817212f0dc111384695f960d4967d470ba076d2a4', '[\"*\"]', NULL, '2023-01-24 10:28:37', '2023-01-24 10:28:37'),
(770, 'App\\Models\\User', 153, 'MyAuthApp', '9addd65a413d20d32902caf491bb15f7220b836441e0e72281e1921d3bd7b16c', '[\"*\"]', '2023-01-27 15:26:45', '2023-01-24 10:33:40', '2023-01-27 15:26:45'),
(771, 'App\\Models\\User', 154, 'MyAuthApp', '5c7442952889cd9db45e67ca922a88c84f04f587991298911ccba7ab0b5f0cbc', '[\"*\"]', NULL, '2023-01-24 10:34:08', '2023-01-24 10:34:08'),
(772, 'App\\Models\\User', 153, 'MyAuthApp', '55341e119dbe0bdb551dd5613dc4f42ef40281f2c822fb892156f6821aa03761', '[\"*\"]', '2023-01-24 11:26:29', '2023-01-24 10:42:24', '2023-01-24 11:26:29'),
(773, 'App\\Models\\User', 155, 'MyAuthApp', '2d987b6d9cbc34747d1642a5d08013cf314f43281b1def8525b1b81cd398b984', '[\"*\"]', NULL, '2023-01-24 10:44:00', '2023-01-24 10:44:00'),
(774, 'App\\Models\\User', 156, 'MyAuthApp', '95bd10a87de3bd48763b274a759225442537b301092802e627dfc083bebd58dc', '[\"*\"]', NULL, '2023-01-24 10:46:20', '2023-01-24 10:46:20'),
(775, 'App\\Models\\User', 157, 'MyAuthApp', 'e94a7c4d53ccf5e29a678f86bcce18790bfc1f671a027e7376f45bc883756435', '[\"*\"]', NULL, '2023-01-24 10:50:00', '2023-01-24 10:50:00'),
(776, 'App\\Models\\User', 158, 'MyAuthApp', 'a6435f37a7cf41c2f755ca72a77a8a489ab1f09d1e97def5a47684237cafec51', '[\"*\"]', NULL, '2023-01-24 10:55:02', '2023-01-24 10:55:02'),
(777, 'App\\Models\\User', 159, 'MyAuthApp', 'd08cdab1c2e3a73a1bb3bdc539efebf3720244384c23a0017431b98dd895fc05', '[\"*\"]', NULL, '2023-01-24 11:01:05', '2023-01-24 11:01:05'),
(778, 'App\\Models\\User', 153, 'MyAuthApp', '6d57c44e23966c19b6166b661846f5914ec504b6ba338d8fe2978c07787eba42', '[\"*\"]', '2023-01-26 16:42:58', '2023-01-24 11:37:15', '2023-01-26 16:42:58'),
(779, 'App\\Models\\User', 160, 'MyAuthApp', '3580cced5d8cf08e01b7dbea92f9ffb8620754ae02aaebba0ed57c92a392b411', '[\"*\"]', NULL, '2023-01-24 11:39:35', '2023-01-24 11:39:35'),
(780, 'App\\Models\\User', 153, 'MyAuthApp', '16d5ef0d96f9c5989c0aca547be29104ad4905160618ef98e15b0fe13f35c1f0', '[\"*\"]', '2023-01-24 12:00:32', '2023-01-24 11:46:39', '2023-01-24 12:00:32'),
(781, 'App\\Models\\User', 153, 'MyAuthApp', '49569be9c0dca8092caea117d263e74509d1cd7d47773e8f1cdc04898b316a91', '[\"*\"]', '2023-01-27 14:14:43', '2023-01-24 12:07:54', '2023-01-27 14:14:43'),
(782, 'App\\Models\\User', 160, 'MyAuthApp', '1bfeb58dd659497e878df95ce0581fa0ec23a22efdbf2bb056e4c6d75cb295ab', '[\"*\"]', '2023-01-24 16:32:00', '2023-01-24 14:01:12', '2023-01-24 16:32:00'),
(783, 'App\\Models\\User', 160, 'MyAuthApp', 'ee11b7cdf9812b61702c2d684fb04907bcf68e72400d7605da50f82e6754ac95', '[\"*\"]', '2023-01-24 17:20:10', '2023-01-24 17:19:50', '2023-01-24 17:20:10'),
(784, 'App\\Models\\User', 132, 'MyAuthApp', 'f446355ca4b4cc0621761995b42a6578b5d8e10f377677228bd366cee48e80cd', '[\"*\"]', '2023-01-25 03:10:43', '2023-01-25 03:05:23', '2023-01-25 03:10:43'),
(785, 'App\\Models\\User', 160, 'MyAuthApp', '8bb3f01d12872a424355373f04236396da9ff4f90d981fa3a360f11f2f6783a4', '[\"*\"]', '2023-01-25 13:40:09', '2023-01-25 12:22:26', '2023-01-25 13:40:09'),
(786, 'App\\Models\\User', 161, 'MyAuthApp', 'f99b8a2a41bbc9b69cd13e477532e1ebc6e7f5cadc1e7b4ed28a7b58a6fc7435', '[\"*\"]', '2023-01-25 16:24:44', '2023-01-25 13:47:20', '2023-01-25 16:24:44'),
(787, 'App\\Models\\User', 160, 'MyAuthApp', '9b69e885146ac75fdee070cd53735fec5d5f8205b60ae833a59f7e7f78a78a4b', '[\"*\"]', '2023-01-25 14:28:36', '2023-01-25 14:28:34', '2023-01-25 14:28:36'),
(788, 'App\\Models\\User', 160, 'MyAuthApp', 'b4e63423bb93990a1aa9b08e38efc4dcd3e64a47d02a830aee28175310f8313d', '[\"*\"]', '2023-01-25 14:37:57', '2023-01-25 14:30:34', '2023-01-25 14:37:57'),
(789, 'App\\Models\\User', 162, 'MyAuthApp', '1eae57b20f7de00358e6ce02062519aa6d559d259a665217644667c014d36b17', '[\"*\"]', NULL, '2023-01-25 14:36:44', '2023-01-25 14:36:44'),
(790, 'App\\Models\\User', 161, 'MyAuthApp', '19f887b2be433ece98cf05177a2a717fd84e1a21090b2f7b6c77263c72064d87', '[\"*\"]', '2023-01-26 11:22:05', '2023-01-26 11:10:50', '2023-01-26 11:22:05'),
(791, 'App\\Models\\User', 153, 'MyAuthApp', 'a781fe62ea4fde96df09bc360fe41a251ee85346d651917901f692e02be0a91d', '[\"*\"]', '2023-01-26 11:36:45', '2023-01-26 11:24:55', '2023-01-26 11:36:45'),
(792, 'App\\Models\\User', 153, 'MyAuthApp', 'd4f4fc0a8e51c90fadf9d416f5eb5ad6e23583994348c1cc9d5f50f7dcfc15cf', '[\"*\"]', '2023-01-26 11:34:25', '2023-01-26 11:25:02', '2023-01-26 11:34:25'),
(793, 'App\\Models\\User', 161, 'MyAuthApp', 'feb318b93a2b2433cfc6e9b56b6b1f831ab2d2db7ce079e6c9700b78004c3bee', '[\"*\"]', '2023-01-26 11:40:41', '2023-01-26 11:34:56', '2023-01-26 11:40:41'),
(794, 'App\\Models\\User', 161, 'MyAuthApp', '5184c08f6248831235078d8428a6ea263dbcf7f8749f2a7b50af232bee86f537', '[\"*\"]', '2023-01-26 11:38:03', '2023-01-26 11:37:28', '2023-01-26 11:38:03'),
(795, 'App\\Models\\User', 153, 'MyAuthApp', '9fc2105b17516a8a501359cb13920d227b76115e727e2e69b25a1e4195d77c00', '[\"*\"]', '2023-01-26 11:50:14', '2023-01-26 11:41:56', '2023-01-26 11:50:14'),
(796, 'App\\Models\\User', 161, 'MyAuthApp', 'c47e494a310b643f6c16fbaa9e7fe78d25fefed56a23ad8296f2f9b799de2521', '[\"*\"]', '2023-01-26 15:37:30', '2023-01-26 13:56:17', '2023-01-26 15:37:30'),
(797, 'App\\Models\\User', 160, 'MyAuthApp', '557d08b85a8519f0858e63c439cc8048f984acf73e7b1d0f75ec29cbf050a615', '[\"*\"]', '2023-01-27 10:26:19', '2023-01-27 10:26:16', '2023-01-27 10:26:19'),
(798, 'App\\Models\\User', 163, 'MyAuthApp', '9e1ab9b1dce06348aa577fdc02229ffa80ecba26ef93b947e27fb6fbf72f11e0', '[\"*\"]', '2023-01-27 10:56:48', '2023-01-27 10:55:42', '2023-01-27 10:56:48'),
(799, 'App\\Models\\User', 163, 'MyAuthApp', '38e2c7ea63619bff95cd8d3043605e5744e9dc12b8f9ed0d6919945824b889f1', '[\"*\"]', '2023-01-27 10:57:12', '2023-01-27 10:57:10', '2023-01-27 10:57:12'),
(800, 'App\\Models\\User', 163, 'MyAuthApp', '666a96f32c1014641b4342be03049dc50a8af8bab66dafddae39271e4fa873b0', '[\"*\"]', '2023-01-27 16:27:47', '2023-01-27 11:00:20', '2023-01-27 16:27:47'),
(801, 'App\\Models\\User', 164, 'MyAuthApp', '586744d366221fcbc87002538460a96af3f0affb89519d07a8f1917ccff3601b', '[\"*\"]', '2023-01-30 12:29:18', '2023-01-27 12:44:57', '2023-01-30 12:29:18'),
(802, 'App\\Models\\User', 153, 'MyAuthApp', 'b7c51978854923cee7c58f7517dffceb950e3783f5c6c959fd0683563d5b923f', '[\"*\"]', '2023-01-30 17:28:31', '2023-01-27 14:22:34', '2023-01-30 17:28:31'),
(803, 'App\\Models\\User', 153, 'MyAuthApp', '4cb78fda345f41c715c1a4ab81b0cefd9ce13b5e29ecaf264ecacba21a38f556', '[\"*\"]', '2023-01-27 16:27:54', '2023-01-27 16:25:28', '2023-01-27 16:27:54'),
(804, 'App\\Models\\User', 153, 'MyAuthApp', '94fd4d1bfa876ae42469248c2058fa3dd2f8c126f44c745478092d6577037f16', '[\"*\"]', '2023-01-31 10:39:52', '2023-01-27 16:29:08', '2023-01-31 10:39:52'),
(805, 'App\\Models\\User', 163, 'MyAuthApp', 'a951d6890b9d20669e3ce49bc9984ac87d2628ab9e58d4e44e2e26d01156662a', '[\"*\"]', '2023-01-27 17:42:39', '2023-01-27 16:29:41', '2023-01-27 17:42:39'),
(806, 'App\\Models\\User', 153, 'MyAuthApp', '6f1867c0d0101f1f53e242ed3e83f2964b251ddd6b8e74e38a026da09e6517e7', '[\"*\"]', '2023-01-30 10:00:57', '2023-01-27 18:12:02', '2023-01-30 10:00:57'),
(807, 'App\\Models\\User', 153, 'MyAuthApp', 'e6d210aaa9eea207714565818fc91f428b30fd92b26ad5bb79599b8793dff182', '[\"*\"]', '2023-01-31 10:46:48', '2023-01-30 10:14:21', '2023-01-31 10:46:48'),
(808, 'App\\Models\\User', 164, 'MyAuthApp', '53ffdf58f389b28588967f49d0f13f917dc7ebab0849c3c9ffbf880407e928db', '[\"*\"]', '2023-01-30 18:19:25', '2023-01-30 13:59:06', '2023-01-30 18:19:25'),
(809, 'App\\Models\\User', 153, 'MyAuthApp', '9428e518efe4f77967ec4d1bf4905aeb197b21d1b9bb23ab8438bd5133484d3e', '[\"*\"]', '2023-01-31 10:32:52', '2023-01-31 10:32:04', '2023-01-31 10:32:52'),
(810, 'App\\Models\\User', 1, 'MyAuthApp', 'd60c11f468893c4f15d19ab686cf301cb0efe1ac516ed824a328505e24f3524b', '[\"*\"]', NULL, '2023-01-31 11:01:28', '2023-01-31 11:01:28'),
(811, 'App\\Models\\User', 2, 'MyAuthApp', 'f990ca87b57c125a57ce4a08c86d3ead883ea0867f832cd9f6c80fa2583423fe', '[\"*\"]', '2023-01-31 12:32:11', '2023-01-31 11:04:29', '2023-01-31 12:32:11'),
(812, 'App\\Models\\User', 1, 'MyAuthApp', '479d264848edfb8cc5fca2b654f1879ae496b4ecdf3c7d8fcac0acdea75f6e8c', '[\"*\"]', '2023-01-31 16:46:33', '2023-01-31 11:07:14', '2023-01-31 16:46:33'),
(813, 'App\\Models\\User', 3, 'MyAuthApp', '61229f7ee95409b41ad83fff98938ad0a15975345d660c7841be746033f0d0d4', '[\"*\"]', '2023-01-31 12:09:25', '2023-01-31 11:20:55', '2023-01-31 12:09:25'),
(814, 'App\\Models\\User', 1, 'MyAuthApp', 'f04f61cfe682367b7cfaacd7aa5ddf1e1a5fb1f2e36819415ba9203355aac9fc', '[\"*\"]', '2023-01-31 11:26:15', '2023-01-31 11:26:04', '2023-01-31 11:26:15'),
(815, 'App\\Models\\User', 4, 'MyAuthApp', '64dd96eecdb4ecca9420baeaa17ce3a3cf37aa8efd47a1ad8354f3c9d548a9ab', '[\"*\"]', '2023-01-31 14:10:07', '2023-01-31 13:44:59', '2023-01-31 14:10:07'),
(816, 'App\\Models\\User', 5, 'MyAuthApp', 'c8c1c88babbfd9d6128a63febd3270c08b1f88304c3a330241fac580e22fa4ae', '[\"*\"]', '2023-01-31 14:38:11', '2023-01-31 14:09:04', '2023-01-31 14:38:11'),
(817, 'App\\Models\\User', 6, 'MyAuthApp', 'c653ae3eedf6d73892c073df89e316f2e4dffdc009d5b54766c98e1697f3edb6', '[\"*\"]', '2023-01-31 14:11:16', '2023-01-31 14:11:13', '2023-01-31 14:11:16'),
(818, 'App\\Models\\User', 6, 'MyAuthApp', '36a06eedd0b4b7455afec5e4190e4bedf04dc7aa09caaa369bb5b8c78243e62e', '[\"*\"]', '2023-01-31 14:13:16', '2023-01-31 14:12:45', '2023-01-31 14:13:16'),
(819, 'App\\Models\\User', 6, 'MyAuthApp', 'a5832fa07e3319e67f243b94e9f3d759cda922a76c77a7e2b65199ffb6a76653', '[\"*\"]', '2023-01-31 14:32:29', '2023-01-31 14:13:31', '2023-01-31 14:32:29'),
(820, 'App\\Models\\User', 4, 'MyAuthApp', '5a0a195d3884081b16426156759307f4cb6e387998cc71b288e764e5ca494c8a', '[\"*\"]', '2023-01-31 14:46:45', '2023-01-31 14:19:34', '2023-01-31 14:46:45'),
(821, 'App\\Models\\User', 7, 'MyAuthApp', '30b1b87fead1d03ac7fd24dcf1c43c3f6c2ccd807d5263bacda9c31207e2950e', '[\"*\"]', '2023-02-01 11:55:41', '2023-01-31 14:51:44', '2023-02-01 11:55:41'),
(822, 'App\\Models\\User', 8, 'MyAuthApp', '4af9816112c4ff3a6750c761d87cb2f6ffbc38fee5c80dbd09641fe3c1929e60', '[\"*\"]', '2023-01-31 14:52:13', '2023-01-31 14:52:12', '2023-01-31 14:52:13'),
(823, 'App\\Models\\User', 8, 'MyAuthApp', '44b1849d7037c856923863213e76193ee76991b7d3b77a84f0de2f84576392eb', '[\"*\"]', '2023-01-31 19:24:44', '2023-01-31 14:53:32', '2023-01-31 19:24:44'),
(824, 'App\\Models\\User', 7, 'MyAuthApp', 'ad36eb5333e12f01854f7f508d596035a2079ec8f9bb9f01d475eeab0dd3559f', '[\"*\"]', '2023-01-31 18:16:13', '2023-01-31 15:08:01', '2023-01-31 18:16:13'),
(825, 'App\\Models\\User', 9, 'MyAuthApp', '995234320b00d35717c8b5f862116527d21018d06a213d4883dd473fc9d72713', '[\"*\"]', NULL, '2023-01-31 15:19:19', '2023-01-31 15:19:19'),
(826, 'App\\Models\\User', 10, 'MyAuthApp', '751045c7ecafd05b01957863a6545f85c1a9f92e6a950e31436b8bbacd4a08f4', '[\"*\"]', NULL, '2023-01-31 15:22:00', '2023-01-31 15:22:00'),
(827, 'App\\Models\\User', 7, 'MyAuthApp', 'd45caa9e77e27da19be494b1c437ca6a2aca2bb4890c0e730b6076bb49cb29ac', '[\"*\"]', '2023-01-31 15:53:34', '2023-01-31 15:53:09', '2023-01-31 15:53:34'),
(828, 'App\\Models\\User', 11, 'MyAuthApp', '7f4d64c48d28fc168f4571eb1aac0b86819a1cb30fb706d150c3d50f7c289eee', '[\"*\"]', '2023-01-31 19:41:43', '2023-01-31 19:41:41', '2023-01-31 19:41:43'),
(829, 'App\\Models\\User', 11, 'MyAuthApp', '61d671457f06ecf4b33e72f5e6f02e83fe3b33eafdeacd2a43fd88c5036d865b', '[\"*\"]', '2023-02-01 12:41:09', '2023-01-31 19:45:13', '2023-02-01 12:41:09'),
(830, 'App\\Models\\User', 7, 'MyAuthApp', '3c8ed7fa2a5276b323c68fb90a86e805af639122618ab949abe249ba2e57bb6e', '[\"*\"]', '2023-02-01 13:49:17', '2023-02-01 12:38:35', '2023-02-01 13:49:17'),
(831, 'App\\Models\\User', 8, 'MyAuthApp', 'ca21363bc38151acb2e95a0a680918edd8ed70a18e3d7b4d29beec3b671aab22', '[\"*\"]', '2023-02-01 12:45:44', '2023-02-01 12:45:33', '2023-02-01 12:45:44'),
(832, 'App\\Models\\User', 12, 'MyAuthApp', 'a5ffdb7a73d33730afed348152c51e1cdc668e78616e773bc7ab1410a7ee0fa7', '[\"*\"]', NULL, '2023-02-01 13:52:02', '2023-02-01 13:52:02');

-- --------------------------------------------------------

--
-- Table structure for table `pickup_points`
--

CREATE TABLE `pickup_points` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` bigint UNSIGNED NOT NULL,
  `city_id` bigint UNSIGNED DEFAULT NULL,
  `address` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('draft','published') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `author_id`, `title`, `slug`, `image`, `short_description`, `description`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 'test', 'test', 'uploads/post/1669701760_6385a08043cd4.jpg', 'Lorem ipsum dolor si', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p>', 'published', '2022-11-29 11:02:40', '2022-11-29 11:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `name`, `image`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Blog', 'uploads/postcategory/1669364025_6380793905899.jpg', NULL, '2022-11-25 13:13:45', '2022-11-25 13:13:45');

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` bigint UNSIGNED NOT NULL,
  `author_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `parent_id` int UNSIGNED DEFAULT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int NOT NULL,
  `sale_price` int DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `total_views` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `short_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `long_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `discount` int DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `hot` tinyint(1) NOT NULL DEFAULT '0',
  `total_orders` int NOT NULL DEFAULT '0',
  `total_rated` int NOT NULL DEFAULT '0',
  `total_stars` int NOT NULL DEFAULT '0',
  `helpful` int NOT NULL DEFAULT '0',
  `unhelpful` int NOT NULL DEFAULT '0',
  `additional_information` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `specification` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `title`, `slug`, `sku`, `image`, `price`, `sale_price`, `stock`, `total_views`, `status`, `short_description`, `long_description`, `discount`, `featured`, `hot`, `total_orders`, `total_rated`, `total_stars`, `helpful`, `unhelpful`, `additional_information`, `specification`, `created_at`, `updated_at`) VALUES
(37, 15, 2, 'test', 'test', '2', 'uploads/product/1675147878_63d8ba668ddf1.jpeg', 130, 120, 991, 0, 1, '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p><br>&nbsp;</p>', NULL, 1, 0, 9, 0, 0, 0, 0, NULL, NULL, '2023-01-31 11:51:18', '2023-01-31 23:14:11'),
(38, 16, 3, 'product1', 'product1', '8', 'uploads/product/1675229436_63d9f8fc6fec7.png', 40, 45, 10, 0, 1, '<p>test</p>', '<p>test1</p>', NULL, 1, 1, 0, 0, 0, 0, 0, '<p>test</p>', NULL, '2023-02-01 10:30:36', '2023-02-01 10:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `product_attributes`
--

CREATE TABLE `product_attributes` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `attribute_id` bigint UNSIGNED NOT NULL,
  `value_id` bigint UNSIGNED NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_carts`
--

CREATE TABLE `product_carts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_carts`
--

INSERT INTO `product_carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(261, 121, 8, 1, '2022-12-28 11:09:14', '2022-12-28 11:09:14'),
(264, 129, 8, 1, '2022-12-28 15:56:38', '2022-12-28 15:56:38'),
(268, 132, 33, 1, '2022-12-28 20:29:21', '2022-12-28 20:29:21'),
(269, 133, 8, 1, '2022-12-29 05:42:47', '2022-12-29 05:42:47'),
(274, 19, 33, 2, '2022-12-30 10:56:15', '2022-12-30 10:56:15'),
(291, 111, 33, 2, '2023-01-06 14:12:36', '2023-01-06 14:13:31'),
(294, 54, 33, 3, '2023-01-06 15:27:07', '2023-01-06 15:27:07'),
(295, 138, 33, 1, '2023-01-06 16:22:40', '2023-01-06 16:22:40'),
(305, 136, 29, 1, '2023-01-09 15:27:41', '2023-01-09 15:27:41'),
(308, 140, 26, 22, '2023-01-09 21:40:36', '2023-01-09 21:40:36'),
(309, 140, 33, 3, '2023-01-09 21:41:38', '2023-01-09 21:41:38'),
(318, 132, 8, 1, '2023-01-11 03:25:24', '2023-01-11 03:25:24'),
(321, 144, 34, 50, '2023-01-12 15:20:41', '2023-01-12 15:20:41'),
(322, 144, 26, 2, '2023-01-12 15:22:12', '2023-01-12 15:22:12'),
(323, 144, 35, 1, '2023-01-12 15:24:30', '2023-01-12 15:24:30'),
(359, 148, 26, 7, '2023-01-20 11:52:17', '2023-01-20 11:52:17'),
(360, 148, 33, 10, '2023-01-20 11:52:17', '2023-01-20 11:52:17'),
(361, 148, 29, 7, '2023-01-20 11:52:17', '2023-01-20 11:52:17'),
(370, 149, 30, 2, '2023-01-20 17:32:05', '2023-01-20 17:32:05'),
(384, 127, 26, 6, '2023-01-23 14:34:12', '2023-01-23 14:57:37'),
(385, 143, 26, 2, '2023-01-23 14:38:49', '2023-01-23 14:39:21'),
(396, 143, 29, 1, '2023-01-24 11:05:22', '2023-01-24 11:05:22'),
(417, 163, 26, 20, '2023-01-27 16:14:46', '2023-01-27 16:14:46'),
(424, 153, 27, 4, '2023-01-30 17:27:57', '2023-01-30 17:27:57'),
(425, 2, 37, 2, '2023-01-31 11:51:58', '2023-01-31 12:00:05'),
(426, 3, 37, 1, '2023-01-31 12:10:43', '2023-01-31 12:10:43'),
(427, 4, 37, 2, '2023-01-31 14:10:04', '2023-01-31 14:10:04'),
(429, 6, 37, 1, '2023-01-31 14:32:04', '2023-01-31 14:32:04'),
(432, 8, 37, 1, '2023-01-31 15:29:29', '2023-01-31 15:29:29'),
(433, 7, 37, 11, '2023-01-31 15:54:07', '2023-01-31 18:35:53'),
(435, 7, 38, 3, '2023-02-01 10:31:24', '2023-02-01 11:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_galleries`
--

CREATE TABLE `product_galleries` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE `product_tag` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tag`
--

INSERT INTO `product_tag` (`id`, `product_id`, `tag_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(28, 16, 1),
(29, 15, 1),
(30, 14, 1),
(31, 13, 1),
(32, 12, 1),
(35, 9, 1),
(37, 7, 1),
(38, 6, 1),
(41, 3, 1),
(43, 8, 1),
(44, 11, 1),
(45, 5, 1),
(46, 26, 1),
(47, 27, 1),
(48, 4, 1),
(49, 33, 1),
(50, 34, 1),
(53, 36, 1),
(55, 10, 1),
(57, 35, 1),
(60, 37, 1),
(61, 38, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_tags`
--

CREATE TABLE `product_tags` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_tags`
--

INSERT INTO `product_tags` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, '123', '123', '2022-10-11 08:00:07', '2022-10-11 08:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `purchesd_packages`
--

CREATE TABLE `purchesd_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `package_id` int NOT NULL,
  `start_date` date DEFAULT NULL,
  `expired_date` date NOT NULL,
  `price` int NOT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_id` int NOT NULL,
  `payment_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `stars` int NOT NULL,
  `comment` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_details`
--

CREATE TABLE `review_details` (
  `id` int NOT NULL,
  `item_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `type` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `review_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `review_details`
--

INSERT INTO `review_details` (`id`, `item_id`, `user_id`, `type`, `created_at`, `updated_at`, `review_id`) VALUES
(1, 10, 19, 1, '2022-12-15 15:52:38', '2022-12-15 15:52:38', 39),
(3, 10, 19, 1, '2022-12-27 00:26:49', '2022-12-27 00:26:49', 39),
(4, 10, 19, 1, '2022-12-27 00:26:52', '2022-12-27 00:26:52', 39),
(5, 10, 19, 1, '2022-12-27 00:26:55', '2022-12-27 00:26:55', 39),
(17, 32, 136, 2, '2022-12-30 14:51:23', '2022-12-30 14:51:23', 129),
(18, 32, 136, 2, '2022-12-30 14:57:56', '2022-12-30 14:57:56', 129),
(19, 32, 136, 2, '2022-12-30 14:58:05', '2022-12-30 14:58:05', 129),
(20, 32, 136, 2, '2022-12-30 14:58:17', '2022-12-30 14:58:17', 129),
(21, 32, 136, 1, '2022-12-30 14:58:54', '2022-12-30 14:58:54', 129),
(22, 32, 136, 1, '2022-12-30 14:59:03', '2022-12-30 14:59:03', 129),
(23, 32, 136, 2, '2022-12-30 14:59:12', '2022-12-30 14:59:12', 129),
(24, 32, 136, 2, '2022-12-30 14:59:23', '2022-12-30 14:59:23', 129),
(25, 10, 136, 1, '2022-12-30 15:05:31', '2022-12-30 15:05:31', 39),
(26, 10, 136, 2, '2022-12-30 15:05:34', '2022-12-30 15:05:34', 75),
(27, 10, 136, 1, '2022-12-30 15:07:16', '2022-12-30 15:07:16', 36),
(28, 10, 136, 2, '2022-12-30 15:07:28', '2022-12-30 15:07:28', 36),
(29, 10, 136, 1, '2022-12-30 15:09:09', '2022-12-30 15:09:09', 39),
(30, 10, 136, 1, '2022-12-30 15:09:19', '2022-12-30 15:09:19', 39),
(31, 26, 160, 2, '2023-01-24 13:54:19', '2023-01-24 13:54:19', 161);

-- --------------------------------------------------------

--
-- Table structure for table `review_ratings`
--

CREATE TABLE `review_ratings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `type` int NOT NULL,
  `title` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_id` int NOT NULL,
  `star` int NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `helpful` int DEFAULT '0',
  `unhelpful` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_ratings`
--

INSERT INTO `review_ratings` (`id`, `user_id`, `type`, `title`, `item_id`, `star`, `comment`, `helpful`, `unhelpful`, `created_at`, `updated_at`) VALUES
(1, 10, 1, '', 37, 3, 'What is Lorem Ipsum?\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n\nWhy do we use it?\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 0, 0, '2023-01-31 17:03:16', '2023-01-31 17:03:16'),
(2, 10, 1, '', 37, 4, 'What is Lorem Ipsum?\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n\nWhy do we use it?\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).\nWhat is Lorem Ipsum?\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\n\nWhy do we use it?\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 0, 0, '2023-01-31 17:03:38', '2023-01-31 17:03:38'),
(3, 10, 1, '', 3, 3, 'Where does it come from?\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\n\nWhere can I get some?\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 0, 0, '2023-02-01 11:25:59', '2023-02-01 11:25:59'),
(4, 10, 2, 'Superb', 1, 3, 'Where does it come from?\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\n\nWhere can I get some?\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.', 0, 0, '2023-02-01 11:38:11', '2023-02-01 11:38:11'),
(5, 10, 2, '', 6, 2, 'Where does it come from?\nContrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\n\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.\n\nWhere can I get some?\nThere are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc', 0, 0, '2023-02-01 11:45:58', '2023-02-01 11:45:58');

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
(1, 'superadmin', 'admin', '2022-10-05 05:33:05', '2022-10-05 05:33:05'),
(2, 'Sales Team', 'admin', '2022-11-25 20:22:00', '2022-11-25 20:22:00'),
(3, 'Test', 'admin', '2022-12-23 09:53:20', '2022-12-23 09:53:20');

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
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `seos`
--

CREATE TABLE `seos` (
  `id` bigint UNSIGNED NOT NULL,
  `page_slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `seos`
--

INSERT INTO `seos` (`id`, `page_slug`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 'home', 'Welcome To Clicon', 'Clicon is a beautifully designed ecommerce laravel script. Clicon has the best admin panel with lots of feature and exicting UX you will love using again & again.', 'frontend/image/clicon.jpg', '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(2, 'products', 'Products', 'Clicon is a beautifully designed ecommerce laravel script. Clicon has the best admin panel with lots of feature and exicting UX you will love using again & again.', 'frontend/image/clicon.jpg', '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(3, 'posts', 'Posts', 'Clicon is a beautifully designed ecommerce laravel script. Clicon has the best admin panel with lots of feature and exicting UX you will love using again & again.', 'frontend/image/clicon.jpg', '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(4, 'login', 'Login', 'Clicon is a beautifully designed ecommerce laravel script. Clicon has the best admin panel with lots of feature and exicting UX you will love using again & again.', 'frontend/image/clicon.jpg', '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(5, 'register', 'Register', 'Clicon is a beautifully designed ecommerce laravel script. Clicon has the best admin panel with lots of feature and exicting UX you will love using again & again.', 'frontend/image/clicon.jpg', '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(6, 'about', 'About', 'Clicon is a beautifully designed ecommerce laravel script. Clicon has the best admin panel with lots of feature and exicting UX you will love using again & again.', 'frontend/image/clicon.jpg', '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(7, 'contact', 'Contact', 'Clicon is a beautifully designed ecommerce laravel script. Clicon has the best admin panel with lots of feature and exicting UX you will love using again & again.', 'frontend/image/clicon.jpg', '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(8, 'track-order', 'Track Order', 'Clicon is a beautifully designed ecommerce laravel script. Clicon has the best admin panel with lots of feature and exicting UX you will love using again & again.', 'frontend/image/clicon.jpg', '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(9, 'compare', 'Compare', 'Clicon is a beautifully designed ecommerce laravel script. Clicon has the best admin panel with lots of feature and exicting UX you will love using again & again.', 'frontend/image/clicon.jpg', '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(10, 'cart', 'Cart', 'Clicon is a beautifully designed ecommerce laravel script. Clicon has the best admin panel with lots of feature and exicting UX you will love using again & again.', 'frontend/image/clicon.jpg', '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(11, 'faq', 'FAQ', 'Clicon is a beautifully designed ecommerce laravel script. Clicon has the best admin panel with lots of feature and exicting UX you will love using again & again.', 'frontend/image/clicon.jpg', '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(12, 'terms-condition', 'Terms Condition', 'Clicon is a beautifully designed ecommerce laravel script. Clicon has the best admin panel with lots of feature and exicting UX you will love using again & again.', 'frontend/image/clicon.jpg', '2022-10-05 05:33:07', '2022-10-05 05:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `about_service` longtext COLLATE utf8mb4_unicode_ci,
  `price` int DEFAULT NULL,
  `time` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `image`, `slug`, `about_service`, `price`, `time`, `status`, `created_at`, `updated_at`, `parent_id`) VALUES
(1, 'Cleaning', 'uploads/category/pzwBqmc5BTQPQnoeDIm06tteS74NymiDT8xsYxJy.png', 'Cleaning', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, nulla earum. Obcaecati deleniti quod consequatur amet culpa porro omnis rem non, hic minus, assumenda inventore suscipit nobis officia quibusdam corrupti.', 129, 30, 1, '2022-11-14 18:00:18', '2022-12-30 22:04:59', '[]'),
(2, 'Polishing', 'uploads/category/VxEGozq3E2sqGHLdfEc1tXGtR7jnlCuYAz5ZbxJb.png', 'polishng', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, nulla earum. Obcaecati deleniti quod consequatur amet culpa porro omnis rem non, hic minus, assumenda inventore suscipit nobis officia quibusdam corrupti.', 100, 40, 1, '2022-11-14 18:00:56', '2022-11-14 18:00:56', '[]'),
(3, 'Waxing', 'uploads/category/Q4THHhjhrhCG7GouLRacC0aAQpjQkxVI7MbdyQay.png', '', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, nulla earum. Obcaecati deleniti quod consequatur amet culpa porro omnis rem non, hic minus, assumenda inventore suscipit nobis officia quibusdam corrupti.', 50, 30, 1, '2022-11-14 18:01:13', '2022-11-14 18:01:13', NULL),
(4, 'Interior Cleaning', 'uploads/category/3F3wppHa2EacO8u829lrQsBfYzkjIVaoKEcAVYaE.png', '', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, nulla earum. Obcaecati deleniti quod consequatur amet culpa porro omnis rem non, hic minus, assumenda inventore suscipit nobis officia quibusdam corrupti.', 80, 30, 1, '2022-11-14 18:01:36', '2022-11-14 18:01:36', NULL),
(5, 'Brakes', 'uploads/category/ZWdzuHYz3JVY8oDbU1ZTyKGy1UcR2BDh5rpNRmcP.png', '', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, nulla earum. Obcaecati deleniti quod consequatur amet culpa porro omnis rem non, hic minus, assumenda inventore suscipit nobis officia quibusdam corrupti.', 100, 30, 1, '2022-11-14 18:02:05', '2022-11-14 18:02:05', NULL),
(6, 'Vehicle Inspections', 'uploads/category/VcDQMOpo47LW0pdTRlZcqrhwlJTosGbjrGoVwDGj.png', '', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, nulla earum. Obcaecati deleniti quod consequatur amet culpa porro omnis rem non, hic minus, assumenda inventore suscipit nobis officia quibusdam corrupti.', 60, 20, 1, '2022-11-14 18:02:16', '2022-11-14 18:02:16', NULL),
(7, 'OIL CHANGE', 'uploads/category/6HbMBFHC7EydL74QRb81a6ySbYmkXSxRcWQolmpu.png', '', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, nulla earum. Obcaecati deleniti quod consequatur amet culpa porro omnis rem non, hic minus, assumenda inventore suscipit nobis officia quibusdam corrupti.', 40, 20, 1, '2022-11-14 18:02:49', '2022-11-14 18:02:49', NULL),
(8, 'TIRE & WHEEL SERVICES', 'uploads/category/TCrNqS01asqfFN0oCAlmLlsFU7x3aFUUNVuU82fO.png', '', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, nulla earum. Obcaecati deleniti quod consequatur amet culpa porro omnis rem non, hic minus, assumenda inventore suscipit nobis officia quibusdam corrupti.', 100, 50, 1, '2022-11-14 18:03:16', '2022-11-14 18:03:16', NULL),
(9, 'BATTERY REPLACEMENT', 'uploads/category/jPoSkJNGNP52nV5cADBizpbRA83xG5B0krzrGb83.png', '', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, nulla earum. Obcaecati deleniti quod consequatur amet culpa porro omnis rem non, hic minus, assumenda inventore suscipit nobis officia quibusdam corrupti.', 36, 20, 0, '2022-11-14 18:03:38', '2022-12-21 16:35:47', NULL),
(21, 'Wash w/ foam cannon', 'uploads/category/OSN2gWSy8Sb7qBaNFsvQDnL5F3Gq1VGXAzWiweP9.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:15:18', '2023-01-24 21:15:18', '0'),
(22, 'Rims', 'uploads/category/1P72SGtGEq56PtIaYkYOPDyEtxIr4ddJFWqrXcNe.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:19:31', '2023-01-24 21:19:31', '0'),
(23, 'Windows', 'uploads/category/cKGnLZlL8FVGL9J8B0jzBgdBMkepD4VGaVY0b2AH.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:20:37', '2023-01-24 21:20:37', '0'),
(24, 'Wax', 'uploads/category/M9sD1KqDmcTeIe8MRkzOCgIY8Us1fZNr6v1Zwn64.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:21:03', '2023-01-24 21:21:03', '0'),
(25, 'Polish', 'uploads/category/RoODnQzkBhunoIuc8hm4m16FF4PYO1O9BUpY5KFN.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:21:40', '2023-01-24 21:21:40', '0'),
(26, 'Trim Renewal', 'uploads/category/eEXdoqRs2ZaCSNfg2aZ7dp6sUWo2WK5zSqgwxd79.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:22:32', '2023-01-24 21:22:32', '0'),
(27, 'Engine Compartment', 'uploads/category/866iSF2nsmRUHuq1y1egHgFxOzxrhBvqMQUvYZ7z.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:23:02', '2023-01-24 21:23:02', '0'),
(28, 'Paint Seal', 'uploads/category/O39NSyoDEcshEJlovChcPq9iZ3fBa1hvF89c1Mbn.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:23:45', '2023-01-24 21:23:45', '0'),
(29, 'Tire Clean & Shine', 'uploads/category/mwCRsCsSWoq1qTtfFEldwJWdlO3QBCgSJ9q1N4Dr.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:24:41', '2023-01-24 21:24:41', '0'),
(30, 'Exterior steam clean', 'uploads/category/mTGNpFHD4qayqcEK2F9Z8BdeyV7Aw7uHrOYY3sqs.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:25:31', '2023-01-24 21:25:31', '0'),
(31, 'Undercarriage Clean', 'uploads/category/8VgxSKVzUMl4lgKRsIFf7ziz154wclkbT4NyZMVY.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:26:21', '2023-01-24 21:26:21', '0'),
(32, 'Exhaust Polishing', 'uploads/category/DveQfbgL9ZnHJikEOGZveOsm9M8UsRNr2MnSxCko.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:27:15', '2023-01-24 21:27:15', '0'),
(33, 'Deionized Spot-free Rinse', 'uploads/category/FRVZ0w75QBSR3b9vYqyaXSp71vy35KKbU3MFBw2L.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:30:05', '2023-01-24 21:30:05', '0'),
(34, 'Clay Bar', 'uploads/category/l2UNOsXrUPqRJoVNUDOBazCouKqkXlM70jF405pa.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:30:35', '2023-01-24 21:30:35', '0'),
(35, 'Hand Wash Stage 2', 'uploads/category/L9UMVqOT5QR7Ru3duXBtLJe0YSWT4m3RluFjbfFY.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:31:07', '2023-01-24 21:31:07', '0'),
(36, 'Ceramic Coating', 'uploads/category/6K2frfgvJANFDLyDJGIUSnqwA22TuWRqb9Ybgy6U.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:31:35', '2023-01-24 21:31:35', '0'),
(37, 'Ceramic Coating', 'uploads/category/2cMlNH6zfxDIfHJfZPNS8ePfDy4MSXf7niXFtgfy.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:31:36', '2023-01-24 21:31:36', '0'),
(38, 'Headlight Renewal', 'uploads/category/o4HVPEa60iCHEgGxlnI6NIvIbIizvLOOkiZJ2CCX.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:31:57', '2023-01-24 21:31:57', '0'),
(39, 'Paint Corrections', 'uploads/category/RZlXG0FxQmsGjvqgWfNJaxGiF0FGRSbIa4TvN6hJ.png', '', NULL, NULL, NULL, 1, '2023-01-24 21:32:28', '2023-01-24 21:32:28', '0'),
(40, 'Ozone Treatment', 'uploads/category/oKcXciUPycRR2Ma5lvsPb7q4dhHQCog5bjf8lCEy.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:10:30', '2023-01-24 22:10:30', '0'),
(41, 'Headliner', 'uploads/category/MpbSZQTwBHmHxZaXQkwdOhz0kun9NWsfaob2J00X.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:11:28', '2023-01-24 22:11:28', '0'),
(42, 'Vaccum', 'uploads/category/EEuH5jtXSEd97jwb51hQOIHVz6EI2yGrhLWSbeoZ.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:12:13', '2023-01-24 22:12:13', '0'),
(43, 'Vent Cleaning', 'uploads/category/8i4ljZU3RZdnmyJJhD1uWQsCzcmFrxPydfG6Bl5O.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:12:54', '2023-01-24 22:12:54', '0'),
(44, 'Steam Cleaning', 'uploads/category/bSlbu0v3e6CWlTdDA6jQXzeJxWYr8HgUhT6b8g5l.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:13:50', '2023-01-24 22:13:50', '0'),
(45, 'Surface Wipe', 'uploads/category/GR4eTfHpE4IAwEJAIA3YMZ2x3XbUTacFBYLm4ApK.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:14:15', '2023-01-24 22:14:15', '0'),
(46, 'Surface Disinfect', 'uploads/category/IukMjNRIh7wPXzbgXmMlg9BKsIOL5BtrVJRzwgAk.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:14:46', '2023-01-24 22:14:46', '0'),
(47, 'Spot Removal', 'uploads/category/laivaTCFHWR8pdRuqdePilpDx9YhMWaoGyxxSWG8.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:15:13', '2023-01-24 22:15:13', '0'),
(48, 'Carpet Clean/Weather Matts', 'uploads/category/oAyyLzIJLI0adjZ3hT08KWW2NbcJ8D1Pdmnevp5h.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:16:08', '2023-01-24 22:16:08', '0'),
(49, 'Carpet Shampoo', 'uploads/category/Xc7Anuwo0sw5UTK682KXWFx3jdrE931oxZdHD1yf.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:16:36', '2023-01-24 22:16:36', '0'),
(50, 'Carpet Extraction', 'uploads/category/PKE6eADdahsfj3ZwtMjKXm8mk0tpj345uSo1YiSX.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:17:04', '2023-01-24 22:17:04', '0'),
(51, 'Windows', 'uploads/category/CmwAODWA2RtMIdJUkHjmLyw3wTILxFOwUPBHBl7A.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:17:47', '2023-01-24 22:17:47', '0'),
(52, 'Seats', 'uploads/category/0CCsVUtp0heByZcQOHPO4BEQdTb33toHuiWpLbaG.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:18:36', '2023-01-24 22:18:36', '0'),
(53, 'Seat Conditioning', 'uploads/category/1Sw4eUf3zQMT2J97GuMn3w29wxT7jROPDqwSZPgZ.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:21:20', '2023-01-24 22:21:20', '0'),
(54, 'Leather Conditioning', 'uploads/category/kRfuMqtHP59uvkXD4eUjZPibmlCyBulGU6vhpspi.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:21:59', '2023-01-24 22:21:59', '0'),
(56, 'Pet Hair removal', 'uploads/category/FAhEL6ZV16nCDare6UORF2gAe0y9EOy0NHWz8fOm.png', '', NULL, NULL, NULL, 1, '2023-01-24 22:24:20', '2023-01-24 22:24:20', '0');

-- --------------------------------------------------------

--
-- Table structure for table `service_bookeds`
--

CREATE TABLE `service_bookeds` (
  `id` int NOT NULL,
  `booking_id` int NOT NULL,
  `service_id` int NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `service_bookeds`
--

INSERT INTO `service_bookeds` (`id`, `booking_id`, `service_id`, `price`, `created_at`, `updated_at`) VALUES
(5, 4, 1, 129, '2023-01-31 20:25:00', '2023-01-31 20:25:00'),
(6, 5, 1, 129, '2023-02-01 01:18:53', '2023-02-01 01:18:53'),
(7, 6, 1, 129, '2023-02-01 17:11:07', '2023-02-01 17:11:07'),
(8, 6, 2, 100, '2023-02-01 17:11:07', '2023-02-01 17:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `service_bookings`
--

CREATE TABLE `service_bookings` (
  `id` int NOT NULL,
  `booking_no` varchar(200) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `subtotal_price` int DEFAULT NULL,
  `tax_price` int DEFAULT NULL,
  `total_price` int DEFAULT NULL,
  `payment_status` varchar(200) DEFAULT 'unpaid',
  `order_status` varchar(200) DEFAULT NULL,
  `payment_method` varchar(200) DEFAULT NULL,
  `service_date` varchar(200) DEFAULT NULL,
  `service_time` varchar(200) DEFAULT NULL,
  `service_status` varchar(200) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `sp_status` varchar(200) DEFAULT 'schedule',
  `lattitude` varchar(200) DEFAULT NULL,
  `longitude` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `landmark` varchar(200) DEFAULT NULL,
  `note` longtext,
  `admin_note` longtext,
  `transaction_id` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `before_images` text,
  `after_images` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `service_bookings`
--

INSERT INTO `service_bookings` (`id`, `booking_no`, `user_id`, `subtotal_price`, `tax_price`, `total_price`, `payment_status`, `order_status`, `payment_method`, `service_date`, `service_time`, `service_status`, `status`, `sp_status`, `lattitude`, `longitude`, `address`, `landmark`, `note`, `admin_note`, `transaction_id`, `before_images`, `after_images`, `created_at`, `updated_at`) VALUES
(4, '00000004', 8, 129, 10, 142, 'paid', 'paid', 'card', '2023-01-31', '04:30 PM', 'completed', NULL, 'instant', '56.130365885484416', '-106.34677095338702', 'S0J 2B0, , Pinehouse, Saskatchewan, CA, S0J 2B0', NULL, 'hhshs', NULL, NULL, '[]', '[\"2023013110201.png\"]', '2023-01-31 15:25:00', '2023-01-31 10:20:52'),
(5, '00000005', 11, 129, 10, 142, 'paid', 'paid', 'card', '2023-02-01', '10:00 AM', 'pending', NULL, 'schedule', '22.313059703524754', '73.16409504041076', 'Vadodara, Vadiwadi, Vadodara, Gujarat, IN, 390007', NULL, 'tets', NULL, NULL, '[]', NULL, '2023-01-31 20:18:53', '2023-01-31 20:18:53'),
(6, '00000006', 10, 229, 10, 252, 'paid', 'paid', 'card', '2023-02-01', '04:00 PM', 'completed', NULL, 'schedule', '21.1843631', '72.7924497', '5QMR+QX9, Adajan Gam, Adajan, Surat, Gujarat 395009, India', NULL, NULL, NULL, NULL, '[\"202302010640_0.png\"]', '[\"202302010652_0.png\"]', '2023-02-01 12:11:07', '2023-02-01 06:52:49');

-- --------------------------------------------------------

--
-- Table structure for table `service_carts`
--

CREATE TABLE `service_carts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `service_product_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `service_carts`
--

INSERT INTO `service_carts` (`id`, `user_id`, `service_product_id`, `created_at`, `updated_at`) VALUES
(26, 61, 2, '2022-12-06 16:07:19', '2022-12-06 16:07:19'),
(27, 61, 4, '2022-12-06 16:07:31', '2022-12-06 16:07:31'),
(56, 28, 1, '2022-12-13 10:57:43', '2022-12-13 10:57:43'),
(85, 102, 1, '2022-12-15 15:58:14', '2022-12-15 15:58:14'),
(160, 18, 8, '2022-12-19 15:23:26', '2022-12-19 15:23:26'),
(264, 121, 5, '2022-12-28 10:22:06', '2022-12-28 10:22:06'),
(319, 136, 1, '2023-01-06 12:13:26', '2023-01-06 12:13:26'),
(326, 138, 1, '2023-01-06 21:05:13', '2023-01-06 21:05:13'),
(327, 54, 3, '2023-01-09 10:07:59', '2023-01-09 10:07:59'),
(369, 144, 8, '2023-01-12 17:43:02', '2023-01-12 17:43:02'),
(370, 144, 7, '2023-01-12 17:43:10', '2023-01-12 17:43:10'),
(371, 144, 6, '2023-01-12 17:43:18', '2023-01-12 17:43:18'),
(372, 144, 5, '2023-01-12 17:43:29', '2023-01-12 17:43:29'),
(377, 127, 2, '2023-01-16 11:51:41', '2023-01-16 11:51:41'),
(441, 150, 1, '2023-01-23 18:32:42', '2023-01-23 18:32:42'),
(484, 164, 1, '2023-01-30 18:19:23', '2023-01-30 18:19:23'),
(490, 5, 4, '2023-01-31 14:24:25', '2023-01-31 14:24:25'),
(494, 8, 1, '2023-01-31 19:06:32', '2023-01-31 19:06:32'),
(498, 11, 1, '2023-02-01 12:41:08', '2023-02-01 12:41:08'),
(499, 10, 1, '2023-02-01 12:47:40', '2023-02-01 12:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `service_products`
--

CREATE TABLE `service_products` (
  `id` int NOT NULL,
  `service_category_id` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `time` time(6) DEFAULT NULL,
  `about_service` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `service_products`
--

INSERT INTO `service_products` (`id`, `service_category_id`, `price`, `time`, `about_service`, `created_at`, `updated_at`) VALUES
(1, 1, 123, '00:20:22.000000', '<p>asdas das das &nbsp;we rwe rwr</p>', '2022-10-13 05:23:43', '2022-10-13 05:23:43'),
(2, 3, 123, NULL, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt sint voluptas corporis dolor nihil quae illum, dolorem dolore sapiente, minus ut omnis dignissimos libero esse modi veniam nesciunt odio culpa.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt sint voluptas corporis dolor nihil quae illum, dolorem dolore sapiente, minus ut omnis dignissimos libero esse modi veniam nesciunt odio culpa.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt sint voluptas corporis dolor nihil quae illum, dolorem dolore sapiente, minus ut omnis dignissimos libero esse modi veniam nesciunt odio culpa.</p>', '2022-10-13 05:24:37', '2022-10-13 05:24:37'),
(3, 5, 1233, '00:20:22.000000', '<p>asdas das das &nbsp;asdasdasd asd</p>', '2022-10-13 05:56:41', '2022-10-13 05:56:41'),
(4, 3, 123444, '00:20:22.000000', '<p>&nbsp;awea eaw eawe asd adasd as d</p>', '2022-10-13 05:57:11', '2022-10-13 05:57:11'),
(5, 2, 123, '14:28:00.000000', '<p>&nbsp;asd asd asda sd asd</p>', '2022-10-13 05:58:46', '2022-10-13 05:58:46'),
(6, 3, 1222, '13:11:00.000000', '<p>asdas d adasd</p>', '2022-11-25 06:39:10', '2022-11-25 06:39:10'),
(7, 4, 12222, '16:14:00.000000', '<p>a sd asda sd asdasd</p>', '2022-11-25 06:39:27', '2022-11-25 06:39:27'),
(8, 1, 10, '15:00:00.000000', '<p>yy</p>', '2022-11-25 06:39:37', '2022-11-25 06:39:37'),
(9, 9, 120, '21:00:00.000000', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2022-12-05 09:44:52', '2022-12-05 09:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `owner_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo_image2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_css` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `header_script` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `body_script` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sidebar_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nav_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sidebar_txt_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nav_txt_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accent_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frontend_primary_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frontend_secondary_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frontend_navbar_bg_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frontend_navbar_txt_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `facebook_pixel` tinyint(1) NOT NULL DEFAULT '0',
  `google_analytics` tinyint(1) NOT NULL DEFAULT '0',
  `search_engine_indexing` tinyint(1) NOT NULL DEFAULT '1',
  `comingsoon_mode` tinyint(1) NOT NULL DEFAULT '0',
  `default_layout` tinyint(1) NOT NULL DEFAULT '1',
  `language_changing` tinyint(1) NOT NULL DEFAULT '1',
  `email_verification` tinyint(1) NOT NULL DEFAULT '0',
  `about_us` longtext COLLATE utf8mb4_unicode_ci,
  `privacy_policy` longtext COLLATE utf8mb4_unicode_ci,
  `terms_condition` longtext COLLATE utf8mb4_unicode_ci,
  `Delivery_charges` int DEFAULT NULL,
  `tax` int DEFAULT NULL,
  `lattitude` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `square_appid` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `square_accesstoken` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accountSid` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serviceSid` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authtoken` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_station_address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_station_lat` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_station_long` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `owner_email`, `logo_image`, `logo_image2`, `favicon_image`, `header_css`, `header_script`, `body_script`, `sidebar_color`, `nav_color`, `sidebar_txt_color`, `nav_txt_color`, `main_color`, `accent_color`, `frontend_primary_color`, `frontend_secondary_color`, `frontend_navbar_bg_color`, `frontend_navbar_txt_color`, `dark_mode`, `facebook_pixel`, `google_analytics`, `search_engine_indexing`, `comingsoon_mode`, `default_layout`, `language_changing`, `email_verification`, `about_us`, `privacy_policy`, `terms_condition`, `Delivery_charges`, `tax`, `lattitude`, `longitude`, `square_appid`, `square_accesstoken`, `accountSid`, `serviceSid`, `authtoken`, `service_station_address`, `service_station_lat`, `service_station_long`, `created_at`, `updated_at`) VALUES
(1, 'glossman@yopmail.com', 'uploads/app/logo/NsGd5Q2gFe4vLGmZYMOShsq7a8W4W9PBpa9LDEuV.png', 'uploads/app/logo/UHqVW903Wa7kvbZL7fQdKOBUG6LPC5kfB1SxfWhm.png', 'uploads/app/logo/mkB71yaG1xLMtOg2VniYsD0zPHDVklb2HcN91jPc.png', NULL, NULL, NULL, '#022446', '#0a243e', '#e0e9f2', '#e0e9f2', '#45A2D6', '#C67339', '#FA8232', '#2DA5F3', '#2DA5F3', '#ffffff', 0, 0, 0, 1, 0, 1, 1, 0, '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p>\r\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!Anji</p>', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p>', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore nobis eius suscipit inventore mollitia. Magnam totam, numquam nisi quisquam error neque mollitia fugit quam perferendis ad, quae ullam nulla tempora!11</p>', 100, 10, NULL, NULL, 'sandbox-sq0idb-HTwzl5t4Lrx1aevLMF44nA', 'EAAAECmaiOY69xKEPhTkMYbjum-sTLg57idXiHctuxyPsJO817dQb_UiclLuHtJv', 'AC8d55769e9f73ed1395be282e985cee8e', 'VA01a7f9b09e9009d4a62aa7e40253831f', 'c611c544379a22535cb4c65966f6d1d0', 'Surat gujarat, India', '21.2049', '72.8411', '2022-10-05 05:33:07', '2023-01-09 16:27:48');

-- --------------------------------------------------------

--
-- Table structure for table `setup_guides`
--

CREATE TABLE `setup_guides` (
  `id` bigint UNSIGNED NOT NULL,
  `task_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_route` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setup_guides`
--

INSERT INTO `setup_guides` (`id`, `task_name`, `title`, `description`, `action_route`, `action_label`, `status`, `created_at`, `updated_at`) VALUES
(1, 'app_setting', 'App Information ', 'Add your app logo, name, description, owner and other information.', 'settings.general', 'Add App Information', 1, '2022-10-05 05:33:07', '2022-11-25 11:14:22'),
(2, 'smtp_setting', 'SMTP Configuration', 'Add your app logo, name, description, owner and other information.', 'settings.email', 'Add Mail Configuration', 1, '2022-10-05 05:33:07', '2022-10-11 23:27:13'),
(3, 'payment_setting', 'Enable Payment Method', 'Enable to payment methods to receive payments from your customer.', 'settings.payment', 'Add Payment', 1, '2022-10-05 05:33:07', '2022-12-30 17:39:28'),
(4, 'theme_setting', 'Customize Theme', 'Customize your theme to make your app look more attractive.', 'settings.theme', 'Customize Your App Now', 1, '2022-10-05 05:33:07', '2022-11-25 11:25:02');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_type` enum('flat','free','local_pickup') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`id`, `name`, `shipping_type`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Flat Rate', 'flat', 50.00, 1, '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(2, 'Free Shipping', 'free', 0.00, 1, '2022-10-05 05:33:07', '2022-10-05 05:33:07'),
(3, 'Local Pickup', 'local_pickup', 20.00, 1, '2022-10-05 05:33:07', '2022-10-05 05:33:07');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'Show Now',
  `button_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `sub_title`, `details`, `button_text`, `button_url`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Slider Title', 'Slider Sub Title', 'This is slider description', 'Show Now', NULL, 0, 'uploads/slider/1671791341_63a582ed8ff8b.png', '2022-10-05 05:33:07', '2022-12-23 10:29:01'),
(2, 'test one', 'test one', 'test one', 'test slider', 'https://www.google.com/', 12, 'uploads/slider/1671791383_63a5831736638.png', '2022-10-13 23:35:13', '2022-12-23 10:29:43'),
(5, 'Glossman service', 'Glossman service', 'Glossmanservice', 'Glossman', 'https://glossman.bigbyte.app/admin/slider/add', 10, 'uploads/slider/1671791306_63a582ca66782.png', '2022-12-05 20:59:08', '2022-12-23 10:28:26');

-- --------------------------------------------------------

--
-- Table structure for table `ssl_orders`
--

CREATE TABLE `ssl_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `snap_token` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`, `slug`, `created_at`, `updated_at`) VALUES
(658, 'Alberta', 38, 'alberta', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(659, 'British Columbia', 38, 'british-columbia', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(660, 'Manitoba', 38, 'manitoba', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(661, 'New Brunswick', 38, 'new-brunswick', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(662, 'Newfoundland and Labrador', 38, 'newfoundland-and-labrador', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(663, 'Northwest Territories', 38, 'northwest-territories', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(664, 'Nova Scotia', 38, 'nova-scotia', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(665, 'Nunavut', 38, 'nunavut', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(666, 'Ontario', 38, 'ontario', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(667, 'Prince Edward Island', 38, 'prince-edward-island', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(668, 'Quebec', 38, 'quebec', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(669, 'Saskatchewan', 38, 'saskatchewan', '2022-10-05 05:33:06', '2022-10-05 05:33:06'),
(670, 'Yukon', 38, 'yukon', '2022-10-05 05:33:06', '2022-10-05 05:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `status_record`
--

CREATE TABLE `status_record` (
  `id` int NOT NULL,
  `type` int DEFAULT NULL,
  `order_id` int DEFAULT NULL,
  `status` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_record`
--

INSERT INTO `status_record` (`id`, `type`, `order_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'pending', '2023-01-31 17:18:22', '2023-01-31 17:18:22'),
(2, 1, 1, 'Processing', '2023-01-31 09:19:47', '2023-01-31 09:19:47'),
(3, 2, 2, 'pending', '2023-01-31 19:59:10', '2023-01-31 19:59:10'),
(4, 1, 1, 'on_the_way', '2023-01-31 09:30:04', '2023-01-31 09:30:04'),
(5, 1, 1, 'delivered', '2023-01-31 09:31:51', '2023-01-31 09:31:51'),
(6, 2, 3, 'pending', '2023-01-31 20:02:37', '2023-01-31 20:02:37'),
(7, 2, 4, 'pending', '2023-01-31 20:25:00', '2023-01-31 20:25:00'),
(8, 1, 2, 'Processing', '2023-01-31 10:09:31', '2023-01-31 10:09:31'),
(9, 1, 2, 'pending', '2023-01-31 10:13:07', '2023-01-31 10:13:07'),
(10, 2, 4, 'accept', '2023-01-31 20:48:54', '2023-01-31 20:48:54'),
(11, 2, 4, 'ongoing', '2023-01-31 20:49:28', '2023-01-31 20:49:28'),
(12, 2, 4, 'completed', '2023-01-31 20:49:43', '2023-01-31 20:49:43'),
(13, 1, 3, 'Processing', '2023-01-31 23:14:11', '2023-01-31 23:14:11'),
(14, 2, 5, 'pending', '2023-02-01 01:18:53', '2023-02-01 01:18:53'),
(15, 1, 3, 'on_the_way', '2023-02-01 06:23:14', '2023-02-01 06:23:14'),
(16, 1, 3, 'delivered', '2023-02-01 06:23:29', '2023-02-01 06:23:29'),
(17, 2, 6, 'pending', '2023-02-01 17:11:07', '2023-02-01 17:11:07'),
(18, 2, 6, 'accept', '2023-02-01 17:13:49', '2023-02-01 17:13:49'),
(19, 2, 6, 'ontheway', '2023-02-01 17:14:12', '2023-02-01 17:14:12'),
(20, 2, 6, 'ongoing', '2023-02-01 17:14:26', '2023-02-01 17:14:26'),
(21, 2, 6, 'completed', '2023-02-01 17:14:52', '2023-02-01 17:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `timezones`
--

CREATE TABLE `timezones` (
  `id` bigint UNSIGNED NOT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timezones`
--

INSERT INTO `timezones` (`id`, `value`) VALUES
(1, 'Africa/Abidjan'),
(2, 'Africa/Accra'),
(3, 'Africa/Addis_Ababa'),
(4, 'Africa/Algiers'),
(5, 'Africa/Asmara'),
(6, 'Africa/Bamako'),
(7, 'Africa/Bangui'),
(8, 'Africa/Banjul'),
(9, 'Africa/Bissau'),
(10, 'Africa/Blantyre'),
(11, 'Africa/Brazzaville'),
(12, 'Africa/Bujumbura'),
(13, 'Africa/Cairo'),
(14, 'Africa/Casablanca'),
(15, 'Africa/Ceuta'),
(16, 'Africa/Conakry'),
(17, 'Africa/Dakar'),
(18, 'Africa/Dar_es_Salaam'),
(19, 'Africa/Djibouti'),
(20, 'Africa/Douala'),
(21, 'Africa/El_Aaiun'),
(22, 'Africa/Freetown'),
(23, 'Africa/Gaborone'),
(24, 'Africa/Harare'),
(25, 'Africa/Johannesburg'),
(26, 'Africa/Juba'),
(27, 'Africa/Kampala'),
(28, 'Africa/Khartoum'),
(29, 'Africa/Kigali'),
(30, 'Africa/Kinshasa'),
(31, 'Africa/Lagos'),
(32, 'Africa/Libreville'),
(33, 'Africa/Lome'),
(34, 'Africa/Luanda'),
(35, 'Africa/Lubumbashi'),
(36, 'Africa/Lusaka'),
(37, 'Africa/Malabo'),
(38, 'Africa/Maputo'),
(39, 'Africa/Maseru'),
(40, 'Africa/Mbabane'),
(41, 'Africa/Mogadishu'),
(42, 'Africa/Monrovia'),
(43, 'Africa/Nairobi'),
(44, 'Africa/Ndjamena'),
(45, 'Africa/Niamey'),
(46, 'Africa/Nouakchott'),
(47, 'Africa/Ouagadougou'),
(48, 'Africa/Porto-Novo'),
(49, 'Africa/Sao_Tome'),
(50, 'Africa/Tripoli'),
(51, 'Africa/Tunis'),
(52, 'Africa/Windhoek'),
(53, 'America/Adak'),
(54, 'America/Anchorage'),
(55, 'America/Anguilla'),
(56, 'America/Antigua'),
(57, 'America/Araguaina'),
(58, 'America/Argentina/Buenos_Aires'),
(59, 'America/Argentina/Catamarca'),
(60, 'America/Argentina/Cordoba'),
(61, 'America/Argentina/Jujuy'),
(62, 'America/Argentina/La_Rioja'),
(63, 'America/Argentina/Mendoza'),
(64, 'America/Argentina/Rio_Gallegos'),
(65, 'America/Argentina/Salta'),
(66, 'America/Argentina/San_Juan'),
(67, 'America/Argentina/San_Luis'),
(68, 'America/Argentina/Tucuman'),
(69, 'America/Argentina/Ushuaia'),
(70, 'America/Aruba'),
(71, 'America/Asuncion'),
(72, 'America/Atikokan'),
(73, 'America/Bahia'),
(74, 'America/Bahia_Banderas'),
(75, 'America/Barbados'),
(76, 'America/Belem'),
(77, 'America/Belize'),
(78, 'America/Blanc-Sablon'),
(79, 'America/Boa_Vista'),
(80, 'America/Bogota'),
(81, 'America/Boise'),
(82, 'America/Cambridge_Bay'),
(83, 'America/Campo_Grande'),
(84, 'America/Cancun'),
(85, 'America/Caracas'),
(86, 'America/Cayenne'),
(87, 'America/Cayman'),
(88, 'America/Chicago'),
(89, 'America/Chihuahua'),
(90, 'America/Costa_Rica'),
(91, 'America/Creston'),
(92, 'America/Cuiaba'),
(93, 'America/Curacao'),
(94, 'America/Danmarkshavn'),
(95, 'America/Dawson'),
(96, 'America/Dawson_Creek'),
(97, 'America/Denver'),
(98, 'America/Detroit'),
(99, 'America/Dominica'),
(100, 'America/Edmonton'),
(101, 'America/Eirunepe'),
(102, 'America/El_Salvador'),
(103, 'America/Fort_Nelson'),
(104, 'America/Fortaleza'),
(105, 'America/Glace_Bay'),
(106, 'America/Goose_Bay'),
(107, 'America/Grand_Turk'),
(108, 'America/Grenada'),
(109, 'America/Guadeloupe'),
(110, 'America/Guatemala'),
(111, 'America/Guayaquil'),
(112, 'America/Guyana'),
(113, 'America/Halifax'),
(114, 'America/Havana'),
(115, 'America/Hermosillo'),
(116, 'America/Indiana/Indianapolis'),
(117, 'America/Indiana/Knox'),
(118, 'America/Indiana/Marengo'),
(119, 'America/Indiana/Petersburg'),
(120, 'America/Indiana/Tell_City'),
(121, 'America/Indiana/Vevay'),
(122, 'America/Indiana/Vincennes'),
(123, 'America/Indiana/Winamac'),
(124, 'America/Inuvik'),
(125, 'America/Iqaluit'),
(126, 'America/Jamaica'),
(127, 'America/Juneau'),
(128, 'America/Kentucky/Louisville'),
(129, 'America/Kentucky/Monticello'),
(130, 'America/Kralendijk'),
(131, 'America/La_Paz'),
(132, 'America/Lima'),
(133, 'America/Los_Angeles'),
(134, 'America/Lower_Princes'),
(135, 'America/Maceio'),
(136, 'America/Managua'),
(137, 'America/Manaus'),
(138, 'America/Marigot'),
(139, 'America/Martinique'),
(140, 'America/Matamoros'),
(141, 'America/Mazatlan'),
(142, 'America/Menominee'),
(143, 'America/Merida'),
(144, 'America/Metlakatla'),
(145, 'America/Mexico_City'),
(146, 'America/Miquelon'),
(147, 'America/Moncton'),
(148, 'America/Monterrey'),
(149, 'America/Montevideo'),
(150, 'America/Montserrat'),
(151, 'America/Nassau'),
(152, 'America/New_York'),
(153, 'America/Nipigon'),
(154, 'America/Nome'),
(155, 'America/Noronha'),
(156, 'America/North_Dakota/Beulah'),
(157, 'America/North_Dakota/Center'),
(158, 'America/North_Dakota/New_Salem'),
(159, 'America/Nuuk'),
(160, 'America/Ojinaga'),
(161, 'America/Panama'),
(162, 'America/Pangnirtung'),
(163, 'America/Paramaribo'),
(164, 'America/Phoenix'),
(165, 'America/Port-au-Prince'),
(166, 'America/Port_of_Spain'),
(167, 'America/Porto_Velho'),
(168, 'America/Puerto_Rico'),
(169, 'America/Punta_Arenas'),
(170, 'America/Rainy_River'),
(171, 'America/Rankin_Inlet'),
(172, 'America/Recife'),
(173, 'America/Regina'),
(174, 'America/Resolute'),
(175, 'America/Rio_Branco'),
(176, 'America/Santarem'),
(177, 'America/Santiago'),
(178, 'America/Santo_Domingo'),
(179, 'America/Sao_Paulo'),
(180, 'America/Scoresbysund'),
(181, 'America/Sitka'),
(182, 'America/St_Barthelemy'),
(183, 'America/St_Johns'),
(184, 'America/St_Kitts'),
(185, 'America/St_Lucia'),
(186, 'America/St_Thomas'),
(187, 'America/St_Vincent'),
(188, 'America/Swift_Current'),
(189, 'America/Tegucigalpa'),
(190, 'America/Thule'),
(191, 'America/Thunder_Bay'),
(192, 'America/Tijuana'),
(193, 'America/Toronto'),
(194, 'America/Tortola'),
(195, 'America/Vancouver'),
(196, 'America/Whitehorse'),
(197, 'America/Winnipeg'),
(198, 'America/Yakutat'),
(199, 'America/Yellowknife'),
(200, 'Antarctica/Casey'),
(201, 'Antarctica/Davis'),
(202, 'Antarctica/DumontDUrville'),
(203, 'Antarctica/Macquarie'),
(204, 'Antarctica/Mawson'),
(205, 'Antarctica/McMurdo'),
(206, 'Antarctica/Palmer'),
(207, 'Antarctica/Rothera'),
(208, 'Antarctica/Syowa'),
(209, 'Antarctica/Troll'),
(210, 'Antarctica/Vostok'),
(211, 'Arctic/Longyearbyen'),
(212, 'Asia/Aden'),
(213, 'Asia/Almaty'),
(214, 'Asia/Amman'),
(215, 'Asia/Anadyr'),
(216, 'Asia/Aqtau'),
(217, 'Asia/Aqtobe'),
(218, 'Asia/Ashgabat'),
(219, 'Asia/Atyrau'),
(220, 'Asia/Baghdad'),
(221, 'Asia/Bahrain'),
(222, 'Asia/Baku'),
(223, 'Asia/Bangkok'),
(224, 'Asia/Barnaul'),
(225, 'Asia/Beirut'),
(226, 'Asia/Bishkek'),
(227, 'Asia/Brunei'),
(228, 'Asia/Chita'),
(229, 'Asia/Choibalsan'),
(230, 'Asia/Colombo'),
(231, 'Asia/Damascus'),
(232, 'Asia/Dhaka'),
(233, 'Asia/Dili'),
(234, 'Asia/Dubai'),
(235, 'Asia/Dushanbe'),
(236, 'Asia/Famagusta'),
(237, 'Asia/Gaza'),
(238, 'Asia/Hebron'),
(239, 'Asia/Ho_Chi_Minh'),
(240, 'Asia/Hong_Kong'),
(241, 'Asia/Hovd'),
(242, 'Asia/Irkutsk'),
(243, 'Asia/Jakarta'),
(244, 'Asia/Jayapura'),
(245, 'Asia/Jerusalem'),
(246, 'Asia/Kabul'),
(247, 'Asia/Kamchatka'),
(248, 'Asia/Karachi'),
(249, 'Asia/Kathmandu'),
(250, 'Asia/Khandyga'),
(251, 'Asia/Kolkata'),
(252, 'Asia/Krasnoyarsk'),
(253, 'Asia/Kuala_Lumpur'),
(254, 'Asia/Kuching'),
(255, 'Asia/Kuwait'),
(256, 'Asia/Macau'),
(257, 'Asia/Magadan'),
(258, 'Asia/Makassar'),
(259, 'Asia/Manila'),
(260, 'Asia/Muscat'),
(261, 'Asia/Nicosia'),
(262, 'Asia/Novokuznetsk'),
(263, 'Asia/Novosibirsk'),
(264, 'Asia/Omsk'),
(265, 'Asia/Oral'),
(266, 'Asia/Phnom_Penh'),
(267, 'Asia/Pontianak'),
(268, 'Asia/Pyongyang'),
(269, 'Asia/Qatar'),
(270, 'Asia/Qostanay'),
(271, 'Asia/Qyzylorda'),
(272, 'Asia/Riyadh'),
(273, 'Asia/Sakhalin'),
(274, 'Asia/Samarkand'),
(275, 'Asia/Seoul'),
(276, 'Asia/Shanghai'),
(277, 'Asia/Singapore'),
(278, 'Asia/Srednekolymsk'),
(279, 'Asia/Taipei'),
(280, 'Asia/Tashkent'),
(281, 'Asia/Tbilisi'),
(282, 'Asia/Tehran'),
(283, 'Asia/Thimphu'),
(284, 'Asia/Tokyo'),
(285, 'Asia/Tomsk'),
(286, 'Asia/Ulaanbaatar'),
(287, 'Asia/Urumqi'),
(288, 'Asia/Ust-Nera'),
(289, 'Asia/Vientiane'),
(290, 'Asia/Vladivostok'),
(291, 'Asia/Yakutsk'),
(292, 'Asia/Yangon'),
(293, 'Asia/Yekaterinburg'),
(294, 'Asia/Yerevan'),
(295, 'Atlantic/Azores'),
(296, 'Atlantic/Bermuda'),
(297, 'Atlantic/Canary'),
(298, 'Atlantic/Cape_Verde'),
(299, 'Atlantic/Faroe'),
(300, 'Atlantic/Madeira'),
(301, 'Atlantic/Reykjavik'),
(302, 'Atlantic/South_Georgia'),
(303, 'Atlantic/St_Helena'),
(304, 'Atlantic/Stanley'),
(305, 'Australia/Adelaide'),
(306, 'Australia/Brisbane'),
(307, 'Australia/Broken_Hill'),
(308, 'Australia/Darwin'),
(309, 'Australia/Eucla'),
(310, 'Australia/Hobart'),
(311, 'Australia/Lindeman'),
(312, 'Australia/Lord_Howe'),
(313, 'Australia/Melbourne'),
(314, 'Australia/Perth'),
(315, 'Australia/Sydney'),
(316, 'Europe/Amsterdam'),
(317, 'Europe/Andorra'),
(318, 'Europe/Astrakhan'),
(319, 'Europe/Athens'),
(320, 'Europe/Belgrade'),
(321, 'Europe/Berlin'),
(322, 'Europe/Bratislava'),
(323, 'Europe/Brussels'),
(324, 'Europe/Bucharest'),
(325, 'Europe/Budapest'),
(326, 'Europe/Busingen'),
(327, 'Europe/Chisinau'),
(328, 'Europe/Copenhagen'),
(329, 'Europe/Dublin'),
(330, 'Europe/Gibraltar'),
(331, 'Europe/Guernsey'),
(332, 'Europe/Helsinki'),
(333, 'Europe/Isle_of_Man'),
(334, 'Europe/Istanbul'),
(335, 'Europe/Jersey'),
(336, 'Europe/Kaliningrad'),
(337, 'Europe/Kiev'),
(338, 'Europe/Kirov'),
(339, 'Europe/Lisbon'),
(340, 'Europe/Ljubljana'),
(341, 'Europe/London'),
(342, 'Europe/Luxembourg'),
(343, 'Europe/Madrid'),
(344, 'Europe/Malta'),
(345, 'Europe/Mariehamn'),
(346, 'Europe/Minsk'),
(347, 'Europe/Monaco'),
(348, 'Europe/Moscow'),
(349, 'Europe/Oslo'),
(350, 'Europe/Paris'),
(351, 'Europe/Podgorica'),
(352, 'Europe/Prague'),
(353, 'Europe/Riga'),
(354, 'Europe/Rome'),
(355, 'Europe/Samara'),
(356, 'Europe/San_Marino'),
(357, 'Europe/Sarajevo'),
(358, 'Europe/Saratov'),
(359, 'Europe/Simferopol'),
(360, 'Europe/Skopje'),
(361, 'Europe/Sofia'),
(362, 'Europe/Stockholm'),
(363, 'Europe/Tallinn'),
(364, 'Europe/Tirane'),
(365, 'Europe/Ulyanovsk'),
(366, 'Europe/Uzhgorod'),
(367, 'Europe/Vaduz'),
(368, 'Europe/Vatican'),
(369, 'Europe/Vienna'),
(370, 'Europe/Vilnius'),
(371, 'Europe/Volgograd'),
(372, 'Europe/Warsaw'),
(373, 'Europe/Zagreb'),
(374, 'Europe/Zaporozhye'),
(375, 'Europe/Zurich'),
(376, 'Indian/Antananarivo'),
(377, 'Indian/Chagos'),
(378, 'Indian/Christmas'),
(379, 'Indian/Cocos'),
(380, 'Indian/Comoro'),
(381, 'Indian/Kerguelen'),
(382, 'Indian/Mahe'),
(383, 'Indian/Maldives'),
(384, 'Indian/Mauritius'),
(385, 'Indian/Mayotte'),
(386, 'Indian/Reunion'),
(387, 'Pacific/Apia'),
(388, 'Pacific/Auckland'),
(389, 'Pacific/Bougainville'),
(390, 'Pacific/Chatham'),
(391, 'Pacific/Chuuk'),
(392, 'Pacific/Easter'),
(393, 'Pacific/Efate'),
(394, 'Pacific/Fakaofo'),
(395, 'Pacific/Fiji'),
(396, 'Pacific/Funafuti'),
(397, 'Pacific/Galapagos'),
(398, 'Pacific/Gambier'),
(399, 'Pacific/Guadalcanal'),
(400, 'Pacific/Guam'),
(401, 'Pacific/Honolulu'),
(402, 'Pacific/Kanton'),
(403, 'Pacific/Kiritimati'),
(404, 'Pacific/Kosrae'),
(405, 'Pacific/Kwajalein'),
(406, 'Pacific/Majuro'),
(407, 'Pacific/Marquesas'),
(408, 'Pacific/Midway'),
(409, 'Pacific/Nauru'),
(410, 'Pacific/Niue'),
(411, 'Pacific/Norfolk'),
(412, 'Pacific/Noumea'),
(413, 'Pacific/Pago_Pago'),
(414, 'Pacific/Palau'),
(415, 'Pacific/Pitcairn'),
(416, 'Pacific/Pohnpei'),
(417, 'Pacific/Port_Moresby'),
(418, 'Pacific/Rarotonga'),
(419, 'Pacific/Saipan'),
(420, 'Pacific/Tahiti'),
(421, 'Pacific/Tarawa'),
(422, 'Pacific/Tongatapu'),
(423, 'Pacific/Wake'),
(424, 'Pacific/Wallis'),
(425, 'UTC');

-- --------------------------------------------------------

--
-- Table structure for table `todays_deal_products`
--

CREATE TABLE `todays_deal_products` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `manual_payment_id` bigint UNSIGNED DEFAULT NULL,
  `payment_status` enum('paid','unpaid') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unpaid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `payment_method`, `order_id`, `user_id`, `amount`, `created_at`, `updated_at`, `manual_payment_id`, `payment_status`) VALUES
(1, 'offline', 8, NULL, '1232', '2022-11-21 10:56:15', '2022-11-21 10:56:15', NULL, 'unpaid'),
(2, 'offline', 9, NULL, '1232', '2022-11-24 10:18:36', '2022-11-24 10:18:36', NULL, 'unpaid'),
(3, 'offline', 10, NULL, '10356', '2022-11-24 10:30:04', '2022-11-24 10:30:04', NULL, 'unpaid'),
(4, 'offline', 11, NULL, '6650', '2022-11-25 12:27:06', '2022-11-25 12:27:06', NULL, 'unpaid'),
(5, 'offline', 12, NULL, '861', '2022-11-25 12:28:49', '2022-11-25 12:28:49', NULL, 'unpaid'),
(6, 'offline', 13, NULL, '488', '2022-11-25 18:15:37', '2022-11-25 18:15:37', NULL, 'unpaid'),
(7, 'Credit card', 14, NULL, '149', '2022-11-25 18:29:29', '2022-11-25 18:29:29', NULL, 'unpaid'),
(8, 'Credit card', 15, NULL, '149', '2022-11-25 18:35:15', '2022-11-25 18:35:15', NULL, 'unpaid'),
(9, 'Credit card', 16, NULL, '149', '2022-11-25 18:50:27', '2022-11-25 18:50:27', NULL, 'unpaid'),
(10, 'Credit card', 17, NULL, '103', '2022-11-25 18:50:40', '2022-11-25 18:50:40', NULL, 'unpaid'),
(11, 'Credit card', 18, NULL, '325', '2022-11-25 18:53:44', '2022-11-25 18:53:44', NULL, 'unpaid'),
(12, 'Credit card', 19, NULL, '149', '2022-11-25 19:00:39', '2022-11-25 19:00:39', NULL, 'unpaid'),
(13, 'Credit card', 20, NULL, '588', '2022-11-25 19:03:07', '2022-11-25 19:03:07', NULL, 'unpaid'),
(14, 'Credit card', 21, NULL, '712', '2022-11-28 11:03:01', '2022-11-28 11:03:01', NULL, 'unpaid'),
(15, 'Credit card', 22, NULL, '344', '2022-11-28 11:05:22', '2022-11-28 11:05:22', NULL, 'unpaid'),
(16, 'Credit card', 23, NULL, '344', '2022-11-28 11:07:05', '2022-11-28 11:07:05', NULL, 'unpaid'),
(17, 'Credit card', 24, NULL, '344', '2022-11-28 11:15:26', '2022-11-28 11:15:26', NULL, 'unpaid'),
(18, 'Credit card', 25, NULL, '466', '2022-11-28 12:20:57', '2022-11-28 12:20:57', NULL, 'unpaid'),
(19, 'Credit card', 26, NULL, '466', '2022-11-28 14:28:32', '2022-11-28 14:28:32', NULL, 'unpaid'),
(20, 'Credit card', 27, NULL, '466', '2022-11-28 14:31:20', '2022-11-28 14:31:20', NULL, 'unpaid'),
(21, 'Credit card', 28, NULL, '466', '2022-11-28 14:34:50', '2022-11-28 14:34:50', NULL, 'unpaid'),
(22, 'Credit card', 29, NULL, '466', '2022-11-28 14:38:32', '2022-11-28 14:38:32', NULL, 'unpaid'),
(23, 'Credit card', 30, NULL, '466', '2022-11-28 14:57:47', '2022-11-28 14:57:47', NULL, 'unpaid'),
(24, 'Credit card', 31, NULL, '469', '2022-11-28 15:20:19', '2022-11-28 15:20:19', NULL, 'unpaid'),
(25, 'Credit card', 32, NULL, '715', '2022-11-28 15:26:18', '2022-11-28 15:26:18', NULL, 'unpaid'),
(26, 'Credit card', 33, NULL, '144', '2022-11-28 16:35:28', '2022-11-28 16:35:28', NULL, 'unpaid'),
(27, 'Credit card', 38, NULL, '144', '2022-11-28 17:35:29', '2022-11-28 17:35:29', NULL, 'unpaid'),
(28, 'Credit card', 39, NULL, '590', '2022-11-30 09:57:02', '2022-11-30 09:57:02', NULL, 'unpaid'),
(29, 'Credit card', 40, NULL, '13764', '2022-12-01 12:10:47', '2022-12-01 12:10:47', NULL, 'unpaid'),
(30, 'Credit card', 41, NULL, '140', '2022-12-01 12:37:48', '2022-12-01 12:37:48', NULL, 'unpaid'),
(31, 'Credit card', 42, NULL, '199', '2022-12-01 12:47:41', '2022-12-01 12:47:41', NULL, 'unpaid'),
(32, 'Credit card', 43, NULL, '199', '2022-12-01 12:50:05', '2022-12-01 12:50:05', NULL, 'unpaid'),
(33, 'Credit card', 44, NULL, '199', '2022-12-01 13:28:44', '2022-12-01 13:28:44', NULL, 'unpaid'),
(34, 'Credit card', 45, NULL, '199', '2022-12-01 13:32:05', '2022-12-01 13:32:05', NULL, 'unpaid'),
(35, 'Credit card', 46, NULL, '110', '2022-12-01 13:59:53', '2022-12-01 13:59:53', NULL, 'unpaid'),
(36, 'Credit card', 47, NULL, '110', '2022-12-01 14:06:13', '2022-12-01 14:06:13', NULL, 'unpaid'),
(37, 'Credit card', 48, NULL, '595', '2022-12-02 16:00:35', '2022-12-02 16:00:35', NULL, 'unpaid'),
(38, 'Credit card', 49, NULL, '14737', '2022-12-02 17:16:39', '2022-12-02 17:16:39', NULL, 'unpaid'),
(39, 'Credit card', 50, NULL, '223', '2022-12-02 18:41:38', '2022-12-02 18:41:38', NULL, 'unpaid'),
(40, 'Credit card', 51, NULL, '321', '2022-12-02 18:46:36', '2022-12-02 18:46:36', NULL, 'unpaid'),
(41, 'Credit card', 52, NULL, '111', '2022-12-02 18:48:27', '2022-12-02 18:48:27', NULL, 'unpaid'),
(42, 'Credit card', 53, NULL, '111', '2022-12-03 09:58:19', '2022-12-03 09:58:19', NULL, 'unpaid'),
(43, 'Credit card', 54, NULL, '11091', '2022-12-05 10:05:37', '2022-12-05 10:05:37', NULL, 'unpaid'),
(44, 'Credit card', 55, NULL, '199', '2022-12-05 11:43:36', '2022-12-05 11:43:36', NULL, 'unpaid'),
(45, 'Credit card', 56, NULL, '121', '2022-12-05 12:13:13', '2022-12-05 12:13:13', NULL, 'unpaid'),
(46, 'Credit card', 57, NULL, '344', '2022-12-05 12:18:32', '2022-12-05 12:18:32', NULL, 'unpaid'),
(47, 'Credit card', 58, NULL, '110', '2022-12-05 14:56:38', '2022-12-05 14:56:38', NULL, 'unpaid'),
(48, 'Credit card', 59, NULL, '200', '2022-12-05 15:09:45', '2022-12-05 15:09:45', NULL, 'unpaid'),
(49, 'Credit card', 60, NULL, '300', '2022-12-05 15:21:11', '2022-12-05 15:21:11', NULL, 'unpaid'),
(50, 'Credit card', 61, NULL, '290', '2022-12-05 21:09:09', '2022-12-05 21:09:09', NULL, 'unpaid'),
(51, 'Credit card', 62, NULL, '265', '2022-12-06 16:13:56', '2022-12-06 16:13:56', NULL, 'unpaid'),
(52, 'Credit card', 63, NULL, '265', '2022-12-06 16:15:33', '2022-12-06 16:15:33', NULL, 'unpaid'),
(53, 'Credit card', 64, NULL, '110', '2022-12-06 16:31:41', '2022-12-06 16:31:41', NULL, 'unpaid'),
(54, 'Credit card', 65, NULL, '499', '2022-12-07 10:44:13', '2022-12-07 10:44:13', NULL, 'unpaid'),
(55, 'Credit card', 66, NULL, '140', '2022-12-07 10:54:43', '2022-12-07 10:54:43', NULL, 'unpaid'),
(56, 'Credit card', 67, NULL, '122', '2022-12-07 11:42:28', '2022-12-07 11:42:28', NULL, 'unpaid'),
(57, 'Credit card', 68, NULL, '160', '2022-12-08 16:54:44', '2022-12-08 16:54:44', NULL, 'unpaid'),
(58, 'Credit card', 69, NULL, '133', '2022-12-08 17:43:15', '2022-12-08 17:43:15', NULL, 'unpaid'),
(59, 'Credit card', 70, NULL, '120', '2022-12-08 17:47:10', '2022-12-08 17:47:10', NULL, 'unpaid'),
(60, 'Credit card', 71, NULL, '110', '2022-12-08 17:47:56', '2022-12-08 17:47:56', NULL, 'unpaid'),
(61, 'Credit card', 72, NULL, '110', '2022-12-08 18:20:43', '2022-12-08 18:20:43', NULL, 'unpaid'),
(62, 'Credit card', 73, NULL, '140', '2022-12-14 10:12:19', '2022-12-14 10:12:19', NULL, 'unpaid'),
(63, 'Credit card', 74, NULL, '110', '2022-12-14 16:40:43', '2022-12-14 16:40:43', NULL, 'unpaid'),
(64, 'Credit card', 75, NULL, '120', '2022-12-14 16:43:33', '2022-12-14 16:43:33', NULL, 'unpaid'),
(65, 'Credit card', 76, NULL, '122', '2022-12-14 16:59:11', '2022-12-14 16:59:11', NULL, 'unpaid'),
(66, 'Credit card', 77, NULL, '150', '2022-12-15 11:23:16', '2022-12-15 11:23:16', NULL, 'unpaid'),
(67, 'Credit card', 78, NULL, '210', '2022-12-15 11:39:40', '2022-12-15 11:39:40', NULL, 'unpaid'),
(68, 'Credit card', 79, NULL, '190', '2022-12-15 14:05:08', '2022-12-15 14:05:08', NULL, 'unpaid'),
(69, 'Credit card', 80, NULL, '170', '2022-12-15 14:25:36', '2022-12-15 14:25:36', NULL, 'unpaid'),
(70, 'Credit card', 81, NULL, '1799', '2022-12-15 14:53:29', '2022-12-15 14:53:29', NULL, 'unpaid'),
(71, 'Credit card', 82, NULL, '1799', '2022-12-15 15:11:32', '2022-12-15 15:11:32', NULL, 'unpaid'),
(72, 'Credit card', 83, NULL, '1799', '2022-12-15 15:12:07', '2022-12-15 15:12:07', NULL, 'unpaid'),
(73, 'Credit card', 84, NULL, '110', '2022-12-15 15:13:44', '2022-12-15 15:13:44', NULL, 'unpaid'),
(74, 'Credit card', 85, NULL, '110', '2022-12-15 15:14:24', '2022-12-15 15:14:24', NULL, 'unpaid'),
(75, 'Credit card', 86, NULL, '110', '2022-12-15 15:14:51', '2022-12-15 15:14:51', NULL, 'unpaid'),
(76, 'Credit card', 87, NULL, '110', '2022-12-15 15:16:42', '2022-12-15 15:16:42', NULL, 'unpaid'),
(79, 'Credit card', 93, 19, '483', '2022-12-15 18:07:39', '2022-12-15 18:07:39', NULL, 'unpaid'),
(80, 'Credit card', 94, 19, '483', '2022-12-15 18:08:26', '2022-12-15 18:08:26', NULL, 'unpaid'),
(81, 'Credit card', 95, NULL, '400', '2022-12-15 18:21:24', '2022-12-15 18:21:24', NULL, 'unpaid'),
(82, 'Credit card', 96, NULL, '158', '2022-12-15 18:30:10', '2022-12-15 18:30:10', NULL, 'unpaid'),
(83, 'Credit card', 97, 19, '150', '2022-12-15 19:35:28', '2022-12-15 19:35:28', NULL, 'unpaid'),
(84, 'Credit card', 98, 19, '140', '2022-12-15 19:41:57', '2022-12-15 19:41:57', NULL, 'unpaid'),
(85, 'Credit card', 99, 19, '510', '2022-12-17 11:14:08', '2022-12-17 11:14:08', NULL, 'unpaid'),
(86, 'Credit card', 100, 19, '120', '2022-12-17 11:15:45', '2022-12-17 11:15:45', NULL, 'unpaid'),
(87, 'Credit card', 101, NULL, '170', '2022-12-17 12:22:09', '2022-12-17 12:22:09', NULL, 'unpaid'),
(88, 'Credit card', 102, 19, '120', '2022-12-17 12:51:37', '2022-12-17 12:51:37', NULL, 'unpaid'),
(89, 'Credit card', 103, NULL, '500', '2022-12-19 14:57:18', '2022-12-19 14:57:18', NULL, 'unpaid'),
(90, 'Credit card', 104, NULL, '200', '2022-12-19 16:08:53', '2022-12-19 16:08:53', NULL, 'unpaid'),
(91, 'Credit card', 105, NULL, '110', '2022-12-19 17:00:33', '2022-12-19 17:00:33', NULL, 'unpaid'),
(92, 'Credit card', 106, NULL, '110', '2022-12-19 17:43:46', '2022-12-19 17:43:46', NULL, 'unpaid'),
(93, 'Credit card', 107, NULL, '120', '2022-12-22 14:45:16', '2022-12-22 14:45:16', NULL, 'unpaid'),
(94, 'Credit card', 108, NULL, '110', '2022-12-22 09:56:33', '2022-12-22 09:56:33', NULL, 'unpaid'),
(95, 'Credit card', 109, NULL, '120', '2022-12-22 04:28:47', '2022-12-22 04:28:47', NULL, 'unpaid'),
(96, 'Credit card', 110, NULL, '110', '2022-12-22 10:02:08', '2022-12-22 10:02:08', NULL, 'unpaid'),
(97, 'Credit card', 111, NULL, '120', '2022-12-22 04:44:22', '2022-12-22 04:44:22', NULL, 'unpaid'),
(98, 'Credit card', 112, NULL, '110', '2022-12-22 04:45:37', '2022-12-22 04:45:37', NULL, 'unpaid'),
(99, 'Credit card', 113, NULL, '120', '2022-12-22 07:18:12', '2022-12-22 07:18:12', NULL, 'unpaid'),
(100, 'Credit card', 114, NULL, '110', '2022-12-22 11:39:42', '2022-12-22 11:39:42', NULL, 'unpaid'),
(101, 'Credit card', 115, NULL, '450', '2022-12-22 12:37:30', '2022-12-22 12:37:30', NULL, 'unpaid'),
(102, 'Credit card', 116, NULL, '220', '2022-12-22 13:09:16', '2022-12-22 13:09:16', NULL, 'unpaid'),
(103, 'Credit card', 117, NULL, '240', '2022-12-23 05:39:15', '2022-12-23 05:39:15', NULL, 'unpaid'),
(104, 'Credit card', 118, 107, '110', '2022-12-23 05:52:22', '2022-12-23 05:52:22', NULL, 'unpaid'),
(105, 'Credit card', 119, NULL, '110', '2022-12-23 07:14:42', '2022-12-23 07:14:42', NULL, 'unpaid'),
(106, 'Credit card', 120, 19, '1431', '2022-12-23 09:35:14', '2022-12-23 09:35:14', NULL, 'unpaid'),
(107, 'Credit card', 121, NULL, '220', '2022-12-23 09:47:00', '2022-12-23 09:47:00', NULL, 'unpaid'),
(108, 'Credit card', 122, NULL, '320', '2022-12-23 10:06:35', '2022-12-23 10:06:35', NULL, 'unpaid'),
(109, 'Credit card', 123, NULL, '600', '2022-12-23 11:45:54', '2022-12-23 11:45:54', NULL, 'unpaid'),
(110, 'Credit card', 124, NULL, '140', '2022-12-23 12:15:12', '2022-12-23 12:15:12', NULL, 'unpaid'),
(111, 'Credit card', 125, NULL, '110', '2022-12-23 12:21:22', '2022-12-23 12:21:22', NULL, 'unpaid'),
(112, 'Credit card', 126, NULL, '120', '2022-12-23 13:28:09', '2022-12-23 13:28:09', NULL, 'unpaid'),
(113, 'Credit card', 127, 19, '210', '2022-12-23 18:42:22', '2022-12-23 18:42:22', NULL, 'unpaid'),
(114, 'Credit card', 128, NULL, '230', '2022-12-24 02:35:46', '2022-12-24 02:35:46', NULL, 'unpaid'),
(115, 'Credit card', 129, 112, '820', '2022-12-24 00:54:37', '2022-12-24 00:54:37', NULL, 'unpaid'),
(116, 'card', 130, 112, '1552', '2022-12-24 07:42:14', '2022-12-24 07:42:14', NULL, 'unpaid'),
(117, 'card', 131, 109, '150', '2022-12-24 19:42:58', '2022-12-24 19:42:58', NULL, 'unpaid'),
(118, 'card', 132, 112, '460', '2022-12-24 19:43:48', '2022-12-24 19:43:48', NULL, 'unpaid'),
(119, 'card', 133, 112, '199', '2022-12-25 00:11:44', '2022-12-25 00:11:44', NULL, 'unpaid'),
(120, 'card', 134, 109, '542', '2022-12-25 19:21:36', '2022-12-25 19:21:36', NULL, 'unpaid'),
(121, 'card', 135, 109, '210', '2022-12-25 19:38:24', '2022-12-25 19:38:24', NULL, 'unpaid'),
(122, 'card', 136, 109, '210', '2022-12-25 19:38:25', '2022-12-25 19:38:25', NULL, 'unpaid'),
(123, 'card', 137, 19, '342', '2022-12-26 18:12:23', '2022-12-26 18:12:23', NULL, 'unpaid'),
(124, 'card', 138, 19, '580', '2022-12-26 18:49:09', '2022-12-26 18:49:09', NULL, 'unpaid'),
(125, 'card', 139, 19, '460', '2022-12-26 18:59:02', '2022-12-26 18:59:02', NULL, 'unpaid'),
(126, 'card', 140, 19, '463', '2022-12-26 23:07:59', '2022-12-26 23:07:59', NULL, 'unpaid'),
(127, 'Credit card', 141, NULL, '200', '2022-12-26 23:41:13', '2022-12-26 23:41:13', NULL, 'unpaid'),
(128, 'card', 142, 19, '460', '2022-12-27 02:45:55', '2022-12-27 02:45:55', NULL, 'unpaid'),
(129, 'card', 143, 19, '340', '2022-12-27 02:57:36', '2022-12-27 02:57:36', NULL, 'unpaid'),
(130, 'Credit card', 144, NULL, '110', '2022-12-27 16:30:27', '2022-12-27 16:30:27', NULL, 'unpaid'),
(131, 'Credit card', 145, NULL, '1500', '2022-12-27 21:51:40', '2022-12-27 21:51:40', NULL, 'unpaid'),
(132, 'Credit card', 146, NULL, '231', '2022-12-27 22:51:20', '2022-12-27 22:51:20', NULL, 'unpaid'),
(133, 'Credit card', 147, NULL, '200', '2022-12-28 21:25:45', '2022-12-28 21:25:45', NULL, 'unpaid'),
(134, 'Credit card', 148, NULL, '111', '2022-12-28 22:38:59', '2022-12-28 22:38:59', NULL, 'unpaid'),
(135, 'Credit card', 149, NULL, '121', '2022-12-29 17:04:57', '2022-12-29 17:04:57', NULL, 'unpaid'),
(136, 'Credit card', 150, NULL, '200', '2022-12-29 20:58:41', '2022-12-29 20:58:41', NULL, 'unpaid'),
(137, 'card', 151, 19, '199', '2022-12-30 16:15:55', '2022-12-30 16:15:55', NULL, 'unpaid'),
(138, 'card', 152, 136, '493', '2022-12-30 21:21:05', '2022-12-30 21:21:05', NULL, 'unpaid'),
(139, 'Credit card', 153, NULL, '220', '2022-12-30 22:29:07', '2022-12-30 22:29:07', NULL, 'unpaid'),
(140, 'Credit card', 154, NULL, '110', '2022-12-31 00:03:39', '2022-12-31 00:03:39', NULL, 'unpaid'),
(141, 'card', 155, 136, '220', '2023-01-05 17:06:23', '2023-01-05 17:06:23', NULL, 'unpaid'),
(142, 'card', 156, 136, '111', '2023-01-05 17:09:16', '2023-01-05 17:09:16', NULL, 'unpaid'),
(143, 'card', 157, 136, '111', '2023-01-05 17:11:44', '2023-01-05 17:11:44', NULL, 'unpaid'),
(144, 'card', 158, 136, '122', '2023-01-05 22:04:40', '2023-01-05 22:04:40', NULL, 'unpaid'),
(145, 'card', 159, 138, '210', '2023-01-06 20:16:12', '2023-01-06 20:16:12', NULL, 'unpaid'),
(146, 'Credit card', 160, NULL, '242', '2023-01-06 23:51:48', '2023-01-06 23:51:48', NULL, 'unpaid'),
(147, 'card', 161, 136, '221', '2023-01-06 23:55:33', '2023-01-06 23:55:33', NULL, 'unpaid'),
(148, 'Credit card', 162, NULL, '111', '2023-01-06 23:56:59', '2023-01-06 23:56:59', NULL, 'unpaid'),
(149, 'card', 163, 136, '220', '2023-01-09 16:36:46', '2023-01-09 16:36:46', NULL, 'unpaid'),
(150, 'card', 164, 136, '220', '2023-01-09 17:01:51', '2023-01-09 17:01:51', NULL, 'unpaid'),
(151, 'card', 165, 136, '220', '2023-01-09 19:18:52', '2023-01-09 19:18:52', NULL, 'unpaid'),
(152, 'Credit card', 166, NULL, '300', '2023-01-09 22:38:31', '2023-01-09 22:38:31', NULL, 'unpaid'),
(153, 'card', 167, 141, '1300', '2023-01-10 22:02:34', '2023-01-10 22:02:34', NULL, 'unpaid'),
(154, 'card', 168, 141, '2520', '2023-01-10 22:11:28', '2023-01-10 22:11:28', NULL, 'unpaid'),
(155, 'card', 169, 141, '1552', '2023-01-10 22:34:27', '2023-01-10 22:34:27', NULL, 'unpaid'),
(156, 'Credit card', 170, NULL, '473', '2023-01-13 20:28:24', '2023-01-13 20:28:24', NULL, 'unpaid'),
(157, 'card', 171, 143, '755', '2023-01-16 20:26:32', '2023-01-16 20:26:32', NULL, 'unpaid'),
(158, 'card', 172, 143, '220', '2023-01-16 20:37:03', '2023-01-16 20:37:03', NULL, 'unpaid'),
(159, 'card', 173, 143, '111', '2023-01-16 20:58:35', '2023-01-16 20:58:35', NULL, 'unpaid'),
(160, 'card', 174, 143, '34.66', '2023-01-17 14:31:11', '2023-01-17 14:31:11', NULL, 'unpaid'),
(161, 'card', 175, 143, '1725.91', '2023-01-17 15:37:46', '2023-01-17 15:37:46', NULL, 'unpaid'),
(162, 'Credit card', 176, NULL, '600', '2023-01-17 17:37:24', '2023-01-17 17:37:24', NULL, 'unpaid'),
(163, 'Credit card', 177, NULL, '663', '2023-01-17 17:48:40', '2023-01-17 17:48:40', NULL, 'unpaid'),
(164, 'Credit card', 178, NULL, '1143', '2023-01-19 16:19:59', '2023-01-19 16:19:59', NULL, 'unpaid'),
(165, 'Credit card', 179, NULL, '1102', '2023-01-19 17:46:59', '2023-01-19 17:46:59', NULL, 'unpaid'),
(166, 'Credit card', 180, NULL, '342', '2023-01-19 17:55:19', '2023-01-19 17:55:19', NULL, 'unpaid'),
(167, 'Credit card', 181, NULL, '120', '2023-01-19 18:01:25', '2023-01-19 18:01:25', NULL, 'unpaid'),
(168, 'Credit card', 182, NULL, '152', '2023-01-19 18:05:37', '2023-01-19 18:05:37', NULL, 'unpaid'),
(169, 'Credit card', 183, NULL, '1117', '2023-01-20 16:31:50', '2023-01-20 16:31:50', NULL, 'unpaid'),
(170, 'card', 184, 143, '592.96', '2023-01-20 17:13:35', '2023-01-20 17:13:35', NULL, 'unpaid'),
(171, 'Credit card', 185, NULL, '297', '2023-01-20 21:14:49', '2023-01-20 21:14:49', NULL, 'unpaid'),
(172, 'Credit card', 186, NULL, '483', '2023-01-20 21:41:45', '2023-01-20 21:41:45', NULL, 'unpaid'),
(173, 'Credit card', 187, NULL, '210', '2023-01-20 21:55:03', '2023-01-20 21:55:03', NULL, 'unpaid'),
(174, 'Credit card', 188, NULL, '397', '2023-01-20 22:11:20', '2023-01-20 22:11:20', NULL, 'unpaid'),
(175, 'Credit card', 189, NULL, '35', '2023-01-20 22:23:24', '2023-01-20 22:23:24', NULL, 'unpaid'),
(176, 'Credit card', 190, NULL, '34', '2023-01-20 22:27:33', '2023-01-20 22:27:33', NULL, 'unpaid'),
(177, 'card', 191, 143, '717.83', '2023-01-23 17:12:50', '2023-01-23 17:12:50', NULL, 'unpaid'),
(178, 'card', 192, 143, '29.83', '2023-01-23 17:29:01', '2023-01-23 17:29:01', NULL, 'unpaid'),
(179, 'card', 193, 143, '138.83', '2023-01-23 17:35:59', '2023-01-23 17:35:59', NULL, 'unpaid'),
(180, 'Credit card', 194, NULL, '1273', '2023-01-23 17:38:08', '2023-01-23 17:38:08', NULL, 'unpaid'),
(181, 'Credit card', 195, NULL, '623', '2023-01-23 17:49:41', '2023-01-23 17:49:41', NULL, 'unpaid'),
(182, 'Credit card', 196, NULL, '143', '2023-01-23 17:53:33', '2023-01-23 17:53:33', NULL, 'unpaid'),
(183, 'Credit card', 197, NULL, '113', '2023-01-23 19:45:21', '2023-01-23 19:45:21', NULL, 'unpaid'),
(184, 'Credit card', 198, NULL, '923', '2023-01-23 19:57:22', '2023-01-23 19:57:22', NULL, 'unpaid'),
(185, 'Credit card', 199, NULL, '623', '2023-01-23 20:02:42', '2023-01-23 20:02:42', NULL, 'unpaid'),
(186, 'Credit card', 200, NULL, '503', '2023-01-23 20:50:23', '2023-01-23 20:50:23', NULL, 'unpaid'),
(187, 'Credit card', 201, NULL, '77', '2023-01-23 22:26:35', '2023-01-23 22:26:35', NULL, 'unpaid'),
(188, 'Credit card', 202, NULL, '623', '2023-01-23 22:34:29', '2023-01-23 22:34:29', NULL, 'unpaid'),
(189, 'Credit card', 203, NULL, '870', '2023-01-23 23:05:43', '2023-01-23 23:05:43', NULL, 'unpaid'),
(190, 'Credit card', 204, NULL, '122', '2023-01-23 23:07:34', '2023-01-23 23:07:34', NULL, 'unpaid'),
(191, 'Credit card', 205, NULL, '111', '2023-01-24 15:33:55', '2023-01-24 15:33:55', NULL, 'unpaid'),
(192, 'Credit card', 206, NULL, '30', '2023-01-24 16:10:56', '2023-01-24 16:10:56', NULL, 'unpaid'),
(193, 'Credit card', 207, NULL, '147', '2023-01-24 16:28:23', '2023-01-24 16:28:23', NULL, 'unpaid'),
(194, 'Credit card', 208, NULL, '131', '2023-01-24 16:42:30', '2023-01-24 16:42:30', NULL, 'unpaid'),
(195, 'card', 209, 160, '1275.71', '2023-01-24 19:19:30', '2023-01-24 19:19:30', NULL, 'unpaid'),
(196, 'Credit card', 210, NULL, '143', '2023-01-24 21:40:45', '2023-01-24 21:40:45', NULL, 'unpaid'),
(197, 'Credit card', 211, NULL, '129', '2023-01-24 22:17:54', '2023-01-24 22:17:54', NULL, 'unpaid'),
(198, 'Credit card', 212, NULL, '1321', '2023-01-25 19:36:32', '2023-01-25 19:36:32', NULL, 'unpaid'),
(199, 'Credit card', 213, NULL, '2663', '2023-01-25 19:53:25', '2023-01-25 19:53:25', NULL, 'unpaid'),
(200, 'Credit card', 214, NULL, '34', '2023-01-25 20:03:10', '2023-01-25 20:03:10', NULL, 'unpaid'),
(201, 'card', 215, 160, '29.83', '2023-01-25 20:06:39', '2023-01-25 20:06:39', NULL, 'unpaid'),
(202, 'Credit card', 216, NULL, '2953', '2023-01-27 21:30:29', '2023-01-27 21:30:29', NULL, 'unpaid'),
(203, 'Credit card', 217, NULL, '983', '2023-01-27 21:35:15', '2023-01-27 21:35:15', NULL, 'unpaid'),
(204, 'Credit card', 218, NULL, '133', '2023-01-30 19:55:00', '2023-01-30 19:55:00', NULL, 'unpaid'),
(205, 'Credit card', 219, NULL, '123', '2023-01-30 20:14:37', '2023-01-30 20:14:37', NULL, 'unpaid'),
(206, 'Credit card', 220, NULL, '683', '2023-01-30 21:47:05', '2023-01-30 21:47:05', NULL, 'unpaid'),
(207, 'Credit card', 221, NULL, '95', '2023-01-30 21:55:25', '2023-01-30 21:55:25', NULL, 'unpaid'),
(208, 'Credit card', 1, NULL, '143', '2023-01-31 19:49:47', '2023-01-31 19:49:47', NULL, 'unpaid'),
(209, 'Credit card', 2, NULL, '143', '2023-01-31 20:39:31', '2023-01-31 20:39:31', NULL, 'unpaid'),
(210, 'card', 3, 10, '865.43', '2023-01-31 23:14:11', '2023-01-31 23:14:11', NULL, 'unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `used_coupons`
--

CREATE TABLE `used_coupons` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `coupon` text COLLATE utf8mb4_general_ci,
  `amount` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `used_coupons`
--

INSERT INTO `used_coupons` (`id`, `user_id`, `coupon`, `amount`, `created_at`, `updated_at`) VALUES
(18, 7, 'moxn2', 122, '2023-02-01 06:13:20', '2023-02-01 06:13:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `first_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `car_picture` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email_verified_at` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `remember_token` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `country_code` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '+1',
  `phone` varchar(200) DEFAULT NULL,
  `city_id` int DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `otp` int DEFAULT NULL,
  `notification` int DEFAULT '0',
  `deleted_account` int NOT NULL DEFAULT '0',
  `verification_status` int NOT NULL DEFAULT '1',
  `api_token` longtext,
  `note` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `first_name`, `email`, `image`, `car_picture`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `country_code`, `phone`, `city_id`, `address`, `otp`, `notification`, `deleted_account`, `verification_status`, `api_token`, `note`) VALUES
(1, 'bhavin pate', NULL, NULL, 'bhavin@freshcodes.in', NULL, NULL, NULL, '$2y$10$0e6JE96/rnCIb0fC/TwAWeIlPQSiJCDDC7YP6NQRl3BE9In.jT2mC', NULL, '2023-01-31 11:01:28', '2023-01-31 14:32:45', '+91', '9408695243', NULL, NULL, 982467, 0, 0, 1, NULL, NULL),
(5, 'user y', NULL, NULL, 'usery@yopmail.com', NULL, NULL, NULL, '$2y$10$mMIW5lwT.Hkgsz9jcgDJ9uYnzyxQrS/Di3E0hOcVMeHDJ9Mds142G', NULL, '2023-01-31 14:09:04', '2023-01-31 14:09:04', '+(91)', ' 9724257310', NULL, NULL, 366908, 0, 0, 1, NULL, NULL),
(7, 'tanvi morker', NULL, NULL, 'tanvi.morker@freshcodes.in', NULL, NULL, NULL, '$2y$10$D3CKe/bnAP.InU0qZqCjn.Z4PtAAayIT3SmG.mBDAtvf9kBqLHzCK', NULL, '2023-01-31 14:51:44', '2023-02-01 11:48:25', '+(91)', '8799585740', 10068, 'test test 1', 402672, 0, 0, 1, NULL, NULL),
(8, 'Joshi bhushit', NULL, NULL, 'joshi@yopmail.com', NULL, NULL, NULL, '$2y$10$J0ZdpRdKMxiH07eu2pzmF.EgfZmoSrGIrD7Nx6sPhaNqlINv.BpVG', NULL, '2023-01-31 14:52:12', '2023-01-31 14:52:12', '+(91)', ' 9985033903', NULL, NULL, 740139, 0, 0, 1, NULL, NULL),
(10, 'Madhuri test', NULL, NULL, 'madhuri.waghel@freshcodes.in', NULL, NULL, NULL, '$2y$10$ziD1NOSV1mrdwXiEmj2LP.eOdFHcAExfWZvq3kDPfF17toO.3YxR.', NULL, '2023-01-31 15:22:00', '2023-01-31 15:46:02', '+91', '8849233421', NULL, NULL, NULL, 0, 0, 1, NULL, NULL),
(11, 'bhushit k', NULL, NULL, 'bhushit@yopmail.com', NULL, NULL, NULL, '$2y$10$endB0gJ6HadnEl.imj575OLsY/rEhDWTrPBVPTG8WQEYy00EahZvS', NULL, '2023-01-31 19:41:41', '2023-01-31 19:41:41', '+(1)', ' 5482552616', NULL, NULL, 172400, 0, 0, 1, NULL, NULL),
(12, 'janvi kahar', NULL, NULL, 'janvi.kahar@freshcodes.in', NULL, NULL, NULL, '$2y$10$uusC5/fiU5ql3dNVb67.sOxMoATPY7SDKEtJjoC8UidlzLRT62sMe', NULL, '2023-02-01 13:52:02', '2023-02-01 13:52:02', '+91', '9510386775', NULL, NULL, 841348, 0, 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_bk`
--

CREATE TABLE `users_bk` (
  `id` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `email_verified_at` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `remember_token` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone` int DEFAULT NULL,
  `city_id` int DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `otp` int DEFAULT NULL,
  `verification_status` int NOT NULL DEFAULT '0',
  `api_token` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users_bk`
--

INSERT INTO `users_bk` (`id`, `name`, `first_name`, `last_name`, `email`, `image`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `city_id`, `address`, `otp`, `verification_status`, `api_token`) VALUES
(1, 'name', NULL, NULL, 'bhvain@freshcodes.in', '202211011134.png', NULL, '$2y$10$Haoh6GILFeQhWiY9U9jx5.CGlxlCgX56X6NPhlVOO4kB8otpDhy4i', NULL, '2022-10-13 04:06:05', '2022-11-09 14:02:29', 1000000000, 1, 'surat adajan', NULL, 1, NULL),
(5, 'bhavin patel', NULL, NULL, 'bhavinpatel@freshcodes.in', NULL, NULL, '$2y$10$ohmjamtAez7aguB/KH2T4OwYh428VxoAiYItNY2.cxHJlMIGWA1.C', NULL, '2022-10-13 04:21:28', '2022-10-13 04:34:09', 2147483647, NULL, NULL, 604908, 1, NULL),
(9, 'bhavin patel', NULL, NULL, 'bhavinpatel071711@gmail.com', NULL, NULL, '$2y$10$m5ftUQTlJPqMPEJ/gElVaezBUMW9QNMcNE3F7/8vg7G4/2FE1teXW', NULL, '2022-10-13 06:13:16', '2022-10-13 06:13:16', 2147483647, NULL, NULL, 833697, 0, NULL),
(10, 'bhavin patel', NULL, NULL, 'bhavinpatel07171@gmail.com', NULL, NULL, '$2y$10$4LPM6Z5CnJBVHLh0I0P39.c.XHSmsnwvv2irDL63gXhvE4zHmHEw2', NULL, '2022-10-31 14:50:08', '2022-10-31 15:13:18', 2147483647, NULL, NULL, 804810, 0, NULL),
(11, 'bhavin patel', NULL, NULL, 'bhavinpatel071@gmail.com', NULL, NULL, '$2y$10$xlTOmk13XI7e7T/y.nZhMOtLn3/z/mkIRl9wF9F4n1kWp4ZnR/npu', NULL, '2022-11-01 09:53:08', '2022-11-01 09:53:08', 2147483647, NULL, NULL, 461353, 0, NULL),
(16, 'bhavin patel', NULL, NULL, 'bhavinpatel0717@gmail.com', NULL, NULL, '$2y$10$xnw.Xkbko5hZg5.krLAwye7t4uvmIMxvaStqRkdTJ36cCF3X5Sjlq', NULL, '2022-11-01 13:28:16', '2022-11-02 14:08:17', 2147483647, NULL, NULL, 297175, 0, NULL),
(17, 'abc 123', NULL, NULL, 'abc@gmail.com', NULL, NULL, '$2y$10$1eJB7xBQ3XRMZhaqte00L.oAHGd.R3.i8hufPwNwpsj9HzjmVMFXq', NULL, '2022-11-01 13:52:29', '2022-11-01 13:52:29', 2147483647, NULL, NULL, 296301, 0, NULL),
(18, 'bhavin patel', NULL, NULL, 'bhavi123@gmail.com', NULL, NULL, '$2y$10$4d6EUDrtuBx4PRR8paJO4.uPE6A7hYwE/klknLOhPHF8al8H7dxpC', NULL, '2022-11-01 14:00:00', '2022-11-14 18:10:04', 2147483647, NULL, NULL, 647939, 1, NULL),
(19, 'bhavin patel', NULL, NULL, 'bhavinpatel07@gmail.com', NULL, NULL, '$2y$10$jGDOEUqb0X8VngoVYYcPuePPgIr0i.9/LhI/o1ccGjMkiKaaiQPEe', NULL, '2022-11-01 14:00:44', '2022-11-01 14:01:26', 2147483647, NULL, NULL, 939485, 1, NULL),
(20, 'abcd ef', NULL, NULL, 'ab@gmail.com', NULL, NULL, '$2y$10$yMdoaFgM9V1AgbfLGiTl7.TV0fWrETNqKUPTBDxDvJ2zsU7A0hDwy', NULL, '2022-11-01 14:07:10', '2022-11-01 14:07:10', 2147483647, NULL, NULL, 676506, 0, NULL),
(21, 'abcd ef', NULL, NULL, 'ddab@gmail.com', NULL, NULL, '$2y$10$hetFfzGeo6HqWzrHjNOmsOZ/WCjOLXtUEwexOJDQNB8gDBe6zkQfm', NULL, '2022-11-01 15:01:05', '2022-11-01 15:01:05', 2147483647, NULL, NULL, 751703, 0, NULL),
(22, 'abcd ef', NULL, NULL, 'dggdab@gmail.com', NULL, NULL, '$2y$10$wh1.tNmMo33b2LIITk4W5eYlS0VHBjaFVlIl5uWWLEzQMCc/2M9R.', NULL, '2022-11-01 15:01:27', '2022-11-01 15:01:27', 2147483647, NULL, NULL, 487460, 0, NULL),
(23, 'abcd ef', NULL, NULL, 'dggggdab@gmail.com', NULL, NULL, '$2y$10$KQJod2xzghmR/iVO2pGfzuN33I1F0EnZs4rrYUmRTFxdLu.Dx2eyq', NULL, '2022-11-01 15:14:33', '2022-11-01 15:14:33', 2147483647, NULL, NULL, 804736, 0, NULL),
(24, 'abcd ef', NULL, NULL, 'adab@gmail.com', NULL, NULL, '$2y$10$8yHL3UVCpg7zbJiAOevZMu8WFPZ8QliU.H38pmKipFTBRQLNmrUoa', NULL, '2022-11-01 15:17:32', '2022-11-01 15:17:32', 2147483647, NULL, NULL, 107809, 0, NULL),
(25, 'abc hshehsbs', NULL, NULL, 'ttff@gmail.com', NULL, NULL, '$2y$10$VK21W3PAampVjzwE4PRa3.4I/QZT0NY9RcUWHU6Tirt4qVjbdIm8W', NULL, '2022-11-01 15:25:24', '2022-11-01 15:25:57', 2147483647, NULL, NULL, 405423, 0, NULL),
(26, 'abc hshehsbs', NULL, NULL, 'ttghhff@gmail.com', NULL, NULL, '$2y$10$X5ZE1SQacXCHcvwzH8dp1uPgaX9BLAjdaejekMVevz86nshM7SnKK', NULL, '2022-11-01 15:27:35', '2022-11-01 15:28:14', 2147483647, NULL, NULL, 805416, 0, NULL),
(27, 'abc hshehsbs', NULL, NULL, 'tanvi@gmail.com', NULL, NULL, '$2y$10$h7wIjVB9UBtOq6SAnTaPF.zzdR7jTfU/T12Dc8K9WgN0SII4Cd/yW', NULL, '2022-11-01 15:31:16', '2022-11-01 15:32:21', 2147483647, NULL, NULL, 268044, 0, NULL),
(28, 'tanbi tanvi', NULL, NULL, 'tanvi2@gmail.com', NULL, NULL, '$2y$10$Q8RjWWjSvVqxumIduiePoO0L8AS2ic97J.Ml0GmHltAb4YXUNH7GK', NULL, '2022-11-01 15:40:24', '2022-11-01 15:40:46', 2147483647, NULL, NULL, 860655, 1, NULL),
(29, 'bhavin patel', NULL, NULL, 'tanvi77@gmail.com', NULL, NULL, '$2y$10$7mEJBJPIq3JWcXuZ02HsXeigjdzA273nFL6gtnIkTByMcBwg9JhvG', NULL, '2022-11-01 16:07:20', '2022-11-01 16:07:53', 2147483647, NULL, NULL, 642727, 1, NULL),
(30, 'bhavin patel', NULL, NULL, 'hello@gmail.com', NULL, NULL, '$2y$10$dVRewbLr769tOTNdD8b/B.vnEaOFqlDG78Ahe6Wg28SRvIJpdm4z2', NULL, '2022-11-01 17:38:48', '2022-11-01 17:39:33', 2147483647, NULL, NULL, 310714, 1, NULL),
(31, 'veer jani', NULL, NULL, 'viraj.jani@freshcodes.in', NULL, NULL, '$2y$10$I9wfrSbKtgyHpHP36HQ/8.eS/kVuaAq36Nh7TKi2DPAjXfkZuTgdO', NULL, '2022-11-02 08:41:06', '2022-11-02 08:41:06', 2147483647, NULL, NULL, 471292, 0, NULL),
(32, 'bhavin patel', NULL, NULL, 'tanvi12@gmail.com', NULL, NULL, '$2y$10$YoHSh/27DCmzXvkgasEcNuhsoL/78ha9RhQaS8SozVJX.DZInWVFO', NULL, '2022-11-02 08:56:55', '2022-11-11 17:53:14', 2147483647, NULL, NULL, 334865, 1, NULL),
(33, 'bhavin patel', NULL, NULL, 'tanvi122@gmail.com', NULL, NULL, '$2y$10$9cQ.HgPITUuHWY/UnU1tvOcJTHpJiMnUGq0uVA0tp/7F/eZfuOzbC', NULL, '2022-11-02 09:16:04', '2022-11-02 11:30:28', 2147483647, NULL, NULL, 354827, 0, NULL),
(34, 'bhavin patel', NULL, NULL, 'tanvi3@gmail.com', NULL, NULL, '$2y$10$qgWLjsJXf1liy5HlhdC1muWE2f9SCusIYt9aD/MhvapAIiBv9c6ZW', NULL, '2022-11-02 14:06:56', '2022-11-02 14:20:08', 2147483647, NULL, NULL, NULL, 1, NULL),
(35, 'bhavin patel', NULL, NULL, 'tanvi31@gmail.com', NULL, NULL, '$2y$10$EwOvJMCsAIT/9fstn8vXzu8p6xKNnnKuqT8oJNrkC3ACS8Gwi0rdG', NULL, '2022-11-02 16:47:17', '2022-11-02 16:47:56', 2147483647, NULL, NULL, 597833, 1, NULL),
(36, 'tanvi patel', NULL, NULL, 'tanvi93@gmail.com', NULL, NULL, '$2y$10$HtXhc/vG49s.GEbdLLM3NuBjl18SjC5E5DLvBmZUxZztbTjCV4D9G', NULL, '2022-11-03 09:03:18', '2022-11-03 09:03:47', 2147483647, NULL, NULL, 136325, 1, NULL),
(37, 'tanvi patel', NULL, NULL, 'tanvi95@gmail.com', NULL, NULL, '$2y$10$HtLq9NrQ76jtLMqCvPSPPuZhN0Dojj15J2QrCX/lMxlmp6XgcXCw6', NULL, '2022-11-03 11:05:28', '2022-11-03 11:06:35', 2147483647, NULL, NULL, 342172, 1, NULL),
(38, 'fresh code', NULL, NULL, 'freshcode@gmail.com', NULL, NULL, '$2y$10$IdxbsaOtZf7p/e8AE7O1/O2m9XipTvaZEbPcmMb3jcjsIgSWlJAXy', NULL, '2022-11-08 09:58:22', '2022-11-08 09:58:22', 2147483647, NULL, NULL, 500139, 0, NULL),
(39, 'hghhgv', NULL, NULL, 'hedfg@gmail.com', '202211101109.png', NULL, '$2y$10$pYkPVMU9TYB0QcYn8uCuVu.5YJO5gz1V0D6ADcCGIwg3bp.l9tbwS', NULL, '2022-11-08 10:02:47', '2022-11-10 16:09:00', 2147483647, 1, 'bvbbvbbv', 104558, 1, NULL),
(40, 'fresh code', NULL, NULL, 'freshcode11@gmail.com', NULL, NULL, '$2y$10$bkB5LREAFUrrbeu04aLc9.eUT3TBCTsBf98XCfk3BwNj9L6t0Wufq', NULL, '2022-11-08 17:04:35', '2022-11-08 17:06:52', 2147483647, NULL, NULL, NULL, 1, NULL),
(41, 'bhavin patel', NULL, NULL, 'bhavi13@gmail.com', NULL, NULL, '$2y$10$q30ksJ7Dtxz1PclYQcl6fu/xWDr.cz5QvsCIdhY3AolvsJb.JcJve', NULL, '2022-11-09 14:24:06', '2022-11-09 14:24:06', 2147483647, NULL, NULL, 251535, 0, NULL),
(42, 'madhuri', NULL, NULL, 'madhuri@gamil.com', NULL, NULL, '$2y$10$PyA2f4p2sWUyZnIz9Qs3uOTNAX3dFAbCCvBfD/ANl/tSUs1fKe7jy', NULL, '2022-11-09 14:24:17', '2022-11-11 18:02:46', 2147483647, 1, 'Bank', 682494, 1, NULL),
(43, 'bhavin patel', NULL, NULL, 'bhavin131@gmail.com', NULL, NULL, '$2y$10$tUoWYhJvB.gde1PYWpBPLOEHb46QgU7WF7gHBa/ga6SeisgoZO7zu', NULL, '2022-11-10 12:26:59', '2022-11-10 12:26:59', 2147483647, NULL, NULL, 135197, 0, NULL),
(44, 'Keyur Tailor', NULL, NULL, 'kayur.tailor@freshcodes.in', NULL, NULL, '$2y$10$KgKzWXUMmfoosR/xy0gsru/ue.Xgt5X5Q9mqMu3ShsvuyUowbU6ru', NULL, '2022-11-10 15:39:48', '2022-11-17 16:42:40', 2147483647, NULL, NULL, 620846, 1, NULL),
(45, 'Madhuri Testing', NULL, NULL, 'madhuri.waghel@freshcodes.in', NULL, NULL, '$2y$10$Lhjxhgq6I.eDIopIz757qeFZdxx0qN.V/pcLbdsgZq5Rsh1dERxLW', NULL, '2022-11-11 12:29:42', '2022-11-11 13:46:07', 2147483647, NULL, NULL, 712791, 0, NULL),
(46, 'tanvi morkr', NULL, NULL, 'tanvi55@gmail.com', NULL, NULL, '$2y$10$3sZxzvOfJBEszZ69IjAtPu7jD45UxcjiwhI5OQmtn1sKblUg17G3C', NULL, '2022-11-11 17:37:50', '2022-11-11 17:37:50', 2147483647, NULL, NULL, 605887, 0, NULL),
(47, 'tanvi morker', NULL, NULL, 'tanvi56@gmail.com', NULL, NULL, '$2y$10$u4rXgamxTm.kIPXZidki8eqqMgD8.WL9sjBPW86isnsY5glKx1Hsq', NULL, '2022-11-11 17:39:48', '2022-11-11 17:43:45', 2147483647, NULL, NULL, NULL, 0, NULL),
(48, 'deno', NULL, NULL, 'demo', '202211141042.png', NULL, '$2y$10$8mH9NERWjaYEmDnRKWqVzO6R2kX1c57hk4x67.LFL9M5bAqXtXuBO', NULL, '2022-11-14 10:23:53', '2022-11-14 15:42:35', 2147483647, 1, 'demo', 198712, 1, NULL),
(49, 'tanvi morker', NULL, NULL, 'tanvi511@gmail.com', NULL, NULL, '$2y$10$gFiep2OdAIOx9wL04u4nduU/O59yR6c8W5/moN02nPPx2fMLvUFaO', NULL, '2022-11-14 10:56:43', '2022-11-14 10:56:43', 2147483647, NULL, NULL, 333947, 0, NULL),
(50, 'tanvi patel', NULL, NULL, 'tanvi2222@gmail.com', NULL, NULL, '$2y$10$3qvMBUsKDn2riigrrY31nuIJDcAwwsGFzNTF1GmXyqx3ga.Om9DNu', NULL, '2022-11-14 15:58:46', '2022-11-14 15:58:46', 2147483647, NULL, NULL, 757985, 0, NULL),
(51, 'madhuri testing', NULL, NULL, 'madhuri+01@gamil.com', NULL, NULL, '$2y$10$l3OsxuBu.uOaWxdRXflDP.RifNyc2d5qdtJf4Taql82ku7F4BIwKu', NULL, '2022-11-14 16:06:21', '2022-11-14 16:06:21', 2147483647, NULL, NULL, 344659, 0, NULL),
(52, 'tanvi morker', NULL, NULL, 'madhuri+01@gmail.com', NULL, NULL, '$2y$10$lKYN9RDd.1UqeaDAgsFxnecU/pI7q83hfqpRdOgqB/M2Zn0XB4j/.', NULL, '2022-11-14 16:08:39', '2022-11-14 16:11:20', 2147483647, NULL, NULL, 720117, 1, NULL),
(53, 'tanvi morker', NULL, NULL, 'test01@gmail.com', NULL, NULL, '$2y$10$xkw95VGU74p1P.48YYFg9ORA5hnub7kDNMnP8K8gbU/GmxI.ppa36', NULL, '2022-11-14 16:14:02', '2022-11-16 15:40:06', 2147483647, NULL, NULL, NULL, 1, NULL),
(54, 'jsjjs njsjsjsjsjs', NULL, NULL, 'tanvi44@gmail.com', NULL, NULL, '$2y$10$QVVdy3STsp3ive6J3iSIjeG4hQDJkS/wnaF8lsZ6JMeKG7TbCRsZu', NULL, '2022-11-14 16:31:19', '2022-11-14 16:31:30', 2147483647, NULL, NULL, 181608, 1, NULL),
(55, 'tanvi morker', NULL, NULL, 'tanvi4@gmail.com', NULL, NULL, '$2y$10$BYtaGHybUWz9/evgQa6lQ.ycjyHkJ1U27POgAAoIOwBhfwF8bwYEO', NULL, '2022-11-14 16:35:51', '2022-11-14 16:35:51', 2147483647, NULL, NULL, 351105, 0, NULL),
(56, 'tanvi tanv', NULL, NULL, 'tanvi11@gmail.com', NULL, NULL, '$2y$10$hk4kOHXpFSxdTFDbtSun8OSYFPIG1.KpG5ozFWtJy5DqVDFDgDoMS', NULL, '2022-11-14 16:50:50', '2022-11-14 16:50:50', 2147483647, NULL, NULL, 908812, 0, NULL),
(57, 'yfggf ccgggg', NULL, NULL, 't1@gmail.com', NULL, NULL, '$2y$10$lMVKHs8Te9CXya2ZOA6aVOoslxqdC6..4TEYRxYiS6boZoO9YO.Fe', NULL, '2022-11-14 16:58:18', '2022-11-14 16:58:18', 2147483647, NULL, NULL, 515476, 0, NULL),
(58, 'test test', NULL, NULL, 'test1@gmail.com', NULL, NULL, '$2y$10$b1VjW2G7.wFW4gFCo9ZW8OUhxK.AGfLnqEbAZEuPo46qT/Hq5AWgS', NULL, '2022-11-14 17:08:25', '2022-11-14 17:13:50', 2147483647, NULL, NULL, 692973, 0, NULL),
(59, 'gggg bbggv', NULL, NULL, 'tanvi20@gmail.com', NULL, NULL, '$2y$10$BqeUywaaNS.wSi5iaLhyR.glWgDt0r0rXteGUMyVfUbJish5HlgJu', NULL, '2022-11-14 17:41:54', '2022-11-14 17:41:54', 2147483647, NULL, NULL, 437885, 0, NULL),
(60, 'tanv tababa', NULL, NULL, 'test33@gmail.com', NULL, NULL, '$2y$10$/b9wXdRhSEtVXHE67gdM5.x.XEOU0vG0YLIIl7i.Tw2JQGsmHnvDO', NULL, '2022-11-14 17:45:42', '2022-11-14 17:48:33', 2147483647, NULL, NULL, 863288, 0, NULL),
(61, 'tanvi morker', NULL, NULL, 'test55@gmail.com', NULL, NULL, '$2y$10$3egThM02u3JvhWwizaRv0e6YFYcXi/ej4cwmIX8phZUwXqxH5aoxq', NULL, '2022-11-14 17:51:15', '2022-11-14 17:52:01', 2147483647, NULL, NULL, 953024, 0, NULL),
(62, 'tanvi morker', NULL, NULL, 'test559@gmail.com', NULL, NULL, '$2y$10$/9AnUo5NQYyqpA8mHluhO.9qhdpGNYfcmU0X5QaoU.OmRBr0Iin7u', NULL, '2022-11-14 17:54:20', '2022-11-14 17:54:31', 2147483647, NULL, NULL, 255704, 0, NULL),
(63, 'tanvi morker', NULL, NULL, 'test5@gmail.com', NULL, NULL, '$2y$10$XiS9pQTV26qmxKnb/S4Bi.JSPY3MVNSuX63RC20cBQi9qN1iyEUa.', NULL, '2022-11-14 17:54:58', '2022-11-14 18:00:58', 2147483647, NULL, NULL, 114248, 0, NULL),
(64, 'test test', NULL, NULL, 'test77@gmail.com', NULL, NULL, '$2y$10$Nc/oZ9W6/WIFSIhnih2FK.d.t9HXRqC8B1AigX9Su3YxAk9t5uePe', NULL, '2022-11-14 18:04:40', '2022-11-14 18:04:40', 2147483647, NULL, NULL, 959386, 0, NULL),
(65, 'teat test', NULL, NULL, 'test88@gmail.com', NULL, NULL, '$2y$10$DzFksvi1GmcBq6DcLoh0LeCPXYggu9vmuwgB6lC6fS.DsfXtJ9CYq', NULL, '2022-11-14 18:06:38', '2022-11-14 18:14:02', 2147483647, NULL, NULL, 501469, 1, NULL),
(66, 'test test', NULL, NULL, 'test8@gmail.com', NULL, NULL, '$2y$10$C6n2/67XbC2Jwfu8xMxDOeRw3i9oJmcPRlBcAR8rSrtIiLeO1d1Ku', NULL, '2022-11-14 18:23:01', '2022-11-14 18:23:14', 2147483647, NULL, NULL, 915992, 1, NULL),
(67, 'test test', NULL, NULL, 'tanvi557@gmail.com', NULL, NULL, '$2y$10$UfRS.gng62oxRVC5RM1vp.o8/EjK.0tgj3KFBEfIJ16mIMB9Y7mau', NULL, '2022-11-14 18:30:58', '2022-11-14 18:30:58', 2147483647, NULL, NULL, 720006, 0, NULL),
(68, 'bhavin patel', NULL, NULL, 'bhavi1234@gmail.com', NULL, NULL, '$2y$10$GJj77syDpNUFcAw6y0Q8eO92FhNY7cDwcFGOHX83hi202kgGf2YLO', NULL, '2022-11-15 10:00:56', '2022-11-15 12:30:33', 2147483647, NULL, NULL, 472976, 0, NULL),
(69, 'tanvi morker', NULL, NULL, 'tanvi99@gmail.com', NULL, NULL, '$2y$10$N/D8S6XjfiER3Rvo1nQVKOea8A1vdXwTbwDQ7C8ikM9/oCKNnmoQ.', NULL, '2022-11-15 10:17:23', '2022-11-15 15:57:22', 2147483647, NULL, NULL, NULL, 1, NULL),
(70, 'tanvi morker', NULL, NULL, 'test03@gmail.com', NULL, NULL, '$2y$10$/UT8Yr2lHbGjt1.QAwZ.NuUmjKJDXl4y/QANaIVt8sjjbnogQjTP6', NULL, '2022-11-15 11:50:44', '2022-11-15 11:50:44', 2147483647, NULL, NULL, 101109, 0, NULL),
(71, 'tanvi morker', NULL, NULL, 'test4@gmail.com', NULL, NULL, '$2y$10$u/yVRczuFym5aBYvNrFvseUdww8k9TMubfs0/DMv.2beLuEakrHou', NULL, '2022-11-15 13:30:19', '2022-11-15 13:30:19', 2147483647, NULL, NULL, 293644, 0, NULL),
(72, 'gffghfg hffghhff', NULL, NULL, 'abcde@gmail.com', NULL, NULL, '$2y$10$Gtt/yX2I132jO282iSA0F.Ty/CYqWrDPMnVqPSEW.1Y5id0hvXhMK', NULL, '2022-11-15 15:02:34', '2022-11-15 15:02:45', 2147483647, NULL, NULL, 648165, 1, NULL),
(73, 'ugfghhhh hgchhhj', NULL, NULL, 'hhvvc@gmail.com', NULL, NULL, '$2y$10$MX2fVYiS8u/cCrTQuPbQKewsxEBdpf4rz0jNJCFyVLolRMqLPZ0PS', NULL, '2022-11-15 15:27:15', '2022-11-15 15:27:15', 2147483647, NULL, NULL, 847925, 0, NULL),
(74, 'ugfghhhh hgchhhj', NULL, NULL, 'hhvyvc@gmail.com', NULL, NULL, '$2y$10$MgzlJszSr6n4M.1rKDrpu.VzNPvyKeWbK5cpX1ZAi3GgvTCPSGYWi', NULL, '2022-11-15 15:31:37', '2022-11-15 15:32:08', 2147483647, NULL, NULL, 240506, 1, NULL),
(75, 'Keyur Tailor', NULL, NULL, 'tailorkeyur44@gmail.com', NULL, NULL, '$2y$10$hG2VdSDLFwfrs4GJE3CyA.jwC4Xhkgod2DW5PWxsPNToJsvyA6uHi', NULL, '2022-11-16 10:26:58', '2022-11-16 10:26:58', 1234567890, NULL, NULL, 109801, 0, NULL),
(76, 'Madhuri test', NULL, NULL, 'madhuri.waghel+01@freshcodes.in', NULL, NULL, '$2y$10$lcKjMSyMWj47FxAHjge7aeQWs4Mlc6JsIXRgR.Amwv9r3EDS8Cq1C', NULL, '2022-11-16 14:46:35', '2022-11-16 14:46:35', 2147483647, NULL, NULL, 549720, 0, NULL),
(77, 'kayur tailor', NULL, NULL, 'keyur@gmail.com', NULL, NULL, '$2y$10$hp3VNIxkuSFHMa/C6M34y.tvE38gKaMPTcJ4krfeaBBfZCG3jM3v2', NULL, '2022-11-16 14:50:00', '2022-11-16 14:50:00', 1234567890, NULL, NULL, 610121, 0, NULL),
(78, 'Keyur Tailor', NULL, NULL, 'keyur2@gmail.com', NULL, NULL, '$2y$10$tqjCmFV7Yg26dp64ex7Y1ucvIId0ccRCU2amwpUAcMqDDJoUel8mu', NULL, '2022-11-16 14:52:05', '2022-11-16 14:53:28', 1234567890, NULL, NULL, 109730, 0, NULL),
(79, 'Madhuri test', NULL, NULL, 'madhuri.waghel01@freshcodes.in', NULL, NULL, '$2y$10$E6vVEZP0JQtAw1ynBFd9.eHCq/rBKkptwMoPq5Aq9YxiAMUEeoxC.', NULL, '2022-11-16 14:57:32', '2022-11-16 15:32:09', 2147483647, NULL, NULL, NULL, 1, NULL),
(80, 'Madhuri Diu', NULL, NULL, 'madhuri@gmail.com', NULL, NULL, '$2y$10$EEu2.palPceMyCG.dHwZ7uwiFMQ8GXiZ5vXmUjE1UnqXyIk/oO/la', NULL, '2022-11-16 17:43:12', '2022-11-16 17:45:47', 1234567890, NULL, NULL, NULL, 1, NULL),
(81, 'madhrui testing', NULL, NULL, 'madhuri01@gmail.com', NULL, NULL, '$2y$10$97mbv5KyJ92qwN5XsnCP0.82mGxYqfDb9sKJWcqRxP7lq5AamQAoS', NULL, '2022-11-16 17:49:30', '2022-11-16 17:51:26', 2147483647, NULL, NULL, NULL, 1, NULL),
(82, 'Madhuri Demo', NULL, NULL, 'madhuri02@gmail.com', NULL, NULL, '$2y$10$K1JDAJUgJKb9ghpJsy/ahOXqQ04NLmR5b/sd1bTcpHoVlsbOakhMm', NULL, '2022-11-16 18:20:25', '2022-11-16 18:20:33', 2147483647, NULL, NULL, 812225, 1, NULL),
(83, 'madhuri test', NULL, NULL, 'madhuri03@gmail.com', NULL, NULL, '$2y$10$2Eo1m2sh5JZ0zIO5s6OzHemwiDKLDt/RkYjlTa85wwu2USDz7tV72', NULL, '2022-11-16 18:22:27', '2022-11-16 18:30:46', 2147483647, NULL, NULL, NULL, 1, NULL),
(84, 'Keyur Tailor', NULL, NULL, 'keyur@gmail.co', NULL, NULL, '$2y$10$c0kppJafMI/JXBDjHMGFZOYZ00yahwt3GHcoKQpCpgqvii01fGd9C', NULL, '2022-11-16 18:28:33', '2022-11-16 18:28:33', 1234567890, NULL, NULL, 386293, 0, NULL),
(85, 'Keyur Tailor', NULL, NULL, 'keyur@gmail.comm', NULL, NULL, '$2y$10$Y7S6Du2ZBYmDBcoLmEVPmuBhiHYZcit7UUNVquemO5k4M90Et6ZfO', NULL, '2022-11-16 18:36:16', '2022-11-16 18:36:16', 1234567890, NULL, NULL, 477345, 0, NULL),
(86, 'madhuri demotest', NULL, NULL, 'madhuri04@gmail.com', NULL, NULL, '$2y$10$ZUqaB6RqS3/0/T48CRbehezIdFcP7yo.4Gop3H.r9wxRsOWzCNY1W', NULL, '2022-11-16 18:45:09', '2022-11-16 18:46:25', 2147483647, NULL, NULL, NULL, 1, NULL),
(87, 'asds', 'bhavin', 'last name', 'bhavin8358@gmail.com', NULL, NULL, '$2y$10$VSt9XO4ZaXV3WH.zmtqa..qBDsfb3Q5DehJtDMTdV9qTW1QY.NSlS', NULL, '2022-11-17 18:37:51', '2022-11-17 18:37:51', NULL, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_bkkp`
--

CREATE TABLE `users_bkkp` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint UNSIGNED DEFAULT NULL,
  `state_id` bigint UNSIGNED DEFAULT NULL,
  `city_id` bigint UNSIGNED DEFAULT NULL,
  `zip_code` int DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banned_till` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `auth_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'email',
  `provider` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_packages`
--

CREATE TABLE `user_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `package_id` int NOT NULL,
  `start_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `expired_date` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` int NOT NULL,
  `payment_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_id` int NOT NULL,
  `payment_status` int NOT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_packages`
--

INSERT INTO `user_packages` (`id`, `user_id`, `package_id`, `start_date`, `expired_date`, `price`, `payment_type`, `payment_id`, `payment_status`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '2023-01-31', '2023-05-01', 30, 'card', 0, 1, 0, '2023-01-31 14:20:30', '2023-01-31 14:20:30'),
(2, 7, 1, '2023-02-01', '2023-05-01', 30, 'card', 0, 1, 0, '2023-02-01 10:26:13', '2023-02-01 10:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_package_services`
--

CREATE TABLE `user_package_services` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `user_package_id` int NOT NULL,
  `package_service_id` int NOT NULL,
  `service_count` int NOT NULL,
  `service_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_package_services`
--

INSERT INTO `user_package_services` (`id`, `user_id`, `user_package_id`, `package_service_id`, `service_count`, `service_name`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, 4, 'Cleaning', '2023-01-31 14:20:30', '2023-01-31 14:29:09'),
(2, 6, 1, 2, 5, 'Polishing', '2023-01-31 14:20:30', '2023-01-31 14:20:30'),
(3, 6, 1, 3, 5, 'Waxing', '2023-01-31 14:20:30', '2023-01-31 14:20:30'),
(4, 6, 1, 4, 5, 'Interior Cleaning', '2023-01-31 14:20:30', '2023-01-31 14:20:30'),
(5, 6, 1, 5, 5, 'Brakes', '2023-01-31 14:20:30', '2023-01-31 14:20:30'),
(6, 7, 2, 1, 5, 'Cleaning', '2023-02-01 10:26:13', '2023-02-01 10:26:13'),
(7, 7, 2, 2, 5, 'Polishing', '2023-02-01 10:26:13', '2023-02-01 10:26:13'),
(8, 7, 2, 3, 5, 'Waxing', '2023-02-01 10:26:13', '2023-02-01 10:26:13'),
(9, 7, 2, 4, 5, 'Interior Cleaning', '2023-02-01 10:26:13', '2023-02-01 10:26:13'),
(10, 7, 2, 5, 5, 'Brakes', '2023-02-01 10:26:13', '2023-02-01 10:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(2, 10, 37, '2023-01-31 17:12:40', '2023-01-31 17:12:40'),
(3, 7, 38, '2023-02-01 10:31:17', '2023-02-01 10:31:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `admin_searches`
--
ALTER TABLE `admin_searches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attributes_code_unique` (`code`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `browsing_histories`
--
ALTER TABLE `browsing_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `browsing_histories_product_id_foreign` (`product_id`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campaign_offers`
--
ALTER TABLE `campaign_offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_offers_home_page_content_id_foreign` (`home_page_content_id`),
  ADD KEY `campaign_offers_campaign_id_foreign` (`campaign_id`);

--
-- Indexes for table `campaign_products`
--
ALTER TABLE `campaign_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaign_products_campaign_id_foreign` (`campaign_id`),
  ADD KEY `campaign_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_state_id_foreign` (`state_id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactuses`
--
ALTER TABLE `contactuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `database_backups`
--
ALTER TABLE `database_backups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emails_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourite_products`
--
ALTER TABLE `favourite_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favourite_products` (`user_id`);

--
-- Indexes for table `home_page_contents`
--
ALTER TABLE `home_page_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_name_unique` (`name`),
  ADD UNIQUE KEY `languages_code_unique` (`code`),
  ADD UNIQUE KEY `languages_icon_unique` (`icon`);

--
-- Indexes for table `manual_payments`
--
ALTER TABLE `manual_payments`
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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications_b`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_products_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_product_attributes`
--
ALTER TABLE `order_product_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_services`
--
ALTER TABLE `package_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package_visits`
--
ALTER TABLE `package_visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pickup_points`
--
ALTER TABLE `pickup_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pickup_points_city_id_foreign` (`city_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_author_id_foreign` (`author_id`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_comments_author_id_foreign` (`author_id`),
  ADD KEY `post_comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_attributes_product_id_foreign` (`product_id`),
  ADD KEY `product_attributes_attribute_id_foreign` (`attribute_id`),
  ADD KEY `product_attributes_value_id_foreign` (`value_id`);

--
-- Indexes for table `product_carts`
--
ALTER TABLE `product_carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_galleries`
--
ALTER TABLE `product_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_galleries_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_tags`
--
ALTER TABLE `product_tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchesd_packages`
--
ALTER TABLE `purchesd_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_order_id_foreign` (`order_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `review_details`
--
ALTER TABLE `review_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_ratings`
--
ALTER TABLE `review_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `seos`
--
ALTER TABLE `seos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_bookeds`
--
ALTER TABLE `service_bookeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booked_id` (`booking_id`);

--
-- Indexes for table `service_bookings`
--
ALTER TABLE `service_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`user_id`);

--
-- Indexes for table `service_carts`
--
ALTER TABLE `service_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_product_id` (`service_product_id`);

--
-- Indexes for table `service_products`
--
ALTER TABLE `service_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setup_guides`
--
ALTER TABLE `setup_guides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shipping_methods_name_unique` (`name`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ssl_orders`
--
ALTER TABLE `ssl_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `states_country_id_foreign` (`country_id`);

--
-- Indexes for table `status_record`
--
ALTER TABLE `status_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timezones`
--
ALTER TABLE `timezones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todays_deal_products`
--
ALTER TABLE `todays_deal_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `todays_deal_products_product_id_foreign` (`product_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_manual_payment_id_foreign` (`manual_payment_id`);

--
-- Indexes for table `used_coupons`
--
ALTER TABLE `used_coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_bk`
--
ALTER TABLE `users_bk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_bkkp`
--
ALTER TABLE `users_bkkp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_city_id_foreign` (`city_id`),
  ADD KEY `users_country_id_foreign` (`country_id`),
  ADD KEY `users_state_id_foreign` (`state_id`);

--
-- Indexes for table `user_packages`
--
ALTER TABLE `user_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_package_services`
--
ALTER TABLE `user_package_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_searches`
--
ALTER TABLE `admin_searches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `browsing_histories`
--
ALTER TABLE `browsing_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `campaign_offers`
--
ALTER TABLE `campaign_offers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaign_products`
--
ALTER TABLE `campaign_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48354;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contactuses`
--
ALTER TABLE `contactuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `database_backups`
--
ALTER TABLE `database_backups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `favourite_products`
--
ALTER TABLE `favourite_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home_page_contents`
--
ALTER TABLE `home_page_contents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manual_payments`
--
ALTER TABLE `manual_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=759007;

--
-- AUTO_INCREMENT for table `notifications_b`
--
ALTER TABLE `notifications`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_product_attributes`
--
ALTER TABLE `order_product_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `package_services`
--
ALTER TABLE `package_services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `package_visits`
--
ALTER TABLE `package_visits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=833;

--
-- AUTO_INCREMENT for table `pickup_points`
--
ALTER TABLE `pickup_points`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `product_attributes`
--
ALTER TABLE `product_attributes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_carts`
--
ALTER TABLE `product_carts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- AUTO_INCREMENT for table `product_galleries`
--
ALTER TABLE `product_galleries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `product_tag`
--
ALTER TABLE `product_tag`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `product_tags`
--
ALTER TABLE `product_tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchesd_packages`
--
ALTER TABLE `purchesd_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review_details`
--
ALTER TABLE `review_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `review_ratings`
--
ALTER TABLE `review_ratings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `seos`
--
ALTER TABLE `seos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `service_bookeds`
--
ALTER TABLE `service_bookeds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `service_bookings`
--
ALTER TABLE `service_bookings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service_carts`
--
ALTER TABLE `service_carts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=500;

--
-- AUTO_INCREMENT for table `service_products`
--
ALTER TABLE `service_products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `setup_guides`
--
ALTER TABLE `setup_guides`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ssl_orders`
--
ALTER TABLE `ssl_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4109;

--
-- AUTO_INCREMENT for table `status_record`
--
ALTER TABLE `status_record`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `timezones`
--
ALTER TABLE `timezones`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

--
-- AUTO_INCREMENT for table `todays_deal_products`
--
ALTER TABLE `todays_deal_products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `used_coupons`
--
ALTER TABLE `used_coupons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users_bk`
--
ALTER TABLE `users_bk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `users_bkkp`
--
ALTER TABLE `users_bkkp`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_packages`
--
ALTER TABLE `user_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_package_services`
--
ALTER TABLE `user_package_services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `browsing_histories`
--
ALTER TABLE `browsing_histories`
  ADD CONSTRAINT `browsing_histories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `campaign_offers`
--
ALTER TABLE `campaign_offers`
  ADD CONSTRAINT `campaign_offers_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `campaign_offers_home_page_content_id_foreign` FOREIGN KEY (`home_page_content_id`) REFERENCES `home_page_contents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `campaign_products`
--
ALTER TABLE `campaign_products`
  ADD CONSTRAINT `campaign_products_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `campaign_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favourite_products`
--
ALTER TABLE `favourite_products`
  ADD CONSTRAINT `favourite_products` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

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
-- Constraints for table `pickup_points`
--
ALTER TABLE `pickup_points`
  ADD CONSTRAINT `pickup_points_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users_bkkp` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_attributes`
--
ALTER TABLE `product_attributes`
  ADD CONSTRAINT `product_attributes_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attributes_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_attributes_value_id_foreign` FOREIGN KEY (`value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_galleries`
--
ALTER TABLE `product_galleries`
  ADD CONSTRAINT `product_galleries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users_bkkp` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_bookeds`
--
ALTER TABLE `service_bookeds`
  ADD CONSTRAINT `booked_id` FOREIGN KEY (`booking_id`) REFERENCES `service_bookings` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `service_bookings`
--
ALTER TABLE `service_bookings`
  ADD CONSTRAINT `booking_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `todays_deal_products`
--
ALTER TABLE `todays_deal_products`
  ADD CONSTRAINT `todays_deal_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_manual_payment_id_foreign` FOREIGN KEY (`manual_payment_id`) REFERENCES `manual_payments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_bkkp`
--
ALTER TABLE `users_bkkp`
  ADD CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
