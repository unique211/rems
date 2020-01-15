-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2020 at 02:01 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rems`
--
CREATE DATABASE IF NOT EXISTS `rems` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rems`;

-- --------------------------------------------------------

--
-- Table structure for table `agent_commision_master`
--

CREATE TABLE `agent_commision_master` (
  `id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `ploats_id` int(11) NOT NULL,
  `amtinfo` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `openingbalance` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent_commision_master`
--

INSERT INTO `agent_commision_master` (`id`, `agent_id`, `site_id`, `ploats_id`, `amtinfo`, `amount`, `status`, `user_id`, `created_at`, `updated_at`, `openingbalance`) VALUES
(1, 1, 3, 5, 'cr', '100.00', 1, 1, '2020-01-14 23:16:22', '2020-01-14 23:16:22', '0.00'),
(2, 1, 3, 5, 'dr', '30.00', 1, 1, '2020-01-15 07:04:22', '2020-01-15 01:34:22', '100.00'),
(4, 1, 3, 5, 'dr', '30.00', 1, 1, '2020-01-15 01:26:07', '2020-01-15 01:26:07', '120.00'),
(5, 1, 3, 5, 'cr', '50.00', 1, 1, '2020-01-15 07:09:10', '2020-01-15 01:39:10', '40.00');

-- --------------------------------------------------------

--
-- Table structure for table `menu_master`
--

CREATE TABLE `menu_master` (
  `menu_id` int(11) NOT NULL,
  `menuname` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_master`
--

INSERT INTO `menu_master` (`menu_id`, `menuname`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dashboard', 1, '2020-01-15 10:48:06', '0000-00-00 00:00:00'),
(2, 'MASTER', 1, '2020-01-15 10:47:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_master`
--

CREATE TABLE `role_master` (
  `id` int(11) NOT NULL,
  `rolename` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_master`
--

INSERT INTO `role_master` (`id`, `rolename`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, 1, '2020-01-15 05:25:21', '2020-01-15 05:25:21'),
(2, 'user', 1, 1, '2020-01-15 05:43:03', '2020-01-15 05:43:03');

-- --------------------------------------------------------

--
-- Table structure for table `submenu_master`
--

CREATE TABLE `submenu_master` (
  `submenu_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `submenuname` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submenu_master`
--

INSERT INTO `submenu_master` (`submenu_id`, `menu_id`, `submenuname`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'Customer', 1, '2020-01-15 10:46:59', '0000-00-00 00:00:00'),
(2, 2, 'Agent', 1, '2020-01-15 10:47:07', '0000-00-00 00:00:00'),
(3, 2, 'Site Master', 1, '2020-01-15 10:47:11', '0000-00-00 00:00:00'),
(4, 2, 'Plot Allocation', 1, '2020-01-15 10:47:14', '0000-00-00 00:00:00'),
(5, 2, 'Agent Commission', 1, '2020-01-15 10:47:17', '0000-00-00 00:00:00'),
(6, 2, 'Employee', 1, '2020-01-15 10:47:19', '0000-00-00 00:00:00'),
(7, 2, 'Right Management', 1, '2020-01-15 10:47:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_permission`
--

CREATE TABLE `user_permission` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `menuid` int(11) NOT NULL,
  `submenuid` int(11) NOT NULL,
  `viewright` int(11) NOT NULL,
  `createright` int(11) NOT NULL,
  `editright` int(11) NOT NULL,
  `deleteright` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_permission`
--

INSERT INTO `user_permission` (`id`, `uid`, `menuid`, `submenuid`, `viewright`, `createright`, `editright`, `deleteright`, `status`) VALUES
(219, 2, 1, 0, 1, 1, 0, 0, 1),
(220, 2, 1, 1, 0, 0, 0, 0, 1),
(221, 2, 2, 0, 0, 0, 0, 0, 1),
(222, 2, 2, 1, 0, 0, 0, 0, 1),
(223, 2, 2, 2, 0, 0, 0, 0, 1),
(224, 2, 2, 3, 1, 0, 1, 0, 1),
(225, 2, 2, 4, 1, 0, 1, 0, 1),
(226, 2, 2, 5, 1, 0, 1, 0, 1),
(227, 2, 2, 6, 1, 0, 1, 0, 1),
(228, 2, 2, 7, 1, 1, 1, 1, 1),
(229, 1, 1, 0, 1, 0, 1, 1, 1),
(230, 1, 1, 1, 1, 0, 1, 1, 1),
(231, 1, 2, 0, 0, 0, 0, 0, 1),
(232, 1, 2, 1, 1, 0, 1, 1, 1),
(233, 1, 2, 2, 1, 1, 1, 1, 1),
(234, 1, 2, 3, 1, 1, 0, 0, 1),
(235, 1, 2, 4, 1, 1, 0, 0, 1),
(236, 1, 2, 5, 1, 1, 0, 0, 1),
(237, 1, 2, 6, 1, 1, 0, 0, 1),
(238, 1, 2, 7, 1, 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent_commision_master`
--
ALTER TABLE `agent_commision_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_master`
--
ALTER TABLE `menu_master`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `role_master`
--
ALTER TABLE `role_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenu_master`
--
ALTER TABLE `submenu_master`
  ADD PRIMARY KEY (`submenu_id`);

--
-- Indexes for table `user_permission`
--
ALTER TABLE `user_permission`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent_commision_master`
--
ALTER TABLE `agent_commision_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu_master`
--
ALTER TABLE `menu_master`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_master`
--
ALTER TABLE `role_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `submenu_master`
--
ALTER TABLE `submenu_master`
  MODIFY `submenu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_permission`
--
ALTER TABLE `user_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
