-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2025 at 04:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project1_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `created_at`) VALUES
(4, 'admin', '$2y$10$V8OD6NyE5vXAVeNjnugkMerbUs0fh7en72kb.gea7kELdw0A4K.VG', '2025-04-09 04:08:47');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Faculty','Student') NOT NULL,
  `course` varchar(255) NOT NULL,
  `year` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `full_name`, `email`, `password`, `role`, `course`, `year`, `created_at`) VALUES
(1, 'Ashmen Camid', 'ashmen@gmail.com', 'ashmen12345', 'Student', 'BSIT', '2', '2025-04-09 11:17:41'),
(2, 'Richard Budlat', 'richardbudlat@gmail.com', 'richardbudlat', 'Faculty', 'CTE', '3', '2025-04-09 11:26:03'),
(3, 'Gabriel Pahaganas', 'gabrielpahaganas@gmail.com', 'gabriel12345', 'Student', 'BSIT', '1', '2025-04-09 11:28:06'),
(4, 'Ashly Sultan', 'ashly@gmail.com', 'Ashy@12345', 'Student', 'CTE', '4', '2025-04-09 12:20:01'),
(6, 'Thea Ashly', 'thea@gmail.com', 'Thea12345', 'Student', 'CTE', '4', '2025-04-09 12:30:16'),
(7, 'Ashmen S. Camid', 'ashmencamid1@gmail.com', 'Ashy@12345', 'Student', 'BPED', '3', '2025-04-10 01:24:59');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `quantity_available` int(11) NOT NULL,
  `condition` enum('Good','Fair','Needs Repair') NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` enum('Available','In Use','Under Maintenance') NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `material_name`, `category`, `quantity_available`, `condition`, `location`, `status`) VALUES
(1, 'Screwdriver Set', 'Hand Tools', 5, 'Good', 'Secret', 'Available'),
(2, 'RJ45 Connector', 'Network Tool', 100, 'Good', 'Secret', 'Available'),
(3, 'Soldering Iron', 'Electronics', 6, 'Good', 'ROOM 103T', 'Available'),
(4, 'Projector', 'Electronics', 3, 'Fair', 'Secret', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 0, 'Your repair request (ID: 1) has been assigned to a technician.', 0, '2025-04-09 14:21:54'),
(2, 0, 'Your repair request (ID: 1) has been assigned to a technician.', 0, '2025-04-09 14:22:04'),
(3, 0, 'Your repair request (ID: 1) has been rejected.', 0, '2025-04-09 14:24:12'),
(4, 0, 'Your repair request (ID: 1) has been assigned to a technician.', 0, '2025-04-09 14:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `repair_requests`
--

CREATE TABLE `repair_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `requester_name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `service_type` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `priority` enum('Low','Medium','High','Urgent') NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `date_requested` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repair_requests`
--

INSERT INTO `repair_requests` (`id`, `user_id`, `requester_name`, `department`, `location`, `service_type`, `description`, `priority`, `attachment`, `date_requested`, `created_at`, `status`) VALUES
(1, 0, 'Ashmen S. Camid', 'CCIS', 'ROOM 105B', 'Computer', 'Naguba akong heart uy! mao nani run!', 'Medium', '', '2025-04-09', '2025-04-09 14:01:22', 'Assigned'),
(2, 1, 'Richard Budlat', 'CCIS', 'N/A', 'Electrical', 'N/A', 'Urgent', '', '2025-04-09', '2025-04-09 14:37:19', 'Rejected'),
(3, 1, 'Ashmen S. Camid', 'CCIS', 'ROOM 109B', 'Plumbing', 'sample', 'Medium', '', '2025-04-09', '2025-04-09 14:48:45', 'Assigned'),
(4, 1, 'Richard Budlat', 'CCIS', 'ROOM 303T', 'Plumbing', 'Secret', 'Low', '', '2025-04-10', '2025-04-10 01:15:20', 'Pending'),
(5, 1, 'Ashmen S. Camid', 'BSIT', '105', 'Computer', 'OK', 'Low', '', '2025-04-10', '2025-04-10 01:21:28', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `requester_name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purpose` text NOT NULL,
  `date_needed` date NOT NULL,
  `return_date` date NOT NULL,
  `status` enum('Pending','Approved','Rejected','Returned') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `requester_name`, `department`, `material_name`, `quantity`, `purpose`, `date_needed`, `return_date`, `status`, `created_at`) VALUES
(1, 0, 'Ashmen S. Camid', 'CCIS', 'Screwdriver Set', 2, 'n/a', '2025-04-10', '2025-04-11', 'Approved', '2025-04-10 00:06:38'),
(2, 0, 'Ashmen S. Camid', 'CCIS', 'RJ45 Connector', 1, 'OK', '2025-04-10', '2025-04-11', 'Approved', '2025-04-10 00:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `status_logs`
--

CREATE TABLE `status_logs` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `old_status` enum('Pending','Approved','Rejected','Returned') DEFAULT NULL,
  `new_status` enum('Pending','Approved','Rejected','Returned') DEFAULT NULL,
  `changed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_logs`
--

INSERT INTO `status_logs` (`id`, `reservation_id`, `old_status`, `new_status`, `changed_at`) VALUES
(1, 1, 'Pending', 'Approved', '2025-04-10 00:06:45'),
(2, 1, 'Approved', 'Approved', '2025-04-10 00:24:52'),
(3, 1, 'Approved', 'Rejected', '2025-04-10 00:28:30'),
(4, 1, 'Rejected', 'Approved', '2025-04-10 00:30:55'),
(5, 2, 'Pending', 'Returned', '2025-04-10 01:00:05'),
(6, 2, 'Returned', 'Approved', '2025-04-10 01:20:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repair_requests`
--
ALTER TABLE `repair_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status_logs`
--
ALTER TABLE `status_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `repair_requests`
--
ALTER TABLE `repair_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `status_logs`
--
ALTER TABLE `status_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `status_logs`
--
ALTER TABLE `status_logs`
  ADD CONSTRAINT `status_logs_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
