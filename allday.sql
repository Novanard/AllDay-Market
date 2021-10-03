-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2021 at 11:47 AM
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
  `price` float NOT NULL,
  `qnt` int(11) NOT NULL,
  `itemBarcode` int(11) NOT NULL,
  `depNum` tinyint(1) NOT NULL,
  `checkedOut` tinyint(1) DEFAULT 0,
  `img` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userID`, `name`, `price`, `qnt`, `itemBarcode`, `depNum`, `checkedOut`, `img`) VALUES
(69, 8, 'Tomhawk Steak', 255, 3, 42, 4, 0, 'assets/images/items/Tomahawk.jpg'),
(70, 8, 'Entrecote Steak ', 42.5, 3, 44, 4, 0, 'assets/images/items/en2.jpg'),
(71, 8, 'Sinta Meat', 93.5, 5, 41, 4, 0, 'assets/images/items/sinta.png'),
(72, 8, 'Sheep Shoulder', 38.25, 4, 43, 4, 0, 'assets/images/items/shoulder1.jpg');

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
(1, 322470303, '2109', 'Ameen', 'Assadi', 4, 60, 'Deir El Assad', 'assets/images/employees/ameenn.png'),
(5, 123456789, '1234', 'Adnan', 'justthis', 4, 56, 'Deir El Assad', 'assets/images/employees/3dnan.png');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `Barcode` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  `Price` float NOT NULL,
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
(11, 'Tomatoes', 4, 1, 'assets/images/items/bandora.jpg', 35, 0, 225),
(12, 'Cucmber', 4, 1, 'assets/images/items/khear.jpg', 104, 0, 300),
(13, 'Garlic', 4, 1, 'assets/images/items/garlic.png', 0, 0, 211),
(14, 'ChilliPepper', 5, 1, 'assets/images/items/pepper.png', 34, 0, 185),
(21, 'Laundry Machine', 1200, 2, 'assets/images/items/ghsale.jpg', 198, 0, 40),
(22, 'Small Heater', 600, 2, 'assets/images/items/sheater.jpg', 99, 0, 116),
(23, 'Radiator', 800, 2, 'assets/images/items/heater.jpg', 197, 0, 8),
(24, 'Vaccum Cleaner', 450, 2, 'assets/images/items/sho2ev.jpg', 200, 0, 10),
(31, 'Arabian Pita', 10, 3, 'assets/images/items/Pita.jpg', 134, 0, 266),
(33, 'Oreo Cake', 150, 3, 'assets/images/items/oreo.jpg', 101, 0, 292),
(34, 'French Waffles', 30, 3, 'assets/images/items/waffle.jpg', 200, 0, 11),
(41, 'Sinta Meat', 110, 4, 'assets/images/items/sinta.png', 160, 0, 55),
(42, 'Tomhawk Steak', 300, 4, 'assets/images/items/Tomahawk.jpg', 107, 0, 169),
(43, 'Sheep Shoulder', 45, 4, 'assets/images/items/shoulder1.jpg', 135, 0, 67),
(44, 'Entrecote Steak ', 50, 4, 'assets/images/items/en2.jpg', 176, 0, 34),
(52, 'Jewish Bread', 4, 3, 'assets/images/items/bread.jpg', 200, 0, 6);

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
  `isDone` tinyint(1) NOT NULL,
  `countedSale` tinyint(1) NOT NULL DEFAULT 0,
  `topDep` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `oldorders_id`
--

INSERT INTO `oldorders_id` (`id`, `userID`, `date`, `totalItems`, `totalMoney`, `isDone`, `countedSale`, `topDep`) VALUES
(1, 8, '2021-09-15 14:34:26', 4, 1513, 1, 0, 4),
(2, 8, '2021-09-15 14:37:58', 4, 1513, 1, 0, 4);

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
  `eID` int(9) DEFAULT NULL,
  `isDone` tinyint(1) NOT NULL,
  `img` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `oldorder_details`
--

INSERT INTO `oldorder_details` (`id`, `itemBarcode`, `itemName`, `depNum`, `price`, `quantity`, `total`, `order_id`, `eID`, `isDone`, `img`) VALUES
(1, 42, 'Tomhawk Steak', 4, 255, 3, 765, 1, 322470303, 1, 'assets/images/items/Tomahawk.jpg'),
(2, 44, 'Entrecote Steak ', 4, 42, 3, 127, 1, 322470303, 1, 'assets/images/items/en2.jpg'),
(3, 41, 'Sinta Meat', 4, 93, 5, 467, 1, 322470303, 1, 'assets/images/items/sinta.png'),
(4, 43, 'Sheep Shoulder', 4, 38, 4, 153, 1, 322470303, 1, 'assets/images/items/shoulder1.jpg'),
(5, 42, 'Tomhawk Steak', 4, 255, 3, 765, 2, 322470303, 1, 'assets/images/items/Tomahawk.jpg'),
(6, 44, 'Entrecote Steak ', 4, 42, 3, 127, 2, 322470303, 1, 'assets/images/items/en2.jpg'),
(7, 41, 'Sinta Meat', 4, 93, 5, 467, 2, 322470303, 1, 'assets/images/items/sinta.png'),
(8, 43, 'Sheep Shoulder', 4, 38, 4, 153, 2, 322470303, 1, 'assets/images/items/shoulder1.jpg');

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

-- --------------------------------------------------------

--
-- Table structure for table `orders_id`
--

CREATE TABLE `orders_id` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `totalItems` int(11) DEFAULT NULL,
  `totalMoney` float DEFAULT NULL,
  `isDone` tinyint(1) NOT NULL DEFAULT 0,
  `countedSale` tinyint(1) NOT NULL DEFAULT 0,
  `topDep` tinyint(1) DEFAULT NULL,
  `saleID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_id`
--

INSERT INTO `orders_id` (`id`, `userID`, `date`, `totalItems`, `totalMoney`, `isDone`, `countedSale`, `topDep`, `saleID`) VALUES
(3, 9, '2021-09-26 12:27:56', 7, 32183, 0, 1, 1, NULL),
(4, 9, '2021-09-26 12:53:04', 7, 32183, 0, 1, 1, NULL),
(5, 9, '2021-09-30 08:15:36', 7, 32183, 0, 1, 1, NULL),
(6, 9, '2021-09-30 08:22:23', 3, 379, 0, 0, 1, NULL);

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
  `eID` int(9) DEFAULT NULL,
  `isDone` tinyint(1) DEFAULT 0,
  `img` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `itemBarcode`, `itemName`, `depNum`, `price`, `quantity`, `total`, `order_id`, `eID`, `isDone`, `img`) VALUES
(9, 12, 'Cucmber', 1, 4, 2, 8, 3, NULL, 0, 'assets/images/items/khear.jpg'),
(10, 14, 'ChilliPepper', 1, 5, 22, 110, 3, NULL, 0, 'assets/images/items/pepper.png'),
(11, 22, 'Small Heater', 2, 600, 33, 19800, 3, NULL, 0, 'assets/images/items/sheater.jpg'),
(12, 31, 'Arabian Pita', 3, 10, 22, 220, 3, NULL, 0, 'assets/images/items/Pita.jpg'),
(13, 33, 'Oreo Cake', 3, 150, 33, 4950, 3, NULL, 0, 'assets/images/items/oreo.jpg'),
(14, 42, 'Tomhawk Steak', 4, 300, 22, 6600, 3, 322470303, 1, 'assets/images/items/Tomahawk.jpg'),
(15, 43, 'Sheep Shoulder', 4, 45, 11, 495, 3, 322470303, 1, 'assets/images/items/shoulder1.jpg'),
(16, 12, 'Cucmber', 1, 4, 2, 8, 4, NULL, 0, 'assets/images/items/khear.jpg'),
(17, 14, 'ChilliPepper', 1, 5, 22, 110, 4, NULL, 0, 'assets/images/items/pepper.png'),
(18, 22, 'Small Heater', 2, 600, 33, 19800, 4, NULL, 0, 'assets/images/items/sheater.jpg'),
(19, 31, 'Arabian Pita', 3, 10, 22, 220, 4, NULL, 0, 'assets/images/items/Pita.jpg'),
(20, 33, 'Oreo Cake', 3, 150, 33, 4950, 4, NULL, 0, 'assets/images/items/oreo.jpg'),
(21, 42, 'Tomhawk Steak', 4, 300, 22, 6600, 4, 322470303, 1, 'assets/images/items/Tomahawk.jpg'),
(22, 43, 'Sheep Shoulder', 4, 45, 11, 495, 4, 322470303, 1, 'assets/images/items/shoulder1.jpg'),
(23, 12, 'Cucmber', 1, 4, 2, 8, 5, NULL, 0, 'assets/images/items/khear.jpg'),
(24, 14, 'ChilliPepper', 1, 5, 22, 110, 5, NULL, 0, 'assets/images/items/pepper.png'),
(25, 22, 'Small Heater', 2, 600, 33, 19800, 5, NULL, 0, 'assets/images/items/sheater.jpg'),
(26, 31, 'Arabian Pita', 3, 10, 22, 220, 5, NULL, 0, 'assets/images/items/Pita.jpg'),
(27, 33, 'Oreo Cake', 3, 150, 33, 4950, 5, NULL, 0, 'assets/images/items/oreo.jpg'),
(28, 42, 'Tomhawk Steak', 4, 300, 22, 6600, 5, NULL, 0, 'assets/images/items/Tomahawk.jpg'),
(29, 43, 'Sheep Shoulder', 4, 45, 11, 495, 5, NULL, 0, 'assets/images/items/shoulder1.jpg'),
(30, 11, 'Tomatoes', 1, 2, 1, 2, 6, NULL, 0, 'assets/images/items/bandora.jpg'),
(31, 12, 'Cucmber', 1, 2, 2, 5, 6, NULL, 0, 'assets/images/items/khear.jpg'),
(32, 13, 'Garlic', 1, 2, 143, 371, 6, NULL, 0, 'assets/images/items/garlic.png');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_details`
--

