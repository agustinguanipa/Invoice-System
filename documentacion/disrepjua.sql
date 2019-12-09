-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 08-12-2019 a las 20:35:47
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `venrepjua`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_precio_producto` (`n_cantidad` INT, `n_precio` DECIMAL(10,2), `codigo` INT)  BEGIN
      DECLARE nueva_existencia int;
        DECLARE nuevo_total decimal(10,2);
        DECLARE nuevo_precio decimal(10,2);
        
        DECLARE cant_actual int;
        DECLARE pre_actual decimal(10,2);
        
        DECLARE actual_existencia int;
        DECLARE actual_precio decimal(10,2);
        
        SELECT precio, existencia INTO actual_precio, actual_existencia FROM producto WHERE codproducto = codigo;
        
        SET nueva_existencia = actual_existencia + n_cantidad;
        SET nuevo_total = (actual_existencia * actual_precio) + (n_cantidad * n_precio);
        SET nuevo_precio = nuevo_total / nueva_existencia;
        
        UPDATE producto SET existencia = nueva_existencia, precio = nuevo_precio WHERE codproducto = codigo;
        
        SELECT nueva_existencia, nuevo_precio;
       
  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_detalle_temp` (IN `codigo` INT, IN `cantidad` INT, IN `token_user` VARCHAR(50))  BEGIN
      
  DECLARE precio_actual decimal(10,2);
    SELECT precio INTO precio_actual FROM producto WHERE codproducto = codigo;
        
    INSERT INTO detalle_temp(token_user,codproducto,cantidad,precio_venta) VALUES(token_user,codigo,cantidad,precio_actual);
        
    SELECT tmp.correlativo,tmp.codproducto,p.descripcion,tmp.cantidad,tmp.precio_venta FROM detalle_temp tmp
    INNER JOIN producto p
    ON tmp.codproducto = p.codproducto
    WHERE tmp.token_user = token_user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `anular_factura` (`no_factura` INT)  BEGIN
      DECLARE existe_factura int;
        DECLARE registros int;
        DECLARE a int;
        
        DECLARE cod_producto int;
        DECLARE cant_producto int;
        DECLARE existencia_actual int;
        DECLARE nueva_existencia int;
        
        SET existe_factura = (SELECT COUNT(*) FROM factura WHERE nofactura = no_factura AND estatus = 1);
        
        IF existe_factura > 0 THEN 
          
            CREATE TEMPORARY TABLE tbl_tmp (id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY, cod_prod BIGINT, cant_prod int);
            
            SET a = 1;
            
            SET registros = (SELECT COUNT(*) FROM detallefactura WHERE nofactura = no_factura);
            
            IF registros > 0 THEN 
              
                INSERT INTO tbl_tmp(cod_prod,cant_prod) SELECT codproducto,cantidad FROM detallefactura WHERE nofactura = no_factura;
                
                WHILE a <= registros DO
                  SELECT cod_prod, cant_prod INTO cod_producto,cant_producto FROM tbl_tmp WHERE id = a;
                    SELECT existencia INTO existencia_actual FROM producto WHERE codproducto = cod_producto;
                    SET nueva_existencia = existencia_actual + cant_producto;
                    UPDATE producto SET existencia = nueva_existencia WHERE codproducto = cod_producto;
                    
                    SET a = a+1;
                END WHILE;
                
                UPDATE factura SET estatus = 2 WHERE nofactura = no_factura;
                DROP TABLE tbl_tmp;
                SELECT * FROM factura WHERE nofactura = no_factura;
            END IF;
        ELSE
          SELECT 0;
        END IF;
        
  END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `dataDashboard` ()  BEGIN
  DECLARE usuarios int;
    DECLARE clientes int;
    DECLARE proveedores int;
    DECLARE productos int;
    DECLARE ventas int;
    
    SELECT COUNT(*) INTO usuarios FROM usuario WHERE estatus != 10;
    SELECT COUNT(*) INTO clientes FROM cliente WHERE estatus != 10;
    SELECT COUNT(*) INTO proveedores FROM proveedor WHERE estatus != 10;
    SELECT COUNT(*) INTO productos FROM producto WHERE estatus != 10;
    SELECT COUNT(*) INTO ventas FROM factura WHERE estatus != 10;
    
    SELECT usuarios, clientes, proveedores, productos, ventas;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `del_detalle_temp` (`id_detalle` INT, `token` VARCHAR(50))  BEGIN
  DELETE FROM detalle_temp WHERE correlativo = id_detalle;
    
    SELECT tmp.correlativo, tmp.codproducto,p.descripcion,tmp.cantidad,tmp.precio_venta FROM detalle_temp tmp INNER JOIN producto p ON tmp.codproducto = p.codproducto WHERE tmp.token_user = token;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `procesar_venta` (IN `cod_usuario` INT, IN `cod_cliente` INT, IN `token` VARCHAR(50))  BEGIN
  DECLARE factura INT;
    
    DECLARE registros INT;
    DECLARE total decimal(10,2);
    
    DECLARE nueva_existencia int;
    DECLARE existencia_actual int;
    
    DECLARE tmp_cod_producto int;
    DECLARE tmp_cant_producto int;
    DECLARE a INT;
    SET a = 1;
    
    CREATE TEMPORARY TABLE tbl_tmp_tokenuser (id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY, cod_prod BIGINT, cant_prod int);
    SET registros = (SELECT COUNT(*) FROM detalle_temp WHERE token_user = token);
    
    IF registros > 0 THEN
      INSERT INTO tbl_tmp_tokenuser(cod_prod,cant_prod) SELECT codproducto,cantidad FROM detalle_temp WHERE token_user = token;
        
        INSERT INTO factura(usuario,codcliente) VALUES(cod_usuario, cod_cliente);
        SET factura = LAST_INSERT_ID();
        
        INSERT INTO detallefactura(nofactura,codproducto,cantidad,precio_venta) SELECT (factura) as nofactura, codproducto,cantidad,precio_venta FROM detalle_temp WHERE token_user = token;
        
        WHILE a <= registros  DO 
          SELECT cod_prod,cant_prod INTO tmp_cod_producto,tmp_cant_producto FROM tbl_tmp_tokenuser WHERE id = a;
            SELECT existencia INTO existencia_actual FROM producto WHERE codproducto = tmp_cod_producto;
            
            SET nueva_existencia = existencia_actual - tmp_cant_producto;
            UPDATE producto SET existencia = nueva_existencia WHERE codproducto = tmp_cod_producto;
            
            SET a=a+1;
            
        END WHILE;
        
        SET total = (SELECT sum(cantidad * precio_venta) FROM detalle_temp WHERE token_user = token);
        UPDATE factura SET totalfactura = total WHERE nofactura = factura;
        DELETE FROM detalle_temp WHERE token_user = token;
        TRUNCATE TABLE tbl_tmp_tokenuser;
        SELECT * FROM factura WHERE nofactura = factura;
        
     ELSE
      
        SELECT 0;
        
     END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

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
(8, 13587648, 'JEAN CARLO ALVAREZ', '(0416) 777 0773', 'BARRIO PEDRO ROA GONZALES', '2019-11-30 22:39:56', 1, 1),
(9, 14145781, 'MARIA EUGENIA GARCIA', '(0414) 159 8715', 'RESIDENCIAS LA CASTELLANA CASA Nº78', '2019-12-08 12:01:50', 1, 1),
(10, 27415789, 'SEBASTIAN ALVAREZ', '(0414) 158 7412', 'URBANIZACION LA CASTELLANA Nº78', '2019-12-08 13:59:44', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

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
(13, 8, 4, 4, '149999.00'),
(14, 9, 1, 1, '10000.00'),
(15, 10, 1, 7, '10000.00'),
(16, 11, 4, 3, '149999.00'),
(17, 12, 7, 1, '1190000.00'),
(18, 12, 6, 1, '459000.00');

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
(11, 3, '2019-10-23 21:10:16', 30, '500.00', 1),
(12, 1, '2019-11-30 17:45:06', 10, '19999.00', 19),
(13, 2, '2019-11-30 17:46:49', 10, '149999.00', 19),
(14, 3, '2019-11-30 17:48:29', 10, '14999999.00', 19),
(15, 4, '2019-11-30 17:49:55', 10, '149999.00', 1),
(16, 5, '2019-12-08 20:26:35', 20, '75000.00', 1),
(17, 6, '2019-12-08 20:27:54', 15, '459000.00', 1),
(18, 7, '2019-12-08 20:28:45', 10, '1190000.00', 1),
(19, 8, '2019-12-08 20:30:04', 18, '147000.00', 1);

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
(6, '2019-11-30 15:45:32', 1, 6, '103.64', 1),
(7, '2019-11-30 18:03:29', 1, 7, '19999.00', 2),
(8, '2019-12-01 10:12:01', 1, 7, '599996.00', 1),
(9, '2019-12-01 15:10:17', 1, 7, '10000.00', 1),
(10, '2019-12-08 12:02:38', 1, 9, '70000.00', 2),
(11, '2019-12-08 19:55:02', 1, 6, '449997.00', 1),
(12, '2019-12-08 20:30:58', 1, 6, '1649000.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

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
(4, 'ACEITE SHELL 5W20 MINERAL', '149999.00', 3, '2019-11-30 17:49:55', 1, 1, ''),
(5, 'ESTOPERA OPTRA 2011', '75000.00', 20, '2019-12-08 20:26:35', 1, 1, 'img_b8e53fe04ffd0dceaab873cb7e9eac25.jpg'),
(6, 'KIT DE TIEMPO OPTRA ADVANCED', '459000.00', 14, '2019-12-08 20:27:54', 1, 1, 'user.png'),
(7, 'KIT ESCAPE ORIGINAL OPTRA ADVANCED', '1190000.00', 9, '2019-12-08 20:28:45', 1, 1, 'producto.png'),
(8, 'KIT DE TIEMPO OPTRA LIMITED 2010', '147000.00', 18, '2019-12-08 20:30:04', 1, 1, 'producto.png');

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
(1, 'ADMINISTRADOR'),
(2, 'GERENTE'),
(3, 'VENDEDOR');

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
  `estatus` int(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `correo`, `usuario`, `clave`, `rol`, `estatus`) VALUES
(1, 'CARLOS GUANIPA', 'AGUSTINGUANIPA98@GMAIL.COM', 'GUANIPA', '12345', 1, 1),
(19, 'CARLOS ALVAREZ', 'JUANCHOALVAREZ@MAIL', 'JUANCHO', '12345', 2, 1),
(20, 'ALEXIS ALVAREZ', 'ALEXISE@MAIL', 'ALEXIS', '12345', 2, 1),
(21, 'ISAAC CLAVIJO', 'JC.ISAAC@MAIL', 'ISAAC', '12345', 3, 1),
(22, 'AGUSTIN GUANIPA', 'AGUSTIN98@MAIL.COM', 'AGUSTIN', '12345', 2, 1),
(23, 'SEBASTIAN ALVAREZ', 'SEBAS@MAIL', 'SEBAS', '12345', 3, 1);

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
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `correlativo` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `nofactura` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;
