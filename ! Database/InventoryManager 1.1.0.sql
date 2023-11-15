-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 15, 2023 at 04:19 PM
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
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `street` varchar(90) NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `city` varchar(90) NOT NULL,
  `country` varchar(60) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`, `number`, `email`, `company_name`, `street`, `postcode`, `city`, `country`, `date`) VALUES
(48, 'Michael', 'Brown', '0', '', 'MB Inc.', '101 Pine Street', '54321', 'Smallville', 'USA', '2023-10-19 11:09:44'),
(49, 'Jennifer', 'Lee', '0', '', 'Lee Corporation', '202 Oak Avenue', '98765', 'Metro City', 'Canada', '2023-10-19 11:09:44'),
(50, 'Robert', 'Williams', '0', '', 'Williams Group', '303 Maple Road', '11111', 'Newtown', 'UK', '2023-10-19 11:09:44'),
(51, 'Linda', 'Jones', '0', '', 'Jones Enterprises', '404 Birch Lane', '22222', 'Ruralville', 'Australia', '2023-10-19 11:09:44'),
(52, 'William', 'Taylor', '0', '', 'Taylor Co.', '505 Cedar Lane', '33333', 'Suburbia', 'Germany', '2023-10-19 11:09:44'),
(53, 'Emily', 'Anderson', '0', '', 'Anderson Ltd.', '606 Redwood Drive', '44444', 'Villageville', 'France', '2023-10-19 11:09:44'),
(54, 'James', 'Wilson', '0', '', 'Wilson Group', '707 Elm Way', '55555', 'Hometown', 'Spain', '2023-10-19 11:09:44'),
(55, 'Mary', 'Davis', '0', '', 'MD Corporation', '808 Spruce Lane', '66666', 'Bigtown', 'Italy', '2023-10-19 11:09:44'),
(56, 'David', 'Moore', '0', '', 'Moore Enterprises', '909 Pine Road', '77777', 'Megacity', 'Japan', '2023-10-19 11:09:44'),
(57, 'Susan', 'Clark', '0', '', 'Clark Co.', '1010 Maple Avenue', '88888', 'Gotham City', 'South Korea', '2023-10-19 11:09:44'),
(58, 'Karen', 'Miller', '0', '', 'Miller Ltd.', '1111 Birch Street', '99999', 'Springfield', 'Brazil', '2023-10-19 11:09:44'),
(59, 'Charles', 'White', '0', '', 'White Corporation', '1212 Oak Lane', '12345', 'Central City', 'Mexico', '2023-10-19 11:09:44'),
(60, 'Jessica', 'Thomas', '0', '', 'Thomas Group', '1313 Elm Road', '23456', 'Metropolis', 'Argentina', '2023-10-19 11:09:44'),
(61, 'Matthew', 'Harris', '0', '', 'Harris Enterprises', '1414 Redwood Way', '34567', 'Harbor City', 'India', '2023-10-19 11:09:44'),
(62, 'Patricia', 'Martin', '0', '', 'Martin Ltd.', '1515 Cedar Avenue', '45678', 'Beach Town', 'China', '2023-10-19 11:09:44'),
(63, 'Richard', 'Thompson', '0', '', 'Thompson Co.', '1616 Maple Lane', '56789', 'Mountainview', 'Russia', '2023-10-19 11:09:44'),
(64, 'Sarah', 'Walker', '0', '', 'Walker Corporation', '1717 Pine Drive', '67890', 'Lakeside', 'South Africa', '2023-10-19 11:09:44'),
(65, 'John', 'Wilson', '0', '', 'Wilson Group', '1818 Birch Avenue', '76543', 'Villagetown', 'New Zealand', '2023-10-19 11:09:44'),
(66, 'Nancy', 'Davis', '0', '', 'Davis Enterprises', '1919 Oak Road', '65432', 'Suburbville', 'Ireland', '2023-10-19 11:09:44'),
(67, 'Daniel', 'Hall', '0', '', 'Hall Corporation', '2020 Elm Way', '54321', 'Countryville', 'Sweden', '2023-10-19 11:09:44'),
(68, 'Lisa', 'Lewis', '0', '', 'Lewis Co.', '2121 Maple Street', '43210', 'Townsville', 'Netherlands', '2023-10-19 11:09:44'),
(69, 'Paul', 'Parker', '0', '', 'Parker Group', '2222 Cedar Road', '32109', 'Citytown', 'Belgium', '2023-10-19 11:09:44'),
(70, 'Elizabeth', 'Wood', '0', '', 'Wood Ltd.', '2323 Redwood Lane', '21098', 'Downtown', 'Portugal', '2023-10-19 11:09:44'),
(71, 'Kevin', 'Young', '0', '', 'Young Corporation', '2424 Pine Avenue', '10987', 'Hillside', 'Greece', '2023-10-19 11:09:44'),
(72, 'Laura', 'Scott', '0', '', 'Scott Co.', '2525 Oak Lane', '09876', 'Valleyville', 'Norway', '2023-10-19 11:09:44'),
(73, 'Andrew', 'Evans', '0', '', 'Evans Enterprises', '2626 Elm Drive', '98765', 'Beachtown', 'Denmark', '2023-10-19 11:09:44'),
(74, 'Sharon', 'Roberts', '0', '', 'Roberts Ltd.', '2727 Birch Street', '87654', 'Parkville', 'Finland', '2023-10-19 11:09:44'),
(75, 'Mark', 'Turner', '0', '', 'Turner Group', '2828 Maple Way', '76543', 'Riverside', 'Switzerland', '2023-10-19 11:09:44'),
(76, 'Cynthia', 'Reed', '0', '', 'Reed Corporation', '2929 Cedar Road', '65432', 'Highland', 'Austria', '2023-10-19 11:09:44'),
(77, 'Steven', 'Cook', '0', '', 'Cook Ltd.', '3030 Redwood Avenue', '54321', 'Uptown', 'Poland', '2023-10-19 11:09:44'),
(78, 'Karen', 'Kelly', '0', '', 'Kelly Co.', '3131 Pine Lane', '43210', 'Laketown', 'Czech Republic', '2023-10-19 11:09:44'),
(79, 'Eric', 'Rivera', '0', '', 'Rivera Group', '3232 Oak Drive', '32109', 'Hometown', 'Hungary', '2023-10-19 11:09:44'),
(80, 'Michelle', 'Gonzalez', '0', '', 'Gonzalez Co.', '3333 Elm Avenue', '21098', 'Villageville', 'Slovakia', '2023-10-19 11:09:44'),
(81, 'Joseph', 'Baker', '0', '', 'Baker Enterprises', '3434 Birch Street', '10987', 'Villagetown', 'Romania', '2023-10-19 11:09:44'),
(82, 'Susan', 'Hall', '0', '', 'Hall Ltd.', '3535 Maple Lane', '09876', 'Suburbia', 'Bulgaria', '2023-10-19 11:09:44'),
(83, 'Thomas', 'Ross', '0', '', 'Ross Group', '3636 Cedar Road', '98765', 'Countryside', 'Croatia', '2023-10-19 11:09:44'),
(84, 'Lisa', 'Phillips', '0', '', 'Phillips Co.', '3737 Redwood Road', '87654', 'Smalltown', 'Serbia', '2023-10-19 11:09:44'),
(85, 'David', 'Hernandez', '0', '', 'Hernandez Ltd.', '3838 Pine Way', '76543', 'Countryside', 'Slovenia', '2023-10-19 11:09:44'),
(86, 'Jennifer', 'Morgan', '0', '', 'Morgan Corporation', '3939 Oak Avenue', '65432', 'Hillville', 'Estonia', '2023-10-19 11:09:44'),
(87, 'William', 'Butler', '0', '', 'Butler Group', '4040 Elm Lane', '54321', 'Lowville', 'Latvia', '2023-10-19 11:09:44'),
(88, 'Mary', 'Simmons', '0', '', 'Simmons Co.', '4141 Birch Drive', '43210', 'Forestville', 'Lithuania', '2023-10-19 11:09:44'),
(89, 'Daniel', 'Foster', '0', '', 'Foster Enterprises', '4242 Maple Street', '32109', 'Villageland', 'Ukraine', '2023-10-19 11:09:44'),
(90, 'Nancy', 'Gomez', '0', '', 'Gomez Co.', '4343 Cedar Lane', '21098', 'Lakeland', 'Belarus', '2023-10-19 11:09:44'),
(91, 'Richard', 'Hayes', '0', '', 'Hayes Corporation', '4444 Redwood Lane', '10987', 'Landville', 'Moldova', '2023-10-19 11:09:44'),
(92, 'Deborah', 'Webb', '0', '', 'Webb Ltd.', '4545 Pine Road', '09876', 'Townsville', 'Uzbekistan', '2023-10-19 11:09:44'),
(93, 'Kenneth', 'Bishop', '0', '', 'Bishop Group', '4646 Oak Street', '98765', 'Villagefield', 'Kazakhstan', '2023-10-19 11:09:44'),
(94, 'Susan', 'Weaver', '0', '', 'Weaver Corporation', '4747 Elm Way', '87654', 'Countryfield', 'Tajikistan', '2023-10-19 11:09:44'),
(95, 'John', 'Anderson', '0', '', 'Anderson Inc.', '101 Pine Street', '54321', 'Smallville', 'USA', '2023-10-19 11:11:15'),
(96, 'Sarah', 'Harris', '0', '', 'Harris Corporation', '202 Oak Avenue', '98765', 'Metro City', 'Canada', '2023-10-19 11:11:15'),
(97, 'Michael', 'Wilson', '0', '', 'Wilson Co.', '303 Maple Road', '11111', 'Newtown', 'UK', '2023-10-19 11:11:15'),
(98, 'Jennifer', 'Smith', '0', '', 'Smith Ltd.', '404 Birch Lane', '22222', 'Ruralville', 'Australia', '2023-10-19 11:11:15'),
(99, 'David', 'Martin', '0', '', 'Martin Enterprises', '505 Cedar Lane', '33333', 'Suburbia', 'Germany', '2023-10-19 11:11:15'),
(100, 'Laura', 'Garcia', '0', '', 'Garcia Ltd.', '606 Redwood Drive', '44444', 'Villageville', 'France', '2023-10-19 11:11:15'),
(101, 'William', 'Brown', '0', '', 'Brown Co.', '707 Elm Way', '55555', 'Hometown', 'Spain', '2023-10-19 11:11:15'),
(102, 'Linda', 'Moore', '0', '', 'Moore Corporation', '808 Spruce Lane', '66666', 'Bigtown', 'Italy', '2023-10-19 11:11:15'),
(103, 'Robert', 'Taylor', '0', '', 'Taylor Group', '909 Pine Road', '77777', 'Megacity', 'Japan', '2023-10-19 11:11:15'),
(104, 'Mary', 'Davis', '0', '', 'Davis Inc.', '1010 Maple Avenue', '88888', 'Gotham City', 'South Korea', '2023-10-19 11:11:15'),
(105, 'James', 'Hall', '0', '', 'Hall Ltd.', '1111 Birch Street', '99999', 'Springfield', 'Brazil', '2023-10-19 11:11:15'),
(106, 'Karen', 'Thomas', '0', '', 'Thomas Enterprises', '1212 Oak Lane', '12345', 'Central City', 'Mexico', '2023-10-19 11:11:15'),
(107, 'Elizabeth', 'Young', '0', '', 'Young Group', '1313 Elm Road', '23456', 'Metropolis', 'Argentina', '2023-10-19 11:11:15'),
(108, 'Charles', 'Hernandez', '0', '', 'Hernandez Corporation', '1414 Redwood Way', '34567', 'Harbor City', 'India', '2023-10-19 11:11:15'),
(109, 'Jennifer', 'Lewis', '0', '', 'Lewis Co.', '1515 Cedar Avenue', '45678', 'Beach Town', 'China', '2023-10-19 11:11:15'),
(110, 'Joseph', 'Roberts', '0', '', 'Roberts Inc.', '1616 Maple Lane', '56789', 'Mountainview', 'Russia', '2023-10-19 11:11:15'),
(111, 'Cynthia', 'Turner', '0', '', 'Turner Enterprises', '1717 Pine Drive', '67890', 'Lakeside', 'South Africa', '2023-10-19 11:11:15'),
(112, 'Paul', 'King', '0', '', 'King Group', '1818 Birch Avenue', '76543', 'Villagetown', 'New Zealand', '2023-10-19 11:11:15'),
(113, 'Mark', 'Thompson', '0', '', 'Thompson Ltd.', '1919 Oak Road', '65432', 'Suburbville', 'Ireland', '2023-10-19 11:11:15'),
(114, 'Karen', 'Perez', '0', '', 'Perez Corporation', '2020 Elm Way', '54321', 'Countryville', 'Sweden', '2023-10-19 11:11:15'),
(115, 'Steven', 'Scott', '0', '', 'Scott Inc.', '2121 Maple Street', '43210', 'Townsville', 'Netherlands', '2023-10-19 11:11:15'),
(116, 'Jennifer', 'Adams', '06123456789', 'j.adams@example.nl', 'Adams Co.', '2222 Cedar Road', '32109', 'Citytown', 'Belgium', '2023-10-19 11:11:15'),
(117, 'David', 'Evans', '0', '', 'Evans Group', '2323 Redwood Lane', '21098', 'Downtown', 'Portugal', '2023-10-19 11:11:15'),
(118, 'Amy', 'Cooper', '0', '', 'Cooper Ltd.', '2424 Pine Avenue', '10987', 'Hillside', 'Greece', '2023-10-19 11:11:15'),
(119, 'Robert', 'Foster', '0', '', 'Foster Corporation', '2525 Oak Lane', '09876', 'Valleyville', 'Norway', '2023-10-19 11:11:15'),
(120, 'Nancy', 'Bell', '0', '', 'Bell Co.', '2626 Elm Drive', '98765', 'Beachtown', 'Denmark', '2023-10-19 11:11:15'),
(121, 'Matthew', 'Bennett', '0', '', 'Bennett Group', '2727 Birch Street', '87654', 'Parkville', 'Finland', '2023-10-19 11:11:15'),
(122, 'Lisa', 'Reed', '0', '', 'Reed Ltd.', '2828 Maple Way', '76543', 'Riverside', 'Switzerland', '2023-10-19 11:11:15'),
(123, 'Richard', 'Price', '0', '', 'Price Co.', '2929 Cedar Road', '65432', 'Highland', 'Austria', '2023-10-19 11:11:15'),
(124, 'Laura', 'Fisher', '0', '', 'Fisher Group', '3030 Redwood Avenue', '54321', 'Uptown', 'Poland', '2023-10-19 11:11:15'),
(125, 'Michael', 'Mitchell', '0', '', 'Mitchell Ltd.', '3131 Pine Lane', '43210', 'Laketown', 'Czech Republic', '2023-10-19 11:11:15'),
(126, 'Sarah', 'Russell', '0', '', 'Russell Corporation', '3232 Oak Drive', '32109', 'Hometown', 'Hungary', '2023-10-19 11:11:15'),
(127, 'Christopher', 'Ward', '0', '', 'Ward Co.', '3333 Elm Avenue', '21098', 'Villageville', 'Slovakia', '2023-10-19 11:11:15'),
(128, 'Sharon', 'Carter', '0', '', 'Carter Ltd.', '3434 Birch Street', '10987', 'Villagetown', 'Romania', '2023-10-19 11:11:15'),
(129, 'Daniel', 'Barnes', '0', '', 'Barnes Group', '3535 Maple Lane', '09876', 'Suburbia', 'Bulgaria', '2023-10-19 11:11:15'),
(130, 'Sarah', 'Baker', '0', '', 'Baker Inc.', '3636 Cedar Road', '98765', 'Countryside', 'Croatia', '2023-10-19 11:11:15'),
(131, 'Jason', 'Diaz', '0', '', 'Diaz Corporation', '3737 Redwood Road', '87654', 'Smalltown', 'Serbia', '2023-10-19 11:11:15'),
(132, 'Jennifer', 'Stewart', '0', '', 'Stewart Co.', '3838 Pine Way', '76543', 'Countryside', 'Slovenia', '2023-10-19 11:11:15'),
(133, 'Daniel', 'Gomez', '0', '', 'Gomez Ltd.', '3939 Oak Avenue', '65432', 'Hillville', 'Estonia', '2023-10-19 11:11:15'),
(134, 'Sarah', 'Ward', '0', '', 'Ward Group', '4040 Elm Lane', '54321', 'Lowville', 'Latvia', '2023-10-19 11:11:15'),
(135, 'Jason', 'Morales', '0', '', 'Morales Co.', '4141 Birch Drive', '43210', 'Forestville', 'Lithuania', '2023-10-19 11:11:15'),
(136, 'Susan', 'Myers', '0', '', 'Myers Ltd.', '4242 Maple Street', '32109', 'Villageland', 'Ukraine', '2023-10-19 11:11:15'),
(137, 'Joseph', 'Powell', '0', '', 'Powell Group', '4343 Cedar Lane', '21098', 'Lakeland', 'Belarus', '2023-10-19 11:11:15'),
(138, 'Cynthia', 'Watson', '0', '', 'Watson Corporation', '4444 Redwood Lane', '10987', 'Landville', 'Moldova', '2023-10-19 11:11:15'),
(139, 'David', 'Sullivan', '0', '', 'Sullivan Co.', '4545 Pine Road', '09876', 'Townsville', 'Uzbekistan', '2023-10-19 11:11:15'),
(140, 'Karen', 'Burns', '0', '', 'Burns Group', '4646 Oak Street', '98765', 'Villagefield', 'Kazakhstan', '2023-10-19 11:11:15'),
(141, 'Steven', 'Fox', '0', '', 'Fox Corporation', '4747 Elm Way', '87654', 'Countryfield', 'Tajikistan', '2023-10-19 11:11:15'),
(142, 'Henk', 'Tee', '6123456789', 'henk.t@test.com', 'tee bv', 'straat 1', '1234 aa', 'rotterdam', 'Nederland', '2023-10-30 11:54:50'),
(143, 'Mike', 'Tyson', '6123456789', 'm.tyson@axample.com', 'boxer LLC.', 'oxerstreet', '1234 AA', 'Chicago', 'USA', '2023-11-02 11:30:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `catergory` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` float NOT NULL,
  `expected` date NOT NULL,
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `catergory`, `customer_id`, `user_id`, `product_id`, `quantity`, `unit_price`, `expected`, `updated`, `created`) VALUES
(3, 111111111, 6, 118, 1, 13, 2, 40, '2023-11-29', '2023-11-15 13:50:03', '2023-11-15 13:50:03'),
(4, 222222222, 3, 73, 1, 33, 1, 12.99, '2023-11-20', '2023-11-15 14:02:36', '2023-11-15 14:02:36');

