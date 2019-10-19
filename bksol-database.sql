-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2019 at 06:34 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bksol`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_id`, `subject_type`, `causer_id`, `causer_type`, `properties`, `created_at`, `updated_at`) VALUES
(271669, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-08-30 12:04:39', '2019-08-30 12:04:39'),
(271670, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-08-30 12:04:46', '2019-08-30 12:04:46'),
(271671, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-09-05 09:59:48', '2019-09-05 09:59:48'),
(271672, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-09-05 09:59:52', '2019-09-05 09:59:52'),
(271673, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-09-23 08:18:18', '2019-09-23 08:18:18'),
(271674, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-09-23 08:18:26', '2019-09-23 08:18:26'),
(271675, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-09-23 13:27:16', '2019-09-23 13:27:16'),
(271676, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-09-23 13:27:50', '2019-09-23 13:27:50'),
(271677, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-09-23 13:27:56', '2019-09-23 13:27:56'),
(271678, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-09-23 13:37:24', '2019-09-23 13:37:24'),
(271679, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-09-23 13:38:05', '2019-09-23 13:38:05'),
(271680, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-09-23 13:38:09', '2019-09-23 13:38:09'),
(271681, 'default', 'created', 1, 'App\\Attendancesheet', NULL, NULL, '{\"attributes\":{\"checkin\":null,\"checkout\":null,\"status\":null,\"shortleaves\":0,\"tardies\":0,\"workedhours\":0,\"checkoutfound\":null,\"remarks\":\"SL - sick\",\"isupdated\":0,\"modifiedby\":null,\"updated_at\":\"2019-09-05 00:00:00\"}}', '2019-09-26 13:37:31', '2019-09-26 13:37:31'),
(271682, 'default', 'created', 2, 'App\\Attendancesheet', NULL, NULL, '{\"attributes\":{\"checkin\":null,\"checkout\":null,\"status\":null,\"shortleaves\":0,\"tardies\":0,\"workedhours\":0,\"checkoutfound\":null,\"remarks\":\"SL - sick\",\"isupdated\":0,\"modifiedby\":null,\"updated_at\":\"2019-09-05 00:00:00\"}}', '2019-09-26 13:40:51', '2019-09-26 13:40:51'),
(271683, 'default', 'created', 3, 'App\\Attendancesheet', NULL, NULL, '{\"attributes\":{\"checkin\":null,\"checkout\":null,\"status\":\"SL\",\"shortleaves\":0,\"tardies\":0,\"workedhours\":0,\"checkoutfound\":null,\"remarks\":\"SL - sick\",\"isupdated\":0,\"modifiedby\":null,\"updated_at\":\"2019-09-05 00:00:00\"}}', '2019-09-26 13:51:20', '2019-09-26 13:51:20'),
(271684, 'default', 'created', 4, 'App\\Attendancesheet', NULL, NULL, '{\"attributes\":{\"checkin\":null,\"checkout\":null,\"status\":\"SL\",\"shortleaves\":0,\"tardies\":0,\"workedhours\":0,\"checkoutfound\":null,\"remarks\":\"SL - sick\",\"isupdated\":0,\"modifiedby\":null,\"updated_at\":\"2019-09-05 00:00:00\"}}', '2019-09-26 14:21:25', '2019-09-26 14:21:25'),
(271685, 'default', 'created', 5, 'App\\Attendancesheet', NULL, NULL, '{\"attributes\":{\"checkin\":null,\"checkout\":null,\"status\":\"SL\",\"shortleaves\":0,\"tardies\":0,\"workedhours\":0,\"checkoutfound\":null,\"remarks\":\"SL - sick\",\"isupdated\":0,\"modifiedby\":null,\"updated_at\":\"2019-09-05 00:00:00\"}}', '2019-09-26 14:22:15', '2019-09-26 14:22:15'),
(271686, 'default', 'created', 6, 'App\\Attendancesheet', NULL, NULL, '{\"attributes\":{\"checkin\":null,\"checkout\":null,\"status\":\"UL\",\"shortleaves\":0,\"tardies\":0,\"workedhours\":0,\"checkoutfound\":null,\"remarks\":\"SL - sick\",\"isupdated\":0,\"modifiedby\":null,\"updated_at\":\"2019-09-05 00:00:00\"}}', '2019-09-26 14:23:16', '2019-09-26 14:23:16'),
(271687, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-01 10:09:11', '2019-10-01 10:09:11'),
(271688, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-01 10:09:20', '2019-10-01 10:09:20'),
(271689, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-02 04:46:30', '2019-10-02 04:46:30'),
(271690, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-02 04:46:43', '2019-10-02 04:46:43'),
(271691, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-02 07:52:24', '2019-10-02 07:52:24'),
(271692, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-02 07:52:28', '2019-10-02 07:52:28'),
(271693, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-04 04:02:49', '2019-10-04 04:02:49'),
(271694, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-04 04:03:39', '2019-10-04 04:03:39'),
(271695, 'default', 'updated', 807, 'App\\User', 1, 'App\\User', '{\"attributes\":{\"fname\":\"Nisar\",\"lname\":\"Ahmed\",\"email\":\"nisar081oo7@gmail.com\",\"updatedby\":1},\"old\":{\"fname\":\"Asfand\",\"lname\":\"yar\",\"email\":\"asfandyareng@gmail.com\",\"updatedby\":806}}', '2019-10-04 05:42:27', '2019-10-04 05:42:27'),
(271696, 'default', 'created', 1, 'App\\Staffdetail', 1, 'App\\User', '{\"attributes\":{\"user_id\":807,\"cstreetaddress\":null,\"cstreetaddress2\":null,\"ccity\":null,\"pstreetaddress\":null,\"pstreetaddress2\":null,\"pcity\":null,\"gaurdianname\":null,\"gaurdianrelation\":null,\"gaurdiancontact\":null,\"landline\":null,\"phonenumber\":null,\"bloodgroup\":null,\"dob\":null,\"cnic\":null,\"passportno\":null,\"attendanceid\":null,\"extension\":null,\"ccmsid\":null,\"skypeid\":null,\"shift\":null,\"latecomming\":null,\"attendancecheck\":1,\"endtime\":\"00:00:00\",\"starttime\":\"00:00:00\",\"created_at\":\"2019-10-04 10:42:27\",\"updated_at\":\"2019-10-04 10:42:27\",\"joiningdate\":null,\"fileno\":null}}', '2019-10-04 05:42:27', '2019-10-04 05:42:27'),
(271697, 'default', 'updated', 1, 'App\\Staffdetail', 1, 'App\\User', '{\"attributes\":{\"cstreetaddress\":\"No 121 NB Nazim abad Pindora\",\"ccity\":\"Rawalpindi\",\"pstreetaddress\":\"No 121 NB Nazim abad Pindora\",\"pcity\":\"Rawalpindi\",\"gaurdianname\":\"asdA\",\"gaurdianrelation\":\"ASDASD\",\"gaurdiancontact\":\"03075228959\",\"bloodgroup\":\"A\",\"dob\":\"1999-02-02 00:00:00\",\"cnic\":\"33333-3333333-3\",\"skypeid\":\"Nisar Ahmed\",\"shift\":\"day\",\"attendancecheck\":1,\"endtime\":\"10:42:00\",\"starttime\":\"10:42:00\",\"updated_at\":\"2019-10-04 00:00:00\",\"joiningdate\":\"2019-10-04 00:00:00\"},\"old\":{\"cstreetaddress\":null,\"ccity\":null,\"pstreetaddress\":null,\"pcity\":null,\"gaurdianname\":null,\"gaurdianrelation\":null,\"gaurdiancontact\":null,\"bloodgroup\":null,\"dob\":null,\"cnic\":null,\"skypeid\":null,\"shift\":null,\"attendancecheck\":null,\"endtime\":null,\"starttime\":null,\"updated_at\":\"2019-10-04 10:42:27\",\"joiningdate\":null}}', '2019-10-04 05:42:28', '2019-10-04 05:42:28'),
(271698, 'default', 'created', 7, 'App\\Attendancesheet', 1, 'App\\User', '{\"attributes\":{\"checkin\":\"00:00:10\",\"checkout\":\"00:00:10\",\"status\":\"P\",\"shortleaves\":0,\"tardies\":0,\"workedhours\":8,\"checkoutfound\":\"Yes\",\"remarks\":\"P\",\"isupdated\":1,\"modifiedby\":1,\"updated_at\":\"2019-10-04 10:44:28\"}}', '2019-10-04 05:44:28', '2019-10-04 05:44:28'),
(271699, 'default', 'updated', 807, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-04 05:52:26', '2019-10-04 05:52:26'),
(271700, 'default', 'updated', 1, 'App\\Staffdetail', 1, 'App\\User', '{\"attributes\":{\"updated_at\":\"2019-10-04 10:52:26\"},\"old\":{\"updated_at\":\"2019-10-04 00:00:00\"}}', '2019-10-04 05:52:26', '2019-10-04 05:52:26'),
(271701, 'default', 'updated', 807, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-04 06:33:48', '2019-10-04 06:33:48'),
(271702, 'default', 'updated', 1, 'App\\Staffdetail', 1, 'App\\User', '{\"attributes\":{\"updated_at\":\"2019-10-04 00:00:00\"},\"old\":{\"updated_at\":\"2019-10-04 10:52:26\"}}', '2019-10-04 06:33:49', '2019-10-04 06:33:49'),
(271703, 'default', 'updated', 807, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-04 09:31:37', '2019-10-04 09:31:37'),
(271704, 'default', 'updated', 1, 'App\\Staffdetail', 1, 'App\\User', '{\"attributes\":{\"updated_at\":\"2019-10-04 14:31:37\"},\"old\":{\"updated_at\":\"2019-10-04 00:00:00\"}}', '2019-10-04 09:31:38', '2019-10-04 09:31:38'),
(271705, 'default', 'updated', 807, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-04 09:31:44', '2019-10-04 09:31:44'),
(271706, 'default', 'updated', 1, 'App\\Staffdetail', 1, 'App\\User', '{\"attributes\":{\"updated_at\":\"2019-10-04 00:00:00\"},\"old\":{\"updated_at\":\"2019-10-04 14:31:37\"}}', '2019-10-04 09:31:45', '2019-10-04 09:31:45'),
(271707, 'default', 'created', 8, 'App\\Attendancesheet', 1, 'App\\User', '{\"attributes\":{\"checkin\":\"09:00:00\",\"checkout\":\"06:30:00\",\"status\":\"P\",\"shortleaves\":0,\"tardies\":0,\"workedhours\":8,\"checkoutfound\":\"Yes\",\"remarks\":\"P\",\"isupdated\":1,\"modifiedby\":1,\"updated_at\":\"2019-10-04 14:35:49\"}}', '2019-10-04 09:35:49', '2019-10-04 09:35:49'),
(271708, 'default', 'created', 1, 'App\\Salarysheet', 1, 'App\\User', '{\"attributes\":{\"user_id\":807,\"dated\":\"2019-10-01 00:00:00\",\"tardies\":0,\"shortleaves\":0,\"absents\":0,\"paidleaves\":0,\"unpaidleaves\":0,\"presents\":1,\"totaldays\":31,\"deductedays\":30,\"basicsalary\":999999.99,\"earnedsalary\":0,\"grosssalary\":999999.99,\"otherdeductions\":0,\"additions\":0,\"salarydeductions\":999999.99,\"perdaysalary\":33333.33,\"netsalary\":0,\"status\":\"Unpaid\",\"created_by\":1,\"modified_by\":1}}', '2019-10-04 09:47:37', '2019-10-04 09:47:37'),
(271709, 'default', 'created', 2, 'App\\Salarysheet', 1, 'App\\User', '{\"attributes\":{\"user_id\":807,\"dated\":\"2019-10-01 00:00:00\",\"tardies\":0,\"shortleaves\":0,\"absents\":0,\"paidleaves\":0,\"unpaidleaves\":0,\"presents\":1,\"totaldays\":31,\"deductedays\":30,\"basicsalary\":999999.99,\"earnedsalary\":0,\"grosssalary\":999999.99,\"otherdeductions\":0,\"additions\":0,\"salarydeductions\":999999.99,\"perdaysalary\":33333.33,\"netsalary\":0,\"status\":\"Unpaid\",\"created_by\":1,\"modified_by\":1}}', '2019-10-04 09:47:41', '2019-10-04 09:47:41'),
(271710, 'default', 'created', 3, 'App\\Salarysheet', 1, 'App\\User', '{\"attributes\":{\"user_id\":807,\"dated\":\"2019-10-01 00:00:00\",\"tardies\":0,\"shortleaves\":0,\"absents\":0,\"paidleaves\":0,\"unpaidleaves\":0,\"presents\":1,\"totaldays\":31,\"deductedays\":30,\"basicsalary\":999999.99,\"earnedsalary\":0,\"grosssalary\":999999.99,\"otherdeductions\":0,\"additions\":0,\"salarydeductions\":999999.99,\"perdaysalary\":33333.33,\"netsalary\":0,\"status\":\"Unpaid\",\"created_by\":1,\"modified_by\":1}}', '2019-10-04 09:47:43', '2019-10-04 09:47:43'),
(271711, 'default', 'created', 4, 'App\\Salarysheet', 1, 'App\\User', '{\"attributes\":{\"user_id\":807,\"dated\":\"2019-10-01 00:00:00\",\"tardies\":0,\"shortleaves\":0,\"absents\":0,\"paidleaves\":0,\"unpaidleaves\":0,\"presents\":1,\"totaldays\":31,\"deductedays\":30,\"basicsalary\":999999.99,\"earnedsalary\":0,\"grosssalary\":999999.99,\"otherdeductions\":0,\"additions\":0,\"salarydeductions\":999999.99,\"perdaysalary\":33333.33,\"netsalary\":0,\"status\":\"Unpaid\",\"created_by\":1,\"modified_by\":1}}', '2019-10-04 09:47:51', '2019-10-04 09:47:51'),
(271712, 'default', 'created', 5, 'App\\Salarysheet', 1, 'App\\User', '{\"attributes\":{\"user_id\":807,\"dated\":\"2019-10-01 00:00:00\",\"tardies\":0,\"shortleaves\":0,\"absents\":0,\"paidleaves\":0,\"unpaidleaves\":0,\"presents\":1,\"totaldays\":31,\"deductedays\":30,\"basicsalary\":999999.99,\"earnedsalary\":0,\"grosssalary\":999999.99,\"otherdeductions\":0,\"additions\":0,\"salarydeductions\":999999.99,\"perdaysalary\":33333.33,\"netsalary\":0,\"status\":\"Unpaid\",\"created_by\":1,\"modified_by\":1}}', '2019-10-04 09:47:51', '2019-10-04 09:47:51'),
(271713, 'default', 'created', 6, 'App\\Salarysheet', 1, 'App\\User', '{\"attributes\":{\"user_id\":807,\"dated\":\"2019-10-01 00:00:00\",\"tardies\":0,\"shortleaves\":0,\"absents\":0,\"paidleaves\":0,\"unpaidleaves\":0,\"presents\":1,\"totaldays\":31,\"deductedays\":30,\"basicsalary\":999999.99,\"earnedsalary\":0,\"grosssalary\":999999.99,\"otherdeductions\":0,\"additions\":0,\"salarydeductions\":999999.99,\"perdaysalary\":33333.33,\"netsalary\":0,\"status\":\"Unpaid\",\"created_by\":1,\"modified_by\":1}}', '2019-10-04 09:47:52', '2019-10-04 09:47:52'),
(271714, 'default', 'created', 7, 'App\\Salarysheet', 1, 'App\\User', '{\"attributes\":{\"user_id\":807,\"dated\":\"2019-10-01 00:00:00\",\"tardies\":0,\"shortleaves\":0,\"absents\":0,\"paidleaves\":0,\"unpaidleaves\":0,\"presents\":1,\"totaldays\":31,\"deductedays\":30,\"basicsalary\":999999.99,\"earnedsalary\":0,\"grosssalary\":999999.99,\"otherdeductions\":0,\"additions\":0,\"salarydeductions\":999999.99,\"perdaysalary\":33333.33,\"netsalary\":0,\"status\":\"Unpaid\",\"created_by\":1,\"modified_by\":1}}', '2019-10-04 09:47:52', '2019-10-04 09:47:52'),
(271715, 'default', 'created', 9, 'App\\Attendancesheet', 1, 'App\\User', '{\"attributes\":{\"checkin\":\"10:10:00\",\"checkout\":\"10:10:00\",\"status\":\"P\",\"shortleaves\":0,\"tardies\":0,\"workedhours\":0,\"checkoutfound\":\"Yes\",\"remarks\":\"P\",\"isupdated\":1,\"modifiedby\":1,\"updated_at\":\"2019-10-04 14:53:58\"}}', '2019-10-04 09:53:58', '2019-10-04 09:53:58'),
(271716, 'default', 'created', 10, 'App\\Attendancesheet', 1, 'App\\User', '{\"attributes\":{\"checkin\":\"10:10:00\",\"checkout\":\"10:10:00\",\"status\":\"P\",\"shortleaves\":0,\"tardies\":0,\"workedhours\":0,\"checkoutfound\":\"Yes\",\"remarks\":\"P\",\"isupdated\":1,\"modifiedby\":1,\"updated_at\":\"2019-10-04 14:54:33\"}}', '2019-10-04 09:54:33', '2019-10-04 09:54:33'),
(271717, 'default', 'created', 8, 'App\\Salarysheet', 1, 'App\\User', '{\"attributes\":{\"user_id\":807,\"dated\":\"2019-10-01 00:00:00\",\"tardies\":0,\"shortleaves\":0,\"absents\":0,\"paidleaves\":0,\"unpaidleaves\":0,\"presents\":1,\"totaldays\":31,\"deductedays\":30,\"basicsalary\":999999.99,\"earnedsalary\":0,\"grosssalary\":999999.99,\"otherdeductions\":0,\"additions\":0,\"salarydeductions\":999999.99,\"perdaysalary\":33333.33,\"netsalary\":0,\"status\":\"Unpaid\",\"created_by\":1,\"modified_by\":1}}', '2019-10-04 09:55:00', '2019-10-04 09:55:00'),
(271718, 'default', 'updated', 807, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-04 10:21:23', '2019-10-04 10:21:23'),
(271719, 'default', 'updated', 1, 'App\\Staffdetail', 1, 'App\\User', '{\"attributes\":{\"updated_at\":\"2019-10-04 15:21:23\"},\"old\":{\"updated_at\":\"2019-10-04 00:00:00\"}}', '2019-10-04 10:21:23', '2019-10-04 10:21:23'),
(271720, 'default', 'created', 11, 'App\\Attendancesheet', 1, 'App\\User', '{\"attributes\":{\"checkin\":\"10:10:00\",\"checkout\":\"20:20:00\",\"status\":\"P\",\"shortleaves\":0,\"tardies\":0,\"workedhours\":0,\"checkoutfound\":\"Yes\",\"remarks\":\"0\",\"isupdated\":1,\"modifiedby\":1,\"updated_at\":\"2019-10-04 15:22:25\"}}', '2019-10-04 10:22:25', '2019-10-04 10:22:25'),
(271721, 'default', 'created', 9, 'App\\Salarysheet', 1, 'App\\User', '{\"attributes\":{\"user_id\":807,\"dated\":\"2019-10-01 00:00:00\",\"tardies\":0,\"shortleaves\":0,\"absents\":0,\"paidleaves\":0,\"unpaidleaves\":0,\"presents\":1,\"totaldays\":31,\"deductedays\":30,\"basicsalary\":24999.99,\"earnedsalary\":0,\"grosssalary\":24999.99,\"otherdeductions\":0,\"additions\":0,\"salarydeductions\":24999.99,\"perdaysalary\":833.33,\"netsalary\":0,\"status\":\"Unpaid\",\"created_by\":1,\"modified_by\":1}}', '2019-10-04 10:22:55', '2019-10-04 10:22:55'),
(271722, 'default', 'created', 12, 'App\\Attendancesheet', 1, 'App\\User', '{\"attributes\":{\"checkin\":\"08:30:00\",\"checkout\":\"06:30:00\",\"status\":\"P\",\"shortleaves\":0,\"tardies\":0,\"workedhours\":9,\"checkoutfound\":\"Yes\",\"remarks\":\"P\",\"isupdated\":1,\"modifiedby\":1,\"updated_at\":\"2019-10-04 15:25:04\"}}', '2019-10-04 10:25:04', '2019-10-04 10:25:04'),
(271723, 'default', 'created', 10, 'App\\Salarysheet', 1, 'App\\User', '{\"attributes\":{\"user_id\":807,\"dated\":\"2019-10-01 00:00:00\",\"tardies\":0,\"shortleaves\":0,\"absents\":0,\"paidleaves\":0,\"unpaidleaves\":0,\"presents\":2,\"totaldays\":31,\"deductedays\":29,\"basicsalary\":24999.99,\"earnedsalary\":0,\"grosssalary\":24999.99,\"otherdeductions\":0,\"additions\":0,\"salarydeductions\":24166.66,\"perdaysalary\":833.33,\"netsalary\":833.33,\"status\":\"Unpaid\",\"created_by\":1,\"modified_by\":1}}', '2019-10-04 10:25:47', '2019-10-04 10:25:47'),
(271724, 'default', 'created', 13, 'App\\Attendancesheet', 1, 'App\\User', '{\"attributes\":{\"checkin\":\"10:10:00\",\"checkout\":\"10:10:00\",\"status\":\"P\",\"shortleaves\":0,\"tardies\":0,\"workedhours\":8,\"checkoutfound\":\"Yes\",\"remarks\":\"P\",\"isupdated\":1,\"modifiedby\":1,\"updated_at\":\"2019-10-04 16:00:39\"}}', '2019-10-04 11:00:39', '2019-10-04 11:00:39'),
(271725, 'default', 'created', 14, 'App\\Attendancesheet', 1, 'App\\User', '{\"attributes\":{\"checkin\":\"10:10:00\",\"checkout\":\"10:10:00\",\"status\":\"P\",\"shortleaves\":0,\"tardies\":0,\"workedhours\":8,\"checkoutfound\":\"Yes\",\"remarks\":\"p\",\"isupdated\":1,\"modifiedby\":1,\"updated_at\":\"2019-10-04 16:14:17\"}}', '2019-10-04 11:14:17', '2019-10-04 11:14:17'),
(271726, 'default', 'updated', 807, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-04 11:26:09', '2019-10-04 11:26:09'),
(271727, 'default', 'updated', 1, 'App\\Staffdetail', 1, 'App\\User', '{\"attributes\":{\"updated_at\":\"2019-10-04 00:00:00\"},\"old\":{\"updated_at\":\"2019-10-04 15:21:23\"}}', '2019-10-04 11:26:09', '2019-10-04 11:26:09'),
(271728, 'default', 'updated', 807, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-04 12:19:16', '2019-10-04 12:19:16'),
(271729, 'default', 'updated', 1, 'App\\Staffdetail', 1, 'App\\User', '{\"attributes\":{\"cnic\":null,\"updated_at\":\"2019-10-04 17:19:16\"},\"old\":{\"cnic\":\"33333-3333333-3\",\"updated_at\":\"2019-10-04 00:00:00\"}}', '2019-10-04 12:19:16', '2019-10-04 12:19:16'),
(271730, 'default', 'created', 11, 'App\\Salarysheet', 1, 'App\\User', '{\"attributes\":{\"user_id\":807,\"dated\":\"2019-10-01 00:00:00\",\"tardies\":0,\"shortleaves\":0,\"absents\":0,\"paidleaves\":0,\"unpaidleaves\":0,\"presents\":2,\"totaldays\":31,\"deductedays\":29,\"basicsalary\":29.99,\"earnedsalary\":0,\"grosssalary\":29.99,\"otherdeductions\":0,\"additions\":0,\"salarydeductions\":28.99,\"perdaysalary\":1,\"netsalary\":1,\"status\":\"Unpaid\",\"created_by\":1,\"modified_by\":1}}', '2019-10-04 13:00:03', '2019-10-04 13:00:03'),
(271731, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-05 04:16:52', '2019-10-05 04:16:52'),
(271732, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-05 04:16:59', '2019-10-05 04:16:59'),
(271733, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-05 10:40:15', '2019-10-05 10:40:15'),
(271734, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-05 10:40:37', '2019-10-05 10:40:37'),
(271735, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-05 10:56:01', '2019-10-05 10:56:01'),
(271736, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-05 10:56:31', '2019-10-05 10:56:31'),
(271737, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-05 10:57:11', '2019-10-05 10:57:11'),
(271738, 'default', 'updated', 808, 'App\\User', 1, 'App\\User', '{\"attributes\":{\"status\":2},\"old\":{\"status\":1}}', '2019-10-05 11:25:59', '2019-10-05 11:25:59'),
(271739, 'default', 'created', 15, 'App\\Attendancesheet', 1, 'App\\User', '{\"attributes\":{\"checkin\":\"00:00:10\",\"checkout\":\"00:00:10\",\"status\":\"P\",\"shortleaves\":10,\"tardies\":0,\"workedhours\":0,\"checkoutfound\":\"Yes\",\"remarks\":\"P\",\"isupdated\":1,\"modifiedby\":1,\"updated_at\":\"2019-10-05 16:36:21\"}}', '2019-10-05 11:36:21', '2019-10-05 11:36:21'),
(271740, 'default', 'created', 16, 'App\\Attendancesheet', 1, 'App\\User', '{\"attributes\":{\"checkin\":\"00:00:10\",\"checkout\":\"00:00:10\",\"status\":\"P\",\"shortleaves\":0,\"tardies\":0,\"workedhours\":8,\"checkoutfound\":\"Yes\",\"remarks\":\"p\",\"isupdated\":1,\"modifiedby\":1,\"updated_at\":\"2019-10-05 16:36:57\"}}', '2019-10-05 11:36:57', '2019-10-05 11:36:57'),
(271741, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-07 09:26:30', '2019-10-07 09:26:30'),
(271742, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-07 09:30:25', '2019-10-07 09:30:25'),
(271743, 'default', 'created', 809, 'App\\User', 1, 'App\\User', '{\"attributes\":{\"fname\":\"Nisar\",\"lname\":\"Ahmed\",\"email\":\"nisar081oo74543545@gmail.com\",\"avatar\":null,\"status\":1,\"isGoOnAppoints\":0,\"role_id\":null,\"designation_id\":null,\"department_id\":null,\"createdby\":null,\"updatedby\":null}}', '2019-10-07 12:26:39', '2019-10-07 12:26:39'),
(271744, 'default', 'created', 810, 'App\\User', 1, 'App\\User', '{\"attributes\":{\"fname\":\"Nisar\",\"lname\":\"Ahmed\",\"email\":\"nisar081oo745434545545@gmail.com\",\"avatar\":null,\"status\":1,\"isGoOnAppoints\":0,\"role_id\":null,\"designation_id\":null,\"department_id\":null,\"createdby\":null,\"updatedby\":null}}', '2019-10-07 12:27:43', '2019-10-07 12:27:43'),
(271745, 'default', 'created', 811, 'App\\User', 1, 'App\\User', '{\"attributes\":{\"fname\":\"Nisar\",\"lname\":\"Ahmed\",\"email\":\"nisar081oo4545354357@gmail.com\",\"avatar\":null,\"status\":1,\"isGoOnAppoints\":0,\"role_id\":null,\"designation_id\":null,\"department_id\":null,\"createdby\":null,\"updatedby\":null}}', '2019-10-07 12:56:59', '2019-10-07 12:56:59'),
(271746, 'default', 'created', 812, 'App\\User', 1, 'App\\User', '{\"attributes\":{\"fname\":\"Nisar\",\"lname\":\"Ahmed\",\"email\":\"nisar081fghfg5656oo7@gmail.com\",\"avatar\":null,\"status\":1,\"isGoOnAppoints\":0,\"role_id\":null,\"designation_id\":null,\"department_id\":null,\"createdby\":null,\"updatedby\":null}}', '2019-10-07 13:01:05', '2019-10-07 13:01:05'),
(271747, 'default', 'created', 813, 'App\\User', 1, 'App\\User', '{\"attributes\":{\"fname\":\"Nisar\",\"lname\":\"Ahmed\",\"email\":\"nisar081o234234234o7@gmail.com\",\"avatar\":null,\"status\":1,\"isGoOnAppoints\":0,\"role_id\":null,\"designation_id\":null,\"department_id\":null,\"createdby\":null,\"updatedby\":null}}', '2019-10-07 13:02:33', '2019-10-07 13:02:33'),
(271748, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-08 03:58:25', '2019-10-08 03:58:25'),
(271749, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-08 03:58:34', '2019-10-08 03:58:34'),
(271750, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-09 03:57:47', '2019-10-09 03:57:47'),
(271751, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-09 03:57:55', '2019-10-09 03:57:55'),
(271752, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-10 04:21:44', '2019-10-10 04:21:44'),
(271753, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-10 04:21:54', '2019-10-10 04:21:54'),
(271754, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-11 04:24:57', '2019-10-11 04:24:57'),
(271755, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-11 04:25:39', '2019-10-11 04:25:39'),
(271756, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-12 04:29:41', '2019-10-12 04:29:41'),
(271757, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-12 04:29:45', '2019-10-12 04:29:45'),
(271758, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-14 04:35:32', '2019-10-14 04:35:32'),
(271759, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-14 06:04:18', '2019-10-14 06:04:18'),
(271760, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-15 05:40:48', '2019-10-15 05:40:48'),
(271761, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-15 05:40:53', '2019-10-15 05:40:53'),
(271762, 'default', 'created', 814, 'App\\User', 1, 'App\\User', '{\"attributes\":{\"fname\":\"Nisar\",\"lname\":\"Ahmed\",\"email\":\"nisar081oo7@gmail.com\",\"avatar\":null,\"status\":1,\"isGoOnAppoints\":0,\"role_id\":null,\"designation_id\":null,\"department_id\":null,\"createdby\":null,\"updatedby\":null}}', '2019-10-15 11:00:39', '2019-10-15 11:00:39'),
(271763, 'default', 'updated', 1, 'App\\User', 1, 'App\\User', '{\"attributes\":[],\"old\":[]}', '2019-10-16 04:45:33', '2019-10-16 04:45:33');

-- --------------------------------------------------------

--
-- Table structure for table `addressbooks`
--

CREATE TABLE `addressbooks` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `type` int(11) NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adjustments`
--

CREATE TABLE `adjustments` (
  `id` int(10) UNSIGNED NOT NULL,
  `dated` date NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `amount` double(8,2) DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved_by` int(10) DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `adminmenus`
--

CREATE TABLE `adminmenus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menutitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parentid` int(10) UNSIGNED DEFAULT NULL,
  `showinnav` tinyint(1) DEFAULT NULL,
  `setasdefault` tinyint(1) DEFAULT NULL,
  `iconclass` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `urllink` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `displayorder` int(11) DEFAULT NULL,
  `mselect` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `adminmenus`
--

INSERT INTO `adminmenus` (`id`, `menutitle`, `slug`, `parentid`, `showinnav`, `setasdefault`, `iconclass`, `urllink`, `displayorder`, `mselect`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 'dashboard', NULL, 1, 1, 'fa fa-dashboard', '/dashboard', 0, 'dashboard', 2, '2018-08-09 19:00:00', '2019-10-01 19:00:00'),
(2, 'Staff', 'main-admins', NULL, 1, 1, 'fa fa-users', '#', 1, 'admins, admins.edit, admins.create, admins.show, resetpassword,', 1, '2018-08-09 19:00:00', '2018-12-21 00:00:00'),
(3, 'Roles', 'roles-index', 5, 1, 1, NULL, '/roles', 0, 'roles, roles.edit, roles.create', 1, '2018-08-09 19:00:00', '2018-12-20 00:00:00'),
(4, 'Manage Staff', 'admins-index', 2, 1, 1, NULL, '/admins', 1, 'admins, admins.edit, admins.create, admins.show, resetpassword', 1, '2018-08-09 19:00:00', '2018-12-20 00:00:00'),
(5, 'Settings', 'settings', NULL, 1, 1, 'fa fa-gear', '#', 15, 'menu, menu.edit, menu.create,roles, roles.edit, roles.create, preferences, holidays, designations, departments, roles', 1, '2018-08-09 19:00:00', '2019-01-10 08:08:15'),
(6, 'Manage Menu', 'menu-index', 5, 1, 1, NULL, '/menu', 0, 'menu, menu.edit,, menu.create', 1, '2018-08-09 19:00:00', '2018-08-10 11:47:49'),
(7, 'Customers', 'customers', NULL, 1, 1, 'fa fa-users', '#', 3, 'customers, customers.edit, customers.create, customers.show, customer.resetpassword,leads,leads.edit,leads.create,createrecording,leads.show', 1, '2018-08-12 19:00:00', '2018-08-12 19:00:00'),
(8, 'Manage Customers', 'customers-index', 7, 1, 1, 'fa fa-users', '/customers', 0, 'customers, customers.edit, customers.create, customers.show, customer.resetpassword', 1, '2018-08-12 19:00:00', '2018-08-12 19:00:00'),
(9, 'Leads', 'leads-index', 7, 1, 1, NULL, '/leads', 1, 'leads,leads.edit,leads.create,createrecordingleads.show', 1, '2018-08-12 19:00:00', '2018-08-13 11:37:35'),
(10, 'Projects', 'projects', NULL, 1, 1, 'fa fa-object-group', '#', 1, 'projects, projects.index, projects.create', 1, '2018-08-27 19:00:00', '2018-08-27 19:00:00'),
(11, 'Manage Projects', 'projects-index', 10, 1, 1, NULL, 'projects', 0, 'projects,projects.index,projects.create', 1, '2018-08-27 19:00:00', '2018-08-27 19:00:00'),
(12, 'Add Lead', 'create-lead', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-18 19:00:00', '2018-09-19 04:49:42'),
(13, 'Edit Lead', 'edit-lead', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-18 19:00:00', '2018-09-18 19:00:00'),
(14, 'Change Lead Status', 'status-lead', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-18 19:00:00', '2018-09-18 19:00:00'),
(15, 'Lead Detail', 'show-lead', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-18 19:00:00', '2018-09-18 19:00:00'),
(16, 'Delete Lead', 'delete-lead', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-18 19:00:00', '2018-09-18 19:00:00'),
(18, 'Search Leads', 'search-leads', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-19 19:00:00', '2018-09-19 19:00:00'),
(20, 'Show All Leads', 'show-all-leads', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-19 19:00:00', '2018-09-19 19:00:00'),
(21, 'Upload Recording', 'create-recording', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-19 19:00:00', '2018-09-19 19:00:00'),
(22, 'Schedule Appointment', 'create-appointment', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-19 19:00:00', '2018-09-19 19:00:00'),
(23, 'Upload Document', 'create-doc', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-19 19:00:00', '2018-09-19 19:00:00'),
(24, 'Request Proposal', 'create-proposal', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-19 19:00:00', '2018-09-20 19:00:00'),
(25, 'Add Project', 'create-project', 10, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-19 19:00:00', '2018-09-19 19:00:00'),
(26, 'Upload Proposal', 'upload-proposal', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-20 19:00:00', '2018-09-20 19:00:00'),
(27, 'Edit Proposal', 'edit-proposal', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-20 19:00:00', '2018-09-20 19:00:00'),
(28, 'Add Staff', 'create-staff', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 19:00:00', '2018-09-21 19:00:00'),
(29, 'Staff Details', 'show-staff', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 19:00:00', '2018-09-22 03:10:17'),
(30, 'Edit Staff', 'edit-staff', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 19:00:00', '2018-09-21 19:00:00'),
(31, 'Change Staff Status', 'status-staff', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 19:00:00', '2018-09-21 19:00:00'),
(32, 'Delete Staff', 'delete-staff', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 19:00:00', '2018-09-21 19:00:00'),
(33, 'Staff Reset Password', 'staff-reset-password', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 19:00:00', '2018-09-21 19:00:00'),
(34, 'Add Customer', 'create-customer', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 19:00:00', '2018-09-21 19:00:00'),
(35, 'View Customer', 'show-customer', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 19:00:00', '2018-09-21 19:00:00'),
(36, 'Edit Customer', 'edit-customer', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 19:00:00', '2018-09-21 19:00:00'),
(37, 'Change Customer Status', 'status-customer', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 19:00:00', '2018-09-21 19:00:00'),
(38, 'Delete Customer', 'delete-customer', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 19:00:00', '2018-09-21 19:00:00'),
(39, 'Customer Reset Password', 'reset-customer-password', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 19:00:00', '2018-09-21 19:00:00'),
(40, 'Approve/Reject Lead', 'approve-reject-lead', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-21 19:00:00', '2018-09-21 19:00:00'),
(41, 'Show for Training Lead', 'for-training-lead', 7, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-23 19:00:00', '2018-09-24 05:31:26'),
(42, 'Training', 'training', NULL, 1, 1, 'fa fa-tv', '#', 0, 'training,chapters,topics', 1, '2018-09-23 19:00:00', '2018-09-23 19:00:00'),
(43, 'Manage Chapters', 'chapters-index', 42, 1, 1, NULL, 'chapters', 0, 'chapters', 1, '2018-09-23 19:00:00', '2018-09-23 19:00:00'),
(44, 'Topics', 'topics', 42, 1, 1, NULL, 'topics', 0, 'topics', 1, '2018-09-23 19:00:00', '2018-09-23 19:00:00'),
(45, 'View Stats Number', 'stats-number', 1, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-26 19:00:00', '2018-09-26 19:00:00'),
(46, 'Last 10 Days Lead Chart', 'lead-chart-10', 1, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-26 19:00:00', '2018-09-26 19:00:00'),
(47, 'Last 10 days Appointment Chart', 'appointment-chart-10', 1, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-26 19:00:00', '2018-09-26 19:00:00'),
(48, 'Today Appointments', 'today-appointments', 1, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-26 19:00:00', '2018-09-26 19:00:00'),
(49, 'Latest Appointments', 'latest-appointments', 1, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-26 19:00:00', '2018-09-26 19:00:00'),
(50, 'Latest Leads', 'latest-leads', 1, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-26 19:00:00', '2018-09-26 19:00:00'),
(51, 'Latest Recordings', 'latest-recordings', 1, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-26 19:00:00', '2018-09-26 19:00:00'),
(52, 'Pending Proposal', 'pending-proposal', 1, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-26 19:00:00', '2018-09-26 19:00:00'),
(53, 'Show Dashboard Calendar', 'show-dashboard-calendar', 1, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-09-26 19:00:00', '2018-09-26 19:00:00'),
(54, 'Bksol Leads', 'yccleads', NULL, 1, NULL, 'fa fa-th', '#', 6, 'yccleads,', 1, '2018-11-04 19:00:00', '2019-10-03 19:00:00'),
(55, 'Manage Bksol Leads', 'index-yccleads', 54, 1, NULL, NULL, 'yccleads', 0, 'yccleads', 1, '2018-11-04 19:00:00', '2019-10-04 19:00:00'),
(56, 'Customer Projects', 'customer/projects', NULL, 1, NULL, 'fa fa-users', 'customer/projects', 2, 'customer/projects', 1, '2018-11-25 19:00:00', '2018-11-26 00:43:11'),
(57, 'Customer Project Index', 'customer-projects-index', 56, NULL, NULL, NULL, 'customer.projects.index', 0, 'customer.projects.index', 1, '2018-11-25 19:00:00', '2018-11-25 19:00:00'),
(58, 'Customer Fetch Projects', 'customer-fetch-projects', 56, NULL, NULL, NULL, 'customer.fetch.projects', 0, 'customer.fetch.projects', 1, '2018-11-25 19:00:00', '2018-11-25 19:00:00'),
(59, 'Tasks', 'mytask', NULL, 1, 1, 'fa fa-tv', 'mytask', 6, NULL, 1, '2018-11-26 19:00:00', '2018-11-27 00:21:32'),
(60, 'My Task', 'mytask-index', 59, 1, NULL, NULL, 'mytask', 0, 'mytask.index', 1, '2018-11-26 19:00:00', '2018-11-27 01:48:50'),
(61, 'My Task Fetch', 'mytask-fetch', 59, NULL, NULL, NULL, 'mytask.fetch', 0, 'mytask.fetch', 1, '2018-11-26 19:00:00', '2018-11-26 19:00:00'),
(62, 'Today Massages/Task', 'todayMassage-index', 59, 1, NULL, NULL, 'todayMassage', 0, 'todayMassage.index', 1, '2018-11-26 19:00:00', '2018-11-26 19:00:00'),
(63, 'Today Message/Task Fetch', 'todayMassage-fetch', 59, NULL, NULL, NULL, 'todayMassage.fetch', 0, 'todayMassage.fetch', 1, '2018-11-26 19:00:00', '2018-11-27 04:20:28'),
(64, 'Finance', 'finance', NULL, 1, 1, 'fa fa-money', 'finance', 9, 'finance', 1, '2018-12-12 19:00:00', '2019-10-04 09:48:27'),
(65, 'Budget Categories', 'budgetCategory-index', 64, 1, NULL, NULL, 'budgetCategory', 0, 'budgetCategory.index', 1, '2018-12-12 19:00:00', '2018-12-12 19:00:00'),
(66, 'Budget Categories Fetch', 'budgetCategory-fetch', 64, NULL, NULL, NULL, 'budgetCategory.fetch', 0, 'budgetCategory.fetch', 1, '2018-12-12 19:00:00', '2018-12-12 19:00:00'),
(67, 'Budget Categories Store', 'budgetCategory-store', 64, NULL, NULL, NULL, 'budgetCategory.store', 0, 'budgetCategory.store', 1, '2018-12-13 19:00:00', '2018-12-14 01:21:48'),
(68, 'Budget Categories Edit', 'budgetCategory-edit', 64, NULL, NULL, NULL, 'budgetCategory.edit', 0, 'budgetCategory.edit', 1, '2018-12-13 19:00:00', '2018-12-13 19:00:00'),
(69, 'Manage Banks', 'bank', 64, 1, NULL, NULL, 'bank', 2, 'bank', 1, '2018-12-13 19:00:00', '2018-12-13 19:00:00'),
(70, 'Manage Banks Index', 'bank-index', 64, NULL, NULL, NULL, 'bank.index', 0, 'bank-index', 1, '2018-12-13 19:00:00', '2018-12-15 00:46:23'),
(71, 'Manage Banks Fetch', 'bank-fetch', 64, NULL, NULL, NULL, 'bank.fetch', 0, 'bank.fetch', 1, '2018-12-13 19:00:00', '2018-12-13 19:00:00'),
(72, 'Manage Banks Store', 'bank-store', 64, NULL, NULL, NULL, 'bank.store', 0, 'bank.store', 1, '2018-12-13 19:00:00', '2018-12-13 19:00:00'),
(73, 'Manage Banks Edit', 'bank-edit', 64, NULL, NULL, NULL, 'bank.edit', 0, 'bank.edit', 1, '2018-12-13 19:00:00', '2018-12-13 19:00:00'),
(74, 'Committed Payable', 'payableCommitted', 64, 1, NULL, NULL, 'payableCommitted', 3, 'payableCommitted', 1, '2018-12-13 19:00:00', '2018-12-13 19:00:00'),
(75, 'Committed Payable Index', 'payableCommitted-index', 64, NULL, NULL, NULL, 'payableCommitted.index', 0, 'payableCommitted.index', 1, '2018-12-13 19:00:00', '2018-12-13 19:00:00'),
(76, 'Committed Payable Fetch', 'payableCommitted-fetch', 64, NULL, NULL, NULL, 'payableCommitted.fetch', 0, 'payableCommitted.fetch', 1, '2018-12-13 19:00:00', '2018-12-13 19:00:00'),
(77, 'Committed Payable Store', 'payableCommitted-store', 64, NULL, NULL, NULL, 'payableCommitted.store', 0, 'payableCommitted.store', 1, '2018-12-13 19:00:00', '2018-12-13 19:00:00'),
(78, 'Committed Payable Edit', 'payableCommitted-edit', 64, NULL, NULL, NULL, 'payableCommitted.edit', 0, 'payableCommitted.edit', 1, '2018-12-13 19:00:00', '2018-12-13 19:00:00'),
(79, 'Manage Budget Sheet', 'budgetSheet-index', 64, 1, NULL, NULL, 'budgetSheet', 4, 'budgetSheet.index', 1, '2018-12-14 19:00:00', '2018-12-15 02:48:24'),
(80, 'Budget Sheet Fetch', 'budgetSheet-fetch', 64, NULL, NULL, NULL, 'budgetSheet.fetch', 0, 'budgetSheet.fetch', 1, '2018-12-14 19:00:00', '2018-12-14 19:00:00'),
(81, 'Manage Budget Edit', 'budgetSheet-edit', 64, NULL, NULL, NULL, 'budgetSheet.edit', 0, 'budgetSheet.edit', 1, '2018-12-14 19:00:00', '2018-12-14 19:00:00'),
(82, 'Budget Sheet Store', 'budgetSheet-store', 64, NULL, NULL, NULL, 'budgetSheet.store', 0, 'budgetSheet.store', 1, '2018-12-16 19:00:00', '2018-12-16 19:00:00'),
(83, 'Add Consumed Budget Amount', 'ConsumeBudgetAmount-store', 64, NULL, NULL, NULL, 'ConsumeBudgetAmount.store', 0, 'ConsumeBudgetAmount.store', 1, '2018-12-16 19:00:00', '2018-12-16 19:00:00'),
(84, 'Budget Sheet Show', 'budgetSheet-show', 64, NULL, NULL, NULL, 'budgetSheet.show', 0, 'budgetSheet.show', 1, '2018-12-16 19:00:00', '2018-12-16 19:00:00'),
(85, 'Payable Committed Status', 'payableCommitted-status', 64, NULL, NULL, NULL, 'payableCommitted.status', 0, 'payableCommitted.status', 1, '2018-12-11 19:00:00', '2018-12-11 19:00:00'),
(88, 'Complaint Fetch', 'complaint-fetch', 196, NULL, NULL, NULL, 'complaint.fetch', 0, 'complaint.fetch', 1, '2018-12-20 14:00:00', '2019-03-12 23:22:15'),
(89, 'Complaint Store', 'complaint-store', 196, NULL, NULL, NULL, 'complaint.store', 0, 'complaint.store', 1, '2018-12-20 14:00:00', '2019-03-12 19:00:00'),
(90, 'Complaint Edit', 'complaint-edit', 196, NULL, NULL, NULL, 'complaint.edit', 0, 'complaint.edit', 1, '2018-12-20 14:00:00', '2019-03-12 19:00:00'),
(91, 'Manage Departments', 'departments-index', 5, 1, NULL, NULL, 'settings/departments', 0, 'departments, settings,', 1, '2018-12-20 19:00:00', '2018-12-21 00:36:05'),
(92, 'Add Department', 'create-department', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-23 19:00:00', '2018-12-24 03:52:47'),
(93, 'Edit Department', 'edit-department', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-23 19:00:00', '2018-12-23 19:00:00'),
(94, 'Delete Department', 'delete-department', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-23 19:00:00', '2018-12-23 19:00:00'),
(95, 'Department Status', 'status-department', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-23 19:00:00', '2018-12-23 19:00:00'),
(96, 'HR Leads', 'main-hrleads', NULL, 1, NULL, 'fa fa-child', '#', 0, 'hrleads, interviewees,interviews', 1, '2018-12-23 19:00:00', '2018-12-26 19:00:00'),
(97, 'Manage Leads', 'index-hrleads', 96, 1, NULL, NULL, 'hrleads', 0, 'hrleads', 1, '2018-12-23 19:00:00', '2018-12-23 19:00:00'),
(98, 'Create HR Lead', 'create-hrleads', 96, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-23 19:00:00', '2018-12-23 19:00:00'),
(99, 'Edit Hr Lead', 'edit-hrleads', 96, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-23 19:00:00', '2018-12-23 19:00:00'),
(100, 'Show Hr Lead', 'show-hrleads', 96, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-23 19:00:00', '2018-12-23 19:00:00'),
(101, 'Delete HR Lead', 'delete-hrleads', 96, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-23 19:00:00', '2018-12-23 19:00:00'),
(102, 'Upload HR Leads', 'upload-hrleads', 96, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-23 19:00:00', '2018-12-24 10:00:29'),
(103, 'HR Lead New Status', 'status-hrleads', 96, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-25 19:00:00', '2018-12-25 19:00:00'),
(104, 'Manage Interviewees', 'index-interviewees', 96, 1, NULL, NULL, 'hrleads/interviewees', 0, 'interviewees', 1, '2018-12-25 19:00:00', '2018-12-25 19:00:00'),
(105, 'Manage Interviews', 'index-interviews', 96, 1, NULL, NULL, 'hrleads/interviews', 0, 'interviews,', 1, '2018-12-26 19:00:00', '2018-12-26 19:00:00'),
(106, 'Complaint Detail', 'complaint-show', 196, NULL, NULL, NULL, 'complaint.show', 0, 'complaint.show', 1, '2018-12-21 14:00:00', '2019-03-12 19:00:00'),
(107, 'Complaint Comment', 'complaint-comment', 196, NULL, NULL, NULL, 'complaint.comment', 0, 'complaint.comment', 1, '2018-12-21 14:00:00', '2019-03-12 19:00:00'),
(108, 'Manage Designations', 'designations-index', 5, 1, NULL, NULL, 'settings/designations', 0, 'designations', 1, '2018-12-30 19:00:00', '2018-12-30 19:00:00'),
(109, 'Add Designation', 'create-designation', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-30 19:00:00', '2018-12-31 07:51:41'),
(110, 'Edit Designation', 'edit-designation', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-30 19:00:00', '2018-12-31 07:51:55'),
(111, 'Designation Status', 'status-designation', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-30 19:00:00', '2018-12-30 19:00:00'),
(112, 'Delete Designation', 'delete-designation', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2018-12-30 19:00:00', '2018-12-30 19:00:00'),
(113, 'Preferences', 'preferences-index', 5, 1, NULL, NULL, 'settings/preferences', 0, 'preferences,settings', 1, '2019-01-06 19:00:00', '2019-01-08 19:00:00'),
(114, 'Edit Preference', 'edit-preference', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-06 19:00:00', '2019-01-06 19:00:00'),
(115, 'Delete Preference', 'delete-preference', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-06 19:00:00', '2019-01-06 19:00:00'),
(116, 'Add Preference', 'create-preference', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-06 19:00:00', '2019-01-06 19:00:00'),
(117, 'Attendance Exception', 'attendance-exception', 129, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-06 19:00:00', '2019-01-18 00:00:00'),
(118, 'Holidays', 'holidays-index', 5, 1, 1, NULL, 'settings/holidays', 0, 'holidays, settings', 1, '2019-01-08 19:00:00', '2019-01-09 07:14:59'),
(119, 'Edit Holiday', 'edit-holiday', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-08 19:00:00', '2019-01-08 19:00:00'),
(120, 'Delete Holiday', 'delete-holiday', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-08 19:00:00', '2019-01-08 19:00:00'),
(121, 'Add Holiday', 'create-holiday', 5, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-08 19:00:00', '2019-01-08 19:00:00'),
(122, 'Attendance Sheet', 'attendance-index', 2, 1, NULL, NULL, 'staff/attendancesheet', 0, 'admins, attendancesheet', 1, '2019-01-11 19:00:00', '2019-01-12 03:32:54'),
(123, 'Manage Bksol Reference', 'yccref-index', 54, 1, NULL, NULL, 'yccref', 0, 'yccref, yccrefs', 1, '2019-01-15 19:00:00', '2019-10-03 19:00:00'),
(124, 'Edit Reference', 'edit-yccref', 54, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-15 19:00:00', '2019-01-16 04:43:55'),
(125, 'Reference Status', 'status-yccref', 54, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-15 19:00:00', '2019-01-15 19:00:00'),
(126, 'Delete Reference', 'delete-yccref', 54, NULL, NULL, NULL, '#', 0, NULL, 2, '2019-01-15 19:00:00', '2019-10-04 19:00:00'),
(127, 'Add Reference', 'create-yccref', 54, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-15 19:00:00', '2019-01-15 19:00:00'),
(128, 'Show Reference', 'show-yccref', 54, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-15 19:00:00', '2019-01-15 19:00:00'),
(129, 'Extra Settings', 'extra-settings', NULL, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-16 19:00:00', '2019-01-16 19:00:00'),
(130, 'Edit Staff Attendance', 'edit-staff-attendance', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-16 19:00:00', '2019-01-16 19:00:00'),
(131, 'Manage Leaves', 'leaves-index', 2, 1, NULL, NULL, 'leaves', 0, 'leave, leaves', 1, '2019-01-16 19:00:00', '2019-01-16 19:00:00'),
(132, 'Edit Leave', 'edit-leave', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-16 19:00:00', '2019-01-16 19:00:00'),
(133, 'Delete Leave', 'delete-leave', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-16 19:00:00', '2019-01-16 19:00:00'),
(134, 'Add Leave', 'create-leave', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-16 19:00:00', '2019-01-16 19:00:00'),
(135, 'Manage Adjustments', 'adjustments-index', 2, 1, NULL, NULL, 'payroll/adjustments', 0, 'adjustment,adjustments', 1, '2019-01-17 19:00:00', '2019-01-17 19:00:00'),
(136, 'Edit Adjustment', 'edit-adjustment', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-17 19:00:00', '2019-01-18 04:33:53'),
(137, 'Delete Adjustment', 'delete-adjustment', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-17 19:00:00', '2019-01-17 19:00:00'),
(138, 'Add Adjustment', 'create-adjustment', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-17 19:00:00', '2019-01-17 19:00:00'),
(139, 'Lock Salary Sheet', 'locksalarysheet', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-01-23 19:00:00', '2019-01-23 19:00:00'),
(140, 'Inventory', 'inventory', NULL, 1, NULL, 'fa fa-stop-circle-o', 'inventory', 10, 'inventory', 1, '2018-12-30 14:00:00', '2018-12-30 14:00:00'),
(141, 'Inventory Category', 'inventoryCategory-index', 140, 1, NULL, NULL, 'inventoryCategory', 1, 'inventoryCategory', 1, '2018-12-30 14:00:00', '2018-12-31 01:43:31'),
(142, 'Inventory Category Fetch', 'inventoryCategory-fetch', 140, NULL, NULL, NULL, 'inventoryCategory.fetch', 0, 'inventoryCategory.fetch', 1, '2018-12-30 14:00:00', '2018-12-31 14:00:00'),
(143, 'Inventory Category Store', 'inventoryCategory-store', 140, NULL, NULL, NULL, 'inventoryCategory.store', 0, 'inventoryCategory.store', 1, '2018-12-30 14:00:00', '2018-12-31 14:00:00'),
(144, 'Inventory Category Edit', 'inventoryCategory-edit', 140, NULL, NULL, NULL, 'inventoryCategory.edit', 0, 'inventoryCategory.edit', 1, '2018-12-30 14:00:00', '2018-12-31 14:00:00'),
(145, 'Manage Inventory', 'inventory-index', 140, 1, NULL, NULL, 'inventory', 2, 'inventory.index', 1, '2018-12-31 14:00:00', '2018-12-31 14:00:00'),
(146, 'Inventory Fetch', 'inventory-fetch', 140, NULL, NULL, NULL, 'inventory.fetch', 0, 'inventory.fetch', 1, '2018-12-31 14:00:00', '2018-12-31 14:00:00'),
(147, 'Inventory Store', 'inventory-store', 140, NULL, NULL, NULL, 'inventory.store', 0, 'inventory.store', 1, '2018-12-31 14:00:00', '2018-12-31 14:00:00'),
(148, 'Inventory Edit', 'inventory-edit', 140, NULL, NULL, NULL, 'inventory.edit', 0, 'inventory.edit', 1, '2018-12-31 14:00:00', '2018-12-31 14:00:00'),
(149, 'Inventory Detail', 'inventory-show', 140, NULL, NULL, NULL, 'inventory.show', 0, 'inventory.show', 1, '2018-12-31 14:00:00', '2018-12-31 14:00:00'),
(150, 'Manage Quiz Leads', 'index-quizleads', 54, 1, NULL, NULL, 'quizleads', 2, 'quizleads', 1, '2019-01-01 14:00:00', '2019-01-01 14:00:00'),
(151, 'IT station', 'itstation-index', 140, 1, NULL, NULL, 'itstation', 3, 'itstation', 1, '2019-01-06 14:00:00', '2019-01-07 00:01:05'),
(152, 'IT station Store', 'itstation-store', 140, NULL, NULL, NULL, 'itstation.store', 0, 'itstation.store', 1, '2019-01-09 14:00:00', '2019-01-09 14:00:00'),
(153, 'IT station Fetch', 'itstation-fetch', 140, NULL, NULL, NULL, 'itstation.fetch', 0, 'itstation.fetch', 1, '2019-01-10 14:00:00', '2019-01-10 14:00:00'),
(154, 'IT station Detail', 'itstation-show', 140, NULL, NULL, NULL, 'itstation.show', 0, 'itstation.show', 1, '2019-01-10 14:00:00', '2019-01-10 14:00:00'),
(155, 'Inventory Quantity Issuse', 'inventory-issuseStore', 140, NULL, NULL, NULL, 'inventory.issuseStore', 0, 'inventory.issuseStore', 1, '2019-01-17 14:00:00', '2019-01-17 14:00:00'),
(156, 'Inventory Quantity Add', 'inventory-plusStore', 140, NULL, NULL, NULL, 'inventory.plusStore', 0, 'inventory.plusStore', 1, '2019-01-17 14:00:00', '2019-01-17 14:00:00'),
(157, 'IT station Edit', 'itstation-edit', 140, NULL, NULL, NULL, 'itstation.edit', 0, 'itstation.edit', 1, '2019-01-21 14:00:00', '2019-01-21 14:00:00'),
(158, 'Salary Sheet', 'salarysheet-index', 64, 1, NULL, NULL, 'payroll/salary', 0, 'salarysheet', 1, '2019-02-02 00:00:00', '2019-02-02 00:00:00'),
(159, 'Pay Salary', 'pay-salarysheet', 64, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-02-02 00:00:00', '2019-02-02 00:00:00'),
(160, 'Chat', 'chat-view', NULL, 1, NULL, 'fa fa-comments', 'chat', 14, 'chat', 1, '2019-01-28 14:00:00', '2019-01-28 14:00:00'),
(161, 'New Chat Group', 'create-chat-groups', 160, NULL, NULL, NULL, 'create-chat-groups', 0, 'create-chat-groups', 1, '2019-02-05 14:00:00', '2019-02-05 14:00:00'),
(162, 'New Chat Single ', 'chat-add-new-chat-single', 160, NULL, NULL, NULL, 'createChatRoom', 0, 'createChatRoom', 1, '2019-02-05 14:00:00', '2019-02-05 14:00:00'),
(163, 'Chart Of Account', 'chartOfAccount-index', 64, 1, NULL, NULL, '/chartOfAccount', 5, 'chartOfAccount.index', 1, '2019-01-29 19:00:00', '2019-01-29 19:00:00'),
(164, 'Chart Of Account  Fetch', 'chartOfAccount-fetch', 64, NULL, NULL, NULL, 'chartOfAccount.fetch', 0, 'chartOfAccount.fetch', 1, '2019-01-29 19:00:00', '2019-01-29 19:00:00'),
(165, 'Chart Of Account  Store', 'chartOfAccount-store', 64, NULL, NULL, NULL, 'chartOfAccount.store', 0, 'chartOfAccount.store', 1, '2019-01-29 19:00:00', '2019-01-29 19:00:00'),
(166, 'Chart Of Account Edit', 'chartOfAccount-edit', 64, NULL, NULL, NULL, 'chartOfAccount.edit', 0, 'chartOfAccount.edit', 1, '2019-01-29 19:00:00', '2019-01-29 19:00:00'),
(167, 'Journal Voucher', 'journalVoucher-index', 64, 1, NULL, NULL, 'journalVoucher', 7, 'journalVoucher.index', 1, '2019-02-10 19:00:00', '2019-02-11 02:49:57'),
(168, 'Journal Voucher Fetch', 'journalVoucher-fetch', 64, NULL, NULL, NULL, 'journalVoucher.fetch', 0, 'journalVoucher.fetch', 1, '2019-02-10 19:00:00', '2019-02-10 19:00:00'),
(169, 'Journal Voucher Store', 'journalVoucher-store', 64, NULL, NULL, NULL, 'journalVoucher.store', 0, 'journalVoucher.store', 1, '2019-02-10 19:00:00', '2019-02-10 19:00:00'),
(170, 'Journal Voucher Edit', 'journalVoucher-edit', 64, NULL, NULL, NULL, 'journalVoucher.edit', 0, 'journalVoucher.edit', 1, '2019-02-10 19:00:00', '2019-02-10 19:00:00'),
(171, 'Journal Voucher Show', 'journalVoucher-show', 64, NULL, NULL, NULL, 'journalVoucher.show', 0, 'journalVoucher.show', 1, '2019-02-11 19:00:00', '2019-02-11 19:00:00'),
(172, 'Ledger Sheet', 'ledger-index', 64, 1, NULL, NULL, 'ledger', 7, 'ledger.index', 1, '2019-02-12 19:00:00', '2019-02-12 19:00:00'),
(173, 'Paypal Withdraw Fetch', 'paypalwithdrwal-fetch', 64, NULL, NULL, NULL, 'paypalwithdrwa/fetch', 0, 'paypalwithdrwal.fetch', 1, '2019-02-10 19:00:00', '2019-02-19 00:00:00'),
(174, 'Paypal withdraw Store', 'paypalwithdrwal-store', 64, NULL, NULL, NULL, 'paypalwithdrwal.store', 0, 'paypalwithdrwal.store', 1, '2019-02-10 19:00:00', '2019-02-10 19:00:00'),
(175, 'Paypal Withdraw Edit', 'paypalwithdrwal-edit', 64, NULL, NULL, NULL, 'paypalwithdrwal.edit', 0, 'paypalwithdrwal.edit', 1, '2019-02-10 19:00:00', '2019-02-10 19:00:00'),
(176, 'Staff Required', 'staffrequired-index', 2, 1, NULL, NULL, 'staffrequired', 5, 'staffrequired.index', 1, '2019-02-10 19:00:00', '2019-02-10 19:00:00'),
(177, 'Staff Required Fetch', 'staffrequired-fetch', 2, NULL, NULL, NULL, 'staffrequired.fetch', 0, 'staffrequired.fetch', 1, '2019-02-10 19:00:00', '2019-02-10 19:00:00'),
(178, 'Staff Required Store', 'staffrequired-store', 2, NULL, NULL, NULL, 'staffrequired.store', 0, 'staffrequired.store', 1, '2019-02-10 19:00:00', '2019-02-10 19:00:00'),
(179, 'Staff Required Edit', 'staffrequired-edit', 2, NULL, NULL, NULL, 'staffrequired.edit', 0, 'staffrequired.edit', 1, '2019-02-10 19:00:00', '2019-02-10 19:00:00'),
(180, 'Hiring Document', 'userdocumemt-index', 2, 1, NULL, NULL, 'userdocument', 6, 'userdocumemt.index', 1, '2019-02-11 19:00:00', '2019-02-11 19:00:00'),
(181, 'Hiring Document Fetch', 'userdocumemt-fetch', 2, NULL, NULL, NULL, 'userdocumemt.fetch', 0, 'userdocumemt.fetch', 1, '2019-02-11 19:00:00', '2019-02-11 19:00:00'),
(182, 'Inventory Issuse Report', 'inventoryReport-index', 140, 1, NULL, NULL, '/inventory/Report', 4, 'inventoryReport.index', 1, '2019-01-27 19:00:00', '2019-02-19 00:00:00'),
(183, 'Inventory IN Report', 'inventoryReportIn-index', 140, 1, NULL, NULL, '/inventoryIn/Report', 5, 'inventoryReportIn.index', 1, '2019-01-28 19:00:00', '2019-02-19 00:00:00'),
(184, 'Paypal Withdraw', 'paypalwithdrwal-index', 64, 1, NULL, NULL, 'paypalwithdrwal', 0, 'paypalwithdrwal.index', 1, '2019-02-10 19:00:00', '2019-02-19 11:46:51'),
(185, 'Paypal Withdraw Status', 'paypalwithdrwal-active', 64, NULL, 1, '0', '#', 0, NULL, 1, '2019-03-06 19:00:00', '2019-03-06 19:00:00'),
(186, 'Paypal Withdraw Delete', 'paypalwithdrwal-delete', 64, NULL, 1, NULL, '#', 0, NULL, 1, '2019-03-06 19:00:00', '2019-03-06 19:00:00'),
(187, 'Paypal Withdraw Disable', 'paypalwithdrwal-disable', 64, NULL, 1, NULL, '#', 0, NULL, 1, '2019-03-06 19:00:00', '2019-03-06 19:00:00'),
(188, 'Journal Voucher Update', 'journalVoucher-update', 64, NULL, NULL, NULL, 'journalVoucher.update', 0, 'journalVoucher.update', 1, '2019-03-04 19:00:00', '2019-03-04 19:00:00'),
(189, 'Journal Voucher add', 'journalVoucherDetail-add', 64, NULL, NULL, NULL, 'journalVoucherDetail.add', 0, 'journalVoucherDetail.add', 1, '2019-03-04 19:00:00', '2019-03-04 19:00:00'),
(190, 'Daily Cash Book', 'cashbook-index', 64, 1, NULL, NULL, 'cashbook', 8, 'cashbook.index', 1, '2019-03-05 19:00:00', '2019-03-05 19:00:00'),
(191, 'End Service Checklist', 'endservice-index', 2, 1, NULL, NULL, 'endservice', 7, 'endservice.index', 1, '2019-02-12 19:00:00', '2019-02-12 19:00:00'),
(192, 'End Service Fetch', 'endservice-fetch', 2, NULL, NULL, NULL, 'endservice.fetch', 0, 'endservice.fetch', 1, '2019-02-12 19:00:00', '2019-02-12 19:00:00'),
(193, 'End Service Store', 'endservice-store', 2, NULL, NULL, NULL, 'endservice.store', 0, 'endservice.store', 1, '2019-02-12 19:00:00', '2019-02-12 19:00:00'),
(194, 'End Service Edit', 'endservice-edit', 2, NULL, NULL, NULL, 'endservice.edit', 0, 'endservice.edit', 1, '2019-02-12 19:00:00', '2019-02-12 19:00:00'),
(195, 'Journal Voucher Delete', 'journalVoucher-disable', 64, NULL, NULL, NULL, 'journalVoucher.disable', 0, 'journalVoucher.disable', 1, '2019-03-10 19:00:00', '2019-03-10 19:00:00'),
(196, 'Manage Complaints', '#', NULL, 1, 1, 'fa fa-comments', '#', 10, '#', 1, '2019-03-11 14:00:00', '2019-03-11 14:00:00'),
(197, 'Complaint  Delete', 'complaint-disable', 196, NULL, NULL, NULL, 'complaint.disable', 0, 'complaint.disable', 1, '2019-03-11 14:00:00', '2019-03-12 19:00:00'),
(198, 'My Complaints', 'complaint-index', 196, 1, NULL, NULL, 'complaint', 0, 'complaint.index', 1, '2019-03-12 19:00:00', '2019-03-12 19:00:00'),
(199, 'My Department Complaints', 'departcomplaint-index', 196, 1, NULL, NULL, 'departcomplaint', 0, 'departcomplaint.index', 1, '2019-03-12 19:00:00', '2019-03-13 19:00:00'),
(200, 'Department Complaint Fetch', 'departcomplaint-fetch', 196, NULL, NULL, NULL, 'departcomplaint.fetch', 0, 'departcomplaint.fetch', 1, '2019-03-12 19:00:00', '2019-03-12 19:00:00'),
(201, 'All Complaints', 'allcomplaint-index', 196, 1, NULL, NULL, 'allcomplaint', 0, 'allcomplaint.index', 1, '2019-03-12 19:00:00', '2019-03-12 19:00:00'),
(202, 'All Complaints Fetch', 'allcomplaint-fetch', 196, NULL, NULL, NULL, 'allcomplaint.fetch', 0, 'allcomplaint.fetch', 1, '2019-03-12 19:00:00', '2019-03-12 19:00:00'),
(203, 'Department Complaint Show', 'departcomplaint-show', 196, NULL, NULL, NULL, 'departcomplaint.show', 0, 'departcomplaint.show', 1, '2019-03-12 19:00:00', '2019-03-12 19:00:00'),
(204, 'All Complaints Show', 'allcomplaint-show', 196, NULL, NULL, NULL, 'allcomplaint.show', 0, 'allcomplaint.show', 1, '2019-03-12 19:00:00', '2019-03-12 19:00:00'),
(205, 'View HR Stats', 'stats-hr', 1, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-03-13 19:00:00', '2019-03-13 19:00:00'),
(206, 'Chart Of Account Delete', 'chartOfAccount-delete', 64, NULL, NULL, NULL, 'chartOfAccount.delete', 0, 'chartOfAccount-delete', 1, '2019-03-19 19:00:00', '2019-03-19 19:00:00'),
(207, 'Quality Assurance', 'qualityassurance-index', 2, 1, NULL, NULL, 'qualityassurance', 8, 'qualityassurance', 1, '2019-03-11 19:00:00', '2019-03-11 19:00:00'),
(208, 'Quality Assurance Fetch', 'qualityassurance-fetch', 2, NULL, NULL, NULL, 'qualityassurance.fetch', 0, 'qualityassurance.fetch', 1, '2019-03-11 19:00:00', '2019-03-11 19:00:00'),
(209, 'Quality Assurance Store', 'qualityassurance-store', 2, NULL, NULL, NULL, 'qualityassurance.store', 0, 'qualityassurance.store', 1, '2019-03-11 19:00:00', '2019-03-11 19:00:00'),
(210, 'Quality Assurance Edit', 'qualityassurance-edit', 2, NULL, NULL, NULL, 'qualityassurance.store', 0, 'qualityassurance.store', 1, '2019-03-11 19:00:00', '2019-03-11 19:00:00'),
(211, 'View Present Address', 'view-presentAddress', 2, NULL, NULL, NULL, 'admins.show', 0, 'admins.show', 1, '2019-03-10 19:00:00', '2019-03-10 19:00:00'),
(212, 'View Permanent Address', 'view-permanentAddress', 2, NULL, NULL, NULL, 'admins.show', 0, 'admins.show', 1, '2019-03-10 19:00:00', '2019-03-10 19:00:00'),
(213, 'View Gaurdains Info', 'view-gaurdianInfo', 2, NULL, NULL, NULL, 'admins.show', 0, 'admins.show', 1, '2019-03-10 19:00:00', '2019-03-10 19:00:00'),
(214, 'View Personal Contact', 'view-personalContact', 2, NULL, NULL, NULL, 'admins.show', 0, 'admins.show', 1, '2019-03-10 19:00:00', '2019-03-10 19:00:00'),
(215, 'View User Department & Role', 'view-UserDepartmentRole', 2, NULL, NULL, NULL, 'admins.show', 0, 'admins.show', 1, '2019-03-10 19:00:00', '2019-03-10 19:00:00'),
(216, 'View User Account Info', 'view-userAccountInfo', 2, NULL, NULL, NULL, 'admins.shwo', 0, 'admins.show', 1, '2019-03-10 19:00:00', '2019-03-10 19:00:00'),
(217, 'View Other Info $ Settings', 'view-otherInfoSettings', 2, NULL, NULL, NULL, 'admins.show', 0, 'admins.show', 1, '2019-03-10 19:00:00', '2019-03-10 19:00:00'),
(218, 'View Adjustments', 'view-adjustments', 2, NULL, NULL, NULL, 'admins.show', 0, 'admins.show', 1, '2019-03-11 19:00:00', '2019-03-11 19:00:00'),
(219, 'View Attendance', 'view-attendance', 2, NULL, NULL, NULL, 'admins.show', 0, 'admins.show', 1, '2019-03-11 19:00:00', '2019-03-11 19:00:00'),
(220, 'Activity Log', 'activitylogs', 5, 1, 1, NULL, 'settings/activitylogs', 0, 'activitylogs', 1, '2019-04-10 19:00:00', '2019-04-11 01:17:20'),
(221, 'Attendance Approval Requests', 'att-approval', 2, 1, NULL, NULL, 'staff/attendancesheet/approval', 0, 'attendancesheet.approval', 1, '2019-04-15 19:00:00', '2019-04-15 19:00:00'),
(222, 'Attendance Approval View', 'att-viewapproval', 2, NULL, NULL, NULL, 'staff/attendancesheet/viewapproval', 0, 'viewapproval', 1, '2019-04-15 19:00:00', '2019-04-16 00:15:48'),
(223, 'Attendance Approve', 'att-approve', 2, NULL, NULL, NULL, 'staff/attendancesheet/approve', 0, 'attendancesheet.approve', 1, '2019-04-15 19:00:00', '2019-04-16 00:15:20'),
(224, 'Attendance Reject', 'att-reject', 2, NULL, NULL, NULL, 'staff/attendancesheet/reject', 0, 'attendancesheet.reject', 1, '2019-04-15 19:00:00', '2019-04-16 00:15:34'),
(231, 'Approve Adjustment', 'approve-adjustment', 2, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-04-29 19:00:00', '2019-04-29 19:00:00'),
(232, 'Bksol Support', 'yccsupport-index', NULL, 1, NULL, 'fa fa-ticket', 'yccsupport', 0, 'yccsupport', 1, '2019-04-07 14:00:00', '2019-10-03 19:00:00'),
(233, 'Bksol Support Fetch', 'yccsupport-fetch', 232, NULL, NULL, NULL, 'yccsupport.fetch', 0, 'yccsupport.fetch', 1, '2019-04-07 14:00:00', '2019-10-03 19:00:00'),
(234, 'Bksol Support Edit', 'yccsupport-edit', 232, NULL, NULL, NULL, 'yccsupport.edit', 0, 'yccsupport.edit', 1, '2019-04-07 14:00:00', '2019-10-03 19:00:00'),
(235, 'Bksol Support Store Support Show', 'yccsupport-show', 232, NULL, NULL, NULL, 'yccsupport.show', 0, 'yccsupport.show', 1, '2019-04-07 14:00:00', '2019-10-03 19:00:00'),
(236, 'BKSOL Support Store', 'yccsupport-store', 232, NULL, NULL, NULL, 'yccsupport.store', 0, 'yccsupport.store', 1, '2019-04-07 14:00:00', '2019-10-03 19:00:00'),
(237, 'Bksol Support Detail', 'yccsupport-detail', 232, NULL, NULL, NULL, 'yccsupport.detail', 0, 'yccsupport.detail', 1, '2019-04-07 14:00:00', '2019-10-03 19:00:00'),
(238, 'View All Tickets', 'view-all-yccsupporttickets', 232, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-04-30 19:00:00', '2019-04-30 19:00:00'),
(239, 'CCMS', 'ccms', NULL, 1, 1, 'fa fa-desktop', '#', 0, NULL, 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(240, 'Teacher Course', 'teacher_course-index', 239, 1, 1, NULL, '/teacher_course', 1, 'teacher_course, teacher_course.edit, teacher_course.create, teacher_course.show', 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(241, 'Teacher Timing', 'teacher_timing-index', 239, 1, 1, NULL, '/teacher_timing', 1, 'teacher_timing, teacher_timing.edit, teacher_timing.create, teacher_timing.show', 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(242, 'Add Teacher Course', 'create-teacher_course', 239, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(243, 'Edit Teacher Course', 'edit-teacher_course', 239, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(244, 'Delete Teacher Course', 'delete-teacher_course', 239, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(245, 'Add Teacher Timing', 'create-teacher_timing', 239, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(246, 'Edit Teacher Timing', 'edit-teacher_timing', 239, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(247, 'Delete Teacher Timing', 'delete-teacher_timing', 239, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(248, 'Manage Parent', 'index-parents', 239, 1, 1, NULL, '/parents', 1, 'parents, parents.edit, parents.create, parents.show', 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(249, 'Add Parent', 'create-parents', 239, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(250, 'Edit Parent', 'edit-parents', 239, NULL, NULL, NULL, 'parents.edit', 0, 'parents.edit', 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(251, 'studentformparent', 'studentformparent', 239, NULL, NULL, NULL, 'parents.studentformparent', 0, 'parents.studentformparent', 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(252, 'Create StudentParent', 'create-studentparent', 239, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(253, 'Show Parents', 'show-parents', 239, NULL, NULL, '#', 'parents.show', 0, 'parents.show', 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(254, 'Parent Status', 'status-parents', 239, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(255, 'Create Invoice', 'createinvoice', 239, NULL, NULL, NULL, 'parents.createinvoice', 0, 'parents.createinvoice', 1, '2019-04-16 19:00:00', '2019-04-16 19:00:00'),
(256, 'Manage Student', 'index-student', 239, 1, 1, NULL, '/student', 1, 'student, student.edit, student.create, student.show', 1, '2019-04-18 19:00:00', '2019-04-18 19:00:00'),
(257, 'Add Student', 'create-student', 239, NULL, NULL, NULL, 'student.store', 0, 'student.store', 1, '2019-04-18 19:00:00', '2019-04-18 19:00:00'),
(258, 'Edit Student', 'edit-student', 239, NULL, NULL, NULL, 'student.edit', 0, 'student.edit', 1, '2019-04-18 19:00:00', '2019-04-18 19:00:00'),
(259, 'Delete Student', 'delete-student', 239, NULL, NULL, NULL, 'student.destroy', 0, 'student.destroy', 1, '2019-04-18 19:00:00', '2019-04-18 19:00:00'),
(260, 'Show Student', 'show-student', 239, NULL, NULL, NULL, 'student.show', 0, 'student.show', 1, '2019-04-18 19:00:00', '2019-04-18 19:00:00'),
(261, 'Student Status', 'status-student', 239, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-04-18 19:00:00', '2019-04-18 19:00:00'),
(262, 'Manage Schedule', 'index-schedule', 239, 1, 1, NULL, '/schedule', 1, 'schedule, schedule.edit, schedule.create, schedule.show, schedule.trial_confirmation', 1, '2019-04-18 19:00:00', '2019-04-18 19:00:00'),
(263, 'Add Schedule', 'create-schedule', 239, NULL, NULL, NULL, 'schedule.create', 0, 'schedule.create', 1, '2019-04-18 19:00:00', '2019-04-18 19:00:00'),
(264, 'Edit Schedule', 'edit-schedule', 239, NULL, NULL, NULL, 'schedule.edit', 0, 'schedule.edit', 1, '2019-04-18 19:00:00', '2019-04-18 19:00:00'),
(265, 'Delete Schedule', 'delete-schedule', 239, NULL, NULL, NULL, 'schedule.destroy', 0, 'schedule.destroy', 1, '2019-04-18 19:00:00', '2019-04-18 19:00:00'),
(266, 'Show Schedule', 'show-schedule', 239, NULL, NULL, NULL, 'schedule.show', 0, 'schedule.show', 1, '2019-04-18 19:00:00', '2019-04-18 19:00:00'),
(267, 'Trial Confirmation', 'index-trialconfirmation', 239, 1, NULL, NULL, 'schedule/trialconfirmation', 0, 'schedule.trialconfirmation', 1, '2019-04-18 19:00:00', '2019-04-18 19:00:00'),
(268, 'Trial Status', 'status-confirmtrial', 239, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-04-18 19:00:00', '2019-04-18 19:00:00'),
(269, 'DC Confirmation', 'index-deadconfirmation', 239, NULL, NULL, NULL, 'schedule/deadconfirmation', 0, 'schedule.deadconfirmation', 1, '2019-04-19 19:00:00', '2019-04-19 19:00:00'),
(270, 'Dead Status', 'status-confirmdead', 239, NULL, NULL, NULL, '#', 0, NULL, 1, '2019-04-19 19:00:00', '2019-04-19 19:00:00'),
(271, 'DC Confirmation List', 'index-deadconfirmation_list', 239, 1, NULL, NULL, 'schedule/deadconfirmation_list', 0, 'schedule.deadconfirmation_list', 1, '2019-04-19 19:00:00', '2019-04-20 03:15:10'),
(272, 'Daily Schedule', 'index-daily_schedule', 239, 1, NULL, NULL, '/daily_schedule', 0, 'daily_schedule.index', 1, '2019-04-19 19:00:00', '2019-04-19 19:00:00'),
(273, 'StartClassFunction Process', 'startClassFunction', 239, NULL, NULL, NULL, 'startClassFunction', 0, 'startClassFunction', 1, '2019-04-19 19:00:00', '2019-04-19 19:00:00'),
(274, 'EndClass Page', 'endClass', 239, NULL, NULL, NULL, '/endClass', 0, 'endClass', 1, '2019-04-19 19:00:00', '2019-04-19 19:00:00'),
(275, 'EndClassFunction Process', 'endClassFunction', 239, NULL, NULL, NULL, '/endClassFunction', 0, 'endClassFunction', 1, '2019-04-19 19:00:00', '2019-04-19 19:00:00'),
(276, 'Class Details', 'classDetails', 239, 1, NULL, NULL, '/daily_schedule/classDetails', 1, 'daily_schedule.classDetails', 1, '2019-04-19 19:00:00', '2019-04-19 19:00:00'),
(277, 'Invoice Preview', 'invoicepreview', 239, NULL, NULL, NULL, 'parents.invoicepreview', 0, 'parents.invoicepreview', 1, '2019-04-21 19:00:00', '2019-04-21 19:00:00'),
(278, 'Save Invoice', 'saveinvoice', 239, NULL, NULL, NULL, 'parents/saveinvoice', 0, 'parents.saveinvoice', 1, '2019-04-21 19:00:00', '2019-04-22 07:09:27'),
(279, 'Confirm Dead List', 'confirmdead_list', 239, NULL, NULL, NULL, 'schedule/confirmdead_list', 0, 'schedule.confirmdead_list', 1, '2019-04-21 19:00:00', '2019-04-21 19:00:00'),
(280, 'To Schedule From Dead List', 'toScheduleFromDeadList', 239, NULL, NULL, NULL, 'schedule/toScheduleFromDeadList', 0, 'schedule.toScheduleFromDeadList', 1, '2019-04-21 19:00:00', '2019-04-21 19:00:00'),
(281, 'Edit Fee', 'editfee', 239, NULL, NULL, NULL, 'schedule/editfee', 0, 'schedule.editfee', 1, '2019-04-21 19:00:00', '2019-04-21 19:00:00'),
(282, 'Update Fee', 'updatefee', 239, NULL, NULL, NULL, 'schedule/updatefee', 0, 'schedule.updatefee', 1, '2019-04-21 19:00:00', '2019-04-21 19:00:00'),
(283, 'List Pending Invoices', 'invoicelistpending', 239, 1, NULL, NULL, 'invoice', 0, 'invoicelist.index', 1, '2019-04-21 19:00:00', '2019-04-21 19:00:00'),
(284, 'My Leaves', 'myleaves-index', NULL, 1, 1, 'fa fa-clipboard', 'myleaves', 0, 'leaves.myleaves, leaves.myleaves_create, leaves.myleaves_edit', 1, '2019-09-27 19:00:00', '2019-09-28 07:21:27'),
(285, 'Add My Leaves', 'myleaves-create', 284, NULL, NULL, NULL, 'leaves.myleaves_create', 0, 'leaves.myleaves_create', 1, '2019-09-27 19:00:00', '2019-09-27 19:00:00'),
(286, 'Edit My Leaves', 'myleaves-edit', 284, NULL, NULL, NULL, 'leaves.myleaves_edit', 0, 'leaves.myleaves_edit', 1, '2019-09-27 19:00:00', '2019-09-27 19:00:00'),
(287, 'Delete My Leaves', 'myleaves-delete', 284, NULL, NULL, NULL, 'leaves.myleaves_destroy', 0, 'leaves.myleaves_destroy', 1, '2019-09-27 19:00:00', '2019-09-27 19:00:00'),
(288, 'Close this project', 'close-this-lead', 7, NULL, NULL, NULL, 'close-this-lead', 10, 'leads.index', 1, '2019-10-10 19:00:00', '2019-10-10 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(10) UNSIGNED NOT NULL,
  `appointtime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `lead_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `appointtime`, `note`, `status`, `lead_id`, `created_by`, `created_at`, `updated_at`) VALUES
(2, '2018-08-20 14:00:00', 'They don\'t have any Digital Presence, they need Web Development, Social Integration Plan through Facebook & Instagram and whatever they may require, we should pitch them on spot', 0, 6, 35, '2018-08-18 00:00:00', '2018-08-18 00:00:00'),
(3, '2018-08-20 17:30:00', 'They want their footings to be enhanced more than the current. They also need Apps Development and any other lucrative idea to pitch in.', 0, 2, 35, '2018-08-18 00:00:00', '2018-08-18 00:00:00'),
(4, '2018-08-19 14:00:00', 'Currently they are trying Social Integration themselves but they need professional hands for it. We can pitch them all Social Media Platforms Integration as well as App Development and SEO Services.', 0, 4, 35, '2018-08-18 00:00:00', '2018-08-18 00:00:00'),
(5, '2018-08-18 17:00:00', 'He asked to meet him in the evening at 5PM Singapore Time', 0, 8, 34, '2018-08-18 00:00:00', '2018-08-18 00:00:00'),
(6, '2018-08-28 14:00:00', 'They recently started off and launched Garment Outlet and want social integration plan to boost up the business. He needs us to share ideas!', 0, 7, 35, '2018-08-18 00:00:00', '2018-08-18 00:00:00'),
(13, '2018-08-21 14:00:00', NULL, 0, 10, 32, '2018-08-20 00:00:00', '2018-08-20 00:00:00'),
(14, '2018-08-20 17:10:00', NULL, 0, 11, 32, '2018-08-20 00:00:00', '2018-08-20 00:00:00'),
(15, '2018-08-21 17:00:00', NULL, 0, 12, 29, '2018-08-20 00:00:00', '2018-08-20 00:00:00'),
(16, '2018-08-21 17:30:00', 'He asked to call him when you come out of hotel.', 0, 13, 34, '2018-08-20 00:00:00', '2018-08-20 00:00:00'),
(17, '2018-08-27 12:30:00', 'They don\'t have digitial visibility and strong social footings. They want to meet us to establish social media marketing and Other Services!', 0, 14, 35, '2018-08-24 00:00:00', '2018-08-24 00:00:00'),
(18, '2018-08-27 17:30:00', 'Meeting Rescheduled from August 20, 2018 to August 27, 2018 at 5:30 PM. Rest of everything is same!', 0, 2, 35, '2018-08-24 00:00:00', '2018-08-24 00:00:00'),
(19, '2018-08-28 15:30:00', NULL, 0, 22, 35, '2018-08-27 00:00:00', '2018-08-27 00:00:00'),
(20, '2018-09-06 17:00:00', 'He asked to speak him before coming.', 0, 23, 34, '2018-08-27 00:00:00', '2018-08-27 00:00:00'),
(21, '2018-09-03 18:00:00', 'Meeting with the Owner of the Restaurant', 0, 25, 29, '2018-08-30 00:00:00', '2018-08-30 00:00:00'),
(22, '2018-09-03 18:00:00', NULL, 0, 27, 29, '2018-08-30 00:00:00', '2018-08-30 00:00:00'),
(23, '2018-09-05 19:00:00', NULL, 0, 27, 29, '2018-08-31 00:00:00', '2018-08-31 00:00:00'),
(24, '2018-09-05 15:00:00', NULL, 0, 29, 29, '2018-08-31 00:00:00', '2018-08-31 00:00:00'),
(25, '2018-09-04 14:00:00', NULL, 0, 31, 29, '2018-09-01 00:00:00', '2018-09-01 00:00:00'),
(26, '2018-09-04 18:00:00', NULL, 0, 38, 32, '2018-09-03 00:00:00', '2018-09-03 00:00:00'),
(27, '2018-09-06 13:30:00', '*Customer said he is low in budget.', 0, 39, 33, '2018-09-05 00:00:00', '2018-09-05 00:00:00'),
(28, '2018-09-10 19:00:00', NULL, 0, 27, 29, '2018-09-08 00:00:00', '2018-09-08 00:00:00'),
(29, '2018-09-21 14:43:00', 'call b4 going', 0, 79, 116, '2018-09-20 00:00:00', '2018-09-20 00:00:00'),
(30, '2018-09-22 17:42:00', 'call', 0, 80, 116, '2018-09-20 00:00:00', '2018-09-20 00:00:00'),
(31, '2018-09-22 17:42:00', 'call', 0, 80, 116, '2018-09-20 00:00:00', '2018-09-20 00:00:00'),
(32, '2018-09-24 12:15:00', 'meeting with the CEO of the company', 0, 85, 29, '2018-09-22 00:00:00', '2018-09-22 00:00:00'),
(33, '2018-10-03 12:30:00', NULL, 0, 92, 32, '2018-09-25 00:00:00', '2018-09-25 00:00:00'),
(34, '2018-09-28 18:00:00', NULL, 0, 10, 32, '2018-09-27 00:00:00', '2018-09-27 00:00:00'),
(35, '2018-10-01 14:00:00', 'Want to discuss about how our services could be helpful for his restaurant', 0, 22, 29, '2018-09-27 00:00:00', '2018-09-27 00:00:00'),
(36, '2018-09-27 15:00:00', 'Going to visit our office', 0, 104, 29, '2018-09-27 00:00:00', '2018-09-27 00:00:00'),
(37, '2018-10-02 15:00:00', NULL, 0, 117, 32, '2018-10-01 00:00:00', '2018-10-01 00:00:00'),
(38, '2018-10-03 19:00:00', 'Recently opened restaurant 3 weeks back and they are looking for Website development and social media activation in a smaller scale for now and for larger scales after the better relationship with us. We also need to give them an idea to develop mobile application for the customers to make them handy', 0, 132, 163, '2018-10-03 00:00:00', '2018-10-03 00:00:00'),
(39, '2018-10-08 20:45:00', 'He wants to know how we will be providing him with Quality Leads and how much we charge per keyword (SEO Services) and stuff. I have not told him about our packages details.', 0, 135, 32, '2018-10-04 00:00:00', '2018-10-04 00:00:00'),
(41, '2018-10-10 11:00:00', 'He wants to see our Previous work and how we will boost his Digital Presence.', 0, 141, 32, '2018-10-04 00:00:00', '2018-10-04 00:00:00'),
(42, '2018-10-10 14:00:00', NULL, 0, 140, 116, '2018-10-04 00:00:00', '2018-10-04 00:00:00'),
(43, '2018-10-09 14:00:00', NULL, 0, 140, 116, '2018-10-05 00:00:00', '2018-10-05 00:00:00'),
(44, '2018-10-17 11:00:00', NULL, 0, 144, 32, '2018-10-05 00:00:00', '2018-10-05 00:00:00'),
(45, '2018-10-17 11:00:00', NULL, 0, 144, 32, '2018-10-06 00:00:00', '2018-10-06 00:00:00'),
(46, '2018-10-08 18:30:00', NULL, 0, 146, 32, '2018-10-08 00:00:00', '2018-10-08 00:00:00'),
(47, '2018-10-15 15:00:00', 'Need to meet him with Proposal & Solution for his problem', 0, 140, 209, '2018-10-10 00:00:00', '2018-10-10 00:00:00'),
(48, '2018-10-18 17:00:00', NULL, 0, 150, 194, '2018-10-16 00:00:00', '2018-10-16 00:00:00'),
(49, '2018-10-30 14:00:00', NULL, 0, 155, 219, '2018-10-26 00:00:00', '2018-10-26 00:00:00'),
(50, '2019-02-17 00:00:00', 'A meeting scheduled with Saima Adnan For Website Development and Social Media Marketing', 0, 166, 230, '2019-02-14 00:00:00', '2019-02-14 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_user`
--

CREATE TABLE `appointment_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointment_user`
--

INSERT INTO `appointment_user` (`id`, `appointment_id`, `user_id`) VALUES
(9, 33, 38),
(10, 34, 38),
(11, 35, 38),
(12, 35, 116),
(13, 36, 38),
(14, 36, 81),
(15, 36, 116),
(16, 37, 38),
(17, 37, 116),
(18, 38, 38),
(19, 38, 81),
(20, 38, 116),
(21, 39, 38),
(22, 39, 81),
(23, 39, 116),
(24, 40, 38),
(25, 40, 81),
(26, 40, 116),
(27, 41, 38),
(28, 41, 81),
(29, 41, 116),
(30, 42, 116),
(31, 43, 116),
(32, 44, 38),
(33, 44, 81),
(34, 44, 116),
(35, 45, 38),
(36, 45, 81),
(37, 45, 116),
(38, 46, 38),
(39, 46, 81),
(40, 46, 116),
(41, 47, 116),
(42, 48, 38),
(43, 49, 38),
(44, 49, 81),
(45, 50, 38);

-- --------------------------------------------------------

--
-- Table structure for table `attendancelogs`
--

CREATE TABLE `attendancelogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `attendancedate` timestamp NULL DEFAULT NULL,
  `attendancetime` timestamp NULL DEFAULT NULL,
  `machineuserid` int(11) DEFAULT NULL COMMENT 'Attendance id in machine',
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `attendancedate` timestamp NULL DEFAULT NULL,
  `attendancetime` time DEFAULT NULL,
  `machineuserid` int(11) DEFAULT NULL COMMENT 'Attendance id in machine',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendancesheetapprovals`
--

CREATE TABLE `attendancesheetapprovals` (
  `id` int(10) UNSIGNED NOT NULL,
  `ref_id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `dated` date NOT NULL,
  `dayname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendancedate` timestamp NULL DEFAULT NULL,
  `checkin` time DEFAULT NULL,
  `checkout` time DEFAULT NULL,
  `breakout` time DEFAULT NULL,
  `breakin` time DEFAULT NULL,
  `tardies` int(11) NOT NULL DEFAULT 0,
  `shortleaves` int(11) NOT NULL DEFAULT 0,
  `workedhours` int(11) NOT NULL DEFAULT 0,
  `checkoutfound` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid` int(11) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approvestatus` tinyint(1) DEFAULT 0,
  `isupdated` tinyint(1) NOT NULL DEFAULT 0,
  `approvedby` int(11) DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendancesheets`
--

CREATE TABLE `attendancesheets` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `dated` date NOT NULL,
  `dayname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendancedate` timestamp NULL DEFAULT NULL,
  `checkin` time DEFAULT NULL,
  `checkout` time DEFAULT NULL,
  `breakout` time DEFAULT NULL,
  `breakin` time DEFAULT NULL,
  `shortleaves` int(11) NOT NULL DEFAULT 0,
  `tardies` int(11) NOT NULL DEFAULT 0,
  `workedhours` int(11) NOT NULL DEFAULT 0,
  `checkoutfound` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid` int(11) DEFAULT NULL,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isupdated` tinyint(1) NOT NULL DEFAULT 0,
  `modifiedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendancesheets`
--

INSERT INTO `attendancesheets` (`id`, `user_id`, `dated`, `dayname`, `attendancedate`, `checkin`, `checkout`, `breakout`, `breakin`, `shortleaves`, `tardies`, `workedhours`, `checkoutfound`, `status`, `paid`, `remarks`, `created_at`, `updated_at`, `isupdated`, `modifiedby`) VALUES
(13, 807, '2019-10-04', NULL, '2019-10-03 19:00:00', '10:10:00', '10:10:00', NULL, NULL, 0, 0, 8, 'Yes', 'P', 1, 'P', '2019-10-04 11:00:39', '2019-10-04 11:00:39', 1, 1),
(14, 807, '2019-10-05', NULL, '2019-10-04 19:00:00', '10:10:00', '10:10:00', NULL, NULL, 0, 0, 8, 'Yes', 'P', 1, 'p', '2019-10-04 11:14:17', '2019-10-04 11:14:17', 1, 1),
(15, 807, '0332-03-31', NULL, '0000-00-00 00:00:00', '00:00:10', '00:00:10', NULL, NULL, 10, 0, 0, 'Yes', 'P', 1, 'P', '2019-10-05 11:36:21', '2019-10-05 11:36:21', 1, 1),
(16, 807, '2019-10-06', NULL, '2019-10-05 19:00:00', '00:00:10', '00:00:10', NULL, NULL, 0, 0, 8, 'Yes', 'P', 1, 'p', '2019-10-05 11:36:57', '2019-10-05 11:36:57', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `authentication_log`
--

CREATE TABLE `authentication_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `authenticatable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authenticatable_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL,
  `logout_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authentication_log`
--

INSERT INTO `authentication_log` (`id`, `authenticatable_type`, `authenticatable_id`, `ip_address`, `user_agent`, `login_at`, `logout_at`) VALUES
(3685, 'App\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', '2019-08-30 12:04:43', NULL),
(3686, 'App\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.100 Safari/537.36', '2019-09-05 09:59:52', NULL),
(3687, 'App\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '2019-09-23 08:18:23', '2019-09-23 13:27:16'),
(3688, 'App\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '2019-09-23 13:27:56', '2019-09-23 13:37:24'),
(3689, 'App\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:68.0) Gecko/20100101 Firefox/68.0', '2019-09-23 13:38:09', NULL),
(3690, 'App\\User', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-01 10:09:16', NULL),
(3691, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-02 04:46:34', NULL),
(3692, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-02 07:52:28', NULL),
(3693, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-04 04:03:39', NULL),
(3694, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-05 04:16:59', NULL),
(3695, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-05 10:40:34', '2019-10-05 10:56:01'),
(3696, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-05 10:57:11', NULL),
(3697, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-07 09:30:25', NULL),
(3698, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-08 03:58:34', NULL),
(3699, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-09 03:57:55', NULL),
(3700, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-10 04:21:54', NULL),
(3701, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-11 04:25:39', NULL),
(3702, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-12 04:29:45', NULL),
(3703, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-14 06:04:18', NULL),
(3704, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.90 Safari/537.36', '2019-10-15 05:40:53', NULL),
(3705, 'App\\User', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', '2019-10-16 04:45:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `chart_of_account_id` int(11) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `account_title` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `chart_of_account_id`, `account_number`, `account_title`, `bank_name`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 62, '00081005976032', 'Zeb Fortunes Pvt. Ltd.', 'Bank Al-Falah', 'Rehmanabad Branch Rawalpindi Pakistan', 'Active', '2018-12-14 02:47:05', '2019-03-04 07:56:59'),
(2, 200, '3493057519', 'NIKU SOLUTIONS', 'UOB', 'SINGAPORE', 'Active', '2019-02-21 07:44:53', '2019-02-21 07:50:35'),
(3, 152, '244700-78091803', 'Zeb Fortunes', 'Habib Bank Ltd', 'Rehmanabad Branch Rawalpindi Pakistan', 'Active', '2019-03-04 07:56:24', '2019-03-04 07:57:13'),
(4, 107, '0008-1006485388', 'Current Account-Aisha Imran (0008-1006485388)', 'Bank Alfalah', 'Satellite Town, Rawalpindi', 'Active', '2019-03-04 07:56:24', '2019-03-20 09:50:53'),
(5, 108, '0008-1006485389', 'Current Account-Kanwal Ashraf (0008-1006485389)', 'Bank Alfalah', 'Satellite Town, Rawalpindi', 'Active', '2019-03-04 07:56:24', '2019-03-20 12:03:59'),
(6, 178, '140764', 'Imran Zeb (140764)', 'JS Bank', 'Satellite Town, Rawalpindi', 'Active', '2019-03-04 07:56:24', '2019-03-20 12:06:42'),
(7, 189, '0803-0102896103', 'Meezan Bank (0803-0102896103)', 'Meezan bank', 'Satellite Town, Rawalpindi', 'Active', '2019-03-04 07:56:24', '2019-03-20 12:04:33'),
(8, 192, '07-02-46 17622512', 'Imran Zeb', 'Nationwide', 'U.K', 'Active', '2019-03-04 07:56:24', '2019-03-20 12:06:16'),
(9, 276, '', 'Remmitted to UOB', '', '', 'Active', '2019-04-13 12:36:46', '2019-04-13 12:36:46'),
(10, 288, '', 'UOB Bank - Singapore', '', '', 'Active', '2019-05-11 09:42:32', '2019-05-11 09:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `budgetcategories`
--

CREATE TABLE `budgetcategories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_link` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `sort_order` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budgetcategories`
--

INSERT INTO `budgetcategories` (`id`, `category_name`, `category_link`, `parent_id`, `sort_order`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Hanging and odd jobs', NULL, 0, NULL, 'Active', 0, '2018-12-13 12:48:21', '2018-12-12 01:53:48'),
(2, 'TV wall mounting', NULL, 1, NULL, 'Active', 0, '2018-12-14 06:37:37', '2018-12-14 01:37:37'),
(3, 'Blinds & curtains fitting', NULL, 1, NULL, 'Active', 0, '2018-12-12 01:56:30', '2018-12-12 01:56:30'),
(4, 'Director Salaries', NULL, 0, NULL, 'Active', 0, '2018-12-15 09:56:31', '2018-12-15 04:56:31'),
(5, 'Shahid Umar', NULL, 4, NULL, 'Active', 0, '2018-12-15 09:57:41', '2018-12-15 04:57:41'),
(6, 'Operating Expense', NULL, 0, NULL, 'Active', 0, '2018-12-15 09:51:43', '2018-12-15 04:51:43'),
(7, 'Medical Eshaal', NULL, 6, NULL, 'Active', 0, '2018-12-15 09:54:16', '2018-12-15 04:54:16'),
(8, 'Plumbing services', NULL, 0, NULL, 'Active', 0, '2018-12-13 12:48:34', '2018-12-12 02:00:33'),
(9, 'Sinks and basins fitting and replacement', NULL, 8, NULL, 'Active', 0, '2018-12-12 02:01:36', '2018-12-12 02:01:36'),
(11, 'Medical Expense Office', NULL, 6, NULL, 'Active', 0, '2018-12-15 04:55:37', '2018-12-15 04:55:37'),
(12, 'Shahid Iqbal', NULL, 4, NULL, 'Active', 0, '2018-12-15 04:58:11', '2018-12-15 04:58:11'),
(13, 'Amir Developer', NULL, 4, NULL, 'Active', 0, '2018-12-15 04:58:33', '2018-12-15 04:58:33'),
(14, 'Operation Expences', NULL, 0, NULL, 'Active', 0, '2019-02-20 10:25:51', '2019-02-20 10:25:51'),
(15, 'Mobile Bills', NULL, 6, NULL, 'Active', 0, '2019-02-20 10:26:05', '2019-02-20 10:26:05'),
(16, 'Electricity Bills', NULL, 6, NULL, 'Active', 0, '2019-02-20 10:26:17', '2019-02-20 10:26:17'),
(17, 'dummy entry', NULL, 1, NULL, 'Active', 0, '2019-03-19 13:20:05', '2019-03-19 13:20:05');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chart_of_account`
--

CREATE TABLE `chart_of_account` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `default_type` varchar(255) DEFAULT NULL COMMENT 'debit,credit',
  `is_transactionable` varchar(255) DEFAULT NULL,
  `is_default` varchar(255) DEFAULT NULL,
  `opening_balance` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_deleted` varchar(255) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_of_account`
--

INSERT INTO `chart_of_account` (`id`, `category_name`, `account_name`, `parent_id`, `default_type`, `is_transactionable`, `is_default`, `opening_balance`, `balance`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Assets', 0, 'Debit', '0', '1', '0', '0', 'Active', '0', '2019-01-30 05:17:47', '2019-02-10 23:43:09'),
(2, NULL, 'Liabilities', 0, NULL, '0', '1', '0', '0', 'Active', '0', '2019-01-30 05:17:47', '2019-01-30 05:17:47'),
(3, NULL, 'Expense', 0, NULL, '0', '1', '0', '0', 'Active', '0', '2019-01-30 05:18:23', '2019-01-30 05:18:23'),
(4, NULL, 'Income', 0, NULL, '0', '1', '0', '0', 'Active', '0', '2019-01-30 05:19:47', '2019-01-30 05:19:47'),
(5, NULL, 'Capital', 0, NULL, '0', '1', '0', '0', 'Active', '0', '2019-01-30 05:19:47', '2019-01-30 05:19:47'),
(18, NULL, 'Staff Salaries', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-10 23:39:30', '2019-03-23 10:30:34'),
(21, NULL, 'Account Payable- Mr. Imran Zeb', 48, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-10 23:42:48', '2019-03-05 09:35:32'),
(22, NULL, 'Mobile Bills', 92, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-20 10:17:49', '2019-02-21 07:52:58'),
(23, NULL, 'Mobile Bill (0344-9997774)', 22, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-20 10:18:31', '2019-02-27 13:04:45'),
(24, NULL, 'Mobile Bill (0336-9997774)', 22, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-20 10:18:50', '2019-02-27 13:21:55'),
(25, NULL, 'Books', 1, 'Debit', '1', NULL, '0', '0', 'Active', '1', '2019-02-20 11:09:31', '2019-03-21 13:44:44'),
(26, NULL, 'Partial Salaries', 18, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 11:12:37', '2019-02-20 11:12:37'),
(27, NULL, 'Prepaid Expenses', 1, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-20 11:35:41', '2019-02-20 11:35:41'),
(28, NULL, 'Advance Tax Paid', 27, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 11:38:05', '2019-02-23 09:21:01'),
(30, NULL, 'Administrative Expenses', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-20 11:48:25', '2019-02-20 11:48:25'),
(31, NULL, 'Advertisement Charges', 3, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 11:50:24', '2019-02-20 11:50:24'),
(32, NULL, 'Office Equipment', 1, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-20 11:53:51', '2019-02-20 11:53:51'),
(33, NULL, 'Air Conditions', 32, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 11:54:22', '2019-02-23 09:22:35'),
(34, NULL, 'Accrued Expenses', 2, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 11:57:42', '2019-02-20 11:59:37'),
(35, NULL, 'Accounts Payables', 2, 'Credit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-20 12:01:03', '2019-02-20 12:01:03'),
(36, NULL, 'Account Payable- The OUTLET', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:02:03', '2019-02-20 12:02:03'),
(37, NULL, 'Account Payable- Kuttong', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:02:44', '2019-02-20 12:02:44'),
(38, NULL, 'Account Payable- Gulshan Sittra', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:03:25', '2019-02-20 12:03:25'),
(39, NULL, 'Account Payable- Mrs. Ayesha Imran', 48, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:04:03', '2019-03-05 09:35:41'),
(40, NULL, 'Account Payable- Mr. Shahid Iqbal', 48, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:04:47', '2019-03-05 09:35:53'),
(41, NULL, 'Account Payable- Mr. Adnan Zeb', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:06:34', '2019-02-20 12:06:34'),
(42, NULL, 'Account Payable- Mr. Faheem', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:07:22', '2019-02-20 12:07:22'),
(43, NULL, 'Account Payable- Mr. Faisal (Lahore Shoes)', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:07:54', '2019-02-20 12:07:54'),
(44, NULL, 'Account Payable- Mr. Jahanzeb', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:08:23', '2019-02-20 12:08:23'),
(45, NULL, 'Account Payable- Mr. Kashif', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:08:56', '2019-02-20 12:08:56'),
(46, NULL, 'Account Payable- Mr. Mashood', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:09:25', '2019-02-20 12:09:25'),
(47, NULL, 'Account Payable- Mr. Moazam', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:09:53', '2019-02-20 12:09:53'),
(48, NULL, 'Directors Account Payables', 2, 'Credit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-20 12:15:05', '2019-02-20 12:15:05'),
(49, NULL, 'Account Payable- Mr. Tahir Abbasi', 48, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:16:46', '2019-02-20 12:16:46'),
(50, NULL, 'Accounts Payable-Mr Shahid Umar', 48, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:19:07', '2019-03-05 09:36:08'),
(51, NULL, 'Account Payable-', 48, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:21:34', '2019-03-05 09:36:17'),
(52, NULL, 'Account Payable- Mr. Zain', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:22:52', '2019-02-20 12:22:52'),
(53, NULL, 'Account Payable-Mr.Zahid Khan', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:23:16', '2019-03-05 09:34:16'),
(54, NULL, 'Account Payable- Sehrish Zeb', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:26:21', '2019-02-20 12:26:21'),
(55, NULL, 'Account Payable- Mr. Ramzan Khan', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:27:04', '2019-02-23 09:28:56'),
(56, NULL, 'Account Receivables', 1, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 12:30:02', '2019-03-29 06:02:49'),
(57, NULL, 'Prepaid Expenses', 1, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-20 14:02:53', '2019-03-05 09:24:05'),
(58, NULL, 'Account Receivable - Fajar-2-Isha', 56, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:23:44', '2019-02-21 07:23:44'),
(59, NULL, 'Account Receivable - Mr. Naveed Tareen', 56, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:24:14', '2019-02-23 09:31:07'),
(60, NULL, 'Salary Adjustment', 18, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:25:24', '2019-02-21 07:25:24'),
(61, NULL, 'Bank', 1, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 07:26:24', '2019-02-21 07:26:24'),
(62, NULL, 'Bank Alfalah (1005976032)', 61, 'Debit', '1', NULL, '2105011', '2105011', 'Active', '0', '2019-02-21 07:26:43', '2019-04-17 14:02:09'),
(63, NULL, 'Bank Charges', 3, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:27:31', '2019-02-21 07:27:31'),
(64, NULL, 'Installments', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 07:28:33', '2019-02-21 07:28:33'),
(65, NULL, 'Bank Islami - Home Installments', 64, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:28:53', '2019-02-21 07:28:53'),
(66, NULL, 'Bike-Honda 70', 32, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:29:43', '2019-03-05 08:33:41'),
(67, NULL, 'Bike-US 70', 32, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:30:17', '2019-02-21 07:30:17'),
(68, NULL, 'Account Payable - Raja Arshad', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:30:51', '2019-03-06 07:19:40'),
(69, NULL, 'Capital-Mr. Imran Zeb', 5, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:31:33', '2019-02-21 07:31:33'),
(70, NULL, 'Capital-Mr. Malik Naeem', 5, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:31:56', '2019-03-29 09:59:19'),
(71, NULL, 'Capital-Mr. Shahid Iqbal', 5, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:32:19', '2019-02-21 07:32:19'),
(72, NULL, 'Capital-Mr. Shahid Umar', 5, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:32:47', '2019-02-21 07:32:47'),
(73, NULL, 'Carriage Inwards', 3, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:33:37', '2019-02-21 07:33:37'),
(74, NULL, 'Rent', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 07:34:13', '2019-02-21 07:34:13'),
(75, NULL, 'Car Rent-ANZ Travel Related Services', 74, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:34:37', '2019-02-21 07:34:37'),
(76, NULL, 'Car Rent-Belta Car (Ghulam Rasool)', 74, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:35:02', '2019-02-21 07:35:02'),
(77, NULL, 'Cash', 1, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 07:35:47', '2019-02-21 07:35:47'),
(78, NULL, 'Cash in Hand', 77, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:36:08', '2019-02-21 07:36:08'),
(79, NULL, 'CCTV - Camera Installation', 32, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:36:40', '2019-03-05 09:21:57'),
(80, NULL, 'Petty Cash-Amir', 77, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:37:08', '2019-02-21 07:37:08'),
(81, NULL, 'Charity & Donation', 3, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:38:15', '2019-02-21 07:38:15'),
(82, NULL, 'Car Rental - Civic LEB444', 74, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 07:40:35', '2019-02-21 07:40:35'),
(83, NULL, 'Commission Expense', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 07:42:36', '2019-02-21 07:42:36'),
(84, NULL, 'Committed Payables', 2, 'Credit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 07:43:50', '2019-02-21 07:43:50'),
(85, NULL, 'Committed Payables-Al-Mutahr', 84, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:44:22', '2019-02-21 07:44:22'),
(86, NULL, 'Committed Payables-Committee Expense', 84, 'Credit', '1', NULL, '0', '0', 'Active', '1', '2019-02-21 07:44:46', '2019-03-23 10:29:06'),
(87, NULL, 'Committed Payables-General', 84, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:45:21', '2019-02-21 07:45:21'),
(88, NULL, 'Committed Payables-Honda-70', 84, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:46:05', '2019-03-06 05:46:56'),
(89, NULL, 'Committed Payables-Madina Electronics', 84, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:46:29', '2019-02-21 07:46:29'),
(90, NULL, 'Committed Payables-Sami Electronics', 84, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:46:50', '2019-02-21 07:46:50'),
(91, NULL, 'Committed Payables-Refrigeratr 350 DM', 84, 'Credit', '1', NULL, '0', '0', 'Active', '1', '2019-02-21 07:47:18', '2019-03-23 10:28:55'),
(92, NULL, 'Communication Expense', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 07:50:31', '2019-02-21 07:50:31'),
(93, NULL, 'Communication-Conexiant', 92, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:53:47', '2019-02-21 07:53:47'),
(94, NULL, 'Communication-DID Logic', 92, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:54:12', '2019-02-21 07:54:12'),
(95, NULL, 'Communication-H.Vision', 92, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 07:54:36', '2019-02-21 07:54:36'),
(96, NULL, 'Communication-Mobile Recharge', 22, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:55:10', '2019-02-21 07:55:10'),
(97, NULL, 'Communication-Singtel', 92, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:55:41', '2019-02-21 07:55:41'),
(98, NULL, 'Communication-Ufone', 92, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:56:29', '2019-02-21 07:56:29'),
(99, NULL, 'Repair & Maintenance', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 07:57:58', '2019-02-21 07:57:58'),
(100, NULL, 'Computer Accessories- Dongles', 27, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 07:59:55', '2019-03-05 09:22:08'),
(101, NULL, 'Computers', 32, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:00:12', '2019-03-05 09:29:51'),
(102, NULL, 'Legal Expenses', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:01:00', '2019-02-21 08:01:00'),
(103, NULL, 'Consultancy-Legal Services', 102, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:01:21', '2019-02-21 08:01:21'),
(104, NULL, 'Consultancy-Tax Services', 102, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:01:44', '2019-02-21 08:01:44'),
(105, NULL, 'Crockery', 32, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:02:14', '2019-02-21 08:02:14'),
(106, NULL, 'Directors Current Account', 121, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:03:45', '2019-02-21 11:02:32'),
(107, NULL, 'Current Account-Aisha Imran (0008-1006485388)', 61, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:04:34', '2019-03-05 09:24:18'),
(108, NULL, 'Current Account-Kanwal Ashraf (0008-1006485389)', 61, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:05:00', '2019-03-05 09:25:09'),
(109, NULL, 'Current Account-Mr. Azeem Khan', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:05:25', '2019-03-05 09:33:59'),
(110, NULL, 'Current Account-Mr. Malik Naeem', 106, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:05:54', '2019-02-21 11:06:03'),
(111, NULL, 'Current Account-Mr. Imran Zeb', 106, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:06:16', '2019-02-25 08:04:58'),
(112, NULL, 'Current Account-Mr. Shahid Iqbal', 106, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:06:38', '2019-02-21 08:06:38'),
(113, NULL, 'Current Account-Mr. Shahid Umar', 106, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:06:59', '2019-02-21 12:57:32'),
(114, NULL, 'Current Account-Mr. Tahir Abbasi', 106, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:07:24', '2019-02-25 08:47:17'),
(115, NULL, 'Depreciation Expenses', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:08:43', '2019-02-21 08:08:43'),
(116, NULL, 'Depreciation-Bikes', 115, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:09:11', '2019-02-21 08:09:11'),
(117, NULL, 'Depreciation-Furniture & Fixtures', 115, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:09:32', '2019-02-21 08:09:32'),
(118, NULL, 'Depreciation-Generators', 115, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:09:55', '2019-02-21 08:09:55'),
(119, NULL, 'Depreciation-Office Equipments', 115, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:10:20', '2019-02-21 08:10:20'),
(120, NULL, 'DIBP- Home Affairs Application Fees', 102, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:11:11', '2019-02-21 08:11:11'),
(121, NULL, 'Director Expenses', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:13:29', '2019-02-21 08:13:29'),
(122, NULL, 'Director Salaries', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:13:49', '2019-02-21 08:13:49'),
(123, NULL, 'Director\'s Loan', 84, 'Credit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:14:24', '2019-02-26 11:37:03'),
(124, NULL, 'Director Entertainment', 121, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:14:50', '2019-02-21 08:14:50'),
(125, NULL, 'Director Incentive', 121, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:15:33', '2019-03-06 07:04:09'),
(126, NULL, 'Director Loan-Mr. Imran Zeb', 123, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:16:12', '2019-02-21 08:16:12'),
(127, NULL, 'Director Loan-Mr. Malik Naeem', 123, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:16:36', '2019-02-26 11:38:02'),
(128, NULL, 'Director Loan-Mr. Shahid Iqbal', 123, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:17:01', '2019-02-26 11:38:27'),
(129, NULL, 'Director Loan-Mr. Shahid Umar', 123, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:17:27', '2019-02-26 11:38:49'),
(130, NULL, 'Dirctor Salary-Mr. Imran Zeb', 122, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:18:02', '2019-02-27 13:14:21'),
(131, NULL, 'Dirctor Salary-Mr. Malik Naeem', 122, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:18:31', '2019-02-27 13:14:44'),
(132, NULL, 'Dirctor Salary-Mr. Shahid Iqbal', 122, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:19:02', '2019-02-27 13:15:05'),
(133, NULL, 'Dirctor Salary-Mr. Tahir Abbasi', 122, 'Debit', '1', NULL, NULL, NULL, 'Active', '0', '2019-02-21 08:19:23', '2019-02-27 13:15:55'),
(134, NULL, 'Electrical Equipements-UPS', 32, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:21:12', '2019-02-21 08:21:12'),
(135, NULL, 'Faysal Bank-credit card payment', 64, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:21:32', '2019-03-29 06:00:54'),
(136, NULL, 'Electrical Equipements-Refrigeratr 350 DM', 27, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:21:51', '2019-03-05 09:22:41'),
(137, NULL, 'Utility Bills', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:26:56', '2019-02-21 08:26:56'),
(138, NULL, 'Electricity Bills', 137, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:28:05', '2019-02-21 08:28:05'),
(139, NULL, 'Electricity Expense', 99, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:30:25', '2019-03-05 08:31:34'),
(140, NULL, 'Ex-Employees Salaries', 18, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:32:53', '2019-03-06 05:45:12'),
(141, NULL, 'Fee & Subscriptions', 92, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:48:37', '2019-02-21 08:48:37'),
(142, NULL, 'Fuel & Lubricant', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 08:50:08', '2019-02-21 08:50:08'),
(143, NULL, 'Fuel & Lubricant-Bikes', 142, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:50:45', '2019-02-21 08:50:45'),
(144, NULL, 'Fuel & Lubricant-Cars', 142, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:51:12', '2019-03-27 09:18:16'),
(145, NULL, 'Fuel & Lubricant-Gas Refil', 142, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:51:44', '2019-03-27 09:19:42'),
(146, NULL, 'Fuel & Lubricant-Generators', 142, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:52:07', '2019-03-27 09:20:02'),
(147, NULL, 'Furniture & Fixtures', 99, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:53:08', '2019-02-21 08:53:08'),
(148, NULL, 'Fly Dreams - Umar Tariq', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:53:44', '2019-03-05 09:34:31'),
(149, NULL, 'Generators', 64, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:54:17', '2019-03-29 06:01:10'),
(150, NULL, 'Generator Rent', 74, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:54:47', '2019-04-29 07:14:11'),
(151, NULL, 'Gift Money - Mr. Luqman', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 08:56:02', '2019-03-05 09:35:07'),
(152, NULL, 'HBL (24470078091803)', 61, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:02:34', '2019-02-21 09:02:34'),
(153, NULL, 'Mobile - Huawei Y5 Lite', 27, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:03:10', '2019-03-05 09:23:14'),
(154, NULL, 'Staff Gift & Rewards', 83, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 09:03:50', '2019-02-21 09:03:50'),
(155, NULL, 'Income-Explore Visa', 4, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:04:25', '2019-03-29 09:57:59'),
(156, NULL, 'E-Bay Payment- Amir Rasool', 4, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:05:22', '2019-03-29 09:58:08'),
(157, NULL, 'Income-Upwork', 4, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:05:56', '2019-03-29 09:58:15'),
(158, NULL, 'Income-YCC-Paypal', 4, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:06:33', '2019-03-29 09:58:24'),
(159, NULL, 'Income-YCC-Physical', 4, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:07:00', '2019-02-25 13:27:11'),
(160, NULL, 'Income-YCC-Bank', 4, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:07:22', '2019-03-29 09:58:38'),
(161, NULL, 'Income-UOB', 4, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:07:45', '2019-03-29 09:58:46'),
(162, NULL, 'Income-TSB', 4, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:08:11', '2019-02-21 09:08:11'),
(163, NULL, 'Interest Charges', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 09:13:27', '2019-02-21 09:13:27'),
(164, NULL, 'Interest on laon', 163, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:14:03', '2019-02-21 09:14:03'),
(165, NULL, 'Internet Security Deposit', 4, 'Debit', NULL, NULL, '0', '0', 'Active', '1', '2019-02-21 09:15:42', '2019-03-21 04:13:06'),
(166, NULL, 'Internet Expenses', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 09:21:15', '2019-02-21 09:21:15'),
(167, NULL, 'Nayatel', 166, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 09:21:55', '2019-02-21 09:21:55'),
(168, NULL, 'Fiber link', 166, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:22:22', '2019-03-29 05:15:04'),
(169, NULL, 'Comsats', 166, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:22:45', '2019-02-21 09:22:45'),
(170, NULL, 'MultiNet', 166, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:23:12', '2019-03-29 09:52:27'),
(171, NULL, 'Nayatel Fortunes', 167, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:23:56', '2019-02-21 09:23:56'),
(172, NULL, 'Nayatel Fortunes 1', 167, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:24:30', '2019-03-29 05:13:42'),
(173, NULL, 'Nayatel Fortunes 2', 167, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:24:58', '2019-03-29 05:13:57'),
(174, NULL, 'Nayatel Fortunes 2A', 167, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:25:25', '2019-03-29 05:14:12'),
(175, NULL, 'Nayatel Bastech', 167, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:26:01', '2019-03-29 05:14:28'),
(176, NULL, 'Nayatel Bastech 1', 167, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:26:20', '2019-03-29 05:14:45'),
(177, NULL, 'Installment-Honda-70', 64, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:28:08', '2019-02-21 09:28:08'),
(178, NULL, 'JS Bank - 140764', 61, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:28:36', '2019-03-05 09:25:36'),
(179, NULL, 'Janitorial Services', 30, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:29:32', '2019-03-05 08:33:19'),
(180, NULL, 'Kashif Installment - Laptop', 64, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:30:28', '2019-03-27 09:23:59'),
(181, NULL, 'Interest on installment', 163, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:34:22', '2019-02-21 09:34:22'),
(182, NULL, 'Kashif Installment - Bike', 3, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:34:46', '2019-03-27 09:24:36'),
(183, NULL, 'Kashif Installment - Mobile', 64, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:35:08', '2019-03-27 09:24:53'),
(184, NULL, 'Labour & Wages', 18, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:36:04', '2019-03-06 05:47:36'),
(185, NULL, 'Lahore Shoes', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:37:09', '2019-03-05 09:35:18'),
(186, NULL, 'Legal Fees', 102, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:37:46', '2019-05-11 09:07:03'),
(187, NULL, 'Laptop', 27, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:38:06', '2019-03-05 09:23:03'),
(188, NULL, 'Legal Charges', 102, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:38:39', '2019-03-26 10:44:01'),
(189, NULL, 'Meezan Bank (0803-0102896103)', 61, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:39:00', '2019-02-21 09:39:00'),
(190, NULL, 'Mobile Phones', 32, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:39:20', '2019-03-06 06:52:49'),
(191, NULL, 'Miscellaneous Expense', 3, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:39:52', '2019-02-21 09:39:52'),
(192, NULL, 'Nationwide Bank', 61, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:50:16', '2019-03-05 09:30:21'),
(193, NULL, 'Office  Security Deposit', 4, 'Debit', NULL, NULL, '0', '0', 'Active', '1', '2019-02-21 09:51:55', '2019-03-21 04:13:17'),
(194, NULL, 'Office Equipment', 1, 'Debit', '1', NULL, '0', '0', 'Active', '1', '2019-02-21 09:52:17', '2019-03-21 13:45:41'),
(195, NULL, 'Office Expense', 30, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:53:03', '2019-02-26 08:37:06'),
(196, NULL, 'Office Rent', 74, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:53:47', '2019-02-21 09:53:47'),
(197, NULL, 'Office Rent-Singapore', 74, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 09:54:09', '2019-02-21 09:54:09'),
(198, NULL, 'Ghauri Security Guards', 30, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:58:16', '2019-02-21 09:58:16'),
(199, NULL, 'Outstanding Expenses', 3, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:59:22', '2019-03-06 07:04:51'),
(200, NULL, 'Payment in UOB', 61, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 09:59:44', '2019-02-23 09:04:31'),
(201, NULL, 'Petty Cash - Zain', 77, 'Debit', '1', NULL, '0', '0', 'Disable', '0', '2019-02-21 10:00:32', '2019-03-29 10:07:05'),
(202, NULL, 'Petty Cash - jahanzaib', 77, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:00:53', '2019-03-05 09:31:29'),
(203, NULL, 'Stationary Expenses', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 10:02:13', '2019-02-21 10:02:13'),
(204, NULL, 'Photocopy Expense', 203, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:03:27', '2019-02-21 10:03:27'),
(205, NULL, 'Postage & Courier', 30, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 10:04:31', '2019-02-21 10:04:31'),
(206, NULL, 'Printing & Stationary', 203, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:05:02', '2019-02-21 10:05:02'),
(207, NULL, 'Prius - AAU435', 123, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:06:19', '2019-03-05 09:37:45'),
(208, NULL, 'Post Dated Cheques', 84, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:08:12', '2019-02-26 11:40:11'),
(209, NULL, 'Receivable against expenses', 56, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:20:26', '2019-03-05 09:23:52'),
(210, NULL, 'Re-issued Cheques', 121, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:28:14', '2019-03-06 07:05:06'),
(211, NULL, 'Renovation Expense', 99, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:29:16', '2019-03-05 08:31:49'),
(212, NULL, 'Rent Agreement', 30, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 10:30:28', '2019-02-21 10:30:28'),
(213, NULL, 'Rent, Rates & Taxes', 74, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 10:31:10', '2019-02-21 10:31:10'),
(214, NULL, 'Repair & Maintenance-General', 99, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:32:14', '2019-03-05 08:32:06'),
(215, NULL, 'Repair & Maintenance-Electrical Equipments', 99, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:33:00', '2019-02-21 10:33:00'),
(216, NULL, 'Repair & Maintenance-Furniture & Fixtures', 99, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:33:29', '2019-03-05 08:32:25'),
(217, NULL, 'Repair & Maintenance-Generators', 99, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:33:55', '2019-03-05 08:32:38'),
(218, NULL, 'Repair & Maintenance-IT', 99, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:35:17', '2019-03-05 08:30:21'),
(219, NULL, 'Repair & Maintenance-Office Equipments', 99, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:35:45', '2019-03-05 08:32:53'),
(220, NULL, 'Repair & Maintenance-UPS', 99, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:36:11', '2019-02-26 09:49:15'),
(221, NULL, 'Repair & Maintenance-Vehicle', 99, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:36:40', '2019-03-05 08:31:21'),
(222, NULL, 'Sales Incentive', 83, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 10:39:42', '2019-02-25 08:18:08'),
(223, NULL, 'Security Chq - Labor Court', 102, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 11:13:05', '2019-02-21 11:13:05'),
(224, NULL, 'Speed Money', 3, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 11:20:51', '2019-07-11 17:19:27'),
(225, NULL, 'Speed Money - Labor Court', 30, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 11:21:43', '2019-02-21 11:21:43'),
(226, NULL, 'Web Development Expenses', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 11:22:47', '2019-02-21 11:22:47'),
(227, NULL, 'SSL Certificate', 226, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 11:23:11', '2019-02-21 11:23:11'),
(228, NULL, 'Staff Bonuses', 83, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 11:23:44', '2019-02-21 11:23:44'),
(229, NULL, 'Staff Commission', 83, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 11:24:10', '2019-05-17 11:45:10'),
(230, NULL, 'Taxation', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 11:25:24', '2019-02-21 11:51:42'),
(231, NULL, 'U/S 235-28-14313-4289500', 230, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 11:53:57', '2019-02-21 11:53:57'),
(232, NULL, 'U/S 235-28-14313-4289600', 230, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 11:54:17', '2019-02-21 11:54:17'),
(233, NULL, 'Water Motor', 27, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 11:55:47', '2019-03-05 09:23:28'),
(234, NULL, 'Sui Gas Bills', 137, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 11:56:55', '2019-02-21 11:56:55'),
(235, NULL, 'Telephone Bills', 137, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 11:57:23', '2019-02-21 11:57:23'),
(236, NULL, 'Water Charges-AL-Mutahr', 137, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 11:58:41', '2019-02-21 11:58:41'),
(237, NULL, 'Water Charges', 137, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 12:04:03', '2019-02-21 12:04:03'),
(238, NULL, 'Water Tanker Refill', 137, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:04:29', '2019-02-25 08:20:07'),
(239, NULL, 'Web Hosting - NSOL S9', 226, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:04:59', '2019-02-21 12:04:59'),
(240, NULL, 'Web Hosting - Nexus', 226, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 12:05:18', '2019-02-21 12:05:18'),
(241, NULL, 'Expenses - Paypal', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 12:06:37', '2019-02-21 12:06:37'),
(242, NULL, 'Expense - UOB', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 12:06:58', '2019-02-21 12:06:58'),
(243, NULL, 'H-Vision', 241, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:09:39', '2019-02-21 12:09:39'),
(244, NULL, 'Datasoft Networks Inc', 241, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:10:48', '2019-03-29 09:55:02'),
(245, NULL, 'DID LOGIC', 241, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:11:21', '2019-02-21 12:11:21'),
(246, NULL, 'Hamza Ali Khan', 241, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:11:41', '2019-03-29 09:54:26'),
(247, NULL, 'PayPal Pte Ltd', 241, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:13:54', '2019-03-29 09:53:20'),
(248, NULL, 'SaferSocial Ltd.', 241, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 12:15:05', '2019-02-21 12:15:05'),
(249, NULL, 'Skype Communications Sarl', 241, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:15:28', '2019-02-21 12:15:28'),
(250, NULL, 'Zendesk Inc.', 241, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:20:02', '2019-02-21 12:20:02'),
(251, NULL, 'Powtoon ltd', 241, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 12:20:32', '2019-02-21 12:20:32'),
(252, NULL, '123-reg Limited', 241, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 12:20:59', '2019-02-21 12:20:59'),
(253, NULL, 'Atlantic.Net', 242, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:21:44', '2019-02-21 12:21:44'),
(254, NULL, 'Bing Ads', 242, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:22:05', '2019-04-27 11:15:02'),
(255, NULL, 'SEM RUSH', 242, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:22:31', '2019-02-21 12:22:31'),
(256, NULL, 'IRAS Tax-Mr. Shahid Iqbal (From UOB)', 242, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:22:51', '2019-04-27 11:14:46'),
(257, NULL, 'Regus (Office Rent)', 242, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:23:09', '2019-04-27 11:15:23'),
(258, NULL, 'OCBC', 242, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:23:27', '2019-05-11 08:55:14'),
(259, NULL, 'With Holding Tax (WHT)', 3, 'Debit', NULL, NULL, '0', '0', 'Active', '0', '2019-02-21 12:24:40', '2019-02-21 12:24:40'),
(260, NULL, 'WHT Office Rent', 259, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:25:06', '2019-02-21 12:25:06'),
(261, NULL, 'WHT Services & Supplies', 259, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:25:31', '2019-03-29 09:57:04'),
(262, NULL, 'WHT Staff Salaries', 259, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:25:59', '2019-03-29 09:57:23'),
(263, NULL, 'WHT on Cash Withdrawal', 259, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-21 12:26:20', '2019-03-29 09:57:37'),
(264, NULL, 'Services Charges', 3, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-23 09:02:30', '2019-02-23 09:02:30'),
(265, NULL, 'Staff  Salaries', 18, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-25 08:16:52', '2019-02-25 08:16:52'),
(266, NULL, 'Current Account-Sir Adnan', 106, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-25 08:31:24', '2019-02-25 08:35:47'),
(267, NULL, 'Petty Cash - Mr . Hassan', 77, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-02-26 09:16:28', '2019-02-26 09:16:28'),
(268, NULL, 'Dirctor Salary-Mr. Shahid Umar', 122, 'Debit', '1', NULL, NULL, NULL, 'Active', '0', '2019-02-27 13:17:49', '2019-02-27 13:17:49'),
(269, NULL, 'Petty Cash - Sir Mashood', 77, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-03-06 07:34:14', '2019-03-06 07:34:14'),
(270, NULL, 'depreciation-mobiles', 115, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-03-19 12:47:23', '2019-03-19 13:08:41'),
(271, NULL, 'crokery', 1, 'Debit', '1', NULL, '0', '0', 'Active', '1', '2019-03-21 13:45:22', '2019-03-21 13:45:31'),
(272, NULL, 'Travelling & Conveyance', 3, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-03-21 14:06:41', '2019-03-21 14:06:41'),
(273, NULL, 'Petty cash - Sheriyar', 77, 'Debit', '1', NULL, '0', '0', 'Active', '1', '2019-03-22 05:47:51', '2019-04-13 12:37:04'),
(274, NULL, 'Income-Nationwide', 4, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-03-23 10:41:01', '2019-03-23 10:41:01'),
(275, NULL, 'Staff Entertainment', 30, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-03-26 10:57:15', '2019-03-26 10:57:15'),
(276, NULL, 'Remmitted to UOB', 61, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-03-29 14:09:50', '2019-04-13 12:36:46'),
(277, NULL, 'Income From Canteen', 4, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-04-13 12:45:27', '2019-04-13 12:45:27'),
(278, NULL, 'canteen Exp', 30, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-04-13 12:47:11', '2019-04-13 12:47:11'),
(279, NULL, 'Postage & Courier', 30, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-04-18 13:17:50', '2019-04-18 13:17:50'),
(280, NULL, 'Staff Medical', 3, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-04-18 13:29:07', '2019-04-18 13:29:07'),
(281, NULL, 'Advance Against Salaries', 1, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-04-19 07:01:38', '2019-04-19 07:01:38'),
(282, NULL, 'WASA Bills', 137, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-04-20 09:10:37', '2019-04-20 09:10:37'),
(283, NULL, 'Sports and Entertainment', 121, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-04-26 12:07:08', '2019-04-26 12:07:08'),
(284, NULL, 'Account Payable - Laraib Aziz', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-04-27 11:02:13', '2019-04-27 11:02:13'),
(285, NULL, 'Petty Cash - Sir Shahid Iqbal', 77, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-04-29 07:55:36', '2019-04-29 08:08:14'),
(286, NULL, 'Petty Cash - Sir Tahir Abbasi', 77, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-04-29 08:14:31', '2019-04-29 08:14:31'),
(287, NULL, 'Nayatel Internet Bills', 167, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-05-04 12:20:40', '2019-05-04 12:20:40'),
(288, NULL, 'UOB Bank - Singapore', 61, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-05-11 09:42:32', '2019-05-11 09:42:32'),
(289, NULL, 'Account Payable - Mr Rehman', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-05-13 06:50:48', '2019-05-13 06:50:48'),
(290, NULL, 'petty Cash - Mr Umair', 77, 'Debit', '1', NULL, '0', '0', 'Active', '1', '2019-05-23 12:29:02', '2019-05-25 14:51:46'),
(291, NULL, 'Staff Loan - Ms Summaya Khanum', 56, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-05-24 06:58:19', '2019-05-24 06:58:19'),
(292, NULL, 'Wall Clocks', 32, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-05-25 06:10:21', '2019-05-25 06:10:21'),
(293, NULL, 'Gift Money', 83, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-05-25 06:17:09', '2019-05-25 06:17:09'),
(294, NULL, 'Crown Security Services', 30, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-06-13 18:17:52', '2019-06-13 18:17:52'),
(295, NULL, 'Income From NSOL', 4, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-06-19 11:41:20', '2019-06-19 11:41:20'),
(296, NULL, 'Petty Cash - Mr Raja Imran', 1, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-06-29 12:15:27', '2019-06-29 12:15:27'),
(297, NULL, 'Account Payable - Mr Ahmed Munir', 35, 'Credit', '1', NULL, '0', '0', 'Active', '0', '2019-07-11 18:43:17', '2019-07-11 18:43:17'),
(298, NULL, 'Petty Cash - Mr Salman', 77, 'Debit', '1', NULL, '0', '0', 'Active', '0', '2019-07-22 15:44:22', '2019-07-22 15:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `chat_rooms`
--

CREATE TABLE `chat_rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `room_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_room_feeds`
--

CREATE TABLE `chat_room_feeds` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `markasread` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_room_participants`
--

CREATE TABLE `chat_room_participants` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaintcomments`
--

CREATE TABLE `complaintcomments` (
  `id` int(11) NOT NULL,
  `complaint_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `consume_budget`
--

CREATE TABLE `consume_budget` (
  `id` int(11) NOT NULL,
  `budgetcategory_id` int(11) DEFAULT NULL,
  `allocate_amount` int(11) DEFAULT NULL,
  `consumed_amount` int(11) DEFAULT 0,
  `remaining_amount` int(11) DEFAULT NULL,
  `required_amount` int(11) DEFAULT NULL,
  `deficit_amount` int(11) DEFAULT NULL,
  `budget_month` varchar(255) DEFAULT NULL,
  `budget_year` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consume_budget`
--

INSERT INTO `consume_budget` (`id`, `budgetcategory_id`, `allocate_amount`, `consumed_amount`, `remaining_amount`, `required_amount`, `deficit_amount`, `budget_month`, `budget_year`, `status`, `created_at`, `updated_at`) VALUES
(1, 13, 25000, 10000, 15000, 15000, 0, 'February', '2019', 'Active', '2019-02-20 10:24:00', '2019-02-20 10:24:29'),
(2, 12, 10000, 15000, -5000, 0, 5000, 'February', '2019', 'Active', '2019-02-20 10:24:15', '2019-02-20 10:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_id` int(10) UNSIGNED NOT NULL,
  `appointment_id` int(10) UNSIGNED DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `courses` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `courses`, `created_at`, `updated_at`) VALUES
(1, 'MS Office', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(2, 'Graphics Designinig', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(3, 'Web Designing', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(4, 'Web Development-PHP', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(5, 'AutoCad', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(6, 'Bundle', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(7, 'Design and Development', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(8, 'Basic Networking', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(9, 'English', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(10, 'CCNA', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(11, 'Quran Pak', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(12, 'Web Development-.Net', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(13, 'Physics', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(14, 'Chemistry', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(15, 'Biology', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(16, 'Math-Minor', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(17, 'Urdu', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(18, 'French', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(19, 'C++', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(20, 'ACCA', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(21, 'Accounts', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(22, 'Economics', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(23, 'Science', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(24, 'Calculus', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(25, 'Statistics', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(26, 'Math-Major', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(27, 'Assignments', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(28, 'Quran with tajweed', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(29, 'Hifz Quran', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(30, 'Translation of Quran', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(31, 'Islamic Education', '2019-04-17 07:58:08', '2019-04-17 07:58:08'),
(32, 'SMM', '2019-04-17 07:58:08', '2019-04-17 07:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `one_gbp_to_usd` double(8,4) DEFAULT NULL,
  `one_usd_to_usd` double(8,4) DEFAULT NULL,
  `one_cad_to_usd` double(8,4) DEFAULT NULL,
  `one_aud_to_usd` double(8,4) DEFAULT NULL,
  `one_nzd_to_usd` double(8,4) DEFAULT NULL,
  `one_sgd_to_usd` double(8,4) DEFAULT NULL,
  `one_pkr_to_usd` double(8,4) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `one_gbp_to_usd`, `one_usd_to_usd`, `one_cad_to_usd`, `one_aud_to_usd`, `one_nzd_to_usd`, `one_sgd_to_usd`, `one_pkr_to_usd`, `date`, `created_at`, `updated_at`) VALUES
(1, 1.2673, 1.0000, 0.7365, 0.7063, 0.6731, 0.7287, 0.0072, '2019-02-18', '2019-02-17 14:00:00', '2019-02-17 14:00:00'),
(2, 1.2634, 1.0000, 0.7346, 0.7041, 0.6709, 0.7285, 0.0072, '2019-02-18', '2019-02-17 14:00:00', '2019-02-17 14:00:00'),
(3, 1.2679, 1.0000, 0.7344, 0.7055, 0.6711, 0.7315, 0.0072, '2019-02-18', '2019-02-17 14:00:00', '2019-02-17 14:00:00'),
(4, 1.2679, 1.0000, 0.7344, 0.7055, 0.6711, 0.7315, 0.0072, '2019-02-18', '2019-02-17 14:00:00', '2019-02-17 14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cusume_budget_detail`
--

CREATE TABLE `cusume_budget_detail` (
  `id` int(11) NOT NULL,
  `consume_budget_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cusume_budget_detail`
--

INSERT INTO `cusume_budget_detail` (`id`, `consume_budget_id`, `user_id`, `amount`, `remarks`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10000, 'Testing', 'Active', '2019-02-20 10:24:29', '2019-02-20 10:24:29'),
(2, 2, 1, 15000, 'Test', 'Active', '2019-02-20 10:24:51', '2019-02-20 10:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `deptname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` int(10) UNSIGNED NOT NULL,
  `last_modified_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `deptname`, `status`, `user_id`, `last_modified_by`, `created_at`, `updated_at`) VALUES
(1, 'Directors', 1, 1, 1, '2018-12-24 00:14:45', '2018-12-24 00:14:45'),
(2, 'Higher Management', 1, 1, 1, '2018-12-24 00:15:03', '2018-12-24 00:15:03'),
(3, 'Management', 1, 1, 1, '2018-12-24 00:15:14', '2018-12-24 00:15:14'),
(4, 'Accounts & Finance', 1, 1, 1, '2018-12-24 00:15:40', '2018-12-24 00:15:40'),
(5, 'Human Resource', 1, 1, 1, '2018-12-24 00:15:56', '2018-12-24 00:15:56'),
(6, 'Administration', 1, 1, 1, '2018-12-24 00:16:21', '2018-12-24 00:16:21'),
(7, 'Information Technology', 1, 1, 1, '2018-12-24 00:16:33', '2018-12-24 00:16:33'),
(8, 'Software Development', 1, 1, 1, '2018-12-24 00:16:52', '2018-12-24 04:35:30'),
(9, 'Teaching Day', 1, 1, 1, '2018-12-24 00:17:12', '2018-12-24 00:17:12'),
(10, 'Teaching Night', 1, 1, 1, '2018-12-24 00:17:23', '2019-01-03 08:16:28'),
(11, 'Sales Day', 1, 1, 246, '2018-12-24 04:08:42', '2019-01-11 06:38:29'),
(12, 'Sales Night', 1, 246, 246, '2019-01-11 06:38:36', '2019-01-11 06:38:36'),
(13, 'Accounts', 1, 246, 246, '2019-01-11 06:40:43', '2019-01-11 06:40:43'),
(14, 'Quality Assurance', 1, 246, 246, '2019-02-20 09:45:18', '2019-02-20 09:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `last_modified_by` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `user_id`, `last_modified_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sales Manager', 1, 1, 1, '2018-12-31 07:53:18', '2018-12-31 08:24:26'),
(2, 'PHP Developer', 1, 1, 1, '2018-12-31 07:53:38', '2018-12-31 07:53:38'),
(3, 'Designer', 1, 1, 1, '2018-12-31 07:53:46', '2018-12-31 08:24:15'),
(4, 'iOS Developer', 1, 1, 1, '2018-12-31 07:53:58', '2018-12-31 07:54:38'),
(5, 'Teacher', 246, 246, 1, '2019-01-11 06:42:43', '2019-01-11 06:42:43'),
(6, 'Quran Teacher', 246, 246, 1, '2019-01-11 06:42:53', '2019-01-11 06:42:53'),
(7, 'Sales Agent', 246, 246, 1, '2019-01-11 06:43:12', '2019-01-11 06:43:12'),
(8, 'Trainee', 246, 246, 1, '2019-01-11 06:43:22', '2019-01-11 06:43:22'),
(9, 'Internee', 246, 246, 1, '2019-01-11 06:43:30', '2019-01-11 06:43:30'),
(10, 'Accounts Manager', 246, 246, 1, '2019-01-11 06:43:47', '2019-01-11 06:43:47'),
(11, 'Accounts Officer', 246, 246, 1, '2019-01-11 06:43:56', '2019-01-11 06:43:56'),
(12, 'HR Manager', 246, 246, 1, '2019-01-11 06:44:07', '2019-01-11 06:44:07'),
(13, 'HR Assistant', 246, 246, 1, '2019-01-11 06:44:17', '2019-01-11 06:44:17'),
(14, 'HR Officer', 246, 246, 1, '2019-01-11 06:44:29', '2019-01-11 06:44:29'),
(15, 'IT Manager', 246, 246, 1, '2019-01-11 06:47:12', '2019-01-11 06:47:12'),
(16, 'IT Officer', 246, 246, 1, '2019-01-11 06:47:21', '2019-01-11 06:47:21'),
(17, 'Business Development Executive', 246, 246, 1, '2019-01-11 06:47:43', '2019-01-11 06:47:43'),
(18, 'Business Development Manager', 246, 246, 1, '2019-01-11 06:47:56', '2019-01-11 06:47:56'),
(19, 'Director Business Development', 246, 246, 1, '2019-01-11 06:48:11', '2019-01-11 06:48:11'),
(20, 'Team Lead', 246, 246, 1, '2019-01-11 06:51:46', '2019-01-11 06:51:46'),
(21, 'Shift Manager', 246, 246, 1, '2019-01-11 06:51:56', '2019-01-11 06:51:56'),
(22, 'Director', 246, 246, 1, '2019-01-11 06:52:06', '2019-01-11 06:52:06'),
(23, 'CEO', 246, 246, 1, '2019-01-11 06:52:39', '2019-01-11 06:52:39'),
(24, 'Personal Assistant', 246, 246, 1, '2019-01-11 06:52:50', '2019-01-11 06:52:50'),
(25, 'PRO', 246, 246, 1, '2019-01-11 06:54:11', '2019-01-11 06:54:11'),
(26, 'Office Boy', 246, 246, 1, '2019-01-11 06:54:21', '2019-01-11 06:54:21'),
(27, 'Electrician', 246, 246, 1, '2019-01-11 06:54:31', '2019-01-11 06:54:31'),
(28, 'Laravel Developer', 246, 246, 1, '2019-01-11 06:55:52', '2019-01-11 06:55:52'),
(29, 'Android Developer', 246, 246, 1, '2019-01-11 06:56:06', '2019-01-11 06:56:06'),
(30, 'Driver', 246, 246, 1, '2019-01-11 06:56:27', '2019-01-11 06:56:27'),
(31, 'Admin Incharge', 246, 246, 1, '2019-01-11 06:56:47', '2019-01-11 06:56:47'),
(32, 'Admin Officer', 246, 246, 1, '2019-01-11 06:56:58', '2019-01-11 06:56:58'),
(33, 'Quality Assurance Officer', 246, 246, 1, '2019-01-15 12:55:00', '2019-01-15 12:55:00'),
(34, 'SEO and SMM Assistant', 246, 246, 1, '2019-01-23 10:47:35', '2019-01-23 10:47:35'),
(35, 'Graphic Designer', 246, 246, 1, '2019-01-23 11:01:05', '2019-01-23 11:01:05'),
(36, 'Front End Developer', 246, 246, 1, '2019-01-23 11:11:39', '2019-01-23 11:11:39'),
(37, 'QA Manager', 246, 246, 1, '2019-01-30 12:40:03', '2019-01-30 12:40:03'),
(38, 'QA Officer', 246, 246, 1, '2019-02-20 09:45:36', '2019-02-20 09:45:36'),
(40, 'Legal Adviser', 246, 246, 1, '2019-02-25 08:08:42', '2019-02-25 08:08:42'),
(41, 'Team Coordinator', 246, 246, 1, '2019-04-10 10:58:53', '2019-04-10 10:58:53'),
(42, 'Maths', 442, 442, 1, '2019-04-13 09:54:01', '2019-04-13 09:54:01'),
(43, 'English', 442, 442, 1, '2019-04-13 09:54:28', '2019-04-13 09:54:28'),
(44, 'Quran', 442, 442, 1, '2019-04-13 09:54:44', '2019-04-13 09:54:44'),
(45, 'Computer', 442, 442, 1, '2019-04-13 09:56:41', '2019-04-13 09:56:41'),
(46, 'Physics', 442, 442, 1, '2019-04-13 09:57:08', '2019-04-13 09:57:08'),
(47, 'Cook', 246, 246, 1, '2019-04-19 10:03:17', '2019-04-19 10:03:17'),
(48, 'Senior Graphic Designer', 246, 246, 1, '2019-06-13 09:45:52', '2019-06-13 09:45:52'),
(49, 'Teaching Coordinator', 246, 246, 1, '2019-06-22 11:15:24', '2019-06-22 11:15:24'),
(50, 'Sweeper', 609, 609, 1, '2019-06-24 09:26:00', '2019-06-24 09:26:00'),
(51, 'Sr. Laravel Developer', 246, 246, 1, '2019-06-25 14:16:53', '2019-06-25 14:16:53'),
(52, 'Jr. Laravel Developer', 246, 246, 1, '2019-07-08 09:21:21', '2019-07-08 09:21:21'),
(53, 'Content Writer', 246, 246, 1, '2019-07-23 09:25:05', '2019-07-23 09:25:05');

-- --------------------------------------------------------

--
-- Table structure for table `dialedcalls`
--

CREATE TABLE `dialedcalls` (
  `id` int(10) UNSIGNED NOT NULL,
  `businessname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `businesstype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactperson` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dialed_by` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `duas`
--

CREATE TABLE `duas` (
  `id` int(10) UNSIGNED NOT NULL,
  `dua` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `duas`
--

INSERT INTO `duas` (`id`, `dua`, `created_at`, `updated_at`) VALUES
(1, 'Dua for increasing  knowledge', NULL, NULL),
(2, 'Before starting meal ', NULL, NULL),
(3, 'If forgot to say,Bismillah in the beginning say this Dua whenever remember', NULL, NULL),
(4, 'Recite this Duaafter meal', NULL, NULL),
(5, 'Before going to bed,recite this Dua', NULL, NULL),
(6, 'On waking up. Recite this Dua', NULL, NULL),
(7, 'When the person enters the toilet', NULL, NULL),
(8, 'When the person comes out of the toilet', NULL, NULL),
(9, 'Before leaving the home recite this Dua', NULL, NULL),
(10, 'When enter the house,say this Dua', NULL, NULL),
(11, 'When getting into a vehicle', NULL, NULL),
(12, 'When the vehicle moves', NULL, NULL),
(13, 'The prayer after drinking milk', NULL, NULL),
(14, 'When looking in the Mirror', NULL, NULL),
(15, 'The prayer after Sneezing', NULL, NULL),
(16, 'The prayer after the sneezer has said Alhumulillah', NULL, NULL),
(17, 'Before wudhu', NULL, NULL),
(18, 'After Wudhu', NULL, NULL),
(19, 'Entering the Masjid', NULL, NULL),
(20, 'Leaving the Masjid', NULL, NULL),
(21, 'The prayer at the time of descending', NULL, NULL),
(22, 'The prayer at the time of proceeding upward', NULL, NULL),
(23, 'The prayer for thanking someone who does a favor', NULL, NULL),
(24, 'Elm main azafey ki dua ', NULL, NULL),
(25, 'When wearing clothes', NULL, NULL),
(26, 'The prayer at the time of feeling anger', NULL, NULL),
(27, 'The prayer at the time of seeing the new moon', NULL, NULL),
(28, 'The prayer at the time its Raining', NULL, NULL),
(29, 'The prayer at the time of starting any new piece of work', NULL, NULL),
(30, 'The prayer for relief (cure) from every Illness', NULL, NULL),
(31, 'Nazr e bad ke Dua', NULL, NULL),
(32, 'Dua At the Time of Difficulty', NULL, NULL),
(33, 'Zuban ke loknat ke Dua', NULL, NULL),
(34, 'Funeral pray for the female child ', NULL, NULL),
(35, 'Funeral pray for the male child ', NULL, NULL),
(36, 'Funeral pray for the Adult male and female', NULL, NULL),
(37, 'Ayat ul Kursi ', NULL, NULL),
(38, 'Dua after Azaan ', NULL, NULL),
(39, 'The prayer for being protected from scorpions and other pests', NULL, NULL),
(40, 'Emaan-e- Mufasill', NULL, NULL),
(41, 'Emaan-e- Mujmil', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `title`, `subject`, `body`, `created_at`, `updated_at`) VALUES
(1, 'Mail-1', 'Php Laravel developer', 'i have two year expirence in laravel', '2018-11-16 09:58:42', '2018-11-16 09:58:42'),
(2, 'Mail-2', 'Web Developer', 'A web developer is a programmer who specializes in, or is specifically engaged in, the development of World Wide Web applications, or applications that are run over HTTP from a web server to a web browser', '2018-11-16 12:31:37', '2018-11-16 12:31:37');

-- --------------------------------------------------------

--
-- Table structure for table `end_services`
--

CREATE TABLE `end_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `points` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE `floors` (
  `id` int(11) NOT NULL,
  `floor_no` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `floors`
--

INSERT INTO `floors` (`id`, `floor_no`, `status`, `created_at`, `updated_at`) VALUES
(1, 'First Floor', 'Active', '2019-01-21 11:04:47', '2019-01-21 11:04:47'),
(2, 'Second Floor', 'Active', '2019-01-21 11:04:47', '2019-01-21 11:04:47');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(10) UNSIGNED NOT NULL,
  `dated` date NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isworking` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `dated`, `description`, `isworking`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, '2019-01-19', 'Official Trip Holiday', 0, 1, 1, '2019-02-01 13:25:05', '2019-02-01 13:25:05'),
(2, '2019-06-04', 'Eid Holiday', 0, 442, 442, '2019-06-03 16:11:49', '2019-06-03 16:11:49'),
(3, '2019-06-05', 'Eid Holiday', 0, 442, 442, '2019-06-03 16:12:28', '2019-06-03 16:12:28'),
(4, '2019-06-06', 'Eid Holiday', 0, 442, 442, '2019-06-03 16:12:47', '2019-06-03 16:12:47'),
(5, '2019-06-07', 'Eid Holiday', 0, 442, 442, '2019-06-03 16:13:09', '2019-06-03 16:13:09'),
(6, '2019-08-12', 'Eid Ul Azha', 0, 442, 442, '2019-08-01 20:24:24', '2019-08-01 20:24:24'),
(7, '2019-08-13', 'Eid Ul Azha', 0, 442, 442, '2019-08-01 20:25:00', '2019-08-01 20:25:00'),
(8, '2019-08-14', 'Eid Ul Azha', 0, 442, 442, '2019-08-01 20:25:24', '2019-08-01 20:25:24'),
(9, '2019-08-10', 'Hajj Holiday', 0, 442, 442, '2019-08-09 18:57:16', '2019-08-09 18:57:16');

-- --------------------------------------------------------

--
-- Table structure for table `hrleadinfos`
--

CREATE TABLE `hrleadinfos` (
  `id` int(10) UNSIGNED NOT NULL,
  `positionsought` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desiresalary` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startingdate` timestamp NULL DEFAULT NULL,
  `shift` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` timestamp NULL DEFAULT NULL,
  `paddress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hrlead_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hrleads`
--

CREATE TABLE `hrleads` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `interviewdate` timestamp NULL DEFAULT NULL,
  `postapplied` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `last_modified_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrleads`
--

INSERT INTO `hrleads` (`id`, `name`, `email`, `mobile`, `department_id`, `status`, `interviewdate`, `postapplied`, `user_id`, `last_modified_by`, `created_at`, `updated_at`) VALUES
(2, 'Nisar Ahmed', 'nisar081oo7@gmail.com', '03075228959', 6, 5, '2019-10-16 12:16:00', 'Student', 1, 1, '2019-10-15 11:00:19', '2019-10-15 12:18:25');

-- --------------------------------------------------------

--
-- Table structure for table `hrleadstatuses`
--

CREATE TABLE `hrleadstatuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recordinglink` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interviewdate` timestamp NULL DEFAULT NULL,
  `hrlead_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hrleadstatuses`
--

INSERT INTO `hrleadstatuses` (`id`, `status`, `remarks`, `recordinglink`, `interviewdate`, `hrlead_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, '$', NULL, NULL, 2, 1, '2019-10-15 12:16:31', '2019-10-15 12:16:31'),
(2, 5, '#', NULL, '2019-10-16 12:16:00', 2, 1, '2019-10-15 12:17:03', '2019-10-15 12:17:03'),
(3, 5, '#', NULL, '2019-10-16 12:16:00', 2, 1, '2019-10-15 12:17:14', '2019-10-15 12:17:14'),
(4, 5, '#', NULL, '2019-10-16 12:16:00', 2, 1, '2019-10-15 12:17:24', '2019-10-15 12:17:24'),
(5, 5, '#', NULL, '2019-10-16 12:16:00', 2, 1, '2019-10-15 12:17:52', '2019-10-15 12:17:52'),
(6, 5, '#', NULL, '2019-10-16 12:16:00', 2, 1, '2019-10-15 12:18:25', '2019-10-15 12:18:25');

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE `inventories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `consumable` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventories`
--

INSERT INTO `inventories` (`id`, `title`, `category_id`, `quantity`, `price`, `description`, `user_id`, `status`, `consumable`, `created_at`, `updated_at`) VALUES
(9, 'Mouse', 1, '10', '100', 'test by noman', 241, 'Active', NULL, '2019-02-19 13:13:01', '2019-02-23 08:45:03'),
(10, 'Monitor', 1, '10', '2000', 'test by noman', 241, 'Active', NULL, '2019-02-20 05:50:51', '2019-07-22 13:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_category`
--

CREATE TABLE `inventory_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_category`
--

INSERT INTO `inventory_category` (`id`, `category_name`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Computer', 'Active', 1, '2018-12-31 11:45:28', '2019-01-22 05:08:56'),
(2, 'Furniture', 'Active', 1, '2018-12-31 07:13:07', '2019-01-22 05:08:59'),
(3, 'Others', 'Active', 1, '2018-12-31 07:54:22', '2019-01-22 05:09:01'),
(4, 'ABC', 'Active', NULL, '2019-01-18 07:10:02', '2019-04-02 10:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_item_sno`
--

CREATE TABLE `inventory_item_sno` (
  `id` int(11) NOT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_item_sno`
--

INSERT INTO `inventory_item_sno` (`id`, `inventory_id`, `serial_no`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(81, 9, 'Mouse0205', 'Active', 241, '2019-02-19 13:13:01', '2019-02-19 13:13:01'),
(82, 9, 'Mouse98DE', 'Active', 241, '2019-02-19 13:13:01', '2019-02-19 13:13:40'),
(83, 9, 'Mouse698C', 'Active', 241, '2019-02-19 13:13:01', '2019-02-19 13:13:01'),
(84, 9, 'Mouse81AF', 'Active', 241, '2019-02-19 13:13:01', '2019-02-19 13:13:01'),
(85, 9, 'Mouse3E63', 'Active', 241, '2019-02-19 13:13:01', '2019-02-19 13:13:01'),
(86, 9, 'MouseFD7D', 'Active', 241, '2019-02-19 13:13:01', '2019-02-19 13:13:01'),
(87, 9, 'Mouse8B98', 'Active', 241, '2019-02-19 13:13:01', '2019-02-19 13:13:01'),
(88, 9, 'MouseD690', 'Active', 241, '2019-02-19 13:13:01', '2019-02-19 13:13:01'),
(89, 9, 'MouseA27F', 'Active', 241, '2019-02-19 13:13:01', '2019-02-19 13:13:01'),
(90, 9, 'MouseDE30', 'Active', 241, '2019-02-19 13:13:01', '2019-02-19 13:13:01'),
(91, 9, 'MouseBF74', 'Active', 241, '2019-02-19 13:13:01', '2019-02-19 13:13:01'),
(92, 10, 'Monitor70AA', 'Active', 241, '2019-02-20 05:50:51', '2019-02-20 05:50:51'),
(93, 10, 'MonitorBFB3', 'Active', 241, '2019-02-20 05:50:51', '2019-02-20 05:50:51'),
(94, 10, 'Monitor5DEC', 'Active', 241, '2019-02-20 05:50:51', '2019-02-20 05:50:51'),
(95, 10, 'Monitor4D85', 'Active', 241, '2019-02-20 05:50:51', '2019-02-20 05:50:51'),
(96, 10, 'MonitorE67A', 'Active', 241, '2019-02-20 05:50:51', '2019-02-20 05:50:51'),
(97, 10, 'Monitor1880', 'Active', 241, '2019-02-20 05:50:51', '2019-02-20 05:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_quantity`
--

CREATE TABLE `inventory_quantity` (
  `id` int(11) NOT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `quantity_type` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_quantity`
--

INSERT INTO `inventory_quantity` (`id`, `inventory_id`, `quantity_type`, `quantity`, `description`, `status`, `user_id`, `created_by`, `created_at`, `updated_at`) VALUES
(8, 9, 'Quantity IN', 10, NULL, 'Active', NULL, 241, '2019-02-19 13:13:01', '2019-02-19 13:13:01'),
(9, 10, 'Quantity IN', 5, NULL, 'Active', NULL, 241, '2019-02-20 05:50:51', '2019-02-20 05:50:51'),
(10, 10, 'Quantity IN', 5, 'szd', 'Active', NULL, 1, '2019-07-22 13:41:55', '2019-07-22 13:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_specification`
--

CREATE TABLE `inventory_specification` (
  `id` int(11) NOT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `attribute_name` varchar(255) DEFAULT NULL,
  `attribute_value` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_specification`
--

INSERT INTO `inventory_specification` (`id`, `inventory_id`, `attribute_name`, `attribute_value`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(26, 9, 'Model', 'Dell', 'Active', 241, '2019-02-19 13:13:01', '2019-02-19 13:13:01'),
(27, 9, 'Color', 'Black', 'Active', 241, '2019-02-19 13:13:01', '2019-02-19 13:13:01'),
(28, 9, 'WireLess', 'Yes', 'Active', 241, '2019-02-19 13:13:01', '2019-02-19 13:13:01'),
(29, 10, 'Model', 'Dell', 'Active', 241, '2019-02-20 05:50:51', '2019-02-20 05:50:51'),
(30, 10, 'Size', '15\'\'', 'Active', 241, '2019-02-20 05:50:51', '2019-02-20 05:50:51'),
(31, 10, 'Color', 'Black', 'Active', 241, '2019-02-20 05:50:51', '2019-02-20 05:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `invoicedetails`
--

CREATE TABLE `invoicedetails` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) NOT NULL COMMENT 'invoice number',
  `parent_id` int(10) UNSIGNED NOT NULL,
  `teacherID` int(10) UNSIGNED NOT NULL,
  `studentID` int(10) UNSIGNED NOT NULL,
  `LeadId` int(10) UNSIGNED NOT NULL,
  `student_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` date DEFAULT NULL,
  `next_due_date` date DEFAULT NULL,
  `monthly_fee` double(8,2) NOT NULL,
  `months` int(10) UNSIGNED NOT NULL,
  `days` int(10) UNSIGNED NOT NULL,
  `payment` double(8,2) DEFAULT NULL,
  `payment_local` double(8,2) DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `currency` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `agentId` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoicedetails`
--

INSERT INTO `invoicedetails` (`id`, `invoice_id`, `parent_id`, `teacherID`, `studentID`, `LeadId`, `student_name`, `due_date`, `next_due_date`, `monthly_fee`, `months`, `days`, `payment`, `payment_local`, `invoice_date`, `currency`, `schedule_id`, `agentId`, `created_at`, `updated_at`) VALUES
(5, 20190830181547779, 779, 493, 781, 0, 'Kinza Sadaqat', '2019-08-30', NULL, 20.00, 1, 0, 10.00, 20.00, '2019-08-30', 4, 33, NULL, '2019-08-29 19:00:00', '2019-08-29 19:00:00'),
(6, 20190830181547779, 779, 493, 781, 0, 'Kinza Sadaqat', '2019-08-30', NULL, 20.00, 1, 0, 10.00, 20.00, '2019-08-30', 4, 34, NULL, '2019-08-29 19:00:00', '2019-08-29 19:00:00'),
(7, 20190830181547779, 779, 376, 780, 0, 'Kinza Sadaqat', '2019-08-30', NULL, 20.00, 1, 0, 10.00, 20.00, '2019-08-30', 4, 37, NULL, '2019-08-29 19:00:00', '2019-08-29 19:00:00'),
(13, 20190902132202716, 716, 264, 734, 0, 'Mohammad Ibrahim', '2019-03-31', NULL, 40.00, 1, 0, 30.00, 40.00, '2019-09-02', 5, 10, 0, '2019-09-01 19:00:00', '2019-09-01 19:00:00'),
(12, 20190902132202716, 716, 264, 717, 0, 'Zara Faisal', '2019-03-01', NULL, 80.00, 1, 0, 54.30, 80.00, '2019-09-02', 5, 4, 242, '2019-09-01 19:00:00', '2019-09-01 19:00:00'),
(14, 20190916180710779, 779, 493, 781, 0, 'Kinza Sadaqat', '2019-09-30', NULL, 10.00, 1, 0, 5.00, 10.00, '2019-09-16', 4, 33, 0, '2019-09-15 19:00:00', '2019-09-15 19:00:00'),
(15, 20190916180710779, 779, 493, 781, 0, 'Kinza Sadaqat', '2019-09-30', NULL, 20.00, 1, 0, 10.00, 20.00, '2019-09-16', 4, 34, 0, '2019-09-15 19:00:00', '2019-09-15 19:00:00'),
(16, 20190916180710779, 779, 376, 780, 0, 'Kinza Sadaqat', '2019-09-30', NULL, 20.00, 1, 0, 10.00, 20.00, '2019-09-16', 4, 37, 0, '2019-09-15 19:00:00', '2019-09-15 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) NOT NULL COMMENT 'invoice number',
  `parent_id` int(10) UNSIGNED NOT NULL,
  `parent_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `due_date` date DEFAULT NULL,
  `paid_status` tinyint(4) NOT NULL COMMENT 'Payment Status 0:pending 1:paid 2:cancel 3:process',
  `invoice_date` date DEFAULT NULL,
  `pay_method` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sender_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_received` double(8,2) DEFAULT NULL,
  `payment_received_local` double(8,2) DEFAULT NULL,
  `invoice_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_paid_date` date DEFAULT NULL,
  `invoice_resend` int(10) UNSIGNED DEFAULT NULL,
  `last_resend_date` date DEFAULT NULL,
  `last_resend_by` int(10) UNSIGNED DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dateReceived` date DEFAULT NULL,
  `dateMonth` date DEFAULT NULL,
  `method_array` tinyint(3) UNSIGNED DEFAULT NULL,
  `currency_array` tinyint(3) UNSIGNED DEFAULT NULL,
  `agentId` int(10) UNSIGNED NOT NULL,
  `signupChk` tinyint(3) UNSIGNED DEFAULT NULL,
  `accounts_chk` tinyint(3) UNSIGNED DEFAULT NULL,
  `accounts_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_accounts` date DEFAULT NULL,
  `agent_comm` int(10) UNSIGNED NOT NULL,
  `teacher_comm` int(10) UNSIGNED NOT NULL,
  `cardSave_ccv_code` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VirtualTerminal_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VirtualTerminal_number` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `VirtualTerminal_date` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slipImage` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bankNameId` tinyint(3) UNSIGNED DEFAULT NULL,
  `amountDefaultNew` double(8,4) NOT NULL,
  `amountOriginalNew` double(8,4) NOT NULL,
  `feeDeductNew` double(8,4) NOT NULL,
  `totalReceivedNew` double(8,4) NOT NULL,
  `discountNew` double(8,4) NOT NULL,
  `additionalFee` double(8,4) NOT NULL,
  `amountDefaultNew_Usd` double(8,4) NOT NULL,
  `amountOriginalNew_Usd` double(8,4) NOT NULL,
  `feeDeductNew_Usd` double(8,4) NOT NULL,
  `totalReceivedNew_Usd` double(8,4) NOT NULL,
  `discountNew_Usd` double(8,4) NOT NULL,
  `additionalFee_Usd` double(8,4) NOT NULL,
  `comments_reminder` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_reminder` date DEFAULT NULL,
  `isdiscard` int(2) DEFAULT NULL,
  `arrears` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_id`, `parent_id`, `parent_name`, `due_date`, `paid_status`, `invoice_date`, `pay_method`, `sender_name`, `country`, `bank_name`, `receive_code`, `comments`, `payment_received`, `payment_received_local`, `invoice_email`, `invoice_paid_date`, `invoice_resend`, `last_resend_date`, `last_resend_by`, `created_by`, `created_at`, `updated_at`, `dateReceived`, `dateMonth`, `method_array`, `currency_array`, `agentId`, `signupChk`, `accounts_chk`, `accounts_comment`, `date_accounts`, `agent_comm`, `teacher_comm`, `cardSave_ccv_code`, `VirtualTerminal_name`, `VirtualTerminal_number`, `VirtualTerminal_date`, `slipImage`, `bankNameId`, `amountDefaultNew`, `amountOriginalNew`, `feeDeductNew`, `totalReceivedNew`, `discountNew`, `additionalFee`, `amountDefaultNew_Usd`, `amountOriginalNew_Usd`, `feeDeductNew_Usd`, `totalReceivedNew_Usd`, `discountNew_Usd`, `additionalFee_Usd`, `comments_reminder`, `date_reminder`, `isdiscard`, `arrears`) VALUES
(5, 20190830181547779, 779, 'Adeel Sadaqat', '2019-08-30', 1, '2019-08-30', '1', 'test', NULL, NULL, '07S779668V480225A', 'test payemnt', 40.92, 58.00, 'junaid9898@yahoo.com', '2019-09-05', NULL, NULL, NULL, 1, '2019-08-29 19:00:00', '2019-09-04 19:00:00', '0000-00-00', NULL, 1, 4, 0, 1, NULL, NULL, NULL, 264, 263, NULL, NULL, NULL, NULL, '', NULL, 60.0000, 60.0000, 2.0000, 58.0000, 0.0000, 0.0000, 42.3300, 42.3300, 1.4100, 40.9200, 0.0000, 0.0000, NULL, NULL, NULL, NULL),
(8, 20190902132202716, 716, 'Faisal Muhammad', '2019-03-31', 0, '2019-09-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'junaid9898@yahoo.com', NULL, NULL, NULL, NULL, 1, '2019-09-01 19:00:00', '2019-09-01 19:00:00', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, NULL, NULL, NULL, NULL),
(9, 20190916180710779, 779, 'Adeel Sadaqat', '2019-09-30', 0, '2019-09-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'junaid9898@yahoo.com', NULL, NULL, NULL, NULL, 1, '2019-09-15 19:00:00', '2019-09-15 19:00:00', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, 0.0000, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `it_stations`
--

CREATE TABLE `it_stations` (
  `id` int(11) NOT NULL,
  `station_number` varchar(255) DEFAULT NULL,
  `floor_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `it_stations`
--

INSERT INTO `it_stations` (`id`, `station_number`, `floor_id`, `room_id`, `status`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'WS06', 2, 4, 'Active', 'test by noman', 241, '2019-02-20 05:47:49', '2019-05-02 12:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `it_station_dept`
--

CREATE TABLE `it_station_dept` (
  `id` int(11) NOT NULL,
  `station_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `it_station_items`
--

CREATE TABLE `it_station_items` (
  `id` int(11) NOT NULL,
  `station_id` int(11) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `inventory_sno_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `it_station_items`
--

INSERT INTO `it_station_items` (`id`, `station_id`, `inventory_id`, `inventory_sno_id`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(14, 3, 9, 84, 'Active', 241, '2019-02-20 05:47:49', '2019-02-20 05:47:49'),
(15, 3, 10, 93, 'Active', 241, '2019-02-20 05:52:21', '2019-02-20 05:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `it_used_dept_items`
--

CREATE TABLE `it_used_dept_items` (
  `id` int(11) NOT NULL,
  `station_item_id` int(11) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journal_voucher`
--

CREATE TABLE `journal_voucher` (
  `id` int(11) NOT NULL,
  `account_id` int(11) DEFAULT NULL,
  `voucher_no` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `dated` date DEFAULT NULL,
  `description` text NOT NULL,
  `debit` float(11,2) DEFAULT 0.00,
  `credit` float(11,2) DEFAULT 0.00,
  `posted` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `payablecommitted_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_delete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journal_voucher_detail`
--

CREATE TABLE `journal_voucher_detail` (
  `id` int(11) NOT NULL,
  `journal_voucher_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `debit` float(11,2) NOT NULL DEFAULT 0.00,
  `credit` float(11,2) NOT NULL DEFAULT 0.00,
  `status` varchar(255) DEFAULT NULL,
  `dated` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_delete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(10) UNSIGNED NOT NULL,
  `businessName` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `businessAddress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `businessNature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weblink` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fblink` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Facebook',
  `fblike` int(11) DEFAULT NULL,
  `twlink` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Twitter',
  `twfollwer` int(11) DEFAULT NULL,
  `lilink` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Linkedin',
  `livisitor` int(11) DEFAULT NULL,
  `inlink` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Instagram',
  `incfollower` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solser` tinyint(1) DEFAULT 0 COMMENT 'Solutions and Services',
  `testimonials` tinyint(1) DEFAULT 0,
  `company_pro` tinyint(1) DEFAULT 0,
  `user_id` int(10) UNSIGNED NOT NULL,
  `assignedto` int(10) UNSIGNED DEFAULT NULL,
  `approvedby` int(10) UNSIGNED DEFAULT NULL,
  `approvestatus` tinyint(1) DEFAULT 0,
  `istraininglead` tinyint(1) DEFAULT 0,
  `created_by` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attributes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `closed` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leadstatuses`
--

CREATE TABLE `leadstatuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `lead_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_assets`
--

CREATE TABLE `lead_assets` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docfile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(10) UNSIGNED NOT NULL,
  `dated` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `leavetype` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ispaid` tinyint(1) NOT NULL DEFAULT 0,
  `isgroup` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `dated`, `description`, `leavetype`, `status`, `ispaid`, `isgroup`, `user_id`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, '2019-09-23', 'test leave', 'CL', 'Approved', 1, 0, 225, 1, 1, '2019-09-23 08:56:02', '2019-09-23 08:56:02'),
(3, '2019-08-29', 'emergency work', 'SL', 'Approved', 1, 0, 580, 1, 1, '2019-09-01 19:00:00', '2019-09-01 19:00:00'),
(4, '2019-09-12', 'personal work at home', 'CL', 'Approved', 1, 0, 303, 1, 1, '2019-09-02 19:00:00', '2019-09-02 19:00:00'),
(5, '2019-09-09', 'domestic issue', 'CL', 'Approved', 0, 0, 295, 1, 1, '2019-09-06 19:00:00', '2019-09-06 19:00:00'),
(17, '2019-09-02', 'sick', 'SL', 'Approved', 0, 0, 296, 1, 1, '2019-09-04 19:00:00', '2019-09-04 19:00:00'),
(18, '2019-09-27', 'asdf123456', 'SL', 'Pending', 0, 0, 1, 1, 1, '2019-09-27 12:20:32', '2019-09-26 19:00:00'),
(19, '2019-10-01', 'test unpaid leave', 'UL', 'Pending', 0, 0, 1, 1, 1, '2019-09-27 14:43:23', '2019-09-27 14:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('76e490aa-42bf-4ae5-8b3d-64a30328e43e', 'App\\Notifications\\ProjectNotification', 'App\\User', 666, '{\"letter\":{\"title\":\"New Project\",\"body\":\"A new project has been created by Shahid Umar, please review it.\",\"redirectURL\":\"http:\\/\\/localhost\\/erp\\/public\\/projects\\/2\"}}', NULL, '2019-10-10 09:30:47', '2019-10-10 09:30:47'),
('825512b6-33d4-40dc-838b-5fff3215d314', 'App\\Notifications\\ProjectNotification', 'App\\User', 1, '{\"letter\":{\"title\":\"New Project\",\"body\":\"A new project has been created by Shahid Umar, please review it.\",\"redirectURL\":\"http:\\/\\/localhost\\/erp\\/public\\/projects\\/4\"}}', NULL, '2019-10-11 10:19:38', '2019-10-11 10:19:38'),
('a29db49d-7157-4948-b485-d2d1f740825f', 'App\\Notifications\\ProjectNotification', 'App\\User', 1, '{\"letter\":{\"title\":\"New Project\",\"body\":\"A new project has been created by Shahid Umar, please review it.\",\"redirectURL\":\"http:\\/\\/localhost\\/erp\\/public\\/projects\\/5\"}}', NULL, '2019-10-11 10:22:16', '2019-10-11 10:22:16'),
('ce28750a-2412-4b0a-8c2c-50f9bb231c83', 'App\\Notifications\\ProjectNotification', 'App\\User', 36, '{\"letter\":{\"title\":\"New Project\",\"body\":\"A new project has been created by Shahid Umar, please review it.\",\"redirectURL\":\"http:\\/\\/localhost\\/erp\\/public\\/projects\\/1\"}}', NULL, '2019-10-09 10:52:18', '2019-10-09 10:52:18'),
('ced2e047-b0c2-48fd-82f7-08aaa0c6c8f4', 'App\\Notifications\\ProjectNotification', 'App\\User', 29, '{\"letter\":{\"title\":\"New Project\",\"body\":\"A new project has been created by Shahid Umar, please review it.\",\"redirectURL\":\"http:\\/\\/localhost\\/erp\\/public\\/projects\\/1\"}}', NULL, '2019-10-09 10:52:16', '2019-10-09 10:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('9534aea5cdc4772c045bb9544f8b01f6579ccc7a65195c2ce977efb5b97b8912e93bfa3f718cb214', 1, 1, 'MyApp', '[]', 0, '2018-09-06 06:51:59', '2018-09-06 06:51:59', '2019-09-06 06:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'NSOL Personal Access Client', 'AIW98XBvxeYRxKvcjkHKJIpDdtRe7oWTv5a4agKl', 'http://localhost', 1, 0, 0, '2018-09-06 06:01:38', '2018-09-06 06:01:38'),
(2, NULL, 'NSOL Password Grant Client', '0vd6yBBPsESn717eUVWVHpK7Xr9mu6loUsvsAr42', 'http://localhost', 0, 1, 0, '2018-09-06 06:01:38', '2018-09-06 06:01:38');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-09-06 06:01:38', '2018-09-06 06:01:38');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parentdetails`
--

CREATE TABLE `parentdetails` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `countryID` int(10) UNSIGNED DEFAULT NULL,
  `ext_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parentdetails`
--

INSERT INTO `parentdetails` (`id`, `user_id`, `countryID`, `ext_id`, `created_at`, `updated_at`) VALUES
(1, 596, 4, 2272575, '2019-05-24 00:00:00', '2019-05-24 08:48:13'),
(2, 598, 1, 2272583, '2019-05-25 00:00:00', '2019-05-25 00:00:00'),
(3, 716, 130, 2386911, '2019-07-26 00:00:00', '2019-07-26 00:00:00'),
(4, 718, 4, 2386912, '2019-07-26 00:00:00', '2019-07-26 00:00:00'),
(5, 726, 130, 2386968, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(6, 728, 4, 2386969, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(7, 730, 4, 2386970, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(8, 732, 4, 2386971, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(9, 735, 4, 2386972, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(10, 737, 14, 2386973, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(11, 739, 4, 2386974, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(12, 741, 4, 2386975, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(13, 743, 4, 2386976, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(14, 745, 4, 2386977, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(15, 747, 4, 2386978, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(16, 749, 4, 2386979, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(17, 751, 159, 2386980, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(18, 753, 17, 2386981, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(19, 755, 154, 2386982, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(20, 757, 4, 2386983, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(21, 759, 159, 2386984, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(22, 761, 4, 2386985, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(23, 763, 3, 2386986, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(24, 765, 4, 2386987, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(25, 767, 4, 2386988, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(26, 769, 4, 2386990, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(27, 771, 4, 2386991, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(28, 773, 4, 2386992, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(29, 775, 4, 2386993, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(30, 777, 4, 2386994, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(31, 779, 154, 2386995, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(32, 782, 159, 2386996, '2019-07-29 00:00:00', '2019-07-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hmudasar25@gmail.com', '$2y$10$Yx.xEt4YWH0Xxhrnn7MJnOennfjL8OPdXlQDbe.Uk1dzOLV6eofl2', '2018-09-01 06:07:56'),
('mati@nsol.sg', '$2y$10$zzDa3M3Oa.jxi6YFg63RXeCo5hcTUHO0G47rKJ11Yu6r0OWDqQduK', '2018-09-13 05:51:31'),
('tahira.sarfaraz1@gmail.com', '$2y$10$L7ryM9rOgsLWKZ.X0NkAQeFc98SCNeZtg2q7Xqg9XMy6SSQVdYYTu', '2018-10-02 11:20:34'),
('info@nsol.sg', '$2y$10$6dOebnd5UwoN.LHvMO4pJOLzMzQLhWaXilMvPzlU3kdNm4a58Tl2u', '2018-10-15 04:30:13'),
('aamirnazir@yourcloudcampus.com', '$2y$10$uarw5Bf9UJCRLaArOxGVGuflRd.3QKKKL1Mza3spxnuf4M/2wRDWG', '2018-12-20 03:23:48'),
('shagufta.ijaz@ymail.com', '$2y$10$DJntRhySWhkWiQfYs84.QO1sB9S3msatOrYbTZZoaZNO6r7ThEln6', '2019-01-11 06:48:31'),
('muhammad.atif@ymail.com', '$2y$10$PgjWkcFO799BneJ2C07RUuG5/C4sCxPjcVIeWcAapzDO80aYxRDRi', '2019-02-04 04:49:21'),
('m.yousaf89@hotmail.com', '$2y$10$Vp.4h3k4uyePeJRkFqg7eOscZU2A6LIco8EdWzJEdUmHBonzn/Lr6', '2019-02-11 08:00:42'),
('imran.cloudcampus@gmail.com', '$2y$10$Wb2s4pXe1JwgRkTNe5B5EOP.cTLqcyjpBmh6yucoloyQRS5lqrAqK', '2019-02-16 17:53:11'),
('muhammadhamza.idr@outlook.com', '$2y$10$UZF4oHBFNeENRowrv37sIug7i1IrzDvh5LpyOyM3krU6PqrFfoJpO', '2019-02-21 12:42:05'),
('dawoodibrahim@gmail.com', '$2y$10$th.EOIiNv1KZeLzuPq1C7u.SnEs88wupAZIQCJtBuiKqmM3QMKSGi', '2019-02-22 21:03:23'),
('soniaakhan441@gmail.com', '$2y$10$r.31BItjsNE6hUIH.u52EOkw5WHANTatPrER//CncoaOej.XdnoOi', '2019-02-23 08:11:00'),
('karshama@gmail.com', '$2y$10$1HtasNvmidans.YQd4koD.Sx0vvAbU/qWsmnCx3fm0U6bVuUmb8mC', '2019-02-23 08:27:33'),
('Saqeba96@gmail.com', '$2y$10$TVHBM6zf4HgOZrZkJFTNKOmjeBDrGfZ5YGkDVoFBb2h8pQCsvlhwy', '2019-02-25 04:17:25'),
('umar.sarwar12@outlook.com', '$2y$10$RCeYdaqtC/MsbCoZVOPmzOQ77coINcIzDCZnWG3Jw0YMPmeko64Sq', '2019-02-25 05:47:32'),
('brktali022@gmail.com', '$2y$10$szOmiiIhxGRoLnnHYhRD9O5Dax4CQ.mErqM9QE/fcV8a8Fo8vcM.q', '2019-02-25 13:12:42'),
('kazmiazadar110@gmail.com', '$2y$10$yyaUtVZsO2nZnC7I9v5tQuhyPtSc.MZqvoABR2EmcFSFCxBhc364a', '2019-02-26 00:01:27'),
('bushranazeer66@gmail.com', '$2y$10$k2Ali.khqS/xIPYEBBKz6.Q61y6rHOqIIAzLiuoYAFXVC8YugI6uG', '2019-02-26 04:36:23'),
('ma6462693@gmail.com', '$2y$10$dmmZEtVRd7n5pYtepddsA.czIXXVNzhGAf9cecn5eLUZfr1vEop8a', '2019-02-26 11:38:14'),
('muhammadishaque980@gmai.com', '$2y$10$IW4.kwasSiBeHVZZxqEY9.r.n4tUNcEyecWlPUZjbD1mGUvn34X7.', '2019-02-26 23:20:00'),
('mehreenkhalid2580@gmail.com', '$2y$10$TSlH7FJW.IsTuP5L6H4BOO0BExFPV8wpXcO0HmZS9P/9UxbQaJIFW', '2019-02-27 11:25:19'),
('beenishrana127@gmail.com', '$2y$10$522r8dh.p8.IwMqDmN5PfeQ1xbjCtPBUS5OtUjR8/cU45PU7lxW6e', '2019-02-27 11:44:28'),
('ibrarashah.shah@gmail.com', '$2y$10$TIUSmBbBDqXRqELNGrKAUuzTuYMW964HzWAfCigcUPGiPhExUT4wu', '2019-02-28 23:06:43'),
('A.G.Kmath7@gmail.com', '$2y$10$DNGOw8ta/17oKh8hYrnuy.fRpsXPhrreDSgSZC7PCwtODlGqecE7W', '2019-03-01 00:34:09'),
('princeasadshah91@gmail.com', '$2y$10$.dxE22ExBwQq9n96eTJcF.vAw6q1LvyeQQ7zNP.sarIxm73bRWSLO', '2019-03-02 04:52:20'),
('merrymughal129@gmail.com', '$2y$10$cJkWG.8a8OtJhBl6MO0ex.hVO86hlgU5W2Amb.Qgssm06zKsPDd46', '2019-03-02 08:49:55'),
('rabia_khalid83@yahoo.com', '$2y$10$eEU1gOLAb72O3HxtWw/UuexyxjzYPYIVBkQ1zXMJ7yqUPX2ylb8X6', '2019-03-05 12:20:52'),
('farhan.hakim1@yahoo.com', '$2y$10$qiLxxWVaiPW5.MLBWnW52OS4OmfcqN4OHa0fVweNvzupxUEG52OXK', '2019-03-08 22:58:41'),
('gmawan41@gmail.com', '$2y$10$woYZUNVp32j48LQnp1xtleOgelaVZruW3DPq.J..Ek6aSfR//7KMy', '2019-03-09 10:52:20'),
('jamilaawan1996@gmail.com', '$2y$10$pFKu5vGyAg/FkYgKE3iIBuo4WHEdS04G36xiOUKEOLSYnnzHOdIxu', '2019-03-13 09:41:00'),
('ibrarshah.shah@gmail.com', '$2y$10$XCRrSuH/hLXp4XgS03XL1exAikZD1kzGQfN5QHj9pdbCA0Ao0nYgW', '2019-03-15 18:13:16'),
('muhammmadfarrukh55@gmail.com', '$2y$10$EfbImXK3YpIADEUhxrgeOOQJwqaPeMv5HPtyjHUTlGc/zvOJmzFZ6', '2019-03-18 04:57:19'),
('ambreens115@gmail.com', '$2y$10$8jX/KqStC7qeT6evToaK/u69Q71nkFJqGkWzkYgPgfL7KZO7f1Rsi', '2019-04-08 11:44:58'),
('iqraabbasijd@gmail.com', '$2y$10$7xbhVys2SPZ1hiE8tLTyceqpvMXKlcwjekenUpZhkuD0jK5Jxpcrm', '2019-04-10 10:42:14'),
('zakirkhan786e@gmail.com', '$2y$10$Rh7YyBOxsUBR/EjDTypy8e2n98g/LQ1qd5TJuUnRxIpWg830EtQvC', '2019-04-10 11:39:50'),
('rajarashid123@gmail.com', '$2y$10$Zpj.gmlBL0HS6BFQ4xYOLOo2AloVcbfrvIAkykTxvZqVelYKotedG', '2019-04-13 01:16:17'),
('seemabzamir136@gmail.com', '$2y$10$WOHb2O5AfrPu9Oj/C6Xnbu2oXCYy.9h5pA0nhswxfwPfOPNpg0GY6', '2019-04-17 05:51:46'),
('mk235652@gmail.com', '$2y$10$Na2Aa.awh4cyNkVFia5Ti.vhd4Vyrk2cvihjH0Lh6.PSMBcV5MyMu', '2019-04-22 10:16:29'),
('irum555@gmail.com', '$2y$10$C22VcdOQAW.6FzHOae3dDOmBsde7uQaFl/Zktaib9p9YeJFyia9I6', '2019-05-01 23:48:21'),
('afxhashfiq@gmail.com', '$2y$10$JlCFmfachg1KIO70Q.2ukecGvjHuiSWywmAQKSXw9G7lcxKSuPDzS', '2019-05-03 05:55:46'),
('hassanali@gmail.com', '$2y$10$sZO5UraKztBIeJ8fAh05Q.Jae3nmW8Mh/itQL9iVgG1.no1AnpJhG', '2019-05-21 04:28:18'),
('anisazulfiqar606@gmail.com', '$2y$10$hqgbXLBtBpsvi4QaQahfAOw65x8wXPGab3YUrzTnjq7MWdbdzja/C', '2019-05-22 00:08:10'),
('iqraabbasi570@gmail.com', '$2y$10$X.ug5TMY7jJYeDlGdUfDNeUvKqI0mrFMk0yVPpyvqHuQ/4L3g8FDm', '2019-05-23 05:16:59'),
('Junaid.Rehman969@gmail.com', '$2y$10$B/2jMmw5j8c2YRoAoz27/e6q/NZ.ameJv9CRiJ75vfcXvJVVT4f9e', '2019-05-25 01:22:24'),
('faisalraja259@gmail.com', '$2y$10$f7zedfdbgePKUndbo6OEyeWND3KUJ.YNxuZJT7tnfPNLKhgoUaejK', '2019-05-25 23:07:13'),
('muhammadsultan3768@gmail.com', '$2y$10$Nfg.9C7.0vl3DEZmxv9Q3uetXrA5.Norsc05t6dBouEgnoYlOaOVK', '2019-05-29 04:19:19'),
('madihafatima337@gmail.com', '$2y$10$Aqhu5WPbAv4Ld3ahGiJWfetppgiDcOE8f0vVZ729CqCtwn4CLoV82', '2019-05-31 06:23:00'),
('pblack251@gmail.com', '$2y$10$hS8a1KhfSOf8OKyTEbXeJ.MfDYIqhHKMEIxYwPUf/wFuyftQ3iYLS', '2019-06-07 01:18:42'),
('sufyanazher21@gmail.com', '$2y$10$C3aWz/q441Vrq0umUS9fNuiq9BglyeOaNH/eyQwn48gMXwiuIc.K.', '2019-06-15 14:08:01'),
('ma4172217@gmail.com', '$2y$10$oAggRwCkVw7b6iPIxDLPSeosUkj18sOo22PWszoM7sRaQarvAJddS', '2019-06-17 10:38:09'),
('mehtabraja211@gmail.com', '$2y$10$NU6KxJ1iMrZdRTZqfsSa6OepKhWElmmQZWgZoptXlY45EJWCLvM06', '2019-06-20 11:37:55'),
('ali.hussain8282@yahoo.com', '$2y$10$E5K3lFUfuNQ.QFilnkerleGKEnClsfjJjq/DDdQes43vReKFgdXhy', '2019-06-25 05:32:52'),
('junaid@yourcloudcampus.com', '$2y$10$VuhSbrK.f4X9qA3VG/HmluupXPr/L.N3wnOTRfnpGxhFFr9OZ0mTi', '2019-06-27 15:22:43'),
('manahilkhan8177@gmail.com', '$2y$10$nLRCnT0viaUbIm5svnPE8.Dr78SBbUyCghjvrRMZdY1P8iSRXW3GS', '2019-07-02 12:43:11'),
('unnaskhan1997@gmail.com', '$2y$10$MVTvLI8Jw2D7FZh9DwgLzu66y60jwsGic8Q8lAOrFBCRaoajjbt5S', '2019-07-03 10:48:07'),
('mohammadirfan139@gmail.com', '$2y$10$UHlBHdQbmtTRjUrTK/c4Luch1bqzyn7V5pAvt5tO5gwy7.psKwbZu', '2019-07-04 17:02:26'),
('shafianoor31@gmail.com', '$2y$10$B2xvrq3bhvRdBdhs2LnjTOL2waaE3hY7/vrr7sh66jUCSwEDq2Zwe', '2019-07-04 21:42:36'),
('faisalbhatti.9977@gmail.com', '$2y$10$x77BthFhwTF5.6.IW57N0ucXZID2XyXh07/tI6YA76.Doyr1wawhq', '2019-07-06 17:30:08'),
('heartattack1993@gmail.com', '$2y$10$y94vu5PUSF10Go6QOuiRK.QeDqTPWpULGpYte7lcotsZ2a7LZSTYi', '2019-07-09 13:33:24'),
('abdulhaleem@yourcloudcampus.com', '$2y$10$hewsWcJcOm9Wa9Av/teRl.DkQVfP5of7ypbOpM9K3FD1tTMBkYqEi', '2019-07-13 11:22:12'),
('sabi.malik70@gmail.com', '$2y$10$x9JXFrk/OprmIaayhqnrCO4Nhj7buV.1AYHSoHfJjR8erxSK3kA5.', '2019-07-15 08:19:25'),
('Muzaffarmalikx@gmail.com', '$2y$10$ceWQzQxwuwPcf4In7gjx4ugE.d.ckxs0DwZY4RXY/SzrmlH37BL7a', '2019-07-16 06:05:32'),
('s.abbassi86@yahoo.com', '$2y$10$3Yb9QoTitSQsymc4jwv7uuKaYsgz9KywQuUxz1x53/2/PmRLW4aFC', '2019-07-16 12:04:19'),
('asimanoureensheikh@gmail.com', '$2y$10$NRIcg.UKGlUmtyMSG/0fS.9uYxpQ.x9A6gFLUJ6CtvMbC5px40AFq', '2019-07-18 03:26:00'),
('aaa.designerpk@gmail.com', '$2y$10$QCbjtJ06ZpYQdaGsh2NitO1vweYss/2AJUcLo/HnjRJ.NLAd1UdUq', '2019-07-22 22:26:36'),
('hafiztahir.habib@gmail.com', '$2y$10$A6sUUlUcJuIPX3V2VTSIbuktyI3HB8ZzbgvzJaDXAe9CLNf/iMi1W', '2019-07-23 06:10:17'),
('nisar081007@gmail.com', '$2y$10$Q7BROgqKZW.on7Zqpi8.oOA5gFF1lcog/ThGehnlETiV5a8B5T7nS', '2019-07-23 09:29:17'),
('Liaqathussain@gmail.com', '$2y$10$l.PQ7bLvjpNF4mA7KypPjOHtQ651sak8FwnGgHMgyurGeqCQfoX/y', '2019-07-24 06:04:18'),
('iqbalhashim70@yahoo.com', '$2y$10$NwGmawZPCoTVqHM5GAikB.RjELHK40OtigkK0bwiMesaUbpNsMQ1i', '2019-07-24 12:57:18'),
('m.wasimalikhan7@gmail.com', '$2y$10$8jTiw3DhLhmVssAl/KqHzOu6tnbB7hvNiKJ0B9kXmrmL.19bVhMr.', '2019-07-26 00:18:46'),
('hafizasabakiran786@gmail.com', '$2y$10$WkSZBazcbZvHJQ6JIywKju3ZMG9XyQ/lZZjH8ZJ6.2q5LtG4ka8dW', '2019-07-26 22:35:48'),
('midreessawati@gmail.com', '$2y$10$Jy6uGvnhtTEhDDwK8DtvD.NMmsBh8MakIl.A8nhkZ/hEIdSVjJ.ti', '2019-07-29 22:01:38'),
('sadafshahzadi925@gmail.com', '$2y$10$6RR6onEdMFOb3kSX4pwCbO5lsYDZYqSKcJ2nJ8kH4unQfpuBWLiki', '2019-07-30 22:21:55'),
('ziqra471@gmail.com', '$2y$10$lDCXzc/EhXvG3O1JE/hlQOqbfvewf0PEGGzOig1gvqRmVETqXpPu2', '2019-07-31 08:20:36'),
('taimoor.ali0400@gmail.com', '$2y$10$GT1lctfIw79/Iql96aeMTuUb84z77Iswo7TH7oMggiqNowT.0enzi', '2019-07-31 10:31:27'),
('samia123@gmail.com', '$2y$10$zVFzZRAEvLLvZePXcjqKduQ2FhA240jjDhyETSQTDCphZyWnmYzKq', '2019-08-01 00:53:27'),
('nidz.cute168@gmail.com', '$2y$10$PXai9jV4lfRWlPJGoracX.JqmyeFgc4skGL8AOfNFkN6UzQ9NnJSO', '2019-08-01 09:37:23'),
('alisawati777@gmail.com', '$2y$10$yvyVgH0/UsZ1H5Yq4JAEBOLe4wzlEwMN8YpGUao2p4CvHIIQ0jGDW', '2019-08-01 11:12:08'),
('ehma458@gmail.com', '$2y$10$NKEIBwoWBL6tvpnHqmC9UecB5oP9e.2/s50y8dVQcfWIUdgksWngy', '2019-08-03 01:04:30'),
('hafizbaseer96@gmail.com', '$2y$10$hcSuVbKuTNzCN1R3TOChK./fqezd7DYEq8zvifi9oNX2zPklKQeY6', '2019-08-05 01:02:23'),
('meerabirshad8@gmail.com', '$2y$10$0NBV2WzHImNl0BjLTmCLwuAF.rjojzanjc.8.ILJfeVBOf2M6Vh0G', '2019-08-05 12:59:27'),
('sundasnaveed7@gmail.com', '$2y$10$vhmEEw9ULiUzuzA1ZXe5TuoAkQBTMVnfrfjKlYPuU68rdvxbUnPbG', '2019-08-06 09:02:49'),
('sabakanwal844@gmail.com', '$2y$10$Enxo6GxXcYooNzXXv4MEpuv7QbqWeHzjfysvHEAUXIxBLETK4Zb0i', '2019-08-08 09:57:34'),
('afrasyab3412@gmail.com', '$2y$10$NSwQruK1UdfDWdz.aGdnU.lVZRig2yWKDtt53.FyMCFUCgrSeNaRq', '2019-08-08 18:12:46'),
('adnanbaig369@gmail.com', '$2y$10$yUbpLMc59etYLSeiYpIOHeT94QFcM4Uf/0IM3UYTSWPVH4GOGAPuG', '2019-08-08 22:11:00'),
('hafizanwarulhaq@gmail.com', '$2y$10$UH5uw.2yQ.IZZDS3ygXMU.YLsmWdWAfekPWgEGUBRegNgzM/31qJy', '2019-08-15 15:35:11'),
('usamanaseem08@gmail.com', '$2y$10$kChBjx4yF3cQ/Cf5gznYLOqg8vYq2q7gkn4WQQT8596PKBc8roGcm', '2019-08-16 11:34:23'),
('haris@yourcloudcampus.com', '$2y$10$BMpbVBhEKPVSsraub66bi.FuqJ7c226NeTuQrPDSsF9lBQr4tdzES', '2019-08-16 11:46:54'),
('noraniabbasi655@gmail.com', '$2y$10$GQ2veIdDxvQXbx6GaN/vLe9Pgadkn/jQkqOWOsqMXMcaAxc8CUIhC', '2019-08-19 18:55:54'),
('manishah0097@gmail.com', '$2y$10$v2jxlvbP6VMu6Z/J5d140u1YNO/gcSXmy3/MrqQt67rW.JKzhd3J6', '2019-08-27 23:27:18'),
('Meekatsafdar@gmail.com', '$2y$10$N6ITHxDf5anRVBmpz3U92.DpnQzDHczS8gJFfkUU13KQ5XTEaUZrq', '2019-08-28 11:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `payablecommitteds`
--

CREATE TABLE `payablecommitteds` (
  `id` int(11) NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `cheque_no` varchar(255) DEFAULT NULL,
  `scanned_cheque` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `party_name` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `maturity_date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paypalwithdrawals`
--

CREATE TABLE `paypalwithdrawals` (
  `id` int(10) UNSIGNED NOT NULL,
  `withdraw_date` date DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `modifiedBy` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prayers`
--

CREATE TABLE `prayers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prayers`
--

INSERT INTO `prayers` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Step No 1', 'Bring hands, Plams open, upto ears, and place thumbs behind earlobs, and say: Allah-O-Akbar.', NULL, NULL),
(2, 'Step No 2', 'Recite Sana.', NULL, NULL),
(3, 'Step No 3', 'Recite Towooz and Tasmia. Then Surah Fatiha and then any Surah of Quran.', NULL, NULL),
(4, 'Step No 4', 'Ruku say: (Allah-O-Akbar)\nAs bending at the waist, recite (Subhan-a-Rabbiyal Azeem) 3 times.', NULL, NULL),
(5, 'Step No 5', 'QAYYAM:\r\nWhile rising from the bending Position of Ruku.Recite:Sami Allahu Liman Hamidah.\r\n     Rab-bana Lakal Hamd.\r\nThen return to standing Position, arms at side.Recite: Allah Akbar.', NULL, NULL),
(6, 'Step No 6', 'And then assume Sajjdah position\r\nand Recite:(subhana rab-bi-yal A\'Ala)\r\nthen assume Sajjdah position once more.\r\n', NULL, NULL),
(7, 'Step No 7', 'If the required number of Rakats is but two, the salat would proceed to the next recitation.then recite: (Tashood) then recite Darood-e-Ibrahimi and then Dua after Darood-e-Ibrahimi.', NULL, NULL),
(8, 'Step No 9', '', NULL, NULL),
(9, 'Step No 10', '', NULL, NULL),
(10, 'Step No 11', '', NULL, NULL),
(11, 'Step No 12', '', NULL, NULL),
(12, 'Step No 13', '', NULL, NULL),
(13, 'Step No 14', '', NULL, NULL),
(14, 'Step No 15', '', NULL, NULL),
(15, 'Step No 16', '', NULL, NULL),
(16, 'Step No 17', '', NULL, NULL),
(17, 'Step No 8', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `id` int(10) UNSIGNED NOT NULL,
  `option` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`id`, `option`, `description`, `value`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(1, 'latecomming', 'Late Coming Margin in Mins', '0', 1, 1, '2019-01-07 03:17:54', '2019-01-24 04:50:36'),
(2, 'earlyleaving', 'Early Leaving Margin in Mins', '0', 1, 1, '2019-01-07 03:20:02', '2019-01-24 04:50:43'),
(3, 'tardylimit', 'Tardy Limit before it consider it as Short Leave in Mins', '60', 1, 1, '2019-01-08 07:40:26', '2019-01-10 08:06:27'),
(4, 'satrudayearlyleaving', 'Saturday Early Leaving Margin in Mins', '60', 1, 1, '2019-01-11 01:19:27', '2019-01-11 01:19:27'),
(5, 'tardydaydeduct', 'On how much tardys 1 day will deduct', '4', 1, 1, '2019-01-17 01:31:15', '2019-01-17 01:31:36'),
(6, 'shortleavedaydeduct', 'On How many short leaves 1 day will deduct', '2', 1, 1, '2019-01-17 01:32:09', '2019-01-17 01:32:09'),
(7, 'daysinmonth', 'Number of day in month for salary calculation', '30', 1, 1, '2019-01-17 01:45:30', '2019-01-17 01:45:30'),
(8, 'interviewmessage', 'Interview Message Template', 'Dear [NAME],\\nYour interview for the post of [POSTAPPLIED] will be held on [INTERVIEWDATA]. Kindly bring your original CNIC and CV. Address: Main Murree Road, Upon Khushhali Bank, 2nd floor, near Rehmanabad Metro Bus Stop, Rawalpindi.\\nPh # 051-8449394\\nCell # 0345-8568531', 1, 1, '2019-01-30 11:31:13', '2019-01-30 12:40:47'),
(9, 'ufoneid', 'Ufone SMS API Customer ID', '03359667296', 1, 1, '2019-01-30 11:36:40', '2019-01-30 11:36:40'),
(10, 'ufonemasking', 'Ufone Masking Value', 'ZebFortunes', 1, 1, '2019-01-30 11:38:32', '2019-01-30 11:38:32'),
(11, 'ufonepassword', 'Ufone API Password', 'ptml@123456', 1, 1, '2019-01-30 11:39:12', '2019-01-30 11:39:12'),
(12, 'ufoneapiurl', 'Ufone API URL', 'https://bsms.ufone.com/bsms_v8_api/sendapi-0.3.jsp', 1, 1, '2019-01-31 09:01:04', '2019-02-06 05:10:38'),
(13, 'absentfine', 'Absent Fine - Uninformed Absent or Leave', '200', 1, 1, '2019-02-16 08:22:44', '2019-02-16 08:22:44'),
(14, 'paypalwithdrawalnotification', 'Paypal Withdraw Notification (User Ids)', '1,254,37,29,36,30', 1, 1, '2019-03-08 06:16:57', '2019-03-08 06:46:29'),
(15, 'requiredstaffnotification', 'For Staff Required Notification Enter User ids comma separated', '1,254,37,29,36,30', 1, 1, '2019-03-09 11:41:54', '2019-03-09 11:44:25'),
(16, 'yccsupportunsatifiednotification', 'Unsatisfied Support Notification to Users', '1', 1, 1, '2019-03-09 07:23:54', '2019-03-09 07:23:54'),
(17, 'studentlecture', 'Class start/end for the student lecture email sending', '0', 1, 1, '2019-05-25 15:05:29', '2019-05-25 15:05:29'),
(18, 'usdtopkr', '1 USD to PKR', '150', 1, 1, '2019-10-04 11:22:26', '2019-10-04 11:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `projectassets`
--

CREATE TABLE `projectassets` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projectlinks`
--

CREATE TABLE `projectlinks` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkurl` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projectmessageassets`
--

CREATE TABLE `projectmessageassets` (
  `id` int(10) UNSIGNED NOT NULL,
  `message_id` int(10) UNSIGNED NOT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orginalfilename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projectmessages`
--

CREATE TABLE `projectmessages` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` tinyint(1) NOT NULL DEFAULT 1,
  `message_type` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `projectName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projectDescription` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `projectType` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Fixed or 2=Monthly',
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `lead_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=Deactive or 1=Active or 2=Closed or 3=Cancel or 4=Hold',
  `isSMM` tinyint(1) NOT NULL DEFAULT 0,
  `isiOS` tinyint(1) NOT NULL DEFAULT 0,
  `isAndroid` tinyint(1) NOT NULL DEFAULT 0,
  `isWeb` tinyint(1) NOT NULL DEFAULT 0,
  `isCustom` tinyint(1) NOT NULL DEFAULT 0,
  `amount` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `projectName`, `projectDescription`, `projectType`, `startDate`, `endDate`, `lead_id`, `user_id`, `staff_id`, `created_by`, `modified_by`, `created_at`, `updated_at`, `status`, `isSMM`, `isiOS`, `isAndroid`, `isWeb`, `isCustom`, `amount`) VALUES
(1, 'Web', 'asdasdasd', 1, '1997-02-22', '2200-10-22', 2, 811, NULL, 1, NULL, '2019-10-08 19:00:00', '2019-10-08 19:00:00', 1, 1, 1, 1, 1, 1, NULL),
(2, 'Web', 'This is description of project.', 1, '2019-10-10', NULL, 4, 813, NULL, 1, NULL, '2019-10-09 19:00:00', '2019-10-09 19:00:00', 1, 1, 1, 1, 0, 0, 50000),
(3, 'Web Project', 'this is description.', 1, '2020-03-03', '2021-02-02', 4, 813, NULL, 1, NULL, '2019-10-10 19:00:00', '2019-10-10 19:00:00', 1, 0, 0, 0, 1, 0, 5000),
(4, 'Project test', 'This is description', 1, '2020-01-02', '2021-01-02', 4, 813, NULL, 1, NULL, '2019-10-10 19:00:00', '2019-10-10 19:00:00', 1, 0, 0, 0, 1, 0, 5000),
(5, 'web app development', 'this is description', 1, '2021-01-02', '2022-02-02', 4, 813, NULL, 1, NULL, '2019-10-10 19:00:00', '2019-10-10 19:00:00', 1, 0, 0, 0, 1, 0, 5000),
(6, 'asdasd', 'asdasdsa', 1, '2020-01-02', '2020-01-01', 3, 812, NULL, 1, NULL, '2019-10-10 19:00:00', '2019-10-10 19:00:00', 1, 0, 0, 0, 1, 0, 50000),
(7, 'asdasd', 'asdasdsa', 1, '2020-01-02', '2020-01-01', 3, 812, NULL, 1, NULL, '2019-10-10 19:00:00', '2019-10-10 19:00:00', 1, 0, 0, 0, 1, 0, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `project_tasks`
--

CREATE TABLE `project_tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `startDate` timestamp NULL DEFAULT NULL,
  `endDate` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `endOn` timestamp NULL DEFAULT NULL,
  `startOn` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `reopen_by` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Open or 1=InProgress or 2=Closed or 3=ReOpen or 4=Hold',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `docfile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `uploaded_at` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `qualily_assurance_attachments`
--

CREATE TABLE `qualily_assurance_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `qa_id` int(11) NOT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quality_assurances`
--

CREATE TABLE `quality_assurances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asset_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userratings` float DEFAULT NULL,
  `status` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `qa_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recordings`
--

CREATE TABLE `recordings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recording_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lead_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_modified_by` int(10) UNSIGNED NOT NULL,
  `modified_ip` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_title`, `permissions`, `permission`, `user_id`, `created_ip`, `last_modified_by`, `modified_ip`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '{\"dashboard\":true,\"main-admins\":true,\"roles-index\":true,\"admins-index\":true,\"settings\":true,\"menu-index\":true,\"customers\":true,\"customers-index\":true,\"leads-index\":true,\"projects\":true,\"projects-index\":true,\"create-lead\":true,\"edit-lead\":true,\"status-lead\":true,\"show-lead\":true,\"delete-lead\":true,\"search-leads\":true,\"show-all-leads\":true,\"create-recording\":true,\"create-appointment\":true,\"create-doc\":true,\"create-proposal\":true,\"create-project\":true,\"upload-proposal\":true,\"edit-proposal\":true,\"create-staff\":true,\"show-staff\":true,\"edit-staff\":true,\"status-staff\":true,\"delete-staff\":true,\"staff-reset-password\":true,\"create-customer\":true,\"show-customer\":true,\"edit-customer\":true,\"status-customer\":true,\"delete-customer\":true,\"reset-customer-password\":true,\"approve-reject-lead\":true,\"for-training-lead\":true,\"chapters-index\":true,\"topics\":true,\"stats-number\":true,\"lead-chart-10\":true,\"appointment-chart-10\":true,\"today-appointments\":true,\"latest-appointments\":true,\"latest-leads\":true,\"latest-recordings\":true,\"pending-proposal\":true,\"show-dashboard-calendar\":true,\"index-yccleads\":true,\"mytask-index\":true,\"mytask-fetch\":true,\"todayMassage-index\":true,\"todayMassage-fetch\":true,\"budgetCategory-index\":true,\"budgetCategory-fetch\":true,\"budgetCategory-store\":true,\"budgetCategory-edit\":true,\"bank\":true,\"bank-index\":true,\"bank-fetch\":true,\"bank-store\":true,\"bank-edit\":true,\"payableCommitted\":true,\"payableCommitted-index\":true,\"payableCommitted-fetch\":true,\"payableCommitted-store\":true,\"payableCommitted-edit\":true,\"budgetSheet-index\":true,\"budgetSheet-fetch\":true,\"budgetSheet-edit\":true,\"budgetSheet-store\":true,\"ConsumeBudgetAmount-store\":true,\"budgetSheet-show\":true,\"payableCommitted-status\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-edit\":true,\"departments-index\":true,\"create-department\":true,\"edit-department\":true,\"delete-department\":true,\"status-department\":true,\"main-hrleads\":true,\"index-hrleads\":true,\"create-hrleads\":true,\"edit-hrleads\":true,\"show-hrleads\":true,\"delete-hrleads\":true,\"upload-hrleads\":true,\"status-hrleads\":true,\"index-interviewees\":true,\"index-interviews\":true,\"complaint-show\":true,\"complaint-comment\":true,\"designations-index\":true,\"create-designation\":true,\"edit-designation\":true,\"status-designation\":true,\"delete-designation\":true,\"preferences-index\":true,\"edit-preference\":true,\"delete-preference\":true,\"create-preference\":true,\"attendance-exception\":true,\"holidays-index\":true,\"edit-holiday\":true,\"delete-holiday\":true,\"create-holiday\":true,\"attendance-index\":true,\"yccref-index\":true,\"edit-yccref\":true,\"status-yccref\":true,\"delete-yccref\":true,\"create-yccref\":true,\"show-yccref\":true,\"edit-staff-attendance\":true,\"leaves-index\":true,\"edit-leave\":true,\"delete-leave\":true,\"create-leave\":true,\"adjustments-index\":true,\"edit-adjustment\":true,\"delete-adjustment\":true,\"create-adjustment\":true,\"locksalarysheet\":true,\"inventoryCategory-index\":true,\"inventoryCategory-fetch\":true,\"inventoryCategory-store\":true,\"inventoryCategory-edit\":true,\"inventory-index\":true,\"inventory-fetch\":true,\"inventory-store\":true,\"inventory-edit\":true,\"inventory-show\":true,\"itstation-index\":true,\"itstation-store\":true,\"itstation-fetch\":true,\"itstation-show\":true,\"inventory-issuseStore\":true,\"inventory-plusStore\":true,\"itstation-edit\":true,\"salarysheet-index\":true,\"pay-salarysheet\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"chartOfAccount-index\":true,\"chartOfAccount-fetch\":true,\"chartOfAccount-store\":true,\"chartOfAccount-edit\":true,\"journalVoucher-index\":true,\"journalVoucher-fetch\":true,\"journalVoucher-store\":true,\"journalVoucher-edit\":true,\"journalVoucher-show\":true,\"ledger-index\":true,\"paypalwithdrwal-fetch\":true,\"paypalwithdrwal-store\":true,\"paypalwithdrwal-edit\":true,\"staffrequired-index\":true,\"staffrequired-fetch\":true,\"staffrequired-store\":true,\"staffrequired-edit\":true,\"userdocumemt-index\":true,\"userdocumemt-fetch\":true,\"inventoryReport-index\":true,\"inventoryReportIn-index\":true,\"paypalwithdrwal-index\":true,\"paypalwithdrwal-active\":true,\"paypalwithdrwal-delete\":true,\"paypalwithdrwal-disable\":true,\"journalVoucher-update\":true,\"journalVoucherDetail-add\":true,\"cashbook-index\":true,\"endservice-index\":true,\"endservice-fetch\":true,\"endservice-store\":true,\"endservice-edit\":true,\"journalVoucher-disable\":true,\"complaint-disable\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"allcomplaint-index\":true,\"allcomplaint-fetch\":true,\"departcomplaint-show\":true,\"allcomplaint-show\":true,\"stats-hr\":true,\"chartOfAccount-delete\":true,\"qualityassurance-index\":true,\"qualityassurance-fetch\":true,\"qualityassurance-store\":true,\"qualityassurance-edit\":true,\"view-presentAddress\":true,\"view-permanentAddress\":true,\"view-gaurdianInfo\":true,\"view-personalContact\":true,\"view-UserDepartmentRole\":true,\"view-userAccountInfo\":true,\"view-otherInfoSettings\":true,\"view-adjustments\":true,\"view-attendance\":true,\"activitylogs\":true,\"att-approval\":true,\"att-viewapproval\":true,\"att-approve\":true,\"att-reject\":true,\"approve-adjustment\":true,\"yccsupport-fetch\":true,\"yccsupport-edit\":true,\"yccsupport-show\":true,\"yccsupport-store\":true,\"yccsupport-detail\":true,\"view-all-yccsupporttickets\":true,\"ccms\":true,\"teacher_course-index\":true,\"teacher_timing-index\":true,\"create-teacher_course\":true,\"edit-teacher_course\":true,\"delete-teacher_course\":true,\"create-teacher_timing\":true,\"edit-teacher_timing\":true,\"delete-teacher_timing\":true,\"index-parents\":true,\"create-parents\":true,\"edit-parents\":true,\"studentformparent\":true,\"create-studentparent\":true,\"show-parents\":true,\"status-parents\":true,\"createinvoice\":true,\"index-student\":true,\"create-student\":true,\"edit-student\":true,\"delete-student\":true,\"show-student\":true,\"status-student\":true,\"index-schedule\":true,\"create-schedule\":true,\"edit-schedule\":true,\"delete-schedule\":true,\"show-schedule\":true,\"index-trialconfirmation\":true,\"status-confirmtrial\":true,\"index-deadconfirmation\":true,\"status-confirmdead\":true,\"index-deadconfirmation_list\":true,\"index-daily_schedule\":true,\"startClassFunction\":true,\"endClass\":true,\"endClassFunction\":true,\"classDetails\":true,\"invoicepreview\":true,\"saveinvoice\":true,\"confirmdead_list\":true,\"toScheduleFromDeadList\":true,\"editfee\":true,\"updatefee\":true,\"invoicelistpending\":true,\"myleaves-create\":true,\"myleaves-edit\":true,\"myleaves-delete\":true,\"close-this-lead\":true}', '1,45,46,47,48,49,50,51,52,53,205,2,4,28,29,30,31,32,33,122,130,131,132,133,134,135,136,137,138,139,176,177,178,179,180,181,191,192,193,194,207,208,209,210,211,212,213,214,215,216,217,218,219,221,222,223,224,231,5,3,6,91,92,93,94,95,108,109,110,111,112,113,114,115,116,118,119,120,121,220,7,8,9,12,13,14,15,16,18,20,21,22,23,24,26,27,34,35,36,37,38,39,40,41,288,10,11,25,43,44,55,123,124,125,126,127,128,60,61,62,63,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,158,159,163,164,165,166,167,168,169,170,171,172,173,174,175,184,185,186,187,188,189,190,195,206,96,97,98,99,100,101,102,103,104,105,117,141,142,143,144,145,146,147,148,149,151,152,153,154,155,156,157,182,183,161,162,88,89,90,106,107,197,198,199,200,201,202,203,204,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,276,277,278,279,280,281,282,283,285,286,287', 1, '::1', 1, '::1', 1, '2018-08-10 19:00:00', '2019-10-16 05:16:56'),
(2, 'Development Team', '{\"dashboard\":true,\"projects\":true,\"projects-index\":true,\"mytask\":true,\"mytask-index\":true,\"mytask-fetch\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-show\":true,\"complaint-comment\":true,\"chat-view\":true,\"chat-add-new-chat-single\":true,\"#\":true,\"complaint-index\":true}', '1,10,11,59,60,61,160,162,196,88,89,106,107,198', 1, '::1', 1, '27.255.4.50', 1, '2018-08-10 19:00:00', '2019-07-25 00:00:00'),
(3, 'Sales', '{\"dashboard\":true,\"customers\":true,\"leads-index\":true,\"create-lead\":true,\"edit-lead\":true,\"show-lead\":true,\"search-leads\":true,\"create-recording\":true,\"create-appointment\":true,\"create-doc\":true,\"create-proposal\":true,\"upload-proposal\":true,\"edit-proposal\":true,\"create-customer\":true,\"show-customer\":true,\"lead-chart-10\":true,\"appointment-chart-10\":true,\"pending-proposal\":true,\"show-dashboard-calendar\":true,\"chat-view\":true,\"chat-add-new-chat-single\":true}', '1,46,47,52,53,7,9,12,13,15,18,21,22,23,24,26,27,34,35,160,162', 1, '124.109.48.193', 1, '124.109.48.193', 1, '2018-08-16 00:00:00', '2019-02-23 00:00:00'),
(4, 'Sales Manager', '{\"dashboard\":true,\"customers\":true,\"customers-index\":true,\"leads-index\":true,\"projects\":true,\"projects-index\":true,\"create-lead\":true,\"edit-lead\":true,\"status-lead\":true,\"show-lead\":true,\"search-leads\":true,\"show-all-leads\":true,\"create-recording\":true,\"create-appointment\":true,\"create-doc\":true,\"create-proposal\":true,\"create-project\":true,\"upload-proposal\":true,\"edit-proposal\":true,\"create-customer\":true,\"show-customer\":true,\"edit-customer\":true,\"status-customer\":true,\"reset-customer-password\":true,\"approve-reject-lead\":true,\"for-training-lead\":true,\"stats-number\":true,\"lead-chart-10\":true,\"appointment-chart-10\":true,\"today-appointments\":true,\"latest-appointments\":true,\"latest-leads\":true,\"latest-recordings\":true,\"pending-proposal\":true,\"yccleads\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-edit\":true,\"complaint-show\":true,\"complaint-comment\":true,\"yccref-index\":true,\"edit-yccref\":true,\"status-yccref\":true,\"create-yccref\":true,\"show-yccref\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"#\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"departcomplaint-show\":true}', '1,45,46,47,48,49,50,51,52,7,8,9,12,13,14,15,18,20,21,22,23,24,26,27,34,35,36,37,39,40,41,10,11,25,54,123,124,125,127,128,160,161,162,196,88,89,90,106,107,198,199,200,203', 1, '124.109.48.193', 1, '27.255.4.50', 1, '2018-08-16 00:00:00', '2019-07-25 00:00:00'),
(5, 'Director Sales', '{\"dashboard\":true,\"main-admins\":true,\"admins-index\":true,\"customers\":true,\"customers-index\":true,\"leads-index\":true,\"projects\":true,\"projects-index\":true,\"create-lead\":true,\"edit-lead\":true,\"status-lead\":true,\"show-lead\":true,\"delete-lead\":true,\"search-leads\":true,\"show-all-leads\":true,\"create-recording\":true,\"create-appointment\":true,\"create-doc\":true,\"create-proposal\":true,\"create-project\":true,\"upload-proposal\":true,\"edit-proposal\":true,\"show-staff\":true,\"staff-reset-password\":true,\"create-customer\":true,\"show-customer\":true,\"edit-customer\":true,\"status-customer\":true,\"delete-customer\":true,\"reset-customer-password\":true,\"approve-reject-lead\":true,\"for-training-lead\":true,\"stats-number\":true,\"lead-chart-10\":true,\"appointment-chart-10\":true,\"today-appointments\":true,\"latest-appointments\":true,\"latest-leads\":true,\"latest-recordings\":true,\"pending-proposal\":true,\"show-dashboard-calendar\":true,\"yccleads\":true,\"index-yccleads\":true,\"finance\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-show\":true,\"complaint-comment\":true,\"attendance-index\":true,\"yccref-index\":true,\"edit-yccref\":true,\"status-yccref\":true,\"create-yccref\":true,\"show-yccref\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"paypalwithdrwal-fetch\":true,\"paypalwithdrwal-store\":true,\"paypalwithdrwal-edit\":true,\"staffrequired-index\":true,\"staffrequired-fetch\":true,\"staffrequired-store\":true,\"staffrequired-edit\":true,\"paypalwithdrwal-index\":true,\"paypalwithdrwal-active\":true,\"paypalwithdrwal-delete\":true,\"paypalwithdrwal-disable\":true,\"#\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"allcomplaint-index\":true,\"allcomplaint-fetch\":true,\"departcomplaint-show\":true,\"allcomplaint-show\":true,\"view-adjustments\":true,\"view-attendance\":true,\"yccsupport-index\":true,\"yccsupport-fetch\":true,\"yccsupport-show\":true,\"yccsupport-store\":true,\"yccsupport-detail\":true,\"view-all-yccsupporttickets\":true}', '1,45,46,47,48,49,50,51,52,53,2,4,29,33,122,176,177,178,179,218,219,7,8,9,12,13,14,15,16,18,20,21,22,23,24,26,27,34,35,36,37,38,39,40,41,10,11,25,54,55,123,124,125,127,128,64,173,174,175,184,185,186,187,160,161,162,196,88,89,106,107,198,199,200,201,202,203,204,232,233,235,236,237,238', 1, '124.109.48.193', 1, '27.255.4.50', 1, '2018-08-16 00:00:00', '2019-07-25 19:12:29'),
(6, 'QA Manager', '{\"dashboard\":true,\"main-admins\":true,\"training\":true,\"chapters-index\":true,\"topics\":true,\"yccleads\":true,\"index-yccleads\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-edit\":true,\"complaint-show\":true,\"complaint-comment\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"staffrequired-index\":true,\"staffrequired-fetch\":true,\"staffrequired-store\":true,\"staffrequired-edit\":true,\"#\":true,\"complaint-disable\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"allcomplaint-index\":true,\"allcomplaint-fetch\":true,\"departcomplaint-show\":true,\"allcomplaint-show\":true,\"stats-hr\":true,\"qualityassurance-index\":true,\"qualityassurance-fetch\":true,\"qualityassurance-store\":true,\"qualityassurance-edit\":true,\"yccsupport-index\":true,\"yccsupport-fetch\":true,\"yccsupport-edit\":true,\"yccsupport-show\":true,\"yccsupport-store\":true,\"yccsupport-detail\":true,\"view-all-yccsupporttickets\":true}', '1,205,2,176,177,178,179,207,208,209,210,42,43,44,54,55,160,161,162,196,88,89,90,106,107,197,198,199,200,201,202,203,204,232,233,234,235,236,237,238', 1, '124.109.48.193', 1, '27.255.4.203', 1, '2018-08-16 00:00:00', '2019-07-19 00:00:00'),
(7, 'SMM Manager', '{\"dashboard\":true,\"customers\":true,\"leads-index\":true,\"projects\":true,\"projects-index\":true,\"show-lead\":true,\"search-leads\":true,\"show-all-leads\":true,\"create-recording\":true,\"create-doc\":true,\"create-proposal\":true,\"upload-proposal\":true,\"edit-proposal\":true,\"lead-chart-10\":true,\"appointment-chart-10\":true,\"today-appointments\":true,\"latest-appointments\":true,\"latest-leads\":true,\"yccleads\":true,\"index-yccleads\":true,\"mytask\":true,\"mytask-index\":true,\"mytask-fetch\":true,\"todayMassage-index\":true,\"todayMassage-fetch\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-show\":true,\"complaint-comment\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"#\":true,\"complaint-disable\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"departcomplaint-show\":true}', '1,46,47,48,49,50,7,9,15,18,20,21,23,24,26,27,10,11,54,55,59,60,61,62,63,160,161,162,196,88,89,106,107,197,198,199,200,203', 1, '202.141.241.218', 1, '27.255.4.50', 1, '2018-08-24 00:00:00', '2019-07-25 00:00:00'),
(8, 'Operations', '{\"dashboard\":true,\"main-admins\":true,\"admins-index\":true,\"customers\":true,\"customers-index\":true,\"leads-index\":true,\"projects\":true,\"projects-index\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-edit\":true,\"complaint-show\":true,\"complaint-comment\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"#\":true,\"complaint-disable\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"allcomplaint-index\":true,\"allcomplaint-fetch\":true,\"departcomplaint-show\":true,\"allcomplaint-show\":true}', '1,2,4,7,8,9,10,11,160,161,162,196,88,89,90,106,107,197,198,199,200,201,202,203,204', 1, '101.50.94.54', 1, '27.255.4.50', 1, '2018-08-30 00:00:00', '2019-07-25 00:00:00'),
(9, 'SMM Team', '{\"dashboard\":true,\"customers\":true,\"leads-index\":true,\"projects\":true,\"projects-index\":true,\"show-lead\":true,\"search-leads\":true,\"show-all-leads\":true,\"lead-chart-10\":true,\"appointment-chart-10\":true,\"today-appointments\":true,\"latest-appointments\":true,\"latest-leads\":true,\"yccleads\":true,\"index-yccleads\":true,\"mytask\":true,\"mytask-index\":true,\"mytask-fetch\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-show\":true,\"complaint-comment\":true,\"chat-view\":true,\"chat-add-new-chat-single\":true,\"#\":true,\"complaint-index\":true,\"departcomplaint-index\":true}', '1,46,47,48,49,50,7,9,15,18,20,10,11,54,55,59,60,61,160,162,196,88,89,106,107,198,199', 1, '101.50.94.54', 1, '27.255.4.50', 1, '2018-08-30 00:00:00', '2019-07-25 00:00:00'),
(10, 'Content Write', '{\"dashboard\":true,\"projects\":true,\"projects-index\":true,\"mytask\":true,\"mytask-index\":true,\"mytask-fetch\":true,\"chat-view\":true,\"chat-add-new-chat-single\":true}', '1,10,11,59,60,61,160,162', 1, '202.141.241.218', 1, '124.109.48.193', 1, '2018-10-08 00:00:00', '2019-02-23 00:00:00'),
(11, 'Bksol Leads Manager', '{\"dashboard\":true,\"yccleads\":true,\"index-yccleads\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-show\":true,\"complaint-comment\":true,\"yccref-index\":true,\"edit-yccref\":true,\"status-yccref\":true,\"create-yccref\":true,\"show-yccref\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"#\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"departcomplaint-show\":true}', '1,54,55,123,124,125,127,128,160,161,162,196,88,89,106,107,198,199,200,203', 1, '203.82.63.138', 1, '::1', 1, '2018-11-05 00:00:00', '2019-10-04 19:00:00'),
(14, 'Customer', '{\\\"customer\\\\/projects\\\":true,\\\"customer-projects-index\\\":true,\\\"customer-fetch-projects\\\":true,\\\"customer-show-projects\\\":true}', '56,57,58', 1, '1', 1, '27.255.4.203', 1, '2018-11-05 00:00:00', '2018-11-27 00:00:00'),
(15, 'Team Lead', '{\"dashboard\":true,\"projects\":true,\"projects-index\":true,\"create-project\":true,\"mytask\":true,\"mytask-index\":true,\"mytask-fetch\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-show\":true,\"complaint-comment\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"#\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"departcomplaint-show\":true}', '1,10,11,25,59,60,61,160,161,162,196,88,89,106,107,198,199,200,203', 1, '124.109.48.193', 1, '27.255.4.50', 1, '2018-11-28 00:00:00', '2019-07-25 00:00:00'),
(16, 'HR Manager', '{\"dashboard\":true,\"main-admins\":true,\"admins-index\":true,\"settings\":true,\"create-staff\":true,\"show-staff\":true,\"edit-staff\":true,\"status-staff\":true,\"delete-staff\":true,\"staff-reset-password\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-edit\":true,\"departments-index\":true,\"create-department\":true,\"edit-department\":true,\"delete-department\":true,\"status-department\":true,\"main-hrleads\":true,\"index-hrleads\":true,\"create-hrleads\":true,\"edit-hrleads\":true,\"show-hrleads\":true,\"delete-hrleads\":true,\"upload-hrleads\":true,\"status-hrleads\":true,\"index-interviewees\":true,\"index-interviews\":true,\"complaint-show\":true,\"complaint-comment\":true,\"designations-index\":true,\"create-designation\":true,\"edit-designation\":true,\"status-designation\":true,\"delete-designation\":true,\"holidays-index\":true,\"edit-holiday\":true,\"delete-holiday\":true,\"create-holiday\":true,\"attendance-index\":true,\"edit-staff-attendance\":true,\"leaves-index\":true,\"edit-leave\":true,\"delete-leave\":true,\"create-leave\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"staffrequired-index\":true,\"staffrequired-fetch\":true,\"staffrequired-store\":true,\"staffrequired-edit\":true,\"userdocumemt-index\":true,\"userdocumemt-fetch\":true,\"endservice-index\":true,\"endservice-fetch\":true,\"endservice-store\":true,\"endservice-edit\":true,\"#\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"departcomplaint-show\":true,\"stats-hr\":true,\"qualityassurance-index\":true,\"qualityassurance-fetch\":true,\"view-presentAddress\":true,\"view-permanentAddress\":true,\"view-gaurdianInfo\":true,\"view-personalContact\":true,\"view-UserDepartmentRole\":true,\"view-userAccountInfo\":true,\"view-otherInfoSettings\":true,\"view-adjustments\":true,\"view-attendance\":true,\"att-approval\":true}', '1,205,2,4,28,29,30,31,32,33,122,130,131,132,133,134,176,177,178,179,180,181,191,192,193,194,207,208,211,212,213,214,215,216,217,218,219,221,5,91,92,93,94,95,108,109,110,111,112,118,119,120,121,96,97,98,99,100,101,102,103,104,105,160,161,162,196,88,89,90,106,107,198,199,200,203', 1, '27.255.4.203', 1, '27.255.4.203', 1, '2019-01-10 00:00:00', '2019-07-30 00:00:00'),
(17, 'HR Executive', '{\"dashboard\":true,\"main-admins\":true,\"admins-index\":true,\"settings\":true,\"create-staff\":true,\"show-staff\":true,\"edit-staff\":true,\"status-staff\":true,\"staff-reset-password\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"departments-index\":true,\"create-department\":true,\"edit-department\":true,\"main-hrleads\":true,\"index-hrleads\":true,\"create-hrleads\":true,\"edit-hrleads\":true,\"show-hrleads\":true,\"upload-hrleads\":true,\"status-hrleads\":true,\"index-interviewees\":true,\"index-interviews\":true,\"complaint-show\":true,\"complaint-comment\":true,\"designations-index\":true,\"create-designation\":true,\"edit-designation\":true,\"holidays-index\":true,\"create-holiday\":true,\"attendance-index\":true,\"edit-staff-attendance\":true,\"leaves-index\":true,\"edit-leave\":true,\"create-leave\":true,\"chat-view\":true,\"chat-add-new-chat-single\":true,\"staffrequired-index\":true,\"staffrequired-fetch\":true,\"staffrequired-store\":true,\"staffrequired-edit\":true,\"userdocumemt-index\":true,\"userdocumemt-fetch\":true,\"endservice-index\":true,\"endservice-fetch\":true,\"endservice-store\":true,\"endservice-edit\":true,\"#\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"departcomplaint-show\":true,\"stats-hr\":true,\"qualityassurance-index\":true,\"qualityassurance-fetch\":true,\"view-presentAddress\":true,\"view-permanentAddress\":true,\"view-gaurdianInfo\":true,\"view-personalContact\":true,\"view-UserDepartmentRole\":true,\"view-userAccountInfo\":true,\"view-otherInfoSettings\":true,\"view-adjustments\":true,\"view-attendance\":true,\"att-approval\":true}', '1,205,2,4,28,29,30,31,33,122,130,131,132,134,176,177,178,179,180,181,191,192,193,194,207,208,211,212,213,214,215,216,217,218,219,221,5,91,92,93,108,109,110,118,121,96,97,98,99,100,102,103,104,105,160,162,196,88,89,106,107,198,199,200,203', 1, '27.255.4.203', 1, '27.255.4.50', 1, '2019-01-10 00:00:00', '2019-07-25 00:00:00'),
(18, 'User', '{\"dashboard\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-show\":true,\"complaint-comment\":true,\"chat-view\":true,\"chat-add-new-chat-single\":true,\"#\":true,\"complaint-index\":true}', '1,160,162,196,88,89,106,107,198', 1, '124.109.48.193', 1, '27.255.4.50', 1, '2019-01-11 00:00:00', '2019-07-25 00:00:00'),
(19, 'Testing by Developer', '{\"dashboard\":true,\"projects\":true,\"projects-index\":true,\"create-project\":true,\"mytask\":true,\"mytask-index\":true,\"mytask-fetch\":true,\"todayMassage-index\":true,\"todayMassage-fetch\":true,\"finance\":true,\"budgetCategory-index\":true,\"budgetCategory-fetch\":true,\"budgetCategory-store\":true,\"budgetCategory-edit\":true,\"bank\":true,\"bank-index\":true,\"bank-fetch\":true,\"bank-store\":true,\"bank-edit\":true,\"payableCommitted\":true,\"payableCommitted-index\":true,\"payableCommitted-fetch\":true,\"payableCommitted-store\":true,\"payableCommitted-edit\":true,\"budgetSheet-index\":true,\"budgetSheet-fetch\":true,\"budgetSheet-edit\":true,\"budgetSheet-store\":true,\"ConsumeBudgetAmount-store\":true,\"budgetSheet-show\":true,\"payableCommitted-status\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-edit\":true,\"complaint-show\":true,\"complaint-comment\":true,\"inventory\":true,\"inventoryCategory-index\":true,\"inventoryCategory-fetch\":true,\"inventoryCategory-store\":true,\"inventoryCategory-edit\":true,\"inventory-index\":true,\"inventory-fetch\":true,\"inventory-store\":true,\"inventory-edit\":true,\"inventory-show\":true,\"itstation-index\":true,\"itstation-store\":true,\"itstation-fetch\":true,\"itstation-show\":true,\"inventory-issuseStore\":true,\"inventory-plusStore\":true,\"itstation-edit\":true,\"chat-view\":true,\"chat-add-new-chat-single\":true,\"chartOfAccount-index\":true,\"chartOfAccount-fetch\":true,\"chartOfAccount-store\":true,\"chartOfAccount-edit\":true,\"journalVoucher-index\":true,\"journalVoucher-fetch\":true,\"journalVoucher-store\":true,\"journalVoucher-edit\":true,\"journalVoucher-show\":true,\"ledger-index\":true,\"inventoryReport-index\":true,\"inventoryReportIn-index\":true,\"journalVoucher-update\":true,\"journalVoucherDetail-add\":true,\"cashbook-index\":true,\"journalVoucher-disable\":true,\"#\":true,\"complaint-disable\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"allcomplaint-index\":true,\"allcomplaint-fetch\":true,\"departcomplaint-show\":true,\"allcomplaint-show\":true,\"chartOfAccount-delete\":true}', '1,10,11,25,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,163,164,165,166,167,168,169,170,171,172,188,189,190,195,206,140,141,142,143,144,145,146,147,148,149,151,152,153,154,155,156,157,182,183,160,162,196,88,89,90,106,107,197,198,199,200,201,202,203,204', 1, '124.109.48.193', 241, '119.152.77.237', 2, '2019-01-25 00:00:00', '2019-08-20 22:03:10'),
(20, 'Accounts Manager', '{\"dashboard\":true,\"main-admins\":true,\"show-staff\":true,\"finance\":true,\"budgetCategory-index\":true,\"budgetCategory-fetch\":true,\"budgetCategory-store\":true,\"budgetCategory-edit\":true,\"bank\":true,\"bank-index\":true,\"bank-fetch\":true,\"bank-store\":true,\"bank-edit\":true,\"payableCommitted\":true,\"payableCommitted-index\":true,\"payableCommitted-fetch\":true,\"payableCommitted-store\":true,\"payableCommitted-edit\":true,\"budgetSheet-index\":true,\"budgetSheet-fetch\":true,\"budgetSheet-edit\":true,\"budgetSheet-store\":true,\"ConsumeBudgetAmount-store\":true,\"budgetSheet-show\":true,\"payableCommitted-status\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-show\":true,\"complaint-comment\":true,\"attendance-index\":true,\"adjustments-index\":true,\"edit-adjustment\":true,\"delete-adjustment\":true,\"create-adjustment\":true,\"salarysheet-index\":true,\"pay-salarysheet\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"chartOfAccount-index\":true,\"chartOfAccount-fetch\":true,\"chartOfAccount-store\":true,\"chartOfAccount-edit\":true,\"journalVoucher-index\":true,\"journalVoucher-fetch\":true,\"journalVoucher-store\":true,\"journalVoucher-edit\":true,\"journalVoucher-show\":true,\"ledger-index\":true,\"paypalwithdrwal-fetch\":true,\"paypalwithdrwal-store\":true,\"paypalwithdrwal-edit\":true,\"staffrequired-index\":true,\"staffrequired-fetch\":true,\"staffrequired-store\":true,\"staffrequired-edit\":true,\"paypalwithdrwal-index\":true,\"paypalwithdrwal-active\":true,\"paypalwithdrwal-delete\":true,\"paypalwithdrwal-disable\":true,\"journalVoucher-update\":true,\"journalVoucherDetail-add\":true,\"cashbook-index\":true,\"journalVoucher-disable\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"departcomplaint-show\":true,\"chartOfAccount-delete\":true}', '1,2,29,122,135,136,137,138,176,177,178,179,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,158,159,163,164,165,166,167,168,169,170,171,172,173,174,175,184,185,186,187,188,189,190,195,206,160,161,162,88,89,106,107,198,199,200,203', 1, '27.255.4.203', 1, '27.255.4.50', 1, '2019-02-02 00:00:00', '2019-07-25 00:00:00'),
(21, 'Account Assistant', '{\"dashboard\":true,\"main-admins\":true,\"finance\":true,\"budgetCategory-index\":true,\"budgetCategory-fetch\":true,\"budgetCategory-store\":true,\"budgetCategory-edit\":true,\"bank\":true,\"bank-index\":true,\"bank-fetch\":true,\"bank-store\":true,\"bank-edit\":true,\"payableCommitted\":true,\"payableCommitted-index\":true,\"payableCommitted-fetch\":true,\"payableCommitted-store\":true,\"payableCommitted-edit\":true,\"budgetSheet-index\":true,\"budgetSheet-fetch\":true,\"budgetSheet-edit\":true,\"budgetSheet-store\":true,\"ConsumeBudgetAmount-store\":true,\"budgetSheet-show\":true,\"payableCommitted-status\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-show\":true,\"complaint-comment\":true,\"attendance-index\":true,\"salarysheet-index\":true,\"pay-salarysheet\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"chartOfAccount-index\":true,\"chartOfAccount-fetch\":true,\"chartOfAccount-store\":true,\"chartOfAccount-edit\":true,\"journalVoucher-index\":true,\"journalVoucher-fetch\":true,\"journalVoucher-store\":true,\"journalVoucher-edit\":true,\"journalVoucher-show\":true,\"ledger-index\":true,\"paypalwithdrwal-fetch\":true,\"paypalwithdrwal-store\":true,\"paypalwithdrwal-edit\":true,\"paypalwithdrwal-index\":true,\"paypalwithdrwal-active\":true,\"paypalwithdrwal-disable\":true,\"journalVoucher-update\":true,\"journalVoucherDetail-add\":true,\"cashbook-index\":true,\"journalVoucher-disable\":true,\"complaint-index\":true,\"chartOfAccount-delete\":true}', '1,2,122,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,158,159,163,164,165,166,167,168,169,170,171,172,173,174,175,184,185,187,188,189,190,195,206,160,161,162,88,89,106,107,198', 1, '27.255.4.203', 1, '27.255.4.50', 1, '2019-02-02 00:00:00', '2019-07-25 00:00:00'),
(22, 'Shift Manager', '{\"dashboard\":true,\"main-admins\":true,\"admins-index\":true,\"customers\":true,\"customers-index\":true,\"leads-index\":true,\"projects\":true,\"projects-index\":true,\"create-lead\":true,\"edit-lead\":true,\"status-lead\":true,\"show-lead\":true,\"search-leads\":true,\"show-all-leads\":true,\"create-recording\":true,\"create-appointment\":true,\"create-doc\":true,\"create-proposal\":true,\"create-project\":true,\"upload-proposal\":true,\"edit-proposal\":true,\"show-staff\":true,\"staff-reset-password\":true,\"create-customer\":true,\"show-customer\":true,\"edit-customer\":true,\"stats-number\":true,\"lead-chart-10\":true,\"appointment-chart-10\":true,\"today-appointments\":true,\"latest-appointments\":true,\"latest-leads\":true,\"latest-recordings\":true,\"pending-proposal\":true,\"show-dashboard-calendar\":true,\"yccleads\":true,\"index-yccleads\":true,\"finance\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-edit\":true,\"complaint-show\":true,\"complaint-comment\":true,\"attendance-index\":true,\"yccref-index\":true,\"edit-yccref\":true,\"status-yccref\":true,\"delete-yccref\":true,\"create-yccref\":true,\"show-yccref\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"paypalwithdrwal-fetch\":true,\"paypalwithdrwal-store\":true,\"paypalwithdrwal-edit\":true,\"staffrequired-index\":true,\"staffrequired-fetch\":true,\"staffrequired-store\":true,\"staffrequired-edit\":true,\"paypalwithdrwal-index\":true,\"#\":true,\"complaint-disable\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"allcomplaint-index\":true,\"allcomplaint-fetch\":true,\"departcomplaint-show\":true,\"allcomplaint-show\":true}', '1,45,46,47,48,49,50,51,52,53,2,4,29,33,122,176,177,178,179,7,8,9,12,13,14,15,18,20,21,22,23,24,26,27,34,35,36,10,11,25,54,55,123,124,125,126,127,128,64,173,174,175,184,160,161,162,196,88,89,90,106,107,197,198,199,200,201,202,203,204', 1, '27.255.4.50', 1, '27.255.4.50', 1, '2019-02-04 00:00:00', '2019-07-25 00:00:00'),
(23, 'IT Manager', '{\"dashboard\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-edit\":true,\"complaint-show\":true,\"complaint-comment\":true,\"inventory\":true,\"inventoryCategory-index\":true,\"inventoryCategory-fetch\":true,\"inventoryCategory-store\":true,\"inventoryCategory-edit\":true,\"inventory-index\":true,\"inventory-fetch\":true,\"inventory-store\":true,\"inventory-edit\":true,\"inventory-show\":true,\"itstation-index\":true,\"itstation-store\":true,\"itstation-fetch\":true,\"itstation-show\":true,\"inventory-issuseStore\":true,\"inventory-plusStore\":true,\"itstation-edit\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"inventoryReport-index\":true,\"inventoryReportIn-index\":true,\"#\":true,\"complaint-disable\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"allcomplaint-index\":true,\"allcomplaint-fetch\":true,\"departcomplaint-show\":true,\"allcomplaint-show\":true}', '1,140,141,142,143,144,145,146,147,148,149,151,152,153,154,155,156,157,182,183,160,161,162,196,88,89,90,106,107,197,198,199,200,201,202,203,204', 1, '124.109.48.193', 1, '27.255.4.203', 1, '2019-02-12 00:00:00', '2019-07-22 00:00:00'),
(24, 'PA to CEO', '{\"dashboard\":true,\"main-admins\":true,\"admins-index\":true,\"show-staff\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-edit\":true,\"main-hrleads\":true,\"index-hrleads\":true,\"create-hrleads\":true,\"edit-hrleads\":true,\"show-hrleads\":true,\"delete-hrleads\":true,\"upload-hrleads\":true,\"status-hrleads\":true,\"index-interviewees\":true,\"index-interviews\":true,\"complaint-show\":true,\"complaint-comment\":true,\"attendance-index\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"staffrequired-index\":true,\"staffrequired-fetch\":true,\"staffrequired-store\":true,\"staffrequired-edit\":true,\"#\":true,\"complaint-disable\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"allcomplaint-index\":true,\"allcomplaint-fetch\":true,\"departcomplaint-show\":true,\"allcomplaint-show\":true,\"qualityassurance-index\":true,\"qualityassurance-fetch\":true,\"view-presentAddress\":true,\"view-permanentAddress\":true,\"view-gaurdianInfo\":true,\"view-personalContact\":true,\"view-UserDepartmentRole\":true,\"view-userAccountInfo\":true,\"view-otherInfoSettings\":true,\"view-adjustments\":true,\"view-attendance\":true,\"yccsupport-index\":true,\"yccsupport-fetch\":true,\"yccsupport-edit\":true,\"yccsupport-show\":true,\"yccsupport-store\":true,\"yccsupport-detail\":true,\"view-all-yccsupporttickets\":true}', '1,2,4,29,122,176,177,178,179,207,208,211,212,213,214,215,216,217,218,219,96,97,98,99,100,101,102,103,104,105,160,161,162,196,88,89,90,106,107,197,198,199,200,201,202,203,204,232,233,234,235,236,237,238', 1, '27.255.4.50', 1, '27.255.4.50', 1, '2019-02-19 00:00:00', '2019-07-25 00:00:00'),
(25, 'CEO', '{\"dashboard\":true,\"main-admins\":true,\"admins-index\":true,\"settings\":true,\"customers\":true,\"customers-index\":true,\"leads-index\":true,\"projects\":true,\"projects-index\":true,\"create-lead\":true,\"edit-lead\":true,\"status-lead\":true,\"show-lead\":true,\"delete-lead\":true,\"search-leads\":true,\"show-all-leads\":true,\"create-recording\":true,\"create-appointment\":true,\"create-doc\":true,\"create-proposal\":true,\"create-project\":true,\"upload-proposal\":true,\"edit-proposal\":true,\"create-staff\":true,\"show-staff\":true,\"edit-staff\":true,\"status-staff\":true,\"staff-reset-password\":true,\"create-customer\":true,\"show-customer\":true,\"edit-customer\":true,\"status-customer\":true,\"delete-customer\":true,\"reset-customer-password\":true,\"approve-reject-lead\":true,\"for-training-lead\":true,\"training\":true,\"chapters-index\":true,\"topics\":true,\"stats-number\":true,\"lead-chart-10\":true,\"appointment-chart-10\":true,\"today-appointments\":true,\"latest-appointments\":true,\"latest-leads\":true,\"latest-recordings\":true,\"pending-proposal\":true,\"show-dashboard-calendar\":true,\"yccleads\":true,\"index-yccleads\":true,\"customer\\/projects\":true,\"customer-projects-index\":true,\"customer-fetch-projects\":true,\"mytask\":true,\"mytask-index\":true,\"mytask-fetch\":true,\"todayMassage-index\":true,\"todayMassage-fetch\":true,\"finance\":true,\"budgetCategory-index\":true,\"budgetCategory-fetch\":true,\"budgetCategory-store\":true,\"budgetCategory-edit\":true,\"bank\":true,\"bank-index\":true,\"bank-fetch\":true,\"bank-store\":true,\"bank-edit\":true,\"payableCommitted\":true,\"payableCommitted-index\":true,\"payableCommitted-fetch\":true,\"payableCommitted-store\":true,\"payableCommitted-edit\":true,\"budgetSheet-index\":true,\"budgetSheet-fetch\":true,\"budgetSheet-edit\":true,\"budgetSheet-store\":true,\"ConsumeBudgetAmount-store\":true,\"budgetSheet-show\":true,\"payableCommitted-status\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-edit\":true,\"departments-index\":true,\"create-department\":true,\"edit-department\":true,\"delete-department\":true,\"status-department\":true,\"main-hrleads\":true,\"index-hrleads\":true,\"create-hrleads\":true,\"edit-hrleads\":true,\"show-hrleads\":true,\"delete-hrleads\":true,\"upload-hrleads\":true,\"status-hrleads\":true,\"index-interviewees\":true,\"index-interviews\":true,\"complaint-show\":true,\"complaint-comment\":true,\"designations-index\":true,\"create-designation\":true,\"edit-designation\":true,\"status-designation\":true,\"delete-designation\":true,\"holidays-index\":true,\"edit-holiday\":true,\"delete-holiday\":true,\"create-holiday\":true,\"attendance-index\":true,\"yccref-index\":true,\"edit-yccref\":true,\"status-yccref\":true,\"delete-yccref\":true,\"create-yccref\":true,\"show-yccref\":true,\"leaves-index\":true,\"edit-leave\":true,\"delete-leave\":true,\"create-leave\":true,\"adjustments-index\":true,\"edit-adjustment\":true,\"delete-adjustment\":true,\"create-adjustment\":true,\"locksalarysheet\":true,\"inventory\":true,\"inventoryCategory-index\":true,\"inventoryCategory-fetch\":true,\"inventoryCategory-store\":true,\"inventoryCategory-edit\":true,\"inventory-index\":true,\"inventory-fetch\":true,\"inventory-store\":true,\"inventory-edit\":true,\"inventory-show\":true,\"index-quizleads\":true,\"itstation-index\":true,\"itstation-store\":true,\"itstation-fetch\":true,\"itstation-show\":true,\"inventory-issuseStore\":true,\"inventory-plusStore\":true,\"itstation-edit\":true,\"salarysheet-index\":true,\"pay-salarysheet\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"chartOfAccount-index\":true,\"chartOfAccount-fetch\":true,\"chartOfAccount-store\":true,\"chartOfAccount-edit\":true,\"journalVoucher-index\":true,\"journalVoucher-fetch\":true,\"journalVoucher-store\":true,\"journalVoucher-edit\":true,\"journalVoucher-show\":true,\"ledger-index\":true,\"paypalwithdrwal-fetch\":true,\"paypalwithdrwal-store\":true,\"paypalwithdrwal-edit\":true,\"staffrequired-index\":true,\"staffrequired-fetch\":true,\"staffrequired-store\":true,\"staffrequired-edit\":true,\"userdocumemt-index\":true,\"userdocumemt-fetch\":true,\"inventoryReport-index\":true,\"inventoryReportIn-index\":true,\"paypalwithdrwal-index\":true,\"#\":true,\"complaint-disable\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"allcomplaint-index\":true,\"allcomplaint-fetch\":true,\"departcomplaint-show\":true,\"allcomplaint-show\":true,\"stats-hr\":true,\"qualityassurance-index\":true,\"qualityassurance-fetch\":true,\"view-presentAddress\":true,\"view-permanentAddress\":true,\"view-gaurdianInfo\":true,\"view-personalContact\":true,\"view-UserDepartmentRole\":true,\"view-userAccountInfo\":true,\"view-otherInfoSettings\":true,\"view-adjustments\":true,\"view-attendance\":true,\"yccsupport-index\":true,\"yccsupport-fetch\":true,\"yccsupport-edit\":true,\"yccsupport-show\":true,\"yccsupport-store\":true,\"yccsupport-detail\":true,\"view-all-yccsupporttickets\":true,\"ccms\":true,\"teacher_course-index\":true,\"teacher_timing-index\":true,\"create-teacher_course\":true,\"edit-teacher_course\":true,\"delete-teacher_course\":true,\"create-teacher_timing\":true,\"edit-teacher_timing\":true,\"delete-teacher_timing\":true,\"index-parents\":true,\"create-parents\":true,\"edit-parents\":true,\"studentformparent\":true,\"create-studentparent\":true,\"show-parents\":true,\"status-parents\":true,\"createinvoice\":true,\"index-student\":true,\"create-student\":true,\"edit-student\":true,\"delete-student\":true,\"show-student\":true,\"status-student\":true,\"index-schedule\":true,\"create-schedule\":true,\"edit-schedule\":true,\"delete-schedule\":true,\"show-schedule\":true,\"index-trialconfirmation\":true,\"status-confirmtrial\":true,\"index-deadconfirmation\":true,\"status-confirmdead\":true,\"index-deadconfirmation_list\":true,\"index-daily_schedule\":true,\"startClassFunction\":true,\"endClass\":true,\"endClassFunction\":true,\"classDetails\":true,\"invoicepreview\":true,\"saveinvoice\":true,\"confirmdead_list\":true,\"toScheduleFromDeadList\":true,\"editfee\":true,\"updatefee\":true,\"invoicelistpending\":true}', '1,45,46,47,48,49,50,51,52,53,205,2,4,28,29,30,31,33,122,131,132,133,134,135,136,137,138,139,176,177,178,179,180,181,207,208,211,212,213,214,215,216,217,218,219,5,91,92,93,94,95,108,109,110,111,112,118,119,120,121,7,8,9,12,13,14,15,16,18,20,21,22,23,24,26,27,34,35,36,37,38,39,40,41,10,11,25,42,43,44,54,55,123,124,125,126,127,128,150,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,158,159,163,164,165,166,167,168,169,170,171,172,173,174,175,184,96,97,98,99,100,101,102,103,104,105,140,141,142,143,144,145,146,147,148,149,151,152,153,154,155,156,157,182,183,160,161,162,196,88,89,90,106,107,197,198,199,200,201,202,203,204,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,276,277,278,279,280,281,282,283', 1, '27.255.4.50', 1, '27.255.4.50', 1, '2019-02-27 00:00:00', '2019-07-25 00:00:00'),
(26, 'UAE Sales Force', '{\"dashboard\":true,\"yccleads\":true,\"index-yccleads\":true}', '1,54,55', 1, '27.255.4.203', 1, '27.255.4.203', 2, '2019-03-05 00:00:00', '2019-07-25 00:00:00'),
(27, 'CCMS Developer', '{\"dashboard\":true,\"projects\":true,\"projects-index\":true,\"mytask\":true,\"mytask-index\":true,\"mytask-fetch\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-show\":true,\"complaint-comment\":true,\"chat-view\":true,\"create-chat-groups\":true,\"#\":true,\"complaint-index\":true,\"yccsupport-index\":true,\"yccsupport-fetch\":true,\"yccsupport-edit\":true,\"yccsupport-show\":true,\"yccsupport-store\":true,\"yccsupport-detail\":true,\"view-all-yccsupporttickets\":true,\"ccms\":true,\"teacher_course-index\":true,\"teacher_timing-index\":true,\"create-teacher_course\":true,\"edit-teacher_course\":true,\"delete-teacher_course\":true,\"create-teacher_timing\":true,\"edit-teacher_timing\":true,\"delete-teacher_timing\":true,\"index-parents\":true,\"create-parents\":true,\"edit-parents\":true,\"studentformparent\":true,\"create-studentparent\":true,\"show-parents\":true,\"status-parents\":true,\"createinvoice\":true,\"index-student\":true,\"create-student\":true,\"edit-student\":true,\"delete-student\":true,\"show-student\":true,\"status-student\":true,\"index-schedule\":true,\"create-schedule\":true,\"edit-schedule\":true,\"delete-schedule\":true,\"show-schedule\":true,\"index-trialconfirmation\":true,\"status-confirmtrial\":true,\"index-deadconfirmation\":true,\"status-confirmdead\":true,\"index-deadconfirmation_list\":true,\"index-daily_schedule\":true,\"startClassFunction\":true,\"endClass\":true,\"endClassFunction\":true,\"classDetails\":true,\"invoicepreview\":true,\"saveinvoice\":true,\"confirmdead_list\":true,\"toScheduleFromDeadList\":true,\"editfee\":true,\"updatefee\":true,\"invoicelistpending\":true}', '1,10,11,59,60,61,160,161,196,88,89,106,107,198,232,233,234,235,236,237,238,239,240,241,242,243,244,245,246,247,248,249,250,251,252,253,254,255,256,257,258,259,260,261,262,263,264,265,266,267,268,269,270,271,272,273,274,275,276,277,278,279,280,281,282,283', 1, '202.165.225.185', 1, '27.255.4.50', 1, '2019-05-23 00:00:00', '2019-07-25 00:00:00'),
(28, 'Quality Assurance', '{\"dashboard\":true,\"main-admins\":true,\"customers\":true,\"customers-index\":true,\"leads-index\":true,\"projects\":true,\"projects-index\":true,\"training\":true,\"chapters-index\":true,\"topics\":true,\"yccleads\":true,\"index-yccleads\":true,\"mytask\":true,\"mytask-index\":true,\"mytask-fetch\":true,\"todayMassage-index\":true,\"todayMassage-fetch\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-edit\":true,\"complaint-show\":true,\"complaint-comment\":true,\"yccref-index\":true,\"status-yccref\":true,\"chat-view\":true,\"create-chat-groups\":true,\"chat-add-new-chat-single\":true,\"staffrequired-index\":true,\"staffrequired-fetch\":true,\"#\":true,\"complaint-disable\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"allcomplaint-index\":true,\"allcomplaint-fetch\":true,\"departcomplaint-show\":true,\"allcomplaint-show\":true,\"stats-hr\":true,\"qualityassurance-index\":true,\"qualityassurance-fetch\":true,\"qualityassurance-store\":true,\"qualityassurance-edit\":true,\"activitylogs\":true,\"yccsupport-index\":true,\"yccsupport-fetch\":true,\"yccsupport-edit\":true,\"yccsupport-show\":true,\"yccsupport-store\":true,\"yccsupport-detail\":true,\"view-all-yccsupporttickets\":true}', '1,205,2,176,177,207,208,209,210,220,7,8,9,10,11,42,43,44,54,55,123,125,59,60,61,62,63,160,161,162,196,88,89,90,106,107,197,198,199,200,201,202,203,204,232,233,234,235,236,237,238', 1, '27.255.4.203', 1, '27.255.4.203', 1, '2019-06-25 00:00:00', '2019-06-25 00:00:00'),
(29, 'IT Support Team', '{\"dashboard\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-edit\":true,\"complaint-show\":true,\"complaint-comment\":true,\"inventory\":true,\"inventoryCategory-index\":true,\"inventoryCategory-fetch\":true,\"inventoryCategory-store\":true,\"inventoryCategory-edit\":true,\"inventory-index\":true,\"inventory-fetch\":true,\"inventory-store\":true,\"inventory-edit\":true,\"inventory-show\":true,\"itstation-index\":true,\"itstation-store\":true,\"itstation-fetch\":true,\"itstation-show\":true,\"inventory-issuseStore\":true,\"inventory-plusStore\":true,\"itstation-edit\":true,\"chat-view\":true,\"chat-add-new-chat-single\":true,\"inventoryReport-index\":true,\"inventoryReportIn-index\":true,\"#\":true,\"complaint-disable\":true,\"complaint-index\":true,\"departcomplaint-index\":true,\"departcomplaint-fetch\":true,\"departcomplaint-show\":true}', '1,140,141,142,143,144,145,146,147,148,149,151,152,153,154,155,156,157,182,183,160,162,196,88,89,90,106,107,197,198,199,200,203', 1, '115.186.141.103', 1, '115.186.141.103', 1, '2019-07-26 00:00:00', '2019-07-26 00:00:00'),
(30, 'Teacher', '{\"dashboard\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"complaint-show\":true,\"complaint-comment\":true,\"chat-view\":true,\"chat-add-new-chat-single\":true,\"#\":true,\"complaint-index\":true,\"ccms\":true,\"index-daily_schedule\":true,\"startClassFunction\":true,\"endClass\":true,\"endClassFunction\":true,\"classDetails\":true}', '1,160,162,196,88,89,106,107,198,239,272,273,274,275,276', 1, '27.255.4.203', 1, '27.255.4.203', 1, '2019-07-30 00:00:00', '2019-07-30 00:00:00'),
(31, 'Bksol Sales Agents', '{\"dashboard\":true,\"complaint-fetch\":true,\"complaint-store\":true,\"#\":true,\"complaint-index\":true}', '1,196,88,89,198', 1, '27.255.4.50', 1, '::1', 1, '2019-08-29 00:00:00', '2019-10-04 19:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `floor_id` int(11) DEFAULT NULL,
  `room_no` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salarypartialpays`
--

CREATE TABLE `salarypartialpays` (
  `id` int(10) UNSIGNED NOT NULL,
  `dated` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amountpaid` double(8,2) NOT NULL DEFAULT 0.00,
  `paymentmethod` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `bank_id` int(11) DEFAULT NULL,
  `chequeno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `salarysheet_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salarysheets`
--

CREATE TABLE `salarysheets` (
  `id` int(10) UNSIGNED NOT NULL,
  `dated` date NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `tardies` int(11) NOT NULL DEFAULT 0,
  `shortleaves` int(11) NOT NULL DEFAULT 0,
  `absents` int(11) NOT NULL DEFAULT 0,
  `paidleaves` int(11) NOT NULL DEFAULT 0,
  `unpaidleaves` int(11) NOT NULL DEFAULT 0,
  `presents` int(11) NOT NULL DEFAULT 0,
  `totaldays` int(11) NOT NULL DEFAULT 0,
  `deductedays` int(11) NOT NULL DEFAULT 0,
  `basicsalary` double(8,2) NOT NULL DEFAULT 0.00,
  `earnedsalary` double(8,2) NOT NULL DEFAULT 0.00,
  `grosssalary` double(8,2) NOT NULL DEFAULT 0.00,
  `otherdeductions` double(8,2) NOT NULL DEFAULT 0.00,
  `absentfine` double(8,2) NOT NULL DEFAULT 0.00,
  `salarydeductions` double(8,2) NOT NULL DEFAULT 0.00,
  `totaldeductions` double(8,2) NOT NULL DEFAULT 0.00,
  `additions` double(8,2) NOT NULL DEFAULT 0.00,
  `perdaysalary` double(8,2) NOT NULL DEFAULT 0.00,
  `netsalary` double(8,2) NOT NULL DEFAULT 0.00,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `amountpaid` double(8,2) NOT NULL DEFAULT 0.00,
  `salary_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usdtopkr` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salarysheets`
--

INSERT INTO `salarysheets` (`id`, `dated`, `user_id`, `tardies`, `shortleaves`, `absents`, `paidleaves`, `unpaidleaves`, `presents`, `totaldays`, `deductedays`, `basicsalary`, `earnedsalary`, `grosssalary`, `otherdeductions`, `absentfine`, `salarydeductions`, `totaldeductions`, `additions`, `perdaysalary`, `netsalary`, `status`, `created_by`, `modified_by`, `created_at`, `updated_at`, `amountpaid`, `salary_type`, `currency_type`, `usdtopkr`) VALUES
(11, '2019-10-01', 807, 0, 0, 0, 0, 0, 2, 31, 29, 29.99, 0.00, 29.99, 0.00, 0.00, 28.99, 28.99, 0.00, 1.00, 1.00, 'Unpaid', 1, 1, '2019-10-03 19:00:00', '2019-10-03 19:00:00', 0.00, 'hourly', 'usd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salarystatuses`
--

CREATE TABLE `salarystatuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `dated` date DEFAULT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salarysheet_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `startTime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endTime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `teacherID` int(10) UNSIGNED NOT NULL,
  `studentID` int(10) UNSIGNED NOT NULL,
  `courseID` int(10) UNSIGNED NOT NULL,
  `agentId` int(10) UNSIGNED NOT NULL,
  `dateBooked` date DEFAULT NULL,
  `classType` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `dues_original` double(8,2) DEFAULT NULL,
  `dues_usd` double(8,2) DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `paydate` date DEFAULT NULL,
  `trial_confirm_by` int(10) UNSIGNED DEFAULT NULL,
  `status_dead` tinyint(3) UNSIGNED DEFAULT 0,
  `dead_date` date DEFAULT NULL,
  `confirm_dead_date` date DEFAULT NULL,
  `dead_reason` tinyint(3) UNSIGNED DEFAULT NULL,
  `comments_dead` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dead_by` int(10) UNSIGNED DEFAULT NULL,
  `confirm_dead_by` int(10) UNSIGNED DEFAULT NULL,
  `status_freeze` tinyint(3) UNSIGNED DEFAULT 0,
  `freeze_date` date DEFAULT NULL,
  `unfreeze_date` date DEFAULT NULL,
  `comments_freeze` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `freeze_by` int(10) UNSIGNED DEFAULT NULL,
  `std_status_old` tinyint(3) UNSIGNED DEFAULT NULL,
  `std_status` tinyint(3) UNSIGNED DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comments_reminder` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_reminder` date DEFAULT NULL,
  `currency_array` tinyint(3) UNSIGNED DEFAULT NULL,
  `currency_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` int(10) UNSIGNED DEFAULT NULL,
  `syllabus` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `record_link_signup` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `record_link_dead` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `record_link_freeze` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staffdetails`
--

CREATE TABLE `staffdetails` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `salary` double(8,2) NOT NULL DEFAULT 0.00,
  `cstreetaddress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cstreetaddress2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ccity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pstreetaddress` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pstreetaddress2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pcity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gaurdianname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gaurdianrelation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gaurdiancontact` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landline` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phonenumber` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bloodgroup` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `cnic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passportno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attendanceid` int(11) DEFAULT NULL,
  `extension` int(11) DEFAULT NULL,
  `ccmsid` int(11) DEFAULT NULL,
  `skypeid` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shift` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latecomming` int(11) DEFAULT NULL,
  `earlygoing` int(11) DEFAULT NULL,
  `attendancecheck` tinyint(1) NOT NULL DEFAULT 1,
  `endtime` time NOT NULL,
  `starttime` time NOT NULL,
  `hrlead_id` int(10) UNSIGNED DEFAULT NULL,
  `joiningdate` date DEFAULT NULL,
  `endingdate` date DEFAULT NULL,
  `fileno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `showinsalary` tinyint(1) NOT NULL DEFAULT 1,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'male',
  `salary_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staffdetails`
--

INSERT INTO `staffdetails` (`id`, `user_id`, `salary`, `cstreetaddress`, `cstreetaddress2`, `ccity`, `pstreetaddress`, `pstreetaddress2`, `pcity`, `gaurdianname`, `gaurdianrelation`, `gaurdiancontact`, `landline`, `phonenumber`, `bloodgroup`, `dob`, `cnic`, `passportno`, `attendanceid`, `extension`, `ccmsid`, `skypeid`, `shift`, `latecomming`, `earlygoing`, `attendancecheck`, `endtime`, `starttime`, `hrlead_id`, `joiningdate`, `endingdate`, `fileno`, `created_at`, `updated_at`, `showinsalary`, `gender`, `salary_type`, `currency_type`) VALUES
(1, 807, 29.99, 'No 121 NB Nazim abad Pindora', NULL, 'Rawalpindi', 'No 121 NB Nazim abad Pindora', NULL, 'Rawalpindi', 'asdA', 'ASDASD', '03075228959', NULL, NULL, 'A', '1999-02-02', NULL, NULL, NULL, NULL, NULL, 'Nisar Ahmed', 'day', NULL, NULL, 1, '10:42:00', '10:42:00', NULL, '2019-10-04', NULL, NULL, '2019-10-04 05:42:27', '2019-10-04 12:19:16', 1, 'male', 'hourly', 'usd');

-- --------------------------------------------------------

--
-- Table structure for table `staff_requireds`
--

CREATE TABLE `staff_requireds` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_id` int(11) NOT NULL,
  `position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_to` int(11) NOT NULL,
  `number_of_staff` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary_from` int(11) NOT NULL,
  `job_desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employeesent` int(11) NOT NULL DEFAULT 0,
  `employeejoined` int(11) NOT NULL DEFAULT 0,
  `required_date` date DEFAULT NULL,
  `requestedby` int(11) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_requireds`
--

INSERT INTO `staff_requireds` (`id`, `department_id`, `position`, `salary_to`, `number_of_staff`, `status`, `salary_from`, `job_desc`, `employeesent`, `employeejoined`, `required_date`, `requestedby`, `is_deleted`, `created_at`, `updated_at`) VALUES
(2, 8, 'IT Project Manager', 90000, 1, 'In Progress', 50000, 'IT Project Managers is responsible for the implementation of client facing and internal technical projects. They will work closely and collaborate often with clients and internal technical teams to ensure projects are completed on time and meet all deliverables.\r\nKey Responsibilities:\r\n•	Create project estimates leveraging PMO best practices.\r\n•	Effectively manage multiple concurrent complex project delivery.\r\n•	Drive business, functional and technical resolutions with the client and team members.\r\n•	Manage change, mitigations and project communication.\r\n•	Lead software or services implementations.\r\n•	Lead custom co-development projects with clients.\r\n•	Equally adept at agile and traditional waterfall methods and tools\r\n•	Submission of daily update to customers\r\nRequirements:\r\n•	Bachelor in Computer science, Engineering with Project Management focus\r\n•	5+ years of client facing Project Management experience in IT\r\n•	Perfect spoken and written English\r\n•	Expert level experience in PM software, e.g. Microsoft Project, Smartsheet, Jira, Confluence, Visio.\r\n•	Previously coached and mentor teams\r\n•	PMP certification', 0, 0, '2019-03-20', 1, 0, '2019-03-09 12:03:37', '2019-03-13 05:19:09'),
(3, 12, 'CSR', 50000, 6, 'In Progress', 18000, 'Need trainees with Good Communication skills and minimum 1 year of call center experience. Basic salary is PKR 18,000 with commissions. Salaries could vary depending on the skills and experience of the candidate', 0, 0, '2019-03-15', 29, 0, '2019-03-09 17:44:53', '2019-03-23 01:26:48'),
(4, 9, 'Math/Science Teacher', 20000, 4, 'Fullfilled', 18000, 'We need 4 Math/Science Teachers preferably Females with good communication skills and 1 year prior teaching experience.', 0, 0, '2019-03-18', 36, 0, '2019-03-15 09:43:30', '2019-03-18 05:30:34'),
(5, 11, 'TSRs', 18000, 10, 'Fullfilled', 18000, 'Having experience of dialing on any project.\r\nGood Communication Skills\r\nNeutral Accent', 0, 0, '2019-03-18', 36, 0, '2019-03-15 09:45:12', '2019-03-18 05:31:05'),
(6, 10, 'Math Major / Physics Teacher', 35, 3, 'Fullfilled', 20, 'THESE ALL REQUIREMENTS ARE FRESH ...\r\nTHE DATE WE HAVE REQUESTED ONWARDS,\r\nPLEASE DO NOT GET CONFUSE WITH PREVIOUS \r\nAND KINDLY DO MARK ONLY IF WE HAVE APPOINTED .', 1, 0, '2019-03-25', 230, 0, '2019-03-20 00:50:10', '2019-04-02 11:59:41'),
(7, 10, 'ENGLISH TEACHER', 30, 3, 'Fullfilled', 20, 'MUST HAVE 06 MONTHS TEACHING EXPERIENCE,\r\nMUST HAVE 16 YEAR EDUCATION IN RELEVANT FIELD', 3, 0, '2019-03-25', 230, 0, '2019-03-20 00:51:31', '2019-04-05 07:05:02'),
(8, 10, 'QURAN TEACHER FEMALE', 25, 5, 'In Progress', 15, 'MUST HAVE 06 MONTHS TEACHING EXPERIENCE,\r\nMUST HAVE RELEVANT  EDUCATION IN RELEVANT FIELD', 0, 0, '2019-03-25', 230, 0, '2019-03-20 00:52:40', '2019-03-21 06:38:59'),
(9, 10, 'MATH TEACHER FEMALE', 35, 3, 'Pending', 20, 'MUST HAVE 06 MONTHS TEACHING EXPERIENCE,\r\nMUST HAVE 16 YEAR EDUCATION IN RELEVANT FIELD', 0, 0, '2019-03-18', 230, 0, '2019-03-20 00:53:34', '2019-03-20 00:53:34'),
(10, 3, 'TEAM COORDINATES Male', 25, 5, 'Fullfilled', 18, 'NEED FRESH GRADUATE \r\nMUST HAVE GOOD COMMUNICATION SKILLS.\r\n16 YEARS EDUCATION IN BUSINESS, FINANCE or COMMERCE', 6, 0, '2019-03-25', 230, 0, '2019-03-20 01:02:23', '2019-04-19 05:35:54'),
(11, 3, 'TEAM COORDINATES FEMALE', 25, 3, 'In Progress', 18, 'NEED FRESH GRADUATE \r\n MUST HAVE GOOD COMMUNICATION SKILLS.\r\n 16 YEARS EDUCATION IN BUSINESS, FINANCE or COMMERCE', 0, 0, '2019-03-25', 230, 0, '2019-03-20 01:03:50', '2019-03-21 06:39:14'),
(12, 3, 'CSR NIGHT FEMALE', 25, 5, 'In Progress', 18, 'MUST HAVE GOOD COMMUNICATION SKILLS \r\nFREQUENT IN SPEAKING ENGLISH \r\nAT LEAST 03 MONTHS JOB EXPERIENCE\r\nMUST HAVE EDUCATION 12 YEARS', 0, 0, '2019-03-25', 230, 0, '2019-03-20 01:14:40', '2019-03-21 06:39:46'),
(13, 10, 'COMPUTER TEACHER', 35, 2, 'Fullfilled', 20, 'MUST HAVE COMPLETED DEGREE IN COMPUTER SCIENCE.\r\n06 MONTHS TEACHING EXPERIENCE', 0, 0, '2019-03-25', 230, 0, '2019-03-20 02:13:39', '2019-03-30 09:51:28'),
(14, 9, 'English Teacher', 20000, 1, 'Fullfilled', 18000, 'Ms. Salma Left on immediate basis. Need to fill the requirement asap', 0, 0, '2019-03-20', 36, 0, '2019-03-20 09:54:46', '2019-03-21 05:38:20'),
(15, 11, 'CSR', 18000, 25, 'In Progress', 18000, 'Having experience of dialing on any project.\r\nGood Communication Skills', 0, 0, '2019-03-23', 260, 0, '2019-03-23 11:08:40', '2019-04-02 11:55:42'),
(16, 9, 'Internee', 6000, 2, 'Pending', 5000, 'Need an internee who can assist managers in day to day operations', 0, 0, '2019-03-26', 36, 0, '2019-03-26 08:24:41', '2019-03-26 08:24:41'),
(17, 10, 'English Language Teacher (Spanish Speaking)', 60000, 1, 'Fullfilled', 20000, 'We are looking for teacher who can teach English and can teach in spanish.', 1, 0, '2019-03-27', 36, 0, '2019-03-26 12:04:10', '2019-03-29 05:14:49'),
(18, 10, 'English Language Teacher (French Speaking)', 60000, 1, 'Fullfilled', 20000, 'We are looking for teacher who can teach English in French', 1, 0, '2019-03-26', 36, 0, '2019-03-26 12:05:01', '2019-03-29 05:15:29'),
(19, 8, 'Business Development Executive', 80000, 1, 'In Progress', 50000, 'Company is seeking an experienced Business Development Executive/ Online Bidding Expert who could get business from online portals like Upwork, freelancer or Guru.\r\n\r\nCandidate is Responsible for proposal drafting & management.\r\nCandidate is responsible for bidding as well as direct marketing solely. \r\nHe / She would be responsible for bidding of Web Development, Mobile Application Development, SEO, SMM, Graphic Designing, Game Development and Digital Marketing projects.\r\nResponsible for Generating Business from online Bidding Portals.', 0, 0, '2019-04-10', 1, 0, '2019-03-28 11:09:49', '2019-03-30 05:57:34'),
(20, 9, 'Teaching Coordinator', 18000, 1, 'Pending', 15000, 'Minimum Qualification as Bachelors in preferably business studies\r\nGood Communication Skills in English', 0, 0, '2019-04-11', 36, 0, '2019-04-11 11:59:51', '2019-04-11 11:59:51'),
(21, 9, 'Teacher', 20000, 3, 'In Progress', 18000, 'Math and Physics Teachers required', 0, 0, '2019-04-16', 36, 0, '2019-04-16 07:39:21', '2019-04-19 05:37:08'),
(22, 9, 'Math Teachers', 20000, 5, 'Pending', 18000, 'Maths Teachers required', 0, 0, '2019-04-22', 36, 0, '2019-04-22 12:02:53', '2019-04-22 12:02:53'),
(23, 9, 'Math Teachers', 20000, 5, 'Pending', 18000, 'Maths Teachers required', 0, 0, '2019-04-22', 36, 0, '2019-04-22 12:02:55', '2019-04-22 12:02:55'),
(24, 13, 'Accounts Officer', 22000, 1, 'Fullfilled', 20000, 'Manage all accounting transactions.\r\nManage balance sheets and profit/loss statements.\r\nReconcile financial discrepancies by collecting and analyzing account information\r\nMust have sound knowledge & experience of Taxation\r\nSecure financial information by completing database backups\r\nVerify, allocate, post and reconcile transactions\r\nProduce error-free accounting reports and present their results\r\nParticipate in financial standards setting and in forecast process\r\nProvide input into department’s goal setting process\r\nSupport month-end and year-end close process\r\nAssist in developing and document business processes and accounting policies to maintain and strengthen internal controls\r\nCommunicate effectively with vendors\r\nCommunicate with Manager and/or Director on work status and vendor related issues that arise.\r\nMust have Bike/own transport to handle company\'s outdoor financial affairs', 2, 0, '2019-05-15', 254, 0, '2019-05-09 08:07:46', '2019-05-23 09:20:12'),
(25, 10, 'English Teacher', 30, 1, 'Pending', 20, 'English Teacher with Good Accent and communication skills. With strong grip on Grammar, Comprehension and Vocabulary', 0, 0, '2019-05-31', 29, 0, '2019-05-24 20:01:26', '2019-05-24 20:01:26'),
(26, 11, 'Sales Manager', 60000, 1, 'Pending', 30000, 'Good Communication Skills\r\nCall Center Experience\r\nSales Management', 0, 0, '2019-06-17', 36, 0, '2019-06-17 21:09:28', '2019-06-17 21:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `staff_required_statuses`
--

CREATE TABLE `staff_required_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `staffrequired_id` int(11) NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_required_statuses`
--

INSERT INTO `staff_required_statuses` (`id`, `staffrequired_id`, `updatedBy`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 246, 'In Progress', 'Job Ad has been uploaded. Will provide you required resource with in a week.', '2019-03-13 05:19:09', '2019-03-13 05:19:09'),
(2, 3, 246, 'In Progress', 'Job Ad has been uploaded. Your requirement will be fulfilled soon.', '2019-03-13 05:21:07', '2019-03-13 05:21:07'),
(3, 4, 246, 'Fullfilled', '5 Teachers will join you today as trainees.', '2019-03-18 05:30:34', '2019-03-18 05:30:34'),
(4, 5, 246, 'Fullfilled', '14 TSRs will join today as trainees.', '2019-03-18 05:31:05', '2019-03-18 05:31:05'),
(5, 2, 442, 'In Progress', '10xshortlisted CVs were sent for selection of 1xIT Project Manager', '2019-03-20 07:58:30', '2019-03-20 07:58:30'),
(6, 3, 442, 'Fullfilled', '6xTSRs were sent for training on 16th March.', '2019-03-20 08:01:23', '2019-03-20 08:01:23'),
(7, 14, 442, 'Fullfilled', 'Teacher Rabia', '2019-03-21 05:38:20', '2019-03-21 05:38:20'),
(8, 14, 442, 'Fullfilled', 'Teacher Rabia', '2019-03-21 05:38:26', '2019-03-21 05:38:26'),
(9, 14, 442, 'Fullfilled', 'Teacher Rabia', '2019-03-21 05:38:41', '2019-03-21 05:38:41'),
(10, 6, 246, 'Fullfilled', '1 is confirmed. 3 trainees sent on 11 March. 4 trainees sent on March 18. 2 trainees will join tonight.', '2019-03-21 06:31:18', '2019-03-21 06:31:18'),
(11, 7, 246, 'Fullfilled', '2 confirmed. 5 trainees sent on March 11. 2 trainees sent on March 18.', '2019-03-21 06:32:27', '2019-03-21 06:32:27'),
(12, 13, 246, 'Fullfilled', '3 trainees sent on 11 March. 2 Trainees will join tonight at 10 PM', '2019-03-21 06:35:00', '2019-03-21 06:35:00'),
(13, 8, 246, 'In Progress', 'Will provide you resource soon.', '2019-03-21 06:38:59', '2019-03-21 06:38:59'),
(14, 10, 246, 'In Progress', 'Will provide you resource soon.', '2019-03-21 06:39:07', '2019-03-21 06:39:07'),
(15, 11, 246, 'In Progress', 'Will provide you resource soon.', '2019-03-21 06:39:14', '2019-03-21 06:39:14'),
(16, 12, 246, 'In Progress', 'Will provide you resource soon.', '2019-03-21 06:39:46', '2019-03-21 06:39:46'),
(17, 10, 246, 'In Progress', 'Sir Kindly send proper JD. So, we can proceed further.', '2019-03-21 07:15:14', '2019-03-21 07:15:14'),
(18, 11, 246, 'In Progress', 'Sir Kindly send proper JD. So, we can proceed further.', '2019-03-21 07:15:30', '2019-03-21 07:15:30'),
(19, 3, 29, 'In Progress', 'Never received 6 TSRs. Only received 2 TSRs so far in the night shift', '2019-03-23 01:26:48', '2019-03-23 01:26:48'),
(20, 3, 29, 'In Progress', 'Never received 6 TSRs. Only received 2 TSRs so far in the night shift', '2019-03-23 01:27:01', '2019-03-23 01:27:01'),
(21, 6, 246, 'Fullfilled', '2 Teachers are confirmed and we had sent 7 trainees on floor. You may create new request, If need so.', '2019-03-23 09:50:38', '2019-03-23 09:50:38'),
(22, 7, 246, 'Fullfilled', '2 Teachers are confirmed and we had sent 7 trainees on floor. You may create new request, If need so.', '2019-03-23 09:51:19', '2019-03-23 09:51:19'),
(23, 17, 246, 'In Progress', 'Job ad has been posted. Your requirement will be fulfilled soon.', '2019-03-26 12:28:41', '2019-03-26 12:28:41'),
(24, 18, 246, 'In Progress', 'Job ad has been posted. Your requirement will be fulfilled soon.', '2019-03-26 12:28:50', '2019-03-26 12:28:50'),
(25, 2, 1, 'In Progress', 'We are behind the schedule.', '2019-03-27 07:21:57', '2019-03-27 07:21:57'),
(26, 17, 246, 'Fullfilled', 'Shortlisted', '2019-03-29 05:14:49', '2019-03-29 05:14:49'),
(27, 18, 246, 'Fullfilled', 'Shortlisted', '2019-03-29 05:15:29', '2019-03-29 05:15:29'),
(28, 19, 246, 'In Progress', 'Sir your requirement will be fulfilled soon.', '2019-03-30 05:57:34', '2019-03-30 05:57:34'),
(29, 13, 246, 'Fullfilled', 'Mohsin Naseer joined on March 29 and Baber Riaz joined on March 28. They both are on training.', '2019-03-30 09:51:28', '2019-03-30 09:51:28'),
(30, 15, 246, 'In Progress', 'Bilal and Altaf got hired. Rest re quirement will be fulfilled soon.', '2019-04-02 11:55:42', '2019-04-02 11:55:42'),
(31, 6, 246, 'Fullfilled', 'Nadeem Ashfaq got hired.  3 trainees (Zulfiqar Khan, Yasir Majeed and M. Shahbaz) will join tonight,Apr 2, 2019 for training.', '2019-04-02 11:59:41', '2019-04-02 11:59:41'),
(32, 7, 246, 'Fullfilled', 'Nadeem Ashfaq and Sania Shoukat got hired and Wajid Ahmed is on Training.', '2019-04-05 07:05:02', '2019-04-05 07:05:02'),
(33, 10, 246, 'Fullfilled', 'Khalid Toufeeq, Wiqas Ali, Touqeer Ijaz, Hassan Ali, Junaid-Ur-Rehman, Zia Ullah', '2019-04-19 05:35:54', '2019-04-19 05:35:54'),
(34, 21, 246, 'In Progress', 'M. Irfan', '2019-04-19 05:37:08', '2019-04-19 05:37:08'),
(35, 21, 246, 'In Progress', 'Shaista (Sci Teacher)', '2019-04-19 05:38:45', '2019-04-19 05:38:45'),
(36, 24, 246, 'In Progress', 'Requirement will be fulfilled soon.', '2019-05-10 11:09:08', '2019-05-10 11:09:08'),
(37, 24, 246, 'Fullfilled', 'Umair Riizwan is on training.', '2019-05-23 09:19:35', '2019-05-23 09:19:35'),
(38, 24, 246, 'Fullfilled', 'Umair Ramzan is on Training.', '2019-05-23 09:20:12', '2019-05-23 09:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `studentdetails`
--

CREATE TABLE `studentdetails` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `gender` tinyint(3) UNSIGNED NOT NULL,
  `dob` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studentdetails`
--

INSERT INTO `studentdetails` (`id`, `user_id`, `gender`, `dob`, `created_at`, `updated_at`) VALUES
(8, 731, 2, '2019-07-01', '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(9, 733, 2, '2019-07-01', '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(10, 734, 1, '2019-07-03', '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(4, 717, 2, '2019-07-26', '2019-07-26 00:00:00', '2019-07-28 00:00:00'),
(7, 729, 2, '2019-07-01', '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(6, 727, 1, '2019-07-01', '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(11, 736, 1, '2019-07-04', '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(12, 738, 2, '2019-07-06', '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(13, 740, 2, '2019-07-04', '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(14, 742, 1, '2019-07-09', '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(15, 744, 1, '2019-07-12', '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(16, 746, 1, '2019-07-10', '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(17, 748, 2, '2019-07-19', '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(18, 750, 2, '2019-07-19', '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(19, 752, 2, '2019-07-16', '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(20, 754, 1, '2019-07-05', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(21, 756, 1, '2019-07-12', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(22, 758, 1, '2019-07-16', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(23, 760, 2, '2019-07-02', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(24, 762, 1, '2019-07-10', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(25, 764, 1, '2019-07-18', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(26, 766, 1, '2019-07-03', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(27, 768, 2, '2019-07-10', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(28, 770, 1, '2019-07-11', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(29, 772, 2, '2019-07-11', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(30, 774, 1, '2019-07-11', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(31, 776, 2, '2019-07-19', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(32, 778, 1, '2019-07-12', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(33, 780, 2, '2019-07-04', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(34, 781, 2, '2019-07-04', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(35, 783, 2, '2019-07-26', '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(36, 784, 1, '2019-07-22', '2019-07-29 00:00:00', '2019-07-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendances`
--

CREATE TABLE `student_attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `studentID` int(10) UNSIGNED NOT NULL,
  `teacherID` int(10) UNSIGNED NOT NULL,
  `courseID` int(10) UNSIGNED NOT NULL,
  `classType` tinyint(4) DEFAULT NULL,
  `std_status` tinyint(3) UNSIGNED DEFAULT NULL,
  `startTime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `classStartTime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` tinyint(4) DEFAULT NULL,
  `lessonDetails` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endTime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lecture_image_filepath` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedule_id` int(10) UNSIGNED NOT NULL,
  `dua` int(11) DEFAULT NULL,
  `prayer` int(11) DEFAULT NULL,
  `kalima` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lesson` int(11) DEFAULT NULL,
  `surah` int(11) DEFAULT NULL,
  `verseFrom` int(11) DEFAULT NULL,
  `verseTo` int(11) DEFAULT NULL,
  `record_link` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_attendances`
--

INSERT INTO `student_attendances` (`id`, `studentID`, `teacherID`, `courseID`, `classType`, `std_status`, `startTime`, `classStartTime`, `date`, `status`, `comments`, `grade`, `lessonDetails`, `endTime`, `lecture_image_filepath`, `schedule_id`, `dua`, `prayer`, `kalima`, `extra_comments`, `lesson`, `surah`, `verseFrom`, `verseTo`, `record_link`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 597, 284, 16, 2, 1, '11:00', '12:43:10', '2019-05-25', 1, NULL, NULL, 'Pata nahi', '12:44:28', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-25 12:43:10', '2019-05-25 12:44:28', NULL),
(2, 599, 283, 3, 2, 1, '16:00', '15:07:37', '2019-05-25', 1, NULL, NULL, 'Testing details. Testing details. Testing details. Testing details. Testing details. Testing details. Testing details.', '15:08:16', '', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-05-25 15:07:37', '2019-05-25 15:08:16', NULL),
(3, 756, 645, 16, 1, 1, '12:00', '10:09:08', '2019-07-31', -1, NULL, NULL, NULL, NULL, NULL, 21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-07-31 10:09:08', '2019-07-31 10:09:08', NULL),
(4, 727, 264, 16, 1, 1, '10:00', '15:03:13', '2019-08-05', -1, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-05 15:03:13', '2019-08-05 15:03:13', NULL),
(5, 744, 264, 16, 1, 1, '15:00', '15:07:32', '2019-08-05', -1, NULL, NULL, NULL, NULL, NULL, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-05 15:07:32', '2019-08-05 15:07:32', NULL),
(6, 727, 264, 16, 1, 1, '10:00', '11:59:54', '2019-08-06', -1, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-06 11:59:54', '2019-08-06 11:59:54', NULL),
(7, 727, 264, 16, 1, 1, '10:00', '14:04:52', '2019-08-07', -1, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-07 14:04:52', '2019-08-07 14:04:52', NULL),
(8, 736, 264, 16, 1, 1, '13:00', '13:51:58', '2019-08-20', 1, 'test for the trial class', NULL, 'test for the trial class', '13:52:44', '20190820135244toddlercar1.jpg', 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test.com', '2019-08-20 13:51:58', '2019-08-20 13:52:44', 264),
(9, 731, 264, 16, 1, 1, '12:00', '13:56:49', '2019-08-20', 1, 'test for the trial class 2', NULL, 'test for the trial class 2', '13:57:43', '201908201357431565011028PrtScr capture_4.jpg', 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'test.com', '2019-08-20 13:56:49', '2019-08-20 13:57:43', 264),
(10, 746, 264, 16, 1, 1, '16:00', '13:57:48', '2019-08-20', -1, NULL, NULL, NULL, NULL, NULL, 16, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-08-20 13:57:48', '2019-08-20 13:57:48', NULL),
(11, 719, 376, 28, 3, 2, '12:00', '14:00:42', '2019-08-20', 1, NULL, NULL, NULL, '14:01:02', '', 5, 2, 2, 'Kalima 2', NULL, 2, 3, 3, 4, 'test.com', '2019-08-20 14:00:42', '2019-08-20 14:01:02', 376);

-- --------------------------------------------------------

--
-- Table structure for table `surahs`
--

CREATE TABLE `surahs` (
  `id` int(10) UNSIGNED NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surahs`
--

INSERT INTO `surahs` (`id`, `level`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Surah Al-Fatihah', '7', NULL, NULL),
(2, 'Surah Al-Baqara ', '286', NULL, NULL),
(3, 'Surah Al-i\'Imran ', '200', NULL, NULL),
(4, 'Surah An-Nisaa ', '176', NULL, NULL),
(5, 'Surah Al-Maidah ', '120', NULL, NULL),
(6, 'Surah Al-An\'am ', '165', NULL, NULL),
(7, 'Surah Al-A\'raf ', '206', NULL, NULL),
(8, 'Surah Al-Anfal ', '75', NULL, NULL),
(9, 'Surah At-Tauba ', '129', NULL, NULL),
(10, 'Surah Yunus ', '109', NULL, NULL),
(11, 'Surah Hud ', '123', NULL, NULL),
(12, 'Surah Yusuf ', '111', NULL, NULL),
(13, 'Surah Ar-Ra\'d ', '43', NULL, NULL),
(14, 'Surah Ibrahim ', '52', NULL, NULL),
(15, 'Surah Al-Hijr ', '99', NULL, NULL),
(16, 'Surah An-Nahl ', '128', NULL, NULL),
(17, 'Surah Al-Israa ', '111', NULL, NULL),
(18, 'Surah Al-Kahf ', '110', NULL, NULL),
(19, 'Surah Maryam ', '98', NULL, NULL),
(20, 'Surah Ta-ha ', '135', NULL, NULL),
(21, 'Surah Al-Anbiyaa ', '112', NULL, NULL),
(22, 'Surah Al-Hajj ', '78', NULL, NULL),
(23, 'Surah Al-Muminun ', '118', NULL, NULL),
(24, 'Surah An-Nur ', '64', NULL, NULL),
(25, 'Surah Al-Furqan ', '77', NULL, NULL),
(26, 'Surah Ash-Shu\'araa ', '227', NULL, NULL),
(27, 'Surah An-Naml ', '93', NULL, NULL),
(28, 'Surah Al-Qasas ', '88', NULL, NULL),
(29, 'Surah Al-Ankabut ', '69', NULL, NULL),
(30, 'Surah Ar-Rum ', '60', NULL, NULL),
(31, 'Surah Luqman ', '34', NULL, NULL),
(32, 'Surah As-Sajda ', '30', NULL, NULL),
(33, 'Surah Al-Ahzab ', '73', NULL, NULL),
(34, 'Surah Saba ', '54', NULL, NULL),
(35, 'Surah Fatir ', '45', NULL, NULL),
(36, 'Surah Ya-Sin ', '83', NULL, NULL),
(37, 'Surah As-Saffat ', '182', NULL, NULL),
(38, 'Surah Sad ', '88', NULL, NULL),
(39, 'Surah Az-Zumar ', '75', NULL, NULL),
(40, 'Surah Al-Mu\'min ', '85', NULL, NULL),
(41, 'Surah Ha-Mim ', '54', NULL, NULL),
(42, 'Surah Ash-Shura ', '53', NULL, NULL),
(43, 'Surah Az-Zukhruf ', '89', NULL, NULL),
(44, 'Surah Ad-Dukhan ', '59', NULL, NULL),
(45, 'Surah Al-Jathiya ', '37', NULL, NULL),
(46, 'Surah Al-Ahqaf ', '35', NULL, NULL),
(47, 'Surah Muhammad ', '38', NULL, NULL),
(48, 'Surah Al-Fat-h ', '29', NULL, NULL),
(49, 'Surah Al-Hujurat ', '18', NULL, NULL),
(50, 'Surah Qaf ', '45', NULL, NULL),
(51, 'Surah Az-Zariyat ', '60', NULL, NULL),
(52, 'Surah At-Tur ', '49', NULL, NULL),
(53, 'Surah An-Najm ', '62', NULL, NULL),
(54, 'Surah Al-Qamar ', '55', NULL, NULL),
(55, 'Surah Ar-Rahman ', '78', NULL, NULL),
(56, 'Surah Al-Waqi\'a ', '96', NULL, NULL),
(57, 'Surah Al-Hadid ', '29', NULL, NULL),
(58, 'Surah Al-Mujadila ', '22', NULL, NULL),
(59, 'Surah Al-Hashr ', '24', NULL, NULL),
(60, 'Surah Al-Mumtahana ', '13', NULL, NULL),
(61, 'Surah As-Saff ', '14', NULL, NULL),
(62, 'Surah Al-Jumu\'a ', '11', NULL, NULL),
(63, 'Surah Al-Munafiqun ', '11', NULL, NULL),
(64, 'Surah At-Tagabun ', '18', NULL, NULL),
(65, 'Surah At-Talaq ', '12', NULL, NULL),
(66, 'Surah At-Tahrim ', '12', NULL, NULL),
(67, 'Surah Al-Mulk ', '30', NULL, NULL),
(68, 'Surah Al-Qalam ', '52', NULL, NULL),
(69, 'Surah Al-Haqqa ', '52', NULL, NULL),
(70, 'Surah Al-Ma\'arij ', '44', NULL, NULL),
(71, 'Surah Nuh ', '28', NULL, NULL),
(72, 'Surah Al-Jinn ', '28', NULL, NULL),
(73, 'Surah Al-Muzzammil ', '20', NULL, NULL),
(74, 'Surah Al-Muddathth ', '56', NULL, NULL),
(75, 'Surah Al-Qiyamat ', '40', NULL, NULL),
(76, 'Surah Ad-Dahr ', '31', NULL, NULL),
(77, 'Surah Al-Mursalat ', '50', NULL, NULL),
(78, 'Surah An-Nabaa ', '40', NULL, NULL),
(79, 'Surah An-Nazi\'at ', '46', NULL, NULL),
(80, 'Surah Abasa ', '42', NULL, NULL),
(81, 'Surah At-Takwir ', '29', NULL, NULL),
(82, 'Surah Al-Infitar ', '19', NULL, NULL),
(83, 'Surah Al-Mutaffife ', '36', NULL, NULL),
(84, 'Surah Al-Inshiqaq ', '25', NULL, NULL),
(85, 'Surah Al-Buruj ', '22', NULL, NULL),
(86, 'Surah At-Tariq ', '17', NULL, NULL),
(87, 'Surah Al-A\'la ', '19', NULL, NULL),
(88, 'Surah Al-Gashiya ', '26', NULL, NULL),
(89, 'Surah Al-Fajr ', '30', NULL, NULL),
(90, 'Surah Al-Balad ', '20', NULL, NULL),
(91, 'Surah Ash-Shams ', '15', NULL, NULL),
(92, 'Surah Al-Lail ', '21', NULL, NULL),
(93, 'Surah Adh-Dhuha ', '11', NULL, NULL),
(94, 'Surah Al-Sharh ', '8', NULL, NULL),
(95, 'Surah At-Tin ', '8', NULL, NULL),
(96, 'Surah Al-Alaq ', '19', NULL, NULL),
(97, 'Surah Al-Qadr ', '5', NULL, NULL),
(98, 'Surah Al-Baiyina ', '8', NULL, NULL),
(99, 'Surah Al-Zalzalah ', '8', NULL, NULL),
(100, 'Surah Al-Adiyat ', '11', NULL, NULL),
(101, 'Surah Al-Qari\'a ', '11', NULL, NULL),
(102, 'Surah At-Takathur ', '8', NULL, NULL),
(103, 'Surah Al-Asr ', '3', NULL, NULL),
(104, 'Surah Al-Humaza ', '9', NULL, NULL),
(105, 'Surah Al-Fil ', '5', NULL, NULL),
(106, 'Surah Quraish ', '4', NULL, NULL),
(107, 'Surah Al-Ma\'un ', '7', NULL, NULL),
(108, 'Surah Al-Kauthar ', '3', NULL, NULL),
(109, 'Surah Al-Kafirun ', '6', NULL, NULL),
(110, 'Surah An-Nasr ', '3', NULL, NULL),
(111, 'Surah Al-Lahab ', '5', NULL, NULL),
(112, 'Surah Al-Ikhlas ', '4', NULL, NULL),
(113, 'Surah Al-Falaq ', '5', NULL, NULL),
(114, 'Surah Al-Nas ', '6', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `syllabuslessons`
--

CREATE TABLE `syllabuslessons` (
  `id` int(10) UNSIGNED NOT NULL,
  `lessonName` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `arabicName` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalLines` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `syllabuslessons`
--

INSERT INTO `syllabuslessons` (`id`, `lessonName`, `arabicName`, `totalLines`, `created_at`, `updated_at`) VALUES
(1, 'Lesson no 1', 'Alphabet', 7, NULL, NULL),
(2, 'Lesson no 2', 'Compound Letters', 24, NULL, NULL),
(3, 'Lesson no 3', 'Short Vowels', 14, NULL, NULL),
(4, 'Lesson no 4', 'Mixed Short Vowels', 14, NULL, NULL),
(5, 'Lesson no 5', 'Double Vowels', 14, NULL, NULL),
(6, 'Lesson no 6', 'Exercise of Short and Double Vowels to Make a Word.', 11, NULL, NULL),
(7, 'Lesson no 7', 'Long Vowels', 14, NULL, NULL),
(8, 'Lesson no 8', 'Miniature(Khara Zabar)', 6, NULL, NULL),
(9, 'Lesson no 9', 'Soft Letters', 10, NULL, NULL),
(10, 'Lesson no 10', 'Exercise of long vowels and soft letters', 21, NULL, NULL),
(11, 'Lesson no 11', 'Link sing', 6, NULL, NULL),
(12, 'Lesson no 12', 'Rules of Noon-Sakin', 20, NULL, NULL),
(13, 'Lesson no 13', 'Double Consonant', 21, NULL, NULL),
(14, 'Lesson no 14', 'Assimilation', 10, NULL, NULL),
(15, 'Lesson no 15', 'Bold and Limited Letters', 9, NULL, NULL),
(16, 'Lesson no 16', 'Prolongation ', 7, NULL, NULL),
(17, 'Lesson no 17', 'Isolated Letters', 4, NULL, NULL),
(18, 'Lesson no 18', 'Extra Letters', 7, NULL, NULL),
(19, 'Lesson no 19', 'Sings of Pause', 7, NULL, NULL),
(20, 'Lesson no 20', 'First step to learn Quran_Kareem(Sura-e-Fatiha and Sura-e-Ikhlass)', 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_courses`
--

CREATE TABLE `teacher_courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_courses`
--

INSERT INTO `teacher_courses` (`id`, `teacher_id`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 284, 16, '2019-05-24 00:00:00', '2019-05-24 00:00:00'),
(2, 283, 7, '2019-05-24 00:00:00', '2019-05-25 00:00:00'),
(3, 283, 3, '2019-05-24 00:00:00', '2019-05-25 00:00:00'),
(4, 264, 16, '2019-07-26 00:00:00', '2019-07-26 00:00:00'),
(5, 264, 26, '2019-07-26 00:00:00', '2019-07-26 00:00:00'),
(6, 376, 28, '2019-07-26 00:00:00', '2019-07-26 00:00:00'),
(7, 376, 29, '2019-07-26 00:00:00', '2019-07-26 00:00:00'),
(8, 376, 30, '2019-07-26 00:00:00', '2019-07-26 00:00:00'),
(9, 376, 31, '2019-07-26 00:00:00', '2019-07-26 00:00:00'),
(10, 295, 16, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(11, 295, 26, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(12, 303, 9, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(13, 303, 16, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(14, 364, 28, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(15, 296, 14, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(16, 296, 15, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(17, 573, 9, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(18, 418, 9, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(19, 300, 16, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(20, 283, 16, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(21, 283, 26, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(22, 280, 16, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(23, 365, 28, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(24, 368, 28, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(25, 368, 29, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(26, 368, 30, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(27, 368, 31, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(28, 276, 16, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(29, 276, 23, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(30, 271, 14, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(31, 271, 15, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(32, 271, 23, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(33, 366, 28, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(34, 366, 29, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(35, 366, 30, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(36, 366, 31, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(37, 269, 13, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(38, 269, 16, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(39, 269, 26, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(40, 265, 16, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(41, 267, 16, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(42, 377, 28, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(43, 377, 29, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(44, 377, 30, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(45, 377, 31, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(46, 375, 11, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(47, 261, 13, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(48, 261, 16, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(49, 503, 16, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(50, 645, 16, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(51, 493, 9, '2019-07-29 00:00:00', '2019-07-29 00:00:00'),
(52, 493, 16, '2019-07-29 00:00:00', '2019-07-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_timings`
--

CREATE TABLE `teacher_timings` (
  `id` int(10) UNSIGNED NOT NULL,
  `sun` int(11) DEFAULT 0,
  `mon` int(11) DEFAULT 0,
  `tue` int(11) DEFAULT 0,
  `wed` int(11) DEFAULT 0,
  `thu` int(11) DEFAULT 0,
  `fri` int(11) DEFAULT 0,
  `sat` int(11) DEFAULT 0,
  `startTime` int(11) DEFAULT NULL,
  `endTime` int(11) DEFAULT NULL,
  `breakStart` int(11) DEFAULT NULL,
  `breakEnd` int(11) DEFAULT NULL,
  `teacher_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_timings`
--

INSERT INTO `teacher_timings` (`id`, `sun`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `startTime`, `endTime`, `breakStart`, `breakEnd`, `teacher_id`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 1, 1, 1, 1, 1, 21, 39, NULL, NULL, 300, '2019-07-28 00:00:00', '2019-07-28 14:36:17'),
(2, 0, 1, 1, 1, 1, 1, 1, 19, 37, NULL, NULL, 283, '2019-05-24 00:00:00', '2019-05-24 00:00:00'),
(3, 0, 1, 1, 1, 1, 1, 1, 19, 39, NULL, NULL, 264, '2019-07-28 00:00:00', '2019-07-28 16:54:09'),
(4, 0, 1, 1, 1, 1, 1, 1, 25, 43, NULL, NULL, 376, '2019-07-26 00:00:00', '2019-07-26 00:00:00'),
(5, 0, 1, 1, 1, 1, 1, 1, 21, 39, NULL, NULL, 295, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(6, 0, 1, 1, 1, 1, 1, 1, 23, 41, NULL, NULL, 284, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(7, 0, 1, 1, 1, 1, 1, 1, 23, 41, NULL, NULL, 271, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(8, 0, 1, 1, 1, 1, 1, 1, 17, 35, NULL, NULL, 280, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(9, 0, 1, 1, 1, 1, 1, 1, 17, 35, NULL, NULL, 366, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(10, 0, 1, 1, 1, 1, 1, 1, 19, 37, NULL, NULL, 377, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(11, 0, 1, 1, 1, 1, 1, 1, 16, 37, NULL, NULL, 368, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(12, 0, 1, 1, 1, 1, 1, 1, 19, 37, NULL, NULL, 364, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(13, 0, 1, 1, 1, 1, 1, 1, 19, 37, NULL, NULL, 269, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(14, 0, 1, 1, 1, 1, 1, 1, 21, 39, NULL, NULL, 261, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(15, 0, 1, 1, 1, 1, 1, 1, 18, 36, NULL, NULL, 375, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(16, 0, 1, 1, 1, 1, 1, 1, 19, 37, NULL, NULL, 276, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(17, 0, 1, 1, 1, 1, 1, 1, 17, 35, NULL, NULL, 296, '2019-07-28 00:00:00', '2019-07-28 14:24:23'),
(18, 0, 1, 1, 1, 1, 1, 1, 19, 37, NULL, NULL, 365, '2019-07-28 00:00:00', '2019-07-28 14:30:10'),
(19, 0, 1, 1, 1, 1, 1, 1, 17, 35, NULL, NULL, 267, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(20, 0, 1, 1, 1, 1, 1, 1, 17, 39, NULL, NULL, 303, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(21, 0, 1, 1, 1, 1, 1, 1, 21, 39, NULL, NULL, 265, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(22, 0, 1, 1, 1, 1, 1, 1, 21, 39, NULL, NULL, 418, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(23, 0, 1, 1, 1, 1, 1, 1, 19, 37, NULL, NULL, 573, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(24, 0, 1, 1, 1, 1, 1, 1, 21, 39, NULL, NULL, 445, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(25, 0, 1, 1, 1, 1, 1, 1, 17, 35, NULL, NULL, 304, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(26, 0, 1, 1, 1, 1, 1, 1, 19, 39, NULL, NULL, 493, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(27, 0, 1, 1, 1, 1, 1, 1, 21, 41, NULL, NULL, 370, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(28, 0, 1, 1, 1, 1, 1, 1, 17, 35, NULL, NULL, 367, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(29, 0, 1, 1, 1, 1, 1, 1, 19, 37, NULL, NULL, 372, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(30, 0, 1, 1, 1, 1, 1, 1, 17, 37, NULL, NULL, 299, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(31, 0, 1, 1, 1, 1, 1, 1, 21, 39, NULL, NULL, 286, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(32, 0, 1, 1, 1, 1, 1, 1, 16, 35, NULL, NULL, 371, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(33, 0, 1, 1, 1, 1, 1, 1, 17, 35, NULL, NULL, 373, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(34, 0, 1, 1, 1, 1, 1, 1, 23, 41, NULL, NULL, 263, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(35, 0, 1, 1, 1, 1, 1, 1, 23, 41, NULL, NULL, 647, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(36, 0, 1, 1, 1, 1, 1, 1, 19, 37, NULL, NULL, 484, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(37, 0, 1, 1, 1, 1, 1, 1, 19, 41, NULL, NULL, 349, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(38, 0, 1, 1, 1, 1, 1, 1, 21, 39, NULL, NULL, 562, '2019-07-28 00:00:00', '2019-07-28 00:00:00'),
(39, 0, 1, 1, 1, 1, 1, 1, 17, 35, NULL, NULL, 645, '2019-07-29 00:00:00', '2019-07-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chapterId` int(10) UNSIGNED NOT NULL,
  `orderId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `un_read_messages`
--

CREATE TABLE `un_read_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isGoOnAppoints` tinyint(1) DEFAULT 0,
  `officialemail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `iscustomer` tinyint(1) NOT NULL DEFAULT 0,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `designation_id` int(10) DEFAULT NULL,
  `department_id` int(10) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `createdby` int(10) UNSIGNED DEFAULT NULL,
  `updatedby` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `phonenumber`, `avatar`, `status`, `remember_token`, `isGoOnAppoints`, `officialemail`, `created_at`, `updated_at`, `otp`, `iscustomer`, `role_id`, `designation_id`, `department_id`, `parent_id`, `createdby`, `updatedby`) VALUES
(1, 'Shahid', 'Umar', 'shahid.umar@gmail.com', '$2y$10$nR20zJtl9lrqHiguXCd82.4Lyo2ah.YbTYucpjcekWg..jocWqL.6', '03445000084', '1530012575shahid.jpg', 1, 'HO19xxO4yY51tW99qeaYo8sWCbHhCHCTnClRGzYyLfFhm6neJpDowpPgLzLl', 0, NULL, '2018-06-25 15:22:52', '2019-10-16 04:45:33', 112259, 0, 1, 2, 2, NULL, NULL, 246),
(37, 'Imran', 'Zeb', 'imran.cloudcampus@gmail.com', '$2y$10$JEn/ROSJYDxoG5SgmZrhYu5Jqt5hPpXTXKbfy/CnDfLhpuAuckyja', '123123', 'default_avatar_male.jpg', 1, '8W7m5Xh8Gt6WeD8vJkaiFRhufmewXvhj9qbefvH3Pncx8kehhuTzksofg4vs', 0, NULL, '2018-08-18 00:00:00', '2019-02-07 17:43:32', 0, 0, 1, NULL, NULL, NULL, NULL, NULL),
(814, 'Nisar', 'Ahmed', 'nisar081oo7@gmail.com', '$2y$10$z7scLzgvNZUc7A.6ecTHwua/I.O6.rErPcQI.FKjUov8xcp56pr.m', '03075228959', NULL, 1, NULL, 0, NULL, '2019-10-14 19:00:00', '2019-10-14 19:00:00', NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_checklists`
--

CREATE TABLE `user_checklists` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_checklists`
--

INSERT INTO `user_checklists` (`id`, `user_id`, `document_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 403, 1, 'yes', '2019-02-12 07:26:57', '2019-02-12 07:56:06'),
(2, 403, 2, 'yes', '2019-02-12 07:26:57', '2019-02-12 07:56:06'),
(3, 403, 3, 'yes', '2019-02-12 07:56:06', '2019-02-12 07:56:06'),
(4, 403, 4, 'no', '2019-02-12 07:56:06', '2019-02-12 07:56:06'),
(5, 403, 5, 'no', '2019-02-12 07:56:06', '2019-02-12 07:56:06'),
(6, 403, 6, 'yes', '2019-02-12 07:56:06', '2019-02-12 07:56:06'),
(7, 403, 7, 'no', '2019-02-12 07:56:06', '2019-02-12 07:56:06'),
(8, 403, 8, 'yes', '2019-02-12 07:56:06', '2019-02-12 07:56:06'),
(9, 403, 11, 'n/a', '2019-02-12 08:01:54', '2019-02-12 08:01:54'),
(10, 246, 1, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(11, 246, 2, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(12, 246, 4, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(13, 246, 5, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(14, 246, 6, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(15, 246, 7, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(16, 246, 8, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(17, 246, 9, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(18, 246, 10, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(19, 246, 11, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(20, 246, 12, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(21, 246, 13, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(22, 246, 14, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(23, 246, 16, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(24, 246, 17, 'yes', '2019-03-22 09:15:48', '2019-04-10 07:04:50'),
(25, 254, 1, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(26, 254, 2, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(27, 254, 4, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(28, 254, 5, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(29, 254, 6, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(30, 254, 7, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(31, 254, 8, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(32, 254, 9, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(33, 254, 10, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(34, 254, 11, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(35, 254, 12, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(36, 254, 13, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(37, 254, 14, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(38, 254, 16, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(39, 254, 17, 'yes', '2019-04-10 05:56:25', '2019-04-10 05:56:31'),
(40, 29, 1, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(41, 29, 2, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(42, 29, 4, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(43, 29, 5, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(44, 29, 6, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(45, 29, 7, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(46, 29, 8, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(47, 29, 9, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(48, 29, 10, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(49, 29, 11, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(50, 29, 12, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(51, 29, 13, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(52, 29, 14, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(53, 29, 16, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(54, 29, 17, 'yes', '2019-04-10 06:57:29', '2019-04-10 06:57:29'),
(55, 36, 1, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(56, 36, 2, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(57, 36, 4, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(58, 36, 5, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(59, 36, 6, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(60, 36, 7, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(61, 36, 8, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(62, 36, 9, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(63, 36, 10, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(64, 36, 11, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(65, 36, 12, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(66, 36, 13, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(67, 36, 14, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(68, 36, 16, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(69, 36, 17, 'yes', '2019-04-10 07:00:26', '2019-04-10 07:00:26'),
(70, 210, 1, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(71, 210, 2, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(72, 210, 4, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(73, 210, 5, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(74, 210, 6, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(75, 210, 7, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(76, 210, 8, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(77, 210, 9, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(78, 210, 10, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(79, 210, 11, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(80, 210, 12, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(81, 210, 13, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(82, 210, 14, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(83, 210, 15, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(84, 210, 16, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(85, 210, 17, 'yes', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(86, 210, 18, 'n/a', '2019-04-10 07:01:42', '2019-04-10 07:01:42'),
(87, 246, 15, 'n/a', '2019-04-10 07:04:50', '2019-04-10 07:04:50'),
(88, 246, 18, 'n/a', '2019-04-10 07:04:50', '2019-04-10 07:04:50'),
(89, 246, 19, 'n/a', '2019-04-10 07:04:50', '2019-04-10 07:04:50'),
(90, 249, 1, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(91, 249, 2, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(92, 249, 4, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(93, 249, 5, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(94, 249, 6, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(95, 249, 7, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(96, 249, 8, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(97, 249, 9, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(98, 249, 10, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(99, 249, 11, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(100, 249, 12, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(101, 249, 13, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(102, 249, 14, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(103, 249, 15, 'n/a', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(104, 249, 16, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(105, 249, 17, 'yes', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(106, 249, 18, 'n/a', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(107, 249, 19, 'n/a', '2019-04-10 07:05:39', '2019-04-10 07:05:39'),
(108, 279, 1, 'yes', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(109, 279, 2, 'yes', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(110, 279, 4, 'yes', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(111, 279, 5, 'yes', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(112, 279, 6, 'yes', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(113, 279, 7, 'yes', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(114, 279, 8, 'yes', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(115, 279, 9, 'yes', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(116, 279, 10, 'yes', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(117, 279, 11, 'yes', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(118, 279, 12, 'n/a', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(119, 279, 13, 'yes', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(120, 279, 14, 'yes', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(121, 279, 15, 'n/a', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(122, 279, 16, 'yes', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(123, 279, 17, 'n/a', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(124, 279, 18, 'n/a', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(125, 279, 19, 'yes', '2019-04-10 07:07:05', '2019-04-10 07:07:05'),
(126, 263, 1, 'yes', '2019-07-06 21:15:56', '2019-07-06 21:15:56'),
(127, 263, 2, 'yes', '2019-07-06 21:15:56', '2019-07-06 21:15:56'),
(128, 263, 4, 'yes', '2019-07-06 21:15:56', '2019-07-06 21:15:56'),
(129, 263, 5, 'yes', '2019-07-06 21:15:56', '2019-07-06 21:15:56'),
(130, 263, 6, 'yes', '2019-07-06 21:15:56', '2019-07-06 21:15:56'),
(131, 263, 7, 'yes', '2019-07-06 21:15:56', '2019-07-06 21:15:56'),
(132, 263, 8, 'yes', '2019-07-06 21:15:56', '2019-07-06 21:15:56'),
(133, 263, 9, 'yes', '2019-07-06 21:15:56', '2019-07-06 21:15:56'),
(134, 263, 10, 'yes', '2019-07-06 21:15:56', '2019-07-06 21:15:56'),
(135, 263, 11, 'yes', '2019-07-06 21:15:56', '2019-07-06 21:15:56'),
(136, 263, 13, 'yes', '2019-07-06 21:15:56', '2019-07-06 21:15:56'),
(137, 263, 14, 'yes', '2019-07-06 21:15:56', '2019-07-06 21:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_documents`
--

CREATE TABLE `user_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `points` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_documents`
--

INSERT INTO `user_documents` (`id`, `points`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, '2 Photocopies of NIC(Attested)', 'Active', '', '2019-02-12 05:17:14', '2019-02-12 05:38:11'),
(2, 'Two Passport size Photographs', 'Active', '', '2019-02-12 05:18:05', '2019-02-12 05:18:05'),
(4, 'Employee Information Record Form', 'Active', '', '2019-02-12 07:42:03', '2019-02-12 07:42:03'),
(5, 'Job Application Form', 'Active', '', '2019-02-12 07:42:15', '2019-02-12 07:42:15'),
(6, 'Employee\'s Curriculum Vita', 'Active', '', '2019-02-12 07:42:37', '2019-02-12 07:42:37'),
(7, 'Employees Offer Letter', 'Active', '', '2019-02-12 07:42:50', '2019-02-12 07:42:50'),
(8, 'Verified Training Letter', 'Active', '', '2019-02-12 07:43:07', '2019-02-12 07:43:07'),
(9, 'Trainee\'s Undertaking', 'Active', '', '2019-02-12 07:43:21', '2019-02-12 07:43:21'),
(10, 'Appointment Letter', 'Active', '', '2019-02-12 07:43:32', '2019-02-12 07:43:32'),
(11, 'Contract Agreement', 'Active', '', '2019-02-12 07:43:45', '2019-02-12 07:43:45'),
(12, 'Confirmation Letter', 'Active', '', '2019-02-12 07:44:07', '2019-02-12 07:44:07'),
(13, 'Employee\'s Cross Cheque /Document Receiving', 'Active', '', '2019-02-12 07:44:36', '2019-02-12 07:44:36'),
(14, 'Reference Letter 2 (with Reference CNIC).', 'Active', '', '2019-02-12 07:45:00', '2019-02-12 07:45:00'),
(15, 'Notices (Latest First).', 'Active', '', '2019-02-12 07:45:13', '2019-02-12 07:45:13'),
(16, 'Documents Photocopy (Attested).', 'Active', '', '2019-02-12 07:45:31', '2019-02-12 07:45:31'),
(17, 'Employee\'s Organization Identity Card', 'Active', '', '2019-02-12 07:45:46', '2019-02-12 07:45:46'),
(18, 'Employee\'s Memo', 'Active', '', '2019-02-12 07:45:55', '2019-02-12 07:45:55'),
(19, 'Exit Procedure', 'Active', '', '2019-02-12 07:46:03', '2019-02-12 07:46:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_end_services`
--

CREATE TABLE `user_end_services` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `reason` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `endingdate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_end_services`
--

INSERT INTO `user_end_services` (`id`, `user_id`, `reason`, `type`, `attachment`, `endingdate`, `created_at`, `updated_at`) VALUES
(1, 362, 'Due to his studies he is not able to continue.', 'Resign', NULL, NULL, '2019-02-21 07:14:58', '2019-02-21 07:14:58'),
(2, 266, 'Due to Study.', 'Resign', NULL, NULL, '2019-02-22 07:44:38', '2019-02-22 07:44:38'),
(3, 399, 'NSNC', 'Terminate', NULL, NULL, '2019-02-22 07:51:31', '2019-02-22 07:51:31'),
(4, 402, 'Not up to the mark', 'Terminate', NULL, NULL, '2019-02-22 07:52:47', '2019-02-22 07:52:47'),
(5, 322, 'Study Problem', 'Resign', NULL, NULL, '2019-02-22 07:58:29', '2019-02-22 07:58:29'),
(6, 328, 'Due to Study', 'Resign', NULL, NULL, '2019-02-22 08:01:15', '2019-02-22 08:01:15'),
(7, 293, 'Job in Punjab Group of Colleges', 'Resign', NULL, '2019-03-07', '2019-03-07 07:22:29', '2019-03-25 06:50:51'),
(8, 293, 'Job in Punjab Group of Colleges', 'Resign', NULL, '2019-03-07', '2019-03-07 07:23:15', '2019-03-25 06:50:51'),
(9, 319, 'Wedding', 'Resign', NULL, NULL, '2019-03-07 07:24:00', '2019-03-07 07:24:00'),
(10, 319, 'Wedding', 'Resign', NULL, NULL, '2019-03-07 07:24:35', '2019-03-07 07:24:35'),
(11, 262, 'Some personal issues and job in Punjab College JBD.', 'Resign', NULL, NULL, '2019-03-07 07:26:51', '2019-03-07 07:26:51'),
(12, 262, 'Some personal issues and job in Punjab College JBD.', 'Resign', NULL, NULL, '2019-03-07 07:29:11', '2019-03-07 07:29:11'),
(13, 414, 'Need to update by HR.', 'Terminate', NULL, '2019-03-12', '2019-03-25 06:57:26', '2019-03-25 06:57:26'),
(14, 339, 'Need to update by HR', 'Resign', NULL, '2019-03-12', '2019-03-25 06:58:45', '2019-03-25 06:58:45'),
(15, 409, 'Got good job.', 'Resign', NULL, '2019-03-31', '2019-04-02 06:11:33', '2019-04-02 06:11:33'),
(16, 429, 'End Of Services on Low Performance', 'Terminate', NULL, '2019-03-27', '2019-04-02 06:28:49', '2019-04-02 06:28:49'),
(17, 332, 'NCNS', 'Terminate', NULL, '2019-03-20', '2019-04-02 06:32:37', '2019-04-02 06:32:37'),
(18, 384, 'NCNS', 'Terminate', NULL, '2019-03-23', '2019-04-02 06:38:41', '2019-04-02 06:38:41'),
(19, 432, 'NCNS', 'Terminate', NULL, '2019-03-15', '2019-04-02 06:41:17', '2019-04-02 06:41:17'),
(20, 437, 'NCNS', 'Terminate', NULL, '2019-03-12', '2019-04-02 06:46:29', '2019-04-02 06:46:29'),
(21, 451, 'Can\'t continue due to personal issues', 'Terminate', NULL, '2019-03-16', '2019-04-02 06:47:10', '2019-04-02 06:47:10'),
(22, 279, 'Got job in Dubai', 'Resign', NULL, '2019-04-02', '2019-04-10 07:07:40', '2019-04-10 07:07:40'),
(23, 463, 'Got job in army', 'Resign', NULL, '2019-04-10', '2019-04-17 06:48:13', '2019-04-19 07:06:15'),
(24, 448, 'Health Issues', 'Resign', NULL, '2019-04-10', '2019-04-19 06:46:49', '2019-04-19 06:48:24'),
(25, 302, 'Health Issues', 'Other Issue', NULL, '2019-04-04', '2019-04-19 06:50:39', '2019-04-19 06:50:39'),
(26, 270, 'NCNS', 'Terminate', NULL, '2019-04-01', '2019-04-19 06:56:13', '2019-04-19 06:56:13'),
(27, 337, 'NCNS', 'Terminate', NULL, '2019-04-01', '2019-04-19 06:57:22', '2019-04-19 06:57:22'),
(28, 289, 'Low performance', 'Terminate', NULL, '2019-04-08', '2019-04-19 06:58:21', '2019-04-19 06:59:02'),
(29, 388, 'Low performance', 'Terminate', NULL, '2019-04-23', '2019-04-26 12:38:00', '2019-04-26 12:38:00'),
(30, 327, 'NCNS', 'Terminate', NULL, '2019-04-01', '2019-04-26 12:57:31', '2019-04-26 12:58:13'),
(31, 343, 'Casual Attitude', 'Terminate', NULL, '2019-04-27', '2019-04-29 11:18:23', '2019-04-29 11:18:23'),
(32, 488, 'NCNS', 'Terminate', NULL, '2019-04-19', '2019-04-29 13:41:25', '2019-04-29 13:41:25'),
(33, 379, 'Went to Saudi Arabia', 'Resign', NULL, '2019-04-19', '2019-04-30 09:24:09', '2019-04-30 09:24:09'),
(34, 433, 'Low performance', 'Terminate', NULL, '2019-04-22', '2019-04-30 13:38:59', '2019-04-30 13:38:59'),
(35, 408, 'NCNS', 'Terminate', NULL, '2019-04-24', '2019-04-30 13:58:17', '2019-04-30 13:58:18'),
(36, 334, 'NCNS', 'Terminate', NULL, '2019-04-26', '2019-04-30 14:02:05', '2019-04-30 14:02:05'),
(37, 268, 'Got new job', 'Resign', NULL, '2019-04-30', '2019-05-01 07:05:39', '2019-05-01 07:06:36'),
(38, 435, 'NCNS', 'Terminate', NULL, '2019-05-03', '2019-05-01 11:02:20', '2019-05-03 12:41:59'),
(39, 428, 'Excessive Leaves and Late Arrivals', 'Terminate', NULL, '2019-04-24', '2019-05-02 11:19:54', '2019-05-02 11:19:54'),
(40, 410, 'NCNS', 'Terminate', NULL, '2019-04-03', '2019-05-02 14:51:11', '2019-05-02 14:51:11'),
(41, 241, 'Not meeting targets', 'Resign', NULL, '2019-05-02', '2019-05-03 12:54:26', '2019-05-03 12:54:26'),
(42, 314, 'Resigned', 'Resign', NULL, '2019-04-30', '2019-05-03 13:03:19', '2019-05-03 13:03:19'),
(43, 436, 'Low performance', 'Terminate', NULL, '2019-04-10', '2019-05-04 06:23:47', '2019-05-04 13:43:24'),
(44, 554, 'Convince Issue', 'Terminate', NULL, '2019-05-02', '2019-05-04 06:38:07', '2019-05-04 06:39:25'),
(45, 502, 'End of services', 'Resign', NULL, '2019-04-30', '2019-05-04 06:43:22', '2019-05-04 06:43:22'),
(46, 473, 'End of services', 'Terminate', NULL, '2019-05-03', '2019-05-04 07:19:09', '2019-05-04 07:19:09'),
(47, 441, 'End of services', 'Terminate', NULL, '2019-05-01', '2019-05-04 07:20:26', '2019-05-04 07:20:26'),
(48, 480, 'NCNS', 'Terminate', NULL, '2019-05-01', '2019-05-04 14:15:29', '2019-05-04 14:15:29'),
(49, 351, 'NCNS', 'Terminate', NULL, '2019-04-01', '2019-05-06 08:39:29', '2019-05-06 08:40:00'),
(50, 338, 'NCNS', 'Terminate', NULL, '2019-04-24', '2019-05-06 08:41:28', '2019-05-06 08:41:52'),
(51, 415, 'NCNS', 'Terminate', NULL, '2019-04-18', '2019-05-06 08:42:47', '2019-05-06 08:42:47'),
(52, 512, 'Casual Attitude', 'Terminate', NULL, '2019-06-10', '2019-05-06 13:37:11', '2019-06-11 19:14:17'),
(53, 325, 'Got Job', 'Resign', NULL, '2019-04-30', '2019-05-07 04:45:40', '2019-05-07 04:45:40'),
(54, 565, 'Got Job', 'Terminate', NULL, '2019-05-07', '2019-05-07 09:51:09', '2019-05-07 09:51:09'),
(55, 298, 'Got job.', 'Resign', NULL, '2019-04-30', '2019-05-08 06:57:05', '2019-05-08 06:57:05'),
(56, 482, 'Services ended', 'Terminate', NULL, '2019-04-30', '2019-05-08 06:58:02', '2019-05-08 06:58:02'),
(57, 324, 'Got Job', 'Resign', NULL, '2019-04-30', '2019-05-09 06:36:35', '2019-05-09 06:36:35'),
(58, 272, 'Casual Attitude', 'Terminate', NULL, '2019-05-11', '2019-05-11 04:27:42', '2019-05-11 04:27:42'),
(59, 297, 'End of services', 'Terminate', NULL, '2019-04-30', '2019-05-13 05:04:59', '2019-05-13 05:04:59'),
(60, 449, 'Got Job', 'Resign', NULL, '2019-05-14', '2019-05-16 05:15:53', '2019-05-16 05:15:53'),
(61, 342, 'Got Job', 'Resign', NULL, '2019-05-13', '2019-05-17 04:58:16', '2019-05-17 04:58:16'),
(62, 532, 'NCNS', 'Terminate', NULL, '2019-05-11', '2019-05-23 03:47:51', '2019-05-23 03:47:51'),
(63, 524, 'Low Performance', 'Terminate', NULL, '2019-05-22', '2019-05-23 03:48:47', '2019-05-23 03:48:47'),
(64, 542, 'Low Performance', 'Terminate', NULL, '2019-05-22', '2019-05-23 03:50:26', '2019-05-23 03:50:26'),
(65, 548, 'Low Performance', 'Terminate', NULL, '2019-05-22', '2019-05-23 03:51:06', '2019-05-23 03:51:06'),
(66, 550, 'Low Performance', 'Terminate', NULL, '2019-05-22', '2019-05-23 03:51:49', '2019-05-23 03:51:49'),
(67, 431, 'Low Performance', 'Terminate', NULL, '2019-05-22', '2019-05-23 03:52:32', '2019-05-23 03:52:32'),
(68, 552, 'NCNS', 'Terminate', NULL, '2019-05-08', '2019-05-31 13:31:13', '2019-05-31 13:31:13'),
(69, 263, 'Wanna go out side', 'Resign', NULL, '2025-05-30', '2019-06-01 15:57:23', '2019-07-06 21:14:59'),
(70, 288, 'Wanna go home town', 'Resign', NULL, '2019-05-31', '2019-06-01 15:58:11', '2019-06-01 15:58:11'),
(71, 284, 'Not taking trial class', 'Terminate', NULL, '2019-05-24', '2019-06-03 13:14:08', '2019-06-03 13:14:08'),
(72, 248, 'Low performance\r\nCasual Attitude towards job\r\nUn-approved leaves in crucial days.', 'Terminate', NULL, '2019-06-10', '2019-06-11 10:09:39', '2019-06-11 10:09:39'),
(73, 238, 'Low performance', 'Terminate', NULL, '2019-06-11', '2019-06-11 19:11:25', '2019-06-11 19:11:25'),
(74, 450, 'End of Services. Don\'t have enough business/classes for her.', 'Resign', NULL, '2019-06-12', '2019-06-14 10:18:17', '2019-06-14 10:18:21'),
(75, 391, 'NCNS', 'Terminate', NULL, '2019-06-11', '2019-06-17 09:28:26', '2019-06-27 09:22:53'),
(76, 509, 'Got Job', 'Terminate', NULL, '2019-06-12', '2019-06-17 11:16:46', '2019-06-17 11:16:46'),
(77, 560, 'NCNS', 'Terminate', NULL, '2019-06-11', '2019-06-18 13:01:53', '2019-06-18 13:02:03'),
(78, 595, 'No CNIC', 'Terminate', NULL, '2019-06-17', '2019-06-19 12:44:27', '2019-06-19 12:46:10'),
(79, 309, 'End of services', 'Terminate', NULL, '2019-06-07', '2019-06-21 14:55:21', '2019-06-21 14:57:04'),
(80, 301, 'Went for internship for 3 months.', 'Resign', NULL, '2019-05-29', '2019-06-21 16:54:55', '2019-06-21 16:56:22'),
(81, 536, 'Expired in an accident', 'Resign', NULL, '2019-06-21', '2019-06-21 17:10:57', '2019-06-21 17:10:57'),
(82, 521, 'NCNS', 'Terminate', NULL, '2019-06-18', '2019-06-22 16:43:58', '2019-06-22 16:44:05'),
(83, 522, 'Wanna go outside', 'Resign', NULL, '2019-06-22', '2019-06-24 15:55:33', '2019-06-24 15:55:47'),
(84, 227, 'Wanna go out of city', 'Resign', NULL, '2019-06-15', '2019-06-25 16:03:35', '2019-06-25 16:03:35'),
(85, 446, 'End of services (Got Sick)', 'Terminate', NULL, '2019-06-21', '2019-06-25 16:04:34', '2019-06-25 16:04:34'),
(86, 385, 'Wanna do business', 'Resign', NULL, '2019-06-27', '2019-06-29 14:06:46', '2019-06-29 14:06:46'),
(87, 629, 'NCNS', 'Terminate', NULL, '2019-06-26', '2019-07-02 12:34:22', '2019-07-02 12:34:22'),
(88, 622, 'Wanna do job in IT Department', 'Resign', NULL, '2019-07-03', '2019-07-03 16:14:09', '2019-07-03 16:14:09'),
(89, 461, 'Fraudulent Conduct', 'Terminate', NULL, '2019-07-04', '2019-07-04 16:50:46', '2019-07-04 16:50:46'),
(90, 453, 'Fraudulent Conduct', 'Terminate', NULL, '2019-07-04', '2019-07-04 16:51:23', '2019-07-04 16:51:23'),
(91, 318, 'He is not punctual at all and we also don’t have enough business to provide him.', 'Terminate', NULL, '2019-07-03', '2019-07-05 13:15:16', '2019-07-05 13:15:16'),
(92, 294, 'End of services', 'Terminate', NULL, '2019-07-03', '2019-07-05 13:19:27', '2019-07-05 13:19:27'),
(93, 230, 'End of Services', 'Terminate', NULL, '2019-07-04', '2019-07-05 15:04:50', '2019-07-06 11:22:14'),
(94, 544, 'NCNS', 'Terminate', NULL, '2019-07-06', '2019-07-08 09:01:29', '2019-07-08 09:01:29'),
(95, 609, 'End of Services', 'Terminate', NULL, '2019-07-12', '2019-07-13 16:45:40', '2019-07-13 16:45:40'),
(96, 539, 'Got job in abroad.', 'Resign', NULL, '2019-07-12', '2019-07-13 17:05:35', '2019-07-13 17:05:35'),
(97, 374, 'Health Issue', 'Resign', NULL, '2019-07-08', '2019-07-15 13:29:03', '2019-07-15 13:29:03'),
(98, 423, 'Father is sick', 'Resign', NULL, '2019-07-04', '2019-07-16 17:19:00', '2019-07-16 17:19:00'),
(99, 540, 'End of services', 'Terminate', NULL, '2019-07-18', '2019-07-18 17:37:26', '2019-07-18 17:37:26'),
(100, 310, 'End of services due to less business', 'Terminate', NULL, '2019-07-22', '2019-07-23 09:40:28', '2019-07-23 09:40:28'),
(101, 642, 'End of services', 'Terminate', NULL, '2019-07-26', '2019-07-26 08:54:37', '2019-07-26 08:54:48'),
(102, 226, 'Got new job', 'Other Issue', NULL, '2019-07-06', '2019-07-29 09:55:26', '2019-07-29 09:55:26'),
(103, 594, 'Low performance', 'Terminate', NULL, '2019-07-21', '2019-07-29 10:09:07', '2019-07-29 10:09:07'),
(104, 603, 'Low performance', 'Terminate', NULL, '2019-07-21', '2019-07-29 10:12:13', '2019-07-29 10:12:13'),
(105, 620, 'NCNS', 'Terminate', NULL, '2019-07-29', '2019-07-29 10:14:10', '2019-07-29 10:14:10'),
(106, 369, 'Wanna run his own Madrissa', 'Resign', NULL, '2019-07-28', '2019-07-29 17:49:32', '2019-07-29 17:49:32'),
(107, 326, 'Wedding. will join after 1 month', 'Other Issue', NULL, '2019-07-23', '2019-07-31 12:27:33', '2019-07-31 12:27:33'),
(108, 671, 'End of services', 'Terminate', NULL, '2019-07-27', '2019-08-01 09:13:03', '2019-08-01 09:13:03'),
(109, 567, 'End of services', 'Terminate', NULL, '2019-08-01', '2019-08-01 17:50:42', '2019-08-01 17:50:42'),
(110, 363, 'Wanna go Kashmir', 'Resign', NULL, '2019-08-01', '2019-08-01 17:51:31', '2019-08-01 17:51:31'),
(111, 529, 'End of services due to low business', 'Terminate', NULL, '2019-07-31', '2019-08-01 17:57:04', '2019-08-01 17:57:04'),
(112, 320, 'Resigned', 'Resign', NULL, '2019-07-31', '2019-08-07 17:24:36', '2019-08-07 17:24:36'),
(113, 308, 'End of services. Wanna go for Scholarship to abroad.', 'Terminate', NULL, '2019-07-31', '2019-08-08 10:44:22', '2019-08-08 10:44:22'),
(114, 606, 'NCNS', 'Terminate', NULL, '2019-07-31', '2019-08-09 15:31:09', '2019-08-09 15:31:09'),
(115, 442, 'Personal Issues', 'Resign', NULL, '2019-08-14', '2019-08-15 16:16:22', '2019-08-15 16:16:22'),
(116, 693, 'NCNS', 'Terminate', NULL, '2019-08-03', '2019-08-19 17:05:16', '2019-08-19 17:05:16'),
(117, 494, 'NCNS', 'Terminate', NULL, '2019-08-15', '2019-08-19 17:06:42', '2019-08-19 17:06:42'),
(118, 246, 'Salary Issue', 'Resign', NULL, '2019-08-19', '2019-08-19 17:07:28', '2019-08-19 17:07:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_end_service_checklists`
--

CREATE TABLE `user_end_service_checklists` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_project`
--

CREATE TABLE `user_project` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_project`
--

INSERT INTO `user_project` (`id`, `project_id`, `user_id`) VALUES
(14, 1, 1),
(262, 29, 1),
(263, 29, 29),
(264, 29, 30),
(265, 29, 31),
(266, 29, 32),
(267, 29, 33),
(268, 29, 34),
(269, 29, 35),
(270, 29, 36),
(271, 29, 37),
(272, 29, 38),
(273, 29, 45),
(274, 29, 59),
(275, 29, 65),
(276, 29, 66),
(277, 29, 67),
(278, 29, 68),
(279, 29, 81),
(280, 29, 90),
(281, 29, 91),
(282, 29, 98),
(283, 29, 99),
(284, 29, 106),
(285, 29, 107),
(286, 29, 116),
(287, 29, 163),
(288, 29, 194),
(289, 29, 200),
(290, 29, 203),
(291, 29, 204),
(292, 29, 205),
(293, 29, 206),
(294, 29, 207),
(295, 29, 208),
(296, 29, 209),
(297, 29, 210),
(298, 29, 219),
(299, 29, 225),
(300, 29, 226),
(301, 29, 227),
(302, 29, 230),
(303, 29, 232),
(304, 29, 233),
(305, 29, 235),
(306, 29, 237),
(307, 29, 238),
(308, 29, 239),
(309, 29, 240),
(310, 29, 241),
(311, 29, 242),
(312, 29, 243),
(313, 29, 244),
(382, 28, 33),
(383, 28, 98),
(384, 28, 203),
(385, 28, 204),
(386, 28, 227),
(387, 28, 232),
(388, 28, 233),
(389, 28, 241),
(390, 28, 242),
(397, 26, 203),
(398, 26, 204),
(399, 26, 227),
(400, 26, 232),
(401, 26, 233),
(402, 26, 235),
(403, 26, 238),
(404, 26, 243),
(405, 25, 33),
(406, 25, 203),
(407, 25, 204),
(408, 25, 226),
(409, 25, 232),
(410, 25, 233),
(411, 25, 235),
(412, 25, 241),
(413, 25, 242),
(425, 23, 1),
(426, 23, 33),
(427, 23, 203),
(428, 23, 204),
(429, 23, 232),
(430, 23, 233),
(431, 23, 235),
(432, 22, 1),
(433, 22, 33),
(434, 22, 203),
(435, 22, 204),
(436, 22, 232),
(437, 22, 233),
(438, 22, 235),
(439, 21, 33),
(440, 21, 203),
(441, 21, 204),
(442, 21, 225),
(443, 21, 232),
(444, 21, 233),
(445, 21, 235),
(446, 20, 33),
(447, 20, 203),
(448, 20, 204),
(449, 20, 225),
(450, 20, 227),
(451, 20, 232),
(452, 20, 233),
(453, 20, 235),
(460, 18, 33),
(461, 18, 203),
(462, 18, 204),
(463, 18, 227),
(464, 18, 232),
(465, 18, 233),
(466, 18, 235),
(467, 17, 33),
(468, 17, 203),
(469, 17, 204),
(470, 17, 232),
(471, 17, 233),
(472, 17, 235),
(479, 16, 203),
(480, 16, 204),
(481, 16, 232),
(482, 16, 233),
(483, 16, 235),
(484, 15, 203),
(485, 15, 204),
(486, 15, 227),
(487, 15, 232),
(488, 15, 233),
(489, 15, 235),
(490, 14, 98),
(491, 14, 106),
(492, 14, 203),
(493, 14, 204),
(494, 14, 225),
(495, 14, 226),
(496, 14, 227),
(497, 14, 232),
(498, 14, 233),
(499, 14, 235),
(500, 13, 33),
(501, 13, 98),
(502, 13, 203),
(503, 13, 204),
(504, 13, 225),
(505, 13, 226),
(506, 13, 232),
(507, 13, 233),
(508, 13, 235),
(509, 13, 238),
(510, 12, 33),
(511, 12, 203),
(512, 12, 204),
(513, 12, 232),
(514, 12, 233),
(515, 12, 235),
(522, 11, 33),
(523, 11, 203),
(524, 11, 204),
(525, 11, 232),
(526, 11, 233),
(527, 11, 235),
(528, 10, 203),
(529, 10, 204),
(530, 10, 232),
(531, 10, 233),
(532, 10, 235),
(533, 19, 33),
(534, 19, 203),
(535, 19, 204),
(536, 19, 227),
(537, 19, 232),
(538, 19, 233),
(539, 19, 235),
(540, 27, 107),
(541, 27, 203),
(542, 27, 204),
(543, 27, 232),
(544, 27, 233),
(545, 27, 235),
(546, 27, 239),
(547, 30, 1),
(548, 30, 30),
(549, 30, 225),
(550, 30, 227),
(551, 30, 238),
(552, 30, 240),
(553, 30, 241),
(554, 30, 242),
(555, 31, 1),
(556, 31, 30),
(557, 31, 225),
(558, 31, 227),
(559, 31, 238),
(560, 31, 240),
(561, 31, 241),
(562, 31, 242),
(563, 24, 1),
(564, 24, 106),
(565, 24, 107),
(566, 24, 225),
(567, 24, 227),
(568, 24, 238),
(569, 24, 241),
(570, 24, 242),
(571, 32, 1),
(572, 32, 106),
(573, 32, 107),
(574, 32, 225),
(575, 32, 227),
(576, 32, 238),
(577, 32, 241),
(578, 32, 242),
(579, 1, 29),
(580, 1, 36),
(581, 2, 666),
(582, 4, 1),
(583, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `yccleads`
--

CREATE TABLE `yccleads` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campaign` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `yccleads`
--

INSERT INTO `yccleads` (`id`, `name`, `email`, `contactno`, `country`, `subject`, `message`, `refcode`, `campaign`, `source`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Susan Oommen', 'oommensusannah@gmail.com', '+61469390080', 'Australia', 'Science', 'Hi Nasir Rafiq,\r\nThanks for your call. We are interested in setting up a trial class for my daughter who is currently in Year 6 .', '', 'NA', 'Web Form', 0, '2019-10-16 05:11:17', '2019-10-16 05:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `yccleadstatuses`
--

CREATE TABLE `yccleadstatuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `ycclead_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yccrefs`
--

CREATE TABLE `yccrefs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactno` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shift` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `modified_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `yccrefstatuses`
--

CREATE TABLE `yccrefstatuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `yccref_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ycc_supports`
--

CREATE TABLE `ycc_supports` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assignedto` int(11) DEFAULT NULL,
  `assignedby` int(11) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `createdby` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `supportfrom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'manual'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ycc_supports`
--

INSERT INTO `ycc_supports` (`id`, `email`, `from`, `subject`, `body`, `assignedto`, `assignedby`, `status`, `is_deleted`, `createdby`, `created_at`, `updated_at`, `supportfrom`) VALUES
(1, 'shahid.umar@gmail.com', 'Shahid', 'XYZ', 'Testing description. Testing description. Testing description. Testing description. Testing description. Testing description. Testing description. Testing description. Testing description. Testing description. Testing description. Testing description. Testing description. Testing description. Testing description.', 1, 1, 'closed_request', 0, 1, '2019-07-19 17:36:27', '2019-07-19 17:39:51', 'manual'),
(2, 'rafia@yourcloudcampus.com', 'Rafia', 'feedback', 'feedback is require feedback is require feedback is require feedback is require feedback is require feedback is require feedback is require feedback is require', NULL, NULL, 'new', 0, 352, '2019-07-19 18:02:48', '2019-07-19 18:02:48', 'manual'),
(3, 'yasir@yourcloudcampus.com', 'Yasir', 'feedback', 'all ok. testing ticket', 242, 352, 'progress', 0, 685, '2019-07-19 18:03:06', '2019-07-20 09:52:56', 'manual');

-- --------------------------------------------------------

--
-- Table structure for table `ycc_support_attachments`
--

CREATE TABLE `ycc_support_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `ycc_supports_id` int(11) NOT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ycc_support_feedbacks`
--

CREATE TABLE `ycc_support_feedbacks` (
  `id` int(10) UNSIGNED NOT NULL,
  `support_id` int(11) NOT NULL,
  `feedback` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rating` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ycc_support_messages`
--

CREATE TABLE `ycc_support_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `yccsupport_id` int(11) NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unassigned',
  `external` int(11) NOT NULL,
  `assinged_to` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ycc_support_messages`
--

INSERT INTO `ycc_support_messages` (`id`, `yccsupport_id`, `message`, `user_id`, `status`, `external`, `assinged_to`, `created_at`, `updated_at`) VALUES
(1, 1, 'Kindly take care of it.', 1, 'assigned', 0, 1, '2019-07-19 17:38:39', '2019-07-19 17:38:39'),
(2, 1, 'When this ticket will be resolved. When this ticket will be resolved. When this ticket will be resolved. When this ticket will be resolved. When this ticket will be resolved. When this ticket will be resolved. When this ticket will be resolved. When this ticket will be resolved. When this ticket will be resolved. When this ticket will be resolved. When this ticket will be resolved. When this ticket will be resolved. When this ticket will be resolved. When this ticket will be resolved.', 1, 'progress', 0, NULL, '2019-07-19 17:39:19', '2019-07-19 17:39:19'),
(3, 1, 'This is not resolved. This is not resolved. This is not resolved. This is not resolved. This is not resolved. This is not resolved. This is not resolved. This is not resolved. This is not resolved. This is not resolved. This is not resolved. This is not resolved. This is not resolved. This is not resolved.', 1, 'closed_request', 1, NULL, '2019-07-19 17:39:51', '2019-07-19 17:39:51'),
(4, 3, 'classes are good and am satisfied from teacher', 352, 'progress', 0, NULL, '2019-07-19 18:04:29', '2019-07-19 18:04:29'),
(5, 3, 'hhh', 352, 'assigned', 0, 242, '2019-07-20 09:52:41', '2019-07-20 09:52:41'),
(6, 3, 'hhh', 352, 'progress', 1, NULL, '2019-07-20 09:52:56', '2019-07-20 09:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `ycc_support_message_attachments`
--

CREATE TABLE `ycc_support_message_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `orginalfilename` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ycc_support_message_attachments`
--

INSERT INTO `ycc_support_message_attachments` (`id`, `message_id`, `user_id`, `attachment`, `orginalfilename`, `created_at`, `updated_at`) VALUES
(1, 2, 0, '15635399591558153468qr-code.png', '1558153468qr-code.png', '2019-07-19 17:39:19', '2019-07-19 17:39:19'),
(2, 3, 0, '15635399911558154232send.jpg', '1558154232send.jpg', '2019-07-19 17:39:51', '2019-07-19 17:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `ycc_support_statuses`
--

CREATE TABLE `ycc_support_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `yccsupport_id` int(11) NOT NULL,
  `assignedto` int(11) NOT NULL,
  `assignedby` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ycc_support_statuses`
--

INSERT INTO `ycc_support_statuses` (`id`, `yccsupport_id`, `assignedto`, `assignedby`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Kindly take care of it.', '2019-07-19 17:38:37', '2019-07-19 17:38:37'),
(2, 3, 242, 352, 'hhh', '2019-07-20 09:52:39', '2019-07-20 09:52:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `addressbooks`
--
ALTER TABLE `addressbooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addressbooks_user_id_foreign` (`user_id`),
  ADD KEY `addressbooks_created_by_foreign` (`created_by`);

--
-- Indexes for table `adjustments`
--
ALTER TABLE `adjustments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adjustments_user_id_foreign` (`user_id`),
  ADD KEY `adjustments_created_by_foreign` (`created_by`),
  ADD KEY `adjustments_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `adminmenus`
--
ALTER TABLE `adminmenus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `adminmenus_slug_unique` (`slug`),
  ADD KEY `adminmenus_parentid_foreign` (`parentid`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_lead_id_foreign` (`lead_id`),
  ADD KEY `appointments_created_by_foreign` (`created_by`);

--
-- Indexes for table `appointment_user`
--
ALTER TABLE `appointment_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendancelogs`
--
ALTER TABLE `attendancelogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendancelogs_user_id_foreign` (`user_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_user_id_foreign` (`user_id`);

--
-- Indexes for table `attendancesheetapprovals`
--
ALTER TABLE `attendancesheetapprovals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendancesheetapprovals_user_id_foreign` (`user_id`);

--
-- Indexes for table `attendancesheets`
--
ALTER TABLE `attendancesheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendancesheets_user_id_foreign` (`user_id`);

--
-- Indexes for table `authentication_log`
--
ALTER TABLE `authentication_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authentication_log_authenticatable_type_authenticatable_id_index` (`authenticatable_type`,`authenticatable_id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budgetcategories`
--
ALTER TABLE `budgetcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chapters_created_by_foreign` (`created_by`);

--
-- Indexes for table `chart_of_account`
--
ALTER TABLE `chart_of_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_room_feeds`
--
ALTER TABLE `chat_room_feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_room_participants`
--
ALTER TABLE `chat_room_participants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaintcomments`
--
ALTER TABLE `complaintcomments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consume_budget`
--
ALTER TABLE `consume_budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversations_lead_id_foreign` (`lead_id`),
  ADD KEY `conversations_appointment_id_foreign` (`appointment_id`),
  ADD KEY `conversations_created_by_foreign` (`created_by`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cusume_budget_detail`
--
ALTER TABLE `cusume_budget_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_user_id_foreign` (`user_id`),
  ADD KEY `departments_last_modified_by_foreign` (`last_modified_by`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designations_user_id_foreign` (`user_id`),
  ADD KEY `designations_last_modified_by_foreign` (`last_modified_by`);

--
-- Indexes for table `dialedcalls`
--
ALTER TABLE `dialedcalls`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dialedcalls_email_unique` (`email`),
  ADD UNIQUE KEY `dialedcalls_phone_unique` (`phone`),
  ADD KEY `dialedcalls_dialed_by_foreign` (`dialed_by`),
  ADD KEY `dialedcalls_created_by_foreign` (`created_by`);

--
-- Indexes for table `duas`
--
ALTER TABLE `duas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `end_services`
--
ALTER TABLE `end_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `floors`
--
ALTER TABLE `floors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `holidays_dated_unique` (`dated`),
  ADD KEY `holidays_created_by_foreign` (`created_by`),
  ADD KEY `holidays_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `hrleadinfos`
--
ALTER TABLE `hrleadinfos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hrleadinfos_hrlead_id_foreign` (`hrlead_id`),
  ADD KEY `hrleadinfos_user_id_foreign` (`user_id`);

--
-- Indexes for table `hrleads`
--
ALTER TABLE `hrleads`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `hrleads_user_id_foreign` (`user_id`),
  ADD KEY `hrleads_last_modified_by_foreign` (`last_modified_by`),
  ADD KEY `hrleads_department_id_foreign` (`department_id`);

--
-- Indexes for table `hrleadstatuses`
--
ALTER TABLE `hrleadstatuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hrleadstatuses_hrlead_id_foreign` (`hrlead_id`),
  ADD KEY `hrleadstatuses_user_id_foreign` (`user_id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_category`
--
ALTER TABLE `inventory_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_item_sno`
--
ALTER TABLE `inventory_item_sno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_quantity`
--
ALTER TABLE `inventory_quantity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_specification`
--
ALTER TABLE `inventory_specification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoicedetails_parent_id_foreign` (`parent_id`),
  ADD KEY `invoicedetails_teacherid_foreign` (`teacherID`),
  ADD KEY `invoicedetails_studentid_foreign` (`studentID`),
  ADD KEY `invoicedetails_leadid_foreign` (`LeadId`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_parent_id_foreign` (`parent_id`),
  ADD KEY `invoices_last_resend_by_foreign` (`last_resend_by`),
  ADD KEY `invoices_created_by_foreign` (`created_by`),
  ADD KEY `invoices_agentid_foreign` (`agentId`),
  ADD KEY `invoices_agent_comm_foreign` (`agent_comm`),
  ADD KEY `invoices_teacher_comm_foreign` (`teacher_comm`);

--
-- Indexes for table `it_stations`
--
ALTER TABLE `it_stations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_station_dept`
--
ALTER TABLE `it_station_dept`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_station_items`
--
ALTER TABLE `it_station_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `it_used_dept_items`
--
ALTER TABLE `it_used_dept_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal_voucher`
--
ALTER TABLE `journal_voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `journal_voucher_detail`
--
ALTER TABLE `journal_voucher_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leads_user_id_foreign` (`user_id`),
  ADD KEY `leads_created_by_foreign` (`created_by`),
  ADD KEY `approvedby` (`approvedby`),
  ADD KEY `assignedto` (`assignedto`);

--
-- Indexes for table `leadstatuses`
--
ALTER TABLE `leadstatuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leadstatuses_lead_id_foreign` (`lead_id`),
  ADD KEY `leadstatuses_user_id_foreign` (`user_id`);

--
-- Indexes for table `lead_assets`
--
ALTER TABLE `lead_assets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_assets_lead_id_foreign` (`lead_id`),
  ADD KEY `lead_assets_created_by_foreign` (`created_by`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leaves_user_id_foreign` (`user_id`),
  ADD KEY `leaves_created_by_foreign` (`created_by`),
  ADD KEY `leaves_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `parentdetails`
--
ALTER TABLE `parentdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parentdetails_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payablecommitteds`
--
ALTER TABLE `payablecommitteds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypalwithdrawals`
--
ALTER TABLE `paypalwithdrawals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prayers`
--
ALTER TABLE `prayers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `preferences_option_unique` (`option`),
  ADD KEY `preferences_created_by_foreign` (`created_by`),
  ADD KEY `preferences_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `projectassets`
--
ALTER TABLE `projectassets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projectassets_project_id_foreign` (`project_id`),
  ADD KEY `projectassets_user_id_foreign` (`user_id`);

--
-- Indexes for table `projectlinks`
--
ALTER TABLE `projectlinks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projectlinks_project_id_foreign` (`project_id`),
  ADD KEY `projectlinks_created_by_foreign` (`created_by`);

--
-- Indexes for table `projectmessageassets`
--
ALTER TABLE `projectmessageassets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projectmessageassets_message_id_foreign` (`message_id`),
  ADD KEY `projectmessageassets_user_id_foreign` (`user_id`);

--
-- Indexes for table `projectmessages`
--
ALTER TABLE `projectmessages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projectmessages_project_id_foreign` (`project_id`),
  ADD KEY `projectmessages_user_id_foreign` (`user_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_lead_id_foreign` (`lead_id`),
  ADD KEY `projects_user_id_foreign` (`user_id`),
  ADD KEY `projects_created_by_foreign` (`created_by`),
  ADD KEY `projects_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `project_tasks`
--
ALTER TABLE `project_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_tasks_project_id_foreign` (`project_id`),
  ADD KEY `project_tasks_user_id_foreign` (`user_id`),
  ADD KEY `project_tasks_created_by_foreign` (`created_by`),
  ADD KEY `project_tasks_reopen_by_foreign` (`reopen_by`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposals_lead_id_foreign` (`lead_id`),
  ADD KEY `proposals_created_by_foreign` (`created_by`);

--
-- Indexes for table `qualily_assurance_attachments`
--
ALTER TABLE `qualily_assurance_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quality_assurances`
--
ALTER TABLE `quality_assurances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recordings`
--
ALTER TABLE `recordings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recordings_lead_id_foreign` (`lead_id`),
  ADD KEY `recordings_created_by_foreign` (`created_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_user_id_foreign` (`user_id`),
  ADD KEY `roles_last_modified_by_foreign` (`last_modified_by`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salarypartialpays`
--
ALTER TABLE `salarypartialpays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salarypartialpays_salarysheet_id_foreign` (`salarysheet_id`),
  ADD KEY `salarypartialpays_user_id_foreign` (`user_id`),
  ADD KEY `salarypartialpays_created_by_foreign` (`created_by`),
  ADD KEY `salarypartialpays_modified_by_foreign` (`modified_by`),
  ADD KEY `salarypartialpays_bank_id_foreign` (`bank_id`);

--
-- Indexes for table `salarysheets`
--
ALTER TABLE `salarysheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salarysheets_user_id_foreign` (`user_id`),
  ADD KEY `salarysheets_created_by_foreign` (`created_by`),
  ADD KEY `salarysheets_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `salarystatuses`
--
ALTER TABLE `salarystatuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salarystatuses_salarysheet_id_foreign` (`salarysheet_id`),
  ADD KEY `salarystatuses_user_id_foreign` (`user_id`),
  ADD KEY `salarystatuses_created_by_foreign` (`created_by`),
  ADD KEY `salarystatuses_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_teacherid_foreign` (`teacherID`),
  ADD KEY `schedules_studentid_foreign` (`studentID`),
  ADD KEY `schedules_courseid_foreign` (`courseID`),
  ADD KEY `schedules_agentid_foreign` (`agentId`),
  ADD KEY `schedules_trial_confirm_by_foreign` (`trial_confirm_by`),
  ADD KEY `schedules_dead_by_foreign` (`dead_by`),
  ADD KEY `schedules_confirm_dead_by_foreign` (`confirm_dead_by`),
  ADD KEY `schedules_freeze_by_foreign` (`freeze_by`),
  ADD KEY `schedules_created_by_foreign` (`created_by`),
  ADD KEY `schedules_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `staffdetails`
--
ALTER TABLE `staffdetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staffdetails_phonenumber_unique` (`phonenumber`),
  ADD UNIQUE KEY `staffdetails_cnic_unique` (`cnic`),
  ADD UNIQUE KEY `staffdetails_passportno_unique` (`passportno`),
  ADD KEY `staffdetails_user_id_foreign` (`user_id`),
  ADD KEY `staffdetails_hrlead_id_foreign` (`hrlead_id`);

--
-- Indexes for table `staff_requireds`
--
ALTER TABLE `staff_requireds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_required_statuses`
--
ALTER TABLE `staff_required_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentdetails`
--
ALTER TABLE `studentdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studentdetails_user_id_foreign` (`user_id`);

--
-- Indexes for table `student_attendances`
--
ALTER TABLE `student_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_attendances_studentid_foreign` (`studentID`),
  ADD KEY `student_attendances_teacherid_foreign` (`teacherID`),
  ADD KEY `student_attendances_courseid_foreign` (`courseID`),
  ADD KEY `student_attendances_schedule_id_foreign` (`schedule_id`);

--
-- Indexes for table `surahs`
--
ALTER TABLE `surahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `syllabuslessons`
--
ALTER TABLE `syllabuslessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_timings`
--
ALTER TABLE `teacher_timings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topics_chapterid_foreign` (`chapterId`),
  ADD KEY `topics_created_by_foreign` (`created_by`);

--
-- Indexes for table `un_read_messages`
--
ALTER TABLE `un_read_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_createdby_foreign` (`createdby`),
  ADD KEY `users_updatedby_foreign` (`updatedby`),
  ADD KEY `users_department_id_foreign` (`department_id`),
  ADD KEY `users_designation_id_foreign` (`designation_id`);

--
-- Indexes for table `user_checklists`
--
ALTER TABLE `user_checklists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_documents`
--
ALTER TABLE `user_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_end_services`
--
ALTER TABLE `user_end_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_end_service_checklists`
--
ALTER TABLE `user_end_service_checklists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_project`
--
ALTER TABLE `user_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yccleads`
--
ALTER TABLE `yccleads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `yccleadstatuses`
--
ALTER TABLE `yccleadstatuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yccleadstatuses_ycclead_id_foreign` (`ycclead_id`),
  ADD KEY `yccleadstatuses_user_id_foreign` (`user_id`);

--
-- Indexes for table `yccrefs`
--
ALTER TABLE `yccrefs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yccrefs_user_id_foreign` (`user_id`),
  ADD KEY `yccrefs_created_by_foreign` (`created_by`),
  ADD KEY `yccrefs_modified_by_foreign` (`modified_by`);

--
-- Indexes for table `yccrefstatuses`
--
ALTER TABLE `yccrefstatuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `yccrefstatuses_yccref_id_foreign` (`yccref_id`),
  ADD KEY `yccrefstatuses_user_id_foreign` (`user_id`);

--
-- Indexes for table `ycc_supports`
--
ALTER TABLE `ycc_supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ycc_support_attachments`
--
ALTER TABLE `ycc_support_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ycc_support_feedbacks`
--
ALTER TABLE `ycc_support_feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ycc_support_messages`
--
ALTER TABLE `ycc_support_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ycc_support_message_attachments`
--
ALTER TABLE `ycc_support_message_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ycc_support_statuses`
--
ALTER TABLE `ycc_support_statuses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271764;

--
-- AUTO_INCREMENT for table `addressbooks`
--
ALTER TABLE `addressbooks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adjustments`
--
ALTER TABLE `adjustments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adminmenus`
--
ALTER TABLE `adminmenus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `appointment_user`
--
ALTER TABLE `appointment_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `attendancelogs`
--
ALTER TABLE `attendancelogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendancesheetapprovals`
--
ALTER TABLE `attendancesheetapprovals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendancesheets`
--
ALTER TABLE `attendancesheets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `authentication_log`
--
ALTER TABLE `authentication_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3706;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `budgetcategories`
--
ALTER TABLE `budgetcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chart_of_account`
--
ALTER TABLE `chart_of_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT for table `chat_rooms`
--
ALTER TABLE `chat_rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_room_feeds`
--
ALTER TABLE `chat_room_feeds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_room_participants`
--
ALTER TABLE `chat_room_participants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaintcomments`
--
ALTER TABLE `complaintcomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `consume_budget`
--
ALTER TABLE `consume_budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cusume_budget_detail`
--
ALTER TABLE `cusume_budget_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `dialedcalls`
--
ALTER TABLE `dialedcalls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `duas`
--
ALTER TABLE `duas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `end_services`
--
ALTER TABLE `end_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floors`
--
ALTER TABLE `floors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hrleadinfos`
--
ALTER TABLE `hrleadinfos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hrleads`
--
ALTER TABLE `hrleads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hrleadstatuses`
--
ALTER TABLE `hrleadstatuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inventory_category`
--
ALTER TABLE `inventory_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventory_item_sno`
--
ALTER TABLE `inventory_item_sno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `inventory_quantity`
--
ALTER TABLE `inventory_quantity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `inventory_specification`
--
ALTER TABLE `inventory_specification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `invoicedetails`
--
ALTER TABLE `invoicedetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `it_stations`
--
ALTER TABLE `it_stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `it_station_dept`
--
ALTER TABLE `it_station_dept`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `it_station_items`
--
ALTER TABLE `it_station_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `it_used_dept_items`
--
ALTER TABLE `it_used_dept_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_voucher`
--
ALTER TABLE `journal_voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journal_voucher_detail`
--
ALTER TABLE `journal_voucher_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leadstatuses`
--
ALTER TABLE `leadstatuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_assets`
--
ALTER TABLE `lead_assets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parentdetails`
--
ALTER TABLE `parentdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `payablecommitteds`
--
ALTER TABLE `payablecommitteds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paypalwithdrawals`
--
ALTER TABLE `paypalwithdrawals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prayers`
--
ALTER TABLE `prayers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `projectassets`
--
ALTER TABLE `projectassets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projectlinks`
--
ALTER TABLE `projectlinks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projectmessageassets`
--
ALTER TABLE `projectmessageassets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projectmessages`
--
ALTER TABLE `projectmessages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_tasks`
--
ALTER TABLE `project_tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `qualily_assurance_attachments`
--
ALTER TABLE `qualily_assurance_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quality_assurances`
--
ALTER TABLE `quality_assurances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recordings`
--
ALTER TABLE `recordings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salarypartialpays`
--
ALTER TABLE `salarypartialpays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salarysheets`
--
ALTER TABLE `salarysheets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `salarystatuses`
--
ALTER TABLE `salarystatuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `staffdetails`
--
ALTER TABLE `staffdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff_requireds`
--
ALTER TABLE `staff_requireds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `staff_required_statuses`
--
ALTER TABLE `staff_required_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `studentdetails`
--
ALTER TABLE `studentdetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `student_attendances`
--
ALTER TABLE `student_attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `surahs`
--
ALTER TABLE `surahs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `syllabuslessons`
--
ALTER TABLE `syllabuslessons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `teacher_timings`
--
ALTER TABLE `teacher_timings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `un_read_messages`
--
ALTER TABLE `un_read_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=815;

--
-- AUTO_INCREMENT for table `user_checklists`
--
ALTER TABLE `user_checklists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `user_documents`
--
ALTER TABLE `user_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_end_services`
--
ALTER TABLE `user_end_services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `user_end_service_checklists`
--
ALTER TABLE `user_end_service_checklists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_project`
--
ALTER TABLE `user_project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=584;

--
-- AUTO_INCREMENT for table `yccleads`
--
ALTER TABLE `yccleads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `yccleadstatuses`
--
ALTER TABLE `yccleadstatuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yccrefs`
--
ALTER TABLE `yccrefs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `yccrefstatuses`
--
ALTER TABLE `yccrefstatuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ycc_supports`
--
ALTER TABLE `ycc_supports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ycc_support_attachments`
--
ALTER TABLE `ycc_support_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ycc_support_feedbacks`
--
ALTER TABLE `ycc_support_feedbacks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ycc_support_messages`
--
ALTER TABLE `ycc_support_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ycc_support_message_attachments`
--
ALTER TABLE `ycc_support_message_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ycc_support_statuses`
--
ALTER TABLE `ycc_support_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addressbooks`
--
ALTER TABLE `addressbooks`
  ADD CONSTRAINT `addressbooks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `addressbooks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `adjustments`
--
ALTER TABLE `adjustments`
  ADD CONSTRAINT `adjustments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `adjustments_modified_by_foreign` FOREIGN KEY (`modified_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `adjustments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `adminmenus`
--
ALTER TABLE `adminmenus`
  ADD CONSTRAINT `adminmenus_parentid_foreign` FOREIGN KEY (`parentid`) REFERENCES `adminmenus` (`id`);

--
-- Constraints for table `attendancelogs`
--
ALTER TABLE `attendancelogs`
  ADD CONSTRAINT `attendancelogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
