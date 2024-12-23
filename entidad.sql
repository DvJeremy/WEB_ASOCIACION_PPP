-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-12-2024 a las 03:06:28
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `entidad`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiarios`
--

CREATE TABLE `beneficiarios` (
  `dni_beneficiario` int(11) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellido_paterno` varchar(50) DEFAULT NULL,
  `apellido_materno` varchar(50) DEFAULT NULL,
  `relacion` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `dni_socio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `beneficiarios`
--

INSERT INTO `beneficiarios` (`dni_beneficiario`, `nombres`, `apellido_paterno`, `apellido_materno`, `relacion`, `fecha_nacimiento`, `dni_socio`) VALUES
(30001, 'Laura', 'Gutierrez', '500.00', NULL, NULL, 10001),
(30002, 'Javier', 'Diaz', '700.00', NULL, NULL, 10002),
(30003, 'Andrea', 'Rojas', '600.00', NULL, NULL, 10003),
(30004, 'Pablo', 'Castro', '800.00', NULL, NULL, 10004),
(30005, 'Carolina', 'Morales', '400.00', NULL, NULL, 10005);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuota_afiliacion`
--

CREATE TABLE `cuota_afiliacion` (
  `id_pago` int(11) NOT NULL,
  `fecha_pago` date DEFAULT NULL,
  `dni_socio` int(11) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuota_afiliacion`
--

INSERT INTO `cuota_afiliacion` (`id_pago`, `fecha_pago`, `dni_socio`, `monto`) VALUES
(1, '2023-01-10', 10001, 20.00),
(2, '2023-02-15', 10002, 20.00),
(3, '2023-03-20', 10003, 20.00),
(4, '2023-04-25', 10004, 40.00),
(5, '2023-05-30', 10005, 20.00),
(6, '2024-12-03', 10001, 40.00),
(7, '2024-12-03', 10002, 20.00),
(8, '2024-12-03', 10001, 20.00),
(9, '2024-12-03', 10004, 40.00),
(10, '2024-12-03', 10005, 20.00),
(11, '2024-12-03', 10002, 40.00),
(12, '2024-12-03', 10001, 20.00),
(13, '2024-12-03', 10004, 40.00),
(14, '2024-12-03', 10005, 20.00),
(15, '2024-12-03', 10004, 40.00),
(16, '2024-12-03', 10005, 20.00),
(17, '2024-12-03', 10001, 20.00),
(18, '2024-12-03', 10001, 20.00),
(19, '2024-12-03', 10005, 40.00),
(20, '2024-12-05', 10001, 20.00),
(21, '2024-12-05', 10004, 40.00),
(22, '2024-12-05', 10005, 20.00),
(23, '2024-12-05', 10002, 40.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiares`
--

CREATE TABLE `familiares` (
  `dni_familiar` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL DEFAULT '0',
  `apellidos` varchar(50) NOT NULL DEFAULT '0',
  `estado_familiar` varchar(50) NOT NULL DEFAULT '',
  `fecha_nacimiento` date NOT NULL,
  `relacion` varchar(50) NOT NULL DEFAULT '0',
  `dni_socio` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `garantes`
--

CREATE TABLE `garantes` (
  `dni_garante` int(11) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `garantes`
--

INSERT INTO `garantes` (`dni_garante`, `nombres`, `apellidos`) VALUES
(20001, 'Pedro', 'Ramirez'),
(20002, 'Sofia', 'Martinez'),
(20003, 'Ricardo', 'Gomez'),
(20004, 'Lucia', 'Hernandez'),
(20005, 'Miguel', 'Vargas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `informacion_prestamo`
--

CREATE TABLE `informacion_prestamo` (
  `id_cuota` varchar(50) NOT NULL,
  `n°_cuota` int(11) DEFAULT NULL,
  `saldo_inicial` decimal(10,2) DEFAULT NULL,
  `saldo_final` decimal(10,2) DEFAULT NULL,
  `estado_cuota` varchar(50) DEFAULT NULL,
  `fecha_cobro` date DEFAULT NULL,
  `id_prestamo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `informacion_prestamo`
--

INSERT INTO `informacion_prestamo` (`id_cuota`, `n°_cuota`, `saldo_inicial`, `saldo_final`, `estado_cuota`, `fecha_cobro`, `id_prestamo`) VALUES
('1-1', 1, 10000.00, 6666.67, 'pendiente', NULL, 1),
('1-2', 2, 6666.67, 3333.33, 'pendiente', NULL, 1),
('1-3', 3, 3333.33, 0.00, 'pendiente', NULL, 1),
('11-1', 1, 10000.00, 4900.00, 'pendiente', NULL, 11),
('11-2', 2, 4900.00, -200.00, 'pendiente', NULL, 11),
('12-1', 1, 10000.00, 5000.00, 'pendiente', NULL, 12),
('12-2', 2, 5000.00, 0.00, 'pendiente', NULL, 12),
('2-1', 1, 15000.00, 11250.00, 'abonada', '2024-10-09', 2),
('2-2', 2, 11250.00, 7500.00, 'pendiente', NULL, 2),
('2-3', 3, 7500.00, 3750.00, 'pendiente', NULL, 2),
('2-4', 4, 3750.00, 0.00, 'pendiente', NULL, 2),
('3-1', 1, 20000.00, 16000.00, 'pendiente', NULL, 3),
('3-2', 2, 16000.00, 12000.00, 'pendiente', NULL, 3),
('3-3', 3, 12000.00, 8000.00, 'pendiente', NULL, 3),
('3-4', 4, 8000.00, 4000.00, 'pendiente', NULL, 3),
('3-5', 5, 4000.00, 0.00, 'pendiente', NULL, 3),
('4-1', 1, 25000.00, 16666.67, 'abonada', '2024-10-09', 4),
('4-2', 2, 16666.67, 8333.33, 'abonada', '2024-11-09', 4),
('4-3', 3, 8333.33, 0.00, 'abonada', '2024-12-09', 4),
('5-1', 1, 12000.00, 9000.00, 'pendiente', NULL, 5),
('5-2', 2, 9000.00, 6000.00, 'pendiente', NULL, 5),
('5-3', 3, 6000.00, 3000.00, 'pendiente', NULL, 5),
('5-4', 4, 3000.00, 0.00, 'pendiente', NULL, 5),
('6-1', 1, 4000.00, 2000.00, 'abonada', '2024-11-09', 6),
('6-2', 2, 2000.00, 0.00, 'abonada', '2024-12-09', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id_prestamo` int(11) NOT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `cuotas` int(11) NOT NULL,
  `cuota_mensual` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tasa` decimal(10,2) DEFAULT NULL,
  `interes` decimal(10,2) DEFAULT NULL,
  `amortizacion` decimal(10,2) DEFAULT NULL,
  `estado_prestamo` varchar(50) DEFAULT NULL,
  `fecha_finalizacion` date DEFAULT NULL,
  `dni_socio` int(11) DEFAULT NULL,
  `dni_garante1` int(11) DEFAULT NULL,
  `dni_garante2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id_prestamo`, `monto`, `fecha_emision`, `cuotas`, `cuota_mensual`, `tasa`, `interes`, `amortizacion`, `estado_prestamo`, `fecha_finalizacion`, `dni_socio`, `dni_garante1`, `dni_garante2`) VALUES
(1, 10000.00, '2024-01-01', 3, 3333.33, 10.00, 1000.00, 2333.33, 'activo', NULL, 10001, 20001, 20002),
(2, 15000.00, '2024-02-01', 4, 3750.00, 12.00, 1800.00, 1950.00, 'activo', NULL, 10002, 20003, 20004),
(3, 20000.00, '2024-03-01', 5, 4000.00, 8.00, 1600.00, 2400.00, 'activo', NULL, 10003, 20005, 20002),
(4, 25000.00, '2024-04-01', 3, 8333.33, 15.00, 3750.00, 4583.33, 'cancelado', '2024-12-09', 10004, 20001, 20005),
(5, 12000.00, '2024-05-01', 4, 3000.00, 10.00, 1200.00, 1800.00, 'activo', NULL, 10005, 20002, 20003),
(6, 4000.00, '2024-12-07', 2, 2040.00, 1.00, 40.00, 2000.00, 'cancelado', '2024-12-09', 10004, 20003, 20004),
(7, 7000.00, '2024-12-07', 2, 2040.00, 1.00, 40.00, 2000.00, 'cancelado', '2024-12-09', 10004, 20003, 20004),
(11, 10000.00, '2024-12-20', 2, 5100.00, 1.00, 100.00, 5000.00, '0', NULL, 943848434, 20005, 20003),
(12, 10000.00, '2024-12-20', 2, 5100.00, 1.00, 100.00, 5000.00, '0', NULL, 943848434, 20005, 20003);

--
-- Disparadores `prestamos`
--
DELIMITER $$
CREATE TRIGGER `insertar_detalle_cuotas` AFTER INSERT ON `prestamos` FOR EACH ROW BEGIN
    DECLARE saldo_inicial DECIMAL(10,2);
    DECLARE saldo_final DECIMAL(10,2);
    DECLARE cuota_mensual DECIMAL(10,2);
    DECLARE amortizacion DECIMAL(10,2);
    DECLARE interes DECIMAL(10,2);
    DECLARE n INT DEFAULT 1;

    -- Obtener el monto del préstamo, cuota mensual, amortización e interés
    SET saldo_inicial = NEW.monto;
    SET cuota_mensual = NEW.cuota_mensual;
    SET amortizacion = NEW.amortizacion;
    SET interes = NEW.interes;

    -- Insertar el detalle de la primera cuota
    SET saldo_final = saldo_inicial - amortizacion;

    INSERT INTO informacion_prestamo (
        id_cuota, 
        n°_cuota, 
        saldo_inicial, 
        saldo_final, 
        estado_cuota, 
        fecha_cobro, 
        id_prestamo
    ) VALUES (
        CONCAT(NEW.id_prestamo, '-', n), -- id_cuota generado con el id_prestamo y el número de cuota
        n,                                -- Número de cuota
        saldo_inicial,                    -- Saldo inicial de la cuota
        saldo_final,                      -- Saldo final de la cuota
        'pendiente',                      -- Estado de la cuota
        NULL,                             -- Fecha de cobro (NULL en este caso)
        NEW.id_prestamo                  -- id_prestamo de la tabla prestamos
    );

    -- Actualizar saldo_inicial para las siguientes cuotas
    SET saldo_inicial = saldo_final;

    -- Insertar las cuotas siguientes
    WHILE n < NEW.cuotas DO
        SET n = n + 1;
        
        -- Para las cuotas posteriores, el saldo final debe ser el saldo inicial menos la amortización
        SET saldo_final = saldo_inicial - amortizacion;

        -- Insertar el detalle de la cuota
        INSERT INTO informacion_prestamo (
            id_cuota, 
            n°_cuota, 
            saldo_inicial, 
            saldo_final, 
            estado_cuota, 
            fecha_cobro, 
            id_prestamo
        ) VALUES (
            CONCAT(NEW.id_prestamo, '-', n), -- id_cuota generado con el id_prestamo y el número de cuota
            n,                                -- Número de cuota
            saldo_inicial,                    -- Saldo inicial de la cuota
            saldo_final,                      -- Saldo final de la cuota
            'pendiente',                      -- Estado de la cuota
            NULL,                             -- Fecha de cobro (NULL en este caso)
            NEW.id_prestamo                  -- id_prestamo de la tabla prestamos
        );

        -- Actualizar el saldo inicial para la siguiente cuota
        SET saldo_inicial = saldo_final;
    END WHILE;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `dni_socio` int(11) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `numero_cuenta` varchar(20) DEFAULT NULL,
  `codigo_universidad` varchar(20) DEFAULT NULL,
  `dependencia` varchar(50) DEFAULT NULL,
  `id_tipo_socio` int(11) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `domicilio` varchar(50) DEFAULT NULL,
  `distrito` varchar(50) DEFAULT NULL,
  `num_contacto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`dni_socio`, `nombres`, `apellidos`, `fecha_ingreso`, `numero_cuenta`, `codigo_universidad`, `dependencia`, `id_tipo_socio`, `correo`, `fecha_nacimiento`, `domicilio`, `distrito`, `num_contacto`) VALUES
(10001, 'Juan', 'Perez', '2021-01-15', '1234567890', 'UNI001', NULL, 1, NULL, NULL, NULL, NULL, NULL),
(10002, 'Maria', 'Lopez', '2020-06-10', '2345678901', 'UNI002', NULL, 2, NULL, NULL, NULL, NULL, NULL),
(10003, 'Luis', 'Garcia', '2019-11-20', '3456789012', 'UNI003', NULL, 3, NULL, NULL, NULL, NULL, NULL),
(10004, 'Ana', 'Torres', '2022-03-25', '4567890123', 'UNI004', NULL, 4, NULL, NULL, NULL, NULL, NULL),
(10005, 'Carlos', 'Sanchez', '2018-09-05', '5678901234', 'UNI005', NULL, 5, NULL, NULL, NULL, NULL, NULL),
(943848434, 'jeremy', 'rojas', '2024-12-11', '45355353535', '2342424', 'aea', 3, '435353', '2013-01-18', '353535', '43434', 453535345);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_prestamo`
--

CREATE TABLE `solicitud_prestamo` (
  `id_solicitudp` int(11) NOT NULL,
  `pdf_ruta` varchar(50) DEFAULT NULL,
  `dni_socio` int(11) DEFAULT NULL,
  `fecha_envio` date DEFAULT NULL,
  `estado_solicitud` varchar(50) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_auditoria`
--

CREATE TABLE `tabla_auditoria` (
  `id_operacion` int(11) NOT NULL,
  `fecha_operacion` date NOT NULL,
  `nombre_tabla` varchar(50) NOT NULL DEFAULT '',
  `tipo_operacion` varchar(50) NOT NULL DEFAULT '',
  `id_usuario` int(11) NOT NULL,
  `datos_anteriores` varchar(50) NOT NULL DEFAULT '',
  `datos_nuevos` varchar(50) NOT NULL DEFAULT '',
  `direccion_ip` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_socios`
--

CREATE TABLE `tipos_socios` (
  `id_tipo_socio` int(11) NOT NULL,
  `tipo_socio` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_socios`
--

INSERT INTO `tipos_socios` (`id_tipo_socio`, `tipo_socio`) VALUES
(1, 'DOCENTE ACTIVO'),
(2, 'DOCENTE CESANTE'),
(3, 'DOCENTE SOBREVIVIENTE'),
(4, 'ADMINISTRATIVO ACTIVO'),
(5, 'ADMINISTRATIVO CESANTE'),
(6, 'ADMINISTRATIVO SOBREVIVIENTE'),
(7, 'OBRERO ACTIVO'),
(8, 'OBRERO CESANTE'),
(9, 'OBRERO SOBREVIVIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `contra` varchar(250) NOT NULL,
  `tipo_usuario` varchar(50) DEFAULT NULL,
  `dni_socio` int(11) DEFAULT NULL,
  `estado_usuario` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `contra`, `tipo_usuario`, `dni_socio`, `estado_usuario`) VALUES
(1, 'jperez', '1234abcd', 'Admin', 10001, 'Activo'),
(2, 'mlopez', 'abcd1234', 'Usuario', 10002, 'Activo'),
(3, 'lgarcia', 'xyz9876', 'Usuario', 10003, 'Inactivo'),
(4, 'atorres', 'pqrs5678', 'Usuario', 10004, 'Activo'),
(5, 'csanchez', 'mnop3456', 'Usuario', 10005, 'Activo'),
(6, 'jusuario123', '$2y$10$of4z.w5LgT26my0qff4flO45LITgd2lmfBpEeXiJFa3xUGE5P03EK', 'Admin', 943848434, 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `beneficiarios`
--
ALTER TABLE `beneficiarios`
  ADD PRIMARY KEY (`dni_beneficiario`),
  ADD KEY `dni_socio` (`dni_socio`);

--
-- Indices de la tabla `cuota_afiliacion`
--
ALTER TABLE `cuota_afiliacion`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `dni_socio` (`dni_socio`);

--
-- Indices de la tabla `familiares`
--
ALTER TABLE `familiares`
  ADD PRIMARY KEY (`dni_familiar`),
  ADD KEY `FK__socios` (`dni_socio`);

--
-- Indices de la tabla `garantes`
--
ALTER TABLE `garantes`
  ADD PRIMARY KEY (`dni_garante`);

--
-- Indices de la tabla `informacion_prestamo`
--
ALTER TABLE `informacion_prestamo`
  ADD PRIMARY KEY (`id_cuota`),
  ADD KEY `FK_informacion_prestamo_prestamos` (`id_prestamo`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`),
  ADD KEY `dni_socio` (`dni_socio`),
  ADD KEY `dni_garante1` (`dni_garante1`),
  ADD KEY `dni_garante2` (`dni_garante2`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`dni_socio`),
  ADD KEY `id_tipo_socio` (`id_tipo_socio`);

--
-- Indices de la tabla `solicitud_prestamo`
--
ALTER TABLE `solicitud_prestamo`
  ADD PRIMARY KEY (`id_solicitudp`),
  ADD KEY `FK_solicitud_prestamo_socios` (`dni_socio`);

--
-- Indices de la tabla `tabla_auditoria`
--
ALTER TABLE `tabla_auditoria`
  ADD PRIMARY KEY (`id_operacion`),
  ADD KEY `FK__usuario` (`id_usuario`);

--
-- Indices de la tabla `tipos_socios`
--
ALTER TABLE `tipos_socios`
  ADD PRIMARY KEY (`id_tipo_socio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `FK_usuarios_socios` (`dni_socio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cuota_afiliacion`
--
ALTER TABLE `cuota_afiliacion`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id_prestamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `solicitud_prestamo`
--
ALTER TABLE `solicitud_prestamo`
  MODIFY `id_solicitudp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_socios`
--
ALTER TABLE `tipos_socios`
  MODIFY `id_tipo_socio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `beneficiarios`
--
ALTER TABLE `beneficiarios`
  ADD CONSTRAINT `beneficiarios_ibfk_1` FOREIGN KEY (`dni_socio`) REFERENCES `socios` (`dni_socio`);

--
-- Filtros para la tabla `cuota_afiliacion`
--
ALTER TABLE `cuota_afiliacion`
  ADD CONSTRAINT `cuota_afiliacion_ibfk_1` FOREIGN KEY (`dni_socio`) REFERENCES `socios` (`dni_socio`);

--
-- Filtros para la tabla `familiares`
--
ALTER TABLE `familiares`
  ADD CONSTRAINT `FK__socios` FOREIGN KEY (`dni_socio`) REFERENCES `socios` (`dni_socio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `informacion_prestamo`
--
ALTER TABLE `informacion_prestamo`
  ADD CONSTRAINT `FK_informacion_prestamo_prestamos` FOREIGN KEY (`id_prestamo`) REFERENCES `prestamos` (`id_prestamo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`dni_socio`) REFERENCES `socios` (`dni_socio`),
  ADD CONSTRAINT `prestamos_ibfk_2` FOREIGN KEY (`dni_garante1`) REFERENCES `garantes` (`dni_garante`),
  ADD CONSTRAINT `prestamos_ibfk_3` FOREIGN KEY (`dni_garante2`) REFERENCES `garantes` (`dni_garante`);

--
-- Filtros para la tabla `socios`
--
ALTER TABLE `socios`
  ADD CONSTRAINT `socios_ibfk_1` FOREIGN KEY (`id_tipo_socio`) REFERENCES `tipos_socios` (`id_tipo_socio`);

--
-- Filtros para la tabla `solicitud_prestamo`
--
ALTER TABLE `solicitud_prestamo`
  ADD CONSTRAINT `FK_solicitud_prestamo_socios` FOREIGN KEY (`dni_socio`) REFERENCES `socios` (`dni_socio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tabla_auditoria`
--
ALTER TABLE `tabla_auditoria`
  ADD CONSTRAINT `FK__usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_usuarios_socios` FOREIGN KEY (`dni_socio`) REFERENCES `socios` (`dni_socio`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
