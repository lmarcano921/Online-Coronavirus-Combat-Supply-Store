-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2020 at 06:36 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.0.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `occss`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `ID` int(11) NOT NULL,
  `Item` varchar(255) NOT NULL,
  `Qty` int(50) NOT NULL,
  `Price` float NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`ID`, `Item`, `Qty`, `Price`, `Description`) VALUES
(1, 'Toilet Paper', 0, 8.99, 'A thin sanitary absorbent paper. 1000 sheets. A basic human right.'),
(2, 'Hand Sanitizer', 25, 5.99, 'Kills 99.99% of bacteria. Unscented. A must-have during this dire time. '),
(3, 'Pet Food 1lb', 43, 8.49, 'It\'s organic, non-GMO and free-range. Only made with natural ingredients. No artificial flavors or preservatives. '),
(4, 'Multivitamin Gummies', 36, 15.25, 'For energy, metabolism, bone and immune system support. Complete multivitamin dietary supplement.'),
(5, 'Medical Clothing', 3, 35, 'Its role is to isolate germs, acid and alkaline solutions, electromagnetic radiation, etc., to ensure the safety of personnel and keep the environment clean.'),
(6, 'Medical Mask', 10, 10, 'The medical isolation mask is composed of a protective cover made of polymer material, a foam strip and a fixing device. Non-sterile, one-time use, blocks bodily fluids.'),
(7, 'Isopropyl Alcohol', 12, 5, 'Medical alcohol, disinfection and sterilization.'),
(8, 'Laser Thermometer', 5, 150, 'Detection temperature, tests for fever.'),
(9, 'Tylenol', 7, 7, 'A pain reliever and a fever reducer.'),
(10, 'Canned Food', 30, 3, 'Canned lunch meat can be stored for a long time.'),
(11, 'Water Bottles', 50, 6.25, '24-pack. One of most important thing that humans need, H2O.'),
(12, 'Instant Noodles', 50, 12, '24-pack. Noodles that are easy to cook and can be stored for a long time.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(16) NOT NULL,
  `Two_Factor` varchar(1) NOT NULL,
  `user_sec_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `firstName`, `lastName`, `email`, `password`, `Two_Factor`, `user-sec-code`) VALUES
(22, 'Aleena', 'Tim', 'aleenatim@gmail.com', 'abc123', '1', ''),
(23, 'Aleena', 'Tim', 'aleena@wcbryanths.org', 'abc123', '0', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
