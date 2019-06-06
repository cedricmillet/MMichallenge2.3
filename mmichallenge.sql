-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 06 juin 2019 à 09:56
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mmichallenge`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(255) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL DEFAULT '[EMAIL]',
  `mdp` varchar(300) NOT NULL DEFAULT '[PASSWORD]',
  `pseudo` varchar(50) NOT NULL DEFAULT '[PRENOM]',
  `question` int(11) NOT NULL DEFAULT '1',
  `api_key` varchar(50) NOT NULL DEFAULT 'Hzahndnsn45sqd1sdq12',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`userid`, `email`, `mdp`, `pseudo`, `question`, `api_key`) VALUES
(1, 'cyrion@gmail.com', 'aTq5EQT8Q2BRcMJiYot__b6cf644de2633b571dedf4ffd6220b097e60a22ea32931c7739d3453bcc2534e', 'cyrion', 1, 'H48512145sqd1sdq12'),
(2, 'demo@demo.com', 'aTq5EQT8Q2BRcMJiYot__2a97516c354b68848cdbd8f54a226a0a55b21ed138e207ad6c5cbb9c00aa5aea', 'demo', 4, 'Hzahndnsn45sqd1sdq12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
