-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-12-2025 a las 04:35:26
-- Versión del servidor: 9.1.0
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mtvawards`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--

DROP TABLE IF EXISTS `albumes`;
CREATE TABLE IF NOT EXISTS `albumes` (
  `id_album` int NOT NULL AUTO_INCREMENT,
  `estatus_album` tinyint NOT NULL,
  `fecha_lanzamiento_album` date NOT NULL,
  `titulo_album` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion_album` text COLLATE utf8mb4_general_ci,
  `imagen_album` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_artista` int NOT NULL,
  `id_genero` int DEFAULT NULL,
  PRIMARY KEY (`id_album`),
  KEY `id_artista` (`id_artista`),
  KEY `id_genero` (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`id_album`, `estatus_album`, `fecha_lanzamiento_album`, `titulo_album`, `descripcion_album`, `imagen_album`, `id_artista`, `id_genero`) VALUES
(1, 1, '2014-02-25', 'Fórmula Vol. 2', 'Éxitos de bachata.', 'recursos/assets/uploads/album/formula_vol2.jpg', 3, 8),
(2, 1, '2022-09-01', 'Fórmula Vol. 3', 'Continuación del legado.', 'recursos/assets/uploads/album/formula_vol3.jpg', 3, 8),
(3, 1, '2019-04-05', 'Utopía', 'Colaboraciones clásicas.', 'recursos/assets/uploads/album/utopia.jpg', 3, 8),
(4, 1, '2020-01-01', 'Better Late Than Never', 'Recopilatorio.', 'recursos/assets/uploads/album/better_late_than_never.jpg', 3, 8),
(5, 1, '2001-08-27', 'Laundry Service', 'Crossover mundial.', 'recursos/assets/uploads/album/laundry_service.jpg', 7, 1),
(6, 1, '2005-06-03', 'Fijación Oral Vol. 1', 'Pop rock en español.', 'recursos/assets/uploads/album/fijacion_oral_vol1.jpg', 7, 1),
(7, 1, '2009-10-19', 'She Wolf', 'Electrónico.', 'recursos/assets/uploads/album/she_wolf.jpg', 7, 1),
(8, 1, '2014-03-21', 'Shakira.', 'Álbum homónimo.', 'recursos/assets/uploads/album/shakira_album.jpg', 7, 1),
(9, 1, '2013-09-10', 'Kiss Land', 'Atmósfera oscura.', 'recursos/assets/uploads/album/kiss_land.jpg', 4, 15),
(10, 1, '2015-08-28', 'Beauty Behind the Madness', 'Éxito pop.', 'recursos/assets/uploads/album/beauty_behind_madness.jpg', 4, 15),
(11, 1, '2020-03-20', 'After Hours', 'Vibra ochentera.', 'recursos/assets/uploads/album/after_hours.jpg', 4, 15),
(12, 1, '2015-08-28', 'Beauty Madness', 'Versión alternativa.', 'recursos/assets/uploads/album/beauty_madness.jpg', 4, 15),
(13, 1, '2009-09-29', 'Kiss & Tell', 'Pop rock debut.', 'recursos/assets/uploads/album/kiss_tell.jpg', 7, 1),
(14, 1, '2013-07-19', 'Stars Dance', 'Dance pop.', 'recursos/assets/uploads/album/stars_dance.jpg', 7, 1),
(15, 1, '2015-10-09', 'Revival', 'Madurez artística.', 'recursos/assets/uploads/album/revival.jpg', 7, 1),
(16, 1, '2015-10-09', 'Revival Deluxe', 'Edición especial.', 'recursos/assets/uploads/album/revival_album.jpg', 7, 1),
(17, 1, '2022-05-06', 'Un Verano Sin Ti', 'El hit del verano.', 'recursos/assets/uploads/album/1764557904_verano.jpg', 2, 5),
(18, 1, '2020-02-29', 'YHLQMDLG', 'Old school reguetón.', 'recursos/assets/uploads/album/yhlqmdlg.jpg', 2, 5),
(19, 1, '2023-10-13', 'Nadie Sabe Lo Que Va a Pasar', 'Trap duro.', 'recursos/assets/uploads/album/nadiesabe.jpg', 2, 5),
(20, 1, '2022-05-06', 'Verano', 'Versión alternativa.', 'recursos/assets/uploads/album/verano.jpg', 2, 5),
(21, 1, '2023-07-14', 'Pa Las Babys', 'Corridos modernos.', 'recursos/assets/uploads/album/baby_belikeada.jpg', 9, 13),
(22, 1, '2022-11-18', 'Del Barrio Hasta Aquí', 'Historias de vida.', 'recursos/assets/uploads/album/barrio_vol2.jpg', 9, 13),
(23, 1, '2021-06-25', 'Otro Pedo, Otro Nivel', 'Rompiendo esquemas.', 'recursos/assets/uploads/album/otro_nivel.jpg', 9, 13),
(24, 1, '2023-06-22', 'GÉNESIS', 'Consolidación mundial.', 'recursos/assets/uploads/album/genesis.jpg', 8, 13),
(25, 1, '2022-08-15', 'Efectos Secundarios', 'Corridos bélicos.', 'recursos/assets/uploads/album/efectos_secundarios.jpg', 8, 13),
(26, 1, '2021-01-10', 'Ah y Qué?', 'Los inicios.', 'recursos/assets/uploads/album/ahyque.jpg', 8, 13),
(27, 1, '2024-08-01', 'Los Cuadros', 'Estilo callejero.', 'recursos/assets/uploads/album/los_cuadros.jpg', 11, 13),
(28, 1, '2023-03-15', 'Puro Pa La Raza', 'Para la gente.', 'recursos/assets/uploads/album/puro_raza.jpg', 11, 13),
(29, 1, '2022-10-10', 'La Vida Es Una', 'Reflexiones.', 'recursos/assets/uploads/album/vida_una.jpg', 11, 13),
(30, 1, '2012-09-04', 'Night Visions', 'Radioactive.', 'recursos/assets/uploads/album/night_visions.jpg', 10, 2),
(31, 1, '2017-06-23', 'Evolve', 'Thunder.', 'recursos/assets/uploads/album/evolve.jpg', 10, 2),
(32, 1, '2021-09-03', 'Mercury', 'Act 1.', 'recursos/assets/uploads/album/mercury_act1.jpg', 10, 2),
(33, 1, '2012-03-09', 'Muerte', 'Vida y Muerte.', 'recursos/assets/uploads/album/muerte.jpg', 6, 4),
(34, 1, '2017-08-25', '17', 'Depresión y arte.', 'recursos/assets/uploads/album/albumXTentacion.jpg', 5, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artistas`
--

