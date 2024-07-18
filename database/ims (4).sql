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
-- Database: `ims`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `profile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `profile`) VALUES
(1, 'Taher', '12345', 'IMG_8813.JPG'),
(4, 'Abu Taher', '1234', 'received_934904417806999.jpeg'),
(11, 'Cse Jkkniu', 'cse2024', 'jkkniu.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `Id` int(50) NOT NULL,
  `dept_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`Id`, `dept_name`, `username`, `password`) VALUES
(1, 'cse', 'cse', 'csejkkniu'),
(2, 'eee', 'eee', 'eeejkkniu'),
(3, 'ese', 'ese', 'esejkkniu'),
(4, 'statistics', 'statistics', 'stat1234');

-- --------------------------------------------------------

--
-- Table structure for table `improvement_requested`
--

CREATE TABLE `improvement_requested` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `department` varchar(40) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `session` varchar(100) NOT NULL,
  `course_title` varchar(255) DEFAULT NULL,
  `course_code` varchar(50) DEFAULT NULL,
  `credit_hour` varchar(50) DEFAULT NULL,
  `semester` varchar(100) NOT NULL,
  `data_reg` varchar(100) NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `improvement_requested`
--

INSERT INTO `improvement_requested` (`id`, `name`, `username`, `department`, `student_id`, `session`, `course_title`, `course_code`, `credit_hour`, `semester`, `data_reg`, `status`) VALUES
(2, 'REJUAN', 'rejuan', 'cse', '19102004', '2018-19', 'Network', 'cse-321', '3', '', '2024-02-25 22:34:51', 'Approved'),
(3, 'REJUAN', 'rejuan', 'cse', '19102004', '2018-19', 'Microprocessor', 'cse-323', '3', '', '2024-02-25 22:34:51', 'Pending'),
(4, 'REJUAN', 'rejuan', 'cse', '19102004', '2018-19', 'Fundamental', '23', '3', '', '2024-02-25 22:34:51', 'Rejected'),
(7, '', '', 'cse', '', '', 'xcv', 'cxv', 'cx', '', '2024-02-25 22:34:51', 'Rejected'),
(8, 'ANINDITA ACHARJEE', 'ANINDITA', 'cse', '19102008', '2018-19', 'Economics', 'ged-271', '3', '', '2024-02-25 22:34:51', 'Approved'),
(9, 'MD. TOUHIDUL ISLAM RIFAT', 'touhid', 'cse', '19102003', '2018-19', 'Data Strcuture', 'cse-210', '3', '', '2024-02-25 22:34:51', 'Rejected'),
(10, 'MD. TOUHIDUL ISLAM RIFAT', 'touhid', 'eee', '19102003', '2018-19', 'Numerical', 'math-275', '3', '', '2024-02-25 22:34:51', 'Rejected'),
(11, 'MD. ABU THAHER', 'taher', 'eee', '20102006', '2019-20', 'computer network', 'cse-303', '3', '', '2024-02-25 22:34:51', 'Approved'),
(12, 'MD. ABU THAHER', 'taher', 'eee', '20102006', '2019-20', 'Numerical', 'math-275', '3', '1_2', '2024-02-25 23:48:29', 'Pending'),
(13, 'MD. ABU THAHER', 'Taher', '', '20102006', '2019-20', 'CSE', '101', '3', '1_1', '2024-02-26 23:10:45', 'Rejected'),
(14, 'MD. ABU THAHER', 'Taher', 'eee', '20102006', '2019-20', 'CSE', '101', '3', '1_1', '2024-02-26 23:25:57', 'Rejected'),
(15, 'MD. ABU THAHER', 'Taher', '', '20102006', '2019-20', 'nothing', '0000', '0000', '1_1', '2024-02-27 08:30:52', 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `improve_students`
--

CREATE TABLE `improve_students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `department` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `roll_no` varchar(50) DEFAULT NULL,
  `reg_no` varchar(50) NOT NULL,
  `session` varchar(10) NOT NULL,
  `course_code` varchar(100) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `credit_hour` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `improve_students`
--

INSERT INTO `improve_students` (`id`, `name`, `department`, `email`, `semester`, `roll_no`, `reg_no`, `session`, `course_code`, `course_name`, `credit_hour`) VALUES
(4, 'ANINDITA ACHARJEE', '', 'anindita@email.com', '1_1', '19102008', '7727', '2018-19', 'CSE-324', 'computer', '3'),
(5, 'ANINDITA ACHARJEE', '', 'anindita@email.com', '1_2', '19102008', '7727', '2018-19', 'CSE-304', 'Data structure', '3'),
(6, 'ANINDITA ACHARJEE', '', 'anindita@email.com', '2_1', '19102008', '7727', '2018-19', 'cse-205', 'Data structure', '3'),
(7, 'ANINDITA ACHARJEE', '', 'anindita@email.com', '4_1', '19102008', '7727', '2018-19', 'cse-101', 'English', '3'),
(8, 'ANINDITA ACHARJEE', '', 'anindita@email.com', '3_2', '19102008', '7727', '2018-19', 'CSE-304', 'Data structure', '3'),
(9, 'ANINDITA ACHARJEE', '', 'anindita@email.com', '3_2', '19102008', '7727', '2018-19', 'cse-101', 'Compiler', '3'),
(10, 'ANINDITA ACHARJEE', '', 'anindita@email.com', '4_1', '19102008', '7727', '2018-19', 'cse-101', 'Compiler', '1.5'),
(11, 'ANINDITA ACHARJEE', '', 'anindita@email.com', '4_2', '19102008', '7727', '2018-19', 'CSE-304', 'computer', '1.5'),
(13, 'ANINDITA ACHARJEE', '', 'anindita@email.com', '2_1', '19102008', '7727', '2018-19', 'cse-101', 'Physics', '1.5'),
(14, 'ANINDITA ACHARJEE', '', 'anindita@email.com', '2_2', '19102008', '7727', '2018-19', 'cse-101', 'Physics', '1.5'),
(15, 'MD. ARAFAT HOSSAIN', '', 'arafat@email.com', '1_1', '19102037', '7756', '2018-19', 'CSE-304', 'English', '3'),
(16, 'MD. ARAFAT HOSSAIN', '', 'arafat@email.com', '1_2', '19102037', '7756', '2018-19', 'GED-223', 'Compiler', '3'),
(17, 'MD. TOUHIDUL ISLAM RIFAT', '', 'rifat@email.com', '1_1', '19102003', '7722', '2018-19', 'CSE-324', 'Compiler', '3'),
(18, 'MD. TOUHIDUL ISLAM RIFAT', '', 'rifat@email.com', '1_2', '19102003', '7722', '2018-19', 'CSE-324', 'Compiler', '3'),
(19, 'MD. ABU THAHER', '', 'abuthaher@email.com', '1_1', '20102006', '8837', '2019-20', 'CSE-304', 'Computer Network', '3'),
(20, 'MD. ABU THAHER', '', 'abuthaher@email.com', '2_1', '20102006', '8837', '2019-20', 'cse-203', 'Data Structure', '3'),
(21, 'SYED SAFAT HOSSAIN', '', 'safat@email.com', '1_1', '19102035', '7754', '2018-19', 'cse-101', 'English', '3'),
(22, 'SYED SAFAT HOSSAIN', '', 'safat@email.com', '1_1', '19102035', '7754', '2018-19', 'cse-101', 'English', '3'),
(23, 'SYED SAFAT HOSSAIN', '', 'safat@email.com', '3_2', '19102035', '7754', '2018-19', 'cse-205', 'VLSI', '3'),
(24, 'SYED SAFAT HOSSAIN', '', 'safat@email.com', '3_2', '19102035', '7754', '2018-19', 'cse-205', 'VLSI', '3'),
(25, 'SYED SAFAT HOSSAIN', '', 'safat@email.com', '2_2', '19102035', '7754', '2018-19', 'CSE-304', 'VLSI', '3'),
(26, 'SYED SAFAT HOSSAIN', '', 'safat@email.com', '2_2', '19102035', '7754', '2018-19', 'CSE-304', 'VLSI', '3'),
(27, '', '', '', '1_1', '', '', '', 'cse-223', 'Data structure', '3'),
(28, 'Md Abu Taher', '', 'mdabutaher4854@gmail.com', '1_1', 'ttu', 'tu', '2023-24', 'cse-223', 'Data structure', '3'),
(29, '', '', '', '1_1', '', '', '', 'cse-223', 'Data structure', '3'),
(30, '', '', '', '4_1', '', '', '', 'CSE-304', 'Data structure', '3'),
(31, '', '', '', '4_1', '', '', '', 'CSE-304', 'Data structure', '3'),
(32, '', '', '', '3_1', '', '', '', 'CSE-304', 'Data structure', '3'),
(33, '', '', '', '3_1', '', '', '', 'CSE-304', 'Data structure', '3');

-- --------------------------------------------------------

--
-- Table structure for table `imp_form`
--

CREATE TABLE `imp_form` (
  `id` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `student_name_bangla` varchar(255) NOT NULL,
  `student_name_english` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `current_semester` varchar(50) NOT NULL,
  `readmission_semester` varchar(50) DEFAULT NULL,
  `exam_roll` varchar(50) DEFAULT NULL,
  `mobile_number` varchar(20) DEFAULT NULL,
  `course_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`course_details`)),
  `declaration` text NOT NULL,
  `date` date NOT NULL,
  `signature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `imp_form`
--

INSERT INTO `imp_form` (`id`, `department`, `student_name_bangla`, `student_name_english`, `father_name`, `mother_name`, `current_semester`, `readmission_semester`, `exam_roll`, `mobile_number`, `course_details`, `declaration`, `date`, `signature`) VALUES
(1, 'CSE', 'আবু তাহের', 'taher', 'Ramjan Ali', 'Khudeza khatun', '2019-20 & 7', '', '20102006', '', NULL, 'gfhdsfghdfsgh', '2024-04-20', 'taher'),
(6, 'CSE', 'আবু তাহের', 'taher', 'xyz', 'Khudeza khatun', '2019-20 & 7', '', '20102006', '', '[{\"serialNo\":\"1\",\"semester\":\"1\",\"courseNo\":\"eee-373\",\"courseTitle\":\"Data Structure\",\"gradeObtained\":\"3.00\"},{\"serialNo\":\"\",\"semester\":\"\",\"courseNo\":\"\",\"courseTitle\":\"\",\"gradeObtained\":\"\"}]', 'dfdsf', '2024-04-17', 'taher'),
(7, 'CSE', 'আবু তাহের', 'taher', 'xyz', 'Khudeza khatun', '2019-20 & 7', '', '20102006', '', '[{\"serialNo\":\"1\",\"semester\":\"3\",\"courseNo\":\"CSE-300\",\"courseTitle\":\"project\",\"gradeObtained\":\"3.00\"},{\"serialNo\":\"\",\"semester\":\"\",\"courseNo\":\"\",\"courseTitle\":\"\",\"gradeObtained\":\"\"}]', 'this sis my third year proejetc sdjfjsfrf', '2024-04-11', 'taher'),
(8, 'CSE', 'আবু তাহের', 'taher', 'xyz', 'Khudeza khatun', '2019-20 & 7', '', '20102006', '', '[{\"serialNo\":\"1\",\"semester\":\"4\",\"courseNo\":\"CSE-300\",\"courseTitle\":\"project\",\"gradeObtained\":\"3.00\"},{\"serialNo\":\"\",\"semester\":\"\",\"courseNo\":\"\",\"courseTitle\":\"\",\"gradeObtained\":\"\"}]', 'gfhg', '2024-04-17', 'taher'),
(9, 'CSE', 'আবু তাহের', 'taher', 'xyz', 'Khudeza khatun', '2019-20 & 7', '', '20102006', '', '[{\"serialNo\":\"1\",\"semester\":\"7\",\"courseNo\":\"CSE-341\",\"courseTitle\":\"Microprocessor\",\"gradeObtained\":\"2.75\"},{\"serialNo\":\"\",\"semester\":\"\",\"courseNo\":\"\",\"courseTitle\":\"\",\"gradeObtained\":\"\"}]', 'this is microprocessor.', '2024-05-04', 'taher');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `message` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `date_send` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `title`, `message`, `username`, `date_send`) VALUES
(1, 'Send Report', 'Send Report', 'Monir', '2023-11-29 23:41:28'),
(2, 'Send Report', 'Send Report', 'Monir', '2023-11-29 23:42:16'),
(3, 'Fever', 'Fever is increasing..........', 'Monir', '2023-11-29 23:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `st_id` int(11) NOT NULL,
  `marks` int(5) NOT NULL,
  `sub` varchar(50) NOT NULL,
  `credit_hour` varchar(150) NOT NULL,
  `semester` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`id`, `name`, `st_id`, `marks`, `sub`, `credit_hour`, `semester`) VALUES
(1, 'MD. ISMAIL HOSSEN', 19102002, 65, 'DBMS', '3', '1st'),
(2, 'MD. ISMAIL HOSSEN', 19102002, 80, 'Mathematics', '3', '1st'),
(3, 'MD. ISMAIL HOSSEN', 19102002, 60, 'Physics', '3', '1st'),
(4, 'MD. ISMAIL HOSSEN', 19102002, 83, 'Programming Lab', '1.5', '1st'),
(5, 'S.M. MAHMUDUL HASAN LABIB', 19102001, 83, 'DBMS', '3.0', '1st'),
(6, 'S.M. MAHMUDUL HASAN LABIB', 19102001, 76, 'English', '3', '1st'),
(7, 'A.K.M MAHFUZUR RAHMAN', 19102005, 82, 'Programming Lab', '1.5', '1st'),
(8, 'JANNATUL FERDOUS', 20102001, 87, 'English', '3', '2nd'),
(9, 'JANNATUL FERDOUS', 20102001, 110, 'Mathematics', '3', '2nd'),
(10, '', 0, 0, '', '', ''),
(11, '', 0, 0, '', '', ''),
(12, '', 0, 0, '', '', ''),
(13, '', 0, 0, '', '', ''),
(14, '', 0, 0, '', '', ''),
(15, '', 0, 0, '', '', ''),
(16, 'MD. TOUHIDUL ISLAM RIFAT', 19102003, 47, 'DBMS', '1.5', '6th'),
(17, 'S.M. MAHMUDUL HASAN LABIB', 19102001, 65, 'Programming', '3', '4th');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `department` varchar(40) NOT NULL,
  `stud_id` varchar(100) NOT NULL,
  `reg_no` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `data_reg` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `session` varchar(200) NOT NULL,
  `otp` varchar(100) NOT NULL,
  `profile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `username`, `department`, `stud_id`, `reg_no`, `email`, `gender`, `phone`, `password`, `data_reg`, `status`, `session`, `otp`, `profile`) VALUES
