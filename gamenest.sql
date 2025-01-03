-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2025 at 05:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamenest`
--

-- --------------------------------------------------------

--
-- Table structure for table `bronze`
--

CREATE TABLE `bronze` (
  `User_id` varchar(24) NOT NULL,
  `bronze discount amount` decimal(3,2) NOT NULL DEFAULT 0.05
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game`
--

CREATE TABLE `game` (
  `Name` varchar(30) NOT NULL,
  `Game ID` varchar(24) NOT NULL,
  `Genre` varchar(30) NOT NULL,
  `Release Year` date NOT NULL,
  `Rating` int(11) NOT NULL,
  `Age Restriction` int(11) NOT NULL,
  `Price Per Day` int(11) NOT NULL,
  `Availability` tinyint(1) NOT NULL,
  `Platform` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `game`
--

INSERT INTO `game` (`Name`, `Game ID`, `Genre`, `Release Year`, `Rating`, `Age Restriction`, `Price Per Day`, `Availability`, `Platform`) VALUES
('The Witcher 3: Wild Hunt', 'GID001', 'Adventure', '2015-05-19', 10, 18, 50, 1, 'PC'),
('Horizon Zero Dawn', 'GID002', 'Adventure', '2017-02-28', 9, 16, 45, 1, 'PS4'),
('Shadow of the Colossus', 'GID003', 'Adventure', '2005-10-18', 9, 16, 40, 1, 'PS4'),
('Firewatch', 'GID004', 'Adventure', '2016-02-09', 8, 16, 30, 1, 'PC'),
('Red Dead Redemption 2', 'GID005', 'Action', '2018-10-26', 10, 18, 60, 1, 'PC'),
('Tomb Raider', 'GID006', 'Action', '2013-03-05', 9, 16, 40, 1, 'PC'),
('God of War', 'GID007', 'Action', '2018-04-20', 10, 18, 55, 1, 'PS4'),
('Assassin\'s Creed Origins', 'GID008', 'Action', '2017-10-27', 9, 18, 50, 1, 'PC'),
('Skyrim', 'GID009', 'RPG', '2011-11-11', 9, 16, 30, 1, 'PC'),
('Divinity: Original Sin 2', 'GID010', 'RPG', '2017-09-14', 9, 16, 35, 1, 'PC'),
('Dragon Age: Inquisition', 'GID011', 'RPG', '2014-11-18', 8, 16, 30, 1, 'PC'),
('Cyberpunk 2077', 'GID012', 'RPG', '2020-12-10', 8, 18, 50, 1, 'PC'),
('The Witness', 'GID013', 'Puzzle', '2016-01-26', 8, 12, 20, 1, 'PC'),
('Portal 2', 'GID014', 'Puzzle', '2011-04-18', 10, 12, 25, 1, 'PC'),
('The Talos Principle', 'GID015', 'Puzzle', '2014-12-11', 8, 12, 20, 1, 'PC'),
('Inside', 'GID016', 'Puzzle', '2016-07-07', 9, 12, 15, 1, 'PC'),
('Stardew Valley', 'GID017', 'Simulation', '2016-02-26', 9, 7, 15, 1, 'PC'),
('Cities: Skylines', 'GID018', 'Simulation', '2015-03-10', 8, 12, 20, 1, 'PC'),
('The Sims 4', 'GID019', 'Simulation', '2014-09-02', 8, 12, 25, 1, 'PC'),
('Planet Zoo', 'GID020', 'Simulation', '2019-11-05', 8, 12, 30, 1, 'PC'),
('Ori and the Blind Forest', 'GID021', 'Platformer', '2015-03-11', 9, 7, 25, 1, 'PC'),
('Celeste', 'GID022', 'Platformer', '2018-01-25', 10, 7, 30, 1, 'PC'),
('Hollow Knight', 'GID023', 'Platformer', '2017-02-24', 9, 7, 20, 1, 'PC'),
('Super Meat Boy', 'GID024', 'Platformer', '2010-10-20', 8, 7, 15, 1, 'PC'),
('XCOM 2', 'GID025', 'Strategy', '2016-02-05', 9, 12, 40, 1, 'PC'),
('Civilization VI', 'GID026', 'Strategy', '2016-10-21', 9, 12, 30, 1, 'PC'),
('Age of Empires II: Definitive ', 'GID027', 'Strategy', '2019-11-14', 9, 7, 20, 1, 'PC'),
('Total War: Shogun 2', 'GID028', 'Strategy', '2011-03-15', 9, 12, 25, 1, 'PC'),
('Resident Evil 4 Remake', 'GID029', 'Horror', '2005-01-11', 10, 18, 30, 1, 'PC'),
('Outlast', 'GID030', 'Horror', '2013-09-04', 9, 18, 25, 1, 'PC'),
('Amnesia: The Dark Descent', 'GID031', 'Horror', '2010-09-08', 9, 18, 20, 1, 'PC'),
('Alien: Isolation', 'GID032', 'Horror', '2014-10-07', 9, 18, 35, 1, 'PC'),
('Journey', 'GID033', 'Indie', '2012-03-13', 9, 7, 15, 1, 'PC'),
('Undertale', 'GID034', 'Indie', '2015-09-15', 10, 7, 10, 1, 'PC'),
('Bastion', 'GID035', 'Indie', '2011-07-20', 8, 7, 15, 1, 'PC'),
('Limbo', 'GID036', 'Indie', '2010-07-21', 9, 7, 10, 1, 'PC'),
('Mass Effect 2', 'GID037', 'Sci-Fi', '2010-01-26', 10, 18, 40, 1, 'PC'),
('Star Wars Jedi: Fallen Order', 'GID038', 'Sci-Fi', '2019-11-15', 9, 16, 45, 1, 'PC'),
('Control', 'GID039', 'Sci-Fi', '2019-08-27', 8, 16, 30, 1, 'PC'),
('Deus Ex: Human Revolution', 'GID040', 'Sci-Fi', '2011-08-23', 9, 16, 35, 1, 'PC'),
('FIFA 20', 'GID041', 'Sports', '2019-09-27', 7, 7, 20, 1, 'PC'),
('PGA Tour 2K21', 'GID042', 'Sports', '2020-08-21', 8, 7, 25, 1, 'PC'),
('Tony Hawk\'s Pro Skater 1+2', 'GID043', 'Sports', '2020-09-04', 8, 7, 30, 1, 'PC'),
('NBA 2K21', 'GID044', 'Sports', '2020-09-04', 7, 7, 20, 1, 'PC'),
('Hitman 3', 'GID045', 'Stealth', '2021-01-20', 9, 18, 50, 1, 'PC'),
('Dishonored 2', 'GID046', 'Stealth', '2016-11-11', 9, 16, 35, 1, 'PC'),
('Thief', 'GID047', 'Stealth', '2014-02-25', 7, 16, 30, 1, 'PC'),
('Splinter Cell: Blacklist', 'GID048', 'Stealth', '2013-08-20', 8, 16, 25, 1, 'PC'),
('Dark Souls III', 'GID049', 'Fantasy', '2016-04-12', 10, 18, 50, 1, 'PC'),
('Dragon\'s Dogma: Dark Arisen', 'GID050', 'Fantasy', '2013-04-23', 9, 16, 35, 1, 'PC');

-- --------------------------------------------------------

--
-- Table structure for table `general`
--

CREATE TABLE `general` (
  `User_Id` varchar(24) NOT NULL,
  `General Discount Amount` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general`
--

INSERT INTO `general` (`User_Id`, `General Discount Amount`) VALUES
('aleef123', 0),
('altair123', 0),
('fahan123', 0),
('Khalid123', 0),
('tazin123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `gold`
--

CREATE TABLE `gold` (
  `User_id` varchar(24) NOT NULL,
  `gold discount amount` decimal(3,2) NOT NULL DEFAULT 0.15
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `owned games`
--

CREATE TABLE `owned games` (
  `library_id` varchar(24) NOT NULL,
  `Game name` varchar(50) NOT NULL,
  `Game id` varchar(30) NOT NULL,
  `Time Limit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owned games`
--

INSERT INTO `owned games` (`library_id`, `Game name`, `Game id`, `Time Limit`) VALUES
('anusheh123', 'Horizon Zero Dawn', 'GID002', '2025-01-14'),
('anusheh123', 'Firewatch', 'GID004', '2025-01-30'),
('anusheh123', 'The Witness', 'GID013', '2025-01-16'),
('altair123', 'Assassin\'s Creed Origins', 'GID008', '2025-01-09'),
('anusheh123', 'Resident Evil 4 Remake', 'GID029', '2025-01-23'),
('anusheh123', 'Journey', 'GID033', '2025-01-24'),
('anusheh123', 'Red Dead Redemption 2', 'GID005', '2025-01-06'),
('aleef123', 'Shadow of the Colossus', 'GID003', '2025-01-16'),
('aleef123', 'Horizon Zero Dawn', 'GID002', '2025-01-15'),
('aleef123', 'The Witcher 3: Wild Hunt', 'GID001', '2025-01-23');

-- --------------------------------------------------------

--
-- Table structure for table `silver`
--

CREATE TABLE `silver` (
  `User_id` varchar(24) NOT NULL,
  `silver discount amount` decimal(3,2) NOT NULL DEFAULT 0.10
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `silver`
--

INSERT INTO `silver` (`User_id`, `silver discount amount`) VALUES
('anusheh123', 0.10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_id` varchar(24) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `DoB` date NOT NULL,
  `Join Date` date NOT NULL DEFAULT current_timestamp(),
  `User Point` int(11) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `Upayment_id` varchar(5) DEFAULT NULL,
  `ULibrary_Id` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_id`, `Name`, `email`, `DoB`, `Join Date`, `User Point`, `password`, `Upayment_id`, `ULibrary_Id`) VALUES
('aleef123', 'Alfa', 'aleef@gmail.com', '2001-03-01', '2025-01-02', 4, '$2y$10$bVbaVtPXxNUbDlIjuKpvg.ZIyvDJVn1Y0/1enbQAIOZg5CVNdzn06', NULL, 'aleef123'),
('altair123', 'altair', 'altair@gmail.com', '1263-03-15', '2025-01-03', 1, '$2y$10$7IXGiyneer5JwY7BmHZsM.Gg2xuGsjfV53uOV92L1voMqdO/JVGWe', NULL, 'altair123'),
('anusheh123', 'anusheh', 'anusheh@gmail.com', '2002-03-28', '2025-01-02', 21, '$2y$10$G9GsVR1OVc5Jt/Q1PvSIzuKxF58kL5aLSCYAVgVwRyiVaHlWY7QGC', NULL, 'anusheh123'),
('basim12', 'basim', 'basim@gmail.com', '2025-01-23', '2025-01-01', 0, '$2y$10$HlH025BOZ9vbva0TifQ90.b', NULL, 'basim12'),
('fahan123', 'fahan', 'fahan@gmail.com', '2003-01-11', '2025-01-03', 0, '$2y$10$07mTxEX5BC2Q0wb/j.ac5urNnkcOyOT0G3QtIlbzRzrseaigXkmPy', NULL, 'fahan123'),
('Khalid123', 'khalid', 'khalid@gmail.com', '2001-03-01', '2025-01-02', 0, '$2y$10$TGGgpWnJdiksRzmH7z1q0OLZvKPHoJZunP5th5edA4Lw2yUqGCj1e', NULL, 'Khalid123'),
('shayla123', 'shayla', 'shayla@gmail.com', '2001-04-11', '2025-01-02', 0, '$2y$10$c/q3Sijm2a/dAguAK6Pp7e5N4V6PE575VIelCwNthU8T9s5MDdU3W', NULL, 'shayla123'),
('tazin123', 'tazin', 'tazin@gmail.com', '2001-04-11', '2025-01-02', 0, '$2y$10$gcv4K/b2WDeOKhL71vzmSewUAOK62bc.Py67Nth9ujU12WfFwNkCC', NULL, 'tazin123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bronze`
--
ALTER TABLE `bronze`
  ADD PRIMARY KEY (`User_id`);

--
-- Indexes for table `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`Game ID`);

--
-- Indexes for table `general`
--
ALTER TABLE `general`
  ADD PRIMARY KEY (`User_Id`);

--
-- Indexes for table `gold`
--
ALTER TABLE `gold`
  ADD PRIMARY KEY (`User_id`);

--
-- Indexes for table `silver`
--
ALTER TABLE `silver`
  ADD PRIMARY KEY (`User_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`),
  ADD KEY `fk_upaymentID` (`Upayment_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bronze`
--
ALTER TABLE `bronze`
  ADD CONSTRAINT `fk_br_id` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`);

--
-- Constraints for table `general`
--
ALTER TABLE `general`
  ADD CONSTRAINT `fk_userid` FOREIGN KEY (`User_Id`) REFERENCES `user` (`User_id`);

--
-- Constraints for table `gold`
--
ALTER TABLE `gold`
  ADD CONSTRAINT `fk_gl_id` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`);

--
-- Constraints for table `silver`
--
ALTER TABLE `silver`
  ADD CONSTRAINT `fk_sil_id` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_upaymentID` FOREIGN KEY (`Upayment_id`) REFERENCES `payment _table` (`Payment_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
