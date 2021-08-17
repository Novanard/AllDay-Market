-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2021 at 04:30 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

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
(15, 2, 'Tomatoes', 4, 1, 11, 1, 'assets/images/items/bandora.png'),
(16, 2, 'ChilliPepper', 5, 3, 14, 1, 'assets/images/items/pepper.png');

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
(1, 322470303, '2109', 'Ameen', 'Assadi', 1, 60, 'Deir El Assad', 'assets/images/employees/noPic.jpg'),
(4, 450450450, NULL, 'Lionel ', 'Messi', 2, 50, 'Paris', 'assets/images/users/noPic.jpg');

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
(11, 'Tomatoes', 4, 1, 'assets/images/items/bandora.png', 199, 0, 10),
(12, 'Cucmber', 4, 1, 'assets/images/items/khear.png', 200, 0, 1),
(13, 'Garlic', 4, 1, 'assets/images/items/garlic.png', 200, 0, 0),
(14, 'ChilliPepper', 5, 1, 'assets/images/items/pepper.png', 197, 0, 5),
(21, 'Laundry Machine', 1200, 2, 'assets/images/items/ghsale.png', 200, 0, 9),
(22, 'Small Heater', 600, 2, 'assets/images/items/sheater.png', 200, 0, 1),
(23, 'Heater', 800, 2, 'assets/images/items/heater.png', 200, 0, 3),
(24, 'Vaccum Cleaner', 450, 2, 'assets/images/items/sho2ev.png', 200, 0, 2),
(31, 'Arabian Pita', 10, 3, 'assets/images/items/Pita.jpg', 200, 0, 0),
(33, 'Oreo Cake', 150, 3, 'assets/images/items/oreo.jpg', 200, 0, 0),
(34, 'French Waffles', 30, 3, 'assets/images/items/waffle.jpg', 200, 0, 0),
(41, 'Sinta Meat', 110, 4, 'assets/images/items/sinta.jpg', 200, 0, 0),
(42, 'Tomhawk Steak', 300, 4, 'assets/images/items/Tomahawk.jpg', 200, 0, 0),
(43, 'Sheep Shoulder', 45, 4, 'assets/images/items/shoulder.jpg', 200, 0, 0),
(44, 'Entrecote Steak ', 50, 4, 'assets/images/items/entrecote.jpg', 200, 0, 0),
(52, 'Jewish Bread', 4, 3, 'assets/images/items/bread.jpg', 200, 0, 0);

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
(40, 2, '2021-08-17 11:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `itemBarcode` int(11) NOT NULL,
  `depNum` tinyint(1) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `isDone` tinyint(1) DEFAULT 0,
  `img` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `itemBarcode`, `depNum`, `quantity`, `order_id`, `isDone`, `img`) VALUES
(24, 11, 1, 1, 40, 0, 'assets/images/items/bandora.png'),
(25, 14, 1, 3, 40, 0, 'assets/images/items/pepper.png');

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
  `payroll_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll_details`
--

INSERT INTO `payroll_details` (`id`, `startTime`, `endTime`, `totalTime`, `payday`, `payroll_id`) VALUES
(22, '2021-08-15 20:06:27.000000', '2021-08-15 20:06:36.000000', 9, 540, 36),
(23, '2021-08-16 09:10:34.000000', '2021-08-16 09:10:44.000000', 10, 600, 36),
(24, '2021-08-17 09:13:36.000000', '2021-08-17 09:13:43.000000', 7, 420, 36);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_ids`
--

CREATE TABLE `payroll_ids` (
  `id` int(11) NOT NULL,
  `eID` int(11) NOT NULL,
  `payMonth` date DEFAULT NULL,
  `isFinished` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll_ids`
--

INSERT INTO `payroll_ids` (`id`, `eID`, `payMonth`, `isFinished`) VALUES
(36, 322470303, '2021-08-15', 0);

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
  `avatar` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `userType`, `address`, `number`, `avatar`) VALUES
(1, 'Admin', 'admin@allday.com', '$2y$10$cPByNDa2Y9rRx.ZIUlsBjeKjb5f0jGHNxiqWsmT9c1hmViNOpn6/C', 1, 'N/A', 0, 'assets/images/employeesnoPic.jpg'),
(2, 'Ameen Assadi', 'ameen@test.com', '$2y$10$8woN32cf4VvFST1WrG9JquyIAEJNH1EGU6isbb8l.C2WOYz4F4uDG', 0, 'Deir El Assad', 542029200, 'assets/images/users/noPic.jpg'),
(3, 'Another Test', 'test@test1.com', '$2y$10$Gb82DJfxcrwEX5rz3Ib4tuFB76zKueTWDFoWwF5nBiPonY3dstLgy', 0, 'test', 12345, NULL);

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
  ADD KEY `payroll_id` (`payroll_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `Barcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `orders_id`
--
ALTER TABLE `orders_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payroll_details`
--
ALTER TABLE `payroll_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payroll_ids`
--
ALTER TABLE `payroll_ids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  ADD CONSTRAINT `payroll_details_ibfk_1` FOREIGN KEY (`payroll_id`) REFERENCES `payroll_ids` (`id`);

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

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
