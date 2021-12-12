-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2021 a las 17:02:40
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(30) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `pass` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `telefono` varchar(60) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `pass`, `email`, `telefono`, `direccion`) VALUES
(3, 'chandler', '738aa8d3bc02eb8712acd0eb2cf6dfd5', 'cmbing@friends.com', '555555555', 'Apartamento 20, edificio arriba del Central Perk, NY'),
(4, 'frodo', '2ad422d826d9a8591f1f804ec5f0a5dd', 'frodoB@lacomarca.com', '-', 'Bolsón cerrado, Hobbiton'),
(5, 'mike', 'c12e01f2a13ff5587e1e9e4aedb8242d', 'mikew@monstruos.sa', '122344556', 'Monstruopolis');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(100) NOT NULL,
  `id_cliente` int(100) NOT NULL,
  `fecha` varchar(60) NOT NULL,
  `importe` int(60) NOT NULL,
  `codigo_random` varchar(10) NOT NULL,
  `premio` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`id_compra`, `id_cliente`, `fecha`, `importe`, `codigo_random`, `premio`) VALUES
(12, 3, '28-11-2021', 0, 'ZcqXCUyrft', 1),
(13, 4, '28-11-2021', 30, 'EPCXIb0MwG', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consta`
--

CREATE TABLE `consta` (
  `cod_prod` int(60) NOT NULL,
  `cod_compra` int(60) NOT NULL,
  `cantidad` int(60) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `cod_prod` int(100) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` float NOT NULL,
  `valoracion` float NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `categoria` enum('Diario','Trabajo','Eventos','Fiestas','Online','Almacen') NOT NULL,
  `stock` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`cod_prod`, `nombre`, `descripcion`, `precio`, `valoracion`, `imagen`, `categoria`, `stock`) VALUES
(1, 'Papel mimimi', 'mimimimimimimimimimimimimi', 20, 4.5, 'https://previews.123rf.com/images/samuiarzt/samuiarzt1106/samuiarzt110600491/9920053-pila-de-papel-blanco-en-blanco-aislado-sobre-fondo-blanco.jpg', 'Online', 77),
(2, 'Papel navideño', 'Como el que haces cada año con tu familia en la cena de Nochebuena', 10, 3, 'https://previews.123rf.com/images/usersam2007/usersam20071611/usersam2007161100009/68039051-pila-de-palillo-de-la-nota-papel-blanco-aislado-en-blanco-con-trazado-de-recorte.jpg', 'Online', 95),
(3, 'Examenes suspensos', 'Con capa waterprof para que las lagrimas de tus alumnos no estropeen su perfecto acabado!', 15, 5, 'https://previews.123rf.com/images/homestudio/homestudio1104/homestudio110400198/9391356-pila-de-papel-sobre-fondo-blanco.jpg', 'Trabajo', 149),
(4, 'Propositos de año nuevo ', '', 15, 3, 'https://previews.123rf.com/images/picsfive/picsfive1202/picsfive120200029/12271316-cerca-de-una-nota-de-papel-en-blanco-sobre-fondo-blanco-con-saturaci%C3%B3n-camino.jpg', 'Diario', 300),
(5, 'Ideas frustradas', 'Su diseño aerodinámico hace este producto perfecto para encestar en cualquier papelera!', 10, 4, 'https://previews.123rf.com/images/homestudio/homestudio0906/homestudio090600158/4967400-pila-de-libros-sobre-fondo-blanco-aislado-.jpg', 'Almacen', 100),
(6, 'Guiones de The Witcher', 'Nadie entiende cómo ha llegado hasta aquí ni para qué sirve', 5, 1, 'https://previews.123rf.com/images/homestudio/homestudio1507/homestudio150700017/42145251-pila-de-tarjetas-en-blanco-sobre-fondo-blanco.jpg', 'Online', 500),
(7, 'Papel Negro', '\"Black sheets matters\"', 10, 2, 'https://5.imimg.com/data5/MJ/BI/FV/SELLER-3231945/black-paper-sheet-250x250.jpg', '', 400),
(9, 'Papel falso', 'Escrito en sánscrito por las dos caras para que parezca que estás haciendo algo culto', 25, 4, 'https://media.istockphoto.com/photos/ancient-hand-written-text-background-picture-id183875290', '', 150);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`,`id_cliente`),
  ADD KEY `id_cli_FK` (`id_cliente`);

--
-- Indices de la tabla `consta`
--
ALTER TABLE `consta`
  ADD PRIMARY KEY (`cod_prod`,`cod_compra`),
  ADD KEY `cod_compra_FK` (`cod_compra`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`cod_prod`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `cod_prod` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `id_cli_FK` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `consta`
--
ALTER TABLE `consta`
  ADD CONSTRAINT `cod_compra_FK` FOREIGN KEY (`cod_compra`) REFERENCES `compra` (`id_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cod_prod_FK` FOREIGN KEY (`cod_prod`) REFERENCES `producto` (`cod_prod`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
