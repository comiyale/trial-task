-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 21, 2021 at 08:28 AM
-- Server version: 8.0.26-0ubuntu0.20.04.2
-- PHP Version: 7.3.30-1+ubuntu20.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notes_and_tags`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint NOT NULL,
  `status` enum('ACTIVE','NOT ACTIVE') NOT NULL DEFAULT 'ACTIVE',
  `title` char(255) NOT NULL,
  `description` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `status`, `title`, `description`, `updated_at`, `created_at`) VALUES
(1, 'ACTIVE', 'testing 1', 'This is a test, please ignore', '2021-09-20 12:42:55', '2021-09-20 12:42:55'),
(18, 'ACTIVE', 'testing API', 'tesing, please ignore', '2021-09-20 14:15:14', '2021-09-20 14:15:14'),
(19, 'ACTIVE', 'testing API 123', 'tesing, please ignore', '2021-09-20 21:36:34', '2021-09-20 14:16:13'),
(20, 'ACTIVE', 'testing API', 'tesing, please ignore', '2021-09-20 14:25:47', '2021-09-20 14:25:47'),
(26, 'ACTIVE', 'testing API', 'tesing, please ignore', '2021-09-21 02:51:33', '2021-09-21 02:51:33'),
(27, 'ACTIVE', 'testing API', 'tesing, please ignore', '2021-09-21 02:52:13', '2021-09-21 02:52:13'),
(28, 'ACTIVE', 'testing API', 'tesing, please ignore', '2021-09-21 09:43:55', '2021-09-21 09:43:55'),
(29, 'ACTIVE', 'testing 1223', 'kjdkfljaklf', '2021-09-21 13:18:12', '2021-09-21 13:18:12'),
(30, 'ACTIVE', 'testing 1223', 'kjdkfljaklf', '2021-09-21 13:19:53', '2021-09-21 13:19:53'),
(31, 'ACTIVE', 'testing 1223', 'kjdkfljaklf', '2021-09-21 13:21:27', '2021-09-21 13:21:27'),
(32, 'ACTIVE', 'testing 1223', 'kjdkfljaklf', '2021-09-21 13:21:43', '2021-09-21 13:21:43'),
(33, 'ACTIVE', 'testing 1223', 'kjdkfljaklf', '2021-09-21 13:22:16', '2021-09-21 13:22:16'),
(34, 'ACTIVE', 'testing 1223', 'kjdkfljaklf', '2021-09-21 13:22:39', '2021-09-21 13:22:39'),
(35, 'ACTIVE', 'testing 1223', 'kjdkfljaklf', '2021-09-21 13:22:55', '2021-09-21 13:22:55'),
(36, 'ACTIVE', 'testing 1223', 'kjdkfljaklf', '2021-09-21 13:23:01', '2021-09-21 13:23:01'),
(37, 'ACTIVE', 'testing 1223', 'kjdkfljaklf', '2021-09-21 13:23:47', '2021-09-21 13:23:47'),
(38, 'ACTIVE', 'testing 1223', 'kjdkfljaklf', '2021-09-21 13:24:29', '2021-09-21 13:24:29'),
(39, 'ACTIVE', 'testing 1223', 'kjdkfljaklf', '2021-09-21 13:24:49', '2021-09-21 13:24:49'),
(40, 'ACTIVE', 'testing 1223', 'kjdkfljaklf', '2021-09-21 13:24:58', '2021-09-21 13:24:58'),
(41, 'ACTIVE', 'big brother', 'big brother', '2021-09-21 13:25:20', '2021-09-21 13:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint UNSIGNED NOT NULL,
  `status` enum('ACTIVE','NOT ACTIVE') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'NOT ACTIVE',
  `name` char(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `status`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ACTIVE', 'tag 1', '2021-09-20 12:41:23', '2021-09-20 13:35:00'),
(2, 'ACTIVE', 'tag 2', '2021-09-20 12:41:23', '2021-09-20 12:41:23'),
(3, 'ACTIVE', 'tag 3', '2021-09-20 12:41:37', '2021-09-20 12:41:37'),
(4, 'NOT ACTIVE', 'tag 4', '2021-09-20 12:41:37', '2021-09-20 12:41:37'),
(7, 'ACTIVE', 'testing tag', '2021-09-21 09:45:58', '2021-09-21 09:45:58'),
(8, 'ACTIVE', 'testing tag1', '2021-09-21 09:59:12', '2021-09-21 09:59:12'),
(12, 'ACTIVE', 'testing 123', '2021-09-21 11:47:27', '2021-09-21 11:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `tags_and_notes_relationship`
--

CREATE TABLE `tags_and_notes_relationship` (
  `id` bigint UNSIGNED NOT NULL,
  `notes_id` bigint UNSIGNED NOT NULL,
  `tags_id` bigint UNSIGNED NOT NULL,
  `tag_name` char(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tags_and_notes_relationship`
--

