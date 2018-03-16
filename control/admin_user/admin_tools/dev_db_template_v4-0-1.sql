-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 26, 2017 at 09:47 PM
-- Server version: 5.5.58-0+deb8u1
-- PHP Version: 7.0.25-1~dotdeb+8.1

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
-- Table structure for table `GBone_calender`
--

CREATE TABLE `GBone_calender` (
  `id` int(11) NOT NULL,
  `owner_user_id` int(11) NOT NULL,
  `name` varchar(48) NOT NULL,
  `description` mediumtext NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `GBone_images`
--

CREATE TABLE `GBone_images` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dir` varchar(128) NOT NULL,
  `uploaded` datetime NOT NULL,
  `is_profile_img` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(3, 'Klubben', 'page?id=klubben', 'DK', 0, 2),
(4, 'Vedtægter', 'page?id=Vedtægter', 'DK', 0, 3),
(5, 'Medlemmers side', 'medlemmer', 'DK', 1, 4),
(6, 'Bestyrelse', 'bestyrelsen', 'DK', 1, 5),
(8, 'Program', 'page?id=Program', 'DK', 0, 7),
(9, 'Link', 'page?id=Link', 'DK', 0, 8);

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
(2, '<h1 style=\"text-align:right\">&nbsp;</h1>\r\n\r\n<h1 style=\"text-align:right\">&nbsp;</h1>\r\n\r\n<h1 style=\"text-align:right\">&nbsp;</h1>\r\n\r\n<h1 style=\"text-align:right\">&nbsp;</h1>\r\n\r\n<h1 style=\"text-align:right\">&nbsp;</h1>\r\n\r\n<h1 style=\"text-align:right\"><span style=\"color:#ffffff\">Det skal v&aelig;re sjovt<br />\r\nat fotografere!</span></h1>\r\n', 'DK', 'index', 1, ''),
(3, '<h2><span style=\"font-size:22px\"><span style=\"font-family:verdana,geneva,sans-serif\"><strong>Kerteminde Fotoklub</strong></span></span></h2>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">Kerteminde Fotoklub blev startet op i april 2011, og kort efter fik vi et&nbsp;rigtig&nbsp;godt&nbsp;lokale&nbsp;p&aring; Bakkeg&aring;rdsskolen i Langeskov.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">Kerteminde Fotoklub er en klub hvor der er plads til alle - b&aring;de professionelle og amat&oslash;rer. Form&aring;let med klubben er at fremme interessen for fotografering, og vi hj&aelig;lper gerne hinanden med hensyn til billederedigering, fototeknik m.m.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">Vi deler samme interesse for fotografering, men vi har i klubben mange forskellige interesseomr&aring;der for valg af motiver, ligesom vores tekniske kunnen ogs&aring; sp&aelig;nder vidt, men vi bestr&aelig;ber p&aring; at hj&aelig;lpe og motivere hinanden til at komme videre med vores f&aelig;lles interesse, at lave gode billeder</span><span style=\"font-family:verdana,geneva,sans-serif\"> og forbedre teknikken, finde nye vinkler, - s&aring; er du ogs&aring; bidt af verdens bedste kreative hobby, s&aring; kunne Kerteminde Fotoklub m&aring;ske v&aelig;re noget for dig.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">K&oslash;n, alder, erfaring, og udstyr er ikke det v&aelig;sentlige..... Det handler om, at alle f&aring;r noget ud af, at v&aelig;re sammen med ligesindede og ikke mindst, -&nbsp;at f&aring; taget en masse gode billeder sammen.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">Vi har i klubben et fotostudie, som medlemmerne kan g&oslash;re brug af de aftener, der ikke er klubaften, til model og portr&aelig;tfotografering m.m.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">Skulle du have lyst til at se hvad vi er for nogle, er vores d&oslash;r altid &aring;ben for nye medlemmer, men det er en god id&eacute; lige at kontakte en af klubbens medlemmer f&oslash;rst, s&aring; vi er klar til at tage godt imod dig.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">Vi har klubaften hver tirsdag fra kl. 19 - ?</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">Langeskov skole &quot;bakken&quot;</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">R&oslash;nningevej 38</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">5550 Langeskov</span></p>\r\n', 'DK', 'klubben', 0, ''),
(4, '<h2><span style=\"font-family:verdana,geneva,sans-serif\">Generelt</span></h2>\r\n\r\n<div class=\"art-postcontent\">\r\n<div class=\"art-article\">\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;1. Klubbens navn er Kerteminde Fotoklub (CVR-nr&nbsp;</span>35791590)</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;2. Klubbens form&aring;l er at udvikle medlemmernes evner og interesser for fotografi og billedbehandling. Klubben s&oslash;ger ved afholdelse af m&oslash;der, foredrag, konkurrencer og lign. samt ved deltagelse i nationale og internationale konkurrence- og udstillingsarrangementer at udvikle medlemmernes fotografiske f&aelig;rdigheder.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;3. Klubben har hjemsted p&aring; Langeskov Skole.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;4. Enhver person kan optages som medlem af klubben. Indmeldelse sker ved henvendelse til bestyrelsen.</span></p>\r\n\r\n<h2><span style=\"font-family:verdana,geneva,sans-serif\">Klubbens bestyrelse</span></h2>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;5. Klubben ledes af en bestyrelse p&aring; 4 medlemmer, som v&aelig;lges af generalforsamlingen. Bestyrelsesmedlemmer v&aelig;lges for 2 &aring;r.&nbsp;</span><br />\r\n<span style=\"font-family:verdana,geneva,sans-serif\">Generalforsamlingen v&aelig;lger tillige 2 bestyrelsessuppleanter for 1 &aring;r. Derudover v&aelig;lges en revisor og revisorsuppleant p&aring; generalforsamlingen for 1 &aring;r. Genvalg kan finde sted. Bestyrelsen konstituerer sig selv.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;6. Hvis et bestyrelsesmedlem&nbsp;nedl&aelig;gger deres hverv inden valgperiodens udl&oslash;b, indtr&aelig;der suppleanten.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;7. Bestyrelsen kan fasts&aelig;tte sin egen forretningsorden.</span></p>\r\n\r\n<h2><span style=\"font-family:verdana,geneva,sans-serif\">Regnskab og revision</span></h2>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;8. Klubbens regnskabs&aring;r f&oslash;lger kalender&aring;ret.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;9. Kontingentet fasts&aelig;ttes af generalforsamlingen for et &aring;r ad gangen. Alle medlemmer betaler samme kontingent.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;10. Kontingent opkr&aelig;ves 4 gange &aring;rligt og betales forud. Betalt kontingent refunderes ikke ved udmeldelse af klubben. Nye medlemmer har en pr&oslash;vetid p&aring; 1 m&aring;ned, inden kontingent betales.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;11. P&aring;t&aelig;nkte nyanskaffelser eller andre udgifter, der overstiger 10.000 kr. skal forel&aelig;gges generalforsamlingen til godkendelse.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;12. Foreningen kan ikke optage l&aring;n.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;13. Til kritisk at overv&aring;ge regnskabets f&oslash;relse v&aelig;lger generalforsamlingen blandt medlemmerne en revisor og en revisorsuppleant, begge for et &aring;r ad gangen. Hverken revisor eller revisorsuppleant m&aring; v&aelig;re medlemmer af klubbens bestyrelse eller v&aelig;re suppleant til denne.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;14. Kassereren udarbejder ved regnskabs&aring;rets afslutning et &aring;rsregnskab, der revideres af klubbens revisor. Hvis kassereren nedl&aelig;gger sit hverv inden regnskabs&aring;rets udl&oslash;b, udarbejdes et regnskab for den forl&oslash;bne periode. Dette revideres af klubbens revisor.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;15. Det reviderede regnskab forel&aelig;gges generalforsamlingen til godkendelse. Regnskabet udsendes til samtlige medlemmer senest en uge f&oslash;r generalforsamlingens afholdelse.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;16. For de aftaler, som klubben indg&aring;r, h&aelig;fter kun klubben selv. Medlemmerne h&aelig;fter ikke for klubbens forpligtelser.</span></p>\r\n\r\n<h2><span style=\"font-family:verdana,geneva,sans-serif\">Generalforsamlingen</span></h2>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;17. Generalforsamlingen er Kerteminde Fotoklubs h&oslash;jeste myndighed. Alle fremm&oslash;dte medlemmer, som ikke er i kontingentrestance, er stemmeberettigede p&aring; generalforsamlingen og er valgbare til bestyrelsen, som revisor og som suppleanter. Valg in absentia kan finde sted ved forudg&aring;ende skriftlig samtykke fra den p&aring;g&aelig;ldende.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;18. Ordin&aelig;r generalforsamling afholdes hvert &aring;r inden den 15. marts og skal varsles mindst 3 uger f&oslash;r afholdelse.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;19. Dagsorden for ordin&aelig;r generalforsamling skal indeholde mindst f&oslash;lgende punkter.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">1. Valg af dirigent</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">2. Bestyrelsens beretning</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">3. Forel&aelig;ggelse af revideret regnskab til godkendelse</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">4. Fasts&aelig;ttelse af n&aelig;ste &aring;rs kontingent</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">5. Behandling af indkomne forslag fra medlemmer og forslag fra bestyrelsen</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">6. Valg af bestyrelsesmedlemmer og suppleanter</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">7. Valg af revisor og revisorsuppleant</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">8. Eventuelt</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;20. Forslag, der &oslash;nskes behandlet p&aring; den ordin&aelig;re generalforsamling, skal v&aelig;re bestyrelsen i h&aelig;nde senest 2&nbsp;uger f&oslash;r generalforsamlingen. Indkomne forslag samt forslag fra bestyrelsen udsendes til medlemmerne senest sammen med regnskabet.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;21. Ekstraordin&aelig;r generalforsamling kan afholdes p&aring; bestyrelsens foranledning. Ekstraordin&aelig;r generalforsamling kan endvidere afholdes, n&aring;r mindst halvdelen af klubbens medlemmer skriftligt frems&aelig;tter anmodning herom til bestyrelsen. Generalforsamlingen skal afholdes senest en m&aring;ned derefter.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;22. Ekstraordin&aelig;r generalforsamling skal indkaldes med mindst en uges varsel ved skriftlig meddelelse til samtlige medlemmer med angivelse af dagsorden.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;23. Beslutninger p&aring; generalforsamlingen vedtages med almindeligt flertal ved h&aring;ndsopr&aelig;kning, med mindre andet er angivet andetsteds i vedt&aelig;gterne. Skriftlig afstemning skal afholdes, hvis &eacute;t af medlemmerne &oslash;nsker dette.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;24. Enhver lovlig varslet generalforsamling er beslutningsdygtig uanset antallet af fremm&oslash;dte.</span></p>\r\n\r\n<h2><span style=\"font-family:verdana,geneva,sans-serif\">Diverse bestemmelser</span></h2>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;25. Forslag om vedt&aelig;gts&aelig;ndringer kan kun vedtages, n&aring;r mindst 2/3 af de </span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">fremm&oslash;dte </span><span style=\"font-family:verdana,geneva,sans-serif\">stemmeberettigede stemmer herfor.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;26. Undlader et medlem at betale det fastsatte kontingent, udsender bestyrelsen efter passende tid en p&aring;mindelse. Betales kontingentet stadig ikke, betragtes den p&aring;g&aelig;ldende som ekskluderet af klubben.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;27. Klubbens bestyrelse kan indstille et medlem til eksklusion, hvis den p&aring;g&aelig;ldende groft skader klubbens interesser. Indstillinger om eksklusion forel&aelig;gges klubbens generalforsamling og kan kun vedtages med mindst 2/3 af de fremm&oslash;dte stemmeberettigede.</span></p>\r\n\r\n<h2><span style=\"font-family:verdana,geneva,sans-serif\">Opl&oslash;sning af klubben</span></h2>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;28. Ved opl&oslash;sning af klubben overdrages eventuelle aktiver til foreningslivet i Langeskov.</span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\">&sect;29. Disse vedt&aelig;gter er vedtaget p&aring; Kerteminde Fotoklubs stiftende generalforsamling d.11 april 2011.<br />\r\nRevideret p&aring; generalforsamlingen d.11 marts 2014</span></p>\r\n</div>\r\n</div>\r\n', 'DK', 'Vedtægter', 0, ''),
(5, 'Medlemmer', 'DK', 'Medlemmer', 0, ''),
(6, 'Bestyrelse', 'DK', 'Bestyrelse', 0, ''),
(8, '<p style=\"text-align:center\"><u><span style=\"font-size:14px\"><span style=\"font-family:verdana,geneva,sans-serif\"><strong>Her p&aring; siden vil der l&oslash;bende komme nyt omkring hvad der sker i klubben:</strong></span></span></u></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.15/08-17: &nbsp;Vi skal p&aring; bes&oslash;g hos&nbsp;ugleriget, vi m&oslash;des p&aring; adressen&nbsp;R&oslash;rmaen 1, 5270 Odense N, ca.&nbsp;kl.18.45-kl.19.00 (Dem der vil k&oslash;re sammen fra skolen m&oslash;des der senest kl.18.20)</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.22/08-17: &nbsp;Tur til Nyborg til grill med &aring;rets modeller, vi m&oslash;des kl.18.00 ved strandv&aelig;nget 5800 Nyborg</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.29/08-17: Visning af uglefotos</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.05/09-17: &nbsp;HDR-foto i Svanninge Bakker</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.12/09-17: &nbsp;</strong><strong>Visning af HDR-fotos</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.19/09-17: &nbsp;Modelaften i byen ,vi m&oslash;des i &nbsp;P. k&aelig;lderen ved Odeon.</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.26/09-17: &nbsp;Visning af modelfotos</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.03/10-17: &nbsp;Aften/nat fotografering p&aring; molen ved&nbsp;DSB Kursuscenter i Nyborg ca. kl.19.20 p&aring; parkeringspladsen, vi k&oslash;rer fra skolen senest kl.19.00</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.10/10-17: &nbsp;Visning af aften/nat fotos</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.17/10-17: &nbsp;Produktfotografering emne: ure</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.24/10-17: &nbsp;Visning af produktfotos&nbsp;</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.31/10-17: &nbsp;Fotografering af broerne i Middelfart</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.07/11-17: &nbsp;Visning af fotos fra Middelfart</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.14/11-17: &nbsp; Frame Mockup visning og brug(Karina)</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.21/11-17: &nbsp;Lightroom visning af muligheder</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.28/11-17: &nbsp;Fotografering af miniatyre biler on lokation</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.05/12-17: &nbsp;Visning af bilfotos</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.12/12-17: &nbsp;Tage julebilleder sted?</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.19/12-17: &nbsp;Visning af julebilleder og afslutning af &aring;ret</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.26/12-17: &nbsp;Juleferie</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.02/01-18: &nbsp;Lave kalender for f&oslash;rste halv&aring;r</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Fre d.19/01-18: &nbsp;Julefrokost kl.18.30 i klubbens lokaler</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Tirs d.13/02-18: &nbsp;Generalforsamling</strong></span></span></p>\r\n', 'DK', 'Program', 0, ''),
(9, '<div id=\"bookmark155182\">\r\n<div style=\"width:100%\">\r\n<div class=\"container\" style=\"padding:0px 20px 20px 20px\">\r\n<div class=\"row\">\r\n<div class=\"col-sm-6\">\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:verdana,geneva,sans-serif\"><strong>Gode foto sider:</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong><a href=\"http://www.dofmaster.com/dofjs.html\">http://www.dofmaster.com/dofjs.html</a>&nbsp; </strong></span></span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Dybdeskarphedstabel er en god m&aring;de at se forskellige dybdeskarphen p&aring;.</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong><a href=\"http://camerasim.com/camera-simulator/\">http://camerasim.com/camera-simulator/</a>&nbsp;&nbsp;&nbsp;</strong></span></span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>SLR Kamera simulator</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><a href=\"http://www.kameratest.dk/\">http://www.kameratest.dk/</a></span></span></p>\r\n\r\n<p><strong><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\">Kameratest</span></span></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><a href=\"http://www.hdrfoto.dk/\">http://www.hdrfoto.dk/</a>&nbsp; </span></span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>en god side hvis man interessere sig for HDR billeder</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-size:14px\"><span style=\"font-family:verdana,geneva,sans-serif\"><a href=\"http://strobox.com/\">http://strobox.com/</a></span></span></p>\r\n\r\n<p><span style=\"font-size:14px\"><strong><span style=\"font-family:verdana,geneva,sans-serif\">Opstillinger med alt flash i&nbsp;studio og lign</span></strong></span></p>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n\r\n<div class=\"col-sm-6\">\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:verdana,geneva,sans-serif\"><strong>Sm&aring; videoer af about foto:</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong><a href=\"http://www.mashedpotatoes.dk/blog/\">http://www.mashedpotatoes.dk/blog/</a></strong></span></span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Side med en masse Photoshopvideoer p&aring; dansk</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong><a href=\"http://www.youtube.com/watch?v=VF5B4McYPls&amp;feature=related\">http://www.youtube.com/watch?v=VF5B4McYPls&amp;feature=related</a>&nbsp; </strong></span></span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Video about use of gr&aring;kort.</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong><a href=\"http://www.youtube.com/watch?v=jxJSpxh_r90&amp;feature=related\">http://www.youtube.com/watch?v=jxJSpxh_r90&amp;feature=related</a>&nbsp;&nbsp; </strong></span></span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Video about Gr&aring;kort</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong><a href=\"http://www.youtube.com/watch?v=iqRJv4tTkkY\">http://www.youtube.com/watch?v=iqRJv4tTkkY</a>&nbsp; </strong></span></span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Video Omkring <span style=\"font-size:medium\">Candy Pin-Up Girl</span></strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong><a href=\"http://www.220.ro/documentare/Episode-14-Classic-Three-Light-Portrait-Photo-Studio/waD8ncahRo/\">http://www.220.ro/documentare/Episode-14-Classic-Three-Light-Portrait-Photo-Studio/waD8ncahRo/</a>&nbsp; </strong></span></span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Klasisk protr&aelig;t Fotografering</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong><a href=\"http://www.5min.com/Video/How-to-use-Lighting-Ratios-in-Photography-72416724\">http://www.5min.com/Video/How-to-use-Lighting-Ratios-in-Photography-72416724</a>&nbsp;&nbsp; </strong></span></span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Hvordan man Bruger Belysning N&oslash;gletal i Fotografi</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div id=\"bookmark155183\">\r\n<div style=\"width:100%\">\r\n<div class=\"container\" style=\"padding:0px 20px 20px 20px\">\r\n<div class=\"row\">\r\n<div class=\"col-sm-12\">&nbsp;</div>\r\n</div>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-sm-6\">\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:verdana,geneva,sans-serif\"><strong>Link:</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"http://suncalc.net/\"><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>http://suncalc.net/&nbsp;</strong></span></span></a></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong><span style=\"font-size:medium\">for dem som gerne vil vide hvorn&aring;r solen st&aring;r op og g&aring;r ned igen</span></strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n</div>\r\n\r\n<div class=\"col-sm-6\">\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:verdana,geneva,sans-serif\"><strong>Link til Fotoklubber:</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong><a href=\"http://www.ofa.dk/\">http://www.ofa.dk/</a>&nbsp; </strong></span></span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Odense Fotografiske Amat&oslash;rklub</strong></span></span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong><a href=\"http://oestfynsfotoklub.dk/\">http://oestfynsfotoklub.dk/</a>&nbsp;&nbsp; </strong></span></span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>&Oslash;stfyns Fotoklub</strong></span></span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong><a href=\"http://www.midtfynsfotoklub.dk/\">http://www.midtfynsfotoklub.dk/</a>&nbsp; </strong></span></span></p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong>Midtfyns Fotoklub</strong></span></span></p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div id=\"bookmark155184\">\r\n<div style=\"width:100%\">\r\n<div class=\"container\" style=\"padding:0px 20px 20px 20px\">\r\n<div class=\"row\">\r\n<div class=\"col-sm-12\">&nbsp;</div>\r\n</div>\r\n\r\n<div class=\"row\">\r\n<div class=\"col-sm-6\">\r\n<p><span style=\"font-size:18px\"><span style=\"font-family:verdana,geneva,sans-serif\"><strong>Link til sp&aelig;ndende fotografer:</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:verdana,geneva,sans-serif\"><span style=\"font-size:14px\"><strong><a href=\"http://www.ttf.dk/Dansk/Forside.aspx\">http://www.ttf.dk/Dansk/Forside.aspx</a>&nbsp; </strong></span></span></p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n', 'DK', 'Link', 0, '');

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
  `password` varchar(128) NOT NULL,
  `active` int(11) NOT NULL,
  `recoverycode` varchar(16) NOT NULL,
  `recoverytime` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `GBone_users`
--

INSERT INTO `GBone_users` (`id`, `username`, `username_clean`, `mail`, `mobile`, `loginlevel`, `password`, `active`, `recoverycode`, `recoverytime`) VALUES
(1, 'Rhodez', 'rhodez', 'jorn@guld-berg.dk', '25336607', 50, '4069599633d6afb2ca255bbc4f871e2f08dff2e17a58f0e8273af4bf0975bcf5', 1, '', '');

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
-- Indexes for table `GBone_calender`
--
ALTER TABLE `GBone_calender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `GBone_country`
--
ALTER TABLE `GBone_country`
  ADD PRIMARY KEY (`countryID`),
  ADD UNIQUE KEY `countryID` (`countryID`);

--
-- Indexes for table `GBone_images`
--
ALTER TABLE `GBone_images`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

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
-- Indexes for table `GBone_user_info`
--
ALTER TABLE `GBone_user_info`
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `GBone_calender`
--
ALTER TABLE `GBone_calender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `GBone_country`
--
ALTER TABLE `GBone_country`
  MODIFY `countryID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `GBone_images`
--
ALTER TABLE `GBone_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `GBone_navi`
--
ALTER TABLE `GBone_navi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

