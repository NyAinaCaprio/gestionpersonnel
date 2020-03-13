-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 09 mars 2020 à 08:10
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dia1`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie_civil`
--

DROP TABLE IF EXISTS `categorie_civil`;
CREATE TABLE IF NOT EXISTS `categorie_civil` (
  `id_categorie_civil` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_civil` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_categorie_civil`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie_civil`
--

INSERT INTO `categorie_civil` (`id_categorie_civil`, `categorie_civil`) VALUES
(2, 'ECD'),
(3, 'EFA'),
(4, 'FONCTIONNAIRE');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
