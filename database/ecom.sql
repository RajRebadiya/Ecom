-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2024 at 10:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `addtocart`
--

CREATE TABLE `addtocart` (
  `id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `product_id` int(20) NOT NULL,
  `p_qty` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addtocart`
--

INSERT INTO `addtocart` (`id`, `user_id`, `product_id`, `p_qty`, `created_at`, `updated_at`) VALUES
(149, 6, 7, 1, '2024-06-27 09:48:36', '2024-06-27 09:48:36'),
(150, 6, 12, 1, '2024-06-27 09:48:39', '2024-06-27 09:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(111) NOT NULL,
  `image` varchar(111) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(22, 'Grocery', 'grocery.jpg', '2024-05-09 09:26:25', '2024-05-09 09:26:25'),
(26, 'Kids', 'bag.jpg', '2024-05-09 10:21:13', '2024-05-09 10:21:13'),
(27, 'Women', 'beauty.jpg', '2024-05-09 10:24:06', '2024-05-09 10:24:06'),
(29, 'vegetable', 'vegetable.jpg', '2024-05-13 11:00:15', '2024-05-13 11:00:15'),
(30, 'Men', 'men.jpg', '2024-05-13 12:43:10', '2024-05-13 12:43:10');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL COMMENT 'Flat Or Discount',
  `amount` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`id`, `code`, `type`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'FLAT500', 'flat', 500, '2024-05-21 04:40:32', '2024-05-21 04:40:32'),
(2, 'dis20', 'discount', 20, '2024-05-21 04:40:32', '2024-05-21 04:40:32');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `pincode` int(10) NOT NULL,
  `address` mediumtext NOT NULL,
  `town` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `save_as` enum('home','shop','office','') NOT NULL COMMENT 'home , shop , office',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_address`
--

INSERT INTO `delivery_address` (`id`, `user_id`, `fullname`, `mobile`, `pincode`, `address`, `town`, `city`, `state`, `save_as`, `created_at`, `updated_at`) VALUES
(1, 6, 'Vasu Chovatiya', 1212121212, 695845, '75 , vishalnagar', 'surat', 'surat', 'gujarat', 'home', '2024-06-26 06:34:17', '2024-06-26 06:34:17'),
(2, 6, 'Vasu Chovatiya', 1212121212, 695845, '75 , vishalnagar', 'surat', 'surat', 'gujarat', 'office', '2024-06-26 06:36:50', '2024-06-26 06:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(20) NOT NULL,
  `invoice_id` varchar(15) NOT NULL,
  `total_amount` int(20) NOT NULL,
  `sub_total` int(20) NOT NULL,
  `discount` int(20) NOT NULL,
  `p_type` varchar(20) NOT NULL,
  `p_status` varchar(30) NOT NULL DEFAULT 'pending',
  `payment_id` varchar(50) NOT NULL DEFAULT 'NULL',
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `user_id` int(20) NOT NULL,
  `order_status` varchar(20) NOT NULL DEFAULT 'processing',
  `fullname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `pincode` int(20) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `invoice_id`, `total_amount`, `sub_total`, `discount`, `p_type`, `p_status`, `payment_id`, `order_date`, `user_id`, `order_status`, `fullname`, `address`, `pincode`, `mobile`, `city`, `state`, `country`, `created_at`, `updated_at`) VALUES
