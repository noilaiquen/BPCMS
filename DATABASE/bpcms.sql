-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2017 at 12:54 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bpcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_nqt_groups`
--

CREATE TABLE `admin_nqt_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_nqt_groups`
--

INSERT INTO `admin_nqt_groups` (`id`, `name`, `permission`, `status`, `created`) VALUES
(1, 'Root', '0|rwd,86|rwd,93|rwd,156|rwd,4|rwd,183|rwd,196|rwd', 1, '2012-08-28 14:51:26');

-- --------------------------------------------------------

--
-- Table structure for table `admin_nqt_logs`
--

CREATE TABLE `admin_nqt_logs` (
  `id` int(11) NOT NULL,
  `function` varchar(50) NOT NULL,
  `function_id` int(11) NOT NULL,
  `field` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  `old_value` text NOT NULL,
  `new_value` text NOT NULL,
  `account` varchar(50) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_nqt_logs`
--

INSERT INTO `admin_nqt_logs` (`id`, `function`, `function_id`, `field`, `type`, `old_value`, `new_value`, `account`, `ip`, `created`) VALUES
(1, 'admincp_accounts', 1, 'permission', 'Update', '35|rwd,42|rwd,36|rwd,37|rwd,38|rwd,39|rwd,40|rwd,41|rwd,23|rwd,28|rwd,34|rwd,26|rwd,2|rwd,1|rwd,4|rwd,3|rwd,45||rw,44||rw,62||rw,70||rw', '70|rwd,2|rwd,1|rwd,4|rwd,3|rwd', 'root', '127.0.0.1', '2017-12-06 20:38:34'),
(2, 'admincp_accounts', 1, 'custom_permission', 'Update', '0', '1', 'root', '127.0.0.1', '2017-12-06 20:38:34'),
(3, 'admincp_accounts', 1, 'permission', 'Update', '70|rwd,2|rwd,1|rwd,4|rwd,3|rwd', '70|---,2|rwd,1|rwd,4|rwd,3|rwd', 'root', '127.0.0.1', '2017-12-06 20:42:30'),
(4, 'admincp_accounts', 1, 'permission', 'Update', '70|---,2|rwd,1|rwd,4|rwd,3|rwd', '70|rwd,2|rwd,1|rwd,4|rwd,3|rwd', 'root', '127.0.0.1', '2017-12-06 20:44:18'),
(5, 'brick_categories', 1, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 20:58:03'),
(6, 'brick_categories', 1, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 20:58:05'),
(7, 'brick_categories', 1, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 20:58:12'),
(8, 'brick_categories', 1, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 20:59:46'),
(9, 'brick_categories', 1, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 20:59:59'),
(10, 'brick_categories', 1, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 21:00:03'),
(11, 'brick_categories', 1, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:00:18'),
(12, 'brick_categories', 1, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:02'),
(13, 'brick_categories', 2, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:02'),
(14, 'brick_categories', 3, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:02'),
(15, 'brick_categories', 3, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:03'),
(16, 'brick_categories', 1, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:03'),
(17, 'brick_categories', 2, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:03'),
(18, 'brick_categories', 2, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:08'),
(19, 'brick_categories', 3, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:08'),
(20, 'brick_categories', 1, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:08'),
(21, 'brick_categories', 2, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:16'),
(22, 'brick_categories', 3, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:16'),
(23, 'brick_categories', 1, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:16'),
(24, 'brick_categories', 1, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 21:05:20'),
(25, 'brick_categories', 3, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 21:05:20'),
(26, 'brick_categories', 2, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 21:05:20'),
(27, 'brick_categories', 2, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 21:05:25'),
(28, 'brick_categories', 3, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 21:05:25'),
(29, 'brick_categories', 1, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 21:05:25'),
(30, 'brick_categories', 1, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:26'),
(31, 'brick_categories', 3, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:26'),
(32, 'brick_categories', 2, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:05:26'),
(33, 'brick_categories', 2, 'name', 'Update', 'Men hoa văn', 'Men hoa văn111', 'root', '127.0.0.1', '2017-12-06 21:44:40'),
(34, 'brick_categories', 2, 'name', 'Update', 'Men hoa văn111', 'Men hoa văn', 'root', '127.0.0.1', '2017-12-06 21:44:54'),
(35, 'brick_categories', 2, 'parent_id', 'Update', '1', '3', 'root', '127.0.0.1', '2017-12-06 21:45:09'),
(36, 'brick_categories', 2, 'parent_id', 'Update', '3', '0', 'root', '127.0.0.1', '2017-12-06 21:45:23'),
(37, 'brick_categories', 2, 'parent_id', 'Update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:45:31'),
(38, 'brick_categories', 2, 'status', 'Update', '1', '0', 'root', '127.0.0.1', '2017-12-06 21:45:31'),
(39, 'brick_categories', 2, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:45:35'),
(40, 'brick_categories', 4, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-06 21:53:11'),
(41, 'brick_categories', 4, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 21:53:22'),
(42, 'brick_categories', 4, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 21:53:22'),
(43, 'brick_categories', 4, 'parent_id', 'Update', '0', '2', 'root', '127.0.0.1', '2017-12-06 21:53:26'),
(44, 'categories', 4, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 22:28:43'),
(45, 'categories', 4, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 22:28:43'),
(46, 'categories', 5, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-06 23:35:46'),
(47, 'categories', 5, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 23:35:51'),
(48, 'categories', 5, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 23:35:52'),
(49, 'categories', 5, 'parent_id', 'Update', '0', '1', 'root', '127.0.0.1', '2017-12-06 23:35:58'),
(50, 'categories', 5, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 23:36:05'),
(51, 'categories', 5, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 23:36:05'),
(52, 'categories', 2, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-06 23:50:49'),
(53, 'categories', 2, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-06 23:51:14'),
(54, 'admincp_accounts', 1, 'permission', 'Update', '70|rwd,2|rwd,1|rwd,4|rwd,3|rwd,82||rw,86||rw', '82|rwd,86|rwd,2|rwd,1|rwd,4|rwd,3|rwd', 'root', '127.0.0.1', '2017-12-06 23:57:21'),
(55, 'categories', 5, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-06 23:57:36'),
(56, 'categories', 6, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-06 23:59:32'),
(57, 'categories', 6, 'category_type_id', 'Update', '0', '2', 'root', '127.0.0.1', '2017-12-07 00:01:43'),
(58, 'products', 1, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-07 17:21:54'),
(59, 'products', 2, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-07 17:22:59'),
(60, 'products', 3, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-07 17:25:15'),
(61, 'products', 4, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-07 17:25:19'),
(62, 'products', 5, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-07 17:27:08'),
(63, 'products', 6, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-07 19:04:17'),
(64, 'products', 7, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-07 19:08:08'),
(65, 'products', 8, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-07 20:03:33'),
(66, 'products', 8, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-08 01:34:24'),
(67, 'products', 8, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-08 01:34:25'),
(68, 'products', 9, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 01:42:05'),
(69, 'products', 2, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-08 02:12:30'),
(70, 'products', 2, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-08 02:12:31'),
(71, 'products', 1, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-08 02:14:22'),
(72, 'products', 1, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-08 02:14:22'),
(73, 'categories', 7, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 10:41:19'),
(74, 'products', 21, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 10:49:17'),
(75, 'products', 22, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 10:54:34'),
(76, 'products', 23, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 10:54:36'),
(77, 'products', 24, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 10:54:47'),
(78, 'products', 25, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 11:08:02'),
(79, 'products', 25, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-08 11:09:20'),
(80, 'products', 25, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-08 11:09:21'),
(81, 'products', 1, 'slug', 'Update', '', 'product-name-20', 'root', '127.0.0.1', '2017-12-08 14:43:13'),
(82, 'products', 1, 'category_id', 'Update', '2', '1', 'root', '127.0.0.1', '2017-12-08 14:43:13'),
(83, 'products', 1, 'thumbnail', 'Update', '', 'dc4dcba2e07c0e9e1841de1397a7c578.png', 'root', '127.0.0.1', '2017-12-08 14:43:35'),
(84, 'products', 1, 'product_name', 'Update', 'Product Name 20', 'Product Name Qưeqeweq', 'root', '127.0.0.1', '2017-12-08 14:43:49'),
(85, 'products', 1, 'slug', 'Update', 'product-name-20', 'product-name-queqeweq', 'root', '127.0.0.1', '2017-12-08 14:43:49'),
(86, 'products', 26, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 15:26:03'),
(87, 'products', 27, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 15:32:07'),
(88, 'products', 26, 'product_name', 'Update', 'Sdsad', 'Nguyen Tahnh Binh', 'root', '127.0.0.1', '2017-12-08 20:50:30'),
(89, 'products', 26, 'slug', 'Update', 'sdsad', 'nguyen-tahnh-binh', 'root', '127.0.0.1', '2017-12-08 20:50:30'),
(90, 'products', 26, 'product_type_id', 'Update', '1', '2', 'root', '127.0.0.1', '2017-12-08 20:50:30'),
(91, 'products', 26, 'category_id', 'Update', '1', '7', 'root', '127.0.0.1', '2017-12-08 20:50:30'),
(92, 'products', 26, 'distributor_ids', 'Update', '1,2,3', '2,3', 'root', '127.0.0.1', '2017-12-08 20:50:31'),
(93, 'products', 26, 'price_unit_id', 'Update', '1', '2', 'root', '127.0.0.1', '2017-12-08 20:50:31'),
(94, 'products', 26, 'is_discount', 'Update', '1', '0', 'root', '127.0.0.1', '2017-12-08 20:50:31'),
(95, 'products', 26, 'discount_price', 'Update', '1213', '0', 'root', '127.0.0.1', '2017-12-08 20:50:31'),
(96, 'products', 26, 'description', 'Update', '123', 'test', 'root', '127.0.0.1', '2017-12-08 20:50:31'),
(97, 'admincp_account_groups', 4, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 21:37:31'),
(98, 'categories', 8, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 21:43:02'),
(99, 'categories', 3, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-08 21:43:15'),
(100, 'categories', 3, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-08 21:43:16'),
(101, 'products', 26, 'category_id', 'Update', '7', '6', 'root', '127.0.0.1', '2017-12-08 21:49:10'),
(102, 'products', 26, 'color_code', 'Update', '', '#FFF', 'root', '127.0.0.1', '2017-12-08 21:52:56'),
(103, 'products', 28, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 22:02:09'),
(104, 'products', 28, 'category_id', 'Update', '2', '6', 'root', '127.0.0.1', '2017-12-08 22:02:39'),
(105, 'products', 28, 'price', 'Update', '15000000', '1500000', 'root', '127.0.0.1', '2017-12-08 22:02:39'),
(106, 'distributors', 1, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 23:08:50'),
(107, 'distributors', 2, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 23:11:59'),
(108, 'distributors', 3, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 23:12:58'),
(109, 'distributors', 1, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 23:18:37'),
(110, 'distributors', 2, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 23:22:10'),
(111, 'distributors', 3, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 23:33:01'),
(112, 'admincp_account_groups', 1, 'permission', 'Update', '0|rwd,35|rwd,42|rwd,36|rwd,37|rwd,38|rwd,39|rwd,40|rwd,41|rwd,23|rwd,28|rwd,34|rwd,26|rwd,45|rwd,44|rwd,62|rwd,70|rwd,82|rwd,93|rwd,86|rwd,156|rwd,1|rwd,2|rwd', '0|rwd,86|rwd,93|rwd,1|rwd,156|rwd,2|rwd,3|rwd,4|rwd', 'root', '127.0.0.1', '2017-12-08 23:34:20'),
(113, 'admincp_accounts', 1, 'permission', 'Update', '82|rwd,93||rw,86||rw,156||rw,1||rw,2||rw', '86|rwd,93|rwd,1|rwd,156|rwd,2|rwd,3|rwd,4|rwd', 'root', '127.0.0.1', '2017-12-08 23:34:46'),
(114, 'admincp_accounts', 1, 'custom_permission', 'Update', '1', '0', 'root', '127.0.0.1', '2017-12-08 23:34:46'),
(115, 'distributors', 2, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-08 23:35:41'),
(116, 'distributors', 4, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-08 23:37:07'),
(117, 'distributors', 4, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-08 23:37:15'),
(118, 'admincp_accounts', 1, 'permission', 'Update', '86|rwd,93|rwd,156|rwd,4|rwd', '86|rwd,93|rwd,1|rwd,156|rwd,2|rwd,3|rwd,4|rwd', 'root', '127.0.0.1', '2017-12-08 23:52:26'),
(119, 'categories', 4, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-09 00:19:15'),
(120, 'products', 2, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-09 00:26:34'),
(121, 'products', 3, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-09 00:26:45'),
(122, 'products', 4, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-09 00:27:19'),
(123, 'distributors', 1, 'name', 'Update', 'Name', 'ABC Việt Nam', 'root', '127.0.0.1', '2017-12-09 00:47:14'),
(124, 'distributors', 1, 'code', 'Update', 'CODE', '#ABCVN', 'root', '127.0.0.1', '2017-12-09 00:47:14'),
(125, 'distributors', 1, 'address', 'Update', 'address', '30 tôn đức thắng', 'root', '127.0.0.1', '2017-12-09 00:47:14'),
(126, 'distributors', 3, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-09 08:38:42'),
(127, 'distributors', 3, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-09 08:38:43'),
(128, 'distributors', 3, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-09 08:39:12'),
(129, 'distributors', 2, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-09 08:39:12'),
(130, 'distributors', 1, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-09 08:39:12'),
(131, 'distributors', 3, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-09 08:39:14'),
(132, 'distributors', 2, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-09 08:39:14'),
(133, 'distributors', 1, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-09 08:39:14'),
(134, 'distributors', 3, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-09 08:39:14'),
(135, 'distributors', 2, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-09 08:39:15'),
(136, 'distributors', 1, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-09 08:39:15'),
(137, 'admincp_account_groups', 5, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 09:09:27'),
(138, 'admincp_accounts', 4, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 09:09:55'),
(139, 'products', 28, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-09 12:47:02'),
(140, 'products', 26, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-09 12:47:02'),
(141, 'products', 1, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-09 12:47:02'),
(142, 'products', 13, 'slug', 'Update', '', 'product-name-8', 'root', '127.0.0.1', '2017-12-09 12:47:17'),
(143, 'products', 13, 'product_type_id', 'Update', '1', '2', 'root', '127.0.0.1', '2017-12-09 12:47:17'),
(144, 'products', 13, 'category_id', 'Update', '2', '6', 'root', '127.0.0.1', '2017-12-09 12:47:17'),
(145, 'products', 5, 'slug', 'Update', '', 'product-name-16', 'root', '127.0.0.1', '2017-12-09 12:47:31'),
(146, 'products', 5, 'product_type_id', 'Update', '1', '2', 'root', '127.0.0.1', '2017-12-09 12:47:31'),
(147, 'products', 5, 'category_id', 'Update', '2', '7', 'root', '127.0.0.1', '2017-12-09 12:47:31'),
(148, 'distributors', 3, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-09 16:13:40'),
(149, 'distributors', 2, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-09 16:13:40'),
(150, 'distributors', 1, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-09 16:13:40'),
(151, 'distributors', 6, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:14:06'),
(152, 'distributors', 7, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:14:39'),
(153, 'distributors', 8, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:15:04'),
(154, 'distributors', 9, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:15:36'),
(155, 'distributors', 10, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:15:51'),
(156, 'distributors', 11, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:16:06'),
(157, 'distributors', 12, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:16:32'),
(158, 'distributors', 11, 'production_ids', 'Update', '', '2', 'root', '127.0.0.1', '2017-12-09 16:16:42'),
(159, 'distributors', 12, 'production_ids', 'Update', '', '1,2', 'root', '127.0.0.1', '2017-12-09 16:16:52'),
(160, 'categories', 1, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:18:18'),
(161, 'categories', 2, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:18:26'),
(162, 'categories', 3, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:18:34'),
(163, 'categories', 4, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:18:40'),
(164, 'categories', 5, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:18:49'),
(165, 'categories', 6, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:18:58'),
(166, 'categories', 7, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:19:29'),
(167, 'categories', 8, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:19:38'),
(168, 'categories', 9, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:19:43'),
(169, 'categories', 10, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:19:51'),
(170, 'categories', 11, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:19:57'),
(171, 'categories', 11, 'parent_id', 'Update', '0', '7', 'root', '127.0.0.1', '2017-12-09 16:20:21'),
(172, 'categories', 8, 'parent_id', 'Update', '0', '9', 'root', '127.0.0.1', '2017-12-09 16:20:35'),
(173, 'categories', 10, 'parent_id', 'Update', '0', '7', 'root', '127.0.0.1', '2017-12-09 16:20:50'),
(174, 'categories', 5, 'parent_id', 'Update', '0', '6', 'root', '127.0.0.1', '2017-12-09 16:21:10'),
(175, 'categories', 3, 'parent_id', 'Update', '0', '2', 'root', '127.0.0.1', '2017-12-09 16:21:46'),
(176, 'categories', 4, 'parent_id', 'Update', '0', '2', 'root', '127.0.0.1', '2017-12-09 16:22:08'),
(177, 'products', 1, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:23:59'),
(178, 'products', 2, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:24:36'),
(179, 'products', 3, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:25:29'),
(180, 'products', 4, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:25:58'),
(181, 'products', 5, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:26:56'),
(182, 'products', 6, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:27:16'),
(183, 'products', 7, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:27:46'),
(184, 'products', 8, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-09 16:28:19'),
(185, 'categories', 11, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-10 14:03:07'),
(186, 'categories', 11, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-10 14:03:07'),
(187, 'categories', 5, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-10 14:08:13'),
(188, 'categories', 5, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-10 14:08:14'),
(189, 'categories', 11, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-10 14:09:21'),
(190, 'categories', 11, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-10 14:09:23'),
(191, 'categories', 11, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-10 14:10:27'),
(192, 'categories', 11, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-10 14:10:27'),
(193, 'products', 8, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-10 14:25:09'),
(194, 'products', 8, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-10 14:25:09'),
(195, 'products', 8, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-10 14:25:12'),
(196, 'products', 8, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-10 14:25:12'),
(197, 'categories', 11, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-10 14:25:26'),
(198, 'categories', 11, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-10 14:25:27'),
(199, 'products', 8, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-10 14:25:29'),
(200, 'products', 8, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-10 14:25:30'),
(201, 'distributors', 12, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-10 14:31:55'),
(202, 'distributors', 12, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-10 14:31:56'),
(203, 'distributors', 12, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-10 14:37:50'),
(204, 'distributors', 12, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-10 14:37:51'),
(205, 'products', 9, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-10 22:46:34'),
(206, 'products', 10, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-10 22:50:35'),
(207, 'products', 11, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-10 23:29:19'),
(208, 'products', 12, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-10 23:29:56'),
(209, 'products', 12, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-10 23:30:21'),
(210, 'products', 11, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-10 23:30:21'),
(211, 'products', 8, 'product_name', 'Update', 'Sơn Chống Rỉ Sét', 'Sơn Chống Rỉ Sétj', 'root', '127.0.0.1', '2017-12-10 23:31:11'),
(212, 'products', 8, 'slug', 'Update', 'son-chong-ri-set', 'son-chong-ri-setj', 'root', '127.0.0.1', '2017-12-10 23:31:11'),
(213, 'products', 8, 'category_id', 'Update', '10', '7', 'root', '127.0.0.1', '2017-12-10 23:31:11'),
(214, 'products', 8, 'product_name', 'Update', 'Sơn Chống Rỉ Sétj', 'Sơn Chống Rỉ Séc', 'root', '127.0.0.1', '2017-12-10 23:31:29'),
(215, 'products', 8, 'slug', 'Update', 'son-chong-ri-setj', 'son-chong-ri-sec', 'root', '127.0.0.1', '2017-12-10 23:31:29'),
(216, 'products', 13, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-10 23:33:02'),
(217, 'products', 13, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-10 23:33:35'),
(218, 'categories', 12, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-10 23:33:57'),
(219, 'distributors', 13, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-11 13:57:34'),
(220, 'distributors', 13, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-11 13:57:43'),
(221, 'distributors', 14, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-11 13:59:24'),
(222, 'distributors', 14, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-11 13:59:45'),
(223, 'categories', 13, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-11 14:57:19'),
(224, 'categories', 13, 'name', 'Update', 'ưew', 'ưews', 'root', '127.0.0.1', '2017-12-11 14:59:28'),
(225, 'categories', 13, 'slug', 'Update', 'uew', 'uews', 'root', '127.0.0.1', '2017-12-11 14:59:28'),
(226, 'products', 6, 'status', 'update', '1', '0', 'root', '127.0.0.1', '2017-12-11 17:10:15'),
(227, 'products', 6, 'status', 'update', '0', '1', 'root', '127.0.0.1', '2017-12-11 17:10:16'),
(228, 'distributors', 15, 'Add new', 'Add new', '', '', 'root', '127.0.0.1', '2017-12-11 19:21:10'),
(229, 'distributors', 15, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-11 19:21:16'),
(230, 'update_profile', 1, 'password', 'Update', '123456', 'ai ma biet', 'root', '127.0.0.1', '2017-12-11 19:36:40'),
(231, 'admincp_account_groups', 5, 'Delete', 'Delete', '', '', 'root', '127.0.0.1', '2017-12-11 19:38:16'),
(232, 'categories', 13, 'Delete', 'Delete', '', '', 'admin', '127.0.0.1', '2017-12-11 19:44:05'),
(233, 'products', 8, 'status', 'update', '1', '0', 'admin', '127.0.0.1', '2017-12-11 19:46:18'),
(234, 'products', 8, 'status', 'update', '0', '1', 'admin', '127.0.0.1', '2017-12-11 19:46:19'),
(235, 'products', 14, 'Add new', 'Add new', '', '', 'admin', '127.0.0.1', '2017-12-11 19:46:31'),
(236, 'products', 14, 'Delete', 'Delete', '', '', 'admin', '127.0.0.1', '2017-12-11 19:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `admin_nqt_modules`
--

CREATE TABLE `admin_nqt_modules` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `name_function` varchar(50) NOT NULL,
  `icon` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `sort` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_nqt_modules`
--

INSERT INTO `admin_nqt_modules` (`id`, `name`, `name_function`, `icon`, `status`, `sort`, `created`) VALUES
(1, 'User group', 'admincp_account_groups', 'icon-users', 1, 5, '2012-08-16 15:53:42'),
(2, 'User', 'admincp_accounts', 'icon-user', 1, 5, '2012-08-16 15:53:42'),
(3, 'Manager Module', 'admincp_modules', 'icon-layers', 1, 6, '2012-08-16 15:53:42'),
(4, 'Manager Logs', 'admincp_logs', 'icon-note', 1, 7, '2012-08-16 15:53:42'),
(93, 'Sản phẩm', 'products', 'icon-layers', 1, 3, '2017-12-07 10:01:18'),
(86, 'Danh mục sản phẩm', 'categories', 'icon-layers', 1, 2, '2017-12-06 22:28:13'),
(196, 'Dashboard', 'dashboard', 'icon-home', 1, 0, '2017-12-09 14:30:53'),
(156, 'Nhà cung cấp', 'distributors', 'icon-layers', 1, 4, '2017-12-08 22:52:08'),
(183, 'Quản lý xuất nhập kho', 'Import_export_management', 'icon-layers', 1, 1, '2017-12-09 09:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `admin_nqt_settings`
--

CREATE TABLE `admin_nqt_settings` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_nqt_settings`
--

INSERT INTO `admin_nqt_settings` (`id`, `slug`, `content`, `modified`) VALUES
(1, 'title-admincp', 'Admin Control Panel', '2015-05-05 16:38:26');

-- --------------------------------------------------------

--
-- Table structure for table `admin_nqt_users`
--

CREATE TABLE `admin_nqt_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `group_id` int(11) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `custom_permission` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_nqt_users`
--

INSERT INTO `admin_nqt_users` (`id`, `username`, `password`, `group_id`, `permission`, `custom_permission`, `status`, `created`) VALUES
(1, 'root', '5d5563b7209b90a73e84b11d02965808', 1, '86|rwd,93|rwd,1|rwd,156|rwd,2|rwd,3|rwd,4|rwd,183||rw,196||rw', 0, 1, '2012-08-28 14:52:42'),
(2, 'admin', '85636f23d281e3b307ad27d5c72a927f', 1, '2|rwd,23|rwd,44|rwd,28|rwd,34|rwd,26|rwd,40|rwd,35|---,45|rwd,42|rwd,36|rwd,41|rwd,37|rwd,38|rwd,39|rwd,62|rwd,70|rwd,82|rwd,93|rwd,86|rwd,156|rwd,183|rwd,196|rwd', 1, 1, '2012-08-28 14:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `category_type_id` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_id`, `category_type_id`, `status`, `created`) VALUES
(1, 'Gạch đất nung', 'gach-dat-nung', 0, 1, 1, '2017-12-09 16:18:18'),
(2, 'Gạch tàu', 'gach-tau', 0, 1, 1, '2017-12-09 16:18:26'),
(3, 'Gạch không nung', 'gach-khong-nung', 2, 1, 1, '2017-12-09 16:18:34'),
(4, 'Gạch gốm thông gió', 'gach-gom-thong-gio', 2, 1, 1, '2017-12-09 16:18:40'),
(5, 'Gạch bông', 'gach-bong', 6, 1, 1, '2017-12-09 16:18:49'),
(6, 'Gạch men', 'gach-men', 0, 1, 1, '2017-12-09 16:18:58'),
(7, 'Sơn Nippon', 'son-nippon', 0, 2, 1, '2017-12-09 16:19:29'),
(8, 'Sơn Kova', 'son-kova', 9, 2, 1, '2017-12-09 16:19:38'),
(9, 'Sơn Dulux', 'son-dulux', 0, 2, 1, '2017-12-09 16:19:43'),
(10, 'Sơn Jotun', 'son-jotun', 7, 2, 1, '2017-12-09 16:19:51'),
(11, 'Sơn My Color', 'son-my-color', 7, 2, 1, '2017-12-09 16:19:57');

-- --------------------------------------------------------

--
-- Table structure for table `ci_session`
--

CREATE TABLE `ci_session` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_session`
--

INSERT INTO `ci_session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('6c0b5e385f5c7e08f4d8982467e08b8169e269ef', '::1', 1461905966, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313930353934353b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2237223b4e616d655f4d6f64756c657c733a31323a224d616e61676572204e657773223b73746172747c733a313a2230223b),
('f916e73017f492b69e3f29a87bb07eaed9f6828a', '::1', 1461905783, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313930323636333b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2237223b4e616d655f4d6f64756c657c733a31323a224d616e61676572204e657773223b73746172747c733a313a2230223b),
('44d112b7eed035f4e24addf483671d3a669555a4', '::1', 1461899795, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313839393738313b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2232223b4e616d655f4d6f64756c657c733a31353a224d616e61676572204163636f756e74223b73746172747c733a313a2230223b),
('5fe32973deeb6603a8fd6c84dd4434148b8ddbf9', '::1', 1461899780, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313839393136383b75736572496e666f7c733a343a22726f6f74223b),
('c5ef7d99b0d917710eed00fc17255820504f7b21', '::1', 1461839858, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313833393830333b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2232223b4e616d655f4d6f64756c657c733a31353a224d616e61676572204163636f756e74223b73746172747c733a313a2230223b),
('32ba21852916e3149d5b3d0add78e216e3177311', '::1', 1461839368, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313833393239363b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2232223b4e616d655f4d6f64756c657c733a31353a224d616e61676572204163636f756e74223b),
('26aee620bddab6ff3258319aeb6ec509d95ef719', '::1', 1461839275, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313833383933383b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2232223b4e616d655f4d6f64756c657c733a31353a224d616e61676572204163636f756e74223b73746172747c733a313a2230223b),
('cb95b631617b08155b4dc0183f80bbfd1e5ed5b1', '::1', 1461838822, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313833383538363b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2232223b4e616d655f4d6f64756c657c733a31353a224d616e61676572204163636f756e74223b73746172747c733a313a2230223b),
('16e8a05503a9d57b0801264e5764c8f01220249f', '::1', 1461835389, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313833353330393b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2232223b4e616d655f4d6f64756c657c733a31353a224d616e61676572204163636f756e74223b73746172747c733a313a2230223b),
('015325fe3818c316a693f986c55ddb3a6d9ad77d', '::1', 1461834928, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313833343932373b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2232223b4e616d655f4d6f64756c657c733a31353a224d616e61676572204163636f756e74223b73746172747c733a313a2230223b),
('fdbdbdf334940430fad413ab8a114afe4b3faa58', '::1', 1461830040, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313833303030373b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2232223b4e616d655f4d6f64756c657c733a31353a224d616e61676572204163636f756e74223b73746172747c733a313a2230223b),
('318f040fbba638bafc302dcd6bede2ae86f17d11', '::1', 1461811168, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313831313136373b),
('0e9244df0ee07ebd0ab7e34ab2a0746976fc904b', '::1', 1461766145, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313736363134343b),
('0aacbb22216b76ac24fa3fd092596afa0c316f91', '::1', 1461753985, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313735333936323b49445f4d6f64756c657c733a313a2233223b4e616d655f4d6f64756c657c733a31343a224d616e61676572204d6f64756c65223b73746172747c733a313a2230223b75736572496e666f7c733a343a22726f6f74223b),
('10573f61b3bb6cde0f3c163594f493bc9fa3ec4a', '::1', 1461750623, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313735303632333b),
('0886f67d9d64f67c1d7236e37fcd13f7a902ac1f', '::1', 1461753061, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313735333036313b49445f4d6f64756c657c733a313a2233223b4e616d655f4d6f64756c657c733a31343a224d616e61676572204d6f64756c65223b73746172747c733a313a2230223b75736572496e666f7c733a343a22726f6f74223b),
('cab52abfb6ba38563b6ec18dc06f6b85ed3f870e', '::1', 1461750076, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734393738383b),
('54df689f79710b68dc5c1f2848bf02e9d1ac3439', '::1', 1461749484, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734393336373b),
('1aec2c040237fb3b081d60e81c6cf439645d3c58', '::1', 1461749228, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734383937353b),
('424449eb638aa13f5e1f3fd5f77b326599531221', '::1', 1461748857, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734383732333b49445f4d6f64756c657c733a313a2233223b4e616d655f4d6f64756c657c733a31343a224d616e61676572204d6f64756c65223b73746172747c733a313a2230223b75736572496e666f7c733a343a22726f6f74223b),
('48ddda5e8e0920f7a318d11f7b0146dd2d0b1ae9', '::1', 1461748515, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734383236323b),
('568d36e38d2063d7eecba24f599c5f94b7ab796c', '::1', 1461747719, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734373639313b49445f4d6f64756c657c733a313a2237223b4e616d655f4d6f64756c657c733a31323a224d616e61676572204e657773223b73746172747c733a313a2230223b75736572496e666f7c733a343a22726f6f74223b),
('2e7c802e33fc80cafa2d77aabb3c7a2057c91fe6', '::1', 1461747372, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734373337313b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2237223b4e616d655f4d6f64756c657c733a31323a224d616e61676572204e657773223b73746172747c733a313a2230223b),
('4c1219cf638a82e0ed3205e387947f777bad9c77', '::1', 1461747375, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734373336383b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2237223b4e616d655f4d6f64756c657c733a31323a224d616e61676572204e657773223b73746172747c733a313a2230223b),
('48b166b31510ebd467c939a8d296cf2895c8d9fc', '::1', 1461747155, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734373035383b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2237223b4e616d655f4d6f64756c657c733a31323a224d616e61676572204e657773223b73746172747c733a313a2230223b),
('ac2cfc66238fcd606bae81eee5d780a6aab84ff0', '::1', 1461746777, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734363433353b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2237223b4e616d655f4d6f64756c657c733a31323a224d616e61676572204e657773223b73746172747c733a313a2230223b),
('1794d4886067095fdd84f80db56ecd4dd79c9ca1', '::1', 1461746309, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734363132353b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2237223b4e616d655f4d6f64756c657c733a31323a224d616e61676572204e657773223b73746172747c733a313a2230223b),
('905a9a99b6506428c6dfcf654e1dc80d252dee30', '::1', 1461742268, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734323132313b),
('5d44318cc7509496559e3ec5d05817bc22050b43', '::1', 1461743310, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734333330393b),
('55efe58d5f350107c6c674e6ca2f9fb2174a59e9', '::1', 1461745321, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734353132303b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2237223b4e616d655f4d6f64756c657c733a31323a224d616e61676572204e657773223b73746172747c733a313a2230223b),
('97ac3bd514aa14b60ccfa47f7ba265417d7eb50a', '::1', 1461745366, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734353331313b),
('fb13d8ba85fd9b54860ee77dcfbbac335cb3ee65', '::1', 1461745598, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436313734353531333b75736572496e666f7c733a343a22726f6f74223b49445f4d6f64756c657c733a313a2237223b4e616d655f4d6f64756c657c733a31323a224d616e61676572204e657773223b73746172747c733a313a2230223b),
('d70ef47d9bd8544c88438ea7415909f2f52eb80f', '::1', 1463392034, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436333339313734313b75736572496e666f7c733a353a2261646d696e223b),
('c856db0da01592c66a6de5da8d92c00a42c44290', '::1', 1463392358, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436333339323038393b75736572496e666f7c733a353a2261646d696e223b),
('7a8f29ff5b09d501b8778c845455e7046d5f3934', '127.0.0.1', 1465807656, 0x5f5f63695f6c6173745f726567656e65726174657c693a313436353830373536363b75736572496e666f7c733a353a2261646d696e223b49445f4d6f64756c657c733a313a2234223b4e616d655f4d6f64756c657c733a31323a224d616e61676572204c6f6773223b73746172747c733a313a2230223b);

-- --------------------------------------------------------

--
-- Table structure for table `distributors`
--

CREATE TABLE `distributors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(64) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(128) NOT NULL,
  `production_ids` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `distributors`
--

INSERT INTO `distributors` (`id`, `name`, `code`, `address`, `telephone`, `email`, `production_ids`, `status`, `created`) VALUES
(7, 'HÙNG ANH - CTY CP ĐẦU TƯ HÙNG ANH', '#HUNGANH', 'ẤP ĐƯỜNG LONG, X.THANH TUYỀN, H.DẦU TIẾNG, BÌNH DƯƠNG', '0978855342', 'nguyenvanteo@email.com', '1', 1, '2017-12-09 16:14:39'),
(6, 'THẠCH ANH - CTY TNHH VIỆT NAM GẠCH MEN THẠCH ANH (VICERA)', '#VICERA', 'ẤP AN HÒA, X.HÒA LỢI, H.BẾN CÁT, BÌNH DƯƠNG', '', '', '1', 1, '2017-12-09 16:14:06'),
(8, 'V.T.C - CTY CP GẠCH MEN V.T.C', '#VTC', 'LÔ 9 KCN GÒ DẦU, X.PHƯỚC THÁI, H.LONG THÀNH, ĐỒNG NAI', '', '', '1', 1, '2017-12-09 16:15:04'),
(9, 'Công Ty Tnhh Sơn Toa Việt Nam', '#PAINT001', '123 nguyễn đình chiểu', '', '', '2', 1, '2017-12-09 16:15:36'),
(10, 'Công Ty CPDT Hợp Thành Phát', '#PAINT002', '123 azz', '', '', '2', 1, '2017-12-09 16:15:51'),
(11, 'Công Ty TNHH Sơn BAUMATIC VIET NAM', '#BAUMATIC', '123xxxx', '', '', '2', 1, '2017-12-09 16:16:06'),
(12, 'Công Ty Cổ Phần Facomax Việt Nam', '#FACOMAX', '123zzz', '', '', '1,2', 1, '2017-12-09 16:16:32');

-- --------------------------------------------------------

--
-- Table structure for table `import_export`
--

CREATE TABLE `import_export` (
  `id` int(11) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1: import, 2: export',
  `qty` int(11) NOT NULL DEFAULT '0',
  `new_qty` int(11) NOT NULL,
  `old_qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `import_export`
--

INSERT INTO `import_export` (`id`, `product_type_id`, `category_id`, `product_id`, `type`, `qty`, `new_qty`, `old_qty`, `date`, `user_id`, `note`, `created`) VALUES
(1, 1, 1, 1, 1, 1000, 1000, 0, '2017-12-09', 1, '', '2017-12-09 16:30:52'),
(2, 1, 2, 4, 1, 1500, 1500, 0, '2017-12-09', 1, '', '2017-12-09 16:31:07'),
(3, 1, 5, 2, 1, 200, 200, 0, '2017-12-09', 1, '', '2017-12-09 16:31:27'),
(4, 1, 6, 3, 1, 2200, 2200, 0, '2017-12-09', 1, '', '2017-12-09 16:31:36'),
(5, 1, 6, 3, 2, 300, 1900, 2200, '2017-12-09', 1, '', '2017-12-09 16:31:55'),
(6, 2, 8, 6, 1, 10, 10, 0, '2017-12-09', 1, '', '2017-12-09 16:32:14'),
(7, 2, 7, 5, 1, 10, 10, 0, '2017-12-09', 1, '', '2017-12-09 16:32:22'),
(8, 2, 9, 7, 1, 30, 30, 0, '2017-12-09', 1, '', '2017-12-09 16:32:31'),
(9, 2, 10, 8, 1, 300, 300, 0, '2017-12-09', 1, '', '2017-12-09 16:32:44'),
(12, 1, 1, 1, 1, 12, 1014, 1002, '2017-12-11', 2, 'sdsad', '2017-12-11 19:44:27'),
(11, 1, 1, 1, 1, 1, 1002, 1001, '2017-12-10', 1, 'nguyễn thanh bình nguyễn thanh bình', '2017-12-10 13:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `price_unit`
--

CREATE TABLE `price_unit` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `price_unit`
--

INSERT INTO `price_unit` (`id`, `name`, `icon`) VALUES
(1, 'VNĐ', ''),
(2, 'USD', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `product_type_id` int(11) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `product_code` varchar(128) NOT NULL,
  `category_id` int(11) NOT NULL,
  `distributor_ids` text NOT NULL,
  `color_code` varchar(32) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `price_unit_id` int(11) NOT NULL DEFAULT '1',
  `is_discount` tinyint(4) NOT NULL DEFAULT '0',
  `discount_price` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `size` text NOT NULL,
  `count_stock` int(11) NOT NULL DEFAULT '0',
  `date_production` date NOT NULL,
  `date_expiration` date NOT NULL,
  `user_add` int(11) NOT NULL DEFAULT '0',
  `thumbnail` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `slug`, `product_type_id`, `unit`, `product_code`, `category_id`, `distributor_ids`, `color_code`, `price`, `price_unit_id`, `is_discount`, `discount_price`, `description`, `size`, `count_stock`, `date_production`, `date_expiration`, `user_add`, `thumbnail`, `status`, `created`) VALUES
(1, 'Gạch Xây Tường ', 'gach-xay-tuong', 1, 'Viên', '#BRICK001', 1, '6,10', '', 5000, 1, 0, 0, '', '', 1014, '2017-12-01', '2017-12-31', 1, '', 1, '2017-12-09 16:23:59'),
(2, 'Gạch Xây Lát Sàn', 'gach-xay-lat-san', 1, 'Viên', '#BRICK002', 5, '6,8,10', '', 10000, 1, 0, 0, '', '', 200, '2017-12-01', '2017-12-31', 1, '', 1, '2017-12-09 16:24:36'),
(3, 'Gạch Men Trơn', 'gach-men-tron', 1, 'Viên', '#BRICK003', 6, '7,6,8,10', '', 10000, 1, 0, 0, '', '', 1900, '2017-12-01', '2017-12-31', 1, '', 1, '2017-12-09 16:25:29'),
(4, 'Gạch Men Sần', 'gach-men-san', 1, 'Viên', '#BRICK004', 2, '8', '', 10000, 1, 0, 0, '', '', 1500, '2017-12-01', '2017-12-31', 1, '', 1, '2017-12-09 16:25:58'),
(5, 'Sơn Chống Thấm', 'son-chong-tham', 2, 'Thùng', '#PAINT001', 7, '7,11,12', '#EEEEEE', 1000000, 1, 0, 0, '', '', 10, '2017-12-01', '2017-12-31', 1, '', 1, '2017-12-09 16:26:56'),
(6, 'Sơn Lót', 'son-lot', 2, 'Thùng', '#PAINT002', 8, '7,9', '#EEEEEE', 1000000, 1, 0, 0, '', '', 10, '2017-12-01', '2017-12-31', 1, '', 1, '2017-12-09 16:27:16'),
(7, 'Sơn Chống Thấm Ngược', 'son-chong-tham-nguoc', 2, 'Thùng', '#PAINT002', 9, '10,12', '#EEEEEE', 1200000, 1, 0, 0, '', '', 30, '2017-12-01', '2017-12-31', 1, '', 1, '2017-12-09 16:27:46'),
(8, 'Sơn Chống Rỉ Séc', 'son-chong-ri-sec', 2, 'Thùng', '#PAINT002', 7, '12', '#EEEEEE', 550000, 1, 0, 0, '', '', 300, '2017-12-01', '2017-12-31', 1, '', 1, '2017-12-09 16:28:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_nqt_groups`
--
ALTER TABLE `admin_nqt_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_nqt_logs`
--
ALTER TABLE `admin_nqt_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_nqt_modules`
--
ALTER TABLE `admin_nqt_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_nqt_settings`
--
ALTER TABLE `admin_nqt_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_nqt_users`
--
ALTER TABLE `admin_nqt_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_session`
--
ALTER TABLE `ci_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `import_export`
--
ALTER TABLE `import_export`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `price_unit`
--
ALTER TABLE `price_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_nqt_groups`
--
ALTER TABLE `admin_nqt_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `admin_nqt_logs`
--
ALTER TABLE `admin_nqt_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;
--
-- AUTO_INCREMENT for table `admin_nqt_modules`
--
ALTER TABLE `admin_nqt_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;
--
-- AUTO_INCREMENT for table `admin_nqt_settings`
--
ALTER TABLE `admin_nqt_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_nqt_users`
--
ALTER TABLE `admin_nqt_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `distributors`
--
ALTER TABLE `distributors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `import_export`
--
ALTER TABLE `import_export`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `price_unit`
--
ALTER TABLE `price_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
