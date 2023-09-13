/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.28-MariaDB : Database - propelmainv1.1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `383c8fe6-4085-47a5-88f8-414f607bc2b7` */

DROP TABLE IF EXISTS `383c8fe6-4085-47a5-88f8-414f607bc2b7`;

CREATE TABLE `383c8fe6-4085-47a5-88f8-414f607bc2b7` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `org_id` varchar(191) NOT NULL,
  `active_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `383c8fe6-4085-47a5-88f8-414f607bc2b7` */

/*Table structure for table `com_property_addresses` */

DROP TABLE IF EXISTS `com_property_addresses`;

CREATE TABLE `com_property_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pims_com_address_type_id` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `door_no` varchar(255) DEFAULT NULL,
  `building_name` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `land_mark` varchar(255) DEFAULT NULL,
  `pims_com_district_id` int(11) DEFAULT NULL,
  `pims_com_city_id` int(11) DEFAULT NULL,
  `pims_com_state_id` int(11) DEFAULT NULL,
  `pims_com_country_id` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `google_link` text DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `com_property_addresses` */

insert  into `com_property_addresses`(`id`,`pims_com_address_type_id`,`address`,`door_no`,`building_name`,`pin`,`area`,`street`,`land_mark`,`pims_com_district_id`,`pims_com_city_id`,`pims_com_state_id`,`pims_com_country_id`,`location`,`google_link`,`latitude`,`longitude`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(1,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:10:52','2023-09-07 04:10:52',NULL),
(2,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:12:14','2023-09-07 04:12:14',NULL),
(3,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:14:24','2023-09-07 04:14:24',NULL),
(4,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:14:47','2023-09-07 04:14:47',NULL),
(5,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:15:28','2023-09-07 04:15:28',NULL),
(6,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:25:09','2023-09-07 04:25:09',NULL),
(7,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:25:30','2023-09-07 04:25:30',NULL),
(8,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:25:35','2023-09-07 04:25:35',NULL),
(9,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:25:38','2023-09-07 04:25:38',NULL),
(10,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:26:17','2023-09-07 04:26:17',NULL),
(11,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:26:21','2023-09-07 04:26:21',NULL),
(12,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:26:30','2023-09-07 04:26:30',NULL),
(13,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:35:57','2023-09-07 04:35:57',NULL),
(14,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-08 04:04:12','2023-09-08 04:04:12',NULL),
(15,NULL,NULL,'F3','IT Park','622515','Air Port','TVS','BDU',3,2,1,NULL,'Trichy',NULL,NULL,NULL,NULL,NULL,'2023-09-08 04:23:48','2023-09-08 04:23:48',NULL);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2023_09_07_084301_create_pfm_origin',1),
(2,'2023_09_07_084340_create_pfm_existence',1),
(3,'2023_09_07_084447_create_pfm_depone_status',1),
(4,'2023_09_07_084506_create_pfm_cachet',1),
(5,'2023_09_07_084524_create_pfm_validation',1),
(6,'2023_09_07_084931_create_pfm_person_stage',1),
(7,'2023_09_07_084948_create_pfm_active_status',1),
(8,'2023_09_07_085454_create_pfm_survival',1),
(9,'2023_09_11_083349_create_subscriber',2),
(10,'2023_09_11_083932_create_subscribers',3),
(12,'2023_09_12_042906_create_temp_organizations',4);

/*Table structure for table `oauth_access_tokens` */

DROP TABLE IF EXISTS `oauth_access_tokens`;

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_access_tokens` */

