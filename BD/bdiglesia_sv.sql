-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-09-2022 a las 19:33:39
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdiglesia_sv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedentes`
--

CREATE TABLE `antecedentes` (
  `id_ant` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `alergias_ant` text NOT NULL,
  `enfermedades_ant` text NOT NULL,
  `vacunas_ant` text NOT NULL,
  `quirurgico_ant` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `antecedentes`
--

INSERT INTO `antecedentes` (`id_ant`, `id_paciente`, `alergias_ant`, `enfermedades_ant`, `vacunas_ant`, `quirurgico_ant`) VALUES
(1, 1, '', '', '', ''),
(2, 2, '', '', '', ''),
(3, 1, '', '', '', ''),
(4, 2, '', '', '', ''),
(5, 3, '', '', '', ''),
(6, 2, '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id_asistencia` int(11) NOT NULL,
  `celula_id` int(11) NOT NULL,
  `hermanos` int(11) NOT NULL,
  `amigos` int(11) NOT NULL,
  `ninos` int(11) NOT NULL,
  `ofrenda` double NOT NULL,
  `conv` int(11) NOT NULL,
  `recon` int(11) NOT NULL,
  `bautismos` int(11) NOT NULL,
  `seminarista` int(11) NOT NULL,
  `ast_iglesia` int(11) NOT NULL,
  `estado_ast` int(11) NOT NULL,
  `users` int(11) NOT NULL,
  `fecha_add` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id_asistencia`, `celula_id`, `hermanos`, `amigos`, `ninos`, `ofrenda`, `conv`, `recon`, `bautismos`, `seminarista`, `ast_iglesia`, `estado_ast`, `users`, `fecha_add`) VALUES
(1, 1, 15, 12, 12, 12, 0, 0, 0, 0, 0, 0, 1, '2022-02-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id_autor` int(11) NOT NULL,
  `autor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`id_autor`, `autor`) VALUES
(1, 'AUTOR 1'),
(2, 'AUTOR 2'),
(3, 'AUTOR 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bienes`
--

CREATE TABLE `bienes` (
  `id_bienes` int(11) NOT NULL,
  `nombre_bienes` varchar(255) NOT NULL,
  `descripcion_bienes` text NOT NULL,
  `serie_bienes` varchar(50) NOT NULL,
  `modelo_bienes` varchar(50) NOT NULL,
  `color_bienes` varchar(25) NOT NULL,
  `estado_bienes` int(11) NOT NULL,
  `status_bienes` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `id_cargo` int(11) NOT NULL,
  `nombre_cargo` varchar(255) CHARACTER SET utf8 NOT NULL,
  `estado_cargo` varchar(11) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`id_cargo`, `nombre_cargo`, `estado_cargo`) VALUES
