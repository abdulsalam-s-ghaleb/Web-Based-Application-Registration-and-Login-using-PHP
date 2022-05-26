-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2021 at 05:58 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smartiesproject1`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `username` varchar(100) NOT NULL,
  `password_hash` char(40) NOT NULL,
  `phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `password_hash`, `phone`) VALUES
('a00m3', '3f80292724fab2d17ca92487a97f01f783ecfbfc', '123'),
('a00m33', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '123'),
('a00m333', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '123'),
('a00m3333', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '123'),
('a00m33333', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '123');

-- --------------------------------------------------------

--
-- Table structure for table `submitform`
--

CREATE TABLE `submitform` (
  `formID` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `favoriteFood` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `eyeColor` varchar(30) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `URL` varchar(255) NOT NULL,
  `color` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `submitform`
--
ALTER TABLE `submitform`
  ADD PRIMARY KEY (`formID`),
  ADD KEY `FK_submitform_member_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `submitform`
--
ALTER TABLE `submitform`
  MODIFY `formID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `submitform`
--
ALTER TABLE `submitform`
  ADD CONSTRAINT `FK_submitform_member_username` FOREIGN KEY (`username`) REFERENCES `member` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
