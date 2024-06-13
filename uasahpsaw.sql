-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Bulan Mei 2024 pada 12.26
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uasahpsaw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatives`
--

CREATE TABLE `alternatives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `criteria_id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `alternative_value` decimal(10,1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alternatives`
--

INSERT INTO `alternatives` (`id`, `criteria_id`, `siswa_id`, `kelas_id`, `alternative_value`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, 1.0, '2024-04-29 10:48:39', '2024-05-26 09:49:55'),
(2, 2, 2, 3, 2.0, '2024-04-29 10:48:39', '2024-05-26 09:49:55'),
(3, 3, 2, 3, 1.0, '2024-04-29 10:48:39', '2024-05-26 09:49:55'),
(4, 4, 2, 3, 2.0, '2024-04-29 10:48:39', '2024-05-26 09:49:55'),
(5, 5, 2, 3, 4.0, '2024-04-29 10:48:39', '2024-05-26 09:49:55'),
(6, 1, 1, 1, 2.0, '2024-04-29 10:49:00', '2024-04-29 10:49:00'),
(7, 2, 1, 1, 2.0, '2024-04-29 10:49:00', '2024-04-29 10:49:00'),
(8, 3, 1, 1, 3.0, '2024-04-29 10:49:00', '2024-04-29 10:49:00'),
(9, 4, 1, 1, 3.0, '2024-04-29 10:49:00', '2024-04-29 10:49:00'),
(10, 5, 1, 1, 4.0, '2024-04-29 10:49:00', '2024-04-29 10:49:00'),
(16, 1, 3, 3, 3.0, '2024-05-23 11:57:42', '2024-05-26 09:50:03'),
(17, 2, 3, 3, 2.0, '2024-05-23 11:57:42', '2024-05-26 09:50:03'),
(18, 3, 3, 3, 4.0, '2024-05-23 11:57:42', '2024-05-26 09:50:03'),
(19, 4, 3, 3, 4.0, '2024-05-23 11:57:42', '2024-05-26 09:50:03'),
(20, 5, 3, 3, 2.0, '2024-05-23 11:57:42', '2024-05-26 09:50:03'),
(21, 6, 2, 1, 4.0, '2024-05-26 09:49:47', '2024-05-26 09:49:55'),
(22, 6, 3, 2, 2.0, '2024-05-26 09:50:03', '2024-05-26 09:50:03'),
(23, 1, 4, 3, 3.0, '2024-05-26 09:51:09', '2024-05-26 09:51:09'),
(24, 2, 4, 3, 4.0, '2024-05-26 09:51:09', '2024-05-26 09:51:09'),
(25, 3, 4, 3, 4.0, '2024-05-26 09:51:09', '2024-05-26 09:51:09'),
(26, 4, 4, 3, 1.0, '2024-05-26 09:51:09', '2024-05-26 09:51:09'),
(27, 5, 4, 3, 2.0, '2024-05-26 09:51:09', '2024-05-26 09:51:09'),
(28, 6, 4, 3, 2.0, '2024-05-26 09:51:09', '2024-05-26 09:51:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bobots`
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
-- Dumping data untuk tabel `bobots`
--

INSERT INTO `bobots` (`id`, `criteria_analysis_id`, `criteria_id`, `value`, `created_at`, `updated_at`) VALUES
(6, 2, 1, 0.300000000, '2024-04-30 01:44:38', '2024-04-30 02:36:33'),
(7, 2, 3, 0.300000000, '2024-04-30 01:44:38', '2024-04-30 02:36:33'),
(8, 2, 5, 0.400000000, '2024-04-30 01:44:38', '2024-04-30 02:36:34'),
(9, 3, 1, 0.100000000, '2024-04-30 01:57:58', '2024-04-30 02:37:20'),
(10, 3, 2, 0.200000000, '2024-04-30 01:57:58', '2024-04-30 02:37:20'),
(11, 3, 3, 0.100000000, '2024-04-30 01:57:58', '2024-04-30 02:37:20'),
(12, 3, 4, 0.100000000, '2024-04-30 01:57:58', '2024-04-30 02:37:20'),
(13, 3, 5, 0.100000000, '2024-04-30 01:57:58', '2024-04-30 02:37:20'),
(14, 4, 1, 0.000000000, '2024-04-30 02:33:40', '2024-05-23 11:37:24'),
(15, 4, 3, 0.000000000, '2024-04-30 02:33:40', '2024-05-23 11:37:24'),
(16, 4, 5, 0.000000000, '2024-04-30 02:33:40', '2024-05-23 11:37:24'),
(17, 5, 1, 0.000000000, '2024-05-23 11:38:44', '2024-05-23 11:38:48'),
(18, 5, 2, 0.000000000, '2024-05-23 11:38:44', '2024-05-23 11:38:48'),
(19, 5, 4, 0.000000000, '2024-05-23 11:38:44', '2024-05-23 11:38:48'),
(20, 6, 1, 0.000000000, '2024-05-26 09:45:52', '2024-05-26 09:45:52'),
(21, 6, 2, 0.000000000, '2024-05-26 09:45:52', '2024-05-26 09:45:52'),
(22, 6, 3, 0.000000000, '2024-05-26 09:45:52', '2024-05-26 09:45:52'),
(23, 7, 1, 0.000000000, '2024-05-26 09:47:14', '2024-05-26 09:48:20'),
(24, 7, 2, 0.000000000, '2024-05-26 09:47:14', '2024-05-26 09:48:20'),
(25, 7, 3, 0.000000000, '2024-05-26 09:47:14', '2024-05-26 09:48:20'),
(26, 7, 4, 0.000000000, '2024-05-26 09:47:14', '2024-05-26 09:48:20'),
(27, 7, 5, 0.000000000, '2024-05-26 09:47:14', '2024-05-26 09:48:20'),
(28, 7, 6, 0.000000000, '2024-05-26 09:47:14', '2024-05-26 09:48:20'),
(29, 8, 1, 0.000000000, '2024-05-26 09:54:40', '2024-05-26 09:54:40'),
(30, 8, 3, 0.000000000, '2024-05-26 09:54:40', '2024-05-26 09:54:40'),
(31, 8, 4, 0.000000000, '2024-05-26 09:54:40', '2024-05-26 09:54:40'),
(32, 8, 6, 0.000000000, '2024-05-26 09:54:40', '2024-05-26 09:54:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `criterias`
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
  `skala6` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `criterias`
--

INSERT INTO `criterias` (`id`, `nama_kriteria`, `slug`, `kategori`, `skala1`, `skala2`, `skala3`, `skala4`, `skala5`, `skala6`, `created_at`, `updated_at`) VALUES
(1, 'Lomba', 'lomba', 'BENEFIT', 'Tidak Pernah Juara Lomba', 'Juara dari 1 Lomba', 'Juara dari 2 dan 3 Lomba', 'Juara >5 Lomba', 'Juara <= 8 Lomba', 'Juara >10 Lomba', '2024-05-26 01:44:16', '2024-05-26 01:44:16'),
(2, 'Kehadiran', 'kehadiran', 'BENEFIT', 'Tidak Hadir > 10', 'Tidak Hadir >= 6', 'Tidak Hadir 4 atau 5 kali', 'Tidak Hadir 2 atau 3 kali', 'Tidak Hadir  1 kali', 'Tidak Pernah Izin/Alfa/Sakit', '2024-05-26 01:47:03', '2024-05-26 01:47:03'),
(3, 'Kedisiplinan', 'kedisiplinan', 'BENEFIT', 'Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik', 'Sangat Baik Sekali', '2024-05-26 01:48:23', '2024-05-26 01:48:23'),
(4, 'Nilai Rapot', 'nilai-rapot', 'BENEFIT', 'Nilai dibawah 40', 'Nilai 50 - 59', 'Nilai 60-69', 'Nilai 70 -79', 'Nilai 80-89', 'nilai 90-100', '2024-05-26 01:49:36', '2024-05-26 01:49:36'),
(5, 'Point Pelanggaran', 'point_pelanggaran', 'Cost', 'Tidak ada pelanggaran', 'Tidak Hadir  1 kali', 'Pelanggaran 2 kali', 'pelanggaran 3 kali', 'Pelanggaran > 5', ' Pelanggaran > 10', '2024-05-26 01:47:03', '2024-05-26 01:47:03'),
(6, 'Ekstrakulikuler', 'ekstrakulikuler', 'BENEFIT', 'Tidak Mengikuti EK', 'Mengikuti 1 EK', 'Mengikuti 2 atau 3 EK', 'Mengikuti 4', 'Mengikuti 5 atau 6 EK', 'Mengikuti lebih dati 6 EK', '2024-05-26 01:43:10', '2024-05-26 01:43:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `criteria_analyses`
--

CREATE TABLE `criteria_analyses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `criteria_analyses`
--

INSERT INTO `criteria_analyses` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 1, '2024-05-26 09:45:46', '2024-05-26 09:45:46'),
(8, 1, '2024-05-26 09:54:29', '2024-05-26 09:54:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `criteria_analysis_details`
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
-- Dumping data untuk tabel `criteria_analysis_details`
--

INSERT INTO `criteria_analysis_details` (`id`, `criteria_analysis_id`, `criteria_id_first`, `criteria_id_second`, `comparison_value`, `comparison_result`, `created_at`, `updated_at`) VALUES
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
(60, 4, 1, 1, 1.000000000, 1.000000000, '2024-04-30 02:33:33', '2024-05-23 11:37:24'),
(61, 4, 1, 3, 2.000000000, 2.000000000, '2024-04-30 02:33:33', '2024-05-23 11:37:24'),
(62, 4, 1, 5, 8.000000000, 8.000000000, '2024-04-30 02:33:33', '2024-05-23 11:37:24'),
(63, 4, 3, 1, 2.000000000, 0.500000000, '2024-04-30 02:33:33', '2024-05-23 11:37:24'),
(64, 4, 3, 3, 1.000000000, 1.000000000, '2024-04-30 02:33:33', '2024-05-23 11:37:24'),
(65, 4, 3, 5, 5.000000000, 5.000000000, '2024-04-30 02:33:33', '2024-05-23 11:37:24'),
(66, 4, 5, 1, 8.000000000, 0.125000000, '2024-04-30 02:33:33', '2024-05-23 11:37:24'),
(67, 4, 5, 3, 5.000000000, 0.200000000, '2024-04-30 02:33:33', '2024-05-23 11:37:24'),
(68, 4, 5, 5, 1.000000000, 1.000000000, '2024-04-30 02:33:33', '2024-05-23 11:37:24'),
(69, 5, 1, 1, 1.000000000, 1.000000000, '2024-05-23 11:38:15', '2024-05-23 11:38:48'),
(70, 5, 1, 2, 1.000000000, 1.000000000, '2024-05-23 11:38:15', '2024-05-23 11:38:48'),
(71, 5, 1, 4, 1.000000000, 1.000000000, '2024-05-23 11:38:15', '2024-05-23 11:38:48'),
(72, 5, 2, 1, 1.000000000, 1.000000000, '2024-05-23 11:38:15', '2024-05-23 11:38:48'),
(73, 5, 2, 2, 1.000000000, 1.000000000, '2024-05-23 11:38:15', '2024-05-23 11:38:48'),
(74, 5, 2, 4, 1.000000000, 1.000000000, '2024-05-23 11:38:15', '2024-05-23 11:38:48'),
(75, 5, 4, 1, 1.000000000, 1.000000000, '2024-05-23 11:38:15', '2024-05-23 11:38:48'),
(76, 5, 4, 2, 1.000000000, 1.000000000, '2024-05-23 11:38:15', '2024-05-23 11:38:48'),
(77, 5, 4, 4, 1.000000000, 1.000000000, '2024-05-23 11:38:15', '2024-05-23 11:38:48'),
(78, 6, 1, 1, 1.000000000, 1.000000000, '2024-05-26 09:45:46', '2024-05-26 09:45:52'),
(79, 6, 1, 2, 7.000000000, 7.000000000, '2024-05-26 09:45:46', '2024-05-26 09:45:52'),
(80, 6, 1, 3, 4.000000000, 4.000000000, '2024-05-26 09:45:46', '2024-05-26 09:45:52'),
(81, 6, 2, 1, 7.000000000, 0.142857143, '2024-05-26 09:45:46', '2024-05-26 09:45:52'),
(82, 6, 2, 2, 1.000000000, 1.000000000, '2024-05-26 09:45:46', '2024-05-26 09:45:52'),
(83, 6, 2, 3, 3.000000000, 3.000000000, '2024-05-26 09:45:46', '2024-05-26 09:45:52'),
(84, 6, 3, 1, 4.000000000, 0.250000000, '2024-05-26 09:45:46', '2024-05-26 09:45:52'),
(85, 6, 3, 2, 3.000000000, 0.333333333, '2024-05-26 09:45:46', '2024-05-26 09:45:52'),
(86, 6, 3, 3, 1.000000000, 1.000000000, '2024-05-26 09:45:46', '2024-05-26 09:45:52'),
(87, 7, 1, 1, 1.000000000, 1.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(88, 7, 1, 2, 4.000000000, 4.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(89, 7, 1, 3, 3.000000000, 3.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(90, 7, 1, 4, 2.000000000, 2.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(91, 7, 1, 5, 1.000000000, 1.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(92, 7, 1, 6, 3.000000000, 3.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(93, 7, 2, 1, 4.000000000, 0.250000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(94, 7, 2, 2, 1.000000000, 1.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(95, 7, 2, 3, 2.000000000, 2.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(96, 7, 2, 4, 2.000000000, 2.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(97, 7, 2, 5, 3.000000000, 3.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(98, 7, 2, 6, 4.000000000, 4.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(99, 7, 3, 1, 3.000000000, 0.333333333, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(100, 7, 3, 2, 2.000000000, 0.500000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(101, 7, 3, 3, 1.000000000, 1.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(102, 7, 3, 4, 4.000000000, 4.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(103, 7, 3, 5, 3.000000000, 3.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(104, 7, 3, 6, 4.000000000, 4.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(105, 7, 4, 1, 2.000000000, 0.500000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(106, 7, 4, 2, 2.000000000, 0.500000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(107, 7, 4, 3, 4.000000000, 0.250000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(108, 7, 4, 4, 1.000000000, 1.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(109, 7, 4, 5, 4.000000000, 4.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(110, 7, 4, 6, 1.000000000, 1.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(111, 7, 5, 1, 1.000000000, 1.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(112, 7, 5, 2, 3.000000000, 0.333333333, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(113, 7, 5, 3, 3.000000000, 0.333333333, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(114, 7, 5, 4, 4.000000000, 0.250000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(115, 7, 5, 5, 1.000000000, 1.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(116, 7, 5, 6, 5.000000000, 5.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(117, 7, 6, 1, 3.000000000, 0.333333333, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(118, 7, 6, 2, 4.000000000, 0.250000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(119, 7, 6, 3, 4.000000000, 0.250000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(120, 7, 6, 4, 1.000000000, 1.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(121, 7, 6, 5, 5.000000000, 0.200000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(122, 7, 6, 6, 1.000000000, 1.000000000, '2024-05-26 09:46:53', '2024-05-26 09:48:20'),
(123, 8, 1, 1, 1.000000000, 1.000000000, '2024-05-26 09:54:29', '2024-05-26 09:54:40'),
(124, 8, 1, 3, 6.000000000, 6.000000000, '2024-05-26 09:54:29', '2024-05-26 09:54:39'),
(125, 8, 1, 4, 4.000000000, 4.000000000, '2024-05-26 09:54:29', '2024-05-26 09:54:40'),
(126, 8, 1, 6, 4.000000000, 4.000000000, '2024-05-26 09:54:29', '2024-05-26 09:54:40'),
(127, 8, 3, 1, 6.000000000, 0.166666667, '2024-05-26 09:54:29', '2024-05-26 09:54:40'),
(128, 8, 3, 3, 1.000000000, 1.000000000, '2024-05-26 09:54:29', '2024-05-26 09:54:40'),
(129, 8, 3, 4, 8.000000000, 8.000000000, '2024-05-26 09:54:29', '2024-05-26 09:54:40'),
(130, 8, 3, 6, 3.000000000, 3.000000000, '2024-05-26 09:54:29', '2024-05-26 09:54:40'),
(131, 8, 4, 1, 4.000000000, 0.250000000, '2024-05-26 09:54:30', '2024-05-26 09:54:40'),
(132, 8, 4, 3, 8.000000000, 0.125000000, '2024-05-26 09:54:30', '2024-05-26 09:54:40'),
(133, 8, 4, 4, 1.000000000, 1.000000000, '2024-05-26 09:54:30', '2024-05-26 09:54:40'),
(134, 8, 4, 6, 6.000000000, 6.000000000, '2024-05-26 09:54:30', '2024-05-26 09:54:40'),
(135, 8, 6, 1, 4.000000000, 0.250000000, '2024-05-26 09:54:30', '2024-05-26 09:54:40'),
(136, 8, 6, 3, 3.000000000, 0.333333333, '2024-05-26 09:54:30', '2024-05-26 09:54:40'),
(137, 8, 6, 4, 6.000000000, 0.166666667, '2024-05-26 09:54:30', '2024-05-26 09:54:40'),
(138, 8, 6, 6, 1.000000000, 1.000000000, '2024-05-26 09:54:30', '2024-05-26 09:54:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `keterangan` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `kelas_name`, `slug`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'A', 'A', '', '2024-04-29 10:42:13', '2024-04-29 10:42:13'),
(2, 'B', 'B', '', '2024-04-29 10:42:31', '2024-04-29 10:42:31'),
(3, 'C', 'C', '', '2024-04-29 10:45:52', '2024-04-29 10:45:52'),
(4, 'D', 'D', '', '2024-04-29 10:42:13', '2024-04-29 10:42:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_27_121522_create_criterias_table', 1),
(6, '2024_01_27_121702_create_kelas_table', 1),
(7, '2024_01_27_121944_create_siswa_table', 1),
(8, '2024_01_27_122211_create_alternatives_table', 1),
(9, '2024_01_27_122421_create_criteria_analyses_table', 1),
(10, '2024_01_27_122610_create_criteria_analysis_details_table', 1),
(11, '2024_01_27_122813_create_priority_values_table', 1),
(12, '2024_02_14_111054_create_bobots_table', 1),
(13, '2024_03_25_170546_create_saran_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
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
-- Struktur dari tabel `priority_values`
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
-- Dumping data untuk tabel `priority_values`
--

INSERT INTO `priority_values` (`id`, `criteria_analysis_id`, `criteria_id`, `value`, `created_at`, `updated_at`) VALUES
(6, 2, 1, 0.421273490, '2024-04-30 01:44:38', '2024-04-30 01:44:38'),
(7, 2, 3, 0.387338076, '2024-04-30 01:44:38', '2024-04-30 01:44:38'),
(8, 2, 5, 0.191388432, '2024-04-30 01:44:38', '2024-04-30 01:44:38'),
(9, 3, 1, 0.290373329, '2024-04-30 01:57:58', '2024-04-30 01:57:58'),
(10, 3, 2, 0.261125899, '2024-04-30 01:57:58', '2024-04-30 01:57:58'),
(11, 3, 3, 0.205379501, '2024-04-30 01:57:58', '2024-04-30 01:57:58'),
(12, 3, 4, 0.108205538, '2024-04-30 01:57:58', '2024-04-30 01:57:58'),
(13, 3, 5, 0.134915730, '2024-04-30 01:57:58', '2024-04-30 01:57:58'),
(14, 4, 1, 0.603937729, '2024-04-30 02:33:40', '2024-05-23 11:37:24'),
(15, 4, 3, 0.325778388, '2024-04-30 02:33:40', '2024-04-30 02:33:40'),
(16, 4, 5, 0.070283882, '2024-04-30 02:33:40', '2024-05-23 11:37:24'),
(17, 5, 1, 0.333333333, '2024-05-23 11:38:44', '2024-05-23 11:38:44'),
(18, 5, 2, 0.333333333, '2024-05-23 11:38:44', '2024-05-23 11:38:44'),
(19, 5, 4, 0.333333333, '2024-05-23 11:38:44', '2024-05-23 11:38:44'),
(20, 6, 1, 0.685982906, '2024-05-26 09:45:52', '2024-05-26 09:45:52'),
(21, 6, 2, 0.199188034, '2024-05-26 09:45:52', '2024-05-26 09:45:52'),
(22, 6, 3, 0.114829059, '2024-05-26 09:45:52', '2024-05-26 09:45:52'),
(23, 7, 1, 0.297176347, '2024-05-26 09:47:14', '2024-05-26 09:48:20'),
(24, 7, 2, 0.196833034, '2024-05-26 09:47:14', '2024-05-26 09:48:20'),
(25, 7, 3, 0.196369928, '2024-05-26 09:47:14', '2024-05-26 09:48:20'),
(26, 7, 4, 0.123310263, '2024-05-26 09:47:14', '2024-05-26 09:48:20'),
(27, 7, 5, 0.129371926, '2024-05-26 09:47:14', '2024-05-26 09:48:20'),
(28, 7, 6, 0.056938499, '2024-05-26 09:47:14', '2024-05-26 09:48:20'),
(29, 8, 1, 0.498495256, '2024-05-26 09:54:40', '2024-05-26 09:54:40'),
(30, 8, 3, 0.263989716, '2024-05-26 09:54:40', '2024-05-26 09:54:40'),
(31, 8, 4, 0.167820143, '2024-05-26 09:54:40', '2024-05-26 09:54:40'),
(32, 8, 6, 0.069694884, '2024-05-26 09:54:40', '2024-05-26 09:54:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sarans`
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
-- Struktur dari tabel `siswas`
--

CREATE TABLE `siswas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nis` varchar(255) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `kelas_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `agama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `validasi` varchar(100) NOT NULL,
  `user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `siswas`
--

INSERT INTO `siswas` (`id`, `nis`, `nama_siswa`, `kelas_id`, `jenis_kelamin`, `agama`, `alamat`, `created_at`, `updated_at`, `validasi`, `user_id`) VALUES
(1, '0001', 'Tiara', 4, 'Perempuan', 'Islam', 'Banjaratma', '2024-05-26 01:52:46', '2024-05-26 01:52:46', '2', 1),
(2, '0002', 'Nanda', 1, 'laki-Laki', 'Islam', 'Banjaratma', '2024-05-26 01:52:46', '2024-05-26 01:52:46', '2', 1),
(3, '0003', 'Salman', 2, 'laki-Laki', 'Islam', 'Banjaratma', '2024-05-26 01:52:46', '2024-05-26 01:52:46', '2', 1),
(4, '0004', 'Dewirahma', 3, 'Perempuan', 'Islam', 'Banjaratma', '2024-05-26 01:52:46', '2024-05-26 01:52:46', '2', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin1', 'admin@gmail.com', NULL, '$2b$12$VAE.0hOCOyfR7ajIzpqdV.gTozWc3ePuQg4.NobpWAAWhIQtlMFR.', 'ADMIN', NULL, '2024-04-29 05:06:54', '2024-04-29 05:06:54'),
(3, 'asep', 'asep1234', 'asepsyaputra840@gmail.com', NULL, '$2y$10$oLtd/Hc1VXU28iR8LxbwJe1sNaCcdETk3dfsuLLzchW6sroSJWlzu', 'USER', NULL, '2024-04-30 01:46:34', '2024-04-30 01:46:34'),
(4, 'Rizki Eka Mulyani', 'rizki', 'rizkiekamulyani123@gmail.com', NULL, '$2y$10$EF0SxBcuyo/wF3WaISzXwudX3QTweb6m1BchqnpAngUSpgBA11O9i', 'USER', NULL, '2024-05-23 12:53:31', '2024-05-23 12:53:31'),
(5, 'Rayyan', 'rayyan', 'rayyan@gmail.com', NULL, '$2y$10$aE6h8kjV3MXRkISJr8O2EusEvxi2IzC6uLCmpRYPKHJ65iVjBW49u', 'USER', NULL, '2024-05-23 12:54:16', '2024-05-23 12:54:16');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatives`
--
ALTER TABLE `alternatives`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alternatives_criteria_id_foreign` (`criteria_id`),
  ADD KEY `alternatives_siswa_id_foreign` (`siswa_id`),
  ADD KEY `alternatives_kelas_id_foreign` (`kelas_id`);

--
-- Indeks untuk tabel `bobots`
--
ALTER TABLE `bobots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bobots_criteria_analysis_id_foreign` (`criteria_analysis_id`),
  ADD KEY `bobots_criteria_id_foreign` (`criteria_id`);

--
-- Indeks untuk tabel `criterias`
--
ALTER TABLE `criterias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `criterias_nama_kriteria_unique` (`nama_kriteria`),
  ADD UNIQUE KEY `criterias_slug_unique` (`slug`);

--
-- Indeks untuk tabel `criteria_analyses`
--
ALTER TABLE `criteria_analyses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criteria_analyses_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `criteria_analysis_details`
--
ALTER TABLE `criteria_analysis_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `criteria_analysis_details_criteria_analysis_id_foreign` (`criteria_analysis_id`),
  ADD KEY `criteria_analysis_details_criteria_id_first_foreign` (`criteria_id_first`),
  ADD KEY `criteria_analysis_details_criteria_id_second_foreign` (`criteria_id_second`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kelas_kelas_name_unique` (`kelas_name`),
  ADD UNIQUE KEY `kelas_slug_unique` (`slug`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `priority_values`
--
ALTER TABLE `priority_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `priority_values_criteria_analysis_id_foreign` (`criteria_analysis_id`),
  ADD KEY `priority_values_criteria_id_foreign` (`criteria_id`);

--
-- Indeks untuk tabel `sarans`
--
ALTER TABLE `sarans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sarans_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `siswas`
--
ALTER TABLE `siswas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswas_kelas_id_foreign` (`kelas_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alternatives`
--
ALTER TABLE `alternatives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `bobots`
--
ALTER TABLE `bobots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `criterias`
--
ALTER TABLE `criterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `criteria_analyses`
--
ALTER TABLE `criteria_analyses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `criteria_analysis_details`
--
ALTER TABLE `criteria_analysis_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `priority_values`
--
ALTER TABLE `priority_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `sarans`
--
ALTER TABLE `sarans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `siswas`
--
ALTER TABLE `siswas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
