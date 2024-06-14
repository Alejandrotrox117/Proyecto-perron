-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2024 a las 13:07:53
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_celtech`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoriaId` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL,
  `portada` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoriaId`, `nombre`, `descripcion`, `creado`, `estado`, `portada`) VALUES
(2, 'Apple Watch', 'Relojes', '2024-06-05 16:39:49', 1, 'img_dfbec9ff174f8b583c1be3d4f0d7b1b0.jpg'),
(3, 'Accesorios', 'Accesorios iPhone', '2024-06-05 16:40:54', 1, 'img_352b1641a12b21e5ec9fe631c6539d3b.jpg'),
(4, 'MacBooks', 'Laptop Apple', '2024-06-07 16:27:03', 1, 'img_dfeadec172c159438261dd3af13eaa8b.jpg'),
(11, 'Telefonos', 'Telefonos iPhone', '2024-06-06 19:26:25', 1, 'img_8c8108a8a6f8d98582fe91b0ae8392ae.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `imagenId` int(15) NOT NULL,
  `productosId` int(15) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `moduloId` int(15) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `pagoId` int(15) NOT NULL,
  `solicitudId` int(15) NOT NULL,
  `referencia` int(30) NOT NULL,
  `monto` decimal(11,2) NOT NULL,
  `nombretitular` varchar(80) NOT NULL,
  `cedulatitular` varchar(30) NOT NULL,
  `telefonotitular` varchar(30) NOT NULL,
  `nombrebanco` varchar(30) NOT NULL,
  `tipoPago` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `permisoId` int(15) NOT NULL,
  `rolId` int(15) NOT NULL,
  `moduloId` int(15) NOT NULL,
  `lectura` tinyint(1) NOT NULL DEFAULT 0,
  `escritura` tinyint(1) NOT NULL DEFAULT 0,
  `actualizar` tinyint(1) DEFAULT 0,
  `eliminar` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `identificacion` varchar(20) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `telefono` int(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `rolId` int(15) NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `productosId` int(15) NOT NULL,
  `categoriaId` int(100) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `stock` int(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`productosId`, `categoriaId`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`, `creado`, `estado`) VALUES
(4, 2, 'iphonexr', 'maxima calidad', '1600.00', 2, '', '0000-00-00 00:00:00', 1),
(16, 11, 'iPhone 15 PRO MAX', '<table style=\"border-collapse: collapse; width: 100%;\" border=\"1\">\r\n<tbody>\r\n<tr>\r\n<td style=\"width: 31.2951%;\">hOL</td>\r\n<td style=\"width: 31.2951%;\">A</td>\r\n<td style=\"width: 31.2996%;\">A</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<ul>\r\n<li>Caracteristicas:<br /><br /></li>\r\n<li>s</li>\r\n<li>s</li>\r\n<li>s</li>\r\n<li>s</li>\r\n<li>s</li>\r\n</ul>', '1000.00', 1, '', '2024-06-13 22:42:25', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(15) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `descripcion` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `nombre`, `estatus`, `descripcion`) VALUES
(1, 'admin', 1, 'Rol de administrador'),
(2, 'Encargado', 1, 'Rol'),
(3, 'Empleado', 1, 'Rol de empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id` int(15) NOT NULL,
  `productoid` int(15) NOT NULL,
  `identificacion` varchar(20) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(15) NOT NULL,
  `identificacion` varchar(20) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `toke` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `ventaId` int(15) NOT NULL,
  `identificacion` varchar(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `monto` decimal(11,2) NOT NULL,
  `pagoId` int(15) NOT NULL,
  `solicitudId` int(15) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoriaId`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`imagenId`),
  ADD KEY `productosId` (`productosId`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`moduloId`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`pagoId`),
  ADD KEY `solicitudId` (`solicitudId`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`permisoId`),
  ADD KEY `rolId` (`rolId`),
  ADD KEY `moduloId` (`moduloId`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`identificacion`),
  ADD KEY `rolId` (`rolId`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`productosId`),
  ADD KEY `categoriaId` (`categoriaId`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productoid` (`productoid`),
  ADD KEY `identificacion` (`identificacion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `identificacion` (`identificacion`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`ventaId`),
  ADD KEY `personaId` (`identificacion`),
  ADD KEY `pagoId` (`pagoId`),
  ADD KEY `solicitudId` (`solicitudId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoriaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `imagenId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `moduloId` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `pagoId` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `permisoId` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `productosId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `ventaId` int(15) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`productosId`) REFERENCES `productos` (`productosId`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`solicitudId`) REFERENCES `solicitud` (`id`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`moduloId`) REFERENCES `modulo` (`moduloId`),
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`rolId`) REFERENCES `rol` (`rol_id`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`rolId`) REFERENCES `rol` (`rol_id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`categoriaId`) REFERENCES `categoria` (`categoriaId`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`productoid`) REFERENCES `productos` (`productosId`),
  ADD CONSTRAINT `solicitud_ibfk_3` FOREIGN KEY (`identificacion`) REFERENCES `persona` (`identificacion`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`identificacion`) REFERENCES `persona` (`identificacion`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`identificacion`) REFERENCES `persona` (`identificacion`),
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`pagoId`) REFERENCES `pagos` (`pagoId`),
  ADD CONSTRAINT `venta_ibfk_3` FOREIGN KEY (`solicitudId`) REFERENCES `solicitud` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