(164, 198, '#327379', 6165, 6165, 0, 'COD', 'success', 'NULL', '2024-06-12', 6, 'processing', 'Rebadiya Raj Pratapbhai', '97 , bhaktinagar v-1 , a.k road , surat', 395008, 6353272524, 'surat', 'gujarat', 'India', '2024-06-12 12:25:09', '2024-06-12 12:25:09'),
(165, 199, '#295942', 595, 595, 0, 'COD', 'success', 'NULL', '2024-06-13', 6, 'processing', 'Rebadiya Raj Pratapbhai', '97 , bhaktinagar v-1 , a.k road , surat', 395008, 6353272524, 'surat', 'gujarat', 'India', '2024-06-13 05:57:58', '2024-06-13 05:57:58'),
(166, 200, '#684850', 960, 1200, 240, 'Razorpay', 'success', 'pay_OMElrCJ1BJH0Ev', '2024-06-13', 6, 'processing', 'Rebadiya Raj Pratapbhai', '97 , bhaktinagar v-1 , a.k road , surat', 395008, 6353272524, 'surat', 'gujarat', 'India', '2024-06-13 11:59:02', '2024-06-13 11:59:56'),
(167, 201, '#081723', 690, 1190, 500, 'Razorpay', 'success', 'pay_OOVXqXbYNiN6iM', '2024-06-19', 6, 'processing', 'piyush', '101,vishal nagar', 548785, 9685584754, 'surat', 'gujarat', 'india', '2024-06-19 05:41:32', '2024-06-19 05:42:23'),
(168, 203, '#741755', 5732, 7165, 1433, 'COD', 'success', 'NULL', '2024-06-27', 6, 'processing', 'piyush', '101,vishal nagar', 548785, 9685584754, 'surat', 'gujarat', 'India', '2024-06-27 05:30:58', '2024-06-27 05:30:58'),
(169, 207, '#661316', 4165, 4165, 0, 'COD', 'success', 'NULL', '2024-06-27', 6, 'processing', 'piyush', '101,vishal nagar', 548785, 9685584754, 'surat', 'gujarat', 'India', '2024-06-27 05:42:20', '2024-06-27 05:42:20'),
(185, 239, '#048579', 1024, 1024, 0, 'cod', 'success', 'NULL', '2024-06-27', 3, 'processing', 'raj', 'surat', 545857, 1212121212, 'surat', 'gujarat', 'india', '2024-06-27 10:40:16', '2024-06-27 10:40:16'),
(186, 240, '#568912', 1024, 1024, 0, 'razorpay', 'success', 'pay_123', '2024-06-27', 3, 'processing', 'raj', 'surat', 545857, 1212121212, 'surat', 'gujarat', 'india', '2024-06-27 10:40:50', '2024-06-27 10:41:08'),
(187, 241, '#827307', 1024, 1024, 0, 'cod', 'success', 'NULL', '2024-06-27', 3, 'processing', 'raj', 'surat', 545857, 1212121212, 'surat', 'gujarat', 'india', '2024-06-27 11:16:07', '2024-06-27 11:16:07'),
(188, 242, '#861946', 1024, 1024, 0, 'razorpay', 'success', 'pay_123', '2024-06-27', 3, 'processing', 'raj', 'surat', 545857, 1212121212, 'surat', 'gujarat', 'india', '2024-06-27 11:17:56', '2024-06-27 11:18:25');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `order_id` int(20) NOT NULL,
  `product_id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` int(20) NOT NULL,
  `p_qty` int(20) NOT NULL,
  `total` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `name`, `price`, `p_qty`, `total`, `created_at`, `updated_at`) VALUES
