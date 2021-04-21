-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 21, 2021 at 04:42 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `task_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_info_public`
--

CREATE TABLE `contact_info_public` (
  `id` int(11) NOT NULL,
  `name` varchar(55) DEFAULT NULL,
  `email_address` varchar(55) DEFAULT NULL,
  `phone_number` varchar(55) DEFAULT NULL,
  `subject` varchar(55) DEFAULT NULL,
  `message` varchar(3000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_info_public`
--

INSERT INTO `contact_info_public` (`id`, `name`, `email_address`, `phone_number`, `subject`, `message`) VALUES
(1, 'Miho', 'nick@test1.com', '4161111111', 'product', 'jkjk'),
(2, 'Miho', 'nick@test1.com', '', 'product', 'jkjk'),
(3, 'Ariel Schick', 'ariel@schick.com', '', 'media', 'rerer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_info_public`
--
ALTER TABLE `contact_info_public`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_info_public`
--
ALTER TABLE `contact_info_public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
