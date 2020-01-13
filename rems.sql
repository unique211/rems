-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 13, 2020 at 01:50 PM
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
-- Table structure for table `agent_master`
--

CREATE TABLE `agent_master` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `contry` varchar(50) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `bankname` varchar(50) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `account_no` varchar(30) NOT NULL,
  `ifsc_code` varchar(20) NOT NULL,
  `account_holder_name` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `profilepicture` varchar(255) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `agent_master`
--

INSERT INTO `agent_master` (`id`, `first_name`, `last_name`, `email`, `city`, `state`, `contry`, `pincode`, `bankname`, `branch_name`, `account_no`, `ifsc_code`, `account_holder_name`, `status`, `profilepicture`, `userid`, `created_at`, `updated_at`) VALUES
(1, 'agent 1', 'agent', 'agent@gmail.com', 'rajkot', 'gujrat', 'India', '360020', 'bank of india', 'branch 1', 'ac1000', '1234', 'agent 1', 1, '5e1c05456e213_1578894661.png', 1, '2020-01-13 05:51:03', '2020-01-13 00:21:03'),
(3, 'agent 2', 'agent', 'agent2@gmail.com', 'rajkot', 'gujrat', 'india', '360020', 'bank of india', 'branch 1', '1010', '15', 'a', 1, '5e1c5ee4c74c9_1578917604.png', 1, '2020-01-13 06:44:13', '2020-01-13 06:44:13');

-- --------------------------------------------------------

--
-- Table structure for table `customer_master`
--

CREATE TABLE `customer_master` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `contry` varchar(50) NOT NULL,
  `pincode` decimal(10,0) NOT NULL,
  `relativename` varchar(100) NOT NULL,
  `mobileno` decimal(10,0) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `cust_profile` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_master`
--

INSERT INTO `customer_master` (`id`, `first_name`, `last_name`, `email`, `city`, `state`, `contry`, `pincode`, `relativename`, `mobileno`, `address`, `status`, `cust_profile`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'customer1', 'cust', 'cust@gmail.com', 'rajkot', 'gujrat', 'india', '360020', 'r1', '9632587410', 'rajkot', 1, '5e1c0ef8bbce3_1578897144.png', 1, '2020-01-13 06:32:27', '2020-01-13 01:02:27');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment`
--

