-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 26 juin 2026 à 17:56
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
  `note_match` int DEFAULT NULL,
  `mvp_id` int DEFAULT NULL,
  `vu_ou` enum('stade','maison','bar') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `AVIS_MATCH`
--

INSERT INTO `AVIS_MATCH` (`user_id`, `match_id`, `note_match`, `mvp_id`, `vu_ou`) VALUES
(1, 60, 8, 1130, 'maison'),
(2, 55, 10, 315, 'maison'),
(2, 59, 2, 624, 'bar');

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

--
-- Déchargement des données de la table `EQUIPE`
--

INSERT INTO `EQUIPE` (`id`, `nom`, `pays`, `poule`, `image_drapeau`) VALUES
(1, 'Mexique', 'MEX', 'A', 'Mexique.svg'),
(2, 'Afrique du Sud', 'RSA', 'A', 'Afrique_du_Sud.svg'),
(3, 'Corée du Sud', 'KOR', 'A', 'Corée_du_Sud.svg'),
(4, 'Tchéquie', 'CZE', 'A', 'Tchéquie.svg'),
(5, 'Canada', 'CAN', 'B', 'Canada.svg'),
(6, 'Bosnie-Herzégovine', 'BIH', 'B', 'Bosnie-Herzégovine.svg'),
(7, 'Qatar', 'QAT', 'B', 'Qatar.svg'),
(8, 'Suisse', 'SUI', 'B', 'Suisse.svg'),
(9, 'Brésil', 'BRA', 'C', 'Brésil.svg'),
(10, 'Maroc', 'MAR', 'C', 'Maroc.svg'),
(11, 'Haïti', 'HAI', 'C', 'Haïti.svg'),
(12, 'Écosse', 'SCO', 'C', 'Écosse.svg'),
(13, 'États-Unis', 'USA', 'D', 'États-Unis.svg'),
(14, 'Paraguay', 'PAR', 'D', 'Paraguay.svg'),
(15, 'Australie', 'AUS', 'D', 'Australie.svg'),
(16, 'Turquie', 'TUR', 'D', 'Turquie.svg'),
(17, 'Allemagne', 'GER', 'E', 'Allemagne.svg'),
(18, 'Curaçao', 'CUW', 'E', 'Curaçao.svg'),
(19, 'Côte d\'Ivoire', 'CIV', 'E', 'Côte_d\'Ivoire.svg'),
(20, 'Équateur', 'ECU', 'E', 'Équateur.svg'),
(21, 'Pays-Bas', 'NED', 'F', 'Pays-Bas.svg'),
(22, 'Japon', 'JPN', 'F', 'Japon.svg'),
(23, 'Suède', 'SWE', 'F', 'Suède.svg'),
(24, 'Tunisie', 'TUN', 'F', 'Tunisie.svg'),
(25, 'Belgique', 'BEL', 'G', 'Belgique.svg'),
(26, 'Égypte', 'EGY', 'G', 'Égypte.svg'),
(27, 'Iran', 'IRN', 'G', 'Iran.svg'),
(28, 'Nouvelle-Zélande', 'NZL', 'G', 'Nouvelle-Zélande.svg'),
(29, 'Espagne', 'ESP', 'H', 'Espagne.svg'),
(30, 'Cap-Vert', 'CPV', 'H', 'Cap-Vert.svg'),
(31, 'Arabie saoudite', 'KSA', 'H', 'Arabie_saoudite.svg'),
(32, 'Uruguay', 'URU', 'H', 'Uruguay.svg'),
(33, 'France', 'FRA', 'I', 'France.svg'),
(34, 'Sénégal', 'SEN', 'I', 'Sénégal.svg'),
(35, 'Irak', 'IRQ', 'I', 'Irak.svg'),
(36, 'Norvège', 'NOR', 'I', 'Norvège.svg'),
(37, 'Argentine', 'ARG', 'J', 'Argentine.svg'),
(38, 'Algérie', 'ALG', 'J', 'Algérie.svg'),
(39, 'Autriche', 'AUT', 'J', 'Autriche.svg'),
(40, 'Jordanie', 'JOR', 'J', 'Jordanie.svg'),
(41, 'Portugal', 'POR', 'K', 'Portugal.svg'),
(42, 'République démocratique du Congo', 'COD', 'K', 'République_démocratique_du_Congo.svg'),
(43, 'Ouzbékistan', 'UZB', 'K', 'Ouzbékistan.svg'),
(44, 'Colombie', 'COL', 'K', 'Colombie.svg'),
(45, 'Angleterre', 'ENG', 'L', 'Angleterre.svg'),
(46, 'Croatie', 'CRO', 'L', 'Croatie.svg'),
(47, 'Ghana', 'GHA', 'L', 'Ghana.svg'),
(48, 'Panama', 'PAN', 'L', 'Panama.svg');

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

--
-- Déchargement des données de la table `INVITATION`
--

INSERT INTO `INVITATION` (`id`, `league_id`, `user_invite_id`, `statut`, `date_invitation`) VALUES
(1, 1, 1, 'acceptee', '2026-06-23 21:41:26'),
(2, 6, 1, 'acceptee', '2026-06-23 21:42:07'),
(3, 6, 4, 'refuse', '2026-06-26 09:33:02'),
(4, 1, 4, 'accepte', '2026-06-26 09:59:52'),
(5, 7, 2, 'accepte', '2026-06-26 11:25:39');

-- --------------------------------------------------------

--
-- Structure de la table `JOUEUR`
--

CREATE TABLE `JOUEUR` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `equipe_id` int DEFAULT NULL,
  `poste` varchar(50) DEFAULT NULL,
  `image_joueur` varchar(255) NOT NULL,
  `buts` int NOT NULL DEFAULT '0',
  `passe_dec` int NOT NULL DEFAULT '0',
  `nb_hdm` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `JOUEUR`
--

