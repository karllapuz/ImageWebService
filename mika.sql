-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 14, 2018 at 01:55 AM
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
(3, 'imichelle97', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'Michelle ', 'Luong', 'seller', 31),
(13, 'karl', 'd488364a270f555365152cd0f734532db926081d', 'Karl', 'Lapuz', 'seller', 2),
(15, 'jane', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'Jane', 'Doe', 'consumer', 0),
(18, 'test1', 'b444ac06613fc8d63795be9ad0beaf55011936ac', 'test1', 'test1', 'seller', 35),
(19, 'ross', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', 'Ross', 'Geller', 'seller', 35),
(20, 'peter', '1adb3f06a5883f48cae6133ff7788153538c900f', 'Peter', 'Griffin', 'seller', 9),
(21, 'shane', '95e84d9dd3b08b2507f09785b459a721dbd17558', 'Shane', 'Dawson', 'seller', 19),
(22, 'harry', '20d20391d683043697c70c9672ef80fec75d052c', 'Harry', 'Potter', 'seller', 6),
(23, 'john', '9631c1ef976a1d3c728f1b10ced27243631943ff', 'John', 'Doe', 'seller', 4),
(27, 'kevin', 'ffb4761cba839470133bee36aeb139f58d7dbaa9', 'Kevin', 'Smith', 'seller', 2);

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
(41, 'Raindrops', 'Nature', 'raindrops.jpg', 'Karl ', 3, 'imichelle97', 5),
(42, 'Mason Street', 'Travel', 'IMG_5515.JPG', 'Michelle Luong', 2, 'imichelle97', 0),
(44, 'Hotel Del Coronado', 'Travel', 'IMG_7032.jpg', 'Michelle Luong', 3, 'imichelle97', 0),
(46, 'Boracay Islands', 'Travel', '9262064B-34A6-4045-81A0-8C37A6BBA68A.jpg', 'Quyen Bui', 2, 'imichelle97', 7),
(47, 'Tacos', 'Food', 'IMG_7049.jpg', 'Ross Geller', 3, 'ross', 0),
(48, 'San Diego High Rise', 'Architecture', 'IMG_7027.jpg', 'Matt King', 4, 'imichelle97', 0),
(49, 'SF District Buildings', 'Architecture', 'IMG_7841.jpg', 'Isabel Hernandez', 3, 'imichelle97', 2),
(50, 'Saks Fifth Avenue SF', 'Architecture', 'IMG_5519.jpg', 'Michelle Luong', 2, 'imichelle97', 2),
(51, 'Colors on a Wall', 'Arts', 'IMG_7832.jpg', 'Karl Lapuz', 3, 'imichelle97', 0),
(52, 'Doodles', 'Arts', 'IMG_7829.jpg', 'Minh Bui', 4, 'imichelle97', 0),
(53, 'Orange Rhymes with What?', 'Arts', 'IMG_7824.jpg', 'Michelle Luong', 1, 'imichelle97', 0),
(54, 'Feeling Blue', 'Arts', 'IMG_7825.jpg', 'Jane Doe', 3, 'imichelle97', 0),
(55, 'Disco Time', 'Arts', 'IMG_7828.jpg', 'Michelle Luong', 3, 'imichelle97', 1),
(56, 'Formal', 'People', 'IMG_6217.JPG', 'Mindy Nguyen', 3, 'imichelle97', 1),
(57, 'Sunny Daze', 'People', 'IMG_6827.JPG', 'Isabel Hernandez', 1, 'imichelle97', 2),
(58, 'Really Cold', 'People', 'IMG_7520.JPG', 'anonymous', 3, 'imichelle97', 3),
(59, 'Run', 'People', 'IMG_7507.jpg', 'Jane Doe', 3, 'imichelle97', 2),
(60, 'Dig', 'Sports', 'IMG_0165.jpg', 'Kyle Jacobs', 3, 'imichelle97', 0),
(61, 'Volleyball', 'Sports', 'IMG_0166.jpg', 'Baylor University', 3, 'imichelle97', 0),
(62, 'Patriots', 'Sports', 'IMG_0167.jpg', 'NFL', 3, 'imichelle97', 0),
(63, 'Brunchin\'', 'Food', 'IMG_5887.JPG', 'Michelle Luong', 3, 'imichelle97', 3),
(64, 'Sushi Bowl', 'Food', 'IMG_5788.jpg', 'Salina Zavala', 3, 'imichelle97', 0),
(65, 'Horchacho', 'Food', 'IMG_6888.jpg', 'Kevin Vu', 2, 'imichelle97', 0),
(66, 'Pearls of the Sea', 'Food', 'IMG_7270.jpg', 'Michelle Luong', 2, 'imichelle97', 0),
(67, 'San Diego Sunset', 'Nature', 'IMG_2312.jpg', 'Michelle Luong', 2, 'imichelle97', 0),
(71, 'Chinese Lanterns', 'Others', 'FC062A9B-367F-4ACC-8543-3D6F30EDC825.jpg', 'Karl Lapuz', 2, 'peter', 2),
(72, 'Disco Balls', 'Others', '9E63FD87-D839-42D1-AFB7-F9CEAA13CB7D.jpg', 'Minh Bui', 1, 'peter', 1),
(73, 'Full Sail Ahead', 'Others', '117AD456-E3DD-4E9E-8E22-7DBCF5E2DC01.jpg', 'Michael Thomas', 3, 'peter', 0),
(74, 'Communications Tree', 'Nature', '893583DB-B353-430A-8AB6-8C15DF0DCCF8.jpg', 'Lizzy Vasquez', 3, 'peter', 0),
(75, 'New York! New York!', 'Travel', 'E52CA71E-B868-4230-A710-92F8B1DB242E.jpg', 'Yoko Bautista', 4, 'peter', 5),
(76, 'Tunnel Lady', 'Others', 'F0B22EE6-93A7-48B9-B4D9-AD8BF7CBA38A.jpg', 'Rachel Dawson', 2, 'peter', 0),
(77, 'Gastown Clock', 'Travel', '4D386272-851B-44BE-8AF0-3ED774FCD84D.jpg', 'Matt O\'Brien', 2, 'shane', 3),
(78, 'Hearty Art', 'Arts', '77C031F4-D1F8-4E5F-B5DA-E1BE87356459.jpg', 'Matt O\'Brien', 3, 'shane', 3),
(79, 'Once A Lake', 'Travel', 'DB92D504-D824-418F-AC45-3E0915135043.jpg', 'Karl Lapuz', 2, 'shane', 0),
(80, 'Urban Desolate', 'Architecture', 'DE73A558-2D38-43B4-B36B-BEFF033BECCE.jpg', 'Thomas Head', 3, 'shane', 5),
(81, 'Falling Stars', 'Others', 'A700919B-70B9-47AC-901B-CE2160BF1CE1.jpg', 'Thomas Head', 2, 'shane', 3),
(82, 'It\'s A Sport', 'Sports', 'BEF8A062-3539-426B-B142-326A95B5C67A.jpg', 'Michael Thomas', 2, 'harry', 3),
(83, 'Paradise', 'Nature', 'F6460366-E420-47C5-BA46-EA8E4A775E89.jpg', 'Quyen Bui', 4, 'harry', 4),
(85, 'Sweetness Overload', 'Food', 'E85D7F5C-C6AE-4F4D-9EF5-41986FC23086.jpg', 'Karl Lapuz', 2, 'shane', 4),
(88, 'Pike Place Market', 'Travel', 'FD463C95-554E-4DA0-9F19-EC961142ABAC.jpg', 'Kevin Smith', 2, 'kevin', 1),
(89, 'Wall', 'People', 'F4E1CB0C-72D9-4668-825F-3B50995F96B5.jpg', 'Kevin Smith', 3, 'kevin', 0);

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
(11, 'kate', 3, '2018-12-02 22:32:15'),
(12, 'karl', 44, '2018-12-12 09:33:33'),
(13, 'karl', 46, '2018-12-12 09:33:33'),
(14, 'karl', 57, '2018-12-12 10:47:13'),
(15, 'karl', 50, '2018-12-12 10:47:13'),
(16, 'peter', 49, '2018-12-12 11:37:11'),
(17, 'peter', 46, '2018-12-12 11:37:11'),
(18, 'shane', 77, '2018-12-12 11:43:24'),
(19, 'shane', 46, '2018-12-12 11:43:24'),
(20, 'shane', 75, '2018-12-12 11:43:24'),
(21, 'shane', 80, '2018-12-12 11:43:24'),
(22, 'shane', 49, '2018-12-12 11:43:24'),
(23, 'shane', 50, '2018-12-12 11:43:24'),
(24, 'shane', 58, '2018-12-12 11:43:24'),
(25, 'shane', 57, '2018-12-12 11:43:24'),
(26, 'harry', 46, '2018-12-12 12:05:36'),
(27, 'harry', 77, '2018-12-12 12:11:39'),
(28, 'harry', 75, '2018-12-12 12:11:39'),
(29, 'harry', 82, '2018-12-12 13:06:54'),
(30, 'harry', 80, '2018-12-12 13:06:54'),
(31, 'harry', 58, '2018-12-12 13:06:54'),
(32, 'harry', 83, '2018-12-12 13:06:54'),
(33, 'harry', 63, '2018-12-12 13:06:54'),
(34, 'harry', 78, '2018-12-12 13:06:54'),
(35, 'harry', 81, '2018-12-12 13:06:54'),
(36, 'karl', 81, '2018-12-12 13:19:14'),
(37, 'karl', 72, '2018-12-12 13:19:14'),
(38, 'karl', 82, '2018-12-12 13:21:45'),
(39, 'karl', 75, '2018-12-12 13:21:45'),
(40, 'karl', 41, '2018-12-12 13:22:52'),
(41, 'karl', 83, '2018-12-12 13:22:52'),
(42, 'john', 75, '2018-12-12 13:23:41'),
(43, 'john', 41, '2018-12-12 13:23:41'),
(44, 'john', 83, '2018-12-12 13:23:41'),
(45, 'john', 82, '2018-12-12 13:23:41'),
(46, 'john', 80, '2018-12-12 13:23:41'),
(47, 'shane', 75, '2018-12-12 13:30:11'),
(48, 'shane', 80, '2018-12-12 13:30:11'),
(49, 'shane', 46, '2018-12-12 13:30:11'),
(50, 'shane', 85, '2018-12-12 13:30:11'),
(51, 'shane', 56, '2018-12-13 00:31:52'),
(52, 'shane', 59, '2018-12-13 00:31:52'),
(53, 'kevin', 46, '2018-12-13 08:47:53'),
(54, 'kevin', 78, '2018-12-13 08:47:53'),
(55, 'kevin', 41, '2018-12-13 08:47:53'),
(56, 'kevin', 80, '2018-12-13 08:59:18'),
(57, 'kevin', 71, '2018-12-13 08:59:18'),
(58, 'kevin', 63, '2018-12-13 09:02:09'),
(59, 'kevin', 85, '2018-12-13 09:02:09'),
(60, 'kevin', 55, '2018-12-13 09:02:09'),
(61, 'kevin', 46, '2018-12-13 09:04:52'),
(62, 'kevin', 41, '2018-12-13 09:04:52'),
(63, 'kevin', 85, '2018-12-13 09:04:52'),
(64, 'kevin', 81, '2018-12-13 09:04:52'),
(65, 'kevin', 77, '2018-12-13 09:04:52'),
(66, 'kevin', 46, '2018-12-13 09:07:37'),
(67, 'kevin', 41, '2018-12-13 09:07:37'),
(68, 'kevin', 59, '2018-12-13 09:07:37'),
(69, 'kevin', 85, '2018-12-13 09:07:37'),
(70, 'kevin', 71, '2018-12-13 09:07:37'),
(71, 'kevin', 58, '2018-12-13 09:08:57'),
(72, 'kevin', 83, '2018-12-13 09:08:57'),
(73, 'kevin', 63, '2018-12-13 09:08:57'),
(74, 'kevin', 78, '2018-12-13 09:08:57'),
(75, 'karl', 88, '2018-12-13 09:12:22');

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
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `imageInfo`
--
ALTER TABLE `imageInfo`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
