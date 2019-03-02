-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2019 at 07:38 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cias`
--

-- --------------------------------------------------------

--
-- Table structure for table `ass_reserve_equip_need`
--

CREATE TABLE `ass_reserve_equip_need` (
  `formNo` int(11) NOT NULL,
  `equipId` int(11) NOT NULL,
  `tableNo` int(11) DEFAULT NULL,
  `chairNo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ass_reserve_equip_need`
--

INSERT INTO `ass_reserve_equip_need` (`formNo`, `equipId`, `tableNo`, `chairNo`) VALUES
(0, 100, 100, 100),
(0, 2019, 100, 100),
(0, 2019, 100, 100),
(0, 0, 100, 100),
(0, 0, 100, 100),
(0, 0, 100, 100),
(0, 3164975, 100, 100),
(0, 1, 100, 100),
(0, 1, 100, 100),
(3, 100, 100, 100),
(3, 2019, 100, 100),
(3, 2019, 100, 100),
(3, 0, 100, 100),
(3, 0, 100, 100),
(3, 0, 100, 100),
(3, 3164975, 100, 100),
(3, 1, 100, 100),
(3, 1, 100, 100),
(4, 100, 100, 100),
(4, 2019, 100, 100),
(4, 2019, 100, 100),
(4, 0, 100, 100),
(4, 0, 100, 100),
(4, 0, 100, 100),
(4, 3164975, 100, 100),
(4, 1, 100, 100),
(4, 1, 100, 100),
(5, 0, 100, 100),
(5, 0, 100, 100),
(6, 0, 100, 100),
(6, 0, 100, 100),
(7, 0, 100, 100),
(7, 0, 100, 100),
(8, 0, 100, 100),
(8, 0, 100, 100),
(9, 0, 100, 100),
(9, 0, 100, 100),
(10, 0, 100, 100),
(10, 0, 100, 100),
(24, 0, 100, 100),
(24, 0, 100, 100),
(25, 0, 100, 100),
(25, 0, 100, 100),
(37, 0, 100, 100),
(37, 0, 100, 100),
(38, 0, 100, 100),
(38, 0, 100, 100),
(39, 0, 100, 100),
(39, 0, 100, 100),
(40, 0, 100, 100),
(40, 0, 100, 100),
(41, 0, 100, 100),
(41, 0, 100, 100),
(42, 0, 100, 100),
(42, 0, 100, 100),
(43, 0, 100, 100),
(43, 0, 100, 100),
(44, 0, 100, 100),
(44, 0, 100, 100),
(45, 0, 100, 100),
(45, 0, 100, 100),
(46, 0, 100, 100),
(46, 0, 100, 100),
(47, 1, 100, 100),
(48, 1, 100, 100),
(48, 2, 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `departId` int(11) NOT NULL,
  `acroname` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`departId`, `acroname`, `name`) VALUES
(1, 'CITC', 'Citc ni'),
(2, 'CEA', 'Collage of Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_equipment`
--