(470, 198, 6, 'Cap', 595, 1, 595, '2024-06-12 12:23:30', '2024-06-12 12:23:30'),
(471, 198, 7, 'Cotten sari', 595, 1, 595, '2024-06-12 12:23:30', '2024-06-12 12:23:30'),
(472, 198, 12, 'Sketing', 1000, 1, 1000, '2024-06-12 12:23:30', '2024-06-12 12:23:30'),
(473, 199, 7, 'Cotten sari', 595, 1, 595, '2024-06-13 05:57:48', '2024-06-13 05:57:48'),
(474, 200, 15, 'shirt', 1000, 1, 1000, '2024-06-13 11:58:53', '2024-06-13 11:58:53'),
(475, 200, 14, 'Toy', 200, 1, 200, '2024-06-13 11:58:53', '2024-06-13 11:58:53'),
(476, 201, 7, 'Cotten sari', 595, 1, 595, '2024-06-19 05:40:42', '2024-06-19 05:40:42'),
(477, 201, 6, 'Cap', 595, 1, 595, '2024-06-19 05:40:42', '2024-06-19 05:40:42'),
(479, 203, 6, 'Cap', 595, 1, 595, '2024-06-27 05:30:45', '2024-06-27 05:30:45'),
(480, 203, 7, 'Cotten sari', 595, 1, 595, '2024-06-27 05:30:45', '2024-06-27 05:30:45'),
(481, 203, 13, 'Important cap', 500, 1, 500, '2024-06-27 05:30:45', '2024-06-27 05:30:45'),
(482, 207, 6, 'Cap', 595, 1, 595, '2024-06-27 05:42:09', '2024-06-27 05:42:09'),
(483, 207, 7, 'Cotten sari', 595, 1, 595, '2024-06-27 05:42:09', '2024-06-27 05:42:09'),
(487, 212, 12, 'Sketing', 1000, 3, 3000, '2024-06-27 05:51:45', '2024-06-27 05:51:45'),
(488, 212, 14, 'Toy', 200, 7, 1400, '2024-06-27 05:51:45', '2024-06-27 05:51:45'),
(490, 214, 6, 'Cap', 595, 5, 2975, '2024-06-27 06:19:32', '2024-06-27 06:19:32'),
(576, 239, 14, 'Toy', 200, 4, 800, '2024-06-27 10:40:16', '2024-06-27 10:40:16'),
(577, 239, 15, 'shirt', 1000, 10, 10000, '2024-06-27 10:40:16', '2024-06-27 10:40:16'),
(578, 239, 12, 'sketing', 1000, 9, 9000, '2024-06-27 10:40:16', '2024-06-27 10:40:16'),
(579, 239, 7, 'Cotten sari', 595, 4, 2380, '2024-06-27 10:40:16', '2024-06-27 10:40:16'),
(580, 239, 6, 'cap', 595, 6, 3570, '2024-06-27 10:40:16', '2024-06-27 10:40:16'),
(581, 240, 14, 'Toy', 200, 4, 800, '2024-06-27 10:40:50', '2024-06-27 10:40:50'),
(582, 240, 15, 'shirt', 1000, 10, 10000, '2024-06-27 10:40:50', '2024-06-27 10:40:50'),
(583, 240, 12, 'sketing', 1000, 9, 9000, '2024-06-27 10:40:50', '2024-06-27 10:40:50'),
(584, 240, 7, 'Cotten sari', 595, 4, 2380, '2024-06-27 10:40:50', '2024-06-27 10:40:50'),
(585, 240, 6, 'cap', 595, 6, 3570, '2024-06-27 10:40:50', '2024-06-27 10:40:50'),
(586, 241, 14, 'Toy', 200, 4, 800, '2024-06-27 11:16:07', '2024-06-27 11:16:07'),
(587, 241, 15, 'shirt', 1000, 10, 10000, '2024-06-27 11:16:07', '2024-06-27 11:16:07'),
(588, 241, 12, 'sketing', 1000, 9, 9000, '2024-06-27 11:16:07', '2024-06-27 11:16:07'),
(589, 241, 7, 'Cotten sari', 595, 4, 2380, '2024-06-27 11:16:07', '2024-06-27 11:16:07'),
(590, 241, 6, 'cap', 595, 6, 3570, '2024-06-27 11:16:07', '2024-06-27 11:16:07'),
(591, 242, 14, 'Toy', 200, 4, 800, '2024-06-27 11:17:56', '2024-06-27 11:17:56'),
(592, 242, 15, 'shirt', 1000, 10, 10000, '2024-06-27 11:17:56', '2024-06-27 11:17:56'),
(593, 242, 12, 'sketing', 1000, 9, 9000, '2024-06-27 11:17:56', '2024-06-27 11:17:56'),
(594, 242, 7, 'Cotten sari', 595, 4, 2380, '2024-06-27 11:17:56', '2024-06-27 11:17:56'),
(595, 242, 6, 'cap', 595, 6, 3570, '2024-06-27 11:17:56', '2024-06-27 11:17:56');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `name` varchar(111) NOT NULL,
  `description` varchar(500) NOT NULL,
  `color` varchar(111) NOT NULL,
  `size` varchar(111) NOT NULL,
  `image` mediumtext DEFAULT NULL,
  `price` int(20) NOT NULL,
  `qty` int(20) NOT NULL,
  `sell_price` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `c_id`, `name`, `description`, `color`, `size`, `image`, `price`, `qty`, `sell_price`, `created_at`, `updated_at`) VALUES
