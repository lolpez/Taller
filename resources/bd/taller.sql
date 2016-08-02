-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-08-2016 a las 16:27:08
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
  `extension` varchar(10) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `archivo_config`
--

INSERT INTO `archivo_config` (`pkarchivo_config`, `nombre`, `icono`, `extension`, `estado`) VALUES
(1, 'Documento formato portable PDF', 'fa fa-file-pdf-o fa-fw', 'pdf', 1),
(2, 'Documentos word', 'fa fa-file-word-o fa-fw', 'docx', 1),
(3, 'Archivos de audio mp3', 'fa fa-file-audio-o fa-fw', 'mp3', 1),
(4, 'Archivos de video', 'fa fa-file-movie-o fa-fw', 'mp4', 1);

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
(101, 'Desarrollo de software', 'DSW', 1, 100),
(102, 'Redes', 'RDS', 1, 100),
(103, 'Recursos humanos', 'RRHH', 1, 100),
(104, 'Ventas', 'VNT', 1, 100),
(105, 'WUT', 'sin nombre', 0, 100),
(106, 'Otro sin nombre', 'NOPE', 0, 100);

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
(1, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"16 10.000000000000014","text":"Administrador"},{"id":2,"loc":"14.000000000000028 122.00000000000001","text":"Responsable de area"},{"id":3,"loc":"235.00000000000006 62.000000000000014","text":"Supervisor de area"},{"id":4,"loc":"432 62.000000000000014","text":"Director de area"},{"id":5,"loc":"457.0000000000001 199","text":"Emisor"}],"linkDataArray":[{"from":1,"to":3,"id":-1,"points":[140.09077500514,32.425843209247,175.44762401983,34.336123414006,210.29537968574,42.049073122287,263.76364491409,62.318307570242],"text":"ela","pkestado_documento":"1","nombre_estado_documento":"Elaborado"},{"from":2,"to":3,"id":-2,"points":[139.53172342864,122.28919619961,188.57292713882,99.487434837017,215.22183095232,92.015779562205,235.57134139539,89.784764595546],"text":"ela","pkestado_documento":"1","nombre_estado_documento":"Elaborado"},{"from":3,"to":4,"id":-3,"points":[341.42212510996,100.46744742682,383,128,426,128,469.41518871108,100.45922475817],"text":"rev","pkestado_documento":"2","nombre_estado_documento":"Revisado"},{"from":4,"to":5,"id":-4,"points":[502.45024937501,100.68584491525,507.84080260659,140.19767871162,506.63210757886,171.11753615036,499.11087459585,199.01952418526],"text":"apr","pkestado_documento":"3","nombre_estado_documento":"Aprobado"},{"from":5,"to":5,"id":-7,"points":[504.72969392273,237.62387976681,556,326,437,321,482.92356578433,237.62934323914],"text":"emi","pkestado_documento":"4","nombre_estado_documento":"Emitido"},{"from":3,"to":1,"id":-6,"points":[299.62118075148,62.084811706699,264,9,216,-11,133.85878929624,13.022767782602],"text":"rec","pkestado_documento":"5","nombre_estado_documento":"Rechazado"}]}', 100),
(2, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"-1.628894626777445 -51.48720029030213","text":"Administrador"},{"id":2,"loc":"-18.271879988177233 101.62889462677748","text":"Responsable de area"},{"id":3,"loc":"400 100","text":"Supervisor de area"},{"id":4,"loc":"600 100","text":"Director de area"},{"id":5,"loc":"800 100","text":"Emisor"}],"linkDataArray":[{"from":2,"to":3,"id":-1,"points":[150.27026643809,112.62034115098,233.81630249007,104.31089078511,316.87646843612,103.9819204261,400.28829017308,111.95806155229],"text":"ela","pkestado_documento":"1","nombre_estado_documento":"Elaborado"},{"from":1,"to":3,"id":-2,"points":[118.17219066026,-17.268179534947,221.54760232501,9.3533386541298,326.09612450122,47.321849402189,437.4659957446,100.28526411553],"text":"ela","pkestado_documento":"1","nombre_estado_documento":"Elaborado"},{"from":3,"to":4,"id":-3,"points":[494.4571107961,100.12461286403,542.42191071689,45.609049549768,604.31990653443,47.237944176546,650.69170158921,100.12405163711],"text":"rev","pkestado_documento":"2","nombre_estado_documento":"Revisado"},{"from":4,"to":5,"id":-4,"points":[685.32303954219,100.13300365569,729.74479279629,52.124628056878,786.7561047335,66.784679697875,818.34983751654,100.13700622593],"text":"apr","pkestado_documento":"3","nombre_estado_documento":"Aprobado"},{"from":5,"to":5,"id":-5,"points":[847.67626207598,138.62440269512,860.67626207598,161.14106319352,812.41512791725,161.14106319352,825.41512791725,138.62440269512],"text":"emi","pkestado_documento":"4","nombre_estado_documento":"Emitido"}]}', 101),
(4, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"0 100","text":"Administrador"},{"id":2,"loc":"200 100","text":"Responsable de area"},{"id":3,"loc":"400 100","text":"Supervisor de area"},{"id":4,"loc":"600 100","text":"Director de area"},{"id":5,"loc":"800 100","text":"Emisor"}],"linkDataArray":[]}', 102),
(5, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"0 100","text":"Administrador"},{"id":2,"loc":"200 100","text":"Responsable de area"},{"id":3,"loc":"400 100","text":"Supervisor de area"},{"id":4,"loc":"600 100","text":"Director de area"},{"id":5,"loc":"800 100","text":"Emisor"}],"linkDataArray":[]}', 103),
(6, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"0 100","text":"Administrador"},{"id":2,"loc":"200 100","text":"Responsable de area"},{"id":3,"loc":"400 100","text":"Supervisor de area"},{"id":4,"loc":"600 100","text":"Director de area"},{"id":5,"loc":"800 100","text":"Emisor"}],"linkDataArray":[]}', 104),
(7, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"0 100","text":"Administrador"},{"id":2,"loc":"200 100","text":"Responsable de area"},{"id":3,"loc":"400 100","text":"Supervisor de area"},{"id":4,"loc":"600 100","text":"Director de area"},{"id":5,"loc":"800 100","text":"Emisor"}],"linkDataArray":[]}', 105),
(8, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"0 100","text":"Administrador"},{"id":2,"loc":"200 100","text":"Responsable de area"},{"id":3,"loc":"400 100","text":"Supervisor de area"},{"id":4,"loc":"600 100","text":"Director de area"},{"id":5,"loc":"800 100","text":"Emisor"}],"linkDataArray":[]}', 106);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avance`
--

