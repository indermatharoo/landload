-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2015 at 09:14 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `crmadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `dpd_config`
--

CREATE TABLE IF NOT EXISTS `dpd_config` (
  `config_key` varchar(255) NOT NULL,
  `config_group_id` int(10) unsigned NOT NULL DEFAULT '1',
  `config_label` varchar(255) NOT NULL DEFAULT '',
  `config_value` text NOT NULL,
  `config_comments` varchar(255) NOT NULL DEFAULT '',
  `config_field_type` varchar(255) NOT NULL DEFAULT 'textfield',
  `config_field_options` text,
  `editable` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`config_key`),
  KEY `config_group_id` (`config_group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dpd_config`
--

INSERT INTO `dpd_config` (`config_key`, `config_group_id`, `config_label`, `config_value`, `config_comments`, `config_field_type`, `config_field_options`, `editable`) VALUES
('EMAIL_ADMIN', 1, 'Admin Email', 'nathan@jaspersonline.co.uk', '', 'textfield', '', 1),
('EMAIL_FROM', 1, 'Email From', 'info@desktopdeli.co.uk', '', 'textfield', '', 1),
('EMAIL_NOREPLY', 1, 'Noreply Email', 'info@desktopdeli.co.uk', '', 'textfield', '', 1),
('EMAIL_REPLY_TO', 1, 'Email Reply To', 'info@desktopdeli.co.uk', '', 'textfield', '', 1),
('CURRENCY_SYMBOL', 2, 'Currency Symbol', '£', '', 'textfield', '', 1),
('THEME', 1, '', '1', '', 'textfield', '', 0),
('PAYPAL_API_SIGNATURE', 2, '', 'AlIlbSDfg4gXDLIsA8tfueDYjheOAvLQnEn44nzZ6Hkg3q-MsF5hKexn', '', 'textfield', '', 0),
('PAYPAL_API_PASSWORD', 2, '', '1269932694', '', 'textfield', '', 0),
('PAYPAL_API_USERNAME', 2, '', 'mr.dav_1269932688_biz_api1.gmail.com', '', 'textfield', '', 0),
('PAYPAL_DEMO_MODE', 2, 'Paypal Demo Mode', '1', '', 'textfield', '', 0),
('PAGEBANNER_THUMBNAIL_WIDTH', 1, '', '100', '', 'textfield', '', 0),
('PAGEBANNER_THUMBNAIL_HEIGHT', 1, '', '100', '', 'textfield', '', 0),
('CURRENCY_CODE', 2, 'Currency Code', 'GBP', '', 'textfield', 'd', 1),
('CREDITCARD_DEMO_MODE', 1, '', '1', '', 'textfield', 'D', 0),
('DATE_FORMAT', 1, 'Date Format', 'd/m/Y', '', 'textfield', 's', 0),
('PRODUCT_THUMBNAIL_WIDTH', 1, '', '100', '', 'textfield', NULL, 0),
('PRODUCT_THUMBNAIL_HEIGHT', 1, '', '100', '', 'textfield', NULL, 0),
('CASESTUDY_THUMBNAIL_WIDTH', 1, '', '100', '', 'textfield', NULL, 0),
('CASESTUDY_THUMBNAIL_HEIGHT', 1, '', '100', '', 'textfield', NULL, 0),
('SAGEPAY_VENDOR_NAME', 2, 'SagePay Vendor Name', 'test', '', 'textfield', NULL, 0),
('DEMO_MODE', 2, 'Demo Mode', '0', '', 'textfield', NULL, 1),
('TAX', 2, 'Tax', '0', '', 'textfield', NULL, 0),
('TWITTER_ACCOUNT', 1, 'Twitter Account', 'test', '', 'textfield', NULL, 1),
('CATEGORY_THUMBNAIL_WIDTH', 1, '', '100', '', 'textfield', NULL, 0),
('CATEGORY_THUMBNAIL_HEIGHT', 1, '', '100', '', 'textfield', NULL, 0),
('REALEX_MERCHAND_ID', 2, 'Realex Merchant ID', 'jaspersfranchiseltd', '', 'textfield', NULL, 1),
('REALEX_SUB_ACCOUNT', 2, 'Realex Sub Account', '', '', 'textfield', NULL, 1),
('REALEX_SECRET_KEY', 2, 'Realex Secret Key', 'CbwFcdeINT', '', 'textfield', NULL, 1),
('PDF_EMAIL', 1, 'PDF Email', 'customer@desktopdeli.co.uk', '', 'textfield', NULL, 0),
('PAYPAL_MERCHENT_EMAIL', 2, 'Paypal Email', 'nathan@desktopdeli.co.uk', '', 'textfield', NULL, 1),
('SHOPPING_CART_IMAGE', 3, 'Shopping Cart Image', 'Untitled.png', '', 'image', 'jpg|png|gif', 1),
('FRIEND_POPUP_IMAGE', 3, 'Friend Popup Image', 'working-fruit-image.png', '', 'image', 'jpg|png|gif', 1),
('GUARANTEE_POPUP_IMAGE', 3, 'Guarantee Popup Image', 'guarantee_box.jpg', '', 'image', 'jpg|png|gif', 1),
('FORGOT_PASSWORD_IMAGE', 3, 'Forgot Password Image', 'banner-img11.jpg', '', 'image', 'jpg|png|gif', 1),
('DELIVERY_DATE_IMAGE', 3, 'Delivery Date Popup Image', 'banner-img2.jpg', '', 'image', 'jpg|png|gif', 1),
('CLOUDMAILIN_PASSWORD', 2, 'Cloudmailin Password', 'bruspU7u', '', 'textfield', NULL, 1),
('CLOUDMAILIN_EMAIL', 2, 'Cloudmailin Email', 'b3c05447f14690ccd2bc@cloudmailin.net', '', 'textfield', '', 1),
('CLOUDMAILIN_USER', 2, 'Cloudmailin User', 'smg', '', 'textfield', NULL, 1),
('OPERATOR_IMAGE', 3, 'OPERATOR Image', '', '', 'image', 'jpg|png|gif', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
