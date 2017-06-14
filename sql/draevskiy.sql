-- MySQL dump 10.14  Distrib 5.5.52-MariaDB, for Linux (x86_64)
--
-- Host: 192.168.10.251    Database: draevskiy
-- ------------------------------------------------------
-- Server version	5.6.35

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `id_account` int(10) NOT NULL AUTO_INCREMENT,
  `lastname` char(50) NOT NULL,
  `birthday` char(50) NOT NULL,
  `report` char(50) NOT NULL,
  `country` char(30) NOT NULL,
  `phone` char(17) NOT NULL,
  `firstname` char(50) NOT NULL,
  `email` char(50) NOT NULL,
  `company` char(50) DEFAULT NULL,
  `position` char(20) DEFAULT NULL,
  `about` char(100) DEFAULT NULL,
  `photo` char(100) DEFAULT NULL,
  PRIMARY KEY (`id_account`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'Draevskiy','06.05.1996','BrainFuck - esoteric programming language','US','+1 (555) 555-5555','Dmitry','draevskiy_ds@groupbwt.com','BWT','Quest','^^',''),(2,'Draevskiy','06.05.1996','BrainFuck - esoteric programming language','US','+1 (555) 555-5551','Dmitry','draevskiy_ds@groupbwt.com','BWT','Quest','^^',''),(4,'Draevskiy','06.05.1996','BrainFuck - esoteric programming language','US','+1 (555) 555-5554','Dmitry','draevskiy_ds@groupbwt.com','BWT','Quest','^^',''),(5,'Draevskiy','06.05.1996','BrainFuck - esoteric programming language','US','+1 (555) 555-5553','Dmitry','draevskiy_ds@groupbwt.com','BWT','Quest','^^',''),(6,'Draevskiy','06.05.1996','BrainFuck - esoteric programming language','US','+1 (555) 555-5552','Dmitry','draevskiy_ds@groupbwt.com','BWT','Quest','^^',''),(7,'Draevskiy','06.05.1996','BrainFuck - esoteric programming language','US','+1 (555) 555-5550','Dmitry','draevskiy_ds@groupbwt.com','BWT','Quest','^^','./upload/1.jpg_373687_1490173732'),(8,'Shevchuk','08.10.1986','Report Subject','UA','+1 (123) 123-1321','Oleg','shevchuk_ov@groupbwt.com','0','0','0',NULL),(9,'Draevskiy','06.05.1996','Test','US','+1 (555) 555-5555','Dmitry','draevskdmitry@mail.ru','0','0','0',''),(10,'олдолд','04.07.2030','лодолд','GB','+1 (777) 777-7777','лодол','klj@g.jkl','0','0','0',NULL),(14,'Draevskiy','06.05.1996','Report','US','+1 (651) 516-5165','Dmitry','draevskdmitry@mail.ru','0','0','0',NULL),(15,'lastname','test','test','UM','+1 (141) 234-1234','firstname','wertwertret@tewt.com','0','0','0',NULL),(16,'test','test','test','UY','+1 (123) 412-3413','test','test@test.com','0','0','0',''),(17,'123','23.03.2017','123','US','+1 (555) 555-5555','13','123@mail.ru','123','123','123',NULL),(18,'Draevskiy','06.05.1996','Test','US','+1 (555) 555-5555','Dmitry','12312@mail.ru','0','0','0',NULL),(19,'h','jlk','nnk','UA','+1 (565) 656-5656','h','assa@d.d','','','',NULL),(20,'jfkgjg','lsdsdfsfs','dngdngd','US','+1 (454) 545-4545','gndgn','nkfkdfndkgn@ggfgf.fgfgfg','','','',NULL),(21,'123','09.02.1996','123','US','+1 (555) 555-5555','123','12312@mail.ru','','','',NULL),(22,'test2','15.02.1999','test4','UA','+1 (121) 212-1131','test','test@mail.com','','','',NULL),(23,'12','02.03.2012','2','US','+1','1','test@mail.com','','','',NULL),(24,'2','01.01.2011','3','US','+1','1','test@mail.com','','','',NULL),(25,'2','02.03.2010','3','US','+1','1','test@mail.com','','','',NULL),(26,'3','01.02.2011','4','US','+1','2','test@mail.com','','','',NULL);
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-06  9:23:29
