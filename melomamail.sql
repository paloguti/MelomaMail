-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2017 a las 12:13:58
-- Versión del servidor: 5.5.40
-- Versión de PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `melomamail`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `componentes`
--

CREATE TABLE IF NOT EXISTS `componentes` (
  `idGrupo` int(11) NOT NULL,
  `usuario` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
`id` int(11) NOT NULL,
  `nombreGrupo` varchar(20) NOT NULL,
  `edadMinima` int(11) NOT NULL,
  `edadMaxima` int(11) NOT NULL,
  `tipoMusica` enum('pop','rock','indie','rap','jazz') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombreGrupo`, `edadMinima`, `edadMaxima`, `tipoMusica`) VALUES
(3, 'Grupo Pop 1', 15, 25, 'pop'),
(4, 'Grupo Rock 1', 20, 25, 'rock'),
(5, 'Grupo Indie 1', 15, 25, 'indie');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
`id` int(11) NOT NULL,
  `emisor` varchar(10) NOT NULL,
  `receptor` varchar(10) NOT NULL,
  `asunto` varchar(50) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `leido` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `emisor`, `receptor`, `asunto`, `mensaje`, `fecha`, `leido`) VALUES
(1, 'paloma', 'Todos', 'hola', 'hola hola hola hola hola hola hola hola hola hola jdfajdlkjgeijfalkdjvijdgliajeijfiadjvlakjgiajrladjigjrgijadkljailjaiejasjdivandvn<nfEWTijfgdsjgfdagk', '2017/05/23 11:10:51', 1),
(2, 'paloma', 'rita', 'abc', 'jdifajeladijf', '2017/05/23 11:18:32', 0),
(3, 'paloma', 'paloma', 'correo1', 'hola que pasa\r\n', '2017/05/23 11:38:36', 1),
(4, 'paloma', 'paloma', 'mensaje 2', 'mensaje 2', '2017/05/24 09:11:50', 1),
(5, 'paloma', 'paloma', 'mensaje 3', 'mensaje 3', '2017/05/24 09:16:09', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `nombre` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `musica` enum('pop','rock','indie','rap','jazz') NOT NULL,
  `edad` int(11) NOT NULL DEFAULT '18',
  `administrador` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `password`, `musica`, `edad`, `administrador`) VALUES
('admin', 'admin', 'jazz', 55, 1),
('Antonio', 'antonio', 'pop', 12, 0),
('David', 'david', 'pop', 33, 0),
('Melon', 'melon', 'rock', 12, 0),
('paloma', 'abc', 'pop', 18, 0),
('rita', 'rita', 'rap', 20, 0),
('rtyui', '789', 'pop', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `componentes`
--
ALTER TABLE `componentes`
 ADD PRIMARY KEY (`idGrupo`,`usuario`), ADD KEY `idGrupo` (`idGrupo`), ADD KEY `usuario` (`usuario`), ADD KEY `usuario_2` (`usuario`), ADD KEY `idGrupo_2` (`idGrupo`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
 ADD PRIMARY KEY (`id`), ADD KEY `id` (`id`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
 ADD PRIMARY KEY (`id`), ADD KEY `emisor` (`emisor`), ADD KEY `receptor` (`receptor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`nombre`), ADD KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `componentes`
--
ALTER TABLE `componentes`
ADD CONSTRAINT `componentes_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`nombre`),
ADD CONSTRAINT `componentes_ibfk_1` FOREIGN KEY (`idGrupo`) REFERENCES `grupos` (`id`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`emisor`) REFERENCES `usuarios` (`nombre`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
