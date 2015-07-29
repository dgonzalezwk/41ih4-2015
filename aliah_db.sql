SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `accion` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `accion` varchar(100) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `modulo` int(11) DEFAULT NULL,
  `key` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `modulo` (`modulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

CREATE TABLE IF NOT EXISTS `accion_usuario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `accion` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `accion` (`accion`),
  KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

CREATE TABLE IF NOT EXISTS `cliente` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `info` tinyint(1) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `tipo` (`tipo`),
  KEY `sexo` (`sexo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `factura` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `punto_venta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `metodo_pago` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `metodo_pago` (`metodo_pago`),
  KEY `punto_venta` (`punto_venta`),
  KEY `usuario` (`usuario`),
  KEY `cliente` (`cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `factura_ganadora` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `sorteo` int(11) NOT NULL,
  `factura` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `estado` (`estado`),
  KEY `factura` (`factura`),
  KEY `sorteo` (`sorteo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `gasto` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `monto` varchar(12) NOT NULL,
  `usuario` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `tipo_gasto` int(11) NOT NULL,
  `punto_venta` int(11) NOT NULL,
  `usuario_registro` int(11) NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_actualizacion` int(11) DEFAULT NULL,
  `fecha_actualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usuario_autorizador` int(11) DEFAULT NULL,
  `fecha_autorizacion` timestamp NULL DEFAULT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `usuario` (`usuario`),
  KEY `tipo_gasto` (`tipo_gasto`),
  KEY `punto_venta` (`punto_venta`),
  KEY `usuario_registro` (`usuario_registro`),
  KEY `usuario_actualizacion` (`usuario_actualizacion`),
  KEY `usuario_autorizador` (`usuario_autorizador`,`estado`),
  KEY `estado` (`estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `horario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `horario_apertura` time NOT NULL,
  `hora_cierre` time NOT NULL,
  `hora_max_cierre` time NOT NULL,
  `dia` int(11) NOT NULL,
  `punto_venta` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `punto_venta` (`punto_venta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

CREATE TABLE IF NOT EXISTS `ingreso` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `fecha_actualizacion` date NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `usuario_pago` (`usuario_pago`),
  KEY `usuario_registro` (`usuario_registro`),
  KEY `usuario_actualizacion` (`usuario_actualizacion`),
  KEY `origen` (`origen`),
  KEY `destino` (`destino`),
  KEY `tipo_ingreso` (`tipo_ingreso`),
  KEY `estado` (`estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `inventario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `usuario_registro` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `usuario_registro` (`usuario_registro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `item_factura` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `factura` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `factura` (`factura`),
  KEY `producto` (`producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `item_inventario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `lote` int(11) NOT NULL,
  `inventario` int(11) NOT NULL,
  `cantidad_actual` mediumint(9) NOT NULL,
  `cantidad_reportada` mediumint(9) NOT NULL,
  `cooresponde` tinyint(1) NOT NULL,
  `igualado` tinyint(1) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `lote` (`lote`),
  KEY `inventario` (`inventario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `lote` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `producto` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `talla` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `cantidad_entregada` mediumint(9) NOT NULL,
  `cantidad_defectuasa` mediumint(9) NOT NULL,
  `cantidad_esperada` mediumint(9) NOT NULL,
  `precio_unidad` varchar(12) NOT NULL,
  `precio_mayor` varchar(12) NOT NULL,
  `origen` int(11) NOT NULL,
  `destino` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `tipo` (`tipo`),
  KEY `estado` (`estado`),
  KEY `origen` (`origen`),
  KEY `destino` (`destino`),
  KEY `producto` (`producto`),
  KEY `talla` (`talla`),
  KEY `color` (`color`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `modulo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(30) NOT NULL,
  `controladores` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `producto` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `fechaCreate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaMod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuarioMod` int(11) DEFAULT NULL,
  `usuarioCreate` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `estado` (`estado`),
  KEY `categoria` (`categoria`),
  KEY `usuariomod` (`usuarioMod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `punto_venta` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Whatsapp` int(11) DEFAULT NULL,
  `telefono` int(10) NOT NULL,
  `extension` varchar(20) DEFAULT NULL,
  `pais` varchar(15) NOT NULL,
  `ciudad` varchar(15) NOT NULL,
  `barrio` varchar(25) NOT NULL,
  `direccion` varchar(25) NOT NULL,
  `lugar` varchar(25) DEFAULT NULL,
  `local` varchar(5) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

CREATE TABLE IF NOT EXISTS `rol` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `sorteo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `dia` date NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `termino` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `termino` varchar(30) NOT NULL,
  `key` int(11) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

CREATE TABLE IF NOT EXISTS `tipo_cliente` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(10) NOT NULL,
  `cantidad_compras` mediumint(9) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
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
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `rol` (`rol`),
  KEY `sexo` (`sexo`),
  KEY `estado` (`estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

CREATE TABLE IF NOT EXISTS `usuario_punto_venta` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) NOT NULL,
  `punto_venta` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `usuario` (`usuario`,`punto_venta`),
  KEY `punto_venta` (`punto_venta`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;


ALTER TABLE `accion`
  ADD CONSTRAINT `accion_ibfk_1` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `accion_usuario`
  ADD CONSTRAINT `accion_usuario_ibfk_1` FOREIGN KEY (`accion`) REFERENCES `accion` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accion_usuario_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo_cliente` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`sexo`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`metodo_pago`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `factura_ganadora`
  ADD CONSTRAINT `factura_ganadora_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ganadora_ibfk_2` FOREIGN KEY (`factura`) REFERENCES `factura` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ganadora_ibfk_3` FOREIGN KEY (`sorteo`) REFERENCES `sorteo` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `gasto`
  ADD CONSTRAINT `gasto_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gasto_ibfk_3` FOREIGN KEY (`tipo_gasto`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gasto_ibfk_4` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gasto_ibfk_5` FOREIGN KEY (`usuario_registro`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gasto_ibfk_6` FOREIGN KEY (`usuario_actualizacion`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gasto_ibfk_7` FOREIGN KEY (`usuario_autorizador`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gasto_ibfk_8` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `ingreso`
  ADD CONSTRAINT `ingreso_ibfk_2` FOREIGN KEY (`usuario_pago`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingreso_ibfk_3` FOREIGN KEY (`usuario_registro`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingreso_ibfk_4` FOREIGN KEY (`usuario_actualizacion`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingreso_ibfk_5` FOREIGN KEY (`origen`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingreso_ibfk_6` FOREIGN KEY (`destino`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingreso_ibfk_7` FOREIGN KEY (`tipo_ingreso`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingreso_ibfk_8` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`usuario_registro`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `item_factura`
  ADD CONSTRAINT `item_factura_ibfk_1` FOREIGN KEY (`factura`) REFERENCES `factura` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_factura_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `lote` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `item_inventario`
  ADD CONSTRAINT `item_inventario_ibfk_1` FOREIGN KEY (`lote`) REFERENCES `lote` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_inventario_ibfk_2` FOREIGN KEY (`inventario`) REFERENCES `inventario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `lote`
  ADD CONSTRAINT `lote_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lote_ibfk_2` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lote_ibfk_3` FOREIGN KEY (`origen`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lote_ibfk_4` FOREIGN KEY (`destino`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lote_ibfk_5` FOREIGN KEY (`producto`) REFERENCES `producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lote_ibfk_8` FOREIGN KEY (`color`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lote_ibfk_9` FOREIGN KEY (`talla`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`usuariomod`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`sexo`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `usuario_punto_venta`
  ADD CONSTRAINT `usuario_punto_venta_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_punto_venta_ibfk_2` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES
(1, 'Masculino', 1, 'sexo', 'este termino corresponde a la categoria sexo al sexo masculino', 1),
(2, 'Femenino', 2, 'sexo', 'este termino corresponde a la categoria sexo al sexo femennino', 1),
(3, 'Activo', 1, 'Estados De Usuario', 'Este termino hace referencia a el estado activo de un usuario', 1),
(4, 'Inactivo', 2, 'Estados De Usuario', 'Este termino hace referencia a el estado Inactivo de un usuario', 1),
(5, 'Eliminado', 3, 'Estados De Usuario', 'Este termino hace referencia a el estado activo de un usuario', 1),
(6, 'No identificado', 0, 'Categoria De Producto', 'Este termino corresponde a el estado no identificado de categorias de producto', 1),
(7, 'Activo', 1, 'Estados De Producto', 'este es el estado activo un producto', 1),
(8, 'Bebe', 0, 'Talla', 'Talla de bebe', 1),
(9, 'Bebe', 2, 'Talla', 'Talla de bebe', 1),
(10, 'Bebe', 4, 'Talla', 'Talla de bebe', 1),
(11, 'Niña', 6, 'Talla', 'Talla de niña', 1),
(12, 'Nina', 8, 'Talla', 'Talla de nina', 1),
(13, 'Niña', 10, 'Talla', 'Talla de niña', 1),
(14, 'Teens', 12, 'Talla', 'Talla de teens', 1),
(15, 'Teens', 14, 'Talla', 'Talla de teens', 1),
(16, 'Teens', 16, 'Talla', 'Talla de teens', 1),
(17, 'Small', 18, 'Talla', 'Talla de small', 1),
(18, 'Medium', 20, 'Talla', 'Talla de medium', 1),
(19, 'Large', 22, 'Talla', 'Talla de large', 1),
(20, 'Extra large', 24, 'Talla', 'Talla de extra large', 1),
(21, 'Doble extra large', 26, 'Talla', 'Talla de doble extra large', 1),
(22, 'Estándar', 28, 'Talla', 'Talla de estándar', 1),
(23, 'No identificado', 0, 'Color', 'color No identificado', 1),
(24, 'Negro', 10, 'Color', 'color Negro', 1),
(25, 'Gris', 11, 'Color', 'color Gris', 1),
(26, 'Plata', 12, 'Color', 'color Plata', 1),
(27, 'Blanco', 13, 'Color', 'color Blanco', 1),
(28, 'Perla', 14, 'Color', 'color Perla', 1),
(29, 'Fuxia', 15, 'Color', 'color Fuxia', 1),
(30, 'Rosado', 16, 'Color', 'color Rosado', 1),
(31, 'Camote', 17, 'Color', 'color Camote', 1),
(32, 'Barney', 18, 'Color', 'color Barney', 1),
(33, 'Lila', 19, 'Color', 'color Lila', 1),
(34, 'Melon', 20, 'Color', 'color Melon', 1),
(35, 'Coral', 21, 'Color', 'color Coral', 1),
(36, 'Naranja', 22, 'Color', 'color Naranja', 1),
(37, 'Rojo', 23, 'Color', 'color Rojo', 1),
(38, 'Vino', 24, 'Color', 'color Vino', 1),
(39, 'Verde menta', 25, 'Color', 'color Verde menta', 1),
(40, 'Verde agua', 26, 'Color', 'color Verde agua', 1),
(41, 'Turqueza', 27, 'Color', 'color Turqueza', 1),
(42, 'Jade', 28, 'Color', 'color Jade', 1),
(43, 'Azulino', 29, 'Color', 'color Azulino', 1),
(44, 'Azul noche', 30, 'Color', 'color Azul noche', 1),
(45, 'Dorado', 31, 'Color', 'color Dorado', 1),
(46, 'Marron', 32, 'Color', 'color Marron', 1),
(47, 'Verde noche', 33, 'Color', 'color Verde noche', 1),
(48, 'Verde manzana', 34, 'Color', 'color Verde manzana', 1),
(49, 'Verde esmeralda', 35, 'Color', 'color Verde esmeralda', 1),
(50, 'Bautizo', 10, 'Categoria De Producto', 'Categria de producto Bautizo', 1),
(51, 'Paje', 11, 'Categoria De Producto', 'Categria de producto Paje', 1),
(52, 'Primera comunion', 12, 'Categoria De Producto', 'Categria de producto Primera comunion', 1),
(53, 'Niña', 13, 'Categoria De Producto', 'Categria de producto Niña', 1),
(54, 'Teens', 14, 'Categoria De Producto', 'Categria de producto Teens', 1),
(55, 'Quince', 15, 'Categoria De Producto', 'Categria de producto Quince', 1),
(56, 'Novia', 16, 'Categoria De Producto', 'Categria de producto Novia', 1),
(57, 'Dama', 17, 'Categoria De Producto', 'Categria de producto Dama', 1),
(58, 'Señoreal', 18, 'Categoria De Producto', 'Categria de producto Señoreal', 1),
(59, 'Conjunto', 19, 'Categoria De Producto', 'Categria de producto Conjunto', 1),
(60, 'Enterizo', 20, 'Categoria De Producto', 'Categria de producto Enterizo', 1),
(61, 'Casual', 21, 'Categoria De Producto', 'Categria de producto Casual', 1),
(62, 'Bluzas', 22, 'Categoria De Producto', 'Categria de producto Bluzas', 1),
(63, 'Pantalon', 23, 'Categoria De Producto', 'Categria de producto Pantalon', 1),
(64, 'Falda', 24, 'Categoria De Producto', 'Categria de producto Falda', 1),
(65, 'Accesorios', 25, 'Categoria De Producto', 'Categria de producto Accesorios', 1),
(66, 'Corsel', 26, 'Categoria De Producto', 'Categria de producto Corsel', 1),
(67, 'No identificado', 0, 'Detalle de producto', 'Detalle de producto No identificado', 1),
(68, 'Corto ', 1, 'Detalle de producto', 'Detalle de producto Corto ', 1),
(69, 'Campana', 2, 'Detalle de producto', 'Detalle de producto Campana', 1),
(70, 'Largo', 3, 'Detalle de producto', 'Detalle de producto Largo', 1),
(71, 'Cola de pato', 4, 'Detalle de producto', 'Detalle de producto Cola de pato', 1),
(72, '3/4', 5, 'Detalle de producto', 'Detalle de producto 3/4', 1),
(73, 'Entallado', 6, 'Detalle de producto', 'Detalle de producto Entallado', 1),
(74, 'Gastos de envio', 1, 'Tipos De Gastos', 'Gasto de envió', 1),
(75, 'Por Autorizar', 1, 'Estado De Gasto', 'este es el estado del gasto por autorizar', 1),
(76, 'Autorizado', 2, 'Estado De Gasto', 'estado autorizado de los gastos generados en el punto de venta', 1),
(77, 'Comun', 1, 'Tipo De Ingresos', 'este estado corresponde a un ingreso comun el cual puede generarse en cualquier momento', 1),
(78, 'Cierre de caja', 2, 'Tipo De Ingresos', 'este estado corresponde a las ganancias en un día que se generan en un punto de venta.', 1),
(79, 'Correcto', 1, 'Estado De Ingresos', 'este es el estado que se asigna a el ingreso en caso que la cantidad de entrada concuerde con la cantidad ingresada', 1),
(80, 'Menor', 2, 'Estado De Ingresos', 'este es el estado que se asigna a el ingreso en caso que la cantidad de entrada sea menor a la cantidad ingresada', 1),
(81, 'Mayor', 3, 'Estado De Ingresos', 'este es el estado que se asigna a el ingreso en caso que la cantidad de entrada  sea mayor a la cantidad ingresada', 1),
(82, 'autorizado', 4, 'Estado De Ingresos', 'este es el estado que se asigna a el ingreso en caso de que este se autorice, despues de esto no se podra editar', 1);

INSERT INTO `modulo` (`codigo`, `modulo`, `controladores`, `estado`) VALUES
(2, 'Puntos De venta', 'PuntoVentaController', 1),
(3, 'Usuarios', 'RolController', 1),
(4, 'Categorias', 'TeminoController', 1);

INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES
(3, 'Venta de productos', 'Esta acción corresponde a la autorización de venta en los diferentes punto de venta asignados', 2, 'PuntoVenta-sale-*'),
(4, 'Creación de Punto de venta', 'Esta acción corresponde a la opción de creación de puntos de venta', 2, 'PuntoVenta-create-*'),
(5, 'Busqueda de usuarios', '', 3, 'Usuario-view-*'),
(6, 'Creacion de usuarios', '', 3, 'Usuario-create-*'),
(7, 'Edicion de usuarios', '', 3, 'Usuario-update-*'),
(8, 'Eliminacion de usuario', '', 3, 'Usuario-delete-*'),
(9, 'Busqueda de roles', '', 3, 'Rol-view-*'),
(10, 'Creacion de roles', '', 3, 'Rol-create-*'),
(11, 'Edicion de roles', '', 3, 'Rol-update-*'),
(12, 'Eliminacion de roles', '', 3, 'Rol-delete-*'),
(13, 'Busqueda de puntos de venta', '', 2, 'PuntoVenta-view-*'),
(14, 'Edicion de puntos de venta', '', 2, 'PuntoVenta-update-*'),
(15, 'Eliminacion de puntos de venta', '', 2, 'PuntoVenta-delete-*'),
(16, 'Busqueda de terminos', '', 4, 'Termino-view-*'),
(17, 'Creacion de terminos', '', 4, 'Termino-create-*'),
(18, 'Edicion de termnos', '', 4, 'Termino-update-*'),
(19, 'Eliminacion de terminos', '', 4, 'Termino-delete-*'),
(20, 'Autorizar gastos del punto de venta', 'esta accion es la que permite manejar la parte de autorización de gastos sobre los puntos de venta ligados al usuario', 2, 'Gasto-authorizeExpendit-*'),
(21, 'registrar gastos', 'registrar gastos', 2, 'Gasto-create-*'),
(22, 'Editar gastos', 'Editar gastos', 2, 'Gasto-update-*'),
(23, 'Busqueda de gastos', 'Busqueda de gastos', 2, 'Gasto-view-*'),
(24, 'Eliminar gastos', 'Eliminar gastos', 2, 'Gasto-delete-*'),
(25, 'ver ingresos', 'esta accion corresponde a la vista de ingresos', 2, 'Ingreso-view-*'),
(26, 'creacion de ingresos', 'registro de ingresos de un punto de venta', 2, 'Ingreso-create-*'),
(27, 'edicion de ingresosos', 'edicion de ingresos de un punto de venta', 2, 'Ingreso-update-*'),
(28, 'eliminacion de ingresos de un punto de venta', 'eliminacion de ingresos de puntos de venta', 2, 'Ingreso-delete-*');

INSERT INTO `punto_venta` (`codigo`, `Whatsapp`, `telefono`, `extension`, `pais`, `ciudad`, `barrio`, `direccion`, `lugar`, `local`, `estado`) VALUES
(12, 316825001, 0, '', 'Colombia', 'Bogota', 'San Victorino', 'calle 10 # 9A - 18', 'Edificio Ecuador', '102', 1),
(15, 123456890, 123456, '345', 'Colombia', 'Bogota', 'elenita', 'cra 12 # 55 a 23', 'edificio 22', '123', 1),
(18, 212321, 2345325, '23452345', 'sdfasd', 'adsfsa', 'sdafasd', 'asdfasd', 'asdfdsaf', 'asdff', 1);

INSERT INTO `rol` (`codigo`, `nombre`, `estado`) VALUES
(1, 'Administrador', 1),
(2, 'Administrador de punto de venta', 1),
(3, 'Vendedor', 1);

INSERT INTO `usuario` (`codigo`, `identificacion`, `nombre`, `apellido`, `telefono`, `email`, `fecha_nacimiento`, `sexo`, `usuario`, `contrasena`, `rol`, `estado`) VALUES
(3, 1029384756, 'Super', 'Usuario', 0, 'superadmin@aliah.com', '1995-09-16', 1, 'aliah', 'MTIzNDU2Nzg5MA==', 1, 5),
(5, 1234567890, 'diego fernando', 'gonzalez velandia', 6938335, 'diego.gonzalez@gmail.com', '1998-06-13', 1, 'diego.gonzalez', 'TVRJek5EVT0=', 1, 3);

INSERT INTO `usuario_punto_venta` (`codigo`, `usuario`, `punto_venta`, `estado`) VALUES
(8, 5, 15, 1),
(15, 3, 15, 1),
(16, 3, 18, 1),
(26, 3, 12, 1);

INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES
(1, 3, 3, 0),
(2, 3, 5, 1),
(3, 4, 5, 1),
(4, 13, 5, 1),
(5, 14, 5, 1),
(6, 15, 5, 1),
(7, 4, 3, 1),
(8, 5, 3, 1),
(9, 6, 3, 1),
(10, 7, 3, 1),
(11, 8, 3, 1),
(12, 9, 3, 1),
(13, 10, 3, 1),
(14, 11, 3, 1),
(15, 12, 3, 1),
(16, 13, 3, 1),
(17, 14, 3, 1),
(18, 15, 3, 1),
(19, 16, 3, 1),
(20, 17, 3, 1),
(21, 18, 3, 1),
(22, 19, 3, 1),
(23, 5, 5, 1),
(24, 12, 5, 1),
(25, 16, 5, 1),
(26, 19, 5, 1),
(27, 20, 3, 1),
(28, 21, 3, 1),
(29, 22, 3, 1),
(30, 23, 3, 1),
(31, 24, 3, 1),
(32, 25, 3, 1),
(33, 26, 3, 1),
(34, 27, 3, 1),
(35, 28, 3, 1);

INSERT INTO `gasto` (`codigo`, `fecha`, `monto`, `usuario`, `descripcion`, `tipo_gasto`, `punto_venta`, `usuario_registro`, `fecha_registro`, `usuario_actualizacion`, `fecha_actualizacion`, `usuario_autorizador`, `fecha_autorizacion`, `estado`) VALUES
(3, '2015-06-23', '200000', 3, 'gasto 1', 74, 15, 3, '2015-06-29 18:14:44', 3, '2015-07-28 22:31:04', 3, NULL, 76);

INSERT INTO `horario` (`codigo`, `horario_apertura`, `hora_cierre`, `hora_max_cierre`, `dia`, `punto_venta`) VALUES
(1, '08:00:00', '18:00:00', '18:00:00', 0, 18),
(2, '08:00:00', '18:00:00', '18:00:00', 1, 18),
(3, '08:00:00', '18:00:00', '18:00:00', 2, 18),
(4, '08:00:00', '18:00:00', '18:00:00', 3, 18),
(5, '08:00:00', '18:00:00', '18:00:00', 4, 18),
(6, '08:00:00', '18:00:00', '18:00:00', 5, 18),
(7, '08:00:00', '18:00:00', '18:00:00', 6, 18);

INSERT INTO `producto` (`codigo`, `nombre`, `descripcion`, `estado`, `categoria`, `imagen`, `fechaCreate`, `fechaMod`, `usuarioMod`, `usuarioCreate`) VALUES
(7, 'pringuinos', 'consequat. Duis ute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 7, 6, 'dQWf-qFj17GAA7ZhQ-tZ4KjeGRzccrP4.jpg', '2015-05-24 17:26:38', '2015-05-24 17:26:38', 3, 3),
(8, 'desiertos', 'consequat. Duis ute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 7, 6, 'HUfoAXY71m3MCPvAarxc9OJxXzZL_VU1.jpg', '2015-05-27 00:40:42', '2015-05-27 00:40:42', 3, 3),
(9, 'data', 'consequat. Duis ute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 7, 63, '4hHbFoMyqv03UGH_tw3gjRda6ZbHn9lI.jpg', '2015-07-28 21:03:29', '2015-07-28 21:03:29', 3, 3);


INSERT INTO `ingreso` (`codigo`, `fecha_cierre_caja`, `fecha_llegada`, `cantidad`, `corresponde`, `igualado`, `usuario_pago`, `suma_anexada`, `descripcion`, `punto_venta`, `origen`, `destino`, `cantidad_esperada`, `tipo_ingreso`, `estado`, `usuario_autorizador`, `usuario_registro`, `fecha_registro`, `usuario_actualizacion`, `fecha_actualizacion`) VALUES
(2, '2015-07-14', '2015-07-14', 50000, b'1', 1, 5, 0, 'dsfasd', 18, 12, 18, 50000, 77, 79, 3, 3, '2015-07-14', 3, '2015-07-28'),
(3, '2015-07-14', '2015-07-14', 50000, b'1', NULL, 5, 0, 'safasdf', 18, 12, 18, 50000, 77, 82, 3, 3, '2015-07-14', 3, '2015-07-28'),
(4, '2015-07-14', '2015-07-14', 50000, b'1', NULL, 5, 0, 'asfsdf', 18, 12, 18, 50000, 77, 82, 3, 3, '2015-07-14', 3, '2015-07-28'),
(7, '2015-07-21', '2015-07-28', 700000, b'1', 1, 5, 100000, 'sgljkasdhglahsdjkgha', 18, 12, 18, 600000, 77, 81, 3, 3, '0000-00-00', 3, '2015-07-28');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;