DROP TABLE IF EXISTS `artistas`;
CREATE TABLE IF NOT EXISTS `artistas` (
  `id_artista` int NOT NULL AUTO_INCREMENT,
  `estatus_artista` tinyint NOT NULL,
  `pseudonimo_artista` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nacionalidad_artista` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `biografia_artista` text COLLATE utf8mb4_general_ci,
  `id_usuario` int NOT NULL,
  `id_genero` int DEFAULT NULL,
  `imagen_artista` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_artista`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  KEY `id_genero` (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `artistas`
--

INSERT INTO `artistas` (`id_artista`, `estatus_artista`, `pseudonimo_artista`, `nacionalidad_artista`, `biografia_artista`, `id_usuario`, `id_genero`, `imagen_artista`) VALUES
(1, 1, 'Faraón Love Shady', 'Peruano', 'El dios de la versatilidad.', 10, 5, 'recursos/assets/uploads/artistas/1764557080_images.webp'),
(2, 1, 'Bad Bunny', 'Puertorriqueño', 'Ícono mundial del trap.', 11, 5, 'recursos/assets/uploads/artistas/1764557410_badbunny.jpg'),
(3, 1, 'Romeo Santos', 'Estadounidense', 'El Rey de la Bachata.', 12, 8, 'recursos/assets/uploads/artistas/romeo_santos.jpg'),
(4, 1, 'The Weeknd', 'Canadiense', 'Estrella del pop y R&B.', 13, 15, 'recursos/assets/uploads/artistas/the_weeknd.png'),
(5, 1, 'XXXTentacion', 'Estadounidense', 'Leyenda del emo rap.', 14, 4, 'recursos/assets/uploads/artistas/Xxxtentacion.jpg'),
(6, 1, 'Canserbero', 'Venezolano', 'Ícono del rap conciencia.', 15, 4, 'recursos/assets/uploads/artistas/canserberojpg.jpg'),
(7, 1, 'Selena Gomez', 'Estadounidense', 'Reina del pop.', 16, 1, 'recursos/assets/uploads/artistas/selena_gomez.jpg'),
(8, 1, 'Peso Pluma', 'Mexicano', 'La Doble P.', 17, 13, 'recursos/assets/uploads/artistas/pesopluma.jpg'),
(9, 1, 'Fuerza Regida', 'Mexicana', 'Corridos tumbados y banda.', 18, 13, 'recursos/assets/uploads/artistas/fuerzaregida.jpg'),
(10, 1, 'Imagine Dragons', 'Estadounidense', 'Banda de pop rock.', 19, 2, 'recursos/assets/uploads/artistas/imaginedragons.jpg'),
(11, 1, 'Tito Double P', 'Mexicano', 'Compositor y cantante.', 20, 13, 'recursos/assets/uploads/artistas/titodoublep.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canciones`
--

DROP TABLE IF EXISTS `canciones`;
CREATE TABLE IF NOT EXISTS `canciones` (
  `id_cancion` int NOT NULL AUTO_INCREMENT,
  `estatus_cancion` tinyint NOT NULL,
  `nombre_cancion` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_lanzamiento_cancion` date NOT NULL,
  `duracion_cancion` time DEFAULT NULL,
  `mp3_cancion` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url_cancion` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url_video_cancion` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_album` int DEFAULT NULL,
  `id_artista` int NOT NULL,
  `id_genero` int NOT NULL,
  `imagen_cancion` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_cancion`),
  KEY `id_artista` (`id_artista`),
  KEY `id_genero` (`id_genero`),
  KEY `fk_cancion_album` (`id_album`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `canciones`
--

INSERT INTO `canciones` (`id_cancion`, `estatus_cancion`, `nombre_cancion`, `fecha_lanzamiento_cancion`, `duracion_cancion`, `mp3_cancion`, `url_cancion`, `url_video_cancion`, `id_album`, `id_artista`, `id_genero`, `imagen_cancion`) VALUES
(1, 1, 'Un Verano Sin Ti (Canción)', '2022-05-06', '00:03:00', 'recursos/assets/uploads/canciones/Bad Bunny - Un Verano Sin Ti.mp3', NULL, 'https://youtu.be/NBghhjuMNKM?si=dBcfQYjdouGEooTh', 17, 2, 5, 'recursos/assets/uploads/canciones/1764555833_verano.jpg'),
(2, 1, 'Propuesta Indecente', '2013-07-29', '00:04:00', NULL, NULL, 'https://youtu.be/QFs3PIZb3js?si=9krQqTAi1h-Vx6XH', 1, 3, 8, 'recursos/assets/uploads/artistas/romeo_santos.jpg'),
(3, 1, 'Blinding Lights', '2019-11-29', '00:03:20', NULL, NULL, 'https://youtu.be/4NRXx6U8ABQ?si=Mfh5-8yHL6rnrblN', 9, 4, 15, 'recursos/assets/uploads/artistas/the_weeknd.png'),
(4, 1, 'Ella Baila Sola', '2023-03-15', '00:03:00', NULL, NULL, 'https://youtu.be/lZiaYpD9ZrI?si=9Qkh149rTCOvSCLF', 24, 8, 13, 'recursos/assets/uploads/album/genesis.jpg'),
(5, 1, 'TQM', '2023-05-19', '00:02:50', NULL, NULL, 'https://www.youtube.com/watch?v=9_g-R-e_e_e', 21, 9, 13, 'recursos/assets/uploads/album/baby_belikeada.jpg'),
(6, 1, 'Believer', '2017-02-01', '00:03:24', NULL, NULL, 'https://www.youtube.com/watch?v=7wtfhZwyrcc', 31, 10, 2, 'recursos/assets/uploads/album/evolve.jpg'),
(7, 1, 'Come & Get It', '2013-04-07', '00:03:51', NULL, NULL, 'https://www.youtube.com/watch?v=n-D1EB74Ckg', 14, 7, 1, 'recursos/assets/uploads/album/stars_dance.jpg'),
(8, 1, 'Es Épico', '2012-03-09', '00:05:00', NULL, NULL, 'https://www.youtube.com/watch?v=SQoA_wjmE9w', 33, 6, 4, 'recursos/assets/uploads/album/muerte.jpg'),
(9, 1, 'SAD!', '2018-03-02', '00:02:46', NULL, NULL, 'https://www.youtube.com/watch?v=pgN-vvVVxMA', 34, 5, 4, 'recursos/assets/uploads/album/albumXTentacion.jpg'),
(10, 1, 'Duro', '2021-01-01', '00:03:00', NULL, NULL, 'https://www.youtube.com/watch?v=duro', 17, 1, 5, 'recursos/assets/uploads/artistas/1764557080_images.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_nominaciones`
--

DROP TABLE IF EXISTS `categorias_nominaciones`;
CREATE TABLE IF NOT EXISTS `categorias_nominaciones` (
  `id_categoria_nominacion` int NOT NULL AUTO_INCREMENT,
  `estatus_categoria_nominacion` tinyint NOT NULL,
  `tipo_categoria_nominacion` tinyint NOT NULL,
  `nombre_categoria_nominacion` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha_categoria_nominacion` date NOT NULL,
  PRIMARY KEY (`id_categoria_nominacion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_nominaciones`
--

INSERT INTO `categorias_nominaciones` (`id_categoria_nominacion`, `estatus_categoria_nominacion`, `tipo_categoria_nominacion`, `nombre_categoria_nominacion`, `fecha_categoria_nominacion`) VALUES
(1, 1, 1, 'Mejor Artista del Año', '2025-12-31'),
(2, 1, 2, 'Álbum del Año', '2025-12-31'),
(3, 1, 3, 'Canción del Año', '2025-12-31'),
(4, 1, 1, 'Artista Revelación', '2025-12-31'),
(5, 1, 3, 'Mejor Video Musical', '2025-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

DROP TABLE IF EXISTS `generos`;
CREATE TABLE IF NOT EXISTS `generos` (
  `id_genero` int NOT NULL AUTO_INCREMENT,
  `estatus_genero` tinyint NOT NULL,
  `nombre_genero` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id_genero`, `estatus_genero`, `nombre_genero`) VALUES
(1, 1, 'Pop'),
(2, 1, 'Rock'),
(3, 1, 'Hip Hop'),
(4, 1, 'Rap'),
(5, 1, 'Reguetón'),
(6, 1, 'Salsa'),
(7, 1, 'Merengue'),
(8, 1, 'Bachata'),
(9, 1, 'Cumbia'),
(10, 1, 'Ranchera'),
(13, 1, 'Corridos Tumbados'),
(15, 1, 'R&B'),
(16, 1, 'Regional Mexicano');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia_canciones`
--

DROP TABLE IF EXISTS `multimedia_canciones`;
CREATE TABLE IF NOT EXISTS `multimedia_canciones` (
  `id_multimedia_cancion` int NOT NULL AUTO_INCREMENT,
  `estatus_album` tinyint NOT NULL,
  `formato_mp3` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url_streaming` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url_video_clip` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_cancion` int NOT NULL,
  PRIMARY KEY (`id_multimedia_cancion`),
  KEY `id_cancion` (`id_cancion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nominaciones`
--

DROP TABLE IF EXISTS `nominaciones`;
CREATE TABLE IF NOT EXISTS `nominaciones` (
  `id_nominacion` int NOT NULL AUTO_INCREMENT,
  `fecha_nominacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_categoria_nominacion` int NOT NULL,
  `id_artista` int DEFAULT NULL,
  `id_album` int DEFAULT NULL,
  `contador_nominacion` int DEFAULT '0',
  `id_cancion` int DEFAULT NULL,
  PRIMARY KEY (`id_nominacion`),
  KEY `id_categoria_nominacion` (`id_categoria_nominacion`),
  KEY `id_artista` (`id_artista`),
  KEY `id_album` (`id_album`),
  KEY `nominaciones_ibfk_4` (`id_cancion`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nominaciones`
--

INSERT INTO `nominaciones` (`id_nominacion`, `fecha_nominacion`, `id_categoria_nominacion`, `id_artista`, `id_album`, `contador_nominacion`, `id_cancion`) VALUES
(1, '2025-12-07 02:46:41', 1, 2, NULL, 150, NULL),
(2, '2025-12-07 02:46:41', 1, 4, NULL, 140, NULL),
(3, '2025-12-07 02:46:41', 1, 7, NULL, 120, NULL),
(4, '2025-12-07 02:46:41', 1, 8, NULL, 180, NULL),
(5, '2025-12-07 02:46:41', 1, 10, NULL, 110, NULL),
(6, '2025-12-07 02:46:41', 2, NULL, 17, 200, NULL),
(7, '2025-12-07 02:46:41', 2, NULL, 24, 190, NULL),
(8, '2025-12-07 02:46:41', 2, NULL, 33, 160, NULL),
(9, '2025-12-07 02:46:41', 2, NULL, 32, 140, NULL),
(10, '2025-12-07 02:46:41', 2, NULL, 14, 130, NULL),
(11, '2025-12-07 02:46:41', 3, NULL, NULL, 220, 1),
(12, '2025-12-07 02:46:41', 3, NULL, NULL, 210, 4),
(13, '2025-12-07 02:46:41', 3, NULL, NULL, 180, 3),
(14, '2025-12-07 02:46:41', 3, NULL, NULL, 170, 9),
(15, '2025-12-07 02:46:41', 4, 1, NULL, 300, NULL),
(16, '2025-12-07 02:46:41', 4, 11, NULL, 250, NULL),
(17, '2025-12-07 02:46:41', 4, 8, NULL, 200, NULL),
(18, '2025-12-07 02:46:42', 5, NULL, NULL, 90, 1),
(19, '2025-12-07 02:46:42', 5, NULL, NULL, 85, 6),
(20, '2025-12-07 02:46:42', 5, NULL, NULL, 120, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol` int NOT NULL,
  `rol` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Manager'),
(3, 'Artista'),
(4, 'Audiencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `estatus_usuario` tinyint NOT NULL,
  `nombre_usuario` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ap_usuario` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `am_usuario` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sexo_usuario` tinyint DEFAULT NULL,
  `correo_usuario` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password_usuario` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `imagen_usuario` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_rol` int NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `correo_usuario` (`correo_usuario`),
  KEY `id_rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `estatus_usuario`, `nombre_usuario`, `ap_usuario`, `am_usuario`, `sexo_usuario`, `correo_usuario`, `password_usuario`, `imagen_usuario`, `id_rol`) VALUES
(1, 1, 'Admin', 'Sistema', NULL, NULL, 'usermtv@awards.com', '$2y$10$8ZanoeVwB3RnndvkXOm8..y9hTfwUIqaH8pvavLOlVcFpmSzgpKoO', NULL, 1),
(2, 1, 'Manager', 'Latino', NULL, NULL, 'manager_latino@mtv.com', '$2y$10$Xw6Lx.Fj.x7.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x', NULL, 2),
(3, 1, 'Manager', 'USA', NULL, NULL, 'manager_usa@mtv.com', '$2y$10$Xw6Lx.Fj.x7.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x', NULL, 2),
(10, 1, 'Faraon', 'Shady', NULL, NULL, 'faraon@mtv.com', '$2y$10$Xw6Lx.Fj.x7.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x', NULL, 3),
(11, 1, 'Bad', 'Bunny', NULL, NULL, 'benito@mtv.com', '$2y$10$Xw6Lx.Fj.x7.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x', NULL, 3),
(12, 1, 'Romeo', 'Santos', NULL, NULL, 'romeo@mtv.com', '$2y$10$Xw6Lx.Fj.x7.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x', NULL, 3),
(13, 1, 'Abel', 'Weeknd', NULL, NULL, 'weeknd@mtv.com', '$2y$10$Xw6Lx.Fj.x7.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x', NULL, 3),
(14, 1, 'Jahseh', 'Onfroy', NULL, NULL, 'xxx@mtv.com', '$2y$10$Xw6Lx.Fj.x7.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x', NULL, 3),
(15, 1, 'Tirone', 'Gonzalez', NULL, NULL, 'can@mtv.com', '$2y$10$Xw6Lx.Fj.x7.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x', NULL, 3),
(16, 1, 'Selena', 'Gomez', NULL, NULL, 'selena@mtv.com', '$2y$10$Xw6Lx.Fj.x7.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x', NULL, 3),
(17, 1, 'Hassan', 'Kabande', NULL, NULL, 'peso@mtv.com', '$2y$10$Xw6Lx.Fj.x7.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x', NULL, 3),
(18, 1, 'Jesus', 'Ortiz', NULL, NULL, 'fuerza@mtv.com', '$2y$10$Xw6Lx.Fj.x7.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x', NULL, 3),
(19, 1, 'Dan', 'Reynolds', NULL, NULL, 'imagine@mtv.com', '$2y$10$Xw6Lx.Fj.x7.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x', NULL, 3),
(20, 1, 'Tito', 'DoubleP', NULL, NULL, 'tito@mtv.com', '$2y$10$Xw6Lx.Fj.x7.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x', NULL, 3),
(30, 1, 'Fan', 'Numero1', NULL, NULL, 'fan@mtv.com', '$2y$10$Xw6Lx.Fj.x7.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x.x', NULL, 4),
(31, 1, 'Abdul', 'Palacios', 'Juarez', 1, 'kiuvy15master@gmail.com', '$2y$10$4Ui3K6Iyv/Z.g1/xW6dQXeIoYCb6jqCsP9jnUgilxsbr3qXCOtLPW', NULL, 4),
(33, 1, 'Mario Enrique', 'Cardoso', 'Xochicale', 1, 'xcme044@gmail.com', '$2y$10$4Ui3K6Iyv/Z.g1/xW6dQXeIoYCb6jqCsP9jnUgilxsbr3qXCOtLPW', 'recursos/assets/uploads/usuarios/1765077765_6934f3059c6bf.jpg', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votaciones`
--

DROP TABLE IF EXISTS `votaciones`;
CREATE TABLE IF NOT EXISTS `votaciones` (
  `id_votacion` int NOT NULL AUTO_INCREMENT,
  `fecha_votacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_nominacion` int NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_votacion`),
  UNIQUE KEY `uk_voto_usuario_nominacion` (`id_nominacion`,`id_usuario`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD CONSTRAINT `albumes_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `artistas` (`id_artista`),
  ADD CONSTRAINT `albumes_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`);

--
-- Filtros para la tabla `artistas`
--
ALTER TABLE `artistas`
  ADD CONSTRAINT `artistas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `artistas_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`);

--
-- Filtros para la tabla `canciones`
--
ALTER TABLE `canciones`
  ADD CONSTRAINT `canciones_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `artistas` (`id_artista`),
  ADD CONSTRAINT `canciones_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`),
  ADD CONSTRAINT `fk_cancion_album` FOREIGN KEY (`id_album`) REFERENCES `albumes` (`id_album`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `multimedia_canciones`
--
ALTER TABLE `multimedia_canciones`
  ADD CONSTRAINT `multimedia_canciones_ibfk_1` FOREIGN KEY (`id_cancion`) REFERENCES `canciones` (`id_cancion`);

--
-- Filtros para la tabla `nominaciones`
--
ALTER TABLE `nominaciones`
  ADD CONSTRAINT `nominaciones_ibfk_1` FOREIGN KEY (`id_categoria_nominacion`) REFERENCES `categorias_nominaciones` (`id_categoria_nominacion`),
  ADD CONSTRAINT `nominaciones_ibfk_2` FOREIGN KEY (`id_artista`) REFERENCES `artistas` (`id_artista`),
  ADD CONSTRAINT `nominaciones_ibfk_3` FOREIGN KEY (`id_album`) REFERENCES `albumes` (`id_album`),
  ADD CONSTRAINT `nominaciones_ibfk_4` FOREIGN KEY (`id_cancion`) REFERENCES `canciones` (`id_cancion`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);

--
-- Filtros para la tabla `votaciones`
--
ALTER TABLE `votaciones`
  ADD CONSTRAINT `votaciones_ibfk_1` FOREIGN KEY (`id_nominacion`) REFERENCES `nominaciones` (`id_nominacion`),
  ADD CONSTRAINT `votaciones_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
