-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-01-2020 a las 14:19:27
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--
DROP DATABASE IF EXISTS `tienda`;
CREATE DATABASE IF NOT EXISTS `tienda` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `tienda`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `id` varchar(36) NOT NULL,
  `email` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `contrasenna` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `cliente`
--

TRUNCATE TABLE `cliente`;
--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `email`, `contrasenna`, `nombre`, `direccion`, `telefono`) VALUES
('95d2b90a-1b60-4321-b5d5-16e18e1d0616', 'jlopez@gmail.com', 'j', 'José Lopez', 'Av. vascongadas 2 1B', '123456789'),
('97269e70-2705-4a89-9346-5d384be9d232', 'mgarcia@gmail.com', 'm', 'María', NULL, NULL),
('5d0254aa-c1a8-4b83-8c1e-54340e499268', 'jfernandez@gmail.com', '1234', 'Juanito', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineaPedido`
--

DROP TABLE IF EXISTS `lineaPedido`;
CREATE TABLE `lineaPedido` (
  `pedido_id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `unidades` int(11) NOT NULL,
  `precioUnitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `lineaPedido`
--

TRUNCATE TABLE `lineaPedido`;
--
-- Volcado de datos para la tabla `lineaPedido`
--

INSERT INTO `lineaPedido` (`pedido_id`, `producto_id`, `unidades`, `precioUnitario`) VALUES
('e2d9f777-9b80-4f24-9773-ba7e249dfa41', '4cfc2907-db21-419e-abe9-becceb124e31', 3, NULL),
('e2d9f777-9b80-4f24-9773-ba7e249dfa41', '8f66a6d8-5d6a-41ca-a0b0-0955d1ad5852', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE `pedido` (
  `id` varchar(36) NOT NULL,
  `cliente_id` varchar(36) NOT NULL,
  `direccionEnvio` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechaConfirmacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `pedido`
--

TRUNCATE TABLE `pedido`;
--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `cliente_id`, `direccionEnvio`, `fechaConfirmacion`) VALUES
('e2d9f777-9b80-4f24-9773-ba7e249dfa41', '95d2b90a-1b60-4321-b5d5-16e18e1d0616', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `id` varchar(36) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(5000) COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Truncar tablas antes de insertar `producto`
--

TRUNCATE TABLE `producto`;
--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `precio`) VALUES
('4cfc2907-db21-419e-abe9-becceb124e31', 'Cafetera', 'Modelo 5000, con doble filtro de partículas.', '9.87'),
('8f66a6d8-5d6a-41ca-a0b0-0955d1ad5852', 'Roomba', 'Suba y baja escaleras, último modelo.', '11.67');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lineaPedido`
--
ALTER TABLE `lineaPedido`
  ADD PRIMARY KEY (`pedido_id`,`producto_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);


--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineaPedido`
--
ALTER TABLE `lineaPedido`
  ADD CONSTRAINT `lineaPedido_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lineaPedido_ibfk_3` FOREIGN KEY (`pedido_id`) REFERENCES `pedido` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
