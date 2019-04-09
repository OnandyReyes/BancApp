-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-04-2019 a las 21:48:14
-- Versión del servidor: 10.1.34-MariaDB
-- Versión de PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bancapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `id_configuracion` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas`
--

CREATE TABLE `cuentas` (
  `id_cuenta` int(11) NOT NULL,
  `usuario` varchar(150) NOT NULL,
  `clave` varchar(150) NOT NULL,
  `id_cuenta_tipo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `titulo_ticket` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuentas_tipos`
--

CREATE TABLE `cuentas_tipos` (
  `id_cuenta_tipo` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `id_dia` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias_festivos`
--

CREATE TABLE `dias_festivos` (
  `id_dia_festivo` int(11) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `cerrar` tinyint(1) NOT NULL,
  `fecha` datetime NOT NULL,
  `hora_apertura` int(11) NOT NULL,
  `hora_cierre` int(11) NOT NULL,
  `minuto_apertura` int(11) NOT NULL,
  `minuto_cierre` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_loteria_sub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id_grupo` int(11) NOT NULL,
  `nombre` int(11) NOT NULL,
  `id_lider` int(11) NOT NULL,
  `porciento` decimal(16,2) NOT NULL,
  `id_creador` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos_usuarios`
--

CREATE TABLE `grupos_usuarios` (
  `id_grupo_usuario` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_creador` int(11) NOT NULL,
  `porciento` decimal(16,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loterias`
--

CREATE TABLE `loterias` (
  `id_loteria` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `imagen` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loterias_sub`
--

CREATE TABLE `loterias_sub` (
  `id_loteria_sub` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `imagen` varchar(500) NOT NULL,
  `id_loteria` int(11) NOT NULL,
  `id_creador` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_loteria_sub_sorteo` int(11) NOT NULL,
  `siglas` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loterias_sub_horarios`
--

CREATE TABLE `loterias_sub_horarios` (
  `id_loteria_sub_horario` int(11) NOT NULL,
  `id_loteria_sub` int(11) NOT NULL,
  `hora_apertura` int(11) NOT NULL,
  `hora_cierre` int(11) NOT NULL,
  `minuto_apertura` int(11) NOT NULL,
  `minuto_cierre` int(11) NOT NULL,
  `id_dia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `loterias_sub_sorteos`
--

CREATE TABLE `loterias_sub_sorteos` (
  `id_loteria_sub_sorteo` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `sorteo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `id_provincia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`id_municipio`, `nombre`, `id_provincia`) VALUES
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
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id_provincia` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id_provincia`, `nombre`) VALUES
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
-- Estructura de tabla para la tabla `sectores`
--

CREATE TABLE `sectores` (
  `id_sector` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `id_municipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sectores`
--

INSERT INTO `sectores` (`id_sector`, `nombre`, `id_municipio`) VALUES
(1, 'Gualey', 52),
(2, 'Barrio Lindo', 52),
(3, 'Puerto Rico', 52),
(4, 'Guama', 52),
(5, 'Ondina', 52),
(6, 'La China', 52),
(7, 'Las Mercedes', 52),
(8, 'Sabana de los Moruno', 52),
(9, 'Los Barriola', 52),
(10, 'Galindo', 52),
(11, 'El Centro', 52),
(12, 'Las Guamas', 52),
(13, 'Galindo', 52),
(14, 'El mercado', 52),
(17, 'las javillas', 52),
(21, 'La loma de Punta de garza', 52),
(22, 'Frente al Cementerio', 52),
(23, 'Puerto Rico', 52),
(24, 'Punta de Garza', 52),
(25, 'Los Genao', 52),
(26, 'Salida la matica', 52),
(27, 'Los Rondon', 52),
(28, 'El millon', 52),
(29, 'Villa Canto', 52),
(31, 'Plata bella', 52),
(32, 'Salida SPM', 52),
(33, 'Los Polancos', 52),
(34, 'Las Malvinas', 52),
(35, 'Los Multis de Sabana', 52),
(36, 'Villa Canto', 52),
(37, 'Barrio Villa Vilorio', 52),
(51, 'Barrio Villa Ortega', 52),
(52, 'Barrio Las Malvinas', 52),
(53, 'Barrio Villa Navarro', 52),
(54, 'Barrio Las Chinas', 52),
(55, 'Barrio de Puchy', 52),
(56, 'Barrio Los Maestros', 52),
(57, 'Barrio Los Maestros', 52),
(58, 'Salida Seibo', 52),
(59, 'Carretera Hato Mayor - Llerva Buena', 52),
(60, 'Palungo', 52),
(61, 'Carretera Hato Mayor -San pedo', 52),
(62, 'Carretera Hato Mayor -San pedo', 52),
(63, 'Barrio Lindo', 52),
(64, 'Los Polanco San Pedro', 52),
(65, '', 52),
(66, '', 52),
(67, '', 52),
(68, 'El centro', 52),
(69, 'Mercado', 52),
(70, 'Salida Spm', 52),
(71, 'Los barriola', 52),
(72, 'Multis Spm', 52),
(73, 'Los Barriola', 52),
(74, 'Barrio Puerto Rico', 52),
(75, 'pedro guillermo 41', 2),
(76, 'detras de centro arena', 2),
(77, '27 de febrero 115', 2),
(78, '27 de febrero 115', 52),
(79, 'felipe de castro 32', 52),
(80, 'calle duarte', 52),
(81, 'Villa Canto', 52),
(82, 'gualey', 2),
(83, 'Detras de centro Arena', 52),
(84, 'Mercedes', 52),
(85, 'Carretera Sabana', 52),
(86, 'Carretera Hato Mayor - Yerba Buena', 52),
(87, 'Vista verde', 52),
(88, 'Carretera Hato Mayor Vicentillo', 52),
(89, 'Carretera Hato Mayor Vicentillo', 52),
(90, 'Carretera Hato Mayor Vicentillo', 52),
(91, 'Carretera Hato Mayor Vicentillo', 52),
(92, 'Carretera Hato Mayor Vicentillo', 52),
(93, 'Carretera Hato Mayor Vicentillo', 52),
(94, 'Carretera Hato Mayor Vicentillo', 52),
(95, 'Carretera Hato Mayor Vicentillo', 52),
(96, 'Carretera Hato Mayor Vicentillo', 52),
(97, 'Carretera Hato Mayor Vicentillo', 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id_ticket` int(11) NOT NULL,
  `serial` varchar(250) NOT NULL,
  `fecha_creacion` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `anular` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id_ticket`, `serial`, `fecha_creacion`, `id_usuario`, `anular`) VALUES
(45000, '01010101', '2019-04-05 00:00:00', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets_detalles`
--

CREATE TABLE `tickets_detalles` (
  `id_ticket_detalle` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `numero2` int(11) DEFAULT NULL,
  `numero3` int(11) DEFAULT NULL,
  `monto` decimal(16,2) NOT NULL,
  `id_loteria_sub` int(11) NOT NULL,
  `sorteo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tickets_detalles`
--

INSERT INTO `tickets_detalles` (`id_ticket_detalle`, `id_ticket`, `numero`, `numero2`, `numero3`, `monto`, `id_loteria_sub`, `sorteo`) VALUES
(1, 45000, 1, 0, 0, '10.00', 1, 3500);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(500) NOT NULL,
  `apellidos` varchar(500) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `cedula` varchar(50) NOT NULL,
  `id_sector` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `direccion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id_configuracion`);

--
-- Indices de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  ADD PRIMARY KEY (`id_cuenta`);

--
-- Indices de la tabla `cuentas_tipos`
--
ALTER TABLE `cuentas_tipos`
  ADD PRIMARY KEY (`id_cuenta_tipo`);

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`id_dia`);

--
-- Indices de la tabla `dias_festivos`
--
ALTER TABLE `dias_festivos`
  ADD PRIMARY KEY (`id_dia_festivo`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `grupos_usuarios`
--
ALTER TABLE `grupos_usuarios`
  ADD PRIMARY KEY (`id_grupo_usuario`);

--
-- Indices de la tabla `loterias`
--
ALTER TABLE `loterias`
  ADD PRIMARY KEY (`id_loteria`);

--
-- Indices de la tabla `loterias_sub`
--
ALTER TABLE `loterias_sub`
  ADD PRIMARY KEY (`id_loteria_sub`);

--
-- Indices de la tabla `loterias_sub_horarios`
--
ALTER TABLE `loterias_sub_horarios`
  ADD PRIMARY KEY (`id_loteria_sub_horario`);

--
-- Indices de la tabla `loterias_sub_sorteos`
--
ALTER TABLE `loterias_sub_sorteos`
  ADD PRIMARY KEY (`id_loteria_sub_sorteo`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_municipio`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id_provincia`);

--
-- Indices de la tabla `sectores`
--
ALTER TABLE `sectores`
  ADD PRIMARY KEY (`id_sector`),
  ADD KEY `fk_sector_municipio` (`id_municipio`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_ticket`);

--
-- Indices de la tabla `tickets_detalles`
--
ALTER TABLE `tickets_detalles`
  ADD PRIMARY KEY (`id_ticket_detalle`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id_configuracion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas`
--
ALTER TABLE `cuentas`
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuentas_tipos`
--
ALTER TABLE `cuentas_tipos`
  MODIFY `id_cuenta_tipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `id_dia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `dias_festivos`
--
ALTER TABLE `dias_festivos`
  MODIFY `id_dia_festivo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupos_usuarios`
--
ALTER TABLE `grupos_usuarios`
  MODIFY `id_grupo_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `loterias`
--
ALTER TABLE `loterias`
  MODIFY `id_loteria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `loterias_sub`
--
ALTER TABLE `loterias_sub`
  MODIFY `id_loteria_sub` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `loterias_sub_horarios`
--
ALTER TABLE `loterias_sub_horarios`
  MODIFY `id_loteria_sub_horario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `loterias_sub_sorteos`
--
ALTER TABLE `loterias_sub_sorteos`
  MODIFY `id_loteria_sub_sorteo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT de la tabla `sectores`
--
ALTER TABLE `sectores`
  MODIFY `id_sector` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_ticket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45001;

--
-- AUTO_INCREMENT de la tabla `tickets_detalles`
--
ALTER TABLE `tickets_detalles`
  MODIFY `id_ticket_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
