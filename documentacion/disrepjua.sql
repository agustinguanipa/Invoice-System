-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-11-2019 a las 14:23:40
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `Facturacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `cedula` int(11) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `direccion` text,
  `dateadd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `cedula`, `nombre`, `telefono`, `direccion`, `dateadd`, `usuario_id`, `estatus`) VALUES
(1, 10179684, 'Yanira Fernandez', '04269758548', 'Barrio Bolivar Calle el Alto Parte Baja #65', '2019-07-25 20:05:40', 1, 1),
(2, 10173377, 'Oriol Quintana', '04166762428', 'Barrio Bolivar Calle el Alto Parte Baja #65', '2019-07-25 20:08:50', 2, 1),
(3, 26955690, 'Anthony Quintana', '04147268222', 'Barrio Bolivar Calle el Alto Parte Baja #65', '2019-07-25 20:51:15', 1, 1),
(4, 234567, 'ghdjmk,lvgsd', '234567', 'dsfgtyhb', '2019-07-26 16:16:12', 1, 0),
(5, 26607655, 'CARLOS GUANIPA', '04266908396', 'CALLE 2 BELLAVISTA', '2019-11-30 11:53:18', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `codigo` int(11) NOT NULL,
  `rif` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `razon_social` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` varchar(11) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `direccion` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `iva` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`codigo`, `rif`, `nombre`, `razon_social`, `telefono`, `email`, `direccion`, `iva`) VALUES
(1, '10173377', 'Oriol Haner Quintana', 'Yaco Quintana Distribuciones', '02763564780', 'oriolhanerquintana@gmail.com', 'Barrio Bolivar Calle el Alto Parte Baja #65', '12.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `correlativo` bigint(11) NOT NULL,
  `nofactura` bigint(11) DEFAULT NULL,
  `codproducto` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`correlativo`, `nofactura`, `codproducto`, `cantidad`, `precio_venta`) VALUES
(1, 1, 1, 1, '15.00'),
(2, 2, 3, 1, '250.00'),
(3, 3, 1, 2, '51.82'),
(4, 3, 2, 1, '300.00'),
(5, 4, 1, 1, '51.82'),
(6, 4, 2, 1, '300.00'),
(7, 4, 3, 1, '297.84'),
(8, 5, 1, 1, '51.82');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `correlativo` int(11) NOT NULL,
  `token_user` varchar(50) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `correlativo` int(11) NOT NULL,
  `codproducto` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`correlativo`, `codproducto`, `fecha`, `cantidad`, `precio`, `usuario_id`) VALUES
(1, 1, '2019-07-26 18:01:52', 150, '110.00', 1),
(4, 2, '2019-07-26 20:24:21', 100, '300.00', 1),
(5, 3, '2019-07-26 20:26:38', 150, '250.00', 1),
(6, 1, '2019-10-23 13:41:22', 4, '15.00', 1),
(7, 1, '2019-10-23 13:41:38', 3, '150.00', 1),
(8, 1, '2019-10-23 13:41:53', 3, '51.82', 1),
(9, 3, '2019-10-23 21:08:47', 20, '350.00', 1),
(10, 3, '2019-10-23 21:10:08', 10, '300.00', 1),
(11, 3, '2019-10-23 21:10:16', 30, '500.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `nofactura` bigint(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario` int(11) DEFAULT NULL,
  `codcliente` int(11) DEFAULT NULL,
  `totalfactura` decimal(10,2) DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`nofactura`, `fecha`, `usuario`, `codcliente`, `totalfactura`, `estatus`) VALUES
(1, '2019-10-23 16:39:40', 1, 1, '15.00', 1),
(2, '2019-10-22 16:40:08', 1, 1, '250.00', 1),
(3, '2019-10-23 21:06:07', 1, 3, '403.64', 2),
(4, '2019-11-24 14:55:15', 1, 3, '649.66', 1),
(5, '2019-11-30 12:37:05', 1, 5, '51.82', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codproducto` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `proveedor` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `existencia` int(11) DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1',
  `foto` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codproducto`, `descripcion`, `proveedor`, `precio`, `existencia`, `date_add`, `usuario_id`, `estatus`, `foto`) VALUES
(1, 'Mouse USB', 2, '51.82', 11, '2019-07-26 18:01:52', 1, 1, 'img_284eb0b6b4663ae0138f14711d7ca9c2.jpg'),
(2, 'Teclado', 4, '300.00', 99, '2019-07-26 20:24:21', 1, 1, 'img_7afd80dfaacdfc2daa3d95d480d5fdc1.jpg'),
(3, 'Monitor', 2, '297.84', 208, '2019-07-26 20:26:38', 1, 1, 'img_9be31b838311f6905044d62a041fc29c.jpg');

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `entradas_A_I` AFTER INSERT ON `producto` FOR EACH ROW BEGIN
    	INSERT INTO entradas(codproducto,cantidad,precio,usuario_id)
        VALUES(new.codproducto,new.existencia,new.precio,new.usuario_id);
	END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `codproveedor` int(11) NOT NULL,
  `proveedor` varchar(100) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `direccion` text,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`codproveedor`, `proveedor`, `contacto`, `telefono`, `direccion`, `date_add`, `usuario_id`, `estatus`) VALUES
