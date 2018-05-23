-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 23, 2018 at 12:42 PM
-- Server version: 5.7.21
-- PHP Version: 7.1.16

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
  `idTransaction` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commande` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `reference` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCommande`),
  KEY `commandes_ibfk_1` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`idCommande`, `prixTotal`, `etat`, `DateDeCommande`, `idTransaction`, `commande`, `reference`, `idUser`) VALUES
(79, 7500, 1, '2018-04-01', '60ba6561f919df82694a8668ab40e9c7cebee0ecd2b519b4acb682599aad6d18', 'a:3:{s:7:\"produit\";a:3:{i:5;a:3:{s:10:\"nomProduit\";s:7:\"versace\";s:15:\"quantiteproduit\";i:50;s:11:\"prixProduit\";d:2000;}i:7;a:3:{s:10:\"nomProduit\";s:4:\"Nike\";s:15:\"quantiteproduit\";i:55;s:11:\"prixProduit\";d:3500;}i:9;a:3:{s:10:\"nomProduit\";s:7:\"versace\";s:15:\"quantiteproduit\";i:50;s:11:\"prixProduit\";d:2000;}}s:9:\"Prixtotal\";d:7500;s:5:\"token\";s:64:\"93051de68001ad71a495ebe9606154e582b88dfb0cd233a0a19cf6774926abfe\";}', 1, 2),
(80, 7500, 1, '2018-04-01', 'df6a294bc71098585f10283dc8d0c53e114e2569ddd981e5c09238ad4df41bae', 'a:3:{s:7:\"produit\";a:3:{i:5;a:3:{s:10:\"nomProduit\";s:7:\"versace\";s:15:\"quantiteproduit\";i:50;s:11:\"prixProduit\";d:2000;}i:7;a:3:{s:10:\"nomProduit\";s:4:\"Nike\";s:15:\"quantiteproduit\";i:55;s:11:\"prixProduit\";d:3500;}i:9;a:3:{s:10:\"nomProduit\";s:7:\"versace\";s:15:\"quantiteproduit\";i:50;s:11:\"prixProduit\";d:2000;}}s:9:\"Prixtotal\";d:7500;s:5:\"token\";s:64:\"e8d0b64ba3aaa8d4067e7c5e36a0120bb94a454ee82d109603d6614cab5ad058\";}', 2, 2),
(81, 1500, 1, '2018-04-02', '01f7c1c2000abb22b9f3dec2be0553698efecfc4d796a37743c3b46d0a181f72', 'a:3:{s:7:\"produit\";a:1:{i:6;a:3:{s:10:\"nomProduit\";s:6:\"Reebok\";s:15:\"quantiteproduit\";i:45;s:11:\"prixProduit\";d:1500;}}s:9:\"Prixtotal\";d:1500;s:5:\"token\";s:64:\"ef90fc4e80535ee0d1304bf7d15c3a1c8c7ebf7741b5114b361dfe51a4c69898\";}', 3, 2),
(82, 1500, 1, '2018-04-02', '132bd8daa72149c4cc86e9fa55fea74645a18c24e4f6cc4cd7218e012559c362', 'a:3:{s:7:\"produit\";a:1:{i:6;a:3:{s:10:\"nomProduit\";s:6:\"Reebok\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:1500;}}s:9:\"Prixtotal\";d:1500;s:5:\"token\";s:64:\"1c92b2529757e53744f0c9b376788281497348db31eeea9a5e0db6f952b4910b\";}', 4, 2),
(83, 19500, 1, '2018-04-03', '7R824315F5884425E', 'a:3:{s:7:\"produit\";a:2:{i:2;a:3:{s:10:\"nomProduit\";s:17:\"Fortune-Sunflower\";s:15:\"quantiteproduit\";s:1:\"5\";s:11:\"prixProduit\";d:3500;}i:3;a:3:{s:10:\"nomProduit\";s:15:\"Aashirvaad-Atta\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:2000;}}s:9:\"Prixtotal\";d:19500;s:5:\"token\";s:64:\"4797cf2e4932242eae6cd5ad8f576875440d3f0d40806c19f4853b13f7761aff\";}', 5, 2),
(84, 45000, 1, '2018-04-03', '1P684238FY6048357', 'a:3:{s:7:\"produit\";a:3:{i:1;a:3:{s:10:\"nomProduit\";s:9:\"Tata-Salt\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:1500;}i:2;a:3:{s:10:\"nomProduit\";s:17:\"Fortune-Sunflower\";s:15:\"quantiteproduit\";s:1:\"5\";s:11:\"prixProduit\";d:3500;}i:3;a:3:{s:10:\"nomProduit\";s:15:\"Aashirvaad-Atta\";s:15:\"quantiteproduit\";s:2:\"13\";s:11:\"prixProduit\";d:2000;}}s:9:\"Prixtotal\";d:45000;s:5:\"token\";s:64:\"c51359cc31b50a6a4d757d3ccd0b12bce24bd6038fda6cb929fb0a7d690712b2\";}', 6, 2),
(85, 10500, 1, '2018-04-04', '3HX30567WG946020E', 'a:3:{s:7:\"produit\";a:1:{i:4;a:3:{s:10:\"nomProduit\";s:4:\"Dior\";s:15:\"quantiteproduit\";s:1:\"7\";s:11:\"prixProduit\";d:1500;}}s:9:\"Prixtotal\";d:10500;s:5:\"token\";s:64:\"469b6142140d5098aad90bb1d9f83d3d5f45d7e7cf39e20358de663a5852d981\";}', 7, 2),
(86, 10500, 1, '2018-04-04', '9CC21444HU6096844', 'a:3:{s:7:\"produit\";a:1:{i:4;a:3:{s:10:\"nomProduit\";s:4:\"Dior\";s:15:\"quantiteproduit\";s:1:\"7\";s:11:\"prixProduit\";d:1500;}}s:9:\"Prixtotal\";d:10500;s:5:\"token\";s:64:\"4efcbdaeccca950d9e890221f14b8c78856fe180cdddcf1a796cc1d6995dd8e4\";}', 8, 2),
(87, 10500, 1, '2018-04-04', '4JD532791J5304438', 'a:3:{s:7:\"produit\";a:1:{i:4;a:3:{s:10:\"nomProduit\";s:4:\"Dior\";s:15:\"quantiteproduit\";s:1:\"7\";s:11:\"prixProduit\";d:1500;}}s:9:\"Prixtotal\";d:10500;s:5:\"token\";s:64:\"4afb00dc6d1ed579817dd378d11a8b9db909c928e1cfa55b8da78e7333d8ab38\";}', 9, 2),
(88, 10500, 1, '2018-04-04', '78W49987GK644812H', 'a:3:{s:7:\"produit\";a:1:{i:4;a:3:{s:10:\"nomProduit\";s:4:\"Dior\";s:15:\"quantiteproduit\";s:1:\"7\";s:11:\"prixProduit\";d:1500;}}s:9:\"Prixtotal\";d:10500;s:5:\"token\";s:64:\"2e856516cd317591bf641c3d4ee44fb5a51aae23577f960df3154d0d4ddd91fc\";}', 10, 2),
(89, 2000, 1, '2018-04-05', '9MH12712CR748883B', 'a:3:{s:7:\"produit\";a:1:{i:3;a:3:{s:10:\"nomProduit\";s:15:\"Aashirvaad-Atta\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:2000;}}s:9:\"Prixtotal\";d:2000;s:5:\"token\";s:64:\"e8e77705d1b92c043676b9bb48076563c9d20cf83eb814ecc23a3323f7c71f82\";}', 11, 2),
(90, 11000, 1, '2018-04-05', '83K68158JH7745353', 'a:3:{s:7:\"produit\";a:2:{i:1;a:3:{s:10:\"nomProduit\";s:9:\"Tata-Salt\";s:15:\"quantiteproduit\";s:1:\"5\";s:11:\"prixProduit\";d:1500;}i:2;a:3:{s:10:\"nomProduit\";s:17:\"Fortune-Sunflower\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:3500;}}s:9:\"Prixtotal\";d:11000;s:5:\"token\";s:64:\"e83fc8b2c9be062bab1e04ac04b7338984bb3e765d7650776a060deadf9d78db\";}', 12, 2),
(91, 17500, 1, '2018-04-05', '5CC43626YR612005A', 'a:3:{s:7:\"produit\";a:1:{i:2;a:3:{s:10:\"nomProduit\";s:17:\"Fortune-Sunflower\";s:15:\"quantiteproduit\";s:1:\"5\";s:11:\"prixProduit\";d:3500;}}s:9:\"Prixtotal\";d:17500;s:5:\"token\";s:64:\"5d8668af97ebd0e8d6d7c0662c074650e6abc52239184c3e9ac3d9eb0911d76a\";}', 13, 2),
(92, 13500, 1, '2018-04-07', 'PAY-52U183084R254923VLLECG7Q', 'a:3:{s:7:\"produit\";a:2:{i:1;a:3:{s:10:\"nomProduit\";s:9:\"Tata-Salt\";s:15:\"quantiteproduit\";s:1:\"8\";s:11:\"prixProduit\";d:1500;}i:6;a:3:{s:10:\"nomProduit\";s:6:\"Reebok\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:1500;}}s:9:\"Prixtotal\";d:13500;s:5:\"token\";s:64:\"5d0e50aeefbe2cd3ccf2b177244995b2f1d0be57697c0414d1e37dd0579c5c0f\";}', 14, 2),
(93, 2000, 1, '2018-04-07', 'PAY-3JU230956F826701BLLEDHKQ', 'a:3:{s:7:\"produit\";a:1:{i:3;a:3:{s:10:\"nomProduit\";s:15:\"Aashirvaad-Atta\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:2000;}}s:9:\"Prixtotal\";d:2000;s:5:\"token\";s:64:\"25a7b1cffde6f66d0472cff59f938da334f86c63de2809869b41a356200371b8\";}', 15, 2),
(94, 2000, 1, '2018-04-07', 'PAY-5M4529821Y599481PLLEDIQQ', 'a:3:{s:7:\"produit\";a:1:{i:3;a:3:{s:10:\"nomProduit\";s:15:\"Aashirvaad-Atta\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:2000;}}s:9:\"Prixtotal\";d:2000;s:5:\"token\";s:64:\"3341df5976c9333b86c2a8a40b5102ece3be125c5fbab495b41d27ca196bae5e\";}', 16, 2),
(95, 1500, 1, '2018-04-07', 'PAY-0Y076133KM197333YLLEDNCA', 'a:3:{s:7:\"produit\";a:1:{i:6;a:3:{s:10:\"nomProduit\";s:6:\"Reebok\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:1500;}}s:9:\"Prixtotal\";d:1500;s:5:\"token\";s:64:\"dc01983b2601f60b048d0df23f30cd6380e72022efdce32a5a28059e225e48e6\";}', 17, 2),
(96, 2000, 1, '2018-04-07', 'PAY-4G4032660S371233JLLEDSJQ', 'a:3:{s:7:\"produit\";a:1:{i:3;a:3:{s:10:\"nomProduit\";s:15:\"Aashirvaad-Atta\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:2000;}}s:9:\"Prixtotal\";d:2000;s:5:\"token\";s:64:\"14b49be417ab65333fc601cf67c5895ac9a319469810fa2810e674403551fbf0\";}', 18, 2),
(97, 1500, 1, '2018-04-07', 'PAY-5LM18742FB097005KLLEEY7A', 'a:3:{s:7:\"produit\";a:1:{i:1;a:3:{s:10:\"nomProduit\";s:9:\"Tata-Salt\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:1500;}}s:9:\"Prixtotal\";d:1500;s:5:\"token\";s:64:\"ddaf8f75adbcba55c22786082038b4d07fa65fcf81121c124ff8ffc73264d1f8\";}', 19, 2),
(98, 2000, 1, '2018-04-07', 'PAY-0FK09874C3126611RLLEKPXA', 'a:3:{s:7:\"produit\";a:1:{i:9;a:3:{s:10:\"nomProduit\";s:7:\"versace\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:2000;}}s:9:\"Prixtotal\";d:2000;s:5:\"token\";s:64:\"baeec429832584fe43532007579832a1c19c0f73445201dd5294793d2c8c44b6\";}', 20, 2),
(99, 6000, 1, '2018-04-07', 'PAY-2UP39513AC888632WLLEN6MY', 'a:3:{s:7:\"produit\";a:1:{i:5;a:3:{s:10:\"nomProduit\";s:7:\"versace\";s:15:\"quantiteproduit\";s:1:\"3\";s:11:\"prixProduit\";d:2000;}}s:9:\"Prixtotal\";d:6000;s:5:\"token\";s:64:\"14b4fc33e979f2641ca3f946015c2bb2a423e0b65025bce30579513c355cf3f8\";}', 21, 2),
(100, 3000, 1, '2018-04-07', 'PAY-3G150479N1953350SLLEOWMI', 'a:3:{s:7:\"produit\";a:2:{i:1;a:3:{s:10:\"nomProduit\";s:9:\"Tata-Salt\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:1500;}i:6;a:3:{s:10:\"nomProduit\";s:6:\"Reebok\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:1500;}}s:9:\"Prixtotal\";d:3000;s:5:\"token\";s:64:\"5b7a864b194ed5e4eb2bce881bab1c2c864e633a94c0ea1e7e10cb692fa4f96b\";}', 22, 2),
(101, 1500, 1, '2018-04-12', 'PAY-3CJ93056T19582206LLHRZYY', 'a:3:{s:7:\"produit\";a:1:{i:1;a:3:{s:10:\"nomProduit\";s:9:\"Tata-Salt\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:1500;}}s:9:\"Prixtotal\";d:1500;s:5:\"token\";s:64:\"5fbb26bef7cfe3a8394b692bfdd1f8357c327f3331ed7f275d0d5dc913f16e4f\";}', 23, 2),
(104, 14000, 1, '2018-05-07', 'c40a1996b44ed75584535c377fd953e1c34f27a13faec911b01b9606534daf6f', 'a:3:{s:7:\"produit\";a:6:{i:1;a:3:{s:10:\"nomProduit\";s:9:\"Tata-Salt\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:1500;}i:2;a:3:{s:10:\"nomProduit\";s:17:\"Fortune-Sunflower\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:3500;}i:3;a:3:{s:10:\"nomProduit\";s:15:\"Aashirvaad-Atta\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:2000;}i:4;a:3:{s:10:\"nomProduit\";s:4:\"Dior\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:1500;}i:7;a:3:{s:10:\"nomProduit\";s:4:\"Nike\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:3500;}i:8;a:3:{s:10:\"nomProduit\";s:7:\"Addidas\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:2000;}}s:9:\"Prixtotal\";d:14000;s:5:\"token\";s:64:\"1d104d50be6e11d0f8279ed23db26148c8c313b2b7c79b20bd50ceb921846cd0\";}', 24, 2),
(105, 0, 1, '2018-05-20', '0fdb17419f2cf525daa4501bd3df496a4d4c0022a82594941a23b1d8826b1e8e', 'a:0:{}', 25, 2),
(106, 0, 1, '2018-05-20', '2dd4aa688d59a5373ff2252ab602e7740821ac29d2988323513d006f8468667c', 'a:0:{}', 26, 2),
(107, 1500, 1, '2018-05-20', 'PAY-23890006RF932982GLMA6UZA', 'a:4:{s:7:\"produit\";a:1:{i:4;a:4:{s:10:\"nomProduit\";s:4:\"Dior\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:1500;s:9:\"promotion\";i:0;}}s:6:\"client\";C:37:\"SoukElMedina\\PidevBundle\\Entity\\Users\":214:{a:8:{i:0;s:60:\"$2a$12$3ydqj8tIkWpr03mDinY69u6mDAhE/utWH28T9gRY54DcbZqX1DefG\";i:1;N;i:2;s:8:\"oussama3\";i:3;s:8:\"oussama3\";i:4;b:1;i:5;i:2;i:6;s:26:\"boumaizaoussamab@gmail.com\";i:7;s:26:\"boumaizaoussamab@gmail.com\";}}s:9:\"Prixtotal\";d:1500;s:5:\"token\";s:64:\"6fd04ece28bfcdbce386de82551eef3231eb91a6bf43a5406a89f2bc59bce418\";}', 27, 2),
(108, 3500, 1, '2018-05-20', 'PAY-90D67195S87288307LMA6V7Y', 'a:4:{s:7:\"produit\";a:1:{i:7;a:4:{s:10:\"nomProduit\";s:4:\"Nike\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:3500;s:9:\"promotion\";i:0;}}s:6:\"client\";C:37:\"SoukElMedina\\PidevBundle\\Entity\\Users\":214:{a:8:{i:0;s:60:\"$2a$12$3ydqj8tIkWpr03mDinY69u6mDAhE/utWH28T9gRY54DcbZqX1DefG\";i:1;N;i:2;s:8:\"oussama3\";i:3;s:8:\"oussama3\";i:4;b:1;i:5;i:2;i:6;s:26:\"boumaizaoussamab@gmail.com\";i:7;s:26:\"boumaizaoussamab@gmail.com\";}}s:9:\"Prixtotal\";d:3500;s:5:\"token\";s:64:\"a5e3ac498ce558fd1925b98db79f59c94503e1f5e9e7bcb2e07a70a2cf1aee14\";}', 28, 2),
(109, 15500, 1, '2018-05-21', 'PAY-9WK348662F7267355LMBT5BA', 'a:4:{s:7:\"produit\";a:3:{i:1;a:4:{s:10:\"nomProduit\";s:9:\"Tata-Salt\";s:15:\"quantiteproduit\";s:1:\"3\";s:11:\"prixProduit\";d:1500;s:9:\"promotion\";i:0;}i:4;a:4:{s:10:\"nomProduit\";s:4:\"Dior\";s:15:\"quantiteproduit\";s:1:\"6\";s:11:\"prixProduit\";d:1500;s:9:\"promotion\";i:0;}i:5;a:4:{s:10:\"nomProduit\";s:7:\"versace\";s:15:\"quantiteproduit\";i:1;s:11:\"prixProduit\";d:2000;s:9:\"promotion\";i:0;}}s:6:\"client\";C:37:\"SoukElMedina\\PidevBundle\\Entity\\Users\":214:{a:8:{i:0;s:60:\"$2a$12$3ydqj8tIkWpr03mDinY69u6mDAhE/utWH28T9gRY54DcbZqX1DefG\";i:1;N;i:2;s:8:\"oussama3\";i:3;s:8:\"oussama3\";i:4;b:1;i:5;i:2;i:6;s:26:\"boumaizaoussamab@gmail.com\";i:7;s:26:\"boumaizaoussamab@gmail.com\";}}s:9:\"Prixtotal\";d:15500;s:5:\"token\";s:64:\"e3d73835d3594f8050eb9dcfd241e00b93f7ea411e95b0b176682c9fba1124c1\";}', 29, 2),
(110, 5000, 0, '2018-05-21', '2720', NULL, NULL, 2),
(111, 7500, 1, '2018-05-22', 'PAY-6CY21881FT064040KLMB6ZFY', 'a:4:{s:7:\"produit\";a:1:{i:1;a:4:{s:10:\"nomProduit\";s:9:\"Tata-Salt\";s:15:\"quantiteproduit\";s:1:\"5\";s:11:\"prixProduit\";d:1500;s:9:\"promotion\";i:0;}}s:6:\"client\";C:37:\"SoukElMedina\\PidevBundle\\Entity\\Users\":214:{a:8:{i:0;s:60:\"$2a$12$3ydqj8tIkWpr03mDinY69u6mDAhE/utWH28T9gRY54DcbZqX1DefG\";i:1;N;i:2;s:8:\"oussama3\";i:3;s:8:\"oussama3\";i:4;b:1;i:5;i:2;i:6;s:26:\"boumaizaoussamab@gmail.com\";i:7;s:26:\"boumaizaoussamab@gmail.com\";}}s:9:\"Prixtotal\";d:7500;s:5:\"token\";s:64:\"468e3cc3333bfec5f283ad399519e9e40007e99fed21850ed48ccd7bc557388a\";}', 30, 2);

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `idCommentaire` int(11) NOT NULL AUTO_INCREMENT,
  `contenuCommentaire` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateAjoutCommentaire` date DEFAULT NULL,
  `dateModificationCommentaire` date DEFAULT NULL,
  `idProduit` int(11) DEFAULT NULL,
  `idEvenement` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCommentaire`),
  KEY `idUser` (`idUser`),
  KEY `commentaires_ibfk_2` (`idProduit`),
  KEY `idevenement` (`idEvenement`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`idCommentaire`, `contenuCommentaire`, `dateAjoutCommentaire`, `dateModificationCommentaire`, `idProduit`, `idEvenement`, `idUser`) VALUES
