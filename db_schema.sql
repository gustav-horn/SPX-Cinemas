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

-- Dumping structure for table spxcinemasdb.auditlogs
CREATE TABLE IF NOT EXISTS `auditlogs` (
  `auditLogId` int NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL,
  `entity` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `action` enum('update','insert','delete','login','logout') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `entry` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`auditLogId`)
) ENGINE=InnoDB AUTO_INCREMENT=286 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table spxcinemasdb.auditlogs: ~245 rows (approximately)
INSERT INTO `auditlogs` (`auditLogId`, `timestamp`, `entity`, `action`, `entry`) VALUES
	(19, '2026-03-04 11:33:34', 'Member (id = 8, username = jbloggs)', 'logout', 'Member (username = jbloggs) logged out'),
	(20, '2026-03-04 11:33:48', 'Member (id = 8, username = jbloggs)', 'login', 'Member (username = jbloggs) logged in'),
	(21, '2026-03-04 11:33:57', 'Member (id = 8, username = jbloggs)', 'logout', 'Member (username = jbloggs) logged out'),
	(22, '2026-03-04 11:34:11', 'Member (id = 8, username = jbloggs)', 'login', 'Member (username = jbloggs) logged in'),
	(23, '2026-03-04 11:34:22', 'Member (id = 8, username = jbloggs)', 'update', 'Member (id = 8, username = jbloggs) updated their personal data'),
	(24, '2026-03-04 11:34:43', 'Member (id = 8, username = jbloggs)', 'logout', 'Member (username = jbloggs) logged out'),
	(25, '2026-03-04 11:35:05', 'members table', 'insert', 'new Member created. Username: mcheah, Id: '),
	(26, '2026-03-04 11:35:16', 'Member (id = 11, username = mcheah)', 'login', 'Member (username = mcheah) logged in'),
	(27, '2026-03-04 11:36:10', 'Member (id = 11, username = mcheah)', 'delete', 'Member (id = 11, username = mcheah) deleted their account'),
	(28, '2026-03-04 11:36:10', 'Member (id = 11, username = mcheah)', 'logout', 'Member (username = mcheah) logged out'),
	(29, '2026-03-05 16:39:40', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(30, '2026-03-05 16:39:58', 'Member (id = 8, username = jbloggs)', 'update', 'Member (id = 8, username = jbloggs) updated their personal data'),
	(31, '2026-03-05 16:51:11', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(32, '2026-03-05 16:51:33', 'Members table', 'insert', 'new Member(id = , username = mcheah) created'),
	(33, '2026-03-05 16:51:41', 'Member(id = 12, username = mcheah)', 'login', 'Member(id = 12, username = mcheah) logged in'),
	(34, '2026-03-05 17:01:31', 'Member(id = 12, username = mcheah)', 'logout', 'Member(id = 12, username = mcheah) logged out'),
	(35, '2026-03-05 17:02:06', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(36, '2026-03-05 19:37:25', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(37, '2026-03-05 19:37:40', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(38, '2026-03-09 14:10:13', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(39, '2026-03-09 14:10:46', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(40, '2026-03-09 14:44:24', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(41, '2026-03-09 14:45:22', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(42, '2026-03-09 14:45:40', 'Member(id = 8, username = jbloggs)', 'update', 'Member(id = 8, username = jbloggs) was updated'),
	(43, '2026-03-09 23:17:37', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(44, '2026-03-09 23:17:57', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(45, '2026-03-09 23:26:35', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(46, '2026-03-09 23:26:50', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(47, '2026-03-09 23:32:35', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(48, '2026-03-11 11:08:32', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(49, '2026-03-11 11:18:52', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(50, '2026-03-11 11:19:28', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(51, '2026-03-11 11:20:18', 'Member(id = 8, username = jbloggs)', 'update', 'Member(id = 8, username = jbloggs) was updated'),
	(52, '2026-03-11 11:20:55', 'Member(id = 8, username = jbloggs)', 'update', 'Member(id = 8, username = jbloggs) was updated'),
	(53, '2026-03-11 11:21:06', 'Member(id = 8, username = jbloggs)', 'update', 'Member(id = 8, username = jbloggs) was updated'),
	(54, '2026-03-11 11:25:30', 'Member(id = 8, username = jbloggs)', 'update', 'Member(id = 8, username = jbloggs) was updated'),
	(55, '2026-03-11 11:32:36', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(56, '2026-03-11 11:32:45', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(57, '2026-03-11 11:35:26', 'Member(id = 8, username = jbloggs)', 'update', 'Member(id = 8, username = jbloggs) was updated'),
	(58, '2026-03-11 11:39:04', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(59, '2026-03-11 11:40:11', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(60, '2026-03-12 13:40:54', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(61, '2026-03-12 13:43:22', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(62, '2026-03-12 13:43:51', 'Member(id = 8, username = jbloggs)', 'update', 'Member(id = 8, username = jbloggs) was updated'),
	(63, '2026-03-12 13:46:55', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(64, '2026-03-12 13:50:21', 'Members table', 'insert', 'new Member(id = , username = hello) created'),
	(65, '2026-03-12 13:57:38', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(66, '2026-03-12 13:57:42', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(67, '2026-03-14 16:17:39', 'Members table', 'insert', 'new Member(id = , username = hello) created'),
	(68, '2026-03-14 16:17:52', 'Member(id = 14, username = hello)', 'login', 'Member(id = 14, username = hello) logged in'),
	(69, '2026-03-14 16:19:35', 'Member(id = 14, username = hello)', 'logout', 'Member(id = 14, username = hello) logged out'),
	(70, '2026-03-14 16:20:35', 'Members table', 'insert', 'new Member(id = , username = mcheah) created'),
	(71, '2026-03-14 16:22:32', 'Member(id = 15, username = mcheah)', 'login', 'Member(id = 15, username = mcheah) logged in'),
	(72, '2026-03-14 16:28:00', 'Member(id = 15, username = mcheah)', 'logout', 'Member(id = 15, username = mcheah) logged out'),
	(73, '2026-03-14 16:28:38', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(74, '2026-03-14 16:28:38', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(75, '2026-03-14 16:28:51', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(76, '2026-03-14 16:32:51', 'Member(id = 8, username = jbloggs)', 'update', 'Member(id = 8, username = jbloggs) was updated'),
	(77, '2026-03-14 16:46:59', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(78, '2026-03-14 17:04:05', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(79, '2026-03-14 17:04:05', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(80, '2026-03-14 17:04:39', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(81, '2026-03-14 17:09:56', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(82, '2026-03-14 17:10:20', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(83, '2026-03-14 17:17:13', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(84, '2026-03-15 14:51:25', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(85, '2026-03-16 16:10:56', 'Member(id = 15, username = mcheah)', 'logout', 'Member(id = 15, username = mcheah) logged out'),
	(86, '2026-03-16 16:11:05', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(87, '2026-03-17 15:29:40', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(88, '2026-03-17 15:31:52', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(89, '2026-03-18 11:28:58', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(90, '2026-03-18 11:29:05', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(91, '2026-03-18 11:33:29', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(92, '2026-03-18 11:33:41', 'Member(id = 15, username = mcheah)', 'login', 'Member(id = 15, username = mcheah) logged in'),
	(93, '2026-03-18 11:41:42', 'Member(id = 15, username = mcheah)', 'logout', 'Member(id = 15, username = mcheah) logged out'),
	(94, '2026-03-18 11:41:56', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(95, '2026-03-18 11:48:59', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(96, '2026-03-18 11:52:52', 'Members table', 'insert', 'new Member(id = , username = XSS tester) created'),
	(97, '2026-03-18 11:53:03', 'Member(id = 16, username = XSS tester)', 'login', 'Member(id = 16, username = XSS tester) logged in'),
	(98, '2026-03-18 11:54:39', 'Member(id = 16, username = XSS tester)', 'delete', 'Member(id = 16, username = XSS tester) was deleted'),
	(99, '2026-03-18 11:54:39', 'Member(id = 16, username = XSS tester)', 'logout', 'Member(id = 16, username = XSS tester) logged out'),
	(100, '2026-03-18 11:55:19', 'Members table', 'insert', 'new Member(id = , username = XSS tester) created'),
	(101, '2026-03-18 11:56:04', 'Member(id = 17, username = XSS tester)', 'login', 'Member(id = 17, username = XSS tester) logged in'),
	(102, '2026-03-19 16:21:33', 'Member(id = 17, username = XSS tester)', 'logout', 'Member(id = 17, username = XSS tester) logged out'),
	(103, '2026-03-19 16:31:40', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(104, '2026-03-19 16:31:40', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(105, '2026-03-19 16:31:53', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(106, '2026-03-19 16:51:01', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(107, '2026-03-19 16:51:09', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(108, '2026-03-19 17:00:25', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(109, '2026-03-19 17:00:34', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(110, '2026-03-19 17:02:23', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(111, '2026-03-26 11:41:35', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(112, '2026-04-01 11:32:18', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(113, '2026-04-23 15:30:43', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(114, '2026-04-27 22:59:45', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(115, '2026-04-27 22:59:56', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(116, '2026-04-27 23:14:59', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(117, '2026-04-27 23:15:09', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(118, '2026-04-27 23:39:28', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(119, '2026-04-27 23:39:38', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(120, '2026-04-27 23:46:52', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(121, '2026-04-27 23:47:00', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(122, '2026-04-28 00:02:50', 'bookings table', 'insert', 'new booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 8, pricePerSeat = 30) created'),
	(123, '2026-04-28 00:06:58', 'bookings table', 'insert', 'new booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 8, pricePerSeat = 30) created'),
	(124, '2026-04-28 17:38:46', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(125, '2026-04-28 17:38:55', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(126, '2026-04-28 17:50:21', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(127, '2026-04-28 17:50:27', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(128, '2026-04-28 17:51:26', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(129, '2026-04-28 17:51:35', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(130, '2026-04-28 18:00:08', 'bookings table', 'insert', 'new booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 0, pricePerSeat = 20) created'),
	(131, '2026-04-28 18:06:31', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(132, '2026-04-28 18:06:38', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(133, '2026-04-28 18:07:39', 'bookings table', 'insert', 'new booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 24, movie = Alita: Battle Angel, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 10:00:000, cost = 20), seats = 0, pricePerSeat = 20) created'),
	(134, '2026-04-28 18:07:42', 'bookings table', 'insert', 'new booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 24, movie = Alita: Battle Angel, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) created'),
	(135, '2026-04-28 18:08:16', 'bookings table', 'insert', 'new booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 3, pricePerSeat = 20) created'),
	(136, '2026-04-28 18:09:54', 'bookings table', 'insert', 'new booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 3, pricePerSeat = 20) created'),
	(137, '2026-04-28 18:09:58', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(138, '2026-04-28 18:10:23', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(139, '2026-04-28 18:10:31', 'bookings table', 'insert', 'new booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) created'),
	(140, '2026-04-28 18:11:24', 'bookings table', 'insert', 'new booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) created'),
	(141, '2026-04-28 18:11:41', 'bookings table', 'insert', 'new booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) created'),
	(142, '2026-04-28 18:11:51', 'bookings table', 'insert', 'new booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) created'),
	(143, '2026-04-28 23:03:00', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(144, '2026-04-28 23:06:49', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(145, '2026-04-29 00:22:57', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(146, '2026-04-29 00:23:04', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(147, '2026-05-02 16:47:57', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(148, '2026-05-02 16:48:05', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(149, '2026-05-02 17:12:31', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(150, '2026-05-02 17:12:38', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(151, '2026-05-02 17:25:14', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(152, '2026-05-02 17:25:21', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(153, '2026-05-02 17:27:22', 'Booking(id = 1, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 3, pricePerSeat = 30)', 'update', 'Booking(id = 1, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 3, pricePerSeat = 30) was updated'),
	(154, '2026-05-02 17:29:56', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = Sun, 03 May 2026 03:29:56 GMT) created'),
	(155, '2026-05-02 17:29:56', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = , member = Member(id = 8, username = jbloggs), time = Sun, 03 May 2026 03:29:56 GMT), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 3, pricePerSeat = 30) created'),
	(156, '2026-05-02 17:29:56', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = , member = Member(id = 8, username = jbloggs), time = Sun, 03 May 2026 03:29:56 GMT), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 0, pricePerSeat = 20) created'),
	(157, '2026-05-02 17:29:56', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = , member = Member(id = 8, username = jbloggs), time = Sun, 03 May 2026 03:29:56 GMT), session = Session(id = 24, movie = Alita: Battle Angel, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 10:00:000, cost = 20), seats = 0, pricePerSeat = 20) created'),
	(158, '2026-05-02 17:29:56', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = , member = Member(id = 8, username = jbloggs), time = Sun, 03 May 2026 03:29:56 GMT), session = Session(id = 24, movie = Alita: Battle Angel, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) created'),
	(159, '2026-05-02 17:29:56', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = , member = Member(id = 8, username = jbloggs), time = Sun, 03 May 2026 03:29:56 GMT), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 3, pricePerSeat = 20) created'),
	(160, '2026-05-02 17:29:56', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = , member = Member(id = 8, username = jbloggs), time = Sun, 03 May 2026 03:29:56 GMT), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 3, pricePerSeat = 20) created'),
	(161, '2026-05-02 17:29:56', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = , member = Member(id = 8, username = jbloggs), time = Sun, 03 May 2026 03:29:56 GMT), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) created'),
	(162, '2026-05-02 17:29:57', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = , member = Member(id = 8, username = jbloggs), time = Sun, 03 May 2026 03:29:56 GMT), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) created'),
	(163, '2026-05-02 17:29:57', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = , member = Member(id = 8, username = jbloggs), time = Sun, 03 May 2026 03:29:56 GMT), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) created'),
	(164, '2026-05-02 17:29:57', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = , member = Member(id = 8, username = jbloggs), time = Sun, 03 May 2026 03:29:56 GMT), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) created'),
	(165, '2026-05-02 17:29:57', 'Booking(id = 1, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 3, pricePerSeat = 30)', 'delete', 'Booking(id = 1, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 3, pricePerSeat = 30) was deleted'),
	(166, '2026-05-02 17:29:57', 'Booking(id = 2, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 0, pricePerSeat = 20)', 'delete', 'Booking(id = 2, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 0, pricePerSeat = 20) was deleted'),
	(167, '2026-05-02 17:29:57', 'Booking(id = 3, member = Member(id = 8, username = jbloggs), session = Session(id = 24, movie = Alita: Battle Angel, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 10:00:000, cost = 20), seats = 0, pricePerSeat = 20)', 'delete', 'Booking(id = 3, member = Member(id = 8, username = jbloggs), session = Session(id = 24, movie = Alita: Battle Angel, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 10:00:000, cost = 20), seats = 0, pricePerSeat = 20) was deleted'),
	(168, '2026-05-02 17:29:57', 'Booking(id = 4, member = Member(id = 8, username = jbloggs), session = Session(id = 24, movie = Alita: Battle Angel, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20)', 'delete', 'Booking(id = 4, member = Member(id = 8, username = jbloggs), session = Session(id = 24, movie = Alita: Battle Angel, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) was deleted'),
	(169, '2026-05-02 17:29:57', 'Booking(id = 5, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 3, pricePerSeat = 20)', 'delete', 'Booking(id = 5, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 3, pricePerSeat = 20) was deleted'),
	(170, '2026-05-02 17:29:57', 'Booking(id = 6, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 3, pricePerSeat = 20)', 'delete', 'Booking(id = 6, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 3, pricePerSeat = 20) was deleted'),
	(171, '2026-05-02 17:29:57', 'Booking(id = 7, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20)', 'delete', 'Booking(id = 7, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) was deleted'),
	(172, '2026-05-02 17:29:57', 'Booking(id = 8, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20)', 'delete', 'Booking(id = 8, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) was deleted'),
	(173, '2026-05-02 17:29:57', 'Booking(id = 9, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20)', 'delete', 'Booking(id = 9, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) was deleted'),
	(174, '2026-05-02 17:29:57', 'Booking(id = 10, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20)', 'delete', 'Booking(id = 10, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) was deleted'),
	(175, '2026-05-02 17:32:37', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-03 03:32:37) created'),
	(176, '2026-05-02 17:32:46', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 1, pricePerSeat = 30) created'),
	(177, '2026-05-02 17:32:50', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-03 03:32:50) created'),
	(178, '2026-05-02 17:32:50', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-03 03:32:50), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 1, pricePerSeat = 30) created'),
	(179, '2026-05-02 17:32:50', 'Booking(id = 11, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 1, pricePerSeat = 30)', 'delete', 'Booking(id = 11, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 1, pricePerSeat = 30) was deleted'),
	(180, '2026-05-02 17:34:30', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-03 03:34:30) created'),
	(181, '2026-05-02 17:34:58', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-03 03:34:58) created'),
	(182, '2026-05-02 17:35:17', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-03 03:35:17) created'),
	(183, '2026-05-02 17:35:31', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-03 03:35:31) created'),
	(184, '2026-05-02 17:36:18', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-03 03:36:18) created'),
	(185, '2026-05-02 17:39:04', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(186, '2026-05-02 17:39:43', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(187, '2026-05-02 17:39:49', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(188, '2026-05-02 17:40:17', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(189, '2026-05-03 18:42:39', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(190, '2026-05-03 18:43:16', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(191, '2026-05-03 18:43:34', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 2, pricePerSeat = 30) created'),
	(192, '2026-05-03 18:47:22', 'Booking(id = 12, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 2, pricePerSeat = 30)', 'update', 'Booking(id = 12, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 2, pricePerSeat = 30) was updated'),
	(193, '2026-05-03 18:56:09', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(194, '2026-05-03 18:56:16', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(195, '2026-05-03 18:56:23', 'Booking(id = 12, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 4, pricePerSeat = 30)', 'update', 'Booking(id = 12, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 4, pricePerSeat = 30) was updated'),
	(196, '2026-05-03 18:56:27', 'Booking(id = 12, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 4, pricePerSeat = 30)', 'update', 'Booking(id = 12, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 4, pricePerSeat = 30) was updated'),
	(197, '2026-05-03 18:57:39', 'Booking(id = 12, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 4, pricePerSeat = 30)', 'update', 'Booking(id = 12, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 4, pricePerSeat = 30) was updated'),
	(198, '2026-05-03 18:57:41', 'Booking(id = 12, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 4, pricePerSeat = 30)', 'update', 'Booking(id = 12, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 4, pricePerSeat = 30) was updated'),
	(199, '2026-05-03 18:57:52', 'Booking(id = 12, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 4, pricePerSeat = 30)', 'update', 'Booking(id = 12, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 4, pricePerSeat = 30) was updated'),
	(200, '2026-05-03 19:07:04', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(201, '2026-05-03 19:07:11', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(202, '2026-05-03 19:07:57', 'Booking(id = 12, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 4, pricePerSeat = 30)', 'delete', 'Booking(id = 12, member = Member(id = 8, username = jbloggs), session = Session(id = 13, movie = Edge of Tomorrow, cinema = Cinema(id = 2, name = Chatswood 2, location = Chatswood), time = 15:00:000, cost = 30), seats = 4, pricePerSeat = 30) was deleted'),
	(203, '2026-05-06 13:04:27', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(204, '2026-05-06 13:08:21', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 25, movie = Minority Report, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 15:00:000, cost = 30), seats = 2, pricePerSeat = 30) created'),
	(205, '2026-05-06 13:08:26', 'Booking(id = 13, member = Member(id = 8, username = jbloggs), session = Session(id = 25, movie = Minority Report, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 15:00:000, cost = 30), seats = 2, pricePerSeat = 30)', 'delete', 'Booking(id = 13, member = Member(id = 8, username = jbloggs), session = Session(id = 25, movie = Minority Report, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 15:00:000, cost = 30), seats = 2, pricePerSeat = 30) was deleted'),
	(206, '2026-05-06 13:08:28', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-06 23:08:28) created'),
	(207, '2026-05-06 13:08:30', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-06 23:08:30) created'),
	(208, '2026-05-06 13:08:38', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-06 23:08:38) created'),
	(209, '2026-05-06 13:26:02', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(210, '2026-05-06 13:31:30', 'Member(id = 15, username = mcheah)', 'login', 'Member(id = 15, username = mcheah) logged in'),
	(211, '2026-05-06 13:31:50', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 15, username = mcheah), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 4, pricePerSeat = 20) created'),
	(212, '2026-05-06 13:35:42', 'Booking(id = 14, member = Member(id = 15, username = mcheah), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 4, pricePerSeat = 20)', 'delete', 'Booking(id = 14, member = Member(id = 15, username = mcheah), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 4, pricePerSeat = 20) was deleted'),
	(213, '2026-05-06 13:49:53', 'Member(id = 15, username = mcheah)', 'logout', 'Member(id = 15, username = mcheah) logged out'),
	(214, '2026-05-06 13:50:06', 'Member(id = 15, username = mcheah)', 'login', 'Member(id = 15, username = mcheah) logged in'),
	(215, '2026-05-08 21:18:22', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(216, '2026-05-08 21:19:16', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(217, '2026-05-08 21:19:32', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 26, movie = The Godfather, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 20:00:000, cost = 35), seats = 2, pricePerSeat = 35) created'),
	(218, '2026-05-08 21:19:36', 'Booking(id = 15, member = Member(id = 8, username = jbloggs), session = Session(id = 26, movie = The Godfather, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 20:00:000, cost = 35), seats = 2, pricePerSeat = 35)', 'delete', 'Booking(id = 15, member = Member(id = 8, username = jbloggs), session = Session(id = 26, movie = The Godfather, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 20:00:000, cost = 35), seats = 2, pricePerSeat = 35) was deleted'),
	(219, '2026-05-08 21:23:54', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 23, movie = Edge of Tomorrow, cinema = Cinema(id = 4, name = Epping 1, location = Epping), time = 20:00:000, cost = 35), seats = 2, pricePerSeat = 35) created'),
	(220, '2026-05-08 21:30:01', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(221, '2026-05-08 21:30:10', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(222, '2026-05-08 21:30:20', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) created'),
	(223, '2026-05-08 21:30:59', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) created'),
	(224, '2026-05-08 21:31:09', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) created'),
	(225, '2026-05-08 21:32:23', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) created'),
	(226, '2026-05-08 21:32:27', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) created'),
	(227, '2026-05-08 21:32:35', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) created'),
	(228, '2026-05-08 21:32:54', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) created'),
	(229, '2026-05-08 21:35:03', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) created'),
	(230, '2026-05-08 21:35:12', 'Booking(id = 16, member = Member(id = 8, username = jbloggs), session = Session(id = 23, movie = Edge of Tomorrow, cinema = Cinema(id = 4, name = Epping 1, location = Epping), time = 20:00:000, cost = 35), seats = 2, pricePerSeat = 35)', 'delete', 'Booking(id = 16, member = Member(id = 8, username = jbloggs), session = Session(id = 23, movie = Edge of Tomorrow, cinema = Cinema(id = 4, name = Epping 1, location = Epping), time = 20:00:000, cost = 35), seats = 2, pricePerSeat = 35) was deleted'),
	(231, '2026-05-08 21:35:14', 'Booking(id = 17, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20)', 'delete', 'Booking(id = 17, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) was deleted'),
	(232, '2026-05-08 21:35:15', 'Booking(id = 18, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20)', 'delete', 'Booking(id = 18, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) was deleted'),
	(233, '2026-05-08 21:35:16', 'Booking(id = 19, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20)', 'delete', 'Booking(id = 19, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) was deleted'),
	(234, '2026-05-08 21:35:17', 'Booking(id = 20, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20)', 'delete', 'Booking(id = 20, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) was deleted'),
	(235, '2026-05-08 21:35:18', 'Booking(id = 21, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20)', 'delete', 'Booking(id = 21, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) was deleted'),
	(236, '2026-05-08 21:35:19', 'Booking(id = 22, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20)', 'delete', 'Booking(id = 22, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) was deleted'),
	(237, '2026-05-08 21:35:20', 'Booking(id = 23, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20)', 'delete', 'Booking(id = 23, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) was deleted'),
	(238, '2026-05-08 21:37:19', 'Booking(id = 24, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20)', 'delete', 'Booking(id = 24, member = Member(id = 8, username = jbloggs), session = Session(id = 30, movie = Alita: Battle Angel, cinema = Cinema(id = 7, name = Eastwood 1, location = Eastwood), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) was deleted'),
	(239, '2026-05-08 21:37:21', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-09 07:37:21) created'),
	(240, '2026-05-08 21:38:05', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-09 07:38:05) created'),
	(241, '2026-05-08 21:38:08', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-09 07:38:08) created'),
	(242, '2026-05-08 21:39:05', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) created'),
	(243, '2026-05-08 21:40:11', 'Booking(id = 25, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20)', 'delete', 'Booking(id = 25, member = Member(id = 8, username = jbloggs), session = Session(id = 15, movie = Edge of Tomorrow, cinema = Cinema(id = 3, name = Chatswood 3, location = Chatswood), time = 10:00:000, cost = 20), seats = 1, pricePerSeat = 20) was deleted'),
	(244, '2026-05-08 22:51:09', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(245, '2026-05-08 22:51:16', 'Member(id = 15, username = mcheah)', 'login', 'Member(id = 15, username = mcheah) logged in'),
	(246, '2026-05-08 22:53:22', 'Member(id = 15, username = mcheah)', 'logout', 'Member(id = 15, username = mcheah) logged out'),
	(247, '2026-05-08 22:53:29', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(248, '2026-05-08 22:55:19', 'Member(id = 8, username = jbloggs)', 'update', 'Member(id = 8, username = jbloggs) was updated'),
	(249, '2026-05-08 23:03:19', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 23, movie = Edge of Tomorrow, cinema = Cinema(id = 4, name = Epping 1, location = Epping), time = 20:00:000, cost = 35), seats = 3, pricePerSeat = 35) created'),
	(250, '2026-05-08 23:03:24', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-09 09:03:24) created'),
	(251, '2026-05-08 23:03:59', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 8, username = jbloggs), time = 2026-05-09 09:03:59) created'),
	(252, '2026-05-08 23:03:59', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = 15, member = Member(id = 8, username = jbloggs), time = 2026-05-09 09:03:59), session = Session(id = 23, movie = Edge of Tomorrow, cinema = Cinema(id = 4, name = Epping 1, location = Epping), time = 20:00:000, cost = 35), seats = 3, pricePerSeat = 35) created'),
	(253, '2026-05-08 23:03:59', 'Booking(id = 26, member = Member(id = 8, username = jbloggs), session = Session(id = 23, movie = Edge of Tomorrow, cinema = Cinema(id = 4, name = Epping 1, location = Epping), time = 20:00:000, cost = 35), seats = 3, pricePerSeat = 35)', 'delete', 'Booking(id = 26, member = Member(id = 8, username = jbloggs), session = Session(id = 23, movie = Edge of Tomorrow, cinema = Cinema(id = 4, name = Epping 1, location = Epping), time = 20:00:000, cost = 35), seats = 3, pricePerSeat = 35) was deleted'),
	(254, '2026-05-08 23:04:10', 'Member(id = 8, username = jbloggs)', 'update', 'Member(id = 8, username = jbloggs) was updated'),
	(255, '2026-05-08 23:14:08', 'Member(id = 15, username = mcheah)', 'login', 'Member(id = 15, username = mcheah) logged in'),
	(256, '2026-05-08 23:14:22', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 15, username = mcheah), session = Session(id = 20, movie = Inception, cinema = Cinema(id = 4, name = Epping 1, location = Epping), time = 15:00:000, cost = 30), seats = 2, pricePerSeat = 30) created'),
	(257, '2026-05-08 23:14:28', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 15, username = mcheah), session = Session(id = 44, movie = Minority Report, cinema = Cinema(id = 10, name = Macquarie 1, location = Macquarie Centre ), time = 20:00:000, cost = 35), seats = 1, pricePerSeat = 35) created'),
	(258, '2026-05-08 23:14:32', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 15, username = mcheah), time = 2026-05-09 09:14:32) created'),
	(259, '2026-05-08 23:14:32', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = 16, member = Member(id = 15, username = mcheah), time = 2026-05-09 09:14:32), session = Session(id = 20, movie = Inception, cinema = Cinema(id = 4, name = Epping 1, location = Epping), time = 15:00:000, cost = 30), seats = 2, pricePerSeat = 30) created'),
	(260, '2026-05-08 23:14:32', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = 16, member = Member(id = 15, username = mcheah), time = 2026-05-09 09:14:32), session = Session(id = 44, movie = Minority Report, cinema = Cinema(id = 10, name = Macquarie 1, location = Macquarie Centre ), time = 20:00:000, cost = 35), seats = 1, pricePerSeat = 35) created'),
	(261, '2026-05-08 23:14:32', 'Booking(id = 27, member = Member(id = 15, username = mcheah), session = Session(id = 20, movie = Inception, cinema = Cinema(id = 4, name = Epping 1, location = Epping), time = 15:00:000, cost = 30), seats = 2, pricePerSeat = 30)', 'delete', 'Booking(id = 27, member = Member(id = 15, username = mcheah), session = Session(id = 20, movie = Inception, cinema = Cinema(id = 4, name = Epping 1, location = Epping), time = 15:00:000, cost = 30), seats = 2, pricePerSeat = 30) was deleted'),
	(262, '2026-05-08 23:14:32', 'Booking(id = 28, member = Member(id = 15, username = mcheah), session = Session(id = 44, movie = Minority Report, cinema = Cinema(id = 10, name = Macquarie 1, location = Macquarie Centre ), time = 20:00:000, cost = 35), seats = 1, pricePerSeat = 35)', 'delete', 'Booking(id = 28, member = Member(id = 15, username = mcheah), session = Session(id = 44, movie = Minority Report, cinema = Cinema(id = 10, name = Macquarie 1, location = Macquarie Centre ), time = 20:00:000, cost = 35), seats = 1, pricePerSeat = 35) was deleted'),
	(263, '2026-05-08 23:14:36', 'Member(id = 15, username = mcheah)', 'update', 'Member(id = 15, username = mcheah) was updated'),
	(264, '2026-05-08 23:23:27', 'Member(id = 15, username = mcheah)', 'logout', 'Member(id = 15, username = mcheah) logged out'),
	(265, '2026-05-08 23:23:34', 'Member(id = 15, username = mcheah)', 'login', 'Member(id = 15, username = mcheah) logged in'),
	(266, '2026-05-08 23:33:40', 'Member(id = 15, username = mcheah)', 'logout', 'Member(id = 15, username = mcheah) logged out'),
	(267, '2026-05-08 23:34:19', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(268, '2026-05-11 16:32:19', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(269, '2026-05-11 16:32:27', 'Member(id = 15, username = mcheah)', 'login', 'Member(id = 15, username = mcheah) logged in'),
	(270, '2026-05-11 16:32:32', 'Member(id = 15, username = mcheah)', 'update', 'Member(id = 15, username = mcheah) was updated'),
	(271, '2026-05-11 16:39:02', 'Member(id = 15, username = mcheah)', 'logout', 'Member(id = 15, username = mcheah) logged out'),
	(272, '2026-05-11 16:39:10', 'Member(id = 15, username = mcheah)', 'login', 'Member(id = 15, username = mcheah) logged in'),
	(273, '2026-05-11 16:43:28', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 15, username = mcheah), session = Session(id = 27, movie = Minority Report, cinema = Cinema(id = 6, name = Epping 3, location = Epping), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) created'),
	(274, '2026-05-11 16:43:32', 'Orders table', 'insert', 'new Order(id = , member = Member(id = 15, username = mcheah), time = 2026-05-12 02:43:32) created'),
	(275, '2026-05-11 16:43:32', 'OrderItems table', 'insert', 'new OrderItem(id = , order = Order(id = 17, member = Member(id = 15, username = mcheah), time = 2026-05-12 02:43:32), session = Session(id = 27, movie = Minority Report, cinema = Cinema(id = 6, name = Epping 3, location = Epping), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) created'),
	(276, '2026-05-11 16:43:32', 'Booking(id = 29, member = Member(id = 15, username = mcheah), session = Session(id = 27, movie = Minority Report, cinema = Cinema(id = 6, name = Epping 3, location = Epping), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20)', 'delete', 'Booking(id = 29, member = Member(id = 15, username = mcheah), session = Session(id = 27, movie = Minority Report, cinema = Cinema(id = 6, name = Epping 3, location = Epping), time = 10:00:000, cost = 20), seats = 2, pricePerSeat = 20) was deleted'),
	(277, '2026-05-11 16:43:37', 'Member(id = 15, username = mcheah)', 'update', 'Member(id = 15, username = mcheah) was updated'),
	(278, '2026-05-11 16:51:19', 'Member(id = 15, username = mcheah)', 'update', 'Member(id = 15, username = mcheah) was updated'),
	(279, '2026-05-14 18:14:03', 'Member(id = 15, username = mcheah)', 'logout', 'Member(id = 15, username = mcheah) logged out'),
	(280, '2026-05-14 18:14:11', 'Member(id = 8, username = jbloggs)', 'login', 'Member(id = 8, username = jbloggs) logged in'),
	(281, '2026-05-14 18:14:48', 'Bookings table', 'insert', 'new Booking(id = , member = Member(id = 8, username = jbloggs), session = Session(id = 25, movie = Minority Report, cinema = Cinema(id = 5, name = Epping 2, location = Epping), time = 15:00:000, cost = 30), seats = 2, pricePerSeat = 30) created'),
	(282, '2026-05-14 18:15:02', 'Member(id = 8, username = jbloggs)', 'update', 'Member(id = 8, username = jbloggs) was updated'),
	(283, '2026-05-14 18:15:09', 'Member(id = 8, username = jbloggs)', 'logout', 'Member(id = 8, username = jbloggs) logged out'),
	(284, '2026-05-14 18:15:15', 'Member(id = 15, username = mcheah)', 'login', 'Member(id = 15, username = mcheah) logged in'),
	(285, '2026-05-14 18:15:25', 'Member(id = 15, username = mcheah)', 'update', 'Member(id = 15, username = mcheah) was updated');

-- Dumping structure for table spxcinemasdb.bookings
CREATE TABLE IF NOT EXISTS `bookings` (
  `bookingId` int NOT NULL AUTO_INCREMENT,
  `sessionId` int NOT NULL DEFAULT '0',
  `memberId` int NOT NULL,
  `seats` int NOT NULL DEFAULT '0',
  `pricePerSeat` decimal(6,2) NOT NULL,
  PRIMARY KEY (`bookingId`),
  KEY `FK_bookings_members` (`memberId`),
  KEY `FK_bookings_sessions` (`sessionId`),
  CONSTRAINT `FK_bookings_members` FOREIGN KEY (`memberId`) REFERENCES `members` (`memberId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_bookings_sessions` FOREIGN KEY (`sessionId`) REFERENCES `sessions` (`sessionId`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table spxcinemasdb.bookings: ~0 rows (approximately)
INSERT INTO `bookings` (`bookingId`, `sessionId`, `memberId`, `seats`, `pricePerSeat`) VALUES
	(30, 25, 8, 2, 30.00);

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

-- Dumping structure for table spxcinemasdb.members
CREATE TABLE IF NOT EXISTS `members` (
  `memberId` int NOT NULL AUTO_INCREMENT,
  `username` varchar(511) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(511) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('User','Administrator') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'User',
  `firstName` varchar(511) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastName` varchar(511) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `street` varchar(511) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `town` varchar(511) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `postcode` varchar(511) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(511) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(511) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`memberId`),
  UNIQUE KEY `userName` (`username`(255)) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table spxcinemasdb.members: ~3 rows (approximately)
INSERT INTO `members` (`memberId`, `username`, `password`, `role`, `firstName`, `lastName`, `street`, `town`, `postcode`, `phone`, `email`) VALUES
	(8, 'jbloggs', '$2y$12$sS3Njmlm.Vn5QvqB/HsCbe1RedWloJkWIFqbD/Xb22P52nZO/7RGe', 'User', 'Sd8D3ytGUFp7DG1GXrF8dkxNTmlqWEJocjQ4cTRNLzI0QldTeHc9PQ==', 'ij3WsqxWwTYE0nxcm+f6ZStYMDJZV0lmaHEwUm56VFp6K2k3amc9PQ==', 'qqCoaPzXnaKdrlucFSDRYlYwM3RSV1V5VTY3UXkzMGZOZWwrZHIwaFhkeVE2U1NzakpvQ0ViSUdEVG96NXhhMFJvL2NvNlN3RW5wNkdqYTZFSzU5UDdUa0laQmFpTWRuSERSVnF3aW1HMUlmUUdaT3JnOVNrWGJtanhJd2RzejhyeTJ0RHpEM2cxYXVTbDNQ', 'Caped2q7LFfyNlCIyRYeEFBZOEk3aGFvbEhHaXJzZXVIVHNRRTlsR0dBblF0b3hhK0RzcG9oZDRGRkZudE5ZNkRGVm9xeTRhczhpTTZRQXcvOWNNSDdDWGhqaTFLeDUySFBOVTIxYVVOak1Ybjk3K005VTRKNElYZXJBPQ==', '', 'xJ0WxEI+6hWAK6Xa4U40TDFvL2lOTEtma3hOcU9CU1J6K05lelE9PQ==', 'NqxWkh/0q91rRsDCD6r7EkVxazRhdjNHS2VOYXFkVklDditXWFNHbXhuUmgwTTFxeDJBN1dySnRVN0E9'),
	(14, 'hello', '$2y$12$nRw2.FRaYuT3W/X8fUwP7uSDOEZ4ses7z.gp/cCqM0/Zg8fneY5Nq', 'User', 'XHD/+vCmfYD6u+j9qIUYInFpVTdOdjVTOFBsNXp2V1JtcmhxNkE9PQ==', 'oCr+O6+JSnuB2jHXF/UHbncrYXpBSGxJL2VQUFBtSWJ3TXNHT1E9PQ==', '', '', '', '', ''),
	(15, 'mcheah', '$2y$12$gl1wguuOylAZ5dcS3k3InuvjGpnt9wwBLoqDtK4JlJ0rWkdLPDh4G', 'User', 'K58k7/NM4wP8egafaNGsZE9FYlExakNwb0lGM2ZmUlJ6NzJBaHc9PQ==', 'NPkwfFt2wz6MPxcycKsKEnBadFdyOGFiVlR4a2o3TjZQTlp4M2c9PQ==', '', '', '', '', ''),
	(17, 'XSS tester', '$2y$12$oAEMfePV5TH61Da8ysKdNONPSmwEnHlMwoLtweuteWWU8u0Zw3Xe.', 'User', 'zDuB1FqONSnE6iD3bq2be1F4ZjRIbXJFKzZYb3FaaDNtTkdjbVZwbk1qQnU2WEd1TzVRZzVXb2gxUE05bXRWaDlxMENxa1dwWWtkb01CeG1pdjZ6OXh0eitpVHpCN3puODRpQW1hTTF5Ny9XeHoyZ1UvRkttSUJjcE40PQ==', 'kOTPyRYiWDr8UvX+wdu3izQ0SjBUVmx6L05ocy9MOUsvbXYrZ1E9PQ==', '', '', '', '', '');

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

-- Dumping structure for table spxcinemasdb.orderitems
CREATE TABLE IF NOT EXISTS `orderitems` (
  `orderItemId` int NOT NULL AUTO_INCREMENT,
  `orderId` int DEFAULT NULL,
  `sessionId` int NOT NULL,
  `seats` int NOT NULL,
  `pricePerSeat` decimal(6,2) NOT NULL,
  PRIMARY KEY (`orderItemId`) USING BTREE,
  KEY `FK_orderitems_sessions` (`sessionId`),
  KEY `FK_orderitems_orders` (`orderId`),
  CONSTRAINT `FK_orderitems_orders` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_orderitems_sessions` FOREIGN KEY (`sessionId`) REFERENCES `sessions` (`sessionId`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table spxcinemasdb.orderitems: ~2 rows (approximately)
INSERT INTO `orderitems` (`orderItemId`, `orderId`, `sessionId`, `seats`, `pricePerSeat`) VALUES
	(12, 15, 23, 3, 35.00),
	(13, 16, 20, 2, 30.00),
	(14, 16, 44, 1, 35.00),
	(15, 17, 27, 2, 20.00);

-- Dumping structure for table spxcinemasdb.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `orderId` int NOT NULL AUTO_INCREMENT,
  `memberId` int DEFAULT NULL,
  `orderDate` datetime DEFAULT NULL,
  PRIMARY KEY (`orderId`),
  KEY `FK_orders_members` (`memberId`),
  CONSTRAINT `FK_orders_members` FOREIGN KEY (`memberId`) REFERENCES `members` (`memberId`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table spxcinemasdb.orders: ~2 rows (approximately)
INSERT INTO `orders` (`orderId`, `memberId`, `orderDate`) VALUES
	(15, 8, '2026-05-09 09:03:59'),
	(16, 15, '2026-05-09 09:14:32'),
	(17, 15, '2026-05-12 02:43:32');

-- Dumping structure for table spxcinemasdb.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `sessionId` int NOT NULL AUTO_INCREMENT,
  `sessionTime` time NOT NULL,
  `sessionCost` decimal(6,2) NOT NULL DEFAULT '0.00',
  `cinemaId` int NOT NULL DEFAULT '0',
  `movieId` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`sessionId`),
  KEY `FK_sessions_cinemas` (`cinemaId`),
  KEY `FK_sessions_members` (`movieId`),
  CONSTRAINT `FK_sessions_cinemas` FOREIGN KEY (`cinemaId`) REFERENCES `cinemas` (`cinemaId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_sessions_members` FOREIGN KEY (`movieId`) REFERENCES `movies` (`movieId`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table spxcinemasdb.sessions: ~36 rows (approximately)
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
