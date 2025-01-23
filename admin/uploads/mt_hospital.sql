-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2025 at 08:21 PM
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
-- Database: `mt_hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `phone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `phone`) VALUES
(1, 'monir293', 'mmmonir293@gmail.com', '1234567', '01997638205'),
(2, 'admin', 'admin@gmail.com', '1234', '45435');

-- --------------------------------------------------------

--
-- Table structure for table `admission_patient`
--

CREATE TABLE `admission_patient` (
  `id` int(20) NOT NULL,
  `name` varchar(30) NOT NULL,
  `age` varchar(30) NOT NULL,
  `gender` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `admission_date` varchar(200) NOT NULL,
  `marital_status` varchar(30) NOT NULL,
  `address` varchar(60) NOT NULL,
  `medical_history` varchar(500) NOT NULL,
  `room_type` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `all_appointments`
--

CREATE TABLE `all_appointments` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `marital_status` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `appointmentDate` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `marital_status` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `appointmentDate` varchar(20) NOT NULL,
  `description` varchar(300) NOT NULL,
  `specialist` varchar(30) NOT NULL,
  `doctor` varchar(30) NOT NULL,
  `doctor_reg_no` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `link_status` varchar(50) NOT NULL DEFAULT 'Pending',
  `payment_gateway` varchar(255) DEFAULT NULL,
  `trxID` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `sender_number` varchar(20) DEFAULT NULL,
  `cash_in_number` varchar(20) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `payment_status` tinyint(1) DEFAULT 0,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `name`, `age`, `gender`, `marital_status`, `email`, `contact`, `address`, `appointmentDate`, `description`, `specialist`, `doctor`, `doctor_reg_no`, `status`, `link_status`, `payment_gateway`, `trxID`, `amount`, `sender_number`, `cash_in_number`, `admin_email`, `payment_status`, `created_at`) VALUES
