-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2020 at 03:34 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aghradi`
--

-- --------------------------------------------------------

--
-- Table structure for table `activeaccount`
--

CREATE TABLE `activeaccount` (
  `CID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activeaccount`
--

INSERT INTO `activeaccount` (`CID`) VALUES
(52);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CID` int(5) NOT NULL,
  `PID` int(5) NOT NULL,
  `Quantity` int(5) NOT NULL
) ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CID` int(5) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Phone` int(10) NOT NULL,
  `Country` varchar(20) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Street` varchar(40) NOT NULL,
  `Email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CID`, `FirstName`, `LastName`, `Phone`, `Country`, `City`, `Street`, `Email`) VALUES
(52, 'Mohammad', 'Rimawi', 798168424, 'Jordan', 'Amman', 'Attadamon street', 'MohRimawiz@gmail.com'),
(54, 'Thasen', 'Mohsen', 798168424, 'Jordan', 'Amman', 'street', 'Email@email.com'),
(73, 'Fathi', 'Rimawi', 798168424, 'Jordan', 'Amman', 'Jordan-Amman', 'mohrimawiz@gmail.com'),
(78, 'Laith', 'saqqa', 795227929, 'Jordan', 'Amman', 'ma ba3raf', 'laith86420@gmail.com'),
(79, 'ahmad', 'hamda', 7777777, 'Lebanon', 'Sammamish', '3700 204th CT NE', 'ahm20180557@std.psut.edu.jo'),
(80, 'Saif', 'Alansari', 79000000, 'USA', 'new york', 'wall street', 'zft@rip.com');

-- --------------------------------------------------------

--
-- Table structure for table `isemployee`
--

CREATE TABLE `isemployee` (
  `CID` int(5) NOT NULL,
  `EID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `isemployee`
--

INSERT INTO `isemployee` (`CID`, `EID`) VALUES
(54, 15),
(78, 19),
(52, 20),
(79, 21),
(80, 22),
(73, 23);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `CID` int(5) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`CID`, `Username`, `Password`) VALUES
(79, 'ahmadhamda', 'XDXDXDXDXD'),
(73, 'Fathi', '1234'),
(52, 'Rimawi', '1234'),
(80, 'saif', '123456'),
(78, 'saq', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `OID` int(5) NOT NULL,
  `PID` int(5) NOT NULL,
  `Quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`OID`, `PID`, `Quantity`) VALUES
(32, 16, 2),
(33, 16, 2),
(34, 16, 2),
(36, 16, 1),
(37, 16, 21),
(42, 16, 2),
(43, 16, 1),
(44, 16, 1),
(46, 16, 6),
(47, 16, 3),
(51, 16, 1),
(57, 16, 1),
(61, 16, 1),
(62, 16, 1),
(63, 16, 4),
(64, 16, 3),
(65, 16, 8),
(71, 16, 1),
(77, 16, 2),
(78, 16, 1),
(81, 16, 1),
(32, 17, 3),
(33, 17, 3),
(34, 17, 3),
(35, 17, 1),
(36, 17, 5),
(40, 17, 3),
(42, 17, 1),
(45, 17, 1),
(47, 17, 1),
(58, 17, 4),
(59, 17, 1),
(60, 17, 1),
(62, 17, 4),
(78, 17, 2),
(79, 17, 1),
(81, 17, 2),
(82, 17, 3),
(83, 17, 6),
(32, 18, 1),
(33, 18, 1),
(34, 18, 1),
(41, 18, 4),
(42, 18, 1),
(50, 18, 1),
(62, 18, 1),
(66, 18, 1),
(70, 18, 6),
(76, 18, 1),
(80, 18, 1),
(36, 19, 3),
(42, 19, 2),
(47, 19, 1),
(51, 19, 1),
(56, 19, 1),
(63, 19, 1),
(65, 25, 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `OID` int(11) NOT NULL,
  `OrderDate` date NOT NULL DEFAULT current_timestamp(),
  `ShippingDate` date DEFAULT NULL,
  `CID` int(5) DEFAULT NULL,
  `EID` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OID`, `OrderDate`, `ShippingDate`, `CID`, `EID`) VALUES
