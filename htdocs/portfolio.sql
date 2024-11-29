-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2024 a las 11:49:43
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
(1, 1, 1, 'Eduardo    ', 'Ramiro    ', '1    ', '1111', './img/subidas/upload1-1.jpg'),
(2, 1, 2, 'Paco', 'Gonzalez', 'Del Sur', '1970', './img/subidas/1-2.jpg'),
(3, 1, 3, 'Campi', 'David', 'Trenado', '2004', './img/subidas/1-3.jpg'),
(4, 1, 4, 'Guts', 'El duro', 'Sanchez', '1999', './img/subidas/1-4.jpg'),
(5, 1, 5, 'Falo', 'San', 'Roque', '500', './img/subidas/1-5.jpg'),
(6, 1, 6, 'Jalan', 'Man', ' City', '1111', './img/subidas/1-6.jpg'),
(7, 1, 7, 'Campi ', 'a1 ', '1 ', '1 ', './img/subidas/1-7.jpg');

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
(1, 1, 'Coessegur    ', 'IT ', '2024-11-22', '2024-11-23', 'Oficina'),
(2, 2, 'Obra', 'Obrero', '2013-01-29', '2024-11-29', 'No trabajéis en la obra'),
(3, 3, 'Cobs And Tops', 'Tartero', '2018-01-29', '2024-11-29', 'Muy buena'),
(4, 4, 'Señor Sombrio', 'Ladrón', '2014-05-29', '2024-11-29', 'Ibai a sueldo del PSOE'),
(5, 5, 'Camello', 'Porrero', '1912-01-29', '2024-11-29', '2 detenciones'),
(6, 6, 'Man City', 'Delantero', '2009-01-29', '2024-11-29', 'No ganó el BDO'),
(7, 7, ' Swag', ' Albañil', '1970-01-01', '2023-05-01', ' Vende Tussi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `port`
--

CREATE TABLE `port` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `port`
--

INSERT INTO `port` (`id`, `id_usuario`, `activo`) VALUES
(1, 1, 1),
(2, 1, 1),
(3, 1, 1),
(4, 1, 1),
(5, 1, 1),
(6, 1, 1),
(7, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `twitter` varchar(25) NOT NULL,
  `github` varchar(25) NOT NULL,
  `email` varchar(90) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `id_portfolio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `social`
--

INSERT INTO `social` (`id`, `twitter`, `github`, `email`, `tel`, `id_portfolio`) VALUES
(1, 'luisitoleal', 'as', 'eduardoramirozabaleta@gmail.com    ', '654618294    ', 1),
(2, 'a', 'a', 'josemacho@gmail.com ', '111111111 ', 7),
(3, 'a', 'a', 'adadad@gmail.com', '113133133', 3),
(4, 'a', 'a', 'adadad@gmail.com', '1113133', 2),
(5, 'ansufatidico', 'eduuramirooo', 'adadad@gmail.com', '6666666', 4),
(6, 'faliyo', 'faliyo', 'adadad@gmail.com', '1131313', 5),
(7, 'a', 'a', 'adadad@gmail.com', '131313', 6);

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
(2, 'Alex', 'ales', '$2y$10$oBTwC3/xuYjoedu1KO473OzLRv4P7Aki5MzytE3gN97lDvuzK9FWW');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `head`
--
ALTER TABLE `head`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `linea_experiencia`
--
ALTER TABLE `linea_experiencia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `port`
--
ALTER TABLE `port`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `social`
--
ALTER TABLE `social`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `linea_experiencia`
--
ALTER TABLE `linea_experiencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `port`
--
ALTER TABLE `port`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
