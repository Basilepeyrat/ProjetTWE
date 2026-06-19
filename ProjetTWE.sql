-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 19 juin 2026 à 09:37
-- Version du serveur : 9.3.0
-- Version de PHP : 8.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ProjetTWE`
--

-- --------------------------------------------------------

--
-- Structure de la table `AVIS_MATCH`
--

CREATE TABLE `AVIS_MATCH` (
  `user_id` int NOT NULL,
  `match_id` int NOT NULL,
  `vu` tinyint(1) DEFAULT '0',
  `note_match` int DEFAULT NULL,
  `mvp_id` int DEFAULT NULL,
  `present_stade` tinyint(1) DEFAULT '0'
) ;

-- --------------------------------------------------------

--
-- Structure de la table `COMMENTAIRE`
--

CREATE TABLE `COMMENTAIRE` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `match_id` int NOT NULL,
  `contenu` text NOT NULL,
  `date_pub` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `COMMENTAIRE_SIGNALES`
--

CREATE TABLE `COMMENTAIRE_SIGNALES` (
  `commentaire_id` int NOT NULL,
  `nombre_signalements` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `EQUIPE`
--

CREATE TABLE `EQUIPE` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `pays` varchar(100) NOT NULL,
  `poule` varchar(10) DEFAULT NULL,
  `image_drapeau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `INVITATION`
--