(6, 'JNTHNJTHKK?HTK?HKY?HYH', '2018-05-07', NULL, NULL, 6, 7),
(7, 'aaaaa', '2018-05-07', NULL, NULL, 6, 7),
(10, 'hellop22963!!!', '2018-05-22', '2018-05-22', 1, NULL, 2),
(13, 'Boyz!!!56', '2018-05-22', NULL, NULL, 6, 2),
(14, 'UHTllm!!', '2018-05-22', NULL, NULL, 6, 2),
(15, 'UHTllm!!56988', '2018-05-22', NULL, NULL, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `iduser` int(11) DEFAULT NULL,
  `idEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `nomEvenement` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nombreDePlaces` int(11) NOT NULL,
  `nombreDesPlacesRestante` int(11) DEFAULT NULL,
  `tarifEvenement` double NOT NULL,
  `descriptionEvenement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Lieu` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime DEFAULT NULL,
  `date_fin` datetime DEFAULT NULL,
  `verifier` int(11) DEFAULT NULL,
  `image_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idEvenement`),
  KEY `IDX_E10AD4005E5C27E9` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `evenements`
--

INSERT INTO `evenements` (`iduser`, `idEvenement`, `nomEvenement`, `nombreDePlaces`, `nombreDesPlacesRestante`, `tarifEvenement`, `descriptionEvenement`, `Lieu`, `date`, `date_fin`, `verifier`, `image_link`) VALUES
(1, 1, 'jean', 100, 96, 100, 'test jean,nlk,lkn ybunkjbyu hb ygugbjbgiu ybhbiuèibjbjbugh_hknjkj ibhjbyuibj biuhbiunknub uibkjbiuj jbn,hi_hj j iubbjn u jhb', 'Hôtel Africa, Avenue Habib Bourguiba, Tunis, Tunisia', '2018-05-24 18:30:00', '2018-05-24 18:33:00', 1, '35161ea14803fb6308b7c065466c3c299af68f7e.png'),
(1, 2, 'test2', 20, 20, 0, 'Description', 'Dar Chaabane El Fehri, Tunisia', '2018-05-06 02:35:00', '2018-05-10 02:35:00', 1, 'f_5aed0af488004.jpg'),
(1, 3, 'Journée d\'artisanats', 20, 20, 0, 'Description', 'Dar Chaabane El Fehri, Tunisia', '2018-05-08 02:36:00', '2018-05-31 02:36:00', 1, 'e6da6351811110621d24ceecbbced18bf7fe1d65.png'),
(1, 6, 'dfhngfhf', 20, 20, 852, 'Description', 'Tunis, Tunisia', '2018-05-08 04:25:00', '2018-05-12 04:25:00', 0, 'f_5aefc6ba920ae.png'),
(1, 7, 'test2018', 30, 30, 100, 'test', 'Hotel Africa, Avenue Habib Bourguiba, Tunis, Tunisia', '2018-05-09 09:51:00', '2018-05-13 09:51:00', 0, 'f_5af013d77a2ed.png'),
(1, 8, 'test', 660, 660, 550, 'Description hzsjxhsjkj', 'NABEUL CAR, Habib Bourguiba Street, Nabeul‎, Tunisia', '2018-05-23 10:29:00', '2018-05-28 11:59:00', 0, 'f_5b03e3cb322f2.png');

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
  `idProduit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idCommande` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idMagasin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idLigneCommande`),
  KEY `idCommande` (`idCommande`),
  KEY `idMagasin` (`idMagasin`),
  KEY `idProduit` (`idProduit`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lignecommandes`
