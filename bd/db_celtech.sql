-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-06-2024 a las 15:21:15
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
-- Base de datos: `db_celtech`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `registrarProducto` (IN `categoriaId` INT, IN `nombre` VARCHAR(100), IN `descripcion` TEXT, IN `especificacionesId` INT, IN `precio` DECIMAL(10,2), IN `stock` INT, IN `creado` DATE, IN `estado` VARCHAR(20))   BEGIN
  INSERT INTO producto (categoriaId, nombre, descripcion, especificacionesId, precio, stock, creado, estado)
  VALUES (categoriaId, nombre, descripcion, especificacionesId, precio, stock, creado, estado);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoriaId` int(15) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` bit(1) NOT NULL,
  `portada` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoriaId`, `nombre`, `descripcion`, `creado`, `estado`, `portada`) VALUES
(2, 'Relojes inteligentes', 'Relojes', '2024-06-05 16:39:49', b'1', 'img_dfbec9ff174f8b583c1be3d4f0d7b1b0.jpg'),
(3, 'Accesorios', 'Accesorios iPhone', '2024-06-05 16:40:54', b'1', 'img_352b1641a12b21e5ec9fe631c6539d3b.jpg'),
(4, 'MacBooks', 'Laptop Apple', '2024-06-07 16:27:03', b'1', 'img_dfeadec172c159438261dd3af13eaa8b.jpg'),
(11, 'Telefonos', 'Telefonos iPhone', '2024-06-06 19:26:25', b'1', 'img_8c8108a8a6f8d98582fe91b0ae8392ae.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especificacionesdispositivo`
--

