-- MySQL dump 10.13  Distrib 5.7.27-30, for Linux (x86_64)
--
-- Host: localhost    Database: u1138188_tester
-- ------------------------------------------------------
-- Server version	5.7.27-30

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
/*!50717 SELECT COUNT(*) INTO @rocksdb_has_p_s_session_variables FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'performance_schema' AND TABLE_NAME = 'session_variables' */;
/*!50717 SET @rocksdb_get_is_supported = IF (@rocksdb_has_p_s_session_variables, 'SELECT COUNT(*) INTO @rocksdb_is_supported FROM performance_schema.session_variables WHERE VARIABLE_NAME=\'rocksdb_bulk_load\'', 'SELECT 0') */;
/*!50717 PREPARE s FROM @rocksdb_get_is_supported */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;
/*!50717 SET @rocksdb_enable_bulk_load = IF (@rocksdb_is_supported, 'SET SESSION rocksdb_bulk_load = 1', 'SET @rocksdb_dummy_bulk_load = 0') */;
/*!50717 PREPARE s FROM @rocksdb_enable_bulk_load */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;

--
-- Table structure for table `db_bonus`
--

DROP TABLE IF EXISTS `db_bonus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_bonus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `login` varchar(50) NOT NULL,
  `sum` float(10,2) NOT NULL,
  `add` int(11) NOT NULL DEFAULT '0',
  `del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_bonus`
--

LOCK TABLES `db_bonus` WRITE;
/*!40000 ALTER TABLE `db_bonus` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_bonus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_bonus2`
--

DROP TABLE IF EXISTS `db_bonus2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_bonus2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `login` varchar(50) NOT NULL,
  `sum` float(10,2) NOT NULL,
  `add` int(11) NOT NULL DEFAULT '0',
  `del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_bonus2`
--

LOCK TABLES `db_bonus2` WRITE;
/*!40000 ALTER TABLE `db_bonus2` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_bonus2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_bonus3`
--

DROP TABLE IF EXISTS `db_bonus3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_bonus3` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `login` varchar(50) NOT NULL,
  `sum` float(10,2) NOT NULL,
  `add` int(11) NOT NULL DEFAULT '0',
  `del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_bonus3`
--

