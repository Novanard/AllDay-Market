-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2021 at 08:48 AM
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
  `checkedOut` tinyint(1) DEFAULT 0,
  `img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'HomeTools'),
(3, 'Bakery'),
(4, 'Butchery');

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
(1, 322470303, '2109', 'Ameen', 'Assadi', 3, 60, 'Deir El Assad', 'assets/images/employees/hey, don\'t worry_.jpg'),
(5, 322470305, '2109', 'AAAA', 'SSSSS', 1, 500, 'Test', 'assets/images/employees/noPic.jpg'),
(6, 123456, '1234', 'TEST', 'test', 1, 50, 'Test', 'assets/images/employees/noPic.jpg');

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
(11, 'Tomatoes', 4, 1, 'assets/images/items/bandora.jpg', 154, 0, 55),
(12, 'Cucmber', 4, 1, 'assets/images/items/khear.jpg', 0, 0, 204),
(13, 'Garlic', 4, 1, 'assets/images/items/garlic.png', 193, 0, 7),
(14, 'ChilliPepper', 5, 1, 'assets/images/items/pepper.png', 178, 0, 19),
(21, 'Laundry Machine', 1200, 2, 'assets/images/items/ghsale.jpg', 177, 0, 32),
(22, 'Small Heater', 600, 2, 'assets/images/items/sheater.jpg', 190, 0, 11),
(23, 'Radiator', 800, 2, 'assets/images/items/heater.jpg', 200, 0, 3),
(24, 'Vaccum Cleaner', 450, 2, 'assets/images/items/sho2ev.jpg', 196, 0, 6),
(31, 'Arabian Pita', 10, 3, 'assets/images/items/Pita.jpg', 0, 0, 200),
(33, 'Oreo Cake', 150, 3, 'assets/images/items/oreo.jpg', 0, 0, 193),
(34, 'French Waffles', 30, 3, 'assets/images/items/waffle.jpg', 200, 0, 0),
(41, 'Sinta Meat', 110, 4, 'assets/images/items/sinta.png', 186, 0, 14),
(42, 'Tomhawk Steak', 300, 4, 'assets/images/items/Tomahawk.jpg', 133, 0, 67),
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
(1, '2021-09-01 11:35:34.000000', '2021-09-01 11:36:28.000000', 100, 108, 1);

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
(1, 322470303, '2021-09-01', 100, 1000, 1);

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
(2, '2021-10-01 11:37:34.000000', '2021-10-01 11:37:49.000000', 20, 0, 2, 322470303),
(3, '2021-10-01 12:15:19.000000', '2021-10-01 12:15:47.000000', 26, 250, 2, 322470303);

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
(2, 322470303, '2021-10-01', 100, 2000, 0);

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
(5, 'Ameen Ass', 'ameen@test.com', '$2y$10$xA1TMXUo2/jt2hDslGL2hudJmGplEdlvhp0.gd1yc0sMwaLuDgt0W', 0, 'Salah El ', 506663914, 'assets/images/users/hey, don\'t worry_.jpg', 17, 25, 65624, 69544),
(6, 'Test', 'test@test.com', '$2y$10$/GMfYhPDIW0Ypt1merWEFuuAqmkFXqSv7UybifJiWPrFpf.XrtDG6', 0, 'Test', 123456, 'assets/images/users/noPic.jpg', 5, 5, 3000, 3000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemBarcode` (`itemBarcode`),
  ADD KEY `depNum` (`depNum`),
  ADD KEY `cart_ibfk_3` (`userID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Barcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `orders_id`
--
ALTER TABLE `orders_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payroll_details`
--
ALTER TABLE `payroll_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payroll_ids`
--
ALTER TABLE `payroll_ids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

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
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`depNum`) REFERENCES `departments` (`Num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