CREATE TABLE `tbl_equipment` (
  `equipId` int(11) NOT NULL,
  `equipName` varchar(64) NOT NULL,
  `brand` varchar(32) NOT NULL,
  `model` varchar(32) NOT NULL,
  `serialNo` varchar(32) NOT NULL,
  `office` varchar(32) NOT NULL,
  `department` varchar(32) NOT NULL,
  `type` varchar(32) NOT NULL,
  `yearAcc` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_equipment`
--

INSERT INTO `tbl_equipment` (`equipId`, `equipName`, `brand`, `model`, `serialNo`, `office`, `department`, `type`, `yearAcc`) VALUES
(1, 'AIR CONDITION', 'SUMSUNG', 'COMPACT', '1234', 'CEA', 'CEA', 'Electrical', '2012'),
(2, 'FAN', 'LG', 'wan', '12442', 'CITC', 'CITC', 'MECHANICAL', '2013'),
(3, 'Air Con Ni', 'Ulcer', '#model', '123', 'CITC', 'ADADA', 'Electrical', ''),
(4, 'Air Con Ni', 'Ulcer', '#model', '123', 'CITC', 'ADADA', 'Electrical', '2015'),
(5, 'Water', 'Ulcer', '#model', '123', 'CITC', 'CITC', 'Electrical', '2015');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_equipment_history`
--

CREATE TABLE `tbl_equipment_history` (
  `equipId` int(11) NOT NULL,
  `dateReq` date NOT NULL,
  `description` varchar(50) NOT NULL,
  `partRep` varchar(50) NOT NULL,
  `dateRep` date NOT NULL,
  `timeRep` time NOT NULL,
  `dateFin` int(11) NOT NULL,
  `remark` varchar(50) NOT NULL,
  `performedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_equip`
--

CREATE TABLE `tbl_event_equip` (
  `equipId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_event_equip`
--

INSERT INTO `tbl_event_equip` (`equipId`, `name`, `type`) VALUES
(1, 'Speaker', 'SoundBox'),
(2, 'Mic', 'Electrical'),
(3, 'Mic', 'Electrical'),
(4, 'MIC', 'Electrical');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_request`
--

CREATE TABLE `tbl_job_request` (
  `jobId` int(11) NOT NULL,
  `itemNo` int(11) NOT NULL,
  `workDescript` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `dateTimeStart` datetime DEFAULT NULL,
  `dateTimeEnd` datetime DEFAULT NULL,
  `remark` varchar(50) NOT NULL,
  `personAtend` int(11) DEFAULT NULL,
  `resBy` int(11) NOT NULL,
  `AppBy` int(11) DEFAULT NULL,
  `dateReq` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_job_request`
--

INSERT INTO `tbl_job_request` (`jobId`, `itemNo`, `workDescript`, `location`, `dateTimeStart`, `dateTimeEnd`, `remark`, `personAtend`, `resBy`, `AppBy`, `dateReq`) VALUES
(1, 4, 'guba ang plaka', 'Bldg 23', NULL, NULL, 'approve', 3, 1, NULL, '2019-02-11 16:38:19'),
(5, 21, 'sa', 'dadawd', '2019-02-22 00:00:00', '2019-02-14 00:00:00', 'pending', 9, 1, NULL, '2019-02-13 18:32:50'),
(6, 21, 'sa', 'dadawd', '2019-02-02 00:00:00', '2019-02-08 00:00:00', 'pending', NULL, 1, NULL, '2019-02-13 18:32:54'),
(7, 21, 'sa', 'dadawd', NULL, NULL, 'pending', NULL, 1, NULL, '2019-02-13 18:34:09'),
(8, 21, 'sa', 'dadawd', NULL, NULL, 'pending', NULL, 1, NULL, '2019-02-13 18:34:12'),
(9, 21, 'sa', 'dadawd', NULL, NULL, 'pending', NULL, 1, NULL, '2019-02-13 20:53:57'),
(10, 21, 'sa', 'dadawd', '2019-02-04 00:00:00', NULL, 'approve', 9, 1, NULL, '2019-02-13 21:10:11'),
(11, 4, '212', 'Bldg 23', '2019-02-19 00:00:00', NULL, 'approve', 9, 1, NULL, '2019-02-13 21:11:01'),
(12, 4, '212', 'Bldg 23', NULL, NULL, 'approve', 3, 1, NULL, '2019-02-13 21:12:11'),
(13, 21, 'sa', 'BLDG 21', '2019-02-19 00:00:00', NULL, 'approve', 9, 1, NULL, '2019-02-16 21:27:40'),
(14, 21, 'sa', 'BLDG 21', '2019-02-04 00:00:00', NULL, 'approve', 9, 1, NULL, '2019-02-16 21:27:46'),
(15, 4, 'work2x', 'Bldg 143', '2019-02-22 00:00:00', NULL, 'approve', 9, 11, NULL, '2019-02-17 06:50:16'),
(16, 143, 'sumbagay', 'Bldg 143', '2019-02-06 00:00:00', NULL, 'approve', 9, 11, NULL, '2019-02-17 06:51:36'),
(18, 21, 'sa', 'dadawd', NULL, NULL, 'secret', NULL, 1, NULL, '2019-02-21 16:33:57'),
(21, 143, 'guba', 'Bldg 23', NULL, NULL, 'pending', NULL, 1, NULL, '2019-02-25 16:58:38');

--
-- Triggers `tbl_job_request`
--
DELIMITER $$
CREATE TRIGGER `job_req_notify` AFTER INSERT ON `tbl_job_request` FOR EACH ROW INSERT INTO tbl_notification VALUES (new.jobId,new.location,"maintenance",0,1,0,new.resBy,CURRENT_TIMESTAMP)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_last_login`
--

CREATE TABLE `tbl_last_login` (
  `id` bigint(20) NOT NULL,
  `userId` bigint(20) NOT NULL,
  `sessionData` varchar(2048) NOT NULL,
  `machineIp` varchar(1024) NOT NULL,
  `userAgent` varchar(128) NOT NULL,
  `agentString` varchar(1024) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_last_login`
--

INSERT INTO `tbl_last_login` (`id`, `userId`, `sessionData`, `machineIp`, `userAgent`, `agentString`, `platform`, `createdDtm`) VALUES
(1, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 00:33:33'),
(2, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 01:48:52'),
(3, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 01:49:52'),
(4, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 01:51:27'),
(5, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 01:53:46'),
(6, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 01:54:13'),
(7, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 01:55:40'),
(8, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 01:56:38'),
(9, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 02:00:35'),
(10, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 02:01:00'),
(11, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 02:02:43'),
(12, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 02:04:05'),
(13, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 02:16:38'),
(14, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 02:17:48'),
(15, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 02:37:07'),
(16, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 02:38:32'),
(17, 2, '{\"role\":\"2\",\"roleText\":\"Manager\",\"name\":\"Manager\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 03:31:57'),
(18, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-09 03:52:03'),
(19, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-10 00:45:43'),
(20, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-10 01:39:17'),
(21, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-10 01:45:01'),
(22, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-10 06:08:48'),
(23, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-10 11:22:29'),
(24, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-11 01:32:27'),
(25, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-11 23:49:26'),
(26, 3, '{\"role\":\"3\",\"roleText\":\"Employee\",\"name\":\"Employee\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-12 00:03:50'),
(27, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-12 00:05:05'),
(28, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-12 01:25:04'),
(29, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-12 01:37:52'),
(30, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-12 03:14:50'),
(31, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-12 03:20:06'),
(32, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-12 03:24:02'),
(33, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-12 03:30:09'),
(34, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-12 03:32:37'),
(35, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-12 03:54:29'),
(36, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-12 07:30:42'),
(37, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-12 13:37:15'),
(38, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-13 07:50:19'),
(39, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 71.0.3578.98', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 'Windows 10', '2019-02-13 22:22:47'),
(40, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36', 'Windows 10', '2019-02-14 04:36:40'),
(41, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36', 'Windows 10', '2019-02-14 05:30:04'),
(42, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36', 'Windows 10', '2019-02-14 06:02:04'),
(43, 3, '{\"role\":\"3\",\"roleText\":\"Faculty\",\"name\":\"Employee\"}', '::1', 'Chrome 72.0.3626.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36', 'Windows 10', '2019-02-14 06:20:51'),
(44, 2, '{\"role\":\"2\",\"roleText\":\"Faculty\",\"name\":\"Manager\"}', '::1', 'Chrome 72.0.3626.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36', 'Windows 10', '2019-02-14 06:23:23'),
(45, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36', 'Windows 10', '2019-02-14 06:38:41'),
(46, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36', 'Windows 10', '2019-02-14 06:41:41'),
(47, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36', 'Windows 10', '2019-02-14 10:08:31'),
(48, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.96', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.96 Safari/537.36', 'Windows 10', '2019-02-14 14:47:05'),
(49, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Firefox 64.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:64.0) Gecko/20100101 Firefox/64.0', 'Windows 10', '2019-02-14 16:51:59'),
(50, 9, '{\"role\":\"3\",\"roleText\":\"Maintenance Staff\",\"name\":\"Joshua Brian Perater\"}', '::1', 'Firefox 64.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:64.0) Gecko/20100101 Firefox/64.0', 'Windows 10', '2019-02-14 17:19:47'),
(51, 3, '{\"role\":\"3\",\"roleText\":\"Maintenance Staff\",\"name\":\"Employee\"}', '::1', 'Firefox 64.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:64.0) Gecko/20100101 Firefox/64.0', 'Windows 10', '2019-02-14 17:24:45'),
(52, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Firefox 64.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:64.0) Gecko/20100101 Firefox/64.0', 'Windows 10', '2019-02-14 17:34:51'),
(53, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Firefox 64.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:64.0) Gecko/20100101 Firefox/64.0', 'Windows 10', '2019-02-15 00:04:53'),
(54, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-15 00:10:23'),
(55, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-15 00:20:55'),
(56, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-15 00:22:13'),
(57, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-15 00:51:47'),
(58, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-15 02:46:53'),
(59, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Firefox 64.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:64.0) Gecko/20100101 Firefox/64.0', 'Windows 10', '2019-02-15 03:20:30'),
(60, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Firefox 64.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:64.0) Gecko/20100101 Firefox/64.0', 'Windows 10', '2019-02-15 10:55:24'),
(61, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-15 16:38:35'),
(62, 3, '{\"role\":\"3\",\"roleText\":\"Maintenance Staff\",\"name\":\"Employee\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-15 18:07:03'),
(63, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-15 18:16:20'),
(64, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-16 00:05:23'),
(65, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-17 00:18:36'),
(66, 9, '{\"role\":\"3\",\"roleText\":\"Maintenance Staff\",\"name\":\"Joshua Brian Perater\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-17 00:29:03'),
(67, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-17 02:38:58'),
(68, 9, '{\"role\":\"3\",\"roleText\":\"Maintenance Staff\",\"name\":\"Joshua Brian Perater\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-17 02:41:05'),
(69, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-17 05:18:49'),
(70, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-17 11:43:43'),
(71, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-17 14:03:58'),
(72, 10, '{\"role\":\"4\",\"roleText\":\"Student\",\"name\":\"Cristyfel Pagutayao\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-17 14:06:01'),
(73, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Firefox 64.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:64.0) Gecko/20100101 Firefox/64.0', 'Windows 10', '2019-02-17 14:07:20'),
(74, 11, '{\"role\":\"2\",\"roleText\":\"Faculty\",\"name\":\"Nikkie Eduria\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-17 14:49:51'),
(75, 9, '{\"role\":\"3\",\"roleText\":\"Maintenance Staff\",\"name\":\"Joshua Brian Perater\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-17 15:12:32'),
(76, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-18 07:23:27'),
(77, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-18 07:29:36'),
(78, 10, '{\"role\":\"4\",\"roleText\":\"Student\",\"name\":\"Cristyfel Pagutayao\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-18 10:25:37'),
(79, 11, '{\"role\":\"2\",\"roleText\":\"Faculty\",\"name\":\"Nikkie Eduria\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-18 10:45:40'),
(80, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Firefox 64.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:64.0) Gecko/20100101 Firefox/64.0', 'Windows 10', '2019-02-18 10:52:32'),
(81, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-22 00:13:56'),
(82, 10, '{\"role\":\"4\",\"roleText\":\"Student\",\"name\":\"Cristyfel Pagutayao\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-22 01:00:45'),
(83, 11, '{\"role\":\"2\",\"roleText\":\"Faculty\",\"name\":\"Nikkie Eduria\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-22 01:42:59'),
(84, 1, '{\"role\":\"1\",\"roleText\":\"System Administrator\",\"name\":\"System Administrator\"}', '::1', 'Chrome 72.0.3626.109', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 'Windows 10', '2019-02-26 00:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `locID` int(11) NOT NULL,
  `bldgNo` varchar(15) NOT NULL,
  `roomNo` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `id` int(11) NOT NULL,
  `nofiName` varchar(50) NOT NULL,
  `type` varchar(16) NOT NULL,
  `ownerNotify` int(11) NOT NULL,
  `adminNotify` int(11) NOT NULL,
  `assign` int(11) NOT NULL,
  `resBy` int(11) DEFAULT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`id`, `nofiName`, `type`, `ownerNotify`, `adminNotify`, `assign`, `resBy`, `time`) VALUES
(13, '', 'event', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(14, '', 'event', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(5, '', 'job_request', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(6, '', 'job_request', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(7, '', 'job_request', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(8, '', 'job_request', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(15, '', 'event', 1, 1, 0, 1, '0000-00-00 00:00:00'),
(16, '', 'event', 1, 1, 0, 1, '0000-00-00 00:00:00'),
(17, '', 'event', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(9, '', 'job_request', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(18, '', 'event', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(19, '', 'event', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(21, '', 'event', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(22, '', 'event', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(23, '', 'event', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(10, '', 'job_request', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(11, '', 'job_request', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(12, '', 'job_request', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(24, '', 'event', 0, 1, 0, 1, '0000-00-00 00:00:00'),
(25, '', 'event', 0, 1, 0, 2, '0000-00-00 00:00:00'),
(36, 'title', 'event', 0, 1, 0, 1, '2019-02-17 00:00:00'),
(37, 'Tiitle lang ni', 'event', 0, 1, 0, 1, '2019-02-17 05:20:02'),
(13, 'BLDG 21', 'maintenance', 1, 1, 9, 1, '2019-02-17 05:27:40'),
(14, 'BLDG 21', 'maintenance', 1, 1, 9, 1, '2019-02-17 05:27:46'),
(38, 'Tiitle lang ni', 'event', 0, 1, 0, 1, '2019-02-17 05:50:12'),
(39, 'Tiitle lang ni', 'event', 0, 1, 0, 1, '2019-02-17 05:56:18'),
(40, 'Tiitle lang ni', 'event', 0, 1, 0, 1, '2019-02-17 05:57:51'),
(41, 'Tiitle lang ni', 'event', 0, 1, 0, 1, '2019-02-17 06:28:30'),
(42, 'Tiitle lang ni', 'event', 0, 1, 0, 1, '2019-02-17 06:30:17'),
(43, 'Tiitle lang ni', 'event', 0, 1, 0, 1, '2019-02-17 06:30:38'),
(44, 'Tiitle lang ni', 'event', 0, 1, 0, 1, '2019-02-17 06:47:42'),
(45, '100', 'event', 1, 1, 0, 10, '2019-02-17 14:06:46'),
(46, '1000', 'event', 0, 1, 0, 10, '2019-02-17 14:19:30'),
(15, 'Bldg 143', 'maintenance', 1, 1, 9, 11, '2019-02-17 14:50:16'),
(16, 'Bldg 143', 'maintenance', 1, 1, 0, 11, '2019-02-17 14:51:36'),
(47, 'Tittle lang', 'event', 0, 1, 0, 11, '2019-02-18 10:49:03'),
(48, 'Event NI', 'event', 0, 1, 0, 1, '2019-02-18 10:58:08'),
(21, 'Bldg 23', 'maintenance', 0, 1, 0, 1, '2019-02-26 00:58:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reserve_request`
--

CREATE TABLE `tbl_reserve_request` (
  `formNo` int(11) NOT NULL,
  `noParticipant` int(11) NOT NULL,
  `dateActual` date NOT NULL,
  `timeActual` time DEFAULT NULL,
  `dateEnd` date NOT NULL,
  `timeEnd` time DEFAULT NULL,
  `purpose` varchar(64) NOT NULL,
  `tittleEvent` varchar(64) NOT NULL,
  `status` varchar(32) NOT NULL,
  `contactNo` varchar(32) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `venueID` int(11) NOT NULL,
  `resBy` int(11) NOT NULL,
  `conBy` int(11) DEFAULT NULL,
  `dateReq` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_reserve_request`
--

INSERT INTO `tbl_reserve_request` (`formNo`, `noParticipant`, `dateActual`, `timeActual`, `dateEnd`, `timeEnd`, `purpose`, `tittleEvent`, `status`, `contactNo`, `departmentID`, `venueID`, `resBy`, `conBy`, `dateReq`) VALUES
(1, 100, '2019-02-01', NULL, '2019-02-14', NULL, 'wala ko kabalo', 'Tiitle lang ni', 'approve', '03164975', 1, 1, 1, NULL, '2019-02-10 18:39:05'),
(2, 100, '2019-02-01', NULL, '2019-02-14', NULL, 'wala ko kabalo', 'Tiitle lang ni', 'approve', '03164975', 1, 1, 1, NULL, '2019-02-10 18:39:50'),
(3, 100, '2019-02-01', NULL, '2019-02-14', NULL, 'wala ko kabalo', 'Tiitle lang ni', 'pending', '03164975', 1, 1, 1, NULL, '2019-02-10 18:40:21'),
(4, 100, '2019-02-16', NULL, '2019-02-05', NULL, 'wala ko kabalo', 'Tiitle lang ni', 'pending', '03164975', 1, 1, 1, NULL, '2019-02-10 18:41:54'),
(5, 100, '2019-02-11', NULL, '2019-02-12', NULL, 'wala ko kabalo', 'Tiitle lang ni', 'approve', '03164975', 1, 1, 1, NULL, '2019-02-11 15:50:48'),
(6, 100, '2019-02-11', '11:11:00', '2019-02-12', '11:11:00', 'wala ko kabalo', 'saba', 'pending', '03164975', 1, 1, 1, NULL, '2019-02-11 21:05:03'),
(7, 100, '2019-02-13', '11:11:00', '2019-02-12', '11:11:00', 'wala ko kabalo', 'Tiitle lang ni', 'pending', '03164975', 1, 1, 1, NULL, '2019-02-12 05:38:50'),
(8, 100, '2019-02-13', '11:11:00', '2019-02-12', '11:11:00', 'wala ko kabalo', 'Tiitle lang ni', 'pending', '03164975', 1, 1, 1, NULL, '2019-02-12 05:45:18'),
(9, 100, '2019-02-13', '11:11:00', '2019-02-15', '11:11:00', 'wala ko kabalo', 'Tiitle lang ni', 'approve', '03164975', 1, 1, 1, NULL, '2019-02-12 05:49:19'),
(10, 100, '2019-02-13', '11:11:00', '2019-02-15', '11:11:00', 'wala ko kabalo', 'Tiitle lang ni', 'approve', '03164975', 1, 1, 10, NULL, '2019-02-12 05:51:32'),
(13, 2, '2019-02-20', NULL, '2019-02-06', NULL, '21e12', 'e12e', 'e12e', 'e12e1', 1, 1, 1, NULL, '2019-02-13 17:50:44'),
(14, 2, '2019-02-20', NULL, '2019-02-06', NULL, '21e12', 'e12e', 'e12e', 'e12e1', 1, 1, 1, NULL, '2019-02-13 17:50:52'),
(15, 200, '2019-02-15', NULL, '2019-02-16', NULL, 'pag sure', 'tittle', 'approve', '09336', 1, 1, 1, NULL, '2019-02-13 20:49:49'),
(16, 200, '2019-02-15', NULL, '2019-02-16', NULL, 'pag sure', 'tittle', 'approve', '09336', 1, 1, 1, NULL, '2019-02-13 20:50:06'),
(17, 100, '2019-02-15', NULL, '2019-02-16', NULL, 'try agian', 'tittle again', 'approve', '0916994', 1, 1, 1, NULL, '2019-02-13 20:52:23'),
(18, 100, '2019-02-14', NULL, '2019-02-15', NULL, 'pupose', 'tiiitle', 'approve', 'daw', 1, 1, 1, NULL, '2019-02-13 20:55:29'),
(19, 100, '2019-02-14', NULL, '2019-02-15', NULL, 'pupose', 'tiiitle', 'pending', 'daw', 1, 1, 10, NULL, '2019-02-13 20:55:36'),
(21, 100, '2019-02-14', NULL, '2019-02-15', NULL, 'purpose', 'title', 'pending', 'daw', 1, 1, 1, NULL, '2019-02-13 21:03:25'),
(22, 10, '2019-02-22', NULL, '2019-02-16', NULL, 'purpose', 'tiile', 'pending', 'daw', 1, 1, 1, NULL, '2019-02-13 21:05:03'),
(23, 10, '2019-02-22', NULL, '2019-02-16', NULL, 'purpose', 'tiile', 'pending', 'daw', 1, 1, 1, NULL, '2019-02-13 21:05:15'),
(24, 100, '2019-02-22', '10:00:00', '2019-03-22', '10:00:00', 'wala ko kabalo', 'Tiitle lang ni', 'pending', '03164975', 1, 1, 1, NULL, '2019-02-13 21:17:06'),
(25, 100, '2019-02-22', '08:11:00', '2019-02-22', '11:11:00', 'wala ko kabalo', 'Tiitle lang ni', 'approve', '03164975', 1, 1, 2, NULL, '2019-02-13 22:32:38'),
(33, 100, '2019-02-13', NULL, '2019-02-13', NULL, 'qwqw', 'wqwqw', 'wqwq', 'wqw', 1, 1, 1, NULL, '2019-02-14 19:44:29'),
(34, 100, '2019-01-04', NULL, '2019-01-11', NULL, 'daw', 'dawd', 'approve', 'daw', 1, 1, 1, NULL, '2019-02-14 19:45:17'),
(36, 100, '2019-01-05', NULL, '2019-01-11', NULL, 'wala', 'title', 'pending', '0916355', 1, 1, 1, NULL, '2019-02-16 21:11:17'),
(37, 100, '2019-02-20', '11:11:00', '2019-02-21', '11:11:00', 'wala ko kabalo', 'Tiitle lang ni', 'pending', '03164975', 1, 1, 1, NULL, '2019-02-16 21:20:02'),
(38, 100, '2019-02-20', '11:11:00', '2019-02-21', '11:11:00', 'wala ko kabalo', 'Tiitle lang ni', 'pending', '03164975', 1, 1, 1, NULL, '2019-02-16 21:50:12'),
(39, 100, '2019-02-20', '11:11:00', '2019-02-21', '11:11:00', 'wala ko kabalo', 'Tiitle lang ni', 'pending', '03164975', 1, 1, 1, NULL, '2019-02-16 21:56:18'),
(40, 100, '2019-02-20', '11:11:00', '2019-02-21', '11:11:00', 'wala ko kabalo', 'Tiitle lang ni', 'pending', '03164975', 1, 1, 1, NULL, '2019-02-16 21:57:51'),
(41, 100, '2019-02-20', '11:11:00', '2019-02-21', '11:11:00', 'wala ko kabalo', 'Tiitle lang ni', 'pending', '03164975', 1, 1, 1, NULL, '2019-02-16 22:28:30'),
(42, 100, '2019-02-20', '11:11:00', '2019-02-21', '11:11:00', 'wala ko kabalo', 'Tiitle lang ni', 'pending', '03164975', 1, 1, 1, NULL, '2019-02-16 22:30:17'),
(43, 100, '2019-02-20', '11:11:00', '2019-02-21', '11:11:00', 'wala ko kabalo', 'Tiitle lang ni', 'pending', '03164975', 1, 1, 1, NULL, '2019-02-16 22:30:38'),
(44, 100, '2019-02-20', '11:11:00', '2019-02-21', '11:11:00', 'wala ko kabalo', 'Tiitle lang ni', 'pending', '03164975', 1, 1, 1, NULL, '2019-02-16 22:47:42'),
(45, 120, '2019-02-18', '11:11:00', '2019-02-18', '11:11:00', 'wala ko kabalo', '100', 'approve', '03164975', 1, 1, 10, NULL, '2019-02-17 06:06:46'),
(46, 100, '2019-02-19', '11:11:00', '2019-02-19', '11:11:00', 'wala ko kabalo', '1000', 'approve', '03164975', 1, 1, 10, NULL, '2019-02-17 06:19:30'),
(47, 100, '2019-02-19', '11:11:00', '2019-02-19', '11:11:00', 'wala ko kabalo', 'Tittle lang', 'pending', '03164975', 1, 1, 11, NULL, '2019-02-18 02:49:03'),
(48, 100, '2019-02-19', '11:11:00', '2019-02-20', '11:11:00', 'purpose', 'Event NI', 'pending', '0935194266', 1, 1, 1, NULL, '2019-02-18 02:58:08');

--
-- Triggers `tbl_reserve_request`
--
DELIMITER $$
CREATE TRIGGER `insertNotify` AFTER INSERT ON `tbl_reserve_request` FOR EACH ROW INSERT INTO tbl_notification VALUES (new.formNo,new.tittleEvent,"event",0,1,0,new.resBy,CURRENT_TIMESTAMP)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`roleId`, `role`) VALUES
(1, 'System Administrator'),
(2, 'Faculty'),
(3, 'Maintenance Staff'),
(4, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `roleId` tinyint(4) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userId`, `email`, `password`, `name`, `mobile`, `roleId`, `isDeleted`, `createdBy`, `createdDtm`, `updatedBy`, `updatedDtm`) VALUES
(1, 'admin@example.com', '$2y$10$6NOKhXKiR2SAgpFF2WpCkuRgYKlSqFJaqM0NgIM3PT1gKHEM5/SM6', 'System Administrator', '9890098900', 1, 0, 0, '2015-07-01 18:56:49', 1, '2018-01-05 05:56:34'),
(2, 'manager@example.com', '$2y$10$quODe6vkNma30rcxbAHbYuKYAZQqUaflBgc4YpV9/90ywd.5Koklm', 'Manager', '9890098900', 2, 0, 1, '2016-12-09 17:49:56', 1, '2018-01-12 07:22:11'),
(3, 'employee@example.com', '$2y$10$UYsH1G7MkDg1cutOdgl2Q.ZbXjyX.CSjsdgQKvGzAgl60RXZxpB5u', 'Employee', '9890098900', 3, 0, 1, '2016-12-09 17:50:22', 3, '2018-01-04 07:58:28'),
(9, 'ambot@gmail.com', '$2y$10$/OU6WZkh/vv3ydYDivKXrOjulVb21WrE6atrncVzNxzwX7BCsjbFq', 'Joshua Brian Perater', '0000000000', 3, 0, 1, '2019-02-14 10:19:19', 1, '2019-02-16 17:27:51'),
(10, 'cristy@gmail.com', '$2y$10$/WpArcwvWMaDC9fhh6bjHuonrmoRm20zwsTaFgASMc4iLcqCCMUom', 'Cristyfel Pagutayao', '0000000000', 4, 0, 1, '2019-02-17 07:05:38', NULL, NULL),
(11, 'eduria@gmail.com', '$2y$10$ptACJujjfnkGA7TGKHMfOOhqmiudXpP8vCBWV2wUMsh85eAGdY.vi', 'Nikkie Eduria', '1000000000', 2, 0, 1, '2019-02-17 07:47:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venue`
--

CREATE TABLE `tbl_venue` (
  `venID` int(11) NOT NULL,
  `bldgNo` varchar(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `type` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_venue`
--

INSERT INTO `tbl_venue` (`venID`, `bldgNo`, `name`, `type`) VALUES
(1, '401', 'AVR', 'AVR'),
(2, '501', 'GYM', 'GYM'),
(3, '123', 'wag', 'daw'),
(4, 'd', '12', 'daw'),
(5, '123', 'AVR SAmple', 'Electrical');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`departId`);

--
-- Indexes for table `tbl_equipment`
--
ALTER TABLE `tbl_equipment`
  ADD PRIMARY KEY (`equipId`);

--
-- Indexes for table `tbl_equipment_history`
--
ALTER TABLE `tbl_equipment_history`
  ADD KEY `equipId` (`equipId`);

--
-- Indexes for table `tbl_event_equip`
--
ALTER TABLE `tbl_event_equip`
  ADD PRIMARY KEY (`equipId`);

--
-- Indexes for table `tbl_job_request`
--
ALTER TABLE `tbl_job_request`
  ADD PRIMARY KEY (`jobId`);

--
-- Indexes for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_reserve_request`
--
ALTER TABLE `tbl_reserve_request`
  ADD PRIMARY KEY (`formNo`),
  ADD KEY `departmentID` (`departmentID`),
  ADD KEY `venueID` (`venueID`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `tbl_venue`
--
ALTER TABLE `tbl_venue`
  ADD PRIMARY KEY (`venID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `departId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_equipment`
--
ALTER TABLE `tbl_equipment`
  MODIFY `equipId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_event_equip`
--
ALTER TABLE `tbl_event_equip`
  MODIFY `equipId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_job_request`
--
ALTER TABLE `tbl_job_request`
  MODIFY `jobId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `tbl_reserve_request`
--
ALTER TABLE `tbl_reserve_request`
  MODIFY `formNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tbl_venue`
--
ALTER TABLE `tbl_venue`
  MODIFY `venID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_equipment_history`
--
ALTER TABLE `tbl_equipment_history`
  ADD CONSTRAINT `tbl_equipment_history_ibfk_1` FOREIGN KEY (`equipId`) REFERENCES `tbl_equipment` (`equipId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_reserve_request`
--
ALTER TABLE `tbl_reserve_request`
  ADD CONSTRAINT `tbl_reserve_request_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `tbl_department` (`departId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_reserve_request_ibfk_2` FOREIGN KEY (`venueID`) REFERENCES `tbl_venue` (`venID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
