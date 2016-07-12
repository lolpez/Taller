-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2016 a las 22:27:09
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
(1, 'Documento formato portable PDF', 'fa fa-file-pdf-o fa-fw', 'pdf', 0),
(2, 'Documentos word', 'fa fa-file-word-o fa-fw', 'docx', 1),
(3, 'Archivos de audio mp3', 'fa fa-file-audio-o fa-fw', 'mp3', 1),
(4, 'Archivos de video', 'fa fa-file-movie-o fa-fw', '.mp4', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE IF NOT EXISTS `area` (
`pkarea` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `sigla` varchar(10) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `fkarea_padre` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`pkarea`, `nombre`, `sigla`, `estado`, `fkarea_padre`) VALUES
(100, 'General', 'GRAL', 1, 100),
(101, 'Desarrollo de saftwere', 'DSW', 1, 100),
(102, 'Redes', 'RDS', 1, 100),
(103, 'Recursos humanos', 'RRHH', 1, 100),
(104, 'Ventas', 'VNT', 1, 100),
(105, 'WUT', 'sin nombre', 1, 100),
(106, 'Otro sin nombre', 'NOPE', 1, 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_flujo`
--

CREATE TABLE IF NOT EXISTS `area_flujo` (
`pkarea_flujo` int(11) NOT NULL,
  `flujo` text NOT NULL,
  `fkarea` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `area_flujo`
--

INSERT INTO `area_flujo` (`pkarea_flujo`, `flujo`, `fkarea`) VALUES
(1, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":2,"loc":"141.04952779281646 -52.03016516589456","text":"Responsable de area"},{"id":3,"loc":"280.54772736965435 101.55132821597856","text":"Supervisor de area"},{"id":4,"loc":"441.7645219701915 -47.376180517959014","text":"Director de area"},{"id":5,"loc":"665.0344452098692 -47.376180517958986","text":"Emisor"}],"linkDataArray":[{"from":2,"to":3,"id":-1,"points":[224.9853999593,-13.339023409553,223.39126310091,37.231877183484,259.07181206841,72.91242615099,318.75325896363,101.83328668544],"text":"ela","pkestado_documento":"1","nombre_estado_documento":"Elaborado"},{"from":3,"to":4,"id":-2,"points":[417.35311865269,101.89868355759,454.53916728171,89.977036526754,487.11705981725,49.642502911313,503.78815487543,-8.7040299811109],"text":"rev","pkestado_documento":"2","nombre_estado_documento":"Revisado"},{"from":4,"to":5,"id":-3,"points":[513.2634510551,-47.36604677174,526.70364239461,-113.78169510209,684.13574324653,-113.24695976643,697.62202313227,-47.366022455549],"text":"apr","pkestado_documento":"3","nombre_estado_documento":"Aprobado"}]}', 100),
(2, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"0 100","text":"Administrador"},{"id":2,"loc":"200 100","text":"Responsable de area"},{"id":3,"loc":"400 100","text":"Supervisor de area"},{"id":6,"loc":"600 100","text":"Emisor"},{"id":8,"loc":"800 100","text":"Director de area"}],"linkDataArray":[]}', 101),
(3, ' {"class": "go.GraphLinksModel","nodeKeyProperty": "id","linkKeyProperty": "id","nodeDataArray": [{"id":1, "loc":"0 100", "text":"Administrador"},{"id":2, "loc":"200 100", "text":"Responsable de area"},{"id":3, "loc":"400 100", "text":"Supervisor de area"},{"id":6, "loc":"600 100", "text":"Emisor"},{"id":8, "loc":"800 100", "text":"Director de area"}]}     ', 101),
(4, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"0 100","text":"Administrador"},{"id":2,"loc":"200 100","text":"Responsable de area"},{"id":3,"loc":"400 100","text":"Supervisor de area"},{"id":4,"loc":"600 100","text":"Director de area"},{"id":5,"loc":"800 100","text":"Emisor"}],"linkDataArray":[]}', 102),
(5, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"0 100","text":"Administrador"},{"id":2,"loc":"200 100","text":"Responsable de area"},{"id":3,"loc":"400 100","text":"Supervisor de area"},{"id":4,"loc":"600 100","text":"Director de area"},{"id":5,"loc":"800 100","text":"Emisor"}],"linkDataArray":[]}', 103),
(6, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"0 100","text":"Administrador"},{"id":2,"loc":"200 100","text":"Responsable de area"},{"id":3,"loc":"400 100","text":"Supervisor de area"},{"id":4,"loc":"600 100","text":"Director de area"},{"id":5,"loc":"800 100","text":"Emisor"}],"linkDataArray":[]}', 104),
(7, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"0 100","text":"Administrador"},{"id":2,"loc":"200 100","text":"Responsable de area"},{"id":3,"loc":"400 100","text":"Supervisor de area"},{"id":4,"loc":"600 100","text":"Director de area"},{"id":5,"loc":"800 100","text":"Emisor"}],"linkDataArray":[]}', 105),
(8, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"0 100","text":"Administrador"},{"id":2,"loc":"200 100","text":"Responsable de area"},{"id":3,"loc":"400 100","text":"Supervisor de area"},{"id":4,"loc":"600 100","text":"Director de area"},{"id":5,"loc":"800 100","text":"Emisor"}],"linkDataArray":[]}', 106);

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
) ENGINE=InnoDB AUTO_INCREMENT=236 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`pkbitacora`, `fkusuario`, `accion`, `fecha`, `hora`) VALUES
(174, 2, 'Se elimino una copia de seguridad realizada en fecha : 05-07-2016, con hora: 17:17:29', '07/07/2016', '10:27:37'),
(175, 2, 'Restauracion de la base de datos desde archivo de copia de seguridad realizada en fecha : 07-07-2016', '07/07/2016', '05:46:47'),
(176, 2, 'Inicio de sesion', '09/07/2016', '08:55:27'),
(177, 2, 'se modifico el estado documento Elaborado', '09/07/2016', '10:52:07'),
(178, 2, 'se modifico el estado documento Elaborado', '09/07/2016', '10:52:18'),
(179, 2, 'se modifico el estado documento Elaborado', '09/07/2016', '10:52:32'),
(180, 2, 'se modifico el estado documento Elaborado', '09/07/2016', '10:52:45'),
(181, 2, 'se modifico el estado documento Aprobar', '09/07/2016', '10:58:25'),
(182, 2, 'se modifico el estado documento Emitido', '09/07/2016', '10:58:42'),
(183, 2, 'se modifico el estado documento Revision', '09/07/2016', '10:58:54'),
(184, 2, 'se modifico el estado documento Emitido', '09/07/2016', '10:59:03'),
(185, 2, 'se modifico el estado documento Revisado', '09/07/2016', '10:59:31'),
(186, 2, 'se modifico el estado documento Aprobado', '09/07/2016', '10:59:45'),
(187, 2, 'se modifico el estado documento Rechazado', '09/07/2016', '11:02:15'),
(188, 2, 'se modifico el estado documento Rechazado Supervisor', '09/07/2016', '11:04:17'),
(189, 2, 'se modifico el estado documento Rechazado por Supervisor', '09/07/2016', '11:04:28'),
(190, 2, 'se modifico el estado documento Rechazado', '09/07/2016', '11:05:52'),
(191, 2, 'se modifico el estado documento Devuelto', '09/07/2016', '11:06:11'),
(192, 2, 'se modifico el estado documento Devuelto', '09/07/2016', '11:06:18'),
(193, 2, 'se modifico el estado documento Devuelto', '09/07/2016', '11:07:02'),
(194, 2, 'se modifico el estado documento Aprobado', '09/07/2016', '11:13:48'),
(195, 2, 'se modifico el estado documento Aprobado', '09/07/2016', '11:13:55'),
(196, 2, 'Restauracion de la base de datos desde copia de seguridad realizada en fecha : 07-07-2016, con hora:', '09/07/2016', '11:44:20'),
(197, 2, 'Se realizo una nueva copia de seguridad', '09/07/2016', '11:48:04'),
(198, 2, 'Cierre de sesion', '09/07/2016', '12:09:51'),
(199, 2, 'Inicio de sesion', '09/07/2016', '12:09:59'),
(200, 2, 'Inicio de sesion', '10/07/2016', '07:21:21'),
(201, 2, 'se modifico el estado documento Elaborado', '10/07/2016', '08:10:41'),
(202, 2, 'se modifico el estado documento Revisado', '10/07/2016', '08:11:05'),
(203, 2, 'se modifico el estado documento Elaborado', '10/07/2016', '08:11:16'),
(204, 2, 'se modifico el estado documento Aprobado', '10/07/2016', '08:11:33'),
(205, 2, 'Inicio de sesion', '10/07/2016', '09:04:56'),
(206, 2, 'Inicio de sesion', '11/07/2016', '08:20:38'),
(207, 2, 'se agrego una nueva area una nueva', '11/07/2016', '11:39:36'),
(208, 2, 'Inicio de sesion', '12/07/2016', '08:23:03'),
(209, 2, 'se modifico el flujo de documentos del area General', '12/07/2016', '08:59:19'),
(210, 2, 'se modifico el flujo de documentos del area General', '12/07/2016', '08:59:51'),
(211, 2, 'se modifico el estado documento Rechazado', '12/07/2016', '09:10:01'),
(212, 2, 'se modifico el flujo de documentos del area General', '12/07/2016', '09:10:59'),
(213, 2, 'se modifico el flujo de documentos del area General', '12/07/2016', '10:00:23'),
(214, 2, 'se modifico el flujo de documentos del area General', '12/07/2016', '10:00:39'),
(215, 2, 'Inicio de sesion', '12/07/2016', '03:14:16'),
(216, 2, 'se modifico el flujo de documentos del area General', '12/07/2016', '03:16:11'),
(217, 2, 'se agrego una nueva area WUT', '12/07/2016', '03:40:24'),
(218, 2, 'se agrego un nuevo cargo Director de area', '12/07/2016', '03:41:16'),
(219, 2, 'se agrego una nueva area Otro sin nombre', '12/07/2016', '03:42:46'),
(220, 2, 'se modifico el flujo de documentos del area WUT', '12/07/2016', '04:05:08'),
(221, 2, 'se modifico el flujo de documentos del area Desarrollo de saftwere', '12/07/2016', '04:07:36'),
(222, 2, 'se modifico el flujo de documentos del area General', '12/07/2016', '04:13:48'),
(223, 2, 'se modifico el flujo de documentos del area Otro sin nombre', '12/07/2016', '04:13:58'),
(224, 2, 'se modifico el flujo de documentos del area Redes', '12/07/2016', '04:14:07'),
(225, 2, 'se modifico el flujo de documentos del area Recursos humanos', '12/07/2016', '04:14:15'),
(226, 2, 'se modifico el flujo de documentos del area WUT', '12/07/2016', '04:14:23'),
(227, 2, 'se modifico el flujo de documentos del area Ventas', '12/07/2016', '04:14:32'),
(228, 2, 'se modifico el flujo de documentos del area General', '12/07/2016', '04:16:06'),
(229, 2, 'se agrego un nuevo usuario el supervisor', '12/07/2016', '04:18:25'),
(230, 2, 'Cierre de sesion', '12/07/2016', '04:19:37'),
(231, 4, 'Inicio de sesion', '12/07/2016', '04:19:41'),
(232, 4, 'Cierre de sesion', '12/07/2016', '04:19:45'),
(233, 2, 'Inicio de sesion', '12/07/2016', '04:19:49'),
(234, 2, 'Cierre de sesion', '12/07/2016', '04:19:52'),
(235, 3, 'Inicio de sesion', '12/07/2016', '04:19:56');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`pkcargo`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 'Encargado de la administracion del sistema', 1),
(2, 'Responsable de area', 'encargado de elaboracion de documentos', 1),
(3, 'Supervisor de area', 'encargado de la revision de documentos elaborados', 1),
(4, 'Director de area', 'Encargado de aprobar documentos', 1),
(5, 'Emisor', 'encargado de emitir los documentos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_documento`
--

CREATE TABLE IF NOT EXISTS `estado_documento` (
`pkestado_documento` int(11) NOT NULL,
  `nomenglatura` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `color` varchar(7) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_documento`
--

INSERT INTO `estado_documento` (`pkestado_documento`, `nomenglatura`, `nombre`, `descripcion`, `color`) VALUES
(1, 'ela', 'Elaborado', 'El documento fue creado y esta listo para ser revisado', '#ddff00'),
(2, 'rev', 'Revisado', 'El documento fue revisado y esta listo para ser aprobado', '#0033ff'),
(3, 'apr', 'Aprobado', 'El documento fue aprobado y esta listo para ser emitido', '#047a00'),
(4, 'emi', 'Emitido', 'El documento fue emitido', '#c400ff'),
(5, 'rec', 'Rechazado', 'El documento fue rechazado', '#d10000'),
(6, 'dev', 'Devuelto', 'El documento fue devuelto', '#ffcc00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`pkmenu` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `icono` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`pkmenu`, `nombre`, `icono`) VALUES
(1, 'Gestion documentos', 'fa fa-folder fa-fw fa-2x'),
(2, 'Configuracion', 'fa fa-cog fa-fw fa-2x'),
(3, 'Seguridad', 'fa fa-lock fa-fw fa-2x'),
(4, 'Reportes', 'fa fa-bar-chart fa-fw fa-2x');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `menu_detalle`
--

INSERT INTO `menu_detalle` (`pkmenu_detalle`, `nombre`, `icono`, `controlador`, `fkmenu`) VALUES
(1, 'Documento', 'fa fa-file fa-fw', 'documento', 1),
(2, 'Plantilla', 'fa fa-file-text fa-fw', 'plantilla', 1),
(4, 'Bitacora', 'fa fa-desktop fa-fw', 'bitacora', 4),
(5, 'Usuario', 'fa fa-user fa-fw', 'usuario', 3),
(6, 'Cargo', 'fa fa-briefcase fa-fw ', 'cargo', 2),
(7, 'Permisos', 'fa fa-ban fa-fw', 'privilegio', 3),
(8, 'Calendario', 'fa fa-calendar fa-fw', 'calendario', 3),
(9, 'Archivos permitidos', 'fa fa-file-o fa-fw', 'archivo_config', 3),
(10, 'Area', 'fa fa-sitemap fa-fw', 'area', 2),
(11, 'Tipo documento', 'fa fa-cubes fa-fw', 'tipo_documento', 2),
(12, 'Copia de seguridad', 'fa fa-database fa-fw', 'backup', 3),
(14, 'Estado de documento', 'fa fa-clock-o fa-fw', 'estado_documento', 2);

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
(1, 10),
(1, 11),
(1, 12),
(1, 14),
(2, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE IF NOT EXISTS `tipo_documento` (
`pktipo_documento` int(11) NOT NULL,
  `sigla` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`pktipo_documento`, `sigla`, `nombre`, `estado`) VALUES
(1, 'PLAN', 'plan de negocio', 1),
(2, 'PRFL', 'perfil de proyecto', 1);

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
  `fkarea` int(11) NOT NULL,
  `fkcargo` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`pkusuario`, `ci`, `nombre`, `email`, `telefono`, `archivo`, `fkarea`, `fkcargo`, `estado`) VALUES
(2, 0, 'luis daniel', 'admin@hotmail.com', 78888777, 'luis.crip', 100, 1, 1),
(3, 1, 'alejandro mollejas', 'alejandro@hotmail.com', 123456, 'alejandro.crip', 100, 2, 1),
(4, 123, 'el supervisor', 'jose@hotmail.com', 123, 'jose.crip', 100, 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivo_config`
--
ALTER TABLE `archivo_config`
 ADD PRIMARY KEY (`pkarchivo_config`);

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
 ADD PRIMARY KEY (`pkarea`);

--
-- Indices de la tabla `area_flujo`
--
ALTER TABLE `area_flujo`
 ADD PRIMARY KEY (`pkarea_flujo`);

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
-- Indices de la tabla `estado_documento`
--
ALTER TABLE `estado_documento`
 ADD PRIMARY KEY (`pkestado_documento`);

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
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
 ADD PRIMARY KEY (`pktipo_documento`);

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
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
MODIFY `pkarea` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT de la tabla `area_flujo`
--
ALTER TABLE `area_flujo`
MODIFY `pkarea_flujo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
MODIFY `pkbitacora` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=236;
--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
MODIFY `pkcargo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `estado_documento`
--
ALTER TABLE `estado_documento`
MODIFY `pkestado_documento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
MODIFY `pkmenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `menu_detalle`
--
ALTER TABLE `menu_detalle`
MODIFY `pkmenu_detalle` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
MODIFY `pktipo_documento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `pkusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