LOCK TABLES `db_bonus3` WRITE;
/*!40000 ALTER TABLE `db_bonus3` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_bonus3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_bonus4`
--

DROP TABLE IF EXISTS `db_bonus4`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_bonus4` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `login` varchar(50) NOT NULL,
  `sum` float(10,4) NOT NULL,
  `add` int(11) NOT NULL DEFAULT '0',
  `del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_bonus4`
--

LOCK TABLES `db_bonus4` WRITE;
/*!40000 ALTER TABLE `db_bonus4` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_bonus4` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_bonus5`
--

DROP TABLE IF EXISTS `db_bonus5`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_bonus5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `login` varchar(50) NOT NULL,
  `sum` float(10,4) NOT NULL,
  `add` int(11) NOT NULL DEFAULT '0',
  `del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_bonus5`
--

LOCK TABLES `db_bonus5` WRITE;
/*!40000 ALTER TABLE `db_bonus5` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_bonus5` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_bonus6`
--

DROP TABLE IF EXISTS `db_bonus6`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_bonus6` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `login` varchar(50) NOT NULL,
  `sum` float(10,4) NOT NULL,
  `add` int(11) NOT NULL DEFAULT '0',
  `del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_bonus6`
--

LOCK TABLES `db_bonus6` WRITE;
/*!40000 ALTER TABLE `db_bonus6` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_bonus6` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_conf`
--

DROP TABLE IF EXISTS `db_conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coint` int(11) NOT NULL,
  `bounty` int(11) NOT NULL,
  `p_sell` int(11) NOT NULL,
  `p_swap` int(11) NOT NULL,
  `min_s` float(10,2) NOT NULL,
  `acc_pay` int(11) NOT NULL,
  `price_link` int(2) NOT NULL DEFAULT '5',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_conf`
--

LOCK TABLES `db_conf` WRITE;
/*!40000 ALTER TABLE `db_conf` DISABLE KEYS */;
INSERT INTO `db_conf` VALUES (1,1,0,80,0,0.10,0,5);
/*!40000 ALTER TABLE `db_conf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_contest_inv`
--

DROP TABLE IF EXISTS `db_contest_inv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_contest_inv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `1m` double NOT NULL DEFAULT '0',
  `2m` double NOT NULL DEFAULT '0',
  `3m` double NOT NULL DEFAULT '0',
  `4m` double NOT NULL DEFAULT '0',
  `5m` double NOT NULL DEFAULT '0',
  `user_1` varchar(30) NOT NULL DEFAULT '',
  `user_2` varchar(30) NOT NULL DEFAULT '',
  `user_3` varchar(30) NOT NULL DEFAULT '',
  `user_4` varchar(30) NOT NULL DEFAULT '',
  `user_5` varchar(30) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_end` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_contest_inv`
--

LOCK TABLES `db_contest_inv` WRITE;
/*!40000 ALTER TABLE `db_contest_inv` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_contest_inv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_contest_inv_u`
--

DROP TABLE IF EXISTS `db_contest_inv_u`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_contest_inv_u` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `points` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_contest_inv_u`
--

LOCK TABLES `db_contest_inv_u` WRITE;
/*!40000 ALTER TABLE `db_contest_inv_u` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_contest_inv_u` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_contest_ref`
--

DROP TABLE IF EXISTS `db_contest_ref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_contest_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `1m` double NOT NULL DEFAULT '0',
  `2m` double NOT NULL DEFAULT '0',
  `3m` double NOT NULL DEFAULT '0',
  `4m` double NOT NULL DEFAULT '0',
  `5m` double NOT NULL DEFAULT '0',
  `user_1` varchar(30) NOT NULL DEFAULT '',
  `user_2` varchar(30) NOT NULL DEFAULT '',
  `user_3` varchar(30) NOT NULL DEFAULT '',
  `user_4` varchar(30) NOT NULL DEFAULT '',
  `user_5` varchar(30) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  `date_end` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_contest_ref`
--

LOCK TABLES `db_contest_ref` WRITE;
/*!40000 ALTER TABLE `db_contest_ref` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_contest_ref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_contest_ref_u`
--

DROP TABLE IF EXISTS `db_contest_ref_u`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_contest_ref_u` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(10) NOT NULL,
  `uid` int(11) NOT NULL,
  `points` double NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_contest_ref_u`
--

LOCK TABLES `db_contest_ref_u` WRITE;
/*!40000 ALTER TABLE `db_contest_ref_u` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_contest_ref_u` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_insert`
--

DROP TABLE IF EXISTS `db_insert`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_insert` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `sum` float(10,2) NOT NULL,
  `sum_x` float(10,2) NOT NULL,
  `sys` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `add` int(11) NOT NULL,
  `end` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_insert`
--

LOCK TABLES `db_insert` WRITE;
/*!40000 ALTER TABLE `db_insert` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_insert` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_leader`
--

DROP TABLE IF EXISTS `db_leader`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_leader` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `login` varchar(20) NOT NULL DEFAULT 'first',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_leader`
--

LOCK TABLES `db_leader` WRITE;
/*!40000 ALTER TABLE `db_leader` DISABLE KEYS */;
INSERT INTO `db_leader` VALUES (1,2560,'Eugene');
/*!40000 ALTER TABLE `db_leader` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_liders`
--

DROP TABLE IF EXISTS `db_liders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_liders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `1m` double NOT NULL DEFAULT '0',
  `2m` double NOT NULL DEFAULT '0',
  `3m` double NOT NULL DEFAULT '0',
  `4m` double NOT NULL DEFAULT '0',
  `5m` double NOT NULL DEFAULT '0',
  `u1` varchar(30) NOT NULL DEFAULT '',
  `u2` varchar(30) NOT NULL DEFAULT '',
  `u3` varchar(30) NOT NULL DEFAULT '',
  `u4` varchar(30) NOT NULL DEFAULT '',
  `u5` varchar(30) NOT NULL DEFAULT '',
  `bank` double NOT NULL DEFAULT '0',
  `date_add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_liders`
--

LOCK TABLES `db_liders` WRITE;
/*!40000 ALTER TABLE `db_liders` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_liders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_links`
--

DROP TABLE IF EXISTS `db_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `text` varchar(18) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `count` int(5) NOT NULL DEFAULT '0',
  `date_add` int(15) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_links`
--

LOCK TABLES `db_links` WRITE;
/*!40000 ALTER TABLE `db_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_loto_wins`
--

DROP TABLE IF EXISTS `db_loto_wins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_loto_wins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `num_bill` int(11) NOT NULL,
  `sum` decimal(10,2) NOT NULL,
  `add` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_loto_wins`
--

LOCK TABLES `db_loto_wins` WRITE;
/*!40000 ALTER TABLE `db_loto_wins` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_loto_wins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_news`
--

DROP TABLE IF EXISTS `db_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `cat` int(11) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `add` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_news`
--

LOCK TABLES `db_news` WRITE;
/*!40000 ALTER TABLE `db_news` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_payout`
--

DROP TABLE IF EXISTS `db_payout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_payout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `purse` varchar(20) NOT NULL,
  `sum` double NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `sys` int(11) NOT NULL,
  `add` int(11) NOT NULL DEFAULT '0',
  `del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_payout`
--

LOCK TABLES `db_payout` WRITE;
/*!40000 ALTER TABLE `db_payout` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_payout` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_percent`
--

DROP TABLE IF EXISTS `db_percent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_percent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `sum_a` int(11) NOT NULL,
  `sum_b` int(11) NOT NULL,
  `sum_x` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_percent`
--

LOCK TABLES `db_percent` WRITE;
/*!40000 ALTER TABLE `db_percent` DISABLE KEYS */;
INSERT INTO `db_percent` VALUES (1,1,1,499,0.10),(2,1,500,999,0.13),(3,1,1000,4999,0.15),(4,1,5000,9999,0.18),(5,1,10000,99999,0.20);
/*!40000 ALTER TABLE `db_percent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_purse`
--

DROP TABLE IF EXISTS `db_purse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_purse` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `payeer` varchar(50) NOT NULL DEFAULT '0',
  `qiwi` varchar(50) NOT NULL DEFAULT '0',
  `yandex` varchar(50) NOT NULL DEFAULT '0',
  `pin` int(11) NOT NULL DEFAULT '0',
  `count` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_purse`
--

LOCK TABLES `db_purse` WRITE;
/*!40000 ALTER TABLE `db_purse` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_purse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_restore`
--

DROP TABLE IF EXISTS `db_restore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_restore` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `ip` int(11) NOT NULL,
  `date_add` int(11) NOT NULL,
  `date_del` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_restore`
--

LOCK TABLES `db_restore` WRITE;
/*!40000 ALTER TABLE `db_restore` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_restore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_reviews`
--

DROP TABLE IF EXISTS `db_reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) NOT NULL,
  `uid` int(11) NOT NULL,
  `text` text NOT NULL,
  `img` int(11) NOT NULL DEFAULT '0',
  `like` int(11) NOT NULL DEFAULT '0',
  `hide` int(11) NOT NULL DEFAULT '0',
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_reviews`
--

LOCK TABLES `db_reviews` WRITE;
/*!40000 ALTER TABLE `db_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_serf`
--

DROP TABLE IF EXISTS `db_serf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_serf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` varchar(70) NOT NULL,
  `url` varchar(255) NOT NULL,
  `price` double(3,2) NOT NULL,
  `view` int(11) NOT NULL DEFAULT '0',
  `balance` double(10,2) NOT NULL DEFAULT '0.00',
  `date_add` int(11) NOT NULL,
  `status` enum('active','deactive') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_serf`
--

LOCK TABLES `db_serf` WRITE;
/*!40000 ALTER TABLE `db_serf` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_serf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_serf_click`
--

DROP TABLE IF EXISTS `db_serf_click`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_serf_click` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ident` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `time_add` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_serf_click`
--

LOCK TABLES `db_serf_click` WRITE;
/*!40000 ALTER TABLE `db_serf_click` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_serf_click` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_serf_item`
--

DROP TABLE IF EXISTS `db_serf_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_serf_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `price` int(11) NOT NULL,
  `timer` int(11) NOT NULL,
  `wind` int(11) NOT NULL,
  `p_user` double(3,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_serf_item`
--

LOCK TABLES `db_serf_item` WRITE;
/*!40000 ALTER TABLE `db_serf_item` DISABLE KEYS */;
INSERT INTO `db_serf_item` VALUES (1,'Эконом',30,10,0,0.03),(2,'Обычный',50,20,1,0.05),(3,'Премиум',60,30,1,0.06);
/*!40000 ALTER TABLE `db_serf_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_stats`
--

DROP TABLE IF EXISTS `db_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users` int(11) NOT NULL,
  `inserts` float(10,2) NOT NULL,
  `payments` float(10,2) NOT NULL,
  `serf` int(25) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_stats`
--

LOCK TABLES `db_stats` WRITE;
/*!40000 ALTER TABLE `db_stats` DISABLE KEYS */;
INSERT INTO `db_stats` VALUES (1,0,0.00,0.00,0);
/*!40000 ALTER TABLE `db_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_store`
--

DROP TABLE IF EXISTS `db_store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `tarif` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `speed` decimal(10,4) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `add` int(15) NOT NULL,
  `end` int(15) NOT NULL,
  `last` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_store`
--

LOCK TABLES `db_store` WRITE;
/*!40000 ALTER TABLE `db_store` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_tarif`
--

DROP TABLE IF EXISTS `db_tarif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_tarif` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `img` int(11) NOT NULL,
  `speed` decimal(10,4) NOT NULL,
  `price` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_tarif`
--

LOCK TABLES `db_tarif` WRITE;
/*!40000 ALTER TABLE `db_tarif` DISABLE KEYS */;
INSERT INTO `db_tarif` VALUES (1,'№1',1,0.0039,10,120),(2,'№2',2,0.0125,30,120),(3,'№3',3,0.0222,50,115),(4,'№4',4,0.0420,90,115),(5,'№5',5,0.0750,150,110),(6,'№6',6,0.1050,200,110),(7,'№7',7,0.2800,500,100),(8,'№8',8,0.4700,800,100),(9,'№9',9,0.7400,1200,90),(10,'№10',10,1.2800,2000,80),(11,'№11',11,3.3000,5000,75),(12,'№12',12,7.0000,10000,70);
/*!40000 ALTER TABLE `db_tarif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `db_users`
--

DROP TABLE IF EXISTS `db_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `db_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `reg` int(11) NOT NULL,
  `auth` int(11) NOT NULL DEFAULT '0',
  `ip` int(50) unsigned NOT NULL,
  `ban` int(1) NOT NULL DEFAULT '0',
  `money_b` float(10,2) NOT NULL,
  `money_p` float(10,2) NOT NULL,
  `sum_in` float(10,2) NOT NULL,
  `sum_out` float(10,2) NOT NULL,
  `speed` decimal(10,4) NOT NULL,
  `last` int(15) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `refsite` varchar(60) NOT NULL,
  `referer` varchar(30) NOT NULL,
  `rid` int(11) NOT NULL DEFAULT '0',
  `refs` int(11) NOT NULL DEFAULT '0',
  `income` float(10,2) NOT NULL,
  `ref_to` float(10,2) NOT NULL,
  `freebet` int(11) NOT NULL DEFAULT '0',
  `today_limit` int(11) NOT NULL DEFAULT '0',
  `pay_limit` int(11) NOT NULL DEFAULT '0',
  `fake` int(11) NOT NULL DEFAULT '0',
  `news` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `db_users`
--

LOCK TABLES `db_users` WRITE;
/*!40000 ALTER TABLE `db_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `db_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!50112 SET @disable_bulk_load = IF (@is_rocksdb_supported, 'SET SESSION rocksdb_bulk_load = @old_rocksdb_bulk_load', 'SET @dummy_rocksdb_bulk_load = 0') */;
/*!50112 PREPARE s FROM @disable_bulk_load */;
/*!50112 EXECUTE s */;
/*!50112 DEALLOCATE PREPARE s */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-09-15 20:35:34
