-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.3.16-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for ticketly
CREATE DATABASE IF NOT EXISTS `ticketly` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ticketly`;

-- Dumping structure for table ticketly.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ticketly.category: ~0 rows (approximately)
DELETE FROM `category`;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `name`) VALUES
  (1, 'Web');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table ticketly.kind
CREATE TABLE IF NOT EXISTS `kind` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ticketly.kind: ~4 rows (approximately)
DELETE FROM `kind`;
/*!40000 ALTER TABLE `kind` DISABLE KEYS */;
INSERT INTO `kind` (`id`, `name`) VALUES
  (1, 'Ticket'),
  (2, 'Solicitud de Equipo'),
  (3, 'Sugerencia'),
  (4, 'Caracteristica');
/*!40000 ALTER TABLE `kind` ENABLE KEYS */;

-- Dumping structure for table ticketly.kind_user
CREATE TABLE IF NOT EXISTS `kind_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ticketly.kind_user: ~3 rows (approximately)
DELETE FROM `kind_user`;
/*!40000 ALTER TABLE `kind_user` DISABLE KEYS */;
INSERT INTO `kind_user` (`id`, `type`) VALUES
  (1, 'admin'),
  (2, 'user'),
  (3, 'Tecnico');
/*!40000 ALTER TABLE `kind_user` ENABLE KEYS */;

-- Dumping structure for table ticketly.priority
CREATE TABLE IF NOT EXISTS `priority` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table ticketly.priority: ~3 rows (approximately)
DELETE FROM `priority`;
/*!40000 ALTER TABLE `priority` DISABLE KEYS */;
INSERT INTO `priority` (`id`, `name`) VALUES
  (1, 'Alta'),
  (2, 'Media'),
  (3, 'Baja');
/*!40000 ALTER TABLE `priority` ENABLE KEYS */;

-- Dumping structure for table ticketly.project
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ticketly.project: ~2 rows (approximately)
DELETE FROM `project`;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` (`id`, `name`, `description`) VALUES
  (1, 'Solticss', 'Solticss'),
  (2, 'SpecialChem', 'Special Chem S.A de C.V');
/*!40000 ALTER TABLE `project` ENABLE KEYS */;

-- Dumping structure for table ticketly.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table ticketly.status: ~4 rows (approximately)
DELETE FROM `status`;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`id`, `name`) VALUES
  (1, 'Pendiente'),
  (2, 'En Desarrollo'),
  (3, 'Terminado'),
  (4, 'Cancelado');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;

-- Dumping structure for table ticketly.ticket
CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `kind_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `priority_id` int(11) NOT NULL DEFAULT 1,
  `status_id` int(11) NOT NULL DEFAULT 1,
  `atendido_por` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `priority_id` (`priority_id`),
  KEY `status_id` (`status_id`),
  KEY `user_id` (`user_id`),
  KEY `kind_id` (`kind_id`),
  KEY `category_id` (`category_id`),
  KEY `ticket_atfk7` (`atendido_por`),
  KEY `ticket_prfk` (`project_id`),
  CONSTRAINT `ticket_atfk7` FOREIGN KEY (`atendido_por`) REFERENCES `user` (`id`),
  CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`priority_id`) REFERENCES `priority` (`id`),
  CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `ticket_ibfk_4` FOREIGN KEY (`kind_id`) REFERENCES `kind` (`id`),
  CONSTRAINT `ticket_ibfk_5` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `ticket_prfk` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

-- Dumping data for table ticketly.ticket: ~2 rows (approximately)
DELETE FROM `ticket`;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
INSERT INTO `ticket` (`id`, `title`, `description`, `updated_at`, `created_at`, `kind_id`, `project_id`, `user_id`, `category_id`, `priority_id`, `status_id`, `atendido_por`) VALUES
  (41, 'Prueba Mail', 'no sirve', NULL, '2019-08-14 18:07:20', 2, 2, 2, 1, 1, 1, NULL),
  (42, 'Prueba Mail', 'a', '2019-08-15 13:09:19', '2019-08-14 18:12:29', 1, 2, 2, 1, 1, 2, 5),
  (49, 'Impresora', 'Esta fallando', NULL, '2019-08-15 14:28:32', 1, 2, 1, 1, 1, 1, NULL),
  (58, 'Prueba Mail', 'as', '2019-08-15 16:18:32', '2019-08-15 15:56:58', 1, 2, 2, 1, 2, 2, 5);
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;

-- Dumping structure for table ticketly.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `profile_pic` varchar(250) DEFAULT 'default.png',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `kind` int(11) DEFAULT NULL,
  `empresa` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_kufk_1` (`kind`),
  KEY `user_empfk_2` (`empresa`),
  CONSTRAINT `user_empfk_2` FOREIGN KEY (`empresa`) REFERENCES `project` (`id`),
  CONSTRAINT `user_kufk_1` FOREIGN KEY (`kind`) REFERENCES `kind_user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table ticketly.user: ~6 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `name`, `email`, `password`, `profile_pic`, `is_active`, `kind`, `empresa`, `created_at`) VALUES
  (1, 'admin', 'Juan Luis Perez', 'pjuanluis97@gmail.com', '36b3caecabe51cedf773bfcb074a21089a533f96', 'mrobot.jpg', 1, 1, 1, '2019-08-09 00:00:00'),
  (2, 'usertest', 'Daniela Montes', 'test@solticss.mx', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'default.png', 1, 2, 2, '2019-08-09 00:00:00'),
  (3, NULL, 'Jose Arzate', 'jose.arzate@solticss.mx', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'default.png', 1, 1, 1, '2019-08-10 13:41:47'),
  (5, NULL, 'Angel  Perez', 'angel@solticss.mx', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'default.png', 1, 3, 1, '2019-08-10 14:40:19'),
  (8, NULL, 'Carlos  Ramon', '1@q.mx', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'default.png', 1, 2, 2, '2019-08-13 18:38:36'),
  (9, NULL, 'Robert Nava', 'user@specialchem.com.mx', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'default.png', 1, 2, 2, '2019-08-15 13:53:55');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