CREATE TABLE `customer_payment` (
  `id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `p_a_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_mode` varchar(30) NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `branch_name` varchar(100) DEFAULT NULL,
  `cheque_no` varchar(30) DEFAULT NULL,
  `c_date` date DEFAULT NULL,
  `account_no` varchar(50) DEFAULT NULL,
  `transaction_note` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_payment`
--

INSERT INTO `customer_payment` (`id`, `c_id`, `p_a_id`, `amount`, `payment_mode`, `remark`, `bank_name`, `branch_name`, `cheque_no`, `c_date`, `account_no`, `transaction_note`, `user_id`, `create_at`) VALUES
(1, 1, 1, '122.00', 'Cash', 'sdsad', NULL, NULL, NULL, '2020-01-13', NULL, NULL, 1, '2020-01-13 09:29:13'),
(2, 1, 1, '20.00', 'Cash', 'sadsd', NULL, NULL, NULL, '2020-01-13', NULL, NULL, 1, '2020-01-13 10:38:35'),
(3, 1, 1, '20.00', 'Cash', 'sadsd', NULL, NULL, NULL, '2020-01-13', NULL, NULL, 1, '2020-01-13 10:38:38'),
(4, 1, 1, '20.00', 'Cash', 'sadsd', NULL, NULL, NULL, '2020-01-13', NULL, NULL, 1, '2020-01-13 10:38:43'),
(5, 1, 1, '50.00', 'Cheque', 'sdsa', 'bank of india', 'branch 1', '12212', '2020-01-13', '122', NULL, 1, '2020-01-13 10:39:39'),
(6, 1, 1, '150.00', 'Cash', 'as', NULL, NULL, NULL, '2020-01-13', NULL, NULL, 1, '2020-01-13 10:43:50'),
(7, 1, 2, '10.00', 'Cash', 'cds', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-01-13 12:16:26'),
(8, 1, 2, '12.00', 'Cash', 'asds', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2020-01-13 12:16:39');

-- --------------------------------------------------------

--
-- Table structure for table `customrt_doc`
--

CREATE TABLE `customrt_doc` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_doc` varchar(30) NOT NULL,
  `file` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customrt_doc`
--

INSERT INTO `customrt_doc` (`id`, `customer_id`, `customer_doc`, `file`) VALUES
(14, 1, 'Pancard', '5e19be2024225_1578745376.png'),
(15, 1, 'AdharCard', '5e19c3df33d4b_1578746847.png');

-- --------------------------------------------------------

--
-- Table structure for table `employ_master`
--

CREATE TABLE `employ_master` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile_no` decimal(10,0) NOT NULL,
  `profile_pic` varchar(255) DEFAULT NULL,
  `role` varchar(30) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employ_master`
--

INSERT INTO `employ_master` (`id`, `firstname`, `last_name`, `email`, `mobile_no`, `profile_pic`, `role`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'sagar12', 'moa', 'sad@gmail.com', '12123333', '5e1c5862e3ebd_1578915938.png', '1', 1, 1, '2020-01-13 12:10:36', '2020-01-13 06:40:36');

-- --------------------------------------------------------

--
-- Table structure for table `login_master`
--

CREATE TABLE `login_master` (
  `id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_master`
--

INSERT INTO `login_master` (`id`, `e_id`, `user_name`, `password`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 'sagar12', 'MjAyY2I5NjJhYzU5MDc1Yjk2NGIwNzE1MmQyMzRiNzA=', '1', 1, '2020-01-13 12:10:28', '2020-01-13 06:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `ploaalocation_master`
--

CREATE TABLE `ploaalocation_master` (
  `id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL,
  `ploat_id` int(11) NOT NULL,
  `amt` decimal(10,2) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ploaalocation_master`
--

INSERT INTO `ploaalocation_master` (`id`, `c_id`, `s_id`, `ploat_id`, `amt`, `agent_id`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 4, '1120.00', 0, 1, 1, '2020-01-13 03:59:13', '2020-01-13 03:59:13'),
(2, 1, 3, 5, '100.00', 1, 1, 1, '2020-01-13 06:46:26', '2020-01-13 06:46:26');

-- --------------------------------------------------------

--
-- Table structure for table `plot_detalis`
--

CREATE TABLE `plot_detalis` (
  `id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `plots_no` varchar(20) NOT NULL,
  `area_insqft` decimal(10,0) NOT NULL,
  `cost` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plot_detalis`
--

INSERT INTO `plot_detalis` (`id`, `site_id`, `plots_no`, `area_insqft`, `cost`) VALUES
(4, 3, 'plaot3', '45', '1120.00'),
(5, 3, 'plots2', '3012', '100.00'),
(6, 3, 'plots3', '40', '120.00');

-- --------------------------------------------------------

--
-- Table structure for table `site_master`
--

CREATE TABLE `site_master` (
  `id` int(11) NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `area_name` varchar(100) NOT NULL,
  `total_ploat` decimal(10,0) NOT NULL,
  `total_areaof_ploats` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_master`
--

INSERT INTO `site_master` (`id`, `site_name`, `area_name`, `total_ploat`, `total_areaof_ploats`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'site1', 'arae1', '3', '3097.00', 1, 1, '2020-01-13 05:24:43', '2020-01-12 23:54:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent_master`
--
ALTER TABLE `agent_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_master`
--
ALTER TABLE `customer_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_payment`
--
ALTER TABLE `customer_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customrt_doc`
--
ALTER TABLE `customrt_doc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employ_master`
--
ALTER TABLE `employ_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_master`
--
ALTER TABLE `login_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ploaalocation_master`
--
ALTER TABLE `ploaalocation_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plot_detalis`
--
ALTER TABLE `plot_detalis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_master`
--
ALTER TABLE `site_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent_master`
--
ALTER TABLE `agent_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_master`
--
ALTER TABLE `customer_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_payment`
--
ALTER TABLE `customer_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customrt_doc`
--
ALTER TABLE `customrt_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `employ_master`
--
ALTER TABLE `employ_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_master`
--
ALTER TABLE `login_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ploaalocation_master`
--
ALTER TABLE `ploaalocation_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plot_detalis`
--
ALTER TABLE `plot_detalis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `site_master`
--
ALTER TABLE `site_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
