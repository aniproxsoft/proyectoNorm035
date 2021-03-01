-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-02-2020 a las 23:18:01
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `norma035db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `division`
--

DROP TABLE IF EXISTS `division`;
CREATE TABLE IF NOT EXISTS `division` (
  `division_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_division` varchar(255) NOT NULL,
  PRIMARY KEY (`division_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `division`
--

INSERT INTO `division` (`division_id`, `nombre_division`) VALUES
(1, 'Administración de empresas'),
(2, 'Informática y computación'),
(3, 'Tecnología ambiental'),
(4, 'Comercialización'),
(5, 'Gestión de la producción'),
(6, 'Telemática');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `num_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empleado` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `nivel_estudios_id` int(11) NOT NULL,
  `statatus_estudios` varchar(1) NOT NULL,
  `division_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`num_empleado`),
  KEY `FK_nivel_estudios` (`nivel_estudios_id`),
  KEY `FK_division` (`division_id`),
  KEY `FK_usuario` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`num_empleado`, `nombre_empleado`, `apellidos`, `edad`, `sexo`, `nivel_estudios_id`, `statatus_estudios`, `division_id`, `usuario_id`, `status`) VALUES
(1, 'Luis Manuel', 'Fernandez Hernandez', 55, 'M', 7, '1', 2, 1, '1'),
(2, 'Gerarado', 'Pluma Bautista', 53, 'M', 7, '1', 2, 2, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado_bulkload`
--

DROP TABLE IF EXISTS `empleado_bulkload`;
CREATE TABLE IF NOT EXISTS `empleado_bulkload` (
  `lote` int(11) NOT NULL,
  `bulkload_id` int(11) NOT NULL,
  `num_empleado` int(11) DEFAULT NULL,
  `nombre_empleado` varchar(500) DEFAULT NULL,
  `apellidos` varchar(500) DEFAULT NULL,
  `edad` varchar(500) DEFAULT NULL,
  `sexo` varchar(500) DEFAULT NULL,
  `nivel_studios` varchar(500) DEFAULT NULL,
  `division` varchar(500) DEFAULT NULL,
  `rol` varchar(500) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `observaciones` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`lote`,`bulkload_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_estudios`
--

DROP TABLE IF EXISTS `nivel_estudios`;
CREATE TABLE IF NOT EXISTS `nivel_estudios` (
  `nivel_estudios_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_estudios` varchar(255) NOT NULL,
  PRIMARY KEY (`nivel_estudios_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nivel_estudios`
--

INSERT INTO `nivel_estudios` (`nivel_estudios_id`, `nombre_estudios`) VALUES
(1, 'Sin formación'),
(2, 'Primaria'),
(3, 'Secundaria'),
(4, 'Preparatoria o Bachillerato'),
(5, 'Técnico Superior'),
(6, 'Licenciatura'),
(7, 'Maestría'),
(8, 'Doctorado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
CREATE TABLE IF NOT EXISTS `pregunta` (
  `pregunta_id` int(11) NOT NULL AUTO_INCREMENT,
  `seccion_id` int(11) DEFAULT NULL,
  `pregunta_desc` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`pregunta_id`),
  KEY `FK_seccion` (`seccion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta`
--

DROP TABLE IF EXISTS `respuesta`;
CREATE TABLE IF NOT EXISTS `respuesta` (
  `respuesta_id` int(11) NOT NULL AUTO_INCREMENT,
  `num_empleado` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `valor_respuesta` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`respuesta_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

DROP TABLE IF EXISTS `seccion`;
CREATE TABLE IF NOT EXISTS `seccion` (
  `seccion_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_seccion` varchar(255) NOT NULL,
  PRIMARY KEY (`seccion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`usuario_id`),
  KEY `FK_usuario_rol` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `password`, `rol_id`, `status`) VALUES
(1, 'f865b53623b121fd34ee5426c792e5c33af8c227', 1, '1'),
(2, '7c222fb2927d828af22f592134e8932480637c0d', 2, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

DROP TABLE IF EXISTS `usuario_rol`;
CREATE TABLE IF NOT EXISTS `usuario_rol` (
  `rol_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(255) NOT NULL,
  `rol_desc` varchar(500) NOT NULL,
  PRIMARY KEY (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`rol_id`, `nombre_rol`, `rol_desc`) VALUES
(1, 'Administrador', 'Este rol puede ver los resultados de los empleados que realizan la guia de referencia'),
(2, 'Docente', 'Este rol es profesor que labora en la presente institucion y contesta las guias'),
(3, 'Otro', 'Este rol es un empleado que labora en la institucion pero  no es docente ni administrativo');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `FK_division` FOREIGN KEY (`division_id`) REFERENCES `division` (`division_id`),
  ADD CONSTRAINT `FK_nivel_estudios` FOREIGN KEY (`nivel_estudios_id`) REFERENCES `nivel_estudios` (`nivel_estudios_id`),
  ADD CONSTRAINT `FK_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`);

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `FK_seccion` FOREIGN KEY (`seccion_id`) REFERENCES `seccion` (`seccion_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`rol_id`) REFERENCES `usuario_rol` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