CREATE TABLE IF NOT EXISTS `avance` (
`pkavance` int(11) NOT NULL,
  `fecha` varchar(10) NOT NULL,
  `hora` varchar(10) NOT NULL,
  `fkusuario` int(11) NOT NULL,
  `fkdocumento` varchar(50) NOT NULL,
  `fkestado_documento` int(11) DEFAULT NULL,
  `comentario` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

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
-- Estructura de tabla para la tabla `emision`
--

CREATE TABLE IF NOT EXISTS `emision` (
`pkemision` int(11) NOT NULL,
  `fkusuario` int(11) NOT NULL,
  `fkdocumento` varchar(50) NOT NULL,
  `fkarea` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_documento`
--

CREATE TABLE IF NOT EXISTS `estado_documento` (
`pkestado_documento` int(11) NOT NULL,
  `nomenglatura` varchar(10) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `color` varchar(7) NOT NULL,
  `icono` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_documento`
--

INSERT INTO `estado_documento` (`pkestado_documento`, `nomenglatura`, `nombre`, `descripcion`, `color`, `icono`) VALUES
(1, 'ela', 'Elaborado', 'El documento fue creado y esta listo para ser revisado', '#ddff00', 'fa fa-upload'),
(2, 'rev', 'Revisado', 'El documento fue revisado y esta listo para ser aprobado', '#0033ff', 'fa fa-paperclip'),
(3, 'apr', 'Aprobado', 'El documento fue aprobado y esta listo para ser emitido', '#047a00', 'fa fa-check'),
(4, 'emi', 'Emitido', 'El documento fue emitido', '#c400ff', 'fa fa-send'),
(5, 'rec', 'Rechazado', 'El documento fue rechazado', '#d10000', 'fa fa-times'),
(6, 'dev', 'Devuelto', 'El documento fue devuelto', '#ffcc00', 'fa fa-mail-reply'),
(7, 'act', 'Actualizar', 'Actualizar documento', '#001799', 'fa fa-refresh'),
(8, 'ord', 'Orden de actualizacion', 'Se ordeno actualizacion para el documento', '#000000', 'fa fa-info');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

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
(9, 'Archivos permitidos', 'fa fa-file-o fa-fw', 'archivo_config', 3),
(10, 'Area', 'fa fa-sitemap fa-fw', 'area', 2),
(11, 'Tipo documento', 'fa fa-cubes fa-fw', 'tipo_documento', 2),
(12, 'Copia de seguridad', 'fa fa-database fa-fw', 'backup', 3),
(14, 'Estado de documento', 'fa fa-clock-o fa-fw', 'estado_documento', 2),
(15, 'Lista maestra', 'fa fa-file fa-fw', 'reporte', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE IF NOT EXISTS `notificacion` (
`pknotificacion` int(11) NOT NULL,
  `fkavance` int(11) NOT NULL,
  `fkusuario_destino` int(11) NOT NULL,
  `terminado` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 14),
(1, 15),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`pkusuario`, `ci`, `nombre`, `email`, `telefono`, `archivo`, `fkarea`, `fkcargo`, `estado`) VALUES
(2, 0, 'luis daniel', 'admin@hotmail.com', 78888777, 'luis.crip', 100, 1, 1),
(3, 1, 'alejandro mollejas', 'alejandro@hotmail.com', 123456, 'alejandro.crip', 101, 2, 1),
(4, 123, 'jose', 'jose@hotmail.com', 123, 'jose.crip', 100, 3, 1),
(5, 456, 'miguel', 'miguel@hotmail.com', 456, 'miguel.crip', 100, 4, 1),
(6, 987, 'lenka', 'ramirez@hotmail.com', 987, 'lenka.crip', 100, 5, 1),
(7, 1234, 'mauro', 'mauro@hotmail.com', 123456, 'mauro.crip', 101, 3, 1),
(8, 1456, 'ranulfo', 'ranulfo@hotmail.com', 123456, 'ranulfo.crip', 101, 4, 1),
(9, 1678, 'gladys', 'gladys@hotmail.com', 123456, 'gladys.crip', 101, 5, 1);

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
-- Indices de la tabla `avance`
--
ALTER TABLE `avance`
 ADD PRIMARY KEY (`pkavance`);

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
-- Indices de la tabla `emision`
--
ALTER TABLE `emision`
 ADD PRIMARY KEY (`pkemision`);

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
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
 ADD PRIMARY KEY (`pknotificacion`);

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
-- AUTO_INCREMENT de la tabla `avance`
--
ALTER TABLE `avance`
MODIFY `pkavance` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
MODIFY `pkbitacora` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
MODIFY `pkcargo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `emision`
--
ALTER TABLE `emision`
MODIFY `pkemision` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado_documento`
--
ALTER TABLE `estado_documento`
MODIFY `pkestado_documento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
MODIFY `pkmenu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `menu_detalle`
--
ALTER TABLE `menu_detalle`
MODIFY `pkmenu_detalle` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
MODIFY `pknotificacion` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
MODIFY `pktipo_documento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `pkusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
