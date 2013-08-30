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
-- Table structure for table `dir_director`
--

DROP TABLE IF EXISTS `dir_director`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dir_director` (
  `dir_id` int(5) NOT NULL AUTO_INCREMENT,
  `dir_status` int(1) DEFAULT NULL,
  `dir_name` varchar(255) DEFAULT NULL,
  `dir_seo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`dir_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `gen_gender`
--

DROP TABLE IF EXISTS `gen_gender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gen_gender` (
  `gen_id` int(3) NOT NULL AUTO_INCREMENT,
  `gen_status` int(1) NOT NULL,
  `gen_name` varchar(45) NOT NULL,
  `gen_seo` varchar(45) NOT NULL,
  PRIMARY KEY (`gen_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mog_moviegrade`
--

DROP TABLE IF EXISTS `mog_moviegrade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mog_moviegrade` (
  `mog_id` int(8) NOT NULL AUTO_INCREMENT,
  `mog_date_grade` datetime NOT NULL,
  `usr_user_usr_id` int(4) NOT NULL,
  `mov_movie_mov_id` int(8) NOT NULL,
  `mog_personalgrade` decimal(4,0) DEFAULT NULL,
  PRIMARY KEY (`mog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `mov_movie`
--

DROP TABLE IF EXISTS `mov_movie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mov_movie` (
  `mov_id` int(8) NOT NULL AUTO_INCREMENT,
  `mov_approval` int(1) DEFAULT '0',
  `mov_status` varchar(45) DEFAULT NULL,
  `mov_created_id` varchar(45) DEFAULT NULL,
  `mov_date_insert` datetime DEFAULT NULL,
  `mov_updated_id` varchar(45) DEFAULT NULL,
  `mov_date_update` datetime DEFAULT NULL,
  `mov_vintage` datetime DEFAULT NULL,
  `mov_originalname` varchar(255) DEFAULT NULL,
  `mov_name` varchar(255) NOT NULL,
  `mov_seo` varchar(255) NOT NULL,
  `mov_sinopses` longtext,
  `mov_in_animation` int(1) DEFAULT '0',
  `mov_trailer` longtext,
  `mov_moreinfo` varchar(355) DEFAULT NULL,
  `mov_poster` varchar(255) DEFAULT NULL,
  `dir_director_dir_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`mov_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `rmg_moviegender`
--

DROP TABLE IF EXISTS `rmg_moviegender`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rmg_moviegender` (
  `rmg_id` int(11) NOT NULL AUTO_INCREMENT,
  `mov_movie_mov_id` int(8) NOT NULL,
  `gen_gender_gen_id` int(3) NOT NULL,
  PRIMARY KEY (`rmg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `usr_numberaccess` int(5) DEFAULT NULL,
  `usr_lastaccess` datetime DEFAULT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-08-30 15:54:01
