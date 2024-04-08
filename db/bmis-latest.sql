-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 11:48 AM
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
-- Database: `bmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `email`, `password`, `lname`, `fname`, `mi`, `role`) VALUES
(1, 'admin@gmail.com', '$2y$12$ViiL6Wq2tezmsJ8aFSjUrufLSs55x4Ligv0jbsNq.OOCWF2aYBfdK', 'Turqueza', 'Cynthia', 'G.', 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcement`
--

CREATE TABLE `tbl_announcement` (
  `id_announcement` int(11) NOT NULL,
  `announcement_title` text NOT NULL,
  `event` varchar(1000) NOT NULL,
  `announcement_datetime` datetime NOT NULL,
  `target` varchar(255) DEFAULT NULL,
  `announcement_image` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `addedby` varchar(255) NOT NULL,
  `status` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_announcement`
--

INSERT INTO `tbl_announcement` (`id_announcement`, `announcement_title`, `event`, `announcement_datetime`, `target`, `announcement_image`, `start_date`, `addedby`, `status`) VALUES
(45, '🌿 Clean-Up Drive Alert! 🌿', 'Dear Sta. Rita Residents,\r\n\r\nJoin us for a Clean-Up Drive on March 20 at 6:00 AM at Barangay Sta.Rita. Let\'s work together for a cleaner, greener Barangay Sta. Rita!\r\n\r\nSee you there!', '2024-03-20 06:00:00', NULL, 'uploads/announcements/1710182903.jpg', '2024-03-12', 'Turqueza, Charlene', 'Ongoing'),
(46, '🌟 Introducing CommuniServe! 🌟', 'Dear Sta. Rita Residents, Exciting news! CommuniServe, our new barangay management system, is here! Access services, stay informed, and collaborate easily with your community. Let\'s make Sta. Rita even better together! ', '2024-03-14 08:00:00', NULL, 'uploads/announcements/1710316238.png', '2024-03-13', 'Turqueza, Charlene', 'Ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blotter`
--

CREATE TABLE `tbl_blotter` (
  `id_blotter` int(11) NOT NULL,
  `id_resident` int(11) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `houseno` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `municipal` varchar(255) NOT NULL,
  `blot_photo` varchar(255) DEFAULT '',
  `contact` varchar(50) NOT NULL DEFAULT '',
  `narrative` mediumtext NOT NULL,
  `timeapplied` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brgyid`
--

CREATE TABLE `tbl_brgyid` (
  `id_brgyid` int(11) NOT NULL,
  `track_id` varchar(15) NOT NULL,
  `id_resident` int(11) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `houseno` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `municipal` varchar(255) NOT NULL,
  `bplace` varchar(255) NOT NULL,
  `bdate` varchar(255) NOT NULL,
  `res_photo` varchar(255) DEFAULT NULL,
  `inc_lname` varchar(255) NOT NULL,
  `inc_fname` varchar(255) NOT NULL,
  `inc_mi` varchar(255) NOT NULL,
  `inc_contact` varchar(255) NOT NULL,
  `inc_houseno` varchar(255) NOT NULL,
  `inc_street` varchar(255) NOT NULL,
  `inc_brgy` varchar(255) NOT NULL,
  `inc_municipal` varchar(255) DEFAULT NULL,
  `form_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_brgyid`
--

INSERT INTO `tbl_brgyid` (`id_brgyid`, `track_id`, `id_resident`, `lname`, `fname`, `mi`, `houseno`, `street`, `brgy`, `municipal`, `bplace`, `bdate`, `res_photo`, `inc_lname`, `inc_fname`, `inc_mi`, `inc_contact`, `inc_houseno`, `inc_street`, `inc_brgy`, `inc_municipal`, `form_status`, `date`, `created_at`, `deleted_at`) VALUES
(8, '65ef46f9ee04f', 23, 'Turqueza', 'Charlene', 'Gonzales', '1022', 'Jasmin Street', 'Sta. rita', 'Olongapo city', '', '2001-07-31', 'uploads/brgyid/1710180089.jpg', 'Turqueza', 'Cynthia', 'Gonzales', '09279374521', '1022', 'JASMIN STREET', 'Sta.Rita', NULL, 'Approved', '2024-03-13', '2024-03-11 18:01:29', NULL),
(9, '65ef4f585f4f5', 23, 'Turqueza', 'Charlene', 'Gonzales', '1022', 'Jasmin Street', 'Sta. rita', 'Olongapo city', '', '2001-07-31', 'uploads/brgyid/1710182232.jpg', 'Turqueza', 'Cynthia', 'Gonzales', '09279374521', '1022', 'JASMIN STREET', 'Sta.Rita', NULL, 'Declined', '2024-03-13', '2024-03-11 18:37:12', NULL),
(10, '65f07c39d14ad', 47, 'Turqueza', 'Charlene', 'Gonzales', '1022', 'Jasmin Street', 'Sta. rita', 'Olongapo city', '', '2001-07-31', 'uploads/brgyid/1710259257.png', 'Turqueza', 'Cynthia', 'Gonzales', '09279374521', '1022', 'JASMIN STREET', 'Sta.Rita', NULL, 'Approved', '2024-03-14', '2024-03-12 16:00:57', NULL),
(11, '65f08c8348363', 38, 'Canlas', 'Ronalyn may', 'Carpio', '1378', 'Part of Tabacuhan Road', 'Sta. rita', 'Olongapo city', '', '2002-05-10', 'uploads/brgyid/1710263427.jpg', 'Garcia', 'Eddie', 'Canlas', '09762564444', '893', 'Aries', 'Santa Rita', NULL, 'Pending', '2024-03-14', '2024-03-12 17:10:27', NULL),
(12, '65f08d0a27b8b', 39, 'Racela', 'Anne claire', 'Noblado', '226', 'Manggahan Street', 'Sta. rita', 'Olongapo city', '', '2002-03-01', 'uploads/brgyid/1710263562.jpg', 'Aquino', 'Liz', 'Racela', '09964621644', '333', 'Capricorn St', 'Santa Rita', NULL, 'Pending', '2024-03-18', '2024-03-12 17:12:42', NULL),
(13, '65f08ebc32b65', 31, 'Mallari', 'Rhex warren', 'Cabrera', 'Lot 1', 'Capricorn Street', 'Sta. rita', 'Olongapo city', '', '2001-10-11', 'uploads/brgyid/1710263996.jpg', 'Aquino', 'Rodrigo', 'Mallari', '09062468555', '123', 'Aries', 'Santa Rita', NULL, 'Pending', '2024-03-15', '2024-03-12 17:19:56', NULL),
(14, '65f0935b8d578', 36, 'Turqueza', 'Rommel', 'Gonzales', '1022', 'Jasmin Street', 'Sta. rita', 'Olongapo city', '', '1987-06-26', 'uploads/brgyid/1710265179.jpg', 'Turqueza', 'Brenda', 'Gonzales', '09079474702', '3F', 'Jasmin St.', 'Santa Rita', NULL, 'Pending', '2024-03-19', '2024-03-12 17:39:39', NULL),
(15, '65f0944e189c8', 43, 'Turqueza', 'Trisha sophia', 'Laluan', '1022', 'Jasmin Street', 'Sta. rita', 'Olongapo city', '', '2003-08-27', 'uploads/brgyid/1710265422.jpg', 'Turqueza', 'Rommel', 'Gonzales', '09999932721', '3F', 'Jasmin St.', 'Santa Rita', NULL, 'Pending', '2024-03-18', '2024-03-12 17:43:42', NULL),
(16, '65f09509e60d3', 37, 'Turqueza', 'Brenda', 'Laluan', '1022', 'Jasmin Street', 'Sta. rita', 'Olongapo city', '', '1981-12-16', 'uploads/brgyid/1710265609.jpg', 'Turqueza', 'Rommel', 'Gonzales', '09999932721', '3F', 'Jasmin St.', 'Santa Rita', NULL, 'Pending', '2024-03-19', '2024-03-12 17:46:49', NULL),
(17, '65f15e30ae29e', 35, 'Turqueza', 'Cynthia', 'Gonzales', '1022', 'Jasmin Street', 'Sta. rita', 'Olongapo city', '', '1963-06-16', 'uploads/brgyid/1710317104.png', 'Turqueza', 'Rommel', 'Gonzales', '09999932721', '1022', 'JASMIN STREET', 'Sta.Rita', NULL, 'Pending', '2024-03-15', '2024-03-13 08:05:04', NULL),
(18, '65f16462dfde0', 43, 'Turqueza', 'Trisha sophia', 'Laluan', '1022', 'Jasmin Street', 'Sta. rita', 'Olongapo city', '', '2003-08-27', 'uploads/brgyid/1710318690.jpg', 'Turqueza', 'Rommel', 'Gonzales', '09999932721', '1022', 'JASMIN STREET', 'Sta.Rita', NULL, 'Pending', '2024-03-15', '2024-03-13 08:31:30', NULL),
(19, '65f1672d112c3', 43, 'Turqueza', 'Trisha sophia', 'Laluan', '1022', 'Jasmin Street', 'Sta. rita', 'Olongapo city', '', '2003-08-27', 'uploads/brgyid/1710319405.jpg', 'Turqueza', 'Brenda', 'Gonzales', '09079474702', '1022', 'JASMIN STREET', 'Sta.Rita', NULL, 'Pending', '2024-03-14', '2024-03-13 08:43:25', NULL),
(20, '65f1675cab0b2', 36, 'Turqueza', 'Rommel', 'Gonzales', '1022', 'Jasmin Street', 'Sta. rita', 'Olongapo city', '', '1987-06-26', 'uploads/brgyid/1710319452.png', 'Turqueza', 'Brenda', 'Gonzales', '09079474702', '1022', 'JASMIN STREET', 'Sta.Rita', NULL, 'Pending', '2024-03-14', '2024-03-13 08:44:12', NULL),
(21, '65f167970b922', 37, 'Turqueza', 'Brenda', 'Laluan', '1022', 'Jasmin Street', 'Sta. rita', 'Olongapo city', '', '1981-12-16', 'uploads/brgyid/1710319511.jpg', 'Turqueza', 'Rommel', 'Gonzales', '09999932721', '1022', 'JASMIN STREET', 'Sta.Rita', NULL, 'Pending', '2024-03-15', '2024-03-13 08:45:11', NULL),
(22, '65f16aeb5f541', 40, 'Duarte', 'Dan', 'Uvas', '1629', 'Laban Street', 'Sta. rita', 'Olongapo city', '', '2002-01-16', 'uploads/brgyid/1710320363.jpg', 'Solivar', 'Marco', 'Mediana', '09989387564', '1567', 'Lincoln', 'Old Cabalan', NULL, 'Pending', '2024-03-14', '2024-03-13 08:59:23', NULL),
(23, '65f187b793f66', 23, 'Turqueza', 'Charlene', 'Gonzales', '1022', 'Jasmin Street', 'Sta. rita', 'Olongapo city', '', '2001-07-31', 'uploads/brgyid/1710327735.png', 'Turqueza', 'Cynthia', 'Gonzales', '09995011381', '1022', 'JASMIN STREET', 'Sta.Rita', NULL, 'Pending', '2024-03-15', '2024-03-13 11:02:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bspermit`
--

CREATE TABLE `tbl_bspermit` (
  `id_bspermit` int(11) NOT NULL,
  `track_id` varchar(15) NOT NULL,
  `id_resident` int(11) NOT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mi` varchar(255) DEFAULT NULL,
  `bsname` varchar(255) DEFAULT NULL,
  `houseno` varchar(255) DEFAULT NULL,
  `street` varchar(252) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `municipal` varchar(255) DEFAULT NULL,
  `bsindustry` varchar(255) DEFAULT NULL,
  `aoe` int(11) NOT NULL,
  `bspermit_photo` varchar(255) DEFAULT NULL,
  `form_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bspermit`
--

INSERT INTO `tbl_bspermit` (`id_bspermit`, `track_id`, `id_resident`, `lname`, `fname`, `mi`, `bsname`, `houseno`, `street`, `brgy`, `municipal`, `bsindustry`, `aoe`, `bspermit_photo`, `form_status`, `date`, `created_at`, `deleted_at`) VALUES
(13, '65ef451b25287', 23, 'Turqueza', 'Charlene', 'Gonzales', 'ChaCafe', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Food', 100, 'uploads/bspermit/1710179611.jpg', 'Approved', '2024-03-13', '2024-03-11 17:53:31', NULL),
(14, '65ef4f3797627', 23, 'Turqueza', 'Charlene', 'Gonzales', 'ChaCafe', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Food', 100, 'uploads/bspermit/1710182199.jpg', 'Declined', '2024-03-12', '2024-03-11 18:36:39', NULL),
(15, '65f07bee4f424', 47, 'Turqueza', 'Charlene', 'Gonzales', 'ChaCafe', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Food', 100, 'uploads/bspermit/1710259182.jpg', 'Declined', '2024-03-13', '2024-03-12 15:59:42', NULL),
(16, '65f08a3640142', 31, 'Mallari', 'Rhex Warren', 'Cabrera', 'Rhex Business', '3F', 'Capricorn Street', 'Sta. Rita', 'Olongapo City', 'Computer', 700, 'uploads/bspermit/1710262838.jfif', 'Pending', '2024-03-15', '2024-03-12 17:00:38', NULL),
(17, '65f08bd2dccf1', 36, 'Turqueza', 'Rommel', 'Gonzales', 'RBT Printing Shop', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Computer', 600, 'uploads/bspermit/1710263250.jpg', 'Pending', '2024-03-15', '2024-03-12 17:07:30', NULL),
(18, '65f08f5dd8eb5', 43, 'Turqueza', 'Trisha Sophia', 'Laluan', 'Trisha Law Group', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Education', 400, 'uploads/bspermit/1710264157.jpg', 'Pending', '2024-03-19', '2024-03-12 17:22:37', NULL),
(19, '65f092a360059', 37, 'Turqueza', 'Brenda', 'Laluan', 'Brenda Catering Services', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Food', 500, 'uploads/bspermit/1710264995.jfif', 'Pending', '2024-03-18', '2024-03-12 17:36:35', NULL),
(20, '65f099dff1031', 38, 'Canlas', 'Ronalyn May', 'Carpio', 'Canlas Trading', '2', 'Filtration Road (Right Side from Sta. Rita Bridge to Winnies Bake Shop Sampaguita Road)', 'Sta. Rita', 'Olongapo City', 'Construction', 1000, 'uploads/bspermit/1710266847.jfif', 'Pending', '2024-03-18', '2024-03-12 18:07:27', NULL),
(21, '65f09a4759367', 34, 'Turqueza', 'Gerald', 'Gonzales', 'Gerald\'s Pharmacy', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Pharmaceutical', 698, 'uploads/bspermit/1710266951.jfif', 'Pending', '2024-03-15', '2024-03-12 18:09:11', NULL),
(22, '65f0beb3562ca', 39, 'Racela', 'Anne Claire', 'Noblado', 'Anne\'s Music Hub', '1A', 'Mabolo Street', 'Sta. Rita', 'Olongapo City', 'Music', 620, 'uploads/bspermit/1710276275.jfif', 'Pending', '2024-03-19', '2024-03-12 20:44:35', NULL),
(24, '65f0e1e36aad0', 36, 'Turqueza', 'Rommel', 'Gonzales', 'RBT Printing Services', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Computer', 600, 'uploads/bspermit/1710285283.png', 'Pending', '2024-03-18', '2024-03-12 23:14:43', NULL),
(25, '65f15b61cc277', 23, 'Turqueza', 'Charlene', 'Gonzales', 'Castle Entertainment', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Entertainment', 200, 'uploads/bspermit/1710316385.jpg', 'Pending', '2024-03-15', '2024-03-13 07:53:05', NULL),
(26, '65f15c2cd3b69', 31, 'Mallari', 'Rhex Warren', 'Cabrera', 'Rochelle News-Leader', '5B', 'Laban Street', 'Sta. Rita', 'Olongapo City', 'News Media', 150, 'uploads/bspermit/1710316588.png', 'Pending', '2024-03-18', '2024-03-13 07:56:28', NULL),
(27, '65f15cbd5eade', 38, 'Canlas', 'Ronalyn May', 'Carpio', 'Superior Tank & Pipe', '4D', 'Soriano Street', 'Sta. Rita', 'Olongapo City', 'Mining', 230, 'uploads/bspermit/1710316733.jpg', 'Declined', '2024-03-18', '2024-03-13 07:58:53', NULL),
(28, '65f15d7031462', 38, 'Canlas', 'Ronalyn May', 'Carpio', 'Superior Tank & Pipe', '5D', 'From Block 14 to Block 23', 'Sta. Rita', 'Olongapo City', 'Mining', 230, 'uploads/bspermit/1710316912.jpg', 'Pending', '2024-03-18', '2024-03-13 08:01:52', NULL),
(29, '65f161330b934', 37, 'Turqueza', 'Brenda', 'Laluan', 'Medicare', '4C', 'Mercury Lane', 'Sta. Rita', 'Olongapo City', 'Hospitality', 200, 'uploads/bspermit/1710317875.jpg', 'Pending', '2024-03-18', '2024-03-13 08:17:55', NULL),
(30, '65f169d5baafb', 40, 'Duarte', 'Dan', 'Uvas', 'Cobratate', '5A', 'Balic-Balic Road (Right Side from Corner Tabacuhan to Corner Laban Street)', 'Sta. Rita', 'Olongapo City', 'Computer', 108, 'uploads/bspermit/1710320085.jpg', 'Pending', '2024-03-14', '2024-03-13 08:54:45', NULL),
(31, '65f186bf2bb88', 23, 'Turqueza', 'Charlene', 'Gonzales', 'ChaCafe', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Food', 100, 'uploads/bspermit/1710327487.jpg', 'Pending', '2024-03-15', '2024-03-13 10:58:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clearance`
--

CREATE TABLE `tbl_clearance` (
  `id_clearance` int(11) NOT NULL,
  `track_id` varchar(15) NOT NULL,
  `id_resident` int(11) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `bdate` text NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `houseno` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `municipal` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `brgyclearance_photo` varchar(255) DEFAULT NULL,
  `form_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_clearance`
--

INSERT INTO `tbl_clearance` (`id_clearance`, `track_id`, `id_resident`, `lname`, `fname`, `mi`, `bdate`, `purpose`, `houseno`, `street`, `brgy`, `municipal`, `status`, `brgyclearance_photo`, `form_status`, `date`, `created_at`, `deleted_at`) VALUES
(6, '65ef49b991371', 23, 'Turqueza', 'Charlene', 'Gonzales', '', 'School Requirement', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Single', 'uploads/brgyclearance/1710180793.jpg', 'Approved', '2024-03-13', '2024-03-11 18:13:13', NULL),
(7, '65ef4f93670ec', 23, 'Turqueza', 'Charlene', 'Gonzales', '', 'UMID Card', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Single', 'uploads/brgyclearance/1710182291.jpg', 'Declined', '2024-03-13', '2024-03-11 18:38:11', NULL),
(8, '65f08042091b6', 47, 'Turqueza', 'Charlene', 'Gonzales', '2001-07-31', 'Postal ID', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Single', 'uploads/brgyclearance/1710260290.jpg', 'Pending', '2024-03-14', '2024-03-12 16:18:10', NULL),
(9, '65f08aeaca3a9', 34, 'Turqueza', 'Gerald', 'Gonzales', '1993-03-07', 'Driver\'s License', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Single', 'uploads/brgyclearance/1710263018.jpg', 'Pending', '2024-03-19', '2024-03-12 17:03:38', NULL),
(10, '65f08da5819a7', 38, 'Canlas', 'Ronalyn May', 'Carpio', '2002-05-10', 'Job Requirement', '1378', 'Part of Tabacuhan Road', 'Sta. Rita', 'Olongapo City', 'Single', 'uploads/brgyclearance/1710263717.jpg', 'Pending', '2024-03-14', '2024-03-12 17:15:17', NULL),
(11, '65f08e65a03b4', 31, 'Mallari', 'Rhex Warren', 'Cabrera', '2001-10-11', 'Business Requirement', 'Lot 1', 'Capricorn Street', 'Sta. Rita', 'Olongapo City', 'Single', 'uploads/brgyclearance/1710263909.jpg', 'Pending', '2024-03-15', '2024-03-12 17:18:29', NULL),
(12, '65f0924399b1d', 39, 'Racela', 'Anne Claire', 'Noblado', '2002-03-01', 'Business Requirement', '226', 'Manggahan Street', 'Sta. Rita', 'Olongapo City', 'Single', 'uploads/brgyclearance/1710264899.jpg', 'Pending', '2024-03-15', '2024-03-12 17:34:59', NULL),
(13, '65f092d98ca5c', 37, 'Turqueza', 'Brenda', 'Laluan', '1981-12-16', 'Business Requirement', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Single', 'uploads/brgyclearance/1710265049.jpg', 'Pending', '2024-03-14', '2024-03-12 17:37:29', NULL),
(14, '65f0993fcd19f', 36, 'Turqueza', 'Rommel', 'Gonzales', '1987-06-26', 'NBI Clearance', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Married', 'uploads/brgyclearance/1710266687.jpg', 'Pending', '2024-03-19', '2024-03-12 18:04:47', NULL),
(15, '65f0be042fde2', 24, 'Amorin', 'Ian', 'Rallos', '1993-01-17', 'Job Requirement', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Single', 'uploads/brgyclearance/1710276100.jpg', 'Declined', '2024-03-15', '2024-03-12 20:41:40', NULL),
(16, '65f15b9459aa1', 23, 'Turqueza', 'Charlene', 'Gonzales', '2001-07-31', 'Philhealth', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Single', 'uploads/brgyclearance/1710316436.jpg', 'Pending', '2024-03-20', '2024-03-13 07:53:56', NULL),
(17, '65f15d973c373', 38, 'Canlas', 'Ronalyn May', 'Carpio', '2002-05-10', 'Open a Bank Account', '1378', 'Part of Tabacuhan Road', 'Sta. Rita', 'Olongapo City', 'Single', 'uploads/brgyclearance/1710316951.jpg', 'Pending', '2024-03-18', '2024-03-13 08:02:31', NULL),
(18, '65f161a11cac9', 37, 'Turqueza', 'Brenda', 'Laluan', '1981-12-16', 'Police Clearance', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Married', 'uploads/brgyclearance/1710317985.jpg', 'Pending', '2024-03-18', '2024-03-13 08:19:45', NULL),
(19, '65f162b704ad4', 36, 'Turqueza', 'Rommel', 'Gonzales', '1987-06-26', 'Open a Bank Account', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Married', 'uploads/brgyclearance/1710318263.jpg', 'Pending', '2024-03-14', '2024-03-13 08:24:23', NULL),
(20, '65f163c26bc5c', 39, 'Racela', 'Anne Claire', 'Noblado', '2002-03-01', 'Job Requirement', '226', 'Manggahan Street', 'Sta. Rita', 'Olongapo City', 'Single', 'uploads/brgyclearance/1710318530.jpg', 'Pending', '2024-03-15', '2024-03-13 08:28:50', NULL),
(21, '65f16b5d2f545', 40, 'Duarte', 'Dan', 'Uvas', '2002-01-16', 'Police Clearance', '1629', 'Laban Street', 'Sta. Rita', 'Olongapo City', 'Single', 'uploads/brgyclearance/1710320477.jpg', 'Pending', '2024-03-14', '2024-03-13 09:01:17', NULL),
(22, '65f1906fefbb4', 23, 'Turqueza', 'Charlene', 'Gonzales', '2001-07-31', 'Open a Bank Account', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Single', 'uploads/brgyclearance/1710329967.jpg', 'Pending', '2024-03-14', '2024-03-13 11:39:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_indigency`
--

CREATE TABLE `tbl_indigency` (
  `id_indigency` int(11) NOT NULL,
  `track_id` varchar(15) NOT NULL,
  `id_resident` int(11) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `houseno` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `municipal` varchar(255) NOT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `form_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `certofindigency_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_indigency`
--

INSERT INTO `tbl_indigency` (`id_indigency`, `track_id`, `id_resident`, `lname`, `fname`, `mi`, `nationality`, `houseno`, `street`, `brgy`, `municipal`, `purpose`, `date`, `form_status`, `certofindigency_photo`, `created_at`, `deleted_at`) VALUES
(7, '65ef48e6e2962', 23, 'Turqueza', 'Charlene', 'Gonzales', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Financial Transaction', '2024-03-13', 'Approved', 'uploads/certofindigency/1710180582.png', '2024-03-11 18:09:42', NULL),
(8, '65ef4f72b5f66', 23, 'Turqueza', 'Charlene', 'Gonzales', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Job/Employment', '2024-03-13', 'Declined', 'uploads/certofindigency/1710182258.png', '2024-03-11 18:37:38', NULL),
(9, '65f04f46192d3', 40, 'Duarte', 'Dan', 'Uvas', 'Filipino', '1629', 'Laban Street', 'Sta. Rita', 'Olongapo City', 'Business Establishment', '2024-03-13', 'Declined', 'uploads/certofindigency/1710247750.jpg', '2024-03-12 12:49:10', NULL),
(10, '65f07c99422ed', 35, 'Turqueza', 'Cynthia', 'Gonzales', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Financial Transaction', '2024-03-14', 'Pending', 'uploads/certofindigency/1710259353.png', '2024-03-12 16:02:33', NULL),
(11, '65f08b4e36268', 43, 'Turqueza', 'Trisha Sophia', 'Laluan', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Scholarship', '2024-03-14', 'Pending', 'uploads/certofindigency/1710263118.png', '2024-03-12 17:05:18', NULL),
(12, '65f091fe82c12', 38, 'Canlas', 'Ronalyn May', 'Carpio', 'Filipino', '1378', 'Part of Tabacuhan Road', 'Sta. Rita', 'Olongapo City', 'Scholarship', '2024-03-15', 'Pending', 'uploads/certofindigency/1710264830.png', '2024-03-12 17:33:50', NULL),
(13, '65f093053e103', 31, 'Mallari', 'Rhex Warren', 'Cabrera', 'Filipino', 'Lot 1', 'Capricorn Street', 'Sta. Rita', 'Olongapo City', 'Scholarship', '2024-03-18', 'Pending', 'uploads/certofindigency/1710265093.png', '2024-03-12 17:38:13', NULL),
(14, '65f098d0447c3', 34, 'Turqueza', 'Gerald', 'Gonzales', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Job/Employment', '2024-03-19', 'Pending', 'uploads/certofindigency/1710266576.png', '2024-03-12 18:02:56', NULL),
(15, '65f1616430497', 37, 'Turqueza', 'Brenda', 'Laluan', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Business Establishment', '2024-03-18', 'Pending', 'uploads/certofindigency/1710317924.jpg', '2024-03-13 08:18:44', NULL),
(16, '65f1630a4c4c5', 36, 'Turqueza', 'Rommel', 'Gonzales', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Business Establishment', '2024-03-15', 'Pending', 'uploads/certofindigency/1710318346.png', '2024-03-13 08:25:46', NULL),
(17, '65f163e4b1243', 39, 'Racela', 'Anne Claire', 'Noblado', 'Filipino', '226', 'Manggahan Street', 'Sta. Rita', 'Olongapo City', 'Financial Purposes', '2024-03-15', 'Pending', 'uploads/certofindigency/1710318564.jpg', '2024-03-13 08:29:24', NULL),
(18, '65f16485c60e2', 43, 'Turqueza', 'Trisha Sophia', 'Laluan', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Financial Transaction', '2024-03-14', 'Pending', 'uploads/certofindigency/1710318725.jpg', '2024-03-13 08:32:05', NULL),
(19, '65f1684e992f8', 47, 'Turqueza', 'Charlene', 'Gonzales', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', 'Job/Employment', '2024-03-15', 'Pending', 'uploads/certofindigency/1710319694.jpg', '2024-03-13 08:48:14', NULL),
(20, '65f16b19555ea', 40, 'Duarte', 'Dan', 'Uvas', 'Filipino', '1629', 'Laban Street', 'Sta. Rita', 'Olongapo City', 'Business Establishment', '2024-03-14', 'Pending', 'uploads/certofindigency/1710320409.jpg', '2024-03-13 09:00:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rescert`
--

CREATE TABLE `tbl_rescert` (
  `id_rescert` int(11) NOT NULL,
  `track_id` varchar(15) NOT NULL,
  `id_resident` int(11) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `houseno` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `brgy` varchar(255) NOT NULL,
  `municipal` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `date_live` date NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `form_status` varchar(255) NOT NULL DEFAULT 'Pending',
  `certofres_photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rescert`
--

INSERT INTO `tbl_rescert` (`id_rescert`, `track_id`, `id_resident`, `lname`, `fname`, `mi`, `age`, `nationality`, `houseno`, `street`, `brgy`, `municipal`, `date`, `date_live`, `purpose`, `form_status`, `certofres_photo`, `created_at`, `deleted_at`) VALUES
(10, '65ef498158b43', 23, 'Turqueza', 'Charlene', 'Gonzales', '23', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', '2024-03-13', '2001-07-31', 'Scholarship', 'Approved', 'uploads/certofres/1710180737.jpg', '2024-03-11 18:12:17', NULL),
(11, '65ef4f81ec36a', 23, 'Turqueza', 'Charlene', 'Gonzales', '23', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', '2024-03-14', '2001-07-31', 'Business Establishment', 'Declined', 'uploads/certofres/1710182273.jpg', '2024-03-11 18:37:53', NULL),
(12, '65f07cc0b45d6', 35, 'Turqueza', 'Cynthia', 'Gonzales', '61', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', '2024-03-14', '1990-03-12', 'Job/Employment', 'Pending', 'uploads/certofres/1710259392.jpg', '2024-03-12 16:03:12', NULL),
(13, '65f08d51c3459', 37, 'Turqueza', 'Brenda', 'Laluan', '43', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', '2024-03-19', '2014-03-23', 'Financial Transaction', 'Pending', 'uploads/certofres/1710263633.jpg', '2024-03-12 17:13:53', NULL),
(14, '65f0919dafd08', 34, 'Turqueza', 'Gerald', 'Gonzales', '31', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', '2024-03-15', '1993-03-07', 'Financial Transaction', 'Pending', 'uploads/certofres/1710264733.jpg', '2024-03-12 17:32:13', NULL),
(15, '65f093a7384dd', 39, 'Racela', 'Anne Claire', 'Noblado', '22', 'Filipino', '226', 'Manggahan Street', 'Sta. Rita', 'Olongapo City', '2024-03-14', '2002-03-01', 'Certify that you are living in a certain barangay', 'Pending', 'uploads/certofres/1710265255.jpg', '2024-03-12 17:40:55', NULL),
(16, '65f093db0f659', 43, 'Turqueza', 'Trisha Sophia', 'Laluan', '21', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', '2024-03-15', '2003-08-27', 'Scholarship', 'Pending', 'uploads/certofres/1710265307.jpg', '2024-03-12 17:41:47', NULL),
(17, '65f0990d75426', 31, 'Mallari', 'Rhex Warren', 'Cabrera', '23', 'Filipino', 'Lot 1', 'Capricorn Street', 'Sta. Rita', 'Olongapo City', '2024-03-19', '2001-10-11', 'Certify that you are living in a certain barangay', 'Pending', 'uploads/certofres/1710266637.jpg', '2024-03-12 18:03:57', NULL),
(18, '65f09a8141e2d', 36, 'Turqueza', 'Rommel', 'Gonzales', '37', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', '2024-03-19', '1987-06-26', 'Financial Transaction', 'Pending', 'uploads/certofres/1710267009.jpg', '2024-03-12 18:10:09', NULL),
(19, '65f15bba795e0', 23, 'Turqueza', 'Charlene', 'Gonzales', '23', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', '2024-03-19', '2001-07-31', 'School Requirement', 'Pending', 'uploads/certofres/1710316474.jpg', '2024-03-13 07:54:34', NULL),
(20, '65f15c57a9171', 31, 'Mallari', 'Rhex Warren', 'Cabrera', '23', 'Filipino', 'Lot 1', 'Capricorn Street', 'Sta. Rita', 'Olongapo City', '2024-03-16', '2001-10-11', 'Scholarship', 'Pending', 'uploads/certofres/1710316631.jpg', '2024-03-13 07:57:11', NULL),
(21, '65f15fa7c2b36', 35, 'Turqueza', 'Cynthia', 'Gonzales', '61', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', '2024-03-18', '1990-03-12', 'Financial Transaction', 'Pending', 'uploads/certofres/1710317479.jpg', '2024-03-13 08:11:19', NULL),
(22, '65f1617f2b758', 37, 'Turqueza', 'Brenda', 'Laluan', '43', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', '2024-03-18', '2014-03-23', 'Business Establishment', 'Pending', 'uploads/certofres/1710317951.jpg', '2024-03-13 08:19:11', NULL),
(23, '65f162d3680d3', 36, 'Turqueza', 'Rommel', 'Gonzales', '37', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', '2024-03-18', '1987-06-26', 'Financial Transaction', 'Pending', 'uploads/certofres/1710318291.jpg', '2024-03-13 08:24:51', NULL),
(24, '65f163f8f0b4f', 39, 'Racela', 'Anne Claire', 'Noblado', '22', 'Filipino', '226', 'Manggahan Street', 'Sta. Rita', 'Olongapo City', '2024-03-14', '2002-03-01', 'Registrar Requirement', 'Pending', 'uploads/certofres/1710318584.jpg', '2024-03-13 08:29:44', NULL),
(25, '65f164a58df94', 43, 'Turqueza', 'Trisha Sophia', 'Laluan', '21', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', '2024-03-19', '2003-08-27', 'Scholarship', 'Pending', 'uploads/certofres/1710318757.jpg', '2024-03-13 08:32:37', NULL),
(26, '65f16b405f2a6', 40, 'Duarte', 'Dan', 'Uvas', '22', 'Filipino', '1629', 'Laban Street', 'Sta. Rita', 'Olongapo City', '2024-03-14', '2014-07-12', 'Business Establishment', 'Pending', 'uploads/certofres/1710320448.jpg', '2024-03-13 09:00:48', NULL),
(27, '65f19018c98ac', 23, 'Turqueza', 'Charlene', 'Gonzales', '23', 'Filipino', '1022', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', '2024-03-14', '2001-07-31', 'Job/Employment', 'Pending', 'uploads/certofres/1710329880.jpg', '2024-03-13 11:38:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resident`
--

CREATE TABLE `tbl_resident` (
  `id_resident` int(11) NOT NULL,
  `res_photo` varchar(255) DEFAULT NULL,
  `valid_id_photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_live` date NOT NULL,
  `houseno` varchar(255) DEFAULT NULL,
  `purok` varchar(255) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `brgy` varchar(255) DEFAULT NULL,
  `municipal` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(255) NOT NULL,
  `bdate` date NOT NULL,
  `bplace` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `family_role` varchar(255) NOT NULL,
  `voter` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `verified` varchar(255) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_resident`
--

INSERT INTO `tbl_resident` (`id_resident`, `res_photo`, `valid_id_photo`, `email`, `password`, `lname`, `fname`, `mi`, `age`, `sex`, `status`, `date_live`, `houseno`, `purok`, `street`, `brgy`, `municipal`, `address`, `contact`, `bdate`, `bplace`, `nationality`, `family_role`, `voter`, `role`, `verified`) VALUES
(23, NULL, 'uploads/residents_id/1710178670.jpg', 'charleneturqueza31@gmail.com', '$2y$10$pWy/EzbEr0z05WS30oCPIeSvwOVhP/8hC0bIdOO89t96zXC7mJGEm', 'Turqueza', 'Charlene', 'Gonzales', 23, 'Female', 'Single', '2001-07-31', '1022', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', NULL, '09762866176', '2001-07-31', 'Olongapo', 'Filipino', 'No', 'No', 'resident', 'Yes'),
(26, NULL, 'uploads/residents_id/1710238586.jpg', 'juanmiguelsantos@gmail.com', '$2y$10$gMblOvQ4y3IS1an81NEU7u/ceqCLK37addIHPIHpfK.l7PaWGeazu', 'Santos', 'Juan', 'Miguel', 27, 'Male', 'Single', '1998-07-14', '1022', '3E', 'Sampaguita Road (Left Side from Back of Sta Rita Parish to Corner of Azucena Street)', 'Sta. Rita', 'Olongapo City', NULL, '09474827575', '1997-03-10', 'Olongapo', 'Filipino', 'Yes', 'Yes', 'resident', 'Pending'),
(27, NULL, 'uploads/residents_id/1710241864.png', 'beverlybernardino4@gmail.com', '$2y$10$2xp17g1V3dv1dP4XNVAcoOtqhalxMtPGxvHriw0dPtk3IhRujPzra', 'Bernardino', 'Beverly', 'N/a', 23, 'Female', 'Single', '2024-03-01', '1022', '3C', 'Horseshoe Drive', 'Sta. Rita', 'Olongapo City', NULL, '09946123525', '2001-10-20', 'Old Cabalan', 'Filipino', 'No', 'Yes', 'resident', 'Pending'),
(28, NULL, 'uploads/residents_id/1710241895.png', 'beverlybernardino4@gmail.com', '$2y$10$KoPqtMjoELNWJEPDeTgcS.EFU7rTEn1ClyQAcru9fF2Qnn.FHsqCu', 'Bernardino', 'Beverly', 'N/a', 23, 'Female', 'Single', '2024-03-01', '1022', '3C', 'Horseshoe Drive', 'Sta. Rita', 'Olongapo City', NULL, '09946123525', '2001-10-20', 'Old Cabalan', 'Filipino', 'No', 'Yes', 'resident', 'No'),
(29, NULL, 'uploads/residents_id/1710242036.png', 'rositabernardino@gmail.com', '$2y$10$z3M3fskqQATl0U9UGVJp2ua83p0F2MR.bNf9x7dN8XY5yRFkZwhvC', 'Bernardino', 'Rosita', 'N/a', 50, 'Female', 'Married', '2012-06-12', '55', '3F', 'Libra Street', 'Sta. Rita', 'Olongapo City', NULL, '09846564666', '1974-07-16', 'Old Cabalan', 'Filipino', 'No', 'Yes', 'resident', 'Pending'),
(30, NULL, 'uploads/residents_id/1710242142.jpg', 'pochologopez@gmail.com', '$2y$10$lrPIa.9vpcZpw/GfqWa6lel.URkw5ajMSlLMhLrrrbP83Jrb2DNC6', 'Gopez', 'Pocholo', 'Lagario', 24, 'Male', 'Single', '2001-10-18', '20', '5B', 'Waterdam Road (1672) Balic-Balic Road (From Corner Laban Street to Corner Dominguez Street)', 'Sta. Rita', 'Olongapo City', NULL, '09931564544', '2000-07-05', 'Old Cabalan', 'Filipino', 'No', 'Yes', 'resident', 'Pending'),
(31, NULL, 'uploads/residents_id/1710242313.jpg', 'rhexbusinesses@gmail.com', '$2y$10$hIpso0Rg8QVX8BRd9O6AB.ZkAlOh0xk1khp6499UWCXyXLHAn0tBC', 'Mallari', 'Rhex Warren', 'Cabrera', 23, 'Male', 'Single', '2001-10-11', 'Lot 1', '3F', 'Capricorn Street', 'Sta. Rita', 'Olongapo City', NULL, '09998522133', '2001-10-11', 'Olongapo', 'Filipino', 'No', 'Yes', 'resident', 'Yes'),
(32, NULL, 'uploads/residents_id/1710242428.jpg', 'ianchristopheramorin86@gmail.com', '$2y$10$jECtolhsxyci704VMR2ClOWWH9kueKU8kHKJZxaGaA3OuxjFD4WBq', 'Amorin', 'Ian Christopher', 'Rallos', 31, 'Male', 'Single', '2023-08-04', '1022', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', NULL, '09783961256', '1993-01-17', 'Hilongos', 'Filipino', 'Yes', 'Yes', 'resident', 'Pending'),
(33, NULL, 'uploads/residents_id/1710245744.jpg', 'yashuarsurla@gmail.com', '$2y$10$83ufEeUKGFjumsk.z9fS/Oy7cYw3A0OeN2Xe.BwL5sJ0D86nhjMz.', 'Surla', 'Christian Yashuar', 'Tirona', 23, 'Male', 'Single', '2022-07-29', '1022', '3F', 'Capricorn Street', 'Sta. Rita', 'Olongapo City', NULL, '09959147843', '2001-05-14', 'Olongapo', 'Filipino', 'No', 'Yes', 'resident', 'Pending'),
(34, NULL, 'uploads/residents_id/1710246139.jpg', 'geraldgonzalesturqueza@gmail.com', '$2y$10$tkPzx.en02lG9TyI3hyEdufdzEpV8tVXlno2gUV/y/76s/pzwU9KO', 'Turqueza', 'Gerald', 'Gonzales', 31, 'Male', 'Single', '1993-03-07', '1022', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', NULL, '09760832957', '1993-03-07', 'Olongapo', 'Filipino', 'No', 'Yes', 'resident', 'Yes'),
(35, NULL, 'uploads/residents_id/1710246245.jpg', 'cynthiaturqueza@gmail.com', '$2y$10$POr1fATrkTxIlD9sRs3YgOUTiV2Qtn7j0WdxH.WdCv4sBUMgDavGa', 'Turqueza', 'Cynthia', 'Gonzales', 61, 'Female', 'Widowed', '1990-03-12', '1022', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', NULL, '09995011381', '1963-06-16', 'Cabangan', 'Filipino', 'Yes', 'Yes', 'resident', 'Yes'),
(36, NULL, 'uploads/residents_id/1710246416.jpg', 'rommelgturqueza@gmail.com', '$2y$10$S/lC.0l9rbd.MF0qU8xDVeLF/PDxvwV6pwAI.Vy5.mD6P1FmELUhK', 'Turqueza', 'Rommel', 'Gonzales', 37, 'Male', 'Married', '1987-06-26', '1022', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', NULL, '09999932721', '1987-06-26', 'Olongapo', 'Filipino', 'Yes', 'Yes', 'resident', 'Yes'),
(37, NULL, 'uploads/residents_id/1710246549.jpg', 'brendalturqueza@gmail.com', '$2y$10$CwGkHtzDfdbSqXzJbKN8mOLsNowTpQ.jnQOlGR9e6gfKlVcxAFH5m', 'Turqueza', 'Brenda', 'Laluan', 43, 'Female', 'Married', '2014-03-23', '1022', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', NULL, '09079474702', '1981-12-16', 'Pangasinan', 'Filipino', 'No', 'Yes', 'resident', 'Yes'),
(38, NULL, 'uploads/residents_id/1710246828.jpg', 'canlasronalynmay5@gmail.com', '$2y$10$sq.PO4JewydCtlUYwS58ROD0ubZBaGageGBTWlO9IVZ56f/OEaf/m', 'Canlas', 'Ronalyn May', 'Carpio', 22, 'Female', 'Single', '2002-05-10', '1378', '6B1', 'Part of Tabacuhan Road', 'Sta. Rita', 'Olongapo City', NULL, '09187871562', '2002-05-10', 'Olongapo', 'Filipino', 'No', 'Yes', 'resident', 'Yes'),
(39, NULL, 'uploads/residents_id/1710247149.jpg', 'anneracela23@gmail.com', '$2y$10$TC/x6eb2wuWo0MALhYKRFeLPA2cXmqle1ghx9OBbAsnyzAUyNqaS6', 'Racela', 'Anne Claire', 'Noblado', 22, 'Female', 'Single', '2002-03-01', '226', '1B', 'Manggahan Street', 'Sta. Rita', 'Olongapo City', NULL, '09567820537', '2002-03-01', 'Olongapo', 'Filipino', 'No', 'Yes', 'resident', 'Yes'),
(40, NULL, 'uploads/residents_id/1710247518.jpg', 'danemmanuelduarte14@gmail.com', '$2y$10$haLVELqeWqQe1HHfVz.pw.yzrFITbdsfbpmKVAidw/CzAzVrWRBJe', 'Duarte', 'Dan', 'Uvas', 22, 'Male', 'Single', '2014-07-12', '1629', '5B', 'Laban Street', 'Sta. Rita', 'Olongapo City', NULL, '09989120644', '2002-01-16', 'Olongapo City', 'Filipino', 'Yes', 'Yes', 'resident', 'Yes'),
(41, NULL, 'uploads/residents_id/1710254056.jpeg', 'danemmanuelduarte16@gmail.com', '$2y$10$8PkOaBCcLftdPYUGCLpPq.l8.ju6OQSeOEZ.WGwV7/fAy2rqv7QaC', 'Cleofe', 'Duarte', 'Uvas', 60, 'Female', 'Single', '2014-03-12', '1629', '3A', 'Begonia Street (Right Side from Dizon Junk Shop to Baptist Church)', 'Sta. Rita', 'Olongapo City', NULL, '09989120644', '1964-12-12', 'Roxas Mindoro', 'Filipino', 'Yes', 'Yes', 'resident', 'Pending'),
(42, NULL, 'uploads/residents_id/1710254151.jpeg', 'danemmanuelduarte13@gmail.com', '$2y$10$.n4p9agqyt3QlHx.hPizGuA5LhUH1SL7Olu/BxZvcgvkyz5dkAzeS', 'Duarte', 'Danilo', 'Albiar', 50, 'Male', 'Married', '2014-03-12', '1629', '3A', 'Begonia Street (Right Side from Dizon Junk Shop to Baptist Church)', 'Sta. Rita', 'Olongapo City', NULL, '09989120644', '1974-05-12', 'Olongapo city', 'filipino', 'Yes', 'Yes', 'resident', 'Pending'),
(43, NULL, 'uploads/residents_id/1710254862.jpg', 'trishaturq0827@gmail.com', '$2y$10$Sc5ADdNvWQKuz9CWIra8HupBgUW5Qhh9I8hLTeQHvUh2POrAosBzO', 'Turqueza', 'Trisha Sophia', 'Laluan', 21, 'Female', 'Single', '2003-08-27', '1022', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', NULL, '09811656266', '2003-08-27', 'Baguio', 'Filipino', 'No', 'No', 'resident', 'Yes'),
(44, NULL, 'uploads/residents_id/1710255055.png', 'blessygables09@gmail.com', '$2y$10$.9F3Hvq11IkyIRtoyTtOhONet0PuHVXX6xdvyDrDcbImlPHgHTQJa', 'Turqueza', 'Trisha Sophia', 'Laluan', 23, 'Female', 'Single', '2001-10-09', '70', '3B', 'Filtration Road (Left Side going to Mabayuan)', 'Sta. Rita', 'Olongapo City', NULL, '09770275219', '2001-10-09', 'Olongapo', 'Filipino', 'No', 'Yes', 'resident', 'No'),
(45, NULL, 'uploads/residents_id/1710255569.jpg', 'jrmhmrsgn@gmail.com', '$2y$10$Mok3m7JwZspfYMPMxiFUWO2Pel2h0Z/Wy.pzdfaEiqJaYDxU4ga4G', 'Marasigan ', 'Jeremiah ', 'Milagrosa', 22, 'Male', 'Single', '2008-04-01', '#1227-B Clark St. Sta Rita ', '4C', 'Sta. Rita Road (Left Side)', 'Sta. Rita', 'Olongapo City', NULL, '09089558327', '2002-02-14', 'Olongapo City ', 'Filipino ', 'No', 'Yes', 'resident', 'Yes'),
(46, NULL, 'uploads/residents_id/1710255611.jpg', 'jrmhmrsgn@gmail.com', '$2y$10$/U/tCW3YbpMhnkp0brelFOCu/JXpLF1o8zXh0CRdEFnnnbTpOKORm', 'Marasigan ', 'Jeremiah ', 'Milagrosa', 22, 'Male', 'Single', '2008-04-01', '#1227-B Clark St. Sta Rita ', '4C', 'Sta. Rita Road (Left Side)', 'Sta. Rita', 'Olongapo City', NULL, '09089558327', '2002-02-14', 'Olongapo City ', 'Filipino ', 'No', 'Yes', 'resident', 'Pending'),
(47, NULL, 'uploads/residents_id/1710258687.jpg', 'chaturqz01@gmail.com', '$2y$10$o5BvvQ1r6AOg9mJ/sb5Pfu8uBV198xMq0tQyrxDf1pN0JljrYcnnG', 'Turqueza', 'Charlene', 'Gonzales', 23, 'Female', 'Single', '2001-07-31', '1022', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', NULL, '09762866176', '2001-07-31', 'Olongapo', 'Filipino', 'No', 'No', 'resident', 'Yes'),
(48, NULL, 'uploads/residents_id/1710260581.png', 'blessygables09@gmail.com', '$2y$10$G0PNDB6OOxWaCE18bzyR/OBsCgA7PMbJnGg2RubgkYRBzWFy7KGh6', 'Gabales', 'Blessie', 'Libron', 23, 'Female', 'Single', '2001-10-09', '39', '4D', 'Soriano Street', 'Sta. Rita', 'Olongapo City', NULL, '09770275219', '2001-10-09', 'Olongapo', 'Filipino', 'No', 'Yes', 'resident', 'Pending'),
(49, NULL, 'uploads/residents_id/1710268174.jpeg', 'jerikasoriano@gmail.com', '$2y$10$KO9x7xUi8l2gDC4kYVtLu.SObi5zKF0vgCvQOGOpG/tOlg5z.LBKi', 'Soriano', 'Jerika', 'Cantil', 22, 'Female', 'Single', '2009-03-18', '55', '4B', 'Clark Street', 'Sta. Rita', 'Olongapo City', NULL, '09778902439', '2002-03-11', 'San Marcelino Zambales', 'Filipino', 'No', 'Yes', 'resident', 'Pending'),
(50, NULL, 'uploads/residents_id/1710268314.jpeg', 'jeremysoriano@gmail.com', '$2y$10$6se8F8gj1sm1j7n4EfmnkuFHScXEt5MJ61Bux9YGOBEtV1CyjrF1y', 'Soriano', 'Jeremy', 'Cantil', 29, 'Female', 'Single', '2007-02-22', '35', '1A', 'Santolan Extension', 'Sta. Rita', 'Olongapo City', NULL, '09661324528', '1995-05-31', 'San Marcelino Zambales', 'Filipino', 'No', 'Yes', 'resident', 'Pending'),
(51, NULL, 'uploads/residents_id/1710268454.jpeg', 'joiemarisoriano@gmail.com', '$2y$10$j2BgeEJliSfbURMt6K1D9u3pI5q4TOEyUeBfGT9u4NAmRLn0FIPw.', 'Valdez', 'Joemari', 'Soriano', 31, 'Female', 'Married', '2000-07-13', '20', '2', 'Sta. Rita Road (One Way)', 'Sta. Rita', 'Olongapo City', NULL, '09881352796', '1993-05-31', 'San Marcelino Zambales', 'Filipino', 'No', 'Yes', 'resident', 'Pending'),
(52, NULL, 'uploads/residents_id/1710268595.jpeg', 'anniesoriano@gmail.com', '$2y$10$6zIvzTbbSdBg0xmrb3Lek.Tk0ge71wJZ4kNHc7wAm0gNZjGNXNKqy', 'Cantil ', 'Marianne', 'Soriano', 66, 'Female', 'Married', '1952-03-28', '5', '6C1', 'From 1466 Julo Tabacuhan to 1480 Julo Tabacuhan', 'Sta. Rita', 'Olongapo City', NULL, '09885563236', '1958-11-29', 'San Marcelino Zambales', 'Filipino', 'No', 'Yes', 'resident', 'Pending'),
(53, NULL, 'uploads/residents_id/1710268762.jpeg', 'mariacantil@gmail.com', '$2y$10$Tb7Gm/A3MTqrNqbMgqAkTuUJoimm2tHXqvrPe5zKm9qoqijqQCw6.', 'Cantil ', 'Maria', 'Manglicmot', 56, 'Female', 'Widowed', '1973-11-23', '1', '6AEXT', 'Delrosario Street', 'Sta. Rita', 'Olongapo City', NULL, '09742159463', '1968-11-26', 'San Marcelino Zambales', 'Filipino', 'No', 'Yes', 'resident', 'Pending'),
(54, NULL, 'uploads/residents_id/1710311442.jpeg', 'daniloduarte1974@gmail.com', '$2y$10$rnpT0/zZYNWY/FrztXPZNODbYV5Oq5uLM9xyWVhehlwcNx01nBOEa', 'Duarte', 'Danilo', 'Albiar', 50, 'Male', 'Married', '2014-03-13', '1628', '3B', 'Filtration Road (Left Side going to Mabayuan)', 'Sta. Rita', 'Olongapo City', NULL, '09321003621', '1974-05-09', 'Mahaplag Leyte', 'Filipino', 'Yes', 'Yes', 'resident', 'Pending'),
(55, NULL, 'uploads/residents_id/1710311625.jpeg', 'cleofeduarte1964@gmail.com', '$2y$10$bgVT8RHQ9lSDZbvws1pYtOcDnzLJ350uRjBVgv.buxg9D7l4tbbum', 'Duarte', 'Cleofe', 'Sanisit', 60, 'Female', 'Married', '2014-03-13', '1629', '2', 'Sta. Rita Road (One Way)', 'Sta. Rita', 'Olongapo City', NULL, '09215472359', '1964-08-09', 'Roxas Mindoro', 'Filipino', 'No', 'Yes', 'resident', 'Pending'),
(56, NULL, 'uploads/residents_id/1710317719.jpg', 'matthewigonia09@gmail.com', '$2y$10$/lkldNO0fhSPG7KX20GKde5WhDDHZolTMupNRqv79qKvVfbaPl0aO', 'Igonia', 'Matthew James', 'Franco', 22, 'Male', 'Single', '2017-05-07', '46', '2', 'Cabling Street', 'Sta. Rita', 'Olongapo City', NULL, '09670143889', '2002-09-10', 'San Marcelino', 'Filipino', 'No', 'No', 'resident', 'Pending'),
(57, NULL, 'uploads/residents_id/1710317719.jpg', 'matthewigonia09@gmail.com', '$2y$10$DuAnrLjh2Ix61ptBJFd2y.75kjL6tqU4oG47q92IUAL/LaZDoP4Lm', 'Igonia', 'Matthew James', 'Franco', 22, 'Male', 'Single', '2017-05-07', '46', '2', 'Cabling Street', 'Sta. Rita', 'Olongapo City', NULL, '09670143889', '2002-09-10', 'San Marcelino', 'Filipino', 'No', 'No', 'resident', 'Pending'),
(58, NULL, 'uploads/residents_id/1710326879.jpg', 'charleneturqueza31@gmail.com', '$2y$10$WPNziLA3Og8XEKsuufQspO0WFEQX.aFhXSyeq3n8Oz7Nsukxz1hxq', 'Turqueza', 'Charlene', 'Gonzales', 23, 'Female', 'Single', '2001-07-31', '1022', '3F', 'Jasmin Street', 'Sta. Rita', 'Olongapo City', NULL, '09762866176', '2001-07-31', 'Olongapo', 'Filipino', 'No', 'No', 'resident', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mi` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `addedby` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  ADD PRIMARY KEY (`id_announcement`);

--
-- Indexes for table `tbl_blotter`
--
ALTER TABLE `tbl_blotter`
  ADD PRIMARY KEY (`id_blotter`);

--
-- Indexes for table `tbl_brgyid`
--
ALTER TABLE `tbl_brgyid`
  ADD PRIMARY KEY (`id_brgyid`);

--
-- Indexes for table `tbl_bspermit`
--
ALTER TABLE `tbl_bspermit`
  ADD PRIMARY KEY (`id_bspermit`);

--
-- Indexes for table `tbl_clearance`
--
ALTER TABLE `tbl_clearance`
  ADD PRIMARY KEY (`id_clearance`);

--
-- Indexes for table `tbl_indigency`
--
ALTER TABLE `tbl_indigency`
  ADD PRIMARY KEY (`id_indigency`);

--
-- Indexes for table `tbl_rescert`
--
ALTER TABLE `tbl_rescert`
  ADD PRIMARY KEY (`id_rescert`);

--
-- Indexes for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  ADD PRIMARY KEY (`id_resident`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_announcement`
--
ALTER TABLE `tbl_announcement`
  MODIFY `id_announcement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_blotter`
--
ALTER TABLE `tbl_blotter`
  MODIFY `id_blotter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_brgyid`
--
ALTER TABLE `tbl_brgyid`
  MODIFY `id_brgyid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_bspermit`
--
ALTER TABLE `tbl_bspermit`
  MODIFY `id_bspermit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_clearance`
--
ALTER TABLE `tbl_clearance`
  MODIFY `id_clearance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_indigency`
--
ALTER TABLE `tbl_indigency`
  MODIFY `id_indigency` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_rescert`
--
ALTER TABLE `tbl_rescert`
  MODIFY `id_rescert` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_resident`
--
ALTER TABLE `tbl_resident`
  MODIFY `id_resident` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
