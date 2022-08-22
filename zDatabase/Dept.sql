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

/*Table structure for table `hrm_departments` */

DROP TABLE IF EXISTS `hrm_departments`;

CREATE TABLE `hrm_departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `parent_dept_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

/*Data for the table `hrm_departments` */

insert  into `hrm_departments`(`id`,`name`,`parent_dept_id`,`description`,`status`,`created_at`,`updated_at`,`deleted_at`) values 
(13,'CS',NULL,NULL,0,'2022-08-17 09:58:22','2022-08-17 09:58:22',NULL),
(14,'Maths',13,'Maths Dept',0,NULL,NULL,NULL),
(15,'MCA',14,'Sample',1,'2022-08-18 10:24:34','2022-08-18 10:24:34',NULL),
(16,'MBA',13,'Sample',1,'2022-08-18 10:29:15','2022-08-19 04:51:53',NULL),
(17,'MSC',13,'Sample',1,'2022-08-18 10:31:08','2022-08-18 10:31:08',NULL),
(18,'MTECH',15,'Changed MCA DEPT',1,'2022-08-18 10:38:57','2022-08-19 04:52:25',NULL),
(20,'B.com',19,'One Of Commerce',1,'2022-08-19 05:06:03','2022-08-19 05:06:03',NULL),
(21,'BBA',19,'BBA',1,'2022-08-19 05:08:43','2022-08-19 05:08:43',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
