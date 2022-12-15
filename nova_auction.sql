-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2022 at 10:03 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nova_auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `makes_name` varchar(50) DEFAULT NULL,
  `model_name` varchar(50) DEFAULT NULL,
  `year_of_make` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `makes_name`, `model_name`, `year_of_make`) VALUES
(1, 'AUDI', 'A8', 2009),
(2, 'TOYOTA', 'COROLLA', 2014),
(3, 'KIA', 'RIO', 2017),
(4, 'MERCEDES-BENZ', 'G-CLASS', 2010),
(5, 'FIAT', '500X', 2016);

-- --------------------------------------------------------

--
-- Table structure for table `car_info`
--

CREATE TABLE `car_info` (
  `id` int(11) NOT NULL,
  `makes_name` varchar(50) DEFAULT NULL,
  `model_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_info`
--

INSERT INTO `car_info` (`id`, `makes_name`, `model_name`) VALUES
(1, 'Mercedes-Benz', 'A-Class'),
(2, 'Audi', 'A3'),
(3, 'Audi', 'A4'),
(4, 'Audi', 'A4 allroad'),
(5, 'Audi', 'A5'),
(6, 'Audi', 'A6'),
(7, 'Audi', 'A6 allroad'),
(8, 'Audi', 'A7'),
(9, 'Audi', 'A8'),
(10, 'GMC', 'Acadia'),
(11, 'Hyundai', 'Accent'),
(12, 'Honda', 'Accord'),
(13, 'Honda', 'Accord Hybrid'),
(14, 'Lucid', 'Air'),
(15, 'Nissan', 'Altima'),
(16, 'Nissan', 'Ariya'),
(17, 'Nissan', 'Armada'),
(18, 'Volkswagen', 'Arteon'),
(19, 'Subaru', 'Ascent'),
(20, 'Volkswagen', 'Atlas'),
(21, 'Volkswagen', 'Atlas Cross Sport'),
(22, 'Toyota', 'Avalon'),
(23, 'Toyota', 'Avalon Hybrid'),
(24, 'Lamborghini', 'Aventador'),
(25, 'Lincoln', 'Aviator'),
(26, 'Bentley', 'Bentayga'),
(27, 'Chevrolet', 'Blazer'),
(28, 'Chevrolet', 'Blazer EV'),
(29, 'Chevrolet', 'Bolt EUV'),
(30, 'Chevrolet', 'Bolt EV'),
(31, 'Ford', 'Bronco'),
(32, 'Ford', 'Bronco Sport'),
(33, 'Subaru', 'BRZ'),
(34, 'Toyota', 'bZ4X'),
(35, 'Mercedes-Benz', 'C-Class'),
(36, 'Toyota', 'C-HR'),
(37, 'Volvo', 'C40 Recharge'),
(38, 'Chevrolet', 'Camaro'),
(39, 'Toyota', 'Camry'),
(40, 'Toyota', 'Camry Hybrid'),
(41, 'GMC', 'Canyon Crew Cab'),
(42, 'GMC', 'Canyon Extended Cab'),
(43, 'Kia', 'Carnival'),
(44, 'Porsche', 'Cayenne'),
(45, 'Porsche', 'Cayenne Coupe'),
(46, 'Cadillac', 'Celestiq'),
(47, 'Dodge', 'Challenger'),
(48, 'Dodge', 'Charger'),
(49, 'Jeep', 'Cherokee'),
(50, 'Honda', 'Civic'),
(51, 'Honda', 'Civic Type R'),
(52, 'Mercedes-Benz', 'CLA'),
(53, 'Honda', 'Clarity Fuel Cell'),
(54, 'Honda', 'Clarity Plug-in Hybrid'),
(55, 'Mercedes-Benz', 'CLS'),
(56, 'MINI', 'Clubman'),
(57, 'Chevrolet', 'Colorado Crew Cab'),
(58, 'Chevrolet', 'Colorado Extended Cab'),
(59, 'Jeep', 'Compass'),
(60, 'Bentley', 'Continental GT'),
(61, 'MINI', 'Convertible'),
(62, 'Toyota', 'Corolla'),
(63, 'Toyota', 'Corolla Cross'),
(64, 'Toyota', 'Corolla Cross Hybrid'),
(65, 'Toyota', 'Corolla Hatchback'),
(66, 'Toyota', 'Corolla Hybrid'),
(67, 'Lincoln', 'Corsair'),
(68, 'Chevrolet', 'Corvette'),
(69, 'MINI', 'Countryman'),
(70, 'Honda', 'CR-V'),
(71, 'Honda', 'CR-V Hybrid'),
(72, 'Subaru', 'Crosstrek'),
(73, 'Toyota', 'Crown'),
(74, 'Cadillac', 'CT4'),
(75, 'Cadillac', 'CT5'),
(76, 'Rolls-Royce', 'Cullinan'),
(77, 'MAZDA', 'CX-3'),
(78, 'MAZDA', 'CX-30'),
(79, 'MAZDA', 'CX-5'),
(80, 'MAZDA', 'CX-50'),
(81, 'MAZDA', 'CX-70'),
(82, 'MAZDA', 'CX-9'),
(83, 'MAZDA', 'CX-90'),
(84, 'Tesla', 'Cybertruck'),
(85, 'Rolls-Royce', 'Dawn'),
(86, 'Aston Martin', 'DB11'),
(87, 'Aston Martin', 'DBS'),
(88, 'Aston Martin', 'DBX'),
(89, 'Land Rover', 'Defender 110'),
(90, 'Land Rover', 'Defender 130'),
(91, 'Land Rover', 'Defender 90'),
(92, 'Land Rover', 'Discovery'),
(93, 'Land Rover', 'Discovery Sport'),
(94, 'Dodge', 'Durango'),
(95, 'Mercedes-Benz', 'E-Class'),
(96, 'Jaguar', 'E-PACE'),
(97, 'Ford', 'E-Transit 350 Cargo Van'),
(98, 'Audi', 'e-tron'),
(99, 'Audi', 'e-tron GT'),
(100, 'Audi', 'e-tron S'),
(101, 'Audi', 'e-tron S Sportback'),
(102, 'Audi', 'e-tron Sportback'),
(103, 'Mitsubishi', 'Eclipse Cross'),
(104, 'Ford', 'EcoSport'),
(105, 'Ford', 'Edge'),
(106, 'Hyundai', 'Elantra'),
(107, 'Hyundai', 'Elantra Hybrid'),
(108, 'Hyundai', 'Elantra N'),
(109, 'Genesis', 'Electrified G80'),
(110, 'Genesis', 'Electrified GV70'),
(111, 'Buick', 'Enclave'),
(112, 'Buick', 'Encore'),
(113, 'Buick', 'Encore GX'),
(114, 'Buick', 'Envision'),
(115, 'Chevrolet', 'Equinox'),
(116, 'Chevrolet', 'Equinox EV'),
(117, 'Lexus', 'ES'),
(118, 'Cadillac', 'Escalade'),
(119, 'Cadillac', 'Escalade ESV'),
(120, 'Ford', 'Escape'),
(121, 'Ford', 'Escape Plug-in Hybrid'),
(122, 'Kia', 'EV6'),
(123, 'Kia', 'EV9'),
(124, 'Lotus', 'Evora GT'),
(125, 'Volvo', 'EX90'),
(126, 'Ford', 'Expedition'),
(127, 'Ford', 'Expedition MAX'),
(128, 'Ford', 'Explorer'),
(129, 'Chevrolet', 'Express 2500 Cargo'),
(130, 'Chevrolet', 'Express 2500 Passenger'),
(131, 'Chevrolet', 'Express 3500 Cargo'),
(132, 'Chevrolet', 'Express 3500 Passenger'),
(133, 'Jaguar', 'F-PACE'),
(134, 'Jaguar', 'F-TYPE'),
(135, 'Ford', 'F150 Lightning'),
(136, 'Ford', 'F150 Regular Cab'),
(137, 'Ford', 'F150 Super Cab'),
(138, 'Ford', 'F150 SuperCrew Cab'),
(139, 'Ford', 'F250 Super Duty Crew Cab'),
(140, 'Ford', 'F250 Super Duty Regular Cab'),
(141, 'Ford', 'F250 Super Duty Super Cab'),
(142, 'Ford', 'F350 Super Duty Crew Cab'),
(143, 'Ford', 'F350 Super Duty Regular Cab'),
(144, 'Ford', 'F350 Super Duty Super Cab'),
(145, 'Ford', 'F450 Super Duty Crew Cab'),
(146, 'Ford', 'F450 Super Duty Regular Cab'),
(147, 'Ferrari', 'F8'),
(148, 'Bentley', 'Flying Spur'),
(149, 'Subaru', 'Forester'),
(150, 'Kia', 'Forte'),
(151, 'Nissan', 'Frontier Crew Cab'),
(152, 'Nissan', 'Frontier King Cab'),
(153, 'Mercedes-Benz', 'G-Class'),
(154, 'Genesis', 'G70'),
(155, 'Genesis', 'G80'),
(156, 'Genesis', 'G90'),
(157, 'Maserati', 'Ghibli'),
(158, 'Rolls-Royce', 'Ghost'),
(159, 'Alfa Romeo', 'Giulia'),
(160, 'Mercedes-Benz', 'GLA'),
(161, 'Jeep', 'Gladiator'),
(162, 'Mercedes-Benz', 'GLB'),
(163, 'Mercedes-Benz', 'GLC'),
(164, 'Mercedes-Benz', 'GLC Coupe'),
(165, 'Mercedes-Benz', 'GLE'),
(166, 'Mercedes-Benz', 'GLS'),
(167, 'Volkswagen', 'Golf GTI'),
(168, 'Volkswagen', 'Golf R'),
(169, 'Toyota', 'GR Corolla'),
(170, 'Toyota', 'GR Supra'),
(171, 'Toyota', 'GR86'),
(172, 'Jeep', 'Grand Cherokee'),
(173, 'Jeep', 'Grand Cherokee 4xe'),
(174, 'Jeep', 'Grand Cherokee L'),
(175, 'Toyota', 'Grand Highlander'),
(176, 'Jeep', 'Grand Wagoneer'),
(177, 'Jeep', 'Grand Wagoneer L'),
(178, 'Maserati', 'Grecale'),
(179, 'Nissan', 'GT-R'),
(180, 'Genesis', 'GV60'),
(181, 'Genesis', 'GV70'),
(182, 'Genesis', 'GV80'),
(183, 'Lexus', 'GX'),
(184, 'MINI', 'Hardtop 2 Door'),
(185, 'MINI', 'Hardtop 4 Door'),
(186, 'Toyota', 'Highlander'),
(187, 'Toyota', 'Highlander Hybrid'),
(188, 'Dodge', 'Hornet'),
(189, 'Honda', 'HR-V'),
(190, 'GMC', 'Hummer EV Pickup'),
(191, 'GMC', 'Hummer EV SUV'),
(192, 'Lamborghini', 'Huracan'),
(193, 'Jaguar', 'I-PACE'),
(194, 'BMW', 'i3'),
(195, 'BMW', 'i4'),
(196, 'BMW', 'i7'),
(197, 'Volkswagen', 'ID.4'),
(198, 'Volkswagen', 'ID.Buzz'),
(199, 'Acura', 'ILX'),
(200, 'Subaru', 'Impreza'),
(201, 'Honda', 'Insight'),
(202, 'Acura', 'Integra'),
(203, 'Hyundai', 'IONIQ 5'),
(204, 'Hyundai', 'IONIQ 6'),
(205, 'Hyundai', 'IONIQ 7'),
(206, 'Hyundai', 'Ioniq Electric'),
(207, 'Hyundai', 'Ioniq Hybrid'),
(208, 'Hyundai', 'Ioniq Plug-in Hybrid'),
(209, 'Lexus', 'IS'),
(210, 'BMW', 'iX'),
(211, 'Volkswagen', 'Jetta'),
(212, 'Volkswagen', 'Jetta GLI'),
(213, 'Kia', 'K5'),
(214, 'Nissan', 'Kicks'),
(215, 'Hyundai', 'Kona'),
(216, 'Hyundai', 'Kona Electric'),
(217, 'Hyundai', 'Kona N'),
(218, 'Toyota', 'Land Cruiser'),
(219, 'Lexus', 'LC'),
(220, 'Nissan', 'LEAF'),
(221, 'Subaru', 'Legacy'),
(222, 'Maserati', 'Levante'),
(223, 'Lexus', 'LS'),
(224, 'Lexus', 'LX'),
(225, 'Cadillac', 'LYRIQ'),
(226, 'BMW', 'M2'),
(227, 'BMW', 'M3'),
(228, 'BMW', 'M4'),
(229, 'BMW', 'M5'),
(230, 'BMW', 'M8'),
(231, 'Porsche', 'Macan'),
(232, 'Chevrolet', 'Malibu'),
(233, 'Ford', 'Maverick'),
(234, 'Nissan', 'Maxima'),
(235, 'MAZDA', 'MAZDA3'),
(236, 'MAZDA', 'MAZDA6'),
(237, 'Maserati', 'MC20'),
(238, 'Acura', 'MDX'),
(239, 'Mercedes-Benz', 'Mercedes-AMG A-Class'),
(240, 'Mercedes-Benz', 'Mercedes-AMG C-Class'),
(241, 'Mercedes-Benz', 'Mercedes-AMG CLA'),
(242, 'Mercedes-Benz', 'Mercedes-AMG CLS'),
(243, 'Mercedes-Benz', 'Mercedes-AMG E-Class'),
(244, 'Mercedes-Benz', 'Mercedes-AMG EQS'),
(245, 'Mercedes-Benz', 'Mercedes-AMG G-Class'),
(246, 'Mercedes-Benz', 'Mercedes-AMG GLA'),
(247, 'Mercedes-Benz', 'Mercedes-AMG GLB'),
(248, 'Mercedes-Benz', 'Mercedes-AMG GLC'),
(249, 'Mercedes-Benz', 'Mercedes-AMG GLC Coupe'),
(250, 'Mercedes-Benz', 'Mercedes-AMG GLE'),
(251, 'Mercedes-Benz', 'Mercedes-AMG GLE Coupe'),
(252, 'Mercedes-Benz', 'Mercedes-AMG GLS'),
(253, 'Mercedes-Benz', 'Mercedes-AMG GT'),
(254, 'Mercedes-Benz', 'Mercedes-AMG S-Class'),
(255, 'Mercedes-Benz', 'Mercedes-AMG SL'),
(256, 'Mercedes-Benz', 'Mercedes-EQ EQB'),
(257, 'Mercedes-Benz', 'Mercedes-EQ EQE'),
(258, 'Mercedes-Benz', 'Mercedes-EQ EQE SUV'),
(259, 'Mercedes-Benz', 'Mercedes-EQ EQS'),
(260, 'Mercedes-Benz', 'Mercedes-EQ EQS SUV'),
(261, 'Mercedes-Benz', 'Mercedes-Maybach GLS'),
(262, 'Mercedes-Benz', 'Mercedes-Maybach S-Class'),
(263, 'Mercedes-Benz', 'Metris Cargo'),
(264, 'Mercedes-Benz', 'Metris Passenger'),
(265, 'Mitsubishi', 'Mirage'),
(266, 'Mitsubishi', 'Mirage G4'),
(267, 'Toyota', 'Mirai'),
(268, 'Tesla', 'Model 3'),
(269, 'Tesla', 'Model S'),
(270, 'Tesla', 'Model X'),
(271, 'Tesla', 'Model Y'),
(272, 'Nissan', 'Murano'),
(273, 'Ford', 'Mustang'),
(274, 'Ford', 'Mustang MACH-E'),
(275, 'MAZDA', 'MX-30'),
(276, 'MAZDA', 'MX-5 Miata'),
(277, 'MAZDA', 'MX-5 Miata RF'),
(278, 'Lincoln', 'Nautilus'),
(279, 'Lincoln', 'Navigator'),
(280, 'Lincoln', 'Navigator L'),
(281, 'Hyundai', 'NEXO'),
(282, 'Kia', 'Niro'),
(283, 'Kia', 'Niro EV'),
(284, 'Kia', 'Niro Plug-in Hybrid'),
(285, 'Acura', 'NSX'),
(286, 'Nissan', 'NV1500 Cargo'),
(287, 'Nissan', 'NV200'),
(288, 'Nissan', 'NV2500 HD Cargo'),
(289, 'Nissan', 'NV3500 HD Cargo'),
(290, 'Nissan', 'NV3500 HD Passenger'),
(291, 'Lexus', 'NX'),
(292, 'Fisker', 'Ocean'),
(293, 'Honda', 'Odyssey'),
(294, 'Subaru', 'Outback'),
(295, 'Mitsubishi', 'Outlander'),
(296, 'Mitsubishi', 'Outlander PHEV'),
(297, 'Mitsubishi', 'Outlander Sport'),
(298, 'Chrysler', 'Pacifica'),
(299, 'Chrysler', 'Pacifica Hybrid'),
(300, 'Hyundai', 'Palisade'),
(301, 'Porsche', 'Panamera'),
(302, 'Volkswagen', 'Passat'),
(303, 'Honda', 'Passport'),
(304, 'Nissan', 'Pathfinder'),
(305, 'Rolls-Royce', 'Phantom'),
(306, 'Honda', 'Pilot'),
(307, 'Ferrari', 'Portofino'),
(308, 'Toyota', 'Prius'),
(309, 'Toyota', 'Prius Prime'),
(310, 'Honda', 'Prologue'),
(311, 'Ram', 'ProMaster Cargo Van'),
(312, 'Ram', 'ProMaster City'),
(313, 'Ram', 'ProMaster Window Van'),
(314, 'Audi', 'Q3'),
(315, 'Audi', 'Q4 e-tron'),
(316, 'Audi', 'Q4 Sportback e-tron'),
(317, 'Audi', 'Q5'),
(318, 'Audi', 'Q5 Sportback'),
(319, 'INFINITI', 'Q50'),
(320, 'INFINITI', 'Q60'),
(321, 'Audi', 'Q7'),
(322, 'Audi', 'Q8'),
(323, 'Audi', 'Q8 e-tron'),
(324, 'Maserati', 'Quattroporte'),
(325, 'INFINITI', 'QX50'),
(326, 'INFINITI', 'QX55'),
(327, 'INFINITI', 'QX60'),
(328, 'INFINITI', 'QX80'),
(329, 'Rivian', 'R1S'),
(330, 'Rivian', 'R1T'),
(331, 'Audi', 'R8'),
(332, 'Land Rover', 'Range Rover'),
(333, 'Land Rover', 'Range Rover Evoque'),
(334, 'Land Rover', 'Range Rover Sport'),
(335, 'Land Rover', 'Range Rover Velar'),
(336, 'Ford', 'Ranger SuperCab'),
(337, 'Ford', 'Ranger SuperCrew'),
(338, 'Toyota', 'RAV4'),
(339, 'Toyota', 'RAV4 Hybrid'),
(340, 'Toyota', 'RAV4 Prime'),
(341, 'Lexus', 'RC'),
(342, 'Acura', 'RDX'),
(343, 'Jeep', 'Recon'),
(344, 'Jeep', 'Renegade'),
(345, 'Honda', 'Ridgeline'),
(346, 'Kia', 'Rio'),
(347, 'Nissan', 'Rogue'),
(348, 'Nissan', 'Rogue Sport'),
(349, 'Ferrari', 'Roma'),
(350, 'Audi', 'RS 3'),
(351, 'Audi', 'RS 5'),
(352, 'Audi', 'RS 6'),
(353, 'Audi', 'RS 7'),
(354, 'Audi', 'RS e-tron GT'),
(355, 'Audi', 'RS Q8'),
(356, 'Lexus', 'RX'),
(357, 'Lexus', 'RZ'),
(358, 'Mercedes-Benz', 'S-Class'),
(359, 'Audi', 'S3'),
(360, 'Audi', 'S4'),
(361, 'Audi', 'S5'),
(362, 'Audi', 'S6'),
(363, 'Volvo', 'S60'),
(364, 'Audi', 'S7'),
(365, 'Audi', 'S8'),
(366, 'Volvo', 'S90'),
(367, 'Hyundai', 'Santa Cruz'),
(368, 'Hyundai', 'Santa Fe'),
(369, 'Hyundai', 'Santa Fe Hybrid'),
(370, 'Hyundai', 'Santa Fe Plug-in Hybrid'),
(371, 'GMC', 'Savana 2500 Cargo'),
(372, 'GMC', 'Savana 2500 Passenger'),
(373, 'GMC', 'Savana 3500 Cargo'),
(374, 'GMC', 'Savana 3500 Passenger'),
(375, 'Kia', 'Sedona'),
(376, 'Kia', 'Seltos'),
(377, 'Nissan', 'Sentra'),
(378, 'Toyota', 'Sequoia'),
(379, 'Ferrari', 'SF90'),
(380, 'Toyota', 'Sienna'),
(381, 'GMC', 'Sierra 1500 Crew Cab'),
(382, 'GMC', 'Sierra 1500 Double Cab'),
(383, 'GMC', 'Sierra 1500 Limited Crew Cab'),
(384, 'GMC', 'Sierra 1500 Limited Double Cab'),
(385, 'GMC', 'Sierra 1500 Limited Regular Cab'),
(386, 'GMC', 'Sierra 1500 Regular Cab'),
(387, 'GMC', 'Sierra 2500 HD Crew Cab'),
(388, 'GMC', 'Sierra 2500 HD Double Cab'),
(389, 'GMC', 'Sierra 2500 HD Regular Cab'),
(390, 'GMC', 'Sierra 3500 HD Crew Cab'),
(391, 'GMC', 'Sierra 3500 HD Double Cab'),
(392, 'GMC', 'Sierra 3500 HD Regular Cab'),
(393, 'GMC', 'Sierra EV'),
(394, 'Chevrolet', 'Silverado 1500 Crew Cab'),
(395, 'Chevrolet', 'Silverado 1500 Double Cab'),
(396, 'Chevrolet', 'Silverado 1500 Limited Crew Cab'),
(397, 'Chevrolet', 'Silverado 1500 Limited Double Cab'),
(398, 'Chevrolet', 'Silverado 1500 Limited Regular Cab'),
(399, 'Chevrolet', 'Silverado 1500 Regular Cab'),
(400, 'Chevrolet', 'Silverado 2500 HD Crew Cab'),
(401, 'Chevrolet', 'Silverado 2500 HD Double Cab'),
(402, 'Chevrolet', 'Silverado 2500 HD Regular Cab'),
(403, 'Chevrolet', 'Silverado 3500 HD Crew Cab'),
(404, 'Chevrolet', 'Silverado 3500 HD Double Cab'),
(405, 'Chevrolet', 'Silverado 3500 HD Regular Cab'),
(406, 'Chevrolet', 'Silverado EV'),
(407, 'Subaru', 'Solterra'),
(408, 'Hyundai', 'Sonata'),
(409, 'Hyundai', 'Sonata Hybrid'),
(410, 'Kia', 'Sorento'),
(411, 'Kia', 'Sorento Hybrid'),
(412, 'Kia', 'Sorento Plug-in Hybrid'),
(413, 'Kia', 'Soul'),
(414, 'Chevrolet', 'Spark'),
(415, 'Kia', 'Sportage'),
(416, 'Kia', 'Sportage Hybrid'),
(417, 'Kia', 'Sportage Plug-in Hybrid'),
(418, 'Freightliner', 'Sprinter 1500 Cargo'),
(419, 'Mercedes-Benz', 'Sprinter 1500 Cargo'),
(420, 'Freightliner', 'Sprinter 1500 Passenger'),
(421, 'Mercedes-Benz', 'Sprinter 1500 Passenger'),
(422, 'Freightliner', 'Sprinter 2500 Cargo'),
(423, 'Mercedes-Benz', 'Sprinter 2500 Cargo'),
(424, 'Freightliner', 'Sprinter 2500 Crew'),
(425, 'Mercedes-Benz', 'Sprinter 2500 Crew'),
(426, 'Freightliner', 'Sprinter 2500 Passenger'),
(427, 'Mercedes-Benz', 'Sprinter 2500 Passenger'),
(428, 'Freightliner', 'Sprinter 3500 Cargo'),
(429, 'Mercedes-Benz', 'Sprinter 3500 Cargo'),
(430, 'Freightliner', 'Sprinter 3500 Crew'),
(431, 'Mercedes-Benz', 'Sprinter 3500 Crew'),
(432, 'Mercedes-Benz', 'Sprinter 3500 XD Cargo'),
(433, 'Freightliner', 'Sprinter 3500 XD Crew'),
(434, 'Mercedes-Benz', 'Sprinter 3500 XD Crew'),
(435, 'Freightliner', 'Sprinter 3500XD Cargo'),
(436, 'Freightliner', 'Sprinter 4500 Cargo'),
(437, 'Mercedes-Benz', 'Sprinter 4500 Cargo'),
(438, 'Freightliner', 'Sprinter 4500 Crew'),
(439, 'Mercedes-Benz', 'Sprinter 4500 Crew'),
(440, 'Audi', 'SQ5'),
(441, 'Audi', 'SQ5 Sportback'),
(442, 'Audi', 'SQ7'),
(443, 'Audi', 'SQ8'),
(444, 'Alfa Romeo', 'Stelvio'),
(445, 'Kia', 'Stinger'),
(446, 'Chevrolet', 'Suburban'),
(447, 'Toyota', 'Tacoma Access Cab'),
(448, 'Toyota', 'Tacoma Double Cab'),
(449, 'Chevrolet', 'Tahoe'),
(450, 'Volkswagen', 'Taos'),
(451, 'Porsche', 'Taycan'),
(452, 'Porsche', 'Taycan Cross Turismo'),
(453, 'Kia', 'Telluride'),
(454, 'GMC', 'Terrain'),
(455, 'Volkswagen', 'Tiguan'),
(456, 'Nissan', 'Titan Crew Cab'),
(457, 'Nissan', 'Titan King Cab'),
(458, 'Nissan', 'TITAN XD Crew Cab'),
(459, 'Acura', 'TLX'),
(460, 'Alfa Romeo', 'Tonale'),
(461, 'Chevrolet', 'Trailblazer'),
(462, 'Ford', 'Transit 150 Cargo Van'),
(463, 'Ford', 'Transit 150 Crew Van'),
(464, 'Ford', 'Transit 150 Passenger Van'),
(465, 'Ford', 'Transit 250 Cargo Van'),
(466, 'Ford', 'Transit 250 Crew Van'),
(467, 'Ford', 'Transit 350 Cargo Van'),
(468, 'Ford', 'Transit 350 Crew Van'),
(469, 'Ford', 'Transit 350 HD Cargo Van'),
(470, 'Ford', 'Transit 350 HD Crew Van'),
(471, 'Ford', 'Transit 350 Passenger Van'),
(472, 'Ford', 'Transit Connect Cargo Van'),
(473, 'Ford', 'Transit Connect Passenger Wagon'),
(474, 'Chevrolet', 'Traverse'),
(475, 'Chevrolet', 'Trax'),
(476, 'Audi', 'TT'),
(477, 'Hyundai', 'Tucson'),
(478, 'Hyundai', 'Tucson Hybrid'),
(479, 'Hyundai', 'Tucson Plug-in Hybrid'),
(480, 'Toyota', 'Tundra CrewMax'),
(481, 'Toyota', 'Tundra Double Cab'),
(482, 'Toyota', 'Tundra Hybrid CrewMax'),
(483, 'Lexus', 'TX'),
(484, 'Lamborghini', 'Urus'),
(485, 'Lexus', 'UX'),
(486, 'Volvo', 'V60'),
(487, 'Volvo', 'V90'),
(488, 'Aston Martin', 'Vantage'),
(489, 'Hyundai', 'Veloster'),
(490, 'Hyundai', 'Venue'),
(491, 'Toyota', 'Venza'),
(492, 'Nissan', 'Versa'),
(493, 'VinFast', 'VF 6'),
(494, 'VinFast', 'VF 7'),
(495, 'VinFast', 'VF 8'),
(496, 'VinFast', 'VF 9'),
(497, 'Jeep', 'Wagoneer'),
(498, 'Jeep', 'Wagoneer L'),
(499, 'Rolls-Royce', 'Wraith'),
(500, 'Jeep', 'Wrangler'),
(501, 'Jeep', 'Wrangler 4xe'),
(502, 'Jeep', 'Wrangler Unlimited'),
(503, 'Jeep', 'Wrangler Unlimited 4xe'),
(504, 'Subaru', 'WRX'),
(505, 'BMW', 'X1'),
(506, 'BMW', 'X2'),
(507, 'BMW', 'X3'),
(508, 'BMW', 'X3 M'),
(509, 'BMW', 'X4'),
(510, 'BMW', 'X4 M'),
(511, 'BMW', 'X5'),
(512, 'BMW', 'X5 M'),
(513, 'BMW', 'X6'),
(514, 'BMW', 'X6 M'),
(515, 'BMW', 'X7'),
(516, 'Volvo', 'XC40'),
(517, 'Volvo', 'XC40 Recharge'),
(518, 'Volvo', 'XC60'),
(519, 'Volvo', 'XC90'),
(520, 'Jaguar', 'XF'),
(521, 'BMW', 'XM'),
(522, 'Cadillac', 'XT4'),
(523, 'Cadillac', 'XT5'),
(524, 'Cadillac', 'XT6'),
(525, 'GMC', 'Yukon'),
(526, 'GMC', 'Yukon XL'),
(527, 'Nissan', 'Z'),
(528, 'BMW', 'Z4'),
(529, 'Polestar', '1'),
(530, 'Ram', '1500 Classic Crew Cab'),
(531, 'Ram', '1500 Classic Quad Cab'),
(532, 'Ram', '1500 Classic Regular Cab'),
(533, 'Ram', '1500 Crew Cab'),
(534, 'Ram', '1500 Quad Cab'),
(535, 'Polestar', '2'),
(536, 'BMW', '2 Series'),
(537, 'Ram', '2500 Crew Cab'),
(538, 'Ram', '2500 Mega Cab'),
(539, 'Ram', '2500 Regular Cab'),
(540, 'Ferrari', '296 GTB'),
(541, 'Polestar', '3'),
(542, 'BMW', '3 Series'),
(543, 'Chrysler', '300'),
(544, 'Ram', '3500 Crew Cab'),
(545, 'Ram', '3500 Mega Cab'),
(546, 'Ram', '3500 Regular Cab'),
(547, 'BMW', '4 Series'),
(548, 'Ferrari', '488 Pista'),
(549, 'Toyota', '4Runner'),
(550, 'Polestar', '5'),
(551, 'BMW', '5 Series'),
(552, 'FIAT', '500X'),
(553, 'BMW', '7 Series'),
(554, 'Porsche', '718 Boxster'),
(555, 'Porsche', '718 Cayman'),
(556, 'Porsche', '718 Spyder'),
(557, 'BMW', '8 Series'),
(558, 'Ferrari', '812 Competizione'),
(559, 'Ferrari', '812 Competizione A'),
(560, 'Ferrari', '812 GTS'),
(561, 'Ferrari', '812 Superfast'),
(562, 'Toyota', '86'),
(563, 'Porsche', '911');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `city_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city_name`) VALUES
(1, 'ajloun'),
(2, 'amman'),
(3, 'aqaba'),
(4, 'balqa'),
(5, 'irbid'),
(6, 'jerash'),
(7, 'karak'),
(8, 'maan'),
(9, 'madaba'),
(10, 'mafraq'),
(11, 'tafilah'),
(12, 'zarqa');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `des` varchar(10000) DEFAULT NULL,
  `img_path` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `city_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `des`, `img_path`, `price`, `user_id`, `car_id`, `city_name`) VALUES
(1, 'Audi A8 Good', 'very Good big Ass', 'user_images/11.webp', 15000, 1, 1, 'Amman'),
(2, 'corolla very nice black color', '0796413255', 'user_images/22.webp', 9520, 2, 2, 'Maan'),
(3, 'picanto maklh 100 X', '5rbannh tshlee7', 'user_images/23.webp', 7000, 2, 3, 'Amman'),
(4, 'Mercedes G class أخر حبة', 'أول واخر حبة G class في البلد', 'user_images/34.webp', 60000, 3, 4, 'Mafraq'),
(5, 'فيات موديل السنة', 'اخر موديل فيات فل كامل 7 جيد ولا قصعه من المالك مباشرة لانقبل الأقساط', 'user_images/45.webp', 11000, 4, 5, 'Zarqa');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL,
  `phonenumber` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `first_name`, `last_name`, `email`, `pass`, `phonenumber`) VALUES
(1, 'khaled', 'al3rs', 'al3rs@gmail.com', '12345678', 'aw'),
(2, 'omar', 'alomar', 'alomar@yahoo.com', 'nsfens@des0f', 'sef'),
(3, 'emad', 'alakram', 'emad2000@hotmail.com', 'aaaa', '0796413255'),
(4, 'grdgdg', 'drgdrg', 'root@fesf.sefs', '12345678', '3242352');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_info`
--
ALTER TABLE `car_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `car_info`
--
ALTER TABLE `car_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=564;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
