-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 19, 2021 at 05:16 AM
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
-- Table structure for table `contact_info_internal`
--

CREATE TABLE `contact_info_internal` (
  `id` int(11) NOT NULL,
  `sender_user_id` int(11) NOT NULL,
  `recipient_user_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `project_id` int(11) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` varchar(4000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_info_internal`
--
ALTER TABLE `contact_info_internal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_info_internal_sender_user_1` (`sender_user_id`),
  ADD KEY `contact_info_internal_recipient_user_2` (`recipient_user_id`),
  ADD KEY `contact_info_internal_project_id_1` (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_info_internal`
--
ALTER TABLE `contact_info_internal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_info_internal`
--
ALTER TABLE `contact_info_internal`
  ADD CONSTRAINT `contact_info_internal_project_id_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `contact_info_internal_recipient_user_2` FOREIGN KEY (`recipient_user_id`) REFERENCES `app_user` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `contact_info_internal_sender_user_1` FOREIGN KEY (`sender_user_id`) REFERENCES `app_user` (`id`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
