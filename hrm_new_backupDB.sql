-- phpMyAdmin SQL Dump
-- version 4.1.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 11, 2024 at 12:32 PM
-- Server version: 5.7.39
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hrm_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `module` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unique_id` int(11) DEFAULT NULL,
  `secondary_id` int(11) DEFAULT NULL,
  `activity` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1333 ;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `user_id`, `module`, `unique_id`, `secondary_id`, `activity`, `ip`, `created_at`, `updated_at`) VALUES
(1, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-10-23 20:09:15', '2016-10-23 20:09:15'),
(2, 1, 'configuration', NULL, NULL, 'activity_configuration_updated', '45.113.237.162', '2016-10-23 20:10:08', '2016-10-23 20:10:08'),
(3, 1, 'configuration', NULL, NULL, 'activity_configuration_updated', '45.113.237.162', '2016-10-23 20:11:42', '2016-10-23 20:11:42'),
(4, 1, 'configuration', NULL, NULL, 'activity_configuration_updated', '45.113.237.162', '2016-10-23 20:43:03', '2016-10-23 20:43:03'),
(5, 1, 'role', 2, NULL, 'activity_added', '45.113.237.162', '2016-10-23 20:43:49', '2016-10-23 20:43:49'),
(6, 1, 'configuration', NULL, NULL, 'activity_permission_updated', '45.113.237.162', '2016-10-23 20:44:44', '2016-10-23 20:44:44'),
(7, 1, 'configuration', NULL, NULL, 'activity_configuration_updated', '45.113.237.162', '2016-10-23 20:45:39', '2016-10-23 20:45:39'),
(8, 1, 'authentication', NULL, NULL, 'activity_logged_out', '45.113.237.162', '2016-10-23 20:46:05', '2016-10-23 20:46:05'),
(9, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-10-23 20:46:18', '2016-10-23 20:46:18'),
(10, 1, 'configuration', NULL, NULL, 'activity_permission_updated', '45.113.237.162', '2016-10-23 20:46:41', '2016-10-23 20:46:41'),
(11, 1, 'role', 3, NULL, 'activity_added', '45.113.237.162', '2016-10-23 20:47:26', '2016-10-23 20:47:26'),
(12, 1, 'department', 2, NULL, 'activity_added', '45.113.237.162', '2016-10-23 20:48:00', '2016-10-23 20:48:00'),
(13, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-10-23 20:54:00', '2016-10-23 20:54:00'),
(14, 1, 'role', 4, NULL, 'activity_added', '45.113.237.162', '2016-10-23 20:55:26', '2016-10-23 20:55:26'),
(15, 1, 'configuration', NULL, NULL, 'activity_configuration_updated', '45.113.237.162', '2016-10-23 20:55:37', '2016-10-23 20:55:37'),
(16, 1, 'office_shift', 1, NULL, 'activity_added', '45.113.237.162', '2016-10-23 20:58:14', '2016-10-23 20:58:14'),
(17, 1, 'office_shift', 2, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:00:46', '2016-10-23 21:00:46'),
(18, 1, 'contract_type', 1, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:01:43', '2016-10-23 21:01:43'),
(19, 1, 'contract_type', 2, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:01:52', '2016-10-23 21:01:52'),
(20, 1, 'award_type', 1, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:02:04', '2016-10-23 21:02:04'),
(21, 1, 'award_type', 2, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:02:14', '2016-10-23 21:02:14'),
(22, 1, 'award_type', 3, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:02:35', '2016-10-23 21:02:35'),
(23, 1, 'leave_type', 1, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:02:45', '2016-10-23 21:02:45'),
(24, 1, 'leave_type', 2, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:03:38', '2016-10-23 21:03:38'),
(25, 1, 'leave_type', 3, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:03:47', '2016-10-23 21:03:47'),
(26, 1, 'document_type', 1, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:03:54', '2016-10-23 21:03:54'),
(27, 1, 'document_type', 2, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:04:08', '2016-10-23 21:04:08'),
(28, 1, 'document_type', 3, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:04:14', '2016-10-23 21:04:14'),
(29, 1, 'document_type', 4, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:04:24', '2016-10-23 21:04:24'),
(30, 1, 'document_type', 5, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:04:35', '2016-10-23 21:04:35'),
(31, 1, 'salary_type', 1, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:07:25', '2016-10-23 21:07:25'),
(32, 1, 'salary_type', 2, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:07:36', '2016-10-23 21:07:36'),
(33, 1, 'salary_type', 3, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:07:45', '2016-10-23 21:07:45'),
(34, 1, 'salary_type', 4, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:08:16', '2016-10-23 21:08:16'),
(35, 1, 'salary_type', 5, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:08:31', '2016-10-23 21:08:31'),
(36, 1, 'salary_type', 6, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:08:40', '2016-10-23 21:08:40'),
(37, 1, 'salary_type', 7, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:09:09', '2016-10-23 21:09:09'),
(38, 1, 'expense_head', 1, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:09:22', '2016-10-23 21:09:22'),
(39, 1, 'expense_head', 2, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:09:30', '2016-10-23 21:09:30'),
(40, 1, 'expense_head', 3, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:09:37', '2016-10-23 21:09:37'),
(41, 1, 'configuration', NULL, NULL, 'activity_configuration_updated', '45.113.237.162', '2016-10-23 21:09:58', '2016-10-23 21:09:58'),
(42, 1, 'configuration', NULL, NULL, 'activity_api_token_updated', '45.113.237.162', '2016-10-23 21:10:04', '2016-10-23 21:10:04'),
(43, 1, 'department', 3, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:11:20', '2016-10-23 21:11:20'),
(44, 1, 'department', 4, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:11:35', '2016-10-23 21:11:35'),
(45, 1, 'department', 5, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:11:48', '2016-10-23 21:11:48'),
(46, 1, 'department', 6, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:11:58', '2016-10-23 21:11:58'),
(47, 1, 'designation', 2, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:12:42', '2016-10-23 21:12:42'),
(48, 1, 'designation', 3, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:13:16', '2016-10-23 21:13:16'),
(49, 1, 'designation', 4, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:13:31', '2016-10-23 21:13:31'),
(50, 1, 'designation', 5, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:13:57', '2016-10-23 21:13:57'),
(51, 1, 'designation', 6, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:14:15', '2016-10-23 21:14:15'),
(52, 1, 'designation', 7, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:14:30', '2016-10-23 21:14:30'),
(53, 1, 'employee', 2, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:16:45', '2016-10-23 21:16:45'),
(54, 1, 'office_shift', 1, NULL, 'activity_made_default', '45.113.237.162', '2016-10-23 21:18:06', '2016-10-23 21:18:06'),
(55, 1, 'clock', NULL, NULL, 'activity_clock_in', '45.113.237.162', '2016-10-23 21:18:44', '2016-10-23 21:18:44'),
(56, 1, 'announcement', 1, NULL, 'activity_added', '45.113.237.162', '2016-10-23 21:23:05', '2016-10-23 21:23:05'),
(57, 1, 'configuration', NULL, NULL, 'activity_configuration_updated', '45.113.237.162', '2016-10-23 21:23:30', '2016-10-23 21:23:30'),
(58, 1, 'configuration', NULL, NULL, 'activity_configuration_updated', '45.113.237.162', '2016-10-23 21:23:37', '2016-10-23 21:23:37'),
(59, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-23 21:24:39', '2016-10-23 21:24:39'),
(60, 1, 'authentication', NULL, NULL, 'activity_logged_out', '45.113.237.162', '2016-10-23 21:24:39', '2016-10-23 21:24:39'),
(61, 1, 'employee', 2, NULL, 'activity_updated', '45.113.237.162', '2016-10-23 21:36:43', '2016-10-23 21:36:43'),
(62, 1, 'office_shift', NULL, 2, 'activity_added', '45.113.237.162', '2016-10-23 21:37:20', '2016-10-23 21:37:20'),
(63, 1, 'contract', 1, 2, 'activity_added', '45.113.237.162', '2016-10-23 21:39:21', '2016-10-23 21:39:21'),
(64, 1, 'salary', NULL, 2, 'activity_added', '45.113.237.162', '2016-10-23 21:40:14', '2016-10-23 21:40:14'),
(65, 1, 'leave', NULL, 2, 'activity_updated', '45.113.237.162', '2016-10-23 21:40:34', '2016-10-23 21:40:34'),
(66, 1, 'payroll', 1, NULL, 'activity_updated', '45.113.237.162', '2016-10-23 21:41:25', '2016-10-23 21:41:25'),
(67, 1, 'payroll', 1, NULL, 'activity_updated', '45.113.237.162', '2016-10-23 21:41:47', '2016-10-23 21:41:47'),
(68, 1, 'configuration', NULL, NULL, 'activity_configuration_updated', '45.113.237.162', '2016-10-23 21:42:35', '2016-10-23 21:42:35'),
(69, 1, 'configuration', NULL, NULL, 'activity_configuration_updated', '45.113.237.162', '2016-10-23 21:42:50', '2016-10-23 21:42:50'),
(70, 1, 'authentication', NULL, NULL, 'activity_logged_out', '45.113.237.162', '2016-10-23 21:59:08', '2016-10-23 21:59:08'),
(71, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-10-24 08:09:36', '2016-10-24 08:09:36'),
(72, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-24 08:09:37', '2016-10-24 08:09:37'),
(73, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-24 08:09:47', '2016-10-24 08:09:47'),
(74, 1, 'authentication', NULL, NULL, 'activity_logged_out', '45.113.237.162', '2016-10-24 08:09:47', '2016-10-24 08:09:47'),
(75, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-10-24 08:10:05', '2016-10-24 08:10:05'),
(76, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-24 08:10:05', '2016-10-24 08:10:05'),
(77, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-10-24 08:10:29', '2016-10-24 08:10:29'),
(78, 1, 'clock', NULL, NULL, 'activity_clock_in', '45.113.237.162', '2016-10-24 08:10:42', '2016-10-24 08:10:42'),
(79, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-10-24 21:18:25', '2016-10-24 21:18:25'),
(80, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-24 21:18:27', '2016-10-24 21:18:27'),
(81, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-10-24 21:18:45', '2016-10-24 21:18:45'),
(82, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-24 21:18:55', '2016-10-24 21:18:55'),
(83, 1, 'authentication', NULL, NULL, 'activity_logged_out', '45.113.237.162', '2016-10-24 21:18:55', '2016-10-24 21:18:55'),
(84, 1, 'authentication', NULL, NULL, 'activity_employee_password_changed', '45.113.237.162', '2016-10-24 21:19:34', '2016-10-24 21:19:34'),
(85, 2, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-10-24 21:21:05', '2016-10-24 21:21:05'),
(86, 2, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-24 21:21:07', '2016-10-24 21:21:07'),
(87, 2, 'clock', NULL, NULL, 'activity_clock_in', '45.113.237.162', '2016-10-24 21:21:21', '2016-10-24 21:21:21'),
(88, 2, 'clock', NULL, NULL, 'activity_clock_in', '45.113.237.162', '2016-10-24 21:21:24', '2016-10-24 21:21:24'),
(89, 2, 'clock', NULL, NULL, 'activity_clock_in', '45.113.237.162', '2016-10-24 21:21:30', '2016-10-24 21:21:30'),
(90, 1, 'configuration', NULL, NULL, 'activity_permission_updated', '45.113.237.162', '2016-10-24 21:24:45', '2016-10-24 21:24:45'),
(91, 2, 'leave', 1, NULL, 'activity_added', '45.113.237.162', '2016-10-24 21:25:25', '2016-10-24 21:25:25'),
(92, 1, 'configuration', NULL, NULL, 'activity_permission_updated', '45.113.237.162', '2016-10-24 21:25:41', '2016-10-24 21:25:41'),
(93, 1, 'leave', 1, NULL, 'activity_status_updated', '45.113.237.162', '2016-10-24 21:26:39', '2016-10-24 21:26:39'),
(94, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-10-25 05:03:40', '2016-10-25 05:03:40'),
(95, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-25 05:03:42', '2016-10-25 05:03:42'),
(96, 1, 'employee', 3, NULL, 'activity_added', '45.113.237.162', '2016-10-25 05:13:34', '2016-10-25 05:13:34'),
(97, 1, 'document_type', 6, NULL, 'activity_added', '45.113.237.162', '2016-10-25 05:24:57', '2016-10-25 05:24:57'),
(98, 1, 'contract', 2, 3, 'activity_added', '45.113.237.162', '2016-10-25 05:30:36', '2016-10-25 05:30:36'),
(99, 1, 'clock', NULL, NULL, 'activity_clock_in', '45.113.237.162', '2016-10-25 05:51:16', '2016-10-25 05:51:16'),
(100, 1, 'clock', NULL, NULL, 'activity_clock_in', '45.113.237.162', '2016-10-25 05:51:23', '2016-10-25 05:51:23'),
(101, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-25 05:54:49', '2016-10-25 05:54:49'),
(102, 1, 'authentication', NULL, NULL, 'activity_logged_out', '45.113.237.162', '2016-10-25 05:54:49', '2016-10-25 05:54:49'),
(103, 3, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-10-25 05:59:23', '2016-10-25 05:59:23'),
(104, 3, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-25 05:59:24', '2016-10-25 05:59:24'),
(105, 3, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-25 06:00:54', '2016-10-25 06:00:54'),
(106, 3, 'authentication', NULL, NULL, 'activity_logged_out', '45.113.237.162', '2016-10-25 06:00:54', '2016-10-25 06:00:54'),
(107, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-10-25 06:01:04', '2016-10-25 06:01:04'),
(108, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-25 06:01:05', '2016-10-25 06:01:05'),
(109, 1, 'payroll', 2, NULL, 'activity_updated', '45.113.237.162', '2016-10-25 06:03:13', '2016-10-25 06:03:13'),
(110, 1, 'office_shift', NULL, 3, 'activity_added', '45.113.237.162', '2016-10-25 06:24:28', '2016-10-25 06:24:28'),
(111, 3, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-10-25 06:27:34', '2016-10-25 06:27:34'),
(112, 3, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-25 06:27:35', '2016-10-25 06:27:35'),
(113, 3, 'clock', NULL, NULL, 'activity_clock_in', '45.113.237.162', '2016-10-25 06:28:00', '2016-10-25 06:28:00'),
(114, 1, 'configuration', NULL, NULL, 'activity_permission_updated', '45.113.237.162', '2016-10-25 06:28:44', '2016-10-25 06:28:44'),
(115, 1, 'contract', 2, 3, 'activity_updated', '45.113.237.162', '2016-10-25 06:31:45', '2016-10-25 06:31:45'),
(116, 1, 'contract', 2, 3, 'activity_deleted', '45.113.237.162', '2016-10-25 06:34:26', '2016-10-25 06:34:26'),
(117, 1, 'contract', 3, 3, 'activity_added', '45.113.237.162', '2016-10-25 06:34:34', '2016-10-25 06:34:34'),
(118, 1, 'leave', NULL, 3, 'activity_updated', '45.113.237.162', '2016-10-25 06:35:50', '2016-10-25 06:35:50'),
(119, 3, 'leave', 2, NULL, 'activity_added', '45.113.237.162', '2016-10-25 06:36:35', '2016-10-25 06:36:35'),
(120, 1, 'leave', 2, NULL, 'activity_status_updated', '45.113.237.162', '2016-10-25 06:37:52', '2016-10-25 06:37:52'),
(121, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-10-25 07:22:17', '2016-10-25 07:22:17'),
(122, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.183.69', '2016-10-25 11:10:43', '2016-10-25 11:10:43'),
(123, 3, 'authentication', NULL, NULL, 'activity_logged_in', '182.160.122.62', '2016-10-25 11:16:27', '2016-10-25 11:16:27'),
(124, 3, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-25 11:16:29', '2016-10-25 11:16:29'),
(125, 1, 'salary_type', 8, NULL, 'activity_added', '182.160.122.62', '2016-10-25 11:21:18', '2016-10-25 11:21:18'),
(126, 3, 'clock', NULL, NULL, 'activity_clock_in', '182.160.122.62', '2016-10-25 11:34:11', '2016-10-25 11:34:11'),
(127, 3, 'clock', NULL, NULL, 'activity_clock_in', '182.160.122.62', '2016-10-25 11:39:02', '2016-10-25 11:39:02'),
(128, 3, 'leave', 3, NULL, 'activity_added', '182.160.122.62', '2016-10-25 11:43:11', '2016-10-25 11:43:11'),
(129, 1, 'leave', 3, NULL, 'activity_status_updated', '182.160.122.62', '2016-10-25 11:44:20', '2016-10-25 11:44:20'),
(130, 1, 'payroll', 2, NULL, 'activity_updated', '182.160.122.62', '2016-10-25 11:46:52', '2016-10-25 11:46:52'),
(131, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-10-25 11:54:23', '2016-10-25 11:54:23'),
(132, 1, 'authentication', NULL, NULL, 'activity_logged_out', '182.160.122.62', '2016-10-25 11:54:23', '2016-10-25 11:54:23'),
(133, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-11-03 07:47:15', '2016-11-03 07:47:15'),
(134, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-11-03 07:47:17', '2016-11-03 07:47:17'),
(135, 3, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-11-03 07:48:34', '2016-11-03 07:48:34'),
(136, 3, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-11-03 07:48:34', '2016-11-03 07:48:34'),
(137, 3, 'clock', NULL, NULL, 'activity_clock_in', '45.113.237.162', '2016-11-03 07:49:12', '2016-11-03 07:49:12'),
(138, 3, 'authentication', NULL, NULL, 'activity_logged_out', '45.113.237.162', '2016-11-03 07:57:09', '2016-11-03 07:57:09'),
(139, 1, 'authentication', NULL, NULL, 'activity_logged_in', '203.202.243.94', '2016-11-03 09:36:25', '2016-11-03 09:36:25'),
(140, 1, 'employee', 3, NULL, 'activity_updated', '203.202.243.94', '2016-11-03 12:01:08', '2016-11-03 12:01:08'),
(141, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.192.157.42', '2016-11-03 17:53:05', '2016-11-03 17:53:05'),
(142, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.192.157.42', '2016-11-03 18:08:48', '2016-11-03 18:08:48'),
(143, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.192.157.42', '2016-11-03 18:08:57', '2016-11-03 18:08:57'),
(144, 1, 'employee', 4, NULL, 'activity_added', '103.192.157.42', '2016-11-03 18:54:32', '2016-11-03 18:54:32'),
(145, 1, 'contact', 1, 4, 'activity_added', '103.192.157.42', '2016-11-03 18:58:40', '2016-11-03 18:58:40'),
(146, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.192.157.42', '2016-11-03 19:24:36', '2016-11-03 19:24:36'),
(147, 1, 'authentication', NULL, NULL, 'activity_logged_in', '203.202.243.94', '2016-11-04 04:44:06', '2016-11-04 04:44:06'),
(148, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-11-04 04:44:08', '2016-11-04 04:44:08'),
(149, 1, 'clock', NULL, NULL, 'activity_clock_in', '203.202.243.94', '2016-11-04 04:53:30', '2016-11-04 04:53:30'),
(150, 1, 'employee', 5, NULL, 'activity_added', '203.202.243.94', '2016-11-04 05:22:17', '2016-11-04 05:22:17'),
(151, 1, 'clock', NULL, NULL, 'activity_clock_in', '203.202.243.94', '2016-11-04 05:23:12', '2016-11-04 05:23:12'),
(152, 1, 'clock', NULL, NULL, 'activity_clock_in', '203.202.243.94', '2016-11-04 05:23:24', '2016-11-04 05:23:24'),
(153, 1, 'clock', NULL, NULL, 'activity_clock_in', '203.202.243.94', '2016-11-04 05:23:52', '2016-11-04 05:23:52'),
(154, 1, 'authentication', NULL, NULL, 'activity_logged_in', '203.202.243.94', '2016-11-04 10:15:32', '2016-11-04 10:15:32'),
(155, 1, 'clock', NULL, NULL, 'activity_clock_in', '203.202.243.94', '2016-11-04 12:56:02', '2016-11-04 12:56:02'),
(156, 1, 'authentication', NULL, NULL, 'activity_logged_out', '203.202.243.94', '2016-11-04 13:01:03', '2016-11-04 13:01:03'),
(157, 1, 'authentication', NULL, NULL, 'activity_logged_in', '203.202.243.94', '2016-11-05 04:55:12', '2016-11-05 04:55:12'),
(158, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-11-05 04:55:13', '2016-11-05 04:55:13'),
(159, 1, 'clock', NULL, NULL, 'activity_clock_in', '203.202.243.94', '2016-11-05 05:12:18', '2016-11-05 05:12:18'),
(160, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.162', '2016-11-12 07:09:50', '2016-11-12 07:09:50'),
(161, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-11-12 07:09:51', '2016-11-12 07:09:51'),
(162, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.208.214', '2016-11-17 06:27:28', '2016-11-17 06:27:28'),
(163, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-11-17 06:27:33', '2016-11-17 06:27:33'),
(164, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.164', '2016-11-29 06:25:03', '2016-11-29 06:25:03'),
(165, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-11-29 06:25:05', '2016-11-29 06:25:05'),
(166, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2016-12-01 10:08:42', '2016-12-01 10:08:42'),
(167, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-12-01 10:08:44', '2016-12-01 10:08:44'),
(168, 1, 'authentication', NULL, NULL, 'activity_logged_in', '45.113.237.164', '2016-12-05 06:39:07', '2016-12-05 06:39:07'),
(169, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2016-12-05 06:39:09', '2016-12-05 06:39:09'),
(170, 1, 'employee', 4, NULL, 'activity_updated', '45.113.237.164', '2016-12-05 07:05:18', '2016-12-05 07:05:18'),
(171, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.48.71.186', '2017-01-03 10:23:38', '2017-01-03 10:23:38'),
(172, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-01-03 10:23:40', '2017-01-03 10:23:40'),
(173, 1, 'expense', 1, NULL, 'activity_added', '182.48.71.186', '2017-01-03 10:24:42', '2017-01-03 10:24:42'),
(174, 1, 'authentication', NULL, NULL, 'activity_logged_in', '49.0.42.162', '2017-01-10 09:11:09', '2017-01-10 09:11:09'),
(175, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-01-10 09:11:11', '2017-01-10 09:11:11'),
(176, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-01-10 10:05:44', '2017-01-10 10:05:44'),
(177, 1, 'authentication', NULL, NULL, 'activity_logged_out', '49.0.42.162', '2017-01-10 10:05:44', '2017-01-10 10:05:44'),
(178, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.86.203.253', '2017-05-04 15:48:59', '2017-05-04 15:48:59'),
(179, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-05-04 15:49:04', '2017-05-04 15:49:04'),
(180, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.86.203.253', '2017-05-04 18:57:59', '2017-05-04 18:57:59'),
(181, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-05-04 18:58:01', '2017-05-04 18:58:01'),
(182, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-05-04 19:15:19', '2017-05-04 19:15:19'),
(183, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.86.203.253', '2017-05-04 19:15:20', '2017-05-04 19:15:20'),
(184, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-05-21 04:21:25', '2017-05-21 04:21:25'),
(185, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-05-21 04:21:27', '2017-05-21 04:21:27'),
(186, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-05-21 07:14:21', '2017-05-21 07:14:21'),
(187, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-05-21 08:13:01', '2017-05-21 08:13:01'),
(188, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.4.146.6', '2017-05-21 11:03:09', '2017-05-21 11:03:09'),
(189, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-05-22 11:00:23', '2017-05-22 11:00:23'),
(190, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-05-22 11:00:28', '2017-05-22 11:00:28'),
(191, 1, 'employee', 6, NULL, 'activity_added', '103.204.210.154', '2017-05-22 11:04:39', '2017-05-22 11:04:39'),
(192, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-05-23 08:03:47', '2017-05-23 08:03:47'),
(193, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-05-23 08:03:49', '2017-05-23 08:03:49'),
(194, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-06-14 10:39:13', '2017-06-14 10:39:13'),
(195, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-06-14 10:39:13', '2017-06-14 10:39:13'),
(196, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-10-25 09:09:19', '2017-10-25 09:09:19'),
(197, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-10-25 09:09:20', '2017-10-25 09:09:20'),
(198, 1, 'contract', 1, 2, 'activity_updated', '103.204.210.154', '2017-10-25 09:15:57', '2017-10-25 09:15:57'),
(199, 1, 'leave', NULL, 2, 'activity_updated', '103.204.210.154', '2017-10-25 09:17:05', '2017-10-25 09:17:05'),
(200, 1, 'holiday', NULL, NULL, 'activity_added', '103.204.210.154', '2017-10-25 09:19:52', '2017-10-25 09:19:52'),
(201, 1, 'authentication', NULL, NULL, 'activity_employee_password_changed', '103.204.210.154', '2017-10-25 09:20:35', '2017-10-25 09:20:35'),
(202, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-10-25 09:20:54', '2017-10-25 09:20:54'),
(203, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.204.210.154', '2017-10-25 09:20:54', '2017-10-25 09:20:54'),
(204, 2, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-10-25 09:21:20', '2017-10-25 09:21:20'),
(205, 2, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-10-25 09:21:21', '2017-10-25 09:21:21'),
(206, 2, 'leave', 4, NULL, 'activity_added', '103.204.210.154', '2017-10-25 09:21:58', '2017-10-25 09:21:58'),
(207, 2, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-10-25 09:22:07', '2017-10-25 09:22:07'),
(208, 2, 'authentication', NULL, NULL, 'activity_logged_out', '103.204.210.154', '2017-10-25 09:22:07', '2017-10-25 09:22:07'),
(209, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-10-25 09:22:12', '2017-10-25 09:22:12'),
(210, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-10-25 09:22:12', '2017-10-25 09:22:12'),
(211, 1, 'leave', 4, NULL, 'activity_status_updated', '103.204.210.154', '2017-10-25 09:23:02', '2017-10-25 09:23:02'),
(212, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-10-25 09:44:09', '2017-10-25 09:44:09'),
(213, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.204.210.154', '2017-10-25 10:12:19', '2017-10-25 10:12:19'),
(214, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.204.210.154', '2017-10-25 10:12:23', '2017-10-25 10:12:23'),
(215, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.204.210.154', '2017-10-25 10:12:30', '2017-10-25 10:12:30'),
(216, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.204.210.154', '2017-10-25 10:12:33', '2017-10-25 10:12:33'),
(217, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.204.210.154', '2017-10-25 10:12:36', '2017-10-25 10:12:36'),
(218, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.204.210.154', '2017-10-25 10:12:39', '2017-10-25 10:12:39'),
(219, 3, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-10-25 10:16:44', '2017-10-25 10:16:44'),
(220, 3, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-10-25 10:16:45', '2017-10-25 10:16:45'),
(221, 1, 'employee', 7, NULL, 'activity_added', '103.204.210.154', '2017-10-25 10:23:33', '2017-10-25 10:23:33'),
(222, 1, 'employee', 7, NULL, 'activity_updated', '103.204.210.154', '2017-10-25 10:24:15', '2017-10-25 10:24:15'),
(223, 1, 'employee', 7, NULL, 'activity_profile_updated', '103.204.210.154', '2017-10-25 10:47:42', '2017-10-25 10:47:42'),
(224, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.204.210.154', '2017-10-25 11:03:55', '2017-10-25 11:03:55'),
(225, 3, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-10-25 11:06:26', '2017-10-25 11:06:26'),
(226, 3, 'authentication', NULL, NULL, 'activity_logged_out', '103.204.210.154', '2017-10-25 11:06:26', '2017-10-25 11:06:26'),
(227, 1, 'employee', 7, NULL, 'activity_updated', '103.204.210.154', '2017-10-25 11:13:47', '2017-10-25 11:13:47'),
(228, 3, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-10-25 11:58:42', '2017-10-25 11:58:42'),
(229, 3, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-10-25 11:58:43', '2017-10-25 11:58:43'),
(230, 1, 'leave', NULL, 3, 'activity_updated', '103.204.210.154', '2017-10-25 11:59:49', '2017-10-25 11:59:49'),
(231, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-10-26 06:42:56', '2017-10-26 06:42:56'),
(232, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-10-26 06:42:56', '2017-10-26 06:42:56'),
(233, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-10-29 06:30:22', '2017-10-29 06:30:22'),
(234, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-10-29 06:30:23', '2017-10-29 06:30:23'),
(235, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-10-30 05:54:41', '2017-10-30 05:54:41'),
(236, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-10-30 05:54:41', '2017-10-30 05:54:41'),
(237, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2017-10-30 06:11:56', '2017-10-30 06:11:56'),
(238, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.48.67.166', '2017-11-21 10:53:32', '2017-11-21 10:53:32'),
(239, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-11-21 10:53:33', '2017-11-21 10:53:33'),
(240, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.48.67.166', '2017-11-22 04:18:28', '2017-11-22 04:18:28'),
(241, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-11-22 04:18:28', '2017-11-22 04:18:28'),
(242, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.48.67.166', '2017-11-22 09:02:07', '2017-11-22 09:02:07'),
(243, 1, 'authentication', NULL, NULL, 'activity_logged_in', '139.5.104.126', '2017-11-22 12:07:40', '2017-11-22 12:07:40'),
(244, 1, 'authentication', NULL, NULL, 'activity_logged_in', '139.5.104.126', '2017-12-02 09:32:55', '2017-12-02 09:32:55'),
(245, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-12-02 09:32:55', '2017-12-02 09:32:55'),
(246, 1, 'authentication', NULL, NULL, 'activity_logged_in', '139.5.104.126', '2017-12-03 11:00:58', '2017-12-03 11:00:58'),
(247, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-12-03 11:00:59', '2017-12-03 11:00:59'),
(248, 1, 'authentication', NULL, NULL, 'activity_logged_in', '139.5.104.126', '2017-12-09 10:21:03', '2017-12-09 10:21:03'),
(249, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-12-09 10:21:03', '2017-12-09 10:21:03'),
(250, 1, 'authentication', NULL, NULL, 'activity_logged_in', '139.5.104.126', '2017-12-14 06:56:10', '2017-12-14 06:56:10'),
(251, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2017-12-14 06:56:11', '2017-12-14 06:56:11'),
(252, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-01-03 07:47:01', '2018-01-03 07:47:01'),
(253, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-01-03 07:47:02', '2018-01-03 07:47:02'),
(254, 1, 'authentication', NULL, NULL, 'activity_logged_in', '117.103.86.62', '2018-01-03 19:26:30', '2018-01-03 19:26:30'),
(255, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-01-03 19:26:31', '2018-01-03 19:26:31'),
(256, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-01-07 09:10:11', '2018-01-07 09:10:11'),
(257, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-01-07 09:10:12', '2018-01-07 09:10:12'),
(258, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-01-08 10:14:52', '2018-01-08 10:14:52'),
(259, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-01-08 10:14:53', '2018-01-08 10:14:53'),
(260, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-01-10 06:50:49', '2018-01-10 06:50:49'),
(261, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-01-10 06:50:50', '2018-01-10 06:50:50'),
(262, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-01-17 05:03:14', '2018-01-17 05:03:14'),
(263, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-01-17 05:03:14', '2018-01-17 05:03:14'),
(264, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-01-22 05:00:51', '2018-01-22 05:00:51'),
(265, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-01-22 05:00:52', '2018-01-22 05:00:52'),
(266, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-01-22 07:53:20', '2018-01-22 07:53:20'),
(267, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.132.34', '2018-01-22 11:12:42', '2018-01-22 11:12:42'),
(268, 1, 'authentication', NULL, NULL, 'activity_logged_in', '37.111.201.226', '2018-01-22 11:54:45', '2018-01-22 11:54:45'),
(269, 1, 'authentication', NULL, NULL, 'activity_logged_in', '202.168.235.145', '2018-01-22 12:00:54', '2018-01-22 12:00:54'),
(270, 1, 'authentication', NULL, NULL, 'activity_logged_in', '202.168.235.145', '2018-01-22 12:08:27', '2018-01-22 12:08:27'),
(271, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-01-23 09:58:37', '2018-01-23 09:58:37'),
(272, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-01-23 09:58:38', '2018-01-23 09:58:38'),
(273, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-01-25 06:52:58', '2018-01-25 06:52:58'),
(274, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-01-25 06:52:59', '2018-01-25 06:52:59'),
(275, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-01-25 11:04:44', '2018-01-25 11:04:44'),
(276, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.208.214', '2018-02-03 07:27:36', '2018-02-03 07:27:36'),
(277, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-02-03 07:27:37', '2018-02-03 07:27:37'),
(278, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.208.214', '2018-02-03 09:31:06', '2018-02-03 09:31:06'),
(279, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-04 06:22:37', '2018-02-04 06:22:37'),
(280, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-02-04 06:22:38', '2018-02-04 06:22:38'),
(281, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-04 07:22:59', '2018-02-04 07:22:59'),
(282, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-04 08:06:07', '2018-02-04 08:06:07'),
(283, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-04 09:57:58', '2018-02-04 09:57:58'),
(284, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.204.210.154', '2018-02-04 09:59:34', '2018-02-04 09:59:34'),
(285, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.204.210.154', '2018-02-04 09:59:40', '2018-02-04 09:59:40'),
(286, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.204.210.154', '2018-02-04 10:19:59', '2018-02-04 10:19:59'),
(287, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.204.210.154', '2018-02-04 10:20:04', '2018-02-04 10:20:04'),
(288, 1, 'holiday', NULL, NULL, 'activity_updated', '103.204.210.154', '2018-02-04 11:29:28', '2018-02-04 11:29:28'),
(289, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-06 09:12:27', '2018-02-06 09:12:27'),
(290, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-02-06 09:12:27', '2018-02-06 09:12:27'),
(291, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-13 06:35:54', '2018-02-13 06:35:54'),
(292, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-02-13 06:35:55', '2018-02-13 06:35:55'),
(293, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-13 09:54:28', '2018-02-13 09:54:28'),
(294, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-13 11:17:36', '2018-02-13 11:17:36'),
(295, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.204.210.154', '2018-02-13 11:47:07', '2018-02-13 11:47:07'),
(296, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-14 04:38:51', '2018-02-14 04:38:51'),
(297, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-02-14 04:38:52', '2018-02-14 04:38:52'),
(298, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-14 04:49:11', '2018-02-14 04:49:11'),
(299, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-14 10:22:31', '2018-02-14 10:22:31'),
(300, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-14 10:59:06', '2018-02-14 10:59:06'),
(301, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-15 07:33:28', '2018-02-15 07:33:28'),
(302, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-02-15 07:33:29', '2018-02-15 07:33:29'),
(303, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-17 06:20:45', '2018-02-17 06:20:45'),
(304, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-02-17 06:20:46', '2018-02-17 06:20:46'),
(305, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-18 05:11:28', '2018-02-18 05:11:28'),
(306, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-02-18 05:11:29', '2018-02-18 05:11:29'),
(307, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-18 10:15:58', '2018-02-18 10:15:58'),
(308, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.103.35.154', '2018-02-22 20:01:42', '2018-02-22 20:01:42'),
(309, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-02-22 20:01:43', '2018-02-22 20:01:43'),
(310, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-24 05:36:23', '2018-02-24 05:36:23'),
(311, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-02-24 05:36:23', '2018-02-24 05:36:23'),
(312, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-27 11:44:31', '2018-02-27 11:44:31'),
(313, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-02-27 11:44:32', '2018-02-27 11:44:32'),
(314, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-02-28 04:40:18', '2018-02-28 04:40:18'),
(315, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-02-28 04:40:19', '2018-02-28 04:40:19'),
(316, 1, 'configuration', NULL, NULL, 'activity_permission_updated', '122.144.11.73', '2018-02-28 06:30:52', '2018-02-28 06:30:52'),
(317, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-02-28 06:32:17', '2018-02-28 06:32:17'),
(318, 1, 'authentication', NULL, NULL, 'activity_logged_out', '122.144.11.73', '2018-02-28 06:32:17', '2018-02-28 06:32:17'),
(319, 1, 'authentication', NULL, NULL, 'activity_logged_in', '122.144.11.73', '2018-02-28 06:32:29', '2018-02-28 06:32:29'),
(320, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-02-28 06:32:30', '2018-02-28 06:32:30'),
(321, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.103.33.22', '2018-03-01 19:52:31', '2018-03-01 19:52:31'),
(322, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-01 19:52:32', '2018-03-01 19:52:32'),
(323, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-03-03 04:16:28', '2018-03-03 04:16:28'),
(324, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-03 04:16:29', '2018-03-03 04:16:29'),
(325, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-03-03 11:03:29', '2018-03-03 11:03:29'),
(326, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.86.203.7', '2018-03-04 06:04:56', '2018-03-04 06:04:56'),
(327, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-04 06:04:57', '2018-03-04 06:04:57'),
(328, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.230.182.26', '2018-03-04 06:39:24', '2018-03-04 06:39:24'),
(329, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-03-04 09:42:25', '2018-03-04 09:42:25'),
(330, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.103.33.22', '2018-03-05 18:54:21', '2018-03-05 18:54:21'),
(331, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-05 18:54:22', '2018-03-05 18:54:22'),
(332, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-05 18:58:38', '2018-03-05 18:58:38'),
(333, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.103.33.22', '2018-03-05 18:58:38', '2018-03-05 18:58:38'),
(334, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-03-06 11:56:35', '2018-03-06 11:56:35'),
(335, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-06 11:56:35', '2018-03-06 11:56:35'),
(336, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-03-07 04:52:29', '2018-03-07 04:52:29'),
(337, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-07 04:52:29', '2018-03-07 04:52:29'),
(338, 1, 'role', 5, NULL, 'activity_added', '103.204.210.154', '2018-03-07 05:00:31', '2018-03-07 05:00:31'),
(339, 1, 'configuration', NULL, NULL, 'activity_api_token_updated', '103.204.210.154', '2018-03-07 05:19:08', '2018-03-07 05:19:08'),
(340, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-03-08 07:48:21', '2018-03-08 07:48:21'),
(341, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-08 07:48:22', '2018-03-08 07:48:22'),
(342, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.48.71.154', '2018-03-10 18:46:27', '2018-03-10 18:46:27'),
(343, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-10 18:46:28', '2018-03-10 18:46:28'),
(344, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.103.33.22', '2018-03-12 17:27:54', '2018-03-12 17:27:54'),
(345, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-12 17:27:54', '2018-03-12 17:27:54'),
(346, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.48.71.154', '2018-03-12 17:28:24', '2018-03-12 17:28:24'),
(347, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.103.33.22', '2018-03-12 18:49:10', '2018-03-12 18:49:10'),
(348, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-12 18:49:11', '2018-03-12 18:49:11'),
(349, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-03-13 06:49:45', '2018-03-13 06:49:45'),
(350, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.92.161.2', '2018-03-13 09:07:01', '2018-03-13 09:07:01'),
(351, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.103.33.22', '2018-03-13 15:11:01', '2018-03-13 15:11:01'),
(352, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-03-14 04:26:19', '2018-03-14 04:26:19'),
(353, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-14 04:26:19', '2018-03-14 04:26:19'),
(354, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.92.161.2', '2018-03-14 06:07:06', '2018-03-14 06:07:06'),
(355, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.48.86.30', '2018-03-15 10:27:21', '2018-03-15 10:27:21'),
(356, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-15 10:27:22', '2018-03-15 10:27:22'),
(357, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-03-24 06:02:15', '2018-03-24 06:02:15'),
(358, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-24 06:02:16', '2018-03-24 06:02:16'),
(359, 1, 'holiday', NULL, NULL, 'activity_added', '103.204.210.154', '2018-03-24 06:09:22', '2018-03-24 06:09:22'),
(360, 1, 'expense', 2, NULL, 'activity_added', '103.204.210.154', '2018-03-24 06:16:08', '2018-03-24 06:16:08'),
(361, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.85.27', '2018-03-27 08:23:25', '2018-03-27 08:23:25'),
(362, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-27 08:23:26', '2018-03-27 08:23:26'),
(363, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.85.27', '2018-03-27 08:38:49', '2018-03-27 08:38:49'),
(364, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-27 08:55:10', '2018-03-27 08:55:10'),
(365, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.230.105.5', '2018-03-27 08:55:10', '2018-03-27 08:55:10'),
(366, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.230.105.5', '2018-03-27 08:55:23', '2018-03-27 08:55:23'),
(367, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-27 08:55:23', '2018-03-27 08:55:23'),
(368, 1, 'ticket', 1, NULL, 'activity_added', '103.230.107.28', '2018-03-27 09:20:40', '2018-03-27 09:20:40'),
(369, 1, 'job', 1, NULL, 'activity_added', '103.230.107.28', '2018-03-27 09:24:25', '2018-03-27 09:24:25'),
(370, 1, 'job', 1, NULL, 'activity_updated', '103.230.107.28', '2018-03-27 09:24:49', '2018-03-27 09:24:49'),
(371, 1, 'expense', 3, NULL, 'activity_added', '103.230.107.28', '2018-03-27 09:25:44', '2018-03-27 09:25:44'),
(372, 1, 'employee', 10, NULL, 'activity_added', '103.230.107.28', '2018-03-27 09:39:27', '2018-03-27 09:39:27'),
(373, 1, 'employee', 10, NULL, 'activity_profile_updated', '103.230.107.28', '2018-03-27 09:40:49', '2018-03-27 09:40:49'),
(374, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-03-29 06:28:29', '2018-03-29 06:28:29'),
(375, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-03-29 06:28:30', '2018-03-29 06:28:30'),
(376, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-04-11 06:47:43', '2018-04-11 06:47:43'),
(377, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-04-11 06:47:44', '2018-04-11 06:47:44'),
(378, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-05-08 05:19:46', '2018-05-08 05:19:46'),
(379, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-05-08 05:19:46', '2018-05-08 05:19:46'),
(380, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-05-08 11:36:56', '2018-05-08 11:36:56'),
(381, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.230.182.26', '2018-05-21 06:51:03', '2018-05-21 06:51:03'),
(382, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-05-21 06:51:03', '2018-05-21 06:51:03'),
(383, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-05-21 06:51:10', '2018-05-21 06:51:10'),
(384, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-05-21 07:11:33', '2018-05-21 07:11:33'),
(385, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.230.182.26', '2018-05-21 07:11:33', '2018-05-21 07:11:33'),
(386, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-05-22 04:54:37', '2018-05-22 04:54:37'),
(387, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-05-22 04:54:37', '2018-05-22 04:54:37'),
(388, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-05-22 09:27:58', '2018-05-22 09:27:58'),
(389, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-05-23 07:46:39', '2018-05-23 07:46:39'),
(390, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-05-23 07:46:39', '2018-05-23 07:46:39'),
(391, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-05-23 08:35:35', '2018-05-23 08:35:35'),
(392, 1, 'employee', 7, NULL, 'activity_profile_updated', '103.204.210.154', '2018-05-23 08:39:14', '2018-05-23 08:39:14'),
(393, 1, 'employee', 7, NULL, 'activity_profile_updated', '103.204.210.154', '2018-05-23 08:39:22', '2018-05-23 08:39:22'),
(394, 1, 'leave_type', 4, NULL, 'activity_added', '103.204.210.154', '2018-05-23 09:27:40', '2018-05-23 09:27:40'),
(395, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-05-27 10:50:30', '2018-05-27 10:50:30'),
(396, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-05-27 10:50:30', '2018-05-27 10:50:30'),
(397, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.204.210.154', '2018-07-24 09:09:46', '2018-07-24 09:09:46'),
(398, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-07-24 09:09:46', '2018-07-24 09:09:46'),
(399, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2018-08-11 09:28:04', '2018-08-11 09:28:04'),
(400, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-08-11 09:28:05', '2018-08-11 09:28:05'),
(401, 1, 'authentication', NULL, NULL, 'activity_logged_in', '123.49.60.82', '2018-08-12 09:54:30', '2018-08-12 09:54:30'),
(402, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-08-12 09:54:31', '2018-08-12 09:54:31'),
(403, 1, 'authentication', NULL, NULL, 'activity_logged_in', '165.225.104.60', '2018-10-24 07:07:00', '2018-10-24 07:07:00'),
(404, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-10-24 07:07:00', '2018-10-24 07:07:00'),
(405, 1, 'leave_type', 5, NULL, 'activity_added', '165.225.104.60', '2018-10-24 07:14:14', '2018-10-24 07:14:14'),
(406, 1, 'leave_type', 4, NULL, 'activity_deleted', '165.225.104.60', '2018-10-24 07:14:21', '2018-10-24 07:14:21'),
(407, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.149.98', '2018-10-25 10:32:28', '2018-10-25 10:32:28'),
(408, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-10-25 10:32:28', '2018-10-25 10:32:28'),
(409, 1, 'authentication', NULL, NULL, 'activity_logged_in', '37.111.234.237', '2018-10-25 10:32:33', '2018-10-25 10:32:33'),
(410, 1, 'authentication', NULL, NULL, 'activity_logged_in', '113.11.22.239', '2018-10-25 18:13:50', '2018-10-25 18:13:50'),
(411, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-10-25 18:13:51', '2018-10-25 18:13:51'),
(412, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-10-25 18:15:37', '2018-10-25 18:15:37'),
(413, 1, 'authentication', NULL, NULL, 'activity_logged_out', '113.11.22.239', '2018-10-25 18:15:37', '2018-10-25 18:15:37'),
(414, 1, 'authentication', NULL, NULL, 'activity_logged_in', '203.112.77.125', '2018-10-27 20:11:13', '2018-10-27 20:11:13'),
(415, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-10-27 20:11:14', '2018-10-27 20:11:14'),
(416, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2018-12-02 07:19:22', '2018-12-02 07:19:22'),
(417, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2018-12-02 07:19:22', '2018-12-02 07:19:22'),
(418, 1, 'authentication', NULL, NULL, 'activity_logged_in', '77.111.246.55', '2019-02-03 03:21:17', '2019-02-03 03:21:17'),
(419, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-02-03 03:21:17', '2019-02-03 03:21:17'),
(420, 1, 'configuration', NULL, NULL, 'activity_permission_updated', '77.111.246.55', '2019-02-03 05:06:54', '2019-02-03 05:06:54');
INSERT INTO `activities` (`id`, `user_id`, `module`, `unique_id`, `secondary_id`, `activity`, `ip`, `created_at`, `updated_at`) VALUES
(421, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-02-03 06:30:50', '2019-02-03 06:30:50'),
(422, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-02-03 09:29:33', '2019-02-03 09:29:33'),
(423, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-02-04 04:28:30', '2019-02-04 04:28:30'),
(424, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-02-04 04:28:31', '2019-02-04 04:28:31'),
(425, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-02-04 12:21:41', '2019-02-04 12:21:41'),
(426, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-02-05 04:26:24', '2019-02-05 04:26:24'),
(427, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-02-05 04:26:24', '2019-02-05 04:26:24'),
(428, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-02-10 09:12:40', '2019-02-10 09:12:40'),
(429, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-02-10 09:12:40', '2019-02-10 09:12:40'),
(430, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-02-14 06:24:57', '2019-02-14 06:24:57'),
(431, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-02-14 06:24:57', '2019-02-14 06:24:57'),
(432, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-02-16 11:43:07', '2019-02-16 11:43:07'),
(433, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-02-16 11:43:08', '2019-02-16 11:43:08'),
(434, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-02-25 04:28:43', '2019-02-25 04:28:43'),
(435, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-02-25 04:28:44', '2019-02-25 04:28:44'),
(436, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-03-03 09:17:56', '2019-03-03 09:17:56'),
(437, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-03-03 09:17:56', '2019-03-03 09:17:56'),
(438, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-03-03 09:39:42', '2019-03-03 09:39:42'),
(439, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-05-08 07:13:39', '2019-05-08 07:13:39'),
(440, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-05-08 07:13:40', '2019-05-08 07:13:40'),
(441, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.182.30', '2019-05-23 03:57:49', '2019-05-23 03:57:49'),
(442, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-05-23 03:57:50', '2019-05-23 03:57:50'),
(443, 1, 'authentication', NULL, NULL, 'activity_logged_in', '119.30.39.230', '2019-05-23 06:07:13', '2019-05-23 06:07:13'),
(444, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-06-10 05:54:08', '2019-06-10 05:54:08'),
(445, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-06-10 05:54:08', '2019-06-10 05:54:08'),
(446, 1, 'office_shift', NULL, 7, 'activity_added', '61.247.177.245', '2019-06-10 05:58:23', '2019-06-10 05:58:23'),
(447, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-06-12 06:58:52', '2019-06-12 06:58:52'),
(448, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-06-12 06:58:52', '2019-06-12 06:58:52'),
(449, 1, 'task', 1, NULL, 'activity_added', '61.247.177.245', '2019-06-12 07:12:09', '2019-06-12 07:12:09'),
(450, 1, 'ticket', 2, NULL, 'activity_added', '61.247.177.245', '2019-06-12 07:12:56', '2019-06-12 07:12:56'),
(451, 1, 'authentication', NULL, NULL, 'activity_logged_in', '176.113.72.179', '2019-06-20 12:11:15', '2019-06-20 12:11:15'),
(452, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-06-20 12:11:15', '2019-06-20 12:11:15'),
(453, 1, 'authentication', NULL, NULL, 'activity_logged_in', '176.113.72.179', '2019-06-23 07:58:35', '2019-06-23 07:58:35'),
(454, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-06-23 07:58:36', '2019-06-23 07:58:36'),
(455, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-06-23 09:04:54', '2019-06-23 09:04:54'),
(456, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-06-23 09:04:55', '2019-06-23 09:04:55'),
(457, 1, 'task', 2, NULL, 'activity_added', '176.113.72.179', '2019-06-23 09:11:40', '2019-06-23 09:11:40'),
(458, 1, 'authentication', NULL, NULL, 'activity_logged_in', '176.113.72.179', '2019-06-23 12:07:21', '2019-06-23 12:07:21'),
(459, 1, 'authentication', NULL, NULL, 'activity_logged_in', '176.113.72.179', '2019-06-24 06:08:22', '2019-06-24 06:08:22'),
(460, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-06-24 06:08:22', '2019-06-24 06:08:22'),
(461, 1, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-06-24 06:08:25', '2019-06-24 06:08:25'),
(462, 1, 'employee', 12, NULL, 'activity_updated', '61.247.177.245', '2019-06-24 06:17:44', '2019-06-24 06:17:44'),
(463, 1, 'employee', 14, NULL, 'activity_added', '61.247.177.245', '2019-06-24 06:20:49', '2019-06-24 06:20:49'),
(464, 14, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-06-24 06:21:29', '2019-06-24 06:21:29'),
(465, 14, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-06-24 06:21:29', '2019-06-24 06:21:29'),
(466, 14, 'todo', 1, NULL, 'activity_added', '61.247.177.245', '2019-06-24 06:23:57', '2019-06-24 06:23:57'),
(467, 1, 'holiday', NULL, NULL, 'activity_added', '61.247.177.245', '2019-06-24 06:30:15', '2019-06-24 06:30:15'),
(468, 1, 'configuration', NULL, NULL, 'activity_permission_updated', '61.247.177.245', '2019-06-24 06:35:05', '2019-06-24 06:35:05'),
(469, 1, 'contract', 4, 7, 'activity_added', '61.247.177.245', '2019-06-24 06:38:20', '2019-06-24 06:38:20'),
(470, 14, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-06-24 06:39:12', '2019-06-24 06:39:12'),
(471, 14, 'authentication', NULL, NULL, 'activity_logged_out', '61.247.177.245', '2019-06-24 06:39:12', '2019-06-24 06:39:12'),
(472, 14, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-06-24 06:39:17', '2019-06-24 06:39:17'),
(473, 14, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-06-24 06:39:17', '2019-06-24 06:39:17'),
(474, 1, 'contract', 5, 14, 'activity_added', '61.247.177.245', '2019-06-24 06:41:25', '2019-06-24 06:41:25'),
(475, 1, 'configuration', NULL, NULL, 'activity_permission_updated', '61.247.177.245', '2019-06-24 06:49:45', '2019-06-24 06:49:45'),
(476, 1, 'leave', NULL, 7, 'activity_updated', '176.113.72.179', '2019-06-24 06:53:22', '2019-06-24 06:53:22'),
(477, 1, 'employee', 14, NULL, 'activity_profile_updated', '61.247.177.245', '2019-06-24 06:54:11', '2019-06-24 06:54:11'),
(478, 1, 'employee', 14, NULL, 'activity_profile_updated', '61.247.177.245', '2019-06-24 06:54:16', '2019-06-24 06:54:16'),
(479, 1, 'contract', 5, 14, 'activity_updated', '61.247.177.245', '2019-06-24 06:55:31', '2019-06-24 06:55:31'),
(480, 1, 'salary', NULL, 14, 'activity_added', '61.247.177.245', '2019-06-24 06:56:29', '2019-06-24 06:56:29'),
(481, 1, 'salary', NULL, 14, 'activity_updated', '61.247.177.245', '2019-06-24 06:56:38', '2019-06-24 06:56:38'),
(482, 1, 'leave', NULL, 14, 'activity_updated', '61.247.177.245', '2019-06-24 06:57:00', '2019-06-24 06:57:00'),
(483, 1, 'office_shift', NULL, 14, 'activity_added', '61.247.177.245', '2019-06-24 06:57:18', '2019-06-24 06:57:18'),
(484, 1, 'office_shift', NULL, 14, 'activity_updated', '61.247.177.245', '2019-06-24 06:57:26', '2019-06-24 06:57:26'),
(485, 14, 'leave', 5, NULL, 'activity_added', '61.247.177.245', '2019-06-24 06:57:35', '2019-06-24 06:57:35'),
(486, 1, 'employee', 14, NULL, 'activity_updated', '61.247.177.245', '2019-06-24 06:59:34', '2019-06-24 06:59:34'),
(487, 1, 'leave', 5, NULL, 'activity_status_updated', '61.247.177.245', '2019-06-24 07:02:32', '2019-06-24 07:02:32'),
(488, 14, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-06-24 07:03:27', '2019-06-24 07:03:27'),
(489, 1, 'award', 1, NULL, 'activity_added', '61.247.177.245', '2019-06-24 07:05:12', '2019-06-24 07:05:12'),
(490, 1, 'task', 3, NULL, 'activity_added', '61.247.177.245', '2019-06-24 07:06:40', '2019-06-24 07:06:40'),
(491, 1, 'announcement', 1, NULL, 'activity_updated', '61.247.177.245', '2019-06-24 07:07:38', '2019-06-24 07:07:38'),
(492, 1, 'announcement', 2, NULL, 'activity_added', '61.247.177.245', '2019-06-24 07:08:49', '2019-06-24 07:08:49'),
(493, 1, 'announcement', 2, NULL, 'activity_updated', '61.247.177.245', '2019-06-24 07:09:14', '2019-06-24 07:09:14'),
(494, 1, 'job', 2, NULL, 'activity_added', '61.247.177.245', '2019-06-24 07:11:49', '2019-06-24 07:11:49'),
(495, 1, 'job', 1, NULL, 'activity_updated', '61.247.177.245', '2019-06-24 07:13:02', '2019-06-24 07:13:02'),
(496, 1, 'configuration', NULL, NULL, 'activity_permission_updated', '61.247.177.245', '2019-06-24 07:20:53', '2019-06-24 07:20:53'),
(497, 1, 'payroll', 3, NULL, 'activity_updated', '61.247.177.245', '2019-06-24 07:22:45', '2019-06-24 07:22:45'),
(498, 1, 'payroll', 3, NULL, 'activity_updated', '61.247.177.245', '2019-06-24 07:23:13', '2019-06-24 07:23:13'),
(499, 1, 'ticket', 3, NULL, 'activity_added', '61.247.177.245', '2019-06-24 07:37:32', '2019-06-24 07:37:32'),
(500, 1, 'employee', 7, NULL, 'activity_updated', '61.247.177.245', '2019-06-24 07:50:54', '2019-06-24 07:50:54'),
(501, 1, 'expense', 4, NULL, 'activity_added', '61.247.177.245', '2019-06-24 07:54:27', '2019-06-24 07:54:27'),
(502, 1, 'message', 14, NULL, 'activity_message_sent', '61.247.177.245', '2019-06-24 08:00:07', '2019-06-24 08:00:07'),
(503, 1, 'configuration', NULL, NULL, 'activity_permission_updated', '61.247.177.245', '2019-06-24 08:01:17', '2019-06-24 08:01:17'),
(504, 1, 'configuration', NULL, NULL, 'activity_permission_updated', '61.247.177.245', '2019-06-24 08:02:44', '2019-06-24 08:02:44'),
(505, 1, 'template', NULL, NULL, 'activity_updated', '61.247.177.245', '2019-06-24 08:07:11', '2019-06-24 08:07:11'),
(506, 1, 'template', NULL, NULL, 'activity_updated', '61.247.177.245', '2019-06-24 08:07:22', '2019-06-24 08:07:22'),
(507, 1, 'template', NULL, NULL, 'activity_updated', '61.247.177.245', '2019-06-24 08:07:31', '2019-06-24 08:07:31'),
(508, 1, 'message', 14, NULL, 'activity_message_sent', '61.247.177.245', '2019-06-24 08:08:51', '2019-06-24 08:08:51'),
(509, 1, 'office_shift', NULL, 7, 'activity_updated', '61.247.177.245', '2019-06-24 09:20:35', '2019-06-24 09:20:35'),
(510, 14, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-06-24 09:26:12', '2019-06-24 09:26:12'),
(511, 14, 'authentication', NULL, NULL, 'activity_logged_out', '61.247.177.245', '2019-06-24 09:26:12', '2019-06-24 09:26:12'),
(512, 14, 'authentication', NULL, NULL, 'activity_logged_in', '61.247.177.245', '2019-06-24 11:09:06', '2019-06-24 11:09:06'),
(513, 14, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-06-24 11:09:06', '2019-06-24 11:09:06'),
(514, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.51', '2019-09-01 20:17:02', '2019-09-01 20:17:02'),
(515, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-09-01 20:17:03', '2019-09-01 20:17:03'),
(516, 1, 'configuration', NULL, NULL, 'activity_configuration_updated', '103.115.116.51', '2019-09-01 20:18:21', '2019-09-01 20:18:21'),
(517, 1, 'employee', 1, NULL, 'activity_updated', '103.115.116.51', '2019-09-01 20:25:06', '2019-09-01 20:25:06'),
(518, 1, 'employee', 1, NULL, 'activity_updated', '103.115.116.51', '2019-09-01 20:25:33', '2019-09-01 20:25:33'),
(519, 1, 'authentication', NULL, NULL, 'activity_logged_in', '119.30.38.236', '2019-09-02 05:31:17', '2019-09-02 05:31:17'),
(520, 1, 'custom_field', 1, NULL, 'activity_added', '119.30.38.236', '2019-09-02 05:55:09', '2019-09-02 05:55:09'),
(521, 1, 'job', 1, NULL, 'activity_updated', '119.30.38.236', '2019-09-02 06:02:57', '2019-09-02 06:02:57'),
(522, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-09-11 10:39:55', '2019-09-11 10:39:55'),
(523, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-09-11 10:39:55', '2019-09-11 10:39:55'),
(524, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-09-18 07:10:52', '2019-09-18 07:10:52'),
(525, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-09-18 07:10:52', '2019-09-18 07:10:52'),
(526, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.115.116.62', '2019-09-18 08:51:30', '2019-09-18 08:51:30'),
(527, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.115.116.62', '2019-09-18 08:51:38', '2019-09-18 08:51:38'),
(528, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-09-19 04:23:34', '2019-09-19 04:23:34'),
(529, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-09-19 04:23:34', '2019-09-19 04:23:34'),
(530, 1, 'backup', 1, NULL, 'activity_backup_generated', '103.115.116.62', '2019-09-19 07:25:34', '2019-09-19 07:25:34'),
(531, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.115.116.62', '2019-09-19 07:28:30', '2019-09-19 07:28:30'),
(532, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.115.116.62', '2019-09-19 07:28:38', '2019-09-19 07:28:38'),
(533, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-09-21 04:39:36', '2019-09-21 04:39:36'),
(534, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-09-21 04:39:36', '2019-09-21 04:39:36'),
(535, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-09-25 08:48:13', '2019-09-25 08:48:13'),
(536, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-09-25 08:48:13', '2019-09-25 08:48:13'),
(537, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.115.116.62', '2019-09-25 08:48:52', '2019-09-25 08:48:52'),
(538, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.115.116.62', '2019-09-25 08:48:58', '2019-09-25 08:48:58'),
(539, 1, 'message', 2, NULL, 'activity_message_sent', '103.115.116.62', '2019-09-25 08:52:34', '2019-09-25 08:52:34'),
(540, 1, 'expense', 3, NULL, 'activity_deleted', '103.115.116.62', '2019-09-25 09:44:04', '2019-09-25 09:44:04'),
(541, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.115.116.62', '2019-09-25 10:21:57', '2019-09-25 10:21:57'),
(542, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-09-26 11:36:53', '2019-09-26 11:36:53'),
(543, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-09-26 11:36:53', '2019-09-26 11:36:53'),
(544, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-09-28 10:27:09', '2019-09-28 10:27:09'),
(545, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-09-28 10:27:10', '2019-09-28 10:27:10'),
(546, 1, 'authentication', NULL, NULL, 'activity_logged_in', '202.191.127.220', '2019-10-03 10:32:27', '2019-10-03 10:32:27'),
(547, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-10-03 10:32:27', '2019-10-03 10:32:27'),
(548, 1, 'task', 1, NULL, 'activity_status_updated', '202.191.127.220', '2019-10-03 10:34:11', '2019-10-03 10:34:11'),
(549, 1, 'authentication', NULL, NULL, 'activity_logged_in', '119.30.45.188', '2019-10-23 10:35:33', '2019-10-23 10:35:33'),
(550, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-10-23 10:35:34', '2019-10-23 10:35:34'),
(551, 1, 'authentication', NULL, NULL, 'activity_logged_in', '202.191.127.220', '2019-12-01 09:22:03', '2019-12-01 09:22:03'),
(552, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-01 09:22:03', '2019-12-01 09:22:03'),
(553, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-12-04 10:41:37', '2019-12-04 10:41:37'),
(554, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-04 10:41:38', '2019-12-04 10:41:38'),
(555, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.115.116.62', '2019-12-04 10:45:50', '2019-12-04 10:45:50'),
(556, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.115.116.62', '2019-12-04 10:45:53', '2019-12-04 10:45:53'),
(557, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.115.116.62', '2019-12-04 10:45:55', '2019-12-04 10:45:55'),
(558, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-12-05 04:11:22', '2019-12-05 04:11:22'),
(559, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-05 04:11:23', '2019-12-05 04:11:23'),
(560, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-05 06:38:43', '2019-12-05 06:38:43'),
(561, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.115.116.62', '2019-12-05 06:38:43', '2019-12-05 06:38:43'),
(562, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.67.157.35', '2019-12-05 10:53:59', '2019-12-05 10:53:59'),
(563, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-05 10:53:59', '2019-12-05 10:53:59'),
(564, 1, 'authentication', NULL, NULL, 'activity_logged_in', '202.134.9.145', '2019-12-06 13:57:00', '2019-12-06 13:57:00'),
(565, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-06 13:57:01', '2019-12-06 13:57:01'),
(566, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-12-11 11:48:24', '2019-12-11 11:48:24'),
(567, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-11 11:48:24', '2019-12-11 11:48:24'),
(568, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-11 11:59:31', '2019-12-11 11:59:31'),
(569, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.115.116.62', '2019-12-11 11:59:31', '2019-12-11 11:59:31'),
(570, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-12-15 12:00:20', '2019-12-15 12:00:20'),
(571, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-15 12:00:20', '2019-12-15 12:00:20'),
(572, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-12-17 05:18:25', '2019-12-17 05:18:25'),
(573, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-17 05:18:26', '2019-12-17 05:18:26'),
(574, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-12-17 06:20:23', '2019-12-17 06:20:23'),
(575, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.206.40', '2019-12-21 13:44:50', '2019-12-21 13:44:50'),
(576, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-21 13:44:51', '2019-12-21 13:44:51'),
(577, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-21 13:46:32', '2019-12-21 13:46:32'),
(578, 1, 'authentication', NULL, NULL, 'activity_logged_out', '27.147.206.40', '2019-12-21 13:46:32', '2019-12-21 13:46:32'),
(579, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-12-22 09:56:24', '2019-12-22 09:56:24'),
(580, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-22 09:56:25', '2019-12-22 09:56:25'),
(581, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-22 09:57:17', '2019-12-22 09:57:17'),
(582, 1, 'authentication', NULL, NULL, 'activity_logged_out', '64.233.173.58', '2019-12-22 09:57:17', '2019-12-22 09:57:17'),
(583, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2019-12-25 07:20:30', '2019-12-25 07:20:30'),
(584, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2019-12-25 07:20:30', '2019-12-25 07:20:30'),
(585, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2020-01-03 19:12:40', '2020-01-03 19:12:40'),
(586, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-01-03 19:12:40', '2020-01-03 19:12:40'),
(587, 1, 'role', 3, NULL, 'activity_updated', '103.115.116.61', '2020-01-03 20:13:41', '2020-01-03 20:13:41'),
(588, 1, 'custom_field', 2, NULL, 'activity_added', '103.115.116.61', '2020-01-03 20:21:48', '2020-01-03 20:21:48'),
(589, 1, 'employee', 15, NULL, 'activity_added', '103.115.116.61', '2020-01-03 20:23:26', '2020-01-03 20:23:26'),
(590, 1, 'backup', 2, NULL, 'activity_backup_generated', '103.115.116.61', '2020-01-03 20:26:09', '2020-01-03 20:26:09'),
(591, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2020-01-05 07:25:52', '2020-01-05 07:25:52'),
(592, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-01-05 07:25:53', '2020-01-05 07:25:53'),
(593, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2020-01-09 05:51:22', '2020-01-09 05:51:22'),
(594, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-01-09 05:51:22', '2020-01-09 05:51:22'),
(595, 1, 'configuration', NULL, NULL, 'activity_configuration_updated', '103.115.116.61', '2020-01-09 05:51:50', '2020-01-09 05:51:50'),
(596, 1, 'authentication', NULL, NULL, 'activity_logged_in', '115.127.27.230', '2020-01-09 11:13:09', '2020-01-09 11:13:09'),
(597, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.10.55.218', '2020-01-12 10:20:28', '2020-01-12 10:20:28'),
(598, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-01-12 10:20:28', '2020-01-12 10:20:28'),
(599, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-01-12 11:29:27', '2020-01-12 11:29:27'),
(600, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.10.55.218', '2020-01-12 11:29:27', '2020-01-12 11:29:27'),
(601, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2020-02-13 09:11:21', '2020-02-13 09:11:21'),
(602, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-02-13 09:11:21', '2020-02-13 09:11:21'),
(603, 1, 'authentication', NULL, NULL, 'activity_logged_in', '115.127.64.38', '2020-02-24 09:34:55', '2020-02-24 09:34:55'),
(604, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-02-24 09:34:55', '2020-02-24 09:34:55'),
(605, 1, 'clock', NULL, NULL, 'activity_clock_in', '115.127.64.38', '2020-02-24 09:37:36', '2020-02-24 09:37:36'),
(606, 1, 'clock', NULL, NULL, 'activity_clock_in', '115.127.64.38', '2020-02-24 09:37:57', '2020-02-24 09:37:57'),
(607, 1, 'message', 7, NULL, 'activity_message_sent', '115.127.64.38', '2020-02-24 09:41:32', '2020-02-24 09:41:32'),
(608, 1, 'document', 1, 3, 'activity_added', '115.127.64.38', '2020-02-24 09:46:27', '2020-02-24 09:46:27'),
(609, 1, 'bank_account', 1, 3, 'activity_added', '115.127.64.38', '2020-02-24 09:49:05', '2020-02-24 09:49:05'),
(610, 1, 'bank_account', 1, 3, 'activity_updated', '115.127.64.38', '2020-02-24 09:49:51', '2020-02-24 09:49:51'),
(611, 1, 'bank_account', 2, 3, 'activity_added', '115.127.64.38', '2020-02-24 09:50:46', '2020-02-24 09:50:46'),
(612, 1, 'bank_account', 2, 3, 'activity_updated', '115.127.64.38', '2020-02-24 09:51:24', '2020-02-24 09:51:24'),
(613, 1, 'contract', 6, 3, 'activity_added', '115.127.64.38', '2020-02-24 09:53:22', '2020-02-24 09:53:22'),
(614, 1, 'salary', NULL, 3, 'activity_added', '115.127.64.38', '2020-02-24 09:56:34', '2020-02-24 09:56:34'),
(615, 1, 'salary', NULL, 3, 'activity_added', '115.127.64.38', '2020-02-24 09:58:03', '2020-02-24 09:58:03'),
(616, 1, 'salary_type', 9, NULL, 'activity_added', '115.127.64.38', '2020-02-24 10:01:33', '2020-02-24 10:01:33'),
(617, 1, 'salary_type', 10, NULL, 'activity_added', '115.127.64.38', '2020-02-24 10:01:59', '2020-02-24 10:01:59'),
(618, 1, 'contract', 6, 3, 'activity_updated', '115.127.64.38', '2020-02-24 10:05:31', '2020-02-24 10:05:31'),
(619, 1, 'contact', 2, 3, 'activity_added', '115.127.64.38', '2020-02-24 10:08:33', '2020-02-24 10:08:33'),
(620, 1, 'leave', NULL, 3, 'activity_updated', '115.127.64.38', '2020-02-24 10:12:21', '2020-02-24 10:12:21'),
(621, 1, 'leave_type', 5, NULL, 'activity_deleted', '115.127.64.38', '2020-02-24 10:14:44', '2020-02-24 10:14:44'),
(622, 1, 'leave_type', 6, NULL, 'activity_added', '115.127.64.38', '2020-02-24 10:15:09', '2020-02-24 10:15:09'),
(623, 1, 'contract', 7, 1, 'activity_added', '115.127.64.38', '2020-02-24 10:20:12', '2020-02-24 10:20:12'),
(624, 1, 'leave', NULL, 1, 'activity_updated', '115.127.64.38', '2020-02-24 10:21:22', '2020-02-24 10:21:22'),
(625, 1, 'leave', 6, NULL, 'activity_added', '115.127.64.38', '2020-02-24 10:21:44', '2020-02-24 10:21:44'),
(626, 1, 'leave', 6, NULL, 'activity_status_updated', '115.127.64.38', '2020-02-24 10:23:31', '2020-02-24 10:23:31'),
(627, 1, 'leave', 6, NULL, 'activity_status_updated', '115.127.64.38', '2020-02-24 10:23:34', '2020-02-24 10:23:34'),
(628, 1, 'template', NULL, NULL, 'activity_added', '115.127.64.38', '2020-02-24 11:07:10', '2020-02-24 11:07:10'),
(629, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-02-24 11:20:58', '2020-02-24 11:20:58'),
(630, 1, 'authentication', NULL, NULL, 'activity_logged_out', '115.127.64.38', '2020-02-24 11:20:58', '2020-02-24 11:20:58'),
(631, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.156.253.126', '2020-03-12 10:45:51', '2020-03-12 10:45:51'),
(632, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-03-12 10:45:51', '2020-03-12 10:45:51'),
(633, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2020-03-13 14:28:05', '2020-03-13 14:28:05'),
(634, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-03-13 14:28:05', '2020-03-13 14:28:05'),
(635, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2020-03-19 12:06:56', '2020-03-19 12:06:56'),
(636, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-03-19 12:06:56', '2020-03-19 12:06:56'),
(637, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2020-03-23 04:43:56', '2020-03-23 04:43:56'),
(638, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-03-23 04:43:56', '2020-03-23 04:43:56'),
(639, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-03-23 04:45:06', '2020-03-23 04:45:06'),
(640, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.115.116.62', '2020-03-23 04:45:06', '2020-03-23 04:45:06'),
(641, 1, 'authentication', NULL, NULL, 'activity_logged_in', '46.140.188.245', '2020-03-31 09:31:43', '2020-03-31 09:31:43'),
(642, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-03-31 09:31:44', '2020-03-31 09:31:44'),
(643, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2020-04-20 05:28:32', '2020-04-20 05:28:32'),
(644, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-04-20 05:28:32', '2020-04-20 05:28:32'),
(645, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2020-05-02 23:08:36', '2020-05-02 23:08:36'),
(646, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-05-02 23:08:36', '2020-05-02 23:08:36'),
(647, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2020-05-06 06:28:06', '2020-05-06 06:28:06'),
(648, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-05-06 06:28:06', '2020-05-06 06:28:06'),
(649, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.203.177.24', '2020-05-21 08:32:46', '2020-05-21 08:32:46'),
(650, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-05-21 08:32:46', '2020-05-21 08:32:46'),
(651, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2020-06-28 07:18:36', '2020-06-28 07:18:36'),
(652, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-06-28 07:18:36', '2020-06-28 07:18:36'),
(653, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2020-09-01 10:18:43', '2020-09-01 10:18:43'),
(654, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-09-01 10:18:43', '2020-09-01 10:18:43'),
(655, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2020-10-12 02:43:59', '2020-10-12 02:43:59'),
(656, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-10-12 02:43:59', '2020-10-12 02:43:59'),
(657, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2020-10-12 04:44:47', '2020-10-12 04:44:47'),
(658, 1, 'authentication', NULL, NULL, 'activity_logged_in', '123.108.244.163', '2020-10-12 06:12:44', '2020-10-12 06:12:44'),
(659, 1, 'document_type', 7, NULL, 'activity_added', '123.108.244.163', '2020-10-12 06:41:35', '2020-10-12 06:41:35'),
(660, 1, 'custom_field', 3, NULL, 'activity_added', '123.108.244.163', '2020-10-12 06:52:49', '2020-10-12 06:52:49'),
(661, 1, 'task', 4, NULL, 'activity_added', '123.108.244.163', '2020-10-12 06:54:51', '2020-10-12 06:54:51'),
(662, 1, 'authentication', NULL, NULL, 'activity_employee_password_changed', '123.108.244.163', '2020-10-12 06:59:22', '2020-10-12 06:59:22'),
(663, 3, 'authentication', NULL, NULL, 'activity_logged_in', '123.108.244.163', '2020-10-12 07:00:58', '2020-10-12 07:00:58'),
(664, 3, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-10-12 07:00:58', '2020-10-12 07:00:58'),
(665, 1, 'message', 2, NULL, 'activity_message_sent', '123.108.244.163', '2020-10-12 07:14:08', '2020-10-12 07:14:08'),
(666, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2020-11-14 06:13:58', '2020-11-14 06:13:58'),
(667, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-11-14 06:13:58', '2020-11-14 06:13:58'),
(668, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2020-11-14 12:53:01', '2020-11-14 12:53:01'),
(669, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2020-11-18 09:31:38', '2020-11-18 09:31:38'),
(670, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-11-18 09:31:39', '2020-11-18 09:31:39'),
(671, 1, 'authentication', NULL, NULL, 'activity_logged_in', '116.204.148.108', '2020-11-19 01:44:50', '2020-11-19 01:44:50'),
(672, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-11-19 01:44:50', '2020-11-19 01:44:50'),
(673, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2020-11-19 10:11:17', '2020-11-19 10:11:17'),
(674, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2020-11-19 21:22:34', '2020-11-19 21:22:34'),
(675, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-11-19 21:22:34', '2020-11-19 21:22:34'),
(676, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2020-11-21 05:03:29', '2020-11-21 05:03:29'),
(677, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-11-21 05:03:29', '2020-11-21 05:03:29'),
(678, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-11-21 16:19:01', '2020-11-21 16:19:01'),
(679, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-11-21 16:19:03', '2020-11-21 16:19:03'),
(680, 1, 'authentication', NULL, NULL, 'activity_logged_in', '127.0.0.1', '2020-11-22 17:52:00', '2020-11-22 17:52:00'),
(681, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-11-22 17:52:01', '2020-11-22 17:52:01'),
(682, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-11-22 17:55:17', '2020-11-22 17:55:17'),
(683, 1, 'authentication', NULL, NULL, 'activity_logged_out', '127.0.0.1', '2020-11-22 17:55:17', '2020-11-22 17:55:17'),
(684, 1, 'authentication', NULL, NULL, 'activity_logged_in', '127.0.0.1', '2020-11-22 17:57:26', '2020-11-22 17:57:26'),
(685, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-11-22 17:57:27', '2020-11-22 17:57:27'),
(686, 1, 'authentication', NULL, NULL, 'activity_logged_in', '127.0.0.1', '2020-11-22 21:40:01', '2020-11-22 21:40:01'),
(687, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-11-23 16:45:17', '2020-11-23 16:45:17'),
(688, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-11-23 16:45:17', '2020-11-23 16:45:17'),
(689, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-11-24 17:29:17', '2020-11-24 17:29:17'),
(690, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-11-24 17:29:18', '2020-11-24 17:29:18'),
(691, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-11-24 21:55:07', '2020-11-24 21:55:07'),
(692, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-11-25 16:37:44', '2020-11-25 16:37:44'),
(693, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-11-25 16:37:45', '2020-11-25 16:37:45'),
(694, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-11-27 16:17:02', '2020-11-27 16:17:02'),
(695, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-11-27 16:17:04', '2020-11-27 16:17:04'),
(696, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-11-28 16:39:20', '2020-11-28 16:39:20'),
(697, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-11-28 16:39:22', '2020-11-28 16:39:22'),
(698, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-11-28 21:38:49', '2020-11-28 21:38:49'),
(699, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-11-29 16:38:24', '2020-11-29 16:38:24'),
(700, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-11-29 16:38:24', '2020-11-29 16:38:24'),
(701, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-11-30 16:11:29', '2020-11-30 16:11:29'),
(702, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-11-30 16:11:32', '2020-11-30 16:11:32'),
(703, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-11-30 22:45:38', '2020-11-30 22:45:38'),
(704, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-12-01 17:55:25', '2020-12-01 17:55:25'),
(705, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-12-01 17:55:26', '2020-12-01 17:55:26'),
(706, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-12-01 21:27:22', '2020-12-01 21:27:22'),
(707, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-12-02 16:50:55', '2020-12-02 16:50:55'),
(708, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-12-02 16:50:56', '2020-12-02 16:50:56'),
(709, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-12-04 16:41:39', '2020-12-04 16:41:39'),
(710, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-12-04 16:41:42', '2020-12-04 16:41:42'),
(711, 1, 'authentication', NULL, NULL, 'activity_logged_in', '::1', '2020-12-05 16:03:06', '2020-12-05 16:03:06'),
(712, 1, 'clock', NULL, NULL, 'activity_clock_in', '::1', '2020-12-05 16:03:08', '2020-12-05 16:03:08'),
(713, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2020-12-06 10:06:02', '2020-12-06 10:06:02'),
(714, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.151.1.114', '2020-12-06 10:18:45', '2020-12-06 10:18:45'),
(715, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.151.1.114', '2020-12-06 10:22:04', '2020-12-06 10:22:04'),
(716, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2020-12-08 08:00:32', '2020-12-08 08:00:32'),
(717, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2020-12-08 08:00:32', '2020-12-08 08:00:32'),
(718, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2020-12-08 08:49:34', '2020-12-08 08:49:34'),
(719, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2020-12-08 09:08:34', '2020-12-08 09:08:34'),
(720, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.115.116.62', '2020-12-08 09:08:34', '2020-12-08 09:08:34'),
(721, 1, 'authentication', NULL, NULL, 'activity_logged_in', '194.9.120.10', '2020-12-18 15:45:10', '2020-12-18 15:45:10'),
(722, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2020-12-18 15:45:11', '2020-12-18 15:45:11'),
(723, 1, 'authentication', NULL, NULL, 'activity_logged_in', '119.30.38.176', '2021-01-23 09:19:19', '2021-01-23 09:19:19'),
(724, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2021-01-23 09:19:19', '2021-01-23 09:19:19'),
(725, 1, 'leave', 7, NULL, 'activity_added', '119.30.38.176', '2021-01-23 09:23:08', '2021-01-23 09:23:08'),
(726, 1, 'leave', 7, NULL, 'activity_status_updated', '119.30.38.176', '2021-01-23 09:23:46', '2021-01-23 09:23:46'),
(727, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2021-02-25 06:32:04', '2021-02-25 06:32:04'),
(728, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2021-02-25 06:32:05', '2021-02-25 06:32:05'),
(729, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2021-02-25 06:32:11', '2021-02-25 06:32:11'),
(730, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.115.116.61', '2021-02-25 06:32:11', '2021-02-25 06:32:11'),
(731, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2021-02-25 06:32:25', '2021-02-25 06:32:25'),
(732, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2021-02-25 06:32:25', '2021-02-25 06:32:25'),
(733, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.160.103.125', '2021-02-25 06:34:35', '2021-02-25 06:34:35'),
(734, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2021-02-25 22:24:58', '2021-02-25 22:24:58'),
(735, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2021-02-25 22:24:58', '2021-02-25 22:24:58'),
(736, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.101.197.186', '2021-02-28 10:31:57', '2021-02-28 10:31:57'),
(737, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2021-02-28 10:31:57', '2021-02-28 10:31:57'),
(738, 1, 'authentication', NULL, NULL, 'activity_logged_in', '43.245.123.62', '2021-03-27 08:16:37', '2021-03-27 08:16:37'),
(739, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2021-03-27 08:16:37', '2021-03-27 08:16:37'),
(740, 1, 'leave', 8, NULL, 'activity_added', '43.245.123.62', '2021-03-27 09:45:57', '2021-03-27 09:45:57'),
(741, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2021-03-27 09:52:55', '2021-03-27 09:52:55'),
(742, 1, 'authentication', NULL, NULL, 'activity_logged_out', '43.245.123.62', '2021-03-27 09:52:55', '2021-03-27 09:52:55'),
(743, 1, 'authentication', NULL, NULL, 'activity_logged_in', '43.245.123.62', '2021-03-27 09:56:12', '2021-03-27 09:56:12'),
(744, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2021-03-27 09:56:12', '2021-03-27 09:56:12'),
(745, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2021-03-28 05:12:34', '2021-03-28 05:12:34'),
(746, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2021-03-28 05:12:34', '2021-03-28 05:12:34'),
(747, 1, 'custom_field', 4, NULL, 'activity_added', '103.115.116.61', '2021-03-28 05:19:24', '2021-03-28 05:19:24'),
(748, 1, 'leave', 9, NULL, 'activity_added', '103.115.116.61', '2021-03-28 05:46:16', '2021-03-28 05:46:16'),
(749, 1, 'leave', 9, NULL, 'activity_status_updated', '103.115.116.61', '2021-03-28 05:47:36', '2021-03-28 05:47:36'),
(750, 1, 'task', 4, NULL, 'activity_status_updated', '103.115.116.61', '2021-03-28 06:03:47', '2021-03-28 06:03:47'),
(751, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2021-03-28 06:11:18', '2021-03-28 06:11:18'),
(752, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.115.116.61', '2021-03-28 06:11:18', '2021-03-28 06:11:18'),
(753, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2021-03-28 06:11:52', '2021-03-28 06:11:52'),
(754, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2021-03-28 06:11:52', '2021-03-28 06:11:52'),
(755, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.61', '2021-04-01 08:14:01', '2021-04-01 08:14:01'),
(756, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2021-04-01 08:14:01', '2021-04-01 08:14:01'),
(757, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.155.52.55', '2021-04-11 12:17:27', '2021-04-11 12:17:27'),
(758, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.60.210', '2021-04-11 12:17:28', '2021-04-11 12:17:28'),
(759, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2021-05-19 08:25:43', '2021-05-19 08:25:43'),
(760, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-05-19 08:25:44', '2021-05-19 08:25:44'),
(761, 1, 'leave', 10, NULL, 'activity_added', '103.115.116.62', '2021-05-19 08:39:02', '2021-05-19 08:39:02'),
(762, 1, 'leave', 10, NULL, 'activity_status_updated', '103.115.116.62', '2021-05-19 08:39:53', '2021-05-19 08:39:53'),
(763, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-05-19 08:48:02', '2021-05-19 08:48:02'),
(764, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.115.116.62', '2021-05-19 08:48:02', '2021-05-19 08:48:02'),
(765, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2021-05-19 08:48:27', '2021-05-19 08:48:27'),
(766, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-05-19 08:48:28', '2021-05-19 08:48:28'),
(767, 1, 'job', 1, NULL, 'activity_updated', '103.115.116.62', '2021-05-19 08:49:11', '2021-05-19 08:49:11'),
(768, 1, 'job_application', 1, NULL, 'activity_added', '103.115.116.62', '2021-05-19 08:49:38', '2021-05-19 08:49:38'),
(769, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2021-05-30 10:44:23', '2021-05-30 10:44:23'),
(770, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-05-30 10:44:23', '2021-05-30 10:44:23'),
(771, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-05-30 10:49:39', '2021-05-30 10:49:39'),
(772, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.115.116.62', '2021-05-30 10:49:39', '2021-05-30 10:49:39'),
(773, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2021-05-30 10:55:08', '2021-05-30 10:55:08'),
(774, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-05-30 10:55:08', '2021-05-30 10:55:08'),
(775, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-05-30 10:55:28', '2021-05-30 10:55:28'),
(776, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.115.116.62', '2021-05-30 10:55:28', '2021-05-30 10:55:28'),
(777, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2021-05-30 10:55:37', '2021-05-30 10:55:37'),
(778, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-05-30 10:55:37', '2021-05-30 10:55:37'),
(779, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2021-05-31 09:27:52', '2021-05-31 09:27:52'),
(780, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-05-31 09:27:52', '2021-05-31 09:27:52'),
(781, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.115.116.62', '2021-06-02 09:24:53', '2021-06-02 09:24:53'),
(782, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-06-02 09:24:53', '2021-06-02 09:24:53'),
(783, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.92.205.5', '2021-06-04 14:33:43', '2021-06-04 14:33:43'),
(784, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-06-04 14:33:44', '2021-06-04 14:33:44'),
(785, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.120.38.17', '2021-06-17 08:42:26', '2021-06-17 08:42:26'),
(786, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-06-17 08:42:26', '2021-06-17 08:42:26'),
(787, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.120.38.17', '2021-06-23 09:52:16', '2021-06-23 09:52:16'),
(788, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-06-23 09:52:16', '2021-06-23 09:52:16'),
(789, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.120.38.17', '2021-06-23 10:21:03', '2021-06-23 10:21:03'),
(790, 1, 'custom_field', 5, NULL, 'activity_added', '103.120.38.17', '2021-06-23 10:26:04', '2021-06-23 10:26:04'),
(791, 1, 'office_shift', NULL, 3, 'activity_added', '103.120.38.17', '2021-06-23 10:34:00', '2021-06-23 10:34:00'),
(792, 1, 'office_shift', NULL, 3, 'activity_added', '103.120.38.17', '2021-06-23 10:34:11', '2021-06-23 10:34:11'),
(793, 1, 'leave', 11, NULL, 'activity_added', '103.120.38.17', '2021-06-23 10:40:50', '2021-06-23 10:40:50'),
(794, 1, 'leave', 11, NULL, 'activity_status_updated', '103.120.38.17', '2021-06-23 10:41:43', '2021-06-23 10:41:43'),
(795, 1, 'message', 2, NULL, 'activity_message_sent', '103.120.38.17', '2021-06-23 10:58:29', '2021-06-23 10:58:29'),
(796, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-06-23 10:59:14', '2021-06-23 10:59:14'),
(797, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.120.38.17', '2021-06-23 10:59:14', '2021-06-23 10:59:14'),
(798, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.120.38.17', '2021-06-23 10:59:57', '2021-06-23 10:59:57'),
(799, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-06-23 10:59:57', '2021-06-23 10:59:57'),
(800, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.120.38.16', '2021-06-23 12:02:38', '2021-06-23 12:02:38'),
(801, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.120.38.17', '2021-06-24 04:12:49', '2021-06-24 04:12:49'),
(802, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-06-24 04:12:49', '2021-06-24 04:12:49'),
(803, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.120.38.17', '2021-06-24 11:06:19', '2021-06-24 11:06:19'),
(804, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.120.38.17', '2021-06-26 05:57:50', '2021-06-26 05:57:50'),
(805, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-06-26 05:57:51', '2021-06-26 05:57:51'),
(806, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.149.61.174', '2021-06-29 06:16:55', '2021-06-29 06:16:55'),
(807, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-06-29 06:16:55', '2021-06-29 06:16:55'),
(808, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.149.61.174', '2021-06-29 10:45:22', '2021-06-29 10:45:22'),
(809, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.149.61.174', '2021-06-30 11:03:52', '2021-06-30 11:03:52'),
(810, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-06-30 11:03:53', '2021-06-30 11:03:53'),
(811, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.92.205.1', '2021-07-01 06:53:49', '2021-07-01 06:53:49'),
(812, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-07-01 06:53:49', '2021-07-01 06:53:49'),
(813, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.92.205.1', '2021-07-06 11:30:57', '2021-07-06 11:30:57'),
(814, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-07-06 11:30:58', '2021-07-06 11:30:58'),
(815, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.92.205.1', '2021-07-13 04:24:09', '2021-07-13 04:24:09'),
(816, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-07-13 04:24:09', '2021-07-13 04:24:09'),
(817, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-07-13 04:24:20', '2021-07-13 04:24:20'),
(818, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.92.205.1', '2021-07-13 04:24:20', '2021-07-13 04:24:20'),
(819, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.92.205.1', '2021-07-14 05:02:09', '2021-07-14 05:02:09'),
(820, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-07-14 05:02:09', '2021-07-14 05:02:09'),
(821, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.92.204.17', '2021-07-23 09:18:51', '2021-07-23 09:18:51'),
(822, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-07-23 09:18:52', '2021-07-23 09:18:52'),
(823, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.92.204.22', '2021-07-25 05:56:05', '2021-07-25 05:56:05'),
(824, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-07-25 05:56:06', '2021-07-25 05:56:06'),
(825, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-07-25 05:56:18', '2021-07-25 05:56:18'),
(826, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.92.204.22', '2021-07-25 05:56:18', '2021-07-25 05:56:18'),
(827, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.92.204.22', '2021-07-27 05:28:39', '2021-07-27 05:28:39'),
(828, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-07-27 05:28:39', '2021-07-27 05:28:39'),
(829, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.92.204.22', '2021-07-29 08:07:46', '2021-07-29 08:07:46'),
(830, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-07-29 08:07:46', '2021-07-29 08:07:46'),
(831, 1, 'authentication', NULL, NULL, 'activity_logged_in', '202.134.14.154', '2021-07-31 06:10:40', '2021-07-31 06:10:40'),
(832, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-07-31 06:10:42', '2021-07-31 06:10:42'),
(833, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.149.61.31', '2021-08-19 06:03:19', '2021-08-19 06:03:19'),
(834, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-08-19 06:03:19', '2021-08-19 06:03:19'),
(835, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-08-19 06:03:26', '2021-08-19 06:03:26'),
(836, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.149.61.31', '2021-08-19 06:03:26', '2021-08-19 06:03:26'),
(837, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.149.61.31', '2021-08-21 09:23:55', '2021-08-21 09:23:55'),
(838, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-08-21 09:23:56', '2021-08-21 09:23:56'),
(839, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-08-21 09:24:21', '2021-08-21 09:24:21'),
(840, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.149.61.31', '2021-08-21 09:24:21', '2021-08-21 09:24:21'),
(841, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.149.61.31', '2021-08-21 09:24:54', '2021-08-21 09:24:54'),
(842, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-08-21 09:24:54', '2021-08-21 09:24:54'),
(843, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.149.61.31', '2021-08-23 06:25:55', '2021-08-23 06:25:55'),
(844, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-08-23 06:25:56', '2021-08-23 06:25:56'),
(845, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.149.61.30', '2021-08-23 06:27:06', '2021-08-23 06:27:06');
INSERT INTO `activities` (`id`, `user_id`, `module`, `unique_id`, `secondary_id`, `activity`, `ip`, `created_at`, `updated_at`) VALUES
(846, 1, 'leave', 12, NULL, 'activity_added', '103.149.61.31', '2021-08-23 06:34:56', '2021-08-23 06:34:56'),
(847, 1, 'leave', 8, NULL, 'activity_status_updated', '103.149.61.31', '2021-08-23 06:36:02', '2021-08-23 06:36:02'),
(848, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-08-23 07:53:23', '2021-08-23 07:53:23'),
(849, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.149.61.31', '2021-08-23 07:53:23', '2021-08-23 07:53:23'),
(850, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.149.61.31', '2021-08-24 05:32:54', '2021-08-24 05:32:54'),
(851, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-08-24 05:32:54', '2021-08-24 05:32:54'),
(852, 1, 'employee', 17, NULL, 'activity_updated', '103.149.61.31', '2021-08-24 05:40:05', '2021-08-24 05:40:05'),
(853, 1, 'employee', 17, NULL, 'activity_profile_updated', '103.149.61.31', '2021-08-24 05:40:16', '2021-08-24 05:40:16'),
(854, 1, 'employee', 17, NULL, 'activity_profile_updated', '103.149.61.31', '2021-08-24 05:41:04', '2021-08-24 05:41:04'),
(855, 1, 'contact', 3, 17, 'activity_added', '103.149.61.31', '2021-08-24 05:42:32', '2021-08-24 05:42:32'),
(856, 1, 'contract', 8, 17, 'activity_added', '103.149.61.31', '2021-08-24 05:44:02', '2021-08-24 05:44:02'),
(857, 1, 'office_shift', NULL, 17, 'activity_added', '103.149.61.31', '2021-08-24 05:44:24', '2021-08-24 05:44:24'),
(858, 1, 'office_shift', NULL, 17, 'activity_updated', '103.149.61.31', '2021-08-24 05:44:32', '2021-08-24 05:44:32'),
(859, 1, 'employee', 17, NULL, 'activity_updated', '103.149.61.31', '2021-08-24 05:47:12', '2021-08-24 05:47:12'),
(860, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-08-24 05:47:27', '2021-08-24 05:47:27'),
(861, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.149.61.31', '2021-08-24 05:47:27', '2021-08-24 05:47:27'),
(862, 17, 'authentication', NULL, NULL, 'activity_logged_in', '103.149.61.31', '2021-08-24 05:47:41', '2021-08-24 05:47:41'),
(863, 17, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-08-24 05:47:41', '2021-08-24 05:47:41'),
(864, 17, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-08-24 05:48:18', '2021-08-24 05:48:18'),
(865, 17, 'authentication', NULL, NULL, 'activity_logged_out', '103.149.61.31', '2021-08-24 05:48:18', '2021-08-24 05:48:18'),
(866, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.149.61.31', '2021-08-24 05:48:23', '2021-08-24 05:48:23'),
(867, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-08-24 05:48:23', '2021-08-24 05:48:23'),
(868, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.162.187.131', '2021-09-08 07:12:27', '2021-09-08 07:12:27'),
(869, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-09-08 07:12:28', '2021-09-08 07:12:28'),
(870, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.146.55.97', '2021-09-09 15:08:14', '2021-09-09 15:08:14'),
(871, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-09-09 15:08:14', '2021-09-09 15:08:14'),
(872, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.146.55.97', '2021-09-09 15:09:05', '2021-09-09 15:09:05'),
(873, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.146.55.97', '2021-09-10 06:41:32', '2021-09-10 06:41:32'),
(874, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-09-10 06:41:32', '2021-09-10 06:41:32'),
(875, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-09-10 06:43:59', '2021-09-10 06:43:59'),
(876, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.146.55.97', '2021-09-10 06:43:59', '2021-09-10 06:43:59'),
(877, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.146.55.97', '2021-09-10 06:47:07', '2021-09-10 06:47:07'),
(878, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-09-10 06:47:07', '2021-09-10 06:47:07'),
(879, 1, 'authentication', NULL, NULL, 'activity_logged_in', '202.134.10.135', '2021-09-11 05:22:43', '2021-09-11 05:22:43'),
(880, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-09-11 05:22:43', '2021-09-11 05:22:43'),
(881, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.162.187.131', '2021-09-21 10:32:01', '2021-09-21 10:32:01'),
(882, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-09-21 10:32:01', '2021-09-21 10:32:01'),
(883, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.162.187.131', '2021-09-23 08:15:01', '2021-09-23 08:15:01'),
(884, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.34.242', '2021-09-23 08:15:01', '2021-09-23 08:15:01'),
(885, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.162.187.131', '2021-09-23 08:26:03', '2021-09-23 08:26:03'),
(886, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.162.187.131', '2021-09-23 08:26:07', '2021-09-23 08:26:07'),
(887, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.92.205.5', '2021-09-30 08:35:15', '2021-09-30 08:35:15'),
(888, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-09-30 08:35:15', '2021-09-30 08:35:15'),
(889, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-09-30 09:02:01', '2021-09-30 09:02:01'),
(890, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.92.205.5', '2021-09-30 09:02:01', '2021-09-30 09:02:01'),
(891, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.92.205.5', '2021-09-30 09:04:34', '2021-09-30 09:04:34'),
(892, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-09-30 09:04:34', '2021-09-30 09:04:34'),
(893, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-09-30 09:05:59', '2021-09-30 09:05:59'),
(894, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.92.205.5', '2021-09-30 09:05:59', '2021-09-30 09:05:59'),
(895, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.92.205.5', '2021-09-30 09:13:10', '2021-09-30 09:13:10'),
(896, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-09-30 09:13:10', '2021-09-30 09:13:10'),
(897, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.162.187.39', '2021-09-30 09:32:14', '2021-09-30 09:32:14'),
(898, 1, 'authentication', NULL, NULL, 'activity_logged_in', '123.136.24.226', '2021-10-17 07:10:10', '2021-10-17 07:10:10'),
(899, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-10-17 07:10:10', '2021-10-17 07:10:10'),
(900, 1, 'authentication', NULL, NULL, 'activity_logged_in', '123.136.24.226', '2021-10-19 07:57:29', '2021-10-19 07:57:29'),
(901, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-10-19 07:57:29', '2021-10-19 07:57:29'),
(902, 1, 'authentication', NULL, NULL, 'activity_logged_in', '123.136.24.226', '2021-11-02 08:53:52', '2021-11-02 08:53:52'),
(903, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-11-02 08:53:52', '2021-11-02 08:53:52'),
(904, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-11-02 08:54:02', '2021-11-02 08:54:02'),
(905, 1, 'authentication', NULL, NULL, 'activity_logged_out', '123.136.24.226', '2021-11-02 08:54:02', '2021-11-02 08:54:02'),
(906, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.162.187.38', '2021-11-08 08:00:13', '2021-11-08 08:00:13'),
(907, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-11-08 08:00:14', '2021-11-08 08:00:14'),
(908, 1, 'authentication', NULL, NULL, 'activity_logged_in', '123.136.24.226', '2021-11-17 10:25:02', '2021-11-17 10:25:02'),
(909, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-11-17 10:25:02', '2021-11-17 10:25:02'),
(910, 1, 'authentication', NULL, NULL, 'activity_logged_in', '202.134.10.131', '2021-11-25 09:18:02', '2021-11-25 09:18:02'),
(911, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-11-25 09:18:03', '2021-11-25 09:18:03'),
(912, 1, 'authentication', NULL, NULL, 'activity_logged_in', '123.136.24.226', '2021-12-04 05:46:46', '2021-12-04 05:46:46'),
(913, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-12-04 05:46:46', '2021-12-04 05:46:46'),
(914, 1, 'authentication', NULL, NULL, 'activity_logged_in', '123.136.24.226', '2021-12-04 05:47:22', '2021-12-04 05:47:22'),
(915, 1, 'clock', NULL, NULL, 'activity_clock_in', '123.136.24.226', '2021-12-04 05:48:13', '2021-12-04 05:48:13'),
(916, 1, 'clock', NULL, NULL, 'activity_clock_in', '123.136.24.226', '2021-12-04 05:48:16', '2021-12-04 05:48:16'),
(917, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-12-04 06:40:22', '2021-12-04 06:40:22'),
(918, 1, 'authentication', NULL, NULL, 'activity_logged_out', '123.136.24.226', '2021-12-04 06:40:22', '2021-12-04 06:40:22'),
(919, 1, 'authentication', NULL, NULL, 'activity_logged_in', '123.136.24.226', '2021-12-04 06:41:28', '2021-12-04 06:41:28'),
(920, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-12-04 06:41:29', '2021-12-04 06:41:29'),
(921, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-12-04 06:42:22', '2021-12-04 06:42:22'),
(922, 1, 'authentication', NULL, NULL, 'activity_logged_out', '123.136.24.226', '2021-12-04 06:42:22', '2021-12-04 06:42:22'),
(923, 1, 'authentication', NULL, NULL, 'activity_logged_in', '123.136.24.226', '2021-12-05 07:25:13', '2021-12-05 07:25:13'),
(924, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-12-05 07:25:13', '2021-12-05 07:25:13'),
(925, 1, 'authentication', NULL, NULL, 'activity_logged_in', '123.136.24.226', '2021-12-06 06:50:00', '2021-12-06 06:50:00'),
(926, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-12-06 06:50:00', '2021-12-06 06:50:00'),
(927, 1, 'authentication', NULL, NULL, 'activity_logged_in', '123.136.24.226', '2021-12-07 05:00:22', '2021-12-07 05:00:22'),
(928, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-12-07 05:00:22', '2021-12-07 05:00:22'),
(929, 1, 'authentication', NULL, NULL, 'activity_logged_in', '123.136.24.226', '2021-12-12 04:27:09', '2021-12-12 04:27:09'),
(930, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-12-12 04:27:10', '2021-12-12 04:27:10'),
(931, 1, 'authentication', NULL, NULL, 'activity_logged_in', '123.136.24.226', '2021-12-29 10:42:05', '2021-12-29 10:42:05'),
(932, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-12-29 10:42:06', '2021-12-29 10:42:06'),
(933, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2021-12-29 10:42:12', '2021-12-29 10:42:12'),
(934, 1, 'authentication', NULL, NULL, 'activity_logged_out', '123.136.24.226', '2021-12-29 10:42:12', '2021-12-29 10:42:12'),
(935, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.139.133.237', '2022-01-03 08:30:53', '2022-01-03 08:30:53'),
(936, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-01-03 08:30:53', '2022-01-03 08:30:53'),
(937, 1, 'authentication', NULL, NULL, 'activity_logged_in', '37.111.195.101', '2022-01-03 11:09:48', '2022-01-03 11:09:48'),
(938, 1, 'authentication', NULL, NULL, 'activity_logged_in', '203.202.254.228', '2022-01-03 11:16:16', '2022-01-03 11:16:16'),
(939, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.139.133.237', '2022-01-17 18:04:47', '2022-01-17 18:04:47'),
(940, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-01-17 18:04:47', '2022-01-17 18:04:47'),
(941, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2022-02-05 05:09:03', '2022-02-05 05:09:03'),
(942, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-05 05:09:03', '2022-02-05 05:09:03'),
(943, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2022-02-06 08:27:33', '2022-02-06 08:27:33'),
(944, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-06 08:27:34', '2022-02-06 08:27:34'),
(945, 1, 'leave', 13, NULL, 'activity_added', '27.147.177.102', '2022-02-06 10:31:49', '2022-02-06 10:31:49'),
(946, 1, 'leave', 13, NULL, 'activity_status_updated', '27.147.177.102', '2022-02-06 10:34:34', '2022-02-06 10:34:34'),
(947, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.139.133.237', '2022-02-11 06:17:07', '2022-02-11 06:17:07'),
(948, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-11 06:17:07', '2022-02-11 06:17:07'),
(949, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.139.133.237', '2022-02-13 05:58:22', '2022-02-13 05:58:22'),
(950, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-13 05:58:22', '2022-02-13 05:58:22'),
(951, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.139.133.237', '2022-02-13 09:00:57', '2022-02-13 09:00:57'),
(952, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2022-02-14 04:41:00', '2022-02-14 04:41:00'),
(953, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-14 04:41:00', '2022-02-14 04:41:00'),
(954, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-14 04:41:10', '2022-02-14 04:41:10'),
(955, 1, 'authentication', NULL, NULL, 'activity_logged_out', '27.147.177.102', '2022-02-14 04:41:10', '2022-02-14 04:41:10'),
(956, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.139.133.237', '2022-02-14 13:41:59', '2022-02-14 13:41:59'),
(957, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-14 13:41:59', '2022-02-14 13:41:59'),
(958, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.110.125.230', '2022-02-14 16:16:39', '2022-02-14 16:16:39'),
(959, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.110.125.230', '2022-02-15 06:55:52', '2022-02-15 06:55:52'),
(960, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-15 06:55:53', '2022-02-15 06:55:53'),
(961, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2022-02-16 09:55:32', '2022-02-16 09:55:32'),
(962, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-16 09:55:32', '2022-02-16 09:55:32'),
(963, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2022-02-16 10:08:55', '2022-02-16 10:08:55'),
(964, 1, 'clock', NULL, NULL, 'activity_clock_in', '27.147.177.102', '2022-02-16 10:09:16', '2022-02-16 10:09:16'),
(965, 1, 'clock', NULL, NULL, 'activity_clock_in', '27.147.177.102', '2022-02-16 10:09:19', '2022-02-16 10:09:19'),
(966, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2022-02-17 09:17:00', '2022-02-17 09:17:00'),
(967, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-17 09:17:00', '2022-02-17 09:17:00'),
(968, 1, 'clock', NULL, NULL, 'activity_clock_in', '27.147.177.102', '2022-02-17 09:18:36', '2022-02-17 09:18:36'),
(969, 1, 'clock', NULL, NULL, 'activity_clock_in', '27.147.177.102', '2022-02-17 09:18:43', '2022-02-17 09:18:43'),
(970, 1, 'clock', NULL, NULL, 'activity_clock_in', '27.147.177.102', '2022-02-17 09:18:55', '2022-02-17 09:18:55'),
(971, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2022-02-17 11:34:59', '2022-02-17 11:34:59'),
(972, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-17 11:34:59', '2022-02-17 11:34:59'),
(973, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.139.133.237', '2022-02-17 14:38:55', '2022-02-17 14:38:55'),
(974, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.87.212.25', '2022-02-18 14:49:40', '2022-02-18 14:49:40'),
(975, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-18 14:49:40', '2022-02-18 14:49:40'),
(976, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-18 14:52:47', '2022-02-18 14:52:47'),
(977, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.87.212.25', '2022-02-18 14:52:47', '2022-02-18 14:52:47'),
(978, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.147.163.172', '2022-02-18 17:31:57', '2022-02-18 17:31:57'),
(979, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-18 17:31:57', '2022-02-18 17:31:57'),
(980, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.147.163.172', '2022-02-18 17:32:26', '2022-02-18 17:32:26'),
(981, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2022-02-19 03:29:14', '2022-02-19 03:29:14'),
(982, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-02-19 03:29:14', '2022-02-19 03:29:14'),
(983, 1, 'leave', 1, NULL, 'activity_status_updated', '27.147.177.102', '2022-02-19 04:39:35', '2022-02-19 04:39:35'),
(984, 1, 'leave', 1, NULL, 'activity_updated', '27.147.177.102', '2022-02-19 04:47:34', '2022-02-19 04:47:34'),
(985, 1, 'message', 17, NULL, 'activity_message_sent', '27.147.177.102', '2022-02-19 06:38:02', '2022-02-19 06:38:02'),
(986, 1, 'clock', NULL, NULL, 'activity_clock_in', '27.147.177.102', '2022-02-19 06:40:15', '2022-02-19 06:40:15'),
(987, 1, 'clock', NULL, NULL, 'activity_clock_in', '27.147.177.102', '2022-02-19 06:40:23', '2022-02-19 06:40:23'),
(988, 1, 'clock', NULL, NULL, 'activity_clock_in', '27.147.177.102', '2022-02-19 06:40:30', '2022-02-19 06:40:30'),
(989, 1, 'clock', NULL, NULL, 'activity_clock_in', '27.147.177.102', '2022-02-19 06:40:35', '2022-02-19 06:40:35'),
(990, 1, 'clock', NULL, NULL, 'activity_clock_in', '27.147.177.102', '2022-02-19 06:40:39', '2022-02-19 06:40:39'),
(991, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2022-02-22 07:04:53', '2022-02-22 07:04:53'),
(992, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.162.186.120', '2022-03-07 08:13:57', '2022-03-07 08:13:57'),
(993, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-03-07 08:13:57', '2022-03-07 08:13:57'),
(994, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.162.186.120', '2022-03-07 08:14:50', '2022-03-07 08:14:50'),
(995, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.162.186.120', '2022-03-07 08:14:53', '2022-03-07 08:14:53'),
(996, 1, 'task', 4, NULL, 'activity_status_updated', '103.162.186.120', '2022-03-07 08:26:00', '2022-03-07 08:26:00'),
(997, 1, 'authentication', NULL, NULL, 'activity_employee_password_changed', '103.162.186.120', '2022-03-07 08:35:02', '2022-03-07 08:35:02'),
(998, 1, 'employee', 17, NULL, 'activity_updated', '103.162.186.120', '2022-03-07 08:35:28', '2022-03-07 08:35:28'),
(999, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-03-07 08:35:37', '2022-03-07 08:35:37'),
(1000, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.162.186.120', '2022-03-07 08:35:37', '2022-03-07 08:35:37'),
(1001, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.162.186.120', '2022-03-07 08:35:59', '2022-03-07 08:35:59'),
(1002, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-03-07 08:35:59', '2022-03-07 08:35:59'),
(1003, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-03-07 08:36:19', '2022-03-07 08:36:19'),
(1004, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.162.186.120', '2022-03-07 08:36:19', '2022-03-07 08:36:19'),
(1005, 17, 'authentication', NULL, NULL, 'activity_logged_in', '103.162.186.120', '2022-03-07 08:36:27', '2022-03-07 08:36:27'),
(1006, 17, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-03-07 08:36:27', '2022-03-07 08:36:27'),
(1007, 17, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-03-07 08:37:29', '2022-03-07 08:37:29'),
(1008, 17, 'authentication', NULL, NULL, 'activity_logged_out', '103.162.186.120', '2022-03-07 08:37:29', '2022-03-07 08:37:29'),
(1009, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.162.186.120', '2022-03-07 08:37:35', '2022-03-07 08:37:35'),
(1010, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-03-07 08:37:35', '2022-03-07 08:37:35'),
(1011, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2022-03-10 08:33:15', '2022-03-10 08:33:15'),
(1012, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-03-10 08:33:16', '2022-03-10 08:33:16'),
(1013, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2022-03-10 11:12:16', '2022-03-10 11:12:16'),
(1014, 17, 'authentication', NULL, NULL, 'activity_logged_in', '45.248.148.87', '2022-03-13 09:15:32', '2022-03-13 09:15:32'),
(1015, 17, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-03-13 09:15:32', '2022-03-13 09:15:32'),
(1016, 17, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-03-13 09:19:53', '2022-03-13 09:19:53'),
(1017, 17, 'authentication', NULL, NULL, 'activity_logged_out', '45.248.148.87', '2022-03-13 09:19:53', '2022-03-13 09:19:53'),
(1018, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2022-03-30 04:21:39', '2022-03-30 04:21:39'),
(1019, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-03-30 04:21:39', '2022-03-30 04:21:39'),
(1020, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2022-06-27 07:38:20', '2022-06-27 07:38:20'),
(1021, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-06-27 07:38:21', '2022-06-27 07:38:21'),
(1022, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-06-27 07:44:39', '2022-06-27 07:44:39'),
(1023, 1, 'authentication', NULL, NULL, 'activity_logged_out', '27.147.177.102', '2022-06-27 07:44:39', '2022-06-27 07:44:39'),
(1024, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2022-06-27 07:44:57', '2022-06-27 07:44:57'),
(1025, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-06-27 07:44:57', '2022-06-27 07:44:57'),
(1026, 1, 'employee', 18, NULL, 'activity_added', '27.147.177.102', '2022-06-27 07:49:12', '2022-06-27 07:49:12'),
(1027, 1, 'employee', 18, NULL, 'activity_deleted', '27.147.177.102', '2022-06-27 07:51:22', '2022-06-27 07:51:22'),
(1028, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-06-27 07:51:29', '2022-06-27 07:51:29'),
(1029, 1, 'authentication', NULL, NULL, 'activity_logged_out', '27.147.177.102', '2022-06-27 07:51:29', '2022-06-27 07:51:29'),
(1030, 1, 'authentication', NULL, NULL, 'activity_logged_in', '119.30.32.101', '2022-09-25 10:11:31', '2022-09-25 10:11:31'),
(1031, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-09-25 10:11:31', '2022-09-25 10:11:31'),
(1032, 1, 'authentication', NULL, NULL, 'activity_logged_in', '223.27.81.107', '2022-09-25 10:11:54', '2022-09-25 10:11:54'),
(1033, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.162.186.120', '2022-09-26 04:09:50', '2022-09-26 04:09:50'),
(1034, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-09-26 04:09:51', '2022-09-26 04:09:51'),
(1035, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.162.186.120', '2022-09-26 04:12:36', '2022-09-26 04:12:36'),
(1036, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.54.36.78', '2022-10-13 11:05:36', '2022-10-13 11:05:36'),
(1037, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-10-13 11:05:36', '2022-10-13 11:05:36'),
(1038, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.86.193.26', '2022-11-13 03:09:03', '2022-11-13 03:09:03'),
(1039, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-11-13 03:09:03', '2022-11-13 03:09:03'),
(1040, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.86.193.26', '2022-11-14 09:33:15', '2022-11-14 09:33:15'),
(1041, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-11-14 09:33:15', '2022-11-14 09:33:15'),
(1042, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.86.193.26', '2022-11-22 05:02:46', '2022-11-22 05:02:46'),
(1043, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2022-11-22 05:02:46', '2022-11-22 05:02:46'),
(1044, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.86.193.26', '2022-11-22 05:09:09', '2022-11-22 05:09:09'),
(1045, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.86.193.26', '2022-11-22 05:09:13', '2022-11-22 05:09:13'),
(1046, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.86.193.26', '2022-11-22 05:09:17', '2022-11-22 05:09:17'),
(1047, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.86.193.26', '2022-11-22 05:09:19', '2022-11-22 05:09:19'),
(1048, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.86.193.26', '2022-11-22 05:09:22', '2022-11-22 05:09:22'),
(1049, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.86.193.26', '2022-11-22 05:09:24', '2022-11-22 05:09:24'),
(1050, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.86.193.26', '2022-11-22 05:09:26', '2022-11-22 05:09:26'),
(1051, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.86.193.26', '2022-11-22 05:09:29', '2022-11-22 05:09:29'),
(1052, 1, 'task', 1, NULL, 'activity_status_updated', '103.86.193.26', '2022-11-22 05:10:57', '2022-11-22 05:10:57'),
(1053, 1, 'leave', 1, NULL, 'activity_status_updated', '103.86.193.26', '2022-11-22 05:11:47', '2022-11-22 05:11:47'),
(1054, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.162.186.120', '2023-01-30 05:35:52', '2023-01-30 05:35:52'),
(1055, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-01-30 05:35:53', '2023-01-30 05:35:53'),
(1056, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.162.186.120', '2023-02-08 08:33:31', '2023-02-08 08:33:31'),
(1057, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-02-08 08:33:31', '2023-02-08 08:33:31'),
(1058, 1, 'authentication', NULL, NULL, 'activity_logged_in', '119.30.32.36', '2023-02-08 09:44:45', '2023-02-08 09:44:45'),
(1059, 1, 'clock', NULL, NULL, 'activity_clock_in', '119.30.32.36', '2023-02-08 09:45:40', '2023-02-08 09:45:40'),
(1060, 1, 'authentication', NULL, NULL, 'activity_logged_in', '119.30.32.36', '2023-02-08 09:59:36', '2023-02-08 09:59:36'),
(1061, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-02-08 09:59:36', '2023-02-08 09:59:36'),
(1062, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-02-08 10:09:02', '2023-02-08 10:09:02'),
(1063, 1, 'authentication', NULL, NULL, 'activity_logged_out', '119.30.32.36', '2023-02-08 10:09:02', '2023-02-08 10:09:02'),
(1064, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.139.133.237', '2023-03-16 04:00:36', '2023-03-16 04:00:36'),
(1065, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-03-16 04:00:36', '2023-03-16 04:00:36'),
(1066, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.220.205.111', '2023-03-16 04:01:23', '2023-03-16 04:01:23'),
(1067, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2023-05-11 10:12:27', '2023-05-11 10:12:27'),
(1068, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-05-11 10:12:27', '2023-05-11 10:12:27'),
(1069, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-05-11 10:12:40', '2023-05-11 10:12:40'),
(1070, 1, 'authentication', NULL, NULL, 'activity_logged_out', '27.147.177.102', '2023-05-11 10:12:40', '2023-05-11 10:12:40'),
(1071, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2023-05-13 09:39:39', '2023-05-13 09:39:39'),
(1072, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-05-13 09:39:39', '2023-05-13 09:39:39'),
(1073, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2023-05-14 01:41:29', '2023-05-14 01:41:29'),
(1074, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-05-14 01:41:29', '2023-05-14 01:41:29'),
(1075, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-05-14 01:42:20', '2023-05-14 01:42:20'),
(1076, 1, 'authentication', NULL, NULL, 'activity_logged_out', '27.147.177.102', '2023-05-14 01:42:20', '2023-05-14 01:42:20'),
(1077, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.67.157.255', '2023-05-14 05:30:28', '2023-05-14 05:30:28'),
(1078, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-05-14 05:30:29', '2023-05-14 05:30:29'),
(1079, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.177.102', '2023-05-17 09:02:25', '2023-05-17 09:02:25'),
(1080, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-05-17 09:02:26', '2023-05-17 09:02:26'),
(1081, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-05-17 11:04:56', '2023-05-17 11:04:56'),
(1082, 1, 'authentication', NULL, NULL, 'activity_logged_out', '27.147.177.102', '2023-05-17 11:04:56', '2023-05-17 11:04:56'),
(1083, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.162.186.120', '2023-05-18 07:20:41', '2023-05-18 07:20:41'),
(1084, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-05-18 07:20:41', '2023-05-18 07:20:41'),
(1085, 1, 'task', 4, NULL, 'activity_status_updated', '103.162.186.120', '2023-05-18 07:23:44', '2023-05-18 07:23:44'),
(1086, 1, 'authentication', NULL, NULL, 'activity_logged_in', '118.179.162.89', '2023-06-03 08:40:42', '2023-06-03 08:40:42'),
(1087, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-06-03 08:40:42', '2023-06-03 08:40:42'),
(1088, 1, 'authentication', NULL, NULL, 'activity_logged_in', '118.179.182.39', '2023-06-03 08:49:13', '2023-06-03 08:49:13'),
(1089, 1, 'payroll', 1, NULL, 'activity_updated', '118.179.182.39', '2023-06-03 09:02:59', '2023-06-03 09:02:59'),
(1090, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.54.148.190', '2023-06-06 07:52:28', '2023-06-06 07:52:28'),
(1091, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-06-06 07:52:29', '2023-06-06 07:52:29'),
(1092, 1, 'authentication', NULL, NULL, 'activity_logged_in', '118.179.162.89', '2023-06-08 07:11:37', '2023-06-08 07:11:37'),
(1093, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-06-08 07:11:38', '2023-06-08 07:11:38'),
(1094, 1, 'authentication', NULL, NULL, 'activity_logged_in', '118.179.182.39', '2023-06-08 07:18:52', '2023-06-08 07:18:52'),
(1095, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.143.139.174', '2023-06-10 02:30:46', '2023-06-10 02:30:46'),
(1096, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-06-10 02:30:46', '2023-06-10 02:30:46'),
(1097, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.143.139.174', '2023-06-10 02:31:58', '2023-06-10 02:31:58'),
(1098, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.143.139.174', '2023-06-10 02:32:03', '2023-06-10 02:32:03'),
(1099, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.143.139.174', '2023-06-10 02:32:07', '2023-06-10 02:32:07'),
(1100, 1, 'authentication', NULL, NULL, 'activity_logged_in', '118.179.182.39', '2023-06-12 10:51:34', '2023-06-12 10:51:34'),
(1101, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-06-12 10:51:34', '2023-06-12 10:51:34'),
(1102, 1, 'authentication', NULL, NULL, 'activity_logged_in', '202.134.14.138', '2023-06-12 11:13:01', '2023-06-12 11:13:01'),
(1103, 1, 'authentication', NULL, NULL, 'activity_logged_in', '37.111.206.120', '2023-06-12 11:16:26', '2023-06-12 11:16:26'),
(1104, 1, 'clock', NULL, NULL, 'activity_clock_in', '37.111.206.120', '2023-06-12 11:17:33', '2023-06-12 11:17:33'),
(1105, 1, 'task', 4, NULL, 'activity_user_assigned', '37.111.206.120', '2023-06-12 11:23:49', '2023-06-12 11:23:49'),
(1106, 1, 'template', NULL, NULL, 'activity_added', '37.111.206.120', '2023-06-12 11:46:03', '2023-06-12 11:46:03'),
(1107, 1, 'authentication', NULL, NULL, 'activity_logged_in', '118.179.182.39', '2023-06-13 06:51:29', '2023-06-13 06:51:29'),
(1108, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-06-13 06:51:30', '2023-06-13 06:51:30'),
(1109, 1, 'configuration', NULL, NULL, 'activity_configuration_updated', '118.179.182.39', '2023-06-13 06:53:09', '2023-06-13 06:53:09'),
(1110, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.67.159.156', '2023-07-23 16:36:23', '2023-07-23 16:36:23'),
(1111, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-07-23 16:36:24', '2023-07-23 16:36:24'),
(1112, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.184.94.2', '2023-07-24 14:10:50', '2023-07-24 14:10:50'),
(1113, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-07-24 14:10:50', '2023-07-24 14:10:50'),
(1114, 1, 'authentication', NULL, NULL, 'activity_logged_in', '37.111.206.202', '2023-07-28 12:22:20', '2023-07-28 12:22:20'),
(1115, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-07-28 12:22:21', '2023-07-28 12:22:21'),
(1116, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.83.232.74', '2023-07-28 14:40:21', '2023-07-28 14:40:21'),
(1117, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-07-28 14:41:15', '2023-07-28 14:41:15'),
(1118, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.83.232.74', '2023-07-28 14:41:15', '2023-07-28 14:41:15'),
(1119, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.160.99.116', '2023-08-01 11:54:05', '2023-08-01 11:54:05'),
(1120, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-08-01 11:54:05', '2023-08-01 11:54:05'),
(1121, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.113.196.21', '2023-08-07 11:31:29', '2023-08-07 11:31:29'),
(1122, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-08-07 11:31:29', '2023-08-07 11:31:29'),
(1123, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-08-07 11:35:50', '2023-08-07 11:35:50'),
(1124, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.113.196.21', '2023-08-07 11:35:50', '2023-08-07 11:35:50'),
(1125, 1, 'authentication', NULL, NULL, 'activity_logged_in', '202.134.10.130', '2023-08-07 15:25:01', '2023-08-07 15:25:01'),
(1126, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-08-07 15:25:01', '2023-08-07 15:25:01'),
(1127, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.146.151.25', '2023-08-09 03:45:46', '2023-08-09 03:45:46'),
(1128, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-08-09 03:45:46', '2023-08-09 03:45:46'),
(1129, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.146.151.25', '2023-08-09 08:12:35', '2023-08-09 08:12:35'),
(1130, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.139.133.237', '2023-08-12 06:07:24', '2023-08-12 06:07:24'),
(1131, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-08-12 06:07:24', '2023-08-12 06:07:24'),
(1132, 1, 'message', 3, NULL, 'activity_message_sent', '103.139.133.237', '2023-08-12 06:52:29', '2023-08-12 06:52:29'),
(1133, 1, 'job', 3, NULL, 'activity_added', '103.139.133.237', '2023-08-12 07:18:18', '2023-08-12 07:18:18'),
(1134, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-08-12 07:18:38', '2023-08-12 07:18:38'),
(1135, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.139.133.237', '2023-08-12 07:18:38', '2023-08-12 07:18:38'),
(1136, NULL, 'job_application', 2, NULL, 'activity_added', '103.139.133.237', '2023-08-12 07:21:26', '2023-08-12 07:21:26'),
(1137, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.139.133.237', '2023-08-12 07:22:15', '2023-08-12 07:22:15'),
(1138, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-08-12 07:22:15', '2023-08-12 07:22:15'),
(1139, 1, 'document_type', 7, NULL, 'activity_deleted', '103.139.133.237', '2023-08-12 07:27:00', '2023-08-12 07:27:00'),
(1140, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.184.94.6', '2023-08-14 17:40:18', '2023-08-14 17:40:18'),
(1141, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-08-14 17:40:18', '2023-08-14 17:40:18'),
(1142, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.184.94.1', '2023-08-15 13:19:54', '2023-08-15 13:19:54'),
(1143, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-08-15 13:19:54', '2023-08-15 13:19:54'),
(1144, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.201.242', '2023-09-02 05:44:49', '2023-09-02 05:44:49'),
(1145, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-09-02 05:44:49', '2023-09-02 05:44:49'),
(1146, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.110.114.115', '2023-09-12 10:11:22', '2023-09-12 10:11:22'),
(1147, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-09-12 10:11:22', '2023-09-12 10:11:22'),
(1148, 1, 'authentication', NULL, NULL, 'activity_logged_in', '202.86.220.2', '2023-09-19 16:30:48', '2023-09-19 16:30:48'),
(1149, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-09-19 16:30:48', '2023-09-19 16:30:48'),
(1150, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.220.205.111', '2023-10-16 12:05:30', '2023-10-16 12:05:30'),
(1151, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-10-16 12:05:30', '2023-10-16 12:05:30'),
(1152, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.220.205.111', '2023-10-16 16:53:40', '2023-10-16 16:53:40'),
(1153, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.76.44.68', '2023-11-12 04:23:39', '2023-11-12 04:23:39'),
(1154, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-11-12 04:23:39', '2023-11-12 04:23:39'),
(1155, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.116.183.206', '2023-12-31 14:07:24', '2023-12-31 14:07:24'),
(1156, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2023-12-31 14:07:24', '2023-12-31 14:07:24'),
(1157, 1, 'authentication', NULL, NULL, 'activity_logged_in', '110.76.129.225', '2024-01-31 06:45:11', '2024-01-31 06:45:11'),
(1158, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-01-31 06:45:11', '2024-01-31 06:45:11'),
(1159, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.163.101.211', '2024-01-31 06:55:42', '2024-01-31 06:55:42'),
(1160, 1, 'employee', 19, NULL, 'activity_added', '110.76.129.225', '2024-01-31 07:12:14', '2024-01-31 07:12:14'),
(1161, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.163.101.211', '2024-02-11 06:32:51', '2024-02-11 06:32:51'),
(1162, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-02-11 06:32:51', '2024-02-11 06:32:51'),
(1163, 1, 'clock', NULL, NULL, 'activity_clock_in', '182.163.101.211', '2024-02-11 07:00:03', '2024-02-11 07:00:03'),
(1164, 1, 'clock', NULL, NULL, 'activity_clock_in', '182.163.101.211', '2024-02-11 07:00:08', '2024-02-11 07:00:08'),
(1165, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.163.101.211', '2024-02-11 11:05:00', '2024-02-11 11:05:00'),
(1166, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.163.101.211', '2024-02-12 04:13:00', '2024-02-12 04:13:00'),
(1167, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-02-12 04:13:00', '2024-02-12 04:13:00'),
(1168, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.163.101.211', '2024-02-12 04:30:23', '2024-02-12 04:30:23'),
(1169, 1, 'authentication', NULL, NULL, 'activity_logged_in', '37.111.214.65', '2024-02-12 10:54:54', '2024-02-12 10:54:54'),
(1170, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.163.101.211', '2024-02-20 08:42:50', '2024-02-20 08:42:50'),
(1171, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-02-20 08:42:50', '2024-02-20 08:42:50'),
(1172, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.163.101.211', '2024-02-25 07:31:15', '2024-02-25 07:31:15'),
(1173, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-02-25 07:31:15', '2024-02-25 07:31:15'),
(1174, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.163.101.211', '2024-02-26 03:57:27', '2024-02-26 03:57:27'),
(1175, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-02-26 03:57:28', '2024-02-26 03:57:28'),
(1176, 1, 'holiday', NULL, NULL, 'activity_added', '182.163.101.211', '2024-02-26 04:36:56', '2024-02-26 04:36:56'),
(1177, 1, 'authentication', NULL, NULL, 'activity_logged_in', '182.163.101.211', '2024-02-27 10:28:21', '2024-02-27 10:28:21'),
(1178, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-02-27 10:28:21', '2024-02-27 10:28:21'),
(1179, 1, 'authentication', NULL, NULL, 'activity_logged_in', '108.86.213.115', '2024-05-06 02:41:53', '2024-05-06 02:41:53'),
(1180, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-05-06 02:41:53', '2024-05-06 02:41:53'),
(1181, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.84.36.177', '2024-07-29 08:58:33', '2024-07-29 08:58:33'),
(1182, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-07-29 08:58:33', '2024-07-29 08:58:33'),
(1183, 1, 'clock', NULL, NULL, 'activity_clock_in', '103.84.36.177', '2024-07-29 09:02:09', '2024-07-29 09:02:09'),
(1184, 1, 'task', 4, NULL, 'activity_user_assigned', '103.84.36.177', '2024-07-29 09:23:52', '2024-07-29 09:23:52'),
(1185, 1, 'task', 4, NULL, 'activity_status_updated', '103.84.36.177', '2024-07-29 09:24:03', '2024-07-29 09:24:03'),
(1186, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.84.37.231', '2024-08-14 10:55:38', '2024-08-14 10:55:38'),
(1187, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-08-14 10:55:38', '2024-08-14 10:55:38'),
(1188, 1, 'authentication', NULL, NULL, 'activity_employee_password_changed', '103.84.37.231', '2024-08-14 10:56:30', '2024-08-14 10:56:30'),
(1189, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-08-14 10:56:43', '2024-08-14 10:56:43'),
(1190, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.84.37.231', '2024-08-14 10:56:43', '2024-08-14 10:56:43'),
(1191, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.84.37.231', '2024-08-14 10:57:05', '2024-08-14 10:57:05'),
(1192, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-08-14 10:57:05', '2024-08-14 10:57:05'),
(1193, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-08-14 10:57:33', '2024-08-14 10:57:33'),
(1194, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.84.37.231', '2024-08-14 10:57:33', '2024-08-14 10:57:33'),
(1195, 6, 'authentication', NULL, NULL, 'activity_logged_in', '103.84.37.231', '2024-08-14 10:57:41', '2024-08-14 10:57:41'),
(1196, 6, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-08-14 10:57:41', '2024-08-14 10:57:41'),
(1197, 6, 'clock', NULL, NULL, 'activity_clock_in', '103.84.37.231', '2024-08-14 10:57:56', '2024-08-14 10:57:56'),
(1198, 6, 'clock', NULL, NULL, 'activity_clock_in', '103.84.37.231', '2024-08-14 10:57:58', '2024-08-14 10:57:58'),
(1199, 6, 'clock', NULL, NULL, 'activity_clock_in', '103.84.37.231', '2024-08-14 10:57:59', '2024-08-14 10:57:59'),
(1200, 6, 'clock', NULL, NULL, 'activity_clock_in', '103.84.37.231', '2024-08-14 10:58:01', '2024-08-14 10:58:01'),
(1201, 6, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-08-14 11:34:31', '2024-08-14 11:34:31'),
(1202, 6, 'authentication', NULL, NULL, 'activity_logged_out', '103.84.37.231', '2024-08-14 11:34:31', '2024-08-14 11:34:31'),
(1203, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.84.37.231', '2024-08-14 11:34:41', '2024-08-14 11:34:41'),
(1204, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-08-14 11:34:41', '2024-08-14 11:34:41'),
(1205, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.25.250.129', '2024-08-16 22:16:42', '2024-08-16 22:16:42'),
(1206, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-08-16 22:16:43', '2024-08-16 22:16:43'),
(1207, 1, 'authentication', NULL, NULL, 'activity_logged_in', '202.86.219.81', '2024-08-19 04:37:15', '2024-08-19 04:37:15'),
(1208, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-08-19 04:37:15', '2024-08-19 04:37:15'),
(1209, 1, 'clock', NULL, NULL, 'activity_clock_in', '202.86.219.81', '2024-08-19 05:11:31', '2024-08-19 05:11:31'),
(1210, 1, 'clock', NULL, NULL, 'activity_clock_in', '202.86.219.81', '2024-08-19 05:11:37', '2024-08-19 05:11:37'),
(1211, 1, 'clock', NULL, NULL, 'activity_clock_in', '202.86.219.81', '2024-08-19 05:11:41', '2024-08-19 05:11:41'),
(1212, 1, 'authentication', NULL, NULL, 'activity_logged_in', '43.245.120.101', '2024-09-02 07:26:24', '2024-09-02 07:26:24'),
(1213, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-02 07:26:24', '2024-09-02 07:26:24'),
(1214, 1, 'clock', NULL, NULL, 'activity_clock_in', '43.245.120.101', '2024-09-02 07:26:52', '2024-09-02 07:26:52'),
(1215, 1, 'clock', NULL, NULL, 'activity_clock_in', '43.245.120.101', '2024-09-02 07:27:06', '2024-09-02 07:27:06'),
(1216, 1, 'clock', NULL, NULL, 'activity_clock_in', '43.245.120.101', '2024-09-02 07:27:14', '2024-09-02 07:27:14'),
(1217, 1, 'authentication', NULL, NULL, 'activity_logged_in', '118.179.36.216', '2024-09-03 05:09:02', '2024-09-03 05:09:02'),
(1218, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-03 05:09:02', '2024-09-03 05:09:02'),
(1219, 1, 'task', 4, NULL, 'activity_updated', '118.179.36.216', '2024-09-03 05:11:32', '2024-09-03 05:11:32'),
(1220, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.137.1.8', '2024-09-07 13:56:29', '2024-09-07 13:56:29'),
(1221, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-07 13:56:30', '2024-09-07 13:56:30'),
(1222, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.137.1.8', '2024-09-07 20:08:12', '2024-09-07 20:08:12'),
(1223, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-07 20:08:12', '2024-09-07 20:08:12'),
(1224, 1, 'employee', 20, NULL, 'activity_added', '103.137.1.8', '2024-09-07 20:10:53', '2024-09-07 20:10:53'),
(1225, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-07 20:12:53', '2024-09-07 20:12:53'),
(1226, 1, 'authentication', NULL, NULL, 'activity_logged_out', '103.137.1.8', '2024-09-07 20:12:53', '2024-09-07 20:12:53'),
(1227, 20, 'authentication', NULL, NULL, 'activity_logged_in', '103.137.1.8', '2024-09-07 20:13:01', '2024-09-07 20:13:01'),
(1228, 20, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-07 20:13:01', '2024-09-07 20:13:01'),
(1229, 20, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-07 20:13:49', '2024-09-07 20:13:49'),
(1230, 20, 'authentication', NULL, NULL, 'activity_logged_out', '103.137.1.8', '2024-09-07 20:13:49', '2024-09-07 20:13:49'),
(1231, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.137.1.8', '2024-09-07 20:13:54', '2024-09-07 20:13:54'),
(1232, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-07 20:13:54', '2024-09-07 20:13:54'),
(1233, 1, 'bank_account', 3, 20, 'activity_added', '103.137.1.8', '2024-09-07 20:16:01', '2024-09-07 20:16:01'),
(1234, 1, 'office_shift', NULL, 20, 'activity_added', '103.137.1.8', '2024-09-07 20:16:50', '2024-09-07 20:16:50'),
(1235, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.84.254.224', '2024-09-08 06:29:34', '2024-09-08 06:29:34'),
(1236, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.84.254.224', '2024-09-09 08:20:28', '2024-09-09 08:20:28'),
(1237, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-09 08:20:28', '2024-09-09 08:20:28'),
(1238, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.84.254.224', '2024-09-10 08:51:30', '2024-09-10 08:51:30'),
(1239, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-10 08:51:30', '2024-09-10 08:51:30'),
(1240, 1, 'authentication', NULL, NULL, 'activity_logged_in', '37.111.213.117', '2024-09-11 11:22:30', '2024-09-11 11:22:30'),
(1241, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-11 11:22:30', '2024-09-11 11:22:30'),
(1242, 1, 'task', 4, NULL, 'activity_status_updated', '37.111.213.117', '2024-09-11 11:51:46', '2024-09-11 11:51:46'),
(1243, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-11 12:01:30', '2024-09-11 12:01:30'),
(1244, 1, 'authentication', NULL, NULL, 'activity_logged_out', '37.111.213.117', '2024-09-11 12:01:30', '2024-09-11 12:01:30'),
(1245, 1, 'authentication', NULL, NULL, 'activity_logged_in', '37.111.213.117', '2024-09-11 12:01:57', '2024-09-11 12:01:57'),
(1246, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-11 12:01:57', '2024-09-11 12:01:57'),
(1247, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.140.123', '2024-09-23 04:38:10', '2024-09-23 04:38:10'),
(1248, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-23 04:38:10', '2024-09-23 04:38:10'),
(1249, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.84.254.224', '2024-09-23 08:51:58', '2024-09-23 08:51:58'),
(1250, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.140.123', '2024-09-24 04:13:16', '2024-09-24 04:13:16'),
(1251, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-09-24 04:13:16', '2024-09-24 04:13:16'),
(1252, 1, 'authentication', NULL, NULL, 'activity_logged_in', '115.127.117.65', '2024-10-01 09:52:52', '2024-10-01 09:52:52'),
(1253, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-10-01 09:52:52', '2024-10-01 09:52:52'),
(1254, 1, 'authentication', NULL, NULL, 'activity_logged_in', '37.111.213.236', '2024-10-02 10:04:04', '2024-10-02 10:04:04'),
(1255, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-10-02 10:04:04', '2024-10-02 10:04:04'),
(1256, 1, 'custom_field', 6, NULL, 'activity_added', '37.111.213.236', '2024-10-02 10:07:04', '2024-10-02 10:07:04'),
(1257, 1, 'custom_field', 7, NULL, 'activity_added', '37.111.213.236', '2024-10-02 10:31:57', '2024-10-02 10:31:57'),
(1258, 1, 'contract', 6, 3, 'activity_updated', '37.111.213.236', '2024-10-02 10:38:39', '2024-10-02 10:38:39'),
(1259, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.84.37.231', '2024-10-29 12:48:53', '2024-10-29 12:48:53'),
(1260, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-10-29 12:48:53', '2024-10-29 12:48:53'),
(1261, 1, 'payroll', 2, NULL, 'activity_updated', '103.84.37.231', '2024-10-29 12:51:20', '2024-10-29 12:51:20'),
(1262, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.84.37.231', '2024-11-03 09:05:30', '2024-11-03 09:05:30'),
(1263, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-11-03 09:05:30', '2024-11-03 09:05:30'),
(1264, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.84.37.231', '2024-11-03 09:20:43', '2024-11-03 09:20:43'),
(1265, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.217.111.118', '2024-11-04 04:05:35', '2024-11-04 04:05:35');
INSERT INTO `activities` (`id`, `user_id`, `module`, `unique_id`, `secondary_id`, `activity`, `ip`, `created_at`, `updated_at`) VALUES
(1266, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-11-04 04:05:36', '2024-11-04 04:05:36'),
(1267, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.140.123', '2024-11-04 04:11:12', '2024-11-04 04:11:12'),
(1268, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.140.123', '2024-11-04 09:05:59', '2024-11-04 09:05:59'),
(1269, 1, 'authentication', NULL, NULL, 'activity_logged_in', '103.84.37.231', '2024-11-04 11:44:16', '2024-11-04 11:44:16'),
(1270, 1, 'authentication', NULL, NULL, 'activity_logged_in', '27.147.140.123', '2024-11-05 03:51:45', '2024-11-05 03:51:45'),
(1271, 1, 'clock', NULL, NULL, 'activity_clock_in', '173.236.63.6', '2024-11-05 03:51:45', '2024-11-05 03:51:45'),
(1272, 1, 'designation', 1, NULL, 'activity_updated', '127.0.0.1', '2024-11-09 12:14:13', '2024-11-09 12:14:13'),
(1273, 1, 'custom_field', 1, NULL, 'activity_deleted', '127.0.0.1', '2024-11-09 12:18:13', '2024-11-09 12:18:13'),
(1274, 1, 'custom_field', 2, NULL, 'activity_deleted', '127.0.0.1', '2024-11-09 12:18:16', '2024-11-09 12:18:16'),
(1275, 1, 'custom_field', 3, NULL, 'activity_deleted', '127.0.0.1', '2024-11-09 12:18:18', '2024-11-09 12:18:18'),
(1276, 1, 'custom_field', 4, NULL, 'activity_deleted', '127.0.0.1', '2024-11-09 12:18:21', '2024-11-09 12:18:21'),
(1277, 1, 'custom_field', 5, NULL, 'activity_deleted', '127.0.0.1', '2024-11-09 12:18:22', '2024-11-09 12:18:22'),
(1278, 1, 'custom_field', 6, NULL, 'activity_deleted', '127.0.0.1', '2024-11-09 12:18:24', '2024-11-09 12:18:24'),
(1279, 1, 'custom_field', 7, NULL, 'activity_deleted', '127.0.0.1', '2024-11-09 12:18:26', '2024-11-09 12:18:26'),
(1280, 1, 'designation', 2, NULL, 'activity_added', '127.0.0.1', '2024-11-09 12:27:52', '2024-11-09 12:27:52'),
(1281, 1, 'designation', 3, NULL, 'activity_added', '127.0.0.1', '2024-11-09 12:48:09', '2024-11-09 12:48:09'),
(1282, 1, 'designation', 4, NULL, 'activity_added', '127.0.0.1', '2024-11-09 12:49:29', '2024-11-09 12:49:29'),
(1283, 1, 'designation', 5, NULL, 'activity_added', '127.0.0.1', '2024-11-09 12:51:21', '2024-11-09 12:51:21'),
(1284, 1, 'authentication', NULL, NULL, 'activity_logged_in', '127.0.0.1', '2024-11-10 04:07:07', '2024-11-10 04:07:07'),
(1285, 1, 'clock', NULL, NULL, 'activity_clock_in', '127.0.0.1', '2024-11-10 04:07:07', '2024-11-10 04:07:07'),
(1286, 1, 'employee', 19, NULL, 'activity_profile_updated', '127.0.0.1', '2024-11-10 04:09:24', '2024-11-10 04:09:24'),
(1287, 1, 'designation', 6, NULL, 'activity_added', '127.0.0.1', '2024-11-10 04:21:14', '2024-11-10 04:21:14'),
(1288, 1, 'designation', 7, NULL, 'activity_added', '127.0.0.1', '2024-11-10 04:21:23', '2024-11-10 04:21:23'),
(1289, 1, 'designation', 8, NULL, 'activity_added', '127.0.0.1', '2024-11-10 04:35:47', '2024-11-10 04:35:47'),
(1290, 1, 'designation', 9, NULL, 'activity_added', '127.0.0.1', '2024-11-10 04:41:05', '2024-11-10 04:41:05'),
(1291, 1, 'designation', 10, NULL, 'activity_added', '127.0.0.1', '2024-11-10 04:42:03', '2024-11-10 04:42:03'),
(1292, 1, 'designation', 11, NULL, 'activity_added', '127.0.0.1', '2024-11-10 04:42:14', '2024-11-10 04:42:14'),
(1293, 1, 'designation', 12, NULL, 'activity_added', '127.0.0.1', '2024-11-10 05:00:44', '2024-11-10 05:00:44'),
(1294, 1, 'designation', 3, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 05:11:26', '2024-11-10 05:11:26'),
(1295, 1, 'designation', 3, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 05:11:46', '2024-11-10 05:11:46'),
(1296, 1, 'designation', 13, NULL, 'activity_added', '127.0.0.1', '2024-11-10 05:11:51', '2024-11-10 05:11:51'),
(1297, 1, 'designation', 13, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 05:11:58', '2024-11-10 05:11:58'),
(1298, 1, 'designation', 14, NULL, 'activity_added', '127.0.0.1', '2024-11-10 05:13:52', '2024-11-10 05:13:52'),
(1299, 1, 'designation', 14, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 05:13:59', '2024-11-10 05:13:59'),
(1300, 1, 'designation', 3, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 05:19:48', '2024-11-10 05:19:48'),
(1301, 1, 'designation', 3, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 05:47:20', '2024-11-10 05:47:20'),
(1302, 1, 'employee', 1, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 06:57:42', '2024-11-10 06:57:42'),
(1303, 1, 'employee', 1, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 06:58:06', '2024-11-10 06:58:06'),
(1304, 1, 'employee', 1, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 06:58:56', '2024-11-10 06:58:56'),
(1305, 1, 'employee', 1, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 07:01:10', '2024-11-10 07:01:10'),
(1306, 1, 'employee', 1, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 07:01:17', '2024-11-10 07:01:17'),
(1307, 1, 'clock', NULL, NULL, 'activity_clock_in', '127.0.0.1', '2024-11-10 07:35:13', '2024-11-10 07:35:13'),
(1308, 1, 'clock', NULL, NULL, 'activity_clock_in', '127.0.0.1', '2024-11-10 11:20:38', '2024-11-10 11:20:38'),
(1309, 1, 'employee', 19, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 11:29:12', '2024-11-10 11:29:12'),
(1310, 1, 'employee', 19, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 11:30:03', '2024-11-10 11:30:03'),
(1311, 1, 'office_shift', 2, NULL, 'activity_made_default', '127.0.0.1', '2024-11-10 11:59:43', '2024-11-10 11:59:43'),
(1312, 1, 'office_shift', 1, NULL, 'activity_made_default', '127.0.0.1', '2024-11-10 11:59:51', '2024-11-10 11:59:51'),
(1313, 1, 'designation', 15, NULL, 'activity_added', '127.0.0.1', '2024-11-10 12:25:38', '2024-11-10 12:25:38'),
(1314, 1, 'designation', 16, NULL, 'activity_added', '127.0.0.1', '2024-11-10 12:27:00', '2024-11-10 12:27:00'),
(1315, 1, 'designation', 3, NULL, 'activity_added', '127.0.0.1', '2024-11-10 12:30:17', '2024-11-10 12:30:17'),
(1316, 1, 'designation', 4, NULL, 'activity_added', '127.0.0.1', '2024-11-10 12:33:19', '2024-11-10 12:33:19'),
(1317, 1, 'designation', 5, NULL, 'activity_added', '127.0.0.1', '2024-11-10 12:33:27', '2024-11-10 12:33:27'),
(1318, 1, 'designation', 6, NULL, 'activity_added', '127.0.0.1', '2024-11-10 12:33:43', '2024-11-10 12:33:43'),
(1319, 1, 'designation', 7, NULL, 'activity_added', '127.0.0.1', '2024-11-10 12:34:19', '2024-11-10 12:34:19'),
(1320, 1, 'designation', 8, NULL, 'activity_added', '127.0.0.1', '2024-11-10 12:34:25', '2024-11-10 12:34:25'),
(1321, 1, 'designation', 9, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 12:49:01', '2024-11-10 12:49:01'),
(1322, 1, 'designation', 10, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 12:57:36', '2024-11-10 12:57:36'),
(1323, 1, 'designation', 11, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 12:57:50', '2024-11-10 12:57:50'),
(1324, 1, 'designation', 1, NULL, 'activity_updated', '127.0.0.1', '2024-11-10 13:04:38', '2024-11-10 13:04:38'),
(1325, 1, 'authentication', NULL, NULL, 'activity_logged_in', '127.0.0.1', '2024-11-11 04:07:29', '2024-11-11 04:07:29'),
(1326, 1, 'clock', NULL, NULL, 'activity_clock_in', '127.0.0.1', '2024-11-11 04:07:31', '2024-11-11 04:07:31'),
(1327, 1, 'designation', 6, NULL, 'activity_updated', '127.0.0.1', '2024-11-11 04:09:21', '2024-11-11 04:09:21'),
(1328, 1, 'designation', 9, NULL, 'activity_added', '127.0.0.1', '2024-11-11 04:09:35', '2024-11-11 04:09:35'),
(1329, 1, 'document', 2, 19, 'activity_added', '127.0.0.1', '2024-11-11 08:28:56', '2024-11-11 08:28:56'),
(1330, 1, 'contract', 9, 19, 'activity_added', '127.0.0.1', '2024-11-11 08:59:08', '2024-11-11 08:59:08'),
(1331, 1, 'employee', 19, NULL, 'activity_updated', '127.0.0.1', '2024-11-11 09:00:02', '2024-11-11 09:00:02'),
(1332, 1, 'contact', 4, 19, 'activity_added', '127.0.0.1', '2024-11-11 09:00:27', '2024-11-11 09:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `allowed_ips`
--

CREATE TABLE IF NOT EXISTS `allowed_ips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `end` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE IF NOT EXISTS `announcements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `attachments` text COLLATE utf8_unicode_ci,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `description`, `from_date`, `to_date`, `attachments`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Official Party This Friday Evening', '<p>Come timely and enjoy the events<br /></p>', '2016-10-28', '2016-10-28', NULL, 1, '2016-10-23 21:23:05', '2019-06-24 07:07:38'),
(2, 'LNK8I7BU6JHYGTRFWS', '<p>Tomorrow is NIBIZSOFT BIRTDAY</p>', '2019-06-25', '2019-06-25', NULL, 1, '2019-06-24 07:08:49', '2019-06-24 07:08:49');

-- --------------------------------------------------------

--
-- Table structure for table `announcement_designation`
--

CREATE TABLE IF NOT EXISTS `announcement_designation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `announcement_id` (`announcement_id`),
  KEY `designation_id` (`designation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `announcement_designation`
--

INSERT INTO `announcement_designation` (`id`, `announcement_id`, `designation_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 2, 2),
(4, 2, 3),
(5, 2, 4),
(6, 2, 5),
(7, 2, 6),
(8, 2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `appraisal`
--

CREATE TABLE IF NOT EXISTS `appraisal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL DEFAULT '',
  `user_id` varchar(11) NOT NULL DEFAULT '',
  `supervisor_id` varchar(50) NOT NULL DEFAULT '',
  `supervisor_user_id` varchar(50) NOT NULL DEFAULT '',
  `time_period` varchar(20) NOT NULL DEFAULT '',
  `objective` text NOT NULL,
  `expected_result` text NOT NULL,
  `edit_by_id` varchar(11) NOT NULL DEFAULT '',
  `edit_date` varchar(20) NOT NULL DEFAULT '',
  `edit_time` varchar(20) NOT NULL DEFAULT '',
  `user_approve` int(1) NOT NULL DEFAULT '0',
  `supervisor_approve` int(1) NOT NULL DEFAULT '0',
  `sup_approve_1` int(1) NOT NULL DEFAULT '0',
  `sup_approve_2` int(1) NOT NULL DEFAULT '0',
  `hr_approve` int(1) NOT NULL DEFAULT '0',
  `hr_approve_user_id` varchar(50) NOT NULL DEFAULT '',
  `user_approve_date` varchar(20) NOT NULL DEFAULT '',
  `user_approve_time` varchar(20) NOT NULL DEFAULT '',
  `supervisor_approve_date` varchar(20) NOT NULL DEFAULT '',
  `supervisor_approve_time` varchar(20) NOT NULL DEFAULT '',
  `hr_approve_date` varchar(20) NOT NULL DEFAULT '',
  `hr_approve_time` varchar(20) NOT NULL DEFAULT '',
  `hr_review_comment` text NOT NULL,
  `user_answer_1` text NOT NULL,
  `user_answer_2` text NOT NULL,
  `user_answer_3` text NOT NULL,
  `user_answer_4` text NOT NULL,
  `user_answer_5` text NOT NULL,
  `user_answer_6` text NOT NULL,
  `user_answer_7` text NOT NULL,
  `user_answer_8` text NOT NULL,
  `user_answer_9` text NOT NULL,
  `user_answer_10` text NOT NULL,
  `user_answer_11` text NOT NULL,
  `user_answer_12` text NOT NULL,
  `user_answer_13` text NOT NULL,
  `user_answer_14` text NOT NULL,
  `user_answer_15` text NOT NULL,
  `user_answer_16` text NOT NULL,
  `user_answer_17` text NOT NULL,
  `user_answer_18` text NOT NULL,
  `user_answer_19` text NOT NULL,
  `user_answer_20` text NOT NULL,
  `locked` int(1) NOT NULL DEFAULT '0',
  `date` varchar(20) NOT NULL DEFAULT '',
  `time` varchar(20) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `appraisal`
--

INSERT INTO `appraisal` (`id`, `uid`, `user_id`, `supervisor_id`, `supervisor_user_id`, `time_period`, `objective`, `expected_result`, `edit_by_id`, `edit_date`, `edit_time`, `user_approve`, `supervisor_approve`, `sup_approve_1`, `sup_approve_2`, `hr_approve`, `hr_approve_user_id`, `user_approve_date`, `user_approve_time`, `supervisor_approve_date`, `supervisor_approve_time`, `hr_approve_date`, `hr_approve_time`, `hr_review_comment`, `user_answer_1`, `user_answer_2`, `user_answer_3`, `user_answer_4`, `user_answer_5`, `user_answer_6`, `user_answer_7`, `user_answer_8`, `user_answer_9`, `user_answer_10`, `user_answer_11`, `user_answer_12`, `user_answer_13`, `user_answer_14`, `user_answer_15`, `user_answer_16`, `user_answer_17`, `user_answer_18`, `user_answer_19`, `user_answer_20`, `locked`, `date`, `time`, `status`) VALUES
(4, '5fccb1a6558f2', '1', '1', '1', '2020', '', '', '', '', '', 1, 1, 1, 1, 0, '', '', '', '', '', '', '', '', '1', '1', '1', '1', '1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2020-12-06', '04:25:42 pm', 0);

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_comment`
--

CREATE TABLE IF NOT EXISTS `appraisal_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL DEFAULT '',
  `appraisal_id` varchar(50) NOT NULL DEFAULT '',
  `appraisal_uid` varchar(50) NOT NULL DEFAULT '',
  `supervisor_id` varchar(50) NOT NULL DEFAULT '',
  `supervisor_user_id` varchar(50) NOT NULL DEFAULT '',
  `question_id` varchar(2) NOT NULL DEFAULT '',
  `question_sn` varchar(5) NOT NULL DEFAULT '',
  `title` text NOT NULL,
  `question` text NOT NULL,
  `comment` text NOT NULL,
  `rating` int(1) NOT NULL DEFAULT '0',
  `rating_by_id` varchar(50) NOT NULL DEFAULT '',
  `rating_date` varchar(20) NOT NULL DEFAULT '',
  `rating_time` varchar(20) NOT NULL DEFAULT '',
  `edit_by_id` varchar(50) NOT NULL DEFAULT '',
  `edit_by_date` varchar(20) NOT NULL DEFAULT '',
  `edit_time` varchar(20) NOT NULL DEFAULT '',
  `date` varchar(20) NOT NULL DEFAULT '',
  `time` varchar(20) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_task`
--

CREATE TABLE IF NOT EXISTS `appraisal_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL DEFAULT '',
  `appraisal_uid` varchar(50) NOT NULL DEFAULT '',
  `objective` text NOT NULL,
  `expected_result` text NOT NULL,
  `user_comment` text NOT NULL,
  `task_name` text NOT NULL,
  `start_date` varchar(20) NOT NULL DEFAULT '',
  `end_date` varchar(20) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `priority` int(1) NOT NULL DEFAULT '0',
  `rating` int(1) NOT NULL DEFAULT '0',
  `rating_by_id` varchar(50) NOT NULL DEFAULT '',
  `rating_date` varchar(20) NOT NULL DEFAULT '',
  `rating_time` varchar(20) NOT NULL DEFAULT '',
  `add_by_id` varchar(50) NOT NULL DEFAULT '',
  `edit_by_id` varchar(50) NOT NULL DEFAULT '',
  `edit_date` varchar(20) NOT NULL DEFAULT '',
  `edit_time` varchar(20) NOT NULL DEFAULT '',
  `date` varchar(20) NOT NULL DEFAULT '',
  `time` varchar(20) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `appraisal_task`
--

INSERT INTO `appraisal_task` (`id`, `uid`, `appraisal_uid`, `objective`, `expected_result`, `user_comment`, `task_name`, `start_date`, `end_date`, `comment`, `priority`, `rating`, `rating_by_id`, `rating_date`, `rating_time`, `add_by_id`, `edit_by_id`, `edit_date`, `edit_time`, `date`, `time`, `status`) VALUES
(11, '5fccb1a655eaa', '5fccb1a6558f2', 'To understaand the activities', '', '', '1. Carry the workshop\r\n2. Conduct training', '', '2020-12-31', '', 0, 1, '', '', '', '', '', '', '', '2020-12-06', '04:25:42 pm', 0),
(12, '5fccb1a656163', '5fccb1a6558f2', 'To provide support', '', '', '1. Carry the workshop\r\n2. Conduct training', '', '2020-12-31', '', 0, 1, '', '', '', '', '', '', '', '2020-12-06', '04:25:42 pm', 0);

-- --------------------------------------------------------

--
-- Table structure for table `awards`
--

CREATE TABLE IF NOT EXISTS `awards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `award_type_id` int(11) DEFAULT NULL,
  `gift` text COLLATE utf8_unicode_ci,
  `cash` decimal(25,5) DEFAULT NULL,
  `month` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `date_of_award` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `award_type_id` (`award_type_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `awards`
--

INSERT INTO `awards` (`id`, `user_id`, `award_type_id`, `gift`, `cash`, `month`, `year`, `description`, `date_of_award`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Trophy', '10000.00000', 'june', 2019, '<p>ofgdszfghkjljhgfdsfghjkjhgytfdrsrfgh</p>', '2019-06-25', '2019-06-24 07:05:12', '2019-06-24 07:05:12');

-- --------------------------------------------------------

--
-- Table structure for table `award_types`
--

CREATE TABLE IF NOT EXISTS `award_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `award_types`
--

INSERT INTO `award_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Employee of the Month', '2016-10-23 21:02:04', '2016-10-23 21:02:04'),
(2, 'Employee of the Year', '2016-10-23 21:02:14', '2016-10-23 21:02:14'),
(3, 'Best Performance Award', '2016-10-23 21:02:35', '2016-10-23 21:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `award_user`
--

CREATE TABLE IF NOT EXISTS `award_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `award_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `award_id` (`award_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `award_user`
--

INSERT INTO `award_user` (`id`, `user_id`, `award_id`) VALUES
(1, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `backups`
--

CREATE TABLE IF NOT EXISTS `backups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `backups`
--

INSERT INTO `backups` (`id`, `file`, `created_at`, `updated_at`) VALUES
(1, 'backup_2019_09_19_13_25_34.sql.gz', '2019-09-19 07:25:34', '2019-09-19 07:25:34'),
(2, 'backup_2020_01_04_02_26_09.sql.gz', '2020-01-03 20:26:09', '2020-01-03 20:26:09');

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE IF NOT EXISTS `bank_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `is_primary` tinyint(4) NOT NULL DEFAULT '0',
  `bank_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_branch` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `user_id`, `is_primary`, `bank_name`, `account_name`, `account_number`, `bank_code`, `bank_branch`, `created_at`, `updated_at`) VALUES
(1, 3, 0, 'Brac Bank', 'James', '3243256656565', 'BDBH', 'Uttara', '2020-02-24 09:49:05', '2020-02-24 09:51:24'),
(2, 3, 1, 'City Bank', 'James chowdhury', '43324343', 'CITY', 'Uttara', '2020-02-24 09:50:46', '2020-02-24 09:51:24'),
(3, 20, 0, 'City Bank', 'MD RASEL', '333456576879222', 'A13313', 'Dilkhusa', '2024-09-07 20:16:01', '2024-09-07 20:16:01');

-- --------------------------------------------------------

--
-- Table structure for table `branchs`
--

CREATE TABLE IF NOT EXISTS `branchs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `branchs`
--

INSERT INTO `branchs` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(3, 'vvvccckjljkkhj', 'ddddgggssssszddd', '2024-11-09 12:48:09', '2024-11-10 05:47:20'),
(4, 'test supplyer', 'dd', '2024-11-09 12:49:29', '2024-11-10 05:08:57'),
(5, 'test supplyer', 'dddd', '2024-11-09 12:51:21', '2024-11-09 12:51:21'),
(6, 'test supplyer', 'dd', '2024-11-10 04:21:14', '2024-11-10 04:21:14'),
(7, '66666666666', 'Bank Asia', '2024-11-10 04:21:23', '2024-11-10 04:21:23'),
(12, 'test supplyer', 'dd', '2024-11-10 05:00:43', '2024-11-10 05:00:43'),
(14, 'test supplyer', 'ddddddd', '2024-11-10 05:13:52', '2024-11-10 05:13:59'),
(15, '', '', '2024-11-10 12:25:38', '2024-11-10 12:25:38'),
(16, 'test supplyer', 'dd', '2024-11-10 12:27:00', '2024-11-10 12:27:00');

-- --------------------------------------------------------

--
-- Table structure for table `clocks`
--

CREATE TABLE IF NOT EXISTS `clocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `clock_in` timestamp NULL DEFAULT NULL,
  `clock_out` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=371 ;

--
-- Dumping data for table `clocks`
--

INSERT INTO `clocks` (`id`, `user_id`, `date`, `clock_in`, `clock_out`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-10-24', '2016-10-23 21:18:44', '2016-10-23 21:24:36', '2016-10-23 21:18:44', '2016-10-23 21:24:39'),
(2, 1, '2016-10-24', '2016-10-24 08:09:36', '2016-10-24 08:09:47', '2016-10-24 08:09:37', '2016-10-24 08:09:47'),
(3, 1, '2016-10-24', '2016-10-24 08:10:05', '2016-10-24 08:10:42', '2016-10-24 08:10:05', '2016-10-24 08:10:42'),
(4, 1, '2016-10-25', '2016-10-24 21:18:25', '2016-10-24 21:18:55', '2016-10-24 21:18:27', '2016-10-24 21:18:55'),
(5, 2, '2016-10-25', '2016-10-24 21:21:05', '2016-10-24 21:21:21', '2016-10-24 21:21:07', '2016-10-24 21:21:21'),
(6, 2, '2016-10-25', '2016-10-24 21:21:24', '2016-10-24 21:21:30', '2016-10-24 21:21:24', '2016-10-24 21:21:30'),
(7, 1, '2016-10-25', '2016-10-25 05:03:40', '2016-10-25 05:51:16', '2016-10-25 05:03:42', '2016-10-25 05:51:16'),
(8, 1, '2016-10-25', '2016-10-25 05:51:23', '2016-10-25 05:54:47', '2016-10-25 05:51:23', '2016-10-25 05:54:49'),
(9, 3, '2016-10-25', '2016-10-25 05:59:23', '2016-10-25 06:00:53', '2016-10-25 05:59:24', '2016-10-25 06:00:54'),
(10, 1, '2016-10-25', '2016-10-25 06:01:04', '2016-10-25 11:54:21', '2016-10-25 06:01:04', '2016-10-25 11:54:23'),
(11, 3, '2016-10-25', '2016-10-25 06:27:34', '2016-10-25 06:28:00', '2016-10-25 06:27:34', '2016-10-25 06:28:00'),
(12, 3, '2016-10-25', '2016-10-25 11:16:27', '2016-10-25 11:34:11', '2016-10-25 11:16:29', '2016-10-25 11:34:11'),
(13, 3, '2016-10-25', '2016-10-25 11:39:02', NULL, '2016-10-25 11:39:02', '2016-10-25 11:39:02'),
(14, 1, '2016-11-03', '2016-11-03 07:47:15', NULL, '2016-11-03 07:47:17', '2016-11-03 07:47:17'),
(15, 3, '2016-11-03', '2016-11-03 07:48:34', '2016-11-03 07:49:12', '2016-11-03 07:48:34', '2016-11-03 07:49:12'),
(16, 1, '2016-11-04', '2016-11-03 18:08:48', '2016-11-03 18:08:57', '2016-11-03 18:08:48', '2016-11-03 18:08:57'),
(17, 1, '2016-11-04', '2016-11-04 04:44:06', '2016-11-04 04:53:30', '2016-11-04 04:44:08', '2016-11-04 04:53:30'),
(18, 1, '2016-11-04', '2016-11-04 05:23:12', '2016-11-04 05:23:24', '2016-11-04 05:23:12', '2016-11-04 05:23:24'),
(19, 1, '2016-11-04', '2016-11-04 05:23:52', '2016-11-04 12:56:02', '2016-11-04 05:23:52', '2016-11-04 12:56:02'),
(20, 1, '2016-11-05', '2016-11-05 04:55:12', '2016-11-05 05:12:18', '2016-11-05 04:55:13', '2016-11-05 05:12:18'),
(21, 1, '2016-11-12', '2016-11-12 07:09:50', NULL, '2016-11-12 07:09:51', '2016-11-12 07:09:51'),
(22, 1, '2016-11-17', '2016-11-17 06:27:28', NULL, '2016-11-17 06:27:32', '2016-11-17 06:27:32'),
(23, 1, '2016-11-29', '2016-11-29 06:25:03', NULL, '2016-11-29 06:25:05', '2016-11-29 06:25:05'),
(24, 1, '2016-12-01', '2016-12-01 10:08:42', NULL, '2016-12-01 10:08:44', '2016-12-01 10:08:44'),
(25, 1, '2016-12-05', '2016-12-05 06:39:07', NULL, '2016-12-05 06:39:09', '2016-12-05 06:39:09'),
(26, 1, '2017-01-03', '2017-01-03 10:23:39', NULL, '2017-01-03 10:23:40', '2017-01-03 10:23:40'),
(27, 1, '2017-01-10', '2017-01-10 09:11:09', '2017-01-10 10:05:42', '2017-01-10 09:11:11', '2017-01-10 10:05:44'),
(28, 1, '2017-05-04', '2017-05-04 15:48:59', NULL, '2017-05-04 15:49:04', '2017-05-04 15:49:04'),
(29, 1, '2017-05-05', '2017-05-04 18:57:59', '2017-05-04 19:15:18', '2017-05-04 18:58:01', '2017-05-04 19:15:19'),
(30, 1, '2017-05-21', '2017-05-21 04:21:25', NULL, '2017-05-21 04:21:27', '2017-05-21 04:21:27'),
(31, 1, '2017-05-22', '2017-05-22 11:00:25', NULL, '2017-05-22 11:00:28', '2017-05-22 11:00:28'),
(32, 1, '2017-05-23', '2017-05-23 08:03:47', NULL, '2017-05-23 08:03:49', '2017-05-23 08:03:49'),
(33, 1, '2017-06-14', '2017-06-14 10:39:13', NULL, '2017-06-14 10:39:13', '2017-06-14 10:39:13'),
(34, 1, '2017-10-25', '2017-10-25 09:09:20', '2017-10-25 09:20:54', '2017-10-25 09:09:20', '2017-10-25 09:20:54'),
(35, 2, '2017-10-25', '2017-10-25 09:21:20', '2017-10-25 09:22:06', '2017-10-25 09:21:21', '2017-10-25 09:22:07'),
(36, 1, '2017-10-25', '2017-10-25 09:22:12', '2017-10-25 10:12:19', '2017-10-25 09:22:12', '2017-10-25 10:12:19'),
(37, 1, '2017-10-25', '2017-10-25 10:12:23', '2017-10-25 10:12:30', '2017-10-25 10:12:23', '2017-10-25 10:12:30'),
(38, 1, '2017-10-25', '2017-10-25 10:12:33', '2017-10-25 10:12:36', '2017-10-25 10:12:33', '2017-10-25 10:12:36'),
(39, 1, '2017-10-25', '2017-10-25 10:12:39', '2017-10-25 11:03:55', '2017-10-25 10:12:39', '2017-10-25 11:03:55'),
(40, 3, '2017-10-25', '2017-10-25 10:16:44', '2017-10-25 11:06:26', '2017-10-25 10:16:45', '2017-10-25 11:06:26'),
(41, 3, '2017-10-25', '2017-10-25 11:58:42', NULL, '2017-10-25 11:58:43', '2017-10-25 11:58:43'),
(42, 1, '2017-10-26', '2017-10-26 06:42:56', NULL, '2017-10-26 06:42:56', '2017-10-26 06:42:56'),
(43, 1, '2017-10-29', '2017-10-29 06:30:22', NULL, '2017-10-29 06:30:23', '2017-10-29 06:30:23'),
(44, 1, '2017-10-30', '2017-10-30 05:54:41', NULL, '2017-10-30 05:54:41', '2017-10-30 05:54:41'),
(45, 1, '2017-11-21', '2017-11-21 10:53:32', NULL, '2017-11-21 10:53:33', '2017-11-21 10:53:33'),
(46, 1, '2017-11-22', '2017-11-22 04:18:28', NULL, '2017-11-22 04:18:28', '2017-11-22 04:18:28'),
(47, 1, '2017-12-02', '2017-12-02 09:32:55', NULL, '2017-12-02 09:32:55', '2017-12-02 09:32:55'),
(48, 1, '2017-12-03', '2017-12-03 11:00:58', NULL, '2017-12-03 11:00:59', '2017-12-03 11:00:59'),
(49, 1, '2017-12-09', '2017-12-09 10:21:03', NULL, '2017-12-09 10:21:03', '2017-12-09 10:21:03'),
(50, 1, '2017-12-14', '2017-12-14 06:56:10', NULL, '2017-12-14 06:56:11', '2017-12-14 06:56:11'),
(51, 1, '2018-01-03', '2018-01-03 07:47:01', NULL, '2018-01-03 07:47:02', '2018-01-03 07:47:02'),
(52, 1, '2018-01-04', '2018-01-03 19:26:30', NULL, '2018-01-03 19:26:31', '2018-01-03 19:26:31'),
(53, 1, '2018-01-07', '2018-01-07 09:10:11', NULL, '2018-01-07 09:10:12', '2018-01-07 09:10:12'),
(54, 1, '2018-01-08', '2018-01-08 10:14:52', NULL, '2018-01-08 10:14:53', '2018-01-08 10:14:53'),
(55, 1, '2018-01-10', '2018-01-10 06:50:49', NULL, '2018-01-10 06:50:50', '2018-01-10 06:50:50'),
(56, 1, '2018-01-17', '2018-01-17 05:03:14', NULL, '2018-01-17 05:03:14', '2018-01-17 05:03:14'),
(57, 1, '2018-01-22', '2018-01-22 05:00:51', NULL, '2018-01-22 05:00:52', '2018-01-22 05:00:52'),
(58, 1, '2018-01-23', '2018-01-23 09:58:37', NULL, '2018-01-23 09:58:38', '2018-01-23 09:58:38'),
(59, 1, '2018-01-25', '2018-01-25 06:52:58', NULL, '2018-01-25 06:52:59', '2018-01-25 06:52:59'),
(60, 1, '2018-02-03', '2018-02-03 07:27:36', NULL, '2018-02-03 07:27:37', '2018-02-03 07:27:37'),
(61, 1, '2018-02-04', '2018-02-04 06:22:37', '2018-02-04 09:59:34', '2018-02-04 06:22:38', '2018-02-04 09:59:34'),
(62, 1, '2018-02-04', '2018-02-04 09:59:40', '2018-02-04 10:19:59', '2018-02-04 09:59:40', '2018-02-04 10:19:59'),
(63, 1, '2018-02-04', '2018-02-04 10:20:04', NULL, '2018-02-04 10:20:04', '2018-02-04 10:20:04'),
(64, 1, '2018-02-06', '2018-02-06 09:12:27', NULL, '2018-02-06 09:12:27', '2018-02-06 09:12:27'),
(65, 1, '2018-02-13', '2018-02-13 06:35:54', '2018-02-13 11:47:07', '2018-02-13 06:35:55', '2018-02-13 11:47:07'),
(66, 1, '2018-02-14', '2018-02-14 04:38:51', NULL, '2018-02-14 04:38:52', '2018-02-14 04:38:52'),
(67, 1, '2018-02-15', '2018-02-15 07:33:28', NULL, '2018-02-15 07:33:29', '2018-02-15 07:33:29'),
(68, 1, '2018-02-17', '2018-02-17 06:20:45', NULL, '2018-02-17 06:20:46', '2018-02-17 06:20:46'),
(69, 1, '2018-02-18', '2018-02-18 05:11:28', NULL, '2018-02-18 05:11:29', '2018-02-18 05:11:29'),
(70, 1, '2018-02-23', '2018-02-22 20:01:42', NULL, '2018-02-22 20:01:43', '2018-02-22 20:01:43'),
(71, 1, '2018-02-24', '2018-02-24 05:36:23', NULL, '2018-02-24 05:36:23', '2018-02-24 05:36:23'),
(72, 1, '2018-02-27', '2018-02-27 11:44:32', NULL, '2018-02-27 11:44:32', '2018-02-27 11:44:32'),
(73, 1, '2018-02-28', '2018-02-28 04:40:18', '2018-02-28 06:32:17', '2018-02-28 04:40:19', '2018-02-28 06:32:17'),
(74, 1, '2018-02-28', '2018-02-28 06:32:29', NULL, '2018-02-28 06:32:30', '2018-02-28 06:32:30'),
(75, 1, '2018-03-02', '2018-03-01 19:52:31', NULL, '2018-03-01 19:52:32', '2018-03-01 19:52:32'),
(76, 1, '2018-03-03', '2018-03-03 04:16:28', NULL, '2018-03-03 04:16:29', '2018-03-03 04:16:29'),
(77, 1, '2018-03-04', '2018-03-04 06:04:56', NULL, '2018-03-04 06:04:57', '2018-03-04 06:04:57'),
(78, 1, '2018-03-06', '2018-03-05 18:54:21', '2018-03-05 18:58:37', '2018-03-05 18:54:22', '2018-03-05 18:58:38'),
(79, 1, '2018-03-06', '2018-03-06 11:56:35', NULL, '2018-03-06 11:56:35', '2018-03-06 11:56:35'),
(80, 1, '2018-03-07', '2018-03-07 04:52:29', NULL, '2018-03-07 04:52:29', '2018-03-07 04:52:29'),
(81, 1, '2018-03-08', '2018-03-08 07:48:21', NULL, '2018-03-08 07:48:22', '2018-03-08 07:48:22'),
(82, 1, '2018-03-11', '2018-03-10 18:46:27', NULL, '2018-03-10 18:46:28', '2018-03-10 18:46:28'),
(83, 1, '2018-03-12', '2018-03-12 17:27:54', NULL, '2018-03-12 17:27:54', '2018-03-12 17:27:54'),
(84, 1, '2018-03-13', '2018-03-12 18:49:10', NULL, '2018-03-12 18:49:11', '2018-03-12 18:49:11'),
(85, 1, '2018-03-14', '2018-03-14 04:26:19', NULL, '2018-03-14 04:26:19', '2018-03-14 04:26:19'),
(86, 1, '2018-03-15', '2018-03-15 10:27:21', NULL, '2018-03-15 10:27:22', '2018-03-15 10:27:22'),
(87, 1, '2018-03-24', '2018-03-24 06:02:15', NULL, '2018-03-24 06:02:16', '2018-03-24 06:02:16'),
(88, 1, '2018-03-27', '2018-03-27 08:23:25', '2018-03-27 08:55:10', '2018-03-27 08:23:26', '2018-03-27 08:55:10'),
(89, 1, '2018-03-27', '2018-03-27 08:55:23', NULL, '2018-03-27 08:55:23', '2018-03-27 08:55:23'),
(90, 1, '2018-03-29', '2018-03-29 06:28:29', NULL, '2018-03-29 06:28:30', '2018-03-29 06:28:30'),
(91, 1, '2018-04-11', '2018-04-11 06:47:43', NULL, '2018-04-11 06:47:44', '2018-04-11 06:47:44'),
(92, 1, '2018-05-08', '2018-05-08 05:19:46', NULL, '2018-05-08 05:19:46', '2018-05-08 05:19:46'),
(93, 1, '2018-05-21', '2018-05-21 06:51:03', '2018-05-21 07:11:32', '2018-05-21 06:51:03', '2018-05-21 07:11:33'),
(94, 1, '2018-05-22', '2018-05-22 04:54:37', NULL, '2018-05-22 04:54:37', '2018-05-22 04:54:37'),
(95, 1, '2018-05-23', '2018-05-23 07:46:39', NULL, '2018-05-23 07:46:39', '2018-05-23 07:46:39'),
(96, 1, '2018-05-27', '2018-05-27 10:50:30', NULL, '2018-05-27 10:50:30', '2018-05-27 10:50:30'),
(97, 1, '2018-07-24', '2018-07-24 09:09:46', NULL, '2018-07-24 09:09:46', '2018-07-24 09:09:46'),
(98, 1, '2018-08-11', '2018-08-11 09:28:04', NULL, '2018-08-11 09:28:05', '2018-08-11 09:28:05'),
(99, 1, '2018-08-12', '2018-08-12 09:54:30', NULL, '2018-08-12 09:54:31', '2018-08-12 09:54:31'),
(100, 1, '2018-10-24', '2018-10-24 07:07:00', NULL, '2018-10-24 07:07:00', '2018-10-24 07:07:00'),
(101, 1, '2018-10-25', '2018-10-25 10:32:28', NULL, '2018-10-25 10:32:28', '2018-10-25 10:32:28'),
(102, 1, '2018-10-26', '2018-10-25 18:13:50', '2018-10-25 18:15:36', '2018-10-25 18:13:51', '2018-10-25 18:15:37'),
(103, 1, '2018-10-28', '2018-10-27 20:11:13', NULL, '2018-10-27 20:11:14', '2018-10-27 20:11:14'),
(104, 1, '2018-12-02', '2018-12-02 07:19:22', NULL, '2018-12-02 07:19:22', '2018-12-02 07:19:22'),
(105, 1, '2019-02-03', '2019-02-03 03:21:17', NULL, '2019-02-03 03:21:17', '2019-02-03 03:21:17'),
(106, 1, '2019-02-04', '2019-02-04 04:28:30', NULL, '2019-02-04 04:28:31', '2019-02-04 04:28:31'),
(107, 1, '2019-02-05', '2019-02-05 04:26:24', NULL, '2019-02-05 04:26:24', '2019-02-05 04:26:24'),
(108, 1, '2019-02-10', '2019-02-10 09:12:40', NULL, '2019-02-10 09:12:40', '2019-02-10 09:12:40'),
(109, 1, '2019-02-14', '2019-02-14 06:24:57', NULL, '2019-02-14 06:24:57', '2019-02-14 06:24:57'),
(110, 1, '2019-02-16', '2019-02-16 11:43:07', NULL, '2019-02-16 11:43:08', '2019-02-16 11:43:08'),
(111, 1, '2019-02-25', '2019-02-25 04:28:43', NULL, '2019-02-25 04:28:44', '2019-02-25 04:28:44'),
(112, 1, '2019-03-03', '2019-03-03 09:17:56', NULL, '2019-03-03 09:17:56', '2019-03-03 09:17:56'),
(113, 1, '2019-05-08', '2019-05-08 07:13:39', NULL, '2019-05-08 07:13:40', '2019-05-08 07:13:40'),
(114, 1, '2019-05-23', '2019-05-23 03:57:49', NULL, '2019-05-23 03:57:50', '2019-05-23 03:57:50'),
(115, 1, '2019-06-10', '2019-06-10 05:54:08', NULL, '2019-06-10 05:54:08', '2019-06-10 05:54:08'),
(116, 1, '2019-06-12', '2019-06-12 06:58:52', NULL, '2019-06-12 06:58:52', '2019-06-12 06:58:52'),
(117, 1, '2019-06-20', '2019-06-20 12:11:15', NULL, '2019-06-20 12:11:15', '2019-06-20 12:11:15'),
(118, 1, '2019-06-23', '2019-06-23 07:58:35', NULL, '2019-06-23 07:58:36', '2019-06-23 07:58:36'),
(119, 1, '2019-06-24', '2019-06-24 06:08:22', NULL, '2019-06-24 06:08:22', '2019-06-24 06:08:22'),
(120, 14, '2019-06-24', '2019-06-24 06:21:29', '2019-06-24 06:39:12', '2019-06-24 06:21:29', '2019-06-24 06:39:12'),
(121, 14, '2019-06-24', '2019-06-24 06:39:17', '2019-06-24 09:26:12', '2019-06-24 06:39:17', '2019-06-24 09:26:12'),
(122, 14, '2019-06-24', '2019-06-24 11:09:06', NULL, '2019-06-24 11:09:06', '2019-06-24 11:09:06'),
(123, 1, '2019-09-02', '2019-09-01 20:17:02', NULL, '2019-09-01 20:17:03', '2019-09-01 20:17:03'),
(124, 1, '2019-09-11', '2019-09-11 10:39:55', NULL, '2019-09-11 10:39:55', '2019-09-11 10:39:55'),
(125, 1, '2019-09-18', '2019-09-18 07:10:52', '2019-09-18 08:51:30', '2019-09-18 07:10:52', '2019-09-18 08:51:30'),
(126, 1, '2019-09-18', '2019-09-18 08:51:38', NULL, '2019-09-18 08:51:38', '2019-09-18 08:51:38'),
(127, 1, '2019-09-19', '2019-09-19 04:23:34', '2019-09-19 07:28:30', '2019-09-19 04:23:34', '2019-09-19 07:28:30'),
(128, 1, '2019-09-19', '2019-09-19 07:28:38', NULL, '2019-09-19 07:28:38', '2019-09-19 07:28:38'),
(129, 1, '2019-09-21', '2019-09-21 04:39:36', NULL, '2019-09-21 04:39:36', '2019-09-21 04:39:36'),
(130, 1, '2019-09-25', '2019-09-25 08:48:13', '2019-09-25 08:48:52', '2019-09-25 08:48:13', '2019-09-25 08:48:52'),
(131, 1, '2019-09-25', '2019-09-25 08:48:58', '2019-09-25 10:21:57', '2019-09-25 08:48:58', '2019-09-25 10:21:57'),
(132, 1, '2019-09-26', '2019-09-26 11:36:53', NULL, '2019-09-26 11:36:53', '2019-09-26 11:36:53'),
(133, 1, '2019-09-28', '2019-09-28 10:27:09', NULL, '2019-09-28 10:27:10', '2019-09-28 10:27:10'),
(134, 1, '2019-10-03', '2019-10-03 10:32:27', NULL, '2019-10-03 10:32:27', '2019-10-03 10:32:27'),
(135, 1, '2019-10-23', '2019-10-23 10:35:33', NULL, '2019-10-23 10:35:34', '2019-10-23 10:35:34'),
(136, 1, '2019-12-01', '2019-12-01 09:22:03', NULL, '2019-12-01 09:22:03', '2019-12-01 09:22:03'),
(137, 1, '2019-12-04', '2019-12-04 10:41:37', '2019-12-04 10:45:50', '2019-12-04 10:41:38', '2019-12-04 10:45:50'),
(138, 1, '2019-12-04', '2019-12-04 10:45:53', '2019-12-04 10:45:55', '2019-12-04 10:45:53', '2019-12-04 10:45:55'),
(139, 1, '2019-12-05', '2019-12-05 04:11:22', '2019-12-05 06:38:43', '2019-12-05 04:11:23', '2019-12-05 06:38:43'),
(140, 1, '2019-12-05', '2019-12-05 10:53:59', NULL, '2019-12-05 10:53:59', '2019-12-05 10:53:59'),
(141, 1, '2019-12-06', '2019-12-06 13:57:00', NULL, '2019-12-06 13:57:01', '2019-12-06 13:57:01'),
(142, 1, '2019-12-11', '2019-12-11 11:48:24', '2019-12-11 11:59:31', '2019-12-11 11:48:24', '2019-12-11 11:59:31'),
(143, 1, '2019-12-15', '2019-12-15 12:00:20', NULL, '2019-12-15 12:00:20', '2019-12-15 12:00:20'),
(144, 1, '2019-12-17', '2019-12-17 05:18:25', NULL, '2019-12-17 05:18:26', '2019-12-17 05:18:26'),
(145, 1, '2019-12-21', '2019-12-21 13:44:50', '2019-12-21 13:46:32', '2019-12-21 13:44:51', '2019-12-21 13:46:32'),
(146, 1, '2019-12-22', '2019-12-22 09:56:24', '2019-12-22 09:57:17', '2019-12-22 09:56:25', '2019-12-22 09:57:17'),
(147, 1, '2019-12-25', '2019-12-25 07:20:30', NULL, '2019-12-25 07:20:30', '2019-12-25 07:20:30'),
(148, 1, '2020-01-04', '2020-01-03 19:12:40', NULL, '2020-01-03 19:12:40', '2020-01-03 19:12:40'),
(149, 1, '2020-01-05', '2020-01-05 07:25:52', NULL, '2020-01-05 07:25:53', '2020-01-05 07:25:53'),
(150, 1, '2020-01-09', '2020-01-09 05:51:22', NULL, '2020-01-09 05:51:22', '2020-01-09 05:51:22'),
(151, 1, '2020-01-12', '2020-01-12 10:20:28', '2020-01-12 11:29:27', '2020-01-12 10:20:28', '2020-01-12 11:29:27'),
(152, 1, '2020-02-13', '2020-02-13 09:11:21', NULL, '2020-02-13 09:11:21', '2020-02-13 09:11:21'),
(153, 1, '2020-02-24', '2020-02-24 09:34:55', '2020-02-24 09:37:36', '2020-02-24 09:34:55', '2020-02-24 09:37:36'),
(154, 1, '2020-02-24', '2020-02-24 09:37:57', '2020-02-24 11:20:58', '2020-02-24 09:37:57', '2020-02-24 11:20:58'),
(155, 1, '2020-03-12', '2020-03-12 10:45:51', NULL, '2020-03-12 10:45:51', '2020-03-12 10:45:51'),
(156, 1, '2020-03-13', '2020-03-13 14:28:05', NULL, '2020-03-13 14:28:05', '2020-03-13 14:28:05'),
(157, 1, '2020-03-19', '2020-03-19 12:06:56', NULL, '2020-03-19 12:06:56', '2020-03-19 12:06:56'),
(158, 1, '2020-03-23', '2020-03-23 04:43:56', '2020-03-23 04:45:06', '2020-03-23 04:43:56', '2020-03-23 04:45:06'),
(159, 1, '2020-03-31', '2020-03-31 09:31:43', NULL, '2020-03-31 09:31:44', '2020-03-31 09:31:44'),
(160, 1, '2020-04-20', '2020-04-20 05:28:32', NULL, '2020-04-20 05:28:32', '2020-04-20 05:28:32'),
(161, 1, '2020-05-03', '2020-05-02 23:08:36', NULL, '2020-05-02 23:08:36', '2020-05-02 23:08:36'),
(162, 1, '2020-05-06', '2020-05-06 06:28:06', NULL, '2020-05-06 06:28:06', '2020-05-06 06:28:06'),
(163, 1, '2020-05-21', '2020-05-21 08:32:46', NULL, '2020-05-21 08:32:46', '2020-05-21 08:32:46'),
(164, 1, '2020-06-28', '2020-06-28 07:18:36', NULL, '2020-06-28 07:18:36', '2020-06-28 07:18:36'),
(165, 1, '2020-09-01', '2020-09-01 10:18:43', NULL, '2020-09-01 10:18:43', '2020-09-01 10:18:43'),
(166, 1, '2020-10-12', '2020-10-12 02:43:59', NULL, '2020-10-12 02:43:59', '2020-10-12 02:43:59'),
(167, 3, '2020-10-12', '2020-10-12 07:00:58', NULL, '2020-10-12 07:00:58', '2020-10-12 07:00:58'),
(168, 1, '2020-11-14', '2020-11-14 06:13:58', NULL, '2020-11-14 06:13:58', '2020-11-14 06:13:58'),
(169, 1, '2020-11-18', '2020-11-18 09:31:38', NULL, '2020-11-18 09:31:39', '2020-11-18 09:31:39'),
(170, 1, '2020-11-19', '2020-11-19 01:44:50', NULL, '2020-11-19 01:44:50', '2020-11-19 01:44:50'),
(171, 1, '2020-11-20', '2020-11-19 21:22:34', NULL, '2020-11-19 21:22:34', '2020-11-19 21:22:34'),
(172, 1, '2020-11-21', '2020-11-21 05:03:29', NULL, '2020-11-21 05:03:29', '2020-11-21 05:03:29'),
(173, 1, '2020-11-22', '2020-11-21 16:19:01', NULL, '2020-11-21 16:19:03', '2020-11-21 16:19:03'),
(174, 1, '2020-11-23', '2020-11-22 17:52:00', '2020-11-22 17:55:16', '2020-11-22 17:52:01', '2020-11-22 17:55:17'),
(175, 1, '2020-11-23', '2020-11-22 17:57:26', NULL, '2020-11-22 17:57:27', '2020-11-22 17:57:27'),
(176, 1, '2020-11-24', '2020-11-23 16:45:17', NULL, '2020-11-23 16:45:17', '2020-11-23 16:45:17'),
(177, 1, '2020-11-25', '2020-11-24 17:29:17', NULL, '2020-11-24 17:29:18', '2020-11-24 17:29:18'),
(178, 1, '2020-11-26', '2020-11-25 16:37:44', NULL, '2020-11-25 16:37:45', '2020-11-25 16:37:45'),
(179, 1, '2020-11-28', '2020-11-27 16:17:02', NULL, '2020-11-27 16:17:04', '2020-11-27 16:17:04'),
(180, 1, '2020-11-29', '2020-11-28 16:39:20', NULL, '2020-11-28 16:39:22', '2020-11-28 16:39:22'),
(181, 1, '2020-11-30', '2020-11-29 16:38:24', NULL, '2020-11-29 16:38:24', '2020-11-29 16:38:24'),
(182, 1, '2020-12-01', '2020-11-30 16:11:29', NULL, '2020-11-30 16:11:32', '2020-11-30 16:11:32'),
(183, 1, '2020-12-02', '2020-12-01 17:55:25', NULL, '2020-12-01 17:55:26', '2020-12-01 17:55:26'),
(184, 1, '2020-12-03', '2020-12-02 16:50:55', NULL, '2020-12-02 16:50:56', '2020-12-02 16:50:56'),
(185, 1, '2020-12-05', '2020-12-04 16:41:39', NULL, '2020-12-04 16:41:42', '2020-12-04 16:41:42'),
(186, 1, '2020-12-06', '2020-12-05 16:03:07', NULL, '2020-12-05 16:03:07', '2020-12-05 16:03:07'),
(187, 1, '2020-12-08', '2020-12-08 08:00:32', '2020-12-08 09:08:33', '2020-12-08 08:00:32', '2020-12-08 09:08:34'),
(188, 1, '2020-12-18', '2020-12-18 15:45:10', NULL, '2020-12-18 15:45:11', '2020-12-18 15:45:11'),
(189, 1, '2021-01-23', '2021-01-23 09:19:19', NULL, '2021-01-23 09:19:19', '2021-01-23 09:19:19'),
(190, 1, '2021-02-25', '2021-02-25 06:32:04', '2021-02-25 06:32:10', '2021-02-25 06:32:05', '2021-02-25 06:32:11'),
(191, 1, '2021-02-25', '2021-02-25 06:32:25', NULL, '2021-02-25 06:32:25', '2021-02-25 06:32:25'),
(192, 1, '2021-02-26', '2021-02-25 22:24:58', NULL, '2021-02-25 22:24:58', '2021-02-25 22:24:58'),
(193, 1, '2021-02-28', '2021-02-28 10:31:57', NULL, '2021-02-28 10:31:57', '2021-02-28 10:31:57'),
(194, 1, '2021-03-27', '2021-03-27 08:16:37', '2021-03-27 09:52:54', '2021-03-27 08:16:37', '2021-03-27 09:52:55'),
(195, 1, '2021-03-27', '2021-03-27 09:56:12', NULL, '2021-03-27 09:56:12', '2021-03-27 09:56:12'),
(196, 1, '2021-03-28', '2021-03-28 05:12:34', '2021-03-28 06:11:18', '2021-03-28 05:12:34', '2021-03-28 06:11:18'),
(197, 1, '2021-03-28', '2021-03-28 06:11:52', NULL, '2021-03-28 06:11:52', '2021-03-28 06:11:52'),
(198, 1, '2021-04-01', '2021-04-01 08:14:01', NULL, '2021-04-01 08:14:01', '2021-04-01 08:14:01'),
(199, 1, '2021-04-11', '2021-04-11 12:17:27', NULL, '2021-04-11 12:17:28', '2021-04-11 12:17:28'),
(200, 1, '2021-05-19', '2021-05-19 07:00:00', '2021-05-19 08:48:02', '2021-05-19 08:25:44', '2021-05-19 08:48:02'),
(201, 1, '2021-05-19', '2021-05-19 08:48:27', NULL, '2021-05-19 08:48:28', '2021-05-19 08:48:28'),
(202, 1, '2021-05-30', '2021-05-30 10:44:23', '2021-05-30 10:49:39', '2021-05-30 10:44:23', '2021-05-30 10:49:39'),
(203, 1, '2021-05-30', '2021-05-30 10:55:08', '2021-05-30 10:55:27', '2021-05-30 10:55:08', '2021-05-30 10:55:28'),
(204, 1, '2021-05-30', '2021-05-30 10:55:37', NULL, '2021-05-30 10:55:37', '2021-05-30 10:55:37'),
(205, 1, '2021-05-31', '2021-05-31 09:27:52', NULL, '2021-05-31 09:27:52', '2021-05-31 09:27:52'),
(206, 1, '2021-06-02', '2021-06-02 09:24:53', NULL, '2021-06-02 09:24:53', '2021-06-02 09:24:53'),
(207, 1, '2021-06-04', '2021-06-04 14:33:43', NULL, '2021-06-04 14:33:44', '2021-06-04 14:33:44'),
(208, 1, '2021-06-17', '2021-06-17 08:42:26', NULL, '2021-06-17 08:42:26', '2021-06-17 08:42:26'),
(209, 1, '2021-06-23', '2021-06-23 09:52:16', '2021-06-23 10:59:14', '2021-06-23 09:52:16', '2021-06-23 10:59:14'),
(210, 1, '2021-06-23', '2021-06-23 10:59:57', NULL, '2021-06-23 10:59:57', '2021-06-23 10:59:57'),
(211, 1, '2021-06-24', '2021-06-24 04:12:49', NULL, '2021-06-24 04:12:49', '2021-06-24 04:12:49'),
(212, 1, '2021-06-26', '2021-06-26 05:57:50', NULL, '2021-06-26 05:57:51', '2021-06-26 05:57:51'),
(213, 1, '2021-06-29', '2021-06-29 06:16:55', NULL, '2021-06-29 06:16:55', '2021-06-29 06:16:55'),
(214, 1, '2021-06-30', '2021-06-30 11:03:52', NULL, '2021-06-30 11:03:53', '2021-06-30 11:03:53'),
(215, 1, '2021-07-01', '2021-07-01 06:53:49', NULL, '2021-07-01 06:53:49', '2021-07-01 06:53:49'),
(216, 1, '2021-07-06', '2021-07-06 11:30:57', NULL, '2021-07-06 11:30:58', '2021-07-06 11:30:58'),
(217, 1, '2021-07-13', '2021-07-13 04:24:09', '2021-07-13 04:24:20', '2021-07-13 04:24:09', '2021-07-13 04:24:20'),
(218, 1, '2021-07-14', '2021-07-14 05:02:09', NULL, '2021-07-14 05:02:09', '2021-07-14 05:02:09'),
(219, 1, '2021-07-23', '2021-07-23 09:18:51', NULL, '2021-07-23 09:18:52', '2021-07-23 09:18:52'),
(220, 1, '2021-07-25', '2021-07-25 05:56:05', '2021-07-25 05:56:18', '2021-07-25 05:56:06', '2021-07-25 05:56:18'),
(221, 1, '2021-07-27', '2021-07-27 05:28:39', NULL, '2021-07-27 05:28:39', '2021-07-27 05:28:39'),
(222, 1, '2021-07-29', '2021-07-29 08:07:46', NULL, '2021-07-29 08:07:46', '2021-07-29 08:07:46'),
(223, 1, '2021-07-31', '2021-07-31 06:10:40', NULL, '2021-07-31 06:10:42', '2021-07-31 06:10:42'),
(224, 1, '2021-08-19', '2021-08-19 06:03:19', '2021-08-19 06:03:25', '2021-08-19 06:03:19', '2021-08-19 06:03:26'),
(225, 1, '2021-08-21', '2021-08-21 09:23:55', '2021-08-21 09:24:21', '2021-08-21 09:23:56', '2021-08-21 09:24:21'),
(226, 1, '2021-08-21', '2021-08-21 09:24:54', NULL, '2021-08-21 09:24:54', '2021-08-21 09:24:54'),
(227, 1, '2021-08-23', '2021-08-23 06:25:55', '2021-08-23 07:53:23', '2021-08-23 06:25:56', '2021-08-23 07:53:23'),
(228, 1, '2021-08-24', '2021-08-24 05:32:54', '2021-08-24 05:47:27', '2021-08-24 05:32:54', '2021-08-24 05:47:27'),
(229, 17, '2021-08-24', '2021-08-24 05:47:41', '2021-08-24 05:48:18', '2021-08-24 05:47:41', '2021-08-24 05:48:18'),
(230, 1, '2021-08-24', '2021-08-24 05:48:23', NULL, '2021-08-24 05:48:23', '2021-08-24 05:48:23'),
(231, 1, '2021-09-08', '2021-09-08 07:12:27', NULL, '2021-09-08 07:12:28', '2021-09-08 07:12:28'),
(232, 1, '2021-09-09', '2021-09-09 15:08:14', NULL, '2021-09-09 15:08:14', '2021-09-09 15:08:14'),
(233, 1, '2021-09-10', '2021-09-10 06:41:32', '2021-09-10 06:43:58', '2021-09-10 06:41:32', '2021-09-10 06:43:59'),
(234, 1, '2021-09-10', '2021-09-10 06:47:07', NULL, '2021-09-10 06:47:07', '2021-09-10 06:47:07'),
(235, 1, '2021-09-11', '2021-09-11 05:22:43', NULL, '2021-09-11 05:22:43', '2021-09-11 05:22:43'),
(236, 1, '2021-09-21', '2021-09-21 10:32:01', NULL, '2021-09-21 10:32:01', '2021-09-21 10:32:01'),
(237, 1, '2021-09-23', '2021-09-23 08:15:01', '2021-09-23 08:26:03', '2021-09-23 08:15:01', '2021-09-23 08:26:03'),
(238, 1, '2021-09-23', '2021-09-23 08:26:07', NULL, '2021-09-23 08:26:07', '2021-09-23 08:26:07'),
(239, 1, '2021-09-30', '2021-09-30 08:35:15', '2021-09-30 09:02:01', '2021-09-30 08:35:15', '2021-09-30 09:02:01'),
(240, 1, '2021-09-30', '2021-09-30 09:04:34', '2021-09-30 09:05:59', '2021-09-30 09:04:34', '2021-09-30 09:05:59'),
(241, 1, '2021-09-30', '2021-09-30 09:13:10', NULL, '2021-09-30 09:13:10', '2021-09-30 09:13:10'),
(242, 1, '2021-10-17', '2021-10-17 07:10:10', NULL, '2021-10-17 07:10:10', '2021-10-17 07:10:10'),
(243, 1, '2021-10-19', '2021-10-19 07:57:29', NULL, '2021-10-19 07:57:29', '2021-10-19 07:57:29'),
(244, 1, '2021-11-02', '2021-11-02 08:53:52', '2021-11-02 08:54:02', '2021-11-02 08:53:52', '2021-11-02 08:54:02'),
(245, 1, '2021-11-08', '2021-11-08 08:00:13', NULL, '2021-11-08 08:00:14', '2021-11-08 08:00:14'),
(246, 1, '2021-11-17', '2021-11-17 10:25:02', NULL, '2021-11-17 10:25:02', '2021-11-17 10:25:02'),
(247, 1, '2021-11-25', '2021-11-25 09:18:02', NULL, '2021-11-25 09:18:03', '2021-11-25 09:18:03'),
(248, 1, '2021-12-04', '2021-12-04 05:46:46', '2021-12-04 05:48:13', '2021-12-04 05:46:46', '2021-12-04 05:48:13'),
(249, 1, '2021-12-04', '2021-12-04 05:48:16', '2021-12-04 06:40:22', '2021-12-04 05:48:16', '2021-12-04 06:40:22'),
(250, 1, '2021-12-04', '2021-12-04 06:41:28', '2021-12-04 06:42:22', '2021-12-04 06:41:29', '2021-12-04 06:42:22'),
(251, 1, '2021-12-05', '2021-12-05 07:25:13', NULL, '2021-12-05 07:25:13', '2021-12-05 07:25:13'),
(252, 1, '2021-12-06', '2021-12-06 06:50:00', NULL, '2021-12-06 06:50:00', '2021-12-06 06:50:00'),
(253, 1, '2021-12-07', '2021-12-07 05:00:22', NULL, '2021-12-07 05:00:22', '2021-12-07 05:00:22'),
(254, 1, '2021-12-12', '2021-12-12 04:27:09', NULL, '2021-12-12 04:27:10', '2021-12-12 04:27:10'),
(255, 1, '2021-12-29', '2021-12-29 10:42:05', '2021-12-29 10:42:12', '2021-12-29 10:42:06', '2021-12-29 10:42:12'),
(256, 1, '2022-01-03', '2022-01-03 08:30:53', NULL, '2022-01-03 08:30:53', '2022-01-03 08:30:53'),
(257, 1, '2022-01-18', '2022-01-17 18:04:47', NULL, '2022-01-17 18:04:47', '2022-01-17 18:04:47'),
(258, 1, '2022-02-05', '2022-02-05 05:09:03', NULL, '2022-02-05 05:09:03', '2022-02-05 05:09:03'),
(259, 1, '2022-02-06', '2022-02-06 08:27:33', NULL, '2022-02-06 08:27:34', '2022-02-06 08:27:34'),
(260, 1, '2022-02-11', '2022-02-11 06:17:07', NULL, '2022-02-11 06:17:07', '2022-02-11 06:17:07'),
(261, 1, '2022-02-13', '2022-02-13 05:58:22', NULL, '2022-02-13 05:58:22', '2022-02-13 05:58:22'),
(262, 1, '2022-02-14', '2022-02-14 04:41:00', '2022-02-14 04:41:10', '2022-02-14 04:41:00', '2022-02-14 04:41:10'),
(263, 1, '2022-02-14', '2022-02-14 13:41:59', NULL, '2022-02-14 13:41:59', '2022-02-14 13:41:59'),
(264, 1, '2022-02-15', '2022-02-15 06:55:52', NULL, '2022-02-15 06:55:53', '2022-02-15 06:55:53'),
(265, 1, '2022-02-16', '2022-02-16 09:55:32', '2022-02-16 10:09:16', '2022-02-16 09:55:32', '2022-02-16 10:09:16'),
(266, 1, '2022-02-16', '2022-02-16 10:09:19', NULL, '2022-02-16 10:09:19', '2022-02-16 10:09:19'),
(267, 1, '2022-02-17', '2022-02-17 09:17:00', '2022-02-17 09:18:35', '2022-02-17 09:17:00', '2022-02-17 09:18:36'),
(268, 1, '2022-02-17', '2022-02-17 09:18:43', '2022-02-17 09:18:55', '2022-02-17 09:18:43', '2022-02-17 09:18:55'),
(269, 1, '2022-02-17', '2022-02-17 11:34:59', NULL, '2022-02-17 11:34:59', '2022-02-17 11:34:59'),
(270, 1, '2022-02-18', '2022-02-18 14:49:40', '2022-02-18 14:52:47', '2022-02-18 14:49:40', '2022-02-18 14:52:47'),
(271, 1, '2022-02-18', '2022-02-18 17:31:57', '2022-02-18 17:32:26', '2022-02-18 17:31:57', '2022-02-18 17:32:26'),
(272, 1, '2022-02-19', '2022-02-19 03:29:14', '2022-02-19 06:40:15', '2022-02-19 03:29:14', '2022-02-19 06:40:15'),
(273, 1, '2022-02-19', '2022-02-19 06:40:23', '2022-02-19 06:40:30', '2022-02-19 06:40:23', '2022-02-19 06:40:30'),
(274, 1, '2022-02-19', '2022-02-19 06:40:35', '2022-02-19 06:40:39', '2022-02-19 06:40:35', '2022-02-19 06:40:39'),
(275, 1, '2022-03-07', '2022-03-07 08:13:57', '2022-03-07 08:14:50', '2022-03-07 08:13:57', '2022-03-07 08:14:50'),
(276, 1, '2022-03-07', '2022-03-07 08:14:53', '2022-03-07 08:35:37', '2022-03-07 08:14:53', '2022-03-07 08:35:37'),
(277, 1, '2022-03-07', '2022-03-07 08:35:59', '2022-03-07 08:36:19', '2022-03-07 08:35:59', '2022-03-07 08:36:19'),
(278, 17, '2022-03-07', '2022-03-07 08:36:27', '2022-03-07 08:37:29', '2022-03-07 08:36:27', '2022-03-07 08:37:29'),
(279, 1, '2022-03-07', '2022-03-07 08:37:35', NULL, '2022-03-07 08:37:35', '2022-03-07 08:37:35'),
(280, 1, '2022-03-10', '2022-03-10 08:33:15', NULL, '2022-03-10 08:33:16', '2022-03-10 08:33:16'),
(281, 17, '2022-03-13', '2022-03-13 09:15:32', '2022-03-13 09:19:53', '2022-03-13 09:15:32', '2022-03-13 09:19:53'),
(282, 1, '2022-03-30', '2022-03-30 04:21:39', NULL, '2022-03-30 04:21:39', '2022-03-30 04:21:39'),
(283, 1, '2022-06-27', '2022-06-27 07:38:20', '2022-06-27 07:44:39', '2022-06-27 07:38:21', '2022-06-27 07:44:39'),
(284, 1, '2022-06-27', '2022-06-27 07:44:57', '2022-06-27 07:51:29', '2022-06-27 07:44:57', '2022-06-27 07:51:29'),
(285, 1, '2022-09-25', '2022-09-25 10:11:31', NULL, '2022-09-25 10:11:31', '2022-09-25 10:11:31'),
(286, 1, '2022-09-26', '2022-09-26 04:09:50', NULL, '2022-09-26 04:09:51', '2022-09-26 04:09:51'),
(287, 1, '2022-10-13', '2022-10-13 11:05:36', NULL, '2022-10-13 11:05:36', '2022-10-13 11:05:36'),
(288, 1, '2022-10-13', '2022-10-13 11:13:00', '2022-10-13 12:10:00', '2022-10-13 11:11:56', '2022-10-13 11:11:56'),
(289, 1, '2022-11-13', '2022-11-13 03:09:03', NULL, '2022-11-13 03:09:03', '2022-11-13 03:09:03'),
(290, 1, '2022-11-14', '2022-11-14 09:33:15', NULL, '2022-11-14 09:33:15', '2022-11-14 09:33:15'),
(291, 1, '2022-11-22', '2022-11-22 05:02:46', '2022-11-22 05:09:09', '2022-11-22 05:02:46', '2022-11-22 05:09:09'),
(292, 1, '2022-11-22', '2022-11-22 05:09:13', '2022-11-22 05:09:17', '2022-11-22 05:09:13', '2022-11-22 05:09:17'),
(293, 1, '2022-11-22', '2022-11-22 05:09:19', '2022-11-22 05:09:22', '2022-11-22 05:09:19', '2022-11-22 05:09:22'),
(294, 1, '2022-11-22', '2022-11-22 05:09:24', '2022-11-22 05:09:26', '2022-11-22 05:09:24', '2022-11-22 05:09:26'),
(295, 1, '2022-11-22', '2022-11-22 05:09:29', NULL, '2022-11-22 05:09:29', '2022-11-22 05:09:29'),
(296, 1, '2023-01-30', '2023-01-30 05:35:52', NULL, '2023-01-30 05:35:53', '2023-01-30 05:35:53'),
(297, 1, '2023-02-08', '2023-02-08 08:33:31', '2023-02-08 09:45:40', '2023-02-08 08:33:31', '2023-02-08 09:45:40'),
(298, 1, '2023-02-08', '2023-02-08 09:59:36', '2023-02-08 10:09:02', '2023-02-08 09:59:36', '2023-02-08 10:09:02'),
(299, 1, '2023-03-16', '2023-03-16 04:00:36', NULL, '2023-03-16 04:00:36', '2023-03-16 04:00:36'),
(300, 1, '2023-05-11', '2023-05-11 10:12:27', '2023-05-11 10:12:40', '2023-05-11 10:12:27', '2023-05-11 10:12:40'),
(301, 1, '2023-05-13', '2023-05-13 09:39:39', NULL, '2023-05-13 09:39:39', '2023-05-13 09:39:39'),
(302, 1, '2023-05-14', '2023-05-14 01:41:29', '2023-05-14 01:42:20', '2023-05-14 01:41:29', '2023-05-14 01:42:20'),
(303, 1, '2023-05-14', '2023-05-14 05:30:28', NULL, '2023-05-14 05:30:28', '2023-05-14 05:30:28'),
(304, 1, '2023-05-17', '2023-05-17 09:02:25', '2023-05-17 11:04:55', '2023-05-17 09:02:26', '2023-05-17 11:04:56'),
(305, 1, '2023-05-18', '2023-05-18 07:20:41', NULL, '2023-05-18 07:20:41', '2023-05-18 07:20:41'),
(306, 1, '2023-06-03', '2023-06-03 08:40:42', NULL, '2023-06-03 08:40:42', '2023-06-03 08:40:42'),
(307, 1, '2023-06-06', '2023-06-06 07:52:28', NULL, '2023-06-06 07:52:29', '2023-06-06 07:52:29'),
(308, 1, '2023-06-08', '2023-06-08 07:11:37', NULL, '2023-06-08 07:11:38', '2023-06-08 07:11:38'),
(309, 1, '2023-06-10', '2023-06-10 02:30:46', '2023-06-10 02:31:58', '2023-06-10 02:30:46', '2023-06-10 02:31:58'),
(310, 1, '2023-06-10', '2023-06-10 02:32:03', '2023-06-10 02:32:07', '2023-06-10 02:32:03', '2023-06-10 02:32:07'),
(311, 1, '2023-06-12', '2023-06-12 10:51:34', '2023-06-12 11:17:33', '2023-06-12 10:51:34', '2023-06-12 11:17:33'),
(312, 1, '2023-06-13', '2023-06-13 06:51:29', NULL, '2023-06-13 06:51:30', '2023-06-13 06:51:30'),
(313, 1, '2023-07-23', '2023-07-23 16:36:23', NULL, '2023-07-23 16:36:24', '2023-07-23 16:36:24'),
(314, 1, '2023-07-24', '2023-07-24 14:10:50', NULL, '2023-07-24 14:10:50', '2023-07-24 14:10:50'),
(315, 1, '2023-07-28', '2023-07-28 12:22:20', '2023-07-28 14:41:15', '2023-07-28 12:22:21', '2023-07-28 14:41:15'),
(316, 1, '2023-08-01', '2023-08-01 11:54:05', NULL, '2023-08-01 11:54:05', '2023-08-01 11:54:05'),
(317, 1, '2023-08-07', '2023-08-07 11:31:29', '2023-08-07 11:35:50', '2023-08-07 11:31:29', '2023-08-07 11:35:50'),
(318, 1, '2023-08-07', '2023-08-07 15:25:01', NULL, '2023-08-07 15:25:01', '2023-08-07 15:25:01'),
(319, 1, '2023-08-09', '2023-08-09 03:45:46', NULL, '2023-08-09 03:45:46', '2023-08-09 03:45:46'),
(320, 1, '2023-08-12', '2023-08-12 06:07:24', '2023-08-12 07:18:38', '2023-08-12 06:07:24', '2023-08-12 07:18:38'),
(321, 1, '2023-08-12', '2023-08-12 07:22:15', NULL, '2023-08-12 07:22:15', '2023-08-12 07:22:15'),
(322, 1, '2023-08-14', '2023-08-14 17:40:18', NULL, '2023-08-14 17:40:18', '2023-08-14 17:40:18'),
(323, 1, '2023-08-15', '2023-08-15 13:19:54', NULL, '2023-08-15 13:19:54', '2023-08-15 13:19:54'),
(324, 1, '2023-09-02', '2023-09-02 05:44:49', NULL, '2023-09-02 05:44:49', '2023-09-02 05:44:49'),
(325, 1, '2023-09-12', '2023-09-12 10:11:22', NULL, '2023-09-12 10:11:22', '2023-09-12 10:11:22'),
(326, 1, '2023-09-19', '2023-09-19 16:30:48', NULL, '2023-09-19 16:30:48', '2023-09-19 16:30:48'),
(327, 1, '2023-10-16', '2023-10-16 12:05:30', NULL, '2023-10-16 12:05:30', '2023-10-16 12:05:30'),
(328, 1, '2023-11-12', '2023-11-12 04:23:39', NULL, '2023-11-12 04:23:39', '2023-11-12 04:23:39'),
(329, 1, '2023-12-31', '2023-12-31 14:07:24', NULL, '2023-12-31 14:07:24', '2023-12-31 14:07:24'),
(330, 1, '2024-01-31', '2024-01-31 06:45:11', NULL, '2024-01-31 06:45:11', '2024-01-31 06:45:11'),
(331, 1, '2024-02-11', '2024-02-11 06:32:51', '2024-02-11 07:00:03', '2024-02-11 06:32:51', '2024-02-11 07:00:03'),
(332, 1, '2024-02-11', '2024-02-11 07:00:08', NULL, '2024-02-11 07:00:08', '2024-02-11 07:00:08'),
(333, 1, '2024-02-12', '2024-02-12 04:13:00', NULL, '2024-02-12 04:13:00', '2024-02-12 04:13:00'),
(334, 1, '2024-02-20', '2024-02-20 08:42:50', NULL, '2024-02-20 08:42:50', '2024-02-20 08:42:50'),
(335, 1, '2024-02-25', '2024-02-25 07:31:15', NULL, '2024-02-25 07:31:15', '2024-02-25 07:31:15'),
(336, 1, '2024-02-26', '2024-02-26 03:57:27', NULL, '2024-02-26 03:57:28', '2024-02-26 03:57:28'),
(337, 1, '2024-02-27', '2024-02-27 10:28:21', NULL, '2024-02-27 10:28:21', '2024-02-27 10:28:21'),
(338, 1, '2024-05-06', '2024-05-06 02:41:53', NULL, '2024-05-06 02:41:53', '2024-05-06 02:41:53'),
(339, 1, '2024-07-29', '2024-07-29 08:58:33', '2024-07-29 09:02:09', '2024-07-29 08:58:33', '2024-07-29 09:02:09'),
(340, 1, '2024-08-14', '2024-08-14 10:55:38', '2024-08-14 10:56:43', '2024-08-14 10:55:38', '2024-08-14 10:56:43'),
(341, 1, '2024-08-14', '2024-08-14 10:57:05', '2024-08-14 10:57:33', '2024-08-14 10:57:05', '2024-08-14 10:57:33'),
(342, 6, '2024-08-14', '2024-08-14 10:57:41', '2024-08-14 10:57:56', '2024-08-14 10:57:41', '2024-08-14 10:57:56'),
(343, 6, '2024-08-14', '2024-08-14 10:57:58', '2024-08-14 10:57:59', '2024-08-14 10:57:58', '2024-08-14 10:57:59'),
(344, 6, '2024-08-14', '2024-08-14 10:58:01', '2024-08-14 11:34:31', '2024-08-14 10:58:01', '2024-08-14 11:34:31'),
(345, 1, '2024-08-14', '2024-08-14 11:34:41', NULL, '2024-08-14 11:34:41', '2024-08-14 11:34:41'),
(346, 1, '2024-08-17', '2024-08-16 22:16:42', NULL, '2024-08-16 22:16:43', '2024-08-16 22:16:43'),
(347, 1, '2024-08-19', '2024-08-19 04:37:15', '2024-08-19 05:11:31', '2024-08-19 04:37:15', '2024-08-19 05:11:31'),
(348, 1, '2024-08-19', '2024-08-19 05:11:37', '2024-08-19 05:11:41', '2024-08-19 05:11:37', '2024-08-19 05:11:41'),
(349, 1, '2024-09-02', '2024-09-02 07:26:24', '2024-09-02 07:26:52', '2024-09-02 07:26:24', '2024-09-02 07:26:52'),
(350, 1, '2024-09-02', '2024-09-02 07:27:06', '2024-09-02 07:27:14', '2024-09-02 07:27:06', '2024-09-02 07:27:14'),
(351, 1, '2024-09-03', '2024-09-03 05:09:02', NULL, '2024-09-03 05:09:02', '2024-09-03 05:09:02'),
(352, 1, '2024-09-07', '2024-09-07 13:56:29', NULL, '2024-09-07 13:56:30', '2024-09-07 13:56:30'),
(353, 1, '2024-09-08', '2024-09-07 20:08:12', '2024-09-07 20:12:53', '2024-09-07 20:08:12', '2024-09-07 20:12:53'),
(354, 20, '2024-09-08', '2024-09-07 20:13:01', '2024-09-07 20:13:49', '2024-09-07 20:13:01', '2024-09-07 20:13:49'),
(355, 1, '2024-09-08', '2024-09-07 20:13:54', NULL, '2024-09-07 20:13:54', '2024-09-07 20:13:54'),
(356, 1, '2024-09-09', '2024-09-09 08:20:28', NULL, '2024-09-09 08:20:28', '2024-09-09 08:20:28'),
(357, 1, '2024-09-10', '2024-09-10 08:51:30', NULL, '2024-09-10 08:51:30', '2024-09-10 08:51:30'),
(358, 1, '2024-09-11', '2024-09-11 11:22:30', '2024-09-11 12:01:29', '2024-09-11 11:22:30', '2024-09-11 12:01:30'),
(359, 1, '2024-09-11', '2024-09-11 12:01:57', NULL, '2024-09-11 12:01:57', '2024-09-11 12:01:57'),
(360, 1, '2024-09-23', '2024-09-23 04:38:10', NULL, '2024-09-23 04:38:10', '2024-09-23 04:38:10'),
(361, 1, '2024-09-24', '2024-09-24 04:13:16', NULL, '2024-09-24 04:13:16', '2024-09-24 04:13:16'),
(362, 1, '2024-10-01', '2024-10-01 09:52:52', NULL, '2024-10-01 09:52:52', '2024-10-01 09:52:52'),
(363, 1, '2024-10-02', '2024-10-02 10:04:04', NULL, '2024-10-02 10:04:04', '2024-10-02 10:04:04'),
(364, 1, '2024-10-29', '2024-10-29 12:48:53', NULL, '2024-10-29 12:48:53', '2024-10-29 12:48:53'),
(365, 1, '2024-11-03', '2024-11-03 09:05:30', NULL, '2024-11-03 09:05:30', '2024-11-03 09:05:30'),
(366, 1, '2024-11-04', '2024-11-04 04:05:35', NULL, '2024-11-04 04:05:36', '2024-11-04 04:05:36'),
(367, 1, '2024-11-05', '2024-11-05 03:51:45', NULL, '2024-11-05 03:51:45', '2024-11-05 03:51:45'),
(368, 1, '2024-11-10', '2024-11-10 04:07:07', '2024-11-10 07:35:13', '2024-11-10 04:07:07', '2024-11-10 07:35:13'),
(369, 1, '2024-11-10', '2024-11-10 11:20:38', NULL, '2024-11-10 11:20:38', '2024-11-10 11:20:38'),
(370, 1, '2024-11-11', '2024-11-11 04:07:29', NULL, '2024-11-11 04:07:31', '2024-11-11 04:07:31');

-- --------------------------------------------------------

--
-- Table structure for table `clock_summaries`
--

CREATE TABLE IF NOT EXISTS `clock_summaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `in_time` timestamp NULL DEFAULT NULL,
  `out_time` timestamp NULL DEFAULT NULL,
  `late` bigint(20) DEFAULT NULL,
  `early` bigint(20) DEFAULT NULL,
  `overtime` bigint(20) DEFAULT NULL,
  `rest` bigint(20) DEFAULT NULL,
  `working` bigint(20) DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tag` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'logo', '580d20283ae91.png'),
(2, 'application_name', 'HR Matrix'),
(3, 'timezone_id', '248'),
(4, 'default_currency', 'Taka'),
(5, 'default_currency_symbol', 'BDT'),
(6, 'currency_decimal', '2'),
(7, 'currency_position', 'prefix'),
(8, 'default_language', 'en'),
(9, 'direction', 'ltr'),
(10, 'allowed_upload_file', 'pdf,doc,docx,xls,xlsx,jpg,jpeg'),
(11, 'notification_position', 'toast-top-right'),
(12, 'application_setup_info', '0'),
(13, 'error_display', '1'),
(14, 'time_format', '24hrs'),
(15, 'date_format', 'dd mm YYYY'),
(16, 'company_name', 'NIBIZ Soft'),
(17, 'contact_person', 'Admin'),
(18, 'email', 'info@nibizsoft.com'),
(19, 'phone', '01712643138'),
(20, 'address_1', 'House 23, Garib E Newaj Avenue, sector 13'),
(21, 'address_2', ''),
(22, 'city', 'Dhaka'),
(23, 'state', 'Uttara'),
(24, 'zipcode', '1230'),
(25, 'country_id', '20'),
(26, 'auto_clock_authentication', '1'),
(27, 'payroll_contribution_field', '1'),
(28, 'enable_job_application_candidates', '1'),
(29, 'application_format', '');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `is_primary` tinyint(4) NOT NULL DEFAULT '0',
  `is_dependent` tinyint(4) NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personal_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_phone_extension` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `home` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_1` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_2` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `is_primary`, `is_dependent`, `name`, `relation`, `work_email`, `personal_email`, `work_phone`, `work_phone_extension`, `mobile`, `home`, `address_1`, `address_2`, `city`, `state`, `zipcode`, `country_id`, `created_at`, `updated_at`) VALUES
(1, 4, 0, 1, 'kazi', 'self', 'muckta@nibizsoft.com', 'kazimuckta@gmial.com', '01722 834385', '', '01969 649555', '123456', 'Uttara', 'airport', 'Dhaka', 'Uttara', '1230', '20', '2016-11-03 18:58:40', '2016-11-03 18:58:40'),
(2, 3, 1, 0, 'james', 'self', 'james@nibizsoft.com', '', '01969101010', '', '01969101010', '01969101010', 'House 23, sector 11 uttara', '', 'Dhaka', 'Uttara', '1230', '20', '2020-02-24 10:08:33', '2020-02-24 10:08:33'),
(3, 17, 0, 1, 'Abdur Mazed', 'parent', 'mobin@nibizsoft.net', '', '', '', '01710894325', '', '795/1, Ibrahimpur', 'Kafrul', 'Dhaka', 'Dhaka', '1206', '20', '2021-08-24 05:42:32', '2021-08-24 05:42:32'),
(4, 19, 0, 1, 'Ann Stark', 'child', 'fosif@mailinator.com', 'moji@mailinator.com', '+1 (331) 436-1858', '+1 (172) 324-5547', 'Esse rerum consequat', 'Quidem molestias Nam', '592 Clarendon Drive', 'Temporibus eligendi ', 'Suscipit deserunt mi', 'Nemo eius tempor tem', '44045', '121', '2024-11-11 09:00:27', '2024-11-11 09:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE IF NOT EXISTS `contracts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `contract_type_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `title` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `contract_type_id` (`contract_type_id`),
  KEY `designation_id` (`designation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id`, `user_id`, `contract_type_id`, `designation_id`, `description`, `title`, `from_date`, `to_date`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2, '', 'Full TIme', '2016-10-01', '2018-01-31', '2016-10-23 21:39:21', '2017-10-25 09:15:57'),
(3, 3, 1, 6, '', 'contract', '2016-10-01', '2016-12-31', '2016-10-25 06:34:34', '2016-10-25 06:34:34'),
(4, 7, 1, 6, ' 6E5D6YRTFDSERT', 'LNK8I7BU6JHYGTRFWS', '2019-06-23', '2019-07-31', '2019-06-24 06:38:20', '2019-06-24 06:38:20'),
(5, 14, 1, 6, 'KUJYHGTRFEWDSDFRGTHYJUKILKUYJGTRFEW', 'LNK8I7BU6JHYGTRFWS', '2019-06-22', '2019-10-31', '2019-06-24 06:41:25', '2019-06-24 06:41:25'),
(6, 3, 1, 2, 'salary increased for good performance. by 5000 tk ', 'Accountant', '2020-02-24', '2029-11-30', '2020-02-24 09:53:22', '2024-10-02 10:38:39'),
(7, 1, 1, 1, '', 'admin', '2020-02-24', '2022-07-06', '2020-02-24 10:20:12', '2020-02-24 10:20:12'),
(8, 17, 1, 6, '', 'No Need', '2021-08-01', '2021-11-30', '2021-08-24 05:44:02', '2021-08-24 05:44:02'),
(9, 19, 1, 3, 'hg', 'dg', '2024-11-11', '2024-11-11', '2024-11-11 08:59:08', '2024-11-11 08:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `contract_types`
--

CREATE TABLE IF NOT EXISTS `contract_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contract_types`
--

INSERT INTO `contract_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Full Time', '2016-10-23 21:01:43', '2016-10-23 21:01:43'),
(2, 'Part Time', '2016-10-23 21:01:52', '2016-10-23 21:01:52');

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE IF NOT EXISTS `custom_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `options` text COLLATE utf8_unicode_ci,
  `is_required` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `custom_field_values`
--

CREATE TABLE IF NOT EXISTS `custom_field_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` int(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `field_id` (`field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_hidden` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `is_hidden`, `created_at`, `updated_at`) VALUES
(1, 'System Administration', NULL, 1, '2016-10-23 09:39:09', NULL),
(2, 'HR Department', '', 0, '2016-10-23 20:48:00', '2016-10-23 20:48:00'),
(3, 'Account', '', 0, '2016-10-23 21:11:20', '2016-10-23 21:11:20'),
(4, 'Supply Chain', '', 0, '2016-10-23 21:11:35', '2016-10-23 21:11:35'),
(5, 'IT Department', '', 0, '2016-10-23 21:11:48', '2016-10-23 21:11:48'),
(6, 'Sales', '', 0, '2016-10-23 21:11:58', '2016-10-23 21:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE IF NOT EXISTS `designations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_id` int(11) DEFAULT NULL,
  `top_designation_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_hidden` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id` (`department_id`),
  KEY `top_designation_id` (`top_designation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `department_id`, `top_designation_id`, `name`, `is_hidden`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'System Administrator', 1, '2016-10-23 09:39:09', NULL),
(2, 4, 1, 'Accountant', 0, '2016-10-23 21:12:42', '2024-11-11 07:18:10'),
(3, 5, 1, 'HR Manager', 0, '2016-10-23 21:13:16', '2024-11-11 07:48:22'),
(4, 5, 3, 'HR Executive', 0, '2016-10-23 21:13:31', '2024-11-11 07:19:06'),
(5, 2, 2, 'Ass Accountant', 0, '2016-10-23 21:13:57', '2024-11-11 09:51:28'),
(6, 5, 1, 'IT Manager', 0, '2016-10-23 21:14:15', '2024-11-11 07:22:15'),
(7, 4, 6, 'IT Executive', 0, '2016-10-23 21:14:30', '2024-11-11 07:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `document_type_id` int(11) DEFAULT NULL,
  `date_of_expiry` date DEFAULT NULL,
  `title` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `attachments` text COLLATE utf8_unicode_ci,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `document_type_id` (`document_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `user_id`, `document_type_id`, `date_of_expiry`, `title`, `description`, `attachments`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 2, '2020-02-27', 'cv', 'certificates', '5e539b73a6c4e.jpg', 1, '2020-02-24 09:46:27', '2020-02-24 09:46:27'),
(2, 19, 2, '2024-11-27', 'fff', 'ff', '6731c048185f8.jpg', 1, '2024-11-11 08:28:56', '2024-11-11 08:28:56');

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

CREATE TABLE IF NOT EXISTS `document_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `document_types`
--

INSERT INTO `document_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'CV', '2016-10-23 21:03:54', '2016-10-23 21:03:54'),
(2, 'Expericnce Letter', '2016-10-23 21:04:08', '2016-10-23 21:04:08'),
(3, 'Release Letter', '2016-10-23 21:04:14', '2016-10-23 21:04:14'),
(4, 'HSC Certificate', '2016-10-23 21:04:24', '2016-10-23 21:04:24'),
(5, 'MBA Certificates', '2016-10-23 21:04:35', '2016-10-23 21:04:35'),
(6, 'Cover Letter', '2016-10-25 05:24:57', '2016-10-25 05:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE IF NOT EXISTS `education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `education_level` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `board` varchar(255) DEFAULT NULL,
  `institute` varchar(255) DEFAULT NULL,
  `result_type` varchar(255) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `passing_year` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`id`, `education_level`, `subject`, `board`, `institute`, `result_type`, `grade`, `passing_year`, `user_id`, `created_at`, `updated_at`) VALUES
(27, 'madrasah', 'bangla', 'Perspiciatis hic qu', 'Sed dolore eum dolor', 'cgpa', 'Id alias officia und', 1988, 1, '2024-11-11 11:52:07', '2024-11-11 11:52:07'),
(30, 'postgraduate', 'bangla', 'Aut assumenda Nam es', 'Et quam proident es', 'gpa', 'Et nesciunt tempora', 1997, 5, '2024-11-11 11:53:07', '2024-11-11 11:53:07'),
(34, 'undergraduate', 'economics', 'Aspernatur id non do', 'Ea labore irure aspe', 'gpa', 'Sed ut natus aut des', 2013, 19, '2024-11-11 12:32:13', '2024-11-11 12:32:13'),
(35, 'postgraduate', 'religion', 'Voluptate optio off', 'Quis et dicta invent', 'gpa', 'Eum velit earum sed ', 1992, 19, '2024-11-11 12:32:13', '2024-11-11 12:32:13'),
(36, 'primary', 'chemistry', 'Sed qui ea et sed su', 'Earum sapiente sunt ', 'cgpa', 'Adipisci esse et ve', 1996, 19, '2024-11-11 12:32:13', '2024-11-11 12:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_address` text COLLATE utf8_unicode_ci,
  `from_address` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` text COLLATE utf8_unicode_ci,
  `body` text COLLATE utf8_unicode_ci,
  `attachments` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employeetransfer`
--

CREATE TABLE IF NOT EXISTS `employeetransfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fbranch` int(11) DEFAULT NULL,
  `fdepartment` int(11) DEFAULT NULL,
  `fsection` int(11) DEFAULT NULL,
  `fdesignation` int(11) DEFAULT NULL,
  `ftransfer_date` date DEFAULT NULL,
  `femployee` int(11) DEFAULT NULL,
  `tbranch` int(11) DEFAULT NULL,
  `tdepartment` int(11) DEFAULT NULL,
  `tsection` int(11) DEFAULT NULL,
  `tdesignation` int(11) DEFAULT NULL,
  `tjoin_date` date DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `employeetransfer`
--

INSERT INTO `employeetransfer` (`id`, `fbranch`, `fdepartment`, `fsection`, `fdesignation`, `ftransfer_date`, `femployee`, `tbranch`, `tdepartment`, `tsection`, `tdesignation`, `tjoin_date`, `remarks`, `created_at`, `updated_at`) VALUES
(11, 12, 5, 7, 7, '2017-01-16', 4, 6, 1, 4, 4, '1995-04-05', 'Voluptates assumenda', '2024-11-11 12:05:14', '2024-11-11 12:05:14'),
(12, 7, 4, 2, 2, '1985-10-03', 9, 6, 6, 6, 2, '1971-03-09', 'Aperiam voluptate re', '2024-11-11 12:06:01', '2024-11-11 12:06:01'),
(13, 7, 4, 2, 2, '1985-10-03', 9, 6, 6, 6, 2, '1971-03-09', 'Aperiam voluptate re', '2024-11-11 12:06:05', '2024-11-11 12:06:05'),
(14, 16, 2, 8, 6, '1997-07-17', 5, 4, 6, 3, 4, '1973-05-10', 'Consequatur Volupta', '2024-11-11 12:08:35', '2024-11-11 12:08:35'),
(18, 5, 2, 5, 5, '1989-04-17', 15, 15, 4, 5, 5, '1993-02-08', 'Officia omnis eum of', '2024-11-11 15:51:24', '2024-11-11 15:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_head_id` int(11) DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `amount` decimal(25,5) DEFAULT NULL,
  `date_of_expense` date DEFAULT NULL,
  `attachments` text COLLATE utf8_unicode_ci,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_remarks` text COLLATE utf8_unicode_ci,
  `remarks` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_head_id` (`expense_head_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_head_id`, `user_id`, `amount`, `date_of_expense`, `attachments`, `status`, `admin_remarks`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '800.00000', '2017-01-03', NULL, 'pending', NULL, '', '2017-01-03 10:24:42', '2017-01-03 10:24:42'),
(2, 3, 1, '300.00000', '2018-03-24', NULL, 'pending', NULL, '', '2018-03-24 06:16:08', '2018-03-24 06:16:08'),
(4, 1, 1, '100.00000', '2019-06-24', NULL, 'pending', NULL, 'asdfghjkl', '2019-06-24 07:54:27', '2019-06-24 07:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `expense_heads`
--

CREATE TABLE IF NOT EXISTS `expense_heads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `head` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `expense_heads`
--

INSERT INTO `expense_heads` (`id`, `head`, `created_at`, `updated_at`) VALUES
(1, 'Transportation', '2016-10-23 21:09:22', '2016-10-23 21:09:22'),
(2, 'Office Equipments', '2016-10-23 21:09:30', '2016-10-23 21:09:30'),
(3, 'Electircity Bill', '2016-10-23 21:09:37', '2016-10-23 21:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'test grade', NULL, '2024-11-10 07:29:11', '2024-11-10 07:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `date`, `description`, `created_at`, `updated_at`) VALUES
(1, '2017-10-25', '', '2017-10-25 09:19:52', '2017-10-25 09:19:52'),
(2, '2018-03-26', 'sadhinota dibosh', '2018-03-24 06:09:22', '2018-03-24 06:09:22'),
(3, '2019-06-25', 'Company Birthday', '2019-06-24 06:30:15', '2019-06-24 06:30:15'),
(4, '2024-02-26', 'Shabe Barat', '2024-02-26 04:36:56', '2024-02-26 04:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_closing` date DEFAULT NULL,
  `no_of_post` int(11) DEFAULT NULL,
  `job_type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `designation_id` (`designation_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `designation_id`, `location`, `date_of_closing`, `no_of_post`, `job_type`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'ac', 6, 'd', '2022-02-28', 1, 'full_time', '<p>fghjjkk<br /></p>', 1, '2018-03-27 09:24:25', '2021-05-19 08:49:11'),
(2, 'Head of IT', 6, 'dhaka', '2019-06-30', 2, 'full_time', '<p><br /></p>', 1, '2019-06-24 07:11:49', '2019-06-24 07:11:49'),
(3, 'Executive', 7, 'dhaka', '2023-08-31', 5, 'full_time', '<p>text</p>', 1, '2023-08-12 07:18:18', '2023-08-12 07:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE IF NOT EXISTS `job_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resume` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8_unicode_ci,
  `date_of_application` date DEFAULT NULL,
  `date_of_joining` date DEFAULT NULL,
  `salary` decimal(25,5) DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `job_id` (`job_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `job_id`, `name`, `email`, `contact_number`, `source`, `resume`, `status`, `remarks`, `date_of_application`, `date_of_joining`, `salary`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'jaman', 'james@themexsoft.com', '23423234', 'website', NULL, 'applied', NULL, '2021-05-19', NULL, NULL, 1, '2021-05-19 08:49:38', '2021-05-19 08:49:38'),
(2, 3, 'N Jaman Chowdhury James', 'sunjove@gmail.com', '01969101010', 'website', NULL, 'applied', NULL, '2023-08-12', NULL, NULL, NULL, '2023-08-12 07:21:26', '2023-08-12 07:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE IF NOT EXISTS `leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `leave_type_id` int(11) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8_unicode_ci,
  `approved_date` text COLLATE utf8_unicode_ci,
  `admin_remarks` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `leave_type_id` (`leave_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `user_id`, `leave_type_id`, `from_date`, `to_date`, `description`, `status`, `remarks`, `approved_date`, `admin_remarks`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2016-10-26', '2016-10-26', NULL, 'approved', 'I want Medical Leave. please consider.', '2016-10-26', 'okay you can take leave.', '2016-10-24 21:25:25', '2022-11-22 05:11:47'),
(2, 3, 2, '2016-10-26', '2016-10-29', NULL, 'approved', 'for some personal reason', '2016-10-26,2016-10-27', 'you will get 2 days', '2016-10-25 06:36:35', '2016-10-25 06:37:52'),
(3, 3, 1, '2016-11-02', '2016-11-03', NULL, 'approved', 'for sick', '2016-11-02', 'for ofc purpose', '2016-10-25 11:43:11', '2016-10-25 11:44:20'),
(4, 2, 3, '2017-10-25', '2017-10-31', NULL, 'approved', 'test', '2017-10-29', 're test', '2017-10-25 09:21:58', '2017-10-25 09:23:02'),
(5, 14, 1, '2019-06-25', '2019-06-27', NULL, 'approved', 'asdfghj', '2019-06-25', 'Ja', '2019-06-24 06:57:35', '2019-06-24 07:02:32'),
(6, 1, 1, '2020-02-26', '2020-02-28', NULL, 'approved', '', '2020-02-27', 'test', '2020-02-24 10:21:44', '2020-02-24 10:23:31'),
(7, 1, 2, '2021-01-26', '2021-01-31', NULL, 'approved', 'tes', '2021-01-27,2021-01-28', 'test', '2021-01-23 09:23:08', '2021-01-23 09:23:46'),
(8, 1, 2, '2021-03-29', '2021-03-31', NULL, 'rejected', 'test', NULL, 'Hi', '2021-03-27 09:45:57', '2021-08-23 06:36:02'),
(9, 1, 2, '2021-04-01', '2021-04-03', NULL, 'approved', 'test', '2021-04-01', 'test', '2021-03-28 05:46:16', '2021-03-28 05:47:36'),
(10, 1, 6, '2021-05-24', '2021-05-26', NULL, 'approved', 'test', '2021-05-24,2021-05-25', 'test', '2021-05-19 08:39:02', '2021-05-19 08:39:53'),
(11, 1, 2, '2021-06-23', '2021-06-26', NULL, 'approved', 'test', '2021-06-24,2021-06-26', 'test', '2021-06-23 10:40:50', '2021-06-23 10:41:43'),
(12, 1, 2, '2021-08-24', '2021-08-25', NULL, 'pending', 'hi', NULL, NULL, '2021-08-23 06:34:56', '2021-08-23 06:34:56'),
(13, 1, 3, '2022-02-07', '2022-02-10', NULL, 'approved', 'Russel Vai er Bia te Jabo.', '2022-02-07,2022-02-09', 'Ato din Leave dea jabe na.', '2022-02-06 10:31:49', '2022-02-06 10:34:34');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE IF NOT EXISTS `leave_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sick Leave', '2016-10-23 21:02:45', '2016-10-23 21:02:45'),
(2, 'Medical Leave', '2016-10-23 21:03:38', '2016-10-23 21:03:38'),
(3, 'Casual Leave', '2016-10-23 21:03:47', '2016-10-23 21:03:47'),
(6, 'Travel Leave', '2020-02-24 10:15:09', '2020-02-24 10:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `visible` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `order`, `visible`) VALUES
(20, 'dashboard', NULL, 1),
(21, 'employee', NULL, 1),
(22, 'supervisor', NULL, 1),
(23, 'appraisal', NULL, 1),
(24, 'appraisal_rating', NULL, 1),
(25, 'appraisal_review', NULL, 1),
(26, 'attendance', NULL, 1),
(27, 'holiday', NULL, 1),
(28, 'leave', NULL, 1),
(29, 'payroll', NULL, 1),
(30, 'announcement', NULL, 1),
(31, 'award', NULL, 1),
(32, 'expense', NULL, 1),
(33, 'task', NULL, 1),
(34, 'ticket', NULL, 1),
(35, 'message', NULL, 1),
(36, 'job', NULL, 1),
(37, 'job_application', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user_id` int(10) unsigned DEFAULT NULL,
  `to_user_id` int(10) unsigned DEFAULT NULL,
  `subject` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `is_read` int(11) NOT NULL DEFAULT '0',
  `delete_sender` int(11) NOT NULL DEFAULT '0',
  `delete_receiver` int(11) NOT NULL DEFAULT '0',
  `reply_id` int(11) DEFAULT NULL,
  `attachments` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `from_user_id` (`from_user_id`),
  KEY `to_user_id` (`to_user_id`),
  KEY `reply_id` (`reply_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_user_id`, `to_user_id`, `subject`, `body`, `is_read`, `delete_sender`, `delete_receiver`, `reply_id`, `attachments`, `created_at`, `updated_at`) VALUES
(1, 1, 14, 'h8edbgHBIBCOw', '<p>asdfghjkhjgfdsaSDFGHJKLJHGFDSAsdfghjkhgfdsa</p>', 1, 0, 0, NULL, '5d1083076555a.jpg', '2019-06-24 08:00:07', '2019-06-24 08:01:32'),
(2, 1, 14, 'PKJHGFDSA', '<p>fghjkljhgfdsaSDFGHFDSA</p>', 1, 0, 0, NULL, '', '2019-06-24 08:08:51', '2019-06-24 08:09:01'),
(3, 1, 2, 'zjxjzx', '<p>nzlvnzl</p>', 0, 0, 0, NULL, '', '2019-09-25 08:52:34', '2019-09-25 08:52:34'),
(4, 1, 7, 'hi work', '<p>please meet me today</p>', 0, 0, 0, NULL, '', '2020-02-24 09:41:32', '2020-02-24 09:41:32'),
(5, 1, 2, 'testtesr', '<p>dsfdsf<br /></p>', 0, 1, 0, NULL, '', '2020-10-12 07:14:08', '2022-11-22 05:12:25'),
(6, 1, 2, 'test', '<p>test</p>', 0, 1, 0, NULL, '', '2021-06-23 10:58:29', '2022-02-19 06:13:12'),
(7, 1, 17, 'test', '<p>come in office<br /></p>', 0, 0, 0, NULL, '', '2022-02-19 06:38:02', '2022-02-19 06:38:02'),
(8, 1, 3, 'test', '<p>tes</p>', 0, 0, 0, NULL, '', '2023-08-12 06:52:29', '2023-08-12 06:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `user` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `office_shifts`
--

CREATE TABLE IF NOT EXISTS `office_shifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_default` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `office_shifts`
--

INSERT INTO `office_shifts` (`id`, `name`, `is_default`, `created_at`, `updated_at`) VALUES
(1, '1st Shift', 1, '2016-10-23 20:58:14', '2024-11-10 11:59:51'),
(2, '2nd Shift', 0, '2016-10-23 21:00:46', '2024-11-10 11:59:51');

-- --------------------------------------------------------

--
-- Table structure for table `office_shift_details`
--

CREATE TABLE IF NOT EXISTS `office_shift_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `office_shift_id` int(11) DEFAULT NULL,
  `day` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `overnight` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `office_shift_id` (`office_shift_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `office_shift_details`
--

INSERT INTO `office_shift_details` (`id`, `office_shift_id`, `day`, `in_time`, `out_time`, `overnight`, `created_at`, `updated_at`) VALUES
(1, 1, 'monday', '09:00:00', '17:00:00', 0, '2016-10-23 20:58:14', '2016-10-23 20:58:14'),
(2, 1, 'tuesday', '09:01:00', '17:00:00', 0, '2016-10-23 20:58:14', '2016-10-23 20:58:14'),
(3, 1, 'wednesday', '09:00:00', '17:00:00', 0, '2016-10-23 20:58:14', '2016-10-23 20:58:14'),
(4, 1, 'thursday', '09:00:00', '17:00:00', 0, '2016-10-23 20:58:14', '2016-10-23 20:58:14'),
(5, 1, 'friday', '09:00:00', '17:00:00', 0, '2016-10-23 20:58:14', '2016-10-23 20:58:14'),
(6, 1, 'saturday', '09:00:00', '17:00:00', 0, '2016-10-23 20:58:14', '2016-10-23 20:58:14'),
(7, 1, 'sunday', '09:00:00', '17:00:00', 0, '2016-10-23 20:58:14', '2016-10-23 20:58:14'),
(8, 2, 'monday', '18:00:00', '01:00:00', 1, '2016-10-23 21:00:46', '2016-10-23 21:00:46'),
(9, 2, 'tuesday', '18:00:00', '01:00:00', 1, '2016-10-23 21:00:46', '2016-10-23 21:00:46'),
(10, 2, 'wednesday', '18:00:00', '01:00:00', 1, '2016-10-23 21:00:46', '2016-10-23 21:00:46'),
(11, 2, 'thursday', '18:00:00', '01:00:00', 1, '2016-10-23 21:00:46', '2016-10-23 21:00:46'),
(12, 2, 'friday', '18:00:00', '01:00:00', 1, '2016-10-23 21:00:46', '2016-10-23 21:00:46'),
(13, 2, 'saturday', '18:00:00', '01:00:00', 1, '2016-10-23 21:00:46', '2016-10-23 21:00:46'),
(14, 2, 'sunday', '18:00:00', '01:00:00', 1, '2016-10-23 21:00:46', '2016-10-23 21:00:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE IF NOT EXISTS `payroll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_slip_id` int(11) DEFAULT NULL,
  `salary_type_id` int(11) DEFAULT NULL,
  `amount` decimal(25,5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salary_type_id` (`salary_type_id`),
  KEY `payroll_slip_id` (`payroll_slip_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`id`, `payroll_slip_id`, `salary_type_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '8000.00000', '2016-10-23 21:41:25', '2023-06-03 09:02:59'),
(2, 1, 2, '5000.00000', '2016-10-23 21:41:25', '2023-06-03 09:02:59'),
(3, 1, 3, '500.00000', '2016-10-23 21:41:25', '2023-06-03 09:02:59'),
(4, 1, 4, '500.00000', '2016-10-23 21:41:25', '2023-06-03 09:02:59'),
(5, 1, 5, '50.00000', '2016-10-23 21:41:25', '2023-06-03 09:02:59'),
(6, 1, 6, '0.00000', '2016-10-23 21:41:25', '2023-06-03 09:02:59'),
(7, 1, 7, '0.00000', '2016-10-23 21:41:25', '2023-06-03 09:02:59'),
(8, 2, 1, '29999.99000', '2016-10-25 06:03:13', '2024-10-29 12:51:20'),
(9, 2, 2, '3000.00000', '2016-10-25 06:03:13', '2024-10-29 12:51:20'),
(10, 2, 3, '500.00000', '2016-10-25 06:03:13', '2024-10-29 12:51:20'),
(11, 2, 4, '1000.00000', '2016-10-25 06:03:13', '2024-10-29 12:51:20'),
(12, 2, 5, '2000.00000', '2016-10-25 06:03:13', '2024-10-29 12:51:20'),
(13, 2, 6, '0.00000', '2016-10-25 06:03:13', '2024-10-29 12:51:20'),
(14, 2, 7, '0.00000', '2016-10-25 06:03:13', '2024-10-29 12:51:20'),
(15, 2, 8, '0.00000', '2016-10-25 11:46:52', '2024-10-29 12:51:20'),
(16, 3, 1, '8000.00000', '2019-06-24 07:22:45', '2019-06-24 07:23:13'),
(17, 3, 2, '7000.00000', '2019-06-24 07:22:45', '2019-06-24 07:23:13'),
(18, 3, 3, '1000.00000', '2019-06-24 07:22:45', '2019-06-24 07:23:13'),
(19, 3, 4, '1000.00000', '2019-06-24 07:22:45', '2019-06-24 07:23:13'),
(20, 3, 5, '500.00000', '2019-06-24 07:22:45', '2019-06-24 07:23:13'),
(21, 3, 6, '1200.00000', '2019-06-24 07:22:45', '2019-06-24 07:23:13'),
(22, 3, 7, '0.00000', '2019-06-24 07:22:45', '2019-06-24 07:23:13'),
(23, 3, 8, '1000.00000', '2019-06-24 07:22:45', '2019-06-24 07:23:13'),
(24, 1, 8, '0.00000', '2023-06-03 09:02:59', '2023-06-03 09:02:59'),
(25, 1, 9, '0.00000', '2023-06-03 09:02:59', '2023-06-03 09:02:59'),
(26, 1, 10, '0.00000', '2023-06-03 09:02:59', '2023-06-03 09:02:59'),
(27, 2, 9, '0.00000', '2024-10-29 12:51:20', '2024-10-29 12:51:20'),
(28, 2, 10, '0.00000', '2024-10-29 12:51:20', '2024-10-29 12:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_slip`
--

CREATE TABLE IF NOT EXISTS `payroll_slip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `date_of_contribution` date DEFAULT NULL,
  `employee_contribution` decimal(25,5) DEFAULT NULL,
  `employer_contribution` decimal(25,5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `payroll_slip`
--

INSERT INTO `payroll_slip` (`id`, `user_id`, `from_date`, `to_date`, `date_of_contribution`, `employee_contribution`, `employer_contribution`, `created_at`, `updated_at`) VALUES
(1, 2, '2016-10-01', '2016-10-31', NULL, NULL, NULL, '2016-10-23 21:41:25', '2016-10-23 21:41:25'),
(2, 3, '2016-11-01', '2016-11-01', NULL, '0.00000', NULL, '2016-10-25 06:03:13', '2024-10-29 12:51:20'),
(3, 14, '2019-06-24', '2019-07-29', NULL, NULL, NULL, '2019-06-24 07:22:45', '2019-06-24 07:22:45');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=216 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `category`, `name`, `created_at`, `updated_at`) VALUES
(111, 'language', 'manage_language', '2020-11-30 17:46:56', NULL),
(112, 'language', 'change_language', '2020-11-30 17:46:56', NULL),
(113, 'department', 'list_department', '2020-11-30 17:46:56', NULL),
(114, 'department', 'create_department', '2020-11-30 17:46:56', NULL),
(115, 'department', 'edit_department', '2020-11-30 17:46:56', NULL),
(116, 'department', 'delete_department', '2020-11-30 17:46:56', NULL),
(117, 'designation', 'list_designation', '2020-11-30 17:46:56', NULL),
(118, 'designation', 'create_designation', '2020-11-30 17:46:56', NULL),
(119, 'designation', 'edit_designation', '2020-11-30 17:46:56', NULL),
(120, 'designation', 'delete_designation', '2020-11-30 17:46:56', NULL),
(121, 'designation', 'manage_all_designation', '2020-11-30 17:46:56', NULL),
(122, 'designation', 'manage_subordinate_designation', '2020-11-30 17:46:56', NULL),
(123, 'custom_field', 'manage_custom_field', '2020-11-30 17:46:56', NULL),
(124, 'template', 'manage_template', '2020-11-30 17:46:56', NULL),
(125, 'message', 'manage_message', '2020-11-30 17:46:56', NULL),
(126, 'holiday', 'list_holiday', '2020-11-30 17:46:56', NULL),
(127, 'holiday', 'create_holiday', '2020-11-30 17:46:56', NULL),
(128, 'holiday', 'edit_holiday', '2020-11-30 17:46:56', NULL),
(129, 'holiday', 'delete_holiday', '2020-11-30 17:46:56', NULL),
(130, 'employee', 'list_employee', '2020-11-30 17:46:56', NULL),
(131, 'employee', 'create_employee', '2020-11-30 17:46:56', NULL),
(132, 'employee', 'edit_employee', '2020-11-30 17:46:56', NULL),
(133, 'employee', 'delete_employee', '2020-11-30 17:46:56', NULL),
(134, 'employee', 'manage_all_employee', '2020-11-30 17:46:56', NULL),
(135, 'employee', 'manage_subordinate_employee', '2020-11-30 17:46:56', NULL),
(136, 'configuration', 'manage_configuration', '2020-11-30 17:46:56', NULL),
(137, 'expense', 'list_expense', '2020-11-30 17:46:56', NULL),
(138, 'expense', 'create_expense', '2020-11-30 17:46:56', NULL),
(139, 'expense', 'edit_expense', '2020-11-30 17:46:56', NULL),
(140, 'expense', 'delete_expense', '2020-11-30 17:46:56', NULL),
(141, 'expense', 'manage_all_expense', '2020-11-30 17:46:56', NULL),
(142, 'expense', 'manage_subordinate_expense', '2020-11-30 17:46:56', NULL),
(143, 'expense', 'change_expense_status', '2020-11-30 17:46:56', NULL),
(144, 'announcement', 'list_announcement', '2020-11-30 17:46:56', NULL),
(145, 'announcement', 'create_announcement', '2020-11-30 17:46:56', NULL),
(146, 'announcement', 'edit_announcement', '2020-11-30 17:46:56', NULL),
(147, 'announcement', 'delete_announcement', '2020-11-30 17:46:56', NULL),
(148, 'announcement', 'manage_all_announcement', '2020-11-30 17:46:56', NULL),
(149, 'announcement', 'manage_subordinate_announcement', '2020-11-30 17:46:56', NULL),
(150, 'award', 'list_award', '2020-11-30 17:46:56', NULL),
(151, 'award', 'create_award', '2020-11-30 17:46:56', NULL),
(152, 'award', 'edit_award', '2020-11-30 17:46:56', NULL),
(153, 'award', 'delete_award', '2020-11-30 17:46:56', NULL),
(154, 'award', 'manage_all_award', '2020-11-30 17:46:56', NULL),
(155, 'award', 'manage_subordinate_award', '2020-11-30 17:46:56', NULL),
(156, 'task', 'list_task', '2020-11-30 17:46:56', NULL),
(157, 'task', 'create_task', '2020-11-30 17:46:56', NULL),
(158, 'task', 'manage_all_task', '2020-11-30 17:46:56', NULL),
(159, 'task', 'manage_subordinate_task', '2020-11-30 17:46:56', NULL),
(160, 'task', 'edit_task', '2020-11-30 17:46:56', NULL),
(161, 'task', 'delete_task', '2020-11-30 17:46:56', NULL),
(162, 'task', 'update_task_progress', '2020-11-30 17:46:56', NULL),
(163, 'task', 'assign_task', '2020-11-30 17:46:56', NULL),
(164, 'ticket', 'list_ticket', '2020-11-30 17:46:56', NULL),
(165, 'ticket', 'create_ticket', '2020-11-30 17:46:56', NULL),
(166, 'ticket', 'edit_ticket', '2020-11-30 17:46:56', NULL),
(167, 'ticket', 'delete_ticket', '2020-11-30 17:46:56', NULL),
(168, 'ticket', 'manage_all_ticket', '2020-11-30 17:46:56', NULL),
(169, 'ticket', 'manage_subordinate_ticket', '2020-11-30 17:46:56', NULL),
(170, 'ticket', 'update_ticket_status', '2020-11-30 17:46:56', NULL),
(171, 'ticket', 'assign_ticket', '2020-11-30 17:46:56', NULL),
(172, 'leave', 'request_leave', '2020-11-30 17:46:56', NULL),
(173, 'leave', 'edit_leave', '2020-11-30 17:46:56', NULL),
(174, 'leave', 'delete_leave', '2020-11-30 17:46:56', NULL),
(175, 'leave', 'manage_all_leave', '2020-11-30 17:46:56', NULL),
(176, 'leave', 'manage_subordinate_leave', '2020-11-30 17:46:56', NULL),
(177, 'leave', 'update_leave_status', '2020-11-30 17:46:56', NULL),
(178, 'employee', 'update_profile', '2020-11-30 17:46:56', NULL),
(179, 'attendance', 'update_attendance', '2020-11-30 17:46:56', NULL),
(180, 'payroll', 'generate_payroll', '2020-11-30 17:46:56', NULL),
(181, 'job', 'list_job', '2020-11-30 17:46:56', NULL),
(182, 'job', 'create_job', '2020-11-30 17:46:56', NULL),
(183, 'job', 'edit_job', '2020-11-30 17:46:56', NULL),
(184, 'job', 'delete_job', '2020-11-30 17:46:56', NULL),
(185, 'job', 'manage_all_job', '2020-11-30 17:46:56', NULL),
(186, 'job', 'manage_subordinate_job', '2020-11-30 17:46:56', NULL),
(187, 'job', 'manage_job_application', '2020-11-30 17:46:56', NULL),
(188, 'employee', 'reset_employee_password', '2020-11-30 17:46:56', NULL),
(189, 'message', 'message_all_employee', '2020-11-30 17:46:56', NULL),
(190, 'message', 'message_subordinate', '2020-11-30 17:46:56', NULL),
(191, 'system', 'manage_email_log', '2020-11-30 17:46:56', NULL),
(192, 'system', 'manage_backup', '2020-11-30 17:46:56', NULL),
(193, 'appraisal', 'appraisal_user', '2020-11-30 17:46:56', NULL),
(194, 'appraisal', 'appraisal_user_edit', '2020-11-30 17:46:56', NULL),
(195, 'appraisal', 'appraisal_user_edit_save', '2020-11-30 17:46:56', NULL),
(196, 'appraisal', 'appraisal_user_view', '2020-11-30 17:46:56', NULL),
(197, 'appraisal_rating', 'appraisal_rating', '2020-11-30 17:46:56', NULL),
(198, 'appraisal_rating', 'appraisal_rating_edit', '2020-11-30 17:46:56', NULL),
(199, 'appraisal_rating', 'appraisal_rating_edit_save', '2020-11-30 17:46:56', NULL),
(200, 'appraisal_rating', 'appraisal_rating_view', '2020-11-30 17:46:56', NULL),
(201, 'appraisal_rating', 'appraisal_task_add', '2020-11-30 17:46:56', NULL),
(202, 'appraisal_rating', 'appraisal_task_edit', '2020-11-30 17:46:56', NULL),
(203, 'appraisal_rating', 'appraisal_task_edit_save', '2020-11-30 17:46:56', NULL),
(204, 'appraisal_rating', 'appraisal_task_update', '2020-11-30 17:46:56', NULL),
(205, 'appraisal_review', 'appraisal_review', '2020-11-30 17:46:56', NULL),
(206, 'appraisal_review', 'appraisal_review_edit', '2020-11-30 17:46:56', NULL),
(207, 'appraisal_review', 'appraisal_review_edit_save', '2020-11-30 17:46:56', NULL),
(208, 'appraisal_review', 'appraisal_review_view', '2020-11-30 17:46:56', NULL),
(209, 'supervisor', 'supervisor_list', '2020-11-30 17:46:56', NULL),
(210, 'supervisor', 'supervisor_add', '2020-11-30 17:46:56', NULL),
(211, 'supervisor', 'supervisor_delete', '2020-11-30 17:46:56', NULL),
(212, 'supervisor', 'supervisor_employee', '2020-11-30 17:46:56', NULL),
(213, 'supervisor', 'supervisor_employee_add', '2020-11-30 17:46:56', NULL),
(214, 'appraisal', 'appraisal_user_add', '2020-12-02 17:56:05', NULL),
(215, 'appraisal', 'appraisal_user_delete', '2020-12-03 00:19:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned DEFAULT NULL,
  `role_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_id` (`permission_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=106 ;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`) VALUES
(1, 111, 1),
(2, 112, 1),
(3, 113, 1),
(4, 114, 1),
(5, 115, 1),
(6, 116, 1),
(7, 117, 1),
(8, 118, 1),
(9, 119, 1),
(10, 120, 1),
(11, 121, 1),
(12, 122, 1),
(13, 123, 1),
(14, 124, 1),
(15, 125, 1),
(16, 126, 1),
(17, 127, 1),
(18, 128, 1),
(19, 129, 1),
(20, 130, 1),
(21, 131, 1),
(22, 132, 1),
(23, 133, 1),
(24, 134, 1),
(25, 135, 1),
(26, 136, 1),
(27, 137, 1),
(28, 138, 1),
(29, 139, 1),
(30, 140, 1),
(31, 141, 1),
(32, 142, 1),
(33, 143, 1),
(34, 144, 1),
(35, 145, 1),
(36, 146, 1),
(37, 147, 1),
(38, 148, 1),
(39, 149, 1),
(40, 150, 1),
(41, 151, 1),
(42, 152, 1),
(43, 153, 1),
(44, 154, 1),
(45, 155, 1),
(46, 156, 1),
(47, 157, 1),
(48, 158, 1),
(49, 159, 1),
(50, 160, 1),
(51, 161, 1),
(52, 162, 1),
(53, 163, 1),
(54, 164, 1),
(55, 165, 1),
(56, 166, 1),
(57, 167, 1),
(58, 168, 1),
(59, 169, 1),
(60, 170, 1),
(61, 171, 1),
(62, 172, 1),
(63, 173, 1),
(64, 174, 1),
(65, 175, 1),
(66, 176, 1),
(67, 177, 1),
(68, 178, 1),
(69, 179, 1),
(70, 180, 1),
(71, 181, 1),
(72, 182, 1),
(73, 183, 1),
(74, 184, 1),
(75, 185, 1),
(76, 186, 1),
(77, 187, 1),
(78, 188, 1),
(79, 189, 1),
(80, 190, 1),
(81, 191, 1),
(82, 192, 1),
(83, 193, 1),
(84, 194, 1),
(85, 195, 1),
(86, 196, 1),
(87, 197, 1),
(88, 198, 1),
(89, 199, 1),
(90, 200, 1),
(91, 201, 1),
(92, 202, 1),
(93, 203, 1),
(94, 204, 1),
(95, 205, 1),
(96, 206, 1),
(97, 207, 1),
(98, 208, 1),
(99, 209, 1),
(100, 210, 1),
(101, 211, 1),
(102, 212, 1),
(103, 213, 1),
(104, 214, 1),
(105, 215, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `employee_code` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `marital_status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_joining` date DEFAULT NULL,
  `date_of_leaving` date DEFAULT NULL,
  `date_of_retirement` date DEFAULT NULL,
  `contact_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook_link` text COLLATE utf8_unicode_ci,
  `twitter_link` text COLLATE utf8_unicode_ci,
  `blogger_link` text COLLATE utf8_unicode_ci,
  `linkedin_link` text COLLATE utf8_unicode_ci,
  `googleplus_link` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_nature` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirm_date` timestamp NULL DEFAULT NULL,
  `religion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `height` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blood_group` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nid` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birth` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passport` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tin` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perm_house` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perm_road` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perm_division` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perm_post` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perm_district` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perm_thana` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perm_upazila` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `perm_post_code` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pres_house` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pres_road` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pres_division` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pres_post` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pres_district` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pres_thana` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pres_upazila` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pres_post_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `grade_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `user_id`, `employee_code`, `gender`, `marital_status`, `date_of_birth`, `date_of_joining`, `date_of_leaving`, `date_of_retirement`, `contact_number`, `photo`, `facebook_link`, `twitter_link`, `blogger_link`, `linkedin_link`, `googleplus_link`, `created_at`, `updated_at`, `category`, `job_nature`, `fathers_name`, `mothers_name`, `confirm_date`, `religion`, `height`, `weight`, `nationality`, `blood_group`, `nid`, `birth`, `passport`, `tin`, `perm_house`, `perm_road`, `perm_division`, `perm_post`, `perm_district`, `perm_thana`, `perm_upazila`, `perm_post_code`, `pres_house`, `pres_road`, `pres_division`, `pres_post`, `pres_district`, `pres_thana`, `pres_upazila`, `pres_post_code`, `branch_id`, `section_id`, `grade_id`) VALUES
(1, 1, '007', 'male', 'married', NULL, '2016-07-01', NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-23 20:09:16', '2024-11-10 07:01:17', 'staff', '', '', '', NULL, '', NULL, NULL, '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 7, 1, 1),
(2, 2, '101', 'male', 'single', NULL, '2016-07-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-23 21:16:45', '2016-10-23 21:36:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, '2', 'male', 'single', NULL, '2016-11-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-10-25 05:13:34', '2024-11-11 07:18:10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 7, NULL),
(4, 4, '192', 'male', 'single', NULL, '2016-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-03 18:54:32', '2016-12-05 07:05:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, '8345721', NULL, NULL, NULL, '2016-06-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2016-11-04 05:22:17', '2016-11-04 05:22:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 6, '180', NULL, NULL, NULL, '2017-03-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-05-22 11:04:39', '2024-11-11 07:47:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, 9, NULL),
(7, 7, '1001', 'male', 'single', '2017-10-10', '2017-10-25', NULL, NULL, NULL, '5b0528b267e66.jpg', NULL, NULL, NULL, NULL, NULL, '2017-10-25 10:23:33', '2024-11-11 07:19:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, 8, NULL),
(8, 8, '23', NULL, NULL, NULL, '2018-02-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-02-28 04:55:22', '2018-02-28 04:55:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 9, '234', NULL, NULL, NULL, '2018-02-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-02-28 04:56:52', '2024-11-11 09:51:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, 4, NULL),
(10, 10, '3444', NULL, NULL, NULL, '2018-04-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-03-27 09:39:27', '2018-03-27 09:39:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 11, '2333', NULL, NULL, NULL, '2018-04-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-05-22 05:10:05', '2024-11-11 07:18:12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, NULL),
(12, 12, '121', 'male', 'single', NULL, '2019-06-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-24 06:16:13', '2024-11-11 07:04:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, NULL),
(13, 13, '12115', NULL, NULL, NULL, '2019-06-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-06-24 06:17:04', '2024-11-11 07:22:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 6, NULL),
(14, 14, '2332', 'male', 'single', NULL, '2019-06-22', NULL, NULL, NULL, '5d107392afa8c.jpg', NULL, NULL, NULL, NULL, NULL, '2019-06-24 06:20:49', '2024-11-11 06:29:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, NULL),
(15, 15, '12111111', NULL, NULL, NULL, '2020-01-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-03 20:23:26', '2024-11-11 09:51:28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, 5, NULL),
(16, 7, '007', NULL, NULL, NULL, '2021-08-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-24 05:35:25', '2024-11-11 07:19:06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, 8, NULL),
(17, 17, '01836', 'male', 'married', '1988-02-05', '2021-08-01', NULL, NULL, NULL, '61248670c01e3.jpg', NULL, NULL, NULL, NULL, NULL, '2021-08-24 05:37:19', '2024-11-11 07:48:22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, 7, NULL),
(19, 19, '0034', 'male', 'single', NULL, '2024-01-24', NULL, NULL, '', '673031f478744.jpeg', NULL, NULL, NULL, NULL, NULL, '2024-01-31 07:12:14', '2024-11-11 09:00:02', '', 'Aut necessitatibus q', '', 'Mikayla Shields', NULL, '', NULL, NULL, '', NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, 1, 1),
(20, 20, '1234', NULL, NULL, NULL, '2024-09-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-09-07 20:10:53', '2024-11-11 07:19:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reports_types`
--

CREATE TABLE IF NOT EXISTS `reports_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(300) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `reports_types`
--

INSERT INTO `reports_types` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'test report', NULL, '2024-11-10 07:31:58', '2024-11-10 07:31:58');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_hidden` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `is_hidden`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, '2016-10-23 09:39:09', NULL),
(2, 'HR Manager', 0, '2016-10-23 20:43:49', '2016-10-23 20:43:49'),
(3, 'IT Manager', 0, '2016-10-23 20:47:26', '2016-10-23 20:47:26'),
(4, 'Accountant', 0, '2016-10-23 20:55:26', '2016-10-23 20:55:26'),
(5, 'Marketing ', 0, '2018-03-07 05:00:31', '2018-03-07 05:00:31');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 4),
(3, 3, 3),
(4, 4, 3),
(5, 5, 2),
(6, 6, 3),
(7, 7, 3),
(8, 8, 2),
(9, 9, 2),
(10, 10, 3),
(11, 11, 4),
(12, 12, 3),
(13, 13, 3),
(14, 14, 3),
(15, 15, 2),
(16, 16, 3),
(17, 17, 3),
(19, 19, 3),
(20, 20, 4);

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contract_id` int(10) DEFAULT NULL,
  `salary_type_id` int(11) DEFAULT NULL,
  `amount` decimal(25,5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contract_id` (`contract_id`),
  KEY `salary_type_id` (`salary_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `contract_id`, `salary_type_id`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '8000.00000', '2016-10-23 21:40:14', '2016-10-23 21:40:14'),
(2, 1, 2, '3000.00000', '2016-10-23 21:40:14', '2016-10-23 21:40:14'),
(3, 1, 3, '500.00000', '2016-10-23 21:40:14', '2016-10-23 21:40:14'),
(4, 1, 4, '500.00000', '2016-10-23 21:40:14', '2016-10-23 21:40:14'),
(5, 1, 5, '50.00000', '2016-10-23 21:40:14', '2016-10-23 21:40:14'),
(6, 1, 6, '0.00000', '2016-10-23 21:40:14', '2016-10-23 21:40:14'),
(7, 1, 7, '0.00000', '2016-10-23 21:40:14', '2016-10-23 21:40:14'),
(8, 5, 1, '15000.00000', '2019-06-24 06:56:29', '2019-06-24 06:56:38'),
(9, 5, 2, '7000.00000', '2019-06-24 06:56:29', '2019-06-24 06:56:38'),
(10, 5, 3, '1000.00000', '2019-06-24 06:56:29', '2019-06-24 06:56:38'),
(11, 5, 4, '1000.00000', '2019-06-24 06:56:29', '2019-06-24 06:56:38'),
(12, 5, 5, '600.00000', '2019-06-24 06:56:29', '2019-06-24 06:56:38'),
(13, 5, 6, '700.00000', '2019-06-24 06:56:29', '2019-06-24 06:56:38'),
(14, 5, 7, '6000.00000', '2019-06-24 06:56:29', '2019-06-24 06:56:38'),
(15, 5, 8, '12000.00000', '2019-06-24 06:56:29', '2019-06-24 06:56:38'),
(16, 3, 1, '9000.00000', '2020-02-24 09:56:34', '2020-02-24 09:56:34'),
(17, 3, 2, '5000.00000', '2020-02-24 09:56:34', '2020-02-24 09:56:34'),
(18, 3, 3, '1000.00000', '2020-02-24 09:56:34', '2020-02-24 09:56:34'),
(19, 3, 4, '500.00000', '2020-02-24 09:56:34', '2020-02-24 09:56:34'),
(20, 3, 5, '500.00000', '2020-02-24 09:56:34', '2020-02-24 09:56:34'),
(21, 3, 6, '700.00000', '2020-02-24 09:56:34', '2020-02-24 09:56:34'),
(22, 3, 7, '0.00000', '2020-02-24 09:56:34', '2020-02-24 09:56:34'),
(23, 3, 8, '2000.00000', '2020-02-24 09:56:34', '2020-02-24 09:56:34'),
(24, 6, 1, '9000.00000', '2020-02-24 09:58:03', '2020-02-24 09:58:03'),
(25, 6, 2, '900.00000', '2020-02-24 09:58:03', '2020-02-24 09:58:03'),
(26, 6, 3, '900.00000', '2020-02-24 09:58:03', '2020-02-24 09:58:03'),
(27, 6, 4, '900.00000', '2020-02-24 09:58:03', '2020-02-24 09:58:03'),
(28, 6, 5, '500.00000', '2020-02-24 09:58:03', '2020-02-24 09:58:03'),
(29, 6, 6, '500.00000', '2020-02-24 09:58:03', '2020-02-24 09:58:03'),
(30, 6, 7, '400.00000', '2020-02-24 09:58:03', '2020-02-24 09:58:03'),
(31, 6, 8, '4000.00000', '2020-02-24 09:58:03', '2020-02-24 09:58:03');

-- --------------------------------------------------------

--
-- Table structure for table `salary_types`
--

CREATE TABLE IF NOT EXISTS `salary_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `head` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salary_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `salary_types`
--

INSERT INTO `salary_types` (`id`, `head`, `salary_type`, `created_at`, `updated_at`) VALUES
(1, 'Basic Salary', 'earning', '2016-10-23 21:07:25', '2016-10-23 21:07:25'),
(2, 'House Rent', 'earning', '2016-10-23 21:07:36', '2016-10-23 21:07:36'),
(3, 'Phone Bill', 'earning', '2016-10-23 21:07:45', '2016-10-23 21:07:45'),
(4, 'Transport Bill', 'earning', '2016-10-23 21:08:16', '2016-10-23 21:08:16'),
(5, 'Provident Fund', 'deduction', '2016-10-23 21:08:31', '2016-10-23 21:08:31'),
(6, 'TAX', 'deduction', '2016-10-23 21:08:40', '2016-10-23 21:08:40'),
(7, 'Others', 'deduction', '2016-10-23 21:09:09', '2016-10-23 21:09:09'),
(8, 'CAR ALLOWANCE', 'earning', '2016-10-25 11:21:18', '2016-10-25 11:21:18'),
(9, 'Internet Bill', 'earning', '2020-02-24 10:01:33', '2020-02-24 10:01:33'),
(10, 'Con. Food', 'deduction', '2020-02-24 10:01:59', '2020-02-24 10:01:59');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `description` text,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'test section', 'ssss', '2024-11-10 07:28:25', '2024-11-10 13:04:38'),
(2, 'Clio Bell', 'Commodi accusamus an', '2024-11-10 12:28:51', '2024-11-10 12:28:51'),
(3, 'Clio Bell', 'Commodi accusamus an', '2024-11-10 12:30:17', '2024-11-10 12:30:17'),
(4, 'Marsden Armstrong', 'Nisi dolorem tempor ', '2024-11-10 12:33:19', '2024-11-10 12:33:19'),
(5, 'Marsden Armstrong', 'Nisi dolorem tempor ', '2024-11-10 12:33:27', '2024-11-10 12:33:27'),
(6, 'test supplyer', 'dd', '2024-11-10 12:33:43', '2024-11-11 04:09:21'),
(7, 'Brenden Walker', 'Occaecat aut libero ', '2024-11-10 12:34:19', '2024-11-10 12:34:19'),
(8, 'cc', 'cc', '2024-11-10 12:34:25', '2024-11-10 12:34:25'),
(9, 'Edan Frederick', 'Similique harum sit ', '2024-11-11 04:09:35', '2024-11-11 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `setup`
--

CREATE TABLE IF NOT EXISTS `setup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `completed` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `setup`
--

INSERT INTO `setup` (`id`, `module`, `completed`) VALUES
(1, 'installation', 1),
(2, 'general_configuration', 1),
(3, 'system_configuration', 1),
(4, 'menu', 1),
(5, 'role', 1),
(6, 'permission', 1),
(7, 'mail', 0),
(8, 'office_shift', 1),
(9, 'contract', 1),
(10, 'leave', 1),
(11, 'department', 1),
(12, 'designation', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE IF NOT EXISTS `supervisor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL DEFAULT '',
  `user_id` varchar(11) NOT NULL DEFAULT '',
  `add_by_id` varchar(11) NOT NULL DEFAULT '',
  `date` varchar(20) NOT NULL DEFAULT '',
  `time` varchar(20) NOT NULL DEFAULT '',
  `status` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`id`, `uid`, `user_id`, `add_by_id`, `date`, `time`, `status`) VALUES
(2, '5fc8c57a921ce', '1', '1', '2020-12-03', '05:01:14 pm', '0'),
(5, '620cce4346eaf', '3', '1', '2022-02-16', '04:13:23 pm', '0');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor_employee`
--

CREATE TABLE IF NOT EXISTS `supervisor_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(50) NOT NULL DEFAULT '',
  `supervisor_id` varchar(11) NOT NULL DEFAULT '',
  `user_id` varchar(11) NOT NULL DEFAULT '',
  `add_by_id` varchar(11) NOT NULL DEFAULT '',
  `date` varchar(20) NOT NULL DEFAULT '',
  `time` varchar(20) NOT NULL DEFAULT '',
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `supervisor_employee`
--

INSERT INTO `supervisor_employee` (`id`, `uid`, `supervisor_id`, `user_id`, `add_by_id`, `date`, `time`, `status`) VALUES
(3, '5fc8c589629b4', '2', '1', '1', '2020-12-03', '05:01:29 pm', 0),
(4, '5fc8c589786ee', '2', '5', '1', '2020-12-03', '05:01:29 pm', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `progress` int(11) DEFAULT '0',
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `start_date`, `due_date`, `progress`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Test', '<p>Test-1</p>', '2019-06-11', '2019-06-12', 20, 1, '2019-06-12 07:12:09', '2022-11-22 05:10:57'),
(2, 'Xw', '<p>QQA</p>', '2019-06-24', '2019-06-27', 0, 1, '2019-06-23 09:11:40', '2019-06-23 09:11:40'),
(3, 'LNK8I7BU6JHYGTRFWS', '<p>Marketing (Door to Door).</p>', '2019-06-25', '2019-06-30', 0, 1, '2019-06-24 07:06:40', '2019-06-24 07:06:40'),
(4, 'doing monthly reprot', '<p>test</p>', '2020-10-12', '2020-10-21', 90, 1, '2020-10-12 06:54:51', '2024-09-11 11:51:46'),
(5, 'test 102', '<p>test</p>\n\n<p><br /></p>\n\n<p>test</p>', '2022-03-07', '2022-03-10', 0, 1, '2022-03-07 08:25:27', '2022-03-07 08:25:27');

-- --------------------------------------------------------

--
-- Table structure for table `task_attachments`
--

CREATE TABLE IF NOT EXISTS `task_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `task_id` int(11) DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `attachments` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `task_comments`
--

CREATE TABLE IF NOT EXISTS `task_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `task_notes`
--

CREATE TABLE IF NOT EXISTS `task_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `task_user`
--

CREATE TABLE IF NOT EXISTS `task_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `task_id` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `task_user`
--

INSERT INTO `task_user` (`id`, `user_id`, `task_id`) VALUES
(1, 2, 1),
(2, 1, 2),
(3, 14, 3),
(4, 3, 4),
(6, 4, 4),
(7, 6, 4),
(8, 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_default` int(11) NOT NULL DEFAULT '0',
  `name` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` text COLLATE utf8_unicode_ci,
  `body` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `is_default`, `name`, `category`, `subject`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, 'Welcome Email', 'welcome_email', 'Welcome Email', '<p>Hi [NAME]</p>', '2018-02-14 19:47:39', '2019-06-24 08:07:22'),
(2, 1, 'Payslip Email', 'payslip_email', 'Payslip', '<p><br /></p>', '2018-02-14 19:47:39', '2019-06-24 08:07:31'),
(3, 0, 'test', 'employee', NULL, NULL, '2020-02-24 11:07:10', '2020-02-24 11:07:10'),
(4, 0, 'app letter', 'employee', NULL, NULL, '2023-06-12 11:46:03', '2023-06-12 11:46:03');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `subject` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `priority` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admin_remarks` text COLLATE utf8_unicode_ci,
  `closed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `subject`, `description`, `priority`, `status`, `admin_remarks`, `closed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'nng', 'fhgjgjhjhjhj', 'high', 'open', NULL, NULL, '2018-03-27 09:20:40', '2018-03-27 09:20:40'),
(2, 1, 'Tast-2', 'Ttttttt', 'high', 'open', NULL, NULL, '2019-06-12 07:12:56', '2019-06-12 07:12:56'),
(3, 1, 'h8edbgHBIBCOw', 'lbgjdwfuqtvsybnouqw', 'high', 'open', NULL, NULL, '2019-06-24 07:37:32', '2019-06-24 07:37:32');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_attachments`
--

CREATE TABLE IF NOT EXISTS `ticket_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `ticket_id` int(11) DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `attachments` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ticket_id` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_comments`
--

CREATE TABLE IF NOT EXISTS `ticket_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_notes`
--

CREATE TABLE IF NOT EXISTS `ticket_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_user`
--

CREATE TABLE IF NOT EXISTS `ticket_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ticket_id` (`ticket_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE IF NOT EXISTS `todos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `visibility` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `user_id`, `visibility`, `title`, `description`, `date`, `created_at`, `updated_at`) VALUES
(1, 14, 'public', 'KAJ', 'erfesyf5wv3s743d5', '2019-06-24', '2019-06-24 06:23:57', '2019-06-24 06:23:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `is_hidden` tinyint(4) NOT NULL DEFAULT '0',
  `first_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci DEFAULT 'active',
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login_now` timestamp NULL DEFAULT NULL,
  `last_login_ip_now` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `designation_id` (`designation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `is_hidden`, `first_name`, `last_name`, `designation_id`, `username`, `email`, `status`, `password`, `remember_token`, `auth_token`, `created_at`, `updated_at`, `last_login`, `last_login_ip`, `last_login_now`, `last_login_ip_now`) VALUES
(1, 1, 'HR', 'Admin', 1, 'admin', 'Sunjove@gmail.com', 'active', '$2y$10$jSAr/RwmjhwioDlJErOk9OQEO7huLz9O6Iuf/udyGbHPiTNuB3Iuy', 'T8IcCJokf7U3ixDloFhLa30qCNM2QZtQQZbRBcbPhibQye63p5LjA67kQ2Qd', 'ECVaSmbl3yoYWRhX4E0tynFGvUG5g5DAGy68JeA7', '2016-10-23 09:39:09', '2024-11-11 04:07:29', '2024-11-10 04:07:07', '127.0.0.1', '2024-11-11 04:07:29', '127.0.0.1'),
(2, 0, 'Abu Jafor', 'Khan', 2, 'Jafor', 'Jafor@gmail.com', 'active', '$2y$10$BhhqvfHJbsTqO05cD1N3FOFVAVKgI.3n2ZvnyPb3DgyrPefMqDGWq', 'jZYotpzZGGKl0aPGcLTuhzQXyCjA1oeU91d2yodgfYXvSSOot8oGrB9tf4fI', NULL, '2016-10-23 21:16:45', '2017-10-25 09:22:06', '2016-10-24 21:21:05', '45.113.237.162', '2017-10-25 09:21:20', '103.204.210.154'),
(3, 0, 'Iftakhar azmi ', 'Chowdhury', 2, 'azmi123', 'rony_aiub2010@yahoo.com', 'active', '$2y$10$5kjDaqkMzzW9oOomXCo7rOeEmhoq8lLyDvNcx2HEy1lEo3arwEz4.', 'NYO4un9EtSApI2WB7URgbU4a9ZJGKhySprlGgiUY2c7MQPFlaaztO7NF5Yh1', NULL, '2016-10-25 05:13:34', '2024-11-11 07:18:10', '2017-10-25 11:58:42', '103.204.210.154', '2020-10-12 07:00:58', '123.108.244.163'),
(4, 0, 'kazi', 'Muktadir', 6, 'kmdir', 'kmdir247@gmail.com', 'active', '$2y$10$WPDb.ScZiRNwCeGsJiPV5e7.VDIliJEq0JHn0VtZWrvn2pLHLXoE2', NULL, NULL, '2016-11-03 18:54:32', '2016-11-03 18:54:32', NULL, NULL, NULL, NULL),
(5, 0, 'Mizanur', 'Rahman', 2, 'Mizan', 'mizan@gmail.com', 'active', '$2y$10$Br7R5iW/ySjdMoPqsqJlx.Wm/gS1klaom8mWzAiJm8tMwUXC2F/my', NULL, NULL, '2016-11-04 05:22:17', '2016-11-04 05:22:17', NULL, NULL, NULL, NULL),
(6, 0, 'shahariar', 'yousuf', 7, 'shahariar', 'shahariar@nibizsoft.com', 'active', '$2y$10$QlrV5WeilqHhMRBaQhI4I.wpjCg9cH8cFcD41Pmt/7.No.pHvQEQy', 'rRxHQVuvIfRlEpDPbGlkZQ9eOGcF07ISrRbLnTZHgUFKBc8ywMBbpcLQupxf', NULL, '2017-05-22 11:04:39', '2024-11-11 07:47:35', NULL, NULL, '2024-08-14 10:57:41', '103.84.37.231'),
(7, 0, 'Safwan', 'Alamgir', 4, 'safwan', 'safwan.cse@gmail.com', 'active', '$2y$10$Re4ZYIzF41sTiB8qtxotoeTTVZSKkF8415SdR5ZAjW8lwSRO0.JBy', NULL, NULL, '2017-10-25 10:23:33', '2024-11-11 07:19:06', NULL, NULL, NULL, NULL),
(8, 0, 'Nazmul', 'hassn', 4, 'pinu1234', 'pinu.gp@gmail.com', 'active', '$2y$10$oqxAV0VttlV3r0A4nU/M8.2qI7ipFIG0Xd0D8U4/IxUJAWAAcLRtu', NULL, NULL, '2018-02-28 04:55:22', '2018-02-28 04:55:22', NULL, NULL, NULL, NULL),
(9, 0, 'Nazmul', 'hassn', 5, 'nazmul34', 'nazmul@nibizsoft.com', 'active', '$2y$10$UuDX5wGNXQs6Nb.dFqzNS.TcXf.8hu1y9oGnu9LNDL0ee5C/q5uoq', NULL, NULL, '2018-02-28 04:56:52', '2024-11-11 09:51:21', NULL, NULL, NULL, NULL),
(10, 0, 'nazma', 'aktr', 1, 'eeeee', 'mustakimkt@gmail.com', 'active', '$2y$10$3zIcSQyxnSlgkzRpev7lyOpio7LRpqM9CDtMeQJOuu7ggSBlqHnRK', NULL, NULL, '2018-03-27 09:39:27', '2018-03-27 09:39:27', NULL, NULL, NULL, NULL),
(11, 0, 'Nazmul', 'hasan khan', 5, 'pinu123', 'pinu.gp2018@gmail.com', 'active', '$2y$10$4STe15L0zN5ab9pzuO2Av.5rgvEO2ITEs3gT/sPyiTONq5/gmN7Ny', NULL, NULL, '2018-05-22 05:10:05', '2024-11-11 07:18:12', NULL, NULL, NULL, NULL),
(12, 0, 'Nabil', 'Ahmed', 5, 'nabil', 'info@nibizsoft.com', 'active', '$2y$10$th85LAsm67TswPWqGLDU0ulxoT0ddVsf.aNZegxW5JLo639SL7zrm', NULL, NULL, '2019-06-24 06:16:13', '2024-11-11 07:04:08', NULL, NULL, NULL, NULL),
(13, 0, 'Nabil', 'Ahmed', 6, 'nahid', 'nahid@nibizsoft.com', 'active', '$2y$10$a9iMl9b4x0YcOJAyYb/hi.KD6BsTDf8hyf43yuRUGKY32VQGUYjlG', NULL, NULL, '2019-06-24 06:17:04', '2024-11-11 07:22:15', NULL, NULL, NULL, NULL),
(14, 0, 'Christian', 'Savige', 5, 'Savige', 'hristiavigeo@nibizsoft.com', 'active', '$2y$10$MTJ38VD4wqix7mf83Aih/O7dYVltZ20HpU8ss94XbiU1cMC26Q9aW', 'wjvaQ4DNHJ3CgIFrPqhFVOcnPporix5RJOtoliy0wxHyaN5KjIoFgzvjbGHa', NULL, '2019-06-24 06:20:49', '2024-11-11 06:29:42', '2019-06-24 07:03:27', '61.247.177.245', '2019-06-24 11:09:06', '61.247.177.245'),
(15, 0, 'N', 'James', 5, 'admin1111', 'james@nibizsoft.com', 'active', '$2y$10$6sbWmKIwjhow0Z1Mm.SAJuY3AqMr0AKO.OwJrHIHdTjr9hErYEJAC', NULL, NULL, '2020-01-03 20:23:26', '2024-11-11 09:51:28', NULL, NULL, NULL, NULL),
(16, 0, 'Mobin', 'Sarwar', 6, 'mobin', 'mobin@nibizsoft.net', 'active', '$2y$10$thyihRFyG4ZPWvF4p31X0e6P8OcS5Ca6SlG6Uvh9sRSYSGYcwjRFy', NULL, NULL, '2021-08-24 05:35:25', '2021-08-24 05:35:25', NULL, NULL, NULL, NULL),
(17, 0, 'Mobin', 'Sarwar', 3, 'bappy', 'mobinsarwar@gmail.com', 'active', '$2y$10$kLjJWDz9Xp3nCOBv9RUuNunl7NLgBEW6gt8JejKfuTg8spUrNjcsa', 'lrpcfFjFCpi4HvTb1nJQ2EU1icHKYv1qvt1sjeulrAGpy4NmSnM565ZrdU7Y', NULL, '2021-08-24 05:37:19', '2024-11-11 07:48:22', '2022-03-07 08:36:27', '103.162.186.120', '2022-03-13 09:15:32', '45.248.148.87'),
(19, 0, 'Syed', 'Ali', 3, 'blspacer', 'blspacer@gmail.com', 'active', '$2y$10$QomKE3FapLG14QmAbq4j.OH5pyYI0YRXARsAisld8MoNWL/x6IgEC', NULL, NULL, '2024-01-31 07:12:14', '2024-11-11 08:59:08', NULL, NULL, NULL, NULL),
(20, 0, 'MD', 'RASEL', 7, 'rasel', 'mridhatradingcorporation2021@gmail.com', 'active', '$2y$10$F5LvPMlHMealN7xOKhiIauHCO2zPQ5q/jzxgVkYTsqQX23VKwJ0Dq', 'lp6G25ENc1xMxqqo6s1xH7uVbJUoH1nFaIEshsMdQRFhWAJJydvOdlR7vYCl', NULL, '2024-09-07 20:10:53', '2024-11-11 07:19:02', NULL, NULL, '2024-09-07 20:13:01', '103.137.1.8');

-- --------------------------------------------------------

--
-- Table structure for table `user_leaves`
--

CREATE TABLE IF NOT EXISTS `user_leaves` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_type_id` int(11) DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `leave_count` int(11) NOT NULL DEFAULT '0',
  `leave_used` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leave_type_id` (`leave_type_id`),
  KEY `contract_id` (`contract_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `user_leaves`
--

INSERT INTO `user_leaves` (`id`, `leave_type_id`, `contract_id`, `leave_count`, `leave_used`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 12, 0, '2016-10-23 21:40:34', '2017-10-25 09:17:05'),
(2, 2, 1, 12, 1, '2016-10-23 21:40:34', '2022-11-22 05:11:47'),
(3, 3, 1, 12, 1, '2016-10-23 21:40:34', '2017-10-25 09:23:02'),
(4, 1, 3, 20, 1, '2016-10-25 06:35:50', '2017-10-25 11:59:49'),
(5, 2, 3, 30, 2, '2016-10-25 06:35:50', '2017-10-25 11:59:49'),
(6, 3, 3, 40, 0, '2016-10-25 06:35:50', '2017-10-25 11:59:49'),
(7, 1, 4, 5, 0, '2019-06-24 06:53:22', '2019-06-24 06:53:22'),
(8, 2, 4, 5, 0, '2019-06-24 06:53:22', '2019-06-24 06:53:22'),
(9, 3, 4, 10, 0, '2019-06-24 06:53:22', '2019-06-24 06:53:22'),
(11, 1, 5, 12, 1, '2019-06-24 06:57:00', '2019-06-24 07:02:32'),
(12, 2, 5, 10, 0, '2019-06-24 06:57:00', '2019-06-24 06:57:00'),
(13, 3, 5, 15, 0, '2019-06-24 06:57:00', '2019-06-24 06:57:00'),
(15, 1, 6, 2, 0, '2020-02-24 10:12:21', '2020-02-24 10:12:21'),
(16, 2, 6, 5, 0, '2020-02-24 10:12:21', '2020-02-24 10:12:21'),
(17, 3, 6, 7, 0, '2020-02-24 10:12:21', '2020-02-24 10:12:21'),
(19, 1, 7, 5, 1, '2020-02-24 10:21:22', '2020-02-24 10:23:34'),
(20, 2, 7, 7, 5, '2020-02-24 10:21:22', '2021-08-23 06:36:02'),
(21, 3, 7, 7, 2, '2020-02-24 10:21:22', '2022-02-06 10:34:34'),
(22, 6, 7, 7, 2, '2020-02-24 10:21:22', '2021-05-19 08:39:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_shifts`
--

CREATE TABLE IF NOT EXISTS `user_shifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `office_shift_id` int(11) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `office_shift_id` (`office_shift_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_shifts`
--

INSERT INTO `user_shifts` (`id`, `user_id`, `office_shift_id`, `from_date`, `to_date`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2016-10-01', '2016-10-31', '2016-10-23 21:37:20', '2016-10-23 21:37:20'),
(2, 3, 1, '2016-10-01', '2016-10-31', '2016-10-25 06:24:28', '2016-10-25 06:24:28'),
(3, 7, 1, '2019-06-01', '2019-06-30', '2019-06-10 05:58:23', '2019-06-10 05:58:23'),
(4, 14, 1, '2019-06-24', '2019-06-25', '2019-06-24 06:57:18', '2019-06-24 06:57:18'),
(5, 3, 1, '2021-06-24', '2021-06-24', '2021-06-23 10:34:00', '2021-06-23 10:34:00'),
(6, 3, 2, '2021-06-25', '2021-06-25', '2021-06-23 10:34:11', '2021-06-23 10:34:11'),
(7, 17, 1, '2021-08-01', '2021-10-31', '2021-08-24 05:44:24', '2021-08-24 05:44:24'),
(8, 20, 1, '2024-09-08', '2024-09-08', '2024-09-07 20:16:50', '2024-09-07 20:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `work_experience`
--

CREATE TABLE IF NOT EXISTS `work_experience` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `department` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `experience_years` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `work_experience`
--

INSERT INTO `work_experience` (`id`, `user_id`, `company_name`, `start_date`, `end_date`, `department`, `role`, `experience_years`, `created_at`, `updated_at`) VALUES
(9, 19, 'Harmon and Avery Associates', '2012-11-26', '1986-03-18', 'Sed optio reiciendi', 'Ea sint mollitia as', 2018, '2024-11-11 12:32:19', '2024-11-11 12:32:19'),
(10, 19, 'Burnett and Frost Associates', '1994-05-24', '1996-10-12', 'Ut dolorem quia et n', 'Ipsum dignissimos au', 1983, '2024-11-11 12:32:19', '2024-11-11 12:32:19'),
(11, 19, 'Conway Burch Co', '2007-02-08', '1999-09-09', 'Aut reprehenderit l', 'Tempora odit perfere', 2015, '2024-11-11 12:32:19', '2024-11-11 12:32:19');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `announcement_designation`
--
ALTER TABLE `announcement_designation`
  ADD CONSTRAINT `announcement_designation_announcement_id_foreign` FOREIGN KEY (`announcement_id`) REFERENCES `announcements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `announcement_designation_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `awards`
--
ALTER TABLE `awards`
  ADD CONSTRAINT `awards_award_type_id_foreign` FOREIGN KEY (`award_type_id`) REFERENCES `award_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `awards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `award_user`
--
ALTER TABLE `award_user`
  ADD CONSTRAINT `award_user_award_id_foreign` FOREIGN KEY (`award_id`) REFERENCES `awards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `award_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `bank_accounts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clocks`
--
ALTER TABLE `clocks`
  ADD CONSTRAINT `clocks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clock_summaries`
--
ALTER TABLE `clock_summaries`
  ADD CONSTRAINT `clock_summaries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_contract_type_id_foreign` FOREIGN KEY (`contract_type_id`) REFERENCES `contract_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contracts_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contracts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `custom_field_values`
--
ALTER TABLE `custom_field_values`
  ADD CONSTRAINT `custom_field_values_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `custom_fields` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `designations_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `designations_top_designation_id_foreign` FOREIGN KEY (`top_designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_expense_head_id_foreign` FOREIGN KEY (`expense_head_id`) REFERENCES `expense_heads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expenses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD CONSTRAINT `job_applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_applications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leaves`
--
ALTER TABLE `leaves`
  ADD CONSTRAINT `leaves_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leaves_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_from_user_id_foreign` FOREIGN KEY (`from_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_reply_id_foreign` FOREIGN KEY (`reply_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_to_user_id_foreign` FOREIGN KEY (`to_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `office_shift_details`
--
ALTER TABLE `office_shift_details`
  ADD CONSTRAINT `office_shift_details_office_shift_id_foreign` FOREIGN KEY (`office_shift_id`) REFERENCES `office_shifts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `payroll_payroll_slip_id_foreign` FOREIGN KEY (`payroll_slip_id`) REFERENCES `payroll_slip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payroll_salary_type_id_foreign` FOREIGN KEY (`salary_type_id`) REFERENCES `salary_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payroll_slip`
--
ALTER TABLE `payroll_slip`
  ADD CONSTRAINT `payroll_slip_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `salary_contract_id_foreign` FOREIGN KEY (`contract_id`) REFERENCES `contracts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salary_salary_type_id_foreign` FOREIGN KEY (`salary_type_id`) REFERENCES `salary_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_attachments`
--
ALTER TABLE `task_attachments`
  ADD CONSTRAINT `task_attachments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_attachments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_comments`
--
ALTER TABLE `task_comments`
  ADD CONSTRAINT `task_comments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_notes`
--
ALTER TABLE `task_notes`
  ADD CONSTRAINT `task_notes_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `task_user`
--
ALTER TABLE `task_user`
  ADD CONSTRAINT `task_user_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_attachments`
--
ALTER TABLE `ticket_attachments`
  ADD CONSTRAINT `ticket_attachments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_attachments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_comments`
--
ALTER TABLE `ticket_comments`
  ADD CONSTRAINT `ticket_comments_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_notes`
--
ALTER TABLE `ticket_notes`
  ADD CONSTRAINT `ticket_notes_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ticket_user`
--
ALTER TABLE `ticket_user`
  ADD CONSTRAINT `ticket_user_ticket_id_foreign` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `todos`
--
ALTER TABLE `todos`
  ADD CONSTRAINT `todos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_designation_id_foreign` FOREIGN KEY (`designation_id`) REFERENCES `designations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_leaves`
--
ALTER TABLE `user_leaves`
  ADD CONSTRAINT `user_leaves_contract_id_foreign` FOREIGN KEY (`contract_id`) REFERENCES `contracts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_leaves_leave_type_id_foreign` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_shifts`
--
ALTER TABLE `user_shifts`
  ADD CONSTRAINT `user_shifts_office_shift_id_foreign` FOREIGN KEY (`office_shift_id`) REFERENCES `office_shifts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_shifts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
