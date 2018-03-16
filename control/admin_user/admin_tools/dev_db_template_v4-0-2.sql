-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2017 at 06:38 PM
-- Server version: 5.5.57-0+deb8u1
-- PHP Version: 7.0.23-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `GBone_admin_info`
--

CREATE TABLE `GBone_admin_info` (
  `id` int(11) NOT NULL,
  `titel` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `priority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GBone_admin_info`
--

INSERT INTO `GBone_admin_info` (`id`, `titel`, `description`, `priority`) VALUES
(1, 'Devoloper', 'Devoloper', -100);

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
(1, 'Forside', 'index', 'DK', 1, 1),
(2, 'Page', 'page?id=page', 'DK', 0, 2),
(3, 'Kontak', 'kontakt', 'DK', 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `GBone_permissions`
--

CREATE TABLE `GBone_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GBone_permissions`
--

INSERT INTO `GBone_permissions` (`id`, `name`, `description`) VALUES
(1, 'create_user', 'Allowed to create a new user');

-- --------------------------------------------------------

--
-- Table structure for table `GBone_permission_groups`
--

CREATE TABLE `GBone_permission_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GBone_permission_groups`
--

INSERT INTO `GBone_permission_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Adminstrators of the site');

-- --------------------------------------------------------

--
-- Table structure for table `GBone_permission_group_relation`
--

CREATE TABLE `GBone_permission_group_relation` (
  `permission_id` int(11) NOT NULL,
  `permission_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GBone_permission_group_relation`
--

INSERT INTO `GBone_permission_group_relation` (`permission_id`, `permission_group_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `GBone_text`
--

CREATE TABLE `GBone_text` (
  `id` int(11) NOT NULL,
  `text` longtext NOT NULL,
  `language` varchar(8) NOT NULL,
  `page_name` varchar(32) NOT NULL,
  `required` int(11) NOT NULL,
  `bgimg` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GBone_text`
--

INSERT INTO `GBone_text` (`id`, `text`, `language`, `page_name`, `required`, `bgimg`) VALUES
(2, 'Standart forside', 'DK', 'index', 1, ''),
(3, 'Brug formularen', 'DK', 'kontakt', 0, ''),
(4, 'Det er en side', 'DK', 'Page', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `GBone_users`
--

CREATE TABLE `GBone_users` (
  `id` int(2) NOT NULL,
  `username` varchar(40) NOT NULL,
  `username_clean` varchar(40) NOT NULL,
  `mail` varchar(64) NOT NULL,
  `mobile` varchar(16) NOT NULL,
  `loginlevel` int(2) NOT NULL,
  `permission_group_id` int(11) NOT NULL,
  `password` varchar(128) NOT NULL,
  `active` int(11) NOT NULL,
  `recoverycode` varchar(16) NOT NULL,
  `recoverytime` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GBone_users`
--

INSERT INTO `GBone_users` (`id`, `username`, `username_clean`, `mail`, `mobile`, `loginlevel`, `permission_group_id`, `password`, `active`, `recoverycode`, `recoverytime`) VALUES
(1, 'Rhodez', 'rhodez', 'jorn@guld-berg.dk', '25336607', 50, 1, '4069599633d6afb2ca255bbc4f871e2f08dff2e17a58f0e8273af4bf0975bcf5', 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `GBone_user_info`
--

CREATE TABLE `GBone_user_info` (
  `id` int(11) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `profile_text` text NOT NULL,
  `profile_img` varchar(128) NOT NULL,
  `hidden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GBone_user_info`
--

INSERT INTO `GBone_user_info` (`id`, `firstname`, `lastname`, `profile_text`, `profile_img`, `hidden`) VALUES
(1, 'Jørn', 'Guldberg', 'Devoloper', '/570404v/1/0309b3fe35ae9c7442950812ab2f35531511732371.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `GBone_admin_info`
--
ALTER TABLE `GBone_admin_info`
  ADD UNIQUE KEY `id` (`id`);

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
-- Indexes for table `GBone_permissions`
--
ALTER TABLE `GBone_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `GBone_permission_groups`
--
ALTER TABLE `GBone_permission_groups`
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
-- Indexes for table `GBone_user_info`
--
ALTER TABLE `GBone_user_info`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `GBone_permissions`
--
ALTER TABLE `GBone_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `GBone_permission_groups`
--
ALTER TABLE `GBone_permission_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `GBone_text`
--
ALTER TABLE `GBone_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `GBone_users`
--
ALTER TABLE `GBone_users`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
