-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 08 nov. 2023 à 07:55
-- Version du serveur :  8.0.32
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_nickname`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_section`
--

CREATE TABLE `t_section` (
  `idSection` int NOT NULL,
  `secName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `t_section`
--

INSERT INTO `t_section` (`idSection`, `secName`) VALUES
(1, 'Informatique'),
(2, 'Bois'),
(3, 'Automobile'),
(4, 'Polymécanique'),
(5, 'Electronique'),
(6, 'Automatique');

-- --------------------------------------------------------

--
-- Structure de la table `t_teacher`
--

CREATE TABLE `t_teacher` (
  `idTeacher` int NOT NULL,
  `teaFirstname` varchar(50) NOT NULL,
  `teaName` varchar(50) NOT NULL,
  `teaGender` char(1) NOT NULL,
  `teaNickname` varchar(50) NOT NULL,
  `teaOrigine` text NOT NULL,
  `fkSection` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `t_teacher`
--

INSERT INTO `t_teacher` (`idTeacher`, `teaFirstname`, `teaName`, `teaGender`, `teaNickname`, `teaOrigine`, `fkSection`) VALUES
(1, 'Gregory', 'Charmier', 'M', 'GregLeBarbar', 'Surnom de jeux d\'échec en ligne', 1),
(2, 'Antoine', 'Mveng', 'M', 'AMG', 'Contraction de la 1ère lettre du prénom et de la 1ère + dernière du nom de famille', 1),
(3, 'Alain', 'Girardet', 'M', 'AGT', 'Contraction de la 1ère lettre du prénom et de la 1ère + dernière du nom de famille', 1),
(4, 'Bertrand', 'Sahli', 'M', 'BSI', 'Contraction de la 1ère lettre du prénom et de la 1ère + dernière du nom de famille', 1),
(5, 'Aurélie', 'Curchod', 'F', 'ACD', 'Contraction de la 1ère lettre du prénom et de la 1ère + dernière du nom de famille', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `idUser` int NOT NULL,
  `useLogin` varchar(20) NOT NULL,
  `usePassword` varchar(255) NOT NULL,
  `useAdministrator` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_section`
--
ALTER TABLE `t_section`
  ADD PRIMARY KEY (`idSection`);

--
-- Index pour la table `t_teacher`
--
ALTER TABLE `t_teacher`
  ADD PRIMARY KEY (`idTeacher`),
  ADD KEY `fkSection` (`fkSection`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_section`
--
ALTER TABLE `t_section`
  MODIFY `idSection` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `t_teacher`
--
ALTER TABLE `t_teacher`
  MODIFY `idTeacher` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_teacher`
--
ALTER TABLE `t_teacher`
  ADD CONSTRAINT `t_teacher_ibfk_1` FOREIGN KEY (`fkSection`) REFERENCES `t_section` (`idSection`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
