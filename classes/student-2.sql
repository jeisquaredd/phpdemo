-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 05, 2025 at 01:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_description`) VALUES
(1, 'Introduction to Computer Science', 'A beginner course on the fundamentals of computer science.'),
(2, 'Data Structures', 'An intermediate course on data structures such as arrays, lists, stacks, and queues.'),
(3, 'Web Development', 'A comprehensive course on building websites and web applications using HTML, CSS, and JavaScript.'),
(4, 'Database Management', 'An advanced course on database design, SQL, and database management systems.');

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE `Customers` (
  `CustomerID` int(11) NOT NULL,
  `cust_name` varchar(255) DEFAULT NULL,
  `ContactName` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(255) NOT NULL,
  `PostalCode` varchar(255) NOT NULL,
  `Country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Customers`
--

INSERT INTO `Customers` (`CustomerID`, `cust_name`, `ContactName`, `Address`, `City`, `PostalCode`, `Country`) VALUES
(1, 'Alfreds Futterkiste', 'Maria Anders', 'Obere Str. 57', 'Berlin', '12209', 'Germany'),
(2, 'Ana Trujillo Emparedados y helados', 'Ana Trujillo', 'Avda. de la Constitución 2222', 'México D.F.', '05021', 'Mexico'),
(3, 'Antonio Moreno Taquería', 'Antonio Moreno', 'Mataderos 2312', 'México D.F.', '05023', 'Mexico'),
(4, 'Around the Horn', 'Thomas Hardy', '120 Hanover Sq.', 'London', 'WA1 1DP', 'UK'),
(5, 'Berglunds snabbköp', 'Christina Berglund', 'Berguvsvägen 8', 'Luleå', 'S-958 22', 'Sweden'),
(6, 'gf', 'gf', 'fg', 'fg', 'fggf', 'fg');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrolled_status` enum('enrolled','completed','dropped') NOT NULL DEFAULT 'enrolled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(10, 'jei', '123');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `user_id`, `payment_amount`, `payment_date`) VALUES
(1, 1, 200.00, '2024-06-19 08:07:25'),
(2, 1, 300.00, '2024-06-19 08:07:25'),
(3, 1, 500.00, '2024-06-19 08:09:17'),
(4, 2, 300.00, '2024-06-19 08:12:28');

-- --------------------------------------------------------

--
-- Table structure for table `sales_transactions`
--

