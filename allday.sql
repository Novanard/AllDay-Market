-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2021 at 12:01 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `allday`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `price` int(11) NOT NULL,
  `qnt` int(11) NOT NULL,
  `itemBarcode` int(11) NOT NULL,
  `img` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userID`, `name`, `price`, `qnt`, `itemBarcode`, `img`) VALUES
(12, 2, 'Oreo Cake', 250, 3, 33, 'assets/images/oreo.jpg'),
(13, 2, 'Arabian Pita', 10, 2, 31, 'assets/images/Pita.jpg'),
(14, 2, 'Cucmber', 4, 3, 12, 'assets/images/khear.png');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `Num` tinyint(1) NOT NULL,
  `Name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`Num`, `Name`) VALUES
(1, 'Vegehtables'),
(2, 'Butchery'),
(3, 'Bakery'),
(4, 'HomeTools');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `eID` int(9) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `depNum` tinyint(1) NOT NULL,
  `perhour` int(11) NOT NULL,
  `residence` varchar(256) NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'assets/images/employees/noPic.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `eID`, `firstname`, `lastname`, `depNum`, `perhour`, `residence`, `avatar`) VALUES
(0, 322470303, 'Ameen', 'Assadi', 1, 50, 'Deir El Assad', 'assets/images/employeesnoPic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Barcode` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Price` int(11) NOT NULL,
  `Department` tinyint(1) NOT NULL,
  `img` varchar(35) NOT NULL,
  `quantity` int(11) NOT NULL,
  `supplierID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Barcode`, `Name`, `Price`, `Department`, `img`, `quantity`, `supplierID`) VALUES
(11, 'Tomatoes', 4, 1, 'assets/images/items/bandora.png', 100, 0),
(12, 'Cucmber', 4, 1, 'assets/images/items/khear.png', 100, 0),
(13, 'Garlic', 4, 1, 'assets/images/items/garlic.png', 100, 0),
(14, 'ChilliPepper', 5, 1, 'assets/images/items/pepper.png', 100, 0),
(21, 'Laundry Machine', 1200, 2, 'assets/images/items/ghsale.png', 100, 0),
(22, 'Small Heater', 600, 2, 'assets/images/items/sheater.png', 100, 0),
(23, 'Heater', 800, 2, 'assets/images/items/heater.png', 100, 0),
(24, 'Vaccum Cleaner', 450, 2, 'assets/images/items/sho2ev.png', 100, 0),
(31, 'Arabian Pita', 10, 3, 'assets/images/items/Pita.jpg', 100, 0),
(33, 'Oreo Cake', 290, 3, 'assets/images/items/oreo.jpg', 100, 0),
(34, 'French Waffles', 30, 3, 'assets/images/items/waffle.jpg', 100, 0),
(41, 'Sinta Meat', 110, 4, 'assets/images/items/sinta.jpg', 100, 0),
(42, 'Tomhawk Steak', 300, 4, 'assets/images/items/Tomahawk.jpg', 100, 0),
(43, 'Sheep Shoulder', 45, 4, 'assets/images/items/shoulder.jpg', 100, 0),
(44, 'Entrecote Steak ', 50, 4, 'assets/images/items/entrecote.jpg', 100, 0),
(52, 'Jewish Bread', 4, 3, 'assets/images/items/bread.jpg', 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders_id`
--

CREATE TABLE `orders_id` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_id`
--

INSERT INTO `orders_id` (`id`, `userID`, `date`) VALUES
(19, 2, '2021-08-08 11:49:16'),
(21, 2, '2021-08-08 12:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `itemBarcode` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `itemBarcode`, `quantity`, `order_id`) VALUES
(8, 33, 3, 19),
(9, 31, 2, 19),
(10, 12, 3, 19),
(12, 33, 3, 21),
(13, 31, 2, 21),
(14, 12, 3, 21);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `company` varchar(256) NOT NULL,
  `phone` int(15) NOT NULL,
  `avatar` varchar(256) NOT NULL DEFAULT 'assets/images/employees/noPic.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL,
  `address` varchar(200) NOT NULL,
  `number` int(15) NOT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'assets/images/employeesnoPic.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `isAdmin`, `address`, `number`, `img`) VALUES
(1, 'Admin', 'admin@allday.com', '$2y$10$cPByNDa2Y9rRx.ZIUlsBjeKjb5f0jGHNxiqWsmT9c1hmViNOpn6/C', 1, 'N/A', 0, 'assets/images/employeesnoPic.jpg'),
(2, 'Ameen Assadi', 'ameen@test.com', '$2y$10$8woN32cf4VvFST1WrG9JquyIAEJNH1EGU6isbb8l.C2WOYz4F4uDG', 0, 'Deir El Assad', 542029200, 'assets/images/employeesnoPic.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `itemBarcode` (`itemBarcode`),
  ADD KEY `userID_fk` (`userID`) USING BTREE;

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`Num`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `eIDindex` (`eID`),
  ADD KEY `depNum` (`depNum`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`Barcode`),
  ADD KEY `product_ibfk_1` (`supplierID`),
  ADD KEY `depID_fk` (`Department`);

--
-- Indexes for table `orders_id`
--
ALTER TABLE `orders_id`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`) USING BTREE;

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderID_fk` (`order_id`) USING BTREE,
  ADD KEY `itemID_fk` (`itemBarcode`) USING BTREE;

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Barcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `orders_id`
--
ALTER TABLE `orders_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `itemBarcode` FOREIGN KEY (`itemBarcode`) REFERENCES `items` (`Barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userID_fk` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `depNum` FOREIGN KEY (`depNum`) REFERENCES `departments` (`Num`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `depID_fk` FOREIGN KEY (`Department`) REFERENCES `departments` (`Num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_id`
--
ALTER TABLE `orders_id`
  ADD CONSTRAINT `orders_id_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `itemID_fk` FOREIGN KEY (`itemBarcode`) REFERENCES `items` (`Barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderID_fk` FOREIGN KEY (`order_id`) REFERENCES `orders_id` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
