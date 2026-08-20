-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: tracto_pension
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accesos`
--

DROP TABLE IF EXISTS `accesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accesos` (
  `id_acceso` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_camion` int NOT NULL,
  `tipo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `observaciones` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_acceso`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_camion` (`id_camion`),
  CONSTRAINT `accesos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `accesos_ibfk_2` FOREIGN KEY (`id_camion`) REFERENCES `camiones` (`id_camion`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesos`
--

LOCK TABLES `accesos` WRITE;
/*!40000 ALTER TABLE `accesos` DISABLE KEYS */;
INSERT INTO `accesos` VALUES (1,2,1,'entrada','2026-04-22','19:55:00',NULL,'2026-07-24 21:56:44'),(2,2,1,'salida','2026-04-23','08:30:00',NULL,'2026-07-24 21:56:44'),(3,2,1,'entrada','2026-04-23','09:00:00',NULL,'2026-07-24 21:56:44'),(4,2,2,'entrada','2026-04-20','14:30:00',NULL,'2026-07-24 21:56:44'),(5,3,3,'entrada','2026-04-21','10:15:00',NULL,'2026-07-24 21:56:44');
/*!40000 ALTER TABLE `accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apartados`
--

DROP TABLE IF EXISTS `apartados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `apartados` (
  `id_apartado` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_espacio` int NOT NULL,
  `id_camion` int DEFAULT NULL,
  `folio` int DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'activo',
  `motivo` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio_total` decimal(10,2) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_apartado`),
  UNIQUE KEY `folio` (`folio`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_espacio` (`id_espacio`),
  KEY `id_camion` (`id_camion`),
  CONSTRAINT `apartados_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `apartados_ibfk_2` FOREIGN KEY (`id_espacio`) REFERENCES `espacios` (`id_espacio`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `apartados_ibfk_3` FOREIGN KEY (`id_camion`) REFERENCES `camiones` (`id_camion`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apartados`
--

LOCK TABLES `apartados` WRITE;
/*!40000 ALTER TABLE `apartados` DISABLE KEYS */;
INSERT INTO `apartados` VALUES (1,2,3,1,1,'2026-04-22','2026-05-22','activo',NULL,2500.00,'2026-07-24 21:56:44'),(2,2,10,2,2,'2026-04-20','2026-05-20','activo',NULL,2500.00,'2026-07-24 21:56:44'),(3,3,12,3,3,'2026-04-21','2026-05-21','activo',NULL,2500.00,'2026-07-24 21:56:44');
/*!40000 ALTER TABLE `apartados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `camiones`
--

DROP TABLE IF EXISTS `camiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `camiones` (
  `id_camion` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `placa` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modelo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anio` int DEFAULT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `hora_entrada` time DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'en_pension',
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_camion`),
  UNIQUE KEY `placa` (`placa`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `camiones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `camiones`
--

LOCK TABLES `camiones` WRITE;
/*!40000 ALTER TABLE `camiones` DISABLE KEYS */;
INSERT INTO `camiones` VALUES (1,2,'ABC-123','Volvo','FH16','Blanco',2020,'2026-04-22','19:55:00','en_pension','2026-07-24 21:56:44'),(2,2,'XYZ-789','Scania','R450','Azul',2019,'2026-04-20','14:30:00','en_pension','2026-07-24 21:56:44'),(3,3,'DEF-456','Mercedes','Actros','Rojo',2021,'2026-04-21','10:15:00','en_pension','2026-07-24 21:56:44');
/*!40000 ALTER TABLE `camiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `espacios`
--

DROP TABLE IF EXISTS `espacios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `espacios` (
  `id_espacio` int NOT NULL AUTO_INCREMENT,
  `numero_espacio` int NOT NULL,
  `terreno` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'disponible',
  `ubicacion` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio_mensual` decimal(10,2) DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_espacio`),
  UNIQUE KEY `numero_espacio` (`numero_espacio`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `espacios`
--

LOCK TABLES `espacios` WRITE;
/*!40000 ALTER TABLE `espacios` DISABLE KEYS */;
INSERT INTO `espacios` VALUES (1,1,'Terreno 1','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(2,2,'Terreno 1','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(3,3,'Terreno 1','ocupado',NULL,2500.00,'2026-07-24 21:56:27'),(4,4,'Terreno 1','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(5,5,'Terreno 1','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(6,6,'Terreno 1','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(7,7,'Terreno 2','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(8,8,'Terreno 2','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(9,9,'Terreno 2','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(10,10,'Terreno 2','ocupado',NULL,2500.00,'2026-07-24 21:56:27'),(11,11,'Terreno 2','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(12,12,'Terreno 2','ocupado',NULL,2500.00,'2026-07-24 21:56:27'),(13,13,'Terreno 3','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(14,14,'Terreno 3','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(15,15,'Terreno 3','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(16,16,'Terreno 3','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(17,17,'Terreno 3','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(18,18,'Terreno 3','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(19,19,'Terreno 3','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(20,20,'Terreno 3','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(21,21,'Terreno 3','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(22,22,'Terreno 3','disponible',NULL,2500.00,'2026-07-24 21:56:27'),(23,23,'Terreno 3','disponible',NULL,2500.00,'2026-07-24 21:56:27');
/*!40000 ALTER TABLE `espacios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial`
--

DROP TABLE IF EXISTS `historial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `historial` (
  `id_historial` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `accion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tabla_afectada` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registro_id` int DEFAULT NULL,
  `detalles` text COLLATE utf8mb4_unicode_ci,
  `direccion_ip` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_historial`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `historial_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial`
--

LOCK TABLES `historial` WRITE;
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagos` (
  `id_pago` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_apartado` int DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL,
  `concepto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metodo_pago` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'pendiente',
  `fecha_pago` date DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `referencia` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pago`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_apartado` (`id_apartado`),
  CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`id_apartado`) REFERENCES `apartados` (`id_apartado`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (1,2,1,2500.00,'Renta de espacio abril','transferencia','pagado','2026-04-22',NULL,NULL,'2026-07-24 21:56:44'),(2,2,2,2500.00,'Renta de espacio abril','transferencia','pagado','2026-04-20',NULL,NULL,'2026-07-24 21:56:44'),(3,3,3,2500.00,'Renta de espacio abril','efectivo','pendiente',NULL,NULL,NULL,'2026-07-24 21:56:44');
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contrasena` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'user',
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'tonny','1234','admin','Tonny Admin','tonny@tractopension.com','5551234567','2026-07-24 21:56:27'),(2,'juan','usuario123','user','Juan Perez','juan@gmail.com','5559876543','2026-07-24 21:56:27'),(3,'maria','usuario456','user','Maria Gonzalez','maria@gmail.com','5558765432','2026-07-24 21:56:27');
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

-- Dump completed on 2026-07-24 16:25:53
