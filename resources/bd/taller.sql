-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2016 a las 06:35:44
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
(1, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"16 10.000000000000014","text":"Administrador"},{"id":2,"loc":"14.000000000000028 122.00000000000001","text":"Responsable de area"},{"id":3,"loc":"235.00000000000006 62.000000000000014","text":"Supervisor de area"},{"id":4,"loc":"432 62.000000000000014","text":"Director de area"},{"id":5,"loc":"457.0000000000001 199","text":"Emisor"}],"linkDataArray":[{"from":1,"to":3,"id":-1,"points":[140.09089704186,32.102852363482,178.34837105958,34.065122561749,216.26559588712,41.853828977898,274.74817152993,62.274768033115],"text":"ela","pkestado_documento":"1","nombre_estado_documento":"Elaborado"},{"from":2,"to":3,"id":-2,"points":[139.53172342864,122.28919619961,188.57292713882,99.487434837017,215.22183095232,92.015779562205,235.57134139539,89.784764595546],"text":"ela","pkestado_documento":"1","nombre_estado_documento":"Elaborado"},{"from":3,"to":4,"id":-3,"points":[341.42212510996,100.46744742682,383,128,426,128,469.41518871108,100.45922475817],"text":"rev","pkestado_documento":"2","nombre_estado_documento":"Revisado"},{"from":4,"to":5,"id":-4,"points":[502.45024937501,100.68584491525,507.84080260659,140.19767871162,506.63210757886,171.11753615036,499.11087459585,199.01952418526],"text":"apr","pkestado_documento":"3","nombre_estado_documento":"Aprobado"},{"from":3,"to":2,"id":-5,"points":[305.23763871465,100.65903065626,293,133,234,161,180.97410517427,153.3059875435],"text":"rec","pkestado_documento":"5","nombre_estado_documento":"Rechazado"},{"from":4,"to":3,"id":-6,"points":[484.07168222919,62.110414609713,451,21,394,18,337.17349581471,62.193052800537],"text":"dev","pkestado_documento":"6","nombre_estado_documento":"Devuelto"},{"from":5,"to":5,"id":-7,"points":[504.72969392273,237.62387976681,556,326,437,321,482.92356578433,237.62934323914],"text":"emi","pkestado_documento":"4","nombre_estado_documento":"Emitido"}]}', 100),
(2, '{"class":"go.GraphLinksModel","nodeKeyProperty":"id","linkKeyProperty":"id","nodeDataArray":[{"id":1,"loc":"0 100","text":"Administrador"},{"id":2,"loc":"200 100","text":"Responsable de area"},{"id":3,"loc":"400 100","text":"Supervisor de area"},{"id":6,"loc":"600 100","text":"Emisor"},{"id":8,"loc":"800 100","text":"Director de area"}],"linkDataArray":[]}', 101),
(3, ' {"class": "go.GraphLinksModel","nodeKeyProperty": "id","linkKeyProperty": "id","nodeDataArray": [{"id":1, "loc":"0 100", "text":"Administrador"},{"id":2, "loc":"200 100", "text":"Responsable de area"},{"id":3, "loc":"400 100", "text":"Supervisor de area"},{"id":6, "loc":"600 100", "text":"Emisor"},{"id":8, "loc":"800 100", "text":"Director de area"}]}     ', 101),
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
  `fkestado_documento` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=431 DEFAULT CHARSET=latin1;

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
(235, 3, 'Inicio de sesion', '12/07/2016', '04:19:56'),
(236, 3, 'Cierre de sesion', '12/07/2016', '04:37:15'),
(237, 2, 'Inicio de sesion', '12/07/2016', '04:37:26'),
(238, 2, 'se modifico el area Desarrollo de software', '12/07/2016', '04:38:31'),
(239, 2, 'Cierre de sesion', '12/07/2016', '05:27:20'),
(240, 2, 'Inicio de sesion', '12/07/2016', '08:24:38'),
(241, 2, 'Inicio de sesion', '13/07/2016', '08:22:50'),
(242, 2, 'Inicio de sesion', '14/07/2016', '08:45:01'),
(243, 2, 'Inicio de sesion', '14/07/2016', '03:11:12'),
(244, 2, 'Inicio de sesion', '15/07/2016', '08:26:13'),
(245, 2, 'Inicio de sesion', '15/07/2016', '02:52:03'),
(246, 2, 'Cierre de sesion', '15/07/2016', '03:39:44'),
(247, 2, 'Inicio de sesion', '15/07/2016', '03:39:48'),
(248, 2, 'Cierre de sesion', '15/07/2016', '03:49:41'),
(249, 2, 'Inicio de sesion', '15/07/2016', '03:49:45'),
(250, 2, 'Cierre de sesion', '15/07/2016', '03:57:30'),
(251, 2, 'Inicio de sesion', '15/07/2016', '03:57:35'),
(252, 2, 'Se realizo una nueva copia de seguridad', '15/07/2016', '04:30:54'),
(253, 2, 'Descarga de copia de seguridad de la fecha: 15-07-2016, con hora: 16:30:50', '15/07/2016', '04:31:08'),
(254, 2, 'Inicio de sesion', '16/07/2016', '08:56:04'),
(255, 2, 'se modifico el flujo de documentos del area General', '16/07/2016', '09:08:45'),
(256, 2, 'Cierre de sesion', '16/07/2016', '12:01:50'),
(257, 4, 'Inicio de sesion', '16/07/2016', '12:01:54'),
(258, 4, 'Cierre de sesion', '16/07/2016', '12:01:58'),
(259, 3, 'Inicio de sesion', '16/07/2016', '12:02:02'),
(260, 3, 'Cierre de sesion', '16/07/2016', '12:09:16'),
(261, 2, 'Inicio de sesion', '16/07/2016', '12:09:20'),
(262, 2, 'Inicio de sesion', '17/07/2016', '12:40:02'),
(263, 2, 'se modifico el flujo de documentos del area General', '17/07/2016', '04:36:57'),
(264, 2, 'Cierre de sesion', '17/07/2016', '04:39:52'),
(265, 3, 'Inicio de sesion', '17/07/2016', '04:39:56'),
(266, 3, 'Cierre de sesion', '17/07/2016', '04:40:08'),
(267, 2, 'Inicio de sesion', '17/07/2016', '04:40:13'),
(268, 2, 'Cierre de sesion', '17/07/2016', '04:42:43'),
(269, 4, 'Inicio de sesion', '17/07/2016', '04:42:47'),
(270, 4, 'Cierre de sesion', '17/07/2016', '04:42:54'),
(271, 2, 'Inicio de sesion', '17/07/2016', '04:42:59'),
(272, 2, 'se modifico los permisos para el cargo Supervisor de area', '17/07/2016', '04:43:13'),
(273, 2, 'se modifico los permisos para el cargo Director de area', '17/07/2016', '04:43:26'),
(274, 2, 'Cierre de sesion', '17/07/2016', '04:43:29'),
(275, 2, 'Inicio de sesion', '17/07/2016', '04:43:33'),
(276, 2, 'Cierre de sesion', '17/07/2016', '04:43:36'),
(277, 4, 'Inicio de sesion', '17/07/2016', '04:43:39'),
(278, 4, 'Cierre de sesion', '17/07/2016', '04:43:48'),
(279, 2, 'Inicio de sesion', '17/07/2016', '04:43:52'),
(280, 2, 'Cierre de sesion', '17/07/2016', '05:23:43'),
(281, 3, 'Inicio de sesion', '17/07/2016', '05:23:47'),
(282, 3, 'Cierre de sesion', '17/07/2016', '05:35:43'),
(283, 2, 'Inicio de sesion', '17/07/2016', '05:35:49'),
(284, 2, 'Cierre de sesion', '17/07/2016', '05:47:57'),
(285, 2, 'Inicio de sesion', '17/07/2016', '05:48:02'),
(286, 2, 'Cierre de sesion', '17/07/2016', '05:48:08'),
(287, 2, 'Inicio de sesion', '17/07/2016', '05:48:17'),
(288, 2, 'se modifico el flujo de documentos del area General', '17/07/2016', '06:44:37'),
(289, 2, 'se modifico el flujo de documentos del area General', '17/07/2016', '06:44:58'),
(290, 2, 'se modifico el flujo de documentos del area General', '17/07/2016', '06:45:33'),
(291, 2, 'se modifico el flujo de documentos del area General', '17/07/2016', '08:05:16'),
(292, 2, 'Cierre de sesion', '17/07/2016', '08:06:02'),
(293, 3, 'Inicio de sesion', '17/07/2016', '08:06:07'),
(294, 3, 'Cierre de sesion', '17/07/2016', '08:06:17'),
(295, 2, 'Inicio de sesion', '17/07/2016', '08:07:02'),
(296, 2, 'Cierre de sesion', '17/07/2016', '08:27:49'),
(297, 4, 'Inicio de sesion', '17/07/2016', '08:27:54'),
(298, 4, 'Cierre de sesion', '17/07/2016', '08:49:02'),
(299, 2, 'Inicio de sesion', '17/07/2016', '08:49:08'),
(300, 2, 'Cierre de sesion', '17/07/2016', '09:31:22'),
(301, 2, 'Inicio de sesion', '17/07/2016', '09:31:27'),
(302, 2, 'Cierre de sesion', '17/07/2016', '09:31:30'),
(303, 4, 'Inicio de sesion', '17/07/2016', '09:31:35'),
(304, 4, 'Cierre de sesion', '17/07/2016', '09:33:38'),
(305, 2, 'Inicio de sesion', '17/07/2016', '09:33:46'),
(306, 2, 'se agrego un nuevo usuario el director', '17/07/2016', '09:37:36'),
(307, 2, 'Cierre de sesion', '17/07/2016', '09:37:49'),
(308, 4, 'Inicio de sesion', '17/07/2016', '09:37:54'),
(309, 4, 'Cierre de sesion', '17/07/2016', '09:38:26'),
(310, 5, 'Inicio de sesion', '17/07/2016', '09:38:31'),
(311, 5, 'Cierre de sesion', '17/07/2016', '09:38:49'),
(312, 2, 'Inicio de sesion', '17/07/2016', '09:39:00'),
(313, 2, 'Cierre de sesion', '17/07/2016', '09:44:32'),
(314, 4, 'Inicio de sesion', '17/07/2016', '09:44:36'),
(315, 4, 'edito su perfil de usuario', '17/07/2016', '09:44:45'),
(316, 4, 'Inicio de sesion', '17/07/2016', '09:48:44'),
(317, 4, 'edito su perfil de usuario', '17/07/2016', '09:48:54'),
(318, 4, 'edito su perfil de usuario', '17/07/2016', '09:50:51'),
(319, 4, 'edito su perfil de usuario', '17/07/2016', '09:50:59'),
(320, 4, 'edito su perfil de usuario', '17/07/2016', '09:51:21'),
(321, 4, 'edito su perfil de usuario', '17/07/2016', '09:51:35'),
(322, 4, 'edito su perfil de usuario', '17/07/2016', '09:52:18'),
(323, 4, 'Cierre de sesion', '17/07/2016', '09:52:21'),
(324, 4, 'Inicio de sesion', '17/07/2016', '09:52:30'),
(325, 4, 'edito su perfil de usuario', '17/07/2016', '09:52:39'),
(326, 4, 'Cierre de sesion', '17/07/2016', '09:54:11'),
(327, 5, 'Inicio de sesion', '17/07/2016', '09:54:15'),
(328, 5, 'Cierre de sesion', '17/07/2016', '09:54:21'),
(329, 2, 'Inicio de sesion', '17/07/2016', '09:54:25'),
(330, 2, 'se agrego un nuevo usuario lenka', '17/07/2016', '09:54:59'),
(331, 2, 'se modifico los permisos para el cargo Emisor', '17/07/2016', '09:55:11'),
(332, 2, 'Cierre de sesion', '17/07/2016', '09:55:13'),
(333, 6, 'Inicio de sesion', '17/07/2016', '09:55:17'),
(334, 5, 'Inicio de sesion', '17/07/2016', '09:55:38'),
(335, 5, 'Cierre de sesion', '17/07/2016', '10:12:49'),
(336, 2, 'Inicio de sesion', '17/07/2016', '10:12:53'),
(337, 2, 'Cierre de sesion', '17/07/2016', '10:16:31'),
(338, 5, 'Inicio de sesion', '17/07/2016', '10:16:38'),
(339, 5, 'Cierre de sesion', '17/07/2016', '10:16:44'),
(340, 4, 'Inicio de sesion', '17/07/2016', '10:16:48'),
(341, 4, 'Cierre de sesion', '17/07/2016', '10:24:50'),
(342, 3, 'Inicio de sesion', '17/07/2016', '10:24:55'),
(343, 3, 'Cierre de sesion', '17/07/2016', '10:25:32'),
(344, 4, 'Inicio de sesion', '17/07/2016', '10:25:36'),
(345, 4, 'Cierre de sesion', '17/07/2016', '10:29:54'),
(346, 3, 'Inicio de sesion', '17/07/2016', '10:30:13'),
(347, 3, 'Cierre de sesion', '17/07/2016', '10:30:29'),
(348, 4, 'Inicio de sesion', '17/07/2016', '10:30:33'),
(349, 4, 'Cierre de sesion', '17/07/2016', '10:32:07'),
(350, 5, 'Inicio de sesion', '17/07/2016', '10:32:13'),
(351, 5, 'Cierre de sesion', '17/07/2016', '10:37:31'),
(352, 5, 'Inicio de sesion', '17/07/2016', '10:37:35'),
(353, 5, 'Cierre de sesion', '17/07/2016', '10:37:39'),
(354, 6, 'Inicio de sesion', '17/07/2016', '10:37:43'),
(355, 6, 'Cierre de sesion', '17/07/2016', '10:45:51'),
(356, 2, 'Inicio de sesion', '17/07/2016', '10:45:55'),
(357, 2, 'se modifico el flujo de documentos del area General', '17/07/2016', '10:46:50'),
(358, 2, 'Cierre de sesion', '17/07/2016', '10:50:36'),
(359, 3, 'Inicio de sesion', '17/07/2016', '10:50:42'),
(360, 3, 'Cierre de sesion', '17/07/2016', '10:51:00'),
(361, 4, 'Inicio de sesion', '17/07/2016', '10:51:06'),
(362, 4, 'Cierre de sesion', '17/07/2016', '10:51:32'),
(363, 5, 'Inicio de sesion', '17/07/2016', '10:51:36'),
(364, 5, 'Cierre de sesion', '17/07/2016', '11:07:20'),
(365, 3, 'Inicio de sesion', '17/07/2016', '11:07:24'),
(366, 3, 'Cierre de sesion', '17/07/2016', '11:07:59'),
(367, 4, 'Inicio de sesion', '17/07/2016', '11:08:04'),
(368, 4, 'Cierre de sesion', '17/07/2016', '11:10:29'),
(369, 5, 'Inicio de sesion', '17/07/2016', '11:10:33'),
(370, 5, 'Cierre de sesion', '17/07/2016', '11:10:36'),
(371, 3, 'Inicio de sesion', '17/07/2016', '11:10:41'),
(372, 3, 'Cierre de sesion', '17/07/2016', '11:12:08'),
(373, 2, 'Inicio de sesion', '17/07/2016', '11:12:13'),
(374, 2, 'Cierre de sesion', '17/07/2016', '11:20:55'),
(375, 4, 'Inicio de sesion', '17/07/2016', '11:20:59'),
(376, 4, 'Cierre de sesion', '17/07/2016', '11:21:47'),
(377, 5, 'Inicio de sesion', '17/07/2016', '11:21:51'),
(378, 5, 'Cierre de sesion', '17/07/2016', '11:21:54'),
(379, 6, 'Inicio de sesion', '17/07/2016', '11:21:58'),
(380, 6, 'Cierre de sesion', '17/07/2016', '11:22:01'),
(381, 5, 'Inicio de sesion', '17/07/2016', '11:22:05'),
(382, 5, 'Cierre de sesion', '17/07/2016', '11:23:11'),
(383, 2, 'Inicio de sesion', '17/07/2016', '11:23:14'),
(384, 2, 'Cierre de sesion', '17/07/2016', '11:23:33'),
(385, 4, 'Inicio de sesion', '17/07/2016', '11:23:37'),
(386, 4, 'Cierre de sesion', '17/07/2016', '11:24:32'),
(387, 5, 'Inicio de sesion', '17/07/2016', '11:24:36'),
(388, 5, 'Cierre de sesion', '17/07/2016', '11:24:54'),
(389, 6, 'Inicio de sesion', '17/07/2016', '11:24:59'),
(390, 6, 'Cierre de sesion', '17/07/2016', '11:30:08'),
(391, 2, 'Inicio de sesion', '17/07/2016', '11:30:12'),
(392, 2, 'se modifico el flujo de documentos del area General', '17/07/2016', '11:31:54'),
(393, 2, 'se modifico el flujo de documentos del area General', '17/07/2016', '11:32:15'),
(394, 2, 'Cierre de sesion', '17/07/2016', '11:32:23'),
(395, 4, 'Inicio de sesion', '17/07/2016', '11:32:27'),
(396, 4, 'Cierre de sesion', '17/07/2016', '11:32:38'),
(397, 5, 'Inicio de sesion', '17/07/2016', '11:32:42'),
(398, 5, 'Cierre de sesion', '17/07/2016', '11:32:52'),
(399, 2, 'Inicio de sesion', '17/07/2016', '11:32:56'),
(400, 2, 'Cierre de sesion', '17/07/2016', '11:33:07'),
(401, 4, 'Inicio de sesion', '17/07/2016', '11:33:10'),
(402, 4, 'Cierre de sesion', '17/07/2016', '11:33:34'),
(403, 2, 'Inicio de sesion', '17/07/2016', '11:33:38'),
(404, 2, 'Cierre de sesion', '17/07/2016', '11:34:12'),
(405, 3, 'Inicio de sesion', '17/07/2016', '11:34:18'),
(406, 3, 'Cierre de sesion', '17/07/2016', '11:34:47'),
(407, 2, 'Inicio de sesion', '17/07/2016', '11:34:51'),
(408, 2, 'se modifico el flujo de documentos del area General', '17/07/2016', '11:35:10'),
(409, 2, 'Cierre de sesion', '17/07/2016', '11:44:26'),
(410, 4, 'Inicio de sesion', '17/07/2016', '11:44:31'),
(411, 4, 'Cierre de sesion', '17/07/2016', '11:44:47'),
(412, 5, 'Inicio de sesion', '17/07/2016', '11:44:53'),
(413, 5, 'Cierre de sesion', '17/07/2016', '11:45:05'),
(414, 4, 'Inicio de sesion', '17/07/2016', '11:45:10'),
(415, 4, 'Cierre de sesion', '17/07/2016', '11:45:14'),
(416, 6, 'Inicio de sesion', '17/07/2016', '11:45:19'),
(417, 6, 'Cierre de sesion', '17/07/2016', '11:45:55'),
(418, 2, 'Inicio de sesion', '17/07/2016', '11:45:59'),
(419, 2, 'se modifico el flujo de documentos del area General', '17/07/2016', '11:50:03'),
(420, 2, 'Cierre de sesion', '17/07/2016', '11:50:06'),
(421, 6, 'Inicio de sesion', '17/07/2016', '11:50:11'),
(422, 6, 'Cierre de sesion', '18/07/2016', '12:20:01'),
(423, 2, 'Inicio de sesion', '18/07/2016', '12:20:06'),
(424, 2, 'Cierre de sesion', '18/07/2016', '12:25:31'),
(425, 4, 'Inicio de sesion', '18/07/2016', '12:25:34'),
(426, 4, 'Cierre de sesion', '18/07/2016', '12:25:43'),
(427, 5, 'Inicio de sesion', '18/07/2016', '12:25:46'),
(428, 5, 'Cierre de sesion', '18/07/2016', '12:25:54'),
(429, 6, 'Inicio de sesion', '18/07/2016', '12:26:00'),
(430, 6, 'Cierre de sesion', '18/07/2016', '12:35:03');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `emision`
--

