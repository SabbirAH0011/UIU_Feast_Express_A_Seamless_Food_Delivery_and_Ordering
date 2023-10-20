-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2023 at 10:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uiu_foodpanda`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `food_shop_orders`
--

CREATE TABLE IF NOT EXISTS `food_shop_orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) DEFAULT NULL,
  `shop` varchar(255) DEFAULT NULL,
  `products` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_shop_orders`
--

INSERT INTO `food_shop_orders` (`id`, `order_id`, `shop`, `products`, `created_at`, `updated_at`) VALUES
(1, 'uiufood-28082300000000001', 'cafe_east@uiu.com', '[{\"product_serial\":\"SM-000000000001\",\"product_name\":\"Biriyani\",\"signle_price\":125,\"quantity\":\"2\",\"total_price\":250}]', '2023-08-28 11:58:21', '2023-08-28 11:58:21'),
(2, 'uiufood-28082300000000002', 'cafe_east@uiu.com', '[{\"product_serial\":\"SM-000000000003\",\"product_name\":\"Kacchi\",\"signle_price\":225,\"quantity\":\"2\",\"total_price\":450}]', '2023-08-28 13:47:51', '2023-08-28 13:47:51'),
(3, 'uiufood-28082300000000003', 'cafe_east@uiu.com', '[{\"product_serial\":\"SM-000000000001\",\"product_name\":\"Biriyani\",\"signle_price\":125,\"quantity\":\"1\",\"total_price\":125}]', '2023-08-28 14:39:04', '2023-08-28 14:39:04');

-- --------------------------------------------------------

--
-- Table structure for table `main_orders`
--

CREATE TABLE IF NOT EXISTS `main_orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `oder_id` varchar(255) DEFAULT NULL,
  `client` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `products` longtext DEFAULT NULL,
  `delivery_charge` double NOT NULL DEFAULT 0,
  `total_price` double NOT NULL DEFAULT 0,
  `delivery_man` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Unpicked',
  `payment_method` varchar(255) DEFAULT NULL,
  `token` longtext DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'Unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_orders`
--

