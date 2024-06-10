-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 06-06-2024 a las 08:46:19
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `BDMEDIAMAKR`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `usuario` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`usuario`, `password`, `nombre`, `mail`) VALUES
('guillermo', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', 'Guillermo', 'gmhmanzano@outlook.es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `IDArticulo` int(11) NOT NULL,
  `NombreArticulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PrecioArticulo` float NOT NULL,
  `Oferta` enum('S','N') COLLATE utf8_unicode_ci NOT NULL,
  `PrecioOferta` float NOT NULL,
  `Foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Observaciones` text COLLATE utf8_unicode_ci NOT NULL,
  `ArticuloActivo` enum('S','N') COLLATE utf8_unicode_ci NOT NULL,
  `Familia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`IDArticulo`, `NombreArticulo`, `PrecioArticulo`, `Oferta`, `PrecioOferta`, `Foto`, `Observaciones`, `ArticuloActivo`, `Familia`) VALUES
(10, 'Ordenador 1   ', 1500, 'N', 0, 'pictures/mac.jpg', '                                                                                                            ', 'S', 16),
(11, 'Movil 1    ', 200, 'S', 100, 'pictures/movil2.jpg', '                                                                                                                                                ', 'S', 14),
(12, 'Movil 1 ', 1800, 'S', 1600, 'pictures/movil1.jpg', '                    Muy Guay                ', 'S', 14),
(13, 'Ordenador 2', 1200, 'N', 0, 'pictures/ordenador2.jpg', '', 'S', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--

CREATE TABLE `familias` (
  `IDFamilia` int(11) NOT NULL,
  `NombreFamilia` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `familias`
--

INSERT INTO `familias` (`IDFamilia`, `NombreFamilia`) VALUES
(14, 'Móviles'),
(16, 'Ordenadores');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`usuario`);

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`IDArticulo`),
  ADD KEY `NombreArticulo` (`NombreArticulo`);

--
-- Indices de la tabla `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`IDFamilia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `IDArticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `familias`
--
ALTER TABLE `familias`
  MODIFY `IDFamilia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
