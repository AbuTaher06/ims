-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 05:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anti_sexual_harasement`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'taher', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(50) NOT NULL,
  `victim` varchar(255) NOT NULL,
  `victim_contact` varchar(50) NOT NULL,
  `victim_email` varchar(255) NOT NULL,
  `accuser` varchar(255) NOT NULL,
  `accuser_class` varchar(50) NOT NULL,
  `accuser_contact` varchar(50) NOT NULL,
  `accuser_email` varchar(255) NOT NULL,
  `complaint` varchar(1000) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `signature` varchar(255) NOT NULL,
  `submission_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `name`, `class`, `victim`, `victim_contact`, `victim_email`, `accuser`, `accuser_class`, `accuser_contact`, `accuser_email`, `complaint`, `time`, `date`, `signature`, `submission_date`) VALUES
(23, 'Jannat', '9', 'sadia', '01930234234', 'rupa@gmail.com', 'xyz', '8', '01930234234', 'rupa@gmail.com', 'saaaaaaa', '04:40:00', '2024-04-17', 'sadia', '2024-04-13 11:40:55'),
(24, 'Sadia', '9', 'sadia', '01930234234', 'rupa@gmail.com', 'xyz', '8', '01930234234', 'rupa@gmail.com', 'sdfffff', '00:45:00', '2024-04-16', 'sadia', '2024-04-10 05:41:53'),
(28, '', '', '', '', '', '', '', '', '', '', '00:00:00', '0000-00-00', '', '2024-04-15 15:52:42'),
(29, 'Md Abu Taher', '', '', '+8801645787748', 'rupa@gmail.com', '', '', '', 'rupa@gmail.com', '', '00:00:00', '0000-00-00', '', '2024-04-15 15:53:18'),
(30, '', '', '', '', '', '', '', '', '', '', '00:00:00', '0000-00-00', '', '2024-04-15 19:14:18'),
(31, '', '', '', '', '', '', '', '', '', '', '00:00:00', '0000-00-00', '', '2024-04-16 10:38:21');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `title`, `photo`) VALUES
(1, 'form', 'images/mailto.jpg'),
(2, 'friend', 'images/429495350_2060356684335922_585035924552059077_n.jpg'),
(3, 'index', 'images/index.png'),
(4, 'QR', 'images/qrcode_chat.openai.com.png'),
(5, 'gazal', 'images/এই প্রথম বাবার গজল ছেলের কণ্ঠে । Somadhan । সমাধান । Galib Bin Azad । Aynuddin Al Azad.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `notice_details` text NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `published_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `notice_details`, `file_name`, `published_date`) VALUES
(13, 'Question', 'Desco_AE_Question_Solve (1).pdf', '2024-04-12 15:52:47'),
(14, 'Question', 'Desco_AE_Question_Solve (1).pdf', '2024-04-12 18:21:41'),
(15, 'Wordpress Module', 'Wordpress Module.pdf', '2024-04-13 14:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `profile`, `password`, `timestamp`) VALUES
(1, 'mdabutaher4854@gmail.com', 'Taher', '', '12345', '2024-04-12 16:55:40'),
(2, 'rupa@gmail.com', 'Rupa', '', 'rupa1234', '2024-04-12 16:55:40'),
(3, 'sadia@gmail.com', 'sadia', '', 'sadia123', '2024-04-12 16:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `file` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `title`, `file`) VALUES
(1, 'gazal', 'videos/এই প্রথম বাবার গজল ছেলের কণ্ঠে । Somadhan । সমাধান । Galib Bin Azad । Aynuddin Al Azad.mp4'),
(2, 'song', 'videos/AAP KI NAZRON NE SAMJHA { आपकी नज़रों ने समझा } SHREYA GHOSHAL _ 🙏🏻PLEASE 🙏🏻 SUBSCRIBE OUR CHANNEL _.mp4'),
(3, 'megla', 'videos/Ei Meghla Dine Ekla - Audio - Hemanta Mukherjee - Gauriprasanna Mazumder.mp4'),
(4, 'story', 'videos/1595042269029.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
