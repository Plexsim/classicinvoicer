-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2015 at 06:34 PM
-- Server version: 5.5.40-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dangdire_nick`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_cash_vouchers`
--

CREATE TABLE IF NOT EXISTS `ci_cash_vouchers` (
  `cash_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `cash_status` enum('PAID','UNPAID','CANCELLED') NOT NULL DEFAULT 'UNPAID',
  `cash_amount` decimal(10,2) NOT NULL,
  `cash_number` varchar(50) NOT NULL,
  `cash_terms` longtext NOT NULL,
  `cash_date_created` date NOT NULL,
  PRIMARY KEY (`cash_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ci_cash_vouchers`
--

INSERT INTO `ci_cash_vouchers` (`cash_id`, `user_id`, `staff_id`, `cash_status`, `cash_amount`, `cash_number`, `cash_terms`, `cash_date_created`) VALUES
(1, 1, 2, 'PAID', '1054.00', '1', 'MAINTENANCE', '2015-04-29'),
(2, 2, 2, 'UNPAID', '410.00', '2', 'Tukar Plastik', '2015-07-07'),
(3, 1, 1, 'UNPAID', '777.00', '3', '', '2015-05-01'),
(4, 2, 2, 'UNPAID', '0.00', '4', 'Tukar Plastik', '2015-07-07');

-- --------------------------------------------------------

--
-- Table structure for table `ci_clients`
--

CREATE TABLE IF NOT EXISTS `ci_clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) NOT NULL,
  `client_ssm` varchar(100) NOT NULL,
  `client_address` varchar(100) NOT NULL,
  `postal_code` varchar(100) NOT NULL,
  `client_city` varchar(100) NOT NULL,
  `client_country` varchar(20) NOT NULL,
  `client_phone` varchar(100) NOT NULL,
  `client_fax` varchar(20) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `client_gst` varchar(100) NOT NULL,
  `client_date_created` datetime NOT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `ci_clients`
--

