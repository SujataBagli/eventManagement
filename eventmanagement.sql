-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 08:55 PM
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
-- Database: `eventmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `eventDate` datetime DEFAULT NULL,
  `eventTime` time DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedOn` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `tbl_events`
--

TRUNCATE TABLE `tbl_events`;
--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`id`, `userId`, `title`, `description`, `eventDate`, `eventTime`, `image`, `created_at`, `updatedOn`, `active`, `deleted`) VALUES
(1, 1, 'Sports Day', 'The beggiest event ', '2024-08-30 22:20:41', '22:20:41', 'uploads/Screenshot 2024-08-18 114925.png', '2024-08-30 17:00:23', '2024-08-30 17:00:23', 1, 0),
(2, 2, 'Annual Day', 'The Annual event ', '2024-12-30 22:20:41', '22:20:00', 'uploads/Screenshot 2024-08-18 114925.png', '2024-08-30 17:01:11', '2024-08-30 17:01:11', 1, 0),
(3, 1, 'Party Day', 'The Party event ', '2024-06-08 22:20:41', '20:20:00', 'uploads/Screenshot 2024-08-18 114925.png', '2024-08-30 17:04:03', '2024-08-30 17:04:03', 1, 0),
(4, 2, 'Picnic Day', 'The Picnic event ', '2024-06-08 22:20:41', '20:20:00', 'uploads/Screenshot 2024-08-18 114925.png', '2024-08-30 17:10:30', '2024-08-30 17:10:30', 1, 0),
(5, 1, 'Picnic Day', 'The Picnic event ', '2024-06-08 22:20:41', '20:20:00', 'uploads/Screenshot 2024-08-18 114925.png', '2024-08-31 04:40:18', '2024-08-31 04:40:18', 1, 0),
(6, 1, 'Picnic Day', 'The Picnic event ', '2024-06-08 22:20:41', '20:20:00', 'uploads/Screenshot 2024-08-18 114925.png', '2024-08-31 04:54:09', '2024-08-31 04:54:09', 1, 0),
(7, 0, 'This is test', 'Test description is big and valid .', '2024-10-03 00:00:00', '14:35:00', 'uploads/Screenshot 2024-08-18 114925.png', '2024-08-31 05:02:03', '2024-08-31 05:02:03', 1, 0),
(8, 0, 'This is test', 'Test description is big and valid .', '2024-10-03 00:00:00', '14:35:00', 'uploads/Screenshot 2024-08-18 114925.png', '2024-08-31 05:02:03', '2024-08-31 05:02:03', 1, 0),
(9, 1, 'This is test', 'Test description is big and valid .', '2024-10-03 00:00:00', '14:35:00', 'uploads/Screenshot 2024-08-18 114925.png', '2024-08-31 05:02:31', '2024-08-31 05:02:31', 1, 0),
(10, 1, 'This is test', 'Test description is big and valid .', '2024-10-03 00:00:00', '14:35:00', 'uploads/Screenshot 2024-08-18 114925.png', '2024-08-31 05:02:31', '2024-08-31 05:02:31', 1, 0),
(11, 1, 'tt', 'srg', '2024-08-22 00:00:00', '12:36:00', 'uploads/Screenshot 2024-08-18 114651.png', '2024-08-31 05:05:05', '2024-08-31 05:05:05', 1, 0),
(17, 1, '1', '1', '2024-09-11 00:00:00', '20:58:00', '', '2024-08-31 11:28:32', '2024-08-31 11:28:32', 1, 0),
(18, 1, '2', '2', '2024-09-20 00:00:00', '19:01:00', 'uploads/Screenshot 2024-08-18 115139.png', '2024-08-31 11:30:41', '2024-08-31 11:30:41', 1, 0),
(19, 7, 'school', 'school', '2024-09-20 00:00:00', '21:05:00', 'uploads/Screenshot 2024-08-30 190201.png', '2024-08-31 13:35:48', '2024-08-31 13:35:48', 1, 0),
(20, 7, '3', '3', '2024-09-05 00:00:00', '21:49:00', 'uploads/Screenshot 2024-08-30 190201.png', '2024-08-31 14:19:13', '2024-08-31 14:19:13', 1, 0),
(21, 13, 'PP', 'PP', '2024-08-30 00:00:00', '00:00:00', '', '2024-08-31 15:31:13', '2024-08-31 15:31:13', 1, 0),
(22, 13, 'PP', 'PP', '2024-08-30 00:00:00', '00:00:00', '', '2024-08-31 15:31:13', '2024-08-31 15:31:13', 1, 0),
(23, 13, 'P', 'P', '2024-09-27 00:00:00', '23:03:00', 'uploads/Screenshot 2024-08-11 224925.png', '2024-08-31 15:33:16', '2024-08-31 15:33:16', 1, 0),
(24, 13, 'P', 'P', '2024-09-27 00:00:00', '23:03:00', 'uploads/Screenshot 2024-08-11 224925.png', '2024-08-31 15:33:16', '2024-08-31 15:33:16', 1, 0),
(25, 13, 'P', 'P', '2024-09-27 00:00:00', '23:03:00', 'uploads/Screenshot 2024-08-11 224925.png', '2024-08-31 15:35:59', '2024-08-31 15:35:59', 1, 0),
(26, 13, 'P', 'P', '2024-09-27 00:00:00', '23:03:00', 'uploads/Screenshot 2024-08-11 224925.png', '2024-08-31 15:35:59', '2024-08-31 15:35:59', 1, 0),
(27, 13, 'CC', 'V', '2024-09-06 00:00:00', '21:11:00', 'uploads/Screenshot 2024-08-03 180432.png', '2024-08-31 15:37:25', '2024-08-31 15:37:25', 1, 0),
(28, 13, 'CC', 'V', '2024-09-06 00:00:00', '21:11:00', 'uploads/Screenshot 2024-08-03 180432.png', '2024-08-31 15:37:25', '2024-08-31 15:37:25', 1, 0),
(29, 13, 'hh', 'hh', '2024-10-03 00:00:00', '01:09:00', 'uploads/Screenshot 2024-08-18 115139.png', '2024-08-31 15:40:00', '2024-08-31 15:40:00', 1, 0),
(30, 13, 'hh', 'hh', '2024-10-03 00:00:00', '01:09:00', 'uploads/Screenshot 2024-08-18 115139.png', '2024-08-31 15:40:00', '2024-08-31 15:40:00', 1, 0),
(31, 13, 'BB', 'BB', '2024-09-19 00:00:00', '16:11:00', 'uploads/Screenshot 2024-08-18 114925.png', '2024-08-31 15:41:55', '2024-08-31 15:41:55', 1, 0),
(32, 13, 'BB', 'BB', '2024-09-19 00:00:00', '16:11:00', 'uploads/Screenshot 2024-08-18 114925.png', '2024-08-31 15:41:55', '2024-08-31 15:41:55', 1, 0),
(33, 13, 'SS', 'ss', '2024-10-02 00:00:00', '01:16:00', 'uploads/Screenshot 2024-08-18 115139.png', '2024-08-31 15:47:08', '2024-08-31 15:47:08', 1, 0),
(34, 13, 'YY', 'Y', '2024-09-07 00:00:00', '01:20:00', 'uploads/Screenshot 2024-08-30 190201.png', '2024-08-31 15:50:35', '2024-08-31 15:50:35', 1, 0),
(35, 13, 'GG', 'TY', '2024-08-29 00:00:00', '01:21:00', '', '2024-08-31 15:51:22', '2024-08-31 15:51:22', 1, 0),
(36, 13, 'hh', 'hh', '2024-08-28 00:00:00', '01:22:00', 'uploads/Screenshot 2024-08-11 224925.png', '2024-08-31 15:52:43', '2024-08-31 15:52:43', 1, 0),
(37, 13, 'hh', 'hh', '2024-09-05 00:00:00', '02:22:00', 'uploads/Screenshot 2024-08-18 114925.png', '2024-08-31 15:53:07', '2024-08-31 15:53:07', 1, 0),
(38, 13, 'y', 'h', '2024-09-06 00:00:00', '03:25:00', '', '2024-08-31 15:55:27', '2024-08-31 15:55:27', 1, 0),
(39, 13, 's', 's', '2024-09-06 00:00:00', '01:26:00', 'uploads/Screenshot 2024-08-11 224925.png', '2024-08-31 15:56:14', '2024-08-31 15:56:14', 1, 0),
(40, 0, 's', 'h', '2024-09-06 00:00:00', '01:26:00', '', '2024-08-31 16:41:37', '2024-08-31 16:41:37', 1, 1),
(41, 0, 's', 'hh', '2024-09-06 00:00:00', '01:26:00', '', '2024-08-31 16:43:53', '2024-08-31 16:43:53', 1, 1),
(42, 0, 's', 'dd', '2024-09-06 00:00:00', '01:26:00', '', '2024-08-31 16:45:30', '2024-08-31 16:45:30', 1, 1),
(43, 0, 's', 'kk', '2024-09-06 00:00:00', '01:26:00', '', '2024-08-31 16:46:19', '2024-08-31 16:46:19', 1, 1),
(44, 6, 'nt', 'ty', '2024-08-13 00:00:00', '03:41:00', 'uploads/Screenshot 2024-08-30 190201.png', '2024-08-31 18:07:11', '2024-08-31 18:07:11', 1, 0),
(45, 6, 'gg', 'gg', '2024-08-21 00:00:00', '03:39:00', 'uploads/Screenshot 2024-08-18 115139.png', '2024-08-31 18:09:09', '2024-08-31 18:09:09', 1, 0),
(46, 6, 'ok', 'ok', '2024-09-20 00:00:00', '04:53:00', 'uploads/Screenshot 2024-08-30 190201.png', '2024-08-31 18:23:37', '2024-08-31 18:23:37', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `type` enum('ADM','GEN') NOT NULL DEFAULT 'GEN',
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `tbl_users`
--

TRUNCATE TABLE `tbl_users`;
--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `email`, `type`, `password`, `created_at`, `active`, `deleted`) VALUES
(1, 'suja', 'siy@gmail.com', 'GEN', '$2y$10$0h1DZjWm.KrmFe1/bFPnP.ye1LrpxctOeszSjT81DwVW7KlBdN1U6', '2024-08-30 11:24:56', 1, 0),
(2, 'sujata', 'suja@gmail.com', 'GEN', '$2y$10$jCmb8.9JSS7v27dDtd9WV.FEB6ICEyHYiRHtoEB.7FsWrk/j6NzDO', '2024-08-30 11:26:04', 1, 0),
(3, 'gauresh', 'g@ghaj.com', 'GEN', '$2y$10$N8MqBwaw.y2aCTtlOTRzQuJUCNzs3P5wdvF83pSVesQG7vwDiKzPy', '2024-08-30 11:45:08', 1, 0),
(4, 'Gauresh', 'g@ghdaj.com', 'GEN', '$2y$10$LAn6jzKgnpw1IYso.VT5eeByhKzxkk12RbPBb6U1geaIc8LRb9ema', '2024-08-30 11:50:07', 1, 0),
(5, 'sujaa', 'sujaa@gmail.com', 'GEN', '$2y$10$wQWY9gDIcBuOmQ9sKAV4weN3jCHwzktkrMoxnOv7XK8UXg.oCGN8y', '2024-08-30 12:05:45', 1, 0),
(6, 'SB', 'SB@gmail.com', 'GEN', '$2y$10$WknigwQdQRwxWLrJMvPnMelIqRoqS0P4oeac0OVVtjG0LaQCOaRDi', '2024-08-30 12:09:13', 1, 0),
(7, 'GB', 'GB@gmail.com', 'ADM', '$2y$10$RzeReNuJr1lgnV2YVH1p2Oj6e/dZOM1p8ABc6JhfZXiXFt37xsOfy', '2024-08-30 12:10:09', 1, 0),
(9, 'ASD', 'asd@gmail.com', 'GEN', '$2y$10$Qu2IS.L5n83PiUsWdsEW5ePvWbGDqgbGTZbm4XcirfHxNI.nW2DBq', '2024-08-30 14:25:45', 1, 0),
(10, 'TT', 'TT@gmail.com', 'GEN', '$2y$10$kBHUvwQbpzFxJMSG5GzfaOiN0uLX.yX9U3CbOwe/EUhe0LDg6/.PS', '2024-08-31 14:42:43', 1, 0),
(11, 'YY', 'YY@gmail.com', 'GEN', '$2y$10$4aucWLnPdQ9cqLcoz.VbSeH4c45dBeQeN30v1UvLAVvSfK97QlBhK', '2024-08-31 14:56:23', 1, 0),
(12, 'AA', 'AA@gmail.com', 'GEN', '$2y$10$/TE7pEy53mQ2cgl8rt7k3u1ZJfhVgUMwtPsBMLbvO8d7dGYTMrg9i', '2024-08-31 15:26:17', 1, 0),
(13, 'PP', 'PP@gmail.com', 'GEN', '$2y$10$zQ1hHxf7R/CdtxCwFhDB8eaa1Ht6DGx07Esh0wakcGdBUMzVcKjgS', '2024-08-31 15:30:39', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`),
  ADD KEY `eventDate` (`eventDate`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
