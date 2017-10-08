CREATE TABLE `ReplaceDBcountry` (
  `countryID` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `code` varchar(4) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`countryID`),
  UNIQUE KEY `countryID` (`countryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;


INSERT INTO `ReplaceDBcountry` (`countryID`, `name`, `code`, `active`) VALUES
(1, 'denmark', 'DK', 1),
(5, 'belgium', 'BE', 0),
(6, 'netherlands', 'NL', 0),
(7, 'luxembourg', 'LU', 0),
(8, 'germany', 'DE', 0),
(9, 'poland', 'PL', 0),
(10, 'sweden', 'SE', 0),
(11, 'czech republic', 'CZ', 0),
(12, 'austria', 'AT', 0),
(13, 'united kingdom', 'GB', 1),
(14, 'finland', 'FI', 0),
(15, 'france', 'FR', 0),
(16, 'italy', 'IT', 0),
(17, 'northern ireland', 'GBN', 0),
(18, 'scotland', 'GBS', 0),
(19, 'slovakia', 'SK', 0),
(20, 'wales', 'GBW', 0),
(21, 'bulgaria', 'BG', 0),
(22, 'estonia', 'EE', 0),
(23, 'ireland', 'IE', 0),
(24, 'croatia', 'HR', 0),
(25, 'latvia', 'LV', 0),
(26, 'portugal', 'PT', 0),
(27, 'romania', 'RO', 0),
(28, 'slovenia', 'SI', 0),
(29, 'spain', 'ES', 0),
(30, 'hungary', 'HU', 0),
(31, 'lithuania', 'LT', 0);

CREATE TABLE `ReplaceDBnavi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `link` varchar(32) NOT NULL,
  `language` varchar(8) NOT NULL,
  `required` int(11) NOT NULL,
  `navi_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO `ReplaceDBnavi` VALUES (1,'Index','index','GB',1,1),(6,'CONTACT','kontakt','GB',1,7),(7,'Index','index','DK',1,1),(12,'KONTAKT','kontakt','DK',1,7),(13,'Indhold','page?id=Indhold','DK',0,6),(14,'Content','page?id=Indhold','GB',0,6);

CREATE TABLE `ReplaceDBtext` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `language` varchar(8) NOT NULL,
  `page_name` varchar(32) NOT NULL,
  `required` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_name` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO `ReplaceDBtext` VALUES (1,'<h1><span style=\"font-size:16px\"><strong>Kontakt</strong></span></h1>\r\n\r\n<p><span style=\"font-size:12px\">Brug kontakt formular herunder</span></p>\r\n','DK','contact',1),(3,'<p>Noget tekst</p>\r\n','DK','index',1),(10,'','GB','index',1),(11,'<h1><strong><span style=\"font-size:16px\">Contact</span></strong></h1>\r\n\r\n<p><span style=\"font-size:12px\">Use the formular below</span></p>\r\n','GB','contact',1),(15,'<p>Her kan skrives alt det indhold at du vil have p&aring; side</p>\r\n','DK','Indhold',0),(16,'Content','GB','Indhold',0);

CREATE TABLE `ReplaceDBusers` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `username_clean` varchar(32) NOT NULL,
  `loginlevel` int(2) NOT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

INSERT INTO `ReplaceDBusers` VALUES (5,'Rhodez','rhodez',50,'4069599633d6afb2ca255bbc4f871e2f08dff2e17a58f0e8273af4bf0975bcf5');
