-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2015 at 02:32 AM
-- Server version: 5.6.15-log
-- PHP Version: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `aliah`
--

-- --------------------------------------------------------

--
-- Table structure for table `accion`
--

CREATE TABLE IF NOT EXISTS `accion` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `accion` varchar(100) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `modulo` int(11) DEFAULT NULL,
  `key` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `modulo` (`modulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `accion`
--

INSERT INTO `accion` (`codigo`, `accion`, `descripcion`, `modulo`, `key`) VALUES
(3, 'Autorizacion de venta en San Victorino calle 10 # 9A - 18', 'Esta accion corresponde a la autorizacion de venta en San Victorino calle 10 # 9A - 18', 1, '1-PuntoVenta-sale-12'),
(4, 'Creación de Punto de venta', 'Esta acción corresponde a la opción de creación de puntos de venta', 2, '2-PuntoVenta-create-*');

-- --------------------------------------------------------

--
-- Table structure for table `accion_usuario`
--

CREATE TABLE IF NOT EXISTS `accion_usuario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `accion` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `accion` (`accion`),
  KEY `usuario` (`usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

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
  `estado` bit(1) NOT NULL,
  `info` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `tipo` (`tipo`),
  KEY `sexo` (`sexo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `factura`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `factura_ganadora`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `gasto`
--

CREATE TABLE IF NOT EXISTS `gasto` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `monto` varchar(12) NOT NULL,
  `usuario` int(11) NOT NULL,
  `usuario_autorizador` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `tipo_gasto` int(11) NOT NULL,
  `punto_venta` int(11) NOT NULL,
  `usuario_registro` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `usuario_actualizacion` int(11) NOT NULL,
  `fecha_actualizacion` date NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `usuario` (`usuario`),
  KEY `usuario_autorizador` (`usuario_autorizador`),
  KEY `tipo_gasto` (`tipo_gasto`),
  KEY `punto_venta` (`punto_venta`),
  KEY `usuario_registro` (`usuario_registro`),
  KEY `usuario_actualizacion` (`usuario_actualizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `horario_apertura` time NOT NULL,
  `hora_cierre` time NOT NULL,
  `hora_max_cierre` time NOT NULL,
  `dia` int(11) NOT NULL,
  `punto_venta` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `punto_venta` (`punto_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ingreso`
--

CREATE TABLE IF NOT EXISTS `ingreso` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_cierre_caja` date NOT NULL,
  `fecha_llegada` date NOT NULL,
  `cantidad` varchar(12) NOT NULL,
  `corresponde` bit(1) NOT NULL,
  `usuario_pago` int(11) NOT NULL,
  `usuario_autorizador` int(11) NOT NULL,
  `igualado` bit(1) NOT NULL,
  `suma_anexada` varchar(12) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `punto_venta` int(11) NOT NULL,
  `origen` int(11) NOT NULL,
  `destino` int(11) NOT NULL,
  `usuario_registro` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `usuario_actualizacion` int(11) NOT NULL,
  `fecha_actualizacion` date NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `usuario_autorizador` (`usuario_autorizador`),
  KEY `usuario_pago` (`usuario_pago`),
  KEY `usuario_registro` (`usuario_registro`),
  KEY `usuario_actualizacion` (`usuario_actualizacion`),
  KEY `origen` (`origen`),
  KEY `destino` (`destino`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE IF NOT EXISTS `inventario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `usuario_registro` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `usuario_registro` (`usuario_registro`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `item_factura`
--

CREATE TABLE IF NOT EXISTS `item_factura` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `factura` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `factura` (`factura`),
  KEY `producto` (`producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `item_inventario`
--

CREATE TABLE IF NOT EXISTS `item_inventario` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `lote` int(11) NOT NULL,
  `inventario` int(11) NOT NULL,
  `cantidad_actual` mediumint(9) NOT NULL,
  `cantidad_reportada` mediumint(9) NOT NULL,
  `cooresponde` bit(1) NOT NULL,
  `igualado` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `lote` (`lote`),
  KEY `inventario` (`inventario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lote`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `modulo`
--

CREATE TABLE IF NOT EXISTS `modulo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `modulo` varchar(30) NOT NULL,
  `controladores` varchar(255) NOT NULL,
  `estado` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `modulo`
--

INSERT INTO `modulo` (`codigo`, `modulo`, `controladores`, `estado`) VALUES
(1, 'Ventas', 'FacturaController', b'1'),
(2, 'Puntos De venta', 'PuntoVentaController', b'1'),
(3, 'Usuarios', 'RolController', b'1'),
(4, 'Categorias', 'TeminoController', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` int(50) NOT NULL,
  `descripcion` int(250) NOT NULL,
  `estado` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `fechamod` date NOT NULL,
  `usuariomod` int(11) NOT NULL,
  PRIMARY KEY (`codigo`),
  KEY `estado` (`estado`),
  KEY `categoria` (`categoria`),
  KEY `usuariomod` (`usuariomod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `punto_venta`
--

CREATE TABLE IF NOT EXISTS `punto_venta` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `Whatsapp` int(11) DEFAULT NULL,
  `telefono` varchar(21) NOT NULL,
  `extension` varchar(20) DEFAULT NULL,
  `pais` varchar(15) NOT NULL,
  `ciudad` varchar(15) NOT NULL,
  `barrio` varchar(25) NOT NULL,
  `direccion` varchar(25) NOT NULL,
  `lugar` varchar(25) DEFAULT NULL,
  `local` varchar(5) DEFAULT NULL,
  `estado` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `punto_venta`
--

INSERT INTO `punto_venta` (`codigo`, `Whatsapp`, `telefono`, `extension`, `pais`, `ciudad`, `barrio`, `direccion`, `lugar`, `local`, `estado`) VALUES
(12, 316825001, '(031) 341 6470', '', 'Colombia', 'Bogota', 'San Victorino', 'calle 10 # 9A - 18', 'Edificio Ecuador', '102', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `estado` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`codigo`, `nombre`, `estado`) VALUES
(1, 'Administrador', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sorteo`
--

CREATE TABLE IF NOT EXISTS `sorteo` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `dia` date NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `termino`
--

CREATE TABLE IF NOT EXISTS `termino` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `termino` varchar(30) NOT NULL,
  `key` int(11) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` bit(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `termino`
--

INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES
(1, 'Masculino', 1, 'sexo', 'este termino corresponde a la categoria sexo al sexo masculino', b'1'),
(2, 'Femenino', 2, 'sexo', 'este termino corresponde a la categoria sexo al sexo femennino', b'1'),
(3, 'Activo', 1, 'Estados De Usuario', 'Este termino hace referencia a el estado activo de un usuario', b'1'),
(4, 'Inactivo', 2, 'Estados De Usuario', 'Este termino hace referencia a el estado Inactivo de un usuario', b'1'),
(5, 'Eliminado', 3, 'Estados De Usuario', 'Este termino hace referencia a el estado activo de un usuario', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `tipo_cliente`
--

CREATE TABLE IF NOT EXISTS `tipo_cliente` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(10) NOT NULL,
  `cantidad_compras` mediumint(9) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

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
  KEY `rol` (`rol`),
  KEY `sexo` (`sexo`),
  KEY `estado` (`estado`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`codigo`, `identificacion`, `nombre`, `apellido`, `telefono`, `email`, `fecha_nacimiento`, `sexo`, `usuario`, `contrasena`, `rol`, `estado`) VALUES
(3, 1029384756, 'Super', 'Usuario', 0, 'superadmin@aliah.com', '0000-00-00', 1, 'aliah', 'MTAyOTM4NDc1Ng==', 1, 3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accion`
--
ALTER TABLE `accion`
  ADD CONSTRAINT `accion_ibfk_1` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`codigo`);

--
-- Constraints for table `accion_usuario`
--
ALTER TABLE `accion_usuario`
  ADD CONSTRAINT `accion_usuario_ibfk_1` FOREIGN KEY (`accion`) REFERENCES `accion` (`codigo`),
  ADD CONSTRAINT `accion_usuario_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`);

--
-- Constraints for table `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo_cliente` (`codigo`),
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`sexo`) REFERENCES `termino` (`codigo`);

--
-- Constraints for table `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`metodo_pago`) REFERENCES `termino` (`codigo`),
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`),
  ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`),
  ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`codigo`);

--
-- Constraints for table `factura_ganadora`
--
ALTER TABLE `factura_ganadora`
  ADD CONSTRAINT `factura_ganadora_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`),
  ADD CONSTRAINT `factura_ganadora_ibfk_2` FOREIGN KEY (`factura`) REFERENCES `factura` (`codigo`),
  ADD CONSTRAINT `factura_ganadora_ibfk_3` FOREIGN KEY (`sorteo`) REFERENCES `sorteo` (`codigo`);

--
-- Constraints for table `gasto`
--
ALTER TABLE `gasto`
  ADD CONSTRAINT `gasto_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`),
  ADD CONSTRAINT `gasto_ibfk_2` FOREIGN KEY (`usuario_autorizador`) REFERENCES `usuario` (`codigo`),
  ADD CONSTRAINT `gasto_ibfk_3` FOREIGN KEY (`tipo_gasto`) REFERENCES `termino` (`codigo`),
  ADD CONSTRAINT `gasto_ibfk_4` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`),
  ADD CONSTRAINT `gasto_ibfk_5` FOREIGN KEY (`usuario_registro`) REFERENCES `usuario` (`codigo`),
  ADD CONSTRAINT `gasto_ibfk_6` FOREIGN KEY (`usuario_actualizacion`) REFERENCES `usuario` (`codigo`);

--
-- Constraints for table `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`);

