-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2021 at 05:07 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id16879353_grocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `bill_id` bigint(255) NOT NULL,
  `user_id` bigint(255) NOT NULL,
  `items` mediumtext NOT NULL,
  `total` bigint(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` bigint(100) NOT NULL,
  `p_name` varchar(30) NOT NULL,
  `p_img` varchar(40) NOT NULL,
  `p_category` varchar(40) NOT NULL,
  `p_qty` varchar(10) NOT NULL,
  `p_measure` varchar(20) NOT NULL,
  `p_price` varchar(50) NOT NULL,
  `available` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_name`, `p_img`, `p_category`, `p_qty`, `p_measure`, `p_price`, `available`) VALUES
(1, 'Beetroot', 'beetroot.jpg', 'Vegetables', '1', 'kg', '25', '30'),
(2, 'Brinjal', 'brinjal.jpg', 'Vegetables', '1', 'kg', '40', '30'),
(3, 'Cabbage', 'cabbage.jpg', 'Vegetables', '1', 'kg', '30', '30'),
(4, 'Califlower', 'califlower.jpg', 'Vegetables', '1', 'kg', '30', '30'),
(5, 'Carrot', 'carrot.jpg', 'Vegetables', '1', 'kg', '45', '30'),
(6, 'Green Chilly', 'chilly.jpg', 'Vegetables', '1', 'kg', '30', '30'),
(7, 'Garlic', 'garlic.jpg', 'Vegetables', '1', 'kg', '45', '30'),
(8, 'Ginger', 'ginger.jpg', 'Vegetables', '1', 'kg', '20', '30'),
(9, 'Ladysfinger', 'ladyfinger.jpg', 'Vegetables', '1', 'kg', '30', '30'),
(10, 'Onion', 'onion_sm.jpg', 'Vegetables', '1', 'kg', '50', '30'),
(11, 'Red Chilly', 'rchilly.jpg', 'Vegetables', '1', 'kg', '40', '30'),
(12, 'Tomato', 'tomato.jpg', 'Vegetables', '1', 'kg', '50', '30'),
(13, 'Bang', 'bang.jpg', 'Drinks', '1', 'Bottle/Tin', '40', '100'),
(14, 'Bizon', 'bizon.jpg', 'Drinks', '1', 'Bottle/Tin', '40', '50'),
(15, 'Mockup', 'mockup.jpg', 'Drinks', '1', 'Bottle/Tin', '40', '50'),
(16, 'Monster', 'monster.jpg', 'Drinks', '1', 'Bottle/Tin', '40', '100'),
(17, 'Quake', 'quake.jpg', 'Drinks', '1', 'Bottle/Tin', '40', '60'),
(18, 'Redbull', 'redbull.jpg', 'Drinks', '1', 'Bottle/Tin', '40', '50'),
(19, 'Apple', 'apple.jpg', 'Fruits', '1', 'kg', '40', '30'),
(20, 'Banana', 'banana.jpg', 'Fruits', '1', 'kg', '45', '40'),
(21, 'Mango', 'mango.jpg', 'Fruits', '1', 'kg', '50', '30'),
(22, 'Orange', 'orange.jpg', 'Fruits', '1', 'kg', '45', '30'),
(23, 'Strawberry', 'strawberry.jpg', 'Fruits', '1', 'kg', '40', '30'),
(24, 'Watermelon', 'watermelen.jpg', 'Fruits', '1', 'kg', '50', '50'),
(25, 'Dhara', 'dhara.jpg', 'Oils', '1', 'L/Packets', '40', '100'),
(26, 'Fortune', 'fortune.jpg', 'Oils', '1', 'L/Packets', '30', '50'),
(27, 'Gemini', 'gemini.jpg', 'Oils', '1', 'L/Packets', '40', '50'),
(28, 'Mahakosh', 'mahakosh.jpg', 'Oils', '1', 'L/Packets', '45', '60'),
(29, 'Nutrela', 'nutrela.jpg', 'Oils', '1', 'L/Packets', '40', '40');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `address` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `number`, `address`, `date`) VALUES
(1, 'admin', 'admin@gmail.com', 'cGFzc3dvcmQ=', '0', '', '2021-06-17 05:07:16'),
(2, 'jeya', 'jeyasreevenkat@gmail.com', 'cGFzc3dvcmQ=', '8825875663', 'north street, madurai', '2021-01-09 12:15:06');
(3, 'sree', 'sree@gmail.com', 'cGFzc3dvcmQ=', '9976641698', 'north, madurai', '2022-01-12 18:30:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `bill_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
