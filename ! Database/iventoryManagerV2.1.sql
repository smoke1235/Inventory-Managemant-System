-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 19, 2023 at 11:21 AM
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` varchar(100) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `other_details` varchar(500) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_description`, `product_quantity`, `product_price`, `other_details`, `supplier_id`, `date`) VALUES
(13, 'Product 5', 'Description for Product 5', 150, 14.99, 'Details for Product 5', 1, '2023-10-19 10:53:56'),
(14, 'Product 6', 'Description for Product 6', 120, 24.99, 'Details for Product 6', 1, '2023-10-19 10:53:56'),
(15, 'Product 7', 'Description for Product 7', 90, 12.99, 'Details for Product 7', 1, '2023-10-19 10:53:56'),
(16, 'Product 8', 'Description for Product 8', 80, 18.99, 'Details for Product 8', 1, '2023-10-19 10:53:56'),
(17, 'Product 9', 'Description for Product 9', 110, 19.99, 'Details for Product 9', 1, '2023-10-19 10:53:56'),
(18, 'Product 10', 'Description for Product 10', 95, 29.99, 'Details for Product 10', 1, '2023-10-19 10:53:56'),
(19, 'Product 11', 'Description for Product 11', 70, 8.99, 'Details for Product 11', 1, '2023-10-19 10:53:56'),
(20, 'Product 12', 'Description for Product 12', 60, 7.99, 'Details for Product 12', 1, '2023-10-19 10:53:56'),
(21, 'Product 13', 'Description for Product 13', 45, 17.99, 'Details for Product 13', 1, '2023-10-19 10:53:56'),
(22, 'Product 14', 'Description for Product 14', 135, 21.99, 'Details for Product 14', 1, '2023-10-19 10:53:56'),
(23, 'Product 15', 'Description for Product 15', 125, 13.99, 'Details for Product 15', 1, '2023-10-19 10:53:56'),
(24, 'Product 16', 'Description for Product 16', 200, 11.99, 'Details for Product 16', 1, '2023-10-19 10:53:56'),
(25, 'Product 17', 'Description for Product 17', 80, 16.99, 'Details for Product 17', 1, '2023-10-19 10:53:56'),
(26, 'Product 18', 'Description for Product 18', 70, 9.99, 'Details for Product 18', 1, '2023-10-19 10:53:56'),
(27, 'Product 19', 'Description for Product 19', 40, 22.99, 'Details for Product 19', 1, '2023-10-19 10:53:56'),
(28, 'Product 20', 'Description for Product 20', 110, 15.99, 'Details for Product 20', 1, '2023-10-19 10:53:56'),
(29, 'Product 21', 'Description for Product 21', 95, 25.99, 'Details for Product 21', 1, '2023-10-19 10:53:56'),
(30, 'Product 22', 'Description for Product 22', 85, 10.99, 'Details for Product 22', 1, '2023-10-19 10:53:56'),
(31, 'Product 23', 'Description for Product 23', 50, 20.99, 'Details for Product 23', 1, '2023-10-19 10:53:56'),
(32, 'Product 24', 'Description for Product 24', 30, 23.99, 'Details for Product 24', 1, '2023-10-19 10:53:56'),
(33, 'Product 25', 'Description for Product 25', 65, 6.99, 'Details for Product 25', 1, '2023-10-19 10:53:56'),
(34, 'Product 26', 'Description for Product 26', 75, 28.99, 'Details for Product 26', 1, '2023-10-19 10:53:56'),
(35, 'Product 27', 'Description for Product 27', 140, 9.99, 'Details for Product 27', 1, '2023-10-19 10:53:56'),
(36, 'Product 28', 'Description for Product 28', 60, 14.99, 'Details for Product 28', 1, '2023-10-19 10:53:56'),
(37, 'Product 29', 'Description for Product 29', 120, 11.99, 'Details for Product 29', 1, '2023-10-19 10:53:56'),
(38, 'Product 30', 'Description for Product 30', 110, 18.99, 'Details for Product 30', 1, '2023-10-19 10:53:56'),
(39, 'Product 31', 'Description for Product 31', 70, 12.99, 'Details for Product 31', 1, '2023-10-19 10:53:56'),
(40, 'Product 32', 'Description for Product 32', 100, 19.99, 'Details for Product 32', 1, '2023-10-19 10:53:56'),
(41, 'Product 33', 'Description for Product 33', 90, 17.99, 'Details for Product 33', 1, '2023-10-19 10:53:56'),
(42, 'Product 34', 'Description for Product 34', 55, 24.99, 'Details for Product 34', 1, '2023-10-19 10:53:56'),
(43, 'Product 35', 'Description for Product 35', 75, 22.99, 'Details for Product 35', 1, '2023-10-19 10:53:56'),
(44, 'Product 36', 'Description for Product 36', 120, 8.99, 'Details for Product 36', 1, '2023-10-19 10:53:56'),
(45, 'Product 37', 'Description for Product 37', 80, 15.99, 'Details for Product 37', 1, '2023-10-19 10:53:56'),
(46, 'Product 38', 'Description for Product 38', 130, 21.99, 'Details for Product 38', 1, '2023-10-19 10:53:56'),
(47, 'Product 39', 'Description for Product 39', 65, 13.99, 'Details for Product 39', 1, '2023-10-19 10:53:56'),
(48, 'Product 40', 'Description for Product 40', 95, 10.99, 'Details for Product 40', 1, '2023-10-19 10:53:56'),
(49, 'Product 41', 'Description for Product 41', 85, 16.99, 'Details for Product 41', 1, '2023-10-19 10:53:56'),
(50, 'Product 42', 'Description for Product 42', 70, 24.99, 'Details for Product 42', 1, '2023-10-19 10:53:56'),
(51, 'Product 43', 'Description for Product 43', 110, 11.99, 'Details for Product 43', 1, '2023-10-19 10:53:56'),
(52, 'Product 44', 'Description for Product 44', 40, 19.99, 'Details for Product 44', 1, '2023-10-19 10:53:56'),
(53, 'Product 45', 'Description for Product 45', 60, 8.99, 'Details for Product 45', 1, '2023-10-19 10:53:56'),
(54, 'Product 46', 'Description for Product 46', 140, 14.99, 'Details for Product 46', 1, '2023-10-19 10:53:56'),
(55, 'Product 47', 'Description for Product 47', 75, 28.99, 'Details for Product 47', 1, '2023-10-19 10:53:56'),
(56, 'Product 48', 'Description for Product 48', 90, 7.99, 'Details for Product 48', 1, '2023-10-19 10:53:56'),
(57, 'Product 49', 'Description for Product 49', 105, 13.99, 'Details for Product 49', 1, '2023-10-19 10:53:56'),
(58, 'Product 50', 'Description for Product 50', 120, 29.99, 'Details for Product 50', 1, '2023-10-19 10:53:56'),
(59, 'Product 51', 'Description for Product 51', 80, 12.99, 'Details for Product 51', 1, '2023-10-19 10:53:56'),
(60, 'Product 52', 'Description for Product 52', 50, 22.99, 'Details for Product 52', 1, '2023-10-19 10:53:56'),
(61, 'Product 53', 'Description for Product 53', 65, 17.99, 'Details for Product 53', 1, '2023-10-19 10:53:56'),
(62, 'Product 54', 'Description for Product 54', 95, 9.99, 'Details for Product 54', 1, '2023-10-19 10:53:56'),
(63, 'Product 55', 'Description for Product 55', 75, 24.99, 'Details for Product 55', 1, '2023-10-19 10:53:56'),
(64, 'Product 56', 'Description for Product 56', 55, 15.99, 'Details for Product 56', 1, '2023-10-19 10:53:56'),
(65, 'Product 57', 'Description for Product 57', 65, 21.99, 'Details for Product 57', 1, '2023-10-19 10:53:56'),
(66, 'Product 58', 'Description for Product 58', 100, 20.99, 'Details for Product 58', 1, '2023-10-19 10:53:56'),
(67, 'Product 59', 'Description for Product 59', 120, 12.99, 'Details for Product 59', 1, '2023-10-19 10:53:56'),
(68, 'Product 60', 'Description for Product 60', 40, 11.99, 'Details for Product 60', 1, '2023-10-19 10:53:56'),
(69, 'Product 61', 'Description for Product 61', 110, 18.99, 'Details for Product 61', 1, '2023-10-19 10:53:56'),
(70, 'Product 62', 'Description for Product 62', 85, 16.99, 'Details for Product 62', 1, '2023-10-19 10:53:56'),
(71, 'Product 63', 'Description for Product 63', 75, 13.99, 'Details for Product 63', 1, '2023-10-19 10:53:56'),
(72, 'Product 64', 'Description for Product 64', 90, 9.99, 'Details for Product 64', 1, '2023-10-19 10:53:56'),
(73, 'Product 65', 'Description for Product 65', 70, 29.99, 'Details for Product 65', 1, '2023-10-19 10:53:56'),
(74, 'Product 66', 'Description for Product 66', 120, 17.99, 'Details for Product 66', 1, '2023-10-19 10:53:56'),
(75, 'Product 67', 'Description for Product 67', 55, 19.99, 'Details for Product 67', 1, '2023-10-19 10:53:56'),
(76, 'Product 68', 'Description for Product 68', 140, 14.99, 'Details for Product 68', 1, '2023-10-19 10:53:56'),
(77, 'Product 69', 'Description for Product 69', 150, 23.99, 'Details for Product 69', 1, '2023-10-19 10:53:56'),
(78, 'Product 70', 'Description for Product 70', 160, 27.99, 'Details for Product 70', 1, '2023-10-19 10:53:56'),
(79, 'Product 71', 'Description for Product 71', 60, 25.99, 'Details for Product 71', 1, '2023-10-19 10:53:56'),
(80, 'Product 72', 'Description for Product 72', 110, 20.99, 'Details for Product 72', 1, '2023-10-19 10:53:56'),
(81, 'Product 73', 'Description for Product 73', 75, 16.99, 'Details for Product 73', 1, '2023-10-19 10:53:56'),
(82, 'Product 74', 'Description for Product 74', 50, 9.99, 'Details for Product 74', 1, '2023-10-19 10:53:56'),
(83, 'Product 75', 'Description for Product 75', 90, 22.99, 'Details for Product 75', 1, '2023-10-19 10:53:56'),
(84, 'Product 76', 'Description for Product 76', 110, 10.99, 'Details for Product 76', 1, '2023-10-19 10:53:56'),
(85, 'Product 77', 'Description for Product 77', 70, 18.99, 'Details for Product 77', 1, '2023-10-19 10:53:56'),
(86, 'Product 78', 'Description for Product 78', 130, 11.99, 'Details for Product 78', 1, '2023-10-19 10:53:56'),
(87, 'Product 79', 'Description for Product 79', 70, 19.99, 'Details for Product 79', 1, '2023-10-19 10:53:56'),
(88, 'Product 80', 'Description for Product 80', 50, 24.99, 'Details for Product 80', 1, '2023-10-19 10:53:56'),
(89, 'Product 81', 'Description for Product 81', 75, 13.99, 'Details for Product 81', 1, '2023-10-19 10:53:56'),
(90, 'Product 82', 'Description for Product 82', 65, 15.99, 'Details for Product 82', 1, '2023-10-19 10:53:56'),
(91, 'Product 83', 'Description for Product 83', 60, 8.99, 'Details for Product 83', 1, '2023-10-19 10:53:56'),
(92, 'Product 84', 'Description for Product 84', 110, 28.99, 'Details for Product 84', 1, '2023-10-19 10:53:56'),
(93, 'Product 85', 'Description for Product 85', 75, 12.99, 'Details for Product 85', 1, '2023-10-19 10:53:56'),
(94, 'Product 86', 'Description for Product 86', 100, 21.99, 'Details for Product 86', 1, '2023-10-19 10:53:56'),
(95, 'Product 87', 'Description for Product 87', 40, 16.99, 'Details for Product 87', 1, '2023-10-19 10:53:56'),
(96, 'Product 88', 'Description for Product 88', 95, 26.99, 'Details for Product 88', 1, '2023-10-19 10:53:56'),
(97, 'Product 89', 'Description for Product 89', 140, 7.99, 'Details for Product 89', 1, '2023-10-19 10:53:56'),
(98, 'Product 90', 'Description for Product 90', 65, 14.99, 'Details for Product 90', 1, '2023-10-19 10:53:56'),
(99, 'Product 91', 'Description for Product 91', 110, 23.99, 'Details for Product 91', 1, '2023-10-19 10:53:56'),
(100, 'Product 92', 'Description for Product 92', 90, 10.99, 'Details for Product 92', 1, '2023-10-19 10:53:56'),
(101, 'Product 93', 'Description for Product 93', 70, 9.99, 'Details for Product 93', 1, '2023-10-19 10:53:56'),
(102, 'Product 94', 'Description for Product 94', 85, 17.99, 'Details for Product 94', 1, '2023-10-19 10:53:56'),
(103, 'Product 95', 'Description for Product 95', 75, 13.99, 'Details for Product 95', 1, '2023-10-19 10:53:56'),
(104, 'Product 96', 'Description for Product 96', 110, 8.99, 'Details for Product 96', 1, '2023-10-19 10:53:56'),
(105, 'Product 97', 'Description for Product 97', 60, 19.99, 'Details for Product 97', 1, '2023-10-19 10:53:56'),
(106, 'Product 98', 'Description for Product 98', 140, 11.99, 'Details for Product 98', 1, '2023-10-19 10:53:56'),
(107, 'Product 99', 'Description for Product 99', 80, 20.99, 'Details for Product 99', 1, '2023-10-19 10:53:56'),
(108, 'Product 100', 'Description for Product 100', 65, 15.99, 'Details for Product 100', 1, '2023-10-19 10:53:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
