-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 03 mrt 2015 om 16:12
-- Serverversie: 5.6.16
-- PHP-versie: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `smartschool`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `evenement`
--

CREATE TABLE IF NOT EXISTS `evenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `start` date NOT NULL,
  `end` date DEFAULT NULL,
  `info` text COLLATE utf8_bin NOT NULL,
  `klasid` int(3) NOT NULL,
  `toets` tinyint(1) NOT NULL,
  `vakantie` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

--
-- Gegevens worden geëxporteerd voor tabel `evenement`
--

INSERT INTO `evenement` (`id`, `title`, `start`, `end`, `info`, `klasid`, `toets`, `vakantie`) VALUES
(1, 'ldm', '2015-01-14', '2015-01-14', 'mlkml', 2, 0, 0),
(2, 'testf dsqfdsqfdsq', '2015-01-10', '2015-01-10', 'Nederlands', 2, 1, 0),
(3, 'nederlands toets 1', '2015-02-26', '2015-02-26', 'Nederlands', 2, 1, 0),
(4, 'vakantie test', '2015-02-16', '2015-02-16', '', 2, 0, 0),
(5, 'blabla', '2015-02-11', '2015-02-11', 'fdsqfdsq', 2, 0, 0),
(7, 'test nederlands 5', '2015-02-09', '2015-02-09', 'Nederlands', 2, 1, 0),
(8, 'testertje agenda', '2015-02-12', '2015-02-12', 'fdsqdsqg', 2, 0, 0),
(9, 'nog een', '2015-03-25', '2015-03-26', 'test', 2, 0, 0),
(10, 'toets ned', '2015-03-17', '2015-03-18', 'Nederlands', 2, 0, 0),
(11, 'Nog een reeks', '2015-04-02', '2015-04-03', 'Engels', 2, 1, 0),
(12, 'Kerst', '2015-03-19', '2015-03-20', '', 1, 0, 1),
(13, 'nieuw', '2015-04-02', '2015-04-03', '', 1, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
