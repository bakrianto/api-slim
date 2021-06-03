-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2019 at 11:55 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL COMMENT 'primary key',
  `name` varchar(255) NOT NULL COMMENT 'Employee Name',
  `email` varchar(255) NOT NULL COMMENT 'Email Address',
  `salary` float(10,2) NOT NULL COMMENT 'employee salary',
  `age` int(11) NOT NULL COMMENT 'employee age'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='datatable demo table';

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `salary`, `age`) VALUES
(1, 'Nixon Tiger', 'tiger@techarise.com', 3208000.00, 61),
(2, 'Garrett Winters', 'winters@techarise.com', 170750.00, 63),
(3, 'Ashton Cox', 'cox@techarise.com', 86000.00, 66),
(4, 'Cedric Kelly', 'kelly@techarise.com', 433060.00, 22),
(5, 'Airi Satouy', 'airi@techarise.com', 162700.00, 33),
(6, 'Brielle Williamson', 'will@techarise.com', 372000.00, 61),
(7, 'Herrod Chandler', 'herrod@techarise.com', 137500.00, 59),
(8, 'Rhona Davidson', 'rd@techarise.com', 327900.00, 55),
(9, 'Colleen Hurst', 'colleen@techarise.com', 205500.00, 39),
(10, 'Sonya Frost', 'frost@techarise.com', 103600.00, 23),
(11, 'John Philip', 'filip@techarise.com', 26584.00, 25),
(12, 'Sam Wood', 'sam@techarise.com', 26584.00, 25);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key', AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