--

INSERT INTO `lignecommandes` (`idLigneCommande`, `prixTotal`, `quantite`, `prixUnitaire`, `idProduit`, `idCommande`, `idMagasin`) VALUES
(24, 3500, 1, 3500, '7', '75', '1'),
(25, 2000, 1, 2000, '9', '75', '1'),
(27, 3500, 1, 3500, '7', '76', '1'),
(28, 2000, 1, 2000, '9', '76', '1'),
(30, 3500, 1, 3500, '7', '77', '1'),
(31, 2000, 1, 2000, '9', '77', '1'),
(33, 3500, 1, 3500, '7', '78', '1'),
(34, 2000, 1, 2000, '9', '78', '1'),
(36, 3500, 1, 3500, '7', '79', '1'),
(37, 2000, 1, 2000, '9', '79', '1'),
(39, 3500, 1, 3500, '7', '80', '1'),
(40, 2000, 1, 2000, '9', '80', '1'),
(41, 1500, 1, 1500, '6', '81', '1'),
(42, 1500, 1, 1500, '6', '82', '1'),
(44, 2000, 1, 2000, '3', '83', '1'),
(45, 1500, 1, 1500, '1', '84', '1'),
(47, 26000, 13, 2000, '3', '84', '1'),
(48, 10500, 7, 1500, '4', '85', '1'),
(49, 10500, 7, 1500, '4', '86', '1'),
(50, 10500, 7, 1500, '4', '87', '1'),
(51, 10500, 7, 1500, '4', '88', '1'),
(52, 2000, 1, 2000, '3', '89', '1'),
(53, 7500, 5, 1500, '1', '90', '1'),
(56, 12000, 8, 1500, '1', '92', '1'),
(57, 1500, 1, 1500, '6', '92', '1'),
(58, 2000, 1, 2000, '3', '93', '1'),
(59, 2000, 1, 2000, '3', '94', '1'),
(60, 1500, 1, 1500, '6', '95', '1'),
(61, 2000, 1, 2000, '3', '96', '1'),
(62, 1500, 1, 1500, '1', '97', '1'),
(63, 2000, 1, 2000, '9', '98', '1'),
(64, 6000, 3, 2000, '5', '99', '1'),
(65, 1500, 1, 1500, '1', '100', '1'),
(66, 3500, 1, 3500, '2', '103', '1'),
(67, 1500, 1, 1500, '1', '104', '1'),
(68, 3500, 1, 3500, '2', '104', '1'),
(69, 2000, 1, 2000, '3', '104', '1'),
(70, 1500, 1, 1500, '4', '104', '1'),
(71, 3500, 1, 3500, '7', '104', '1'),
(72, 2000, 1, 2000, '8', '104', '1'),
(73, 1500, 1, 1500, '4', '107', '1'),
(74, 3500, 1, 3500, '7', '108', '1'),
(75, 4500, 3, 1500, '1', '109', '1'),
(76, 9000, 6, 1500, '4', '109', '1'),
(77, 2000, 1, 2000, '5', '109', '1'),
(78, 67500, 1, 1500, '1', '0', '1'),
(79, 192500, 1, 3500, '2', '0', '1'),
(80, 7500, 5, 1500, '1', '111', '1');

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
  `numeroMagasin` int(11) DEFAULT NULL,
  `adresseMagasin` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateCreationMagasin` date NOT NULL,
  `contactMagasin` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMagasin`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `magasins`
