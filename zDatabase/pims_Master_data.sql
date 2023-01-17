/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.24-MariaDB : Database - propel_version1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`propel_version1` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `propel_version1`;

/*Data for the table `pims_com_address_types` */

insert  into `pims_com_address_types`(`id`,`address_of`,`status`,`created_at`,`updated_at`) values 
(1,'Home',NULL,NULL,NULL),
(2,'Office',NULL,NULL,NULL),
(3,'bank',NULL,NULL,NULL),
(4,'Warehouse',NULL,NULL,NULL),
(5,'Godown',NULL,NULL,NULL),
(6,'Shop',NULL,NULL,NULL);

/*Data for the table `pims_com_languages` */

insert  into `pims_com_languages`(`id`,`language`,`status`) values 
(1,'English',0),
(2,'Tamil',0),
(3,'Hindi',0),
(4,'Telngu',0),
(5,'Malayalam',0),
(6,'Kannada',0);

/*Data for the table `pims_org_administrator_types` */

insert  into `pims_org_administrator_types`(`id`,`org_administrator_type`,`status`,`created_at`,`updated_at`) values 
(1,'Owner',NULL,NULL,NULL),
(2,'Partner',NULL,NULL,NULL),
(3,'Manging Director',NULL,NULL,NULL),
(4,'Director',NULL,NULL,NULL),
(5,'Employer',NULL,NULL,NULL),
(6,'Employee',NULL,NULL,NULL),
(7,'Auditor',NULL,NULL,NULL);

/*Data for the table `pims_org_business_activities` */

insert  into `pims_org_business_activities`(`id`,`business_activity`,`status`,`created_at`,`updated_at`) values 
(1,'Sales',NULL,NULL,NULL),
(2,'Service',NULL,NULL,NULL),
(3,'Manufacturing',NULL,NULL,NULL),
(4,'Production',NULL,NULL,NULL),
(5,'Export',NULL,NULL,NULL);

/*Data for the table `pims_org_business_sale_subsets` */

insert  into `pims_org_business_sale_subsets`(`id`,`business_sale_subset`,`status`,`created_at`,`updated_at`) values 
(1,'Retail',NULL,NULL,NULL),
(2,'Whole Sale',NULL,NULL,NULL),
(3,'Trading',NULL,NULL,NULL),
(4,'E-commerce',NULL,NULL,NULL);

/*Data for the table `pims_org_categories` */

insert  into `pims_org_categories`(`id`,`org_category`,`status`,`created_at`,`updated_at`) values 
(1,'Business',NULL,NULL,NULL),
(2,'Goverment',NULL,NULL,NULL),
(3,'NGO-Non Gov Org',NULL,NULL,NULL),
(4,'Social Party',NULL,NULL,NULL),
(5,'Society',NULL,NULL,NULL);

/*Data for the table `pims_org_document_types` */

insert  into `pims_org_document_types`(`id`,`org_doc_type`,`status`,`created_at`,`updated_at`) values 
(1,'PAN',NULL,NULL,NULL),
(2,'GST',NULL,NULL,NULL),
(3,'CIN',NULL,NULL,NULL),
(4,'TAN',NULL,NULL,NULL),
(5,'TIN',NULL,NULL,NULL),
(6,'SME',NULL,NULL,NULL),
(7,'FSSAI',NULL,NULL,NULL),
(8,'Partner_registration',NULL,NULL,NULL),
(9,'Registration Of Factories',NULL,NULL,NULL),
(10,'Udyog aadhar',NULL,NULL,NULL);

/*Data for the table `pims_org_ownerships` */

insert  into `pims_org_ownerships`(`id`,`org_ownership`,`status`,`created_at`,`updated_at`) values 
(1,'Professional',NULL,NULL,NULL),
(2,'Sole Proprietorship',NULL,NULL,NULL),
(3,'Partnership',NULL,NULL,NULL),
(4,'LIC',NULL,NULL,NULL),
(5,'Pvt Limited',NULL,NULL,NULL),
(6,'Public Limited',0,NULL,NULL),
(7,'Trust/Foundation',NULL,NULL,NULL);

/*Data for the table `pims_person_blood_groups` */

insert  into `pims_person_blood_groups`(`id`,`blood_group`,`created_at`,`updated_at`) values 
(1,'A+ve',NULL,NULL),
(2,'A-ve',NULL,NULL),
(3,'B+ve',NULL,NULL),
(4,'B-ve',NULL,NULL),
(5,'O+ve',NULL,NULL),
(6,'O-ve',NULL,NULL),
(7,'AB+ve',NULL,NULL),
(8,'AB-ve',NULL,NULL);

/*Data for the table `pims_person_document_types` */

insert  into `pims_person_document_types`(`id`,`person_doc_type`,`mandatory_status`,`created_at`,`updated_at`) values 
(1,'Aadhar',0,NULL,NULL),
(2,'PAN',0,NULL,NULL),
(3,'Driving license',0,NULL,NULL),
(4,'DIN',0,NULL,NULL),
(5,'Passport',0,NULL,NULL),
(6,'Voter ID',0,NULL,NULL);

/*Data for the table `pims_person_genders` */

insert  into `pims_person_genders`(`id`,`gender`,`created_at`,`updated_at`) values 
(1,'Male',NULL,NULL),
(2,'Female',NULL,NULL),
(3,'Transgender',NULL,NULL);

/*Data for the table `pims_person_marital_statues` */

insert  into `pims_person_marital_statues`(`id`,`name`,`created_at`,`updated_at`) values 
(1,'Single',NULL,NULL),
(2,'Married',NULL,NULL),
(3,'Divorce',NULL,NULL),
(4,'Divorcee',NULL,NULL),
(5,'widow',NULL,NULL),
(6,'widower',NULL,NULL),
(7,'Abandoned',NULL,NULL);

/*Data for the table `pims_person_relationships` */

insert  into `pims_person_relationships`(`id`,`person_relationship`,`created_at`,`updated_at`) values 
(1,'Father',NULL,NULL),
(2,'Mother',NULL,NULL),
(3,'Son',NULL,NULL),
(4,'Daughter',NULL,NULL),
(5,'wife',NULL,NULL),
(6,'Grand Father',NULL,NULL),
(7,'Grand Mother',NULL,NULL),
(8,'Guardian',NULL,NULL),
(9,'Uncle',NULL,NULL),
(10,'Aunty',NULL,NULL),
(11,'Nephew',NULL,NULL),
(12,'Niece',NULL,NULL),
(13,'Cousin',NULL,NULL);

/*Data for the table `pims_person_salutations` */

insert  into `pims_person_salutations`(`id`,`salutation`,`created_at`,`updated_at`) values 
(3,'Mr.',NULL,NULL),
(4,'Ms.',NULL,NULL),
(5,'Dr.',NULL,NULL),
(6,'Er.',NULL,NULL),
(7,'CA',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
