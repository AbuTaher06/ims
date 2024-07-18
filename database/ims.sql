-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2024 at 07:39 PM
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
(1, 'Taher', '1234', 'jkkniu.png'),
(2, 'Jannat', '1234', 'received_934904417806999.jpg'),
(4, 'Abu Taher', '1234', 'received_934904417806999.jpeg'),
(6, 'sawvik', '2010', 'kobutor.jpg'),
(7, 'Amdad', 'amdad', 'amdad.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `salary` varchar(200) NOT NULL,
  `data_reg` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `profile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `firstname`, `username`, `email`, `gender`, `phone`, `country`, `password`, `salary`, `data_reg`, `status`, `profile`) VALUES
(2, 'Md Abu Taher', 'Taher', 'abc@gmail.com', 'Male', '019245636', 'Bangladesh', 'new', '50000', '2023-11-25 00:57:45', 'Aproved', 'love.jpg'),
(3, 'Jannatul Ferdous', 'Taher', 'jannat@gmail.com', 'Female', '01831231', 'Bangladesh', 'jannat21', '0', '2023-11-26 23:47:08', 'Rejected', 'doctor.jpg'),
(4, 'Jannatul', 'Jannatul Ferdous', 'jannat@gmail.com', 'Female', '01932423235', 'Bangladesh', 'jannat', '0', '2023-11-30 00:10:06', 'Rejected', 'doctor.jpeg'),
(5, 'x', 'y', 'abc@gmail.com', '', '', '', '12', '3', '', 'Rejected', 'sdsd.png');

-- --------------------------------------------------------

--
-- Table structure for table `improve_students`
--

CREATE TABLE `improve_students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
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

INSERT INTO `improve_students` (`id`, `name`, `email`, `semester`, `roll_no`, `reg_no`, `session`, `course_code`, `course_name`, `credit_hour`) VALUES
(1, 'MD. MONIRUZZAMAN MONIR', 'monir@email.com', '3_2', '20102024', '8855', '2019-20', 'CSE-304', 'computer', '3'),
(3, 'MD. MONIRUZZAMAN MONIR', 'monir@email.com', '3_2', '20102024', '8855', '2019-20', 'CSE-324', 'Physics', '3');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `id` int(11) NOT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `patient` varchar(255) DEFAULT NULL,
  `date_discharge` date DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(15, '', 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `stud_id` varchar(100) NOT NULL,
  `reg_no` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `data_reg` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL,
  `session` varchar(200) NOT NULL,
  `profile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `username`, `stud_id`, `reg_no`, `email`, `gender`, `phone`, `password`, `data_reg`, `status`, `session`, `profile`) VALUES
(1, 'S.M. MAHMUDUL HASAN LABIB', 'S.M.', '19102001', '7720', 'labib@email.com', 'Male', '123456789', 'password123', '2023-01-01', 'Active', '2018-19', 'Engineering'),
(2, 'MD. ISMAIL HOSSEN', 'MD.', '19102002', '7721', 'ismail@email.com', 'Male', '987654321', 'password456', '2023-01-02', 'Active', '2018-19', 'Medicine'),
(3, 'MD. TOUHIDUL ISLAM RIFAT', 'MD.', '19102003', '7722', 'rifat@email.com', 'Male', '555555555', 'password789', '2023-01-03', 'Active', '2018-19', 'Computer Science'),
(4, 'REJUAN', 'REJUAN', '19102004', '7723', 'rejuan@email.com', 'Male', '666666666', 'passwordabc', '2023-01-04', 'Active', '2018-19', 'Physics'),
(5, 'A.K.M MAHFUZUR RAHMAN', 'A.K.M.', '19102005', '7724', 'mahfuz@email.com', 'Male', '777777777', 'passwordxyz', '2023-01-05', 'Active', '2018-19', 'Mathematics'),
(6, 'MD. RABIUL ISLAM RABBI', 'MD.', '19102006', '7725', 'rabi@email.com', 'Male', '888888888', 'password123', '2023-01-06', 'Active', '2018-19', 'Chemistry'),
(7, 'MD. SHOMON MIA', 'MD.', '19102007', '7726', 'shomon@email.com', 'Male', '999999999', 'password456', '2023-01-07', 'Active', '2018-19', 'Biology'),
(8, 'ANINDITA ACHARJEE', 'ANINDITA', '19102008', '7727', 'anindita@email.com', 'Female', '111111111', 'password789', '2023-01-08', 'Active', '2018-19', 'Literature'),
(9, 'ROKHSANA AKTER', 'ROKHSANA', '19102009', '7728', 'rokhsana@email.com', 'Female', '222222222', 'passwordabc', '2023-01-09', 'Active', '2018-19', 'History'),
(10, 'JOHURA AKTER', 'JOHURA', '19102010', '7729', 'johura@email.com', 'Female', '333333333', 'passwordxyz', '2023-01-10', 'Active', '2018-19', 'Psychology'),
(11, 'MD. RAYHAN MAHMUD KABIR SANZID', 'MD.', '19102011', '7730', 'rayhan@email.com', 'Male', '444444444', 'password123', '2023-01-11', 'Active', '2018-19', 'Sociology'),
(12, 'MEHEDI KHAN RAKIB', 'MEHEDI', '19102012', '7731', 'mehedi@email.com', 'Male', '555555555', 'password456', '2023-01-12', 'Active', '2018-19', 'Political Science'),
(13, 'MD. ASADUL ISLAM', 'MD.', '19102013', '7732', 'asadul@email.com', 'Male', '666666666', 'password789', '2023-01-13', 'Active', '2018-19', 'Economics'),
(14, 'MD. RAKIBUL ISLAM', 'MD.', '19102014', '7733', 'rakib@email.com', 'Male', '777777777', 'passwordabc', '2023-01-14', 'Active', '2018-19', 'Philosophy'),
(15, 'MD. TAZUL ISLAM', 'MD.', '19102015', '7734', 'tazul@email.com', 'Male', '888888888', 'passwordxyz', '2023-01-15', 'Active', '2018-19', 'Geography'),
(16, 'MD. WALID HOSSEN TAMIM', 'MD.', '19102016', '7735', 'walid@email.com', 'Male', '999999999', 'password123', '2023-01-16', 'Active', '2018-19', 'Environmental Science'),
(17, 'MAFIA AKTER', 'MAFIA', '19102017', '7736', 'mafia@email.com', 'Female', '111111111', 'password456', '2023-01-17', 'Active', '2018-19', 'Physics'),
(18, 'SAKIB AHAMED SHAHON', 'SAKIB', '19102018', '7737', 'sakib@email.com', 'Male', '222222222', 'password789', '2023-01-18', 'Active', '2018-19', 'Chemistry'),
(19, 'MD. JANNATUL FERDOUSE RAHAT IBNE YOUSUF', 'MD.', '19102019', '7738', 'jannat@email.com', 'Female', '333333333', 'passwordabc', '2023-01-19', 'Active', '2018-19', 'Biology'),
(20, 'MD. ABDUL KADER', 'MD.', '19102020', '7739', 'abdulkader@email.com', 'Male', '444444444', 'passwordxyz', '2023-01-20', 'Active', '2018-19', 'Mathematics'),
(21, 'SAYEMA AKTER', 'SAYEMA', '19102021', '7740', 'sayema@email.com', 'Female', '555555555', 'password123', '2023-01-21', 'Active', '2018-19', 'Computer Science'),
(22, 'TAHMINA HAQUE NIRJONA', 'TAHMINA', '19102022', '7741', 'nirjona@email.com', 'Female', '666666666', 'password456', '2023-01-22', 'Active', '2018-19', 'Medicine'),
(23, 'SAKIB SHAHRIYAR ARNAB', 'SAKIB', '19102023', '7742', 'arnab@email.com', 'Male', '777777777', 'password789', '2023-01-23', 'Active', '2018-19', 'Engineering'),
(24, 'SOMYA AKTAR SMRITY', 'SOMYA', '19102024', '7743', 'somya@email.com', 'Female', '888888888', 'passwordabc', '2023-01-24', 'Active', '2018-19', 'Physics'),
(25, 'MOMOTA AKTER', 'MOMOTA', '19102025', '7744', 'momota@email.com', 'Female', '999999999', 'passwordxyz', '2023-01-25', 'Active', '2018-19', 'Mathematics'),
(26, 'SABRINA SULTANA', 'SABRINA', '19102026', '7745', 'sabrina@email.com', 'Female', '111111111', 'password123', '2023-01-26', 'Active', '2018-19', 'Chemistry'),
(27, 'ROUNOK ISLAM', 'ROUNOK', '19102027', '7746', 'rounok@email.com', 'Male', '222222222', 'password456', '2023-01-27', 'Active', '2018-19', 'Biology'),
(28, 'SAJID MEHMUD ANSARI', 'SAJID', '19102028', '7747', 'sajid@email.com', 'Male', '333333333', 'password789', '2023-01-28', 'Active', '2018-19', 'Computer Science'),
(29, 'MD. TAMZIDUL IMAM', 'MD.', '19102029', '7748', 'tamzid@email.com', 'Male', '444444444', 'passwordabc', '2023-01-29', 'Active', '2018-19', 'Medicine'),
(30, 'ZASMIN NAHAR JUI', 'ZASMIN', '19102030', '7749', 'jui@email.com', 'Female', '555555555', 'passwordxyz', '2023-01-30', 'Active', '2018-19', 'Engineering'),
(31, 'MD. ABU SAYEM', 'MD.', '19102031', '7750', 'abusayem@email.com', 'Male', '666666666', 'password123', '2023-01-31', 'Active', '2018-19', 'Physics'),
(32, 'SMITA MONI ROY SUCHI', 'SMITA', '19102032', '7751', 'suchi@email.com', 'Female', '777777777', 'password456', '2023-02-01', 'Active', '2018-19', 'Mathematics'),
(33, 'RAFIWA NUSRAT MIM', 'RAFIWA', '19102033', '7752', 'mim@email.com', 'Female', '888888888', 'password789', '2023-02-02', 'Active', '2018-19', 'Chemistry'),
(34, 'BINTA ANSARY SHANTONA', 'BINTA', '19102034', '7753', 'shantona@email.com', 'Female', '999999999', 'passwordabc', '2023-02-03', 'Active', '2018-19', 'Biology'),
(35, 'SYED SAFAT HOSSAIN', 'SYED', '19102035', '7754', 'safat@email.com', 'Male', '111111111', 'passwordxyz', '2023-02-04', 'Active', '2018-19', 'Computer Science'),
(36, 'SHARIFUL ISLAM', 'SHARIFUL', '19102036', '7755', 'shariful@email.com', 'Male', '222222222', 'password123', '2023-02-05', 'Active', '2018-19', 'Medicine'),
(37, 'MD. ARAFAT HOSSAIN', 'MD.', '19102037', '7756', 'arafat@email.com', 'Male', '333333333', 'password456', '2023-02-06', 'Active', '2018-19', 'Engineering'),
(38, 'KAMRON NAHAR', 'KAMRON', '19102038', '7757', 'kamron@email.com', 'Female', '444444444', 'password789', '2023-02-07', 'Active', '2018-19', 'Physics'),
(39, 'ARIFUL ISLAM', 'ARIFUL', '19102039', '7758', 'ariful@email.com', 'Male', '555555555', 'passwordabc', '2023-02-08', 'Active', '2018-19', 'Chemistry'),
(40, 'RUDRO ADDITO PANTRA', 'RUDRO', '19102040', '7759', 'rudro@email.com', 'Male', '666666666', 'passwordxyz', '2023-02-09', 'Active', '2018-19', 'Biology'),
(41, 'MD. RAKIB-UL-HASAN', 'MD.', '19102041', '7760', 'rakibulhasan@email.com', 'Male', '777777777', 'password123', '2023-02-10', 'Active', '2018-19', 'Computer Science'),
(42, 'MD. ASHIKUR RAHMAN ASHIK', 'MD.', '19102042', '7761', 'ashik@email.com', 'Male', '888888888', 'password456', '2023-02-11', 'Active', '2018-19', 'Medicine'),
(43, 'JANNAT AKTER', 'JANNAT', '19102043', '7762', 'jannat@email.com', 'Female', '999999999', 'password789', '2023-02-12', 'Active', '2018-19', 'Engineering'),
(44, 'JANNATUL FERDOUS', 'JANNATUL', '20102001', '8832', 'jannatul@email.com', 'Female', '123456789', 'password123', '2023-01-01', 'Active', '2019-20', 'Engineering'),
(45, 'SUMAIYA BEGUM', 'SUMAIYA', '20102002', '8833', 'sumaiya@email.com', 'Female', '987654321', 'password456', '2023-01-02', 'Active', '2019-20', 'Medicine'),
(46, 'ZINNATUN NUR EMI', 'ZINNATUN', '20102003', '8834', 'zinnatun@email.com', 'Female', '555555555', 'password789', '2023-01-03', 'Active', '2019-20', 'Computer Science'),
(47, 'MD. SHAHRIAR EMAN', 'MD.', '20102004', '8835', 'shahriar@email.com', 'Male', '666666666', 'passwordabc', '2023-01-04', 'Active', '2019-20', 'Physics'),
(48, 'AFRIDA BIN SHAMS', 'AFRIDA', '20102005', '8836', 'afrida@email.com', 'Female', '777777777', 'passwordxyz', '2023-01-05', 'Active', '2019-20', 'Mathematics'),
(49, 'MD. ABU THAHER', 'Taher', '20102006', '8837', 'abuthaher@email.com', 'Male', '888888888', 'password123', '2023-01-06', 'Active', '2019-20', 'formal.jpg'),
(50, 'SADIA ZAMAN SUPTY', 'SADIA', '20102007', '8838', 'sadia@email.com', 'Female', '999999999', 'password456', '2023-01-07', 'Active', '2019-20', 'Biology'),
(51, 'MD. ABED HASAN FAHIM', 'MD.', '20102008', '8839', 'abedhasan@email.com', 'Male', '111111111', 'password789', '2023-01-08', 'Active', '2019-20', 'Literature'),
(52, 'JARIN SULTANA SMRITY', 'JARIN', '20102009', '8840', 'jarin@email.com', 'Female', '222222222', 'passwordabc', '2023-01-09', 'Active', '2019-20', 'History'),
(53, 'SAWVIK KAR DIPTO', 'SAWVIK', '20102010', '8841', 'sawvik@email.com', 'Male', '333333333', 'passwordxyz', '2023-01-10', 'Active', '2019-20', 'Psychology'),
(54, 'RABIA BASHRI TAMANNNA', 'RABIA', '20102011', '8842', 'rabia@email.com', 'Female', '444444444', 'password123', '2023-01-11', 'Active', '2019-20', 'Sociology'),
(55, 'TASNIM TAJIN', 'TASNIM', '20102012', '8843', 'tasnim@email.com', 'Female', '555555555', 'password456', '2023-01-12', 'Active', '2019-20', 'Political Science'),
(56, 'LITON MIAH', 'LITON', '20102013', '8844', 'liton@email.com', 'Male', '666666666', 'password789', '2023-01-13', 'Active', '2019-20', 'Economics'),
(57, 'S. M. IRTEJA AHMED', 'S.', '20102014', '8845', 'irteja@email.com', 'Male', '777777777', 'passwordabc', '2023-01-14', 'Active', '2019-20', 'Philosophy'),
(58, 'PAPIA JAHAN UMI', 'PAPIA', '20102015', '8846', 'papia@email.com', 'Female', '888888888', 'passwordxyz', '2023-01-15', 'Active', '2019-20', 'Geography'),
(59, 'PARTHA PRATIM BHOWMIK', 'PARTHA', '20102016', '8847', 'partha@email.com', 'Male', '999999999', 'password123', '2023-01-16', 'Active', '2019-20', 'Environmental Science'),
(60, 'SURAIYA AKTER', 'SURAIYA', '20102017', '8848', 'suraiya@email.com', 'Female', '111111111', 'password456', '2023-01-17', 'Active', '2019-20', 'Physics'),
(61, 'FARAH BINTE SHAMEEM', 'FARAH', '20102018', '8849', 'farah@email.com', 'Female', '222222222', 'password789', '2023-01-18', 'Active', '2019-20', 'Chemistry'),
(62, 'TAHERA AKHTER', 'TAHERA', '20102019', '8850', 'tahera@email.com', 'Female', '333333333', 'passwordabc', '2023-01-19', 'Active', '2019-20', 'Biology'),
(63, 'KAMRUL HASAN', 'KAMRUL', '20102020', '8851', 'kamrul@email.com', 'Male', '444444444', 'passwordxyz', '2023-01-20', 'Active', '2019-20', 'Mathematics'),
(64, 'TAMANNA', 'TAMANNA', '20102021', '8852', 'tamanna@email.com', 'Female', '555555555', 'password123', '2023-01-21', 'Active', '2019-20', 'Computer Science'),
(65, 'MST. SADIA AKTER', 'MST.', '20102022', '8853', 'sadiaakter@email.com', 'Female', '666666666', 'password456', '2023-01-22', 'Active', '2019-20', 'Engineering'),
(66, 'SADIA AFRIN', 'SADIA', '20102023', '8854', 'sadiaafrin@email.com', 'Female', '777777777', 'password789', '2023-01-23', 'Active', '2019-20', 'History'),
(67, 'MD. MONIRUZZAMAN MONIR', 'MD.', '20102024', '8855', 'monir@email.com', 'Male', '888888888', 'passwordabc', '2023-01-24', 'Active', '2019-20', 'Psychology'),
(68, 'TAHMINA AKTER', 'TAHMINA', '20102025', '8856', 'tahmina@email.com', 'Female', '999999999', 'passwordxyz', '2023-01-25', 'Active', '2019-20', 'Sociology'),
(69, 'MARZIA SULTANA JOUTI', 'MARZIA', '20102026', '8857', 'marzia@email.com', 'Female', '111111111', 'password123', '2023-01-26', 'Active', '2019-20', 'Economics'),
(70, 'SONIA AKTER', 'SONIA', '20102027', '8858', 'sonia@email.com', 'Female', '222222222', 'password456', '2023-01-27', 'Active', '2019-20', 'Philosophy'),
(71, 'SHARMIN JAHAN', 'SHARMIN', '20102028', '8859', 'sharmin@email.com', 'Female', '333333333', 'password789', '2023-01-28', 'Active', '2019-20', 'Geography'),
(72, 'YOUSUF ABDULLAH FAHIM', 'YOUSUF', '20102029', '8860', 'yousuf@email.com', 'Male', '444444444', 'passwordabc', '2023-01-29', 'Active', '2019-20', 'Environmental Science'),
(73, 'NARGIA EASMIN NOOR', 'NARGIA', '20102030', '8861', 'nargia@email.com', 'Female', '555555555', 'passwordxyz', '2023-01-30', 'Active', '2019-20', 'Physics'),
(74, 'LAILA AFROZ TINNI', 'LAILA', '20102031', '8862', 'laila@email.com', 'Female', '666666666', 'password123', '2023-01-31', 'Active', '2019-20', 'Chemistry'),
(75, 'MD. AL-IMRAN', 'MD.', '20102032', '8863', 'alimran@email.com', 'Male', '777777777', 'password456', '2023-02-01', 'Active', '2019-20', 'Biology'),
(76, 'ARPA PAUL', 'ARPA', '20102033', '8864', 'arpa@email.com', 'Female', '888888888', 'password789', '2023-02-02', 'Active', '2019-20', 'Mathematics'),
(77, 'RUBINA AKTAR', 'RUBINA', '20102034', '8865', 'rubina@email.com', 'Female', '999999999', 'passwordabc', '2023-02-03', 'Active', '2019-20', 'Computer Science'),
(78, 'FARJANA AKTER MIM', 'FARJANA', '20102035', '8866', 'farjana@email.com', 'Female', '111111111', 'passwordxyz', '2023-02-04', 'Active', '2019-20', 'Engineering'),
(79, 'TALUKDER OMAR FARUK', 'TALUKDER', '20102036', '8867', 'omar@email.com', 'Male', '222222222', 'password123', '2023-02-05', 'Active', '2019-20', 'Medicine'),
(80, 'RAKIBUN NABI', 'RAKIBUN', '20102037', '8868', 'rakibun@email.com', 'Male', '333333333', 'password456', '2023-02-06', 'Active', '2019-20', 'Physics'),
(81, 'MD. AHASAN ULLAH', 'MD.', '20102038', '8869', 'ahasan@email.com', 'Male', '444444444', 'password789', '2023-02-07', 'Active', '2019-20', 'Chemistry'),
(82, 'MD. TAJUL ISLAM', 'MD.', '20102039', '8870', 'tajul@email.com', 'Male', '555555555', 'passwordabc', '2023-02-08', 'Active', '2019-20', 'Biology'),
(83, 'MIKHA GANDAL', 'MIKHA', '20102040', '8871', 'mikha@email.com', 'Male', '666666666', 'passwordxyz', '2023-02-09', 'Active', '2019-20', 'Mathematics'),
(84, 'MARSHIA MINHAJ MOHANA', 'MARSHIA', '20102041', '8872', 'marshia@email.com', 'Female', '777777777', 'password123', '2023-02-10', 'Active', '2019-20', 'Computer Science'),
(85, 'MST. TAKRIMA AKTER TONNI', 'MST.', '20102042', '8873', 'tonni@email.com', 'Female', '123456789', 'password123', '2023-01-01', 'Active', '2019-20', 'Arts'),
(86, 'MD. FAZLE RABBI RIZON', 'MD.', '20102043', '8874', 'rizon@email.com', 'Male', '987654321', 'password456', '2023-01-02', 'Active', '2019-20', 'Science'),
(87, 'MST. MURSHIDA AKTER JIM', 'MST.', '20102044', '8875', 'jim@email.com', 'Female', '555555555', 'password789', '2023-01-03', 'Active', '2019-20', 'Commerce'),
(88, 'FARHANA MAHBUBA', 'FARHANA', '20102045', '8876', 'farhana@email.com', 'Female', '666666666', 'passwordabc', '2023-01-04', 'Active', '2019-20', 'Engineering'),
(89, 'Farzana Afroj', 'Farzana', '21102001', '9868', 'farzana@email.com', 'Female', '123456789', 'password123', '2023-01-01', 'Active', '2020-21', 'Arts'),
(90, 'Lamia Akter Monni', 'Lamia', '21102002', '9869', 'lamia@email.com', 'Female', '987654321', 'password456', '2023-01-02', 'Active', '2020-21', 'Science'),
(91, 'Asraful Alam', 'Asraful', '21102003', '9870', 'asraful@email.com', 'Male', '555555555', 'password789', '2023-01-03', 'Active', '2020-21', 'Commerce'),
(92, 'Zinnia Tasnim Rifat', 'Zinnia', '21102004', '9871', 'zinnia@email.com', 'Female', '666666666', 'passwordabc', '2023-01-04', 'Active', '2020-21', 'Engineering'),
(93, 'K.M. Shukateb Mehbub Saikat', 'K.M.', '21102005', '9872', 'shukateb@email.com', 'Male', '777777777', 'passwordxyz', '2023-01-05', 'Active', '2020-21', 'Medical'),
(94, 'Umme Jami', 'Umme', '21102006', '9873', 'umme@email.com', 'Female', '888888888', 'password123', '2023-01-06', 'Active', '2020-21', 'Law'),
(95, 'Nabeel Ahsan', 'Nabeel', '21102007', '9874', 'nabeel@email.com', 'Male', '999999999', 'password456', '2023-01-07', 'Active', '2020-21', 'Computer Science'),
(96, 'Abul Bashar Abir', 'Abul', '21102008', '9875', 'abul@email.com', 'Male', '111111111', 'password789', '2023-01-08', 'Active', '2020-21', 'Political Science'),
(97, 'Md. Taiyeb Reza', 'Md.', '21102009', '9876', 'taiyeb@email.com', 'Male', '222222222', 'passwordabc', '2023-01-09', 'Active', '2020-21', 'Economics'),
(98, 'Odity Dey', 'Odity', '21102010', '9877', 'odity@email.com', 'Female', '333333333', 'passwordxyz', '2023-01-10', 'Active', '2020-21', 'Mathematics'),
(99, 'Salman Sadick Ucchas', 'Salman', '21102011', '9878', 'salman@email.com', 'Male', '444444444', 'password123', '2023-01-11', 'Active', '2020-21', 'History'),
(100, 'Md. Mehedi Hasan Shagor', 'Md.', '21102012', '9879', 'mehedi@email.com', 'Male', '555555555', 'password456', '2023-01-12', 'Active', '2020-21', 'Physics'),
(101, 'Md. Fayjur Rafi', 'Md.', '21102013', '9880', 'rafi@email.com', 'Male', '666666666', 'password789', '2023-01-13', 'Active', '2020-21', 'Chemistry'),
(102, 'Samiha Kabir Sigma', 'Samiha', '21102014', '9881', 'samiha@email.com', 'Female', '777777777', 'passwordabc', '2023-01-14', 'Active', '2020-21', 'Biology'),
(103, 'Md. Mehedi Hasan', 'Md.', '21102015', '9882', 'mehedi2@email.com', 'Male', '888888888', 'passwordxyz', '2023-01-15', 'Active', '2020-21', 'Computer Science'),
(104, 'Asif Hasan', 'Asif', '21102016', '9883', 'asif@email.com', 'Male', '999999999', 'password123', '2023-01-16', 'Active', '2020-21', 'Mathematics'),
(105, 'Syed Fahad Mahmud', 'Syed', '21102017', '9884', 'fahad@email.com', 'Male', '111111111', 'password456', '2023-01-17', 'Active', '2020-21', 'Chemistry'),
(106, 'Rafayatul Ashraf', 'Rafayatul', '21102018', '9885', 'rafayatul@email.com', 'Male', '222222222', 'password789', '2023-01-18', 'Active', '2020-21', 'Biology'),
(107, 'Nur Shaan Wafi', 'Nur', '21102019', '9886', 'wafi@email.com', 'Male', '333333333', 'passwordabc', '2023-01-19', 'Active', '2020-21', 'Physics'),
(108, 'Sanjida Sultana', 'Sanjida', '21102020', '9887', 'sanjida@email.com', 'Female', '444444444', 'passwordxyz', '2023-01-20', 'Active', '2020-21', 'Chemistry'),
(109, 'Md. Tuhin Molla', 'Md.', '21102021', '9888', 'tuhin@email.com', 'Male', '555555555', 'password123', '2023-01-21', 'Active', '2020-21', 'Mathematics'),
(110, 'Tarmim', 'Tarmim', '21102022', '9889', 'tarmim@email.com', 'Male', '666666666', 'password456', '2023-01-22', 'Active', '2020-21', 'Political Science'),
(111, 'Tamjid Hossen', 'Tamjid', '21102023', '9890', 'tamjid@email.com', 'Male', '777777777', 'password789', '2023-01-23', 'Active', '2020-21', 'History'),
(112, 'Md. Noornabi', 'Md.', '21102024', '9891', 'noornabi@email.com', 'Male', '888888888', 'passwordabc', '2023-01-24', 'Active', '2020-21', 'Economics'),
(113, 'Easir Arafat', 'Easir', '21102025', '9892', 'easir@email.com', 'Male', '999999999', 'passwordxyz', '2023-01-25', 'Active', '2020-21', 'Arts'),
(114, 'Ashari Binte Ashraf', 'Ashari', '21102026', '9893', 'ashari@email.com', 'Female', '111111111', 'password123', '2023-01-26', 'Active', '2020-21', 'Science'),
(115, 'Ahammad Tausif Mayeen', 'Ahammad', '21102027', '9894', 'tausif@email.com', 'Male', '222222222', 'password456', '2023-01-27', 'Active', '2020-21', 'Commerce'),
(116, 'Naeem Hasan Shorol', 'Naeem', '21102028', '9895', 'naeem@email.com', 'Male', '333333333', 'password789', '2023-01-28', 'Active', '2020-21', 'Engineering'),
(117, 'Ifroem Rema', 'Ifroem', '21102029', '9896', 'ifroem@email.com', 'Female', '444444444', 'passwordabc', '2023-01-29', 'Active', '2020-21', 'Medical'),
(118, 'Spondon Rema', 'Spondon', '21102030', '9897', 'spondon@email.com', 'Male', '555555555', 'passwordxyz', '2023-01-30', 'Active', '2020-21', 'Law'),
(119, 'Mobasshirah Mridula', 'Mobasshirah', '21102031', '9898', 'mridula@email.com', 'Female', '666666666', 'password123', '2023-01-31', 'Active', '2020-21', 'Political Science'),
(120, 'Arman Mia', 'Arman', '21102032', '9899', 'arman@email.com', 'Male', '777777777', 'password456', '2023-02-01', 'Active', '2020-21', 'Economics'),
(121, 'Md. Mehedi Hasan', 'Md.', '21102033', '9900', 'mehedi3@email.com', 'Male', '888888888', 'password789', '2023-02-02', 'Active', '2020-21', 'Arts'),
(122, 'Md Perbej Bhuiyan Akib', 'Md.', '21102034', '9901', 'akib@email.com', 'Male', '999999999', 'passwordabc', '2023-02-03', 'Active', '2020-21', 'Science'),
(123, 'Avishek Sarkar', 'Avishek', '21102035', '9902', 'avishek@email.com', 'Male', '111111111', 'passwordxyz', '2023-02-04', 'Active', '2020-21', 'Commerce'),
(124, 'Md. Al Nur Antor', 'Md.', '21102036', '9903', 'antor@email.com', 'Male', '222222222', 'password123', '2023-02-05', 'Active', '2020-21', 'Engineering'),
(125, 'Emran', 'Emran', '21102037', '9904', 'emran@email.com', 'Male', '333333333', 'password456', '2023-02-06', 'Active', '2020-21', 'Medical'),
(126, 'Syed Jahin Jarif', 'Syed', '21102038', '9905', 'jahin@email.com', 'Male', '444444444', 'password789', '2023-02-07', 'Active', '2020-21', 'Law'),
(127, 'Ashiful Alam Sharif', 'Ashiful', '21102039', '9906', 'ashiful@email.com', 'Male', '555555555', 'passwordabc', '2023-02-08', 'Active', '2020-21', 'Political Science'),
(128, 'Md. Raful Mia', 'Md.', '21102040', '9907', 'raful@email.com', 'Male', '666666666', 'passwordxyz', '2023-02-09', 'Active', '2020-21', 'History'),
(129, 'Md. Saif Uddin Chowdhury Tamim', 'Md.', '21102041', '9908', 'tamim@email.com', 'Male', '777777777', 'password123', '2023-02-10', 'Active', '2020-21', 'Economics'),
(130, 'Prantic Paul', 'Prantic', '21102042', '9909', 'prantic@email.com', 'Male', '888888888', 'password456', '2023-02-11', 'Active', '2020-21', 'Arts');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `improve_students`
--
ALTER TABLE `improve_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `improve_students`
--
ALTER TABLE `improve_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
