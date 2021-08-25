-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2021 at 02:04 AM
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
  `depNum` tinyint(1) NOT NULL,
  `img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userID`, `name`, `price`, `qnt`, `itemBarcode`, `depNum`, `img`) VALUES
(24, 2, 'Arabian Pita', 10, 400, 31, 3, 'assets/images/items/Pita.jpg'),
(31, 5, 'Sinta Meat', 110, 4, 41, 4, 'assets/images/items/sinta.png'),
(32, 5, 'Laundry Machine', 1200, 1, 21, 2, 'assets/images/items/ghsale.jpg'),
(33, 5, 'Tomatoes', 4, 2, 11, 1, 'assets/images/items/bandora.jpg'),
(34, 6, 'Small Heater', 600, 3, 22, 2, 'assets/images/items/sheater.jpg');

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
  `PIN` varchar(4) DEFAULT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `depNum` tinyint(1) NOT NULL,
  `perhour` int(11) NOT NULL,
  `residence` varchar(256) NOT NULL,
  `avatar` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `eID`, `PIN`, `firstname`, `lastname`, `depNum`, `perhour`, `residence`, `avatar`) VALUES
(1, 322470303, '2109', 'Ameen', 'Assadi', 1, 60, 'Deir El Assad', 'assets/images/employees/hey, don\'t worry_.jpg'),
(5, 322470305, '2109', 'AAAA', 'SSSSS', 1, 500, 'Test', 'assets/images/employees/noPic.jpg');

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
  `supplierID` int(11) NOT NULL,
  `sellCount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`Barcode`, `Name`, `Price`, `Department`, `img`, `quantity`, `supplierID`, `sellCount`) VALUES
(11, 'Tomatoes', 4, 1, 'assets/images/items/bandora.jpg', 186, 0, 23),
(12, 'Cucmber', 4, 1, 'assets/images/items/khear.jpg', 196, 0, 14),
(13, 'Garlic', 4, 1, 'assets/images/items/garlic.png', 197, 0, 3),
(14, 'ChilliPepper', 5, 1, 'assets/images/items/pepper.png', 182, 0, 15),
(21, 'Laundry Machine', 1200, 2, 'assets/images/items/ghsale.jpg', 193, 0, 16),
(22, 'Small Heater', 600, 2, 'assets/images/items/sheater.jpg', 197, 0, 4),
(23, 'Radiator', 800, 2, 'assets/images/items/heater.jpg', 200, 0, 3),
(24, 'Vaccum Cleaner', 450, 2, 'assets/images/items/sho2ev.jpg', 196, 0, 6),
(31, 'Arabian Pita', 10, 3, 'assets/images/items/Pita.jpg', 0, 0, 200),
(33, 'Oreo Cake', 150, 3, 'assets/images/items/oreo.jpg', 197, 0, 3),
(34, 'French Waffles', 30, 3, 'assets/images/items/waffle.jpg', 200, 0, 0),
(41, 'Sinta Meat', 110, 4, 'assets/images/items/sinta.png', 188, 0, 12),
(42, 'Tomhawk Steak', 300, 4, 'assets/images/items/Tomahawk.jpg', 168, 0, 32),
(43, 'Sheep Shoulder', 45, 4, 'assets/images/items/shoulder1.jpg', 200, 0, 0),
(44, 'Entrecote Steak ', 50, 4, 'assets/images/items/en2.jpg', 198, 0, 2),
(52, 'Jewish Bread', 4, 3, 'assets/images/items/bread.jpg', 200, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `oldorders_id`
--

CREATE TABLE `oldorders_id` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `totalItems` int(11) NOT NULL,
  `totalMoney` int(11) NOT NULL,
  `isDone` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `oldorder_details`
--

CREATE TABLE `oldorder_details` (
  `id` int(11) NOT NULL,
  `itemBarcode` int(11) NOT NULL,
  `itemName` varchar(256) NOT NULL,
  `depNum` tinyint(1) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `isDone` tinyint(1) NOT NULL,
  `img` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `oldpayroll_details`
--

CREATE TABLE `oldpayroll_details` (
  `id` int(11) NOT NULL,
  `startTime` timestamp(6) NULL DEFAULT NULL,
  `endTime` timestamp(6) NULL DEFAULT NULL,
  `totalTime` int(11) DEFAULT NULL,
  `payday` int(11) DEFAULT NULL,
  `payroll_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `oldpayroll_details`
