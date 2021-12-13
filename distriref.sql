-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-12-2021 a las 19:12:03
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `distriref`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `Perm_ID` bigint(20) NOT NULL,
  `r` int(11) NOT NULL DEFAULT 0,
  `w` int(11) NOT NULL DEFAULT 0,
  `d` int(11) NOT NULL DEFAULT 0,
  `u` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`Perm_ID`, `r`, `w`, `d`, `u`) VALUES
(1, 1, 1, 1, 1),
(2, 0, 0, 0, 0),
(3, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `Per_ID` bigint(20) NOT NULL,
  `Per_Nombre` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Per_Apellidos` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Per_Email` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Per_Passwd` varchar(500) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Per_Foto` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `Rol_ID` bigint(20) NOT NULL,
  `Per_Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`Per_ID`, `Per_Nombre`, `Per_Apellidos`, `Per_Email`, `Per_Passwd`, `Per_Foto`, `Rol_ID`, `Per_Status`) VALUES
(4, 'BRIAN STEVEN', 'CANON ROJAS', 'bscanonr@correo.udistrital.edu.co', 'd2dhVFBzVUpqTlNTRVN6TGRGbEpyVzZNS3V6MS9wTzhlS1BTQ0E5aVkrST0=', 'https://lh3.googleusercontent.com/a-/AOh14Gh9sOaudTgTXERLYGZL2ebfz0BEbObxojXlokEc-A=s96-c', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `Rol_ID` bigint(20) NOT NULL,
  `Rol_Nom` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Perm_ID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`Rol_ID`, `Rol_Nom`, `Perm_ID`) VALUES
(1, 'Administrador', 1),
(2, 'Estudiante', 2),
(3, 'Docente', 3),
(4, 'Otros', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`Perm_ID`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`Per_ID`),
  ADD UNIQUE KEY `Email_Per` (`Per_Email`),
  ADD KEY `Rol_ID` (`Rol_ID`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Rol_ID`),
  ADD KEY `Perm_ID` (`Perm_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `Perm_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `Per_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `Rol_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`Rol_ID`) REFERENCES `rol` (`Rol_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `rol`
--
ALTER TABLE `rol`
  ADD CONSTRAINT `rol_ibfk_1` FOREIGN KEY (`Perm_ID`) REFERENCES `permisos` (`Perm_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
