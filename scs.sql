-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 10:11 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scs`
--

-- --------------------------------------------------------

--
-- Table structure for table `centros_salud`
--

CREATE TABLE `centros_salud` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `centros_salud`
--

INSERT INTO `centros_salud` (`id`, `nombre`, `direccion`, `telefono`) VALUES
(1, 'BARRIO DE LA SALUD', 'Avenida Venezuela, 6', 922474000),
(2, 'DUGGI CENTRO', 'Carmen Monteverde, 45', 922951613),
(3, 'TOSCAL CENTRO', 'Calle Ruíz de Padrón, 6', 922533750),
(4, 'CAE JA RUMEU', 'Calle Tome Cano, 7', 922477544);

-- --------------------------------------------------------

--
-- Table structure for table `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fechaHora` datetime NOT NULL,
  `idPaciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `citas`
--

INSERT INTO `citas` (`id`, `tipo`, `fechaHora`, `idPaciente`) VALUES
(24, 'MEDICA', '2020-12-23 13:13:00', 142),
(31, 'ENFERMERIA', '2020-12-31 12:25:00', 143),
(32, 'MEDICA', '2020-12-11 12:52:00', 145),
(33, 'ENFERMERIA', '2020-12-17 13:31:00', 25),
(34, 'ENFERMERIA', '2020-12-17 13:32:00', 25),
(36, 'MEDICA', '2020-12-29 14:08:00', 25),
(37, 'MEDICA', '2020-12-12 16:38:00', 26),
(38, 'ENFERMERIA', '2020-12-15 16:38:00', 26),
(39, 'MEDICA', '2020-12-13 16:43:00', 26),
(40, 'MEDICA', '2020-12-18 16:49:00', 26),
(41, 'MEDICA', '2020-12-24 17:14:00', 26),
(42, 'ENFERMERIA', '2020-12-11 19:29:00', 25),
(44, 'MEDICA', '2020-12-25 20:08:00', 24),
(45, 'ENFERMERIA', '2020-12-31 20:08:00', 24),
(46, 'MEDICA', '2020-12-26 20:34:00', 25);

-- --------------------------------------------------------

--
-- Table structure for table `cupos`
--

CREATE TABLE `cupos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idCentroSalud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cupos`
--

INSERT INTO `cupos` (`id`, `nombre`, `idCentroSalud`) VALUES
(1, 'BS-001', 1),
(2, 'BS-002', 1),
(3, 'BS-003', 1),
(4, 'DC-001', 2),
(5, 'DC-002', 2),
(6, 'TC-001', 3),
(7, 'TC-002', 3),
(8, 'CJR-001', 4),
(9, 'CJR-002', 4),
(10, 'CJR-003', 4);

-- --------------------------------------------------------

--
-- Table structure for table `enfermeros`
--

