-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 05:02 AM
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
-- Database: `ahp-saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatives`
--

CREATE TABLE `alternatives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `criteria_id` bigint(20) UNSIGNED NOT NULL,
  `wisata_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_id` bigint(20) UNSIGNED NOT NULL,
  `alternative_value` decimal(10,1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alternatives`
--

INSERT INTO `alternatives` (`id`, `criteria_id`, `wisata_id`, `jenis_id`, `alternative_value`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, 1.0, '2024-04-29 10:48:39', '2024-04-29 10:48:39'),
(2, 2, 2, 3, 2.0, '2024-04-29 10:48:39', '2024-04-29 10:48:39'),
(3, 3, 2, 3, 1.0, '2024-04-29 10:48:39', '2024-04-29 10:48:39'),
(4, 4, 2, 3, 2.0, '2024-04-29 10:48:39', '2024-04-29 10:48:39'),
(5, 5, 2, 3, 4.0, '2024-04-29 10:48:39', '2024-04-29 10:48:39'),
(6, 1, 1, 1, 2.0, '2024-04-29 10:49:00', '2024-04-29 10:49:00'),
(7, 2, 1, 1, 2.0, '2024-04-29 10:49:00', '2024-04-29 10:49:00'),
(8, 3, 1, 1, 3.0, '2024-04-29 10:49:00', '2024-04-29 10:49:00'),
(9, 4, 1, 1, 3.0, '2024-04-29 10:49:00', '2024-04-29 10:49:00'),
(10, 5, 1, 1, 4.0, '2024-04-29 10:49:00', '2024-04-29 10:49:00'),
(11, 1, 3, 3, 2.0, '2024-04-30 01:57:19', '2024-04-30 01:57:19'),
(12, 2, 3, 3, 2.0, '2024-04-30 01:57:19', '2024-04-30 01:57:19'),
(13, 3, 3, 3, 2.0, '2024-04-30 01:57:19', '2024-04-30 01:57:19'),
(14, 4, 3, 3, 5.0, '2024-04-30 01:57:19', '2024-04-30 01:57:19'),
(15, 5, 3, 3, 4.0, '2024-04-30 01:57:19', '2024-04-30 01:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `bobots`
--

CREATE TABLE `bobots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `criteria_analysis_id` bigint(20) UNSIGNED NOT NULL,
  `criteria_id` bigint(20) UNSIGNED NOT NULL,
  `value` decimal(10,9) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bobots`
--

INSERT INTO `bobots` (`id`, `criteria_analysis_id`, `criteria_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0.100000000, '2024-04-29 10:50:13', '2024-04-30 02:35:40'),
(2, 1, 2, 0.200000000, '2024-04-29 10:50:13', '2024-04-30 02:35:40'),
(3, 1, 3, 0.300000000, '2024-04-29 10:50:13', '2024-04-30 02:35:40'),
(4, 1, 4, 0.200000000, '2024-04-29 10:50:13', '2024-04-30 02:35:40'),
(5, 1, 5, 0.200000000, '2024-04-29 10:50:13', '2024-04-30 02:35:40'),
(6, 2, 1, 0.300000000, '2024-04-30 01:44:38', '2024-04-30 02:36:33'),
(7, 2, 3, 0.300000000, '2024-04-30 01:44:38', '2024-04-30 02:36:33'),
(8, 2, 5, 0.400000000, '2024-04-30 01:44:38', '2024-04-30 02:36:34'),
(9, 3, 1, 0.100000000, '2024-04-30 01:57:58', '2024-04-30 02:37:20'),
(10, 3, 2, 0.200000000, '2024-04-30 01:57:58', '2024-04-30 02:37:20'),
(11, 3, 3, 0.100000000, '2024-04-30 01:57:58', '2024-04-30 02:37:20'),
(12, 3, 4, 0.100000000, '2024-04-30 01:57:58', '2024-04-30 02:37:20'),
(13, 3, 5, 0.100000000, '2024-04-30 01:57:58', '2024-04-30 02:37:20'),
(14, 4, 1, 0.000000000, '2024-04-30 02:33:40', '2024-04-30 02:33:40'),
(15, 4, 3, 0.000000000, '2024-04-30 02:33:40', '2024-04-30 02:33:40'),
(16, 4, 5, 0.000000000, '2024-04-30 02:33:40', '2024-04-30 02:33:40');

-- --------------------------------------------------------

--
-- Table structure for table `criterias`
--

CREATE TABLE `criterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `skala1` varchar(255) NOT NULL,
  `skala2` varchar(255) NOT NULL,
  `skala3` varchar(255) NOT NULL,
  `skala4` varchar(255) NOT NULL,
  `skala5` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `criterias`
--

INSERT INTO `criterias` (`id`, `nama_kriteria`, `slug`, `kategori`, `skala1`, `skala2`, `skala3`, `skala4`, `skala5`, `created_at`, `updated_at`) VALUES
(1, 'Jarak', 'jarak', 'COST', 'x ≥ 3 km', '2 km < x ≤ 3 km', '1 km < x ≤ 2 km', '500 m < x ≤ 1 km', 'x ≤ 500 m', '2024-04-29 10:30:41', '2024-04-29 10:30:41'),
(2, 'Waktu Operasional', 'waktu-operasional', 'BENEFIT', 'x ≤ 4 jam', '4 jam ≤ x < 8 jam', '8 jam ≤ x < 12 jam', '12 jam ≤ x < 16 jam', 'x ≥ 16 jam', '2024-04-29 10:32:55', '2024-04-29 10:33:32'),
(3, 'Biaya', 'biaya', 'COST', 'x > Rp.40.000', 'Rp.30.000 < x ≤ Rp.40.000', 'Rp.20.000 < x ≤ Rp.30.000', 'Rp.10.000 < x ≤ Rp.20.000', 'x ≤ Rp.10.000', '2024-04-29 10:35:34', '2024-04-29 10:35:34'),
(4, 'Fasilitas', 'fasilitas', 'BENEFIT', 'Belum Ada', 'Parkir kendaraan dan lain-lain', 'kamar mandi, parkir dan lain-lain', 'Cuci tangan, kamar mandi, parkir dan lain-lain', 'Kantin, Cuci tangan, kamar mandi, parkir dan lain-lain', '2024-04-29 10:37:48', '2024-04-29 10:37:48'),
(5, 'Rating', 'rating', 'BENEFIT', 'Bintang 1', 'Bintang 2', 'Bintang 3', 'Bintang 4', 'Bintang 5', '2024-04-29 10:38:30', '2024-04-29 10:38:30');

-- --------------------------------------------------------

--
-- Table structure for table `criteria_analyses`
--

CREATE TABLE `criteria_analyses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `criteria_analyses`
--

INSERT INTO `criteria_analyses` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-04-29 10:49:38', '2024-04-29 10:49:38'),
(2, 1, '2024-04-30 01:44:20', '2024-04-30 01:44:20'),
(3, 1, '2024-04-30 01:57:38', '2024-04-30 01:57:38'),
(4, 1, '2024-04-30 02:33:33', '2024-04-30 02:33:33');

-- --------------------------------------------------------

--
-- Table structure for table `criteria_analysis_details`
--

CREATE TABLE `criteria_analysis_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `criteria_analysis_id` bigint(20) UNSIGNED NOT NULL,
  `criteria_id_first` bigint(20) UNSIGNED NOT NULL,
  `criteria_id_second` bigint(20) UNSIGNED NOT NULL,
  `comparison_value` decimal(10,9) NOT NULL DEFAULT 1.000000000,
  `comparison_result` decimal(10,9) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `criteria_analysis_details`
--

INSERT INTO `criteria_analysis_details` (`id`, `criteria_analysis_id`, `criteria_id_first`, `criteria_id_second`, `comparison_value`, `comparison_result`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1.000000000, 1.000000000, '2024-04-29 10:49:38', '2024-04-30 02:34:42'),
(2, 1, 1, 2, 2.000000000, 2.000000000, '2024-04-29 10:49:38', '2024-04-30 02:34:42'),
(3, 1, 1, 3, 1.000000000, 1.000000000, '2024-04-29 10:49:38', '2024-04-30 02:34:42'),
(4, 1, 1, 4, 2.000000000, 2.000000000, '2024-04-29 10:49:38', '2024-04-30 02:34:42'),
(5, 1, 1, 5, 7.000000000, 7.000000000, '2024-04-29 10:49:38', '2024-04-30 02:34:42'),
(6, 1, 2, 1, 2.000000000, 0.500000000, '2024-04-29 10:49:38', '2024-04-30 02:34:42'),
(7, 1, 2, 2, 1.000000000, 1.000000000, '2024-04-29 10:49:38', '2024-04-30 02:34:42'),
(8, 1, 2, 3, 3.000000000, 3.000000000, '2024-04-29 10:49:38', '2024-04-30 02:34:42'),
(9, 1, 2, 4, 2.000000000, 2.000000000, '2024-04-29 10:49:38', '2024-04-30 02:34:42'),
(10, 1, 2, 5, 4.000000000, 4.000000000, '2024-04-29 10:49:38', '2024-04-30 02:34:42'),
(11, 1, 3, 1, 1.000000000, 1.000000000, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(12, 1, 3, 2, 3.000000000, 0.333333333, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(13, 1, 3, 3, 1.000000000, 1.000000000, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(14, 1, 3, 4, 4.000000000, 4.000000000, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(15, 1, 3, 5, 4.000000000, 4.000000000, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(16, 1, 4, 1, 2.000000000, 0.500000000, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(17, 1, 4, 2, 2.000000000, 0.500000000, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(18, 1, 4, 3, 4.000000000, 0.250000000, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(19, 1, 4, 4, 1.000000000, 1.000000000, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(20, 1, 4, 5, 1.000000000, 1.000000000, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(21, 1, 5, 1, 7.000000000, 0.142857143, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(22, 1, 5, 2, 4.000000000, 0.250000000, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(23, 1, 5, 3, 4.000000000, 0.250000000, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(24, 1, 5, 4, 1.000000000, 1.000000000, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(25, 1, 5, 5, 1.000000000, 1.000000000, '2024-04-29 10:49:39', '2024-04-30 02:34:42'),
(26, 2, 1, 1, 1.000000000, 1.000000000, '2024-04-30 01:44:20', '2024-04-30 01:44:38'),
(27, 2, 1, 3, 3.000000000, 3.000000000, '2024-04-30 01:44:20', '2024-04-30 01:44:38'),
(28, 2, 1, 5, 1.000000000, 1.000000000, '2024-04-30 01:44:20', '2024-04-30 01:44:38'),
(29, 2, 3, 1, 3.000000000, 0.333333333, '2024-04-30 01:44:20', '2024-04-30 01:44:38'),
(30, 2, 3, 3, 1.000000000, 1.000000000, '2024-04-30 01:44:20', '2024-04-30 01:44:38'),
(31, 2, 3, 5, 7.000000000, 7.000000000, '2024-04-30 01:44:20', '2024-04-30 01:44:38'),
(32, 2, 5, 1, 1.000000000, 1.000000000, '2024-04-30 01:44:20', '2024-04-30 01:44:38'),
(33, 2, 5, 3, 7.000000000, 0.142857143, '2024-04-30 01:44:20', '2024-04-30 01:44:38'),
(34, 2, 5, 5, 1.000000000, 1.000000000, '2024-04-30 01:44:20', '2024-04-30 01:44:38'),
(35, 3, 1, 1, 1.000000000, 1.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:57'),
(36, 3, 1, 2, 2.000000000, 2.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:57'),
(37, 3, 1, 3, 7.000000000, 7.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:57'),
(38, 3, 1, 4, 2.000000000, 2.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:57'),
(39, 3, 1, 5, 1.000000000, 1.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:57'),
(40, 3, 2, 1, 2.000000000, 0.500000000, '2024-04-30 01:57:38', '2024-04-30 01:57:57'),
(41, 3, 2, 2, 1.000000000, 1.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:58'),
(42, 3, 2, 3, 7.000000000, 7.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:57'),
(43, 3, 2, 4, 6.000000000, 6.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:57'),
(44, 3, 2, 5, 1.000000000, 1.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:57'),
(45, 3, 3, 1, 7.000000000, 0.142857143, '2024-04-30 01:57:38', '2024-04-30 01:57:58'),
(46, 3, 3, 2, 7.000000000, 0.142857143, '2024-04-30 01:57:38', '2024-04-30 01:57:58'),
(47, 3, 3, 3, 1.000000000, 1.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:58'),
(48, 3, 3, 4, 7.000000000, 7.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:57'),
(49, 3, 3, 5, 5.000000000, 5.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:57'),
(50, 3, 4, 1, 2.000000000, 0.500000000, '2024-04-30 01:57:38', '2024-04-30 01:57:58'),
(51, 3, 4, 2, 6.000000000, 0.166666667, '2024-04-30 01:57:38', '2024-04-30 01:57:58'),
(52, 3, 4, 3, 7.000000000, 0.142857143, '2024-04-30 01:57:38', '2024-04-30 01:57:58'),
(53, 3, 4, 4, 1.000000000, 1.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:58'),
(54, 3, 4, 5, 3.000000000, 3.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:57'),
(55, 3, 5, 1, 1.000000000, 1.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:58'),
(56, 3, 5, 2, 1.000000000, 1.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:58'),
(57, 3, 5, 3, 5.000000000, 0.200000000, '2024-04-30 01:57:38', '2024-04-30 01:57:58'),
(58, 3, 5, 4, 3.000000000, 0.333333333, '2024-04-30 01:57:38', '2024-04-30 01:57:58'),
(59, 3, 5, 5, 1.000000000, 1.000000000, '2024-04-30 01:57:38', '2024-04-30 01:57:58'),
(60, 4, 1, 1, 1.000000000, 1.000000000, '2024-04-30 02:33:33', '2024-04-30 02:33:40'),
(61, 4, 1, 3, 2.000000000, 2.000000000, '2024-04-30 02:33:33', '2024-04-30 02:33:40'),
(62, 4, 1, 5, 8.000000000, 8.000000000, '2024-04-30 02:33:33', '2024-04-30 02:33:40'),
(63, 4, 3, 1, 2.000000000, 0.500000000, '2024-04-30 02:33:33', '2024-04-30 02:33:40'),
(64, 4, 3, 3, 1.000000000, 1.000000000, '2024-04-30 02:33:33', '2024-04-30 02:33:40'),
(65, 4, 3, 5, 5.000000000, 5.000000000, '2024-04-30 02:33:33', '2024-04-30 02:33:40'),
(66, 4, 5, 1, 8.000000000, 0.125000000, '2024-04-30 02:33:33', '2024-04-30 02:33:40'),
(67, 4, 5, 3, 5.000000000, 0.200000000, '2024-04-30 02:33:33', '2024-04-30 02:33:40'),
(68, 4, 5, 5, 1.000000000, 1.000000000, '2024-04-30 02:33:33', '2024-04-30 02:33:40');

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
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `keterangan` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `jenis_name`, `slug`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Wisata Air', 'wisata-air', '', '2024-04-29 10:42:13', '2024-04-29 10:42:13'),
(2, 'Wisata gunung', 'wisata-gunung', '', '2024-04-29 10:42:31', '2024-04-29 10:42:31'),
(3, 'Wisata Belanja', 'wisata-belanja', '', '2024-04-29 10:45:52', '2024-04-29 10:45:52');

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
(5, '2024_01_27_121522_create_criterias_table', 1),
(6, '2024_01_27_121702_create_jenis_table', 1),
(7, '2024_01_27_121944_create_wisata_table', 1),
(8, '2024_01_27_122211_create_alternatives_table', 1),
(9, '2024_01_27_122421_create_criteria_analyses_table', 1),
(10, '2024_01_27_122610_create_criteria_analysis_details_table', 1),
(11, '2024_01_27_122813_create_priority_values_table', 1),
(12, '2024_02_14_111054_create_bobots_table', 1),
(13, '2024_03_25_170546_create_saran_table', 1);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `priority_values`
--

CREATE TABLE `priority_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `criteria_analysis_id` bigint(20) UNSIGNED NOT NULL,
  `criteria_id` bigint(20) UNSIGNED NOT NULL,
  `value` decimal(10,9) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `priority_values`
--

INSERT INTO `priority_values` (`id`, `criteria_analysis_id`, `criteria_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0.320312124, '2024-04-29 10:50:13', '2024-04-30 02:34:42'),
(2, 1, 2, 0.276947506, '2024-04-29 10:50:13', '2024-04-29 10:50:13'),
(3, 1, 3, 0.243385354, '2024-04-29 10:50:13', '2024-04-30 02:34:42'),
(4, 1, 4, 0.097163592, '2024-04-29 10:50:13', '2024-04-30 02:34:42'),
(5, 1, 5, 0.062191422, '2024-04-29 10:50:13', '2024-04-30 02:34:42'),
(6, 2, 1, 0.421273490, '2024-04-30 01:44:38', '2024-04-30 01:44:38'),
(7, 2, 3, 0.387338076, '2024-04-30 01:44:38', '2024-04-30 01:44:38'),
(8, 2, 5, 0.191388432, '2024-04-30 01:44:38', '2024-04-30 01:44:38'),
(9, 3, 1, 0.290373329, '2024-04-30 01:57:58', '2024-04-30 01:57:58'),
(10, 3, 2, 0.261125899, '2024-04-30 01:57:58', '2024-04-30 01:57:58'),
(11, 3, 3, 0.205379501, '2024-04-30 01:57:58', '2024-04-30 01:57:58'),
(12, 3, 4, 0.108205538, '2024-04-30 01:57:58', '2024-04-30 01:57:58'),
(13, 3, 5, 0.134915730, '2024-04-30 01:57:58', '2024-04-30 01:57:58'),
(14, 4, 1, 0.603937729, '2024-04-30 02:33:40', '2024-04-30 02:33:40'),
(15, 4, 3, 0.325778388, '2024-04-30 02:33:40', '2024-04-30 02:33:40'),
(16, 4, 5, 0.070283882, '2024-04-30 02:33:40', '2024-04-30 02:33:40');

-- --------------------------------------------------------

--
-- Table structure for table `sarans`
--

CREATE TABLE `sarans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `keterangan` text NOT NULL,
  `validasi` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL DEFAULT 'USER',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin1', 'admin@gmail.com', NULL, '$2b$12$VAE.0hOCOyfR7ajIzpqdV.gTozWc3ePuQg4.NobpWAAWhIQtlMFR.', 'ADMIN', NULL, '2024-04-29 05:06:54', '2024-04-29 05:06:54'),
(2, 'Wisatawan 1', 'wisatawan1', 'user@gmail.com', NULL, '$2y$10$MmX3PdR93ZtgXALwj/5DX.zJMsPL3CDhYWUaJrFaoavn816KZxjee', 'USER', NULL, '2024-04-29 05:06:54', '2024-04-29 05:06:54'),
(3, 'asep', 'asep1234', 'asepsyaputra840@gmail.com', NULL, '$2y$10$oLtd/Hc1VXU28iR8LxbwJe1sNaCcdETk3dfsuLLzchW6sroSJWlzu', 'USER', NULL, '2024-04-30 01:46:34', '2024-04-30 01:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `wisatas`
--

CREATE TABLE `wisatas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_id` bigint(20) UNSIGNED NOT NULL,
  `nama_wisata` varchar(255) NOT NULL,
  `lokasi_maps` varchar(255) NOT NULL,
  `link_foto` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `fasilitas` varchar(255) NOT NULL,
  `biaya` int(11) NOT NULL,
  `situs` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `validasi` varchar(100) NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wisatas`
--

INSERT INTO `wisatas` (`id`, `jenis_id`, `nama_wisata`, `lokasi_maps`, `link_foto`, `keterangan`, `fasilitas`, `biaya`, `situs`, `created_at`, `updated_at`, `validasi`, `user_id`) VALUES
(1, 1, 'Pantai Kuta', 'https://www.google.com/maps/dir//Pantai+kuta/data=!4m6!4m5!1m1!4e2!1m2!1m1!1s0x2dd246bc2ab70d43:0x82feaae12f4ab48e?sa=X&ved=1t:3061&ictx=111', 'https://www.indonesia.travel/content/dam/indtravelrevamp/en/destinations/bali-nusa-tenggara/Kuta_1.jpg', 'Sepanjang pesisir pantai di Kuta memiliki ombak yang tidak terlalu tinggi, sehingga cocok banget buat Sobat Pesona yang berniat atau sedang belajar berselancar. Hamparan pasir putih bersih dan indahnya gradasi warna laut di Pantai Kuta juga dijamin memanj', 'Full', 50000, 'https://www.indonesia.travel/id/id/destinasi/bali-nusa-tenggara/kuta', '2024-04-29 10:45:11', '2024-04-29 10:45:11', '2', 1),
(2, 3, 'Wisata Belanja JOGER', 'https://www.google.com/maps/dir//Jl.+Raya+Kuta,+Kuta,+Kec.+Kuta,+Kabupaten+Badung,+Bali+80361/@-8.7273725,115.0947432,12z/data=!4m8!4m7!1m0!1m5!1m1!1s0x2dd246a58aa103dd:0x5366a8d529fd21b1!2m2!1d115.177144!2d-8.7273374?entry=ttu', 'https://www.aswindrajaya.com/wp-content/uploads/2019/09/Joger.jpg', 'Mencari oleh-oleh tentunya tidak asing dengan budget yang disediakan. Berbicara masalah budget jangan khawatir ketika mengunjungi toko ini. Dengan harga 4000 sudah bisa mendapatkan gantungan kunci. Untuk kaos oblong yang didesain dengan kata-kata uniknya ', 'Wisata Belanja', 50000, 'https://www.aswindrajaya.com/tempat-wisata-bali/joger-bali/', '2024-04-29 10:47:57', '2024-04-29 10:47:57', '2', 1),
(3, 3, 'Krisna Oleh-Oleh', 'https://www.google.com/maps?s=web&sca_esv=c184257a52ae0f94&client=firefox-b-d&lqi=CgtrcmlzbmEgYmFsaSIDiAEBSPT--fSVrYCACFoTEAAYABgBIgtrcmlzbmEgYmFsaZIBDnNvdXZlbmlyX3N0b3JlqgE_EAEqCiIGa3Jpc25hKCYyHhABIhoVBJ5Tf1K3Y9StGiHabV9N7NafgMRPIG8y5zIPEAIiC2tyaXNuYSBiY', 'https://lh5.googleusercontent.com/p/AF1QipPkdv-AAQvelGdcE3csxoz60fY4SoVZxBSPbfQK=w260-h175-n-k-no', 'Pusat Oleh-Oleh', 'Full', 50000, 'https://krisnabali.co.id/', '2024-04-30 01:56:49', '2024-04-30 01:56:49', '2', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatives`
--
ALTER TABLE `alternatives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alternatives_criteria_id_foreign` (`criteria_id`),
  ADD KEY `alternatives_wisata_id_foreign` (`wisata_id`),
  ADD KEY `alternatives_jenis_id_foreign` (`jenis_id`);

--
-- Indexes for table `bobots`
--
ALTER TABLE `bobots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bobots_criteria_analysis_id_foreign` (`criteria_analysis_id`),
  ADD KEY `bobots_criteria_id_foreign` (`criteria_id`);

--
-- Indexes for table `criterias`
--
ALTER TABLE `criterias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `criterias_nama_kriteria_unique` (`nama_kriteria`),
  ADD UNIQUE KEY `criterias_slug_unique` (`slug`);

--
-- Indexes for table `criteria_analyses`
--
ALTER TABLE `criteria_analyses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criteria_analyses_user_id_foreign` (`user_id`);

--
-- Indexes for table `criteria_analysis_details`
--
ALTER TABLE `criteria_analysis_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criteria_analysis_details_criteria_analysis_id_foreign` (`criteria_analysis_id`),
  ADD KEY `criteria_analysis_details_criteria_id_first_foreign` (`criteria_id_first`),
  ADD KEY `criteria_analysis_details_criteria_id_second_foreign` (`criteria_id_second`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jenis_jenis_name_unique` (`jenis_name`),
  ADD UNIQUE KEY `jenis_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `priority_values`
--
ALTER TABLE `priority_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `priority_values_criteria_analysis_id_foreign` (`criteria_analysis_id`),
  ADD KEY `priority_values_criteria_id_foreign` (`criteria_id`);

--
-- Indexes for table `sarans`
--
ALTER TABLE `sarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sarans_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wisatas`
--
ALTER TABLE `wisatas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wisatas_jenis_id_foreign` (`jenis_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatives`
--
ALTER TABLE `alternatives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bobots`
--
ALTER TABLE `bobots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `criterias`
--
ALTER TABLE `criterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `criteria_analyses`
--
ALTER TABLE `criteria_analyses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `criteria_analysis_details`
--
ALTER TABLE `criteria_analysis_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `priority_values`
--
ALTER TABLE `priority_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `sarans`
--
ALTER TABLE `sarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wisatas`
--
ALTER TABLE `wisatas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alternatives`
--
ALTER TABLE `alternatives`
  ADD CONSTRAINT `alternatives_criteria_id_foreign` FOREIGN KEY (`criteria_id`) REFERENCES `criterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alternatives_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `alternatives_wisata_id_foreign` FOREIGN KEY (`wisata_id`) REFERENCES `wisatas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bobots`
--
ALTER TABLE `bobots`
  ADD CONSTRAINT `bobots_criteria_analysis_id_foreign` FOREIGN KEY (`criteria_analysis_id`) REFERENCES `criteria_analyses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bobots_criteria_id_foreign` FOREIGN KEY (`criteria_id`) REFERENCES `criterias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `criteria_analyses`
--
ALTER TABLE `criteria_analyses`
  ADD CONSTRAINT `criteria_analyses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `criteria_analysis_details`
--
ALTER TABLE `criteria_analysis_details`
  ADD CONSTRAINT `criteria_analysis_details_criteria_analysis_id_foreign` FOREIGN KEY (`criteria_analysis_id`) REFERENCES `criteria_analyses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `criteria_analysis_details_criteria_id_first_foreign` FOREIGN KEY (`criteria_id_first`) REFERENCES `criterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `criteria_analysis_details_criteria_id_second_foreign` FOREIGN KEY (`criteria_id_second`) REFERENCES `criterias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `priority_values`
--
ALTER TABLE `priority_values`
  ADD CONSTRAINT `priority_values_criteria_analysis_id_foreign` FOREIGN KEY (`criteria_analysis_id`) REFERENCES `criteria_analyses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `priority_values_criteria_id_foreign` FOREIGN KEY (`criteria_id`) REFERENCES `criterias` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sarans`
--
ALTER TABLE `sarans`
  ADD CONSTRAINT `sarans_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wisatas`
--
ALTER TABLE `wisatas`
  ADD CONSTRAINT `wisatas_jenis_id_foreign` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
