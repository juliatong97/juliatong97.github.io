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
-- Database: `bobbleshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `store_categories`
--

DROP TABLE IF EXISTS `store_categories`;
CREATE TABLE IF NOT EXISTS `store_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(50) DEFAULT NULL,
  `cat_desc` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cat_title` (`cat_title`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_categories`
--

INSERT INTO `store_categories` (`id`, `cat_title`, `cat_desc`) VALUES
(1, 'Disney', 'Shop for the greatest Disney Bobblehead figures, this ranges from countless Walt Disney Production films, including your favourite Disney films! '),
(2, 'Marvel', 'Do you read comics? Then you must know of Marvel! Pop! Marvel includes all Marvel characters, some of which you would know already! '),
(3, 'Star Wars ', 'If you want more than just a screen with moving pictures, then purchase our Pop! Star Wars Bobbleheads today to experience the fun out of interactive figures!');

-- --------------------------------------------------------

--
-- Table structure for table `store_items`
--

DROP TABLE IF EXISTS `store_items`;
CREATE TABLE IF NOT EXISTS `store_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) DEFAULT NULL,
  `item_title` varchar(75) DEFAULT NULL,
  `item_price` float(8,2) DEFAULT NULL,
  `item_desc` text,
  `item_image` varchar(50) DEFAULT NULL,
  `item_qty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_items`
--

INSERT INTO `store_items` (`id`, `cat_id`, `item_title`, `item_price`, `item_desc`, `item_image`, `item_qty`) VALUES
(1, 1, 'Pop! Disney: Big Hero 6 - Baymax', 25.00, 'Become a \'Big Hero\' like Baymax!', 'Baymax.jpg', 30),
(2, 1, 'Pop! Disney: Up - Carl ', 23.00, 'Join the emotionally rollercoaster with Carl from Walt Disney\'s \'Up\'! ', 'Carl.jpg', 30),
(3, 1, 'Pop! Disney: Frozen - Elsa', 30.00, 'Be like Elsa, Disney fans\' favourite snow queen!', 'Elsa.jpg', 30),
(4, 1, 'Pop! Disney: Aladdin - Genie ', 31.00, 'Who needs a lamp when you can have Genie as your personal Bobblehead figure!', 'Genie.jpg', 30),
(5, 1, 'Pop! Disney: Pirates of the Caribbean - Jack Sparrow', 35.00, 'Having this Jack Sparrow Bobblehead around will make you feel like an actual pirate!', 'Jack_Sparrow.jpg', 30),
(6, 1, 'Pop! Disney: The Lion King - Simba', 30.00, 'Feel like a lion, be like a lion, like Simba.', 'Simba.jpg', 30),
(7, 1, 'Pop! Disney: Lilo & Stitch - Stitch', 38.00, 'Ever wonder how it feels like to live in Hawaii? This Stitch Bobblehead will surely give you that vibe. ', 'Stitch.jpg', 30),
(8, 1, 'Pop! Disney: WALL-E', 35.00, 'WALL-E... The future and saviour of all humanity!', 'Wall-E.jpg', 30),
(9, 2, 'Pop! Marvel: Captain America', 42.00, 'Represent the United States of America by being Captain America!', 'Captain_America.jpg', 30),
(10, 2, 'Pop! Marvel: X-Men - Cyclops', 40.00, 'Shoot laser beams from your eyes like the X-Men\'s infamous mutant, Cyclops!', 'Cyclops.jpg', 30),
(11, 2, 'Pop! Marvel: Ghost Rider', 39.00, 'Becomes a bridge between two realms.  ', 'Ghost_Rider.jpg', 30),
(12, 2, 'Pop! Marvel: Guardians of the Galaxy - Groot', 40.00, 'Give yourself a guardian to stick by through your toughest times!', 'Groot.jpg', 30),
(13, 2, 'Pop! Marvel: Hawkeye', 38.00, 'Also known as Clint Barton. ', 'Hawkeye.jpg', 30),
(14, 2, 'Pop! Marvel: Heimdall ', 37.00, 'Another guardian to add to your Marvel Bobblehead collection! ', 'Heimdall.jpg', 30),
(15, 2, 'Pop! Marvel: Hulk', 78.00, 'Everybody knows who The Hulk is. ', 'Hulk.jpg', 30),
(16, 2, 'Pop! Marvel: Iron Man ', 115.00, 'Who wouldn\'t want a pioneering genius like Iron Man? ', 'Iron_Man.jpg', 30),
(17, 2, 'Pop! Marvel: Loki ', 110.00, 'Become a sinister mastermind like Loki, who appears in multiple Marvel films! ', 'Loki.jpg', 30),
(18, 2, 'Pop! Marvel: X-Men - Magneto', 42.00, 'Can you manipulate magnetic forces to your desire? ', 'Magneto.jpg', 30),
(19, 2, 'Pop! Marvel: X-Men - Professor Xavier', 42.00, 'Buy this Bobblehead and you can get an additional mind control power! ', 'Professor_X.jpg', 30),
(20, 2, 'Pop! Marvel: Guardians of the Galaxy - Rocket Raccoon', 47.00, 'Do you think you can keep up with Rocket Raccoon\'s wits? ', 'Rocket_Raccoon.jpg', 30),
(21, 2, 'Pop! Marvel: Fantastic Four - Silver Surfer', 65.00, 'Let\'s go surfing on silver! ', 'Silver_Surfer.jpg', 30),
(22, 2, 'Pop! Marvel: Spider-Man', 110.00, 'Look out! Here comes the Spider-Man!', 'Spiderman.jpg', 30),
(23, 2, 'Pop! Marvel: Thor ', 115.00, 'Grab your enormous and most powerful weapon. Be like Thor, the hammer-wielding god of thunder, lightning, storms, oak trees, strength, the protection of mankind, and also hallowing and fertility.', 'Thor.jpg', 30),
(24, 2, 'Pop! Marvel: X-Men - Wolverine ', 125.00, 'Sharpen your claws for some real action superhero!', 'Wolverine.jpg', 30),
(25, 3, 'Pop! Star Wars: Scout Trooper', 35.00, 'Are you one of the scouts? ', 'Biker_Scout.jpg', 30),
(26, 3, 'Pop! Star Wars: C3PO ', 45.00, 'Let C3PO come to your assistance. ', 'C3PO.jpg', 30),
(27, 3, 'Pop! Star Wars: Darth Vader ', 117.00, 'The ultimate villain of all Star Wars series. Darth Vader (also known as Anakin Skywalker) will never be forgotten. ', 'Darth_Vadar.jpg', 30),
(28, 3, 'Pop! Star Wars: Darth Maul', 78.00, 'Are you capable of defeating this warrior? He wielded an intimidating double-bladed lightsaber and fought with a menacing ferocity.', 'DarthMaul.jpg', 30),
(29, 3, 'Pop! Star Wars: R2-D2', 100.00, 'Everyone\'s favourite Star Wars character and companion! ', 'R2D2.jpg', 30),
(30, 3, 'Pop! Star Wars: Yoda', 89.00, 'A legendary Jedi Master and stronger than most in his connection with the Force. Despite of his bite-sized stature, he is the wisest being in the whole universe. ', 'Yoda.jpg', 30);

-- --------------------------------------------------------

--
-- Table structure for table `store_item_color`
--

DROP TABLE IF EXISTS `store_item_color`;
CREATE TABLE IF NOT EXISTS `store_item_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_color` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_item_color`
--

