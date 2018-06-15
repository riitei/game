-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 192.168.0.104    Database: game
-- ------------------------------------------------------
-- Server version	5.6.38

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
-- Table structure for table `map`
--

DROP TABLE IF EXISTS `map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `map` (
  `id` int(11) NOT NULL,
  `checkpoint` varchar(45) NOT NULL COMMENT '關卡',
  `map_array` longtext NOT NULL COMMENT '地圖map的array',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='將地圖array直接存放在db';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `map`
--

LOCK TABLES `map` WRITE;
/*!40000 ALTER TABLE `map` DISABLE KEYS */;
INSERT INTO `map` VALUES (1,'test','[[0, 0, 0, 0, 0], [0, 1, 0, 2, 0], [0, 1, 0, 1, 0], [0, 1, 0, 1, 0], [0, 0, 0, 1, 0], [0, 2, 0, 0, 0]]');
/*!40000 ALTER TABLE `map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `map_coordinate`
--

DROP TABLE IF EXISTS `map_coordinate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `map_coordinate` (
  `id` int(11) NOT NULL,
  `map_vertical` int(11) NOT NULL COMMENT '存放 map array 所有資訊',
  `map_horizontal` int(11) NOT NULL,
  `map_value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='存放地圖座標';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `map_coordinate`
--

LOCK TABLES `map_coordinate` WRITE;
/*!40000 ALTER TABLE `map_coordinate` DISABLE KEYS */;
INSERT INTO `map_coordinate` VALUES (1,0,0,0),(2,0,1,0),(3,0,2,0),(4,0,3,0),(5,0,4,0),(6,1,0,0),(7,1,1,1),(8,1,2,0),(9,1,3,2),(10,1,4,0),(11,2,0,0),(12,2,1,1),(13,2,2,0),(14,2,3,1),(15,2,4,0),(16,3,0,0),(17,3,1,1),(18,3,2,0),(19,3,3,1),(20,3,4,0),(21,4,0,0),(22,4,1,0),(23,4,2,0),(24,4,3,1),(25,4,4,0),(26,5,0,0),(27,5,1,2),(28,5,2,0),(29,5,3,0),(30,5,4,0);
/*!40000 ALTER TABLE `map_coordinate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `map_photo_path`
--

DROP TABLE IF EXISTS `map_photo_path`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `map_photo_path` (
  `id` int(11) NOT NULL,
  `map_photo_name` varchar(45) NOT NULL COMMENT '存放地圖的名稱( pass 可通行 ,obstacle 不可通行,Character 角色)',
  `map_photo_path` varchar(45) NOT NULL COMMENT '存放地圖的名稱( pass 可通行 ,obstacle 不可通行,Character 角色)的路徑',
  `map_value` int(11) NOT NULL COMMENT '\n表格 map_coordinate \n資料表欄位 map_value 的 FK 值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='存放地圖的圖片路徑';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `map_photo_path`
--

LOCK TABLES `map_photo_path` WRITE;
/*!40000 ALTER TABLE `map_photo_path` DISABLE KEYS */;
INSERT INTO `map_photo_path` VALUES (1,'pass','/photo/pass.jpg',0),(2,'obstacle','/photo/obstacle.jpg',1),(3,'character','/photo/character.jpg',2);
/*!40000 ALTER TABLE `map_photo_path` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `map_v0`
--

DROP TABLE IF EXISTS `map_v0`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `map_v0` (
  `id` int(11) NOT NULL,
  `checkpoint` varchar(45) NOT NULL COMMENT '關卡',
  `map_array` longtext NOT NULL COMMENT '地圖map的array',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='將地圖array直接存放在db';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `map_v0`
--

LOCK TABLES `map_v0` WRITE;
/*!40000 ALTER TABLE `map_v0` DISABLE KEYS */;
INSERT INTO `map_v0` VALUES (1,'test','[[0, 0, 0, 0, 0], [0, 1, 0, 1, 0], [0, 1, 0, 1, 0], [0, 1, 0, 1, 0], [0, 0, 0, 1, 0], [0, 1, 0, 0, 0]]');
/*!40000 ALTER TABLE `map_v0` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-11 21:07:06
