-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 06, 2016 at 01:46 AM
-- Server version: 5.5.49-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dblogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`fname`),
  KEY `name_2` (`fname`),
  KEY `user_id` (`user_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `fname`, `user_name`, `comment`) VALUES
(1, 'Le voyage Ã  travers limpossib', 'mng', 'this movie was good. I like this .');

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE IF NOT EXISTS `film` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `year` int(5) NOT NULL,
  `country` varchar(20) NOT NULL,
  `durationMinutes` int(5) NOT NULL,
  `director` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id`, `name`, `year`, `country`, `durationMinutes`, `director`) VALUES
(1, 'Easy Street', 1917, '24', 0, 'Charles Chaplin'),
(2, 'For Better, for Worse', 1919, '70', 0, 'Cecil B. DeMille'),
(5, 'est kinematograficheskogo oper', 1912, '12', 0, 'Wladyslaw Starewicz'),
(7, 'Le voyage Ã  travers limpossib', 1904, '24', 0, 'Georges MÃ©liÃ¨s'),
(8, 'a', 1234, '12', 0, 'asd'),
(10, 'Broken Blossoms or The Yellow ', 1919, 'USA', 90, 'D.W. Griffith'),
(11, 'The Great Train Robbery', 1903, 'USA', 11, 'Edwin S. Porter'),
(12, 'For Better, for Worse', 1919, 'USA', 70, 'Cecil B. DeMille'),
(13, 'Das Cabinet des Dr. Caligari', 1920, 'Germany', 78, 'Robert Wiene'),
(14, 'Yama no oto', 1954, 'Japan', 96, 'Mikio Naruse'),
(15, 'Hobson Choice', 1954, 'UK', 107, 'David Lean'),
(16, 'aa', 1990, 'irlan', 12, 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `lid` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `my_log`
--

CREATE TABLE IF NOT EXISTS `my_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `remote_addr` varchar(255) NOT NULL DEFAULT '',
  `request_uri` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Log' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(15) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `joining_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `joining_date`) VALUES
(1, 'png', 'p@yahoo.com', '$2y$10$5bV3A/bXtessYZ5PoDoHPes.MjkGtV.TQE7ISS2i/pFxq/8RnuP6e', '2016-06-12 21:39:51'),
(2, 'mng', 'mng@yahoo.com', '$2y$10$dfHnqzLHITO2OxluKnVYmeCHUxSd1Y33BAMvxIgG8G0qFQbkrlrm.', '2016-06-13 08:14:42'),
(3, 'admin', 'admin@yahoo.com', '$2y$10$ZS1P186vDqeoQCD.3CcTlezjuclLxAYONjXebBQZfMiYXV5e85kfe', '2016-06-15 09:47:34');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
