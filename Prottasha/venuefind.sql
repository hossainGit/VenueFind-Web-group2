-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 04:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `venuefind`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`AdminID`, `Name`, `Email`, `Password`, `CreatedAt`) VALUES
(1, 'Wasif Waliul Hasnat', 'wasif@gmail.com', '$2y$10$h0nJnoGBsENJ3f8oJZ2UaOC//82DMHrOrwtanzg.HS9VzUfR6BCMm', '2025-01-12 15:29:16'),
(2, 'Waliul Hasnat Wasif', 'wasif1@gmail.com', '$2y$10$rY/9IYoMAKBZZPXWanUW7.BjR8yQne.4GlY7LpNqSU1VzPn8Xzkl6', '2025-01-17 03:00:42');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `AppointmentID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `VenueID` int(11) DEFAULT NULL,
  `ServiceID` int(11) DEFAULT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Status` enum('Pending','Accepted','Declined') DEFAULT 'Pending',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Address` text DEFAULT NULL,
  `Wishlist` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `Name`, `Email`, `Password`, `PhoneNumber`, `Address`, `Wishlist`, `CreatedAt`) VALUES
(3, 'Waliul Hasnat Wasif', 'w@gmail.com', '$2y$10$dbOx0UVtjNiRCg1Bt3QFF.wnxQ5kmOdUX0sw4nkFhHpOXnpGQkO66', '01534108907', 'F-55/1, Bank Colony', NULL, '2025-01-12 15:16:27'),
(4, 'Amatul Wahid', 'amatul@gmail.com', '$2y$10$H7PEwW6.TKF3Ed.qA.OiVO8T/DY1xWuKIhPkDi3gUViX/pLKhlZma', '01998297706', 'Bonosri, Dahaka', NULL, '2025-01-14 03:54:12'),
(5, 'Waliul Wasif', 'hasnat@gmail.com', '$2y$10$xXfq0us276UZeJYXuDrgqenMUGBN6EkplaTkKjebkI/TwZKzaYM7y', '01534108902', 'F-55/1, Bank Colony, Savar, Dhaka', NULL, '2025-01-17 02:42:56');

-- --------------------------------------------------------

--
-- Table structure for table `eventorganizers`
--

CREATE TABLE `eventorganizers` (
  `OrganizerID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `Specialization` varchar(100) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventorganizers`
--

INSERT INTO `eventorganizers` (`OrganizerID`, `Name`, `Email`, `Password`, `PhoneNumber`, `Specialization`, `CreatedAt`) VALUES
(1, 'Prottasha', 'saqib@gmail.com', '$2y$10$dWOV1N81ysqbuZBKqn9AD.U6zvVukYG.hkV6XzFenA4lia2HJgnF2', '01534108904', 'Singer', '2025-01-17 03:12:04'),
(2, 'Prottasha', 'prottasha@gmail.com', '$2y$10$3PpO/zJEdgzDCU63zE1Dne/6zFwjRbkLXB.DRYWMJPsfHpIE0DCPO', '01534108901', 'Singer', '2025-01-24 10:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `VenueID` int(11) DEFAULT NULL,
  `ServiceID` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL CHECK (`Rating` between 1 and 5),
  `Comments` text DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `NotificationID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `UserType` enum('Customer','VenueOwner','EventOrganizer','Admin') DEFAULT NULL,
  `Message` text NOT NULL,
  `IsRead` tinyint(1) DEFAULT 0,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `securitylogs`
--

CREATE TABLE `securitylogs` (
  `LogID` int(11) NOT NULL,
  `AdminID` int(11) NOT NULL,
  `Action` varchar(255) DEFAULT NULL,
  `Timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ServiceID` int(11) NOT NULL,
  `OrganizerID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `AvailabilityStatus` enum('Available','Unavailable') DEFAULT 'Available',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ServiceID`, `OrganizerID`, `Name`, `Type`, `Price`, `Description`, `AvailabilityStatus`, `CreatedAt`) VALUES
