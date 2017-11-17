-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-11-2017 a las 22:35:32
-- Versión del servidor: 5.5.44-0+deb8u1
-- Versión de PHP: 5.6.13-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
`id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `descripcion` longtext,
  `frecuencia` varchar(50) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `numMaxParticipantes` int(11) NOT NULL,
  `borrado` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT IGNORE INTO `actividades` (`id`, `nombre`, `descripcion`, `frecuencia`, `horaInicio`, `horaFin`, `tipo`, `numMaxParticipantes`, `borrado`) VALUES
(1, 'Zumba', 'Práctica de ritmos latinos que tiene como objetivo ejercitar todo el cuerpo para pasar un buen rato mientras uno se divierte al mismo tiempo que practica ejercicio.', 'Martes,Jueves', '17:00:00', '18:00:00', 'Grupal', 10, 0),
(2, 'SoftBoxing', 'Ejercicio aeróbico que utiliza movimientos propios del boxeo. ', 'Lunes,Miercoles,Viernes', '19:00:00', '20:00:00', 'Grupal', 10, 0),
(3, 'Spinning', 'Sesión de entrenamiento de alta intensidad con bicicletas estáticas', 'Lunes,Viernes', '16:00:00', '17:00:00', 'Grupal', 20, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE IF NOT EXISTS `ejercicios` (
`id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `descripcion` longtext,
  `imagen` varchar(90) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `borrado` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT IGNORE INTO `ejercicios` (`id`, `nombre`, `descripcion`, `imagen`, `tipo`, `borrado`) VALUES