--

INSERT INTO `magasins` (`idMagasin`, `nomMagasin`, `photoMagasin`, `descriptionMagasin`, `numeroMagasin`, `adresseMagasin`, `dateCreationMagasin`, `contactMagasin`, `idUser`) VALUES
(1, 'Samsung', 'téléchargement.png', 'magasin des chaussures situé à jaafar', NULL, 'Nour Jaafar', '2018-02-21', '', 1),
(2, 'Magro', 'mg.jpg', 'habit pret à porter', NULL, NULL, '2018-02-15', '', 8);

-- --------------------------------------------------------

--
-- Table structure for table `participations`
--

DROP TABLE IF EXISTS `participations`;
CREATE TABLE IF NOT EXISTS `participations` (
  `idParticipation` int(11) NOT NULL AUTO_INCREMENT,
  `idEvenement` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idParticipation`),
  UNIQUE KEY `idUser` (`idUser`,`idEvenement`),
  KEY `IDX_FDC6C6E8F7CC4348` (`idEvenement`),
  KEY `IDX_FDC6C6E8FE6E88D7` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `referenceProduit` varchar(110) COLLATE utf8_unicode_ci NOT NULL,
  `nomProduit` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prixProduit` double NOT NULL,
  `photoProduit` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `quantiteProduit` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `idpromotion` int(11) DEFAULT NULL,
  `categorieMagasin` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `new_prix` double DEFAULT NULL,
  `valid` int(11) DEFAULT NULL,
  `idMagasin` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProduit`),
  KEY `idMagasin` (`idMagasin`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`idProduit`, `referenceProduit`, `nomProduit`, `prixProduit`, `photoProduit`, `quantiteProduit`, `active`, `idpromotion`, `categorieMagasin`, `new_prix`, `valid`, `idMagasin`) VALUES
(1, '0', 'Tata-Salt', 1500, 'coussin-design-faience.jpg', 44, 0, 0, '', 1005, 0, 1),
(2, '0', 'Fortune-Sunflower', 3500, 'chemin-de-table.jpg', 54, 0, 0, '', NULL, 0, 1),
(3, '0', 'Aashirvaad-Atta', 2000, 'bracelet-nemli.jpg', 45, 0, 0, '', 1500, 1, 1),
(4, '0', 'Dior', 1500, 'collier-style.jpg', 20, 0, 0, '', 1170, 0, 1),
(5, '0', 'versace', 2000, 'parure-cannette.jpg', 50, 0, 0, '', 1000, 0, 1),
(6, '0', 'Reebok', 1500, 'bracelet-chat.jpg', 45, 0, 0, '', NULL, 0, 1),
(7, '0', 'Nike', 3500, 'boite-deco.jpg', 55, 0, 0, '', NULL, 0, 1),
(8, '0', 'Addidas', 2000, 'mini-coussin-odorant.jpg', 45, 0, 0, '', NULL, 0, 1),
(9, '0', 'versace', 2000, 'salon-tisse.jpg', 50, 0, 0, '', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

DROP TABLE IF EXISTS `promotions`;
CREATE TABLE IF NOT EXISTS `promotions` (
  `idPromotion` int(11) NOT NULL AUTO_INCREMENT,
  `nomPromotion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dateDebut` datetime NOT NULL,
  `dateFin` datetime NOT NULL,
  `pourcentage` int(11) NOT NULL,
  `image_link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `IdProduit` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `enable` int(11) NOT NULL,
  PRIMARY KEY (`idPromotion`),
  KEY `idUser` (`idUser`),
  KEY `IdProduit` (`IdProduit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`idPromotion`, `nomPromotion`, `dateDebut`, `dateFin`, `pourcentage`, `image_link`, `IdProduit`, `idUser`, `enable`) VALUES
(2, 'hello 2018', '2018-05-01 23:15:00', '2018-05-31 23:15:00', 25, '8b9ded1999498783e411a5d57f47c87656f08f29.png', 3, 1, 1),
(4, 'dxfbdfbxcv', '2018-05-01 02:15:00', '2018-05-13 02:15:00', 22, 'f_5aefa8bc0f248.png', 4, 1, 1);

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
  `dateEnvoiReclamation` datetime DEFAULT NULL,
  `dateReponseReclamation` datetime DEFAULT NULL,
  `statusReclamation` smallint(6) NOT NULL,
  `suiviReclamation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `visibiliteReclamation` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'Oui',
  `idMagasin` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  PRIMARY KEY (`idReclamation`),
  KEY `idUser` (`idUser`),
  KEY `reclamations_ibfk_2` (`idMagasin`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reclamations`
--

INSERT INTO `reclamations` (`idReclamation`, `typeReclamation`, `objetReclamation`, `contenuReclamation`, `dateEnvoiReclamation`, `dateReponseReclamation`, `statusReclamation`, `suiviReclamation`, `visibiliteReclamation`, `idMagasin`, `idUser`) VALUES
(1, 'Réclamation liée à une vente', 'aaaa', 'xcvxdfbfcgbcxv xdfbgtgbxfbbvxgtrb', '2018-05-06 20:56:09', NULL, 1, 'En attente', 'Oui', 1, 2),
(2, 'Réclamation liée à une vente', 'Test 2563', 'tyytreegn, !!;:m65', '2018-05-22 01:32:21', '2018-05-22 01:47:41', 1, 'Rejétée', 'Oui', 1, 2),
(3, 'Réclamation liée à une vente', 'Test de reclammtion', 'Ceci est un test!!!000', '2018-05-22 10:24:54', NULL, 0, 'En attente', 'Oui', 1, 2);

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
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
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
  `pub` int(11) DEFAULT NULL,
  `nombreDeReclamations` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_1483A5E9A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_1483A5E9C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `nom`, `prenom`, `dateDeNaissance`, `sexe`, `adresse`, `ville`, `zip`, `numeroDuTelephone`, `type`, `imageUser`, `numeroDeCarteBancaire`, `dateDeValidation`, `codeSecret`, `situaitionFiscal`, `ribBancaire`, `pub`, `nombreDeReclamations`) VALUES
(1, 'oussama', 'oussama', 'boumaizaoussamabb@gmail.com', 'boumaizaoussamabb@gmail.com', 1, NULL, '$2a$12$BtCckXfduI5I6yUC1s.v1umMuaNsswf/Ep1WYftvx3lwXxDvHwlDS', '2018-05-22 10:36:39', NULL, NULL, 'a:1:{i:0;s:12:\"ROLE_VENDEUR\";}', 'boumaiza', 'oussama', '1964-01-01 00:00:00', 'Homme', 'Rue Du Grand Maghreb, Dar Chaabane Fehrie', 'Nabeul', 8011, '20950389', NULL, NULL, NULL, NULL, NULL, 'Bien', 'asderf15kl102vgf99', 0, NULL),
(2, 'oussama3', 'oussama3', 'boumaizaoussamab@gmail.com', 'boumaizaoussamab@gmail.com', 1, NULL, '$2a$12$3ydqj8tIkWpr03mDinY69u6mDAhE/utWH28T9gRY54DcbZqX1DefG', '2018-05-22 10:20:34', NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'boumaiaza', 'oussama', '1993-04-03 00:00:00', 'Homme', 'Rue Du Grand Maghreb, Dar Chaabane Fehrie', 'Nabeul', 8011, '20950389', NULL, 'user.png', '1234567890123456', '2018-06-01', '8df77a948fac1b4a0f97aa554886ec8', NULL, NULL, 1, 3),
(5, 'admin', 'admin', 'topadmin@soukelmedina.tn', 'topadmin@soukelmedina.tn', 1, NULL, '$2y$13$lHbs.eFm9vEjZjg/qn86z.B8hOfGNL4mp9Tc5bp2VhDIUuSre16MG', '2018-05-21 21:35:26', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', 'admin', 'admin', '2013-01-01 00:00:00', 'Homme', 'Rue Du Grand Maghreb, Dar Chaabane Fehrie', 'Nabeul', 8011, '20950389', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(6, 'oussama8', 'oussama8', 'boumaizaoussma@yahoo.fr', 'boumaizaoussma@yahoo.fr', 1, NULL, '$2y$13$GHydraXyYdu3Fz9Qe7HbteNdJ3yhgc2CyuIcPZTAGv1RM1iiWU2yW', NULL, NULL, NULL, 'a:0:{}', 'boumaiza', 'oussama', '2018-05-06 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'az', 'az', 'az', 'az', 1, NULL, '$2y$13$wgTAwNsuE55CafZJRVL6Cek6YNM6eJEUECZ0a6nVfza2vTYeZmKfy', NULL, NULL, NULL, 'a:0:{}', 'az', 'az', '2018-05-07 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'oussama1', 'oussama1', 'oussama@souk.com', 'oussama@souk.com', 1, NULL, '$2a$12$9wT7tUdjsC9Ktq2M/hIk9OdDRNtuai9gDvfB15szIOMgj/wV/YjCq', '2018-05-21 13:17:37', NULL, NULL, 'a:1:{i:0;s:12:\"ROLE_VENDEUR\";}', 'ouss', 'ama', '1993-04-03 00:00:00', 'Homme', 'rue nabeul', 'nabeul', 8011, '20950389', NULL, NULL, NULL, NULL, NULL, 'Bien', 'asderf15kl102vgf99', NULL, NULL),
(10, 'pi', 'pi', 'oussama.boumaiza.1@esprit.tn', 'oussama.boumaiza.1@esprit.tn', 1, NULL, 'ffb5c2d15fa248fbcadbf3bf7bfe93d', NULL, NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'pi', 'pi', '1993-04-03 00:00:00', 'Homme', 'nabeul', 'nabeul', 8011, '50664665', NULL, 'loginjava.PNG', '1234567890123456', '2018-06-10', '202cb962ac5975b964b7152d234b70', NULL, NULL, NULL, NULL),
(11, 'pi2', 'pi2', 'boumaizaoussamab@gmail.com6', 'boumaizaoussamab@gmail.com6', 1, NULL, '$2y$13$srZKqQQLOxh8Ze1GUkN3U.uEkuRQy2LvsXfLINaWCOMf29CgI5xR.', NULL, NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'boumaiaza', 'oussama', '2013-01-01 00:00:00', 'Homme', 'Rue Du Grand Maghreb, Dar Chaabane Fehrie', 'Nabeul', 8011, '20950389', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(12, 'pi9', 'pi9', 'boumaizaoussam8ab@gmail.com9', 'boumaizaoussam8ab@gmail.com9', 1, NULL, '$2y$13$2ypzOzj6zO1g1zKMNWzJoOvUiRWRQfkV8vO7pavrpFPCW2owHP0wq', '2018-05-22 10:31:51', NULL, NULL, 'a:1:{i:0;s:11:\"ROLE_CLIENT\";}', 'boumaiaza', 'oussama', '2013-01-01 00:00:00', 'Homme', 'Rue Du Grand Maghreb, Dar Chaabane Fehrie', 'Nabeul', 8011, '20950389', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_35D4282CFE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `FK_D9BEC0C4391C87D5` FOREIGN KEY (`idProduit`) REFERENCES `produits` (`idProduit`),
  ADD CONSTRAINT `FK_D9BEC0C4FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`idEvenement`) REFERENCES `evenements` (`idEvenement`);

--
-- Constraints for table `evenements`
--
ALTER TABLE `evenements`
  ADD CONSTRAINT `FK_E10AD4005E5C27E9` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `magasins`
--
ALTER TABLE `magasins`
  ADD CONSTRAINT `FK_BE50D53FFE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `participations`
--
ALTER TABLE `participations`
  ADD CONSTRAINT `FK_FDC6C6E8F7CC4348` FOREIGN KEY (`idEvenement`) REFERENCES `evenements` (`idEvenement`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_FDC6C6E8FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payement`
--
ALTER TABLE `payement`
  ADD CONSTRAINT `FK_B20A78853D498C26` FOREIGN KEY (`idCommande`) REFERENCES `commandes` (`idCommande`),
  ADD CONSTRAINT `FK_B20A7885FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `FK_BE2DDF8C441634D5` FOREIGN KEY (`idMagasin`) REFERENCES `magasins` (`idMagasin`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `FK_EA1B3034BBED0576` FOREIGN KEY (`IdProduit`) REFERENCES `produits` (`idProduit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_EA1B3034FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reclamations`
--
ALTER TABLE `reclamations`
  ADD CONSTRAINT `FK_1CAD6B76441634D5` FOREIGN KEY (`idMagasin`) REFERENCES `magasins` (`idMagasin`),
  ADD CONSTRAINT `FK_1CAD6B76FE6E88D7` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
