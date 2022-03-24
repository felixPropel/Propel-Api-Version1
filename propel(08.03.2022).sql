-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 08, 2022 at 07:39 PM
-- Server version: 5.7.33-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `propel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(11, '2022_01_20_080123_create_admins_table', 1),
(12, '2022_01_24_091440_create_temp_users_table', 1),
(13, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(14, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(15, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(16, '2016_06_01_000004_create_oauth_clients_table', 2),
(17, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `m_blood_groups`
--

CREATE TABLE `m_blood_groups` (
  `id` int(11) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_blood_groups`
--

INSERT INTO `m_blood_groups` (`id`, `blood_group`, `created_at`, `updated_at`) VALUES
(1, 'B+ve', '2022-02-10 13:55:32', '2022-02-10 13:55:32'),
(2, 'A+ve', '2022-02-10 13:55:37', '2022-02-10 13:55:37'),
(3, 'B-ve', '2022-02-10 13:55:42', '2022-02-10 13:55:42'),
(4, 'AB-ve', '2022-02-10 13:55:48', '2022-02-10 13:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `m_gender`
--

CREATE TABLE `m_gender` (
  `id` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_gender`
--

INSERT INTO `m_gender` (`id`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'Male', '2022-02-10 13:53:12', '2022-02-10 13:53:12'),
(2, 'Female', '2022-02-10 13:53:26', '2022-02-10 13:53:26'),
(3, 'Not to specify', '2022-02-10 13:53:50', '2022-02-10 13:53:50');

-- --------------------------------------------------------

--
-- Table structure for table `m_salutations`
--

CREATE TABLE `m_salutations` (
  `id` int(11) NOT NULL,
  `saluation` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_salutations`
--

INSERT INTO `m_salutations` (`id`, `saluation`, `created_at`, `updated_at`) VALUES
(1, 'Mr.', '2022-02-10 13:41:35', '0000-00-00 00:00:00'),
(2, 'Ms.', '2022-02-10 13:41:57', '2022-02-10 13:41:57');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
('07ab60955f0c5a245d28d15a7a63dbdfa89eed6d6ab85e0f8b9077a185de7069b7ca803604aa4495', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:42:24', '2022-03-08 07:42:24', '2023-03-08 13:12:24'),
('0e6cd26e7c3d03f18c22984a3afbf128b37a4bbade68b62e400bd3f76e81ef85b21b3aa58bd9caa2', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:10:17', '2022-03-08 08:10:17', '2023-03-08 13:40:17'),
('13aeef98c26ae1e7a451cc2d67639cd80b2e2dd2bc8c71ef6b0170127ee404fd40dbe620f2739da3', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:19:07', '2022-03-08 08:19:07', '2023-03-08 13:49:07'),
('1e6ffa5a0c860ad3fc9a9773c2e255aca6e08b25dffa1a37292b9cf77511907b935a262a423bfe51', 10, 1, 'Laravel Password Grant Client', '[]', 1, '2022-03-08 08:35:01', '2022-03-08 08:35:01', '2023-03-08 14:05:01'),
('269809078c87d295e8e6daae785ad946f0628cf6486ccd0c30c3ccbe0ba10b9dead4a2af3e8d9f3e', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:20:03', '2022-03-08 08:20:03', '2023-03-08 13:50:03'),
('27f1a1a5f97ba940c73d5fc4a42cbb91f477b37757713bc786b658c1d700a349848f09fa0012824c', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:20:20', '2022-03-08 07:20:20', '2023-03-08 12:50:20'),
('383d196f98e0899927aa6cfe3bbc6b221adc0a75d309e3f5d5374cd3a9e026bb5ddbdfb3163c8e9c', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:42:30', '2022-03-08 07:42:30', '2023-03-08 13:12:30'),
('3b98e06e4e2a5a158f102a71c722e76c97b4e53de85d815c801a24dabb774e90dade92226d1a773a', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:20:02', '2022-03-08 08:20:02', '2023-03-08 13:50:02'),
('5dbe4152d70141cadd09f7d607cfc28b0709726f15be48d86b2bd2ecd60d18ff16e452469461f2b8', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:36:16', '2022-03-08 08:36:16', '2023-03-08 14:06:16'),
('689c8409467e322188dce83b69f343ec0957a3236d79acf381580ec99f6bb0926283b1861a16fd29', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:32:24', '2022-03-08 08:32:24', '2023-03-08 14:02:24'),
('76242b7e282b5a6f8ef973f0f8e1be44d6b3bd3f26195455061e444e1d37f5f7397185ee28ad18f3', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:08:44', '2022-03-08 08:08:44', '2023-03-08 13:38:44'),
('857cdb2f9e86d0dc35519dea8d16902e51397a04b369e93d06a8c15c57573eb80a76fbd62e8b93a2', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:57:50', '2022-03-08 07:57:50', '2023-03-08 13:27:50'),
('a5adcc263ecf741d322c58e36a7e8b40f7493654605632f828f4520a0d6dbc14a8fd870df5af3a8b', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:21:17', '2022-03-08 08:21:17', '2023-03-08 13:51:17'),
('c0ff9ea369a02916fd90b6afbd4540e52feee899bf0655d9d868513f914ecb5e01e1da2da24062a9', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:20:25', '2022-03-08 07:20:25', '2023-03-08 12:50:25'),
('d55a43ea651b82aa06b886d2f9704d981eaf66db9a5a508293b86e755bfaa5d221b111e38c810660', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:20:11', '2022-03-08 07:20:11', '2023-03-08 12:50:11'),
('dee9cc22fc1d8dfb5ada7f67fd25ed247681e6628a89dbd176479acce88544311dd1225a0e35e1f4', 10, 1, 'Laravel Password Grant Client', '[]', 1, '2022-03-08 08:36:53', '2022-03-08 08:36:53', '2023-03-08 14:06:53'),
('e40a038bf7dfa3f503af274f6297bcf5188b20654c3301f8a4d6a4393a12e611f5cc178ea4ed876f', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:42:27', '2022-03-08 07:42:27', '2023-03-08 13:12:27'),
('e846d4f94da4fc79d691dc235b179d04627300ac2fea4788f477107b82f0a42dd318bdac621abc3b', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:20:14', '2022-03-08 07:20:14', '2023-03-08 12:50:14'),
('fb7f5c229c740aa0af0c423a4a7dd82d66a274ecce4c3d89797138795793c6a032c936ca0562c7bf', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:13:18', '2022-03-08 08:13:18', '2023-03-08 13:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'svwDmYBaPg4DuA9xsHGahela1rysmk84h8NFgEXu', NULL, 'http://localhost', 1, 0, 0, '2022-03-08 07:19:59', '2022-03-08 07:19:59'),
(2, NULL, 'Laravel Password Grant Client', 'gthQqRsCVzt6st9OnHZqY2i6thvRVmMTzqBem2qk', 'users', 'http://localhost', 0, 1, 0, '2022-03-08 07:19:59', '2022-03-08 07:19:59');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-03-08 07:19:59', '2022-03-08 07:19:59');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `dependency` int(11) NOT NULL DEFAULT '0',
  `otp` int(11) NOT NULL DEFAULT '0',
  `otp_verified` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `uid`, `dependency`, `otp`, `otp_verified`, `created_at`, `updated_at`) VALUES
(1, '2fcbf420-4404-48f4-82b9-106eb234e07e', 1, 80569, 0, '2022-03-04 07:23:40', '2022-03-04 07:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'Laravel Password Grant Client', '7b91c8e9119f1d77a7b72018f70f20d43ef04917b62e0631f43e8dda9fdd36bd', '[\"*\"]', NULL, '2022-03-07 10:42:42', '2022-03-07 10:42:42'),
(2, 'App\\Models\\User', 1, 'Laravel Password Grant Client', 'de9f5d7ad96bd14a8caa7454d4a87dcf8a15082a1f7b11b57124d9715d78d919', '[\"*\"]', NULL, '2022-03-07 10:43:34', '2022-03-07 10:43:34'),
(3, 'App\\Models\\User', 1, 'Laravel Password Grant Client', 'fb72a50bc1a5184ecc7776126adfeb67096dfac18d4797690d3b123fe9469a49', '[\"*\"]', NULL, '2022-03-07 10:43:40', '2022-03-07 10:43:40'),
(4, 'App\\Models\\User', 1, 'Laravel Password Grant Client', 'be54c2dd7bb580f03816a4460ee3197cbde9e9e55f9c51544d5bfceea7309f62', '[\"*\"]', NULL, '2022-03-07 10:44:29', '2022-03-07 10:44:29'),
(5, 'App\\Models\\User', 1, 'Laravel Password Grant Client', 'f062912c35cf0d0f241c88aea7225b8af01a6eb6cddbfe12df09afa290b9cf7f', '[\"*\"]', NULL, '2022-03-07 10:45:02', '2022-03-07 10:45:02'),
(6, 'App\\Models\\User', 1, 'Laravel Password Grant Client', 'dcfc2955714ffd36485d11bf6a0c0a192fcfe1ec978bace2424b165e1ee77e14', '[\"*\"]', NULL, '2022-03-07 10:50:03', '2022-03-07 10:50:03'),
(7, 'App\\Models\\User', 1, 'Laravel Password Grant Client', 'd47d351283342af474726b19362c1b029cd87b90f950ed8c351aebb534d39556', '[\"*\"]', NULL, '2022-03-07 10:51:27', '2022-03-07 10:51:27'),
(8, 'App\\Models\\User', 1, 'Laravel Password Grant Client', '0bd66be1235f062bf27d0d14305c43470ea78941a87996ea87b6e53da568d298', '[\"*\"]', NULL, '2022-03-07 10:51:30', '2022-03-07 10:51:30'),
(9, 'App\\Models\\User', 10, 'Laravel Password Grant Client', '16ce76e4398d359f8e50755daf1fdad1d065489a34dd44a9a2972efd5a0b3a3b', '[\"*\"]', NULL, '2022-03-07 10:59:29', '2022-03-07 10:59:29'),
(10, 'App\\Models\\User', 10, 'Laravel Password Grant Client', '3161b7500dc06cd4033cbb0b27d5145512536636665b1c86638e9797e1c8c666', '[\"*\"]', NULL, '2022-03-07 11:00:15', '2022-03-07 11:00:15'),
(11, 'App\\Models\\User', 11, 'Laravel Password Grant Client', 'a9ca4f7bbe716cc463f6c112ffa0efae9a4a79305c5a2884fbe836c205d61312', '[\"*\"]', NULL, '2022-03-07 11:00:42', '2022-03-07 11:00:42'),
(12, 'App\\Models\\User', 12, 'Laravel Password Grant Client', '285ccd7fc3840965565d76ed88101c1c6970d5e5f7b0992c25318c8a94e726d4', '[\"*\"]', NULL, '2022-03-07 11:03:27', '2022-03-07 11:03:27'),
(13, 'App\\Models\\User', 13, 'Laravel Password Grant Client', '8127334f9122d394a1dc5dca2584407dcd9d7b69b7f871ce9032e3372c55c708', '[\"*\"]', NULL, '2022-03-07 11:04:19', '2022-03-07 11:04:19'),
(14, 'App\\Models\\User', 10, 'Laravel Password Grant Client', '15eb3fd0d80faec554fd84f933ee1f312e0c06d7f0dd5ddd507113adc42bb21c', '[\"*\"]', NULL, '2022-03-07 11:28:32', '2022-03-07 11:28:32'),
(15, 'App\\Models\\User', 10, 'Laravel Password Grant Client', '6fb8697bef5ae7e4c07d85372336af5d32221127085ebf5920da84b08ade4b9a', '[\"*\"]', NULL, '2022-03-07 11:29:52', '2022-03-07 11:29:52'),
(16, 'App\\Models\\User', 10, 'Laravel Password Grant Client', '9aa53d3b8d7ae4d7094ea6c2bec1b1797d9ee2fb6f5a4f32a9033d37f1944bb5', '[\"*\"]', NULL, '2022-03-07 11:57:35', '2022-03-07 11:57:35'),
(17, 'App\\Models\\User', 10, 'Laravel Password Grant Client', '68745f6eb806b591d5c3b9b80e044ae948f2e80f2df31a8d928507a8876132cb', '[\"*\"]', NULL, '2022-03-07 11:57:40', '2022-03-07 11:57:40'),
(18, 'App\\Models\\User', 14, 'Laravel Password Grant Client', '7f1eceb91cd4289ffaba1486c434d710eb9f47f0a8546fe596ba6e653f29f053', '[\"*\"]', NULL, '2022-03-07 11:57:57', '2022-03-07 11:57:57'),
(19, 'App\\Models\\User', 15, 'Laravel Password Grant Client', '3fdbe4689ca173ff00f40d73bc60fc394ffac0b2ee54f68442e03d082bf68ac7', '[\"*\"]', NULL, '2022-03-07 12:00:46', '2022-03-07 12:00:46'),
(20, 'App\\Models\\User', 16, 'Laravel Password Grant Client', '4ec3e43a7912850c1cae607b6f0d601e7f53fb442884b292c29b8f70c779d9e9', '[\"*\"]', NULL, '2022-03-07 12:04:22', '2022-03-07 12:04:22'),
(21, 'App\\Models\\User', 10, 'Laravel Password Grant Client', 'f9a4f94e64e660530e2a9742ddeb44d75416b9d06615c133b3e12af0a25cf957', '[\"*\"]', NULL, '2022-03-08 07:07:07', '2022-03-08 07:07:07'),
(22, 'App\\Models\\User', 10, 'Laravel Password Grant Client', '92a96f33830b57ae16b9bec6b4156747bed9794afebe63fca2819c60faa052d8', '[\"*\"]', NULL, '2022-03-08 07:11:46', '2022-03-08 07:11:46'),
(23, 'App\\Models\\User', 10, 'Laravel Password Grant Client', '3cd5d1804fac64035d6916ce15f3d07dae0f5bf9558ca5069e2b96f0cb488340', '[\"*\"]', NULL, '2022-03-08 07:15:47', '2022-03-08 07:15:47'),
(24, 'App\\Models\\User', 10, 'Laravel Password Grant Client', '53fe393f5ffff2f28c5153f54fd2e4e5b32040fe890f7a794dabf52f4f4f3c70', '[\"*\"]', NULL, '2022-03-08 07:15:50', '2022-03-08 07:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `person_address`
--

CREATE TABLE `person_address` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `address_type` int(11) NOT NULL DEFAULT '1',
  `address` varchar(255) DEFAULT NULL,
  `door_no` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_address`
--

INSERT INTO `person_address` (`id`, `uid`, `address_type`, `address`, `door_no`, `street`, `district`, `city`, `state`, `country`, `status`, `created_at`, `updated_at`) VALUES
(1, '2fcbf420-4404-48f4-82b9-106eb234e07e', 1, 'Home Address', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-03-04 08:33:35', '2022-03-04 08:33:35'),
(2, '2fcbf420-4404-48f4-82b9-106eb234e07e', 2, 'Offfice Address', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-03-04 08:33:35', '2022-03-04 08:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `person_details`
--

CREATE TABLE `person_details` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `saluation` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `nick_name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `family_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_details`
--

INSERT INTO `person_details` (`id`, `uid`, `saluation`, `first_name`, `last_name`, `nick_name`, `gender`, `dob`, `blood_group`, `profile_pic`, `family_name`, `created_at`, `updated_at`) VALUES
(1, '2fcbf420-4404-48f4-82b9-106eb234e07e', 1, 'Divakar', 'M', 'DK', '1', '2022-03-04', '1', 'http://127.0.0.1:8000/assets/profile/be84650eef9e580c137128d703e60276.jpg', 'Divakar family', '2022-03-04 14:03:35', '2022-03-04 08:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `person_email`
--

CREATE TABLE `person_email` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_email`
--

INSERT INTO `person_email` (`id`, `uid`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, '2fcbf420-4404-48f4-82b9-106eb234e07e', 'keegayu5662@gmail.com', 1, '2022-03-04 14:03:35', '2022-03-04 08:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `person_mobile`
--

CREATE TABLE `person_mobile` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '11',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_mobile`
--

INSERT INTO `person_mobile` (`id`, `uid`, `mobile`, `status`, `created_at`, `updated_at`) VALUES
(1, '2fcbf420-4404-48f4-82b9-106eb234e07e', '8220695662', 1, '2022-03-04 14:03:35', '2022-03-04 08:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `temp_users`
--

CREATE TABLE `temp_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stage` int(11) DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `primary_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_otp` int(11) NOT NULL DEFAULT '0',
  `email_otp_verified` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `primary_mobile`, `primary_email`, `password`, `email_otp`, `email_otp_verified`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '2fcbf420-4404-48f4-82b9-106eb234e07e', '8220695662', 'keegayu5662@gmail.com', '$2y$10$mMuy1LAOjcDN0diH.9l3dOQoEeixuM4GsDZrx3UL4xJAcJTC3m9Y2', 0, 0, '', '2022-03-04 07:25:44', '2022-03-04 07:25:44'),
(2, '2fcbf420-4404-48f4-82b9-106eb234e07e', '8220695662', 'keegayu5662@gmail.com', '$2y$10$TidqWJXxwiYQU.mro9xPB.Dy6vXOw/h8Ct9wa49XZZrSSgAE9gtfO', 0, 0, '', '2022-03-04 07:30:41', '2022-03-04 07:30:41'),
(3, '2fcbf420-4404-48f4-82b9-106eb234e07e', '8220695662', 'keegayu5662@gmail.com', '$2y$10$Zx1bm8TD28B2.Lsq.0AqieLiqJeolwg9L8CcexXZ4/KXD0jv1ZVwG', 0, 0, '', '2022-03-04 07:31:20', '2022-03-04 07:31:20'),
(4, '2fcbf420-4404-48f4-82b9-106eb234e07e', '8220695662', 'keegayu5662@gmail.com', '$2y$10$uNfEaRUCHX.JdCLwZRL3eufhO5.K3YN2XPlCSv8NeC6Hn6v820ZGC', 0, 0, '', '2022-03-04 07:31:43', '2022-03-04 07:31:43'),
(5, '2fcbf420-4404-48f4-82b9-106eb234e07e', '8220695662', 'keegayu5662@gmail.com', '$2y$10$/WylwOCBCavp55AqGU20suLfY6u4pamprpgaG3V1Me/JcLcGvtpZC', 0, 0, '', '2022-03-04 07:32:21', '2022-03-04 07:32:21'),
(6, '2fcbf420-4404-48f4-82b9-106eb234e07e', '8220695662', 'keegayu5662@gmail.com', '$2y$10$TnF3hB34ejzqETGBaAWj5.BtqNAJC1LihWo4FTPrxvjnTSDWah9cC', 0, 0, '', '2022-03-04 07:32:54', '2022-03-04 07:32:54'),
(7, '2fcbf420-4404-48f4-82b9-106eb234e07e', '8220695662', 'keegayu5662@gmail.com', '$2y$10$IImNa9UW8ozwwHOxUTmxPeF6xKAKCH2QSNxS/JvmhvFhvHfU0lMly', 0, 0, '', '2022-03-04 07:35:03', '2022-03-04 07:35:03'),
(8, '2fcbf420-4404-48f4-82b9-106eb234e07e', '8220695662', 'keegayu5662@gmail.com', '$2y$10$7RiW2we5DBwZRmMMSXnbd.0Hp6OUAG3Fq4zFxTl5z77hOnEeDiwoG', 0, 0, '', '2022-03-04 07:35:22', '2022-03-04 07:35:22'),
(9, '2fcbf420-4404-48f4-82b9-106eb234e07e', '8220695662', 'keegayu5662@gmail.com', '$2y$10$NeAoC5YVKgIR4ZnlM8AL8O94aJVObZTnPev6xHOGe.xX9JE3I1zZ.', 0, 0, '', '2022-03-04 07:56:17', '2022-03-04 07:56:17'),
(10, NULL, NULL, 'dk@gmail.com', '$2y$10$AXjbc5GekCqzyGUjR.Y1BuIoAuzlj9gOAzMPkGYgUcs2.K8IySb/6', 0, 0, NULL, '2022-03-07 10:59:29', '2022-03-07 10:59:29'),
(11, NULL, NULL, NULL, '$2y$10$kYd8r5YdKCMbUPASMmpuHe7ryvpGa4Xjb6U1Y2dGkuq470colqxYW', 0, 0, NULL, '2022-03-07 11:00:42', '2022-03-07 11:00:42'),
(12, NULL, '7598431551', 'dk1@gmail.com', '$2y$10$nstTh6zaSkEsBN6laLEWXee8Omlf3A93ygoIG4eZETw4WUe7kkDP.', 0, 0, NULL, '2022-03-07 11:03:27', '2022-03-07 11:03:27'),
(13, NULL, '7598431551', 'dk1@gmail3.com', '$2y$10$8SOWP.X8ajbNMSP7Qm1i8ebRlpnjgw0sY20jgtrUBiT/uLesmmk7i', 0, 0, NULL, '2022-03-07 11:04:19', '2022-03-07 11:04:19'),
(14, NULL, '7598431551', 'dk1@gmail3q.com', '$2y$10$NissdcisgYPBaKxALdnC2e6hFrSD0TT.uUPu1SWjpGhw3v35HE5lm', 0, 0, NULL, '2022-03-07 11:57:57', '2022-03-07 11:57:57'),
(15, NULL, '7598431551', 'divakar@gmail.com', '$2y$10$mvzaTpRcInnAGfHBrW1ReebXuOjvCRI3o.o6Z5pQx.DffrjAwHg5m', 0, 0, NULL, '2022-03-07 12:00:46', '2022-03-07 12:00:46'),
(16, NULL, '7598431551', 'divakdar@gmail.com', '$2y$10$CMgtuOtGvDSQELXO2huz8efFBOddl9v7UcieNWFEacu6nfCspGpye', 0, 0, NULL, '2022-03-07 12:04:22', '2022-03-07 12:04:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_blood_groups`
--
ALTER TABLE `m_blood_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_gender`
--
ALTER TABLE `m_gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_salutations`
--
ALTER TABLE `m_salutations`
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
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `person_address`
--
ALTER TABLE `person_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person_details`
--
ALTER TABLE `person_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person_email`
--
ALTER TABLE `person_email`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `person_mobile`
--
ALTER TABLE `person_mobile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_users`
--
ALTER TABLE `temp_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `m_blood_groups`
--
ALTER TABLE `m_blood_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `m_gender`
--
ALTER TABLE `m_gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `m_salutations`
--
ALTER TABLE `m_salutations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `person_address`
--
ALTER TABLE `person_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `person_details`
--
ALTER TABLE `person_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `person_email`
--
ALTER TABLE `person_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `person_mobile`
--
ALTER TABLE `person_mobile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `temp_users`
--
ALTER TABLE `temp_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
