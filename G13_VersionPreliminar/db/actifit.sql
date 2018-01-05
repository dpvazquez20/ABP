-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 05-01-2018 a las 06:17:25
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

DROP TABLE IF EXISTS `actividades`;
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT IGNORE INTO `actividades` (`id`, `nombre`, `descripcion`, `frecuencia`, `horaInicio`, `horaFin`, `tipo`, `numMaxParticipantes`, `borrado`, `coach_id`, `fechaInicio`, `fechaFin`) VALUES
(40, 'Zumba', 'Se trata de una fusiÃ³n de ritmos aerÃ³bicos o coreografÃ­as sencillas con distintos gÃ©neros, inspirados en la mÃºsica latina y con una mezcla de mÃºsica internacional.', 'Martes', '17:00:00', '19:00:00', 'Grupal', 5, 0, 3, '2018-01-08', '2018-01-25'),
(41, 'SoftBoxing', 'Clase de cardio utilizando movimientos propios del boxeo y otras artesmarciales que obligan a ejercitar todos los grupos musculares. ', 'Jueves', '20:00:00', '21:00:00', 'Grupal', 8, 0, 3, '2018-01-16', '2018-01-26'),
(42, 'Spinning', 'El spinning es una variante de los deportes de fitness (o de gimnasio) que consiste en pedalear sobre una bicicleta estÃ¡tica al ritmo de la mÃºsica y siguiendo los ejercicios que nos marca el monitor. TambiÃ©n se le llama indoor cycling.', 'MiÃ©rcoles', '19:30:00', '21:00:00', 'Grupal', 8, 0, 3, '2018-01-09', '2018-01-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

DROP TABLE IF EXISTS `ejercicios`;
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

DROP TABLE IF EXISTS `entrenamientos`;
CREATE TABLE IF NOT EXISTS `entrenamientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  `sesiones` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
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

DROP TABLE IF EXISTS `entrenamientos_has_tablas`;
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

INSERT IGNORE INTO `entrenamientos_has_tablas` (`entrenamiento_id`, `tabla_id`, `orden_sesion`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(2, 2, 2),
(3, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamientos_has_usuarios`
--

DROP TABLE IF EXISTS `entrenamientos_has_usuarios`;
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

INSERT IGNORE INTO `entrenamientos_has_usuarios` (`entrenamiento_id`, `usuario_id`) VALUES
(3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

DROP TABLE IF EXISTS `inscripciones`;
CREATE TABLE IF NOT EXISTS `inscripciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inscripcion_usuario1_idx` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT IGNORE INTO `inscripciones` (`id`, `fecha`, `borrado`, `usuario_id`) VALUES
(11, '2018-01-02', 0, 4),
(12, '2018-01-02', 0, 5),
(13, '2018-01-02', 0, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones_has_actividades`
--

DROP TABLE IF EXISTS `inscripciones_has_actividades`;
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

INSERT IGNORE INTO `inscripciones_has_actividades` (`inscripciones_id`, `actividades_id`) VALUES
(13, 40),
(12, 41),
(11, 42);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasdetabla`
--

DROP TABLE IF EXISTS `lineasdetabla`;
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

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

DROP TABLE IF EXISTS `recursos`;
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

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  `actividades_id` int(11) NOT NULL,
  `recurso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_reservas_actividades1_idx` (`actividades_id`),
  KEY `fk_recursos_id` (`recurso_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18989 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT IGNORE INTO `reservas` (`id`, `fecha`, `borrado`, `actividades_id`, `recurso_id`) VALUES
(18981, '2018-01-09', 0, 40, 1),
(18982, '2018-01-16', 0, 40, 1),
(18983, '2018-01-23', 0, 40, 1),
(18984, '2018-01-18', 0, 41, 3),
(18985, '2018-01-25', 0, 41, 3),
(18986, '2018-01-10', 0, 42, 4),
(18987, '2018-01-17', 0, 42, 4),
(18988, '2018-01-24', 0, 42, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiondelineadetabla`
--

DROP TABLE IF EXISTS `sesiondelineadetabla`;
CREATE TABLE IF NOT EXISTS `sesiondelineadetabla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `completado` tinyint(4) NOT NULL,
  `sesiones_id` int(11) NOT NULL,
  `lineasDeTabla_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`sesiones_id`),
  KEY `fk_sesion_lineaDeTabla_sesiones1_idx` (`sesiones_id`),
  KEY `fk_sesion_lineaDeTabla_lineasDeTabla1_idx` (`lineasDeTabla_id`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sesiondelineadetabla`
--

INSERT IGNORE INTO `sesiondelineadetabla` (`id`, `completado`, `sesiones_id`, `lineasDeTabla_id`) VALUES
(37, 1, 245, 1),
(38, 0, 245, 2),
(39, 0, 245, 3),
(40, 0, 245, 4),
(41, 0, 245, 5),
(42, 0, 245, 6),
(43, 1, 246, 7),
(44, 1, 246, 8),
(45, 1, 246, 9),
(46, 1, 246, 10),
(47, 0, 246, 11),
(48, 0, 246, 12),
(49, 0, 247, 13),
(50, 0, 247, 14),
(51, 0, 247, 15),
(52, 0, 247, 16),
(53, 1, 247, 17),
(54, 1, 247, 18),
(55, 0, 248, 1),
(56, 0, 248, 2),
(57, 0, 248, 3),
(58, 0, 248, 4),
(59, 0, 248, 5),
(60, 0, 248, 6),
(61, 0, 249, 7),
(62, 0, 249, 8),
(63, 0, 249, 9),
(64, 0, 249, 10),
(65, 0, 249, 11),
(66, 0, 249, 12),
(67, 0, 250, 13),
(68, 0, 250, 14),
(69, 0, 250, 15),
(70, 0, 250, 16),
(71, 0, 250, 17),
(72, 0, 250, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesiones`
--

DROP TABLE IF EXISTS `sesiones`;
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
) ENGINE=InnoDB AUTO_INCREMENT=251 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sesiones`
--

INSERT IGNORE INTO `sesiones` (`id`, `completado`, `fecha`, `inicio`, `fin`, `comentario`, `tablas_id`, `orden_sesion`, `orden_sesion_max`, `usuarios_id`, `entrenamientos_id`, `anterior_id`) VALUES
(245, 1, '2018-01-05 03:57:25', '2018-01-05 04:44:27', '2018-01-05 04:50:49', 'Comentario', 1, 1, 3, 4, 3, NULL),
(246, 1, '2018-01-05 03:57:25', '2018-01-05 04:51:10', '2018-01-05 04:51:26', NULL, 2, 2, 3, 4, 3, 245),
(247, 1, '2018-01-05 03:57:25', '2018-01-05 04:51:48', '2018-01-05 04:51:55', 'Comentario 247', 3, 3, 3, 4, 3, 246),
(248, 0, '2018-01-05 04:51:55', '2018-01-05 05:07:48', NULL, 'fsdÃ±lfmsdmfdsmfsdmfldsmfsmdfmdslÃ±fsmdfÃ±dsfsmdfÃ±ldsfdslfdsmfÃ±sdfdmffsdÃ±lfmsdmfdsmfsdmfldsmfsmdfmdslÃ±fsmdfÃ±dsfsmdfÃ±ldsfdslfdsmfÃ±sdfdmffsdÃ±lfmsdmfdsmfsdmfldsmfsmdfmdslÃ±fsmdfÃ±dsfsmdfÃ±ldsfdslfdsmfÃ±sdfdmffsdÃ±lfmsdmfdsmfsdmfldsmfsmdfmdslÃ±fsmdfÃ±dsfsmdfÃ±ldsfdslfdsmfÃ±sdfdmffsdÃ±lfmsdmfdsmfsdmfldsmfsmdfmdslÃ±fsmdfÃ±dsfsmdfÃ±ldsfdslfdsmfÃ±sdfdmffsdÃ±lfmsdmfdsmfsdmfldsmfsmdfmdslÃ±fsmdfÃ±dsfsmdfÃ±ldsfdslfdsmfÃ±sdfdmffsdÃ±lfmsdmfdsmfsdmfldsmfsmdfmdslÃ±fsmdfÃ±dsfsmdfÃ±ldsfdslfdsmfÃ±sdfdmfaaafsdÃ±lfmsdmfdsmfsdmfldsmfsmdfmdslÃ±fsmdfÃ±dsfsmdfÃ±ldsfdslfdsmfÃ±sdfdmffsdÃ±lfmsdmfdsmfsdmfldsmfsmdfmdslÃ±fsmdfÃ±dsfsmdfÃ±ldsfdslfdsmfÃ±sdfdmffsdÃ±lfmsdmfdsmfsdmfldsmfsmdfmdslÃ±fsmdfÃ±dsfsmdfÃ±ldsfdslfdsmfÃ±sdfdmffsdÃ±lfmsdmfdsmfsdmfldsmfsmdfmdslÃ±fsmdfÃ±dsfsmdfÃ±ldsfdslfdsmfÃ±sdfdmffsdÃ±lfmsdmfdsmfsdmfldsmfsmdfmdslÃ±fsmdfÃ±dsfsmdfÃ±ldsfdslfdsmfÃ±sdfdmffsdÃ±lfmsdmfdsmfsdmfldsmfsmdfmdslÃ±fsmdfÃ±dsfsmdfÃ±ldsfdslfdsmfÃ±sdfdmffsdÃ±lfmsdmfdsmfsdmfldsmfsmdfmdslÃ±fsmdfÃ±dsfsmdfÃ±ldsfdslfdsmfÃ±sdfdmfaaa', 1, 1, 3, 4, 3, 247),
(249, 0, '2018-01-05 04:51:55', NULL, NULL, 'Comentario 249', 2, 2, 3, 4, 3, 248),
(250, 1, '2018-01-05 04:51:55', '2018-01-05 06:10:10', '2018-01-05 06:10:45', 'Comentario adelantado', 3, 3, 3, 4, 3, 249);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablas`
--

DROP TABLE IF EXISTS `tablas`;
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

INSERT IGNORE INTO `tablas` (`id`, `nombre`, `tipo`, `borrado`) VALUES
(1, 'Tabla 1', 'Normal', 0),
(2, 'Tabla 2', 'Normal', 0),
(3, 'Tabla 3', 'Normal', 0),
(6, 'Tabalala', 'Personal', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `contrasenha` varchar(300) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `dni` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `borrado` tinyint(4) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `clase` varchar(10) NOT NULL,
  `imagen` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT IGNORE INTO `usuarios` (`id`, `login`, `contrasenha`, `nombre`, `apellidos`, `dni`, `email`, `borrado`, `tipo`, `clase`, `imagen`) VALUES
(1, 'admin', '$2y$15$tKzm9o7fcPtDC9jD91nBHev7FVl15cgUJFReu/e/xuUrQNZfssnYa', 'admin', 'admin', '00000001A', 'admin@admin', 0, 'Administrador', 'Otro', 'default.png'),
(2, 'secretario', '$2y$15$nKNj3f1/BkxclMiJYp/1PeQ7sVkrO4J5A3vWSrPqXQ3/dAWaCbJD6', 'secretario', 'secretario', '00000002A', 'secretario@secretario', 0, 'Secretario', 'Otro', 'default.png'),
(3, 'entrenador', '$2y$15$8n35X28JIU46CXjTACBZTO6Y1radwkcEZFRyrBzSY5AqvIhzJ5wMm', 'entrenador', 'entrenador', '00000003A', 'entrenador@entrenador', 0, 'Entrenador', 'Otro', 'default.png'),
(4, 'deportista', '$2y$15$LKEFHg8CLu7wKfmGg605R.nJDwVkrFWMtW41KFIvfYXUX2hYUZQbW', 'deportista', 'deportista', '00000004A', 'deportista@deportista', 0, 'Deportista', 'TDU', 'default.png'),
(5, 'deportista2', '$2y$15$GAnBBHxkDagIEmM4MBClY.sLyzXF358348Jy6Uub6H8z5rq5gfn4m', 'deportistaDos', 'deportistaDos', '72946407K', 'deportista2@gmail.com', 0, 'Deportista', 'PEF', 'default.png'),
(6, 'deportista69', '$2y$15$e2mBOIXJ6qsZ4BA4oOv3HemOIBkRJT9NcxrPHtwW0s/FN0O4H4gpu', 'DEPORT', 'DEPORT', '77461655R', 'deportista69@gmail.com', 0, 'Deportista', 'PEF', 'default.png'),
(8, 'deportista70', '$2y$15$B/3titw5ubQlMFbuKfo7euxODi4p1f2wx1dmInmdMQXlvCVCwCaFm', 'deportISTA', 'deportISTA', '44786624N', 'deportista70@gmail.com', 0, 'Deportista', 'TDU', 'default.png'),
(13, 'entrenador2', '$2y$15$hHAmUbxvBsIar9JcovLgs.Jv2Kbx5iZe3mylyPkKU2wmyBiY7sOEu', 'entrenadorDOS', 'entrenadorDOS', '02842247E', 'entrenador2@gmail.com', 0, 'Entrenador', 'Otro', 'default.png'),
(19, 'deportista71', '$2y$15$jviAnI.eO7zPr5pUlM9IT.u1EF6S/Qh5WQhWEyJia1NeQz45250aS', 'deportistaSIETEuno', 'deportistaSIETEuno', '73142344K', 'deportista71@gmail.com', 0, 'Deportista', 'PEF', 'default.png');

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
