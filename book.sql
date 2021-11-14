-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 13, 2021 at 09:02 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `announcement` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `announcement`, `time`) VALUES
(12, 'exam postponed due to covid-19', '2021-11-13 07:43:00'),
(13, 'admission re-open on 31st dec,2021', '2021-11-13 07:43:00');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `location` varchar(255) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `description`, `price`, `location`, `phone`, `image`, `time`) VALUES
(1, 'fdsjah', '', 0, 'fhkjdsa', 0, '', '0000-00-00 00:00:00'),
(2, 'php', 'php brief introduction', 300, 'delhi', 9910628828, '235490_94491391_10156893237037676_7915541524421541888_o.jpg', '2021-10-17 00:00:00'),
(3, 'mysql', 'database full', 300, 'delhi dwarka', 8888888888, '822335_a.jpg', '2021-10-17 12:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `topic` text NOT NULL,
  `semester` int(11) NOT NULL,
  `time` time NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `subject`, `topic`, `semester`, `time`, `file`) VALUES
(1, 'Java', 'introduction of java', 3, '09:57:00', 'Unit-7.pdf'),
(3, 'Computer Graphics', 'create game using c', 1, '10:02:00', '657652_'),
(4, 'COMPUTER BASIC', 'features scope of computer', 6, '10:03:00', '161582_'),
(5, 'Computer Graphics', 'types of computer graphics', 1, '10:03:00', '804134_'),
(6, 'Computer Graphics', 'types of CG Algo', 1, '10:03:00', '155267_'),
(22, 'Computer Graphics', 'introduction of CG', 5, '11:40:00', 'Block-2.pdf'),
(23, 'Computer Graphics', 'advantages of CG', 5, '11:41:00', '638031_'),
(24, 'NETWORKING', 'Describe all protocol', 3, '01:07:00', 'ntm 2.pdf'),
(25, 'PYTHON', 'Data Structure in Python', 6, '01:31:00', 'authentication and authorization.pdf'),
(26, 'PYTHON', 'operators in python', 6, '01:33:00', 'array.pdf'),
(27, 'Computer Graphics', 'data insetty\r\n', 0, '00:00:00', ''),
(29, 'AI', 'introduction of AI', 6, '01:35:00', 'IMG-20210806-WA0001.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `notice_type` text NOT NULL,
  `description` text NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp(),
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `title`, `notice_type`, `description`, `time`, `file`) VALUES
(56, 'Exam will be conducting by offline mode', '', 'message from BTE on 2021,nov 2nd', '2021-11-13 07:58:00', '741745_'),
(57, 'V semester ITESM branch', '', 'kind attention : V semester ITESM branch join this meeting at 2:00PM on 22nd nov,2021.\r\nit\'s mandatory to join this webinar.\r\nWebinar link here \r\nhttps://meet.google.com/gxg-jhsdg-zhf', '2021-11-13 08:04:00', '675824_');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `name`, `email`, `pwd`, `phone`, `dob`, `pic`) VALUES
(15, 'Admin', 'admin', '$2y$10$SByGUwL1w6YJgk8KMpB2S.jzLcNvoQ9kvzccpq0UIbKHoa423KwLW', '', '0000-00-00', ''),
(31, 'amit solanki', 'amit100lanki701@gmail.com', '$2y$10$boQ1TuATjqM5pQNGp7wovePZCkP86M3R9NNu1cdlMHC1Y2FwwfYCu', '', '0000-00-00', ''),
(32, 'jai bholeki', 'jaibholeki701@gmail.com', '$2y$10$udJnNK1qldWuYbBHLaywqeISEq/3auKy.45qNGaoFnpqV6tM930jq', '', '2021-11-24', '');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` int(11) NOT NULL,
  `course` text NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `day` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `room` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `title` text NOT NULL,
  `timetable_type` text NOT NULL,
  `description` text NOT NULL,
  `time` date NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`id`, `course`, `time_from`, `time_to`, `day`, `subject`, `room`, `semester`, `title`, `timetable_type`, `description`, `time`, `file`) VALUES
(1, 'MLT', '00:00:00', '00:00:00', 'Tuesday', 'Java', 22, 3, 'time', 'jkdshfjkhdsfkjhkjjkjkasdjkf', 'dfsjfhkjdfhssssssssssssssssssshfkjdhsfj', '2021-11-07', ''),
(7, 'IT', '10:00:00', '11:30:00', 'Tuesday', 'Applied Math-2', 212, 2, 'dfjskha', '', 'hsdjakfka', '2021-11-13', '869150_'),
(8, 'IT', '12:30:00', '13:30:00', 'Monday', 'Cyber Security and Cyber Law', 225, 4, '', '', '', '2021-11-07', '247224_'),
(9, 'BCA', '08:30:00', '10:00:00', 'Wednesday', 'Cyber Security and Cyber Law', 324, 3, '', '', '', '2021-11-09', '661088_');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `pic` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `pic`, `time`) VALUES
(27, 'Amit.jpg', '2021-11-03 08:48:49'),
(29, 'a.jpg', '2021-11-07 07:22:29'),
(31, 'a.jpg', '2021-11-07 07:31:54'),
(32, '3.jpg', '2021-11-11 02:10:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
