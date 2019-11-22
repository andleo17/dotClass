-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2019 a las 22:31:41
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dotclass`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_curso`
--

CREATE TABLE `actividad_curso` (
  `usuario_id` int(11) NOT NULL,
  `clase_id` int(11) NOT NULL,
  `visita_id` int(11) DEFAULT NULL,
  `marcador_id` int(11) DEFAULT NULL,
  `aporte_id` int(11) DEFAULT NULL,
  `comentario_id` int(11) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_examen`
--

CREATE TABLE `actividad_examen` (
  `usuario_id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `nota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alternativa`
--

CREATE TABLE `alternativa` (
  `id` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `contenido` varchar(180) COLLATE utf8_spanish_ci NOT NULL,
  `respuesta` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aporte`
--

CREATE TABLE `aporte` (
  `id` int(11) NOT NULL,
  `titulo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `contenido` longtext COLLATE utf8_spanish_ci NOT NULL,
  `numero_likes` int(11) NOT NULL DEFAULT 0,
  `numero_comentarios` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `titulo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `contenido` longtext COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bonificacion`
--

CREATE TABLE `bonificacion` (
  `usuario_emisor_id` int(11) NOT NULL,
  `usuario_receptor_id` int(11) NOT NULL,
  `tipo_suscripcion_id` int(11) NOT NULL,
  `cantidad` decimal(10,0) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `logo` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`, `logo`) VALUES
(1, 'Tecnología', '', 'tecnologia.webp'),
(2, 'Ciencia', '', 'ciencia.webp'),
(3, 'Matemáticas', '', 'matematicas.webp'),
(4, 'Arte', '', 'arte.webp'),
(5, 'Marketing', '', 'marketing.webp'),
(6, 'Música', '', 'musica.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`id`, `nombre`) VALUES
(1, 'Chiclayo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `id` int(11) NOT NULL,
  `seccion_id` int(11) NOT NULL,
  `titulo` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `duracion` int(11) NOT NULL DEFAULT 0,
  `contenido_video` varchar(180) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contenido_texto` longtext COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_subida` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`id`, `seccion_id`, `titulo`, `duracion`, `contenido_video`, `contenido_texto`, `fecha_subida`) VALUES
(1, 1, 'Bienvenida al curso', 11, NULL, NULL, '2019-11-19 11:11:30'),
(2, 1, 'Primeros pasos', 11, NULL, NULL, '2019-11-19 11:11:30'),
(3, 2, 'Clases abstractas', 25, NULL, NULL, '2019-11-19 11:16:28'),
(4, 2, 'Implementando clases abstractas al proyecto', 32, NULL, NULL, '2019-11-19 11:16:28'),
(5, 2, 'Ejercicio práctico', 14, NULL, NULL, '2019-11-19 11:16:28'),
(6, 2, 'Implementando métodos abstractos en Java', 32, NULL, NULL, '2019-11-19 11:16:28'),
(7, 3, 'Qué es JavaDocs', 4, NULL, NULL, '2019-11-19 11:30:17'),
(8, 3, 'Implementando JavaDocs al proyecto', 18, NULL, NULL, '2019-11-19 11:30:17'),
(9, 3, 'Javadocs tags para herencia e interfaces', 16, NULL, NULL, '2019-11-19 11:30:17'),
(10, 3, 'Generando JavaDocs', 34, NULL, NULL, '2019-11-19 11:30:17'),
(11, 4, 'Clases anidadas y tipos', 50, NULL, NULL, '2019-11-19 11:34:35'),
(12, 4, 'Implementando una clase anidada al proyecto', 69, NULL, NULL, '2019-11-19 11:34:35'),
(13, 4, 'Instanciando clases estáticas anidadas', 24, NULL, NULL, '2019-11-19 11:34:35'),
(14, 4, 'Enumeraciones', 8, NULL, NULL, '2019-11-19 11:34:35'),
(15, 5, 'Métodos con implementación métodos default y private', 14, NULL, NULL, '2019-11-19 11:36:15'),
(16, 5, 'Creando Interfaz DAO con métodos default y private', 37, NULL, NULL, '2019-11-19 11:36:15'),
(17, 5, 'Diferencias entre Interfaces y Clases abstractas', 9, NULL, NULL, '2019-11-19 11:36:15'),
(18, 5, 'Herencia en interfaces', 6, NULL, NULL, '2019-11-19 11:36:15'),
(19, 6, 'Definición y composición del API', 12, NULL, NULL, '2019-11-19 11:38:39'),
(20, 6, 'Ejercicio: JDBC API', 3, NULL, NULL, '2019-11-19 11:38:39'),
(21, 6, 'Creando la base de datos y conectando el proyecto con MySQL', 24, NULL, NULL, '2019-11-19 11:38:39'),
(22, 6, 'Generando conexión a la base de datos y creando clase de con', 16, NULL, NULL, '2019-11-19 11:38:39'),
(23, 6, 'Sentencia SELECT en Java', 7, NULL, NULL, '2019-11-19 11:38:39'),
(24, 6, 'Sentencia SELECT con parámetros', 4, NULL, NULL, '2019-11-19 11:38:39'),
(25, 6, 'Sentencia INSERT en Java', 6, NULL, NULL, '2019-11-19 11:38:39'),
(26, 6, 'Reto: Reporte por fecha', 1, NULL, NULL, '2019-11-19 11:38:39'),
(27, 7, 'Interfaces funcionales', 4, NULL, NULL, '2019-11-19 11:42:44'),
(28, 7, 'Programación funcional', 14, NULL, NULL, '2019-11-19 11:42:44'),
(29, 7, 'Lambdas', 19, NULL, NULL, '2019-11-19 11:42:44'),
(30, 7, 'Ejercicio: Lambdas', 1, NULL, NULL, '2019-11-19 11:42:44'),
(31, 7, 'Lambdas como variables y recursividad', 18, NULL, NULL, '2019-11-19 11:42:44'),
(32, 7, 'Stream y Filter', 20, NULL, NULL, '2019-11-19 11:42:44'),
(33, 7, 'Predicate y consumer', 16, NULL, NULL, '2019-11-19 11:42:44'),
(34, 7, 'Conclusión del curso del curso', 4, NULL, NULL, '2019-11-19 11:42:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `id` int(11) NOT NULL,
  `comentario_padre_id` int(11) DEFAULT NULL,
  `contenido` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `numero_likes` int(11) NOT NULL DEFAULT 0,
  `numero_comentarios` int(11) NOT NULL DEFAULT 0,
  `pregunta` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conocimiento`
--

CREATE TABLE `conocimiento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `grado_academico` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lugar_estudio` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `anio` int(11) NOT NULL,
  `pais_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `titulo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` mediumtext COLLATE utf8_spanish_ci NOT NULL,
  `logo` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `duracion` int(11) NOT NULL DEFAULT 0,
  `numero_subscriptores` int(11) NOT NULL DEFAULT 0,
  `valoracion` int(11) NOT NULL DEFAULT 0,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_ultima_actualizacion` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `curso`
--

INSERT INTO `curso` (`id`, `categoria_id`, `titulo`, `descripcion`, `logo`, `duracion`, `numero_subscriptores`, `valoracion`, `fecha_creacion`, `fecha_ultima_actualizacion`, `usuario_id`) VALUES
(1, 1, 'Java Avanzado', 'En este curso aprenderás el lenguaje de programación más demandado por el sector empresarial y el mejor remunerado en la actualidad.\r\nAprenderemos todos juntos acerca de clases anidadas, clases abstractas, lambdas, JDBC y mucho más.', 'Badge-desarrollo-java.webp', 25, 1200, 4, '2019-10-17 00:00:00', '2019-11-14 16:30:40', 1),
(2, 1, 'HTML5 y CSS3', 'Diseña tus propias páginas o sitios web y aprende los mejores frameworks de diseño. Sé un buen arquitecto fronted con este curso.', 'badges-html-css.webp', 21, 1000, 5, '2019-10-17 00:00:00', '2019-11-14 16:30:40', 1),
(3, 1, 'React', 'React es una de las librerías más utilizadas hoy para crear aplicaciones web. Aprende desde la creación y diseño de componentes hasta traer datos de un API.', 'badge-reactjs-avanzado.webp', 25, 1200, 3, '2019-10-17 00:00:00', '2019-11-14 16:30:40', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiencia_laboral`
--

CREATE TABLE `experiencia_laboral` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `lugar` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `pais_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcador`
--

CREATE TABLE `marcador` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `tiempo` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `nombre`) VALUES
(1, 'Perú');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id` int(11) NOT NULL,
  `examen_id` int(11) NOT NULL,
  `numero` tinyint(4) NOT NULL,
  `titulo` varchar(150) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prerrequisito`
--

CREATE TABLE `prerrequisito` (
  `curso_id` int(11) NOT NULL,
  `curso_prerrequisito_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `prerrequisito`
--

INSERT INTO `prerrequisito` (`curso_id`, `curso_prerrequisito_id`) VALUES
(3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE `seccion` (
  `id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  `titulo` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`id`, `curso_id`, `titulo`) VALUES
(1, 1, 'Introducción al curso'),
(2, 1, 'Clases avanzadas'),
(3, 1, 'JavaDocs'),
(4, 1, 'Clases anidadas'),
(5, 1, 'Interfaces avanzadas'),
(6, 1, 'JDBC'),
(7, 1, 'Lambdas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `usuario_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_suscripcion`
--

CREATE TABLE `tipo_suscripcion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nickname` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(42) COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `descripcion` tinytext COLLATE utf8_spanish_ci DEFAULT NULL,
  `numero_seguidores` int(11) NOT NULL DEFAULT 0,
  `pregunta_seguridad` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `respuesta_seguridad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pais_id` int(11) NOT NULL,
  `ciudad_id` int(11) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nickname`, `password`, `nombres`, `apellidos`, `email`, `fecha_nacimiento`, `descripcion`, `numero_seguidores`, `pregunta_seguridad`, `respuesta_seguridad`, `foto`, `pais_id`, `ciudad_id`, `fecha_creacion`, `estado`) VALUES
(1, 'Andle17', '123456789', 'Andres', 'Baldarrago', 'ab@gmail.com', '2000-07-01', 'Me gusta jugar y enseñar.', 0, '¿Quién soy?', 'nose', 'Andle17.png', 1, 1, '2019-11-14 16:42:51', 1),
(2, 'CinthyaYomona', '123', 'Cinthya Lisseth', 'Yomona Parraguez', 'cinthya@gmail.com', '1999-05-23', 'Se supone que me debo de bañar, que mis convers ya no aguantan más!!...Pero llegas tú !! :) <3', 0, 'Inspiración?', 'Priscila', '20180319_103506.jpg', 1, 1, '2019-11-14 16:42:51', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

CREATE TABLE `visita` (
  `id` int(11) NOT NULL,
  `tiempo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividad_curso`
--
ALTER TABLE `actividad_curso`
  ADD PRIMARY KEY (`usuario_id`,`clase_id`),
  ADD KEY `fk_usuario_has_clase_clase1_idx` (`clase_id`),
  ADD KEY `fk_usuario_has_clase_usuario1_idx` (`usuario_id`),
  ADD KEY `fk_usuario_has_clase_visita1_idx` (`visita_id`),
  ADD KEY `fk_usuario_has_clase_marcador1_idx` (`marcador_id`),
  ADD KEY `fk_usuario_has_clase_aporte1_idx` (`aporte_id`),
  ADD KEY `fk_usuario_has_clase_comentario1_idx` (`comentario_id`);

--
-- Indices de la tabla `actividad_examen`
--
ALTER TABLE `actividad_examen`
  ADD PRIMARY KEY (`usuario_id`,`pregunta_id`),
  ADD KEY `fk_usuario_has_pregunta_pregunta1_idx` (`pregunta_id`),
  ADD KEY `fk_usuario_has_pregunta_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `alternativa`
--
ALTER TABLE `alternativa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_alternativa_pregunta1_idx` (`pregunta_id`);

--
-- Indices de la tabla `aporte`
--
ALTER TABLE `aporte`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_blog_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `bonificacion`
--
ALTER TABLE `bonificacion`
  ADD PRIMARY KEY (`usuario_emisor_id`,`usuario_receptor_id`),
  ADD KEY `fk_usuario_has_usuario_usuario2_idx` (`usuario_receptor_id`),
  ADD KEY `fk_usuario_has_usuario_usuario1_idx` (`usuario_emisor_id`),
  ADD KEY `fk_bonificacion_tipo_suscripcion1_idx` (`tipo_suscripcion_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clase_seccion1_idx` (`seccion_id`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comentario_comentario1_idx` (`comentario_padre_id`);

--
-- Indices de la tabla `conocimiento`
--
ALTER TABLE `conocimiento`
  ADD PRIMARY KEY (`id`,`usuario_id`),
  ADD KEY `fk_conocimiento_pais1_idx` (`pais_id`),
  ADD KEY `fk_conocimiento_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_curso_categoria1_idx` (`categoria_id`);

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id`,`curso_id`),
  ADD KEY `fk_examen_curso1_idx` (`curso_id`);

--
-- Indices de la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  ADD PRIMARY KEY (`id`,`usuario_id`),
  ADD KEY `fk_experiencia_laboral_pais1_idx` (`pais_id`),
  ADD KEY `fk_experiencia_laboral_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `marcador`
--
ALTER TABLE `marcador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pregunta_examen1_idx` (`examen_id`);

--
-- Indices de la tabla `prerrequisito`
--
ALTER TABLE `prerrequisito`
  ADD PRIMARY KEY (`curso_id`,`curso_prerrequisito_id`),
  ADD KEY `fk_curso_has_curso_curso2_idx` (`curso_prerrequisito_id`),
  ADD KEY `fk_curso_has_curso_curso1_idx` (`curso_id`);

--
-- Indices de la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_seccion_curso1_idx` (`curso_id`);

--
-- Indices de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD PRIMARY KEY (`usuario_id`,`curso_id`),
  ADD KEY `fk_usuario_has_curso1_curso1_idx` (`curso_id`),
  ADD KEY `fk_usuario_has_curso1_usuario1_idx` (`usuario_id`);

--
-- Indices de la tabla `tipo_suscripcion`
--
ALTER TABLE `tipo_suscripcion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`nombre`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nickname_UNIQUE` (`nickname`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_usuario_pais1_idx` (`pais_id`),
  ADD KEY `fk_usuario_ciudad1_idx` (`ciudad_id`);

--
-- Indices de la tabla `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alternativa`
--
ALTER TABLE `alternativa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `aporte`
--
ALTER TABLE `aporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `conocimiento`
--
ALTER TABLE `conocimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marcador`
--
ALTER TABLE `marcador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seccion`
--
ALTER TABLE `seccion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_suscripcion`
--
ALTER TABLE `tipo_suscripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `visita`
--
ALTER TABLE `visita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividad_curso`
--
ALTER TABLE `actividad_curso`
  ADD CONSTRAINT `fk_usuario_has_clase_aporte1` FOREIGN KEY (`aporte_id`) REFERENCES `aporte` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_clase_clase1` FOREIGN KEY (`clase_id`) REFERENCES `clase` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_clase_comentario1` FOREIGN KEY (`comentario_id`) REFERENCES `comentario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_clase_marcador1` FOREIGN KEY (`marcador_id`) REFERENCES `marcador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_clase_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_clase_visita1` FOREIGN KEY (`visita_id`) REFERENCES `visita` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `actividad_examen`
--
ALTER TABLE `actividad_examen`
  ADD CONSTRAINT `fk_usuario_has_pregunta_pregunta1` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_pregunta_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alternativa`
--
ALTER TABLE `alternativa`
  ADD CONSTRAINT `fk_alternativa_pregunta1` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `fk_blog_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `bonificacion`
--
ALTER TABLE `bonificacion`
  ADD CONSTRAINT `fk_bonificacion_tipo_suscripcion1` FOREIGN KEY (`tipo_suscripcion_id`) REFERENCES `tipo_suscripcion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_usuario_usuario1` FOREIGN KEY (`usuario_emisor_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_usuario_usuario2` FOREIGN KEY (`usuario_receptor_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `fk_clase_seccion1` FOREIGN KEY (`seccion_id`) REFERENCES `seccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_comentario_comentario1` FOREIGN KEY (`comentario_padre_id`) REFERENCES `comentario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `conocimiento`
--
ALTER TABLE `conocimiento`
  ADD CONSTRAINT `fk_conocimiento_pais1` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_conocimiento_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_curso_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `fk_examen_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `experiencia_laboral`
--
ALTER TABLE `experiencia_laboral`
  ADD CONSTRAINT `fk_experiencia_laboral_pais1` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_experiencia_laboral_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD CONSTRAINT `fk_pregunta_examen1` FOREIGN KEY (`examen_id`) REFERENCES `examen` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `prerrequisito`
--
ALTER TABLE `prerrequisito`
  ADD CONSTRAINT `fk_curso_has_curso_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_curso_has_curso_curso2` FOREIGN KEY (`curso_prerrequisito_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD CONSTRAINT `fk_seccion_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD CONSTRAINT `fk_usuario_has_curso1_curso1` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_has_curso1_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_ciudad1` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_pais1` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
