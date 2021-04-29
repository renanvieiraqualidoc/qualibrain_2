-- MySQL dump 10.13  Distrib 5.7.31, for Linux (x86_64)
--
-- Host: cockpit.c7yft9tue2sa.us-east-2.rds.amazonaws.com    Database: fspider
-- ------------------------------------------------------
-- Server version	8.0.20

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED='';

--
-- Table structure for table `Situation`
--

DROP TABLE IF EXISTS `Situation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Situation` (
  `code` int NOT NULL AUTO_INCREMENT,
  `situation` char(50) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Situation`
--

LOCK TABLES `Situation` WRITE;
/*!40000 ALTER TABLE `Situation` DISABLE KEYS */;
INSERT INTO `Situation` VALUES (1,'Aguardando Leitura'),(2,'Menor ou igual ao custo'),(3,'Aguardando reacao'),(4,'Sacrificando margem de operacao'),(5,'Sacrificando margem de lucro'),(6,'Pouca diferenca'),(7,'Com boa diferenca'),(8,'Com excelente diferenca'),(9,'Com incrivel diferenca'),(10,'Ok - Igual ao preco de venda'),(11,'Verificar - Menor que o preco de venda'),(12,'Verificar - Maior que o preco de venda'),(13,'Preco Zerado'),(14,'Em processo de cadastro'),(15,'Situacao nao definida!'),(16,'Verificar - Menor que o preco tabelado'),(17,'Verificar - Maior que o preco tabelado'),(18,'Ok - Igual ao valor tabelado'),(19,'Ok - Acompanhando o menor preco tabelado'),(20,'Verificar - Tabelado abaixo do custo'),(21,'Verificar - Tabelado abaixo do valor de venda');
/*!40000 ALTER TABLE `Situation` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-29 20:17:40
