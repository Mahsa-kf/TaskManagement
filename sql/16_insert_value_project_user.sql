-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 01, 2021 at 06:43 AM
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
-- Table structure for table `project_user`
--

CREATE TABLE `project_user` (
  `id` int(11) NOT NULL,
  `app_user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_user`
--

INSERT INTO `project_user` (`id`, `app_user_id`, `project_id`, `role_id`) VALUES
(1, 3, 30, 1),
(2, 7, 30, 3),
(4, 3, 30, 1),
(5, 8, 30, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app_user_id_fk` (`app_user_id`),
  ADD KEY `project_id_fk` (`project_id`),
  ADD KEY `role_id_fk` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project_user`
--
ALTER TABLE `project_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `app_user_id_fk` FOREIGN KEY (`app_user_id`) REFERENCES `app_user` (`id`),
  ADD CONSTRAINT `project_id_fk` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `role_id_fk` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
