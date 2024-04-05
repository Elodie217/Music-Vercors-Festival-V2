-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 04 avr. 2024 à 12:34
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mvfv2`
--

-- --------------------------------------------------------

--
-- Structure de la table `mvf_nuit`
--

DROP TABLE IF EXISTS `mvf_nuit`;
CREATE TABLE IF NOT EXISTS `mvf_nuit` (
  `Id_nuit` int NOT NULL AUTO_INCREMENT,
  `Prix_nuit` int DEFAULT NULL,
  `Type_nuit` varchar(255) DEFAULT NULL,
  `Date_nuit` date DEFAULT NULL,
  PRIMARY KEY (`Id_nuit`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `mvf_nuit`
--

INSERT INTO `mvf_nuit` (`Id_nuit`, `Prix_nuit`, `Type_nuit`, `Date_nuit`) VALUES
(1, 5, '1 nuit tente', '2024-07-01'),
(2, 12, '3 nuits tente', '2024-07-01'),
(3, 5, '1 nuit camion', '2024-07-01'),
(4, 12, '3 nuits camion', '2024-07-01'),
(5, 5, '1 nuit tente', '2024-07-02'),
(6, 5, '1 nuit tente', '2024-07-03'),
(7, 5, '1 nuit camion', '2024-07-02'),
(8, 5, '1 nuit camion', '2024-07-03');

-- --------------------------------------------------------

--
-- Structure de la table `mvf_nuitreservation`
--

DROP TABLE IF EXISTS `mvf_nuitreservation`;
CREATE TABLE IF NOT EXISTS `mvf_nuitreservation` (
  `Id_reservation` int NOT NULL,
  `Id_nuit` int NOT NULL,
  PRIMARY KEY (`Id_reservation`,`Id_nuit`),
  KEY `NuitReservation_nuit0_FK` (`Id_nuit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `mvf_nuitreservation`
--

INSERT INTO `mvf_nuitreservation` (`Id_reservation`, `Id_nuit`) VALUES
(1, 2),
(1, 3),
(3, 7),
(3, 8);

-- --------------------------------------------------------

--
-- Structure de la table `mvf_pass`
--

