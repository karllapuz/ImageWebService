-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 10, 2018 at 09:06 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mika`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerID` int(11) NOT NULL,
  `username` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `firstName` varchar(256) DEFAULT NULL,
  `lastName` varchar(256) DEFAULT NULL,
  `userType` varchar(128) DEFAULT NULL,
  `credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `username`, `password`, `firstName`, `lastName`, `userType`, `credits`) VALUES
(3, 'imichelle97', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'Michelle ', 'Luong', 'seller', 0),
(13, 'karl', 'd488364a270f555365152cd0f734532db926081d', 'Karl', 'Lapuz', 'seller', 0),
(15, 'jane', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'Jane', 'Doe', 'consumer', 0),
(18, 'test1', 'b444ac06613fc8d63795be9ad0beaf55011936ac', 'test1', 'test1', 'seller', 35);

-- --------------------------------------------------------

--
-- Table structure for table `imageInfo`
--

CREATE TABLE `imageInfo` (
  `imageID` int(11) NOT NULL,
  `imageName` varchar(256) DEFAULT NULL,
  `category` varchar(256) DEFAULT NULL,
  `imagePath` varchar(256) DEFAULT NULL,
  `photographer` varchar(256) DEFAULT NULL,
  `credits` int(11) NOT NULL,
  `uploader` varchar(256) DEFAULT NULL,
  `purchases` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imageInfo`
--

INSERT INTO `imageInfo` (`imageID`, `imageName`, `category`, `imagePath`, `photographer`, `credits`, `uploader`, `purchases`) VALUES
(41, 'Raindrops', 'Nature', 'raindrops.jpg', 'Karl ', 3, 'imichelle97', 0),
(42, 'Mason Street', 'Travel', 'IMG_5515.JPG', 'Michelle Luong', 2, 'imichelle97', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactionID` int(11) NOT NULL,
  `username` varchar(126) DEFAULT NULL,
  `imageID` int(11) DEFAULT NULL,
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactionID`, `username`, `imageID`, `ts`) VALUES
(1, 'imichelle97', 1, '2018-12-02 22:18:23'),
(4, 'imichelle97', 1, '2018-12-02 22:31:43'),
(5, 'imichelle97', 4, '2018-12-02 22:31:45'),
(6, 'will', 1, '2018-12-02 22:31:57'),
(7, 'will', 2, '2018-12-02 22:31:59'),
(8, 'will', 3, '2018-12-02 22:32:03'),
(9, 'will', 4, '2018-12-02 22:32:05'),
(10, 'kate', 1, '2018-12-02 22:32:13'),
(11, 'kate', 3, '2018-12-02 22:32:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `imageInfo`
--
ALTER TABLE `imageInfo`
  ADD PRIMARY KEY (`imageID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `imageInfo`
--
ALTER TABLE `imageInfo`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
