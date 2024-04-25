-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 25, 2024 at 10:17 AM
-- Server version: 8.2.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_ds2_binome`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int NOT NULL AUTO_INCREMENT,
  `titre_article` varchar(30) NOT NULL,
  `desc_article` text NOT NULL,
  `img_article` varchar(30) NOT NULL,
  `contenu_article` text NOT NULL,
  `date_article` date NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id_article`, `titre_article`, `desc_article`, `img_article`, `contenu_article`, `date_article`) VALUES
(1, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaajgvuitgfvuiygbtuifytdrexstesrz', 'image1.jpg', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '0000-00-00'),
(2, 'nour', 'gttrnehnofuhzeou', 'photocv.png', 'rnfjrhogurijipjez', '2024-04-24'),
(3, 'nour', 'gttrnehnofuhzeou', 'photocv.png', 'rnfjrhogurijipjez', '2024-04-24'),
(4, 'nourchernii', 'gttrnehnofuhzeourrr', 'photocv.png', 'rnfjrhoguyjjttdfddrrrrijipjez', '2024-04-24'),
(5, 'nourchernii', 'gttrnehnofuhzeourrr', 'photocv.png', 'rnfjrhoguyjjttdfddrrrrijipjez', '2024-04-24'),
(6, 'nourchernii78488', 'frvsbduehoiejpziajazpijz', 'photocv.png', 'meprojfproihrouhgggiaaafef', '2024-04-24'),
(7, 'nourchernii78488', 'frvsbduehoiejpziajazpijz', 'photocv.png', 'meprojfproihrouhgggiaaafef', '2024-04-24'),
(8, '', '', '', '', '2024-04-24'),
(9, '', '', '', '', '2024-04-24'),
(10, 'nour', 'ghshyjstju', 'scrum.png', 'gthyrqjryjue', '2024-04-25'),
(11, 'nour', 'ghshyjstju', 'scrum.png', 'gthyrqjryjue', '2024-04-25'),
(12, 'nour', 'ghshyjstju', 'scrum.png', 'gthyrqjryjue', '2024-04-25'),
(13, 'nourchernii', 'fbfbqthyhyr', 'scrum.png', '<rg<trhthyyyyyyrrre', '2024-04-25'),
(14, 'nourchernii', 'fbfbqthyhyr', 'scrum.png', '<rg<trhthyyyyyyrrre', '2024-04-25'),
(15, 'nourchernii', 'fbfbqthyhyr', 'scrum.png', '<rg<trhthyyyyyyrrre', '2024-04-25'),
(16, 'nourchernii', 'fbfbqthyhyr', 'scrum.png', '<rg<trhthyyyyyyrrre', '2024-04-25'),
(17, 'nourchernii', 'fbfbqthyhyr', 'scrum.png', '<rg<trhthyyyyyyrrre', '2024-04-25'),
(18, 'nourchernii', 'fbfbqthyhyr', 'scrum.png', '<rg<trhthyyyyyyrrre', '2024-04-25'),
(19, 'Houssem', 'houssemo', '7oct.jpeg', 'tayy', '2024-04-25'),
(20, 'Houssem', 'houssemo', '7oct.jpeg', 'tayy', '2024-04-25'),
(21, 'lihjrfihr', 'zhdfihzhzsi', '7oct.jpeg', 'zlslijsz', '2024-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id_comm` int NOT NULL AUTO_INCREMENT,
  `id` int NOT NULL,
  `contenu` varchar(255) NOT NULL,
  PRIMARY KEY (`id_comm`),
  KEY `fk1` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` int NOT NULL AUTO_INCREMENT,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `author` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_comment`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_comment`, `comment`, `author`, `date`) VALUES
(1, 'trhjiefjzezijpijfezpifpipzrpir', '0000-00-00 00:00:00', '2024-04-25 01:30:54'),
(2, 'trhjiefjzezijpijfezpifpipzrpir', '0000-00-00 00:00:00', '2024-04-25 01:30:54'),
(3, 'trhjiefjzezijpijfezpifpipzrpir', '0000-00-00 00:00:00', '2024-04-25 01:30:54'),
(4, 'aaaaaaaaaaaaaaaaaaaaaaa', '0000-00-00 00:00:00', '2024-04-25 01:30:54'),
(5, 'vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', '0000-00-00 00:00:00', '2024-04-25 01:30:54'),
(6, 'nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', 'aaaaaaaaaaaaa', '2024-04-25 01:31:04'),
(7, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'aaaaaaaaaaaaa', '2024-04-25 01:34:46'),
(8, 'ttttttttttttttttttttttttt', 'aaaaaaaaaaaaa', '2024-04-25 01:35:26'),
(9, 'hrjijrijrepijoai', 'nour cherni', '2024-04-25 08:45:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `mot_passe` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'USER',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `mot_passe`, `nom`, `prenom`, `type`) VALUES
(1, 'nourcherni@gmail.com', 'aaaa', 'cherni', 'nour', 'USER'),
(2, 'nourcherni@gmail.com', 'zzz', 'cherni', 'nour', 'USER'),
(3, '', '', '', '', 'USER'),
(4, '', '', '', '', 'USER'),
(5, 'aa@gmail.com', 'azer', 'aaa', 'kkkk', 'USER'),
(6, 'nourcherni@gmail.com', 'kkkk', 'cherni', 'nour', 'USER'),
(7, 'azerzizou123@gmail.com', 'eee', 'EZRZ', 'zaEZA', 'USER'),
(8, 'azerzizou123@gmail.com', 'eee', 'EZRZ', 'zaEZA', 'USER'),
(9, 'azerzizou123@gmail.com', 'eee', 'EZRZ', 'zaEZA', 'USER'),
(10, 'azerzizou123@gmail.com', 'zzzzz', 'EZRZ', 'zaEZA', 'USER'),
(11, 'Djebbi.imen@yahoo.co.uk', 'rrr', 'gthftguf', 'ujohujhu', 'USER'),
(12, 'ileflafloufa@gmail.com', 'eeee', 'ilef', 'sahraoui', 'USER'),
(13, 'kouz1@gmail.com', 'azer', 'kouz', 'bouz', 'USER'),
(14, 'doudou@gmail.com', 'azer', 'doussa', 'lebhima', 'USER'),
(15, 'nourcherni@gmail.com', 'zzz', 'cherni', 'nour', 'USER'),
(16, 'nourcherni@gmail.com', 'zzz', 'cherni', 'nour', 'USER'),
(17, 'amircherni2003@gmail.com', 'mariem', 'amir', 'cherni', 'USER'),
(18, '', '', '', '', 'USER');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
