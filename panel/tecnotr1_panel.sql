-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2020 a las 07:26:56
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.3.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecnotr1_panel`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarCliente` (IN `name_cliente` VARCHAR(100), IN `razon_cliente` VARCHAR(100), IN `rfc_cliente` VARCHAR(30), IN `sucursal` VARCHAR(100), IN `contactos` JSON)  BEGIN
	DECLARE lastId INT DEFAULT 0;
	DECLARE lastIdSucursal INT DEFAULT 0;
	DECLARE indexContactos INT DEFAULT 0;
	
	START TRANSACTION;
	
		INSERT INTO clientes
		(
			name,
			razon_social,
			rfc
		)
		VALUES
		(
			name_cliente,
			razon_cliente,
			rfc_cliente
		);
		
		SET lastId = LAST_INSERT_ID();
		
		insert into clientes_sucursales
		(
			id_clientes,
			nombre
		)
		values
		(
			lastId,
			sucursal
		);
		
		SET lastIdSucursal = last_insert_id();
		
		WHILE indexContactos < JSON_LENGTH(contactos) DO
			INSERT INTO clientes_detalle
			(
				id_clientes,
				nombre,
				correo,
				telefono,
				id_sucursal
			)
			VALUES
			(
				lastId,
				json_unquote(JSON_EXTRACT( contactos , CONCAT('$[', indexContactos, '].name'))),
				json_unquote(JSON_EXTRACT( contactos , CONCAT('$[', indexContactos, '].email'))),
				json_unquote(JSON_EXTRACT( contactos , CONCAT('$[', indexContactos, '].telefono'))),
				lastIdSucursal
			);
			SET indexContactos = indexContactos + 1;
		END WHILE;
	COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarContactos` (IN `id_cliente` INT, IN `id_sucursal` INT, IN `contactos` JSON)  BEGIN
	DECLARE indexContactos INT DEFAULT 0;
		
	WHILE indexContactos < JSON_LENGTH(contactos) DO
		INSERT INTO clientes_detalle
		(
			id_clientes,
			nombre,
			correo,
			telefono,
			id_sucursal
		)
		VALUES
		(
			id_cliente,
			JSON_UNQUOTE(JSON_EXTRACT( contactos , CONCAT('$[', indexContactos, '].name'))),
			JSON_UNQUOTE(JSON_EXTRACT( contactos , CONCAT('$[', indexContactos, '].email'))),
			JSON_UNQUOTE(JSON_EXTRACT( contactos , CONCAT('$[', indexContactos, '].telefono'))),
			id_sucursal
		);
		SET indexContactos = indexContactos + 1;
	END WHILE;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spGuardarCotizacion` (IN `id_client` INT, IN `id_user` INT, IN `items` JSON, IN `id_status` INT)  BEGIN
	DECLARE lastId int DEFAULT 0;
	DECLARE jsonIndex INT DEFAULT 0;
	
	start transaction;
	
		insert into cotizaciones
		(
			fk_id_client, 
			fk_id_user,
			fk_id_status
		)
		values
		(
			id_client,
			id_user,
			id_status
		);
		
		set lastId = LAST_INSERT_ID();
		
		WHILE jsonIndex < JSON_LENGTH(items) DO
			INSERT INTO cotizaciones_items
			(
				fk_id_cotizacion,
				fk_id_producto,
				quantity,
				utility,
				cost
			)
			values
			(
				lastId,
				JSON_EXTRACT( items , concat('$[', jsonIndex, '].id')),
				JSON_EXTRACT( items , CONCAT('$[', jsonIndex, '].quantity')),
				JSON_EXTRACT( items , CONCAT('$[', jsonIndex, '].utility')),
				JSON_EXTRACT( items , CONCAT('$[', jsonIndex, '].cost'))
			);
			SET jsonIndex = jsonIndex + 1;
		end while;
	commit;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `spObtenerCotizaciones` (IN `start_date` DATETIME, IN `end_date` DATETIME, IN `id_cotization` INT, IN `id_client` INT, IN `id_user` INT, IN `id_status` INT)  begin
	SET SESSION group_concat_max_len = 1000000;
	if id_cotization is not null then
		set start_date = null;
		set end_date = null;
	end if;
	
	SELECT
		cotz.id,
		ct.id as id_cliente,
		ct.name,
		cotz.creation_date,
		(
			SELECT CONCAT(
				'[', 
				GROUP_CONCAT(
					JSON_OBJECT(
						'idProduct', cotit.fk_id_producto,
						'quantity', cotit.quantity,
						'code', pro.code,
						'description', pro.description,
						'costo', cotit.cost,
						'percentUtilidad', cotit.utility,
						'utilidad', ((cotit.cost / 100)* cotit.utility),
						'precio', ((cotit.cost / 100) * cotit.utility) + cotit.cost,
						'total', (((cotit.cost / 100) * cotit.utility) + cotit.cost) * cotit.quantity
					)
				), 
				']'
			) 
			FROM cotizaciones_items AS cotit 
			INNER JOIN productos AS pro
				ON cotit.fk_id_producto = pro.id
			WHERE 1=1
				AND cotit.fk_id_cotizacion = cotz.id
		)AS items,
		(
			SELECT 
				SUM((((cotit.cost / 100)* cotit.utility) + cotit.cost) * cotit.quantity) AS total
			FROM cotizaciones_items AS cotit 
			WHERE 1=1
				AND cotit.fk_id_cotizacion = cotz.id
		) AS total,
		sts.status_name,
		usr.usuario,
		usr.nombre_usuario,
		usr.apellido_usuario
	FROM cotizaciones AS cotz
	INNER JOIN clientes AS ct
		ON cotz.fk_id_client = ct.id
	INNER JOIN cotizacion_status AS sts
		ON cotz.fk_id_status = sts.id
	INNER JOIN usuarios AS usr
		ON cotz.fk_id_user = usr.id_usuario
	where 1=1
	AND 
	(
		cotz.creation_date BETWEEN start_date AND end_date
		or
		(start_date is null and end_date is null)
	)
	and cotz.id = coalesce(id_cotization, cotz.id)
	and cotz.fk_id_user = coalesce(id_user, cotz.fk_id_user)
	and cotz.fk_id_client = coalesce(id_client, cotz.fk_id_client)
	and cotz.fk_id_status = coalesce(id_status, cotz.fk_id_status)
	order by cotz.creation_date desc;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `rfc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `name`, `razon_social`, `rfc`) VALUES
(1, 'DNJ Instalaciones y Construcciones', '', ''),
(2, 'Desarrolladora Sackim', '', ''),
(3, 'Movimiento de Tierra y Maquinaria Quintana Roo', '', ''),
(4, 'sass', '', ''),
(5, 'luis ramirez', '', ''),
(6, 'yepez', '', ''),
(7, 'hoteles del sur', 'hoteles y hospedaje del sur', 'hds911294'),
(8, 'hoteles del sur', 'hoteles y hospedaje del norte', 'hds911294'),
(9, 'hoteles del sur', 'hoteles y hospedaje del este', 'hds911294'),
(10, 'bachoco', 'bac123456', 'sdfgh'),
(11, 'cliente test', 'qwerty', '123456'),
(12, 'empresa de prueba 123', 'qwerty', '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_detalle`
--