INSERT INTO `store_item_color` (`id`, `item_id`, `item_color`) VALUES
(1, 1, 'red'),
(2, 1, 'black'),
(3, 1, 'blue');

-- --------------------------------------------------------

--
-- Table structure for table `store_item_size`
--

DROP TABLE IF EXISTS `store_item_size`;
CREATE TABLE IF NOT EXISTS `store_item_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `item_size` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_item_size`
--

INSERT INTO `store_item_size` (`id`, `item_id`, `item_size`) VALUES
(1, 1, 'One Size Fits All'),
(2, 2, 'One Size Fits All'),
(3, 3, 'One Size Fits All'),
(4, 4, 'S'),
(5, 4, 'M'),
(6, 4, 'L'),
(7, 4, 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `store_orders`
--

DROP TABLE IF EXISTS `store_orders`;
CREATE TABLE IF NOT EXISTS `store_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` datetime DEFAULT NULL,
  `order_name` varchar(100) DEFAULT NULL,
  `order_address` varchar(255) DEFAULT NULL,
  `order_city` varchar(50) DEFAULT NULL,
  `order_state` char(2) DEFAULT NULL,
  `order_zip` varchar(10) DEFAULT NULL,
  `order_tel` varchar(25) DEFAULT NULL,
  `order_email` varchar(100) DEFAULT NULL,
  `item_total` float(6,2) DEFAULT NULL,
  `shipping_total` float(6,2) DEFAULT NULL,
  `authorization` varchar(50) DEFAULT NULL,
  `status` enum('processed','pending') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_orders_items`
--

DROP TABLE IF EXISTS `store_orders_items`;
CREATE TABLE IF NOT EXISTS `store_orders_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `sel_item_id` int(11) DEFAULT NULL,
  `sel_item_qty` smallint(6) DEFAULT NULL,
  `sel_item_size` varchar(25) DEFAULT NULL,
  `sel_item_color` varchar(25) DEFAULT NULL,
  `sel_item_price` float(6,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_shoppertrack`
--

DROP TABLE IF EXISTS `store_shoppertrack`;
CREATE TABLE IF NOT EXISTS `store_shoppertrack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` varchar(32) DEFAULT NULL,
  `sel_item_id` int(11) DEFAULT NULL,
  `sel_item_qty` smallint(6) DEFAULT NULL,
  `sel_item_size` varchar(25) DEFAULT NULL,
  `sel_item_color` varchar(25) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_shoppertrack`
--

INSERT INTO `store_shoppertrack` (`id`, `session_id`, `sel_item_id`, `sel_item_qty`, `sel_item_size`, `sel_item_color`, `date_added`) VALUES
(5, '0qon6uegqlthubnqq73nf4o355', 1, 1, '', 'black', '2018-04-13 12:29:53'),
(8, '0qon6uegqlthubnqq73nf4o355', 2, 1, '', '', '2018-04-13 12:35:47'),
(6, '0qon6uegqlthubnqq73nf4o355', 1, 1, '', 'red', '2018-04-13 12:30:46'),
(12, '0qon6uegqlthubnqq73nf4o355', 6, 1, '', '', '2018-04-13 12:53:50'),
(13, 'm9s2oeut9c9u1ds89mgjomoc95', 9, 1, '', '', '2018-05-28 00:14:41'),
(14, 'm9s2oeut9c9u1ds89mgjomoc95', 9, 1, '', '', '2018-05-28 00:14:47'),
(15, 'm9s2oeut9c9u1ds89mgjomoc95', 9, 1, '', '', '2018-05-28 00:14:53'),
(16, 'v93q017u9g0lgn1pnuqokqngn5', 9, 1, '', '', '2018-05-28 22:50:58'),
(17, 'p53uuj1rblluqhjovd9dc4u5k4', 7, 1, '', '', '2018-05-31 16:24:36'),
(18, 'p53uuj1rblluqhjovd9dc4u5k4', 10, 1, '', '', '2018-05-31 18:00:55'),
(19, 'p53uuj1rblluqhjovd9dc4u5k4', 4, 5, '', '', '2018-05-31 18:01:02'),
(20, 'p53uuj1rblluqhjovd9dc4u5k4', 1, 1, '', 'red', '2018-05-31 19:28:06');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
