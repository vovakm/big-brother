-- phpMyAdmin SQL Dump
-- version 3.4.3
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 04 2011 г., 00:59
-- Версия сервера: 5.1.54
-- Версия PHP: 5.3.5-1ubuntu7.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `users_accounts_zieit`
--
CREATE DATABASE `users_accounts_zieit` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `users_accounts_zieit`;

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id_account` int(11) NOT NULL AUTO_INCREMENT,
  `number_pass` int(7) NOT NULL,
  `id_status` int(3) NOT NULL DEFAULT '1',
  `id_samba_group` int(3) NOT NULL DEFAULT '1',
  `id_user_group` int(5) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `blocked` enum('Да','Нет') NOT NULL DEFAULT 'Нет',
  `internet_lock` enum('Полный доступ','Нормальный доступ','Заблокированный') NOT NULL DEFAULT 'Нормальный доступ',
  `access_to_database` varchar(30) NOT NULL DEFAULT 'Нормальный доступ',
  `account_name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `shell` enum('/bin/csh','/bin/sh','/sbin/nologin') NOT NULL DEFAULT '/sbin/nologin',
  `quota` varchar(255) NOT NULL,
  `account_note` varchar(255) NOT NULL,
  `birthday_date` date NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`id_account`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52407 ;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`id_account`, `number_pass`, `id_status`, `id_samba_group`, `id_user_group`, `deleted`, `blocked`, `internet_lock`, `access_to_database`, `account_name`, `login`, `password`, `picture`, `shell`, `quota`, `account_note`, `birthday_date`, `create_date`, `update_date`) VALUES
(1, 13179, 1, 1, 1, 0, 'Нет', 'Нормальный доступ', '2222222222222222', 'Копоть Володимир Володимирович', 'kopot_vv', '1', '', '/sbin/nologin', '0:0:0:0', '', '2011-06-01', '2011-06-26 00:00:00', '2011-06-26 00:46:56');

-- --------------------------------------------------------

--
-- Структура таблицы `last_events`
--

CREATE TABLE IF NOT EXISTS `last_events` (
  `id_last_event` int(11) NOT NULL AUTO_INCREMENT,
  `id_account` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_time` datetime NOT NULL,
  PRIMARY KEY (`id_last_event`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `last_events`
--

INSERT INTO `last_events` (`id_last_event`, `id_account`, `event_name`, `event_time`) VALUES
(1, 1, 'Login', '2011-06-30 09:17:24'),
(2, 1, 'Login', '2011-06-30 09:18:28'),
(3, 1, 'Login', '2011-06-30 09:50:42'),
(4, 1, 'Login', '2011-06-30 09:50:51'),
(5, 1, 'Login', '2011-06-30 10:20:59'),
(6, 1, 'Login', '2011-06-30 10:21:31'),
(7, 1, 'Login', '2011-06-30 15:47:57'),
(8, 1, 'Login', '2011-06-30 16:12:45'),
(9, 1, 'Login', '2011-06-30 16:13:37'),
(10, 1, 'Login', '2011-06-30 16:14:06'),
(11, 1, 'Login', '2011-06-30 16:15:11'),
(12, 1, 'Login', '2011-06-30 17:58:16'),
(13, 1, 'Login', '2011-07-01 09:26:24'),
(14, 1, 'Login', '2011-07-02 00:38:58'),
(15, 1, 'Login', '2011-07-02 11:53:03'),
(16, 1, 'Login', '2011-07-02 13:49:32'),
(17, 1, 'Login', '2011-07-03 00:32:28'),
(18, 1, 'Login', '2011-07-03 23:26:56'),
(19, 1, 'Login', '2011-07-03 23:29:57'),
(20, 1, 'Login', '2011-07-03 23:34:24'),
(21, 1, 'Login', '2011-07-03 23:35:08'),
(22, 1, 'Login', '2011-07-03 23:37:48');

-- --------------------------------------------------------

--
-- Структура таблицы `samba_groups`
--

CREATE TABLE IF NOT EXISTS `samba_groups` (
  `id_samba_group` int(3) NOT NULL AUTO_INCREMENT,
  `samba_group_name` varchar(255) NOT NULL,
  `samba_group_note` varchar(255) NOT NULL,
  PRIMARY KEY (`id_samba_group`),
  UNIQUE KEY `id_samba_group` (`id_samba_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id_status` int(3) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) NOT NULL,
  `status_note` varchar(255) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id_user_group` int(5) NOT NULL AUTO_INCREMENT,
  `name_user_group` varchar(255) NOT NULL,
  `note_user_group` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user_group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
