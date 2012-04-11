-- phpMyAdmin SQL Dump
-- version 3.4.10.2deb1.oneiric~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2012 at 12:47 AM
-- Server version: 5.1.61
-- PHP Version: 5.3.6-13ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myci`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_accounts`
--
-- Creation: Apr 11, 2012 at 09:46 PM
-- Last update: Apr 11, 2012 at 09:46 PM
--

CREATE TABLE IF NOT EXISTS `ci_accounts` (
  `id_account` int(11) NOT NULL AUTO_INCREMENT,
  `number_pass_account` int(7) NOT NULL,
  `id_status_account` int(5) NOT NULL DEFAULT '1',
  `id_sambagroup_account` int(5) NOT NULL DEFAULT '1',
  `id_usergroup_account` int(5) NOT NULL DEFAULT '1',
  `deleted_account` tinyint(1) NOT NULL DEFAULT '0',
  `in_samba_account` tinyint(1) NOT NULL DEFAULT '0',
  `blocked_account` tinyint(1) NOT NULL DEFAULT '1',
  `internet_lock_account` tinyint(1) NOT NULL DEFAULT '1',
  `access_to_database_account` tinyint(1) NOT NULL DEFAULT '1',
  `last_name_account` tinytext NOT NULL,
  `first_name_account` varchar(100) NOT NULL,
  `middle_name_account` varchar(100) NOT NULL,
  `login_account` varchar(255) NOT NULL,
  `password_account` varchar(128) NOT NULL,
  `picture_account` mediumblob NOT NULL,
  `shell_account` enum('/bin/csh','/bin/sh','/sbin/nologin') NOT NULL DEFAULT '/sbin/nologin',
  `quota_account` tinytext NOT NULL,
  `account_note_account` text NOT NULL,
  `birthday_date_account` date NOT NULL,
  `create_date_account` datetime NOT NULL,
  `update_date_account` datetime NOT NULL,
  PRIMARY KEY (`id_account`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- RELATIONS FOR TABLE `ci_accounts`:
--   `id_sambagroup_account`
--       `ci_sambagroups` -> `id_sambagroup`
--   `id_status_account`
--       `ci_statuses` -> `id_status`
--   `id_usergroup_account`
--       `ci_usergroups` -> `id_usergroup`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sambagroups`
--
-- Creation: Apr 11, 2012 at 07:03 PM
-- Last update: Apr 11, 2012 at 09:46 PM
--

CREATE TABLE IF NOT EXISTS `ci_sambagroups` (
  `id_sambagroup` int(5) NOT NULL AUTO_INCREMENT,
  `name_sambagroup` tinytext NOT NULL,
  `note_sambagroup` text NOT NULL,
  UNIQUE KEY `id_samba_group` (`id_sambagroup`),
  FULLTEXT KEY `name_sambagroup` (`name_sambagroup`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ci_sambagroups`
--

INSERT INTO `ci_sambagroups` (`id_sambagroup`, `name_sambagroup`, `note_sambagroup`) VALUES
(1, 'не указана', '');

-- --------------------------------------------------------

--
-- Table structure for table `ci_statuses`
--
-- Creation: Apr 11, 2012 at 07:03 PM
-- Last update: Apr 11, 2012 at 09:46 PM
--

CREATE TABLE IF NOT EXISTS `ci_statuses` (
  `id_status` int(5) NOT NULL AUTO_INCREMENT,
  `name_status` tinytext NOT NULL,
  `note_status` text NOT NULL,
  PRIMARY KEY (`id_status`),
  FULLTEXT KEY `name_status` (`name_status`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ci_statuses`
--

INSERT INTO `ci_statuses` (`id_status`, `name_status`, `note_status`) VALUES
(1, 'не указан', '');

-- --------------------------------------------------------

--
-- Table structure for table `ci_usergroups`
--
-- Creation: Apr 11, 2012 at 07:03 PM
-- Last update: Apr 11, 2012 at 09:45 PM
--

CREATE TABLE IF NOT EXISTS `ci_usergroups` (
  `id_usergroup` int(5) NOT NULL AUTO_INCREMENT,
  `id_sambagroup_usergroup` int(5) NOT NULL,
  `name_usergroup` tinytext NOT NULL,
  `note_usergroup` text NOT NULL,
  PRIMARY KEY (`id_usergroup`),
  FULLTEXT KEY `name_usergroup` (`name_usergroup`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- RELATIONS FOR TABLE `ci_usergroups`:
--   `id_sambagroup_usergroup`
--       `ci_sambagroups` -> `id_sambagroup`
--

--
-- Dumping data for table `ci_usergroups`
--

INSERT INTO `ci_usergroups` (`id_usergroup`, `id_sambagroup_usergroup`, `name_usergroup`, `note_usergroup`) VALUES
(1, 1, 'не указана', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
