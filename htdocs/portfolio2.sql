-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2024 a las 10:03:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `portfolio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `head`
--

CREATE TABLE `head` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_portfolio` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `apellido2` varchar(30) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `img` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `head`
--

INSERT INTO `head` (`id`, `id_usuario`, `id_portfolio`, `name`, `apellido`, `apellido2`, `anio`, `img`) VALUES
(1, 1, 1, 'Eduuuuuuu', '13', '13', '1211', './img/subidas/upload1.jpg'),
(2, 4, 2, 'Eduuuuuuu', '123', '134', '13', './img/subidas/upload4.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_experiencia`
--

CREATE TABLE `linea_experiencia` (
  `id` int(11) NOT NULL,
  `id_portfolio` int(11) NOT NULL,
  `company` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `fechaE` date NOT NULL,
  `fechaS` date NOT NULL,
  `experience` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `linea_experiencia`
--

INSERT INTO `linea_experiencia` (`id`, `id_portfolio`, `company`, `position`, `fechaE`, `fechaS`, `experience`) VALUES
(1, 1, '', '', '1970-01-01', '1970-01-01', ''),
(2, 2, '', '', '1970-01-01', '1970-01-01', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_redes`
--

CREATE TABLE `linea_redes` (
  `id` int(11) NOT NULL,
  `id_portfolio` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `link` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `port`
--

CREATE TABLE `port` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `port`
--

INSERT INTO `port` (`id`, `id_usuario`) VALUES
(1, 1),
(2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_redes`
--

CREATE TABLE `tipo_redes` (
  `id` int(11) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `username`, `password`) VALUES
(1, 'Edu', 'eduu', '$2y$10$VLg4PqJhvLS5k6Xjw7Xe6eSnTonMhR9uzhMx.dKh/NkVskTJ0/NUe'),
(2, 'Alex', 'ales', '$2y$10$oBTwC3/xuYjoedu1KO473OzLRv4P7Aki5MzytE3gN97lDvuzK9FWW'),
(4, 'Mora', 'a', '$2y$10$zOLA9QClI.gXxxAvUw8SXeEMdmFd4znS/LdNc8XuhxJQkdyk34Qiy');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `head`
--
ALTER TABLE `head`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_portfolio` (`id_portfolio`);

--
-- Indices de la tabla `linea_experiencia`
--
ALTER TABLE `linea_experiencia`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_portfolio` (`id_portfolio`);

--
-- Indices de la tabla `linea_redes`
--
ALTER TABLE `linea_redes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_portfolio` (`id_portfolio`),
  ADD KEY `tipo` (`tipo`);

--
-- Indices de la tabla `port`
--
ALTER TABLE `port`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tipo_redes`
--
ALTER TABLE `tipo_redes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `head`
--
ALTER TABLE `head`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `linea_experiencia`
--
ALTER TABLE `linea_experiencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `linea_redes`
--
ALTER TABLE `linea_redes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `port`
--
ALTER TABLE `port`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_redes`
--
ALTER TABLE `tipo_redes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `head`
--
ALTER TABLE `head`
  ADD CONSTRAINT `head_ibfk_1` FOREIGN KEY (`id_portfolio`) REFERENCES `port` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `linea_experiencia`
--
ALTER TABLE `linea_experiencia`
  ADD CONSTRAINT `linea_experiencia_ibfk_1` FOREIGN KEY (`id_portfolio`) REFERENCES `port` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `linea_redes`
--
ALTER TABLE `linea_redes`
  ADD CONSTRAINT `linea_redes_ibfk_1` FOREIGN KEY (`tipo`) REFERENCES `tipo_redes` (`id`),
  ADD CONSTRAINT `linea_redes_ibfk_2` FOREIGN KEY (`id_portfolio`) REFERENCES `port` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `port`
--
ALTER TABLE `port`
  ADD CONSTRAINT `port_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
