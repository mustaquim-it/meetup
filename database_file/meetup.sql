-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2021 at 09:22 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meetup`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_participants`
--

CREATE TABLE `tbl_participants` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `age` int(3) NOT NULL DEFAULT 0,
  `dob` varchar(25) NOT NULL,
  `profession` varchar(25) NOT NULL,
  `locality` varchar(25) NOT NULL,
  `guests` enum('0','1','2') NOT NULL,
  `address` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_participants`
--

INSERT INTO `tbl_participants` (`id`, `name`, `age`, `dob`, `profession`, `locality`, `guests`, `address`, `created_at`) VALUES
(1, 'ARUN', 8, '8 june 2012', 'STUDENT', 'PUNE', '2', 'Icon pride, kharadi road', '2021-08-21 12:44:50'),
(2, 'RAHUL', 21, '28 may 2000', 'EMPLOYED', 'MUMBAI', '1', 'Andheri west', '2021-08-21 12:45:32'),
(3, 'RAJ', 20, '8 jan 2001', 'EMPLOYED', 'MUMBAI', '0', 'Kurla', '2021-08-21 12:46:23'),
(4, 'RAMESH', 20, '8 june 2001', 'EMPLOYED', 'MUMBAI', '2', 'Wadala', '2021-08-21 12:47:31'),
(5, 'ABDUL', 10, '8 sep 2011', 'STUDENT', 'AHMEDNAGAR', '1', 'MG road', '2021-08-21 12:48:50'),
(6, 'HAMID', 9, '12 dec 2012', 'STUDENT', 'PUNE', '1', 'Vimannagar', '2021-08-21 12:49:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_participants`
--
ALTER TABLE `tbl_participants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_participants`
--
ALTER TABLE `tbl_participants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
