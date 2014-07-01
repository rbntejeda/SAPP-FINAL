-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-07-2014 a las 12:49:38
-- Versión del servidor: 5.5.33
-- Versión de PHP: 5.4.4-14+deb7u7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `db_ctrl_practicas`
--
CREATE DATABASE `db_ctrl_practicas` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_ctrl_practicas`;

DELIMITER $$
--
-- Funciones
--
CREATE DEFINER=`grupo33`@`localhost` FUNCTION `validate_rut`(RUT VARCHAR(12)) RETURNS int(11)
BEGIN
	DECLARE strlen INT;
	DECLARE i INT;
	DECLARE j INT;
	DECLARE suma NUMERIC;
	DECLARE temprut VARCHAR(12);
	DECLARE verify_dv CHAR(2);
	DECLARE DV CHAR(1);
	SET RUT = REPLACE(REPLACE(RUT, '.', ''),'-','');
	SET DV = SUBSTR(RUT,-1,1);
	SET RUT = SUBSTR(RUT,1,LENGTH(RUT)-1);
	SET i = 1;
  	SET strlen = LENGTH(RUT);
  	SET j = 2;
  	SET suma = 0;
	IF strlen = 8 OR strlen = 7 THEN
		SET temprut = REVERSE(RUT);
		moduloonce: LOOP
		    IF i <= LENGTH(temprut) THEN
    			SET suma = suma + (CONVERT(SUBSTRING(temprut, i, 1),UNSIGNED INTEGER) * j); 
	      		SET i = i + 1;
	      		IF j = 7 THEN
		    		SET j = 2;
	    		ELSE
	    			SET j = j + 1;
    			END IF;
	      		ITERATE moduloonce;
		    END IF;
		    LEAVE moduloonce;
	  	END LOOP moduloonce;
	  	SET verify_dv = 11 - (suma % 11);
	  	IF verify_dv = 11 THEN
	  		SET verify_dv = 0;
	  	ELSEIF verify_dv = 10 THEN 
	  		SET verify_dv = 'K';
	  	END IF;
	  	IF DV = verify_dv THEN
	  		RETURN 1;
	  	ELSE 
	  		RETURN 0;
	  	END IF;
	END IF;
	RETURN 0;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `bit_admin`
--
CREATE TABLE IF NOT EXISTS `bit_admin` (
`BIT_ID` int(10) unsigned
,`PRA_ID` int(10) unsigned
,`BIT_INGRESO` timestamp
,`BIT_TITULO` varchar(100)
,`BIT_CONTENIDO` text
,`BIT_ESTADO` enum('Enviada','No enviada')
,`PER_ID` int(10) unsigned
,`PRA_TIPO` enum('1','2')
,`PER_NOMBRE` varchar(60)
,`EMP_NOMBRE` varchar(60)
,`CAR_CODIGO` int(10) unsigned
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE IF NOT EXISTS `bitacora` (
  `BIT_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PRA_ID` int(10) unsigned NOT NULL,
  `BIT_INGRESO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `BIT_TITULO` varchar(100) NOT NULL,
  `BIT_CONTENIDO` text NOT NULL,
  `BIT_ESTADO` enum('Enviada','No enviada') NOT NULL DEFAULT 'No enviada',
  PRIMARY KEY (`BIT_ID`,`PRA_ID`),
  KEY `fk_bitacora_practica1` (`PRA_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`BIT_ID`, `PRA_ID`, `BIT_INGRESO`, `BIT_TITULO`, `BIT_CONTENIDO`, `BIT_ESTADO`) VALUES
(8, 1, '2014-06-20 14:34:37', 'nueva bitacora', '20 % no me deja poner signo de interrogación', 'No enviada'),
(9, 1, '2014-06-20 00:23:19', 'bitácora antigua', 'contenido antigua', 'No enviada'),
(11, 2, '2014-06-18 06:27:21', 'titulo 1 ', 'contenido + otras cosas', 'Enviada'),
(12, 1, '2014-06-20 01:31:22', 'bitacora', 'nuevo', 'No enviada'),
(13, 1, '2014-06-20 01:41:52', 'Bitacora 4', 'bitacora', 'No enviada'),
(14, 1, '2014-06-20 14:30:00', 'bitacora5', 'nuevo', 'No enviada'),
(15, 1, '2014-06-20 14:30:51', 'bitacora5', 'nuevo', 'No enviada'),
(16, 1, '2014-06-22 20:48:30', 'Bitacora 8', 'contenido', 'Enviada'),
(17, 1, '2014-06-22 20:53:31', 'bitacora 9', 'contenido numero 9 + cosas', 'Enviada'),
(18, 1, '2014-06-22 20:58:35', 'bitacora buena', 'contenido bueno', 'Enviada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

CREATE TABLE IF NOT EXISTS `carrera` (
  `CAR_CODIGO` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CAR_NOMBRE` varchar(100) NOT NULL,
  `CAR_SIGLA` varchar(7) NOT NULL,
  PRIMARY KEY (`CAR_CODIGO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`CAR_CODIGO`, `CAR_NOMBRE`, `CAR_SIGLA`) VALUES
(1, 'Ingeniería (e) en Computación e Informatica', 'IECI'),
(2, 'Ingeniería Civil Informatica', 'ICINF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenio`
--

CREATE TABLE IF NOT EXISTS `convenio` (
  `CON_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `EMP_ID` int(10) unsigned NOT NULL,
  `CON_ESTADO` enum('VIGENTE','NO VIGENTE') NOT NULL,
  `CON_INGRESO` date NOT NULL,
  `CON_TERMINO` date NOT NULL,
  `CON_DESCRIPCION` text NOT NULL,
  PRIMARY KEY (`CON_ID`,`EMP_ID`),
  KEY `fk_convenio_empresa1` (`EMP_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `convenio`
--

INSERT INTO `convenio` (`CON_ID`, `EMP_ID`, `CON_ESTADO`, `CON_INGRESO`, `CON_TERMINO`, `CON_DESCRIPCION`) VALUES
(1, 8, 'VIGENTE', '2014-06-16', '2024-06-20', 'Prueba de Vista convenios.'),
(7, 8, 'VIGENTE', '2014-06-30', '2015-05-26', 'a'),
(8, 8, 'VIGENTE', '2014-06-30', '2015-05-26', 'a'),
(9, 8, 'VIGENTE', '2014-06-30', '2015-05-26', 'a'),
(10, 8, 'VIGENTE', '2014-06-30', '2015-05-26', '85'),
(11, 8, 'VIGENTE', '2014-06-18', '2014-06-20', '%%%%%%%%%%%%'),
(12, 8, 'VIGENTE', '2014-06-18', '2014-06-20', '%%%%%%%%%%%%');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `convenios`
--
CREATE TABLE IF NOT EXISTS `convenios` (
`EMP_NOMBRE` varchar(60)
,`EMP_RUT` varchar(12)
,`CON_ID` int(10) unsigned
,`EMP_ID` int(10) unsigned
,`CON_ESTADO` enum('VIGENTE','NO VIGENTE')
,`CON_DESCRIPCION` text
,`CON_INGRESO` date
,`CON_TERMINO` date
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_encargado`
--

CREATE TABLE IF NOT EXISTS `docente_encargado` (
  `DOC_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PER_ID` int(10) unsigned NOT NULL,
  `PRA_ID` int(10) unsigned NOT NULL,
  `DOC_VIGENCIA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`DOC_ID`,`PER_ID`,`PRA_ID`),
  KEY `fk_docente_encargado_practica1_idx` (`PRA_ID`),
  KEY `fk_docente_encargado_persona1` (`PER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `EMP_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `EMP_NOMBRE` varchar(60) DEFAULT NULL,
  `EMP_RUT` varchar(12) DEFAULT NULL,
  `EMP_DIRECCION` varchar(100) DEFAULT NULL,
  `EMP_CONTACTO` char(60) DEFAULT NULL,
  `EMP_CORREO` varchar(30) DEFAULT NULL,
  `EMP_TELEFONO` varchar(20) DEFAULT NULL,
  `EMP_INGRESO` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`EMP_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`EMP_ID`, `EMP_NOMBRE`, `EMP_RUT`, `EMP_DIRECCION`, `EMP_CONTACTO`, `EMP_CORREO`, `EMP_TELEFONO`, `EMP_INGRESO`) VALUES
(8, 'Ganga', '21.671.497-0', 'Calle 1', 'María Torres', 'contacto@ganga.cl', '65897452', '2014-06-16 04:00:00'),
(9, 'Lider', '7.206.803.3', 'Collao 365', 'Ricky Ricón', 'contacto@lider.cl', '99021785', '2014-06-16 04:00:00'),
(10, 'GANGA', '16.620.402-k', '123', '788*9', 'GANGA@UB.CL', '1234AA', '2014-06-26 14:01:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evalua`
--

CREATE TABLE IF NOT EXISTS `evalua` (
  `EVA_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PRA_ID` int(10) unsigned NOT NULL,
  `EMP_ID` int(10) unsigned NOT NULL,
  `REP_ID` int(10) unsigned NOT NULL,
  `EVA_VIGENCIA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`EVA_ID`,`PRA_ID`,`EMP_ID`,`REP_ID`),
  KEY `fk_evalua_practica1_idx` (`PRA_ID`),
  KEY `fk_evalua_empresa1_idx` (`EMP_ID`),
  KEY `fk_evalua_representante1_idx` (`REP_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `not_presentacion`
--
CREATE TABLE IF NOT EXISTS `not_presentacion` (
`CAR_NOMBRE` varchar(100)
,`CAR_SIGLA` varchar(7)
,`NOT_TITULO` varchar(100)
,`NOT_CONTENIDO` text
,`OFR_INICIO` date
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `NOT_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NOT_TITULO` varchar(100) NOT NULL,
  `NOT_CONTENIDO` text NOT NULL,
  PRIMARY KEY (`NOT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`NOT_ID`, `NOT_TITULO`, `NOT_CONTENIDO`) VALUES
(4, 'Solicitud de practica profesional II', 'Los interesados, como requisito básico deben tener conocimientos en PHP, \r\nPatrón MVC y un buen conocimiento en Base de Datos, además de tener \r\niniciativa y ser proactivos, ya que deberán estar en constante \r\naprendizaje de distintas cosas.\r\n\r\nLos CV se pueden hacer llegar a contacto@losalces.cl\r\n\r\nSe realizara entrevista y una pequeña prueba de conocimientos.'),
(5, 'OFERTA PRÁCTICA PROFESIONAL', 'REQUISITOS POSTULANTES\r\nSexo (F-M)        FEMENINO - MASCULINO                                         \r\nEdad:        MAYOR DE EDAD                                         \r\nCarreras:        NIVEL TÉCNICO O INGENIERÍA E COMPUTACIÓN E INFORMATICA                                         \r\n\r\n                                                \r\nREQUISITOS PARA EL CARGO                                                 \r\nNombre del Cargo:        ESTUDIANTE EN PRÁCTICA                                         \r\nÁrea:        SISTEMAS                                         \r\nDescripción del Cargo:        Apoyo area sistemas en Instalar, mantener y solucionar problemas de ejecución de hardware y software, redes  y de comunicaciones de acuerdo a los requerimientos de la organización para mantener una constante, exacta y oportuna operación.         \r\n                                        \r\nCésar E. Figueroa P.'),
(6, 'Se nesesita Alumno en practica Huachipato 3', 'hola +6\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofrece`
--

CREATE TABLE IF NOT EXISTS `ofrece` (
  `OFR_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CAR_CODIGO` int(10) unsigned NOT NULL,
  `NOT_ID` int(10) unsigned NOT NULL,
  `OFR_INICIO` date NOT NULL,
  `OFR_TERMINO` date NOT NULL,
  `OFR_ESTADO` enum('Activo','Inactivo') NOT NULL,
  PRIMARY KEY (`OFR_ID`),
  KEY `fk_ofrece_carrera1_idx` (`CAR_CODIGO`),
  KEY `fk_ofrece_noticias1_idx` (`NOT_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `ofrece`
--

INSERT INTO `ofrece` (`OFR_ID`, `CAR_CODIGO`, `NOT_ID`, `OFR_INICIO`, `OFR_TERMINO`, `OFR_ESTADO`) VALUES
(6, 1, 4, '2014-06-20', '2014-12-30', 'Activo'),
(7, 2, 4, '2014-06-20', '2014-12-30', 'Activo'),
(8, 1, 5, '2014-06-20', '2014-12-29', 'Activo'),
(10, 1, 6, '2014-06-20', '2014-06-30', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE IF NOT EXISTS `persona` (
  `PER_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CAR_CODIGO` int(10) unsigned NOT NULL,
  `PER_RUT` varchar(12) NOT NULL,
  `PER_NOMBRE` varchar(60) NOT NULL,
  `PER_CORREO` varchar(40) DEFAULT NULL,
  `PER_TELEFONO` varchar(20) DEFAULT NULL,
  `PER_ROLE` varchar(12) NOT NULL,
  PRIMARY KEY (`PER_ID`,`CAR_CODIGO`),
  KEY `fk_persona_carrera1_idx` (`CAR_CODIGO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`PER_ID`, `CAR_CODIGO`, `PER_RUT`, `PER_NOMBRE`, `PER_CORREO`, `PER_TELEFONO`, `PER_ROLE`) VALUES
(1, 1, '18.108.559-2', 'Ruben Eduardo Tejeda Roa', NULL, '+56 91223304', 'alumno'),
(2, 1, '11.111.111-1', 'Administrador', NULL, '91223304', 'admin'),
(3, 1, '22.222.222-2', 'Profesor', NULL, '', 'profesor'),
(4, 1, '17.346.658-7', 'Pablo Morales Alarcón', 'pamoral@alumnos.ubiobio.cl', '83993194', 'alumno'),
(6, 1, '17.203.412-8', 'Elizabeth Margarita Marquez Neira', 'emarquez@alumnos.ubiobio.cl', '133', 'alumno'),
(9, 1, '33.333.333-3', 'Usuario', NULL, NULL, 'alumno'),
(32, 1, '17.853.699-0', 'Ronald Pinto', 'ronydance@gmai.com', '+56921648', 'alumno'),
(33, 1, '17.641.354-9', '"#$', '', '', 'alumno'),
(34, 1, '99.999.999-9', 'nil', 'nil@gnjj.lp', '14789631', 'alumno'),
(35, 2, '14.273.436-2', '456', 'jany@ubb.cl', '4567894', 'alumno');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `pra_totales`
--
CREATE TABLE IF NOT EXISTS `pra_totales` (
`PRA_ID` int(10) unsigned
,`CAR_CODIGO` int(10) unsigned
,`PER_RUT` varchar(12)
,`PER_NOMBRE` varchar(60)
,`PRA_ESTPRACTICA` enum('Aprobado','Rechazado','Pendiente','NCR','Reprobado')
,`PRA_TIPO` enum('1','2')
,`PRA_ESTF1` int(1)
,`PRA_ESTF3` int(1)
,`PRA_ESTINFORME` int(1)
,`PRA_EVAEMPRESA` decimal(2,1) unsigned
,`PRA_EVAPROFESOR` decimal(2,1) unsigned
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `practica`
--

CREATE TABLE IF NOT EXISTS `practica` (
  `PRA_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CAR_CODIGO` int(10) unsigned NOT NULL,
  `PER_ID` int(10) unsigned NOT NULL,
  `PRA_ESTPRACTICA` enum('Aprobado','Rechazado','Pendiente','NCR','Reprobado') NOT NULL,
  `PRA_ESTF1` int(1) NOT NULL,
  `PRA_ESTF3` int(1) NOT NULL,
  `PRA_ESTINFORME` int(1) NOT NULL,
  `PRA_EVAEMPRESA` decimal(2,1) unsigned DEFAULT NULL,
  `PRA_EVAPROFESOR` decimal(2,1) unsigned DEFAULT NULL,
  `PRA_DESCRIPCION` text NOT NULL,
  `PRA_INICIO` date NOT NULL,
  `PRA_TERMINO` date NOT NULL,
  `PRA_TIPO` enum('1','2') NOT NULL,
  PRIMARY KEY (`PRA_ID`,`CAR_CODIGO`,`PER_ID`),
  KEY `fk_practica_persona1_idx` (`PER_ID`,`CAR_CODIGO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `practica`
--

INSERT INTO `practica` (`PRA_ID`, `CAR_CODIGO`, `PER_ID`, `PRA_ESTPRACTICA`, `PRA_ESTF1`, `PRA_ESTF3`, `PRA_ESTINFORME`, `PRA_EVAEMPRESA`, `PRA_EVAPROFESOR`, `PRA_DESCRIPCION`, `PRA_INICIO`, `PRA_TERMINO`, `PRA_TIPO`) VALUES
(1, 1, 4, 'Pendiente', 1, 1, 1, 4.0, 3.0, 'holi', '0000-00-00', '2014-04-15', '1'),
(2, 1, 6, 'Aprobado', 1, 1, 1, 4.0, 6.0, 'prueba', '0000-00-00', '2014-04-16', '2'),
(3, 1, 4, 'Pendiente', 0, 0, 0, NULL, NULL, 'practica de usuario', '2014-06-20', '0000-00-00', '1'),
(12, 1, 34, 'Pendiente', 0, 0, 0, NULL, NULL, 'practica 1', '2014-06-20', '0000-00-00', '1'),
(13, 1, 4, 'Pendiente', 0, 0, 0, NULL, NULL, 'nueva práctica', '2014-06-20', '0000-00-00', '2'),
(14, 2, 35, 'Pendiente', 0, 0, 0, NULL, NULL, 'PRACTICA DE SOPORTE DE BASE DE DATOS', '2014-06-26', '0000-00-00', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representante`
--

CREATE TABLE IF NOT EXISTS `representante` (
  `REP_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `REP_NOMBRE` varchar(60) NOT NULL,
  `REP_RUT` varchar(12) NOT NULL,
  `REP_CORREO` varchar(50) DEFAULT NULL,
  `REP_FONO` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`REP_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `usu_activos`
--
CREATE TABLE IF NOT EXISTS `usu_activos` (
`PER_NOMBRE` varchar(60)
,`PER_RUT` varchar(12)
,`PER_ROLE` varchar(12)
,`USU_CREATE` timestamp
,`USU_MODIFIED` timestamp
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `usu_alumnos`
--
CREATE TABLE IF NOT EXISTS `usu_alumnos` (
`PER_ID` int(10) unsigned
,`CAR_CODIGO` int(10) unsigned
,`PER_RUT` varchar(12)
,`PER_NOMBRE` varchar(60)
,`USU_ESTADO` char(1)
,`USU_MODIFIED` timestamp
,`USU_CREATE` timestamp
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `usu_login`
--
CREATE TABLE IF NOT EXISTS `usu_login` (
`PER_ID` int(10) unsigned
,`username` varchar(12)
,`password` varchar(32)
,`PER_ROLE` varchar(12)
,`PER_NOMBRE` varchar(60)
,`CAR_CODIGO` int(10) unsigned
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `usu_profesores`
--
CREATE TABLE IF NOT EXISTS `usu_profesores` (
`PER_RUT` varchar(12)
,`USU_PASSWORD` varchar(32)
,`PER_ROLE` varchar(12)
,`PER_NOMBRE` varchar(60)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `usu_sinasignar`
--
CREATE TABLE IF NOT EXISTS `usu_sinasignar` (
`PER_ROLE` varchar(12)
,`CAR_CODIGO` int(10) unsigned
,`Nombre` varchar(73)
,`PER_ID` int(10) unsigned
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `usu_todos`
--
CREATE TABLE IF NOT EXISTS `usu_todos` (
`PER_ID` int(10) unsigned
,`PER_RUT` varchar(12)
,`PER_NOMBRE` varchar(60)
,`PER_ROLE` varchar(12)
,`USU_ESTADO` char(1)
,`USU_MODIFIED` timestamp
,`USU_CREATE` timestamp
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `PER_ID` int(10) unsigned NOT NULL,
  `USU_PASSWORD` varchar(32) NOT NULL,
  `USU_MODIFIED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `USU_CREATE` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `USU_ESTADO` char(1) NOT NULL DEFAULT 'H',
  PRIMARY KEY (`PER_ID`),
  KEY `fk_usuario_persona_idx` (`PER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`PER_ID`, `USU_PASSWORD`, `USU_MODIFIED`, `USU_CREATE`, `USU_ESTADO`) VALUES
(1, 'e10adc3949ba59abbe56e057f20f883e', '2014-06-20 15:05:22', '2014-04-17 10:04:15', 'H'),
(2, '21232f297a57a5a743894a0e4a801fc3', '2014-06-20 04:20:23', '2014-04-15 17:05:17', 'H'),
(3, '793741d54b00253006453742ad4ed534', '2014-04-21 13:21:47', '2014-04-21 13:21:47', 'H'),
(4, '5dd372e99be2842d2fe2bfe870c5a73e', '2014-05-26 17:15:28', '2014-04-21 00:04:46', 'H'),
(6, '827ccb0eea8a706c4c34a16891f84e7b', '2014-06-16 23:37:21', '2014-05-06 20:08:59', 'H');

-- --------------------------------------------------------

--
-- Estructura para la vista `bit_admin`
--
DROP TABLE IF EXISTS `bit_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`grupo33`@`localhost` SQL SECURITY DEFINER VIEW `bit_admin` AS select `b`.`BIT_ID` AS `BIT_ID`,`pr`.`PRA_ID` AS `PRA_ID`,`b`.`BIT_INGRESO` AS `BIT_INGRESO`,`b`.`BIT_TITULO` AS `BIT_TITULO`,`b`.`BIT_CONTENIDO` AS `BIT_CONTENIDO`,`b`.`BIT_ESTADO` AS `BIT_ESTADO`,`pe`.`PER_ID` AS `PER_ID`,`pr`.`PRA_TIPO` AS `PRA_TIPO`,`pe`.`PER_NOMBRE` AS `PER_NOMBRE`,`em`.`EMP_NOMBRE` AS `EMP_NOMBRE`,`pe`.`CAR_CODIGO` AS `CAR_CODIGO` from (((((`bitacora` `b` left join `practica` `pr` on((`b`.`PRA_ID` = `pr`.`PRA_ID`))) join `persona` `pe` on((`pr`.`PER_ID` = `pe`.`PER_ID`))) left join `evalua` `ev` on((`pr`.`PRA_ID` = `ev`.`PRA_ID`))) left join `representante` `r` on((`ev`.`REP_ID` = `r`.`REP_ID`))) left join `empresa` `em` on((`ev`.`EMP_ID` = `em`.`EMP_ID`)));

-- --------------------------------------------------------

--
-- Estructura para la vista `convenios`
--
DROP TABLE IF EXISTS `convenios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`grupo33`@`localhost` SQL SECURITY DEFINER VIEW `convenios` AS select `e`.`EMP_NOMBRE` AS `EMP_NOMBRE`,`e`.`EMP_RUT` AS `EMP_RUT`,`c`.`CON_ID` AS `CON_ID`,`e`.`EMP_ID` AS `EMP_ID`,`c`.`CON_ESTADO` AS `CON_ESTADO`,`c`.`CON_DESCRIPCION` AS `CON_DESCRIPCION`,`c`.`CON_INGRESO` AS `CON_INGRESO`,`c`.`CON_TERMINO` AS `CON_TERMINO` from (`empresa` `e` join `convenio` `c`) where (`e`.`EMP_ID` = `c`.`EMP_ID`);

-- --------------------------------------------------------

--
-- Estructura para la vista `not_presentacion`
--
DROP TABLE IF EXISTS `not_presentacion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`grupo33`@`localhost` SQL SECURITY DEFINER VIEW `not_presentacion` AS select `c`.`CAR_NOMBRE` AS `CAR_NOMBRE`,`c`.`CAR_SIGLA` AS `CAR_SIGLA`,`n`.`NOT_TITULO` AS `NOT_TITULO`,`n`.`NOT_CONTENIDO` AS `NOT_CONTENIDO`,`o`.`OFR_INICIO` AS `OFR_INICIO` from ((`carrera` `c` join `ofrece` `o` on((`c`.`CAR_CODIGO` = `o`.`CAR_CODIGO`))) join `noticias` `n` on((`o`.`NOT_ID` = `n`.`NOT_ID`))) where ((`o`.`OFR_ESTADO` = 'Activo') and (curdate() >= `o`.`OFR_INICIO`) and (curdate() <= `o`.`OFR_TERMINO`));

-- --------------------------------------------------------

--
-- Estructura para la vista `pra_totales`
--
DROP TABLE IF EXISTS `pra_totales`;

CREATE ALGORITHM=UNDEFINED DEFINER=`grupo33`@`localhost` SQL SECURITY DEFINER VIEW `pra_totales` AS select `p`.`PRA_ID` AS `PRA_ID`,`p`.`CAR_CODIGO` AS `CAR_CODIGO`,`per`.`PER_RUT` AS `PER_RUT`,`per`.`PER_NOMBRE` AS `PER_NOMBRE`,`p`.`PRA_ESTPRACTICA` AS `PRA_ESTPRACTICA`,`p`.`PRA_TIPO` AS `PRA_TIPO`,`p`.`PRA_ESTF1` AS `PRA_ESTF1`,`p`.`PRA_ESTF3` AS `PRA_ESTF3`,`p`.`PRA_ESTINFORME` AS `PRA_ESTINFORME`,`p`.`PRA_EVAEMPRESA` AS `PRA_EVAEMPRESA`,`p`.`PRA_EVAPROFESOR` AS `PRA_EVAPROFESOR` from (`practica` `p` join `persona` `per`) where (`per`.`PER_ID` = `p`.`PER_ID`);

-- --------------------------------------------------------

--
-- Estructura para la vista `usu_activos`
--
DROP TABLE IF EXISTS `usu_activos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`grupo33`@`localhost` SQL SECURITY DEFINER VIEW `usu_activos` AS select `p`.`PER_NOMBRE` AS `PER_NOMBRE`,`p`.`PER_RUT` AS `PER_RUT`,`p`.`PER_ROLE` AS `PER_ROLE`,`u`.`USU_CREATE` AS `USU_CREATE`,`u`.`USU_MODIFIED` AS `USU_MODIFIED` from (`usuario` `u` join `persona` `p` on((`u`.`PER_ID` = `p`.`PER_ID`))) where (`u`.`USU_ESTADO` = 'H');

-- --------------------------------------------------------

--
-- Estructura para la vista `usu_alumnos`
--
DROP TABLE IF EXISTS `usu_alumnos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`grupo33`@`localhost` SQL SECURITY DEFINER VIEW `usu_alumnos` AS select `u`.`PER_ID` AS `PER_ID`,`p`.`CAR_CODIGO` AS `CAR_CODIGO`,`p`.`PER_RUT` AS `PER_RUT`,`p`.`PER_NOMBRE` AS `PER_NOMBRE`,`u`.`USU_ESTADO` AS `USU_ESTADO`,`u`.`USU_MODIFIED` AS `USU_MODIFIED`,`u`.`USU_CREATE` AS `USU_CREATE` from (`persona` `p` join `usuario` `u` on((`p`.`PER_ID` = `u`.`PER_ID`))) where (`p`.`PER_ROLE` = 'ALUMNO');

-- --------------------------------------------------------

--
-- Estructura para la vista `usu_login`
--
DROP TABLE IF EXISTS `usu_login`;

CREATE ALGORITHM=UNDEFINED DEFINER=`grupo33`@`localhost` SQL SECURITY DEFINER VIEW `usu_login` AS select `persona`.`PER_ID` AS `PER_ID`,`persona`.`PER_RUT` AS `username`,`usuario`.`USU_PASSWORD` AS `password`,`persona`.`PER_ROLE` AS `PER_ROLE`,`persona`.`PER_NOMBRE` AS `PER_NOMBRE`,`persona`.`CAR_CODIGO` AS `CAR_CODIGO` from (`persona` join `usuario` on((`persona`.`PER_ID` = `usuario`.`PER_ID`))) where (`usuario`.`USU_ESTADO` = 'H');

-- --------------------------------------------------------

--
-- Estructura para la vista `usu_profesores`
--
DROP TABLE IF EXISTS `usu_profesores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`grupo33`@`localhost` SQL SECURITY DEFINER VIEW `usu_profesores` AS select `persona`.`PER_RUT` AS `PER_RUT`,`usuario`.`USU_PASSWORD` AS `USU_PASSWORD`,`persona`.`PER_ROLE` AS `PER_ROLE`,`persona`.`PER_NOMBRE` AS `PER_NOMBRE` from (`persona` join `usuario` on((`persona`.`PER_ID` = `usuario`.`PER_ID`))) where ((`persona`.`PER_ROLE` = 'PROFESOR') and (`usuario`.`USU_ESTADO` = 'H'));

-- --------------------------------------------------------

--
-- Estructura para la vista `usu_sinasignar`
--
DROP TABLE IF EXISTS `usu_sinasignar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`grupo33`@`localhost` SQL SECURITY DEFINER VIEW `usu_sinasignar` AS select `p`.`PER_ROLE` AS `PER_ROLE`,`p`.`CAR_CODIGO` AS `CAR_CODIGO`,concat(`p`.`PER_RUT`,' ',`p`.`PER_NOMBRE`) AS `Nombre`,`p`.`PER_ID` AS `PER_ID` from `persona` `p` where (not(exists(select 1 from `usuario` `u` where (`p`.`PER_ID` = `u`.`PER_ID`))));

-- --------------------------------------------------------

--
-- Estructura para la vista `usu_todos`
--
DROP TABLE IF EXISTS `usu_todos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`grupo33`@`localhost` SQL SECURITY DEFINER VIEW `usu_todos` AS select `u`.`PER_ID` AS `PER_ID`,`p`.`PER_RUT` AS `PER_RUT`,`p`.`PER_NOMBRE` AS `PER_NOMBRE`,`p`.`PER_ROLE` AS `PER_ROLE`,`u`.`USU_ESTADO` AS `USU_ESTADO`,`u`.`USU_MODIFIED` AS `USU_MODIFIED`,`u`.`USU_CREATE` AS `USU_CREATE` from (`persona` `p` join `usuario` `u` on((`p`.`PER_ID` = `u`.`PER_ID`)));

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `fk_bitacora_practica1` FOREIGN KEY (`PRA_ID`) REFERENCES `practica` (`PRA_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `convenio`
--
ALTER TABLE `convenio`
  ADD CONSTRAINT `fk_convenio_empresa1` FOREIGN KEY (`EMP_ID`) REFERENCES `empresa` (`EMP_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `docente_encargado`
--
ALTER TABLE `docente_encargado`
  ADD CONSTRAINT `fk_docente_encargado_persona1` FOREIGN KEY (`PER_ID`) REFERENCES `persona` (`PER_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_docente_encargado_practica1` FOREIGN KEY (`PRA_ID`) REFERENCES `practica` (`PRA_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evalua`
--
ALTER TABLE `evalua`
  ADD CONSTRAINT `fk_evalua_empresa1` FOREIGN KEY (`EMP_ID`) REFERENCES `empresa` (`EMP_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evalua_practica1` FOREIGN KEY (`PRA_ID`) REFERENCES `practica` (`PRA_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_evalua_representante1` FOREIGN KEY (`REP_ID`) REFERENCES `representante` (`REP_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ofrece`
--
ALTER TABLE `ofrece`
  ADD CONSTRAINT `fk_ofrece_carrera1` FOREIGN KEY (`CAR_CODIGO`) REFERENCES `carrera` (`CAR_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ofrece_noticias1` FOREIGN KEY (`NOT_ID`) REFERENCES `noticias` (`NOT_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_persona_carrera1` FOREIGN KEY (`CAR_CODIGO`) REFERENCES `carrera` (`CAR_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `practica`
--
ALTER TABLE `practica`
  ADD CONSTRAINT `fk_practica_persona1` FOREIGN KEY (`PER_ID`, `CAR_CODIGO`) REFERENCES `persona` (`PER_ID`, `CAR_CODIGO`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_persona` FOREIGN KEY (`PER_ID`) REFERENCES `persona` (`PER_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
