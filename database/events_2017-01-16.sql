# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.16-0ubuntu0.16.04.1)
# Database: events
# Generation Time: 2017-01-16 11:59:57 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table attendees_to_events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `attendees_to_events`;

CREATE TABLE `attendees_to_events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `event_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `attendees_to_events_user_id_foreign` (`user_id`),
  KEY `attendees_to_events_event_id_foreign` (`event_id`),
  CONSTRAINT `attendees_to_events_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  CONSTRAINT `attendees_to_events_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table events
# ------------------------------------------------------------

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `speaker_1` int(11) unsigned NOT NULL,
  `speaker_2` int(11) unsigned NOT NULL,
  `speaker_3` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `theme` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `scheduled_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `events_speaker_1_foreign` (`speaker_1`),
  KEY `events_speaker_2_foreign` (`speaker_2`),
  KEY `events_speaker_3_foreign` (`speaker_3`),
  CONSTRAINT `events_speaker_1_foreign` FOREIGN KEY (`speaker_1`) REFERENCES `users` (`id`),
  CONSTRAINT `events_speaker_2_foreign` FOREIGN KEY (`speaker_2`) REFERENCES `users` (`id`),
  CONSTRAINT `events_speaker_3_foreign` FOREIGN KEY (`speaker_3`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table presentations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `presentations`;

CREATE TABLE `presentations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `event_id` int(11) unsigned NOT NULL,
  `presentation` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `presentations_user_id_foreign` (`user_id`),
  KEY `presentations_event_id_foreign` (`event_id`),
  CONSTRAINT `presentations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  CONSTRAINT `presentations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table statistics
# ------------------------------------------------------------

DROP TABLE IF EXISTS `statistics`;

CREATE TABLE `statistics` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `page` varchar(255) NOT NULL DEFAULT '',
  `views` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL DEFAULT '',
  `last_name` varchar(255) NOT NULL DEFAULT '',
  `avatar` varchar(255) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `admin` char(1) NOT NULL DEFAULT 'N',
  `speaker` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
