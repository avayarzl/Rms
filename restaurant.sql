-- phpMyAdmin SQL Dump
-- version 2.11.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2008 at 02:42 AM
-- Server version: 5.1.17
-- PHP Version: 5.2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `department_tbl`
--

CREATE TABLE IF NOT EXISTS `department_tbl` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(100) NOT NULL,
  `dept_head` varchar(75) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `department_tbl`
--

INSERT INTO `department_tbl` (`dept_id`, `dept_name`, `dept_head`) VALUES
(2, 'Cook', 'Prasham'),
(5, 'Kitchen', 'ANup raJ'),
(11, 'Bar', 'Bar');

-- --------------------------------------------------------

--
-- Table structure for table `dish_consumption_tbl`
--

CREATE TABLE IF NOT EXISTS `dish_consumption_tbl` (
  `dept_code` int(11) NOT NULL,
  `dish_code` varchar(10) NOT NULL,
  `prepared` int(11) NOT NULL,
  `date` date NOT NULL,
  `wastage` int(11) NOT NULL,
  `wastage_description` varchar(500) NOT NULL,
  PRIMARY KEY (`dish_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dish_consumption_tbl`
--

INSERT INTO `dish_consumption_tbl` (`dept_code`, `dish_code`, `prepared`, `date`, `wastage`, `wastage_description`) VALUES
(1, '1', 52, '2008-07-22', 52, '525252');

-- --------------------------------------------------------

--
-- Table structure for table `dish_ingredients_tbl`
--

CREATE TABLE IF NOT EXISTS `dish_ingredients_tbl` (
  `dish_code` int(11) NOT NULL,
  `item_code` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `cost` double NOT NULL,
  PRIMARY KEY (`dish_code`,`item_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dish_ingredients_tbl`
--

INSERT INTO `dish_ingredients_tbl` (`dish_code`, `item_code`, `quantity`, `cost`) VALUES
(46, 2, 10, 10),
(46, 3, 7, 20);

-- --------------------------------------------------------

--
-- Table structure for table `dish_master_tbl`
--

CREATE TABLE IF NOT EXISTS `dish_master_tbl` (
  `dish_code` int(11) NOT NULL AUTO_INCREMENT,
  `dish_name` varchar(150) NOT NULL,
  `serving` int(10) NOT NULL,
  `dept_code` int(10) NOT NULL,
  `sale_price` double NOT NULL,
  PRIMARY KEY (`dish_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `dish_master_tbl`
--

INSERT INTO `dish_master_tbl` (`dish_code`, `dish_name`, `serving`, `dept_code`, `sale_price`) VALUES
(1, 'white', 0, 1, 0),
(45, 'What', 5, 2, 0),
(46, 'dish1', 0, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employee_tbl`
--

CREATE TABLE IF NOT EXISTS `employee_tbl` (
  `emp_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(550) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `salary` double NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(75) NOT NULL,
  `join_date` date NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `employee_tbl`
--

INSERT INTO `employee_tbl` (`emp_id`, `name`, `designation`, `address`, `salary`, `telephone`, `mobile`, `email`, `join_date`) VALUES
(18, 'hari', 'hari', 'hari', 34500, '343434', '3093949', 'hari@hotmail.com', '2014-07-08');

-- --------------------------------------------------------

--
-- Table structure for table `issue_details_tbl`
--

CREATE TABLE IF NOT EXISTS `issue_details_tbl` (
  `issue_code` int(11) NOT NULL,
  `item_code` int(11) NOT NULL,
  `quantity` double NOT NULL,
  PRIMARY KEY (`issue_code`,`item_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issue_details_tbl`
--

INSERT INTO `issue_details_tbl` (`issue_code`, `item_code`, `quantity`) VALUES
(20, 2, 0),
(65, 1, 0),
(75, 1, 0),
(75, 2, 0),
(85, 1, 0),
(85, 2, 0),
(86, 2, 0),
(87, 2, 0),
(87, 3, 0),
(88, 1, 45),
(88, 2, 0),
(88, 3, 45),
(88, 5, 45),
(89, 1, 26),
(89, 2, 26),
(90, 1, 0),
(91, 2, 120),
(92, 2, 0),
(92, 3, 0),
(93, 2, 55),
(94, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `issue_master_tbl`
--

CREATE TABLE IF NOT EXISTS `issue_master_tbl` (
  `issue_code` int(11) NOT NULL AUTO_INCREMENT,
  `dept_code` int(11) NOT NULL,
  `issue_date` date NOT NULL,
  PRIMARY KEY (`issue_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `issue_master_tbl`
--

INSERT INTO `issue_master_tbl` (`issue_code`, `dept_code`, `issue_date`) VALUES
(20, 3, '2018-07-08'),
(65, 2, '2018-07-08'),
(75, 1, '2018-07-08'),
(85, 2, '2018-07-08'),
(86, 1, '2027-07-08'),
(87, 1, '2027-07-08'),
(88, 1, '2027-07-08'),
(89, 2, '2027-07-08'),
(90, 4, '2027-07-08'),
(91, 2, '2008-07-27'),
(92, 4, '2008-07-27'),
(93, 2, '2008-07-27'),
(94, 2, '2008-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `item_consumption_tbl`
--

CREATE TABLE IF NOT EXISTS `item_consumption_tbl` (
  `dept_code` int(11) NOT NULL,
  `item_code` int(11) NOT NULL,
  `date` date NOT NULL,
  `consumption` int(11) NOT NULL,
  `wastage` int(11) NOT NULL,
  `wastage_description` varchar(500) NOT NULL,
  PRIMARY KEY (`dept_code`,`item_code`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_consumption_tbl`
--

INSERT INTO `item_consumption_tbl` (`dept_code`, `item_code`, `date`, `consumption`, `wastage`, `wastage_description`) VALUES
(2, 1, '2008-07-22', 12, 12, '2215'),
(2, 2, '2008-07-22', 12, 12, '2215'),
(2, 2, '2008-07-27', 45, 20, 'what'),
(2, 3, '2008-07-22', 12, 12, '2215'),
(3, 2, '2008-07-22', 12, 12, '2215');

-- --------------------------------------------------------

--
-- Table structure for table `item_tbl`
--

CREATE TABLE IF NOT EXISTS `item_tbl` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `stock_qty` double NOT NULL,
  `reorder_lvl` double NOT NULL,
  `m_code` varchar(15) NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `item_tbl`
--

INSERT INTO `item_tbl` (`item_id`, `name`, `stock_qty`, `reorder_lvl`, `m_code`) VALUES
(1, 'Floor', 0, 34, 'kg'),
(2, 'meat', 0, 45, 'g'),
(3, 'CHicken', 0, 55, '3');

-- --------------------------------------------------------

--
-- Table structure for table `measurement_tbl`
--

CREATE TABLE IF NOT EXISTS `measurement_tbl` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_code` varchar(10) NOT NULL,
  `m_description` varchar(50) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `measurement_tbl`
--

INSERT INTO `measurement_tbl` (`m_id`, `m_code`, `m_description`) VALUES
(3, 'g', ''),
(4, 'kg', 'kilogram');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details_tbl`
--

CREATE TABLE IF NOT EXISTS `purchase_details_tbl` (
  `pur_code` varchar(10) NOT NULL,
  `item_code` int(11) NOT NULL,
  `quantity` double NOT NULL,
  `rate` double NOT NULL,
  PRIMARY KEY (`pur_code`,`item_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_details_tbl`
--

INSERT INTO `purchase_details_tbl` (`pur_code`, `item_code`, `quantity`, `rate`) VALUES
('21', 2, 10, 20),
('22', 1, 0, 0),
('23', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_master_tbl`
--

CREATE TABLE IF NOT EXISTS `purchase_master_tbl` (
  `pur_code` varchar(10) NOT NULL,
  `pur_date` date NOT NULL,
  PRIMARY KEY (`pur_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_master_tbl`
--

INSERT INTO `purchase_master_tbl` (`pur_code`, `pur_date`) VALUES
('21', '2019-07-08'),
('22', '2008-07-27'),
('23', '2008-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE IF NOT EXISTS `user_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `permission` varchar(1) NOT NULL,
  `real_name` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `username`, `password`, `permission`, `real_name`) VALUES
(1, 'rasd', '*F6DD0C0AC75395CB5BFC12C46B8880CD156B4799', '', 'sdf'),
(4, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'm', 'admin'),
(5, '', '', '', '');
