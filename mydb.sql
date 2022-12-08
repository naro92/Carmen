-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2022 at 08:37 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
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

-- --------------------------------------------------------

--
-- Table structure for table `alerte`
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
-- Table structure for table `assignation_chambre`
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
-- Table structure for table `capteurs`
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
-- Table structure for table `chambre`
--

CREATE TABLE `chambre` (
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
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
-- Table structure for table `codefamille`
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
-- Table structure for table `codepatient`
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
-- Table structure for table `famille`
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

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `idquestion` int(11) NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `contenu` varchar(4000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`idquestion`, `titre`, `contenu`) VALUES
(1, 'Faq', 'Test faq'),
(2, 'Faq 2', 'Test faq 2'),
(3, 'faq', 'Contenu faq'),
(4, 'faq', 'Contenu faq'),
(5, 'faq', 'Contenu faq');

-- --------------------------------------------------------

--
-- Table structure for table `medecin`
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
-- Dumping data for table `medecin`
--

INSERT INTO `medecin` (`idmedecin`, `nom`, `prenom`, `age`, `adresse_mail`, `mdp`) VALUES
(1, 'A assigner', 'A assigner', '0', 'test@test.com', '157f5fecda4c52fa78bbaaf89e4d10013dcb7a2e842c735238288d6a4043ed70');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
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
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`idpatient`, `nom`, `age`, `sexe`, `mdp`, `adresse`, `medecin_idmedecin`, `date_arrivee`, `date_depart`, `telephone`, `codepatient`, `prenom`, `adresse_mail`) VALUES
(1, 'Kerdrel', NULL, NULL, 'f1845abacf3c2cbc9414043a1e3e3ffb42d33fb421424ae9f867e0086151ff92', NULL, 1, '2022-12-06 20:04:19', '2022-12-06 20:04:19', NULL, 0, NULL, 'tugdualk@hotmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `patient_has_chambre`
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
-- Table structure for table `rapport`
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
-- Indexes for dumped tables
--

--
-- Indexes for table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`idadministrateur`);

--
-- Indexes for table `alerte`
--
ALTER TABLE `alerte`
  ADD PRIMARY KEY (`idalerte`,`medecin_idmedecin`,`patient_idpatient`,`patient_medecin_idmedecin`),
  ADD KEY `fk_alerte_Médecin1_idx` (`medecin_idmedecin`),
  ADD KEY `fk_alerte_Patient1_idx` (`patient_idpatient`,`patient_medecin_idmedecin`);

--
-- Indexes for table `assignation_chambre`
--
ALTER TABLE `assignation_chambre`
  ADD PRIMARY KEY (`patient_idpatient`,`patient_medecin_idmedecin`,`patient_date_arrivee`,`patient_date_depart`,`chambre_numero`),
  ADD KEY `fk_Patient_has_Chambre1_Chambre1_idx` (`chambre_numero`),
  ADD KEY `fk_Patient_has_Chambre1_Patient1_idx` (`patient_idpatient`,`patient_medecin_idmedecin`,`patient_date_arrivee`,`patient_date_depart`);

--
-- Indexes for table `capteurs`
--
ALTER TABLE `capteurs`
  ADD PRIMARY KEY (`idcapteurs`,`chambre_numero`,`medecin_idmedecin`),
  ADD KEY `fk_Capteurs_Chambre1_idx` (`chambre_numero`),
  ADD KEY `fk_Capteurs_Médecin1_idx` (`medecin_idmedecin`);

