-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 18, 2023 at 05:26 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symfony_tasks_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

DROP TABLE IF EXISTS `bid`;
CREATE TABLE IF NOT EXISTS `bid` (
  `id` int NOT NULL AUTO_INCREMENT,
  `team_id` int NOT NULL,
  `player_id` int NOT NULL,
  `bid_price` bigint NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4AF2B3F3296CD8AE` (`team_id`),
  KEY `IDX_4AF2B3F399E6F5DF` (`player_id`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bid`
--

INSERT INTO `bid` (`id`, `team_id`, `player_id`, `bid_price`, `status`, `created_at`) VALUES
(7, 4, 5, 34343, 'Closed', '2023-06-16 13:14:42'),
(8, 4, 4, 9989, 'Closed', '2023-06-16 13:14:50'),
(9, 11, 10, 659999, 'Closed', '2023-06-16 13:22:52'),
(14, 3, 11, 6201, 'Closed', '2023-06-17 00:09:02'),
(15, 3, 3, 6425, 'Closed', '2023-06-17 04:46:10'),
(16, 3, 4, 6899, 'Closed', '2023-06-17 04:46:17'),
(17, 3, 12, 20000, 'Closed', '2023-06-17 04:46:23'),
(18, 3, 13, 78910, 'Closed', '2023-06-17 04:46:31'),
(19, 12, 14, 68700, 'Closed', '2023-06-17 04:46:44'),
(20, 12, 15, 6666, 'Closed', '2023-06-17 04:46:51'),
(21, 12, 16, 100000, 'Closed', '2023-06-17 04:46:56'),
(22, 4, 10, 5000, 'Closed', '2023-06-17 04:47:15'),
(23, 4, 11, 998989, 'Closed', '2023-06-17 04:47:19'),
(24, 11, 10, 6000, 'Closed', '2023-06-17 05:16:38'),
(25, 4, 3, 4444, 'Closed', '2023-06-17 07:13:41'),
(26, 4, 4, 5555, 'Closed', '2023-06-17 07:13:46'),
(27, 4, 10, 6666, 'Closed', '2023-06-17 07:13:52'),
(28, 4, 12, 7777, 'Closed', '2023-06-17 07:13:57'),
(29, 4, 13, 8888, 'Closed', '2023-06-17 07:14:02'),
(30, 4, 14, 9999, 'Closed', '2023-06-17 07:14:07'),
(31, 4, 15, 88787, 'Closed', '2023-06-17 07:14:14'),
(32, 4, 16, 878787, 'Closed', '2023-06-17 07:14:18'),
(33, 3, 12, 4545, 'Closed', '2023-06-17 07:16:35'),
(34, 3, 13, 55545, 'Closed', '2023-06-17 07:16:39'),
(35, 3, 15, 5455, 'Closed', '2023-06-17 07:16:42'),
(36, 12, 3, 98778, 'Closed', '2023-06-17 07:16:49'),
(37, 12, 4, 878787, 'Closed', '2023-06-17 07:16:53'),
(38, 12, 5, 878878, 'Closed', '2023-06-17 07:17:01'),
(39, 12, 11, 98789, 'Closed', '2023-06-17 07:17:04'),
(40, 9, 14, 8778, 'Closed', '2023-06-17 07:17:13'),
(41, 9, 16, 87878, 'Closed', '2023-06-17 07:17:16'),
(42, 10, 10, 878787, 'Closed', '2023-06-17 07:17:29'),
(43, 4, 3, 78787, 'Closed', '2023-06-17 07:18:38'),
(44, 4, 4, 87878, 'Closed', '2023-06-17 07:18:42'),
(45, 4, 5, 8788, 'Closed', '2023-06-17 07:18:46'),
(46, 4, 10, 787878, 'Closed', '2023-06-17 07:18:53'),
(47, 4, 11, 77878, 'Closed', '2023-06-17 07:19:00'),
(48, 4, 12, 7878, 'Closed', '2023-06-17 07:19:06'),
(49, 4, 13, 7877, 'Closed', '2023-06-17 07:19:10'),
(50, 4, 15, 878787, 'Closed', '2023-06-17 07:19:14'),
(51, 4, 16, 78777, 'Closed', '2023-06-17 07:19:21'),
(52, 4, 14, 777777, 'Closed', '2023-06-17 07:19:26'),
(53, 9, 14, 4543, 'Closed', '2023-06-17 07:22:24'),
(54, 9, 15, 3333, 'Closed', '2023-06-17 07:22:30'),
(55, 3, 12, 3433, 'Closed', '2023-06-17 07:22:37'),
(56, 3, 16, 2222, 'Closed', '2023-06-17 07:22:41'),
(57, 11, 10, 34343, 'Closed', '2023-06-17 07:22:46'),
(58, 2, 3, 2333, 'Closed', '2023-06-17 07:22:53'),
(61, 4, 10, 432430, 'Closed', '2023-06-17 07:38:00'),
(62, 4, 16, 2223, 'Closed', '2023-06-17 07:38:04'),
(63, 4, 12, 6996, 'Closed', '2023-06-17 07:40:00'),
(65, 4, 14, 99820, 'Closed', '2023-06-17 08:10:26'),
(66, 4, 3, 787888, 'Closed', '2023-06-17 09:17:54'),
(67, 4, 17, 4587, 'Closed', '2023-06-17 09:25:01'),
(68, 4, 15, 8998, 'Closed', '2023-06-17 09:25:10'),
(69, 12, 12, 7778, 'Active', '2023-06-17 09:26:09'),
(70, 12, 14, 87878, 'Active', '2023-06-17 09:26:12'),
(71, 12, 16, 86988, 'Active', '2023-06-17 09:26:17'),
(72, 9, 3, 87878, 'Active', '2023-06-17 09:26:26'),
(73, 9, 10, 7865, 'Active', '2023-06-17 09:26:30'),
(74, 9, 15, 8655, 'Active', '2023-06-17 09:26:34'),
(75, 9, 17, 565645, 'Active', '2023-06-17 09:26:37'),
(76, 9, 18, 56565, 'Active', '2023-06-17 09:26:41'),
(77, 10, 4, 747444, 'Active', '2023-06-17 09:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230615143210', '2023-06-15 14:32:17', 1831);

-- --------------------------------------------------------

--
-- Table structure for table `player`
--

DROP TABLE IF EXISTS `player`;
CREATE TABLE IF NOT EXISTS `player` (
  `id` int NOT NULL AUTO_INCREMENT,
  `team_id` int NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surname` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_98197A65296CD8AE` (`team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `player`
--

INSERT INTO `player` (`id`, `team_id`, `name`, `surname`, `created_at`) VALUES
(3, 9, 'Tom', 'Latham', '2023-06-15 14:36:56'),
(4, 10, 'Adam ', 'Milne', '2023-06-15 14:37:11'),
(5, 2, 'Cristiano', 'Ronaldo', '2023-06-15 14:37:32'),
(10, 9, 'Lionel', 'Messi', '2023-06-15 16:31:09'),
(11, 10, 'Bukayo', 'Saka', '2023-06-15 16:32:01'),
(12, 12, 'David ', 'Miller', '2023-06-17 04:42:57'),
(13, 11, 'Harry', 'Kane', '2023-06-17 04:43:43'),
(14, 12, 'Jason', 'Roy', '2023-06-17 04:44:43'),
(15, 9, 'Joe', 'Root', '2023-06-17 04:45:05'),
(16, 12, 'Virat', 'Kohli', '2023-06-17 04:45:29'),
(17, 9, 'Sachin', 'Tendulkar', '2023-06-17 08:44:06'),
(18, 9, 'David', 'Warner', '2023-06-17 09:22:46');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE IF NOT EXISTS `team` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` bigint NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `country_code`, `balance`, `created_at`) VALUES
(2, 'Paris', 'fr', 405279303, '2023-06-15 14:33:38'),
(3, 'Rio de Janeiro', 'br', 18285, '2023-06-15 14:33:50'),
(4, 'New York', 'us', 2544452203, '2023-06-15 14:34:00'),
(9, 'Lisbon', 'pt', 44142733, '2023-06-15 16:29:39'),
(10, 'Horsens', 'dk', 26284819, '2023-06-15 16:29:55'),
(11, 'Bristol', 'gb', 70158033, '2023-06-15 16:30:05'),
(12, 'Carlisle', 'gb', 217089789, '2023-06-17 04:44:19'),
(14, 'Breda', 'nl', 96876, '2023-06-17 09:24:09');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `seller_id` int NOT NULL,
  `buyer_id` int NOT NULL,
  `player_id` int NOT NULL,
  `bid_id` int NOT NULL,
  `transaction_amount` bigint NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_723705D18DE820D9` (`seller_id`),
  KEY `IDX_723705D16C755722` (`buyer_id`),
  KEY `IDX_723705D199E6F5DF` (`player_id`),
  KEY `IDX_723705D14D9866B8` (`bid_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `seller_id`, `buyer_id`, `player_id`, `bid_id`, `transaction_amount`, `created_at`) VALUES
(1, 3, 4, 11, 14, 6201, '2023-06-17 03:14:27'),
(2, 11, 4, 10, 9, 659999, '2023-06-17 03:21:16'),
(3, 4, 3, 4, 8, 9989, '2023-06-17 03:25:58'),
(4, 12, 4, 15, 20, 6666, '2023-06-17 05:09:26'),
(5, 3, 4, 3, 15, 6425, '2023-06-17 05:10:22'),
(6, 4, 11, 10, 22, 5000, '2023-06-17 05:14:57'),
(7, 11, 4, 10, 24, 6000, '2023-06-17 05:16:55'),
(8, 12, 4, 14, 19, 68700, '2023-06-17 07:12:20'),
(9, 3, 4, 13, 18, 78910, '2023-06-17 07:12:24'),
(10, 12, 4, 16, 21, 100000, '2023-06-17 07:12:28'),
(11, 3, 4, 12, 17, 20000, '2023-06-17 07:12:32'),
(12, 3, 4, 4, 16, 6899, '2023-06-17 07:12:35'),
(13, 4, 12, 5, 7, 34343, '2023-06-17 07:12:45'),
(14, 4, 12, 11, 23, 998989, '2023-06-17 07:13:23'),
(15, 4, 9, 16, 32, 878787, '2023-06-17 07:15:30'),
(16, 4, 9, 14, 30, 9999, '2023-06-17 07:15:33'),
(17, 4, 3, 13, 29, 8888, '2023-06-17 07:15:38'),
(18, 4, 3, 15, 31, 88787, '2023-06-17 07:15:41'),
(19, 4, 10, 10, 27, 6666, '2023-06-17 07:15:45'),
(20, 4, 12, 4, 26, 5555, '2023-06-17 07:15:50'),
(21, 4, 12, 3, 25, 4444, '2023-06-17 07:15:52'),
(22, 4, 3, 12, 28, 7777, '2023-06-17 07:15:57'),
(23, 10, 4, 10, 42, 878787, '2023-06-17 07:17:45'),
(24, 9, 4, 16, 41, 87878, '2023-06-17 07:17:52'),
(25, 9, 4, 14, 40, 8778, '2023-06-17 07:17:54'),
(26, 12, 4, 11, 39, 98789, '2023-06-17 07:17:56'),
(27, 12, 4, 5, 38, 878878, '2023-06-17 07:17:59'),
(28, 12, 4, 4, 37, 878787, '2023-06-17 07:18:02'),
(29, 3, 4, 15, 35, 5455, '2023-06-17 07:18:06'),
(30, 12, 4, 3, 36, 98778, '2023-06-17 07:18:12'),
(31, 3, 4, 12, 33, 4545, '2023-06-17 07:18:17'),
(32, 3, 4, 13, 34, 55545, '2023-06-17 07:18:20'),
(33, 4, 9, 14, 52, 777777, '2023-06-17 07:20:07'),
(34, 4, 9, 15, 50, 878787, '2023-06-17 07:20:11'),
(35, 4, 3, 16, 51, 78777, '2023-06-17 07:20:16'),
(36, 4, 3, 12, 48, 7878, '2023-06-17 07:20:19'),
(37, 4, 11, 13, 49, 7877, '2023-06-17 07:20:24'),
(38, 4, 11, 10, 46, 787878, '2023-06-17 07:20:27'),
(39, 4, 10, 11, 47, 77878, '2023-06-17 07:20:32'),
(40, 4, 10, 4, 44, 87878, '2023-06-17 07:20:35'),
(41, 4, 2, 5, 45, 8788, '2023-06-17 07:20:40'),
(42, 4, 2, 3, 43, 78787, '2023-06-17 07:20:43'),
(43, 2, 4, 3, 58, 2333, '2023-06-17 07:23:01'),
(44, 11, 4, 10, 57, 34343, '2023-06-17 07:23:04'),
(45, 3, 4, 16, 56, 2222, '2023-06-17 07:23:07'),
(46, 3, 4, 12, 55, 3433, '2023-06-17 07:23:10'),
(47, 9, 4, 15, 54, 3333, '2023-06-17 07:23:13'),
(48, 9, 4, 14, 53, 4543, '2023-06-17 07:23:15'),
(49, 4, 12, 16, 62, 2223, '2023-06-17 08:17:08'),
(50, 4, 12, 12, 63, 6996, '2023-06-17 08:17:17'),
(51, 4, 12, 14, 65, 99820, '2023-06-17 09:15:17'),
(52, 4, 9, 15, 68, 8998, '2023-06-17 09:25:27'),
(53, 4, 9, 17, 67, 4587, '2023-06-17 09:25:37'),
(54, 4, 9, 10, 61, 432430, '2023-06-17 09:25:43'),
(55, 4, 9, 3, 66, 787888, '2023-06-17 09:25:57');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `FK_4AF2B3F3296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `FK_4AF2B3F399E6F5DF` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`);

--
-- Constraints for table `player`
--
ALTER TABLE `player`
  ADD CONSTRAINT `FK_98197A65296CD8AE` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `FK_723705D14D9866B8` FOREIGN KEY (`bid_id`) REFERENCES `bid` (`id`),
  ADD CONSTRAINT `FK_723705D16C755722` FOREIGN KEY (`buyer_id`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `FK_723705D18DE820D9` FOREIGN KEY (`seller_id`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `FK_723705D199E6F5DF` FOREIGN KEY (`player_id`) REFERENCES `player` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
