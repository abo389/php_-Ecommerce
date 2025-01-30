-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 30 يناير 2025 الساعة 09:18
-- إصدار الخادم: 10.4.32-MariaDB
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
-- بنية الجدول `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `brand`
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
-- بنية الجدول `cart`
--

CREATE TABLE `cart` (
  `pro_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `cart`
--

INSERT INTO `cart` (`pro_id`, `user_id`, `quantity`) VALUES
(80, 96, 5),
(84, 96, 1),
(84, 98, 3),
(93, 29, 4),
(93, 98, 2),
(93, 125, 4),
(94, 29, 4),
(94, 97, 2),
(94, 98, 1),
(95, 98, 8),
(95, 125, 2),
(105, 98, 6),
(108, 96, 1),
(120, 96, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'tv'),
(2, 'mobile'),
(3, 't-shirt'),
(4, 'watch'),
(5, 'laptop'),
(6, 'pc'),
(7, 'ghmfghm');

-- --------------------------------------------------------

--
-- بنية الجدول `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `gender`
--

INSERT INTO `gender` (`id`, `name`) VALUES
(3, 'male'),
(4, 'female');

-- --------------------------------------------------------

--
-- بنية الجدول `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `images`
--

INSERT INTO `images` (`id`, `pro_id`, `name`) VALUES
(63, 80, '1730042523508.jpg'),
(64, 80, '1730042523643.jpg'),
(66, 80, '1730042523376.jpg'),
(74, 84, '1730208055893.jpg'),
(83, 93, '1730487384980.jpg'),
(84, 94, '173048739994.jpg'),
(85, 95, '1730487425236.jpg'),
(86, 96, '1730487439372.jpg'),
(87, 97, '1730487455242.jpeg'),
(88, 98, '1730779086386.webp'),
(89, 98, '1730779086453.jpg'),
(90, 98, '1730779086194.jpg'),
(91, 99, '1730779259310.jpg'),
(92, 100, '1730779364933.jpg'),
(93, 100, '173077936488.jpg'),
(94, 100, '1730779364622.jpg'),
(95, 101, '1730779449605.jpg'),
(96, 101, '1730779449103.jpg'),
(101, 103, '1730807824822.jpeg'),
(103, 105, '1730817838413.jpeg'),
(104, 105, '1730817838919.jpg'),
(105, 105, '173081783822.jpg'),
(106, 106, '1730817871808.jpg'),
(107, 107, '1730818094202.jpg'),
(108, 108, '1730818777811.jpg'),
(109, 109, '1730818875548.jpg'),
(110, 110, '1730818893822.jpg'),
(111, 110, '1730818893733.jpg'),
(112, 110, '1730818893435.jpeg'),
(113, 111, '1730819130672.jpg'),
(114, 111, '1730819130231.jpg'),
(115, 112, '1730819170988.jpeg'),
(116, 112, '1730819170564.jpg'),
(117, 112, '1730819170543.jpg'),
(119, 114, '1730832491513.jpg'),
(120, 115, '1730832912596.jpg'),
(121, 115, '1730832912734.jpg'),
(122, 115, '1730832912210.jpg'),
(123, 115, '1730832912397.jpg'),
(128, 117, '1730833031660.jpg'),
(129, 117, '1730833031207.jpg'),
(130, 117, '1730833031604.jpg'),
(132, 119, '1730833402378.webp'),
(133, 120, '1730911580368.jpeg'),
(134, 120, '1730911580951.jpg'),
(135, 120, '1730911580377.jpg'),
(136, 120, '1730911580431.jpg'),
(137, 121, '1730911600865.jpg'),
(138, 121, '1730911600281.jpg'),
(139, 121, '1730911600566.jpeg'),
(140, 122, '173091163086.jpeg'),
(141, 122, '1730911630935.jpg'),
(142, 122, '173091163057.jpg');

-- --------------------------------------------------------

