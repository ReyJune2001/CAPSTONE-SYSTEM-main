-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2024 at 08:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbpayms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customerID` int(100) NOT NULL,
  `userID` int(100) NOT NULL,
  `customer_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customerID`, `userID`, `customer_name`) VALUES
(2, 1, '105'),
(3, 1, '8.8'),
(4, 1, '46'),
(6, 1, '5'),
(11, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_entry`
--

CREATE TABLE `tbl_entry` (
  `EntryID` int(100) NOT NULL,
  `userID` int(100) NOT NULL,
  `customerID` int(100) NOT NULL,
  `paintID` int(100) NOT NULL,
  `date` date NOT NULL,
  `batchNumber` int(100) NOT NULL,
  `diameter` int(100) NOT NULL,
  `height` int(100) NOT NULL,
  `paintRatio` int(100) NOT NULL,
  `acetateRatio` int(100) NOT NULL,
  `NewacetateL` int(100) NOT NULL,
  `NewpaintL` int(100) NOT NULL,
  `sprayViscosity` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `Endingdiameter` int(100) NOT NULL,
  `Endingheight` int(100) NOT NULL,
  `EndingpaintRatio` int(100) NOT NULL,
  `EndingacetateRatio` int(100) NOT NULL,
  `paintYield` int(100) NOT NULL,
  `acetateYield` int(100) NOT NULL,
  `remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_entry`
--

INSERT INTO `tbl_entry` (`EntryID`, `userID`, `customerID`, `paintID`, `date`, `batchNumber`, `diameter`, `height`, `paintRatio`, `acetateRatio`, `NewacetateL`, `NewpaintL`, `sprayViscosity`, `quantity`, `Endingdiameter`, `Endingheight`, `EndingpaintRatio`, `EndingacetateRatio`, `paintYield`, `acetateYield`, `remarks`) VALUES
(2, 1, 2, 2, '2024-01-21', 2027348738, 101, 102, 103, 104, 108, 106, 109, 107, 200, 201, 202, 203, 204, 205, 'Very Good!'),
(3, 1, 3, 3, '2024-01-22', 202045722, 1, 2, 3, 4, 7, 6, 8, 10, 10, 11, 12, 13, 121, 213, 'Success!'),
(11, 1, 11, 11, '2024-01-23', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Success!');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paint`
--

CREATE TABLE `tbl_paint` (
  `paintID` int(100) NOT NULL,
  `supplierID` int(100) NOT NULL,
  `DetailsID` int(100) NOT NULL,
  `paint_color` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_paint`
--

INSERT INTO `tbl_paint` (`paintID`, `supplierID`, `DetailsID`, `paint_color`) VALUES
(2, 2, 2, 'Royal Blue'),
(3, 3, 3, 'Emirald Green'),
(11, 11, 11, 'Nile Green');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_received`
--

CREATE TABLE `tbl_received` (
  `receiveID` int(100) NOT NULL,
  `userID` int(100) NOT NULL,
  `receiver_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_received`
--

INSERT INTO `tbl_received` (`receiveID`, `userID`, `receiver_name`) VALUES
(1, 1, ''),
(2, 1, ''),
(3, 1, ''),
(4, 1, ''),
(5, 1, ''),
(6, 1, ''),
(7, 1, ''),
(8, 1, ''),
(9, 1, ''),
(10, 1, ''),
(11, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receivedetails`
--

CREATE TABLE `tbl_receivedetails` (
  `DetailsID` int(100) NOT NULL,
  `receiveID` int(100) NOT NULL,
  `details` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_receivedetails`
--

INSERT INTO `tbl_receivedetails` (`DetailsID`, `receiveID`, `details`) VALUES
(1, 1, ''),
(2, 2, ''),
(3, 3, ''),
(4, 4, ''),
(5, 5, ''),
(6, 6, ''),
(7, 7, ''),
(8, 8, ''),
(9, 9, ''),
(10, 10, ''),
(11, 11, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplierID` int(100) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `newSupplier_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplierID`, `supplier_name`, `newSupplier_name`) VALUES
(2, 'Nippon', 'Century'),
(3, 'Century', 'Treasure Island'),
(11, 'Inkote', 'Century');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userID` int(100) NOT NULL,
  `Level` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Contact` varchar(100) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Profile_image` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userID`, `Level`, `Name`, `Username`, `Contact`, `Address`, `Profile_image`, `Email`, `Password`) VALUES
(1, 'Admin', 'Rey June', 'Choii', '09066672527', 'Dayawan, Villanueva, Misamis oriental', 'download.jpg', 'ucabreyjune2001@gmail.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customerID`),
  ADD KEY `CustomeruserID_fk` (`userID`);

--
-- Indexes for table `tbl_entry`
--
ALTER TABLE `tbl_entry`
  ADD PRIMARY KEY (`EntryID`),
  ADD KEY `userID_fk` (`userID`),
  ADD KEY `customerID_fk` (`customerID`),
  ADD KEY `paintID_fk` (`paintID`);

--
-- Indexes for table `tbl_paint`
--
ALTER TABLE `tbl_paint`
  ADD PRIMARY KEY (`paintID`),
  ADD KEY `supplierID_fk` (`supplierID`),
  ADD KEY `DetailsID_fk` (`DetailsID`);

--
-- Indexes for table `tbl_received`
--
ALTER TABLE `tbl_received`
  ADD PRIMARY KEY (`receiveID`),
  ADD KEY `tbl_receive_userID_fk` (`userID`);

--
-- Indexes for table `tbl_receivedetails`
--
ALTER TABLE `tbl_receivedetails`
  ADD PRIMARY KEY (`DetailsID`),
  ADD KEY `receiveID_fk` (`receiveID`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplierID`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customerID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_entry`
--
ALTER TABLE `tbl_entry`
  MODIFY `EntryID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_paint`
--
ALTER TABLE `tbl_paint`
  MODIFY `paintID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_received`
--
ALTER TABLE `tbl_received`
  MODIFY `receiveID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_receivedetails`
--
ALTER TABLE `tbl_receivedetails`
  MODIFY `DetailsID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplierID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD CONSTRAINT `CustomeruserID_fk` FOREIGN KEY (`userID`) REFERENCES `tbl_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_entry`
--
ALTER TABLE `tbl_entry`
  ADD CONSTRAINT `customerID_fk` FOREIGN KEY (`customerID`) REFERENCES `tbl_customer` (`customerID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `paintID_fk` FOREIGN KEY (`paintID`) REFERENCES `tbl_paint` (`paintID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userID_fk` FOREIGN KEY (`userID`) REFERENCES `tbl_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_paint`
--
ALTER TABLE `tbl_paint`
  ADD CONSTRAINT `DetailsID_fk` FOREIGN KEY (`DetailsID`) REFERENCES `tbl_receivedetails` (`DetailsID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `supplierID_fk` FOREIGN KEY (`supplierID`) REFERENCES `tbl_supplier` (`supplierID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_received`
--
ALTER TABLE `tbl_received`
  ADD CONSTRAINT `tbl_receive_userID_fk` FOREIGN KEY (`userID`) REFERENCES `tbl_user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_receivedetails`
--
ALTER TABLE `tbl_receivedetails`
  ADD CONSTRAINT `receiveID_fk` FOREIGN KEY (`receiveID`) REFERENCES `tbl_received` (`receiveID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
