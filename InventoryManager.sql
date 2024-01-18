-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 18, 2024 at 03:35 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `InventoryManager`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `first_name` varchar(90) NOT NULL,
  `last_name` varchar(90) NOT NULL,
  `company_name` varchar(60) NOT NULL,
  `number` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `street` varchar(90) NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `city` varchar(90) NOT NULL,
  `country` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `company_name`, `number`, `email`, `street`, `postcode`, `city`, `country`) VALUES
(167, 'firstname', 'lastname', 'test bv', '3106123456789', 'test@test.nl', 'straat 1', '1234 aa', 'stad', 'nederland');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `number` varchar(15) NOT NULL,
  `mail` varchar(90) NOT NULL,
  `shipping_name` varchar(100) NOT NULL,
  `shipping_company` varchar(100) DEFAULT NULL,
  `shipping_street` varchar(100) NOT NULL,
  `shipping_postalcode` varchar(7) NOT NULL,
  `shipping_city` varchar(100) NOT NULL,
  `shipping_country` varchar(100) NOT NULL,
  `billing_name` varchar(100) NOT NULL,
  `billing_company` varchar(100) DEFAULT NULL,
  `billing_street` varchar(100) NOT NULL,
  `billing_postalcode` varchar(7) NOT NULL,
  `billing_city` varchar(100) NOT NULL,
  `billing_country` varchar(100) NOT NULL,
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `status`, `user_id`, `customer_id`, `number`, `mail`, `shipping_name`, `shipping_company`, `shipping_street`, `shipping_postalcode`, `shipping_city`, `shipping_country`, `billing_name`, `billing_company`, `billing_street`, `billing_postalcode`, `billing_city`, `billing_country`, `updated`, `created`) VALUES
(70, 6, 71, 167, '3106123456789', 'test@test.nl', 'Fistname Lastname', 'test bv.', 'straat 1', '1234 AA', 'stad', 'nederland', 'Firstname Lastname', 'test bv.', 'straat 1', '1234 aa', 'stad', 'nederland', '2024-01-18 14:24:26', '2024-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_line`
--

CREATE TABLE `invoice_line` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_line`
--

INSERT INTO `invoice_line` (`id`, `invoice_id`, `product_id`, `quantity`) VALUES
(117, 70, 148, 5),
(118, 70, 146, 2),
(119, 70, 147, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_status`
--

CREATE TABLE `invoice_status` (
  `id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_status`
--

INSERT INTO `invoice_status` (`id`, `status`) VALUES
(3, 'PAID'),
(4, 'RETURNED'),
(5, 'CLOSED'),
(6, 'IN PROCESS'),
(7, 'ARCHIEVED'),
(8, 'SHIPPING'),
(9, 'SHIPPED');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `number` varchar(15) NOT NULL,
  `mail` varchar(90) NOT NULL,
  `shipping_name` varchar(100) NOT NULL,
  `shipping_company` varchar(100) NOT NULL,
  `shipping_street` varchar(100) NOT NULL,
  `shipping_postalcode` varchar(7) NOT NULL,
  `shipping_city` varchar(100) NOT NULL,
  `shipping_country` varchar(100) NOT NULL,
  `billing_name` varchar(100) NOT NULL,
  `billing_company` varchar(100) NOT NULL,
  `billing_street` varchar(100) NOT NULL,
  `billing_postalcode` varchar(7) NOT NULL,
  `billing_city` varchar(100) NOT NULL,
  `billing_country` varchar(100) NOT NULL,
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  `created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `status`, `user_id`, `customer_id`, `number`, `mail`, `shipping_name`, `shipping_company`, `shipping_street`, `shipping_postalcode`, `shipping_city`, `shipping_country`, `billing_name`, `billing_company`, `billing_street`, `billing_postalcode`, `billing_city`, `billing_country`, `updated`, `created`) VALUES
(12, 2, 71, 167, '3106123456789', 'test@test.nl', 'test test', 'test bv', 'straat 1', '1234 aa', 'stad', 'nederland', 'test test', 'test bv', 'straat 1', '1234 aa', 'stad', 'nederland', '2024-01-18 15:09:48', '2024-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `order_line`
--

CREATE TABLE `order_line` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_line`
--

INSERT INTO `order_line` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(10, 12, 147, 1),
(11, 12, 148, 6),
(12, 12, 146, 4);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status`) VALUES
(1, 'IN PROCESS'),
(2, 'SHIPPING'),
(3, 'DELIVERED'),
(4, 'CLOSED'),
(5, 'RETURNED'),
(7, 'ARCHIEVED');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_description` varchar(100) DEFAULT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `other_details` text DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_description`, `product_quantity`, `product_price`, `other_details`, `supplier_id`, `date`) VALUES
(146, 'poster', 'A4', 121, 50, 'test', 53, '2024-01-16'),
(147, 'A5 Poster', '14.8 x 21 cm', 30, 45, '', 53, '2024-01-17'),
(148, 'Verf', '', 12, 12.99, '', 53, '2024-01-17');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(90) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `street` varchar(90) NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `city` varchar(90) NOT NULL,
  `country` varchar(90) NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `number`, `email`, `street`, `postcode`, `city`, `country`, `dateTime`) VALUES
(53, 'test bv', '3106123456789', 'test@test.nl', 'straat 1', '1234 aa', 'stad', 'nederland', '2024-01-16 09:46:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(80) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created`) VALUES
(71, 'test', '$2y$10$r2jiHfgG7ueY4NTflIxw2upjRA855aok4R/8Nx41fdsuZW5ejUVPy', 'test@test.com', '2024-01-09 16:05:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `invoice_line`
--
ALTER TABLE `invoice_line`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`product_id`);

--
-- Indexes for table `invoice_status`
--
ALTER TABLE `invoice_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_user` (`user_id`),
  ADD KEY `order_status` (`status`);

--
-- Indexes for table `order_line`
--
ALTER TABLE `order_line`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_product` (`product_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `invoice_line`
--
ALTER TABLE `invoice_line`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `invoice_status`
--
ALTER TABLE `invoice_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_line`
--
ALTER TABLE `order_line`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `status` FOREIGN KEY (`status`) REFERENCES `invoice_status` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `invoice_line`
--
ALTER TABLE `invoice_line`
  ADD CONSTRAINT `product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `order_line`
--
ALTER TABLE `order_line`
  ADD CONSTRAINT `order_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