CREATE TABLE `enfermeros` (
  `id` int(11) NOT NULL,
  `numColegiado` int(11) NOT NULL,
  `idCentroSalud` int(11) NOT NULL,
  `idCupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `enfermeros`
--

INSERT INTO `enfermeros` (`id`, `numColegiado`, `idCentroSalud`, `idCupo`) VALUES
(14, 1458, 1, 1),
(15, 6523, 1, 2),
(16, 1234, 1, 3),
(17, 4321, 2, 4),
(18, 441122, 2, 5),
(19, 12786, 3, 6),
(20, 12796, 3, 7),
(21, 4569, 4, 8),
(22, 4455, 4, 9),
(23, 5544, 4, 10),
(141, 123, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `observaciones` text COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `fechaHora` datetime NOT NULL,
  `navegador` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sistemaOperativo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicos`
--

CREATE TABLE `medicos` (
  `id` int(11) NOT NULL,
  `numColegiado` int(11) NOT NULL,
  `idCentroSalud` int(11) NOT NULL,
  `idCupo` int(11) NOT NULL,
  `especialidad` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `medicos`
--

INSERT INTO `medicos` (`id`, `numColegiado`, `idCentroSalud`, `idCupo`, `especialidad`) VALUES
(4, 2568, 1, 1, 'FAMILIA'),
(5, 71456, 1, 2, 'FAMILIA'),
(6, 32156, 1, 3, 'FAMILIA'),
(7, 2516, 2, 4, 'FAMILIA'),
(8, 25163, 2, 5, 'PEDIATRÍA'),
(9, 87163, 3, 6, 'PEDIATRÍA'),
(10, 124578, 3, 7, 'FAMILIA'),
(11, 126598, 4, 8, 'DIGESTIVO'),
(12, 65874, 4, 9, 'TRAUMATOLOGÍA'),
(13, 124588, 4, 10, 'UROLOGÍA'),
(131, 123987555, 1, 1, 'NEFROLOGÍA'),
(132, 12345, 1, 1, 'FAMILIA');

-- --------------------------------------------------------

--
-- Table structure for table `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `idCentroSalud` int(11) NOT NULL,
  `idCupo` int(11) NOT NULL,
  `numHistoria` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pacientes`
--

INSERT INTO `pacientes` (`id`, `idCentroSalud`, `idCupo`, `numHistoria`) VALUES
(24, 1, 1, ''),
(25, 1, 1, ''),
(26, 1, 1, ''),
(27, 1, 1, ''),
(28, 1, 1, ''),
(29, 1, 1, ''),
(30, 1, 1, ''),
(31, 1, 1, ''),
(32, 1, 1, ''),
(33, 1, 1, ''),
(34, 1, 2, ''),
(35, 1, 2, ''),
(36, 1, 2, ''),
(37, 1, 2, ''),
(38, 1, 2, ''),
(39, 1, 2, ''),
(40, 1, 2, ''),
(41, 1, 2, ''),
(42, 1, 2, ''),
(43, 1, 2, ''),
(44, 1, 3, ''),
(45, 1, 3, ''),
(46, 1, 3, ''),
(47, 1, 3, ''),
(48, 1, 3, ''),
(49, 1, 3, ''),
(50, 1, 3, ''),
(51, 1, 3, ''),
(52, 1, 3, ''),
(53, 1, 3, ''),
(54, 2, 4, ''),
(55, 2, 4, ''),
(56, 2, 4, ''),
(57, 2, 4, ''),
(58, 2, 4, ''),
(59, 2, 4, ''),
(60, 2, 4, ''),
(61, 2, 4, ''),
(62, 2, 4, ''),
(63, 2, 4, ''),
(64, 2, 5, ''),
(65, 2, 5, ''),
(66, 2, 5, ''),
(67, 2, 5, ''),
(68, 2, 5, ''),
(69, 2, 5, ''),
(70, 2, 5, ''),
(71, 2, 5, ''),
(72, 2, 5, ''),
(73, 2, 5, ''),
(74, 3, 6, ''),
(75, 3, 6, ''),
(76, 3, 6, ''),
(77, 3, 6, ''),
(78, 3, 6, ''),
(79, 3, 6, ''),
(80, 3, 6, ''),
(81, 3, 6, ''),
(82, 3, 6, ''),
(83, 3, 6, ''),
(84, 3, 7, ''),
(85, 3, 7, ''),
(86, 3, 7, ''),
(87, 3, 7, ''),
(88, 3, 7, ''),
(89, 3, 7, ''),
(90, 3, 7, ''),
(91, 3, 7, ''),
(92, 3, 7, ''),
(93, 3, 7, ''),
(94, 4, 8, ''),
(95, 4, 8, ''),
(96, 4, 8, ''),
(97, 4, 8, ''),
(98, 4, 8, ''),
(99, 4, 8, ''),
(100, 4, 8, ''),
(101, 4, 8, ''),
(102, 4, 8, ''),
(103, 4, 8, ''),
(104, 4, 9, ''),
(105, 4, 9, ''),
(106, 4, 9, ''),
(107, 4, 9, ''),
(108, 4, 9, ''),
(109, 4, 9, ''),
(110, 4, 9, ''),
(111, 4, 9, ''),
(112, 4, 9, ''),
(113, 4, 9, ''),
(114, 4, 10, ''),
(115, 4, 10, ''),
(116, 4, 10, ''),
(117, 4, 10, ''),
(118, 4, 10, ''),
(119, 4, 10, ''),
(120, 4, 10, ''),
(121, 4, 10, ''),
(122, 4, 10, ''),
(123, 4, 10, ''),
(136, 1, 1, ''),
(137, 1, 1, '12345678'),
(138, 1, 1, '999999'),
(139, 1, 1, '997788'),
(140, 1, 1, '665577'),
(142, 1, 1, '123456'),
(143, 3, 2, '9995545'),
(145, 1, 1, '11223344');

-- --------------------------------------------------------

--
-- Table structure for table `permisos_web`
--

CREATE TABLE `permisos_web` (
  `idRol` int(11) NOT NULL,
  `nombreWeb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permitido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permisos_web`
--

INSERT INTO `permisos_web` (`idRol`, `nombreWeb`, `permitido`) VALUES
(1, 'citas.php', 1),
(1, 'eliminarCita.php', 1),
(1, 'enfermeros.php', 1),
(1, 'fichaCita.php', 1),
(1, 'fichaUsuario.php', 1),
(1, 'formCitas.php', 1),
(1, 'formEnfermero.php', 1),
(1, 'formMedico.php', 1),
(1, 'formPaciente.php', 1),
(1, 'formUsuario.php', 1),
(1, 'medicos.php', 1),
(1, 'pacientes.php', 1),
(1, 'usuarios.php', 1),
(2, 'citas.php', 1),
(2, 'enfermeros.php', 1),
(2, 'fichaUsuario.php', 1),
(2, 'medicos.php', 1),
(2, 'pacientes.php', 1),
(3, 'citas.php', 1),
(3, 'eliminarCita.php', 1),
(3, 'enfermeros.php', 1),
(3, 'fichaCita.php', 1),
(3, 'fichaUsuario.php', 1),
(3, 'formCitas.php', 1),
(3, 'medicos.php', 1),
(3, 'pacientes.php', 1),
(4, 'citas.php', 1),
(4, 'eliminarCita.php', 1),
(4, 'enfermeros.php', 1),
(4, 'fichaCita.php', 1),
(4, 'fichaUsuario.php', 1),
(4, 'formCitas.php', 1),
(4, 'medicos.php', 1),
(4, 'pacientes.php', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tabla` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tablaCupo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plantilla` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plantillaForm` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clase` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `indexWeb` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menuWeb` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `tabla`, `tablaCupo`, `plantilla`, `plantillaForm`, `clase`, `indexWeb`, `menuWeb`) VALUES
(1, 'ADMINISTRADOR', 'administradores', '', 'fichaAdministrador.html', 'formAdministrador.php', 'Administrador', 'index_ADMIN.php', 'menu_ADMIN.php'),
(2, 'MÉDICO', 'medicos', 'cupo_medico', 'fichaMedico.html', 'formMedico.php', 'Medico', 'index_MED.php', 'menu_MED.php'),
(3, 'ENFERMERO', 'enfermeros', 'cupo_enfermero', 'fichaEnfermero.html', 'formEnfermero.php', 'Enfermero', 'index_ENF.php', 'menu_ENF.php'),
(4, 'PACIENTE', 'pacientes', 'cupo_paciente', 'fichaPaciente.html', 'formPaciente.php', 'Paciente', 'index_PAC.php', 'menu_PAC.php');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `idRol` int(11) NOT NULL,
  `nombre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cp` int(6) NOT NULL,
  `numIntentosLogin` int(1) NOT NULL,
  `ultimoAcceso` datetime NOT NULL,
  `bloqueado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `idRol`, `nombre`, `apellidos`, `email`, `password`, `fechaNacimiento`, `direccion`, `cp`, `numIntentosLogin`, `ultimoAcceso`, `bloqueado`) VALUES
(1, 1, 'Raquel', 'Marichal Fernández', 'administrador1@pruebas.com', '$2y$10$mIuCYitVKTHW9R1dwrTu6.VhYncrp2rjwsvS/5N20wGjrIRXtvjwu', '1976-11-11', 'Calle Puerta Canseco, 43', 38081, 1, '2020-11-01 16:00:00', 0),
(2, 1, 'Rita', 'Dorta Fernández', 'administrador2@pruebas.com', '$2y$10$956xtF8kkPVOWzz1VF.f.OzPYHSJa9PZXUMH4W8msY3ooR0huFKvC', '1976-06-22', 'Calle Porlier, 36', 38026, 0, '2020-11-01 16:00:00', 0),
(3, 1, 'Pedro', 'Gil González', 'administrador3@pruebas.com', '$2y$10$7MHIUww6q9NfxNzBjZ7YFutbpE8.7.uUHQpEMBaLfR.bY2Fc4h.VW', '1978-09-25', 'Calle Porlier, 26', 38066, 0, '2020-11-01 16:00:00', 0),
(4, 2, 'Juan', 'Díaz Pérez', 'medico1@pruebas.com', '$2y$10$mKONLBy2ONeGHdlx3x13z.egc3PcP0qFnhvPSs2DwB8eP.wahvp9y', '1983-09-23', 'Calle General Gutiérrez, 23', 38087, 1, '2020-11-01 16:00:00', 0),
(5, 2, 'Rocío', 'Dorta Estévez', 'medico2@pruebas.com', '$2y$10$aPsdyLAG5TdijTd5ZRbdD.apuIu8452uBeR5w81q8QWcqGZqjlBi.', '1974-01-02', 'Calle San Antonio, 3', 38091, 0, '2020-11-01 16:00:00', 0),
(6, 2, 'Rita', 'Gil Castillo', 'medico3@pruebas.com', '$2y$10$D0j00ZLrbUKQN7w.8.r4qOs6ux5sB34UEFJ60/5sPUmMKkL6bd.6m', '1975-12-16', 'Calle José Hernández Alfonso, 44', 38068, 0, '2020-11-01 16:00:00', 0),
(7, 2, 'Teresa', 'Dorta Estévez', 'medico4@pruebas.com', '$2y$10$XQ0ThHtIGOnQ6t3AIuJIGeFq9lg7PmHf6LJ5yinHlFpuoAvCPjSaS', '1972-12-16', 'Calle Calvo Sotelo, 6', 38032, 0, '2020-11-01 16:00:00', 0),
(8, 2, 'Rocío', 'Díaz Barreto', 'medico5@pruebas.com', '$2y$10$gzeqDIgH.sHiMQGrrdpu9eiMq7gIWRLdq2eseVZuCHAQkaEl4B/bO', '1977-08-08', 'Calle General Gutiérrez, 7', 38083, 0, '2020-11-01 16:00:00', 0),
(9, 2, 'María', 'Cruz Molina', 'medico6@pruebas.com', '$2y$10$lOIkMzkXVwCLizDV4Fi0mOOlcVmB9mmnqYSMoUnjzSgoYSiD/WG32', '1965-10-10', 'Calle Méndez Núñez, 26', 38014, 0, '2020-11-01 16:00:00', 0),
(10, 2, 'Rita', 'Soto Barreto', 'medico7@pruebas.com', '$2y$10$D9bjUGXDE3KnYmPOLvbjjuLi5ccTFazY5E.yxmhjZsCTZ8ePR5kW6', '1977-07-10', 'Calle Puerta Canseco, 28', 38009, 0, '2020-11-01 16:00:00', 0),
(11, 2, 'Teresa', 'Adán Guanche', 'medico8@pruebas.com', '$2y$10$ZwuuuOHioO8nRoFF4AOFruspz3ESkdaexpW57Xxgjrm/kwf5aQBQu', '1977-05-05', 'Calle Porlier, 31', 38083, 0, '2020-11-01 16:00:00', 0),
(12, 2, 'Pedro', 'Modino González', 'medico9@pruebas.com', '$2y$10$D2uh2tHA2rU303ny.Mspje3/d7ZYV1iiLykaXn8evQYsbAze/sKha', '1976-08-07', 'Calle José Hernández Alfonso, 49', 38043, 0, '2020-11-01 16:00:00', 0),
(13, 2, 'Raquel', 'Ravelo Guanche', 'medico10@pruebas.com', '$2y$10$AASc63HR214KKqgxXUuHqeK9puJWzCvniR4rGYhwxWmcmw7TyIUDi', '1973-07-25', 'Calle Ánguel Guimerá, 21', 38042, 0, '2020-11-01 16:00:00', 0),
(14, 3, 'Jorge', 'Dorta Guanche', 'enfermero1@pruebas.com', '$2y$10$soc4Nb2TG8mFhuyXyQgKRuTVpbS7UEZSP3c314EYjWUGuno.7z7xm', '1986-11-21', 'Calle Porlier, 46', 38019, 0, '2020-11-01 16:00:00', 0),
(15, 3, 'Raquel', 'Díaz González', 'enfermero2@pruebas.com', '$2y$10$oQtvhB.Ct3ec7oxA6LZ5EufSwaFazVf4Bx0dSDMexpJKbCh.H3Qvu', '1986-08-09', 'Calle San Antonio, 24', 38014, 0, '2020-11-01 16:00:00', 0),
(16, 3, 'Marcos', 'Ravelo Castillo', 'enfermero3@pruebas.com', '$2y$10$A4wTjBe6Lfu15TwGwGk23ec6BRSwrT7ZW891PMtlk4WKHeSuf61oK', '1975-11-18', 'Calle Méndez Núñez, 44', 38014, 0, '2020-11-01 16:00:00', 0),
(17, 3, 'Rubén', 'Ravelo Barreto', 'enfermero4@pruebas.com', '$2y$10$Si.ZhRJs7MpzWoanS3bi1uqPAR8O3lmnbp64Dkm8NqVETbGjCQ0ie', '1987-06-05', 'Calle Calvo Sotelo, 12', 38070, 0, '2020-11-01 16:00:00', 0),
(18, 3, 'Pedro', 'Rodríguez Mesa', 'enfermero5@pruebas.com', '$2y$10$7Z.Vli6IF7nmxycB8EnoqeO4wmG3GPXe3Wepz/qLEujERabGJ1kBK', '1988-09-28', 'Calle Calvo Sotelo, 45', 38065, 0, '2020-11-01 16:00:00', 0),
(19, 3, 'Rubén', 'Rodríguez Guanche', 'enfermero6@pruebas.com', '$2y$10$gZh5xLxbZAX8sxPQg26ELOUrQjAafq2KvEgAp9Jv07F40u27krURi', '1977-10-28', 'Calle José Hernández Alfonso, 7', 38024, 0, '2020-11-01 16:00:00', 0),
(20, 3, 'Andrés', 'Soto Brito', 'enfermero7@pruebas.com', '$2y$10$GXi/CSpnYQmBdAr6uGiv2upKvfSPY68hTPcZwC32ibaUt3Sq5nF7S', '1989-09-25', 'Calle Costa y Grijalba, 8', 38073, 0, '2020-11-01 16:00:00', 0),
(21, 3, 'Rubén', 'Rodríguez Fernández', 'enfermero8@pruebas.com', '$2y$10$97JNflrhAIzln6ITGi7/nODQdzhd1Tor0R.xtm2lKNCcj1wIoojjy', '1971-08-09', 'Calle San Antonio, 14', 38040, 0, '2020-11-01 16:00:00', 0),
(22, 3, 'Pedro', 'PEREZ PEREZ', 'enfermero9@pruebas.com', '$2y$10$KMuvN52e/h377EX3qKoF/esqPzPGtQZKmbcid0ffqQ98U4.MK4i9K', '1984-12-09', 'Calle San Antonio, 18', 38066, 0, '2020-11-01 16:00:00', 0),
(23, 3, 'Marcos', 'Ravelo Estévez', 'enfermero10@pruebas.com', '$2y$10$7l6AQaCPci3Ge/rWWYZDxOiN4oI.19cvkNvBxsHfSMjOjEZua0QC.', '1985-04-14', 'Calle Porlier, 27', 38002, 0, '2020-11-01 16:00:00', 0),
(24, 4, 'Rubén', 'Dorta Castillo', 'paciente1@pruebas.com', '$2y$10$Cu7/9BJp3GMW2C0Vw9unqOpLxtjB8337mbNoWi9T2YMG0pL6HRH6C', '1979-06-02', 'Calle Castro, 4', 38079, 0, '2020-11-01 16:00:00', 0),
(25, 4, 'Raquel', 'Hernández Mesa', 'paciente2@pruebas.com', '$2y$10$cxtyEg9LfZHCSsKX7jFBwepiNSPMnfjASwfsezNjE1AGxx8ehwage', '1975-09-01', 'Calle General Gutiérrez, 4', 38065, 0, '2020-11-01 16:00:00', 0),
(26, 4, 'Jorge', 'Dorta Barreto', 'paciente3@pruebas.com', '$2y$10$y89i/GCScpv8yxM571tMXuGlctHK1f5WYAzOM1zmkcL3WAzce7UaO', '1953-11-06', 'Calle Castro, 9', 38040, 0, '2020-11-01 16:00:00', 0),
(27, 4, 'María', 'Domínguez Alonso', 'paciente4@pruebas.com', '$2y$10$e7qaUWPxtTylT6w1Rr9Qsu75j9ZNRpfxqiiLpgmKJxdnphNUK8wjq', '1965-07-27', 'Calle Ánguel Guimerá, 4', 38031, 0, '2020-11-01 16:00:00', 0),
(28, 4, 'Raquel', 'Domínguez Castillo', 'paciente5@pruebas.com', '$2y$10$8po2emUEE/XHIFG7ZwCup.2o4akjbyDbMHVxnIFZ8UyyFTnc8dcKa', '1976-10-23', 'Calle Puerta Canseco, 35', 38056, 0, '2020-11-01 16:00:00', 0),
(29, 4, 'Marcos', 'Modino Guanche', 'paciente6@pruebas.com', '$2y$10$J/u.7/sRWcWI06IfH1JhEOosuVvtM9NgvMaBCgIEYTT5JOnhKcGpa', '1950-04-19', 'Calle General Gutiérrez, 47', 38033, 0, '2020-11-01 16:00:00', 0),
(30, 4, 'Teresa', 'Marichal Fernández', 'paciente7@pruebas.com', '$2y$10$iXTz8wjrMDEKbjezAW9hSuDfNXoHd/LW6tMQr10u6IyBcYFyeskOK', '1984-12-14', 'Calle Castro, 27', 38064, 0, '2020-11-01 16:00:00', 0),
(31, 4, 'Beatriz', 'Dorta González', 'paciente8@pruebas.com', '$2y$10$RvE3mLRiOI.iah7kN2oJC.Ty5KsGnUg5c33TRKiP0ue5lnJVqBPEe', '1968-06-03', 'Calle Puerta Canseco, 11', 38067, 0, '2020-11-01 16:00:00', 0),
(32, 4, 'Marcos', 'Soto Alonso', 'paciente9@pruebas.com', '$2y$10$VjwpWgcaDmq1u7vw.3nHzOGonAlXzXxqR47IEqsZUYo8lfrQyOFS2', '1975-02-22', 'Calle General Gutiérrez, 3', 38089, 0, '2020-11-01 16:00:00', 0),
(33, 4, 'Rita', 'Díaz Estévez', 'paciente10@pruebas.com', '$2y$10$brC63QcDT6NvTYZeQoTC/uUUrvtRSXRcHerGgNqdeG8QWQOFNDpe2', '1957-11-16', 'Calle Castro, 19', 38046, 0, '2020-11-01 16:00:00', 0),
(34, 4, 'María', 'Cruz González', 'paciente11@pruebas.com', '$2y$10$yg5dtpaV8xgPBTBrPwzKYeXBG/hSCCv22CGoG4KZcTwSV7hiZ5J.G', '1941-12-23', 'Calle San Antonio, 4', 38070, 0, '2020-11-01 16:00:00', 0),
(35, 4, 'Marcos', 'Domínguez Pérez', 'paciente12@pruebas.com', '$2y$10$Yi1uFLn70XyFx.vWZYGhNOmehtotdJ6tkSJeWVRdNjLtJMU061gAS', '1990-09-27', 'Calle Méndez Núñez, 31', 38038, 0, '2020-11-01 16:00:00', 0),
(36, 4, 'Rubén', 'Gil Castillo', 'paciente13@pruebas.com', '$2y$10$7JMtKaB4kbBS6Ih5OMaIHu54BxypjMZIGySQZiQZvdKrT8zqPtPk6', '1963-11-01', 'Calle General Gutiérrez, 47', 38081, 0, '2020-11-01 16:00:00', 0),
(37, 4, 'Marcos', 'Díaz Guanche', 'paciente14@pruebas.com', '$2y$10$xYeGAUAn7LKE5uk/FNP8GuNxJZXof2NBRHNaW3mOU9mRgyTuYggYW', '1978-02-11', 'Calle José Hernández Alfonso, 9', 38025, 0, '2020-11-01 16:00:00', 0),
(38, 4, 'Jorge', 'Modino Alonso', 'paciente15@pruebas.com', '$2y$10$rbercDSesRoqA6xEnNMgDeajbo5mwNdjUNICiKjJcV9MiFjqj/Iva', '1944-06-28', 'Calle Puerta Canseco, 13', 38019, 0, '2020-11-01 16:00:00', 0),
(39, 4, 'Rubén', 'Dorta Brito', 'paciente16@pruebas.com', '$2y$10$Fpa28DC.kCDIkvtn0I01X.6eplajGOSNPiKO3Y70.yAfkjOE/7qeG', '1937-04-01', 'Calle Costa y Grijalba, 45', 38016, 0, '2020-11-01 16:00:00', 0),
(40, 4, 'Rita', 'Díaz Molina', 'paciente17@pruebas.com', '$2y$10$RDgPxB1wrmVQPMgO2aX7u.ns4BSxe5Pupd/sIL8MZDznTXt2ss/c2', '1980-07-15', 'Calle José Hernández Alfonso, 1', 38098, 0, '2020-11-01 16:00:00', 0),
(41, 4, 'María', 'Rodríguez Castillo', 'paciente18@pruebas.com', '$2y$10$TPu9u6yYCaHtwEyWa7jRI.ygtHbl0hIcwUv2DVaAb4fwkmdTet2tK', '1978-01-14', 'Calle Costa y Grijalba, 22', 38008, 0, '2020-11-01 16:00:00', 0),
(42, 4, 'Rubén', 'Ravelo García', 'paciente19@pruebas.com', '$2y$10$olKCDyOjF5AfzJl0yxHjpe5veXKdVKMKcYIc2mPY8jnbOsoiOSuRK', '1964-11-09', 'Calle Ánguel Guimerá, 48', 38018, 0, '2020-11-01 16:00:00', 0),
(43, 4, 'María', 'Díaz González', 'paciente20@pruebas.com', '$2y$10$XIfhDzPydMKvmld56S7N3uF9I7/Y7VlHWY6rI6YYQEfcsMQMUISiS', '1982-04-04', 'Calle San Antonio, 11', 38078, 0, '2020-11-01 16:00:00', 0),
(44, 4, 'Jorge', 'Soto García', 'paciente21@pruebas.com', '$2y$10$pt5PGIGQYtRyxcBHqpBKMO.R9gtq6hXSaWDAxOFLATkBAgV29IL1m', '1990-11-23', 'Calle General Gutiérrez, 38', 38094, 0, '2020-11-01 16:00:00', 0),
(45, 4, 'Teresa', 'Rodríguez Castillo', 'paciente22@pruebas.com', '$2y$10$0tvimHzuIXmcmZdF/kxE9.XQTQS.qUbrX4EdAk87YHXbxCCSNUuiK', '1990-09-10', 'Calle Castro, 12', 38089, 0, '2020-11-01 16:00:00', 0),
(46, 4, 'Rita', 'Hernández Estévez', 'paciente23@pruebas.com', '$2y$10$8N6gi1Uoi4fSEEDmTBJIpuRZ7utQZkpZwtBY6DHUUqyv/tNSh350y', '1975-06-23', 'Calle Puerta Canseco, 2', 38027, 0, '2020-11-01 16:00:00', 0),
(47, 4, 'Beatriz', 'Adán Brito', 'paciente24@pruebas.com', '$2y$10$5NWziUZpbs1s6ELcJjoybOHKhAs15Xu7hmwTn.JtMgT/Mc31DO0p6', '1945-06-26', 'Calle Puerta Canseco, 3', 38082, 0, '2020-11-01 16:00:00', 0),
(48, 4, 'Jorge', 'Marichal Barreto', 'paciente25@pruebas.com', '$2y$10$JIWG9TY9DAc1bFRaOzjvbOZMt9TJfxz4RKzD8/PZnbIW73XnWjxFi', '1941-06-22', 'Calle José Hernández Alfonso, 1', 38029, 0, '2020-11-01 16:00:00', 0),
(49, 4, 'Marcos', 'Soto García', 'paciente26@pruebas.com', '$2y$10$YMzWfx/84b8o..e7QwwoIuOff3YOV79jsIg6a0DL7cQ5/NT/DkRVW', '1938-10-04', 'Calle Méndez Núñez, 2', 38059, 0, '2020-11-01 16:00:00', 0),
(50, 4, 'Pedro', 'Modino Brito', 'paciente27@pruebas.com', '$2y$10$bNI0cAGmZlFM/YJHvftzWOE5RtGP5UES2Ei42KGgo1ptazQlFbOS6', '1952-01-15', 'Calle Castro, 44', 38018, 0, '2020-11-01 16:00:00', 0),
(51, 4, 'Teresa', 'Gil Castillo', 'paciente28@pruebas.com', '$2y$10$wSsfDBL.6xvnKEmCicH2z.3w3PV9aKi9IRyz4z1CxR4BbDHUuRLHe', '1941-11-21', 'Calle Méndez Núñez, 14', 38066, 0, '2020-11-01 16:00:00', 0),
(52, 4, 'Rubén', 'Domínguez García', 'paciente29@pruebas.com', '$2y$10$ovAtnLnOqJ8eTF9xxx8LCem.ofTEAMxx8c17/Fi27mhg1wlh3VMgO', '1979-10-14', 'Calle Calvo Sotelo, 21', 38068, 0, '2020-11-01 16:00:00', 0),
(53, 4, 'Andrés', 'Rodríguez Castillo', 'paciente30@pruebas.com', '$2y$10$CIrc5zb5T5aV7AFBTbB0/.qXIyX.rTWVOSr90JVM22h/fdTZ.1FE.', '1944-10-22', 'Calle General Gutiérrez, 5', 38025, 0, '2020-11-01 16:00:00', 0),
(54, 4, 'Teresa', 'Ravelo Brito', 'paciente31@pruebas.com', '$2y$10$UXwPAQF2U6Nr65ukLZ8bm.ij0B4NtYMICzKWLJXOh6zgJI/z8WLya', '1967-02-20', 'Calle José Hernández Alfonso, 6', 38061, 0, '2020-11-01 16:00:00', 0),
(55, 4, 'Jorge', 'Dorta Guanche', 'paciente32@pruebas.com', '$2y$10$hJp6LPRV.sIcElo.vIeOV.T/naOW.5ejTKGKSLDq/yH6Qj/BmgZfK', '1948-02-19', 'Calle Calvo Sotelo, 11', 38032, 0, '2020-11-01 16:00:00', 0),
(56, 4, 'Rocío', 'Domínguez Mesa', 'paciente33@pruebas.com', '$2y$10$hzle9fiZFXP7Yt5/idOLw.S2e0P0B0dUZ5gXU4W0cliDOIadZpbLK', '1947-10-14', 'Calle Costa y Grijalba, 45', 38038, 0, '2020-11-01 16:00:00', 0),
(57, 4, 'Marcos', 'Domínguez García', 'paciente34@pruebas.com', '$2y$10$hMRj3w3wTdFm3l0cWGd1JutnwQSfsIwNM8Brt/318VoIj7I.dAKhy', '1946-08-04', 'Calle José Hernández Alfonso, 4', 38004, 0, '2020-11-01 16:00:00', 0),
(58, 4, 'Juan', 'Gil Guanche', 'paciente35@pruebas.com', '$2y$10$0jlX2LBr1L0qWnUi07ejA.UmFjTG/ZctolI9VxOhPJ4KWm.eLt8u6', '1984-02-16', 'Calle Puerta Canseco, 11', 38011, 0, '2020-11-01 16:00:00', 0),
(59, 4, 'Andrés', 'Marichal Brito', 'paciente36@pruebas.com', '$2y$10$9oke0k.eZx9AL7pPGGyP0eUfSz83sHYSsfeOtkfYc.aZVTPSJ3aWC', '1941-08-06', 'Calle Calvo Sotelo, 22', 38051, 0, '2020-11-01 16:00:00', 0),
(60, 4, 'Rita', 'Soto Mesa', 'paciente37@pruebas.com', '$2y$10$wdM32Gfcq7UoQVxreuaeh.wUprxgGeLG9nFYGA9Ed6Xxprb7giqJy', '1990-02-05', 'Calle Méndez Núñez, 50', 38018, 0, '2020-11-01 16:00:00', 0),
(61, 4, 'Rita', 'Dorta Alonso', 'paciente38@pruebas.com', '$2y$10$ymQSyrmBOs6o31Vp2oeZ2eWnTeEwMKDWB9VkYRV7BTYSTX7ImvEY2', '1940-05-12', 'Calle San Antonio, 49', 38018, 0, '2020-11-01 16:00:00', 0),
(62, 4, 'Teresa', 'Soto Pérez', 'paciente39@pruebas.com', '$2y$10$DRHzAtQmV19xzLC8S7em5uoEfDOgUWwhpMmobMpuLzh4CqoqQaS.y', '1987-05-08', 'Calle Méndez Núñez, 44', 38035, 0, '2020-11-01 16:00:00', 0),
(63, 4, 'Rocío', 'Hernández Mesa', 'paciente40@pruebas.com', '$2y$10$KvxtMLVnO4oTb3X1GszfHeuXla9qgDH6DszkzmZgkEQ4tveompZFu', '1986-10-03', 'Calle Porlier, 23', 38095, 0, '2020-11-01 16:00:00', 0),
(64, 4, 'Andrés', 'Hernández Brito', 'paciente41@pruebas.com', '$2y$10$lkG6D9VS.Q06sy5lbPl9Mepol95.LeTvzlY/t7hvtZeVjwM19TJd6', '1984-06-05', 'Calle Calvo Sotelo, 9', 38016, 0, '2020-11-01 16:00:00', 0),
(65, 4, 'Marcos', 'Gil Pérez', 'paciente42@pruebas.com', '$2y$10$/tVRCsAsK7KS8oMbkIAROuFG0/gPH4VGkmJ.HPRMnm0cVBGVQIdOK', '1956-01-04', 'Calle Costa y Grijalba, 31', 38077, 0, '2020-11-01 16:00:00', 0),
(66, 4, 'Jorge', 'Cruz González', 'paciente43@pruebas.com', '$2y$10$lBVvdMKObu.7QU1Hcro.B.2ABZWKIJqkudv89txeBNJEPYSOI.yTK', '1956-05-15', 'Calle Porlier, 39', 38019, 0, '2020-11-01 16:00:00', 0),
(67, 4, 'Rubén', 'Rodríguez Guanche', 'paciente44@pruebas.com', '$2y$10$ruTuYLOLjoMBggRkrn3TH.m.joL0MG3AlIoRrmeTFmW7w4MhCfZ4W', '1978-09-12', 'Calle General Gutiérrez, 33', 38040, 0, '2020-11-01 16:00:00', 0),
(68, 4, 'Rocío', 'Cruz Guanche', 'paciente45@pruebas.com', '$2y$10$PnkP.RO5DFEX64szOU6r7e8GY4rSnnXBvmIHkNmsTnDSC5CSx6bXK', '1980-09-21', 'Calle Costa y Grijalba, 12', 38093, 0, '2020-11-01 16:00:00', 0),
(69, 4, 'Marcos', 'Hernández Brito', 'paciente46@pruebas.com', '$2y$10$/nCpFjlYT0tKj3QOI596l.qXq6dtZsjBf19rObvd2qS83lCigFs22', '1944-05-08', 'Calle General Gutiérrez, 8', 38081, 0, '2020-11-01 16:00:00', 0),
(70, 4, 'Pedro', 'Adán Pérez', 'paciente47@pruebas.com', '$2y$10$niwm9gJy1XqIw7wGgJLXzO3bBPHegv9UaUbiT/B5bzBM6OTqGfrb2', '1959-04-06', 'Calle General Gutiérrez, 43', 38056, 0, '2020-11-01 16:00:00', 0),
(71, 4, 'Raquel', 'Díaz Barreto', 'paciente48@pruebas.com', '$2y$10$AttYHXpJZqH9fIduQ.w3Fub.A0zvUWU7xVWxggUWZ9OQfdguS3Bva', '1974-08-24', 'Calle Castro, 47', 38098, 0, '2020-11-01 16:00:00', 0),
(72, 4, 'Rocío', 'Marichal Guanche', 'paciente49@pruebas.com', '$2y$10$S1G1SyB.wDGLGidpscoOsOJrW.Rvp2puYeM.ttPHjlMwczEMAZlMK', '1947-07-10', 'Calle Castro, 45', 38006, 0, '2020-11-01 16:00:00', 0),
(73, 4, 'Raquel', 'Cruz Brito', 'paciente50@pruebas.com', '$2y$10$afsqse3PF.uzZBO6VegWR.2xIfxHDWMp9lhaj72T2ZfrjOEvokCTC', '1988-09-07', 'Calle Puerta Canseco, 39', 38085, 0, '2020-11-01 16:00:00', 0),
(74, 4, 'Rita', 'Modino Mesa', 'paciente51@pruebas.com', '$2y$10$5i6kp/Cq6de11AYCoKKwSuRaNCGcBGLu7kHjTziEnaIjDXViR7jTu', '1989-01-15', 'Calle Puerta Canseco, 48', 38000, 0, '2020-11-01 16:00:00', 0),
(75, 4, 'María', 'Adán Castillo', 'paciente52@pruebas.com', '$2y$10$M6Qyvm5lD5KZJQdq2zRDW.zPAjRAB6t5AyS3lm4EzFWLeICRovD8i', '1972-05-25', 'Calle Méndez Núñez, 26', 38078, 0, '2020-11-01 16:00:00', 0),
(76, 4, 'Pedro', 'Rodríguez Alonso', 'paciente53@pruebas.com', '$2y$10$A.Q3eCQsOPZbXGxmN60i8.HjtDQWy9C.xJMI/uDMdSATEW0vhg5b2', '1972-12-28', 'Calle San Antonio, 34', 38002, 0, '2020-11-01 16:00:00', 0),
(77, 4, 'Pedro', 'Adán García', 'paciente54@pruebas.com', '$2y$10$yYiBbW.Q1TECzwL46uKqOuNZV3Az6Y9InxSFgPJiRSh/5EMGMAlYa', '1942-03-11', 'Calle Porlier, 25', 38039, 0, '2020-11-01 16:00:00', 0),
(78, 4, 'Rocío', 'Rodríguez Castillo', 'paciente55@pruebas.com', '$2y$10$hoX.TwZyRgjEqxOUhDJSUOLrbdgq1kCY2oV4LOi.4DGCoQWQpgnQK', '1969-12-13', 'Calle San Antonio, 10', 38022, 0, '2020-11-01 16:00:00', 0),
(79, 4, 'Pedro', 'Domínguez Alonso', 'paciente56@pruebas.com', '$2y$10$mprWcfuwoWpeYyhhf9TeJuBoAmHQom8t43z4KC1iSrjLhI6lQem2.', '1953-02-11', 'Calle Calvo Sotelo, 15', 38060, 0, '2020-11-01 16:00:00', 0),
(80, 4, 'María', 'Rodríguez Guanche', 'paciente57@pruebas.com', '$2y$10$TBUqg8Bx77Jpvd21bmTtfOuUWRtFK7BtmGgD33vo3lVc/2W4Fp3j.', '1950-09-16', 'Calle Castro, 7', 38067, 0, '2020-11-01 16:00:00', 0),
(81, 4, 'Teresa', 'Ravelo Pérez', 'paciente58@pruebas.com', '$2y$10$5RDUdQ6iE7lKCpVZe0WcP.rlPbtDydU0RJ0J/o147AE5sEKEoRYs2', '1959-06-04', 'Calle José Hernández Alfonso, 27', 38054, 0, '2020-11-01 16:00:00', 0),
(82, 4, 'Jorge', 'Adán Brito', 'paciente59@pruebas.com', '$2y$10$hvCVI0QlzUJJLtFF0ZvfoeXFvVodv6Dp4eDccPWtVuMfAMCbNLb.a', '1946-09-27', 'Calle Méndez Núñez, 26', 38076, 0, '2020-11-01 16:00:00', 0),
(83, 4, 'Beatriz', 'Dorta Fernández', 'paciente60@pruebas.com', '$2y$10$LV3gJ4W74hvMmVZVU2HHFeGTfCQ7X2qv9dnQzf2E2Au1Wdf1BVE3q', '1965-12-21', 'Calle Costa y Grijalba, 22', 38096, 0, '2020-11-01 16:00:00', 0),
(84, 4, 'Pedro', 'Díaz Brito', 'paciente61@pruebas.com', '$2y$10$C6wA9FUvSRiS7/FMqkV3COcgZBbliN1v6E1ZCsKsIL5JbKcn4mWIC', '1950-04-05', 'Calle Ánguel Guimerá, 24', 38014, 0, '2020-11-01 16:00:00', 0),
(85, 4, 'Jorge', 'Marichal Fernández', 'paciente62@pruebas.com', '$2y$10$hDhcxwifEHLaOvneGCVBCOeon0GuvvBjUF7jo.uTdPVBTmCXQ8EgK', '1948-05-03', 'Calle Méndez Núñez, 18', 38012, 0, '2020-11-01 16:00:00', 0),
(86, 4, 'Juan', 'Cruz Molina', 'paciente63@pruebas.com', '$2y$10$2ab50uIXp0kV8YMNhJ8Ff.9dshEzhI332x/0ehi4BBkEBLaKoSCoS', '1970-06-23', 'Calle Costa y Grijalba, 41', 38076, 0, '2020-11-01 16:00:00', 0),
(87, 4, 'Marcos', 'Modino Fernández', 'paciente64@pruebas.com', '$2y$10$8m0cjCgCJ7hMjLQMc5U4N.iooQeMS.Dll8eGTdBMZxbC./WlhSh.a', '1980-12-21', 'Calle Costa y Grijalba, 19', 38066, 0, '2020-11-01 16:00:00', 0),
(88, 4, 'Andrés', 'Díaz Barreto', 'paciente65@pruebas.com', '$2y$10$8m/ydcQ/BUBMrsfNYFlwRuwpIZzcdtrluLtZdrZ0ns/R8AQRhjaF2', '1963-08-06', 'Calle Méndez Núñez, 44', 38087, 0, '2020-11-01 16:00:00', 0),
(89, 4, 'Rocío', 'Rodríguez Mesa', 'paciente66@pruebas.com', '$2y$10$iJhKPVMqWgt.V3UQE7Sd0evuXAiWyZqrJS9mS7pePJm4Ftc9WifQe', '1979-07-19', 'Calle Méndez Núñez, 7', 38012, 0, '2020-11-01 16:00:00', 0),
(90, 4, 'Jorge', 'Domínguez Barreto', 'paciente67@pruebas.com', '$2y$10$QnnG1pD3FIE2MtrbWnrdV.OIv3NAMoROgK.JqrNNh7oX5VZxW0lF6', '1971-09-25', 'Calle Méndez Núñez, 6', 38055, 0, '2020-11-01 16:00:00', 0),
(91, 4, 'Juan', 'Hernández García', 'paciente68@pruebas.com', '$2y$10$WGYAcJ208zKnAU7/NLYUTe4hix0dzIUk4wqw1Y2j5oOxGdvRYD6Zy', '1962-07-23', 'Calle Castro, 19', 38031, 0, '2020-11-01 16:00:00', 0),
(92, 4, 'Jorge', 'Adán Castillo', 'paciente69@pruebas.com', '$2y$10$mlrH5qujhB9PDZnOGONDkeeKuN4ncG4bebrDDSW.AaSpJjpXJTvUW', '1978-06-17', 'Calle San Antonio, 46', 38010, 0, '2020-11-01 16:00:00', 0),
(93, 4, 'Beatriz', 'Dorta Molina', 'paciente70@pruebas.com', '$2y$10$OCfwSUdSDWptgmGLsXlGsOYrhMwYJvnMcfs/pTyHAPk3XKqdiq7C.', '1978-06-21', 'Calle Castro, 28', 38052, 0, '2020-11-01 16:00:00', 0),
(94, 4, 'Juan', 'Gil Fernández', 'paciente71@pruebas.com', '$2y$10$2leu6voZXOI1bkwjQh9VJuBHgnQZxqTTmJzooT1SOD1.wjcyUwFSi', '1957-10-26', 'Calle José Hernández Alfonso, 46', 38083, 0, '2020-11-01 16:00:00', 0),
(95, 4, 'Juan', 'Ravelo Brito', 'paciente72@pruebas.com', '$2y$10$C.65eO39sWyLjfCWyvRJ..VPq7AN0pGFKTBtD5bsMlQ/xXSjlh/H.', '1983-06-04', 'Calle Porlier, 10', 38043, 0, '2020-11-01 16:00:00', 0),
(96, 4, 'Beatriz', 'Adán Brito', 'paciente73@pruebas.com', '$2y$10$8aNUaFUCI8minKpSA/wg3uMpUilEmomBjymsBo4NmeED5txdty3km', '1966-03-05', 'Calle Castro, 29', 38089, 0, '2020-11-01 16:00:00', 0),
(97, 4, 'Marcos', 'Dorta Fernández', 'paciente74@pruebas.com', '$2y$10$HscNmpQNzuj35P5Ce/fzAu.rRbxe6Re9Djtjm1/ij3Cx.XjO5fsg.', '1942-07-28', 'Calle Costa y Grijalba, 12', 38027, 0, '2020-11-01 16:00:00', 0),
(98, 4, 'Jorge', 'Soto González', 'paciente75@pruebas.com', '$2y$10$DUqnohWvO1mDbg0ah13X6eq4v7lRUpduo.6FFYcgmgT2Y345zQ9Zq', '1986-06-19', 'Calle Ánguel Guimerá, 16', 38065, 0, '2020-11-01 16:00:00', 0),
(99, 4, 'Teresa', 'Gil González', 'paciente76@pruebas.com', '$2y$10$ErCLtYNdpUuJO/lqTAifA.HB1d0ClQLGzTlfzujz/EjmT.GN0Bn1a', '1941-10-26', 'Calle Castro, 18', 38078, 0, '2020-11-01 16:00:00', 0),
(100, 4, 'Jorge', 'Ravelo García', 'paciente77@pruebas.com', '$2y$10$JE9g/rS8Gu2P3sO9UvZH7eoSFapIfGQ4hKzPGDOvQ6.9oi2moHKsS', '1971-09-17', 'Calle Porlier, 28', 38029, 0, '2020-11-01 16:00:00', 0),
(101, 4, 'Rita', 'Ravelo García', 'paciente78@pruebas.com', '$2y$10$jXKK9Qw3RTkuplVj1jmaAe4xaBW9d8mBifHs42/GWabxc2zs52gCS', '1984-07-01', 'Calle José Hernández Alfonso, 20', 38004, 0, '2020-11-01 16:00:00', 0),
(102, 4, 'Beatriz', 'Ravelo Mesa', 'paciente79@pruebas.com', '$2y$10$epa7W6mroxq2SJB2bzezaeoJvywIjeDh.MreQOFQha8i1x7wjeyci', '1956-05-20', 'Calle Castro, 36', 38035, 0, '2020-11-01 16:00:00', 0),
(103, 4, 'Raquel', 'Adán González', 'paciente80@pruebas.com', '$2y$10$BKxj0SUVq.4coC8KMboaHuCVp0AG9kxjsptZ5aSjswpxgEtvTjm/W', '1942-03-27', 'Calle Ánguel Guimerá, 22', 38059, 0, '2020-11-01 16:00:00', 0),
(104, 4, 'Teresa', 'Díaz Guanche', 'paciente81@pruebas.com', '$2y$10$o6yxWaZdNVdsQ/EZeRc60.aw3CXcYv/l6SUWBkKxiUtg39Dm/ucG6', '1972-05-14', 'Calle San Antonio, 12', 38049, 0, '2020-11-01 16:00:00', 0),
(105, 4, 'Pedro', 'Rodríguez González', 'paciente82@pruebas.com', '$2y$10$b/OT4choHvDnhAzUw6z9KOqe1AJhbeXWrecDwnXJPDWegNR.bYorS', '1990-01-07', 'Calle General Gutiérrez, 31', 38076, 0, '2020-11-01 16:00:00', 0),
(106, 4, 'Pedro', 'Rodríguez Mesa', 'paciente83@pruebas.com', '$2y$10$pFjMjVGCoqcFV6L6NY84sunAkiFDeNGgGcqN6prqXn9knBdamKQB.', '1987-01-22', 'Calle San Antonio, 20', 38015, 0, '2020-11-01 16:00:00', 0),
(107, 4, 'Juan', 'Marichal González', 'paciente84@pruebas.com', '$2y$10$CdegLmmeDDw4bX.qcKcEQuw7SQNREVeSbsSZD3uwxhKTfrmbevTNm', '1935-10-27', 'Calle San Antonio, 15', 38001, 0, '2020-11-01 16:00:00', 0),
(108, 4, 'Beatriz', 'Ravelo Mesa', 'paciente85@pruebas.com', '$2y$10$dK9l5i4yeK14Qgtl1Zn/kebJg6sZ6/aGWDHimr.jSvU2fCKOFo7zG', '1947-01-15', 'Calle Puerta Canseco, 26', 38014, 0, '2020-11-01 16:00:00', 0),
(109, 4, 'Juan', 'Adán Brito', 'paciente86@pruebas.com', '$2y$10$nZmRPsWkfTkHib98eQbHS.OojEEkPq.QYyjA3NSGXNzHDr2DBMy6.', '1948-01-28', 'Calle General Gutiérrez, 7', 38058, 0, '2020-11-01 16:00:00', 0),
(110, 4, 'Pedro', 'Dorta Molina', 'paciente87@pruebas.com', '$2y$10$6MTrJ542MxAlwvrQbqnti.r9zkVDvQdhiyIy21l/l2KEBRLNAYWDe', '1969-12-12', 'Calle Ánguel Guimerá, 39', 38027, 0, '2020-11-01 16:00:00', 0),
(111, 4, 'Rocío', 'Dorta Brito', 'paciente88@pruebas.com', '$2y$10$FCV.s8kJkWkoOiRG1ABNruqFveq2GZQ7XkTGu9HTymWBxFkzauFEG', '1961-01-13', 'Calle Puerta Canseco, 43', 38062, 0, '2020-11-01 16:00:00', 0),
(112, 4, 'Marcos', 'Adán Castillo', 'paciente89@pruebas.com', '$2y$10$0sZVCQukFnjxTEBGMIoUH.BtFSFJtv4VjwXEGbyo/h/c6TA1Va5ZO', '1939-12-12', 'Calle Costa y Grijalba, 47', 38066, 0, '2020-11-01 16:00:00', 0),
(113, 4, 'Raquel', 'Rodríguez Castillo', 'paciente90@pruebas.com', '$2y$10$lxIoTZv2vecAAWVm00cRSejtyeke/ghn0zIcOVVeY/zP8245069L6', '1945-08-22', 'Calle José Hernández Alfonso, 44', 38004, 0, '2020-11-01 16:00:00', 0),
(114, 4, 'Rita', 'Díaz González', 'paciente91@pruebas.com', '$2y$10$hc3G8a9pjo89BdRUnu89OOwZvWtezXmtEgFdmXLVXprBKJphK72e2', '1954-03-25', 'Calle Castro, 17', 38080, 0, '2020-11-01 16:00:00', 0),
(115, 4, 'Rocío', 'Dorta Molina', 'paciente92@pruebas.com', '$2y$10$f74dP1w8wddNM78zFl.T9.ILT9wDX/ReN9WragXIB298B6VE60qeG', '1974-11-13', 'Calle Castro, 16', 38058, 0, '2020-11-01 16:00:00', 0),
(116, 4, 'Jorge', 'Hernández Fernández', 'paciente93@pruebas.com', '$2y$10$C1cokmaJFAbuKSx.xlnyQuYBl9Ga2bV805GKX8ByhCbLf6otoxrqm', '1959-09-24', 'Calle San Antonio, 42', 38061, 0, '2020-11-01 16:00:00', 0),
(117, 4, 'Beatriz', 'Cruz Molina', 'paciente94@pruebas.com', '$2y$10$/vaInncD8crhiOswLf2FW..SZrnmd0/M24M0FGos1edYekz7NXwke', '1975-12-17', 'Calle Calvo Sotelo, 45', 38068, 0, '2020-11-01 16:00:00', 0),
(118, 4, 'Rita', 'Modino González', 'paciente95@pruebas.com', '$2y$10$0VlFBxZN1ps3v6efhr9nNeM9XkCADaAEDc08pYUjsW1E8uIiyqH1C', '1976-03-24', 'Calle Castro, 15', 38076, 0, '2020-11-01 16:00:00', 0),
(119, 4, 'Beatriz', 'Soto Barreto', 'paciente96@pruebas.com', '$2y$10$TNkC9TpRzH8xIqET0I.rYuH3LemcUr.XAaz.ECJjMUv6he3jHXsuK', '1943-08-21', 'Calle San Antonio, 41', 38002, 0, '2020-11-01 16:00:00', 0),
(120, 4, 'Rubén', 'Hernández Mesa', 'paciente97@pruebas.com', '$2y$10$/j3DvBmzlmNBUCktacN5X.psWLY3yLG2q6Q/WgL8oEGxVKdZ7.Qo2', '1987-01-09', 'Calle Ánguel Guimerá, 32', 38069, 0, '2020-11-01 16:00:00', 0),
(121, 4, 'Rocío', 'Gil Pérez', 'paciente98@pruebas.com', '$2y$10$lZph4lL8Ixq9plGS/2rMGuXId0WmgsENrLU6Cf9Dz0AR71xNPcqp.', '1987-05-27', 'Calle Méndez Núñez, 47', 38052, 0, '2020-11-01 16:00:00', 0),
(122, 4, 'Rita', 'Cruz Pérez', 'paciente99@pruebas.com', '$2y$10$CJgv4l6.ss1cHQEary9I4ecpe6t6GUUSpyICoKY5ubxtsqg0i5Viu', '1987-04-01', 'Calle San Antonio, 12', 38054, 0, '2020-11-01 16:00:00', 0),
(123, 4, 'Raquel', 'Díaz Fernández', 'paciente100@pruebas.com', '$2y$10$SRuV5aTpstbARvScSHQ.p.wX/VG9sh7.vcaVDoNTgZBNh4GRL.H5W', '1961-02-28', 'Calle Méndez Núñez, 7', 38066, 0, '2020-11-01 16:00:00', 0),
(131, 2, 'Francisco Javier', 'Melchior', 'jmelchior@pruebas.com', '$2y$10$p7spd9wEi3L/3DSAHIMX8uTKP2mBMQI9oUwrQjnUUi063umg5dWQ6', '1985-11-14', 'Probando', 123654, 0, '2020-11-12 17:29:49', 0),
(132, 2, 'PEPE', 'PEPE', 'pepe@pruebas.com', '$2y$10$8va6WiebLVEL7MOLFZ8pXuPhhxfej5wd59T5NTW4NpbysXMXiv9z6', '1980-01-01', 'calle cañamo', 38107, 0, '2020-11-21 12:35:31', 0),
(133, 2, 'Jose', 'Espinel', 'medico@pruebas.com', '$2y$10$XsDRwvkaNcBM00LKemI.7uxnW7dz/neL5R61TxDeyCVgOoDbmHEAi', '1980-01-05', 'calle bla bla', 38108, 0, '2020-11-25 21:02:02', 0),
(134, 4, 'pepito', 'rodriguez', 'rodri@pruebas.com', '$2y$10$yM3Yuu9qEj62AMNwJuzyDeXQFHwvdaIijIzU6j3Y/KSDBCmPFePay', '1995-01-05', 'calle pepe', 38107, 0, '2020-11-25 21:05:24', 0),
(136, 4, 'Juan', 'Gomez', 'ebere@gmail.com', '$2y$10$BrppaXdrJth3db3R.IW.L.WBzD80Ej.o5nXMJ8qsayAbFbCV/6btq', '1980-01-02', 'calle', 3545, 0, '2020-11-25 21:15:06', 0),
(137, 4, 'Adrian', 'Balboa', 'balbi@gmai.com', '$2y$10$crIJ.on/c8bzjZyItAKCpOqbL3Qvp89Kr9FH.xUaKDrE4mWuaTLGS', '1990-01-02', 'calle', 0, 0, '2020-11-25 21:17:25', 0),
(138, 4, 'Jose', 'Espinel', 'jose@gmail.com', '$2y$10$86AbAyFZvMB4ZfRhLCTyvuv4Q/oi1HeZ1LVyoVw58J8WS5N1M2sFO', '1995-01-01', 'calle', 0, 0, '2020-11-25 21:23:39', 0),
(139, 4, 'maria', 'db', 'db@gmail.com', '$2y$10$YGuOU/RxS3a8KxihQRJnce6jgNGJii69Sx/WTTipK5VS8VFxLc0zO', '1988-05-09', 'cp', 123456, 0, '2020-11-25 21:27:37', 0),
(140, 4, 'Carmen', 'Espinel', 'carmen@gmail.com', '$2y$10$5iWT0vcqJDwUkfyHIPY0w.sLjv4GJOQjCbndYQLN3kGAapuHQE0tq', '1980-05-05', 'calle carmen', 354524, 0, '2020-11-25 21:37:06', 0),
(141, 2, 'Alberto', 'Joraba', 'albert@gmail.com', '$2y$10$5CeobaeGLsQOGeHxCc9Ls.XfrpVyaLTFHzhlNxMtZL4a9a61FUzwC', '2000-01-05', 'calle flu', 38105, 0, '2020-12-01 22:40:03', 0),
(142, 4, 'paciente1', 'paciente', 'paciente1@probando.com', '$2y$10$imL.267ZRPhSm2DiC.E2pO5.dYvhRSEGNh9BzWrg26.wlCRBoi4he', '1990-01-05', 'calle paciente', 38108, 0, '2020-12-05 13:03:19', 0),
(143, 4, 'Jose', 'Espinel', 'jose1@pruebas.com', '$2y$10$fM38drJJzWaZWkkcjXeA2e5v25h2eK5zPRb8Lk.8/WjbMIrwBesHu', '1990-01-01', 'Calle direccion', 38108, 0, '2020-12-06 13:20:34', 0),
(144, 4, 'ALbert', 'Albert', 'albert@pruebas.com', 'Probando', '2020-12-01', 'calle bla', 38108, 0, '0000-00-00 00:00:00', 0),
(145, 4, 'alberto', 'alberto', 'alberto@gmail.com', '$2y$10$cU3juuwVBhb1lI302k0an.6eKH3AtPwrhmy0zBdkQxrYE/RESYyrO', '1990-01-01', 'calle', 38108, 0, '2020-12-06 13:51:40', 0),
(146, 2, 'ewterwterw', 'ewrterwtewtewterwterwt', '', '$2y$10$IxlozPolY0ZZjIvknB5pDefHk/Djq/Zudo8y8DcweZm904OQAxOaW', '0000-00-00', '', 0, 0, '2020-12-06 19:48:25', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centros_salud`
--
ALTER TABLE `centros_salud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cupos`
--
ALTER TABLE `cupos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enfermeros`
--
ALTER TABLE `enfermeros`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numColegiado` (`numColegiado`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numColegiado` (`numColegiado`);

--
-- Indexes for table `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permisos_web`
--
ALTER TABLE `permisos_web`
  ADD PRIMARY KEY (`idRol`,`nombreWeb`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `centros_salud`
--
ALTER TABLE `centros_salud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `cupos`
--
ALTER TABLE `cupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
