-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 11:28 AM
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
-- Database: `db_jobportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(8, 'Arjun', 'arjunpsff@gmail.com', 'Arjun@2025'),
(9, 'praveen1', 'praveen1@gmail.com', 'Praveen');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_application`
--

CREATE TABLE `tbl_application` (
  `application_id` int(11) NOT NULL,
  `application_date` varchar(100) NOT NULL,
  `application_file` varchar(500) NOT NULL,
  `application_status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `jobpost_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_application`
--

INSERT INTO `tbl_application` (`application_id`, `application_date`, `application_file`, `application_status`, `user_id`, `jobpost_id`) VALUES
(2, '2025-07-10', 'cc0ec9ee12d68ae9af646c68eed2ee4b.jpg', 0, 4, 7),
(4, '2025-07-11', '114143.jpg', 1, 4, 4),
(5, '2025-07-11', 'ChatGPT Image May 15, 2025, 11_07_48 PM.png', 2, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_status`) VALUES
(7, 'Sales', 1),
(8, 'Finance', 1),
(9, 'healthcare', 0),
(10, 'Marketing', 1),
(11, 'sales', 0),
(12, 'technology', 0),
(13, 'Marketing', 1),
(14, 'Business Administration', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `company_email` varchar(30) NOT NULL,
  `company_contact` varchar(30) NOT NULL,
  `company_address` varchar(500) NOT NULL,
  `company_logo` varchar(200) NOT NULL,
  `company_license` varchar(500) NOT NULL,
  `company_password` varchar(30) NOT NULL,
  `company_status` int(11) NOT NULL DEFAULT 0,
  `place_id` int(11) NOT NULL,
  `companytype_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`company_id`, `company_name`, `company_email`, `company_contact`, `company_address`, `company_logo`, `company_license`, `company_password`, `company_status`, `place_id`, `companytype_id`) VALUES
(1, 'wolvx', 'arjunpsff@gmail.com', '24542456', 'Edappal', 'JOBVEX.jpg', 'second_graph.jpg', '1234567', 0, 0, 0),
(2, 'wolvx', 'arjunpsff@gmail.com', '24542456', 'Edappal', '', '', '1234567', 1, 7, 0),
(3, 'Arjun', '', '', '', '', '', '', 0, 0, 0),
(4, 'Akshay.k', 'Akshay122@gmail.com', '7489374743', 'littile(house) ', '1345241.png', 'IMG_20230310_233222.jpg', '34233', 1, 7, 0),
(5, 'CARECREW', 'Care23@gmail.com', '7748848412', ' Muvattuppuzha,street No.12,ne', '114220.jpg', 'download.jpeg', 'Sebinpaul199', 1, 7, 0),
(6, 'Indeed', 'indeed@gmail.com', '1234567890', '   Edappal,Malappuram  ', 'JOBVEX.jpg', 'wallpaperflare.com_wallpaper.jpg', '111', 2, 13, 5),
(7, 'Indeed', 'indeed@gmail.com', '933736363', 'Muvattuppuzha,street No.12,near Bus Stand', '3d-rendering-hexagonal-texture-background.jpg', 'MPG-16_9-3840-2160.jpg', '000', 2, 14, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_companytype`
--

CREATE TABLE `tbl_companytype` (
  `companytype_id` int(11) NOT NULL,
  `companytype_name` varchar(30) NOT NULL,
  `companytype_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_companytype`
--

INSERT INTO `tbl_companytype` (`companytype_id`, `companytype_name`, `companytype_status`) VALUES
(2, 'Software Company', 0),
(3, 'Product-based Company', 1),
(4, 'IT consulting firms', 0),
(5, 'Advertisement Company', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(70) NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`, `state_id`, `district_status`) VALUES
(4, 'kottayam', 13, 1),
(5, 'idukki', 13, 1),
(6, 'Palakkad', 13, 1),
(8, 'Bangalore', 16, 0),
(9, 'Ernakulam', 13, 1),
(10, 'Palakkad', 13, 0),
(11, 'Ernakulam', 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam`
--

CREATE TABLE `tbl_exam` (
  `exam_id` int(11) NOT NULL,
  `exam_date` varchar(50) NOT NULL,
  `jobpost_id` int(11) NOT NULL,
  `exam_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_exam`
--

INSERT INTO `tbl_exam` (`exam_id`, `exam_date`, `jobpost_id`, `exam_status`) VALUES
(1, '', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_examtimer`
--

CREATE TABLE `tbl_examtimer` (
  `timer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `current_question_index` int(11) NOT NULL,
  `time_left` int(11) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_examtimer`
--

INSERT INTO `tbl_examtimer` (`timer_id`, `user_id`, `exam_id`, `current_question_index`, `time_left`, `last_updated`) VALUES
(13, 5, 1, 5, 15, '2025-07-14 09:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_joblanguage`
--

CREATE TABLE `tbl_joblanguage` (
  `joblanguage_id` int(11) NOT NULL,
  `jobpost_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `joblanguage_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_joblanguage`
--

INSERT INTO `tbl_joblanguage` (`joblanguage_id`, `jobpost_id`, `language_id`, `joblanguage_status`) VALUES
(1, 4, 2, 0),
(2, 0, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobpost`
--

CREATE TABLE `tbl_jobpost` (
  `jobpost_id` int(11) NOT NULL,
  `jobpost_title` varchar(100) NOT NULL,
  `jobpost_content` varchar(500) NOT NULL,
  `jobpost_date` varchar(50) NOT NULL,
  `jobpost_lastdate` varchar(50) NOT NULL,
  `jobpost_status` int(11) NOT NULL DEFAULT 0,
  `jobpost_experience` varchar(100) NOT NULL,
  `jobtype_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jobpost`
--

INSERT INTO `tbl_jobpost` (`jobpost_id`, `jobpost_title`, `jobpost_content`, `jobpost_date`, `jobpost_lastdate`, `jobpost_status`, `jobpost_experience`, `jobtype_id`, `company_id`, `category_id`) VALUES
(3, 'Branch manager', 'dd', '2025-06-23', '2025-07-11', 0, '3yr', 6, 6, 14),
(4, 'Finance Manager', 'helloo', '2025-06-24', '2025-08-09', 0, '3yr', 2, 6, 11),
(5, 'Administrative Assistant', 'll', '2025-06-24', '2025-06-28', 0, '1yr', 2, 6, 11),
(7, 'Software Engineer', 'sss', '2025-07-03', '2025-07-23', 0, '4yrs', 2, 6, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobqualification`
--

CREATE TABLE `tbl_jobqualification` (
  `jobqualification_id` int(11) NOT NULL,
  `qualification_id` int(11) NOT NULL,
  `jobpost_id` int(11) NOT NULL,
  `jobqualification_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jobqualification`
--

INSERT INTO `tbl_jobqualification` (`jobqualification_id`, `qualification_id`, `jobpost_id`, `jobqualification_status`) VALUES
(1, 6, 4, 0),
(2, 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobtechnicalskill`
--

CREATE TABLE `tbl_jobtechnicalskill` (
  `jobtechnicalskill_id` int(11) NOT NULL,
  `technicalskill_id` int(11) NOT NULL,
  `jobpost_id` int(11) NOT NULL,
  `jobtechnicalskill_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jobtechnicalskill`
--

INSERT INTO `tbl_jobtechnicalskill` (`jobtechnicalskill_id`, `technicalskill_id`, `jobpost_id`, `jobtechnicalskill_status`) VALUES
(1, 2, 3, 1),
(2, 4, 0, 1),
(3, 4, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jobtype`
--

CREATE TABLE `tbl_jobtype` (
  `jobtype_id` int(11) NOT NULL,
  `jobtype_name` varchar(40) NOT NULL,
  `jobtype_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_jobtype`
--

INSERT INTO `tbl_jobtype` (`jobtype_id`, `jobtype_name`, `jobtype_status`) VALUES
(2, 'Full day', 0),
(6, 'Part time', 0),
(7, 'Half Day', 1),
(8, 'Half Day', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_language`
--

CREATE TABLE `tbl_language` (
  `language_id` int(11) NOT NULL,
  `language_name` varchar(30) NOT NULL,
  `language_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_language`
--

INSERT INTO `tbl_language` (`language_id`, `language_name`, `language_status`) VALUES
(2, 'English', 0),
(3, 'Malayalam', 1),
(4, 'Malayalam', 0),
(5, 'Arabic', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_option`
--

CREATE TABLE `tbl_option` (
  `option_id` int(11) NOT NULL,
  `option_options` varchar(200) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_iscorrect` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_option`
--

INSERT INTO `tbl_option` (`option_id`, `option_options`, `question_id`, `option_iscorrect`) VALUES
(1, 'Paris', 1, 1),
(2, 'London', 1, 0),
(3, 'Berlin', 1, 0),
(4, 'Madrid', 1, 0),
(5, 'Venus', 2, 0),
(6, 'Mars', 2, 1),
(7, 'Jupiter', 2, 0),
(8, 'Saturn', 2, 0),
(9, 'Eiffel Tower', 3, 1),
(10, 'Statue of Liberty', 3, 0),
(11, 'Big Ben', 3, 0),
(12, 'Colosseum', 3, 0),
(13, 'Au', 4, 1),
(14, 'Ag', 4, 0),
(15, 'Fe', 4, 0),
(16, 'Cu', 4, 0),
(17, 'Brazil', 5, 1),
(18, 'China', 5, 0),
(19, 'Japan', 5, 0),
(20, 'Australia', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(50) NOT NULL,
  `place_name` varchar(50) NOT NULL,
  `district_id` int(50) NOT NULL,
  `place_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `district_id`, `place_status`) VALUES
(2, 'Nelliyampathy', 0, 0),
(3, 'Nelliyampathy', 6, 0),
(4, 'Ottapalam', 6, 1),
(5, 'Ottapalam', 6, 1),
(13, 'Ottapalam', 10, 0),
(14, 'Muvattupuzha', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qualification`
--

CREATE TABLE `tbl_qualification` (
  `qualification_id` int(11) NOT NULL,
  `qualification_name` varchar(30) NOT NULL,
  `qualification_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_qualification`
--

INSERT INTO `tbl_qualification` (`qualification_id`, `qualification_name`, `qualification_status`) VALUES
(2, 'BCA', 1),
(3, 'MBA', 1),
(4, 'BCA', 0),
(5, 'MBA', 0),
(6, 'BBA', 0),
(7, 'BCOM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_question`
--

CREATE TABLE `tbl_question` (
  `question_id` int(11) NOT NULL,
  `question_title` varchar(100) NOT NULL,
  `question_file` varchar(500) NOT NULL,
  `questioncategory_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_question`
--

INSERT INTO `tbl_question` (`question_id`, `question_title`, `question_file`, `questioncategory_id`, `exam_id`, `question_status`) VALUES
(1, 'What is the capital city of France?', '', 1, 1, 0),
(2, 'Which planet is known as the Red Planet?', '', 1, 1, 0),
(3, 'Identify the monument in the image.', 'eiffel.jpg', 1, 1, 0),
(4, 'What is the chemical symbol for Gold?', '', 1, 1, 0),
(5, 'Which country hosted the 2016 Summer Olympics?', '', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questionanswer`
--

CREATE TABLE `tbl_questionanswer` (
  `answer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL DEFAULT 0,
  `questionanswer_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_questionanswer`
--

INSERT INTO `tbl_questionanswer` (`answer_id`, `user_id`, `option_id`, `question_id`, `questionanswer_date`) VALUES
(66, 5, 2, 1, '2025-07-14 11:16:51'),
(67, 5, 6, 2, '2025-07-14 11:16:54'),
(68, 5, 12, 3, '2025-07-14 11:17:00'),
(69, 5, 14, 4, '2025-07-14 11:17:06'),
(70, 5, 19, 5, '2025-07-14 11:17:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_questioncategory`
--

CREATE TABLE `tbl_questioncategory` (
  `questioncategory_id` int(11) NOT NULL,
  `questioncategory_name` varchar(100) NOT NULL,
  `questioncategory_status` int(11) NOT NULL DEFAULT 0,
  `questioncategory_time` int(11) NOT NULL,
  `questioncategory_mark` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_questioncategory`
--

INSERT INTO `tbl_questioncategory` (`questioncategory_id`, `questioncategory_name`, `questioncategory_status`, `questioncategory_time`, `questioncategory_mark`) VALUES
(1, 'A', 0, 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_state`
--

CREATE TABLE `tbl_state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(30) NOT NULL,
  `state_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_state`
--

INSERT INTO `tbl_state` (`state_id`, `state_name`, `state_status`) VALUES
(2, 'Karnataka', 1),
(8, 'Goa', 0),
(10, 'Tamil Nadu', 0),
(12, 'Tamil Nadu1', 1),
(13, 'Kerala', 0),
(14, 'Tamil Nadu1', 1),
(16, 'Karnataka', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcategory_id` int(50) NOT NULL,
  `subcategory_name` varchar(50) NOT NULL,
  `category_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_technicalskill`
--

CREATE TABLE `tbl_technicalskill` (
  `technicalskill_id` int(11) NOT NULL,
  `technicalskill_name` varchar(30) NOT NULL,
  `technicalskill_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_technicalskill`
--

INSERT INTO `tbl_technicalskill` (`technicalskill_id`, `technicalskill_name`, `technicalskill_status`) VALUES
(2, 'Web development', 0),
(3, 'Technical Writing', 1),
(4, 'Technical Writing', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_contact` varchar(50) NOT NULL,
  `user_address` varchar(300) NOT NULL,
  `user_photo` varchar(300) NOT NULL,
  `user_gender` varchar(50) NOT NULL,
  `user_dob` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_status` int(11) NOT NULL DEFAULT 0,
  `place_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_contact`, `user_address`, `user_photo`, `user_gender`, `user_dob`, `user_password`, `user_status`, `place_id`) VALUES
(1, 'Akash', 'arjunps@gmail.com', '0000', 'ffff', 'IMG_20230310_233222.jpg', 'Male', '2005-08-22', 'wolvx', 1, 7),
(2, 'wolvx', 'arjunpsff@gmail.com', '24542456', 'littile(house)', '', '', '2005-08-22', 'wolvx', 0, 0),
(3, 'arun', 'arjunpsff@gmail.com', '24542456', 'littile(house)', 'hd_ccab872220caff33425e07ee161afef3.jpg', 'Male', '2005-08-22', 'wolvx', 0, 7),
(4, 'Akshay.R', 'akshh@gmail.com', '0000', 'ggggg', '114143.jpg', 'Male', '2004-06-13', '987654321', 0, 15),
(5, 'Aswin', 'Aswin@gmail.com', '22222122', 'Ponnani,Malappuram', '114173.jpg', 'Male', '2003-10-20', '111', 0, 10),
(6, 'Indeed', 'indeed@gmail.com', '', 'Ponnani,Malappuram', '', '', '', '', 0, 0),
(10, 'Arjun', 'test@gmail', '6444444411', 'sss', 'cc0ec9ee12d68ae9af646c68eed2ee4b.jpg', 'Male', '2006-01-31', 'Akshay1234', 0, 13);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userlanguage`
--

CREATE TABLE `tbl_userlanguage` (
  `userlanguage_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `userlanguage_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_userlanguage`
--

INSERT INTO `tbl_userlanguage` (`userlanguage_id`, `language_id`, `user_id`, `userlanguage_status`) VALUES
(1, 2, 4, 0),
(2, 4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_userqualification`
--

CREATE TABLE `tbl_userqualification` (
  `userqualification_id` int(11) NOT NULL,
  `userqualification_certificate` varchar(500) NOT NULL,
  `qualification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `userqualification_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_userqualification`
--

INSERT INTO `tbl_userqualification` (`userqualification_id`, `userqualification_certificate`, `qualification_id`, `user_id`, `userqualification_status`) VALUES
(1, 'JOBVEX.jpg', 4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usertechnicalskill`
--

CREATE TABLE `tbl_usertechnicalskill` (
  `usertechnicalskill_id` int(11) NOT NULL,
  `technicalskill_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `usertechnicalskill_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_usertechnicalskill`
--

INSERT INTO `tbl_usertechnicalskill` (`usertechnicalskill_id`, `technicalskill_id`, `user_id`, `usertechnicalskill_status`) VALUES
(1, 2, 4, 0),
(2, 4, 4, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_application`
--
ALTER TABLE `tbl_application`
  ADD PRIMARY KEY (`application_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `tbl_companytype`
--
ALTER TABLE `tbl_companytype`
  ADD PRIMARY KEY (`companytype_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `tbl_examtimer`
--
ALTER TABLE `tbl_examtimer`
  ADD PRIMARY KEY (`timer_id`);

--
-- Indexes for table `tbl_joblanguage`
--
ALTER TABLE `tbl_joblanguage`
  ADD PRIMARY KEY (`joblanguage_id`);

--
-- Indexes for table `tbl_jobpost`
--
ALTER TABLE `tbl_jobpost`
  ADD PRIMARY KEY (`jobpost_id`);

--
-- Indexes for table `tbl_jobqualification`
--
ALTER TABLE `tbl_jobqualification`
  ADD PRIMARY KEY (`jobqualification_id`);

--
-- Indexes for table `tbl_jobtechnicalskill`
--
ALTER TABLE `tbl_jobtechnicalskill`
  ADD PRIMARY KEY (`jobtechnicalskill_id`);

--
-- Indexes for table `tbl_jobtype`
--
ALTER TABLE `tbl_jobtype`
  ADD PRIMARY KEY (`jobtype_id`);

--
-- Indexes for table `tbl_language`
--
ALTER TABLE `tbl_language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `tbl_option`
--
ALTER TABLE `tbl_option`
  ADD PRIMARY KEY (`option_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_qualification`
--
ALTER TABLE `tbl_qualification`
  ADD PRIMARY KEY (`qualification_id`);

--
-- Indexes for table `tbl_question`
--
ALTER TABLE `tbl_question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `tbl_questionanswer`
--
ALTER TABLE `tbl_questionanswer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `tbl_questioncategory`
--
ALTER TABLE `tbl_questioncategory`
  ADD PRIMARY KEY (`questioncategory_id`);

--
-- Indexes for table `tbl_state`
--
ALTER TABLE `tbl_state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tbl_technicalskill`
--
ALTER TABLE `tbl_technicalskill`
  ADD PRIMARY KEY (`technicalskill_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_userlanguage`
--
ALTER TABLE `tbl_userlanguage`
  ADD PRIMARY KEY (`userlanguage_id`);

--
-- Indexes for table `tbl_userqualification`
--
ALTER TABLE `tbl_userqualification`
  ADD PRIMARY KEY (`userqualification_id`);

--
-- Indexes for table `tbl_usertechnicalskill`
--
ALTER TABLE `tbl_usertechnicalskill`
  ADD PRIMARY KEY (`usertechnicalskill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_application`
--
ALTER TABLE `tbl_application`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_companytype`
--
ALTER TABLE `tbl_companytype`
  MODIFY `companytype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_examtimer`
--
ALTER TABLE `tbl_examtimer`
  MODIFY `timer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_joblanguage`
--
ALTER TABLE `tbl_joblanguage`
  MODIFY `joblanguage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_jobpost`
--
ALTER TABLE `tbl_jobpost`
  MODIFY `jobpost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_jobqualification`
--
ALTER TABLE `tbl_jobqualification`
  MODIFY `jobqualification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_jobtechnicalskill`
--
ALTER TABLE `tbl_jobtechnicalskill`
  MODIFY `jobtechnicalskill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_jobtype`
--
ALTER TABLE `tbl_jobtype`
  MODIFY `jobtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_language`
--
ALTER TABLE `tbl_language`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_option`
--
ALTER TABLE `tbl_option`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_qualification`
--
ALTER TABLE `tbl_qualification`
  MODIFY `qualification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_question`
--
ALTER TABLE `tbl_question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_questionanswer`
--
ALTER TABLE `tbl_questionanswer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_questioncategory`
--
ALTER TABLE `tbl_questioncategory`
  MODIFY `questioncategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_state`
--
ALTER TABLE `tbl_state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcategory_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_technicalskill`
--
ALTER TABLE `tbl_technicalskill`
  MODIFY `technicalskill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_userlanguage`
--
ALTER TABLE `tbl_userlanguage`
  MODIFY `userlanguage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_userqualification`
--
ALTER TABLE `tbl_userqualification`
  MODIFY `userqualification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_usertechnicalskill`
--
ALTER TABLE `tbl_usertechnicalskill`
  MODIFY `usertechnicalskill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