(1, 1, 'Photography', 'Event Service', 500.00, 'Professional photography for events.', 'Available', '2025-01-21 05:11:49'),
(2, 1, 'Wedding Photography', 'Photography', 50000.00, 'Professional wedding photography service covering the entire event.', 'Available', '2025-01-23 18:51:55'),
(3, 1, 'Event Catering', 'Catering', 25000.00, 'Full-course catering for corporate and private events.\r\n', 'Available', '2025-01-23 19:45:27'),
(4, 2, 'Wedding Photography', 'Photography', 1500.00, 'Capture your special moments with our professional wedding photography service.', 'Available', '2025-01-24 10:56:14'),
(5, 2, 'Virtual Event Hosting', 'Hosting', 500.00, 'Host seamless virtual events with our experienced event coordinators.', 'Available', '2025-01-24 10:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `venueowners`
--

CREATE TABLE `venueowners` (
  `OwnerID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `PhoneNumber` varchar(15) DEFAULT NULL,
  `BusinessName` varchar(100) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venueowners`
--

INSERT INTO `venueowners` (`OwnerID`, `Name`, `Email`, `Password`, `PhoneNumber`, `BusinessName`, `CreatedAt`) VALUES
(1, 'Abir Khan', 'abir@gmail.com', '$2y$10$.mfeSabEqE1H4RYdjPLBX.UIbjZnm2FQ.dXlH6D4gLdT9JlO0OIPa', '01998297708', 'Real States', '2025-01-17 02:56:53');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `VenueID` int(11) NOT NULL,
  `OwnerID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Capacity` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `AvailabilityStatus` enum('Available','Unavailable') DEFAULT 'Available',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`VenueID`, `OwnerID`, `Name`, `Location`, `Capacity`, `Price`, `Description`, `AvailabilityStatus`, `CreatedAt`) VALUES
(5, 1, 'Grand Hall', 'Downtown', 200, 5000.00, 'Spacious hall', 'Available', '2025-01-11 11:56:37'),
(6, 2, 'Lakeview Garden', 'Uptown', 150, 3000.00, 'Beautiful garden', 'Available', '2025-01-11 11:56:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`AppointmentID`),
  ADD KEY `CustomerID` (`CustomerID`),
  ADD KEY `VenueID` (`VenueID`),
  ADD KEY `ServiceID` (`ServiceID`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `eventorganizers`
--
ALTER TABLE `eventorganizers`
  ADD PRIMARY KEY (`OrganizerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `CustomerID` (`CustomerID`),
  ADD KEY `VenueID` (`VenueID`),
  ADD KEY `ServiceID` (`ServiceID`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`NotificationID`);

--
-- Indexes for table `securitylogs`
--
ALTER TABLE `securitylogs`
  ADD PRIMARY KEY (`LogID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ServiceID`),
  ADD KEY `OrganizerID` (`OrganizerID`);

--
-- Indexes for table `venueowners`
--
ALTER TABLE `venueowners`
  ADD PRIMARY KEY (`OwnerID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`VenueID`),
  ADD KEY `OwnerID` (`OwnerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `eventorganizers`
--
ALTER TABLE `eventorganizers`
  MODIFY `OrganizerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `NotificationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `securitylogs`
--
ALTER TABLE `securitylogs`
  MODIFY `LogID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ServiceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `venueowners`
--
ALTER TABLE `venueowners`
  MODIFY `OwnerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `VenueID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`VenueID`) REFERENCES `venues` (`VenueID`) ON DELETE SET NULL,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`ServiceID`) REFERENCES `services` (`ServiceID`) ON DELETE SET NULL;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`) ON DELETE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`VenueID`) REFERENCES `venues` (`VenueID`) ON DELETE SET NULL,
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`ServiceID`) REFERENCES `services` (`ServiceID`) ON DELETE SET NULL;

--
-- Constraints for table `securitylogs`
--
ALTER TABLE `securitylogs`
  ADD CONSTRAINT `securitylogs_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admins` (`AdminID`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`OrganizerID`) REFERENCES `eventorganizers` (`OrganizerID`) ON DELETE CASCADE;

--
-- Constraints for table `venues`
--
ALTER TABLE `venues`
  ADD CONSTRAINT `venues_ibfk_1` FOREIGN KEY (`OwnerID`) REFERENCES `venueowners` (`OwnerID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
