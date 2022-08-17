/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.22-MariaDB 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `hrm_human_resource_types` (
	`id` int (10),
	`name` varchar (150),
	`description` varchar (150),
	`status` int (11),
	`created_at` datetime ,
	`deleted_at` datetime ,
	`updated_at` datetime 
); 
