-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2025 at 07:17 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle assistance`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `issue` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `service_id`, `issue`, `date`, `status`, `amount`) VALUES
(1, 6, 13, '##############$$$$$$$$$$$', '2025-09-11 07:17:29', 'rejected', NULL),
(2, 9, 13, '##############', '2025-09-11 12:30:51', 'Feedback Completed', 400),
(3, 9, 11, '*********** * ******* ** ***', '2025-09-11 08:35:05', 'requested', NULL),
(4, 10, 14, '%%%%%%%%%%%%%%%', '2025-09-13 05:13:10', 'Feedback Completed', 600);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user_id`, `user_name`, `password`, `usertype`, `status`) VALUES
(4, 0, 'admin', 'admin', 'admin', 'active'),
(7, 2, 'meghasatheesh20005@gmail.com', 'meghadfffd@123', 'service', 'inactive'),
(9, 6, 'john1234@gmail.com', 'john@1234', 'user', 'active'),
(15, 9, 'aa@mail.com', 'Aa@12345', 'user', 'active'),
(16, 13, 'bb@mail.com', 'Bb@12345', 'service', 'active'),
(17, 10, 'uu@mail.com', 'Uu@12345', 'user', 'active'),
(18, 14, 'ss@mail.com', 'Ss@12345', 'service', 'active'),
(19, 11, 'yy@mail.com', 'Yy@12345', 'user', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `review` varchar(200) NOT NULL,
  `rating` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `booking_id`, `review`, `rating`, `date`) VALUES
(1, 2, '############', 2, '2025-09-11 12:31:17'),
(2, 4, 'good####', 5, '2025-09-13 05:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `serviceregistration`
--

CREATE TABLE `serviceregistration` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_no` bigint(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL,
  `district` varchar(50) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `serviceregistration`
--

INSERT INTO `serviceregistration` (`id`, `name`, `email`, `phone_no`, `address`, `latitude`, `longitude`, `image`, `district`, `status`) VALUES
(2, 'megha satheesh', 'meghasatheesh20005@gmail.com', 9061247615, 'kaimaparmbil', '10.08049', '76.36246', 'me.jpg', '', 'available'),
(10, 'zara', 'zara3478@gmail.com', 9854237698, 'efg house', '10.10702', '76.35835', 'hel.jpg', '', 'available'),
(11, 'mariya', 'mariya213@gmail.com', 7632459012, 'kollammaparambil house kakkanade', '10.12167', '76.37864', 'hel.jpg', 'ernakulam', 'available'),
(13, 'bb', 'bb@mail.com', 9876543212, '##########\r\n', '', '', 'abi.jpeg', 'ERNAKULAM', 'available'),
(14, 'ss', 'ss@mail.com', 9543212900, '#############', '', '', 'Apr 11, 2025, 03_32_14 PM.png', 'Thrissur', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `userregistration`
--

CREATE TABLE `userregistration` (
  `id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phoneno` bigint(20) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userregistration`
--

INSERT INTO `userregistration` (`id`, `name`, `email`, `phoneno`, `address`) VALUES
(6, 'john ', 'john1234@gmail.com', 9823876234, 'kalathilhouse aluva'),
(7, 'mathew', 'mathew1236@gmail.com', 9812764390, 'abc house'),
(9, 'aa', 'aa@mail.com', 9863212345, '###################\r\n'),
(10, 'uu', 'uu@mail.com', 9864321256, '############'),
(11, 'yy', 'yy@mail.com', 9212909865, 'sdfg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serviceregistration`
--
ALTER TABLE `serviceregistration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userregistration`
--
ALTER TABLE `userregistration`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `serviceregistration`
--
ALTER TABLE `serviceregistration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `userregistration`
--
ALTER TABLE `userregistration`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