CREATE TABLE `payroll_details` (
  `id` int(11) NOT NULL,
  `startTime` timestamp(6) NULL DEFAULT NULL,
  `endTime` timestamp(6) NULL DEFAULT NULL,
  `totalTime` float DEFAULT NULL,
  `payday` float DEFAULT NULL,
  `payroll_id` int(11) NOT NULL,
  `eID` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll_details`
--

INSERT INTO `payroll_details` (`id`, `startTime`, `endTime`, `totalTime`, `payday`, `payroll_id`, `eID`) VALUES
(4, '2021-09-05 21:59:03.000000', '2021-09-05 21:59:10.000000', 12, 280, 3, 322470303),
(5, '2021-09-05 21:59:16.000000', '2021-09-15 12:27:11.000000', 12, 720, 3, 322470303),
(12, '2021-09-17 10:51:01.000000', '2021-09-17 10:51:20.000000', 0, 316, 4, 123456789),
(13, '2021-09-26 12:25:04.000000', '2021-09-26 12:50:41.000000', 12, 720, 3, 322470303);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_ids`
--

CREATE TABLE `payroll_ids` (
  `id` int(11) NOT NULL,
  `eID` int(11) NOT NULL,
  `payMonth` date DEFAULT NULL,
  `totalTime` float DEFAULT 0,
  `totalMoney` float DEFAULT 0,
  `isFinished` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payroll_ids`
--

INSERT INTO `payroll_ids` (`id`, `eID`, `payMonth`, `totalTime`, `totalMoney`, `isFinished`) VALUES
(3, 322470303, '2021-09-06', 112, 4720, 0),
(4, 123456789, '2021-09-17', 26, 2690, 0);

-- --------------------------------------------------------

--
-- Table structure for table `salesystem`
--

CREATE TABLE `salesystem` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `saleValue` int(11) NOT NULL,
  `isUsed` tinyint(1) NOT NULL DEFAULT 0,
  `reason` varchar(500) NOT NULL,
  `depNum` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesystem`
--

INSERT INTO `salesystem` (`id`, `userID`, `saleValue`, `isUsed`, `reason`, `depNum`) VALUES
(77, 8, 15, 1, 'Biggest spender of all time!', NULL),
(80, 8, 15, 1, 'Most orders made of all time!', NULL),
(81, 8, 15, 1, 'Favorite Department Over The Last 3 Orders', 4),
(82, 8, 30, 1, 'Had more than 1 sale available with a total bigger than 40%', NULL),
(83, 8, 30, 1, 'Had more than 1 sale available with a total bigger than 40%', NULL),
(84, 8, 30, 1, 'Combination of more than 1 sale available', NULL),
(85, 8, 30, 1, 'Combination of more than 1 sale available', NULL),
(86, 8, 30, 1, 'Combination of more than 1 sale available', NULL),
(87, 8, 30, 1, 'Combination of more than 1 sale available', NULL),
(88, 8, 30, 1, 'Had more than 1 sale available with a total bigger than 40%', NULL),
(89, 5, 20, 0, 'Biggest spender of the Week', NULL),
(90, 8, 30, 1, 'Had more than 1 sale available with a total bigger than 40%', NULL),
(91, 8, 30, 0, 'Had more than 1 sale available with a total bigger than 40%', NULL),
(92, 6, 20, 0, 'Most Orders of the Week', NULL),
(93, 9, 20, 0, 'Biggest spender of the Week', NULL),
(94, 9, 15, 1, 'Favorite Department Over The Last 3 Orders', 1),
(95, 9, 35, 1, 'Combination of more than 1 sale available', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id` int(11) NOT NULL,
  `eID` int(11) NOT NULL,
  `startTime` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `endTime` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`id`, `eID`, `startTime`, `endTime`) VALUES
(124, 322470303, '2021-09-26 12:50:58.000000', NULL);

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
  `lifetimeSpent` int(11) NOT NULL DEFAULT 0,
  `registerDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `userType`, `address`, `number`, `avatar`, `weeklyOrders`, `lifetimeOrders`, `weeklySpent`, `lifetimeSpent`, `registerDate`) VALUES
(1, 'Admin', 'admin@allday.com', '$2y$10$cPByNDa2Y9rRx.ZIUlsBjeKjb5f0jGHNxiqWsmT9c1hmViNOpn6/C', 1, 'N/A', 0, 'assets/images/users/noPic.jpg', 0, 0, 0, 0, '2021-09-03 07:33:07'),
(5, 'Salma Assadi', 'salma@salma.com', '$2y$10$qFOc8dEoIxgts7Ucc7NtHOfqutcQIvchb8qXEH.oiEHvdeOtX9V7S', 0, 'Deir El Assad', 11234, 'assets/images/users/salma.png', 17, 25, 65624, 69544, '2021-09-03 07:33:07'),
(6, 'Meryam Natour', 'maryam@maryam.com', '$2y$10$TEV3DJXMQs7IT6JIQ.ey0uUWIHabUDTUZyxMbLioG7.mhCFoY6GIK', 0, 'Qalansweh', 123654, 'assets/images/users/itemsmeryam.jpg', 30, 5, 3000, 3000, '2021-09-03 07:33:07'),
(7, 'Reem Manaa', 'test1@test.com', '$2y$10$3L0D3MlneA1bURH7PEdDfu67E02vQXsS8Q745BLu2Ybs5rcOSGvOa', 0, 'Majd Al Kurum', 2131231, 'assets/images/users/reem.png', 22, 23, 0, 113000, '2021-09-03 07:33:38'),
(8, 'Laylba Kabha', 'layla@layla.com', '$2y$10$CYuBfsRo2e95gX4oXMe2D.mPF40h547Z1ejQZJjOzdFOsdcKA8jPK', 0, 'Tel Aviv', 111122222, 'assets/images/users/layla.png', 8, 31, 14064, 112103, '2021-09-03 09:43:45'),
(9, 'Ansam Assadi', 'ameen@ameen.com', '$2y$10$TSmHsKVYWb.EHYY2wuTiJekpqqfW7aR/0pxFnxN/hA226Ifn.y8Z6', 0, 'JUSTTHIS', 1111111, 'assets/images/users/noPic.jpg', 4, 4, 96928, 96928, '2021-09-26 13:25:50');

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
  ADD KEY `oldorders_id_ibfk_1` (`userID`),
  ADD KEY `topDep` (`topDep`);

--
-- Indexes for table `oldorder_details`
--
ALTER TABLE `oldorder_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oldorder_details_ibfk_1` (`itemBarcode`),
  ADD KEY `oldorder_details_ibfk_2` (`depNum`),
  ADD KEY `oldorder_details_ibfk_3` (`order_id`),
  ADD KEY `eID` (`eID`);

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
  ADD KEY `userID` (`userID`) USING BTREE,
  ADD KEY `topDep` (`topDep`),
  ADD KEY `saleID` (`saleID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderID_fk` (`order_id`) USING BTREE,
  ADD KEY `itemID_fk` (`itemBarcode`) USING BTREE,
  ADD KEY `depNumForeign` (`depNum`),
  ADD KEY `eID` (`eID`);

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
-- Indexes for table `salesystem`
--
ALTER TABLE `salesystem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `depNum` (`depNum`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `payroll_details`
--
ALTER TABLE `payroll_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payroll_ids`
--
ALTER TABLE `payroll_ids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `salesystem`
--
ALTER TABLE `salesystem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `oldorders_id_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oldorders_id_ibfk_2` FOREIGN KEY (`topDep`) REFERENCES `departments` (`Num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `oldorder_details`
--
ALTER TABLE `oldorder_details`
  ADD CONSTRAINT `oldorder_details_ibfk_1` FOREIGN KEY (`itemBarcode`) REFERENCES `items` (`Barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oldorder_details_ibfk_2` FOREIGN KEY (`depNum`) REFERENCES `departments` (`Num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oldorder_details_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `oldorders_id` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `oldorder_details_ibfk_4` FOREIGN KEY (`eID`) REFERENCES `employees` (`eID`) ON DELETE SET NULL ON UPDATE CASCADE;

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
  ADD CONSTRAINT `orders_id_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_id_ibfk_2` FOREIGN KEY (`topDep`) REFERENCES `departments` (`Num`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_id_ibfk_3` FOREIGN KEY (`saleID`) REFERENCES `salesystem` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `payroll_ids_ibfk_1` FOREIGN KEY (`eID`) REFERENCES `employees` (`eID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salesystem`
--
ALTER TABLE `salesystem`
  ADD CONSTRAINT `salesystem_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `salesystem_ibfk_2` FOREIGN KEY (`depNum`) REFERENCES `departments` (`Num`) ON DELETE CASCADE ON UPDATE CASCADE;

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

CREATE DEFINER=`root`@`localhost` EVENT `update_inventory` ON SCHEDULE EVERY 14 DAY STARTS '2021-09-01 12:17:56' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE items SET quantity = 200$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
