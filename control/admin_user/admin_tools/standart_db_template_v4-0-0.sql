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
-- Database: `GBone_`
--

-- --------------------------------------------------------

--
-- Table structure for table `GBone_country`
--

CREATE TABLE `GBone_country` (
  `countryID` int(8) NOT NULL,
  `name` varchar(16) NOT NULL,
  `code` varchar(4) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GBone_country`
--

INSERT INTO `GBone_country` (`countryID`, `name`, `code`, `active`) VALUES
(1, 'denmark', 'DK', 1);

-- --------------------------------------------------------

--
-- Table structure for table `GBone_navi`
--

CREATE TABLE `GBone_navi` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `link` varchar(40) NOT NULL,
  `language` varchar(8) NOT NULL,
  `required` int(11) NOT NULL,
  `navi_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GBone_navi`
--

INSERT INTO `GBone_navi` (`id`, `name`, `link`, `language`, `required`, `navi_order`) VALUES
(1, 'Index', 'index', 'DK', 1, 1),
(2, 'KONTAKT', 'kontakt', 'DK', 1, 3),
(3, 'content', 'page?id=content', 'DK', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `GBone_text`
--

CREATE TABLE `GBone_text` (
  `id` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `language` varchar(8) NOT NULL,
  `page_name` varchar(32) NOT NULL,
  `required` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GBone_text`
--

INSERT INTO `GBone_text` (`id`, `text`, `language`, `page_name`, `required`) VALUES
(1, '<h1><span style=\"font-size:16px\"><strong>Kontakt</strong></span></h1>\r\n\r\n<p><span style=\"font-size:12px\">Brug kontakt formular herunder</span></p>\r\n', 'DK', 'contact', 1),
(2, '<p>Index tekst</p>\r\n', 'DK', 'index', 1),
(3, '<p>Her kan skrives alt det content at du vil have p&aring; side</p>\r\n', 'DK', 'content', 0);

-- --------------------------------------------------------

--
-- Table structure for table `GBone_users`
--

CREATE TABLE `GBone_users` (
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
-- Dumping data for table `GBone_users`
--

INSERT INTO `GBone_users` (`id`, `username`, `username_clean`, `mail`, `loginlevel`, `password`, `active`, `recoverycode`, `recoverytime`) VALUES
(1, 'Rhodez', 'rhodez', 'jorn@guld-berg.dk', 50, '4069599633d6afb2ca255bbc4f871e2f08dff2e17a58f0e8273af4bf0975bcf5', 1, '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `GBone_country`
--
ALTER TABLE `GBone_country`
  ADD PRIMARY KEY (`countryID`),
  ADD UNIQUE KEY `countryID` (`countryID`);

--
-- Indexes for table `GBone_navi`
--
ALTER TABLE `GBone_navi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `GBone_text`
--
ALTER TABLE `GBone_text`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_name` (`id`);

--
-- Indexes for table `GBone_users`
--
ALTER TABLE `GBone_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `GBone_country`
--
ALTER TABLE `GBone_country`
  MODIFY `countryID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `GBone_navi`
--
ALTER TABLE `GBone_navi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `GBone_text`
--
ALTER TABLE `GBone_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `GBone_users`
--
ALTER TABLE `GBone_users`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
