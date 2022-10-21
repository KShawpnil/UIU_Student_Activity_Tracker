-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2022 at 10:20 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uiusatdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `a_id` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `name` varchar(80) DEFAULT NULL,
  `external_file` varchar(100) DEFAULT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `keywords` varchar(200) DEFAULT NULL,
  `file_link` varchar(500) DEFAULT NULL,
  `s_id` varchar(20) NOT NULL,
  `v_id` varchar(20) NOT NULL,
  `is_verified` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`a_id`, `category`, `name`, `external_file`, `description`, `keywords`, `file_link`, `s_id`, `v_id`, `is_verified`) VALUES
(2, 'honors and awards', 'Kazi', 'ee@js.totdd', 'ddddd', 'dd', 'pt2.png', '', 'vvv', 0),
(3, 'internship', 'Kazi Shawpnil', 'www@js.tot', 'sssssssq', 'eedd,ddqq', 'sprint 1.png', '', 'vvv', 0),
(4, 'extra curriculam activities', 'singer', 'https://www.youtube.com/watch?v=aY1ROgBuqyo', 'I like this song', 'sing, music', 'up file.png', '', '', 0),
(5, 'project', 'abc', 'https://www.programiz.com/c-programming/examples/even-odd', 'this is c code', 'c, coding', 'tag.png', '', 'vvv', 0),
(15, 'internship', 'bba', 'https://www.programiz.com/c-programming/examples/even-odd', 'dddddddddddddddddddddddddddddd', 'ddd,ddd', 'AMS1.png', '', '', 0),
(16, 'honors and awards', 'xyz', 'https://www.programiz.com/c-programming/examples/even-odd', 'sssbhcdyugfebhghdsdxcvxhbhcbyugcduhxuyudsm.sss', 'eedd,ddqq', 'search.png', '', '', 0),
(17, 'internship', 'bbacc', 'ee@js.totdddddddddd', 'sssssssquwuifbudrui', 'pp,dj', 'cr nt.png', '', 'xxx', 0),
(18, 'project', 'UIUSAT', 'snjsdee@js.totddd', 'hdsyudygbgvcdsssssssssxzxzx', 'cse,SAD', 'ch ach.png', '', 'xxx', 0),
(19, 'honors and awards', 'dance', 'ee@js.totw', 'hdsyudygbgvcdww', 'ddd,dddww', 'std2.png', '', 'xxx', 0),
(20, 'project', 'UIUSAT', 'uiu@sat.com', 'ssssssssseerrrrrrr', 'uiu,sat', 'AMS.png', '', 'xxx', 0),
(21, 'honors and awards', 'bba', 'ee@js.tot', 'sssssss', 'dd,dd', 'ch ach.png', '', 'vvv', 0),
(23, 'project', 'Automated Water System', 'something.com', 'Water is an important resource. We need to drink water to live. We must save water.', 'water,planet,resource', 'project-1.jpg', '123456789', 'ASD', 1),
(24, 'extra-curricular activities', 'Suma Suma Suma Suma Suma', 'Suma Suma Suma Suma Suma', 'Suma Suma Suma Suma Suma', 'Suma,Suma,Suma,Suma,Suma', 'reference-image-2.jpg', '123456789', 'xxx', 0),
(25, 'project', 'Another Project.', 'whatever', 'Does anyone really care?', 'existential crisis,emotions', 'project-2.jpg', '123456789', 'ASD', 0),
(26, 'internship', 'Internship1', 'Internship1', 'Internship1', 'Internship1', 'project-2.jpg', '123456789', 'ASD', 0),
(27, 'project', 'Superhero Project', 'xyz.com', 'This is a superhero project.', 'dbms project,superheroes', 'batmang1.png', '333222111', 'QWE', 1),
(28, 'honors and awards', 'Scarlet Witch', 'xyz', 'This is another superhero project.', 'dbms,superhero project', 'Scarlet Witch.jpg', '333333333', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `e_id` int(20) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `post_date` date DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_time` varchar(20) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `summary` varchar(2000) DEFAULT NULL,
  `keywords` varchar(200) DEFAULT NULL,
  `guests` varchar(500) DEFAULT NULL,
  `special_members` varchar(500) DEFAULT NULL,
  `v_id` varchar(20) NOT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`e_id`, `name`, `post_date`, `event_date`, `event_time`, `location`, `summary`, `keywords`, `guests`, `special_members`, `v_id`, `image`) VALUES
(8, 'Janina2', '2022-09-09', '2023-11-14', '19:08', 'Janina2', 'Janina2', 'Janina2', 'Janina2', 'Janina2', 'ASD', 'head.jpg'),
(10, 'Yeah, man!', '2022-09-09', '2022-12-22', '05:05', 'Yeah, man!', 'Yeah, man!', 'Yeah, man!, More fun', 'Yeah, man!', 'Yeah, man!', 'ASD', 'header-background.jpg'),
(11, 'Event1', '2022-09-09', '2022-09-22', '08:07', 'Event1', 'Event1', 'Event1', 'Event1', 'Event1', 'ASD', 'project-2.jpg'),
(12, 'Janina5', '2022-09-12', '2022-09-20', '08:07', 'Janina5', 'Janina5', 'Janina5', 'Janina5', 'Janina5', 'ASD', 'Facebook Tag.PNG'),
(14, 'Megahunt 2022', '2022-09-17', '2022-07-13', '15:00', 'Auditorium', 'UIU Megahunt V-10\" is the biggest Intra University Cultural Competition hosted by UIU Cultural Club (UIUCC) which is happening for the 10th consecutive time. ', 'cultural,megahunt,music,dance,recitation', 'Zanzira, Shopon, Alif, Anna', 'Polash, Rakib, Philip', 'ZXC', 'Megahunt.PNG'),
(15, 'CP For Beginners: Season 12', '2022-09-17', '2022-09-23', '15:00', 'Room 600', 'This programming workshop will introduce the programmers to problem-solving, and competitive programming. Therefore, we are going to take an entrance aptitude test to admit selective 30 participants into the workshop, as we are going to hold the workshops in one Lab Room.', 'competitive programming,workshop 2022,workshop for beginners', 'Hatim,Doraemon,Phineas,Zack,Cody', 'India,Pakistan', 'QWE', '306730818_3288018674769824_4680954108775600466_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `n_id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `post_date` date NOT NULL,
  `keywords` varchar(200) NOT NULL,
  `v_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`n_id`, `name`, `content`, `post_date`, `keywords`, `v_id`) VALUES
(1, 'Holiday Notice', 'Blah. Blah. Blah.', '2022-09-09', 'More, Blah, Holiday, Notice', 'ASD'),
(2, 'Alien Hunt Returns', 'Well, you know, supernatural stuff...', '2022-09-09', 'alien, action, rohit shetty, returns', 'ASD'),
(3, 'Notice1', 'obujhsrliuhnbroibn;srit', '2022-09-09', 'rgser,rgsergs,rg,erghserg', 'ASD'),
(4, 'Birthday Of Birthday Person', 'Birthday Of Birthday Person', '2022-09-12', 'flowers, birthday', 'ASD'),
(5, 'Advising (Time & Section Selection), FALL 2022', 'This is to inform all students of CSE Undergraduate Program (students up to 222 Batch) that Course Advising for FALL 2022 Trimester will continue from September 17, 2022 (Saturday) to September 21, 2022 (Wednesday).  Students are required to complete advising through UCAM.  Students admitted in Fall 2022 do not require Course advising.  It will be done by the Department.  In case of any difficulties, students are asked to contact in person from Saturday to Wednesday from 9.30 AM–4.00 PM.  To know all kind of information like notice, mentors list, Course Offerings, class routine, exam routine, etc, please click this link https://cse.uiu.ac.bd/  Please note of the followings:  -The Students who have completed Pre-Advising are asked to select their sections/time on due date.  -The Students who have not completed Pre-Advising yet are asked to contact their Mentors/Advisors.  -Before taking course, students must check class/exam routine to avoid conflicts.  -No section change/Course drop request will be allowed.  -Trimester Drop students are asked to contact the Exam Controller Office for ID activation,  Room # 103 (1st floor)  -Credit Transfer/Course Waiver students are advised to contact CSE Dept. Room # 412 (4th floor)  -For any technical problem, please contact the CITS Department, Room # 525 (5th floor)        Prof. Dr. Salekul Islam  Head, Dept. of CSE       Instructions for Course-Advising (Section & Time Selection) in U-CAM     How to Log in?      Please visit uiu.ac.bd and type your Student ID and password.     If you forget your password or never logged in before, click ‘forget password’ link and put your Student ID there. A link to reset your password will be sent to your official email address. You can reset your password from that link.', '2022-09-17', 'advising fall 2022', 'ASD');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `ntf_id` int(11) NOT NULL,
  `a_id` int(11) DEFAULT NULL,
  `s_id` varchar(11) DEFAULT NULL,
  `v_id` varchar(11) DEFAULT NULL,
  `ntf_status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`ntf_id`, `a_id`, `s_id`, `v_id`, `ntf_status`) VALUES