-- --------------------------------------------------------

--
-- Table structure for table `order_catergory`
--

CREATE TABLE `order_catergory` (
  `id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_catergory`
--

INSERT INTO `order_catergory` (`id`, `status`) VALUES
(3, 'PAID'),
(4, 'RETURNED'),
(5, 'CLOSED'),
(6, 'IN PROCESS'),
(7, 'ARCHIEVED');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` varchar(100) DEFAULT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` float NOT NULL,
  `other_details` varchar(500) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
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
(100, 'Product 92', 'Description for Product 92 ', 90, 10.99, 'Details for Product 92', 15, '2023-10-19 10:53:56'),
(101, 'Product 93', 'Description for Product 93', 70, 9.99, 'Details for Product 93', 1, '2023-10-19 10:53:56'),
(102, 'Product 94', 'Description for Product 94', 85, 17.99, 'Details for Product 94', 1, '2023-10-19 10:53:56'),
(103, 'Product 95', 'Description for Product 95', 75, 13.99, 'Details for Product 95', 1, '2023-10-19 10:53:56'),
(104, 'Product 96', 'Description for Product 96', 110, 8.99, 'Details for Product 96', 1, '2023-10-19 10:53:56'),
(105, 'Product 97', 'Description for Product 97', 60, 19.99, 'Details for Product 97', 1, '2023-10-19 10:53:56'),
(106, 'Product 98', 'Description for Product 98', 140, 11.99, 'Details for Product 98', 1, '2023-10-19 10:53:56'),
(107, 'Product 99', 'Description for Product 99', 80, 20.99, 'Details for Product 99', 1, '2023-10-19 10:53:56'),
(108, 'Product 100', 'Description for Product 100', 65, 15.99, 'Details for Product 100', 1, '2023-10-19 10:53:56'),
(109, 'Product 5', 'This is the description for Product 5', 60, 12.99, 'Random details for Product 5', 1, '2023-10-19 11:41:20'),
(110, 'Product 6', 'This is the description for Product 6', 90, 8.99, 'Random details for Product 6', 1, '2023-10-19 11:41:20'),
(111, 'Product 7', 'This is the description for Product 7', 120, 24.99, 'Random details for Product 7', 1, '2023-10-19 11:41:20'),
(112, 'Product 8', 'This is the description for Product 8', 30, 15.99, 'Random details for Product 8', 1, '2023-10-19 11:41:20'),
(113, 'Product 9', 'This is the description for Product 9', 70, 32.99, 'Random details for Product 9', 1, '2023-10-19 11:41:20'),
(114, 'Product 10', 'This is the description for Product 10', 25, 7.99, 'Random details for Product 10', 1, '2023-10-19 11:41:20'),
(115, 'Product 11', 'This is the description for Product 11', 150, 44.99, 'Random details for Product 11', 1, '2023-10-19 11:41:20'),
(116, 'Product 12', 'This is the description for Product 12', 40, 19.99, 'Random details for Product 12', 1, '2023-10-19 11:41:20'),
(117, 'Product 13', 'This is the description for Product 13', 85, 28.99, 'Random details for Product 13', 1, '2023-10-19 11:41:20'),
(118, 'Product 14', 'This is the description for Product 14 ', 55, 10.99, 'Random details for Product 14', 49, '2023-10-19 11:41:20'),
(119, 'insert test via browser', 'details about product', 1, 0, 'more details', 7, '2023-10-20 13:42:55'),
(120, 'test voor de zekerheid', 'blue ', 65, 34.59, 'HEAVY 55KG', 17, '2023-10-30 09:03:15'),
(122, 'banjo', 'yellow', 30, 399, 'fragile', 37, '2023-11-02 11:32:18'),
(131, 'spoon', 'Silver', 13, 0.99, 'none', 17, '2023-11-02 15:46:11'),
(133, 'Necklace', 'Gold', 5, 1399, 'none', 45, '2023-11-02 15:53:01'),
(134, 'Teddy Bear', 'Brown', 10, 29.99, 'Very comfy to hold', 17, '2023-11-08 15:04:46');

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
(1, 'test met nieuwe file structure', '06123456789', 'test@test.com', 'teststraat 112', '1234 aa', 'Den Haag', 'Nederland', '2023-10-19 10:26:42'),
(2, 'Supplier 4', '06123456789', 'supplier4@example.com', '101 Pine Street', '54321', 'Smallville', 'USA', '2023-10-19 10:56:58'),
(3, 'Supplier 5', '0', '', '202 Oak Avenue', '98765', 'Metro City', 'Canada', '2023-10-19 10:56:58'),
(4, 'Supplier 6', '0', '', '303 Maple Road', '11111', 'Newtown', 'UK', '2023-10-19 10:56:58'),
(5, 'Supplier 7', '0', '', '404 Birch Lane', '22222', 'Ruralville', 'Australia', '2023-10-19 10:56:58'),
(6, 'Supplier 8', '0', '', '505 Cedar Lane', '33333', 'Suburbia', 'Germany', '2023-10-19 10:56:58'),
(7, 'Supplier 9', '0', '', '606 Redwood Drive', '44444', 'Villageville', 'France', '2023-10-19 10:56:58'),
(8, 'Supplier 10', '0', '', '707 Elm Way', '55555', 'Hometown', 'Spain', '2023-10-19 10:56:58'),
(9, 'Supplier 11', '0', '', '808 Spruce Lane', '66666', 'Bigtown', 'Italy', '2023-10-19 10:56:58'),
(10, 'Supplier 12', '0', '', '909 Pine Road', '77777', 'Megacity', 'Japan', '2023-10-19 10:56:58'),
(11, 'Supplier 13', '0', '', '1010 Maple Avenue', '88888', 'Gotham City', 'South Korea', '2023-10-19 10:56:58'),
(12, 'Supplier 14', '0', '', '1111 Birch Street', '99999', 'Springfield', 'Brazil', '2023-10-19 10:56:58'),
(13, 'Supplier 15', '0', '', '1212 Oak Lane', '12345', 'Central City', 'Mexico', '2023-10-19 10:56:58'),
(14, 'Supplier 16', '0', '', '1313 Elm Road', '23456', 'Metropolis', 'Argentina', '2023-10-19 10:56:58'),
(15, 'Supplier 17', '0', '', '1414 Redwood Way', '34567', 'Harbor City', 'India', '2023-10-19 10:56:58'),
(16, 'Supplier 18', '0', '', '1515 Cedar Avenue', '45678', 'Beach Town', 'China', '2023-10-19 10:56:58'),
(17, 'Supplier 19', '0', '', '1616 Maple Lane', '56789', 'Mountainview', 'Russia', '2023-10-19 10:56:58'),
(18, 'Supplier 20', '0', '', '1717 Pine Drive', '67890', 'Lakeside', 'South Africa', '2023-10-19 10:56:58'),
(19, 'Supplier 21', '0', '', '1818 Birch Avenue', '76543', 'Villagetown', 'New Zealand', '2023-10-19 10:56:58'),
(20, 'Supplier 22', '0', '', '1919 Oak Road', '65432', 'Suburbville', 'Ireland', '2023-10-19 10:56:58'),
(21, 'Supplier 23', '0', '', '2020 Elm Way', '54321', 'Countryville', 'Sweden', '2023-10-19 10:56:58'),
(22, 'Supplier 24', '0', '', '2121 Maple Street', '43210', 'Townsville', 'Netherlands', '2023-10-19 10:56:58'),
(23, 'Supplier 25', '0', '', '2222 Cedar Road', '32109', 'Citytown', 'Belgium', '2023-10-19 10:56:58'),
(24, 'Supplier 26', '0', '', '2323 Redwood Lane', '21098', 'Downtown', 'Portugal', '2023-10-19 10:56:58'),
(25, 'Supplier 27', '0', '', '2424 Pine Avenue', '10987', 'Hillside', 'Greece', '2023-10-19 10:56:58'),
(26, 'Supplier 28', '0', '', '2525 Oak Lane', '09876', 'Valleyville', 'Norway', '2023-10-19 10:56:58'),
(27, 'Supplier 29', '0', '', '2626 Elm Drive', '98765', 'Beachtown', 'Denmark', '2023-10-19 10:56:58'),
(28, 'Supplier 30', '0', '', '2727 Birch Street', '87654', 'Parkville', 'Finland', '2023-10-19 10:56:58'),
(29, 'Supplier 31', '0', '', '2828 Maple Way', '76543', 'Riverside', 'Switzerland', '2023-10-19 10:56:58'),
(30, 'Supplier 32', '0', '', '2929 Cedar Road', '65432', 'Highland', 'Austria', '2023-10-19 10:56:58'),
(31, 'Supplier 33', '0', '', '3030 Redwood Avenue', '54321', 'Uptown', 'Poland', '2023-10-19 10:56:58'),
(32, 'Supplier 34', '0', '', '3131 Pine Lane', '43210', 'Laketown', 'Czech Republic', '2023-10-19 10:56:58'),
(33, 'Supplier 35', '0', '', '3232 Oak Drive', '32109', 'Hometown', 'Hungary', '2023-10-19 10:56:58'),
(34, 'Supplier 36', '0', '', '3333 Elm Avenue', '21098', 'Villageville', 'Slovakia', '2023-10-19 10:56:58'),
(35, 'Supplier 37', '0', '', '3434 Birch Street', '10987', 'Villagetown', 'Romania', '2023-10-19 10:56:58'),
(36, 'Supplier 38', '0', '', '3535 Maple Lane', '09876', 'Suburbia', 'Bulgaria', '2023-10-19 10:56:58'),
(37, 'Supplier 39', '0', '', '3636 Cedar Road', '98765', 'Countryside', 'Croatia', '2023-10-19 10:56:58'),
(38, 'Supplier 40', '0', '', '3737 Redwood Road', '87654', 'Smalltown', 'Serbia', '2023-10-19 10:56:58'),
(39, 'Supplier 41', '0', '', '3838 Pine Way', '76543', 'Countryside', 'Slovenia', '2023-10-19 10:56:58'),
(40, 'Supplier 42', '0', '', '3939 Oak Avenue', '65432', 'Hillville', 'Estonia', '2023-10-19 10:56:58'),
(41, 'Supplier 43', '0', '', '4040 Elm Lane', '54321', 'Lowville', 'Latvia', '2023-10-19 10:56:58'),
(42, 'Supplier 44', '0', '', '4141 Birch Drive', '43210', 'Forestville', 'Lithuania', '2023-10-19 10:56:58'),
(43, 'Supplier 45', '0', '', '4242 Maple Street', '32109', 'Villageland', 'Ukraine', '2023-10-19 10:56:58'),
(44, 'Supplier 46', '0', '', '4343 Cedar Avenue', '21098', 'Lakeland', 'Belarus', '2023-10-19 10:56:58'),
(45, 'Supplier 47', '0', '', '4444 Redwood Lane', '10987', 'Landville', 'Moldova', '2023-10-19 10:56:58'),
(46, 'Supplier 48', '0', '', '4545 Pine Road', '09876', 'Townsville', 'Uzbekistan', '2023-10-19 10:56:58'),
(47, 'Supplier 49', '0', '', '4646 Oak Street', '98765', 'Villagefield', 'Kazakhstan', '2023-10-19 10:56:58'),
(48, 'Supplier 50', '0', '', '4747 Elm Way', '87654', 'Countryfield', 'Tajikistan', '2023-10-19 10:56:58'),
(49, 'een supplier', '06123456789', 'supplier@test.nl', 'teststraat 1', '1234 AA', 'Den Haag', 'Nederland', '2023-10-30 12:27:34'),
(50, 'Disney', '06123456789', 'disney@example.com', 'idk', '1234 AA', 'Maimi', 'USA', '2023-11-02 11:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(90) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `dateTime`) VALUES
(1, 'test', 'test', '', '2023-10-19 09:45:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product` (`product_id`),
  ADD KEY `customer` (`customer_id`),
  ADD KEY `catergory` (`catergory`),
  ADD KEY `user` (`user_id`);

--
-- Indexes for table `order_catergory`
--
ALTER TABLE `order_catergory`
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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_catergory`
--
ALTER TABLE `order_catergory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `catergory` FOREIGN KEY (`catergory`) REFERENCES `order_catergory` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