insert  into `oauth_access_tokens`(`id`,`user_id`,`client_id`,`name`,`scopes`,`revoked`,`created_at`,`updated_at`,`expires_at`) values 
('0052b5daa494b57bd17beca59852a76c81ea26486d39d9573bf1f887126a4fe25a5ba4660674fa95',1,1,'Laravel Password Grant Client','[]',0,'2023-07-07 06:17:02','2023-07-07 06:17:02','2024-07-07 06:17:02'),
('00590eecba9004e3312535b67c806090716210c6a2d78e8893927acafb8af4fc541158bb547e3493',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 04:11:10','2023-08-26 04:11:10','2024-08-26 04:11:10'),
('00aa4fe7a18bd9eae2f58bc3a9ac3a0a8ab4bdb513999b517f5597fce4281cd164139d90e9597b46',3,1,'Laravel Password Grant Client','[]',0,'2023-06-27 08:50:09','2023-06-27 08:50:09','2024-06-27 08:50:09'),
('01b5544dc0fd3ae25ca5d2c88a65fe41e11d36da278dc75ab9c7442b9aa3f4524f73af4d57b894dd',3,1,'Laravel Password Grant Client','[]',0,'2023-01-19 05:27:11','2023-01-19 05:27:11','2024-01-19 05:27:11'),
('01fab88e056a7deb76b331497e94b29fc9d82cd50b16534d85a2295b845890fe7dc342fa3a96b3ba',1,1,'Laravel Password Grant Client','[]',1,'2023-03-23 04:50:58','2023-03-23 04:50:58','2024-03-23 04:50:58'),
('02afa26b9e221020890afd75f44a7cd24fbec4f3e2a9957cacb81ef4b25836202c1987a0ecaaac25',3,1,'Laravel Password Grant Client','[]',0,'2023-01-19 05:26:58','2023-01-19 05:26:58','2024-01-19 05:26:58'),
('02c46cf566f817d94c46aec880eb0936b20edde0ab7f45b467d24aaa8f079bf6dbe242a7c9c6c91c',1,1,'Laravel Password Grant Client','[]',1,'2023-04-25 12:53:59','2023-04-25 12:53:59','2024-04-25 12:53:59'),
('0312b75093e22e9e3d3f86813547fd3a078281cd9a56f149e5cd0e1a20988fb7975332b829678ef5',1,1,'Laravel Password Grant Client','[]',1,'2023-04-07 11:46:33','2023-04-07 11:46:33','2024-04-07 11:46:33'),
('03a510d338b96bacac11a446d5bc19ebc28dd0200d8c2a83fab2414d8b1facc7228fb266d2a31938',3,1,'Laravel Password Grant Client','[]',0,'2023-05-05 13:03:45','2023-05-05 13:03:45','2024-05-05 13:03:45'),
('03a7b0874052e249a8131080a911e5fc456d1f3a4e54b4f890514c8ec2bef124918686588c5bc54a',1,1,'Laravel Password Grant Client','[]',0,'2023-09-04 11:34:52','2023-09-04 11:34:52','2024-09-04 11:34:52'),
('04d9683d242ce1fd08b1406143279bbee26cdb3103ca7c7d181733be0f6054695ce4a77258be6962',1,1,'Laravel Password Grant Client','[]',1,'2023-04-12 04:56:28','2023-04-12 04:56:28','2024-04-12 04:56:28'),
('0697dac04749df517b70ae69453d78494581ad65b866e155ccf051d63235e9c1ed8c16358af77429',3,1,'Laravel Password Grant Client','[]',1,'2023-06-14 03:59:48','2023-06-14 03:59:48','2024-06-14 03:59:48'),
('06f07db00194fca24f039691f7c39828c896861ebe69c4c13179d65f1eb2917efb0f2c63fc30b7b3',1,1,'Laravel Password Grant Client','[]',0,'2023-04-03 03:46:46','2023-04-03 03:46:46','2024-04-03 03:46:46'),
('072e36d0179913a31399366e5a10fc0a3d42bacdff5810803be0cf63b9da1aee28cacddd7f092ea4',1,1,'Laravel Password Grant Client','[]',0,'2023-04-07 12:11:58','2023-04-07 12:11:58','2024-04-07 12:11:58'),
('079fc130374dcb42d0e8766456618650d6b9cc6b4863e9998805941cf8633f2dccfab6c6f4607569',1,1,'Laravel Password Grant Client','[]',0,'2023-03-23 09:56:28','2023-03-23 09:56:28','2024-03-23 09:56:28'),
('07e7a35e06d1d5688e0d99da75bdc0f512ac82dd28d3f150e5fa3d45911ced8103fa4e6b6797400a',3,1,'Laravel Password Grant Client','[]',1,'2023-05-16 12:48:49','2023-05-16 12:48:49','2024-05-16 12:48:49'),
('0925fa93734a4ad35bad6bb6f8fd07123d808e36635329db17d8fd16622c3691426d9a70c9a5422a',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:25:32','2023-08-25 09:25:32','2024-08-25 09:25:32'),
('099c98a23ebe16e6867c09f0c0bdcb405e41d100866d81c11b2d65431b15ccc782384ae4eea376ea',4,1,'Laravel Password Grant Client','[]',1,'2023-05-05 12:58:38','2023-05-05 12:58:38','2024-05-05 12:58:38'),
('0ab5aa94b134c80befd9ae65b2d54db8c579c7faadf4e0ee763277adcc8b95d503b171d0defe34b7',1,1,'Laravel Password Grant Client','[]',0,'2023-04-07 12:18:08','2023-04-07 12:18:08','2024-04-07 12:18:08'),
('0ab986230a53cd9804a904c47b7ea128954ae9cc383441b4aba76ef634aeb149a2a5b761214bc3c8',3,1,'Laravel Password Grant Client','[]',0,'2023-06-21 09:16:04','2023-06-21 09:16:04','2024-06-21 09:16:04'),
('0ca7cde522da6bec3b9d58d057521fd102910d25de4e75d15303757202eed1633b8617148d21fc33',1,1,'Laravel Password Grant Client','[]',0,'2023-04-08 05:36:19','2023-04-08 05:36:19','2024-04-08 05:36:19'),
('0dd3ecbb500b5185cf5d2482ba832ab559fe2855066b7669f4844eea5b456145afd23355ec7807ed',1,1,'Laravel Password Grant Client','[]',0,'2023-04-06 15:15:44','2023-04-06 15:15:44','2024-04-06 15:15:44'),
('0e616b26c38758610146e54491d68792b8fe7d325d0c4f4a7d1e5c8bcbd18b8d4176acea6cd94180',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 04:12:20','2023-08-26 04:12:20','2024-08-26 04:12:20'),
('0ebfac9435eee6083f5da319bdaf28e711eb28b42ffd4c97de76028a69dbeabf87a0f3783d69f136',1,1,'Laravel Password Grant Client','[]',0,'2023-01-27 12:49:01','2023-01-27 12:49:01','2024-01-27 12:49:01'),
('0f62ae88cec88ddd2f5def5efa8a140920ef8d67b37801a548f6663d835bb5da3529613ea4fa64d8',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 04:51:47','2023-08-26 04:51:47','2024-08-26 04:51:47'),
('10faeb9b876b529b764026747259bbc03611ff003643c8b1244da9ca341c99a443ffde248e53f16f',1,1,'Laravel Password Grant Client','[]',0,'2023-09-05 09:47:32','2023-09-05 09:47:32','2024-09-05 09:47:32'),
('1148d9d8c1da18e18bc17b8a4cacc7120cf9e7641ce82b81e86e4b804ab173106d02514eed772370',3,1,'Laravel Password Grant Client','[]',0,'2023-06-21 09:47:47','2023-06-21 09:47:47','2024-06-21 09:47:47'),
('12380ee3cbef04e9f07b0b912613042ff390faad8743c0ffeae9dc1109fac4e2dbc98e703351f928',1,1,'Laravel Password Grant Client','[]',0,'2023-08-18 04:07:11','2023-08-18 04:07:11','2024-08-18 04:07:11'),
('12dcb832047310ec134de0763178343aedafe826b28a634568c3d27e4695a9e26e1110d868ed8e56',1,1,'Laravel Password Grant Client','[]',1,'2023-08-25 09:26:09','2023-08-25 09:26:09','2024-08-25 09:26:09'),
('12e46902bd409e06fe7b648e04d73bc7b950c5f7bca636d0cee9ecfe54a4d5d91f5b19741f82369e',1,1,'Laravel Password Grant Client','[]',1,'2023-08-24 06:48:17','2023-08-24 06:48:17','2024-08-24 06:48:17'),
('13d98a03acfa8f4af007410d720d6bd42614bd3c5c6d7d0b3ae221510d7d57bd0daeeca22d623468',1,1,'Laravel Password Grant Client','[]',1,'2023-07-10 06:12:22','2023-07-10 06:12:22','2024-07-10 06:12:22'),
('14a3ef805158dfda7179da033c766ccf80cac52e54b41e6f5910c1e2362cb76463ca7e752504bfa3',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 07:03:51','2023-08-26 07:03:51','2024-08-26 07:03:51'),
('161629a9c0590bf6275a49251435149310acec0122dfa8e33dfcc6894727e6a1c819704bfb3feb6b',1,1,'Laravel Password Grant Client','[]',1,'2023-08-10 04:52:02','2023-08-10 04:52:02','2024-08-10 04:52:02'),
('16cb40a07807995a395ad6eb4b3c70e107705053f569aaae8fcda37bf596dc66ef52d2cb8427e7e1',1,1,'Laravel Password Grant Client','[]',1,'2023-08-26 04:20:06','2023-08-26 04:20:06','2024-08-26 04:20:06'),
('17b3c0ff92bec10d0e49110fa80d95d90f93a8098e06f7a22832130f947eabfa14ef8f71800878c9',3,1,'Laravel Password Grant Client','[]',0,'2023-07-04 06:26:34','2023-07-04 06:26:34','2024-07-04 06:26:34'),
('18b29cfe62733f73ccbd64cb6c5499219b55b3c7d2bc9d216e4fb558539a6cec05f3f2e639265bed',1,1,'Laravel Password Grant Client','[]',0,'2023-03-23 09:22:43','2023-03-23 09:22:43','2024-03-23 09:22:43'),
('19ad2a90ef0bb3f512f02dad7cd59d0c8d3a1d0d282f13b491f77c57937817ec2b61ce98224cc4ec',3,1,'Laravel Password Grant Client','[]',0,'2023-07-04 12:09:50','2023-07-04 12:09:50','2024-07-04 12:09:50'),
('1a4c355d5b7b764b4d4039aa1ade20b4c6bda33fdb3f815bfac44d15bef051bf4d918425ff9d1117',1,1,'Laravel Password Grant Client','[]',0,'2023-09-02 03:59:08','2023-09-02 03:59:08','2024-09-02 03:59:08'),
('1a50594c2bde8a14b46bf67d5c8ce6cba70a734893bce63577703399fa00a7dabe2fce9cd1312d00',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 12:06:33','2023-08-25 12:06:33','2024-08-25 12:06:33'),
('1b2527f328b58b76aab4b6e2a9551285a8a2cd92ac1a4ac841a7c6ccaf18339bfd227bfd1e5ff9c6',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:55:25','2023-08-25 09:55:25','2024-08-25 09:55:25'),
('1b463a509bb00342caa927d6b9bbd68b13fed56f750f53f5150d81d2521cce5f3e9ac465fbc8928e',12,1,'Laravel Password Grant Client','[]',0,'2023-02-03 12:29:24','2023-02-03 12:29:24','2024-02-03 12:29:24'),
('1bc2373a9aa3e8dade47587562c292fd78db1de64f4b586f5f40253391b6785cdf3a5515a679d49c',1,1,'Laravel Password Grant Client','[]',0,'2023-09-11 06:18:34','2023-09-11 06:18:34','2024-09-11 06:18:34'),
('1ca054472e6a32f00304a7e6cb3a14ca04c9497778e20fc1d6876356377ccd3b21a469823dfc7b16',1,1,'Laravel Password Grant Client','[]',1,'2023-04-08 05:43:54','2023-04-08 05:43:54','2024-04-08 05:43:54'),
('1d464f8c590604a3365f78acfba116eecf6904ba36ddbb1d909f238e1b311e8f37041244d4d1e261',1,1,'Laravel Password Grant Client','[]',1,'2023-03-21 09:06:55','2023-03-21 09:06:55','2024-03-21 09:06:55'),
('1f6dc062312bea808899e1a9e73d8b56328656cb0e6705d80c749be054507e3c221304f8cf0d7a21',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 04:13:58','2023-08-18 04:13:58','2024-08-18 04:13:58'),
('1fc3a0d3bbd2fd6f0038345763e3e0d2312540c16a830b603072cb89254646689878a46275084738',3,1,'Laravel Password Grant Client','[]',1,'2023-05-05 13:02:49','2023-05-05 13:02:49','2024-05-05 13:02:49'),
('20a7ad02b8350d515856a793668a1c368e92e74f2cc6c00141a9192ab0961d9be05f226c50f8cd77',1,1,'Laravel Password Grant Client','[]',0,'2023-08-22 05:59:55','2023-08-22 05:59:55','2024-08-22 05:59:55'),
('21d3352c3f83c6fb2b707d6f3574d9ad201cc85ffca9c8d4992b8b3518e92eaa88c664c1920c1a8e',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 06:24:17','2023-08-25 06:24:17','2024-08-25 06:24:17'),
('21d5de47556dae19766f8777f235ad067c413d0bb469f7e84d203b36e283751841486c08831a43f8',1,1,'Laravel Password Grant Client','[]',0,'2023-04-05 12:38:05','2023-04-05 12:38:05','2024-04-05 12:38:05'),
('222d31585f4c38fee26f8d281a0fd55cee4dd2fc534b5e2b7bd72f67229e7ea553a6ae18f9008655',1,1,'Laravel Password Grant Client','[]',0,'2023-08-28 11:59:00','2023-08-28 11:59:00','2024-08-28 11:59:00'),
('2274d0872699436637998af6a4dac3b47019ae8dc5fc08a0af91869c5302edd6081294bf364c73f6',1,1,'Laravel Password Grant Client','[]',0,'2023-08-18 04:06:10','2023-08-18 04:06:10','2024-08-18 04:06:10'),
('237263c68380be1d11313728d03681f605857c6385619e65de9fd823ce61ebf356816dbc2ab457d5',1,1,'Laravel Password Grant Client','[]',1,'2023-08-25 06:24:34','2023-08-25 06:24:34','2024-08-25 06:24:34'),
('237eef8e270b54e612556e8cf079eb42da38c4c17be6dce83359eda62f7aac3fcec21d2dadc9d7dd',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:56:37','2023-08-25 09:56:37','2024-08-25 09:56:37'),
('24166454f0d3dcff395a74a53c605f4149c2cfe8bab53e79117369c178cf47db99c2fb6adfb0c78b',2,1,'Laravel Password Grant Client','[]',0,'2023-02-05 16:03:48','2023-02-05 16:03:48','2024-02-05 16:03:48'),
('254db1ee4008bd0df13ffe790aae8a346734203147f23cb555e6c6fde368eb60ac307738c557e6a9',1,1,'Laravel Password Grant Client','[]',0,'2023-04-08 05:47:52','2023-04-08 05:47:52','2024-04-08 05:47:52'),
('255df87cc3d8b6c8101010952c2e1a4119143c6c18a88716dbab064dab368df486983e204269a329',3,1,'Laravel Password Grant Client','[]',0,'2023-06-21 06:39:31','2023-06-21 06:39:31','2024-06-21 06:39:31'),
('25a61d162e73839c0481f0233b52a794540a02bcf6ddbb7167ec99ab0fc9a96220872bb0e5b462be',2,1,'Laravel Password Grant Client','[]',1,'2023-07-12 04:26:34','2023-07-12 04:26:34','2024-07-12 04:26:34'),
('261ce3c85dbc9a48e2c806be11129a14bc1d0e708e17084f11728e258dfb4cd62d9c627b7716237b',1,1,'Laravel Password Grant Client','[]',1,'2023-03-24 04:00:35','2023-03-24 04:00:35','2024-03-24 04:00:35'),
('2673e78c8d56bfe6bc1d6949eaa59b10eafa95a7e4731e25243ddb76cfa4234c62e7fc4de969c6f3',3,1,'Laravel Password Grant Client','[]',0,'2023-06-21 06:38:07','2023-06-21 06:38:07','2024-06-21 06:38:07'),
('27690754bccee28fbf8455b21feca4575b14425b5691ad3bfca1254dcb316b995c262a7df1b4de62',1,1,'Laravel Password Grant Client','[]',0,'2023-07-14 04:35:00','2023-07-14 04:35:00','2024-07-14 04:35:00'),
('27709a0cf6595852df73f43cad5b58c514a1ff2d1b29ea0429d0312715585fea008df72c16b5218a',1,1,'Laravel Password Grant Client','[]',0,'2023-08-03 03:53:28','2023-08-03 03:53:28','2024-08-03 03:53:28'),
('27e0deaa6bf787d9d19b53c953fb88fdc3b4b487b38152048516acca0911e898d96171a42d33378f',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:58:39','2023-08-25 09:58:39','2024-08-25 09:58:39'),
('282140cb0b2a6c71a21ba5b60a0bb0e3b12f6cf7126c268e589a0a328f3577eafa6e96c3085def7c',1,1,'Laravel Password Grant Client','[]',0,'2023-08-18 04:10:02','2023-08-18 04:10:02','2024-08-18 04:10:02'),
('285806f7006117c8fc5f5fb5281a2a798ec128979aab40c1d81a345f009d3e8915c543f7de4c4f44',1,1,'Laravel Password Grant Client','[]',0,'2023-04-07 12:22:03','2023-04-07 12:22:03','2024-04-07 12:22:03'),
('28940414052db2d447191873f3fe435d7ca9889059951e2a0036f511319673e4e3b96bc238ea855d',1,1,'Laravel Password Grant Client','[]',1,'2023-09-12 04:21:36','2023-09-12 04:21:36','2024-09-12 04:21:36'),
('28b1e46f448d9dddd8fc0be3b9e353fde4fda859f37429d691dcb48d9ca3e7368e98fd5bc8aab01a',2,1,'Laravel Password Grant Client','[]',0,'2023-03-24 11:40:53','2023-03-24 11:40:53','2024-03-24 11:40:53'),
('28ffeca28af0172255a5b37256f41b3d38697f3274adb8c251d393c787f73ef8694232393ed64d89',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 05:03:34','2023-08-26 05:03:34','2024-08-26 05:03:34'),
('29837f8a088816b57d5cbbadbf68804a6d4eb39b00dfefec39e0055304c275c83d194fb20cba2d4d',1,1,'Laravel Password Grant Client','[]',1,'2023-08-11 07:00:55','2023-08-11 07:00:55','2024-08-11 07:00:55'),
('298cdd73df6681b44dc894cac9c5cd0a65b1367a6bd177292007d4ea46c682e1b07f4b75282abf33',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:08:13','2023-08-25 09:08:13','2024-08-25 09:08:13'),
('2b40d7e30e05d9b665385c8a7cd35275da8e2a773c610ec9aea4f7a9e21f80d5fa5f960e6ef7a80d',1,1,'Laravel Password Grant Client','[]',1,'2023-04-06 03:47:04','2023-04-06 03:47:04','2024-04-06 03:47:04'),
('2d1bb64c80450b2cce0fd80556522e3095ec68859d0eefe27f86e874c7e2cdd29f9cce644bb4c26e',1,1,'Laravel Password Grant Client','[]',1,'2023-08-25 06:26:36','2023-08-25 06:26:36','2024-08-25 06:26:36'),
('2d2f7d12cdaab38248fde9a5aa5269beae064fa337d755b1070e3a2c559dd0db29336697740826c8',1,1,'Laravel Password Grant Client','[]',0,'2023-08-18 04:18:35','2023-08-18 04:18:35','2024-08-18 04:18:35'),
('2d790937c0cd51082053d58ed103f3a6f0c508e7969f2b3a2996b02be3fc0e2bf7f57c1c0bfb72e3',1,1,'Laravel Password Grant Client','[]',1,'2023-08-01 03:57:42','2023-08-01 03:57:42','2024-08-01 03:57:42'),
('2e540a2e8a6f112e643eb1eac5974c577fe6cc205b2fa149c1d712f51797116bc5ee9ffc16d3d980',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 03:49:44','2023-08-18 03:49:44','2024-08-18 03:49:44'),
('2f56e810ecc3db72fe2d04f14170cec08a82fb5e11f76193341c741a6afdecb4076c748b5b73fa2e',1,1,'Laravel Password Grant Client','[]',0,'2023-08-10 04:52:49','2023-08-10 04:52:49','2024-08-10 04:52:49'),
('2f948fc50163c778b20257422d3aa45ed19e45bdff353b156dd7471d18aab09972da7c27324322a3',1,1,'Laravel Password Grant Client','[]',1,'2023-08-26 11:42:42','2023-08-26 11:42:42','2024-08-26 11:42:42'),
('2f982837c509c7e5e9e9f39531e55a442a74d585d2aabffeb01b7019e1f30d2a9375ebbc67b7ecb1',1,1,'Laravel Password Grant Client','[]',1,'2023-04-12 03:48:58','2023-04-12 03:48:58','2024-04-12 03:48:58'),
('2ff0227830353b7c66185460192cf3f014703495683b46dd3e1699882bee45a2697d47b6e5ce47d8',3,1,'Laravel Password Grant Client','[]',1,'2023-06-20 10:00:38','2023-06-20 10:00:38','2024-06-20 10:00:38'),
('303280392c6c81acc10cc1a5fbe0de60a917ca1782d8628370aa06ea5ef80035ed96583ce2d2fbb7',2,1,'Laravel Password Grant Client','[]',1,'2023-08-18 09:17:22','2023-08-18 09:17:22','2024-08-18 09:17:22'),
('30856efd830f90e84b06773c88ec6d650f154df888b8ba242ed96648fe95d6bc2ea7b87420f84b11',3,1,'Laravel Password Grant Client','[]',0,'2023-01-19 12:19:08','2023-01-19 12:19:08','2024-01-19 12:19:08'),
('30859b4613946ad7d43a01fdd985865777d9bffbca1775755ec803c9ace9beae84bf38ea5965fb97',1,1,'Laravel Password Grant Client','[]',1,'2023-04-12 03:46:25','2023-04-12 03:46:25','2024-04-12 03:46:25'),
('309f7dad2658617e30eb5af84a666fe1f650567d18e82aec90ede6b6fcf864f58082450b352a9183',1,1,'Laravel Password Grant Client','[]',0,'2023-09-11 06:22:32','2023-09-11 06:22:32','2024-09-11 06:22:32'),
('30bf1886ef05f9d7b72501bcf965d0b916af3e1be776fd3b0fbe1701cf03ed98de810cc2bf59bf62',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:53:55','2023-08-25 09:53:55','2024-08-25 09:53:55'),
('31be415d28a622d3778bab8882404fdc59cd3a1372344aa6fd1f2bfa6c5d084396246e49d00d4a23',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 12:02:22','2023-08-25 12:02:22','2024-08-25 12:02:22'),
('3206507e2773838fdaa60c5c10b7c2004c8d3c7dbf95b94091b726b887854c1e425fd856acd2aa1d',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 12:05:56','2023-08-25 12:05:56','2024-08-25 12:05:56'),
('32154bbdfb47fe0fd67a9eb8e9121f6593f010f43622f4c1b7ba6708956ae1916cefc91cf9d024f8',1,1,'Laravel Password Grant Client','[]',1,'2023-05-05 11:33:38','2023-05-05 11:33:38','2024-05-05 11:33:38'),
('32bee8bf5d1053bf7247de17c792346d70a3b3c50ae95f720fcdae68648406c61658db82825146aa',1,1,'Laravel Password Grant Client','[]',1,'2023-08-25 04:58:09','2023-08-25 04:58:09','2024-08-25 04:58:09'),
('3357330eee7d3aeee26543457e989d075d1c4f4cfa6d8ac8175a8e94b897543f50696c28d338a322',3,1,'Laravel Password Grant Client','[]',0,'2023-06-24 09:15:44','2023-06-24 09:15:44','2024-06-24 09:15:44'),
('3433b2fd1842f2b987106f1df96950a9a23cb56449ed896623ff40b73a771d1858f357b311a80f24',1,1,'Laravel Password Grant Client','[]',1,'2023-08-11 05:51:03','2023-08-11 05:51:03','2024-08-11 05:51:03'),
('34d45d8ac697c4567c4968faec69d032949a42ff362e4fd1425862660438873b1cb92b60168e57a3',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 12:04:44','2023-08-25 12:04:44','2024-08-25 12:04:44'),
('34ea551c4a6b9e75dea7ad17d085a1aec76b29b93b33bae708a4e7a7d3c634ba043f6447f39e05f5',2,1,'Laravel Password Grant Client','[]',1,'2023-05-05 12:37:32','2023-05-05 12:37:32','2024-05-05 12:37:32'),
('3567ef4d27d3264c121425512a12c531179a6c03bbdd87c5a954fde0379e05b6fbcafd014a05a888',1,1,'Laravel Password Grant Client','[]',1,'2023-04-08 05:37:17','2023-04-08 05:37:17','2024-04-08 05:37:17'),
('35e352a63575b40febb865b6055655bbb4e6fa0908624c5cf028c5b38bcfc8cc0c0e42b299d9951c',1,1,'Laravel Password Grant Client','[]',0,'2023-09-13 03:47:09','2023-09-13 03:47:09','2024-09-13 03:47:09'),
('36702ac47189c59da2cd4d2212b15c2abcb2d8ff0f0b343828737c375c7e22bef9028ef5786da691',3,1,'Laravel Password Grant Client','[]',1,'2023-06-12 06:12:14','2023-06-12 06:12:14','2024-06-12 06:12:14'),
('375e472fa219f36533d03a67263f990a49c0d230e4d084e0a1779737ebc1d41ba26c3e3f1b7c4ec6',1,1,'Laravel Password Grant Client','[]',0,'2023-04-11 11:00:36','2023-04-11 11:00:36','2024-04-11 11:00:36'),
('386abc0ec3f0a17338227d3140bebc6cf456485f573e1be1ed8b8af09f4feab1a3e22537dddcbed8',2,1,'Laravel Password Grant Client','[]',1,'2023-07-12 07:01:04','2023-07-12 07:01:04','2024-07-12 07:01:04'),
('3883592fb7654a792712f9bbee642df651305e9d4d6558d98e4ba9adcdb4da5070e73e0e73455e4e',3,1,'Laravel Password Grant Client','[]',0,'2023-01-20 04:29:08','2023-01-20 04:29:08','2024-01-20 04:29:08'),
('3a2c9a33cd6e13ab20badc6fa95a61252fb37ee1d15d3a29b0cd5ee9bead34f036f66644f68d8aa5',1,1,'Laravel Password Grant Client','[]',0,'2023-04-04 10:09:42','2023-04-04 10:09:42','2024-04-04 10:09:42'),
('3a2f4bd9cd7d9c54638be0c389e93da193c0c5a3da4fb7658d419099d4aae8960da8654f78674216',1,1,'Laravel Password Grant Client','[]',1,'2023-07-13 09:04:21','2023-07-13 09:04:21','2024-07-13 09:04:21'),
('3c9b71104b91abef19f1bb81017b12dec29a55105216e2a16021dc74dca773e17451e91e4155d3cd',1,1,'Laravel Password Grant Client','[]',1,'2023-08-25 04:55:19','2023-08-25 04:55:19','2024-08-25 04:55:19'),
('3cc5e04c40903602cad390c9415f55669db75e252d35bc79051b9420430cf915dc52c1db9e6d6066',3,1,'Laravel Password Grant Client','[]',1,'2023-01-24 11:55:32','2023-01-24 11:55:32','2024-01-24 11:55:32'),
('3d98c927656fda2ac73fb901eb5a1b1ba1b6e1211d058ed75a5b2b31961ce30c85197822c41e502c',15,1,'Laravel Password Grant Client','[]',0,'2023-06-12 13:03:47','2023-06-12 13:03:47','2024-06-12 13:03:47'),
('3da192c61a56e4350a056a49afc9d2e50ce5755ac4c60aa1cd8e5124a68f5512182639eb2c91f404',1,1,'Laravel Password Grant Client','[]',0,'2023-08-18 03:54:54','2023-08-18 03:54:54','2024-08-18 03:54:54'),
('3f2ee089513b05014de2edfd02809a475bcb436b572820ae5985cf12ca476373beb4facd486d89aa',3,1,'Laravel Password Grant Client','[]',1,'2023-06-15 05:03:15','2023-06-15 05:03:15','2024-06-15 05:03:15'),
('401d91e098796377298320de407c5c961895f5944e33858e48e7d3628c742c442cfd2c6c80d0a122',1,1,'Laravel Password Grant Client','[]',1,'2023-01-27 12:48:14','2023-01-27 12:48:14','2024-01-27 12:48:14'),
('4111b48be124e4f94c1b7eb2f47f26c6d56f0d894b3cb2263edcd778f9493496a0a1b549afae5d34',1,1,'Laravel Password Grant Client','[]',0,'2023-09-11 06:18:23','2023-09-11 06:18:23','2024-09-11 06:18:23'),
('41f3a4b7c8a289fe0baa59187e7e6be1d55dba3342e11377ce16dbd5da1edbf9b7bf6a63d0d4df75',1,1,'Laravel Password Grant Client','[]',1,'2023-04-07 12:23:25','2023-04-07 12:23:25','2024-04-07 12:23:25'),
('4203400f1aa53932e4142c56f5384c60818c63f30e76bf3fcce9d17ab3b626df01ffbcce3f90137b',1,1,'Laravel Password Grant Client','[]',0,'2023-08-07 03:50:04','2023-08-07 03:50:04','2024-08-07 03:50:04'),
('42c340b7ad67a6dbe856ce14f181bf43e01d2b89eeb33f94e7f166d9fe4c127549bf3e6436dd6685',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 04:52:03','2023-08-26 04:52:03','2024-08-26 04:52:03'),
('431ed4d7922426c5823e14c144367a3e6d22fa9a031a6c0891e48f30ae4c40fb5e70a47d484685fa',1,1,'Laravel Password Grant Client','[]',1,'2023-04-12 03:43:22','2023-04-12 03:43:22','2024-04-12 03:43:22'),
('4345fec9dbcdfcc2573f5303dcf1869bcf2abb03bb5fc1d2ae7b0c2caea089529bae3cea220138e2',1,1,'Laravel Password Grant Client','[]',1,'2023-03-25 03:51:50','2023-03-25 03:51:50','2024-03-25 03:51:50'),
('4360188a77e12967ef7c7efcfa7042cca9db07403ac9ae7c4645217b991a7e73e0ca430ca2d704ac',3,1,'Laravel Password Grant Client','[]',1,'2023-06-12 10:17:49','2023-06-12 10:17:49','2024-06-12 10:17:49'),
('4363ea79e4f56d918da871848dcfdaee6d2a6a4aa19c4c3b77b28fc7996b43bc6c2c703833d3b763',3,1,'Laravel Password Grant Client','[]',1,'2023-05-05 12:52:04','2023-05-05 12:52:04','2024-05-05 12:52:04'),
('43665eb40065aad94967a675b0d41c7df89ca167ad4d0ae49ed8c28eafa82ed7b56142642ede42ff',3,1,'Laravel Password Grant Client','[]',0,'2023-01-19 12:25:33','2023-01-19 12:25:33','2024-01-19 12:25:33'),
('440cb4d6e4ef346b583d9f5ed2b8dc6f09153df3f27c9364854a3309bb60edcbfed7ef58cc4e24d5',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 03:54:07','2023-08-18 03:54:07','2024-08-18 03:54:07'),
('448e72465c580ad1c8b1d2a155f39083e186de5e132d9892bf24a850baa36f95ab2fcb1b61d7f1d7',1,1,'Laravel Password Grant Client','[]',0,'2023-09-02 04:14:57','2023-09-02 04:14:57','2024-09-02 04:14:57'),
('460d0260df392ddb25730ffa61760eea5c074014fc37d7f52e12c92fa5d828ed72f6343e1075a0f0',1,1,'Laravel Password Grant Client','[]',0,'2023-01-26 03:36:23','2023-01-26 03:36:23','2024-01-26 03:36:23'),
('46e7657c68aab697d59e6c3e81d5500276b98d012eb6fcf95a57858f266bc40cc116eea347291ec4',1,1,'Laravel Password Grant Client','[]',0,'2023-09-05 05:13:17','2023-09-05 05:13:17','2024-09-05 05:13:17'),
('471569a13d78941abdfc64597f238e009ac0536dd4545f2bbd80b67cc30903591b8bda2f40a01b5b',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 04:25:26','2023-08-18 04:25:26','2024-08-18 04:25:26'),
('475563bd052166c1f8e4deae0672df61d1b44002e8832000f79e12a6b023f42e761d3867890a2462',3,1,'Laravel Password Grant Client','[]',0,'2023-01-20 10:44:35','2023-01-20 10:44:35','2024-01-20 10:44:35'),
('475c23cf05718c6b8290d8f86827004b24e21453177116b16ede3b374dd0dd8d2e7df4666eddf40c',1,1,'Laravel Password Grant Client','[]',0,'2023-08-31 06:06:31','2023-08-31 06:06:31','2024-08-31 06:06:31'),
('47908af1f03eda104ca8d0ab2abd822ef96b03ca3449f81c8907d22ec36373f2e21ff90acbecb133',2,1,'Laravel Password Grant Client','[]',0,'2023-05-05 11:09:38','2023-05-05 11:09:38','2024-05-05 11:09:38'),
('49ab7ed28b4e33270dee2bfe7fbda5603cb268bda459f9d7e57c3922ab1ab531593355651117824f',3,1,'Laravel Password Grant Client','[]',1,'2023-06-21 06:39:53','2023-06-21 06:39:53','2024-06-21 06:39:53'),
('4a45ee0780131c6a413739a4a48a8250a5a8faada5ce0d14ce64054a5bc0bb6a89fea6a44a145241',1,1,'Laravel Password Grant Client','[]',0,'2023-04-07 15:19:57','2023-04-07 15:19:57','2024-04-07 15:19:57'),
('4ae28cc9fa6dcc5a79c9b77c0ff1c30eeba5e30992785f3838a162433b77ccc2cd9588fa93b50b50',1,1,'Laravel Password Grant Client','[]',0,'2023-04-07 12:18:48','2023-04-07 12:18:48','2024-04-07 12:18:48'),
('4b464a64545f3a046c94b95f3beeaa5113b909d6c8185716e509e4c35850f7ae1dd874557aa59440',3,1,'Laravel Password Grant Client','[]',0,'2023-06-15 08:57:40','2023-06-15 08:57:40','2024-06-15 08:57:40'),
('4c01da6126aa4357d869b1abb00873d12873ff8b32ad60adcdb72706404a100010cb97f0b450b2a2',1,1,'Laravel Password Grant Client','[]',1,'2023-08-11 06:35:03','2023-08-11 06:35:03','2024-08-11 06:35:03'),
('4c6400ecd612dca669604f8d3699d97898fbf3c1a1fce9d23b8778656e207f344937f274cc985807',4,1,'Laravel Password Grant Client','[]',1,'2023-06-13 07:33:47','2023-06-13 07:33:47','2024-06-13 07:33:47'),
('4c76e11efb325737983cb36c4076ad2529163a032760cca7a545f559110cb68a278fc6d142049211',1,1,'Laravel Password Grant Client','[]',1,'2023-08-02 04:35:27','2023-08-02 04:35:27','2024-08-02 04:35:27'),
('4df3c776439bfacb81c1fcf633170920305155a82ce418c37d226dfad2bd82e0ad9f1380b9d5910b',3,1,'Laravel Password Grant Client','[]',1,'2023-06-24 06:17:39','2023-06-24 06:17:39','2024-06-24 06:17:39'),
('4e3180669897e0a8d3156afebd7a93a6f593f1e1228dbdf52338c7fac8cf25773d4f3393907a4ab9',3,1,'Laravel Password Grant Client','[]',1,'2023-06-24 07:00:15','2023-06-24 07:00:15','2024-06-24 07:00:15'),
('4e73ae1d95585185b399d3c0e1d655abc34124f482a10655be8ed60346afed61ca33f9a464fa1b57',1,1,'Laravel Password Grant Client','[]',0,'2023-04-05 06:07:28','2023-04-05 06:07:28','2024-04-05 06:07:28'),
('4e7a485767109728fc1d934085bee0859c98cca5a0060f0bdcec0ac1563d528c8a0fdc9ef37e1368',1,1,'Laravel Password Grant Client','[]',1,'2023-04-08 05:36:46','2023-04-08 05:36:46','2024-04-08 05:36:46'),
('4ead3a461aa3de4d149ae3583933fe70ed82199ab29523ace6de4c5bb12a09499364985307776e9c',1,1,'Laravel Password Grant Client','[]',0,'2023-09-11 06:08:19','2023-09-11 06:08:19','2024-09-11 06:08:19'),
('4f9673e9764053eca82e5f610f31f845a5806224f17f7ce8b74455ed400c64828072928bae7b5e17',3,1,'Laravel Password Grant Client','[]',0,'2023-06-27 11:56:51','2023-06-27 11:56:51','2024-06-27 11:56:51'),
('4ff5a48131cd073142b918f19577086a4a1e024d869c02e87434a8144fab7ea835ca0d6de52961c7',1,1,'Laravel Password Grant Client','[]',0,'2023-04-08 06:01:56','2023-04-08 06:01:56','2024-04-08 06:01:56'),
('503aa91e6dc805a22e99c2a8abb60346e1824cbf515fa69c62077f28a23a8472c1098d509044d42a',1,1,'Laravel Password Grant Client','[]',1,'2023-04-04 09:15:23','2023-04-04 09:15:23','2024-04-04 09:15:23'),
('50b006c1b5daaf11088bc82a86a4feaf558ba8a885b5cbf5174ec0d65f95726bc61133ec30d171e6',1,1,'Laravel Password Grant Client','[]',0,'2023-04-07 12:58:40','2023-04-07 12:58:40','2024-04-07 12:58:40'),
('5205e8663e5341b68c84b7e9f2bffef74a94f43fdc245606d89df5b81918b680b66cd00642893d57',1,1,'Laravel Password Grant Client','[]',0,'2023-08-18 04:09:14','2023-08-18 04:09:14','2024-08-18 04:09:14'),
('52f75dac08d232703ca2e9f6deb96221f79dece9940fa01df1143578fee06c08f5483acbe6a087b6',2,1,'Laravel Password Grant Client','[]',1,'2023-07-12 06:19:23','2023-07-12 06:19:23','2024-07-12 06:19:23'),
('5337507501cfbf85dc80d8245a7976547ea6f9d73cf0de0f7fa0df963d85887a23683b2cd924a57f',1,1,'Laravel Password Grant Client','[]',1,'2023-04-05 12:06:43','2023-04-05 12:06:43','2024-04-05 12:06:43'),
('53efeee52935ad05d9cab019c64c994df9d4d4590c676de186880bb08a6f841ca475bbfc3f9c8f65',3,1,'Laravel Password Grant Client','[]',0,'2023-06-16 10:28:48','2023-06-16 10:28:48','2024-06-16 10:28:48'),
('54339562ba0aadf288d3d83309293ed16fe5f6bc8ef6391887223ae32a89005af60de2bdf822791a',7,1,'Laravel Password Grant Client','[]',1,'2023-08-21 12:08:26','2023-08-21 12:08:26','2024-08-21 12:08:26'),
('54e8b460ebe2bcbfa2896eddba9755fc33aa6aee3af01c01e9a56f6e8e4ef862fd776122fb055a0d',6,1,'Laravel Password Grant Client','[]',1,'2023-01-31 05:53:33','2023-01-31 05:53:33','2024-01-31 05:53:33'),
('5558e5d89767f4f4e3e60525a3efa4c8b7bfc059224e94be5bca3d8cd741d87ecb2a513f35b95973',3,1,'Laravel Password Grant Client','[]',1,'2023-06-16 09:38:38','2023-06-16 09:38:38','2024-06-16 09:38:38'),
('55c2e0f168d985f3afc4cc405f0c5b168f3d17eebd37016dcc8cc2b5904c8a7cdf22fb0938f7c4ee',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 05:01:04','2023-08-26 05:01:04','2024-08-26 05:01:04'),
('56cb13d898dc7c00f910f150176270f755599e918bc24f7f73f9092960165d9a5b8c29affabcfdc5',1,1,'Laravel Password Grant Client','[]',0,'2023-09-12 06:17:10','2023-09-12 06:17:10','2024-09-12 06:17:10'),
('57ccafd8c264dd97603239697ccac68643f3ee03c4ea29a91711e76102f905b417e45c8bc1102c61',1,1,'Laravel Password Grant Client','[]',1,'2023-08-26 04:22:15','2023-08-26 04:22:15','2024-08-26 04:22:15'),
('57ddbdef6c6ae353143af7c4640a0706974c8ab818904fe85b08a9bf663ca06b1c2f4a26a6e0063e',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:08:29','2023-08-25 09:08:29','2024-08-25 09:08:29'),
('582d4c2e4225309c78118154b58268a5393dc90eef22a18f7cc52d36db63f678b386a5059a7d2317',3,1,'Laravel Password Grant Client','[]',1,'2023-02-07 12:23:11','2023-02-07 12:23:11','2024-02-07 12:23:11'),
('58d9b1c0b815e191fafa04dd44de04a236734bbc600a160d01e519331b05f91e0fc1586742e670d7',1,1,'Laravel Password Grant Client','[]',0,'2023-08-18 05:57:10','2023-08-18 05:57:10','2024-08-18 05:57:10'),
('59e9b0bbab70dd70c5c04ae8cc794b811835147f4538339adfa96bf64d45c424283f9117b74c1222',1,1,'Laravel Password Grant Client','[]',1,'2023-03-25 03:50:09','2023-03-25 03:50:09','2024-03-25 03:50:09'),
('59fcfdbcedf859a157422fc7ad6adf32592e9cc4976aa4eb39a84ef1558dafb74f03973186f8d8ad',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:56:34','2023-08-25 09:56:34','2024-08-25 09:56:34'),
('5a1e00630d0f5a67b84f8bbeaf2b50c5b82104e21b35d87f95d4832f09668d87b9aaf3b51bc4e694',3,1,'Laravel Password Grant Client','[]',1,'2023-06-12 10:19:08','2023-06-12 10:19:08','2024-06-12 10:19:08'),
('5a6f8fd3b2de7c20a4a5d8866efe41d34ee8cbf4b640a74333ba68723a0faed7b542fad5765ad80b',1,1,'Laravel Password Grant Client','[]',1,'2023-04-07 12:24:12','2023-04-07 12:24:12','2024-04-07 12:24:12'),
('5b909461824978857340784e30298f5c2913bf506a7d384f975995238bee967d8b08e23c305fc440',1,1,'Laravel Password Grant Client','[]',1,'2023-08-11 03:55:39','2023-08-11 03:55:39','2024-08-11 03:55:39'),
('5b9e00ec1335566a73f92bd6afd525bef3b90accd79d47fbfd87007dc0977d594247a4de2bb0d888',1,1,'Laravel Password Grant Client','[]',0,'2023-03-27 12:26:04','2023-03-27 12:26:04','2024-03-27 12:26:04'),
('5bb4732ead7af031a59d5b7f9f199327a752a5e8b0b51660c29675edd54f681e405f5958b19d7bc7',1,1,'Laravel Password Grant Client','[]',0,'2023-08-18 09:30:17','2023-08-18 09:30:17','2024-08-18 09:30:17'),
('5c203f3f7e1419efc4b1d91aa56f3978d6ab31a742785d2e609497c82a5c988940c52deb050a8636',1,1,'Laravel Password Grant Client','[]',0,'2023-08-18 04:07:37','2023-08-18 04:07:37','2024-08-18 04:07:37'),
('5d0f652545a12d57bac8a4cade3997c2e2df9628b9d5fa9463c2c27bb1276141635e89272ea42aab',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:58:20','2023-08-25 09:58:20','2024-08-25 09:58:20'),
('5e57657ab000c6e62f28ab0153fd8a84a9e7ebfeed520a7be7adde37b024ffbda521cccbcf0d246d',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:11:34','2023-08-25 09:11:34','2024-08-25 09:11:34'),
('5eda1c4e87337b7d7941a37929846cf617a0a771fddd8f67bc73580d6c206675322aba2e2caef2e4',3,1,'Laravel Password Grant Client','[]',1,'2023-01-26 03:52:35','2023-01-26 03:52:35','2024-01-26 03:52:35'),
('5ee099451577183cc145ca9d04894a34001cc50d9b9fba825900fc631cd6c3a006b96896d3c5160e',1,1,'Laravel Password Grant Client','[]',1,'2023-08-24 03:48:05','2023-08-24 03:48:05','2024-08-24 03:48:05'),
('5f96d6983dbe86ba1162e7560b70bfa4c9b249df2fa73143ffc9a6576bb58063e4a6fd396ec77ef3',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 05:56:25','2023-08-18 05:56:25','2024-08-18 05:56:25'),
('5fadd72b00594a3550d76d5ce108c9eb781b2304661448ae5222c96099a322177dd32a531040536c',1,1,'Laravel Password Grant Client','[]',0,'2023-08-24 08:35:34','2023-08-24 08:35:34','2024-08-24 08:35:34'),
('5fe5c4616265bf64665947dc34614b4548073c2f6e6e44fcf73b5a44c211c80c0e89ab963f7ae249',3,1,'Laravel Password Grant Client','[]',1,'2023-05-16 12:47:58','2023-05-16 12:47:58','2024-05-16 12:47:58'),
('606dc9fc3fca2eb040718c3c9aba1795cf3212d31720055d57c5d0ff058baa0b9d699d4759ac5552',5,1,'Laravel Password Grant Client','[]',1,'2023-08-21 10:10:31','2023-08-21 10:10:31','2024-08-21 10:10:31'),
('607add8f23475b2a9f2dc6cbcb0fdcce03367255744fd5abfedc720faad56556f35fe2e77cac9277',1,1,'Laravel Password Grant Client','[]',1,'2023-03-24 10:24:21','2023-03-24 10:24:21','2024-03-24 10:24:21'),
('60a43afc0066f88b1f1f6dc3db1807b5a0c5cb4e38977de1010d7cc18f84ceff7c73386ca0f016ce',3,1,'Laravel Password Grant Client','[]',1,'2023-06-12 06:08:49','2023-06-12 06:08:49','2024-06-12 06:08:49'),
('60d64971cf2b66f460e0f31e31afa0571a705dca0830ed017cc456c2c65a224d58daa6122928af55',1,1,'Laravel Password Grant Client','[]',0,'2023-07-08 03:56:10','2023-07-08 03:56:10','2024-07-08 03:56:10'),
('616abd95d0dadf276999aa7887fbe1289a6874f33d469a8325a8a751f846ea3d80e5d15c29024708',1,1,'Laravel Password Grant Client','[]',1,'2023-02-07 06:58:06','2023-02-07 06:58:06','2024-02-07 06:58:06'),
('62bd667549f5cf633d8d1a50bedfdd14d1ad0277a590c6553cd3e872bad14766f1c34bf4fbd74a99',2,1,'Laravel Password Grant Client','[]',0,'2023-07-07 05:36:46','2023-07-07 05:36:46','2024-07-07 05:36:46'),
('62ef1cf991208d16c150254e984427d5d241d27eff17b9c02b206911a192264d40908477b81b9df5',1,1,'Laravel Password Grant Client','[]',1,'2023-08-10 04:04:13','2023-08-10 04:04:13','2024-08-10 04:04:13'),
('6353457b66bae64a7b1576ce65be90a17f78a5692c22987aba0b4dc1941de2659ade46b06a8610c6',1,1,'Laravel Password Grant Client','[]',0,'2023-04-10 03:53:01','2023-04-10 03:53:01','2024-04-10 03:53:01'),
('6363f3c237b58b5fdfc727102f85c19609f8de841d8a7c8fb99c1c06f42f6094c26ff9fcd306c233',1,1,'Laravel Password Grant Client','[]',0,'2023-08-16 06:17:58','2023-08-16 06:17:58','2024-08-16 06:17:58'),
('63d20ce75a51061ee9da39c8acbb5f99cf423c610b19f2d342a385456f4453341fa0f4797c264ec7',2,1,'Laravel Password Grant Client','[]',1,'2023-02-05 15:36:37','2023-02-05 15:36:37','2024-02-05 15:36:37'),
('64fc51c933845e680643d2f3b94bc58cae121f4139b8825deb104358bafd16b29c9239093a2a215c',1,1,'Laravel Password Grant Client','[]',0,'2023-03-23 06:35:44','2023-03-23 06:35:44','2024-03-23 06:35:44'),
('660284f563ed55f111053c058139389a37171fb79952942c50c4e723a4d5c7e973eb677bef496a4f',3,1,'Laravel Password Grant Client','[]',0,'2023-06-23 12:24:03','2023-06-23 12:24:03','2024-06-23 12:24:03'),
('660b8bb859ac61c34dff739cd188b52e18976b0a4b803f4141cb7c96e7f1d1966ff4369872bcf341',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 10:00:20','2023-08-25 10:00:20','2024-08-25 10:00:20'),
('665a06b26628e5821ffaba1d1f28563e54a11cb724e6f4694dbb9194a40cd98358a16f42cb03fbbc',1,1,'Laravel Password Grant Client','[]',1,'2023-07-11 06:59:17','2023-07-11 06:59:17','2024-07-11 06:59:17'),
('66bf7a5aec74f1e7a55de5bba00cbca0e53c7e067337b54864f97011005c62fbd9fe9519b09319f1',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:08:26','2023-08-25 09:08:26','2024-08-25 09:08:26'),
('68ce272aec4f71fbd122906bf31a34b30eebb49a8ed7360df47ffcca76150169d8bfe9b28bd0f85c',2,1,'Laravel Password Grant Client','[]',0,'2023-02-07 07:31:29','2023-02-07 07:31:29','2024-02-07 07:31:29'),
('69746e6566d4f5a5c050cf9b7dc992743da85fd3aef335b0fde3831e64da7469960878c1feb68a94',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 04:19:22','2023-08-18 04:19:22','2024-08-18 04:19:22'),
('69a1422ec988a177eb04bd55c593f329c47577fb13252aa0d37249788f121c6b99dae4aa36d1b25c',1,1,'Laravel Password Grant Client','[]',1,'2023-08-11 05:49:43','2023-08-11 05:49:43','2024-08-11 05:49:43'),
('6b555911b4587c329a07694a33f04bdb3ff5cbd4611bf10e83dce5b986d274380663b784019191a3',3,1,'Laravel Password Grant Client','[]',1,'2023-06-21 03:55:13','2023-06-21 03:55:13','2024-06-21 03:55:13'),
('6b5c7ccc5569a604ed29589e2445038ec6c17bb03152f976b807c63627da5791d30f0d30fc57c3bb',1,1,'Laravel Password Grant Client','[]',0,'2023-08-29 04:21:17','2023-08-29 04:21:17','2024-08-29 04:21:17'),
('6c438e8c1e23cb822276a45cc74f2677dae3bf782ce2dcefdcecc760bd63e276b9c643a1a1f115fa',1,1,'Laravel Password Grant Client','[]',0,'2023-07-10 10:46:53','2023-07-10 10:46:53','2024-07-10 10:46:53'),
('6cfbf213ee65eb78634442f4c02d7e95b8865c35997ad156313eb28fd81bc88cfb377a5a41e768ee',1,1,'Laravel Password Grant Client','[]',1,'2023-04-05 12:08:05','2023-04-05 12:08:05','2024-04-05 12:08:05'),
('6d4b03c5522a0090aa41ee67869c6ce96d1d5e59d705f3fe01413062e1495af2d340fc77da61b9ff',1,1,'Laravel Password Grant Client','[]',0,'2023-08-02 07:33:22','2023-08-02 07:33:22','2024-08-02 07:33:22'),
('6d59dc55eaac49e1d9bf43aeee3236257922874f10ee30fa56ed1fd3062f8a0fcd99fb326ecb70bb',1,1,'Laravel Password Grant Client','[]',0,'2023-04-04 03:39:32','2023-04-04 03:39:32','2024-04-04 03:39:32'),
('6fc80ce3195a3c8b7826eded339bd545f57a3240b52c63abf74ed95b2d4f2904599ed79e6c73163f',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:08:33','2023-08-25 09:08:33','2024-08-25 09:08:33'),
('7051287aced340c53159f5cca624f3933530a14d937ec1766d584deb13a946a188cf205795baf476',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 05:49:48','2023-08-18 05:49:48','2024-08-18 05:49:48'),
('736acb9ba245a12edd0039fb5b0d842f934eb89362b49a341014f16cbc67ff82a5ca37f4ddbbcf37',3,1,'Laravel Password Grant Client','[]',1,'2023-06-21 06:25:00','2023-06-21 06:25:00','2024-06-21 06:25:00'),
('73999cb2fcb78ddad1408ceb68345f122182c9e291167578348683010d3b30ca01517909aa7c85e5',1,1,'Laravel Password Grant Client','[]',1,'2023-08-24 06:37:40','2023-08-24 06:37:40','2024-08-24 06:37:40'),
('74a0e015e9f15a58a9fc435538deebe4b0721b11c80b571061b01193db915557e68723399d79fa3d',3,1,'Laravel Password Grant Client','[]',0,'2023-07-04 08:58:22','2023-07-04 08:58:22','2024-07-04 08:58:22'),
('74c48a434e6b5664461653b2cedc36c6ab97766219f15608524d7a4cade1379a4874659dcffcdcbb',3,1,'Laravel Password Grant Client','[]',1,'2023-06-20 09:48:51','2023-06-20 09:48:51','2024-06-20 09:48:51'),
('7689eb37c2123a02defa4fd83ed8b9f6e300da556ec02479cad908fd6a9f027ed5a74e86187872f3',1,1,'Laravel Password Grant Client','[]',1,'2023-04-07 11:46:55','2023-04-07 11:46:55','2024-04-07 11:46:55'),
('7696da019ae7e7919dd0ed56564c82608ae1a7e9e466c2965feb9e65ba3477e806926b9a85cc0105',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 12:06:46','2023-08-25 12:06:46','2024-08-25 12:06:46'),
('777acf421aeca355d4c59aa4b2fe5493f722978f8c8c787d11e3ff270a97f75fbc616e9842124b2d',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:58:50','2023-08-25 09:58:50','2024-08-25 09:58:50'),
('77e6536d774d85f906405b244694aeaef465fd00d55ea7d403f9c48ca4aa346dec235024cf8fb043',1,1,'Laravel Password Grant Client','[]',0,'2023-02-10 04:42:29','2023-02-10 04:42:29','2024-02-10 04:42:29'),
('782ab8eb64319cdca02e90768c44b632f2771936b106d177b59e7a1c30830ce44f85ec5f646045fe',16,1,'Laravel Password Grant Client','[]',1,'2023-06-14 04:38:14','2023-06-14 04:38:14','2024-06-14 04:38:14'),
('787cb677e57f7fe24421241aa916233f44d6f116783746f250585a5474bbc11184455a1946d64622',2,1,'Laravel Password Grant Client','[]',0,'2023-04-18 08:06:48','2023-04-18 08:06:48','2024-04-18 08:06:48'),
('7930b65af76ca52affa710075fa69d5ce15b9c9fc43547aa2864fc54eaa4d8b12ac431cb5c25ff5d',1,1,'Laravel Password Grant Client','[]',0,'2023-03-27 03:44:42','2023-03-27 03:44:42','2024-03-27 03:44:42'),
('79465e3dbf69168a148548f3e8d821ee41244f4c532fc4822052793164252438a40597ad521045cf',3,1,'Laravel Password Grant Client','[]',1,'2023-06-16 09:38:14','2023-06-16 09:38:14','2024-06-16 09:38:14'),
('794fc7a68d79e27ea8a5e3222f63bdf4230896ac6ffe812fb16c7faa0eacd317d44ba6d62953d4ed',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 04:14:13','2023-08-18 04:14:13','2024-08-18 04:14:13'),
('79760f2efca19cbb2b44daee041ff2f67dfe4355d9c3da3905d57f4ee9081cac545dc11bbc01c065',1,1,'Laravel Password Grant Client','[]',1,'2023-08-24 04:29:42','2023-08-24 04:29:42','2024-08-24 04:29:42'),
('7bfb3d1a3b58c427dcd1940c5ddbe7e816dffd595eacbe79ef352a27f90722a32326f89f09f1dd56',1,1,'Laravel Password Grant Client','[]',0,'2023-08-10 06:16:25','2023-08-10 06:16:25','2024-08-10 06:16:25'),
('7c047cb187339d16beed34a67c03bdc6312a5146b4722cc618f6484bfd62d47391d017f8f82bb78e',3,1,'Laravel Password Grant Client','[]',0,'2023-06-14 05:47:51','2023-06-14 05:47:51','2024-06-14 05:47:51'),
('7c1d167021d9ca1c0bc7503e27b569c9ef3633810c3637a79a49dd4f2f6fefa3a51cada373461ec2',3,1,'Laravel Password Grant Client','[]',1,'2023-06-12 09:32:38','2023-06-12 09:32:38','2024-06-12 09:32:38'),
('7c78139b8070cb54590b29f47d4637af0053b348181fbd0217af5147717fd6f618674904e3a1f465',1,1,'Laravel Password Grant Client','[]',0,'2023-08-18 04:06:32','2023-08-18 04:06:32','2024-08-18 04:06:32'),
('7cfcee02169ca106f815de8501b9b0efe17dc0d064ad9e9d75bfe689f5d1eb061135d629b2bcd6d2',1,1,'Laravel Password Grant Client','[]',0,'2023-07-11 08:43:36','2023-07-11 08:43:36','2024-07-11 08:43:36'),
('7df9d0be6992dd0b9aeea8977bf0fdc72f29ebcca1bbeaa195cfe470f13e251bcbdb513602378fb9',1,1,'Laravel Password Grant Client','[]',1,'2023-04-08 06:00:18','2023-04-08 06:00:18','2024-04-08 06:00:18'),
('7e1ed8a42f7e4425e4c8fc0d1799bcc5a8981bc62c84795e024e32ae3d8ea50c6a792d10ddcf3710',1,1,'Laravel Password Grant Client','[]',1,'2023-07-11 06:00:21','2023-07-11 06:00:21','2024-07-11 06:00:21'),
('7e86eba5437ee570019eca1d03dc33556a5269de7bc924a6839259a252ad6b117734440362e7a95b',1,1,'Laravel Password Grant Client','[]',1,'2023-04-08 06:00:52','2023-04-08 06:00:52','2024-04-08 06:00:52'),
('7edcdc3ba03d2d462052e6338417901b4670b2f22e62be45c8e680e72a789c75584115e0dc14f01f',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 04:20:09','2023-08-18 04:20:09','2024-08-18 04:20:09'),
('7f370a68fe4830dac270d61c2c67cd123c03bf98a1148d7f961155a290467b38685e9c1ef3be464b',3,1,'Laravel Password Grant Client','[]',1,'2023-01-19 10:21:40','2023-01-19 10:21:40','2024-01-19 10:21:40'),
('7fd67fb96dff326f97c55f590473fbdbfa5832e67ad20ce13ffdc2a9783d8bbe0a11ea9efb0eb5ba',1,1,'Laravel Password Grant Client','[]',0,'2023-07-24 05:44:18','2023-07-24 05:44:18','2024-07-24 05:44:18'),
('80326b85a6f1ce01372fcc51a89e98e5244f5c4c6c5e6cb3f51a2cdaeb263824a6b189d2bc39ce48',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:58:18','2023-08-25 09:58:18','2024-08-25 09:58:18'),
('807b33e6afec8a2232adac85a7517aa9a4467bfb7dde70fa4df6dcaf6d0b3120c0c338389bd757b0',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 04:17:07','2023-08-26 04:17:07','2024-08-26 04:17:07'),
('80bb5b9dfbf6861a3c6bfc14047ce86a1debbc2711b30d3deb356ad868f4e374229d05f90ca04159',1,1,'Laravel Password Grant Client','[]',0,'2023-09-01 03:58:17','2023-09-01 03:58:17','2024-09-01 03:58:17'),
('823af11a42190d9f30b9d1c4ae5ae9d827435d1ba3597942b403e5d4083c5618c616e6afee2bf453',6,1,'Laravel Password Grant Client','[]',1,'2023-08-21 10:12:16','2023-08-21 10:12:16','2024-08-21 10:12:16'),
('82f9179050bd9e472ff48212924f11799c1ab67571dd78e8518ac2d20deb31177323e1ca6f9b315a',1,1,'Laravel Password Grant Client','[]',0,'2023-08-31 08:48:18','2023-08-31 08:48:18','2024-08-31 08:48:18'),
('843bd7290b9a52babd92e082b36ddd39319f280e5f869cc4af2fd5828d41727b545544dbef84426b',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 04:11:06','2023-08-26 04:11:06','2024-08-26 04:11:06'),
('850e9b0665bcee13b0f5fabc9d81d238e3cebaae45929079edb821a4847877bdbdd4a474f6db13c4',1,1,'Laravel Password Grant Client','[]',1,'2023-07-24 05:07:35','2023-07-24 05:07:35','2024-07-24 05:07:35'),
('856dec8e0a2193db5b59f40faabf66b0ed2e8895be9e6b24ebe890b9afff0c305a44e034305d6317',3,1,'Laravel Password Grant Client','[]',1,'2023-06-13 06:07:54','2023-06-13 06:07:54','2024-06-13 06:07:54'),
('85a2a40f9d19b79c22c8762ef3251b4501169c139daa9f1e91db0cf96615d09c6bcad495cb4544d7',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:08:34','2023-08-25 09:08:34','2024-08-25 09:08:34'),
('8685627bf954742dbf8fc25f18a5764fe5a18b5b6f2b4b0d2f8a6bbf5c3e9594d174709c5ae922d6',1,1,'Laravel Password Grant Client','[]',1,'2023-08-26 11:38:19','2023-08-26 11:38:19','2024-08-26 11:38:19'),
('8697a01f6c509da1ab05ad524f4fb69d1a93fd10f5b55825481a9ad54ddaf2eb6a0c23720cd39b83',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:12:06','2023-08-25 09:12:06','2024-08-25 09:12:06'),
('87bd3307638031a190f3f76e8ddc65974b67a7af33500ffd4873fe6f4d2231ee75b903bb3cf91f75',2,1,'Laravel Password Grant Client','[]',1,'2023-08-21 04:41:10','2023-08-21 04:41:10','2024-08-21 04:41:10'),
('89b29a5d95df11926be8ddd039a76b1ad6a5972ca2adc0b0e508939fc85df3c70066102b903edc54',3,1,'Laravel Password Grant Client','[]',1,'2023-08-18 09:21:43','2023-08-18 09:21:43','2024-08-18 09:21:43'),
('8bdbc0776f98c3972f2d9dd57db44a97efef5432974af765efa4d572717d1fd619e54bdcc3337dd9',1,1,'Laravel Password Grant Client','[]',1,'2023-02-07 06:55:52','2023-02-07 06:55:52','2024-02-07 06:55:52'),
('8bdd45ae1d783d72dcf4df980436b5f379d1905f5951916fbbf723f99b1cf3f1fd6e3de792eb9103',1,1,'Laravel Password Grant Client','[]',0,'2023-07-11 03:46:37','2023-07-11 03:46:37','2024-07-11 03:46:37'),
('8c04d229063623e858ee66e6a4072551ef4d20d3f4d6ae7560a1f480d8c7f17314f9e290dd23e1fc',1,1,'Laravel Password Grant Client','[]',1,'2023-08-25 05:47:52','2023-08-25 05:47:52','2024-08-25 05:47:52'),
('8c60ea3e2938c1eee035836b4153dc8c5594816047f74c764e211be11f308be956b8603997f30b96',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:50:35','2023-08-25 09:50:35','2024-08-25 09:50:35'),
('8c863d93a3db23a9f6b60f56dffc9d42f4b16bda38d81c50608c13c8f73e77de805bf686ad0540a1',3,1,'Laravel Password Grant Client','[]',1,'2023-06-12 10:21:45','2023-06-12 10:21:45','2024-06-12 10:21:45'),
('8db2c5edd2987259cb0cd885fa1ad405f404752d95adf83ca51f7ec4c02360b5045b0f1f64144761',1,1,'Laravel Password Grant Client','[]',0,'2023-08-30 04:18:24','2023-08-30 04:18:24','2024-08-30 04:18:24'),
('8e00c9efe067d58028d010291b538bdbb49d18cb81c564488312ba491e93e21718b22eb6d427f4d5',1,1,'Laravel Password Grant Client','[]',1,'2023-08-21 04:11:49','2023-08-21 04:11:49','2024-08-21 04:11:49'),
('8e7cebd783fc4e02758b353e050e12d38fed7cd16d9b607803934dddef067fb18f5f3caf5303d61f',1,1,'Laravel Password Grant Client','[]',1,'2023-04-08 05:53:41','2023-04-08 05:53:41','2024-04-08 05:53:41'),
('8f163146ba92daac581575c1441234c801de47f06c0f9ad50ff9b44f96655f72ddecc01516d6a019',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:08:36','2023-08-25 09:08:36','2024-08-25 09:08:36'),
('8fac8cbc474b167503f71a9cf81d2f87c9af29d24d1d55c01b65b2420d1af5ef7f2db6d916638381',2,1,'Laravel Password Grant Client','[]',1,'2023-07-12 05:53:35','2023-07-12 05:53:35','2024-07-12 05:53:35'),
('904f8fa57023e17df196c1cf30fe22dca2f0ef329a8a91660d41fe73958aec95634eb577746da4dd',1,1,'Laravel Password Grant Client','[]',0,'2023-09-05 09:47:21','2023-09-05 09:47:21','2024-09-05 09:47:21'),
('909aa784a296b65abf72b40eecc10ec6877f23dd1f4f66d593b12e68b5457defb477d2938108d487',4,1,'Laravel Password Grant Client','[]',1,'2023-02-07 12:26:50','2023-02-07 12:26:50','2024-02-07 12:26:50'),
('910e0d7e5dd837a28253ebe1eb6823346eef94b63e32bc9f2619fae4bfc26299565a6b10e30c642d',3,1,'Laravel Password Grant Client','[]',1,'2023-06-16 09:41:44','2023-06-16 09:41:44','2024-06-16 09:41:44'),
('9182b11206f2ab832b4a888e1b819f4e4edb5c553a27dd649e8166ae787c44e18fcfa025daa01b88',3,1,'Laravel Password Grant Client','[]',0,'2023-06-27 11:52:01','2023-06-27 11:52:01','2024-06-27 11:52:01'),
('928ae9dc1774cc9ce5e197e6724378fe8fc7e35aef005a0d830054c608b3d451879bc5397145edd0',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 08:53:41','2023-08-26 08:53:41','2024-08-26 08:53:41'),
('93128baf72485df8aa1bf5dfacff9e3d251084ff161f5df0d728518cf3b04a605278cdf2cbc0288e',1,1,'Laravel Password Grant Client','[]',0,'2023-08-18 04:18:54','2023-08-18 04:18:54','2024-08-18 04:18:54'),
('958c69588b1a11733a660de6372281f84bec991dd9fe5a82481e566c612e9670c59f617186d4db35',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 04:27:50','2023-08-18 04:27:50','2024-08-18 04:27:50'),
('9716f7f4e947806963fe5f7a8287a372e839aae63a740e2101f209410ffa5b0aa7bc8ab56e471101',1,1,'Laravel Password Grant Client','[]',0,'2023-08-24 08:43:50','2023-08-24 08:43:50','2024-08-24 08:43:50'),
('976bae5435ac4e78595f20bb2fb4e3daa13b5253b788dd771b11e907e6e7f9771daa8d7a186d7d90',1,1,'Laravel Password Grant Client','[]',0,'2023-08-01 12:05:38','2023-08-01 12:05:38','2024-08-01 12:05:38'),
('97a3f83b066e55bcec727626ae8425b6dd0dbe9cf5cf515b6ab2a79fabbba228b75357f1cea385ac',1,1,'Laravel Password Grant Client','[]',1,'2023-08-21 03:52:01','2023-08-21 03:52:01','2024-08-21 03:52:01'),
('97e94ec4f64d46aa2a68acfc29161f186c6d34cf04dc8334c5443d00fbd63c1ae98d9cb072599ec3',1,1,'Laravel Password Grant Client','[]',0,'2023-03-22 09:57:21','2023-03-22 09:57:21','2024-03-22 09:57:21'),
('98161e8c562bad7d187da5a6d05ac3f5e71438147ea03765ee87ee192090c0bd6b6254a119eff095',1,1,'Laravel Password Grant Client','[]',1,'2023-08-25 04:00:51','2023-08-25 04:00:51','2024-08-25 04:00:51'),
('988c1a0654d203452c33d4f2a2847d073653f960ec19167d03c9eb3e7062d8b12ec1c263fca2de6a',1,1,'Laravel Password Grant Client','[]',1,'2023-04-25 12:54:20','2023-04-25 12:54:20','2024-04-25 12:54:20'),
('995449183ac99fa62e07edc863c0c7b6e5101ed2281748080f85ec736d70dc2cb940fc9f6a963249',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:53:49','2023-08-25 09:53:49','2024-08-25 09:53:49'),
('99660653f41aa9760d335c3636330889250ede2178f56bc6592e66d9465016dcc2344ff43bc2d0f5',1,1,'Laravel Password Grant Client','[]',0,'2023-07-31 08:36:07','2023-07-31 08:36:07','2024-07-31 08:36:07'),
('99a7baed0408316f7c42bafa9e9d822da5dc62bc662c0bf775be9ce79d94e21b58667ba26e4af297',1,1,'Laravel Password Grant Client','[]',1,'2023-04-05 10:42:44','2023-04-05 10:42:44','2024-04-05 10:42:44'),
('9a044180228d51637c52b38d0e05ddfa3e9db2b6390f1401ca1f722e2bf5f179d525afa1925a1305',9,1,'Laravel Password Grant Client','[]',1,'2023-02-03 11:47:05','2023-02-03 11:47:05','2024-02-03 11:47:05'),
('9a4c6717d9f91dd87c9d0eb7e32778be21fd84b9fa98b8ac2cc9f9bad18b2f473f9f56ca0b299b38',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 05:02:30','2023-08-26 05:02:30','2024-08-26 05:02:30'),
('9c20221d7b6a6bc232d7f18394580c4f2f8d41e6a89e087ccff96b62aefa00bc520c41b59365b655',3,1,'Laravel Password Grant Client','[]',0,'2023-06-16 09:42:47','2023-06-16 09:42:47','2024-06-16 09:42:47'),
('9c35cf920bed50366901cf378364a9f56cca4b33028276274ce3d92f335f7a1a70e6f9a3addcdbde',1,1,'Laravel Password Grant Client','[]',0,'2023-04-02 14:58:13','2023-04-02 14:58:13','2024-04-02 14:58:13'),
('9d4261ea0ecc6e82f7187c49ad080451da986baef8f99d29d34b0d7bb9490c5b1a9b7868467001bc',1,1,'Laravel Password Grant Client','[]',0,'2023-09-11 06:17:14','2023-09-11 06:17:14','2024-09-11 06:17:14'),
('9e757016a800f263c62b979108dbe149ed6dad23153078f64b292ae8c4c241e83fa23f1eded8d881',3,1,'Laravel Password Grant Client','[]',1,'2023-06-12 09:49:33','2023-06-12 09:49:33','2024-06-12 09:49:33'),
('9e7e8dd82136ae39f150c652956d020f4a72d5f85b11eda72d6f6a169cfd1cb8a546351f9c984c58',1,1,'Laravel Password Grant Client','[]',1,'2023-08-01 09:10:27','2023-08-01 09:10:27','2024-08-01 09:10:27'),
('9f2996151ca83d16fee8d307fe8a254bf375482d7f38cdc71f68dcf5129678f12af508bfcc073448',1,1,'Laravel Password Grant Client','[]',1,'2023-04-11 10:48:36','2023-04-11 10:48:36','2024-04-11 10:48:36'),
('a04a31f38c2aa30eab994075e08cde44b05c2182d68168d0a73a86983e931c77c8b05b029e3f237e',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 05:47:37','2023-08-18 05:47:37','2024-08-18 05:47:37'),
('a09188480390893252559541c321d8c5f1eee4be62cc62de75feeb7d4d89cc57d53b2d503421c2e3',1,1,'Laravel Password Grant Client','[]',1,'2023-04-08 05:52:07','2023-04-08 05:52:07','2024-04-08 05:52:07'),
('a0edfc087733b7f3d3ded52d0d7240f25760e66f4ee4b999f17b28f9bb75712810ec4fa66a8ceb1b',1,1,'Laravel Password Grant Client','[]',1,'2023-07-13 12:05:59','2023-07-13 12:05:59','2024-07-13 12:05:59'),
('a30ec11f6c192c075dd0b66de4b8e4ec63b0862158823e7ca37ad67d181a5e412ed8c12f1d289650',4,1,'Laravel Password Grant Client','[]',1,'2023-05-05 12:58:14','2023-05-05 12:58:14','2024-05-05 12:58:14'),
('a376dbdf9a36c1d231179dd4ff5eeb2f47cbbf4176dec1c1488531333d134bbdc51e7192afc4a20d',3,1,'Laravel Password Grant Client','[]',0,'2023-06-26 03:42:21','2023-06-26 03:42:21','2024-06-26 03:42:21'),
('a4217a91678700769cc8e76a081e6fa8fc7b03d8d6353ec956f315a1b9d6d5fe4b3fa089f55cd3cc',1,1,'Laravel Password Grant Client','[]',0,'2023-08-07 09:20:20','2023-08-07 09:20:20','2024-08-07 09:20:20'),
('a4db56cd696409e0ae6379f1ce759a53abea9b768d733f592b9e28ca20d7cfddbb262651f6823ec6',1,1,'Laravel Password Grant Client','[]',1,'2023-08-11 06:57:37','2023-08-11 06:57:37','2024-08-11 06:57:37'),
('a52e7c6bb28d89870b5855d2ff2869604fea56fa4717db120868d2d3b26a0fc8b952e5bc76189ca1',1,1,'Laravel Password Grant Client','[]',1,'2023-08-26 04:23:01','2023-08-26 04:23:01','2024-08-26 04:23:01'),
('a6a7144786a2741539cee43ab7af587f1cce0d0bf6dadbd7c642ad0e4e32004a6aaf090f6ce01644',1,1,'Laravel Password Grant Client','[]',1,'2023-08-25 03:48:11','2023-08-25 03:48:11','2024-08-25 03:48:11'),
('a727b4e97431db1c2dcb86ebcde690218ddde5681d8d58d6b899e317a4b9ad17f34acfbdb649e3cb',3,1,'Laravel Password Grant Client','[]',1,'2023-05-05 13:02:15','2023-05-05 13:02:15','2024-05-05 13:02:15'),
('a82405800e7a1a2cb908771b7111ec9956d9f366a7150bac517dc06b065ba423af2f70018fbb925c',1,1,'Laravel Password Grant Client','[]',1,'2023-01-26 04:58:24','2023-01-26 04:58:24','2024-01-26 04:58:24'),
('a8c843c19fec6638afbf0424364d45886e74ff1101ff8c10af7175ed458c125efeb0d1294a0fedaf',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 04:14:11','2023-08-26 04:14:11','2024-08-26 04:14:11'),
('a9dc8a8605c91819fdd2a907a0427e38bba70de451c4f01e9a90a774f72b4ee6ed87ffeed97afa60',3,1,'Laravel Password Grant Client','[]',1,'2023-06-16 09:41:04','2023-06-16 09:41:04','2024-06-16 09:41:04'),
('a9f61c23eb7a39d066ea070c75a78a98158f99ccbbc27c5c432a46a6fa4753e6435d229f51317f4d',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 12:06:12','2023-08-25 12:06:12','2024-08-25 12:06:12'),
('aa3f4fb2d2cc2e76136bcd993a4edef7a294eb07e0656215ef34aaa9b998259ce75ec3babc32f8a0',1,1,'Laravel Password Grant Client','[]',0,'2023-04-07 12:18:35','2023-04-07 12:18:35','2024-04-07 12:18:35'),
('abc25687fd04d93cc397c0e6fe8b577a3603cb8cea12d3c22c756ffd32153aeeabfb068ee8ebdc45',1,1,'Laravel Password Grant Client','[]',1,'2023-01-24 15:50:12','2023-01-24 15:50:12','2024-01-24 15:50:12'),
('acec122dcaed21831f9d4ab98c4855b52cc65a15aae12ad4e42b6ca355734ce9e866c364278818f8',1,1,'Laravel Password Grant Client','[]',1,'2023-08-24 06:43:34','2023-08-24 06:43:34','2024-08-24 06:43:34'),
('ad1822fcc10344d7d0ff820695084cfadaaad0475041e787d4918c857299103e3913537fcabb2560',11,1,'Laravel Password Grant Client','[]',0,'2023-02-03 12:27:23','2023-02-03 12:27:23','2024-02-03 12:27:23'),
('ad35ec6b8ef27b330db9df023a09c35ab7cc8c319b400dfe172702bbac2d972087751cb63217ee9e',15,1,'Laravel Password Grant Client','[]',1,'2023-06-13 07:35:23','2023-06-13 07:35:23','2024-06-13 07:35:23'),
('ad485619810eb203a53bbdb17cc463eea50f52ec2730e365fa1a7b5f65fef152d692b069e4ad2087',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 12:05:39','2023-08-25 12:05:39','2024-08-25 12:05:39'),
('ae01f0aa1e250059c82f53cfd97a1a5b20c49e4a409cdfa9d72e25324770b805fcc53ade31b898e8',1,1,'Laravel Password Grant Client','[]',0,'2023-09-05 12:35:53','2023-09-05 12:35:53','2024-09-05 12:35:53'),
('ae121674533ed4f796e2ba1ad35d8faa41d93705ba50809da264f749c3feb3b82374b9b7119515db',2,1,'Laravel Password Grant Client','[]',1,'2023-02-06 04:17:30','2023-02-06 04:17:30','2024-02-06 04:17:30'),
('ae47f02d91154ae2a260681383fbf63ee67ed062233a8bc422e478510fc86db47466cc53b565bf3a',3,1,'Laravel Password Grant Client','[]',1,'2023-06-26 03:42:47','2023-06-26 03:42:47','2024-06-26 03:42:47'),
('aec4946dcc112953307fa7e36429cd2c2a72abefe15857ce8c819f237b33272c4a28571a75667586',1,1,'Laravel Password Grant Client','[]',0,'2023-04-06 08:21:36','2023-04-06 08:21:36','2024-04-06 08:21:36'),
('aecfb415324265dcf461a9f35861d78c35a1778998459b7138709dcc0ee0c7e19f5a7988504db0ae',1,1,'Laravel Password Grant Client','[]',0,'2023-08-10 04:50:35','2023-08-10 04:50:35','2024-08-10 04:50:35'),
('b0449de6f73b29678cf7845b3a3044914e47f79566cf82c485147d2dd2c756c4748f79b8223bd58c',2,1,'Laravel Password Grant Client','[]',1,'2023-07-12 07:19:12','2023-07-12 07:19:12','2024-07-12 07:19:12'),
('b1c8f334a2ef13a6c695d61d89def286e43a64c7aa11db2a51245a1b09c7de70bf5d4b65b05eca39',1,1,'Laravel Password Grant Client','[]',0,'2023-04-03 15:20:04','2023-04-03 15:20:04','2024-04-03 15:20:04'),
('b1ea2f10a0d01fd851960449bf1c795475695c103666675320061b8f5a64042167626fca558bf892',1,1,'Laravel Password Grant Client','[]',1,'2023-08-24 07:11:09','2023-08-24 07:11:09','2024-08-24 07:11:09'),
('b2147d632ca360c6e5da0a518d74e0a243218687791bd855f3daff4fe6638a2a43c40d87583d0ab6',1,1,'Laravel Password Grant Client','[]',1,'2023-04-07 03:42:05','2023-04-07 03:42:05','2024-04-07 03:42:05'),
('b45385d1944f7af5184e7a999829f5c43ccb11c32aac54bde68c7c1d633165994a8d8a2047b8334e',1,1,'Laravel Password Grant Client','[]',0,'2023-09-11 06:10:26','2023-09-11 06:10:26','2024-09-11 06:10:26'),
('b4f91f7bad6345dca307c179a47cde7ee6ae484dd6aafa01740fd6865ee3248db6ae20a8a07a5d1a',1,1,'Laravel Password Grant Client','[]',1,'2023-04-07 12:25:26','2023-04-07 12:25:26','2024-04-07 12:25:26'),
('b5c6da92693a93fc9514b18042de7ec55562cc94bfb04a1b3ff5b2f48dd84984dbba4cb820484d40',1,1,'Laravel Password Grant Client','[]',1,'2023-08-16 04:38:37','2023-08-16 04:38:37','2024-08-16 04:38:37'),
('b6353d55dd4ca50c13a25b19ba0fe65249a6827cd904cc4febe8a27f5c68b4ad68f491d93f97f98a',2,1,'Laravel Password Grant Client','[]',1,'2023-01-25 05:01:24','2023-01-25 05:01:24','2024-01-25 05:01:24'),
('b675af795757e1dc7cc57e38f92117fda996fb1a7666b4c7ee32cb273951fcd3c1bf025e77b1c837',1,1,'Laravel Password Grant Client','[]',0,'2023-08-29 06:48:12','2023-08-29 06:48:12','2024-08-29 06:48:12'),
('b6e30678af41242f16dc296b91a740660172bb6cda19dc19ea7fecfc635cb5d60c31b822b5a91b6a',1,1,'Laravel Password Grant Client','[]',1,'2023-04-25 16:25:16','2023-04-25 16:25:16','2024-04-25 16:25:16'),
('b761a02e7f6c8bff81b8d7c8787c6237b68cc2d5628865e29f6271780c10fe02824c8addc8d0a6f5',1,1,'Laravel Password Grant Client','[]',0,'2023-08-30 07:17:12','2023-08-30 07:17:12','2024-08-30 07:17:12'),
('b77ba78e5089d05729b3afcf9b4fe66c4994727101728cfe8f52b24cd587185a1e0bd705f3e3a34c',3,1,'Laravel Password Grant Client','[]',0,'2023-06-20 10:02:19','2023-06-20 10:02:19','2024-06-20 10:02:19'),
('b7a724bd8d0af3095955d84c0564f5503d96c183425c62f08559d09679b4cc998caf803379023dcd',1,1,'Laravel Password Grant Client','[]',0,'2023-04-08 05:51:20','2023-04-08 05:51:20','2024-04-08 05:51:20'),
('b80176bf32577fa2b9928c85e261978688783667b6fc3797a1f7a39b6939757d786825b1bc4b5612',1,1,'Laravel Password Grant Client','[]',0,'2023-04-08 05:51:37','2023-04-08 05:51:37','2024-04-08 05:51:37'),
('b8a1ab58ae3484c4447df30979707dc2b510e514eac10e5d4d52aaeb64939a129782677ae8198b85',1,1,'Laravel Password Grant Client','[]',0,'2023-03-25 11:33:44','2023-03-25 11:33:44','2024-03-25 11:33:44'),
('b8e80049cede258c64be89da61e9dde5dfa29f5b4cddc8d33d8df3ab0636ce967e3b53a4c6d3ac20',1,1,'Laravel Password Grant Client','[]',1,'2023-08-26 10:41:18','2023-08-26 10:41:18','2024-08-26 10:41:18'),
('b92bd08044b7f4a8552b1b45ecff9a0bf031c6df28bab65b3e629c766bd9d94e24e941195d76f0f7',1,1,'Laravel Password Grant Client','[]',1,'2023-08-26 04:26:58','2023-08-26 04:26:58','2024-08-26 04:26:58'),
('b9d45071d6c29415dc1ed6ed2ecede963e395f744bdc6f236f301526d4298069163d65e3269f1987',3,1,'Laravel Password Grant Client','[]',0,'2023-07-05 06:53:29','2023-07-05 06:53:29','2024-07-05 06:53:29'),
('bace28231c63ec91a930cf0f83f7c2483dbdf57f5da414474bc9792c2a91e04b0d0bbd77fbe9712f',3,1,'Laravel Password Grant Client','[]',0,'2023-07-06 09:28:31','2023-07-06 09:28:31','2024-07-06 09:28:31'),
('badf99a7e566e0ee5efab531566da6acd95122006e3e0ec91e88170b935468401aee3d28028889e0',3,1,'Laravel Password Grant Client','[]',0,'2023-06-30 04:06:46','2023-06-30 04:06:46','2024-06-30 04:06:46'),
('bb0b72a0304ecc7058f55eb2ddc9a3b7df1d7b7c2da87ba3dc03c34d73af7615ccc95641b6cd47e8',1,1,'Laravel Password Grant Client','[]',1,'2023-01-26 03:36:25','2023-01-26 03:36:25','2024-01-26 03:36:25'),
('bc0d0920860478b67aeb07340d104063da471045d6cf8fcfb5f8a757bdd6dec2d3bcbba02badd611',1,1,'Laravel Password Grant Client','[]',1,'2023-04-05 03:55:38','2023-04-05 03:55:38','2024-04-05 03:55:38'),
('bc44d21cc8186a5e95c04723a154c100a5a2aee8eb7b46f0deaf4a264cba9cb0a806059528962f91',3,1,'Laravel Password Grant Client','[]',0,'2023-06-16 06:59:29','2023-06-16 06:59:29','2024-06-16 06:59:29'),
('bc56af7b622ebe2414ac03bd0a2d69cebe3ac1245d1b6a03c4b2c3dce8e69a97e58151fb25f8edbf',2,1,'Laravel Password Grant Client','[]',0,'2023-02-06 06:12:39','2023-02-06 06:12:39','2024-02-06 06:12:39'),
('bc6ddee54b090dfb82a12c2746e4976570d4cb9a839d58ee4253ae4faad908ee5c66f53feed86448',2,1,'Laravel Password Grant Client','[]',1,'2023-08-18 09:16:23','2023-08-18 09:16:23','2024-08-18 09:16:23'),
('bda94d04108df400800b4af0d594f1eb0e4970534851912ce004100f7958174f84d789a641f01eb0',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 04:51:36','2023-08-26 04:51:36','2024-08-26 04:51:36'),
('bddeb18171d7fa1f3448c3568bab84d18442f075701e95949f18ab3679e3832c5236e0ab46ddc9e2',1,1,'Laravel Password Grant Client','[]',1,'2023-04-12 04:54:58','2023-04-12 04:54:58','2024-04-12 04:54:58'),
('be0017cb706ce6cd231f28b73ac7e990b75a238dae7a63f226e4ff812d9416e6b7c7e1370d75b75d',1,1,'Laravel Password Grant Client','[]',1,'2023-01-26 03:40:42','2023-01-26 03:40:42','2024-01-26 03:40:42'),
('bf53698d08a91aa6f1ddfaff87117cdcd715538420ac4d7000ef077470c87571b5f30e214ef67d1b',1,1,'Laravel Password Grant Client','[]',1,'2023-08-26 04:52:39','2023-08-26 04:52:39','2024-08-26 04:52:39'),
('bf6f0653229f70e05fb1c86fbeb59fef2ea4cf678a56e9ec35208629280b8096e68feaad9ef3da73',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:51:50','2023-08-25 09:51:50','2024-08-25 09:51:50'),
('bf91bd69de6d1120b7497202c5272b7506bd14fdfa96dc6ac225bf0a7acc736242769b1dc1af0672',1,1,'Laravel Password Grant Client','[]',1,'2023-04-17 12:25:45','2023-04-17 12:25:45','2024-04-17 12:25:45'),
('bfb3f6ced20970df1199cf25f876a8fca5381f40effba8c783257e01f3477caf3c8e858e3df07c6c',1,1,'Laravel Password Grant Client','[]',1,'2023-08-26 04:24:39','2023-08-26 04:24:39','2024-08-26 04:24:39'),
('bfc73c2ff8c5ce35898480ac200366f8523b3f1565bb9801ad9487dc05aa58adaf5ba8f62e93c52a',3,1,'Laravel Password Grant Client','[]',0,'2023-07-06 10:00:38','2023-07-06 10:00:38','2024-07-06 10:00:38'),
('bfd383a40f2a4aa2c41311c1471cb9a8b6135d8809072ee758bb95ea9fdb94984a936da357272265',1,1,'Laravel Password Grant Client','[]',1,'2023-04-08 05:44:45','2023-04-08 05:44:45','2024-04-08 05:44:45'),
('c04164109a59edb31c12c87876ab6a6ef7504b1a3f8deb6936ca89e91e1160d160db2804926f7371',1,1,'Laravel Password Grant Client','[]',0,'2023-09-11 06:09:52','2023-09-11 06:09:52','2024-09-11 06:09:52'),
('c06fc4e23041b280058cf91d05c3288fe8284d734d267ec26462e6f4a42d2b048d72c6d126c14286',1,1,'Laravel Password Grant Client','[]',1,'2023-04-07 09:12:39','2023-04-07 09:12:39','2024-04-07 09:12:39'),
('c0aa9c75f74964509fd3e869167abeb1d93ea0b14daf776e2edb588abda79e692edbe6c92d651ae9',2,1,'Laravel Password Grant Client','[]',1,'2023-01-30 09:06:06','2023-01-30 09:06:06','2024-01-30 09:06:06'),
('c114d43cd8fff61f9430b0ac87085aedfefc1cbc52ad98b75ea8cf137e7dcd1e1eff5822628be689',1,1,'Laravel Password Grant Client','[]',1,'2023-02-07 07:25:54','2023-02-07 07:25:54','2024-02-07 07:25:54'),
('c2396a9eda2e4614e9faf596e8fd8041212828f0acf5390ad9c36a86a2915b8b4d5f9e54c97dbc76',3,1,'Laravel Password Grant Client','[]',1,'2023-06-16 09:37:16','2023-06-16 09:37:16','2024-06-16 09:37:16'),
('c2d0bd83d136be5d21ff84a817a358294dc6f9f5d7c8a7514144f17116b77eccad50b1d3690d2be3',3,1,'Laravel Password Grant Client','[]',0,'2023-06-13 12:34:28','2023-06-13 12:34:28','2024-06-13 12:34:28'),
('c379a048035b009a07331ad4399ff554d24ae4460bf3c588c0f742b23325ef1b6298b7cd3ebebb9b',3,1,'Laravel Password Grant Client','[]',0,'2023-06-29 10:20:22','2023-06-29 10:20:22','2024-06-29 10:20:22'),
('c58f24cc7d77ebc38c2009a1da8c96a9929fb8621863d36b78efcd48a36c67a2ee472d5f2df7ab89',1,1,'Laravel Password Grant Client','[]',0,'2023-08-08 10:08:29','2023-08-08 10:08:29','2024-08-08 10:08:29'),
('c5aef17264ff6c16f92008bce462e35b6746c0b7bcbed8432aabaf9c8a2902e3f85be165576e86f6',1,1,'Laravel Password Grant Client','[]',1,'2023-08-11 06:29:27','2023-08-11 06:29:27','2024-08-11 06:29:27'),
('c64657ca0b7ebd0505e1bc78d48137754702251a1411cfaaf672e098f4203d6e73380f7a043d4158',3,1,'Laravel Password Grant Client','[]',1,'2023-06-12 06:03:07','2023-06-12 06:03:07','2024-06-12 06:03:07'),
('c6eed623e4363802536af3c8ab31d9ed64b61780a1b724bc26145ea3efb3269ac2c1543ea29aec71',1,1,'Laravel Password Grant Client','[]',0,'2023-08-11 07:01:38','2023-08-11 07:01:38','2024-08-11 07:01:38'),
('c7d8246f91c57dfaf7298094ec1671144297241835c75b836651a217d1625a7615be9166750da078',1,1,'Laravel Password Grant Client','[]',1,'2023-04-07 11:43:26','2023-04-07 11:43:26','2024-04-07 11:43:26'),
('c9991f6612b6f417b72b3e1475353f0f821e8567c04b83de79f298c610e77c2724307e70b64ca185',1,1,'Laravel Password Grant Client','[]',1,'2023-03-25 03:46:23','2023-03-25 03:46:23','2024-03-25 03:46:23'),
('ca4828fb5872b75b9b398edffb5444a52824efd4ccb95ffb425d2c2962a451f14bbbb03dccdcc070',1,1,'Laravel Password Grant Client','[]',1,'2023-04-06 06:50:50','2023-04-06 06:50:50','2024-04-06 06:50:50'),
('caa266fbc6ff8727303505b56878083c716f4199ee775bf14b2a5b49325ecea2947ec24f3af39d0e',3,1,'Laravel Password Grant Client','[]',1,'2023-05-16 12:47:37','2023-05-16 12:47:37','2024-05-16 12:47:37'),
('caa6e8acdd9c4611e6b818b9adc98ab1c4b7010a3125b672ae4212522dd2a8b9304c5a8db4f2da8f',1,1,'Laravel Password Grant Client','[]',1,'2023-07-12 04:13:10','2023-07-12 04:13:10','2024-07-12 04:13:10'),
('ccf603cb85990274d4f6a2cafea3adb6819813abca59f96b06192ff6b484cffa65c5b7aad060ba4b',3,1,'Laravel Password Grant Client','[]',0,'2023-07-06 09:38:23','2023-07-06 09:38:23','2024-07-06 09:38:23'),
('ce00eabb856da60864995bc106109dda82741c2b88dda034d9e6764943304313d87bf63cb16dd61b',1,1,'Laravel Password Grant Client','[]',1,'2023-08-11 06:04:19','2023-08-11 06:04:19','2024-08-11 06:04:19'),
('cec290ebf3ba1153fc505cefb30552791903cfcd11c3a70ecca92dcc18239936c612776ab9b6fb29',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 05:01:33','2023-08-26 05:01:33','2024-08-26 05:01:33'),
('cfa55d41850da7d46dd62976555243fc4aeffbbb3724fd4711a204b43659d736c236b8d35468e0bc',1,1,'Laravel Password Grant Client','[]',1,'2023-07-24 05:35:51','2023-07-24 05:35:51','2024-07-24 05:35:51'),
('cff71edb2e1dd1dad070bfb5a130a46489eb9b909baff6f9ba5dccb6f7da1be2f99c504697a6ed59',1,1,'Laravel Password Grant Client','[]',0,'2023-08-18 04:10:18','2023-08-18 04:10:18','2024-08-18 04:10:18'),
('d0ae3917a1a0ea5e62dd6ad9227cd107d5ee017b0aa2978883dd26d98b17ace7fce38e90db5eb600',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:53:16','2023-08-25 09:53:16','2024-08-25 09:53:16'),
('d14a34448f2f902262d7897cb2c49c40e1ae16fc2e231da538318a7440d3e0e7553a64a8b7443c6e',3,1,'Laravel Password Grant Client','[]',1,'2023-06-28 04:43:49','2023-06-28 04:43:49','2024-06-28 04:43:49'),
('d1b3f25765f4c20dbbc1ac2b7226abf0f1f94cd3a6504a0b8a7d7a0165740b68d3d6bd9f2f1e9dc3',13,1,'Laravel Password Grant Client','[]',1,'2023-06-12 12:06:28','2023-06-12 12:06:28','2024-06-12 12:06:28'),
('d1d3d1c5b1839a7b9ba30c208836320c52cc7f2812fda476751b9e91bcc668250d0b85417715b124',1,1,'Laravel Password Grant Client','[]',0,'2023-04-03 10:48:42','2023-04-03 10:48:42','2024-04-03 10:48:42'),
('d2771ea6b36029c2d4a856e49b3574340f77216aa5d937e8e33e8b20efff555715dbb01a84be478c',3,1,'Laravel Password Grant Client','[]',1,'2023-06-12 10:18:14','2023-06-12 10:18:14','2024-06-12 10:18:14'),
('d279ee247c375c85c094aff6d2415f499348785c1a7d698a6da6637761d1b0485c23d31860d4e02a',1,1,'Laravel Password Grant Client','[]',0,'2023-04-07 12:13:23','2023-04-07 12:13:23','2024-04-07 12:13:23'),
('d2c6e46afebce9fd38417e274693761565fea14f640672de63b5863e0fb8fb4279b629d2e433e744',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:55:33','2023-08-25 09:55:33','2024-08-25 09:55:33'),
('d2d7359eedeff128eaade11348b5d48793cf7ac7b3ae4d750d15014c7ccda488979eaa6464f64137',1,1,'Laravel Password Grant Client','[]',0,'2023-09-11 06:28:47','2023-09-11 06:28:47','2024-09-11 06:28:47'),
('d3495772fc0de5f56f07ac30c4f9e54a39d07152b2abba27f89b2f683a7cfdb7a1934141d613d8e7',5,1,'Laravel Password Grant Client','[]',0,'2023-01-30 16:59:11','2023-01-30 16:59:11','2024-01-30 16:59:11'),
('d352a6e7cf7b72682d3d8652e4be790a06b561b1da131b143e54a99b9111d8b65c13ac0325859864',1,1,'Laravel Password Grant Client','[]',0,'2023-08-08 03:52:11','2023-08-08 03:52:11','2024-08-08 03:52:11'),
('d4f72a25f9ab69a554b48b026843dc906430e858de367808a46c771ebf14e2f493f8800fb53827db',1,1,'Laravel Password Grant Client','[]',0,'2023-07-10 05:00:14','2023-07-10 05:00:14','2024-07-10 05:00:14'),
('d55032dfbed36461ccc93b72040c35975da183b44ac14dabcf57a6b9debcc8e94eb395ebb54e948e',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:51:33','2023-08-25 09:51:33','2024-08-25 09:51:33'),
('d5c7965f215407c94dee813a4ffe221828c684f9c37fe8a4880219cd5cacd8c36e4ee756dc7fc10c',1,1,'Laravel Password Grant Client','[]',0,'2023-07-31 06:34:47','2023-07-31 06:34:47','2024-07-31 06:34:47'),
('d69b725905c6087377ceb5eeb34e9a92f50612c6f5dfb302b12824de28b2ff379ebd037030bc1f29',3,1,'Laravel Password Grant Client','[]',1,'2023-06-27 04:31:19','2023-06-27 04:31:19','2024-06-27 04:31:19'),
('d700e0322771b2bea62ef779e528d06960b3aa27f49b8085b5a29ce527a2a4e5e548c446c43c3405',2,1,'Laravel Password Grant Client','[]',1,'2023-03-25 04:28:15','2023-03-25 04:28:15','2024-03-25 04:28:15'),
('d89ed5ffe8204c42a1d1082f25314774d29d5f0adb7135ac5ebdb54affc6234e596edcac10745f90',7,1,'Laravel Password Grant Client','[]',1,'2023-02-03 09:49:56','2023-02-03 09:49:56','2024-02-03 09:49:56'),
('d9f85b5e6da231d1afb0c2d5ad18c64d256c450100ff9794981e222f1a1b48c48814b36a072e710b',4,1,'Laravel Password Grant Client','[]',1,'2023-01-26 05:12:26','2023-01-26 05:12:26','2024-01-26 05:12:26'),
('dba5c128b02323b811a387953311a4eb50dda8c2ce0f5af2e7973c2fdf3c8dd77b3b9d355d0edd22',1,1,'Laravel Password Grant Client','[]',0,'2023-04-03 06:59:38','2023-04-03 06:59:38','2024-04-03 06:59:38'),
('dc3c7167a458aeccfab28b30eb78dca5d512704c002578f84c66a137fec20a7ae7c84ad3b2e649c6',1,1,'Laravel Password Grant Client','[]',1,'2023-01-27 11:07:40','2023-01-27 11:07:40','2024-01-27 11:07:40'),
('dc773a6367e5af8e52da3f2d1efb4bf091949ae35f3b31a218ac07141bbb00b218264ddadb746637',1,1,'Laravel Password Grant Client','[]',0,'2023-08-10 11:19:24','2023-08-10 11:19:24','2024-08-10 11:19:24'),
('dd21c64f46bcaaa7f48822c493dd80b009326db446b8e12d4ad28969ef726495f727b5191df08946',1,1,'Laravel Password Grant Client','[]',1,'2023-09-11 06:23:41','2023-09-11 06:23:41','2024-09-11 06:23:41'),
('dd44280bf44b97c0bb389fa824e98f4f71f705fd8e82f1ccbf790ede5408dd6c8122fea8c182a881',3,1,'Laravel Password Grant Client','[]',0,'2023-06-23 05:06:11','2023-06-23 05:06:11','2024-06-23 05:06:11'),
('dde077981c262183f747d7c10f19f961c041bac95fa82c900d2b2f89ce115dfa74a1869100f399ee',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:51:57','2023-08-25 09:51:57','2024-08-25 09:51:57'),
('de8838a34f15f91d92ea2e8b92224db527683d07a49101f089ab8e96be12e08d060fa2f606fc1dd5',1,1,'Laravel Password Grant Client','[]',0,'2023-04-17 12:25:42','2023-04-17 12:25:42','2024-04-17 12:25:42'),
('df6e6d688fce6db6bc05d73b596009894452ef6949ff16fa170de8d6f80b302f3f2c1d182a06d5e2',14,1,'Laravel Password Grant Client','[]',0,'2023-06-12 13:00:42','2023-06-12 13:00:42','2024-06-12 13:00:42'),
('e01b8cb13f4c7cad8f979fbe4c41e17201b4ec09dd7cb17afed306f077a4cd1750e66a6ce6cabae1',10,1,'Laravel Password Grant Client','[]',1,'2023-02-03 11:49:46','2023-02-03 11:49:46','2024-02-03 11:49:46'),
('e069169e83b2bf7393555203e31c3c95ab10537742a80ec2f8ffd713a7f16105af6df9c3aab0640f',3,1,'Laravel Password Grant Client','[]',0,'2023-01-24 13:10:50','2023-01-24 13:10:50','2024-01-24 13:10:50'),
('e0c5cf1d7bacc1ecaa8eabd4293b064c066d9cdab21540f9e2690e72929fc123ac42619d0a002605',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 10:55:03','2023-08-18 10:55:03','2024-08-18 10:55:03'),
('e0d14a211d2243ba0177c14956c28e32998d73e1192f36bcb40d6396bd88a729bf952b3ca6a0f0f0',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 11:46:50','2023-08-26 11:46:50','2024-08-26 11:46:50'),
('e15c26c3e195f4ab47f296b219d3c256e85452676ef3be78ac95f274b0ff1f180e8eaad309a5b5f3',2,1,'Laravel Password Grant Client','[]',1,'2023-02-06 04:15:43','2023-02-06 04:15:43','2024-02-06 04:15:43'),
('e16d311cb912fb174a7f298140f37de693bedd4ea175908a3d1f86b68898431dd31efe8172cc4538',1,1,'Laravel Password Grant Client','[]',0,'2023-04-06 16:40:17','2023-04-06 16:40:17','2024-04-06 16:40:17'),
('e19d31cca7e32a0943bb88fdbfd7c766bf2f3cf779595453e8d690e808314498723263690bc99807',1,1,'Laravel Password Grant Client','[]',1,'2023-04-11 03:47:50','2023-04-11 03:47:50','2024-04-11 03:47:50'),
('e273a3bb7159274df39ed4506488eac715e38195dfde4507106c6d8b20e3d16a4e5f3223539f2b44',1,1,'Laravel Password Grant Client','[]',0,'2023-08-10 05:52:11','2023-08-10 05:52:11','2024-08-10 05:52:11'),
('e285f93039ec363fb370515d1ac941791f88bd8697c9d66f4c433c0e388c2d7c19c286b5e1b6cdf0',1,1,'Laravel Password Grant Client','[]',1,'2023-04-07 07:48:58','2023-04-07 07:48:58','2024-04-07 07:48:58'),
('e2a128afcc8ab55a82ac7b74bf0d305c5fbcb03eff3269cc1a38e7cb90366e30666b8c5fa57c6443',1,1,'Laravel Password Grant Client','[]',0,'2023-08-10 05:47:14','2023-08-10 05:47:14','2024-08-10 05:47:14'),
('e4c806b63782a58f5585da5eaf13865e35878a0a156f0f4b3e464ff1b570ae6aa7c888746a0cc52f',2,1,'Laravel Password Grant Client','[]',0,'2023-07-12 11:47:52','2023-07-12 11:47:52','2024-07-12 11:47:52'),
('e50a97361002082a4198f0af14ebedb5fd707a001592d37c644d6a48977a8a4a4f7c2e6233f3f8cd',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 10:00:14','2023-08-25 10:00:14','2024-08-25 10:00:14'),
('e55d57fa0115f45e53c0d3be82f91a81696672ea1027a8348f9fd8167fb609ff57337eb5a81138cf',3,1,'Laravel Password Grant Client','[]',1,'2023-06-16 09:23:51','2023-06-16 09:23:51','2024-06-16 09:23:51'),
('e5fd8467b163a1d79391deecb8df70aca845e98ff8b19b8b35d92dba22339d049c0006c38fcfddcf',1,1,'Laravel Password Grant Client','[]',0,'2023-07-31 05:07:21','2023-07-31 05:07:21','2024-07-31 05:07:21'),
('e60d9c47baac0af7088350ed69d9d3c140667bc149dac5f89a692556df4b3f7188e52ed9127e55b7',1,1,'Laravel Password Grant Client','[]',0,'2023-08-09 11:37:12','2023-08-09 11:37:12','2024-08-09 11:37:12'),
('e6c8ef602b0b1aa1de4c11d3e248e681a35ab017d7c48d127ad86d14e3ed2aca79d0baf19cfefc79',1,1,'Laravel Password Grant Client','[]',0,'2023-07-10 06:52:22','2023-07-10 06:52:22','2024-07-10 06:52:22'),
('e752ef8edb66b49cedacb63124288d9e4b8f47da90a9ed1157e45cf6bc1e4fe128b1550eb889d8fa',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:21:15','2023-08-25 09:21:15','2024-08-25 09:21:15'),
('e80d7f614515d2a2b150c3e3f48fa83957f2bd798a1eb8383a61ac9bd15a0cb0cdfcfe272191a535',1,1,'Laravel Password Grant Client','[]',1,'2023-04-11 10:59:54','2023-04-11 10:59:54','2024-04-11 10:59:54'),
('e826563ed26d5cebd8acf2aa17d8ed3912a204caf4d1826dc3e8efd65f4e8f4de42844dc85960c39',1,1,'Laravel Password Grant Client','[]',0,'2023-08-29 10:41:25','2023-08-29 10:41:25','2024-08-29 10:41:25'),
('e8718efad4c81602194393d3ecfc8ba150bd4d0e0774858db0bc9faa66d93570b8a18e0bb68d7d16',4,1,'Laravel Password Grant Client','[]',0,'2023-08-21 10:06:47','2023-08-21 10:06:47','2024-08-21 10:06:47'),
('e88695e23a1e9602c16367a352c6b9be52dea8f2e4cfe1cf2faf48add99319d662b637aa88c30169',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:56:37','2023-08-25 09:56:37','2024-08-25 09:56:37'),
('e88bbd9d11b38e194a1e0889e3bec7fa72ee2de5547f19769d58ced3236e8a1e2c49d71368b12daa',1,1,'Laravel Password Grant Client','[]',0,'2023-07-31 12:23:49','2023-07-31 12:23:49','2024-07-31 12:23:49'),
('e92ee1c6ff1788b9355fc4d52d1517c6781fd98dfeb818dde99f066b97f01c455761c157b05fe431',2,1,'Laravel Password Grant Client','[]',1,'2023-02-06 04:12:09','2023-02-06 04:12:09','2024-02-06 04:12:09'),
('e95ae24672e077f00531cb7ad605f66fb1fb2f5c77aa900cb572daac5698e34a099cec0596a2809a',1,1,'Laravel Password Grant Client','[]',0,'2023-03-21 09:29:36','2023-03-21 09:29:36','2024-03-21 09:29:36'),
('e9cc0ba81c46510e2c7487a846ba29d1f111f4eda476ab7f901e404c9b1488df89c6661c7a8ebc10',3,1,'Laravel Password Grant Client','[]',1,'2023-06-24 06:55:40','2023-06-24 06:55:40','2024-06-24 06:55:40'),
('ea0335a21c66c395b54a494e9513365c68c3624086df3f02db47979745fb2b17273a68258104555f',1,1,'Laravel Password Grant Client','[]',0,'2023-09-11 06:20:53','2023-09-11 06:20:53','2024-09-11 06:20:53'),
('eab33a7f7fdf6669dcc123a991dd516830c269f84d51dbf7d4a7b94aed53f69a23d7a8865a517fa6',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 06:03:25','2023-08-18 06:03:25','2024-08-18 06:03:25'),
('ec0b80c613445ee98b029cae0f4c03b522ea496f5fde23a0646c0757dc40f03aadd6a9390abe8a37',1,1,'Laravel Password Grant Client','[]',1,'2023-08-28 10:53:32','2023-08-28 10:53:32','2024-08-28 10:53:32'),
('ee5d1f6f70dde175cae3cec443429e62b22e3e1cf4e66d521978087ce35737db90477413909b821b',1,1,'Laravel Password Grant Client','[]',1,'2023-08-26 04:26:07','2023-08-26 04:26:07','2024-08-26 04:26:07'),
('ee7d9b091b8bb1adc96429221227a321fbbbcea43f6c57658c74916d03b14145162175751d2241fa',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 04:19:58','2023-08-26 04:19:58','2024-08-26 04:19:58'),
('ee966039fc8c1a08683d825f2cffd78a9d4e1b21d3749c08024d93357aee9c4fd0c1dbab7649ec18',3,1,'Laravel Password Grant Client','[]',1,'2023-01-20 09:08:15','2023-01-20 09:08:15','2024-01-20 09:08:15'),
('eeb2ef171288e1368a517a7a4e80dfca4c6a5936cf47c28c304366bd192666aa96d619c14d47af83',1,1,'Laravel Password Grant Client','[]',0,'2023-08-24 07:21:42','2023-08-24 07:21:42','2024-08-24 07:21:42'),
('eec04620d24ed64b1f830fe73f8029c411f567eaf2a1e672fb65d4e680419dbd16c7549cc476eb93',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 05:47:43','2023-08-25 05:47:43','2024-08-25 05:47:43'),
('eee270f372aef713cc7f18a133fc718d9d6ca031c923f1d7eeaa004b6e1b758f8b961b2ff3002d14',1,1,'Laravel Password Grant Client','[]',1,'2023-07-07 05:21:46','2023-07-07 05:21:46','2024-07-07 05:21:46'),
('f042d1814caf8ba29182bac14c1b9638e034a2be56c65ff1645ca1579733e109654aa6ad4362f0d9',8,1,'Laravel Password Grant Client','[]',0,'2023-02-03 09:52:13','2023-02-03 09:52:13','2024-02-03 09:52:13'),
('f08e6eb5d5058ac080e3370b1ce653658e5188ed358efa69daadb697b05ebf11adbb9d8c71742fd0',1,1,'Laravel Password Grant Client','[]',0,'2023-04-08 05:57:12','2023-04-08 05:57:12','2024-04-08 05:57:12'),
('f093c89bf5974aa5ae92649316e137b6f0c55c29b4dec83e6879702163e5c47ba79fee75d309bcbc',1,1,'Laravel Password Grant Client','[]',0,'2023-01-28 04:16:08','2023-01-28 04:16:08','2024-01-28 04:16:08'),
('f1c717675a85762beb3fa1eb76424ea8af4d7d424efc512d860333641faf1e2bf91d46aa2b29d01b',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:08:31','2023-08-25 09:08:31','2024-08-25 09:08:31'),
('f1f2927f2fb6bb0848748ef04d886c038b8404b4a881f9a2a2893ed5304cf165dbc4e8a5cb949a87',1,1,'Laravel Password Grant Client','[]',0,'2023-03-21 08:49:29','2023-03-21 08:49:29','2024-03-21 08:49:29'),
('f23f63f5ae55369b64d56dbe06b3c9dcafc3d60c86bcb969e8dfd8cd5223443cdf592f28e898af6a',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:50:55','2023-08-25 09:50:55','2024-08-25 09:50:55'),
('f296115ba7b7625f5f5b5874a7748c928cd23392f2d938f93072d865f48c9bc51ea7c62b233a7c46',1,1,'Laravel Password Grant Client','[]',0,'2023-08-24 07:05:00','2023-08-24 07:05:00','2024-08-24 07:05:00'),
('f3074f1a97d316009aa336ffcaecd1f3ff8a81907c82a8d940013f030c4ac18337651d3c71ec1fd2',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 12:06:08','2023-08-25 12:06:08','2024-08-25 12:06:08'),
('f3a9355301e939d99ae00c297abaf44a69cbfdc99690f468f58a00a1b9b4c7041c60a59dd0e8f855',1,1,'Laravel Password Grant Client','[]',0,'2023-07-13 12:54:54','2023-07-13 12:54:54','2024-07-13 12:54:54'),
('f3b50e1ca68ac13ee8043ac6efa2b91ae71ea5aa6bfc3ba36c76703f71af1850be7ba603efa54c64',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 05:58:47','2023-08-18 05:58:47','2024-08-18 05:58:47'),
('f52cc2ada1f285e27794383dcafe71af12ac61e70bc9ce3f2ebe69694045935a853988ddac88d228',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 12:05:04','2023-08-25 12:05:04','2024-08-25 12:05:04'),
('f55b2c121ac4caa02e741a8972084a989e9a7f517e402d8beedda1f8f15293525c9025125f44cc6c',3,1,'Laravel Password Grant Client','[]',1,'2023-06-16 09:42:19','2023-06-16 09:42:19','2024-06-16 09:42:19'),
('f5d556dbace15e8a4f7f9f73437150dcd6f327d6b24a8eb7eb4e3afcd4db77c21925df82b40c5ff7',3,1,'Laravel Password Grant Client','[]',1,'2023-06-12 10:39:02','2023-06-12 10:39:02','2024-06-12 10:39:02'),
('f6147e2759b410945e6998d2060ff16195e6cc42d26952c9bafd220c821a446e4e78f8c583891a56',1,1,'Laravel Password Grant Client','[]',1,'2023-04-04 09:28:24','2023-04-04 09:28:24','2024-04-04 09:28:24'),
('f6c2ffd4355950fde889650547da0bc9a9cc930a25fb7566848205351711cb885166c3a389754f52',2,1,'Laravel Password Grant Client','[]',1,'2023-05-05 12:37:58','2023-05-05 12:37:58','2024-05-05 12:37:58'),
('f72c878eea9831c77bffa864a389df327abd950bcad3e6de6d5fc2f391c315f544ae7cacaab809bf',1,1,'Laravel Password Grant Client','[]',1,'2023-04-07 11:39:27','2023-04-07 11:39:27','2024-04-07 11:39:27'),
('f88295237867205321dafb025e9f7a06d6c7eb9c8b49e7da82099f944659572b470c3d95786f5120',1,1,'Laravel Password Grant Client','[]',1,'2023-04-06 07:26:33','2023-04-06 07:26:33','2024-04-06 07:26:33'),
('f999f159fa4a63188df560c27b80a445c8720f93aa1be292fe0a47f323fc1dd45a0eec925d61e5a4',2,1,'Laravel Password Grant Client','[]',1,'2023-02-05 15:45:40','2023-02-05 15:45:40','2024-02-05 15:45:40'),
('f9b649de8be33100c8ab1d008d3e9d08f22af5ac1c4b7e124cd3c0162c6ec7a9e563501199e934b9',1,1,'Laravel Password Grant Client','[]',1,'2023-08-18 05:49:05','2023-08-18 05:49:05','2024-08-18 05:49:05'),
('fa5792c2813bdc08099c028df33977e6dd4f83244f854dc243ad2d74f5411866bdaa1430e5266591',1,1,'Laravel Password Grant Client','[]',0,'2023-03-25 05:08:15','2023-03-25 05:08:15','2024-03-25 05:08:15'),
('faec879bfd2217d6246d60d4e357cac53cdc3556ce50598cc0d3736ae46df940ea70580873fcb9e3',3,1,'Laravel Password Grant Client','[]',0,'2023-06-24 03:54:01','2023-06-24 03:54:01','2024-06-24 03:54:01'),
('fb9a71c602297865cd78e379a2ba49547e64daf5d3c0e287f91d9b02677562aa89a19516799c0d66',1,1,'Laravel Password Grant Client','[]',1,'2023-08-26 04:25:30','2023-08-26 04:25:30','2024-08-26 04:25:30'),
('fc163eb1ef755b2ef69fb498da495b53bf4c211eb594a65a6f0bdd13e317ad22c12b020b4fc3de11',1,1,'Laravel Password Grant Client','[]',0,'2023-04-07 12:20:37','2023-04-07 12:20:37','2024-04-07 12:20:37'),
('fc92f3470d380ee600e01d7eb8f333256fb6bb2eb37b2e9a08f4120d4c71839832e58bbb0ecff39d',1,1,'Laravel Password Grant Client','[]',0,'2023-08-25 09:56:35','2023-08-25 09:56:35','2024-08-25 09:56:35'),
('fcaf9812b6b1e09291e5e229e3d2c125690e434c9c53424e41cbe501e38d601a0dfff540820a256c',1,1,'Laravel Password Grant Client','[]',1,'2023-08-25 09:25:09','2023-08-25 09:25:09','2024-08-25 09:25:09'),
('fd7bc093a3952b65c0c09d8ea63267f539510b4e44dc5857a3840875fcd5086fb878c5a5a6b2d789',1,1,'Laravel Password Grant Client','[]',1,'2023-04-08 05:33:01','2023-04-08 05:33:01','2024-04-08 05:33:01'),
('fe7a03112299b8b5b02883d2430a45bd9fff491d27529266ef8db08de03ba5a6dc2efb6683d5ead2',3,1,'Laravel Password Grant Client','[]',1,'2023-06-24 06:57:03','2023-06-24 06:57:03','2024-06-24 06:57:03'),
('ff0592f0ed46cdd787ace04fc48ba24571d31f149687e2eb141caedfa9a8614747bc5050d66b074c',1,1,'Laravel Password Grant Client','[]',0,'2023-08-26 04:10:45','2023-08-26 04:10:45','2024-08-26 04:10:45'),
('ff9cf88ae946a96ce80c836d389f556c5c0eb271e41e53049d77d0ed1b5f06c9c2d62b5c0c967f36',1,1,'Laravel Password Grant Client','[]',0,'2023-09-11 06:19:30','2023-09-11 06:19:30','2024-09-11 06:19:30'),
('fffe2cd01c8f735d16a0d7ed40ca9454ca86b29e81bf1a40740f039bed8bad4615b0c3845b53bdba',1,1,'Laravel Password Grant Client','[]',0,'2023-09-04 06:19:26','2023-09-04 06:19:26','2024-09-04 06:19:26');

/*Table structure for table `oauth_auth_codes` */

DROP TABLE IF EXISTS `oauth_auth_codes`;

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_auth_codes` */

/*Table structure for table `oauth_clients` */

DROP TABLE IF EXISTS `oauth_clients`;

CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(191) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_clients` */

insert  into `oauth_clients`(`id`,`user_id`,`name`,`secret`,`provider`,`redirect`,`personal_access_client`,`password_client`,`revoked`,`created_at`,`updated_at`) values 
(1,NULL,'Laravel Personal Access Client','uHm1zBNuQGYbxvn2RKicpWGx4rhxAlWsO1qw9KSI',NULL,'http://localhost',1,0,0,'2023-01-19 05:26:36','2023-01-19 05:26:36');

/*Table structure for table `oauth_personal_access_clients` */

DROP TABLE IF EXISTS `oauth_personal_access_clients`;

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_personal_access_clients` */

insert  into `oauth_personal_access_clients`(`id`,`client_id`,`created_at`,`updated_at`) values 
(1,1,'2023-01-19 05:26:36','2023-01-19 05:26:36');

/*Table structure for table `oauth_refresh_tokens` */

DROP TABLE IF EXISTS `oauth_refresh_tokens`;

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `oauth_refresh_tokens` */

/*Table structure for table `organization_addresses` */

DROP TABLE IF EXISTS `organization_addresses`;

CREATE TABLE `organization_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL,
  `com_property_address_id` int(11) NOT NULL,
  `address_cachet_id` int(11) DEFAULT NULL,
  `address_update_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `organization_addresses` */

/*Table structure for table `organization_databases` */

DROP TABLE IF EXISTS `organization_databases`;

CREATE TABLE `organization_databases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL,
  `db_name` varchar(150) NOT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `organization_databases` */

insert  into `organization_databases`(`id`,`org_id`,`db_name`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'1694059852Google',NULL,NULL,'2023-09-07 04:10:52','2023-09-07 04:10:52',NULL),
(2,2,'1694059934Google',NULL,NULL,'2023-09-07 04:12:14','2023-09-07 04:12:14',NULL),
(3,3,'1694060064Google',NULL,NULL,'2023-09-07 04:14:24','2023-09-07 04:14:24',NULL),
(4,4,'1694060087Google',NULL,NULL,'2023-09-07 04:14:47','2023-09-07 04:14:47',NULL),
(5,5,'1694060128Google',NULL,NULL,'2023-09-07 04:15:28','2023-09-07 04:15:28',NULL),
(6,6,'1694060709Google',NULL,NULL,'2023-09-07 04:25:09','2023-09-07 04:25:09',NULL),
(7,7,'1694060730Google',NULL,NULL,'2023-09-07 04:25:30','2023-09-07 04:25:30',NULL),
(8,8,'1694060734Google',NULL,NULL,'2023-09-07 04:25:35','2023-09-07 04:25:35',NULL),
(9,9,'1694060738Google',NULL,NULL,'2023-09-07 04:25:38','2023-09-07 04:25:38',NULL),
(10,10,'1694060777Google',NULL,NULL,'2023-09-07 04:26:17','2023-09-07 04:26:17',NULL),
(11,11,'1694060781Google',NULL,NULL,'2023-09-07 04:26:21','2023-09-07 04:26:21',NULL),
(12,12,'1694060790Google',NULL,NULL,'2023-09-07 04:26:30','2023-09-07 04:26:30',NULL),
(13,13,'1694061357Google',NULL,NULL,'2023-09-07 04:35:57','2023-09-07 04:35:57',NULL),
(14,14,'1694145852Google',NULL,NULL,'2023-09-08 04:04:12','2023-09-08 04:04:12',NULL),
(15,15,'1694147028Well',NULL,NULL,'2023-09-08 04:23:48','2023-09-08 04:23:48',NULL);

/*Table structure for table `organization_details` */

DROP TABLE IF EXISTS `organization_details`;

CREATE TABLE `organization_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL,
  `title_id` varchar(255) DEFAULT 'M/S',
  `org_name` varchar(255) NOT NULL,
  `org_alias` varchar(255) DEFAULT NULL,
  `started_date` date DEFAULT NULL,
  `year_of_establishment` year(4) DEFAULT NULL,
  `is_registered_org` int(11) DEFAULT NULL,
  `gst_no` varchar(255) DEFAULT NULL,
  `date_of_reg` date DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `organization_details` */

insert  into `organization_details`(`id`,`org_id`,`title_id`,`org_name`,`org_alias`,`started_date`,`year_of_establishment`,`is_registered_org`,`gst_no`,`date_of_reg`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,NULL,'Google',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:10:52','2023-09-07 04:10:52',NULL),
(2,2,NULL,'Google',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:12:14','2023-09-07 04:12:14',NULL),
(3,3,NULL,'Google',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:14:24','2023-09-07 04:14:24',NULL),
(4,4,NULL,'Google',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:14:47','2023-09-07 04:14:47',NULL),
(5,5,NULL,'Google',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:15:28','2023-09-07 04:15:28',NULL),
(6,6,NULL,'Google',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:25:09','2023-09-07 04:25:09',NULL),
(7,7,NULL,'Google',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:25:30','2023-09-07 04:25:30',NULL),
(8,8,NULL,'Google',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:25:34','2023-09-07 04:25:34',NULL),
(9,9,NULL,'Google',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:25:38','2023-09-07 04:25:38',NULL),
(10,10,NULL,'Google',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:26:17','2023-09-07 04:26:17',NULL),
(11,11,NULL,'Google',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:26:21','2023-09-07 04:26:21',NULL),
(12,12,NULL,'Google',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:26:30','2023-09-07 04:26:30',NULL),
(13,13,NULL,'Google',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-07 04:35:57','2023-09-07 04:35:57',NULL),
(14,14,NULL,'Google',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-08 04:04:12','2023-09-08 04:04:12',NULL),
(15,15,NULL,'Well',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2023-09-08 04:23:48','2023-09-08 04:23:48',NULL);

/*Table structure for table `organization_emails` */

DROP TABLE IF EXISTS `organization_emails`;

CREATE TABLE `organization_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_cachet_id` int(11) DEFAULT NULL,
  `email_validation_id` int(11) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `organization_emails` */

insert  into `organization_emails`(`id`,`org_id`,`email`,`email_cachet_id`,`email_validation_id`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-07 04:10:52','2023-09-07 04:10:52',NULL),
(2,2,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-07 04:12:14','2023-09-07 04:12:14',NULL),
(3,3,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-07 04:14:24','2023-09-07 04:14:24',NULL),
(4,4,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-07 04:14:47','2023-09-07 04:14:47',NULL),
(5,5,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-07 04:15:28','2023-09-07 04:15:28',NULL),
(6,6,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-07 04:25:09','2023-09-07 04:25:09',NULL),
(7,7,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-07 04:25:30','2023-09-07 04:25:30',NULL),
(8,8,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-07 04:25:34','2023-09-07 04:25:34',NULL),
(9,9,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-07 04:25:38','2023-09-07 04:25:38',NULL),
(10,10,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-07 04:26:17','2023-09-07 04:26:17',NULL),
(11,11,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-07 04:26:21','2023-09-07 04:26:21',NULL),
(12,12,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-07 04:26:30','2023-09-07 04:26:30',NULL),
(13,13,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-07 04:35:57','2023-09-07 04:35:57',NULL),
(14,14,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-08 04:04:12','2023-09-08 04:04:12',NULL),
(15,15,'Soft@gmail.com',NULL,NULL,1,NULL,'2023-09-08 04:23:48','2023-09-08 04:23:48',NULL);

/*Table structure for table `organization_web_addresses` */

DROP TABLE IF EXISTS `organization_web_addresses`;

CREATE TABLE `organization_web_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) NOT NULL,
  `web_address` varchar(255) DEFAULT NULL,
  `web_address_cachet_id` int(11) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `organization_web_addresses` */

insert  into `organization_web_addresses`(`id`,`org_id`,`web_address`,`web_address_cachet_id`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(1,1,'testing',NULL,1,NULL,'2023-09-07 04:10:52','2023-09-07 04:10:52',NULL),
(2,2,'testing',NULL,1,NULL,'2023-09-07 04:12:14','2023-09-07 04:12:14',NULL),
(3,3,'testing',NULL,1,NULL,'2023-09-07 04:14:24','2023-09-07 04:14:24',NULL),
(4,4,'testing',NULL,1,NULL,'2023-09-07 04:14:47','2023-09-07 04:14:47',NULL),
(5,5,'testing',NULL,1,NULL,'2023-09-07 04:15:28','2023-09-07 04:15:28',NULL),
(6,6,'testing',NULL,1,NULL,'2023-09-07 04:25:09','2023-09-07 04:25:09',NULL),
(7,7,'testing',NULL,1,NULL,'2023-09-07 04:25:30','2023-09-07 04:25:30',NULL),
(8,8,'testing',NULL,1,NULL,'2023-09-07 04:25:35','2023-09-07 04:25:35',NULL),
(9,9,'testing',NULL,1,NULL,'2023-09-07 04:25:38','2023-09-07 04:25:38',NULL),
(10,10,'testing',NULL,1,NULL,'2023-09-07 04:26:17','2023-09-07 04:26:17',NULL),
(11,11,'testing',NULL,1,NULL,'2023-09-07 04:26:21','2023-09-07 04:26:21',NULL),
(12,12,'testing',NULL,1,NULL,'2023-09-07 04:26:30','2023-09-07 04:26:30',NULL),
(13,13,'testing',NULL,1,NULL,'2023-09-07 04:35:57','2023-09-07 04:35:57',NULL),
(14,14,'testing',NULL,1,NULL,'2023-09-08 04:04:12','2023-09-08 04:04:12',NULL),
(15,15,'testing',NULL,1,NULL,'2023-09-08 04:23:48','2023-09-08 04:23:48',NULL);

/*Table structure for table `organizations` */

DROP TABLE IF EXISTS `organizations`;

CREATE TABLE `organizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pfm_stage_id` varchar(255) DEFAULT NULL,
  `pfm_origin_id` int(11) DEFAULT NULL,
  `pfm_existence_id` int(11) DEFAULT NULL,
  `pfm_authorization_id` int(11) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `organizations` */

insert  into `organizations`(`id`,`pfm_stage_id`,`pfm_origin_id`,`pfm_existence_id`,`pfm_authorization_id`,`reason`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-07 04:10:52','2023-09-07 04:10:52',NULL),
(2,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-07 04:12:14','2023-09-07 04:12:14',NULL),
(3,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-07 04:14:24','2023-09-07 04:14:24',NULL),
(4,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-07 04:14:47','2023-09-07 04:14:47',NULL),
(5,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-07 04:15:28','2023-09-07 04:15:28',NULL),
(6,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-07 04:25:09','2023-09-07 04:25:09',NULL),
(7,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-07 04:25:30','2023-09-07 04:25:30',NULL),
(8,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-07 04:25:34','2023-09-07 04:25:34',NULL),
(9,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-07 04:25:38','2023-09-07 04:25:38',NULL),
(10,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-07 04:26:17','2023-09-07 04:26:17',NULL),
(11,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-07 04:26:21','2023-09-07 04:26:21',NULL),
(12,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-07 04:26:30','2023-09-07 04:26:30',NULL),
(13,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-07 04:35:57','2023-09-07 04:35:57',NULL),
(14,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-08 04:04:12','2023-09-08 04:04:12',NULL),
(15,'1',1,NULL,1,NULL,NULL,NULL,'2023-09-08 04:23:48','2023-09-08 04:23:48',NULL);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `person_addresses` */

DROP TABLE IF EXISTS `person_addresses`;

CREATE TABLE `person_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `com_property_address_id` int(11) NOT NULL,
  `address_cachet_id` int(11) NOT NULL,
  `address_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `person_addresses` */

/*Table structure for table `person_anniversarys` */

DROP TABLE IF EXISTS `person_anniversarys`;

CREATE TABLE `person_anniversarys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `occasions_id` int(11) DEFAULT NULL,
  `anniversary_date` date NOT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `person_anniversarys` */

insert  into `person_anniversarys`(`id`,`uid`,`occasions_id`,`anniversary_date`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'383c8fe6-4085-47a5-88f8-414f607bc2b7',NULL,'2000-08-18',NULL,NULL,'2023-09-05 04:15:02','2023-09-05 04:15:02',NULL);

/*Table structure for table `person_depone_status` */

DROP TABLE IF EXISTS `person_depone_status`;

CREATE TABLE `person_depone_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `pfm_depone_status_id` int(11) NOT NULL,
  `dep_uid` text NOT NULL,
  `comments` text DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `person_depone_status` */

/*Table structure for table `person_details` */

DROP TABLE IF EXISTS `person_details`;

CREATE TABLE `person_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `pims_person_salutation_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `nick_name` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `birth_place` varchar(255) DEFAULT NULL,
  `pims_person_gender_id` int(11) NOT NULL,
  `pims_person_blood_group_id` int(11) DEFAULT NULL,
  `pims_person_marital_status_id` int(11) DEFAULT NULL,
  `pims_person_country_id` int(11) DEFAULT NULL,
  `pfm_survial_id` int(11) DEFAULT NULL,
  `decesaed_date` datetime DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `person_details` */

insert  into `person_details`(`id`,`uid`,`pims_person_salutation_id`,`first_name`,`middle_name`,`last_name`,`nick_name`,`dob`,`birth_place`,`pims_person_gender_id`,`pims_person_blood_group_id`,`pims_person_marital_status_id`,`pims_person_country_id`,`pfm_survial_id`,`decesaed_date`,`comments`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'383c8fe6-4085-47a5-88f8-414f607bc2b7',14,'harish krish','Kumar','S','Hari','2000-08-18','Chennai',10,14,NULL,NULL,1,NULL,NULL,NULL,NULL,'2023-09-05 04:15:02','2023-09-12 07:28:17',NULL);

/*Table structure for table `person_documents` */

DROP TABLE IF EXISTS `person_documents`;

CREATE TABLE `person_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `pims_person_doc_type_id` int(11) DEFAULT NULL,
  `Doc_no` varchar(255) DEFAULT NULL,
  `doc_validity` varchar(255) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `doc_cachet_id` int(11) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `person_documents` */

/*Table structure for table `person_educations` */

DROP TABLE IF EXISTS `person_educations`;

CREATE TABLE `person_educations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(750) DEFAULT NULL,
  `pims_person_qualification_id` varchar(750) DEFAULT NULL,
  `intuition_org_id` int(11) DEFAULT NULL,
  `university_org_id` int(11) DEFAULT NULL,
  `year_of_Pass` varchar(255) DEFAULT NULL,
  `mark` varchar(150) DEFAULT NULL,
  `pims_person_doc_type_id` int(11) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `person_educations` */

/*Table structure for table `person_emails` */

DROP TABLE IF EXISTS `person_emails`;

CREATE TABLE `person_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_cachet_id` int(11) NOT NULL,
  `email_updated_on` datetime DEFAULT current_timestamp(),
  `otp_received` int(11) DEFAULT NULL,
  `email_validation_id` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `person_emails` */

insert  into `person_emails`(`id`,`uid`,`email`,`email_cachet_id`,`email_updated_on`,`otp_received`,`email_validation_id`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'383c8fe6-4085-47a5-88f8-414f607bc2b7','harish@gmail.com',1,'2023-09-05 09:45:02',98175,'2023-09-05 05:12:22',NULL,NULL,'2023-09-05 04:15:02','2023-09-05 05:12:22',NULL);

/*Table structure for table `person_languages` */

DROP TABLE IF EXISTS `person_languages`;

CREATE TABLE `person_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `pims_com_language_id` int(11) DEFAULT NULL,
  `is_mother_tongue` varchar(255) NOT NULL,
  `spoken` varchar(255) DEFAULT NULL,
  `read` varchar(255) DEFAULT NULL,
  `write` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `person_languages` */

insert  into `person_languages`(`id`,`uid`,`pims_com_language_id`,`is_mother_tongue`,`spoken`,`read`,`write`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(4,'383c8fe6-4085-47a5-88f8-414f607bc2b7',NULL,'1',NULL,NULL,NULL,1,NULL,'2023-09-12 07:22:36','2023-09-12 07:22:36',NULL);

/*Table structure for table `person_mobiles` */

DROP TABLE IF EXISTS `person_mobiles`;

CREATE TABLE `person_mobiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `mobile_cachet_id` int(11) NOT NULL,
  `mobileno_updated_on` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `otp_received` int(11) DEFAULT NULL,
  `mobile_validation_id` int(11) DEFAULT NULL,
  `validation_updated_on` timestamp NULL DEFAULT current_timestamp(),
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `person_mobiles` */

insert  into `person_mobiles`(`id`,`uid`,`country_id`,`mobile_no`,`mobile_cachet_id`,`mobileno_updated_on`,`otp_received`,`mobile_validation_id`,`validation_updated_on`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'383c8fe6-4085-47a5-88f8-414f607bc2b7',NULL,'8838721805',1,'2023-09-13 09:57:09',8309,NULL,'2023-09-05 09:45:02',NULL,NULL,'2023-09-05 04:15:02','2023-09-05 05:11:53',NULL),
(24,'383c8fe6-4085-47a5-88f8-414f607bc2b7',NULL,'8838721801',3,'2023-09-13 09:58:09',9582,1,'2023-09-13 04:27:56',NULL,NULL,'2023-09-13 04:24:58','2023-09-13 04:28:09','2023-09-13 04:28:09');

/*Table structure for table `person_professions` */

DROP TABLE IF EXISTS `person_professions`;

CREATE TABLE `person_professions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(450) DEFAULT NULL,
  `org_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `dor` date DEFAULT NULL,
  `experience` date DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `person_professions` */

/*Table structure for table `person_profile_pics` */

DROP TABLE IF EXISTS `person_profile_pics`;

CREATE TABLE `person_profile_pics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `profile_pic` text DEFAULT NULL,
  `profile_cachet_id` int(11) NOT NULL,
  `profile_updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pfm_active_status_id` int(11) NOT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `person_profile_pics` */

insert  into `person_profile_pics`(`id`,`uid`,`profile_pic`,`profile_cachet_id`,`profile_updated_on`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(3,'383c8fe6-4085-47a5-88f8-414f607bc2b7','20230905042014_64f6ac7e210a4.jpg',1,'2023-09-05 09:50:14',1,NULL,'2023-09-05 04:20:14','2023-09-05 04:20:14',NULL);

/*Table structure for table `person_web_addresses` */

DROP TABLE IF EXISTS `person_web_addresses`;

CREATE TABLE `person_web_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `web_add` text NOT NULL,
  `web_cachet_id` int(11) NOT NULL,
  `pfm_active_status_id` int(11) NOT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `person_web_addresses` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `persons` */

DROP TABLE IF EXISTS `persons`;

CREATE TABLE `persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `pfm_stage_id` int(11) DEFAULT NULL,
  `pfm_origin_id` int(11) NOT NULL,
  `pfm_existence_id` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `persons` */

insert  into `persons`(`id`,`uid`,`pfm_stage_id`,`pfm_origin_id`,`pfm_existence_id`,`reason`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'383c8fe6-4085-47a5-88f8-414f607bc2b7',1,1,1,NULL,NULL,NULL,'2023-09-05 04:15:02','2023-09-05 04:15:02',NULL);

/*Table structure for table `pfm_active_status` */

DROP TABLE IF EXISTS `pfm_active_status`;

CREATE TABLE `pfm_active_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active_type` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pfm_active_status` */

/*Table structure for table `pfm_authorizations` */

DROP TABLE IF EXISTS `pfm_authorizations`;

CREATE TABLE `pfm_authorizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `authorization` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pfm_authorizations` */

/*Table structure for table `pfm_cachet` */

DROP TABLE IF EXISTS `pfm_cachet`;

CREATE TABLE `pfm_cachet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cachet` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pfm_cachet` */

/*Table structure for table `pfm_depone_status` */

DROP TABLE IF EXISTS `pfm_depone_status`;

CREATE TABLE `pfm_depone_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `depone_status` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pfm_depone_status` */

/*Table structure for table `pfm_existence` */

DROP TABLE IF EXISTS `pfm_existence`;

CREATE TABLE `pfm_existence` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `existence` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pfm_existence` */

/*Table structure for table `pfm_origin` */

DROP TABLE IF EXISTS `pfm_origin`;

CREATE TABLE `pfm_origin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `origin` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pfm_origin` */

/*Table structure for table `pfm_person_stage` */

DROP TABLE IF EXISTS `pfm_person_stage`;

CREATE TABLE `pfm_person_stage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person_stage` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pfm_person_stage` */

/*Table structure for table `pfm_survival` */

DROP TABLE IF EXISTS `pfm_survival`;

CREATE TABLE `pfm_survival` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `survival` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pfm_survival` */

/*Table structure for table `pfm_validation` */

DROP TABLE IF EXISTS `pfm_validation`;

CREATE TABLE `pfm_validation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `validation` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pfm_validation` */

/*Table structure for table `pfm_verfications` */

DROP TABLE IF EXISTS `pfm_verfications`;

CREATE TABLE `pfm_verfications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `verification` varchar(255) DEFAULT NULL,
  `active_status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pfm_verfications` */

/*Table structure for table `pims_bank_account_types` */

DROP TABLE IF EXISTS `pims_bank_account_types`;

CREATE TABLE `pims_bank_account_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_account_type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_bank_account_types` */

/*Table structure for table `pims_bank_addresses` */

DROP TABLE IF EXISTS `pims_bank_addresses`;

CREATE TABLE `pims_bank_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_bank_addresses` */

/*Table structure for table `pims_banks` */

DROP TABLE IF EXISTS `pims_banks`;

CREATE TABLE `pims_banks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_id` int(11) DEFAULT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `bank_alias` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_banks` */

/*Table structure for table `pims_banks_branchs` */

DROP TABLE IF EXISTS `pims_banks_branchs`;

CREATE TABLE `pims_banks_branchs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bank` varchar(255) NOT NULL,
  `ifsc` varchar(255) NOT NULL,
  `micr` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_banks_branchs` */

insert  into `pims_banks_branchs`(`id`,`bank`,`ifsc`,`micr`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'SBI','757567','32423',NULL,NULL,NULL,NULL,'2023-07-21 10:47:04',NULL,'2023-07-21 10:48:11',NULL),
(2,'ICICI','757567','32423',NULL,NULL,NULL,NULL,'2023-07-21 10:48:29',NULL,'2023-07-21 10:49:37','2023-07-21 10:49:37'),
(3,'IOB','132','123',NULL,NULL,NULL,NULL,'2023-07-27 06:18:48',NULL,'2023-07-27 06:18:48',NULL),
(4,'IOB','132','123',NULL,NULL,NULL,NULL,'2023-07-27 06:19:02',NULL,'2023-07-27 06:19:02',NULL),
(5,'fast','123','123',NULL,NULL,NULL,NULL,'2023-07-27 06:19:25',NULL,'2023-07-27 06:32:07','2023-07-27 06:32:07'),
(6,'www','www','www',NULL,NULL,NULL,NULL,'2023-07-27 06:19:36',NULL,'2023-07-27 06:31:41','2023-07-27 06:31:41'),
(7,'1','1','1',NULL,NULL,NULL,NULL,'2023-07-27 06:32:38',NULL,'2023-07-27 06:32:55','2023-07-27 06:32:55');

/*Table structure for table `pims_com_address_types` */

DROP TABLE IF EXISTS `pims_com_address_types`;

CREATE TABLE `pims_com_address_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address_of` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_com_address_types` */

insert  into `pims_com_address_types`(`id`,`address_of`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'Home',NULL,NULL,NULL,NULL,'2023-09-08 12:35:53',NULL,'2023-09-08 12:35:53',NULL),
(2,'Office',NULL,NULL,NULL,NULL,'2023-09-08 12:35:53',NULL,'2023-09-08 12:35:53',NULL),
(3,'bank',NULL,NULL,NULL,NULL,'2023-09-08 12:35:53',NULL,'2023-09-08 12:35:53',NULL),
(4,'Warehouse',NULL,NULL,NULL,NULL,'2023-09-08 12:35:53',NULL,'2023-09-08 12:35:53',NULL),
(5,'Godown',NULL,NULL,NULL,NULL,'2023-09-08 12:35:53',NULL,'2023-08-05 06:19:29','2023-08-05 06:19:29'),
(6,'Shop',NULL,NULL,NULL,NULL,'2023-09-08 12:35:53',NULL,'2023-08-04 07:33:54','2023-08-04 07:33:54'),
(7,'Factory',NULL,0,NULL,NULL,'2023-07-21 11:34:52',NULL,'2023-07-21 11:36:45','2023-07-21 11:36:45'),
(8,'Native',NULL,0,NULL,NULL,'2023-07-21 11:35:43',NULL,'2023-07-21 11:36:40','2023-07-21 11:36:40'),
(9,'demo',NULL,1,NULL,NULL,'2023-07-27 06:44:24',NULL,'2023-07-27 06:56:27','2023-07-27 06:56:27'),
(10,'testing',NULL,0,NULL,NULL,'2023-07-27 06:44:38',NULL,'2023-07-27 06:55:59','2023-07-27 06:55:59'),
(11,'part New',NULL,1,NULL,NULL,'2023-07-27 06:44:52',NULL,'2023-07-27 06:55:47','2023-07-27 06:55:47');

/*Table structure for table `pims_com_area` */

DROP TABLE IF EXISTS `pims_com_area`;

CREATE TABLE `pims_com_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pin_code` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_com_area` */

/*Table structure for table `pims_com_cities` */

DROP TABLE IF EXISTS `pims_com_cities`;

CREATE TABLE `pims_com_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_com_cities` */

insert  into `pims_com_cities`(`id`,`city`,`state_id`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'Salem',1,NULL,1,NULL,NULL,'2023-07-25 09:25:10',NULL,'2023-07-28 06:47:35',NULL),
(2,'erode',2,NULL,1,NULL,NULL,'2023-07-25 09:25:28',NULL,'2023-07-25 09:27:04',NULL),
(3,'trichy',1,NULL,1,NULL,NULL,'2023-07-25 09:25:40',NULL,'2023-07-25 09:25:40',NULL),
(5,'Chennai',1,NULL,1,NULL,NULL,'2023-07-28 06:28:47',NULL,'2023-07-28 06:28:47',NULL),
(6,'madurai',1,NULL,0,NULL,NULL,'2023-07-28 06:29:08',NULL,'2023-07-28 06:29:08',NULL),
(7,'vellore new',10,NULL,1,NULL,NULL,'2023-07-28 06:29:31',NULL,'2023-07-28 06:47:04','2023-07-28 06:47:04'),
(8,'orisa',2,NULL,0,NULL,NULL,'2023-07-28 06:48:03',NULL,'2023-07-28 06:50:08','2023-07-28 06:50:08');

/*Table structure for table `pims_com_countries` */

DROP TABLE IF EXISTS `pims_com_countries`;

CREATE TABLE `pims_com_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) DEFAULT NULL,
  `numeric_code` varchar(255) DEFAULT NULL,
  `phone_code` varchar(255) DEFAULT NULL,
  `capital` varchar(255) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_com_countries` */

insert  into `pims_com_countries`(`id`,`country`,`numeric_code`,`phone_code`,`capital`,`flag`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'london',NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2023-07-25 07:03:21',NULL,'2023-07-28 07:26:26','2023-07-28 07:26:26'),
(2,'UK',NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2023-07-25 07:05:27',NULL,'2023-07-25 07:05:38',NULL),
(3,'Indian',NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2023-07-26 10:00:12',NULL,'2023-07-26 10:23:48',NULL),
(4,'USA',NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2023-07-26 10:00:26',NULL,'2023-07-26 10:00:26',NULL),
(5,'Sri Lanka',NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,'2023-07-26 10:25:48',NULL,'2023-07-26 10:27:15',NULL),
(6,'Pakistan New',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,'2023-07-26 10:25:59',NULL,'2023-07-26 10:26:55','2023-07-28 11:36:20');

/*Table structure for table `pims_com_country_currency` */

DROP TABLE IF EXISTS `pims_com_country_currency`;

CREATE TABLE `pims_com_country_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `currency_short_code` varchar(255) DEFAULT NULL,
  `currency_symbol` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_com_country_currency` */

/*Table structure for table `pims_com_country_time` */

DROP TABLE IF EXISTS `pims_com_country_time`;

CREATE TABLE `pims_com_country_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `time_zone` varchar(255) DEFAULT NULL,
  `gmt_difference` varchar(255) DEFAULT NULL,
  `is_daylight` varchar(255) DEFAULT NULL,
  `daylight` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_com_country_time` */

/*Table structure for table `pims_com_districts` */

DROP TABLE IF EXISTS `pims_com_districts`;

CREATE TABLE `pims_com_districts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_com_districts` */

/*Table structure for table `pims_com_languages` */

DROP TABLE IF EXISTS `pims_com_languages`;

CREATE TABLE `pims_com_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_com_languages` */

insert  into `pims_com_languages`(`id`,`language`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'English',NULL,0,NULL,NULL,'2023-09-08 12:23:36',NULL,'2023-09-08 12:23:36',NULL),
(2,'Tamil',NULL,0,NULL,NULL,'2023-09-08 12:23:36',NULL,'2023-09-08 12:23:36',NULL),
(3,'Hindi',NULL,0,NULL,NULL,'2023-09-08 12:23:36',NULL,'2023-09-08 12:23:36',NULL),
(4,'Telngu',NULL,0,NULL,NULL,'2023-09-08 12:23:36',NULL,'2023-09-08 12:23:36',NULL),
(5,'Malayalam',NULL,0,NULL,NULL,'2023-09-08 12:23:36',NULL,'2023-09-08 12:23:36',NULL),
(6,'Kannada',NULL,0,NULL,NULL,'2023-09-08 12:23:36',NULL,'2023-09-08 12:23:36',NULL),
(7,'malayalam',NULL,1,NULL,NULL,'2023-07-22 06:14:35',NULL,'2023-07-22 06:17:08','2023-07-22 06:17:08'),
(8,'new',NULL,1,NULL,NULL,'2023-07-27 07:15:31',NULL,'2023-07-27 07:15:31',NULL),
(9,'new',NULL,0,NULL,NULL,'2023-07-27 07:15:46',NULL,'2023-07-27 07:15:46',NULL),
(10,'demo New',NULL,1,NULL,NULL,'2023-07-27 07:15:56',NULL,'2023-07-27 07:25:47','2023-07-27 07:25:47'),
(11,'part',NULL,0,NULL,NULL,'2023-07-27 07:26:02',NULL,'2023-07-27 07:26:26','2023-07-27 07:26:26');

/*Table structure for table `pims_com_states` */

DROP TABLE IF EXISTS `pims_com_states`;

CREATE TABLE `pims_com_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(355) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_com_states` */

insert  into `pims_com_states`(`id`,`state`,`country_id`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'Tamil Nadu',3,NULL,1,NULL,NULL,'2023-07-25 07:24:33',NULL,'2023-07-28 07:34:26',NULL),
(2,'Delhi',2,NULL,1,NULL,NULL,'2023-07-25 07:24:54',NULL,'2023-07-25 09:05:37',NULL),
(3,'Gujarat',3,NULL,1,NULL,NULL,'2023-07-25 07:25:54',NULL,'2023-07-28 07:37:38',NULL),
(6,'TN',3,NULL,1,NULL,NULL,'2023-07-28 05:32:53',NULL,'2023-07-28 05:32:53',NULL),
(7,'TN',3,NULL,1,NULL,NULL,'2023-07-28 05:33:28',NULL,'2023-07-28 05:33:28',NULL),
(8,'delhi',3,NULL,0,NULL,NULL,'2023-07-28 05:33:47',NULL,'2023-07-28 06:09:34',NULL),
(9,'Class New',4,NULL,1,NULL,NULL,'2023-07-28 05:35:14',NULL,'2023-07-28 06:07:47',NULL),
(10,'dd',2,NULL,1,NULL,NULL,'2023-07-28 05:35:46',NULL,'2023-07-28 07:36:32',NULL),
(11,'Aus New',2,NULL,1,NULL,NULL,'2023-07-28 06:10:43',NULL,'2023-07-28 07:29:46',NULL);

/*Table structure for table `pims_hrm_resource_activities` */

DROP TABLE IF EXISTS `pims_hrm_resource_activities`;

CREATE TABLE `pims_hrm_resource_activities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) DEFAULT NULL,
  `activity_status_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_hrm_resource_activities` */

insert  into `pims_hrm_resource_activities`(`id`,`name`,`activity_status_id`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'DateOfjoining',1,NULL,NULL,NULL,NULL,'2023-09-08 12:21:24',NULL,'2023-09-08 12:21:24',NULL),
(2,'Rejoin',1,NULL,NULL,NULL,NULL,'2023-09-08 12:21:24',NULL,'2023-09-08 12:21:24',NULL),
(3,'Break',2,NULL,NULL,NULL,NULL,'2023-09-08 12:21:24',NULL,'2023-09-08 12:21:24',NULL),
(4,'Relived',3,NULL,NULL,NULL,NULL,'2023-09-08 12:21:24',NULL,'2023-09-08 12:21:24',NULL);

/*Table structure for table `pims_hrm_resource_activity_statuses` */

DROP TABLE IF EXISTS `pims_hrm_resource_activity_statuses`;

CREATE TABLE `pims_hrm_resource_activity_statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) NOT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_hrm_resource_activity_statuses` */

insert  into `pims_hrm_resource_activity_statuses`(`id`,`name`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'Working',NULL,0,NULL,NULL,'2023-09-08 12:19:54',NULL,'2023-09-08 12:19:54',NULL),
(2,'AdmitBreak',NULL,1,NULL,NULL,'2023-09-08 12:19:54',NULL,'2023-09-08 12:19:54',NULL),
(3,'Relive Resource',NULL,1,NULL,NULL,'2023-09-08 12:19:54',NULL,'2023-09-08 12:19:54',NULL),
(4,'suspension',NULL,1,NULL,NULL,'2023-09-08 12:19:54',NULL,'2023-09-08 12:19:54',NULL),
(5,'terminated',NULL,1,NULL,NULL,'2023-09-08 12:19:54',NULL,'2023-09-08 12:19:54',NULL);

/*Table structure for table `pims_org_administrator_types` */

DROP TABLE IF EXISTS `pims_org_administrator_types`;

CREATE TABLE `pims_org_administrator_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_administrator_type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_org_administrator_types` */

insert  into `pims_org_administrator_types`(`id`,`org_administrator_type`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'Owner',NULL,NULL,NULL,NULL,'2023-09-08 12:15:14',NULL,'2023-09-08 12:15:14',NULL),
(2,'Partner',NULL,NULL,NULL,NULL,'2023-09-08 12:15:14',NULL,'2023-09-08 12:15:14',NULL),
(3,'Manging Director',NULL,NULL,NULL,NULL,'2023-09-08 12:15:14',NULL,'2023-09-08 12:15:14',NULL),
(4,'Director',NULL,NULL,NULL,NULL,'2023-09-08 12:15:14',NULL,'2023-09-08 12:15:14',NULL),
(5,'Employer',NULL,NULL,NULL,NULL,'2023-09-08 12:15:14',NULL,'2023-09-08 12:15:14',NULL),
(6,'Employee',NULL,NULL,NULL,NULL,'2023-09-08 12:15:14',NULL,'2023-09-08 12:15:14',NULL),
(7,'Auditor',NULL,NULL,NULL,NULL,'2023-09-08 12:15:14',NULL,'2023-09-08 12:15:14',NULL),
(8,'sample1',NULL,1,NULL,NULL,'2023-07-22 07:20:33',NULL,'2023-07-22 07:22:42','2023-07-22 07:22:42'),
(9,'sample145656554',NULL,1,NULL,NULL,'2023-07-22 07:23:06',NULL,'2023-07-22 07:23:33','2023-07-22 07:23:33'),
(10,'test',NULL,0,NULL,NULL,'2023-07-27 10:44:53',NULL,'2023-07-27 10:44:53',NULL),
(11,'demo',NULL,1,NULL,NULL,'2023-07-27 10:45:20',NULL,'2023-07-27 10:52:23','2023-07-27 10:52:23'),
(12,'color new',NULL,0,NULL,NULL,'2023-07-27 10:45:34',NULL,'2023-07-27 10:52:08','2023-07-27 10:52:08');

/*Table structure for table `pims_org_business_activities` */

DROP TABLE IF EXISTS `pims_org_business_activities`;

CREATE TABLE `pims_org_business_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_activity` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_org_business_activities` */

insert  into `pims_org_business_activities`(`id`,`business_activity`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'Sales',NULL,1,NULL,NULL,'2023-09-08 12:10:57',NULL,'2023-07-27 10:07:26',NULL),
(2,'Service',NULL,NULL,NULL,NULL,'2023-09-08 12:10:57',NULL,'2023-09-08 12:10:57',NULL),
(3,'Manufacturing',NULL,NULL,NULL,NULL,'2023-09-08 12:10:57',NULL,'2023-09-08 12:10:57',NULL),
(4,'Production',NULL,NULL,NULL,NULL,'2023-09-08 12:10:57',NULL,'2023-09-08 12:10:57',NULL),
(5,'Export',NULL,NULL,NULL,NULL,'2023-09-08 12:10:57',NULL,'2023-09-08 12:10:57',NULL),
(6,'Testing',NULL,0,NULL,NULL,'2023-07-22 09:49:42',NULL,'2023-07-22 09:51:14','2023-07-22 09:51:14'),
(7,'Testing',NULL,0,NULL,NULL,'2023-07-22 09:52:06',NULL,'2023-07-22 09:52:06',NULL),
(8,'demo',NULL,0,NULL,NULL,'2023-07-27 10:00:11',NULL,'2023-07-27 10:00:11',NULL),
(9,'clear New',NULL,1,NULL,NULL,'2023-07-27 10:00:31',NULL,'2023-07-27 10:08:48','2023-07-27 10:08:48'),
(10,'Part',NULL,0,NULL,NULL,'2023-07-27 10:09:10',NULL,'2023-07-27 10:09:10',NULL),
(11,'slowbgdg',NULL,0,NULL,NULL,'2023-07-27 10:09:18',NULL,'2023-07-27 10:09:42','2023-07-27 10:09:42');

/*Table structure for table `pims_org_business_sale_subsets` */

DROP TABLE IF EXISTS `pims_org_business_sale_subsets`;

CREATE TABLE `pims_org_business_sale_subsets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_sale_subset` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_org_business_sale_subsets` */

insert  into `pims_org_business_sale_subsets`(`id`,`business_sale_subset`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'Retail',NULL,NULL,NULL,NULL,'2023-09-08 12:09:30',NULL,'2023-09-08 12:09:30',NULL),
(2,'Whole Sale',NULL,NULL,NULL,NULL,'2023-09-08 12:09:30',NULL,'2023-09-08 12:09:30',NULL),
(3,'Trading',NULL,NULL,NULL,NULL,'2023-09-08 12:09:30',NULL,'2023-09-08 12:09:30',NULL),
(4,'E-commerce',NULL,NULL,NULL,NULL,'2023-09-08 12:09:30',NULL,'2023-09-08 12:09:30',NULL),
(5,'new one',NULL,0,NULL,NULL,'2023-07-22 10:17:36',NULL,'2023-07-22 10:18:48','2023-07-22 10:18:48'),
(6,'common new',NULL,1,NULL,NULL,'2023-07-27 11:42:20',NULL,'2023-07-27 11:51:26','2023-07-27 11:51:26'),
(7,'fast',NULL,0,NULL,NULL,'2023-07-27 11:42:37',NULL,'2023-07-27 11:42:37',NULL),
(8,'new',NULL,0,NULL,NULL,'2023-07-27 11:52:05',NULL,'2023-07-27 11:52:22','2023-07-27 11:52:22');

/*Table structure for table `pims_org_business_sectors` */

DROP TABLE IF EXISTS `pims_org_business_sectors`;

CREATE TABLE `pims_org_business_sectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_sector` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_org_business_sectors` */

insert  into `pims_org_business_sectors`(`id`,`business_sector`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'Sector',NULL,0,NULL,NULL,'2023-07-24 11:52:05',NULL,'2023-07-24 11:52:31',NULL),
(2,'Sector New',NULL,0,NULL,NULL,'2023-07-24 11:52:39',NULL,'2023-07-24 11:53:41','2023-07-24 11:53:41'),
(3,'new',NULL,1,NULL,NULL,'2023-07-27 12:00:10',NULL,'2023-07-27 12:00:10',NULL),
(4,'yes',NULL,1,NULL,NULL,'2023-07-27 12:00:18',NULL,'2023-07-27 12:07:24','2023-07-27 12:07:24'),
(5,'demo',NULL,0,NULL,NULL,'2023-07-27 12:00:46',NULL,'2023-07-27 12:07:40','2023-07-27 12:07:40');

/*Table structure for table `pims_org_categories` */

DROP TABLE IF EXISTS `pims_org_categories`;

CREATE TABLE `pims_org_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_category` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_org_categories` */

insert  into `pims_org_categories`(`id`,`org_category`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'Business',NULL,NULL,NULL,NULL,'2023-09-08 12:05:44',NULL,'2023-09-08 12:05:44',NULL),
(2,'Goverment',NULL,NULL,NULL,NULL,'2023-09-08 12:05:44',NULL,'2023-09-08 12:05:44',NULL),
(3,'NGO-Non Gov Org',NULL,NULL,NULL,NULL,'2023-09-08 12:05:44',NULL,'2023-09-08 12:05:44',NULL),
(4,'Social Party',NULL,NULL,NULL,NULL,'2023-09-08 12:05:44',NULL,'2023-09-08 12:05:44',NULL),
(5,'Society',NULL,NULL,NULL,NULL,'2023-09-08 12:05:44',NULL,'2023-09-08 12:05:44',NULL),
(7,'demo testing',NULL,1,NULL,NULL,'2023-07-24 12:37:04',NULL,'2023-07-24 12:38:50','2023-07-24 12:38:50'),
(8,'last',NULL,1,NULL,NULL,'2023-07-27 12:17:32',NULL,'2023-07-27 12:24:53','2023-07-27 12:24:53'),
(9,'clodse',NULL,0,NULL,NULL,'2023-07-27 12:18:26',NULL,'2023-07-27 12:18:26',NULL),
(10,'growth',NULL,1,NULL,NULL,'2023-07-27 12:25:07',NULL,'2023-07-27 12:25:23','2023-07-27 12:25:23');

/*Table structure for table `pims_org_document_types` */

DROP TABLE IF EXISTS `pims_org_document_types`;

CREATE TABLE `pims_org_document_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_doc_type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_org_document_types` */

insert  into `pims_org_document_types`(`id`,`org_doc_type`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'PAN',NULL,NULL,NULL,NULL,'2023-09-08 12:03:56',NULL,'2023-09-08 12:03:56',NULL),
(2,'GST',NULL,NULL,NULL,NULL,'2023-09-08 12:03:56',NULL,'2023-09-08 12:03:56',NULL),
(3,'CIN',NULL,NULL,NULL,NULL,'2023-09-08 12:03:56',NULL,'2023-09-08 12:03:56',NULL),
(4,'TAN',NULL,NULL,NULL,NULL,'2023-09-08 12:03:56',NULL,'2023-09-08 12:03:56',NULL),
(5,'TIN',NULL,NULL,NULL,NULL,'2023-09-08 12:03:56',NULL,'2023-09-08 12:03:56',NULL),
(6,'SME',NULL,NULL,NULL,NULL,'2023-09-08 12:03:56',NULL,'2023-09-08 12:03:56',NULL),
(7,'FSSAI',NULL,NULL,NULL,NULL,'2023-09-08 12:03:56',NULL,'2023-09-08 12:03:56',NULL),
(8,'Partner_registration',NULL,NULL,NULL,NULL,'2023-09-08 12:03:56',NULL,'2023-09-08 12:03:56',NULL),
(9,'Registration Of Factories',NULL,NULL,NULL,NULL,'2023-09-08 12:03:56',NULL,'2023-09-08 12:03:56',NULL),
(10,'Udyog aadhar',NULL,NULL,NULL,NULL,'2023-09-08 12:03:56',NULL,'2023-09-08 12:03:56',NULL),
(11,'demo',NULL,1,NULL,NULL,'2023-07-25 04:39:40',NULL,'2023-07-25 04:42:59','2023-07-25 04:42:59'),
(12,'2',NULL,1,NULL,NULL,'2023-07-27 12:36:39',NULL,'2023-07-27 12:43:36','2023-07-27 12:43:36'),
(13,'wwww',NULL,0,NULL,NULL,'2023-07-27 12:37:22',NULL,'2023-07-27 12:43:50','2023-07-27 12:43:50');

/*Table structure for table `pims_org_ownerships` */

DROP TABLE IF EXISTS `pims_org_ownerships`;

CREATE TABLE `pims_org_ownerships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_ownership` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_org_ownerships` */

insert  into `pims_org_ownerships`(`id`,`org_ownership`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'Professional',NULL,NULL,NULL,NULL,'2023-09-08 12:01:46',NULL,'2023-09-08 12:01:46',NULL),
(2,'Sole Proprietorship',NULL,NULL,NULL,NULL,'2023-09-08 12:01:46',NULL,'2023-09-08 12:01:46',NULL),
(3,'Partnership',NULL,NULL,NULL,NULL,'2023-09-08 12:01:46',NULL,'2023-09-08 12:01:46',NULL),
(4,'LIC',NULL,NULL,NULL,NULL,'2023-09-08 12:01:46',NULL,'2023-09-08 12:01:46',NULL),
(5,'Pvt Limited',NULL,NULL,NULL,NULL,'2023-09-08 12:01:46',NULL,'2023-09-08 12:01:46',NULL),
(6,'Public Limited',NULL,0,NULL,NULL,'2023-09-08 12:01:46',NULL,'2023-09-08 12:01:46',NULL),
(7,'Trust/Foundation',NULL,NULL,NULL,NULL,'2023-09-08 12:01:46',NULL,'2023-09-08 12:01:46',NULL),
(8,'demo',NULL,1,NULL,NULL,'2023-07-25 05:28:20',NULL,'2023-07-25 05:29:15','2023-07-25 05:29:15'),
(9,'new',NULL,1,NULL,NULL,'2023-07-27 12:52:30',NULL,'2023-07-27 12:58:37','2023-07-27 12:58:37'),
(10,'newb',NULL,0,NULL,NULL,'2023-07-27 12:52:39',NULL,'2023-07-27 12:59:04','2023-07-27 12:59:04'),
(11,'demo  2',NULL,0,NULL,NULL,'2023-07-27 12:52:49',NULL,'2023-07-27 12:58:24','2023-07-27 12:58:24');

/*Table structure for table `pims_org_structures` */

DROP TABLE IF EXISTS `pims_org_structures`;

CREATE TABLE `pims_org_structures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `org_structure` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_org_structures` */

/*Table structure for table `pims_person_blood_groups` */

DROP TABLE IF EXISTS `pims_person_blood_groups`;

CREATE TABLE `pims_person_blood_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blood_group` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_person_blood_groups` */

insert  into `pims_person_blood_groups`(`id`,`blood_group`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(11,'A+ve','sample',1,NULL,NULL,'2023-07-18 12:17:55',NULL,'2023-07-18 12:28:09','2023-07-18 12:28:09'),
(12,'AB','demo',1,NULL,NULL,'2023-07-26 11:28:31',NULL,'2023-07-26 11:28:31',NULL),
(13,'AB','demo',1,NULL,NULL,'2023-07-26 11:28:47',NULL,'2023-07-26 11:28:47',NULL),
(14,'AC',NULL,0,NULL,NULL,'2023-07-26 11:29:00',NULL,'2023-07-26 11:29:00',NULL),
(15,'requried','ssss',1,NULL,NULL,'2023-07-26 11:29:54',NULL,'2023-07-26 11:58:42','2023-07-26 11:58:42'),
(16,'New','New',1,NULL,NULL,'2023-07-26 12:00:23',NULL,'2023-07-26 12:00:55',NULL),
(17,'Part','clear',1,NULL,NULL,'2023-07-26 12:00:39',NULL,'2023-07-26 12:01:32',NULL);

/*Table structure for table `pims_person_document_types` */

DROP TABLE IF EXISTS `pims_person_document_types`;

CREATE TABLE `pims_person_document_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_doc_type` varchar(255) NOT NULL,
  `mandatory_status` int(11) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_person_document_types` */

insert  into `pims_person_document_types`(`id`,`person_doc_type`,`mandatory_status`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(1,'Aadhar',NULL,1,NULL,NULL,'2023-09-08 11:49:50',NULL,'2023-09-08 11:49:50',NULL),
(2,'PAN New',NULL,1,NULL,NULL,'2023-09-08 11:49:50',NULL,'2023-07-26 09:10:06','2023-07-26 09:10:06'),
(3,'Driving license',NULL,1,NULL,NULL,'2023-09-08 11:49:50',NULL,'2023-07-26 09:07:33',NULL),
(4,'DIN',NULL,1,NULL,NULL,'2023-09-08 11:49:50',NULL,'2023-09-08 11:49:50',NULL),
(5,'Passport',NULL,0,NULL,NULL,'2023-09-08 11:49:50',NULL,'2023-09-08 11:49:50',NULL),
(6,'Voter ID',NULL,0,NULL,NULL,'2023-09-08 11:49:50',NULL,'2023-09-08 11:49:50',NULL),
(7,'new',NULL,1,NULL,NULL,'2023-07-25 05:56:24',NULL,'2023-07-25 05:57:45','2023-07-25 05:57:45'),
(8,'demo',NULL,1,NULL,NULL,'2023-07-25 05:56:38',NULL,'2023-07-25 05:57:36','2023-07-25 05:57:36'),
(9,'pan new',NULL,1,NULL,NULL,'2023-07-26 09:15:43',NULL,'2023-07-26 09:16:29',NULL),
(10,'color',NULL,0,NULL,NULL,'2023-07-26 09:15:52',NULL,'2023-07-26 09:16:06',NULL);

/*Table structure for table `pims_person_genders` */

DROP TABLE IF EXISTS `pims_person_genders`;

CREATE TABLE `pims_person_genders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_person_genders` */

insert  into `pims_person_genders`(`id`,`gender`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(9,'male',NULL,1,NULL,NULL,'2023-07-18 07:11:53',NULL,'2023-07-18 07:11:53',NULL),
(10,'female',NULL,1,NULL,NULL,'2023-07-20 11:27:32',NULL,'2023-07-20 11:28:06',NULL);

/*Table structure for table `pims_person_marital_statues` */

DROP TABLE IF EXISTS `pims_person_marital_statues`;

CREATE TABLE `pims_person_marital_statues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marital_status` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_person_marital_statues` */

insert  into `pims_person_marital_statues`(`id`,`marital_status`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(14,'Single',NULL,0,NULL,NULL,'2023-07-26 12:37:29',NULL,'2023-07-26 12:38:28','2023-07-26 12:38:28');

/*Table structure for table `pims_person_qualifications` */

DROP TABLE IF EXISTS `pims_person_qualifications`;

CREATE TABLE `pims_person_qualifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qualification` varchar(255) NOT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_person_qualifications` */

/*Table structure for table `pims_person_relationships` */

DROP TABLE IF EXISTS `pims_person_relationships`;

CREATE TABLE `pims_person_relationships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_relationship` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_person_relationships` */

insert  into `pims_person_relationships`(`id`,`person_relationship`,`description`,`active_status`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(14,'Father',NULL,0,NULL,NULL,'2023-07-19 05:39:45',NULL,'2023-07-19 05:39:45',NULL),
(15,'Sons',NULL,0,NULL,NULL,'2023-07-19 05:40:15',NULL,'2023-07-19 05:41:48','2023-07-19 05:41:48'),
(16,'new One',NULL,0,NULL,NULL,'2023-07-27 04:03:32',NULL,'2023-07-27 04:23:21','2023-07-27 04:23:21'),
(17,'test',NULL,0,NULL,NULL,'2023-07-27 04:03:45',NULL,'2023-07-27 04:03:45',NULL),
(18,'like',NULL,1,NULL,NULL,'2023-07-27 04:03:54',NULL,'2023-07-27 04:03:54',NULL),
(19,'fast','fast',1,NULL,NULL,'2023-07-27 04:23:40',NULL,'2023-07-27 04:24:15',NULL),
(20,'slow',NULL,0,NULL,NULL,'2023-07-27 04:23:58',NULL,'2023-07-27 04:24:45','2023-07-27 04:24:45');

/*Table structure for table `pims_person_salutations` */

DROP TABLE IF EXISTS `pims_person_salutations`;

CREATE TABLE `pims_person_salutations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salutation` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_person_salutations` */

insert  into `pims_person_salutations`(`id`,`salutation`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`created_at`,`last_updated_by`,`updated_at`,`deleted_at`) values 
(14,'mr','sample',0,NULL,NULL,'2023-07-18 07:08:42',NULL,'2023-07-18 07:11:08',NULL),
(15,'ms',NULL,1,NULL,NULL,'2023-07-20 11:18:42',NULL,'2023-07-20 11:18:42',NULL),
(16,'other',NULL,1,NULL,NULL,'2023-07-20 11:25:43',NULL,'2023-07-20 11:25:43',NULL),
(17,'men',NULL,1,NULL,NULL,'2023-07-20 11:26:28',NULL,'2023-07-20 11:26:28',NULL);

/*Table structure for table `pims_user_permission` */

DROP TABLE IF EXISTS `pims_user_permission`;

CREATE TABLE `pims_user_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `last_updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_user_permission` */

insert  into `pims_user_permission`(`id`,`permission`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`last_updated_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'setting',NULL,1,NULL,NULL,NULL,'2023-09-08 11:14:49','2023-09-08 11:14:49',NULL),
(2,'CommonMaster',NULL,1,NULL,NULL,NULL,'2023-09-08 11:14:49','2023-09-08 11:14:49',NULL),
(3,'Organization',NULL,1,NULL,NULL,NULL,'2023-09-08 11:14:49','2023-09-08 11:14:49',NULL);

/*Table structure for table `pims_user_role_masters` */

DROP TABLE IF EXISTS `pims_user_role_masters`;

CREATE TABLE `pims_user_role_masters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) DEFAULT NULL,
  `is_admin` int(11) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `last_updated_by` varchar(255) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_user_role_masters` */

insert  into `pims_user_role_masters`(`id`,`role`,`is_admin`,`pfm_active_status_id`,`created_by`,`last_updated_by`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(5,'Master Person',9,0,NULL,NULL,NULL,'2023-08-04 07:25:51','2023-08-04 07:32:37',NULL),
(6,'Setting New',9,0,NULL,NULL,NULL,'2023-08-04 07:33:03','2023-08-04 07:34:05',NULL),
(8,'Clear',9,0,NULL,NULL,NULL,'2023-08-05 06:29:10','2023-08-05 06:31:50','2023-08-05 06:31:50'),
(9,'Clear',9,0,NULL,NULL,NULL,'2023-08-05 06:35:56','2023-08-05 06:37:06','2023-08-05 06:37:06'),
(10,'Clear',9,0,NULL,NULL,NULL,'2023-08-05 06:36:52','2023-08-05 06:37:14','2023-08-05 06:37:14');

/*Table structure for table `pims_user_roles` */

DROP TABLE IF EXISTS `pims_user_roles`;

CREATE TABLE `pims_user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pims_role_master_id` int(11) DEFAULT NULL,
  `pims_user_permission_id` int(11) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_user_roles` */

/*Table structure for table `pims_users` */

DROP TABLE IF EXISTS `pims_users`;

CREATE TABLE `pims_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pims_user_role_id` int(11) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pims_users` */

insert  into `pims_users`(`id`,`name`,`mobile_no`,`email`,`password`,`pims_user_role_id`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(5,'harish Kumar','9698591808','kumar@gmail.com','$2y$10$inZMEV9eEo0Ij4DNTIoDneck4Nhm1UggZt2CIJYmBhyaE0fUiRVa2',6,NULL,NULL,'2023-07-21 06:44:45','2023-08-05 11:48:56',NULL),
(6,'dinesh','9865395029','dinesh@gmail.com','$2y$10$yelHkCorZ1BGHOpCC/f96.Jzs9cgB3G8lqvpk2B90oOSX8bxjeJLO',4,NULL,NULL,'2023-08-05 03:57:30','2023-08-05 09:40:10',NULL),
(7,'Ravi','9890987656','Ravi@gmail.com','$2y$10$/muN/hB/MzABhW51ezS.3eXUZul.Eh0RzsPfdI6.hYbpo.K5SYvcm',5,NULL,NULL,'2023-08-05 04:50:06','2023-08-05 04:50:06',NULL);

/*Table structure for table `sms_manipulations` */

DROP TABLE IF EXISTS `sms_manipulations`;

CREATE TABLE `sms_manipulations` (
  `id` int(11) DEFAULT NULL,
  `mobile_no` varchar(150) DEFAULT NULL,
  `sms_type_id` int(11) DEFAULT NULL,
  `sms_content` text DEFAULT NULL,
  `uid` varchar(150) DEFAULT NULL,
  `pfm_active_status_id` int(1) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `sms_manipulations` */

insert  into `sms_manipulations`(`id`,`mobile_no`,`sms_type_id`,`sms_content`,`uid`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(NULL,'8838721805',1,'8309','383c8fe6-4085-47a5-88f8-414f607bc2b7',NULL,NULL,'2023-09-05 05:11:53','2023-09-05 05:11:53',NULL);

/*Table structure for table `sms_types` */

DROP TABLE IF EXISTS `sms_types`;

CREATE TABLE `sms_types` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `last_updated_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `sms_types` */

insert  into `sms_types`(`id`,`name`,`description`,`pfm_active_status_id`,`deleted_flag`,`created_by`,`last_updated_by`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'PersonToUser',NULL,1,NULL,NULL,NULL,'2023-09-08 11:09:34','2023-09-08 11:09:34',NULL);

/*Table structure for table `subscribers` */

DROP TABLE IF EXISTS `subscribers`;

CREATE TABLE `subscribers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(191) NOT NULL,
  `primary_mobile` varchar(191) DEFAULT NULL,
  `primary_email` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `pfm_stage_id` int(11) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `subscribers` */

/*Table structure for table `temp_emails` */

DROP TABLE IF EXISTS `temp_emails`;

CREATE TABLE `temp_emails` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) NOT NULL,
  `otp_received` int(11) NOT NULL,
  `pfm_stage_id` int(11) NOT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `temp_emails` */

/*Table structure for table `temp_mobiles` */

DROP TABLE IF EXISTS `temp_mobiles`;

CREATE TABLE `temp_mobiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mobile_no` varchar(191) NOT NULL,
  `otp_received` int(11) NOT NULL,
  `pfm_stage_id` int(11) NOT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `temp_mobiles` */

/*Table structure for table `temp_organizations` */

DROP TABLE IF EXISTS `temp_organizations`;

CREATE TABLE `temp_organizations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `authorized_person_id` varchar(191) DEFAULT NULL,
  `organization_detail` text DEFAULT NULL,
  `organization_address` text DEFAULT NULL,
  `organization_doc_type` text DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `temp_organizations` */

/*Table structure for table `temp_persons` */

DROP TABLE IF EXISTS `temp_persons`;

CREATE TABLE `temp_persons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile_no` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `personal_data` text DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `pfm_stage_id` int(11) NOT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `temp_persons` */

/*Table structure for table `user_organization_relationals` */

DROP TABLE IF EXISTS `user_organization_relationals`;

CREATE TABLE `user_organization_relationals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `default_org` int(11) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_organization_relationals` */

/*Table structure for table `user_token_logs` */

DROP TABLE IF EXISTS `user_token_logs`;

CREATE TABLE `user_token_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `token_in_time` time DEFAULT NULL,
  `token_out_time` time DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_token_logs` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(255) DEFAULT NULL,
  `primary_mobile` varchar(255) DEFAULT NULL,
  `primary_email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `pfm_stage_id` int(11) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`uid`,`primary_mobile`,`primary_email`,`password`,`pfm_stage_id`,`pfm_active_status_id`,`deleted_flag`,`created_at`,`updated_at`,`deleted_at`) values 
(1,'383c8fe6-4085-47a5-88f8-414f607bc2b7','8838721805','harish@gmail.com','$2y$10$GsKlWhdFKtOByaeWWCoVtuqD1Va32dycGFUWBLGSu1dhXDBhmzRXK',1,NULL,NULL,'2023-09-05 05:13:02','2023-09-05 05:13:02',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
