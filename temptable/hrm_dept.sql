/*
SQLyog Community v13.1.7 (64 bit)
MySQL - 10.4.22-MariaDB 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `hrm_departments` (
	`id` int (10),
	`name` varchar (150),
	`parent_dept_id` int (11),
	`description` text ,
	`status` int (11),
	`created_at` datetime ,
	`updated_at` datetime ,
	`deleted_at` datetime 
); 