(6, 'prueba', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL,
  `descripcion_categoria` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_libro`
--

CREATE TABLE `cat_libro` (
  `id_cat` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cat_libro`
--

INSERT INTO `cat_libro` (`id_cat`, `categoria`) VALUES
(1, 'CATEGORIA 1'),
(2, 'CATEGORIA 2'),
(3, 'CATEGORIA 3'),
(4, 'CATEGORIA 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `celulas`
--

CREATE TABLE `celulas` (
  `id_celula` int(11) NOT NULL,
  `nombre_cel` varchar(150) NOT NULL,
  `sector_cel` varchar(100) NOT NULL,
  `supervisor_cel` int(11) NOT NULL,
  `lider_cel` int(11) NOT NULL,
  `anfitrion_cel` varchar(150) NOT NULL,
  `grupo_cel` int(11) NOT NULL,
  `estado_cel` int(11) NOT NULL,
  `fecha_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `celulas`
--

INSERT INTO `celulas` (`id_celula`, `nombre_cel`, `sector_cel`, `supervisor_cel`, `lider_cel`, `anfitrion_cel`, `grupo_cel`, `estado_cel`, `fecha_added`) VALUES
(1, 'CELLULA 1', 'P0012', 1, 1, 'ANA MARIA', 1, 1, '2022-02-13 09:43:56'),
(2, 'CELLULA 1', 'P0012', 1, 1, 'PAOLA MICHELL', 2, 1, '2022-02-13 09:59:29'),
(3, 'CELULA 3', 'PC45750', 1, 1, 'prueba de  un anfitrion ', 3, 1, '2022-02-13 10:02:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `precision` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thousand_separator` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `decimal_separator` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `precision`, `thousand_separator`, `decimal_separator`, `code`) VALUES
(1, 'US Dollar', '$', '2', ',', '.', 'USD'),
(2, 'Libra Esterlina', '&pound;', '2', ',', '.', 'GBP'),
(3, 'Euro', 'â‚¬', '2', '.', ',', 'EUR'),
(4, 'South African Rand', 'R', '2', '.', ',', 'ZAR'),
(5, 'Danish Krone', 'kr ', '2', '.', ',', 'DKK'),
(6, 'Israeli Shekel', 'NIS ', '2', ',', '.', 'ILS'),
(7, 'Swedish Krona', 'kr ', '2', '.', ',', 'SEK'),
(8, 'Kenyan Shilling', 'KSh ', '2', ',', '.', 'KES'),
(9, 'Canadian Dollar', 'C$', '2', ',', '.', 'CAD'),
(10, 'Philippine Peso', 'P ', '2', ',', '.', 'PHP'),
(11, 'Indian Rupee', 'Rs. ', '2', ',', '.', 'INR'),
(12, 'Australian Dollar', '$', '2', ',', '.', 'AUD'),
(13, 'Singapore Dollar', 'SGD ', '2', ',', '.', 'SGD'),
(14, 'Norske Kroner', 'kr ', '2', '.', ',', 'NOK'),
(15, 'New Zealand Dollar', '$', '2', ',', '.', 'NZD'),
(16, 'Vietnamese Dong', 'VND ', '0', '.', ',', 'VND'),
(17, 'Swiss Franc', 'CHF ', '2', '\'', '.', 'CHF'),
(18, 'Quetzal Guatemalteco', 'Q', '2', ',', '.', 'GTQ'),
(19, 'Malaysian Ringgit', 'RM', '2', ',', '.', 'MYR'),
(20, 'Real Brasile&ntilde;o', 'R$', '2', '.', ',', 'BRL'),
(21, 'Thai Baht', 'THB ', '2', ',', '.', 'THB'),
(22, 'Nigerian Naira', 'NGN ', '2', ',', '.', 'NGN'),
(23, 'Peso Argentino', '$', '2', '.', ',', 'ARS'),
(24, 'Bangladeshi Taka', 'Tk', '2', ',', '.', 'BDT'),
(25, 'United Arab Emirates Dirham', 'DH ', '2', ',', '.', 'AED'),
(26, 'Hong Kong Dollar', '$', '2', ',', '.', 'HKD'),
(27, 'Indonesian Rupiah', 'Rp', '2', ',', '.', 'IDR'),
(28, 'Peso Mexicano', '$', '2', ',', '.', 'MXN'),
(29, 'Egyptian Pound', '&pound;', '2', ',', '.', 'EGP'),
(30, 'Peso Colombiano', '$', '2', '.', ',', 'COP'),
(31, 'West African Franc', 'CFA ', '2', ',', '.', 'XOF'),
(32, 'Chinese Renminbi', 'RMB ', '2', ',', '.', 'CNY');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `curso` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `estado_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devociones`
--

CREATE TABLE `devociones` (
  `id_dev` int(11) NOT NULL,
  `evento_dev` varchar(50) NOT NULL,
  `fecha_dev` date NOT NULL,
  `varones_dev` int(11) NOT NULL,
  `hembras_dev` int(11) NOT NULL,
  `ninos_dev` int(11) NOT NULL,
  `total_dev` int(11) NOT NULL,
  `ofrenda_dev` double NOT NULL,
  `conv_dev` int(11) NOT NULL,
  `rec_dev` int(11) NOT NULL,
  `bautismos_dev` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `devociones`
--

INSERT INTO `devociones` (`id_dev`, `evento_dev`, `fecha_dev`, `varones_dev`, `hembras_dev`, `ninos_dev`, `total_dev`, `ofrenda_dev`, `conv_dev`, `rec_dev`, `bautismos_dev`) VALUES
(1, 'CULTO', '2022-02-13', 74, 50, 18, 142, 13, 0, 0, 0),
(3, 'CULTO', '2022-01-31', 60, 45, 0, 105, 45.59, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editoriales`
--

CREATE TABLE `editoriales` (
  `id_editorial` int(11) NOT NULL,
  `editorial` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `editoriales`
--

INSERT INTO `editoriales` (`id_editorial`, `editorial`) VALUES
(1, 'EDITORIAL 1'),
(2, 'EDITORIAL 2'),
(3, 'EDITORIAL 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egresos`
--

CREATE TABLE `egresos` (
  `id_egreso` int(11) NOT NULL,
  `referencia_egreso` varchar(100) NOT NULL,
  `monto` double NOT NULL,
  `descripcion_egreso` text NOT NULL,
  `tipo_egreso` int(11) NOT NULL,
  `fecha_added` date NOT NULL,
  `fecha` datetime NOT NULL,
  `users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familias`
--

CREATE TABLE `familias` (
  `id_familia` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `familias`
--

INSERT INTO `familias` (`id_familia`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'PRUEBA DE FAMILIA', 'PRUEBA DE FAMILIA', 1),
(2, 'DEFAULT', 'DEFAULT', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id_ingreso` int(11) NOT NULL,
  `ref_ingreso` varchar(25) NOT NULL,
  `obs_ingreso` varchar(255) NOT NULL,
  `miembro_id` int(11) NOT NULL,
  `monto` double NOT NULL,
  `tipo_ingreso` int(11) NOT NULL,
  `pago_ingreso` int(11) NOT NULL,
  `fecha_added` date NOT NULL,
  `fecha` datetime NOT NULL,
  `users` int(11) NOT NULL,
  `cod_ingreso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id_ingreso`, `ref_ingreso`, `obs_ingreso`, `miembro_id`, `monto`, `tipo_ingreso`, `pago_ingreso`, `fecha_added`, `fecha`, `users`, `cod_ingreso`) VALUES
(1, 'OFD-000001', '', 1, 50, 4, 1, '2022-02-13', '2022-02-13 21:12:15', 1, 1),
(2, 'OFD-000002', '', 2, 50, 2, 1, '2022-04-28', '2022-04-28 17:36:26', 1, 1),
(3, 'OFD-000003', '', 2, 75, 3, 1, '2022-04-28', '2022-04-28 17:55:58', 1, 1),
(4, 'OFD-000004', '', 2, 150, 1, 1, '2022-05-05', '2022-04-28 21:15:08', 1, 1),
(5, 'OFD-000005', '', 2, 85, 4, 1, '2022-03-10', '2022-04-28 21:29:20', 1, 1),
(6, 'OFD-000006', '', 2, 150, 2, 1, '2022-04-29', '2022-04-29 09:45:44', 1, 2),
(7, 'OFD-000007', '', 1, 175, 1, 1, '2022-04-29', '2022-04-29 09:46:37', 1, 2),
(8, 'OFD-000008', '', 2, 150, 6, 1, '2022-06-16', '2022-06-16 10:17:43', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libros` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `fecha_lanzamiento` date NOT NULL,
  `autor_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `editorial_id` int(11) NOT NULL,
  `idioma` varchar(25) NOT NULL,
  `paginas` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libros`, `titulo`, `fecha_lanzamiento`, `autor_id`, `cat_id`, `editorial_id`, `idioma`, `paginas`, `descripcion`, `estado`) VALUES
(1, 'LIBRO UNO 1', '2022-05-25', 1, 2, 3, 'ENG', 200, 'ESTA ES UNA PRUBA DE DATOS', 1),
(3, 'LIBRO DOS 2', '2022-05-26', 2, 3, 1, 'ESPANIOL', 160, 'ESTA ES UNA PRUEBA DE DATOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros`
--

CREATE TABLE `miembros` (
  `id_miembro` int(11) NOT NULL,
  `nombre_miembro` varchar(255) NOT NULL,
  `apellido_miembro` varchar(255) NOT NULL,
  `direccion_miembro` text NOT NULL,
  `ciudad_miembro` varchar(255) NOT NULL,
  `celular_miembro` varchar(15) NOT NULL,
  `telefono_miembro` varchar(50) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `estudio_miembro` int(11) NOT NULL,
  `cargo_miembro` int(11) NOT NULL,
  `civil_miembro` int(11) NOT NULL,
  `documento_miembro` varchar(50) NOT NULL,
  `email_miembro` varchar(255) NOT NULL,
  `sexo_miembro` int(11) NOT NULL,
  `estado_miembro` int(11) NOT NULL,
  `date_addedd` datetime NOT NULL,
  `familia_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `miembros`
--

INSERT INTO `miembros` (`id_miembro`, `nombre_miembro`, `apellido_miembro`, `direccion_miembro`, `ciudad_miembro`, `celular_miembro`, `telefono_miembro`, `fecha_nacimiento`, `estudio_miembro`, `cargo_miembro`, `civil_miembro`, `documento_miembro`, `email_miembro`, `sexo_miembro`, `estado_miembro`, `date_addedd`, `familia_id`) VALUES
(1, 'VARIOS', 'MIEMBROS', 'COL. DE PRUEBA DE DATOS', '', '00000', '454515015', '2018-09-27', 7, 16, 2, '00000', 'iglesia@gmail.com', 0, 1, '2021-09-27 10:15:54', 2),
(2, 'JUAN CARLOS ', 'LOPEZ PEREZ', 'COL. DE PRUEBA DE DATOS', 'SAN MIGUEL', '7897879', '854 12 31 23', '2022-04-28', 4, 7, 1, '00122400-4', 'delmaramon@gmail.com', 1, 1, '2022-04-28 17:35:17', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL,
  `nombre_modulo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `nombre_modulo`) VALUES
(1, 'Inicio'),
(2, 'Miembros'),
(3, 'Tesorerias'),
(4, 'Eventos'),
(5, 'Reportes'),
(6, 'Configuracion'),
(7, 'Grupos'),
(8, 'Usuarios'),
(9, 'Bienes y Muebles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `nombre_empresa` varchar(150) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(100) NOT NULL,
  `codigo_postal` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(64) NOT NULL,
  `impuesto` int(2) NOT NULL,
  `moneda` varchar(6) NOT NULL,
  `logo_url` varchar(255) NOT NULL,
  `default_miembro_id` int(11) NOT NULL,
  `ruc` varchar(25) NOT NULL,
  `acuerdo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `nombre_empresa`, `direccion`, `ciudad`, `codigo_postal`, `estado`, `country`, `telefono`, `email`, `impuesto`, `moneda`, `logo_url`, `default_miembro_id`, `ruc`, `acuerdo`) VALUES
(1, 'IGLESIA BUENAS NUEVAS', 'Santiago de María, El Salvador', 'Santiago de María', '503', 'Usulután', 'El Salvador', '79025550', 'delmaramon@gmail.com', 13, '$', '../../img/1641696356_Logo.jpg', 3, '09926243020001', '1264');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receta_medica`
--

CREATE TABLE `receta_medica` (
  `id_receta` int(11) NOT NULL,
  `id_consulta` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `medicamento_receta` int(11) NOT NULL,
  `indicacion_receta` varchar(255) NOT NULL,
  `users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `receta_medica`
--

INSERT INTO `receta_medica` (`id_receta`, `id_consulta`, `id_paciente`, `medicamento_receta`, `indicacion_receta`, `users`) VALUES
(1, 1, 14, 12, 'prueba de medicamento uno x', 0),
(2, 1, 14, 8, 'prueba de medicamento uno xx', 0),
(3, 1, 14, 15, 'prueba de medicamento uno xxx', 0),
(4, 1, 14, 11, 'prueba de medicamento uno xxxx', 0),
(5, 2, 3, 13, 'Prueba de med dos x', 0),
(6, 2, 3, 16, 'Prueba de med dos xx', 0),
(7, 2, 3, 9, 'Prueba de med dos xxx', 0),
(8, 2, 3, 2, 'Prueba de med dos xxxx', 0),
(9, 2, 3, 10, 'Prueba de med dos xxxxx', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seminarios`
--

CREATE TABLE `seminarios` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(7) DEFAULT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `seminarios`
--

INSERT INTO `seminarios` (`id`, `title`, `color`, `start`, `end`, `id_users`) VALUES
(1, 'Prueba de Seminario', '#008000', '2022-06-08 00:00:00', '2022-06-22 00:00:00', 1),
(2, 'Prueba dos', '#FF8C00', '2022-06-15 00:00:00', '2022-06-16 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_gasto`
--

CREATE TABLE `tipo_gasto` (
  `id_tipo` int(11) NOT NULL,
  `nombre_tipo` varchar(255) NOT NULL,
  `descripcion_tipo` text NOT NULL,
  `estado_tipo` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_gasto`
--

INSERT INTO `tipo_gasto` (`id_tipo`, `nombre_tipo`, `descripcion_tipo`, `estado_tipo`, `date_added`) VALUES
(1, 'ENERGIA ELECTRICA', '', 1, '2021-09-27 11:34:18'),
(2, 'COMBUSTIBLE', '', 1, '2021-09-27 11:34:31'),
(3, 'MERIENDAS', '', 1, '2021-09-27 11:34:40'),
(4, 'LIMPIEZA', '', 1, '2021-09-27 11:34:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_ingreso`
--

CREATE TABLE `tipo_ingreso` (
  `id_tipoi` int(11) NOT NULL,
  `nombre_tipoi` varchar(255) NOT NULL,
  `descripcion_tipoi` text NOT NULL,
  `estado_tipoi` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipo_ingreso`
--

INSERT INTO `tipo_ingreso` (`id_tipoi`, `nombre_tipoi`, `descripcion_tipoi`, `estado_tipoi`, `date_added`) VALUES
(1, 'PRO TEMPLO', '', 1, '2021-09-27 10:08:55'),
(2, 'MISIONES', '', 1, '2021-09-27 10:09:00'),
(3, 'ESCUELA DOMINICAL', '', 1, '2021-09-27 10:09:11'),
(4, 'ENFERMOS', '', 1, '2021-09-27 10:09:21'),
(5, 'TRANSPORTE', '', 1, '2021-09-27 10:09:40'),
(6, 'GENERA', 'PARA USOS MULTIPLES', 1, '2021-09-27 10:17:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `nombre_users` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `apellido_users` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `usuario_users` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `con_users` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `email_users` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `tipo_users` tinyint(4) NOT NULL,
  `cargo_users` int(11) NOT NULL,
  `sucursal_users` tinyint(4) NOT NULL,
  `date_added_users` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_users`, `nombre_users`, `apellido_users`, `usuario_users`, `con_users`, `email_users`, `tipo_users`, `cargo_users`, `sucursal_users`, `date_added_users`) VALUES
(1, 'Super', 'administrador', 'admin', '$2y$10$MPVHzZ2ZPOWmtUUGCq3RXu31OTB.jo7M9LZ7PmPQYmgETSNn19ejO', 'root@admin.com', 0, 1, 0, '2016-05-21 15:06:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_group`
--

CREATE TABLE `user_group` (
  `user_group_id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `permission` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_group`
--

INSERT INTO `user_group` (`user_group_id`, `name`, `permission`, `date_added`) VALUES
(1, 'Super Administrador', 'Inicio,1,1,1;Miembros,1,1,1;Tesorerias,1,1,1;Eventos,1,1,1;Reportes,1,1,1;Configuracion,1,1,1;Grupos,1,1,1;Usuarios,1,1,1;Bienes y Muebles,1,1,1;', '2017-09-05 10:00:48'),
(2, 'TESORERO', 'Inicio,0,0,0;Miembros,0,0,0;Tesorerias,1,1,0;Eventos,0,0,0;Reportes,1,1,0;Configuracion,0,0,0;Grupos,0,0,0;Usuarios,0,0,0;Bienes y Muebles,0,0,0;', '2018-01-27 10:41:01'),
(3, 'SECRETARIA', 'Inicio,0,0,0;Miembros,1,1,0;Tesorerias,0,0,0;Eventos,1,1,1;Reportes,0,0,0;Configuracion,0,0,0;Grupos,0,0,0;Usuarios,0,0,0;Bienes y Muebles,0,0,0;', '2018-01-27 10:41:20');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antecedentes`
--
ALTER TABLE `antecedentes`
  ADD PRIMARY KEY (`id_ant`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id_asistencia`);

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id_autor`);

--
-- Indices de la tabla `bienes`
--
ALTER TABLE `bienes`
  ADD PRIMARY KEY (`id_bienes`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `cat_libro`
--
ALTER TABLE `cat_libro`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `celulas`
--
ALTER TABLE `celulas`
  ADD PRIMARY KEY (`id_celula`);

--
-- Indices de la tabla `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `devociones`
--
ALTER TABLE `devociones`
  ADD PRIMARY KEY (`id_dev`);

--
-- Indices de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  ADD PRIMARY KEY (`id_editorial`);

--
-- Indices de la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD PRIMARY KEY (`id_egreso`),
  ADD KEY `users` (`users`);

--
-- Indices de la tabla `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `familias`
--
ALTER TABLE `familias`
  ADD PRIMARY KEY (`id_familia`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id_ingreso`),
  ADD KEY `users` (`users`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libros`);

--
-- Indices de la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD PRIMARY KEY (`id_miembro`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `receta_medica`
--
ALTER TABLE `receta_medica`
  ADD PRIMARY KEY (`id_receta`),
  ADD KEY `id_consulta` (`id_consulta`),
  ADD KEY `id_paciente` (`id_paciente`),
  ADD KEY `users` (`users`),
  ADD KEY `users_2` (`users`),
  ADD KEY `medicamento_receta` (`medicamento_receta`),
  ADD KEY `users_3` (`users`);

--
-- Indices de la tabla `seminarios`
--
ALTER TABLE `seminarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_gasto`
--
ALTER TABLE `tipo_gasto`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `tipo_ingreso`
--
ALTER TABLE `tipo_ingreso`
  ADD PRIMARY KEY (`id_tipoi`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `user_name` (`usuario_users`),
  ADD UNIQUE KEY `user_email` (`email_users`),
  ADD KEY `cargo_users` (`cargo_users`);

--
-- Indices de la tabla `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`user_group_id`),
  ADD KEY `user_group_id` (`user_group_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antecedentes`
--
ALTER TABLE `antecedentes`
  MODIFY `id_ant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `id_autor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `bienes`
--
ALTER TABLE `bienes`
  MODIFY `id_bienes` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cat_libro`
--
ALTER TABLE `cat_libro`
  MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `celulas`
--
ALTER TABLE `celulas`
  MODIFY `id_celula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `devociones`
--
ALTER TABLE `devociones`
  MODIFY `id_dev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  MODIFY `id_editorial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `egresos`
--
ALTER TABLE `egresos`
  MODIFY `id_egreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `familias`
--
ALTER TABLE `familias`
  MODIFY `id_familia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libros` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id_miembro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `receta_medica`
--
ALTER TABLE `receta_medica`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `seminarios`
--
ALTER TABLE `seminarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_gasto`
--
ALTER TABLE `tipo_gasto`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_ingreso`
--
ALTER TABLE `tipo_ingreso`
  MODIFY `id_tipoi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `user_group`
--
ALTER TABLE `user_group`
  MODIFY `user_group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `egresos`
--
ALTER TABLE `egresos`
  ADD CONSTRAINT `egresos_ibfk_1` FOREIGN KEY (`users`) REFERENCES `users` (`id_users`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`cargo_users`) REFERENCES `user_group` (`user_group_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
