-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2020 a las 13:39:10
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `polideportivo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_instalacion`
--

CREATE TABLE `horario_instalacion` (
  `id` int(11) NOT NULL,
  `dia_semana` int(11) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `id_instalacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalaciones`
--

CREATE TABLE `instalaciones` (
  `idInstalacion` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `imagen` varchar(500) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `precio` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `instalaciones`
--

INSERT INTO `instalaciones` (`idInstalacion`, `nombre`, `descripcion`, `imagen`, `precio`, `id_reserva`) VALUES
(1, 'Pista padel 1', 'Primera pista a mano derecha', NULL, 10, 1),
(2, 'Pista padel 2', 'Primera pista a mano izquierda', NULL, 10, 3),
(3, 'Pista padel 3', 'Segunda pista a mano derecha10', NULL, 10, 4),
(4, 'Pista futbol sala', 'Es la pista que esta al final del todo de las instalaciones', NULL, 15, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idReserva` int(11) NOT NULL,
  `fehca` date NOT NULL,
  `hora` time NOT NULL,
  `precio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idReserva`, `fehca`, `hora`, `precio`, `id_usuario`) VALUES
(1, '2020-11-17', '11:00:00', 10, 1),
(2, '2020-11-19', '13:00:00', 15, 1),
(3, '2020-11-24', '12:15:00', 10, 2),
(4, '2020-11-24', '11:30:00', 10, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `email` varchar(500) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido1` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido2` varchar(100) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `dni` varchar(9) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `imagen` varchar(500) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `tipo` enum('user','admin') COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `email`, `password`, `nombre`, `apellido1`, `apellido2`, `dni`, `imagen`, `tipo`) VALUES
(1, 'montoyaivan97@gmail.com', '77440350', 'ivan', 'montoya', 'sanchez', '77440350V', '', 'admin'),
(2, 'pepe@gmail.com', '12345678', 'pepe', 'pepe', 'pepe', '12345678P', '', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `horario_instalacion`
--
ALTER TABLE `horario_instalacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_instalacion` (`id_instalacion`);

--
-- Indices de la tabla `instalaciones`
--
ALTER TABLE `instalaciones`
  ADD PRIMARY KEY (`idInstalacion`),
  ADD KEY `id_reserva` (`id_reserva`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `horario_instalacion`
--
ALTER TABLE `horario_instalacion`
  ADD CONSTRAINT `horario_instalacion_ibfk_1` FOREIGN KEY (`id_instalacion`) REFERENCES `instalaciones` (`idInstalacion`);

--
-- Filtros para la tabla `instalaciones`
--
ALTER TABLE `instalaciones`
  ADD CONSTRAINT `instalaciones_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`idReserva`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
