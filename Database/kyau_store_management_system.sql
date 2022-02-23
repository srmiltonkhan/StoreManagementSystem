-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2020 at 06:42 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kyau_store_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL,
  `brand_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `category_id`, `brand_name`, `brand_status`) VALUES
(40, 3, 'DELL', 'active'),
(41, 3, 'HP', 'active'),
(42, 3, 'SAMSUNG', 'active'),
(43, 3, 'Canon', 'active'),
(44, 1, 'MATADOR', 'active'),
(45, 1, 'Pinpoint', 'active'),
(46, 23, 'Mep', 'active'),
(47, 2, 'Dipu', 'active'),
(48, 24, 'Donlop', 'active'),
(49, 25, 'ABC', 'active'),
(50, 26, 'BD Brand', 'inactive'),
(51, 3, 'white 2', 'active'),
(54, 2, 'test', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'Stationary Accessories', 'active'),
(2, 'Furniture Accessories', 'active'),
(3, 'Computer Equipments', 'active'),
(23, 'Electrical Accessories', 'active'),
(24, 'A4 Size paper', 'active'),
(25, 'Internet Accessory', 'active'),
(26, 'Internet ', 'active'),
(36, 'check', 'inactive');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_requisition`
--

CREATE TABLE `inventory_requisition` (
  `inventory_requisition_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `requisition_qty` int(10) NOT NULL,
  `received_qty` int(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `issued_items`
--

CREATE TABLE `issued_items` (
  `issued_items_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `issued_qty` int(10) NOT NULL,
  `issued_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `brand_id`, `product_name`, `product_status`) VALUES
(3, 1, 40, 'Monitor', 'active'),
(5, 23, 44, 'Pen', 'active'),
(6, 23, 44, 'Printer', 'active'),
(15, 3, 40, 'test', 'active'),
(16, 24, 48, 'paper', 'active'),
(17, 3, 43, 'Camera', 'active'),
(18, 23, 46, 'light', 'active'),
(19, 3, 41, 'monitor', 'active'),
(20, 23, 46, 'monitor', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `requisition_inventory_registrar`
--

CREATE TABLE `requisition_inventory_registrar` (
  `reg_inv_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `requisition_qty` int(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `return_items`
--

CREATE TABLE `return_items` (
  `return_items_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `return_quantity` int(10) NOT NULL,
  `return_date` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_activity`
--

CREATE TABLE `users_activity` (
  `user_activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `daily_login_date` varchar(30) NOT NULL,
  `login_time` varchar(10) NOT NULL,
  `logout_time` varchar(10) NOT NULL,
  `user_pc_ip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_details`
--

CREATE TABLE `users_details` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_mobile` varchar(15) NOT NULL,
  `user_department` varchar(100) NOT NULL,
  `user_designation` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `user_status` enum('inactive','active') NOT NULL,
  `user_create_date` varchar(30) NOT NULL,
  `user_image` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_details`
--

INSERT INTO `users_details` (`user_id`, `user_name`, `user_email`, `user_mobile`, `user_department`, `user_designation`, `user_password`, `user_type`, `user_status`, `user_create_date`, `user_image`) VALUES
(6, 'Rashed', 'rashed@gmail.com', '0125252525', 'Bio-Chemistry & Bio-Technology ', 'Test', '123', 'normal_user', 'active', '11:25 AM. 13-Jan-20', 0x3837313137333836362e6a7067),
(11, 'sr', 'sr@gmail.com', '012525252', 'Management Information System', 'test', 'test', 'normal_user', 'inactive', '12:04 PM. 14-Jan-20', 0x313230363431383432372e706e67),
(12, 'fg', 'fg@gmail.com', '017272520', 'Admission', 'Professor ', '123', 'normal_user', 'inactive', '12:07 PM. 14-Jan-20', 0x323038333032343635302e706e67),
(13, 'Mohammad Nasiruzzaman', 'nasir@gmail.com', '01621000662', 'Management Information System', 'Professor ', '123', 'normal_user', 'inactive', '12:08 PM. 14-Jan-20', 0x3835383238353537342e6a7067),
(14, 'Md. Jakirul Islam', 'jsmedia.24live@gmail.com', '01783440244', 'Information Technology', 'IT Technician', 'jakirul786', 'normal_user', 'active', '12:47 PM. 14-Jan-20', 0x313732333135373337322e6a7067),
(16, 'Khalek', 'khaleq@gmail.com', '01727637485', 'Information Technology', 'Lab Assistant', '123', 'normal_user', 'active', '02:49 PM. 14-Jan-20', 0x313232363031303736382e706e67),
(17, 'Arfan Khan', 'arfan@gmail.com', '017282525', 'Information Technology', 'Engi', '123', 'normal_user', 'inactive', '03:35 PM. 14-Jan-20', 0x313932363534313033372e6a7067),
(18, 'Arif', 'Arif@gmail.com', '0162100025', 'Information Technology', 'Engi', '123', 'normal_user', 'inactive', '12:04 PM. 19-Jan-20', 0x313939333330333830342e706e67),
(19, 'Asraful', 'asraful@gmail.com', '01727637420', 'Admission', 'Engi', '123', 'normal_user', 'inactive', '03:38 PM. 19-Jan-20', 0x313435333934353636352e706e67),
(20, 'Mahiya', 'mahiya@gmail.com', '01727637421', 'Management Information System', 'Student', '123', 'normal_user', 'inactive', '03:41 PM. 19-Jan-20', 0x313535323539333038382e706e67),
(21, 'Mahiya', 'mahi@gmail.com', '01720348352', 'Biomedical', 'Engi', '1234', 'normal_user', 'inactive', '03:42 PM. 19-Jan-20', 0x313334353238313032302e706e67),
(22, 'Ismail', 'ismail@gmail.com', '017', 'Account', 'Account', '123', 'normal_user', 'inactive', '11:20 AM. 20-Jan-20', 0x313230393933333831392e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `available_qty` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_spend_info`
--

CREATE TABLE `warehouse_spend_info` (
  `item_spend_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_qty` int(10) NOT NULL,
  `product_unit` varchar(20) NOT NULL,
  `base_price` double(10,2) NOT NULL,
  `total_price` double(10,2) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`),
  ADD UNIQUE KEY `brand_name` (`brand_name`),
  ADD KEY `category_brand_fk` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `inventory_requisition`
--
ALTER TABLE `inventory_requisition`
  ADD PRIMARY KEY (`inventory_requisition_id`),
  ADD KEY `user_inventory_requisition_fk` (`user_id`),
  ADD KEY `category_inventory_requisition_fk` (`category_id`),
  ADD KEY `brand_inventory_requisition_fk` (`brand_id`),
  ADD KEY `product_inventory_requisition_fk` (`product_id`);

--
-- Indexes for table `issued_items`
--
ALTER TABLE `issued_items`
  ADD PRIMARY KEY (`issued_items_id`),
  ADD KEY `user_issued_items_fk` (`user_id`),
  ADD KEY `category_issued_items_fk` (`category_id`),
  ADD KEY `brand_issued_items_fk` (`brand_id`),
  ADD KEY `product_issued_items_fk` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_product_fk` (`category_id`),
  ADD KEY `brand_product_fk` (`brand_id`);

--
-- Indexes for table `requisition_inventory_registrar`
--
ALTER TABLE `requisition_inventory_registrar`
  ADD PRIMARY KEY (`reg_inv_id`),
  ADD KEY `user_requisition_inventory_registrar_fk` (`user_id`),
  ADD KEY `category_requisition_inventory_registrar_fk` (`category_id`),
  ADD KEY `brand_requisition_inventory_registrar_fk` (`brand_id`),
  ADD KEY `product_requisition_inventory_registrar_fk` (`product_id`);

--
-- Indexes for table `return_items`
--
ALTER TABLE `return_items`
  ADD PRIMARY KEY (`return_items_id`),
  ADD KEY `user_return_items_fk` (`user_id`),
  ADD KEY `category_return_items_fk` (`category_id`),
  ADD KEY `brand_return_items_fk` (`brand_id`),
  ADD KEY `product_return_items_fk` (`product_id`);

--
-- Indexes for table `users_activity`
--
ALTER TABLE `users_activity`
  ADD PRIMARY KEY (`user_activity_id`),
  ADD KEY `user_users_activity_fk` (`user_id`);

--
-- Indexes for table `users_details`
--
ALTER TABLE `users_details`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_mobile` (`user_mobile`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `category_warehouse_fk` (`category_id`),
  ADD KEY `brand_warehouse_fk` (`brand_id`),
  ADD KEY `product_warehouse_fk` (`product_id`);

--
-- Indexes for table `warehouse_spend_info`
--
ALTER TABLE `warehouse_spend_info`
  ADD PRIMARY KEY (`item_spend_id`),
  ADD KEY `category_warehouse_spend_fk` (`category_id`),
  ADD KEY `brand_warehouse_spend_fk` (`brand_id`),
  ADD KEY `product_warehouse_spend_fk` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `inventory_requisition`
--
ALTER TABLE `inventory_requisition`
  MODIFY `inventory_requisition_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issued_items`
--
ALTER TABLE `issued_items`
  MODIFY `issued_items_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `requisition_inventory_registrar`
--
ALTER TABLE `requisition_inventory_registrar`
  MODIFY `reg_inv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_items`
--
ALTER TABLE `return_items`
  MODIFY `return_items_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_activity`
--
ALTER TABLE `users_activity`
  MODIFY `user_activity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_details`
--
ALTER TABLE `users_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouse_spend_info`
--
ALTER TABLE `warehouse_spend_info`
  MODIFY `item_spend_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `brand`
--
ALTER TABLE `brand`
  ADD CONSTRAINT `category_brand_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `inventory_requisition`
--
ALTER TABLE `inventory_requisition`
  ADD CONSTRAINT `brand_inventory_requisition_fk` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `category_inventory_requisition_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_inventory_requisition_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_inventory_requisition_fk` FOREIGN KEY (`user_id`) REFERENCES `users_details` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `issued_items`
--
ALTER TABLE `issued_items`
  ADD CONSTRAINT `brand_issued_items_fk` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `category_issued_items_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_issued_items_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_issued_items_fk` FOREIGN KEY (`user_id`) REFERENCES `users_details` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `brand_product_fk` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `category_product_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `requisition_inventory_registrar`
--
ALTER TABLE `requisition_inventory_registrar`
  ADD CONSTRAINT `brand_requisition_inventory_registrar_fk` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `category_requisition_inventory_registrar_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_requisition_inventory_registrar_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_requisition_inventory_registrar_fk` FOREIGN KEY (`user_id`) REFERENCES `users_details` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `return_items`
--
ALTER TABLE `return_items`
  ADD CONSTRAINT `brand_return_items_fk` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `category_return_items_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_return_items_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_return_items_fk` FOREIGN KEY (`user_id`) REFERENCES `users_details` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `users_activity`
--
ALTER TABLE `users_activity`
  ADD CONSTRAINT `user_users_activity_fk` FOREIGN KEY (`user_id`) REFERENCES `users_details` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD CONSTRAINT `brand_warehouse_fk` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `category_warehouse_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_warehouse_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE;

--
-- Constraints for table `warehouse_spend_info`
--
ALTER TABLE `warehouse_spend_info`
  ADD CONSTRAINT `brand_warehouse_spend_fk` FOREIGN KEY (`brand_id`) REFERENCES `brand` (`brand_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `category_warehouse_spend_fk` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `product_warehouse_spend_fk` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
