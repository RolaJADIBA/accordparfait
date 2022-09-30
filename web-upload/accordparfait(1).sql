-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 21, 2022 at 05:15 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accordparfait`
--

-- --------------------------------------------------------

--
-- Table structure for table `autonomie`
--

CREATE TABLE `autonomie` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `autonomie`
--

INSERT INTO `autonomie` (`id`, `titre`, `description`) VALUES
(1, 'Cours d’alphabétisation', 'Ils sont ouverts à toute personne n’ayant jamais été scolarisée ou seulement quelques années dans une langue utilisant un autre alphabet que celui que nous utilisons en France.\r\nSont principalement travaillés l’apprentissage de l’alphabet et des chiffres, les sons simples et complexes, la présentation à l’oral, les principaux repères spatio-temporels.\r\n\r\nLes cours sont dispensés principalement au Centre René Peltier dans le quartier des Chartreux mais aussi dans le quartier de La Lisière, à l’Espace Intergénérationnel des Marots, à l’Espace Intergénérationnel des Sénardes à raison de 2 à 3 cours d’1.5h par semaine (selon les endroits). L’association intervient également au CHRS des Cytises (réservé pour les résidents).'),
(2, 'Ateliers sociolinguistiques', 'Pour un équivalent au niveau A1.1 du CECRL, les ateliers sociolinguistiques (ASL) proposent un apprentissage du français à travers 10 thèmes sociaux. L’objectif des ASL est d’enrichir le vocabulaire sur des thématiques usuelles (santé, famille, valeurs de la république et laïcité, emploi, etc…), de faciliter l’intégration et l’autonomie dans les démarches au quotidien.\r\n\r\nLes ateliers sont dispensés principalement au Centre René Peltier dans le quartier des Chartreux mais aussi dans le quartier de La Lisière, à l’Espace Intergénérationnel des Sénardes à raison de 2 à 3 cours d’1.5h par semaine (selon les endroits). L’association intervient également au CHRS des Cytises (réservé pour les résidents).'),
(3, 'Atelier graphie et Atelier oralité', 'Ces deux ateliers sont proposés en complément des cours d’alphabétisation et des ateliers sociolinguistiques à raison d’un atelier d’1h30 par semaine. Ils visent à combler des difficultés individuelles plus marquées chez certaines personnes : mauvaise tenue du crayon, difficulté à former les lettres, difficultés à l’oral. L’atelier oralité vise à travailler des petites saynètes de la vie quotidienne tout en proposant aux apprenants d’improviser pour terminer les répliques qui leur sont proposées.');

-- --------------------------------------------------------

--
-- Table structure for table `complement`
--

CREATE TABLE `complement` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `images` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complement`
--

INSERT INTO `complement` (`id`, `titre`, `description`, `images`) VALUES
(1, 'Les ateliers de renforcement « classiques »', 'Ces ateliers sont une combinaison de l\'enseignement du Français Langue Etrangère mais aussi des enseignements inspirés des ateliers sociolinguistiques et du Français Langue Professionnelle.\r\nLes cours sont principalement dispensés au Centre René Peltier dans le quartier des Chartreux à raison de trois ateliers d’1h30 par groupe de niveau. Les entrées et sorties sont permanentes.', NULL),
(2, 'Les ateliers de renforcement « intensifs »', 'A la différence des ateliers classiques, les ateliers intensifs sont proposés de date à date à raison de deux sessions de 90h par an. Ils proposent un travail par compétence ainsi qu’un travail sur le projet professionnel individuel. L’objectif final étant la progression vers le niveau supérieur de maîtrise de la langue française permettant de déboucher sur un emploi ou une formation par exemple.', NULL),
(3, 'Le théâtre', 'Pour aider les apprenants à bien s\'exprimer et travailler sur la confiance et l’image de soi, des cours de théâtre dispensés par une compagnie théâtrale professionnelle sont proposés à tous les apprenants ayant au minimum un niveau A1. Ces ateliers proposent le travail autour d’extraits de films ayant trait à l’insertion professionnelle. Ils allient jeu théâtral (prononciation, maîtrise de la voix, posture, gestuelle…), préparation des scènes de cinéma et travail avec la caméra.', '[\"47194865c6575f50a383ab3030c883a4.jpg\", \"1a7dd0bdfbcf1e66c50e11336159d2d1.jpg\", \"11674e1d389042aa18e21679fd47b5a4.jpg\", \"93f60f1ae2a407698628801522df8ada.jpg\", \"5b69280cde7baafe714f6dcc7439789f.jpg\", \"7c921d77a9d9565d8c503ec93c3731ef.jpg\", \"f9f1e1d08f35fec6aa1e838934d72c93.jpg\", \"18b657485f03e2681e9b8ef3a5dff613.jpg\"]');