INSERT INTO `ci_clients` (`client_id`, `client_name`, `client_ssm`, `client_address`, `postal_code`, `client_city`, `client_country`, `client_phone`, `client_fax`, `client_email`, `client_gst`, `client_date_created`) VALUES
(1, 'RICH HARVEST FARM ENTERPRISE', 'IP0365140V', 'NO5,JALAN CORINA 9,TAMAN DESA CORINA KAMPUNG RAJA,39010 CAMERON HIGHLANDS,PAHANG.', '39010', 'TANAH RATA', 'MY', '0195598115', '-', '', '001921441792', '2015-03-23 00:00:00'),
(2, 'TANG PHO KIAK', '', 'NO38,TAMAN MATAHARI CERAH KAMPUNG RAJA CAMERON HIGHLANDS 39010 TANAH RATA PAHANG', '39010', 'TANAH RATA', 'MY', '0125775261', '', '', '000931418112', '2015-03-23 00:00:00'),
(3, 'YONG SHENG AGRICULTURAL ENTERPRISE', '', '89A,KAMPUNG RAJA CAMERON HIGHLANDS TANAH RATA PAHANG', '39010', 'TANAH RATA', 'MY', '0125211177', '', '', '000294608896', '2015-03-23 00:00:00'),
(4, 'CHIE PENG ENTERPRISE', '', '-', '', '-', 'MY', '0192255272', '', '', '', '2015-04-02 00:00:00'),
(5, 'Cash', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-02 00:00:00'),
(6, 'KUAN', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-02 00:00:00'),
(7, 'AGRI-STORM SDN.BHD.', '', 'LOT F-613,JALAN BESAR,39010 KAMPUNG RAJA CAMERON HIGHLANDS', '39010', 'TANAH RATA', 'MY', '0165610808', '054983730', '', '002005663744', '2015-04-03 00:00:00'),
(8, 'FARM LAND ENTERPRISE', 'IP0348033-D', 'NO.89-A,KG RAJA,39010 TANAH RATA PAHANG', '39010', 'TANAH RATA', 'MY', '0125510111', '', '', '000609525760', '2015-04-05 00:00:00'),
(9, 'TAMBUN', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-06 00:00:00'),
(10, 'KANG HANG CHONG', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-07 00:00:00'),
(11, 'PANG LING FEI', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-07 00:00:00'),
(12, 'TAN YAW HAK', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-07 00:00:00'),
(13, 'CHOONG YEE SAM', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-07 00:00:00'),
(14, 'TEONG BROTHER SDN BHD', 'IP957613-D', 'NO42 SAYUR STOR JALAN BESAR,KG RAJA 39010 TANAH RAJA PAHANG', '39010', 'TANAH RATA', 'MY', '-', '', '', '001201733632', '2015-04-08 00:00:00'),
(15, 'TANG ALIK', '', 'NO 112,KAMPUNG RAJA,39010 C.HIGHLANDS,PAHANG.', '39010', 'TANAH RATA', 'MY', '-', '', '', '001400082432', '2015-04-08 00:00:00'),
(16, 'WEI LUN', '', '-', '', 'TANAH RATA', 'MY', '-', '', '', '', '2015-04-09 00:00:00'),
(17, 'JIMMY', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-10 00:00:00'),
(18, 'WEI(49)', '-', '-', '', '-', 'MY', '-', '', '', '', '2015-04-13 00:00:00'),
(19, 'KANG JOO YEE', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-15 00:00:00'),
(20, 'TANG POH CHOONG', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-16 00:00:00'),
(21, 'POH', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-17 00:00:00'),
(22, 'LIANG', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-18 00:00:00'),
(23, 'SUPERMART ENTERPRISE', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-19 00:00:00'),
(24, 'DE ONENESS PLANTATION', '', '86,TAMAN MATAHARI CERAH,39010 KAMPUNG RAJA,CAMERON HIGHLANDS,PAHANG', '39010', 'TANAH RATA', 'MY', '0123946612', '', '', '000139415552', '2015-04-20 00:00:00'),
(25, 'FATHER', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-20 00:00:00'),
(26, 'ENG WEN WEI', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-21 00:00:00'),
(27, 'LOW LOI', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-24 00:00:00'),
(28, 'TAN KEN WAI', '', '-', '', '-', 'MY', '-', '', '', '', '2015-04-25 00:00:00'),
(29, 'GOODWILL FLOWER FARM', '', 'NO.9,TAMAN MATAHARI CEREH,CAMERON HIGHLANDS,39010 TANAH RATA,PAHANG', '39010', 'TANAH RATA', 'MY', '0195569996', '', '', '001626546176', '2015-04-29 00:00:00'),
(30, 'LOW NGAH MAN', '', '-', '39010', '-', 'MY', '-', '', '', '', '2015-05-05 00:00:00'),
(31, 'TAN CHUN HOWE', '', 'TRINGKAP', '', 'TANAH RATA', 'MY', '-', '', '', '', '2015-05-18 00:00:00'),
(32, 'AGRI STORM 2 SDN BHD', '859543-H', 'Lot F-140 Evergreen Villa 39200 Ringlet Cameron Highlands Pahang', '39200', 'Tanah Rata', 'MY', '054956606', '054956606', '', '001320026112', '2015-06-23 00:00:00'),
(33, 'AGRI STORM 3 SDN BHD', '1018825-U', 'SB-19 Lembah Bertam 39200 Ringlet Cameron Highlands Pahang', '39200', 'Tanah Rata', 'MY', '054956560', '054956560', '', '001336803328', '2015-06-23 00:00:00'),
(34, 'CHIN WEE KHENG', '', 'NO.14,Jalan Corina 10,Taman Desa Kampung Raja,39010 Cameron Highlands,Pahang.', '39010', 'TANAH RATA', 'MY', '0193917663', '', '', '000621023232', '2015-07-01 00:00:00');

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
  `gst` varchar(100) NOT NULL,
  `ssm` varchar(100) NOT NULL,
  `date_format` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ci_config`
--

INSERT INTO `ci_config` (`id`, `name`, `email`, `address`, `postal_code`, `fax`, `phone`, `website`, `currency`, `logo`, `gst`, `ssm`, `date_format`) VALUES
(1, 'Nick Fertilizer', 'kuohwan2138@hotmail.com', 'No.3, Taman Corina, 39010 Kg Raja, Cameron Highlands, Pahang ,Malaysia', '39010', '', '019-590 9138', '', 'RM', 'logo.jpg', '000285663232', 'IP0358197-W', 'd-m-Y');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ci_invoices`
--

INSERT INTO `ci_invoices` (`invoice_id`, `user_id`, `client_id`, `invoice_status`, `invoice_number`, `invoice_discount`, `invoice_terms`, `invoice_due_date`, `invoice_date_created`) VALUES
(1, 1, 1, 'UNPAID', '1', 10, '', '2015-03-23 00:00:00', '2015-03-23');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ci_invoice_items`
--

INSERT INTO `ci_invoice_items` (`item_id`, `invoice_id`, `item_quantity`, `item_description`, `item_taxrate_id`, `item_order`, `item_name`, `item_price`, `item_discount`) VALUES
(1, 1, '1.00', 'Thisis is 10KG Baja', 1, 1, 'Baja A 10KG', '250.00', 50),
(2, 1, '6.00', 'Baja A 50KG', 1, 2, 'Baja A 50KG', '500.00', 140);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ci_payments`
--

INSERT INTO `ci_payments` (`payment_id`, `invoice_id`, `payment_method_id`, `payment_amount`, `payment_note`, `payment_date`) VALUES
(1, 5, 1, '200.00', 'Testing', '2015-03-28'),
(2, 1, 1, '3604.00', 'Paid', '2015-04-01'),
(3, 3, 2, '5533.00', 'CIMB 000227 10/01/2015', '2015-04-02'),
(4, 180, 2, '3922.00', 'MBB 035334', '2015-07-06');

-- --------------------------------------------------------

--
-- Table structure for table `ci_payment_methods`
--

CREATE TABLE IF NOT EXISTS `ci_payment_methods` (
  `payment_method_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_method_name` varchar(255) NOT NULL,
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ci_payment_methods`
--

INSERT INTO `ci_payment_methods` (`payment_method_id`, `payment_method_name`) VALUES
(1, 'Cash'),
(2, 'Cheque'),
(3, 'Bank Transfered');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `ci_products`
--

INSERT INTO `ci_products` (`product_id`, `product_name`, `product_description`, `product_unitprice`) VALUES
(1, 'Tomato Fertilizer', 'Code T-10', '370.00'),
(2, 'Tomato Fertilizer', 'Code T-09', '345.00'),
(3, 'Tomato Fertilizer', 'Code T-08', '290.00'),
(4, 'Tomato Fertilizer', 'Code T-10N', '348.00'),
(5, 'Capsicum Fertilizer', 'Code C-10', '370.00'),
(7, 'Capsicum Fertilizer', 'Code C-09', '345.00'),
(8, 'Capsicum Fertilizer', 'Code C-08', '290.00'),
(9, 'Eggplant Fertilizer', 'Code E-10', '370.00'),
(10, 'Eggplant Fertilizer', 'Code E-09', '345.00'),
(11, 'Eggplant Fertilizer', 'Code E-08', '290.00'),
(12, 'STRAWBERRY FERTILIZER', 'CODE S-25', '190.00');

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
-- Table structure for table `ci_receipts`
--

CREATE TABLE IF NOT EXISTS `ci_receipts` (
  `receipt_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `receipt_status` enum('PAID','UNPAID','CANCELLED') NOT NULL DEFAULT 'UNPAID',
  `receipt_amount` decimal(10,2) NOT NULL,
  `receipt_number` varchar(50) NOT NULL,
  `receipt_terms` longtext NOT NULL,
  `receipt_date_created` date NOT NULL,
  PRIMARY KEY (`receipt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ci_receipts`
--

INSERT INTO `ci_receipts` (`receipt_id`, `user_id`, `client_id`, `receipt_status`, `receipt_amount`, `receipt_number`, `receipt_terms`, `receipt_date_created`) VALUES
(1, 1, 2, 'PAID', '12.00', '1', 'Test', '2015-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `ci_staffs`
--

CREATE TABLE IF NOT EXISTS `ci_staffs` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_name` varchar(100) NOT NULL,
  `staff_phone` varchar(100) NOT NULL,
  `staff_date_created` datetime NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ci_staffs`
--

INSERT INTO `ci_staffs` (`staff_id`, `staff_name`, `staff_phone`, `staff_date_created`) VALUES
(1, 'Amin', '', '2015-04-28 00:00:00'),
(2, 'NOIHI', '', '2015-04-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_stocks`
--

CREATE TABLE IF NOT EXISTS `ci_stocks` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `stock_status` enum('STOCK_IN','STOCK_OUT') NOT NULL DEFAULT 'STOCK_IN',
  `stock_number` varchar(50) NOT NULL,
  `stock_amount` decimal(10,2) NOT NULL,
  `stock_terms` longtext NOT NULL,
  `stock_date_created` date NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `ci_stocks`
--

INSERT INTO `ci_stocks` (`stock_id`, `user_id`, `stock_status`, `stock_number`, `stock_amount`, `stock_terms`, `stock_date_created`) VALUES
(1, 2, 'STOCK_IN', '1', '11829.60', '10041500219', '2015-04-07'),
(2, 2, 'STOCK_IN', '2', '2703.00', 'IV-00066', '2015-04-12'),
(3, 2, 'STOCK_IN', '3', '12084.00', 'INV1504/0059', '2015-04-15'),
(4, 2, 'STOCK_IN', '4', '1971.60', 'CS1504/0560', '2015-04-18'),
(5, 2, 'STOCK_IN', '5', '22896.00', '233', '2015-04-22'),
(6, 2, 'STOCK_IN', '6', '9460.50', '234', '2015-04-22'),
(7, 2, 'STOCK_IN', '7', '12889.60', '10041501096', '2015-04-28'),
(8, 2, 'STOCK_IN', '8', '11575.20', 'CS1505/0350', '2015-05-07'),
(9, 2, 'STOCK_IN', '9', '18020.00', '10051500346', '2015-05-08'),
(10, 2, 'STOCK_IN', '10', '7208.00', '11051500567', '2015-05-11'),
(11, 2, 'STOCK_IN', '11', '45.79', '11051500626', '2015-05-12'),
(12, 2, 'STOCK_IN', '12', '32902.40', '515', '2015-05-13'),
(13, 2, 'STOCK_IN', '13', '1038.80', '11051500780', '2015-05-14'),
(14, 2, 'STOCK_IN', '14', '18825.60', '564', '2015-05-15'),
(15, 2, 'STOCK_IN', '15', '805.60', 'T000948', '2015-05-16'),
(16, 2, 'STOCK_IN', '16', '5406.00', '11051500977', '2015-05-17'),
(17, 2, 'STOCK_IN', '17', '296.80', 'CS1505/0747', '2015-05-21'),
(18, 2, 'STOCK_IN', '18', '304.75', '670', '2015-05-22'),
(19, 2, 'STOCK_IN', '19', '5172.80', '10051500966', '2015-05-22'),
(20, 2, 'STOCK_IN', '20', '393.26', 'OCS32984', '2015-05-28'),
(21, 2, 'STOCK_IN', '21', '9565.44', 'CS1501/1620', '2015-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `ci_tax_invoices`
--

CREATE TABLE IF NOT EXISTS `ci_tax_invoices` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=187 ;

--
-- Dumping data for table `ci_tax_invoices`
--

INSERT INTO `ci_tax_invoices` (`invoice_id`, `user_id`, `client_id`, `invoice_status`, `invoice_number`, `invoice_discount`, `invoice_terms`, `invoice_due_date`, `invoice_date_created`) VALUES
(1, 1, 4, 'PAID', '1', 0, '', '1970-01-01 00:00:00', '2015-04-01'),
(2, 1, 3, 'PAID', '2', 0, '', '1970-01-01 00:00:00', '2015-04-01'),
(3, 1, 2, 'PAID', '3', 0.2, '', '1970-01-01 00:00:00', '2015-04-02'),
(4, 1, 11, 'PAID', '4', 0, '', '1970-01-01 00:00:00', '2015-04-03'),
(5, 2, 11, 'PAID', '5', 0, '', '1970-01-01 00:00:00', '2015-04-03'),
(6, 2, 9, 'UNPAID', '6', 0, '', '1970-01-01 00:00:00', '2015-04-06'),
(7, 2, 8, 'PAID', '7', 0, '', '1970-01-01 00:00:00', '2015-04-06'),
(8, 2, 10, 'PAID', '8', 0, '', '1970-01-01 00:00:00', '2015-04-07'),
(9, 2, 12, 'PAID', '9', 0, '', '1970-01-01 00:00:00', '2015-04-07'),
(10, 2, 13, 'PAID', '10', 0, '', '1970-01-01 00:00:00', '2015-04-07'),
(11, 2, 1, 'PAID', '11', 0, '', '1970-01-01 00:00:00', '2015-04-07'),
(12, 2, 2, 'PAID', '12', 0, '', '1970-01-01 00:00:00', '2015-04-07'),
(13, 2, 8, 'PAID', '13', 0, '', '1970-01-01 00:00:00', '2015-04-08'),
(14, 2, 14, 'PAID', '14', 0, '', '1970-01-01 00:00:00', '2015-04-08'),
(15, 2, 15, 'PAID', '15', 0, '', '1970-01-01 00:00:00', '2015-04-08'),
(16, 1, 16, 'PAID', '16', 0, '', '1970-01-01 00:00:00', '2015-04-10'),
(17, 2, 17, 'PAID', '17', 0, '', '1970-01-01 00:00:00', '2015-04-10'),
(18, 2, 18, 'PAID', '18', 0, '', '1970-01-01 00:00:00', '2015-04-13'),
(19, 2, 8, 'PAID', '19', 0, '', '1970-01-01 00:00:00', '2015-04-15'),
(20, 2, 19, 'PAID', '20', 0, '', '1970-01-01 00:00:00', '2015-04-15'),
(21, 2, 20, 'PAID', '21', 0, '', '1970-01-01 00:00:00', '2015-04-16'),
(22, 2, 1, 'PAID', '22', 0, '', '1970-01-01 00:00:00', '2015-04-16'),
(23, 2, 1, 'PAID', '23', 0, '', '1970-01-01 00:00:00', '2015-04-16'),
(24, 2, 8, 'PAID', '24', 0, '', '1970-01-01 00:00:00', '2015-04-16'),
(25, 2, 3, 'PAID', '25', 0, '', '1970-01-01 00:00:00', '2015-04-17'),
(26, 2, 21, 'PAID', '26', 0, '', '1970-01-01 00:00:00', '2015-04-17'),
(27, 2, 22, 'PAID', '27', 0, '', '1970-01-01 00:00:00', '2015-04-18'),
(28, 2, 2, 'PAID', '28', 0, '', '1970-01-01 00:00:00', '2015-04-19'),
(29, 2, 1, 'PAID', '29', 0, 'RUMAH', '1970-01-01 00:00:00', '2015-04-19'),
(30, 2, 8, 'PAID', '30', 0, '', '1970-01-01 00:00:00', '2015-04-20'),
(31, 2, 24, 'PAID', '31', 0, '', '1970-01-01 00:00:00', '2015-04-20'),
(32, 2, 25, 'UNPAID', '32', 0, '', '1970-01-01 00:00:00', '2015-04-20'),
(33, 2, 15, 'PAID', '33', 0, '', '1970-01-01 00:00:00', '2015-04-20'),
(34, 2, 14, 'PAID', '34', 0, '', '1970-01-01 00:00:00', '2015-04-20'),
(35, 2, 23, 'PAID', '35', 0, '', '1970-01-01 00:00:00', '2015-04-20'),
(36, 2, 8, 'PAID', '36', 0, '', '1970-01-01 00:00:00', '2015-04-20'),
(37, 2, 9, 'UNPAID', '37', 0, '', '1970-01-01 00:00:00', '2015-04-22'),
(38, 2, 11, 'PAID', '38', 0, '', '1970-01-01 00:00:00', '2015-04-23'),
(39, 2, 8, 'PAID', '39', 0, '', '1970-01-01 00:00:00', '2015-04-23'),
(40, 2, 27, 'PAID', '40', 0, '', '1970-01-01 00:00:00', '2015-04-24'),
(41, 2, 1, 'PAID', '41', 0, 'KOLAM', '1970-01-01 00:00:00', '2015-04-25'),
(42, 2, 13, 'PAID', '42', 0, '', '1970-01-01 00:00:00', '2015-04-25'),
(43, 2, 4, 'PAID', '43', 0, '', '1970-01-01 00:00:00', '2015-04-25'),
(44, 2, 8, 'PAID', '44', 0, '', '1970-01-01 00:00:00', '2015-04-25'),
(45, 2, 5, 'UNPAID', '45', 0, '', '1970-01-01 00:00:00', '2015-04-25'),
(46, 2, 2, 'PAID', '46', 0, '', '1970-01-01 00:00:00', '2015-04-25'),
(47, 2, 15, 'PAID', '47', 0, '', '1970-01-01 00:00:00', '2015-04-26'),
(48, 2, 8, 'PAID', '48', 0, '', '1970-01-01 00:00:00', '2015-04-28'),
(49, 2, 29, 'UNPAID', '49', 0, '', '1970-01-01 00:00:00', '2015-04-29'),
(50, 2, 8, 'PAID', '50', 0, '', '1970-01-01 00:00:00', '2015-04-29'),
(51, 2, 23, 'PAID', '51', 0, '', '1970-01-01 00:00:00', '2015-04-30'),
(52, 2, 15, 'PAID', '52', 0, '', '1970-01-01 00:00:00', '2015-04-30'),
(53, 2, 15, 'PAID', '53', 0, '', '1970-01-01 00:00:00', '2015-05-02'),
(54, 2, 2, 'PAID', '54', 0, '', '1970-01-01 00:00:00', '2015-05-04'),
(55, 2, 29, 'UNPAID', '55', 0, '', '1970-01-01 00:00:00', '2015-05-04'),
(56, 2, 30, 'PAID', '56', 0, '', '1970-01-01 00:00:00', '2015-05-05'),
(57, 2, 8, 'PAID', '57', 0, '', '1970-01-01 00:00:00', '2015-05-05'),
(58, 2, 3, 'PAID', '58', 0, '', '1970-01-01 00:00:00', '2015-05-05'),
(59, 2, 23, 'PAID', '59', 0, '', '1970-01-01 00:00:00', '2015-05-06'),
(60, 2, 5, 'UNPAID', '60', 0, 'Tiong Trading', '1970-01-01 00:00:00', '2015-05-07'),
(61, 2, 13, 'PAID', '61', 0, '', '1970-01-01 00:00:00', '2015-05-07'),
(62, 2, 1, 'PAID', '62', 0, '', '1970-01-01 00:00:00', '2015-05-09'),
(63, 2, 5, 'UNPAID', '63', 0, 'BOON TEIK', '1970-01-01 00:00:00', '2015-05-10'),
(64, 2, 30, 'PAID', '64', 0, '', '1970-01-01 00:00:00', '2015-05-10'),
(65, 2, 8, 'PAID', '65', 0, '', '1970-01-01 00:00:00', '2015-05-11'),
(66, 2, 23, 'PAID', '66', 0, '', '1970-01-01 00:00:00', '2015-05-11'),
(67, 2, 5, 'UNPAID', '67', 0, '', '1970-01-01 00:00:00', '2015-05-12'),
(68, 2, 5, 'UNPAID', '68', 0, '', '1970-01-01 00:00:00', '2015-05-12'),
(69, 2, 8, 'PAID', '69', 0, '', '1970-01-01 00:00:00', '2015-05-12'),
(70, 2, 7, 'PAID', '70', 0, '', '1970-01-01 00:00:00', '2015-05-12'),
(71, 2, 23, 'PAID', '71', 0, '', '1970-01-01 00:00:00', '2015-05-13'),
(72, 2, 19, 'PAID', '72', 0, '', '1970-01-01 00:00:00', '2015-05-13'),
(73, 2, 11, 'UNPAID', '73', 0, '2692.4', '1970-01-01 00:00:00', '2015-05-14'),
(74, 2, 15, 'PAID', '74', 0, '', '1970-01-01 00:00:00', '2015-05-14'),
(75, 2, 2, 'PAID', '75', 0, '', '1970-01-01 00:00:00', '2015-05-15'),
(76, 2, 5, 'PAID', '76', 0, '', '1970-01-01 00:00:00', '2015-05-17'),
(77, 2, 15, 'PAID', '77', 0, '', '1970-01-01 00:00:00', '2015-05-18'),
(78, 2, 14, 'PAID', '78', 0, '', '1970-01-01 00:00:00', '2015-05-19'),
(79, 2, 31, 'UNPAID', '79', 0, '', '1970-01-01 00:00:00', '2015-05-19'),
(80, 2, 4, 'PAID', '80', 0, '', '1970-01-01 00:00:00', '2015-05-19'),
(81, 2, 20, 'PAID', '81', 0, '', '1970-01-01 00:00:00', '2015-05-19'),
(82, 2, 5, 'UNPAID', '82', 0, '', '1970-01-01 00:00:00', '2015-05-19'),
(83, 2, 8, 'PAID', '83', 0, '', '1970-01-01 00:00:00', '2015-05-19'),
(84, 2, 5, 'UNPAID', '84', 0, 'WAI LUN', '1970-01-01 00:00:00', '2015-05-20'),
(85, 2, 5, 'UNPAID', '85', 0, 'WEI(49)', '1970-01-01 00:00:00', '2015-05-22'),
(86, 2, 23, 'PAID', '86', 0, '', '1970-01-01 00:00:00', '2015-05-22'),
(87, 2, 13, 'PAID', '87', 0, '', '1970-01-01 00:00:00', '2015-05-22'),
(88, 2, 14, 'PAID', '88', 0, '', '1970-01-01 00:00:00', '2015-05-22'),
(89, 2, 23, 'PAID', '89', 0, '', '1970-01-01 00:00:00', '2015-05-23'),
(90, 2, 8, 'PAID', '90', 0, '', '1970-01-01 00:00:00', '2015-05-23'),
(91, 2, 2, 'PAID', '91', 0, '', '1970-01-01 00:00:00', '2015-05-23'),
(92, 2, 1, 'PAID', '92', 0, 'last', '1970-01-01 00:00:00', '2015-05-23'),
(93, 2, 1, 'PAID', '93', 0, 'FLOWER', '1970-01-01 00:00:00', '2015-05-23'),
(94, 2, 8, 'PAID', '94', 0, '', '1970-01-01 00:00:00', '2015-05-25'),
(95, 2, 1, 'PAID', '95', 0, '', '1970-01-01 00:00:00', '2015-05-24'),
(96, 2, 30, 'PAID', '96', 0, '', '1970-01-01 00:00:00', '2015-05-25'),
(97, 2, 15, 'PAID', '97', 0, '', '1970-01-01 00:00:00', '2015-05-25'),
(98, 2, 18, 'PAID', '98', 0, '', '1970-01-01 00:00:00', '2015-05-28'),
(99, 2, 10, 'UNPAID', '99', 0, '', '1970-01-01 00:00:00', '2015-05-28'),
(100, 2, 7, 'UNPAID', '100', 0, '', '1970-01-01 00:00:00', '2015-05-29'),
(101, 2, 4, 'PAID', '101', 0, '', '1970-01-01 00:00:00', '2015-05-29'),
(102, 2, 8, 'PAID', '102', 0, '', '1970-01-01 00:00:00', '2015-05-29'),
(103, 2, 7, 'UNPAID', '103', 0, '', '1970-01-01 00:00:00', '2015-05-31'),
(104, 2, 2, 'PAID', '104', 0, '', '1970-01-01 00:00:00', '2015-05-31'),
(105, 2, 7, 'UNPAID', '105', 90, '', '1970-01-01 00:00:00', '2015-05-31'),
(106, 2, 30, 'PAID', '106', 0, '', '1970-01-01 00:00:00', '2015-06-01'),
(107, 2, 5, 'UNPAID', '107', 0, '', '1970-01-01 00:00:00', '2015-06-01'),
(108, 2, 15, 'UNPAID', '108', 0, '', '1970-01-01 00:00:00', '2015-06-01'),
(109, 2, 1, 'UNPAID', '109', 0, '', '1970-01-01 00:00:00', '2015-06-02'),
(110, 2, 5, 'UNPAID', '110', 0, '', '1970-01-01 00:00:00', '2015-06-03'),
(111, 2, 5, 'UNPAID', '111', 0, '', '1970-01-01 00:00:00', '2015-06-03'),
(112, 2, 13, 'UNPAID', '112', 0, '', '1970-01-01 00:00:00', '2015-06-04'),
(113, 2, 3, 'PAID', '113', 0, '', '1970-01-01 00:00:00', '2015-06-04'),
(114, 2, 29, 'UNPAID', '114', 0, '', '1970-01-01 00:00:00', '2015-06-04'),
(115, 2, 12, 'PAID', '115', 0, '', '1970-01-01 00:00:00', '2015-06-05'),
(116, 2, 14, 'PAID', '116', 0, '', '1970-01-01 00:00:00', '2015-06-05'),
(117, 2, 14, 'PAID', '117', 0, '', '1970-01-01 00:00:00', '2015-06-05'),
(118, 2, 13, 'UNPAID', '118', 0, '', '1970-01-01 00:00:00', '2015-06-05'),
(119, 2, 3, 'PAID', '119', 0, '', '1970-01-01 00:00:00', '2015-06-05'),
(120, 2, 27, 'PAID', '120', 0, '', '1970-01-01 00:00:00', '2015-06-06'),
(121, 2, 10, 'UNPAID', '121', 0, '', '1970-01-01 00:00:00', '2015-06-07'),
(122, 2, 19, 'UNPAID', '122', 0, '', '1970-01-01 00:00:00', '2015-06-07'),
(123, 2, 5, 'UNPAID', '123', 0, '', '1970-01-01 00:00:00', '2015-06-07'),
(124, 2, 8, 'UNPAID', '124', 0, '', '1970-01-01 00:00:00', '2015-06-07'),
(125, 2, 34, 'UNPAID', '125', 0, '', '1970-01-01 00:00:00', '2015-06-08'),
(126, 2, 15, 'UNPAID', '126', 0, '', '1970-01-01 00:00:00', '2015-06-08'),
(127, 2, 2, 'PAID', '127', 0, '', '1970-01-01 00:00:00', '2015-06-10'),
(128, 2, 5, 'UNPAID', '128', 0, '', '1970-01-01 00:00:00', '2015-06-10'),
(129, 2, 7, 'UNPAID', '129', 0, '', '1970-01-01 00:00:00', '2015-06-10'),
(130, 2, 9, 'UNPAID', '130', 0, '', '1970-01-01 00:00:00', '2015-06-10'),
(131, 2, 15, 'UNPAID', '131', 0, '', '1970-01-01 00:00:00', '2015-06-12'),
(132, 2, 23, 'PAID', '132', 0, '', '1970-01-01 00:00:00', '2015-06-13'),
(133, 2, 18, 'PAID', '133', 0, '', '1970-01-01 00:00:00', '2015-06-15'),
(134, 2, 15, 'UNPAID', '134', 0, '', '1970-01-01 00:00:00', '2015-06-15'),
(135, 2, 8, 'UNPAID', '135', 0, '', '1970-01-01 00:00:00', '2015-06-15'),
(136, 2, 5, 'UNPAID', '136', 0, '', '1970-01-01 00:00:00', '2015-06-17'),
(137, 2, 29, 'UNPAID', '137', 0, '', '1970-01-01 00:00:00', '2015-06-17'),
(138, 2, 1, 'UNPAID', '138', 0, '', '1970-01-01 00:00:00', '2015-06-17'),
(139, 2, 2, 'PAID', '139', 0, '', '1970-01-01 00:00:00', '2015-06-17'),
(140, 2, 15, 'UNPAID', '140', 0, '', '1970-01-01 00:00:00', '2015-06-18'),
(141, 2, 1, 'UNPAID', '141', 0, '', '1970-01-01 00:00:00', '2015-06-18'),
(142, 2, 8, 'UNPAID', '142', 0, '', '1970-01-01 00:00:00', '2015-06-18'),
(143, 2, 7, 'UNPAID', '143', 0, '', '1970-01-01 00:00:00', '2015-06-18'),
(144, 2, 6, 'PAID', '144', 0, '', '1970-01-01 00:00:00', '2015-06-19'),
(145, 2, 5, 'PAID', '145', 0, '', '1970-01-01 00:00:00', '2015-06-21'),
(146, 2, 27, 'PAID', '146', 0, '', '1970-01-01 00:00:00', '2015-06-21'),
(147, 2, 14, 'PAID', '147', 0, '', '1970-01-01 00:00:00', '2015-06-21'),
(148, 2, 13, 'UNPAID', '148', 0, '', '1970-01-01 00:00:00', '2015-06-21'),
(149, 2, 5, 'UNPAID', '149', 0, 'weilun', '1970-01-01 00:00:00', '2015-06-22'),
(150, 2, 5, 'PAID', '150', 0, 'kuanhu', '1970-01-01 00:00:00', '2015-06-22'),
(151, 2, 11, 'UNPAID', '151', 0, '', '1970-01-01 00:00:00', '2015-06-22'),
(152, 2, 4, 'PAID', '152', 0, '', '1970-01-01 00:00:00', '2015-06-22'),
(153, 2, 30, 'PAID', '153', 0, '', '1970-01-01 00:00:00', '2015-06-22'),
(154, 2, 3, 'PAID', '154', 0, '', '1970-01-01 00:00:00', '2015-06-23'),
(155, 2, 15, 'UNPAID', '155', 0, '', '1970-01-01 00:00:00', '2015-06-23'),
(156, 2, 8, 'UNPAID', '156', 0, '', '1970-01-01 00:00:00', '2015-06-24'),
(157, 2, 32, 'UNPAID', '157', 0, '', '1970-01-01 00:00:00', '2015-06-24'),
(158, 2, 33, 'UNPAID', '158', 0, '', '1970-01-01 00:00:00', '2015-06-24'),
(159, 2, 21, 'UNPAID', '159', 0, '', '1970-01-01 00:00:00', '2015-06-24'),
(160, 2, 29, 'PAID', '160', 0, '', '1970-01-01 00:00:00', '2015-06-26'),
(161, 2, 8, 'UNPAID', '161', 0, '', '1970-01-01 00:00:00', '2015-06-26'),
(162, 2, 5, 'UNPAID', '162', 0, '', '1970-01-01 00:00:00', '2015-06-26'),
(163, 2, 26, 'PAID', '163', 0, '', '1970-01-01 00:00:00', '2015-06-27'),
(164, 2, 2, 'PAID', '164', 0, '', '1970-01-01 00:00:00', '2015-06-28'),
(165, 2, 15, 'UNPAID', '165', 0, '', '1970-01-01 00:00:00', '2015-06-28'),
(166, 2, 8, 'UNPAID', '166', 0, '', '1970-01-01 00:00:00', '2015-06-28'),
(167, 2, 1, 'UNPAID', '167', 0, '', '1970-01-01 00:00:00', '2015-06-29'),
(168, 2, 1, 'UNPAID', '168', 0, '', '1970-01-01 00:00:00', '2015-06-29'),
(169, 2, 29, 'UNPAID', '169', 0, '', '1970-01-01 00:00:00', '2015-06-29'),
(170, 2, 5, 'UNPAID', '170', 0, 'hua49', '1970-01-01 00:00:00', '2015-06-30'),
(171, 2, 5, 'UNPAID', '171', 0, 'poh', '1970-01-01 00:00:00', '2015-06-30'),
(172, 2, 22, 'UNPAID', '172', 0, '', '1970-01-01 00:00:00', '2015-06-30'),
(173, 2, 15, 'UNPAID', '173', 0, '', '1970-01-01 00:00:00', '2015-07-01'),
(174, 2, 8, 'UNPAID', '174', 0, '', '1970-01-01 00:00:00', '2015-07-01'),
(175, 2, 34, 'UNPAID', '175', 0, '', '1970-01-01 00:00:00', '2015-07-01'),
(176, 2, 3, 'UNPAID', '176', 0, '', '1970-01-01 00:00:00', '2015-07-03'),
(177, 2, 27, 'UNPAID', '177', 0, '', '1970-01-01 00:00:00', '2015-07-04'),
(178, 2, 10, 'UNPAID', '178', 0, '', '1970-01-01 00:00:00', '2015-07-05'),
(179, 2, 2, 'UNPAID', '179', 0, '', '1970-01-01 00:00:00', '2015-07-05'),
(180, 2, 14, 'PAID', '180', 0, '', '1970-01-01 00:00:00', '2015-07-06'),
(181, 2, 3, 'UNPAID', '181', 0, '', '1970-01-01 00:00:00', '2015-07-07'),
(182, 2, 1, 'UNPAID', '182', 0, '', '1970-01-01 00:00:00', '2015-07-07'),
(183, 2, 18, 'UNPAID', '183', 0, '', '1970-01-01 00:00:00', '2015-07-08'),
(184, 2, 13, 'UNPAID', '184', 0, '', '1970-01-01 00:00:00', '2015-07-08'),
(185, 2, 5, 'UNPAID', '185', 0, '', '1970-01-01 00:00:00', '2015-07-08'),
(186, 2, 15, 'UNPAID', '186', 0, '', '1970-01-01 00:00:00', '2015-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `ci_tax_invoice_items`
--

CREATE TABLE IF NOT EXISTS `ci_tax_invoice_items` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=233 ;

--
-- Dumping data for table `ci_tax_invoice_items`
--

INSERT INTO `ci_tax_invoice_items` (`item_id`, `invoice_id`, `item_quantity`, `item_description`, `item_taxrate_id`, `item_order`, `item_name`, `item_price`, `item_discount`) VALUES
(19, 1, '10.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 50),
(20, 3, '15.00', 'Code T-10N', 1, 1, 'Tomato Fertilizer', '348.00', 0),
(21, 2, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(22, 4, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(23, 5, '2.00', 'Code C-09', 1, 1, 'Capsicum Fertilizer', '345.00', 0),
(26, 6, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(27, 7, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 5),
(28, 8, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(30, 9, '1.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(31, 10, '4.00', 'CODE S-25', 1, 1, 'STRAWBERRY FERTILIZER', '190.00', 0),
(32, 11, '15.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(34, 12, '15.00', 'Code T-10N', 1, 1, 'Tomato Fertilizer', '348.00', 0),
(35, 13, '15.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 75),
(36, 13, '5.00', 'Code T-09', 1, 2, 'Tomato Fertilizer', '345.00', 25),
(37, 14, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(38, 15, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(39, 16, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(40, 17, '1.00', 'Code T-2.5', 1, 1, 'Tomato Fertilizer', '100.00', 0),
(41, 17, '1.00', 'Code T-10', 1, 2, 'Iceberg Fertilizer', '250.00', 0),
(42, 18, '3.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(43, 19, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 25),
(44, 20, '2.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(45, 21, '5.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(46, 22, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(47, 23, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(48, 24, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 25),
(49, 25, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(50, 26, '1.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(51, 27, '1.00', 'Code C-09', 1, 1, 'Capsicum Fertilizer', '345.00', 0),
(52, 28, '15.00', 'Code T-10N', 1, 1, 'Tomato Fertilizer', '348.00', 0),
(53, 29, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(54, 30, '5.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 25),
(55, 31, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(56, 32, '2.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(57, 33, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(58, 34, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(59, 35, '5.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(60, 36, '2.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 10),
(61, 37, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(62, 38, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(63, 39, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 25),
(64, 40, '10.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 50),
(65, 41, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(66, 42, '2.00', 'CODE S-25', 1, 1, 'STRAWBERRY FERTILIZER', '190.00', 0),
(67, 43, '10.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(68, 44, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 25),
(69, 45, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(70, 46, '15.00', 'Code T-10N', 1, 1, 'Tomato Fertilizer', '348.00', 0),
(71, 47, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(72, 48, '5.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 25),
(74, 49, '4.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(75, 50, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 25),
(76, 51, '5.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(77, 52, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(78, 53, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(79, 54, '15.00', 'Code T-10N', 1, 1, 'Tomato Fertilizer', '348.00', 0),
(80, 55, '2.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(81, 56, '11.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 55),
(82, 57, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 25),
(83, 57, '5.00', 'Code T-09', 1, 2, 'Tomato Fertilizer', '345.00', 25),
(84, 57, '3.00', 'Code C-09', 1, 3, 'Capsicum Fertilizer', '345.00', 15),
(85, 58, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(86, 59, '5.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(87, 60, '1.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(88, 61, '2.00', 'CODE S-25', 1, 1, 'STRAWBERRY FERTILIZER', '190.00', 0),
(89, 62, '15.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(90, 63, '2.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(91, 64, '10.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 50),
(92, 65, '6.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 30),
(93, 66, '5.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(94, 67, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(95, 68, '10.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(96, 69, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 25),
(97, 69, '5.00', 'Code T-09', 1, 2, 'Tomato Fertilizer', '345.00', 25),
(98, 70, '5.00', 'Code C-09', 1, 1, 'Capsicum Fertilizer', '345.00', 150),
(99, 71, '5.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(100, 72, '2.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(101, 73, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(102, 73, '3.00', 'Code C-09', 1, 2, 'Capsicum Fertilizer', '345.00', 0),
(103, 74, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(104, 75, '15.00', 'Code T-10N', 1, 1, 'Tomato Fertilizer', '348.00', 0),
(105, 76, '2.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(106, 77, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(107, 78, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(108, 79, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(109, 80, '6.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(110, 81, '5.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(111, 82, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(112, 83, '10.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 50),
(113, 84, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(114, 85, '2.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(115, 86, '5.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(116, 87, '2.00', 'CODE S-25', 1, 1, 'STRAWBERRY FERTILIZER', '190.00', 0),
(117, 88, '1.00', 'CODE S-25', 1, 1, 'STRAWBERRY FERTILIZER', '190.00', 0),
(118, 89, '5.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(119, 90, '10.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 50),
(120, 91, '15.00', 'Code T-10N', 1, 1, 'Tomato Fertilizer', '348.00', 0),
(121, 92, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(122, 93, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(123, 94, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 25),
(124, 95, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(125, 96, '10.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 50),
(126, 97, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(127, 98, '5.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(128, 99, '1.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(129, 100, '5.00', 'Code C-09', 1, 1, 'Capsicum Fertilizer', '345.00', 150),
(130, 101, '10.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(131, 102, '10.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 50),
(132, 103, '8.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 240),
(133, 104, '15.00', 'Code T-10N', 1, 1, 'Tomato Fertilizer', '348.00', 0),
(134, 105, '3.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 90),
(135, 106, '10.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 50),
(136, 107, '8.00', 'Code C-09', 1, 1, 'Capsicum Fertilizer', '345.00', 0),
(137, 108, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(138, 109, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(139, 110, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(140, 110, '3.00', 'Code C-09', 1, 2, 'Capsicum Fertilizer', '345.00', 0),
(141, 111, '3.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(142, 112, '1.00', 'CODE S-25', 1, 1, 'STRAWBERRY FERTILIZER', '190.00', 0),
(143, 113, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(144, 114, '2.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(146, 115, '1.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(147, 116, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(148, 117, '3.00', 'CODE S-25', 1, 1, 'STRAWBERRY FERTILIZER', '190.00', 0),
(149, 118, '1.00', 'CODE S-25', 1, 1, 'STRAWBERRY FERTILIZER', '190.00', 0),
(150, 119, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(151, 120, '10.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 50),
(152, 121, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(153, 122, '3.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(154, 123, '2.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(155, 124, '10.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 50),
(156, 125, '10.00', 'Code T-08', 1, 1, 'Tomato Fertilizer', '290.00', 0),
(157, 126, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(159, 128, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(160, 129, '5.00', 'Code C-09', 1, 1, 'Capsicum Fertilizer', '345.00', 150),
(161, 129, '3.00', 'Code E-09', 1, 2, 'Eggplant Fertilizer', '345.00', 90),
(162, 130, '10.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(164, 127, '15.00', 'Code T-10N', 1, 1, 'Tomato Fertilizer', '348.00', 0),
(165, 131, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(166, 132, '5.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(167, 133, '6.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(168, 134, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(169, 135, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 25),
(170, 136, '10.00', 'Code T-08', 1, 1, 'Tomato Fertilizer', '290.00', 0),
(171, 137, '2.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(172, 138, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(173, 139, '15.00', 'Code T-10N', 1, 1, 'Tomato Fertilizer', '348.00', 0),
(174, 140, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(175, 141, '15.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 0),
(176, 142, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 25),
(177, 142, '10.00', 'Code T-09', 1, 2, 'Tomato Fertilizer', '345.00', 50),
(178, 143, '7.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 210),
(179, 143, '7.00', 'Code C-09', 1, 2, 'Capsicum Fertilizer', '345.00', 210),
(180, 143, '3.00', 'Code E-09', 1, 3, 'Eggplant Fertilizer', '345.00', 90),
(181, 144, '5.00', 'Code C-09', 1, 1, 'Capsicum Fertilizer', '345.00', 0),
(182, 144, '5.00', 'Code E-09', 1, 2, 'Eggplant Fertilizer', '345.00', 0),
(183, 145, '1.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(184, 146, '10.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 50),
(185, 147, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(186, 148, '2.00', 'CODE S-25', 1, 1, 'STRAWBERRY FERTILIZER', '190.00', 0),
(187, 149, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(188, 150, '1.00', 'Code C-09', 1, 1, 'Capsicum Fertilizer', '345.00', 0),
(189, 151, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(190, 151, '3.00', 'Code C-09', 1, 2, 'Capsicum Fertilizer', '345.00', 0),
(191, 152, '10.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(192, 153, '10.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 50),
(193, 154, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(194, 155, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(195, 156, '10.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 50),
(196, 157, '1.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 30),
(197, 157, '1.00', 'Code C-09', 1, 2, 'Capsicum Fertilizer', '345.00', 30),
(198, 157, '1.00', 'Code E-09', 1, 3, 'Eggplant Fertilizer', '345.00', 30),
(199, 158, '1.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 30),
(201, 158, '1.00', 'Code E-09', 1, 2, 'Eggplant Fertilizer', '345.00', 30),
(202, 158, '1.00', 'Code C-09', 1, 3, 'Capsicum Fertilizer', '345.00', 30),
(203, 159, '2.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(204, 160, '2.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(205, 161, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 25),
(206, 162, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(207, 163, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(208, 164, '15.00', 'Code T-10N', 1, 1, 'Tomato Fertilizer', '348.00', 0),
(209, 165, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(210, 166, '3.00', 'Code C-09', 1, 1, 'Capsicum Fertilizer', '345.00', 15),
(211, 167, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(212, 168, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(213, 169, '2.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(214, 170, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(215, 171, '2.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(216, 172, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(217, 173, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(218, 166, '5.00', 'Code T-10', 1, 2, 'Tomato Fertilizer', '370.00', 25),
(219, 174, '10.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 50),
(220, 175, '10.00', 'Code T-08', 1, 1, 'Tomato Fertilizer', '290.00', 0),
(221, 176, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(223, 177, '10.00', 'Code T-09', 1, 1, 'Tomato Fertilizer', '345.00', 50),
(224, 178, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(225, 179, '15.00', 'Code T-10N', 1, 1, 'Tomato Fertilizer', '348.00', 0),
(226, 180, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(227, 181, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(228, 182, '10.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(229, 183, '5.00', 'Code E-09', 1, 1, 'Eggplant Fertilizer', '345.00', 0),
(230, 184, '2.00', 'CODE S-25', 1, 1, 'STRAWBERRY FERTILIZER', '190.00', 0),
(231, 185, '1.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0),
(232, 186, '5.00', 'Code T-10', 1, 1, 'Tomato Fertilizer', '370.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ci_tax_rates`
--

CREATE TABLE IF NOT EXISTS `ci_tax_rates` (
  `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_rate_name` varchar(100) NOT NULL,
  `tax_rate_percent` decimal(5,2) NOT NULL,
  PRIMARY KEY (`tax_rate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ci_tax_rates`
--

INSERT INTO `ci_tax_rates` (`tax_rate_id`, `tax_rate_name`, `tax_rate_percent`) VALUES
(1, 'GST', '6.00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ci_users`
--

INSERT INTO `ci_users` (`user_id`, `first_name`, `last_name`, `user_email`, `user_phone`, `username`, `password`, `user_date_created`) VALUES
(1, 'admin', 'admin', 'pika564@hotmail.com', '', 'beebee1987', 'fd8fca90ed05d83e24bda699b7169f69bbf23e5a', '2015-03-23'),
(2, 'Nick', 'Tan', 'nicktan9138@gmail.com', '0195909138', 'nick', '15dd63ec20518c40720807881f40c5bc02fb87e8', '2015-03-24');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
