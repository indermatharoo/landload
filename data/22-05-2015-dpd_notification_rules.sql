-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 23, 2015 at 10:32 AM
-- Server version: 5.5.41-0ubuntu0.14.10.1
-- PHP Version: 5.5.12-2ubuntu4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `codeigniter`
--

-- --------------------------------------------------------

--
-- Table structure for table `dpd_notification_rules`
--

CREATE TABLE IF NOT EXISTS `dpd_notification_rules` (
`id` int(10) unsigned NOT NULL COMMENT 'Primary Ids',
  `for_group` varchar(100) NOT NULL DEFAULT '2,3',
  `display_class_name` varchar(100) NOT NULL DEFAULT ' ',
  `class` varchar(100) NOT NULL DEFAULT ' ',
  `display_action_name` varchar(100) NOT NULL DEFAULT ' ',
  `action` varchar(100) NOT NULL DEFAULT ' ',
  `filter` varchar(20) NOT NULL,
  `msg` varchar(100) NOT NULL DEFAULT ' ',
  `grp` varchar(10) NOT NULL DEFAULT '0',
  `assigne` text NOT NULL,
  `display_order` tinyint(2) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `dpd_notification_rules`
--

INSERT INTO `dpd_notification_rules` (`id`, `for_group`, `display_class_name`, `class`, `display_action_name`, `action`, `filter`, `msg`, `grp`, `assigne`, `display_order`, `active`) VALUES
(1, '2,3', 'Virtual Cabinet', 'virtcab', 'Sharing File ', 'fillcab ', '', ' File is shared with {NAME}', 'allgrp', '2,3', 0, 1),
(2, '3,6', 'Survey', 'survey', 'On add survey ', 'addSurvey', '', 'Survey added for {NAME} ', '3', '2,4', 0, 1),
(3, '2,3,5,6', 'Forum', 'forum ', 'Add Forum', 'add ', '', 'Forum added by {SENDER_NAME} ', 'allgrp', '2,3,5,6', 0, 1),
(4, '2,3,5,6', 'Forum', 'forum ', 'Add Topic ', 'addTopic', '', 'Topic added by {SENDER_NAME} ', 'allgrp', '2,3,5,6', 0, 1),
(5, '2,3,5,6', 'Forum', 'forum ', 'On post add ', 'addpost ', '', 'Post added by {SENDER_NAME}', 'allgrp', '2,3,5,6', 0, 1),
(6, '2,3', 'User', 'user ', 'On add', 'add', 'user', 'User added by {SENDER_NAME} ', 'allgrp', '2,3', 0, 1),
(8, '2,3', 'Franchisee', 'user ', 'On add', 'add', 'franchisee', 'Franchisee added by {SENDER_NAME}', 'allgrp', '2,3', 0, 1),
(9, '2,3', 'Customer', 'customer', 'On add ', 'addedit ', 'customer', 'Customer added by {SENDER_NAME}', 'allgrp', '2,3', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dpd_notification_rules`
--
ALTER TABLE `dpd_notification_rules`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dpd_notification_rules`
--
ALTER TABLE `dpd_notification_rules`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Ids',AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
