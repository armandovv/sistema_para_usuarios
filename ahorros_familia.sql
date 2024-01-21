-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: ahorros_familia
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

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
-- Table structure for table `ahorros`
--

DROP TABLE IF EXISTS `ahorros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ahorros` (
  `id_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) DEFAULT NULL,
  `fecha` char(40) DEFAULT NULL,
  `valor_a_ahorrar` float DEFAULT NULL,
  `valor_a_retirar` float DEFAULT NULL,
  `concepto` char(40) DEFAULT NULL,
  PRIMARY KEY (`id_movimiento`),
  KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ahorros`
--

LOCK TABLES `ahorros` WRITE;
/*!40000 ALTER TABLE `ahorros` DISABLE KEYS */;
INSERT INTO `ahorros` VALUES (1,52443188,'2023-01-03',833020,0,'ahorro'),(2,52443188,'2023-01-03',0,7000,'deuda tienda'),(3,52443188,'2023-01-03',0,4560,'pago gas natural'),(4,52443188,'2023-01-03',0,25000,'servicios casa'),(5,52443188,'2023-01-04',150000,0,'consignacion Leonardo'),(6,52443188,'2023-01-19',0,320000,'pago arriendo'),(7,52443188,'2023-01-04',0,4530,'pago gas natural'),(8,52443188,'2023-02-02',150000,0,'consignacion leonardo'),(9,52443188,'2023-02-07',0,15000,'recarga celular'),(10,52443188,'2023-02-15',0,5000,'diligencia tarjeta alejandro'),(11,52443188,'2023-02-17',0,10000,'recarga celular'),(12,1021677489,'2023-02-06',1100,0,'ahorro'),(13,1021677489,'2023-02-06',800,0,'ahorro'),(14,1021677489,'2023-02-07',1300,0,'ahorro'),(15,1021677489,'2023-02-09',1600,0,'ahorro'),(16,1021677489,'2023-02-10',1500,0,'ahorro'),(17,1021677489,'2023-02-12',2000,0,'ahorro'),(18,1021677489,'2023-02-14',1500,0,'ahorro'),(19,1021677489,'2023-02-15',1500,0,'ahorro'),(20,1021677489,'2023-02-17',1500,0,'ahorro'),(21,1021677489,'2023-02-19',2000,0,'ahorro'),(22,1021677489,'2023-02-20',1500,0,'ahorro'),(23,1021677489,'2023-02-22',0,2000,'retiro'),(26,1021677489,'2023-02-22',1000,0,'ahorro'),(27,1021677489,'2023-02-22',0,1000,'retiro'),(28,80209042,'2023-02-23',2000,0,'ahorro'),(29,80209042,'2023-02-26',5000,0,'ahorro'),(31,52443188,'2023-03-02',150000,0,'consignacion Leonardo'),(32,1021677489,'2023-03-03',1500,0,'ahorro'),(33,80209042,'2023-03-04',1000,0,'ahorro'),(34,1021677489,'2023-03-05',0,7500,'retiro'),(36,52443188,'2023-03-09',0,10000,'recarga celular'),(48,1021677489,'2023-03-13',3000,0,'ahorro'),(49,1021677489,'2023-03-14',1600,0,'ahorro'),(50,80209042,'2023-03-18',500,0,'ahorro'),(58,1021677489,'2023-03-22',1000,0,'ahorro'),(59,80209042,'2023-03-24',1000,0,'ahorro'),(61,1021677489,'2023-03-24',2000,0,'ahorro'),(62,52443188,'2023-03-28',0,6000,'transportes medicamento colsubsidio'),(67,1021677489,'2023-03-30',2000,0,'ahorro'),(80,52443188,'2023-04-03',0,8520,'pago gas natural'),(84,52443188,'2023-04-04',150000,0,'consignacion Leonardo'),(87,52443188,'2023-04-08',0,10000,'recarga celular'),(88,1021677489,'2023-04-10',1100,0,'ahorro'),(90,1021677489,'2023-04-18',1500,0,'ahorro'),(92,1021677489,'2023-04-21',4400,0,'ahorro'),(93,52443188,'2023-04-21',0,100000,'prestamo arriendo Jeison'),(94,52443188,'2023-04-23',0,2500,'retiro'),(96,52443188,'2023-04-24',0,20000,''),(97,51637320,'2023-04-26',2570000,0,'ahorro'),(99,52443188,'2023-04-28',0,7000,'transportes medicamentos ARL'),(100,1021677489,'2023-05-01',2000,0,'ahorro'),(102,52443188,'2023-05-03',0,10000,'transportes medicamentos'),(103,52443188,'2023-05-04',150000,0,'consignacion Leonardo'),(104,52443188,'2023-05-04',0,5740,'pago gas natural'),(105,1021677489,'2023-05-05',4000,0,'ahorro'),(106,52443188,'2023-05-07',0,25000,'pago servicios casa'),(107,1021677489,'2023-05-11',2200,0,'ahorro'),(108,1021677489,'2023-05-14',0,32000,'retiro regalo mama'),(109,1021677489,'2023-05-14',9000,0,'ahorro'),(112,1021677489,'2023-05-16',2000,0,'ahorro'),(114,1021677489,'2023-05-16',50000,0,'ahorro'),(115,1021677489,'2023-05-18',3000,0,'ahorro'),(117,1021677489,'2023-05-25',2300,0,'ahorro'),(118,1021677489,'2023-05-27',3000,0,'ahorro'),(119,52443188,'2023-06-01',150000,0,'consignacion Leonardo'),(120,1021677489,'2023-06-03',4000,0,'ahorro'),(121,80209042,'2023-06-03',0,5000,'retiro'),(122,52443188,'2023-06-04',0,5590,'pago gas natural'),(123,52443188,'2023-06-11',0,10000,'retiro cartilla alejandro'),(124,80209042,'2023-06-11',12000,0,'ahorro'),(125,1021677489,'2023-06-16',4000,0,'ahorro'),(127,80209042,'2023-06-18',100000,0,'ahorro'),(128,52443188,'2023-07-01',0,5590,'pago gas natural'),(129,52443188,'2023-07-01',0,25000,'servicios casa'),(130,1021677489,'2023-07-02',0,3000,'retiro'),(131,52443188,'2023-07-06',150000,0,'consignacion Leonardo'),(132,80209042,'2023-07-13',100000,0,'ahorro'),(133,80209042,'2023-07-15',70000,0,'ahorro'),(136,12345,'2023-07-15',1000,0,'ahorro'),(137,1021677489,'2023-07-17',1500,0,'ahorro'),(138,52443188,'2023-07-17',0,20000,'compra teja casa'),(139,52443188,'2023-07-17',0,20000,'compra accesorios baño casa'),(141,1021677489,'2023-07-21',6550,0,'ahorro'),(142,80209042,'2023-07-22',5000,0,'ahorro'),(143,12345,'2023-07-22',0,100,'ahorro'),(144,1021677489,'2023-07-28',4500,0,'ahorro'),(145,80209042,'2023-07-29',7000,0,'ahorro'),(146,52443188,'2023-07-31',0,100000,'retiro'),(147,52443188,'2023-07-31',0,30000,'pago servicios casa'),(148,52443188,'2023-08-04',150000,0,'consignacion Leonardo'),(149,1021677489,'2023-08-05',7000,0,'ahorro'),(150,80209042,'2023-08-06',50000,0,'ahorro'),(151,1021677489,'2023-08-07',0,50000,'retiro'),(152,52443188,'2023-08-07',0,4350,'pago gas natural'),(153,1021677489,'2023-08-07',7200,0,'ahorro'),(155,80209042,'2023-08-14',4000,0,'ahorro'),(156,80209042,'2023-08-16',12000,0,'ahorro'),(157,80209042,'2023-08-16',2000,0,'ahorro'),(159,1000469588,'2023-08-17',250000,0,'ahorro'),(160,12345,'2023-08-17',0,50,'1'),(161,12345,'2023-08-17',0,50,'1'),(162,12345,'2023-08-17',0,100,'prestamo'),(163,12345,'2023-08-17',0,50,'prestamo'),(164,12345,'2023-08-17',0,50,'Seleccione ...'),(165,1000469588,'2023-08-18',0,40000,'contrib. comida manolo'),(167,1000469588,'2023-08-20',0,12854,'pago enel codensa'),(168,1000469588,'2023-08-20',0,14646,'comida salida domingo'),(169,1021677489,'2023-08-20',0,6000,'pago comida iglesia'),(170,12345,'2023-08-20',0,50,'prestamo'),(171,12345,'2023-08-20',0,50,'prestamo'),(172,12345,'2023-08-20',0,10,'prestamo'),(173,12345,'2023-08-20',0,10,'prestamo'),(174,12345,'2023-08-20',0,10,'prestamo'),(175,80209042,'2023-08-26',5000,0,'ahorro'),(176,1000469588,'2023-08-27',0,61178,'pago servicios casa'),(177,52443188,'2023-08-27',0,5550,'pago servicios'),(178,1000469588,'2023-08-28',0,20000,'retiro'),(179,80209042,'2023-09-02',4000,0,'ahorro'),(181,12345,'2023-09-03',100,0,'a; drop table pagos;'),(182,1021677489,'2023-09-03',3000,0,'ahorro'),(183,80209042,'2023-09-03',20000,0,'ahorro'),(184,1021677489,'2023-09-03',0,6000,'retiro'),(186,52443188,'2023-09-03',0,68000,'retiro'),(187,52443188,'2023-09-03',0,30000,'pago servicios casa'),(189,52443188,'2023-09-05',150000,0,'consignacion Leonardo'),(190,80209042,'2023-09-05',4000,0,'ahorro'),(191,52443188,'2023-09-10',0,15000,'comida domingo'),(192,80209042,'2023-09-13',5000,0,'ahorro'),(193,1000469588,'2023-09-13',0,15000,'comida domingo'),(194,12345,'',0,0,''),(195,12345,'',0,0,''),(196,12345,'',0,0,''),(197,12345,'',0,0,''),(198,1000469588,'2023-09-16',200000,0,'ahorro'),(199,80209042,'2023-09-16',40000,0,'ahorro'),(210,12345,'2023-09-18',0,5,'envio'),(211,12345,'2023-09-18',0,0,'deposito 345678'),(212,12345,'2023-09-18',0,0,'deposito 345678'),(214,12345,'2023-09-18',0,0,'deposito 345678'),(215,12345,'2023-09-18',0,0,'deposito 345678'),(216,12345,'2023-09-18',0,0,'deposito 345678'),(217,12345,'2023-09-18',0,0,'deposito 345678'),(218,12345,'2023-09-18',0,0,'deposito 345678'),(223,1000469588,'2023-09-19',0,286322,'retiro'),(225,12345,'curdate()',0,1,'transferencia 345678'),(227,12345,'2023-09-19',0,1,'transferencia 345678'),(228,12345,'2023-09-19',1,0,'deposito 345678'),(229,12345,'2023-09-19',1,0,'deposito 345678'),(230,12345,'2023-09-19',7,0,'deposito 345678'),(231,12345,'2023-09-19',7,0,'deposito 345678'),(232,12345,'2023-09-19',0,0,'envio 345678'),(233,12345,'2023-09-19',0,0,'envio 345678'),(234,12345,'2023-09-19',0,0,'envio 345678'),(235,12345,'2023-09-19',0,0,'envio 345678'),(236,12345,'2023-09-20',0,0,'envio 345678'),(237,12345,'2023-09-20',0,0,'envio 345678'),(238,80209042,'2023-09-22',5000,0,'ahorro'),(239,80209042,'2023-09-25',5000,0,'ahorro'),(240,1021677489,'2023-09-27',0,15000,'retiro'),(241,52443188,'2023-09-28',0,4230,'pago gas natural'),(242,52443188,'2023-10-01',0,370000,'retiro'),(243,52443188,'2023-10-01',0,30000,'servicios casa'),(244,52443188,'2023-10-01',0,7500,'arreglo llave'),(245,52443188,'2023-10-02',150000,0,'consignacion Leonardo'),(246,80209042,'2023-10-05',2000,0,'ahorro'),(247,80209042,'2023-10-14',20000,0,'ahorro'),(249,12345,'2023-10-14',50,0,'ahorro'),(253,52443188,'2023-10-15',0,15000,'comida domingo'),(254,80209042,'2023-10-17',5000,0,'ahorro'),(255,1021677489,'2023-10-17',2000,0,'ahorro'),(256,1021677489,'2023-10-19',0,10000,'retiro'),(257,80209042,'2023-10-30',2000,0,'ahorro'),(258,1021677489,'2023-10-31',0,10000,'retiro'),(260,80209042,'2023-10-31',40000,0,'ahorro'),(261,52443188,'2023-11-01',0,160000,'retiro'),(262,52443188,'2023-11-01',0,30000,'servicios casa'),(264,80209042,'2023-11-02',0,35000,'retiro'),(266,1000469588,'2023-11-03',150000,0,'ahorro'),(269,52443188,'2023-11-04',150000,0,'consignacion Leonardo'),(271,80209042,'2023-11-07',10000,0,'ahorro'),(272,52443188,'2023-11-07',0,5360,'pago gas natural'),(273,1000469588,'2023-11-09',0,20000,'retiro para David'),(274,1000469588,'2023-11-10',0,30000,'ayuda comida manolo'),(275,1000469588,'2023-11-10',0,100000,'retiro'),(276,80209042,'2023-11-10',0,100000,'retiro'),(277,80209042,'2023-11-12',0,60000,'retiro'),(278,80209042,'2023-11-16',10000,0,'ahorro'),(279,1000469588,'2023-11-19',250000,0,'ahorro'),(280,80209042,'2023-11-20',10000,0,'ahorro'),(281,12345,'date(Y,m,d)',100,0,'ahorro'),(282,12345,'2023-11-20',50,0,'ahorro'),(283,80209042,'2023-11-27',0,200000,'compra casco'),(284,80209042,'2023-12-01',5000,0,'ahorro'),(285,1000469588,'2023-12-01',0,70000,'pago servicios'),(286,52443188,'2023-12-04',150000,0,'consignacion Leonardo'),(287,52443188,'2023-12-04',0,6320,'pago gas natural'),(288,52443188,'2023-12-04',0,160000,'comida'),(289,52443188,'2023-12-04',0,30000,'servicios casa'),(290,80209042,'2023-12-06',10000,0,'ahorro'),(291,1021677489,'2023-12-06',0,4000,'retiro'),(292,12345,'',10,0,'ahorro'),(293,12345,'2023-12-08',10,0,'ahorro'),(294,12345,'2023-12-08',0,5,'retiro'),(295,1000469588,'2023-12-11',0,100000,'retiro'),(298,80209042,'2023-12-13',2000,0,'ahorro'),(299,1021677489,'2023-12-16',0,2100,'retiro canasta de amor'),(300,80209042,'2023-12-18',15000,0,'ahorro'),(302,1021677489,'2023-12-25',9000,0,'ahorro'),(303,80209042,'2023-12-25',20000,0,'ahorro'),(304,52443188,'2023-12-28',0,4260,'pago gas natural'),(305,1021677489,'2023-12-31',0,10000,'retiro'),(306,1000469588,'2023-12-31',0,80000,'servicios casa'),(307,12345,'2024-01-01',50,0,'ahorro'),(308,52443188,'2024-01-01',0,30000,'servicios casa'),(311,80209042,'2024-01-02',0,29000,'retiro'),(312,80209042,'2024-01-02',0,5000,''),(314,52443188,'2024-01-02',160000,0,'consignacion Leonardo'),(317,52443188,'2024-01-03',0,160000,'comida'),(318,80209042,'2024-01-04',0,160000,'retiro'),(320,80209042,'2024-01-21',4000,0,'ahorro');
/*!40000 ALTER TABLE `ahorros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ahorros_alejandro`
--

DROP TABLE IF EXISTS `ahorros_alejandro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ahorros_alejandro` (
  `id_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` char(24) DEFAULT NULL,
  `valor_a_ahorrar` int(11) DEFAULT NULL,
  `valor_a_retirar` int(11) DEFAULT NULL,
  `concepto` char(40) DEFAULT NULL,
  PRIMARY KEY (`id_movimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ahorros_alejandro`
--

LOCK TABLES `ahorros_alejandro` WRITE;
/*!40000 ALTER TABLE `ahorros_alejandro` DISABLE KEYS */;
INSERT INTO `ahorros_alejandro` VALUES (1,'2022-05-09',1000,0,'ahorro'),(2,'2022-05-04',800,0,'ahorro'),(3,'2021-12-04',13000,0,'ahorro'),(4,'2021-12-02',8100,0,'ahorro'),(5,'2022-05-15',10000,0,'ahorro'),(6,'2022-05-17',1500,0,'ahorro'),(7,'2022-05-17',10000,0,'ahorro'),(8,'2022-05-18',4500,0,'ahorro'),(9,'2022-05-17',600,0,'ahorro'),(10,'2022-08-29',13900,0,'ahorro'),(11,'2021-12-24',0,13600,'retiro'),(12,'2021-12-03',0,5700,'retiro'),(13,'2022-08-31',0,29800,'pago mami'),(14,'2022-09-12',1000,0,'ahorro'),(15,'2022-09-12',0,1000,'retiro'),(16,'2022-09-13',1500,0,'ahorro'),(17,'2022-09-14',1500,0,'ahorro'),(18,'2022-09-16',1500,0,'ahorro'),(19,'2022-09-17',0,8000,'peluqueria'),(20,'2022-09-22',1500,0,'ahorro'),(21,'2022-09-27',1500,0,'ahorro'),(22,'2022-09-28',1500,0,'ahorro'),(23,'2022-10-01',2000,0,'ahorro'),(39,'2022-10-04',1000,0,'ahorro'),(47,'2022-10-07',4500,0,'ahorro'),(48,'2022-10-08',700,0,'ahorro'),(49,'2022-10-09',0,15000,'retiro'),(50,'',0,0,''),(51,'2022-10-19',2600,0,'ahorro'),(52,'2022-10-20',1500,0,'ahorro'),(53,'2022-10-24',1500,0,'ahorro'),(54,'2022-10-27',3000,0,'ahorro'),(55,'2022-10-28',1000,0,'ahorro'),(56,'',0,0,''),(57,'2022-10-30',3000,0,'ahorro apuesta'),(58,'2022-10-31',2500,0,'ahorro'),(59,'2022-11-01',3500,0,'ahorro'),(60,'2022-11-04',1500,0,'ahorro'),(61,'2022-11-06',0,6000,'compra cargador'),(62,'2022-11-10',0,5000,'retiro'),(63,'2022-11-10',1000,0,'ahorro'),(64,'2022-11-19',0,7000,'retiro'),(65,'2022-11-24',0,2000,'reposicion'),(66,'2022-11-26',0,6500,'retiro'),(67,'2022-12-01',0,2000,'retiro'),(68,'',0,0,''),(69,'2023-02-06',800,0,'ahorro'),(70,'2023-02-07',1300,0,'ahorro'),(71,'2023-02-09',1600,0,'ahorro'),(72,'2023-02-10',1500,0,'ahorro'),(73,'2023-02-12',2000,0,'ahorro'),(74,'2023-02-14',1500,0,'ahorro'),(75,'2023-02-15',1500,0,'ahorro'),(76,'',0,0,''),(77,'2023-02-17',1500,0,'ahorro'),(78,'2023-02-19',2000,0,'ahorro'),(79,'2023-02-20',1500,0,'ahorro'),(80,'2023-02-22',0,2000,'retiro');
/*!40000 ALTER TABLE `ahorros_alejandro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ahorros_isabel`
--

DROP TABLE IF EXISTS `ahorros_isabel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ahorros_isabel` (
  `id_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` char(24) DEFAULT NULL,
  `valor_a_ahorrar` int(11) DEFAULT NULL,
  `valor_a_retirar` int(11) DEFAULT NULL,
  `concepto` char(40) DEFAULT NULL,
  PRIMARY KEY (`id_movimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ahorros_isabel`
--

LOCK TABLES `ahorros_isabel` WRITE;
/*!40000 ALTER TABLE `ahorros_isabel` DISABLE KEYS */;
INSERT INTO `ahorros_isabel` VALUES (1,'0000-00-00',1187000,0,'ahorro'),(2,'0000-00-00',0,120000,'retiro'),(3,'0000-00-00',0,120000,'retiro'),(4,'2000-01-12',0,10000,'retiro'),(5,'2000-01-12',10000,0,'ahorro'),(6,'2022-09-02',1000,0,'abono'),(7,'2022-09-02',5000,0,'abono'),(8,'2022-09-02',0,6000,'retiro'),(9,'2022-09-02',1000,0,'ahorro'),(10,'2022-09-02',0,1000,'retiro'),(11,'2022-09-02',0,1000,'retiro'),(12,'',0,0,''),(13,'',0,0,''),(14,'',0,0,''),(15,'',0,0,''),(16,'',0,0,''),(17,'2022-09-02',1000,0,'ahorro'),(18,'2022-09-05',20000,0,'consignacion'),(19,'2022-09-05',0,20000,'devolucion'),(20,'2022-09-05',0,20000,'retiro daviplata'),(21,'2022-09-07',140000,0,'consignacion Leonardo'),(22,'2022-09-07',0,4960,'pago gas natural'),(23,'',0,0,''),(24,'2022-09-17',0,10000,''),(25,'',0,0,''),(26,'',0,0,''),(27,'2022-05-18',1000,0,'ahorro'),(28,'2022-05-18',0,1000,''),(29,'2022-09-19',0,60000,'retiro daviplata'),(30,'2022-10-01',0,100000,'abono encuentro alejandro'),(31,'2022-10-05',0,50000,'retiro'),(32,'2022-10-08',100000,0,'ahorro'),(33,'2022-10-09',0,15000,'almuerzo alejandro'),(34,'2022-10-14',144000,0,'consignacion Leonardo'),(35,'2022-10-19',0,24000,'compra celular samsung'),(36,'2022-10-25',0,300000,'retiro'),(37,'2022-10-25',0,34000,'materiales trabajo Alejandro'),(38,'2022-10-25',0,23250,'Claro seguro para celular'),(39,'2022-10-25',0,42336,'cuota celular samsung'),(40,'2022-10-25',0,2380,'cuota financiacion celular samsung'),(41,'2022-10-31',0,20000,'servicios casa'),(42,'2022-11-25',150000,0,'consignacion Leonardo'),(43,'2022-11-25',0,20000,'servicios casa'),(44,'2022-11-29',0,42336,'cuota celular samsung'),(45,'2022-11-29',0,22500,'Claro seguro para celular'),(46,'2022-11-29',0,2662,'cuota financiacion celular samsung'),(47,'2022-12-05',0,3220,'pago gas natural'),(48,'2022-12-07',0,10000,'recarga celular'),(49,'2022-12-15',100000,0,'pago prestamo armando'),(50,'2022-12-15',146000,0,'consignacion Leonardo'),(51,'2022-12-15',0,15000,'pago armando'),(52,'2022-12-27',0,42336,'compra celular samsung'),(53,'2022-12-27',0,30000,'comida 24 de diciembre'),(54,'2023-01-03',0,7000,'deuda tienda'),(55,'2023-01-03',0,4560,'pago gas natural'),(56,'2023-01-03',0,25000,'servicios casa'),(62,'2023-01-04',150000,0,'consignacion Leonardo'),(63,'2023-01-19',0,320000,'pago arriendo'),(64,'2023-01-29',0,4530,'pago gas natural'),(65,'2023-02-02',150000,0,'consignacion Leonardo'),(66,'2023-02-07',0,15000,'recarga celular'),(67,'2023-02-15',0,5000,'diligencia tarjeta alejandro'),(68,'2023-02-17',0,10000,'recarga celular');
/*!40000 ALTER TABLE `ahorros_isabel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `usuario` char(50) DEFAULT NULL,
  `contraseña` char(50) DEFAULT NULL,
  `nueva` char(50) DEFAULT NULL,
  `nombre` char(20) DEFAULT NULL,
  `telefono` char(15) DEFAULT NULL,
  `enviarpass` char(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES ('arvarela22@hotmail.com','armando2024','var123','armando varela','3133318429','d8siaogf');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_usuario`
--

DROP TABLE IF EXISTS `login_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_usuario` (
  `id` int(11) NOT NULL,
  `contraseña` char(25) DEFAULT NULL,
  `nueva` char(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `login_usuario_ibfk_4` FOREIGN KEY (`id`) REFERENCES `ahorros` (`usuario`) ON DELETE CASCADE,
  CONSTRAINT `login_usuario_ibfk_5` FOREIGN KEY (`id`) REFERENCES `usuarios` (`documento`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_usuario`
--

LOCK TABLES `login_usuario` WRITE;
/*!40000 ALTER TABLE `login_usuario` DISABLE KEYS */;
INSERT INTO `login_usuario` VALUES (12345,'pruebar24',''),(51637320,'mama2024',''),(52443188,'martha2024',''),(1000469588,'1000469588',''),(1021677489,'octavo1009','');
/*!40000 ALTER TABLE `login_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagos` (
  `id_pago` int(11) DEFAULT NULL,
  `nombre` char(29) DEFAULT NULL,
  `pago` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (1,'jhon',9000);
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestamos`
--

DROP TABLE IF EXISTS `prestamos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(35) DEFAULT NULL,
  `valor_prestamo` int(11) DEFAULT NULL,
  `concepto` char(35) DEFAULT NULL,
  PRIMARY KEY (`id_prestamo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestamos`
--

LOCK TABLES `prestamos` WRITE;
/*!40000 ALTER TABLE `prestamos` DISABLE KEYS */;
INSERT INTO `prestamos` VALUES (1,'alejandro',15000,'regalo mama'),(2,'david',15000,'transportes'),(3,'david',34000,'gas natural');
/*!40000 ALTER TABLE `prestamos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `documento` int(11) NOT NULL,
  `nombres` char(60) DEFAULT NULL,
  `email` char(40) DEFAULT NULL,
  `telefono` char(15) DEFAULT NULL,
  `sendpass` char(8) DEFAULT NULL,
  PRIMARY KEY (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (12345,'prueba bd','prueba21951@outlook.com','31113456','gz2covm2'),(51637320,'maria aydee hormiga','varelaarmando430@gmail.com','3112746399','hsmpdis1'),(52443188,'martha isabel varela hormiga','maisa-lejo@hotmail.com','3118607679','h659nsb4'),(80209042,'jorge armando varela hormiga','arvarela22@hotmail.com','3133318429',NULL),(1000469588,'juan felipe gonzalez','felip35849@gmail.com','3227719751',NULL),(1021677489,'luis alejandro bejarano varela','bejaranoalejandro612@gmail.com','3143119762',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-21 16:56:46
