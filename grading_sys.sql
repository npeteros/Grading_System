-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 15, 2023 at 05:02 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grading_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classID` int(10) UNSIGNED NOT NULL,
  `groupNumber` int(10) NOT NULL,
  `courseCode` varchar(50) NOT NULL,
  `classSchedule` varchar(120) NOT NULL,
  `totalStudents` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`classID`, `groupNumber`, `courseCode`, `classSchedule`, `totalStudents`) VALUES
(1, 9, 'CIS 1202', 'T Th 07:30 AM - 10:00 AM LB446TC TC', 1),
(2, 39, 'CIS 1201', 'M W 06:00 PM - 08:00 PM LB467TC TC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `examID` int(10) UNSIGNED NOT NULL,
  `examClass` int(10) UNSIGNED NOT NULL,
  `examName` varchar(100) NOT NULL,
  `examDate` date NOT NULL DEFAULT current_timestamp(),
  `totalScore` int(10) UNSIGNED NOT NULL,
  `passingScore` int(10) NOT NULL,
  `term` enum('Midterms','Finals') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`examID`, `examClass`, `examName`, `examDate`, `totalScore`, `passingScore`, `term`) VALUES
(1, 1, 'Diagnostic Exam', '2003-08-21', 100, 60, 'Midterms'),
(4, 1, 'Summative Exam', '2023-05-15', 90, 50, 'Midterms'),
(5, 1, 'Finals Exam', '2023-08-21', 30, 10, 'Finals'),
(6, 2, 'Diagnostic Exam', '2003-08-21', 100, 60, 'Midterms');

-- --------------------------------------------------------

--
-- Table structure for table `exam_entries`
--

CREATE TABLE `exam_entries` (
  `resultID` int(10) UNSIGNED NOT NULL,
  `examID` int(10) UNSIGNED NOT NULL,
  `classID` int(10) UNSIGNED NOT NULL,
  `studentID` int(10) UNSIGNED NOT NULL,
  `score` int(10) UNSIGNED NOT NULL,
  `status` enum('Failed','Passed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_entries`
--

INSERT INTO `exam_entries` (`resultID`, `examID`, `classID`, `studentID`, `score`, `status`) VALUES
(2, 1, 1, 1, 100, 'Passed'),
(3, 4, 1, 1, 20, 'Failed'),
(4, 5, 1, 1, 30, 'Passed'),
(5, 6, 2, 2, 30, 'Failed');

-- --------------------------------------------------------

--
-- Table structure for table `global`
--

CREATE TABLE `global` (
  `unique_key` int(10) NOT NULL,
  `totalClasses` int(10) UNSIGNED NOT NULL,
  `totalStudents` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `global`
--

INSERT INTO `global` (`unique_key`, `totalClasses`, `totalStudents`) VALUES
(1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `studentID` int(10) NOT NULL,
  `studentName` varchar(128) NOT NULL,
  `studentCourse` varchar(100) NOT NULL,
  `studentClass` int(10) NOT NULL,
  `midterms_grade` varchar(50) NOT NULL DEFAULT 'NG',
  `finals_grade` varchar(50) NOT NULL DEFAULT 'NG'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`studentID`, `studentName`, `studentCourse`, `studentClass`, `midterms_grade`, `finals_grade`) VALUES
(1, 'Neal Andrew B. Peteros', 'BS-IT', 1, 'NG', 'NG'),
(2, 'Neal Andrew B. Peteros', 'BS-IT', 2, 'NG', 'NG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classID`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`examID`);

--
-- Indexes for table `exam_entries`
--
ALTER TABLE `exam_entries`
  ADD PRIMARY KEY (`resultID`);

--
-- Indexes for table `global`
--
ALTER TABLE `global`
  ADD PRIMARY KEY (`unique_key`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `classID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `examID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `exam_entries`
--
ALTER TABLE `exam_entries`
  MODIFY `resultID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `global`
--
ALTER TABLE `global`
  MODIFY `unique_key` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `studentID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