INSERT INTO `main_orders` (`id`, `oder_id`, `client`, `address`, `products`, `delivery_charge`, `total_price`, `delivery_man`, `status`, `payment_method`, `token`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 'uiufood-28082300000000001', '202304', 'Uttara, Dhaka', '[{\"product_serial\":\"SM-000000000001\",\"product_name\":\"Biriyani\",\"signle_price\":125,\"quantity\":\"2\",\"total_price\":250}]', 50, 250, 'rider@gmail.com', 'Delivered', 'Stripe', 'BwQjP5DoGdMPkfCnuc7Vw70EOLKS422wEQYCcpoB280823055821', 'Paid', '2023-08-28 11:58:21', '2023-08-28 14:35:50'),
(2, 'uiufood-28082300000000002', '202304', 'Uttara', '[{\"product_serial\":\"SM-000000000003\",\"product_name\":\"Kacchi\",\"signle_price\":225,\"quantity\":\"2\",\"total_price\":450}]', 50, 450, 'rider@gmail.com', 'Delivered', 'COD', 'r2AbM5ofzOAXpibzU636W6MVjGHDZFzRlCXuxUr6280823074751', 'Paid', '2023-08-28 13:47:51', '2023-08-28 14:35:21'),
(3, 'uiufood-28082300000000003', '202304', 'Basabo', '[{\"product_serial\":\"SM-000000000001\",\"product_name\":\"Biriyani\",\"signle_price\":125,\"quantity\":\"1\",\"total_price\":125}]', 50, 125, 'rider@gmail.com', 'Delivered', 'COD', 'GG6RECSBFp9MCiV39nUOdZnO3E1lBrLP3pfAh3wP280823083904', 'Paid', '2023-08-28 14:39:04', '2023-08-28 14:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `menues`
--

CREATE TABLE IF NOT EXISTS `menues` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `serial` varchar(255) DEFAULT NULL,
  `shop_email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `start_price` double NOT NULL DEFAULT 0,
  `discount` varchar(255) NOT NULL DEFAULT 'no',
  `discount_percent` double NOT NULL DEFAULT 0,
  `prev_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menues`
--

INSERT INTO `menues` (`id`, `serial`, `shop_email`, `name`, `img`, `description`, `start_price`, `discount`, `discount_percent`, `prev_price`, `created_at`, `updated_at`) VALUES
(3, 'SM-000000000001', 'cafe_east@uiu.com', 'Biriyani', '/public/assets/img/products/1771068532560818.png', 'Biryani is a flavorful and aromatic rice dish that originated in the Indian subcontinent and has gained popularity worldwide. It is a mixed rice dish that typically combines long-grain Basmati rice with meat (such as chicken, mutton, or fish), vegetables, and a blend of aromatic spices.\r\n\r\nThe preparation of biryani involves cooking the rice and meat separately, and then layering them together in a pot. The rice is often partially cooked and then layered with the marinated meat or vegetables, along with caramelized onions, saffron-infused milk, and a variety of spices such as cloves, cardamom, cinnamon, and bay leaves. This layered pot is then sealed to allow the flavors to infuse while the dish cooks on a low flame or in an oven.\r\n\r\nBiryani comes in various regional variations, each with its own distinct flavors and cooking techniques. Some popular types include Hyderabadi biryani, Lucknowi biryani, Kolkata biryani, and Malabar biryani. These variations may use different ingredients and spices, resulting in unique tastes and textures.\r\n\r\nBiryani is known for its rich and fragrant taste, with each grain of rice beautifully infused with the flavors of the spices and meat. It is often garnished with fried onions, fresh herbs, and sometimes served with raita (a yogurt-based side dish) or salan (spicy gravy).\r\n\r\nThis delectable rice dish has become a favorite choice for special occasions, festivals, and celebrations, as well as a popular street food option. Its combination of aromatic spices, tender meat, and fluffy rice makes biryani a beloved and cherished culinary delight enjoyed by many around the world.', 125, 'yes', 20, '150', '2023-07-10 14:56:12', '2023-07-10 14:56:12'),
(4, 'SM-000000000002', 'cafe_west@uiu.com', 'Chicken Role', '/public/assets/img/products/1771068956718944.png', 'Chicken roll is a popular and delicious street food item consisting of flavorful and tender chicken pieces wrapped in a thin flatbread or paratha. The chicken is typically marinated with a blend of spices, cooked until juicy and succulent, and then combined with fresh vegetables such as onions, lettuce, and tomatoes. The roll is often accompanied by a tangy and spicy sauce or chutney that enhances the overall taste. It is a convenient and satisfying grab-and-go snack, perfect for quick bites or as a meal option on the move.', 60, 'no', 0, NULL, '2023-07-10 15:02:56', '2023-07-10 15:02:56'),
(5, 'SM-000000000003', 'cafe_east@uiu.com', 'Kacchi', '/public/assets/img/products/1773498663475208.jpg', 'The term “kachchi” means raw referring to the biryani ingredients being combined raw in layers instead of first cooking the meat or rice separately. Traditionally, kachchi biryani is cooked in clay oven and the cooking pot is usually sealed with flour dough to allow the biryani to cook in its own steam', 225, 'no', 0, NULL, '2023-08-06 10:42:06', '2023-08-06 10:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `menue_slugs`
--

CREATE TABLE IF NOT EXISTS `menue_slugs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `serial` varchar(255) DEFAULT NULL,
  `search_tag` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menue_slugs`
--

INSERT INTO `menue_slugs` (`id`, `serial`, `search_tag`, `created_at`, `updated_at`) VALUES
(13, 'SM-000000000001', 'biriani', '2023-07-10 14:56:12', '2023-07-10 14:56:12'),
(14, 'SM-000000000001', 'briani', '2023-07-10 14:56:12', '2023-07-10 14:56:12'),
(15, 'SM-000000000001', 'bereani', '2023-07-10 14:56:12', '2023-07-10 14:56:12'),
(16, 'SM-000000000001', 'বিরিয়ানি', '2023-07-10 14:56:12', '2023-07-10 14:56:12'),
(17, 'SM-000000000001', 'বিড়িয়ানি', '2023-07-10 14:56:12', '2023-07-10 14:56:12'),
(18, 'SM-000000000001', 'Biriyani', '2023-07-10 14:56:12', '2023-07-10 14:56:12'),
(19, 'SM-000000000002', 'role', '2023-07-10 15:02:56', '2023-07-10 15:02:56'),
(20, 'SM-000000000002', 'rool', '2023-07-10 15:02:56', '2023-07-10 15:02:56'),
(21, 'SM-000000000002', 'chiken', '2023-07-10 15:02:56', '2023-07-10 15:02:56'),
(22, 'SM-000000000002', 'রোল', '2023-07-10 15:02:56', '2023-07-10 15:02:56'),
(23, 'SM-000000000002', 'চিকেন রোল', '2023-07-10 15:02:56', '2023-07-10 15:02:56'),
(24, 'SM-000000000002', 'ছিকেন রল', '2023-07-10 15:02:56', '2023-07-10 15:02:56'),
(25, 'SM-000000000002', 'ছিকেন রোল', '2023-07-10 15:02:56', '2023-07-10 15:02:56'),
(26, 'SM-000000000002', 'চিকেন রল', '2023-07-10 15:02:56', '2023-07-10 15:02:56'),
(27, 'SM-000000000002', 'Chicken Role', '2023-07-10 15:02:56', '2023-07-10 15:02:56'),
(28, 'SM-000000000003', 'কাচ্চি', '2023-08-06 10:42:06', '2023-08-06 10:42:06'),
(29, 'SM-000000000003', 'কাচ্ছি', '2023-08-06 10:42:06', '2023-08-06 10:42:06'),
(30, 'SM-000000000003', 'kasci', '2023-08-06 10:42:06', '2023-08-06 10:42:06'),
(31, 'SM-000000000003', 'kassi', '2023-08-06 10:42:06', '2023-08-06 10:42:06'),
(32, 'SM-000000000003', 'kesi', '2023-08-06 10:42:06', '2023-08-06 10:42:06'),
(33, 'SM-000000000003', 'Kacchi', '2023-08-06 10:42:06', '2023-08-06 10:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2014_10_12_000000_create_users_table', 2),
(7, '2023_07_10_195226_create_menues_table', 3),
(8, '2023_07_10_195602_create_menue_slugs_table', 3),
(10, '2023_08_28_103716_create_main_orders_table', 4),
(11, '2023_08_28_111307_create_food_shop_orders_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `serial` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `access_token` longtext DEFAULT NULL,
  `time_limit` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Active',
  `permission` varchar(255) NOT NULL DEFAULT 'approved',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `serial`, `name`, `email`, `email_verified_at`, `password`, `access_token`, `time_limit`, `path`, `status`, `permission`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, '202301', 'Cafe East', 'cafe_east@uiu.com', NULL, '$2y$10$1VkoWDUsg.fMwjcB7.E67eocawbOaQBqPe/rY6Pg8KRkd2kkAAVmW', 'KzMOBo2FSrUo2nH2oP3EHxuApKuHlAJgWrfajFlxp9OmJjtMmwZYuuyQ47if', '2023-08-29 20:40:31', 'Shop', 'Active', 'approved', NULL, '2023-07-09 10:41:00', '2023-08-28 14:40:31'),
(6, '202302', 'Admin', 'admin@uiu.com', NULL, '$2y$10$pmBhLbSyvaSPFtOm4Gy2suk7lfxV50JaPjS.VjEtzXk1YA9WXrcbG', 'Ca2tZsY33wuNTes2QJo81vfrCsKg8DqkfKV7kHoxqMnsHM0GyNK1Nq69hx8g', '2023-08-29 10:00:11', 'Admin', 'Active', 'Approved', NULL, '2023-07-09 13:06:32', '2023-08-28 04:00:11'),
(7, '202303', 'Cafe West', 'cafe_west@uiu.com', NULL, '$2y$10$9.sSfOp4XdKBtExOKVSu9ul0Ax4f5GFfUsYdDP11oKWZlvWWLAmni', 'hhyAV1RwH4oR6e4rcBETlnl3PbNQCocB8B67QYuqg8nZen4hnnufahBoteWe', '2023-07-11 21:00:32', 'Shop', 'Active', 'Approved', NULL, '2023-07-10 14:59:27', '2023-07-10 15:00:32'),
(9, '202304', 'User', 'user@gmail.com', NULL, '$2y$10$/AIm9/a9S1gHvnTCsW4b1ehhAtLPb6.S.DgAfEqXyBkzzdDu7vNEe', 'c4n0tbiGrL3j80Bz74c284sYD3pJkfy2yktVvjQSq4vXaDp0gufBcVABv9gg', '2023-08-29 15:27:28', 'User', 'Active', 'approved', NULL, '2023-07-10 15:45:00', '2023-08-28 09:27:28'),
(10, '202305', 'Rider 01', 'rider@gmail.com', NULL, '$2y$10$ej6QVh3vKdxZQwjafsUQJeTbcY57S5xgr8BfnyETfACpsnU/M.lF6', 'POE95dIHE9WSJKF1o0AevdpcNqpqpJGsEQEyAcqdUKeX7yDSj23iPsaKykeC', '2023-08-29 20:42:24', 'Rider', 'Active', 'approved', NULL, '2023-08-28 03:50:29', '2023-08-28 14:42:24');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
