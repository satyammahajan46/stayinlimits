-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2019 at 05:49 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `limits`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounttype`
--

CREATE TABLE `accounttype` (
  `account` tinyint(20) NOT NULL,
  `description` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounttype`
--

INSERT INTO `accounttype` (`account`, `description`) VALUES
(0, 'Individual'),
(1, 'Group');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `ID` int(11) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`ID`, `fname`, `lname`, `email`, `message`) VALUES
(1, 'gs', 'KBK', 'KUG', 'GKGKG'),
(2, 'SATYAN', 'akjdb', 'kbk@nkjn', 'kjbkjnbkjn'),
(3, 'asbchjv', 'jvhc', 'smahajan02@lANOIFH.AIHBCSUYV', 'vhjvj\r\n'),
(4, 'SATYAN', 'sa', 'cda@afe.co', 'da\r\n'),
(5, 'ksjabck', 'kvakhadskvc', 'kamehameha@gmail.com', 'nbhjebvqabc\r\nsdnvoigwsdiubfviuw\r\naerkjfbgiuaerb\r\nbsekjvnka');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transID` varchar(30) NOT NULL,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `email` varchar(255) NOT NULL,
  `credit` int(11) NOT NULL,
  `debit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transID`, `date`, `email`, `credit`, `debit`) VALUES
('100', '2019-05-19', 'satyam@satyam.com', 200, 200),
('100', '2019-05-18', 'test@test.com', 200, 800),
('200', '2019-05-19', 'satyam@satyam.com', 20, 20),
('200', '2019-05-19', 'smahajan02@mylangara.bc.ca', 20, 20),
('200', '1998-05-19', 'test@test.com', 100, 80000),
('5', '2019-05-19', 'satyam@satyam.com', 20, 20),
('5', '2019-05-19', 'test@test.com', 20, 215);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `account` tinyint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fname`, `lname`, `email`, `password`, `gender`, `account`) VALUES
('bals', 'blas', 'satyam@satyam.com', '$2y$10$nXhXKbfVpBRZzrvCxHfI5.cHpGzvtVRuE8OrAI3vbJunrqOEcZ9p2', 'male', 0),
('SATYAN', 'lajsd', 'smahajan02@mylangara.bc.ca', '$2y$10$mK2POBfkch7EfWklH8fyeuGGu40jPtxMhM5Caj0ASHA2J0hiJ1rem', 'male', 1),
('Satyam', 'Mahajan', 'test@test.com', '$2y$10$FstPMEr9Y4DMgLarZvR1IuHm9nRfquzlCtegczmFvAr2ubtc18ndO', 'male', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounttype`
--
ALTER TABLE `accounttype`
  ADD PRIMARY KEY (`account`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transID`,`email`) USING BTREE,
  ADD KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD KEY `account` (`account`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
