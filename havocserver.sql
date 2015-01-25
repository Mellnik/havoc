-- phpMyAdmin SQL Dump
-- version 4.3.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2015 at 08:19 PM
-- Server version: 5.5.40-MariaDB
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
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(24) NOT NULL,
  `password` varchar(128) NOT NULL DEFAULT 'NoData',
  `salt` varchar(32) NOT NULL DEFAULT 'NoData',
  `password_old` varchar(40) NOT NULL DEFAULT 'NoData',
  `version` varchar(20) NOT NULL,
  `serial` varchar(64) NOT NULL,
  `email` varchar(25) NOT NULL DEFAULT 'NoData',
  `admin` tinyint(3) unsigned NOT NULL,
  `mapper` tinyint(3) unsigned NOT NULL,
  `score` mediumint(8) unsigned NOT NULL,
  `money` int(11) NOT NULL,
  `bank` int(11) NOT NULL,
  `pvslots` tinyint(3) unsigned NOT NULL,
  `kills` mediumint(8) unsigned NOT NULL,
  `deaths` mediumint(8) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `skin` smallint(6) NOT NULL,
  `bounty` int(10) unsigned NOT NULL,
  `payday` tinyint(4) NOT NULL,
  `reactions` smallint(5) unsigned NOT NULL,
  `maths` smallint(5) unsigned NOT NULL,
  `gangid` int(10) unsigned NOT NULL,
  `gangrank` tinyint(4) NOT NULL,
  `winderby` smallint(5) unsigned NOT NULL,
  `winrace` smallint(5) unsigned NOT NULL,
  `wintdm` smallint(5) unsigned NOT NULL,
  `winfallout` smallint(5) unsigned NOT NULL,
  `wingungame` smallint(5) unsigned NOT NULL,
  `wanteds` smallint(5) unsigned NOT NULL,
  `duelwins` mediumint(8) unsigned NOT NULL,
  `duellost` mediumint(8) unsigned NOT NULL,
  `vip` tinyint(3) unsigned NOT NULL,
  `medkits` smallint(5) unsigned NOT NULL,
  `regdate` int(10) unsigned NOT NULL,
  `regip` varchar(16) NOT NULL,
  `lastlogin` int(10) unsigned NOT NULL,
  `lastnc` int(10) unsigned NOT NULL,
  `timeskick` int(10) unsigned NOT NULL,
  `timeslogin` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE IF NOT EXISTS `achievements` (
  `id` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `unlockdate` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bans`
--

CREATE TABLE IF NOT EXISTS `bans` (
  `id` int(10) unsigned NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `reason` varchar(64) NOT NULL,
  `lift` int(10) unsigned NOT NULL COMMENT '0 = permanent',
  `date` int(10) unsigned NOT NULL,
  `ping` smallint(6) NOT NULL,
  `xpos` float(14,4) NOT NULL,
  `ypos` float(14,4) NOT NULL,
  `zpos` float(14,4) NOT NULL,
  `packetloss` float(4,2) NOT NULL,
  `state` tinyint(3) unsigned NOT NULL,
  `health` float(14,2) NOT NULL,
  `armor` float(14,2) NOT NULL,
  `god` tinyint(3) unsigned NOT NULL,
  `weapon` mediumint(8) unsigned NOT NULL,
  `ac_flags` bit(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enterprises`
--

CREATE TABLE IF NOT EXISTS `enterprises` (
  `id` int(10) unsigned NOT NULL,
  `owner` int(10) unsigned NOT NULL,
  `xpos` float(14,4) NOT NULL,
  `ypos` float(14,4) NOT NULL,
  `zpos` float(14,4) NOT NULL,
  `value` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `creator` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gangs`
--

CREATE TABLE IF NOT EXISTS `gangs` (
  `id` int(10) unsigned NOT NULL,
  `gname` varchar(20) NOT NULL,
  `gtag` varchar(4) NOT NULL,
  `gscore` int(10) unsigned NOT NULL,
  `gcolor` int(11) NOT NULL DEFAULT '-84215197',
  `gcar` mediumint(8) unsigned NOT NULL,
  `gtop` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gzones`
--

CREATE TABLE IF NOT EXISTS `gzones` (
  `id` int(10) unsigned NOT NULL,
  `zname` varchar(40) NOT NULL,
  `xpos` float(14,4) NOT NULL,
  `ypos` float(14,4) NOT NULL,
  `zpos` float(14,4) NOT NULL,
  `localgang` int(10) unsigned NOT NULL,
  `locked` int(10) unsigned NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE IF NOT EXISTS `houses` (
  `id` int(10) unsigned NOT NULL,
  `owner` int(10) unsigned NOT NULL,
  `xpos` float(14,4) NOT NULL,
  `ypos` float(14,4) NOT NULL,
  `zpos` float(14,4) NOT NULL,
  `pvslots` tinyint(3) unsigned NOT NULL,
  `interior` tinyint(3) unsigned NOT NULL,
  `originterior` tinyint(3) unsigned NOT NULL,
  `value` int(10) unsigned NOT NULL,
  `locked` tinyint(4) NOT NULL,
  `password` varchar(40) NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ipbans`
--

CREATE TABLE IF NOT EXISTS `ipbans` (
  `ip` varchar(45) NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `service` enum('SERVICE_SERVER','SERVICE_PANEL') NOT NULL,
  `date` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loginlog`
--

CREATE TABLE IF NOT EXISTS `loginlog` (
  `id` int(10) unsigned NOT NULL,
  `ip` varchar(45) NOT NULL,
  `service` tinyint(3) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ncrecords`
--

CREATE TABLE IF NOT EXISTS `ncrecords` (
  `id` int(10) unsigned NOT NULL,
  `oldname` varchar(24) NOT NULL,
  `newname` varchar(24) NOT NULL,
  `date` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL,
  `author` int(10) unsigned NOT NULL,
  `title` varchar(20) NOT NULL,
  `news` text NOT NULL,
  `date` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE IF NOT EXISTS `queue` (
  `id` int(10) unsigned NOT NULL,
  `action` tinyint(4) NOT NULL,
  `execdate` int(10) unsigned NOT NULL,
  `extra` varchar(100) NOT NULL
) ENGINE=MEMORY DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `serialbans`
--

CREATE TABLE IF NOT EXISTS `serialbans` (
  `serial` varchar(64) NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `server`
--

CREATE TABLE IF NOT EXISTS `server` (
  `name` varchar(16) NOT NULL,
  `value` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `server`
--

INSERT INTO `server` (`name`, `value`) VALUES
('player_record', '250'),
('online', '0');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL,
  `allow_teleport` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `allow_pm` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `fightstyle` tinyint(4) NOT NULL DEFAULT '4',
  `speedo` tinyint(3) unsigned NOT NULL,
  `namecolor` int(11) NOT NULL,
  `skin` smallint(5) NOT NULL DEFAULT '-1',
  `auto_login` tinyint(3) unsigned NOT NULL,
  `blevel` float(4,2) NOT NULL DEFAULT '1.30',
  `jlevel` float(4,2) NOT NULL DEFAULT '0.20',
  `house_spawn` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE IF NOT EXISTS `stores` (
  `id` int(10) unsigned NOT NULL,
  `type` smallint(5) unsigned NOT NULL,
  `name` varchar(24) NOT NULL,
  `xpick` float(14,4) NOT NULL,
  `ypick` float(14,4) NOT NULL,
  `zpick` float(14,4) NOT NULL,
  `xspawn` float(14,4) NOT NULL,
  `yspawn` float(14,4) NOT NULL,
  `zspawn` float(14,4) NOT NULL,
  `aspawn` float(14,4) NOT NULL,
  `creator` int(10) unsigned NOT NULL,
  `date` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `toys`
--

CREATE TABLE IF NOT EXISTS `toys` (
  `id` int(10) unsigned NOT NULL,
  `seq` tinyint(3) unsigned NOT NULL,
  `model` smallint(5) unsigned NOT NULL,
  `bone` tinyint(3) unsigned NOT NULL,
  `xpos` float(14,4) NOT NULL,
  `ypos` float(14,4) NOT NULL,
  `zpos` float(14,4) NOT NULL,
  `xrot` float(14,4) NOT NULL,
  `yrot` float(14,4) NOT NULL,
  `zrot` float(14,4) NOT NULL,
  `xscale` float(14,4) NOT NULL,
  `yscale` float(14,4) NOT NULL,
  `zscale` float(14,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(10) unsigned NOT NULL,
  `seq` tinyint(3) unsigned NOT NULL,
  `model` smallint(5) unsigned NOT NULL,
  `plate` varchar(13) NOT NULL,
  `paintjob` tinyint(4) NOT NULL,
  `color1` smallint(5) unsigned NOT NULL,
  `color2` smallint(5) unsigned NOT NULL,
  `mod1` smallint(5) unsigned NOT NULL,
  `mod2` smallint(5) unsigned NOT NULL,
  `mod3` smallint(5) unsigned NOT NULL,
  `mod4` smallint(5) unsigned NOT NULL,
  `mod5` smallint(5) unsigned NOT NULL,
  `mod6` smallint(5) unsigned NOT NULL,
  `mod7` smallint(5) unsigned NOT NULL,
  `mod8` smallint(5) unsigned NOT NULL,
  `mod9` smallint(5) unsigned NOT NULL,
  `mod10` smallint(5) unsigned NOT NULL,
  `mod11` smallint(5) unsigned NOT NULL,
  `mod12` smallint(5) unsigned NOT NULL,
  `mod13` smallint(5) unsigned NOT NULL,
  `mod14` smallint(5) unsigned NOT NULL,
  `mod15` smallint(5) unsigned NOT NULL,
  `mod16` smallint(5) unsigned NOT NULL,
  `mod17` smallint(5) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `viporder`
--

CREATE TABLE IF NOT EXISTS `viporder` (
  `id` int(10) unsigned NOT NULL,
  `txn_id` varchar(18) NOT NULL,
  `email` varchar(45) NOT NULL,
  `receiver` varchar(24) NOT NULL,
  `payment` varchar(10) NOT NULL,
  `method` tinyint(4) NOT NULL,
  `issue` enum('NOT_COMPLETE','USER_NOT_FOUND','USER_ALREADY_VIP','TXN_ID_EXISTS','INVALID_RESPONSE','UNKNOWN','OK') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD KEY `id` (`id`);

--
-- Indexes for table `bans`
--
ALTER TABLE `bans`
  ADD KEY `id` (`id`);

--
-- Indexes for table `enterprises`
--
ALTER TABLE `enterprises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gangs`
--
ALTER TABLE `gangs`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `GangName` (`gname`);

--
-- Indexes for table `gzones`
--
ALTER TABLE `gzones`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `zname` (`zname`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loginlog`
--
ALTER TABLE `loginlog`
  ADD KEY `id` (`id`);

--
-- Indexes for table `ncrecords`
--
ALTER TABLE `ncrecords`
  ADD KEY `id` (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `serialbans`
--
ALTER TABLE `serialbans`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `server`
--
ALTER TABLE `server`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD KEY `id` (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `toys`
--
ALTER TABLE `toys`
  ADD KEY `id` (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD KEY `id` (`id`);

--
-- Indexes for table `viporder`
--
ALTER TABLE `viporder`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enterprises`
--
ALTER TABLE `enterprises`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gangs`
--
ALTER TABLE `gangs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gzones`
--
ALTER TABLE `gzones`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `races`
--
ALTER TABLE `races`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `viporder`
--
ALTER TABLE `viporder`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `achievements`
--
ALTER TABLE `achievements`
ADD CONSTRAINT `achievements_ibfk_1` FOREIGN KEY (`id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bans`
--
ALTER TABLE `bans`
ADD CONSTRAINT `bans_ibfk_1` FOREIGN KEY (`id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loginlog`
--
ALTER TABLE `loginlog`
ADD CONSTRAINT `loginlog_ibfk_1` FOREIGN KEY (`id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ncrecords`
--
ALTER TABLE `ncrecords`
ADD CONSTRAINT `ncrecords_ibfk_1` FOREIGN KEY (`id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
ADD CONSTRAINT `settings_ibfk_1` FOREIGN KEY (`id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `toys`
--
ALTER TABLE `toys`
ADD CONSTRAINT `toys_ibfk_1` FOREIGN KEY (`id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
