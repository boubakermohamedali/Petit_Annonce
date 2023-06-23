-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20230323.7514e75794
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : Jeu. 22 Juin 2023 à 09:21
-- Version du serveur : 8.0.30
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bateaux_pirates`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonces`
--

CREATE TABLE `annonces` (
  `id_annonce` int NOT NULL,
  `date_vente` date NOT NULL,
  `cont_annonce` varchar(50) NOT NULL,
  `Titre` varchar(150) NOT NULL,
  `Prix_vente` double NOT NULL,
  `Date_validation` date NOT NULL,
  `description_annonces` varchar(100) NOT NULL,
  `date_creation` date NOT NULL,
  `duree_publication` varchar(50) DEFAULT NULL,
  `date_fin_publication` date NOT NULL,
  `id_membre` int DEFAULT NULL,
  `id_etat` int NOT NULL,
  `id_membre_1` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

CREATE TABLE `appartient` (
  `id_annonce` int NOT NULL,
  `id_categorie` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int NOT NULL,
  `nom_categorie` varchar(45) NOT NULL,
  `description_categorie` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `etats`
--

CREATE TABLE `etats` (
  `id_etat` int NOT NULL,
  `Nom_etat` varchar(450) NOT NULL,
  `description_etat` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `id_membre` int NOT NULL,
  `telephone` int NOT NULL,
  `url_photo_profil` varchar(150) NOT NULL,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(150) NOT NULL,
  `prenom` varchar(150) NOT NULL,
  `token` varchar(50) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `hash` varchar(150) NOT NULL,
  `adresse_postale` varchar(100) NOT NULL,
  `ville` varchar(150) DEFAULT NULL,
  `code_postal` varchar(150) NOT NULL,
  `solde_cagnotte` int NOT NULL,
  `date_validation_token` date NOT NULL,
  `date_description` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id_membre`, `telephone`, `url_photo_profil`, `nom`, `email`, `prenom`, `token`, `user_name`, `hash`, `adresse_postale`, `ville`, `code_postal`, `solde_cagnotte`, `date_validation_token`, `date_description`) VALUES
(12, 493021512, 'https://www.shutterstock.com', 'shunter stock', 'shunterstock@mail.fr', 'Huty', 'pop', 'lok', 'courte06', 'avenue de Grasse', 'Cannes', '06400', 20, '2023-05-16', '2023-05-18');

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id_photo` int NOT NULL,
  `url_photo` varchar(50) NOT NULL,
  `is_main_photo` varchar(50) NOT NULL,
  `legende` varchar(50) NOT NULL,
  `id_annonce` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `transactions_bancaires`
--

CREATE TABLE `transactions_bancaires` (
  `id_transaction` int NOT NULL,
  `num_opperation` varchar(150) NOT NULL,
  `Somme` int NOT NULL,
  `Date_transaction` date NOT NULL,
  `id_membre` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD PRIMARY KEY (`id_annonce`,`id_categorie`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `etats`
--
ALTER TABLE `etats`
  ADD PRIMARY KEY (`id_etat`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id_membre`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id_photo`),
  ADD KEY `id_annonce` (`id_annonce`);

--
-- Index pour la table `transactions_bancaires`
--
ALTER TABLE `transactions_bancaires`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD CONSTRAINT `appartient_ibfk_1` FOREIGN KEY (`id_annonce`) REFERENCES `bateau_pirate`.`annonces` (`id_annonce`),
  ADD CONSTRAINT `appartient_ibfk_2` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`);

--
-- Contraintes pour la table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`id_annonce`) REFERENCES `bateau_pirate`.`annonces` (`id_annonce`);

--
-- Contraintes pour la table `transactions_bancaires`
--
ALTER TABLE `transactions_bancaires`
  ADD CONSTRAINT `transactions_bancaires_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id_membre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
