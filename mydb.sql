-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 02 jan. 2023 à 14:09
-- Version du serveur : 5.7.24
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mydb`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `idadministrateur` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sexe` varchar(45) DEFAULT NULL,
  `mdp` varchar(65) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `adresse_mail` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`idadministrateur`, `nom`, `prenom`, `age`, `sexe`, `mdp`, `adresse`, `adresse_mail`) VALUES
(1, 'Kerdrel', 'Tugdual', 20, 'male', '819d90f708c2678ca0dec4cc99e2804b828f0c117c920b41e0d02c1366086fdb', '23 rue des branlos', 'admin@admin.com');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE `chambre` (
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `idchat` int(11) NOT NULL,
  `contenu` varchar(45) DEFAULT NULL,
  `dates_messages` datetime DEFAULT NULL,
  `fichiers_transmis` blob,
  `medecin_idmedecin` int(11) NOT NULL,
  `famille_idfamille` int(11) NOT NULL,
  `famille_medecin_idmedecin` int(11) NOT NULL,
  `famille_patient_idpatient` int(11) NOT NULL,
  `famille_patient_medecin_idmedecin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `codefamille`
--

CREATE TABLE `codefamille` (
  `codefamille` int(11) NOT NULL,
  `Famille_idfamille` int(11) NOT NULL,
  `famille_medecin_idmedecin` int(11) NOT NULL,
  `famille_patient_idpatient` int(11) NOT NULL,
  `famille_patient_medecin_idmedecin` int(11) NOT NULL,
  `famille_codefamille` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `codepatient`
--

CREATE TABLE `codepatient` (
  `codepatient` int(11) NOT NULL,
  `patient_idpatient` int(11) NOT NULL,
  `patient_medecin_idmedecin` int(11) NOT NULL,
  `patient_date_arrivee` datetime NOT NULL,
  `patient_date_depart` datetime NOT NULL,
  `patient_codepatient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `codefamille` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `famille`
--

INSERT INTO `famille` (`idfamille`, `nom`, `prenom`, `adresse_mail`, `mdp`, `medecin_idmedecin`, `patient_idpatient`, `patient_medecin_idmedecin`, `codefamille`) VALUES
(2, 'Autier', 'Fabrice', 'fabrice.autier@famille.fr', '81d890f309e8b4485d129b8a8a24d3794c3dc7d5c7e11737c499e98b9d7f00f8', 2, 2, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `idquestion` int(11) NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `contenu` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`idquestion`, `titre`, `contenu`) VALUES
(28, 'Qu\'est-ce que Carmen ?', 'Carmen est un outil en ligne qui permet aux patients d\'accéder à leurs bilans médicaux, aux médecins de consulter les constantes vitales des patients et de communiquer avec leur famille, et aux administrateurs de gérer les patients, les capteurs et les médecins.'),
(29, 'Qui peut utiliser Carmen ?', 'Carmen est accessible aux patients, aux médecins et aux administrateurs de l\'hôpital.'),
(30, 'Comment puis-je accéder à Carmen ?', 'Pour accéder à Carmen, vous devez disposer d\'un compte utilisateur valide et vous connecter en utilisant vos identifiants. Si vous êtes un patient, vous pouvez demander à votre médecin ou à l\'administration de l\'hôpital de vous créer un compte.'),
(31, 'Comment puis-je contacter l\'assistance technique si j\'ai des problèmes avec le site ?', 'Si vous rencontrez des difficultés lors de l\'utilisation du site, vous pouvez contacter l\'assistance technique en utilisant le formulaire de contact. Vous pouvez également vous renseigner auprès de votre médecin ou de l\'administration de l\'hôpital pour obtenir de l\'aide.');

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

CREATE TABLE `medecin` (
  `idmedecin` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `age` varchar(45) DEFAULT NULL,
  `adresse_mail` varchar(45) DEFAULT NULL,
  `mdp` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`idmedecin`, `nom`, `prenom`, `age`, `adresse_mail`, `mdp`) VALUES
(1, 'A assigner', 'A assigner', '0', 'test@test.com', '157f5fecda4c52fa78bbaaf89e4d10013dcb7a2e842c735238288d6a4043ed70'),
(2, 'Cymes', 'Michel', '65', 'michel.cymes@medecin.com', '4a11d3db11391248b569f1babe5d80782788372d6a4027b4f414562e22b77947'),
(3, 'Pasteur', 'Louis', '74', 'louis.pasteur@medecin.fr', 'a733549fc0a65c88641040f92d602d89000a2492fefa0a7bbf020e7f3a1c621b');

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

CREATE TABLE `patient` (
  `idpatient` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sexe` varchar(45) DEFAULT NULL,
  `mdp` varchar(65) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `medecin_idmedecin` int(11) NOT NULL DEFAULT '1',
  `date_arrivee` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_depart` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `telephone` int(11) DEFAULT NULL,
  `codepatient` int(11) NOT NULL DEFAULT '0',
  `prenom` varchar(45) DEFAULT NULL,
  `adresse_mail` varchar(320) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`idpatient`, `nom`, `age`, `sexe`, `mdp`, `adresse`, `medecin_idmedecin`, `date_arrivee`, `date_depart`, `telephone`, `codepatient`, `prenom`, `adresse_mail`) VALUES
(1, 'Audren de Kerdrel', 2121, 'Male', 'f1845abacf3c2cbc9414043a1e3e3ffb42d33fb421424ae9f867e0086151ff92', '44 rue de Lille', 1, '2022-12-06 20:04:19', '2022-12-06 20:04:19', 768505097, 0, 'Tugdual', 'tugdualk@hotmail.com'),
(2, 'Champagne', 20, 'Male', '125a44359fb6f9122e7503f14dd67c155537f70e856bf5a8fb194dc1ab21482a', '10 rue des plantes', 2, '2022-12-16 06:41:43', '2022-12-16 06:41:43', 646086817, 0, 'Mathis', 'mathis.champagne@patient.fr'),
(3, 'Autier', 21, 'Male', '3a3f4e7a0a9bccdd29d25f1b09fc8fc6f1bcea2cf33fa110e4f8a4ec63b16247', '40 rue du Bac', 2, '2022-12-16 06:42:51', '2022-12-16 06:42:51', 746352416, 0, 'Arno', 'arno.autier@patient.fr'),
(4, 'Rodallec', 20, 'Male', '9fbd49c2de67c9bd38edf15043361d86e06a90bc01f1b4f26dde6f7c15fea75f', '40 rue de Beaune', 3, '2022-12-16 06:44:57', '2022-12-16 06:44:57', 567463514, 0, 'Clement', 'clement.rodallec@patient.fr'),
(5, 'Cermak', NULL, NULL, '63ccd22b19bcc5a530990f54cfa10a17f995b178a1530ccda32348393d0807d3', NULL, 1, '2022-12-16 10:06:06', '2022-12-16 10:06:06', NULL, 0, NULL, 'hugo.cermak@patient.fr');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `rapport`
--

CREATE TABLE `rapport` (
  `idrapport` int(11) NOT NULL,
  `texte_rapport` varchar(45) DEFAULT NULL,
  `medecin_idmedecin` int(11) NOT NULL,
  `famille_idfamille` int(11) NOT NULL,
  `famille_medecin_idmedecin` int(11) NOT NULL,
  `patient_idpatient` int(11) NOT NULL,
  `patient_medecin_idmedecin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Index pour la table `codefamille`
--
ALTER TABLE `codefamille`
  ADD PRIMARY KEY (`codefamille`,`Famille_idfamille`,`famille_medecin_idmedecin`,`famille_patient_idpatient`,`famille_patient_medecin_idmedecin`,`famille_codefamille`),
  ADD KEY `fk_codefamille_Famille1_idx` (`Famille_idfamille`,`famille_medecin_idmedecin`,`famille_patient_idpatient`,`famille_patient_medecin_idmedecin`,`famille_codefamille`);

--
-- Index pour la table `codepatient`
--
ALTER TABLE `codepatient`
  ADD PRIMARY KEY (`codepatient`,`patient_idpatient`,`patient_medecin_idmedecin`,`patient_date_arrivee`,`patient_date_depart`,`patient_codepatient`),
  ADD KEY `fk_codepatient_Patient1_idx` (`patient_idpatient`,`patient_medecin_idmedecin`,`patient_date_arrivee`,`patient_date_depart`,`patient_codepatient`);

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
  ADD PRIMARY KEY (`idpatient`,`medecin_idmedecin`,`date_arrivee`,`date_depart`,`codepatient`),
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
  ADD PRIMARY KEY (`idrapport`,`medecin_idmedecin`,`famille_idfamille`,`famille_medecin_idmedecin`,`patient_idpatient`,`patient_medecin_idmedecin`),
  ADD KEY `fk_Rapport_Médecin1_idx` (`medecin_idmedecin`),
  ADD KEY `fk_Rapport_Famille1_idx` (`famille_idfamille`,`famille_medecin_idmedecin`),
  ADD KEY `fk_Rapport_Patient1_idx` (`patient_idpatient`,`patient_medecin_idmedecin`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `idadministrateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `alerte`
--
ALTER TABLE `alerte`
  MODIFY `idalerte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `capteurs`
--
ALTER TABLE `capteurs`
  MODIFY `idcapteurs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chambre`
--
ALTER TABLE `chambre`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `idchat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `codefamille`
--
ALTER TABLE `codefamille`
  MODIFY `codefamille` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `codepatient`
--
ALTER TABLE `codepatient`
  MODIFY `codepatient` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `famille`
--
ALTER TABLE `famille`
  MODIFY `idfamille` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `idquestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `medecin`
--
ALTER TABLE `medecin`
  MODIFY `idmedecin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `patient`
--
ALTER TABLE `patient`
  MODIFY `idpatient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `rapport`
--
ALTER TABLE `rapport`
  MODIFY `idrapport` int(11) NOT NULL AUTO_INCREMENT;

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
-- Contraintes pour la table `codefamille`
--
ALTER TABLE `codefamille`
  ADD CONSTRAINT `fk_codefamille_Famille1` FOREIGN KEY (`Famille_idfamille`,`famille_medecin_idmedecin`,`famille_patient_idpatient`,`famille_patient_medecin_idmedecin`,`famille_codefamille`) REFERENCES `famille` (`idfamille`, `medecin_idmedecin`, `patient_idpatient`, `patient_medecin_idmedecin`, `codefamille`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `codepatient`
--
ALTER TABLE `codepatient`
  ADD CONSTRAINT `fk_codepatient_Patient1` FOREIGN KEY (`patient_idpatient`,`patient_medecin_idmedecin`,`patient_date_arrivee`,`patient_date_depart`,`patient_codepatient`) REFERENCES `patient` (`idpatient`, `medecin_idmedecin`, `date_arrivee`, `date_depart`, `codepatient`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `famille`
--
ALTER TABLE `famille`
  ADD CONSTRAINT `fk_Famille_Patient1` FOREIGN KEY (`patient_idpatient`,`patient_medecin_idmedecin`) REFERENCES `patient` (`idpatient`, `medecin_idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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

--
-- Contraintes pour la table `rapport`
--
ALTER TABLE `rapport`
  ADD CONSTRAINT `fk_Rapport_Famille1` FOREIGN KEY (`famille_idfamille`,`famille_medecin_idmedecin`) REFERENCES `famille` (`idfamille`, `medecin_idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Rapport_Médecin1` FOREIGN KEY (`medecin_idmedecin`) REFERENCES `medecin` (`idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Rapport_Patient1` FOREIGN KEY (`patient_idpatient`,`patient_medecin_idmedecin`) REFERENCES `patient` (`idpatient`, `medecin_idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