(1, 'S.M. MAHMUDUL HASAN LABIB', 'S.M.', 'cse', '19102001', '7720', 'labib@email.com', 'Male', '01488596127', 'password123', '2023-01-01', 'Active', '2018-19', '', 'default.png'),
(2, 'MD. ISMAIL HOSSEN', 'MD.', 'cse', '19102002', '7721', 'ismail@email.com', 'Male', '01927291804', 'password456', '2023-01-02', 'Active', '2018-19', '', 'default.png'),
(3, 'MD. TOUHIDUL ISLAM RIFAT', 'touhid', 'cse', '19102003', '7722', 'rifat@email.com', 'Male', '01670670670', 'password789', '2023-01-03', 'Active', '2018-19', '', 'default.png'),
(4, 'REJUAN', 'REJUAN', 'cse', '19102004', '7723', 'rejuan@email.com', 'Male', '01271477967', 'passwordabc', '2023-01-04', 'Active', '2018-19', '', 'default.png'),
(5, 'A.K.M MAHFUZUR RAHMAN', 'A.K.M.', 'cse', '19102005', '7724', 'mahfuz@email.com', 'Male', '01345377859', 'passwordxyz', '2023-01-05', 'Active', '2018-19', '', 'default.png'),
(6, 'MD. RABIUL ISLAM RABBI', 'MD.', 'cse', '19102006', '7725', 'rabi@email.com', 'Male', '01912455422', 'password123', '2023-01-06', 'Active', '2018-19', '', 'default.png'),
(7, 'MD. SHOMON MIA', 'MD.', 'cse', '19102007', '7726', 'shomon@email.com', 'Male', '01526143567', 'password456', '2023-01-07', 'Active', '2018-19', '', 'default.png'),
(8, 'ANINDITA ACHARJEE', 'ANINDITA', 'cse', '19102008', '7727', 'anindita@email.com', 'Female', '01893351598', 'password789', '2023-01-08', 'Active', '2018-19', '', 'computer.jpg'),
(9, 'ROKHSANA AKTER', 'ROKHSANA', '', '19102009', '7728', 'rokhsana@email.com', 'Female', '01888327321', 'passwordabc', '2023-01-09', 'Active', '2018-19', '', 'default.png'),
(10, 'JOHURA AKTER', 'JOHURA', 'cse', '19102010', '7729', 'johura@email.com', 'Female', '01761581844', 'passwordxyz', '2023-01-10', 'Active', '2018-19', '', 'default.png'),
(11, 'MD. RAYHAN MAHMUD KABIR SANZID', 'MD.', '', '19102011', '7730', 'rayhan@email.com', 'Male', '01142927287', 'password123', '2023-01-11', 'Active', '2018-19', '', 'default.png'),
(12, 'MEHEDI KHAN RAKIB', 'MEHEDI', '', '19102012', '7731', 'mehedi@email.com', 'Male', '01429890933', 'password456', '2023-01-12', 'Active', '2018-19', '', 'default.png'),
(13, 'MD. ASADUL ISLAM', 'MD.', '', '19102013', '7732', 'asadul@email.com', 'Male', '01720672838', 'password789', '2023-01-13', 'Active', '2018-19', '', 'default.png'),
(14, 'MD. RAKIBUL ISLAM', 'MD.', '', '19102014', '7733', 'rakib@email.com', 'Male', '01313691419', 'passwordabc', '2023-01-14', 'Active', '2018-19', '', 'default.png'),
(15, 'MD. TAZUL ISLAM', 'MD.', '', '19102015', '7734', 'tazul@email.com', 'Male', '01406438615', 'passwordxyz', '2023-01-15', 'Active', '2018-19', '', 'default.png'),
(16, 'MD. WALID HOSSEN TAMIM', 'MD.', '', '19102016', '7735', 'walid@email.com', 'Male', '01091118848', 'password123', '2023-01-16', 'Active', '2018-19', '', 'default.png'),
(17, 'MAFIA AKTER', 'MAFIA', '', '19102017', '7736', 'mafia@email.com', 'Female', '01236278428', 'password456', '2023-01-17', 'Active', '2018-19', '', 'default.png'),
(18, 'SAKIB AHAMED SHAHON', 'SAKIB', '', '19102018', '7737', 'sakib@email.com', 'Male', '01908035628', 'password789', '2023-01-18', 'Active', '2018-19', '', 'default.png'),
(19, 'MD. JANNATUL FERDOUSE RAHAT IBNE YOUSUF', 'MD.', '', '19102019', '7738', 'jannat@email.com', 'Female', '01831342886', 'passwordabc', '2023-01-19', 'Active', '2018-19', '', 'default.png'),
(20, 'MD. ABDUL KADER', 'MD.', '', '19102020', '7739', 'abdulkader@email.com', 'Male', '01432607575', 'passwordxyz', '2023-01-20', 'Active', '2018-19', '', 'default.png'),
(21, 'SAYEMA AKTER', 'SAYEMA', '', '19102021', '7740', 'sayema@email.com', 'Female', '01669009251', 'password123', '2023-01-21', 'Active', '2018-19', '', 'default.png'),
(22, 'TAHMINA HAQUE NIRJONA', 'TAHMINA', '', '19102022', '7741', 'nirjona@email.com', 'Female', '01047223559', 'password456', '2023-01-22', 'Active', '2018-19', '', 'default.png'),
(23, 'SAKIB SHAHRIYAR ARNAB', 'SAKIB', '', '19102023', '7742', 'arnab@email.com', 'Male', '01229090075', 'password789', '2023-01-23', 'Active', '2018-19', '', 'default.png'),
(24, 'SOMYA AKTAR SMRITY', 'SOMYA', '', '19102024', '7743', 'somya@email.com', 'Female', '01003779727', 'passwordabc', '2023-01-24', 'Active', '2018-19', '', 'default.png'),
(25, 'MOMOTA AKTER', 'MOMOTA', '', '19102025', '7744', 'momota@email.com', 'Female', '01331628444', 'passwordxyz', '2023-01-25', 'Active', '2018-19', '', 'default.png'),
(26, 'SABRINA SULTANA', 'SABRINA', '', '19102026', '7745', 'sabrina@email.com', 'Female', '01646803071', 'password123', '2023-01-26', 'Active', '2018-19', '', 'default.png'),
(27, 'ROUNOK ISLAM', 'ROUNOK', '', '19102027', '7746', 'rounok@email.com', 'Male', '01239130052', 'password456', '2023-01-27', 'Active', '2018-19', '', 'default.png'),
(28, 'SAJID MEHMUD ANSARI', 'SAJID', '', '19102028', '7747', 'sajid@email.com', 'Male', '01255241081', 'password789', '2023-01-28', 'Active', '2018-19', '', 'default.png'),
(29, 'MD. TAMZIDUL IMAM', 'MD.', '', '19102029', '7748', 'tamzid@email.com', 'Male', '01558815278', 'passwordabc', '2023-01-29', 'Active', '2018-19', '', 'default.png'),
(30, 'ZASMIN NAHAR JUI', 'ZASMIN', '', '19102030', '7749', 'jui@email.com', 'Female', '01028353179', 'passwordxyz', '2023-01-30', 'Active', '2018-19', '', 'default.png'),
(31, 'MD. ABU SAYEM', 'MD.', '', '19102031', '7750', 'abusayem@email.com', 'Male', '01465320093', 'password123', '2023-01-31', 'Active', '2018-19', '', 'default.png'),
(32, 'SMITA MONI ROY SUCHI', 'SMITA', '', '19102032', '7751', 'suchi@email.com', 'Female', '01241540961', 'password456', '2023-02-01', 'Active', '2018-19', '', 'default.png'),
(33, 'RAFIWA NUSRAT MIM', 'RAFIWA', '', '19102033', '7752', 'mim@email.com', 'Female', '01811744554', 'password789', '2023-02-02', 'Active', '2018-19', '', 'default.png'),
(34, 'BINTA ANSARY SHANTONA', 'BINTA', '', '19102034', '7753', 'shantona@email.com', 'Female', '01334099920', 'passwordabc', '2023-02-03', 'Active', '2018-19', '', 'default.png'),
(35, 'SYED SAFAT HOSSAIN', 'SYED', '', '19102035', '7754', 'safat@email.com', 'Male', '01235265970', 'passwordxyz', '2023-02-04', 'Active', '2018-19', '', 'default.png'),
(36, 'SHARIFUL ISLAM', 'SHARIFUL', '', '19102036', '7755', 'shariful@email.com', 'Male', '01174030120', 'password123', '2023-02-05', 'Active', '2018-19', '', 'default.png'),
(37, 'MD. ARAFAT HOSSAIN', 'MD.', '', '19102037', '7756', 'arafat@email.com', 'Male', '01164352722', 'password456', '2023-02-06', 'Active', '2018-19', '', 'default.png'),
(38, 'KAMRON NAHAR', 'KAMRON', '', '19102038', '7757', 'kamron@email.com', 'Female', '01299673281', 'password789', '2023-02-07', 'Active', '2018-19', '', 'default.png'),
(39, 'ARIFUL ISLAM', 'ARIFUL', '', '19102039', '7758', 'ariful@email.com', 'Male', '01005308272', 'passwordabc', '2023-02-08', 'Active', '2018-19', '', 'default.png'),
(40, 'RUDRO ADDITO PANTRA', 'RUDRO', '', '19102040', '7759', 'rudro@email.com', 'Male', '01127521546', 'passwordxyz', '2023-02-09', 'Active', '2018-19', '', 'default.png'),
(41, 'MD. RAKIB-UL-HASAN', 'MD.', '', '19102041', '7760', 'rakibulhasan@email.com', 'Male', '01621682947', 'password123', '2023-02-10', 'Active', '2018-19', '', 'default.png'),
(42, 'MD. ASHIKUR RAHMAN ASHIK', 'MD.', '', '19102042', '7761', 'ashik@email.com', 'Male', '01725850126', 'password456', '2023-02-11', 'Active', '2018-19', '', 'default.png'),
(43, 'JANNAT AKTER', 'JANNAT', '', '19102043', '7762', 'jannat@email.com', 'Female', '01764201821', 'password789', '2023-02-12', 'Active', '2018-19', '', 'default.png'),
(44, 'JANNATUL FERDOUS', 'JANNATUL', '', '20102001', '8832', 'jannatul@email.com', 'Female', '01643458759', 'password123', '2023-01-01', 'Active', '2019-20', '', 'default.png'),
(45, 'SUMAIYA BEGUM', 'SUMAIYA', '', '20102002', '8833', 'sumaiya@email.com', 'Female', '01924688361', 'password456', '2023-01-02', 'Active', '2019-20', '', 'default.png'),
(46, 'ZINNATUN NUR EMI', 'ZINNATUN', '', '20102003', '8834', 'zinnatun@email.com', 'Female', '01693065561', 'password789', '2023-01-03', 'Active', '2019-20', '', 'default.png'),
(47, 'MD. SHAHRIAR EMAN', 'MD.', '', '20102004', '8835', 'shahriar@email.com', 'Male', '01691262751', 'passwordabc', '2023-01-04', 'Active', '2019-20', '', 'default.png'),
(48, 'AFRIDA BIN SHAMS', 'AFRIDA', '', '20102005', '8836', 'afrida@email.com', 'Female', '01377117105', 'passwordxyz', '2023-01-05', 'Active', '2019-20', '', 'default.png'),
(49, 'MD. ABU THAHER', 'Taher', '', '20102006', '8837', 'abuthaher@email.com', 'Male', '01811797302', 'password123', '2023-01-06', 'Active', '2019-20', '', 'IMG_8813.JPG'),
(50, 'SADIA ZAMAN SUPTY', 'SADIA', '', '20102007', '8838', 'sadia@email.com', 'Female', '01927635225', 'password456', '2023-01-07', 'Active', '2019-20', '', 'default.png'),
(51, 'MD. ABED HASAN FAHIM', 'MD.', '', '20102008', '8839', 'abedhasan@email.com', 'Male', '01202784251', 'password789', '2023-01-08', 'Active', '2019-20', '', 'default.png'),
(52, 'JARIN SULTANA SMRITY', 'JARIN', '', '20102009', '8840', 'jarin@email.com', 'Female', '01231015612', 'passwordabc', '2023-01-09', 'Active', '2019-20', '', 'default.png'),
(53, 'SAWVIK KAR DIPTO', 'SAWVIK', '', '20102010', '8841', 'sawvik@email.com', 'Male', '01546725338', 'passwordxyz', '2023-01-10', 'Active', '2019-20', '', 'default.png'),
(54, 'RABIA BASHRI TAMANNNA', 'RABIA', '', '20102011', '8842', 'rabia@email.com', 'Female', '01040579887', 'password123', '2023-01-11', 'Active', '2019-20', '', 'default.png'),
(55, 'TASNIM TAJIN', 'TASNIM', '', '20102012', '8843', 'tasnim@email.com', 'Female', '01562723449', 'password456', '2023-01-12', 'Active', '2019-20', '', 'default.png'),
(56, 'LITON MIAH', 'LITON', '', '20102013', '8844', 'liton@email.com', 'Male', '01691877619', 'password789', '2023-01-13', 'Active', '2019-20', '', 'default.png'),
(57, 'S. M. IRTEJA AHMED', 'S.', '', '20102014', '8845', 'irteja@email.com', 'Male', '01771217776', 'passwordabc', '2023-01-14', 'Active', '2019-20', '', 'default.png'),
(58, 'PAPIA JAHAN UMI', 'PAPIA', '', '20102015', '8846', 'papia@email.com', 'Female', '01780456054', 'passwordxyz', '2023-01-15', 'Active', '2019-20', '', 'default.png'),
(59, 'PARTHA PRATIM BHOWMIK', 'PARTHA', '', '20102016', '8847', 'partha@email.com', 'Male', '01588626975', 'password123', '2023-01-16', 'Active', '2019-20', '', 'default.png'),
(60, 'SURAIYA AKTER', 'SURAIYA', '', '20102017', '8848', 'suraiya@email.com', 'Female', '01601766745', 'password456', '2023-01-17', 'Active', '2019-20', '', 'default.png'),
(61, 'FARAH BINTE SHAMEEM', 'FARAH', '', '20102018', '8849', 'farah@email.com', 'Female', '01242952829', 'password789', '2023-01-18', 'Active', '2019-20', '', 'default.png'),
(62, 'TAHERA AKHTER', 'TAHERA', '', '20102019', '8850', 'tahera@email.com', 'Female', '01409463942', 'passwordabc', '2023-01-19', 'Active', '2019-20', '', 'default.png'),
(63, 'KAMRUL HASAN', 'KAMRUL', '', '20102020', '8851', 'kamrul@email.com', 'Male', '01318461254', 'passwordxyz', '2023-01-20', 'Active', '2019-20', '', 'default.png'),
(64, 'TAMANNA', 'TAMANNA', '', '20102021', '8852', 'tamanna@email.com', 'Female', '01363914476', 'password123', '2023-01-21', 'Active', '2019-20', '', 'default.png'),
(65, 'MST. SADIA AKTER', 'MST.', '', '20102022', '8853', 'sadiaakter@email.com', 'Female', '01864188647', 'password456', '2023-01-22', 'Active', '2019-20', '', 'default.png'),
(66, 'SADIA AFRIN', 'SADIA', '', '20102023', '8854', 'sadiaafrin@email.com', 'Female', '01229199840', 'password789', '2023-01-23', 'Active', '2019-20', '', 'default.png'),
(67, 'MD. MONIRUZZAMAN MONIR', 'MD.', '', '20102024', '8855', 'monir@email.com', 'Male', '01553433292', 'passwordabc', '2023-01-24', 'Active', '2019-20', '', 'default.png'),
(68, 'TAHMINA AKTER', 'TAHMINA', '', '20102025', '8856', 'tahmina@email.com', 'Female', '01079566968', 'passwordxyz', '2023-01-25', 'Active', '2019-20', '', 'default.png'),
(69, 'MARZIA SULTANA JOUTI', 'MARZIA', '', '20102026', '8857', 'marzia@email.com', 'Female', '01737534997', 'password123', '2023-01-26', 'Active', '2019-20', '', 'default.png'),
(70, 'SONIA AKTER', 'SONIA', '', '20102027', '8858', 'sonia@email.com', 'Female', '01448974113', 'password456', '2023-01-27', 'Active', '2019-20', '', 'default.png'),
(71, 'SHARMIN JAHAN', 'SHARMIN', '', '20102028', '8859', 'sharmin@email.com', 'Female', '01032265604', 'password789', '2023-01-28', 'Active', '2019-20', '', 'default.png'),
(72, 'YOUSUF ABDULLAH FAHIM', 'YOUSUF', '', '20102029', '8860', 'yousuf@email.com', 'Male', '01814405713', 'passwordabc', '2023-01-29', 'Active', '2019-20', '', 'default.png'),
(73, 'NARGIA EASMIN NOOR', 'NARGIA', '', '20102030', '8861', 'nargia@email.com', 'Female', '01975231782', 'passwordxyz', '2023-01-30', 'Active', '2019-20', '', 'default.png'),
(74, 'LAILA AFROZ TINNI', 'LAILA', '', '20102031', '8862', 'laila@email.com', 'Female', '01432941804', 'password123', '2023-01-31', 'Active', '2019-20', '', 'default.png'),
(75, 'MD. AL-IMRAN', 'MD.', '', '20102032', '8863', 'alimran@email.com', 'Male', '01239013703', 'password456', '2023-02-01', 'Active', '2019-20', '', 'default.png'),
(76, 'ARPA PAUL', 'ARPA', '', '20102033', '8864', 'arpa@email.com', 'Female', '01896243137', 'password789', '2023-02-02', 'Active', '2019-20', '', 'default.png'),
(77, 'RUBINA AKTAR', 'RUBINA', '', '20102034', '8865', 'rubina@email.com', 'Female', '01764174605', 'passwordabc', '2023-02-03', 'Active', '2019-20', '', 'default.png'),
(78, 'FARJANA AKTER MIM', 'FARJANA', '', '20102035', '8866', 'farjana@email.com', 'Female', '01132143646', 'passwordxyz', '2023-02-04', 'Active', '2019-20', '', 'default.png'),
(79, 'TALUKDER OMAR FARUK', 'TALUKDER', '', '20102036', '8867', 'omar@email.com', 'Male', '01368194447', 'password123', '2023-02-05', 'Active', '2019-20', '', 'default.png'),
(80, 'RAKIBUN NABI', 'RAKIBUN', '', '20102037', '8868', 'rakibun@email.com', 'Male', '01444541327', 'password456', '2023-02-06', 'Active', '2019-20', '', 'default.png'),
(81, 'MD. AHASAN ULLAH', 'MD.', '', '20102038', '8869', 'ahasan@email.com', 'Male', '01118123324', 'password789', '2023-02-07', 'Active', '2019-20', '', 'default.png'),
(82, 'MD. TAJUL ISLAM', 'MD.', '', '20102039', '8870', 'tajul@email.com', 'Male', '01256992672', 'passwordabc', '2023-02-08', 'Active', '2019-20', '', 'default.png'),
(83, 'MIKHA GANDAL', 'MIKHA', '', '20102040', '8871', 'mikha@email.com', 'Male', '01930593420', 'passwordxyz', '2023-02-09', 'Active', '2019-20', '', 'default.png'),
(84, 'MARSHIA MINHAJ MOHANA', 'MARSHIA', '', '20102041', '8872', 'marshia@email.com', 'Female', '01881989115', 'password123', '2023-02-10', 'Active', '2019-20', '', 'default.png'),
(85, 'MST. TAKRIMA AKTER TONNI', 'MST.', '', '20102042', '8873', 'tonni@email.com', 'Female', '01618165347', 'password123', '2023-01-01', 'Active', '2019-20', '', 'default.png'),
(86, 'MD. FAZLE RABBI RIZON', 'MD.', '', '20102043', '8874', 'rizon@email.com', 'Male', '01444859420', 'password456', '2023-01-02', 'Active', '2019-20', '', 'default.png'),
(87, 'MST. MURSHIDA AKTER JIM', 'MST.', '', '20102044', '8875', 'jim@email.com', 'Female', '01369801090', 'password789', '2023-01-03', 'Active', '2019-20', '', 'default.png'),
(88, 'FARHANA MAHBUBA', 'FARHANA', '', '20102045', '8876', 'farhana@email.com', 'Female', '01514427221', 'passwordabc', '2023-01-04', 'Active', '2019-20', '', 'default.png'),
(89, 'Farzana Afroj', 'Farzana', '', '21102001', '9868', 'farzana@email.com', 'Female', '01462732868', 'password123', '2023-01-01', 'Active', '2020-21', '', 'default.png'),
(90, 'Lamia Akter Monni', 'Lamia', '', '21102002', '9869', 'lamia@email.com', 'Female', '01770382708', 'password456', '2023-01-02', 'Active', '2020-21', '', 'default.png'),
(91, 'Asraful Alam', 'Asraful', '', '21102003', '9870', 'asraful@email.com', 'Male', '01463714967', 'password789', '2023-01-03', 'Active', '2020-21', '', 'default.png'),
(92, 'Zinnia Tasnim Rifat', 'Zinnia', '', '21102004', '9871', 'zinnia@email.com', 'Female', '01007426744', 'passwordabc', '2023-01-04', 'Active', '2020-21', '', 'default.png'),
(93, 'K.M. Shukateb Mehbub Saikat', 'K.M.', '', '21102005', '9872', 'shukateb@email.com', 'Male', '01645988848', 'passwordxyz', '2023-01-05', 'Active', '2020-21', '', 'default.png'),
(94, 'Umme Jami', 'Umme', '', '21102006', '9873', 'umme@email.com', 'Female', '01207664041', 'password123', '2023-01-06', 'Active', '2020-21', '', 'default.png'),
(95, 'Nabeel Ahsan', 'Nabeel', '', '21102007', '9874', 'nabeel@email.com', 'Male', '01100353689', 'password456', '2023-01-07', 'Active', '2020-21', '', 'default.png'),
(96, 'Abul Bashar Abir', 'Abul', '', '21102008', '9875', 'abul@email.com', 'Male', '01878776357', 'password789', '2023-01-08', 'Active', '2020-21', '', 'default.png'),
(97, 'Md. Taiyeb Reza', 'Md.', '', '21102009', '9876', 'taiyeb@email.com', 'Male', '01092820747', 'passwordabc', '2023-01-09', 'Active', '2020-21', '', 'default.png'),
(98, 'Odity Dey', 'Odity', '', '21102010', '9877', 'odity@email.com', 'Female', '01827774697', 'passwordxyz', '2023-01-10', 'Active', '2020-21', '', 'default.png'),
(99, 'Salman Sadick Ucchas', 'Salman', '', '21102011', '9878', 'salman@email.com', 'Male', '01860411275', 'password123', '2023-01-11', 'Active', '2020-21', '', 'default.png'),
(100, 'Md. Mehedi Hasan Shagor', 'Md.', '', '21102012', '9879', 'mehedi@email.com', 'Male', '01818732317', 'password456', '2023-01-12', 'Active', '2020-21', '', 'default.png'),
(101, 'Md. Fayjur Rafi', 'Md.', '', '21102013', '9880', 'rafi@email.com', 'Male', '01512427789', 'password789', '2023-01-13', 'Active', '2020-21', '', 'default.png'),
(102, 'Samiha Kabir Sigma', 'Samiha', '', '21102014', '9881', 'samiha@email.com', 'Female', '01105942026', 'passwordabc', '2023-01-14', 'Active', '2020-21', '', 'default.png'),
(103, 'Md. Mehedi Hasan', 'Md.', '', '21102015', '9882', 'mehedi2@email.com', 'Male', '01992426795', 'passwordxyz', '2023-01-15', 'Active', '2020-21', '', 'default.png'),
(104, 'Asif Hasan', 'Asif', '', '21102016', '9883', 'asif@email.com', 'Male', '01644307929', 'password123', '2023-01-16', 'Active', '2020-21', '', 'default.png'),
(105, 'Syed Fahad Mahmud', 'Syed', '', '21102017', '9884', 'fahad@email.com', 'Male', '01244259291', 'password456', '2023-01-17', 'Active', '2020-21', '', 'default.png'),
(106, 'Rafayatul Ashraf', 'Rafayatul', '', '21102018', '9885', 'rafayatul@email.com', 'Male', '01288372699', 'password789', '2023-01-18', 'Active', '2020-21', '', 'default.png'),
(107, 'Nur Shaan Wafi', 'Nur', '', '21102019', '9886', 'wafi@email.com', 'Male', '01709085653', 'passwordabc', '2023-01-19', 'Active', '2020-21', '', 'default.png'),
(108, 'Sanjida Sultana', 'Sanjida', '', '21102020', '9887', 'sanjida@email.com', 'Female', '01680310198', 'passwordxyz', '2023-01-20', 'Active', '2020-21', '', 'default.png'),
(109, 'Md. Tuhin Molla', 'Md.', '', '21102021', '9888', 'tuhin@email.com', 'Male', '01274294064', 'password123', '2023-01-21', 'Active', '2020-21', '', 'default.png'),
(110, 'Tarmim', 'Tarmim', '', '21102022', '9889', 'tarmim@email.com', 'Male', '01330539757', 'password456', '2023-01-22', 'Active', '2020-21', '', 'default.png'),
(111, 'Tamjid Hossen', 'Tamjid', '', '21102023', '9890', 'tamjid@email.com', 'Male', '01829816625', 'password789', '2023-01-23', 'Active', '2020-21', '', 'default.png'),
(112, 'Md. Noornabi', 'Md.', '', '21102024', '9891', 'noornabi@email.com', 'Male', '01157463884', 'passwordabc', '2023-01-24', 'Active', '2020-21', '', 'default.png'),
(113, 'Easir Arafat', 'Easir', '', '21102025', '9892', 'easir@email.com', 'Male', '01297869575', 'passwordxyz', '2023-01-25', 'Active', '2020-21', '', 'default.png'),
(114, 'Ashari Binte Ashraf', 'Ashari', '', '21102026', '9893', 'ashari@email.com', 'Female', '01016956255', 'password123', '2023-01-26', 'Active', '2020-21', '', 'default.png'),
(115, 'Ahammad Tausif Mayeen', 'Ahammad', '', '21102027', '9894', 'tausif@email.com', 'Male', '01191172583', 'password456', '2023-01-27', 'Active', '2020-21', '', 'default.png'),
(116, 'Naeem Hasan Shorol', 'Naeem', '', '21102028', '9895', 'naeem@email.com', 'Male', '01904994179', 'password789', '2023-01-28', 'Active', '2020-21', '', 'default.png'),
(117, 'Ifroem Rema', 'Ifroem', '', '21102029', '9896', 'ifroem@email.com', 'Female', '01951453178', 'passwordabc', '2023-01-29', 'Active', '2020-21', '', 'default.png'),
(118, 'Spondon Rema', 'Spondon', '', '21102030', '9897', 'spondon@email.com', 'Male', '01042283383', 'passwordxyz', '2023-01-30', 'Active', '2020-21', '', 'default.png'),
(119, 'Mobasshirah Mridula', 'Mobasshirah', '', '21102031', '9898', 'mridula@email.com', 'Female', '01357057412', 'password123', '2023-01-31', 'Active', '2020-21', '', 'default.png'),
(120, 'Arman Mia', 'Arman', '', '21102032', '9899', 'arman@email.com', 'Male', '01658436943', 'password456', '2023-02-01', 'Active', '2020-21', '', 'default.png'),
(121, 'Md. Mehedi Hasan', 'Md.', '', '21102033', '9900', 'mehedi3@email.com', 'Male', '01221012510', 'password789', '2023-02-02', 'Active', '2020-21', '', 'default.png'),
(122, 'Md Perbej Bhuiyan Akib', 'Md.', '', '21102034', '9901', 'akib@email.com', 'Male', '01129751753', 'passwordabc', '2023-02-03', 'Active', '2020-21', '', 'default.png'),
(123, 'Avishek Sarkar', 'Avishek', '', '21102035', '9902', 'avishek@email.com', 'Male', '01985721264', 'passwordxyz', '2023-02-04', 'Active', '2020-21', '', 'default.png'),
(124, 'Md. Al Nur Antor', 'Md.', '', '21102036', '9903', 'antor@email.com', 'Male', '01539351095', 'password123', '2023-02-05', 'Active', '2020-21', '', 'default.png'),
(125, 'Emran', 'Emran', '', '21102037', '9904', 'emran@email.com', 'Male', '01739591715', 'password456', '2023-02-06', 'Active', '2020-21', '', 'default.png'),
(126, 'Syed Jahin Jarif', 'Syed', '', '21102038', '9905', 'jahin@email.com', 'Male', '01079905320', 'password789', '2023-02-07', 'Active', '2020-21', '', 'default.png'),
(127, 'Ashiful Alam Sharif', 'Ashiful', '', '21102039', '9906', 'ashiful@email.com', 'Male', '01180751488', 'passwordabc', '2023-02-08', 'Active', '2020-21', '', 'default.png'),
(128, 'Md. Raful Mia', 'Md.', '', '21102040', '9907', 'raful@email.com', 'Male', '01664041511', 'passwordxyz', '2023-02-09', 'Active', '2020-21', '', 'default.png'),
(129, 'Md. Saif Uddin Chowdhury Tamim', 'Md.', '', '21102041', '9908', 'tamim@email.com', 'Male', '01777953121', 'password123', '2023-02-10', 'Active', '2020-21', '', 'default.png'),
(130, 'Prantic Paul', 'Prantic', '', '21102042', '9909', 'prantic@email.com', 'Male', '01897641104', 'password456', '2023-02-11', 'Active', '2020-21', '', 'default.png'),
(149, 'suraiya', 'suraiya', 'eee', '20102017', '8845', 'suraiyacse@gmail.com', 'Male', '+8801645787748', 'Taher@06', '2024-02-25 20:36:55', 'Active', '2019-20', '720364', 'ha ha.jpg'),
(150, 'Md Abu Taher', 'taher', 'eee', 'ttu', 'tu', 'mdabutaher4854@gmail.com', 'male', '01930234234', '1234', '2024-04-02', 'active', '2023-24', '', 'mailto.jpg'),
(151, 'e', 'e', '', 'e', 'e', 'mmmonir293@gmail.com', 'Male', '01645787748', '1234', '2024-04-08 00:53:22', 'inactive', 'e', '248815', 'mailto.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `improvement_requested`
--
ALTER TABLE `improvement_requested`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `improve_students`
--
ALTER TABLE `improve_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imp_form`
--
ALTER TABLE `imp_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `improvement_requested`
--
ALTER TABLE `improvement_requested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `improve_students`
--
ALTER TABLE `improve_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `imp_form`
--
ALTER TABLE `imp_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
