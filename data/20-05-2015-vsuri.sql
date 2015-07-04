-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2015 at 10:54 AM
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
-- Table structure for table `dpd_enquiry_types`
--

CREATE TABLE IF NOT EXISTS `dpd_enquiry_types` (
`id` int(10) unsigned NOT NULL,
  `desc` varchar(255) NOT NULL,
  `sort_order` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `dpd_enquiry_types`
--

INSERT INTO `dpd_enquiry_types` (`id`, `desc`, `sort_order`) VALUES
(1, 'Franchise enquiry', 1),
(2, 'Other enquiry', 0),
(3, 'Little Explorer classes from 15 months - 5 years', 2),
(4, 'Family Fun classes from 1 year - 11 years', 3),
(5, 'Arty Birthday Party Entertainment', 4),
(6, 'Group Events', 5),
(7, 'Discovery Morning', 6),
(8, 'Baby Discover classes from 5 months - 14 months', 7),
(9, 'Franchisee Training', 8),
(10, 'After School, Saturday and Holiday Clubs from 5 years - 11 years', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dpd_enquiry_types`
--
ALTER TABLE `dpd_enquiry_types`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dpd_enquiry_types`
--
ALTER TABLE `dpd_enquiry_types`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
