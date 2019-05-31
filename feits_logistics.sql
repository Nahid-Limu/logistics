-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2019 at 01:05 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feits_logistics`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery_charge`
--

CREATE TABLE `delivery_charge` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendorId` int(11) NOT NULL,
  `dimensionId` int(11) DEFAULT NULL,
  `price` decimal(18,2) DEFAULT NULL,
  `createdBy` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery_charge`
--

INSERT INTO `delivery_charge` (`id`, `vendorId`, `dimensionId`, `price`, `createdBy`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '120.00', 2, '2019-03-10 10:58:50', '2019-03-10 10:58:50'),
(2, 1, 2, NULL, 2, '2019-03-10 10:58:50', '2019-03-10 10:58:50'),
(3, 1, 3, NULL, 2, '2019-03-10 10:58:50', '2019-03-10 10:58:50'),
(4, 1, 4, NULL, 2, '2019-03-10 10:58:50', '2019-03-10 10:58:50'),
(5, 1, 5, NULL, 2, '2019-03-10 10:58:50', '2019-03-10 10:58:50'),
(6, 1, 6, '300.00', 2, '2019-03-10 10:58:50', '2019-03-10 10:58:50'),
(7, 1, 7, NULL, 2, '2019-03-10 10:58:50', '2019-03-10 10:58:50'),
(8, 1, 8, NULL, 2, '2019-03-10 10:58:50', '2019-03-10 10:58:50'),
(9, 2, 1, '200.00', 2, '2019-03-14 10:05:04', '2019-03-14 10:05:04'),
(10, 2, 2, '50.00', 2, '2019-03-14 10:05:04', '2019-03-14 10:05:04'),
(11, 2, 3, '100.00', 2, '2019-03-14 10:05:05', '2019-03-14 10:05:05'),
(12, 2, 4, NULL, 2, '2019-03-14 10:05:05', '2019-03-14 10:05:05'),
(13, 2, 5, NULL, 2, '2019-03-14 10:05:05', '2019-03-14 10:05:05'),
(14, 2, 6, NULL, 2, '2019-03-14 10:05:05', '2019-03-14 10:05:05'),
(15, 2, 7, NULL, 2, '2019-03-14 10:05:05', '2019-03-14 10:05:05'),
(16, 2, 8, NULL, 2, '2019-03-14 10:05:05', '2019-03-14 10:05:05'),
(17, 3, 1, '200.00', 2, '2019-03-24 11:46:09', '2019-03-24 11:46:09'),
(18, 3, 2, NULL, 2, '2019-03-24 11:46:09', '2019-03-24 11:46:09'),
(19, 3, 3, '150.00', 2, '2019-03-24 11:46:09', '2019-03-24 11:46:09'),
(20, 3, 4, NULL, 2, '2019-03-24 11:46:09', '2019-03-24 11:46:09'),
(21, 3, 5, NULL, 2, '2019-03-24 11:46:09', '2019-03-24 11:46:09'),
(22, 3, 6, NULL, 2, '2019-03-24 11:46:09', '2019-03-24 11:46:09'),
(23, 3, 7, NULL, 2, '2019-03-24 11:46:09', '2019-03-24 11:46:09'),
(24, 3, 8, NULL, 2, '2019-03-24 11:46:09', '2019-03-24 11:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `driver_charge`
--

CREATE TABLE `driver_charge` (
  `id` int(10) UNSIGNED NOT NULL,
  `per_order_cost` int(11) DEFAULT NULL,
  `fuel_cost` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver_charge`
--

INSERT INTO `driver_charge` (`id`, `per_order_cost`, `fuel_cost`, `created_at`, `updated_at`) VALUES
(8, 150, 90, '2019-03-27 10:54:31', '2019-03-27 10:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `driver_distance`
--

CREATE TABLE `driver_distance` (
  `id` int(10) UNSIGNED NOT NULL,
  `driverId` int(11) DEFAULT NULL,
  `distance` int(11) DEFAULT NULL,
  `unitPrice` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver_distance`
--

INSERT INTO `driver_distance` (`id`, `driverId`, `distance`, `unitPrice`, `created_at`, `updated_at`) VALUES
(2, 3, 150, 10, '2019-03-20 10:57:20', '2019-03-20 10:57:20'),
(3, 3, 150, 10, '2019-03-21 04:54:20', '2019-03-21 04:54:20'),
(4, 3, 150, 10, '2019-03-21 04:57:12', '2019-03-21 04:57:12'),
(5, 3, 150, 10, '2019-03-21 04:59:05', '2019-03-21 04:59:05'),
(6, 3, 50, 10, '2019-03-21 05:02:03', '2019-03-21 05:02:03'),
(7, 2, 240, 10, '2019-03-21 05:19:06', '2019-03-21 05:19:06'),
(8, 2, 40, 10, '2019-03-21 05:27:38', '2019-03-21 05:27:38'),
(9, 2, 55, 10, '2019-03-21 05:32:09', '2019-03-21 05:32:09'),
(10, 2, 55, 10, '2019-03-21 05:33:23', '2019-03-21 05:33:23'),
(11, 2, 60, 15, '2019-03-21 05:45:19', '2019-03-21 05:45:19'),
(12, 3, 0, 90, '2019-03-28 05:35:08', '2019-03-28 05:35:08'),
(13, 2, 30, 90, '2019-03-28 05:35:19', '2019-03-28 05:35:19'),
(14, 5, 0, 90, '2019-03-28 05:37:56', '2019-03-28 05:37:56'),
(15, 3, 0, 90, '2019-03-28 05:39:28', '2019-03-28 05:39:28'),
(16, 5, 0, 90, '2019-03-28 05:41:42', '2019-03-28 05:41:42'),
(17, 3, 0, 90, '2019-03-28 05:43:02', '2019-03-28 05:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `driving_info`
--

CREATE TABLE `driving_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) NOT NULL,
  `driving_licence` varchar(191) DEFAULT NULL,
  `reg_number` varchar(191) DEFAULT NULL,
  `reg_year` year(4) DEFAULT NULL,
  `reg_documents` varchar(191) DEFAULT NULL,
  `bike_company` varchar(150) DEFAULT NULL,
  `bike_model` varchar(191) DEFAULT NULL,
  `fuel_consumption` varchar(191) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `selsEmployeeId` varchar(190) NOT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `permanent_address` text,
  `cv` varchar(191) DEFAULT NULL,
  `national_id` varchar(150) DEFAULT NULL,
  `passport` varchar(150) DEFAULT NULL,
  `criminal_status` text,
  `fathers_name` varchar(150) DEFAULT NULL,
  `mothers_name` varchar(150) DEFAULT NULL,
  `tin_number` varchar(150) DEFAULT NULL,
  `bank_account_details` text,
  `emergency_name` varchar(150) DEFAULT NULL,
  `emergency_phone` varchar(30) DEFAULT NULL,
  `emergency_nid` varchar(150) DEFAULT NULL,
  `emergency_address` text,
  `remarks` text,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `phone`, `selsEmployeeId`, `zone_id`, `area_id`, `email`, `gender`, `photo`, `permanent_address`, `cv`, `national_id`, `passport`, `criminal_status`, `fathers_name`, `mothers_name`, `tin_number`, `bank_account_details`, `emergency_name`, `emergency_phone`, `emergency_nid`, `emergency_address`, `remarks`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Mr E', '0413639142', 'SELS-541609', NULL, 2, 'e@email.com', 1, NULL, '4Bz3LYMiEU', NULL, '0wGYa9N7PV', 'GZEEotQfQo', '1zGMfLhm28', 'AazEB5yOc6', 'P4OBkbnFXz', '9582740099', 'qHKekUEJhV', 'JP9IfdA3Dx', '5065041459', 'DET6NE8Q76', '0DgqIzia2J', 'j43E66fizq', 1, 2, '2019-03-14 09:52:35', '2019-03-14 09:52:35'),
(2, 'Mr D', '6180220527', 'SELS-943547', NULL, 2, 'd@email.com', 1, NULL, 'oa8VLwBy6S', NULL, 'KqUVvg6Inf', 'nMNjPRtppQ', 'od4bMQG2cv', 'hmVj9UXSm1', 'ES9i3MWbSo', '0434261168', 'XqbwxS3b5R', 'dGwums1Fme', '1094705456', 'bGXIBSEfdY', 'YNSUwLqW2s', 'DhegPK50ne', 1, 2, '2019-03-14 09:53:06', '2019-03-14 09:53:06'),
(3, 'Mr Vx', '6184337587', 'SELS-228317', 1, 1, 'vx@email.com', 1, NULL, 'OnrX9D2Eel', NULL, 'Dd1L30KAy4', 'h3jGih39LV', 'tZ45NCa9IE', 'teVL41GDHp', 'cus46V2Mkx', '1040518946', 'U7A9eBZVCq', '7JuyG4d4Oc', '8413932008', 'vSBf8o6wJb', 'RaIet53Aeb', 'RiOPbnApUD', 1, 2, '2019-03-18 12:05:35', '2019-03-18 12:05:35'),
(4, 'Mr testE', '7271663597', 'SELS-947602', 3, 3, 'teste@email.com', 1, NULL, 'aYNGRhbrB4', NULL, 'ahI3dHNlGB', 'GwDabE8mK1', '3OUw1Bz38q', 'yHCkGbGwcm', 'oX5EGfevU4', '2775515095', 'r20kFKtttK', 'SYMtgzX9Rb', '9589617540', '8Pfc4rLejq', '2pF8fOHJtD', 'hlzi7Rt7mN', 1, 2, '2019-03-24 11:46:58', '2019-03-24 11:46:58'),
(5, 'Mr testD', '2467196132', 'SELS-664662', 3, 3, 'testd@email.com', 1, NULL, 'zNoErYGhIf', NULL, 'B7dZrkt5zr', 'pcfpXF0ree', 'VdSTWx2sX7', 'nUU00Etaoh', 'YkEULIXY2h', '6767945131', 'HCCSmHhGoD', 'vQNHKVLkIU', '8066374569', 'M5iiigNQoz', 'lJehtgpQpI', 'pZYM8SEmPt', 1, 2, '2019-03-24 11:47:35', '2019-03-24 11:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `employee_education`
--

CREATE TABLE `employee_education` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) NOT NULL,
  `empExamTitle` varchar(50) NOT NULL,
  `empInstitution` varchar(150) DEFAULT NULL,
  `empResult` varchar(20) NOT NULL,
  `empScale` varchar(20) DEFAULT NULL,
  `empPassYear` varchar(4) DEFAULT NULL,
  `empCertificate` varchar(250) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(33, '2019_02_24_154021_create_office_address_table', 6),
(112, '2014_10_12_000000_create_users_table', 7),
(113, '2014_10_12_100000_create_password_resets_table', 7),
(114, '2016_06_01_000001_create_oauth_auth_codes_table', 7),
(115, '2016_06_01_000002_create_oauth_access_tokens_table', 7),
(116, '2016_06_01_000003_create_oauth_refresh_tokens_table', 7),
(117, '2016_06_01_000004_create_oauth_clients_table', 7),
(118, '2016_06_01_000005_create_oauth_personal_access_clients_table', 7),
(119, '2018_09_20_162246_tb_company_information', 7),
(120, '2019_02_12_154929_create_tbarea_table', 7),
(121, '2019_02_12_155003_create_tbzone_table', 7),
(122, '2019_02_12_155041_create_tblocation_table', 7),
(123, '2019_02_13_165644_create_tbvendor_table', 7),
(124, '2019_02_17_173606_create_order_details_table', 7),
(125, '2019_02_18_122312_create_employee_table', 7),
(126, '2019_02_20_115816_create_tboffice_location_table', 7),
(127, '2019_02_24_172231_create_delivery_charge_table', 7),
(128, '2019_02_24_173624_create_dimension_table', 7),
(129, '2019_02_25_133252_create_employee_education_table', 7),
(130, '2019_02_27_132101_create_nominee_table', 7),
(132, '2019_03_02_133420_create_driving_info_table', 7),
(133, '2019_03_05_104446_create_temp_order_employee_table', 7),
(134, '2019_03_07_105541_create_tborder_group_table', 7),
(135, '2019_03_10_122824_create_vendor_payment_table', 7),
(136, '2019_03_10_182431_create_tborder_payment_table', 8),
(137, '2019_03_12_121156_create_tb_vendor_rating_table', 8),
(138, '2019_03_12_121233_create_tb_driver_rating_table', 8),
(140, '2019_03_19_101238_create_driver_charge', 10),
(141, '2019_03_19_173030_create_driver_distance', 11),
(142, '2019_03_19_173510_create_driver_charge', 12),
(143, '2019_03_02_120822_create_tborder_employee_table', 13),
(144, '2019_03_18_151054_create_tbdriver_payment', 14),
(145, '2019_03_28_151357_create_tbexpensecategory', 15),
(146, '2019_03_28_162520_create_tbexpenselist', 16);

-- --------------------------------------------------------

--
-- Table structure for table `nominee`
--

CREATE TABLE `nominee` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) NOT NULL,
  `nominee_name` varchar(120) NOT NULL,
  `nominee_phone` varchar(60) DEFAULT NULL,
  `current_address` text,
  `permanent_address` text,
  `priority` varchar(40) NOT NULL,
  `nominee_details` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `scopes` text,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('3c0cffdae121674ed83e13c4a299b30bc353418a8a5f81dc4a077b0ff4559c9157f8d326475cb913', 7, 1, 'SELS', '[]', 0, '2019-03-24 04:36:19', '2019-03-24 04:36:19', '2020-03-24 10:36:19'),
('488b8e116f39d79f46d5e1a9c59653753901ea8027562473787b530f6cae35a6da8845006a61bf5c', 2, 1, 'SELS', '[]', 0, '2019-03-10 10:26:51', '2019-03-10 10:26:51', '2020-03-10 16:26:51'),
('6f9057945efc0def7073c3070a23c1d8d7665d18dca84ad0545730566e453b61850c9680958bbd42', 7, 1, 'SELS', '[]', 0, '2019-03-27 09:00:04', '2019-03-27 09:00:04', '2020-03-27 15:00:04'),
('a858037400673fb5f1f231814cb40b6412f89598c35df09daf6005d5c6933ee44e9b9be709a33216', 3, 1, 'SELS', '[]', 0, '2019-03-10 10:47:01', '2019-03-10 10:47:01', '2020-03-10 16:47:01'),
('b6e640d5afdb19ba642694bad5298f692d79628801b5fcee61ca6c001087d540004ba71eb6e94e80', 2, 1, 'SELS', '[]', 0, '2019-03-10 09:55:12', '2019-03-10 09:55:12', '2020-03-10 15:55:12'),
('ce9cbe62fccf778eab5fa00677375932e19347c59d3bec02ad9763984e091d082d279d5ea300d51a', 8, 1, 'SELS', '[]', 0, '2019-03-14 11:35:13', '2019-03-14 11:35:13', '2020-03-14 17:35:13'),
('f8c1c956f035038d1b429e5b7d3674a45a0b0688f99d10c5919bd5b3592fa79572416df6a75357bc', 7, 1, 'SELS', '[]', 0, '2019-03-21 07:18:43', '2019-03-21 07:18:43', '2020-03-21 13:18:43'),
('fcffed247006e0abb087f46ad0fe0fbe64cf3a494131d5a40ef6659c18412313c6ba7f75a891ac3d', 8, 1, 'SELS', '[]', 0, '2019-03-14 11:38:37', '2019-03-14 11:38:37', '2020-03-14 17:38:37');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `secret` varchar(100) NOT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'Oi4S4i7x5I1Xe6Wxk0muDlFumdaCmZu1cDjoGZLr', 'http://localhost', 1, 0, 0, '2019-03-10 09:54:45', '2019-03-10 09:54:45'),
(2, NULL, 'Laravel Password Grant Client', 'FT5NDyuvd3BJaut8xKLgq78fJiwkWb1R59MKP2Yf', 'http://localhost', 0, 1, 0, '2019-03-10 09:54:46', '2019-03-10 09:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-03-10 09:54:46', '2019-03-10 09:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbarea`
--

CREATE TABLE `tbarea` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `remarks` text,
  `createdBy` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbarea`
--

INSERT INTO `tbarea` (`id`, `name`, `remarks`, `createdBy`, `status`, `created_at`, `updated_at`) VALUES
(1, 'dahaka', NULL, 2, 1, '2019-03-10 10:33:30', '2019-03-10 10:33:30'),
(2, 'panchagarh', 'ZJcPTH9Cqd', 2, 1, '2019-03-14 09:43:17', '2019-03-14 09:43:17'),
(3, 'tatulia', 'uRo6IWOwxM', 2, 1, '2019-03-24 11:37:12', '2019-03-24 11:37:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbdimension`
--

CREATE TABLE `tbdimension` (
  `id` int(10) UNSIGNED NOT NULL,
  `weight` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbdimension`
--

INSERT INTO `tbdimension` (`id`, `weight`, `size`, `created_at`, `updated_at`) VALUES
(1, 'up to 1 kg', '34 x 18 x 10', NULL, NULL),
(2, 'up to 2 kg', '34 x 25 x 12', NULL, NULL),
(3, 'up to 3 kg', '34 x 32 x 14', NULL, NULL),
(4, 'up to 5 kg', '40 x 40 x 23', NULL, NULL),
(5, 'up to 7 kg', '40 x 40 x 32', NULL, NULL),
(6, 'up to 12 kg', '60 x 60 x 38', NULL, NULL),
(7, 'up to 18 kg', '62 x 62 x 50', NULL, NULL),
(8, 'up to 25 kg', '90 x 90 x 60', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbdriver_payment`
--

CREATE TABLE `tbdriver_payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `driverId` tinyint(4) DEFAULT NULL,
  `creditAmount` varchar(15) DEFAULT NULL,
  `debitAmount` varchar(15) DEFAULT NULL,
  `paymentDate` date DEFAULT NULL,
  `paymentBy` varchar(15) DEFAULT NULL,
  `remarks` text,
  `paymentMethod` varchar(2) DEFAULT NULL,
  `paymentRemarks` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbdriver_payment`
--

INSERT INTO `tbdriver_payment` (`id`, `driverId`, `creditAmount`, `debitAmount`, `paymentDate`, `paymentBy`, `remarks`, `paymentMethod`, `paymentRemarks`, `created_at`, `updated_at`) VALUES
(1, 3, '120', '0', '2019-03-28', '2', NULL, '1', NULL, '2019-03-28 05:35:08', '2019-03-28 05:35:08'),
(2, 2, '120', '2820', '2019-03-28', '2', NULL, '1', NULL, '2019-03-28 05:35:19', '2019-03-28 05:35:19'),
(3, 5, '118', '0', '2019-03-28', '2', NULL, '1', NULL, '2019-03-28 05:37:56', '2019-03-28 05:37:56'),
(4, 3, '1000', '0', '2019-03-28', '2', NULL, '1', NULL, '2019-03-28 05:39:28', '2019-03-28 05:39:28'),
(5, 5, '120', '0', '2019-03-28', '2', NULL, '1', NULL, '2019-03-28 05:41:42', '2019-03-28 05:41:42'),
(6, 3, '119', '0', '2019-03-28', '2', NULL, '1', NULL, '2019-03-28 05:43:02', '2019-03-28 05:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbexpensecategory`
--

CREATE TABLE `tbexpensecategory` (
  `id` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(191) DEFAULT NULL,
  `categoryDescription` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbexpensecategory`
--

INSERT INTO `tbexpensecategory` (`id`, `categoryName`, `categoryDescription`, `created_at`, `updated_at`) VALUES
(1, 'expense 1', 'lets rocks', '2019-03-28 10:40:55', '2019-03-28 10:41:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbexpenselist`
--

CREATE TABLE `tbexpenselist` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `reference` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `expenseDate` date DEFAULT NULL,
  `attachment` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbexpenselist`
--

INSERT INTO `tbexpenselist` (`id`, `title`, `categoryId`, `amount`, `reference`, `description`, `expenseDate`, `attachment`, `created_at`, `updated_at`) VALUES
(15, '6LzvUrPo1z', 1, 607927.00, 'kzKDvcVnht', 'gl973iyi3c', '2019-03-28', '1553773963__607927Capture.PNG', '2019-03-28 11:52:43', '2019-03-28 11:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `tblocation`
--

CREATE TABLE `tblocation` (
  `id` int(10) UNSIGNED NOT NULL,
  `zoneId` tinyint(4) NOT NULL,
  `name` varchar(150) NOT NULL,
  `latitude` varchar(25) NOT NULL,
  `longitude` varchar(25) NOT NULL,
  `remarks` text,
  `createdBy` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblocation`
--

INSERT INTO `tblocation` (`id`, `zoneId`, `name`, `latitude`, `longitude`, `remarks`, `createdBy`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'sector 5', '345898', '458956', NULL, 2, 1, '2019-03-10 10:34:40', '2019-03-10 10:34:40'),
(2, 2, 'islambag', '8loumlwXZF', 'kNJnmyuGY2', 'ZhsR1WpXy7', 2, 1, '2019-03-14 09:43:59', '2019-03-14 09:43:59'),
(3, 3, 'shipai para', '5W7ZEaOLYO', 'b1UDGIlnFC', 'cBsmPPgFEJ', 2, 1, '2019-03-24 11:38:14', '2019-03-24 11:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `tboffice_location`
--

CREATE TABLE `tboffice_location` (
  `id` int(10) UNSIGNED NOT NULL,
  `branchName` varchar(150) DEFAULT NULL,
  `latitude` varchar(25) DEFAULT NULL,
  `longitude` varchar(25) DEFAULT NULL,
  `areaId` int(11) DEFAULT NULL,
  `createdBy` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tboffice_location`
--

INSERT INTO `tboffice_location` (`id`, `branchName`, `latitude`, `longitude`, `areaId`, `createdBy`, `status`, `created_at`, `updated_at`) VALUES
(1, 'feits', '12232564', '1324654', 1, 2, 1, '2019-03-10 10:51:08', '2019-03-10 10:51:08'),
(2, 'knf8Ra5hYr', '6jbP07xhTU', 'aJia3TT1h4', 2, 2, 1, '2019-03-14 09:44:59', '2019-03-14 09:44:59'),
(3, 'tatulia branch', 'oBqOqzykre', 'IB6naa6aQ7', 3, 2, 1, '2019-03-24 11:44:50', '2019-03-24 11:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `tborder_details`
--

CREATE TABLE `tborder_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `selsOrderId` varchar(30) DEFAULT NULL,
  `vendorId` int(11) DEFAULT NULL,
  `zoneId` int(11) DEFAULT NULL,
  `pickupLocationId` int(11) DEFAULT NULL,
  `destinationLocationId` int(11) DEFAULT NULL,
  `receiverName` varchar(150) DEFAULT NULL,
  `receiverPhone` varchar(30) DEFAULT NULL,
  `receiverAddress` text,
  `productTitle` varchar(50) DEFAULT NULL,
  `productDimension` varchar(30) DEFAULT NULL,
  `productQuantity` varchar(30) DEFAULT NULL,
  `productPrice` double(8,2) DEFAULT NULL,
  `deliveryLimitDate` date DEFAULT NULL,
  `deliveryLimitTime` varchar(30) DEFAULT NULL,
  `receivedAmount` double(8,2) DEFAULT NULL,
  `paymentMethod` varchar(15) DEFAULT NULL,
  `deliveryCharge` double(8,2) DEFAULT NULL,
  `receivedVerification` text,
  `receivedSignature` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `deliveryBy` tinyint(4) DEFAULT NULL,
  `feedback` text,
  `reasonOfrejected` varchar(191) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tborder_details`
--

INSERT INTO `tborder_details` (`id`, `selsOrderId`, `vendorId`, `zoneId`, `pickupLocationId`, `destinationLocationId`, `receiverName`, `receiverPhone`, `receiverAddress`, `productTitle`, `productDimension`, `productQuantity`, `productPrice`, `deliveryLimitDate`, `deliveryLimitTime`, `receivedAmount`, `paymentMethod`, `deliveryCharge`, `receivedVerification`, `receivedSignature`, `status`, `deliveryBy`, `feedback`, `reasonOfrejected`, `order_date`, `created_at`, `updated_at`) VALUES
(1, 'SELS-392087', 1, 2, 5, 3, 'partho', '017223355', 'joynalMarket', 'apiProduct', '60 x 60 x 38', '10', 300.00, NULL, NULL, NULL, NULL, 100.00, NULL, NULL, 3, NULL, NULL, NULL, '2019-03-10', '2019-03-10 11:39:03', '2019-03-10 11:39:03'),
(2, 'SELS-785888', 1, 2, 5, 3, 'partho', '017223355', 'joynalMarket', 'apiProduct1', '60 x 60 x 38', '10', 300.00, NULL, NULL, NULL, NULL, 100.00, NULL, NULL, 3, NULL, NULL, NULL, '2019-03-10', '2019-03-10 11:41:26', '2019-03-10 11:41:26'),
(3, 'SELS-232204', 1, 2, 5, 3, 'partho', '017223355', 'joynalMarket', 'apiProduct1', '60 x 60 x 38', '10', 300.00, NULL, NULL, NULL, NULL, 100.00, NULL, NULL, 0, NULL, NULL, NULL, '2019-03-10', '2019-03-10 11:43:28', '2019-03-10 11:43:28'),
(4, 'SELS-922064', 1, 2, 5, 3, 'partho', '017223355', 'joynalMarket', 'apiProduct1', '60 x 60 x 38', '10', 300.00, NULL, NULL, NULL, NULL, 100.00, NULL, NULL, 1, NULL, NULL, NULL, '2019-03-10', '2019-03-10 11:43:51', '2019-03-10 11:43:51'),
(5, 'SELS-895565', 1, 2, 5, 3, 'partho', '017223355', 'joynalMarket', 'apiProduct1', '60 x 60 x 38', '10', 300.00, NULL, NULL, NULL, NULL, 100.00, NULL, NULL, 1, NULL, NULL, NULL, '2019-03-09', '2019-03-10 11:51:07', '2019-03-10 11:51:07'),
(6, 'SELS-575829', 1, 2, 5, 3, 'partho', '017223355', 'joynalMarket', 'apiProduct1', '60 x 60 x 38', '10', 300.00, NULL, NULL, NULL, NULL, 100.00, NULL, NULL, 3, NULL, NULL, NULL, '2019-03-09', '2019-03-10 11:52:26', '2019-03-10 11:52:26'),
(7, 'SELS-264212', 1, 2, 5, 3, 'partho', '017223355', 'joynalMarket', 'apiProduct1', '60 x 60 x 38', '10', 300.00, NULL, NULL, NULL, NULL, 100.00, NULL, NULL, 3, NULL, NULL, NULL, '2019-03-09', '2019-03-09 11:52:45', '2019-03-10 11:52:45'),
(8, 'SELS-347492', 1, 2, 5, 3, 'partho', '017223355', 'joynalMarket', 'apiProduct1', '60 x 60 x 38', '10', 300.00, NULL, NULL, NULL, NULL, 100.00, NULL, NULL, 1, NULL, NULL, NULL, '2019-03-08', '2019-03-08 11:53:44', '2019-03-10 11:53:44'),
(9, 'SELS-673840', 1, 2, 5, 3, 'partho', '017223355', 'joynalMarket', 'apiProduct1', '60 x 60 x 38', '10', 300.00, NULL, NULL, NULL, NULL, 100.00, NULL, NULL, 0, NULL, NULL, NULL, '2019-03-08', '2019-03-08 11:54:05', '2019-03-10 11:54:05'),
(10, 'SELS-945788', 2, 2, 2, 2, 'Eden Mcneil', '+1 (946) 915-9978', 'Praesentium quasi er', 'Quos sequi sit nisi', '2', '6', 844.00, NULL, NULL, NULL, NULL, 300.00, NULL, NULL, 3, NULL, NULL, NULL, '2019-03-14', '2019-03-14 10:16:46', '2019-03-14 10:16:46'),
(11, 'SELS-530902', 2, 2, 2, 2, 'Upton Gibbs', '+1 (238) 356-6128', 'Quo sint sequi mole', 'Quasi adipisci neces', '3', '5', 193.00, NULL, NULL, NULL, NULL, 500.00, NULL, NULL, 3, NULL, NULL, NULL, '2019-03-14', '2019-03-14 10:21:46', '2019-03-14 10:21:46'),
(12, 'SELS-106587', 2, 2, 2, 2, 'Tate Medina', '+1 (191) 415-6899', 'Officiis dolor facer', 'Aut distinctio Est', '1', '3', 372.00, NULL, NULL, NULL, NULL, 600.00, NULL, NULL, 3, NULL, NULL, NULL, '2019-03-14', '2019-03-14 10:38:11', '2019-03-14 10:38:11'),
(13, 'SELS-688091', 3, 3, 3, 3, 'Austin Velazquez', '+1 (243) 896-8095', 'Est in iure est aper', 'Maiores incididunt c', '1', '10', 486.00, NULL, NULL, NULL, NULL, 2000.00, NULL, NULL, 3, NULL, 'Nisi quia aliquid in', NULL, '2019-03-24', '2019-03-24 11:50:19', '2019-03-24 11:50:19'),
(14, 'SELS-845948', 3, 3, 3, 3, 'Travis Shepherd', '+1 (394) 551-9235', 'Amet officia eos vo', 'Ut est quis laborios', '1', '111', 426.00, NULL, NULL, NULL, NULL, 22200.00, NULL, NULL, 0, NULL, NULL, NULL, '2019-03-24', '2019-03-24 11:58:43', '2019-03-24 11:58:43'),
(15, 'SELS-172521', 2, 2, 2, 2, 'dfvb', '23456', 'xcvb', 'zdfvgb', '1', '5', 0.00, NULL, NULL, NULL, NULL, 1000.00, NULL, NULL, 0, NULL, NULL, NULL, '2019-03-27', '2019-03-27 05:31:24', '2019-03-27 05:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `tborder_employee`
--

CREATE TABLE `tborder_employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `orderId` int(11) NOT NULL,
  `employeeId` int(11) NOT NULL,
  `assignedBy` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `km` int(11) NOT NULL,
  `k_status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tborder_employee`
--

INSERT INTO `tborder_employee` (`id`, `orderId`, `employeeId`, `assignedBy`, `status`, `km`, `k_status`, `created_at`, `updated_at`) VALUES
(1, 10, 2, 2, 3, 30, 1, '2019-03-24 10:32:29', '2019-03-24 10:32:29'),
(2, 11, 2, 2, 2, 50, 1, '2019-03-18 11:53:37', '2019-03-18 11:53:37'),
(3, 4, 2, 2, 2, 20, 0, '2019-03-18 12:00:50', '2019-03-18 12:00:50'),
(4, 7, 3, 2, 3, 50, 1, '2019-03-18 12:06:19', '2019-03-18 12:06:19'),
(5, 8, 2, 2, 3, 10, 1, '2019-03-19 09:39:40', '2019-03-19 09:39:40'),
(6, 6, 3, 2, 2, 0, 0, '2019-03-19 10:01:19', '2019-03-19 10:01:19'),
(7, 5, 3, 2, 2, 100, 0, '2019-03-19 10:05:12', '2019-03-19 10:05:12'),
(8, 10, 2, 2, 3, 55, 1, '2019-03-24 10:32:29', '2019-03-24 10:32:29'),
(9, 13, 4, 2, 2, 0, 0, '2019-03-24 11:53:35', '2019-03-24 11:53:35');

-- --------------------------------------------------------

--
-- Table structure for table `tborder_group`
--

CREATE TABLE `tborder_group` (
  `id` int(10) UNSIGNED NOT NULL,
  `selsGroupId` varchar(30) DEFAULT NULL,
  `order_employee_id` int(11) DEFAULT NULL,
  `sorting_key` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tborder_payment`
--

CREATE TABLE `tborder_payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbvendor`
--

CREATE TABLE `tbvendor` (
  `id` int(10) UNSIGNED NOT NULL,
  `selsVendorId` varchar(30) NOT NULL,
  `areaId` int(11) DEFAULT NULL,
  `zoneId` int(11) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `deliveryRate` double(8,2) DEFAULT NULL,
  `address` text,
  `description` text,
  `remarks` text,
  `authorizedName` varchar(50) DEFAULT NULL,
  `authorizedPersonnel` varchar(50) DEFAULT NULL,
  `mediumOfContact` varchar(50) DEFAULT NULL,
  `contactInformation` varchar(100) DEFAULT NULL,
  `lCContactDetails` text,
  `registrationNumber` varchar(100) DEFAULT NULL,
  `TINNumber` varchar(50) DEFAULT NULL,
  `createdBy` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbvendor`
--

INSERT INTO `tbvendor` (`id`, `selsVendorId`, `areaId`, `zoneId`, `name`, `phone`, `photo`, `deliveryRate`, `address`, `description`, `remarks`, `authorizedName`, `authorizedPersonnel`, `mediumOfContact`, `contactInformation`, `lCContactDetails`, `registrationNumber`, `TINNumber`, `createdBy`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SELS-449669', 1, 1, 'nahid', '01719205019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1, '2019-03-10 10:41:17', '2019-03-10 10:41:17'),
(2, 'SELS-627920', 2, 2, 'Mr V', '2079305029', NULL, NULL, 'hPJjPlkX1V', 'Adzf7rFVFO', '2JHqCEugVn', '8jw6dcKpv6', 'roEKgcWVMD', 'gOctVhHaWT', '2161710864', 'qcfN1Ls8O9', 'afGS4CSDhW', 'IK5R0JrBO8', 2, 1, '2019-03-14 10:04:45', '2019-03-14 10:04:45'),
(3, 'SELS-503847', 3, 3, 'Mr testV', '3799038093', NULL, NULL, 'h70nYtyDxp', 'zY3sjqhYXf', 'WtcsF8zoCZ', 'WtuokrUNZ6', 'E1fpGj6txb', 'S6er0IANCC', '6176500917', 'jRFDNBORPN', 'wE1cHFP1f5', '4bfi82gUgD', 2, 1, '2019-03-24 11:45:48', '2019-03-24 11:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbvendor_payment`
--

CREATE TABLE `tbvendor_payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendorId` tinyint(4) DEFAULT NULL,
  `creditAmount` varchar(15) DEFAULT NULL,
  `debitAmount` varchar(15) DEFAULT NULL,
  `paymentDate` date DEFAULT NULL,
  `paymentBy` varchar(15) DEFAULT NULL,
  `remarks` text,
  `paymentMethod` varchar(2) DEFAULT NULL,
  `paymentRemarks` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbvendor_payment`
--

INSERT INTO `tbvendor_payment` (`id`, `vendorId`, `creditAmount`, `debitAmount`, `paymentDate`, `paymentBy`, `remarks`, `paymentMethod`, `paymentRemarks`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL, '2019-03-11', '2', NULL, '1', NULL, '2019-03-11 06:56:14', '2019-03-11 06:56:14'),
(2, 2, NULL, '25', '2019-03-12', '2', NULL, '1', NULL, '2019-03-12 08:59:59', '2019-03-12 08:59:59'),
(3, 1, NULL, '1000', '2019-03-13', '2', 'test remarks', '2', 'test', '2019-03-13 06:33:00', '2019-03-13 06:33:00'),
(4, 2, NULL, '5500', '2019-03-13', '2', 'test remarks', '1', 'received description', '2019-03-13 06:35:20', '2019-03-13 06:35:20'),
(5, 1, NULL, '10000', '2019-03-15', '2', 'xcvxcv', '1', 'xcvcx', '2019-03-13 06:37:37', '2019-03-13 06:37:37'),
(6, 1, '1000', NULL, '2019-03-19', '2', 'cxvxcv', '1', 'xvcv', '2019-03-13 06:39:39', '2019-03-13 06:39:39'),
(7, 1, NULL, '10987654', '2019-03-31', '2', 'dsfsdf', '1', 'dsfsdf', '2019-03-13 07:55:14', '2019-03-13 07:55:14'),
(8, 1, '500', NULL, '2019-03-26', '2', 'xzczxc', '1', 'zxczxc', '2019-03-14 09:25:24', '2019-03-14 09:25:24'),
(9, 1, '100', NULL, '2019-03-16', '2', NULL, '1', NULL, '2019-03-14 09:40:11', '2019-03-14 09:40:11'),
(10, 1, NULL, '5000', '2019-03-14', '2', 'bhs6t9Smjt', '1', 'TaC2GpSY1b', '2019-03-14 09:59:18', '2019-03-14 09:59:18'),
(11, 1, '2000', NULL, '2019-03-20', '2', NULL, '2', NULL, '2019-03-14 10:00:49', '2019-03-14 10:00:49'),
(12, 2, '2000', NULL, '2019-03-20', '2', NULL, '1', NULL, '2019-03-20 10:24:00', '2019-03-20 10:24:00'),
(13, 3, '1000', NULL, '2019-03-20', '2', 'asa', '1', 'asa', '2019-03-20 10:25:49', '2019-03-20 10:25:49'),
(14, 3, '1000', NULL, '2019-03-20', '2', 'yoo', '1', 'first payment', '2019-03-20 10:33:10', '2019-03-20 10:33:10'),
(15, 2, '2000', NULL, '2019-03-20', '2', NULL, '1', NULL, '2019-03-20 10:34:47', '2019-03-20 10:34:47'),
(16, 3, NULL, '10', '2019-03-28', '2', NULL, '1', NULL, '2019-03-28 05:23:05', '2019-03-28 05:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbzone`
--

CREATE TABLE `tbzone` (
  `id` int(10) UNSIGNED NOT NULL,
  `areaId` tinyint(4) NOT NULL,
  `name` varchar(150) NOT NULL,
  `remarks` text,
  `createdBy` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbzone`
--

INSERT INTO `tbzone` (`id`, `areaId`, `name`, `remarks`, `createdBy`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'uttara', NULL, 2, 1, '2019-03-10 10:34:05', '2019-03-10 10:34:05'),
(2, 2, 'panchagarh sada', 'RVhh2mfKUh', 2, 1, '2019-03-14 09:43:39', '2019-03-14 09:43:39'),
(3, 3, 'banglabandha', 'CUymp1ZTl8', 2, 1, '2019-03-24 11:37:40', '2019-03-24 11:37:40');

-- --------------------------------------------------------

--
-- Table structure for table `tb_company_information`
--

CREATE TABLE `tb_company_information` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_phone` varchar(30) DEFAULT NULL,
  `company_email` varchar(30) DEFAULT NULL,
  `company_address` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_company_information`
--

INSERT INTO `tb_company_information` (`id`, `company_name`, `company_phone`, `company_email`, `company_address`) VALUES
(1, 'Far East IT Solutions Ltd', '01852665521', 'info@feits.co', 'House #51, Road #18, Sector #11 \n                Uttara, Dhaka-1230');

-- --------------------------------------------------------

--
-- Table structure for table `tb_driver_rating`
--

CREATE TABLE `tb_driver_rating` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `driver_rating` varchar(191) DEFAULT NULL,
  `driver_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_vendor_rating`
--

CREATE TABLE `tb_vendor_rating` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `vendor_rating` varchar(191) DEFAULT NULL,
  `vendor_status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_vendor_rating`
--

INSERT INTO `tb_vendor_rating` (`id`, `order_id`, `vendor_id`, `vendor_rating`, `vendor_status`, `created_at`, `updated_at`) VALUES
(1, 10, 2, '5', 1, NULL, NULL),
(2, 10, 2, '4', 1, NULL, NULL),
(3, 7, 1, '5', 1, NULL, NULL),
(4, 6, 1, '5', 1, NULL, NULL),
(5, 1, 1, '4', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `temp_order_employee`
--

CREATE TABLE `temp_order_employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `is_permission` tinyint(4) NOT NULL DEFAULT '3',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `vendor_id`, `emp_id`, `name`, `email`, `password`, `is_permission`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'Super', 'super@email.com', '$2y$10$0ualEdKEWDOMJ6kb1lLraexPErFkusWyuk.qFXte2Aw/jPbFiLX.S', 1, 1, NULL, NULL, NULL),
(2, NULL, NULL, 'Admin', 'admin@email.com', '$2y$10$XnVxu9PdlW0Hk09d6XVyl.xK.7V4ze1/NYg2pip4wzrTIE.17/tG2', 2, 1, 'BqilWmsVTu4Ohwa3eNTv2jHdkPk8lXy7YKubP3xULSTr0Z1WqVcl0tGP0ZkK', NULL, NULL),
(3, 1, NULL, 'nahid', 'nahid@email.com', '$2y$10$rsoOx87gNfd0GGFurDDZO.dOdd/Thfy09.F4NYycNb1k272T6tmAi', 4, 1, 'D7hMsGRz00Wg0SPRj31aKRDkbce8akjqeZnCVXmAugdidZSvFqAYRCYh6AhP', '2019-03-10 10:41:17', '2019-03-10 10:41:17'),
(6, NULL, 1, 'Mr E', 'e@email.com', '$2y$10$Z.x6kDvyqBgmFP6Kb6k2Y.gb28m4DEZRgiLiWcbGKzr6HKgkLpsri', 3, 1, NULL, '2019-03-14 09:52:35', '2019-03-14 09:52:35'),
(7, NULL, 2, 'Mr D', 'd@email.com', '$2y$10$iNdBnE.kyySCOhiRQ.cCduCr8HR/LxEeRZlqOA.q0dMCiZ.r4fuly', 6, 1, NULL, '2019-03-14 09:53:06', '2019-03-14 09:53:06'),
(8, 2, NULL, 'Mr V', 'v@email.com', '$2y$10$0fRY0Gk0speNJw4k40ISmO1AVofyf/87FxoonCTlj8IK5uu4W9xAS', 4, 1, '5HwNUvgbfLXkgsnqpajMBQNNYTHEBVSnhf0JeeOdzUmZp7F1to4xpAQrFtSg', '2019-03-14 10:04:45', '2019-03-14 10:04:45'),
(9, NULL, 3, 'Mr Vx', 'vx@email.com', '$2y$10$py/AW5f.7417NLSKmrbBiuSpzZhtXkI0XeV4dsDC9Gzxk64xGghe.', 6, 1, NULL, '2019-03-18 12:05:35', '2019-03-18 12:05:35'),
(10, 3, NULL, 'Mr testV', 'testv@email.com', '$2y$10$bYq5ow2fLBKyBiTi12pocOpdVoMJMKi3uGWs7Nvug85W7VA1xc.zi', 4, 1, 'HFl8aJ1CFdqfGBQvDgGLn8gfFLEkfWkmQIs4byZRjLr1wAcsgMtIgQQPyEO2', '2019-03-24 11:45:48', '2019-03-24 11:45:48'),
(11, NULL, 4, 'Mr testE', 'teste@email.com', '$2y$10$lm/wbZtMWfwBc5YhYwvF1.Pl.RvAOlftQVWgBaKv45gEn15ZdD7UW', 4, 1, NULL, '2019-03-24 11:46:58', '2019-03-24 11:46:58'),
(12, NULL, 5, 'Mr testD', 'testd@email.com', '$2y$10$18k8OKXV2R/.bJrxnce9Repy2I1JEVxCAyakUUFqVJARQteb5IFr.', 6, 1, NULL, '2019-03-24 11:47:35', '2019-03-24 11:47:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_charge`
--
ALTER TABLE `delivery_charge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_charge_vendorid_index` (`vendorId`),
  ADD KEY `delivery_charge_dimensionid_index` (`dimensionId`);

--
-- Indexes for table `driver_charge`
--
ALTER TABLE `driver_charge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_distance`
--
ALTER TABLE `driver_distance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driving_info`
--
ALTER TABLE `driving_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driving_info_emp_id_index` (`emp_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_selsemployeeid_unique` (`selsEmployeeId`),
  ADD UNIQUE KEY `employee_email_unique` (`email`),
  ADD KEY `employee_name_index` (`name`),
  ADD KEY `employee_phone_index` (`phone`),
  ADD KEY `employee_zone_id_index` (`zone_id`),
  ADD KEY `employee_area_id_index` (`area_id`),
  ADD KEY `employee_gender_index` (`gender`),
  ADD KEY `employee_status_index` (`status`),
  ADD KEY `employee_created_by_index` (`created_by`);

--
-- Indexes for table `employee_education`
--
ALTER TABLE `employee_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_education_emp_id_index` (`emp_id`),
  ADD KEY `employee_education_created_by_index` (`created_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nominee`
--
ALTER TABLE `nominee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nominee_emp_id_index` (`emp_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tbarea`
--
ALTER TABLE `tbarea`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbdimension`
--
ALTER TABLE `tbdimension`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbdriver_payment`
--
ALTER TABLE `tbdriver_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbexpensecategory`
--
ALTER TABLE `tbexpensecategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbexpenselist`
--
ALTER TABLE `tbexpenselist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbexpenselist_categoryid_index` (`categoryId`);

--
-- Indexes for table `tblocation`
--
ALTER TABLE `tblocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tboffice_location`
--
ALTER TABLE `tboffice_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tboffice_location_areaid_index` (`areaId`);

--
-- Indexes for table `tborder_details`
--
ALTER TABLE `tborder_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tborder_details_selsorderid_index` (`selsOrderId`),
  ADD KEY `tborder_details_vendorid_index` (`vendorId`),
  ADD KEY `tborder_details_zoneid_index` (`zoneId`),
  ADD KEY `tborder_details_pickuplocationid_index` (`pickupLocationId`),
  ADD KEY `tborder_details_destinationlocationid_index` (`destinationLocationId`);

--
-- Indexes for table `tborder_employee`
--
ALTER TABLE `tborder_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tborder_employee_orderid_index` (`orderId`),
  ADD KEY `tborder_employee_employeeid_index` (`employeeId`),
  ADD KEY `tborder_employee_assignedby_index` (`assignedBy`),
  ADD KEY `tborder_employee_status_index` (`status`);

--
-- Indexes for table `tborder_group`
--
ALTER TABLE `tborder_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tborder_group_selsgroupid_index` (`selsGroupId`),
  ADD KEY `tborder_group_order_employee_id_index` (`order_employee_id`);

--
-- Indexes for table `tborder_payment`
--
ALTER TABLE `tborder_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbvendor`
--
ALTER TABLE `tbvendor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbvendor_selsvendorid_index` (`selsVendorId`),
  ADD KEY `tbvendor_areaid_index` (`areaId`),
  ADD KEY `tbvendor_zoneid_index` (`zoneId`);

--
-- Indexes for table `tbvendor_payment`
--
ALTER TABLE `tbvendor_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbzone`
--
ALTER TABLE `tbzone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_company_information`
--
ALTER TABLE `tb_company_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_driver_rating`
--
ALTER TABLE `tb_driver_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_vendor_rating`
--
ALTER TABLE `tb_vendor_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_order_employee`
--
ALTER TABLE `temp_order_employee`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temp_order_employee_order_id_index` (`order_id`),
  ADD KEY `temp_order_employee_employee_id_index` (`employee_id`),
  ADD KEY `temp_order_employee_user_id_index` (`user_id`);

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
-- AUTO_INCREMENT for table `delivery_charge`
--
ALTER TABLE `delivery_charge`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `driver_charge`
--
ALTER TABLE `driver_charge`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `driver_distance`
--
ALTER TABLE `driver_distance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `driving_info`
--
ALTER TABLE `driving_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee_education`
--
ALTER TABLE `employee_education`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `nominee`
--
ALTER TABLE `nominee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbarea`
--
ALTER TABLE `tbarea`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbdimension`
--
ALTER TABLE `tbdimension`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbdriver_payment`
--
ALTER TABLE `tbdriver_payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbexpensecategory`
--
ALTER TABLE `tbexpensecategory`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbexpenselist`
--
ALTER TABLE `tbexpenselist`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblocation`
--
ALTER TABLE `tblocation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tboffice_location`
--
ALTER TABLE `tboffice_location`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tborder_details`
--
ALTER TABLE `tborder_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tborder_employee`
--
ALTER TABLE `tborder_employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tborder_group`
--
ALTER TABLE `tborder_group`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tborder_payment`
--
ALTER TABLE `tborder_payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbvendor`
--
ALTER TABLE `tbvendor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbvendor_payment`
--
ALTER TABLE `tbvendor_payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbzone`
--
ALTER TABLE `tbzone`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_company_information`
--
ALTER TABLE `tb_company_information`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_driver_rating`
--
ALTER TABLE `tb_driver_rating`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_vendor_rating`
--
ALTER TABLE `tb_vendor_rating`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `temp_order_employee`
--
ALTER TABLE `temp_order_employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
