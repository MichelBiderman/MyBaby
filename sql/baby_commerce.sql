-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 18 Mars 2016 à 00:40
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `baby_commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `id_grande_categorie` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `id_grande_categorie`, `nom`, `description`) VALUES
(1, 1, 'Laits en poudre', 'Pots de laits en poudre pour nourrisson'),
(2, 1, 'Eau', 'Bouteilles en pack ou à l''unité'),
(3, 2, 'couches', 'couches 0-2.5kg'),
(4, 3, 'Biberons', 'découvrez notre gamme de bibs');

-- --------------------------------------------------------

--
-- Structure de la table `grande_categorie`
--

CREATE TABLE IF NOT EXISTS `grande_categorie` (
  `id_grande_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_grande_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `grande_categorie`
--

INSERT INTO `grande_categorie` (`id_grande_categorie`, `nom`) VALUES
(1, 'Produits Alimentaires'),
(2, 'Produits d''hygiène'),
(3, 'Accessoires de bébé');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE IF NOT EXISTS `panier` (
  `id_panier` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_produit` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_panier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=7 ;

--
-- Contenu de la table `panier`
--

INSERT INTO `panier` (`id_panier`, `id_user`, `id_produit`, `quantite`) VALUES
(1, 2, 2, 1),
(2, 2, 5, 1),
(3, 2, 6, 1),
(4, 2, 4, 1),
(5, 1, 5, 1),
(6, 1, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(11) DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pu` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_categorie`, `nom`, `ref`, `pu`) VALUES
(1, 1, 'MILUMEL 0-6mois ', 'Mil', '20'),
(2, 2, 'Cristalline', 'Cris_1L', '1'),
(3, 1, 'NIDAL', 'NIDAL', '15'),
(4, 1, 'GUIGOZ', 'GUIGOZ', '16'),
(5, 2, 'EVIAN', 'EVIAN', '1'),
(6, 2, 'HEPAR', 'HEPAR', '1'),
(7, 3, 'Pampers baby-drive 1', 'Pack de 23 couches 0-2.5kg\r\nPampers', '5'),
(8, 3, 'Pampers baby-drive 1', 'Pack de 23 couches 0-2.5kg\r\nPampers', '4'),
(9, 4, 'lot de 4 biberons ', 'marque: pommette', '9'),
(10, 4, 'lot de 4 biberons ', 'marque: pommette', '8');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mail` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `mdp` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_postale` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateInscription` datetime DEFAULT NULL,
  `dateConnexion` datetime DEFAULT NULL,
  `dateSession` datetime DEFAULT NULL,
  `loginOk` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=186 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `mail`, `mdp`, `nom`, `prenom`, `adresse_postale`, `dateInscription`, `dateConnexion`, `dateSession`, `loginOk`) VALUES
