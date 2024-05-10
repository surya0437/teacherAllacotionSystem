-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 08:05 PM
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
-- Database: `teacher`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(6) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `MobileNumber` varchar(20) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ProfilePic` varchar(255) NOT NULL,
  `AdminRegdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `FirstName`, `LastName`, `UserName`, `Email`, `MobileNumber`, `Password`, `ProfilePic`, `AdminRegdate`) VALUES
(372174, 'Surya', 'Narayan Chaudhary', 'surya0437', 'surya0437.nc@gmail.com', '9844532500', '1111', 'dac37461b2b8cf253473505beb76c9a21715362001.jpg', '2024-05-10 17:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

CREATE TABLE `tblcourse` (
  `ID` int(11) NOT NULL,
  `BranchName` varchar(100) DEFAULT NULL,
  `CourseName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`ID`, `BranchName`, `CourseName`) VALUES
(4, NULL, 'BBS'),
(7, NULL, 'BCA'),
(8, NULL, 'BBA'),
(9, NULL, 'BSC');

-- --------------------------------------------------------

--
-- Table structure for table `tblsuballocation`
--

CREATE TABLE `tblsuballocation` (
  `ID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `Teacherempid` int(11) DEFAULT NULL,
  `Subid` int(11) DEFAULT NULL,
  `AllocationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblsubject`
--

CREATE TABLE `tblsubject` (
  `ID` int(11) NOT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `SubjectFullname` varchar(100) DEFAULT NULL,
  `SubjectShortname` varchar(50) DEFAULT NULL,
  `SubjectCode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubject`
--

INSERT INTO `tblsubject` (`ID`, `CourseID`, `SubjectFullname`, `SubjectShortname`, `SubjectCode`) VALUES
(4, 4, 'Math', 'MA', '0004'),
(5, 4, 'Finance', 'FN', 'FN - '),
(6, 7, 'DBA', 'DBA', 'DBA225');

-- --------------------------------------------------------

--
-- Table structure for table `tblteacher`
--

CREATE TABLE `tblteacher` (
  `ID` int(11) NOT NULL,
  `EmpID` varchar(22) DEFAULT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `MobileNumber` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Gender` char(1) DEFAULT NULL,
  `Dob` date DEFAULT NULL,
  `CourseID` int(11) DEFAULT NULL,
  `Religion` varchar(50) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `ProfilePic` varchar(255) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `JoiningDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblteacher`
--

INSERT INTO `tblteacher` (`ID`, `EmpID`, `FirstName`, `LastName`, `MobileNumber`, `Email`, `Gender`, `Dob`, `CourseID`, `Religion`, `Address`, `ProfilePic`, `Password`, `JoiningDate`) VALUES
(1, '101', 'Ram', 'Singh', '1234567890', 'ram@gmail.com', 'm', '2000-04-01', 111, 'hindu', 'boudha', NULL, '', '2024-04-15 03:21:17'),
(7, '0', 'sdfsdf', 'sdfsdf', '54645645', 's@gmail.com', 'P', '2024-05-21', 3, 'srar', 'werwer', 'dac37461b2b8cf253473505beb76c9a21715359105.jpg', '', '2024-05-10 16:38:25'),
(8, '4444', 'Milan', 'Bohara', '9844444444', 'milan.bohara@gmail.com', 'M', '2022-12-06', 3, 'Hindu', 'Ktm', 'cf0683d15735b3d30b0e3928632bc8bc1715363430jpeg', '', '2024-05-10 17:50:30'),
(10, 'EMP - 2510', 'dsfse', 'erwerw', '35345', 'd@gmail.com', 'M', '1998-02-02', 3, 'asdas', 'asdsa', 'd9c5809ec188d18ad95ec6187eba96821715363942.jpg', '', '2024-05-10 17:59:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcourse`
--
ALTER TABLE `tblcourse`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblsuballocation`
--
ALTER TABLE `tblsuballocation`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblsubject`
--
ALTER TABLE `tblsubject`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblteacher`
--
ALTER TABLE `tblteacher`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EmpID` (`EmpID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcourse`
--
ALTER TABLE `tblcourse`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblsuballocation`
--
ALTER TABLE `tblsuballocation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblsubject`
--
ALTER TABLE `tblsubject`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblteacher`
--
ALTER TABLE `tblteacher`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
