-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 07, 2018 at 02:04 AM
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
  `userType` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `username`, `password`, `firstName`, `lastName`, `userType`) VALUES
(3, 'imichelle97', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'Michelle ', 'Luong', 'Customer'),
(13, 'karl', 'd488364a270f555365152cd0f734532db926081d', 'Karl', 'Lapuz', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `imageInfo`
--

CREATE TABLE `imageInfo` (
  `imageID` int(11) NOT NULL,
  `imageName` varchar(256) DEFAULT NULL,
  `category` varchar(256) DEFAULT NULL,
  `imagePath` varchar(256) DEFAULT NULL,
  `resolution` varchar(256) DEFAULT NULL,
  `size` varchar(256) DEFAULT NULL,
  `photographer` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imageInfo`
--

INSERT INTO `imageInfo` (`imageID`, `imageName`, `category`, `imagePath`, `resolution`, `size`, `photographer`) VALUES
(1, 'San Diego Sunset', 'Nature', 'IMG_2312.JPG', 'width=\"1200\" height=\"800\"', '157127', 'M Luong'),
(2, 'Union Square SF', 'City', 'IMG_5518.JPG', 'width=\"4032\" height=\"3024\"', '3018105', 'M Luong'),
(3, 'San Francisco', 'Nature ', 'IMG_5520.JPG', 'width=\"1334\" height=\"750\"', '287022', 'M Luong'),
(4, 'Santa Cruz Waves', 'Nature', 'IMG_2422.JPG', 'width=\"2048\" height=\"1366\"', '603091', 'M Luong');

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
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `imageInfo`
--
ALTER TABLE `imageInfo`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
