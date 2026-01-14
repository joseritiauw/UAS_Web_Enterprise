-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 14, 2026 at 02:22 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sleepypanda`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_12_102646_create_oauth_auth_codes_table', 1),
(5, '2026_01_12_102647_create_oauth_access_tokens_table', 1),
(6, '2026_01_12_102648_create_oauth_refresh_tokens_table', 1),
(7, '2026_01_12_102649_create_oauth_clients_table', 1),
(8, '2026_01_12_102650_create_oauth_device_codes_table', 1),
(9, '2026_01_14_000001_add_otp_columns_to_users_table', 2),
(10, '2026_01_14_135158_add_otp_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` char(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('1205dc67ac42a77a10d67cf14106820255702dcc56c16c07cf7277d4003d841e9a887cf062050102', 2, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:15:07', '2026-01-14 06:15:07', '2026-07-14 13:15:07'),
('1d90ba89fee8674755809d888196032a5fa703f9992a13edab8f204896b7a15bc62613016e6e38d7', 5, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 07:13:57', '2026-01-14 07:13:57', '2026-07-14 14:13:57'),
('2436a6f72e490926efd34a55e69ae6b7f4162e1823cbe07177f6b065139593989b87e8aa309e0136', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:39:07', '2026-01-14 06:39:07', '2026-07-14 13:39:07'),
('2e1deaacc1680a7b3d9cbfb67b0a6e7de32c0801748b621506e564f118ecba68d5d072937c441930', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 07:09:34', '2026-01-14 07:09:34', '2026-07-14 14:09:34'),
('3557f14e8a1dbcbeb492b9a40523f136ca67293dd62c4fbbd8b55c39e1fca50ef589cc60c123fc4c', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:42:39', '2026-01-14 06:42:39', '2026-07-14 13:42:39'),
('37e134102025984a46493747501ffe550d64f1077f43e1a5d2f616619d57d741c76e80f5248da2e1', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:59:57', '2026-01-14 06:59:57', '2026-07-14 13:59:57'),
('44956005f8f31722d06202d7e0044da03b92b7a298e5744d59313d1271138430c75d4f672cae329a', 3, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 07:09:52', '2026-01-14 07:09:52', '2026-07-14 14:09:52'),
('4608dfeea13551848107693a702876a430d937fa24254dda60a30dd498010a74f4c7793570ad2b7c', 5, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 07:14:43', '2026-01-14 07:14:43', '2026-07-14 14:14:43'),
('4b55800d4b154c4a9969368710a8486ca50294dcf16c4c618d8f388085ce0ff5ad0460ee44428fc6', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 04:37:18', '2026-01-14 04:37:18', '2026-07-14 11:37:18'),
('4f6a2fa88458b9430370c1320601a0657a55cb7dec44456f2dd65508beeb82ea1dc01e9195468ddd', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 07:11:44', '2026-01-14 07:11:44', '2026-07-14 14:11:44'),
('589d7d85638a19629b6aff2d4a54921c643f54c40e5e77cf705b03907d70e31b3bae07f2d4e4a5a1', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:56:14', '2026-01-14 06:56:14', '2026-07-14 13:56:14'),
('66c8529dc2e8672473c4e397f475c15a343c1f339ae0962bdc55d1d3ee7663522ae7b0114ff076d5', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:42:53', '2026-01-14 06:42:53', '2026-07-14 13:42:53'),
('6aad2e7ddfcf427d751d322307254e72a40815c846d4c4224108d1b6d79a5cc27d943e456858ee81', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:44:18', '2026-01-14 06:44:18', '2026-07-14 13:44:18'),
('70bbff6964e7ae160fe5a99343097599c8b4f31055e4ead016b16118bef9452f1bb72149ddb340ea', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:21:29', '2026-01-14 06:21:29', '2026-07-14 13:21:29'),
('749122bf8f8fae6f772699a879df067767defd00e0f9658e0c602858ca97a1761585fb8d82abb5e3', 5, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 07:15:11', '2026-01-14 07:15:11', '2026-07-14 14:15:11'),
('7dc83787d662847e061d0e41526faace1eb67a6b2624f78ef9e2283bf6091c437ab70100be1e7fbd', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:33:22', '2026-01-14 06:33:22', '2026-07-14 13:33:21'),
('c34bf7a354eabdf5e50771c4bbc2f8c8bc22721e37f02c143f0fce38c11cea5ad4b0068fe4d9713e', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:21:00', '2026-01-14 06:21:00', '2026-07-14 13:21:00'),
('cf983209351fb624eaceab378e7907285450437f4e588fd1079328c0456c548a586b6a504ed88cd7', 2, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:47:26', '2026-01-14 06:47:26', '2026-07-14 13:47:26'),
('d317dcc7b1972e21df7deadfdc3430f809083cab4068c93565c08f50dee9c0072455d2b7e483cb6f', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:18:33', '2026-01-14 06:18:33', '2026-07-14 13:18:33'),
('db5f9f2e3ea9f89d9e6311208b8a27254002afb33cc5b5fe849813d9e7b056de0dfab32a0e601535', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:19:36', '2026-01-14 06:19:36', '2026-07-14 13:19:36'),
('e01adbe13d84923899b5be339689ad248c108fe7e6d8faea08626b3474d9fd508af2f2aec45087f6', 4, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:48:23', '2026-01-14 06:48:23', '2026-07-14 13:48:23'),
('e0f344a8041bc406ffb933b738be7754d6f58edb50cb558483127b652b9f94018ea3dad2e1cf6fc2', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:18:49', '2026-01-14 06:18:49', '2026-07-14 13:18:49'),
('e6aaa2fcec7d245393a96f9c34ee6f6b5625fc7776088586956dbd724e73b2750feefd6954a93271', 3, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:46:58', '2026-01-14 06:46:58', '2026-07-14 13:46:58'),
('e8d5d6cfc834683071d9dc973f9faf7d9a4cfe1f1f754b9935a0442a11599d7a5a7637718dc8b0ba', 3, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:46:02', '2026-01-14 06:46:02', '2026-07-14 13:46:02'),
('ea2e7a0bdb10ba53342ed51fb6a2b2731d7e4ed8e47705f481c81ce381d460429f9dac3680441e0c', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:47:09', '2026-01-14 06:47:09', '2026-07-14 13:47:09'),
('ec15b9d8b0e7040c7a2e2e9a2eabed950231e72672a5f910d88d35e2eeeac999abec7cbc79f66ab3', 2, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:12:02', '2026-01-14 06:12:02', '2026-07-14 13:12:02'),
('f1be63ba649cfaaedfc70d9667387a692d36eb062f6f7eed91b272981e0f940cc22a2140c29b8f60', 2, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:44:34', '2026-01-14 06:44:34', '2026-07-14 13:44:34'),
('f3834f7cf8271da15bb440b48c3b49708c4d6746d7afb2529067a6d2deaf1e4ec93449cf1ca9a1f3', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 04:35:22', '2026-01-14 04:35:22', '2026-07-14 11:35:22'),
('fa8bc3f36c75041696a991754e71168a55a108e6236fc374b8a36f0318224e43666c763cfd73ce47', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 04:33:03', '2026-01-14 04:33:03', '2026-07-14 11:33:03'),
('fc13f18baccce74dcaa34b6fea7c09ebf44dfb3997ecc43e827397de582f75c84f35024d7f1b8600', 1, '019bbc47-5148-71a7-ac11-7a356c9533c1', 'access_token', '[]', 0, '2026-01-14 06:14:50', '2026-01-14 06:14:50', '2026-07-14 13:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` char(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect_uris` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `grant_types` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `owner_type`, `owner_id`, `name`, `secret`, `provider`, `redirect_uris`, `grant_types`, `revoked`, `created_at`, `updated_at`) VALUES
('019bbc47-5148-71a7-ac11-7a356c9533c1', NULL, NULL, 'Personal Access Client', '$2y$12$OkdvOR5sRFAZxop9te2dOetVc0EuKH6/tfOWAxkqA5q4U3cfuOXQC', 'users', '[]', '[\"personal_access\"]', 0, '2026-01-14 04:32:29', '2026-01-14 04:32:29');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_device_codes`
--

CREATE TABLE `oauth_device_codes` (
  `id` char(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_code` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `user_approved_at` datetime DEFAULT NULL,
  `last_polled_at` datetime DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` char(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` char(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `hashed_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reset_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `otp` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_expires_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `hashed_password`, `created_at`, `updated_at`, `reset_token`, `otp`, `otp_expires_at`) VALUES
(1, 'jose@gmail.com', '$2y$12$WM1KjzRFfEZ7uMAQpPqKBeT1ms4on1BRMswP07OCL0H/4n/3jML2m', '2026-01-14 04:32:52', '2026-01-14 06:58:06', 'zBS7ZZwRYc57QpazrL6iVDRR2M5MqeloOAkclday5foIjq9kpcNNtb9a1Pnn', '426832', '2026-01-14 07:13:06'),
(2, 'liandy@gmail.com', '$2y$12$YGFcUso2d5bP4QIBdXmwiupZl9d/7Ymu5DEGUa3yRhDA6WaYQ4LsW', '2026-01-14 06:11:50', '2026-01-14 07:10:22', 'vNa3W2KZ5gOgMpo56TDCJdfi6K30BrDaWfG4N61gbrSVELmzFXdKmCO2XrL5', '774675', '2026-01-14 07:25:22'),
(3, 'banu10@gmail.com', '$2y$12$7HTQvyjH6reIEUV.qT9vCO62TnZs4wy5BtmwWgg294CjWaCgl8l2W', '2026-01-14 06:45:53', '2026-01-14 07:04:07', 'lzC7tmx2NDLc2tNRe44hThWfSN0qfpeOdicG4TFH0ZtWNRvSb5HCzfWmDf03', '293915', '2026-01-14 07:19:07'),
(4, 'asep@gmail.com', '$2y$12$rvMjRy2D9FsaSzTZvdHI1u38LITIuTKgBliYaBrvIrmqZVjZPzdXS', '2026-01-14 06:48:14', '2026-01-14 06:48:14', NULL, NULL, NULL),
(5, 'messi@gmail.com', '$2y$12$ed.w/Ls9zaHa1LcXx2faI.3KA41WmSyj1FvpQBguo7oC3wP7hVeEK', '2026-01-14 07:13:43', '2026-01-14 07:13:43', NULL, NULL, NULL);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_owner_type_owner_id_index` (`owner_type`,`owner_id`);

--
-- Indexes for table `oauth_device_codes`
--
ALTER TABLE `oauth_device_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `oauth_device_codes_user_code_unique` (`user_code`),
  ADD KEY `oauth_device_codes_user_id_index` (`user_id`),
  ADD KEY `oauth_device_codes_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
