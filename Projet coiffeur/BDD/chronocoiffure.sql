-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 11 fév. 2022 à 13:35
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
  `id_emp` varchar(8) DEFAULT NULL,
  `nom_employe` varchar(50) DEFAULT NULL,
  `tps_moyen` int DEFAULT NULL,
  `phrase_accroche` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Temps d''attente estimé :',
  `id_mod` int DEFAULT NULL,
  `nom_mod` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `jour` varchar(30) DEFAULT NULL,
  `heure` varchar(255) DEFAULT NULL,
  `list_employe` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tps_prevu` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `configuration`
--

INSERT INTO `configuration` (`id`, `id_emp`, `nom_employe`, `tps_moyen`, `phrase_accroche`, `id_mod`, `nom_mod`, `jour`, `heure`, `list_employe`, `tps_prevu`) VALUES
(56, 'MA5650', 'Maxime', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(1, NULL, NULL, 30, 'Temps d\'attente estimé :', 0, NULL, '0', NULL, NULL, 0),
(57, 'ST6044', 'Steven', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `id_mod` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `current`
--

INSERT INTO `current` (`id`, `nbr_disponible`, `nbr_occupe`, `tps_attente`, `nbr_clients`, `buffer`, `id_mod`, `date`) VALUES
(1, 2, 0, 90, 3, 0, NULL, '2022-02-10');

-- --------------------------------------------------------

--
-- Structure de la table `daily`
--

DROP TABLE IF EXISTS `daily`;
CREATE TABLE IF NOT EXISTS `daily` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `total_clients` int DEFAULT NULL,
  `id_emp` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `stats`
--

DROP TABLE IF EXISTS `stats`;
CREATE TABLE IF NOT EXISTS `stats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `total_clients_traites` int DEFAULT NULL,
  `employes` int DEFAULT NULL,
  `total_clients` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=306 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stats`
--

INSERT INTO `stats` (`id`, `date`, `total_clients_traites`, `employes`, `total_clients`) VALUES
(288, '2022-02-11', 48, 2, 59),
(289, '2022-02-12', 48, 3, 58),
(290, '2022-02-13', 48, 2, 58),
(299, '2022-02-11', 25, 1, 0),
(296, '2022-02-14', 98, 4, 58),
(298, '2022-02-11', 22, 1, 6),
(294, '2022-02-15', 58, 1, 58),
(300, '2022-02-11', 11, 1, 2),
(301, NULL, NULL, 0, 6),
(302, NULL, NULL, 0, 0),
(303, NULL, NULL, 0, 0),
(304, NULL, NULL, 0, 0),
(305, NULL, NULL, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
