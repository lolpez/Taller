-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2016 a las 23:33:51
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
-- Estructura de tabla para la tabla `archivo_config`
--

CREATE TABLE IF NOT EXISTS `archivo_config` (
`pkarchivo_config` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `icono` varchar(50) NOT NULL,
  `extencion` varchar(10) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `archivo_config`
--

INSERT INTO `archivo_config` (`pkarchivo_config`, `nombre`, `icono`, `extencion`, `estado`) VALUES
(1, 'Documento formato portable PDF', 'fa fa-file-pdf-o fa-fw', 'pdf', 1),
(2, 'Documentos word', 'fa fa-file-word-o fa-fw', 'docx', 1),
(3, 'Archivos de audio mp3', 'fa fa-file-audio-o fa-fw', '.mp3', 1),
(4, 'Archivos de video', 'fa fa-file-movie-o fa-fw', '.mp4', 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`pkbitacora`, `fkusuario`, `accion`, `fecha`, `hora`) VALUES
(1, 2, 'Inicio de sesion', '27/05/2016', '02:43:06'),
(2, 2, 'Cierre de sesion', '27/05/2016', '02:53:48'),
(3, 2, 'Inicio de sesion', '27/05/2016', '02:54:45'),
(4, 2, 'edito su perfil de usuario', '27/05/2016', '03:06:53'),
(5, 2, 'Cierre de sesion', '27/05/2016', '03:06:57'),
(6, 2, 'Inicio de sesion', '27/05/2016', '03:07:06'),
(7, 2, 'Cierre de sesion', '27/05/2016', '03:07:10'),
(8, 2, 'Inicio de sesion', '27/05/2016', '03:07:14'),
(9, 2, 'se modifico el usuario luis daniel', '27/05/2016', '03:07:31'),
(10, 2, 'Cierre de sesion', '27/05/2016', '03:22:58'),
(11, 2, 'Inicio de sesion', '27/05/2016', '03:23:29'),
(12, 2, 'Inicio de sesion', '27/05/2016', '03:25:50'),
(13, 2, 'Cierre de sesion', '27/05/2016', '03:34:09'),
(14, 2, 'Inicio de sesion', '27/05/2016', '03:35:43'),
(15, 2, 'se modifico los permisos para el cargo Administrador', '27/05/2016', '03:50:00'),
(16, 2, 'se agrego un nuevo tipo de archivo que el sistema permitira (.mp3)', '27/05/2016', '05:07:20'),
(17, 2, 'se agrego un nuevo tipo de archivo que el sistema permitira (.mp3)', '27/05/2016', '05:08:52'),
(18, 2, 'se agrego un nuevo tipo de archivo que el sistema permitira (.mp3)', '27/05/2016', '05:15:00'),
(19, 2, 'se agrego un nuevo tipo de archivo que el sistema permitira (.mp4)', '27/05/2016', '05:19:35'),
(20, 2, 'se dio de baja el cargo ', '27/05/2016', '05:20:19'),
(21, 2, 'se dio de baja el cargo ', '27/05/2016', '05:21:30'),
(22, 2, 'se dio de baja el tipo de archivo permitido por el sistema Archivos de video', '27/05/2016', '05:22:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

CREATE TABLE IF NOT EXISTS `calendario` (
  `fecha` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`pkmenu`, `nombre`, `icono`) VALUES
(1, 'Gestion documentos', 'fa fa-folder fa-fw fa-2x'),
(2, 'Configuracion', 'fa fa-cog fa-fw fa-2x'),
(3, 'Seguridad', 'fa fa-lock fa-fw fa-2x');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu_detalle`
--

INSERT INTO `menu_detalle` (`pkmenu_detalle`, `nombre`, `icono`, `controlador`, `fkmenu`) VALUES
(1, 'Documento', 'fa fa-file fa-fw', 'documento', 1),
(2, 'Plantilla', 'fa fa-file-text fa-fw', 'plantilla', 1),
(4, 'Bitacora', 'fa fa-desktop fa-fw', 'bitacora', 3),
(5, 'Usuario', 'fa fa-user fa-fw', 'usuario', 3),
(6, 'Cargo', 'fa fa-briefcase fa-fw ', 'cargo', 2),
(7, 'Permisos', 'fa fa-ban fa-fw', 'privilegio', 3),
(8, 'Calendario', 'fa fa-calendar fa-fw', 'calendario', 3),
(9, 'Archivos permitidos', 'fa fa-file-o fa-fw', 'archivo_config', 3);

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
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(2, 1),
(2, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`pkusuario`, `ci`, `nombre`, `email`, `telefono`, `archivo`, `fkcargo`, `estado`) VALUES
(2, 0, 'luis daniel', 'admin@hotmail.com', 78888777, 'luis.crip', 1, 1),
(3, 1, 'alejandro mollejas', 'alejandro@hotmail.com', 123456, 'alejandro.crip', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivo_config`
--
ALTER TABLE `archivo_config`
 ADD PRIMARY KEY (`pkarchivo_config`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
 ADD PRIMARY KEY (`pkbitacora`);

--
-- Indices de la tabla `calendario`
--
ALTER TABLE `calendario`
 ADD PRIMARY KEY (`fecha`);

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
-- AUTO_INCREMENT de la tabla `archivo_config`
--
ALTER TABLE `archivo_config`
MODIFY `pkarchivo_config` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
MODIFY `pkbitacora` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
MODIFY `pkcargo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
MODIFY `pkmenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `menu_detalle`
--
ALTER TABLE `menu_detalle`
MODIFY `pkmenu_detalle` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `pkusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
