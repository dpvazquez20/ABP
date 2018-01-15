-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-01-2018 a las 03:37:58
-- Versión del servidor: 5.7.19
-- Versión de PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `actifit`
--
CREATE DATABASE IF NOT EXISTS `actifit` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `actifit`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE IF NOT EXISTS `actividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `descripcion` longtext,
  `frecuencia` varchar(50) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `numMaxParticipantes` int(11) NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE IF NOT EXISTS `ejercicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `descripcion` longtext,
  `imagen` varchar(90) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`),
  UNIQUE KEY `nombre_2` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ejercicios`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamientos`
--

CREATE TABLE IF NOT EXISTS `entrenamientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  `sesiones` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entrenamientos`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamientos_has_tablas`
--

CREATE TABLE IF NOT EXISTS `entrenamientos_has_tablas` (
  `entrenamiento_id` int(11) NOT NULL,
  `tabla_id` int(11) NOT NULL,
  `orden_sesion` int(11) NOT NULL,
  PRIMARY KEY (`entrenamiento_id`,`tabla_id`,`orden_sesion`),
  KEY `fk_entrenamiento_has_tabla_tabla1_idx` (`tabla_id`),
  KEY `fk_entrenamiento_has_tabla_entrenamiento1_idx` (`entrenamiento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entrenamientos_has_tablas`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamientos_has_usuarios`
--

CREATE TABLE IF NOT EXISTS `entrenamientos_has_usuarios` (
  `entrenamiento_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`entrenamiento_id`,`usuario_id`),
  KEY `fk_entrenamiento_has_usuario_usuario1_idx` (`usuario_id`),
  KEY `fk_entrenamiento_has_usuario_entrenamiento1_idx` (`entrenamiento_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entrenamientos_has_usuarios`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `descripcion` longtext,
  `imagen` varchar(90) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date DEFAULT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eventos`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE IF NOT EXISTS `inscripciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inscripcion_usuario1_idx` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inscripciones`
--




-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones_has_actividades`
--

CREATE TABLE IF NOT EXISTS `inscripciones_has_actividades` (
  `inscripciones_id` int(11) NOT NULL,
  `actividades_id` int(11) NOT NULL,
  PRIMARY KEY (`inscripciones_id`,`actividades_id`),
  KEY `fk_inscripciones_has_actividades_actividades1_idx` (`actividades_id`),
  KEY `fk_inscripciones_has_actividades_inscripciones1_idx` (`inscripciones_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inscripciones_has_actividades`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasdetabla`
--

CREATE TABLE IF NOT EXISTS `lineasdetabla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `repeticiones` varchar(45) DEFAULT NULL,
  `duracion` varchar(45) DEFAULT NULL,
  `descanso` varchar(45) DEFAULT NULL,
  `series` int(11) DEFAULT NULL,
  `tabla_id` int(11) NOT NULL,
  `ejercicio_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`tabla_id`,`ejercicio_id`),
  KEY `fk_lineasDeTabla_tablas1_idx` (`tabla_id`),
  KEY `fk_lineasDeTabla_ejercicios1_idx` (`ejercicio_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `lineasdetabla`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE IF NOT EXISTS `recursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `aforo` varchar(45) DEFAULT NULL,
  `descripcion` longtext,
  `borrado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recursos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  `actividades_id` int(11) NOT NULL,
  `recurso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reservas_actividades1_idx` (`actividades_id`),
  KEY `fk_recursos_id` (`recurso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18992 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reservas`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiondelineadetabla`
--

CREATE TABLE IF NOT EXISTS `sesiondelineadetabla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `completado` tinyint(4) NOT NULL,
  `sesiones_id` int(11) NOT NULL,
  `lineasDeTabla_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`sesiones_id`),
  KEY `fk_sesion_lineaDeTabla_sesiones1_idx` (`sesiones_id`),
  KEY `fk_sesion_lineaDeTabla_lineasDeTabla1_idx` (`lineasDeTabla_id`)
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sesiondelineadetabla`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE IF NOT EXISTS `sesiones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `completado` tinyint(4) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `inicio` datetime DEFAULT NULL,
  `fin` datetime DEFAULT NULL,
  `comentario` varchar(1000) DEFAULT NULL,
  `tablas_id` int(11) NOT NULL,
  `orden_sesion` int(11) NOT NULL,
  `orden_sesion_max` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `entrenamientos_id` int(11) NOT NULL,
  `anterior_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sesiones_tablas1_idx` (`tablas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=271 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sesiones`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablas`
--

CREATE TABLE IF NOT EXISTS `tablas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tablas`
--



-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `contrasenha` varchar(300) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `clase` varchar(10) NOT NULL,
  `entrenador_id` int(11) DEFAULT NULL,
  `entrenador_nombre` varchar(90) DEFAULT NULL,
  `imagen` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--



--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entrenamientos_has_tablas`
--
ALTER TABLE `entrenamientos_has_tablas`
  ADD CONSTRAINT `fk_entrenamiento_has_tabla_entrenamiento1` FOREIGN KEY (`entrenamiento_id`) REFERENCES `entrenamientos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entrenamiento_has_tabla_tabla1` FOREIGN KEY (`tabla_id`) REFERENCES `tablas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `entrenamientos_has_usuarios`
--
ALTER TABLE `entrenamientos_has_usuarios`
  ADD CONSTRAINT `fk_entrenamiento_has_usuario_entrenamiento1` FOREIGN KEY (`entrenamiento_id`) REFERENCES `entrenamientos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_entrenamiento_has_usuario_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `fk_inscripcion_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inscripciones_has_actividades`
--
ALTER TABLE `inscripciones_has_actividades`
  ADD CONSTRAINT `fk_inscripciones_has_actividades_actividades1` FOREIGN KEY (`actividades_id`) REFERENCES `actividades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inscripciones_has_actividades_inscripciones1` FOREIGN KEY (`inscripciones_id`) REFERENCES `inscripciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `lineasdetabla`
--
ALTER TABLE `lineasdetabla`
  ADD CONSTRAINT `fk_lineasDeTabla_ejercicios1` FOREIGN KEY (`ejercicio_id`) REFERENCES `ejercicios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lineasDeTabla_tablas1` FOREIGN KEY (`tabla_id`) REFERENCES `tablas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_recursos_id` FOREIGN KEY (`recurso_id`) REFERENCES `recursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reservas_actividades1` FOREIGN KEY (`actividades_id`) REFERENCES `actividades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sesiondelineadetabla`
--
ALTER TABLE `sesiondelineadetabla`
  ADD CONSTRAINT `fk_sesion_lineaDeTabla_lineasDeTabla1` FOREIGN KEY (`lineasDeTabla_id`) REFERENCES `lineasdetabla` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sesion_lineaDeTabla_sesiones1` FOREIGN KEY (`sesiones_id`) REFERENCES `sesiones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sesiones`
--
ALTER TABLE `sesiones`
  ADD CONSTRAINT `fk_sesiones_tablas1` FOREIGN KEY (`tablas_id`) REFERENCES `tablas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
