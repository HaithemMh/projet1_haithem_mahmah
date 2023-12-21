-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 05:24 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce-store`
--

-- --------------------------------------------------------


--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `product_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pmode` varchar(50) NOT NULL,
  `products` varchar(255) NOT NULL,
  `amount_paid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_qty` int(11) NOT NULL DEFAULT 1,
  `product_image` varchar(255) NOT NULL,
  `product_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_price`, `product_qty`, `product_image`, `product_code`) VALUES
(1, 'chicago bulls', '45', 1, '../image/chicago_bulls.png', 'p1000'),
(2, 'Dallas', '50', 1, '../image/dallas.png', 'p1001'),
(3, 'roptors', '35', 1, '../image/green_raptors.png', 'p1002'),
(4, 'mclaren bob', '44', 1, '../image/mclaren_bob.png', 'p1003'),
(5, 'new era bob', '120', 1, '../image/new_era_bob.png', 'p1004'),
(6, 'parcers', '65', 1, '../image/pacers.png', 'p1005'),
(7, 'raiders', '59', 1, '../image/raiders.png', 'p1006'),
(9, 'red chicago bulls', '89', 1, '../image/red_chicago.png', 'p1007'),
(10, 'usa', '49', 1, '../image/usa.png', 'p1008'),
(11, 'chelsea', '49', 1, '../image/chelsea.png', 'p1009'),
(12, 'manchester', '39', 1, '../image/manu.png', 'p1010'),
(13, 'man-united', '29', 1, '../image/manu1.png', 'p1011'),
(14, 'inter-miami', '29', 1, '../image/m.png', 'p1012'),
(15, 'ac-milan-bob', '29', 1, '../image/ac-milan-bob.png', 'p1013'),
(16, 'M-D', '45', 1, '../image/md.png', 'p1014'),
(17, 'raiders 1', '50', 1, '../image/r.png', 'p1015'),
(18, 'rouge', '45', 1, '../image/r.png', 'p1016'),
(19, 'noir', '45', 1, '../image/P.png', 'p1017');



-- --------------------------------------------------------

--
-- Table structure for table `users`
--


CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




-- Table admins
CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_nom` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `mot_de_passe_admin` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_nom` (`admin_nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO admins (admin_nom, admin_email, mot_de_passe_admin, role) VALUES
 ('superadmin', 'superadmin@admin.ca', '12345678', 'superadmin');


--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code_2` (`product_code`),
  ADD KEY `product_code` (`product_code`);


--
-- AUTO_INCREMENT for dumped tables
--



--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
