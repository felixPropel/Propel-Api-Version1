# propelsoft

08/08/22
Developer:R.Dhana
1.Added New API Format By Dhana
2.Added New Table For Hrm Department ->tempTable->hrmdepartment table sql run create that table


 php artisan migrate --path=/database/migrations/2023_04_06_151202_create_temp_emails_table.php
 php artisan migrate --path=/database/migrations/2023_04_06_090826_create_temp_mobiles_table.php


 ALTER TABLE user_organization_relationals
ADD default_org VARCHAR(255) DEFAULT NULL;


// Harish
Tables column changes


ALTER TABLE person_anniversarys
ADD create_at timestamp NULL DEFAULT NULL;

ALTER TABLE person_anniversarys
MODIFY occasions_id INT NULL;

ALTER TABLE person_languages
MODIFY language_id INT NULL;

DB Changes By Harish(02/08/2023):

1) create Table hrm_resource_activities:

CREATE TABLE `hrm_resource_activities` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`  VARCHAR(191) DEFAULT NULL,
  `active_status_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
   `deleted_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
)

2)create Table hrm_resource_activity_status:

CREATE TABLE `hrm_resource_activity_statuses` (
	  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	  `name`  VARCHAR(191) DEFAULT NULL,
	  `active_status` INT(11) NOT NULL,
	  `created_at` TIMESTAMP NULL DEFAULT NULL,
	  `updated_at` TIMESTAMP NULL DEFAULT NULL,
	   `deleted_at` TIMESTAMP NULL DEFAULT NULL,
	  PRIMARY KEY (`id`)
	)


	Migrate Files:(1/09/23)

	1) php artisan migrate:refresh --path=/database/
migrations/DefaultMigrationFiles/2022_08_27_100404_create_temp_organizations_table.php