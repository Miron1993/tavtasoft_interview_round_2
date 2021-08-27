-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2021 at 06:59 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tatvasoft_practice`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `recurrence_type` varchar(255) NOT NULL,
  `recurrence_type_id` int(10) NOT NULL,
  `status` smallint(2) NOT NULL DEFAULT 1,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `date_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `start_date`, `end_date`, `recurrence_type`, `recurrence_type_id`, `status`, `date_added`, `date_modified`) VALUES
(2, 'first', '2021-08-14', '2021-10-28', 'recurrence_type_2', 4, 1, '2021-08-27 16:31:43', '2021-08-27 11:31:43'),
(3, 'second', '2021-09-04', '2021-09-22', 'recurrence_type_2', 6, 1, '2021-08-27 16:46:50', '2021-08-27 11:46:50');

-- --------------------------------------------------------

--
-- Table structure for table `recurrence_type_1`
--

CREATE TABLE `recurrence_type_1` (
  `id` int(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  `repeat_type` varchar(20) NOT NULL,
  `repeat_every` varchar(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `recurrence_type_2`
--

CREATE TABLE `recurrence_type_2` (
  `id` int(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  `repeat_on` varchar(20) NOT NULL,
  `repeat_week` varchar(20) NOT NULL,
  `repeat_month` varchar(20) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recurrence_type_2`
--

INSERT INTO `recurrence_type_2` (`id`, `event_id`, `repeat_on`, `repeat_week`, `repeat_month`, `date_added`) VALUES
(4, 2, 'second', 'wednesday', '1', '2021-08-27 11:31:43'),
(6, 3, 'first', 'sunday', '1', '2021-08-27 11:46:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recurrence_type` (`recurrence_type`);

--
-- Indexes for table `recurrence_type_1`
--
ALTER TABLE `recurrence_type_1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `recurrence_type_2`
--
ALTER TABLE `recurrence_type_2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recurrence_type_1`
--
ALTER TABLE `recurrence_type_1`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recurrence_type_2`
--
ALTER TABLE `recurrence_type_2`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
