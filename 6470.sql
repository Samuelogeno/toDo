-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2018 at 10:10 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `6470`
--

-- --------------------------------------------------------

--
-- Table structure for table `6470users`
--

CREATE TABLE `6470users` (
  `ID` int(50) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD_HASH` varchar(500) NOT NULL,
  `PHONE` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `6470users`
--

INSERT INTO `6470users` (`ID`, `USERNAME`, `PASSWORD_HASH`, `PHONE`) VALUES
(27, 'Becca', '$2y$10$2OSLb39xVzJ6WhHSNKn/muCt.Rjc6qS8E/gkKXG0bW.09l9iKw2x.', '0795487262'),
(28, 'Andrew', '$2y$10$2pyqylLTMNriQVn8T3HMZOlOiqo/qfa41xGKkhEFR4R.kpDf9d6/a', '0723546707'),
(29, 'piefwn', '$2y$10$PaLQ2RZhn1ewu3uAcDDcoePvn6eKO83/bqR1pREDbwOnPiyXUoDEW', '8257'),
(30, 'Andy', '$2y$10$OVupubG9yM76CzKNekoX.uAOtJqy/GUd86GL5ezfmw9z6os4cWgnK', '0700440044');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(255) NOT NULL,
  `username` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `timeRemind` date NOT NULL,
  `timeSet` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `username`, `title`, `description`, `timeRemind`, `timeSet`) VALUES
(24, 'Becca', 'supper', 'Go for lunch at pepinos', '2018-03-12', '2018-03-12 05:40:59.099449');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `6470users`
--
ALTER TABLE `6470users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `6470users`
--
ALTER TABLE `6470users`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
