-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-08-2015 a las 19:26:00
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `aliah2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion`
--

CREATE TABLE IF NOT EXISTS `accion` (
  `codigo` int(11) NOT NULL,
  `accion` varchar(100) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `modulo` int(11) DEFAULT NULL,
  `key` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion_usuario`
--

CREATE TABLE IF NOT EXISTS `accion_usuario` (
  `codigo` int(11) NOT NULL,
  `accion` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE IF NOT EXISTS `cliente` (
  `codigo` int(11) NOT NULL,
  `numero_identificacion` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `sexo` int(11) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `tipo` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `info` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE IF NOT EXISTS `factura` (
  `codigo` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `punto_venta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `metodo_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_ganadora`
--

CREATE TABLE IF NOT EXISTS `factura_ganadora` (
  `codigo` int(11) NOT NULL,
  `sorteo` int(11) NOT NULL,
  `factura` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gasto`
--

CREATE TABLE IF NOT EXISTS `gasto` (
  `codigo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `monto` varchar(12) NOT NULL,
  `usuario` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `tipo_gasto` int(11) NOT NULL,
  `punto_venta` int(11) NOT NULL,
  `usuario_registro` int(11) NOT NULL,
  `fecha_registro` timestamp NULL,
  `usuario_actualizacion` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL,
  `usuario_autorizador` int(11) DEFAULT NULL,
  `fecha_autorizacion` timestamp NULL DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `codigo` int(11) NOT NULL,
  `horario_apertura` time NOT NULL,
  `hora_cierre` time NOT NULL,
  `hora_max_cierre` time NOT NULL,
  `dia` int(11) NOT NULL,
  `punto_venta` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingreso`
--

CREATE TABLE IF NOT EXISTS `ingreso` (
  `codigo` int(11) NOT NULL,
  `fecha_cierre_caja` date NOT NULL,
  `fecha_llegada` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `corresponde` bit(1) NOT NULL,
  `igualado` tinyint(1) DEFAULT NULL,
  `usuario_pago` int(11) NOT NULL,
  `suma_anexada` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `punto_venta` int(11) NOT NULL,
  `origen` int(11) NOT NULL,
  `destino` int(11) NOT NULL,
  `cantidad_esperada` int(11) NOT NULL,
  `tipo_ingreso` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `usuario_autorizador` int(11) DEFAULT NULL,
  `usuario_registro` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `usuario_actualizacion` int(11) NOT NULL,
  `fecha_actualizacion` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE IF NOT EXISTS `inventario` (
  `codigo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `punto_venta` int(11) NOT NULL,
  `origen` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `usuario_registro` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `usuario_actualizador` int(11) NOT NULL,
  `fecha_actualizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_factura`
--

CREATE TABLE IF NOT EXISTS `item_factura` (
  `codigo` int(11) NOT NULL,
  `factura` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_inventario`
--

CREATE TABLE IF NOT EXISTS `item_inventario` (
  `codigo` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `talla` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `cantidad_esperada` smallint(9) NOT NULL,
  `cantidad_defectuasa` smallint(9) NOT NULL,
  `cantidad_entregada` smallint(9) NOT NULL,
  `cantidad_actual` smallint(11) NOT NULL,
  `precio_unidad` decimal(8,0) NOT NULL,
  `precio_mayor` decimal(8,0) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE IF NOT EXISTS `modulo` (
  `codigo` int(11) NOT NULL,
  `modulo` varchar(30) NOT NULL,
  `controladores` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `fechaCreate` timestamp NOT NULL,
  `fechaMod` timestamp NOT NULL,
  `usuarioMod` int(11) DEFAULT NULL,
  `usuarioCreate` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `punto_venta`
--

CREATE TABLE IF NOT EXISTS `punto_venta` (
  `codigo` int(11) NOT NULL,
  `Whatsapp` int(11) DEFAULT NULL,
  `telefono` int(10) NOT NULL,
  `extension` varchar(20) DEFAULT NULL,
  `pais` varchar(15) NOT NULL,
  `ciudad` varchar(15) NOT NULL,
  `barrio` varchar(25) NOT NULL,
  `direccion` varchar(25) NOT NULL,
  `lugar` varchar(25) DEFAULT NULL,
  `local` varchar(5) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sorteo`
--

CREATE TABLE IF NOT EXISTS `sorteo` (
  `codigo` int(11) NOT NULL,
  `dia` date NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `termino`
--

CREATE TABLE IF NOT EXISTS `termino` (
  `codigo` int(11) NOT NULL,
  `termino` varchar(30) NOT NULL,
  `key` int(11) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cliente`
--

CREATE TABLE IF NOT EXISTS `tipo_cliente` (
  `codigo` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `cantidad_compras` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` int(11) NOT NULL,
  `identificacion` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `telefono` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `sexo` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `contrasena` varchar(30) NOT NULL,
  `rol` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_punto_venta`
--

CREATE TABLE IF NOT EXISTS `usuario_punto_venta` (
  `codigo` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `punto_venta` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accion`
--
ALTER TABLE `accion`
  ADD PRIMARY KEY (`codigo`), ADD KEY `modulo` (`modulo`);

--
-- Indices de la tabla `accion_usuario`
--
ALTER TABLE `accion_usuario`
  ADD PRIMARY KEY (`codigo`), ADD KEY `accion` (`accion`), ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codigo`), ADD KEY `tipo` (`tipo`), ADD KEY `sexo` (`sexo`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`codigo`), ADD KEY `metodo_pago` (`metodo_pago`), ADD KEY `punto_venta` (`punto_venta`), ADD KEY `usuario` (`usuario`), ADD KEY `cliente` (`cliente`);

--
-- Indices de la tabla `factura_ganadora`
--
ALTER TABLE `factura_ganadora`
  ADD PRIMARY KEY (`codigo`), ADD KEY `estado` (`estado`), ADD KEY `factura` (`factura`), ADD KEY `sorteo` (`sorteo`);

--
-- Indices de la tabla `gasto`
--
ALTER TABLE `gasto`
  ADD PRIMARY KEY (`codigo`), ADD KEY `usuario` (`usuario`), ADD KEY `tipo_gasto` (`tipo_gasto`), ADD KEY `punto_venta` (`punto_venta`), ADD KEY `usuario_registro` (`usuario_registro`), ADD KEY `usuario_actualizacion` (`usuario_actualizacion`), ADD KEY `usuario_autorizador` (`usuario_autorizador`,`estado`), ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`codigo`), ADD KEY `punto_venta` (`punto_venta`);

--
-- Indices de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  ADD PRIMARY KEY (`codigo`), ADD KEY `usuario_pago` (`usuario_pago`), ADD KEY `usuario_registro` (`usuario_registro`), ADD KEY `usuario_actualizacion` (`usuario_actualizacion`), ADD KEY `origen` (`origen`), ADD KEY `destino` (`destino`), ADD KEY `tipo_ingreso` (`tipo_ingreso`), ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`codigo`), ADD KEY `usuario_registro` (`usuario_registro`), ADD KEY `punto_venta` (`punto_venta`,`origen`,`estado`,`usuario_registro`,`usuario_actualizador`), ADD KEY `inventario_ibfk_2` (`origen`), ADD KEY `inventario_ibfk_3` (`estado`), ADD KEY `inventario_ibfk_5` (`usuario_actualizador`);

--
-- Indices de la tabla `item_factura`
--
ALTER TABLE `item_factura`
  ADD PRIMARY KEY (`codigo`), ADD KEY `factura` (`factura`), ADD KEY `producto` (`producto`);

--
-- Indices de la tabla `item_inventario`
--
ALTER TABLE `item_inventario`
  ADD PRIMARY KEY (`codigo`), ADD KEY `estado` (`estado`), ADD KEY `producto` (`producto`), ADD KEY `talla` (`talla`), ADD KEY `color` (`color`), ADD KEY `producto_2` (`producto`,`color`,`talla`,`estado`), ADD KEY `tipo` (`tipo`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codigo`), ADD KEY `estado` (`estado`), ADD KEY `categoria` (`categoria`), ADD KEY `usuariomod` (`usuarioMod`);

--
-- Indices de la tabla `punto_venta`
--
ALTER TABLE `punto_venta`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `sorteo`
--
ALTER TABLE `sorteo`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `termino`
--
ALTER TABLE `termino`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  ADD PRIMARY KEY (`codigo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo`), ADD UNIQUE KEY `email` (`email`), ADD UNIQUE KEY `usuario` (`usuario`), ADD KEY `rol` (`rol`), ADD KEY `sexo` (`sexo`), ADD KEY `estado` (`estado`);

--
-- Indices de la tabla `usuario_punto_venta`
--
ALTER TABLE `usuario_punto_venta`
  ADD PRIMARY KEY (`codigo`), ADD KEY `usuario` (`usuario`,`punto_venta`), ADD KEY `punto_venta` (`punto_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accion`
--
ALTER TABLE `accion`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `accion_usuario`
--
ALTER TABLE `accion_usuario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `factura_ganadora`
--
ALTER TABLE `factura_ganadora`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `gasto`
--
ALTER TABLE `gasto`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `ingreso`
--
ALTER TABLE `ingreso`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `item_factura`
--
ALTER TABLE `item_factura`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `item_inventario`
--
ALTER TABLE `item_inventario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `punto_venta`
--
ALTER TABLE `punto_venta`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sorteo`
--
ALTER TABLE `sorteo`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `termino`
--
ALTER TABLE `termino`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `usuario_punto_venta`
--
ALTER TABLE `usuario_punto_venta`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accion`
--
ALTER TABLE `accion`
ADD CONSTRAINT `accion_ibfk_1` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `accion_usuario`
--
ALTER TABLE `accion_usuario`
ADD CONSTRAINT `accion_usuario_ibfk_1` FOREIGN KEY (`accion`) REFERENCES `accion` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `accion_usuario_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo_cliente` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`sexo`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`metodo_pago`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura_ganadora`
--
ALTER TABLE `factura_ganadora`
ADD CONSTRAINT `factura_ganadora_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `factura_ganadora_ibfk_2` FOREIGN KEY (`factura`) REFERENCES `factura` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `factura_ganadora_ibfk_3` FOREIGN KEY (`sorteo`) REFERENCES `sorteo` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gasto`
--
ALTER TABLE `gasto`
ADD CONSTRAINT `gasto_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `gasto_ibfk_3` FOREIGN KEY (`tipo_gasto`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `gasto_ibfk_4` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `gasto_ibfk_5` FOREIGN KEY (`usuario_registro`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `gasto_ibfk_6` FOREIGN KEY (`usuario_actualizacion`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `gasto_ibfk_7` FOREIGN KEY (`usuario_autorizador`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `gasto_ibfk_8` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ingreso`
--
ALTER TABLE `ingreso`
ADD CONSTRAINT `ingreso_ibfk_2` FOREIGN KEY (`usuario_pago`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ingreso_ibfk_3` FOREIGN KEY (`usuario_registro`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ingreso_ibfk_4` FOREIGN KEY (`usuario_actualizacion`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ingreso_ibfk_5` FOREIGN KEY (`origen`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ingreso_ibfk_6` FOREIGN KEY (`destino`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ingreso_ibfk_7` FOREIGN KEY (`tipo_ingreso`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ingreso_ibfk_8` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `inventario_ibfk_2` FOREIGN KEY (`origen`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `inventario_ibfk_3` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `inventario_ibfk_4` FOREIGN KEY (`usuario_registro`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `inventario_ibfk_5` FOREIGN KEY (`usuario_actualizador`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `item_factura`
--
ALTER TABLE `item_factura`
ADD CONSTRAINT `item_factura_ibfk_1` FOREIGN KEY (`factura`) REFERENCES `factura` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `item_factura_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `item_inventario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `item_inventario`
--
ALTER TABLE `item_inventario`
ADD CONSTRAINT `item_inventario_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `item_inventario_ibfk_2` FOREIGN KEY (`color`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `item_inventario_ibfk_3` FOREIGN KEY (`talla`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `item_inventario_ibfk_4` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `item_inventario_ibfk_5` FOREIGN KEY (`tipo`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`usuarioMod`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`sexo`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_punto_venta`
--
ALTER TABLE `usuario_punto_venta`
ADD CONSTRAINT `usuario_punto_venta_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `usuario_punto_venta_ibfk_2` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Volcado de datos para la tabla `termino`
--

INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(1, 'Masculino', 1, 'sexo', 'este termino corresponde a la categoria sexo al sexo masculino', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(2, 'Femenino', 2, 'sexo', 'este termino corresponde a la categoria sexo al sexo femennino', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(3, 'Activo', 1, 'Estados De Usuario', 'Este termino hace referencia a el estado activo de un usuario', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(4, 'Inactivo', 2, 'Estados De Usuario', 'Este termino hace referencia a el estado Inactivo de un usuario', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(5, 'Eliminado', 3, 'Estados De Usuario', 'Este termino hace referencia a el estado activo de un usuario', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(6, 'No identificado', 0, 'Categoria De Producto', 'Este termino corresponde a el estado no identificado de categorias de producto', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(7, 'Activo', 1, 'Estados De Producto', 'este es el estado activo un producto', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(8, 'Bebe', 0, 'Talla', 'Talla de bebe', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(9, 'Bebe', 2, 'Talla', 'Talla de bebe', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(10, 'Bebe', 4, 'Talla', 'Talla de bebe', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(11, 'Niña', 6, 'Talla', 'Talla de niña', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(12, 'Nina', 8, 'Talla', 'Talla de nina', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(13, 'Niña', 10, 'Talla', 'Talla de niña', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(14, 'Teens', 12, 'Talla', 'Talla de teens', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(15, 'Teens', 14, 'Talla', 'Talla de teens', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(16, 'Teens', 16, 'Talla', 'Talla de teens', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(17, 'Small', 18, 'Talla', 'Talla de small', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(18, 'Medium', 20, 'Talla', 'Talla de medium', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(19, 'Large', 22, 'Talla', 'Talla de large', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(20, 'Extra large', 24, 'Talla', 'Talla de extra large', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(21, 'Doble extra large', 26, 'Talla', 'Talla de doble extra large', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(22, 'Estándar', 28, 'Talla', 'Talla de estándar', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(23, 'No identificado', 0, 'Color', 'color No identificado', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(24, 'Negro', 10, 'Color', 'color Negro', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(25, 'Gris', 11, 'Color', 'color Gris', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(26, 'Plata', 12, 'Color', 'color Plata', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(27, 'Blanco', 13, 'Color', 'color Blanco', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(28, 'Perla', 14, 'Color', 'color Perla', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(29, 'Fuxia', 15, 'Color', 'color Fuxia', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(30, 'Rosado', 16, 'Color', 'color Rosado', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(31, 'Camote', 17, 'Color', 'color Camote', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(32, 'Barney', 18, 'Color', 'color Barney', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(33, 'Lila', 19, 'Color', 'color Lila', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(34, 'Melon', 20, 'Color', 'color Melon', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(35, 'Coral', 21, 'Color', 'color Coral', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(36, 'Naranja', 22, 'Color', 'color Naranja', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(37, 'Rojo', 23, 'Color', 'color Rojo', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(38, 'Vino', 24, 'Color', 'color Vino', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(39, 'Verde menta', 25, 'Color', 'color Verde menta', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(40, 'Verde agua', 26, 'Color', 'color Verde agua', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(41, 'Turqueza', 27, 'Color', 'color Turqueza', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(42, 'Jade', 28, 'Color', 'color Jade', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(43, 'Azulino', 29, 'Color', 'color Azulino', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(44, 'Azul noche', 30, 'Color', 'color Azul noche', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(45, 'Dorado', 31, 'Color', 'color Dorado', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(46, 'Marron', 32, 'Color', 'color Marron', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(47, 'Verde noche', 33, 'Color', 'color Verde noche', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(48, 'Verde manzana', 34, 'Color', 'color Verde manzana', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(49, 'Verde esmeralda', 35, 'Color', 'color Verde esmeralda', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(50, 'Bautizo', 10, 'Categoria De Producto', 'Categria de producto Bautizo', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(51, 'Paje', 11, 'Categoria De Producto', 'Categria de producto Paje', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(52, 'Primera comunion', 12, 'Categoria De Producto', 'Categria de producto Primera comunion', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(53, 'Niña', 13, 'Categoria De Producto', 'Categria de producto Niña', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(54, 'Teens', 14, 'Categoria De Producto', 'Categria de producto Teens', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(55, 'Quince', 15, 'Categoria De Producto', 'Categria de producto Quince', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(56, 'Novia', 16, 'Categoria De Producto', 'Categria de producto Novia', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(57, 'Dama', 17, 'Categoria De Producto', 'Categria de producto Dama', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(58, 'Señoreal', 18, 'Categoria De Producto', 'Categria de producto Señoreal', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(59, 'Conjunto', 19, 'Categoria De Producto', 'Categria de producto Conjunto', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(60, 'Enterizo', 20, 'Categoria De Producto', 'Categria de producto Enterizo', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(61, 'Casual', 21, 'Categoria De Producto', 'Categria de producto Casual', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(62, 'Bluzas', 22, 'Categoria De Producto', 'Categria de producto Bluzas', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(63, 'Pantalon', 23, 'Categoria De Producto', 'Categria de producto Pantalon', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(64, 'Falda', 24, 'Categoria De Producto', 'Categria de producto Falda', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(65, 'Accesorios', 25, 'Categoria De Producto', 'Categria de producto Accesorios', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(66, 'Corsel', 26, 'Categoria De Producto', 'Categria de producto Corsel', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(67, 'No identificado', 0, 'Detalle de producto', 'Detalle de producto No identificado', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(68, 'Corto ', 1, 'Detalle de producto', 'Detalle de producto Corto ', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(69, 'Campana', 2, 'Detalle de producto', 'Detalle de producto Campana', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(70, 'Largo', 3, 'Detalle de producto', 'Detalle de producto Largo', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(71, 'Cola de pato', 4, 'Detalle de producto', 'Detalle de producto Cola de pato', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(72, '3/4', 5, 'Detalle de producto', 'Detalle de producto 3/4', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(73, 'Entallado', 6, 'Detalle de producto', 'Detalle de producto Entallado', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(74, 'Gastos de envio', 1, 'Tipos De Gastos', 'Gasto de envió', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(75, 'Por Autorizar', 1, 'Estado De Gasto', 'este es el estado del gasto por autorizar', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(76, 'Autorizado', 2, 'Estado De Gasto', 'estado autorizado de los gastos generados en el punto de venta', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(77, 'Comun', 1, 'Tipo De Ingresos', 'este estado corresponde a un ingreso comun el cual puede generarse en cualquier momento', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(78, 'Cierre de caja', 2, 'Tipo De Ingresos', 'este estado corresponde a las ganancias en un día que se generan en un punto de venta.', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(79, 'Correcto', 1, 'Estado De Ingresos', 'este es el estado que se asigna a el ingreso en caso que la cantidad de entrada concuerde con la cantidad ingresada', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(80, 'Menor', 2, 'Estado De Ingresos', 'este es el estado que se asigna a el ingreso en caso que la cantidad de entrada sea menor a la cantidad ingresada', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(81, 'Mayor', 3, 'Estado De Ingresos', 'este es el estado que se asigna a el ingreso en caso que la cantidad de entrada  sea mayor a la cantidad ingresada', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(82, 'autorizado', 4, 'Estado De Ingresos', 'este es el estado que se asigna a el ingreso en caso de que este se autorice, despues de esto no se podra editar', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(83, 'No Identificado', 25, 'Talla', 'Talla No Identificada', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(84, 'Completo', 1, 'Estado De Item Inventario', 'Estado De Item Inventario Completo', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(85, 'Defectos', 2, 'Estado De Item Inventario', 'Estado De Item Inventario Defectos', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(86, 'Incompleto', 3, 'Estado De Item Inventario', 'Estado De Item Inventario Incompleto', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(87, 'Activo', 1, 'Estado De Inventario', 'Estado De Inventario Activo', 1);
INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES(88, 'No Activo', 2, 'Estado De Inventario', 'Estado De Inventario No Activo', 1);


INSERT INTO `modulo` (`codigo`, `modulo`, `controladores`, `estado`) VALUES(2, 'Puntos De venta', 'PuntoVentaController', 1);
INSERT INTO `modulo` (`codigo`, `modulo`, `controladores`, `estado`) VALUES(3, 'Usuarios', 'RolController', 1);
INSERT INTO `modulo` (`codigo`, `modulo`, `controladores`, `estado`) VALUES(4, 'Categorias', 'TeminoController', 1);

--
-- Volcado de datos para la tabla `accion`
--

INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(3, 'Venta de productos', 'Esta acción corresponde a la autorización de venta en los diferentes punto de venta asignados', 2, 'PuntoVenta-sale-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(4, 'Creación de Punto de venta', 'Esta acción corresponde a la opción de creación de puntos de venta', 2, 'PuntoVenta-create-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(5, 'Busqueda de usuarios', '', 3, 'Usuario-view-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(6, 'Creacion de usuarios', '', 3, 'Usuario-create-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(7, 'Edicion de usuarios', '', 3, 'Usuario-update-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(8, 'Eliminacion de usuario', '', 3, 'Usuario-delete-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(9, 'Busqueda de roles', '', 3, 'Rol-view-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(10, 'Creacion de roles', '', 3, 'Rol-create-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(11, 'Edicion de roles', '', 3, 'Rol-update-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(12, 'Eliminacion de roles', '', 3, 'Rol-delete-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(13, 'Busqueda de puntos de venta', '', 2, 'PuntoVenta-view-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(14, 'Edicion de puntos de venta', '', 2, 'PuntoVenta-update-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(15, 'Eliminacion de puntos de venta', '', 2, 'PuntoVenta-delete-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(16, 'Busqueda de terminos', '', 4, 'Termino-view-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(17, 'Creacion de terminos', '', 4, 'Termino-create-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(18, 'Edicion de termnos', '', 4, 'Termino-update-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(19, 'Eliminacion de terminos', '', 4, 'Termino-delete-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(20, 'Autorizar gastos del punto de venta', 'esta accion es la que permite manejar la parte de autorización de gastos sobre los puntos de venta ligados al usuario', 2, 'Gasto-authorizeExpendit-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(21, 'registrar gastos', 'registrar gastos', 2, 'Gasto-create-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(22, 'Editar gastos', 'Editar gastos', 2, 'Gasto-update-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(23, 'Busqueda de gastos', 'Busqueda de gastos', 2, 'Gasto-view-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(24, 'Eliminar gastos', 'Eliminar gastos', 2, 'Gasto-delete-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(25, 'ver ingresos', 'esta accion corresponde a la vista de ingresos', 2, 'Ingreso-view-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(26, 'creacion de ingresos', 'registro de ingresos de un punto de venta', 2, 'Ingreso-create-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(27, 'edicion de ingresosos', 'edicion de ingresos de un punto de venta', 2, 'Ingreso-update-*');
INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES(28, 'eliminacion de ingresos de un punto de venta', 'eliminacion de ingresos de puntos de venta', 2, 'Ingreso-delete-*');

--
-- Volcado de datos para la tabla `punto_venta`
--

INSERT INTO `punto_venta` (`codigo`, `Whatsapp`, `telefono`, `extension`, `pais`, `ciudad`, `barrio`, `direccion`, `lugar`, `local`, `estado`) VALUES(12, 316825001, 0, '', 'Colombia', 'Bogota', 'San Victorino', 'calle 10 # 9A - 18', 'Edificio Ecuador', '102', 1);
INSERT INTO `punto_venta` (`codigo`, `Whatsapp`, `telefono`, `extension`, `pais`, `ciudad`, `barrio`, `direccion`, `lugar`, `local`, `estado`) VALUES(15, 123456890, 123456, '345', 'Colombia', 'Bogota', 'elenita', 'cra 12 # 55 a 23', 'edificio 22', '123', 1);
INSERT INTO `punto_venta` (`codigo`, `Whatsapp`, `telefono`, `extension`, `pais`, `ciudad`, `barrio`, `direccion`, `lugar`, `local`, `estado`) VALUES(18, 212321, 2345325, '23452345', 'sdfasd', 'adsfsa', 'sdafasd', 'asdfasd', 'asdfdsaf', 'asdff', 1);

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`codigo`, `nombre`, `estado`) VALUES(1, 'Administrador', 1);
INSERT INTO `rol` (`codigo`, `nombre`, `estado`) VALUES(2, 'Administrador de punto de venta', 1);
INSERT INTO `rol` (`codigo`, `nombre`, `estado`) VALUES(3, 'Vendedor', 1);

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codigo`, `identificacion`, `nombre`, `apellido`, `telefono`, `email`, `fecha_nacimiento`, `sexo`, `usuario`, `contrasena`, `rol`, `estado`) VALUES(3, 1029384756, 'Super', 'Usuario', 123456789, 'superadmin@aliah.com', '1995-09-16', 1, 'aliah', 'MTIzNDU2Nzg5MA==', 1, 5);
INSERT INTO `usuario` (`codigo`, `identificacion`, `nombre`, `apellido`, `telefono`, `email`, `fecha_nacimiento`, `sexo`, `usuario`, `contrasena`, `rol`, `estado`) VALUES(5, 1234567890, 'diego fernando', 'gonzalez velandia', 6938335, 'diego.gonzalez@gmail.com', '1998-06-13', 1, 'diego.gonzalez', 'TVRJek5EVT0=', 1, 3);

--
-- Volcado de datos para la tabla `usuario_punto_venta`
--

INSERT INTO `usuario_punto_venta` (`codigo`, `usuario`, `punto_venta`, `estado`) VALUES(8, 5, 15, 1);
INSERT INTO `usuario_punto_venta` (`codigo`, `usuario`, `punto_venta`, `estado`) VALUES(15, 3, 15, 1);
INSERT INTO `usuario_punto_venta` (`codigo`, `usuario`, `punto_venta`, `estado`) VALUES(16, 3, 18, 1);
INSERT INTO `usuario_punto_venta` (`codigo`, `usuario`, `punto_venta`, `estado`) VALUES(26, 3, 12, 1);


--
-- Volcado de datos para la tabla `accion_usuario`
--

INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(1, 3, 3, 0);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(2, 3, 5, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(3, 4, 5, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(4, 13, 5, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(5, 14, 5, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(6, 15, 5, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(7, 4, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(8, 5, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(9, 6, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(10, 7, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(11, 8, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(12, 9, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(13, 10, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(14, 11, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(15, 12, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(16, 13, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(17, 14, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(18, 15, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(19, 16, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(20, 17, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(21, 18, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(22, 19, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(23, 5, 5, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(24, 12, 5, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(25, 16, 5, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(26, 19, 5, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(27, 20, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(28, 21, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(29, 22, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(30, 23, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(31, 24, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(32, 25, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(33, 26, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(34, 27, 3, 1);
INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES(35, 28, 3, 1);

--
-- Volcado de datos para la tabla `gasto`
--

INSERT INTO `gasto` (`codigo`, `fecha`, `monto`, `usuario`, `descripcion`, `tipo_gasto`, `punto_venta`, `usuario_registro`, `fecha_registro`, `usuario_actualizacion`, `fecha_actualizacion`, `usuario_autorizador`, `fecha_autorizacion`, `estado`) VALUES(3, '2015-06-23', '200000', 3, 'gasto 1', 74, 15, 3, '2015-06-29 18:14:44', 3, '2015-07-29 02:25:33', 3, NULL, 75);

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`codigo`, `horario_apertura`, `hora_cierre`, `hora_max_cierre`, `dia`, `punto_venta`) VALUES(1, '08:00:00', '18:00:00', '18:00:00', 0, 18);
INSERT INTO `horario` (`codigo`, `horario_apertura`, `hora_cierre`, `hora_max_cierre`, `dia`, `punto_venta`) VALUES(2, '08:00:00', '18:00:00', '18:00:00', 1, 18);
INSERT INTO `horario` (`codigo`, `horario_apertura`, `hora_cierre`, `hora_max_cierre`, `dia`, `punto_venta`) VALUES(3, '08:00:00', '18:00:00', '18:00:00', 2, 18);
INSERT INTO `horario` (`codigo`, `horario_apertura`, `hora_cierre`, `hora_max_cierre`, `dia`, `punto_venta`) VALUES(4, '08:00:00', '18:00:00', '18:00:00', 3, 18);
INSERT INTO `horario` (`codigo`, `horario_apertura`, `hora_cierre`, `hora_max_cierre`, `dia`, `punto_venta`) VALUES(5, '08:00:00', '18:00:00', '18:00:00', 4, 18);
INSERT INTO `horario` (`codigo`, `horario_apertura`, `hora_cierre`, `hora_max_cierre`, `dia`, `punto_venta`) VALUES(6, '08:00:00', '18:00:00', '18:00:00', 5, 18);
INSERT INTO `horario` (`codigo`, `horario_apertura`, `hora_cierre`, `hora_max_cierre`, `dia`, `punto_venta`) VALUES(7, '08:00:00', '18:00:00', '18:00:00', 6, 18);

--
-- Volcado de datos para la tabla `ingreso`
--

INSERT INTO `ingreso` (`codigo`, `fecha_cierre_caja`, `fecha_llegada`, `cantidad`, `corresponde`, `igualado`, `usuario_pago`, `suma_anexada`, `descripcion`, `punto_venta`, `origen`, `destino`, `cantidad_esperada`, `tipo_ingreso`, `estado`, `usuario_autorizador`, `usuario_registro`, `fecha_registro`, `usuario_actualizacion`, `fecha_actualizacion`) VALUES(2, '2015-07-14', '2015-07-14', 50000, b'1', 1, 5, 0, 'dsfasd', 18, 12, 18, 50000, 77, 79, 3, 3, '2015-07-14', 3, '2015-07-28');
INSERT INTO `ingreso` (`codigo`, `fecha_cierre_caja`, `fecha_llegada`, `cantidad`, `corresponde`, `igualado`, `usuario_pago`, `suma_anexada`, `descripcion`, `punto_venta`, `origen`, `destino`, `cantidad_esperada`, `tipo_ingreso`, `estado`, `usuario_autorizador`, `usuario_registro`, `fecha_registro`, `usuario_actualizacion`, `fecha_actualizacion`) VALUES(3, '2015-07-14', '2015-07-14', 50000, b'1', NULL, 5, 0, 'safasdf', 18, 12, 18, 50000, 77, 79, 3, 3, '2015-07-14', 3, '2015-07-28');
INSERT INTO `ingreso` (`codigo`, `fecha_cierre_caja`, `fecha_llegada`, `cantidad`, `corresponde`, `igualado`, `usuario_pago`, `suma_anexada`, `descripcion`, `punto_venta`, `origen`, `destino`, `cantidad_esperada`, `tipo_ingreso`, `estado`, `usuario_autorizador`, `usuario_registro`, `fecha_registro`, `usuario_actualizacion`, `fecha_actualizacion`) VALUES(4, '2015-07-14', '2015-07-14', 50000, b'1', NULL, 5, 0, 'asfsdf', 18, 12, 18, 50000, 77, 82, 3, 3, '2015-07-14', 3, '2015-07-28');
INSERT INTO `ingreso` (`codigo`, `fecha_cierre_caja`, `fecha_llegada`, `cantidad`, `corresponde`, `igualado`, `usuario_pago`, `suma_anexada`, `descripcion`, `punto_venta`, `origen`, `destino`, `cantidad_esperada`, `tipo_ingreso`, `estado`, `usuario_autorizador`, `usuario_registro`, `fecha_registro`, `usuario_actualizacion`, `fecha_actualizacion`) VALUES(7, '2015-07-21', '2015-07-28', 700000, b'1', 1, 5, 100000, 'sgljkasdhglahsdjkgha', 18, 12, 18, 600000, 77, 81, 3, 3, '0000-00-00', 3, '2015-07-28');


--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codigo`, `nombre`, `descripcion`, `estado`, `categoria`, `imagen`, `fechaCreate`, `fechaMod`, `usuarioMod`, `usuarioCreate`) VALUES(7, 'pringuinos', 'consequat. Duis ute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 7, 6, 'NxitKJBtQ9AB8Ls4msSHFc7I3duc8Jdk.jpg', '2015-05-24 17:26:38', '2015-05-24 17:26:38', 3, 3);
INSERT INTO `producto` (`codigo`, `nombre`, `descripcion`, `estado`, `categoria`, `imagen`, `fechaCreate`, `fechaMod`, `usuarioMod`, `usuarioCreate`) VALUES(8, 'desiertos', 'consequat. Duis ute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 7, 6, 'HUfoAXY71m3MCPvAarxc9OJxXzZL_VU1.jpg', '2015-05-27 00:40:42', '2015-05-27 00:40:42', 3, 3);
INSERT INTO `producto` (`codigo`, `nombre`, `descripcion`, `estado`, `categoria`, `imagen`, `fechaCreate`, `fechaMod`, `usuarioMod`, `usuarioCreate`) VALUES(9, 'data', 'consequat. Duis ute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 7, 63, '4hHbFoMyqv03UGH_tw3gjRda6ZbHn9lI.jpg', '2015-07-28 21:03:29', '2015-07-28 21:03:29', 3, 3);