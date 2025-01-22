-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2025 at 04:40 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

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
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `gender` text NOT NULL,
  `date_of_birth` date NOT NULL,
  `registration_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account_status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`user_id`, `username`, `password`, `first_name`, `last_name`, `gender`, `date_of_birth`, `registration_time`, `account_status`) VALUES
(1, 'Harryhon0620', 'werwer', 'werwer', 'werwer', 'male', '2024-12-04', '2024-12-18 05:42:27', 1),
(2, 'dsfsdfsd', 'erwerwsdf', 'sdfsdf', 'dfgdfg', 'female', '2024-12-04', '2024-12-18 05:49:13', 1),
(3, 'Storyut', '123456', 'harry', 'hon', 'male', '2001-06-12', '2025-01-08 05:07:46', 1),
(4, 'storyut@gmail.com', '111111', 'Harry', 'dfdf', 'male', '2006-11-22', '2025-01-08 05:46:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  `product_cat` int NOT NULL,
  `price` double NOT NULL,
  `promotion_price` double NOT NULL,
  `manufacture_date` datetime NOT NULL,
  `expired_date` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `product_cat`, `price`, `promotion_price`, `manufacture_date`, `expired_date`, `created`, `modified`) VALUES
(1, 'Basketball', 'A ball used in the NBA.', 2, 49.99, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-08-02 12:04:03', '2025-01-15 06:43:27'),
(3, 'Gatorade', 'This is a very good drink for athletes.', 1, 1.99, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-08-02 12:14:29', '2024-12-28 09:29:23'),
(4, 'Eye Glasses', 'It will make you read better.', 4, 6, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-08-02 12:15:04', '2024-12-28 09:30:02'),
(5, 'Trash Can', 'It will help you maintain cleanliness.', 4, 3.95, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-08-02 12:16:08', '2024-12-28 09:30:08'),
(6, 'Mouse', 'Very useful if you love your computer. Meow', 2, 11.35, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-08-02 12:17:58', '2025-01-15 05:38:28'),
(7, 'Earphone', 'You need this one if you love music.', 2, 7, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-08-02 12:18:21', '2024-12-28 09:30:17'),
(8, 'Pillow', 'Sleeping well is important.', 4, 123, 0, '2025-01-01 00:00:00', '2025-01-30 00:00:00', '2015-08-02 12:18:56', '2025-01-15 07:31:09'),
(14, 'RTX 5090', 'Best Graphic Card In The Market For Now.', 2, 12999, 11999, '2024-12-30 16:21:00', '2025-01-29 16:21:00', '2025-01-15 08:21:46', '2025-01-15 08:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `product_cat`
--

DROP TABLE IF EXISTS `product_cat`;
CREATE TABLE IF NOT EXISTS `product_cat` (
  `product_cat_id` int NOT NULL,
  `product_cat_name` varchar(128) CHARACTER SET utf16 COLLATE utf16_general_ci NOT NULL,
  `product_cat_description` text NOT NULL,
  PRIMARY KEY (`product_cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

--
-- Dumping data for table `product_cat`
--

INSERT INTO `product_cat` (`product_cat_id`, `product_cat_name`, `product_cat_description`) VALUES
(1, 'Sport', ''),
(2, 'Games', ''),
(3, 'Animals', ''),
(4, 'General', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
