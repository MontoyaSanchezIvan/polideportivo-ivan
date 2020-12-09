-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2020 a las 18:57:48
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `dia_semana` varchar(1) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `id_instalacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `horario_instalacion`
--

INSERT INTO `horario_instalacion` (`id`, `dia_semana`, `hora_inicio`, `hora_fin`, `id_instalacion`) VALUES
(1, 'L', '10:00:00', '20:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalaciones`
--

CREATE TABLE `instalaciones` (
  `idInstalacion` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `imagen` varchar(500) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `instalaciones`
--

INSERT INTO `instalaciones` (`idInstalacion`, `nombre`, `descripcion`, `imagen`, `precio`) VALUES
(1, 'Pista padel 1', 'Primera pista a mano derecha', 'imgs/instalacion/3.jpg', 10),
(2, 'Pista padel 2', 'Primera pista a mano izquierda', 'imgs/instalacion/4.jpg', 10),
(3, 'Pista padel 3', 'Segunda pista a mano derecha10', 'imgs/instalacion/5.jpg', 10),
(4, 'Pista futbol sala', 'Es la pista que esta al final del todo de las instalaciones', 'imgs/instalacion/6.jpg', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idReserva` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `precio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_instalacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idReserva`, `fecha`, `hora`, `precio`, `id_usuario`, `id_instalacion`) VALUES
(0, '2020-12-12', '13:00:00', 50, 0, 1),
(1, '2020-12-17', '11:00:00', 10, 1, 2),
(2, '2020-12-19', '13:00:00', 15, 1, 4),
(3, '2020-12-24', '12:15:00', 10, 2, 1),
(4, '2020-12-24', '11:30:00', 10, 2, 3);

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
(1, 'montoyaivan97@gmail.com', '77440350', 'ivan', 'montoya', 'sanchez', '77440350V', 'imgs/usuario/1.jpg', 'admin'),
(2, 'pepe@gmail.com', '12345678', 'pepe', 'pepe', 'pepe', '12345678P', 'imgs/usuario/2.jpg', 'user');

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
  ADD PRIMARY KEY (`idInstalacion`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `fk_id_instalacion` (`id_instalacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `horario_instalacion`
--
ALTER TABLE `horario_instalacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `instalaciones`
--
ALTER TABLE `instalaciones`
  MODIFY `idInstalacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `horario_instalacion`
--
ALTER TABLE `horario_instalacion`
  ADD CONSTRAINT `horario_instalacion_ibfk_1` FOREIGN KEY (`id_instalacion`) REFERENCES `instalaciones` (`idInstalacion`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `fk_id_instalacion` FOREIGN KEY (`id_instalacion`) REFERENCES `instalaciones` (`idInstalacion`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
