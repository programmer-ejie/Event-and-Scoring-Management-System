-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2023 at 06:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pink_lunary`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_info`
--

CREATE TABLE `log_info` (
  `id` int(11) NOT NULL,
  `TEAMONE` varchar(255) NOT NULL,
  `TeamOneScore` int(11) NOT NULL,
  `TEAMTWO` varchar(255) NOT NULL,
  `TeamTwoScore` int(11) NOT NULL,
  `DATE` varchar(255) NOT NULL,
  `TIME` varchar(255) NOT NULL,
  `LOCATION` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_info`
--

INSERT INTO `log_info` (`id`, `TEAMONE`, `TeamOneScore`, `TEAMTWO`, `TeamTwoScore`, `DATE`, `TIME`, `LOCATION`) VALUES
(37, 'Regular Surpriser', 50, 'Irregular Beast', 65, '11/2/2023', '10:00 am', 'City Hall Gym'),
(39, 'Island Hunter', 0, 'Bluemoon', 0, '11/2/2023', '7:00 am', 'City Hall Gym'),
(40, 'Regular Surpriser', 0, 'Bundam Gravekeeper', 0, '11/4/2023', '9:00 am', 'City Hall Gym'),
(41, 'Regular Surpriser', 0, 'Chooks To go', 0, '11/6/2023', '7:00 am', 'City Hall Gym'),
(43, 'Flying Dutchman', 46, 'Blizzard Oarthhodx', 50, '11/3/2023', '8:00 am', 'Maasin City Gym'),
(44, 'DutchPills', 0, 'Irregular Beast', 0, '11/4/2023', '1:00 pm', 'City Hall Gym'),
(45, 'Team Athena', 0, 'Team Ejie', 0, '11/5/2023', '1:00 pm', 'Maasin City Gym'),
(46, 'Team E', 0, 'Team C', 0, '11/5/2023', '4:00 pm', 'Tomas Oppus Court');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `TeamOne` varchar(255) NOT NULL,
  `TeamTwo` varchar(255) NOT NULL,
  `Date` varchar(255) NOT NULL,
  `Time` varchar(255) NOT NULL,
  `Location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gmail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `profile`, `fullname`, `age`, `gmail`) VALUES
(3, 'marybelle123', '123', '../profile_pictures/marybelle3.jpg', 'Marybelle Capulo', 20, 'marybelle@gmail.com'),
(4, 'lacre123', '123', '../profile_pictures/lacre2.jpg', 'Jhesryle Lacre', 23, 'lacre23@gmail.com'),
(5, 'jenna123', '123', '../profile_pictures/jena2.jpg', 'Jenna Maika Odon', 20, 'jennaodon123@gmail.com'),
(6, 'rey123', '123', '../profile_pictures/ray3.jpg', 'Rey Mart', 23, 'reymart123@gmail.como'),
(7, 'ejie123', '123', '../profile_pictures/ejie4.jpg', 'Ejie C. Florida', 19, 'ejieflorida128@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_info`
--
ALTER TABLE `log_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_info`
--
ALTER TABLE `log_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
