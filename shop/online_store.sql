-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 17, 2025 at 08:15 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `gender` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `registration_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`user_id`, `username`, `password`, `first_name`, `last_name`, `gender`, `date_of_birth`, `registration_time`, `account_status`) VALUES
(1, 'storyut', '111111', 'GAWK', 'meow', 'female', '2005-02-16', '2025-01-11 12:46:38', 1),
(2, 'qweqwe', '111111', 'Harry', 'Hon Hok Jun', 'male', '2005-06-20', '2025-01-11 12:41:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `promotion_price` double NOT NULL,
  `manufacture_date` datetime NOT NULL,
  `expired_date` datetime NOT NULL,
  `product_cat` int NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `promotion_price`, `manufacture_date`, `expired_date`, `product_cat`, `created`, `modified`) VALUES
(1, 'Basketball', 'A ball used in the NBA.', 49.99, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2015-08-02 12:04:03', '2025-01-05 13:21:05'),
(3, 'Gatorade', 'This is a very good drink for athletes.', 1.99, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 2, '2015-08-02 12:14:29', '2025-01-05 13:21:14'),
(4, 'Eye Glasses', 'It will make you read better.', 6, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2015-08-02 12:15:04', '2025-01-05 13:21:17'),
(5, 'Trash Can', 'It will help you maintain cleanliness.', 3.95, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2015-08-02 12:16:08', '2025-01-05 13:21:25'),
(6, 'Mouse', 'Very useful if you love your computer.', 11.35, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, '2015-08-02 12:17:58', '2025-01-05 13:21:30'),
(7, 'Earphone', 'You need this one if you love music.', 7, 0, '2025-01-06 22:09:00', '2025-01-27 22:09:00', 1, '2015-08-02 12:18:21', '2025-01-17 14:09:53'),
(8, 'Pillow', 'Sleeping well is important.', 8.99, 0, '2025-01-01 22:04:00', '2025-01-22 22:04:00', 1, '2015-08-02 12:18:56', '2025-01-17 14:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

DROP TABLE IF EXISTS `product_cat`;
CREATE TABLE IF NOT EXISTS `product_cat` (
  `product_cat_id` int NOT NULL,
  `product_cat_name` varchar(128) NOT NULL,
  `product_cat_description` text NOT NULL,
  PRIMARY KEY (`product_cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

--
-- Dumping data for table `product_cat`
--

INSERT INTO `product_cat` (`product_cat_id`, `product_cat_name`, `product_cat_description`) VALUES
(1, 'General', ''),
(2, 'Sport', ''),
(3, 'Gaming', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
