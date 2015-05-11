-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: May 12, 2015 at 12:34 AM
-- Server version: 5.5.38
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `aliah`
--

-- --------------------------------------------------------

--
-- Table structure for table `accion`
--

CREATE TABLE `accion` (
`codigo` int(11) NOT NULL,
  `accion` varchar(100) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `modulo` int(11) DEFAULT NULL,
  `key` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

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

CREATE TABLE `accion_usuario` (
`codigo` int(11) NOT NULL,
  `accion` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accion_usuario`
--

INSERT INTO `accion_usuario` (`codigo`, `accion`, `usuario`, `estado`) VALUES
(9, 3, 14, 1),
(10, 4, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cliente`
--

CREATE TABLE `cliente` (
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
-- Table structure for table `factura`
--

CREATE TABLE `factura` (
`codigo` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `punto_venta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `metodo_pago` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `factura_ganadora`
--

CREATE TABLE `factura_ganadora` (
`codigo` int(11) NOT NULL,
  `sorteo` int(11) NOT NULL,
  `factura` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gasto`
--

CREATE TABLE `gasto` (
`codigo` int(11) NOT NULL,
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
  `fecha_actualizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `horario`
--

CREATE TABLE `horario` (
`codigo` int(11) NOT NULL,
  `horario_apertura` time NOT NULL,
  `hora_cierre` time NOT NULL,
  `hora_max_cierre` time NOT NULL,
  `dia` int(11) NOT NULL,
  `punto_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ingreso`
--

CREATE TABLE `ingreso` (
`codigo` int(11) NOT NULL,
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
  `fecha_actualizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventario`
--

CREATE TABLE `inventario` (
`codigo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `usuario_registro` int(11) NOT NULL,
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_factura`
--

CREATE TABLE `item_factura` (
`codigo` int(11) NOT NULL,
  `factura` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_inventario`
--

CREATE TABLE `item_inventario` (
`codigo` int(11) NOT NULL,
  `lote` int(11) NOT NULL,
  `inventario` int(11) NOT NULL,
  `cantidad_actual` mediumint(9) NOT NULL,
  `cantidad_reportada` mediumint(9) NOT NULL,
  `cooresponde` bit(1) NOT NULL,
  `igualado` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lote`
--

CREATE TABLE `lote` (
`codigo` int(11) NOT NULL,
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
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `modulo`
--

CREATE TABLE `modulo` (
`codigo` int(11) NOT NULL,
  `modulo` varchar(30) NOT NULL,
  `controladores` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modulo`
--

INSERT INTO `modulo` (`codigo`, `modulo`, `controladores`, `estado`) VALUES
(1, 'Ventas', 'FacturaController', 1),
(2, 'Puntos De venta', 'PuntoVentaController', 1),
(3, 'Usuarios', 'RolController', 1),
(4, 'Categorias', 'TeminoController', 1);

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
`codigo` int(11) NOT NULL,
  `nombre` int(50) NOT NULL,
  `descripcion` int(250) NOT NULL,
  `estado` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `fechamod` date NOT NULL,
  `usuariomod` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `punto_venta`
--

CREATE TABLE `punto_venta` (
`codigo` int(11) NOT NULL,
  `Whatsapp` int(11) DEFAULT NULL,
  `telefono` varchar(21) NOT NULL,
  `extension` varchar(20) DEFAULT NULL,
  `pais` varchar(15) NOT NULL,
  `ciudad` varchar(15) NOT NULL,
  `barrio` varchar(25) NOT NULL,
  `direccion` varchar(25) NOT NULL,
  `lugar` varchar(25) DEFAULT NULL,
  `local` varchar(5) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `punto_venta`
--

INSERT INTO `punto_venta` (`codigo`, `Whatsapp`, `telefono`, `extension`, `pais`, `ciudad`, `barrio`, `direccion`, `lugar`, `local`, `estado`) VALUES
(12, 316825001, '(031) 341 6470', '', 'Colombia', 'Bogota', 'San Victorino', 'calle 10 # 9A - 18', 'Edificio Ecuador', '102', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
`codigo` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`codigo`, `nombre`, `estado`) VALUES
(1, 'Administrador', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sorteo`
--

CREATE TABLE `sorteo` (
`codigo` int(11) NOT NULL,
  `dia` date NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `termino`
--

CREATE TABLE `termino` (
`codigo` int(11) NOT NULL,
  `termino` varchar(30) NOT NULL,
  `key` int(11) NOT NULL,
  `categoria` varchar(30) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `termino`
--

INSERT INTO `termino` (`codigo`, `termino`, `key`, `categoria`, `descripcion`, `estado`) VALUES
(1, 'Masculino', 1, 'sexo', 'este termino corresponde a la categoria sexo al sexo masculino', 1),
(2, 'Femenino', 2, 'sexo', 'este termino corresponde a la categoria sexo al sexo femennino', 1),
(3, 'Activo', 1, 'Estados De Usuario', 'Este termino hace referencia a el estado activo de un usuario', 1),
(4, 'Inactivo', 2, 'Estados De Usuario', 'Este termino hace referencia a el estado Inactivo de un usuario', 1),
(5, 'Eliminado', 3, 'Estados De Usuario', 'Este termino hace referencia a el estado activo de un usuario', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipo_cliente`
--

CREATE TABLE `tipo_cliente` (
`codigo` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `cantidad_compras` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`codigo`, `identificacion`, `nombre`, `apellido`, `telefono`, `email`, `fecha_nacimiento`, `sexo`, `usuario`, `contrasena`, `rol`, `estado`) VALUES
(14, 1029384756, 'Usuario', 'Super', 102938475, 'aliah.com.co', '1970-01-01', 1, 'aliah', 'MTIzNDU=', 1, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accion`
--
ALTER TABLE `accion`
 ADD PRIMARY KEY (`codigo`), ADD KEY `modulo` (`modulo`);

--
-- Indexes for table `accion_usuario`
--
ALTER TABLE `accion_usuario`
 ADD PRIMARY KEY (`codigo`), ADD KEY `accion` (`accion`), ADD KEY `usuario` (`usuario`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
 ADD PRIMARY KEY (`codigo`), ADD KEY `tipo` (`tipo`), ADD KEY `sexo` (`sexo`);

--
-- Indexes for table `factura`
--
ALTER TABLE `factura`
 ADD PRIMARY KEY (`codigo`), ADD KEY `metodo_pago` (`metodo_pago`), ADD KEY `punto_venta` (`punto_venta`), ADD KEY `usuario` (`usuario`), ADD KEY `cliente` (`cliente`);

--
-- Indexes for table `factura_ganadora`
--
ALTER TABLE `factura_ganadora`
 ADD PRIMARY KEY (`codigo`), ADD KEY `estado` (`estado`), ADD KEY `factura` (`factura`), ADD KEY `sorteo` (`sorteo`);

--
-- Indexes for table `gasto`
--
ALTER TABLE `gasto`
 ADD PRIMARY KEY (`codigo`), ADD KEY `usuario` (`usuario`), ADD KEY `usuario_autorizador` (`usuario_autorizador`), ADD KEY `tipo_gasto` (`tipo_gasto`), ADD KEY `punto_venta` (`punto_venta`), ADD KEY `usuario_registro` (`usuario_registro`), ADD KEY `usuario_actualizacion` (`usuario_actualizacion`);

--
-- Indexes for table `horario`
--
ALTER TABLE `horario`
 ADD PRIMARY KEY (`codigo`), ADD KEY `punto_venta` (`punto_venta`);

--
-- Indexes for table `ingreso`
--
ALTER TABLE `ingreso`
 ADD PRIMARY KEY (`codigo`), ADD KEY `usuario_autorizador` (`usuario_autorizador`), ADD KEY `usuario_pago` (`usuario_pago`), ADD KEY `usuario_registro` (`usuario_registro`), ADD KEY `usuario_actualizacion` (`usuario_actualizacion`), ADD KEY `origen` (`origen`), ADD KEY `destino` (`destino`);

--
-- Indexes for table `inventario`
--
ALTER TABLE `inventario`
 ADD PRIMARY KEY (`codigo`), ADD KEY `usuario_registro` (`usuario_registro`);

--
-- Indexes for table `item_factura`
--
ALTER TABLE `item_factura`
 ADD PRIMARY KEY (`codigo`), ADD KEY `factura` (`factura`), ADD KEY `producto` (`producto`);

--
-- Indexes for table `item_inventario`
--
ALTER TABLE `item_inventario`
 ADD PRIMARY KEY (`codigo`), ADD KEY `lote` (`lote`), ADD KEY `inventario` (`inventario`);

--
-- Indexes for table `lote`
--
ALTER TABLE `lote`
 ADD PRIMARY KEY (`codigo`), ADD KEY `tipo` (`tipo`), ADD KEY `estado` (`estado`), ADD KEY `origen` (`origen`), ADD KEY `destino` (`destino`), ADD KEY `producto` (`producto`), ADD KEY `talla` (`talla`), ADD KEY `color` (`color`);

--
-- Indexes for table `modulo`
--
ALTER TABLE `modulo`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
 ADD PRIMARY KEY (`codigo`), ADD KEY `estado` (`estado`), ADD KEY `categoria` (`categoria`), ADD KEY `usuariomod` (`usuariomod`);

--
-- Indexes for table `punto_venta`
--
ALTER TABLE `punto_venta`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `sorteo`
--
ALTER TABLE `sorteo`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `termino`
--
ALTER TABLE `termino`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`codigo`), ADD KEY `rol` (`rol`), ADD KEY `sexo` (`sexo`), ADD KEY `estado` (`estado`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accion`
--
ALTER TABLE `accion`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `accion_usuario`
--
ALTER TABLE `accion_usuario`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `factura`
--
ALTER TABLE `factura`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `factura_ganadora`
--
ALTER TABLE `factura_ganadora`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gasto`
--
ALTER TABLE `gasto`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `horario`
--
ALTER TABLE `horario`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ingreso`
--
ALTER TABLE `ingreso`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `inventario`
--
ALTER TABLE `inventario`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_factura`
--
ALTER TABLE `item_factura`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `item_inventario`
--
ALTER TABLE `item_inventario`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lote`
--
ALTER TABLE `lote`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `modulo`
--
ALTER TABLE `modulo`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `punto_venta`
--
ALTER TABLE `punto_venta`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sorteo`
--
ALTER TABLE `sorteo`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `termino`
--
ALTER TABLE `termino`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accion`
--
ALTER TABLE `accion`
ADD CONSTRAINT `accion_ibfk_1` FOREIGN KEY (`modulo`) REFERENCES `modulo` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `accion_usuario`
--
ALTER TABLE `accion_usuario`
ADD CONSTRAINT `accion_usuario_ibfk_1` FOREIGN KEY (`accion`) REFERENCES `accion` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `accion_usuario_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cliente`
--
ALTER TABLE `cliente`
ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo_cliente` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`sexo`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `factura`
--
ALTER TABLE `factura`
ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`metodo_pago`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `factura_ibfk_3` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`cliente`) REFERENCES `cliente` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `factura_ganadora`
--
ALTER TABLE `factura_ganadora`
ADD CONSTRAINT `factura_ganadora_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `factura_ganadora_ibfk_2` FOREIGN KEY (`factura`) REFERENCES `factura` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `factura_ganadora_ibfk_3` FOREIGN KEY (`sorteo`) REFERENCES `sorteo` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gasto`
--
ALTER TABLE `gasto`
ADD CONSTRAINT `gasto_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `gasto_ibfk_2` FOREIGN KEY (`usuario_autorizador`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `gasto_ibfk_3` FOREIGN KEY (`tipo_gasto`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `gasto_ibfk_4` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `gasto_ibfk_5` FOREIGN KEY (`usuario_registro`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `gasto_ibfk_6` FOREIGN KEY (`usuario_actualizacion`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `horario`
--
ALTER TABLE `horario`
ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`punto_venta`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ingreso`
--
ALTER TABLE `ingreso`
ADD CONSTRAINT `ingreso_ibfk_1` FOREIGN KEY (`usuario_autorizador`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ingreso_ibfk_2` FOREIGN KEY (`usuario_pago`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ingreso_ibfk_3` FOREIGN KEY (`usuario_registro`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ingreso_ibfk_4` FOREIGN KEY (`usuario_actualizacion`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ingreso_ibfk_5` FOREIGN KEY (`origen`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ingreso_ibfk_6` FOREIGN KEY (`destino`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventario`
--
ALTER TABLE `inventario`
ADD CONSTRAINT `inventario_ibfk_1` FOREIGN KEY (`usuario_registro`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_factura`
--
ALTER TABLE `item_factura`
ADD CONSTRAINT `item_factura_ibfk_1` FOREIGN KEY (`factura`) REFERENCES `factura` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `item_factura_ibfk_2` FOREIGN KEY (`producto`) REFERENCES `producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_inventario`
--
ALTER TABLE `item_inventario`
ADD CONSTRAINT `item_inventario_ibfk_1` FOREIGN KEY (`lote`) REFERENCES `lote` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `item_inventario_ibfk_2` FOREIGN KEY (`inventario`) REFERENCES `inventario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lote`
--
ALTER TABLE `lote`
ADD CONSTRAINT `lote_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `lote_ibfk_2` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `lote_ibfk_3` FOREIGN KEY (`origen`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `lote_ibfk_4` FOREIGN KEY (`destino`) REFERENCES `punto_venta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `lote_ibfk_5` FOREIGN KEY (`producto`) REFERENCES `producto` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `lote_ibfk_8` FOREIGN KEY (`color`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `lote_ibfk_9` FOREIGN KEY (`talla`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `producto`
--
ALTER TABLE `producto`
ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `producto_ibfk_3` FOREIGN KEY (`usuariomod`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`sexo`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`estado`) REFERENCES `termino` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;
