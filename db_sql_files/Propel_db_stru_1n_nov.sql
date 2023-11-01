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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `oauth_personal_access_clients` */

DROP TABLE IF EXISTS `oauth_personal_access_clients`;

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `permission_user` */

DROP TABLE IF EXISTS `permission_user`;

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `user_type` varchar(191) NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`),
  CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `display_name` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `person_emails` */

DROP TABLE IF EXISTS `person_emails`;

CREATE TABLE `person_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_cachet_id` int(11) NOT NULL,
  `email_updated_on` datetime DEFAULT current_timestamp(),
  `otp_received` int(11) DEFAULT NULL,
  `email_validation_id` int(11) DEFAULT NULL,
  `validation_updated_on` datetime DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires_at` varchar(255) DEFAULT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `pfm_active_status` */

DROP TABLE IF EXISTS `pfm_active_status`;

CREATE TABLE `pfm_active_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active_type` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `active_status` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `last_updated_by` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `pfm_cachet` */

DROP TABLE IF EXISTS `pfm_cachet`;

CREATE TABLE `pfm_cachet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cachet` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `pfm_depone_status` */

DROP TABLE IF EXISTS `pfm_depone_status`;

CREATE TABLE `pfm_depone_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `depone_status` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `pfm_existence` */

DROP TABLE IF EXISTS `pfm_existence`;

CREATE TABLE `pfm_existence` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `existence` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `pfm_origin` */

DROP TABLE IF EXISTS `pfm_origin`;

CREATE TABLE `pfm_origin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `origin` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `pfm_person_stage` */

DROP TABLE IF EXISTS `pfm_person_stage`;

CREATE TABLE `pfm_person_stage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person_stage` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `pfm_survival` */

DROP TABLE IF EXISTS `pfm_survival`;

CREATE TABLE `pfm_survival` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `survival` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `pfm_validation` */

DROP TABLE IF EXISTS `pfm_validation`;

CREATE TABLE `pfm_validation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `validation` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `pims_com_area` */

DROP TABLE IF EXISTS `pims_com_area`;

CREATE TABLE `pims_com_area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pin_code` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `pims_com_cities` */

DROP TABLE IF EXISTS `pims_com_cities`;

CREATE TABLE `pims_com_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `pims_person_document_types` */

DROP TABLE IF EXISTS `pims_person_document_types`;

CREATE TABLE `pims_person_document_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_doc_type` varchar(255) NOT NULL,
  `mandatory_status` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `pims_person_qualifications` */

DROP TABLE IF EXISTS `pims_person_qualifications`;

CREATE TABLE `pims_person_qualifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qualification` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `pims_person_relationships` */

DROP TABLE IF EXISTS `pims_person_relationships`;

CREATE TABLE `pims_person_relationships` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_relationship` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `pfm_active_status_id` int(11) DEFAULT NULL,
  `deleted_flag` int(11) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated_by` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Table structure for table `role_user` */

DROP TABLE IF EXISTS `role_user`;

CREATE TABLE `role_user` (
  `role_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `user_type` varchar(191) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  KEY `role_user_role_id_foreign` (`role_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `display_name` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