CREATE TABLE `INVITATION` (
  `id` int NOT NULL,
  `league_id` int NOT NULL,
  `user_invite_id` int NOT NULL,
  `statut` varchar(20) DEFAULT 'en_attente',
  `date_invitation` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `JOUEUR`
--

CREATE TABLE `JOUEUR` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `equipe_id` int DEFAULT NULL,
  `poste` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `LEAGUE`
--

CREATE TABLE `LEAGUE` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `createur_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `MATCHS`
--

CREATE TABLE `MATCHS` (
  `id` int NOT NULL,
  `date_match` datetime NOT NULL,
  `equipe_dom_id` int DEFAULT NULL,
  `equipe_ext_id` int DEFAULT NULL,
  `score_dom` int DEFAULT '0',
  `score_ext` int DEFAULT '0',
  `mvpfifa_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `MEMBRE_LEAGUE`
--

CREATE TABLE `MEMBRE_LEAGUE` (
  `user_id` int NOT NULL,
  `league_id` int NOT NULL,
  `date_adhesion` date DEFAULT (curdate())
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `MESSAGE_CHAT`
--

CREATE TABLE `MESSAGE_CHAT` (
  `id` int NOT NULL,
  `league_id` int NOT NULL,
  `user_id` int NOT NULL,
  `contenu` text NOT NULL,
  `date_envoi` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `UTILISATEUR`
--

CREATE TABLE `UTILISATEUR` (
  `id` int NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `equipe_pref_id` int DEFAULT NULL,
  `joueur_pref_id` int DEFAULT NULL,
  `pdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `AVIS_MATCH`
--
ALTER TABLE `AVIS_MATCH`
  ADD PRIMARY KEY (`user_id`,`match_id`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `mvp_id` (`mvp_id`);

--
-- Index pour la table `COMMENTAIRE`
--
ALTER TABLE `COMMENTAIRE`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `match_id` (`match_id`);

--
-- Index pour la table `COMMENTAIRE_SIGNALES`
--
ALTER TABLE `COMMENTAIRE_SIGNALES`
  ADD PRIMARY KEY (`commentaire_id`);

--
-- Index pour la table `EQUIPE`
--
ALTER TABLE `EQUIPE`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `INVITATION`
--
ALTER TABLE `INVITATION`
  ADD PRIMARY KEY (`id`),
  ADD KEY `league_id` (`league_id`),
  ADD KEY `user_invite_id` (`user_invite_id`);

--
-- Index pour la table `JOUEUR`
--
ALTER TABLE `JOUEUR`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipe_id` (`equipe_id`);

--
-- Index pour la table `LEAGUE`
--
ALTER TABLE `LEAGUE`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createur_id` (`createur_id`);

--
-- Index pour la table `MATCHS`
--
ALTER TABLE `MATCHS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipe_dom_id` (`equipe_dom_id`),
  ADD KEY `equipe_ext_id` (`equipe_ext_id`);

--
-- Index pour la table `MEMBRE_LEAGUE`
--
ALTER TABLE `MEMBRE_LEAGUE`
  ADD PRIMARY KEY (`user_id`,`league_id`),
  ADD KEY `league_id` (`league_id`);

--
-- Index pour la table `MESSAGE_CHAT`
--
ALTER TABLE `MESSAGE_CHAT`
  ADD PRIMARY KEY (`id`),
  ADD KEY `league_id` (`league_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD KEY `equipe_pref_id` (`equipe_pref_id`),
  ADD KEY `joueur_pref_id` (`joueur_pref_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `COMMENTAIRE`
--
ALTER TABLE `COMMENTAIRE`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `EQUIPE`
--
ALTER TABLE `EQUIPE`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `INVITATION`
--
ALTER TABLE `INVITATION`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `JOUEUR`
--
ALTER TABLE `JOUEUR`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `LEAGUE`
--
ALTER TABLE `LEAGUE`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `MATCHS`
--
ALTER TABLE `MATCHS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `MESSAGE_CHAT`
--
ALTER TABLE `MESSAGE_CHAT`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `AVIS_MATCH`
--
ALTER TABLE `AVIS_MATCH`
  ADD CONSTRAINT `avis_match_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `UTILISATEUR` (`id`),
  ADD CONSTRAINT `avis_match_ibfk_2` FOREIGN KEY (`match_id`) REFERENCES `MATCHS` (`id`),
  ADD CONSTRAINT `avis_match_ibfk_3` FOREIGN KEY (`mvp_id`) REFERENCES `JOUEUR` (`id`);

--
-- Contraintes pour la table `COMMENTAIRE`
--
ALTER TABLE `COMMENTAIRE`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `UTILISATEUR` (`id`),
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`match_id`) REFERENCES `MATCHS` (`id`),
  ADD CONSTRAINT `commentaire_ibfk_3` FOREIGN KEY (`id`) REFERENCES `COMMENTAIRE_SIGNALES` (`commentaire_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `INVITATION`
--
ALTER TABLE `INVITATION`
  ADD CONSTRAINT `invitation_ibfk_1` FOREIGN KEY (`league_id`) REFERENCES `LEAGUE` (`id`),
  ADD CONSTRAINT `invitation_ibfk_2` FOREIGN KEY (`user_invite_id`) REFERENCES `UTILISATEUR` (`id`);

--
-- Contraintes pour la table `JOUEUR`
--
ALTER TABLE `JOUEUR`
  ADD CONSTRAINT `joueur_ibfk_1` FOREIGN KEY (`equipe_id`) REFERENCES `EQUIPE` (`id`);

--
-- Contraintes pour la table `LEAGUE`
--
ALTER TABLE `LEAGUE`
  ADD CONSTRAINT `league_ibfk_1` FOREIGN KEY (`createur_id`) REFERENCES `UTILISATEUR` (`id`);

--
-- Contraintes pour la table `MATCHS`
--
ALTER TABLE `MATCHS`
  ADD CONSTRAINT `matchs_ibfk_1` FOREIGN KEY (`equipe_dom_id`) REFERENCES `EQUIPE` (`id`),
  ADD CONSTRAINT `matchs_ibfk_2` FOREIGN KEY (`equipe_ext_id`) REFERENCES `EQUIPE` (`id`);

--
-- Contraintes pour la table `MEMBRE_LEAGUE`
--
ALTER TABLE `MEMBRE_LEAGUE`
  ADD CONSTRAINT `membre_league_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `UTILISATEUR` (`id`),
  ADD CONSTRAINT `membre_league_ibfk_2` FOREIGN KEY (`league_id`) REFERENCES `LEAGUE` (`id`);

--
-- Contraintes pour la table `MESSAGE_CHAT`
--
ALTER TABLE `MESSAGE_CHAT`
  ADD CONSTRAINT `message_chat_ibfk_1` FOREIGN KEY (`league_id`) REFERENCES `LEAGUE` (`id`),
  ADD CONSTRAINT `message_chat_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `UTILISATEUR` (`id`),
  ADD CONSTRAINT `message_chat_ibfk_3` FOREIGN KEY (`id`) REFERENCES `CHAT_SIGNALES` (`chat_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`equipe_pref_id`) REFERENCES `EQUIPE` (`id`),
  ADD CONSTRAINT `utilisateur_ibfk_2` FOREIGN KEY (`joueur_pref_id`) REFERENCES `JOUEUR` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
