-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for si_ihza
CREATE DATABASE IF NOT EXISTS `si_ihza` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `si_ihza`;

-- Dumping structure for table si_ihza.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  `created` int DEFAULT NULL,
  `user_role_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_users_user_role1_idx` (`user_role_id`),
  CONSTRAINT `fk_users_user_role1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table si_ihza.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `image`, `password`, `is_active`, `created`, `user_role_id`) VALUES
	(1, 'Admin', 'ihzasofyansah@gmail.com', '51.png', '$2y$10$RaP1EqEKtAn9HAOt5Mb4JuEHc6KJoyE0QzP1Bqq8X.6pr21SNvnb2', 1, 1695393637, 1),
	(2, 'member', 'ihzasopiyansah@gmail.com', '611.png', '$2y$10$JohPVU3AyEBbc0w.XeR9ue0yQ.rC7YM7a9qkhew3WDeTuiuME4ujO', 1, 1702926522, 2),
	(3, 'ngabers', 'user@gmail.com', '1.png', '$2y$10$MeQxekk9l7fDphQyg.ts5exGdMIxyM7bGXRAggoLfJoduJ/I.PkzK', 0, 1703184703, 2),
	(4, 'sublik', 'sublik85@gmail.com', '1.png', '$2y$10$DQcuGyJwcEPlhQt0FhDFuOBU6LzhF8iaqklSOgqZUbAhKv.UUgnwq', 0, 1703187666, 2);

-- Dumping structure for table si_ihza.users_token
CREATE TABLE IF NOT EXISTS `users_token` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varbinary(125) DEFAULT NULL,
  `date_created` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table si_ihza.users_token: ~3 rows (approximately)
INSERT INTO `users_token` (`id`, `email`, `token`, `date_created`) VALUES
	(3, 'user@gmail.com', _binary 0x4f6b6339766f6972422f3779784f364f65753271354b4446666743695a585177795241394d4b6d632b77383d, '1703184703'),
	(6, 'ihzasofyansah@gmail.com', _binary 0x3072536c2b79474a62544278666d45356370536e6d6e4d675952557168744f356e4e4b3851362f2b555a383d, '1703187461'),
	(7, 'sublik85@gmail.com', _binary 0x5077686171555a6d624f7951664757336e49704c7056456b72317a54574e6e4e4c3230474d38492b767a633d, '1703187666');

-- Dumping structure for table si_ihza.user_access_menu
CREATE TABLE IF NOT EXISTS `user_access_menu` (
  `user_menu_id` int NOT NULL,
  `user_role_id` int NOT NULL,
  PRIMARY KEY (`user_menu_id`,`user_role_id`),
  KEY `fk_user_menu_has_user_role_user_role1_idx` (`user_role_id`),
  KEY `fk_user_menu_has_user_role_user_menu1_idx` (`user_menu_id`),
  CONSTRAINT `fk_user_menu_has_user_role_user_menu1` FOREIGN KEY (`user_menu_id`) REFERENCES `user_menu` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_user_menu_has_user_role_user_role1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table si_ihza.user_access_menu: ~6 rows (approximately)
INSERT INTO `user_access_menu` (`user_menu_id`, `user_role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(3, 2);

-- Dumping structure for table si_ihza.user_menu
CREATE TABLE IF NOT EXISTS `user_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu` varchar(125) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table si_ihza.user_menu: ~4 rows (approximately)
INSERT INTO `user_menu` (`id`, `menu`, `icon`) VALUES
	(1, 'Admin', 'menu-icon tf-icons bx bx-crown'),
	(2, 'Menu', 'menu-icon tf-icons bx bx-copy'),
	(3, 'Account', 'menu-icon tf-icons bx bx-dock-top');

-- Dumping structure for table si_ihza.user_role
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_UNIQUE` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table si_ihza.user_role: ~2 rows (approximately)
INSERT INTO `user_role` (`id`, `role`) VALUES
	(1, 'admin'),
	(2, 'member');

-- Dumping structure for table si_ihza.user_sub_menu
CREATE TABLE IF NOT EXISTS `user_sub_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(125) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  `user_menu_id` int NOT NULL,
  `user_menu_id1` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_sub_menu_user_menu_idx` (`user_menu_id`),
  KEY `fk_user_sub_menu_user_menu1_idx` (`user_menu_id1`),
  CONSTRAINT `fk_user_sub_menu_user_menu` FOREIGN KEY (`user_menu_id`) REFERENCES `user_menu` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_user_sub_menu_user_menu1` FOREIGN KEY (`user_menu_id1`) REFERENCES `user_menu` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table si_ihza.user_sub_menu: ~8 rows (approximately)
INSERT INTO `user_sub_menu` (`id`, `title`, `url`, `icon`, `is_active`, `user_menu_id`, `user_menu_id1`) VALUES
	(1, 'Status', 'admin/status', NULL, 1, 1, 1),
	(2, 'Access Management', 'admin/role', NULL, 1, 1, 1),
	(3, 'Menu Management', 'menu', NULL, 1, 2, 2),
	(4, 'Sub Menu Management', 'menu/submenu', NULL, 1, 2, 2),
	(6, 'Account', 'account/details', NULL, 1, 3, 3),
	(7, 'Edit Account', 'account/edit', NULL, 1, 3, 3),
	(8, 'Change Password', 'account/ubahpassword', NULL, 1, 3, 3);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
