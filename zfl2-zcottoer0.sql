-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 25 avr. 2022 à 16:50
-- Version du serveur :  10.3.9-MariaDB-log
-- Version de PHP :  7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `zfl2-zcottoer0`
--

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `pseudo_cpt_pro`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `pseudo_cpt_pro` (
`cpt_pseudo` varchar(15)
);

-- --------------------------------------------------------

--
-- Structure de la table `t_actualite_actu`
--

CREATE TABLE `t_actualite_actu` (
  `actu_numero` int(11) NOT NULL,
  `actu_titre` varchar(50) NOT NULL,
  `actu_texte` varchar(1000) NOT NULL,
  `actu_DateDePublication` date NOT NULL,
  `cpt_pseudo` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_actualite_actu`
--

INSERT INTO `t_actualite_actu` (`actu_numero`, `actu_titre`, `actu_texte`, `actu_DateDePublication`, `cpt_pseudo`) VALUES
(1, 'Exposition repoussee.', 'L\'exposition est repoussee sine die pour des raisons sanitaires.', '2020-05-13', 'admin1'),
(2, 'Ouverture de l\'expo !', 'L\'exposition ouvrira ses portes le 27 Janvier 20221.', '2022-01-27', 'gEstionnaire'),
(3, 'Problemes de connexion.', 'Il est actuellement impossible de se connecter pour certains comptes, nous travaillons sur le problème.', '2021-06-17', 'admin2'),
(4, 'Problemes de connexion resolus.', 'Tout les comptes peuvent de nouveau se connecter.', '2021-06-19', 'admin2'),
(5, 'Retrait du dragon.', 'Apres reflexion, nous avons decide de retirer le dragon des bateaux presentes, nous nous excusons pour la gene occasionne.', '2022-01-18', 'JCOrg');

-- --------------------------------------------------------

--
-- Structure de la table `t_commentaire_com`
--

CREATE TABLE `t_commentaire_com` (
  `com_numero` int(11) NOT NULL,
  `com_DateHeure` datetime NOT NULL,
  `com_text` varchar(500) NOT NULL,
  `com_etat` char(1) NOT NULL,
  `vis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_commentaire_com`
--

INSERT INTO `t_commentaire_com` (`com_numero`, `com_DateHeure`, `com_text`, `com_etat`, `vis_id`) VALUES
(2, '2022-01-27 11:23:00', 'Tres interessant, dommage qu\'aucune video ne montrant ces bateaux ne soit presente.', 'V', 3),
(3, '2022-01-27 06:02:00', 'Exposition faite par des singes !.', 'C', 10),
(8, '2022-04-25 16:46:47', 'test \'#', 'V', 20);

-- --------------------------------------------------------

--
-- Structure de la table `t_compte_cpt`
--

CREATE TABLE `t_compte_cpt` (
  `cpt_MotDePasse` char(32) NOT NULL,
  `cpt_pseudo` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_compte_cpt`
--

INSERT INTO `t_compte_cpt` (`cpt_MotDePasse`, `cpt_pseudo`) VALUES
('afdcb96aa045caa2bd583e000793c7b7', 'JCOrg'),
('cf99246597362d5b7edd4a6a49eff2a9', 'Jean-Pierre'),
('670653bb508c3d430923c1568bfe95c0', 'PLGOrg'),
('81dc9bdb52d04dc20036dbd8313ed055', 'ZinZolin'),
('7682fe272099ea26efe39c890b33675b', 'admin1'),
('5eb4edc0b4ef47b031808b09e0204e5a', 'admin2'),
('1578e13d98f3cc95845b25b1c0e8e339', 'admin3'),
('a86ec119dc1ed0a2b6fd0925317efba9', 'alouette'),
('98abb15e560057e55e4e99187702ed4e', 'gEstionnaire'),
('557c318d87e9fc12f90395bb4a7a79c1', 'icinonplus'),
('cef87c0e4824e01937c863a5997df6ca', 'lepiratedu29'),
('0a2993f807cac25b70b5670cdd6f10f4', 'max235');

-- --------------------------------------------------------

--
-- Structure de la table `t_configuration_conf`
--

CREATE TABLE `t_configuration_conf` (
  `conf_expo_id` int(11) NOT NULL,
  `conf_intitule` varchar(50) NOT NULL,
  `conf_DateDeDebut` datetime NOT NULL,
  `conf_DateDeFin` datetime NOT NULL,
  `conf_presentation` varchar(200) NOT NULL,
  `conf_lieu` varchar(100) NOT NULL,
  `conf_DateDeVernissage` datetime NOT NULL,
  `conf_TexteDeBienvenue` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_configuration_conf`
--

INSERT INTO `t_configuration_conf` (`conf_expo_id`, `conf_intitule`, `conf_DateDeDebut`, `conf_DateDeFin`, `conf_presentation`, `conf_lieu`, `conf_DateDeVernissage`, `conf_TexteDeBienvenue`) VALUES
(1, 'Voile legere.', '2022-01-27 18:00:00', '2022-06-27 18:00:00', 'Presentation de bateaux de regate \"classiques\" en voile legere.', 'UBO', '2021-01-28 06:30:00', 'Bienvenue !');

-- --------------------------------------------------------

--
-- Structure de la table `t_exposant_expo`
--

CREATE TABLE `t_exposant_expo` (
  `expo_identifiant` int(11) NOT NULL,
  `expo_nom` varchar(60) NOT NULL,
  `expo_prenom` varchar(60) DEFAULT NULL,
  `expo_biographie` varchar(500) DEFAULT NULL,
  `expo_email` varchar(60) DEFAULT NULL,
  `expo_UrlSite` varchar(200) DEFAULT NULL,
  `expo_CheminPhoto` varchar(200) DEFAULT NULL,
  `cpt_pseudo` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_exposant_expo`
--

INSERT INTO `t_exposant_expo` (`expo_identifiant`, `expo_nom`, `expo_prenom`, `expo_biographie`, `expo_email`, `expo_UrlSite`, `expo_CheminPhoto`, `cpt_pseudo`) VALUES
(1, 'Kirby', 'Bruce', '(1929 - 2021)', NULL, NULL, 'https://www.sail-world.com/photos/sailworld/photos_2012_3/std_Bruce%20Kirby1.jpg', 'gEstionnaire'),
(2, 'Morelli', NULL, NULL, NULL, NULL, NULL, 'gEstionnaire'),
(3, 'Melvin', NULL, NULL, NULL, NULL, NULL, 'gEstionnaire'),
(4, 'Herbulot', 'Jean-Jacques', '(1909 - 1997)', NULL, NULL, 'http://3.bp.blogspot.com/-NhE7GJk7u2w/TcpVSRpfuHI/AAAAAAAACUQ/subsCOEUaTA/s1600/jjherbulot.jpg', 'gEstionnaire'),
(5, 'Morrison', 'Phil', '(1946 - ?)', NULL, NULL, NULL, 'gEstionnaire'),
(6, 'Beithwate', 'Julian', '(1957 - ?)', NULL, NULL, NULL, 'gEstionnaire'),
(7, 'Mills', 'Clark', NULL, NULL, NULL, 'https://www.optiworld.org/uploaded_files/photos/e6acf4b0f69f6f6e60e9a815938aa1ff_slide_440x810.JPG', 'gEstionnaire'),
(8, 'Corner', 'Andre', '(1912 - 2003)', NULL, NULL, NULL, 'gEstionnaire'),
(9, 'March', 'Rodney', NULL, NULL, NULL, NULL, 'gEstionnaire'),
(10, 'Pierce', 'Terry', NULL, NULL, NULL, NULL, 'gEstionnaire'),
(11, 'White', 'Reg', '(1935 - 2010)', NULL, NULL, 'https://sailboatdata.com/storage/images/designer/photo/reg_white.jpg', 'gEstionnaire');

-- --------------------------------------------------------

--
-- Structure de la table `t_oeuvre_oeu`
--

CREATE TABLE `t_oeuvre_oeu` (
  `oeu_code` int(11) NOT NULL,
  `oeu_intitule` varchar(20) NOT NULL,
  `oeu_DateDeCreation` date DEFAULT NULL,
  `oeu_description` varchar(200) NOT NULL,
  `oeu_CheminPhoto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_oeuvre_oeu`
--

INSERT INTO `t_oeuvre_oeu` (`oeu_code`, `oeu_intitule`, `oeu_DateDeCreation`, `oeu_description`, `oeu_CheminPhoto`) VALUES
(1, 'Laser', '1970-01-01', 'Deriveur solitaire, serie olympique.', '1'),
(2, 'Nacra 17', '2011-01-01', 'Catamaran double, serie olympique.', '2\r\n'),
(3, 'Moth', '1929-01-01', 'Deriveur solitaire.', '3'),
(4, 'Caravelle', '1953-01-01', 'Deriveur double.', '4'),
(5, 'RS 500', '2006-01-01', 'Deriveur double.', '5'),
(6, '49er', '1996-01-01', 'Deriveur solitaire, serie olympique.', '6'),
(7, 'optimist', '1947-01-01', 'Deriveur solitaire.', '7'),
(8, '470', '1962-01-01', 'Deriveur double, serie olympique.', '8\r\n'),
(9, 'Tornado', '1966-01-01', 'Catamaran double, ancienne serie olympique.', '9');

-- --------------------------------------------------------

--
-- Structure de la table `t_presentation_pres`
--

CREATE TABLE `t_presentation_pres` (
  `expo_identifiant` int(11) NOT NULL,
  `oeu_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_presentation_pres`
--

INSERT INTO `t_presentation_pres` (`expo_identifiant`, `oeu_code`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 9),
(11, 9);

-- --------------------------------------------------------

--
-- Structure de la table `t_profil_pro`
--

CREATE TABLE `t_profil_pro` (
  `pro_prenom` varchar(60) DEFAULT NULL,
  `pro_nom` varchar(60) DEFAULT NULL,
  `pro_email` varchar(60) NOT NULL,
  `pro_validite` char(1) NOT NULL,
  `pro_role` char(1) NOT NULL,
  `pro_DateDeCreation` date NOT NULL,
  `cpt_pseudo` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_profil_pro`
--

INSERT INTO `t_profil_pro` (`pro_prenom`, `pro_nom`, `pro_email`, `pro_validite`, `pro_role`, `pro_DateDeCreation`, `cpt_pseudo`) VALUES
('Jacques', 'Cerienfer', 'Jacques.Cerienfer@univ-briec.fr', 'A', 'O', '2020-01-29', 'JCOrg'),
('Jean-Pierre', 'Roblochon', 'Jean.Roblochon@univ-briec.fr', 'D', 'D', '2022-01-29', 'Jean-Pierre'),
('Paul-Louis', 'Gourmand', 'Paul-Louis.Gourmand@univ-briec.fr', 'A', 'O', '2020-01-29', 'PLGOrg'),
('Zolin', 'Zin', 'zinzolin@live.fr', 'D', 'O', '2022-04-23', 'ZinZolin'),
('Gerard', 'Du Pont', 'Gerard.DuPont@univ-briec.fr', 'A', 'A', '2020-01-29', 'admin1'),
('Alphonse', 'Le Gall', 'Alphonse.LeGall@univ-briec.fr', 'A', 'A', '2020-01-29', 'admin2'),
('Paul', 'D\'Orleans', 'Paul.DOrleans@univ-briec.fr', 'A', 'A', '2020-01-29', 'admin3'),
('Marguerite', 'Rolland', 'Marguerite.Rolland@univ-briec.fr', 'D', 'D', '2022-01-29', 'alouette'),
('Ges', 'Tionnaire', 'Valerie.Marc@univ-briec.fr', 'A', 'A', '2022-01-27', 'gEstionnaire'),
('Harry', 'Potter', 'Harry.Potter@poudlard.uk', 'D', 'D', '2022-01-29', 'icinonplus'),
('Raoul', 'Dubois', 'lepiratedu29@univ-briec.fr', 'D', 'D', '2022-01-29', 'lepiratedu29'),
('max', 'le max', 'max@gmail.com', 'A', 'O', '2022-04-25', 'max235');

-- --------------------------------------------------------

--
-- Structure de la table `t_visiteurs_vis`
--

CREATE TABLE `t_visiteurs_vis` (
  `vis_id` int(11) NOT NULL,
  `vis_MotDePasse` char(15) NOT NULL,
  `vis_DateHeure` datetime NOT NULL,
  `vis_nom` varchar(60) DEFAULT NULL,
  `vis_prenom` varchar(60) DEFAULT NULL,
  `vis_email` varchar(60) DEFAULT NULL,
  `cpt_pseudo` char(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_visiteurs_vis`
--

INSERT INTO `t_visiteurs_vis` (`vis_id`, `vis_MotDePasse`, `vis_DateHeure`, `vis_nom`, `vis_prenom`, `vis_email`, `cpt_pseudo`) VALUES
(1, 'azertyqsdfghwxc', '2022-01-27 09:42:00', NULL, NULL, NULL, 'gEstionnaire'),
(3, 'azertyqsdfghwxc', '2022-01-27 11:11:00', 'Schwarz', 'Jonas', 'JSchwarz@rot.de', 'gEstionnaire'),
(4, 'azertyqsdfghwxc', '2022-01-27 12:24:00', NULL, NULL, NULL, 'gEstionnaire'),
(5, 'azertyqsdfghwxc', '2022-01-27 01:53:00', NULL, NULL, NULL, 'gEstionnaire'),
(6, 'azertyqsdfghwxc', '2022-01-27 02:42:00', NULL, NULL, NULL, 'gEstionnaire'),
(7, 'azertyqsdfghwxc', '2022-01-27 03:07:00', NULL, NULL, NULL, 'gEstionnaire'),
(8, 'azertyqsdfghwxc', '2022-01-27 03:45:00', NULL, NULL, NULL, 'gEstionnaire'),
(9, 'azertyqsdfghwxc', '2022-01-27 04:18:00', NULL, NULL, NULL, 'gEstionnaire'),
(10, 'azertyqsdfghwxc', '2022-01-27 05:03:00', 'Martin', 'Luc', 'LucMartin@coldmail.com', 'JCOrg'),
(11, 'tergf', '2022-04-21 15:24:14', NULL, NULL, NULL, 'gEstionnaire'),
(20, 'azertazertazert', '2022-04-25 16:45:21', 'te', 'tr', 'dez@fg.ca', 'max235');

-- --------------------------------------------------------

--
-- Structure de la vue `pseudo_cpt_pro`
--
DROP TABLE IF EXISTS `pseudo_cpt_pro`;

CREATE ALGORITHM=UNDEFINED DEFINER=`zcottoer0`@`%` SQL SECURITY DEFINER VIEW `pseudo_cpt_pro`  AS  select `t_compte_cpt`.`cpt_pseudo` AS `cpt_pseudo` from (`t_compte_cpt` join `t_profil_pro` on(`t_compte_cpt`.`cpt_pseudo` = `t_profil_pro`.`cpt_pseudo`)) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_actualite_actu`
--
ALTER TABLE `t_actualite_actu`
  ADD PRIMARY KEY (`actu_numero`),
  ADD KEY `cpt_pseudo` (`cpt_pseudo`);

--
-- Index pour la table `t_commentaire_com`
--
ALTER TABLE `t_commentaire_com`
  ADD PRIMARY KEY (`com_numero`),
  ADD UNIQUE KEY `vis_id` (`vis_id`);

--
-- Index pour la table `t_compte_cpt`
--
ALTER TABLE `t_compte_cpt`
  ADD PRIMARY KEY (`cpt_pseudo`);

--
-- Index pour la table `t_configuration_conf`
--
ALTER TABLE `t_configuration_conf`
  ADD PRIMARY KEY (`conf_expo_id`);

--
-- Index pour la table `t_exposant_expo`
--
ALTER TABLE `t_exposant_expo`
  ADD PRIMARY KEY (`expo_identifiant`),
  ADD KEY `cpt_pseudo` (`cpt_pseudo`);

--
-- Index pour la table `t_oeuvre_oeu`
--
ALTER TABLE `t_oeuvre_oeu`
  ADD PRIMARY KEY (`oeu_code`);

--
-- Index pour la table `t_presentation_pres`
--
ALTER TABLE `t_presentation_pres`
  ADD PRIMARY KEY (`expo_identifiant`,`oeu_code`),
  ADD KEY `oeu_code` (`oeu_code`);

--
-- Index pour la table `t_profil_pro`
--
ALTER TABLE `t_profil_pro`
  ADD PRIMARY KEY (`cpt_pseudo`);

--
-- Index pour la table `t_visiteurs_vis`
--
ALTER TABLE `t_visiteurs_vis`
  ADD PRIMARY KEY (`vis_id`),
  ADD KEY `cpt_pseudo` (`cpt_pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_actualite_actu`
--
ALTER TABLE `t_actualite_actu`
  MODIFY `actu_numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_commentaire_com`
--
ALTER TABLE `t_commentaire_com`
  MODIFY `com_numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `t_configuration_conf`
--
ALTER TABLE `t_configuration_conf`
  MODIFY `conf_expo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `t_exposant_expo`
--
ALTER TABLE `t_exposant_expo`
  MODIFY `expo_identifiant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `t_oeuvre_oeu`
--
ALTER TABLE `t_oeuvre_oeu`
  MODIFY `oeu_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `t_visiteurs_vis`
--
ALTER TABLE `t_visiteurs_vis`
  MODIFY `vis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_actualite_actu`
--
ALTER TABLE `t_actualite_actu`
  ADD CONSTRAINT `t_actualite_actu_ibfk_1` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`);

--
-- Contraintes pour la table `t_commentaire_com`
--
ALTER TABLE `t_commentaire_com`
  ADD CONSTRAINT `t_commentaire_com_ibfk_1` FOREIGN KEY (`vis_id`) REFERENCES `t_visiteurs_vis` (`vis_id`);

--
-- Contraintes pour la table `t_exposant_expo`
--
ALTER TABLE `t_exposant_expo`
  ADD CONSTRAINT `t_exposant_expo_ibfk_1` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`);

--
-- Contraintes pour la table `t_presentation_pres`
--
ALTER TABLE `t_presentation_pres`
  ADD CONSTRAINT `t_presentation_pres_ibfk_1` FOREIGN KEY (`expo_identifiant`) REFERENCES `t_exposant_expo` (`expo_identifiant`),
  ADD CONSTRAINT `t_presentation_pres_ibfk_2` FOREIGN KEY (`oeu_code`) REFERENCES `t_oeuvre_oeu` (`oeu_code`);

--
-- Contraintes pour la table `t_profil_pro`
--
ALTER TABLE `t_profil_pro`
  ADD CONSTRAINT `t_profil_pro_ibfk_1` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`);

--
-- Contraintes pour la table `t_visiteurs_vis`
--
ALTER TABLE `t_visiteurs_vis`
  ADD CONSTRAINT `t_visiteurs_vis_ibfk_1` FOREIGN KEY (`cpt_pseudo`) REFERENCES `t_compte_cpt` (`cpt_pseudo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
