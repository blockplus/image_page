-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2017 at 09:41 AM
-- Server version: 5.5.58-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `search_engine`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advertise`
--

CREATE TABLE IF NOT EXISTS `tbl_advertise` (
  `ta_id` int(20) NOT NULL AUTO_INCREMENT,
  `ta_imagename` varchar(150) NOT NULL,
  `ta_info` varchar(255) NOT NULL,
  PRIMARY KEY (`ta_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_advertise`
--

INSERT INTO `tbl_advertise` (`ta_id`, `ta_imagename`, `ta_info`) VALUES
(19, '1509289481_ad1.png', 'ad1.png'),
(20, '1509289487_ad2.png', 'ad2.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE IF NOT EXISTS `tbl_bank` (
  `tb_id` int(20) NOT NULL AUTO_INCREMENT,
  `tb_image` varchar(150) NOT NULL,
  `tb_title` varchar(255) NOT NULL,
  `tb_desc` text NOT NULL,
  `tb_url` varchar(255) NOT NULL,
  PRIMARY KEY (`tb_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=107 ;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`tb_id`, `tb_image`, `tb_title`, `tb_desc`, `tb_url`) VALUES
(66, '1509625775_3.jpg', 'title3', 'description3', 'link3'),
(67, '1509625775_4.jpg', 'title4', 'description4', 'link4'),
(68, '1509625784_1.jpg', 'dd_new', 'dd', 'dd'),
(69, '1509625784_2.jpg', 'title2', 'description2', 'link2'),
(70, '1509625784_3.jpg', 'title3', 'description3', 'link3'),
(72, '1509625793_1.jpg', 'dd_new', 'dd', 'dd'),
(73, '1509625793_2.jpg', 'title2', 'description2', 'link2'),
(74, '1509625793_3.jpg', 'title3', 'description3', 'link3'),
(75, '1509625793_4.jpg', 'title4', 'description4', 'link4'),
(76, '1509625803_1.jpg', 'dd_new', 'dd', 'dd'),
(77, '1509625803_2.jpg', 'title2', 'description2', 'link2'),
(78, '1509625803_3.jpg', 'title3', 'description3', 'link3'),
(79, '1509625803_4.jpg', 'title4', 'description4', 'link4'),
(80, '1509625812_1.jpg', 'dd_new', 'dd', 'dd'),
(81, '1509625812_2.jpg', 'title2', 'description2', 'link2'),
(82, '1509625812_3.jpg', 'title3', 'description3', 'link3'),
(83, '1509625812_4.jpg', 'title4', 'description4', 'link4'),
(84, '1509625820_1.jpg', 'dd_new', 'dd', 'dd'),
(85, '1509625820_2.jpg', 'title2', 'description2', 'link2'),
(86, '1509625820_3.jpg', 'title3', 'description3', 'link3'),
(87, '1509625820_4.jpg', 'title4', 'description4', 'link4'),
(88, '1509625835_1.jpg', 'dd_new', 'dd', 'dd'),
(89, '1509625835_2.jpg', 'title2', 'description2', 'link2'),
(90, '1509625835_3.jpg', 'title3', 'description3', 'link3'),
(91, '1509625835_4.jpg', 'title4', 'description4', 'link4'),
(92, '1509626747_1.jpg', 'dd_new', 'dd', 'dd'),
(93, '1509626747_2.jpg', 'title2', 'description2', 'link2'),
(94, '1509626747_3.jpg', 'title3', 'description3', 'link3'),
(95, '1509626747_4.jpg', 'title4', 'description4', 'link4'),
(96, '1509626835_1.jpg', 'dd_new', 'dd', 'dd'),
(97, '1509626835_2.jpg', 'title2', 'description2', 'link2'),
(98, '1509626835_3.jpg', 'title3', 'description3', 'link3'),
(99, '1509626835_4.jpg', 'title4', 'description4', 'link4'),
(100, '1509626865_1.jpg', 'dd_new', 'dd', 'dd'),
(101, '1509626865_2.jpg', 'title2', 'description2', 'link2'),
(102, '1509626865_3.jpg', 'title3', 'description3', 'link3'),
(103, '1509626865_4.jpg', 'title4', 'description4', 'link4'),
(104, '1509635043_1.jpg', 'ds', 'sdfsdf', 'dsfsdfsdf'),
(105, '1509637506_image_0007.jpg', 'a', 'a', 'a'),
(106, '1509637564_image_0001.jpg', 'sd', 'sd', 'sd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contents`
--

CREATE TABLE IF NOT EXISTS `tbl_contents` (
  `tc_id` int(20) NOT NULL AUTO_INCREMENT,
  `tc_type` varchar(50) NOT NULL,
  `tc_content` text NOT NULL,
  PRIMARY KEY (`tc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_contents`
--

INSERT INTO `tbl_contents` (`tc_id`, `tc_type`, `tc_content`) VALUES
(7, 'about', 'as'),
(8, 'policy', 'asda'),
(9, 'contact', '22edds');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(64) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`users_id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_id`, `first_name`, `last_name`, `email`, `password`, `is_active`, `created_at`, `last_login`) VALUES
(1, 'Sam', 'Noreaksey', 'topdeveloper89@gmail.com', 'fad30a12fe77ae1efa7462b6aa0870b1ad8e8356', 1, '2017-10-26 12:15:26', '2017-11-02 12:12:43');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
