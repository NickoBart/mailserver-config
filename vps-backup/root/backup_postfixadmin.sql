-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: postfixadmin
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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `superadmin` tinyint(1) NOT NULL DEFAULT '0',
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `email_other` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `token_validity` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `totp_secret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Postfix Admin - Virtual Admins';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('admin@connectia.info','$2y$10$0a5f061eb39f3d6a11378uoLr2vOnAkaX508JKCbSt/wLcZvr/UU.','2025-05-12 15:42:40','2025-05-12 15:42:40',1,1,'','','','2025-05-12 15:42:40',NULL);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alias`
--

DROP TABLE IF EXISTS `alias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alias` (
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `goto` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `domain` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`address`),
  KEY `domain` (`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Postfix Admin - Virtual Aliases';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alias`
--

LOCK TABLES `alias` WRITE;
/*!40000 ALTER TABLE `alias` DISABLE KEYS */;
/*!40000 ALTER TABLE `alias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alias_domain`
--

DROP TABLE IF EXISTS `alias_domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alias_domain` (
  `alias_domain` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `target_domain` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`alias_domain`),
  KEY `active` (`active`),
  KEY `target_domain` (`target_domain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Postfix Admin - Domain Aliases';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alias_domain`
--

LOCK TABLES `alias_domain` WRITE;
/*!40000 ALTER TABLE `alias_domain` DISABLE KEYS */;
/*!40000 ALTER TABLE `alias_domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `config` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `value` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='PostfixAdmin settings';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'version','1850');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dkim`
--

DROP TABLE IF EXISTS `dkim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dkim` (
  `id` int NOT NULL AUTO_INCREMENT,
  `domain_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(255) COLLATE latin1_general_ci DEFAULT '',
  `selector` varchar(63) COLLATE latin1_general_ci NOT NULL DEFAULT 'default',
  `private_key` text COLLATE latin1_general_ci,
  `public_key` text COLLATE latin1_general_ci,
  `created` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `domain_name` (`domain_name`,`description`),
  CONSTRAINT `dkim_ibfk_1` FOREIGN KEY (`domain_name`) REFERENCES `domain` (`domain`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Postfix Admin - OpenDKIM Key Table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dkim`
--

LOCK TABLES `dkim` WRITE;
/*!40000 ALTER TABLE `dkim` DISABLE KEYS */;
/*!40000 ALTER TABLE `dkim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dkim_signing`
--

DROP TABLE IF EXISTS `dkim_signing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dkim_signing` (
  `id` int NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dkim_id` int NOT NULL,
  `created` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  KEY `dkim_id` (`dkim_id`),
  CONSTRAINT `dkim_signing_ibfk_1` FOREIGN KEY (`dkim_id`) REFERENCES `dkim` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Postfix Admin - OpenDKIM Signing Table';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dkim_signing`
--

LOCK TABLES `dkim_signing` WRITE;
/*!40000 ALTER TABLE `dkim_signing` DISABLE KEYS */;
/*!40000 ALTER TABLE `dkim_signing` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domain`
--

DROP TABLE IF EXISTS `domain`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domain` (
  `domain` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `aliases` int NOT NULL DEFAULT '0',
  `mailboxes` int NOT NULL DEFAULT '0',
  `maxquota` bigint NOT NULL DEFAULT '0',
  `quota` bigint NOT NULL DEFAULT '0',
  `transport` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `backupmx` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `password_expiry` int DEFAULT '0',
  PRIMARY KEY (`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Postfix Admin - Virtual Domains';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domain`
--

LOCK TABLES `domain` WRITE;
/*!40000 ALTER TABLE `domain` DISABLE KEYS */;
INSERT INTO `domain` VALUES ('ALL','',0,0,0,0,'',0,'2025-05-12 15:39:47','2025-05-12 15:39:47',1,0),('fijodigital.cl','',0,1,0,0,'virtual',0,'2025-05-13 23:05:28','2025-05-13 23:05:28',1,0),('smartcalling.cl','',0,4,4096,1024,'virtual',0,'2025-05-29 11:02:41','2025-05-29 11:02:41',1,0);
/*!40000 ALTER TABLE `domain` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domain_admins`
--

DROP TABLE IF EXISTS `domain_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `domain_admins` (
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `domain` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Postfix Admin - Domain Admins';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domain_admins`
--

LOCK TABLES `domain_admins` WRITE;
/*!40000 ALTER TABLE `domain_admins` DISABLE KEYS */;
INSERT INTO `domain_admins` VALUES ('admin@connectia.info','ALL','2025-05-12 15:42:40',1,1);
/*!40000 ALTER TABLE `domain_admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fetchmail`
--

DROP TABLE IF EXISTS `fetchmail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fetchmail` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `mailbox` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `src_server` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `src_auth` enum('password','kerberos_v5','kerberos','kerberos_v4','gssapi','cram-md5','otp','ntlm','msn','ssh','any') CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `src_user` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `src_password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `src_folder` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `poll_time` int unsigned NOT NULL DEFAULT '10',
  `fetchall` tinyint unsigned NOT NULL DEFAULT '0',
  `keep` tinyint unsigned NOT NULL DEFAULT '0',
  `protocol` enum('POP3','IMAP','POP2','ETRN','AUTO') CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `usessl` tinyint unsigned NOT NULL DEFAULT '0',
  `extra_options` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `returned_text` text CHARACTER SET latin1 COLLATE latin1_general_ci,
  `mda` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT '2000-01-01 06:00:00',
  `sslcertck` tinyint(1) NOT NULL DEFAULT '0',
  `sslcertpath` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '',
  `sslfingerprint` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT '',
  `domain` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT '2000-01-01 06:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `src_port` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fetchmail`
--

LOCK TABLES `fetchmail` WRITE;
/*!40000 ALTER TABLE `fetchmail` DISABLE KEYS */;
/*!40000 ALTER TABLE `fetchmail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log` (
  `timestamp` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `domain` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `action` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `data` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `timestamp` (`timestamp`),
  KEY `domain_timestamp` (`domain`,`timestamp`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Postfix Admin - Log';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES ('2025-05-12 15:42:40','SETUP.PHP (181.212.153.194)','','create_admin','admin@connectia.info',1);
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mailbox`
--

DROP TABLE IF EXISTS `mailbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mailbox` (
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `maildir` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `quota` bigint NOT NULL DEFAULT '0',
  `local_part` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `domain` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `modified` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `email_other` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `token_validity` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `password_expiry` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `totp_secret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `smtp_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`username`),
  KEY `domain` (`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Postfix Admin - Virtual Mailboxes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mailbox`
--

LOCK TABLES `mailbox` WRITE;
/*!40000 ALTER TABLE `mailbox` DISABLE KEYS */;
INSERT INTO `mailbox` VALUES ('abraham.donoso@smartcalling.cl','{MD5}c8d7979eac5f57474d548ac81064518e','abraham.donoso','smartcalling.cl/abraham.donoso/',1024,'abraham.donoso','smartcalling.cl','2025-05-28 20:25:45','2025-05-28 20:25:45',1,'','','','2000-01-01 00:00:00','2000-01-01 00:00:00',NULL,1),('agustin.donoso@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','agustin.donoso','fijodigital.cl/agustin.donoso/',500,'agustin.donoso','fijodigital.cl','2025-05-19 13:46:32','2025-05-19 13:46:32',1,'','','','2025-05-19 13:46:32','2025-05-19 13:46:32',NULL,1),('ambar.monsalve@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','ambar.monsalve','fijodigital.cl/ambar.monsalve/',500,'ambar.monsalve','fijodigital.cl','2025-05-19 13:41:44','2025-05-19 13:41:44',1,'','','','2025-05-19 13:41:44','2025-05-19 13:41:44',NULL,1),('angelica.trujillo@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','angelica.trujillo','fijodigital.cl/angelica.trujillo/',500,'angelica.trujillo','fijodigital.cl','2025-05-19 13:46:13','2025-05-19 13:46:13',1,'','','','2025-05-19 13:46:13','2025-05-19 13:46:13',NULL,1),('aurora.fuentes@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','aurora.fuentes','fijodigital.cl/aurora.fuentes/',500,'aurora.fuentes','fijodigital.cl','2025-05-22 02:18:03','2025-05-22 02:18:03',1,'','','','2025-05-22 02:18:03','2025-05-22 02:18:03',NULL,1),('bryan.astudillo@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','bryan.astudillo','fijodigital.cl/bryan.astudillo/',500,'bryan.astudillo','fijodigital.cl','2025-05-19 13:47:14','2025-05-19 13:47:14',1,'','','','2025-05-19 13:47:14','2025-05-19 13:47:14',NULL,1),('carla.sequeida@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','carla.sequeida','fijodigital.cl/carla.sequeida/',500,'carla.sequeida','fijodigital.cl','2025-05-22 02:17:46','2025-05-22 02:17:46',1,'','','','2025-05-22 02:17:46','2025-05-22 02:17:46',NULL,1),('carolina.tapia@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','carolina.tapia','fijodigital.cl/carolina.tapia/',500,'carolina.tapia','fijodigital.cl','2025-05-22 02:15:26','2025-05-22 02:15:26',1,'','','','2025-05-22 02:15:26','2025-05-22 02:15:26',NULL,1),('carolina.tapia@smartcalling.cl','{MD5}c8d7979eac5f57474d548ac81064518e','carolina.tapia','smartcalling.cl/carolina.tapia/',1024,'carolina.tapia','smartcalling.cl','2025-05-28 18:35:31','2025-05-28 18:35:31',1,'','','','2000-01-01 00:00:00','2000-01-01 00:00:00',NULL,1),('danitza.toledo@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','danitza.toledo','fijodigital.cl/danitza.toledo/',500,'danitza.toledo','fijodigital.cl','2025-05-19 13:45:14','2025-05-19 13:45:14',1,'','','','2025-05-19 13:45:14','2025-05-19 13:45:14',NULL,1),('david.aguilera@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','david.aguilera','fijodigital.cl/david.aguilera/',500,'david.aguilera','fijodigital.cl','2025-05-19 05:41:03','2025-05-19 05:41:03',1,'','','','2025-05-19 05:41:03','2025-05-19 05:41:03',NULL,1),('diego.yanez@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','diego.yanez','fijodigital.cl/diego.yanez/',500,'diego.yanez','fijodigital.cl','2025-05-19 13:42:03','2025-05-19 13:42:03',1,'','','','2025-05-19 13:42:03','2025-05-19 13:42:03',NULL,1),('eloisa.mella@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','eloisa.mella','fijodigital.cl/eloisa.mella/',500,'eloisa.mella','fijodigital.cl','2025-05-22 02:14:53','2025-05-22 02:14:53',1,'','','','2025-05-22 02:14:53','2025-05-22 02:14:53',NULL,1),('gaston.vilches@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','gaston.vilches','fijodigital.cl/gaston.vilches/',500,'gaston.vilches','fijodigital.cl','2025-05-22 02:15:47','2025-05-22 02:15:47',1,'','','','2025-05-22 02:15:47','2025-05-22 02:15:47',NULL,1),('guillermo.flores@smartcalling.cl','{MD5}c8d7979eac5f57474d548ac81064518e','guillermo.flores','smartcalling.cl/guillermo.flores/',1024,'guillermo.flores','smartcalling.cl','2025-05-28 20:25:32','2025-05-28 20:25:32',1,'','','','2000-01-01 00:00:00','2000-01-01 00:00:00',NULL,1),('hugo.herrera@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','hugo.herrera','fijodigital.cl/hugo.herrera/',500,'hugo.herrera','fijodigital.cl','2025-05-19 13:42:23','2025-05-19 13:42:23',1,'','','','2025-05-19 13:42:23','2025-05-19 13:42:23',NULL,1),('iris.llanos@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','iris.llanos','fijodigital.cl/iris.llanos/',500,'iris.llanos','fijodigital.cl','2025-05-19 13:44:48','2025-05-19 13:44:48',1,'','','','2025-05-19 13:44:48','2025-05-19 13:44:48',NULL,1),('jessica.meneses@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','jessica.meneses','fijodigital.cl/jessica.meneses/',500,'jessica.meneses','fijodigital.cl','2025-05-22 02:14:31','2025-05-22 02:14:31',1,'','','','2025-05-22 02:14:31','2025-05-22 02:14:31',NULL,1),('jorge.gamboa@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','jorge.gamboa','fijodigital.cl/jorge.gamboa/',500,'jorge.gamboa','fijodigital.cl','2025-05-22 02:17:28','2025-05-22 02:17:28',1,'','','','2025-05-22 02:17:28','2025-05-22 02:17:28',NULL,1),('luis.melo@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','luis.melo','fijodigital.cl/luis.melo/',500,'luis.melo','fijodigital.cl','2025-05-22 02:16:19','2025-05-22 02:16:19',1,'','','','2025-05-22 02:16:19','2025-05-22 02:16:19',NULL,1),('luis.sequeida@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','luis.sequeida','fijodigital.cl/luis.sequeida/',500,'luis.sequeida','fijodigital.cl','2025-05-22 02:17:13','2025-05-22 02:17:13',1,'','','','2025-05-22 02:17:13','2025-05-22 02:17:13',NULL,1),('marcelo.avendano@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','marcelo.avendano','fijodigital.cl/marcelo.avendano/',500,'marcelo.avendano','fijodigital.cl','2025-05-19 13:44:20','2025-05-19 13:44:20',1,'','','','2025-05-19 13:44:20','2025-05-19 13:44:20',NULL,1),('mario.yanez@smartcalling.cl','{MD5}c8d7979eac5f57474d548ac81064518e','mario.yanez','smartcalling.cl/mario.yanez/',1024,'mario.yanez','smartcalling.cl','2025-05-28 20:26:00','2025-05-28 20:26:00',1,'','','','2000-01-01 00:00:00','2000-01-01 00:00:00',NULL,1),('martin.candia@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','martin.candia','fijodigital.cl/martin.candia/',500,'martin.candia','fijodigital.cl','2025-05-22 02:16:53','2025-05-22 02:16:53',1,'','','','2025-05-22 02:16:53','2025-05-22 02:16:53',NULL,1),('maura.arrigada@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','maura.arrigada','fijodigital.cl/maura.arrigada/',500,'maura.arrigada','fijodigital.cl','2025-05-19 20:33:19','2025-05-19 20:33:19',1,'','','','2025-05-19 20:33:19','2025-05-19 20:33:19',NULL,1),('nataly.donoso@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','nataly.donoso','fijodigital.cl/nataly.donoso/',500,'nataly.donoso','fijodigital.cl','2025-05-22 02:16:37','2025-05-22 02:16:37',1,'','','','2025-05-22 02:16:37','2025-05-22 02:16:37',NULL,1),('patricio.astudillo@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','patricio.astudillo','fijodigital.cl/patricio.astudillo/',500,'patricio.astudillo','fijodigital.cl','2025-05-19 13:45:35','2025-05-19 13:45:35',1,'','','','2025-05-19 13:45:35','2025-05-19 13:45:35',NULL,1),('ruth.paredes@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','ruth.paredes','fijodigital.cl/ruth.paredes/',500,'ruth.paredes','fijodigital.cl','2025-05-22 02:15:11','2025-05-22 02:15:11',1,'','','','2025-05-22 02:15:11','2025-05-22 02:15:11',NULL,1),('saida.velez@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','saida.velez','fijodigital.cl/saida.velez/',500,'saida.velez','fijodigital.cl','2025-05-19 13:44:04','2025-05-19 13:44:04',1,'','','','2025-05-19 13:44:04','2025-05-19 13:44:04',NULL,1),('sebastian.saavedra@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','sebastian.saavedra','fijodigital.cl/sebastian.saavedra/',500,'sebastian.saavedra','fijodigital.cl','2025-05-19 13:42:57','2025-05-19 13:42:57',1,'','','','2025-05-19 13:42:57','2025-05-19 13:42:57',NULL,1),('valentina.arriagada@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','valentina.arriagada','fijodigital.cl/valentina.arriagada/',500,'valentina.arriagada','fijodigital.cl','2025-05-19 13:41:23','2025-05-19 13:41:23',1,'','','','2025-05-19 13:41:23','2025-05-19 13:41:23',NULL,1),('ximena.munoz@fijodigital.cl','{MD5-CRYPT}$1$W0ke2AlO$x8F1r0whEej1rQxn0sWAa.','ximena.munoz','fijodigital.cl/ximena.munoz/',1024,'ximena.munoz','fijodigital.cl','2025-05-14 21:51:50','2025-05-14 21:51:50',1,'','','','2025-05-14 21:51:50','2025-05-14 21:51:50',NULL,1),('yenni.orellana@fijodigital.cl','{MD5}0427e1f9723e3905b3f9b156961db79d','yenni.orellana','fijodigital.cl/yenni.orellana/',500,'yenni.orellana','fijodigital.cl','2025-05-22 02:16:04','2025-05-22 02:16:04',1,'','','','2025-05-22 02:16:04','2025-05-22 02:16:04',NULL,1);
/*!40000 ALTER TABLE `mailbox` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mailbox_app_password`
--

DROP TABLE IF EXISTS `mailbox_app_password`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mailbox_app_password` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mailbox_app_password`
--

LOCK TABLES `mailbox_app_password` WRITE;
/*!40000 ALTER TABLE `mailbox_app_password` DISABLE KEYS */;
/*!40000 ALTER TABLE `mailbox_app_password` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quota`
--

DROP TABLE IF EXISTS `quota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quota` (
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `path` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `current` bigint NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`,`path`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quota`
--

LOCK TABLES `quota` WRITE;
/*!40000 ALTER TABLE `quota` DISABLE KEYS */;
/*!40000 ALTER TABLE `quota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quota2`
--

DROP TABLE IF EXISTS `quota2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `quota2` (
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `bytes` bigint NOT NULL DEFAULT '0',
  `messages` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quota2`
--

LOCK TABLES `quota2` WRITE;
/*!40000 ALTER TABLE `quota2` DISABLE KEYS */;
/*!40000 ALTER TABLE `quota2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `totp_exception_address`
--

DROP TABLE IF EXISTS `totp_exception_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `totp_exception_address` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip` varchar(46) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip_user` (`ip`,`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `totp_exception_address`
--

LOCK TABLES `totp_exception_address` WRITE;
/*!40000 ALTER TABLE `totp_exception_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `totp_exception_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacation`
--

DROP TABLE IF EXISTS `vacation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vacation` (
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cache` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `domain` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activefrom` timestamp NOT NULL DEFAULT '2000-01-01 06:00:00',
  `activeuntil` timestamp NOT NULL DEFAULT '2038-01-18 06:00:00',
  `interval_time` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`email`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Postfix Admin - Virtual Vacation';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacation`
--

LOCK TABLES `vacation` WRITE;
/*!40000 ALTER TABLE `vacation` DISABLE KEYS */;
/*!40000 ALTER TABLE `vacation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vacation_notification`
--

DROP TABLE IF EXISTS `vacation_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vacation_notification` (
  `on_vacation` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `notified` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `notified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`on_vacation`,`notified`),
  CONSTRAINT `vacation_notification_pkey` FOREIGN KEY (`on_vacation`) REFERENCES `vacation` (`email`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COMMENT='Postfix Admin - Virtual Vacation Notifications';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vacation_notification`
--

LOCK TABLES `vacation_notification` WRITE;
/*!40000 ALTER TABLE `vacation_notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `vacation_notification` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-03 22:24:18
