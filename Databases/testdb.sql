-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 07, 2018 at 02:07 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

DROP TABLE IF EXISTS `forum`;
CREATE TABLE IF NOT EXISTS `forum` (
  `forum_id` int(11) NOT NULL AUTO_INCREMENT,
  `forum_name` varchar(150) DEFAULT NULL,
  `forum_description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`forum_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`forum_id`, `forum_name`, `forum_description`) VALUES
(1, 'Bobbleheads', ''),
(2, 'Disney ', ''),
(3, 'Marvel', ''),
(4, 'Star Wars ', ''),
(5, 'Custom-Made ', ''),
(6, 'New Collections', '');

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

DROP TABLE IF EXISTS `forum_posts`;
CREATE TABLE IF NOT EXISTS `forum_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `post_text` text,
  `post_create_time` datetime DEFAULT NULL,
  `post_owner` varchar(150) DEFAULT NULL,
  `forum_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_posts`
--

INSERT INTO `forum_posts` (`post_id`, `topic_id`, `post_text`, `post_create_time`, `post_owner`, `forum_id`) VALUES
(13, 12, 'Best character', '2018-06-07 18:23:21', 'julia@hotmail.com', 2),
(12, 11, 'It is one of the best bobblehead shops in the world! ', '2018-06-07 18:22:29', 'julia@hotmail.com', 1),
(14, 12, 'I agree!', '2018-06-07 18:31:39', 'hello@world.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

DROP TABLE IF EXISTS `forum_topics`;
CREATE TABLE IF NOT EXISTS `forum_topics` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_title` varchar(150) DEFAULT NULL,
  `topic_create_time` datetime DEFAULT NULL,
  `topic_owner` varchar(150) DEFAULT NULL,
  `forum_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`topic_id`, `topic_title`, `topic_create_time`, `topic_owner`, `forum_id`) VALUES
(11, 'Bobbleshop is the best!', '2018-06-07 18:22:29', 'julia@hotmail.com', 1),
(12, 'Love WALL-E', '2018-06-07 18:23:21', 'julia@hotmail.com', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