(1, 'Biceps barra', 'Ejercicio de biceps con barra', 'bicepsbarra.jpg', 'Muscular', 0),
(2, 'Cinta', 'Correr en la cinta', 'cinta.jpg', 'Cardiovascular', 0),
(3, 'Press banca', 'Ejercicio de pecho en banco horizontal. ', 'pressbanca.jpg', 'Muscular', 0),
(4, 'Curl biceps', 'Ejercicio biceps con mancuernas.', 'bicepsmancuerna.jpg', 'Muscular', 0),
(5, 'Dominadas', 'Ejercicio de espalda en barra con peso muerto. ', 'dominadas.jpg', 'Muscular', 0),
(6, 'Remo', 'Ejercicio espalda imitando el movimiento de remo. ', 'remo.jpg', 'Muscular', 0),
(7, 'Ascension triceps', 'Ejercicio triceps levantando la mancuerna por encima de la cabeza.', 'ascensiontriceps.jpg', 'Muscular', 0),
(8, 'Sentadillas', 'Ejercicio gluteos de cuadriceps con peso muerto. ', 'sentadillas.jpg', 'Muscular', 0),
(9, 'Abdominales', 'Ejercicio de abdominales tumbado en suelo.', 'abdominales.jpg', 'Muscular', 0),
(10, 'Estiramiento pecho', 'Estiramiento pecho con los brazos juntos estirados hacia atrás ', 'estiramientopecho.jpg', 'Estiramiento', 0),
(11, 'Estiramiento abductores', 'Estiramiento de abductores sentado y con las piernas estiradas', 'estiramientoabductores.jpg', 'Estiramiento', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamientos`
--

CREATE TABLE IF NOT EXISTS `entrenamientos` (
`id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  `sesiones` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `entrenamientos`
--

INSERT IGNORE INTO `entrenamientos` (`id`, `nombre`, `borrado`, `sesiones`) VALUES
(1, 'Principiante', 0, 1),
(2, 'Medio', 0, 2),
(3, 'Avanzado', 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamientos_has_tablas`
--

CREATE TABLE IF NOT EXISTS `entrenamientos_has_tablas` (
  `entrenamiento_id` int(11) NOT NULL,
  `tabla_id` int(11) NOT NULL,
  `orden_sesion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `entrenamientos_has_tablas`:
--   `entrenamiento_id`
--       `entrenamientos` -> `id`
--   `tabla_id`
--       `tablas` -> `id`
--

--
-- Volcado de datos para la tabla `entrenamientos_has_tablas`
--

INSERT IGNORE INTO `entrenamientos_has_tablas` (`entrenamiento_id`, `tabla_id`, `orden_sesion`) VALUES
(1, 1, 1),
(2, 1, 1),
(2, 2, 2),
(3, 1, 1),
(3, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamientos_has_usuarios`
--

CREATE TABLE IF NOT EXISTS `entrenamientos_has_usuarios` (
  `entrenamiento_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `entrenamientos_has_usuarios`:
--   `entrenamiento_id`
--       `entrenamientos` -> `id`
--   `usuario_id`
--       `usuarios` -> `id`
--

--
-- Volcado de datos para la tabla `entrenamientos_has_usuarios`
--

INSERT IGNORE INTO `entrenamientos_has_usuarios` (`entrenamiento_id`, `usuario_id`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE IF NOT EXISTS `inscripciones` (
`id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `inscripciones`:
--   `usuario_id`
--       `usuarios` -> `id`
--

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT IGNORE INTO `inscripciones` (`id`, `fecha`, `borrado`, `usuario_id`) VALUES
(1, '2017-11-14', 0, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones_has_actividades`
--

CREATE TABLE IF NOT EXISTS `inscripciones_has_actividades` (
  `inscripciones_id` int(11) NOT NULL,
  `actividades_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `inscripciones_has_actividades`:
--   `actividades_id`
--       `actividades` -> `id`
--   `inscripciones_id`
--       `inscripciones` -> `id`
--

--
-- Volcado de datos para la tabla `inscripciones_has_actividades`
--

INSERT IGNORE INTO `inscripciones_has_actividades` (`inscripciones_id`, `actividades_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasdetabla`
--

CREATE TABLE IF NOT EXISTS `lineasdetabla` (
`id` int(11) NOT NULL,
  `repeticiones` varchar(45) DEFAULT NULL,
  `duracion` varchar(45) DEFAULT NULL,
  `descanso` varchar(45) DEFAULT NULL,
  `series` int(11) DEFAULT NULL,
  `tabla_id` int(11) NOT NULL,
  `ejercicio_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `lineasdetabla`:
--   `ejercicio_id`
--       `ejercicios` -> `id`
--   `tabla_id`
--       `tablas` -> `id`
--

--
-- Volcado de datos para la tabla `lineasdetabla`
--

INSERT IGNORE INTO `lineasdetabla` (`id`, `repeticiones`, `duracion`, `descanso`, `series`, `tabla_id`, `ejercicio_id`) VALUES
(1, '10', NULL, '60 seg', 4, 1, 1),
(2, NULL, '10 min', NULL, NULL, 1, 2),
(3, '10', NULL, '30 seg', 4, 1, 3),
(4, '8', NULL, '30 seg', 3, 1, 4),
(5, '10', NULL, '1 min', 4, 1, 5),
(6, NULL, NULL, NULL, NULL, 1, 11),
(7, '10', NULL, '30 seg', 3, 2, 7),
(8, '10', NULL, '30 seg', 4, 2, 3),
(9, '20', NULL, '30 seg', 4, 2, 9),
(10, '10', NULL, '1 min', 3, 2, 1),
(11, '8', NULL, '1 min', 4, 2, 4),
(12, NULL, NULL, NULL, NULL, 2, 11),
(13, '10', NULL, '1 min', 4, 3, 1),
(14, NULL, NULL, NULL, NULL, 3, 10),
(15, '10', NULL, '30 seg', 3, 3, 3),
(16, NULL, '10 min', NULL, NULL, 3, 6),
(17, '25', NULL, '30 seg', 4, 3, 9),
(18, NULL, NULL, NULL, NULL, 3, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE IF NOT EXISTS `recursos` (
`id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `aforo` varchar(45) DEFAULT NULL,
  `descripcion` longtext,
  `borrado` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT IGNORE INTO `recursos` (`id`, `nombre`, `aforo`, `descripcion`, `borrado`) VALUES
(1, 'Sala A1', '10', 'Sala primer piso ', 0),
(2, 'Sala A2', '10', 'Sala primer piso ', 0),
(3, 'Sala A3', '20', 'Sala primer piso ', 0),
(4, 'Sala B1', '30', 'Sala segundo piso ', 0),
(5, 'Sala B2', '15', 'Sala segundo piso', 0),
(6, 'Sala B3', '25', 'Sala segundo piso', 0),
(7, 'Sala B4', '10', 'Sala segundo piso', 0),
(8, 'Mesa Ping Pong 1', '4', 'Mesa ping pong con raquetas NO incluidas', 0),
(9, 'Mesa Ping Pong 2', '4', 'Mesa ping pong con raquetas NO incluidas', 0),
(10, 'Mesa Ping Pong 3', '4', 'Mesa ping pong con raquetas NO incluidas', 0),
(11, 'Pista Baloncesto', '25', 'Pista baloncesto no incluye gradas', 0),
(12, 'Pista Volleyball', '25', 'Pista volleyball no incluye gradas', 0),
(13, 'Pista Fútbol Sala', '25', 'Pista futbol sala no incluye gradas', 0),
(14, 'Campo Fútbol Hierba', '35', 'Campo de fútbol hierba no incluye gradas', 0),
(15, 'Pista tennis 1', '4', 'Pista de tenis 1vs1 o 2vs2', 0),
(16, 'Pista tennis 2', '4', 'Pista de tenis 1vs1 o 2vs2', 0),
(17, 'Gradas pistas 1', '150', 'Gradas pistas grandes', 0),
(18, 'Gradas pistas 2', '80', 'Gradas pistas pequeñas', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE IF NOT EXISTS `reservas` (
`id` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `frecuencia` varchar(45) NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `actividades_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `reservas`:
--   `actividades_id`
--       `actividades` -> `id`
--   `usuario_id`
--       `usuarios` -> `id`
--

--
-- Volcado de datos para la tabla `reservas`
--

INSERT IGNORE INTO `reservas` (`id`, `fechaInicio`, `fechaFin`, `frecuencia`, `borrado`, `usuario_id`, `actividades_id`) VALUES
(1, '2018-01-01', '2018-02-28', 'Semanal', 0, 2, 1),
(2, '2018-01-01', '2018-01-31', 'Semanal', 0, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas_has_recursos`
--

CREATE TABLE IF NOT EXISTS `reservas_has_recursos` (
  `reservas_id` int(11) NOT NULL,
  `recursos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `reservas_has_recursos`:
--   `recursos_id`
--       `recursos` -> `id`
--   `reservas_id`
--       `reservas` -> `id`
--

--
-- Volcado de datos para la tabla `reservas_has_recursos`
--

INSERT IGNORE INTO `reservas_has_recursos` (`reservas_id`, `recursos_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiondelineadetabla`
--

CREATE TABLE IF NOT EXISTS `sesiondelineadetabla` (
`id` int(11) NOT NULL,
  `completado` tinyint(4) NOT NULL,
  `comentario` mediumtext,
  `sesiones_id` int(11) NOT NULL,
  `lineasDeTabla_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `sesiondelineadetabla`:
--   `lineasDeTabla_id`
--       `lineasdetabla` -> `id`
--   `sesiones_id`
--       `sesiones` -> `id`
--

--
-- Volcado de datos para la tabla `sesiondelineadetabla`
--

INSERT IGNORE INTO `sesiondelineadetabla` (`id`, `completado`, `comentario`, `sesiones_id`, `lineasDeTabla_id`) VALUES
(1, 1, NULL, 1, 1),
(2, 0, NULL, 1, 2),
(3, 1, NULL, 1, 3),
(4, 1, NULL, 1, 4),
(5, 0, NULL, 1, 5),
(6, 1, NULL, 1, 6),
(7, 1, NULL, 2, 1),
(8, 1, NULL, 2, 2),
(9, 1, NULL, 2, 3),
(10, 1, NULL, 2, 4),
(11, 1, NULL, 2, 5),
(12, 0, NULL, 2, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

CREATE TABLE IF NOT EXISTS `sesiones` (
`id` int(11) NOT NULL,
  `completado` tinyint(4) DEFAULT NULL,
  `fecha` date NOT NULL,
  `tablas_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- RELACIONES PARA LA TABLA `sesiones`:
--   `tablas_id`
--       `tablas` -> `id`
--

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT IGNORE INTO `sesiones` (`id`, `completado`, `fecha`, `tablas_id`) VALUES
(1, 1, '2017-11-15', 1),
(2, 1, '2017-11-22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablas`
--

CREATE TABLE IF NOT EXISTS `tablas` (
`id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `borrado` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tablas`
--

INSERT IGNORE INTO `tablas` (`id`, `nombre`, `borrado`) VALUES
(1, 'Tabla 1', 0),
(2, 'Tabla 2', 0),
(3, 'Tabla 3', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`id` int(11) NOT NULL,
  `login` varchar(45) NOT NULL,
  `contrasenha` varchar(300) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `imagen` varchar(90) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT IGNORE INTO `usuarios` (`id`, `login`, `contrasenha`, `nombre`, `apellidos`, `dni`, `email`, `borrado`, `tipo`, `imagen`) VALUES
(1, 'admin', '$2y$15$tKzm9o7fcPtDC9jD91nBHev7FVl15cgUJFReu/e/xuUrQNZfssnYa', 'admin', 'admin', '00000001A', 'admin@admin', 0, 'Administrador', NULL),
(2, 'secretario', '$2y$15$nKNj3f1/BkxclMiJYp/1PeQ7sVkrO4J5A3vWSrPqXQ3/dAWaCbJD6', 'secretario', 'secretario', '00000002A', 'secretario@secretario', 0, 'Secretario', NULL),
(3, 'entrenador', '$2y$15$8n35X28JIU46CXjTACBZTO6Y1radwkcEZFRyrBzSY5AqvIhzJ5wMm', 'entrenador', 'entrenador', '00000003A', 'entrenador@entrenador', 0, 'Entrenador', NULL),
(4, 'deportista', '$2y$15$LKEFHg8CLu7wKfmGg605R.nJDwVkrFWMtW41KFIvfYXUX2hYUZQbW', 'deportista', 'deportista', '00000004A', 'deportista@deportista', 0, 'Deportista', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`nombre`), ADD UNIQUE KEY `nombre_2` (`nombre`);

--
-- Indices de la tabla `entrenamientos`
--
ALTER TABLE `entrenamientos`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `entrenamientos_has_tablas`
--
ALTER TABLE `entrenamientos_has_tablas`
 ADD PRIMARY KEY (`entrenamiento_id`,`tabla_id`), ADD KEY `fk_entrenamiento_has_tabla_tabla1_idx` (`tabla_id`), ADD KEY `fk_entrenamiento_has_tabla_entrenamiento1_idx` (`entrenamiento_id`);

--
-- Indices de la tabla `entrenamientos_has_usuarios`
--
ALTER TABLE `entrenamientos_has_usuarios`
 ADD PRIMARY KEY (`entrenamiento_id`,`usuario_id`), ADD KEY `fk_entrenamiento_has_usuario_usuario1_idx` (`usuario_id`), ADD KEY `fk_entrenamiento_has_usuario_entrenamiento1_idx` (`entrenamiento_id`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_inscripcion_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `inscripciones_has_actividades`
--
ALTER TABLE `inscripciones_has_actividades`
 ADD PRIMARY KEY (`inscripciones_id`,`actividades_id`), ADD KEY `fk_inscripciones_has_actividades_actividades1_idx` (`actividades_id`), ADD KEY `fk_inscripciones_has_actividades_inscripciones1_idx` (`inscripciones_id`);

--
-- Indices de la tabla `lineasdetabla`
--
ALTER TABLE `lineasdetabla`
 ADD PRIMARY KEY (`id`,`tabla_id`,`ejercicio_id`), ADD KEY `fk_lineasDeTabla_tablas1_idx` (`tabla_id`), ADD KEY `fk_lineasDeTabla_ejercicios1_idx` (`ejercicio_id`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_reserva_usuario1_idx` (`usuario_id`), ADD KEY `fk_reservas_actividades1_idx` (`actividades_id`);

--
-- Indices de la tabla `reservas_has_recursos`
--
ALTER TABLE `reservas_has_recursos`
 ADD PRIMARY KEY (`reservas_id`,`recursos_id`), ADD KEY `fk_reservas_has_recursos_recursos1_idx` (`recursos_id`), ADD KEY `fk_reservas_has_recursos_reservas1_idx` (`reservas_id`);

--
-- Indices de la tabla `sesiondelineadetabla`
--
ALTER TABLE `sesiondelineadetabla`
 ADD PRIMARY KEY (`id`,`sesiones_id`), ADD KEY `fk_sesion_lineaDeTabla_sesiones1_idx` (`sesiones_id`), ADD KEY `fk_sesion_lineaDeTabla_lineasDeTabla1_idx` (`lineasDeTabla_id`);

--
-- Indices de la tabla `sesiones`
--
ALTER TABLE `sesiones`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_sesiones_tablas1_idx` (`tablas_id`);

--
-- Indices de la tabla `tablas`
--
ALTER TABLE `tablas`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_UNIQUE` (`id`), ADD UNIQUE KEY `login_UNIQUE` (`login`), ADD UNIQUE KEY `dni_UNIQUE` (`dni`), ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `entrenamientos`
--
ALTER TABLE `entrenamientos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `lineasdetabla`
--
ALTER TABLE `lineasdetabla`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sesiondelineadetabla`
--
ALTER TABLE `sesiondelineadetabla`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `sesiones`
--
ALTER TABLE `sesiones`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tablas`
--
ALTER TABLE `tablas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
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
ADD CONSTRAINT `fk_reservas_actividades1` FOREIGN KEY (`actividades_id`) REFERENCES `actividades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_reserva_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `reservas_has_recursos`
--
ALTER TABLE `reservas_has_recursos`
ADD CONSTRAINT `fk_reservas_has_recursos_recursos1` FOREIGN KEY (`recursos_id`) REFERENCES `recursos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_reservas_has_recursos_reservas1` FOREIGN KEY (`reservas_id`) REFERENCES `reservas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
