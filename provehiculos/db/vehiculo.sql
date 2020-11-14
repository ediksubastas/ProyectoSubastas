-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-11-2020 a las 23:05:15
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
-- Base de datos: `provehiculos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `idVehiculo` int(11) NOT NULL,
  `modelo` int(11) DEFAULT NULL,
  `tipoMotor` varchar(100) DEFAULT NULL,
  `cc` int(11) DEFAULT NULL,
  `traccion` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `precio` int(11) DEFAULT NULL,
  `comentario` varchar(500) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `linea` varchar(45) DEFAULT NULL,
  `imagen` varchar(300) DEFAULT NULL,
  `Usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`idVehiculo`, `modelo`, `tipoMotor`, `cc`, `traccion`, `color`, `precio`, `comentario`, `estado`, `marca`, `linea`, `imagen`, `Usuario_idUsuario`) VALUES
(1, 2020, 'DIESEL', 45, '4x2', '#e61919', 54645, '645', 'SINOFERTA', 'VOLVO', '550', '138503.jpg', 1),
(2, 2020, 'HIBRIDO', 5646, '4x2', '#d53434', 45645, '465465', 'ACTIVO', 'MERCEDEZ', 'BT-50', 'default.jpg', 1),
(3, 2020, 'DIESEL', 5645, '4x2', '#ff6600', 546546, 'fadsfasdfasd', 'VENDIDO', 'TOYOTA', 'YARIS', 'Imagen2.jpg', 1),
(4, 2020, 'GASOLINA', 2400, '4x4', '#000000', 324342, 'FGDSSDFG', 'ACEPTADO', 'TOYOTA', 'TACOMA', 'Tacoma_2020_Hero_Image.png', 1),
(6, 2005, 'DIESEL', 5000, '4x4', '#770e0e', 1500, 'dgasdgasd', 'ACTIVO', 'VOLVO', 'BT-50', 'f439f3a9805455552823bec74a85eba3.jpg', 1),
(7, 2020, 'DIESEL', 345, '4x4', '#021eed', 2543, 'adsfasd', 'ACTIVO', 'TOYOTA', 'BT-50', 'damhm6d-4197f1c7-b5a7-4947-908b-313ee14436b5.jpg', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`idVehiculo`),
  ADD KEY `fk_Vehiculo_Usuario1_idx` (`Usuario_idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `idVehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `fk_Vehiculo_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
