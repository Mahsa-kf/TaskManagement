-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 21, 2021 at 02:07 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `task_management`
--

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
