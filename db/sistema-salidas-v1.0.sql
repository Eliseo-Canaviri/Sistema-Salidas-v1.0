-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2026 a las 04:21:30
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
-- Base de datos: `sistema-salidas-v1.0`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anotes`
--

CREATE TABLE `anotes` (
  `id_anote` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha_actual` date NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `anotes`
--

INSERT INTO `anotes` (`id_anote`, `titulo`, `descripcion`, `fecha_actual`, `estado`) VALUES
(1, 'rrr', 'rrrr', '2026-04-14', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `nombre`, `estado`) VALUES
(1, 'Responsable de Sistemas', 1),
(2, 'Psicologa', 1),
(3, 'Cargos', 1),
(4, 'LLLLLLL', 1),
(5, 'LLLLLLL', 1),
(6, 'BBBBB', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `choferes`
--

CREATE TABLE `choferes` (
  `id_chofer` int(11) NOT NULL,
  `nlicencia` varchar(100) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `choferes`
--

INSERT INTO `choferes` (`id_chofer`, `nlicencia`, `nombres`, `categoria`, `estado`) VALUES
(1, '3546456', 'Raul Mamani Lopez', 'P', 1),
(2, '4356464', 'Jose Ayaviri Anan', 'A', 1),
(3, '464564', 'hhhhhhhhhh', 'B', 1),
(4, '567567575', 'MVBNVNVBNVBNVB', 'P', 1),
(5, '3253453', 'ELISEO CANAVIRI JACA', 'M', 1),
(6, '123', 'S/N', 'P', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_permisos`
--

CREATE TABLE `detalle_permisos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_permisos`
--

INSERT INTO `detalle_permisos` (`id`, `id_usuario`, `id_permiso`) VALUES
(52, 4, 15),
(53, 3, 15),
(54, 2, 15),
(55, 5, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE `egresos` (
  `id_egreso` int(11) NOT NULL,
  `gasto` decimal(10,2) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha_actual` datetime NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `egresos`
--

INSERT INTO `egresos` (`id_egreso`, `gasto`, `descripcion`, `fecha_actual`, `id_usuario`, `estado`) VALUES
(1, 50.00, 'Ropa', '2024-04-03 21:09:44', 1, 1),
(8, 25.00, 'Medias', '2024-04-03 21:20:39', 2, 1),
(9, 85.00, 'Zapato', '2024-04-03 21:21:11', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `mensaje` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `nombre`, `telefono`, `direccion`, `mensaje`) VALUES
(1, 'Ingeniería Informática ', '72737903', 'Llallagua-Potosi ', '4 de Julio!!!\r\nSalud...');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id_ingreso` int(11) NOT NULL,
  `ingreso` decimal(10,2) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fecha_actual` datetime NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id_ingreso`, `ingreso`, `descripcion`, `fecha_actual`, `id_usuario`, `estado`) VALUES
(2, 1000.00, 'Sueldo', '2024-04-03 21:14:26', 1, 1),
(3, 2000.00, 'Sueldo Abril', '2024-04-03 21:14:26', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `permiso` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `permiso`, `estado`) VALUES
(10, 'Usuarios', 1),
(11, 'Ingresos', 1),
(12, 'Egresos', 1),
(13, 'Anotes', 1),
(15, 'Salidas', 1),
(16, 'Cargos', 1),
(17, 'Unidades', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salidas`
--

CREATE TABLE `salidas` (
  `id_salida` int(11) NOT NULL,
  `actividad` text NOT NULL,
  `lugar` varchar(255) NOT NULL,
  `transporte` varchar(100) DEFAULT NULL,
  `fecha_salida` date NOT NULL,
  `hora_salida` time NOT NULL,
  `fecha_llegada` date NOT NULL,
  `hora_llegada` time NOT NULL,
  `id_chofer` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` int(11) DEFAULT 1,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `salidas`
--

INSERT INTO `salidas` (`id_salida`, `actividad`, `lugar`, `transporte`, `fecha_salida`, `hora_salida`, `fecha_llegada`, `hora_llegada`, `id_chofer`, `id_usuario`, `estado`, `fecha_registro`) VALUES
(1, 'Para que la tabla tenga un aspecto más moderno y profesional en TCPDF, puedes usar colores suaves, bordes más finos, encabezados altos y un estilo tipo \"dashboard\".', 'hhhhh', 'Otro', '2026-05-28', '02:52:00', '0000-00-00', '02:53:00', 1, 1, 1, '2026-05-29 02:48:25'),
(2, 'ggggg', 'kkkk', 'Vehículo Institucional', '2026-05-29', '02:21:00', '0000-00-00', '01:21:00', 2, 1, 0, '2026-05-30 01:21:19'),
(3, 'kkkkk', 'lllll', 'Vehículo Institucional', '2026-06-05', '02:27:00', '0000-00-00', '03:27:00', 1, 3, 0, '2026-05-30 01:27:31'),
(4, 'nnnnnnn', 'dgdfgd', 'A pie', '2026-05-29', '03:06:00', '0000-00-00', '03:06:00', 2, 3, 1, '2026-05-30 02:06:56'),
(5, 'reterter', 'etwerwerwe', 'Transporte Público', '2026-05-30', '14:39:00', '0000-00-00', '14:40:00', 1, 5, 1, '2026-05-30 18:34:09'),
(6, 'ewrwerwer', 'ewrwerew', 'Transporte Público', '2026-05-09', '17:51:00', '0000-00-00', '18:50:00', 3, 1, 1, '2026-05-31 19:52:07'),
(7, 'Reunio', 'Khari', 'Vehículo Institucional', '2026-05-31', '17:09:00', '2026-05-31', '15:00:00', 2, 1, 1, '2026-05-31 21:11:53'),
(8, 'fsdfsd', 'sdfsdf', 'Otro', '2026-05-31', '19:00:00', '2026-05-31', '00:00:00', 6, 1, 1, '2026-05-31 23:05:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades`
--

CREATE TABLE `unidades` (
  `id_unidad` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidades`
--

INSERT INTO `unidades` (`id_unidad`, `nombre`, `estado`) VALUES
(1, 'Tecnicaaaa', 1),
(2, 'Administracion', 1),
(3, 'SLIM', 1),
(4, 'Asesoria', 1),
(5, 'Consejo', 1),
(6, 'Activos', 1),
(7, 'LLLLLL', 1),
(8, 'LLLLLL', 1),
(9, 'BBBBB', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `ci` varchar(100) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `celular` int(11) NOT NULL,
  `id_cargo` int(100) NOT NULL,
  `id_unidad` int(11) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `ci`, `nombres`, `apellidos`, `celular`, `id_cargo`, `id_unidad`, `clave`, `estado`, `fecha_creacion`) VALUES
(1, '123', 'Eliseo', 'Canaviri Jachacata', 123, 1, 1, '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, '2026-05-28 03:46:16'),
(2, '1011', 'Usuario', 'tre', 34534543, 1, 1, '04f8996da763b7a969b1028ee3007569eaf3a635486ddab211d512c85b9df8fb', 1, '2026-05-28 03:46:16'),
(3, '456', 'Ana Maria', 'Condori', 564564, 2, 2, '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, '2026-05-29 01:54:00'),
(4, '8787', 'tttt', 'tttt', 43534534, 3, 1, '741966aa7cddc343ce41a444bc9b94bf5db87fc842643082165d8659c07b36ff', 1, '2026-05-29 02:05:32'),
(5, '8581', 'Eliseo', 'Canaviri', 243252, 3, 1, '999a2e5b9924f16e831cc7bd57c40d0c4f7f03cd48491e7dfd1320d974fa4770', 1, '2026-05-30 18:32:24'),
(6, '2353453', 'sdfsdf', 'sdfsdfs', 32542342, 1, 4, '1021ed7a21346d58a0db74d4698e296023fc6e59a15c047149e0d2321687a986', 1, '2026-05-30 21:18:39'),
(7, '12345', 'hfghfg', 'fghfghfg', 543545, 2, 2, 'db9bed9040cd24a82f069bdb8a5e7ec8690a73ad1ef019daffa2c1b3e15eb2c5', 1, '2026-05-30 21:32:48'),
(8, '1011-1H', 'ana', 'ana', 6734737, 3, 3, 'c90c6507979ae18dc3968bb4689ef2528439df3f6ed77dbf211cdd18ef2d9751', 1, '2026-05-30 21:38:14'),
(9, '1010', 'AAAAA', 'BBBBB', 32423423, 2, 2, 'e605968d9952153871361a7f00785805340b7c9e371244618a117293849f9a9a', 1, '2026-06-01 00:29:05'),
(10, '1111', 'EEEE', 'RRRR', 4654654, 3, 6, 'df61f26b1b13b48aa362003286540e8611ecf321e7adad72c327708ce34df942', 1, '2026-06-01 00:29:55'),
(11, '24234', 'SDFSDF', 'SDFSDF', 534534, 2, 2, 'e66035e6c8508fd67fe770c14bfd486d0abd20010f5acb4d8eac17d82d51ec62', 1, '2026-06-01 00:37:18'),
(12, '3543534', 'DFSDFSD', 'SDFSDFSD', 3254352, 2, 1, '3c9755695d6d087077abaaf451609c34113334100d65d0ea870d107182363ddc', 1, '2026-06-01 00:39:18'),
(13, '325435', 'SDSDFSD', 'SDFSDF', 34534534, 1, 3, 'a25f9e83a416874c7d8818ea7f93063601bbafe55bb1a5c4d4bcf45f3ad9adb9', 1, '2026-06-01 00:40:09'),
(14, '35345', 'SDFSDFSD', 'SDFSDF', 334534, 3, 4, '6275479675afa7bf108e98daca04e65ebb81272669809a009a20c85b8cd80d63', 1, '2026-06-01 00:40:33'),
(15, '10101', 'SDFSD', 'SDFSDF', 34534563, 2, 2, 'e088a70d789f15a021872efe39d29ed54c7c621c33d29979cdefa942cc90f291', 1, '2026-06-01 00:43:38'),
(16, '54353', 'ASDASDSA', 'ASDSADA', 435343, 1, 5, '54684dbb1748c27e9bc24f5060527a4f807e1b699125f8d3d83138aa39919bf4', 1, '2026-06-01 00:50:11'),
(17, '3543', 'SDFSDF', 'SDFSDFSD', 324324, 2, 5, '33b927b5810af137b514505fb263a6a90c7f62a0cc848a53a764fb63696a59d3', 1, '2026-06-01 00:51:42'),
(18, '345345', 'WERWE', 'EWRWER', 435345, 2, 5, '892dc7cd5630f55fa151db6faeeff11d263d729a4e79e7dc539ea752417e4142', 1, '2026-06-01 00:52:10'),
(19, '354234523', 'ASDFASDA', 'ASDASD', 324234, 2, 4, 'ee4e9cc5dd97dd0e24dc48a5cb671e3a8a2431756cfacc162126f82ff7058c31', 1, '2026-06-01 00:54:14'),
(20, '3453453', 'SDFSDF', 'SDFSDFS', 34534534, 2, 5, '8ec50cba412bd71c17d1f7f09e7c848e75d9761cdf736495a4d6909969d4d497', 1, '2026-06-01 00:55:23'),
(21, '34234', 'SDFSDF', 'SDFSDFS', 234234, 2, 4, '9acb0e0b927f488be486aed9b04ac710dfcd20ff0ce34a56a0369a4107ae10c7', 1, '2026-06-01 00:58:25'),
(22, '324234', 'SDAA', 'SDASDAS', 34234, 2, 5, '7950bc82ceab34d41d192cef866b11a2c0deed01c4339052e36fcbbdf1110b78', 1, '2026-06-01 00:59:58'),
(23, '353453', 'ADASDAS', 'ASDASDSA', 3242342, 2, 4, '69d781aa140491718513d9f99eedc3d3fc8be6fe8f520bf26aa5ca0649276395', 1, '2026-06-01 01:04:57'),
(24, '5465464', 'LLLLLLL', 'LLLLLLL', 2147483647, 5, 8, '34dcdfbaea01be697590b811f097e53bd8b753a38df875bd0a366a9fc7e5a6ad', 1, '2026-06-01 02:02:37'),
(25, '1231231', 'BBBBBB', 'BBBBBB', 3432423, 6, 9, 'cedb713fca24645c90d43f4856a7a48ab46e2d4b57050bdaa65cea4fa7b3e67b', 1, '2026-06-01 02:03:15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anotes`
--
ALTER TABLE `anotes`
  ADD PRIMARY KEY (`id_anote`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `choferes`
--
ALTER TABLE `choferes`
  ADD PRIMARY KEY (`id_chofer`);

--
-- Indices de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_usuario` (`id`,`id_usuario`),
  ADD UNIQUE KEY `id_permiso` (`id`,`id_permiso`),
  ADD KEY `id_usuario_2` (`id_usuario`),
  ADD KEY `id_permiso_2` (`id_permiso`);

--
-- Indices de la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id_egreso`),
  ADD KEY `id` (`id_usuario`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id_ingreso`),
  ADD KEY `id` (`id_usuario`) USING BTREE;

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `salidas`
--
ALTER TABLE `salidas`
  ADD PRIMARY KEY (`id_salida`);

--
-- Indices de la tabla `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id_unidad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anotes`
--
ALTER TABLE `anotes`
  MODIFY `id_anote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `choferes`
--
ALTER TABLE `choferes`
  MODIFY `id_chofer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id_egreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id_unidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD CONSTRAINT `detalle_permisos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `detalle_permisos_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`);

--
-- Filtros para la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD CONSTRAINT `egresos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
