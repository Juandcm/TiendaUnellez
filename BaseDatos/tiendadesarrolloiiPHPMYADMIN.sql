-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-10-2018 a las 22:00:10
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendadesarrolloii`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `com_iden` int(11) NOT NULL,
  `usu_comp` int(11) NOT NULL,
  `usu_vent` int(11) NOT NULL,
  `inv_comp` int(11) NOT NULL,
  `com_prec` float DEFAULT NULL,
  `com_fech` datetime DEFAULT NULL,
  `com_cant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `inv_iden` int(11) NOT NULL,
  `usu_iden` int(11) NOT NULL,
  `inv_nomb` varchar(150) NOT NULL,
  `inv_desc` text,
  `inv_prec` float NOT NULL,
  `inv_fech` datetime DEFAULT NULL,
  `inv_foto` text,
  `inv_cant` int(11) DEFAULT NULL,
  `inv_esta` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`inv_iden`, `usu_iden`, `inv_nomb`, `inv_desc`, `inv_prec`, `inv_fech`, `inv_foto`, `inv_cant`, `inv_esta`) VALUES
(11, 7, 'Computador Dell Core 2', 'PRECIO PUBLICADO CORRESPONDE A PROCESADOR 2.4GHz.  !!!!!DISPONEMOS DE PROCESADOR 3.0 GHz!!!!!', 9.913, '2018-10-12 15:45:18', 'eedad8f3-335b-44c5-b180-0d0c879176ac/1.jpg', 12, '1'),
(12, 7, 'Blu R2, 1 Gb, 8 Gb, Lector De Huella, 8 Mp Doble Flash ', 'BLU R2 Características principales Android 7.0 es el sistema operativo del BLU R2 , que en cuanto a dimensiones tiene un perfil de 9.6 mm y un peso de 156 g. En cuanto a sus características técnicas, el BLU R2 tiene una pantalla de 5.2&quot; con una resolución de 720 x 1280 pixels. Dentro del BLU R2 encontramos un procesador Mediatek MT6580 1.3GHz, acompañado de 1GB de memoria RAM. También cuenta con 8GB de almacenamiento y la memoria interna puede ser ampliada vía microSD . La cámara trasera del BLU R2 tiene una resolución de 8 MP con captura de video , y la energía es provista por una batería de 3000 mAh .El BLU R2 también tiene Radio FM .  Pantalla 5.2&quot;, 720 x 1280 pixels Procesador Mediatek MT6580 1.3GHz 1GB RAM 8GB, microSD Cámara: 8 MP y 8 MP OS: Android 7.0 Perfil: 9.6 mm Peso: 156 g   LA CAJA INCLUYE , FORRO, LAMINA PROTECTORA, CABLE USB, Y CARGADOR. (FOTO 2)', 13.499, '2018-10-12 15:49:30', '2dcec6eb-2923-49d7-a14a-790552b54471/2.jpg', 72, '1'),
(13, 7, 'Teclado Usb Imexx Español Estandar Laptop Pc Oferta ', 'TECLADO CONEXIÓN USB MARCA IMEXX DISPONIBLE SOLO EN COLOR NEGRO ---- IDIOMA ESPAÑOL COMPATIBLE CON TODAS LAS VERSIONES DE WINDOWS Y MAC Inclinación conveniente para máximo confort al escribir. Ciclo de vida de cada tecla con 10.000.000 de pulsaciones.  MEDIDAS: 44 cm largo x 14 cm ancho', 750, '2018-10-12 15:50:54', 'e82dbf4a-b5bc-4018-9f62-c959ae3f31b8/3.jpg', 2223, '1'),
(14, 7, 'Memoria Ram Ddr3 4gb Hyper Fury 1600 ', 'Memoria Ram Ddr3 4gb Hyper Fury 1600 para pc', 5, '2018-10-12 15:51:47', 'a0d7a235-edef-485e-8d84-50634bb7d3b5/4.jpg', 4, '1'),
(15, 7, 'Tarjeta De Video Nvidia Geforce Gt 710 1gb Ddr3 Pci-e Hdmi', 'NVIDIA TECHNOLOGY 1GB DDR3 PUERTO PCI-EXPRESS 2.0 SOPORTE PARA DUAL LINK DVI - HDMI - VGA NVIDIA 3D VISION OPEN GL 4.5 SUPPORT OPEN CL SUPPORT COMPATIBLE CON WINDOWS 10, 8, 7, VISTA O XP', 8.965, '2018-10-12 15:53:23', '182197cf-484a-4cb9-9bbc-3b3991be6931/5.jpg', 33, '0'),
(16, 7, 'Fuente De Poder Delux 550w 20/24 Pines 30a 550 Watts Atx ', 'MARCA DELUX Potencia : 550w 1 conector 20+4pines ATX para tarjeta madre 1 conector 4 pines ATX de 12v 2 conector serial Sata 2 conector 4 pines LPE para Drivers IDE 1 conector 4 pines sp4 para floppy (unidad de cd , afines)', 1.904, '2018-10-12 15:54:25', '4c5372b7-5ff9-4325-83a9-7010e4b46b33/6.jpg', 45, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametro`
--

CREATE TABLE `parametro` (
  `par_iden` int(11) NOT NULL,
  `par_tipo` varchar(45) DEFAULT NULL,
  `parprueba` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_iden` int(11) NOT NULL,
  `usu_nomb` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `usu_apel` varchar(50) NOT NULL,
  `usu_corr` varchar(50) NOT NULL,
  `usu_cont` varchar(60) NOT NULL,
  `usu_tele` int(11) DEFAULT NULL,
  `usu_foto` text,
  `usu_fech` datetime DEFAULT NULL,
  `usu_perm` enum('0','1') NOT NULL DEFAULT '0',
  `usu_esta` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_iden`, `usu_nomb`, `usu_apel`, `usu_corr`, `usu_cont`, `usu_tele`, `usu_foto`, `usu_fech`, `usu_perm`, `usu_esta`) VALUES
(7, 'JUAN', 'COLMENARES', '97juandcm11@gmail.com', '$2y$12$s0wrhunJf3R/uQbhPyTCGO4g0fG3AP0LROAu4.kMS6qiAFrUgRDa2', 2147483647, '78b640db-6340-4d1a-887f-89f6ac2fa77b/avatar5.png', '2018-10-12 15:41:30', '0', '1'),
(8, 'Administrador', 'especial', 'admin@admin.com', '$2y$12$fJphvwtc52VOtHGBe8bgQuJURDq6NXIrGcCQ5y1cYvO59sbDJGTLy', 3278, 'user-default.jpg', '2018-10-12 15:55:52', '1', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `ven_iden` int(11) NOT NULL,
  `usu_vent` int(11) NOT NULL,
  `usu_comp` int(11) NOT NULL,
  `inv_vent` int(11) NOT NULL,
  `ven_prec` float NOT NULL,
  `ven_fech` datetime NOT NULL,
  `ven_cant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`com_iden`),
  ADD KEY `fk_COMPRA_USUARIO1_idx` (`usu_comp`),
  ADD KEY `fk_COMPRA_INVENTARIO1_idx` (`inv_comp`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`inv_iden`),
  ADD KEY `fk_INVENTARIO_USUARIO1_idx` (`usu_iden`);

--
-- Indices de la tabla `parametro`
--
ALTER TABLE `parametro`
  ADD PRIMARY KEY (`par_iden`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_iden`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`ven_iden`),
  ADD KEY `fk_COMPFRA_INVENTARIO1_idx` (`inv_vent`),
  ADD KEY `fk_COMPFRA_USUARIO1_idx` (`usu_vent`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `com_iden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `inv_iden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `parametro`
--
ALTER TABLE `parametro`
  MODIFY `par_iden` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_iden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `ven_iden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `fk_COMPRA_INVENTARIO1` FOREIGN KEY (`inv_comp`) REFERENCES `inventario` (`inv_iden`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_COMPRA_USUARIO1` FOREIGN KEY (`usu_comp`) REFERENCES `usuario` (`usu_iden`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD CONSTRAINT `fk_INVENTARIO_USUARIO1` FOREIGN KEY (`usu_iden`) REFERENCES `usuario` (`usu_iden`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_COMPFRA_INVENTARIO1` FOREIGN KEY (`inv_vent`) REFERENCES `inventario` (`inv_iden`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_COMPFRA_USUARIO1` FOREIGN KEY (`usu_vent`) REFERENCES `usuario` (`usu_iden`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