(1, 'Distribuidora Disalga C.A.', 'Oriol Quintana', '04166762428', 'La Guayana el Democrata', '2019-07-26 16:32:42', 1, 1),
(2, 'Panaderia Bom Pan', 'Gabriel Garcia', '04245678765', 'Barrio Bolivar Calle Principal ', '2019-07-26 16:38:28', 1, 1),
(3, 'BIC', 'Claudia Rosales', '23456789', 'Avenida las Americas', '2019-07-26 16:50:34', 1, 1),
(4, 'CompuCenter', 'Rodrigo Arana', '0987654', 'Calzada San Juan', '2019-07-26 16:50:57', 1, 1),
(5, 'Omega', 'Julio Estrada Rosales', '8353098350', 'Avenida Elena Zona 4, Guatemala ', '2019-07-26 16:51:25', 1, 1),
(6, 'ACER', 'Anthony Quintana', '456789009', 'Barrio Bolivar Calle el Alto Parte Baja #65', '2019-07-26 18:51:29', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Supervisor'),
(3, 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `foto` varchar(45) NOT NULL,
  `estatus` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`, `foto`, `estatus`) VALUES
(1, 'Anthony Quintana', 'quintana@gmail.com', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1, 'img_f2bb30dfd4cc534680bb1896d2198523.jpg', 1),
(2, 'Oriol Quintana', 'oriolhaner@gmail.com', 'oriolHANER', '81dc9bdb52d04dc20036dbd8313ed055', 2, 'user.png', 1),
(3, 'Alisson Gomez', 'alissongomez@gmail.com', 'alisson', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'user.png', 1),
(4, 'Yanira Fernandez', 'yanira@gmail.com', 'yanira', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'user.png', 1),
(5, 'Cristian Quintana', 'cristianquintana@gmail.com', 'cristian', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'img_95a9e1925de677aec1c89368aecda179.jpg', 1),
(6, 'Emma Fernandez', 'emmafernandez@gmail.com', 'emma', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'user.png', 1),
(7, 'Maria Fernandez', 'mariafernandez@gmail.com', 'maria', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'user.png', 1),
(8, 'Victor Fernandez', 'victorfernandez@gmail.com', 'victor', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'user.png', 1),
(9, 'juan Fernandez', 'juanfernandez@gmail.com', 'juan', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'user.png', 1),
(10, 'Humberto Fernandez', 'humbertofernandez@gmail.com', 'humberto', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'user.png', 1),
(11, 'Chucho Fernandez ', 'chuchofernandez@gmail.com', 'chucho', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'user.png', 1),
(12, 'Carmela Burgos', 'carmelaburgos', 'carmela', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'user.png', 1),
(13, 'Elizabeth Perez', 'elizaethperez@gmail.com', 'elizabeth', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'user.png', 1),
(14, 'Gabriel Serrano', 'gabrielserrano@gmail.com', 'gabriel', '81dc9bdb52d04dc20036dbd8313ed055', 3, 'user.png', 1),
(15, 'Kimberly Salazar', 'kimberlysalazar@gmail.com', 'kimberly', '81dc9bdb52d04dc20036dbd8313ed055', 2, 'user.png', 1),
(16, 'Pedro Burgos', 'pedroburgos@gmail.com', 'pedro', '81dc9bdb52d04dc20036dbd8313ed055', 2, 'user.png', 1),
(17, 'Carlos Guanipa', 'guanipa@gmail.com', 'guanipa', '12345', 1, 'user.png', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`idcliente`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `codproducto` (`codproducto`),
  ADD KEY `nofactura` (`nofactura`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `codproducto` (`codproducto`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `codproducto` (`codproducto`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`nofactura`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `codcliente` (`codcliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codproducto`),
  ADD KEY `proveedor` (`proveedor`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`codproveedor`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `date_add` (`date_add`),
  ADD KEY `usuario_id_2` (`usuario_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `correlativo` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `nofactura` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `codproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`nofactura`) REFERENCES `factura` (`nofactura`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_2` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `entradas_ibfk_1` FOREIGN KEY (`codproducto`) REFERENCES `producto` (`codproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`codcliente`) REFERENCES `cliente` (`idcliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`proveedor`) REFERENCES `proveedor` (`codproveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD CONSTRAINT `proveedor_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
