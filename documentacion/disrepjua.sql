-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-12-2019 a las 15:06:57
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

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL,
  `cedula` int(11) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` text,
  `dateadd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`idcliente`, `cedula`, `nombre`, `telefono`, `direccion`, `dateadd`, `usuario_id`, `estatus`) VALUES
(6, 7491156, 'CARLOS LUIS GUANIPA BUENO', '(0414) 707 8002', 'PUEBLO NUEVO CALLE 2 BELLAVISTA RESD MILDREY PISO 7 APTO 74', '2019-11-30 15:25:51', 1, 1),
(7, 5028153, 'ALBA ALVAREZ', '(0426) 822 6711', 'PUEBLO NUEVO CALLE 2 BELLAVISTA RESD MILDREY PISO 7 APTO 74', '2019-11-30 15:29:46', 1, 1),
(8, 13587648, 'JEAN CARLO ALVAREZ', '(0416) 777 0773', 'BARRIO PEDRO ROA GONZALES', '2019-11-30 22:39:56', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE `configuracion` (
  `codigo` int(11) NOT NULL,
  `rif` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `razon_social` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `direccion` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `iva` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`codigo`, `rif`, `nombre`, `razon_social`, `telefono`, `email`, `direccion`, `iva`) VALUES
(1, '266076550', 'CARLOS GUANIPA', 'VENTA DE REPUESTOS JUANCHO', '(0426) 690 8396', 'AGUSTIN@MAIL', 'ZONA INDUSTRIAL DE PARAMILLO', '16.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

DROP TABLE IF EXISTS `detallefactura`;
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
(9, 6, 1, 1, '51.82'),
(10, 6, 1, 1, '51.82'),
(12, 7, 1, 1, '19999.00'),
(13, 8, 4, 4, '149999.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

DROP TABLE IF EXISTS `detalle_temp`;
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

DROP TABLE IF EXISTS `entradas`;
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
(11, 3, '2019-10-23 21:10:16', 30, '500.00', 1),
(12, 1, '2019-11-30 17:45:06', 10, '19999.00', 19),
(13, 2, '2019-11-30 17:46:49', 10, '149999.00', 19),
(14, 3, '2019-11-30 17:48:29', 10, '14999999.00', 19),
(15, 4, '2019-11-30 17:49:55', 10, '149999.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
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
(6, '2019-11-30 15:45:32', 1, 6, '103.64', 1),
(7, '2019-11-30 18:03:29', 1, 7, '19999.00', 1),
(8, '2019-12-01 10:12:01', 1, 7, '599996.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `codproducto` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
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

INSERT INTO `producto` (`codproducto`, `descripcion`, `precio`, `existencia`, `date_add`, `usuario_id`, `estatus`, `foto`) VALUES
(1, 'PASTILLAS DE FRENO', '10000.00', 10, '2019-11-30 17:45:06', 19, 1, 'user.png'),
(2, 'BOBINA CORSA SPEED 2005', '149999.00', 10, '2019-11-30 17:46:49', 19, 1, 'user.png'),
(3, 'BOBINA CORSA AUT 2002', '14999999.00', 10, '2019-11-30 17:48:29', 19, 1, 'user.png'),
(4, 'ACEITE SHELL 5W20 MINERAL', '149999.00', 6, '2019-11-30 17:49:55', 1, 1, 'img_b8818df00bd143c0634ab1f0c0dfa8f8.jpg');

--
-- Disparadores `producto`
--
DROP TRIGGER IF EXISTS `entradas_A_I`;
DELIMITER $$
CREATE TRIGGER `entradas_A_I` AFTER INSERT ON `producto` FOR EACH ROW BEGIN
      INSERT INTO entradas(codproducto,cantidad,precio,usuario_id)
        VALUES(new.codproducto,new.existencia,new.precio,new.usuario_id);
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `rol` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'GERENTE'),
(3, 'VENDEDOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `usuario` varchar(15) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `estatus` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`, `estatus`) VALUES
(1, 'CARLOS GUANIPA', 'AGUSTINGUANIPA98@GMAIL.COM', 'GUANIPA', '12345', 1, 1),
(19, 'CARLOS ALVAREZ', 'JUANCHOALVAREZ@MAIL', 'JUANCHO', '12345', 2, 1),
(20, 'ALEXIS ALVAREZ', 'ALEXISE@MAIL', 'ALEXIS', '12345', 2, 1),
(21, 'ISAAC CLAVIJO', 'JC.ISAAC@MAIL', 'ISAAC', '12345', 3, 1);

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
  ADD KEY `usuario_id` (`usuario_id`);

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
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `correlativo` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `nofactura` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;
