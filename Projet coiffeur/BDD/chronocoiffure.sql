-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 03 fév. 2022 à 10:41
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chronocoiffure`
--

-- --------------------------------------------------------

--
-- Structure de la table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
CREATE TABLE IF NOT EXISTS `configuration` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nbr_employe` int DEFAULT NULL,
  `nom_employe` varchar(50) DEFAULT NULL,
  `temps_moyen` int DEFAULT NULL,
  `phrase_accroche` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `current`
--

DROP TABLE IF EXISTS `current`;
CREATE TABLE IF NOT EXISTS `current` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nbr_disponible` int DEFAULT NULL,
  `nbr_occupe` int DEFAULT NULL,
  `tps_attente` int DEFAULT NULL,
  `nbr_clients` int DEFAULT NULL,
  `buffer` int DEFAULT NULL,
  `id_mod` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `current`
--

INSERT INTO `current` (`id`, `nbr_disponible`, `nbr_occupe`, `tps_attente`, `nbr_clients`, `buffer`, `id_mod`) VALUES
(1, 1, 1, 0, 0, NULL, ''),
(2, NULL, NULL, NULL, NULL, NULL, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