(1, 22, '123456789', 'ASD', 0),
(5, 22, '123456789', 'QWE', 0),
(6, 23, '123456789', 'ASD', 1),
(7, 26, '123456789', 'QWE', 0),
(8, 27, '333222111', 'QWE', 1),
(9, 28, '333333333', 'QWE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `participates`
--

CREATE TABLE `participates` (
  `p_id` int(11) NOT NULL,
  `s_id` varchar(20) NOT NULL,
  `e_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `participates`
--

INSERT INTO `participates` (`p_id`, `s_id`, `e_id`) VALUES
(8, '123456789', 10),
(9, '111222333', 10),
(11, '123456789', 11),
(12, '111222333', 11),
(13, '123456789', 12),
(16, '111222333', 14),
(17, '123456789', 14),
(18, '333222111', 14),
(19, '333333333', 14),
(20, '987654321', 14),
(21, '111222333', 15),
(23, '333222111', 15),
(24, '333333333', 15),
(25, '987654321', 15),
(26, '123456789', 8),
(27, '123456789', 8);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `s_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `department` varchar(50) NOT NULL,
  `image_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`s_id`, `name`, `phone`, `email`, `password`, `gender`, `dob`, `department`, `image_id`) VALUES
('', 'AAA', '000', 'a@b.c', '0000', 'Female', '2023-01-01', 'CSE', ''),
('011201125', 'Kazi Shawpnil', '01628309498', 'kshawpnil201125@bscse.uiu.ac.bd', 'hello', 'Female', '2000-06-14', 'CSE', ''),
('011201195', 'Kazi Shawpnil', '09821234', 'kshawpnil@gmail.com', '1234', 'Female', '2022-08-28', 'CSE', ''),
('111222333', 'XYZ', '12345', 'a@a.com', '1111', 'Female', '2022-08-28', 'BBA', ''),
('123456789', 'ABCD', '0123', 'a@a.a', '111', 'Male', '2022-09-20', 'EEE', ''),
('333222111', 'Penguin Wayne', '567441', 'loner@antarctica.org', '111', 'Male', '1995-08-19', 'EEE', ''),
('333333333', 'Rupshagorer Rajkonna', '7757476', 'emailnai@emptiness.com', '111', 'Female', '1627-10-30', 'BBA', ''),
('987654321', 'Mr. Apple Man', '4321657980', 'apple@banana.com', '111', 'Male', '1980-04-22', 'BSECO', '');

-- --------------------------------------------------------

--
-- Table structure for table `verifier`
--

CREATE TABLE `verifier` (
  `v_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `department` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `image_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verifier`
--

INSERT INTO `verifier` (`v_id`, `name`, `phone`, `email`, `password`, `gender`, `dob`, `department`, `designation`, `image_id`) VALUES
('', 'vvv', '000', 'v@v.v', '1111', 'Female', '2023-09-01', 'CSE', 'vvv', ''),
('ASD', 'Mr. ASD', '12345', 'a@b.c', '111', 'Male', '2022-09-27', 'BBA', 'Someone', ''),
('QWE', 'Bossman Bose', '196874199', 'punishment@jail.com', '111', 'Male', '1974-12-03', 'BSCE', 'Professor', ''),
('xxx', 'xxxyy', '01833874389', 'x@x.com', 'yes', 'Female', '1997-11-12', 'EEE', 'lecturer', ''),
('ZXC', 'Eliza Jinneth', '7864566671', 'last@email.com', '111', 'Female', '1988-02-07', 'BSAIS', 'Lecturer', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `v_id` (`a_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`e_id`),
  ADD KEY `v_id` (`v_id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`n_id`),
  ADD KEY `v_id` (`v_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`ntf_id`);

--
-- Indexes for table `participates`
--
ALTER TABLE `participates`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `s_id` (`s_id`),
  ADD KEY `e_id` (`e_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `verifier`
--
ALTER TABLE `verifier`
  ADD PRIMARY KEY (`v_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `e_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `n_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `ntf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `participates`
--
ALTER TABLE `participates`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
