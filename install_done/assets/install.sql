-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2014 at 09:22 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `classicinvoicer`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_clients`
--

CREATE TABLE IF NOT EXISTS `ci_clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) NOT NULL,
  `client_address` varchar(100) NOT NULL,
  `postal_code` varchar(100) NOT NULL,
  `client_city` varchar(100) NOT NULL,
  `client_country` varchar(20) NOT NULL,
  `client_phone` varchar(100) NOT NULL,
  `client_fax` varchar(20) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `client_date_created` datetime NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_config`
--

CREATE TABLE IF NOT EXISTS `ci_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `date_format` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_email_templates`
--

CREATE TABLE IF NOT EXISTS `ci_email_templates` (
  `template_id` int(11) NOT NULL AUTO_INCREMENT,
  `template_title` varchar(200) NOT NULL,
  `email_body` text NOT NULL,
  PRIMARY KEY (`template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_invoices`
--

CREATE TABLE IF NOT EXISTS `ci_invoices` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `invoice_status` enum('PAID','UNPAID','CANCELLED') NOT NULL DEFAULT 'UNPAID',
  `invoice_number` varchar(50) NOT NULL,
  `invoice_discount` double NOT NULL,
  `invoice_terms` longtext NOT NULL,
  `invoice_due_date` datetime NOT NULL,
  `invoice_date_created` date NOT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_invoice_items`
--

CREATE TABLE IF NOT EXISTS `ci_invoice_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `item_quantity` decimal(10,2) NOT NULL,
  `item_description` longtext NOT NULL,
  `item_taxrate_id` int(11) NOT NULL,
  `item_order` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` decimal(10,2) NOT NULL,
  `item_discount` double NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_payments`
--

CREATE TABLE IF NOT EXISTS `ci_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `payment_method_id` int(11) NOT NULL,
  `payment_amount` decimal(10,2) NOT NULL,
  `payment_note` longtext NOT NULL,
  `payment_date` date NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_payment_methods`
--

CREATE TABLE IF NOT EXISTS `ci_payment_methods` (
  `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method_name` varchar(255) NOT NULL,
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_products`
--

CREATE TABLE IF NOT EXISTS `ci_products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_description` longtext NOT NULL,
  `product_unitprice` decimal(10,2) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_quotes`
--

CREATE TABLE IF NOT EXISTS `ci_quotes` (
  `quote_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `quote_subject` varchar(300) NOT NULL,
  `date_created` date NOT NULL,
  `valid_until` date NOT NULL,
  `quote_discount` double NOT NULL,
  `customer_notes` text NOT NULL,
  `quote_status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`quote_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_quotes_items`
--

CREATE TABLE IF NOT EXISTS `ci_quotes_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `quote_id` int(11) NOT NULL,
  `item_name` varchar(300) NOT NULL,
  `item_description` text NOT NULL,
  `item_price` double NOT NULL,
  `item_quantity` double NOT NULL,
  `Item_tax_rate_id` int(11) NOT NULL,
  `item_discount` double NOT NULL,
  `item_order` int(11) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_tax_rates`
--

CREATE TABLE IF NOT EXISTS `ci_tax_rates` (
  `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_rate_name` varchar(100) NOT NULL,
  `tax_rate_percent` decimal(5,2) NOT NULL,
  PRIMARY KEY (`tax_rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_users`
--

CREATE TABLE IF NOT EXISTS `ci_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_phone` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_date_created` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
