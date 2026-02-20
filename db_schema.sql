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

-- Dumping structure for table spxcinemasdb.cinemas
CREATE TABLE IF NOT EXISTS `cinemas` (
  `cinemaId` int NOT NULL AUTO_INCREMENT,
  `cinemaName` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `locationId` int NOT NULL,
  PRIMARY KEY (`cinemaId`),
  KEY `FK_cinemas_locations` (`locationId`),
  CONSTRAINT `FK_cinemas_locations` FOREIGN KEY (`locationId`) REFERENCES `locations` (`locationId`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table spxcinemasdb.cinemas: ~12 rows (approximately)
INSERT INTO `cinemas` (`cinemaId`, `cinemaName`, `locationId`) VALUES
	(1, 'Chatswood 1', 1),
	(2, 'Chatswood 2', 1),
	(3, 'Chatswood 3', 1),
	(4, 'Epping 1', 2),
	(5, 'Epping 2', 2),
	(6, 'Epping 3', 2),
	(7, 'Eastwood 1', 3),
	(8, 'Eastwood 2', 3),
	(9, 'Eastwood 3', 3),
	(10, 'Macquarie 1', 4),
	(11, 'Macquarie 2', 4),
	(12, 'Macquarie 3', 4);

-- Dumping structure for table spxcinemasdb.locations
CREATE TABLE IF NOT EXISTS `locations` (
  `locationId` int NOT NULL AUTO_INCREMENT,
  `locationName` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`locationId`),
  UNIQUE KEY `locationName` (`locationName`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table spxcinemasdb.locations: ~5 rows (approximately)
INSERT INTO `locations` (`locationId`, `locationName`) VALUES
	(1, 'Chatswood'),
	(3, 'Eastwood'),
	(2, 'Epping'),
	(4, 'Macquarie Centre ');

-- Dumping structure for table spxcinemasdb.movies
CREATE TABLE IF NOT EXISTS `movies` (
  `movieId` int NOT NULL AUTO_INCREMENT,
  `movieName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `movieDescription` text COLLATE utf8mb4_general_ci,
  `posterFileName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `trailerFileName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`movieId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table spxcinemasdb.movies: ~6 rows (approximately)
INSERT INTO `movies` (`movieId`, `movieName`, `movieDescription`, `posterFileName`, `trailerFileName`) VALUES
	(1, 'The Godfather', 'Don Vito Corleone, head of a mafia family, decides to hand over his empire to his youngest son, Michael. However, his decision unintentionally puts the lives of his loved ones in grave danger.', 'Godfather.png', 'https://www.youtube.com/embed/UaVTIH8mujA?si=CkZSHWy2JHsH1kG2'),
	(2, 'Edge of Tomorrow', 'With the help of warrior Rita Vrataski, Major William Cage has to save Earth from an alien species, after being caught in a time loop. He must face deadly challenges in order to accomplish his task.', 'EdgeofTomorrow.jpg', 'https://www.youtube.com/embed/yUmSVcttXnI?si=q6KNLccMGx0akwLz'),
	(3, 'Inception', 'Cobb steals information from his targets by entering their dreams. He is wanted for his alleged role in his wife\'s murder and his only chance at redemption is to perform a nearly impossible task.', 'Inception.jpg', 'https://www.youtube.com/embed/B4IXWfyrrhc?si=LOQBnmDwXPCU9Gtr'),
	(4, 'Minority Report', 'John works with the PreCrime police which stop crimes before they take place, with the help of three \'PreCogs\' who can foresee crimes. Events ensue when John finds himself framed for a future murder.', 'MinorityReport.jpg', 'https://www.youtube.com/embed/5_EARgViIfE?si=dSG6u8iMbfVyz78_" '),
	(5, 'Alita: Battle Angel', 'Alita, a battle cyborg, is revived by Ido, a doctor, who realises that she actually has the soul of a teenager. Alita then sets out to learn about her past and find her true identity.', 'AlitaBattleAngel.jpg', 'https://www.youtube.com/embed/w7pYhpJaJW8?si=-YgNdw3JhPCyYXkr'),
	(6, 'House of Dynamite', 'Radars at Fort Greely, Alaska, detect a nuclear missile. The president and his entourage must use the limited time they have to try to shoot down the missile before it reaches Chicago.', 'HouseofDynamite.jpg', 'https://www.youtube.com/embed/bp1QjSGGW_M?si=s-6SHaa0fmhV6r6f');

-- Dumping structure for table spxcinemasdb.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `sessionId` int NOT NULL AUTO_INCREMENT,
  `sessionTime` time NOT NULL,
  `sessionCost` decimal(6,2) NOT NULL DEFAULT '0.00',
  `cinemaId` int NOT NULL DEFAULT '0',
  `movieId` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`sessionId`),
  KEY `cinemaId` (`cinemaId`),
  KEY `movieId` (`movieId`),
  CONSTRAINT `cinemaId` FOREIGN KEY (`cinemaId`) REFERENCES `cinemas` (`cinemaId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `movieId` FOREIGN KEY (`movieId`) REFERENCES `movies` (`movieId`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table spxcinemasdb.sessions: ~32 rows (approximately)
INSERT INTO `sessions` (`sessionId`, `sessionTime`, `sessionCost`, `cinemaId`, `movieId`) VALUES
	(2, '10:00:00', 20.00, 1, 5),
	(6, '15:00:00', 30.00, 1, 3),
	(7, '20:00:00', 35.00, 1, 1),
	(9, '10:00:00', 20.00, 2, 4),
	(13, '15:00:00', 30.00, 2, 2),
	(14, '20:00:00', 35.00, 2, 3),
	(15, '10:00:00', 20.00, 3, 2),
	(16, '15:00:00', 30.00, 3, 3),
	(17, '20:00:00', 35.00, 3, 5),
	(19, '10:00:00', 20.00, 4, 1),
	(20, '15:00:00', 30.00, 4, 3),
	(23, '20:00:00', 35.00, 4, 2),
	(24, '10:00:00', 20.00, 5, 5),
	(25, '15:00:00', 30.00, 5, 4),
	(26, '20:00:00', 35.00, 5, 1),
	(27, '10:00:00', 20.00, 6, 4),
	(28, '15:00:00', 30.00, 6, 3),
	(29, '20:00:00', 35.00, 6, 5),
	(30, '10:00:00', 20.00, 7, 5),
	(31, '15:00:00', 30.00, 7, 4),
	(32, '20:00:00', 35.00, 7, 1),
	(34, '10:00:00', 25.00, 8, 6),
	(35, '15:00:00', 30.00, 8, 3),
	(37, '20:00:00', 35.00, 8, 1),
	(38, '10:00:00', 20.00, 9, 3),
	(39, '15:00:00', 30.00, 9, 5),
	(40, '20:00:00', 40.00, 9, 6),
	(41, '10:00:00', 20.00, 10, 2),
	(42, '15:00:00', 30.00, 10, 5),
	(44, '20:00:00', 35.00, 10, 4),
	(45, '10:00:00', 20.00, 11, 3),
	(46, '15:00:00', 35.00, 11, 6),
	(47, '20:00:00', 30.00, 11, 1),
	(48, '10:00:00', 20.00, 12, 2),
	(49, '15:00:00', 30.00, 12, 4),
	(50, '20:00:00', 35.00, 12, 5);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
