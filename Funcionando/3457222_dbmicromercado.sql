-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Servidor: fdb25.awardspace.net
-- Tiempo de generación: 12-06-2020 a las 03:43:54
-- Versión del servidor: 5.7.20-log
-- Versión de PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `3457222_dbmicromercado`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriaprod`
--

CREATE TABLE `categoriaprod` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoriaprod`
--

INSERT INTO `categoriaprod` (`Id`, `Nombre`) VALUES
(1, 'BALANCEADOS MARCA BIO ALIMENTOS'),
(2, 'ARTICULOS DE PRIMERA NECESIDAD'),
(3, 'FIDEOS LINEA VARIADA'),
(4, 'ACEITES DE COCINA'),
(5, 'LINEA DE BEBIDAS'),
(6, 'Licores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `Id` int(11) NOT NULL,
  `Cedula` varchar(10) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `Celular` varchar(10) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Foto` varchar(50) NOT NULL,
  `Ubicacion` varchar(100) NOT NULL,
  `Contrasena` varchar(500) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Id`, `Cedula`, `Nombre`, `Apellido`, `Telefono`, `Celular`, `Direccion`, `Foto`, `Ubicacion`, `Contrasena`, `Email`) VALUES
(1, '1805037619', 'Anderson', 'Naranjo', '', '0939180393', 'Patate', 'img_avatar.png', '', '81dc9bdb52d04dc20036dbd8313ed055', 'anderson109614@gmail.com'),
(2, '1212121212', 'Pedro', 'Montero', '', '0909090909', 'Ambato alle 1 y dos', 'img_avatar.png', '', '81dc9bdb52d04dc20036dbd8313ed055', 'pedro@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE `configuracion` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(100) NOT NULL,
  `HTML` varchar(1000) NOT NULL,
  `Icono` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`Id`, `Nombre`, `Descripcion`, `HTML`, `Icono`) VALUES
(1, 'Mapa', '', 'https://www.google.es/maps/place/Universidad+Técnica+de+Ambato/@-1.2681022,-78.6250797,16.5z/data=!4m5!3m4!1s0x91d38225e088295f:0xb16c26da66e6e4b3!8m2!3d-1.2691068!4d-78.6235553', 'map'),
(2, 'MICROMERCADO HORTENCIA', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleprod`
--

CREATE TABLE `detalleprod` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Estado` int(11) NOT NULL,
  `Id_Producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalleprod`
--

INSERT INTO `detalleprod` (`Id`, `Nombre`, `Precio`, `Estado`, `Id_Producto`) VALUES
(1, 'Quintal', 27.00, 1, 1),
(2, 'arroba', 8.75, 1, 1),
(3, 'Libra ', 0.35, 1, 1),
(4, 'Unidad', 5.00, 1, 6),
(5, 'Pak', 25.50, 1, 6),
(6, 'Libra', 6.00, 0, 7),
(7, 'otro', 2.00, 0, 7),
(8, 'LIbra', 2.25, 1, 7),
(9, 'Libra', 2.20, 1, 2),
(10, 'Libra', 1.20, 1, 4),
(11, 'Quintal', 37.50, 1, 5),
(12, 'Quintal', 2.30, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`Id`, `Nombre`, `Color`) VALUES
(1, 'Espera', 'warning'),
(2, 'Aprobado', 'primary'),
(3, 'Entregado', 'success'),
(4, 'Descartado', 'danger');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `Id` int(11) NOT NULL,
  `Id_Cliente` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `IVA` decimal(10,0) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Ubicacion` varchar(100) NOT NULL,
  `Id_Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`Id`, `Id_Cliente`, `Fecha`, `IVA`, `Total`, `Ubicacion`, `Id_Estado`) VALUES
(1, 1, '2020-06-04', 0, 27.00, 'undefined;undefined', 1),
(2, 1, '2020-06-04', 0, 0.00, 'undefined;undefined', 4),
(3, 1, '2020-06-04', 0, 0.00, 'undefined;undefined', 3),
(4, 1, '2020-06-04', 0, 27.00, 'undefined;undefined', 2),
(5, 1, '2020-06-12', 0, 26.70, 'undefined;undefined', 1),
(6, 1, '2020-06-12', 0, 96.00, 'undefined;undefined', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_det`
--

CREATE TABLE `pedido_det` (
  `Id` int(11) NOT NULL,
  `Id_Det_Prod` int(11) NOT NULL,
  `Id_Pedido` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedido_det`
--

INSERT INTO `pedido_det` (`Id`, `Id_Det_Prod`, `Id_Pedido`, `Cantidad`) VALUES
(1, 1, 1, 1),
(2, 3, 4, 1),
(3, 1, 4, 1),
(4, 5, 5, 5),
(5, 10, 5, 2),
(6, 1, 6, 3),
(7, 4, 6, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Foto` varchar(50) NOT NULL,
  `Id_Categoria` int(11) NOT NULL,
  `Estado` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Id`, `Nombre`, `Foto`, `Id_Categoria`, `Estado`) VALUES
(1, 'Balanceado de cerdo inicial', 'Balanceado-2020-06-11-17-54.png', 1, '1'),
(2, 'Balanceado de cerdo crecimiento ', '2020-06-11-18-14.png', 1, '1'),
(4, 'Arroz gallito', '2020-06-12-1-02.png', 2, '1'),
(5, 'Arroz macareño ', 'no-imagen.jpg', 2, '1'),
(6, 'Cartago', 'no-imagen.jpg', 6, '1'),
(7, 'Balanceado de cerdo', 'no-imagen.jpg', 1, '1'),
(8, 'Balanceado de cerdo', 'no-imagen.jpg', 1, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioweb`
--

CREATE TABLE `usuarioweb` (
  `Id` int(11) NOT NULL,
  `Cedula` varchar(10) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Contrasena` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarioweb`
--

INSERT INTO `usuarioweb` (`Id`, `Cedula`, `Nombre`, `Apellido`, `Contrasena`) VALUES
(1, '1805037619', 'Anderson', 'Naranjo', '1234'),
(2, 'admin', 'admin', 'admin', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoriaprod`
--
ALTER TABLE `categoriaprod`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `detalleprod`
--
ALTER TABLE `detalleprod`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pedido_det`
--
ALTER TABLE `pedido_det`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuarioweb`
--
ALTER TABLE `usuarioweb`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoriaprod`
--
ALTER TABLE `categoriaprod`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `detalleprod`
--
ALTER TABLE `detalleprod`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `pedido_det`
--
ALTER TABLE `pedido_det`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `usuarioweb`
--
ALTER TABLE `usuarioweb`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
