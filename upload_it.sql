-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2021 at 09:40 AM
-- Server version: 10.3.31-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `startapp_gamedev`
--

-- --------------------------------------------------------

--
-- Table structure for table `Actions`
--

CREATE TABLE `Actions` (
  `ID` int(11) NOT NULL,
  `IP` varchar(15) NOT NULL,
  `Action` text NOT NULL,
  `Timestamp` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Quotes`
--

CREATE TABLE `Quotes` (
  `ID` int(11) NOT NULL,
  `Quote` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Quotes`
--

INSERT INTO `Quotes` (`ID`, `Quote`) VALUES
(1, '<em>עדיף שני ביצים ואוצר ביד מאשר אספרגוס חתוך על צלחת נייר</em>'),
(2, '<em>לא מספיק לא הגעת בזמן עכשיו אתה גם מאחר?</em>'),
(3, '<em>גם קפטן הוק היה אוכל בננות וגם הוא לא מצא את האוצר</em>');

-- --------------------------------------------------------

--
-- Table structure for table `Requests`
--

CREATE TABLE `Requests` (
  `ID` int(11) NOT NULL,
  `IP` varchar(15) NOT NULL,
  `Req` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `ID` int(11) NOT NULL,
  `Email` mediumtext NOT NULL,
  `Password` text NOT NULL,
  `Won` int(100) NOT NULL DEFAULT 0,
  `Lost` int(20) NOT NULL DEFAULT 0,
  `Role` tinyint(1) NOT NULL DEFAULT 1,
  `RegisteredIP` varchar(15) NOT NULL,
  `LastIP` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`ID`, `Email`, `Password`, `Won`, `Lost`, `Role`, `RegisteredIP`, `LastIP`) VALUES
(2, '3@gmail.com', '$2y$10$Rh4exsAEWW2MChyd0Lk.YeAS4YYimMAI91N0SuZQsqu.Y4/ATurRu', 3, 3, 1, '79.180.3.9', NULL),
(3, 'main@gmail.com', '$2y$10$pWzd403yK2q3.3UfNN0gJ.729rW/vUtXma7anQ2WtBrLnOBR/Hy5C', 25, 36, 2, '79.180.3.9', '79.180.3.9'),
(4, '1@gmail.com', '$2y$10$pWzd403yK2q3.3UfNN0gJ.729rW/vUtXma7anQ2WtBrLnOBR/Hy5C', 1, 1, 1, '79.180.3.9', '79.180.3.9'),
(5, '2@gmail.com', '$2y$10$Rh4exsAEWW2MChyd0Lk.YeAS4YYimMAI91N0SuZQsqu.Y4/ATurRu', 2, 2, 1, '79.180.3.9', NULL),
(6, '4@gmail.com', '$2y$10$Rh4exsAEWW2MChyd0Lk.YeAS4YYimMAI91N0SuZQsqu.Y4/ATurRu', 4, 4, 1, '79.180.3.9', NULL),
(7, '5@gmail.com', '$2y$10$pWzd403yK2q3.3UfNN0gJ.729rW/vUtXma7anQ2WtBrLnOBR/Hy5C', 5, 5, 1, '79.180.3.9', '79.180.3.9'),
(8, '6@gmail.com', '$2y$10$Rh4exsAEWW2MChyd0Lk.YeAS4YYimMAI91N0SuZQsqu.Y4/ATurRu', 6, 6, 1, '79.180.3.9', NULL),
(9, '7@gmail.com', '$2y$10$pWzd403yK2q3.3UfNN0gJ.729rW/vUtXma7anQ2WtBrLnOBR/Hy5C', 7, 7, 1, '79.180.3.9', '79.180.3.9'),
(10, '8@gmail.com', '$2y$10$Rh4exsAEWW2MChyd0Lk.YeAS4YYimMAI91N0SuZQsqu.Y4/ATurRu', 8, 8, 1, '79.180.3.9', NULL),
(11, '9@gmail.com', '$2y$10$Rh4exsAEWW2MChyd0Lk.YeAS4YYimMAI91N0SuZQsqu.Y4/ATurRu', 9, 9, 1, '79.180.3.9', NULL),
(12, '10@gmail.com', '$2y$10$Rh4exsAEWW2MChyd0Lk.YeAS4YYimMAI91N0SuZQsqu.Y4/ATurRu', 10, 10, 1, '79.180.3.9', NULL),
(13, '11@gmail.com', '$2y$10$pWzd403yK2q3.3UfNN0gJ.729rW/vUtXma7anQ2WtBrLnOBR/Hy5C', 11, 11, 1, '79.180.3.9', '79.180.3.9'),
(14, '12@gmail.com', '$2y$10$Rh4exsAEWW2MChyd0Lk.YeAS4YYimMAI91N0SuZQsqu.Y4/ATurRu', 12, 12, 1, '79.180.3.9', NULL),
(15, 'aasdsada@asdadsa.com', '$2y$10$QQ.eYbmqvu6wv0f.hd.sY.XM/R6d5R0GTM6cx3ijCAsFFu5aZJub2', 2, 1, 1, '82.81.234.78', '82.81.234.78'),
(16, 'noam@gmail.com', '$2y$10$J7YUc6I.CNZWrj4AkGjZcOid5ngbXgjiJ92pNhuQiYZO9l87e6gdu', 20, 18, 1, '164.138.127.10', '164.138.127.10'),
(17, 'main123@gmail.com', '$2y$10$nkgPnWQIgmDHLwyBL/DEpOhhua9t1TPPIRbAYuDYqSJ/ALZYBsxTm', 0, 0, 1, '79.180.3.9', NULL),
(18, 'zasdasd@gmail.com', '$2y$10$qI2bXSkfRQYnH2SmDKDJ1OA45gejHIvQBdQwPXmrS/6jYkkszECta', 1, 1, 1, '79.180.3.9', '79.180.3.9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Actions`
--
ALTER TABLE `Actions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Quotes`
--
ALTER TABLE `Quotes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Requests`
--
ALTER TABLE `Requests`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Actions`
--
ALTER TABLE `Actions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT for table `Quotes`
--
ALTER TABLE `Quotes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Requests`
--
ALTER TABLE `Requests`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
