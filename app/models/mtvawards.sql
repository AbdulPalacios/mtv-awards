-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2025 a las 18:02:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

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

CREATE TABLE `albumes` (
  `id_album` int(11) NOT NULL,
  `estatus_album` tinyint(4) NOT NULL,
  `fecha_lanzamiento_album` date NOT NULL,
  `titulo_album` varchar(50) NOT NULL,
  `descripcion_album` text DEFAULT NULL,
  `imagen_album` varchar(200) DEFAULT NULL,
  `id_artista` int(11) NOT NULL,
  `id_genero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `albumes`
--

INSERT INTO `albumes` (`id_album`, `estatus_album`, `fecha_lanzamiento_album`, `titulo_album`, `descripcion_album`, `imagen_album`, `id_artista`, `id_genero`) VALUES
(26, 0, '2025-11-04', 'Un verano sin ti', 'si', NULL, 11, 4),
(27, 1, '2025-11-05', 'Un verano sin ti', 'gffgndhgdc', '/recursos/assets/uploads/album/1764557904_verano.jpg', 11, 4),
(28, 1, '2013-09-10', 'Kiss Land', 'Álbum debut de estudio con un estilo oscuro y moderno, reconocido por su sonido innovador.', 'recursos/assets/uploads/album/1765075541_kiss_land.jpg', 19, 1),
(29, 1, '2020-03-20', 'After Hours', 'Álbum con estilo moderno y sonidos contemporáneos que lo hicieron muy popular.', 'recursos/assets/uploads/album/1765075771_after_hours.jpg', 19, 4),
(30, 1, '2021-04-09', 'Ahyque', 'Álbum con sonidos modernos y letras emotivas que lo posicionaron como uno de los favoritos del público joven.', 'recursos/assets/uploads/album/1765076026_ahyque.jpg', 15, 4),
(31, 1, '2018-04-16', 'XTentacion', 'Álbum con estilo de corridos modernos y letras que representan la vida y experiencias reales.', 'recursos/assets/uploads/album/1765076386_albumXTentacion.jpg', 13, 7),
(32, 1, '2023-05-15', 'incognito', 'Corridos modernos', 'recursos/assets/uploads/album/1765076504_baby_belikeada.jpg', 20, 7),
(33, 1, '2023-07-20', 'Barrio vol.2', 'corridos modernos ', 'recursos/assets/uploads/album/1765076661_barrio_vol2.jpg', 20, 7),
(34, 1, '2015-08-28', 'Beauty Behind Madness', 'Álbum muy exitoso con estilo moderno que impulsó la carrera de The Weeknd a nivel mundial.', 'recursos/assets/uploads/album/1765076903_beauty_behind_madness.jpg', 19, 4),
(35, 1, '2015-08-28', 'Beauty Madness', 'Estilo moderno que marco antes y despues la carrera de The weeknd', 'recursos/assets/uploads/album/1765077128_beauty_madness.jpg', 19, 4),
(36, 0, '2019-08-16', 'Better Later Than Never', 'Álbum con estilo moderno y sonidos urbanos que reflejan experiencias personales y ritmo contemporáneo.', 'recursos/assets/uploads/album/1765077277_beauty_madness.jpg', 11, 4),
(37, 1, '2019-08-17', 'Better late than never', 'Álbum con estilo moderno y sonidos urbanos que reflejan experiencias personales y ritmo contemporáneo.', 'recursos/assets/uploads/album/1765077496_better_late_than_never.jpg', 11, 4),
(38, 1, '2013-12-06', 'Efecto secundario', 'Efecto secundario es una exploración sonora que combina la viveza de la región mexicana con influencias modernas. Este álbum invita a un viaje emocional a través de melodías nostálgicas, letras que cuentan historias cotidianas y arreglos que conectan lo tradicional con lo contemporáneo.', 'recursos/assets/uploads/album/1765078131_efectos_secundarios.jpg', 15, 7),
(39, 1, '2017-06-23', 'Evolve', 'El álbum \"Evolve\" de Imagine Dragons, lanzado el 23 de junio de 2017, marca una evolución en el sonido de la banda hacia el pop rock electrónico', 'recursos/assets/uploads/album/1765078383_evolve.jpg', 14, 3),
(40, 1, '2005-06-03', 'Fijación Oral vol1', 'Fijación oral vol. 1 es el sexto álbum de estudio de la cantante colombiana Shakira, publicado internacionalmente en junio de 2005 por la compañía discográfica Epic.', 'recursos/assets/uploads/album/1765078608_fijacion_oral_vol1.jpg', 18, 1),
(41, 1, '2014-02-25', 'Formula Vol2', 'El álbum incluye sencillos exitosos como \'Propuesta Indecente\' y \'Odio\', que alcanzaron los primeros puestos en las listas de Billboard ', 'recursos/assets/uploads/album/1765078794_formula_vol2.jpg', 16, 8),
(42, 1, '2022-09-01', 'Folmula vol3', 'vol. 3 recibió críticas entre mixtas y positivas por parte de la crítica. Mientras que algunos alabaron la producción y a los invitados, otros criticaron las letras de algunos temas y el enfoque de la bachata tradicional. A pesar de esto, los medios de comunicación y los fanes responden positivamente al álbum.', 'recursos/assets/uploads/album/1765078937_formula_vol3.jpg', 16, 8),
(43, 1, '2023-06-22', 'Genesis', 'El cantante le dijo a la revista Billboard: \"Quiero que mi álbum sea bienvenido por la gente, quiero que tenga las mismas transmisiones que los sencillos.', 'recursos/assets/uploads/album/1765079054_genesis.jpg', 15, 4),
(44, 1, '2009-08-29', 'Kiss tell', 'El álbum obtuvo reviciones mixtas por parte de los críticos de la música, Tim Sendra de AllMusic le otorgó cuatro estrellas y media de cinco y elogió la variedad de estilos y sonidos presentes en el disco', 'recursos/assets/uploads/album/1765079297_kiss_tell.jpg', 17, 1),
(45, 1, '2001-09-13', 'Laundry service', 'Marcó su incursión en el mercado inglés y consolidó su estatus como una de las artistas latinas de crossover más exitosas, combinando canciones en inglés y español', 'recursos/assets/uploads/album/1765079485_laundry_service.jpg', 18, 1),
(46, 1, '2024-08-08', 'Los Cuadros', 'La canción \'LOS CUADROS\' de Peso Pluma, con la colaboración de Tito Double P, ofrece una mirada cruda y directa al mundo del narcotráfico. Desde el inicio, la letra nos introduce a la historia de un individuo que ha encontrado éxito en este peligroso negocio', 'recursos/assets/uploads/album/1765079789_los_cuadros.jpg', 15, 4),
(47, 1, '2021-04-03', 'Mercury', '. A diferencia de sus álbumes anteriores, la banda no hizo una gira para promocionar «Origins», sino que optó por tomarse un tiempo libre para descomprimirse y pasar tiempo con la familia.', 'recursos/assets/uploads/album/1765080060_mercury_act1.jpg', 14, 3),
(48, 1, '2012-03-22', 'Muerte', 'Muerte es el segundo y último álbum de estudio del rapero y compositor venezolano Canserbero.[3]​ El disco cuenta con 14 temas, los cuales hablan acerca de la muerte, la violencia, el crimen y el desamor.', 'recursos/assets/uploads/album/1765080190_muerte.jpg', 12, 4),
(49, 1, '2023-10-18', 'Nadie sabe', 'Nadie sabe lo que va a pasar mañana» (estilizado en minúsculas) es el quinto álbum de estudio del cantante puertorriqueño Bad Bunny. ', 'recursos/assets/uploads/album/1765080359_nadiesabe.jpg', 11, 4),
(50, 1, '2015-12-01', 'Night visions', 'Mientras que MTV los llamó \"la banda revelación de Radioactive» es la segunda canción con más semanas dentro del Billboard Hot 100 en la historia, con un total de 87 semanas.', 'recursos/assets/uploads/album/1765080566_night_visions.jpg', 14, 1),
(51, 1, '2015-03-23', 'Otro Nivel', 'El disco es un espejo de la realidad, marcada por la desigualdad y la inseguridad.', 'recursos/assets/uploads/album/1765158064_otro_nivel.jpg', 12, 4),
(52, 1, '2023-10-20', 'Baby Belikeada', 'Habla de la vida cotidiana, la calle, las emociones intensas y la realidad de su entorno.', 'recursos/assets/uploads/album/1765158473_1765076504_baby_belikeada.jpg', 20, 7),
(53, 1, '2020-04-02', 'Pa\'la Raza', 'La producción apuesta por ritmos pegajosos y bases digitales intensas, mientras que la voz del intérprete se convierte en el centro de atención gracias a su tono extravagante y su manera de desafiar las normas del género.', 'recursos/assets/uploads/album/1765159907_puro_raza.jpg', 10, 4),
(54, 1, '2017-01-11', 'Revival', 'El álbum \"Revival\" de Selena Gomez, lanzado en 2015 por Interscope Records, marca un nuevo comienzo en su carrera musical tras dejar Hollywood Records', 'recursos/assets/uploads/album/1765160072_revival.jpg', 17, 1),
(55, 1, '2010-02-02', 'Shakira vol5', 'Un proyecto donde la artista convierte el dolor en fuerza, usando la música como catarsis para superar momentos difíciles. Con letras sinceras y ritmos vibrantes, transmite resiliencia y empoderamiento, mostrando cómo transformar las heridas en inspiración', 'recursos/assets/uploads/album/1765160360_shakira_album.jpg', 18, 1),
(56, 1, '2017-05-13', 'She Wolf', 'Cada tema refleja la capacidad de reinventarse tras conflictos personales, consolidando a la cantante como símbolo de superación y autenticidad', 'recursos/assets/uploads/album/1765161274_she_wolf.jpg', 18, 1),
(57, 1, '2009-05-20', 'Stars Dance', 'Refleja un proceso de sanación y autodescubrimiento. Con letras íntimas y sonidos pop modernos, transmite la fuerza de superar rupturas y momentos difíciles, mostrando una faceta más madura y auténtica de su carrera.', 'recursos/assets/uploads/album/1765161431_stars_dance.jpg', 17, 1),
(58, 1, '2011-07-09', 'Utopia', 'Un proyecto donde el “Rey de la Bachata” combina la tradición romántica del género con fusiones modernas, ofreciendo letras que hablan de amor, desamor y resiliencia.', 'recursos/assets/uploads/album/1765161651_utopia.jpg', 16, 8),
(59, 1, '2015-06-05', 'Vida Una', 'Descripción Un proyecto donde el artista explora la dualidad entre la fama y la soledad, con letras que reflejan excesos, rupturas y la búsqueda de redención.', 'recursos/assets/uploads/album/1765161796_vida_una.jpg', 19, 4),
(60, 1, '2020-06-07', 'Verano', 'Las letras abordan temas de amor, desamor, fiesta y superación personal, transmitiendo autenticidad y cercanía con su público.', 'recursos/assets/uploads/album/1765161903_verano.jpg', 11, 4),
(61, 1, '2023-12-07', 'Advisory', 'La producción apuesta por ritmos digitales intensos y una estética excéntrica que refleja su personalidad única, convirtiéndolo en un trabajo que busca romper esquemas y llamar la atención dentro de la música urbana.', 'recursos/assets/uploads/album/1765161999_yhlqmdlg.jpg', 10, 4),
(62, 1, '2011-11-08', 'Fórmula Vol. 1', 'Debut como solista, mezcla bachata romántica con fusiones urbanas.', 'recursos/assets/uploads/album/1765167432_Formula Vol1.jpg', 16, 8),
(63, 1, '2014-08-26', 'The King Stays King: Sold Out at Madison Square Ga', 'Incluye éxitos como Propuesta Indecente, con colaboraciones de Drake y Marc Anthony.', 'recursos/assets/uploads/album/1765167491_Stays king.jpg', 16, 8),
(64, 1, '2017-06-21', 'Golden', 'Sonidos modernos y urbanos, con temas como Imitadora', 'recursos/assets/uploads/album/1765167576_Golden.jpg', 16, 8),
(65, 1, '2012-12-04', 'Night Visions', 'Debut con éxitos como Radioactive y Demons, mezcla rock alternativo y pop electrónico', 'recursos/assets/uploads/album/1765167979_Night Visions.jpg', 14, 3),
(66, 1, '2016-02-17', 'Smoke', 'Más experimental, con sonidos oscuros y letras introspectivas.', 'recursos/assets/uploads/album/1765168142_smoke.jpg', 14, 6),
(67, 1, '2024-06-28', 'loom', 'Último lanzamiento, con un sonido más maduro y atmosférico.', 'recursos/assets/uploads/album/1765168267_loom.jpg', 14, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artistas`
--

CREATE TABLE `artistas` (
  `id_artista` int(11) NOT NULL,
  `estatus_artista` tinyint(4) NOT NULL,
  `pseudonimo_artista` varchar(50) NOT NULL,
  `nacionalidad_artista` varchar(100) DEFAULT NULL,
  `biografia_artista` text DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_genero` int(11) DEFAULT NULL,
  `imagen_artista` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `artistas`
--

INSERT INTO `artistas` (`id_artista`, `estatus_artista`, `pseudonimo_artista`, `nacionalidad_artista`, `biografia_artista`, `id_usuario`, `id_genero`, `imagen_artista`) VALUES
(10, 1, 'Faraon GOD', 'Peruano', 'El dios de la versatilidad', 14, 4, 'recursos/assets/uploads/artistas/1764557080_images.webp'),
(11, 1, 'Bad Bunny', 'Peruano', 'xd', 5, 4, 'recursos/assets/uploads/artistas/1764557410_badbunny.jpg'),
(12, 1, 'Canserbero', 'Venezolana', 'Rapero, compositor y activista social venezolano, reconocido por sus letras profundas sobre la vida, la injusticia social, la muerte y la conciencia humana. Es considerado uno de los máximos exponentes del rap en español.', 10, 4, 'recursos/assets/uploads/artistas/1765073958_canserberojpg.jpg'),
(13, 1, 'Fuerza Regida', 'Mexicana', 'Agrupación mexicana de música regional que se ha destacado por su estilo de corridos modernos y gran popularidad entre el público joven.', 12, 7, 'recursos/assets/uploads/artistas/1765074110_fuerzaregida.jpg'),
(14, 1, 'Imagine Dragons', 'Estadounidense', 'Banda estadounidense de rock alternativo conocida por su estilo enérgico y canciones de gran impacto mundial.', 8, 3, 'recursos/assets/uploads/artistas/1765074306_imaginedragons.jpg'),
(15, 1, 'Peso Pluma', 'Mexicana', 'Cantante mexicano reconocido por popularizar los corridos tumbados y fusionar la música regional mexicana con sonidos modernos.', 13, 7, 'recursos/assets/uploads/artistas/1765074463_pesopluma.jpg'),
(16, 1, 'Romeo Santo', 'Dominicana', 'Cantante y compositor reconocido como “El Rey de la Bachata”, famoso por su estilo romántico y su influencia en la música latina.', 6, 8, 'recursos/assets/uploads/artistas/1765074576_romeosantos.jpg'),
(17, 1, 'Selena Gómez', 'Estadounidense', 'Cantante, actriz y productora reconocida por su carrera en la música pop y su impacto en la cultura juvenil.', 9, 1, 'recursos/assets/uploads/artistas/1765074712_selenagomez.jpg'),
(18, 1, 'Shakira', 'Colombiana', 'Cantante y compositora reconocida mundialmente por su estilo único que mezcla pop y ritmos latinos.', 11, 1, 'recursos/assets/uploads/artistas/1765074868_shakira.jpg'),
(19, 1, 'The Weeknd', 'Canadiense', 'Cantante y productor reconocido por su estilo moderno y su gran influencia en la música contemporánea.', 4, 1, 'recursos/assets/uploads/artistas/1765074993_theweeknd.png'),
(20, 1, 'Tito Double P', 'Mexicana', 'Cantante mexicano de música regional conocido por su estilo de corridos modernos.', 7, 7, 'recursos/assets/uploads/artistas/1765075113_titodoublep.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canciones`
--

CREATE TABLE `canciones` (
  `id_cancion` int(11) NOT NULL,
  `estatus_cancion` tinyint(4) NOT NULL,
  `nombre_cancion` varchar(50) NOT NULL,
  `fecha_lanzamiento_cancion` date NOT NULL,
  `duracion_cancion` time DEFAULT NULL,
  `mp3_cancion` varchar(200) DEFAULT NULL,
  `url_cancion` varchar(200) DEFAULT NULL,
  `url_video_cancion` varchar(200) DEFAULT NULL,
  `id_artista` int(11) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `imagen_cancion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `canciones`
--

INSERT INTO `canciones` (`id_cancion`, `estatus_cancion`, `nombre_cancion`, `fecha_lanzamiento_cancion`, `duracion_cancion`, `mp3_cancion`, `url_cancion`, `url_video_cancion`, `id_artista`, `id_genero`, `imagen_cancion`) VALUES
(4, 1, 'Neverita', '2025-11-04', '00:03:00', NULL, NULL, '', 11, 4, 'recursos/assets/uploads/canciones/1764558216_1764555833verano.jpg'),
(5, 1, 'Faraón en la Noche', '2000-01-01', '00:03:30', NULL, NULL, 'https://www.youtube.com/watch?v=ejemplo1', 10, 4, 'recursos/assets/uploads/canciones/1765168792_F1.jpeg'),
(6, 1, 'Legado del Faraón', '2005-06-15', '00:03:15', NULL, NULL, 'https://www.youtube.com/watch?', 10, 4, 'recursos/assets/uploads/canciones/1765168953_f2.jpg'),
(7, 1, 'Obertura del Trono', '2010-09-22', '00:03:45', NULL, NULL, '', 10, 4, 'recursos/assets/uploads/canciones/1765169139_f3.jpg'),
(8, 1, 'Si veo a tu mamá', '2018-02-10', '00:03:40', NULL, NULL, 'https://youtu.be/CPK_IdHe1Yg?si=6eHf3AU3pqD-RWHF', 11, 4, 'recursos/assets/uploads/canciones/1765169611_1764557904verano.jpg'),
(9, 1, 'La noche de anoche', '2019-04-06', '00:03:25', NULL, NULL, 'https://youtu.be/f5omY8jVrSM?si=GKZOOhxmAg-ScD0W', 11, 4, 'recursos/assets/uploads/canciones/1765170136_B1.jpeg'),
(10, 1, 'si estuviéramos juntos', '2019-02-14', '00:02:54', NULL, NULL, 'https://youtu.be/EB7G3fUUaeA?si=D8D56jQJxcNKwbW1', 11, 4, 'recursos/assets/uploads/canciones/1765170611_b3.jpeg'),
(11, 1, 'Un día en el barrio', '2012-03-22', '00:06:20', NULL, NULL, 'https://youtu.be/TYLvpunSzX4?si=QeNDoFUPNrqmVe6d', 12, 1, 'recursos/assets/uploads/canciones/1765170912_C1.jpg'),
(12, 1, 'Aceptas', '2017-04-11', '00:03:53', NULL, NULL, 'https://youtu.be/GTWMWvMrR_c?si=Z9Nj37JGGm_TJnBc', 12, 4, 'recursos/assets/uploads/canciones/1765171058_C2.jpeg'),
(13, 1, 'Tiempos de cambio', '2013-12-08', '00:04:09', NULL, NULL, 'https://youtu.be/_f5I05aL6Kw?si=GHyDmLTEtNRoeExN', 12, 4, 'recursos/assets/uploads/canciones/1765171187_C3.jpeg'),
(14, 1, 'Una cerveza', '2023-10-20', '00:03:37', NULL, NULL, 'https://youtu.be/WPnZJE3-SSM?si=nbzhZkXLV-E_Vq1l', 13, 7, 'recursos/assets/uploads/canciones/1765171529_FR1.jpg'),
(15, 1, 'Por esos ojos', '2025-02-11', '00:03:15', NULL, NULL, 'https://youtu.be/IpgbHjhiotg?si=jVVYDbcTHJjiBOqg', 13, 7, 'recursos/assets/uploads/canciones/1765171619_FR2.jpg'),
(16, 1, 'Excesos', '2023-10-27', '00:03:13', NULL, NULL, 'https://youtu.be/F5kR7mLrX3w?si=H0EZuOsOzZpGfmKa', 13, 7, 'recursos/assets/uploads/canciones/1765171713_FR3.jpg'),
(17, 1, 'Belive', '2017-02-01', '00:03:37', NULL, NULL, 'https://youtu.be/7wtfhZwyrcc?si=Kx2yyhqOEJs3xr7u', 14, 3, 'recursos/assets/uploads/canciones/1765172050_ID1.jpg'),
(18, 1, 'Bones', '2022-04-24', '00:02:46', NULL, NULL, 'https://youtu.be/TO-_3tck2tg?si=ZTdEbe1BUHhGKCuf', 14, 3, 'recursos/assets/uploads/canciones/1765172158_ID2.jpeg'),
(19, 1, 'Natural', '2018-08-28', '00:03:10', NULL, NULL, 'https://youtu.be/0I647GU3Jsc?si=S_58qUzWC7OSbo6R', 14, 6, 'recursos/assets/uploads/canciones/1765172245_ID3.jpg'),
(20, 1, 'Ella baila sola', '2023-03-16', '00:03:07', NULL, NULL, 'https://youtu.be/lZiaYpD9ZrI?si=Spjf3BOgzg5cFDoq', 15, 7, 'recursos/assets/uploads/canciones/1765172546_PP1.jpg'),
(21, 1, 'Chanel', '2023-03-30', '00:03:30', NULL, NULL, 'https://youtu.be/b2wQtu9YnWk?si=Nc5fm7C2VnunWiw0', 15, 7, 'recursos/assets/uploads/canciones/1765172644_PP2.jpg'),
(22, 0, 'Gervonta', '2024-12-07', '00:03:00', NULL, NULL, 'https://youtu.be/6NjZ5nNrw_8?si=pUQYG0-5dYny6t6x', 15, 1, 'recursos/assets/uploads/canciones/1765172804_PP2.jpg'),
(23, 1, 'Gervonta', '2024-12-06', '00:02:47', NULL, NULL, 'https://youtu.be/6NjZ5nNrw_8?si=pUQYG0-5dYny6t6x', 15, 7, 'recursos/assets/uploads/canciones/1765172887_PP3.jpg'),
(24, 1, 'Imitadora', '2017-07-20', '00:03:56', NULL, NULL, 'https://youtu.be/mhHqonzsuoA?si=BolbQIKLGFsF04Gp', 16, 8, 'recursos/assets/uploads/canciones/1765173156_RS1.jpg'),
(25, 1, 'Hilito', '2014-03-04', '00:03:00', NULL, NULL, '', 16, 8, 'recursos/assets/uploads/canciones/1765173252_RS2.jpg'),
(26, 1, 'Eres mia', '2014-06-16', '00:04:50', NULL, NULL, 'https://youtu.be/8iPcqtHoR3U?si=W6_QQsM8ZfxPQKed', 16, 8, 'recursos/assets/uploads/canciones/1765173412_rs3.jpg'),
(27, 1, 'Love song', '2011-06-24', '00:03:40', NULL, NULL, 'https://youtu.be/EgT_us6AsDg?si=Mpv9z9--D4lnGgwQ', 17, 1, 'recursos/assets/uploads/canciones/1765173876_SG1.jpg'),
(28, 1, 'Ojos triztes', '2025-03-21', '00:03:23', NULL, NULL, 'https://youtu.be/Ch6xdV_ZjdU?si=xQnqgOMyQfhYTbn2', 17, 1, 'recursos/assets/uploads/canciones/1765174146_sg2.jpg'),
(29, 1, 'In the dark', '2025-10-23', '00:03:04', NULL, NULL, 'https://youtu.be/Qhs3rY80HNE?si=wTf7lcACi3fCIQMt', 16, 1, 'recursos/assets/uploads/canciones/1765174252_SG3.jpg'),
(30, 1, 'Soltera', '2024-10-11', '00:03:09', NULL, NULL, 'https://youtu.be/oBofuVYDoG4?si=KOVrZ6oYYODQZK-r', 18, 1, 'recursos/assets/uploads/canciones/1765174593_s1.jpg'),
(31, 1, 'TQM', '2023-02-24', '00:03:37', NULL, NULL, 'https://youtu.be/jZGpkLElSu8?si=sarVemQEzoavLbZM', 18, 1, 'recursos/assets/uploads/canciones/1765174668_S2.jpg'),
(32, 1, 'Acrostico', '2023-05-15', '00:03:00', NULL, NULL, 'https://youtu.be/PWmJhh_qTSY?si=i-k9blQGU4QL2K8n', 18, 1, 'recursos/assets/uploads/canciones/1765174751_s3.jpg'),
(33, 1, 'Call out my name', '2018-04-12', '00:03:59', NULL, NULL, 'https://youtu.be/M4ZoCHID9GI?si=2D4HrqbUD0hhbn_9', 19, 1, 'recursos/assets/uploads/canciones/1765175046_TW1.jpg'),
(34, 1, 'Save your tears', '2021-01-05', '00:04:09', NULL, NULL, 'https://youtu.be/XXYlFuWEuKI?si=F4PZXSmseRl4ylb0', 19, 1, 'recursos/assets/uploads/canciones/1765175155_1765075771afterhours.jpg'),
(35, 1, 'Earned it', '2015-01-21', '00:04:36', NULL, NULL, 'https://youtu.be/waU75jdUnYw?si=a2Cw-fvo-3-tergk', 19, 1, 'recursos/assets/uploads/canciones/1765175294_TW3.jpg'),
(36, 1, 'Tatto', '2025-02-28', '00:02:53', NULL, NULL, 'https://youtu.be/1yZFLRJ4F0Q?si=wvj_FJApPYM37BVD', 20, 7, 'recursos/assets/uploads/canciones/1765175610_T1.jpg'),
(37, 1, 'Nadie', '2024-11-22', '00:03:16', NULL, NULL, 'https://youtu.be/sI2TE_hYFYQ?si=Ohl9HJg8BOht8AHX', 20, 7, 'recursos/assets/uploads/canciones/1765175705_T2.jpg'),
(38, 1, 'Ay mamá', '2024-08-22', '00:02:55', NULL, NULL, 'https://youtu.be/fYisEGn8etQ?si=LNeVaYKzM6VpK4V7', 20, 7, 'recursos/assets/uploads/canciones/1765175799_t3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_nominaciones`
--

CREATE TABLE `categorias_nominaciones` (
  `id_categoria_nominacion` int(11) NOT NULL,
  `estatus_categoria_nominacion` tinyint(4) NOT NULL,
  `tipo_categoria_nominacion` tinyint(4) NOT NULL,
  `nombre_categoria_nominacion` varchar(50) NOT NULL,
  `fecha_categoria_nominacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_nominaciones`
--

INSERT INTO `categorias_nominaciones` (`id_categoria_nominacion`, `estatus_categoria_nominacion`, `tipo_categoria_nominacion`, `nombre_categoria_nominacion`, `fecha_categoria_nominacion`) VALUES
(1, 1, 3, 'Peor cancion', '2025-12-17'),
(2, 1, 3, 'Mejor cancion', '2025-12-17'),
(3, 1, 1, 'Mejor artista', '2025-12-17'),
(4, 1, 2, 'Mejor arbum', '2025-12-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id_genero` int(11) NOT NULL,
  `estatus_genero` tinyint(4) NOT NULL,
  `nombre_genero` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id_genero`, `estatus_genero`, `nombre_genero`) VALUES
(1, 1, 'Pop'),
(2, 0, 'Rock'),
(3, 1, 'Rock'),
(4, 1, 'Urbano'),
(5, 0, 'Pop'),
(6, 1, 'Rock'),
(7, 1, 'Regional Mexicano'),
(8, 1, 'Bachata');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multimedia_canciones`
--

CREATE TABLE `multimedia_canciones` (
  `id_multimedia_cancion` int(11) NOT NULL,
  `estatus_album` tinyint(4) NOT NULL,
  `formato_mp3` varchar(250) DEFAULT NULL,
  `url_streaming` varchar(250) DEFAULT NULL,
  `url_video_clip` varchar(250) DEFAULT NULL,
  `id_cancion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nominaciones`
--

CREATE TABLE `nominaciones` (
  `id_nominacion` int(11) NOT NULL,
  `fecha_nominacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_categoria_nominacion` int(11) NOT NULL,
  `id_artista` int(11) DEFAULT NULL,
  `id_album` int(11) DEFAULT NULL,
  `contador_nominacion` int(11) DEFAULT 0,
  `id_cancion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nominaciones`
--

INSERT INTO `nominaciones` (`id_nominacion`, `fecha_nominacion`, `id_categoria_nominacion`, `id_artista`, `id_album`, `contador_nominacion`, `id_cancion`) VALUES
(13, '2025-12-01 03:02:44', 4, NULL, 27, 0, NULL),
(14, '2025-12-01 03:03:04', 3, 11, NULL, 0, NULL),
(15, '2025-12-01 03:03:43', 2, NULL, NULL, 0, 4),
(16, '2025-12-01 03:03:46', 1, NULL, NULL, 0, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Usuario'),
(3, 'Artista');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `estatus_usuario` tinyint(4) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `ap_usuario` varchar(50) NOT NULL,
  `am_usuario` varchar(50) DEFAULT NULL,
  `sexo_usuario` tinyint(4) DEFAULT NULL,
  `correo_usuario` varchar(50) NOT NULL,
  `password_usuario` varchar(64) NOT NULL,
  `imagen_usuario` varchar(200) DEFAULT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `estatus_usuario`, `nombre_usuario`, `ap_usuario`, `am_usuario`, `sexo_usuario`, `correo_usuario`, `password_usuario`, `imagen_usuario`, `id_rol`) VALUES
(1, 1, 'Jesus', 'Cuapio', 'Mendoza', 1, 'cuapiomendoza5@hotmail.com', '$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri', NULL, 2),
(2, 1, 'Admin', 'Principal', 'Sistema', 1, 'admin1@mtv.com', '$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri', NULL, 1),
(3, 1, 'Jesus', 'Cuapio', 'Mendoza', 2, 'jesuscuapio66@gmail.com', '$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri', NULL, 1),
(4, 1, 'Taylor', 'Swift', '', 2, 'taylor@mtv.com', '$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri', NULL, 3),
(5, 1, 'Bad', 'Bunny', '', 1, 'badbunny@mtv.com', '$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri', NULL, 3),
(6, 1, 'Dua', 'Lipa', '', 2, 'dua@mtv.com', '$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri', NULL, 3),
(7, 1, 'Bad', 'Bunny', NULL, 1, 'benito@mtv.com', '$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri', NULL, 3),
(8, 1, 'Abel', 'Tesfaye', NULL, 1, 'theweeknd@mtv.com', '$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri', NULL, 3),
(9, 1, 'Hassan', 'Kabande', NULL, 1, 'doblep@mtv.com', '$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri', NULL, 3),
(10, 1, 'Dan', 'Reynolds', NULL, 1, 'imaginedragons@mtv.com', '$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri', NULL, 3),
(11, 1, 'Shakira', 'Mebarak', NULL, 2, 'shakira@mtv.com', '$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri', NULL, 3),
(12, 1, 'Selena', 'Gomez', NULL, 2, 'selena@mtv.com', '$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri', NULL, 3),
(13, 1, 'Anthony', 'Santos', NULL, 1, 'romeo@mtv.com', '$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri', NULL, 3),
(14, 1, 'Jesús', 'Valle', 'Choque', 1, 'faraon@mtv.com', '$2y$12$fMR1UIdMwNxJNRsHHUqL8uq.4IgP7SC8Rnd4MqKdrbe0/WKum6nri', NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votaciones`
--

CREATE TABLE `votaciones` (
  `id_votacion` int(11) NOT NULL,
  `fecha_votacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_nominacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `albumes`
--
ALTER TABLE `albumes`
  ADD PRIMARY KEY (`id_album`),
  ADD KEY `id_artista` (`id_artista`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Indices de la tabla `artistas`
--
ALTER TABLE `artistas`
  ADD PRIMARY KEY (`id_artista`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Indices de la tabla `canciones`
--
ALTER TABLE `canciones`
  ADD PRIMARY KEY (`id_cancion`),
  ADD KEY `id_artista` (`id_artista`),
  ADD KEY `id_genero` (`id_genero`);

--
-- Indices de la tabla `categorias_nominaciones`
--
ALTER TABLE `categorias_nominaciones`
  ADD PRIMARY KEY (`id_categoria_nominacion`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id_genero`);

--
-- Indices de la tabla `multimedia_canciones`
--
ALTER TABLE `multimedia_canciones`
  ADD PRIMARY KEY (`id_multimedia_cancion`),
  ADD KEY `id_cancion` (`id_cancion`);

--
-- Indices de la tabla `nominaciones`
--
ALTER TABLE `nominaciones`
  ADD PRIMARY KEY (`id_nominacion`),
  ADD KEY `id_categoria_nominacion` (`id_categoria_nominacion`),
  ADD KEY `id_artista` (`id_artista`),
  ADD KEY `id_album` (`id_album`),
  ADD KEY `nominaciones_ibfk_4` (`id_cancion`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo_usuario` (`correo_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `votaciones`
--
ALTER TABLE `votaciones`
  ADD PRIMARY KEY (`id_votacion`),
  ADD UNIQUE KEY `uk_voto_usuario_nominacion` (`id_nominacion`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `albumes`
--
ALTER TABLE `albumes`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `artistas`
--
ALTER TABLE `artistas`
  MODIFY `id_artista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `canciones`
--
ALTER TABLE `canciones`
  MODIFY `id_cancion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `categorias_nominaciones`
--
ALTER TABLE `categorias_nominaciones`
  MODIFY `id_categoria_nominacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id_genero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `multimedia_canciones`
--
ALTER TABLE `multimedia_canciones`
  MODIFY `id_multimedia_cancion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nominaciones`
--
ALTER TABLE `nominaciones`
  MODIFY `id_nominacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `votaciones`
--
ALTER TABLE `votaciones`
  MODIFY `id_votacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `canciones_ibfk_2` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id_genero`);

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
