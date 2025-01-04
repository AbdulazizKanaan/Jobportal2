-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 04, 2025 at 06:35 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobquestify`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rate` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `employment_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `company_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `vacancy` int DEFAULT NULL,
  `hours` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `workplace` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `education` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `experience` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `image`, `title`, `rate`, `employment_type`, `company_name`, `location`, `vacancy`, `hours`, `description`, `workplace`, `education`, `experience`) VALUES
(6, 'images/google.png', 'Web Developer', '$900-$1200/m', 'Full Time', 'Google', 'USA', 1, '50hr / Week', 'Google is seeking a talented Web Developer to join our team. This position is remote, offering you the flexibility to work from home while contributing to exciting, innovative projects. As a Web Developer, you will be responsible for designing, developing, and maintaining dynamic websites and web applications that align with the company’s standards of excellence.', 'Work from Home', 'Bachelor degree in any Computer Science Course', '2 to 5 years'),
(7, 'images/uber.png', 'Freelancer', '$900-$1200/m', 'Part Time', 'Uber', 'USA', 4, '40hr / Week', 'Uber is looking for talented freelancers to work on a variety of projects ranging from operational support to data analysis and creative problem-solving. This is a flexible, part-time role ideal for individuals who thrive in a dynamic, fast-paced environment while enjoying the freedom of freelancing.', 'Remote with optional in-office collaboration', 'Bachelor\'s degree in any field or equivalent practical experience', '1 to 3 year(s) of relevant work experience, preferably in operations, analysis, or freelance project'),
(8, 'images/linkedin.png', 'Business Associate', '$900-$1200/m', 'Part Time', 'LinkedIn', 'USA', 2, '30hr / Week', 'LinkedIn is seeking a motivated Business Associate to support our business operations and strategic initiatives. This role is part-time and ideal for individuals with strong analytical skills, excellent communication abilities, and a passion for driving impactful results.', 'Remote with occasional meetings', 'Bachelor’s degree in Business Administration, Marketing, or a related field', '1 to 2 years of experience in business operations or sales support'),
(9, 'images/facebook.png', 'Digital Marketing', '$900-$1200/m', 'Full Time', NULL, 'USA', 3, '40hr / Week', '0', 'In-office or hybrid option', 'Bachelor’s degree in Marketing, Communications, or a related field', '2 to 4 years of experience in digital marketing...'),
(10, 'images/yahoo.png', 'User Experience Designer', '$900-$1200/m', 'Full Time', NULL, 'USA', 1, '40hr / Week', '0', 'In-office with flexible work-from-home options', 'Bachelor’s degree in Graphic Design, Human-Computer Interaction...', '3 to 5 years of experience in UX design...');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

DROP TABLE IF EXISTS `job_applications`;
CREATE TABLE IF NOT EXISTS `job_applications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cover_letter` text,
  `resume_path` varchar(255) DEFAULT NULL,
  `applied_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int NOT NULL,
  `job_id` int NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `fk_jobId` (`job_id`),
  KEY `fk_userId` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `cover_letter`, `resume_path`, `applied_at`, `user_id`, `job_id`, `status`) VALUES
(1, 'testing', 'uploads/Kerstin Grace TAN - Project Proposal.docx', '2024-12-04 14:42:07', 2, 6, 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES
(1, 'Abdelrahman', 'kanaan', 'Abdelrahman@gmail.com', 'abc', 'admin'),
(2, 'Abdulaziz', 'Kanaan', 'Abdulaziz@gmail.com', 'abc', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
