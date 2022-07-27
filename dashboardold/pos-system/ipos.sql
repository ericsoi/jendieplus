-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: ipos
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(200) NOT NULL,
  PRIMARY KEY (`cat_id`),
  UNIQUE KEY `cat_name` (`cat_name`),
  UNIQUE KEY `cat_name_2` (`cat_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_category`
--

LOCK TABLES `tbl_category` WRITE;
/*!40000 ALTER TABLE `tbl_category` DISABLE KEYS */;
INSERT INTO `tbl_category` VALUES (1,'Bimaplus');
/*!40000 ALTER TABLE `tbl_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_coverage`
--

DROP TABLE IF EXISTS `tbl_coverage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_coverage` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `cover` varchar(255) NOT NULL,
  `Value` varchar(255) DEFAULT NULL,
  `CertCoverType` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_coverage`
--

LOCK TABLES `tbl_coverage` WRITE;
/*!40000 ALTER TABLE `tbl_coverage` DISABLE KEYS */;
INSERT INTO `tbl_coverage` VALUES (1,'Third Party Only','third','300'),(2,'Third Party And Theft','thirdAndT','200'),(3,'Comprehensive','comprehensive','100');
/*!40000 ALTER TABLE `tbl_coverage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_edited_product`
--

DROP TABLE IF EXISTS `tbl_edited_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_edited_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `vehicleclass` varchar(255) DEFAULT NULL,
  `underwriter` varchar(255) DEFAULT NULL,
  `coverage` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `clauses` varchar(255) DEFAULT NULL,
  `conditionsandwaranties` varchar(255) DEFAULT NULL,
  `optionalname` varchar(255) DEFAULT NULL,
  `optionalpremium` varchar(255) DEFAULT NULL,
  `optionalrate` varchar(255) DEFAULT NULL,
  `policylimits` varchar(255) DEFAULT NULL,
  `mintonnage` varchar(255) DEFAULT NULL,
  `maxtonnage` varchar(255) DEFAULT NULL,
  `weeklyrates` varchar(255) DEFAULT NULL,
  `fortnightrates` varchar(255) DEFAULT NULL,
  `passangers` varchar(255) DEFAULT NULL,
  `monthlyrates` varchar(255) DEFAULT NULL,
  `annualrates` varchar(255) DEFAULT NULL,
  `excludedvehicles` varchar(255) DEFAULT NULL,
  `minimumpremium` varchar(255) DEFAULT NULL,
  `maxage` varchar(255) DEFAULT NULL,
  `minage` varchar(255) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `maxsum` varchar(255) DEFAULT NULL,
  `minsum` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_edited_product`
--

LOCK TABLES `tbl_edited_product` WRITE;
/*!40000 ALTER TABLE `tbl_edited_product` DISABLE KEYS */;
INSERT INTO `tbl_edited_product` VALUES (1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'a462c2e30f810710fdd32ba525dcdaca','a462c2e30f810710fdd32ba525dcdaca','a462c2e30f810710fdd32ba525dcdaca','a462c2e30f810710fdd32ba525dcdaca','8888','8888','8888','8888','888','888','8888','888','8888','8888','88888','2021-06-17 13:14:35','88888','88888'),(2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'4ce2aee01f706dad09de77f7a7fff728','4ce2aee01f706dad09de77f7a7fff728','4ce2aee01f706dad09de77f7a7fff728','4ce2aee01f706dad09de77f7a7fff728','8888','8888','8888','8888','888','888','8888','888','8888','8888','88888','2021-06-17 13:15:33','88888','88888'),(3,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'55555','5555','55555','ba36351f5aa5c26bad141624f8e6dc56','55555','55555','55555','55555','55555','55555','55555','5555','55555','55555','55555','2021-06-17 13:16:06','55555','55555'),(4,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'83c9866d68c635ae3436c65ed2fdf959','83c9866d68c635ae3436c65ed2fdf959','83c9866d68c635ae3436c65ed2fdf959','83c9866d68c635ae3436c65ed2fdf959','8888','8888','8888','8888','888','888','8888','888','8888','8888','88888','2021-06-17 13:17:05','88888','88888'),(5,'a0267151f6dd65cac8978b0360c886ef',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'fbc1c19e3044a4a1861d3ead3240ddeb','fbc1c19e3044a4a1861d3ead3240ddeb','fbc1c19e3044a4a1861d3ead3240ddeb','fbc1c19e3044a4a1861d3ead3240ddeb','8888','8888','8888','8888','888','888','8888','888','8888','8888','88888','2021-06-17 13:18:01','88888','88888'),(6,'419e0e4c73649dbdecca3e3d3e71c6d2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'f63aeb9cbf60fbb742efed7181a20aea','f63aeb9cbf60fbb742efed7181a20aea','f63aeb9cbf60fbb742efed7181a20aea','f63aeb9cbf60fbb742efed7181a20aea','f63aeb9cbf60fbb742efed7181a20aea','f63aeb9cbf60fbb742efed7181a20aea','f63aeb9cbf60fbb742efed7181a20aea','f63aeb9cbf60fbb742efed7181a20aea','f63aeb9cbf60fbb742efed7181a20aea','f63aeb9cbf60fbb742efed7181a20aea','5454','f63aeb9cbf60fbb742efed7181a20aea','f63aeb9cbf60fbb742efed7181a20aea','f63aeb9cbf60fbb742efed7181a20aea','f63aeb9cbf60fbb742efed7181a20aea','2021-06-17 13:18:22','f63aeb9cbf60fbb742efed7181a20aea','f63aeb9cbf60fbb742efed7181a20aea'),(13,'a0267151f6dd65cac8978b0360c886ef',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'62d7cda42865013c9a6442fe1508eae3','62d7cda42865013c9a6442fe1508eae3','62d7cda42865013c9a6442fe1508eae3','62d7cda42865013c9a6442fe1508eae3','8888','8888','8888','8888','888','888','8888','888','8888','8888','88888','2021-06-17 13:26:37','88888','88888'),(14,'a0267151f6dd65cac8978b0360c886ef',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1beb8e23c174b5103902a343e7617c31','1beb8e23c174b5103902a343e7617c31','1beb8e23c174b5103902a343e7617c31','1beb8e23c174b5103902a343e7617c31','8888','8888','8888','8888','888','888','8888','888','8888','8888','88888','2021-06-17 13:26:49','88888','88888'),(15,'a0267151f6dd65cac8978b0360c886ef',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'8504b4e4c649e3fe86785f8775f269dd','8504b4e4c649e3fe86785f8775f269dd','8504b4e4c649e3fe86785f8775f269dd','8504b4e4c649e3fe86785f8775f269dd','8888','8888','8888','8888','888','888','8888','888','8888','8888','88888','2021-06-17 13:27:24','88888','88888');
/*!40000 ALTER TABLE `tbl_edited_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_invoice`
--

DROP TABLE IF EXISTS `tbl_invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `cashier_name` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `time_order` varchar(50) NOT NULL,
  `total` float NOT NULL,
  `paid` float NOT NULL,
  `due` float NOT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_invoice`
--

LOCK TABLES `tbl_invoice` WRITE;
/*!40000 ALTER TABLE `tbl_invoice` DISABLE KEYS */;
INSERT INTO `tbl_invoice` VALUES (34,'Koko','2019-10-26','10:47',440000,450000,-10000),(35,'aji','2019-11-04','21:20',440000,450000,-10000),(36,'aji','2019-11-04','22:11',290000,300000,-10000),(38,'aji','2019-11-05','13:13',380000,500000,-120000),(41,'aji','2019-11-26','11:12',320000,330000,-10000),(44,'aji','2019-11-26','12:07',285000,300000,-15000),(46,'aji','2019-11-27','18:42',412000,415000,-3000),(47,'aji','2019-12-01','11:45',190000,200000,-10000),(49,'aji','2019-12-02','22:26',22000,23000,-1000),(50,'aji','2019-12-02','22:32',520000,600000,-80000),(51,'aji','2019-12-03','09:17',88000,90000,-2000),(63,'aji','2019-12-03','15:51',66000,200000,66000),(64,'aji','2019-12-03','15:52',66000,66000,0),(65,'aji','2019-12-03','15:52',66000,66000,0),(66,'aji','2019-12-03','15:52',66000,66000,0),(67,'aji','2019-12-03','15:58',329000,330000,-1000),(68,'aji','2019-12-03','15:58',44000,44000,0),(69,'aji','2019-12-03','16:01',285000,300000,-15000),(70,'aji','2019-12-03','16:01',285000,300000,-15000),(71,'aji','2019-12-03','16:08',285000,300000,-15000),(72,'aji','2019-12-03','16:15',950000,1000000,-50000),(73,'aji','2019-12-03','16:17',190000,200000,-10000),(74,'aji','2019-12-03','16:20',66000,66000,0),(75,'aji','2019-12-03','16:26',760000,770000,-10000),(76,'aji','2019-12-03','16:27',950000,1000000,-50000),(77,'aji','2019-12-03','16:34',190000,200000,-10000),(79,'aji','2019-12-03','16:43',88000,90000,-2000),(80,'aji','2019-12-03','16:43',88000,90000,-2000),(81,'aji','2019-12-03','16:57',22000,30000,-8000),(82,'aji','2019-12-03','16:58',380000,400000,-20000),(84,'aji','2019-12-03','17:02',190000,200000,-10000),(87,'test.erick','2021-06-13','02:26',195000,88,195000);
/*!40000 ALTER TABLE `tbl_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_invoice_detail`
--

DROP TABLE IF EXISTS `tbl_invoice_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_invoice_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` char(6) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` float NOT NULL,
  `total` float NOT NULL,
  `order_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=137 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_invoice_detail`
--

LOCK TABLES `tbl_invoice_detail` WRITE;
/*!40000 ALTER TABLE `tbl_invoice_detail` DISABLE KEYS */;
INSERT INTO `tbl_invoice_detail` VALUES (47,31,2,'TT0001','Triplek Tipis',1,22000,22000,'2019-10-25'),(48,31,12,'TT0040','Triplek Sedang',1,95000,95000,'2019-10-25'),(49,32,14,'RR0022','Round Cable Clips',2,35000,70000,'2019-10-26'),(50,32,15,'DA0001','Bola Lampu Philips',3,65000,195000,'2019-10-26'),(52,34,16,'BL0004','Bola Lampu Philips',2,125000,250000,'2019-10-26'),(53,34,12,'TT0040','Triplek Sedang',2,95000,190000,'2019-10-26'),(54,35,12,'TT0040','Triplek Sedang',2,95000,190000,'2019-11-04'),(55,35,16,'BL0004','Bola Lampu Philips',2,125000,250000,'2019-11-04'),(56,36,17,'BLH001','Bola Lampu Hannochs',2,20000,40000,'2019-11-04'),(57,36,16,'BL0004','Bola Lampu Philips',2,125000,250000,'2019-11-04'),(58,37,2,'TT0001','Triplek Tipis',1,22000,22000,'2019-11-04'),(59,37,12,'TT0040','Triplek Sedang',1,95000,95000,'2019-11-04'),(60,38,12,'TT0040','Triplek Sedang',4,95000,380000,'2019-11-05'),(61,39,2,'TT0001','Triplek Tipis',2,22000,44000,'2019-11-22'),(62,40,2,'TT0001','Triplek Tipis',1,22000,22000,'2019-11-26'),(63,41,12,'TT0040','Triplek Sedang',3,95000,285000,'2019-11-26'),(64,41,14,'RR0022','Round Cable Clips',1,35000,35000,'2019-11-26'),(65,42,12,'TT0040','Triplek Sedang',3,95000,285000,'0000-00-00'),(66,43,12,'TT0040','Triplek Sedang',2,95000,190000,'0000-00-00'),(67,44,12,'TT0040','Triplek Sedang',3,95000,285000,'2019-11-26'),(68,45,12,'TT0040','Triplek Sedang',2,95000,190000,'2019-11-26'),(69,45,14,'RR0022','Round Cable Clips',2,35000,70000,'2019-11-26'),(70,46,2,'TT0001','Triplek Tipis',1,22000,22000,'2019-11-27'),(71,46,12,'TT0040','Triplek Sedang',3,95000,285000,'2019-11-27'),(72,46,14,'RR0022','Round Cable Clips',3,35000,105000,'2019-11-27'),(73,47,12,'TT0040','Triplek Sedang',2,95000,190000,'2019-12-01'),(74,48,20,'TT0022','Test',2,22000,44000,'2019-12-01'),(75,49,2,'TT0001','Triplek Tipis',1,22000,22000,'2019-12-02'),(76,50,15,'DA0001','Bola Lampu Philips',8,65000,520000,'2019-12-02'),(87,0,12,'TT0040','Triplek Sedang',0,95000,0,'2019-12-02'),(88,0,14,'RR0022','Round Cable Clips',0,35000,0,'2019-12-02'),(89,0,14,'RR0022','Round Cable Clips',0,35000,0,'2019-12-03'),(90,0,14,'RR0022','Round Cable Clips',0,35000,0,'2019-12-03'),(91,0,14,'RR0022','Round Cable Clips',2,35000,70000,'2019-12-03'),(92,0,14,'RR0022','Round Cable Clips',0,35000,0,'2019-12-03'),(93,0,14,'RR0022','Round Cable Clips',0,35000,0,'2019-12-03'),(94,0,16,'BL0004','Bola Lampu Philips',0,125000,0,'2019-12-03'),(95,0,15,'DA0001','Bola Lampu Philips',0,65000,0,'2019-12-03'),(96,0,18,'BB0002','Lorem Ipsum',0,22000,0,'2019-12-03'),(97,0,21,'RR0002','Rounded Rumble',3,24000,72000,'2019-12-03'),(98,0,2,'TT0001','Triplek Tipis',3,22000,66000,'2019-12-03'),(99,51,2,'TT0001','Triplek Tipis',4,22000,88000,'2019-12-03'),(103,55,2,'TT0001','Triplek Tipis',0,22000,0,'2019-12-03'),(104,56,2,'TT0001','Triplek Tipis',0,22000,0,'2019-12-03'),(106,58,2,'TT0001','Triplek Tipis',0,22000,0,'2019-12-03'),(107,59,2,'TT0001','Triplek Tipis',0,22000,0,'2019-12-03'),(110,62,2,'TT0001','Triplek Tipis',0,22000,0,'2019-12-03'),(111,63,2,'TT0001','Triplek Tipis',3,22000,66000,'2019-12-03'),(112,64,2,'TT0001','Triplek Tipis',3,22000,66000,'2019-12-03'),(113,65,2,'TT0001','Triplek Tipis',3,22000,66000,'2019-12-03'),(114,66,2,'TT0001','Triplek Tipis',3,22000,66000,'2019-12-03'),(115,67,2,'TT0001','Triplek Tipis',2,22000,44000,'2019-12-03'),(116,67,12,'TT0040','Triplek Sedang',3,95000,285000,'2019-12-03'),(117,68,2,'TT0001','Triplek Tipis',2,22000,44000,'2019-12-03'),(118,69,12,'TT0040','Triplek Sedang',3,95000,285000,'2019-12-03'),(119,70,12,'TT0040','Triplek Sedang',3,95000,285000,'2019-12-03'),(120,71,12,'TT0040','Triplek Sedang',3,95000,285000,'2019-12-03'),(121,72,12,'TT0040','Triplek Sedang',10,95000,950000,'2019-12-03'),(122,73,12,'TT0040','Triplek Sedang',2,95000,190000,'2019-12-03'),(123,74,2,'TT0001','Triplek Tipis',3,22000,66000,'2019-12-03'),(124,75,12,'TT0040','Triplek Sedang',8,95000,760000,'2019-12-03'),(125,76,12,'TT0040','Triplek Sedang',10,95000,950000,'2019-12-03'),(126,77,12,'TT0040','Triplek Sedang',2,95000,190000,'2019-12-03'),(128,79,2,'TT0001','Triplek Tipis',4,22000,88000,'2019-12-03'),(129,80,2,'TT0001','Triplek Tipis',4,22000,88000,'2019-12-03'),(130,81,2,'TT0001','Triplek Tipis',1,22000,22000,'2019-12-03'),(131,82,12,'TT0040','Triplek Sedang',4,95000,380000,'2019-12-03'),(133,84,12,'TT0040','Triplek Sedang',2,95000,190000,'2019-12-03');
/*!40000 ALTER TABLE `tbl_invoice_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `vehicleclass` varchar(255) DEFAULT NULL,
  `underwriter` varchar(255) DEFAULT NULL,
  `coverage` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `clauses` varchar(255) DEFAULT NULL,
  `conditionsandwaranties` varchar(255) DEFAULT NULL,
  `optionalname` varchar(255) DEFAULT NULL,
  `optionalpremium` varchar(255) DEFAULT NULL,
  `optionalrate` varchar(255) DEFAULT NULL,
  `policylimits` varchar(255) DEFAULT NULL,
  `mintonnage` varchar(255) DEFAULT NULL,
  `maxtonnage` varchar(255) DEFAULT NULL,
  `weeklyrates` varchar(255) DEFAULT NULL,
  `fortnightrates` varchar(255) DEFAULT NULL,
  `passangers` varchar(255) DEFAULT NULL,
  `monthlyrates` varchar(255) DEFAULT NULL,
  `annualrates` varchar(255) DEFAULT NULL,
  `excludedvehicles` varchar(255) DEFAULT NULL,
  `minimumpremium` varchar(255) DEFAULT NULL,
  `maxage` varchar(255) DEFAULT NULL,
  `minage` varchar(255) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `maxsum` varchar(255) DEFAULT NULL,
  `minsum` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  UNIQUE KEY `product_code` (`product_code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_product`
--

LOCK TABLES `tbl_product` WRITE;
/*!40000 ALTER TABLE `tbl_product` DISABLE KEYS */;
INSERT INTO `tbl_product` VALUES (2,'419e0e4c73649dbdecca3e3d3e71c6d2','Bimaplus','2. PSV (bodaboda)','Africa Merchant Assurance Company Limited','Third Party Only','54545','455','5455','','','','5454','','','','','','','5454','','','','','2021-06-17 12:41:03','5454','54545'),(3,'9edb08b1de9a199e5033ac479115f149','Bimaplus','16. PSV - Taxi','Africa Merchant Assurance Company Limited','Third Party Only','ewewew','ewewe','ewewew','','','','ewewewe','','','','','','','45','','','','','2021-06-17 12:42:34','100','100');
/*!40000 ALTER TABLE `tbl_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_satuan`
--

DROP TABLE IF EXISTS `tbl_satuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_satuan` (
  `kd_satuan` int(2) NOT NULL AUTO_INCREMENT,
  `nm_satuan` varchar(20) NOT NULL,
  PRIMARY KEY (`kd_satuan`),
  UNIQUE KEY `nm_satuan` (`nm_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_satuan`
--

LOCK TABLES `tbl_satuan` WRITE;
/*!40000 ALTER TABLE `tbl_satuan` DISABLE KEYS */;
INSERT INTO `tbl_satuan` VALUES (18,'erick');
/*!40000 ALTER TABLE `tbl_satuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_underwriter`
--

DROP TABLE IF EXISTS `tbl_underwriter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_underwriter` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `EMAIL_ADDRESS` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `paybill` varchar(255) DEFAULT NULL,
  `Membercompanyid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_underwriter`
--

LOCK TABLES `tbl_underwriter` WRITE;
/*!40000 ALTER TABLE `tbl_underwriter` DISABLE KEYS */;
INSERT INTO `tbl_underwriter` VALUES (1,'Africa Merchant Assurance Company Limited','img/insurance/amaco-logo.jpeg','erick.soi@iplus.co.ke','Directline is proud to be Kenya’s leading PSV insurer. Furthermore, we are the country’s first niche underwriter to solely focus on motor vehicle insurance.','545400','11'),(2,'AIG Kenya Insurance Company Limited','img/insurance/aig-logo.png','knyaga@iplus.co.ke','eeeeeeeeeeeeeeee','503200','12'),(3,'Allianz Insurance Company of Kenya Limited','img/insurance/alianz-logo.png','knyaga@iplus.co.ke','Small Desc','897356','13'),(4,'APA Insurance Limited','img/insurance/apa-logo.png','knyaga@iplus.co.ke','Small Desc','511600','14'),(5,'Britam General Insurance Company (K) Limited','img/insurance/britam-logo.png','knyaga@iplus.co.ke','Small Desc','111555','15'),(6,'CIC General Insurance Company Limited','img/insurance/cic-logo.png','knyaga@iplus.co.ke','Small Desc','600122','16'),(7,'Corporate Insurance Company Limited','img/insurance/coporate-logo.png','knyaga@iplus.co.ke','Small Desc','942300','17'),(8,'Directline Assurance Company Limited','img/insurance/direct_line-logo.png','knyaga@iplus.co.ke','Directline is proud to be Kenya’s leading PSV insurer. Furthermore, we are the country’s first niche underwriter to solely focus on motor vehicle insurance.','509800','18'),(9,'Fidelity Shield Insurance Company Limited','img/insurance/fidelity-logo.png','knyaga@iplus.co.ke','Small Desc','522799','19'),(10,'First Assurance Company Limited','img/insurance/first_assurance-logo.png','knyaga@iplus.co.ke','Small Desc','898200','20'),(11,'GA Insurance Limited','img/insurance/ga-logo.png','knyaga@iplus.co.ke','Small Desc','870250','21'),(12,'Geminia Insurance Company Limited','img/insurance/geminia-logo.png','knyaga@iplus.co.ke','Small Desc','553200','22'),(13,'ICEA LION General Insurance Company Limited','img/insurance/icea-logo.svg','knyaga@iplus.co.ke','Small Desc','300901','23'),(14,'Intra Africa Assurance Company Limited','img/insurance/intra-logo.png','knyaga@iplus.co.ke','dsdsds','861600','24'),(15,'Invesco Assurance Company Limited','img/insurance/invesco-logo.png','knyaga@iplus.co.ke','Small Desc','980100','25'),(16,'Jubilee General Insurance Limited','img/insurance/jubilee-logo.png','knyaga@iplus.co.ke','Small Desc','7146151','26'),(17,'Kenindia Assurance Company Limited','img/insurance/kenindia-logo.png','knyaga@iplus.co.ke','Small Desc','514600','27'),(18,'Kenya Orient Insurance Limited','img/insurance/kenya_orient-logo.png','knyaga@iplus.co.ke','Small Desc','513200','28'),(19,'Madison General Insurance Kenya Limited','img/insurance/madison-logo.png','knyaga@iplus.co.ke','Small Desc','600802','30'),(20,'Mayfair Insurance Company Limited','img/insurance/madison-logo.png','knyaga@iplus.co.ke','Small Desc','571454','31'),(21,'Metropolitan Cannon Life Assurance Limited','img/insurance/madison-logo.png','knyaga@iplus.co.ke','Small Desc','501800','32'),(22,'Occidental Insurance Company Limited','img/insurance/occidental-logo.png','knyaga@iplus.co.ke','Small Desc','933091','33'),(23,'Pacis Insurance Company Limited','img/insurance/Pacis-logo.jpeg','knyaga@iplus.co.ke','Pacis is a Latin word that means PEACE\r\nPacis, therefore, strives to bring peace and comfort to society by ensuring that all our clients have peace of mind because they know that in the event of a loss, we will be there for them.','504700','34'),(24,'MUA Insurance ( Kenya) Limited 01','img/insurance/mua-logo.png','knyaga@iplus.co.ke','Small Desc','897330','35'),(25,'Pioneer General Insurance Company Limited','img/insurance/pioneer-logo.jpeg','knyaga@iplus.co.ke','Pacis is a Latin word that means PEACE\r\nPacis, therefore, strives to bring peace and comfort to society by ensuring that all our clients have peace of mind because they know that in the event of a loss, we will be there for them.','100500','36'),(26,'Resolution Insurance Company Limited','img/insurance/resolution-logo.jpeg','knyaga@iplus.co.ke','Small Desc','503100','37'),(27,'Saham Assurance Company Kenya Limited','img/insurance/saham.jpeg','knyaga@iplus.co.ke','Small Desc','510200','38'),(28,'Sanlam General Insurance Company Limited','img/insurance/sanlam-logo.png','knyaga@iplus.co.ke','Sanlam Kenya, formerly Pan Africa Insurance Holdings is a Kenyan incorporated diversified financial services group listed on the Nairobi Securities Exchange.','543200','39'),(29,'Takaful Insurance of Africa Limited','img/insurance/takaful-logo.jpeg','knyaga@iplus.co.ke','Small Desc','912900','40'),(30,'Tausi Assurance Company Limited','img/insurance/takaful-logo.jpeg','knyaga@iplus.co.ke','Small Desc','591349','41'),(31,'The Heritage Insurance Company Limited','img/insurance/herritage-logo.png','knyaga@iplus.co.ke','Small Desc','503000','42'),(32,'The Kenyan Alliance Insurance Company Limited','img/insurance/kenya-alliance-logo.png','knyaga@iplus.co.ke','Small Desc','513300','29'),(33,'The Monarch Insurance Company Limited','img/insurance/monarch-logo.png','knyaga@iplus.co.ke','Small Desc','552200','43'),(34,'Trident Insurance Company Limited','img/insurance/trident-logo.jpeg','knyaga@iplus.co.ke','Trident Insurance Company Limited is incorporated in Kenya and licensed to transact   General   insurance   business.  It was   licensed and began full operations in the year 1982.','985852','44'),(35,'UAP Insurance Company Limited','img/insurance/uap-logo.svg','knyaga@iplus.co.ke','Small Desc','505800','45'),(36,'Xplico Insurance Company Limited','img/insurance/xplico-logo.jpeg','knyaga@iplus.co.ke','Small Desc','976710','46'),(38,'Metropolitan Cannon General Insurance Company Limited','img/insurance/metropolitan-logo.png','knyaga@iplus.co.ke','Small Desc','501801',NULL);
/*!40000 ALTER TABLE `tbl_underwriter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(15) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_user`
--

LOCK TABLES `tbl_user` WRITE;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` VALUES (1,'erick.soi','erick soi','erick','Admin',1);
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_vehicleclass`
--

DROP TABLE IF EXISTS `tbl_vehicleclass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_vehicleclass` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `CertTypeNumber` varchar(255) DEFAULT NULL,
  `CertTypeClass` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_vehicleclass`
--

LOCK TABLES `tbl_vehicleclass` WRITE;
/*!40000 ALTER TABLE `tbl_vehicleclass` DISABLE KEYS */;
INSERT INTO `tbl_vehicleclass` VALUES (1,'MOTORCYCLE','Private','4','D'),(2,'MOTORCYCLE','PSV (bodaboda)','9','D'),(3,'MOTORCYCLE','commercial','10','D'),(4,'TRICYCLE','commercial Own goods','10','D'),(5,'TRICYCLE','PSV (tuktuk)','9','D'),(6,'MOTORVEHICLE','Private','NULL','C'),(7,'MOTORVEHICLE','commercial Own goods','1','B'),(8,'MOTORVEHICLE','General Cartage Lorries,Trucks and Tankers','2','B'),(9,'MOTORVEHICLE','Agricultural and Forestry vehicles','2','B'),(10,'MOTORVEHICLE','Chauffeur driven','1','A'),(11,'MOTORVEHICLE','Motor trade','6','B'),(12,'MOTORVEHICLE','Institutional Vehicles','3','B'),(13,'MOTORVEHICLE','Driving school Vehicle','3','B'),(14,'MOTORVEHICLE','Tour Service Vehicles','1','A'),(15,'MOTORVEHICLE','PSV - Matatu','7','A'),(16,'MOTORVEHICLE','PSV - Taxi','8','A'),(17,'MOTORVEHICLE','PSV - BUS','6','A'),(18,'MOTORVEHICLE','Ambulance and fire fighters','4','B'),(19,'MOTORVEHICLE','Forklift,Crane, Rollers and Excavators','2','B'),(20,'MOTORVEHICLE','UBER','1','A'),(21,'MOTORVEHICLE','TANKER(LIQUID CARRYING)','5','B');
/*!40000 ALTER TABLE `tbl_vehicleclass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `underwriters`
--

DROP TABLE IF EXISTS `underwriters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `underwriters` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `EMAIL_ADDRESS` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `paybill` varchar(255) DEFAULT NULL,
  `Membercompanyid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `underwriters`
--

LOCK TABLES `underwriters` WRITE;
/*!40000 ALTER TABLE `underwriters` DISABLE KEYS */;
INSERT INTO `underwriters` VALUES (1,'Africa Merchant Assurance Company Limited','img/insurance/amaco-logo.jpeg','erick.soi@iplus.co.ke','Directline is proud to be Kenya’s leading PSV insurer. Furthermore, we are the country’s first niche underwriter to solely focus on motor vehicle insurance.','545400','11'),(2,'AIG Kenya Insurance Company Limited','img/insurance/aig-logo.png','knyaga@iplus.co.ke','eeeeeeeeeeeeeeee','503200','12'),(3,'Allianz Insurance Company of Kenya Limited','img/insurance/alianz-logo.png','knyaga@iplus.co.ke','Small Desc','897356','13'),(4,'APA Insurance Limited','img/insurance/apa-logo.png','knyaga@iplus.co.ke','Small Desc','511600','14'),(5,'Britam General Insurance Company (K) Limited','img/insurance/britam-logo.png','knyaga@iplus.co.ke','Small Desc','111555','15'),(6,'CIC General Insurance Company Limited','img/insurance/cic-logo.png','knyaga@iplus.co.ke','Small Desc','600122','16'),(7,'Corporate Insurance Company Limited','img/insurance/coporate-logo.png','knyaga@iplus.co.ke','Small Desc','942300','17'),(8,'Directline Assurance Company Limited','img/insurance/direct_line-logo.png','knyaga@iplus.co.ke','Directline is proud to be Kenya’s leading PSV insurer. Furthermore, we are the country’s first niche underwriter to solely focus on motor vehicle insurance.','509800','18'),(9,'Fidelity Shield Insurance Company Limited','img/insurance/fidelity-logo.png','knyaga@iplus.co.ke','Small Desc','522799','19'),(10,'First Assurance Company Limited','img/insurance/first_assurance-logo.png','knyaga@iplus.co.ke','Small Desc','898200','20'),(11,'GA Insurance Limited','img/insurance/ga-logo.png','knyaga@iplus.co.ke','Small Desc','870250','21'),(12,'Geminia Insurance Company Limited','img/insurance/geminia-logo.png','knyaga@iplus.co.ke','Small Desc','553200','22'),(13,'ICEA LION General Insurance Company Limited','img/insurance/icea-logo.svg','knyaga@iplus.co.ke','Small Desc','300901','23'),(14,'Intra Africa Assurance Company Limited','img/insurance/intra-logo.png','knyaga@iplus.co.ke','dsdsds','861600','24'),(15,'Invesco Assurance Company Limited','img/insurance/invesco-logo.png','knyaga@iplus.co.ke','Small Desc','980100','25'),(16,'Jubilee General Insurance Limited','img/insurance/jubilee-logo.png','knyaga@iplus.co.ke','Small Desc','7146151','26'),(17,'Kenindia Assurance Company Limited','img/insurance/kenindia-logo.png','knyaga@iplus.co.ke','Small Desc','514600','27'),(18,'Kenya Orient Insurance Limited','img/insurance/kenya_orient-logo.png','knyaga@iplus.co.ke','Small Desc','513200','28'),(19,'Madison General Insurance Kenya Limited','img/insurance/madison-logo.png','knyaga@iplus.co.ke','Small Desc','600802','30'),(20,'Mayfair Insurance Company Limited','img/insurance/madison-logo.png','knyaga@iplus.co.ke','Small Desc','571454','31'),(21,'Metropolitan Cannon Life Assurance Limited','img/insurance/madison-logo.png','knyaga@iplus.co.ke','Small Desc','501800','32'),(22,'Occidental Insurance Company Limited','img/insurance/occidental-logo.png','knyaga@iplus.co.ke','Small Desc','933091','33'),(23,'Pacis Insurance Company Limited','img/insurance/Pacis-logo.jpeg','knyaga@iplus.co.ke','Pacis is a Latin word that means PEACE\r\nPacis, therefore, strives to bring peace and comfort to society by ensuring that all our clients have peace of mind because they know that in the event of a loss, we will be there for them.','504700','34'),(24,'MUA Insurance ( Kenya) Limited 01','img/insurance/mua-logo.png','knyaga@iplus.co.ke','Small Desc','897330','35'),(25,'Pioneer General Insurance Company Limited','img/insurance/pioneer-logo.jpeg','knyaga@iplus.co.ke','Pacis is a Latin word that means PEACE\r\nPacis, therefore, strives to bring peace and comfort to society by ensuring that all our clients have peace of mind because they know that in the event of a loss, we will be there for them.','100500','36'),(26,'Resolution Insurance Company Limited','img/insurance/resolution-logo.jpeg','knyaga@iplus.co.ke','Small Desc','503100','37'),(27,'Saham Assurance Company Kenya Limited','img/insurance/saham.jpeg','knyaga@iplus.co.ke','Small Desc','510200','38'),(28,'Sanlam General Insurance Company Limited','img/insurance/sanlam-logo.png','knyaga@iplus.co.ke','Sanlam Kenya, formerly Pan Africa Insurance Holdings is a Kenyan incorporated diversified financial services group listed on the Nairobi Securities Exchange.','543200','39'),(29,'Takaful Insurance of Africa Limited','img/insurance/takaful-logo.jpeg','knyaga@iplus.co.ke','Small Desc','912900','40'),(30,'Tausi Assurance Company Limited','img/insurance/takaful-logo.jpeg','knyaga@iplus.co.ke','Small Desc','591349','41'),(31,'The Heritage Insurance Company Limited','img/insurance/herritage-logo.png','knyaga@iplus.co.ke','Small Desc','503000','42'),(32,'The Kenyan Alliance Insurance Company Limited','img/insurance/kenya-alliance-logo.png','knyaga@iplus.co.ke','Small Desc','513300','29'),(33,'The Monarch Insurance Company Limited','img/insurance/monarch-logo.png','knyaga@iplus.co.ke','Small Desc','552200','43'),(34,'Trident Insurance Company Limited','img/insurance/trident-logo.jpeg','knyaga@iplus.co.ke','Trident Insurance Company Limited is incorporated in Kenya and licensed to transact   General   insurance   business.  It was   licensed and began full operations in the year 1982.','985852','44'),(35,'UAP Insurance Company Limited','img/insurance/uap-logo.svg','knyaga@iplus.co.ke','Small Desc','505800','45'),(36,'Xplico Insurance Company Limited','img/insurance/xplico-logo.jpeg','knyaga@iplus.co.ke','Small Desc','976710','46'),(38,'Metropolitan Cannon General Insurance Company Limited','img/insurance/metropolitan-logo.png','knyaga@iplus.co.ke','Small Desc','501801',NULL);
/*!40000 ALTER TABLE `underwriters` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-06-17 17:45:45