-- --------------------------------------------------------

--
-- Table structure for table `delf`
--

CREATE TABLE `delf` (
  `id` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desciption` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delf`
--

INSERT INTO `delf` (`id`, `image`, `desciption`) VALUES
(1, '10b706b5108d5af95ba8c1cb05594bc0.png', 'Le DELF selon le niveau obtenu, permet de faciliter l\'entrée en formation, d\'évoluer professionnellement, de faciliter les démarches administratives ou encore d\'acquérir la nationalité française. L’association propose des ateliers collectifs spécifiques qui se déroulent au Centre René Peltier dans le quartier des Chartreux ainsi qu’un coaching individuel. Tous les mois l’association propose aux apprenants qui le souhaitent de passer un DELF blanc.');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220226121337', '2022-02-26 12:14:07', 466),
('DoctrineMigrations\\Version20220226122719', '2022-02-26 12:27:25', 234),
('DoctrineMigrations\\Version20220227110945', '2022-02-27 11:09:51', 342),
('DoctrineMigrations\\Version20220726122429', '2022-07-26 12:24:46', 1924),
('DoctrineMigrations\\Version20220728114322', '2022-07-28 11:43:29', 688),
('DoctrineMigrations\\Version20220728114912', '2022-07-28 11:49:18', 250),
('DoctrineMigrations\\Version20220728124008', '2022-07-28 12:40:13', 289),
('DoctrineMigrations\\Version20220729080516', '2022-07-29 08:05:58', 587),
('DoctrineMigrations\\Version20220729082619', '2022-07-29 08:26:24', 237),
('DoctrineMigrations\\Version20220731133322', '2022-07-31 13:33:36', 210),
('DoctrineMigrations\\Version20220731151024', '2022-07-31 15:10:58', 208),
('DoctrineMigrations\\Version20220731162641', '2022-07-31 16:26:47', 183),
('DoctrineMigrations\\Version20220801140409', '2022-08-01 14:04:19', 564),
('DoctrineMigrations\\Version20220801151437', '2022-08-01 15:14:45', 203),
('DoctrineMigrations\\Version20220801173807', '2022-08-01 17:38:13', 348),
('DoctrineMigrations\\Version20220801193456', '2022-08-01 19:35:03', 367),
('DoctrineMigrations\\Version20220801225841', '2022-08-01 22:58:48', 867),
('DoctrineMigrations\\Version20220801230820', '2022-08-01 23:08:25', 382),
('DoctrineMigrations\\Version20220802062645', '2022-08-02 06:26:52', 324),
('DoctrineMigrations\\Version20220802065334', '2022-08-02 06:53:42', 223),
('DoctrineMigrations\\Version20220802080020', '2022-08-02 08:00:32', 272),
('DoctrineMigrations\\Version20220808070850', '2022-08-08 07:08:59', 725),
('DoctrineMigrations\\Version20220810073000', '2022-08-10 07:30:12', 730),
('DoctrineMigrations\\Version20220818144405', '2022-08-18 14:44:21', 1605),
('DoctrineMigrations\\Version20220818160100', '2022-08-18 16:01:16', 1564);

-- --------------------------------------------------------

--
-- Table structure for table `evenements`
--

CREATE TABLE `evenements` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `images` longtext COLLATE utf8mb4_unicode_ci,
  `image_choisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evenements`
--

INSERT INTO `evenements` (`id`, `titre`, `date`, `description`, `images`, `image_choisi`, `active`) VALUES
(1, 'Visite du Château de Versailles', '2022-07-22', '52 personnes dont 48 apprenants se sont rendus à Versailles pour la plupart pour la première fois. Deux groupes ont été constitués et ont bénéficié chacun d’une visite libre et d’une visite guidée sur les thématiques « Molière, témoin de la vie de la cour » et « La journée du Roi ». Les explications claires et adaptées des guides ont permis une bonne compréhension de tous. C\'était une magnifique journée!', '[\"7fd8e4fb236610c2119cf5107c8c650c.jpg\", \"18037d70a862759d21ba885aacee0752.jpg\", \"3dc76718248e333a8e055fe7e7cbfaa2.jpg\", \"47de31cc1ddc72c60fb53002f2ea7e37.jpg\"]', '80c551daade6475ee719b8e47041eeb4.jpg', 1),
(2, 'Fête de quartier des Chartreux', '2022-07-09', 'En tant qu’acteur de la vie de quartier, notre association a tenu un stand sur la place Romain Rolland pour faire connaître ses activités et proposer un petit quizz aux habitant. Les gagnants ont remporté un lot pour s\'occuper, se cultiver et se divertir durant l’été ! Bravo à eux !', '[\"652f02f99d6071c82279c1b6adde57ac.jpg\", \"f274caf7acb1e7d93209f0fec3edbd95.jpg\", \"0f2b2f348ad59fd24a37e91c5243d508.jpg\"]', '0592d04db4faf2d91aa6a690f3a68791.jpg', 1),
(3, 'festival de l\'ecrit', '2021-01-01', NULL, '[\"98070b4258b68dfe76053419c9c90202.jpg\", \"75205adc9176afb41b4cc992597f7bb1.jpg\"]', '6ad96183110cab0fd4b84ed25334166f.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jardin`
--

CREATE TABLE `jardin` (
  `id` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `images` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jardin`
--

INSERT INTO `jardin` (`id`, `description`, `images`) VALUES
(1, 'L’association dispose de 9 jardins mis à disposition par le bailleur social Mon Logis. Situés au pied d’un immeuble, ils sont tous équipés d’un cabanon et d’un récupérateur d’eau de pluie. Des composteurs ont également été installés non loin des jardins par Troyes Champagne Métropole. Les apprenants intéressés par un jardin font la demande à l’association et deviennent de vrais jardiniers qui œuvrent pour l’amélioration du cadre de vie dans le respect de l’environnement. Les jardins sont l’occasion d’avoir une activité physique et une alimentation saine mais aussi de renforcer et de créer des liens.', '[\"419ce78791a870e6780fa281c7a054e8.jpg\", \"e6026d646514e21518602b0962e18d36.jpg\", \"fcf194cf8a91aeab6d60365bcd1afba5.jpg\"]');

-- --------------------------------------------------------

--
-- Table structure for table `mobilite`
--

CREATE TABLE `mobilite` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `images` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mobilite`
--

INSERT INTO `mobilite` (`id`, `titre`, `description`, `images`) VALUES
(1, 'Mobilité en bus', 'L’Accord Parfait travaille en partenariat avec la TCAT depuis de longues années. Elles ont développé ensemble une méthodologie pour aider toute personne à se déplacer en bus, à lire un plan, à définir un itinéraire (choix des lignes), à bien lire les heures d’arrivée et de départ pour ne pas arriver en retard à un rendez-vous par exemple. Cette méthodologie allie théorie et pratique : en effet, en plus d’un jeu de l’oie ayant pour support la carte du réseau troyen, la TCAT intervient pour présenter les règles et usages dans le bus mais aussi propose un repérage des endroits stratégiques de la ville et tout cela …… en bus bien sûr !', '[\"2c8fffc38c31f8186330c52f1b6c7590.jpg\", \"0064bee01e6c5852ed3cd918da80eb3f.jpg\"]'),
(2, 'Mobilité à vélo', 'En partenariat avec l’association Akhilleus, L’Accord Parfait vous propose d’apprendre à faire du vélo en moins de 10 séances ! L’apprentissage se conclut par une balade dans le quartier.', '[\"d55491ec51a38b8dd6a1d035203eab37.jpg\", \"56da5bed2fb2952d6f863174c59be1f8.jpg\"]');

-- --------------------------------------------------------

--
-- Table structure for table `numerique`
--

CREATE TABLE `numerique` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptions` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `numerique`
--

INSERT INTO `numerique` (`id`, `titre`, `descriptions`) VALUES
(1, 'Compétences numériques de base', 'découverte de l\'environnement (écran, souris, clavier, icônes etc…) ; Navigation web ; les applications sur smartphone (Zoom en particulier)'),
(2, 'Aide aux démarches administratives', 'Dématérialisation des services ; Mettre à jour ses droits sociaux ; Effectuer ses démarches en ligne');

-- --------------------------------------------------------

--
-- Table structure for table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hashed_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soutien`
--

CREATE TABLE `soutien` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `images` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soutien`
--

INSERT INTO `soutien` (`id`, `titre`, `description`, `images`) VALUES
(1, NULL, 'L’association propose de répondre aux questions que se posent les parents en organisant différents temps forts et en mettant en relation les parents avec les professionnels des questions éducatives. Un temps fort est organisé par mois selon les besoins des parents.', '[]');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_verified`, `username`, `role`, `photo`, `prenom`, `nom`, `active`) VALUES
(1, 'fatima.fadil@laccord-parfait.fr', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=65536,t=4,p=1$dFNEck1jcmppV0hleUE0Yg$IH2gMecEX2E4LHvfXrUpY4BN8t/+uGoSFGzNKEGis3g', 0, NULL, 'directrice', NULL, 'Fatima', 'Fadil', 1),
(2, 'mathilde.dubois@laccord-parfait.fr', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=65536,t=4,p=1$cENSdmIxbVhsZDlkL1ZGSQ$HrBx8BtzNoXIywi2lGbRM8xEoYNjlbUm4Wo2G+QGmFs', 0, NULL, 'coordinatrice', NULL, 'Mathilde', 'DUBOIS', 1),
(4, 'sanaa@laccordparfait.fr', '[]', '$argon2i$v=19$m=65536,t=4,p=1$NXBESnVUN3JPQ1ViSGxhaA$fNNYdvsqtMiDqRBKp4F8LPjBO76UYGe0VbY6hDreqGg', 1, 'sanaa', 'médiatrice sociale', NULL, 'Sanaa', 'Azazni', 1),
(5, 'mediation2@laccord-parfait.fr', '[]', '$argon2i$v=19$m=65536,t=4,p=1$TlB6a1BYRG9ncVN2R0kvaw$JejzCQCoxhhSfe3n7zOuKg7yU6gdIWn0o9n8eReFEvQ', 0, NULL, 'médiatrice sociale et culturelle', NULL, 'Valérie', 'NGUYEN', 1),
(6, 'mediation3@laccord-parfait.fr', '[]', '$argon2i$v=19$m=65536,t=4,p=1$RlpFT0VjVklrVGlvdnFuNw$XrHjI1tJm4avLvsWFZUrzC2qOejNeyyf+F9neJU/iFU', 1, NULL, 'médiateur numérique', NULL, 'Mattieu', 'Spiess', 1),
(7, 'rola.jadiba@laccord-parfait.fr', '[\"ROLE_ADMIN\"]', '$argon2i$v=19$m=65536,t=4,p=1$MjIzN0t6NDlLWUxqWWg1UA$Lrl2d/aJxqeiCb1vWeJARR0rBoV2ZlfCuq6Y1tCYURM', 1, 'Rola', 'developpeure web', '45aae9ec1a619bd941f9b30049fc00c6.jpg', 'Rola', 'JADIBA', 1),
(9, 'coordination@laccord-parfait.fr', '[]', '$argon2i$v=19$m=65536,t=4,p=1$MXNabVNrV21FR3pDOWIuaA$WiLu7B9bMUUJdiy06SqMfWxp+2OZZAgOXJCht+BV2hM', 1, NULL, 'coordinatrice', '748d70c638961df70433954f02a73c8b.png', 'Mathilde', 'DUBOIS', 0),
(10, 'laccordparfait@hotmail.com', '[]', '$argon2i$v=19$m=65536,t=4,p=1$MlVHdm1YSUphNktjMmRpdg$MPdG8w/PDazqAcKre/pr9rZ93ZFZGYaj5mJYRwjTKjc', 0, NULL, 'directrice', NULL, 'Fatima', 'Fadil', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autonomie`
--
ALTER TABLE `autonomie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complement`
--
ALTER TABLE `complement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delf`
--
ALTER TABLE `delf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `evenements`
--
ALTER TABLE `evenements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jardin`
--
ALTER TABLE `jardin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobilite`
--
ALTER TABLE `mobilite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `numerique`
--
ALTER TABLE `numerique`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Indexes for table `soutien`
--
ALTER TABLE `soutien`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autonomie`
--
ALTER TABLE `autonomie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `complement`
--
ALTER TABLE `complement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `delf`
--
ALTER TABLE `delf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `evenements`
--
ALTER TABLE `evenements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jardin`
--
ALTER TABLE `jardin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mobilite`
--
ALTER TABLE `mobilite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `numerique`
--
ALTER TABLE `numerique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `soutien`
--
ALTER TABLE `soutien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
