-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2023-01-08 22:03:28
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
-- 数据库： `chat`
--

-- --------------------------------------------------------

--
-- 表的结构 `chat`
--

CREATE TABLE `chat` (
  `nubchat` int NOT NULL,
  `medecinID` int DEFAULT NULL,
  `patientID` int DEFAULT NULL,
  `contenu` varchar(10000) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- 转存表中的数据 `chat`
--

INSERT INTO `chat` (`nubchat`, `medecinID`, `patientID`, `contenu`, `time`) VALUES
(47, 1, 1, 'easdasdasd', '2023-01-08 02:40:37'),
(48, 1, 1, 'adsdad', '2023-01-08 02:43:34'),
(49, 1, 1, 'asdad', '2023-01-08 02:43:38'),
(50, 1, 1, '567', '2023-01-08 02:44:02'),
(51, 1, 1, 'asda', '2023-01-08 02:45:17'),
(52, 1, 1, 'asdads', '2023-01-08 02:47:54'),
(53, 1, 1, 'asdads', '2023-01-08 02:58:04'),
(54, 1, 1, 'asdas', '2023-01-08 03:18:25'),
(55, 1, 1, 'asda', '2023-01-08 03:18:29'),
(56, 1, 1, 'adsasd', '2023-01-08 15:24:57'),
(57, 1, 1, 'hhkjhkjhk', '2023-01-08 15:25:46'),
(58, 1, 1, 'asdad', '2023-01-08 15:31:01'),
(59, 1, 1, 'adsda', '2023-01-08 15:31:03'),
(60, 1, 1, 'xsxs', '2023-01-08 15:31:18'),
(61, 1, 1, 'dasdsad', '2023-01-08 15:31:20'),
(62, 1, 1, 'asdasd', '2023-01-08 15:31:28'),
(63, 1, 1, 'aasdasd', '2023-01-08 15:32:31'),
(64, 1, 1, 'xsadasd', '2023-01-08 15:35:01'),
(65, 1, 1, 'sadsad', '2023-01-08 15:36:12'),
(66, 1, 1, 'asdasd', '2023-01-08 15:36:22'),
(67, 1, 1, 'asdas', '2023-01-08 15:37:35'),
(68, 1, 1, 'sada', '2023-01-08 16:28:40'),
(69, 1, 1, 'asdad', '2023-01-08 16:28:41'),
(70, 1, 1, 'asdasd', '2023-01-08 16:29:33'),
(71, 1, 1, 'asdasd', '2023-01-08 16:42:14'),
(72, 1, 1, 'asdas', '2023-01-08 16:42:16'),
(73, 1, 1, '123', '2023-01-08 16:42:17'),
(74, 1, 1, '12312', '2023-01-08 17:11:10'),
(75, 1, 1, '123123124', '2023-01-08 17:11:12'),
(76, 1, 1, 'asda', '2023-01-08 17:15:04'),
(77, 1, 1, '123132123213', '2023-01-08 17:51:24'),
(78, 1, 1, 'asda', '2023-01-08 18:00:36');

-- --------------------------------------------------------

--
-- 表的结构 `medecin`
--

CREATE TABLE `medecin` (
  `ID` int NOT NULL,
  `nom` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- 转存表中的数据 `medecin`
--

INSERT INTO `medecin` (`ID`, `nom`) VALUES
(1, 'a'),
(2, 'b'),
(3, 'c');

-- --------------------------------------------------------

--
-- 表的结构 `patient`
--

CREATE TABLE `patient` (
  `nub` int NOT NULL,
  `medecinID` int DEFAULT NULL,
  `patientID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- 转存表中的数据 `patient`
--

INSERT INTO `patient` (`nub`, `medecinID`, `patientID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 3, 3),
(4, 2, 4);

-- --------------------------------------------------------

--
-- 表的结构 `patientnom`
--

CREATE TABLE `patientnom` (
  `ID` int NOT NULL,
  `nom` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `medecinID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- 转存表中的数据 `patientnom`
--

INSERT INTO `patientnom` (`ID`, `nom`, `medecinID`) VALUES
(1, 'x', 1),
(2, 'y', 2),
(3, 'z', 3);

--
-- 转储表的索引
--

--
-- 表的索引 `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`nubchat`);

--
-- 表的索引 `medecin`
--
ALTER TABLE `medecin`
  ADD PRIMARY KEY (`ID`);

--
-- 表的索引 `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`nub`);

--
-- 表的索引 `patientnom`
--
ALTER TABLE `patientnom`
  ADD PRIMARY KEY (`ID`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `chat`
--
ALTER TABLE `chat`
  MODIFY `nubchat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
