-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 26 mars 2024 à 14:30
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `musicvercorsfestivalv2`
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
  PRIMARY KEY (`Id_nuit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mvf_nuitreservation`
--

DROP TABLE IF EXISTS `mvf_nuitreservation`;
CREATE TABLE IF NOT EXISTS `mvf_nuitreservation` (
  `Id_reservation` int NOT NULL,
  `Id_nuit` int NOT NULL,
  `Date_nuitreservation` date DEFAULT NULL,
  PRIMARY KEY (`Id_reservation`,`Id_nuit`),
  KEY `NuitReservation_nuit0_FK` (`Id_nuit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`Id_reservation`),
  KEY `reservation_user_FK` (`Id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mvf_reservationpass`
--

DROP TABLE IF EXISTS `mvf_reservationpass`;
CREATE TABLE IF NOT EXISTS `mvf_reservationpass` (
  `Id_reservation` int NOT NULL,
  `Id_pass` int NOT NULL,
  PRIMARY KEY (`Id_reservation`,`Id_pass`),
  KEY `reservationPass_pass0_FK` (`Id_pass`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  ADD CONSTRAINT `reservation_user_FK` FOREIGN KEY (`Id_user`) REFERENCES `mvf_user` (`Id_user`);

--
-- Contraintes pour la table `mvf_reservationpass`
--
ALTER TABLE `mvf_reservationpass`
  ADD CONSTRAINT `reservationPass_pass0_FK` FOREIGN KEY (`Id_pass`) REFERENCES `mvf_pass` (`Id_pass`),
  ADD CONSTRAINT `reservationPass_reservation_FK` FOREIGN KEY (`Id_reservation`) REFERENCES `mvf_reservation` (`Id_reservation`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
