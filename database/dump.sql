-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: ar_db
-- Generation Time: Dec 07, 2020 at 06:55 AM
-- Server version: 8.0.22
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clean`
--

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

CREATE TABLE `apply` (
  `id` int UNSIGNED NOT NULL,
  `profile_id` int UNSIGNED DEFAULT NULL,
  `recruitment_id` int UNSIGNED DEFAULT NULL,
  `result` int DEFAULT NULL,
  `portfolio` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sop` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alumni` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int DEFAULT '0',
  `interview` int NOT NULL DEFAULT '0',
  `sentdept` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int UNSIGNED NOT NULL,
  `faculty_id` int UNSIGNED DEFAULT NULL,
  `department` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `faculty_id`, `department`, `name`, `name_en`, `user`, `created_at`, `updated_at`) VALUES
(1, 1, 'วิศวกรรมคอมพิวเตอร์', 'วิศวกรรมคอมพิวเตอร์', 'Computer Engineering', NULL, NULL, '2020-11-26 10:37:20'),
(2, 1, 'วิศวกรรมคอมพิวเตอร์', 'วิศวกรรมคอมพิวเตอร์ (หลักสูตรนานาชาติ)', 'Computer Engineering (International Program)', NULL, NULL, '2020-11-26 10:37:18'),
(3, 1, 'วิศวกรรมคอมพิวเตอร์', 'วิทยาศาสตร์ข้อมูลสุขภาพ', 'Health Data Science', NULL, NULL, '2020-11-26 10:37:23'),
(4, 1, 'วิศวกรรมเคมี', 'วิศวกรรมเคมี', 'Chemical Engineering', NULL, NULL, '2020-10-26 10:18:32'),
(5, 1, 'วิศวกรรมเคมี', 'วิศวกรรมเคมี (หลักสูตรนานาชาติ)', 'Chemical Engineering (International Program)', NULL, NULL, NULL),
(6, 1, 'วิศวกรรมเครื่องกล', 'วิศวกรรมเครื่องกล', 'Mechanical Engineering', NULL, NULL, '2020-11-26 09:14:56'),
(7, 1, 'วิศวกรรมเครื่องกล', 'วิศวกรรมเครื่องกลและพลังงาน', 'Mechanical and Energy Engineering', NULL, NULL, '2020-11-26 09:14:54'),
(8, 1, 'วิศวกรรมเครื่องกล', 'วิศวกรรมยานยนต์', 'Automotive Engineering', NULL, NULL, '2020-11-26 09:14:51'),
(9, 1, 'วิศวกรรมเครื่องมือ', 'วิศวกรรมเครื่องมือ', 'Tool Engineering', NULL, NULL, '2020-10-26 11:15:39'),
(10, 1, 'วิศวกรรมเครื่องมือ', 'วิศวกรรมวัสดุ', 'Materials Engineering', NULL, NULL, NULL),
(11, 1, 'วิศวกรรมเครื่องมือ', 'วิศวกรรมการผลิตชิ้นส่วนยานยนต์และอากาศยานสมัยใหม่', 'วิศวกรรมการผลิตชิ้นส่วนยานยนต์และอากาศยานสมัยใหม่', NULL, NULL, NULL),
(12, 1, 'วิศวกรรมเครื่องมือ', 'วิศวกรรมการผลิตชิ้นส่วนยานยนต์และท่าอากาศยานสมัยใหม่ (Non Age Group)', 'วิศวกรรมการผลิตชิ้นส่วนยานยนต์ และอากาศยานสมัยใหม่ (Non Age Group)', NULL, NULL, NULL),
(13, 1, 'วิศวกรรมไฟฟ้า', 'วิศวกรรมไฟฟ้า', 'Electrical Engineering', NULL, NULL, NULL),
(14, 1, 'วิศวกรรมไฟฟ้า', 'วิศวกรรมไฟฟ้า (ระบบไฟฟ้า อิเล็กทรอนิกส์ กำลังและพลังงาน)', 'Electrical Engineering (Power System, Power Electronics and Energy)', NULL, NULL, NULL),
(15, 1, 'วิศวกรรมอิเล็กทรอนิกส์และโทรคมนาคม', 'วิศวกรรมไฟฟ้าสื่อสารและอิเล็กทรอนิกส์', 'Electrical Communication and Electronic Engineering', NULL, NULL, NULL),
(16, 1, 'วิศวกรรมอิเล็กทรอนิกส์และโทรคมนาคม', 'วิศวกรรมไฟฟ้าสื่อสารและอิเล็กทรอนิกส์ (หลักสูตรนานาชาติ)', 'Electrical Communication and Electronic Engineering (International Program)', NULL, NULL, NULL),
(17, 1, 'วิศวกรรมอุตสาหการ', 'วิศวกรรมอุตสาหการ', 'Production Engineering', NULL, NULL, NULL),
(18, 1, 'วิศวกรรมอุตสาหการ', 'วิศวกรรมเมคคาทรอนิกส์', 'Mechatronics Engineering', NULL, NULL, NULL),
(19, 1, 'วิศวกรรมโยธา', 'วิศวกรรมโยธา', 'Civil Engineering', NULL, NULL, NULL),
(20, 1, 'วิศวกรรมโยธา', 'วิศวกรรมโยธา (หลักสูตรนานาชาติ)', 'Civil Engineering (International Program)', NULL, NULL, NULL),
(21, 1, 'วิศวกรรมสิ่งแวดล้อม', 'วิศวกรรมสิ่งแวดล้อม', 'Environmental Engineering', NULL, NULL, NULL),
(22, 1, 'วิศวกรรมสิ่งแวดล้อม', 'วิศวกรรมสิ่งแวดล้อม (หลักสูตรนานาชาติ)', 'Environmental Engineering (International Program)', NULL, NULL, NULL),
(23, 1, 'วิศวกรรมระบบควบคุมและเครื่องมือวัด', 'วิศวกรรมระบบควบคุมและเครื่องมือวัด', 'Control Systems and Instrumentation Engineering', NULL, NULL, NULL),
(24, 1, 'วิศวกรรมระบบควบคุมและเครื่องมือวัด', 'วิศวกรรมระบบควบคุมและเครื่องมือวัด (สหกิจศึกษา)', 'Control Systems and Instrumentation Engineering (Co-operative Education Program) ', NULL, NULL, NULL),
(25, 1, 'วิศวกรรมระบบควบคุมและเครื่องมือวัด', 'วิศวกรรมอัตโนมัติ (หลักสูตรนานาชาติ)', 'Automation Engineering (International Program)', NULL, NULL, NULL),
(26, 1, 'พื้นที่การศึกษาราชบุรี', 'วิศวกรรมเครื่องกล (มจธ.ราชบุรี)', 'Mechanical Engineering (KMUTT Ratchaburi)', NULL, NULL, NULL),
(27, 1, 'พื้นที่การศึกษาราชบุรี', 'วิศวกรรมอุตสาหการ (มจธ.ราชบุรี)', 'Production Engineering (KMUTT Ratchaburi)', NULL, NULL, NULL),
(28, 1, 'พื้นที่การศึกษาราชบุรี', 'วิศวกรรมคอมพิวเตอร์ (มจธ.ราชบุรี)', 'Computer Engineering (KMUTT Ratchaburi)', NULL, NULL, '2020-09-02 01:40:22'),
(29, 2, 'เทคโนโลยีและสื่อสารการศึกษา', 'เทคโนโลยีการศึกษาและสื่อสารมวลชน', 'Educational Technology and Mass Communication', NULL, NULL, NULL),
(30, 2, 'เทคโนโลยีการพิมพ์และบรรจุภัณฑ์', 'เทคโนโลยีบรรจุภัณฑ์และการพิมพ์', 'Packaging and  Printing Technology', NULL, NULL, NULL),
(31, 2, 'คอมพิวเตอร์และเทคโนโลยีสารสนเทศ', 'วิทยาการคอมพิวเตอร์ประยุกต์-มัลติมีเดีย', 'Applied Computer Science-Multimedia', NULL, NULL, NULL),
(32, 2, 'ครุศาสตร์เครื่องกล', 'วิศวกรรมเครื่องกล (ค.อ.บ. 5 ปี)', 'Mechanical Engineering (B.S.Ind. Ed. 5 years)', NULL, NULL, NULL),
(33, 2, 'ครุศาสตร์โยธา', 'วิศวกรรมโยธา (ค.อ.บ. 5 ปี)', 'Civil Engineering (B.Sc.Ind.Ed. 5 years', NULL, NULL, NULL),
(34, 2, 'ครุศาสตร์อุตสาหการ', 'วิศวกรรมอุตสาหการ (ค.อ.บ. 5 ปี)', 'Production Engineering (B.S. Ind. Ed. 5 years)', NULL, NULL, NULL),
(35, 2, 'ครุศาสตร์ไฟฟ้า', 'วิศวกรรมไฟฟ้า - วิชาเอกไฟฟ้ากำลัง', 'Electrical Engineering - Electrical Power Engineering (B.S.Ind.Ed. 5 years)', NULL, NULL, NULL),
(36, 2, 'ครุศาสตร์ไฟฟ้า', 'วิศวกรรมไฟฟ้า - วิชาเอกอิเล็กทรอนิกส์', 'Electrical Engineering - Electronics Engineering (B.S.Ind.Ed. 5 years', NULL, NULL, '2020-11-12 07:11:14'),
(37, 2, 'ครุศาสตร์ไฟฟ้า', 'วิศวกรรมไฟฟ้า - วิชาเอกคอมพิวเตอร์', 'Electrical Engineering - Computer Engineering (B.S.Ind.Ed. 5 years)', NULL, NULL, NULL),
(38, 2, NULL, 'เทคโนโลยีอุตสาหกรรม - วิชาเอกเทคโนโลยีโยธา', 'Industrial Technology (B.Tech. Civil Technology)', NULL, NULL, NULL),
(39, 2, NULL, 'เทคโนโลยีอุตสาหกรรม - วิชาเอกเทคโนโลยีอุตสาหการ', 'Industrial Technology (B.Tech) (Production Technology', NULL, NULL, NULL),
(40, 2, NULL, 'เทคโนโลยีอุตสาหกรรม - วิชาเอกเทคโนโลยีไฟฟ้า', 'Industrial Technology (Electrical Technology)', NULL, NULL, NULL),
(41, 2, NULL, 'เทคโนโลยีอุตสาหกรรม - วิชาเอกเทคโนโลยีเครื่องกล', 'Industrial Technology (B.Tech. Mechanical Technology)', NULL, NULL, NULL),
(42, 3, 'คณิตศาสตร์', 'คณิตศาสตร์', 'Mathematics', NULL, NULL, '2020-10-28 23:28:41'),
(43, 3, 'คณิตศาสตร์', 'สถิติ', 'Statistics', NULL, NULL, NULL),
(44, 3, 'คณิตศาสตร์', 'วิทยาการคอมพิวเตอร์ประยุกต์', 'Applied Computer Science', NULL, NULL, NULL),
(45, 3, 'จุลชีววิทยา', 'จุลชีววิทยา', 'Microbiology', NULL, NULL, NULL),
(46, 3, 'จุลชีววิทยา', 'วิทยาศาสตร์และเทคโนโลยีการอาหาร', 'Food Science and Technology', NULL, NULL, NULL),
(47, 3, 'เคมี', 'เคมี', 'Chemistry', NULL, NULL, NULL),
(48, 3, 'ฟิสิกส์', 'ฟิสิกส์ประยุกต์ (หลักสูตรสองภาษา) - สาขาเอกฟิสิกส์', 'ฟิสิกส์ประยุกต์ (หลักสูตรสองภาษา) - สาขาเอกฟิสิกส์', NULL, NULL, NULL),
(49, 4, NULL, 'เทคโนโลยีสารสนเทศ (Information Technology)', 'Information Technology (IT)', NULL, NULL, NULL),
(50, 4, NULL, 'วิทยาการคอมพิวเตอร์ (หลักสูตรภาษาอังกฤษ) (Computer Science - English Program)', 'Computer Science (English Program)', NULL, NULL, NULL),
(51, 4, NULL, 'นวัตกรรมบริการดิจิทัล (Digital Service Innovation)', 'Digital Service Innovation (DSI)', NULL, NULL, NULL),
(52, 5, NULL, 'สถาปัตยกรรม (หลักสูตรนานาชาติ)', 'สถาปัตยกรรม (หลักสูตรนานาชาติ)', NULL, NULL, NULL),
(53, 5, NULL, 'สถาปัตยกรรมภายใน (หลักสูตรนานาชาติ)', 'สถาปัตยกรรมภายใน (หลักสูตรนานาชาติ)', NULL, NULL, '2020-11-01 06:59:08'),
(54, 5, NULL, 'นวัตกรรมการออกแบบ (หลักสูตรนานาชาติ)', 'นวัตกรรมการออกแบบ (หลักสูตรนานาชาติ)', NULL, NULL, NULL),
(55, 5, NULL, 'ออกแบบอุตสาหกรรม (หลักสูตรนานาชาติ)', 'ออกแบบอุตสาหกรรม (หลักสูตรนานาชาติ)', NULL, NULL, NULL),
(56, 6, NULL, 'เทคโนโลยีมีเดีย - วิชาเอกเทคโนโลยีมีเดียดิจิทัล', 'Technology Media - Digital Media Technology', NULL, NULL, '2020-11-16 13:24:48'),
(57, 6, NULL, 'เทคโนโลยีมีเดีย - วิชาเอกการพัฒนาเกม', 'Technology Media - Game Development', NULL, NULL, '2020-11-16 13:24:46'),
(58, 6, NULL, 'เทคโนโลยีมีเดีย - วิชาเอกเทคโนโลยีมีเดียชีวการแพทย์', 'Technology Media - Biomedical Media Technology', NULL, NULL, '2020-11-16 13:24:44'),
(59, 6, NULL, 'มีเดียอาตส์ - วิชาเอกการออกแบบกราฟิก', 'Media Arts - Graphic Design', NULL, NULL, '2020-11-16 13:24:43'),
(60, 6, NULL, 'มีเดียอาตส์ - วิชาเอกแอนิเมชัน', 'Media Arts – Animation', NULL, NULL, '2020-11-16 13:24:41'),
(61, 6, NULL, 'มีเดียอาตส์ - วิชาเอกภาพยนตร์และภาพเคลื่อนไหว', 'Media Arts - Film and Moving Image', NULL, NULL, '2020-11-16 13:24:39'),
(62, 6, NULL, 'มีเดียทางการแพทย์และวิทยาศาสตร์', 'Medical and Science Media', NULL, NULL, '2020-11-16 13:24:36'),
(63, 7, NULL, 'วิศวกรรมหุ่นยนต์และระบบอัตโนมัติ', 'Robotics and Automation Engineering', NULL, NULL, '2020-11-16 08:49:09'),
(64, 8, NULL, 'วิทยาศาสตร์และเทคโนโลยี', 'Science and Technology', NULL, NULL, '2020-10-26 06:20:54'),
(65, 5, NULL, 'ภูมิสถาปัตยกรรม (หลักสูตรนานาชาติ)', 'ภูมิสถาปัตยกรรม (หลักสูตรนานาชาติ)', NULL, '2020-10-28 23:56:30', '2020-10-28 23:56:30'),
(66, 3, 'ฟิสิกส์', 'ฟิสิกส์ประยุกต์ (หลักสูตรสองภาษา) - สาขาเอกฟิสิกส์วัสดุและเทคโนโลยีนาโน', 'ฟิสิกส์ประยุกต์ (หลักสูตรสองภาษา) - สาขาเอกฟิสิกส์วัสดุและเทคโนโลยีนาโน', NULL, NULL, NULL),
(67, 8, NULL, 'การออกแบบดิจิทัล (หลักสูตรนานาชาติ)', 'Digital Design (International Program)', NULL, NULL, NULL),
(68, 8, NULL, 'ดิจิทัลเทคโนโลยี(หลักสูตรนานาชาติ)', 'Digital Technology (International Program)', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_en` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `name_en`, `created_at`, `updated_at`) VALUES
(1, 'คณะวิศวกรรมศาสตร์', 'Faculty of Engineering', NULL, NULL),
(2, 'คณะครุศาสตร์อุตสาหกรรมและเทคโนโลยี', 'Faculty of Industrial Education and Technology', NULL, NULL),
(3, 'คณะวิทยาศาสตร์ ', 'Faculty of Science', NULL, NULL),
(4, 'คณะเทคโนโลยีสารสนเทศ', 'School of Information Technology', NULL, NULL),
(5, 'คณะสถาปัตยกรรมศาสตร์และการออกแบบ', ' Faculty of Architecture', NULL, NULL),
(6, 'โครงการร่วมบริหารหลักสูตรมีเดียอาตส์และเทคโนโลยีมีเดีย', 'Media Arts and Technology', NULL, NULL),
(7, 'สถาบันวิทยาการหุ่นยนต์ภาคสนาม ', 'Institute of Field Robotics ', NULL, NULL),
(8, 'วิทยาลัยสหวิทยาการ', 'College of Interdisciplinary Studies', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '12020_07_1_292211_create_users_table', 1),
(2, '22020_07_02_181704_create_user_profiles_table', 1),
(3, '32020_07_18_122748_create_faculty_table', 1),
(4, '42020_07_18_122859_create_departments_table', 1),
(5, '52020_07_1_287432_create_password_resets_table', 1),
(6, '62020_07_17_065317_create_recruitment_table', 1),
(7, '72020_07_26_083029_create_apply_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recruitment`
--

CREATE TABLE `recruitment` (
  `id` int UNSIGNED NOT NULL,
  `faculty` int UNSIGNED DEFAULT NULL,
  `department` int UNSIGNED DEFAULT NULL,
  `TCAS_ROUND` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_round` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `openDate` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `closeDate` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GPA_MTH` double(5,2) DEFAULT NULL,
  `GPA_SCI` double(5,2) DEFAULT NULL,
  `GPA_ENG` double(5,2) DEFAULT NULL,
  `GPAX` double(5,2) DEFAULT NULL,
  `CRE_MTH` double(5,2) DEFAULT NULL,
  `CRE_SCI` double(5,2) DEFAULT NULL,
  `CRE_ENG` double(5,2) DEFAULT NULL,
  `publish` int DEFAULT NULL,
  `ENG_TEST` int DEFAULT NULL,
  `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `amount` int DEFAULT NULL,
  `announcement` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `interview_at` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `interview_time` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `interview_location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `interview_confirm` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `student_info`
-- (See below for the actual view)
--
CREATE TABLE `student_info` (
`email` varchar(255)
,`lastname` varchar(255)
,`name` varchar(255)
,`prefix` varchar(255)
,`username` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `prefix` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `prefix`, `name`, `lastname`, `username`, `email`, `email_verified_at`, `password`, `type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'นาย', 'วราณัฐ', 'สุทธิการณ์', 'admin', 'admin@gmail.com', NULL, '$2y$10$FnkwUGcaGmySxhgvD.ngteod.pIbmP3hFMwHFgp84g03TJyJyiZ36', 1, 'lBl6Sqyzm2Zq57szio0xQpbEfWIfv2bQe2RFCVD23k4AyIZPRUTNXRMmbji1', '2020-07-26 02:21:59', '2020-11-16 10:29:41');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `citizen_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone2` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lineID` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `school` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edu_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GPA_MTH` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GPA_SCI` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GPA_ENG` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `GPAX` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CRE_MTH` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CRE_SCI` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CRE_ENG` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IELTS` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TOEFL` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `TOEIC` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CUTEP` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RMIT` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transcript` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `feedback` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure for view `student_info`
--
DROP TABLE IF EXISTS `student_info`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `student_info`  AS SELECT `users`.`prefix` AS `prefix`, `users`.`name` AS `name`, `users`.`lastname` AS `lastname`, `users`.`username` AS `username`, `users`.`email` AS `email` FROM `users` WHERE (`users`.`type` = 0) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `apply_profile_id_foreign` (`profile_id`),
  ADD KEY `apply_recruitment_id_foreign` (`recruitment_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_faculty_id_foreign` (`faculty_id`),
  ADD KEY `departments_user_foreign` (`user`) USING BTREE;

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `recruitment`
--
ALTER TABLE `recruitment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recruitment_faculty_foreign` (`faculty`),
  ADD KEY `recruitment_department_foreign` (`department`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_profiles_citizen_id_unique` (`citizen_id`),
  ADD KEY `user_profiles_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apply`
--
ALTER TABLE `apply`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recruitment`
--
ALTER TABLE `recruitment`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apply`
--
ALTER TABLE `apply`
  ADD CONSTRAINT `apply_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `user_profiles` (`id`),
  ADD CONSTRAINT `apply_recruitment_id_foreign` FOREIGN KEY (`recruitment_id`) REFERENCES `recruitment` (`id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`),
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `recruitment`
--
ALTER TABLE `recruitment`
  ADD CONSTRAINT `recruitment_department_foreign` FOREIGN KEY (`department`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `recruitment_faculty_foreign` FOREIGN KEY (`faculty`) REFERENCES `faculty` (`id`);

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