--
-- Constraints for table `ingreso`
--
ALTER TABLE `ingreso`
  ADD CONSTRAINT `ingreso_ibfk_1` FOREIGN KEY (`usuario_autorizador`) REFERENCES `usuario` (`codigo`),
  ADD CONSTRAINT `ingreso_ibfk_2` FOREIGN KEY (`usuario_pago`) REFERENCES `usuario` (`codigo`),
  ADD CONSTRAINT `ingreso_ibfk_3` FOREIGN KEY (`usuario_registro`) REFERENCES `usuario` (`codigo`),
  ADD CONSTRAINT `ingreso_ibfk_4` FOREIGN KEY (`usuario_actualizacion`) REFERENCES `usuario` (`codigo`),
  ADD CONSTRAINT `ingreso_ibfk_5` FOREIGN KEY (`origen`) REFERENCES `punto_venta` (`codigo`),
  ADD CONSTRAINT `ingreso_ibfk_6` FOREIGN KEY (`destino`) REFERENCES `punto_venta` (`codigo`);

--
-- Constraints for table `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`usuario_registro`) REFERENCES `usuario` (`codigo`);

--
-- Constraints for table `item_factura`
--
ALTER TABLE `item_factura`
  ADD CONSTRAINT `item_factura_ibfk_1` FOREIGN KEY (`factura`) REFERENCES `factura` (`codigo`),
  ADD CONSTRAINT `item_factura_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `producto` (`codigo`);

