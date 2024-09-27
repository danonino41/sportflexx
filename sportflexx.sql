-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-09-2024 a las 04:33:58
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
-- Base de datos: `sportflexx`
--
CREATE DATABASE IF NOT EXISTS `sportflexx` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sportflexx`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IdCategoria` int(11) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Descripcion` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCategoria`, `Nombre`, `Descripcion`) VALUES
(1, 'HOMBRE', 'Ropa para hombre'),
(2, 'MUJER', 'Ropa para mujer'),
(3, 'ACCESORIOS', 'Accesorios de moda'),
(4, 'NOVEDADES', 'Ediciones Limitadas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `IdCliente` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `Nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Apellido` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Sexo` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `FechaNacimiento` date DEFAULT NULL,
  `Telefono` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Dni` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`IdCliente`, `IdUsuario`, `Nombre`, `Apellido`, `Sexo`, `FechaNacimiento`, `Telefono`, `Dni`) VALUES
(6, 10, 'gerson', 'vegaaa', 'male', '2020-12-21', '904931932', '48545254184'),
(10, 14, 'Danito', 'Pablito', 'male', '2024-09-13', '96325871', '78419863'),
(11, 15, 'Pana', 'Miguel', 'male', '2024-08-27', '741852963', '78965412'),
(15, 19, 'Danito', 'Chocoflan', 'male', '2005-07-16', '924484038', '71526042'),
(16, 21, 'Daniel', 'Wang', 'male', '2024-08-28', '904931932', '78965412');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupondescuento`
--

CREATE TABLE `cupondescuento` (
  `IdCuponDescuento` int(11) NOT NULL,
  `Codigo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Descripcion` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `DescuentoPorcentaje` decimal(5,2) NOT NULL,
  `FechaInicio` date NOT NULL,
  `FechaFin` date NOT NULL,
  `Activo` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cupondescuento`
--

INSERT INTO `cupondescuento` (`IdCuponDescuento`, `Codigo`, `Descripcion`, `DescuentoPorcentaje`, `FechaInicio`, `FechaFin`, `Activo`) VALUES
(1, 'U22', 'Descuento del 10%', 0.10, '2024-07-17', '2024-07-24', b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
  `IdDetallePedido` int(11) NOT NULL,
  `IdPedido` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `PrecioUnitario` decimal(13,2) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Descuento` decimal(13,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `IdDireccion` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `Departamento` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Provincia` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Distrito` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Direccion` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`IdDireccion`, `IdCliente`, `Departamento`, `Provincia`, `Distrito`, `Direccion`) VALUES
(9, 6, 'Lima', 'asdasdas', 'asd', 'asdasd'),
(14, 10, 'Moquegua', 'Lima', 'Lima', 'Lima'),
(15, 11, 'Lima', 'Lima', 'Lima', 'Lima'),
(19, 10, 'Moquegua', 'Lima', 'Lima', 'Lima'),
(20, 6, 'Lima', 'asdasdas', 'Lima', 'asdasd'),
(21, 15, 'Lima', 'Lima', 'Lima', 'where'),
(22, 16, 'Lima', 'Lima', 'asd', 'asdasd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `IdMenu` int(11) NOT NULL,
  `Nombre` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Ruta` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`IdMenu`, `Nombre`, `Ruta`) VALUES
(1, 'MenuAdmin', 'MenuAdmin.php'),
(2, 'MenuPrincipalCliente', 'MenuPrincipalCliente.php'),
(3, 'HombreCliente', 'hombreCliente.php'),
(4, 'MujerCliente', 'mujerCliente.php'),
(5, 'AccesoriosClientes', 'accesoriosClientes.php'),
(6, 'Novedades', 'novedades.php'),
(7, 'MiPerfil', 'MiPerfil.php'),
(8, 'CarritoCompras', 'CarritoCompras.html');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opinionproducto`
--

CREATE TABLE `opinionproducto` (
  `IdOpinionProducto` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Comentario` varchar(1000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Calificacion` int(11) DEFAULT NULL CHECK (`Calificacion` between 1 and 5),
  `FechaOpinion` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `IdPedido` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `NumeroPedido` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Estado` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `FechaPedido` date NOT NULL DEFAULT curdate(),
  `FechaEntrega` date DEFAULT NULL,
  `IdCuponDescuento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`IdPedido`, `IdCliente`, `NumeroPedido`, `Estado`, `FechaPedido`, `FechaEntrega`, `IdCuponDescuento`) VALUES
(7, 6, '12', 'Pendiente', '2024-07-01', '2024-08-10', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `IdProducto` int(11) NOT NULL,
  `Nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Descripcion` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `PrecioUnitario` decimal(10,2) NOT NULL,
  `FechaRegistro` date NOT NULL DEFAULT curdate(),
  `Genero` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ImagenProducto` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`IdProducto`, `Nombre`, `Descripcion`, `IdCategoria`, `PrecioUnitario`, `FechaRegistro`, `Genero`, `ImagenProducto`) VALUES
(100, 'Bolso Verde', 'Bolso verde moderno y cómodo', 3, 29.99, '2024-09-20', 'U', 'bolso verde.png'),
(101, 'Bolso Blanco', 'Bolso blanco elegante para todo tipo de uso', 3, 32.99, '2024-09-20', 'U', 'bolso blanco.png'),
(102, 'Bolso Negro', 'Bolso negro espacioso y versátil', 3, 28.99, '2024-09-20', 'U', 'bolso negro.png'),
(103, 'Mochila Negra', 'Mochila negra ideal para actividades diarias', 3, 49.99, '2024-09-20', 'U', 'mochila negra.png'),
(104, 'Mochila Blanca', 'Mochila blanca con diseño minimalista', 3, 54.99, '2024-09-20', 'U', 'mochila blanca.png'),
(105, 'Mochila Negra Xr', 'Mochila negra XR con más capacidad de almacenamiento', 3, 59.99, '2024-09-20', 'U', 'mochila negra Xr.png'),
(106, 'Mochila Tennis', 'Mochila diseñada especialmente para equipos de tennis', 3, 69.99, '2024-09-20', 'U', 'Mochila Tennis.png'),
(107, 'Mochilón Negro', 'Mochilón negro con múltiples compartimientos', 3, 89.99, '2024-09-20', 'U', 'mochilon negro.png'),
(108, 'Tomatodo', 'Botella de agua Tomatodo resistente para actividades deportivas', 3, 19.99, '2024-09-20', 'U', 'tomatodo.png'),
(109, 'Camiseta Negra Manga Corta', 'Camiseta deportiva negra de manga corta, ideal para entrenamientos intensos.', 1, 89.90, '2024-09-20', 'M', 'Camiseta Negra Manga Corta.png'),
(110, 'Camiseta Blanca sin Mangas', 'Camiseta blanca sin mangas para mayor libertad de movimiento.', 1, 74.90, '2024-09-20', 'M', 'image2.png'),
(111, 'Camiseta Verde Oliva', 'Camiseta ajustada verde oliva, perfecta para entrenamiento en el gimnasio.', 1, 85.00, '2024-09-20', 'M', 'image3.png'),
(112, 'Conjunto Deportivo Azul', 'Conjunto deportivo azul con sudadera y pantalones, ideal para entrenamiento o uso diario.', 1, 179.90, '2024-09-20', 'M', 'image4.png'),
(113, 'Pantalones Deportivos Grises', 'Pantalones deportivos grises para mayor comodidad durante el ejercicio.', 1, 120.00, '2024-09-20', 'M', 'image5.png'),
(114, 'Camiseta Gris Claro Ajustada', 'Camiseta ajustada de color gris claro, diseñada para acentuar la musculatura.', 1, 119.90, '2024-09-20', 'M', 'image6.png'),
(115, 'Camiseta Negra Entrenamiento', 'Camiseta negra de entrenamiento, ideal para sesiones de fuerza.', 1, 89.90, '2024-09-20', 'M', 'image7.png'),
(116, 'Camiseta Azul Marino', 'Camiseta ajustada de color azul marino para entrenamiento funcional.', 1, 85.00, '2024-09-20', 'M', 'image8.png'),
(117, 'Camiseta Gris Oversized', 'Camiseta gris de estilo oversized para un look relajado y moderno.', 1, 65.90, '2024-09-20', 'M', 'image9.png'),
(118, 'Top Deportivo Blanco', 'Top deportivo blanco, ideal para sesiones de entrenamiento intensas.', 2, 39.99, '2024-09-20', 'F', 'flaca1.png'),
(119, 'Conjunto Deportivo Negro', 'Conjunto deportivo negro de manga larga y pantalones, perfecto para yoga o correr.', 2, 59.99, '2024-09-20', 'F', 'flaca2.png'),
(120, 'Sudadera Negra', 'Sudadera negra ajustada para mantener el estilo durante el entrenamiento.', 2, 49.99, '2024-09-20', 'F', 'flaca3.png'),
(121, 'Pantalones Deportivos Negros', 'Pantalones deportivos negros con ajuste cómodo y flexible.', 2, 45.99, '2024-09-20', 'F', 'flaca4.jpg'),
(122, 'Top Deportivo Negro', 'Top deportivo negro, diseñado para ofrecer soporte y comodidad.', 2, 34.99, '2024-09-20', 'F', 'flaca5.jpg'),
(123, 'Pantalones Deportivos Sueltos', 'Pantalones deportivos sueltos, ideales para entrenamientos o uso casual.', 2, 54.99, '2024-09-20', 'F', 'flaca6.jpg'),
(124, 'Conjunto Beige Casual', 'Conjunto casual beige, perfecto para el uso diario o actividades ligeras.', 2, 69.99, '2024-09-20', 'F', 'flaca7.png'),
(125, 'Conjunto Deportivo Beige', 'Conjunto deportivo beige con un diseño moderno y cómodo.', 2, 64.99, '2024-09-20', 'F', 'flaca8.png'),
(126, 'Conjunto Deportivo Blanco', 'Conjunto deportivo blanco, perfecto para actividades físicas o relajación.', 2, 59.99, '2024-09-20', 'F', 'flaca9.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_variantes`
--

CREATE TABLE `producto_variantes` (
  `IdVariante` int(11) NOT NULL,
  `IdProducto` int(11) NOT NULL,
  `Talla` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Color` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto_variantes`
--

INSERT INTO `producto_variantes` (`IdVariante`, `IdProducto`, `Talla`, `Color`, `Stock`) VALUES
(1, 100, 'M', 'Negro', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `IdRol` int(11) NOT NULL,
  `Nombre` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`IdRol`, `Nombre`) VALUES
(1, 'admin'),
(2, 'cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolmenu`
--

CREATE TABLE `rolmenu` (
  `IdRolMenu` int(11) NOT NULL,
  `IdRol` int(11) NOT NULL,
  `IdMenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rolmenu`
--

INSERT INTO `rolmenu` (`IdRolMenu`, `IdRol`, `IdMenu`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

CREATE TABLE `tipopago` (
  `IdTipoPago` int(11) NOT NULL,
  `Tipo` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipopago`
--

INSERT INTO `tipopago` (`IdTipoPago`, `Tipo`) VALUES
(1, 'Tarjeta de Crédito'),
(2, 'Efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL,
  `NombreUsuario` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CorreoElectronico` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Contrasena` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `IdRol` int(11) NOT NULL,
  `Intentos` int(11) DEFAULT 3,
  `Bloqueado` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`IdUsuario`, `NombreUsuario`, `CorreoElectronico`, `Contrasena`, `IdRol`, `Intentos`, `Bloqueado`) VALUES
(10, 'gerson1', 'dasda@adasd', '$2y$10$.r2IY42tx1cuomeDlBDsp..Jhv2/DP2LBfufjEFYcRc8ga3eMzW8C', 1, 0, b'1'),
(19, 'dan41', 'trolazo@gmail.com', '$2y$10$9kyLbWoiVl5SclI1Jwim/Oq61MAETlG.98EJN3gam8NjG2CwGomMO', 2, 3, b'0'),
(21, 'danonino', 'Trolazo@gmail.com', '$2y$10$mZQTE35h5TO0YsMgo79VtenxBmeXmZGM7n2f11BQS2cWz35WRvEQ2', 1, 3, b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `IdVenta` int(11) NOT NULL,
  `IdPedido` int(11) NOT NULL,
  `FechaVenta` date NOT NULL DEFAULT curdate(),
  `IGV` decimal(10,2) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Descuento` decimal(10,2) DEFAULT NULL,
  `IdTipoPago` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`IdVenta`, `IdPedido`, `FechaVenta`, `IGV`, `Total`, `Descuento`, `IdTipoPago`) VALUES
(3, 7, '2024-07-02', 10.00, 860.20, 18.00, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`IdCliente`),
  ADD KEY `IdUsuario` (`IdUsuario`);

--
-- Indices de la tabla `cupondescuento`
--
ALTER TABLE `cupondescuento`
  ADD PRIMARY KEY (`IdCuponDescuento`),
  ADD UNIQUE KEY `Codigo` (`Codigo`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD PRIMARY KEY (`IdDetallePedido`),
  ADD KEY `IdPedido` (`IdPedido`),
  ADD KEY `IdProducto` (`IdProducto`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`IdDireccion`),
  ADD KEY `IdCliente` (`IdCliente`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`IdMenu`);

--
-- Indices de la tabla `opinionproducto`
--
ALTER TABLE `opinionproducto`
  ADD PRIMARY KEY (`IdOpinionProducto`),
  ADD KEY `IdProducto` (`IdProducto`),
  ADD KEY `IdCliente` (`IdCliente`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`IdPedido`),
  ADD KEY `IdCliente` (`IdCliente`),
  ADD KEY `IdCuponDescuento` (`IdCuponDescuento`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`IdProducto`),
  ADD KEY `IdCategoria` (`IdCategoria`);

--
-- Indices de la tabla `producto_variantes`
--
ALTER TABLE `producto_variantes`
  ADD PRIMARY KEY (`IdVariante`),
  ADD KEY `IdProducto` (`IdProducto`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `rolmenu`
--
ALTER TABLE `rolmenu`
  ADD PRIMARY KEY (`IdRolMenu`),
  ADD KEY `IdRol` (`IdRol`),
  ADD KEY `IdMenu` (`IdMenu`);

--
-- Indices de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  ADD PRIMARY KEY (`IdTipoPago`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `IdRol` (`IdRol`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`IdVenta`),
  ADD KEY `IdPedido` (`IdPedido`),
  ADD KEY `IdTipoPago` (`IdTipoPago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `IdCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `cupondescuento`
--
ALTER TABLE `cupondescuento`
  MODIFY `IdCuponDescuento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  MODIFY `IdDetallePedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `IdDireccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `IdMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT de la tabla `producto_variantes`
--
ALTER TABLE `producto_variantes`
  MODIFY `IdVariante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `IdRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rolmenu`
--
ALTER TABLE `rolmenu`
  MODIFY `IdRolMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  MODIFY `IdTipoPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `IdVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
  ADD CONSTRAINT `detallepedido_ibfk_1` FOREIGN KEY (`IdPedido`) REFERENCES `pedido` (`IdPedido`) ON DELETE CASCADE,
  ADD CONSTRAINT `detallepedido_ibfk_2` FOREIGN KEY (`IdProducto`) REFERENCES `producto` (`IdProducto`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
