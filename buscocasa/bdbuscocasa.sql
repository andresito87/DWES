-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2024 a las 03:00:31
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdbuscocasa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `login` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`login`, `password`, `nombre`, `mail`) VALUES
('jaime', 'f10ff193e4b526402f977a3c71d9e876bcfcded9', 'jaime', 'jaime@jaime.es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmuebles`
--

CREATE TABLE `inmuebles` (
  `IDInmueble` int(12) NOT NULL,
  `Calle` varchar(255) NOT NULL,
  `Ciudad` varchar(30) NOT NULL,
  `CP` int(5) NOT NULL,
  `IDProvincia` int(11) NOT NULL,
  `MetrosCuadrados` int(10) NOT NULL,
  `NumHabitaciones` int(10) NOT NULL,
  `NumServicios` int(10) NOT NULL,
  `PeriodoConstruccion` int(11) DEFAULT NULL,
  `Foto` varchar(255) DEFAULT NULL,
  `LinkMaps` varchar(2048) NOT NULL,
  `SituacionInmueble` enum('ALQUILER','VENTA') NOT NULL,
  `PrecioAlquiler` float NOT NULL,
  `PrecioVenta` float NOT NULL,
  `NRefCat` varchar(100) NOT NULL,
  `Reservado` enum('S','N') NOT NULL,
  `FechaReserva` date NOT NULL,
  `ImporteReserva` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `inmuebles`
--

INSERT INTO `inmuebles` (`IDInmueble`, `Calle`, `Ciudad`, `CP`, `IDProvincia`, `MetrosCuadrados`, `NumHabitaciones`, `NumServicios`, `PeriodoConstruccion`, `Foto`, `LinkMaps`, `SituacionInmueble`, `PrecioAlquiler`, `PrecioVenta`, `NRefCat`, `Reservado`, `FechaReserva`, `ImporteReserva`) VALUES
(4, 'jaime', 'jaime', 47005, 2, 123, 3, 4, 1995, 'pictures/casa2.jpeg', 'https://maps.app.goo.gl/2zoRCA1VqpsKD4Zb8', 'ALQUILER', 123, 0, '213qdasda', 'N', '0000-00-00', 0),
(5, 'inmue', 'sdfsdf', 47006, 3, 123, 3, 4, 1980, 'pictures/casa2.jpeg', 'https://www.google.es/', 'VENTA', 0, 35, '123wdqwdw', 'N', '2024-06-19', 32),
(8, 'eqweqweq', 'wqeqweq', 12353, 2, 123, 3, 4, 1999, 'pictures/casa2.jpeg', 'https://www.google.es/', 'ALQUILER', 133, 0, 'fefef13jaime', 'S', '2024-06-07', 132);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `IDProvincia` int(11) NOT NULL,
  `NombreProvincia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`IDProvincia`, `NombreProvincia`) VALUES
(1, 'Álava'),
(2, 'Albacete'),
(3, 'Alicante'),
(4, 'Almería'),
(5, 'Asturias'),
(6, 'Ávila'),
(7, 'Badajoz'),
(8, 'Baleares'),
(9, 'Barcelona'),
(10, 'Burgos'),
(11, 'Cáceres'),
(12, 'Cádiz'),
(13, 'Cantabria'),
(14, 'Castellón'),
(15, 'Ciudad Real'),
(16, 'Córdoba'),
(17, 'Cuenca'),
(18, 'Gerona'),
(19, 'Granada'),
(20, 'Guadalajara'),
(21, 'Guipúzcoa'),
(22, 'Huelva'),
(23, 'Huesca'),
(24, 'Jaén'),
(25, 'La Coruña'),
(26, 'La Rioja'),
(27, 'Las Palmas'),
(28, 'León'),
(29, 'Lérida'),
(30, 'Lugo'),
(31, 'Madrid'),
(32, 'Málaga'),
(33, 'Murcia'),
(34, 'Navarra'),
(35, 'Orense'),
(36, 'Palencia'),
(37, 'Pontevedra'),
(38, 'Salamanca'),
(39, 'Segovia'),
(40, 'Sevilla'),
(41, 'Soria'),
(42, 'Tarragona'),
(43, 'Tenerife'),
(44, 'Teruel'),
(45, 'Toledo'),
(46, 'Valencia'),
(47, 'Valladolid'),
(48, 'Vizcaya'),
(49, 'Zamora'),
(50, 'Zaragoza');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`login`);

--
-- Indices de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  ADD PRIMARY KEY (`IDInmueble`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`IDProvincia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inmuebles`
--
ALTER TABLE `inmuebles`
  MODIFY `IDInmueble` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `IDProvincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
