-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 18, 2022 at 05:46 PM
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
('0216016d8320f175a63337c0d7d6bda01131105b6c2562548f81341e113e7421ed7439b879701caa', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-29 01:18:40', '2022-03-29 01:18:40', '2023-03-29 06:48:40'),
('041dcf462ddeeb4428c45fcfb7c50c6e5181ddfc8033548fa303134377f349a0450300970f256a04', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-29 01:42:12', '2022-03-29 01:42:12', '2023-03-29 07:12:12'),
('0456deb25610eacc7196d76efeb0cb10ed8656bb47765a16a1be807068aa32f4b22d74d43a897833', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-03-29 03:07:51', '2022-03-29 03:07:51', '2023-03-29 08:37:51'),
('07ab60955f0c5a245d28d15a7a63dbdfa89eed6d6ab85e0f8b9077a185de7069b7ca803604aa4495', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:42:24', '2022-03-08 07:42:24', '2023-03-08 13:12:24'),
('09ad5b870dae6974ca8ce1a143b5e7dae3cf9e3bcfe7ffd5edf09b72796e2f6246aa5940dcac885f', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-29 01:49:24', '2022-03-29 01:49:24', '2023-03-29 07:19:24'),
('0e6cd26e7c3d03f18c22984a3afbf128b37a4bbade68b62e400bd3f76e81ef85b21b3aa58bd9caa2', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:10:17', '2022-03-08 08:10:17', '2023-03-08 13:40:17'),
('13aeef98c26ae1e7a451cc2d67639cd80b2e2dd2bc8c71ef6b0170127ee404fd40dbe620f2739da3', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:19:07', '2022-03-08 08:19:07', '2023-03-08 13:49:07'),
('1c3ca84cafd387c6906537902c2b615770c0650960f09e3515e37848b84387e561432ca7cb8e2112', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-03-29 03:10:56', '2022-03-29 03:10:56', '2023-03-29 08:40:56'),
('1d22d422c6eacddb95d41462a0b531d9bf0e7b94e2339da577055faf69368fae83d8256abb083db8', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-17 07:12:29', '2022-03-17 07:12:29', '2023-03-17 12:42:29'),
('1e6ffa5a0c860ad3fc9a9773c2e255aca6e08b25dffa1a37292b9cf77511907b935a262a423bfe51', 10, 1, 'Laravel Password Grant Client', '[]', 1, '2022-03-08 08:35:01', '2022-03-08 08:35:01', '2023-03-08 14:05:01'),
('1eda7f8011d6cfb572f03ed7ba0e0e2a5b105f24b0db786c74557ea8309f1365f213a38a6180bde3', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-09 07:46:16', '2022-03-09 07:46:16', '2023-03-09 13:16:16'),
('269809078c87d295e8e6daae785ad946f0628cf6486ccd0c30c3ccbe0ba10b9dead4a2af3e8d9f3e', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:20:03', '2022-03-08 08:20:03', '2023-03-08 13:50:03'),
('27f1a1a5f97ba940c73d5fc4a42cbb91f477b37757713bc786b658c1d700a349848f09fa0012824c', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:20:20', '2022-03-08 07:20:20', '2023-03-08 12:50:20'),
('29817539655ed405eba4912b6b92751bf93318a384b74fcc8ec7b23dc9d1516ea70607b26b14624f', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-04-22 06:23:53', '2022-04-22 06:23:53', '2023-04-22 11:53:53'),
('2cd7e58729146957e1cdecf9dd0f2079a7f13eed823571c2d3cf8380493f717a190f719d4a2bdd9f', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-04-04 05:50:37', '2022-04-04 05:50:37', '2023-04-04 11:20:37'),
('300eb99a8c023382f17af5a4a7ed1113a53ae9ca8416f9d505b66e39d8d7054d55d3e804112aeb94', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-03-29 03:08:19', '2022-03-29 03:08:19', '2023-03-29 08:38:19'),
('31cbfda12614c7f4f78b75d4ab35bb11ca614264dfa4f65c611c2241b472836ae41c553c1a827b57', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-29 01:55:24', '2022-03-29 01:55:24', '2023-03-29 07:25:24'),
('32f193f5af02bdc1a4dd04a9e38206a3c7d2575be1d09f43b78bc3188737fe72e592a9970a2ec1ab', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-17 07:44:36', '2022-03-17 07:44:36', '2023-03-17 13:14:36'),
('383d196f98e0899927aa6cfe3bbc6b221adc0a75d309e3f5d5374cd3a9e026bb5ddbdfb3163c8e9c', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:42:30', '2022-03-08 07:42:30', '2023-03-08 13:12:30'),
('3a72f2badc9cf30601015aba4c746e99b8c92afd712a64aa34e1c88aa6073118f916b1d0ee95f1b2', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-09 07:56:31', '2022-03-09 07:56:31', '2023-03-09 13:26:31'),
('3b98e06e4e2a5a158f102a71c722e76c97b4e53de85d815c801a24dabb774e90dade92226d1a773a', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:20:02', '2022-03-08 08:20:02', '2023-03-08 13:50:02'),
('41cdffc355e3eaa3495667ecd6c40ee11f33f337656590c5102a4d512b0f73a865b0f80d8aa70e44', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-09 07:45:11', '2022-03-09 07:45:11', '2023-03-09 13:15:11'),
('4484e1e82fcf2196396b9e65e8a08c4b26c13aa75b393aa813020a2713d2df038cc595a71e310bb6', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-03-09 07:56:50', '2022-03-09 07:56:50', '2023-03-09 13:26:50'),
('477029b0e8e900ce74e69b4d15fb5413041e416110df2015a2855351802bf1ba86987754238bbcc7', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-03-29 01:55:47', '2022-03-29 01:55:47', '2023-03-29 07:25:47'),
('47f05df7682fa91e8869062ee3f7b77085c7376ef0811e1a0286d9baae7a05d59251dab3401d577a', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-29 01:18:15', '2022-03-29 01:18:15', '2023-03-29 06:48:15'),
('494495bfbe97f01ce9f8c721fb8501a97c30e50c1a9999bb9d266620dbba8006d9bfb22d1a319fea', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-04-26 06:38:08', '2022-04-26 06:38:08', '2023-04-26 12:08:08'),
('5dbe4152d70141cadd09f7d607cfc28b0709726f15be48d86b2bd2ecd60d18ff16e452469461f2b8', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:36:16', '2022-03-08 08:36:16', '2023-03-08 14:06:16'),
('5e06e491cb8894721cffb64364e589c04aa0f2cc930480ed546c1efb8c1f337191398b879af6ab08', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-04-25 05:47:30', '2022-04-25 05:47:30', '2023-04-25 11:17:30'),
('660a658e1f37e0b0ec09ecc40c5fbdef57e048ed767b3c58a621e07d9374565cd69931ba05803391', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-05-06 07:20:26', '2022-05-06 07:20:26', '2023-05-06 12:50:26'),
('689c8409467e322188dce83b69f343ec0957a3236d79acf381580ec99f6bb0926283b1861a16fd29', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:32:24', '2022-03-08 08:32:24', '2023-03-08 14:02:24'),
('715e3a61ca946fbb85f7ed1ce8ecb32f877f15c082980ebb4b5764d1d558176f5ae26fae6cfb32f0', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-04-11 05:57:36', '2022-04-11 05:57:36', '2023-04-11 11:27:36'),
('73c4aea9f3976d7dd1564d451207eb9a0e5e4f2f7c09d3293b7190900136c5823f7452f5ad0207de', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-04-15 06:06:27', '2022-04-15 06:06:27', '2023-04-15 11:36:27'),
('748d19fdf02346dd715b8c1ae3dfb9d15db7655ef16c5391d4afbf1eda926139d48f3dd80a95bcd0', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-29 01:54:48', '2022-03-29 01:54:48', '2023-03-29 07:24:48'),
('757dce936b3df44539aa78547dd194a5970543f8082267153862b0ccde8a62782468fdc8c5fcc66a', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-05-11 06:14:19', '2022-05-11 06:14:19', '2023-05-11 11:44:19'),
('76242b7e282b5a6f8ef973f0f8e1be44d6b3bd3f26195455061e444e1d37f5f7397185ee28ad18f3', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:08:44', '2022-03-08 08:08:44', '2023-03-08 13:38:44'),
('764fd3b8e06ba3fb40e58ef5cec36362c33e4227fb64c5387b94ea6f7b3d87af74266943e732603f', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-09 07:56:16', '2022-03-09 07:56:16', '2023-03-09 13:26:16'),
('7707899822b08119e560a68aa25ce2404abe8f53418215d9a913464a21b185b4c654db21cc9a712a', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-05-06 06:24:03', '2022-05-06 06:24:03', '2023-05-06 11:54:03'),
('77ede8983a802939df51bf7df6e9b2b8908abdf329dc165f0717cf93832df61fe1c9c8b56f5caa93', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-17 07:42:48', '2022-03-17 07:42:48', '2023-03-17 13:12:48'),
('81e59914f86a4905de96bab959edede4aa28c65bea6366817be80c4b44ad23975dfb83465ec3c5b9', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-05-04 06:29:23', '2022-05-04 06:29:23', '2023-05-04 11:59:23'),
('857cdb2f9e86d0dc35519dea8d16902e51397a04b369e93d06a8c15c57573eb80a76fbd62e8b93a2', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:57:50', '2022-03-08 07:57:50', '2023-03-08 13:27:50'),
('878b396065eb4bedd57c47157fb229c188428fd4043cfdca724bf3ef306e4295fdd938e341d164a9', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-17 07:12:50', '2022-03-17 07:12:50', '2023-03-17 12:42:50'),
('8add80de60e5c339da9928cffdb4e368365ab0eb232cf5198a97724fa3341d0dfefb14a3f6cc16d6', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-03-29 03:04:03', '2022-03-29 03:04:03', '2023-03-29 08:34:03'),
('8e2a0c1a0e2d89a43e2dc0059ab5c9862cdf7bf42746032c43ab14945061352aca396f15c3d807d0', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-03-10 07:30:41', '2022-03-10 07:30:41', '2023-03-10 13:00:41'),
('90b3a57cf61cd273b4af551c655e60e75210e8a051d222f21ad2aa965598897a978e49d7b3bb00a3', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-04-13 05:11:59', '2022-04-13 05:11:59', '2023-04-13 10:41:59'),
('923bd6e76730b62ca3346e9e808c7b00d7f9e94c3d40ebde9c704ca6ae98cddb62b9942573105897', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-29 01:48:42', '2022-03-29 01:48:42', '2023-03-29 07:18:42'),
('94388d8ba468dafbacb265bf9da2f2acdc8d5263ebbc7c089a57b7452baf65daa7df67699270f348', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-09 07:56:08', '2022-03-09 07:56:08', '2023-03-09 13:26:08'),
('98a389a9de79e968114e31096ee4441d405602fee306d1bca6359924fb6a1bb2ee8027c534c17dea', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-29 01:52:15', '2022-03-29 01:52:15', '2023-03-29 07:22:15'),
('9ba5568566ebc03cdf74af3d6839c6bb2ce370bf10d0ee36a259a0a2d28f5d73e6eedf725bae5d7b', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-05-16 06:03:34', '2022-05-16 06:03:34', '2023-05-16 11:33:34'),
('9cf32aa8d549964552b304c494c8c22c63c7676a414b8c4b7d869bae0c5a2aa6373caad202daf068', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-17 07:15:28', '2022-03-17 07:15:28', '2023-03-17 12:45:28'),
('a21faa65f2569e5d8043ab076c9ced44215e32f45fcce3ca0468d4abef54f43c03ab458f41b74bec', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-04-04 06:30:01', '2022-04-04 06:30:01', '2023-04-04 12:00:01'),
('a5adcc263ecf741d322c58e36a7e8b40f7493654605632f828f4520a0d6dbc14a8fd870df5af3a8b', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 08:21:17', '2022-03-08 08:21:17', '2023-03-08 13:51:17'),
('aebff0be37fe42db83322db508084fae423d9b7e53d178ef34942a1cfafe2aa724a8717bc17d9b33', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-17 07:36:55', '2022-03-17 07:36:55', '2023-03-17 13:06:55'),
('b93046f1d9f8af467e48124bf34f0137b30cd51c32d0424b233ebd29f991a371b21980689df4fbb5', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-05-18 05:57:34', '2022-05-18 05:57:34', '2023-05-18 11:27:34'),
('ba61f8951843ed4f685b00f3d20502be24fbaef8390c7bc4323f14496cf33607a16c2f885bcc9ac4', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-04-05 06:42:09', '2022-04-05 06:42:09', '2023-04-05 12:12:09'),
('bcd3264b89260f3c96c5f140ebe2323fc1c945bb9350566961bccff982a80ffe86ba4c394ddcb6c9', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-03-29 03:02:39', '2022-03-29 03:02:39', '2023-03-29 08:32:39'),
('c0ff9ea369a02916fd90b6afbd4540e52feee899bf0655d9d868513f914ecb5e01e1da2da24062a9', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:20:25', '2022-03-08 07:20:25', '2023-03-08 12:50:25'),
('c38064f38cd1d905cfee30f34d72ce1ceba124f1ce0e4020ea619a415be9e27fe0f87fa2309bd5e2', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-04-07 04:21:31', '2022-04-07 04:21:31', '2023-04-07 09:51:31'),
('c4136e34ab44b0099aa4ff7c2e944ab78114123c11b1b01e9bc848726cf00a64c2fdb32ab4cc6a35', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-09 07:56:42', '2022-03-09 07:56:42', '2023-03-09 13:26:42'),
('c51d841071ccffc8ded9aeaf95d962c35d2bae703447d859fa4c0db3cfeeeb88813346faaecedf6a', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-05-13 05:27:36', '2022-05-13 05:27:36', '2023-05-13 10:57:36'),
('c8c2411a9d99821b93127d6ff7c20ac73aca9fbc873334d4f3c627924bfcf1cfcb280dd5b8d95996', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-05-02 06:35:52', '2022-05-02 06:35:52', '2023-05-02 12:05:52'),
('c92e43f19946419614a644c7549987de7486af60c5a01330c7000b90b060a3492a73dbdd0b7e2bce', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-04-28 06:08:24', '2022-04-28 06:08:24', '2023-04-28 11:38:24'),
('ca52e7c7bdc25360e8c6b3144983143813ba948e004aef6c70658be89073996f0a247227046cb5d3', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-04-04 06:20:32', '2022-04-04 06:20:32', '2023-04-04 11:50:32'),
('d4c664b082a73568bb8e135be76ccaf2759372fa6c98014f9ace20620a0abb67c80c7988ea1efd44', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-04-04 06:57:24', '2022-04-04 06:57:24', '2023-04-04 12:27:24'),
('d55a43ea651b82aa06b886d2f9704d981eaf66db9a5a508293b86e755bfaa5d221b111e38c810660', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:20:11', '2022-03-08 07:20:11', '2023-03-08 12:50:11'),
('d78bb92de70e3e5a0827cfb00dd7b459b24e28b4bcb8745d66a31658a974b57baced59abb037aeb5', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-04-04 06:33:30', '2022-04-04 06:33:30', '2023-04-04 12:03:30'),
('d8b1239e0f84153ad08fe82582b88b2848aca9d701206bb08a3096491cd7e34a7b83fd574ba11847', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-05-02 06:34:36', '2022-05-02 06:34:36', '2023-05-02 12:04:36'),
('d94cefa7d4f0cd5924cef972925b1b1e717061c706fecd7eeecf1a4d8d93bdf21fb95374a75577f9', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-03-29 03:11:36', '2022-03-29 03:11:36', '2023-03-29 08:41:36'),
('db69bc4ebd0836b846c8d57653eb425e1a298938925ea5b669dfb1502fe5bc4fe8dcf4f473bddd9d', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-09 07:56:37', '2022-03-09 07:56:37', '2023-03-09 13:26:37'),
('dee9cc22fc1d8dfb5ada7f67fd25ed247681e6628a89dbd176479acce88544311dd1225a0e35e1f4', 10, 1, 'Laravel Password Grant Client', '[]', 1, '2022-03-08 08:36:53', '2022-03-08 08:36:53', '2023-03-08 14:06:53'),
('e10c52bb40148b34ad15070981d9262937e3bb80c82d7709736d91789e6242aa357ffec4714e3abc', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-04-04 06:20:44', '2022-04-04 06:20:44', '2023-04-04 11:50:44'),
('e40a038bf7dfa3f503af274f6297bcf5188b20654c3301f8a4d6a4393a12e611f5cc178ea4ed876f', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:42:27', '2022-03-08 07:42:27', '2023-03-08 13:12:27'),
('e423518ca380dac5d31a8760f9ccbc824096df0fa84ed656580601a3fab6caf61fe45799ca09e476', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-17 07:39:20', '2022-03-17 07:39:20', '2023-03-17 13:09:20'),
('e770896eef02d4e1bbb05684ad39fcd7196c0a2fd13d291e025b8123dd0919e9bcbd3f9e71b0fc71', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-03-29 03:09:21', '2022-03-29 03:09:21', '2023-03-29 08:39:21'),
('e846d4f94da4fc79d691dc235b179d04627300ac2fea4788f477107b82f0a42dd318bdac621abc3b', 10, 1, 'Laravel Password Grant Client', '[]', 0, '2022-03-08 07:20:14', '2022-03-08 07:20:14', '2023-03-08 12:50:14'),
('ef48a24a0c9bc47e5773085acab0af83629c024499ea08885f7039f31796dbc13b264071139ee310', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-04-16 05:17:47', '2022-04-16 05:17:47', '2023-04-16 10:47:47'),
('f713384cf8ea4ae3ca6d58ed37ee86592e40c37884beed6a60bf106794d43e203855a39e7d643edc', 1, 1, 'Laravel Password Grant Client', '[]', 0, '2022-05-09 06:09:50', '2022-05-09 06:09:50', '2023-05-09 11:39:50'),
('f9269619d8de186f517c7ecebd7d41b8ed361f5b75812a773af1f72a3c3e5a1d70047b9a5e69036c', 1, 1, 'Laravel Password Grant Client', '[]', 1, '2022-04-26 05:52:19', '2022-04-26 05:52:19', '2023-04-26 11:22:19'),
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
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `organisation_id` int(11) NOT NULL,
  `uid` varchar(255) DEFAULT NULL,
  `organisation_name` varchar(255) DEFAULT NULL,
  `organisation_email` varchar(255) DEFAULT NULL,
  `created_for` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organisation_address`
--

CREATE TABLE `organisation_address` (
  `address_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `door_no` varchar(255) DEFAULT NULL,
  `building_name` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `landmark` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `organisation_details`
--

CREATE TABLE `organisation_details` (
  `details_id` int(11) NOT NULL,
  `organisation_id` int(11) NOT NULL,
  `organisation_pan` varchar(255) DEFAULT NULL,
  `organisation_gstin` varchar(255) DEFAULT NULL,
  `organisation_website` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', 1, 61157, 0, '2022-05-02 06:20:52', '2022-05-02 06:21:12');

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
  `bilding_name` varchar(255) DEFAULT NULL,
  `land_mark` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
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

INSERT INTO `person_address` (`id`, `uid`, `address_type`, `address`, `door_no`, `bilding_name`, `land_mark`, `pincode`, `area`, `street`, `district`, `city`, `state`, `country`, `status`, `created_at`, `updated_at`) VALUES
(1, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', 3, 'dsa', '123', 'b', 'landmark', '987878978', 'AREA', 'dsa', 'District', 'CIty', 'fdsf', 'fdsf', 1, '2022-05-18 11:46:53', '2022-05-18 06:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `person_details`
--

CREATE TABLE `person_details` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `saluation` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` int(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `nick_name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `blood_group` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `family_name` varchar(255) DEFAULT NULL,
  `martial_status` varchar(255) DEFAULT NULL,
  `aniversary_date` varchar(255) DEFAULT NULL,
  `mother_tongue` varchar(255) DEFAULT NULL,
  `other_language` text,
  `web_link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_details`
--

INSERT INTO `person_details` (`id`, `uid`, `saluation`, `first_name`, `middle_name`, `last_name`, `nick_name`, `gender`, `dob`, `blood_group`, `profile_pic`, `family_name`, `martial_status`, `aniversary_date`, `mother_tongue`, `other_language`, `web_link`, `created_at`, `updated_at`) VALUES
(1, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', 1, 'Divakar', NULL, 'M', 'Dk', '1', '2022-05-03', '1', 'http://127.0.0.1:8001/assets/profile/a7e4d429f0ddc0c63f0541b01048a5b7.png', 'Divakar family', 'Married', '2022-05-11', NULL, NULL, 'www.google.com12', '2022-05-18 12:13:31', '2022-05-18 06:43:31');

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
(3, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', 'ravi@gmail.com', 1, '2022-05-04 12:21:11', '2022-05-04 06:39:06'),
(5, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', 'dhivakarmm@gmail.com', 0, '2022-05-04 12:47:02', '2022-05-04 07:15:57'),
(8, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', 'deldiva@gmail.com', 0, '2022-05-04 12:51:23', '2022-05-04 07:21:23'),
(9, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', 'ganesh@alphasoftz.com', 0, '2022-05-04 07:20:35', '2022-05-04 07:20:35'),
(10, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', 'deldiva@gmail.com', 0, '2022-05-04 07:21:23', '2022-05-04 07:21:23');

-- --------------------------------------------------------

--
-- Table structure for table `person_mobile`
--

CREATE TABLE `person_mobile` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `previous_mobile` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '11',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person_mobile`
--

INSERT INTO `person_mobile` (`id`, `uid`, `mobile`, `previous_mobile`, `status`, `created_at`, `updated_at`) VALUES
(1, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', '8220695662', NULL, 1, '2022-05-02 12:18:21', '2022-05-02 06:48:21');

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
(1, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', '8220695662', 'keegayu5662@gmail.com', '$2y$10$RjsnsZd0Fm14HzLuhi5v7OL21OKncw0WE..fR9zrgwBx.vPM6BlrS', 1234, 0, NULL, '2022-05-02 06:21:49', '2022-05-04 06:31:55'),
(2, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', '8220695662', 'keegayu5662@gmail.com', '$2y$10$IdFEWEC9bGyMPj.JG03KEuAG0athm8Yz.Jw3/I.T2hbP8LFyPIS3i', 1234, 0, NULL, '2022-05-02 06:23:55', '2022-05-04 06:31:55'),
(3, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', '8220695662', 'keegayu5662@gmail.com', '$2y$10$8kErlw2qKAJhqzWmLOi3ve2SKZDU90v1wl61kYsfVS5v1vHREK.ye', 1234, 0, NULL, '2022-05-02 06:25:12', '2022-05-04 06:31:55'),
(4, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', '8220695662', 'keegayu5662@gmail.com', '$2y$10$OyR5wiAUmqsMuorDCWJy6eXAfBWRzd5.xZ9NHp4pcp6mbNRCXE1wK', 1234, 0, NULL, '2022-05-02 06:25:34', '2022-05-04 06:31:55'),
(5, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', '8220695662', 'keegayu5662@gmail.com', '$2y$10$V2HHwtaD/l8h8n7qTxGC0ebGmfwwSXY5hdKb/5SXoOiqydOf7AjLe', 1234, 0, NULL, '2022-05-02 06:26:00', '2022-05-04 06:31:55'),
(6, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', '8220695662', 'keegayu5662@gmail.com', '$2y$10$9Xv/BZbwCKFCv.m/mOhV.O4GKDkgkw5O8ObUznwW526XEpt4kjN4i', 1234, 0, NULL, '2022-05-02 06:30:13', '2022-05-04 06:31:55'),
(7, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', '8220695662', 'keegayu5662@gmail.com', '$2y$10$GdPcToFS2FxZq/UNt7ulPu1jzblJl9uavjgA/JQAzXjdGmWVi3Cni', 1234, 0, NULL, '2022-05-02 06:34:34', '2022-05-04 06:31:55'),
(8, '8b562c86-53d2-483d-aaf6-6b43180f6f7f', '8220695662', 'keegayu5662@gmail.com', '$2y$10$aSmYW0eUQvUSxpusTfTpwujpSxR8OA48IKIqQC5wnxFN9BGHmt9Ve', 1234, 0, NULL, '2022-05-02 06:35:51', '2022-05-04 06:31:55');

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
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`organisation_id`);

--
-- Indexes for table `organisation_address`
--
ALTER TABLE `organisation_address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `organisation_details`
--
ALTER TABLE `organisation_details`
  ADD PRIMARY KEY (`details_id`);

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
-- AUTO_INCREMENT for table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `organisation_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organisation_address`
--
ALTER TABLE `organisation_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organisation_details`
--
ALTER TABLE `organisation_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `person_address`
--
ALTER TABLE `person_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `person_details`
--
ALTER TABLE `person_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `person_email`
--
ALTER TABLE `person_email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