--
-- بنية الجدول `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `permission`
--

INSERT INTO `permission` (`id`, `name`) VALUES
(1, 'owner'),
(2, 'admin'),
(3, 'operator'),
(4, 'user');

-- --------------------------------------------------------

--
-- بنية الجدول `products`
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
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `cat`, `brand`, `count`, `description`, `views`) VALUES
(80, 'hamada', 98068, 7, 1, 65, 'Buy online now at Pronk!', 0),
(84, 'Ross Keith', 523, 4, 3, 18, 'Cumque repudiandae v', 0),
(93, 'Matthew Miles', 971, 7, 5, 62, 'Mollitia qui et et i', 0),
(94, 'Karly Massey', 796, 3, 7, 67, 'Adipisicing qui volu', 0),
(95, 'Rhoda Foley', 882, 7, 5, 63, 'Fugit velit at cons', 0),
(96, 'Kuame Murphy', 410, 5, 6, 80, 'Quis quia eos ea con', 0),
(97, 'Deacon Zimmerman', 686, 3, 3, 68, 'Reprehenderit qui q', 0),
(98, 'Veronica Morin', 251, 7, 6, 90, 'Adipisci corrupti a', 0),
(99, 'Bruno Carney', 490, 3, 5, 96, 'Odio labore earum qu', 0),
(100, 'Dennis Mccall', 548, 1, 5, 47, 'Sint magni aute aute', 0),
(101, 'Vladimir Chan', 436, 3, 1, 67, 'Vitae asperiores vel', 0),
(103, 'Savannah Winters', 455, 6, 7, 38, 'Porro amet voluptat', 0),
(105, 'Chaim Sparks', 535, 5, 5, 1, 'Qui praesentium inci', 0),
(106, 'Lara Ward', 862, 4, 4, 4, 'Facilis dicta neque ', 0),
(107, 'Griffith Sharpe', 74, 3, 6, 84, 'Enim aliquip sit nat', 0),
(108, 'Rahim Maldonado', 767, 2, 8, 7, 'Debitis odio dolores', 0),
(109, 'Gray Castaneda', 975, 5, 8, 95, 'Dolore repellendus ', 0),
(110, 'Herman Acevedo', 607, 4, 5, 48, 'Excepturi blanditiis', 0),
(111, 'Salvador Ayers', 576, 1, 6, 92, 'Eum est sed ab sint ', 0),
(112, 'Ciaran Lott', 452, 7, 5, 78, 'Elit mollit aliquam', 0),
(114, 'Alexander Joseph', 568, 2, 7, 79, 'Accusamus incidunt ', 0),
(115, 'Karyn Chavez', 132, 5, 7, 32, 'Reiciendis facere nu', 0),
(117, 'Olympia Phelps', 644, 3, 5, 57, 'Laudantium excepteu', 0),
(119, 'Christian Mccoy', 439, 3, 4, 15, 'Enim suscipit earum ', 0),
(120, 'Oleg Cherry', 675, 5, 7, 27, 'Quam minim nostrum e', 0),
(121, 'Todd Garrison', 794, 6, 2, 68, 'Alias sit natus dict', 0),
(122, 'Francis Mcknight', 289, 4, 5, 41, 'Ducimus omnis exped', 0);

-- --------------------------------------------------------

--
-- بنية الجدول `users`
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
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `gender`, `permission`) VALUES
(8, 'hamada', 'hhhhhhhh', 'h@h.h', 3, 3),
(29, 'abdo', '22222222', 'a@a.a', 3, 1),
(91, 'Sage Katelyn', 'Pa$$w0rd!', 'jirukoqi@mailinator.com', 3, 4),
(92, 'Dana Kasimir', 'Pa$$w0rd!', 'tinido@mailinator.com', 4, 4),
(93, 'Elvis Dan', 'Pa$$w0rd!', 'besapoq@mailinator.com', 4, 4),
(94, 'Xantha Kareem', 'Pa$$w0rd!', 'nejygi@mailinator.com', 4, 4),
(95, 'Nash Madonna', 'Pa$$w0rd!', 'vahytulu@mailinator.com', 4, 4),
(96, 'Hild India', 'Pa$$w0rd!', 'gyme@mailinator.com', 4, 4),
(97, 'Kelly Chester', 'Pa$$w0rd!', 'kyle@mailinator.com', 4, 4),
(98, 'Axel Deborah', 'Pa$$w0rd!', 'bubadun@mailinator.com', 3, 4),
(99, 'jufygadaxe', 'Pa$$w0rd!', 'xyluxomo@mailinator.com', 4, 4),
(100, 'lanuhuca', 'Pa$$w0rd!', 'vehumokoty@mailinator.com', 3, 4),
(101, 'tegeqiqido', 'Pa$$w0rd!', 'lyguniguv@mailinator.com', 3, 4),
(102, 'tyzurykor', 'Pa$$w0rd!', 'wewihape@mailinator.com', 4, 4),
(110, 'ghjg', 'fchgf', 'fmgch@nhg.jycgf', 4, 4),
(123, 'ahmed', '123213', 'ahmed@mail.com', 3, 4),
(125, 'Martina Xandr', 'Pa$$w0rd!', 'wonuvuly@mailinator.com', 3, 4);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_products`
-- (See below for the actual view)
--
CREATE TABLE `vw_products` (
`name` varchar(255)
,`price` int(11)
,`category` varchar(255)
,`brand` varchar(255)
,`count` int(11)
,`description` text
,`image` mediumtext
,`views` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_products`
--
DROP TABLE IF EXISTS `vw_products`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_products`  AS SELECT `p`.`name` AS `name`, `p`.`price` AS `price`, `c`.`name` AS `category`, `b`.`name` AS `brand`, `p`.`count` AS `count`, `p`.`description` AS `description`, group_concat(`i`.`name` separator ', ') AS `image`, `p`.`views` AS `views` FROM (((`products` `p` join `images` `i` on(`p`.`id` = `i`.`pro_id`)) join `brand` `b` on(`p`.`brand` = `b`.`id`)) join `category` `c` on(`c`.`id` = `p`.`cat`)) GROUP BY `p`.`id` ;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- قيود الجداول المُلقاة.
--

--
-- قيود الجداول `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- قيود الجداول `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- قيود الجداول `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand`) REFERENCES `brand` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`cat`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- قيود الجداول `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`gender`) REFERENCES `gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`permission`) REFERENCES `permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