(1, 'max@max.fr', 'max', 'Lefort', 'Max', '45, av du général Leclerc', '2016-02-19 00:36:10', '2016-03-17 22:34:38', '2016-03-17 22:35:15', 0),
(2, 'michou@yahoo.fr', 'michou', 'biderman', 'Michel-Auguste', '1, av de l''ancien Vélodrôme', '2016-03-09 14:55:44', '2016-03-17 22:45:42', '2016-03-17 22:47:02', 1),
(5, 'julia@gmail.com', 'julia', 'biderman', 'julia', '1, av de l''ancien Vélodrôme', '2016-03-09 14:58:48', '2016-03-12 20:52:55', '2016-03-12 20:53:24', 0),
(143, '', '', '', '', '', '2016-03-16 22:41:05', '2016-03-16 22:41:05', '2016-03-16 21:41:09', 0),
(144, '', '', '', '', '', '2016-03-16 22:41:23', '2016-03-16 22:41:23', '2016-03-16 21:41:38', 0),
(145, '', '', '', '', '', '2016-03-16 22:47:14', '2016-03-16 22:47:14', '2016-03-16 21:47:14', 0),
(146, '', '', '', '', '', '2016-03-16 23:48:29', '2016-03-16 23:48:29', '2016-03-16 22:55:59', 0),
(147, '', '', '', '', '', '2016-03-17 00:08:34', '2016-03-17 00:08:34', '2016-03-16 23:22:09', 0),
(148, '', '', '', '', '', '2016-03-17 00:22:48', '2016-03-17 00:22:48', '2016-03-16 23:22:48', 0),
(149, '', '', '', '', '', '2016-03-17 00:52:54', '2016-03-17 00:52:54', '2016-03-16 23:54:12', 0),
(150, '', '', '', '', '', '2016-03-17 01:00:05', '2016-03-17 01:00:05', '2016-03-17 00:04:21', 0),
(151, '', '', '', '', '', '2016-03-17 01:08:19', '2016-03-17 01:08:19', '2016-03-17 00:08:19', 0),
(152, '', '', '', '', '', '2016-03-17 01:21:35', '2016-03-17 01:21:35', '2016-03-17 00:22:25', 0),
(153, '', '', '', '', '', '2016-03-17 01:25:28', '2016-03-17 01:25:28', '2016-03-17 00:38:41', 0),
(154, '', '', '', '', '', '2016-03-17 02:07:11', '2016-03-17 02:07:11', '2016-03-17 01:17:02', 0),
(155, '', '', '', '', '', '2016-03-17 02:32:50', '2016-03-17 02:32:50', '2016-03-17 01:35:57', 0),
(156, '', '', '', '', '', '2016-03-17 02:38:45', '2016-03-17 02:38:45', '2016-03-17 01:40:07', 0),
(157, '', '', '', '', '', '2016-03-17 02:57:17', '2016-03-17 02:57:17', '2016-03-17 01:57:17', 0),
(158, '', '', '', '', '', '2016-03-17 03:02:36', '2016-03-17 03:02:36', '2016-03-17 02:27:28', 0),
(159, '', '', '', '', '', '2016-03-17 08:21:31', '2016-03-17 08:21:31', '2016-03-17 07:21:31', 0),
(160, '', '', '', '', '', '2016-03-17 09:40:56', '2016-03-17 09:40:56', '2016-03-17 08:40:56', 0),
(161, '', '', '', '', '', '2016-03-17 09:43:47', '2016-03-17 09:43:47', '2016-03-17 08:44:01', 0),
(162, '', '', '', '', '', '2016-03-17 14:14:31', '2016-03-17 14:14:31', '2016-03-17 13:25:24', 0),
(163, '', '', '', '', '', '2016-03-17 14:53:49', '2016-03-17 14:53:49', '2016-03-17 14:04:14', 0),
(164, '', '', '', '', '', '2016-03-17 15:13:37', '2016-03-17 15:13:37', '2016-03-17 14:13:37', 0),
(165, '', '', '', '', '', '2016-03-17 15:37:58', '2016-03-17 15:37:58', '2016-03-17 14:37:58', 0),
(166, '', '', '', '', '', '2016-03-17 15:39:29', '2016-03-17 15:39:29', '2016-03-17 14:47:23', 0),
(167, '', '', '', '', '', '2016-03-17 16:16:55', '2016-03-17 16:16:55', '2016-03-17 15:16:55', 0),
(168, '', '', '', '', '', '2016-03-17 16:21:14', '2016-03-17 16:21:14', '2016-03-17 15:26:46', 0),
(169, '', '', '', '', '', '2016-03-17 17:32:25', '2016-03-17 17:32:25', '2016-03-17 16:32:25', 0),
(170, '', '', '', '', '', '2016-03-17 17:56:03', '2016-03-17 17:56:03', '2016-03-17 16:56:06', 0),
(171, '', '', '', '', '', '2016-03-17 19:19:52', '2016-03-17 19:19:52', '2016-03-17 18:22:05', 0),
(172, '', '', '', '', '', '2016-03-17 19:32:03', '2016-03-17 19:32:03', '2016-03-17 18:32:03', 0),
(173, '', '', '', '', '', '2016-03-17 19:32:06', '2016-03-17 19:32:06', '2016-03-17 18:32:10', 0),
(174, '', '', '', '', '', '2016-03-17 19:40:27', '2016-03-17 19:40:27', '2016-03-17 18:41:02', 0),
(175, '', '', '', '', '', '2016-03-17 19:53:20', '2016-03-17 19:53:20', '2016-03-17 18:56:23', 0),
(176, '', '', '', '', '', '2016-03-17 20:01:09', '2016-03-17 20:01:09', '2016-03-17 19:10:05', 0),
(177, '', '', '', '', '', '2016-03-17 20:17:48', '2016-03-17 20:17:48', '2016-03-17 19:17:48', 0),
(178, '', '', '', '', '', '2016-03-17 20:22:41', '2016-03-17 20:22:41', '2016-03-17 19:22:41', 0),
(179, '', '', '', '', '', '2016-03-17 23:24:57', '2016-03-17 23:24:57', '2016-03-17 22:24:56', 0),
(180, '', '', '', '', '', '2016-03-17 23:28:58', '2016-03-17 23:28:58', '2016-03-17 22:33:16', 0),
(181, '', '', '', '', '', '2016-03-17 23:33:35', '2016-03-17 23:33:35', '2016-03-17 22:34:38', 0),
(182, '', '', '', '', '', '2016-03-17 23:35:16', '2016-03-17 23:35:16', '2016-03-17 22:35:25', 0),
(183, '', '', '', '', '', '2016-03-17 23:42:33', '2016-03-17 23:42:33', '2016-03-17 22:43:59', 0),
(184, '', '', '', '', '', '2016-03-17 23:44:13', '2016-03-17 23:44:13', '2016-03-17 22:45:42', 0),
(185, '', '', '', '', '', '2016-03-17 23:50:53', '2016-03-17 23:50:53', '2016-03-17 23:31:35', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
