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
  `camiones_id_camiones` int NOT NULL,
  `usuarios_id_usuario` int NOT NULL,
  `roles_id_rol` int NOT NULL,
  `linea_id_linea` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_camiones` int NOT NULL,
  `fecha_hora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` varchar(10) DEFAULT NULL COMMENT 'entrada,salida',
  PRIMARY KEY (`id_acceso`,`camiones_id_camiones`,`usuarios_id_usuario`,`roles_id_rol`,`linea_id_linea`),
  KEY `fk_accesos_usuarios` (`id_usuario`),
  KEY `fk_accesos_camiones` (`id_camiones`),
  KEY `camiones_accesos_fk` (`camiones_id_camiones`,`usuarios_id_usuario`,`roles_id_rol`,`linea_id_linea`),
  CONSTRAINT `camiones_accesos_fk` FOREIGN KEY (`camiones_id_camiones`, `usuarios_id_usuario`, `roles_id_rol`, `linea_id_linea`) REFERENCES `camiones` (`id_camiones`, `usuarios_id_usuario`, `roles_id_rol`, `linea_id_linea`),
  CONSTRAINT `fk_accesos_camiones` FOREIGN KEY (`id_camiones`) REFERENCES `camiones` (`id_camiones`),
  CONSTRAINT `fk_accesos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesos`
--

LOCK TABLES `accesos` WRITE;
/*!40000 ALTER TABLE `accesos` DISABLE KEYS */;
INSERT INTO `accesos` VALUES (1,1,3,3,1,3,1,'2026-05-27 17:43:27','entrada'),(2,2,4,3,2,4,2,'2026-05-27 17:43:27','entrada'),(3,3,7,3,3,7,3,'2026-05-27 17:43:27','salida'),(4,4,8,3,4,8,4,'2026-05-27 17:43:27','entrada'),(5,5,10,3,5,10,5,'2026-05-27 17:43:27','salida'),(6,6,3,3,6,3,6,'2026-05-27 17:43:27','entrada'),(7,7,4,3,7,4,7,'2026-05-27 17:43:27','entrada'),(8,8,7,3,8,7,8,'2026-05-27 17:43:27','salida'),(9,9,8,3,9,8,9,'2026-05-27 17:43:27','entrada'),(10,10,10,3,10,10,10,'2026-05-27 17:43:27','entrada'),(11,1,3,3,1,3,1,'2026-05-27 17:45:10','entrada'),(12,2,4,3,2,4,2,'2026-05-27 17:45:10','entrada'),(13,3,7,3,3,7,3,'2026-05-27 17:45:10','salida'),(14,4,8,3,4,8,4,'2026-05-27 17:45:10','entrada'),(15,5,10,3,5,10,5,'2026-05-27 17:45:10','salida'),(16,6,3,3,6,3,6,'2026-05-27 17:45:10','entrada'),(17,7,4,3,7,4,7,'2026-05-27 17:45:10','entrada'),(18,8,7,3,8,7,8,'2026-05-27 17:45:10','salida'),(19,9,8,3,9,8,9,'2026-05-27 17:45:10','entrada'),(20,10,10,3,10,10,10,'2026-05-27 17:45:10','entrada');
/*!40000 ALTER TABLE `accesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avisos`
--

DROP TABLE IF EXISTS `avisos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avisos` (
  `id_aviso` int NOT NULL AUTO_INCREMENT,
  `mensaje` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_aviso`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avisos`
--

LOCK TABLES `avisos` WRITE;
/*!40000 ALTER TABLE `avisos` DISABLE KEYS */;
INSERT INTO `avisos` VALUES (1,'Mantenimiento programado en el terreno norte este fin de semana.','2026-05-27 17:43:21'),(2,'Recuerden que los pagos vencen los primeros 5 días del mes.','2026-05-27 17:43:21'),(3,'Nuevo espacio disponible para camiones pesados en Terreno Central.','2026-05-27 17:43:21'),(4,'Se solicita a todos los operadores registrar su entrada correctamente.','2026-05-27 17:43:21'),(5,'Actualización del sistema de accesos hoy a las 11:00 PM.','2026-05-27 17:43:21'),(6,'Favor de reportar cualquier fuga de agua en los baños de pensionados.','2026-05-27 17:43:21'),(7,'Horario de atención en oficinas extendido hasta las 6:00 PM.','2026-05-27 17:43:21'),(8,'Espacios de mantenimiento bloqueados temporalmente.','2026-05-27 17:43:21'),(9,'Revisión de extintores el próximo martes por la mañana.','2026-05-27 17:43:21'),(10,'Bienvenidos al nuevo sistema automatizado de Tracto Pension.','2026-05-27 17:43:21'),(11,'Mantenimiento programado en el terreno norte este fin de semana.','2026-05-27 17:45:04'),(12,'Recuerden que los pagos vencen los primeros 5 días del mes.','2026-05-27 17:45:04'),(13,'Nuevo espacio disponible para camiones pesados en Terreno Central.','2026-05-27 17:45:04'),(14,'Se solicita a todos los operadores registrar su entrada correctamente.','2026-05-27 17:45:04'),(15,'Actualización del sistema de accesos hoy a las 11:00 PM.','2026-05-27 17:45:04'),(16,'Favor de reportar cualquier fuga de agua en los baños de pensionados.','2026-05-27 17:45:04'),(17,'Horario de atención en oficinas extendido hasta las 6:00 PM.','2026-05-27 17:45:04'),(18,'Espacios de mantenimiento bloqueados temporalmente.','2026-05-27 17:45:04'),(19,'Revisión de extintores el próximo martes por la mañana.','2026-05-27 17:45:04'),(20,'Bienvenidos al nuevo sistema automatizado de Tracto Pension.','2026-05-27 17:45:04');
/*!40000 ALTER TABLE `avisos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `camiones`
--

