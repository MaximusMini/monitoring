-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.6.37 - MySQL Community Server (GPL)
-- Операционная система:         Win32
-- HeidiSQL Версия:              9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных yii_project
CREATE DATABASE IF NOT EXISTS `yii_project` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `yii_project`;

-- Дамп структуры для таблица yii_project.vk_accounts
CREATE TABLE IF NOT EXISTS `vk_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) NOT NULL DEFAULT '0',
  `first_name` varchar(50) NOT NULL DEFAULT '0',
  `last_name` varchar(50) NOT NULL DEFAULT '0',
  `is_closed` int(11) NOT NULL DEFAULT '0',
  `sex` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `maiden_name` varchar(50) DEFAULT NULL,
  `domain` varchar(50) DEFAULT NULL,
  `screen_name` varchar(50) DEFAULT NULL,
  `bdate` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `photo_50` varchar(250) DEFAULT NULL,
  `photo_100` varchar(250) DEFAULT NULL,
  `photo_200` varchar(250) DEFAULT NULL,
  `photo_max` varchar(250) DEFAULT NULL,
  `photo_200_orig` varchar(250) DEFAULT NULL,
  `photo_400_orig` varchar(250) DEFAULT NULL,
  `photo_max_orig` varchar(250) DEFAULT NULL,
  `photo_id` varchar(50) DEFAULT NULL,
  `online` varchar(50) DEFAULT NULL,
  `can_post` varchar(50) DEFAULT NULL,
  `can_see_all_posts` varchar(50) DEFAULT NULL,
  `can_see_audio` varchar(50) DEFAULT NULL,
  `can_write_private_message` varchar(50) DEFAULT NULL,
  `can_send_friend_request` varchar(50) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `facebook_name` varchar(50) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `site` varchar(50) DEFAULT NULL,
  `status` text,
  `last_seen_time` varchar(50) DEFAULT NULL,
  `last_seen_platform` varchar(50) DEFAULT NULL,
  `crop_photo_id` varchar(50) DEFAULT NULL,
  `crop_photo_text` varchar(50) DEFAULT NULL,
  `crop_photo_date` varchar(50) DEFAULT NULL,
  `crop_photo_post_id` varchar(50) DEFAULT NULL,
  `verified` int(11) DEFAULT NULL,
  `followers_count` int(11) DEFAULT NULL,
  `occupation_type` varchar(50) DEFAULT NULL,
  `occupation_name` varchar(100) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп структуры для таблица yii_project.vk_accounts_photo_sizes
CREATE TABLE IF NOT EXISTS `vk_accounts_photo_sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` varchar(50) NOT NULL DEFAULT '0',
  `type` varchar(50) NOT NULL DEFAULT '0',
  `url` varchar(250) NOT NULL DEFAULT '0',
  `width` int(11) NOT NULL DEFAULT '0',
  `height` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- Дамп структуры для таблица yii_project.vk_groups
CREATE TABLE IF NOT EXISTS `vk_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `screen_name` varchar(50) DEFAULT NULL,
  `is_closed` tinyint(4) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `description` text,
  `members_count` int(11) DEFAULT NULL,
  `counters_photos` int(11) DEFAULT NULL,
  `counters_albums` int(11) DEFAULT NULL,
  `counters_topics` int(11) DEFAULT NULL,
  `counters_videos` int(11) DEFAULT NULL,
  `counters_audios` int(11) DEFAULT NULL,
  `counters_market` int(11) DEFAULT NULL,
  `activity` varchar(50) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  `fixed_post` int(11) DEFAULT NULL,
  `verified` int(11) DEFAULT NULL,
  `site` varchar(250) DEFAULT NULL,
  `cover_enabled` int(11) DEFAULT NULL,
  `photo_50` varchar(250) DEFAULT NULL,
  `photo_100` varchar(250) DEFAULT NULL,
  `photo_200` varchar(250) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `created` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8;

-- Дамп структуры для таблица yii_project.vk_group_contacts
CREATE TABLE IF NOT EXISTS `vk_group_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` varchar(50) DEFAULT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `desc` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

-- Дамп структуры для таблица yii_project.vk_group_cover_images
CREATE TABLE IF NOT EXISTS `vk_group_cover_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` varchar(50) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8;

-- Дамп структуры для таблица yii_project.vk_group_links
CREATE TABLE IF NOT EXISTS `vk_group_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` varchar(50) DEFAULT NULL,
  `url` varchar(50) DEFAULT NULL,
  `edit_title` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `desc` varchar(50) DEFAULT NULL,
  `photo_50` varchar(250) DEFAULT NULL,
  `photo_100` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=467 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
