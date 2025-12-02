/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.0.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: mtvawards
-- ------------------------------------------------------
-- Server version	12.0.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `albumes`
--

DROP TABLE IF EXISTS `albumes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `albumes` (
  `id_album` int(3) NOT NULL AUTO_INCREMENT,
  `estatus_album` tinyint(2) NOT NULL,
  `fecha_lanzamiento_album` date NOT NULL,
  `titulo_album` varchar(50) NOT NULL,
  `descripcion_album` text DEFAULT NULL,
  `imagen_album` varchar(200) DEFAULT NULL,
  `id_artista` int(3) NOT NULL,
  `id_genero` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_album`),
  KEY `id_artista` (`id_artista`),
  KEY `id_genero` (`id_genero`),
  CONSTRAINT `albumes_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `artistas` (`id_artista`),
  CONSTRAINT `albumes_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albumes`
--

LOCK TABLES `albumes` WRITE;
/*!40000 ALTER TABLE `albumes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `albumes` VALUES
(26,0,'2025-11-04','Un verano sin ti','si',NULL,11,4),
(27,1,'2025-11-05','Un verano sin ti','gffgndhgdc','/recursos/assets/uploads/album/1764557904_verano.jpg',11,4);
/*!40000 ALTER TABLE `albumes` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `artistas`
--

DROP TABLE IF EXISTS `artistas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `artistas` (
  `id_artista` int(3) NOT NULL AUTO_INCREMENT,
  `estatus_artista` tinyint(2) NOT NULL,
  `pseudonimo_artista` varchar(50) NOT NULL,
  `nacionalidad_artista` varchar(100) DEFAULT NULL,
  `biografia_artista` text DEFAULT NULL,
  `id_usuario` int(3) NOT NULL,
  `id_genero` int(3) DEFAULT NULL,
  `imagen_artista` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_artista`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  KEY `id_genero` (`id_genero`),
  CONSTRAINT `artistas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  CONSTRAINT `artistas_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artistas`
--

LOCK TABLES `artistas` WRITE;
/*!40000 ALTER TABLE `artistas` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `artistas` VALUES
(10,1,'Faraon GOD','Peruano','El dios de la versatilidad',14,4,'recursos/assets/uploads/artistas/1764557080_images.webp'),
(11,1,'Bad Bunny','Peruano','xd',5,4,'recursos/assets/uploads/artistas/1764557410_badbunny.jpg');
/*!40000 ALTER TABLE `artistas` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `canciones`
--

DROP TABLE IF EXISTS `canciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `canciones` (
  `id_cancion` int(3) NOT NULL AUTO_INCREMENT,
  `estatus_cancion` tinyint(2) NOT NULL,
  `nombre_cancion` varchar(50) NOT NULL,
  `fecha_lanzamiento_cancion` date NOT NULL,
  `duracion_cancion` time DEFAULT NULL,
  `mp3_cancion` varchar(200) DEFAULT NULL,
  `url_cancion` varchar(200) DEFAULT NULL,
  `url_video_cancion` varchar(200) DEFAULT NULL,
  `id_artista` int(3) NOT NULL,
  `id_genero` int(3) NOT NULL,
  `imagen_cancion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_cancion`),
  KEY `id_artista` (`id_artista`),
  KEY `id_genero` (`id_genero`),
  CONSTRAINT `canciones_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `artistas` (`id_artista`),
  CONSTRAINT `canciones_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canciones`
--

LOCK TABLES `canciones` WRITE;
/*!40000 ALTER TABLE `canciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `canciones` VALUES
(4,1,'Neverita','2025-11-04','00:03:00',NULL,NULL,'',11,4,'recursos/assets/uploads/canciones/1764558216_1764555833verano.jpg');
/*!40000 ALTER TABLE `canciones` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `categorias_nominaciones`
--

DROP TABLE IF EXISTS `categorias_nominaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias_nominaciones` (
  `id_categoria_nominacion` int(3) NOT NULL AUTO_INCREMENT,
  `estatus_categoria_nominacion` tinyint(2) NOT NULL,
  `tipo_categoria_nominacion` tinyint(2) NOT NULL,
  `nombre_categoria_nominacion` varchar(50) NOT NULL,
  `fecha_categoria_nominacion` date NOT NULL,
  PRIMARY KEY (`id_categoria_nominacion`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias_nominaciones`
--

LOCK TABLES `categorias_nominaciones` WRITE;
/*!40000 ALTER TABLE `categorias_nominaciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `categorias_nominaciones` VALUES
(1,1,3,'Peor cancion','2025-12-17'),
(2,1,3,'Mejor cancion','2025-12-17'),
(3,1,1,'Mejor artista','2025-12-17'),
(4,1,2,'Mejor arbum','2025-12-17');
/*!40000 ALTER TABLE `categorias_nominaciones` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `generos`
--

DROP TABLE IF EXISTS `generos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `generos` (
  `id_genero` int(3) NOT NULL AUTO_INCREMENT,
  `estatus_genero` tinyint(2) NOT NULL,
  `nombre_genero` varchar(50) NOT NULL,
  PRIMARY KEY (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `generos`
--

LOCK TABLES `generos` WRITE;
/*!40000 ALTER TABLE `generos` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `generos` VALUES
(1,1,'Pop'),
(2,0,'Rock'),
(3,1,'Rock'),
(4,1,'Urbano'),
(5,0,'Pop'),
(6,1,'Rock'),
(7,1,'Regional Mexicano'),
(8,1,'Bachata');
/*!40000 ALTER TABLE `generos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `multimedia_canciones`
--

DROP TABLE IF EXISTS `multimedia_canciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `multimedia_canciones` (
  `id_multimedia_cancion` int(3) NOT NULL AUTO_INCREMENT,
  `estatus_album` tinyint(2) NOT NULL,
  `formato_mp3` varchar(250) DEFAULT NULL,
  `url_streaming` varchar(250) DEFAULT NULL,
  `url_video_clip` varchar(250) DEFAULT NULL,
  `id_cancion` int(3) NOT NULL,
  PRIMARY KEY (`id_multimedia_cancion`),
  KEY `id_cancion` (`id_cancion`),
  CONSTRAINT `multimedia_canciones_ibfk_1` FOREIGN KEY (`id_cancion`) REFERENCES `canciones` (`id_cancion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multimedia_canciones`
--

LOCK TABLES `multimedia_canciones` WRITE;
/*!40000 ALTER TABLE `multimedia_canciones` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `multimedia_canciones` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `nominaciones`
--

DROP TABLE IF EXISTS `nominaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `nominaciones` (
  `id_nominacion` int(3) NOT NULL AUTO_INCREMENT,
  `fecha_nominacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_categoria_nominacion` int(3) NOT NULL,
  `id_artista` int(3) DEFAULT NULL,
  `id_album` int(3) DEFAULT NULL,
  `contador_nominacion` int(10) DEFAULT 0,
  `id_cancion` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_nominacion`),
  KEY `id_categoria_nominacion` (`id_categoria_nominacion`),
  KEY `id_artista` (`id_artista`),
  KEY `id_album` (`id_album`),
  KEY `nominaciones_ibfk_4` (`id_cancion`),
  CONSTRAINT `nominaciones_ibfk_1` FOREIGN KEY (`id_categoria_nominacion`) REFERENCES `categorias_nominaciones` (`id_categoria_nominacion`),
  CONSTRAINT `nominaciones_ibfk_2` FOREIGN KEY (`id_artista`) REFERENCES `artistas` (`id_artista`),
  CONSTRAINT `nominaciones_ibfk_3` FOREIGN KEY (`id_album`) REFERENCES `albumes` (`id_album`),
  CONSTRAINT `nominaciones_ibfk_4` FOREIGN KEY (`id_cancion`) REFERENCES `canciones` (`id_cancion`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nominaciones`
--

LOCK TABLES `nominaciones` WRITE;
/*!40000 ALTER TABLE `nominaciones` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `nominaciones` VALUES
(13,'2025-12-01 03:02:44',4,NULL,27,0,NULL),
(14,'2025-12-01 03:03:04',3,11,NULL,0,NULL),
(15,'2025-12-01 03:03:43',2,NULL,NULL,0,4),
(16,'2025-12-01 03:03:46',1,NULL,NULL,0,4);
/*!40000 ALTER TABLE `nominaciones` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id_rol` int(3) NOT NULL,
  `rol` varchar(50) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `roles` VALUES
(1,'Administrador'),
(2,'Usuario'),
(3,'Artista');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(3) NOT NULL AUTO_INCREMENT,
  `estatus_usuario` tinyint(2) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `ap_usuario` varchar(50) NOT NULL,
  `am_usuario` varchar(50) DEFAULT NULL,
  `sexo_usuario` tinyint(2) DEFAULT NULL,
  `correo_usuario` varchar(50) NOT NULL,
  `password_usuario` varchar(64) NOT NULL,
  `imagen_usuario` varchar(200) DEFAULT NULL,
  `id_rol` int(3) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `correo_usuario` (`correo_usuario`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `usuarios` VALUES
(1,1,'Jesus','Cuapio','Mendoza',1,'cuapiomendoza5@hotmail.com','$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri',NULL,2),
(2,1,'Admin','Principal','Sistema',1,'admin1@mtv.com','$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri',NULL,1),
(3,1,'Jesus','Cuapio','Mendoza',2,'jesuscuapio66@gmail.com','$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri',NULL,1),
(4,1,'Taylor','Swift','',2,'taylor@mtv.com','$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri',NULL,3),
(5,1,'Bad','Bunny','',1,'badbunny@mtv.com','$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri',NULL,3),
(6,1,'Dua','Lipa','',2,'dua@mtv.com','$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri',NULL,3),
(7,1,'Bad','Bunny',NULL,1,'benito@mtv.com','$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri',NULL,3),
(8,1,'Abel','Tesfaye',NULL,1,'theweeknd@mtv.com','$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri',NULL,3),
(9,1,'Hassan','Kabande',NULL,1,'doblep@mtv.com','$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri',NULL,3),
(10,1,'Dan','Reynolds',NULL,1,'imaginedragons@mtv.com','$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri',NULL,3),
(11,1,'Shakira','Mebarak',NULL,2,'shakira@mtv.com','$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri',NULL,3),
(12,1,'Selena','Gomez',NULL,2,'selena@mtv.com','$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri',NULL,3),
(13,1,'Anthony','Santos',NULL,1,'romeo@mtv.com','$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri',NULL,3),
(14,1,'Jesús','Valle','Choque',1,'faraon@mtv.com','$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri',NULL,3);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `votaciones`
--

DROP TABLE IF EXISTS `votaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `votaciones` (
  `id_votacion` int(3) NOT NULL AUTO_INCREMENT,
  `fecha_votacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_nominacion` int(3) NOT NULL,
  `id_usuario` int(3) NOT NULL,
  PRIMARY KEY (`id_votacion`),
  UNIQUE KEY `uk_voto_usuario_nominacion` (`id_nominacion`,`id_usuario`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `votaciones_ibfk_1` FOREIGN KEY (`id_nominacion`) REFERENCES `nominaciones` (`id_nominacion`),
  CONSTRAINT `votaciones_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votaciones`
--

LOCK TABLES `votaciones` WRITE;
/*!40000 ALTER TABLE `votaciones` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `votaciones` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-11-30 21:08:26
