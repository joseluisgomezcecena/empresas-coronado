-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2025 at 08:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminsystems_yonque`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(17, 'Acura'),
(32, 'Alfa Romeo'),
(37, 'Aston Martin'),
(8, 'Audi'),
(35, 'Bentley'),
(6, 'BMW'),
(42, 'Bugatti'),
(23, 'Buick'),
(60, 'BYD'),
(24, 'Cadillac'),
(4, 'Chevrolet'),
(21, 'Chrysler'),
(45, 'Citroën'),
(53, 'CUPRA'),
(54, 'Dacia'),
(20, 'Dodge'),
(46, 'DS'),
(40, 'Ferrari'),
(31, 'Fiat'),
(3, 'Ford'),
(33, 'Genesis'),
(25, 'GMC'),
(59, 'Great Wall'),
(2, 'Honda'),
(10, 'Hyundai'),
(18, 'Infiniti'),
(29, 'Jaguar'),
(15, 'Jeep'),
(11, 'Kia'),
(55, 'Lada'),
(39, 'Lamborghini'),
(28, 'Land Rover'),
(16, 'Lexus'),
(26, 'Lincoln'),
(41, 'Lotus'),
(64, 'Lucid'),
(34, 'Maserati'),
(13, 'Mazda'),
(38, 'McLaren'),
(7, 'Mercedes-Benz'),
(58, 'MG'),
(30, 'MINI'),
(52, 'Mitsubishi'),
(61, 'NIO'),
(5, 'Nissan'),
(49, 'Opel'),
(43, 'Peugeot'),
(19, 'Porsche'),
(56, 'Proton'),
(22, 'RAM'),
(44, 'Renault'),
(63, 'Rivian'),
(36, 'Rolls-Royce'),
(47, 'SEAT'),
(48, 'ŠKODA'),
(12, 'Subaru'),
(51, 'Suzuki'),
(57, 'Tata'),
(14, 'Tesla'),
(1, 'Toyota'),
(50, 'Vauxhall'),
(9, 'Volkswagen'),
(27, 'Volvo'),
(62, 'Xpeng');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_slug`, `created_at`, `updated_at`) VALUES
(1, 'Radiadores', 'Radiadores', '2024-06-04 05:58:48', '2025-02-21 22:55:04'),
(2, 'Espejos Retrovisores', 'Espejos-Retrovisores', '2024-06-04 06:00:47', '2025-02-21 22:54:54'),
(3, 'Motores', 'Motores', '2024-06-04 06:01:02', '2025-02-21 22:44:02'),
(5, 'Faros', 'Faros', '2025-02-21 22:23:30', '2025-02-21 22:42:10'),
(6, 'Tapones', 'Tapones', '2025-02-23 00:19:11', '2025-02-23 00:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_movements`
--

CREATE TABLE `inventory_movements` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `movement_type` enum('entrada','salida') NOT NULL,
  `quantity` int(11) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_movements`
--

INSERT INTO `inventory_movements` (`id`, `product_id`, `movement_type`, `quantity`, `reason`, `description`, `created_at`, `created_by`) VALUES
(1, 2, 'entrada', 5, 'compra_pieza', '', '2025-02-23 02:38:17', 2),
(2, 2, 'salida', 1, 'producto_danado', 'Una pieza venia dañada', '2025-02-23 02:41:49', 2),
(3, 3, 'entrada', 5, 'inventario_inicial', 'Inventario inicial del producto', '2025-02-23 08:20:30', 2),
(4, 3, 'salida', 2, 'venta', 'vendidos', '2025-02-23 08:36:13', 2),
(5, 4, 'entrada', 2, 'inventario_inicial', 'Inventario inicial del producto', '2025-02-23 09:27:15', 2),
(6, 4, 'salida', 1, 'venta', '', '2025-02-23 19:36:07', 2);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_reasons`
--

CREATE TABLE `inventory_reasons` (
  `id` int(11) NOT NULL,
  `movement_type` enum('entrada','salida') NOT NULL,
  `reason` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_reasons`
--

INSERT INTO `inventory_reasons` (`id`, `movement_type`, `reason`) VALUES
(1, 'entrada', 'compra_pieza'),
(2, 'entrada', 'compra_vehiculo'),
(3, 'entrada', 'intercambio'),
(4, 'salida', 'venta'),
(5, 'salida', 'producto_danado'),
(6, 'salida', 'extravio');

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `brand_id`, `name`) VALUES
(1, 1, 'Corolla'),
(2, 1, 'Camry'),
(3, 1, 'RAV4'),
(4, 1, 'Highlander'),
(5, 1, 'Tacoma'),
(6, 1, 'Tundra'),
(7, 1, 'Prius'),
(8, 1, '4Runner'),
(9, 1, 'Avalon'),
(10, 1, 'Sequoia'),
(11, 2, 'Civic'),
(12, 2, 'Accord'),
(13, 2, 'CR-V'),
(14, 2, 'Pilot'),
(15, 2, 'Fit'),
(16, 2, 'Odyssey'),
(17, 2, 'Ridgeline'),
(18, 2, 'HR-V'),
(19, 2, 'Passport'),
(20, 2, 'Insight'),
(21, 3, 'F-150'),
(22, 3, 'Mustang'),
(23, 3, 'Explorer'),
(24, 3, 'Escape'),
(25, 3, 'Bronco'),
(26, 3, 'Edge'),
(27, 3, 'Expedition'),
(28, 3, 'Ranger'),
(29, 3, 'Transit'),
(30, 3, 'Maverick'),
(31, 4, 'Silverado'),
(32, 4, 'Malibu'),
(33, 4, 'Equinox'),
(34, 4, 'Traverse'),
(35, 4, 'Camaro'),
(36, 4, 'Tahoe'),
(37, 4, 'Suburban'),
(38, 4, 'Colorado'),
(39, 4, 'Blazer'),
(40, 4, 'Impala'),
(41, 5, 'Altima'),
(42, 5, 'Sentra'),
(43, 5, 'Rogue'),
(44, 5, 'Pathfinder'),
(45, 5, 'Frontier'),
(46, 5, 'Titan'),
(47, 5, 'Maxima'),
(48, 5, 'Versa'),
(49, 5, 'Murano'),
(50, 5, 'Armada'),
(51, 6, '3 Series'),
(52, 6, '5 Series'),
(53, 6, 'X3'),
(54, 6, 'X5'),
(55, 6, 'M4'),
(56, 6, 'X1'),
(57, 6, 'X7'),
(58, 6, 'M2'),
(59, 6, 'i4'),
(60, 6, 'iX'),
(61, 7, 'C-Class'),
(62, 7, 'E-Class'),
(63, 7, 'GLC'),
(64, 7, 'GLE'),
(65, 7, 'S-Class'),
(66, 7, 'A-Class'),
(67, 7, 'CLA'),
(68, 7, 'GLA'),
(69, 7, 'AMG GT'),
(70, 7, 'EQB'),
(71, 8, 'A3'),
(72, 8, 'A4'),
(73, 8, 'Q5'),
(74, 8, 'Q7'),
(75, 8, 'R8'),
(76, 8, 'A6'),
(77, 8, 'Q3'),
(78, 8, 'Q8'),
(79, 8, 'e-tron'),
(80, 8, 'S5'),
(81, 9, 'Golf'),
(82, 9, 'Jetta'),
(83, 9, 'Passat'),
(84, 9, 'Tiguan'),
(85, 9, 'Atlas'),
(86, 9, 'ID.4'),
(87, 9, 'Polo'),
(88, 9, 'Arteon'),
(89, 9, 'Touareg'),
(90, 9, 'T-Cross'),
(91, 10, 'Elantra'),
(92, 10, 'Sonata'),
(93, 10, 'Tucson'),
(94, 10, 'Santa Fe'),
(95, 10, 'Palisade'),
(96, 10, 'Kona'),
(97, 10, 'Venue'),
(98, 10, 'Nexo'),
(99, 10, 'Ioniq 5'),
(100, 10, 'Staria'),
(101, 11, 'Forte'),
(102, 11, 'Optima'),
(103, 11, 'Sorento'),
(104, 11, 'Sportage'),
(105, 11, 'Telluride'),
(106, 11, 'Stinger'),
(107, 11, 'Carnival'),
(108, 11, 'Soul'),
(109, 11, 'Niro'),
(110, 11, 'EV6'),
(111, 12, 'Impreza'),
(112, 12, 'Legacy'),
(113, 12, 'Outback'),
(114, 12, 'Forester'),
(115, 12, 'WRX'),
(116, 12, 'BRZ'),
(117, 12, 'Crosstrek'),
(118, 12, 'Ascent'),
(119, 12, 'Solterra'),
(120, 12, 'Levorg'),
(121, 13, 'Mazda3'),
(122, 13, 'Mazda6'),
(123, 13, 'CX-5'),
(124, 13, 'CX-9'),
(125, 13, 'MX-5'),
(126, 13, 'CX-30'),
(127, 13, 'CX-50'),
(128, 13, 'RX-8'),
(129, 13, 'BT-50'),
(130, 13, 'CX-90'),
(131, 14, 'Model 3'),
(132, 14, 'Model S'),
(133, 14, 'Model X'),
(134, 14, 'Model Y'),
(135, 14, 'Cybertruck'),
(136, 14, 'Roadster'),
(137, 14, 'Semi'),
(138, 14, 'Plaid'),
(139, 14, 'Powerwall'),
(140, 14, 'Solar Roof'),
(141, 15, 'Wrangler'),
(142, 15, 'Cherokee'),
(143, 15, 'Grand Cherokee'),
(144, 15, 'Compass'),
(145, 15, 'Renegade'),
(146, 15, 'Gladiator'),
(147, 15, 'Patriot'),
(148, 15, 'Commander'),
(149, 15, 'Wagoneer'),
(150, 15, 'Liberty'),
(151, 16, 'IS'),
(152, 16, 'ES'),
(153, 16, 'RX'),
(154, 16, 'GX'),
(155, 16, 'LX'),
(156, 16, 'NX'),
(157, 16, 'RC'),
(158, 16, 'UX'),
(159, 16, 'LS'),
(160, 16, 'LC'),
(161, 17, 'ILX'),
(162, 17, 'TLX'),
(163, 17, 'RDX'),
(164, 17, 'MDX'),
(165, 17, 'NSX'),
(166, 17, 'ZDX'),
(167, 17, 'Vigor'),
(168, 17, 'RLX'),
(169, 17, 'TSX'),
(170, 17, 'Integra'),
(171, 18, 'Q50'),
(172, 18, 'Q60'),
(173, 18, 'QX50'),
(174, 18, 'QX60'),
(175, 18, 'QX80'),
(176, 18, 'Q30'),
(177, 18, 'QX55'),
(178, 18, 'QX70'),
(179, 18, 'EX35'),
(180, 18, 'M37'),
(181, 19, '911'),
(182, 19, 'Cayenne'),
(183, 19, 'Macan'),
(184, 19, 'Panamera'),
(185, 19, 'Taycan'),
(186, 19, '718 Boxster'),
(187, 19, '718 Cayman'),
(188, 19, 'Carrera GT'),
(189, 19, '928'),
(190, 19, '944'),
(191, 20, 'Challenger'),
(192, 20, 'Charger'),
(193, 20, 'Durango'),
(194, 20, 'Journey'),
(195, 20, 'Grand Caravan'),
(196, 20, 'Ram 1500'),
(197, 20, 'Ram 2500'),
(198, 20, 'Dakota'),
(199, 20, 'Viper'),
(200, 20, 'Magnum'),
(201, 21, '300'),
(202, 21, 'Pacifica'),
(203, 21, 'Voyager'),
(204, 21, 'Town & Country'),
(205, 21, 'PT Cruiser'),
(206, 21, 'Sebring'),
(207, 21, '200'),
(208, 21, 'Crossfire'),
(209, 21, 'Aspen'),
(210, 21, 'Imperial'),
(211, 22, '1500'),
(212, 22, '2500'),
(213, 22, '3500'),
(214, 22, 'ProMaster'),
(215, 22, 'ProMaster City'),
(216, 22, 'Dakota'),
(217, 22, 'Cargo Van'),
(218, 22, '4500'),
(219, 22, '5500'),
(220, 22, 'Chassis Cab'),
(221, 23, 'Enclave'),
(222, 23, 'Encore'),
(223, 23, 'Envision'),
(224, 23, 'LaCrosse'),
(225, 23, 'Regal'),
(226, 23, 'Verano'),
(227, 23, 'Cascada'),
(228, 23, 'Lucerne'),
(229, 23, 'Park Avenue'),
(230, 23, 'Century'),
(231, 24, 'Escalade'),
(232, 24, 'CT4'),
(233, 24, 'CT5'),
(234, 24, 'XT4'),
(235, 24, 'XT5'),
(236, 24, 'XT6'),
(237, 24, 'CTS'),
(238, 24, 'ATS'),
(239, 24, 'XTS'),
(240, 24, 'SRX'),
(241, 25, 'Sierra'),
(242, 25, 'Yukon'),
(243, 25, 'Terrain'),
(244, 25, 'Acadia'),
(245, 25, 'Canyon'),
(246, 25, 'Savana'),
(247, 25, 'Hummer EV'),
(248, 25, 'Envoy'),
(249, 25, 'Jimmy'),
(250, 25, 'Safari'),
(251, 26, 'Navigator'),
(252, 26, 'Aviator'),
(253, 26, 'Nautilus'),
(254, 26, 'Corsair'),
(255, 26, 'Continental'),
(256, 26, 'MKZ'),
(257, 26, 'MKC'),
(258, 26, 'MKX'),
(259, 26, 'Town Car'),
(260, 26, 'Mark LT'),
(261, 27, 'XC90'),
(262, 27, 'XC60'),
(263, 27, 'XC40'),
(264, 27, 'S60'),
(265, 27, 'S90'),
(266, 27, 'V60'),
(267, 27, 'V90'),
(268, 27, 'C40'),
(269, 27, 'S40'),
(270, 27, 'C30'),
(271, 28, 'Range Rover'),
(272, 28, 'Discovery'),
(273, 28, 'Defender'),
(274, 28, 'Evoque'),
(275, 28, 'Velar'),
(276, 28, 'Sport'),
(277, 28, 'LR4'),
(278, 28, 'LR3'),
(279, 28, 'Freelander'),
(280, 28, 'Series'),
(281, 29, 'F-PACE'),
(282, 29, 'E-PACE'),
(283, 29, 'I-PACE'),
(284, 29, 'XF'),
(285, 29, 'XE'),
(286, 29, 'F-TYPE'),
(287, 29, 'XJ'),
(288, 29, 'S-TYPE'),
(289, 29, 'X-TYPE'),
(290, 29, 'XK'),
(291, 30, 'Cooper'),
(292, 30, 'Countryman'),
(293, 30, 'Clubman'),
(294, 30, 'Paceman'),
(295, 30, 'Hardtop'),
(296, 30, 'Convertible'),
(297, 30, 'Coupe'),
(298, 30, 'Roadster'),
(299, 30, 'Electric'),
(300, 30, 'John Cooper Works'),
(301, 31, '500'),
(302, 31, '500X'),
(303, 31, '500L'),
(304, 31, '124 Spider'),
(305, 31, 'Panda'),
(306, 31, 'Tipo'),
(307, 31, 'Punto'),
(308, 31, 'Ducato'),
(309, 31, '500e'),
(310, 31, 'Bravo'),
(311, 32, 'Giulia'),
(312, 32, 'Stelvio'),
(313, 32, '4C'),
(314, 32, 'Giulietta'),
(315, 32, 'MiTo'),
(316, 32, '159'),
(317, 32, 'Brera'),
(318, 32, 'Spider'),
(319, 32, '156'),
(320, 32, 'GT'),
(321, 33, 'G70'),
(322, 33, 'G80'),
(323, 33, 'G90'),
(324, 33, 'GV70'),
(325, 33, 'GV80'),
(326, 33, 'Essentia'),
(327, 33, 'Mint'),
(328, 33, 'X'),
(329, 33, 'New York'),
(330, 33, 'GV60'),
(331, 34, 'Ghibli'),
(332, 34, 'Levante'),
(333, 34, 'Quattroporte'),
(334, 34, 'MC20'),
(335, 34, 'Grecale'),
(336, 34, 'GranTurismo'),
(337, 34, 'GranCabrio'),
(338, 34, 'Coupe'),
(339, 34, 'Spyder'),
(340, 34, 'Bora'),
(341, 1, 'Land Cruiser'),
(342, 1, 'GR Supra'),
(343, 1, 'Sienna'),
(344, 1, 'C-HR'),
(345, 1, 'GR86'),
(346, 2, 'Prelude'),
(347, 2, 'Element'),
(348, 2, 'S2000'),
(349, 2, 'CRX'),
(350, 2, 'Del Sol'),
(351, 3, 'GT'),
(352, 3, 'Crown Victoria'),
(353, 3, 'Flex'),
(354, 3, 'Fusion'),
(355, 3, 'Fiesta'),
(356, 4, 'Nova'),
(357, 4, 'Corvette'),
(358, 4, 'Monte Carlo'),
(359, 4, 'El Camino'),
(360, 4, 'Chevelle'),
(361, 5, 'GT-R'),
(362, 5, '370Z'),
(363, 5, 'Leaf'),
(364, 5, 'Kicks'),
(365, 5, 'Juke'),
(366, 6, '7 Series'),
(367, 6, '8 Series'),
(368, 6, 'Z4'),
(369, 6, 'i8'),
(370, 6, 'M8'),
(371, 7, 'SLK'),
(372, 7, 'SL'),
(373, 7, 'G-Wagon'),
(374, 7, 'Maybach'),
(375, 7, 'EQS'),
(376, 8, 'RS6'),
(377, 8, 'TT'),
(378, 8, 'RS7'),
(379, 8, 'S8'),
(380, 8, 'RS Q8'),
(381, 9, 'Scirocco'),
(382, 9, 'CC'),
(383, 9, 'Beetle'),
(384, 9, 'Phaeton'),
(385, 9, 'EOS'),
(386, 10, 'Genesis'),
(387, 10, 'Veloster'),
(388, 10, 'Equus'),
(389, 10, 'Azera'),
(390, 10, 'i30'),
(391, 11, 'K5'),
(392, 11, 'Cadenza'),
(393, 11, 'K900'),
(394, 11, 'Rio'),
(395, 11, 'Seltos'),
(396, 12, 'SVX'),
(397, 12, 'Tribeca'),
(398, 12, 'Baja'),
(399, 12, 'XT'),
(400, 12, 'GL'),
(401, 13, 'RX-7'),
(402, 13, 'Protege'),
(403, 13, 'MPV'),
(404, 13, '626'),
(405, 13, 'CX-3'),
(406, 14, 'Model 2'),
(407, 14, 'Model R'),
(408, 14, 'Model C'),
(409, 14, 'Starship'),
(410, 14, 'Model Z'),
(411, 15, 'Liberty'),
(412, 15, 'Scrambler'),
(413, 15, 'CJ'),
(414, 15, 'Grand Wagoneer'),
(415, 15, 'Comanche'),
(416, 16, 'RCF'),
(417, 16, 'GSF'),
(418, 16, 'LFA'),
(419, 16, 'SC'),
(420, 16, 'CT'),
(421, 17, 'Legend'),
(422, 17, 'CL'),
(423, 17, 'RL'),
(424, 17, 'RSX'),
(425, 17, 'SLX'),
(426, 18, 'FX'),
(427, 18, 'G'),
(428, 18, 'JX'),
(429, 18, 'I'),
(430, 18, 'QX4'),
(431, 19, 'Cayman'),
(432, 19, 'Carrera'),
(433, 19, '918'),
(434, 19, '959'),
(435, 19, '968');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `part_number` varchar(50) NOT NULL,
  `car_brand` varchar(100) NOT NULL,
  `car_model` varchar(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_slug` varchar(255) NOT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `suggested_price` decimal(10,2) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `product_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `part_number`, `car_brand`, `car_model`, `product_name`, `product_slug`, `purchase_price`, `sale_price`, `suggested_price`, `qty`, `location`, `views`, `product_image`, `created_at`, `updated_at`) VALUES
(2, '00012', 'BMW', '330i', 'Manija conductor', 'Manija-conductor', 25.00, 30.00, 35.00, NULL, '', 0, '1740261080_pexels-ryan-leeper-2910856-10198740-removebg-preview.png', '2025-02-22 21:51:20', '2025-02-22 21:51:20'),
(3, 'D001', 'Volvo', 'S60', 'Defensa Frontal', 'Defensa-Frontal', 100.00, 125.00, 150.00, 5, 'L01', 0, '1740298830_pexels-tdcat-70912.jpg', '2025-02-23 08:20:30', '2025-02-23 08:20:30'),
(4, 'X0001', '1', 'Corolla', 'Motor Corolla', 'Motor-Corolla', 700.00, 890.00, 1000.00, 2, 'M001', 0, '1740302835_pexels-ryan-leeper-2910856-10198740-removebg-preview.png', '2025-02-23 09:27:15', '2025-02-23 09:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_id`, `category_id`, `created_at`) VALUES
(7, 2, 1, '2025-02-23 00:46:12'),
(8, 2, 2, '2025-02-23 00:46:12'),
(9, 2, 3, '2025-02-23 00:46:12'),
(10, 2, 5, '2025-02-23 00:46:12'),
(11, 2, 6, '2025-02-23 00:46:12'),
(12, 3, 2, '2025-02-23 08:20:30'),
(13, 3, 3, '2025-02-23 08:20:30'),
(14, 3, 5, '2025-02-23 08:20:30'),
(16, 4, 2, '2025-02-23 10:08:32'),
(17, 4, 3, '2025-02-23 10:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `product_years`
--

CREATE TABLE `product_years` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_years`
--

INSERT INTO `product_years` (`id`, `product_id`, `year`, `created_at`) VALUES
(5, 2, 2018, '2025-02-23 00:46:12'),
(6, 2, 2019, '2025-02-23 00:46:12'),
(7, 2, 2020, '2025-02-23 00:46:12'),
(8, 2, 2021, '2025-02-23 00:46:12'),
(9, 3, 2000, '2025-02-23 08:20:30'),
(10, 3, 2001, '2025-02-23 08:20:30'),
(11, 3, 2002, '2025-02-23 08:20:30'),
(12, 3, 2003, '2025-02-23 08:20:30'),
(15, 4, 2018, '2025-02-23 10:08:32'),
(16, 4, 2019, '2025-02-23 10:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `is_agent` int(11) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `signature` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `user_phone`, `is_agent`, `password`, `is_admin`, `created_at`, `updated_at`, `signature`) VALUES
(2, 'administrator', 'admin@admin.com', '', 0, '$2y$10$07kqsEdai95dj.OZE5deouhrvLNwCnphVpREWoJf.llndHzeHNLaa', 1, '2024-04-05 04:39:23', '2024-05-09 20:30:01', 'uploads/signatures/280901861.png'),
(9, 'elchams', 'julian.moreno@adminsystems.mx', '6861234567', 1, '$2y$10$UfQyAOu4USIRMAx0VLAn6.MX8/ugMzCh68nIhkb/E2iCFVHIGrIUO', 1, '2024-06-07 19:57:30', '2025-02-23 19:44:46', NULL),
(10, 'gustavocoronado', 'gustavocoronado@empresascoronado.com', '686123456', 1, '$2y$10$C8HFXTy43dU.JMwLStcvfOL9kUe.E15mIgDu3.WTmV6C0eEQbjue2', 1, '2025-02-23 19:45:52', '2025-02-23 19:45:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `inventory_movements`
--
ALTER TABLE `inventory_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventory_movements_product_id` (`product_id`);

--
-- Indexes for table `inventory_reasons`
--
ALTER TABLE `inventory_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `part_number` (`part_number`),
  ADD UNIQUE KEY `product_slug` (`product_slug`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_category_unique` (`product_id`,`category_id`),
  ADD KEY `fk_product_categories_category_id` (`category_id`);

--
-- Indexes for table `product_years`
--
ALTER TABLE `product_years`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_year_unique` (`product_id`,`year`),
  ADD KEY `fk_product_years_product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `uniq` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory_movements`
--
ALTER TABLE `inventory_movements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory_reasons`
--
ALTER TABLE `inventory_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=436;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_years`
--
ALTER TABLE `product_years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_movements`
--
ALTER TABLE `inventory_movements`
  ADD CONSTRAINT `fk_inventory_movements_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `fk_product_categories_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_categories_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_years`
--
ALTER TABLE `product_years`
  ADD CONSTRAINT `fk_product_years_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
