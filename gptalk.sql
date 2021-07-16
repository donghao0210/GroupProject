-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2021 at 07:43 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gptalk`
--
CREATE DATABASE IF NOT EXISTS `gptalk` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gptalk`;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `comment_id` int(10) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `content` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `post_id`, `created_by`, `content`, `created_at`, `updated_at`) VALUES
(10, 23, 1, 'i know', '2021-07-14 12:04:37', '2021-07-14 12:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `created_by`, `content`, `created_at`, `updated_at`) VALUES
(5, 1, 'hello', '2021-07-14 08:12:29', '2021-07-14 08:12:29'),
(6, 6, 'asd', '2021-07-14 08:18:42', '2021-07-14 08:18:42'),
(7, 6, 'hello world', '2021-07-14 08:30:05', '2021-07-14 08:30:05'),
(18, 1, '123', '2021-07-14 09:10:35', '2021-07-14 09:10:35'),
(21, 6, 'hello', '2021-07-14 09:13:13', '2021-07-14 09:13:13'),
(22, 1, 'adsadsad', '2021-07-14 11:28:41', '2021-07-14 11:28:41'),
(23, 1, 'i am here', '2021-07-14 12:04:31', '2021-07-14 12:04:31'),
(24, 1, 'asdzzzzzzz', '2021-07-14 13:31:33', '2021-07-14 13:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(254) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `password`, `created_at`) VALUES
(1, 'test@gmail.com', 'Test User', '12345', '2021-06-29 21:15:22'),
(6, 'a@a.com', 'Lee Dong Hao', 'asc', '2021-07-12 10:25:20'),
(8, 'donghao20082001@gmail.com', 'a', 'aa', '2021-07-12 10:25:58'),
(9, 'user123@example.com', 'c', 'zxc', '2021-07-12 10:26:25'),
(12, 'leedonghao@sd.taylors.edu.my', 'e', 'zxc', '2021-07-12 10:26:46'),
(14, 'aaa@mail.com', 'g', '2168546846', '2021-07-12 14:07:12'),
(15, 'a@aaa.com', 'cz', '5555555', '2021-07-14 03:06:36'),
(24, 'test@gmail.com12', 'asd', 'asdad', '2021-07-14 03:10:58'),
(26, 'test@gmail.comaaa', 'c', 'ads', '2021-07-14 03:18:53'),
(28, 'test@gmail.comasda', 'Lee Dong Hzcxzcxao', '123', '2021-07-14 03:27:13'),
(30, 'test@gmail.comasdaa', '12', '123', '2021-07-14 03:27:30'),
(32, 'test@gmail.comasdaaa', 'Lee Dong 3333', '123', '2021-07-14 03:27:39'),
(33, 'test@gmail.comasdaaa1', '15323', '123', '2021-07-14 03:28:14'),
(35, 'test@gmail.comasdaaa1a', 'alvin', '123ads', '2021-07-14 03:28:20'),
(36, 'test@gmail.comasdaaa1aa', 'b', '123ads', '2021-07-14 03:29:53'),
(37, 'donghao20082001@gmail.comads', '1231241', 'dad', '2021-07-14 03:30:11'),
(38, 'donghao20082001@gmail.comadsa', 'zzzzzzzzz', 'asd', '2021-07-14 03:30:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `FK_comment_user` (`created_by`),
  ADD KEY `FK_comment_post` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `FK_post_user` (`created_by`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_comment_post` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_comment_user` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_post_user` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
