CREATE DATABASE  IF NOT EXISTS `db_grade` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_grade`;
-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db_grade
-- ------------------------------------------------------
-- Server version	5.5.35-0ubuntu0.12.04.2

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dir_director`
--

LOCK TABLES `dir_director` WRITE;
/*!40000 ALTER TABLE `dir_director` DISABLE KEYS */;
INSERT INTO `dir_director` VALUES (1,1,'Robert Zemeckis','robert-zemeckis'),(2,1,'Steven Spielberg','steven-spielberg'),(3,1,'J. J. Abrams','j-j-abrams'),(4,1,'Francis Ford Coppola','francis-ford-coppola'),(5,1,'Quentin Tarantino','quentin-tarantino'),(6,1,'Christopher Nolan','christopher-nolan'),(11,1,'James Cameron','james-cameron'),(12,1,'Peter Jackson','peter-jackson');
/*!40000 ALTER TABLE `dir_director` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Dumping data for table `gen_gender`
--

LOCK TABLES `gen_gender` WRITE;
/*!40000 ALTER TABLE `gen_gender` DISABLE KEYS */;
INSERT INTO `gen_gender` VALUES (1,1,'Drama','drama'),(2,1,'Romance','romance'),(3,1,'Ação','acao'),(4,1,'Suspense','suspense');
/*!40000 ALTER TABLE `gen_gender` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mog_moviegrade`
--

LOCK TABLES `mog_moviegrade` WRITE;
/*!40000 ALTER TABLE `mog_moviegrade` DISABLE KEYS */;
INSERT INTO `mog_moviegrade` VALUES (1,'0000-00-00 00:00:00',5,22,8),(2,'0000-00-00 00:00:00',2,23,6);
/*!40000 ALTER TABLE `mog_moviegrade` ENABLE KEYS */;
UNLOCK TABLES;

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
  `mov_average` decimal(4,0) DEFAULT NULL,
  PRIMARY KEY (`mov_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mov_movie`
--

LOCK TABLES `mov_movie` WRITE;
/*!40000 ALTER TABLE `mov_movie` DISABLE KEYS */;
INSERT INTO `mov_movie` VALUES (1,0,'1','2','2013-08-27 16:59:57','2','2013-08-27 16:59:57','2013-08-20 00:00:00','caels movie','Raphael Oliveira','caels-movie','cs',1,'dsasdv','',NULL,NULL,NULL),(2,0,'1','2','2013-08-27 17:00:42','2','2013-08-27 17:00:42','2013-08-20 00:00:00','sda asdg ag','d F FF asd','sda-asdg-ag','sdag s',0,'g sadg','',NULL,NULL,NULL),(3,0,'1','2','2013-08-27 17:01:14','2','2013-08-27 17:01:14','2013-08-20 00:00:00','sda asdg ag','d F FF asd','sda-asdg-ag','sdag s',0,'g sadg','',NULL,NULL,NULL),(4,0,'1','2','2013-08-27 17:02:29','2','2013-08-27 17:02:29','2013-08-20 00:00:00','sda asdg ag','d F FF asd','sda-asdg-ag','sdag s',0,'g sadg','',NULL,NULL,NULL),(5,0,'1','2','2013-08-27 17:03:31','2','2013-08-27 17:03:31','2013-08-20 00:00:00','sda asdg ag','d F FF asd','sda-asdg-ag','sdag s',0,'g sadg','',NULL,NULL,NULL),(6,0,'1','2','2013-08-27 17:03:45','2','2013-08-27 17:03:45','2013-08-20 00:00:00','sda asdg ag','d F FF asd','sda-asdg-ag','sdag s',0,'g sadg','',NULL,NULL,NULL),(7,0,'1','2','2013-08-27 17:03:59','2','2013-08-27 17:03:59','2013-08-20 00:00:00','sda asdg ag','d F FF asd','sda-asdg-ag','sdag s',0,'g sadg','',NULL,NULL,NULL),(8,0,'1','2','2013-08-27 17:12:33','2','2013-08-27 17:12:33','2013-08-20 00:00:00','sda asdg ag','d F FF asd','sda-asdg-ag','sdag s',0,'g sadg','',NULL,NULL,NULL),(9,0,'1','2','2013-08-27 17:14:10','2','2013-08-27 17:14:10','2013-08-20 00:00:00','sda asdg ag','d F FF asd','sda-asdg-ag','sdag s',0,'g sadg','',NULL,NULL,NULL),(10,0,'1','2','2013-08-27 17:14:37','2','2013-08-27 17:14:37','2013-08-20 00:00:00','sda asdg ag','d F FF asd','sda-asdg-ag','sdag s',0,'g sadg','',NULL,NULL,NULL),(11,0,'1','2','2013-08-27 17:15:44','2','2013-08-27 17:15:44','2013-08-20 00:00:00','sda asdg ag','d F FF asd','sda-asdg-ag','sdag s',0,'g sadg','',NULL,NULL,NULL),(12,0,'1','2','2013-08-27 17:16:02','2','2013-08-27 17:16:02','2013-08-20 00:00:00','sda asdg ag','d F FF asd','sda-asdg-ag','sdag s',0,'g sadg','',NULL,NULL,NULL),(13,0,'1','2','2013-08-27 17:16:24','2','2013-08-27 17:16:24','2013-08-20 00:00:00','sda asdg ag','d F FF asd','sda-asdg-ag','sdag s',0,'g sadg','',NULL,NULL,NULL),(14,0,'1','2','2013-08-27 17:18:21','2','2013-08-27 17:18:21','2013-08-20 00:00:00','sda asdg ag','d F FF asd','sda-asdg-ag','sdag s',0,'g sadg','',NULL,NULL,NULL),(15,1,'1','2','2013-08-27 17:19:56','2','2013-08-27 17:19:56','2013-08-01 00:00:00','Back to the future','De volta para o futuro','back-to-the-future','',0,'','',NULL,1,NULL),(16,0,'1','2','2013-08-30 13:21:11','2','2013-08-30 13:21:11','2013-08-20 00:00:00','test cael','cael teste','test-cael','sdfsdf',0,'dssd','',NULL,NULL,NULL),(17,0,'1','2','2013-08-30 13:22:19','2','2013-08-30 13:22:19','2013-08-27 00:00:00','big mini cael','mini cael','big-mini-cael','',0,'sdsd','','a193907e8d9de5828ff0e3b0d9df4ca8.jpg',NULL,NULL),(18,0,'1','2','2013-08-30 15:45:35','2','2013-08-30 15:45:35','2013-08-28 00:00:00','pups satisfaction','Filme do pups','pups-satisfaction','breve',0,'nao tem','','f233344bc71205e747096b26ef6ddcc9.jpg',0,NULL),(19,1,'1','5','2013-09-10 15:19:59','5','2013-09-10 15:19:59','1993-06-19 00:00:00','The Lion King','O Rei Leão','the-lion-king','',1,'','','',0,NULL),(20,1,'1','5','2013-09-10 15:20:44','5','2013-09-10 15:20:44','1992-09-30 00:00:00','Terminator 2','O Exterminador do Futuro 2','terminator-2','',0,'','','',11,NULL),(21,1,'1','5','2013-09-10 17:00:37','5','2013-09-10 17:00:37','2001-01-01 00:00:00','The Lord Of The Rings - The Fellowship Of The Ring','O Senhor Dos Anéis - A Sociedade Do Anel','the-lord-of-the-rings-the-fellowship-of-the-ring','',0,'','','',12,NULL),(22,1,'1','5','2013-09-10 17:12:03','5','2013-09-10 17:12:03','2009-04-17 00:00:00','Up','Up! Altas Aventuras','up','Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras Up! Altas Aventuras ',0,'','','',NULL,NULL),(23,1,'1','5','2013-09-10 17:12:33','5','2013-09-10 17:12:33','1996-09-23 00:00:00','Pocahontas','Pocahontas','pocahontas','',1,'','','',NULL,NULL);
/*!40000 ALTER TABLE `mov_movie` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rmg_moviegender`
--

LOCK TABLES `rmg_moviegender` WRITE;
/*!40000 ALTER TABLE `rmg_moviegender` DISABLE KEYS */;
INSERT INTO `rmg_moviegender` VALUES (1,14,2),(2,14,3),(3,15,1),(4,15,3),(5,16,1),(6,16,2),(7,17,2),(8,17,3),(9,18,1),(10,18,4),(11,19,1),(12,20,3),(13,21,3),(14,22,3),(15,23,2);
/*!40000 ALTER TABLE `rmg_moviegender` ENABLE KEYS */;
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
  `usr_numberaccess` int(5) DEFAULT NULL,
  `usr_lastaccess` datetime DEFAULT NULL,
  PRIMARY KEY (`usr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usr_user`
--

LOCK TABLES `usr_user` WRITE;
/*!40000 ALTER TABLE `usr_user` DISABLE KEYS */;
INSERT INTO `usr_user` VALUES (1,'2013-08-19 18:45:41','2013-08-19 18:45:41','Raphael Oliveira','rapahaeru@gmail.com','698dc19d489c4e4db73e28a713eab07b',1,2,'2013-09-04 18:10:54'),(2,'2013-08-19 18:47:38','2013-08-19 18:47:38','Raphael Oliveira','cael@trip.com.br','698dc19d489c4e4db73e28a713eab07b',1,16,'2013-09-09 15:10:45'),(3,'2013-08-20 12:10:01','2013-08-20 12:10:02','nome teste','teste@teste.com','3c59dc048e8850243be8079a5c74d079',1,NULL,NULL),(4,'2013-08-20 12:15:45','2013-08-20 12:15:45','Felipe','felipe@email.com','b6d767d2f8ed5d21a44b0e5886680cb9',1,NULL,NULL),(5,'2013-09-04 19:11:47','2013-09-09 15:49:15','Hudson 11','hudson@trip.com.br','698dc19d489c4e4db73e28a713eab07b',1,8,'2014-02-07 16:00:39'),(6,'2013-09-09 15:50:27','2013-09-09 15:50:27','joaquim','joaquim@email.com','698dc19d489c4e4db73e28a713eab07b',1,NULL,NULL);
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

-- Dump completed on 2014-02-07 18:46:49