--
-- Indexes for table `chambre`
--
ALTER TABLE `chambre`
  ADD PRIMARY KEY (`numero`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idchat`,`medecin_idmedecin`,`famille_idfamille`,`famille_medecin_idmedecin`,`famille_patient_idpatient`,`famille_patient_medecin_idmedecin`),
  ADD KEY `fk_Chat_Médecin1_idx` (`medecin_idmedecin`),
  ADD KEY `fk_Chat_Famille1_idx` (`famille_idfamille`,`famille_medecin_idmedecin`,`famille_patient_idpatient`,`famille_patient_medecin_idmedecin`);

--
-- Indexes for table `codefamille`
--
ALTER TABLE `codefamille`
  ADD PRIMARY KEY (`codefamille`,`Famille_idfamille`,`famille_medecin_idmedecin`,`famille_patient_idpatient`,`famille_patient_medecin_idmedecin`,`famille_codefamille`),
  ADD KEY `fk_codefamille_Famille1_idx` (`Famille_idfamille`,`famille_medecin_idmedecin`,`famille_patient_idpatient`,`famille_patient_medecin_idmedecin`,`famille_codefamille`);

--
-- Indexes for table `codepatient`
--
ALTER TABLE `codepatient`
  ADD PRIMARY KEY (`codepatient`,`patient_idpatient`,`patient_medecin_idmedecin`,`patient_date_arrivee`,`patient_date_depart`,`patient_codepatient`),
  ADD KEY `fk_codepatient_Patient1_idx` (`patient_idpatient`,`patient_medecin_idmedecin`,`patient_date_arrivee`,`patient_date_depart`,`patient_codepatient`);

--
-- Indexes for table `famille`
--
ALTER TABLE `famille`
  ADD PRIMARY KEY (`idfamille`,`medecin_idmedecin`,`patient_idpatient`,`patient_medecin_idmedecin`,`codefamille`),
  ADD KEY `fk_Famille_Patient1_idx` (`patient_idpatient`,`patient_medecin_idmedecin`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`idquestion`);

--
-- Indexes for table `medecin`
--
ALTER TABLE `medecin`
  ADD PRIMARY KEY (`idmedecin`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`idpatient`,`medecin_idmedecin`,`date_arrivee`,`date_depart`,`codepatient`),
  ADD KEY `fk_Patient_Médecin1_idx` (`medecin_idmedecin`);

--
-- Indexes for table `patient_has_chambre`
--
ALTER TABLE `patient_has_chambre`
  ADD PRIMARY KEY (`Patient_idPatient`,`Patient_Médecin_idMédecin`,`Patient_dateArrivée`,`Patient_dateDépart`,`Chambre_numero`),
  ADD KEY `fk_Patient_has_Chambre_Chambre1_idx` (`Chambre_numero`),
  ADD KEY `fk_Patient_has_Chambre_Patient1_idx` (`Patient_idPatient`,`Patient_Médecin_idMédecin`,`Patient_dateArrivée`,`Patient_dateDépart`);

--
-- Indexes for table `rapport`
--
ALTER TABLE `rapport`
  ADD PRIMARY KEY (`idrapport`,`medecin_idmedecin`,`famille_idfamille`,`famille_medecin_idmedecin`,`patient_idpatient`,`patient_medecin_idmedecin`),
  ADD KEY `fk_Rapport_Médecin1_idx` (`medecin_idmedecin`),
  ADD KEY `fk_Rapport_Famille1_idx` (`famille_idfamille`,`famille_medecin_idmedecin`),
  ADD KEY `fk_Rapport_Patient1_idx` (`patient_idpatient`,`patient_medecin_idmedecin`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerte`
--
ALTER TABLE `alerte`
  MODIFY `idalerte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `capteurs`
--
ALTER TABLE `capteurs`
  MODIFY `idcapteurs` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chambre`
--
ALTER TABLE `chambre`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `idchat` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `codefamille`
--
ALTER TABLE `codefamille`
  MODIFY `codefamille` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `codepatient`
--
ALTER TABLE `codepatient`
  MODIFY `codepatient` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `famille`
--
ALTER TABLE `famille`
  MODIFY `idfamille` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `idquestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `medecin`
--
ALTER TABLE `medecin`
  MODIFY `idmedecin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `idpatient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rapport`
--
ALTER TABLE `rapport`
  MODIFY `idrapport` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alerte`
--
ALTER TABLE `alerte`
  ADD CONSTRAINT `fk_alerte_Médecin1` FOREIGN KEY (`medecin_idmedecin`) REFERENCES `medecin` (`idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alerte_Patient1` FOREIGN KEY (`patient_idpatient`,`patient_medecin_idmedecin`) REFERENCES `patient` (`idpatient`, `medecin_idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `assignation_chambre`
--
ALTER TABLE `assignation_chambre`
  ADD CONSTRAINT `fk_Patient_has_Chambre1_Chambre1` FOREIGN KEY (`chambre_numero`) REFERENCES `chambre` (`numero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Patient_has_Chambre1_Patient1` FOREIGN KEY (`patient_idpatient`,`patient_medecin_idmedecin`,`patient_date_arrivee`,`patient_date_depart`) REFERENCES `patient` (`idpatient`, `medecin_idmedecin`, `date_arrivee`, `date_depart`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `capteurs`
--
ALTER TABLE `capteurs`
  ADD CONSTRAINT `fk_Capteurs_Chambre1` FOREIGN KEY (`chambre_numero`) REFERENCES `chambre` (`numero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Capteurs_Médecin1` FOREIGN KEY (`medecin_idmedecin`) REFERENCES `medecin` (`idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_Chat_Famille1` FOREIGN KEY (`famille_idfamille`,`famille_medecin_idmedecin`,`famille_patient_idpatient`,`famille_patient_medecin_idmedecin`) REFERENCES `famille` (`idfamille`, `medecin_idmedecin`, `patient_idpatient`, `patient_medecin_idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Chat_Médecin1` FOREIGN KEY (`medecin_idmedecin`) REFERENCES `medecin` (`idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `codefamille`
--
ALTER TABLE `codefamille`
  ADD CONSTRAINT `fk_codefamille_Famille1` FOREIGN KEY (`Famille_idfamille`,`famille_medecin_idmedecin`,`famille_patient_idpatient`,`famille_patient_medecin_idmedecin`,`famille_codefamille`) REFERENCES `famille` (`idfamille`, `medecin_idmedecin`, `patient_idpatient`, `patient_medecin_idmedecin`, `codefamille`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `codepatient`
--
ALTER TABLE `codepatient`
  ADD CONSTRAINT `fk_codepatient_Patient1` FOREIGN KEY (`patient_idpatient`,`patient_medecin_idmedecin`,`patient_date_arrivee`,`patient_date_depart`,`patient_codepatient`) REFERENCES `patient` (`idpatient`, `medecin_idmedecin`, `date_arrivee`, `date_depart`, `codepatient`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `famille`
--
ALTER TABLE `famille`
  ADD CONSTRAINT `fk_Famille_Patient1` FOREIGN KEY (`patient_idpatient`,`patient_medecin_idmedecin`) REFERENCES `patient` (`idpatient`, `medecin_idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `fk_Patient_Médecin1` FOREIGN KEY (`medecin_idmedecin`) REFERENCES `medecin` (`idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `patient_has_chambre`
--
ALTER TABLE `patient_has_chambre`
  ADD CONSTRAINT `fk_Patient_has_Chambre_Chambre1` FOREIGN KEY (`Chambre_numero`) REFERENCES `chambre` (`numero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Patient_has_Chambre_Patient1` FOREIGN KEY (`Patient_idPatient`,`Patient_Médecin_idMédecin`,`Patient_dateArrivée`,`Patient_dateDépart`) REFERENCES `patient` (`idpatient`, `medecin_idmedecin`, `date_arrivee`, `date_depart`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rapport`
--
ALTER TABLE `rapport`
  ADD CONSTRAINT `fk_Rapport_Famille1` FOREIGN KEY (`famille_idfamille`,`famille_medecin_idmedecin`) REFERENCES `famille` (`idfamille`, `medecin_idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Rapport_Médecin1` FOREIGN KEY (`medecin_idmedecin`) REFERENCES `medecin` (`idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Rapport_Patient1` FOREIGN KEY (`patient_idpatient`,`patient_medecin_idmedecin`) REFERENCES `patient` (`idpatient`, `medecin_idmedecin`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