CREATE TABLE `sales_transactions` (
  `id` int(11) NOT NULL,
  `sale_amount` decimal(10,2) DEFAULT NULL,
  `transaction_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_transactions`
--

INSERT INTO `sales_transactions` (`id`, `sale_amount`, `transaction_timestamp`) VALUES
(1, 150.00, '2024-05-01 02:00:00'),
(2, 200.50, '2024-05-02 03:00:00'),
(3, 175.75, '2024-05-03 04:00:00'),
(4, 225.00, '2024-05-04 05:00:00'),
(5, 190.25, '2024-05-05 06:00:00'),
(6, 50.00, '2024-05-01 00:00:00'),
(7, 25.00, '2024-05-01 02:30:00'),
(8, 40.00, '2024-05-01 04:45:00'),
(9, 35.00, '2024-05-01 07:20:00'),
(10, 55.00, '2024-05-01 10:00:00'),
(11, 60.00, '2024-05-02 01:30:00'),
(12, 45.00, '2024-05-02 03:15:00'),
(13, 30.00, '2024-05-02 05:45:00'),
(14, 70.00, '2024-05-02 08:00:00'),
(15, 65.00, '2024-05-02 11:00:00'),
(16, 50.00, '2024-05-03 00:45:00'),
(17, 35.00, '2024-05-03 02:00:00'),
(18, 40.00, '2024-05-03 04:30:00'),
(19, 55.00, '2024-05-03 06:45:00'),
(20, 45.00, '2024-05-03 09:15:00'),
(21, 60.00, '2024-05-04 01:00:00'),
(22, 25.00, '2024-05-04 03:30:00'),
(23, 35.00, '2024-05-04 05:00:00'),
(24, 50.00, '2024-05-04 07:45:00'),
(25, 70.00, '2024-05-04 10:30:00'),
(26, 40.00, '2024-05-05 00:30:00'),
(27, 55.00, '2024-05-05 02:45:00'),
(28, 65.00, '2024-05-05 04:15:00'),
(29, 30.00, '2024-05-05 06:30:00'),
(30, 45.00, '2024-05-05 09:00:00'),
(31, 50.00, '2024-05-06 00:00:00'),
(32, 25.00, '2024-05-06 02:30:00'),
(33, 40.00, '2024-05-06 04:45:00'),
(34, 35.00, '2024-05-06 07:20:00'),
(35, 55.00, '2024-05-06 10:00:00'),
(36, 60.00, '2024-05-07 01:30:00'),
(37, 45.00, '2024-05-07 03:15:00'),
(38, 30.00, '2024-05-07 05:45:00'),
(39, 70.00, '2024-05-07 08:00:00'),
(40, 65.00, '2024-05-07 11:00:00'),
(41, 50.00, '2024-05-08 00:45:00'),
(42, 35.00, '2024-05-08 02:00:00'),
(43, 40.00, '2024-05-08 04:30:00'),
(44, 55.00, '2024-05-08 06:45:00'),
(45, 45.00, '2024-05-08 09:15:00'),
(46, 60.00, '2024-05-09 01:00:00'),
(47, 25.00, '2024-05-09 03:30:00'),
(48, 35.00, '2024-05-09 05:00:00'),
(49, 50.00, '2024-05-09 07:45:00'),
(50, 70.00, '2024-05-09 10:30:00'),
(51, 40.00, '2024-05-10 00:30:00'),
(52, 55.00, '2024-05-10 02:45:00'),
(53, 65.00, '2024-05-10 04:15:00'),
(54, 30.00, '2024-05-10 06:30:00'),
(55, 45.00, '2024-05-10 09:00:00'),
(56, 50.00, '2024-05-11 00:00:00'),
(57, 25.00, '2024-05-11 02:30:00'),
(58, 40.00, '2024-05-11 04:45:00'),
(59, 35.00, '2024-05-11 07:20:00'),
(60, 55.00, '2024-05-11 10:00:00'),
(61, 60.00, '2024-05-12 01:30:00'),
(62, 45.00, '2024-05-12 03:15:00'),
(63, 30.00, '2024-05-12 05:45:00'),
(64, 70.00, '2024-05-12 08:00:00'),
(65, 65.00, '2024-05-12 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `studinfo`
--

CREATE TABLE `studinfo` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `studinfo`
--

INSERT INTO `studinfo` (`id`, `fname`, `mname`, `lname`, `Email`, `CourseID`) VALUES
(4, 'JeiPOGI', 'Quitain', 'Pastrana', NULL, 3),
(14, 'Philip', 'Pastrana', 'Llave', NULL, 3),
(11, 'Clarisa', 'M', 'Alic', NULL, 3),
(12, 'Carol', 'Magpantay', 'Alfaro', NULL, 3),
(13, 'John Lester', 'Bagsic', 'Pangat', NULL, 3),
(15, 'John', 'Doe', 'Smith', NULL, 1),
(16, 'Ashley', 'Mitra', 'Mitra', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `trial`
--

CREATE TABLE `trial` (
  `trial_ID` int(11) NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Second_Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trial`
--

INSERT INTO `trial` (`trial_ID`, `First_Name`, `Second_Name`) VALUES
(1, 'Jei', 'Quitain'),
(2, 'Darylle ', 'Ong');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_fn` varchar(100) DEFAULT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_birthday` date NOT NULL,
  `user_sex` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `user_profile_picture` varchar(255) NOT NULL,
  `account_type` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_fn`, `user_lastname`, `user_birthday`, `user_sex`, `user_email`, `user_name`, `user_pass`, `user_profile_picture`, `account_type`) VALUES
(17, 'Paris', 'Pastrana', '2024-05-07', 'Male', 'paris@gmail.com', 'paris_01', 'Password@01', 'uploads/IMG_3665.jpeg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `street` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`address_id`, `user_id`, `street`, `barangay`, `city`, `province`) VALUES
(15, 17, 'Centro', 'Catwiran II', 'Baco      ', 'MIMAROPA      ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `sales_transactions`
--
ALTER TABLE `sales_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studinfo`
--
ALTER TABLE `studinfo`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `trial`
--
ALTER TABLE `trial`
  ADD PRIMARY KEY (`trial_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Customers`
--
ALTER TABLE `Customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales_transactions`
--
ALTER TABLE `sales_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `studinfo`
--
ALTER TABLE `studinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `trial`
--
ALTER TABLE `trial`
  MODIFY `trial_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `user_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
