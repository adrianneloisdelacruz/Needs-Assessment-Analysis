-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2023 at 06:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `needassessment_db`
--
CREATE DATABASE IF NOT EXISTS `needassessment_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `needassessment_db`;

-- --------------------------------------------------------

--
-- Table structure for table `age_bracket`
--

DROP TABLE IF EXISTS `age_bracket`;
CREATE TABLE `age_bracket` (
  `ab_id` int(11) NOT NULL,
  `age_from` varchar(15) NOT NULL,
  `age_to` varchar(15) NOT NULL,
  `choice_no` varchar(25) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `age_bracket`
--

TRUNCATE TABLE `age_bracket`;
--
-- Dumping data for table `age_bracket`
--

INSERT INTO `age_bracket` (`ab_id`, `age_from`, `age_to`, `choice_no`, `date_created`) VALUES
(1, '8', '12', '1', '2023-02-28 11:32:34'),
(2, '13', '19', '2', '2023-02-28 11:32:34'),
(3, '20', 'Above', '3', '2023-02-28 11:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_main_info`
--

DROP TABLE IF EXISTS `assessment_main_info`;
CREATE TABLE `assessment_main_info` (
  `assessment_id` int(11) NOT NULL,
  `family_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `home_address` varchar(150) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `barangay` int(11) DEFAULT NULL,
  `contact_no` text DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `namehouseholdhead` varchar(65) DEFAULT NULL,
  `relationshiphouseholdhead` varchar(50) DEFAULT NULL,
  `gender` varchar(25) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `ageinlastbirthday` int(11) DEFAULT NULL,
  `stillstudying` varchar(10) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `education` varchar(65) DEFAULT NULL,
  `maritalstatus` varchar(35) DEFAULT NULL,
  `primarysourceincome` varchar(65) DEFAULT NULL,
  `regularincome` varchar(65) DEFAULT NULL,
  `workskills` varchar(100) DEFAULT NULL,
  `monthlyincome` decimal(6,2) DEFAULT NULL,
  `philhealth` varchar(25) DEFAULT NULL,
  `election` varchar(25) DEFAULT NULL,
  `taxpayer` varchar(25) DEFAULT NULL,
  `mobileno` varchar(15) DEFAULT NULL,
  `communityassemblies` varchar(5) DEFAULT NULL,
  `listprograms` text DEFAULT NULL,
  `whodoyoutofirst` text DEFAULT NULL,
  `wheredoyougettreatment` text DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `no_benefits` tinyint(4) DEFAULT NULL,
  `intend_beneficiary` tinyint(4) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `assessment_main_info`
--

TRUNCATE TABLE `assessment_main_info`;
-- --------------------------------------------------------

--
-- Table structure for table `barangay`
--

DROP TABLE IF EXISTS `barangay`;
CREATE TABLE `barangay` (
  `barangay_id` int(11) NOT NULL,
  `barangay_name` varchar(150) NOT NULL,
  `zip_code` varchar(25) DEFAULT NULL,
  `zone` varchar(50) NOT NULL,
  `district` varchar(50) DEFAULT NULL,
  `city` varchar(65) NOT NULL,
  `region` varchar(150) NOT NULL,
  `province` varchar(100) DEFAULT NULL,
  `contact_no` varchar(15) NOT NULL,
  `project_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `barangay`
--

TRUNCATE TABLE `barangay`;
--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`barangay_id`, `barangay_name`, `zip_code`, `zone`, `district`, `city`, `region`, `province`, `contact_no`, `project_id`, `course_id`, `date_created`) VALUES
(1, 'ALICIA', NULL, '168', 'district 1', 'QUEZON CITY', 'NATIONAL CAPITAL REGION', 'METRO MANILA', '', 0, 0, '2023-02-28 14:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(150) DEFAULT NULL,
  `category_description` text DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `category`
--

TRUNCATE TABLE `category`;
--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `date_created`, `date_modified`) VALUES
(1, 'Computer Hardware', NULL, NULL, NULL),
(2, 'Computer Software', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_category`
--

DROP TABLE IF EXISTS `course_category`;
CREATE TABLE `course_category` (
  `course_id` int(11) NOT NULL,
  `course_title` varchar(65) NOT NULL,
  `course_description` varchar(150) NOT NULL,
  `project_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `course_category`
--

TRUNCATE TABLE `course_category`;
--
-- Dumping data for table `course_category`
--

INSERT INTO `course_category` (`course_id`, `course_title`, `course_description`, `project_id`, `date_created`) VALUES
(1, 'BSIT', 'Bachelor of Science in information Technology', 0, '2023-02-26 14:52:12'),
(3, 'BSCS', 'Bachelor of Science in Computer Science', 0, '2023-02-26 15:10:36'),
(4, 'BSMATH', 'Bachelor of Science in Mathematics', 0, '2023-02-26 15:10:36'),
(7, 'BSPSYCH', ' Bachelor of Science in PSHYCOLOGY', 0, '2023-03-18 01:29:19'),
(8, 'BSAP', ' Bachelor of Science in Applied Physics', 0, '2023-03-18 01:29:20');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_form`
--

DROP TABLE IF EXISTS `evaluation_form`;
CREATE TABLE `evaluation_form` (
  `na_id` int(11) NOT NULL,
  `na_barangay` varchar(150) DEFAULT NULL,
  `na_district` varchar(50) DEFAULT NULL,
  `na_city` varchar(65) DEFAULT NULL,
  `na_region` varchar(65) DEFAULT NULL,
  `na_community_description` text DEFAULT NULL,
  `na_community_needs` text DEFAULT NULL,
  `na_reference_date` timestamp NULL DEFAULT NULL,
  `na_program` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `evaluation_form`
--

TRUNCATE TABLE `evaluation_form`;
-- --------------------------------------------------------

--
-- Table structure for table `extension_project`
--

DROP TABLE IF EXISTS `extension_project`;
CREATE TABLE `extension_project` (
  `extension_id` int(11) NOT NULL,
  `extension_project_title` varchar(250) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `community_name` varchar(100) NOT NULL,
  `project_leader` varchar(100) DEFAULT NULL,
  `college_school_name` varchar(250) DEFAULT NULL,
  `members` text DEFAULT NULL,
  `barangay` int(11) DEFAULT NULL,
  `personel_involved` varchar(50) DEFAULT NULL,
  `project_beneficiaries` varchar(150) NOT NULL,
  `project_implemented_date` date DEFAULT NULL,
  `project_start_date` date DEFAULT NULL,
  `project_end_date` date DEFAULT NULL,
  `project_time` varchar(50) DEFAULT NULL,
  `project_duration` int(11) DEFAULT NULL,
  `age_bracket` varchar(50) DEFAULT NULL,
  `total_score` varchar(10) DEFAULT NULL,
  `evaluator_name` varchar(100) DEFAULT NULL,
  `reference_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `extension_project`
--

TRUNCATE TABLE `extension_project`;
-- --------------------------------------------------------

--
-- Table structure for table `household_members`
--

DROP TABLE IF EXISTS `household_members`;
CREATE TABLE `household_members` (
  `hm_id` int(11) NOT NULL,
  `household_name` varchar(100) NOT NULL,
  `relationshiip_household_head` varchar(50) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `birthdate` date NOT NULL,
  `age_last_birthday` tinyint(4) NOT NULL,
  `still_studying` varchar(5) NOT NULL,
  `religion` varchar(35) NOT NULL,
  `marital_status` varchar(25) NOT NULL,
  `education` varchar(35) NOT NULL,
  `primary_income` varchar(50) NOT NULL,
  `regular_income` varchar(50) NOT NULL,
  `work_skills` varchar(50) NOT NULL,
  `monthly_income` decimal(6,2) NOT NULL,
  `philhealth` varchar(5) NOT NULL,
  `election` varchar(5) NOT NULL,
  `tax_payer` varchar(5) NOT NULL,
  `mobile_no` varchar(15) NOT NULL,
  `assessment_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `household_members`
--

TRUNCATE TABLE `household_members`;
-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `extension_id` int(11) NOT NULL,
  `firstname` int(11) DEFAULT NULL,
  `lastname` int(11) DEFAULT NULL,
  `reference_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `members`
--

TRUNCATE TABLE `members`;
-- --------------------------------------------------------

--
-- Table structure for table `needs_assessement_recommendation`
--

DROP TABLE IF EXISTS `needs_assessement_recommendation`;
CREATE TABLE `needs_assessement_recommendation` (
  `reco_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `target_beneficiaries` tinyint(4) DEFAULT NULL,
  `actual_beneficiaries` tinyint(4) DEFAULT NULL,
  `barangay_id` int(11) DEFAULT NULL,
  `zone` varchar(35) NOT NULL,
  `age_bracket` varchar(50) DEFAULT NULL,
  `project_duration` varchar(65) DEFAULT NULL,
  `available_time` varchar(65) DEFAULT NULL,
  `days_covered` varchar(100) DEFAULT NULL,
  `total_hours` tinyint(4) NOT NULL,
  `implementation_date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '0=create,1=ongoing,2=done',
  `filename` text DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `needs_assessement_recommendation`
--

TRUNCATE TABLE `needs_assessement_recommendation`;
-- --------------------------------------------------------

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
CREATE TABLE `program` (
  `program_id` int(11) NOT NULL,
  `program_title` varchar(250) DEFAULT NULL,
  `program_keyword` text DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `target_beneficiaries` tinyint(4) DEFAULT NULL,
  `actual_beneficiaries` tinyint(4) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `program`
--

TRUNCATE TABLE `program`;
--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_id`, `program_title`, `program_keyword`, `course_id`, `target_beneficiaries`, `actual_beneficiaries`, `start_date`, `end_date`, `start_time`, `end_time`, `date_created`, `date_modified`) VALUES
(1, 'Basic Programming', 'INTRODUCTION_BASIC_COMPUTER', 3, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-26 15:15:07', '2023-02-26 15:15:07'),
(2, 'Word Processing', 'COMPUTER_MICROSOFT_ADVANCE_LEARNING', 3, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-26 15:15:07', '2023-02-26 15:15:07'),
(3, 'Graphics Design', 'CREATING_WEBPAGE_HTML_GRAPHICS_DESIGN_PHTOSHOP_ADOBE_CANVA', 3, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-26 22:28:47', '0000-00-00 00:00:00'),
(4, 'Multimedia Presentation', 'microsoft_word_excel_data_entry_presentation_powerpoint_basic_computer_canva', 3, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-26 22:35:34', '0000-00-00 00:00:00'),
(5, 'Spreadsheet Application', 'excel_microsoft_computer', 3, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-26 22:35:34', '0000-00-00 00:00:00'),
(6, 'PC Troubleshooting', 'hardware_technical_basic_computer', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-26 22:36:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `program_schedule`
--

DROP TABLE IF EXISTS `program_schedule`;
CREATE TABLE `program_schedule` (
  `schedule_id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `course_id` int(11) NOT NULL,
  `program_duration` varchar(150) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `total_hours` varchar(25) NOT NULL,
  `days_covered` varchar(150) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `program_schedule`
--

TRUNCATE TABLE `program_schedule`;
--
-- Dumping data for table `program_schedule`
--

INSERT INTO `program_schedule` (`schedule_id`, `project_id`, `program_id`, `course_id`, `program_duration`, `start_time`, `end_time`, `total_hours`, `days_covered`, `date_created`, `date_modified`) VALUES
(2, NULL, 1, 3, '5 days', '13:00:00', '22:00:00', '', 'Monday,Wednesday,Friday,Sunday,', '2023-03-01 14:31:28', '2023-03-07 06:47:21'),
(3, NULL, 1, 3, '5 days', '13:00:00', '18:00:00', '', 'Monday,Wednesday,Friday,', '2023-03-01 14:31:33', '0000-00-00 00:00:00'),
(6, NULL, 7, 1, '10 days', '08:00:00', '12:00:00', '', 'Tuesday,Thursday,', '2023-03-17 02:33:26', '0000-00-00 00:00:00'),
(7, NULL, 2, 3, '10 days', '13:00:00', '17:00:00', '', 'Monday,Friday,', '2023-03-17 02:34:17', '0000-00-00 00:00:00'),
(8, NULL, 2, 3, '10 days', '13:00:00', '17:00:00', '', 'Monday,Friday,', '2023-03-17 02:34:24', '0000-00-00 00:00:00'),
(9, NULL, 4, 3, '10 days', '08:00:00', '10:00:00', '', 'Tuesday,Thursday,Saturday,', '2023-03-17 02:35:07', '0000-00-00 00:00:00'),
(10, NULL, 5, 3, '10 days', '14:00:00', '17:00:00', '', 'Wednesday,Thursday,', '2023-03-17 02:35:53', '0000-00-00 00:00:00'),
(11, NULL, 3, 3, '10 days', '10:00:00', '12:00:00', '', 'Monday,Tuesday,Wednesday,', '2023-03-17 12:09:31', '0000-00-00 00:00:00'),
(12, NULL, 6, 1, '10 days', '13:30:00', '18:30:00', '', 'Wednesday,Thursday,', '2023-03-18 00:42:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `project_id` int(11) NOT NULL,
  `project_title` varchar(250) DEFAULT NULL,
  `project_description` text DEFAULT NULL,
  `course_category` int(11) DEFAULT NULL,
  `string_keyword` text DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `project`
--

TRUNCATE TABLE `project`;
--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_title`, `project_description`, `course_category`, `string_keyword`, `date_created`, `date_modified`) VALUES
(1, 'INTRODUCTION TO BASIC COMPUTER', 'INTRODUCTION TO BASIC COMPUTER', 3, 'word_processing_software_spreadsheet_data_entry_presentation_email  ', '2023-02-15 13:44:31', '2023-03-07 03:46:46'),
(2, 'TRANSCENDING EXCELLENCE THROUGH COMPUTER', 'TRANSCENDING EXCELLENCE THROUGH COMPUTER', 3, 'word_processing_software_spreadsheet_data_entry_presentation_email_online_programs_virtual ', '2023-02-15 13:44:31', '2023-02-27 01:58:32'),
(3, 'COMPUTER and MICROSOFT ADVANCE LEARNING', 'COMPUTER and MICROSOFT ADVANCE LEARNING', 3, 'microsoft_word_excel_data_entry_presentation_powerpoint_email_365_word_processing', '2023-02-15 13:44:31', '2023-02-27 02:01:50'),
(4, 'BASIC KNOWLEDGE IN MICROSOFT OFFICE', 'BASIC KNOWLEDGE IN MICROSOFT OFFICE', 3, 'microsoft_word_excel_data_entry_presentation_powerpoint_email_365_entrylevel_basic_office_word_processing', '2023-02-15 13:44:31', '2023-02-27 02:02:38'),
(5, 'INTRODUCTION TO BASIC MICROSOFT OFFICE', 'INTRODUCTION TO BASIC MICROSOFT OFFICE', 3, 'microsoft_word_excel_data_entry_presentation_powerpoint_email_365_entrylevel_basic_office_notes_word_processing', '2023-02-15 13:47:35', '2023-02-27 02:03:11'),
(6, 'CREATING A WEBPAGE USING HTML', 'CREATING A WEBPAGE USING HTML', 3, 'creating_webpage_html_web_program_javascript_msoffice_css_web_basic_programming', '2023-02-15 13:47:35', '2023-02-27 02:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `project_beneficiaries`
--

DROP TABLE IF EXISTS `project_beneficiaries`;
CREATE TABLE `project_beneficiaries` (
  `pb_id` int(11) NOT NULL,
  `project_beneficiary_target` tinyint(4) DEFAULT NULL,
  `project_beneficiary_actual` tinyint(4) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `agency_id` int(11) DEFAULT NULL,
  `baranggay_id` int(11) DEFAULT NULL,
  `project_date` datetime DEFAULT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `project_beneficiaries`
--

TRUNCATE TABLE `project_beneficiaries`;
--
-- Dumping data for table `project_beneficiaries`
--

INSERT INTO `project_beneficiaries` (`pb_id`, `project_beneficiary_target`, `project_beneficiary_actual`, `project_id`, `course_id`, `agency_id`, `baranggay_id`, `project_date`, `date_modified`) VALUES
(1, 25, 45, 1, 0, 0, 0, '0000-00-00 00:00:00', '2023-03-07 03:46:46'),
(2, 25, 0, 2, 0, 0, 0, '0000-00-00 00:00:00', '2023-02-27 01:58:32'),
(3, 25, 0, 3, 0, 0, 0, '0000-00-00 00:00:00', '2023-02-27 02:01:50'),
(4, 25, 0, 4, 0, 0, 0, '0000-00-00 00:00:00', '2023-02-27 02:02:38'),
(5, 25, 0, 5, 0, 0, 0, '0000-00-00 00:00:00', '2023-02-27 02:03:11'),
(6, 25, 0, 6, 0, 0, 0, '0000-00-00 00:00:00', '2023-02-27 02:04:43');

-- --------------------------------------------------------

--
-- Table structure for table `project_evaluation`
--

DROP TABLE IF EXISTS `project_evaluation`;
CREATE TABLE `project_evaluation` (
  `project_eval_id` int(11) NOT NULL,
  `extension_project_title` varchar(250) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `reco_id` int(11) DEFAULT NULL,
  `community_name` varchar(100) NOT NULL,
  `project_leader` varchar(100) DEFAULT NULL,
  `college_school_name` varchar(250) DEFAULT NULL,
  `members` text DEFAULT NULL,
  `barangay` int(11) DEFAULT NULL,
  `personel_involved` varchar(50) DEFAULT NULL,
  `project_beneficiaries` varchar(150) NOT NULL,
  `project_implemented_date` date DEFAULT NULL,
  `project_start_date` date DEFAULT NULL,
  `project_end_date` date DEFAULT NULL,
  `project_time` varchar(50) DEFAULT NULL,
  `project_duration` int(11) DEFAULT NULL,
  `age_bracket` varchar(50) DEFAULT NULL,
  `total_score` varchar(10) DEFAULT NULL,
  `evaluator_name` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `comments` text DEFAULT NULL,
  `reference_date` date DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `project_evaluation`
--

TRUNCATE TABLE `project_evaluation`;
-- --------------------------------------------------------

--
-- Table structure for table `recommendation_result`
--

DROP TABLE IF EXISTS `recommendation_result`;
CREATE TABLE `recommendation_result` (
  `reco_id` int(11) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date_created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `recommendation_result`
--

TRUNCATE TABLE `recommendation_result`;
-- --------------------------------------------------------

--
-- Table structure for table `responded_program`
--

DROP TABLE IF EXISTS `responded_program`;
CREATE TABLE `responded_program` (
  `id` int(11) NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `no_benefits` tinyint(4) NOT NULL,
  `intend_beneficiary` tinyint(4) NOT NULL,
  `assessment_id` int(11) NOT NULL,
  `string_keyword` varchar(150) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `barangay` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `responded_program`
--

TRUNCATE TABLE `responded_program`;
-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` text DEFAULT NULL,
  `role_description` varchar(100) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `role`
--

TRUNCATE TABLE `role`;
--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_description`, `date_created`, `date_modified`) VALUES
(1, 'SuperAdmin', 'Have access to all', '2023-02-27 15:09:21', NULL),
(2, 'Admin', 'Fewer access', '2023-02-27 15:09:21', NULL),
(3, 'Coordinator', 'Selected Access Only', '2023-02-27 15:09:21', NULL),
(4, 'Barangay Admin', 'Selected Access Only', '2023-02-27 15:09:21', NULL),
(5, 'Encoder', 'Selected Access Only', '2023-02-27 15:09:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(60) DEFAULT NULL,
  `user_lastname` varchar(60) DEFAULT NULL,
  `username` varchar(15) NOT NULL,
  `userpass` varchar(10) NOT NULL,
  `user_role` int(11) DEFAULT NULL,
  `barangay` int(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `status` tinyint(11) DEFAULT 0 COMMENT '0=active, 1=inactive',
  `date_created` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_lastname`, `username`, `userpass`, `user_role`, `barangay`, `email`, `status`, `date_created`, `date_modified`) VALUES
(1, 'Super', 'Admin', 'admin', 'admin123', 1, NULL, '', NULL, '2023-02-27 15:01:59', NULL),
(4, 'Mark', 'Jess', 'mark', '11111', 3, 1, 'mark@mmail.com', 0, '2023-03-07 07:24:35', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `age_bracket`
--
ALTER TABLE `age_bracket`
  ADD PRIMARY KEY (`ab_id`);

--
-- Indexes for table `assessment_main_info`
--
ALTER TABLE `assessment_main_info`
  ADD PRIMARY KEY (`assessment_id`);

--
-- Indexes for table `barangay`
--
ALTER TABLE `barangay`
  ADD PRIMARY KEY (`barangay_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `course_category`
--
ALTER TABLE `course_category`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `evaluation_form`
--
ALTER TABLE `evaluation_form`
  ADD PRIMARY KEY (`na_id`);

--
-- Indexes for table `extension_project`
--
ALTER TABLE `extension_project`
  ADD PRIMARY KEY (`extension_id`);

--
-- Indexes for table `household_members`
--
ALTER TABLE `household_members`
  ADD PRIMARY KEY (`hm_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `needs_assessement_recommendation`
--
ALTER TABLE `needs_assessement_recommendation`
  ADD PRIMARY KEY (`reco_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`);

--
-- Indexes for table `program_schedule`
--
ALTER TABLE `program_schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`project_id`);
ALTER TABLE `project` ADD FULLTEXT KEY `string_keyword` (`string_keyword`);

--
-- Indexes for table `project_beneficiaries`
--
ALTER TABLE `project_beneficiaries`
  ADD PRIMARY KEY (`pb_id`);

--
-- Indexes for table `project_evaluation`
--
ALTER TABLE `project_evaluation`
  ADD PRIMARY KEY (`project_eval_id`);

--
-- Indexes for table `responded_program`
--
ALTER TABLE `responded_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `age_bracket`
--
ALTER TABLE `age_bracket`
  MODIFY `ab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assessment_main_info`
--
ALTER TABLE `assessment_main_info`
  MODIFY `assessment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `barangay`
--
ALTER TABLE `barangay`
  MODIFY `barangay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_category`
--
ALTER TABLE `course_category`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `evaluation_form`
--
ALTER TABLE `evaluation_form`
  MODIFY `na_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extension_project`
--
ALTER TABLE `extension_project`
  MODIFY `extension_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `household_members`
--
ALTER TABLE `household_members`
  MODIFY `hm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `needs_assessement_recommendation`
--
ALTER TABLE `needs_assessement_recommendation`
  MODIFY `reco_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `program_schedule`
--
ALTER TABLE `program_schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `project_beneficiaries`
--
ALTER TABLE `project_beneficiaries`
  MODIFY `pb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project_evaluation`
--
ALTER TABLE `project_evaluation`
  MODIFY `project_eval_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `responded_program`
--
ALTER TABLE `responded_program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