(32, '2020-05-19', '2020-05-23', 54, 19),
(33, '2020-05-20', '2020-05-24', 52, 19),
(34, '2020-05-20', '2020-05-20', 52, 19),
(35, '2020-05-20', '2020-05-24', 52, 19),
(36, '2020-05-20', '2020-05-20', 52, 19),
(37, '2020-05-20', '2020-05-23', 52, 19),
(38, '2020-05-20', '2020-05-24', 52, 19),
(39, '2020-05-20', '2020-05-23', 52, 19),
(40, '2020-05-20', '2020-05-24', 52, 19),
(41, '2020-05-20', '2020-05-23', 52, 19),
(42, '2020-05-20', '2020-05-23', 52, 19),
(43, '2020-05-20', '2020-05-23', 54, 19),
(44, '2020-05-20', '2020-05-24', 54, 19),
(45, '2020-05-20', '2020-05-23', NULL, 19),
(46, '2020-05-20', '2020-05-23', NULL, 19),
(47, '2020-05-20', '2020-05-23', NULL, 19),
(48, '2020-05-20', '2020-05-23', NULL, 19),
(49, '2020-05-20', '2020-05-23', NULL, 19),
(50, '2020-05-20', '2020-05-24', NULL, 19),
(51, '2020-05-20', '2020-05-24', 52, 19),
(52, '2020-05-20', '2020-05-24', NULL, 19),
(53, '2020-05-20', '2020-05-24', NULL, 19),
(54, '2020-05-20', '2020-05-23', NULL, 19),
(55, '2020-05-20', '2020-05-24', NULL, 19),
(56, '2020-05-20', '2020-05-24', NULL, 19),
(57, '2020-05-23', '2020-05-24', 73, 19),
(58, '2020-05-23', '2020-05-24', 73, 19),
(59, '2020-05-23', '2020-05-24', 73, 19),
(60, '2020-05-23', '2020-05-24', 73, 19),
(61, '2020-05-23', '2020-05-24', 73, 19),
(62, '2020-05-23', '2020-05-24', 73, 19),
(63, '2020-05-24', '2020-05-24', 78, 19),
(64, '2020-05-24', NULL, 78, 19),
(65, '2020-05-24', NULL, 52, 20),
(66, '2020-05-24', '2020-05-24', 52, 22),
(67, '2020-05-24', '2020-05-24', 73, 22),
(68, '2020-05-24', '2020-05-24', 73, 22),
(69, '2020-05-24', '2020-05-24', 73, 22),
(70, '2020-05-24', '2020-05-24', 73, 22),
(71, '2020-05-24', '2020-05-24', 73, 22),
(72, '2020-05-24', '2020-05-24', 73, 22),
(73, '2020-05-24', '2020-05-24', 73, 22),
(74, '2020-05-24', '2020-05-24', 73, 22),
(75, '2020-05-24', '2020-05-24', 73, 22),
(76, '2020-05-24', '2020-05-24', 73, 22),
(77, '2020-05-24', NULL, 79, 21),
(78, '2020-05-24', '2020-05-24', 80, 22),
(79, '2020-05-24', '2020-05-24', 80, 20),
(80, '2020-05-24', NULL, 52, 23),
(81, '2020-05-28', NULL, 52, 20),
(82, '2020-05-30', NULL, 73, NULL),
(83, '2020-05-30', NULL, 52, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `PID` int(5) NOT NULL,
  `PartName` varchar(20) NOT NULL,
  `Price` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PartDescription` text NOT NULL DEFAULT 'No Description',
  `ImageSrc` text DEFAULT NULL
) ;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`PID`, `PartName`, `Price`, `Quantity`, `PartDescription`, `ImageSrc`) VALUES
(16, 'Chair', 50, 41, '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris', 'Images\\Chair.jpg'),
(17, 'Wheel', 50, 66, 'dui et dui fringilla consectetur id nec massa. Aliquam erat volutpat. Sed ut dui ut lacus dictum fermentum vel tincidunt neque. Sed sed lacinia lectus. Duis sit amet sodales felis. Duis nunc eros, mattis at dui ac, convallis semper risus. In adipiscing ultrices tellus, in suscipit massa vehicula eu.', 'Images\\Wheel.jpg'),
(18, 'Steering wheel', 70, 0, '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris', 'Images\\steering wheel.jpg'),
(19, 'windshield', 200, 9, '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris', 'Images\\Windshield.jpg'),
(25, 'Mirror', 100, 45, '\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris', '	Images\\Mirror.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CID`,`PID`),
  ADD KEY `PID_CART_FK` (`PID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `isemployee`
--
ALTER TABLE `isemployee`
  ADD PRIMARY KEY (`CID`) USING BTREE,
  ADD UNIQUE KEY `EIDUNIQUE` (`EID`) USING BTREE,
  ADD KEY `EIDINDEX` (`EID`) USING BTREE;

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`Username`),
  ADD KEY `CID_LOGIN_FK` (`CID`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`PID`,`OID`) USING BTREE,
  ADD KEY `OID_OD_FK` (`OID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OID`),
  ADD KEY `EID_ORDER_FK` (`EID`),
  ADD KEY `CID_ORDER_FK` (`CID`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`PID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `isemployee`
--
ALTER TABLE `isemployee`
  MODIFY `EID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `PID` int(5) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `CID_CART_FK` FOREIGN KEY (`CID`) REFERENCES `customer` (`CID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `PID_CART_FK` FOREIGN KEY (`PID`) REFERENCES `parts` (`PID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `isemployee`
--
ALTER TABLE `isemployee`
  ADD CONSTRAINT `CID_ISEMP_FK` FOREIGN KEY (`CID`) REFERENCES `customer` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `CID_LOGIN_FK` FOREIGN KEY (`CID`) REFERENCES `customer` (`CID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `OID_OD_FK` FOREIGN KEY (`OID`) REFERENCES `orders` (`OID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `PID_OD_FK` FOREIGN KEY (`PID`) REFERENCES `parts` (`PID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `CID_ORDER_FK` FOREIGN KEY (`CID`) REFERENCES `customer` (`CID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `EID_ORDER_FK` FOREIGN KEY (`EID`) REFERENCES `isemployee` (`EID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
