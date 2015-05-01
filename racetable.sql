-- phpMyAdmin SQL Dump
-- version 4.3.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 01, 2015 at 10:22 AM
-- Server version: 5.5.41-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `havocserver`
--

-- --------------------------------------------------------

--
-- Table structure for table `races`
--

CREATE TABLE IF NOT EXISTS `races` (
  `id` int(10) unsigned NOT NULL,
  `vehicle` smallint(5) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `world` int(11) NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `race_cps`
--

CREATE TABLE IF NOT EXISTS `race_cps` (
  `id` int(10) unsigned NOT NULL,
  `seq` tinyint(3) unsigned NOT NULL,
  `xpos` float(14,4) NOT NULL,
  `ypos` float(14,4) NOT NULL,
  `zpos` float(14,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `race_records`
--

CREATE TABLE IF NOT EXISTS `race_records` (
  `id` int(10) unsigned NOT NULL,
  `player` int(10) unsigned NOT NULL,
  `time` int(11) NOT NULL,
  `date` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `race_startpos`
--

CREATE TABLE IF NOT EXISTS `race_startpos` (
  `id` int(10) unsigned NOT NULL,
  `seq` tinyint(3) unsigned NOT NULL,
  `xpos` float(14,4) NOT NULL,
  `ypos` float(14,4) NOT NULL,
  `zpos` float(14,4) NOT NULL,
  `apos` float(14,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `races`
--
ALTER TABLE `races`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `race_cps`
--
ALTER TABLE `race_cps`
  ADD KEY `id` (`id`);

--
-- Indexes for table `race_records`
--
ALTER TABLE `race_records`
  ADD KEY `id` (`id`);

--
-- Indexes for table `race_startpos`
--
ALTER TABLE `race_startpos`
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `races`
--
ALTER TABLE `races`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `race_cps`
--
ALTER TABLE `race_cps`
ADD CONSTRAINT `race_cps_ibfk_1` FOREIGN KEY (`id`) REFERENCES `races` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `race_records`
--
ALTER TABLE `race_records`
ADD CONSTRAINT `race_records_ibfk_1` FOREIGN KEY (`id`) REFERENCES `races` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `race_startpos`
--
ALTER TABLE `race_startpos`
ADD CONSTRAINT `race_startpos_ibfk_1` FOREIGN KEY (`id`) REFERENCES `races` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
