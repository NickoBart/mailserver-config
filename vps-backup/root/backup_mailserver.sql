-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: mailserver
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.22.04.1

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
-- Table structure for table `buzons`
--

DROP TABLE IF EXISTS `buzons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `buzons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dominio_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `buzons_email_unique` (`email`),
  KEY `buzons_dominio_id_foreign` (`dominio_id`),
  CONSTRAINT `buzons_dominio_id_foreign` FOREIGN KEY (`dominio_id`) REFERENCES `dominios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buzons`
--

LOCK TABLES `buzons` WRITE;
/*!40000 ALTER TABLE `buzons` DISABLE KEYS */;
INSERT INTO `buzons` VALUES (1,'prueba@smartcalling.cl','$2y$12$dRPKWiSLCER8qUhuExGgc.SQowtiqfnbLbHaF60KfvAAr.FF1xhWq',0,'2025-06-03 22:33:00','2025-06-03 22:33:00',NULL);
/*!40000 ALTER TABLE `buzons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_domains`
--

DROP TABLE IF EXISTS `client_domains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_domains` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mx_valid` tinyint(1) NOT NULL DEFAULT '0',
  `mx_message` text COLLATE utf8mb4_unicode_ci,
  `spf_valid` tinyint(1) NOT NULL DEFAULT '0',
  `spf_message` text COLLATE utf8mb4_unicode_ci,
  `dkim_valid` tinyint(1) NOT NULL DEFAULT '0',
  `dkim_message` text COLLATE utf8mb4_unicode_ci,
  `dmarc_valid` tinyint(1) NOT NULL DEFAULT '0',
  `dmarc_message` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `client_domains_domain_unique` (`domain`),
  KEY `client_domains_client_id_foreign` (`client_id`),
  CONSTRAINT `client_domains_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_domains`
--

LOCK TABLES `client_domains` WRITE;
/*!40000 ALTER TABLE `client_domains` DISABLE KEYS */;
INSERT INTO `client_domains` VALUES (1,22,'https://fijodigital.cl',1,'2025-05-22 21:11:22','2025-05-22 22:30:47',1,'MX apuntando a: mail.fijodigital.cl',1,'v=spf1 mx ~all',1,'v=DKIM1; h=sha256; k=rsa; p=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAni86rLA5tJsb8FAUpxs6cPSyqK35MBdKtZJDEGiOtGhLQiFIr5MtVlcqBGQ+8hkgN3DIyQjjaXomtfgenJoOaKtbuhK0MhSMPVAaqIbXxD80CExYShtFux09i2BGytOUaqSg93l4kzvRjWId0fB1G68ABJGsGOpK5rAjWM2w8tcSnkde/rGb9ut7+kjOhrHEHhgdjVYDkmy4WhNCefCK3/aAN4YpEz6YPd8eduKs+thGybXn6YEVvW9iG/27UY1rQNjYfljg6s3/ofHogrFCKKRfNvhFPxB2JKfIQLMDyPQ9nLRzgHeCYjdvm6UdNhAb4h2mCzpvgszN1bz4CjBqjQIDAQAB',1,'v=DMARC1; p=none; rua=mailto:postmaster@fijodigital.cl; pct=100'),(3,29,'connectia.info',1,'2025-05-28 00:39:57','2025-05-28 00:54:27',0,NULL,0,NULL,0,NULL,0,NULL),(4,30,'smartcalling.cl',1,'2025-05-28 01:10:55','2025-05-28 20:09:50',1,'MX apuntando a: mail.smartcalling.cl',1,'v=spf1 +a +mx +ip4:200.24.13.56 +ip4:200.24.13.57 include:spf.sinc.cl ~all',1,'v=DKIM1; k=rsa; p=MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAv+/o+TDO6tDQHTFh54Mtq72XscSzi0dIAx/8CGRh9Cnq+aHPWr3tgZbYwZHKI+/0e4v3DFokoI45eUTGdb3qKsBmeNovWxiwkceAXOjAW3gC7tvYJSaI+aHsX1F9FMnG0AjOJdq1a2B1KY6LHdIx6CtVe8vcAt0LEwJvMAceGA7gbIXfp0x5XmZ0zkvWjUDXnqkcg670CKEywjZvSKtLM4Re2SdQYp84ocC3OHb+oKskd3kaKD4DxfsID/ghhcXIM+Z3v6xkj3kAn6K/8TjzlgGD7Eec/XwEr+iNVlclGiD8Igikm0brYQXCkO0brHVHjYzHzd7LgEPVNDH1Q+y/HQIDAQAB;',1,'v=DMARC1; p=none; rua=mailto:soporte@connectia.info; pct=100;');
/*!40000 ALTER TABLE `client_domains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_logins`
--

DROP TABLE IF EXISTS `client_logins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `client_logins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_domain_id` bigint unsigned NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `maildir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_logins_client_domain_id_foreign` (`client_domain_id`),
  CONSTRAINT `client_logins_client_domain_id_foreign` FOREIGN KEY (`client_domain_id`) REFERENCES `client_domains` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_logins`
--

LOCK TABLES `client_logins` WRITE;
/*!40000 ALTER TABLE `client_logins` DISABLE KEYS */;
INSERT INTO `client_logins` VALUES (1,1,'agustin.donoso@fijodigital.cl',NULL,'fijodigital.cl/agustin.donoso/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(2,1,'ambar.monsalve@fijodigital.cl',NULL,'fijodigital.cl/ambar.monsalve/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(3,1,'angelica.trujillo@fijodigital.cl',NULL,'fijodigital.cl/angelica.trujillo/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(4,1,'aurora.fuentes@fijodigital.cl',NULL,'fijodigital.cl/aurora.fuentes/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(5,1,'bryan.astudillo@fijodigital.cl',NULL,'fijodigital.cl/bryan.astudillo/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(6,1,'carla.sequeida@fijodigital.cl',NULL,'fijodigital.cl/carla.sequeida/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(7,1,'carolina.tapia@fijodigital.cl',NULL,'fijodigital.cl/carolina.tapia/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(8,1,'danitza.toledo@fijodigital.cl',NULL,'fijodigital.cl/danitza.toledo/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(9,1,'david.aguilera@fijodigital.cl',NULL,'fijodigital.cl/david.aguilera/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(10,1,'diego.yanez@fijodigital.cl',NULL,'fijodigital.cl/diego.yanez/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(11,1,'eloisa.mella@fijodigital.cl',NULL,'fijodigital.cl/eloisa.mella/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(12,1,'gaston.vilches@fijodigital.cl',NULL,'fijodigital.cl/gaston.vilches/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(13,1,'hugo.herrera@fijodigital.cl',NULL,'fijodigital.cl/hugo.herrera/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(14,1,'iris.llanos@fijodigital.cl',NULL,'fijodigital.cl/iris.llanos/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(15,1,'jessica.meneses@fijodigital.cl',NULL,'fijodigital.cl/jessica.meneses/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(16,1,'jorge.gamboa@fijodigital.cl',NULL,'fijodigital.cl/jorge.gamboa/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(17,1,'luis.melo@fijodigital.cl',NULL,'fijodigital.cl/luis.melo/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(18,1,'luis.sequeida@fijodigital.cl',NULL,'fijodigital.cl/luis.sequeida/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(19,1,'marcelo.avendano@fijodigital.cl',NULL,'fijodigital.cl/marcelo.avendano/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(20,1,'martin.candia@fijodigital.cl',NULL,'fijodigital.cl/martin.candia/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(21,1,'maura.arrigada@fijodigital.cl',NULL,'fijodigital.cl/maura.arrigada/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(22,1,'nataly.donoso@fijodigital.cl',NULL,'fijodigital.cl/nataly.donoso/','2025-05-22 21:50:32','2025-05-22 21:50:32'),(23,1,'patricio.astudillo@fijodigital.cl',NULL,'fijodigital.cl/patricio.astudillo/','2025-05-22 21:50:33','2025-05-22 21:50:33'),(24,1,'ruth.paredes@fijodigital.cl',NULL,'fijodigital.cl/ruth.paredes/','2025-05-22 21:50:33','2025-05-22 21:50:33'),(25,1,'saida.velez@fijodigital.cl',NULL,'fijodigital.cl/saida.velez/','2025-05-22 21:50:33','2025-05-22 21:50:33'),(26,1,'sebastian.saavedra@fijodigital.cl',NULL,'fijodigital.cl/sebastian.saavedra/','2025-05-22 21:50:33','2025-05-22 21:50:33'),(27,1,'valentina.arriagada@fijodigital.cl',NULL,'fijodigital.cl/valentina.arriagada/','2025-05-22 21:50:33','2025-05-22 21:50:33'),(28,1,'ximena.munoz@fijodigital.cl',NULL,'fijodigital.cl/ximena.munoz/','2025-05-22 21:50:33','2025-05-22 21:50:33'),(29,1,'yenni.orellana@fijodigital.cl',NULL,'fijodigital.cl/yenni.orellana/','2025-05-22 21:50:33','2025-05-22 21:50:33'),(32,4,'carolina.tapia@smartcalling.cl','$2y$12$gV.Jf5W0PmaXGaUKMs2uhOYNOPb5pkElofwhOdX8gFqhHPOgRbuWi',NULL,'2025-06-04 02:24:35','2025-06-04 02:24:35');
/*!40000 ALTER TABLE `client_logins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (22,'Admin FijoDigital','admin@fijodigital.cl','$2y$12$vNuXBCDDkNCDzSf7y9MH0udZxz3iB74Ijo0HSjk0tCUcTlNFE1o7.',NULL,'2025-05-22 20:53:49','2025-05-22 21:55:26'),(23,'Admin Connectia','admin@connectia.info','$2y$12$MQpLcQj2pli//SxGK6.ot.gVBI2Kf.9RaXLaoVb9J9iDVYwUPCLGu',NULL,'2025-05-22 21:05:08','2025-05-28 00:57:53'),(28,'dominio.prueba','test@prueba.cl','$2y$12$BC9oVWXvYvfj6d3BQDpPquKqzDVvTtylTTYQTgUP2PzXx65OwW4Xu',NULL,'2025-05-23 02:52:19','2025-05-23 02:52:19'),(29,'Nickolas Donoso','donosonickolas@gmail.com','$2y$12$d2w3hD2sFf.gtBjkeRktneUDJfflTEvsMZ0Xpzw1tqN4Xcn/qVAnC',NULL,'2025-05-28 00:28:02','2025-05-28 00:54:27'),(30,'Mario Yañez','mario.yanez@smartcalling.cl','$2y$12$/kA8rkggWICokm5k1sJUW.vYWvz9YsO2j7rt868qsVn/5tTHZc3ba',NULL,'2025-05-28 01:10:54','2025-05-28 02:07:34');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dominios`
--

DROP TABLE IF EXISTS `dominios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dominios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valido` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dominios_nombre_unique` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dominios`
--

LOCK TABLES `dominios` WRITE;
/*!40000 ALTER TABLE `dominios` DISABLE KEYS */;
/*!40000 ALTER TABLE `dominios` ENABLE KEYS */;
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
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB AUTO_INCREMENT=333 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2025_05_12_173311_create_clients_table',1),(6,'2025_05_12_173336_create_client_domains_table',1),(7,'2025_05_12_205908_create_client_logins_table',1),(8,'2025_05_13_200204_create_jobs_table',1),(9,'2025_05_19_173222_add_dns_checks_to_client_domains',1),(10,'2025_05_19_182538_alter_client_domains_dns_message_columns',1),(11,'2025_05_19_191359_create_subscriptions_table',1),(12,'2025_05_20_173524_add_mercadopago_fields_to_subscriptions_table',1),(13,'2025_05_21_230141_add_expires_at_to_subscriptions_table',1),(14,'2025_05_22_045825_add_plan_name_to_subscriptions_table',1),(15,'2025_05_22_162230_add_fields_to_client_logins_table',2),(16,'2025_05_26_202222_create_plans_table',3),(17,'2025_05_26_203404_add_plan_id_to_subscriptions_table',4),(18,'2025_05_27_145940_add_billing_and_invoice_fields_to_subscriptions_table',5),(19,'2025_05_27_160345_add_period_to_subscriptions_table',6),(20,'2025_06_03_044658_create_buzons_table',7),(21,'2025_06_03_044659_create_dominios_table',7),(22,'2025_06_03_174902_add_dominio_id_to_buzons_table',8),(23,'2025_06_03_211204_add_password_to_client_logins_table',9);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

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

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
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
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `plans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_usd` decimal(8,2) NOT NULL,
  `mailbox_space_gb` int NOT NULL,
  `domain_limit` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `plans_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (1,'pro','Plan Pro',2.00,1,1,'2025-05-27 01:42:58','2025-05-27 01:42:58');
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preference_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `init_point` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','active','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `expires_at` timestamp NULL DEFAULT NULL,
  `plan_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_id` bigint unsigned DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `billing_day` int NOT NULL DEFAULT '1',
  `period` enum('monthly','annual') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'annual',
  `razon_social` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ciudad_region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `giro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscriptions_plan_id_foreign` (`plan_id`),
  CONSTRAINT `subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (4,'Mario Yañez','ndonoso.partner7@gmail.com','smartcalling.cl',NULL,NULL,'pending',NULL,NULL,NULL,1,1,'annual','','','','','',NULL,NULL,'2025-05-27 00:45:58','2025-05-27 00:45:58'),(5,'Mario Yañez','ndonoso.partner7@gmail.com','smartcalling.cl',NULL,NULL,'pending',NULL,NULL,NULL,1,1,'annual','','','','','',NULL,NULL,'2025-05-27 02:25:48','2025-05-27 02:25:48'),(6,'Mario Yañez','ndonoso.partner7@gmail.com','smartcalling.cl',NULL,NULL,'pending',NULL,NULL,1,1,1,'annual','','','','','',NULL,NULL,'2025-05-27 02:31:16','2025-05-27 02:31:16'),(7,'Mario Yañez','ndonoso.partner7@gmail.com','smartcalling.cl','278577076-380e682d-0afa-49e8-8d71-c1b4413e5faf','https://www.mercadopago.cl/checkout/v1/redirect?pref_id=278577076-380e682d-0afa-49e8-8d71-c1b4413e5faf','pending',NULL,NULL,1,1,1,'annual','','','','','',NULL,NULL,'2025-05-27 02:37:32','2025-05-27 02:37:32'),(8,'Mario Yañez','donosonickolas@gmail.com','smartcalling.cl','278577076-b1e5947a-ece8-4906-b9f8-ffcd23e69ec9','https://www.mercadopago.cl/checkout/v1/redirect?pref_id=278577076-b1e5947a-ece8-4906-b9f8-ffcd23e69ec9','pending',NULL,NULL,1,1,1,'annual','','','','','',NULL,NULL,'2025-05-27 02:38:02','2025-05-27 02:38:02'),(9,'Mario Yañez','donosonickolas@gmail.com','smartcalling.cl','278577076-8af5c651-4f09-450d-a8b5-4b823b102143','https://www.mercadopago.cl/checkout/v1/redirect?pref_id=278577076-8af5c651-4f09-450d-a8b5-4b823b102143','pending',NULL,NULL,1,2,5,'annual','smartcalling','76518764-8','kjshdfsh','santiago','telecominsodfi','ndonoso.ksdf@gmail.com','940918759','2025-05-27 20:53:03','2025-05-27 20:53:04'),(10,'mario','mario@gmail.com','smartcalling.cl','278577076-eba39a2d-b7a9-4945-949a-339acff4d17e','https://www.mercadopago.cl/checkout/v1/redirect?pref_id=278577076-eba39a2d-b7a9-4945-949a-339acff4d17e','pending',NULL,NULL,1,5,5,'annual','smartcalling','765187648','sdfasdf','santiago','telecominsodfi','ndonoso.ksdf@gmail.com','940918758','2025-05-27 20:53:50','2025-05-27 20:53:51'),(11,'mario','mario@gmail.com','smartcalling.cl','278577076-11e75e37-5005-45df-834f-6072bfcb094a','https://www.mercadopago.cl/checkout/v1/redirect?pref_id=278577076-11e75e37-5005-45df-834f-6072bfcb094a','pending',NULL,NULL,1,5,5,'annual','smartcalling','765187648','sdfasdf','santiago','telecominsodfi','ndonoso.ksdf@gmail.com','940918758','2025-05-27 20:55:27','2025-05-27 20:55:28'),(12,'mario','mario@gmail.com','smartcalling.cl','278577076-676f17d0-c0f7-48ac-bbbf-075d5ce22f5e','https://www.mercadopago.cl/checkout/v1/redirect?pref_id=278577076-676f17d0-c0f7-48ac-bbbf-075d5ce22f5e','pending',NULL,NULL,1,5,5,'annual','smartcalling','765187648','sdfasdf','santiago','telecominsodfi','ndonoso.ksdf@gmail.com','940918758','2025-05-27 21:00:16','2025-05-27 21:00:17'),(13,'Mario Yañez','donosonickolas@gmail.com','smartcalling.cl','278577076-7ff74b4d-70c6-4402-8b9f-9995b308496f','https://www.mercadopago.cl/checkout/v1/redirect?pref_id=278577076-7ff74b4d-70c6-4402-8b9f-9995b308496f','pending',NULL,NULL,1,5,3,'annual','smartcalling','18.246.809-6','Ramon Salas Edward','Renca','telecominsodfi','ndonoso.ksdf@gmail.com','940918757','2025-05-27 21:22:26','2025-05-27 21:22:26'),(14,'mario','donosonickolas@gmail.com','smartcalling.cl','278577076-ad1f1521-a666-4be0-8f34-a74b70d77aa4','https://www.mercadopago.cl/checkout/v1/redirect?pref_id=278577076-ad1f1521-a666-4be0-8f34-a74b70d77aa4','pending',NULL,NULL,1,5,5,'annual','smartcalling','18.407.316-1','Ramon Salas Edward','Renca','telecominsodfi','ndonoso.ksdf@gmail.com','940918758','2025-05-27 21:59:43','2025-05-27 21:59:44'),(15,'mario','donosonickolas@gmail.com','smartcalling.cl','278577076-b2fc1f48-d52c-4041-ace6-e50f0cbb99a1','https://www.mercadopago.cl/checkout/v1/redirect?pref_id=278577076-b2fc1f48-d52c-4041-ace6-e50f0cbb99a1','pending',NULL,NULL,1,5,10,'annual','smartcalling','18.407.316-1','Ramon Salas Edward','Renca','telecominsodfi','ndonoso.ksdf@gmail.com','940918758','2025-05-27 22:00:13','2025-05-27 22:00:13'),(16,'mario','donosonickolas@gmail.com','smartcalling.cl','278577076-93e63ad3-56fc-42e5-9533-c01b61ddbc86','https://www.mercadopago.cl/checkout/v1/redirect?pref_id=278577076-93e63ad3-56fc-42e5-9533-c01b61ddbc86','pending',NULL,NULL,1,5,10,'annual','smartcalling','18.407.316-1','Ramon Salas Edward','Renca','telecominsodfi','ndonoso.ksdf@gmail.com','940918758','2025-05-27 22:51:42','2025-05-27 22:51:43'),(17,'Nickolas Donoso','donosonickolas@gmail.com','connectia.info',NULL,NULL,'pending',NULL,NULL,NULL,1,1,'annual','connectia.info','184073161','Avenida casa de Piedra 103','Colina','Servicios Informáticos','donosonickolas@gmail.com','940918759','2025-05-27 22:58:26','2025-05-27 22:58:26'),(18,'Nickolas','donosonickolas@gmail.com','connectia.info',NULL,NULL,'pending',NULL,NULL,NULL,1,2,'annual','connectia','18.407.316-1','Avenida Casa de Piedra 103','Colina','Servicios Informáticos','donosonickolas@gmail.com','940918759','2025-05-27 23:00:33','2025-05-27 23:00:33'),(19,'Nickolas Donoso','donosonickolas@gmail.com','connectia.info','278577076-9a24bc34-9b87-4f56-b745-cb82d6f33774','https://www.mercadopago.cl/checkout/v1/redirect?pref_id=278577076-9a24bc34-9b87-4f56-b745-cb82d6f33774','pending',NULL,NULL,1,1,1,'annual','Connectia Mail','184073161','Avenida casa de piedra 103','Colina','Servicios Informáticos','donosonickolas@gmail.com','940918759','2025-05-27 23:02:54','2025-05-27 23:02:55'),(20,'Nickolas Donoso','donosonickolas@gmail.com','connectia.info','278577076-7667ec21-6514-43f2-a07d-2db9b4064a61','https://www.mercadopago.cl/checkout/v1/redirect?pref_id=278577076-7667ec21-6514-43f2-a07d-2db9b4064a61','active','2025-06-28 00:54:26',NULL,1,1,1,'annual','Connectia Mail','184073161','Avenida casa de piedra 103','Colina','Servicios Informáticos','donosonickolas@gmail.com','940918759','2025-05-28 00:04:46','2025-05-28 00:54:26'),(21,'Mario Yañez','mario.yanez@smartcalling.cl','smartcalling.cl','278577076-a0a60dcf-4748-4a63-8c43-25973d4ef60d','https://www.mercadopago.cl/checkout/v1/redirect?pref_id=278577076-a0a60dcf-4748-4a63-8c43-25973d4ef60d','active','2025-06-28 02:07:33',NULL,1,4,5,'annual','Smarcalling SpA','78055609-9','Puerta Oriente 361 of 307','colina','CallCenter','mmyd9781@hotmail.com','975583932','2025-05-28 00:13:26','2025-05-28 02:07:33');
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (22,'Admin FijoDigital','admin@fijodigital.cl',NULL,'$2y$12$7H1wJG0fw2n6oz.WRpd5Hux05UnzqfYHPlqQvXAQg5S4jl2xFc1iy','GTbGNL4gSvv8QemLmlRroCsogyvuYvzpT1NM0bwwydvf0ypOVRaNdqroti0z','2025-05-22 20:53:49','2025-05-22 21:34:40'),(23,'Admin Connectia','admin@connectia.info',NULL,'$2y$12$E6KkJRue1KTqdTLCKrd64uVD89Zu1XAV3HEMn2i7FPYSiwbVy6X42','btkwMJoRrUKuohUMlNgrwAzBFVL49RKxrU99W8m0bSRBjfNrY7xkBk8YFaiN','2025-05-22 21:05:08','2025-05-28 01:00:10'),(24,'Mario Yañez','mario.yanez@smartcalling.cl',NULL,'$2y$12$IUfrkQd1XoI/rJLhCon0y.36br3ZK1ngmEo0L1FfPb84wVw/X9qQK',NULL,'2025-05-28 01:10:55','2025-05-28 01:27:06'),(25,'Mario Yañez','admin@smartcalling.cl',NULL,'$2y$12$8O7OO35TA5uW8ZVTDZ/mO.gkk8kWsb6PHLPftdkqB1Jqxi7ffCBdi','RMixjj3gNVaeRp4xH7j93Iu5X8IdV34jHU2b6UHPr10GoF4yFLR2l7hDvnbk','2025-05-28 01:21:44','2025-05-28 02:09:32');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-03 22:24:15
