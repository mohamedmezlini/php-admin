-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 28 jan. 2024 à 00:45
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_club`
--

-- --------------------------------------------------------

--
-- Structure de la table `adherents`
--

CREATE TABLE `adherents` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'adherent',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `adherents`
--

INSERT INTO `adherents` (`id`, `fname`, `lname`, `email`, `phone`, `ville`, `password`, `role`, `avatar`) VALUES
(1, 'ad1', '&d2', 'ad3@daldoul.com', '1324654', 'ezezezez', '$2y$10$YaZMOanw.bdsMQHKGQWs9.K//UTvD9ZxFtlKPzXbfKWvAFQ3g1RrK', 'adherent', 'avatar.png'),
(7, 'Adherent', 'Two', 'adherent@two.com', '21653842756', 'ville 1', '$2y$10$Gm8rjHKAIWKqJszM77XA2.1KgGHgDQap.hqcVb8DmITigFHe7IHTa', 'adherent', 'avatar.png'),
(8, 'Adherent', 'Three', 'adherent@three.com', '0170000000', 'ville 1', '$2y$10$RqNzWY0cxl9UCf01J.N9LOTTPb7GKarWAwM7/i8T8koNoFqQQk1Li', 'adherent', 'avatar.png'),
(9, 'Adherent', 'Four', 'adherent@four.com', '21653842756', 'ville 1', '$2y$10$GVggPVg5obYkaX87nzDA/u7uyMA.ej4A96RNXtLXpFWeENLxed.T6', 'adherent', 'avatar.png'),
(10, 'Adherent', 'Five', 'adherent@five.com', '21653842756', 'ville 1', '$2y$10$It21v0CAlfE8vMM4BN2hIukLIiR/RFBWvRdN3PirzkW6.r28Ls0AW', 'adherent', 'avatar.png');

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'admin',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `fname`, `lname`, `email`, `phone`, `ville`, `password`, `role`, `avatar`) VALUES
(2, 'Admin', 'admin', 'admin@admin.com', '21653842756', 'ville admin', '$2y$10$Gm8rjHKAIWKqJszM77XA2.1KgGHgDQap.hqcVb8DmITigFHe7IHTa', 'admin', 'images.png');

-- --------------------------------------------------------

--
-- Structure de la table `moniteurs`
--

CREATE TABLE `moniteurs` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'moniteur',
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `moniteurs`
--

INSERT INTO `moniteurs` (`id`, `fname`, `lname`, `email`, `phone`, `ville`, `password`, `role`, `avatar`) VALUES
(1, 'm1', 'm1', 'admin1@admin.com', '1111111', 'm1', '$2y$10$irlsc.Z..vv7c1KgX2BISOuvkGDlRZa8BXW3.mZpG5RHPHwjR1Bzu', 'moniteur', 'avatar.png'),
(6, 'Ahmed', 'Daldoul', 'ahmed@daldoul.com', '21653842756', 'ville Ahmed', '$2y$10$Gm8rjHKAIWKqJszM77XA2.1KgGHgDQap.hqcVb8DmITigFHe7IHTa', 'moniteur', 'avatar.png'),
(7, 'Amina', 'Daldoul', 'amina@daldoul.com', '21653842756', 'ville Amina1', '$2y$10$Gm8rjHKAIWKqJszM77XA2.1KgGHgDQap.hqcVb8DmITigFHe7IHTa', 'moniteur', 'avatar.png'),
(8, 'm11', 'm11', 'admin11@admin.com', '111111', 'm1111', '$2y$10$fada418IbgWNcD1iygpdP.LDN8enLQJC0K6/BbrDG64Iz2xhbMxZ.', 'moniteur', 'avatar.png');

-- --------------------------------------------------------

--
-- Structure de la table `seances`
--

CREATE TABLE `seances` (
  `id` int(11) NOT NULL,
  `idM` int(11) NOT NULL,
  `idA` int(11) NOT NULL,
  `dateS` date NOT NULL,
  `heureS` time NOT NULL,
  `nbHeures` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `seances`
--

INSERT INTO `seances` (`id`, `idM`, `idA`, `dateS`, `heureS`, `nbHeures`) VALUES
(7, 6, 10, '2024-02-01', '15:06:00', 15),
(8, 7, 9, '2024-01-25', '14:30:00', 1),
(9, 7, 7, '2024-01-26', '11:45:00', 5),
(10, 6, 10, '2024-01-28', '01:13:00', 2),
(11, 7, 10, '2024-06-09', '01:15:00', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adherents`
--
ALTER TABLE `adherents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `moniteurs`
--
ALTER TABLE `moniteurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `seances`
--
ALTER TABLE `seances`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adherents`
--
ALTER TABLE `adherents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `moniteurs`
--
ALTER TABLE `moniteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `seances`
--
ALTER TABLE `seances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