(21, '123', '52', 'male', 'single', 'jahangiralomjonyru97@gmail.com', '0199763820555555', '123', '2024-09-03', 'cccc', 'Neurology', 'Dr.Rahat khan', '885522', 'Rejected', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(22, 'MONIR', '25', 'male', 'single', 'mmmonir292@gmail.com', '01997638205', 'jhenaigati', '2024-11-30', '-', 'Neurology', 'Dr.Rahat khan', '885522', 'Approved', 'sent', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(23, 'Md Abu Taher', '23', 'male', 'single', 'mdabutaher4854@gmail.com', '01645787748', 'Dhobaura,Mymensingh', '2024-10-02', 'etrtert', 'Cardiologist', 'DR.JAHANGIR ALOM JONY', '101234', 'Approved', 'sent', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(24, 'Md Abu Taher', '12', 'male', 'single', 'abutahercse3255@gmail.com', '01645787748', 'Dhobaura,Mymensingh\r\n2416', '2024-10-10', 'dfgdfgd', 'Endocrinologist', 'Kamal Hossen', '143445', '0', 'Pending', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(25, 'MM Monir', '34', 'male', 'single', 'mmmonir293@gmail.com', '01645787748', 'Dhobaura,Mymensingh\r\n2416', '2025-01-17', 'erwerwe', 'Neurology', 'Dr.Rahat khan', '885522', 'Rejected', 'sent', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(26, 'MM Monir', '34', 'male', 'single', 'mmmonir293@gmail.com', '01645787748', 'Dhobaura,Mymensingh\r\n2416', '2025-01-14', 'hsfsdhsdh', 'Cancer Specialist', 'Dr.Rahat Mia', '885524', 'Approved', 'sent', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(27, 'MM Monir', '4', 'female', 'divorced', 'mmmonir293@gmail.com', '01645787748', 'Dhobaura,Mymensingh\r\n2416', '2025-11-14', 'Tempore et recusand', 'Endocrinologist', 'Kamal Hossen', '143445', '0', 'sent', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(28, 'MM Monir', '25', 'female', 'single', 'mmmonir293@gmail.com', '01645787748', 'Dhobaura,Mymensingh\r\n2416', '2025-06-15', 'Exercitation fugiat ', 'Endocrinologist', 'Kamal Hossen', '143445', 'pending', 'sent', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(29, 'MM Monir', '30', 'female', 'widowed', 'mmmonir293@gmail.com', '01645787748', 'Dhobaura,Mymensingh\r\n2416', '2025-01-31', 'At reiciendis volupt', 'Orthopedic', 'Dr.Kabir  Hasan', '885524', 'pending', 'sent', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(30, 'MM Monir', '30', 'female', 'widowed', 'mmmonir293@gmail.com', '01645787748', 'Dhobaura,Mymensingh\r\n2416', '2025-01-31', 'At reiciendis volupt', 'Neurology', 'Dr.Rahat khan', '885522', 'pending', 'sent', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-01-22 23:42:41'),
(31, 'MM Monir', '100', 'male', 'married', 'mmmonir293@gmail.com', '01645787748', 'Aut et dicta vel vol', '2025-01-28', 'Dolor est nisi dolo', 'Neurology', 'Dr.Rahat khan', '885522', 'pending', 'sent', 'bkash', 'Ab aut est dolore es', 67.00, '768', '0', NULL, 0, '2025-01-22 23:48:57'),
(32, 'MM Monir', '26', 'female', 'divorced', 'mmmonir293@gmail.com', '01645787748', 'Delectus iste culpa', '2025-05-26', 'Aliquam tempora aut ', 'Neuro Medicine', 'Dr.Munayem khan', '885523', 'Approved', 'sent', 'nagad', 'Unde nobis aspernatu', 31.00, '214', 'pending ', NULL, 1, '2025-01-23 00:32:11'),
(33, 'MM Monir', '73', 'male', 'widowed', 'mmmonir293@gmail.com', '01645787748', 'Laboriosam officia ', '2025-02-12', 'Minima dolor ea eaqu', 'Neurology', 'Dr.Rahat khan', '885522', 'Approved', 'sent', 'nagad', 'Hrh35jhhr', 5500.00, '0193534534534', '0', NULL, 1, '2025-01-23 01:06:22');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `from_id` int(11) DEFAULT NULL,
  `to_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `opened` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `chat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`from_id`, `to_id`, `message`, `opened`, `created_at`, `chat_id`) VALUES
(64, 63, 'fff', 1, '2024-05-06 19:11:07', 8),
(64, 61, 'hey', 1, '2024-05-06 19:17:16', 9),
(64, 63, 'yo', 1, '2024-05-06 19:18:34', 8),
(64, 65, 'hh', 1, '2024-05-06 19:22:50', 10),
(64, 63, 'gff', 1, '2024-05-06 19:40:14', 8),
(64, 65, 'ghjg', 1, '2024-05-06 19:40:33', 10),
(64, 61, 'gggg', 1, '2024-05-06 19:42:04', 9),
(64, 63, 'rte', 1, '2024-05-06 20:02:36', 8),
(65, 64, 'jujutsu', 1, '2024-05-06 20:03:58', 10),
(64, 63, 'yo\n', 1, '2024-05-07 13:30:53', 8),
(64, 65, 'weecccw\n', 1, '2024-05-07 13:31:13', 10),
(65, 64, 'mew mew', 1, '2024-05-07 13:31:50', 10),
(65, 64, 'monir', 1, '2024-05-08 15:31:18', 10),
(64, 63, 'hello jony', 1, '2024-05-08 15:31:50', 8),
(65, 64, 'i am a boy', 1, '2024-05-08 16:23:18', 10),
(64, 63, 'hi\n', 1, '2024-05-08 16:24:02', 8),
(65, 64, 'ddd', 1, '2024-06-02 21:04:07', 10),
(65, 64, 'ggg', 1, '2024-06-02 21:06:26', 10),
(65, 64, 'gggg', 1, '2024-06-02 21:06:29', 10),
(65, 64, 'dfff', 1, '2024-06-02 21:06:54', 10),
(61, 64, 'hdfjhsdfnskdhfiosdhg', 1, '2024-07-11 08:35:02', 9),
(64, 61, 'hgjkdfhgkjdhgl', 1, '2024-07-11 08:36:14', 9),
(64, 63, 'hello\n', NULL, '2024-10-25 16:31:32', 8),
(61, 64, 'fghfghf', 1, '2024-10-25 16:32:41', 9),
(0, NULL, 'ghfhfh', 0, '2024-10-25 21:58:56', 10),
(0, NULL, 'ghghgh', 0, '2024-10-25 21:59:02', 10),
(0, 64, 'sdsdf', 0, '2024-10-25 22:09:38', 9),
(0, 64, 'sdsdf', 0, '2024-10-25 22:09:43', 9);

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `user_1` int(11) DEFAULT NULL,
  `user_2` int(11) DEFAULT NULL,
  `conversation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`user_1`, `user_2`, `conversation_id`) VALUES
(64, 63, 8),
(64, 61, 9),
(64, 65, 10);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(50) NOT NULL,
  `title` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `title`, `image`) VALUES
(8, '3d rendering of a hospital room interior with a bed and equipment, Interior of a modern hospital room ', 'rated-free-photo.jpg'),
(9, 'AC Cabin room (MT HOSPITAL)', 'download (3).jpeg'),
(10, 'Digital Xray(MT HOSPITAL)', '5361799211_5ae0a623ed_b.jpg'),
(11, '4D MRI Machine', 'download (2).jpeg'),
(12, '-', 'slide200d375539307400186fa3368392e7c38.png'),
(13, '-', 'communicating-severity-series---bangla-slide-6.png'),
(14, '-', 'images (6).jpeg'),
(15, '-', 'images (7).jpeg'),
(16, '-', 'images.png'),
(17, '-', 'Dengue-Fever-awareness-in-Bangla-34-320.webp'),
(18, '-', 'images (8).jpeg'),
(19, '-', 'images (9).jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `meeting_info`
--

CREATE TABLE `meeting_info` (
  `id` int(11) NOT NULL,
  `doctor_name` varchar(50) NOT NULL,
  `doctor_email` varchar(50) NOT NULL,
  `patient_name` varchar(50) NOT NULL,
  `patient_email` varchar(50) NOT NULL,
  `meeting_link` varchar(250) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meeting_info`
--

INSERT INTO `meeting_info` (`id`, `doctor_name`, `doctor_email`, `patient_name`, `patient_email`, `meeting_link`, `date`, `time`, `status`) VALUES
(5, 'DR.JAHANGIR ALOM JONY', 'jahangiralomjonyru97@gmail.com', 'Md Abu Taher', 'mdabutaher4854@gmail.com', 'fghfghfg', '2024-10-02', '10:45 PM', 'Approved'),
(6, 'DR.JAHANGIR ALOM JONY', 'jahangiralomjonyru97@gmail.com', 'Md Abu Taher', 'mdabutaher4854@gmail.com', 'fghfghfg', '2024-10-02', '10:45 PM', 'Approved'),
(7, 'Dr.Rahat khan', 'munayem@gmail.com', 'MM Monir', 'mmmonir293@gmail.com', 'Ut dignissimos exped', '2025-01-17', '09:52 PM', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `patient_records`
--

CREATE TABLE `patient_records` (
  `patient_name` varchar(255) NOT NULL,
  `medical_report` varchar(255) DEFAULT NULL,
  `secret_code` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient_records`
--

INSERT INTO `patient_records` (`patient_name`, `medical_report`, `secret_code`, `date`, `description`, `id`) VALUES
('WhatsAppImage2024-07-08at194227_8b325970_1720679652', 'uploads/WhatsAppImage2024-07-08at194227_8b325970_1720679652.jpg', NULL, '2024-07-11', 'amamama', 61),
('Monir_prescription1_1720892794', 'uploads/Monir_prescription1_1720892794.pdf', NULL, '2024-07-13', 'dddd', 61),
('Monir_prescription_1720893473', 'uploads/Monir_prescription_1720893473.pdf', NULL, '2024-07-13', 'xxxx', 61);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `payment_gateway` varchar(255) NOT NULL,
  `trxID` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `sender_number` varchar(255) DEFAULT NULL,
  `cash_in_number` varchar(255) DEFAULT NULL,
  `admin_email` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `payment_status` varchar(100) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_gateway`, `trxID`, `amount`, `sender_number`, `cash_in_number`, `admin_email`, `user_email`, `payment_status`, `created_at`) VALUES
(1, 'bkash', 'Alias amet necessit', 89.00, '570', '251', NULL, 'mmmonir293@gmail.com', '1', '2025-01-22 16:03:19'),
(2, 'bkash', 'Vel veritatis incidi', 59.00, '693', '388', NULL, 'mmmonir293@gmail.com', '1', '2025-01-22 16:05:23'),
(3, 'rocket', 'Ullam quia eu et hic', 90.00, '309', '232', NULL, 'mmmonir293@gmail.com', '0', '2025-01-22 16:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `patient_name` varchar(50) NOT NULL,
  `patient_email` varchar(50) NOT NULL,
  `vhc_header` varchar(255) NOT NULL,
  `prescription_header` varchar(255) NOT NULL,
  `doctor_name` varchar(255) NOT NULL,
  `doctor_email` varchar(255) NOT NULL,
  `doctor_reg_no` varchar(255) NOT NULL,
  `medication_list` text NOT NULL,
  `instructions` text NOT NULL,
  `pdf_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `patient_name`, `patient_email`, `vhc_header`, `prescription_header`, `doctor_name`, `doctor_email`, `doctor_reg_no`, `medication_list`, `instructions`, `pdf_path`, `created_at`) VALUES
(99, 'Monir', 'mmmonir293@gmail.com', 'Virtual Health Care System', 'Prescriptions', 'Monir', 'mmmonir293@gmail.com', '8855', '1.Napa extra (Morning, Noon, Night, 15 days); 2.maxpro (Morning, Night, 15 days)', 'be safe', 'prescriptions/Monir_prescription.pdf', '2024-07-10 19:12:36'),
(100, 'Monir', 'mmmonir292@gmail.com', 'Virtual Health Care System', 'Prescriptions', 'Monir', 'mmmonir293@gmail.com', '8855', '1.Napa extra (Morning, Noon, 110 days)', 'be careful', 'prescriptions/Monir_prescription.pdf', '2024-07-10 19:18:11'),
(101, 'Monir', 'mmmonir29@gmail.com', 'Virtual Health Care System', 'Prescriptions', 'gggg', 'a@gmail.com', '8854', 'ffff (Morning, Noon, 52 days); 222 (Morning, Noon, 2 days)', 'rererer', 'prescriptions/Monir_prescription.pdf', '2024-07-11 06:43:16'),
(102, 'Monir', 'mmmonir293@gmail.com', 'Virtual Health Care System', 'Prescriptions', 'a', 'a@gmail.com', '8854', 'q (Morning, Noon, 2 days)', 'www', 'prescriptions/Monir_prescription.pdf', '2024-07-11 18:23:57'),
(103, 'Md Abu Taher', 'mdabutaher4854@gmail.com', 'Virtual Health Care System', 'Prescriptions', 'DR.JAHANGIR ALOM JONY', 'jahangiralomjonyru97@gmail.com', '101234', 'sds (Morning, 44 days)', 'hgghg', 'prescriptions/Md Abu Taher_prescription.pdf', '2024-10-07 17:31:23'),
(104, 'Md Abu Taher', 'mdabutaher4854@gmail.com', 'Virtual Health Care System', 'Prescriptions', 'DR.JAHANGIR ALOM JONY', 'jahangiralomjonyru97@gmail.com', '101234', 'sds (Noon, 44 days)', 'asdasd', 'prescriptions/Md Abu Taher_prescription.pdf', '2024-10-07 17:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `specialistlist`
--

CREATE TABLE `specialistlist` (
  `id` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `medical_college_name` varchar(60) NOT NULL,
  `degree` varchar(60) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `visiting_time` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `specialist` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialistlist`
--

INSERT INTO `specialistlist` (`id`, `name`, `reg_no`, `medical_college_name`, `degree`, `designation`, `email`, `contact`, `photo`, `visiting_time`, `password`, `specialist`) VALUES
(9, 'DR.JAHANGIR ALOM JONY', '101234', 'Mymensingh Medical College', 'Cardiologist', 'Professor,MBBS,FCPS(UK)', 'jahangiralomjonyru97@gmail.com', '01766411622', 'jonypic.jpg', 'Every day ( 5pm-9pm )', '1234567', 'Cardiologist'),
(10, 'Ratan Chandra', '1012244', 'Mymensingh Medical College', 'MBBS,FCPS(USA),BCS Health', 'Professor', 'ratan@gmail.com', '01766411652', 'images (3).jpeg', 'Every day ( 5pm-9pm )', '12345677', 'Dermatologist'),
(11, 'Mujakkir Al Azad', '103040', 'Dhaka Medical College', 'MBBS,MD(UK),BCS Health', 'Associate Professor', 'sabbirazad25@gmail.com', '01765411255', 'download (4).jpeg', 'Everyday ( 6pm-10pm )', '121212', 'Gastroenterologist'),
(12, 'Kamal Hossen', '143445', 'Dhaka Medical College', 'MBBS,FCPS(CANADA),BCS Health', 'Associate Professor', 'kamal@gmail.com', '01798451105', 'download (5).jpeg', 'Every day ( 12pm-3pm )', '1001001', 'Endocrinologist'),
(18, 'Dr.Rahat khan', '885522', 'chittagong Medical College', 'MBBS,BCS,FCPS(Pakistan)', 'Professor', 'rahat@gmail.com', '01997638205', 'pngt.png', 'Sat-Thu (3pm-8pm)', '112233', 'Neurology'),
(19, 'Dr.Munayem khan', '885523', 'Rangpur Medical College', 'MBBS,BCS,MD(Thailand)', 'Assistant Professor', 'munayem@gmail.com', '01997638206', '360.jpg', 'Sat-Thu (3pm-8pm)', '112233', 'Neuro Medicine'),
(20, 'Dr.Kabir  Hasan', '885524', 'Rangpur Medical College', 'MBBS,BCS,FCPS(USA)', 'Professor', 'kabir@gmail.com', '01997638207', 'images (4).jpeg', 'Sat-Thu (3pm-8pm)', '11223344', 'Orthopedic'),
(21, 'Dr.Rahat Mia', '885524', 'Rangpur Medical College', 'MBBS,BCS,FCPS(Pakistan)', 'Professor', 'rahatt@gmail.com', '01997638208', '3fa.jpg', 'Sat-Thu (3pm-8pm)', '112233', 'Cancer Specialist'),
(22, 'Dr.Rahat khan', '885521', 'Rangpur Medical College', 'MBBS,BCS,FCPS(Pakistan)', 'Professor', 'rahaat@gmail.com', '01997638205', '3fa.jpg', 'Sat-Thu (3pm-8pm)', '112233', 'Chest and Asthma'),
(23, 'Dr.MD ZAMAN', '885452', 'Dhaka Medical College', 'MBBS,BCS,FCPS(Pakistan)', 'Professor', 'mmmonir293@gmail.com', '01997638205', 'pngt.png', 'Sat-Thu (3pm-8pm)', '123456', 'Cardiologist'),
(24, 'Dr.Rabia Bashri', '885520', 'Rangpur Medical College', 'MBBS,BCS,MD(Thailand)', 'Professor', 'rabiaboshritamanna@gmail.com', '01311041756', 'images (5).jpeg', 'Everyday (6pm-10pm)', '112233', 'Cardiologist'),
(25, 'Md Abu Thaher', '765467', 'fgfg', 'fgdfg', 'gdfgj', 'abutahercse3255@gmail.com', '01625781465', 'library.jpg', '66546', '123gy56gh', 'Gynecology and Obstetrics'),
(26, 'Md Abu Thaher', '765468', 'fgfg', 'fgdfg', 'gdfgj', 'mdabutaher4854@gmail.com', '01625781465', 'library.jpg', '66546', 'ht76 fy45', 'Chest and Asthma');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `contact` varchar(40) NOT NULL,
  `address` varchar(40) NOT NULL,
  `dob` varchar(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `maritial` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `emailOtp` varchar(20) NOT NULL,
  `isEmailVerify` varchar(20) NOT NULL,
  `last_seen` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `email`, `contact`, `address`, `dob`, `gender`, `maritial`, `password`, `emailOtp`, `isEmailVerify`, `last_seen`) VALUES
(61, 'MM', 'Monir', 'mmmonir293@gmail.com', '01997638205', 'Jhenaigati,sherpur', '2024-03-05', 'Male', 'Single', '123456', '549857', '1', NULL),
(63, 'jony', 'jony', 'mmmonir292@gmail.com', '01997638205', 'jhinaigati', '2024-03-05', 'Male', 'Single', '1234567', '354644', '1', NULL),
(64, 'admin', '[value-3]', 'admin@gmail.com', '[value-5]', '[value-6]', '[value-7]', '[value-8]', '[value-9]', '123456', '23456', '1', NULL),
(65, 'tttt', 'ttttt', 'tt@gmail.com', '01987654323', 'fsdfsf', '2020-05-13', 'Female', 'Married', '123456', '277467', '1', '2024-04-01 16:44:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admission_patient`
--
ALTER TABLE `admission_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `all_appointments`
--
ALTER TABLE `all_appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting_info`
--
ALTER TABLE `meeting_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialistlist`
--
ALTER TABLE `specialistlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admission_patient`
--
ALTER TABLE `admission_patient`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `all_appointments`
--
ALTER TABLE `all_appointments`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `conversation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `meeting_info`
--
ALTER TABLE `meeting_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `specialistlist`
--
ALTER TABLE `specialistlist`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