--

INSERT INTO `oldpayroll_details` (`id`, `startTime`, `endTime`, `totalTime`, `payday`, `payroll_id`) VALUES
(46, '2021-09-23 15:38:30.000000', '2021-09-23 15:38:50.000000', 0, 40, 55),
(48, '2021-10-23 15:42:22.000000', '2021-10-23 15:42:55.000000', 1, 66, 57);

-- --------------------------------------------------------

--
-- Table structure for table `oldpayroll_ids`
--

CREATE TABLE `oldpayroll_ids` (
  `id` int(11) NOT NULL,
  `eID` int(11) NOT NULL,
  `payMonth` date DEFAULT NULL,
  `totalTime` int(11) NOT NULL,
  `totalMoney` int(11) NOT NULL,
  `isFinished` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `oldpayroll_ids`
--

INSERT INTO `oldpayroll_ids` (`id`, `eID`, `payMonth`, `totalTime`, `totalMoney`, `isFinished`) VALUES
(55, 322470303, '2021-09-23', 0, 40, 1),
(57, 322470303, '2021-10-23', 1, 66, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_id`
--

CREATE TABLE `orders_id` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `totalItems` int(11) DEFAULT NULL,
  `totalMoney` int(11) DEFAULT NULL,
  `isDone` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_id`
--

INSERT INTO `orders_id` (`id`, `userID`, `date`, `totalItems`, `totalMoney`, `isDone`) VALUES
(57, 5, '2021-08-24 22:06:25', 1, 440, 0),
(58, 5, '2021-08-24 22:06:47', 2, 1640, 0),
(59, 6, '2021-08-24 22:35:09', 1, 1800, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `itemBarcode` int(11) NOT NULL,
  `itemName` varchar(256) NOT NULL,
  `depNum` tinyint(1) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `isDone` tinyint(1) DEFAULT 0,
  `img` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `itemBarcode`, `itemName`, `depNum`, `price`, `quantity`, `total`, `order_id`, `isDone`, `img`) VALUES
(61, 41, 'Sinta Meat', 4, 110, 4, 440, 57, 0, 'assets/images/items/sinta.png'),
(62, 41, 'Sinta Meat', 4, 110, 4, 440, 58, 0, 'assets/images/items/sinta.png'),
(63, 21, 'Laundry Machine', 2, 1200, 1, 1200, 58, 0, 'assets/images/items/ghsale.jpg'),
(64, 22, 'Small Heater', 2, 600, 3, 1800, 59, 0, 'assets/images/items/sheater.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_details`
--

CREATE TABLE `payroll_details` (
  `id` int(11) NOT NULL,
  `startTime` timestamp(6) NULL DEFAULT NULL,
  `endTime` timestamp(6) NULL DEFAULT NULL,
  `totalTime` int(11) DEFAULT NULL,
  `payday` int(11) DEFAULT NULL,
  `payroll_id` int(11) NOT NULL,
  `eID` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll_details`
--

INSERT INTO `payroll_details` (`id`, `startTime`, `endTime`, `totalTime`, `payday`, `payroll_id`, `eID`) VALUES
(49, '2021-10-23 15:42:22.000000', '2021-10-23 15:42:55.000000', 1, 66, 58, 322470303),
(50, '2021-08-24 13:05:02.000000', '2021-08-24 13:05:14.000000', 0, 24, 58, 322470303),
(51, '2021-08-24 19:54:41.000000', '2021-08-24 19:54:46.000000', 0, 10, 58, 322470303),
(52, '2021-08-24 20:00:23.000000', '2021-08-24 20:14:38.000000', 28, 1710, 58, 322470303),
(53, '2021-08-24 20:24:39.000000', '2021-08-24 20:24:51.000000', 0, 24, 58, 322470303),
(54, '2021-08-24 20:27:47.000000', '2021-08-24 20:28:19.000000', 1, 64, 58, 322470303),
(55, '2021-08-24 20:28:40.000000', '2021-08-24 20:28:51.000000', 0, 22, 58, 322470303),
(57, '2021-08-24 20:42:30.000000', '2021-08-24 20:43:13.000000', 1, 86, 58, 322470303),
(59, '2021-08-24 20:46:21.000000', '2021-08-24 20:48:17.000000', 3, 232, 58, 322470303),
(60, '2021-08-24 20:48:22.000000', '2021-08-24 20:48:43.000000', 0, 42, 58, 322470303),
(61, '2021-08-24 20:52:45.000000', '2021-08-24 20:55:26.000000', 5, 322, 58, 322470303),
(66, '2021-08-24 21:12:40.000000', '2021-08-24 21:14:15.000000', 3, 190, 58, 322470303),
(67, '2021-08-24 21:14:24.000000', '2021-08-24 21:14:36.000000', 0, 24, 58, 322470303),
(68, '2021-08-24 21:26:07.000000', '2021-08-24 21:29:24.000000', 6, 3283, 59, 322470305),
(69, '2021-08-24 21:29:54.000000', '2021-08-24 21:29:59.000000', 0, 10, 58, 322470303);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_ids`
--

CREATE TABLE `payroll_ids` (
  `id` int(11) NOT NULL,
  `eID` int(11) NOT NULL,
  `payMonth` date DEFAULT NULL,
  `totalTime` int(11) DEFAULT 0,
  `totalMoney` int(11) DEFAULT 0,
  `isFinished` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll_ids`
--

INSERT INTO `payroll_ids` (`id`, `eID`, `payMonth`, `totalTime`, `totalMoney`, `isFinished`) VALUES
(58, 322470303, '2021-08-24', 15, 25010, 0),
(59, 322470305, '2021-08-25', 6, 123445, 0);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` int(11) NOT NULL,
  `eID` int(11) NOT NULL,
  `startTime` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `endTime` timestamp(6) NULL DEFAULT NULL,
  `isWeekend` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `eID`, `startTime`, `endTime`, `isWeekend`) VALUES
(77, 322470303, '2021-08-24 21:46:00.000000', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `sID` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `company` varchar(256) NOT NULL,
  `phone` int(15) NOT NULL,
  `avatar` varchar(256) DEFAULT NULL
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
  `userType` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = User\r\n1 = Admin\r\n',
  `address` varchar(200) NOT NULL,
  `number` int(15) NOT NULL,
  `avatar` varchar(256) DEFAULT NULL,
  `weeklyOrders` int(11) NOT NULL DEFAULT 0,
  `lifetimeOrders` int(11) NOT NULL DEFAULT 0,
  `weeklySpent` int(11) NOT NULL DEFAULT 0,
  `lifetimeSpent` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `userType`, `address`, `number`, `avatar`, `weeklyOrders`, `lifetimeOrders`, `weeklySpent`, `lifetimeSpent`) VALUES
(1, 'Admin', 'admin@allday.com', '$2y$10$cPByNDa2Y9rRx.ZIUlsBjeKjb5f0jGHNxiqWsmT9c1hmViNOpn6/C', 1, 'N/A', 0, 'assets/images/users/noPic.jpg', 0, 0, 0, 0),
(5, 'Ameen Ass', 'ameen@test.com', '$2y$10$xA1TMXUo2/jt2hDslGL2hudJmGplEdlvhp0.gd1yc0sMwaLuDgt0W', 0, 'Salah El ', 506663914, 'assets/images/users/noPic.jpg', 2, 10, 2080, 6000),
(6, 'Test', 'test@test.com', '$2y$10$/GMfYhPDIW0Ypt1merWEFuuAqmkFXqSv7UybifJiWPrFpf.XrtDG6', 0, 'Test', 123456, 'assets/images/users/noPic.jpg', 5, 5, 3000, 3000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID_fk` (`userID`) USING BTREE,
  ADD KEY `itemBarcode` (`itemBarcode`),
  ADD KEY `depNum` (`depNum`);

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
-- Indexes for table `oldorders_id`
--
ALTER TABLE `oldorders_id`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oldorders_id_ibfk_1` (`userID`);

--
-- Indexes for table `oldorder_details`
--
ALTER TABLE `oldorder_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oldorder_details_ibfk_1` (`itemBarcode`),
  ADD KEY `oldorder_details_ibfk_2` (`depNum`),
  ADD KEY `oldorder_details_ibfk_3` (`order_id`);

--
-- Indexes for table `oldpayroll_details`
--
ALTER TABLE `oldpayroll_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payroll_id` (`payroll_id`);

--
-- Indexes for table `oldpayroll_ids`
--
ALTER TABLE `oldpayroll_ids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eID` (`eID`);

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
  ADD KEY `itemID_fk` (`itemBarcode`) USING BTREE,
  ADD KEY `depNumForeign` (`depNum`);

--
-- Indexes for table `payroll_details`
--
ALTER TABLE `payroll_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payroll_id` (`payroll_id`),
  ADD KEY `payroll_details_ibfk_2` (`eID`);

--
-- Indexes for table `payroll_ids`
--
ALTER TABLE `payroll_ids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eID` (`eID`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shift_ibfk_1` (`eID`) USING BTREE;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Barcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `orders_id`
--
ALTER TABLE `orders_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `payroll_details`
--
ALTER TABLE `payroll_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `payroll_ids`
--
ALTER TABLE `payroll_ids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`itemBarcode`) REFERENCES `items` (`Barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`depNum`) REFERENCES `departments` (`Num`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `oldorders_id`
--
ALTER TABLE `oldorders_id`
  ADD CONSTRAINT `oldorders_id_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `oldorder_details`
--
ALTER TABLE `oldorder_details`
  ADD CONSTRAINT `oldorder_details_ibfk_1` FOREIGN KEY (`itemBarcode`) REFERENCES `items` (`Barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oldorder_details_ibfk_2` FOREIGN KEY (`depNum`) REFERENCES `departments` (`Num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oldorder_details_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `oldorders_id` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `oldpayroll_details`
--
ALTER TABLE `oldpayroll_details`
  ADD CONSTRAINT `oldpayroll_details_ibfk_1` FOREIGN KEY (`payroll_id`) REFERENCES `oldpayroll_ids` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `oldpayroll_ids`
--
ALTER TABLE `oldpayroll_ids`
  ADD CONSTRAINT `oldpayroll_ids_ibfk_1` FOREIGN KEY (`eID`) REFERENCES `employees` (`eID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_id`
--
ALTER TABLE `orders_id`
  ADD CONSTRAINT `orders_id_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `depNumForeign` FOREIGN KEY (`depNum`) REFERENCES `departments` (`Num`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `orderID_fk` FOREIGN KEY (`order_id`) REFERENCES `orders_id` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`itemBarcode`) REFERENCES `items` (`Barcode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payroll_details`
--
ALTER TABLE `payroll_details`
  ADD CONSTRAINT `payroll_details_ibfk_1` FOREIGN KEY (`payroll_id`) REFERENCES `payroll_ids` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payroll_details_ibfk_2` FOREIGN KEY (`eID`) REFERENCES `employees` (`eID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payroll_ids`
--
ALTER TABLE `payroll_ids`
  ADD CONSTRAINT `payroll_ids_ibfk_1` FOREIGN KEY (`eID`) REFERENCES `employees` (`eID`);

--
-- Constraints for table `shift`
--
ALTER TABLE `shift`
  ADD CONSTRAINT `shift_ibfk_1` FOREIGN KEY (`eID`) REFERENCES `employees` (`eID`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_sellcount` ON SCHEDULE EVERY 7 DAY STARTS '2021-08-17 14:27:59' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE items SET sellCount =0$$

CREATE DEFINER=`root`@`localhost` EVENT `update_weeklyOrders` ON SCHEDULE EVERY 7 DAY STARTS '2021-08-25 01:38:57' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE users SET weeklyOrders =0$$

CREATE DEFINER=`root`@`localhost` EVENT `update_weeklySpent` ON SCHEDULE EVERY 7 DAY STARTS '2021-08-29 02:00:20' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE users SET weeklySpent =0$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
