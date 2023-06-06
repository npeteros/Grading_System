-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2023 at 04:13 PM
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
-- Table structure for table `campuses`
--

CREATE TABLE `campuses` (
  `campusID` int(11) NOT NULL,
  `campus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `campuses`
--

INSERT INTO `campuses` (`campusID`, `campus`) VALUES
(1, 'TC'),
(2, 'DC'),
(3, 'NC'),
(4, 'SC');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `classID` int(10) UNSIGNED NOT NULL,
  `groupNumber` int(10) NOT NULL,
  `courseCode` varchar(50) NOT NULL,
  `s_time` time NOT NULL DEFAULT current_timestamp(),
  `e_time` time NOT NULL DEFAULT current_timestamp(),
  `schedID` int(11) NOT NULL,
  `roomID` int(11) NOT NULL,
  `campusID` int(11) NOT NULL,
  `totalStudents` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `roomID` int(11) NOT NULL,
  `classroom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`roomID`, `classroom`) VALUES
(1, 'LB442'),
(2, 'LB443'),
(3, 'LB444'),
(4, 'LB445'),
(5, 'LB464'),
(6, 'LB465'),
(7, 'LB466'),
(8, 'LB467'),
(9, 'LB484'),
(10, 'LB485'),
(11, 'LB486'),
(12, 'LB483'),
(13, 'LB447');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `courseID` int(11) NOT NULL,
  `course` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseID`, `course`) VALUES
(1, 'BS IT'),
(2, 'BS CS'),
(3, 'BS IS'),
(4, 'BS CE'),
(5, 'BS CpE'),
(6, 'BS Psych'),
(7, 'BSA'),
(8, 'BS HM'),
(9, 'BS N'),
(10, 'BS ECE'),
(11, 'BS ICT'),
(12, 'C CT');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `examID` int(10) UNSIGNED NOT NULL,
  `examClass` int(10) UNSIGNED NOT NULL,
  `examName` varchar(100) NOT NULL,
  `exam_s_date` datetime NOT NULL DEFAULT current_timestamp(),
  `exam_e_date` datetime NOT NULL DEFAULT current_timestamp(),
  `totalScore` int(10) UNSIGNED NOT NULL,
  `passingScore` int(10) NOT NULL,
  `term` enum('Midterms','Finals') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedID` int(11) NOT NULL,
  `schedule` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedID`, `schedule`) VALUES
(1, 'MW'),
(2, 'MWF'),
(3, 'Tue'),
(4, 'TTh'),
(5, 'Fri'),
(6, 'Sat'),
(7, 'Sun');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) NOT NULL,
  `studentID` int(10) UNSIGNED NOT NULL,
  `studentName` varchar(128) NOT NULL,
  `courseID` int(11) NOT NULL,
  `studentClass` int(10) UNSIGNED NOT NULL,
  `midterms_grade` varchar(50) NOT NULL DEFAULT 'NG',
  `finals_grade` varchar(50) NOT NULL DEFAULT 'NG'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campuses`
--
ALTER TABLE `campuses`
  ADD PRIMARY KEY (`campusID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`classID`),
  ADD KEY `schedID` (`schedID`,`roomID`,`campusID`),
  ADD KEY `campusID` (`campusID`),
  ADD KEY `roomID` (`roomID`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`roomID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courseID`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`examID`),
  ADD KEY `examClass` (`examClass`);

--
-- Indexes for table `exam_entries`
--
ALTER TABLE `exam_entries`
  ADD PRIMARY KEY (`resultID`),
  ADD KEY `classID` (`classID`),
  ADD KEY `examID` (`examID`),
  ADD KEY `studentID` (`studentID`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `courseID` (`courseID`),
  ADD KEY `studentClass` (`studentClass`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campuses`
--
ALTER TABLE `campuses`
  MODIFY `campusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `classID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `roomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `examID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_entries`
--
ALTER TABLE `exam_entries`
  MODIFY `resultID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`schedID`) REFERENCES `schedules` (`schedID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`campusID`) REFERENCES `campuses` (`campusID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `classes_ibfk_3` FOREIGN KEY (`roomID`) REFERENCES `classrooms` (`roomID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`examClass`) REFERENCES `classes` (`classID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `exam_entries`
--
ALTER TABLE `exam_entries`
  ADD CONSTRAINT `exam_entries_ibfk_1` FOREIGN KEY (`classID`) REFERENCES `classes` (`classID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_entries_ibfk_2` FOREIGN KEY (`examID`) REFERENCES `exams` (`examID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_entries_ibfk_3` FOREIGN KEY (`studentID`) REFERENCES `students` (`studentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `courses` (`courseID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`studentClass`) REFERENCES `classes` (`classID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
