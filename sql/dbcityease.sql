-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 06, 2024 at 08:38 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcityease`
--

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportid` int(10) NOT NULL,
  `reportType` varchar(45) NOT NULL,
  `discoveryDate` date NOT NULL,
  `details` varchar(10000) NOT NULL,
  `region` varchar(45) NOT NULL,
  `province` varchar(45) NOT NULL,
  `municipality` varchar(45) NOT NULL,
  `email` char(45) NOT NULL,
  PRIMARY KEY (`reportid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `requestid` int(10) NOT NULL AUTO_INCREMENT,
  `requestDate` date NOT NULL,
  `contactNO` varchar(15) NOT NULL,
  `region` varchar(45) NOT NULL,
  `province` varchar(45) NOT NULL,
  `municipality` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `requestDoc` varchar(45) NOT NULL,
  `governmentID` blob NOT NULL,
  `requestReason` text NOT NULL,
  `requesterName` varchar(100) NOT NULL,
  `deliveryAddress` varchar(255) NOT NULL,
  PRIMARY KEY (`requestid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `firstname` varchar(45) NOT NULL,
  `middlename` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `suffix` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `sex` varchar(45) NOT NULL,
  `civilstatus` varchar(45) NOT NULL,
  `dateofbirth` date NOT NULL,
  `region` varchar(45) NOT NULL,
  `province` varchar(45) NOT NULL,
  `municipality` varchar(45) NOT NULL,
  `role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `requestid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

ALTER TABLE `request`
ADD COLUMN `status` VARCHAR(45) NOT NULL DEFAULT 'pending';

ALTER TABLE `report`
ADD COLUMN `status` VARCHAR(45) NOT NULL DEFAULT 'pending';

-- Updated insert for report table with VARCHAR for email
INSERT INTO `report` (`reportid`, `reportType`, `discoveryDate`, `details`, `region`, `province`, `municipality`, `email`, `status`)
VALUES
('111', 'Theft', '2024-08-01', 'A case of theft reported in the city center.', 'Metro Manila', 'Metro Manila', 'Makati', 'john.doe@example.com', 'pending'),
('222', 'Vandalism', '2024-08-03', 'Graffiti reported on public property.', 'Cebu', 'Cebu', 'Cebu City', 'jane.smith@example.com', 'pending');

-- Updated insert for request table
INSERT INTO `request` (`requestDate`, `contactNO`, `region`, `province`, `municipality`, `email`, `requestDoc`, `governmentID`, `requestReason`, `requesterName`, `deliveryAddress`, `status`)
VALUES
('2024-08-01', '09123456789', 'Metro Manila', 'Metro Manila', 'Quezon City', 'alice.jones@example.com', 'Birth Certificate', 'ID123456', 'Requesting a copy for visa application.', 'Alice Jones', '1234 Maple Street, Quezon City', 'pending'),
('2024-08-01', '09234567890', 'Cebu', 'Cebu', 'Mandaue City', 'bob.brown@example.com', 'Certificate of Residence', 'ID654321', 'Needed for job application.', 'Bob Brown', '5678 Oak Avenue, Mandaue City', 'pending');


INSERT INTO `signup` (`firstname`, `middlename`, `lastname`, `suffix`, `email`, `password`, `sex`, `civilstatus`, `dateofbirth`, `region`, `province`, `municipality`, `role`) VALUES
('Alice', 'Middle', 'Jones', '', 'alice.jones@example.com', 'password123', 'Female', 'Single', '1990-01-01', 'Metro Manila', 'Metro Manila', 'Quezon City', 'User'),
('Bob', 'Middle', 'Brown', '', 'bob.brown@example.com', 'password123', 'Male', 'Single', '1985-05-15', 'Cebu', 'Cebu', 'Mandaue City', 'User');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