(6, 30, 'Cap', 'Cap Cap Cap', 'blue , red', 'M', '1719298192_1719298169_cap.jpg,1719298192_Blank White Cap Isolated on Transparent Background.jpg', 595, 70, 100, '2024-05-14 09:12:11', '2024-06-27 11:18:25'),
(7, 27, 'Cotten sari', 'Cap Cap Cap', 'blue', 'L', 'pngegg.png', 595, 80, 100, '2024-05-14 09:42:49', '2024-06-27 11:18:25'),
(12, 30, 'Sketing', 'Sketing is best', 'red', 'L', 'sketing.jpg', 1000, 55, 900, '2024-05-17 08:58:56', '2024-06-27 11:18:25'),
(13, 30, 'Important cap', 'Cap from urban monkey', 'white , red', 'M', 'white.jpg', 500, 100, 450, '2024-05-18 01:44:11', '2024-06-27 10:23:27'),
(14, 26, 'Toy', 'Toy for kids', 'red', 'L', 'toy.jpg', 200, 80, 190, '2024-05-20 05:37:56', '2024-06-27 11:18:25'),
(15, 30, 'shirt', 'Sketing is best', 'green', 'L', 'close-up-flannel-shirt-detail.png', 1000, 50, 800, '2024-06-12 11:10:38', '2024-06-27 11:18:25'),
(21, 22, 'megggi', 'testing is best', 'black', 'XL', '1719307940_1719298150_boy.png,1719307940_1719298192_1719298169_cap.jpg,1719307940_1719298192_Blank White Cap Isolated on Transparent Background.jpg,1719307940_1719299501_meggi.jpg', 1000, 100, 900, '2024-06-25 07:11:41', '2024-06-27 10:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `p_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `title` varchar(200) NOT NULL,
  `detail` mediumtext NOT NULL,
  `rating` int(20) NOT NULL,
  `image` varchar(30) NOT NULL DEFAULT 'boy.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `p_id`, `user_id`, `user_name`, `title`, `detail`, `rating`, `image`, `created_at`, `updated_at`) VALUES
(1, 15, 6, 'Anirudh Roy', '', '\"I recently purchased this shirt and I\'m very pleased with my decision. The fabric is soft and comfortable against the skin, making it ideal for all-day wear.\"', 0, 'boy.png', '2024-06-20 08:59:42', '2024-06-26 11:37:20'),
(2, 12, 6, 'raj', '', 'raj is best', 0, 'boy.png', '2024-06-20 09:53:06', '2024-06-26 11:37:29'),
(4, 12, 6, 'murli', '', 'watch is best for wearing', 0, 'boy.png', '2024-06-20 09:56:11', '2024-06-26 11:37:34'),
(5, 6, 6, 'murli', '', 'this is best', 0, 'boy.png', '2024-06-26 11:39:09', '2024-06-26 11:39:09'),
(6, 6, 6, 'Guest', 'shirt', 'shirt is best', 5, 'boy.png', '2024-06-26 12:15:00', '2024-06-26 12:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(111) NOT NULL,
  `email` varchar(111) NOT NULL,
  `state` varchar(20) NOT NULL DEFAULT 'gujarat',
  `city` varchar(500) NOT NULL DEFAULT 'surat',
  `mobile` bigint(20) NOT NULL DEFAULT 1234567890,
  `password` varchar(111) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `state`, `city`, `mobile`, `password`, `created_at`, `updated_at`) VALUES
(1, 'raj', 'raj@gmail.com', '', '', 0, '$2y$12$csTrGkKHYXbri3C6eLBR4O3qHWMwPXpxDJOqNg0AWz0D.pQ4tMRc.', '2024-05-08 07:04:36', '2024-05-08 08:40:07'),
(2, 'keyur', 'keyur@gmail.com', '', '', 0, '$2y$12$csTrGkKHYXbri3C6eLBR4O3qHWMwPXpxDJOqNg0AWz0D.pQ4tMRc.', '2024-05-08 07:05:02', '2024-05-08 08:39:59'),
(3, 'murli', 'murli@gmail.com', 'gujarat', 'surat', 4653645365, '$2y$12$csTrGkKHYXbri3C6eLBR4O3qHWMwPXpxDJOqNg0AWz0D.pQ4tMRc.', '2024-05-08 07:12:42', '2024-06-28 08:47:49'),
(4, 'deep', 'deep@gmail.com', '', '', 0, '$2y$12$Cr9sxSJ6GqHlBOO/5WJEpec.L/ZtpgBn7mCfx3uGf3FmlbrtFVDqS', '2024-05-08 07:15:22', '2024-05-08 07:15:22'),
(5, 'parth', 'parth@gmail.com', '', '', 0, '$2y$12$S.p5H1hU4hed0jeLZxLzDuNkHPGppzTfncGlOps2TF3atz6am5Lgy', '2024-05-08 07:17:24', '2024-05-08 07:17:24'),
(6, 'raj', 'rrrraj6353@gmail.com', 'gujarat', 'surat', 124567890, '$2y$12$F9ynFkBvwGewJ12wTeeIHOmsvO5ba35Np5LAe/ejNBK88dQDacALG', '2024-05-08 07:18:11', '2024-06-29 05:26:46'),
(7, 'het', 'het@gmail.com', '', '', 0, '$2y$12$nbcxtG0w8LzRExJyVUVQIuKHTw2wvifZFfCGq3m7YEBxm0DSGbYgS', '2024-05-08 07:19:08', '2024-05-08 07:19:08'),
(8, 'manish', 'manish@gmail.com', '', '', 0, '$2y$12$unHM5oPDQha89XROIbe9F.jwklw3boRMzQhSoB5xFDqivUGWrCE5S', '2024-05-08 07:20:34', '2024-05-08 07:20:34'),
(9, 'Shelley Pruitt', 'gowub@mailinator.com', '', '', 0, '$2y$12$ReBHZFSEAnnXenPIqpWmF.fKPCG8SEk.8IO1E79b3aTDGf2yoznum', '2024-05-08 08:37:13', '2024-05-08 08:37:13'),
(10, 'murli', 'm@gmail.com', '', '', 0, '$2y$12$2RN3BsTSyuNetQvXGlkc/ubiYdSQvrLEwpvKlU6vKYaNozE8Y7pz2', '2024-05-17 11:45:14', '2024-05-17 11:45:14'),
(11, 'Nidhi Mem', 'nidhi@gmail.com', '', '', 0, '$2y$12$V/t1IWLBNXLlcsNOOu/JqeyWnlYForT/vFJ1iItoCJgwZwpX9ykce', '2024-06-05 09:11:51', '2024-06-05 09:11:51'),
(12, 'divya', 'divya@gmail.com', 'gujarat', 'surat', 12121212, '$2y$12$0UlOFxrgLSjWNmioA4yx9ukw.TkW7oxZnEsv2IjAy0A8bwYFa1X5S', '2024-06-24 09:28:07', '2024-06-24 09:28:07'),
(13, 'divy', 'divy@gmail.co', 'gujarat', 'surat', 1212121212, '$2y$12$3YUHbPvtU.5KCIqgfnBTQOBic9Wdt7tkUQT5B9slrZkyQysXZx8JO', '2024-06-24 09:29:28', '2024-06-24 09:29:28'),
(14, 'div', 'div@gmail.co', 'gujarat', 'surat', 1212121212, '$2y$12$AqEtLayLzhl6wXy7fe4zDezvF3ASrpOM/98SyaJQsEHulPTr8I1LK', '2024-06-24 09:31:56', '2024-06-24 09:31:56'),
(15, 'div', 'hrmangukiya3494@gmail.com', 'gujarat', 'surat', 1212121212, '$2y$12$CJEFlTRdnMLnfYvhpNUsBui0jT6WUcFB7.b96zykcSm2.edrvAe9q', '2024-06-24 10:04:50', '2024-06-24 10:04:50'),
(16, 'div', 'raj@gmail.com', 'gujarat', 'surat , gujarat , india', 1212121212, '$2y$12$s5nayKNi6z2/rXMBi4ee2.bKRCjBncI/RfBPPadUwmB4XKbYUzHL6', '2024-06-24 10:35:39', '2024-06-26 10:33:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `id` int(11) NOT NULL,
  `user_id` int(20) NOT NULL,
  `final_total` int(20) NOT NULL,
  `main_total` int(20) NOT NULL,
  `discount` int(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`id`, `user_id`, `final_total`, `main_total`, `discount`, `status`, `created_at`, `updated_at`) VALUES
(198, 6, 6165, 6165, 0, 'success', '2024-06-12 12:23:28', '2024-06-12 12:25:09'),
(199, 6, 595, 595, 0, 'success', '2024-06-13 05:57:48', '2024-06-13 05:57:58'),
(200, 6, 960, 1200, 240, 'success', '2024-06-13 11:58:53', '2024-06-13 11:59:56'),
(201, 6, 690, 1190, 500, 'success', '2024-06-19 05:40:42', '2024-06-19 05:42:23'),
(203, 6, 5732, 7165, 1433, 'success', '2024-06-27 05:30:45', '2024-06-27 05:30:58'),
(207, 6, 4165, 4165, 0, 'success', '2024-06-27 05:42:09', '2024-06-27 05:42:20'),
(212, 6, 4400, 4400, 0, 'success', '2024-06-27 05:51:45', '2024-06-27 05:51:52'),
(214, 6, 1785, 1785, 0, 'success', '2024-06-27 06:19:32', '2024-06-27 06:19:39'),
(239, 3, 1024, 1024, 0, 'success', '2024-06-27 10:40:16', '2024-06-27 10:40:16'),
(240, 3, 1024, 1024, 0, 'success', '2024-06-27 10:40:50', '2024-06-27 10:41:08'),
(241, 3, 1024, 1024, 0, 'success', '2024-06-27 11:16:07', '2024-06-27 11:16:07'),
(242, 3, 1024, 1024, 0, 'success', '2024-06-27 11:17:56', '2024-06-27 11:18:25');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(111) NOT NULL,
  `product_id` int(111) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(30, 10, 12, '2024-05-20 11:02:39', '2024-05-20 11:02:39'),
(32, 10, 8, '2024-05-20 11:30:58', '2024-05-20 11:30:58'),
(34, 10, 6, '2024-05-20 11:53:35', '2024-05-20 11:53:35'),
(60, 6, 13, '2024-06-29 05:30:36', '2024-06-29 05:30:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addtocart`
--
ALTER TABLE `addtocart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoice_id` (`invoice_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `order_item_ibfk_2` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addtocart`
--
ALTER TABLE `addtocart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=598;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_order`
--
ALTER TABLE `user_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addtocart`
--
ALTER TABLE `addtocart`
  ADD CONSTRAINT `addtocart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `addtocart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD CONSTRAINT `delivery_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `user_order` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `user_order` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `user_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
