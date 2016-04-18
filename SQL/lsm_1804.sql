-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-04-2016 a las 00:56:53
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `lsm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `categoriaID` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` text NOT NULL,
  PRIMARY KEY (`categoriaID`) USING BTREE,
  KEY `categoriaID` (`categoriaID`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`categoriaID`, `categoria`) VALUES
(1, 'Administrativos'),
(2, 'Biología'),
(3, 'Comunicaciones'),
(4, 'Construcción'),
(5, 'Contabilidad'),
(6, 'Creatividad, Producción y Diseño Comercial'),
(7, 'Derecho y Leyes'),
(8, 'Educación'),
(9, 'Ingeniería'),
(10, 'Logística, Transportación y Distribución'),
(11, 'Manufactura, Producción y Operación'),
(12, 'Mercadotecnia, Publicidad y Relaciones Públicas'),
(13, 'Recursos Humanos'),
(14, 'Salud y Belleza'),
(15, 'Sector Salud'),
(16, 'Seguro y Reaseguro'),
(17, 'Tecnologías de la Información / Sistemas'),
(18, 'Turismo, Hospitalidad y Gastronomía'),
(19, 'Ventas '),
(20, 'Veterinaria / Zoología');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoriasusuario`
--

CREATE TABLE IF NOT EXISTS `categoriasusuario` (
  `categoriaID` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioID` int(11) NOT NULL,
  KEY `categoriaID` (`categoriaID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `categoriasusuario`
--

INSERT INTO `categoriasusuario` (`categoriaID`, `usuarioID`) VALUES
(1, 28),
(2, 28),
(3, 28),
(20, 28),
(16, 29),
(1, 27),
(20, 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`) USING BTREE,
  KEY `last_activity_idx` (`last_activity`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=9362 COMMENT='tabla necesaria para CodeIgniter ... ';

--
-- Volcado de datos para la tabla `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('3a22614dd9627f8e994c511459a29490', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36', 1461014575, 'a:18:{s:9:"user_data";s:0:"";s:6:"logged";b:1;s:9:"usuarioID";s:2:"27";s:6:"correo";s:22:"mhh_lsm@mailinator.com";s:6:"nombre";s:6:"Martha";s:15:"apellidoPaterno";s:4:"Hdez";s:15:"apellidoMaterno";s:4:"Hdez";s:4:"sexo";s:1:"0";s:11:"tipoUsuario";s:1:"2";s:7:"authKey";s:20:"536034DDBDA7FA02A2C4";s:5:"nivel";s:1:"2";s:3:"rol";i:2;s:14:"manuallyLogged";b:1;s:3:"ni1";s:1:"1";s:3:"ni2";s:1:"2";s:3:"ni3";s:1:"3";s:3:"ic1";s:1:"1";s:4:"ic20";s:2:"20";}'),
('c551444dbafe1dc2f928ed1ab05fd306', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36', 1461019694, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `estadoID` int(11) NOT NULL AUTO_INCREMENT,
  `nombreEstado` varchar(30) NOT NULL,
  PRIMARY KEY (`estadoID`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=496 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`estadoID`, `nombreEstado`) VALUES
(1, 'Aguascalientes'),
(2, 'Baja California'),
(3, 'Baja California Sur'),
(4, 'Campeche'),
(5, 'Chiapas'),
(6, 'Chihuahua'),
(7, 'Coahuila'),
(8, 'Colima'),
(9, 'Distrito Federal'),
(10, 'Durango'),
(11, 'Estado de México'),
(12, 'Guanajuato'),
(13, 'Guerrero'),
(14, 'Hidalgo'),
(15, 'Jalisco'),
(16, 'Michoacán'),
(17, 'Morelos'),
(18, 'Nayarit'),
(19, 'Nuevo León'),
(20, 'Oaxaca'),
(21, 'Puebla'),
(22, 'Querétaro'),
(23, 'Quintana Roo'),
(24, 'San Luis Potosí'),
(25, 'Sinaloa'),
(26, 'Sonora'),
(27, 'Tabasco'),
(28, 'Tamaulipas'),
(29, 'Tlaxcala'),
(30, 'Veracruz'),
(31, 'Yucatán'),
(32, 'Zacatecas'),
(33, 'Fuera de México');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotoperfil`
--

CREATE TABLE IF NOT EXISTS `fotoperfil` (
  `fotoID` int(11) NOT NULL AUTO_INCREMENT,
  `foto` varchar(120) NOT NULL,
  `usuarioID` int(11) NOT NULL,
  PRIMARY KEY (`fotoID`) USING BTREE,
  KEY `usuarioID` (`usuarioID`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=819 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `fotoperfil`
--

INSERT INTO `fotoperfil` (`fotoID`, `foto`, `usuarioID`) VALUES
(1, '_703d1_Quote-of-yhe-Day_thumb.jpg', 24),
(2, '_c6ae2_2-dead-cats_thumb.jpg', 28),
(3, '_c234a_CEDqMB3VAAAX_QB_thumb.jpg', 27),
(4, '_42d8b_CEDqMB3VAAAX_QB_thumb.jpg', 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idiomas`
--

CREATE TABLE IF NOT EXISTS `idiomas` (
  `idiomaID` int(11) NOT NULL AUTO_INCREMENT,
  `idioma` text NOT NULL,
  PRIMARY KEY (`idiomaID`) USING BTREE,
  KEY `idiomaID` (`idiomaID`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `idiomas`
--

INSERT INTO `idiomas` (`idiomaID`, `idioma`) VALUES
(1, 'Español'),
(2, 'Inglés'),
(3, 'Francés'),
(4, 'Italiano'),
(7, 'Portugués'),
(8, 'Alemán');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `idiomasusuario`
--

CREATE TABLE IF NOT EXISTS `idiomasusuario` (
  `usuarioID` int(11) NOT NULL,
  `idiomaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461;

--
-- Volcado de datos para la tabla `idiomasusuario`
--

INSERT INTO `idiomasusuario` (`usuarioID`, `idiomaID`) VALUES
(29, 2),
(29, 3),
(29, 4),
(27, 1),
(27, 2),
(27, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
  `paisID` int(11) NOT NULL AUTO_INCREMENT,
  `PAIS_ISONUM` smallint(6) DEFAULT NULL,
  `PAIS_ISO2` char(2) DEFAULT NULL,
  `PAIS_ISO3` char(3) DEFAULT NULL,
  `nombrePais` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`paisID`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=68 AUTO_INCREMENT=241 ;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`paisID`, `PAIS_ISONUM`, `PAIS_ISO2`, `PAIS_ISO3`, `nombrePais`) VALUES
(1, 4, 'AF', 'AFG', 'Afganistán'),
(2, 248, 'AX', 'ALA', 'Islas Gland'),
(3, 8, 'AL', 'ALB', 'Albania'),
(4, 276, 'DE', 'DEU', 'Alemania'),
(5, 20, 'AD', 'AND', 'Andorra'),
(6, 24, 'AO', 'AGO', 'Angola'),
(7, 660, 'AI', 'AIA', 'Anguilla'),
(8, 10, 'AQ', 'ATA', 'Antártida'),
(9, 28, 'AG', 'ATG', 'Antigua y Barbuda'),
(10, 530, 'AN', 'ANT', 'Antillas Holandesas'),
(11, 682, 'SA', 'SAU', 'Arabia Saud'),
(12, 12, 'DZ', 'DZA', 'Argelia'),
(13, 32, 'AR', 'ARG', 'Argentina'),
(14, 51, 'AM', 'ARM', 'Armenia'),
(15, 533, 'AW', 'ABW', 'Aruba'),
(16, 36, 'AU', 'AUS', 'Australia'),
(17, 40, 'AT', 'AUT', 'Austria'),
(18, 31, 'AZ', 'AZE', 'Azerbaiy'),
(19, 44, 'BS', 'BHS', 'Bahamas'),
(20, 48, 'BH', 'BHR', 'Bahráin'),
(21, 50, 'BD', 'BGD', 'Bangladesh'),
(22, 52, 'BB', 'BRB', 'Barbados'),
(23, 112, 'BY', 'BLR', 'Bielorrusia'),
(24, 56, 'BE', 'BEL', 'Bélgica'),
(25, 84, 'BZ', 'BLZ', 'Belice'),
(26, 204, 'BJ', 'BEN', 'Benin'),
(27, 60, 'BM', 'BMU', 'Bermudas'),
(28, 64, 'BT', 'BTN', 'Bhut'),
(29, 68, 'BO', 'BOL', 'Bolivia'),
(30, 70, 'BA', 'BIH', 'Bosnia y Herzegovina'),
(31, 72, 'BW', 'BWA', 'Botsuana'),
(32, 74, 'BV', 'BVT', 'Isla Bouvet'),
(33, 76, 'BR', 'BRA', 'Brasil'),
(34, 96, 'BN', 'BRN', 'Brun'),
(35, 100, 'BG', 'BGR', 'Bulgaria'),
(36, 854, 'BF', 'BFA', 'Burkina Faso'),
(37, 108, 'BI', 'BDI', 'Burundi'),
(38, 132, 'CV', 'CPV', 'Cabo Verde'),
(39, 136, 'KY', 'CYM', 'Islas Caim'),
(40, 116, 'KH', 'KHM', 'Camboya'),
(41, 120, 'CM', 'CMR', 'Camerún'),
(42, 124, 'CA', 'CAN', 'Canadá'),
(43, 140, 'CF', 'CAF', 'República Centroafricana'),
(44, 148, 'TD', 'TCD', 'Chad'),
(45, 203, 'CZ', 'CZE', 'República Checa'),
(46, 152, 'CL', 'CHL', 'Chile'),
(47, 156, 'CN', 'CHN', 'China'),
(48, 196, 'CY', 'CYP', 'Chipre'),
(49, 162, 'CX', 'CXR', 'Isla de Navidad'),
(50, 336, 'VA', 'VAT', 'Ciudad del Vaticano'),
(51, 166, 'CC', 'CCK', 'Islas Cocos'),
(52, 170, 'CO', 'COL', 'Colombia'),
(53, 174, 'KM', 'COM', 'Comoras'),
(54, 180, 'CD', 'COD', 'República Democrática del Congo'),
(55, 178, 'CG', 'COG', 'Congo'),
(56, 184, 'CK', 'COK', 'Islas Cook'),
(57, 408, 'KP', 'PRK', 'Corea del Norte'),
(58, 410, 'KR', 'KOR', 'Corea del Sur'),
(59, 384, 'CI', 'CIV', 'Costa de Marfil'),
(60, 188, 'CR', 'CRI', 'Costa Rica'),
(61, 191, 'HR', 'HRV', 'Croacia'),
(62, 192, 'CU', 'CUB', 'Cuba'),
(63, 208, 'DK', 'DNK', 'Dinamarca'),
(64, 212, 'DM', 'DMA', 'Dominica'),
(65, 214, 'DO', 'DOM', 'República Dominicana'),
(66, 218, 'EC', 'ECU', 'Ecuador'),
(67, 818, 'EG', 'EGY', 'Egipto'),
(68, 222, 'SV', 'SLV', 'El Salvador'),
(69, 784, 'AE', 'ARE', 'Emiratos Árabes Unidos'),
(70, 232, 'ER', 'ERI', 'Eritrea'),
(71, 703, 'SK', 'SVK', 'Eslovaquia'),
(72, 705, 'SI', 'SVN', 'Eslovenia'),
(73, 724, 'ES', 'ESP', 'Espa'),
(74, 581, 'UM', 'UMI', 'Islas ultramarinas de Estados Unidos'),
(75, 840, 'US', 'USA', 'Estados Unidos'),
(76, 233, 'EE', 'EST', 'Estonia'),
(77, 231, 'ET', 'ETH', 'Etiop'),
(78, 234, 'FO', 'FRO', 'Islas Feroe'),
(79, 608, 'PH', 'PHL', 'Filipinas'),
(80, 246, 'FI', 'FIN', 'Finlandia'),
(81, 242, 'FJ', 'FJI', 'Fiyi'),
(82, 250, 'FR', 'FRA', 'Francia'),
(83, 266, 'GA', 'GAB', 'Gab'),
(84, 270, 'GM', 'GMB', 'Gambia'),
(85, 268, 'GE', 'GEO', 'Georgia'),
(86, 239, 'GS', 'SGS', 'Islas Georgias del Sur y Sandwich del Sur'),
(87, 288, 'GH', 'GHA', 'Ghana'),
(88, 292, 'GI', 'GIB', 'Gibraltar'),
(89, 308, 'GD', 'GRD', 'Granada'),
(90, 300, 'GR', 'GRC', 'Grecia'),
(91, 304, 'GL', 'GRL', 'Groenlandia'),
(92, 312, 'GP', 'GLP', 'Guadalupe'),
(93, 316, 'GU', 'GUM', 'Guam'),
(94, 320, 'GT', 'GTM', 'Guatemala'),
(95, 254, 'GF', 'GUF', 'Guayana Francesa'),
(96, 324, 'GN', 'GIN', 'Guinea'),
(97, 226, 'GQ', 'GNQ', 'Guinea Ecuatorial'),
(98, 624, 'GW', 'GNB', 'Guinea-Bissau'),
(99, 328, 'GY', 'GUY', 'Guyana'),
(100, 332, 'HT', 'HTI', 'Hait'),
(101, 334, 'HM', 'HMD', 'Islas Heard y McDonald'),
(102, 340, 'HN', 'HND', 'Honduras'),
(103, 344, 'HK', 'HKG', 'Hong Kong'),
(104, 348, 'HU', 'HUN', 'Hungr'),
(105, 356, 'IN', 'IND', 'India'),
(106, 360, 'ID', 'IDN', 'Indonesia'),
(107, 364, 'IR', 'IRN', 'Irán'),
(108, 368, 'IQ', 'IRQ', 'Iraq'),
(109, 372, 'IE', 'IRL', 'Irlanda'),
(110, 352, 'IS', 'ISL', 'Islandia'),
(111, 376, 'IL', 'ISR', 'Israel'),
(112, 380, 'IT', 'ITA', 'Italia'),
(113, 388, 'JM', 'JAM', 'Jamaica'),
(114, 392, 'JP', 'JPN', 'Jap'),
(115, 400, 'JO', 'JOR', 'Jordania'),
(116, 398, 'KZ', 'KAZ', 'Kazajst'),
(117, 404, 'KE', 'KEN', 'Kenia'),
(118, 417, 'KG', 'KGZ', 'Kirguist'),
(119, 296, 'KI', 'KIR', 'Kiribati'),
(120, 414, 'KW', 'KWT', 'Kuwait'),
(121, 418, 'LA', 'LAO', 'Laos'),
(122, 426, 'LS', 'LSO', 'Lesotho'),
(123, 428, 'LV', 'LVA', 'Letonia'),
(124, 422, 'LB', 'LBN', 'Líbano'),
(125, 430, 'LR', 'LBR', 'Liberia'),
(126, 434, 'LY', 'LBY', 'Libia'),
(127, 438, 'LI', 'LIE', 'Liechtenstein'),
(128, 440, 'LT', 'LTU', 'Lituania'),
(129, 442, 'LU', 'LUX', 'Luxemburgo'),
(130, 446, 'MO', 'MAC', 'Macao'),
(131, 807, 'MK', 'MKD', 'ARY Macedonia'),
(132, 450, 'MG', 'MDG', 'Madagascar'),
(133, 458, 'MY', 'MYS', 'Malasia'),
(134, 454, 'MW', 'MWI', 'Malawi'),
(135, 462, 'MV', 'MDV', 'Maldivas'),
(136, 466, 'ML', 'MLI', 'Mal'),
(137, 470, 'MT', 'MLT', 'Malta'),
(138, 238, 'FK', 'FLK', 'Islas Malvinas'),
(139, 580, 'MP', 'MNP', 'Islas Marianas del Norte'),
(140, 504, 'MA', 'MAR', 'Marruecos'),
(141, 584, 'MH', 'MHL', 'Islas Marshall'),
(142, 474, 'MQ', 'MTQ', 'Martinica'),
(143, 480, 'MU', 'MUS', 'Mauricio'),
(144, 478, 'MR', 'MRT', 'Mauritania'),
(145, 175, 'YT', 'MYT', 'Mayotte'),
(146, 484, 'MX', 'MEX', 'México'),
(147, 583, 'FM', 'FSM', 'Micronesia'),
(148, 498, 'MD', 'MDA', 'Moldavia'),
(149, 492, 'MC', 'MCO', 'Mónaco'),
(150, 496, 'MN', 'MNG', 'Mongolia'),
(151, 500, 'MS', 'MSR', 'Montserrat'),
(152, 508, 'MZ', 'MOZ', 'Mozambique'),
(153, 104, 'MM', 'MMR', 'Myanmar'),
(154, 516, 'NA', 'NAM', 'Namibia'),
(155, 520, 'NR', 'NRU', 'Nauru'),
(156, 524, 'NP', 'NPL', 'Nepal'),
(157, 558, 'NI', 'NIC', 'Nicaragua'),
(158, 562, 'NE', 'NER', 'Níger'),
(159, 566, 'NG', 'NGA', 'Nigeria'),
(160, 570, 'NU', 'NIU', 'Niue'),
(161, 574, 'NF', 'NFK', 'Isla Norfolk'),
(162, 578, 'NO', 'NOR', 'Noruega'),
(163, 540, 'NC', 'NCL', 'Nueva Caledonia'),
(164, 554, 'NZ', 'NZL', 'Nueva Zelanda'),
(165, 512, 'OM', 'OMN', 'Om'),
(166, 528, 'NL', 'NLD', 'Países Bajos'),
(167, 586, 'PK', 'PAK', 'Pakist'),
(168, 585, 'PW', 'PLW', 'Palau'),
(169, 275, 'PS', 'PSE', 'Palestina'),
(170, 591, 'PA', 'PAN', 'Panam'),
(171, 598, 'PG', 'PNG', 'Papáa Nueva Guinea'),
(172, 600, 'PY', 'PRY', 'Paraguay'),
(173, 604, 'PE', 'PER', 'Perú'),
(174, 612, 'PN', 'PCN', 'Islas Pitcairn'),
(175, 258, 'PF', 'PYF', 'Polinesia Francesa'),
(176, 616, 'PL', 'POL', 'Polonia'),
(177, 620, 'PT', 'PRT', 'Portugal'),
(178, 630, 'PR', 'PRI', 'Puerto Rico'),
(179, 634, 'QA', 'QAT', 'Qatar'),
(180, 826, 'GB', 'GBR', 'Reino Unido'),
(181, 638, 'RE', 'REU', 'Reuni'),
(182, 646, 'RW', 'RWA', 'Ruanda'),
(183, 642, 'RO', 'ROU', 'Rumania'),
(184, 643, 'RU', 'RUS', 'Rusia'),
(185, 732, 'EH', 'ESH', 'Sahara Occidental'),
(186, 90, 'SB', 'SLB', 'Islas Salom'),
(187, 882, 'WS', 'WSM', 'Samoa'),
(188, 16, 'AS', 'ASM', 'Samoa Americana'),
(189, 659, 'KN', 'KNA', 'San Crist?bal y Nevis'),
(190, 674, 'SM', 'SMR', 'San Marino'),
(191, 666, 'PM', 'SPM', 'San Pedro y Miquel'),
(192, 670, 'VC', 'VCT', 'San Vicente y las Granadinas'),
(193, 654, 'SH', 'SHN', 'Santa Helena'),
(194, 662, 'LC', 'LCA', 'Santa Luc'),
(195, 678, 'ST', 'STP', 'Santo Tomás y Príncipe'),
(196, 686, 'SN', 'SEN', 'Senegal'),
(197, 891, 'CS', 'SCG', 'Serbia y Montenegro'),
(198, 690, 'SC', 'SYC', 'Seychelles'),
(199, 694, 'SL', 'SLE', 'Sierra Leona'),
(200, 702, 'SG', 'SGP', 'Singapur'),
(201, 760, 'SY', 'SYR', 'Siria'),
(202, 706, 'SO', 'SOM', 'Somalia'),
(203, 144, 'LK', 'LKA', 'Sri Lanka'),
(204, 748, 'SZ', 'SWZ', 'Suazilandia'),
(205, 710, 'ZA', 'ZAF', 'Sudáfrica'),
(206, 736, 'SD', 'SDN', 'Sud'),
(207, 752, 'SE', 'SWE', 'Suecia'),
(208, 756, 'CH', 'CHE', 'Suiza'),
(209, 740, 'SR', 'SUR', 'Surinam'),
(210, 744, 'SJ', 'SJM', 'Svalbard y Jan Mayen'),
(211, 764, 'TH', 'THA', 'Tailandia'),
(212, 158, 'TW', 'TWN', 'Taiw'),
(213, 834, 'TZ', 'TZA', 'Tanzania'),
(214, 762, 'TJ', 'TJK', 'Tayikist'),
(215, 86, 'IO', 'IOT', 'Territorio Británico del Ocáano Índico'),
(216, 260, 'TF', 'ATF', 'Territorios Australes Franceses'),
(217, 626, 'TL', 'TLS', 'Timor Oriental'),
(218, 768, 'TG', 'TGO', 'Togo'),
(219, 772, 'TK', 'TKL', 'Tokelau'),
(220, 776, 'TO', 'TON', 'Tonga'),
(221, 780, 'TT', 'TTO', 'Trinidad y Tobago'),
(222, 788, 'TN', 'TUN', 'Túnez'),
(223, 796, 'TC', 'TCA', 'Islas Turcas y Caicos'),
(224, 795, 'TM', 'TKM', 'Turkmenist'),
(225, 792, 'TR', 'TUR', 'Turquía'),
(226, 798, 'TV', 'TUV', 'Tuvalu'),
(227, 804, 'UA', 'UKR', 'Ucrania'),
(228, 800, 'UG', 'UGA', 'Uganda'),
(229, 858, 'UY', 'URY', 'Uruguay'),
(230, 860, 'UZ', 'UZB', 'Uzbekist'),
(231, 548, 'VU', 'VUT', 'Vanuatu'),
(232, 862, 'VE', 'VEN', 'Venezuela'),
(233, 704, 'VN', 'VNM', 'Vietnam'),
(234, 92, 'VG', 'VGB', 'Islas Vírgenes Británicas'),
(235, 850, 'VI', 'VIR', 'Islas Vírgenes de los Estados Unidos'),
(236, 876, 'WF', 'WLF', 'Wallis y Futuna'),
(237, 887, 'YE', 'YEM', 'Yemen'),
(238, 262, 'DJ', 'DJI', 'Yibuti'),
(239, 894, 'ZM', 'ZMB', 'Zambia'),
(240, 716, 'ZW', 'ZWE', 'Zimbabue');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE IF NOT EXISTS `permiso` (
  `idPermiso` int(11) NOT NULL AUTO_INCREMENT,
  `nivel` int(11) NOT NULL,
  `nombrePermiso` varchar(70) NOT NULL,
  `borrado` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idPermiso`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=2340 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idPermiso`, `nivel`, `nombrePermiso`, `borrado`) VALUES
(1, 1, 'Usuario : Cuenta', 0),
(2, 2, 'Usuario Interprete: Cuenta', 0),
(3, 3, 'Admin', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(45) NOT NULL,
  `borrado` int(11) NOT NULL,
  PRIMARY KEY (`idRol`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombreRol`, `borrado`) VALUES
(1, 'Usuario', 0),
(2, 'Usuario Interprete', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roltienepermiso`
--

CREATE TABLE IF NOT EXISTS `roltienepermiso` (
  `idRol` int(11) NOT NULL,
  `idPermiso` int(11) NOT NULL,
  PRIMARY KEY (`idRol`,`idPermiso`) USING BTREE,
  KEY `fk_rol_has_permiso_permiso1` (`idPermiso`) USING BTREE,
  KEY `fk_rol_has_permiso_rol` (`idRol`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=2730;

--
-- Volcado de datos para la tabla `roltienepermiso`
--

INSERT INTO `roltienepermiso` (`idRol`, `idPermiso`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usuarioID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(39) NOT NULL,
  `apellidoPaterno` varchar(65) NOT NULL,
  `apellidoMaterno` varchar(25) NOT NULL,
  `sexo` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - hombre',
  `telefono` varchar(30) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `tipoUsuario` int(1) NOT NULL DEFAULT '1' COMMENT '0 - Administrador 1 - usuario normal 2 - interprete',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0 - no activado\n1 - activo',
  `nivel` int(11) DEFAULT '1' COMMENT 'establecimiento de jerarqu?a en usuarios',
  `codigoConfirmacion` varchar(100) NOT NULL COMMENT 'c?digo necesario para confirmar cuenta.',
  `fechaRegistro` datetime NOT NULL,
  `useragent` varchar(255) DEFAULT NULL,
  `last_ip_access` varchar(16) DEFAULT NULL,
  `authKey` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`usuarioID`) USING BTREE,
  KEY `usuarioID` (`usuarioID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=3276 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuarioID`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `sexo`, `telefono`, `correo`, `contrasena`, `tipoUsuario`, `status`, `nivel`, `codigoConfirmacion`, `fechaRegistro`, `useragent`, `last_ip_access`, `authKey`) VALUES
(2, 'admin', 'istrador', '', 0, '4422334455', 'admin@gmail.com', '2e0e4da5c11c0f8a73a01a5ddd672211af58c5b1e5179d7412', 0, 1, 0, 'C0275E7BDCF6C42C2CEA4DD7F', '2014-07-14 21:23:15', 'NULL', 'NULL', '71FFAFCDB080C9611760'),
(27, 'Martha', 'Hdez', 'Hdez', 0, '014422227777', 'mhh_lsm@mailinator.com', '410ea737d3d230352be5fef2a752d82c413d90340d7304fd7c', 2, 1, 2, 'EB73BD23492AB5F7E7F1391E8', '2016-04-18 00:27:15', NULL, NULL, '23ED70C865357AC9291F'),
(29, 'ANTONIO', 'MARTINEZ', 'LOPEZ', 0, '', 'AML@MAILINATOR.COM', 'f864cb18250bb8addbb19ba24c4f2f446e0c40266d3329084d', 2, 1, 2, '4F5246ED797F2E87CCD5583D9', '2016-04-18 15:55:15', NULL, NULL, 'DCBC076AC4CA81B35830');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariodato`
--

CREATE TABLE IF NOT EXISTS `usuariodato` (
  `idUsuarioDato` int(11) NOT NULL AUTO_INCREMENT,
  `usuarioID` int(11) NOT NULL,
  `cp` int(7) DEFAULT NULL,
  `municipio` varchar(45) DEFAULT NULL,
  `estadoID` int(11) NOT NULL,
  `idPais` int(11) DEFAULT '146' COMMENT '147 = México',
  `direccion` varchar(80) NOT NULL,
  PRIMARY KEY (`idUsuarioDato`) USING BTREE,
  KEY `adicional` (`usuarioID`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=2730 AUTO_INCREMENT=30 ;

--
-- Volcado de datos para la tabla `usuariodato`
--

INSERT INTO `usuariodato` (`idUsuarioDato`, `usuarioID`, `cp`, `municipio`, `estadoID`, `idPais`, `direccion`) VALUES
(2, 24, 76000, 'qro', 22, 146, 'direccion conocida'),
(27, 27, 76000, 'qro', 22, 146, 'direccion conocida'),
(29, 29, 76000, 'Queretaro', 22, 146, 'Zaragoza 343, Colonia Centro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `videoID` int(11) NOT NULL AUTO_INCREMENT,
  `link` text NOT NULL,
  `usuarioID` int(11) NOT NULL,
  PRIMARY KEY (`videoID`) USING BTREE,
  KEY `usuarioID` (`usuarioID`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `videos`
--

INSERT INTO `videos` (`videoID`, `link`, `usuarioID`) VALUES
(1, 'https://player.vimeo.com/video/73846428', 28),
(2, 'https://www.youtube.com/embed/9WbCfHutDSE', 27),
(3, 'https://www.youtube.com/embed/31crA53Dgu0', 29);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuariodato`
--
ALTER TABLE `usuariodato`
  ADD CONSTRAINT `usuarioID` FOREIGN KEY (`idUsuarioDato`) REFERENCES `usuario` (`usuarioID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
