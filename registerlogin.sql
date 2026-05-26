-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2026 at 03:40 PM
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
-- Database: `registerlogin`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `failed_attempts` int(11) DEFAULT 0,
  `locked_until` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `failed_attempts`, `locked_until`, `created_at`) VALUES
(1, 'Win Htut', 'Win', 'winhtut@gmail.com', '$2y$10$wc3HBwc.A9JUUB..9l3ucexyv/0RV4OgmFwVUPIUkRKXyecB02a3i', 0, NULL, '2026-05-26 04:34:54'),
(2, 'Aung', 'Aung', 'aung@gmail.com', '$2y$10$zlenUCH1E3ZcdOk4j1BA6ONISMF8u3I2i6q0xdhTEDH1CSSnFtEXW', 0, NULL, '2026-05-26 04:35:39'),
(3, 'Win Htut', 'Win', 'winhtut253@gmail.com', '$2y$10$dhubOoKlYKJ3H2s2XKW9YOU/rZKYER0bHjzYwO4kceFcwor/.SfLa', 0, NULL, '2026-05-26 06:59:23'),
(4, 'Aung', 'Aung', 'mg@gmail.com', '$2y$10$26mAuMooAPVnjvXenmSFmOpKtCtpRBXN9BtzZjuLKA4SADo211w6i', 0, NULL, '2026-05-26 07:04:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
