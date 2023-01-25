-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 25 jan. 2023 à 21:41
-- Version du serveur : 10.5.18-MariaDB-0+deb11u1
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tfqtbp_carmenws_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `idadministrateur` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `date_naissance` date NOT NULL,
  `sexe` varchar(45) DEFAULT NULL,
  `mdp` varchar(65) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `adresse_mail` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`idadministrateur`, `nom`, `prenom`, `date_naissance`, `sexe`, `mdp`, `adresse`, `adresse_mail`) VALUES
(1, 'Kerdrel', 'Tugdual', '2002-07-09', 'male', '819d90f708c2678ca0dec4cc99e2804b828f0c117c920b41e0d02c1366086fdb', '23 rue des branlos', 'admin@admin.com'),
(2, 'test', 'test', '2023-01-13', 'male', '36f028580bb02cc8272a9a020f4200e346e276ae664e45ee80745574e2f5ab80', '5 route de Breles Lanildut', 'sefsef@fsefes.com'),
(3, '', '', '0000-00-00', '', 'a7ffc6f8bf1ed76651c14756a061d662f580ff4de43b49fa82d80a4b80f8434a', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `alerte`
--

CREATE TABLE `alerte` (
  `idalerte` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `message` varchar(45) DEFAULT NULL,
  `medecin_idmedecin` int(11) NOT NULL,
  `patient_idpatient` int(11) NOT NULL,
  `patient_medecin_idmedecin` int(11) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `assignation_chambre`
--

CREATE TABLE `assignation_chambre` (
  `patient_idpatient` int(11) NOT NULL,
  `patient_medecin_idmedecin` int(11) NOT NULL,
  `patient_date_arrivee` datetime NOT NULL,
  `patient_date_depart` datetime NOT NULL,
  `chambre_numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `capteurs`
--

CREATE TABLE `capteurs` (
  `idcapteurs` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `chambre_numero` int(11) NOT NULL,
  `valeurs_donnees` int(11) DEFAULT NULL,
  `date_mesures` datetime DEFAULT NULL,
  `medecin_idmedecin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `capteurs`
--

INSERT INTO `capteurs` (`idcapteurs`, `type`, `chambre_numero`, `valeurs_donnees`, `date_mesures`, `medecin_idmedecin`) VALUES
(15, 'cardiaque', 12, 88, NULL, 1),
(17, 'thermique', 10, NULL, NULL, 3),
(18, 'lumiere', 10, NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE `chambre` (
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`numero`) VALUES
(10),
(11),
(12),
(13),
(14);

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `idchat` int(11) NOT NULL,
  `contenu` varchar(45) DEFAULT NULL,
  `dates_messages` datetime DEFAULT NULL,
  `fichiers_transmis` blob DEFAULT NULL,
  `medecin_idmedecin` int(11) NOT NULL,
  `famille_idfamille` int(11) NOT NULL,
  `famille_medecin_idmedecin` int(11) NOT NULL,
  `famille_patient_idpatient` int(11) NOT NULL,
  `famille_patient_medecin_idmedecin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

CREATE TABLE `famille` (
  `idfamille` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `adresse_mail` varchar(45) DEFAULT NULL,
  `mdp` varchar(65) DEFAULT NULL,
  `medecin_idmedecin` int(11) NOT NULL,
  `patient_idpatient` int(11) NOT NULL,
  `patient_medecin_idmedecin` int(11) NOT NULL,
  `codefamille` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `famille`
--

INSERT INTO `famille` (`idfamille`, `nom`, `prenom`, `adresse_mail`, `mdp`, `medecin_idmedecin`, `patient_idpatient`, `patient_medecin_idmedecin`, `codefamille`) VALUES
(2, 'Autier', 'Fabrice', 'fabrice.autier@famille.fr', '81d890f309e8b4485d129b8a8a24d3794c3dc7d5c7e11737c499e98b9d7f00f8', 2, 2, 2, '0'),
(9, 'Kerdrel', 'Hervé', 'segolene.de.kerdrel@wanadoo.fr', '36f028580bb02cc8272a9a020f4200e346e276ae664e45ee80745574e2f5ab80', 1, 1, 1, 'AA11BB2');

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `idquestion` int(11) NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `contenu` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`idquestion`, `titre`, `contenu`) VALUES
(28, 'Qu\'est-ce que Carmen ??', 'Carmen est un outil en ligne qui permet aux patients d\'accéder à leurs bilans médicaux, aux médecins de consulter les constantes vitales des patients et de communiquer avec leur famille, et aux administrateurs de gérer les patients, les capteurs et les médecins.'),
(29, 'Qui peut utiliser Carmen ?', 'Carmen est accessible aux patients, aux médecins et aux administrateurs de l\'hôpital.'),
(30, 'Comment puis-je accéder à Carmen ?', 'Pour accéder à Carmen, vous devez disposer d\'un compte utilisateur valide et vous connecter en utilisant vos identifiants. Si vous êtes un patient, vous pouvez demander à votre médecin ou à l\'administration de l\'hôpital de vous créer un compte.'),
(31, 'Comment puis-je contacter l\'assistance technique si j\'ai des problèmes avec le site ?', 'Si vous rencontrez des difficultés lors de l\'utilisation du site, vous pouvez contacter l\'assistance technique en utilisant le formulaire de contact. Vous pouvez également vous renseigner auprès de votre médecin ou de l\'administration de l\'hôpital pour obtenir de l\'aide.'),
(33, 'Ce site utilise-t-il des cookies ?', 'Non, ce site n\'utilise aucun cookie afin de stocker des informations. Nous ne vous traquons pas, et nous prenons très au sérieux votre vie privée, et la sécurité des données personnelles !'),
(34, 'Le saviez-vous ?', 'Selon l\'Organisation mondiale de la santé (OMS), les hôpitaux sont responsables de 8 % des émissions de gaz à effet de serre mondiales.'),
(35, 'L\'écologie à l\'Hopital', 'Les hôpitaux consomment beaucoup d\'énergie pour alimenter les appareils médicaux et maintenir les bâtiments à une température confortable. Ils peuvent également produire de grandes quantités de déchets, notamment des déchets médicaux dangereux qui doivent être traités de manière spéciale.'),
(36, 'Pourquoi Tugdual est si beau ?', 'parce que c\'est la vie :)');

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

CREATE TABLE `medecin` (
  `idmedecin` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `adresse_mail` varchar(45) DEFAULT NULL,
  `mdp` varchar(65) DEFAULT NULL,
  `codeMedecin` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`idmedecin`, `nom`, `prenom`, `date_naissance`, `adresse_mail`, `mdp`, `codeMedecin`) VALUES
(1, 'A assigner', 'A assigner', '0000-00-00', 'test@test.com', '157f5fecda4c52fa78bbaaf89e4d10013dcb7a2e842c735238288d6a4043ed70', '0'),
(2, 'Cymes', 'Michel', '1958-05-14', 'michel.cymes@medecin.com', '4a11d3db11391248b569f1babe5d80782788372d6a4027b4f414562e22b77947', '0'),
(3, 'Pasteur', 'Louis', '0000-00-00', 'louis.pasteur@medecin.fr', 'a733549fc0a65c88641040f92d602d89000a2492fefa0a7bbf020e7f3a1c621b', '0'),
(4, 'bico', 'feignasse', '2023-01-13', 'nicofeignasse@test.fr', '36f028580bb02cc8272a9a020f4200e346e276ae664e45ee80745574e2f5ab80', 'YUJVWDZ'),
(5, 'Roux', 'Eloi', '2023-01-05', 'eloi.roux@test.fr', '36f028580bb02cc8272a9a020f4200e346e276ae664e45ee80745574e2f5ab80', '9YBZ0IC');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `idpatient` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `sexe` varchar(45) DEFAULT NULL,
  `mdp` varchar(65) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `medecin_idmedecin` int(11) NOT NULL DEFAULT 1,
  `date_arrivee` datetime NOT NULL DEFAULT current_timestamp(),
  `date_depart` datetime NOT NULL DEFAULT current_timestamp(),
  `telephone` int(11) DEFAULT NULL,
  `codepatient` varchar(11) NOT NULL DEFAULT '0',
  `prenom` varchar(45) DEFAULT NULL,
  `adresse_mail` varchar(320) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`idpatient`, `nom`, `date_naissance`, `sexe`, `mdp`, `adresse`, `medecin_idmedecin`, `date_arrivee`, `date_depart`, `telephone`, `codepatient`, `prenom`, `adresse_mail`) VALUES
(1, 'Audren de Kerdrel', '0000-00-00', 'Male', 'f1845abacf3c2cbc9414043a1e3e3ffb42d33fb421424ae9f867e0086151ff92', '44 rue de Lille', 1, '2022-12-06 20:04:19', '2022-12-06 20:04:19', 768505097, '0', 'Tugdual', 'tugdualk@hotmail.com'),
(2, 'Champagne', '0000-00-00', 'Male', '125a44359fb6f9122e7503f14dd67c155537f70e856bf5a8fb194dc1ab21482a', '10 rue des plantes', 2, '2022-12-16 06:41:43', '2022-12-16 06:41:43', 646086817, '0', 'Mathis', 'mathis.champagne@patient.fr'),
(3, 'Autier', '0000-00-00', 'Male', '3a3f4e7a0a9bccdd29d25f1b09fc8fc6f1bcea2cf33fa110e4f8a4ec63b16247', '40 rue du Bac', 2, '2022-12-16 06:42:51', '2022-12-16 06:42:51', 746352416, '0', 'Arno', 'arno.autier@patient.fr'),
(4, 'Rodallec', '0000-00-00', 'Male', '9fbd49c2de67c9bd38edf15043361d86e06a90bc01f1b4f26dde6f7c15fea75f', '40 rue de Beaune', 3, '2022-12-16 06:44:57', '2022-12-16 06:44:57', 567463514, '0', 'Clement', 'clement.rodallec@patient.fr'),
(5, 'Cermak', NULL, NULL, '63ccd22b19bcc5a530990f54cfa10a17f995b178a1530ccda32348393d0807d3', NULL, 1, '2022-12-16 10:06:06', '2022-12-16 10:06:06', NULL, '0', NULL, 'hugo.cermak@patient.fr'),
(9, 'test', '2023-01-12', 'male', '36f028580bb02cc8272a9a020f4200e346e276ae664e45ee80745574e2f5ab80', '44 rue de Lille', 1, '2023-01-23 20:30:43', '2023-01-23 20:30:43', 768505097, 'LNO4973', '', 'tes@test.com'),
(11, 'lol', '2002-07-09', 'male', NULL, '44 rue de Lille', 1, '2023-01-23 20:58:12', '2023-01-23 20:58:12', 768505097, 'N5KER8T', 'tague', 'loltague@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `patient_has_chambre`
--

CREATE TABLE `patient_has_chambre` (
  `Patient_idPatient` int(11) NOT NULL,
  `Patient_Médecin_idMédecin` int(11) NOT NULL,
  `Patient_dateArrivée` datetime NOT NULL,
  `Patient_dateDépart` datetime NOT NULL,
  `Chambre_numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rapport`
--

CREATE TABLE `rapport` (
  `idrapport` int(11) NOT NULL,
  `texte_rapport` varchar(4000) DEFAULT NULL,
  `famille_idfamille` int(11) NOT NULL,
  `patient_idpatient` int(11) NOT NULL,
  `patient_medecin_idmedecin` int(11) NOT NULL,
  `date_rapport` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `rapport`
--

INSERT INTO `rapport` (`idrapport`, `texte_rapport`, `famille_idfamille`, `patient_idpatient`, `patient_medecin_idmedecin`, `date_rapport`) VALUES
(22, 'sfesef', 2, 2, 2, '2023-01-18'),
(23, 'test', 2, 2, 2, '2023-01-18'),
(24, 'test2', 2, 2, 2, '2023-01-18'),
(25, 'bonjour,\r\n\r\nceci est un test !', 2, 2, 2, '2023-01-19'),
(26, 'Bonjour,\r\n\r\nJe suis dans le regret de vous annoncer !', 2, 2, 2, '2023-01-20'),
(27, 'Au cours de l\'examen clinique, Mathis Champagne présentait une douleur et une raideur au niveau du poignet gauche. Il a déclaré que la douleur s\'aggravait lorsqu\'il effectuait des mouvements actifs et passifs du poignet et des doigts. La palpation des régions affectées a révélé une augmentation de la douleur et une perte de la mobilité. Une radiographie a révélé une entorse ligamentaire du poignet gauche. \n\nÀ la suite de l\'examen, un diagnostic d\'entorse ligamentaire du poignet gauche a été posé. La thérapie consiste à reposer le poignet, appliquer de la glace et du soutien, et prendre des anti-inflammatoires pour réduire l\'inflammation et la douleur. Des exercices d\'étirement et de musculation sont également recommandés pour restaurer la mobilité et la force musculaire. Une orthèse peut être nécessaire pour maintenir le poignet en position stable et réduire les douleurs et le risque de blessure. \n\nUn suivi clinique est nécessaire pour évaluer l\'efficacité de la thérapie et la progression de la guérison. Des radiographies peuvent être nécessaires pour surveiller l\'évolution de la blessure et s\'assurer que le traitement est efficace. \n\nEn conclusion, Mathis Champagne présente une entorse ligamentaire du poignet gauche et une thérapie appropriée a été établie pour favoriser la guérison et prévenir toute aggravation de la blessure.', 2, 2, 2, '2023-01-20');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`idadministrateur`);

--
-- Index pour la table `alerte`
--
ALTER TABLE `alerte`
  ADD PRIMARY KEY (`idalerte`,`medecin_idmedecin`,`patient_idpatient`,`patient_medecin_idmedecin`),
  ADD KEY `fk_alerte_Médecin1_idx` (`medecin_idmedecin`),
  ADD KEY `fk_alerte_Patient1_idx` (`patient_idpatient`,`patient_medecin_idmedecin`);

--
-- Index pour la table `assignation_chambre`
--
ALTER TABLE `assignation_chambre`
  ADD PRIMARY KEY (`patient_idpatient`,`patient_medecin_idmedecin`,`patient_date_arrivee`,`patient_date_depart`,`chambre_numero`),
  ADD KEY `fk_Patient_has_Chambre1_Chambre1_idx` (`chambre_numero`),
  ADD KEY `fk_Patient_has_Chambre1_Patient1_idx` (`patient_idpatient`,`patient_medecin_idmedecin`,`patient_date_arrivee`,`patient_date_depart`);

--
-- Index pour la table `capteurs`
--
ALTER TABLE `capteurs`
  ADD PRIMARY KEY (`idcapteurs`,`chambre_numero`,`medecin_idmedecin`),
  ADD KEY `fk_Capteurs_Chambre1_idx` (`chambre_numero`),
  ADD KEY `fk_Capteurs_Médecin1_idx` (`medecin_idmedecin`);

--
-- Index pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD PRIMARY KEY (`numero`);

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idchat`,`medecin_idmedecin`,`famille_idfamille`,`famille_medecin_idmedecin`,`famille_patient_idpatient`,`famille_patient_medecin_idmedecin`),
  ADD KEY `fk_Chat_Médecin1_idx` (`medecin_idmedecin`),
  ADD KEY `fk_Chat_Famille1_idx` (`famille_idfamille`,`famille_medecin_idmedecin`,`famille_patient_idpatient`,`famille_patient_medecin_idmedecin`);

--
-- Index pour la table `famille`
--
ALTER TABLE `famille`
  ADD PRIMARY KEY (`idfamille`,`medecin_idmedecin`,`patient_idpatient`,`patient_medecin_idmedecin`,`codefamille`),
  ADD KEY `fk_Famille_Patient1_idx` (`patient_idpatient`,`patient_medecin_idmedecin`);

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`idquestion`);

--
-- Index pour la table `medecin`
--
ALTER TABLE `medecin`
  ADD PRIMARY KEY (`idmedecin`);

--
-- Index pour la table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`idpatient`,`medecin_idmedecin`,`date_arrivee`,`date_depart`) USING BTREE,
  ADD KEY `fk_Patient_Médecin1_idx` (`medecin_idmedecin`);

--
-- Index pour la table `patient_has_chambre`
--
ALTER TABLE `patient_has_chambre`
  ADD PRIMARY KEY (`Patient_idPatient`,`Patient_Médecin_idMédecin`,`Patient_dateArrivée`,`Patient_dateDépart`,`Chambre_numero`),
  ADD KEY `fk_Patient_has_Chambre_Chambre1_idx` (`Chambre_numero`),
  ADD KEY `fk_Patient_has_Chambre_Patient1_idx` (`Patient_idPatient`,`Patient_Médecin_idMédecin`,`Patient_dateArrivée`,`Patient_dateDépart`);

--
-- Index pour la table `rapport`
--
ALTER TABLE `rapport`
  ADD PRIMARY KEY (`idrapport`,`famille_idfamille`,`patient_idpatient`,`patient_medecin_idmedecin`) USING BTREE,
  ADD KEY `fk_Rapport_Patient1_idx` (`patient_idpatient`,`patient_medecin_idmedecin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `idadministrateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `alerte`
--
ALTER TABLE `alerte`
  MODIFY `idalerte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `capteurs`
--
ALTER TABLE `capteurs`
  MODIFY `idcapteurs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `chambre`
--
ALTER TABLE `chambre`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `idchat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `famille`
--
ALTER TABLE `famille`
  MODIFY `idfamille` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `idquestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `medecin`
--
ALTER TABLE `medecin`
  MODIFY `idmedecin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `idpatient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `rapport`
--
ALTER TABLE `rapport`
  MODIFY `idrapport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `alerte`
--
ALTER TABLE `alerte`
  ADD CONSTRAINT `fk_alerte_Médecin1` FOREIGN KEY (`medecin_idmedecin`) REFERENCES `medecin` (`idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alerte_Patient1` FOREIGN KEY (`patient_idpatient`,`patient_medecin_idmedecin`) REFERENCES `patient` (`idpatient`, `medecin_idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `assignation_chambre`
--
ALTER TABLE `assignation_chambre`
  ADD CONSTRAINT `fk_Patient_has_Chambre1_Chambre1` FOREIGN KEY (`chambre_numero`) REFERENCES `chambre` (`numero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Patient_has_Chambre1_Patient1` FOREIGN KEY (`patient_idpatient`,`patient_medecin_idmedecin`,`patient_date_arrivee`,`patient_date_depart`) REFERENCES `patient` (`idpatient`, `medecin_idmedecin`, `date_arrivee`, `date_depart`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `capteurs`
--
ALTER TABLE `capteurs`
  ADD CONSTRAINT `fk_Capteurs_Chambre1` FOREIGN KEY (`chambre_numero`) REFERENCES `chambre` (`numero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Capteurs_Médecin1` FOREIGN KEY (`medecin_idmedecin`) REFERENCES `medecin` (`idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_Chat_Famille1` FOREIGN KEY (`famille_idfamille`,`famille_medecin_idmedecin`,`famille_patient_idpatient`,`famille_patient_medecin_idmedecin`) REFERENCES `famille` (`idfamille`, `medecin_idmedecin`, `patient_idpatient`, `patient_medecin_idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Chat_Médecin1` FOREIGN KEY (`medecin_idmedecin`) REFERENCES `medecin` (`idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `famille`
--
ALTER TABLE `famille`
  ADD CONSTRAINT `fk_Famille_Patient1` FOREIGN KEY (`patient_idpatient`,`patient_medecin_idmedecin`) REFERENCES `patient` (`idpatient`, `medecin_idmedecin`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `fk_Patient_Médecin1` FOREIGN KEY (`medecin_idmedecin`) REFERENCES `medecin` (`idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `patient_has_chambre`
--
ALTER TABLE `patient_has_chambre`
  ADD CONSTRAINT `fk_Patient_has_Chambre_Chambre1` FOREIGN KEY (`Chambre_numero`) REFERENCES `chambre` (`numero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Patient_has_Chambre_Patient1` FOREIGN KEY (`Patient_idPatient`,`Patient_Médecin_idMédecin`,`Patient_dateArrivée`,`Patient_dateDépart`) REFERENCES `patient` (`idpatient`, `medecin_idmedecin`, `date_arrivee`, `date_depart`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
