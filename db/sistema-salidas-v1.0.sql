-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-07-2026 a las 23:58:51
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
(1, 'ENCARGADO DE SISTEMAS Y ASISTENTE DE ACTIVOS FIJOS ', 1),
(2, 'ANAANANAN', 1),
(3, 'BBBBBSKDASJDAKJ', 1),
(4, 'LLLL', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `id_contrato` int(11) NOT NULL,
  `sigla` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`id_contrato`, `sigla`, `nombre`, `estado`) VALUES
(1, 'ITEM-', 'PERSONAL CON ITEM', 1);

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
(1, 1, 15),
(2, 2, 15),
(4, 3, 15),
(5, 3, 18),
(7, 4, 15),
(8, 4, 18),
(9, 5, 15),
(10, 5, 18);

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
(15, 'Salidas', 1),
(16, 'Cargos', 1),
(17, 'Unidades', 1),
(18, 'Vacaciones', 1);

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
(1, 'ERERE', 'DRERER', 'TRANSPORTE PÚBLICO', '2026-07-13', '14:45:00', '2026-07-13', '18:05:00', 2, 1, 1, '2026-07-13 18:46:05'),
(2, 'Para colocar la firma digital (imagen) del Servidor Público exactamente sobre su línea de firma correspondiente, debemos calcular dinámicamente las coordenadas del eje $X$ e $Y$.', 'wqeqe', 'VEHÍCULO PROPIO', '2026-07-13', '18:03:00', '2026-07-13', '18:05:00', 2, 4, 1, '2026-07-13 22:03:49');

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
(1, 'ADMINISTRACION', 1),
(2, 'ANANAN', 1),
(3, 'BBABSDBABDB', 1),
(4, 'LLL', 1);

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
  `clave` varchar(250) NOT NULL,
  `firma` varchar(250) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `ci`, `nombres`, `apellidos`, `celular`, `id_cargo`, `id_unidad`, `clave`, `firma`, `estado`, `fecha_creacion`) VALUES
(1, '123', 'ELISEO', 'CANAVIRI', 8787877, 1, 1, '2a4c907c8bcc582969efe847d52e9ff6364704f6b1fc1bdf5fb381e9ae8fee6d', 'rrhh.png', 1, '2026-07-13 18:30:05'),
(2, '8581', 'ANA', 'ANA', 354534, 2, 2, '169f71f5b705cb70aef60c45c13354f1b29abad5008d240e256f067daec5cfd8', '', 1, '2026-07-13 18:33:40'),
(3, '555', 'BBBB', 'BBBB', 87788787, 3, 3, '48ce4390de60d143928c60d718f793ceed85ddd18b39b2a8e5db9c685683558c', '', 1, '2026-07-13 18:34:27'),
(4, '111', 'GGGG', 'GGGG', 3242342, 1, 1, '87849188d7dcbb7b585ccf9104fe23e5e752d92bcf5921ade3c4fb09c70be827', 'fir.png', 1, '2026-07-13 19:08:57'),
(5, '333', 'LLLL', 'LLLL', 3242342, 4, 4, 'd077df64d293b2de5af7a1e0ab4d975dc05fd0a822c7d0fb9ace575328d3aecb', '', 1, '2026-07-14 01:54:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--

CREATE TABLE `vacaciones` (
  `id_vacacion` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_inicio` varchar(200) NOT NULL,
  `fecha_fin` varchar(200) NOT NULL,
  `dias` varchar(200) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `fecha_actual` date NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vacaciones`
--

INSERT INTO `vacaciones` (`id_vacacion`, `id_usuario`, `fecha_inicio`, `fecha_fin`, `dias`, `descripcion`, `fecha_actual`, `estado`) VALUES
(1, 1, '2026-07-09', '2026-07-08', '2', 'sds', '2026-07-13', 2),
(2, 4, '2026-07-13', '2026-07-24', '10', 'sdfsfsdfsdfs', '2026-07-13', 1),
(3, 4, '2026-07-13', '2026-07-17', '5', 'sadasdasd', '2026-07-13', 1),
(4, 4, '2026-07-13', '2026-07-20', '6', 'sadsada', '2026-07-13', 0),
(5, 5, '2026-07-13', '2026-07-24', '10', 'awdasd', '2026-07-13', 2),
(6, 4, '2026-07-14', '2026-07-15', '2', 'DSADASDA', '2026-07-14', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id_contrato`);

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
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`id_vacacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id_contrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `salidas`
--
ALTER TABLE `salidas`
  MODIFY `id_salida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id_unidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `id_vacacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD CONSTRAINT `detalle_permisos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `detalle_permisos_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