INSERT INTO `tags_and_notes_relationship` (`id`, `notes_id`, `tags_id`, `tag_name`, `updated_at`, `created_at`) VALUES
(4, 20, 1, 'tag 1', '2021-09-20 14:25:47', '2021-09-20 14:25:47'),
(5, 20, 2, 'tag 2', '2021-09-20 14:25:47', '2021-09-20 14:25:47'),
(6, 20, 3, 'tag 3', '2021-09-20 14:25:47', '2021-09-20 14:25:47'),
(10, 19, 1, 'tag 1', '2021-09-20 14:32:26', '2021-09-20 14:32:26'),
(11, 19, 2, 'tag 2', '2021-09-20 14:32:26', '2021-09-20 14:32:26'),
(12, 19, 3, 'tag 3', '2021-09-20 14:32:26', '2021-09-20 14:32:26'),
(13, 21, 1, 'tag 1', '2021-09-20 21:37:11', '2021-09-20 21:37:11'),
(14, 21, 2, 'tag 2', '2021-09-20 21:37:11', '2021-09-20 21:37:11'),
(15, 21, 3, 'tag 3', '2021-09-20 21:37:11', '2021-09-20 21:37:11'),
(16, 22, 1, 'tag 1', '2021-09-20 23:10:54', '2021-09-20 23:10:54'),
(17, 22, 2, 'tag 2', '2021-09-20 23:10:54', '2021-09-20 23:10:54'),
(18, 22, 3, 'tag 3', '2021-09-20 23:10:54', '2021-09-20 23:10:54'),
(19, 23, 1, 'tag 1', '2021-09-20 23:38:46', '2021-09-20 23:38:46'),
(20, 23, 2, 'tag 2', '2021-09-20 23:38:46', '2021-09-20 23:38:46'),
(21, 23, 3, 'tag 3', '2021-09-20 23:38:46', '2021-09-20 23:38:46'),
(22, 24, 1, 'tag 1', '2021-09-21 00:04:49', '2021-09-21 00:04:49'),
(23, 24, 2, 'tag 2', '2021-09-21 00:04:49', '2021-09-21 00:04:49'),
(24, 24, 3, 'tag 3', '2021-09-21 00:04:49', '2021-09-21 00:04:49'),
(25, 25, 1, 'tag 1', '2021-09-21 00:27:17', '2021-09-21 00:27:17'),
(26, 25, 2, 'tag 2', '2021-09-21 00:27:17', '2021-09-21 00:27:17'),
(27, 25, 3, 'tag 3', '2021-09-21 00:27:17', '2021-09-21 00:27:17'),
(28, 26, 1, 'tag 1', '2021-09-21 02:51:33', '2021-09-21 02:51:33'),
(29, 26, 2, 'tag 2', '2021-09-21 02:51:33', '2021-09-21 02:51:33'),
(30, 26, 3, 'tag 3', '2021-09-21 02:51:33', '2021-09-21 02:51:33'),
(31, 27, 1, 'tag 1', '2021-09-21 02:52:14', '2021-09-21 02:52:14'),
(32, 27, 2, 'tag 2', '2021-09-21 02:52:14', '2021-09-21 02:52:14'),
(33, 27, 3, 'tag 3', '2021-09-21 02:52:14', '2021-09-21 02:52:14'),
(34, 28, 1, 'tag 1', '2021-09-21 09:43:55', '2021-09-21 09:43:55'),
(35, 28, 2, 'tag 2', '2021-09-21 09:43:55', '2021-09-21 09:43:55'),
(36, 28, 3, 'tag 3', '2021-09-21 09:43:55', '2021-09-21 09:43:55'),
(37, 39, 1, 'tag 1', '2021-09-21 13:24:49', '2021-09-21 13:24:49'),
(38, 39, 3, 'tag 3', '2021-09-21 13:24:49', '2021-09-21 13:24:49'),
(39, 39, 7, 'testing tag', '2021-09-21 13:24:49', '2021-09-21 13:24:49'),
(40, 39, 8, 'testing tag1', '2021-09-21 13:24:49', '2021-09-21 13:24:49'),
(41, 40, 1, 'tag 1', '2021-09-21 13:24:58', '2021-09-21 13:24:58'),
(42, 40, 3, 'tag 3', '2021-09-21 13:24:58', '2021-09-21 13:24:58'),
(43, 40, 7, 'testing tag', '2021-09-21 13:24:58', '2021-09-21 13:24:58'),
(44, 40, 8, 'testing tag1', '2021-09-21 13:24:58', '2021-09-21 13:24:58'),
(45, 41, 1, 'tag 1', '2021-09-21 13:25:20', '2021-09-21 13:25:20'),
(46, 41, 2, 'tag 2', '2021-09-21 13:25:20', '2021-09-21 13:25:20'),
(47, 41, 3, 'tag 3', '2021-09-21 13:25:20', '2021-09-21 13:25:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags_and_notes_relationship`
--
ALTER TABLE `tags_and_notes_relationship`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tags_and_notes_relationship`
--
ALTER TABLE `tags_and_notes_relationship`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