INSERT INTO `JOUEUR` (`id`, `nom`, `prenom`, `equipe_id`, `poste`, `image_joueur`, `buts`, `passe_dec`, `nb_hdm`) VALUES
(1, 'Abada', 'Achref', 38, 'DF', '1.png', 0, 1, 0),
(2, 'Boulbina', 'Adil', 38, 'FW', '2.png', 0, 0, 0),
(3, 'Gouiri', 'Amine', 38, 'FW', '3.png', 1, 0, 1),
(4, 'Hadj Moussa', 'Anis', 38, 'MF', '4.png', 0, 0, 0),
(5, 'Mandi', 'Aïssa', 38, 'DF', '5.png', 0, 0, 0),
(6, 'Chaïbi', 'Fares', 38, 'MF', '6.png', 0, 0, 0),
(7, 'Ghedjemis', 'Farés', 38, 'FW,MF', '7.png', 0, 0, 0),
(8, 'Boudaoui', 'Hicham', 38, 'MF', '8.png', 0, 0, 0),
(9, 'Aouar', 'Houssem', 38, 'MF', '9.png', 0, 0, 0),
(10, 'Maza', 'Ibrahim', 38, 'MF', '10.png', 0, 0, 0),
(11, 'Hadjam', 'Jaouen', 38, 'DF', '11.png', 0, 0, 0),
(12, 'Zidane', 'Luca', 38, 'GK', '12.png', 0, 0, 0),
(13, 'Mastil', 'Melvin', 38, 'GK', '13.png', 0, 0, 0),
(14, 'Amine Tougai', 'Mohamed', 38, 'DF', '14.png', 0, 0, 0),
(15, 'Amoura', 'Mohamed', 38, 'FW,MF', '15.png', 0, 0, 0),
(16, 'Bentaleb', 'Nabil', 38, 'MF', '16.png', 0, 0, 0),
(17, 'Benbouali', 'Nadhir', 38, 'FW', '17.png', 0, 0, 0),
(18, 'Benbot', 'Oussama', 38, 'GK', '18.png', 0, 0, 0),
(19, 'Belghali', 'Rafik', 38, 'DF', '19.png', 0, 0, 0),
(20, 'Zerrouki', 'Ramiz', 38, 'MF', '20.png', 0, 0, 0),
(21, 'Bensebaini', 'Ramy', 38, 'DF', '21.png', 0, 0, 0),
(22, 'Aït-Nouri', 'Rayan', 38, 'DF', '22.png', 0, 0, 0),
(23, 'Mahrez', 'Riyad', 38, 'FW,MF', '23.png', 0, 0, 0),
(24, 'Chergui', 'Samir', 38, 'DF', '24.png', 0, 0, 0),
(25, 'Titraoui', 'Yassine', 38, 'MF', '25.png', 0, 0, 0),
(26, 'Belaïd', 'Zineddine', 38, 'DF', '26.png', 0, 0, 0),
(27, 'Mac Allister', 'Alexis', 37, 'MF', '27.png', 0, 0, 0),
(28, 'Romero', 'Cristian', 37, 'DF', '28.png', 0, 0, 0),
(29, 'Martínez', 'Emiliano', 37, 'GK', '29.png', 0, 0, 0),
(30, 'Fernández', 'Enzo', 37, 'MF', '30.png', 0, 0, 0),
(31, 'Palacios', 'Exequiel', 37, 'DF,MF', '31.png', 0, 0, 0),
(32, 'Medina', 'Facundo', 37, 'DF', '32.png', 0, 0, 0),
(33, 'López', 'Flaco', 37, 'FW', '33.png', 0, 0, 0),
(34, 'Rulli', 'Gerónimo', 37, 'GK', '34.png', 0, 0, 0),
(35, 'Lo Celso', 'Giovani', 37, 'FW,MF', '35.png', 0, 0, 0),
(36, 'Simeone', 'Giuliano', 37, 'FW,MF', '36.png', 0, 0, 0),
(37, 'Montiel', 'Gonzalo', 37, 'DF', '37.png', 0, 0, 0),
(38, 'Musso', 'Juan', 37, 'GK', '38.png', 0, 0, 0),
(39, 'Álvarez', 'Julián', 37, 'FW,MF', '39.png', 0, 0, 0),
(40, 'Martínez', 'Lautaro', 37, 'FW', '40.png', 0, 0, 0),
(41, 'Paredes', 'Leandro', 37, 'MF', '41.png', 0, 0, 0),
(42, 'Messi', 'Lionel', 37, 'FW', '42.png', 0, 0, 0),
(43, 'Martínez', 'Lisandro', 37, 'DF', '43.png', 0, 0, 0),
(44, 'Senesi', 'Marcos', 37, 'DF', '44.png', 0, 0, 0),
(45, 'Molina', 'Nahuel', 37, 'DF,MF', '45.png', 0, 0, 0),
(46, 'González', 'Nicolás', 37, 'FW,MF', '46.png', 0, 0, 0),
(47, 'Otamendi', 'Nicolás', 37, 'DF', '47.png', 0, 0, 0),
(48, 'Paz', 'Nicolás', 37, 'MF', '48.png', 0, 0, 0),
(49, 'Tagliafico', 'Nicolás', 37, 'DF', '49.png', 0, 0, 0),
(50, 'De Paul', 'Rodrigo', 37, 'MF', '50.png', 0, 0, 0),
(51, 'Almada', 'Thiago', 37, 'MF', '51.png', 0, 0, 0),
(52, 'Barco', 'Valentín', 37, 'DF,MF', '52.png', 0, 0, 0),
(53, 'O\'Neill', 'Aiden', 15, 'MF', '53.png', 0, 0, 0),
(54, 'Hrustic', 'Ajdin', 15, 'MF', '54.png', 0, 0, 0),
(55, 'Circati', 'Alessandro', 15, 'DF', '55.png', 0, 0, 0),
(56, 'Mabil', 'Awer', 15, 'FW,MF', '56.png', 0, 0, 0),
(57, 'Behich', 'Aziz', 15, 'DF,MF', '57.png', 0, 0, 0),
(58, 'Burgess', 'Cameron', 15, 'DF', '58.png', 0, 0, 0),
(59, 'Devlin', 'Cammy', 15, 'MF', '59.png', 0, 0, 0),
(60, 'Metcalfe', 'Connor', 15, 'MF', '60.png', 0, 0, 0),
(61, 'Volpato', 'Cristian', 15, 'MF', '61.png', 0, 0, 0),
(62, 'Souttar', 'Harry', 15, 'DF', '62.png', 0, 0, 0),
(63, 'Irvine', 'Jackson', 15, 'DF,MF', '63.png', 0, 0, 0),
(64, 'Italiano', 'Jacob', 15, 'DF', '64.png', 0, 0, 0),
(65, 'Geria', 'Jason', 15, 'DF', '65.png', 0, 0, 0),
(66, 'Bos', 'Jordy', 15, 'DF', '66.png', 0, 0, 0),
(67, 'Trewin', 'Kai', 15, 'DF,MF', '67.png', 0, 0, 0),
(68, 'Herrington', 'Lucas', 15, 'DF', '68.png', 0, 0, 0),
(69, 'Leckie', 'Mathew', 15, 'MF', '69.png', 0, 0, 0),
(70, 'Ryan', 'Mathew', 15, 'GK', '70.png', 0, 0, 0),
(71, 'Degenek', 'Miloš', 15, 'DF,MF', '71.png', 0, 0, 0),
(72, 'Touré', 'Mo', 15, 'FW', '72.png', 0, 0, 0),
(73, 'Irankunda', 'Nestory', 15, 'MF', '73.png', 0, 0, 0),
(74, 'Velupillay', 'Nishan', 15, 'MF', '74.png', 0, 0, 0),
(75, 'Beach', 'Patrick', 15, 'GK', '75.png', 0, 0, 0),
(76, 'Izzo', 'Paul', 15, 'GK', '76.png', 0, 0, 0),
(77, 'Okon-Engstler', 'Paul', 15, 'MF', '77.png', 0, 0, 0),
(78, 'Yengi', 'Tete', 15, 'FW', '78.png', 0, 0, 0),
(79, 'Schöpf', 'Alessandro', 39, 'MF', '79.png', 0, 0, 0),
(80, 'Prass', 'Alexander', 39, 'DF,MF', '80.png', 0, 0, 0),
(81, 'Schlager', 'Alexander', 39, 'GK', '81.png', 0, 0, 0),
(82, 'Chukwuemeka', 'Carney', 39, 'MF', '82.png', 0, 0, 0),
(83, 'Affengruber', 'David', 39, 'DF', '83.png', 0, 0, 0),
(84, 'Alaba', 'David', 39, 'DF', '84.png', 0, 0, 0),
(85, 'Ljubičić', 'Dejan', 39, 'MF', '85.png', 0, 0, 0),
(86, 'Grillitsch', 'Florian', 39, 'DF,MF', '86.png', 0, 0, 0),
(87, 'Wiegele', 'Florian', 39, 'GK', '87.png', 0, 0, 0),
(88, 'Danso', 'Kevin', 39, 'DF,MF', '88.png', 0, 0, 0),
(89, 'Laimer', 'Konrad', 39, 'MF', '89.png', 0, 0, 0),
(90, 'Sabitzer', 'Marcel', 39, 'MF', '90.png', 0, 0, 0),
(91, 'Friedl', 'Marco', 39, 'DF', '91.png', 0, 0, 0),
(92, 'Arnautović', 'Marko', 39, 'FW,MF', '92.png', 0, 0, 0),
(93, 'Gregoritsch', 'Michael', 39, 'FW,MF', '93.png', 0, 0, 0),
(94, 'Svoboda', 'Michael', 39, 'DF', '94.png', 0, 0, 0),
(95, 'Seiwald', 'Nicolas', 39, 'MF', '95.png', 0, 0, 0),
(96, 'Pentz', 'Patrick', 39, 'GK', '96.png', 0, 0, 0),
(97, 'Wimmer', 'Patrick', 39, 'FW,MF', '97.png', 0, 0, 0),
(98, 'Wanner', 'Paul', 39, 'MF', '98.png', 0, 0, 0),
(99, 'Lienhart', 'Philipp', 39, 'DF', '99.png', 0, 0, 0),
(100, 'Mwene', 'Phillipp', 39, 'DF', '100.png', 0, 0, 0),
(101, 'Schmid', 'Romano', 39, 'MF', '101.png', 0, 0, 0),
(102, 'Kalajdžić', 'Saša', 39, 'FW', '102.png', 0, 0, 0),
(103, 'Posch', 'Stefan', 39, 'DF', '103.png', 0, 0, 0),
(104, 'Schlager', 'Xaver', 39, 'MF', '104.png', 0, 0, 0),
(105, 'Saelemaekers', 'Alexis', 25, 'MF', '105.png', 0, 0, 0),
(106, 'Onana', 'Amadou', 25, 'MF', '106.png', 0, 0, 0),
(107, 'Theate', 'Arthur', 25, 'DF', '107.png', 0, 0, 0),
(108, 'Witsel', 'Axel', 25, 'DF,MF', '108.png', 0, 0, 0),
(109, 'Mechele', 'Brandon', 25, 'DF', '109.png', 0, 0, 0),
(110, 'De Ketelaere', 'Charles', 25, 'FW', '110.png', 0, 0, 0),
(111, 'Moreira', 'Diego', 25, 'MF', '111.png', 0, 0, 0),
(112, 'Lukebakio', 'Dodi', 25, 'FW,MF', '112.png', 0, 0, 0),
(113, 'Vanaken', 'Hans', 25, 'MF', '113.png', 0, 0, 0),
(114, 'Doku', 'Jeremy', 25, 'MF', '114.png', 0, 0, 0),
(115, 'Seys', 'Joaquin', 25, 'DF', '115.png', 0, 0, 0),
(116, 'De Bruyne', 'Kevin', 25, 'MF', '116.png', 0, 0, 0),
(117, 'De Winter', 'Koni', 25, 'DF', '117.png', 0, 0, 0),
(118, 'Trossard', 'Leandro', 25, 'MF', '118.png', 0, 0, 0),
(119, 'Fernandez-Pardo', 'Matias', 25, 'FW,MF', '119.png', 0, 0, 0),
(120, 'De Cuyper', 'Maxim', 25, 'DF', '120.png', 0, 0, 0),
(121, 'Penders', 'Mike', 25, 'GK', '121.png', 0, 0, 0),
(122, 'Ngoy', 'Nathan', 25, 'DF', '122.png', 0, 0, 0),
(123, 'Raskin', 'Nicolas', 25, 'MF', '123.png', 0, 0, 0),
(124, 'Lukaku', 'Romelu', 25, 'FW', '124.png', 0, 0, 0),
(125, 'Lammens', 'Senne', 25, 'GK', '125.png', 0, 0, 0),
(126, 'Courtois', 'Thibaut', 25, 'GK', '126.png', 0, 0, 0),
(127, 'Meunier', 'Thomas', 25, 'DF', '127.png', 0, 0, 0),
(128, 'Castagne', 'Timothy', 25, 'DF', '128.png', 0, 0, 0),
(129, 'Tielemans', 'Youri', 25, 'MF', '129.png', 0, 0, 0),
(130, 'Dedić', 'Amar', 6, 'DF', '130.png', 0, 0, 0),
(131, 'Memić', 'Amar', 6, 'MF', '131.png', 0, 0, 0),
(132, 'Hadžiahmetović', 'Amir', 6, 'MF', '132.png', 0, 0, 0),
(133, 'Malic', 'Arjan', 6, 'DF', '133.png', 0, 0, 0),
(134, 'Gigovic', 'Armin', 6, 'MF', '134.png', 0, 0, -1),
(135, 'Tahirovic', 'Benjamin', 6, 'MF', '135.png', 0, 0, 0),
(136, 'Hadžikadunić', 'Dennis', 6, 'DF', '136.png', 0, 0, 0),
(137, 'Burnić', 'Dženis', 6, 'MF', '137.png', 0, 0, 0),
(138, 'Džeko', 'Edin', 6, 'FW', '138.png', 0, 0, 0),
(139, 'Demirović', 'Ermedin', 6, 'FW', '139.png', 0, 0, 0),
(140, 'Mahmić', 'Ermin', 6, 'MF', '140.png', 0, 0, 0),
(141, 'Bajraktarevic', 'Esmir', 6, 'MF', '141.png', 0, 0, 0),
(142, 'Tabaković', 'Haris', 6, 'FW', '142.png', 0, 0, 0),
(143, 'Bašić', 'Ivan', 6, 'MF', '143.png', 0, 0, 0),
(144, 'Šunjić', 'Ivan', 6, 'MF', '144.png', 0, 0, 0),
(145, 'Lukić', 'Jovo', 6, 'FW', '145.png', 0, 0, 0),
(146, 'Alajbegović', 'Kerim', 6, 'MF', '146.png', 0, 0, 0),
(147, 'Zlomislić', 'Martin', 6, 'GK', '147.png', 0, 0, 0),
(148, 'Jurkas', 'Mladen', 6, 'GK', '148.png', 0, 0, 0),
(149, 'Mujakić', 'Nihad', 6, 'DF', '149.png', 0, 0, 0),
(150, 'Katić', 'Nikola', 6, 'DF', '150.png', 0, 0, 0),
(151, 'Vasilj', 'Nikola', 6, 'GK', '151.png', 0, 0, 0),
(152, 'Baždar', 'Samed', 6, 'FW', '152.png', 0, 0, 0),
(153, 'Kolašinac', 'Sead', 6, 'DF', '153.png', 0, 0, 0),
(154, 'Radeljić', 'Stjepan', 6, 'DF', '154.png', 1, 0, 0),
(155, 'Muharemovic', 'Tarik', 6, 'DF', '155.png', 0, 0, 0),
(156, 'Sandro', 'Alex', 9, 'DF,MF', '156.png', 0, 0, 1),
(157, 'Alisson', '', 9, 'GK', '157.png', 0, 0, 0),
(158, 'Guimarães', 'Bruno', 9, 'MF', '158.png', 0, 0, 0),
(159, 'Casemiro', '', 9, 'MF', '159.png', 0, 0, 0),
(160, 'Danilo', '', 9, 'DF', '160.png', 0, 0, 0),
(161, 'Santos', 'Danilo', 9, 'MF', '161.png', 0, 0, 0),
(162, 'Santos', 'Douglas', 9, 'DF', '162.png', 0, 0, 0),
(163, 'Moraes', 'Ederson', 9, 'GK', '163.png', 0, 0, 0),
(164, 'Endrick', '', 9, 'FW', '164.png', 0, 0, 0),
(165, 'Fabinho', '', 9, 'DF,MF', '165.png', 0, 0, 0),
(166, 'Magalhães', 'Gabriel', 9, 'DF', '166.png', 0, 0, 0),
(167, 'Martinelli', 'Gabriel', 9, 'FW,MF', '167.png', 0, 0, 0),
(168, 'Bremer', 'Gleison', 9, 'DF', '168.png', 0, 0, 0),
(169, 'Thiago', 'Igor', 9, 'FW', '169.png', 0, 0, 0),
(170, 'Paquetá', 'Lucas', 9, 'MF', '170.png', 0, 0, 0),
(171, 'Henrique', 'Luiz', 9, 'FW,MF', '171.png', 0, 0, 0),
(172, 'Pereira', 'Léo', 9, 'DF', '172.png', 0, 0, 0),
(173, 'Marquinhos', '', 9, 'DF', '173.png', 0, 0, 0),
(174, 'Cunha', 'Matheus', 9, 'FW', '174.png', 0, 0, 0),
(175, 'Raphinha', '', 9, 'MF,FW', '175.png', 0, 0, 0),
(176, 'Rayan', '', 9, 'MF', '176.png', 0, 0, 0),
(177, 'Ibanez', 'Roger', 9, 'DF', '177.png', 0, 0, 0),
(178, 'Júnior', 'Vinicius', 9, 'FW', '178.png', 0, 0, 0),
(179, 'Wéverton', '', 9, 'GK', '179.png', 0, 0, 0),
(180, 'Silva', 'Éderson', 9, 'MF', '180.png', 0, 0, 0),
(181, 'dos Santos', 'C.J.', 30, 'GK', '181.png', 0, 0, 0),
(182, 'Livramento', 'Dailon', 30, 'FW', '182.png', 0, 0, 0),
(183, 'Duarte', 'Deroy', 30, 'MF', '183.png', 0, 0, 0),
(184, 'Diney', '', 30, 'DF', '184.png', 0, 0, 0),
(185, 'Rodrigues', 'Garry', 30, 'MF', '185.png', 0, 0, 0),
(186, 'Benchimol', 'Gilson', 30, 'FW', '186.png', 0, 0, 0),
(187, 'Varela', 'Hélio', 30, 'FW', '187.png', 0, 0, 0),
(188, 'Monteiro', 'Jamiro', 30, 'MF', '188.png', 0, 0, 0),
(189, 'Cabral', 'Jovane', 30, 'FW', '189.png', 0, 0, 0),
(190, 'Paulo Fernandes', 'João', 30, 'DF,MF', '190.png', 0, 0, 0),
(191, 'Pires', 'Kelvin', 30, 'DF', '191.png', 0, 0, 0),
(192, 'Pina', 'Kevin', 30, 'MF', '192.png', 0, 0, 0),
(193, 'Duarte', 'Laros', 30, 'MF', '193.png', 0, 0, 0),
(194, 'Costa', 'Logan', 30, 'DF', '194.png', 0, 0, 0),
(195, 'Rosa', 'Márcio', 30, 'GK', '195.png', 0, 0, 0),
(196, 'da Costa', 'Nuno', 30, 'FW,MF', '196.png', 0, 0, 0),
(197, 'Pico', '', 30, 'DF', '197.png', 0, 0, 0),
(198, 'Mendes', 'Ryan', 30, 'MF,FW', '198.png', 0, 0, 0),
(199, 'Lopes Cabral', 'Sidny', 30, 'DF', '199.png', 0, 0, 0),
(200, 'Moreira', 'Steven', 30, 'DF', '200.png', 0, 0, 0),
(201, 'Stopira', '', 30, 'DF', '201.png', 0, 0, 0),
(202, 'Arcanjo', 'Telmo', 30, 'MF', '202.png', 0, 0, 0),
(203, 'Vozinha', '', 30, 'GK', '203.png', 0, 0, 0),
(204, 'Pina', 'Wagner', 30, 'DF,MF', '204.png', 0, 0, 0),
(205, 'Semedo', 'Willy', 30, 'FW,MF', '205.png', 0, 0, 0),
(206, 'Yannick', '', 30, 'MF', '206.png', 0, 0, 0),
(207, 'Jones', 'Alfie', 5, 'DF,MF', '207.png', 0, 0, 0),
(208, 'Ahmed', 'Ali', 5, 'MF', '208.png', 0, 0, 0),
(209, 'Johnston', 'Alistair', 5, 'DF', '209.png', 0, 0, 0),
(210, 'Davies', 'Alphonso', 5, 'DF,FW', '210.png', 0, 0, 1),
(211, 'Larin', 'Cyle', 5, 'FW', '211.png', 0, 0, 0),
(212, 'St. Clair', 'Dayne', 5, 'GK', '212.png', 0, 0, 0),
(213, 'Cornelius', 'Derek', 5, 'DF', '213.png', 1, 0, 0),
(214, 'Koné', 'Ismaël', 5, 'MF', '214.png', 0, 0, 0),
(215, 'Shaffelburg', 'Jacob', 5, 'MF', '215.png', 0, 0, 0),
(216, 'Nelson', 'Jayden', 5, 'FW,MF', '216.png', 0, 0, 0),
(217, 'Waterman', 'Joel', 5, 'DF', '217.png', 0, 0, 0),
(218, 'David', 'Jonathan', 5, 'FW', '218.png', 0, 0, 0),
(219, 'Osorio', 'Jonathan', 5, 'MF', '219.png', 0, 0, 0),
(220, 'Millar', 'Liam', 5, 'MF', '220.png', 0, 0, 0),
(221, 'De Fougerolles', 'Luc', 5, 'DF', '221.png', 0, 0, 0),
(222, 'Choinière', 'Mathieu', 5, 'MF', '222.png', 0, 0, 0),
(223, 'Crépeau', 'Maxime', 5, 'GK', '223.png', 0, 0, 0),
(224, 'Bombito', 'Moïse', 5, 'DF', '224.png', 0, 0, 0),
(225, 'Saliba', 'Nathan', 5, 'MF', '225.png', 0, 0, 0),
(226, 'Sigur', 'Niko', 5, 'DF,MF', '226.png', 0, 0, 0),
(227, 'Goodman', 'Owen', 5, 'GK', '227.png', 0, 0, 0),
(228, 'David', 'Promise', 5, 'FW', '228.png', 0, 0, 0),
(229, 'Laryea', 'Richie', 5, 'DF', '229.png', 0, 0, 0),
(230, 'Eustáquio', 'Stephen', 5, 'MF', '230.png', 0, 0, 0),
(231, 'Buchanan', 'Tajon', 5, 'MF', '231.png', 0, 0, 0),
(232, 'Oluwaseyi', 'Tani', 5, 'FW', '232.png', 0, 0, 0),
(233, 'Gómez', 'Andrés', 44, 'MF', '233.png', 0, 0, 0),
(234, 'Vargas', 'Camilo', 44, 'GK', '234.png', 0, 0, 0),
(235, 'Cucho', '', 44, 'FW,MF', '235.png', 0, 0, 0),
(236, 'Muñoz', 'Daniel', 44, 'DF', '236.png', 0, 0, 0),
(237, 'Ospina', 'David', 44, 'GK', '237.png', 0, 0, 0),
(238, 'Sánchez', 'Davinson', 44, 'DF', '238.png', 0, 0, 0),
(239, 'Machado', 'Deiver', 44, 'DF,MF', '239.png', 0, 0, 0),
(240, 'Puerta', 'Gustavo', 44, 'MF', '240.png', 0, 0, 0),
(241, 'Rodríguez', 'James', 44, 'FW', '241.png', 0, 0, 0),
(242, 'Campaz', 'Jaminton', 44, 'FW,MF', '242.png', 0, 0, 0),
(243, 'Lerma', 'Jefferson', 44, 'MF', '243.png', 0, 0, 0),
(244, 'Arias', 'Jhon', 44, 'MF', '244.png', 0, 0, 0),
(245, 'Córdoba', 'Jhon', 44, 'FW', '245.png', 0, 0, 0),
(246, 'Lucumí', 'Jhon', 44, 'DF', '246.png', 0, 0, 0),
(247, 'Mojica', 'Johan', 44, 'DF', '247.png', 0, 0, 0),
(248, 'Carrascal', 'Jorge', 44, 'FW,MF', '248.png', 0, 0, 0),
(249, 'Camilo Portilla', 'Juan', 44, 'MF', '249.png', 0, 0, 0),
(250, 'Quintero', 'Juan', 44, 'FW,MF', '250.png', 0, 0, 0),
(251, 'Castaño', 'Kevin', 44, 'MF', '251.png', 0, 0, 0),
(252, 'Díaz', 'Luis', 44, 'FW', '252.png', 0, 0, 0),
(253, 'Suárez', 'Luis', 44, 'FW', '253.png', 0, 0, 0),
(254, 'Ríos', 'Richard', 44, 'MF', '254.png', 0, 0, 0),
(255, 'Arias', 'Santiago', 44, 'DF,MF', '255.png', 0, 0, 0),
(256, 'Ditta', 'Willer', 44, 'DF', '256.png', 0, 0, 0),
(257, 'Mina', 'Yerry', 44, 'DF', '257.png', 0, 0, 0),
(258, 'David Montero', 'Álvaro', 44, 'GK', '258.png', 0, 0, 0),
(259, 'Tshibola', 'Aaron', 42, 'MF', '259.png', 0, 0, 0),
(260, 'Wan-Bissaka', 'Aaron', 42, 'DF', '260.png', 0, 0, 0),
(261, 'Masuaku', 'Arthur', 42, 'DF', '261.png', 0, 0, 0),
(262, 'Tuanzebe', 'Axel', 42, 'DF', '262.png', 0, 0, 0),
(263, 'Cipenga', 'Brian', 42, 'MF', '263.png', 0, 0, 0),
(264, 'Mbemba', 'Chancel', 42, 'DF', '264.png', 0, 0, 0),
(265, 'Pickel', 'Charles', 42, 'DF,MF', '265.png', 0, 0, 0),
(266, 'Bakambu', 'Cédric', 42, 'FW', '266.png', 0, 0, 0),
(267, 'Batubinsika', 'Dylan', 42, 'DF', '267.png', 0, 0, 0),
(268, 'Kayembe', 'Edo', 42, 'MF', '268.png', 0, 0, 0),
(269, 'Mayele', 'Fiston', 42, 'FW', '269.png', 0, 0, 0),
(270, 'Kakuta', 'Gaël', 42, 'FW,MF', '270.png', 0, 0, 0),
(271, 'Kalulu', 'Gédéon', 42, 'DF', '271.png', 0, 0, 0),
(272, 'Kayembe', 'Joris', 42, 'DF,FW', '272.png', 0, 0, 0),
(273, 'Mpasi', 'Lionel', 42, 'GK', '273.png', 0, 0, 0),
(274, 'Epolo', 'Matthieu', 42, 'GK', '274.png', 0, 0, 0),
(275, 'Elia', 'Meschak', 42, 'FW,MF', '275.png', 0, 0, 0),
(276, 'Mbuku', 'Nathanaël', 42, 'MF', '276.png', 0, 0, 0),
(277, 'Mukau', 'Ngal\'Ayel', 42, 'MF', '277.png', 0, 0, 0),
(278, 'Sadiki', 'Noah', 42, 'MF', '278.png', 0, 0, 0),
(279, 'Moutoussamy', 'Samuel', 42, 'MF', '279.png', 0, 0, 0),
(280, 'Banza', 'Simon', 42, 'FW,MF', '280.png', 0, 0, 0),
(281, 'Kapuadi', 'Steve', 42, 'DF', '281.png', 0, 0, 0),
(282, 'Bongonda', 'Theo', 42, 'FW,MF', '282.png', 0, 0, 0),
(283, 'Fayulu', 'Timothy', 42, 'GK', '283.png', 0, 0, 0),
(284, 'Wissa', 'Yoane', 42, 'FW', '284.png', 0, 0, 0),
(285, 'Kramarić', 'Andrej', 46, 'FW,MF', '285.png', 0, 0, 0),
(286, 'Budimir', 'Ante', 46, 'FW', '286.png', 0, 0, 0),
(287, 'Kotarski', 'Dominik', 46, 'GK', '287.png', 0, 0, 0),
(288, 'Livaković', 'Dominik', 46, 'GK', '288.png', 0, 0, 0),
(289, 'Ćaleta-Car', 'Duje', 46, 'DF', '289.png', 0, 0, 0),
(290, 'Matanović', 'Igor', 46, 'FW', '290.png', 0, 0, 0),
(291, 'Perišić', 'Ivan', 46, 'MF', '291.png', 0, 0, 0),
(292, 'Pandur', 'Ivor', 46, 'GK', '292.png', 0, 0, 0),
(293, 'Stanišić', 'Josip', 46, 'MF', '293.png', 0, 0, 0),
(294, 'Šutalo', 'Josip', 46, 'DF', '294.png', 0, 0, 0),
(295, 'Gvardiol', 'Joško', 46, 'DF', '295.png', 0, 0, 0),
(296, 'Jakić', 'Kristijan', 46, 'DF,MF', '296.png', 0, 0, 0),
(297, 'Modrić', 'Luka', 46, 'MF', '297.png', 0, 0, 0),
(298, 'Sučić', 'Luka', 46, 'FW,MF', '298.png', 0, 0, 0),
(299, 'Vušković', 'Luka', 46, 'DF', '299.png', 0, 0, 0),
(300, 'Pašalić', 'Marco', 46, 'MF', '300.png', 0, 0, 0),
(301, 'Pongračić', 'Marin', 46, 'DF', '301.png', 0, 0, 0),
(302, 'Pašalić', 'Mario', 46, 'MF', '302.png', 0, 0, 0),
(303, 'Baturina', 'Martin', 46, 'FW', '303.png', 0, 0, 0),
(304, 'Erlić', 'Martin', 46, 'DF', '304.png', 0, 0, 0),
(305, 'Kovačić', 'Mateo', 46, 'MF', '305.png', 0, 0, 0),
(306, 'Moro', 'Nikola', 46, 'MF', '306.png', 0, 0, 0),
(307, 'Vlašić', 'Nikola', 46, 'FW,MF', '307.png', 0, 0, 0),
(308, 'Musa', 'Petar', 46, 'FW', '308.png', 0, 0, 0),
(309, 'Sučić', 'Petar', 46, 'FW', '309.png', 0, 0, 0),
(310, 'Fruk', 'Toni', 46, 'FW,MF', '310.png', 0, 0, 0),
(311, 'Martha', 'Ar\'jany', 18, 'DF,FW', '311.png', 0, 0, 0),
(312, 'Obispo', 'Armando', 18, 'DF', '312.png', 0, 0, 0),
(313, 'Kuwas', 'Brandley', 18, 'FW,MF', '313.png', 0, 0, 0),
(314, 'Fonville', 'Deveron', 18, 'DF', '314.png', 0, 0, 0),
(315, 'Room', 'Eloy', 18, 'GK', '315.png', 0, 0, 0),
(316, 'Kastaneer', 'Gervane', 18, 'FW,MF', '316.png', 0, 0, 0),
(317, 'Roemeratoe', 'Godfried', 18, 'MF', '317.png', 0, 0, 0),
(318, 'Margaritha', 'Jearl', 18, 'FW,MF', '318.png', 0, 0, 0),
(319, 'Antonisse', 'Jeremy', 18, 'FW,MF', '319.png', 0, 0, 0),
(320, 'Brenet', 'Joshua', 18, 'DF', '320.png', 0, 0, 0),
(321, 'Bacuna', 'Juninho', 18, 'MF', '321.png', 0, 0, 0),
(322, 'Gaari', 'Juriën', 18, 'DF', '322.png', 0, 0, 0),
(323, 'Locadia', 'Jürgen', 18, 'FW', '323.png', 0, 0, 0),
(324, 'Gorré', 'Kenji', 18, 'FW,MF', '324.png', 0, 0, 0),
(325, 'Felida', 'Kevin', 18, 'MF', '325.png', 0, 0, 0),
(326, 'Bacuna', 'Leandro', 18, 'MF', '326.png', 0, 0, 0),
(327, 'Comenencia', 'Livano', 18, 'MF', '327.png', 0, 0, 0),
(328, 'Bazoer', 'Riechedly', 18, 'DF', '328.png', 0, 0, 0),
(329, 'van Eijma', 'Roshon', 18, 'DF', '329.png', 0, 0, 0),
(330, 'Floranus', 'Sherel', 18, 'DF', '330.png', 0, 0, 0),
(331, 'Sambo', 'Shurandy', 18, 'DF', '331.png', 0, 0, 0),
(332, 'Hansen', 'Sontje', 18, 'FW', '332.png', 0, 0, 0),
(333, 'Chong', 'Tahith', 18, 'MF', '333.png', 0, 0, 0),
(334, 'Doornbusch', 'Trevor', 18, 'GK', '334.png', 0, 0, 0),
(335, 'Noslin', 'Tyrese', 18, 'MF', '335.png', 0, 0, 0),
(336, 'Bodak', 'Tyrick', 18, 'GK', '336.png', 0, 0, 0),
(337, 'Hložek', 'Adam', 4, 'FW', '337.png', 0, 0, 0),
(338, 'Sojka', 'Alexandr', 4, 'MF,DF', '338.png', 0, 0, 0),
(339, 'Douděra', 'David', 4, 'DF,MF', '339.png', 0, 0, 0),
(340, 'Jurásek', 'David', 4, 'DF,MF', '340.png', 0, 0, 0),
(341, 'Zima', 'David', 4, 'DF', '341.png', 0, 0, 0),
(342, 'Višinský', 'Denis', 4, 'FW,MF', '342.png', 0, 0, 0),
(343, 'Sochůrek', 'Hugo', 4, 'MF', '343.png', 0, 0, 0),
(344, 'Kuchta', 'Jan', 4, 'FW', '344.png', 0, 0, 0),
(345, 'Zelený', 'Jaroslav', 4, 'MF', '345.png', 0, 0, 0),
(346, 'Staněk', 'Jindřich', 4, 'GK', '346.png', 0, 0, 0),
(347, 'Krejčí', 'Ladislav', 4, 'DF', '347.png', 0, 0, 0),
(348, 'Horníček', 'Lukáš', 4, 'GK', '348.png', 0, 0, 0),
(349, 'Provod', 'Lukáš', 4, 'FW', '349.png', 0, 0, 0),
(350, 'Červ', 'Lukáš', 4, 'MF', '350.png', 0, 0, 0),
(351, 'Kovar', 'Matej', 4, 'GK', '351.png', 0, 0, 0),
(352, 'Sadílek', 'Michal', 4, 'MF', '352.png', 0, 0, 0),
(353, 'Chytil', 'Mojmír', 4, 'FW', '353.png', 0, 1, 0),
(354, 'Schick', 'Patrik', 4, 'FW', '354.png', 0, 0, 0),
(355, 'Šulc', 'Pavel', 4, 'FW', '355.png', 0, 0, 0),
(356, 'Hranáč', 'Robin', 4, 'DF', '356.png', 0, 0, 0),
(357, 'Chorý', 'Tomáš', 4, 'FW', '357.png', 0, 0, 0),
(358, 'Holeš', 'Tomáš', 4, 'DF', '358.png', 0, 0, 0),
(359, 'Souček', 'Tomáš', 4, 'MF', '359.png', 0, 0, 0),
(360, 'Coufal', 'Vladimír', 4, 'MF,DF', '360.png', 0, 0, 0),
(361, 'Darida', 'Vladimír', 4, 'MF', '361.png', 0, 0, 0),
(362, 'Chaloupek', 'Štěpán', 4, 'DF', '362.png', 0, 0, 0),
(363, 'Lafont', 'Alban', 19, 'GK', '363.png', 0, 0, 0),
(364, 'Diallo', 'Amad', 19, 'FW', '364.png', 0, 0, 0),
(365, 'Bonny', 'Ange-Yoan', 19, 'FW', '365.png', 0, 0, 0),
(366, 'Touré', 'Bazoumana', 19, 'MF', '366.png', 0, 0, 0),
(367, 'Inao Oulaï', 'Christ', 19, 'MF', '367.png', 0, 0, 0),
(368, 'Opéri', 'Christopher', 19, 'DF,MF', '368.png', 0, 0, 0),
(369, 'Wahi', 'Elye', 19, 'FW', '369.png', 0, 0, 0),
(370, 'Agbadou', 'Emmanuel', 19, 'DF', '370.png', 0, 0, 0),
(371, 'Guessand', 'Evann', 19, 'FW,MF', '371.png', 0, 0, 0),
(372, 'Kessié', 'Franck', 19, 'MF', '372.png', 0, 0, 0),
(373, 'Konan', 'Ghislain', 19, 'DF', '373.png', 0, 0, 0),
(374, 'Doué', 'Guéla', 19, 'DF', '374.png', 0, 0, 0),
(375, 'Sangaré', 'Ibrahim', 19, 'MF', '375.png', 0, 0, 0),
(376, 'Seri', 'Jean', 19, 'MF', '376.png', 0, 0, 0),
(377, 'Koné', 'Mohamed', 19, 'GK', '377.png', 0, 0, 0),
(378, 'Pépé', 'Nicolas', 19, 'FW', '378.png', 0, 0, 0),
(379, 'N\'Dicka', 'Obite', 19, 'DF', '379.png', 0, 0, 0),
(380, 'Kossounou', 'Odilon', 19, 'DF', '380.png', 0, 0, 0),
(381, 'Diakité', 'Oumar', 19, 'FW', '381.png', 0, 0, 0),
(382, 'Diomande', 'Ousmane', 19, 'DF', '382.png', 0, 0, 0),
(383, 'Guiagon', 'Parfait', 19, 'MF', '383.png', 0, 0, 0),
(384, 'Fofana', 'Seko', 19, 'MF', '384.png', 0, 0, 0),
(385, 'Adingra', 'Simon', 19, 'FW,MF', '385.png', 0, 0, 0),
(386, 'Singo', 'Wilfried', 19, 'DF', '386.png', 0, 0, 0),
(387, 'Fofana', 'Yahia', 19, 'GK', '387.png', 0, 0, 0),
(388, 'Diomandé', 'Yan', 19, 'MF,FW', '388.png', 0, 0, 0),
(389, 'Franco', 'Alan', 20, 'DF', '389.png', 0, 0, 0),
(390, 'Minda', 'Alan', 20, 'MF', '390.png', 0, 0, 0),
(391, 'Valencia', 'Anthony', 20, 'MF', '391.png', 0, 0, 0),
(392, 'Castillo', 'Denil', 20, 'MF', '392.png', 0, 0, 0),
(393, 'Valencia', 'Enner', 20, 'FW', '393.png', 0, 0, 0),
(394, 'Torres Caicedo', 'Félix', 20, 'DF', '394.png', 0, 0, 0),
(395, 'Plata', 'Gonzalo', 20, 'FW', '395.png', 0, 0, 0),
(396, 'Valle', 'Gonzalo', 20, 'GK', '396.png', 0, 0, 0),
(397, 'Galíndez', 'Hernán', 20, 'GK', '397.png', 0, 0, 0),
(398, 'Porozo', 'Jackson', 20, 'DF', '398.png', 0, 0, 0),
(399, 'Arévalo', 'Jeremy', 20, 'FW', '399.png', 0, 0, 0),
(400, 'Ordóñez', 'Joel', 20, 'DF', '400.png', 0, 0, 0),
(401, 'Yeboah', 'John', 20, 'MF', '401.png', 0, 0, 0),
(402, 'Alcivar', 'Jordy', 20, 'MF', '402.png', 0, 0, 0),
(403, 'Caicedo', 'Jordy', 20, 'FW', '403.png', 0, 0, 0),
(404, 'Páez', 'Kendry', 20, 'MF', '404.png', 0, 0, 0),
(405, 'Rodríguez', 'Kevin', 20, 'FW', '405.png', 0, 0, 0),
(406, 'Caicedo', 'Moisés', 20, 'MF', '406.png', 0, 0, 0),
(407, 'Ramírez', 'Moisés', 20, 'GK', '407.png', 0, 0, 0),
(408, 'Angulo', 'Nilson', 20, 'FW,MF', '408.png', 0, 0, 0),
(409, 'Vite', 'Pedro', 20, 'MF', '409.png', 0, 0, 0),
(410, 'Estupiñán', 'Pervis', 20, 'MF', '410.png', 0, 0, 0),
(411, 'Hincapié', 'Piero', 20, 'DF', '411.png', 0, 0, 0),
(412, 'Pacho', 'Willian', 20, 'DF', '412.png', 0, 0, 0),
(413, 'Medina', 'Yaimar', 20, 'DF,MF', '413.png', 0, 0, 0),
(414, 'Preciado', 'Ángelo', 20, 'DF,MF', '414.png', 0, 0, 0),
(415, 'Fatouh', 'Ahmed', 26, 'DF', '415.png', 0, 0, 0),
(416, 'Mahdy Soliman', 'El', 26, 'GK', '416.png', 0, 0, 0),
(417, 'Ashour', 'Emam', 26, 'MF', '417.png', 0, 0, 0),
(418, 'Hassan', 'Haissem', 26, 'MF', '418.png', 0, 0, 0),
(419, 'Fathy', 'Hamdy', 26, 'DF', '419.png', 0, 0, 0),
(420, 'Abdelkarim', 'Hamza', 26, 'FW', '420.png', 0, 0, 0),
(421, 'Abdelmaguid', 'Hossam', 26, 'DF', '421.png', 0, 0, 0),
(422, 'Adel', 'Ibrahim', 26, 'MF', '422.png', 0, 0, 0),
(423, 'Hafez', 'Karim', 26, 'DF', '423.png', 0, 0, 0),
(424, 'Saber', 'Mahmoud', 26, 'MF', '424.png', 0, 0, 0),
(425, 'Attia', 'Marwan', 26, 'MF', '425.png', 0, 0, 0),
(426, 'Abdelmonem', 'Mohamed', 26, 'DF', '426.png', 0, 0, 0),
(427, 'Alaa', 'Mohamed', 26, 'GK', '427.png', 0, 0, 0),
(428, 'El-Shenawy', 'Mohamed', 26, 'GK', '428.png', 0, 0, 0),
(429, 'Hany', 'Mohamed', 26, 'DF', '429.png', 0, 0, 0),
(430, 'Salah', 'Mohamed', 26, 'MF,FW', '430.png', 0, 0, 0),
(431, 'Lasheen', 'Mohanad', 26, 'MF', '431.png', 0, 0, 0),
(432, 'Shobeir', 'Mostafa', 26, 'GK', '432.png', 0, 0, 0),
(433, 'Ziko', 'Mostafa', 26, 'MF', '433.png', 0, 0, 0),
(434, 'Dunga', 'Nabil', 26, 'MF', '434.png', 0, 0, 0),
(435, 'Marmoush', 'Omar', 26, 'FW', '435.png', 0, 0, 0),
(436, 'Rabia', 'Ramy', 26, 'DF,MF', '436.png', 0, 0, 0),
(437, 'Alaa', 'Tarek', 26, 'DF', '437.png', 0, 0, 0),
(438, 'Trézéguet', '', 26, 'FW,MF', '438.png', 0, 0, 0),
(439, 'Ibrahim', 'Yasser', 26, 'DF', '439.png', 0, 0, 0),
(440, 'Zizo', '', 26, 'MF', '440.png', 0, 0, 0),
(441, 'Gordon', 'Anthony', 45, 'MF', '441.png', 0, 0, 0),
(442, 'Saka', 'Bukayo', 45, 'FW,MF', '442.png', 0, 0, 0),
(443, 'Burn', 'Dan', 45, 'DF', '443.png', 0, 0, 0),
(444, 'Henderson', 'Dean', 45, 'GK', '444.png', 0, 0, 0),
(445, 'Rice', 'Declan', 45, 'MF', '445.png', 0, 0, 0),
(446, 'Spence', 'Djed', 45, 'DF,MF', '446.png', 0, 0, 0),
(447, 'Eze', 'Eberechi', 45, 'FW,MF', '447.png', 0, 0, 0),
(448, 'Anderson', 'Elliot', 45, 'MF', '448.png', 0, 0, 0),
(449, 'Konsa', 'Ezri', 45, 'DF', '449.png', 0, 0, 0),
(450, 'Kane', 'Harry', 45, 'FW', '450.png', 0, 0, 0),
(451, 'Toney', 'Ivan', 45, 'FW', '451.png', 0, 0, 0),
(452, 'Trafford', 'James', 45, 'GK', '452.png', 0, 0, 0),
(453, 'Quansah', 'Jarell', 45, 'DF', '453.png', 0, 0, 0),
(454, 'Stones', 'John', 45, 'DF', '454.png', 0, 0, 0),
(455, 'Henderson', 'Jordan', 45, 'MF', '455.png', 0, 0, 0),
(456, 'Pickford', 'Jordan', 45, 'GK', '456.png', 0, 0, 0),
(457, 'Bellingham', 'Jude', 45, 'MF', '457.png', 0, 0, 0),
(458, 'Mainoo', 'Kobbie', 45, 'MF', '458.png', 0, 0, 0),
(459, 'Guéhi', 'Marc', 45, 'DF', '459.png', 0, 0, 0),
(460, 'Rashford', 'Marcus', 45, 'FW,MF', '460.png', 0, 0, 0),
(461, 'Rogers', 'Morgan', 45, 'FW,MF', '461.png', 0, 0, 0),
(462, 'O\'Reilly', 'Nico', 45, 'DF', '462.png', 0, 0, 0),
(463, 'Madueke', 'Noni', 45, 'MF', '463.png', 0, 0, 0),
(464, 'Watkins', 'Ollie', 45, 'FW,MF', '464.png', 0, 0, 0),
(465, 'James', 'Reece', 45, 'DF', '465.png', 0, 0, 0),
(466, 'Rabiot', 'Adrien', 33, 'MF', '466.png', 0, 0, 0),
(467, 'Tchouaméni', 'Aurélien', 33, 'MF', '467.png', 0, 0, 0),
(468, 'Barcola', 'Bradley', 33, 'FW,MF', '468.png', 0, 0, 0),
(469, 'Samba', 'Brice', 33, 'GK', '469.png', 0, 0, 0),
(470, 'Upamecano', 'Dayot', 33, 'DF', '470.png', 0, 0, 0),
(471, 'Doué', 'Désiré', 33, 'MF', '471.png', 0, 0, 0),
(472, 'Konaté', 'Ibrahima', 33, 'DF', '472.png', 0, 0, 0),
(473, 'Mateta', 'Jean-Philippe', 33, 'FW', '473.png', 0, 0, 0),
(474, 'Koundé', 'Jules', 33, 'DF', '474.png', 0, 0, 0),
(475, 'Mbappé', 'Kylian', 33, 'FW', '475.png', 0, 0, 0),
(476, 'Digne', 'Lucas', 33, 'DF,MF', '476.png', 0, 0, 0),
(477, 'Hernández', 'Lucas', 33, 'DF', '477.png', 0, 0, 0),
(478, 'Akliouche', 'Maghnes', 33, 'MF', '478.png', 0, 0, 0),
(479, 'Gusto', 'Malo', 33, 'DF,MF', '479.png', 0, 0, 0),
(480, 'Koné', 'Manu', 33, 'MF', '480.png', 0, 0, 0),
(481, 'Thuram', 'Marcus', 33, 'FW,MF', '481.png', 0, 0, 0),
(482, 'Lacroix', 'Maxence', 33, 'DF', '482.png', 0, 0, 0),
(483, 'Olise', 'Michael', 33, 'MF', '483.png', 0, 0, 0),
(484, 'Maignan', 'Mike', 33, 'GK', '484.png', 0, 0, 0),
(485, 'Kanté', 'N\'Golo', 33, 'MF', '485.png', 0, 0, 0),
(486, 'Dembélé', 'Ousmane', 33, 'MF', '486.png', 0, 0, 0),
(487, 'Cherki', 'Rayan', 33, 'FW,MF', '487.png', 0, 0, 0),
(488, 'Risser', 'Robin', 33, 'GK', '488.png', 0, 0, 0),
(489, 'Hernández', 'Theo', 33, 'DF', '489.png', 0, 0, 0),
(490, 'Zaïre-Emery', 'Warren', 33, 'DF,MF', '490.png', 0, 0, 0),
(491, 'Saliba', 'William', 33, 'DF', '491.png', 0, 0, 0),
(492, 'Pavlovic', 'Aleksandar', 17, 'MF', '492.png', 0, 0, 1),
(493, 'Nübel', 'Alexander', 17, 'GK', '493.png', 0, 0, 0),
(494, 'Stiller', 'Angelo', 17, 'MF', '494.png', 0, 0, -1),
(495, 'Rüdiger', 'Antonio', 17, 'DF', '495.png', 0, 0, 0),
(496, 'Ouédraogo', 'Assan', 17, 'MF', '496.png', 0, 0, 0),
(497, 'Raum', 'David', 17, 'DF,MF', '497.png', 0, 0, 0),
(498, 'Undav', 'Deniz', 17, 'FW,MF', '498.png', 0, 0, 0),
(499, 'Nmecha', 'Felix', 17, 'MF', '499.png', 0, 0, 0),
(500, 'Wirtz', 'Florian', 17, 'MF', '500.png', 0, 0, 0),
(501, 'Musiala', 'Jamal', 17, 'MF', '501.png', 0, 0, 0),
(502, 'Leweling', 'Jamie', 17, 'FW,MF', '502.png', 0, 0, 0),
(503, 'Tah', 'Jonathan', 17, 'DF', '503.png', 0, 0, 0),
(504, 'Kimmich', 'Joshua', 17, 'DF', '504.png', 0, 0, 0),
(505, 'Havertz', 'Kai', 17, 'FW', '505.png', 0, 0, 0),
(506, 'Goretzka', 'Leon', 17, 'MF', '506.png', 0, 0, 0),
(507, 'Sané', 'Leroy', 17, 'MF', '507.png', 0, 0, 0),
(508, 'Thiaw', 'Malick', 17, 'DF,MF', '508.png', 0, 0, 0),
(509, 'Neuer', 'Manuel', 17, 'GK', '509.png', 0, 0, 0),
(510, 'Beier', 'Maximilian', 17, 'FW,MF', '510.png', 0, 0, 0),
(511, 'Amiri', 'Nadiem', 17, 'MF', '511.png', 0, 0, 0),
(512, 'Brown', 'Nathaniel', 17, 'DF', '512.png', 0, 0, 0),
(513, 'Woltemade', 'Nick', 17, 'FW,MF', '513.png', 0, 0, 0),
(514, 'Schlotterbeck', 'Nico', 17, 'DF', '514.png', 0, 0, 0),
(515, 'Baumann', 'Oliver', 17, 'GK', '515.png', 0, 0, 0),
(516, 'Groß', 'Pascal', 17, 'DF,MF', '516.png', 0, 0, 0),
(517, 'Anton', 'Waldemar', 17, 'DF,MF', '517.png', 0, 0, 0),
(518, 'Fatawu Issahaku', 'Abdul', 47, 'FW,MF', '518.png', 0, 0, 0),
(519, 'Mumin', 'Abdul', 47, 'DF', '519.png', 0, 0, 0),
(520, 'Rahman Baba', 'Abdul', 47, 'DF,MF', '520.png', 0, 0, 0),
(521, 'Seidu', 'Alidu', 47, 'DF', '521.png', 0, 0, 0),
(522, 'Semenyo', 'Antoine', 47, 'MF', '522.png', 0, 0, 0),
(523, 'Boakye', 'Augustine', 47, 'FW,MF', '523.png', 0, 0, 0),
(524, 'Asare', 'Benjamin', 47, 'GK', '524.png', 0, 0, 0),
(525, 'Thomas-Asante', 'Brandon', 47, 'FW,MF', '525.png', 0, 0, 0),
(526, 'Yirenkyi', 'Caleb', 47, 'MF', '526.png', 0, 0, 0),
(527, 'Bonsu-Baah', 'Christopher', 47, 'MF', '527.png', 0, 0, 0),
(528, 'Luckassen', 'Derrick', 47, 'DF,MF', '528.png', 0, 0, 0),
(529, 'Owusu', 'Elisha', 47, 'MF', '529.png', 0, 0, 0),
(530, 'Nuamah', 'Ernest', 47, 'MF', '530.png', 0, 0, 0),
(531, 'Mensah', 'Gideon', 47, 'DF', '531.png', 0, 0, 0),
(532, 'Williams', 'Iñaki', 47, 'FW,MF', '532.png', 0, 0, 0),
(533, 'Opoku', 'Jerome', 47, 'DF', '533.png', 0, 0, 0),
(534, 'Adjetey', 'Jonas', 47, 'DF', '534.png', 0, 0, 0),
(535, 'Ayew', 'Jordan', 47, 'FW', '535.png', 0, 0, 0),
(536, 'Anang', 'Joseph', 47, 'GK', '536.png', 0, 0, 0),
(537, 'Sulemana', 'Kamaldeen', 47, 'MF', '537.png', 0, 0, 0),
(538, 'Peprah Oppong', 'Kojo', 47, 'DF', '538.png', 0, 0, 0),
(539, 'Sibo', 'Kwasi', 47, 'MF', '539.png', 0, 0, 0),
(540, 'Ati-Zigi', 'Lawrence', 47, 'GK', '540.png', 0, 0, 0),
(541, 'Senaya', 'Marvin', 47, 'DF', '541.png', 0, 0, 0),
(542, 'Kwabena Adu', 'Prince', 47, 'FW', '542.png', 0, 0, 0),
(543, 'Pierre', 'Alexandre', 11, 'GK', '543.png', 0, 0, 1),
(544, 'Fred Sainté', 'Carl', 11, 'MF', '544.png', 0, 0, 0),
(545, 'Arcus', 'Carlens', 11, 'MF,DF', '545.png', 0, 0, 0),
(546, 'Jean-Jacques', 'Danley', 11, 'MF', '546.png', 0, 0, 0),
(547, 'Etienne', 'Derrick', 11, 'FW,MF', '547.png', 0, 0, 0),
(548, 'Simon', 'Dominique', 11, 'MF', '548.png', 0, 0, 0),
(549, 'Nazon', 'Duckens', 11, 'FW,MF', '549.png', 0, 0, 0),
(550, 'Lacroix', 'Duke', 11, 'DF,FW', '550.png', 0, 0, 0),
(551, 'Pierrot', 'Frantzdy', 11, 'FW', '551.png', 0, 0, 0),
(552, 'Metusala', 'Garven', 11, 'DF', '552.png', 0, 0, 0),
(553, 'Delcroix', 'Hannes', 11, 'DF', '553.png', 0, 0, 0),
(554, 'Duverne', 'Jean-Kevin', 11, 'DF', '554.png', 0, 0, 0),
(555, 'Bellegarde', 'Jean-Ricner', 11, 'MF', '555.png', 0, 0, 0),
(556, 'Placide', 'Johny', 11, 'GK', '556.png', 0, 0, 0),
(557, 'Casimir', 'Josué', 11, 'MF', '557.png', 0, 0, 0),
(558, 'Duverger', 'Josué', 11, 'GK', '558.png', 0, 0, 0),
(559, 'Thermoncy', 'Keeto', 11, 'DF', '559.png', 0, 0, 0),
(560, 'Joseph', 'Lenny', 11, 'FW,MF', '560.png', 0, 0, 0),
(561, 'Deedson', 'Louicius', 11, 'MF', '561.png', 0, 0, 0),
(562, 'Expérience', 'Martin', 11, 'MF,DF', '562.png', 0, 0, 0),
(563, 'Adé', 'Ricardo', 11, 'DF', '563.png', 0, 0, 0),
(564, 'Providence', 'Ruben', 11, 'MF', '564.png', 0, 0, 0),
(565, 'Paugain', 'Wilguens', 11, 'DF', '565.png', 0, 0, 0),
(566, 'Isidor', 'Wilson', 11, 'FW', '566.png', 0, 0, 0),
(567, 'Pierre', 'Woodensky', 11, 'MF', '567.png', 0, 0, 0),
(568, 'Fortuné', 'Yassin', 11, 'FW,MF', '568.png', 0, 0, 0),
(569, 'Alipour', 'Ali', 27, 'FW', '569.png', 0, 0, 0),
(570, 'Nemati', 'Ali', 27, 'DF', '570.png', 0, 0, 0),
(571, 'Beiranvand', 'Alireza', 27, 'GK', '571.png', 0, 0, 0),
(572, 'Jahanbakhsh', 'Alireza', 27, 'FW,MF', '572.png', 0, 0, 0),
(573, 'Hosseinzadeh', 'Amirhossein', 27, 'FW', '573.png', 0, 0, 0),
(574, 'Razzaghinia', 'Amirmohammad', 27, 'MF', '574.png', 0, 0, 0),
(575, 'Yousefi', 'Aria', 27, 'MF', '575.png', 0, 0, 0),
(576, 'Eiri', 'Danial', 27, 'DF', '576.png', 0, 0, 0),
(577, 'Eckert', 'Dennis', 27, 'FW', '577.png', 0, 0, 0),
(578, 'Hajsafi', 'Ehsan', 27, 'DF', '578.png', 0, 0, 0),
(579, 'Hosseini', 'Hossein', 27, 'GK', '579.png', 0, 0, 0),
(580, 'Kanaanizadegan', 'Hossein', 27, 'DF', '580.png', 0, 0, 0),
(581, 'Ghayedi', 'Mehdi', 27, 'FW', '581.png', 0, 0, 0),
(582, 'Taremi', 'Mehdi', 27, 'FW', '582.png', 0, 0, 0),
(583, 'Torabi', 'Mehdi', 27, 'MF', '583.png', 0, 0, 0),
(584, 'Mohammadi', 'Milad', 27, 'DF', '584.png', 0, 0, 0),
(585, 'Ghorbani', 'Mohammad', 27, 'MF', '585.png', 0, 0, 0),
(586, 'Mohebi', 'Mohammad', 27, 'MF', '586.png', 0, 0, 0),
(587, 'Niazmand', 'Payam', 27, 'GK', '587.png', 0, 0, 0),
(588, 'Rezaeian', 'Ramin', 27, 'MF,DF', '588.png', 0, 0, 0),
(589, 'Cheshmi', 'Rouzbeh', 27, 'DF,MF', '589.png', 0, 0, 0),
(590, 'Ezatolahi', 'Saeid', 27, 'MF', '590.png', 0, 0, 0),
(591, 'Hardani', 'Saleh', 27, 'DF', '591.png', 0, 0, 0),
(592, 'Ghoddos', 'Saman', 27, 'MF', '592.png', 0, 0, 0),
(593, 'Moghanlou', 'Shahriar', 27, 'FW', '593.png', 0, 0, 0),
(594, 'Khalilzadeh', 'Shoja\'', 27, 'DF', '594.png', 0, 0, 0),
(595, 'Basil', 'Ahmed', 35, 'GK', '595.png', 0, 0, 0),
(596, 'Maknzi', 'Ahmed', 35, 'DF', '596.png', 0, 0, 0),
(597, 'Qasem', 'Ahmed', 35, 'FW,MF', '597.png', 0, 0, 0),
(598, 'Sher', 'Aimar', 35, 'MF', '598.png', 0, 0, 0),
(599, 'Hashim', 'Akam', 35, 'DF', '599.png', 0, 0, 0),
(600, 'Al Hamadi', 'Ali', 35, 'FW', '600.png', 0, 0, 0),
(601, 'Jasim', 'Ali', 35, 'MF', '601.png', 0, 0, 0),
(602, 'Yousif', 'Ali', 35, 'FW', '602.png', 0, 0, 0),
(603, 'Al Ammari', 'Amir', 35, 'MF', '603.png', 0, 0, 0),
(604, 'Hussein', 'Ayman', 35, 'FW', '604.png', 0, 0, 0),
(605, 'Talib', 'Fahad', 35, 'GK', '605.png', 0, 0, 0),
(606, 'Dhia Putros', 'Frans', 35, 'DF', '606.png', 0, 0, 0),
(607, 'Ali', 'Hussein', 35, 'DF', '607.png', 0, 0, 0),
(608, 'Bayesh', 'Ibrahim', 35, 'MF', '608.png', 0, 0, 0),
(609, 'Hassan', 'Jalal', 35, 'GK', '609.png', 0, 0, 0),
(610, 'Yakob', 'Kevin', 35, 'MF', '610.png', 0, 0, 0),
(611, 'Younis', 'Manaf', 35, 'DF', '611.png', 0, 0, 0),
(612, 'Farji', 'Marko', 35, 'MF', '612.png', 0, 0, 0),
(613, 'Doski', 'Merchas', 35, 'DF', '613.png', 0, 0, 0),
(614, 'Ali', 'Mohanad', 35, 'FW', '614.png', 0, 0, 0),
(615, 'Saadoon', 'Mustafa', 35, 'DF', '615.png', 0, 0, 0),
(616, 'Sulaka', 'Rebin', 35, 'DF', '616.png', 0, 0, 0),
(617, 'Amyn', 'Youssef', 35, 'MF', '617.png', 0, 0, 0),
(618, 'Ismail', 'Zaid', 35, 'MF', '618.png', 0, 0, 0),
(619, 'Tahseen', 'Zaid', 35, 'DF', '619.png', 0, 0, 0),
(620, 'Iqbal', 'Zidane', 35, 'MF', '620.png', 0, 0, 0),
(621, 'Tanaka', 'Ao', 22, 'MF', '621.png', 0, 0, 0),
(622, 'Ueda', 'Ayase', 22, 'FW', '622.png', 0, 0, 0),
(623, 'Seko', 'Ayumu', 22, 'DF,MF', '623.png', 0, 0, 0),
(624, 'Kamada', 'Daichi', 22, 'MF', '624.png', 0, 0, 0),
(625, 'Maeda', 'Daizen', 22, 'MF', '625.png', 0, 0, 0),
(626, 'Ito', 'Hiroki', 22, 'DF', '626.png', 0, 0, 0),
(627, 'Suzuki', 'Junnosuke', 22, 'DF', '627.png', 0, 0, 0),
(628, 'Itō', 'Junya', 22, 'MF', '628.png', 0, 0, 0),
(629, 'Sano', 'Kaishū', 22, 'MF', '629.png', 0, 0, 0),
(630, 'Gotō', 'Keisuke', 22, 'FW', '630.png', 0, 0, 0),
(631, 'Ōsako', 'Keisuke', 22, 'GK', '631.png', 0, 0, 0),
(632, 'Nakamura', 'Keito', 22, 'MF', '632.png', 0, 0, 0),
(633, 'Shiogai', 'Kento', 22, 'FW', '633.png', 0, 0, 0),
(634, 'Itakura', 'Ko', 22, 'DF', '634.png', 0, 0, 0),
(635, 'Ogawa', 'Kōki', 22, 'FW', '635.png', 0, 0, 0),
(636, 'Doan', 'Ritsu', 22, 'MF', '636.png', 0, 0, 0),
(637, 'Taniguchi', 'Shogo', 22, 'DF', '637.png', 0, 0, 0),
(638, 'Machino', 'Shuto', 22, 'FW', '638.png', 0, 0, 0),
(639, 'Kubo', 'Takefusa', 22, 'MF', '639.png', 0, 0, 0),
(640, 'Tomiyasu', 'Takehiro', 22, 'DF', '640.png', 0, 0, 0),
(641, 'Hayakawa', 'Tomoki', 22, 'GK', '641.png', 0, 0, 0),
(642, 'Watanabe', 'Tsuyoshi', 22, 'DF', '642.png', 0, 0, 0),
(643, 'Suzuki', 'Yuito', 22, 'FW,MF', '643.png', 0, 0, 0),
(644, 'Sugawara', 'Yukinari', 22, 'DF,FW', '644.png', 0, 0, 0),
(645, 'Nagatomo', 'Yūto', 22, 'DF,MF', '645.png', 0, 0, 0),
(646, 'Suzuki', 'Zion', 22, 'GK', '646.png', 0, 0, 0),
(647, 'Al-Fakhouri', 'Abdallah', 40, 'GK', '647.png', 0, 0, 0),
(648, 'Nasib', 'Abdallah', 40, 'DF', '648.png', 0, 0, 0),
(649, 'Azaizeh', 'Ali', 40, 'MF', '649.png', 0, 0, 0),
(650, 'Olwan', 'Ali', 40, 'MF', '650.png', 0, 0, 0),
(651, 'Jamous', 'Amer', 40, 'MF', '651.png', 0, 0, 0),
(652, 'Badawi', 'Anas', 40, 'DF', '652.png', 0, 0, 0),
(653, 'Abu Dahab', 'Husam', 40, 'DF', '653.png', 0, 0, 0),
(654, 'Sadeh', 'Ibrahim', 40, 'MF', '654.png', 0, 0, 0),
(655, 'Haddad', 'Ihsan', 40, 'DF', '655.png', 0, 0, 0),
(656, 'Al-Mardi', 'Mahmoud', 40, 'FW,MF', '656.png', 0, 0, 0),
(657, 'Abualnadi', 'Mo', 40, 'DF', '657.png', 0, 0, 0),
(658, 'Abu Hasheesh', 'Mohammad', 40, 'DF', '658.png', 0, 0, 0),
(659, 'Al-Dawud', 'Mohammad', 40, 'FW,MF', '659.png', 0, 0, 0),
(660, 'Taha', 'Mohammad', 40, 'MF', '660.png', 0, 0, 0),
(661, 'Abu Taha', 'Mohannad', 40, 'DF', '661.png', 0, 0, 0),
(662, 'Al-Taamari', 'Musa', 40, 'FW', '662.png', 0, 0, 0),
(663, 'Al Rashdan', 'Nizar', 40, 'MF', '663.png', 0, 0, 0),
(664, 'Al Rawabdeh', 'Noor', 40, 'MF', '664.png', 0, 0, 0),
(665, 'Bani Attiah', 'Nour', 40, 'GK', '665.png', 0, 0, 0),
(666, 'Al-Fakhouri', 'Odeh', 40, 'MF', '666.png', 0, 0, 0),
(667, 'Ayed', 'Rajaei', 40, 'MF', '667.png', 0, 0, 0),
(668, 'Al-Rosan', 'Saed', 40, 'DF', '668.png', 0, 0, 0),
(669, 'Obaid', 'Salim', 40, 'DF', '669.png', 0, 0, 0),
(670, 'Sharara', '', 40, 'FW', '670.png', 0, 0, 0),
(671, 'Al-Arab', 'Yazan', 40, 'DF', '671.png', 0, 0, 0),
(672, 'Abulaila', 'Yazeed', 40, 'GK', '672.png', 0, 0, 0),
(673, 'Jun-ho', 'Bae', 3, 'FW,MF', '673.png', 1, 0, 0),
(674, 'Gue-sung', 'Cho', 3, 'FW', '674.png', 0, 0, 0),
(675, 'Wi-je', 'Cho', 3, 'DF', '675.png', 1, 0, 0),
(676, 'Ji-sung', 'Eom', 3, 'MF', '676.png', 0, 0, 0),
(677, 'Hee-chan', 'Hwang', 3, 'FW,MF', '677.png', 0, 0, 0),
(678, 'In-beom', 'Hwang', 3, 'MF', '678.png', 0, 0, 0),
(679, 'Castrop', 'Jens', 3, 'MF', '679.png', 0, 0, 0),
(680, 'Hyeon-woo', 'Jo', 3, 'GK', '680.png', 0, 0, 0),
(681, 'Jin-gyu', 'Kim', 3, 'MF', '681.png', 0, 0, 0),
(682, 'Min-jae', 'Kim', 3, 'DF', '682.png', 1, 0, 0),
(683, 'Moon-hwan', 'Kim', 3, 'MF', '683.png', 0, 0, 0),
(684, 'Seung-gyu', 'Kim', 3, 'GK', '684.png', 0, 0, 0),
(685, 'Tae-hyeon', 'Kim', 3, 'DF', '685.png', 0, 0, 0),
(686, 'Dong-gyeong', 'Lee', 3, 'FW,MF', '686.png', 0, 0, 0),
(687, 'Gi-hyuk', 'Lee', 3, 'DF', '687.png', 0, 0, 0),
(688, 'Han-beom', 'Lee', 3, 'DF', '688.png', 0, 0, 0),
(689, 'Jae-sung', 'Lee', 3, 'FW', '689.png', 0, 0, 0),
(690, 'Kang-in', 'Lee', 3, 'FW', '690.png', 0, 0, 0),
(691, 'Tae-seok', 'Lee', 3, 'MF', '691.png', 0, 0, 0),
(692, 'Hyeon-gyu', 'Oh', 3, 'FW', '692.png', 0, 0, 0),
(693, 'Seung-ho', 'Paik', 3, 'MF', '693.png', 0, 0, 0),
(694, 'Jinseob', 'Park', 3, 'DF,MF', '694.png', 0, 0, 0),
(695, 'Young-woo', 'Seol', 3, 'MF', '695.png', 0, 0, 0),
(696, 'Heung-min', 'Son', 3, 'FW', '696.png', 0, 0, 0),
(697, 'Bum-keun', 'Song', 3, 'GK', '697.png', 0, 0, 0),
(698, 'Hyun-jun', 'Yang', 3, 'FW,MF', '698.png', 0, 0, 0),
(699, 'Vega', 'Alexis', 1, 'FW,MF', '699.png', 0, 0, 0),
(700, 'González', 'Armando', 1, 'FW', '700.png', 0, 0, 0),
(701, 'Gutiérrez', 'Brian', 1, 'MF', '701.png', 0, 0, 1),
(702, 'Acevedo', 'Carlos', 1, 'GK', '702.png', 0, 0, 0),
(703, 'Huerta', 'César', 1, 'FW,MF', '703.png', 0, 0, 0),
(704, 'Montes', 'César', 1, 'DF', '704.png', 0, 0, 0),
(705, 'Álvarez', 'Edson', 1, 'DF', '705.png', 0, 0, 0),
(706, 'Lira', 'Erik', 1, 'MF', '706.png', 0, 0, 0),
(707, 'Mora', 'Gilberto', 1, 'MF', '707.png', 0, 0, 0),
(708, 'Martínez Ayala', 'Guillermo', 1, 'FW', '708.png', 0, 0, 0),
(709, 'Ochoa', 'Guillermo', 1, 'GK', '709.png', 0, 0, 0),
(710, 'Reyes', 'Israel', 1, 'DF', '710.png', 0, 0, 0),
(711, 'Gallardo', 'Jesús', 1, 'DF', '711.png', 0, 0, 0),
(712, 'Vásquez', 'Johan', 1, 'DF', '712.png', 0, 0, 0),
(713, 'Sánchez', 'Jorge', 1, 'DF', '713.png', 0, 0, 0),
(714, 'Quiñones', 'Julián', 1, 'MF,FW', '714.png', 0, 0, 0),
(715, 'Chávez', 'Luis', 1, 'MF', '715.png', 0, 0, 0),
(716, 'Romo', 'Luis', 1, 'MF', '716.png', 0, 0, 0),
(717, 'Chávez', 'Mateo', 1, 'DF', '717.png', 0, 0, 0),
(718, 'Vargas', 'Obed', 1, 'MF', '718.png', 0, 0, 0),
(719, 'Pineda', 'Orbelín', 1, 'FW,MF', '719.png', 0, 0, 0),
(720, 'Jiménez', 'Raúl', 1, 'FW', '720.png', 0, 0, 0),
(721, 'Rangel', 'Raúl', 1, 'GK', '721.png', 0, 0, 0),
(722, 'Alvarado', 'Roberto', 1, 'MF,FW', '722.png', 0, 0, 0),
(723, 'Giménez', 'Santiago', 1, 'FW', '723.png', 0, 0, 0),
(724, 'Fidalgo', 'Álvaro', 1, 'MF', '724.png', 0, 0, 0),
(725, 'Hakimi', 'Achraf', 10, 'DF', '725.png', 0, 0, 0),
(726, 'Reda Tagnaouti', 'Ahmed', 10, 'GK', '726.png', 0, 0, 0),
(727, 'Sbai', 'Amine', 10, 'FW,MF', '727.png', 0, 0, 0),
(728, 'Salah-Eddine', 'Anass', 10, 'DF', '728.png', 0, 0, 0),
(729, 'El Kaabi', 'Ayoub', 10, 'FW,MF', '729.png', 0, 0, -1),
(730, 'Amaimouni', 'Ayoube', 10, 'MF', '730.png', 0, 0, 0),
(731, 'Bouaddi', 'Ayyoub', 10, 'MF', '731.png', 0, 0, 0),
(732, 'Ounahi', 'Azzedine', 10, 'MF', '732.png', 0, 0, 0),
(733, 'El Khannouss', 'Bilal', 10, 'MF', '733.png', 0, 0, 0),
(734, 'Díaz', 'Brahim', 10, 'MF', '734.png', 0, 0, 0),
(735, 'Riad', 'Chadi', 10, 'DF', '735.png', 0, 0, 0),
(736, 'Talbi', 'Chemsdine', 10, 'MF', '736.png', 0, 0, 0),
(737, 'Yassine', 'Gessime', 10, 'MF', '737.png', 0, 0, 0),
(738, 'Saibari', 'Ismael', 10, 'FW', '738.png', 0, 0, 0),
(739, 'Diop', 'Issa', 10, 'DF', '739.png', 0, 0, 0),
(740, 'Saâdane', 'Marwane', 10, 'DF,MF', '740.png', 0, 0, 0),
(741, 'Munir', '', 10, 'GK', '741.png', 0, 0, 0),
(742, 'El Aynaoui', 'Neil', 10, 'MF', '742.png', 0, 0, 0),
(743, 'Mazraoui', 'Noussair', 10, 'DF', '743.png', 0, 0, 0),
(744, 'Halhal', 'Redouane', 10, 'DF', '744.png', 0, 0, 0),
(745, 'El Mourabet', 'Samir', 10, 'MF', '745.png', 0, 0, 0),
(746, 'Amrabat', 'Sofyan', 10, 'DF,MF', '746.png', 0, 0, 0),
(747, 'Rahimi', 'Soufiane', 10, 'FW', '747.png', 0, 0, 0),
(748, 'Bounou', 'Yassine', 10, 'GK', '748.png', 0, 0, 0),
(749, 'Belammari', 'Youssef', 10, 'DF', '749.png', 0, 0, 0),
(750, 'El Ouahdi', 'Zakaria', 10, 'DF,MF', '750.png', 0, 0, 0),
(751, 'Verbruggen', 'Bart', 21, 'GK', '751.png', 0, 0, 0),
(752, 'Brobbey', 'Brian', 21, 'FW', '752.png', 0, 0, 0),
(753, 'Gakpo', 'Cody', 21, 'FW', '753.png', 0, 0, 0),
(754, 'Summerville', 'Crysencio', 21, 'FW', '754.png', 0, 0, 0),
(755, 'Dumfries', 'Denzel', 21, 'DF', '755.png', 0, 0, 0),
(756, 'Malen', 'Donyell', 21, 'FW', '756.png', 0, 0, 0),
(757, 'de Jong', 'Frenkie', 21, 'MF', '757.png', 0, 0, 0),
(758, 'Til', 'Guus', 21, 'FW,MF', '758.png', 0, 0, 0),
(759, 'Paul van Hecke', 'Jan', 21, 'DF', '759.png', 0, 0, 0),
(760, 'Hato', 'Jorrel', 21, 'DF', '760.png', 0, 0, 0),
(761, 'Kluivert', 'Justin', 21, 'FW,MF', '761.png', 0, 0, 0),
(762, 'Geertruida', 'Lutsharel', 21, 'DF', '762.png', 0, 0, 0),
(763, 'Flekken', 'Mark', 21, 'GK', '763.png', 0, 0, 0),
(764, 'de Roon', 'Marten', 21, 'DF,MF', '764.png', 0, 0, 0),
(765, 'Wieffer', 'Mats', 21, 'DF,MF', '765.png', 0, 0, 0),
(766, 'Memphis', '', 21, 'FW,MF', '766.png', 0, 0, 0),
(767, 'van de Ven', 'Micky', 21, 'DF', '767.png', 0, 0, 0),
(768, 'Aké', 'Nathan', 21, 'DF,MF', '768.png', 0, 0, 0),
(769, 'Lang', 'Noa', 21, 'FW,MF', '769.png', 0, 0, 0),
(770, 'Timber', 'Quinten', 21, 'MF', '770.png', 0, 0, 0),
(771, 'Roefs', 'Robin', 21, 'GK', '771.png', 0, 0, 0),
(772, 'Gravenberch', 'Ryan', 21, 'MF', '772.png', 0, 0, 0),
(773, 'Koopmeiners', 'Teun', 21, 'DF,MF', '773.png', 0, 0, 0),
(774, 'Reijnders', 'Tijjani', 21, 'MF', '774.png', 0, 0, 0),
(775, 'van Dijk', 'Virgil', 21, 'DF', '775.png', 0, 0, 0),
(776, 'Weghorst', 'Wout', 21, 'FW', '776.png', 0, 0, 0),
(777, 'Paulsen', 'Alex', 28, 'GK', '777.png', 0, 0, 0),
(778, 'Rufer', 'Alex', 28, 'MF', '778.png', 0, 0, 0),
(779, 'Old', 'Ben', 28, 'MF', '779.png', 0, 0, 0),
(780, 'Waine', 'Ben', 28, 'FW', '780.png', 0, 0, 0),
(781, 'Elliot', 'Callan', 28, 'DF', '781.png', 0, 0, 0),
(782, 'McCowatt', 'Callum', 28, 'MF', '782.png', 0, 0, 0),
(783, 'Wood', 'Chris', 28, 'FW', '783.png', 0, 0, 0),
(784, 'Just', 'Elijah', 28, 'MF', '784.png', 0, 0, 0),
(785, 'Surman', 'Finn', 28, 'DF', '785.png', 0, 0, 0),
(786, 'de Vries', 'Francis', 28, 'DF', '786.png', 0, 0, 0),
(787, 'Randall', 'Jesse', 28, 'MF', '787.png', 0, 0, 0),
(788, 'Bell', 'Joe', 28, 'MF', '788.png', 0, 0, 0),
(789, 'Barbarouses', 'Kosta', 28, 'FW,MF', '789.png', 0, 0, 0),
(790, 'Bayliss', 'Lachlan', 28, 'MF', '790.png', 0, 0, 0),
(791, 'Cacace', 'Liberato', 28, 'DF', '791.png', 0, 0, 0),
(792, 'Rogerson', 'Logan', 28, 'FW,MF', '792.png', 0, 0, 0),
(793, 'Stamenic', 'Marko', 28, 'MF', '793.png', 0, 0, 0),
(794, 'Crocombe', 'Max', 28, 'GK', '794.png', 0, 0, 0),
(795, 'Boxall', 'Michael', 28, 'DF', '795.png', 0, 0, 0),
(796, 'Woud', 'Michael', 28, 'GK', '796.png', 0, 0, 0),
(797, 'Pijnaker', 'Nando', 28, 'DF', '797.png', 0, 0, 0),
(798, 'Thomas', 'Ryan', 28, 'FW,MF', '798.png', 0, 0, 0),
(799, 'Singh', 'Sarpreet', 28, 'MF', '799.png', 0, 0, 0),
(800, 'Payne', 'Tim', 28, 'DF', '800.png', 0, 0, 0),
(801, 'Smith', 'Tommy', 28, 'DF', '801.png', 0, 0, 0),
(802, 'Bindon', 'Tyler', 28, 'DF', '802.png', 0, 0, 0),
(803, 'Sørloth', 'Alexander', 36, 'FW', '803.png', 0, 0, 0),
(804, 'Schjelderup', 'Andreas', 36, 'FW,MF', '804.png', 0, 0, 0),
(805, 'Nusa', 'Antonio', 36, 'FW', '805.png', 0, 0, 0),
(806, 'Møller Wolfe', 'David', 36, 'DF', '806.png', 0, 0, 0),
(807, 'Selvik', 'Egil', 36, 'GK', '807.png', 0, 0, 0),
(808, 'Haaland', 'Erling', 36, 'FW', '808.png', 0, 0, 0),
(809, 'André Bjørkan', 'Fredrik', 36, 'DF', '809.png', 0, 0, 0),
(810, 'Aursnes', 'Fredrik', 36, 'MF', '810.png', 0, 0, 0),
(811, 'Falchener', 'Henrik', 36, 'DF', '811.png', 0, 0, 0),
(812, 'Petter Hauge', 'Jens', 36, 'DF,FW', '812.png', 0, 0, 0),
(813, 'Ryerson', 'Julian', 36, 'DF', '813.png', 0, 0, 0),
(814, 'Strand Larsen', 'Jørgen', 36, 'FW', '814.png', 0, 0, 0),
(815, 'Thorstvedt', 'Kristian', 36, 'MF', '815.png', 0, 0, 0),
(816, 'Ajer', 'Kristoffer', 36, 'DF', '816.png', 0, 0, 0),
(817, 'Østigård', 'Leo', 36, 'DF,FW', '817.png', 0, 0, 0),
(818, 'Pedersen', 'Marcus', 36, 'DF,MF', '818.png', 0, 0, 0),
(819, 'Ødegaard', 'Martin', 36, 'MF', '819.png', 0, 0, 0),
(820, 'Thorsby', 'Morten', 36, 'MF', '820.png', 0, 0, 0),
(821, 'Bobb', 'Oscar', 36, 'FW,MF', '821.png', 0, 0, 0),
(822, 'Berg', 'Patrick', 36, 'DF,MF', '822.png', 0, 0, 0),
(823, 'Berge', 'Sander', 36, 'MF', '823.png', 0, 0, 0),
(824, 'Tangvik', 'Sander', 36, 'GK', '824.png', 0, 0, 0),
(825, 'Langås', 'Sondre', 36, 'DF', '825.png', 0, 0, 0),
(826, 'Aasgaard', 'Thelo', 36, 'MF', '826.png', 0, 0, 0),
(827, 'Heggem', 'Torbjørn', 36, 'DF', '827.png', 0, 0, 0),
(828, 'Nyland', 'Ørjan', 36, 'GK', '828.png', 0, 0, 0),
(829, 'Carrasquilla', 'Adalberto', 48, 'MF', '829.png', 0, 0, 0),
(830, 'Quintero', 'Alberto', 48, 'FW,MF', '830.png', 0, 0, 0),
(831, 'Andrade Cedeño', 'Andrés', 48, 'DF', '831.png', 0, 0, 0),
(832, 'Godoy', 'Aníbal', 48, 'MF', '832.png', 0, 0, 0),
(833, 'Londoño', 'Azarías', 48, 'MF', '833.png', 0, 0, 0),
(834, 'Harvey', 'Carlos', 48, 'MF', '834.png', 0, 0, 0),
(835, 'Waterman', 'Cecilio', 48, 'FW', '835.png', 0, 0, 0),
(836, 'Martínez', 'Cristian', 48, 'FW', '836.png', 0, 0, 0),
(837, 'Blackman', 'César', 48, 'MF', '837.png', 0, 0, 0),
(838, 'Samudio', 'César', 48, 'GK', '838.png', 0, 0, 0),
(839, 'Yanis', 'César', 48, 'MF', '839.png', 0, 0, 0),
(840, 'Fariña', 'Edgardo', 48, 'DF', '840.png', 0, 0, 0),
(841, 'Davis', 'Erick', 48, 'DF', '841.png', 0, 0, 0),
(842, 'Escobar', 'Fidel', 48, 'DF', '842.png', 0, 0, 0),
(843, 'Díaz', 'Ismael', 48, 'FW,MF', '843.png', 0, 0, 0),
(844, 'Ramos', 'Jiovany', 48, 'DF', '844.png', 0, 0, 0),
(845, 'Gutiérrez', 'Jorge', 48, 'DF', '845.png', 0, 0, 0),
(846, 'Córdoba', 'José', 48, 'DF', '846.png', 0, 0, 0),
(847, 'Fajardo', 'José', 48, 'FW', '847.png', 0, 0, 0),
(848, 'Luis Rodríguez', 'José', 48, 'FW', '848.png', 0, 0, 0),
(849, 'Mejía', 'Luis', 48, 'GK', '849.png', 0, 0, 0),
(850, 'Amir Murillo', 'Michael', 48, 'MF', '850.png', 0, 0, 0),
(851, 'Mosquera', 'Orlando', 48, 'GK', '851.png', 0, 0, 0),
(852, 'Miller', 'Roderick', 48, 'DF', '852.png', 0, 0, 0),
(853, 'Rodríguez', 'Tomás', 48, 'FW', '853.png', 0, 0, 0),
(854, 'Bárcenas', 'Yoel', 48, 'MF', '854.png', 0, 0, 0),
(855, 'Maidana', 'Alexandro', 14, 'DF', '855.png', 0, 0, 0),
(856, 'Cubas', 'Andrés', 14, 'MF', '856.png', 0, 0, 0),
(857, 'Sanabria', 'Antonio', 14, 'FW', '857.png', 0, 0, 0),
(858, 'Ojeda', 'Braian', 14, 'MF', '858.png', 0, 0, 0),
(859, 'Bobadilla', 'Damián', 14, 'MF', '859.png', 0, 0, 0),
(860, 'Gómez', 'Diego', 14, 'MF', '860.png', 0, 0, 0),
(861, 'Balbuena', 'Fabián', 14, 'DF', '861.png', 0, 0, 0),
(862, 'Ávalos', 'Gabriel', 14, 'FW', '862.png', 0, 0, 0),
(863, 'Olveira', 'Gastón', 14, 'GK', '863.png', 0, 0, 0),
(864, 'Fernández', 'Gatito', 14, 'GK', '864.png', 0, 0, 0),
(865, 'Caballero', 'Gustavo', 14, 'FW,MF', '865.png', 0, 0, 0),
(866, 'Gómez', 'Gustavo', 14, 'DF', '866.png', 0, 0, 0),
(867, 'Velásquez', 'Gustavo', 14, 'DF', '867.png', 0, 0, 0),
(868, 'Pitta', 'Isidro', 14, 'FW', '868.png', 0, 0, 0),
(869, 'Canale', 'José', 14, 'DF', '869.png', 0, 0, 0),
(870, 'Cáceres', 'Juan', 14, 'DF', '870.png', 0, 0, 0),
(871, 'Enciso', 'Julio', 14, 'FW', '871.png', 0, 0, 0),
(872, 'Alonso', 'Júnior', 14, 'DF', '872.png', 0, 0, 0),
(873, 'Kaku', '', 14, 'MF', '873.png', 0, 0, 0),
(874, 'Galarza', 'Matías', 14, 'MF', '874.png', 0, 0, 0),
(875, 'Mauricio', '', 14, 'MF', '875.png', 0, 0, 0),
(876, 'Almirón', 'Miguel', 14, 'MF', '876.png', 0, 0, 0),
(877, 'Alderete', 'Omar', 14, 'DF', '877.png', 0, 0, 0),
(878, 'Gill', 'Orlando', 14, 'GK', '878.png', 0, 0, 0),
(879, 'Sosa', 'Ramón', 14, 'FW,MF', '879.png', 0, 0, 0),
(880, 'Arce', 'Álex', 14, 'FW', '880.png', 0, 0, 0),
(881, 'Silva', 'Bernardo', 41, 'MF', '881.png', 0, 0, 0),
(882, 'Fernandes', 'Bruno', 41, 'MF', '882.png', 0, 0, 0),
(883, 'Ronaldo', 'Cristiano', 41, 'FW', '883.png', 0, 0, 0),
(884, 'Costa', 'Diogo', 41, 'GK', '884.png', 0, 0, 0),
(885, 'Dalot', 'Diogo', 41, 'DF,MF', '885.png', 0, 0, 0),
(886, 'Conceição', 'Francisco', 41, 'MF', '886.png', 0, 0, 0),
(887, 'Trincão', 'Francisco', 41, 'FW,MF', '887.png', 0, 0, 0),
(888, 'Guedes', 'Gonçalo', 41, 'FW,MF', '888.png', 0, 0, 0),
(889, 'Inácio', 'Gonçalo', 41, 'DF', '889.png', 0, 0, 0),
(890, 'Ramos', 'Gonçalo', 41, 'FW', '890.png', 0, 0, 0),
(891, 'Sá', 'José', 41, 'GK', '891.png', 0, 0, 0),
(892, 'Cancelo', 'João', 41, 'DF', '892.png', 0, 0, 0),
(893, 'Félix', 'João', 41, 'FW,MF', '893.png', 0, 0, 0),
(894, 'Neves', 'João', 41, 'MF', '894.png', 0, 0, 0),
(895, 'Nunes', 'Matheus', 41, 'DF,MF', '895.png', 0, 0, 0),
(896, 'Mendes', 'Nuno', 41, 'DF', '896.png', 0, 0, 0);
INSERT INTO `JOUEUR` (`id`, `nom`, `prenom`, `equipe_id`, `poste`, `image_joueur`, `buts`, `passe_dec`, `nb_hdm`) VALUES
(897, 'Semedo', 'Nélson', 41, 'DF,MF', '897.png', 0, 0, 0),
(898, 'Neto', 'Pedro', 41, 'MF', '898.png', 0, 0, 0),
(899, 'Leão', 'Rafael', 41, 'FW,MF', '899.png', 0, 0, 0),
(900, 'Veiga', 'Renato', 41, 'DF', '900.png', 0, 0, 0),
(901, 'Silva', 'Rui', 41, 'GK', '901.png', 0, 0, 0),
(902, 'Dias', 'Rúben', 41, 'DF,MF', '902.png', 0, 0, 0),
(903, 'Neves', 'Rúben', 41, 'MF', '903.png', 0, 0, 0),
(904, 'Costa', 'Samu', 41, 'MF', '904.png', 0, 0, 0),
(905, 'Araújo', 'Tomás', 41, 'DF', '905.png', 0, 0, 0),
(906, 'Vitinha', '', 41, 'MF', '906.png', 0, 0, 0),
(907, 'Hatem', 'Abdulaziz', 7, 'MF', '907.png', 0, 0, 0),
(908, 'Al-Ganehi', 'Ahmed', 7, 'FW', '908.png', 0, 0, 0),
(909, 'Alaaeldin', 'Ahmed', 7, 'FW', '909.png', 0, 0, -1),
(910, 'Fathy', 'Ahmed', 7, 'MF', '910.png', 0, 0, 0),
(911, 'Afif', 'Akram', 7, 'MF,FW', '911.png', 0, 0, 1),
(912, 'Al-Hussain', 'Al-Hashmi', 7, 'MF', '912.png', 0, 0, 0),
(913, 'Ali', 'Almoez', 7, 'FW', '913.png', 0, 0, 0),
(914, 'Madibo', 'Assim', 7, 'MF', '914.png', 0, 0, 0),
(915, 'Al-Oui', 'Ayoub', 7, 'DF', '915.png', 0, 0, 0),
(916, 'Khoukhi', 'Boualem', 7, 'DF', '916.png', 1, 0, 0),
(917, 'Junior', 'Edmilson', 7, 'MF,FW', '917.png', 1, 0, 0),
(918, 'Al-Haydos', 'Hassan', 7, 'FW,MF', '918.png', 0, 0, 0),
(919, 'Ahmed', 'Homam', 7, 'DF', '919.png', 0, 0, 0),
(920, 'Laye', 'Issa', 7, 'MF', '920.png', 0, 0, 0),
(921, 'Gaber', 'Jassem', 7, 'MF', '921.png', 0, 0, 0),
(922, 'Boudiaf', 'Karim', 7, 'DF,MF', '922.png', 0, 0, 0),
(923, 'Mendes', 'Lucas', 7, 'DF', '923.png', 0, 0, 0),
(924, 'Abunada', 'Mahmoud', 7, 'GK', '924.png', 0, 0, 0),
(925, 'Barsham', 'Meshaal', 7, 'GK', '925.png', 0, 0, 0),
(926, 'Manai', 'Mohamed', 7, 'DF', '926.png', 0, 0, 0),
(927, 'Muntari', 'Mohammed', 7, 'FW', '927.png', 0, 0, 0),
(928, 'Ró-Ró', '', 7, 'DF', '928.png', 0, 0, 0),
(929, 'Zakaria', 'Salah', 7, 'GK', '929.png', 0, 0, 0),
(930, 'Al-Brake', 'Sultan', 7, 'DF', '930.png', 0, 0, 0),
(931, 'Jamshid', 'Tahsin', 7, 'FW', '931.png', 0, 0, 0),
(932, 'Abdurisag', 'Yusuf', 7, 'FW', '932.png', 0, 0, 0),
(933, 'Al-Amri', 'Abdulelah', 31, 'DF', '933.png', 0, 0, 0),
(934, 'Al-Hamdan', 'Abdullah', 31, 'FW', '934.png', 0, 0, 0),
(935, 'Al-Khaibari', 'Abdullah', 31, 'MF', '935.png', 0, 0, 0),
(936, 'Al-Kassar', 'Ahmed', 31, 'GK', '936.png', 0, 0, 0),
(937, 'Al Hejji', 'Alaa', 31, 'MF', '937.png', 0, 0, 0),
(938, 'Lajami', 'Ali', 31, 'DF', '938.png', 0, 0, 0),
(939, 'Majrashi', 'Ali', 31, 'DF', '939.png', 0, 0, 0),
(940, 'Yahya', 'Ayman', 31, 'MF', '940.png', 0, 0, 0),
(941, 'Al-Buraikan', 'Firas', 31, 'FW', '941.png', 0, 0, 0),
(942, 'Al Tambakti', 'Hassan', 31, 'DF', '942.png', 0, 0, 0),
(943, 'Kadesh', 'Hassan', 31, 'DF', '943.png', 0, 0, 0),
(944, 'Thakri', 'Jehad', 31, 'DF', '944.png', 0, 0, 0),
(945, 'Al Ghannam', 'Khalid', 31, 'MF', '945.png', 0, 0, 0),
(946, 'Kanno', 'Mohamed', 31, 'MF', '946.png', 0, 0, 0),
(947, 'Abu Al-Shamat', 'Mohammed', 31, 'MF', '947.png', 0, 0, 0),
(948, 'Al-Owais', 'Mohammed', 31, 'GK', '948.png', 0, 0, 0),
(949, 'Al-Harbi', 'Moteb', 31, 'DF', '949.png', 0, 0, 0),
(950, 'Al Juwayr', 'Musab', 31, 'MF,FW', '950.png', 0, 0, 0),
(951, 'Al-Dawsari', 'Nasser', 31, 'MF', '951.png', 0, 0, 0),
(952, 'Al Aqidi', 'Nawaf', 31, 'GK', '952.png', 0, 0, 0),
(953, 'Boushal', 'Nawaf', 31, 'DF', '953.png', 0, 0, 0),
(954, 'Al-Shehri', 'Saleh', 31, 'FW', '954.png', 0, 0, 0),
(955, 'Al-Dawsari', 'Salem', 31, 'MF', '955.png', 0, 0, 0),
(956, 'Abdulhamid', 'Saud', 31, 'DF', '956.png', 0, 0, 0),
(957, 'Mendash', 'Sultan', 31, 'FW,MF', '957.png', 0, 0, 0),
(958, 'Al Johani', 'Ziyad', 31, 'MF', '958.png', 0, 0, 0),
(959, 'Hickey', 'Aaron', 12, 'DF', '959.png', 0, 0, 0),
(960, 'Robertson', 'Andy', 12, 'DF', '960.png', 0, 0, 0),
(961, 'Gunn', 'Angus', 12, 'GK', '961.png', 0, 0, 0),
(962, 'Ralston', 'Anthony', 12, 'DF', '962.png', 0, 0, 0),
(963, 'Gannon-Doak', 'Ben', 12, 'MF', '963.png', 0, 0, -1),
(964, 'Adams', 'Ché', 12, 'FW', '964.png', 0, 0, 0),
(965, 'Gordon', 'Craig', 12, 'GK', '965.png', 0, 0, 0),
(966, 'Hyam', 'Dominic', 12, 'DF', '966.png', 0, 0, 0),
(967, 'Curtis', 'Findlay', 12, 'MF', '967.png', 0, 0, 0),
(968, 'Hirst', 'George', 12, 'FW', '968.png', 0, 0, 0),
(969, 'Hanley', 'Grant', 12, 'DF', '969.png', 0, 0, 0),
(970, 'Hendry', 'Jack', 12, 'DF', '970.png', 0, 0, 0),
(971, 'McGinn', 'John', 12, 'MF', '971.png', 0, 0, 0),
(972, 'Souttar', 'John', 12, 'DF', '972.png', 0, 0, 0),
(973, 'McLean', 'Kenny', 12, 'DF,MF', '973.png', 0, 0, 0),
(974, 'Tierney', 'Kieran', 12, 'MF', '974.png', 0, 0, 0),
(975, 'Shankland', 'Lawrence', 12, 'FW', '975.png', 0, 0, 0),
(976, 'Ferguson', 'Lewis', 12, 'MF', '976.png', 0, 0, 0),
(977, 'Kelly', 'Liam', 12, 'GK', '977.png', 0, 0, 0),
(978, 'Dykes', 'Lyndon', 12, 'FW,MF', '978.png', 0, 0, 0),
(979, 'Patterson', 'Nathan', 12, 'DF', '979.png', 0, 0, 0),
(980, 'Stewart', 'Ross', 12, 'FW', '980.png', 0, 0, 0),
(981, 'Christie', 'Ryan', 12, 'MF', '981.png', 0, 0, 0),
(982, 'McKenna', 'Scott', 12, 'DF', '982.png', 0, 0, 0),
(983, 'McTominay', 'Scott', 12, 'MF', '983.png', 0, 0, 0),
(984, 'Fletcher', 'Tyler', 12, 'MF', '984.png', 0, 0, 0),
(985, 'Seck', 'Abdoulaye', 34, 'DF', '985.png', 0, 0, 0),
(986, 'Mendy', 'Antoine', 34, 'DF', '986.png', 0, 0, 0),
(987, 'Diao', 'Assane', 34, 'MF', '987.png', 0, 0, 0),
(988, 'Dieng', 'Bamba', 34, 'FW', '988.png', 0, 0, 0),
(989, 'Sapoko Ndiaye', 'Bara', 34, 'MF', '989.png', 0, 0, 0),
(990, 'Ndiaye', 'Cherif', 34, 'FW,MF', '990.png', 0, 0, 0),
(991, 'Hadji Malick Diouf', 'El', 34, 'DF', '991.png', 0, 0, 0),
(992, 'Diarra', 'Habib', 34, 'MF', '992.png', 0, 0, 0),
(993, 'Mbaye', 'Ibrahim', 34, 'FW', '993.png', 0, 0, 0),
(994, 'Gueye', 'Idrissa', 34, 'MF', '994.png', 0, 0, 0),
(995, 'Ndiaye', 'Iliman', 34, 'FW,MF', '995.png', 0, 0, 0),
(996, 'Jakobs', 'Ismail', 34, 'DF,MF', '996.png', 0, 0, 0),
(997, 'Sarr', 'Ismaila', 34, 'MF', '997.png', 0, 0, 0),
(998, 'Koulibaly', 'Kalidou', 34, 'DF', '998.png', 0, 0, 0),
(999, 'Diatta', 'Krépin', 34, 'DF', '999.png', 0, 0, 0),
(1000, 'Camara', 'Lamine', 34, 'MF', '1000.png', 0, 0, 0),
(1001, 'Sarr', 'Mamadou', 34, 'DF', '1001.png', 0, 0, 0),
(1002, 'Diaw', 'Mory', 34, 'GK', '1002.png', 0, 0, 0),
(1003, 'Niakhaté', 'Moussa', 34, 'DF', '1003.png', 0, 0, 0),
(1004, 'Jackson', 'Nicolas', 34, 'FW', '1004.png', 0, 0, 0),
(1005, 'Gueye', 'Pape', 34, 'MF', '1005.png', 0, 0, 0),
(1006, 'Matar Sarr', 'Pape', 34, 'MF', '1006.png', 0, 0, 0),
(1007, 'Ciss', 'Pathé', 34, 'DF,MF', '1007.png', 0, 0, 0),
(1008, 'Mané', 'Sadio', 34, 'MF', '1008.png', 0, 0, 0),
(1009, 'Diouf', 'Yehvann', 34, 'GK', '1009.png', 0, 0, 0),
(1010, 'Mendy', 'Édouard', 34, 'GK', '1010.png', 0, 0, 0),
(1011, 'Modiba', 'Aubrey', 2, 'DF', '1011.png', 0, 0, 0),
(1012, 'Cross', 'Bradley', 2, 'DF', '1012.png', 0, 0, 0),
(1013, 'Makgopa', 'Evidence', 2, 'FW', '1013.png', 0, 0, 0),
(1014, 'Okon', 'Ime', 2, 'DF', '1014.png', 0, 0, 0),
(1015, 'Rayners', 'Iqraam', 2, 'FW', '1015.png', 0, 0, -1),
(1016, 'Adams', 'Jayden', 2, 'MF', '1016.png', 0, 0, 0),
(1017, 'Sebelebele', 'Kamogelo', 2, 'DF,MF', '1017.png', 0, 0, 0),
(1018, 'Mudau', 'Khuliso', 2, 'DF', '1018.png', 0, 0, 0),
(1019, 'Ndamane', 'Khulumani', 2, 'DF', '1019.png', 0, 0, 0),
(1020, 'Foster', 'Lyle', 2, 'FW', '1020.png', 0, 0, 0),
(1021, 'Mbokazi', 'Mbekezeli', 2, 'DF', '1021.png', 0, 0, 0),
(1022, 'Sibisi', 'Nkosinathi', 2, 'DF', '1022.png', 0, 0, 0),
(1023, 'Makhanya', 'Olwethu', 2, 'DF', '1023.png', 0, 0, 0),
(1024, 'Appollis', 'Oswin', 2, 'FW', '1024.png', 0, 0, 0),
(1025, 'Mofokeng', 'Relebohile', 2, 'MF', '1025.png', 0, 0, 0),
(1026, 'Goss', 'Ricardo', 2, 'GK', '1026.png', 0, 0, 0),
(1027, 'Williams', 'Ronwen', 2, 'GK', '1027.png', 0, 0, 0),
(1028, 'Kabini', 'Samukele', 2, 'DF', '1028.png', 0, 0, 0),
(1029, 'Chaine', 'Sipho', 2, 'GK', '1029.png', 0, 0, 0),
(1030, 'Sithole', 'Sphephelo', 2, 'MF', '1030.png', 0, 0, 0),
(1031, 'Mokoena', 'Teboho', 2, 'MF', '1031.png', 0, 0, 0),
(1032, 'Matuludi', 'Thabang', 2, 'DF', '1032.png', 0, 0, 0),
(1033, 'Mbatha', 'Thalente', 2, 'MF', '1033.png', 0, 0, 0),
(1034, 'Maseko', 'Thapelo', 2, 'FW', '1034.png', 0, 0, 0),
(1035, 'Zwane', 'Themba', 2, 'FW,MF', '1035.png', 0, 0, 0),
(1036, 'Moremi', 'Tshepang', 2, 'MF', '1036.png', 0, 0, 0),
(1037, 'Laporte', 'Aymeric', 29, 'DF', '1037.png', 0, 0, 0),
(1038, 'Iglesias', 'Borja', 29, 'FW', '1038.png', 0, 0, 0),
(1039, 'Olmo', 'Dani', 29, 'MF', '1039.png', 0, 0, 0),
(1040, 'Raya', 'David', 29, 'GK', '1040.png', 0, 0, 0),
(1041, 'García', 'Eric', 29, 'DF,MF', '1041.png', 0, 0, 0),
(1042, 'Ruiz Peña', 'Fabián', 29, 'MF', '1042.png', 0, 0, 0),
(1043, 'Torres', 'Ferrán', 29, 'FW', '1043.png', 0, 0, 0),
(1044, 'Gavi', '', 29, 'FW', '1044.png', 0, 0, 0),
(1045, 'García', 'Joan', 29, 'GK', '1045.png', 0, 0, 0),
(1046, 'Yamal', 'Lamine', 29, 'FW', '1046.png', 0, 0, 0),
(1047, 'Cucurella', 'Marc', 29, 'DF', '1047.png', 0, 0, 0),
(1048, 'Pubill', 'Marc', 29, 'DF', '1048.png', 0, 0, 0),
(1049, 'Llorente', 'Marcos', 29, 'DF', '1049.png', 0, 0, 0),
(1050, 'Zubimendi', 'Martín', 29, 'MF', '1050.png', 0, 0, 0),
(1051, 'Merino', 'Mikel', 29, 'MF', '1051.png', 0, 0, 0),
(1052, 'Oyarzabal', 'Mikel', 29, 'FW', '1052.png', 0, 0, 0),
(1053, 'Williams', 'Nico', 29, 'MF', '1053.png', 0, 0, 0),
(1054, 'Cubarsí', 'Pau', 29, 'DF', '1054.png', 0, 0, 0),
(1055, 'Pedri', '', 29, 'MF', '1055.png', 0, 0, 0),
(1056, 'Porro', 'Pedro', 29, 'DF', '1056.png', 0, 0, 0),
(1057, 'Rodri', '', 29, 'MF', '1057.png', 0, 0, 0),
(1058, 'Simón', 'Unai', 29, 'GK', '1058.png', 0, 0, 0),
(1059, 'Muñoz', 'Víctor', 29, 'MF', '1059.png', 0, 0, 0),
(1060, 'Pino', 'Yéremy', 29, 'FW,MF', '1060.png', 0, 0, 0),
(1061, 'Baena', 'Álex', 29, 'FW', '1061.png', 0, 0, 0),
(1062, 'Grimaldo', 'Álex', 29, 'DF,MF', '1062.png', 0, 0, 0),
(1063, 'Bernhardsson', 'Alexander', 23, 'MF', '1063.png', 0, 0, 0),
(1064, 'Isak', 'Alexander', 23, 'FW', '1064.png', 0, 0, 0),
(1065, 'Elanga', 'Anthony', 23, 'FW,MF', '1065.png', 0, 0, 0),
(1066, 'Nygren', 'Benjamin', 23, 'MF', '1066.png', 0, 0, 0),
(1067, 'Zeneli', 'Besfort', 23, 'MF', '1067.png', 0, 0, 0),
(1068, 'Starfelt', 'Carl', 23, 'DF', '1068.png', 0, 0, 0),
(1069, 'Svensson', 'Daniel', 23, 'DF,MF', '1069.png', 0, 0, 0),
(1070, 'Stroud', 'Elliot', 23, 'MF', '1070.png', 0, 0, 0),
(1071, 'Smith', 'Eric', 23, 'DF,MF', '1071.png', 0, 0, 0),
(1072, 'Gudmundsson', 'Gabriel', 23, 'MF', '1072.png', 0, 0, 0),
(1073, 'Lagerbielke', 'Gustaf', 23, 'DF', '1073.png', 0, 0, 0),
(1074, 'Nilsson', 'Gustaf', 23, 'FW', '1074.png', 0, 0, 0),
(1075, 'Johansson', 'Herman', 23, 'MF', '1075.png', 0, 0, 0),
(1076, 'Ekdal', 'Hjalmar', 23, 'DF', '1076.png', 0, 0, 0),
(1077, 'Hien', 'Isak', 23, 'DF', '1077.png', 0, 0, 0),
(1078, 'Widell Zetterström', 'Jacob', 23, 'GK', '1078.png', 0, 0, 0),
(1079, 'Karlström', 'Jesper', 23, 'MF', '1079.png', 0, 0, 0),
(1080, 'Sema', 'Ken', 23, 'FW,MF', '1080.png', 0, 0, 0),
(1081, 'Nordfeldt', 'Kristoffer', 23, 'GK', '1081.png', 0, 0, 0),
(1082, 'Bergvall', 'Lucas', 23, 'MF', '1082.png', 0, 0, 0),
(1083, 'Svanberg', 'Mattias', 23, 'MF', '1083.png', 0, 0, 0),
(1084, 'Ali', 'Taha', 23, 'FW,MF', '1084.png', 0, 0, 0),
(1085, 'Lindelöf', 'Victor', 23, 'DF', '1085.png', 0, 0, 0),
(1086, 'Gyökeres', 'Viktor', 23, 'FW', '1086.png', 0, 0, 0),
(1087, 'Johansson', 'Viktor', 23, 'GK', '1087.png', 0, 0, 0),
(1088, 'Ayari', 'Yasin', 23, 'MF', '1088.png', 0, 0, 0),
(1089, 'Jashari', 'Ardon', 8, 'MF', '1089.png', 0, 0, 0),
(1090, 'Amenda', 'Aurèle', 8, 'DF', '1090.png', 0, 0, 0),
(1091, 'Embolo', 'Breel', 8, 'FW', '1091.png', 0, 0, 0),
(1092, 'Itten', 'Cedric', 8, 'FW,MF', '1092.png', 0, 0, 0),
(1093, 'Fassnacht', 'Christian', 8, 'FW,MF', '1093.png', 0, 0, 0),
(1094, 'Ndoye', 'Dan', 8, 'MF,FW', '1094.png', 0, 0, 0),
(1095, 'Zakaria', 'Denis', 8, 'DF', '1095.png', 0, 0, 0),
(1096, 'Sow', 'Djibril', 8, 'MF', '1096.png', 0, 0, 0),
(1097, 'Cömert', 'Eray', 8, 'DF', '1097.png', 0, 0, 0),
(1098, 'Rieder', 'Fabian', 8, 'MF', '1098.png', 0, 0, 0),
(1099, 'Xhaka', 'Granit', 8, 'MF', '1099.png', 0, 3, 0),
(1100, 'Kobel', 'Gregor', 8, 'GK', '1100.png', 0, 0, 0),
(1101, 'Manzambi', 'Johan', 8, 'MF', '1101.png', 0, 0, 0),
(1102, 'Jaquez', 'Luca', 8, 'DF', '1102.png', 0, 0, 0),
(1103, 'Akanji', 'Manuel', 8, 'DF', '1103.png', 0, 0, 0),
(1104, 'Keller', 'Marvin', 8, 'GK', '1104.png', 0, 0, 0),
(1105, 'Aebischer', 'Michel', 8, 'MF,FW', '1105.png', 0, 0, 0),
(1106, 'Muheim', 'Miro', 8, 'DF,MF', '1106.png', 0, 0, 0),
(1107, 'Elvedi', 'Nico', 8, 'DF', '1107.png', 0, 0, 0),
(1108, 'Okafor', 'Noah', 8, 'FW,MF', '1108.png', 0, 0, 1),
(1109, 'Freuler', 'Remo', 8, 'MF', '1109.png', 0, 0, 0),
(1110, 'Rodríguez', 'Ricardo', 8, 'DF', '1110.png', 0, 0, 0),
(1111, 'Vargas', 'Ruben', 8, 'MF', '1111.png', 3, 0, 0),
(1112, 'Widmer', 'Silvan', 8, 'DF', '1112.png', 0, 0, 0),
(1113, 'Mvogo', 'Yvon', 8, 'GK', '1113.png', 0, 0, 0),
(1114, 'Amdouni', 'Zeki', 8, 'FW,MF', '1114.png', 0, 0, 0),
(1115, 'Arous', 'Adem', 24, 'DF', '1115.png', 0, 0, 0),
(1116, 'Abdi', 'Ali', 24, 'DF', '1116.png', 0, 0, 0),
(1117, 'Ben Slimane', 'Anis', 24, 'MF,FW', '1117.png', 0, 0, 0),
(1118, 'Dahmen', 'Aymen', 24, 'GK', '1118.png', 0, 0, 0),
(1119, 'Bronn', 'Dylan', 24, 'DF', '1119.png', 0, 0, 0),
(1120, 'Achouri', 'Elias', 24, 'FW,MF', '1120.png', 0, 0, 0),
(1121, 'Saad', 'Elias', 24, 'MF,FW', '1121.png', 0, 0, 0),
(1122, 'Skhiri', 'Ellyes', 24, 'MF', '1122.png', 0, 0, 0),
(1123, 'Chaouat', 'Firas', 24, 'FW', '1123.png', 0, 0, 0),
(1124, 'Mahmoud', 'Hadj', 24, 'MF', '1124.png', 0, 0, 0),
(1125, 'Mejbri', 'Hannibal', 24, 'MF', '1125.png', 0, 0, 0),
(1126, 'Mastouri', 'Hazem', 24, 'FW', '1126.png', 0, 0, 0),
(1127, 'Gharbi', 'Ismaël', 24, 'MF', '1127.png', 0, 0, 0),
(1128, 'Ayari', 'Khalil', 24, 'FW', '1128.png', 0, 0, 0),
(1129, 'Amine Ben Hamida', 'Mohamed', 24, 'DF', '1129.png', 0, 0, 0),
(1130, 'Talbi', 'Montassar', 24, 'DF', '1130.png', 0, 0, 0),
(1131, 'Ben Ouanes', 'Mortadha', 24, 'DF,MF', '1131.png', 0, 0, 0),
(1132, 'Chamakh', 'Mouhib', 24, 'GK', '1132.png', 0, 0, 0),
(1133, 'Neffati', 'Moutaz', 24, 'DF', '1133.png', 0, 0, 0),
(1134, 'Rekik', 'Omar', 24, 'DF', '1134.png', 0, 0, 0),
(1135, 'Chikhaoui', 'Raed', 24, 'DF', '1135.png', 0, 0, 0),
(1136, 'Khedira', 'Rani', 24, 'MF', '1136.png', 0, 0, 0),
(1137, 'Elloumi', 'Rayan', 24, 'FW', '1137.png', 0, 0, 0),
(1138, 'Ben Hassen', 'Sabri', 24, 'GK', '1138.png', 0, 0, 0),
(1139, 'Tounekti', 'Sebastian', 24, 'FW', '1139.png', 0, 0, 0),
(1140, 'Valery', 'Yan', 24, 'DF', '1140.png', 0, 0, 0),
(1141, 'Bardakcı', 'Abdülkerim', 16, 'DF', '1141.png', 0, 0, 0),
(1142, 'Bayındır', 'Altay', 16, 'GK', '1142.png', 0, 0, 0),
(1143, 'Güler', 'Arda', 16, 'MF', '1143.png', 0, 0, 0),
(1144, 'Alper Yılmaz', 'Barış', 16, 'MF', '1144.png', 0, 0, 0),
(1145, 'Uzun', 'Can', 16, 'MF', '1145.png', 0, 0, 0),
(1146, 'Gül', 'Deniz', 16, 'FW', '1146.png', 0, 0, 0),
(1147, 'Elmalı', 'Eren', 16, 'DF', '1147.png', 0, 0, 0),
(1148, 'Kadioglu', 'Ferdi', 16, 'DF', '1148.png', 0, 0, 0),
(1149, 'Çalhanoğlu', 'Hakan', 16, 'MF', '1149.png', 0, 0, 0),
(1150, 'Ayhan', 'Kaan', 16, 'DF,MF', '1150.png', 0, 0, 0),
(1151, 'Yıldız', 'Kenan', 16, 'MF', '1151.png', 0, 0, 0),
(1152, 'Aktürkoğlu', 'Kerem', 16, 'FW', '1152.png', 0, 0, 0),
(1153, 'Demiral', 'Merih', 16, 'DF', '1153.png', 0, 0, 0),
(1154, 'Günok', 'Mert', 16, 'GK', '1154.png', 0, 0, 0),
(1155, 'Müldür', 'Mert', 16, 'DF', '1155.png', 0, 0, 0),
(1156, 'Kökçü', 'Orkun', 16, 'MF', '1156.png', 0, 0, 0),
(1157, 'Kabak', 'Ozan', 16, 'DF', '1157.png', 0, 0, 0),
(1158, 'Aydın', 'Oğuz', 16, 'MF', '1158.png', 0, 0, 0),
(1159, 'Özcan', 'Salih', 16, 'MF', '1159.png', 0, 0, 0),
(1160, 'Akaydın', 'Samet', 16, 'DF', '1160.png', 0, 0, 0),
(1161, 'Çakır', 'Uğurcan', 16, 'GK', '1161.png', 0, 0, 0),
(1162, 'Akgün', 'Yunus', 16, 'MF', '1162.png', 0, 0, 0),
(1163, 'Çelik', 'Zeki', 16, 'DF', '1163.png', 0, 0, 0),
(1164, 'Söyüncü', 'Çağlar', 16, 'DF', '1164.png', 0, 0, 0),
(1165, 'Can Kahveci', 'İrfan', 16, 'MF', '1165.png', 0, 0, 0),
(1166, 'Yüksek', 'İsmail', 16, 'MF', '1166.png', 0, 0, 0),
(1167, 'Zendejas', 'Alejandro', 13, 'FW,MF', '1167.png', 1, 0, 0),
(1168, 'Freeman', 'Alex', 13, 'DF', '1168.png', 0, 0, 0),
(1169, 'Robinson', 'Antonee', 13, 'MF,DF', '1169.png', 1, 0, 0),
(1170, 'Trusty', 'Auston', 13, 'DF', '1170.png', 1, 0, 0),
(1171, 'Aaronson', 'Brenden', 13, 'FW,MF', '1171.png', 0, 0, 0),
(1172, 'Brady', 'Chris', 13, 'GK', '1172.png', 0, 0, 0),
(1173, 'Richards', 'Chris', 13, 'DF', '1173.png', 1, 0, 0),
(1174, 'Pulisic', 'Christian', 13, 'MF', '1174.png', 1, 0, 0),
(1175, 'Roldan', 'Cristian', 13, 'MF', '1175.png', 0, 0, 0),
(1176, 'Balogun', 'Folarin', 13, 'FW', '1176.png', 0, 0, 0),
(1177, 'Reyna', 'Gio', 13, 'MF', '1177.png', 0, 0, 0),
(1178, 'Wright', 'Haji', 13, 'FW,MF', '1178.png', 0, 0, 0),
(1179, 'Scally', 'Joe', 13, 'DF,MF', '1179.png', 0, 0, 0),
(1180, 'Tillman', 'Malik', 13, 'MF', '1180.png', 0, 0, 0),
(1181, 'McKenzie', 'Mark', 13, 'DF', '1181.png', 0, 0, 0),
(1182, 'Freese', 'Matt', 13, 'GK', '1182.png', 0, 0, 0),
(1183, 'Turner', 'Matt', 13, 'GK', '1183.png', 0, 0, 0),
(1184, 'Arfsten', 'Max', 13, 'MF', '1184.png', 0, 0, 0),
(1185, 'Robinson', 'Miles', 13, 'DF', '1185.png', 0, 0, 0),
(1186, 'Pepi', 'Ricardo', 13, 'FW', '1186.png', 0, 0, 0),
(1187, 'Berhalter', 'Sebastian', 13, 'MF', '1187.png', 0, 0, 0),
(1188, 'Dest', 'Sergiño', 13, 'MF', '1188.png', 0, 0, 0),
(1189, 'Ream', 'Tim', 13, 'DF', '1189.png', 0, 0, 0),
(1190, 'Weah', 'Timothy', 13, 'DF,FW', '1190.png', 0, 0, 0),
(1191, 'Adams', 'Tyler', 13, 'MF', '1191.png', 0, 0, 0),
(1192, 'McKennie', 'Weston', 13, 'MF', '1192.png', 0, 0, 0),
(1193, 'Canobbio', 'Agustín', 32, 'FW', '1193.png', 0, 0, 0),
(1194, 'Rodríguez', 'Brian', 32, 'FW,MF', '1194.png', 0, 0, 0),
(1195, 'Núñez', 'Darwin', 32, 'FW', '1195.png', 0, 0, 0),
(1196, 'Martínez', 'Emiliano', 32, 'MF', '1196.png', 0, 0, 0),
(1197, 'Pellistri', 'Facundo', 32, 'FW,MF', '1197.png', 0, 0, 0),
(1198, 'Valverde', 'Federico', 32, 'MF', '1198.png', 0, 0, 0),
(1199, 'Viñas', 'Federico', 32, 'FW', '1199.png', 0, 0, 0),
(1200, 'Muslera', 'Fernando', 32, 'GK', '1200.png', 0, 0, 0),
(1201, 'Varela', 'Guillermo', 32, 'DF', '1201.png', 0, 0, 0),
(1202, 'Piquerez', 'Joaquín', 32, 'DF,MF', '1202.png', 0, 0, 0),
(1203, 'María Giménez', 'José', 32, 'DF', '1203.png', 0, 0, 0),
(1204, 'Manuel Sanabria', 'Juan', 32, 'DF', '1204.png', 0, 0, 0),
(1205, 'Ugarte', 'Manuel', 32, 'MF', '1205.png', 0, 0, 0),
(1206, 'Olivera', 'Mathías', 32, 'DF', '1206.png', 0, 0, 0),
(1207, 'Viña', 'Matías', 32, 'DF', '1207.png', 0, 0, 0),
(1208, 'Araújo', 'Maxi', 32, 'MF,FW', '1208.png', 0, 0, 0),
(1209, 'De La Cruz', 'Nicolás', 32, 'MF', '1209.png', 0, 0, 0),
(1210, 'Aguirre', 'Rodrigo', 32, 'FW', '1210.png', 0, 0, 0),
(1211, 'Bentancur', 'Rodrigo', 32, 'MF', '1211.png', 0, 0, 0),
(1212, 'Zalazar', 'Rodrigo', 32, 'FW,MF', '1212.png', 0, 0, 0),
(1213, 'Bueno', 'Santiago', 32, 'DF', '1213.png', 0, 0, 0),
(1214, 'Mele', 'Santiago', 32, 'GK', '1214.png', 0, 0, 0),
(1215, 'Cáceres', 'Sebastián', 32, 'DF', '1215.png', 0, 0, 0),
(1216, 'Rochet', 'Sergio', 32, 'GK', '1216.png', 0, 0, 0),
(1217, 'Fayzullayev', 'Abbosbek', 43, 'MF', '1217.png', 0, 0, 0),
(1218, 'Khusanov', 'Abdukodir', 43, 'DF', '1218.png', 0, 0, 0),
(1219, 'Abdullaev', 'Abdulla', 43, 'DF', '1219.png', 0, 0, 0),
(1220, 'Nematov', 'Abduvohid', 43, 'GK', '1220.png', 0, 0, 0),
(1221, 'Mozgovoy', 'Akmal', 43, 'MF', '1221.png', 0, 0, 0),
(1222, 'Ulmasaliev', 'Avazbek', 43, 'DF', '1222.png', 0, 0, 0),
(1223, 'Gʻaniyev', 'Aziz', 43, 'MF', '1223.png', 0, 0, 0),
(1224, 'Amonov', 'Azizbek', 43, 'FW', '1224.png', 0, 0, 0),
(1225, 'Karimov', 'Bekhruz', 43, 'DF', '1225.png', 0, 0, 0),
(1226, 'Ergashev', 'Botirali', 43, 'GK', '1226.png', 0, 0, 0),
(1227, 'Khamdamov', 'Dostonbek', 43, 'MF', '1227.png', 0, 0, 0),
(1228, 'Shomurodov', 'Eldor', 43, 'FW', '1228.png', 0, 0, 0),
(1229, 'Sayfiev', 'Farrukh', 43, 'DF,MF', '1229.png', 0, 0, 0),
(1230, 'Sergeev', 'Igor', 43, 'FW', '1230.png', 0, 0, 0),
(1231, 'Urozov', 'Jakhongir', 43, 'DF', '1231.png', 0, 0, 0),
(1232, 'Iskanderov', 'Jamshid', 43, 'FW,MF', '1232.png', 0, 0, 0),
(1233, 'Alijonov', 'Khojiakbar', 43, 'DF', '1233.png', 0, 0, 0),
(1234, 'Hamrobekov', 'Odiljon', 43, 'MF', '1234.png', 0, 0, 0),
(1235, 'Urunov', 'Oston', 43, 'MF', '1235.png', 0, 0, 0),
(1236, 'Shukurov', 'Otabek', 43, 'MF', '1236.png', 0, 0, 0),
(1237, 'Jiyanov', 'Ruslanbek', 43, 'FW', '1237.png', 0, 0, 0),
(1238, 'Ashurmatov', 'Rustam', 43, 'DF', '1238.png', 0, 0, 0),
(1239, 'Esanov', 'Sherzod', 43, 'MF', '1239.png', 0, 0, 0),
(1240, 'Nasrullaev', 'Sherzod', 43, 'DF', '1240.png', 0, 0, 0),
(1241, 'Eshmurodov', 'Umar', 43, 'DF', '1241.png', 0, 0, 0),
(1242, 'Yusupov', 'Utkir', 43, 'GK', '1242.png', 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `LEAGUE`
--

CREATE TABLE `LEAGUE` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `createur_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `LEAGUE`
--

INSERT INTO `LEAGUE` (`id`, `nom`, `createur_id`) VALUES
(1, 'CentraleCDM', 2),
(6, 'MaLigue', 2),
(7, 'TWE', 1);

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
  `mvpfifa_id` int NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `MATCHS`
--

INSERT INTO `MATCHS` (`id`, `date_match`, `equipe_dom_id`, `equipe_ext_id`, `score_dom`, `score_ext`, `mvpfifa_id`) VALUES
(1, '2026-06-11 13:00:00', 1, 2, 2, 0, 701),
(2, '2026-06-11 20:00:00', 3, 4, 2, 1, 675),
(3, '2026-06-12 15:00:00', 5, 6, 1, 1, 210),
(4, '2026-06-12 18:00:00', 13, 14, 4, 1, 1169),
(5, '2026-06-13 21:00:00', 11, 12, 0, 1, 543),
(6, '2026-06-13 12:00:00', 15, 16, 2, 0, 55),
(7, '2026-06-13 18:00:00', 9, 10, 1, 1, 156),
(8, '2026-06-13 12:00:00', 7, 8, 1, 1, 911),
(9, '2026-06-14 18:00:00', 19, 20, 0, 0, 393),
(10, '2026-06-14 12:00:00', 17, 18, 7, 1, 492),
(11, '2026-06-14 15:00:00', 21, 22, 0, 0, 625),
(12, '2026-06-14 21:00:00', 23, 24, 0, 0, 1065),
(13, '2026-06-15 18:00:00', 27, 28, 0, 0, 781),
(14, '2026-06-15 12:00:00', 29, 30, 0, 0, 1039),
(15, '2026-06-15 15:00:00', 25, 26, 0, 0, 419),
(16, '2026-06-15 21:00:00', 31, 32, 0, 0, 935),
(17, '2026-06-16 15:00:00', 33, 34, 0, 0, 989),
(18, '2026-06-16 18:00:00', 35, 36, 0, 0, 597),
(19, '2026-06-16 20:00:00', 37, 38, 0, 0, 5),
(20, '2026-06-16 12:00:00', 39, 40, 0, 0, 81),
(21, '2026-06-17 12:00:00', 41, 42, 0, 0, 263),
(22, '2026-06-17 15:00:00', 45, 46, 0, 0, 443),
(23, '2026-06-17 18:00:00', 43, 44, 0, 0, 237),
(24, '2026-06-17 21:00:00', 47, 48, 0, 0, 520),
(25, '2026-06-18 13:00:00', 1, 3, 0, 0, 677),
(26, '2026-06-18 12:00:00', 8, 6, 0, 0, 1091),
(27, '2026-06-18 15:00:00', 5, 7, 0, 0, 911),
(28, '2026-06-18 18:00:00', 4, 2, 0, 0, 339),
(29, '2026-06-19 21:00:00', 9, 11, 0, 0, 547),
(30, '2026-06-19 18:00:00', 12, 10, 0, 0, 961),
(31, '2026-06-19 12:00:00', 13, 15, 0, 0, 57),
(32, '2026-06-19 15:00:00', 16, 14, 0, 0, 1143),
(33, '2026-06-20 19:00:00', 17, 19, 0, 0, 367),
(34, '2026-06-20 19:00:00', 20, 18, 0, 0, 391),
(35, '2026-06-20 12:00:00', 21, 23, 0, 0, 1067),
(36, '2026-06-20 15:00:00', 24, 22, 0, 0, 1117),
(37, '2026-06-21 15:00:00', 25, 27, 0, 0, 573),
(38, '2026-06-21 12:00:00', 28, 26, 0, 0, 779),
(39, '2026-06-21 18:00:00', 29, 31, 0, 0, 937),
(40, '2026-06-21 21:00:00', 32, 30, 0, 0, 1195),
(41, '2026-06-22 17:00:00', 33, 35, 0, 0, 599),
(42, '2026-06-22 14:00:00', 36, 34, 0, 0, 805),
(43, '2026-06-22 20:00:00', 37, 39, 0, 0, 83),
(44, '2026-06-22 11:00:00', 40, 38, 0, 0, 649),
(45, '2026-06-23 15:00:00', 41, 43, 0, 0, 1221),
(46, '2026-06-23 19:00:00', 48, 46, 0, 0, 831),
(47, '2026-06-23 12:00:00', 44, 42, 0, 0, 263),
(48, '2026-06-23 21:00:00', 45, 47, 0, 0, 443),
(49, '2026-06-24 18:00:00', 12, 9, 0, 0, -1),
(50, '2026-06-24 18:00:00', 10, 11, 0, 0, -1),
(51, '2026-06-24 19:00:00', 2, 3, 0, 0, -1),
(52, '2026-06-24 19:00:00', 4, 1, 0, 0, -1),
(53, '2026-06-25 18:00:00', 6, 5, 0, 0, -1),
(54, '2026-06-25 18:00:00', 7, 8, 0, 3, 1108),
(55, '2026-06-25 16:00:00', 18, 19, 0, 2, -1),
(56, '2026-06-25 16:00:00', 20, 17, 0, 1, -1),
(57, '2026-06-25 19:00:00', 14, 15, 0, 0, -1),
(58, '2026-06-25 19:00:00', 16, 13, 0, 0, -1),
(59, '2026-06-26 18:00:00', 22, 23, 0, 0, -1),
(60, '2026-06-26 18:00:00', 24, 21, 0, 0, -1),
(61, '2026-06-26 15:00:00', 34, 35, 0, 0, -1),
(62, '2026-06-26 15:00:00', 36, 33, 0, 0, -1),
(63, '2026-06-26 20:00:00', 26, 27, 0, 0, -1),
(64, '2026-06-26 20:00:00', 28, 25, 0, 0, -1),
(65, '2026-06-27 17:00:00', 30, 31, 0, 0, -1),
(66, '2026-06-27 17:00:00', 32, 29, 0, 0, -1),
(67, '2026-06-27 17:00:00', 48, 45, 0, 0, -1),
(68, '2026-06-27 17:00:00', 46, 47, 0, 0, -1),
(69, '2026-06-27 20:00:00', 38, 39, 1, 0, 3),
(70, '2026-06-27 20:00:00', 40, 37, 0, 0, -1),
(71, '2026-06-27 19:30:00', 44, 41, 0, 0, -1),
(72, '2026-06-27 19:30:00', 42, 43, 0, 0, -1);

-- --------------------------------------------------------

--
-- Structure de la table `MEMBRE_LEAGUE`
--

CREATE TABLE `MEMBRE_LEAGUE` (
  `user_id` int NOT NULL,
  `league_id` int NOT NULL,
  `date_adhesion` date DEFAULT (curdate()),
  `dernier_msg_lu` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `MEMBRE_LEAGUE`
--

INSERT INTO `MEMBRE_LEAGUE` (`user_id`, `league_id`, `date_adhesion`, `dernier_msg_lu`) VALUES
(1, 1, '2026-06-23', 2),
(1, 6, '2026-06-23', 0),
(1, 7, '2026-06-26', 3),
(2, 1, '2026-06-23', 2),
(2, 6, '2026-06-23', 0),
(2, 7, '2026-06-26', 3),
(4, 1, '2026-06-26', 0);

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

--
-- Déchargement des données de la table `MESSAGE_CHAT`
--

INSERT INTO `MESSAGE_CHAT` (`id`, `league_id`, `user_id`, `contenu`, `date_envoi`) VALUES
(1, 1, 2, 'salut !', '2026-06-23 17:18:23'),
(2, 1, 1, 'ça marche ', '2026-06-23 21:41:56'),
(3, 7, 2, 'twe', '2026-06-26 11:26:05');

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
  `pdp` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `blacklist` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `UTILISATEUR`
--

INSERT INTO `UTILISATEUR` (`id`, `pseudo`, `mot_de_passe`, `equipe_pref_id`, `joueur_pref_id`, `pdp`, `admin`, `blacklist`) VALUES
(1, 'basile', 'basile', 33, 475, 'France.svg', 1, 0),
(2, 'Hugo', 'hugo', 45, 450, 'Angleterre.svg', 0, 0),
(4, 'Tom', 'tom', 33, NULL, 'France.svg', 0, 1);

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `INVITATION`
--
ALTER TABLE `INVITATION`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `JOUEUR`
--
ALTER TABLE `JOUEUR`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1243;

--
-- AUTO_INCREMENT pour la table `LEAGUE`
--
ALTER TABLE `LEAGUE`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `MATCHS`
--
ALTER TABLE `MATCHS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pour la table `MESSAGE_CHAT`
--
ALTER TABLE `MESSAGE_CHAT`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`match_id`) REFERENCES `MATCHS` (`id`);

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
  ADD CONSTRAINT `message_chat_ibfk_1` FOREIGN KEY (`league_id`) REFERENCES `LEAGUE` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_chat_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `UTILISATEUR` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
