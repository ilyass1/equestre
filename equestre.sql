-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2020 at 02:15 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `equestre`
--

-- --------------------------------------------------------

--
-- Table structure for table `adherents`
--

CREATE TABLE `adherents` (
  `adherent_code` varchar(20) NOT NULL,
  `nom` varchar(15) NOT NULL,
  `prenom` varchar(15) NOT NULL,
  `date_naissance` date NOT NULL,
  `adresse` text NOT NULL,
  `telephone` varchar(12) NOT NULL,
  `date_inscription` date NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `code_frere` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `adherents`
--

INSERT INTO `adherents` (`adherent_code`, `nom`, `prenom`, `date_naissance`, `adresse`, `telephone`, `date_inscription`, `description`, `code_frere`) VALUES
('INV', 'jmyi', 'ilyass', '2020-01-31', 'NR 98 LOT FADLI HAY OUED EDDAHAB', '06528820', '2020-01-31', '', 'hhfgf');

-- --------------------------------------------------------

--
-- Table structure for table `adherent_payment`
--

CREATE TABLE `adherent_payment` (
  `adherent_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cotisation` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `janvier` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `février` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `mars` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `avril` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `mai` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `juin` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `juillet` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `août` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `septembre` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `octobre` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `novembre` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `decembre` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `adherent_payment`
--

INSERT INTO `adherent_payment` (`adherent_code`, `cotisation`, `janvier`, `février`, `mars`, `avril`, `mai`, `juin`, `juillet`, `août`, `septembre`, `octobre`, `novembre`, `decembre`) VALUES
('INV', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `nom` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`nom`, `email`, `commentaire`) VALUES
('ilyass jmyi', 'ilyassilyass007@gmail.com', 'kdgdfg');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id_event` int(3) NOT NULL,
  `title` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `event_date` date NOT NULL,
  `temps` time NOT NULL,
  `publication_date` date NOT NULL,
  `event_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `horses`
--

CREATE TABLE `horses` (
  `horse_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `owner_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `horse_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `coat_color` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `box_number` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owners`
--

CREATE TABLE `owners` (
  `owner_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `prenom` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_naissance` date NOT NULL,
  `adresse` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telephone` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date_inscription` date NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `code_frere` text CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `owners`
--

INSERT INTO `owners` (`owner_code`, `nom`, `prenom`, `date_naissance`, `adresse`, `telephone`, `date_inscription`, `description`, `code_frere`) VALUES
('INVkjl', 'amine', 'elmoutacim', '2020-01-31', 'akkary', '0652882079', '2020-01-30', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `owners_payment`
--

CREATE TABLE `owners_payment` (
  `owner_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cotisation` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `janvier` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `février` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `mars` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `avril` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `mai` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `juin` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `juillet` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `août` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `septembre` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `octobre` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `novembre` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé',
  `decembre` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'non payé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `owners_payment`
--

INSERT INTO `owners_payment` (`owner_code`, `cotisation`, `janvier`, `février`, `mars`, `avril`, `mai`, `juin`, `juillet`, `août`, `septembre`, `octobre`, `novembre`, `decembre`) VALUES
('INVkjl', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé', 'non payé');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user` varchar(25) NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user`, `pass`) VALUES
('mimosa@gmail.com', '$2y$10$cpvGtJygXUUUJRzYUi2MuOtpHd2ujodadv0Ob1nWzAAhdHW85YSua');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adherents`
--
ALTER TABLE `adherents`
  ADD PRIMARY KEY (`adherent_code`),
  ADD UNIQUE KEY `adherent_code` (`adherent_code`);

--
-- Indexes for table `adherent_payment`
--
ALTER TABLE `adherent_payment`
  ADD PRIMARY KEY (`adherent_code`),
  ADD UNIQUE KEY `adherent_code` (`adherent_code`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `horses`
--
ALTER TABLE `horses`
  ADD PRIMARY KEY (`horse_code`),
  ADD UNIQUE KEY `horse_code` (`horse_code`),
  ADD KEY `FK_owner_code` (`owner_code`);

--
-- Indexes for table `owners`
--
ALTER TABLE `owners`
  ADD PRIMARY KEY (`owner_code`),
  ADD UNIQUE KEY `owner_code` (`owner_code`);

--
-- Indexes for table `owners_payment`
--
ALTER TABLE `owners_payment`
  ADD PRIMARY KEY (`owner_code`),
  ADD UNIQUE KEY `owners_code` (`owner_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id_event` int(3) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adherent_payment`
--
ALTER TABLE `adherent_payment`
  ADD CONSTRAINT `adherent_payment_ibfk_1` FOREIGN KEY (`adherent_code`) REFERENCES `adherents` (`adherent_code`);

--
-- Constraints for table `horses`
--
ALTER TABLE `horses`
  ADD CONSTRAINT `FK_owner_code` FOREIGN KEY (`owner_code`) REFERENCES `owners` (`owner_code`);

--
-- Constraints for table `owners_payment`
--
ALTER TABLE `owners_payment`
  ADD CONSTRAINT `owners_payment_ibfk_1` FOREIGN KEY (`owner_code`) REFERENCES `owners` (`owner_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