DROP TABLE IF EXISTS `camiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `camiones` (
  `id_camiones` int NOT NULL AUTO_INCREMENT,
  `usuarios_id_usuario` int NOT NULL,
  `roles_id_rol` int NOT NULL,
  `linea_id_linea` int NOT NULL,
  `placa` varchar(20) NOT NULL,
  `modelo` varchar(60) NOT NULL,
  `id_usuario` int NOT NULL,
  `id_linea` int NOT NULL,
  PRIMARY KEY (`id_camiones`,`usuarios_id_usuario`,`roles_id_rol`,`linea_id_linea`),
  KEY `fk_camiones_linea` (`id_linea`),
  KEY `linea_camiones_fk` (`linea_id_linea`),
  KEY `fk_camiones_usuarios` (`id_usuario`),
  KEY `usuarios_camiones_fk` (`usuarios_id_usuario`,`roles_id_rol`),
  CONSTRAINT `fk_camiones_linea` FOREIGN KEY (`id_linea`) REFERENCES `linea` (`id_linea`),
  CONSTRAINT `fk_camiones_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `linea_camiones_fk` FOREIGN KEY (`linea_id_linea`) REFERENCES `linea` (`id_linea`),
  CONSTRAINT `usuarios_camiones_fk` FOREIGN KEY (`usuarios_id_usuario`, `roles_id_rol`) REFERENCES `usuarios` (`id_usuario`, `roles_id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `camiones`
--

LOCK TABLES `camiones` WRITE;
/*!40000 ALTER TABLE `camiones` DISABLE KEYS */;
INSERT INTO `camiones` VALUES (1,3,3,1,'65-AA-7A','Kenworth T680 2022',3,1),(2,4,3,2,'43-BB-8B','Freightliner Cascadia 2020',4,2),(3,7,3,3,'12-CC-9C','International ProStar 2019',7,3),(4,8,3,4,'98-DD-1D','Volvo VNL 860 2021',8,4),(5,10,3,5,'34-EE-2E','Scania R500 2023',10,5),(6,3,3,6,'76-FF-3F','Peterbilt 579 2021',3,6),(7,4,3,7,'23-GG-4G','Mack Anthem 2020',4,7),(8,7,3,8,'87-HH-5H','Kenworth T800 2018',7,8),(9,8,3,9,'54-II-6I','Freightliner M2 2017',8,9),(10,10,3,10,'11-JJ-7J','International DuraStar 2020',10,10),(11,3,3,1,'65-AA-7A','Kenworth T680 2022',3,1),(12,4,3,2,'43-BB-8B','Freightliner Cascadia 2020',4,2),(13,7,3,3,'12-CC-9C','International ProStar 2019',7,3),(14,8,3,4,'98-DD-1D','Volvo VNL 860 2021',8,4),(15,10,3,5,'34-EE-2E','Scania R500 2023',10,5),(16,3,3,6,'76-FF-3F','Peterbilt 579 2021',3,6),(17,4,3,7,'23-GG-4G','Mack Anthem 2020',4,7),(18,7,3,8,'87-HH-5H','Kenworth T800 2018',7,8),(19,8,3,9,'54-II-6I','Freightliner M2 2017',8,9),(20,10,3,10,'11-JJ-7J','International DuraStar 2020',10,10);
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
  `terrenos_id_terreno` int NOT NULL,
  `id_terreno` int NOT NULL,
  `numero` int NOT NULL,
  `estado` varchar(20) DEFAULT NULL COMMENT 'libre,ocupado,reservado,mantenimiento',
  PRIMARY KEY (`id_espacio`,`terrenos_id_terreno`),
  KEY `fk_espacios_terrenos` (`id_terreno`),
  KEY `terrenos_espacios_fk` (`terrenos_id_terreno`),
  CONSTRAINT `fk_espacios_terrenos` FOREIGN KEY (`id_terreno`) REFERENCES `terrenos` (`id_terreno`),
  CONSTRAINT `terrenos_espacios_fk` FOREIGN KEY (`terrenos_id_terreno`) REFERENCES `terrenos` (`id_terreno`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `espacios`
--

LOCK TABLES `espacios` WRITE;
/*!40000 ALTER TABLE `espacios` DISABLE KEYS */;
INSERT INTO `espacios` VALUES (1,1,1,101,'libre'),(2,1,1,102,'ocupado'),(3,2,2,201,'reservado'),(4,2,2,202,'mantenimiento'),(5,3,3,301,'libre'),(6,3,3,302,'ocupado'),(7,4,4,401,'libre'),(8,5,5,501,'ocupado'),(9,9,9,901,'reservado'),(10,10,10,1001,'libre'),(11,1,1,101,'libre'),(12,1,1,102,'ocupado'),(13,2,2,201,'reservado'),(14,2,2,202,'mantenimiento'),(15,3,3,301,'libre'),(16,3,3,302,'ocupado'),(17,4,4,401,'libre'),(18,5,5,501,'ocupado'),(19,9,9,901,'reservado'),(20,10,10,1001,'libre');
/*!40000 ALTER TABLE `espacios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventario` (
  `id_inventario` int NOT NULL AUTO_INCREMENT,
  `usuarios_id_usuario` int NOT NULL,
  `inventario_roles_id_rol` int NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `cantidad` int NOT NULL DEFAULT '0',
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_inventario`,`usuarios_id_usuario`,`inventario_roles_id_rol`),
  KEY `fk_inventario_usuarios` (`id_usuario`),
  KEY `usuarios_inventario_fk` (`usuarios_id_usuario`,`inventario_roles_id_rol`),
  CONSTRAINT `fk_inventario_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `usuarios_inventario_fk` FOREIGN KEY (`usuarios_id_usuario`, `inventario_roles_id_rol`) REFERENCES `usuarios` (`id_usuario`, `roles_id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario`
--

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
INSERT INTO `inventario` VALUES (1,1,1,'Extintor PQS 6kg','Extintor de polvo químico seco para emergencias.',15,1),(2,1,1,'Tarjeta de Acceso RFID','Tarjetas para el lector de la entrada.',100,1),(3,2,2,'Cinta de Marcaje Amarilla','Para delimitar cajones en mantenimiento.',5,2),(4,2,2,'Candado de Alta Seguridad','Para bloqueo de espacios o portones.',20,2),(5,9,2,'Lámpara LED Suburbana','Reflector para iluminación de terrenos.',8,9),(6,1,1,'Pilas AA','Para los controles de los portones.',50,1),(7,2,2,'Foco LED 50W','Repuestos para las luminarias del patio.',12,2),(8,9,2,'Escoba Industrial','Para limpieza de los cajones.',6,9),(9,1,1,'Grava (Saco 50kg)','Para bacheo rápido de terracería.',30,1),(10,2,2,'Pintura Tráfico Blanca','Para pintar las líneas de los espacios.',4,2),(11,1,1,'Extintor PQS 6kg','Extintor de polvo químico seco para emergencias.',15,1),(12,1,1,'Tarjeta de Acceso RFID','Tarjetas para el lector de la entrada.',100,1),(13,2,2,'Cinta de Marcaje Amarilla','Para delimitar cajones en mantenimiento.',5,2),(14,2,2,'Candado de Alta Seguridad','Para bloqueo de espacios o portones.',20,2),(15,9,2,'Lámpara LED Suburbana','Reflector para iluminación de terrenos.',8,9),(16,1,1,'Pilas AA','Para los controles de los portones.',50,1),(17,2,2,'Foco LED 50W','Repuestos para las luminarias del patio.',12,2),(18,9,2,'Escoba Industrial','Para limpieza de los cajones.',6,9),(19,1,1,'Grava (Saco 50kg)','Para bacheo rápido de terracería.',30,1),(20,2,2,'Pintura Tráfico Blanca','Para pintar las líneas de los espacios.',4,2);
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `linea`
--

DROP TABLE IF EXISTS `linea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `linea` (
  `id_linea` int NOT NULL AUTO_INCREMENT,
  `nom_linea` varchar(80) NOT NULL,
  PRIMARY KEY (`id_linea`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `linea`
--

LOCK TABLES `linea` WRITE;
/*!40000 ALTER TABLE `linea` DISABLE KEYS */;
INSERT INTO `linea` VALUES (1,'Transportes del Centro'),(2,'Flecha Azul S.A.'),(3,'Logística Express'),(4,'Rápidos de la Región'),(5,'Carga Pesada de México'),(6,'Mudanzas Monterrey'),(7,'Autotransportes del Golfo'),(8,'Ruta Segura S.A.'),(9,'Enlaces Terrestres'),(10,'Fletes y Acarreos Texmelucan'),(11,'Transportes del Centro'),(12,'Flecha Azul S.A.'),(13,'Logística Express'),(14,'Rápidos de la Región'),(15,'Carga Pesada de México'),(16,'Mudanzas Monterrey'),(17,'Autotransportes del Golfo'),(18,'Ruta Segura S.A.'),(19,'Enlaces Terrestres'),(20,'Fletes y Acarreos Texmelucan');
/*!40000 ALTER TABLE `linea` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pagos` (
  `id_pago` int NOT NULL AUTO_INCREMENT,
  `id_inventario` int NOT NULL,
  `usuarios_id_usuario` int NOT NULL,
  `inventario_roles_id_rol` int NOT NULL,
  `id_reserva` int NOT NULL,
  `espacios_id_espacio` int NOT NULL,
  `terrenos_id_terreno` int NOT NULL,
  `id_usuario` int NOT NULL,
  `horas` varchar(10) NOT NULL DEFAULT '24',
  `folio` varchar(50) NOT NULL,
  `metodo` varchar(10) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'pendiente',
  `fecha_pago` datetime DEFAULT CURRENT_TIMESTAMP,
  `monto` varchar(10) NOT NULL,
  PRIMARY KEY (`id_pago`,`id_inventario`,`usuarios_id_usuario`,`inventario_roles_id_rol`,`id_reserva`,`espacios_id_espacio`,`terrenos_id_terreno`),
  KEY `inventario_pagos_fk` (`id_inventario`,`usuarios_id_usuario`,`inventario_roles_id_rol`),
  KEY `reservas_pagos_fk` (`id_reserva`,`espacios_id_espacio`,`terrenos_id_terreno`),
  CONSTRAINT `inventario_pagos_fk` FOREIGN KEY (`id_inventario`, `usuarios_id_usuario`, `inventario_roles_id_rol`) REFERENCES `inventario` (`id_inventario`, `usuarios_id_usuario`, `inventario_roles_id_rol`),
  CONSTRAINT `reservas_pagos_fk` FOREIGN KEY (`id_reserva`, `espacios_id_espacio`, `terrenos_id_terreno`) REFERENCES `reservas` (`id_reserva`, `espacios_id_espacio`, `terrenos_id_terreno`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
INSERT INTO `pagos` VALUES (11,1,1,1,1,1,2,3,'48','FOL-2026-001','Efectivo','pendiente','2026-05-27 17:45:12','1200.00'),(12,2,1,1,2,1,9,4,'24','FOL-2026-002','Tarjeta','pendiente','2026-05-27 17:45:12','600.00'),(13,3,2,2,3,1,1,7,'24','FOL-2026-003','Transfer','pendiente','2026-05-27 17:45:12','550.00'),(14,4,2,2,4,1,3,8,'72','FOL-2026-004','Efectivo','pendiente','2026-05-27 17:45:12','1800.00'),(15,5,9,2,5,1,4,10,'24','FOL-2026-005','Tarjeta','pendiente','2026-05-27 17:45:12','700.00'),(16,6,1,1,6,102,1,3,'120','FOL-2026-006','Transfer','pendiente','2026-05-27 17:45:12','3000.00'),(17,7,2,2,7,1,2,4,'24','FOL-2026-007','Efectivo','pendiente','2026-05-27 17:45:12','500.00'),(18,8,2,2,8,1,3,7,'48','FOL-2026-008','Tarjeta','pendiente','2026-05-27 17:45:12','1100.00'),(19,9,1,1,9,1,5,8,'24','FOL-2026-009','Transfer','pendiente','2026-05-27 17:45:12','650.00'),(20,10,2,2,10,1,10,10,'168','FOL-2026-010','Efectivo','pendiente','2026-05-27 17:45:12','4500.00');
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pensionados`
--

DROP TABLE IF EXISTS `pensionados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pensionados` (
  `id_pensionado` int NOT NULL AUTO_INCREMENT,
  `usuarios_id_usuario` int NOT NULL,
  `roles_id_rol` int NOT NULL,
  `espacios_id_espacio` int NOT NULL,
  `terrenos_id_terreno` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_espacio` int NOT NULL,
  `ultimo_pago` date DEFAULT NULL,
  `proximo_pago` date DEFAULT NULL,
  `estado_cuenta` varchar(15) DEFAULT NULL COMMENT 'al_corriente,pendiente,vencido',
  PRIMARY KEY (`id_pensionado`,`usuarios_id_usuario`,`roles_id_rol`,`espacios_id_espacio`,`terrenos_id_terreno`),
  KEY `fk_pensionados_espacios` (`id_espacio`),
  KEY `espacios_pensionados_fk` (`espacios_id_espacio`,`terrenos_id_terreno`),
  KEY `fk_pensionados_usuarios` (`id_usuario`),
  KEY `usuarios_pensionados_fk` (`usuarios_id_usuario`,`roles_id_rol`),
  CONSTRAINT `espacios_pensionados_fk` FOREIGN KEY (`espacios_id_espacio`, `terrenos_id_terreno`) REFERENCES `espacios` (`id_espacio`, `terrenos_id_terreno`),
  CONSTRAINT `fk_pensionados_espacios` FOREIGN KEY (`id_espacio`) REFERENCES `espacios` (`id_espacio`),
  CONSTRAINT `fk_pensionados_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `usuarios_pensionados_fk` FOREIGN KEY (`usuarios_id_usuario`, `roles_id_rol`) REFERENCES `usuarios` (`id_usuario`, `roles_id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pensionados`
--

LOCK TABLES `pensionados` WRITE;
/*!40000 ALTER TABLE `pensionados` DISABLE KEYS */;
INSERT INTO `pensionados` VALUES (11,3,3,1,1,3,1,'2026-05-01','2026-06-01','al_corriente'),(12,4,3,3,3,4,3,'2026-04-15','2026-05-15','pendiente'),(13,7,3,5,5,7,5,'2026-03-10','2026-04-10','vencido'),(14,8,3,1,1,8,1,'2026-05-20','2026-06-20','al_corriente'),(15,10,3,3,3,10,3,'2026-05-12','2026-06-12','al_corriente'),(16,3,3,4,4,3,4,'2026-05-01','2026-06-01','al_corriente'),(17,4,3,10,10,4,10,'2026-05-05','2026-06-05','al_corriente'),(18,7,3,1,1,7,1,'2026-05-18','2026-06-18','al_corriente'),(19,8,3,2,2,8,2,'2026-04-01','2026-05-01','pendiente'),(20,10,3,9,9,10,9,'2026-05-25','2026-06-25','al_corriente');
/*!40000 ALTER TABLE `pensionados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservas` (
  `id_reserva` int NOT NULL AUTO_INCREMENT,
  `espacios_id_espacio` int NOT NULL,
  `terrenos_id_terreno` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_camiones` int NOT NULL,
  `id_espacio` int NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL COMMENT 'pendiente,activa,finalizada,cancelada',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_reserva`,`espacios_id_espacio`,`terrenos_id_terreno`),
  KEY `fk_reservas_espacios` (`id_espacio`),
  KEY `espacios_reservas_fk` (`espacios_id_espacio`,`terrenos_id_terreno`),
  KEY `fk_reservas_usuarios` (`id_usuario`),
  KEY `fk_reservas_camiones` (`id_camiones`),
  CONSTRAINT `espacios_reservas_fk` FOREIGN KEY (`espacios_id_espacio`, `terrenos_id_terreno`) REFERENCES `espacios` (`id_espacio`, `terrenos_id_terreno`),
  CONSTRAINT `fk_reservas_camiones` FOREIGN KEY (`id_camiones`) REFERENCES `camiones` (`id_camiones`),
  CONSTRAINT `fk_reservas_espacios` FOREIGN KEY (`id_espacio`) REFERENCES `espacios` (`id_espacio`),
  CONSTRAINT `fk_reservas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` VALUES (11,1,2,3,1,1,'2026-06-01','2026-06-15','pendiente','2026-05-27 17:45:11'),(12,1,9,4,2,1,'2026-05-28','2026-06-05','activa','2026-05-27 17:45:11'),(13,1,1,7,3,1,'2026-05-01','2026-05-10','finalizada','2026-05-27 17:45:11'),(14,1,3,8,4,1,'2026-05-20','2026-05-22','cancelada','2026-05-27 17:45:11'),(15,1,4,10,5,1,'2026-06-05','2026-06-20','pendiente','2026-05-27 17:45:11'),(16,1,1,3,6,1,'2026-05-25','2026-06-25','activa','2026-05-27 17:45:11'),(17,1,2,4,7,1,'2026-06-10','2026-06-12','pendiente','2026-05-27 17:45:11'),(18,1,3,7,8,1,'2026-04-10','2026-04-15','finalizada','2026-05-27 17:45:11'),(19,1,5,8,9,1,'2026-05-26','2026-06-01','activa','2026-05-27 17:45:11'),(20,1,10,10,10,1,'2026-06-01','2026-06-30','pendiente','2026-05-27 17:45:11');
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `rol` varchar(40) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador'),(2,'Operador'),(3,'Pensionado'),(4,'Vigilante'),(5,'Gerente'),(6,'Cajero'),(7,'Supervisor'),(8,'Mantenimiento'),(9,'Auditor'),(10,'Soporte'),(11,'Administrador'),(12,'Operador'),(13,'Pensionado'),(14,'Vigilante'),(15,'Gerente'),(16,'Cajero'),(17,'Supervisor'),(18,'Mantenimiento'),(19,'Auditor'),(20,'Soporte');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terrenos`
--

DROP TABLE IF EXISTS `terrenos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `terrenos` (
  `id_terreno` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(80) NOT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_terreno`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terrenos`
--

LOCK TABLES `terrenos` WRITE;
/*!40000 ALTER TABLE `terrenos` DISABLE KEYS */;
INSERT INTO `terrenos` VALUES (1,'Terreno Norte','Ubicado en la zona industrial, alta capacidad para tractocamiones.'),(2,'Terreno Sur','Espacio pavimentado con vigilancia reforzada.'),(3,'Terreno Central','Cercano a las oficinas principales y talleres.'),(4,'Terreno Este','Exclusivo para cajas secas y remolques.'),(5,'Terreno Oeste','Zona de terracería compactada para maquinaria pesada.'),(6,'Anexo A','Espacio techado para camiones medianos.'),(7,'Anexo B','Área de resguardo temporal de carga.'),(8,'Patio Principal','Acceso directo a la carretera federal.'),(9,'Zona VIP','Espacios asignados con cámaras de seguridad exclusivas.'),(10,'Taller Mecánico','Área designada para reparaciones menores dentro de la pensión.'),(11,'Terreno Norte','Ubicado en la zona industrial, alta capacidad para tractocamiones.'),(12,'Terreno Sur','Espacio pavimentado con vigilancia reforzada.'),(13,'Terreno Central','Cercano a las oficinas principales y talleres.'),(14,'Terreno Este','Exclusivo para cajas secas y remolques.'),(15,'Terreno Oeste','Zona de terracería compactada para maquinaria pesada.'),(16,'Anexo A','Espacio techado para camiones medianos.'),(17,'Anexo B','Área de resguardo temporal de carga.'),(18,'Patio Principal','Acceso directo a la carretera federal.'),(19,'Zona VIP','Espacios asignados con cámaras de seguridad exclusivas.'),(20,'Taller Mecánico','Área designada para reparaciones menores dentro de la pensión.');
/*!40000 ALTER TABLE `terrenos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `roles_id_rol` int NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `ap` varchar(80) NOT NULL,
  `am` varchar(80) DEFAULT NULL,
  `alias` varchar(60) DEFAULT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(120) NOT NULL,
  `id_rol` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`,`roles_id_rol`),
  KEY `fk_usuarios_roles` (`id_rol`),
  KEY `roles_usuarios_fk` (`roles_id_rol`),
  CONSTRAINT `fk_usuarios_roles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  CONSTRAINT `roles_usuarios_fk` FOREIGN KEY (`roles_id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,1,'Antonio','Pérez','Gómez','TonyAdmin','tony_admin','password123','2481002030','tony@tractopension.com',1,'2026-05-27 17:43:24'),(2,2,'Juan','López','Martínez','Juancho','juan_op','op456','2481112233','juan@tractopension.com',2,'2026-05-27 17:43:24'),(3,3,'Carlos','Rodríguez','Sánchez','Charly','carlos_pen','pension789','2482223344','carlos@pension.com',3,'2026-05-27 17:43:24'),(4,3,'Luis','Hernández','Díaz','Luisillo','luis_pen','pension111','2483334455','luis@pension.com',3,'2026-05-27 17:43:24'),(5,4,'Pedro','Ramírez','Luna','Peter','pedro_vig','vigilante222','2484445566','pedro@tractopension.com',4,'2026-05-27 17:43:24'),(6,5,'Ana','Martínez','Torres','Anny','ana_gerente','gerente333','2485556677','ana@tractopension.com',5,'2026-05-27 17:43:24'),(7,3,'Jorge','García','Flores','George','jorge_pen','pension444','2486667788','jorge@pension.com',3,'2026-05-27 17:43:24'),(8,3,'Miguel','Cruz','Morales','Mike','mike_pen','pension555','2487778899','mike@pension.com',3,'2026-05-27 17:43:24'),(9,2,'Sofia','Vázquez','Castro','Sofi','sofi_op','op888','2488889900','sofia@tractopension.com',2,'2026-05-27 17:43:24'),(10,3,'David','Reyes','Juárez','Dave','david_pen','pension999','2489990011','david@pension.com',3,'2026-05-27 17:43:24'),(11,1,'Antonio','Pérez','Gómez','TonyAdmin','tony_admin','password123','2481002030','tony@tractopension.com',1,'2026-05-27 17:45:07'),(12,2,'Juan','López','Martínez','Juancho','juan_op','op456','2481112233','juan@tractopension.com',2,'2026-05-27 17:45:07'),(13,3,'Carlos','Rodríguez','Sánchez','Charly','carlos_pen','pension789','2482223344','carlos@pension.com',3,'2026-05-27 17:45:07'),(14,3,'Luis','Hernández','Díaz','Luisillo','luis_pen','pension111','2483334455','luis@pension.com',3,'2026-05-27 17:45:07'),(15,4,'Pedro','Ramírez','Luna','Peter','pedro_vig','vigilante222','2484445566','pedro@tractopension.com',4,'2026-05-27 17:45:07'),(16,5,'Ana','Martínez','Torres','Anny','ana_gerente','gerente333','2485556677','ana@tractopension.com',5,'2026-05-27 17:45:07'),(17,3,'Jorge','García','Flores','George','jorge_pen','pension444','2486667788','jorge@pension.com',3,'2026-05-27 17:45:07'),(18,3,'Miguel','Cruz','Morales','Mike','mike_pen','pension555','2487778899','mike@pension.com',3,'2026-05-27 17:45:07'),(19,2,'Sofia','Vázquez','Castro','Sofi','sofi_op','op888','2488889900','sofia@tractopension.com',2,'2026-05-27 17:45:07'),(20,3,'David','Reyes','Juárez','Dave','david_pen','pension999','2489990011','david@pension.com',3,'2026-05-27 17:45:07');
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

-- Dump completed on 2026-07-24 15:40:20
