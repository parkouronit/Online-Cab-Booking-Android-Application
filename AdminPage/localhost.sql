-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2018 at 04:36 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id4173357_localhost`
--
CREATE DATABASE IF NOT EXISTS `id4173357_localhost` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id4173357_localhost`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `unique_id` varchar(23) COLLATE utf8_unicode_ci NOT NULL,
  `a_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `a_contact` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `a_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `encrypted_password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `unique_id`, `a_name`, `a_contact`, `a_email`, `encrypted_password`, `salt`) VALUES
(4, '5a706a9d2855a7.09358414', 'ron', '8974286051', 'ron@gmail.com', '5U5WPf2lBmr3pGY82SLEtrEolodjYmQ4YjliM2I4', 'cbd8b9b3b8'),
(5, '5a770f39507ab2.18277984', 'abccc', '1235363245', 'a@gmail.com', 'Fw08oK2Wzu9obIpVX66Hqt7rk11lNTU5YmFmZGEx', 'e559bafda1'),
(7, '5b02090e86f8e5.41657510', 'abc', '6789998222', 'abc@gmail.com', 'fa36yx5c2fRX1MGJ43QR/YMQJJplNzIxNGMyNzY0', 'e7214c2764');

-- --------------------------------------------------------

--
-- Table structure for table `carselect`
--

CREATE TABLE `carselect` (
  `id` int(11) NOT NULL,
  `car_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `max_seats` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `carselect`
--

INSERT INTO `carselect` (`id`, `car_name`, `max_seats`) VALUES
(1, 'Toyota Innova', 8),
(2, 'Swift Dzire', 5),
(3, 'Chevorlet Enjoy', 8),
(4, 'alto', 5),
(5, 'jeep', 5),
(6, 'abc', 5);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` int(11) NOT NULL,
  `unique_id` varchar(23) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `license` longblob,
  `permit` longblob,
  `rc` longblob NOT NULL,
  `car_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `stat` tinyint(1) NOT NULL,
  `ontrip` tinyint(1) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `dawg_tag` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `insurance` longblob,
  `encrypted_password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` double(10,7) NOT NULL,
  `latitude` double(10,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `unique_id`, `name`, `email`, `contact`, `license`, `permit`, `rc`, `car_name`, `stat`, `ontrip`, `verified`, `dawg_tag`, `insurance`, `encrypted_password`, `salt`, `longitude`, `latitude`) VALUES
(11, '5af4541d6d7419.83792410', 'ronn', 'ronn@gmail.com', '8974286051', 0x313532373232343733333330382e706e67, NULL, '', 'alto', 1, 0, 1, '', NULL, 'Z5eNTfJg3Ih3JS7uePcvVk9DS/w3OTBlMWYxMmZm', '790e1f12ff', 91.8890149, 25.5754061);

-- --------------------------------------------------------

--
-- Table structure for table `feeback`
--

CREATE TABLE `feeback` (
  `id` int(11) NOT NULL,
  `r_id` int(11) DEFAULT NULL,
  `driver_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `f_ponits` float(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `feeback`
--

INSERT INTO `feeback` (`id`, `r_id`, `driver_email`, `user_email`, `f_ponits`) VALUES
(3, 75, 'ronn@gmail.com', 'ron@gmail.com', 1.500000),
(7, 75, 'ronn@gmail.com', 'ron@gmail.com', 2.500000);

-- --------------------------------------------------------

--
-- Table structure for table `rides`
--

CREATE TABLE `rides` (
  `ride_id` int(11) NOT NULL,
  `driver_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `src_lat` double(10,4) NOT NULL,
  `src_lng` double(10,4) NOT NULL,
  `dest_lat` double(10,4) NOT NULL,
  `dest_lng` double(10,4) NOT NULL,
  `stats` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'null',
  `date` date NOT NULL,
  `time` time NOT NULL,
  `carType` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rides`
--

INSERT INTO `rides` (`ride_id`, `driver_email`, `user_email`, `src_lat`, `src_lng`, `dest_lat`, `dest_lng`, `stats`, `date`, `time`, `carType`) VALUES
(75, 'ronn@gmail.com', 'ron@gmail.com', 55.3781, 3.4360, 26.1445, 91.7362, 'ended', '2018-05-12', '05:30:00', 'alto'),
(81, 'ronn@gmail.com', 'ron@gmail.com', 25.5693, 91.8978, 25.5696, 91.8977, 'ended', '2018-05-30', '10:33:00', 'alto'),
(82, 'ronn@gmail.com', 'ron@gmail.com', 25.5657, 91.8971, 25.5663, 91.8970, 'canceled', '2018-05-25', '12:39:00', 'alto');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` varchar(23) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `encrypted_password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `image` longblob,
  `coupon_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` double(10,7) NOT NULL,
  `longitude` double(10,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `name`, `contact`, `email`, `encrypted_password`, `salt`, `image`, `coupon_code`, `latitude`, `longitude`) VALUES
(11, '5af50a6f447f66.20895261', 'ron@gmail.com', '8974286051', 'ron@gmail.com', '7kDg0nygNskNRCwrZ+l30sK8OhMyOGU1ZThhMzBj', '28e5e8a30c', NULL, NULL, 25.5656643, 91.8971898);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`),
  ADD UNIQUE KEY `contact` (`a_contact`),
  ADD UNIQUE KEY `email` (`a_email`);

--
-- Indexes for table `carselect`
--
ALTER TABLE `carselect`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `car_name` (`car_name`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `contact` (`contact`);

--
-- Indexes for table `feeback`
--
ALTER TABLE `feeback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `r_id` (`r_id`);

--
-- Indexes for table `rides`
--
ALTER TABLE `rides`
  ADD PRIMARY KEY (`ride_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`),
  ADD UNIQUE KEY `contact` (`contact`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `coupon_code` (`coupon_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `carselect`
--
ALTER TABLE `carselect`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `driver_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `feeback`
--
ALTER TABLE `feeback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `rides`
--
ALTER TABLE `rides`
  MODIFY `ride_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feeback`
--
ALTER TABLE `feeback`
  ADD CONSTRAINT `feeback_ibfk_1` FOREIGN KEY (`r_id`) REFERENCES `rides` (`ride_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`coupon_code`) REFERENCES `coupon` (`coupon_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