CREATE TABLE `especificacionesdispositivo` (
  `especificacionesId` int(15) NOT NULL,
  `productoId` int(15) NOT NULL,
  `color` varchar(30) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `IMEI` text NOT NULL,
  `capacidad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especificacionesdispositivo`
--

INSERT INTO `especificacionesdispositivo` (`especificacionesId`, `productoId`, `color`, `marca`, `IMEI`, `capacidad`) VALUES
(2, 4, 'Rojo', 'Iphone', '1232132131241232142', '256gb');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `facturaId` int(15) NOT NULL,
  `personaId` int(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `monto` decimal(11,2) NOT NULL,
  `pagoId` int(15) NOT NULL,
  `solicitudId` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `imagenId` int(15) NOT NULL,
  `productoId` int(15) NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`imagenId`, `productoId`, `imagen`) VALUES
(16, 4, 'producto_653d11aa2274dcd56f3745490e319d2b.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `moduloId` int(15) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`moduloId`, `titulo`, `descripcion`, `estado`) VALUES
(1, 'Dashboard', 'Modulo de inicio', b'1'),
(2, 'Productos', 'Modulo Productos', b'1'),
(3, 'Categorias', 'Modulo categorias', b'1'),
(4, 'Roles', 'Modulo de los roles', b'1'),
(5, 'Solicitudes', 'Modulo de solicitudes', b'1'),
(6, 'Pagos', 'Modulo de pagos', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `pagoId` int(15) NOT NULL,
  `solicitudId` int(15) NOT NULL,
  `tipoPagoId` int(15) NOT NULL,
  `referencia` int(30) NOT NULL,
  `monto` decimal(11,2) NOT NULL,
  `nombretitular` varchar(80) NOT NULL,
  `cedulatitular` varchar(30) NOT NULL,
  `telefonotitular` varchar(30) NOT NULL,
  `nombrebanco` varchar(30) NOT NULL,
  `fechaPago` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `permisoId` int(15) NOT NULL,
  `rolId` int(15) NOT NULL,
  `moduloId` int(15) NOT NULL,
  `lectura` bit(1) NOT NULL DEFAULT b'0',
  `escritura` bit(1) NOT NULL DEFAULT b'0',
  `actualizar` bit(1) DEFAULT b'0',
  `eliminar` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`permisoId`, `rolId`, `moduloId`, `lectura`, `escritura`, `actualizar`, `eliminar`) VALUES
(1, 1, 1, b'1', b'1', b'1', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `personaId` int(20) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `telefono` int(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `rolId` int(15) NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`personaId`, `nombres`, `apellidos`, `telefono`, `email`, `direccion`, `rolId`, `creado`, `estado`) VALUES
(1, 'Richard', 'Gil', 2147483647, 'gilalejandro926@gmail.com', 'Caldera', 1, '2024-06-18 21:36:51', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `productoId` int(15) NOT NULL,
  `categoriaId` int(100) NOT NULL,
  `nombre` varchar(80) NOT NULL,
  `descripcion` text NOT NULL,
  `especificacionesId` int(15) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int(100) NOT NULL,
  `creado` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`productoId`, `categoriaId`, `nombre`, `descripcion`, `especificacionesId`, `precio`, `cantidad`, `creado`, `estado`) VALUES
(4, 2, 'iphone rx', '<p>maxima calidad</p>', 0, 1600.00, 2, '0000-00-00 00:00:00', b'1'),
(19, 2, 'Iphone XS MAX', 'Iphone XS MAX ', 1, 1.00, 20, '2024-06-18 18:19:55', b'1'),
(20, 2, 'Iphone XR', 'Iphone XR Edicion especial', 2, 12000.00, 20, '2024-06-18 18:31:13', b'1'),
(22, 11, 'Iphone', 'Descripción del iPhone', 1, 999.99, 10, '2024-06-18 00:00:00', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rolId` int(15) NOT NULL,
  `nombre` varchar(10) NOT NULL,
  `estado` bit(1) NOT NULL,
  `descripcion` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rolId`, `nombre`, `estado`, `descripcion`) VALUES
(1, 'admin', b'1', 'Rol de administrador'),
(2, 'Encargado', b'1', 'Rol'),
(3, 'Empleado', b'1', 'Rol de empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `solicitudId` int(15) NOT NULL,
  `productoid` int(15) NOT NULL,
  `personaId` int(20) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`solicitudId`, `productoid`, `personaId`, `precio`, `cantidad`, `estado`) VALUES
(2, 20, 1, 12000.00, 5, b'1'),
(3, 19, 1, 12000.00, 5, b'1'),
(4, 19, 1, 12000.00, 9, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `tipoPagoId` int(15) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `estado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_pago`
--

INSERT INTO `tipo_pago` (`tipoPagoId`, `nombre`, `estado`) VALUES
(1, 'Pago Movil', b'1'),
(2, 'Transferencia', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(15) NOT NULL,
  `personaId` int(20) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `toke` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `personaId`, `usuario`, `contraseña`, `toke`) VALUES
(1, 1, 'rgil', 'admin', 'AJBP20032');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoriaId`);

--
-- Indices de la tabla `especificacionesdispositivo`
--
ALTER TABLE `especificacionesdispositivo`
  ADD PRIMARY KEY (`especificacionesId`),
  ADD KEY `productoId` (`productoId`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`facturaId`),
  ADD KEY `personaId` (`personaId`),
  ADD KEY `pagoId` (`pagoId`),
  ADD KEY `solicitudId` (`solicitudId`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`imagenId`),
  ADD KEY `productosId` (`productoId`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`moduloId`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`pagoId`),
  ADD KEY `solicitudId` (`solicitudId`),
  ADD KEY `tipoPagoId` (`tipoPagoId`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`permisoId`),
  ADD KEY `rolId` (`rolId`),
  ADD KEY `moduloId` (`moduloId`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`personaId`),
  ADD KEY `rolId` (`rolId`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`productoId`),
  ADD KEY `categoriaId` (`categoriaId`),
  ADD KEY `especificacionesId` (`especificacionesId`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rolId`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`solicitudId`),
  ADD KEY `productoid` (`productoid`),
  ADD KEY `identificacion` (`personaId`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`tipoPagoId`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `identificacion` (`personaId`),
  ADD KEY `personaId` (`personaId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoriaId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `especificacionesdispositivo`
--
ALTER TABLE `especificacionesdispositivo`
  MODIFY `especificacionesId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `facturaId` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `imagenId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `moduloId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `pagoId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `permisoId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `personaId` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `productoId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rolId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `solicitudId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `tipoPagoId` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `especificacionesdispositivo`
--
ALTER TABLE `especificacionesdispositivo`
  ADD CONSTRAINT `especificacionesdispositivo_ibfk_1` FOREIGN KEY (`especificacionesId`) REFERENCES `producto` (`especificacionesId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`pagoId`) REFERENCES `pago` (`pagoId`),
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`solicitudId`) REFERENCES `solicitud` (`solicitudId`),
  ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`personaId`) REFERENCES `persona` (`personaId`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`productoId`) REFERENCES `producto` (`productoId`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`solicitudId`) REFERENCES `solicitud` (`solicitudId`),
  ADD CONSTRAINT `pago_ibfk_2` FOREIGN KEY (`tipoPagoId`) REFERENCES `tipo_pago` (`tipoPagoId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`moduloId`) REFERENCES `modulo` (`moduloId`),
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`rolId`) REFERENCES `rol` (`rolId`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`categoriaId`) REFERENCES `categoria` (`categoriaId`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`productoid`) REFERENCES `producto` (`productoId`),
  ADD CONSTRAINT `solicitud_ibfk_3` FOREIGN KEY (`personaId`) REFERENCES `persona` (`personaId`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`personaId`) REFERENCES `persona` (`personaId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
