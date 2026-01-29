-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2026 at 03:09 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(22, 'Lokal'),
(23, 'Impor'),
(24, 'Tinggi Vitamin'),
(25, 'Favorit'),
(26, 'Diet'),
(27, 'Bulking'),
(28, 'Jus');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(56) NOT NULL,
  `product_pict` text NOT NULL,
  `product_description` text NOT NULL,
  `product_category` int(11) NOT NULL,
  `product_sub_category` int(11) DEFAULT NULL,
  `product_price` int(11) NOT NULL,
  `product_stock` int(11) NOT NULL,
  `product_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_pict`, `product_description`, `product_category`, `product_sub_category`, `product_price`, `product_stock`, `product_status`) VALUES
(24, 'Jeruk', '1769257711_23285229.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum modi aliquam repudiandae esse? Eaque, mollitia placeat! Voluptas aliquam voluptatibus error beatae saepe nobis repudiandae aliquid provident eveniet officiis voluptates quod veritatis, odio commodi praesentium? Officia, sint eligendi repellendus exercitationem autem et tenetur obcaecati corrupti assumenda facilis, architecto totam ad maxime.', 22, 24, 2000, 19, 1),
(25, 'Berry', '1769257751_108325326.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum modi aliquam repudiandae esse? Eaque, mollitia placeat! Voluptas aliquam voluptatibus error beatae saepe nobis repudiandae aliquid provident eveniet officiis voluptates quod veritatis, odio commodi praesentium? Officia, sint eligendi repellendus exercitationem autem et tenetur obcaecati corrupti assumenda facilis, architecto totam ad maxime.', 23, 25, 5000, 97, 1),
(26, 'Pisang', '1769257786_149186006.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum modi aliquam repudiandae esse? Eaque, mollitia placeat! Voluptas aliquam voluptatibus error beatae saepe nobis repudiandae aliquid provident eveniet officiis voluptates quod veritatis, odio commodi praesentium? Officia, sint eligendi repellendus exercitationem autem et tenetur obcaecati corrupti assumenda facilis, architecto totam ad maxime.', 26, 22, 1000, 2998, 1),
(27, 'Labu', '1769257831_638230323.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum modi aliquam repudiandae esse? Eaque, mollitia placeat! Voluptas aliquam voluptatibus error beatae saepe nobis repudiandae aliquid provident eveniet officiis voluptates quod veritatis, odio commodi praesentium? Officia, sint eligendi repellendus exercitationem autem et tenetur obcaecati corrupti assumenda facilis, architecto totam ad maxime.', 23, 25, 7000, 14, 1),
(28, 'Anggur', '1769257888_365193523.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum modi aliquam repudiandae esse? Eaque, mollitia placeat! Voluptas aliquam voluptatibus error beatae saepe nobis repudiandae aliquid provident eveniet officiis voluptates quod veritatis, odio commodi praesentium? Officia, sint eligendi repellendus exercitationem autem et tenetur obcaecati corrupti assumenda facilis, architecto totam ad maxime.', 22, 25, 2000, 200, 1),
(29, 'Apel', '1769257948_259760029.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum modi aliquam repudiandae esse? Eaque, mollitia placeat! Voluptas aliquam voluptatibus error beatae saepe nobis repudiandae aliquid provident eveniet officiis voluptates quod veritatis, odio commodi praesentium? Officia, sint eligendi repellendus exercitationem autem et tenetur obcaecati corrupti assumenda facilis, architecto totam ad maxime.', 23, 25, 10000, 124, 1),
(30, 'Semangka', '1769258113_1998138438.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum modi aliquam repudiandae esse? Eaque, mollitia placeat! Voluptas aliquam voluptatibus error beatae saepe nobis repudiandae aliquid provident eveniet officiis voluptates quod veritatis, odio commodi praesentium? Officia, sint eligendi repellendus exercitationem autem et tenetur obcaecati corrupti assumenda facilis, architecto totam ad maxime.', 23, 25, 20000, 118, 1),
(31, 'Mangga', '1769258222_308578496.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum modi aliquam repudiandae esse? Eaque, mollitia placeat! Voluptas aliquam voluptatibus error beatae saepe nobis repudiandae aliquid provident eveniet officiis voluptates quod veritatis, odio commodi praesentium? Officia, sint eligendi repellendus exercitationem autem et tenetur obcaecati corrupti assumenda facilis, architecto totam ad maxime.', 22, 27, 7000, 222, 1),
(32, 'Jeruk Mandarin', '1769335086_361883425.jpg', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Cum modi aliquam repudiandae esse? Eaque, mollitia placeat! Voluptas aliquam voluptatibus error beatae saepe nobis repudiandae aliquid provident eveniet officiis voluptates quod veritatis, odio commodi praesentium? Officia, sint eligendi repellendus exercitationem autem et tenetur obcaecati corrupti assumenda facilis, architecto totam ad maxime.', 23, 27, 12000, 90, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `stock_status` varchar(4) NOT NULL,
  `stock_qty` int(11) NOT NULL,
  `stock_created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `product_id`, `stock_status`, `stock_qty`, `stock_created_at`) VALUES
(4, 28, 'in', 1, '2026-01-28 15:15:20'),
(5, 31, 'out', 2, '2026-01-28 15:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` varchar(56) NOT NULL,
  `transaction_name` varchar(56) NOT NULL,
  `transaction_address` text NOT NULL,
  `transaction_phone` varchar(20) NOT NULL,
  `transaction_email` varchar(56) NOT NULL,
  `transaction_status` varchar(56) NOT NULL,
  `transaction_total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `transaction_name`, `transaction_address`, `transaction_phone`, `transaction_email`, `transaction_status`, `transaction_total`, `created_at`) VALUES
('KTS20260127143830865', 'Testing', 'Jl. Soekarno-Hatta No.378, Kb. Lega, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40235', '8023802082', 'test@gmail.com', 'Diproses', 43000, '2026-01-28 14:54:09'),
('KTS20260127144107620', 'Testing 2', 'Jl. Soekarno-Hatta No.378, Kb. Lega, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40235', '108103182318', 'test@gmail.com', 'Diproses', 74000, '2026-01-28 14:54:13'),
('KTS20260128162308228', 'Bahlil', 'Jl. Soekarno-Hatta No.378, Kb. Lega, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40235', '8293929323', 'bahlil@gmail.com', 'Diproses', 47000, '2026-01-28 15:23:08'),
('KTS20260128162355142', 'Bahlil', 'Jl. Soekarno-Hatta No.378, Kb. Lega, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40235', '8293929323', 'bahlil@gmail.com', 'Diproses', 47000, '2026-01-28 15:23:55'),
('KTS20260128162422236', 'Bahlil', 'Jl. Soekarno-Hatta No.378, Kb. Lega, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40235', '8293929323', 'bahlil@gmail.com', 'Diproses', 47000, '2026-01-28 15:24:22'),
('KTS20260128162518188', 'Bahlil', 'Jl. Soekarno-Hatta No.378, Kb. Lega, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40235', '830208328', 'bahlil@gmail.com', 'Diproses', 47000, '2026-01-28 15:25:18'),
('KTS20260128162741910', 'Bahlil', 'Jl. Soekarno-Hatta No.378, Kb. Lega, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40235', '830208328', 'bahlil@gmail.com', 'Diproses', 47000, '2026-01-28 15:27:41'),
('KTS20260128162946860', 'Bahlil', 'Jl. Soekarno-Hatta No.378, Kb. Lega, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40235', '29024208420', 'bahlil@gmail.com', 'Diproses', 47000, '2026-01-28 15:29:46'),
('KTS20260129025659274', 'Luhud', 'Jl. Soekarno-Hatta No.378, Kb. Lega, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40235', '89798696', 'test@gmail.com', 'Diproses', 41000, '2026-01-29 01:57:53'),
('KTS20260129025844513', 'Mulyono', 'Jl. Soekarno-Hatta No.378, Kb. Lega, Kec. Bojongloa Kidul, Kota Bandung, Jawa Barat 40235', '424234235252', 'test@gmail.com', 'Diproses', 40000, '2026-01-29 01:58:44');

-- --------------------------------------------------------

--
-- Table structure for table `t_item`
--

CREATE TABLE `t_item` (
  `t_item_id` int(11) NOT NULL,
  `transaction_id` varchar(56) NOT NULL,
  `product_id` int(11) NOT NULL,
  `t_item_qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_item`
--

INSERT INTO `t_item` (`t_item_id`, `transaction_id`, `product_id`, `t_item_qty`, `sub_total`) VALUES
(5, 'KTS20260127143830865', 32, 3, 12000),
(6, 'KTS20260127143830865', 31, 1, 7000),
(7, 'KTS20260127144107620', 32, 5, 12000),
(8, 'KTS20260127144107620', 31, 2, 7000),
(9, 'KTS20260128162946860', 29, 3, 30000),
(10, 'KTS20260128162946860', 26, 2, 2000),
(11, 'KTS20260128162946860', 25, 3, 15000),
(12, 'KTS20260129025659274', 31, 3, 21000),
(13, 'KTS20260129025659274', 29, 2, 20000),
(14, 'KTS20260129025844513', 30, 2, 40000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(56) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(56) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`) VALUES
(1, 'admin', 'b0baee9d279d34fa1dfd71aadb908c3f', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_category` (`product_category`),
  ADD KEY `product_sub_category` (`product_sub_category`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `t_item`
--
ALTER TABLE `t_item`
  ADD PRIMARY KEY (`t_item_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_item`
--
ALTER TABLE `t_item`
  MODIFY `t_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`product_category`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`product_sub_category`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_item`
--
ALTER TABLE `t_item`
  ADD CONSTRAINT `t_item_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_item_ibfk_2` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
