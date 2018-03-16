-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 09, 2018 at 08:01 PM
-- Server version: 10.1.26-MariaDB-0+deb9u1
-- PHP Version: 7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `GBone`
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
  `link` varchar(40) NOT NULL,
  `required` int(11) NOT NULL,
  `navi_order` int(11) NOT NULL,
  `permission` int(11) NOT NULL,
  `place` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GBone_navi`
--

INSERT INTO `GBone_navi` (`id`, `link`, `required`, `navi_order`, `permission`, `place`) VALUES
(1, 'index', 1, 1, 0, 'standart'),
(2, 'page?id=page', 0, 2, 0, 'standart'),
(3, 'kontakt', 0, 3, 0, 'standart'),
(4, 'control/index', 1, 1, 2, 'controlpanel'),
(5, 'control/user_control', 1, 2, 2, 'controlpanel'),
(6, 'control/master_control', 1, 3, 2, 'controlpanel');

-- --------------------------------------------------------

--
-- Table structure for table `GBone_navi_name`
--

CREATE TABLE `GBone_navi_name` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `language` varchar(8) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GBone_navi_name`
--

INSERT INTO `GBone_navi_name` (`id`, `name`, `language`, `parent_id`) VALUES
(1, 'Forside', 'DK', 1),
(2, 'Page', 'DK', 2),
(3, 'Kontakt', 'DK', 3),
(4, 'Min side', 'DK', 4),
(5, 'Mine instillinger', 'DK', 5),
(6, 'Master control', 'DK', 6);

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
(0, 'allow_any', 'This is a rule for a visitor, the visitor does not have to login '),
(1, 'create_user', 'Allowed to create a new user'),
(2, 'user_control_panel', 'Gain access to the user controlpanel');

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
  `parent_id` int(11) NOT NULL,
  `required` int(11) NOT NULL,
  `bgimg` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GBone_text`
--

INSERT INTO `GBone_text` (`id`, `text`, `language`, `parent_id`, `required`, `bgimg`) VALUES
(2, '<p>Standart forside</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Dette er version rtm5.0.0a0</p>\r\n', 'DK', 1, 1, ''),
(3, 'Brug formularen', 'DK', 3, 0, ''),
(4, 'Det er en side', 'DK', 2, 0, '');

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
-- Indexes for table `GBone_navi_name`
--
ALTER TABLE `GBone_navi_name`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `GBone_navi_name`
--
ALTER TABLE `GBone_navi_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `GBone_permissions`
--
ALTER TABLE `GBone_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `GBone_permission_groups`
--
ALTER TABLE `GBone_permission_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `GBone_text`
--
ALTER TABLE `GBone_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `GBone_users`
--
ALTER TABLE `GBone_users`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