DROP TABLE IF EXISTS `mvf_pass`;
CREATE TABLE IF NOT EXISTS `mvf_pass` (
  `Id_pass` int NOT NULL AUTO_INCREMENT,
  `Prix_pass` int DEFAULT NULL,
  `Pass_pass` varchar(255) DEFAULT NULL,
  `Date_pass` date DEFAULT NULL,
  `TarifReduit_pass` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id_pass`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `mvf_pass`
--

INSERT INTO `mvf_pass` (`Id_pass`, `Prix_pass`, `Pass_pass`, `Date_pass`, `TarifReduit_pass`) VALUES
(1, 40, 'Pass 1 jour', '2024-07-01', 0),
(2, 40, 'Pass 1 jour', '2024-07-02', 0),
(3, 40, 'Pass 1 jour', '2024-07-03', 0),
(4, 70, 'Pass 2 jours', '2024-07-01', 0),
(5, 70, 'Pass 2 jours', '2024-07-02', 0),
(6, 100, 'Pass 3 jours', '2024-07-01', 0),
(7, 25, 'Pass 1 jour', '2024-07-01', 1),
(8, 25, 'Pass 1 jour', '2024-07-02', 1),
(9, 25, 'Pass 1 jour', '2024-07-03', 1),
(10, 50, 'Pass 2 jours', '2024-07-01', 1),
(11, 50, 'Pass 2 jours', '2024-07-02', 1),
(12, 65, 'Pass 3 jours', '2024-07-01', 1);

-- --------------------------------------------------------

--
-- Structure de la table `mvf_reservation`
--

DROP TABLE IF EXISTS `mvf_reservation`;
CREATE TABLE IF NOT EXISTS `mvf_reservation` (
  `Id_reservation` int NOT NULL AUTO_INCREMENT,
  `Nombre_reservation` int DEFAULT NULL,
  `Enfants_reservation` tinyint(1) DEFAULT NULL,
  `NombreCasque_reservation` int NOT NULL,
  `NombreLuge_reservation` int DEFAULT NULL,
  `PrixTotal_reservation` int DEFAULT NULL,
  `Id_user` int NOT NULL,
  `Id_Pass` int NOT NULL,
  PRIMARY KEY (`Id_reservation`),
  KEY `reservation_user_FK` (`Id_user`),
  KEY `Id_Pass` (`Id_Pass`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `mvf_reservation`
--

INSERT INTO `mvf_reservation` (`Id_reservation`, `Nombre_reservation`, `Enfants_reservation`, `NombreCasque_reservation`, `NombreLuge_reservation`, `PrixTotal_reservation`, `Id_user`, `Id_Pass`) VALUES
(1, 1, 1, 2, 1, 62, 1, 8),
(3, 3, 4, 1, 2, 150, 1, 12);

-- --------------------------------------------------------

--
-- Structure de la table `mvf_user`
--

DROP TABLE IF EXISTS `mvf_user`;
CREATE TABLE IF NOT EXISTS `mvf_user` (
  `Id_user` int NOT NULL AUTO_INCREMENT,
  `Nom_user` varchar(255) DEFAULT NULL,
  `Prenom_user` varchar(255) DEFAULT NULL,
  `Email_user` varchar(255) DEFAULT NULL,
  `Telephone_user` int DEFAULT NULL,
  `AdressePostale_user` varchar(255) DEFAULT NULL,
  `MotDePasse_user` varchar(255) DEFAULT NULL,
  `Role_user` tinyint(1) DEFAULT NULL,
  `DateRGPD` date NOT NULL,
  PRIMARY KEY (`Id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `mvf_user`
--

INSERT INTO `mvf_user` (`Id_user`, `Nom_user`, `Prenom_user`, `Email_user`, `Telephone_user`, `AdressePostale_user`, `MotDePasse_user`, `Role_user`, `DateRGPD`) VALUES
(1, 'Gri', 'Elodie', 'elodie@free.fr', 123456789, '3 rue vh', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', NULL, '0000-00-00'),
(3, 'Grienay', 'Elodie', 'test2@free.fr', 123456789, '5 rue là bas', 'fd9d94340dbd72c11b37ebb0d2a19b4d05e00fd78e4e2ce8923b9ea3a54e900df181cfb112a8a73228d1f3551680e2ad9701a4fcfb248fa7fa77b95180628bb2', NULL, '0000-00-00'),
(4, 'Admin', 'Admin', 'admin@admin.com', 123456789, 'Ici', '6A4E012BD9583858A5A6FA15F58BD86A25AF266D3A4344F1EC2018B778F29BA83BE86EB45E6DC204E11276F4A99EFF4E2144FBE15E756C2C88E999649AAE7D94', 1, '2024-04-25');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `mvf_nuitreservation`
--
ALTER TABLE `mvf_nuitreservation`
  ADD CONSTRAINT `NuitReservation_nuit0_FK` FOREIGN KEY (`Id_nuit`) REFERENCES `mvf_nuit` (`Id_nuit`),
  ADD CONSTRAINT `NuitReservation_reservation_FK` FOREIGN KEY (`Id_reservation`) REFERENCES `mvf_reservation` (`Id_reservation`);

--
-- Contraintes pour la table `mvf_reservation`
--
ALTER TABLE `mvf_reservation`
  ADD CONSTRAINT `mvf_reservation_ibfk_1` FOREIGN KEY (`Id_Pass`) REFERENCES `mvf_pass` (`Id_pass`),
  ADD CONSTRAINT `reservation_user_FK` FOREIGN KEY (`Id_user`) REFERENCES `mvf_user` (`Id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
