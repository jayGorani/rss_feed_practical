-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 10, 2025 at 12:53 PM
-- Server version: 9.1.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rss_feeds`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(700) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `char_count` int UNSIGNED NOT NULL DEFAULT '0',
  `image` text COLLATE utf8mb4_unicode_ci,
  `tagged_platform` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pub_date` datetime NOT NULL,
  `priority` tinyint NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `priority` (`priority`),
  KEY `pub_date` (`pub_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts_platform`
--

DROP TABLE IF EXISTS `posts_platform`;
CREATE TABLE IF NOT EXISTS `posts_platform` (
  `platform_id` int NOT NULL AUTO_INCREMENT,
  `platfrom_name` varchar(20) NOT NULL,
  `char_max_lenth` int NOT NULL DEFAULT '0' COMMENT 'Maximum allow char length for platform',
  `tagged_html` varchar(1000) DEFAULT NULL,
  `status` enum('enable','disable') NOT NULL DEFAULT 'enable',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`platform_id`),
  UNIQUE KEY `platfrom_name` (`platfrom_name`),
  UNIQUE KEY `unique_platform` (`platfrom_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts_platform`
--

INSERT INTO `posts_platform` (`platform_id`, `platfrom_name`, `char_max_lenth`, `tagged_html`, `status`, `created_at`) VALUES
(1, 'Facebook', 0, '<span class=\"platform-tag platform-facebook\">\n<i class=\"bi bi-facebook\"></i>Facebook</span>', 'enable', '2025-12-09 20:03:06'),
(2, 'LinkedIn', 0, '<span class=\"platform-tag platform-linkedin\"><i class=\"bi bi-linkedin\"></i> LinkedIn </span>', 'enable', '2025-12-09 20:03:06'),
(3, 'TikTok', 0, '<span class=\"platform-tag platform-tiktok\"><i class=\"bi bi-tiktok\"></i> TikTok </span>', 'enable', '2025-12-09 20:04:23'),
(4, 'Instagram', 0, '<span class=\"platform-tag platform-instagram\">\n<i class=\"bi bi-instagram\"></i> Instagram </span>', 'enable', '2025-12-09 20:04:23'),
(5, 'Threads', 0, '<span class=\"platform-tag platform-threads\">\r\n<i class=\"bi bi-threads\"></i> Threads</span>', 'enable', '2025-12-09 20:04:42'),
(6, 'Bluesky', 0, '<span class=\"platform-tag platform-bluesky\">\r\n<i class=\"bi bi-cloud\"></i> Bluesky\r\n</span>', 'enable', '2025-12-09 20:04:42'),
(7, 'X', 280, '<span class=\"platform-tag platform-x\">\n<i class=\"bi bi-twitter\"></i> X\n</span>', 'enable', '2025-12-09 20:05:03');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
