-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-05-2016 a las 23:49:48
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `taller`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE IF NOT EXISTS `bitacora` (
`pkbitacora` int(11) NOT NULL,
  `fkusuario` int(11) NOT NULL,
  `accion` varchar(100) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `hora` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`pkbitacora`, `fkusuario`, `accion`, `fecha`, `hora`) VALUES
(85, 2, 'Cierre de sesion', '20/05/2016', '04:37:01'),
(86, 2, 'Cierre de sesion', '25/05/2016', '05:01:18'),
(87, 2, 'Cierre de sesion', '25/05/2016', '05:01:36'),
(88, 2, 'Cierre de sesion', '25/05/2016', '05:02:04'),
(89, 2, 'Inicio de sesion', '25/05/2016', '05:02:08'),
(90, 2, 'se agrego un nuevo cargo Responsable de area', '25/05/2016', '05:29:41'),
(91, 2, 'se modifico el cargo Responsable de area', '25/05/2016', '05:29:48'),
(92, 2, 'se modifico el cargo Responsable de area', '25/05/2016', '05:29:57'),
(93, 2, 'se agrego un nuevo cargo supervisor de area', '25/05/2016', '05:31:52'),
(94, 2, 'se modifico el cargo Supervisor de area', '25/05/2016', '05:32:20'),
(95, 2, 'se dio de baja el cargo Supervisor de area', '25/05/2016', '05:35:19'),
(96, 2, 'se agrego un nuevo usuario alejandro mollejas', '25/05/2016', '05:44:41'),
(97, 2, 'se agrego un nuevo usuario a', '25/05/2016', '05:48:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE IF NOT EXISTS `cargo` (
`pkcargo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `estado` int(11) DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`pkcargo`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 'Encargado de la administracion del sistema', 1),
(2, 'Responsable de area', 'encargado de elaboracion de documentos', 1),
(3, 'Supervisor de area', 'encargado de la revision de documentos elaborados', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`pkmenu` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `icono` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`pkmenu`, `nombre`, `icono`) VALUES
(1, 'gestion documentos', 'fa fa-folder fa-fw fa-2x'),
(2, 'configuracion', 'fa fa-cog fa-fw fa-2x');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_detalle`
--

CREATE TABLE IF NOT EXISTS `menu_detalle` (
`pkmenu_detalle` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `icono` varchar(50) NOT NULL,
  `controlador` varchar(30) NOT NULL,
  `fkmenu` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu_detalle`
--

INSERT INTO `menu_detalle` (`pkmenu_detalle`, `nombre`, `icono`, `controlador`, `fkmenu`) VALUES
(1, 'documento', 'fa fa-file fa-fw', 'documento', 1),
(2, 'plantilla', 'fa fa-file-text fa-fw', 'plantilla', 1),
(3, 'yolo', 'xxx', 'xxx', 2),
(4, 'Bitacora', 'fa fa-desktop fa-fw', 'bitacora', 2),
(5, 'Usuario', 'fa fa-user fa-fw', 'usuario', 2),
(6, 'Cargo', 'fa fa-briefcase fa-fw ', 'cargo', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio`
--

CREATE TABLE IF NOT EXISTS `privilegio` (
  `fkcargo` int(11) NOT NULL,
  `fkmenu_detalle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `privilegio`
--

INSERT INTO `privilegio` (`fkcargo`, `fkmenu_detalle`) VALUES
(1, 1),
(1, 2),
(1, 4),
(1, 5),
(1, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
`pkusuario` int(11) NOT NULL,
  `ci` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefono` int(11) DEFAULT NULL,
  `archivo` varchar(30) NOT NULL,
  `fkcargo` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`pkusuario`, `ci`, `nombre`, `email`, `telefono`, `archivo`, `fkcargo`, `estado`) VALUES
(2, 0, 'luis daniel', 'admin@hotmail.com', 78888777, 'luis.crip', 1, 1),
(3, 1, 'alejandro mollejas', 'alejandro@hotmail.com', 123456, 'alejandro.epsas', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
 ADD PRIMARY KEY (`pkbitacora`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
 ADD PRIMARY KEY (`pkcargo`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`pkmenu`);

--
-- Indices de la tabla `menu_detalle`
--
ALTER TABLE `menu_detalle`
 ADD PRIMARY KEY (`pkmenu_detalle`);

--
-- Indices de la tabla `privilegio`
--
ALTER TABLE `privilegio`
 ADD PRIMARY KEY (`fkcargo`,`fkmenu_detalle`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`pkusuario`), ADD KEY `fkcargo` (`fkcargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
MODIFY `pkbitacora` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
MODIFY `pkcargo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
MODIFY `pkmenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `menu_detalle`
--
ALTER TABLE `menu_detalle`
MODIFY `pkmenu_detalle` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `pkusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
