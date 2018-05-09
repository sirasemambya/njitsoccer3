-- MySQL dump 10.13  Distrib 5.5.60, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: NJITsoccer
-- ------------------------------------------------------
-- Server version	5.5.60-0ubuntu0.14.04.1-log

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
-- Table structure for table `coachaccount`
--

DROP TABLE IF EXISTS `coachaccount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coachaccount` (
  `ID` int(10) NOT NULL,
  `first` varchar(32) NOT NULL,
  `last` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coachaccount`
--

LOCK TABLES `coachaccount` WRITE;
/*!40000 ALTER TABLE `coachaccount` DISABLE KEYS */;
INSERT INTO `coachaccount` VALUES (6,'Dame','Dash','dd4@njit.edu','514f1b439f404f86f77090fa9edc96ce'),(5,'Yorel','James','jp5@njit.edu','03c7c0ace395d80182db07ae2c30f034'),(3,'James','Dolan','rp5@njit.edu','03c7c0ace395d80182db07ae2c30f034'),(2,'Mike','Armstrong','sbs43@njit.edu','03c7c0ace395d80182db07ae2c30f034');
/*!40000 ALTER TABLE `coachaccount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fan`
--

DROP TABLE IF EXISTS `fan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fan` (
  `email` varchar(32) NOT NULL,
  `first` varchar(32) NOT NULL,
  `last` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fan`
--

LOCK TABLES `fan` WRITE;
/*!40000 ALTER TABLE `fan` DISABLE KEYS */;
INSERT INTO `fan` VALUES ('rp5@njit.edu','sommo','poeta','03c7c0ace395d80182dbss'),('sbs43@njit.edu','sira','semambya','03c7c0ace395d80182db'),('ty7@njit.edu','Dave','Rice','03c723c0ace395d80182db');
/*!40000 ALTER TABLE `fan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `players` (
  `name` varchar(32) NOT NULL,
  `ID` int(4) NOT NULL,
  `position` varchar(32) NOT NULL,
  `start` int(1) NOT NULL,
  PRIMARY KEY (`name`),
  KEY `ID` (`ID`),
  KEY `start` (`start`),
  CONSTRAINT `players_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `team` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `players`
--

LOCK TABLES `players` WRITE;
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` VALUES ('Billy',3,'Midfield',0),('Carter',2,'Midfield',0),('Davis',3,'Forward',1),('james',3,'Midfield',1),('Richard',6,'Defender',1),('Steve',2,'Forward',0),('Terrance',18,'Forward',0),('Yorel',6,'Free Role',1);
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schoolaccount`
--

DROP TABLE IF EXISTS `schoolaccount`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schoolaccount` (
  `schoolname` varchar(20) NOT NULL,
  `first` varchar(20) NOT NULL,
  `last` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`schoolname`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `schoolname` (`schoolname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schoolaccount`
--

LOCK TABLES `schoolaccount` WRITE;
/*!40000 ALTER TABLE `schoolaccount` DISABLE KEYS */;
INSERT INTO `schoolaccount` VALUES ('dfalkj','Edward','Semambya','61714bbd754ba40ecce2','8c087992b9f3176f9ca4','03c7c0ace395d80182db'),('montclair','Christine','Seryazi-Yawe','097927ef7c6e3f7941f6','59a7a79484c8fcf232c7','03c7c0ace395d80182db'),('NJITsoccer','Mike','Will','294bc8356f663f440e91','e88f2f4fc6e0b092c73f','03c7c0ace395d80182db'),('pizzass','Sira','Semambya','05396db744faa3a0cd78','59a7a79484c8fcf232c7','03c7c0ace395d80182db'),('rutgers','Mary','Semambya','d708d7256258352eac10','a359e5c1993d73673b19','03c7c0ace395d80182db');
/*!40000 ALTER TABLE `schoolaccount` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `team` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `teamname` varchar(50) NOT NULL,
  `Coach` varchar(50) NOT NULL,
  `gk` varchar(50) NOT NULL,
  `def1` varchar(50) NOT NULL,
  `def2` varchar(50) NOT NULL,
  `def3` varchar(50) NOT NULL,
  `mid1` varchar(50) NOT NULL,
  `mid2` varchar(50) NOT NULL,
  `mid3` varchar(50) NOT NULL,
  `for1` varchar(50) NOT NULL,
  `for2` varchar(50) NOT NULL,
  `fr` varchar(50) NOT NULL,
  `start` int(11) NOT NULL,
  `def1s` int(11) NOT NULL,
  `def2s` int(11) NOT NULL,
  `def3s` int(11) NOT NULL,
  `mid1s` int(11) NOT NULL,
  `mid2s` int(11) NOT NULL,
  `mid3s` int(11) NOT NULL,
  `for1s` int(11) NOT NULL,
  `for2s` int(11) NOT NULL,
  `frs` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `start` (`start`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `team`
--

LOCK TABLES `team` WRITE;
/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` VALUES (2,'Chelsea FC','lkjkj','Vince','Christine Seryazi-Yawe','Mary Semambya','Vince','Mizaga','Sommo','Silva','Costa','Dad','Tom',1,1,0,1,0,0,1,1,1,0),(3,'Inter Milan','Henry Jacob','Tyerall','Phil','Chris','Jake','Suado','Yorel','Leroy','Tyler','Glinder','Sean',1,0,0,0,0,0,0,0,0,0),(5,'Real Madrid','Johnny Love','Grace','Bakayoko','Danny','Drinkwater','Ruben','Loftus','Cheeks','Lewis','Baker','Boga',1,0,0,0,0,0,0,0,0,0),(6,'Tottenahm','Sergio Ramos','Henry','Jacob','Lillard','Martin','Sean','Rashford','Lingard','Sane','Silva','Aguero',1,0,0,0,0,0,0,0,0,0),(7,'AC Milan','Vince James','Yorel','Carter','Di Matteo','Giggs','Scholes','Beckham','Hunn','Rich','Rony','Rory',1,0,0,0,0,0,0,0,0,0),(18,'Sevilla','Jarvis Hayes','Tony','Vince','Chris','Jake','rashad','Yorel','Leroy','rony','Glinder','Sean',1,0,0,0,0,0,0,0,0,0),(19,'Vitesse','Christine Seryazi-Yawe','Heffer','Chris','Jacob','Martin','Pique','Dembele','Zeda','Zola','Aguero','Jesus',1,0,0,0,0,0,0,0,0,0);
/*!40000 ALTER TABLE `team` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-09 10:01:01
