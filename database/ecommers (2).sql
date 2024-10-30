-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2024 at 11:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommers`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`) VALUES
(1, 'apple'),
(2, 'Samsung'),
(3, 'dell'),
(4, 'LG'),
(5, 'zara'),
(6, 'ASUS'),
(7, 'honor'),
(8, 'NIKE');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `pro_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`pro_id`, `user_id`, `quantity`) VALUES
(69, 1, 1),
(73, 1, 1),
(73, 3, 1),
(74, 1, 1),
(77, 1, 1),
(77, 3, 1),
(81, 1, 1),
(81, 3, 1),
(82, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'tv'),
(2, 'mobile'),
(3, 't-shirt'),
(4, 'watch'),
(5, 'laptop'),
(6, 'pc'),
(7, 'head-phone'),
(8, 'candy');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `name`) VALUES
(3, 'male'),
(4, 'female');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `pro_id`, `name`) VALUES
(48, 73, '1729705365495.jpg'),
(49, 73, '1729705365398.jpg'),
(50, 73, '1729705365959.jpeg'),
(51, 74, '1729705389637.webp'),
(58, 75, '1729946811376.jpg'),
(59, 76, '1729980547922.jpg'),
(60, 77, '1729980581446.jpg'),
(61, 78, '1729980621983.jpg'),
(62, 79, '1729980658699.jpg'),
(63, 80, '1730042523508.jpg'),
(64, 80, '1730042523643.jpg'),
(66, 80, '1730042523376.jpg'),
(68, 69, '1730042891995.jpg'),
(69, 69, '1730042891444.jpg'),
(70, 69, '1730042891231.jpg'),
(71, 81, '1730120705559.jpeg'),
(72, 82, '1730208022294.jpg'),
(73, 83, '1730208042330.jpg'),
(74, 84, '1730208055893.jpg'),
(75, 85, '1730208067764.jpg'),
(76, 86, '1730208083568.jpeg'),
(77, 87, '1730208154195.jpg'),
(78, 88, '1730208348248.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`) VALUES
(1, 'owner'),
(2, 'admin'),
(3, 'operator'),
(4, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `brand` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `description` text NOT NULL,
  `views` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `cat`, `brand`, `count`, `description`, `views`) VALUES
(69, 'th', 45, 3, 4, 563, 'ehrbhyh', 0),
(73, 'dghhg', 54, 5, 4, 676, 'hgjghmgh', 0),
(74, 'hdyt', 546, 4, 6, 546, 'jdhgndt', 0),
(75, 'hjdfg', 436, 4, 6, 356, 'foooooooool', 0),
(76, 'dghsgf.', 5463, 5, 6, 784, 'judthfgb', 0),
(77, 'glhsjg67356', 6735, 4, 8, 906, 'noooooooooo', 0),
(78, 'utfky', 48, 1, 1, 676, '6845ghhkjnm', 0),
(79, 'mfmvgjh', 67, 7, 7, 7854, '667rfikhj', 0),
(80, 'hamada', 98068, 7, 1, 65, 'Buy online now at Pronk!', 0),
(81, 'Zorita Mccall', 69, 6, 6, 79, 'Consequatur Et tene', 0),
(82, 'Yardley Berry', 846, 2, 8, 16, 'Reprehenderit incid', 0),
(83, 'Philip Mejia', 597, 4, 4, 57, 'Eiusmod dolorum sed ', 0),
(84, 'Ross Keith', 523, 4, 3, 18, 'Cumque repudiandae v', 0),
(85, 'Alika Chapman', 248, 4, 1, 51, 'Proident excepturi ', 0),
(86, 'Alan Conley', 198, 8, 1, 55, 'Aliquip rerum illo l', 0),
(87, 'Abigail Harding', 437, 1, 7, 50, 'Quo quam quaerat dol', 0),
(88, 'Catherine Fletcher', 213, 4, 8, 7, 'Expedita Nam qui mag', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `gender`, `permission`) VALUES
(1, 'abdo', '1234', 'a@a.a', 3, 1),
(3, 'osama', 'osos333', 'o@o.o', 3, 3),
(4, 'mai', 'momo555', 'mo@m.m', 4, 2),
(8, 'hamada', 'hhhhhhhh', 'h@h.h', 3, 3),
(10, 'mohamed', '123123123', 'mohamed@m.m', 3, 2),
(11, 'fatima', 'ffffffff', 'f@f.f', 4, 4),
(13, 'hamasa ahma', '1212', 'hh@h.h', 3, 4),
(23, 'Brenden Abe', 'Pa$$w0rd!', 'morerici@mailinator.com', 3, 4),
(24, 'Kylie Chadwic', 'Pa$$w0rd!', 'boxusutyt@mailinator.com', 4, 4),
(25, 'Ryde Macaulay', 'Pa$$w0rd!', 'xujy@mailinator.com', 3, 4),
(26, 'Illiana Tha', 'Pa$$w0rd!', 'kudawo@mailinator.com', 3, 4),
(27, 'Adele Burke', 'Pa$$w0rd!', 'zypiceha@mailinator.com', 3, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`pro_id`,`user_id`),
  ADD KEY `cart_ibfk_2` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand` (`brand`),
  ADD KEY `cat` (`cat`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `gender` (`gender`),
  ADD KEY `permission` (`permission`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand`) REFERENCES `brand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`cat`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`gender`) REFERENCES `gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`permission`) REFERENCES `permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
