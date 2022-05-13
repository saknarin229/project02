-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 13, 2022 at 06:13 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolbang`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `1`
-- (See below for the actual view)
--
CREATE TABLE `1` (
);

-- --------------------------------------------------------

--
-- Table structure for table `addclass_data`
--

CREATE TABLE `addclass_data` (
  `id` int(11) NOT NULL,
  `teacherID` int(11) NOT NULL,
  `yearclassID` int(11) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `course_id` varchar(20) DEFAULT NULL,
  `class_term` int(11) NOT NULL,
  `class_year` int(11) NOT NULL,
  `class_day` varchar(10) NOT NULL,
  `class_time` int(11) NOT NULL,
  `class_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `addclass_data`
--

INSERT INTO `addclass_data` (`id`, `teacherID`, `yearclassID`, `departmentID`, `course_id`, `class_term`, `class_year`, `class_day`, `class_time`, `class_status`) VALUES
(1, 1, 2, 1, 'ว21101', 1, 2565, 'จ.', 3, 0),
(3, 1, 1, 1, 'ท21101', 1, 2565, 'จ.', 2, 0),
(5, 4, 2, 2, 'ค21101', 1, 2565, 'จ.', 1, 0),
(11, 1, 1, 2, 'ค21101', 1, 2565, 'จ.', 6, 0),
(12, 4, 2, 3, 'ท21101', 1, 2565, 'จ.', 8, 0),
(13, 1, 1, 1, 'ค21101', 1, 2565, 'จ.', 1, 0),
(14, 1, 2, 1, 'ค21101', 1, 2565, 'จ.', 2, 0),
(15, 1, 2, 1, 'ว21101', 1, 2565, 'จ.', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `administrator_table`
--

CREATE TABLE `administrator_table` (
  `admin_user` varchar(50) NOT NULL COMMENT 'ชื้อผู้ใช้',
  `admin_password` varchar(20) NOT NULL COMMENT 'รหัสผู้ใช้',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางผู้ดูแลระบบ';

--
-- Dumping data for table `administrator_table`
--

INSERT INTO `administrator_table` (`admin_user`, `admin_password`, `id`) VALUES
('admin', '123456', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course_table`
--

CREATE TABLE `course_table` (
  `course_id` varchar(10) NOT NULL COMMENT 'รหัสรายวิชา',
  `course_name` varchar(50) NOT NULL COMMENT 'ชื้อรายวิชา',
  `course_credit` varchar(50) NOT NULL COMMENT 'หน่วยกิต',
  `course_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางข้อมูลรายวิชา';

--
-- Dumping data for table `course_table`
--

INSERT INTO `course_table` (`course_id`, `course_name`, `course_credit`, `course_status`) VALUES
('ค21101', 'คณิตศาสตร์', '1.5', 0),
('ท21101', 'ภาษาไทย', '1.5', 0),
('ว21101', 'วิทยาศาสตร์', '1.5', 0),
('ส21101', 'สังคมศึกษา', '1.5', 0);

-- --------------------------------------------------------

--
-- Table structure for table `department_data`
--

CREATE TABLE `department_data` (
  `id` int(11) NOT NULL,
  `subjectName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department_data`
--

INSERT INTO `department_data` (`id`, `subjectName`, `status`) VALUES
(1, 'กิจกรรม', 0),
(2, 'คณิตศาสตร์', 0),
(3, 'ภาษาไทย', 0);

-- --------------------------------------------------------

--
-- Table structure for table `position_data`
--

CREATE TABLE `position_data` (
  `id` int(11) NOT NULL,
  `positionName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position_data`
--

INSERT INTO `position_data` (`id`, `positionName`, `status`) VALUES
(1, 'ข้าราชการครู', 0),
(2, 'ราชการครู', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_table`
--

CREATE TABLE `student_table` (
  `Std_ID` int(10) NOT NULL COMMENT 'รหัสนักเรียน',
  `Std_user` varchar(20) NOT NULL COMMENT 'ชื้อผู้ใช้',
  `Std_password` varchar(40) NOT NULL COMMENT 'รหัสผ่าน',
  `Std_firstname` varchar(50) NOT NULL COMMENT 'ชื้อนักเรียน',
  `Std_lastname` varchar(50) NOT NULL COMMENT 'นามสกุลนักเรียน',
  `Std_sex` varchar(5) NOT NULL COMMENT 'เพศนักเรียน',
  `Std_yearOfStudent` date DEFAULT NULL COMMENT 'ปีการศึกษา',
  `Std_image` varchar(150) DEFAULT NULL,
  `yearClass` int(11) DEFAULT NULL,
  `Std_status` int(11) NOT NULL DEFAULT '0' COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางข้อมูลนักเรียน';

--
-- Dumping data for table `student_table`
--

INSERT INTO `student_table` (`Std_ID`, `Std_user`, `Std_password`, `Std_firstname`, `Std_lastname`, `Std_sex`, `Std_yearOfStudent`, `Std_image`, `yearClass`, `Std_status`) VALUES
(2625, '2625', '2625', 'ด.ช.ชินดนัย', 'ศรีสุข', 'หญิง', '2022-03-21', 'image/Std/2625.jpg', 2, 0),
(2626, '2626', '2626', 'ด.ช.บารมี', 'เกิดรักษ์', 'ชาย', '2022-02-28', NULL, 2, 0),
(2627, '2627', '2627', 'ด.ช.แสงตะวัน', 'นาควงษ์', 'ชาย', '2022-02-28', NULL, 2, 0),
(2629, '2629', '2629', 'ด.ช.พีรพัฒน์', 'บางยับยิ่ง', 'ชาย', '2022-02-28', NULL, 2, 0),
(2631, '2631', '2631', 'ด.ช.ยุทธนา', 'บางยับยิ่ว', 'ชาย', '2022-02-28', NULL, 2, 0),
(2636, '2636', '2636', 'ด.ญ.วิภาวดี', 'พรหมภักดี', 'หญิง', '2022-02-28', NULL, 2, 0),
(2637, '2637', '2637', 'ด.ญ.สุกัญญา', 'เงินพัก', 'หญิง', '2022-02-28', NULL, 2, 0),
(2638, '2638', '2638', 'ด.ญพิมพ์ชนก', 'ปักกะยันตัง', 'หญิง', '2022-02-28', NULL, 2, 0),
(2701, '2701', '2701', 'ด.ญ.ชมัยพร', 'พาพิจิตร', 'หญิง', '2022-02-28', NULL, 1, 0),
(2703, '2703', '2703', 'ด.ช.อดิศร', 'ชัยฤทธิ์', 'ชาย', '2022-03-21', NULL, 2, 0),
(2704, '2704', '2704', 'ด.ญ.กมลวรรณ', 'แซ่ม้า', 'หญิง', '2022-02-28', NULL, 1, 0),
(2767, '2767', '2767', 'ด.ญ.เกศินี', 'นาควงษ์', 'หญิง', '2022-02-28', NULL, 1, 0),
(2795, '2795', '2795', 'ด.ช.สิทธิพงศ์', 'พิศโสภี', 'ชาย', '2022-02-28', NULL, 1, 0),
(2970, '2970', '2970', 'ด.ช.ศิวกร', 'ชนะศึก', 'ชาย', '2022-02-28', NULL, 1, 0),
(2988, '2988', '2988', 'ด.ช.สัญลักษณ์', 'พุ่มด้วง', 'ชาย', '2022-02-28', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `studied_result`
--

CREATE TABLE `studied_result` (
  `id` int(11) NOT NULL,
  `sd_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'รหัสนักเรียน',
  `course_id` varchar(10) NOT NULL COMMENT 'รหัสรายวิชา',
  `midterm_exam_scores` float NOT NULL DEFAULT '0',
  `Final_exam_scores` float NOT NULL DEFAULT '0',
  `midterm_score` float NOT NULL DEFAULT '0',
  `Final_score` float NOT NULL DEFAULT '0',
  `mentality_exam_score` float NOT NULL DEFAULT '0',
  `mentality_score` float NOT NULL DEFAULT '0',
  `gpa` float NOT NULL COMMENT 'เกรด',
  `gpa_term` varchar(20) NOT NULL COMMENT 'ปีการศึกษา',
  `gpa_year` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'ปี',
  `year` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'พ.ศ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ผลการเรียน';

--
-- Dumping data for table `studied_result`
--

INSERT INTO `studied_result` (`id`, `sd_id`, `course_id`, `midterm_exam_scores`, `Final_exam_scores`, `midterm_score`, `Final_score`, `mentality_exam_score`, `mentality_score`, `gpa`, `gpa_term`, `gpa_year`, `year`) VALUES
(1, '2701', 'ค21101', 20, 30, 20, 50, 3, 2, 62.5, '1', '1', '2565');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_rate_data`
--

CREATE TABLE `teacher_rate_data` (
  `id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `tc_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `year` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_rate_data`
--

INSERT INTO `teacher_rate_data` (`id`, `std_id`, `tc_id`, `rate`, `year`, `status`) VALUES
(2, 2701, 1, 5, '2565', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_table`
--

CREATE TABLE `teacher_table` (
  `Tc_id` int(10) NOT NULL COMMENT 'รหัสอาจารย์',
  `Tc_user` varchar(20) NOT NULL COMMENT 'ชื้อผู้ใช้อาจารย์',
  `Tc_password` varchar(40) NOT NULL COMMENT 'รหัสผ่านอาจารย์',
  `Tc_firstname` varchar(50) NOT NULL COMMENT 'ชื้ออาจารย์',
  `Tc_lastname` varchar(50) NOT NULL COMMENT 'นามสกุลอาจารย์',
  `Tc_sex` varchar(5) NOT NULL COMMENT 'เพศอาจารย์',
  `Tc_picture` varchar(200) NOT NULL COMMENT 'ภาพอาจารย์',
  `Tc_department` varchar(100) NOT NULL COMMENT 'ประจำวิชา/ฝ่าย',
  `Tc_position` varchar(100) NOT NULL COMMENT 'ตำแหน่ง',
  `Tc_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ตารางข้อมูลอาจารย์';

--
-- Dumping data for table `teacher_table`
--

INSERT INTO `teacher_table` (`Tc_id`, `Tc_user`, `Tc_password`, `Tc_firstname`, `Tc_lastname`, `Tc_sex`, `Tc_picture`, `Tc_department`, `Tc_position`, `Tc_status`) VALUES
(1, '1234', '1234', 'นายประทีป', 'วงศ์เดช', 'ชาย', '', '3', '1', 0),
(2, '5678', '5678', 'นางสาวจาริณี', 'แสงศรีจันทร์', 'หญิง', '', '1', '2', 0),
(3, '9001', '9001', 'นางสุภาณี', 'รักษาพันธ์', 'หญิง', '', '2', '2', 0),
(4, '42130', '42130', 'test', 'test', 'หญิง', 'image/Tc/42130.jpg', '3', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `yearclass`
--

CREATE TABLE `yearclass` (
  `id` int(11) NOT NULL,
  `yearClassName` varchar(10) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `yearclass`
--

INSERT INTO `yearclass` (`id`, `yearClassName`, `status`) VALUES
(1, 'ป.1', 0),
(2, 'ป.2', 0),
(3, 'ป.3', 0);

-- --------------------------------------------------------

--
-- Structure for view `1`
--
DROP TABLE IF EXISTS `1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `1`  AS  select `student_table`.`Std_ID` AS `Std_id`,`student_table`.`Std_user` AS `Std_user`,`student_table`.`Std_password` AS `Std_password`,`student_table`.`Std_firstname` AS `Std_firstname`,`student_table`.`Std_lastname` AS `Std_lastname`,`student_table`.`Std_sex` AS `Std_sex`,`student_table`.`Std_picture` AS `Std_picture` from `student_table` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addclass_data`
--
ALTER TABLE `addclass_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `administrator_table`
--
ALTER TABLE `administrator_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_table`
--
ALTER TABLE `course_table`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `department_data`
--
ALTER TABLE `department_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_data`
--
ALTER TABLE `position_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_table`
--
ALTER TABLE `student_table`
  ADD PRIMARY KEY (`Std_ID`);

--
-- Indexes for table `studied_result`
--
ALTER TABLE `studied_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_rate_data`
--
ALTER TABLE `teacher_rate_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_table`
--
ALTER TABLE `teacher_table`
  ADD PRIMARY KEY (`Tc_id`);

--
-- Indexes for table `yearclass`
--
ALTER TABLE `yearclass`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addclass_data`
--
ALTER TABLE `addclass_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `administrator_table`
--
ALTER TABLE `administrator_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_data`
--
ALTER TABLE `department_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `position_data`
--
ALTER TABLE `position_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_table`
--
ALTER TABLE `student_table`
  MODIFY `Std_ID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสนักเรียน', AUTO_INCREMENT=2989;

--
-- AUTO_INCREMENT for table `studied_result`
--
ALTER TABLE `studied_result`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `teacher_rate_data`
--
ALTER TABLE `teacher_rate_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_table`
--
ALTER TABLE `teacher_table`
  MODIFY `Tc_id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'รหัสอาจารย์', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `yearclass`
--
ALTER TABLE `yearclass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