--
-- Constraints for table `item_inventario`
--
ALTER TABLE `item_inventario`
  ADD CONSTRAINT `item_inventario_ibfk_1` FOREIGN KEY (`lote`) REFERENCES `lote` (`codigo`),
  ADD CONSTRAINT `item_inventario_ibfk_2` FOREIGN KEY (`inventario`) REFERENCES `inventario` (`codigo`);

--
-- Constraints for table `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `lote_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `termino` (`codigo`),
  ADD CONSTRAINT `lote_ibfk_2` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`),
  ADD CONSTRAINT `lote_ibfk_3` FOREIGN KEY (`origen`) REFERENCES `punto_venta` (`codigo`),
  ADD CONSTRAINT `lote_ibfk_4` FOREIGN KEY (`destino`) REFERENCES `punto_venta` (`codigo`),
  ADD CONSTRAINT `lote_ibfk_5` FOREIGN KEY (`producto`) REFERENCES `producto` (`codigo`),
  ADD CONSTRAINT `lote_ibfk_8` FOREIGN KEY (`color`) REFERENCES `termino` (`codigo`),
  ADD CONSTRAINT `lote_ibfk_9` FOREIGN KEY (`talla`) REFERENCES `termino` (`codigo`);

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `termino` (`codigo`),
  ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`usuariomod`) REFERENCES `usuario` (`codigo`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`codigo`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`sexo`) REFERENCES `termino` (`codigo`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;