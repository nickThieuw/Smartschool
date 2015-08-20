-- MySQL dump 10.13  Distrib 5.6.16, for Win32 (x86)
--
-- Host: localhost    Database: smartschool
-- ------------------------------------------------------
-- Server version	5.6.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `afwezigheden`
--

DROP TABLE IF EXISTS `afwezigheden`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `afwezigheden` (
  `afwezigheidid` int(5) NOT NULL AUTO_INCREMENT,
  `leerlingid` int(3) NOT NULL,
  `datum` datetime NOT NULL,
  PRIMARY KEY (`afwezigheidid`),
  KEY `fk_leerlingafw` (`leerlingid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `afwezigheden`
--

LOCK TABLES `afwezigheden` WRITE;
/*!40000 ALTER TABLE `afwezigheden` DISABLE KEYS */;
INSERT INTO `afwezigheden` VALUES (1,2,'2015-01-23 13:00:00'),(2,4,'2015-01-23 13:00:00');
/*!40000 ALTER TABLE `afwezigheden` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `basistabel`
--

DROP TABLE IF EXISTS `basistabel`;
/*!50001 DROP VIEW IF EXISTS `basistabel`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `basistabel` (
  `voornaam` tinyint NOT NULL,
  `familienaam` tinyint NOT NULL,
  `vaknaam` tinyint NOT NULL,
  `punten` tinyint NOT NULL,
  `puntentotaal` tinyint NOT NULL,
  `trimister` tinyint NOT NULL,
  `leerlingID` tinyint NOT NULL,
  `vakID` tinyint NOT NULL,
  `klasidleerling` tinyint NOT NULL,
  `klasidvak` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `berichten`
--

DROP TABLE IF EXISTS `berichten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `berichten` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fromId` int(11) NOT NULL,
  `fromStatus` int(1) NOT NULL,
  `gelezen` int(1) NOT NULL DEFAULT '0',
  `titel` varchar(50) NOT NULL DEFAULT '',
  `toId` int(11) NOT NULL,
  `toStatus` int(1) NOT NULL,
  `bericht` text NOT NULL,
  `datumTijd` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `berichten`
--

LOCK TABLES `berichten` WRITE;
/*!40000 ALTER TABLE `berichten` DISABLE KEYS */;
INSERT INTO `berichten` VALUES (1,1,1,1,'uiiu',1,2,'nkionoi,kl,onnionbiouinionoioinonoibhoibiobiobb\r\noiboinonoin\r\niononoinoin\r\ninoinon','2015-02-04 00:00:00');
/*!40000 ALTER TABLE `berichten` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evenement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `info` text COLLATE utf8_bin NOT NULL,
  `klasid` int(3) NOT NULL,
  `toets` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evenement`
--

LOCK TABLES `evenement` WRITE;
/*!40000 ALTER TABLE `evenement` DISABLE KEYS */;
INSERT INTO `evenement` VALUES (1,'ldm','2015-01-14 00:00:00','2015-01-14 00:00:00','mlkml',2,0),(2,'testf dsqfdsqfdsq','2015-01-10 00:00:00','2015-01-10 00:00:00','Nederlands',2,1),(3,'nederlands toets 1','2015-02-26 00:02:00','2015-02-26 00:02:00','Nederlands',2,1),(4,'vakantie test','2015-02-16 00:00:00','2015-02-16 00:00:00','',2,0),(5,'blabla','2015-02-11 00:00:00','2015-02-11 00:00:00','fdsqfdsq',2,0),(7,'test nederlands 5','2015-02-09 00:00:00','2015-02-09 00:00:00','Nederlands',2,1),(8,'testertje agenda','2015-02-12 00:00:00','2015-02-12 00:00:00','fdsqdsqg',2,0);
/*!40000 ALTER TABLE `evenement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gemeente`
--

DROP TABLE IF EXISTS `gemeente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gemeente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postcode` varchar(8) NOT NULL,
  `naam` varchar(255) NOT NULL,
  `up` varchar(255) NOT NULL,
  `structuur` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gemeente`
--

LOCK TABLES `gemeente` WRITE;
/*!40000 ALTER TABLE `gemeente` DISABLE KEYS */;
INSERT INTO `gemeente` VALUES (1,'8610','werken','WERKEN',''),(2,'8600','diksmuide','DIKSMUIDE',''),(3,'8200','wevelgem','WEVELGEM',''),(4,'8610','wereken','WEREKEN','');
/*!40000 ALTER TABLE `gemeente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `klas`
--

DROP TABLE IF EXISTS `klas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `klas` (
  `klasid` int(3) NOT NULL AUTO_INCREMENT,
  `naamklas` varchar(25) NOT NULL,
  PRIMARY KEY (`klasid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `klas`
--

LOCK TABLES `klas` WRITE;
/*!40000 ALTER TABLE `klas` DISABLE KEYS */;
INSERT INTO `klas` VALUES (1,'admin'),(2,'1A'),(3,'2DE'),(4,'5B'),(5,'6DE'),(6,'3A'),(7,'1AC'),(8,'5'),(9,'5A');
/*!40000 ALTER TABLE `klas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leerkracht`
--

DROP TABLE IF EXISTS `leerkracht`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leerkracht` (
  `leerkrachtid` int(3) NOT NULL AUTO_INCREMENT,
  `emailadres` varchar(50) NOT NULL,
  `wachtwoord` varchar(40) NOT NULL,
  `voornaam` varchar(20) NOT NULL,
  `familienaam` varchar(25) NOT NULL,
  `geboortedatum` date NOT NULL,
  `foto` varchar(50) NOT NULL,
  `klasid` int(3) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`leerkrachtid`),
  KEY `fk_leerkracht` (`klasid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leerkracht`
--

LOCK TABLES `leerkracht` WRITE;
/*!40000 ALTER TABLE `leerkracht` DISABLE KEYS */;
INSERT INTO `leerkracht` VALUES (1,'admin','d033e22ae348aeb5660fc2140aec35850c4da997','admin','unknown','1111-11-11','Foto_leerling/defaul_foto.png',1,1),(2,'paul.de_bakker@skynet.be','5116bc3b41f7a391438d6c6a23cd540f4d70d5e8','paul','de bakker','1981-03-17','',2,0),(3,'Guest.Leerkracht@smartschool.be','face83ee3014bdc8f98203cc94e2e89222452e90','guest','leerkracht','2015-01-12','Foto_leerkracht/2015-01-12moranggonzal.jpg',9,0),(4,'niels.vroman@hotmail.com','2f0eab8502eea9c28f771579019eb3b446b68c65','zampor','movan','2015-01-04','Foto_leerkracht/2015-01-04zampormovan.png',4,1),(5,'mathias.desca@yahoo.com','67ed3a1d04281e331db8e3da032472f74684371e','mathias','descan','2015-01-04','',5,0),(6,'golan@skynet.be','23af33fbdd33d7cb87d3d1eeafdb7a02f25ca884','golan','mohin','2015-01-12','',6,0),(7,'kili_lamo@yahoo.com','7d0cdbf578e7d6c5447b6fd1a11f993cb1f87f21','kili','lamo','2015-01-07','Foto_leerkracht/2015-01-07kililamo.jpg',7,0);
/*!40000 ALTER TABLE `leerkracht` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leerling`
--

DROP TABLE IF EXISTS `leerling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leerling` (
  `leerlingid` int(3) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(20) NOT NULL,
  `familienaam` varchar(25) NOT NULL,
  `geboortedatum` date NOT NULL,
  `foto` varchar(50) NOT NULL,
  `straat` varchar(25) NOT NULL,
  `huisnr` int(3) NOT NULL,
  `bus` varchar(3) NOT NULL,
  `postcodeID` int(11) DEFAULT NULL,
  `telefoonnr` int(15) NOT NULL,
  `klasid` int(3) DEFAULT NULL,
  `voornaamouder1` varchar(20) NOT NULL,
  `familienaamouder1` varchar(25) NOT NULL,
  `voornaamouder2` varchar(20) NOT NULL,
  `familienaamouder2` varchar(25) NOT NULL,
  `GSMouder1` int(15) NOT NULL,
  `GSMouder2` int(15) NOT NULL,
  `emailadres` varchar(50) NOT NULL,
  `wachtwoord` varchar(40) NOT NULL,
  PRIMARY KEY (`leerlingid`),
  UNIQUE KEY `emailadres` (`emailadres`),
  KEY `klasid` (`klasid`),
  KEY `fk_postcodeID` (`postcodeID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leerling`
--

LOCK TABLES `leerling` WRITE;
/*!40000 ALTER TABLE `leerling` DISABLE KEYS */;
INSERT INTO `leerling` VALUES (1,'niels','vroman','2015-01-13','Foto_leerling/2015-01-13nielsvroman.jpg','lol',10,'',1,51568877,2,'','','','',0,0,'niels.vroman@hotmail.com','572fad674914e363c578cefa7abf7cfaa75e430e'),(2,'nick','unknown','2015-01-04','Foto_leerling/2015-01-04nickunknown.png','kk',77,'',2,55445566,2,'','','','',0,0,'nick@hotmail.com','b5fbf0ba7325c4be5950d942cffe0c8b5968e596'),(3,'kevin','woestyn','2015-01-12','Foto_leerling/2015-01-12kevinwoestyn.jpg','vlamingen',2,'',3,444558899,5,'','','','',0,0,'kevin@hotmail.com','484fa9b3b74a1e292f457c3ac6a5967f9da83044'),(4,'moab','rammo','2015-01-05','Foto_leerling/defaul_foto.png','lel',1,'',1,2147483647,2,'','','','',0,0,'mm@mm','b8d09b4d8580aacbd9efc4540a9b88d2feb9d7e5'),(5,'jonas','descan','2015-01-11','Foto_leerling/2015-01-11jonasdescan.jpg','hogestraat',34,'',4,51556688,2,'','','','',0,0,'jonas@skynet.be','ee565f59e6c9b54e2764e548de336bb46f40e8ff'),(6,'sybren','mombert','2000-04-18','Foto_leerling/2000-04-18sybrenmombert.jpg','kasteelhoek',11,'',2,55668877,2,'','','','',0,0,'smosberen@skynet.be','09f646e61a1b03ec6bac063ee5badec1a8fb151c'),(7,'kiara','mombert','2001-06-20','Foto_leerling/2001-06-20kiaramombert.png','kasteelhoek',11,'',2,55887799,5,'','','','',0,0,'kiara@skynet.be','e1343a49ad76dcc9a74c6a94f6d870ee04c9d1f0'),(8,'testertje','tester','2015-01-21','Foto_leerling/defaul_foto.png','',0,'',0,0,5,'','','','',0,0,'bla@bla.bla','d1247300e6df58717691f05b64b4a0e75ba64515'),(9,'fdsqfdsq','fdsqfdsqfsq','2014-12-07','Foto_leerling/defaul_foto.png','',0,'',0,0,5,'','','','',0,0,'fdsqfdsq@fdsq.be','ba25e57b9316f6801b9671f9e361773518d2f6b8');
/*!40000 ALTER TABLE `leerling` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `overgang`
--

DROP TABLE IF EXISTS `overgang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `overgang` (
  `bewerkingid` int(11) NOT NULL AUTO_INCREMENT,
  `leerlingid` int(11) NOT NULL,
  `oudklasid` int(11) NOT NULL,
  `nieuwklasid` int(11) NOT NULL,
  PRIMARY KEY (`bewerkingid`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `overgang`
--

LOCK TABLES `overgang` WRITE;
/*!40000 ALTER TABLE `overgang` DISABLE KEYS */;
INSERT INTO `overgang` VALUES (14,1,2,8),(15,2,2,8),(16,5,2,8);
/*!40000 ALTER TABLE `overgang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `procent`
--

DROP TABLE IF EXISTS `procent`;
/*!50001 DROP VIEW IF EXISTS `procent`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `procent` (
  `trimister` tinyint NOT NULL,
  `leerlingID` tinyint NOT NULL,
  `vakid` tinyint NOT NULL,
  `percentage` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `punten`
--

DROP TABLE IF EXISTS `punten`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `punten` (
  `puntenid` int(5) NOT NULL AUTO_INCREMENT,
  `leerlingid` int(3) NOT NULL,
  `punten` int(3) NOT NULL,
  `testid` int(5) NOT NULL,
  PRIMARY KEY (`puntenid`),
  KEY `leerlingid` (`leerlingid`),
  KEY `testid` (`testid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `punten`
--

LOCK TABLES `punten` WRITE;
/*!40000 ALTER TABLE `punten` DISABLE KEYS */;
INSERT INTO `punten` VALUES (1,4,20,1),(2,5,20,1);
/*!40000 ALTER TABLE `punten` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `testid` int(5) NOT NULL AUTO_INCREMENT,
  `vakid` int(3) NOT NULL,
  `testomschrijving` text NOT NULL,
  `datum` date NOT NULL,
  `trimister` int(1) NOT NULL,
  `puntentotaal` int(3) NOT NULL,
  PRIMARY KEY (`testid`),
  KEY `vakid` (`vakid`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
INSERT INTO `test` VALUES (1,1,'nederlands toets 1','2015-02-26',2,35);
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vak`
--

DROP TABLE IF EXISTS `vak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vak` (
  `vakid` int(3) NOT NULL AUTO_INCREMENT,
  `vaknaam` varchar(25) NOT NULL,
  `klasid` int(3) DEFAULT NULL,
  PRIMARY KEY (`vakid`),
  KEY `fk_klas` (`klasid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vak`
--

LOCK TABLES `vak` WRITE;
/*!40000 ALTER TABLE `vak` DISABLE KEYS */;
INSERT INTO `vak` VALUES (1,'Nederlands',2);
/*!40000 ALTER TABLE `vak` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `validation`
--

DROP TABLE IF EXISTS `validation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `validation` (
  `validationid` int(11) NOT NULL AUTO_INCREMENT,
  `gebruiker` tinyint(1) NOT NULL,
  `gebruikerid` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `datum` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  `disabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`validationid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `validation`
--

LOCK TABLES `validation` WRITE;
/*!40000 ALTER TABLE `validation` DISABLE KEYS */;
INSERT INTO `validation` VALUES (1,1,1,'3240aa0fe3ca15051680641a59e8d7b61c286b23','admin','2015-02-24 10:54:15',1,1),(2,1,4,'c19c4f358f050364504faeadd3fba4410861017b','niels.vroman@hotmail.com','2015-02-24 10:54:15',0,1),(3,1,1,'0358b2946c146e2f3b11b6de50f7612f7a7d4b39','admin','2015-02-24 11:41:34',0,0),(4,1,4,'72a6ef7e4297370baa60059f2766d0eb2a5d71b9','niels.vroman@hotmail.com','2015-02-24 11:41:34',0,0),(5,1,1,'4770b1b3c53379f9dc71b6178dd495667538cf87','admin','2015-02-24 12:26:11',0,0),(6,1,4,'3a5a9b70fbfe79bb20fdeaf08bba932c12c9e7b7','niels.vroman@hotmail.com','2015-02-24 12:26:11',0,0),(7,1,1,'61d94c9fa51c11ed62cb95ec478a19dd24cfe7ac','admin','2015-02-24 14:01:28',0,0),(8,1,4,'be8fc062a73005cc2366c3e4a3863113ba74212f','niels.vroman@hotmail.com','2015-02-24 14:01:28',0,0),(9,1,1,'c9d652cd66e13f4c4e3b4cd6c986f45ae33484bc','admin','2015-02-25 15:21:17',0,0),(10,1,4,'39e4b38ab72593eb16bb054ab744f9fb43ad494d','niels.vroman@hotmail.com','2015-02-25 15:21:17',0,0),(11,1,1,'f2d17af9386bcb0c44fd6d6cf00b9cf250d47ba8','admin','2015-02-26 12:21:50',0,0),(12,1,4,'7b0948673cdfe928edbcf9eb483e9f925d37d4e6','niels.vroman@hotmail.com','2015-02-26 12:21:50',0,0),(13,1,1,'a2953a445dd17247c6f1b4b56bd67b145ba90ed1','admin','2015-02-26 14:26:04',0,0),(14,1,4,'80d27afe3446f6f9062c80a453d5213a0f712920','niels.vroman@hotmail.com','2015-02-26 14:26:04',0,0);
/*!40000 ALTER TABLE `validation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `basistabel`
--

/*!50001 DROP TABLE IF EXISTS `basistabel`*/;
/*!50001 DROP VIEW IF EXISTS `basistabel`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `basistabel` AS select `leerling`.`voornaam` AS `voornaam`,`leerling`.`familienaam` AS `familienaam`,`vak`.`vaknaam` AS `vaknaam`,`punten`.`punten` AS `punten`,`test`.`puntentotaal` AS `puntentotaal`,`test`.`trimister` AS `trimister`,`leerling`.`leerlingid` AS `leerlingID`,`vak`.`vakid` AS `vakID`,`leerling`.`klasid` AS `klasidleerling`,`vak`.`klasid` AS `klasidvak` from (((`punten` join `test`) join `vak`) join `leerling`) where ((`punten`.`testid` = `test`.`testid`) and (`test`.`vakid` = `vak`.`vakid`) and (`punten`.`leerlingid` = `leerling`.`leerlingid`)) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `procent`
--

/*!50001 DROP TABLE IF EXISTS `procent`*/;
/*!50001 DROP VIEW IF EXISTS `procent`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `procent` AS select `basistabel`.`trimister` AS `trimister`,`basistabel`.`leerlingID` AS `leerlingID`,`basistabel`.`vakID` AS `vakid`,((sum(`basistabel`.`punten`) / sum(`basistabel`.`puntentotaal`)) * 100) AS `percentage` from `basistabel` where (`basistabel`.`klasidleerling` = `basistabel`.`klasidvak`) group by `basistabel`.`trimister`,`basistabel`.`leerlingID`,`basistabel`.`vakID` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-26 14:26:09
