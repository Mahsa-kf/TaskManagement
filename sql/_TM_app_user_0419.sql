-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2021 at 05:17 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_user`
--

CREATE TABLE `app_user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(30) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `app_user`
--

INSERT INTO `app_user` (`id`, `first_name`, `last_name`, `username`, `password`, `phone_number`, `email_address`) VALUES
(3, 'James', 'Bond', 'james_bond', '12345678', '641-255-6825', 'james.bond@test.com'),
(7, 'Mary', 'Schick', NULL, '$2y$10$TYgIhHPPLQkwLeT439kj4.Y5gna3AuWnxyLZR4SxszRl.DW1xU/Vq', NULL, 'mary@test3.com'),
(8, 'Ken', 'Nicholls', NULL, '$2y$10$bllzN0mSnX49cOeVkS2Bw.AoSwwF9sppdWKe9qucFpJ3un.PxmH7W', NULL, 'ken@test.com'),
(9, 'Stephan', 'Watt', NULL, '$2y$10$TOrf43vzhcl7oKpn12.a0uQWA3tGV.9cDeUXBXwu.MliV9K5Kru32', NULL, 'stephan@test.com'),
(10, 'Terry', 'Tom', NULL, '$2y$10$/r4beRzMGqvhuWp4JTaEOu0XoiV1.Przs1aePeo1vJW4lfbdAzYCe', NULL, 'terry_tom@test.ca');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_user`
--
ALTER TABLE `app_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
