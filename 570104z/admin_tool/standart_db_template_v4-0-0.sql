-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 26, 2017 at 10:12 AM
-- Server version: 5.5.58-0+deb8u1
-- PHP Version: 7.0.24-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ReplaceDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `ReplaceDBcountry`
--

CREATE TABLE `ReplaceDBcountry` (
  `countryID` int(8) NOT NULL,
  `name` varchar(16) NOT NULL,
  `code` varchar(4) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ReplaceDBcountry`
--

INSERT INTO `ReplaceDBcountry` (`countryID`, `name`, `code`, `active`) VALUES
(1, 'denmark', 'DK', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ReplaceDBnavi`
--

CREATE TABLE `ReplaceDBnavi` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `link` varchar(40) NOT NULL,
  `language` varchar(8) NOT NULL,
  `required` int(11) NOT NULL,
  `navi_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ReplaceDBnavi`
--

INSERT INTO `ReplaceDBnavi` (`id`, `name`, `link`, `language`, `required`, `navi_order`) VALUES
(1, 'Index', 'index', 'DK', 1, 1),
(2, 'KONTAKT', 'kontakt', 'DK', 1, 3),
(3, 'Indhold', 'page?id=Indhold', 'DK', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `ReplaceDBtext`
--

CREATE TABLE `ReplaceDBtext` (
  `id` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `language` varchar(8) NOT NULL,
  `page_name` varchar(32) NOT NULL,
  `required` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ReplaceDBtext`
--

INSERT INTO `ReplaceDBtext` (`id`, `text`, `language`, `page_name`, `required`) VALUES
(1, '<h1><span style=\"font-size:16px\"><strong>Kontakt</strong></span></h1>\r\n\r\n<p><span style=\"font-size:12px\">Brug kontakt formular herunder</span></p>\r\n', 'DK', 'contact', 1),
(2, '<p>Index tekst</p>\r\n', 'DK', 'index', 1),
(3, '<p>Her kan skrives alt det indhold at du vil have p&aring; side</p>\r\n', 'DK', 'Indhold', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ReplaceDBusers`
--

CREATE TABLE `ReplaceDBusers` (
  `id` int(2) NOT NULL,
  `username` varchar(40) NOT NULL,
  `username_clean` varchar(40) NOT NULL,
  `mail` varchar(64) NOT NULL,
  `loginlevel` int(2) NOT NULL,
  `password` varchar(128) NOT NULL,
  `active` int(11) NOT NULL,
  `recoverycode` varchar(16) NOT NULL,
  `recoverytime` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ReplaceDBusers`
--

INSERT INTO `ReplaceDBusers` (`id`, `username`, `username_clean`, `mail`, `loginlevel`, `password`, `active`, `recoverycode`, `recoverytime`) VALUES
(1, 'Rhodez', 'rhodez', 'jorn@guld-berg.dk', 50, '4069599633d6afb2ca255bbc4f871e2f08dff2e17a58f0e8273af4bf0975bcf5', 1, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ReplaceDBcountry`
--
ALTER TABLE `ReplaceDBcountry`
  ADD PRIMARY KEY (`countryID`),
  ADD UNIQUE KEY `countryID` (`countryID`);

--
-- Indexes for table `ReplaceDBnavi`
--
ALTER TABLE `ReplaceDBnavi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `ReplaceDBtext`
--
ALTER TABLE `ReplaceDBtext`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_name` (`id`);

--
-- Indexes for table `ReplaceDBusers`
--
ALTER TABLE `ReplaceDBusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ReplaceDBcountry`
--
ALTER TABLE `ReplaceDBcountry`
  MODIFY `countryID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ReplaceDBnavi`
--
ALTER TABLE `ReplaceDBnavi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ReplaceDBtext`
--
ALTER TABLE `ReplaceDBtext`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ReplaceDBusers`
--
ALTER TABLE `ReplaceDBusers`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
