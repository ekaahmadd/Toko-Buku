/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.8-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: toko_buku1
-- ------------------------------------------------------
-- Server version	10.11.8-MariaDB-0ubuntu0.24.04.1

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
-- Table structure for table `buku`
--

DROP TABLE IF EXISTS `buku`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `noisbn` varchar(100) DEFAULT NULL,
  `penulis` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `stok` int(50) DEFAULT NULL,
  `harga_pokok` int(255) DEFAULT NULL,
  `harga_jual` int(255) DEFAULT NULL,
  `gambar` varchar(50) NOT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buku`
--

LOCK TABLES `buku` WRITE;
/*!40000 ALTER TABLE `buku` DISABLE KEYS */;
INSERT INTO `buku` VALUES
(22,'The Unofficial Ultimate Harry Potter Spellbook','9781948174244','Media Lab Books','Macmillan Us',2019,75,250,250,'183-buku1.jpg'),
(23,'Harry Potter And The Order Of The Phoenix','9781338299182','J.K. Rowling','Sinar Star Book',2023,89,260,260,'831-buku2.jpg'),
(24,'Godkiller','9780008521479','Hannah Kaner','HARPER COLLINS UK',2024,86,303,303,'940-buku3.jpg');
/*!40000 ALTER TABLE `buku` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distributor`
--

DROP TABLE IF EXISTS `distributor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distributor` (
  `id_distributor` int(11) NOT NULL AUTO_INCREMENT,
  `nama_distributor` varchar(100) DEFAULT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_distributor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distributor`
--

LOCK TABLES `distributor` WRITE;
/*!40000 ALTER TABLE `distributor` DISABLE KEYS */;
INSERT INTO `distributor` VALUES
(6,'Eka Ahmad Wahyudi','Sawojajar, Malang','083138920779'),
(7,'Eka Ahmad','Sawojajar','083138920779');
/*!40000 ALTER TABLE `distributor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kasir`
--

DROP TABLE IF EXISTS `kasir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kasir` (
  `id_kasir` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `status` enum('active','nonactive') NOT NULL,
  `username` varchar(155) NOT NULL,
  `password` varchar(155) NOT NULL,
  `level` varchar(50) NOT NULL,
  PRIMARY KEY (`id_kasir`),
  UNIQUE KEY `id_kasir` (`id_kasir`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kasir`
--

LOCK TABLES `kasir` WRITE;
/*!40000 ALTER TABLE `kasir` DISABLE KEYS */;
INSERT INTO `kasir` VALUES
(7,'ekahmdd','Sawojajar, Malang','083138920779','active','ekahmdd','21232f297a57a5a743894a0e4a801fc3','admin'),
(8,'Eka Ahmad Wahyudi','Sawojajar, Malang','083138920779','nonactive','ahmadeka','21232f297a57a5a743894a0e4a801fc3','kasir');
/*!40000 ALTER TABLE `kasir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pasok`
--

DROP TABLE IF EXISTS `pasok`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pasok` (
  `id_pasok` int(11) NOT NULL AUTO_INCREMENT,
  `id_distributor` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `jumlah` int(20) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_pasok`),
  KEY `id_distributor` (`id_distributor`),
  KEY `id_buku` (`id_buku`),
  CONSTRAINT `pasok_ibfk_1` FOREIGN KEY (`id_distributor`) REFERENCES `distributor` (`id_distributor`),
  CONSTRAINT `pasok_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pasok`
--

LOCK TABLES `pasok` WRITE;
/*!40000 ALTER TABLE `pasok` DISABLE KEYS */;
INSERT INTO `pasok` VALUES
(33,6,22,2,'2024-11-08'),
(34,6,22,3,'2024-11-08'),
(35,6,22,2,'2024-11-08');
/*!40000 ALTER TABLE `pasok` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trigger_tambah_buku` AFTER INSERT ON `pasok` FOR EACH ROW BEGIN
UPDATE buku SET stok=stok+new.jumlah
WHERE id_buku=new.id_buku;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `penjualan`
--

DROP TABLE IF EXISTS `penjualan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL AUTO_INCREMENT,
  `id_buku` int(11) DEFAULT NULL,
  `id_kasir` int(100) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `total` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id_penjualan`),
  KEY `id_kasir` (`id_kasir`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penjualan`
--

LOCK TABLES `penjualan` WRITE;
/*!40000 ALTER TABLE `penjualan` DISABLE KEYS */;
INSERT INTO `penjualan` VALUES
(25,24,0,2,'0','2024-11-08'),
(26,23,0,2,'0','2024-11-08'),
(27,23,0,2,'0','2024-11-08'),
(28,22,0,2,'0','2024-11-08'),
(29,22,0,2,'0','2024-11-08'),
(30,22,0,2,'0','2024-11-08'),
(31,23,0,2,'520','2024-11-08'),
(32,22,0,2,'500','2024-11-08'),
(33,22,0,2,'500','2024-11-08'),
(34,23,0,1,'260','2024-11-08'),
(35,22,0,2,'','2024-11-08'),
(36,22,0,1,'','2024-11-08'),
(37,22,0,2,'','2024-11-08'),
(38,22,0,1,'','2024-11-08'),
(39,22,0,1,'250','2024-11-08'),
(40,24,0,5,'1515','2024-11-08'),
(41,22,0,2,'500','2024-11-08'),
(42,23,0,3,'780','2024-11-08'),
(43,22,0,2,'500000','2024-11-08'),
(44,24,0,2,'0000','2024-11-08'),
(45,23,0,1,'260000','2024-11-08'),
(46,22,0,1,'250000','2024-11-08'),
(47,22,0,2,'500000','2024-11-08'),
(48,22,0,2,'500000','2024-11-08'),
(49,22,0,2,'500000','2024-11-08'),
(56,22,7,1,'250000','2024-11-08'),
(57,24,7,1,'303000','2024-11-08');
/*!40000 ALTER TABLE `penjualan` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER validate_penjualan_stok
BEFORE INSERT ON penjualan
FOR EACH ROW
BEGIN
    DECLARE stok_buku INT;

    
    SELECT stok INTO stok_buku FROM buku WHERE id_buku = NEW.id_buku;
    
    
    IF NEW.jumlah > stok_buku THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Jumlah yang dijual melebihi stok yang tersedia';
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb3 */ ;
/*!50003 SET character_set_results = utf8mb3 */ ;
/*!50003 SET collation_connection  = utf8mb3_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER update_stok_after_penjualan
AFTER INSERT ON penjualan
FOR EACH ROW
BEGIN
    DECLARE stok_buku INT;

    
    SELECT stok INTO stok_buku FROM buku WHERE id_buku = NEW.id_buku;

    
    UPDATE buku
    SET stok = stok_buku - NEW.jumlah
    WHERE id_buku = NEW.id_buku;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-11 10:13:00
