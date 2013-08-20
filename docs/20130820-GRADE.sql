CREATE DATABASE  IF NOT EXISTS `db_grade` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_grade`;
-- MySQL dump 10.13  Distrib 5.5.32, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db_grade
-- ------------------------------------------------------
-- Server version	5.5.32-0ubuntu0.12.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `srs_series`
--

DROP TABLE IF EXISTS `srs_series`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `srs_series` (
  `srs_id` int(4) NOT NULL AUTO_INCREMENT,
  `srs_type` int(4) DEFAULT NULL,
  `srs_name` varchar(255) DEFAULT NULL,
  `srs_vintage` datetime DEFAULT NULL,
  `srs_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`srs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `srs_series`
--

LOCK TABLES `srs_series` WRITE;
/*!40000 ALTER TABLE `srs_series` DISABLE KEYS */;
/*!40000 ALTER TABLE `srs_series` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `srt_seriestype`
--

DROP TABLE IF EXISTS `srt_seriestype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `srt_seriestype` (
  `srt_id` int(4) NOT NULL AUTO_INCREMENT,
  `srt_name` varchar(255) DEFAULT NULL,
  `srt_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`srt_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `srt_seriestype`
--

LOCK TABLES `srt_seriestype` WRITE;
/*!40000 ALTER TABLE `srt_seriestype` DISABLE KEYS */;
/*!40000 ALTER TABLE `srt_seriestype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usr_user`
--

DROP TABLE IF EXISTS `usr_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usr_user` (
  `usr_id` int(4) NOT NULL AUTO_INCREMENT,
  `usr_date_insert` datetime DEFAULT NULL,
  `usr_date_update` datetime DEFAULT NULL,
  `usr_name` varchar(255) NOT NULL,
  `usr_email` varchar(255) NOT NULL,
  `usr_pass` varchar(255) NOT NULL,
  `usr_status` int(2) NOT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usr_user`
--

LOCK TABLES `usr_user` WRITE;
/*!40000 ALTER TABLE `usr_user` DISABLE KEYS */;
INSERT INTO `usr_user` VALUES (1,'2013-08-19 18:45:41','2013-08-19 18:45:41','Raphael Oliveira','rapahaeru@gmail.com','698dc19d489c4e4db73e28a713eab07b',1),(2,'2013-08-19 18:47:38','2013-08-19 18:47:38','Raphael Oliveira','cael@trip.com.br','698dc19d489c4e4db73e28a713eab07b',1),(3,'2013-08-20 12:10:01','2013-08-20 12:10:02','nome teste','teste@teste.com','3c59dc048e8850243be8079a5c74d079',1),(4,'2013-08-20 12:15:45','2013-08-20 12:15:45','Felipe','felipe@email.com','b6d767d2f8ed5d21a44b0e5886680cb9',1);
/*!40000 ALTER TABLE `usr_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-20 12:19:35
