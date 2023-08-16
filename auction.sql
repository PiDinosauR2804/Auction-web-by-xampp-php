-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2023 at 05:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `moneymanager`
--

CREATE TABLE `moneymanager` (
  `user_id` int(11) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  `request` int(12) DEFAULT NULL,
  `wallet` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `moneymanager`
--

INSERT INTO `moneymanager` (`user_id`, `username`, `request`, `wallet`) VALUES
(6, 'PiDinoSauR', 0, 2958),
(7, 'Chapijtuibay', 0, 7820),
(11, 'Cuong123', 0, 1000),
(12, 'Quang123', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `productincart`
--

CREATE TABLE `productincart` (
  `owner_id` int(11) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `pay_value` int(12) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productincart`
--

INSERT INTO `productincart` (`owner_id`, `id`, `product_name`, `pay_value`, `image_url`) VALUES
(7, 35, 'Tiger', 120, 'https://files.worldwildlife.org/wwfcmsprod/images/Tiger_resting_Bandhavgarh_National_Park_India/hero_small/6aofsvaglm_Medium_WW226365.jpg'),
(7, 38, 'Dog', 50, 'https://files.worldwildlife.org/wwfcmsprod/images/Tiger_resting_Bandhavgarh_National_Park_India/hero_small/6aofsvaglm_Medium_WW226365.jpg'),
(7, 40, 'Cat', 0, 'https://cdn.sforum.vn/sforum/wp-content/uploads/2018/11/2-10.png'),
(7, 41, 'Tiger', 20, 'https://cdn.sforum.vn/sforum/wp-content/uploads/2018/11/2-10.png'),
(7, 43, 'Fox', 500, 'https://www.shihoriobata.com/wp-content/uploads/2021/09/fox-drawing-easy-web.jpg'),
(7, 44, 'Dolphin', 2000, 'https://files.worldwildlife.org/wwfcmsprod/images/Tiger_resting_Bandhavgarh_National_Park_India/hero_small/6aofsvaglm_Medium_WW226365.jpg'),
(6, 49, 'Mouse', 600, 'https://www.woodlandtrust.org.uk/media/50820/house-mouse-wtml-1062551-amy-lewis.jpg'),
(7, 50, 'Dao', 1200, 'https://cdn.sforum.vn/sforum/wp-content/uploads/2018/11/2-10.png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `starting_price` int(12) DEFAULT NULL,
  `buy_out_price` int(12) DEFAULT NULL,
  `ends_time` datetime DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `next_owner_id` int(11) DEFAULT NULL,
  `current_pay` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `user_password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `email`, `username`, `user_password`) VALUES
(-1, 'Boss', 'localhost@gmail.com', 'localhost', '$2y$10$BjbopDhlK.LXVFgU4JAmDuF4g5j7VsCsQiQ.xkrXg6h1rx4DBVOuu'),
(6, 'Ngo Dinh Luyen', 'ngodinhluyennht@gmail.com', 'PiDinoSauR', '$2y$10$IRowfHE0cjIF3b9rtiM75eMBHpg/iHxfRWY3bppbxQYKlNl/3aTw.'),
(7, 'Hoang Thai Minh', 'minhhoang@gmail.com', 'Chapijtuibay', '$2y$10$fgegozpCl.K6MckzpVVDVe4kiczldIanr89eO7TLUa/Hi0oS2RUP6'),
(11, 'Phan Trong Cuong', 'cuong@gmail.com', 'Cuong123', '$2y$10$.6lBcETQwgYXuMXyxnZtCOCb3qzhQcNJ3ubV1jzmTEfcziLSVm0fq'),
(12, 'Nguyen Viet Quang', 'quang@gmail.com', 'Quang123', '$2y$10$wJfyijFbscJymUlUYOnLQOwKNxE3y1k3hWV1Q7ZKjMyBnQOPwQN26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `moneymanager`
--
ALTER TABLE `moneymanager`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
