-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 13 sep. 2023 à 18:55
-- Version du serveur : 5.7.14
-- Version de PHP : 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stage_formation1`
--

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE `tache` (
  `id` int(11) NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `db` date NOT NULL,
  `df` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`id`, `type`, `description`, `db`, `df`, `user_id`) VALUES
(1, 'Professionel', 'Apprendre ReactJS', '2023-09-23', '2023-10-23', 1),
(2, 'Professionel', 'Apprendre Sql', '2023-09-24', '2023-09-30', 1),
(3, 'Loisir', 'Boite de Nuit', '2023-09-17', '2023-09-18', 1),
(4, 'Professionel', 'Apprendre PHP', '2023-09-14', '2023-09-29', 2),
(5, 'Professionel', 'Apprendre NODEJS', '2023-11-17', '2023-11-24', 2),
(6, 'Loisir', 'Boite de nuit', '2023-09-17', '2023-09-17', 2),
(7, 'Domestique', 'Lessive', '2023-09-17', '2023-09-17', 2),
(8, 'Domestique', 'Nettoyage Chambre', '2023-09-22', '2023-09-22', 2),
(9, 'Professionel', 'Apprendre Javascript', '2023-09-30', '2023-10-30', 2),
(10, 'Domestique', 'Nettoyage Souliers', '2023-09-15', '2023-09-30', 2),
(11, 'Domestique', 'Nettoyage Vehicule', '2023-09-14', '2023-09-15', 2),
(12, 'Loisir', 'Salle de Sport', '2023-09-22', '2023-09-22', 2),
(13, 'Professionel', 'Apprendre VueJS', '2023-09-15', '2023-09-22', 2),
(14, 'Loisir', 'Sortir', '2023-09-14', '2023-09-14', 2);

-- --------------------------------------------------------

--
-- Structure de la table `toto_user`
--

CREATE TABLE `toto_user` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `profil` text COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `toto_user`
--

INSERT INTO `toto_user` (`id`, `nom`, `prenom`, `email`, `profil`, `pass`) VALUES
(1, 'Jules', 'Conde', 'conde@yopmail.com', 'Standard', '$2y$10$0kuDJVE3fbBvLKKf4N8WPupFIIWyNVFsqDWfcE0U6F7tZv5JMukxW'),
(2, 'Michel', 'Jojo', 'jojo@yopmail.com', 'Premium', '$2y$10$SGinYRfS0fpW.9rWDQN4nekVc3iKRrMQZehYprjCv2VbwFUzm/bQO');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tache`
--
ALTER TABLE `tache`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `toto_user`
--
ALTER TABLE `toto_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tache`
--
ALTER TABLE `tache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `toto_user`
--
ALTER TABLE `toto_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
