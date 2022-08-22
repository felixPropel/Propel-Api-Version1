/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.22-MariaDB : Database - propel-new
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`propel-new` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `propel-new`;

/*Table structure for table `hrm_designations` */

DROP TABLE IF EXISTS `hrm_designations`;

CREATE TABLE `hrm_designations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

/*Data for the table `hrm_designations` */

insert  into `hrm_designations`(`id`,`name`,`dept_id`,`description`,`status`,`created_at`,`deleted_at`,`updated_at`) values 
(1,'A',14,NULL,1,NULL,NULL,NULL),
(2,'B',15,NULL,1,NULL,NULL,NULL),
(3,'Un-Assigned',NULL,NULL,1,NULL,NULL,NULL),
(4,'C',NULL,NULL,1,NULL,NULL,NULL),
(5,'sample',NULL,NULL,1,'2022-08-19 12:48:03',NULL,'2022-08-19 12:48:03'),
(6,'sample',3,NULL,1,'2022-08-19 12:50:59',NULL,'2022-08-19 12:50:59'),
(7,'Welcome',16,NULL,1,'2022-08-19 12:52:49',NULL,'2022-08-19 12:52:49'),
(8,'New 1',13,NULL,1,'2022-08-19 12:53:47',NULL,'2022-08-19 12:53:47'),
(9,'Rest API',3,NULL,1,'2022-08-19 12:54:04',NULL,'2022-08-19 12:54:04'),
(10,'Rest API we',20,NULL,1,'2022-08-19 12:55:27',NULL,'2022-08-19 12:55:27');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
