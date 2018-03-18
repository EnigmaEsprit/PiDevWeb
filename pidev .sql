-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 18, 2018 at 05:32 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pidev`
--

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `idCommande` int(11) NOT NULL AUTO_INCREMENT,
  `prixTotal` double NOT NULL,
  `etat` int(11) NOT NULL,
  `DateDeCommande` date NOT NULL,
  `idTransaction` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCommande`),
  KEY `commandes_ibfk_1` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `idCommentaire` int(11) NOT NULL AUTO_INCREMENT,
  `contenuCommentaire` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `dateAjoutCommentaire` date NOT NULL,
  `dateModificationCommentaire` date NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idProduit` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCommentaire`),
  KEY `idUser` (`idUser`),
  KEY `commentaires_ibfk_2` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `idEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `nomEvenement` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `nombreDePlaces` int(11) NOT NULL,
  `tarifEvenement` double NOT NULL,
  `descriptionEvenement` int(11) NOT NULL,
  PRIMARY KEY (`idEvenement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `idFaq` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `contenuFaq` varchar(800) COLLATE utf8_unicode_ci NOT NULL,
  `dateEnvoiFaq` date NOT NULL,
  `dateReponseFaq` date NOT NULL,
  PRIMARY KEY (`idFaq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lignecommandes`
--

DROP TABLE IF EXISTS `lignecommandes`;
CREATE TABLE IF NOT EXISTS `lignecommandes` (
  `idLigneCommande` int(11) NOT NULL AUTO_INCREMENT,
  `prixTotal` double NOT NULL,
  `quantite` int(11) NOT NULL,
  `prixUnitaire` double NOT NULL,
  `idCommande` int(11) DEFAULT NULL,
  `idMagasin` int(11) DEFAULT NULL,
  `idProduit` int(11) DEFAULT NULL,
  PRIMARY KEY (`idLigneCommande`),
  KEY `idCommande` (`idCommande`),
  KEY `idMagasin` (`idMagasin`),
  KEY `idProduit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `magasins`
--

DROP TABLE IF EXISTS `magasins`;
CREATE TABLE IF NOT EXISTS `magasins` (
  `idMagasin` int(11) NOT NULL AUTO_INCREMENT,
  `nomMagasin` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `photoMagasin` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descriptionMagasin` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dateCreationMagasin` date NOT NULL,
  `contactMagasin` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMagasin`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participations`
--

DROP TABLE IF EXISTS `participations`;
CREATE TABLE IF NOT EXISTS `participations` (
  `idParticipation` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idEvenement` int(11) NOT NULL,
  PRIMARY KEY (`idParticipation`,`idUser`,`idEvenement`),
  KEY `idUser` (`idUser`),
  KEY `idEvenement` (`idEvenement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payement`
--

DROP TABLE IF EXISTS `payement`;
CREATE TABLE IF NOT EXISTS `payement` (
  `idPayement` int(11) NOT NULL AUTO_INCREMENT,
  `idCommande` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPayement`),
  KEY `idCommande` (`idCommande`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `idProduit` int(11) NOT NULL AUTO_INCREMENT,
  `referenceProduit` int(11) NOT NULL,
  `nomProduit` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prixProduit` double NOT NULL,
  `photoProduit` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quantiteProduit` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `idpromotion` int(11) NOT NULL,
  `categorieMagasin` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idMagasin` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProduit`),
  KEY `idMagasin` (`idMagasin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
CREATE TABLE IF NOT EXISTS `promotions` (
  `idPromotion` int(11) NOT NULL AUTO_INCREMENT,
  `nomPromotion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `imagePromotion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `IdProduit` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPromotion`),
  KEY `idUser` (`idUser`),
  KEY `IdProduit` (`IdProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reclamations`
--

DROP TABLE IF EXISTS `reclamations`;
CREATE TABLE IF NOT EXISTS `reclamations` (
  `idReclamation` int(11) NOT NULL AUTO_INCREMENT,
  `typeReclamation` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `objetReclamation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contenuReclamation` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateEnvoiReclamation` date DEFAULT NULL,
  `dateReponseReclamation` date DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idMagasin` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReclamation`),
  KEY `idUser` (`idUser`),
  KEY `reclamations_ibfk_2` (`idMagasin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `nom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateDeNaissance` datetime DEFAULT NULL,
  `sexe` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adresse` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ville` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `numeroDuTelephone` varchar(13) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageUser` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `numeroDeCarteBancaire` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateDeValidation` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codeSecret` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `situaitionFiscal` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ribBancaire` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_1483A5E9A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_1483A5E9C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `nom`, `prenom`, `dateDeNaissance`, `sexe`, `adresse`, `ville`, `zip`, `numeroDuTelephone`, `type`, `imageUser`, `numeroDeCarteBancaire`, `dateDeValidation`, `codeSecret`, `situaitionFiscal`, `ribBancaire`) VALUES
(5, 'oussama', 'oussama', 'boumaizaoussamab@gmail.com', 'boumaizaoussamab@gmail.com', 1, 'mSa0.LzkHlvVdhyuFkSd9R0wpv4ocq4OQ5Lq/X4xMUA', 'gnVbIGWiEgFl3A6bDCVfBebDz1b5o502bJF+rlzl8tNp54Y5i0HQ7r17rZd9bhNUxT4879JCEaIbYvtCN82VkQ==', '2018-03-18 16:32:08', NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'boumaiaza', 'oussama', '2013-04-03 00:00:00', 'Homme', 'Rue Du Grand Maghreb, Dar Chaabane Fehrie', 'Nabeul', 8011, '20950389', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'topadmin', 'topadmin', 'admin@soukelmedina.tn', 'admin@soukelmedina.tn', 1, 'U7aHtCxaglfSByByfkVaTKRWgBjupsxltO/pC2GfsT4', 'ct01/mCtPmg5hjLfS8uPF0MfIJ02TRlnZDHcBvAT7aJvmciy23TkvCfvFaVkYJ3wKJoGaAYCtECUpffFMptJIw==', '2018-03-18 16:45:46', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'oussama3', 'oussama3', 'boumaizaoussamabo@gmail.com', 'boumaizaoussamabo@gmail.com', 1, 'j3PRxDM8irkuwozLgjfN34pNPFbz2KI8BDfUbI5LqDI', 'NpUGGKGc+z4ay1vVlRU6qfI7cma9JTRmnz97ziJoQ462SuvFCVLCzjig4cC7eqfjBmfJWt0/797+qfzQt4a59g==', '2018-03-18 11:27:33', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_AGENT\";}', 'boumaiaza', 'oussama', '2013-01-01 00:00:00', 'Homme', 'Rue Du Grand Maghreb, Dar Chaabane Fehrie', 'Nabeul', 8011, '20950389', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_35D4282CFE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Constraints for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `FK_D9BEC0C4391C87D5` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`idProduit`),
  ADD CONSTRAINT `FK_D9BEC0C4FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Constraints for table `lignecommandes`
--
ALTER TABLE `lignecommandes`
  ADD CONSTRAINT `FK_448E7C7A391C87D5` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`idProduit`),
  ADD CONSTRAINT `FK_448E7C7A3D498C26` FOREIGN KEY (`idCommande`) REFERENCES `commandes` (`idCommande`),
  ADD CONSTRAINT `FK_448E7C7A441634D5` FOREIGN KEY (`idMagasin`) REFERENCES `magasins` (`idMagasin`);

--
-- Constraints for table `magasins`
--
ALTER TABLE `magasins`
  ADD CONSTRAINT `FK_BE50D53FFE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Constraints for table `participations`
--
ALTER TABLE `participations`
  ADD CONSTRAINT `FK_FDC6C6E8F7CC4348` FOREIGN KEY (`idEvenement`) REFERENCES `evenements` (`idEvenement`),
  ADD CONSTRAINT `FK_FDC6C6E8FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Constraints for table `payement`
--
ALTER TABLE `payement`
  ADD CONSTRAINT `FK_B20A78853D498C26` FOREIGN KEY (`idCommande`) REFERENCES `commandes` (`idCommande`),
  ADD CONSTRAINT `FK_B20A7885FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Constraints for table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `FK_BE2DDF8C441634D5` FOREIGN KEY (`idMagasin`) REFERENCES `magasins` (`idMagasin`);

--
-- Constraints for table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `FK_EA1B3034BBED0576` FOREIGN KEY (`IdProduit`) REFERENCES `produits` (`idProduit`),
  ADD CONSTRAINT `FK_EA1B3034FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);

--
-- Constraints for table `reclamations`
--
ALTER TABLE `reclamations`
  ADD CONSTRAINT `FK_1CAD6B76441634D5` FOREIGN KEY (`idMagasin`) REFERENCES `magasins` (`idMagasin`),
  ADD CONSTRAINT `FK_1CAD6B76FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
