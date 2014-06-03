-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2014 at 10:38 AM
-- Server version: 5.5.37-0ubuntu0.13.10.1
-- PHP Version: 5.5.12-2+deb.sury.org~saucy+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `registration_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `date_from` datetime NOT NULL,
  `date_to` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E00CEDDEA76ED395` (`user_id`),
  KEY `IDX_E00CEDDE54177093` (`room_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `user_id`, `room_id`, `date_from`, `date_to`) VALUES
(1, 1, 1, '2014-06-12 00:00:00', '2014-06-28 00:00:00'),
(5, 15, 2, '2014-06-03 00:00:00', '2014-06-19 00:00:00'),
(6, 3, 3, '2014-06-05 00:00:00', '2014-06-13 00:00:00'),
(7, 15, 4, '2014-06-05 00:00:00', '2014-06-20 00:00:00'),
(8, 1, 4, '2014-06-12 00:00:00', '2014-06-28 00:00:00'),
(11, 15, 5, '2014-06-03 00:00:00', '2014-06-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `adults` int(11) DEFAULT NULL,
  `children` int(11) DEFAULT NULL,
  `room_count` int(11) DEFAULT NULL,
  `prices` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`, `adults`, `children`, `room_count`, `prices`) VALUES
(1, 'Apartment', 2, 5, 5, '{"mon":53,"tue":45,"wed":23,"thu":52,"fri":2,"sat":5,"sun":10}'),
(2, 'Single Room', 2, 0, 10, '{"mon":25,"tue":25,"wed":2,"thu":2,"fri":2,"sat":2,"sun":2}'),
(3, 'Double Room', 2, 2, 8, '{"mon":22,"tue":4,"wed":40,"thu":2,"fri":10,"sat":2,"sun":3}'),
(4, 'Family Room', 2, 3, 3, '{"mon":2,"tue":2,"wed":2,"thu":2,"fri":2,"sat":2,"sun":6}'),
(5, 'Studio', 1, 2, 6, '{"mon":20,"tue":2,"wed":2,"thu":4,"fri":4,"sat":2,"sun":10}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` datetime DEFAULT NULL,
  `password` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `birthday`, `password`, `email`) VALUES
(1, 'Gent', '2013-02-05 00:00:00', 'hi', 'gent@example.com'),
(3, 'Granit', NULL, 'asd', 'granit@example.comm'),
(4, 'Alush', NULL, 'gashi', 'alushi@exmple.com'),
(15, 'Adea', NULL, 'asdf', 'adea@example.com'),
(26, 'Shkumbin', NULL, 'asd', 'shkumba@exmaple.sda'),
(27, 'Fisnik', NULL, 'fis', 'fisnik@example.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FK_E00CEDDE54177093` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`),
  ADD CONSTRAINT `FK_E00CEDDEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
