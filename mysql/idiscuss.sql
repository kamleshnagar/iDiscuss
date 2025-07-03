-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2025 at 02:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS idiscuss;
-- Database: `idiscuss`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS  `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_discription` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `image_url` varchar(255) DEFAULT NULL,
  `website` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_discription`, `created_at`, `image_url`, `website`) VALUES
(1, 'Python', 'Python is a high-level, versatile, and interpreted programming language known for its readability and ease of use. It\'s widely employed in web development, data science, machine learning, and various other fields. Its design emphasizes code clarity throug', '2025-07-02 01:47:34', 'img/python.png', 'https://www.python.org'),
(2, 'PHP', 'PHP, which stands for PHP: Hypertext Preprocessor, is a widely used, open-source, server-side scripting language primarily designed for web development. It allows developers to create dynamic and interactive web pages by embedding PHP code within HTML. Es', '2025-07-02 01:48:04', 'img/php.png', 'https://www.php.net'),
(3, 'JavaScript ', 'JavaScript is a high-level, often just-in-time compiled, and multi-paradigm programming language that is primarily used to make web pages interactive. It\'s a core technology of the World Wide Web alongside HTML and CSS. It enables dynamic and interactive ', '2025-07-02 01:48:52', 'img/js.png', 'https://www.javascript.com'),
(4, 'Flask ', 'Flask is a lightweight Python web framework. It\'s often called a \"microframework\" because it provides essential tools for web development without forcing specific features or libraries. This flexibility allows developers to choose and integrate their pref', '2025-07-02 01:50:16', 'img/flask.png', 'https://flask.palletsprojects.com'),
(5, 'Django', 'Django is a free and open-source, Python-based web framework that facilitates the rapid development of web applications. It follows the Model-Template-Views (MTV) architectural pattern, which is a variation of the Model-View-Controller (MVC) pattern.', '2025-07-02 02:09:40', 'img/django.png', 'https://www.djangoproject.com');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS  `comments` (
  `comment_id` int(8) NOT NULL,
  `comment_content` text NOT NULL,
  `thread_id` int(8) NOT NULL,
  `comment_by` varchar(50) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE IF NOT EXISTS  `threads` (
  `thread_id` int(11) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_desc` text NOT NULL,
  `thread_cat_id` int(11) NOT NULL,
  `thread_user_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES
(1, 'How to Build a Simple Inventory Management System in Python?', 'An inventory management system helps track products, quantities, prices, and transactions. This thread will guide beginners and intermediate Python learners to create a basic yet functional inventory system using core Python concepts such as dictionaries, lists, functions, and file handling.', 1, 1, '2025-07-02 02:03:31'),
(2, 'Understanding Python Lists vs Tuples – When to Use What?', 'Python provides two key sequence types: lists and tuples. They are similar in many ways but serve different purposes. Understanding when to use a list vs a tuple is important for writing clean, efficient code.\r\n\r\n', 1, 2, '2025-07-02 02:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS  `users` (
  `sno` int(8) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `user_email`, `user_pass`, `timestamp`) VALUES
(1, 'kamlesh@gmail.com', '$2y$10$.mSNb22iaOnmC2R/8H7QfOf2hakWuNhY5RqdrhGDYPFpsXbwpZETS', '2025-07-03 11:15:53'),
(2, 'jinal@jinal.com', '$2y$10$2fcX8lupQU1r9W76URFKU.jeUMHi/nTI0IsQiYitQahziljrZIZcu', '2025-07-03 12:41:14'),
(3, 'harsh@gmail.com', '$2y$10$EpMNzH9F.1jpY4bNXF17IuNcRtM.4RqTV1mBwunj8X84g/l.Fg14S', '2025-07-03 12:42:35'),
(4, 'anil@anil.com', '$2y$10$/Eca62POnN5XwY4Knu1GluXMWaHIWRHSBkwmBoBHGRxmsOXdYwvKi', '2025-07-03 12:44:10'),
(5, 'anil2@anil2.com', '$2y$10$BqjqlzFdUtu6C/8Gnu1Og.LPPfHwO/ZafgbVo9Z9YUECyOa2StDy6', '2025-07-03 12:45:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`thread_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `thread_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
