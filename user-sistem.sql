-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2020 at 11:12 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user-sistem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin1', '8cb2237d0679ca88db6464eac60da96345513964'),
(2, 'admin2', '7c4a8d09ca3762af61e59520943dc26494f8941b');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `feedback` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `replied` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `uid`, `subject`, `feedback`, `created_at`, `replied`) VALUES
(1, 49, 'asdzxczcx', 'zxczxczxczxc', '2020-05-25 19:10:03', 0),
(2, 49, 'asdasd', 'asdasdadssd', '2020-05-27 10:25:14', 0),
(3, 49, 'asdasdzxc', 'zxczxczcxzc', '2020-05-27 10:26:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `notes` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `uid`, `title`, `notes`, `created_at`, `updated_at`) VALUES
(8, 49, 'asdasd1232', 'asdasdasdasdasdasdasd a sd asd as das das dasdasdasd asd as das adsadasd asd as', '2020-05-22 14:49:31', '2020-05-22 15:29:15'),
(13, 49, 'asdasd', 'asdasd', '2020-05-27 11:43:41', '2020-05-27 11:43:41'),
(17, 2, 'asdasd', 'asdasdasdasdasd', '2020-05-31 15:32:18', '2020-05-31 15:32:18'),
(18, 1, 'asdasd', 'asdasdasssssssssssssssss', '2020-05-31 15:32:30', '2020-05-31 15:32:30'),
(19, 1, 'sss', 'sssssssssssssssssss  ssssssssssssssssssssssssssss sssssssssssssss s', '2020-05-31 15:32:39', '2020-05-31 15:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `uid`, `type`, `message`, `created_at`) VALUES
(16, 49, 'Aktivitas kamu', 'Menghapus note', '2020-05-27 13:40:14'),
(17, 1, 'Aktivitas kamu', 'Memperbaharui profil', '2020-05-30 13:32:40'),
(19, 53, 'Aktivitas kamu', 'Memperbaharui profil', '2020-05-31 09:36:07'),
(20, 54, 'Aktivitas kamu', 'Memperbaharui profil', '2020-05-31 09:41:21'),
(21, 2, 'Aktivitas kamu', 'Menambahkan note', '2020-05-31 15:32:18'),
(22, 1, 'Aktivitas kamu', 'Menambahkan note', '2020-05-31 15:32:30'),
(23, 1, 'Aktivitas kamu', 'Menambahkan note', '2020-05-31 15:32:39'),
(24, 2, 'Aktivitas kamu', 'Menambahkan note', '2020-05-31 15:32:59'),
(25, 49, 'Dari Admin', 'sdadads', '2020-05-31 22:27:37'),
(26, 49, 'Dari Admin', 'asdadxczadasd 12345', '2020-05-31 22:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dob` date DEFAULT NULL,
  `photo` varchar(255) NOT NULL,
  `token` varchar(100) NOT NULL,
  `token_expire` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verified` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone`, `gender`, `dob`, `photo`, `token`, `token_expire`, `created_at`, `verified`, `deleted`) VALUES
(1, 'teza', 'teza@gmail.com', '$2y$10$X/pslrO0q5a9xLTEtzoe1uaGAzE.ODt1xuxnM7ZIvcbHhYlmPu0B2', '081250575833', 'female', '2020-05-06', '', '', '2020-05-30 13:32:40', '2020-05-17 21:02:41', 0, 1),
(2, 'dino', 'dino@gmail.com', '$2y$10$uPe9dj1i.XuDf1JFFtQSAurkTL1Cp9sAKIMeQP5TIVN3vxzCc2eLe', '01250575833', 'male', '2020-05-06', '', '', '2020-05-31 15:04:52', '2020-05-17 21:04:58', 0, 1),
(49, 'ahmad murtezaa', 'akbarteza54@gmail.com', '$2y$10$MF1PtVdcIX0O.GN5sOfqS.yvR6d7kL4SD5YRZQBvmCxsoxR8RZj1u', '1231231232', 'male', '2020-05-03', 'adult-analysis-banking-1549000.jpg', '', '2020-05-27 10:25:07', '2020-05-18 22:00:14', 1, 1),
(51, 'asdasd', 'asd@gmail.com', '$2y$10$MBCJhMFgs4jVjLkrtblcL.T8o1tG07C67OzX7bcU.29fQm7UmAuhe', '', '', '0000-00-00', '', '', '2020-05-31 21:52:10', '2020-05-31 09:30:21', 0, 0),
(52, 'xzczx', 'asdf@gmail.com', '$2y$10$f94ZSxbmbMV44eRxTKJwbO85GRwg8Es/EfhhJujLOb90UHnbjU0oK', '', '', '0000-00-00', '', '', '2020-05-31 21:52:14', '2020-05-31 09:32:31', 0, 0),
(53, 'fsdfsf', 'asdz@gmail.com', '$2y$10$XSS1/Fk0fRAr/uzobbkCbOhVAhvAF19pyLXU61KAhojWISdf5vWKa', '', '', '2020-05-12', '', '', '2020-05-31 21:52:16', '2020-05-31 09:34:58', 0, 0),
(54, 'asdasd', 'xcxcz@asdasd', '$2y$10$lvZ/Pep7F7IiqYbuzXqAL.wC2sPK4s2d4JW6yFdjZo/a4H.YUa46u', '', '', '2020-05-07', '', '', '2020-05-31 21:52:20', '2020-05-31 09:38:01', 0, 0),
(55, 'zxczxc', 'zxczxc@ads', '$2y$10$9vLkRZyNVqpZ.oTvE./gqO7y8NruvmWIq46zM1JY7NrDVemkKWxXu', '', '', NULL, '', '', '2020-05-31 21:52:24', '2020-05-31 10:35:55', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` int(1) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `hits`) VALUES
(1, 109);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `feedback_ibfk_1` (`uid`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
