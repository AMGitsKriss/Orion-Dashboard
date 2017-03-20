-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2017 at 04:24 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orion_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `linkaggregator`
--

CREATE TABLE `linkaggregator` (
  `id` int(3) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IP` varchar(15) NOT NULL DEFAULT '0.0.0.0',
  `name` varchar(255) NOT NULL,
  `url` varchar(300) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `public` tinyint(1) NOT NULL DEFAULT '0',
  `hash` varchar(4) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `map_shortcuts`
--

CREATE TABLE `map_shortcuts` (
  `name` varchar(20) NOT NULL,
  `x_pos` int(4) NOT NULL,
  `z_pos` int(4) NOT NULL,
  `zoom` varchar(3) NOT NULL,
  `display_order` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mc_username` varchar(255) NOT NULL,
  `mc_avatar` varchar(255) NOT NULL,
  `privilage` int(1) NOT NULL DEFAULT '0',
  `account_approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `linkaggregator`
--
ALTER TABLE `linkaggregator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map_shortcuts`
--
ALTER TABLE `map_shortcuts`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `linkaggregator`
--
ALTER TABLE `linkaggregator`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=296;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
