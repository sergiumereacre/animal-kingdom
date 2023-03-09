/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `animal_species`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `animal_species` (
  `species_id` int unsigned NOT NULL AUTO_INCREMENT,
  `species_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` enum('MAMMAL','REPTILE','AMPHIBIAN','AVIAN','FISH') COLLATE utf8mb4_unicode_ci NOT NULL,
  `can_fly` tinyint(1) NOT NULL,
  `can_swim` tinyint(1) NOT NULL,
  `eating_style` enum('HERBIVORE','CARNIVORE','OMNIVORE') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`species_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `connections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `connections` (
  `connection_id` int NOT NULL,
  `first_user_id` bigint unsigned NOT NULL,
  `second_user_id` bigint unsigned NOT NULL,
  `time_created` datetime NOT NULL,
  PRIMARY KEY (`connection_id`),
  KEY `connections_first_user_id_foreign` (`first_user_id`),
  KEY `connections_second_user_id_foreign` (`second_user_id`),
  CONSTRAINT `connections_first_user_id_foreign` FOREIGN KEY (`first_user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `connections_second_user_id_foreign` FOREIGN KEY (`second_user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `organisations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `organisations` (
  `organisation_id` int unsigned NOT NULL AUTO_INCREMENT,
  `organisation_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` bigint unsigned NOT NULL,
  `time_created` datetime NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `picture` text COLLATE utf8mb4_unicode_ci,
  `size` bigint DEFAULT NULL,
  PRIMARY KEY (`organisation_id`),
  KEY `organisations_owner_id_foreign` (`owner_id`),
  CONSTRAINT `organisations_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `qualifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qualifications` (
  `qualification_id` int unsigned NOT NULL AUTO_INCREMENT,
  `qualification_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification_description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`qualification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `qualifications_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qualifications_users` (
  `qualifications_users_id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `qualification_id` int unsigned NOT NULL,
  `date_obtained` date NOT NULL,
  PRIMARY KEY (`qualifications_users_id`),
  KEY `qualifications_users_user_id_foreign` (`user_id`),
  KEY `qualifications_users_qualification_id_foreign` (`qualification_id`),
  CONSTRAINT `qualifications_users_qualification_id_foreign` FOREIGN KEY (`qualification_id`) REFERENCES `qualifications` (`qualification_id`),
  CONSTRAINT `qualifications_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `qualifications_vacancies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `qualifications_vacancies` (
  `qualifications_vacancies_id` int unsigned NOT NULL AUTO_INCREMENT,
  `qualification_id` int unsigned NOT NULL,
  `vacancy_id` int unsigned NOT NULL,
  PRIMARY KEY (`qualifications_vacancies_id`),
  KEY `qualifications_vacancies_qualification_id_foreign` (`qualification_id`),
  KEY `qualifications_vacancies_vacancy_id_foreign` (`vacancy_id`),
  CONSTRAINT `qualifications_vacancies_qualification_id_foreign` FOREIGN KEY (`qualification_id`) REFERENCES `qualifications` (`qualification_id`),
  CONSTRAINT `qualifications_vacancies_vacancy_id_foreign` FOREIGN KEY (`vacancy_id`) REFERENCES `vacancies` (`vacancy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skills` (
  `skill_id` int unsigned NOT NULL AUTO_INCREMENT,
  `skill_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skill_description` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`skill_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `skills_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skills_users` (
  `skills_users_id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `skill_id` int unsigned NOT NULL,
  `skill_level` enum('BEGINNER','INTERMEDIATE','EXPERT') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`skills_users_id`),
  KEY `skills_users_user_id_foreign` (`user_id`),
  KEY `skills_users_skill_id_foreign` (`skill_id`),
  CONSTRAINT `skills_users_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`skill_id`),
  CONSTRAINT `skills_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `skills_vacancies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `skills_vacancies` (
  `skills_vacancies_id` int unsigned NOT NULL AUTO_INCREMENT,
  `skill_id` int unsigned NOT NULL,
  `vacancy_id` int unsigned NOT NULL,
  `skill_level` enum('BEGINNER','INTERMEDIATE','EXPERT') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`skills_vacancies_id`),
  KEY `skills_vacancies_skill_id_foreign` (`skill_id`),
  KEY `skills_vacancies_vacancy_id_foreign` (`vacancy_id`),
  CONSTRAINT `skills_vacancies_skill_id_foreign` FOREIGN KEY (`skill_id`) REFERENCES `skills` (`skill_id`),
  CONSTRAINT `skills_vacancies_vacancy_id_foreign` FOREIGN KEY (`vacancy_id`) REFERENCES `vacancies` (`vacancy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `species_id` int unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'test',
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'test',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date NOT NULL DEFAULT '2023-03-07',
  `organisation_id` int unsigned DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_banned` tinyint(1) NOT NULL DEFAULT '0',
  `bio` text COLLATE utf8mb4_unicode_ci,
  `profile_pic` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_species_id_foreign` (`species_id`),
  KEY `users_organisation_id_foreign` (`organisation_id`),
  CONSTRAINT `users_organisation_id_foreign` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`organisation_id`),
  CONSTRAINT `users_species_id_foreign` FOREIGN KEY (`species_id`) REFERENCES `animal_species` (`species_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `users_vacancies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_vacancies` (
  `users_vacancies_id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `vacancy_id` int unsigned NOT NULL,
  `time_joined` datetime NOT NULL,
  PRIMARY KEY (`users_vacancies_id`),
  KEY `users_vacancies_user_id_foreign` (`user_id`),
  KEY `users_vacancies_vacancy_id_foreign` (`vacancy_id`),
  CONSTRAINT `users_vacancies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `users_vacancies_vacancy_id_foreign` FOREIGN KEY (`vacancy_id`) REFERENCES `vacancies` (`vacancy_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
DROP TABLE IF EXISTS `vacancies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vacancies` (
  `vacancy_id` int unsigned NOT NULL AUTO_INCREMENT,
  `time_created` datetime NOT NULL,
  `organisation_id` int unsigned NOT NULL,
  `vacancy_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vacancy_description` text COLLATE utf8mb4_unicode_ci,
  `category_requirement` enum('MAMMAL','REPTILE','AMPHIBIAN','AVIAN','FISH') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `can_fly_requirement` tinyint(1) DEFAULT NULL,
  `can_swim_requirement` tinyint(1) DEFAULT NULL,
  `eating_style_requirement` enum('HERBIVORE','CARNIVORE','OMNIVORE') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`vacancy_id`),
  KEY `vacancies_organisation_id_foreign` (`organisation_id`),
  CONSTRAINT `vacancies_organisation_id_foreign` FOREIGN KEY (`organisation_id`) REFERENCES `organisations` (`organisation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

INSERT INTO `migrations` VALUES (1,'2013_03_01_151445_create_animal_species_table',1);
INSERT INTO `migrations` VALUES (2,'2013_03_01_151450_create_organisations_table',1);
INSERT INTO `migrations` VALUES (3,'2014_10_12_000000_create_users_table',1);
INSERT INTO `migrations` VALUES (4,'2014_10_12_100000_create_password_reset_tokens_table',1);
INSERT INTO `migrations` VALUES (5,'2019_08_19_000000_create_failed_jobs_table',1);
INSERT INTO `migrations` VALUES (6,'2019_12_14_000001_create_personal_access_tokens_table',1);
INSERT INTO `migrations` VALUES (7,'2022_03_01_151449_create_qualifications_table',1);
INSERT INTO `migrations` VALUES (8,'2022_03_01_151454_create_skills_table',1);
INSERT INTO `migrations` VALUES (9,'2023_03_01_151443_create_connections_table',1);
INSERT INTO `migrations` VALUES (10,'2023_03_01_151444_create_qualifications_vacancies_table',1);
INSERT INTO `migrations` VALUES (11,'2023_03_01_151446_create_qualifications_users_table',1);
INSERT INTO `migrations` VALUES (12,'2023_03_01_151447_create_skills_users_table',1);
INSERT INTO `migrations` VALUES (13,'2023_03_01_151448_create_skills_vacancies_table',1);
INSERT INTO `migrations` VALUES (14,'2023_03_01_151452_create_users_vacancies_table',1);
INSERT INTO `migrations` VALUES (15,'2023_03_01_151453_create_vacancies_table',1);
