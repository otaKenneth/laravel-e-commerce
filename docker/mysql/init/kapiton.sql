-- MySQL dump 10.13  Distrib 8.4.0, for Linux (x86_64)
--
-- Host: localhost    Database: kapiton
-- ------------------------------------------------------
-- Server version	8.4.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirm` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'Admin Admin','superadmin',0,'9800000000','admin@admin.com','$2a$12$xvkjSScUPRexfcJTAy9ATutIeGUuRgJrjDIdL/.xlrddEvRZINpeC','','No',1,NULL,NULL),(2,'John Singh - Vendor','vendor',1,'9700000000','john@admin.com','$2y$10$diVDGACHnO1gqwDy3ACHk.BwZFX94bPf56QYONxKwJDhreLCOlDWS','logo-1.png','Yes',1,NULL,'2024-03-23 13:01:10'),(8,'Ian Kenneth Garcia Mendoza','vendor',8,'+639559113587','ianmendoza02@yahoo.com','$2y$10$StpoY1M3LLe78XuO5gOf1.ki1ekMvV8S.VFsGmTAb56BxiGB18p5y',NULL,'No',0,'2024-02-06 16:25:53','2024-02-06 16:25:53'),(9,'Ian Kenneth Garcia Mendoza','vendor',9,'+639559113585','ianmendoza01@yahoo.com','$2y$10$6ILwOR16FcqXuPxEIVPWU.LzJizg86e3s2ZD17TUWDR/tVQUggnzC',NULL,'No',0,'2024-02-06 16:53:35','2024-02-06 16:53:35'),(10,'Ian Kenneth Garcia Mendoza','vendor',10,'+639559113589','ianmendoza03@yahoo.com','$2y$10$j5L5nIykk/e90V7GR1ujj.jy16PBF0R0vD1jMfY7bkzPWRMt6DoeC',NULL,'No',0,'2024-02-07 02:53:44','2025-01-16 12:20:26'),(11,'Ian Kenneth Garcia Mendoza','vendor',11,'+639559113580','ianmendoza04@yahoo.com','$2y$10$VYIAwNVslDgmW2ouOUEXgOtDMww22kEHKMsyOZq56Qm5ikPJVKyyK',NULL,'No',0,'2024-02-07 03:17:06','2025-01-16 12:18:00'),(12,'Ian Kenneth Garcia Mendoza','vendor',12,'+639559113581','ianmendoza05@yahoo.com','$2y$10$5nFdAtCjGa.q1OxXZZ4h5uEGBy1pdQ3XqV95KYui.tt2WS1QJwOee',NULL,'No',1,'2024-02-07 03:27:42','2025-01-16 12:13:27'),(13,'Mark Jared Poblete','vendor',13,'09653265656','mjpoblete@gmail.com','$2y$10$diVDGACHnO1gqwDy3ACHk.BwZFX94bPf56QYONxKwJDhreLCOlDWS','69366.jpg','Yes',1,'2024-03-15 08:59:33','2024-06-07 12:06:18'),(14,'Mark Lester','vendor',14,'096245691515','mark.lester@test.com.ph','$2y$10$PxkFaFdjhDq1COtNfyThKuQbvyCTdFFIyK07Kd5QY55u5eDLAgJ9m',NULL,'No',0,'2024-12-27 21:14:43','2024-12-27 21:14:43');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'banner-1.jpg','Slider','spring-collection','Spring Collection','Spring Collection',1,NULL,NULL),(2,'banner-2.jpg','Slider','tops','Tops','Tops',1,NULL,NULL),(3,'93215.jpg','Slider','#','#','#',1,'2024-06-07 12:14:31','2024-06-07 12:14:31'),(4,'9556.png','Slider','#','Banner 4','Kapiton - Banner 4',1,'2024-10-05 14:00:45','2024-10-05 14:00:45'),(5,'60545.jpg','Fix','/products/collection/all','asd','asdfsdf',1,'2025-01-10 12:52:23','2025-01-10 12:52:23');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Arrow',0,NULL,'2024-06-21 11:11:04'),(2,'Gap',0,NULL,'2024-06-21 11:11:09'),(3,'Lee',0,NULL,'2024-06-21 11:11:11'),(4,'Samsung',0,NULL,'2024-06-21 11:11:13'),(5,'LG',0,NULL,'2024-06-21 11:11:15'),(6,'Lenovo',0,NULL,'2024-06-21 11:11:17'),(7,'MI',0,NULL,'2024-06-21 11:11:19'),(8,'XYZ Brand',0,NULL,'2024-06-21 11:11:26'),(9,'ABC Fashion',0,NULL,'2024-06-21 11:11:28'),(10,'Playful Kids',0,NULL,'2024-06-21 11:11:30'),(11,'Fashion Hub',0,NULL,'2024-06-21 11:11:44'),(12,'Chic Trends',0,NULL,'2024-06-21 11:11:42'),(13,'Joyful Toys',0,NULL,'2024-06-21 11:11:40'),(14,'Tech Guru',0,NULL,'2024-06-21 11:11:38'),(15,'Cozy Living',0,NULL,'2024-06-21 11:11:36'),(16,'Own',1,'2024-06-21 11:10:49','2024-06-21 11:10:49');
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (10,'7b17a199e3bf21ed9533d9685190d9c6',0,6,'Blue','S',3,'2024-07-16 12:04:02','2024-07-16 12:29:32'),(13,'d5e425c12abc7d8e44d113e0371ef16b',0,1,'Blue','6.43\"',1,'2024-07-31 13:55:22','2024-07-31 13:55:57'),(17,'24a4c772e73859421901eb59a8c7cee2',5,6,'Blue','S',1,'2024-12-20 09:16:24','2024-12-20 09:16:24'),(18,'a68a25af1f462e3c183b5a71c16126eb',5,8,'Blue','Regular',1,'2024-12-27 13:20:05','2024-12-28 10:19:55'),(22,'879dd15bbdd58cbe1b1ab2f580f83390',5,10,'Grey','small',1,'2024-12-28 11:12:52','2024-12-28 11:12:52'),(26,'1d339e13e71e8bfc46a88347dc5975c0',5,3,'Blue','M',2,'2024-12-29 12:57:16','2024-12-29 13:05:00'),(27,'c2440ca743e2ab4915bc924f65b65a8b',5,10,'Black','medium',1,'2024-12-31 06:17:00','2024-12-31 06:17:00');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL,
  `section_id` int NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_discount` double NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,0,1,'Men','',0,'','men','','','',1,NULL,NULL),(2,0,1,'Women','',0,'','women','','','',1,NULL,NULL),(3,0,1,'Kids','',0,'','kids','','','',1,NULL,NULL),(4,0,2,'Mobiles','',10,'test','mobiles','mobiles','mobiles','mobiles',1,'2022-08-21 19:11:28','2022-08-26 18:27:54'),(5,4,2,'Smartphones','',10,'j','smartphones','smartphones','smartphones','smartphones',1,'2022-08-22 23:30:07','2022-10-31 21:02:48'),(6,1,1,'T-Shirts','',0,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.','tshirts','Men T-shirts','Huge variety of men t-shirts','men t-shirts, cotton t-shirts',1,'2022-08-24 17:58:46','2023-05-05 18:32:28'),(7,1,1,'Shirts','',0,NULL,'shirts',NULL,NULL,NULL,1,'2022-08-25 00:09:23','2022-08-25 00:09:51'),(8,2,1,'Tops','',0,NULL,'tops',NULL,NULL,NULL,1,'2022-08-25 00:17:42','2022-08-25 00:17:42'),(9,0,3,'Home','',0,NULL,'home','Home',NULL,NULL,1,'2022-09-22 21:55:53','2024-01-11 12:49:26'),(10,0,4,'Food','',0,NULL,'food','Food',NULL,NULL,1,'2024-01-11 12:52:30','2024-01-11 12:52:30'),(11,0,4,'Cosmetics','',0,NULL,'cosmetics','Cosmetics',NULL,NULL,1,'2024-01-11 12:53:05','2024-01-11 12:53:05'),(12,0,5,'Toys','',0,NULL,'toys','Toys',NULL,NULL,1,'2024-01-11 12:54:43','2024-01-11 12:54:43'),(13,12,5,'Infant','',0,NULL,'toys/infants','Infant Toys',NULL,NULL,1,'2024-01-11 12:56:01','2024-01-11 12:56:01'),(14,12,5,'Pre-school Toys','',0,NULL,'toys/pre-school','Pre-School Toys','From age 3-6',NULL,1,'2024-01-11 12:57:07','2024-01-11 12:57:07'),(15,12,5,'School-Age','',0,NULL,'toys/school-age','School Age Toys','Age 6-12',NULL,1,'2024-01-11 12:57:52','2024-01-11 12:57:52'),(16,12,5,'Teen','',0,NULL,'toys/teen','Teen','Age 13-18',NULL,1,'2024-01-11 13:00:30','2024-01-11 13:00:30'),(17,14,5,'Educational','',0,NULL,'toys/educational','Educational','Educational',NULL,1,'2024-01-11 13:01:43','2024-01-11 13:01:43'),(18,12,5,'Adult','',0,NULL,'toys/adult','Adult Toys','-',NULL,1,'2024-01-11 13:02:14','2024-01-11 13:02:14'),(19,2,1,'Shoes','',0,NULL,'women/shoes',NULL,NULL,NULL,1,'2024-01-14 05:18:10','2024-01-14 05:18:10');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_admins`
--

DROP TABLE IF EXISTS `chat_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chat_id` int NOT NULL,
  `admin_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_admins`
--

LOCK TABLES `chat_admins` WRITE;
/*!40000 ALTER TABLE `chat_admins` DISABLE KEYS */;
INSERT INTO `chat_admins` VALUES (1,1,2,'2024-05-22 10:48:13','2024-05-22 10:48:13'),(2,2,2,'2024-06-07 12:10:24','2024-06-07 12:10:24');
/*!40000 ALTER TABLE `chat_admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_messages`
--

DROP TABLE IF EXISTS `chat_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_messages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chat_id` int NOT NULL,
  `admin_id` int NOT NULL,
  `user_id` int NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_messages`
--

LOCK TABLES `chat_messages` WRITE;
/*!40000 ALTER TABLE `chat_messages` DISABLE KEYS */;
INSERT INTO `chat_messages` VALUES (1,1,2,1,'\\App\\Models\\User','I would like to buy this item.','2024-05-22 10:48:13','2024-05-22 10:48:13'),(2,1,2,1,'\\App\\Models\\Admin','Sure\n','2024-05-22 10:58:19','2024-05-22 10:58:19'),(3,1,2,1,'\\App\\Models\\User','How much is this?','2024-05-22 10:59:00','2024-05-22 10:59:00'),(4,2,2,3,'\\App\\Models\\User','gusto kong bilhin ito','2024-06-07 12:10:24','2024-06-07 12:10:24'),(5,2,2,3,'\\App\\Models\\User','chat ko to para sayo!','2024-07-27 11:36:06','2024-07-27 11:36:06'),(6,2,2,3,'\\App\\Models\\User','gar, sagot!','2024-07-27 11:36:38','2024-07-27 11:36:38'),(7,2,2,3,'\\App\\Models\\User','how u doin?','2024-10-24 05:20:35','2024-10-24 05:20:35'),(8,2,2,3,'\\App\\Models\\User','hey!!','2024-10-24 05:20:52','2024-10-24 05:20:52'),(9,2,2,3,'\\App\\Models\\User','sup','2024-10-24 05:21:12','2024-10-24 05:21:12'),(10,1,2,1,'\\App\\Models\\Admin','yow!!','2024-10-24 05:48:19','2024-10-24 05:48:19'),(11,1,2,1,'\\App\\Models\\Admin','op\nop','2024-10-24 06:12:28','2024-10-24 06:12:28'),(12,2,2,3,'\\App\\Models\\Admin','oy','2024-10-24 06:19:47','2024-10-24 06:19:47'),(13,2,2,3,'\\App\\Models\\Admin','hey','2024-10-24 06:20:13','2024-10-24 06:20:13'),(14,2,2,3,'\\App\\Models\\Admin','hey','2024-10-24 06:20:56','2024-10-24 06:20:56'),(15,2,2,3,'\\App\\Models\\Admin','jass','2024-10-24 06:21:31','2024-10-24 06:21:31');
/*!40000 ALTER TABLE `chat_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat_users`
--

DROP TABLE IF EXISTS `chat_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `chat_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat_users`
--

LOCK TABLES `chat_users` WRITE;
/*!40000 ALTER TABLE `chat_users` DISABLE KEYS */;
INSERT INTO `chat_users` VALUES (1,1,1,'2024-05-22 10:48:13','2024-05-22 10:48:13'),(2,2,3,'2024-06-07 12:10:24','2024-06-07 12:10:24');
/*!40000 ALTER TABLE `chat_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chats`
--

DROP TABLE IF EXISTS `chats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chats` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chats`
--

LOCK TABLES `chats` WRITE;
/*!40000 ALTER TABLE `chats` DISABLE KEYS */;
INSERT INTO `chats` VALUES (1,'2024-05-22 10:48:13','2024-05-22 10:48:13'),(2,'2024-06-07 12:10:23','2024-06-07 12:10:23');
/*!40000 ALTER TABLE `chats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cod_pincodes`
--

DROP TABLE IF EXISTS `cod_pincodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cod_pincodes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pincode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cod_pincodes`
--

LOCK TABLES `cod_pincodes` WRITE;
/*!40000 ALTER TABLE `cod_pincodes` DISABLE KEYS */;
/*!40000 ALTER TABLE `cod_pincodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `country_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `status` tinyint NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (63,'EG','Egypt',1,'0000-00-00 00:00:00','0000-00-00 00:00:00'),(175,'PH','Philippines',1,'0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coupons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `coupon_option` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categories` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `brands` text COLLATE utf8mb4_unicode_ci,
  `users` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coupons`
--

LOCK TABLES `coupons` WRITE;
/*!40000 ALTER TABLE `coupons` DISABLE KEYS */;
INSERT INTO `coupons` VALUES (1,0,'Manual','test10','1',NULL,'','Single Time','Percentage',10.00,'2022-12-31',1,NULL,NULL),(2,0,'Manual','test20','1,6,7,2,8,19,3,4,5,9,10,11,12,13,14,15,16,18','16','','Multiple Times','Percentage',20.00,'2025-12-31',1,NULL,'2025-01-21 13:24:07'),(3,0,'Automatic','3cuAtrv7','6,7,8,19','1,2,3,4,5,6,7,8,9,10,11,12,13,14,15','','Single Time','Fixed',100.00,'2024-06-30',1,'2024-06-12 01:38:37','2024-06-12 01:38:37');
/*!40000 ALTER TABLE `coupons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery_addresses`
--

DROP TABLE IF EXISTS `delivery_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `delivery_addresses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery_addresses`
--

LOCK TABLES `delivery_addresses` WRITE;
/*!40000 ALTER TABLE `delivery_addresses` DISABLE KEYS */;
INSERT INTO `delivery_addresses` VALUES (1,1,'Ahmed Yahya','37 Salah Salem','Cairo','Metro Manila','Philippines','10001',14.572059,121.026478,'+639256395659',1,NULL,'2024-03-08 02:52:59'),(7,1,'Joshua Dela Paz','#45 Makiling St.','Malolos','Bulacan','Philippines','3306',14.84394,120.825404,'+639956321595',1,'2024-03-08 04:32:33','2024-03-08 04:54:10'),(10,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.885921357167,120.76618319887,'+639559113585',1,'2024-06-16 07:03:23','2024-07-12 12:30:42'),(11,3,'Master Buatihn','#30 Sampaloc St. Blk 98','Mandaluyong','Metro Manila','Philippines','30025',14.5438202,121.0563793,'+639559113789',1,'2024-06-26 14:34:39','2024-07-27 12:32:53'),(12,5,'Jose Mariano','Calumpit','Quezon City','Metro Manila','Philippines','10001',NULL,NULL,'+639985423563',1,'2024-12-16 14:08:43','2024-12-16 14:08:43');
/*!40000 ALTER TABLE `delivery_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

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

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_06_01_000001_create_oauth_auth_codes_table',1),(4,'2016_06_01_000002_create_oauth_access_tokens_table',1),(5,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(6,'2016_06_01_000004_create_oauth_clients_table',1),(7,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(8,'2019_08_19_000000_create_failed_jobs_table',1),(9,'2019_12_14_000001_create_personal_access_tokens_table',1),(10,'2022_08_09_172927_create_vendors_table',1),(11,'2022_08_09_175014_create_admins_table',1),(12,'2022_08_14_013126_create_vendors_business_details_table',1),(13,'2022_08_14_125705_create_vendors_bank_details_table',1),(14,'2022_08_18_133204_create_sections_table',1),(15,'2022_08_20_154959_create_categories_table',1),(16,'2022_08_26_235606_create_brands_table',1),(17,'2022_08_28_003445_create_products_table',1),(18,'2022_09_06_163819_create_products_attributes_table',1),(19,'2022_09_17_195644_create_products_images_table',1),(20,'2022_09_24_150406_create_banners_table',1),(21,'2022_09_26_142845_update_banners_table',1),(22,'2022_09_27_134607_update_products_table',1),(23,'2022_10_02_142913_create_products_filters_table',1),(24,'2022_10_02_143716_create_products_filters_values_table',1),(25,'2022_11_02_215937_create_recently_viewed_products_table',1),(26,'2022_11_03_143550_create_carts_table',1),(27,'2022_11_09_144019_add_columns_to_users',1),(28,'2022_12_14_025719_create_coupons_table',1),(29,'2023_01_14_012938_create_delivery_addresses_table',1),(30,'2023_02_27_200827_create_orders_table',1),(31,'2023_02_27_201841_create_orders_products_table',1),(32,'2023_03_04_161126_create_order_statuses_table',1),(33,'2023_03_05_000428_create_order_item_statuses_table',1),(34,'2023_03_08_003018_create_orders_logs_table',1),(36,'2023_03_09_235853_update_orders_products_table',1),(37,'2023_03_10_001719_update_orders_logs_table',1),(39,'2023_04_01_140344_create_shipping_charges_table',1),(40,'2023_04_04_234905_drop_column_from_shipping_charges_table',1),(41,'2023_04_04_235424_add_columns_to_shipping_charges_table',1),(42,'2023_04_12_002719_create_cod_pincodes_table',1),(43,'2023_04_12_194813_create_prepaid_pincodes_table',1),(44,'2023_04_14_154108_add_commission_column_to_vendors_table',1),(45,'2023_04_16_211726_add_is_pushed_column_to_orders_table',1),(46,'2023_04_23_225334_add_access_token_column_to_users_table',1),(47,'2023_05_26_233039_create_newsletter_subscribers_table',1),(48,'2023_07_05_112943_create_ratings_table',1),(49,'2023_12_11_123151_create_themes_table',1),(50,'2014_10_12_000000_create_users_table',2),(51,'2022_11_09_144020_add_columns_to_users',3),(52,'2023_04_23_225335_add_access_token_column_to_users_table',4),(53,'2024_01_13_134048_add_columns_to_products_table',5),(56,'2024_02_06_123021_drop_vendors_business_details_columns',6),(63,'2023_03_09_144122_update_orders_table',7),(65,'2024_02_25_004525_add_coordinates_column_to_vendors_business_details_table',7),(66,'2024_02_25_005520_add_coordinates_column_to_delivery_addresses_table',7),(69,'2024_03_02_131258_update_orders_table',8),(70,'2024_03_10_133146_update_products_attributes_table',9),(71,'2024_02_06_123351_add_columns_to_vendors_business_details_table',10),(72,'2024_03_21_114611_update_ratings_table',11),(73,'2024_04_20_135439_add_wdyfu_column_to_vendors_table',12),(74,'2024_04_21_080311_create_platform_content_table',13),(75,'2024_04_28_133708_add_column_to_users_table',13),(76,'2024_05_05_030113_create_chats_table',14),(77,'2024_05_05_031113_create_chat_messages_table',15),(78,'2024_05_05_060851_create_chat_users_table',15),(79,'2024_05_05_102102_create_chat_admins_table',15),(81,'2024_06_06_114659_add_color_column_to_carts_table',16),(82,'2023_03_29_151313_create_payments_table',17),(83,'2024_06_26_231416_create_refunds_table',18),(84,'2024_07_15_124534_create_trusted_by_table',19),(85,'2024_08_03_110117_create_refund_images_table',20),(86,'2024_10_07_122359_add_shop_logo_column_to_vendors_business_details_table',21),(87,'2024_10_27_023443_create_products_variant_table',22),(88,'2024_10_27_023443_create_products_variants_table',23),(89,'2024_06_05_133954_create_wishlists_table',24),(90,'2024_12_20_142345_add_shipping_method_to_orders_table',24);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter_subscribers`
--

DROP TABLE IF EXISTS `newsletter_subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `newsletter_subscribers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter_subscribers`
--

LOCK TABLES `newsletter_subscribers` WRITE;
/*!40000 ALTER TABLE `newsletter_subscribers` DISABLE KEYS */;
INSERT INTO `newsletter_subscribers` VALUES (1,'yasser100@yopmail.com',1,NULL,NULL),(2,'fouaad@gmail.com',1,NULL,NULL);
/*!40000 ALTER TABLE `newsletter_subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_item_statuses`
--

DROP TABLE IF EXISTS `order_item_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_item_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_item_statuses`
--

LOCK TABLES `order_item_statuses` WRITE;
/*!40000 ALTER TABLE `order_item_statuses` DISABLE KEYS */;
INSERT INTO `order_item_statuses` VALUES (1,'Pending',1,NULL,NULL),(2,'In Progress',1,NULL,NULL),(3,'Shipped',1,NULL,NULL),(4,'Delivered',1,NULL,NULL),(6,'For Delivery',1,'2024-06-30 02:29:45','2024-06-30 02:29:50'),(8,'Pending Refund',1,'2024-06-30 02:30:27','2024-06-30 02:30:31'),(9,'Refund Approved',1,'2024-06-30 02:30:50',NULL),(10,'Refund Rejected',1,'2024-06-30 02:31:13',NULL),(11,'Refund Cancelled',1,'2024-06-30 02:31:24',NULL),(12,'Refunded',1,'2024-06-30 02:31:33',NULL);
/*!40000 ALTER TABLE `order_item_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_statuses`
--

DROP TABLE IF EXISTS `order_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_statuses`
--

LOCK TABLES `order_statuses` WRITE;
/*!40000 ALTER TABLE `order_statuses` DISABLE KEYS */;
INSERT INTO `order_statuses` VALUES (1,'New',1,NULL,NULL),(2,'Pending',1,NULL,NULL),(3,'Canceled',1,NULL,NULL),(4,'In Progress',1,NULL,NULL),(5,'Shipped',1,NULL,NULL),(6,'Partially Shipped',1,NULL,NULL),(7,'Delivered',1,NULL,NULL),(8,'Partially Delivered',1,NULL,NULL),(9,'Paid',1,NULL,NULL),(10,'For Delivery',1,NULL,NULL);
/*!40000 ALTER TABLE `order_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_charges` double(8,2) NOT NULL,
  `total_weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coupon_amount` double(8,2) DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_gateway` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grand_total` double(8,2) NOT NULL,
  `courier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_pushed` tinyint NOT NULL DEFAULT '0' COMMENT 'Order pushed to Shiprocket or NOT',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',NULL,NULL,'+639559113585','mytestuser3@test.com',0.00,'2',NULL,NULL,'Cancelled',NULL,'Prepaid','paymongo',53.98,NULL,NULL,0,'2024-06-19 11:30:21','2024-07-26 03:12:19'),(2,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',NULL,NULL,'+639559113585','mytestuser3@test.com',0.00,'2',NULL,NULL,'Pending',NULL,'Prepaid','paymongo',50.98,NULL,NULL,0,'2024-06-19 11:57:02','2024-06-19 11:57:02'),(3,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',NULL,NULL,'+639559113585','mytestuser3@test.com',0.00,'0',NULL,NULL,'Pending',NULL,'Prepaid','paymongo',998.99,NULL,NULL,0,'2024-06-20 12:07:59','2024-06-20 12:07:59'),(4,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',NULL,NULL,'+639559113585','mytestuser3@test.com',0.00,'0',NULL,NULL,'Cancelled',NULL,'Prepaid','paymongo',998.99,NULL,NULL,0,'2024-06-20 12:08:28','2024-07-26 03:32:09'),(5,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',NULL,NULL,'+639559113585','mytestuser3@test.com',0.00,'0',NULL,NULL,'Pending',NULL,'Prepaid','paymongo',998.99,NULL,NULL,0,'2024-06-20 12:18:36','2024-06-20 12:18:36'),(9,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.9967842,121.1710389,'+639559113585','mytestuser3@test.com',0.00,'0',NULL,NULL,'Partially Delivered',NULL,'Prepaid','paymongo',15398.09,'John Fablou','160781443114-2998137465891742593-',1,'2024-06-25 12:26:04','2024-06-28 05:36:04'),(10,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.9967842,121.1710389,'+639559113585','mytestuser3@test.com',364.00,'1',NULL,NULL,'Delivered',NULL,'Prepaid','paymongo',443.91,NULL,NULL,0,'2024-06-27 13:33:23','2024-07-11 13:05:51'),(11,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.9967842,121.1710389,'+639559113585','mytestuser3@test.com',364.00,'1',NULL,NULL,'Delivered',NULL,'Prepaid','paymongo',443.91,NULL,NULL,0,'2024-06-27 13:34:27','2024-07-11 13:13:43'),(12,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.9967842,121.1710389,'+639559113585','mytestuser3@test.com',364.00,'1',NULL,NULL,'Pending',NULL,'Prepaid','paymongo',443.91,NULL,NULL,0,'2024-06-27 13:36:49','2024-06-27 13:36:49'),(13,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.9967842,121.1710389,'+639559113585','mytestuser3@test.com',364.00,'1',NULL,NULL,'Cancelled',NULL,'Prepaid','paymongo',443.91,NULL,NULL,0,'2024-06-27 13:37:28','2025-01-28 13:24:49'),(14,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.9967842,121.1710389,'+639559113585','mytestuser3@test.com',364.00,'1',NULL,NULL,'Pending',NULL,'Prepaid','paymongo',443.91,NULL,NULL,0,'2024-06-27 13:38:23','2024-06-27 13:38:23'),(15,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.9967842,121.1710389,'+639559113585','mytestuser3@test.com',364.00,'1',NULL,NULL,'Pending',NULL,'Prepaid','paymongo',443.91,NULL,NULL,0,'2024-06-27 13:40:10','2024-06-27 13:40:10'),(16,3,'Master Buatihn','#30 Sampaloc St. Blk 98','Mandaluyong','Metro Manila','Philippines','30025',14.9967842,121.1710389,'+639559113789','mytestuser3@test.com',343.00,'1',NULL,NULL,'Delivered',NULL,'Prepaid','paymongo',377.94,NULL,NULL,0,'2024-07-12 11:22:27','2024-07-31 12:19:05'),(17,3,'Master Buatihn','#30 Sampaloc St. Blk 98','Mandaluyong','Metro Manila','Philippines','30025',14.9967842,121.1710389,'+639559113789','mytestuser3@test.com',249.00,'0',NULL,NULL,'Pending',NULL,'Prepaid','paymongo',1547.69,NULL,NULL,0,'2024-07-14 02:21:03','2024-07-14 02:21:03'),(18,3,'Master Buatihn','#30 Sampaloc St. Blk 98','Mandaluyong','Metro Manila','Philippines','30025',14.9967842,121.1710389,'+639559113789','mytestuser3@test.com',249.00,'0',NULL,NULL,'Pending',NULL,'Prepaid','paymongo',1247.99,NULL,NULL,0,'2024-07-14 02:57:56','2024-07-14 02:57:56'),(19,3,'Master Buatihn','#30 Sampaloc St. Blk 98','Mandaluyong','Metro Manila','Philippines','30025',14.9967842,121.1710389,'+639559113789','mytestuser3@test.com',249.00,'0',NULL,NULL,'Cancelled',NULL,'Prepaid','paymongo',1247.99,NULL,NULL,0,'2024-07-14 03:02:04','2025-01-28 13:15:10'),(20,3,'Master Buatihn','#30 Sampaloc St. Blk 98','Mandaluyong','Metro Manila','Philippines','30025',14.9967842,121.1710389,'+639559113789','mytestuser3@test.com',327.00,'0',NULL,NULL,'Pending',NULL,'Prepaid','paymongo',1625.69,NULL,NULL,0,'2024-07-14 04:07:33','2024-07-14 04:07:33'),(21,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.885921357167,120.76618319887,'+639559113585','mytestuser3@test.com',249.00,'0',NULL,NULL,'Pending',NULL,'Prepaid','paymongo',1547.69,NULL,NULL,0,'2024-07-14 04:10:32','2024-07-14 04:10:32'),(22,3,'Master Buatihn','#30 Sampaloc St. Blk 98','Mandaluyong','Metro Manila','Philippines','30025',14.5438202,121.0563793,'+639559113789','mytestuser3@test.com',97.00,'1',NULL,NULL,'Pending',NULL,'Prepaid','paymongo',126.95,NULL,NULL,0,'2024-07-27 12:49:00','2024-07-27 12:49:00'),(23,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.885921357167,120.76618319887,'+639559113585','mytestuser3@test.com',249.00,'0',NULL,NULL,'New','j&t','COD','COD',268.95,NULL,NULL,0,'2025-01-21 12:13:54','2025-01-21 12:13:54'),(24,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.885921357167,120.76618319887,'+639559113585','mytestuser3@test.com',498.00,'1','test20',125.87,'New','lalamove','COD','COD',1001.47,NULL,NULL,0,'2025-01-22 12:51:24','2025-01-22 12:51:24'),(25,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.885921357167,120.76618319887,'+639559113585','mytestuser3@test.com',249.00,'1','test20',1796.40,'New','lalamove','COD','COD',7434.60,NULL,NULL,0,'2025-01-22 13:02:00','2025-01-22 13:02:00'),(26,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.885921357167,120.76618319887,'+639559113585','mytestuser3@test.com',249.00,'0','test20',4.39,'Pending','lalamove','Prepaid','paymongo',266.56,NULL,NULL,0,'2025-01-22 13:10:13','2025-01-22 13:10:13'),(27,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.885921357167,120.76618319887,'+639559113585','mytestuser3@test.com',498.00,'2',NULL,NULL,'New','j&t','COD','COD',579.84,NULL,NULL,0,'2025-01-29 13:16:27','2025-01-29 13:16:27'),(28,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.885921357167,120.76618319887,'+639559113585','mytestuser3@test.com',249.00,'3',NULL,NULL,'Pending','j&t','Prepaid','cod',338.84,NULL,NULL,0,'2025-01-29 13:22:57','2025-01-29 13:22:57'),(29,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.885921357167,120.76618319887,'+639559113585','mytestuser3@test.com',249.00,'3',NULL,NULL,'Pending','j&t','Prepaid','cod',338.84,NULL,NULL,0,'2025-01-29 13:23:46','2025-01-29 13:23:46'),(30,3,'Test User','#46 Makiling St.','Calumpit','Bulacan','Philippines','3306',14.885921357167,120.76618319887,'+639559113585','mytestuser3@test.com',249.00,'3',NULL,NULL,'New','j&t','COD','COD',338.84,NULL,NULL,0,'2025-01-29 13:24:37','2025-01-29 13:24:37');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_logs`
--

DROP TABLE IF EXISTS `orders_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `order_item_id` int DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_logs`
--

LOCK TABLES `orders_logs` WRITE;
/*!40000 ALTER TABLE `orders_logs` DISABLE KEYS */;
INSERT INTO `orders_logs` VALUES (1,9,6,'In Progress','2024-06-27 15:33:34','2024-06-27 15:33:34'),(2,9,NULL,'In Progress','2024-06-27 15:37:10','2024-06-27 15:37:10'),(3,9,NULL,'For Delivery','2024-06-28 02:52:35','2024-06-28 02:52:35'),(4,9,NULL,'Shipped','2024-06-28 03:05:36','2024-06-28 03:05:36'),(5,9,6,'Shipped','2024-06-28 03:09:29','2024-06-28 03:09:29'),(6,9,6,'Delivered','2024-06-28 05:36:04','2024-06-28 05:36:04'),(7,9,NULL,'Partially Delivered','2024-06-28 05:36:04','2024-06-28 05:36:04'),(8,9,6,'Pending Refund','2024-06-30 02:04:17','2024-06-30 02:04:17'),(9,9,6,'Pending Refund','2024-06-30 02:14:39','2024-06-30 02:14:39'),(10,9,6,'Pending Refund','2024-06-30 02:14:57','2024-06-30 02:14:57'),(11,9,6,'Pending Refund','2024-06-30 02:19:15','2024-06-30 02:19:15'),(12,9,6,'Pending Refund','2024-06-30 02:21:45','2024-06-30 02:21:45'),(13,9,6,'Pending Refund','2024-06-30 02:24:42','2024-06-30 02:24:42'),(14,9,6,'Pending Refund','2024-06-30 02:27:12','2024-06-30 02:27:12'),(15,9,6,'Pending Refund','2024-06-30 02:28:08','2024-06-30 02:28:08'),(16,15,13,'In Progress','2024-06-30 11:05:49','2024-06-30 11:05:49'),(17,15,13,'For Delivery','2024-06-30 11:06:20','2024-06-30 11:06:20'),(18,15,13,'For Delivery','2024-06-30 11:06:52','2024-06-30 11:06:52'),(19,15,13,'For Delivery','2024-06-30 11:09:00','2024-06-30 11:09:00'),(20,15,13,'For Delivery','2024-06-30 11:09:56','2024-06-30 11:09:56'),(21,15,13,'For Delivery','2024-06-30 11:10:15','2024-06-30 11:10:15'),(22,15,13,'For Delivery','2024-06-30 11:13:50','2024-06-30 11:13:50'),(23,15,13,'For Delivery','2024-06-30 11:26:29','2024-06-30 11:26:29'),(24,15,13,'For Delivery','2024-06-30 11:27:14','2024-06-30 11:27:14'),(25,15,13,'For Delivery','2024-06-30 11:27:30','2024-06-30 11:27:30'),(26,15,13,'For Delivery','2024-06-30 11:29:24','2024-06-30 11:29:24'),(27,15,13,'For Delivery','2024-06-30 11:30:07','2024-06-30 11:30:07'),(28,15,13,'For Delivery','2024-06-30 11:30:58','2024-06-30 11:30:58'),(29,15,13,'For Delivery','2024-06-30 11:32:38','2024-06-30 11:32:38'),(30,15,13,'For Delivery','2024-06-30 11:35:46','2024-06-30 11:35:46'),(31,15,13,'For Delivery','2024-06-30 11:37:53','2024-06-30 11:37:53'),(32,15,13,'For Delivery','2024-06-30 11:39:39','2024-06-30 11:39:39'),(33,15,13,'For Delivery','2024-06-30 11:42:53','2024-06-30 11:42:53'),(34,15,13,'For Delivery','2024-06-30 11:48:59','2024-06-30 11:48:59'),(35,15,13,'For Delivery','2024-06-30 11:52:39','2024-06-30 11:52:39'),(36,15,13,'For Delivery','2024-06-30 11:57:37','2024-06-30 11:57:37'),(37,15,13,'For Delivery','2024-06-30 11:58:41','2024-06-30 11:58:41'),(38,15,13,'For Delivery','2024-06-30 11:59:15','2024-06-30 11:59:15'),(39,1,1,'In Progress','2024-07-11 12:35:55','2024-07-11 12:35:55'),(40,1,1,'For Delivery','2024-07-11 12:36:41','2024-07-11 12:36:41'),(41,1,1,'For Delivery','2024-07-11 12:39:35','2024-07-11 12:39:35'),(42,1,1,'For Delivery','2024-07-11 12:41:45','2024-07-11 12:41:45'),(43,1,1,'For Delivery','2024-07-11 12:44:10','2024-07-11 12:44:10'),(44,1,1,'For Delivery','2024-07-11 12:45:48','2024-07-11 12:45:48'),(45,1,1,'For Delivery','2024-07-11 12:48:06','2024-07-11 12:48:06'),(46,10,8,'In Progress','2024-07-11 12:49:15','2024-07-11 12:49:15'),(47,10,8,'For Delivery','2024-07-11 12:51:13','2024-07-11 12:51:13'),(48,10,8,'Shipped','2024-07-11 13:02:29','2024-07-11 13:02:29'),(49,10,8,'Delivered','2024-07-11 13:05:51','2024-07-11 13:05:51'),(50,10,NULL,'Delivered','2024-07-11 13:05:51','2024-07-11 13:05:51'),(51,10,8,'Pending Refund','2024-07-11 13:06:20','2024-07-11 13:06:20'),(52,10,8,'Refund Approved','2024-07-11 13:07:19','2024-07-11 13:07:19'),(53,11,9,'For Delivery','2024-07-11 13:12:52','2024-07-11 13:12:52'),(54,11,9,'Shipped','2024-07-11 13:13:13','2024-07-11 13:13:13'),(55,11,9,'Delivered','2024-07-11 13:13:43','2024-07-11 13:13:43'),(56,11,NULL,'Delivered','2024-07-11 13:13:43','2024-07-11 13:13:43'),(57,11,9,'Pending Refund','2024-07-11 13:14:09','2024-07-11 13:14:09'),(58,11,9,'Refund Approved','2024-07-11 13:16:44','2024-07-11 13:16:44'),(59,11,9,'Refund Approved','2024-07-11 13:26:04','2024-07-11 13:26:04'),(60,11,9,'Refund Approved','2024-07-11 13:29:08','2024-07-11 13:29:08'),(61,11,9,'Refund Approved','2024-07-11 13:30:39','2024-07-11 13:30:39'),(62,11,9,'Refund Approved','2024-07-11 13:33:05','2024-07-11 13:33:05'),(63,16,14,'Pending','2024-07-13 13:28:48','2024-07-13 13:28:48'),(64,16,14,'In Progress','2024-07-13 13:29:16','2024-07-13 13:29:16'),(65,16,14,'For Delivery','2024-07-13 13:29:37','2024-07-13 13:29:37'),(66,16,14,'For Delivery','2024-07-13 13:42:25','2024-07-13 13:42:25'),(67,16,14,'For Delivery','2024-07-13 14:03:26','2024-07-13 14:03:26'),(68,16,14,'Shipped','2024-07-13 14:16:55','2024-07-13 14:16:55'),(69,1,NULL,'Cancelled','2024-07-26 03:12:19','2024-07-26 03:12:19'),(70,4,NULL,'Cancelled','2024-07-26 03:32:09','2024-07-26 03:32:09'),(71,16,14,'Delivered','2024-07-31 12:19:05','2024-07-31 12:19:05'),(72,16,NULL,'Delivered','2024-07-31 12:19:05','2024-07-31 12:19:05'),(74,16,14,'Pending Refund','2024-08-03 12:26:37','2024-08-03 12:26:37'),(75,16,14,'Pending Refund','2024-08-03 12:43:45','2024-08-03 12:43:45'),(76,16,14,'Pending Refund','2024-08-03 12:44:11','2024-08-03 12:44:11'),(77,16,14,'Pending Refund','2024-08-03 12:50:45','2024-08-03 12:50:45'),(78,16,14,'Pending Refund','2024-08-03 12:52:40','2024-08-03 12:52:40'),(79,16,14,'Pending Refund','2024-08-03 12:54:07','2024-08-03 12:54:07'),(80,16,14,'Pending Refund','2024-08-03 13:01:02','2024-08-03 13:01:02'),(81,16,14,'Pending Refund','2024-08-03 13:03:48','2024-08-03 13:03:48'),(82,19,NULL,'Cancelled','2025-01-28 13:15:10','2025-01-28 13:15:10'),(83,13,NULL,'Cancelled','2025-01-28 13:24:49','2025-01-28 13:24:49'),(84,5,5,'In Progress','2025-01-28 13:28:05','2025-01-28 13:28:05'),(85,5,5,'Shipped','2025-01-28 13:30:38','2025-01-28 13:30:38'),(86,22,20,'In Progress','2025-01-29 05:48:01','2025-01-29 05:48:01'),(87,22,20,'Delivered','2025-01-29 05:55:21','2025-01-29 05:55:21'),(88,22,20,'Pending Refund','2025-01-29 06:06:38','2025-01-29 06:06:38'),(89,21,19,'Delivered','2025-01-29 06:34:42','2025-01-29 06:34:42'),(90,21,19,'Pending Refund','2025-01-29 06:38:03','2025-01-29 06:38:03'),(91,21,19,'Pending Refund','2025-01-29 06:39:16','2025-01-29 06:39:16'),(92,21,19,'Shipped','2025-01-29 07:06:13','2025-01-29 07:06:13'),(93,21,19,'Delivered','2025-01-29 07:09:10','2025-01-29 07:09:10'),(94,23,21,'Delivered','2025-01-29 07:16:19','2025-01-29 07:16:19'),(95,23,21,'Pending Refund','2025-01-29 07:19:24','2025-01-29 07:19:24'),(96,23,21,'Pending Refund','2025-01-29 07:25:14','2025-01-29 07:25:14'),(97,17,15,'Delivered','2025-01-29 07:29:05','2025-01-29 07:29:05'),(98,17,15,'Pending Refund','2025-01-29 07:37:17','2025-01-29 07:37:17'),(99,15,13,'Delivered','2025-01-29 07:46:56','2025-01-29 07:46:56'),(100,15,13,'Pending Refund','2025-01-29 07:54:17','2025-01-29 07:54:17'),(101,14,12,'Delivered','2025-01-29 08:05:29','2025-01-29 08:05:29'),(102,14,12,'Pending Refund','2025-01-29 08:14:59','2025-01-29 08:14:59');
/*!40000 ALTER TABLE `orders_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders_products`
--

DROP TABLE IF EXISTS `orders_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `admin_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_qty` int NOT NULL,
  `item_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courier_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commission` double(8,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders_products`
--

LOCK TABLES `orders_products` WRITE;
/*!40000 ALTER TABLE `orders_products` DISABLE KEYS */;
INSERT INTO `orders_products` VALUES (1,1,3,1,2,3,'MS1001','Men\'s Casual Shirt','Blue','S',26.99,2,'For Delivery',NULL,NULL,'2024-06-19 11:30:21','2024-07-11 12:48:06',NULL),(2,2,3,1,2,13,'ILT1001','Interactive Learning Toy','Blue','-',25.49,2,'New',NULL,NULL,'2024-06-19 11:57:02','2024-06-19 11:57:02',NULL),(3,3,3,1,2,20,'PCS1101','Pro Camera Smartphone','Silver','8\"',998.99,1,'New',NULL,NULL,'2024-06-20 12:07:59','2024-06-20 12:07:59',NULL),(4,4,3,1,2,20,'PCS1101','Pro Camera Smartphone','Silver','8\"',998.99,1,'Pending Refund',NULL,NULL,'2024-06-20 12:08:29','2024-07-26 03:32:09',NULL),(5,5,3,1,2,20,'PCS1101','Pro Camera Smartphone','Silver','8\"',998.99,1,'Shipped','Lalamove','292010010010','2024-06-20 12:18:36','2025-01-28 13:30:31',NULL),(6,9,3,13,13,34,'2566998855','Smartphone 11','Blue','11\"',14399.10,1,'Pending Refund',NULL,NULL,'2024-06-25 12:26:04','2024-06-30 02:01:58',NULL),(7,9,3,1,2,20,'PCS1101','Pro Camera Smartphone','Grey','8\"',998.99,1,'New',NULL,NULL,'2024-06-25 12:26:04','2024-06-25 12:26:04',NULL),(8,10,3,1,2,6,'MLJ4001','Men\'s Leather Jacket','Blue','S',79.91,1,'Refund Approved','https://share.sandbox.lalamove.com?PH100240711205112976520010079708055&lang=en_PH&sign=b08c8bf7eb6961b512ebe6a6455de59a&source=api_wrapper','166681440167-3007903540007166989-','2024-06-27 13:33:23','2024-07-11 13:07:14',NULL),(9,11,3,1,2,6,'MLJ4001','Men\'s Leather Jacket','Blue','S',79.91,1,'Refund Approved','https://share.sandbox.lalamove.com?PH100240711211251725520010022550342&lang=en_PH&sign=2ddfcec5eb4b8475ee9ca620950963ee&source=api_wrapper','160681443167-3007903540527255668-','2024-06-27 13:34:27','2024-07-11 13:33:04',NULL),(10,12,3,1,2,6,'MLJ4001','Men\'s Leather Jacket','Blue','S',79.91,1,'New',NULL,NULL,'2024-06-27 13:36:49','2024-06-27 13:36:49',NULL),(11,13,3,1,2,6,'MLJ4001','Men\'s Leather Jacket','Blue','S',79.91,1,'Pending Refund',NULL,NULL,'2024-06-27 13:37:28','2025-01-28 13:24:49',NULL),(12,14,3,1,2,6,'MLJ4001','Men\'s Leather Jacket','Blue','S',79.91,1,'Pending Refund',NULL,NULL,'2024-06-27 13:38:23','2025-01-29 08:14:59',NULL),(13,15,3,1,2,6,'MLJ4001','Men\'s Leather Jacket','Blue','S',79.91,1,'Pending Refund','https://share.sandbox.lalamove.com?PH100240630195918065520010073373035&lang=en_PH&sign=94463550c12e8f2ccc7799c223a391c5&source=api_wrapper','169281444155-2999025805117640875-','2024-06-27 13:40:10','2025-01-29 07:54:17',NULL),(14,16,3,1,2,22,'CAK1301','Creative Art Kit','Regular','11\"',34.94,1,'Pending Refund','https://share.sandbox.lalamove.com?PH100240713212936972520010046400849&lang=en_PH&sign=4e05508246772d160117daa78ccc7f88&source=api_wrapper','168081449128-3008794337984405630-','2024-07-12 11:22:27','2024-08-03 12:54:07',NULL),(15,17,3,1,2,23,'HGS1401','High-End Gaming Smartphone','Regular','Normal',1298.69,1,'Pending Refund',NULL,NULL,'2024-07-14 02:21:03','2025-01-29 07:37:17',NULL),(16,18,3,1,2,14,'PCS1101','Pro Camera Smartphone','White','Regular',998.99,1,'New',NULL,NULL,'2024-07-14 02:57:56','2024-07-14 02:57:56',NULL),(17,19,3,1,2,14,'PCS1101','Pro Camera Smartphone','White','Regular',998.99,1,'Pending Refund',NULL,NULL,'2024-07-14 03:02:04','2025-01-28 13:15:10',NULL),(18,20,3,1,2,23,'HGS1401','High-End Gaming Smartphone','Regular','Normal',1298.69,1,'New',NULL,NULL,'2024-07-14 04:07:33','2024-07-14 04:07:33',NULL),(19,21,3,1,2,23,'HGS1401','High-End Gaming Smartphone','Regular','Normal',1298.69,1,'Delivered',NULL,NULL,'2024-07-14 04:10:32','2025-01-29 07:09:06',NULL),(20,22,3,1,2,8,'PKS6001','Kids\' Play Kitchen Set','Blue','Regular',29.95,1,'Pending Refund',NULL,NULL,'2024-07-27 12:49:00','2025-01-29 06:06:38',NULL),(21,23,3,1,2,18,'CTS9002','Casual T-Shirt','Blue','Medium',19.95,1,'Pending Refund',NULL,NULL,'2025-01-21 12:13:54','2025-01-29 07:19:24',NULL),(22,24,3,1,2,9,'SMX7001','Smartphone X','Blue','Regular',599.39,1,'New',NULL,NULL,'2025-01-22 12:51:24','2025-01-22 12:51:24',NULL),(23,24,3,1,2,8,'PKS6001','Kids\' Play Kitchen Set','Blue','Regular',29.95,1,'New',NULL,NULL,'2025-01-22 12:51:24','2025-01-22 12:51:24',NULL),(24,25,3,1,2,7,'WHS5001','Women\'s High Heel Shoes','Blue','10',8982.00,1,'New',NULL,NULL,'2025-01-22 13:02:00','2025-01-22 13:02:00',NULL),(25,26,3,1,2,12,'CTS9001','Casual T-Shirt','Yellow','small',21.95,1,'New',NULL,NULL,'2025-01-22 13:10:13','2025-01-22 13:10:13',NULL),(26,27,3,1,2,8,'PKS6001','Kids\' Play Kitchen Set','Blue','Regular',29.95,2,'New',NULL,NULL,'2025-01-29 13:16:27','2025-01-29 13:16:27',NULL),(27,27,3,1,2,12,'CTS9001','Casual T-Shirt','Yellow','small',21.95,1,'New',NULL,NULL,'2025-01-29 13:16:27','2025-01-29 13:16:27',NULL),(28,28,3,1,2,8,'PKS6001','Kids\' Play Kitchen Set','Blue','Regular',29.95,3,'New',NULL,NULL,'2025-01-29 13:22:57','2025-01-29 13:22:57',NULL),(29,29,3,1,2,8,'PKS6001','Kids\' Play Kitchen Set','Blue','Regular',29.95,3,'New',NULL,NULL,'2025-01-29 13:23:46','2025-01-29 13:23:46',NULL),(30,30,3,1,2,8,'PKS6001','Kids\' Play Kitchen Set','Blue','Regular',29.95,3,'New',NULL,NULL,'2025-01-29 13:24:37','2025-01-29 13:24:37',NULL);
/*!40000 ALTER TABLE `orders_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `user_id` int NOT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(10,2) NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` VALUES (1,1,3,'pi_Y9aMqbAwEPZ3YzgATJdYyyXc','mytestuser3@test.com',53.98,'PHP','chargeable','2024-06-19 11:30:22','2024-06-19 11:30:22'),(2,2,3,'pi_mHY4oy5XhJBY5raCRzh6Wcdb','mytestuser3@test.com',50.98,'PHP','chargeable','2024-06-19 11:57:02','2024-06-19 11:57:02'),(3,3,3,'pi_5Gbdtx1P2rSkxAeYLLzYFSNG','mytestuser3@test.com',998.99,'PHP','chargeable','2024-06-20 12:08:01','2024-06-20 12:08:01'),(4,4,3,'pi_XowDcqs1jCVHzLGRCM2osoFr','mytestuser3@test.com',998.99,'PHP','chargeable','2024-06-20 12:08:29','2024-06-20 12:08:29'),(5,5,3,'pi_wr1nGvtQWaRa5gP389Drntth','mytestuser3@test.com',998.99,'PHP','chargeable','2024-06-20 12:18:37','2024-06-20 12:18:37'),(6,9,3,'pi_131V3Vn6z6FD8Pz9Ku5hxFf3','mytestuser3@test.com',15398.09,'PHP','paid','2024-06-25 12:26:06','2024-06-25 12:26:06'),(7,10,3,'pi_NN73cejsMmdAmwqtsFpJEtoo','mytestuser3@test.com',443.91,'PHP','chargeable','2024-06-27 13:33:24','2024-06-27 13:33:24'),(8,11,3,'pi_k9wi28sn1UxV9Hm4MCbjF2Ds','mytestuser3@test.com',443.91,'PHP','chargeable','2024-06-27 13:34:28','2024-06-27 13:34:28'),(9,12,3,'pi_wE7rqHQFVAnmvaRLNZ8Ykpo2','mytestuser3@test.com',443.91,'PHP','chargeable','2024-06-27 13:36:49','2024-06-27 13:36:49'),(10,13,3,'pi_WfmMw5zpCoAEmyhrYceHAqMi','mytestuser3@test.com',443.91,'PHP','chargeable','2024-06-27 13:37:28','2024-06-27 13:37:28'),(11,14,3,'pi_nff2FETcvwgFPkyx9seS1LJ7','mytestuser3@test.com',443.91,'PHP','paid','2024-06-27 13:38:23','2024-06-27 13:38:23'),(12,15,3,'pi_v2A5a5X1EcpHBevygCpSkfsJ','mytestuser3@test.com',443.91,'PHP','paid','2024-06-27 13:40:11','2024-06-27 13:40:11'),(13,16,3,'pi_4c12jCfEc6nX7sAnUc63zU8J','mytestuser3@test.com',377.94,'PHP','chargeable','2024-07-12 11:22:28','2024-07-12 11:22:28'),(14,17,3,'pi_LiHkPtksGGPHSZrfV3vdkHoH','mytestuser3@test.com',1547.69,'PHP','chargeable','2024-07-14 02:21:05','2024-07-14 02:21:05'),(15,18,3,'pi_iEcG9wLpzLvivRA1z46UXF4i','mytestuser3@test.com',1247.99,'PHP','chargeable','2024-07-14 02:57:56','2024-07-14 02:57:56'),(16,19,3,'pi_FXEthfPdDqv39MqJ1eTHHZ8x','mytestuser3@test.com',1247.99,'PHP','chargeable','2024-07-14 03:02:04','2024-07-14 03:02:04'),(17,20,3,'pi_CJPQQHy7nE8UNWsDUxVVFKtG','mytestuser3@test.com',1625.69,'PHP','chargeable','2024-07-14 04:07:34','2024-07-14 04:07:34'),(18,21,3,'pi_vW4CyfmJXDG4Z6hC74GMfVAh','mytestuser3@test.com',1547.69,'PHP','chargeable','2024-07-14 04:10:33','2024-07-14 04:10:33'),(19,22,3,'pi_rkkNUR4BCxViY6DRvfw66WTJ','mytestuser3@test.com',126.95,'PHP','chargeable','2024-07-27 12:49:01','2024-07-27 12:49:01'),(20,26,3,'pi_uxFCs3Jb6L9poauGhxZG1qsD','mytestuser3@test.com',266.56,'PHP','chargeable','2025-01-22 13:10:16','2025-01-22 13:10:16');
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

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

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platform_content`
--

DROP TABLE IF EXISTS `platform_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `platform_content` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `container` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platform_content`
--

LOCK TABLES `platform_content` WRITE;
/*!40000 ALTER TABLE `platform_content` DISABLE KEYS */;
INSERT INTO `platform_content` VALUES (1,'home','ks-who-are-we','We are kapiton','2024-04-21 21:08:23',NULL),(2,'','ks-become-a-merchant',NULL,'2024-04-21 21:17:45',NULL),(3,'front.user.about-us','ks-about-us','<p>This has been edited</p>','2024-04-21 21:19:17','2024-07-24 01:34:10'),(4,'front.user.about-us','ks-about-us-our-vision','<p>Our vision</p>','2024-04-21 21:19:20','2024-09-14 11:28:29'),(5,'front.user.about-us','ks-about-us-our-mission','<p>This is our mission</p>','2024-04-21 21:19:24','2024-07-24 01:34:36'),(6,'front.user.management','ks-about-us-management-kat','<p>Oy mga pare! magaling ako dito</p>','2024-04-21 21:20:14','2024-06-14 07:33:37'),(7,'front.user.management','ks-about-us-management-ejl',NULL,'2024-04-21 21:20:14',NULL),(8,'front.user.management','ks-about-us-management-vmg',NULL,'2024-04-21 21:20:14',NULL),(9,'front.user.management','ks-about-us-management-mfm',NULL,'2024-04-21 21:20:14',NULL),(10,'front.user.management','ks-about-us-management-rridb',NULL,'2024-04-21 21:20:14',NULL);
/*!40000 ALTER TABLE `platform_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prepaid_pincodes`
--

DROP TABLE IF EXISTS `prepaid_pincodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prepaid_pincodes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `pincode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prepaid_pincodes`
--

LOCK TABLES `prepaid_pincodes` WRITE;
/*!40000 ALTER TABLE `prepaid_pincodes` DISABLE KEYS */;
/*!40000 ALTER TABLE `prepaid_pincodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `section_id` int NOT NULL,
  `category_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `vendor_id` int NOT NULL,
  `admin_id` int NOT NULL,
  `admin_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `product_discount` double(8,2) NOT NULL,
  `product_weight` int NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_video` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `features` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_bestseller` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,2,5,7,1,2,'vendor','Redmi Note 11','RN11',15000.00,10.00,1,'9223.jpg','',NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.','{\"ram\":\"4 GB\"}',NULL,'RedmiNote11; MI Phone',NULL,'Yes','Yes',1,NULL,'2024-02-23 00:11:11'),(2,1,6,2,0,1,'superadmin','Red Casual T-Shirt','RC001',1000.00,20.00,1,'','',NULL,NULL,NULL,'','','','Yes','No',0,NULL,'2024-01-31 13:16:50'),(3,1,1,1,1,2,'vendor','Men\'s Casual Shirt','MS1001',29.99,10.00,1,'36738.jpg',NULL,'G001','A comfortable and stylish casual shirt for men.','[]','Men\'s Casual Shirt - XYZ Brand','Explore our latest collection of men\'s casual shirts.','men, clothing, casual shirt, XYZ Brand','No','No',1,NULL,'2024-06-20 13:56:54'),(4,1,19,2,1,2,'vendor','Women\'s Summer Dress','WSD1001',39.99,0.15,1,NULL,NULL,'G002','A trendy and comfortable summer dress for women.','[]','Women\'s Summer Dress - ABC Fashion','Discover the latest summer dresses for women at ABC Fashion.','women, clothing, summer dress, ABC Fashion','No','No',0,NULL,'2024-02-13 13:34:29'),(5,5,14,10,1,2,'vendor','Kids\' Educational Toy','KT3001',19.99,0.20,25,NULL,NULL,'G003','An interactive and educational toy for kids to learn while playing.','[]','Kids\' Educational Toy - Playful Kids','Explore our collection of educational toys for kids at Playful Kids.','kids, toys, educational toy, Playful Kids','No','Yes',1,NULL,'2024-02-15 13:12:33'),(6,1,1,4,1,2,'vendor','Men\'s Leather Jacket','MLJ4001',79.99,0.10,1,NULL,NULL,'G004','A stylish and durable leather jacket for men.',NULL,'Men\'s Leather Jacket - Fashion Hub','Explore our collection of men\'s leather jackets at Fashion Hub.','men, clothing, leather jacket, Fashion Hub','No','No',1,NULL,NULL),(7,1,2,5,1,2,'vendor','Women\'s High Heel Shoes','WHS5001',49.99,0.20,1,NULL,NULL,'G005','Elegant and comfortable high heel shoes for women.','[]','Women\'s High Heel Shoes - Chic Trends','Step into style with our collection of high heel shoes for women at Chic Trends.','women, footwear, high heel shoes, Chic Trends','No','No',1,NULL,'2024-01-14 05:17:22'),(8,5,14,6,1,2,'vendor','Kids\' Play Kitchen Set','PKS6001',29.99,0.15,1,NULL,NULL,'G006','A fun and interactive play kitchen set for kids to unleash their creativity.','[]','Kids\' Play Kitchen Set - Joyful Toys','Inspire imaginative play with our kids\' play kitchen set at Joyful Toys.','kids, toys, play kitchen set, Joyful Toys','No','No',1,NULL,'2024-01-13 15:06:53'),(9,2,4,7,1,2,'vendor','Smartphone X','SMX7001',599.99,0.10,0,NULL,NULL,'G007','The latest and feature-packed Smartphone X for tech enthusiasts.',NULL,'Smartphone X - Tech Guru','Experience the future with Smartphone X, the latest innovation from Tech Guru.','mobiles, smartphones, Smartphone X, Tech Guru','No','No',1,NULL,NULL),(10,3,9,8,1,2,'vendor','Cozy Throw Blanket','CTB8001',24.99,0.20,1,NULL,NULL,'G008','A soft and warm throw blanket to add comfort to your home.',NULL,'Cozy Throw Blanket - Cozy Living','Transform your living space with the warmth of our Cozy Throw Blanket at Cozy Living.','home, decor, throw blanket, Cozy Living','No','No',1,NULL,NULL),(11,2,4,3,1,2,'vendor','Powerful Smartphone','PSM8001',799.99,0.05,0,NULL,NULL,'G009','A high-performance smartphone with advanced features.',NULL,'Powerful Smartphone - Tech Innovations','Discover the power of our latest smartphone at Tech Innovations.','mobiles, smartphones, Powerful Smartphone, Tech Innovations','No','No',1,NULL,'2024-01-13 15:02:43'),(12,1,6,11,1,2,'vendor','Casual T-Shirt','CTS9001',19.99,0.20,0,NULL,NULL,'G010','A comfortable and stylish casual T-shirt for everyday wear.','[]','Casual T-Shirt - Everyday Fashion','Upgrade your wardrobe with our casual T-shirts at Everyday Fashion.','men, clothing, casual T-shirt, Everyday Fashion','No','No',1,NULL,'2024-04-09 11:44:53'),(13,1,6,5,1,2,'vendor','Interactive Learning Toy','ILT1001',29.99,15.00,1,NULL,NULL,'G011','Engage your child with this interactive and educational learning toy.',NULL,'Interactive Learning Toy - Learn & Play','Promote learning through play with our interactive toy at Learn & Play.','kids, toys, learning toy, Learn & Play','No','No',1,NULL,NULL),(14,2,4,6,1,2,'vendor','Pro Camera Smartphone','PCS1101',999.99,0.10,0,NULL,NULL,'G012','Capture stunning moments with the professional-grade camera on this smartphone.',NULL,'Pro Camera Smartphone - Photography Edition','Unleash your photography skills with our Pro Camera Smartphone at Photography Edition.','mobiles, smartphones, Pro Camera Smartphone, Photography Edition','No','No',1,NULL,NULL),(15,2,5,7,1,2,'vendor','Formal Business Shirt','FBS1201',49.99,0.20,1,NULL,NULL,'G013','Look sharp and professional with this formal business shirt.',NULL,'Formal Business Shirt - Professional Attire','Elevate your professional attire with our formal business shirts at Professional Attire.','men, clothing, formal shirt, Professional Attire','No','No',1,NULL,NULL),(16,5,14,13,1,2,'vendor','Creative Art Kit','CAK1300',34.99,0.15,1,NULL,NULL,'G014','Encourage creativity with this comprehensive art kit for kids.','[]','Creative Art Kit - Artistic Expressions','Inspire artistic expressions with our Creative Art Kit at Artistic Expressions.','kids, toys, art kit, Artistic Expressions','No','No',1,NULL,'2024-01-14 05:14:06'),(17,1,4,3,1,2,'vendor','Powerful Smartphone','PSM8001',799.99,0.05,0,NULL,NULL,'G009','A high-performance smartphone with advanced features.',NULL,'Powerful Smartphone - Tech Innovations','Discover the power of our latest smartphone at Tech Innovations.','mobiles, smartphones, Powerful Smartphone, Tech Innovations','No','No',1,NULL,NULL),(18,1,6,9,1,2,'vendor','Casual T-Shirt','CTS9002',19.99,0.20,0,NULL,NULL,'G010','A comfortable and stylish casual T-shirt for everyday wear.','[]','Casual T-Shirt - Everyday Fashion','Upgrade your wardrobe with our casual T-shirts at Everyday Fashion.','men, clothing, casual T-shirt, Everyday Fashion','No','No',1,NULL,'2024-04-09 11:45:22'),(19,3,6,5,1,2,'vendor','Pokemon Card Collection','ILT1001',150.99,15.00,1,NULL,NULL,'G011','Engage your child with this interactive and educational learning toy.',NULL,'Interactive Learning Toy - Learn & Play','Promote learning through play with our interactive toy at Learn & Play.','kids, toys, learning toy, Learn & Play','No','No',1,NULL,'2024-01-13 15:02:49'),(20,2,4,6,1,2,'vendor','Pro Camera Smartphone','PCS1101',999.99,0.10,0,NULL,NULL,'G012','Capture stunning moments with the professional-grade camera on this smartphone.','[]','Pro Camera Smartphone - Photography Edition','Unleash your photography skills with our Pro Camera Smartphone at Photography Edition.','mobiles, smartphones, Pro Camera Smartphone, Photography Edition','No','Yes',1,NULL,'2024-01-14 05:28:07'),(21,2,5,7,1,2,'vendor','Formal Business Shirt','FBS1201',49.99,0.20,1,NULL,NULL,'G013','Look sharp and professional with this formal business shirt.',NULL,'Formal Business Shirt - Professional Attire','Elevate your professional attire with our formal business shirts at Professional Attire.','men, clothing, formal shirt, Professional Attire','No','No',1,NULL,'2024-01-13 15:02:46'),(22,5,15,8,1,2,'vendor','Creative Art Kit','CAK1301',34.99,0.15,1,NULL,NULL,'G014','Encourage creativity with this comprehensive art kit for kids.','[]','Creative Art Kit - Artistic Expressions','Inspire artistic expressions with our Creative Art Kit at Artistic Expressions.','kids, toys, art kit, Artistic Expressions','No','No',1,NULL,'2024-01-14 05:11:47'),(23,2,4,4,1,2,'vendor','High-End Gaming Smartphone','HGS1401',1299.99,0.10,0,NULL,NULL,'G015','Immerse yourself in gaming with this high-end gaming smartphone.','{\"ram\":\"4 GB\"}','High-End Gaming Smartphone - Game Master','Level up your gaming experience with our High-End Gaming Smartphone at Game Master.','mobiles, smartphones, gaming smartphone, Game Master','No','No',1,NULL,'2024-01-14 05:11:06'),(24,2,5,4,1,2,'vendor','Classic Polo Shirt','CPS1501',29.99,0.20,0,NULL,NULL,'G016','A timeless classic, this polo shirt is perfect for any occasion.',NULL,'Classic Polo Shirt - Timeless Elegance','Elevate your style with our Classic Polo Shirt at Timeless Elegance.','men, clothing, polo shirt, Timeless Elegance','No','No',1,NULL,NULL),(26,1,4,3,1,2,'vendor','Powerful Smartphone','PSM8001',799.99,0.05,0,NULL,NULL,'G009','A high-performance smartphone with advanced features.',NULL,'Powerful Smartphone - Tech Innovations','Discover the power of our latest smartphone at Tech Innovations.','mobiles, smartphones, Powerful Smartphone, Tech Innovations','No','No',0,NULL,NULL),(27,2,5,4,1,2,'vendor','Casual T-Shirt','CTS9003',19.99,0.20,0,NULL,NULL,'G010','A comfortable and stylish casual T-shirt for everyday wear.',NULL,'Casual T-Shirt - Everyday Fashion','Upgrade your wardrobe with our casual T-shirts at Everyday Fashion.','men, clothing, casual T-shirt, Everyday Fashion','No','No',0,NULL,NULL),(28,3,6,5,1,2,'vendor','Interactive Learning Toy','ILT1001',29.99,0.15,1,NULL,NULL,'G011','Engage your child with this interactive and educational learning toy.',NULL,'Interactive Learning Toy - Learn & Play','Promote learning through play with our interactive toy at Learn & Play.','kids, toys, learning toy, Learn & Play','No','No',0,NULL,NULL),(29,1,4,6,1,2,'vendor','Pro Camera Smartphone','PCS1101',999.99,0.10,0,NULL,NULL,'G012','Capture stunning moments with the professional-grade camera on this smartphone.',NULL,'Pro Camera Smartphone - Photography Edition','Unleash your photography skills with our Pro Camera Smartphone at Photography Edition.','mobiles, smartphones, Pro Camera Smartphone, Photography Edition','No','No',0,NULL,NULL),(30,2,5,7,1,2,'vendor','Formal Business Shirt','FBS1201',49.99,0.20,1,NULL,NULL,'G013','Look sharp and professional with this formal business shirt.',NULL,'Formal Business Shirt - Professional Attire','Elevate your professional attire with our formal business shirts at Professional Attire.','men, clothing, formal shirt, Professional Attire','No','No',0,NULL,NULL),(31,3,6,8,1,2,'vendor','Creative Art Kit','CAK1301',34.99,0.15,1,NULL,NULL,'G014','Encourage creativity with this comprehensive art kit for kids.',NULL,'Creative Art Kit - Artistic Expressions','Inspire artistic expressions with our Creative Art Kit at Artistic Expressions.','kids, toys, art kit, Artistic Expressions','No','No',0,NULL,NULL),(32,1,4,3,1,2,'vendor','High-End Gaming Smartphone','HGS1401',1299.99,0.10,0,NULL,NULL,'G015','Immerse yourself in gaming with this high-end gaming smartphone.',NULL,'High-End Gaming Smartphone - Game Master','Level up your gaming experience with our High-End Gaming Smartphone at Game Master.','mobiles, smartphones, gaming smartphone, Game Master','No','No',0,NULL,NULL),(33,2,5,4,1,2,'vendor','Classic Polo Shirt','CPS1501',29.99,0.20,0,NULL,NULL,'G016','A timeless classic, this polo shirt is perfect for any occasion.',NULL,'Classic Polo Shirt - Timeless Elegance','Elevate your style with our Classic Polo Shirt at Timeless Elegance.','men, clothing, polo shirt, Timeless Elegance','No','No',0,NULL,NULL),(34,2,5,16,13,13,'vendor','Smartphone 11','2566998855',15999.00,0.00,0,'19981.jpg',NULL,'GRPSMRT','Smartphone','{\"ram\":\"4 GB\"}','Smartphone 4GB RAM','4GB RAM; Smartphone; Sale',NULL,'No','No',1,'2024-03-15 02:04:03','2024-06-25 13:41:20'),(35,1,7,16,13,13,'vendor','Fabric Shirt','001259',99.00,0.00,0,'27886.jpg',NULL,NULL,NULL,'{\"fabric\":\"cotton\"}',NULL,NULL,NULL,'No','No',0,'2024-06-25 13:47:15','2024-06-25 13:47:15'),(36,4,11,16,1,2,'vendor','Pampaganda','125699',999.00,0.00,1,NULL,NULL,'FDA approved.',NULL,'[]',NULL,NULL,NULL,'No','No',0,'2024-07-27 13:07:14','2024-07-27 13:07:14');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_attributes`
--

DROP TABLE IF EXISTS `products_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_attributes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `stock` int NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_attributes`
--

LOCK TABLES `products_attributes` WRITE;
/*!40000 ALTER TABLE `products_attributes` DISABLE KEYS */;
INSERT INTO `products_attributes` VALUES (1,2,'Blue','Small',1000.00,100,'RC001-S',1,NULL,'2024-01-29 12:40:14'),(2,2,'Blue','Medium',1100.00,15,'RC001-M',1,NULL,NULL),(3,2,'Blue','Large',1200.00,20,'RC001-L',1,NULL,NULL),(4,1,'Blue','6.43\"',13999.99,40,'RN11_6.43',1,'2024-01-13 13:33:27','2024-02-25 14:01:18'),(5,1,'Blue','6.89\"',14999.99,20,'RN11_6.89',1,'2024-01-13 13:33:27','2024-01-13 13:33:36'),(6,7,'Blue','10',9000.00,99,'000998899',1,'2024-01-26 12:04:53','2025-01-22 13:02:00'),(7,3,'Blue','S',29.99,98,'0012233',1,'2024-01-28 06:25:11','2024-06-19 11:30:21'),(8,3,'Blue','M',30.10,10,'0012334',1,'2024-01-28 06:25:11','2024-01-28 06:25:11'),(9,3,'Blue','L',34.99,10,'0012335',1,'2024-01-28 06:25:11','2024-01-28 06:25:11'),(10,4,'Blue','XS',39.99,100,'001229',1,'2024-01-28 06:26:50','2024-01-29 12:40:14'),(11,4,'Blue','S',41.99,10,'001230',1,'2024-01-28 06:26:50','2024-01-28 06:26:50'),(12,4,'Blue','M',45.99,10,'001231',1,'2024-01-28 06:26:50','2024-01-28 06:26:50'),(13,4,'Blue','L',47.99,10,'001232',1,'2024-01-28 06:26:50','2024-01-28 06:26:50'),(14,8,'Blue','Regular',29.99,87,'002359998',1,'2024-01-28 06:27:32','2025-01-29 13:24:37'),(15,6,'Blue','S',79.99,94,'003256446',1,'2024-01-28 06:28:39','2024-06-27 13:40:10'),(16,6,'Blue','M',79.99,10,'003256447',1,'2024-01-28 06:28:39','2024-01-28 06:28:39'),(17,6,'Blue','L',79.99,10,'003256448',1,'2024-01-28 06:28:39','2024-01-28 06:28:39'),(18,9,'Blue','Regular',599.99,21,'0031244888',1,'2024-01-28 06:29:24','2025-01-22 12:51:24'),(19,34,'Blue','11\"',15999.00,9,'0002233699',1,'2024-03-15 02:04:49','2024-06-25 12:26:04'),(20,12,'White','Large',0.00,0,'099100991',1,'2024-04-09 11:47:50','2024-10-27 12:39:35'),(21,18,'Blue','Medium',19.99,47,'00023566',1,'2024-06-16 04:27:51','2025-01-21 12:13:54'),(22,13,'-','-',29.99,76,'120157899',1,'2024-06-16 08:20:23','2024-06-19 11:57:02'),(23,17,'-','-',799.99,49,'2155890001',1,'2024-06-16 08:23:05','2024-06-16 13:57:35'),(24,20,'Grey','8\"',999.99,16,'152000236',1,'2024-06-20 11:51:24','2024-06-25 12:26:04'),(25,22,'Regular','11\"',34.99,49,'00266dad6666',1,'2024-07-12 11:21:02','2024-07-12 11:22:27'),(26,23,'Regular','Normal',1299.99,2,'001215989',1,'2024-07-14 02:02:09','2024-07-14 04:10:32'),(27,14,'White','Regular',999.99,18,'010256698',1,'2024-07-14 02:52:24','2024-07-14 03:02:04'),(28,1,'Blue','98',0.00,18,'-66AA3C28CA2D0',1,'2024-07-31 13:29:12','2024-07-31 13:29:12'),(29,1,'Blue','6.48\"',0.00,0,'-66AA3C428B608',1,'2024-07-31 13:29:38','2024-07-31 13:29:38'),(30,1,'Yello','6.43\"',0.00,0,'SMA-66AA3CA4002BF',1,'2024-07-31 13:31:16','2024-07-31 13:31:16'),(31,12,'Yellow','8',0.00,0,'T-S-671DC55FE1CC0',1,'2024-10-27 04:45:19','2024-10-27 12:39:35'),(32,12,'Yellow','12',0.00,0,'T-S-671DC55FE34FA',1,'2024-10-27 04:45:19','2024-10-27 12:39:35'),(33,12,'Yellow','small',21.99,3,'T-S-671DC55FE4702',1,'2024-10-27 04:45:19','2025-01-29 13:16:27'),(34,12,'Green','8',18.25,3,'T-S-671DC55FE5823',1,'2024-10-27 04:45:19','2024-10-27 12:39:35'),(35,12,'Green','12',0.00,0,'T-S-671DC55FE65C8',1,'2024-10-27 04:45:19','2024-10-27 12:39:35'),(36,12,'Green','small',19.90,3,'T-S-671DC55FE7D85',1,'2024-10-27 04:45:19','2025-01-29 13:16:27'),(37,12,'Yue','7',19.99,15,'T-S-671DC84B9458C',1,'2024-10-27 04:57:47','2024-10-27 12:39:35'),(38,18,'Yellow','small',0.00,0,'T-S-671DC9B2CCC70',1,'2024-10-27 05:03:46','2024-10-28 05:52:52'),(39,18,'Yellow','medium',0.00,47,'T-S-671DC9B2CE1C1',1,'2024-10-27 05:03:46','2025-01-21 12:13:54'),(40,18,'Yellow','large',20.98,50,'T-S-671DC9B2CF0FB',1,'2024-10-27 05:03:46','2024-10-28 05:52:52'),(41,18,'Green','small',0.00,0,'T-S-671DC9B2CFFEB',1,'2024-10-27 05:03:46','2024-10-28 05:52:52'),(42,18,'Green','medium',0.00,47,'T-S-671DC9B2D1A87',1,'2024-10-27 05:03:46','2025-01-21 12:13:54'),(43,18,'Green','large',0.00,0,'T-S-671DC9B2D308C',1,'2024-10-27 05:03:46','2024-10-28 05:52:52'),(44,18,'Blue','small',0.00,0,'T-S-671DC9B2D4369',1,'2024-10-27 05:03:46','2024-10-28 05:52:52'),(45,24,'Yellow','small',0.00,0,'SMA-671F28CC238B7',1,'2024-10-28 06:01:48','2024-10-28 06:01:48'),(46,24,'Yellow','large',0.00,0,'SMA-671F28CC25BA5',1,'2024-10-28 06:01:48','2024-10-28 06:01:48'),(47,24,'Blue','small',0.00,0,'SMA-671F28CC273F1',1,'2024-10-28 06:01:48','2024-10-28 06:01:48'),(48,24,'Blue','large',0.00,0,'SMA-671F28CC28E9C',1,'2024-10-28 06:01:48','2024-10-28 06:01:48'),(49,24,'Green','large',0.00,0,'SMA-671F2C68E9876',1,'2024-10-28 06:17:12','2024-10-28 06:17:12'),(50,24,'Blue','medium',0.00,0,'SMA-671F2E475FE29',1,'2024-10-28 06:25:11','2024-10-28 06:25:11'),(51,24,'Blue','XXL',0.00,0,'SMA-671F2E4761AED',1,'2024-10-28 06:25:11','2024-10-28 06:25:11'),(52,24,'Green','medium',0.00,0,'SMA-671F2E47630B8',1,'2024-10-28 06:25:11','2024-10-28 06:25:11'),(53,24,'Green','XXL',0.00,0,'SMA-671F2E47648F8',1,'2024-10-28 06:25:11','2024-10-28 06:25:11'),(54,24,'White','medium',0.00,0,'SMA-671F2E4765E20',1,'2024-10-28 06:25:11','2024-10-28 06:25:11'),(55,24,'White','XXL',0.00,0,'SMA-671F2E47670A6',1,'2024-10-28 06:25:11','2024-10-28 06:25:11'),(56,24,'Yellow','medium',0.00,0,'SMA-671F2EAA38AB6',1,'2024-10-28 06:26:50','2024-10-28 06:26:50'),(57,10,'Grey','small',50.00,10,'HOM-671F2F39AF987',1,'2024-10-28 06:29:13','2024-12-16 14:04:58'),(58,10,'Grey','medium',0.00,0,'HOM-671F2F39B1695',1,'2024-10-28 06:29:13','2024-12-16 14:04:58'),(59,10,'Grey','large',50.00,10,'HOM-671F2F39B3021',1,'2024-10-28 06:29:13','2024-12-16 14:04:58'),(60,10,'Black','small',0.00,0,'HOM-671F2F39B4C1C',1,'2024-10-28 06:29:13','2024-12-16 14:04:58'),(61,10,'Black','medium',40.00,10,'HOM-671F2F39B6329',1,'2024-10-28 06:29:13','2024-12-16 14:04:58'),(62,10,'Black','large',45.00,10,'HOM-671F2F39B8687',1,'2024-10-28 06:29:13','2024-12-16 14:04:58'),(63,10,'Blue','small',0.00,0,'HOM-671F2F39B9D34',1,'2024-10-28 06:29:13','2024-12-16 13:54:14'),(64,10,'Blue','medium',0.00,0,'HOM-671F2F39BB828',1,'2024-10-28 06:29:13','2024-12-16 14:04:58'),(65,10,'Blue','large',50.00,10,'HOM-671F2F39BD185',1,'2024-10-28 06:29:13','2024-12-16 14:04:58'),(66,10,'Green','small',0.00,0,'HOM-671F2F39BECA8',1,'2024-10-28 06:29:13','2024-12-16 13:54:14'),(67,10,'Green','medium',0.00,0,'HOM-671F2F39C047B',1,'2024-10-28 06:29:13','2024-12-16 14:04:58'),(68,10,'Green','large',10.00,10,'HOM-671F2F39C1F2D',1,'2024-10-28 06:29:13','2024-12-16 14:04:58'),(69,15,'Large','',0.00,0,'SMA-672C7EA09B1D0',1,'2024-11-07 08:47:28','2024-11-07 08:47:28'),(70,15,'Medium','',0.00,0,'SMA-672C7EA0A0692',1,'2024-11-07 08:47:28','2024-11-07 08:47:28'),(71,15,'Small','',0.00,0,'SMA-672C7EA0A37FF',1,'2024-11-07 08:47:28','2024-11-07 08:47:28'),(72,15,'X-Small','',49.99,0,'SMA-672C7F7D616BF',1,'2024-11-07 08:51:09','2024-11-07 08:51:09'),(73,34,'Yellow','11\"',15999.00,0,'SMA-677FBDD952BA1',1,'2025-01-09 12:15:21','2025-01-09 12:15:21'),(74,34,'Green','14\"',15999.00,0,'SMA-677FBE0F9F79A',1,'2025-01-09 12:16:15','2025-01-09 12:16:15'),(75,13,'Blue','',29.99,0,'T-S-677FBEC17674A',1,'2025-01-09 12:19:13','2025-01-09 12:19:13'),(76,13,'White','',29.99,0,'T-S-677FBEC178141',1,'2025-01-09 12:19:13','2025-01-09 12:19:13'),(77,14,'Blue','',999.99,0,'MOB-677FBF905CBD5',1,'2025-01-09 12:22:40','2025-01-09 12:22:40'),(78,14,'Green','',999.99,0,'MOB-677FBF905E59B',1,'2025-01-09 12:22:40','2025-01-09 12:22:40'),(79,15,'90','',49.99,0,'SMA-677FBFBEA6F36',1,'2025-01-09 12:23:26','2025-01-09 12:23:26');
/*!40000 ALTER TABLE `products_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_filters`
--

DROP TABLE IF EXISTS `products_filters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_filters` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cat_ids` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter_column` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_filters`
--

LOCK TABLES `products_filters` WRITE;
/*!40000 ALTER TABLE `products_filters` DISABLE KEYS */;
INSERT INTO `products_filters` VALUES (1,'1,2,3,6,7,8','Fabric','fabric',1,NULL,NULL),(2,'4,5','RAM','ram',1,NULL,NULL);
/*!40000 ALTER TABLE `products_filters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_filters_values`
--

DROP TABLE IF EXISTS `products_filters_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_filters_values` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `filter_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_filters_values`
--

LOCK TABLES `products_filters_values` WRITE;
/*!40000 ALTER TABLE `products_filters_values` DISABLE KEYS */;
INSERT INTO `products_filters_values` VALUES (1,'1','cotton',1,NULL,NULL),(2,'1','polyester',1,NULL,NULL),(3,'2','4 GB',1,NULL,NULL),(4,'2','8 GB',1,NULL,NULL);
/*!40000 ALTER TABLE `products_filters_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_images`
--

DROP TABLE IF EXISTS `products_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_images`
--

LOCK TABLES `products_images` WRITE;
/*!40000 ALTER TABLE `products_images` DISABLE KEYS */;
INSERT INTO `products_images` VALUES (2,1,'mimg03.jpg86803.jpg',1,'2024-02-23 00:10:11','2024-02-23 00:10:11'),(3,1,'XIAOMI-REDMI-NOTE-11-6GB-128GB-TWILIGHT-BLUE.jpg78587.jpg',1,'2024-02-23 00:10:11','2024-02-23 00:10:11'),(4,1,'XIAOMI-REDMI-NOTE-11-6GB-128GB-TWILIGHT-BLUE.jpg96189.jpg',1,'2024-02-23 00:10:45','2024-02-23 00:10:45'),(5,1,'181428_2020_1.jpg30658.jpg',1,'2024-02-23 00:14:39','2024-02-23 00:14:39'),(6,1,'XIAOMI-REDMI-NOTE-11-1.jpg9471.jpg',1,'2024-02-23 00:14:39','2024-02-23 00:14:39'),(7,3,'39487.jpg',1,'2024-06-20 13:07:52','2024-06-20 13:07:52'),(8,3,'85193.jpg',1,'2024-06-20 13:36:00','2024-06-20 13:36:00'),(9,3,'38668.jpg',1,'2024-06-20 13:48:27','2024-06-20 13:48:27'),(10,3,'11892.jpg',1,'2024-06-20 13:52:20','2024-06-20 13:52:20'),(11,3,'34287.jpg',1,'2024-06-20 13:55:35','2024-06-20 13:55:35'),(12,3,'36738.jpg',1,'2024-06-20 13:56:54','2024-06-20 13:56:54'),(13,35,'27886.jpg',1,'2024-06-25 13:47:21','2024-06-25 13:47:21');
/*!40000 ALTER TABLE `products_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products_variants`
--

DROP TABLE IF EXISTS `products_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products_variants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `variant_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products_variants`
--

LOCK TABLES `products_variants` WRITE;
/*!40000 ALTER TABLE `products_variants` DISABLE KEYS */;
INSERT INTO `products_variants` VALUES (1,12,'Color','2024-10-27 04:45:19','2024-10-27 04:45:19'),(2,12,'Size','2024-10-27 04:45:19','2024-10-27 04:45:19'),(5,18,'Color','2024-10-27 05:03:46','2024-10-27 05:03:46'),(6,18,'Size',NULL,NULL),(9,24,'Color','2024-10-28 06:15:28','2024-10-28 06:15:28'),(10,24,'Size','2024-10-28 06:15:28','2024-10-28 06:15:28'),(13,10,'Color','2024-10-28 06:29:13','2024-10-28 06:29:13'),(14,10,'Size','2024-10-28 06:29:13','2024-10-28 06:29:13'),(15,15,'Size','2024-11-07 08:42:35','2024-11-07 08:42:35'),(16,34,'Color','2025-01-09 12:11:40','2025-01-09 12:11:40'),(17,34,'Size','2025-01-09 12:11:40','2025-01-09 12:11:40'),(18,13,'Color','2025-01-09 12:19:13','2025-01-09 12:19:13'),(19,14,'Color','2025-01-09 12:22:40','2025-01-09 12:22:40');
/*!40000 ALTER TABLE `products_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ratings`
--

DROP TABLE IF EXISTS `ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ratings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ratings`
--

LOCK TABLES `ratings` WRITE;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` VALUES (1,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(2,2,2,'Awesome product!',5,1,NULL,NULL,''),(12,1,10,'Comment',5,1,'2024-03-21 11:41:39','2024-03-21 11:41:39',''),(13,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(14,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(15,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(16,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(17,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(18,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(19,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(20,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(21,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(22,2,2,'Awesome product!',5,1,NULL,NULL,''),(23,1,10,'Comment',5,1,'2024-03-21 11:41:39','2024-03-21 11:41:39',''),(24,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(25,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(26,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(27,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(28,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(29,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(30,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(31,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(32,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(33,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(34,2,1,'It\'s a great mobile phone!',4,1,NULL,NULL,''),(35,3,12,'sample title',5,1,'2024-06-27 14:38:29','2024-06-27 14:38:29','Test Title 2'),(36,3,13,'sample review',5,1,'2024-06-27 14:40:19','2024-06-27 14:40:19','Test'),(37,3,10,'ggfhfgfdd',1,1,'2024-06-27 15:12:19','2024-06-27 15:12:19','Second Article'),(38,3,9,'ggfhfgfdd',1,1,'2024-06-27 15:12:36','2024-06-27 15:12:36','Second Article'),(39,3,8,'ggfhfgfdd',1,1,'2024-06-27 15:13:54','2024-06-27 15:13:54','Second Article'),(40,3,6,'asdfasdfasdf',5,1,'2024-06-27 15:20:51','2024-06-27 15:20:51','Second Article');
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recently_viewed_products`
--

DROP TABLE IF EXISTS `recently_viewed_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recently_viewed_products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=155 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recently_viewed_products`
--

LOCK TABLES `recently_viewed_products` WRITE;
/*!40000 ALTER TABLE `recently_viewed_products` DISABLE KEYS */;
INSERT INTO `recently_viewed_products` VALUES (1,1,'5d6957ae30ee74c665b34b9dee16226b',NULL,NULL),(2,10,'f0b2a45068e93ce26dfd1a46969c10a6',NULL,NULL),(3,5,'f0b2a45068e93ce26dfd1a46969c10a6',NULL,NULL),(4,20,'267a096050f5a673ed077c305717a877',NULL,NULL),(5,4,'267a096050f5a673ed077c305717a877',NULL,NULL),(6,3,'c13c6c56f39f1c2c06c7b6fefb98a452',NULL,NULL),(7,3,'49fcfc71deb143d06cd289a3bb14fcf3',NULL,NULL),(8,4,'74bf33a0489ea2a60f9d65c85f1a5a0a',NULL,NULL),(9,23,'4b9e741cfdaf4c7fdabc0ca80bcc593b',NULL,NULL),(10,17,'260471ff5e0613c2c404d564b05c1184',NULL,NULL),(11,2,'260471ff5e0613c2c404d564b05c1184',NULL,NULL),(12,2,'43d51278b9762de4927be075911c547a',NULL,NULL),(13,2,'eeb5b5fdc14e33e6f9476a5ffd1bff49',NULL,NULL),(14,1,'eeb5b5fdc14e33e6f9476a5ffd1bff49',NULL,NULL),(15,7,'37327de20d3c0217e37c1b2ee4dd0e3a',NULL,NULL),(16,7,'1f9b1d2602cedd4fc47ee0ce19788a0e',NULL,NULL),(17,1,'1f9b1d2602cedd4fc47ee0ce19788a0e',NULL,NULL),(18,2,'23479f0a482e03f0dffc80e8fc08987d',NULL,NULL),(19,6,'23479f0a482e03f0dffc80e8fc08987d',NULL,NULL),(20,3,'62f1844c89ba8f98b1a550b620b601a5',NULL,NULL),(21,4,'62f1844c89ba8f98b1a550b620b601a5',NULL,NULL),(22,6,'62f1844c89ba8f98b1a550b620b601a5',NULL,NULL),(23,7,'62f1844c89ba8f98b1a550b620b601a5',NULL,NULL),(24,5,'62f1844c89ba8f98b1a550b620b601a5',NULL,NULL),(25,8,'62f1844c89ba8f98b1a550b620b601a5',NULL,NULL),(26,2,'b47eb38aa1c252bd603656a86d9d7c55',NULL,NULL),(27,24,'33d7aa6bf94515d145655f812a4a9ab3',NULL,NULL),(28,22,'33d7aa6bf94515d145655f812a4a9ab3',NULL,NULL),(29,18,'33d7aa6bf94515d145655f812a4a9ab3',NULL,NULL),(30,2,'33d7aa6bf94515d145655f812a4a9ab3',NULL,NULL),(31,24,'eca974aab39d18d35ea4dc97cd024827',NULL,NULL),(32,2,'eca974aab39d18d35ea4dc97cd024827',NULL,NULL),(33,13,'0be6f162f302d24fa207ea9579c02fb4',NULL,NULL),(34,23,'68ef7482151fbfb8149baed62fbad028',NULL,NULL),(35,22,'68ef7482151fbfb8149baed62fbad028',NULL,NULL),(36,1,'68ef7482151fbfb8149baed62fbad028',NULL,NULL),(37,3,'68ef7482151fbfb8149baed62fbad028',NULL,NULL),(38,11,'68ef7482151fbfb8149baed62fbad028',NULL,NULL),(39,1,'90186601395552b744901fe5da4431f6',NULL,NULL),(40,22,'7d242e259f00e31be5eed2718006cf75',NULL,NULL),(41,1,'2c5975db2770d784f577efee16ea862d',NULL,NULL),(42,6,'9f4e14767b1e0764be6ed321e6aa7feb',NULL,NULL),(43,8,'1689f3c282078539474d90d74ab7896d',NULL,NULL),(44,1,'1689f3c282078539474d90d74ab7896d',NULL,NULL),(45,1,'655ebcc5494d141a5b6f73216131f8e6',NULL,NULL),(46,9,'8f1c96881066918eb1d1263cebbd9993',NULL,NULL),(47,1,'f01da987424fa32d2fab5ea482aa9a93',NULL,NULL),(48,34,'f01da987424fa32d2fab5ea482aa9a93',NULL,NULL),(49,3,'a1c4e6c6811b0922288cad6890981f37',NULL,NULL),(50,3,'9609a8e5bf0ddeb0c195b0612836d0fa',NULL,NULL),(51,6,'9609a8e5bf0ddeb0c195b0612836d0fa',NULL,NULL),(52,13,'9609a8e5bf0ddeb0c195b0612836d0fa',NULL,NULL),(53,3,'6d8063a7a40c067ab303e423fd030e72',NULL,NULL),(54,3,'1388c2999f7fa5d26b3c3cb16358a699',NULL,NULL),(55,10,'1388c2999f7fa5d26b3c3cb16358a699',NULL,NULL),(56,9,'1388c2999f7fa5d26b3c3cb16358a699',NULL,NULL),(57,1,'0fb64c12d577b5dae0f0de04fabc9889',NULL,NULL),(58,3,'0fb64c12d577b5dae0f0de04fabc9889',NULL,NULL),(59,10,'0fb64c12d577b5dae0f0de04fabc9889',NULL,NULL),(60,22,'0fb64c12d577b5dae0f0de04fabc9889',NULL,NULL),(61,1,'14cd0a249355319da64c98fc0c1d3d78',NULL,NULL),(62,9,'14cd0a249355319da64c98fc0c1d3d78',NULL,NULL),(63,26,'14cd0a249355319da64c98fc0c1d3d78',NULL,NULL),(64,3,'0ac37bf8ae965912aaae95be18aa04df',NULL,NULL),(65,1,'0a484c2988a41a88325a99547fa2af86',NULL,NULL),(66,14,'0a484c2988a41a88325a99547fa2af86',NULL,NULL),(67,24,'9a03249141918bf54028a5d44ff9551d',NULL,NULL),(68,34,'9a03249141918bf54028a5d44ff9551d',NULL,NULL),(69,27,'9a03249141918bf54028a5d44ff9551d',NULL,NULL),(70,12,'9a03249141918bf54028a5d44ff9551d',NULL,NULL),(71,34,'fd76c6990bbad888d3d6a55e768cae4a',NULL,NULL),(72,34,'846781d2f523d630d6771a81957d3584',NULL,NULL),(73,3,'62cb5bb8a4745acead6807b8644c9bdd',NULL,NULL),(74,1,'719c0062013d3d927ab303741f3d1dca',NULL,NULL),(75,3,'719c0062013d3d927ab303741f3d1dca',NULL,NULL),(76,24,'33d2028f1451a4a97a969303564fc2ee',NULL,NULL),(77,24,'c9cf0aeacdd00c2256f00341e60c2943',NULL,NULL),(78,13,'c9cf0aeacdd00c2256f00341e60c2943',NULL,NULL),(79,6,'99e1c1266efbb5a78a0f97175bc647de',NULL,NULL),(80,18,'6a5a3b7489a21079b1898f441d8440fc',NULL,NULL),(81,19,'6a5a3b7489a21079b1898f441d8440fc',NULL,NULL),(82,9,'e6997bdccc60e1590a184fc669c96ccf',NULL,NULL),(83,24,'28f4f369f9c2292c243d9d7ac2155da7',NULL,NULL),(84,9,'81c3bc4a014a531cbac10ef8b368d042',NULL,NULL),(85,18,'81c3bc4a014a531cbac10ef8b368d042',NULL,NULL),(86,13,'81c3bc4a014a531cbac10ef8b368d042',NULL,NULL),(87,17,'81c3bc4a014a531cbac10ef8b368d042',NULL,NULL),(88,12,'eb691464a93818b5a211350cdf3832be',NULL,NULL),(89,13,'0d1083f9c86064cbe34984b1d99dff44',NULL,NULL),(90,3,'370f0ffeb74b4c4b643003165bf91744',NULL,NULL),(91,13,'370f0ffeb74b4c4b643003165bf91744',NULL,NULL),(92,20,'25748af60d7108792dc046a56a33c477',NULL,NULL),(93,9,'bb555dd2eee088683d60064c9c509264',NULL,NULL),(94,34,'bb555dd2eee088683d60064c9c509264',NULL,NULL),(95,1,'06ed98a7c91b20a317ef22e8661a50c4',NULL,NULL),(96,6,'ae3a2b9e149c6b18aa2aba930f503cce',NULL,NULL),(97,10,'ae3a2b9e149c6b18aa2aba930f503cce',NULL,NULL),(98,18,'67ad2ea38e6e60b842602455303666f8',NULL,NULL),(99,5,'3fd514bbe762489b380de8afb1cc2bad',NULL,NULL),(100,22,'56072ca582b07e7172246abc921e4fc1',NULL,NULL),(101,23,'3ef449c7bc43a6085e8fe696cd34e700',NULL,NULL),(102,14,'3ef449c7bc43a6085e8fe696cd34e700',NULL,NULL),(103,11,'3ef449c7bc43a6085e8fe696cd34e700',NULL,NULL),(104,6,'7b17a199e3bf21ed9533d9685190d9c6',NULL,NULL),(105,5,'6ec9de24a7cef4af15ea339bbd93b05c',NULL,NULL),(106,9,'6ec9de24a7cef4af15ea339bbd93b05c',NULL,NULL),(107,23,'0344e28ea0d7c0382cda921a14a93ccc',NULL,NULL),(108,22,'0344e28ea0d7c0382cda921a14a93ccc',NULL,NULL),(109,13,'0344e28ea0d7c0382cda921a14a93ccc',NULL,NULL),(110,8,'0344e28ea0d7c0382cda921a14a93ccc',NULL,NULL),(111,34,'d5e425c12abc7d8e44d113e0371ef16b',NULL,NULL),(112,10,'d5e425c12abc7d8e44d113e0371ef16b',NULL,NULL),(113,1,'d5e425c12abc7d8e44d113e0371ef16b',NULL,NULL),(114,15,'d5e425c12abc7d8e44d113e0371ef16b',NULL,NULL),(115,16,'c712ed5f5f26ba3595aa693f8f64ecb2',NULL,NULL),(116,18,'c712ed5f5f26ba3595aa693f8f64ecb2',NULL,NULL),(117,5,'a275aeac9f411247cc8f7b444f7d51ba',NULL,NULL),(118,16,'a275aeac9f411247cc8f7b444f7d51ba',NULL,NULL),(119,3,'a275aeac9f411247cc8f7b444f7d51ba',NULL,NULL),(120,6,'a275aeac9f411247cc8f7b444f7d51ba',NULL,NULL),(121,24,'b4006b05cab9495d41157b8d0f4e6f68',NULL,NULL),(122,21,'b4006b05cab9495d41157b8d0f4e6f68',NULL,NULL),(123,5,'6038191f2d3de16dd74c391060b0d7c4',NULL,NULL),(124,20,'f7b8719088dd38053a2b10632375e566',NULL,NULL),(125,12,'f7b8719088dd38053a2b10632375e566',NULL,NULL),(126,1,'e31b977023d89f48ce8608bb7411ad93',NULL,NULL),(127,10,'ea7cee8be429cef65b339715765be68f',NULL,NULL),(128,6,'24a4c772e73859421901eb59a8c7cee2',NULL,NULL),(129,3,'ac7015bda9fa18dd8a0b4b377e740cdd',NULL,NULL),(130,6,'0ebe9d3f1ce1fcb758fc3226852128b7',NULL,NULL),(131,8,'a68a25af1f462e3c183b5a71c16126eb',NULL,NULL),(132,8,'879dd15bbdd58cbe1b1ab2f580f83390',NULL,NULL),(133,9,'879dd15bbdd58cbe1b1ab2f580f83390',NULL,NULL),(134,7,'879dd15bbdd58cbe1b1ab2f580f83390',NULL,NULL),(135,11,'879dd15bbdd58cbe1b1ab2f580f83390',NULL,NULL),(136,12,'879dd15bbdd58cbe1b1ab2f580f83390',NULL,NULL),(137,13,'879dd15bbdd58cbe1b1ab2f580f83390',NULL,NULL),(138,10,'879dd15bbdd58cbe1b1ab2f580f83390',NULL,NULL),(139,5,'1d339e13e71e8bfc46a88347dc5975c0',NULL,NULL),(140,13,'1d339e13e71e8bfc46a88347dc5975c0',NULL,NULL),(141,12,'1d339e13e71e8bfc46a88347dc5975c0',NULL,NULL),(142,3,'1d339e13e71e8bfc46a88347dc5975c0',NULL,NULL),(143,10,'c2440ca743e2ab4915bc924f65b65a8b',NULL,NULL),(144,5,'add12090120a717a2d8707310d0fb1f0',NULL,NULL),(145,16,'add12090120a717a2d8707310d0fb1f0',NULL,NULL),(146,8,'add12090120a717a2d8707310d0fb1f0',NULL,NULL),(147,9,'add12090120a717a2d8707310d0fb1f0',NULL,NULL),(148,10,'add12090120a717a2d8707310d0fb1f0',NULL,NULL),(149,11,'add12090120a717a2d8707310d0fb1f0',NULL,NULL),(150,12,'add12090120a717a2d8707310d0fb1f0',NULL,NULL),(151,7,'405b95cdf2abdd6bd7a338e5a8008253',NULL,NULL),(152,12,'405b95cdf2abdd6bd7a338e5a8008253',NULL,NULL),(153,8,'ce02d823a9016a4c433e48177e905598',NULL,NULL),(154,8,'55064242a2c8c71d47f4dd502ce63e98',NULL,NULL);
/*!40000 ALTER TABLE `recently_viewed_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refund_images`
--

DROP TABLE IF EXISTS `refund_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `refund_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `refund_id` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refund_images`
--

LOCK TABLES `refund_images` WRITE;
/*!40000 ALTER TABLE `refund_images` DISABLE KEYS */;
INSERT INTO `refund_images` VALUES (1,12,'faullty-4-72792.jpeg','2024-08-03 13:03:54','2024-08-03 13:03:54'),(2,13,'459166238_536706665391239_783580482725350570_n-72410.png','2025-01-29 06:06:48','2025-01-29 06:06:48'),(3,14,'459166238_536706665391239_783580482725350570_n-75088.png','2025-01-29 06:39:23','2025-01-29 06:39:23'),(4,15,'459166238_536706665391239_783580482725350570_n-68374.png','2025-01-29 07:37:25','2025-01-29 07:37:25'),(5,16,'459166238_536706665391239_783580482725350570_n-81699.png','2025-01-29 07:54:23','2025-01-29 07:54:23'),(6,17,'459166238_536706665391239_783580482725350570_n-30592.png','2025-01-29 08:15:06','2025-01-29 08:15:06');
/*!40000 ALTER TABLE `refund_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refunds`
--

DROP TABLE IF EXISTS `refunds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `refunds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `orders_product_id` int NOT NULL,
  `paymongo_refund_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymongo_response` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refunds`
--

LOCK TABLES `refunds` WRITE;
/*!40000 ALTER TABLE `refunds` DISABLE KEYS */;
INSERT INTO `refunds` VALUES (1,9,6,NULL,'6',14399.10,'Pending Refund','nothing',NULL,'2024-06-30 02:28:13','2024-06-30 02:28:13'),(2,10,8,NULL,'7',79.91,'Pending Refund','something is wrong with my item',NULL,'2024-07-11 13:06:26','2024-07-11 13:06:26'),(3,11,9,NULL,'8',79.91,'Pending Refund','test',NULL,'2024-07-11 13:14:17','2024-07-11 13:14:17'),(12,16,14,NULL,'13',34.94,'Pending Refund','reason',NULL,'2024-08-03 13:03:53','2024-08-03 13:03:53'),(13,22,20,NULL,'19',29.95,'Pending Refund','testing',NULL,'2025-01-29 06:06:46','2025-01-29 06:06:46'),(15,17,15,NULL,'14',1298.69,'Pending Refund','test',NULL,'2025-01-29 07:37:24','2025-01-29 07:37:24'),(16,15,13,NULL,'12',79.91,'Pending Refund','test',NULL,'2025-01-29 07:54:23','2025-01-29 07:54:23'),(17,14,12,NULL,'11',79.91,'Pending Refund','test',NULL,'2025-01-29 08:15:05','2025-01-29 08:15:05');
/*!40000 ALTER TABLE `refunds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sections` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'Clothing',1,NULL,NULL),(2,'Electronics',1,NULL,NULL),(3,'Home and Living',1,NULL,'2024-01-11 12:38:43'),(4,'Food and Cosmetics',1,'2024-01-11 12:39:08','2024-01-11 12:39:08'),(5,'Toys and Games',1,'2024-01-11 12:41:31','2024-01-11 12:41:31'),(6,'Pet',1,'2024-01-11 12:41:55','2024-01-11 12:41:55'),(7,'General Merchandise',1,'2024-01-11 12:42:11','2024-01-11 12:42:11');
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shipping_charges`
--

DROP TABLE IF EXISTS `shipping_charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shipping_charges` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `0_500g` double(8,2) NOT NULL,
  `501g_1000g` double(8,2) NOT NULL,
  `1001_2000g` double(8,2) NOT NULL,
  `2001g_5000g` double(8,2) NOT NULL,
  `above_5000g` double(8,2) NOT NULL,
  `status` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shipping_charges`
--

LOCK TABLES `shipping_charges` WRITE;
/*!40000 ALTER TABLE `shipping_charges` DISABLE KEYS */;
INSERT INTO `shipping_charges` VALUES (1,'Philippines',0.00,5.00,20.00,20.00,20.00,1,'2024-01-27 13:41:36','2024-01-27 13:55:52');
/*!40000 ALTER TABLE `shipping_charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `themes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `primary` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secondary` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tertiary` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `navigation` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `navigation_bar` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `success` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warning` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `error` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `themes`
--

LOCK TABLES `themes` WRITE;
/*!40000 ALTER TABLE `themes` DISABLE KEYS */;
/*!40000 ALTER TABLE `themes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trusted_by`
--

DROP TABLE IF EXISTS `trusted_by`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trusted_by` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trusted_by`
--

LOCK TABLES `trusted_by` WRITE;
/*!40000 ALTER TABLE `trusted_by` DISABLE KEYS */;
INSERT INTO `trusted_by` VALUES (3,'53356.png','2024-07-15 14:16:34','2024-07-15 14:16:34'),(4,'18393.jpg','2024-07-24 01:14:38','2024-07-24 01:14:38'),(5,'74529.png','2024-07-24 01:16:41','2024-07-24 01:16:41'),(6,'64255.jpg','2024-07-24 01:18:19','2024-07-24 01:18:19');
/*!40000 ALTER TABLE `trusted_by` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,'Kenneth','Mendoza','#407 sesame street','Makati','Metro Manila','Philippines','3037','+639256398659','mytestuser@test.com','2024-01-08 20:41:38','$2y$10$3t0zmZqvAYkKlsnbYJ5HQeSevK4wklrfzst65hSFn1C1ZTbgoMAIG',1,NULL,NULL,'2024-01-08 12:38:24','2024-02-25 00:58:59'),(2,NULL,'User2','Test',NULL,NULL,NULL,NULL,NULL,'+639257398659','mytestuser2@test.com',NULL,'$2y$10$qoUxlXiBaHLrL.iU0xGSheztI.5vUlUTYB37gYWvhfdC.WQ1vnpi2',1,NULL,NULL,'2024-01-08 12:43:23','2024-01-08 12:44:46'),(3,NULL,'User2','Test','#30 Sampaloc St. Blk 98','Mandaluyong','Metro Manila','Philippines','30025','09956321595','mytestuser3@test.com',NULL,'$2y$10$Aq8H2T4AOkzKHgtnH21BpeEBPRoNGuaS7FO7wlK36W6kDEnDxP/rO',1,NULL,NULL,'2024-05-22 12:26:41','2024-12-04 13:16:44'),(4,'100896040778488949571','Ian Kenneth','Mendoza',NULL,NULL,NULL,NULL,NULL,NULL,'otamad231116@gmail.com','2024-06-05 13:55:13','$2y$10$LyvpXuSOtrADTqmcbAmdJukfbxmdYDB9uWH8F7TbZuEtQh6n6mGJe',1,NULL,NULL,'2024-06-05 13:55:13','2024-06-05 13:55:13'),(5,NULL,'John','Doe','Calumpit','Quezon City','Metro Manila','Philippines','10001','09554879653','johndoe@testuser.com',NULL,'$2y$10$cUBDNH5a48fRVQleS/VZ3eh5jWdCHPbSlfgaBHBZEfgMoFfLkm896',1,NULL,NULL,'2024-12-04 13:22:21','2024-12-16 14:08:43'),(6,NULL,'John','Doe',NULL,NULL,NULL,NULL,NULL,'09554879653','johndoe2@testuser.com',NULL,'$2y$10$2GFvfNpWM7DsUVbqtEOnhOhTSn9HaAsQDhQ8LLP048w/szZg036OG',0,NULL,NULL,'2024-12-04 13:25:17','2024-12-04 13:25:17'),(7,NULL,'John','Doe',NULL,NULL,NULL,NULL,NULL,'09574896232','johndoe3@testuser.com',NULL,'$2y$10$It7psQGy4qESnH7o52AhcuVjCP43qg9/EHbMrtdx2ob4oseAHgTtC',0,NULL,NULL,'2024-12-04 13:26:08','2024-12-04 13:26:08'),(8,NULL,'John','Doe',NULL,NULL,NULL,NULL,NULL,'09663215623','johndoe4@testuser.com',NULL,'$2y$10$SFZwOJkgl7CaIaBo78Gjpu6kqWatDY6m/HzzEZL0Q/Vqkaep8XPSW',0,NULL,NULL,'2024-12-04 13:29:55','2024-12-04 13:29:55'),(9,NULL,'Mary','Doe',NULL,NULL,NULL,NULL,NULL,'09789006756','mytestuser5@test.com',NULL,'$2y$10$kf/o.YPFp/qjqSh1HElVXepFIpyYJsA6pC1WNAgUPSkroYVyDwWoK',0,NULL,NULL,'2024-12-09 13:17:59','2024-12-09 13:17:59');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendors` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirm` enum('No','Yes') COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission` double(8,2) DEFAULT NULL,
  `status` tinyint NOT NULL,
  `wdyfu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Where did you find us?',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vendors_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
INSERT INTO `vendors` VALUES (1,'Yasser Fouaad - Vendor','17 El-Salam St.','Maadi','Makati','Philippines','1402','+639559133587','yasser@admin.com','Yes',NULL,1,'',NULL,NULL),(8,'Ian Kenneth Garcia Mendoza','#12 Test Address','Calumpit','Abra','Philippines','3003','+639559113587','ianmendoza02@yahoo.com','No',NULL,0,'','2024-02-06 16:25:53','2024-02-06 16:25:53'),(9,'Ian Kenneth Garcia Mendoza','#12 Test Address','Calumpit','Abra','Philippines','3003','+639559113585','ianmendoza01@yahoo.com','No',NULL,0,'','2024-02-06 16:53:35','2024-02-06 16:53:35'),(10,'Ian Kenneth Garcia Mendoza','#12 Test Address','Calumpit','Abra','Philippines','3003','+639559113589','ianmendoza03@yahoo.com','No',NULL,0,'','2024-02-07 02:53:44','2025-01-16 12:20:26'),(11,'Ian Kenneth Garcia Mendoza','#12 Test Address','Calumpit','Abra','Philippines','3003','+639559113580','ianmendoza04@yahoo.com','No',NULL,0,'','2024-02-07 03:17:06','2025-01-16 12:18:00'),(12,'Ian Kenneth Garcia Mendoza','#12 Test Address','Calumpit','Abra','Philippines','3003','+639559113581','ianmendoza05@yahoo.com','No',NULL,1,'','2024-02-07 03:27:42','2025-01-16 12:13:27'),(13,'Mark Jared Poblete','#12 Test Address','Mandaluyong City','Metro Manila','Philippines','1105','09653265656','mjpoblete@gmail.com','Yes',NULL,1,'','2024-03-15 02:59:33','2024-03-15 01:37:27'),(14,'Mark Lester',NULL,NULL,NULL,NULL,NULL,'096245691515','mark.lester@test.com.ph','No',NULL,0,'Facebook','2024-12-27 21:14:43','2024-12-27 21:14:43');
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors_bank_details`
--

DROP TABLE IF EXISTS `vendors_bank_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendors_bank_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `account_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors_bank_details`
--

LOCK TABLES `vendors_bank_details` WRITE;
/*!40000 ALTER TABLE `vendors_bank_details` DISABLE KEYS */;
INSERT INTO `vendors_bank_details` VALUES (1,1,'John Cena','ICICI','021546545454541545454','36546655',NULL,NULL);
/*!40000 ALTER TABLE `vendors_bank_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors_business_details`
--

DROP TABLE IF EXISTS `vendors_business_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendors_business_details` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int NOT NULL,
  `shop_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `long` double DEFAULT NULL,
  `shop_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_license_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_proof` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_proof_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors_business_details`
--

LOCK TABLES `vendors_business_details` WRITE;
/*!40000 ALTER TABLE `vendors_business_details` DISABLE KEYS */;
INSERT INTO `vendors_business_details` VALUES (1,1,'John Electronics Store','12 Mahmoud Saeed St.','Mandaluyong City','Metro Manila','Philippines','110001',14.6090537,121.0222565,'+639869987109','amazon.com.eg','john@admin.com','78710.png','1234556',NULL,'Passport','',NULL,'2024-10-07 12:31:54'),(6,8,'Motorcycle Shop','#12 Test Address','Calumpit','Abra','Philippines','3003',NULL,NULL,'+639559113585','keyboards.com.ph','ianmendoza02@yahoo.com',NULL,NULL,NULL,NULL,NULL,'2024-02-06 16:25:53','2024-02-06 16:25:53'),(7,9,'Motor Shop','#12 Test Address','Calumpit','Abra','Philippines','3003',NULL,NULL,'+639559113585','keyboards.com.ph','ianmendoza01@yahoo.com',NULL,NULL,NULL,NULL,NULL,'2024-02-06 16:53:35','2024-02-06 16:53:35'),(8,10,'Cellphone Shop','#12 Test Address','Calumpit','Abra','Philippines','3003',NULL,NULL,'+639559113585','cellphones.com.ph','ianmendoza03@yahoo.com',NULL,NULL,NULL,NULL,NULL,'2024-02-07 02:53:44','2024-02-07 02:53:44'),(9,11,'Cellphone 02 Shop','#12 Test Address','Calumpit','Abra','Philippines','3003',NULL,NULL,'+639559113580','cellphones_02.com.ph','ianmendoza04@yahoo.com',NULL,NULL,NULL,NULL,NULL,'2024-02-07 03:17:06','2024-02-07 03:17:06'),(10,12,'Nintendhoe 02 Shop','#12 Test Address','Calumpit','Abra','Philippines','3003',NULL,NULL,'+639559113580','nintendhoe_02.com.ph','ianmendoza05@yahoo.com',NULL,NULL,NULL,NULL,NULL,'2024-02-07 03:27:42','2024-02-07 03:27:42'),(11,13,'Cellphone Range IU','#12 Test Address','Mandaluyong City','Metro Manila','Philippines','1105',14.6090537,121.0222565,'09653265656','cellphonesrange.com.ph','support@cellphonesrange.com.ph',NULL,'6955522333666',NULL,'Passport','36540.png','2024-03-15 08:59:33','2024-06-28 01:07:28'),(12,14,'MMMark',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-12-27 21:14:43','2024-12-27 21:14:43');
/*!40000 ALTER TABLE `vendors_business_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlists`
--

DROP TABLE IF EXISTS `wishlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlists` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `attribute_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attribute_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlists`
--

LOCK TABLES `wishlists` WRITE;
/*!40000 ALTER TABLE `wishlists` DISABLE KEYS */;
INSERT INTO `wishlists` VALUES (2,5,13,NULL,NULL,'2024-12-29 11:20:23','2024-12-29 11:20:23'),(6,5,12,'Green','8','2024-12-29 11:31:31','2024-12-29 11:31:31');
/*!40000 ALTER TABLE `wishlists` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-29 13:47:25