CREATE TABLE `clientes_detalle` (
  `id` int(10) NOT NULL,
  `id_clientes` int(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `id_sucursal` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes_detalle`
--

INSERT INTO `clientes_detalle` (`id`, `id_clientes`, `nombre`, `correo`, `telefono`, `id_sucursal`) VALUES
(1, 7, '\"andes castillo\"', '\"andes@hoteles.com\"', '\"1326324\"', 1),
(2, 7, '\"jose perez\"', '\"jose@hoteles.com\"', '\"9876543\"', 1),
(3, 8, '\"andea castillo\"', '\"andea@hoteles.com\"', '\"1326324\"', 2),
(4, 8, '\"josefa perez\"', '\"josefa@hoteles.com\"', '\"9876543\"', 2),
(5, 9, 'ana castillo', 'andea@hoteles.com', '1326324', 3),
(6, 9, 'pedro perez', 'josefa@hoteles.com', '9876543', 3),
(7, 8, 'jesus', 'jesus@jesus.com', '1234', 5),
(8, 8, 'antonio', 'antonio@antonio.com', '54678', 5),
(9, 10, 'jpse', 'daeside123@gmail.com', '45678', 6),
(10, 10, 'andres barros', 'lramirez77517@gmail.com', '65432', 6),
(11, 11, 'luis ramirez', 'daeside123@gmail.com', '9981326324', 7),
(12, 12, 'luis ramirez', 'daeside123@gmail.com', '123456', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_sucursales`
--

CREATE TABLE `clientes_sucursales` (
  `id` int(10) NOT NULL,
  `id_clientes` int(10) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes_sucursales`
--

INSERT INTO `clientes_sucursales` (`id`, `id_clientes`, `nombre`) VALUES
(1, 7, 'cancun'),
(2, 8, 'cancun'),
(3, 9, 'cancun'),
(4, 0, 'xel ha'),
(5, 8, 'monterrey'),
(6, 10, 'cancun'),
(7, 11, 'cancun'),
(8, 12, 'cancun zh');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id` int(10) NOT NULL,
  `fk_id_client` int(10) DEFAULT NULL,
  `creation_date` datetime DEFAULT current_timestamp(),
  `fk_id_user` int(10) DEFAULT NULL,
  `fk_id_status` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cotizaciones`
--

INSERT INTO `cotizaciones` (`id`, `fk_id_client`, `creation_date`, `fk_id_user`, `fk_id_status`) VALUES
(1, 3, '2020-06-15 12:13:00', 3, 1),
(2, 2, '2020-06-15 12:14:48', 3, 1),
(3, 1, '2020-06-15 12:22:12', 3, 1),
(4, 1, '2020-06-15 12:24:43', 3, 1),
(5, 1, '2020-06-15 14:55:22', 3, 1),
(6, 3, '2020-06-16 03:18:00', 3, 1),
(7, 1, '2020-06-16 11:05:20', 3, 1),
(8, 1, '2020-06-16 16:16:33', 3, 1),
(9, 3, '2020-06-17 13:07:04', 3, 1),
(10, 1, '2020-06-17 16:15:40', 3, 1),
(11, 1, '2020-06-17 16:15:40', 3, 1),
(12, 5, '2020-06-18 00:12:50', 3, 1),
(13, 6, '2020-06-18 11:12:49', 3, 1),
(14, 9, '2020-06-20 20:25:37', 3, 1),
(15, 10, '2020-06-21 02:23:38', 3, 2),
(16, 3, '2020-06-22 19:26:37', 3, 1),
(17, 9, '2020-06-22 22:30:13', 3, 2),
(18, 11, '2020-06-24 15:58:15', 3, 2),
(19, 3, '2020-06-25 10:01:48', 3, 1),
(20, 10, '2020-06-25 22:52:49', 3, 2),
(21, 6, '2020-06-29 21:10:54', 3, 1),
(22, 12, '2020-06-29 21:18:53', 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones_items`
--

CREATE TABLE `cotizaciones_items` (
  `fk_id_cotizacion` int(10) NOT NULL,
  `fk_id_producto` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `utility` decimal(8,2) NOT NULL,
  `cost` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cotizaciones_items`
--

INSERT INTO `cotizaciones_items` (`fk_id_cotizacion`, `fk_id_producto`, `quantity`, `utility`, `cost`) VALUES
(1, 1, 2, '0.00', '0.00'),
(1, 3, 4, '0.00', '0.00'),
(1, 5, 1, '0.00', '0.00'),
(2, 1, 2, '0.00', '0.00'),
(2, 4, 1, '0.00', '0.00'),
(3, 2, 20, '0.00', '0.00'),
(3, 4, 30, '0.00', '0.00'),
(4, 2, 20, '0.00', '0.00'),
(4, 4, 30, '0.00', '0.00'),
(5, 5, 2, '0.00', '0.00'),
(6, 1, 1, '0.00', '0.00'),
(6, 4, 2, '0.00', '0.00'),
(6, 5, 3, '0.00', '0.00'),
(7, 1, 2, '0.00', '0.00'),
(7, 3, 3, '0.00', '0.00'),
(8, 1, 3, '0.00', '0.00'),
(9, 1, 3, '0.00', '0.00'),
(9, 4, 2, '0.00', '0.00'),
(9, 3, 1, '0.00', '0.00'),
(9, 5, 2, '0.00', '0.00'),
(10, 1, 3, '0.00', '0.00'),
(10, 3, 5, '0.00', '0.00'),
(11, 1, 3, '0.00', '0.00'),
(11, 3, 5, '0.00', '0.00'),
(12, 1, 3, '0.00', '0.00'),
(12, 4, 2, '0.00', '0.00'),
(12, 3, 2, '0.00', '0.00'),
(12, 5, 1, '0.00', '0.00'),
(13, 4, 3, '0.00', '0.00'),
(13, 3, 1, '0.00', '0.00'),
(14, 1, 2, '0.00', '0.00'),
(14, 5, 1, '0.00', '0.00'),
(15, 1, 3, '0.00', '0.00'),
(15, 4, 1, '0.00', '0.00'),
(15, 2, 2, '0.00', '0.00'),
(16, 1, 2, '0.00', '0.00'),
(16, 5, 3, '0.00', '0.00'),
(17, 1, 5, '0.00', '0.00'),
(17, 4, 4, '0.00', '0.00'),
(17, 3, 3, '0.00', '0.00'),
(17, 2, 2, '0.00', '0.00'),
(17, 5, 1, '0.00', '0.00'),
(18, 5, 2, '0.00', '0.00'),
(18, 1, 3, '0.00', '0.00'),
(18, 3, 1, '0.00', '0.00'),
(19, 13, 2, '40.00', '300.00'),
(19, 2, 3, '30.00', '500.00'),
(19, 11, 1, '10.00', '200.00'),
(20, 13, 2, '40.00', '300.00'),
(20, 5, 3, '35.00', '400.00'),
(20, 2, 2, '45.00', '500.00'),
(21, 14, 2, '50.00', '500.00'),
(21, 5, 1, '45.00', '500.00'),
(22, 5, 2, '30.00', '200.00'),
(22, 3, 3, '35.00', '100.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion_status`
--

CREATE TABLE `cotizacion_status` (
  `id` int(10) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cotizacion_status`
--

INSERT INTO `cotizacion_status` (`id`, `status_name`) VALUES
(1, 'CAPTURADA'),
(2, 'ENVIADA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) NOT NULL,
  `code` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `code`, `description`) VALUES
(1, 'TT-CG78A', 'Consumible Generico Tóner 78A'),
(2, 'TT-SSD480', 'Disco Duro de Estado Solido SSD 480 GB'),
(3, 'TT-SSD240', 'Disco Duro de Estado Solido SSD 240 GB'),
(4, 'TT-SSD120', 'Disco Duro de Estado Solido SSD 120 GB'),
(5, 'TT-KA16LP', 'Kit Actualizacion Memoria RAM 16 GB Gaming (2 Memorias DDR4 8 GB LP)'),
(6, 'qwerty', ''),
(7, 'uyu', ''),
(8, 'zxcvbn', ''),
(9, 'uyu', ''),
(10, 'uyu2', ''),
(11, 'uyu', 'impresora hp'),
(12, 'test13', 'un producto bueno'),
(13, 'test34', 'cartuchos de impresion color'),
(14, 'qwerty1234', 'cartuchos de impresion color');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `pass_usuario` varchar(250) NOT NULL,
  `nombre_usuario` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido_usuario` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `correo_usuario` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_usuario` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `alta_usuario` date NOT NULL,
  `baja_usuario` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `pass_usuario`, `nombre_usuario`, `apellido_usuario`, `correo_usuario`, `tipo_usuario`, `alta_usuario`, `baja_usuario`) VALUES
(1, 'jyepz', 'e10adc3949ba59abbe56e057f20f883e', 'Jesus', 'Yepez', 'yepez@tecnotronik.com', 'ING', '2019-07-14', '0000-00-00'),
(2, 'rbnsanchez', '161995c4a6df5471f879307fc8c4c233', 'Ruben', 'Gomez', 'ruben@tecnotronik.com', 'ING', '2019-09-09', '0000-00-00'),
(3, 'lramirez', '', 'Luis', 'Ramirez', '', '', '0000-00-00', '0000-00-00'),
(4, 'aperez', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'andres', 'perez', 'andres@andres.com', 'VEND', '0000-00-00', '0000-00-00'),
(5, 'jramirez', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'josue', 'ramirez', 'josue@josue.com', 'VEND', '2020-06-21', '0000-00-00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes_detalle`
--
ALTER TABLE `clientes_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes_sucursales`
--
ALTER TABLE `clientes_sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_user` (`fk_id_user`),
  ADD KEY `fk_id_status` (`fk_id_status`),
  ADD KEY `fk_id_client` (`fk_id_client`);

--
-- Indices de la tabla `cotizacion_status`
--
ALTER TABLE `cotizacion_status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `clientes_detalle`
--
ALTER TABLE `clientes_detalle`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `clientes_sucursales`
--
ALTER TABLE `clientes_sucursales`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `cotizacion_status`
--
ALTER TABLE `cotizacion_status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD CONSTRAINT `cotizaciones_ibfk_1` FOREIGN KEY (`fk_id_user`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `cotizaciones_ibfk_2` FOREIGN KEY (`fk_id_status`) REFERENCES `cotizacion_status` (`id`),
  ADD CONSTRAINT `cotizaciones_ibfk_3` FOREIGN KEY (`fk_id_client`) REFERENCES `clientes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
