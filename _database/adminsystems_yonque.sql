-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2025 at 09:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminsystems_yonque`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_slug`, `created_at`, `updated_at`) VALUES
(1, 'Radiadores', 'Radiadores', '2024-06-04 05:58:48', '2025-02-21 22:55:04'),
(2, 'Espejos Retrovisores', 'Espejos-Retrovisores', '2024-06-04 06:00:47', '2025-02-21 22:54:54'),
(3, 'Motores', 'Motores', '2024-06-04 06:01:02', '2025-02-21 22:44:02'),
(5, 'Faros', 'Faros', '2025-02-21 22:23:30', '2025-02-21 22:42:10'),
(6, 'Tapones', 'Tapones', '2025-02-23 00:19:11', '2025-02-23 00:19:11');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_movements`
--

CREATE TABLE `inventory_movements` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `movement_type` enum('entrada','salida') NOT NULL,
  `quantity` int(11) NOT NULL,
  `reason` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_movements`
--

INSERT INTO `inventory_movements` (`id`, `product_id`, `movement_type`, `quantity`, `reason`, `description`, `created_at`, `created_by`) VALUES
(1, 2, 'entrada', 5, 'compra_pieza', '', '2025-02-23 02:38:17', 2),
(2, 2, 'salida', 1, 'producto_danado', 'Una pieza venia dañada', '2025-02-23 02:41:49', 2),
(3, 3, 'entrada', 5, 'inventario_inicial', 'Inventario inicial del producto', '2025-02-23 08:20:30', 2),
(4, 3, 'salida', 2, 'venta', 'vendidos', '2025-02-23 08:36:13', 2);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_reasons`
--

CREATE TABLE `inventory_reasons` (
  `id` int(11) NOT NULL,
  `movement_type` enum('entrada','salida') NOT NULL,
  `reason` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_reasons`
--

INSERT INTO `inventory_reasons` (`id`, `movement_type`, `reason`) VALUES
(1, 'entrada', 'compra_pieza'),
(2, 'entrada', 'compra_vehiculo'),
(3, 'entrada', 'intercambio'),
(4, 'salida', 'venta'),
(5, 'salida', 'producto_danado'),
(6, 'salida', 'extravio');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `part_number` varchar(50) NOT NULL,
  `car_brand` varchar(100) NOT NULL,
  `car_model` varchar(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_slug` varchar(255) NOT NULL,
  `purchase_price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) NOT NULL,
  `suggested_price` decimal(10,2) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `product_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `part_number`, `car_brand`, `car_model`, `product_name`, `product_slug`, `purchase_price`, `sale_price`, `suggested_price`, `qty`, `location`, `views`, `product_image`, `created_at`, `updated_at`) VALUES
(2, '00012', 'BMW', '330i', 'Manija conductor', 'Manija-conductor', 25.00, 30.00, 35.00, NULL, '', 0, '1740261080_pexels-ryan-leeper-2910856-10198740-removebg-preview.png', '2025-02-22 21:51:20', '2025-02-22 21:51:20'),
(3, 'D001', 'Volvo', 'S60', 'Defensa Frontal', 'Defensa-Frontal', 100.00, 125.00, 150.00, 5, 'L01', 0, '1740298830_pexels-tdcat-70912.jpg', '2025-02-23 08:20:30', '2025-02-23 08:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_id`, `category_id`, `created_at`) VALUES
(7, 2, 1, '2025-02-23 00:46:12'),
(8, 2, 2, '2025-02-23 00:46:12'),
(9, 2, 3, '2025-02-23 00:46:12'),
(10, 2, 5, '2025-02-23 00:46:12'),
(11, 2, 6, '2025-02-23 00:46:12'),
(12, 3, 2, '2025-02-23 08:20:30'),
(13, 3, 3, '2025-02-23 08:20:30'),
(14, 3, 5, '2025-02-23 08:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_years`
--

CREATE TABLE `product_years` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `year` int(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_years`
--

INSERT INTO `product_years` (`id`, `product_id`, `year`, `created_at`) VALUES
(5, 2, 2018, '2025-02-23 00:46:12'),
(6, 2, 2019, '2025-02-23 00:46:12'),
(7, 2, 2020, '2025-02-23 00:46:12'),
(8, 2, 2021, '2025-02-23 00:46:12'),
(9, 3, 2000, '2025-02-23 08:20:30'),
(10, 3, 2001, '2025-02-23 08:20:30'),
(11, 3, 2002, '2025-02-23 08:20:30'),
(12, 3, 2003, '2025-02-23 08:20:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `is_agent` int(11) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `signature` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `user_phone`, `is_agent`, `password`, `is_admin`, `created_at`, `updated_at`, `signature`) VALUES
(2, 'administrator', 'admin@admin.com', '', 0, '$2y$10$07kqsEdai95dj.OZE5deouhrvLNwCnphVpREWoJf.llndHzeHNLaa', 1, '2024-04-05 04:39:23', '2024-05-09 20:30:01', 'uploads/signatures/280901861.png'),
(9, 'julian', 'julian.moreno@mail.com', '6861234567', 1, '$2y$10$ganaqQQuiB8Bp314gcp8pu9na./cjaZi8Z4NJrnbUDvi2zxoAH9ui', 1, '2024-06-07 19:57:30', '2024-06-07 19:57:30', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `inventory_movements`
--
ALTER TABLE `inventory_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inventory_movements_product_id` (`product_id`);

--
-- Indexes for table `inventory_reasons`
--
ALTER TABLE `inventory_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `part_number` (`part_number`),
  ADD UNIQUE KEY `product_slug` (`product_slug`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_category_unique` (`product_id`,`category_id`),
  ADD KEY `fk_product_categories_category_id` (`category_id`);

--
-- Indexes for table `product_years`
--
ALTER TABLE `product_years`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_year_unique` (`product_id`,`year`),
  ADD KEY `fk_product_years_product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `uniq` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `inventory_movements`
--
ALTER TABLE `inventory_movements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventory_reasons`
--
ALTER TABLE `inventory_reasons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_years`
--
ALTER TABLE `product_years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory_movements`
--
ALTER TABLE `inventory_movements`
  ADD CONSTRAINT `fk_inventory_movements_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `fk_product_categories_category_id` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_categories_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_years`
--
ALTER TABLE `product_years`
  ADD CONSTRAINT `fk_product_years_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
