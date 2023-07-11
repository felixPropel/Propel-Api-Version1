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
