-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-01-2018 a las 03:18:11
-- Versión del servidor: 10.1.29-MariaDB
-- Versión de PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `waterapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `id_chat` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `mensaje` text NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL,
  `abrioCliente` tinyint(1) NOT NULL,
  `abrioUsuario` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id_chat`, `id_cliente`, `mensaje`, `id_usuario`, `fecha_creacion`, `abrioCliente`, `abrioUsuario`) VALUES
(27, 19, 'mio', 6, '2018-01-16 00:24:06', 1, 1),
(28, 19, 'mio', 6, '2018-01-16 00:25:14', 1, 1),
(29, 19, 'porque?', 6, '2018-01-16 00:28:27', 1, 1),
(30, 19, 'vamos', 6, '2018-01-16 00:30:15', 1, 1),
(31, 19, 'de', 6, '2018-01-16 00:31:41', 1, 1),
(32, 19, 'esta bien', 6, '2018-01-16 00:32:07', 1, 1),
(33, 19, 'por fin', 6, '2018-01-16 00:32:27', 1, 1),
(34, 19, 'realmente', 6, '2018-01-16 00:37:34', 1, 1),
(35, 19, 'cuanto te falta?', 6, '2018-01-16 00:37:45', 1, 1),
(36, 19, 'ya esta en camino', NULL, '2018-01-16 00:37:54', 1, 1),
(37, 19, 'dite algo mi pana', 6, '2018-01-16 00:38:05', 1, 1),
(38, 19, 'que me digo', NULL, '2018-01-16 00:38:12', 1, 1),
(39, 19, 'nueva vaina', NULL, '2018-01-16 01:23:47', 1, 1),
(40, 19, 'nuevo', NULL, '2018-01-16 01:25:50', 1, 1),
(41, 19, 'quiero ver', NULL, '2018-01-16 01:26:43', 1, 1),
(42, 19, 'quiero mi pedido', NULL, '2018-01-16 01:27:33', 1, 1),
(43, 19, 'b', NULL, '2018-01-16 01:30:04', 1, 1),
(44, 19, 'mijo', NULL, '2018-01-16 01:57:33', 1, 1),
(45, 19, 'que quieres?', 6, '2018-01-16 01:57:44', 1, 1),
(46, 19, 'dame mi pedido', NULL, '2018-01-16 01:59:19', 1, 1),
(47, 19, 'hey', NULL, '2018-01-16 01:59:39', 1, 1),
(48, 19, 'esa bien te dare tu pedido', 6, '2018-01-16 02:00:05', 1, 1),
(49, 19, 'mas te vale mi pana', NULL, '2018-01-16 02:00:16', 1, 1),
(50, 19, 'bueno tranquila', 6, '2018-01-16 02:01:16', 1, 1),
(51, 19, 'ya salio para alla', 6, '2018-01-16 02:01:38', 1, 1),
(52, 19, 'deberias saberlo', 6, '2018-01-16 02:01:56', 1, 1),
(53, 19, 'saber que?', 6, '2018-01-16 02:02:07', 1, 1),
(54, 19, 'ven aca', NULL, '2018-01-16 02:02:23', 1, 1),
(55, 19, 'ohh', NULL, '2018-01-16 02:02:29', 1, 1),
(56, 19, 'no se porque hace eso', 6, '2018-01-16 02:02:52', 1, 1),
(57, 19, 'Vamos a probar esto', NULL, '2018-01-01 05:10:00', 1, 1),
(58, 19, 'buenas', 6, '2018-01-16 06:21:17', 1, 1),
(59, 21, 'hey', NULL, '2018-01-16 20:42:01', 1, 1),
(60, 21, 'mi pedido', NULL, '2018-01-16 20:42:09', 1, 1),
(61, 21, 'orita', 6, '2018-01-16 20:42:46', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_tipo`
--

CREATE TABLE `cliente_tipo` (
  `id_cliente_tipo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente_tipo`
--

INSERT INTO `cliente_tipo` (`id_cliente_tipo`, `nombre`) VALUES
(1, 'Persona'),
(2, 'Compañia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distrito_municipal`
--

CREATE TABLE `distrito_municipal` (
  `id_distrito_municipal` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `id_municipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `distrito_municipal`
--

INSERT INTO `distrito_municipal` (`id_distrito_municipal`, `nombre`, `id_municipio`) VALUES
(1, 'Barreras', 2),
(2, 'Barro Arriba', 2),
(3, 'Clavellina', 2),
(4, 'Emma Balaguer Viuda Vallejo', 2),
(5, 'Las Barías-La Estancia', 2),
(6, 'Las Lomas', 2),
(7, 'Los Jovillos', 2),
(8, 'Puerto Viejo', 2),
(9, 'Hatillo', 5),
(10, 'Palmar de Ocoa', 5),
(11, 'Villarpando', 6),
(12, 'Hato Nuevo-Cortés', 6),
(13, 'La Siembra', 7),
(14, 'Las Lagunas', 7),
(15, 'Los Fríos', 7),
(16, 'El Rosario', 9),
(17, 'Proyecto 4', 10),
(18, 'Ganadero', 10),
(19, 'Proyecto 2-C', 10),
(20, 'Amiama Gómez', 11),
(21, 'Los Toros', 11),
(22, 'Tábara Abajo', 11),
(23, 'El Palmar', 12),
(24, 'El Salado', 13),
(25, 'Las Clavellinas', 14),
(26, 'Cabeza de Toro', 15),
(27, 'Mena', 15),
(28, 'Monserrat', 15),
(29, 'Santa Bárbara-El 6', 15),
(30, 'Santana', 15),
(31, 'Uvilla', 15),
(32, 'El Cachón', 17),
(33, 'La Guázara', 17),
(34, 'Villa Central', 17),
(35, 'Arroyo Dulce', 20),
(36, 'Pescadería', 21),
(37, 'Palo Alto', 22),
(38, 'Bahoruco', 23),
(39, 'Los Patos', 25),
(40, 'Canoa', 27),
(41, 'Fondo Negro', 27),
(42, 'Quita Coraza', 27),
(43, 'Cañongo', 28),
(44, 'Manuel Bueno', 4),
(45, 'Capotillo', 30),
(46, 'Santiago de la Cruz', 30),
(47, 'Cenoví', 33),
(48, 'Jaya', 33),
(49, 'La Peña', 33),
(50, 'Presidente Don Antonio Guzmán Fernández', 33),
(51, 'Aguacate', 34),
(52, 'Las Coles', 34),
(53, 'Sabana Grande', 36),
(54, 'Agua Santa del Yuna', 39),
(55, 'Barraquito', 39),
(56, 'Cristo Rey de Guaraguao', 39),
(57, 'Las Táranas', 39),
(58, 'Pedro Sánchez', 40),
(59, 'San Francisco-Vicentillo', 40),
(60, 'Santa Lucía', 41),
(61, 'El Cedro', 41),
(62, 'La Gina', 41),
(63, 'Guayabo', 42),
(64, 'Sabana Larga', 42),
(65, 'Sabana Cruz', 43),
(66, 'Sabana Higüero', 43),
(67, 'Guanito', 44),
(68, 'Rancho de la Guardia', 45),
(69, 'Río Limpio', 47),
(70, 'Canca La Reina', 48),
(71, 'El Higüerito', 48),
(72, 'José Contreras', 48),
(73, 'Juan López', 48),
(74, 'La Ortega', 48),
(75, 'Las Lagunas', 48),
(76, 'Monte de la Jagua', 48),
(77, 'San Víctor', 48),
(78, 'Joba Arriba', 50),
(79, 'Veragua', 50),
(80, 'Villa Magante', 50),
(81, 'Guayabo Dulce', 52),
(82, 'Mata Palacio', 52),
(83, 'Yerba Buena', 52),
(84, 'Elupina Cordero de Las Cañitas', 54),
(85, 'Jamao Afuera', 55),
(86, 'Blanco', 56),
(87, 'Boca de Cachón', 58),
(88, 'El Limón', 58),
(89, 'Batey 8', 59),
(90, 'Vengan a Ver', 60),
(91, 'La Colonia', 62),
(92, 'Guayabal', 63),
(93, 'La Otra Banda', 64),
(94, 'Lagunas de Nisibón', 64),
(95, 'Verón-Punta Cana', 64),
(96, 'Bayahibe', 65),
(97, 'Boca de Yuma', 65),
(98, 'Caleta', 66),
(99, 'Cumayasa', 68),
(100, 'El Ranchito', 69),
(101, 'Río Verde Arriba', 69),
(102, 'La Sabina', 70),
(103, 'Tireo', 70),
(104, 'Buena Vista', 70),
(105, 'Manabao', 71),
(106, 'Rincón', 72),
(107, 'Arroyo al Medio', 73),
(108, 'Las Gordas', 73),
(109, 'San José de Matanzas', 73),
(110, 'Arroyo Salado', 74),
(111, 'La Entrada', 74),
(112, 'El Pozo', 75),
(113, 'Arroyo Toro-Masipedro', 77),
(114, 'La Salvia-Los Quemados', 77),
(115, 'Jayaco', 77),
(116, 'Juma Bejucal', 77),
(117, 'Sabana del Puerto', 77),
(118, 'Juan Adrián', 79),
(119, 'Villa Sonador', 79),
(120, 'Palo Verde', 81),
(121, 'Cana Chapetón', 82),
(122, 'Hatillo Palma', 82),
(123, 'Villa Elisa', 82),
(124, 'Boyá', 86),
(125, 'Chirino', 86),
(126, 'Don Juan', 86),
(127, 'Gonzalo', 89),
(128, 'Majagual', 89),
(129, 'Los Botados', 90),
(130, 'José Francisco Peña Gómez', 91),
(131, 'Juancho', 91),
(132, 'Catalina', 93),
(133, 'El Carretón', 93),
(134, 'El Limonal', 93),
(135, 'Las Barías', 93),
(136, 'Matanzas', 93),
(137, 'Paya', 93),
(138, 'Sabana Buey', 93),
(139, 'Villa Fundación', 93),
(140, 'Villa Sombrero', 93),
(141, 'Pizarrete', 94),
(142, 'Santana', 94),
(143, 'Maimón', 86),
(144, 'Yásica Arriba', 86),
(145, 'Río Grande', 96),
(146, 'Navas', 99),
(147, 'Belloso', 100),
(148, 'Estrecho', 100),
(149, 'La Isabela', 100),
(150, 'Cabarete', 101),
(151, 'Sabaneta de Yásica', 101),
(152, 'Estero Hondo', 102),
(153, 'Gualete', 102),
(154, 'La Jaiba', 102),
(155, 'Arroyo Barril', 104),
(156, 'El Limón', 104),
(157, 'Las Galeras', 104),
(158, 'Hato Damas', 107),
(159, 'El Carril', 108),
(160, 'Cambita El Pueblecito', 109),
(161, 'La Cuchilla', 113),
(162, 'Medina', 113),
(163, 'San José del Puerto', 113),
(164, 'El Naranjal', 115),
(165, 'El Pinar', 115),
(166, 'La Ciénaga', 115),
(167, 'Nizao-Las Auyamas', 115),
(168, 'El Rosario', 118),
(169, 'Guanito', 118),
(170, 'Hato del Padre', 118),
(171, 'Hato Nuevo', 118),
(172, 'La Jagua', 118),
(173, 'Las Charcas de María Nova', 118),
(174, 'Pedro Corto', 118),
(175, 'Sabana Alta', 118),
(176, 'Sabaneta', 118),
(177, 'Arroyo Cano', 119),
(178, 'Yaque', 119),
(179, 'Batista', 120),
(180, 'Derrumbadero', 120),
(181, 'Jínova', 121),
(182, 'Carrera de Yegua', 122),
(183, 'Matayaya', 122),
(184, 'Jorjillo', 123),
(185, 'El Puerto', 129),
(186, 'Gautier', 129),
(187, 'Caballero', 130),
(188, 'Comedero Arriba', 130),
(189, 'Quita Sueño', 130),
(190, 'La Cueva', 131),
(191, 'Platanal', 131),
(192, 'Angelina', 133),
(193, 'La Bija', 133),
(194, 'Hernando Alonzo', 133),
(195, 'Baitoa', 134),
(196, 'Hato del Yaque', 134),
(197, 'La Canela', 134),
(198, 'Pedro García', 134),
(199, 'San Francisco de Jacagua', 134),
(200, 'El Caimito', 136),
(201, 'Juncalito', 136),
(202, 'Las Palomas', 137),
(203, 'Canabacoa', 137),
(204, 'Guayabal', 137),
(205, 'El Rubio', 140),
(206, 'La Cuesta', 140),
(207, 'Las Placetas', 140),
(208, 'Canca La Piedra', 141),
(209, 'El Limón', 142),
(210, 'Palmar Arriba', 142),
(211, 'San Luis', 146),
(212, 'La Caleta', 147),
(213, 'Palmarejo-Villa Linda', 148),
(214, 'Pantoja', 148),
(215, 'La Cuaba', 149),
(216, 'La Guáyiga', 149),
(217, 'Hato Viejo', 150),
(218, 'La Victoria', 151),
(219, 'Ámina', 153),
(220, 'Guatapanal', 153),
(221, 'Jaibón (Pueblo Nuevo)', 153),
(222, 'Boca de Mao', 154),
(223, 'Jicomé', 154),
(224, 'Maizal', 154),
(225, 'Paradero', 154),
(226, 'Cruce de Guayacanes', 155),
(227, 'Jaibón', 155),
(228, 'La Caya', 155);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `id_municipio` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `id_provincia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id_municipio`, `nombre`, `id_provincia`) VALUES
(1, 'Distrito Nacional', 5),
(2, 'Azua de Compostela', 1),
(3, 'Estebanía', 1),
(4, 'Guayabal', 1),
(5, 'Las Charcas', 1),
(6, 'Las Yayas de Viajama', 1),
(7, 'Padre Las Casas', 1),
(8, 'Peralta', 1),
(9, 'Pueblo Viejo', 1),
(10, 'Sabana Yegua', 1),
(11, 'Tábara Arriba', 1),
(12, 'Neiba', 2),
(13, 'Galván', 2),
(14, 'Los Ríos', 2),
(15, 'Tamayo', 2),
(16, 'Villa Jaragua', 2),
(17, 'Barahona', 3),
(18, 'Cabral', 3),
(19, 'El Peñón', 3),
(20, 'Enriquillo', 3),
(21, 'Fundación', 3),
(22, 'Jaquimeyes', 3),
(23, 'La Ciénaga', 3),
(24, 'Las Salinas', 3),
(25, 'Paraíso', 3),
(26, 'Polo', 3),
(27, 'Vicente Noble', 3),
(28, 'Dajabón', 4),
(29, 'El Pino', 4),
(30, 'Loma de Cabrera', 4),
(31, 'Partido', 4),
(32, 'Restauración', 4),
(33, 'San Francisco de Macorís', 6),
(34, 'Arenoso', 6),
(35, 'Castillo', 6),
(36, 'Eugenio María de Hostos', 6),
(37, 'Las Guáranas', 6),
(38, 'Pimentel', 6),
(39, 'Villa Riva', 6),
(40, 'El Seibo', 8),
(41, 'Miches', 8),
(42, 'Comendador', 7),
(43, 'Bánica', 7),
(44, 'El Llano', 7),
(45, 'Hondo Valle', 7),
(46, 'Juan Santiago', 7),
(47, 'Pedro Santana', 7),
(48, 'Moca', 9),
(49, 'Cayetano Germosén', 9),
(50, 'Gaspar Hernández', 9),
(51, 'Jamao al Norte', 9),
(52, 'Hato Mayor del Rey', 10),
(53, 'El Valle', 10),
(54, 'Sabana de la Mar', 10),
(55, 'Salcedo', 11),
(56, 'Tenares', 11),
(57, 'Villa Tapia', 11),
(58, 'Jimaní', 12),
(59, 'Cristóbal', 12),
(60, 'Duvergé', 12),
(61, 'La Descubierta', 12),
(62, 'Mella', 12),
(63, 'Postrer Río', 12),
(64, 'Higüey', 13),
(65, 'San Rafael del Yuma', 13),
(66, 'La Romana', 14),
(67, 'Guaymate', 14),
(68, 'Villa Hermosa', 14),
(69, 'La Concepción de La Vega', 15),
(70, 'Constanza', 15),
(71, 'Jarabacoa', 15),
(72, 'Jima Abajo', 15),
(73, 'Nagua', 16),
(74, 'Cabrera', 16),
(75, 'El Factor', 16),
(76, 'Río San Juan', 16),
(77, 'Bonao', 17),
(78, 'Maimón', 17),
(79, 'Piedra Blanca', 17),
(80, 'Montecristi', 18),
(81, 'Castañuela', 18),
(82, 'Guayubín', 18),
(83, 'Las Matas de Santa Cruz', 18),
(84, 'Pepillo Salcedo', 18),
(85, 'Villa Vásquez', 18),
(86, 'Monte Plata', 19),
(87, 'Bayaguana', 19),
(88, 'Peralvillo', 19),
(89, 'Sabana Grande de Boyá', 19),
(90, 'Yamasá', 19),
(91, 'Pedernales', 20),
(92, 'Oviedo', 20),
(93, 'Baní', 21),
(94, 'Nizao', 21),
(95, 'Puerto Plata', 22),
(96, 'Altamira', 22),
(97, 'Guananico', 22),
(98, 'Imbert', 22),
(99, 'Los Hidalgos', 22),
(100, 'Luperón', 22),
(101, 'Sosúa', 22),
(102, 'Villa Isabela', 22),
(103, 'Villa Montellano', 22),
(104, 'Samaná', 23),
(105, 'Las Terrenas', 23),
(106, 'Sánchez', 23),
(107, 'San Cristóbal', 25),
(108, 'Bajos de Haina', 25),
(109, 'Cambita Garabito', 25),
(110, 'Los Cacaos', 25),
(111, 'Sabana Grande de Palenque', 25),
(112, 'San Gregorio de Nigua', 25),
(113, 'Villa Altagracia', 25),
(114, 'Yaguate', 25),
(115, 'San José de Ocoa', 26),
(116, 'Rancho Arriba', 26),
(117, 'Sabana Larga', 26),
(118, 'San Juan de la Maguana', 27),
(119, 'Bohechío', 27),
(120, 'El Cercado', 27),
(121, 'Juan de Herrera', 27),
(122, 'Las Matas de Farfán', 27),
(123, 'Vallejuelo', 27),
(124, 'San Pedro de Macorís', 28),
(125, 'Consuelo', 28),
(126, 'Guayacanes', 28),
(127, 'Quisqueya', 28),
(128, 'Ramón Santana', 28),
(129, 'San José de Los Llanos', 28),
(130, 'Cotuí', 24),
(131, 'Cevicos', 24),
(132, 'Fantino', 24),
(133, 'La Mata', 24),
(134, 'Santiago', 29),
(135, 'Bisonó', 29),
(136, 'Jánico', 29),
(137, 'Licey al Medio', 29),
(138, 'Puñal', 29),
(139, 'Sabana Iglesia', 29),
(140, 'San José de las Matas', 29),
(141, 'Tamboril', 29),
(142, 'Villa González', 29),
(143, 'San Ignacio de Sabaneta', 30),
(144, 'Los Almácigos', 30),
(145, 'Monción', 30),
(146, 'Santo Domingo Este', 31),
(147, 'Boca Chica', 31),
(148, 'Los Alcarrizos', 31),
(149, 'Pedro Brand', 31),
(150, 'San Antonio de Guerra', 31),
(151, 'Santo Domingo Norte', 31),
(152, 'Santo Domingo Oeste', 31),
(153, 'Mao', 32),
(154, 'Esperanza', 32),
(155, 'Laguna Salada', 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_pedido_estado` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `total` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_pedido_estado`, `id_cliente`, `id_usuario`, `fecha_creacion`, `total`) VALUES
(1, 3, 19, 19, '2018-01-12 17:15:08', '15.00'),
(2, 3, 19, 19, '2018-01-16 03:01:45', '15.00'),
(3, 3, 19, 19, '2018-01-16 03:05:56', '15.00'),
(4, 3, 19, 19, '2018-01-16 16:31:59', '15.00'),
(5, 3, 21, 21, '2018-01-16 16:44:52', '15.00'),
(6, 3, 19, 19, '2018-01-16 16:46:54', '15.00'),
(7, 3, 21, 21, '2018-01-16 16:47:07', '15.00'),
(8, 3, 21, 21, '2018-01-16 17:01:14', '15.00'),
(9, 3, 19, 19, '2018-01-16 17:01:25', '15.00'),
(10, 1, 21, 21, '2018-01-16 17:06:33', '15.00'),
(11, 3, 19, 19, '2018-01-16 17:10:49', '15.00'),
(12, 2, 21, 21, '2018-01-16 17:13:10', '15.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_detalle`
--

CREATE TABLE `pedido_detalle` (
  `id_pedido_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido_detalle`
--

INSERT INTO `pedido_detalle` (`id_pedido_detalle`, `id_pedido`, `id_producto`, `cantidad`, `precio`) VALUES
(1, 1, 1, 1, '15.00'),
(2, 2, 1, 1, '15.00'),
(3, 3, 1, 1, '15.00'),
(4, 4, 1, 1, '15.00'),
(5, 5, 1, 1, '15.00'),
(6, 6, 1, 1, '15.00'),
(7, 7, 1, 1, '15.00'),
(8, 8, 1, 1, '15.00'),
(9, 9, 1, 1, '15.00'),
(10, 10, 1, 1, '15.00'),
(11, 11, 1, 1, '15.00'),
(12, 12, 1, 1, '15.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_estado`
--

CREATE TABLE `pedido_estado` (
  `id_pedido_estado` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `css` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido_estado`
--

INSERT INTO `pedido_estado` (`id_pedido_estado`, `descripcion`, `css`) VALUES
(1, 'Pagado', 'success'),
(2, 'Pendiente', 'warning'),
(3, 'Entregado', 'info'),
(4, 'Cancelado', 'danger');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `id_permiso` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`id_permiso`, `nombre`) VALUES
(1, 'escritorio\r\n'),
(2, 'producto'),
(3, 'producto_tipo'),
(4, 'producto_marca'),
(5, 'almacen'),
(6, 'compra'),
(7, 'ingreso'),
(8, 'ventas'),
(9, 'pedido'),
(10, 'venta'),
(11, 'cliente'),
(12, 'acceso'),
(13, 'usuario'),
(14, 'pedidocliente'),
(15, 'consultaingreso'),
(16, 'consultaventa'),
(17, 'vehiculo'),
(18, 'ruta'),
(19, 'rutadistribuidor'),
(20, 'chat'),
(21, 'cuentaxpagar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `costo` decimal(6,2) NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `existencia` int(11) NOT NULL DEFAULT '0',
  `existencia_minima` int(11) NOT NULL DEFAULT '1',
  `codigo_barra` varchar(50) DEFAULT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  `id_producto_marca` int(11) NOT NULL,
  `id_producto_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `costo`, `precio`, `existencia`, `existencia_minima`, `codigo_barra`, `imagen`, `estado`, `id_producto_marca`, `id_producto_tipo`) VALUES
(1, 'Botellon de agua', '7.00', '15.00', -5, 1, '1234', '1515705898.jpg', 1, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_existencia`
--

CREATE TABLE `producto_existencia` (
  `id_producto_existencia` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_existencia_detalle`
--

CREATE TABLE `producto_existencia_detalle` (
  `id_producto_existencia_detalle` int(11) NOT NULL,
  `id_producto_existencia` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Disparadores `producto_existencia_detalle`
--
DELIMITER $$
CREATE TRIGGER `tr_actualizarExistencia` AFTER INSERT ON `producto_existencia_detalle` FOR EACH ROW BEGIN
    UPDATE producto SET existencia = existencia + NEW.cantidad
    WHERE producto.id_producto = NEW.id_producto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_marca`
--

CREATE TABLE `producto_marca` (
  `id_producto_marca` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto_marca`
--

INSERT INTO `producto_marca` (`id_producto_marca`, `nombre`, `estado`) VALUES
(1, 'El Varon', 1),
(2, 'Florentina', 1),
(3, 'Dasani', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_tipo`
--

CREATE TABLE `producto_tipo` (
  `id_producto_tipo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto_tipo`
--

INSERT INTO `producto_tipo` (`id_producto_tipo`, `nombre`, `estado`) VALUES
(1, 'Botellon', 1),
(2, 'Fundita', 1),
(3, 'Botella', 1),
(9, 'Mabi', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `id_provincia` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`id_provincia`, `nombre`) VALUES
(1, 'Azua'),
(2, 'Bahoruco'),
(3, 'Barahona'),
(4, 'Dajabón'),
(5, 'Distrito Nacional'),
(6, 'Duarte'),
(7, 'Elías Piña'),
(8, 'El Seibo'),
(9, 'Espaillat'),
(10, 'Hato Mayor'),
(11, 'Hermanas Mirabal'),
(12, 'Independencia'),
(13, 'La Altagracia'),
(14, 'La Romana'),
(15, 'La Vega'),
(16, 'María Trinidad Sánchez'),
(17, 'Monseñor Nouel'),
(18, 'Monte Cristi'),
(19, 'Monte Plata'),
(20, 'Pedernales'),
(21, 'Peravia'),
(22, 'Puerto Plata'),
(23, 'Samaná'),
(24, 'Sánchez Ramírez'),
(25, 'San Cristóbal'),
(26, 'San José de Ocoa'),
(27, 'San Juan'),
(28, 'San Pedro de Macorís'),
(29, 'Santiago'),
(30, 'Santiago Rodríguez'),
(31, 'Santo Domingo'),
(32, 'Valverde'),
(1000, 'nuevo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibo`
--

CREATE TABLE `recibo` (
  `id_recibo` int(11) NOT NULL,
  `monto` decimal(6,2) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `nota` varchar(250) DEFAULT NULL,
  `id_venta_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recibo`
--

INSERT INTO `recibo` (`id_recibo`, `monto`, `id_venta`, `id_usuario`, `fecha_creacion`, `nota`, `id_venta_pago`) VALUES
(1, '5.00', 1, 6, '2018-01-16 03:02:06', '', 1),
(2, '5.00', 1, 6, '2018-01-16 03:06:12', '', 1),
(3, '5.00', 1, 20, '2018-01-16 16:45:37', '', 1),
(4, '5.00', 2, 20, '2018-01-16 16:45:37', '', 1),
(5, '10.00', 2, 20, '2018-01-16 16:47:41', '', 1),
(6, '10.00', 3, 20, '2018-01-16 17:02:07', '', 1),
(7, '5.00', 3, 20, '2018-01-16 17:13:52', '', 1),
(8, '5.00', 4, 20, '2018-01-16 17:13:52', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `id_ruta` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_vehiculo` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_creador` int(11) NOT NULL,
  `disponible` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`id_ruta`, `id_empleado`, `id_vehiculo`, `fecha_creacion`, `descripcion`, `nombre`, `id_creador`, `disponible`) VALUES
(1, 20, 5, '2018-01-12 17:15:23', 'sdsd', 'sds', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta_establecida`
--

CREATE TABLE `ruta_establecida` (
  `id_ruta_establecida` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta_establecida_lugar`
--

CREATE TABLE `ruta_establecida_lugar` (
  `id_ruta_establecida_lugar` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `latitud` varchar(100) DEFAULT NULL,
  `longitud` varchar(100) DEFAULT NULL,
  `id_ruta_establecida` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta_lugar`
--

CREATE TABLE `ruta_lugar` (
  `id_ruta_lugar` int(11) NOT NULL,
  `id_ruta` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `latitud` varchar(100) DEFAULT NULL,
  `longitud` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ruta_lugar`
--

INSERT INTO `ruta_lugar` (`id_ruta_lugar`, `id_ruta`, `id_pedido`, `latitud`, `longitud`) VALUES
(27, 1, 1, NULL, NULL),
(28, 1, 4, NULL, NULL),
(29, 1, 5, NULL, NULL),
(30, 1, 6, NULL, NULL),
(31, 1, 7, NULL, NULL),
(32, 1, 9, NULL, NULL),
(33, 1, 8, NULL, NULL),
(34, 1, 10, NULL, NULL),
(35, 1, 11, NULL, NULL),
(36, 1, 12, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(150) NOT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `cedularnc` varchar(20) NOT NULL,
  `direccion` varchar(250) DEFAULT NULL,
  `telefono` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '1',
  `id_cliente_tipo` int(11) DEFAULT NULL,
  `id_municipio` int(11) NOT NULL,
  `id_usuario_tipo` int(11) NOT NULL,
  `lat` text NOT NULL,
  `lon` text NOT NULL,
  `id_venta_documento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombres`, `apellidos`, `cedularnc`, `direccion`, `telefono`, `celular`, `correo`, `clave`, `estado`, `id_cliente_tipo`, `id_municipio`, `id_usuario_tipo`, `lat`, `lon`, `id_venta_documento`) VALUES
(6, 'Juan Lucas', 'Sanchez Martinez', '000-0000000-0', 'Galindo, Mella #35', '555-555-5555', '444-444-4444', 'admin@admin.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, NULL, 53, 1, '', '', NULL),
(19, 'Ruth', 'Diaz', '027-0050111-3', 'Gualey, C/ Antonio Guzman #69', '809-553-2580', '829-513-2580', 'ruthdiaz@gmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, 1, 52, 2, '', '', NULL),
(20, 'Nombres distribuidor', 'Apellidos Distribuidor', '020-2020202-0', 'Calle Mella #35', '808-088-8088', '878-948-4848', 'd@d.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, NULL, 52, 3, '', '', NULL),
(21, 'Deivinson', 'Fernandez', '123-1231231-2', 'Felipe de castro 60', '123-123-1231', '123-123-1231', 'c@c.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, 1, 52, 2, '', '', 2),
(22, 'pepito', 'aleluya', '111-2150515-4', 'C/ Mella #65', '000-000-0000', '809-000-0000', 'pepe@pepe.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, 1, 125, 2, '18.7632108', '-69.2561189', 2),
(23, 'Channel', 'Sanchez', '897-8789489-4', 'C/ no se cual he XD', '808-880-8080', '894-899-4894', 'channel@channel.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, NULL, 52, 3, '', '', NULL),
(24, 'nombre', 'apellidos', '122-1314141-4', 'cca', '143-313-1414', '224-412-3211', 'po@po.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 1, 1, 48, 2, '18.7640009', '-69.2540858', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_tipo`
--

CREATE TABLE `usuario_tipo` (
  `id_usuario_tipo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_tipo`
--

INSERT INTO `usuario_tipo` (`id_usuario_tipo`, `nombre`) VALUES
(1, 'Admin'),
(2, 'Cliente'),
(3, 'Distribuidor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_tipo_permiso`
--

CREATE TABLE `usuario_tipo_permiso` (
  `id_usuario_tipo_permiso` int(11) NOT NULL,
  `id_usuario_tipo` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_tipo_permiso`
--

INSERT INTO `usuario_tipo_permiso` (`id_usuario_tipo_permiso`, `id_usuario_tipo`, `id_permiso`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(10, 1, 9),
(11, 1, 10),
(12, 1, 11),
(13, 1, 12),
(14, 1, 13),
(15, 2, 14),
(16, 1, 15),
(17, 1, 16),
(18, 1, 17),
(19, 1, 18),
(20, 3, 19),
(21, 2, 8),
(22, 2, 16),
(23, 1, 20),
(24, 2, 20),
(25, 2, 1),
(26, 2, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id_vehiculo` int(11) NOT NULL,
  `placa` varchar(45) NOT NULL,
  `id_vehiculo_modelo` int(11) NOT NULL,
  `id_vehiculo_version` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_vehiculo_estado` int(11) NOT NULL,
  `id_creador` int(11) NOT NULL,
  `ficha` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id_vehiculo`, `placa`, `id_vehiculo_modelo`, `id_vehiculo_version`, `anio`, `fecha_creacion`, `id_vehiculo_estado`, `id_creador`, `ficha`) VALUES
(5, 'A500', 589, 1, 2009, '2018-01-07 22:10:48', 1, 6, 'A-15'),
(6, '1221', 905, 1, 2018, '2018-01-10 03:34:05', 1, 6, '122');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo_capacidad`
--

CREATE TABLE `vehiculo_capacidad` (
  `id_vehiculo_capacidad` int(11) NOT NULL,
  `id_vehiculo` int(11) NOT NULL,
  `id_producto_tipo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo_capacidad`
--

INSERT INTO `vehiculo_capacidad` (`id_vehiculo_capacidad`, `id_vehiculo`, `id_producto_tipo`, `cantidad`) VALUES
(9, 5, 1, 200),
(10, 5, 2, 1000),
(11, 5, 3, 500),
(12, 5, 9, 500),
(13, 6, 1, 400),
(14, 6, 2, 1000),
(15, 6, 3, 600),
(16, 6, 9, 600);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo_estado`
--

CREATE TABLE `vehiculo_estado` (
  `id_vehiculo_estado` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `css` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo_estado`
--

INSERT INTO `vehiculo_estado` (`id_vehiculo_estado`, `descripcion`, `css`) VALUES
(1, 'Disponible', 'green'),
(2, 'Mantenimiento', 'yellow');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo_marca`
--

CREATE TABLE `vehiculo_marca` (
  `id_vehiculo_marca` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo_marca`
--

INSERT INTO `vehiculo_marca` (`id_vehiculo_marca`, `nombre`) VALUES
(1, 'Abarth'),
(2, 'Alfa Romeo'),
(3, 'Aro'),
(4, 'Asia'),
(5, 'Asia Motors'),
(6, 'Aston Martin'),
(7, 'Audi'),
(8, 'Austin'),
(9, 'Auverland'),
(10, 'Bentley'),
(11, 'Bertone'),
(12, 'Bmw'),
(13, 'Cadillac'),
(14, 'Chevrolet'),
(15, 'Chrysler'),
(16, 'Citroen'),
(17, 'Corvette'),
(18, 'Dacia'),
(19, 'Daewoo'),
(20, 'Daf'),
(21, 'Daihatsu'),
(22, 'Daimler'),
(23, 'Dodge'),
(24, 'Ferrari'),
(25, 'Fiat'),
(26, 'Ford'),
(27, 'Galloper'),
(28, 'Gmc'),
(29, 'Honda'),
(30, 'Hummer'),
(31, 'Hyundai'),
(32, 'Infiniti'),
(33, 'Innocenti'),
(34, 'Isuzu'),
(35, 'Iveco'),
(36, 'Iveco-pegaso'),
(37, 'Jaguar'),
(38, 'Jeep'),
(39, 'Kia'),
(40, 'Lada'),
(41, 'Lamborghini'),
(42, 'Lancia'),
(43, 'Land-rover'),
(44, 'Ldv'),
(45, 'Lexus'),
(46, 'Lotus'),
(47, 'Mahindra'),
(48, 'Maserati'),
(49, 'Maybach'),
(50, 'Mazda'),
(51, 'Mercedes-benz'),
(52, 'Mg'),
(53, 'Mini'),
(54, 'Mitsubishi'),
(55, 'Morgan'),
(56, 'Nissan'),
(57, 'Opel'),
(58, 'Peugeot'),
(59, 'Pontiac'),
(60, 'Porsche'),
(61, 'Renault'),
(62, 'Rolls-royce'),
(63, 'Rover'),
(64, 'Saab'),
(65, 'Santana'),
(66, 'Seat'),
(67, 'Skoda'),
(68, 'Smart'),
(69, 'Ssangyong'),
(70, 'Subaru'),
(71, 'Suzuki'),
(72, 'Talbot'),
(73, 'Tata'),
(74, 'Toyota'),
(75, 'Umm'),
(76, 'Vaz'),
(77, 'Volkswagen'),
(78, 'Volvo'),
(79, 'Wartburg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo_modelo`
--

CREATE TABLE `vehiculo_modelo` (
  `id_vehiculo_modelo` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `id_vehiculo_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo_modelo`
--

INSERT INTO `vehiculo_modelo` (`id_vehiculo_modelo`, `nombre`, `id_vehiculo_marca`) VALUES
(1, '500', 1),
(2, 'Grande Punto', 1),
(3, 'Punto Evo', 1),
(4, '500c', 1),
(5, '695', 1),
(6, 'Punto', 1),
(7, '155', 2),
(8, '156', 2),
(9, '159', 2),
(10, '164', 2),
(11, '145', 2),
(12, '147', 2),
(13, '146', 2),
(14, 'Gtv', 2),
(15, 'Spider', 2),
(16, '166', 2),
(17, 'Gt', 2),
(18, 'Crosswan', 2),
(19, 'Brera', 2),
(20, '90', 2),
(21, '75', 2),
(22, '33', 2),
(23, 'Giulietta', 2),
(24, 'Sprint', 2),
(25, 'Mito', 2),
(26, 'Expander', 3),
(27, '10', 3),
(28, '24', 3),
(29, 'Dacia', 3),
(30, 'Rocsta', 4),
(31, 'Rocsta', 5),
(32, 'Db7', 6),
(33, 'V8', 6),
(34, 'Db9', 6),
(35, 'Vanquish', 6),
(36, 'V8 Vantage', 6),
(37, 'Vantage', 6),
(38, 'Dbs', 6),
(39, 'Volante', 6),
(40, 'Virage', 6),
(41, 'Vantage V8', 6),
(42, 'Vantage V12', 6),
(43, 'Rapide', 6),
(44, 'Cygnet', 6),
(45, '80', 7),
(46, 'A4', 7),
(47, 'A6', 7),
(48, 'S6', 7),
(49, 'Coupe', 7),
(50, 'S2', 7),
(51, 'Rs2', 7),
(52, 'A8', 7),
(53, 'Cabriolet', 7),
(54, 'S8', 7),
(55, 'A3', 7),
(56, 'S4', 7),
(57, 'Tt', 7),
(58, 'S3', 7),
(59, 'Allroad Quattro', 7),
(60, 'Rs4', 7),
(61, 'A2', 7),
(62, 'Rs6', 7),
(63, 'Q7', 7),
(64, 'R8', 7),
(65, 'A5', 7),
(66, 'S5', 7),
(67, 'V8', 7),
(68, '200', 7),
(69, '100', 7),
(70, '90', 7),
(71, 'Tts', 7),
(72, 'Q5', 7),
(73, 'A4 Allroad Quattro', 7),
(74, 'Tt Rs', 7),
(75, 'Rs5', 7),
(76, 'A1', 7),
(77, 'A7', 7),
(78, 'Rs3', 7),
(79, 'Q3', 7),
(80, 'A6 Allroad Quattro', 7),
(81, 'S7', 7),
(82, 'Sq5', 7),
(83, 'Mini', 8),
(84, 'Monte', 8),
(85, 'Maestro', 8),
(86, 'Metro', 8),
(87, 'Mini Moke', 8),
(88, 'Diesel', 9),
(89, 'Brooklands', 10),
(90, 'Turbo', 10),
(91, 'Continental', 10),
(92, 'Azure', 10),
(93, 'Arnage', 10),
(94, 'Continental Gt', 10),
(95, 'Continental Flying Spur', 10),
(96, 'Turbo R', 10),
(97, 'Mulsanne', 10),
(98, 'Eight', 10),
(99, 'Continental Gtc', 10),
(100, 'Continental Supersports', 10),
(101, 'Freeclimber Diesel', 11),
(102, 'Serie 3', 12),
(103, 'Serie 5', 12),
(104, 'Compact', 12),
(105, 'Serie 7', 12),
(106, 'Serie 8', 12),
(107, 'Z3', 12),
(108, 'Z4', 12),
(109, 'Z8', 12),
(110, 'X5', 12),
(111, 'Serie 6', 12),
(112, 'X3', 12),
(113, 'Serie 1', 12),
(114, 'Z1', 12),
(115, 'X6', 12),
(116, 'X1', 12),
(117, 'Seville', 13),
(118, 'Sts', 13),
(119, 'El Dorado', 13),
(120, 'Cts', 13),
(121, 'Xlr', 13),
(122, 'Srx', 13),
(123, 'Escalade', 13),
(124, 'Bls', 13),
(125, 'Corvette', 14),
(126, 'Blazer', 14),
(127, 'Astro', 14),
(128, 'Nubira', 14),
(129, 'Evanda', 14),
(130, 'Trans Sport', 14),
(131, 'Camaro', 14),
(132, 'Matiz', 14),
(133, 'Alero', 14),
(134, 'Tahoe', 14),
(135, 'Tacuma', 14),
(136, 'Trailblazer', 14),
(137, 'Kalos', 14),
(138, 'Aveo', 14),
(139, 'Lacetti', 14),
(140, 'Epica', 14),
(141, 'Captiva', 14),
(142, 'Hhr', 14),
(143, 'Cruze', 14),
(144, 'Spark', 14),
(145, 'Orlando', 14),
(146, 'Volt', 14),
(147, 'Malibu', 14),
(148, 'Vision', 15),
(149, '300m', 15),
(150, 'Grand Voyager', 15),
(151, 'Viper', 15),
(152, 'Neon', 15),
(153, 'Voyager', 15),
(154, 'Stratus', 15),
(155, 'Sebring', 15),
(156, 'Sebring 200c', 15),
(157, 'New Yorker', 15),
(158, 'Pt Cruiser', 15),
(159, 'Crossfire', 15),
(160, '300c', 15),
(161, 'Le Baron', 15),
(162, 'Saratoga', 15),
(163, 'Xantia', 16),
(164, 'Xm', 16),
(165, 'Ax', 16),
(166, 'Zx', 16),
(167, 'Evasion', 16),
(168, 'C8', 16),
(169, 'Saxo', 16),
(170, 'C2', 16),
(171, 'Xsara', 16),
(172, 'C4', 16),
(173, 'Xsara Picasso', 16),
(174, 'C5', 16),
(175, 'C3', 16),
(176, 'C3 Pluriel', 16),
(177, 'C1', 16),
(178, 'C6', 16),
(179, 'Grand C4 Picasso', 16),
(180, 'C4 Picasso', 16),
(181, 'Ccrosser', 16),
(182, 'C15', 16),
(183, 'Jumper', 16),
(184, 'Jumpy', 16),
(185, 'Berlin', 16),
(186, 'Bx', 16),
(187, 'C25', 16),
(188, 'Cx', 16),
(189, 'Gsa', 16),
(190, 'Visa', 16),
(191, 'Lna', 16),
(192, '2cv', 16),
(193, 'Nemo', 16),
(194, 'C4 Sedan', 16),
(195, 'Berlin First', 16),
(196, 'C3 Picasso', 16),
(197, 'Ds3', 16),
(198, 'Czero', 16),
(199, 'Ds4', 16),
(200, 'Ds5', 16),
(201, 'C4 Aircross', 16),
(202, 'Celysee', 16),
(203, 'Corvette', 17),
(204, 'Contac', 18),
(205, 'Logan', 18),
(206, 'Sandero', 18),
(207, 'Duster', 18),
(208, 'Lodgy', 18),
(209, 'Nexia', 19),
(210, 'Aranos', 19),
(211, 'Lanos', 19),
(212, 'Nubira', 19),
(213, 'Compact', 19),
(214, 'Nubira Compact', 19),
(215, 'Leganza', 19),
(216, 'Evanda', 19),
(217, 'Matiz', 19),
(218, 'Tacuma', 19),
(219, 'Kalos', 19),
(220, 'Lacetti', 19),
(221, 'Applause', 21),
(222, 'Charade', 21),
(223, 'Rocky', 21),
(224, 'Feroza', 21),
(225, 'Terios', 21),
(226, 'Sirion', 21),
(227, 'Serie Xj', 22),
(228, 'Xj', 22),
(229, 'Double Six', 22),
(230, 'Six', 22),
(231, 'Series Iii', 22),
(232, 'Viper', 23),
(233, 'Caliber', 23),
(234, 'Nitro', 23),
(235, 'Avenger', 23),
(236, 'Journey', 23),
(237, 'F355', 24),
(238, '360', 24),
(239, 'F430', 24),
(240, 'F512 M', 24),
(241, '550 Maranello', 24),
(242, '575m Maranello', 24),
(243, '599', 24),
(244, '456', 24),
(245, '456m', 24),
(246, '612', 24),
(247, 'F50', 24),
(248, 'Enzo', 24),
(249, 'Superamerica', 24),
(250, '430', 24),
(251, '348', 24),
(252, 'Testarossa', 24),
(253, '512', 24),
(254, '355', 24),
(255, 'F40', 24),
(256, '412', 24),
(257, 'Mondial', 24),
(258, '328', 24),
(259, 'California', 24),
(260, '458', 24),
(261, 'Ff', 24),
(262, 'Croma', 25),
(263, 'Cinquecento', 25),
(264, 'Seicento', 25),
(265, 'Punto', 25),
(266, 'Grande Punto', 25),
(267, 'Panda', 25),
(268, 'Tipo', 25),
(269, 'Coupe', 25),
(270, 'Uno', 25),
(271, 'Ulysse', 25),
(272, 'Tempra', 25),
(273, 'Marea', 25),
(274, 'Barchetta', 25),
(275, 'Bravo', 25),
(276, 'Stilo', 25),
(277, 'Brava', 25),
(278, 'Palio Weekend', 25),
(279, '600', 25),
(280, 'Multipla', 25),
(281, 'Idea', 25),
(282, 'Sedici', 25),
(283, 'Linea', 25),
(284, '500', 25),
(285, 'Fiorino', 25),
(286, 'Ducato', 25),
(287, 'Doblo Car', 25),
(288, 'Doblo', 25),
(289, 'Strada', 25),
(290, 'Regata', 25),
(291, 'Talento', 25),
(292, 'Argenta', 25),
(293, 'Ritmo', 25),
(294, 'Punto Classic', 25),
(295, 'Qubo', 25),
(296, 'Punto Evo', 25),
(297, '500c', 25),
(298, 'Freemont', 25),
(299, 'Panda Classic', 25),
(300, '500l', 25),
(301, 'Maverick', 26),
(302, 'Escort', 26),
(303, 'Focus', 26),
(304, 'Mondeo', 26),
(305, 'Scorpio', 26),
(306, 'Fiesta', 26),
(307, 'Probe', 26),
(308, 'Explorer', 26),
(309, 'Galaxy', 26),
(310, 'Ka', 26),
(311, 'Puma', 26),
(312, 'Cougar', 26),
(313, 'Focus Cmax', 26),
(314, 'Fusion', 26),
(315, 'Streetka', 26),
(316, 'Cmax', 26),
(317, 'Smax', 26),
(318, 'Transit', 26),
(319, 'Courier', 26),
(320, 'Ranger', 26),
(321, 'Sierra', 26),
(322, 'Orion', 26),
(323, 'Pick Up', 26),
(324, 'Capri', 26),
(325, 'Granada', 26),
(326, 'Kuga', 26),
(327, 'Grand Cmax', 26),
(328, 'Bmax', 26),
(329, 'Tourneo Custom', 26),
(330, 'Exceed', 27),
(331, 'Santamo', 27),
(332, 'Super Exceed', 27),
(333, 'Accord', 29),
(334, 'Civic', 29),
(335, 'Crx', 29),
(336, 'Prelude', 29),
(337, 'Nsx', 29),
(338, 'Legend', 29),
(339, 'Crv', 29),
(340, 'Hrv', 29),
(341, 'Lo', 29),
(342, 'S2000', 29),
(343, 'Stream', 29),
(344, 'Jazz', 29),
(345, 'Frv', 29),
(346, 'Concerto', 29),
(347, 'Insight', 29),
(348, 'Crz', 29),
(349, 'H2', 30),
(350, 'H3', 30),
(351, 'H3t', 30),
(352, 'Lantra', 31),
(353, 'Sonata', 31),
(354, 'Elantra', 31),
(355, 'Accent', 31),
(356, 'Scoupe', 31),
(357, 'Coupe', 31),
(358, 'Atos', 31),
(359, 'H1', 31),
(360, 'Atos Prime', 31),
(361, 'Xg', 31),
(362, 'Trajet', 31),
(363, 'Santa Fe', 31),
(364, 'Terracan', 31),
(365, 'Matrix', 31),
(366, 'Getz', 31),
(367, 'Tucson', 31),
(368, 'I30', 31),
(369, 'Pony', 31),
(370, 'Grandeur', 31),
(371, 'I10', 31),
(372, 'I800', 31),
(373, 'Sonata Fl', 31),
(374, 'Ix55', 31),
(375, 'I20', 31),
(376, 'Ix35', 31),
(377, 'Ix20', 31),
(378, 'Genesis', 31),
(379, 'I40', 31),
(380, 'Veloster', 31),
(381, 'G', 32),
(382, 'Ex', 32),
(383, 'Fx', 32),
(384, 'M', 32),
(385, 'Elba', 33),
(386, 'Minitre', 33),
(387, 'Trooper', 34),
(388, 'Pick Up', 34),
(389, 'D Max', 34),
(390, 'Rodeo', 34),
(391, 'Dmax', 34),
(392, 'Trroper', 34),
(393, 'Daily', 35),
(394, 'Massif', 35),
(395, 'Daily', 36),
(396, 'Duty', 36),
(397, 'Serie Xj', 37),
(398, 'Serie Xk', 37),
(399, 'Xj', 37),
(400, 'Stype', 37),
(401, 'Xf', 37),
(402, 'Xtype', 37),
(403, 'Wrangler', 38),
(404, 'Cherokee', 38),
(405, 'Grand Cherokee', 38),
(406, 'Commander', 38),
(407, 'Compass', 38),
(408, 'Wrangler Unlimited', 38),
(409, 'Patriot', 38),
(410, 'Sportage', 39),
(411, 'Sephia', 39),
(412, 'Sephia Ii', 39),
(413, 'Pride', 39),
(414, 'Clarus', 39),
(415, 'Shuma', 39),
(416, 'Carnival', 39),
(417, 'Joice', 39),
(418, 'Magentis', 39),
(419, 'Carens', 39),
(420, 'Rio', 39),
(421, 'Cerato', 39),
(422, 'Sorento', 39),
(423, 'Opirus', 39),
(424, 'Picanto', 39),
(425, 'Ceed', 39),
(426, 'Ceed Sporty Wan', 39),
(427, 'Proceed', 39),
(428, 'K2500 Frontier', 39),
(429, 'K2500', 39),
(430, 'Soul', 39),
(431, 'Venga', 39),
(432, 'Optima', 39),
(433, 'Ceed Sportswan', 39),
(434, 'Samara', 40),
(435, 'Niva', 40),
(436, 'Sana', 40),
(437, 'Stawra 2110', 40),
(438, '214', 40),
(439, 'Kalina', 40),
(440, 'Serie 2100', 40),
(441, 'Priora', 40),
(442, 'Gallardo', 41),
(443, 'Murciela', 41),
(444, 'Aventador', 41),
(445, 'Delta', 42),
(446, 'K', 42),
(447, 'Y10', 42),
(448, 'Dedra', 42),
(449, 'Lybra', 42),
(450, 'Z', 42),
(451, 'Y', 42),
(452, 'Ypsilon', 42),
(453, 'Thesis', 42),
(454, 'Phedra', 42),
(455, 'Musa', 42),
(456, 'Thema', 42),
(457, 'Zeta', 42),
(458, 'Kappa', 42),
(459, 'Trevi', 42),
(460, 'Prisma', 42),
(461, 'A112', 42),
(462, 'Ypsilon Elefantino', 42),
(463, 'Voyager', 42),
(464, 'Range Rover', 43),
(465, 'Defender', 43),
(466, 'Discovery', 43),
(467, 'Freelander', 43),
(468, 'Range Rover Sport', 43),
(469, 'Discovery 4', 43),
(470, 'Range Rover Evoque', 43),
(471, 'Maxus', 44),
(472, 'Ls400', 45),
(473, 'Ls430', 45),
(474, 'Gs300', 45),
(475, 'Is200', 45),
(476, 'Rx300', 45),
(477, 'Gs430', 45),
(478, 'Gs460', 45),
(479, 'Sc430', 45),
(480, 'Is300', 45),
(481, 'Is250', 45),
(482, 'Rx400h', 45),
(483, 'Is220d', 45),
(484, 'Rx350', 45),
(485, 'Gs450h', 45),
(486, 'Ls460', 45),
(487, 'Ls600h', 45),
(488, 'Ls', 45),
(489, 'Gs', 45),
(490, 'Is', 45),
(491, 'Sc', 45),
(492, 'Rx', 45),
(493, 'Ct', 45),
(494, 'Elise', 46),
(495, 'Exige', 46),
(496, 'Bolero Pickup', 47),
(497, 'a Pickup', 47),
(498, 'a', 47),
(499, 'Cj', 47),
(500, 'Pikup', 47),
(501, 'Thar', 47),
(502, 'Ghibli', 48),
(503, 'Shamal', 48),
(504, 'Quattroporte', 48),
(505, '3200 Gt', 48),
(506, 'Coupe', 48),
(507, 'Spyder', 48),
(508, 'Gransport', 48),
(509, 'Granturismo', 48),
(510, '430', 48),
(511, 'Biturbo', 48),
(512, '228', 48),
(513, '224', 48),
(514, 'Grancabrio', 48),
(515, 'Maybach', 49),
(516, 'Xedos 6', 50),
(517, '626', 50),
(518, '121', 50),
(519, 'Xedos 9', 50),
(520, '323', 50),
(521, 'Mx3', 50),
(522, 'Rx7', 50),
(523, 'Mx5', 50),
(524, 'Mazda3', 50),
(525, 'Mpv', 50),
(526, 'Demio', 50),
(527, 'Premacy', 50),
(528, 'Tribute', 50),
(529, 'Mazda6', 50),
(530, 'Mazda2', 50),
(531, 'Rx8', 50),
(532, 'Mazda5', 50),
(533, 'Cx7', 50),
(534, 'Serie B', 50),
(535, 'B2500', 50),
(536, 'Bt50', 50),
(537, 'Mx6', 50),
(538, '929', 50),
(539, 'Cx5', 50),
(540, 'Clase C', 51),
(541, 'Clase E', 51),
(542, 'Clase Sl', 51),
(543, 'Clase S', 51),
(544, 'Clase Cl', 51),
(545, 'Clase G', 51),
(546, 'Clase Slk', 51),
(547, 'Clase V', 51),
(548, 'Viano', 51),
(549, 'Clase Clk', 51),
(550, 'Clase A', 51),
(551, 'Clase M', 51),
(552, 'Vaneo', 51),
(553, 'Slklasse', 51),
(554, 'Slr Mclaren', 51),
(555, 'Clase Cls', 51),
(556, 'Clase R', 51),
(557, 'Clase Gl', 51),
(558, 'Clase B', 51),
(559, '100d', 51),
(560, '140d', 51),
(561, '180d', 51),
(562, 'Sprinter', 51),
(563, 'Vito', 51),
(564, 'Transporter', 51),
(565, '280', 51),
(566, '220', 51),
(567, '200', 51),
(568, '190', 51),
(569, '600', 51),
(570, '400', 51),
(571, 'Clase Sl R129', 51),
(572, '300', 51),
(573, '500', 51),
(574, '420', 51),
(575, '260', 51),
(576, '230', 51),
(577, 'Clase Clc', 51),
(578, 'Clase Glk', 51),
(579, 'Sls Amg', 51),
(580, 'Mgf', 52),
(581, 'Tf', 52),
(582, 'Zr', 52),
(583, 'Zs', 52),
(584, 'Zt', 52),
(585, 'Ztt', 52),
(586, 'Mini', 52),
(587, 'Countryman', 52),
(588, 'Paceman', 52),
(589, 'Montero', 54),
(590, 'Galant', 54),
(591, 'Colt', 54),
(592, 'Space Wan', 54),
(593, 'Space Runner', 54),
(594, 'Space Gear', 54),
(595, '3000 Gt', 54),
(596, 'Carisma', 54),
(597, 'Eclipse', 54),
(598, 'Space Star', 54),
(599, 'Montero Sport', 54),
(600, 'Montero Io', 54),
(601, 'Outlander', 54),
(602, 'Lancer', 54),
(603, 'Grandis', 54),
(604, 'L200', 54),
(605, 'Canter', 54),
(606, '300 Gt', 54),
(607, 'Asx', 54),
(608, 'Imiev', 54),
(609, '44', 55),
(610, 'Plus 8', 55),
(611, 'Aero 8', 55),
(612, 'V6', 55),
(613, 'Roadster', 55),
(614, '4', 55),
(615, 'Plus 4', 55),
(616, 'Terrano Ii', 56),
(617, 'Terrano', 56),
(618, 'Micra', 56),
(619, 'Sunny', 56),
(620, 'Primera', 56),
(621, 'Serena', 56),
(622, 'Patrol', 56),
(623, 'Maxima Qx', 56),
(624, '200 Sx', 56),
(625, '300 Zx', 56),
(626, 'Patrol Gr', 56),
(627, '100 Nx', 56),
(628, 'Almera', 56),
(629, 'Pathfinder', 56),
(630, 'Almera Tino', 56),
(631, 'Xtrail', 56),
(632, '350z', 56),
(633, 'Murano', 56),
(634, 'Note', 56),
(635, 'Qashqai', 56),
(636, 'Tiida', 56),
(637, 'Vanette', 56),
(638, 'Trade', 56),
(639, 'Vanette Car', 56),
(640, 'Pickup', 56),
(641, 'Navara', 56),
(642, 'Cabstar E', 56),
(643, 'Cabstar', 56),
(644, 'Maxima', 56),
(645, 'Camion', 56),
(646, 'Prairie', 56),
(647, 'Bluebird', 56),
(648, 'Np300 Pick Up', 56),
(649, 'Qashqai2', 56),
(650, 'Pixo', 56),
(651, 'Gtr', 56),
(652, '370z', 56),
(653, 'Cube', 56),
(654, 'Juke', 56),
(655, 'Leaf', 56),
(656, 'Evalia', 56),
(657, 'Astra', 57),
(658, 'Vectra', 57),
(659, 'Calibra', 57),
(660, 'Corsa', 57),
(661, 'Omega', 57),
(662, 'Frontera', 57),
(663, 'Tigra', 57),
(664, 'Monterey', 57),
(665, 'Sintra', 57),
(666, 'Zafira', 57),
(667, 'Agila', 57),
(668, 'Speedster', 57),
(669, 'Signum', 57),
(670, 'Meriva', 57),
(671, 'Antara', 57),
(672, 'Gt', 57),
(673, 'Combo', 57),
(674, 'Movano', 57),
(675, 'Vivaro', 57),
(676, 'Kadett', 57),
(677, 'Monza', 57),
(678, 'Senator', 57),
(679, 'Rekord', 57),
(680, 'Manta', 57),
(681, 'Ascona', 57),
(682, 'Insignia', 57),
(683, 'Zafira Tourer', 57),
(684, 'Ampera', 57),
(685, 'Mokka', 57),
(686, 'Adam', 57),
(687, '306', 58),
(688, '605', 58),
(689, '106', 58),
(690, '205', 58),
(691, '405', 58),
(692, '406', 58),
(693, '806', 58),
(694, '807', 58),
(695, '407', 58),
(696, '307', 58),
(697, '206', 58),
(698, '607', 58),
(699, '308', 58),
(700, '307 Sw', 58),
(701, '206 Sw', 58),
(702, '407 Sw', 58),
(703, '1007', 58),
(704, '107', 58),
(705, '207', 58),
(706, '4007', 58),
(707, 'Boxer', 58),
(708, 'Partner', 58),
(709, 'J5', 58),
(710, '604', 58),
(711, '505', 58),
(712, '309', 58),
(713, 'Bipper', 58),
(714, 'Partner Origin', 58),
(715, '3008', 58),
(716, '5008', 58),
(717, 'Rcz', 58),
(718, '508', 58),
(719, 'Ion', 58),
(720, '208', 58),
(721, '4008', 58),
(722, 'Trans Sport', 59),
(723, 'Firebird', 59),
(724, 'Trans Am', 59),
(725, '911', 60),
(726, 'Boxster', 60),
(727, 'Cayenne', 60),
(728, 'Carrera Gt', 60),
(729, 'Cayman', 60),
(730, '928', 60),
(731, '968', 60),
(732, '944', 60),
(733, '924', 60),
(734, 'Panamera', 60),
(735, '918', 60),
(736, 'Megane', 61),
(737, 'Safrane', 61),
(738, 'Laguna', 61),
(739, 'Clio', 61),
(740, 'Twin', 61),
(741, 'Nevada', 61),
(742, 'Espace', 61),
(743, 'Spider', 61),
(744, 'Scenic', 61),
(745, 'Grand Espace', 61),
(746, 'Avantime', 61),
(747, 'Vel Satis', 61),
(748, 'Grand Scenic', 61),
(749, 'Clio Campus', 61),
(750, 'Modus', 61),
(751, 'Express', 61),
(752, 'Trafic', 61),
(753, 'Master', 61),
(754, 'Kano', 61),
(755, 'Mascott', 61),
(756, 'Master Propulsion', 61),
(757, 'Maxity', 61),
(758, 'R19', 61),
(759, 'R25', 61),
(760, 'R5', 61),
(761, 'R21', 61),
(762, 'R4', 61),
(763, 'Alpine', 61),
(764, 'Fue', 61),
(765, 'R18', 61),
(766, 'R11', 61),
(767, 'R9', 61),
(768, 'R6', 61),
(769, 'Grand Modus', 61),
(770, 'Kano Combi', 61),
(771, 'Koleos', 61),
(772, 'Fluence', 61),
(773, 'Wind', 61),
(774, 'Latitude', 61),
(775, 'Grand Kano Combi', 61),
(776, 'Siver Dawn', 62),
(777, 'Silver Spur', 62),
(778, 'Park Ward', 62),
(779, 'Silver Seraph', 62),
(780, 'Corniche', 62),
(781, 'Phantom', 62),
(782, 'Touring', 62),
(783, 'Silvier', 62),
(784, '800', 63),
(785, '600', 63),
(786, '100', 63),
(787, '200', 63),
(788, 'Coupe', 63),
(789, '400', 63),
(790, '45', 63),
(791, 'Cabriolet', 63),
(792, '25', 63),
(793, 'Mini', 63),
(794, '75', 63),
(795, 'Streetwise', 63),
(796, 'Sd', 63),
(797, '900', 64),
(798, '93', 64),
(799, '9000', 64),
(800, '95', 64),
(801, '93x', 64),
(802, '94x', 64),
(803, '300', 65),
(804, '350', 65),
(805, 'Anibal', 65),
(806, 'Anibal Pick Up', 65),
(807, 'Ibiza', 66),
(808, 'Cordoba', 66),
(809, 'Toledo', 66),
(810, 'Marbella', 66),
(811, 'Alhambra', 66),
(812, 'Arosa', 66),
(813, 'Leon', 66),
(814, 'Altea', 66),
(815, 'Altea Xl', 66),
(816, 'Altea Freetrack', 66),
(817, 'Terra', 66),
(818, 'Inca', 66),
(819, 'Malaga', 66),
(820, 'Ronda', 66),
(821, 'Exeo', 66),
(822, 'Mii', 66),
(823, 'Felicia', 67),
(824, 'Forman', 67),
(825, 'Octavia', 67),
(826, 'Octavia Tour', 67),
(827, 'Fabia', 67),
(828, 'Superb', 67),
(829, 'Roomster', 67),
(830, 'Scout', 67),
(831, 'Pickup', 67),
(832, 'Favorit', 67),
(833, '130', 67),
(834, 'S', 67),
(835, 'Yeti', 67),
(836, 'Citi', 67),
(837, 'Rapid', 67),
(838, 'Smart', 68),
(839, 'Citycoupe', 68),
(840, 'Fortwo', 68),
(841, 'Cabrio', 68),
(842, 'Crossblade', 68),
(843, 'Roadster', 68),
(844, 'Forfour', 68),
(845, 'Korando', 69),
(846, 'Family', 69),
(847, 'K4d', 69),
(848, 'Musso', 69),
(849, 'Korando Kj', 69),
(850, 'Rexton', 69),
(851, 'Rexton Ii', 69),
(852, 'Rodius', 69),
(853, 'Kyron', 69),
(854, 'Actyon', 69),
(855, 'Sports Pick Up', 69),
(856, 'Actyon Sports Pick Up', 69),
(857, 'Kodando', 69),
(858, 'Legacy', 70),
(859, 'Impreza', 70),
(860, 'Svx', 70),
(861, 'Justy', 70),
(862, 'Outback', 70),
(863, 'Forester', 70),
(864, 'G3x Justy', 70),
(865, 'B9 Tribeca', 70),
(866, 'Xt', 70),
(867, '1800', 70),
(868, 'Tribeca', 70),
(869, 'Wrx Sti', 70),
(870, 'Trezia', 70),
(871, 'Xv', 70),
(872, 'Brz', 70),
(873, 'Maruti', 71),
(874, 'Swift', 71),
(875, 'Vitara', 71),
(876, 'Baleno', 71),
(877, 'Samurai', 71),
(878, 'Alto', 71),
(879, 'Wan R', 71),
(880, 'Jimny', 71),
(881, 'Grand Vitara', 71),
(882, 'Ignis', 71),
(883, 'Liana', 71),
(884, 'Grand Vitara Xl7', 71),
(885, 'Sx4', 71),
(886, 'Splash', 71),
(887, 'Kizashi', 71),
(888, 'Samba', 72),
(889, 'Tara', 72),
(890, 'Solara', 72),
(891, 'Horizon', 72),
(892, 'Telcosport', 73),
(893, 'Telco', 73),
(894, 'Sumo', 73),
(895, 'Safari', 73),
(896, 'Indica', 73),
(897, 'Indi', 73),
(898, 'Grand Safari', 73),
(899, 'Tl Pick Up', 73),
(900, 'Xenon Pick Up', 73),
(901, 'Vista', 73),
(902, 'Xenon', 73),
(903, 'Aria', 73),
(904, 'Carina E', 74),
(905, '4runner', 74),
(906, 'Camry', 74),
(907, 'Rav4', 74),
(908, 'Celica', 74),
(909, 'Supra', 74),
(910, 'Paseo', 74),
(911, 'Land Cruiser 80', 74),
(912, 'Land Cruiser 100', 74),
(913, 'Land Cruiser', 74),
(914, 'Land Cruiser 90', 74),
(915, 'Corolla', 74),
(916, 'Auris', 74),
(917, 'Avensis', 74),
(918, 'Picnic', 74),
(919, 'Yaris', 74),
(920, 'Yaris Verso', 74),
(921, 'Mr2', 74),
(922, 'Previa', 74),
(923, 'Prius', 74),
(924, 'Avensis Verso', 74),
(925, 'Corolla Verso', 74),
(926, 'Corolla Sedan', 74),
(927, 'Ay', 74),
(928, 'Hilux', 74),
(929, 'Dyna', 74),
(930, 'Land Cruiser 200', 74),
(931, 'Verso', 74),
(932, 'Iq', 74),
(933, 'Urban Cruiser', 74),
(934, 'Gt86', 74),
(935, '100', 75),
(936, '121', 75),
(937, '214', 76),
(938, '110 Stawra', 76),
(939, '111 Stawra', 76),
(940, '215', 76),
(941, '112 Stawra', 76),
(942, 'Passat', 77),
(943, 'lf', 77),
(944, 'Vento', 77),
(945, 'Polo', 77),
(946, 'Corrado', 77),
(947, 'Sharan', 77),
(948, 'Lupo', 77),
(949, 'Bora', 77),
(950, 'Jetta', 77),
(951, 'New Beetle', 77),
(952, 'Phaeton', 77),
(953, 'Touareg', 77),
(954, 'Touran', 77),
(955, 'Multivan', 77),
(956, 'Caddy', 77),
(957, 'lf Plus', 77),
(958, 'Fox', 77),
(959, 'Eos', 77),
(960, 'Caravelle', 77),
(961, 'Tiguan', 77),
(962, 'Transporter', 77),
(963, 'Lt', 77),
(964, 'Taro', 77),
(965, 'Crafter', 77),
(966, 'California', 77),
(967, 'Santana', 77),
(968, 'Scirocco', 77),
(969, 'Passat Cc', 77),
(970, 'Amarok', 77),
(971, 'Beetle', 77),
(972, 'Up', 77),
(973, 'Cc', 77),
(974, '440', 78),
(975, '850', 78),
(976, 'S70', 78),
(977, 'V70', 78),
(978, 'V70 Classic', 78),
(979, '940', 78),
(980, '480', 78),
(981, '460', 78),
(982, '960', 78),
(983, 'S90', 78),
(984, 'V90', 78),
(985, 'Classic', 78),
(986, 'S40', 78),
(987, 'V40', 78),
(988, 'V50', 78),
(989, 'V70 Xc', 78),
(990, 'Xc70', 78),
(991, 'C70', 78),
(992, 'S80', 78),
(993, 'S60', 78),
(994, 'Xc90', 78),
(995, 'C30', 78),
(996, '780', 78),
(997, '760', 78),
(998, '740', 78),
(999, '240', 78),
(1000, '360', 78),
(1001, '340', 78),
(1002, 'Xc60', 78),
(1003, 'V60', 78),
(1004, 'V40 Cross Country', 78),
(1005, '353', 79),
(1006, 'Mini', 53),
(1007, 'Countryman', 53),
(1008, 'Paceman', 53);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo_version`
--

CREATE TABLE `vehiculo_version` (
  `id_vehiculo_version` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculo_version`
--

INSERT INTO `vehiculo_version` (`id_vehiculo_version`, `nombre`) VALUES
(1, 'Americana'),
(2, 'Coreana'),
(3, 'Japonesa'),
(4, 'China');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `id_venta_pago` int(11) NOT NULL,
  `id_venta_tipo` int(11) NOT NULL,
  `pagada` tinyint(4) NOT NULL DEFAULT '1',
  `total` decimal(8,2) NOT NULL,
  `cantidad_pagada` decimal(6,2) NOT NULL DEFAULT '0.00',
  `fecha_creacion` datetime NOT NULL,
  `id_venta_documento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `id_cliente`, `id_pedido`, `id_usuario`, `id_empleado`, `id_venta_pago`, `id_venta_tipo`, `pagada`, `total`, `cantidad_pagada`, `fecha_creacion`, `id_venta_documento`) VALUES
(1, 19, 2, 6, 6, 1, 2, 1, '15.00', '15.00', '2018-01-16 03:02:06', 1),
(2, 19, 3, 6, 6, 1, 2, 1, '15.00', '15.00', '2018-01-16 03:06:11', 1),
(3, 19, 4, 20, 20, 1, 2, 0, '15.00', '10.00', '2018-01-16 16:45:36', 1),
(4, 19, 6, 20, 20, 1, 2, 0, '15.00', '0.00', '2018-01-16 16:47:40', 1),
(5, 19, 9, 20, 20, 1, 2, 0, '15.00', '0.00', '2018-01-16 17:02:07', 1),
(6, 19, 11, 20, 20, 1, 2, 0, '15.00', '0.00', '2018-01-16 17:13:52', 1);

--
-- Disparadores `venta`
--
DELIMITER $$
CREATE TRIGGER `updateVentaPago` BEFORE UPDATE ON `venta` FOR EACH ROW BEGIN
if NEW.total = NEW.cantidad_pagada THEN
   	SET NEW.pagada = 1;
    UPDATE pedido p SET p.id_pedido_estado = 1 WHERE p.id_pedido = id_pedido;
   ELSE
 	SET NEW.pagada = 0;
    UPDATE pedido p SET p.id_pedido_estado = 3 WHERE p.id_pedido = id_pedido;
   END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_detalle`
--

CREATE TABLE `venta_detalle` (
  `id_venta_detalle` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_detalle`
--

INSERT INTO `venta_detalle` (`id_venta_detalle`, `id_producto`, `id_venta`, `cantidad`, `precio`) VALUES
(1, 1, 1, 1, '15.00'),
(2, 1, 2, 1, '15.00'),
(3, 1, 3, 1, '15.00'),
(4, 1, 4, 1, '15.00'),
(5, 1, 5, 1, '15.00'),
(6, 1, 6, 1, '15.00');

--
-- Disparadores `venta_detalle`
--
DELIMITER $$
CREATE TRIGGER `tr_updateExistenciaVenta` AFTER INSERT ON `venta_detalle` FOR EACH ROW BEGIN
	UPDATE producto SET existencia = existencia - NEW.cantidad WHERE producto.id_producto = NEW.id_producto;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_documento`
--

CREATE TABLE `venta_documento` (
  `id_venta_documento` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_documento`
--

INSERT INTO `venta_documento` (`id_venta_documento`, `nombre`) VALUES
(1, 'FACTURA'),
(2, 'TICKET');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_pago`
--

CREATE TABLE `venta_pago` (
  `id_venta_pago` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_pago`
--

INSERT INTO `venta_pago` (`id_venta_pago`, `nombre`) VALUES
(1, 'Efectivo'),
(2, 'Cheque'),
(3, 'Tarjeta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_tipo`
--

CREATE TABLE `venta_tipo` (
  `id_venta_tipo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta_tipo`
--

INSERT INTO `venta_tipo` (`id_venta_tipo`, `nombre`) VALUES
(1, 'Contado'),
(2, 'Credito');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id_chat`),
  ADD KEY `fk_mensaje_cliente` (`id_cliente`),
  ADD KEY `fk_mensaje_usuario` (`id_usuario`);

--
-- Indices de la tabla `cliente_tipo`
--
ALTER TABLE `cliente_tipo`
  ADD PRIMARY KEY (`id_cliente_tipo`);

--
-- Indices de la tabla `distrito_municipal`
--
ALTER TABLE `distrito_municipal`
  ADD PRIMARY KEY (`id_distrito_municipal`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id_municipio`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `fk_pedido_estado_idx` (`id_pedido_estado`),
  ADD KEY `fk_cliente_idx` (`id_cliente`),
  ADD KEY `fk_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  ADD PRIMARY KEY (`id_pedido_detalle`),
  ADD KEY `fk_pedido_idx` (`id_pedido`),
  ADD KEY `fk_producto_idx` (`id_producto`);

--
-- Indices de la tabla `pedido_estado`
--
ALTER TABLE `pedido_estado`
  ADD PRIMARY KEY (`id_pedido_estado`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_producto_marca_idx` (`id_producto_marca`),
  ADD KEY `fk_producto_tipo_idx` (`id_producto_tipo`);

--
-- Indices de la tabla `producto_existencia`
--
ALTER TABLE `producto_existencia`
  ADD PRIMARY KEY (`id_producto_existencia`),
  ADD KEY `fk_usuario_idx` (`id_usuario`);

--
-- Indices de la tabla `producto_existencia_detalle`
--
ALTER TABLE `producto_existencia_detalle`
  ADD PRIMARY KEY (`id_producto_existencia_detalle`),
  ADD KEY `fk_producto_existencia_idx` (`id_producto_existencia`),
  ADD KEY `fk_producto_idx` (`id_producto`);

--
-- Indices de la tabla `producto_marca`
--
ALTER TABLE `producto_marca`
  ADD PRIMARY KEY (`id_producto_marca`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `producto_tipo`
--
ALTER TABLE `producto_tipo`
  ADD PRIMARY KEY (`id_producto_tipo`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`id_provincia`);

--
-- Indices de la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD PRIMARY KEY (`id_recibo`),
  ADD KEY `fk_venta_idx` (`id_venta`),
  ADD KEY `fk_usuario_idx` (`id_usuario`),
  ADD KEY `fk_venta_pago_idx` (`id_venta_pago`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`id_ruta`),
  ADD KEY `fk_empleado_idx` (`id_empleado`),
  ADD KEY `fk_vehiculo_idx` (`id_vehiculo`),
  ADD KEY `fk_creador_ruta` (`id_creador`);

--
-- Indices de la tabla `ruta_establecida`
--
ALTER TABLE `ruta_establecida`
  ADD PRIMARY KEY (`id_ruta_establecida`);

--
-- Indices de la tabla `ruta_establecida_lugar`
--
ALTER TABLE `ruta_establecida_lugar`
  ADD PRIMARY KEY (`id_ruta_establecida_lugar`),
  ADD KEY `fk_cliente_idx` (`id_cliente`),
  ADD KEY `fk_ruta_establecida_idx` (`id_ruta_establecida`);

--
-- Indices de la tabla `ruta_lugar`
--
ALTER TABLE `ruta_lugar`
  ADD PRIMARY KEY (`id_ruta_lugar`),
  ADD KEY `fk_ruta_idx` (`id_ruta`),
  ADD KEY `fk_cliente_idx` (`id_pedido`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_cliente_tipo_idx` (`id_cliente_tipo`),
  ADD KEY `fk_sector_idx` (`id_municipio`),
  ADD KEY `fk_usuario_tipo_idx` (`id_usuario_tipo`),
  ADD KEY `fk_cliente_documento` (`id_venta_documento`);

--
-- Indices de la tabla `usuario_tipo`
--
ALTER TABLE `usuario_tipo`
  ADD PRIMARY KEY (`id_usuario_tipo`);

--
-- Indices de la tabla `usuario_tipo_permiso`
--
ALTER TABLE `usuario_tipo_permiso`
  ADD PRIMARY KEY (`id_usuario_tipo_permiso`),
  ADD KEY `fk_usuario_tipo_idx` (`id_usuario_tipo`),
  ADD KEY `fk_permiso_idx` (`id_permiso`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`id_vehiculo`),
  ADD KEY `fk_Vehiculo_modelo_idx` (`id_vehiculo_modelo`),
  ADD KEY `fk_vehiculo_version_idx` (`id_vehiculo_version`),
  ADD KEY `fk_vehiculo_estado_idx` (`id_vehiculo_estado`),
  ADD KEY `fk_creador_vehiculo` (`id_creador`);

--
-- Indices de la tabla `vehiculo_capacidad`
--
ALTER TABLE `vehiculo_capacidad`
  ADD PRIMARY KEY (`id_vehiculo_capacidad`),
  ADD KEY `fk_vehiculo_idx` (`id_vehiculo`),
  ADD KEY `fk_producto_tipo_idx` (`id_producto_tipo`);

--
-- Indices de la tabla `vehiculo_estado`
--
ALTER TABLE `vehiculo_estado`
  ADD PRIMARY KEY (`id_vehiculo_estado`);

--
-- Indices de la tabla `vehiculo_marca`
--
ALTER TABLE `vehiculo_marca`
  ADD PRIMARY KEY (`id_vehiculo_marca`);

--
-- Indices de la tabla `vehiculo_modelo`
--
ALTER TABLE `vehiculo_modelo`
  ADD PRIMARY KEY (`id_vehiculo_modelo`),
  ADD KEY `fk_vehiculo_marca_idx` (`id_vehiculo_marca`);

--
-- Indices de la tabla `vehiculo_version`
--
ALTER TABLE `vehiculo_version`
  ADD PRIMARY KEY (`id_vehiculo_version`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_cliente_idx` (`id_cliente`),
  ADD KEY `fk_usuario_idx` (`id_usuario`),
  ADD KEY `fk_empleado_idx` (`id_empleado`),
  ADD KEY `fk_venta_pago_idx` (`id_venta_pago`),
  ADD KEY `fk_venta_tipo_idx` (`id_venta_tipo`),
  ADD KEY `fk_venta_pedido` (`id_pedido`),
  ADD KEY `fk_venta_documento` (`id_venta_documento`);

--
-- Indices de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD PRIMARY KEY (`id_venta_detalle`),
  ADD KEY `fk_producto_idx` (`id_producto`),
  ADD KEY `fk_venta_idx` (`id_venta`);

--
-- Indices de la tabla `venta_documento`
--
ALTER TABLE `venta_documento`
  ADD PRIMARY KEY (`id_venta_documento`);

--
-- Indices de la tabla `venta_pago`
--
ALTER TABLE `venta_pago`
  ADD PRIMARY KEY (`id_venta_pago`);

--
-- Indices de la tabla `venta_tipo`
--
ALTER TABLE `venta_tipo`
  ADD PRIMARY KEY (`id_venta_tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `id_chat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `cliente_tipo`
--
ALTER TABLE `cliente_tipo`
  MODIFY `id_cliente_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `distrito_municipal`
--
ALTER TABLE `distrito_municipal`
  MODIFY `id_distrito_municipal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  MODIFY `id_pedido_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedido_estado`
--
ALTER TABLE `pedido_estado`
  MODIFY `id_pedido_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto_existencia`
--
ALTER TABLE `producto_existencia`
  MODIFY `id_producto_existencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto_existencia_detalle`
--
ALTER TABLE `producto_existencia_detalle`
  MODIFY `id_producto_existencia_detalle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto_marca`
--
ALTER TABLE `producto_marca`
  MODIFY `id_producto_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto_tipo`
--
ALTER TABLE `producto_tipo`
  MODIFY `id_producto_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT de la tabla `recibo`
--
ALTER TABLE `recibo`
  MODIFY `id_recibo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `id_ruta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ruta_establecida`
--
ALTER TABLE `ruta_establecida`
  MODIFY `id_ruta_establecida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ruta_establecida_lugar`
--
ALTER TABLE `ruta_establecida_lugar`
  MODIFY `id_ruta_establecida_lugar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ruta_lugar`
--
ALTER TABLE `ruta_lugar`
  MODIFY `id_ruta_lugar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `usuario_tipo`
--
ALTER TABLE `usuario_tipo`
  MODIFY `id_usuario_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario_tipo_permiso`
--
ALTER TABLE `usuario_tipo_permiso`
  MODIFY `id_usuario_tipo_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id_vehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `vehiculo_capacidad`
--
ALTER TABLE `vehiculo_capacidad`
  MODIFY `id_vehiculo_capacidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `vehiculo_estado`
--
ALTER TABLE `vehiculo_estado`
  MODIFY `id_vehiculo_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `vehiculo_marca`
--
ALTER TABLE `vehiculo_marca`
  MODIFY `id_vehiculo_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `vehiculo_modelo`
--
ALTER TABLE `vehiculo_modelo`
  MODIFY `id_vehiculo_modelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;

--
-- AUTO_INCREMENT de la tabla `vehiculo_version`
--
ALTER TABLE `vehiculo_version`
  MODIFY `id_vehiculo_version` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  MODIFY `id_venta_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `venta_documento`
--
ALTER TABLE `venta_documento`
  MODIFY `id_venta_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `venta_pago`
--
ALTER TABLE `venta_pago`
  MODIFY `id_venta_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `venta_tipo`
--
ALTER TABLE `venta_tipo`
  MODIFY `id_venta_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_mensaje_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_mensaje_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_pedido_estado` FOREIGN KEY (`id_pedido_estado`) REFERENCES `pedido_estado` (`id_pedido_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido_detalle`
--
ALTER TABLE `pedido_detalle`
  ADD CONSTRAINT `fk_pedido_detalle_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pedido_detalle_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_marca` FOREIGN KEY (`id_producto_marca`) REFERENCES `producto_marca` (`id_producto_marca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_tipo` FOREIGN KEY (`id_producto_tipo`) REFERENCES `producto_tipo` (`id_producto_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto_existencia`
--
ALTER TABLE `producto_existencia`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto_existencia_detalle`
--
ALTER TABLE `producto_existencia_detalle`
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_existencia` FOREIGN KEY (`id_producto_existencia`) REFERENCES `producto_existencia` (`id_producto_existencia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recibo`
--
ALTER TABLE `recibo`
  ADD CONSTRAINT `fk_recibo_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recibo_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_recibo_venta_pago` FOREIGN KEY (`id_venta_pago`) REFERENCES `venta_pago` (`id_venta_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD CONSTRAINT `fk_creador_ruta` FOREIGN KEY (`id_creador`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vehiculo` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculo` (`id_vehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ruta_establecida_lugar`
--
ALTER TABLE `ruta_establecida_lugar`
  ADD CONSTRAINT `fk_ruta_establecida_lugar_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ruta_establecida_lugar_ruta_establecida` FOREIGN KEY (`id_ruta_establecida`) REFERENCES `ruta_establecida` (`id_ruta_establecida`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ruta_lugar`
--
ALTER TABLE `ruta_lugar`
  ADD CONSTRAINT `fk_ruta` FOREIGN KEY (`id_ruta`) REFERENCES `ruta` (`id_ruta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ruta_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_cliente_documento` FOREIGN KEY (`id_venta_documento`) REFERENCES `venta_documento` (`id_venta_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cliente_tipo` FOREIGN KEY (`id_cliente_tipo`) REFERENCES `cliente_tipo` (`id_cliente_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_municipio` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id_municipio`),
  ADD CONSTRAINT `fk_usuario_tipo` FOREIGN KEY (`id_usuario_tipo`) REFERENCES `usuario_tipo` (`id_usuario_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_tipo_permiso`
--
ALTER TABLE `usuario_tipo_permiso`
  ADD CONSTRAINT `fk_usuario_tipo_permiso_permiso` FOREIGN KEY (`id_permiso`) REFERENCES `permiso` (`id_permiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_tipo_usuario_tipo_permiso` FOREIGN KEY (`id_usuario_tipo`) REFERENCES `usuario_tipo` (`id_usuario_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `fk_Vehiculo_modelo` FOREIGN KEY (`id_vehiculo_modelo`) REFERENCES `vehiculo_modelo` (`id_vehiculo_modelo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_creador_vehiculo` FOREIGN KEY (`id_creador`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_vehiculo_estado` FOREIGN KEY (`id_vehiculo_estado`) REFERENCES `vehiculo_estado` (`id_vehiculo_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vehiculo_version` FOREIGN KEY (`id_vehiculo_version`) REFERENCES `vehiculo_version` (`id_vehiculo_version`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vehiculo_capacidad`
--
ALTER TABLE `vehiculo_capacidad`
  ADD CONSTRAINT `fk_vehiculo_capacidad_producto_tipo` FOREIGN KEY (`id_producto_tipo`) REFERENCES `producto_tipo` (`id_producto_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_vehiculo_capacidad_vehiculo` FOREIGN KEY (`id_vehiculo`) REFERENCES `vehiculo` (`id_vehiculo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vehiculo_modelo`
--
ALTER TABLE `vehiculo_modelo`
  ADD CONSTRAINT `fk_vehiculo_marca` FOREIGN KEY (`id_vehiculo_marca`) REFERENCES `vehiculo_marca` (`id_vehiculo_marca`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_documento` FOREIGN KEY (`id_venta_documento`) REFERENCES `venta_documento` (`id_venta_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_venta_pago` FOREIGN KEY (`id_venta_pago`) REFERENCES `venta_pago` (`id_venta_pago`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_venta_tipo` FOREIGN KEY (`id_venta_tipo`) REFERENCES `venta_tipo` (`id_venta_tipo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta_detalle`
--
ALTER TABLE `venta_detalle`
  ADD CONSTRAINT `fk_venta_detalle_producto` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_detalle_venta` FOREIGN KEY (`id_venta`) REFERENCES `venta` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
