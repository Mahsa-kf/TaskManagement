-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2021 at 03:42 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `project_id` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `description`, `created_date`, `project_id`, `creator_user_id`) VALUES
(1, 'Test Category Title', 'Test Category Desc', '2021-04-21 20:22:26', 6, 7),
(2, 'Test Category Title 2 ', 'Test Category Desc 2', '2021-04-21 18:22:29', 6, 7);

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

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `answer` varchar(1000) DEFAULT NULL,
  `category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `question`, `answer`, `category`) VALUES
(1, 'How to get started with TEAM C4M Task Management', 'Step 1 - Create an accountPlease sign up to create your account. To add your team members, it is required all of your team members you want to add need to have their account.Step 2 - Create a new projectYou can find the link to “Create New Project” on the header navigation.Once you create a new project, it will display on Projects Overview.Step 3 - Add members for the taskOn “Projects Overview” you created, click “Member” button, then you can add members for this project.\r\n\r\nStep 4 - Create Tasks in Task board\r\nYou can add tasks for related project from Task board.', 1),
(2, 'what are dashboards?', 'Dashboards are a great way to display what\'s important in just one place. Users can now understand project progress, track deadline, estimate teammates workload and much more! It helps to keep your team focused and motivated on the high-level goals and boost productivity! ', 2),
(3, 'How to add Projects Overview?', 'Click on the + Add icon on the last card of the projects', 2),
(4, 'Who can create a project?', 'Our system allows everyone who has an account. Once you create a project, you can add team members.', 1),
(5, 'What is TEAM C4M Task Management', 'TEAM C4M Task Management is a Task Management System that powers teams to run projects and workflows with confidence. It’s a simple, but intuitive, Task Management System for teams to shape workflows, adjust to shifting needs, create transparency, connect collaboratively, and stop doing manual grunt work. monday.com makes teamwork click.', 1),
(6, 'How do I invite members to join my account?', 'One of the first steps in setting up your TEAM C4M Task Management account is inviting your members', 1),
(7, 'How do I log into my account?', 'Whether you\'re logging into your account for the first time or are needing help after successfully logging in in the past, we\'ve got you covered with easy steps to follow.\r\nIf you are login for the first time, you need to have your account. Please click sign up button to create your account. Once you create your account successfully, you are automatically logged in.Once you have already completed the sign-up process and had an account, please login from login page.', 1),
(8, 'I forgot my password', 'Please contact us so that we can help you! ', 3),
(9, 'I want to delete my account', 'Please contact us from the form so that we can help you.', 3),
(10, 'I have some more questions. Where can I get assistance?', 'You can ask a question submit a request for assistance from our Support team. Please fill out the form from contact us page.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE `priority` (
  `id` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `description`) VALUES
(1, 'Critical'),
(2, 'High'),
(3, 'Medium'),
(4, 'Low');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `project_timestamp` datetime NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `project_timestamp`, `description`) VALUES
(1, 'Hospital Project', '2021-03-01 10:41:06', 'Web Redesign for Hospital LNDH'),
(2, 'Order Application', '2021-03-15 23:41:06', 'online order website'),
(3, 'Aroma Project', '2021-03-14 13:43:32', 'Restaurant Project'),
(4, 'Tech Solution', '2021-03-30 00:00:00', 'Tech solution website'),
(5, 'Agricultural Technology Solution', '2021-04-16 23:49:00', 'Implementation of JS, HTML and Angular with Laravel Framework for a company that sale agriculture products.'),
(6, 'Foody Lab ', '2021-04-19 04:49:00', 'setting requires MongoDB to run crud functionality');

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE `project_user` (
  `app_user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_user`
--

INSERT INTO `project_user` (`app_user_id`, `project_id`, `role_id`) VALUES
(7, 6, 2);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `description`) VALUES
(1, 'Project Owner'),
(2, 'Team Lead'),
(3, 'Team Member'),
(4, 'Viewer');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `description`) VALUES
(1, 'To Do'),
(2, 'In Progress'),
(3, 'Done'),
(4, 'Canceled');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` varchar(4000) DEFAULT NULL,
  `assigned_user_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `creator_user_id` int(11) DEFAULT NULL,
  `priority_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `estimated_time` decimal(10,0) DEFAULT NULL,
  `spent_time` decimal(10,0) DEFAULT NULL,
  `remaining_time` decimal(10,0) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `assigned_user_id`, `project_id`, `creator_user_id`, `priority_id`, `category_id`, `state_id`, `estimated_time`, `spent_time`, `remaining_time`, `created_date`) VALUES
(1, 'Task Title 1', 'Test Desc 1', 7, 6, 7, 2, 1, 2, '5', '1', '4', '2021-04-21 20:31:02'),
(2, 'Task Title 2', 'Test Desc 2', 7, 6, 7, 2, 1, 2, '6', '0', '6', '2021-04-21 20:31:25'),
(3, 'Some Random Task', 'Some Random Task', 7, 6, 7, 3, 1, 3, '4', '4', '0', '2021-04-21 22:50:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `creator_user_id` (`creator_user_id`);

--
-- Indexes for table `contact_info_internal`
--
ALTER TABLE `contact_info_internal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_info_internal_sender_user_1` (`sender_user_id`),
  ADD KEY `contact_info_internal_recipient_user_2` (`recipient_user_id`),
  ADD KEY `contact_info_internal_project_id_1` (`project_id`);

--
-- Indexes for table `contact_info_public`
--
ALTER TABLE `contact_info_public`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`app_user_id`,`project_id`),
  ADD UNIQUE KEY `app_user_id` (`app_user_id`,`project_id`),
  ADD KEY `project_id_fk` (`project_id`),
  ADD KEY `role_id_fk` (`role_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_user_id` (`assigned_user_id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `creator_user_id` (`creator_user_id`),
  ADD KEY `priority_id` (`priority_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `state_id` (`state_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_user`
--
ALTER TABLE `app_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_info_internal`
--
ALTER TABLE `contact_info_internal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_info_public`
--
ALTER TABLE `contact_info_public`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `priority`
--
ALTER TABLE `priority`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `category_ibfk_2` FOREIGN KEY (`creator_user_id`) REFERENCES `app_user` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `contact_info_internal`
--
ALTER TABLE `contact_info_internal`
  ADD CONSTRAINT `contact_info_internal_project_id_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `contact_info_internal_recipient_user_2` FOREIGN KEY (`recipient_user_id`) REFERENCES `app_user` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `contact_info_internal_sender_user_1` FOREIGN KEY (`sender_user_id`) REFERENCES `app_user` (`id`) ON DELETE NO ACTION;

--
-- Constraints for table `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `app_user_id_fk` FOREIGN KEY (`app_user_id`) REFERENCES `app_user` (`id`),
  ADD CONSTRAINT `project_id_fk` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  ADD CONSTRAINT `role_id_fk` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`assigned_user_id`) REFERENCES `app_user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`creator_user_id`) REFERENCES `app_user` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_ibfk_4` FOREIGN KEY (`priority_id`) REFERENCES `priority` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_ibfk_5` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tasks_ibfk_6` FOREIGN KEY (`state_id`) REFERENCES `state` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
