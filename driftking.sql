-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2026 at 08:13 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `driftking`
--

-- --------------------------------------------------------

--
-- Table structure for table `autores_eventos`
--

CREATE TABLE `autores_eventos` (
  `idAutor` int NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carros`
--

CREATE TABLE `carros` (
  `idCarro` int NOT NULL,
  `matricula` varchar(10) DEFAULT NULL,
  `km` int DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `idMarca` int DEFAULT NULL,
  `idCombustivel` int DEFAULT NULL,
  `ano` int DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `foto_carro_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `descricao` text,
  `categoria` varchar(50) DEFAULT 'drift',
  `idVendedor` int DEFAULT NULL,
  `data_criacao` timestamp DEFAULT CURRENT_TIMESTAMP,
  `visualizacoes` int DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `carros`
--

INSERT INTO `carros` (`idCarro`, `matricula`, `km`, `preco`, `idMarca`, `idCombustivel`, `ano`, `estado`, `foto_carro_url`, `descricao`, `categoria`, `idVendedor`) VALUES
(1, 'Silvia S15 Spec-R', 85000, 50000.00, 1, 2, 2002, 'disponível', 'img/nissan-s15.jpg', 'Nissan Silvia S15 Spec-R completamente preparado para drift. Motor RB26 swap, suspensão coilover, diferencial bloqueado.', 'drift', 1),
(2, 'Supra MK4 JZ', 120000, 85000.00, 2, 2, 1998, 'disponível', 'img/supra.jpg', 'Toyota Supra MK4 com 800hp, single turbo, widebody kit. Uma lenda JDM pronta para pista.', 'tuning', 1),
(3, 'RX-7 FD3S', 95000, 80000.00, 4, 2, 1995, 'disponível', 'img/rx7.jpg', 'Mazda RX-7 FD3S rotary rocket com widebody kit. Motor rotativo reconstruído, perfeito para drift.', 'drift', 1),
(4, 'M3 E36 Turbo', 150000, 35000.00, 11, 2, 1996, 'disponível', 'img/bmw-e36.jpg', 'BMW M3 E36 com kit turbo, ângulo de direção revisto para drift. Projeto completo e funcional.', 'drift', 1),
(5, 'AE86 Sprinter', 180000, 45000.00, 2, 2, 1986, 'disponível', 'img/ae86.jpg', 'Toyota AE86 Sprinter Hachi-Roku original com motor 4AGE. O clássico do drift em excelente estado.', 'classico', 1),
(6, 'Skyline R34 GTT', 110000, 65000.00, 1, 2, 2001, 'disponível', 'img/skyline.jpg', 'Nissan Skyline R34 GTT com motor RB25DET e caixa manual. Preparações ligeiras, muito fiável.', 'tuning', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cidades`
--

CREATE TABLE `cidades` (
  `idCidade` int NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `idPais` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cidades`
--

INSERT INTO `cidades` (`idCidade`, `nome`, `idPais`) VALUES
(1, 'Lisboa', 142),
(2, 'Porto', 142),
(3, 'Braga', 142),
(4, 'Coimbra', 142),
(5, 'Faro', 142);

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nif` varchar(20) DEFAULT NULL,
  `idade` int DEFAULT NULL,
  `idCidade` int DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `foto_perfil_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `combustivel`
--

CREATE TABLE `combustivel` (
  `idCombustivel` int NOT NULL,
  `tipo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `combustivel`
--

INSERT INTO `combustivel` (`idCombustivel`, `tipo`) VALUES
(1, 'Gasóleo'),
(2, 'Gasolina'),
(3, 'Díesel'),
(4, 'GPL'),
(5, 'Elétrico');

-- --------------------------------------------------------

--
-- Table structure for table `comentarios_perfil`
--

CREATE TABLE `comentarios_perfil` (
  `idComentario` int NOT NULL,
  `idAutor` int DEFAULT NULL,
  `idPerfilDestino` int DEFAULT NULL,
  `conteudo` text,
  `data_publicacao` datetime DEFAULT (now()),
  `editado` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eventos_drift`
--

CREATE TABLE `eventos_drift` (
  `idEvento` int NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `idCidade` int DEFAULT NULL,
  `descricao` text,
  `idAutor` int DEFAULT NULL,
  `banner_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `funcionarios`
--

CREATE TABLE `funcionarios` (
  `idfuncionario` int NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `idCidade` int DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inscricoes_evento`
--

CREATE TABLE `inscricoes_evento` (
  `idInscricao` int NOT NULL,
  `idEvento` int DEFAULT NULL,
  `idPessoa` int DEFAULT NULL,
  `data_inscricao` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `marcas`
--

CREATE TABLE `marcas` (
  `idMarca` int NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `idPais` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `marcas`
--

INSERT INTO `marcas` (`idMarca`, `nome`, `idPais`) VALUES
(1, 'Nissan', 96),
(2, 'Toyota', 96),
(3, 'Honda', 96),
(4, 'Mazda', 96),
(5, 'Mitsubishi', 96),
(6, 'Subaru', 96),
(7, 'Suzuki', 96),
(8, 'Lexus', 96),
(9, 'Infiniti', 96),
(10, 'Acura', 96),
(11, 'BMW', 4),
(12, 'Mercedes-Benz', 4),
(13, 'Audi', 4),
(14, 'Volkswagen', 4),
(15, 'Porsche', 4),
(16, 'Opel', 4),
(17, 'Maybach', 4),
(18, 'Alpina', 4),
(19, 'Ford', 63),
(20, 'Chevrolet', 63),
(21, 'Tesla', 63),
(22, 'Dodge', 63),
(23, 'Jeep', 63),
(24, 'Cadillac', 63),
(25, 'Chryslic', 63),
(26, 'Buick', 63),
(27, 'Rivian', 63),
(28, 'Lucid Motors', 63),
(29, 'Ferrari', 94),
(30, 'Lamborghini', 94),
(31, 'Fiat', 94),
(32, 'Alfa Romeo', 94),
(33, 'Maserati', 94),
(34, 'Lancia', 94),
(35, 'Pagani', 94),
(36, 'Abarth', 94),
(37, 'Renault', 69),
(38, 'Peugeot', 69),
(39, 'Citroen', 69),
(40, 'Bugatti', 69),
(41, 'Alpine', 69),
(42, 'DS Automobiles', 69),
(43, 'Aston Martin', 146),
(44, 'McLaren', 146),
(45, 'Rolls-Royce', 146),
(46, 'Bentley', 146),
(47, 'Jaguar', 146),
(48, 'Land Rover', 146),
(49, 'Lotus', 146),
(50, 'Mini', 146),
(51, 'TVR', 146),
(52, 'Caterham', 146),
(53, 'BYD', 41),
(54, 'Geely', 41),
(55, 'NIO', 41),
(56, 'Xpeng', 41),
(57, 'Chery', 41),
(58, 'MG', 41),
(59, 'Great Wall', 41),
(60, 'Hongqi', 41),
(61, 'Lynk & Co', 41),
(62, 'Zeekr', 41),
(63, 'Hyundai', 47),
(64, 'Kia', 47),
(65, 'Genesis', 47),
(66, 'KG Mobility', 47),
(67, 'Volvo', 171),
(68, 'Koenigsegg', 171),
(69, 'Polestar', 171),
(70, 'SEAT', 61),
(71, 'Cupra', 61),
(72, 'GTA Spano', 61),
(73, 'Skoda', 39),
(74, 'Dacia', 150),
(75, 'Lada', 152),
(76, 'Aurus', 152),
(77, 'Tata Motors', 87),
(78, 'Mahindra', 87),
(79, 'Troller', 26),
(80, 'Proton', 109),
(81, 'Perodua', 109),
(82, 'VinFast', 192),
(83, 'Spyker', 134),
(84, 'Rimac', 50),
(85, 'Zenvo', 52),
(86, 'Holden', 12),
(87, 'Saab', 171),
(88, 'Hummer', 63),
(89, 'Pontiac', 63),
(90, 'Saturn', 63),
(91, 'Oldsmobile', 63),
(92, 'Plymouth', 63),
(93, 'Daewoo', 47),
(94, 'Scion', 96),
(95, 'Smart', 4),
(96, 'Isuzu', 96),
(97, 'Daihatsu', 96),
(98, 'Mitsuoka', 96),
(99, 'Hino', 96),
(100, 'Borgward', 4),
(101, 'Artega', 4),
(102, 'Gumpert', 4),
(103, 'Bitter', 4),
(104, 'Apollo', 4),
(105, 'Wiesmann', 4),
(106, 'Ruf', 4),
(107, 'Saleen', 63),
(108, 'Shelby', 63),
(109, 'Hennessey', 63),
(110, 'Fisker', 63),
(111, 'Karma', 63),
(112, 'Rossion', 63),
(113, 'Panoz', 63),
(114, 'Rezvani', 63),
(115, 'SSC North America', 63),
(116, 'Vector', 63),
(117, 'De Tomaso', 94),
(118, 'Autobianchi', 94),
(119, 'Innocenti', 94),
(120, 'Iso Rivolta', 94),
(121, 'Bizzarrini', 94),
(122, 'Pininfarina', 94),
(123, 'Bertone', 94),
(124, 'Italdesign', 94),
(125, 'Venturi', 69),
(126, 'Facel Vega', 69),
(127, 'Delahaye', 69),
(128, 'Talbot', 69),
(129, 'Matra', 69),
(130, 'Ligier', 69),
(131, 'Aixam', 69),
(132, 'Microcar', 69),
(133, 'Morgan', 146),
(134, 'Ariel', 146),
(135, 'Noble', 146),
(136, 'Radical', 146),
(137, 'Ultima', 146),
(138, 'Ginetta', 146),
(139, 'Bristol', 146),
(140, 'Marcos', 146),
(141, 'Reliant', 146),
(142, 'Austin', 146),
(143, 'Morris', 146),
(144, 'Triumph', 146),
(145, 'Rover', 146),
(146, 'MG Rover', 146),
(147, 'Jensen', 146),
(148, 'Humber', 146),
(149, 'Hillman', 146),
(150, 'Wolseley', 146),
(151, 'Singer', 146),
(152, 'Sunbeam', 146),
(153, 'Vauxhall', 146),
(154, 'Haval', 41),
(155, 'Wuling', 41),
(156, 'Baojun', 41),
(157, 'Roewe', 41),
(158, 'Maxus', 41),
(159, 'Trumpchi', 41),
(160, 'Aion', 41),
(161, 'Denza', 41),
(162, 'Weltmeister', 41),
(163, 'Leapmotor', 41),
(164, 'Hozon', 41),
(165, 'Voyah', 41),
(166, 'Tank', 41),
(167, 'Ora', 41),
(168, 'Wey', 41),
(169, 'JAC', 41),
(170, 'BAIC', 41),
(171, 'Foton', 41),
(172, 'Brilliance', 41),
(173, 'Soueast', 41),
(174, 'Lifan', 41),
(175, 'Zotye', 41),
(176, 'Landwind', 41),
(177, 'Qoros', 41),
(178, 'Luxgen', 41),
(179, 'Avatr', 41),
(180, 'JMC', 41),
(181, 'Hafei', 41),
(182, 'Changan', 41),
(183, 'FAW', 41),
(184, 'SAIC', 41),
(185, 'Dongfeng', 41),
(186, 'GAC', 41),
(187, 'UMM', 142),
(188, 'Portaro', 142),
(189, 'Sado', 142),
(190, 'Abarth', 94),
(191, 'Donkervoort', 134),
(192, 'Tramontana', 61),
(193, 'Mastretta', 117),
(194, 'Laraki', 114);

-- --------------------------------------------------------

--
-- Table structure for table `paises`
--

CREATE TABLE `paises` (
  `idPais` int NOT NULL,
  `nome` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paises`
--

INSERT INTO `paises` (`idPais`, `nome`) VALUES
(1, 'Afeganistão'),
(2, 'África do Sul'),
(3, 'Albânia'),
(4, 'Alemanha'),
(5, 'Andorra'),
(6, 'Angola'),
(7, 'Antiga e Barbuda'),
(8, 'Arábia Saudita'),
(9, 'Argélia'),
(10, 'Argentina'),
(11, 'Arménia'),
(12, 'Austrália'),
(13, 'Áustria'),
(14, 'Azerbaijão'),
(15, 'Bahamas'),
(16, 'Bangladexe'),
(17, 'Barbados'),
(18, 'Barém'),
(19, 'Bélgica'),
(20, 'Belize'),
(21, 'Benim'),
(22, 'Bielorrússia'),
(23, 'Bolívia'),
(24, 'Bósnia e Herzegovina'),
(25, 'Botsuana'),
(26, 'Brasil'),
(27, 'Brunei'),
(28, 'Bulgária'),
(29, 'Burquina Faso'),
(30, 'Burundi'),
(31, 'Butão'),
(32, 'Cabo Verde'),
(33, 'Camarões'),
(34, 'Camboja'),
(35, 'Canadá'),
(36, 'Catar'),
(37, 'Cazaquistão'),
(38, 'Chade'),
(39, 'Chéquia'),
(40, 'Chile'),
(41, 'China'),
(42, 'Chipre'),
(43, 'Colômbia'),
(44, 'Comores'),
(45, 'Congo-Brazzaville'),
(46, 'Coreia do Norte'),
(47, 'Coreia do Sul'),
(48, 'Costa do Marfim'),
(49, 'Costa Rica'),
(50, 'Croácia'),
(51, 'Cuba'),
(52, 'Dinamarca'),
(53, 'Djibuti'),
(54, 'Dominica'),
(55, 'Egito'),
(56, 'Emirados Árabes Unidos'),
(57, 'Equador'),
(58, 'Eritreia'),
(59, 'Eslováquia'),
(60, 'Eslovénia'),
(61, 'Espanha'),
(62, 'Estado da Palestina'),
(63, 'Estados Unidos'),
(64, 'Estónia'),
(65, 'Etiópia'),
(66, 'Fiji'),
(67, 'Filipinas'),
(68, 'Finlândia'),
(69, 'França'),
(70, 'Gabão'),
(71, 'Gâmbia'),
(72, 'Gana'),
(73, 'Geórgia'),
(74, 'Granada'),
(75, 'Grécia'),
(76, 'Guatemala'),
(77, 'Guiana'),
(78, 'Guiné'),
(79, 'Guiné Equatorial'),
(80, 'Guiné-Bissau'),
(81, 'Haiti'),
(82, 'Honduras'),
(83, 'Hungria'),
(84, 'Iémen'),
(85, 'Ilhas Marechal'),
(86, 'Ilhas Salomão'),
(87, 'Índia'),
(88, 'Indonésia'),
(89, 'Irão'),
(90, 'Iraque'),
(91, 'Irlanda'),
(92, 'Islândia'),
(93, 'Israel'),
(94, 'Itália'),
(95, 'Jamaica'),
(96, 'Japão'),
(97, 'Jordânia'),
(98, 'Laus'),
(99, 'Lesoto'),
(100, 'Letónia'),
(101, 'Líbano'),
(102, 'Libéria'),
(103, 'Líbia'),
(104, 'Listenstaine'),
(105, 'Lituânia'),
(106, 'Luxemburgo'),
(107, 'Macedónia do Norte'),
(108, 'Madagáscar'),
(109, 'Malásia'),
(110, 'Maláui'),
(111, 'Maldivas'),
(112, 'Mali'),
(113, 'Malta'),
(114, 'Marrocos'),
(115, 'Maurícia'),
(116, 'Mauritânia'),
(117, 'México'),
(118, 'Mianmar'),
(119, 'Micronésia'),
(120, 'Moçambique'),
(121, 'Moldávia'),
(122, 'Mónaco'),
(123, 'Mongólia'),
(124, 'Montenegro'),
(125, 'Namíbia'),
(126, 'Nauru'),
(127, 'Nepal'),
(128, 'Nicarágua'),
(129, 'Níger'),
(130, 'Nigéria'),
(131, 'Noruega'),
(132, 'Nova Zelândia'),
(133, 'Omã'),
(134, 'Países Baixos'),
(135, 'Palau'),
(136, 'Panamá'),
(137, 'Papua Nova Guiné'),
(138, 'Paquistão'),
(139, 'Paraguai'),
(140, 'Peru'),
(141, 'Polónia'),
(142, 'Portugal'),
(143, 'Quénia'),
(144, 'Quirguistão'),
(145, 'Quiribáti'),
(146, 'Reino Unido'),
(147, 'República Centro-Africana'),
(148, 'República Democrática do Congo'),
(149, 'República Dominicana'),
(150, 'Roménia'),
(151, 'Ruanda'),
(152, 'Rússia'),
(153, 'Salvador'),
(154, 'Samoa'),
(155, 'Santa Lúcia'),
(156, 'São Cristóvão e Neves'),
(157, 'São Marinho'),
(158, 'São Tomé e Príncipe'),
(159, 'São Vicente e Granadinas'),
(160, 'Seicheles'),
(161, 'Senegal'),
(162, 'Serra Leoa'),
(163, 'Sérvia'),
(164, 'Singapura'),
(165, 'Síria'),
(166, 'Somália'),
(167, 'Seri Lanca'),
(168, 'Essuatíni'),
(169, 'Sudão'),
(170, 'Sudão do Sul'),
(171, 'Suécia'),
(172, 'Suíça'),
(173, 'Suriname'),
(174, 'Tailândia'),
(175, 'Tajiquistão'),
(176, 'Tanzânia'),
(177, 'Timor-Leste'),
(178, 'Togo'),
(179, 'Tonga'),
(180, 'Trindade e Tobago'),
(181, 'Tunísia'),
(182, 'Turcomenistão'),
(183, 'Turquia'),
(184, 'Tuvalu'),
(185, 'Ucrânia'),
(186, 'Uganda'),
(187, 'Uruguai'),
(188, 'Usbequistão'),
(189, 'Vanuatu'),
(190, 'Vaticano'),
(191, 'Venezuela'),
(192, 'Vietname'),
(193, 'Zâmbia'),
(194, 'Zimbábue');

-- --------------------------------------------------------

--
-- Table structure for table `bodykits`
--

CREATE TABLE `bodykits` (
  `idBodykit` int NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `idMarca` int DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `descricao` text,
  `foto_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bodykits`
--

INSERT INTO `bodykits` (`idBodykit`, `nome`, `idMarca`, `preco`, `descricao`, `foto_url`) VALUES
(1, 'Pandem Rocket Bunny', 1, 3500.00, 'Kit widebody para Nissan Silvia S15', NULL),
(2, 'Liberty Walk Style', 2, 4200.00, 'Kit widebody para Toyota Supra MK4', NULL),
(3, 'Vertex Edge', 4, 2800.00, 'Kit aerodinâmico para Mazda RX-7', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `modelos`
--

CREATE TABLE `modelos` (
  `idModelo` int NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `idMarca` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pessoas_inscritas`
--

CREATE TABLE `pessoas_inscritas` (
  `idPessoa` int NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendas`
--

CREATE TABLE `vendas` (
  `idvendas` int NOT NULL,
  `dataVenda` datetime DEFAULT (now()),
  `idfuncionario` int DEFAULT NULL,
  `idCliente` int DEFAULT NULL,
  `idCarro` int DEFAULT NULL,
  `precoFinal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autores_eventos`
--
ALTER TABLE `autores_eventos`
  ADD PRIMARY KEY (`idAutor`);

--
-- Indexes for table `bodykits`
--
ALTER TABLE `bodykits`
  ADD PRIMARY KEY (`idBodykit`),
  ADD KEY `idMarca` (`idMarca`);

--
-- Indexes for table `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`idModelo`),
  ADD KEY `idMarca` (`idMarca`);

--
-- Indexes for table `carros`
--
ALTER TABLE `carros`
  ADD PRIMARY KEY (`idCarro`),
  ADD UNIQUE KEY `matricula` (`matricula`),
  ADD KEY `idMarca` (`idMarca`),
  ADD KEY `idCombustivel` (`idCombustivel`);

--
-- Indexes for table `cidades`
--
ALTER TABLE `cidades`
  ADD PRIMARY KEY (`idCidade`),
  ADD KEY `idPais` (`idPais`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idCidade` (`idCidade`);

--
-- Indexes for table `combustivel`
--
ALTER TABLE `combustivel`
  ADD PRIMARY KEY (`idCombustivel`);

--
-- Indexes for table `comentarios_perfil`
--
ALTER TABLE `comentarios_perfil`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `idAutor` (`idAutor`),
  ADD KEY `idPerfilDestino` (`idPerfilDestino`);

--
-- Indexes for table `eventos_drift`
--
ALTER TABLE `eventos_drift`
  ADD PRIMARY KEY (`idEvento`),
  ADD KEY `idCidade` (`idCidade`),
  ADD KEY `idAutor` (`idAutor`);

--
-- Indexes for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`idfuncionario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idCidade` (`idCidade`);

--
-- Indexes for table `inscricoes_evento`
--
ALTER TABLE `inscricoes_evento`
  ADD PRIMARY KEY (`idInscricao`),
  ADD KEY `idEvento` (`idEvento`),
  ADD KEY `idPessoa` (`idPessoa`);

--
-- Indexes for table `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`idMarca`),
  ADD KEY `idPais` (`idPais`);

--
-- Indexes for table `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`idPais`);

--
-- Indexes for table `pessoas_inscritas`
--
ALTER TABLE `pessoas_inscritas`
  ADD PRIMARY KEY (`idPessoa`);

--
-- Indexes for table `vendas`
--
ALTER TABLE `vendas`
  ADD PRIMARY KEY (`idvendas`),
  ADD KEY `idCliente` (`idCliente`),
  ADD KEY `idfuncionario` (`idfuncionario`),
  ADD KEY `idCarro` (`idCarro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autores_eventos`
--
ALTER TABLE `autores_eventos`
  MODIFY `idAutor` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bodykits`
--
ALTER TABLE `bodykits`
  MODIFY `idBodykit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `modelos`
--
ALTER TABLE `modelos`
  MODIFY `idModelo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carros`
--
ALTER TABLE `carros`
  MODIFY `idCarro` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cidades`
--
ALTER TABLE `cidades`
  MODIFY `idCidade` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `combustivel`
--
ALTER TABLE `combustivel`
  MODIFY `idCombustivel` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comentarios_perfil`
--
ALTER TABLE `comentarios_perfil`
  MODIFY `idComentario` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventos_drift`
--
ALTER TABLE `eventos_drift`
  MODIFY `idEvento` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `idfuncionario` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inscricoes_evento`
--
ALTER TABLE `inscricoes_evento`
  MODIFY `idInscricao` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marcas`
--
ALTER TABLE `marcas`
  MODIFY `idMarca` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `paises`
--
ALTER TABLE `paises`
  MODIFY `idPais` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `pessoas_inscritas`
--
ALTER TABLE `pessoas_inscritas`
  MODIFY `idPessoa` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendas`
--
ALTER TABLE `vendas`
  MODIFY `idvendas` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bodykits`
--
ALTER TABLE `bodykits`
  ADD CONSTRAINT `bodykits_ibfk_1` FOREIGN KEY (`idMarca`) REFERENCES `marcas` (`idMarca`);

--
-- Constraints for table `modelos`
--
ALTER TABLE `modelos`
  ADD CONSTRAINT `modelos_ibfk_1` FOREIGN KEY (`idMarca`) REFERENCES `marcas` (`idMarca`);

--
-- Constraints for table `carros`
--
ALTER TABLE `carros`
  ADD CONSTRAINT `carros_ibfk_1` FOREIGN KEY (`idMarca`) REFERENCES `marcas` (`idMarca`),
  ADD CONSTRAINT `carros_ibfk_2` FOREIGN KEY (`idCombustivel`) REFERENCES `combustivel` (`idCombustivel`),
  ADD CONSTRAINT `carros_ibfk_3` FOREIGN KEY (`idVendedor`) REFERENCES `clientes` (`idCliente`);

--
-- Constraints for table `cidades`
--
ALTER TABLE `cidades`
  ADD CONSTRAINT `cidades_ibfk_1` FOREIGN KEY (`idPais`) REFERENCES `paises` (`idPais`);

--
-- Constraints for table `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`idCidade`) REFERENCES `cidades` (`idCidade`);

--
-- Constraints for table `comentarios_perfil`
--
ALTER TABLE `comentarios_perfil`
  ADD CONSTRAINT `comentarios_perfil_ibfk_1` FOREIGN KEY (`idAutor`) REFERENCES `clientes` (`idCliente`),
  ADD CONSTRAINT `comentarios_perfil_ibfk_2` FOREIGN KEY (`idPerfilDestino`) REFERENCES `clientes` (`idCliente`);

--
-- Constraints for table `eventos_drift`
--
ALTER TABLE `eventos_drift`
  ADD CONSTRAINT `eventos_drift_ibfk_1` FOREIGN KEY (`idCidade`) REFERENCES `cidades` (`idCidade`),
  ADD CONSTRAINT `eventos_drift_ibfk_2` FOREIGN KEY (`idAutor`) REFERENCES `autores_eventos` (`idAutor`);

--
-- Constraints for table `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `funcionarios_ibfk_1` FOREIGN KEY (`idCidade`) REFERENCES `cidades` (`idCidade`);

--
-- Constraints for table `inscricoes_evento`
--
ALTER TABLE `inscricoes_evento`
  ADD CONSTRAINT `inscricoes_evento_ibfk_1` FOREIGN KEY (`idEvento`) REFERENCES `eventos_drift` (`idEvento`),
  ADD CONSTRAINT `inscricoes_evento_ibfk_2` FOREIGN KEY (`idPessoa`) REFERENCES `pessoas_inscritas` (`idPessoa`);

--
-- Constraints for table `marcas`
--
ALTER TABLE `marcas`
  ADD CONSTRAINT `marcas_ibfk_1` FOREIGN KEY (`idPais`) REFERENCES `paises` (`idPais`);

--
-- Constraints for table `vendas`
--
ALTER TABLE `vendas`
  ADD CONSTRAINT `vendas_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `clientes` (`idCliente`),
  ADD CONSTRAINT `vendas_ibfk_2` FOREIGN KEY (`idfuncionario`) REFERENCES `funcionarios` (`idfuncionario`),
  ADD CONSTRAINT `vendas_ibfk_3` FOREIGN KEY (`idCarro`) REFERENCES `carros` (`idCarro`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