INSERT INTO `emision` (`pkemision`, `fkusuario`, `fkdocumento`, `fkarea`) VALUES
(4, 6, '578c5a3602bc88641a000044', 100),
(5, 6, '578c5a3602bc88641a000044', 102);

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
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE IF NOT EXISTS `notificacion` (
`pknotificacion` int(11) NOT NULL,
  `fkavance` int(11) NOT NULL,
  `fkusuario_destino` int(11) NOT NULL,
  `terminado` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`pkusuario`, `ci`, `nombre`, `email`, `telefono`, `archivo`, `fkarea`, `fkcargo`, `estado`) VALUES
(2, 0, 'luis daniel', 'admin@hotmail.com', 78888777, 'luis.crip', 100, 1, 1),
(3, 1, 'alejandro mollejas', 'alejandro@hotmail.com', 123456, 'alejandro.crip', 100, 2, 1),
(4, 123, 'jose', 'jose@hotmail.com', 123, 'jose.crip', 100, 3, 1),
(5, 456, 'miguel', 'miguel@hotmail.com', 456, 'miguel.crip', 100, 4, 1),
(6, 987, 'lenka', 'ramirez@hotmail.com', 987, 'lenka.crip', 100, 5, 1);

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
MODIFY `pkavance` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
MODIFY `pkbitacora` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=431;
--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
MODIFY `pkcargo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `emision`
--
ALTER TABLE `emision`
MODIFY `pkemision` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
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
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
MODIFY `pknotificacion` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
MODIFY `pktipo_documento` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
MODIFY `pkusuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
