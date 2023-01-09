-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2023-01-09 14:32:37
-- 服务器版本： 8.0.31
-- PHP 版本： 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `mydb`
--

-- --------------------------------------------------------

--
-- 表的结构 `chat`
--
DROP TABLE `chat`;

CREATE TABLE `chat` (
  `idchat` int NOT NULL,
  `contenu` varchar(45) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `Médecin_idMédecin` int NOT NULL,
  `Famille_idFamille` int NOT NULL,
  `Patient_idPatient` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- 转储表的索引
--

--
-- 表的索引 `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`idchat`),
  ADD KEY `Médecin_idMédecin` (`Médecin_idMédecin`),
  ADD KEY `Famille_idFamille` (`Famille_idFamille`),
  ADD KEY `Patient_idPatient` (`Patient_idPatient`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `chat`
--
ALTER TABLE `chat`
  MODIFY `idchat` int NOT NULL AUTO_INCREMENT;

--
-- 限制导出的表
--

--
-- 限制表 `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`Médecin_idMédecin`) REFERENCES `médecin` (`idMédecin`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`Famille_idFamille`) REFERENCES `famille` (`idFamille`),
  ADD CONSTRAINT `chat_ibfk_3` FOREIGN KEY (`Patient_idPatient`) REFERENCES `patient` (`idPatient`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
