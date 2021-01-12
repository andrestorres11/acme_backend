-- MySQL dump 10.13  Distrib 8.0.22, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: acme
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `car`
--

DROP TABLE IF EXISTS `car`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `car` (
  `car_id` int NOT NULL AUTO_INCREMENT,
  `statu_id` int NOT NULL DEFAULT '1',
  `user_id` int NOT NULL,
  `car_licensePlate` varchar(45) NOT NULL,
  `car_color` varchar(300) NOT NULL,
  `car_brand` varchar(100) NOT NULL,
  `car_type` varchar(50) NOT NULL,
  `car_encrypted` varchar(350) NOT NULL,
  `car_creationDate` datetime DEFAULT NULL,
  `car_lastModification` datetime DEFAULT NULL,
  PRIMARY KEY (`car_id`),
  UNIQUE KEY `car_id_UNIQUE` (`car_id`),
  UNIQUE KEY `car_encrypted_UNIQUE` (`car_encrypted`),
  KEY `car_user_idx` (`user_id`),
  KEY `car_statu_idx` (`statu_id`),
  CONSTRAINT `car_statu` FOREIGN KEY (`statu_id`) REFERENCES `statu` (`statu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `car_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `car`
--

LOCK TABLES `car` WRITE;
/*!40000 ALTER TABLE `car` DISABLE KEYS */;
/*!40000 ALTER TABLE `car` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `life`
--

DROP TABLE IF EXISTS `life`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `life` (
  `life_id` int NOT NULL AUTO_INCREMENT,
  `statu_id` int NOT NULL DEFAULT '1',
  `car_id` int NOT NULL,
  `user_id` int NOT NULL,
  `life_encrypted` varchar(300) NOT NULL,
  `life_creationDate` datetime DEFAULT NULL,
  `life_lastModification` datetime DEFAULT NULL,
  PRIMARY KEY (`life_id`),
  UNIQUE KEY `vigencia_id_UNIQUE` (`life_id`),
  UNIQUE KEY `life_encrypted_UNIQUE` (`life_encrypted`),
  KEY `life_statu_idx` (`statu_id`),
  KEY `life_car_idx` (`car_id`),
  KEY `life_user_idx` (`user_id`),
  CONSTRAINT `life_car` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `life_statu` FOREIGN KEY (`statu_id`) REFERENCES `statu` (`statu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `life_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `life`
--

LOCK TABLES `life` WRITE;
/*!40000 ALTER TABLE `life` DISABLE KEYS */;
/*!40000 ALTER TABLE `life` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statu`
--

DROP TABLE IF EXISTS `statu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statu` (
  `statu_id` int NOT NULL AUTO_INCREMENT,
  `statu_name` varchar(350) NOT NULL,
  `statu_description` text,
  `statu_creationDate` datetime DEFAULT NULL,
  `statu_lastModification` datetime DEFAULT NULL,
  `statu_encrypted` varchar(350) NOT NULL,
  PRIMARY KEY (`statu_id`),
  UNIQUE KEY `statu_id_UNIQUE` (`statu_id`),
  UNIQUE KEY `statu_name_UNIQUE` (`statu_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statu`
--

LOCK TABLES `statu` WRITE;
/*!40000 ALTER TABLE `statu` DISABLE KEYS */;
INSERT INTO `statu` VALUES (1,'activo','esta activo',NULL,NULL,''),(2,'inactivo','no esta activo',NULL,NULL,'');
/*!40000 ALTER TABLE `statu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `token` (
  `token_id` int NOT NULL AUTO_INCREMENT,
  `statu_id` int NOT NULL DEFAULT '1',
  `user_id` int NOT NULL,
  `token_encrypted` varchar(300) NOT NULL,
  `token_creationDate` datetime DEFAULT NULL,
  `token_lastModification` datetime DEFAULT NULL,
  PRIMARY KEY (`token_id`),
  UNIQUE KEY `token_id_UNIQUE` (`token_id`),
  UNIQUE KEY `token_encrypted_UNIQUE` (`token_encrypted`),
  KEY `token_statu_idx` (`statu_id`),
  KEY `token_user_idx` (`user_id`),
  CONSTRAINT `token_statu` FOREIGN KEY (`statu_id`) REFERENCES `statu` (`statu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `token_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
INSERT INTO `token` VALUES (93,1,1,'91f9d64f6879576c36df6b43f0c271f0','2021-01-09 16:11:15',NULL),(94,1,1,'6fb828e920affef9120ffc87728646d5','2021-01-10 08:40:18',NULL),(95,1,1,'1b5bac8df235cd00f910090c0302275b','2021-01-10 08:53:12',NULL),(96,1,1,'037feed064deb38888345fe3a7389a09','2021-01-10 08:55:19',NULL),(97,1,1,'afe3835c2385f98f0716018a9b53afef','2021-01-10 08:56:01',NULL),(98,1,1,'fb9276186e692e0f09fa0c0a4d95239b','2021-01-10 08:56:10',NULL),(99,1,1,'d82b46bac9049c4d0593506e949cd86b','2021-01-10 09:00:16',NULL),(100,1,1,'494d886c93f1fcad2cb63fb27f1f8bd4','2021-01-10 09:02:01',NULL),(101,1,1,'a2958e79f0f6b89cf49c71b60f73acc5','2021-01-10 09:11:02',NULL),(102,1,1,'fda110cdc0fe4b52f1cb017d0f8b1dbd','2021-01-10 09:12:44',NULL),(103,1,1,'8ec470336d95702d88f68547a2b1739a','2021-01-10 13:01:04',NULL),(104,1,1,'1ad85c0d7ab531c7a5b964ff7f6df399','2021-01-10 18:59:56',NULL),(105,1,1,'62389d72fe5c67bdcf01a448bb8ba5d5','2021-01-10 23:23:52',NULL),(106,1,1,'191a1c5f78f32ae7b4668fe747c92f82','2021-01-12 13:51:37',NULL);
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `statu_id` int NOT NULL DEFAULT '1',
  `userType_id` int NOT NULL DEFAULT '2',
  `user_identity` varchar(100) DEFAULT NULL,
  `user_name` varchar(350) DEFAULT NULL,
  `user_secName` varchar(350) DEFAULT NULL,
  `user_lastName` varchar(350) DEFAULT NULL,
  `user_cellphone` varchar(100) DEFAULT NULL,
  `user_city` varchar(100) DEFAULT NULL,
  `user_address` varchar(250) DEFAULT NULL,
  `user_password` varchar(350) DEFAULT NULL,
  `user_email` varchar(350) DEFAULT NULL,
  `user_encrypted` varchar(350) DEFAULT NULL,
  `user_creationDate` datetime DEFAULT NULL,
  `user_lastModification` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `user_encrypted_UNIQUE` (`user_encrypted`),
  KEY `user_statu_idx` (`statu_id`),
  KEY `user_userType_idx` (`userType_id`),
  CONSTRAINT `user_statu` FOREIGN KEY (`statu_id`) REFERENCES `statu` (`statu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_userType` FOREIGN KEY (`userType_id`) REFERENCES `user_type` (`userType_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,1,'','juan','franco','martinez','300','cofran','','123456','admin-test@hotmail.com','sdbbsibfkhjsukl','2020-06-26 13:05:16',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_type` (
  `userType_id` int NOT NULL AUTO_INCREMENT,
  `statu_id` int NOT NULL DEFAULT '1',
  `userType_name` varchar(250) NOT NULL,
  `userType_encrypted` varchar(250) NOT NULL,
  `userType_description` text,
  `userType_creationDate` datetime DEFAULT NULL,
  `userType_lastModification` datetime DEFAULT NULL,
  PRIMARY KEY (`userType_id`),
  UNIQUE KEY `userType_id_UNIQUE` (`userType_id`),
  UNIQUE KEY `userType_name_UNIQUE` (`userType_name`),
  UNIQUE KEY `userType_encrypted_UNIQUE` (`userType_encrypted`),
  KEY `userType_statu_idx` (`statu_id`),
  CONSTRAINT `userType_statu` FOREIGN KEY (`statu_id`) REFERENCES `statu` (`statu_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_type`
--

LOCK TABLES `user_type` WRITE;
/*!40000 ALTER TABLE `user_type` DISABLE KEYS */;
INSERT INTO `user_type` VALUES (1,1,'user','ffgfd','usuarios del sistema',NULL,NULL),(2,1,'owner','vnvbnv','propietarios',NULL,NULL),(3,1,'driver','sfsdfsdf','conductores',NULL,NULL);
/*!40000 ALTER TABLE `user_type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-12 15:22:45
