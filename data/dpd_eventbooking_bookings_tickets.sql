-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2015 at 01:36 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

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
-- Table structure for table `dpd_eventbooking_bookings_tickets`
--

CREATE TABLE IF NOT EXISTS `dpd_eventbooking_bookings_tickets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `booking_id` int(10) unsigned NOT NULL DEFAULT '0',
  `event_id` int(11) NOT NULL,
  `ticket_id` varchar(255) DEFAULT NULL,
  `is_used` enum('T','F') NOT NULL DEFAULT 'F',
  PRIMARY KEY (`id`),
  KEY `booking_id` (`ticket_id`,`booking_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
