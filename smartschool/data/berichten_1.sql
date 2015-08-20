-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 26 feb 2015 om 14:47
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
-- Tabelstructuur voor tabel `berichten`
--

CREATE TABLE IF NOT EXISTS `berichten` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fromId` int(11) NOT NULL,
  `fromStatus` tinyint(1) NOT NULL,
  `gelezen` int(1) NOT NULL DEFAULT '0',
  `titel` varchar(50) NOT NULL DEFAULT '',
  `conversatie` smallint(6) NOT NULL,
  `toId` int(11) NOT NULL,
  `toStatus` tinyint(1) NOT NULL,
  `bericht` text NOT NULL,
  `datumTijd` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Gegevens worden geëxporteerd voor tabel `berichten`
--

INSERT INTO `berichten` (`id`, `fromId`, `fromStatus`, `gelezen`, `titel`, `conversatie`, `toId`, `toStatus`, `bericht`, `datumTijd`) VALUES
(1, 2, 1, 1, 'onderwerp', 1, 19, 0, 'eerste nieuw bericht = nieuwe conversatie?', '2015-02-26 11:41:32'),
(2, 2, 1, 1, 'onderwerp', 2, 19, 0, 'tweede nieuw bericht = nieuwe conversatie?', '2015-02-26 11:41:43'),
(3, 2, 1, 1, 'onderwerp', 3, 19, 0, 'derde nieuw bericht = nieuwe conversatie?', '2015-02-26 11:41:58'),
(6, 19, 0, 0, 'onderwerp', 3, 2, 1, 'derde bericht antwoord', '2015-02-26 12:17:09'),
(7, 19, 0, 1, 'onderwerp', 2, 2, 1, 'tweede bericht antwoord', '2015-02-26 12:17:39'),
(8, 2, 1, 1, 'onderwerp', 2, 19, 0, 'tweede bericht, tweede zelfde conversatie inbox', '2015-02-26 12:20:03');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
