-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 01. Mrz 2019 um 15:52
-- Server-Version: 10.1.36-MariaDB
-- PHP-Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `forum`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `about`
--

CREATE TABLE `about` (
  `about_id` int(11) NOT NULL,
  `about_content` varchar(100) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `about`
--

INSERT INTO `about` (`about_id`, `about_content`, `fk_user_id`) VALUES
(1, 'About me', 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `account_status`
--

CREATE TABLE `account_status` (
  `status_id` int(11) NOT NULL,
  `description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `account_status`
--

INSERT INTO `account_status` (`status_id`, `description`) VALUES
(1, 'Ok'),
(2, 'Deleted');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `answer`
--

CREATE TABLE `answer` (
  `answer_id` int(11) NOT NULL,
  `fk_question_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `answer_from` varchar(30) DEFAULT NULL,
  `answer_content` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `answer`
--

INSERT INTO `answer` (`answer_id`, `fk_question_id`, `fk_user_id`, `answer_from`, `answer_content`, `created_at`) VALUES
(1, 4, 2, 'davidPHp', 'Mit einem Gehirn', '2019-03-01 12:43:44'),
(2, 4, 4, 'phpB', 'Mit Tutorials', '2019-03-01 12:44:36'),
(3, 1, 4, 'phpB', 'Mit TUtorials!', '2019-03-01 12:56:04'),
(4, 1, 4, 'phpB', 'Okay', '2019-03-01 12:58:21'),
(5, 1, 4, 'phpB', 'GAR NICHT\r\n', '2019-03-01 12:58:42'),
(6, 4, 4, 'phpB', 'Internet : Youtube, Udemy.com', '2019-03-01 13:52:54'),
(7, 2, 5, 'dp', 'sudo apt-get install mysql-server', '2019-03-01 14:38:49'),
(8, 2, 5, 'dp', 'Edit: mysql_secure_installation danach die schritte befolgen  (mit y | n)', '2019-03-01 14:39:24'),
(9, 4, 5, 'dp', 'BÃ¼cher?', '2019-03-01 14:59:25');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(30) DEFAULT NULL,
  `cat_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`, `cat_description`) VALUES
(1, 'Programmierung', 'Selbsterklärend'),
(2, 'Betriebssysteme', 'Windows, Linux, MacOS');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `forum_user`
--

CREATE TABLE `forum_user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `profile_pic` varchar(50) NOT NULL,
  `fk_account_status_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `forum_user`
--

INSERT INTO `forum_user` (`user_id`, `email`, `username`, `user_password`, `created_at`, `updated_at`, `profile_pic`, `fk_account_status_id`) VALUES
(1, 'david.peric@kauz.ch', 'david', 'a917d01789b58dfd3a702c715496269886f5d363d7445f42ee7b963e9de2a1da7dfbf0b88248ca648e69927353c0a76aaccd1d9b2ef1e32a7fe18ca3710f8929', '2019-02-28 14:28:13', '2019-02-28 14:28:13', 'cms_db.PNG', 2),
(2, 'david_blitz@protonmail.ch', 'davidPHp', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', '2019-02-28 14:32:40', '2019-02-28 14:32:40', '', 1),
(3, 'david.peric@nanoboost-ow.ch', 'admin12', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '2019-02-28 14:34:21', '2019-02-28 14:34:21', '', 1),
(4, 'david@nanoboost-ow.ch', 'phpB', 'a917d01789b58dfd3a702c715496269886f5d363d7445f42ee7b963e9de2a1da7dfbf0b88248ca648e69927353c0a76aaccd1d9b2ef1e32a7fe18ca3710f8929', '2019-03-01 10:55:20', '2019-03-01 10:55:20', '', 1),
(5, 'd@info.ch', 'dp', 'a917d01789b58dfd3a702c715496269886f5d363d7445f42ee7b963e9de2a1da7dfbf0b88248ca648e69927353c0a76aaccd1d9b2ef1e32a7fe18ca3710f8929', '2019-03-01 14:32:45', '2019-03-01 14:32:45', '', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_title` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_title`) VALUES
(1, 'Profil'),
(2, 'Fragen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `fk_cat_id` int(11) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `fk_status_id` int(11) DEFAULT NULL,
  `question_from` varchar(30) DEFAULT NULL,
  `question_content` varchar(250) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `views` int(11) NOT NULL,
  `question_title` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `question`
--

INSERT INTO `question` (`question_id`, `fk_cat_id`, `fk_user_id`, `fk_status_id`, `question_from`, `question_content`, `created_at`, `views`, `question_title`) VALUES
(1, 1, 2, 1, 'davidPHp', 'Wie lerne ich Java am schnellsten? Lg David', '2019-03-01 10:54:22', 0, NULL),
(2, 2, 4, 1, 'phpB', 'Linux (Ubuntu) LAMP installation? Lg phpB', '2019-03-01 10:56:03', 0, NULL),
(3, 2, 4, 1, 'phpB', 'Wie genau installiert man MySQL auf Ubuntu? MIt Konfiguratione tc.', '2019-03-01 11:18:12', 0, 'MySQL auf Ubuntu?'),
(4, 1, 2, 1, 'davidPHp', 'Wie kann man php am schnellsten lernen?', '2019-03-01 11:27:36', 0, 'PHp lernen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `question_status`
--

CREATE TABLE `question_status` (
  `status_id` int(11) NOT NULL,
  `description` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `question_status`
--

INSERT INTO `question_status` (`status_id`, `description`) VALUES
(1, 'Unbeantwortet'),
(2, 'Geschlossen');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `submenu`
--

CREATE TABLE `submenu` (
  `submenu_id` int(11) NOT NULL,
  `submenu_title` varchar(30) DEFAULT NULL,
  `link` varchar(30) DEFAULT NULL,
  `fk_parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `submenu`
--

INSERT INTO `submenu` (`submenu_id`, `submenu_title`, `link`, `fk_parent_id`) VALUES
(1, 'Details', 'account_details.php', 1),
(2, 'Meine Fragen', 'my_questions.php', 2),
(3, 'Details aktualisieren', 'change_details.php', 1),
(4, 'Frage stellen', 'create_question.php', 2);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`about_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indizes für die Tabelle `account_status`
--
ALTER TABLE `account_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indizes für die Tabelle `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `fk_question_id` (`fk_question_id`),
  ADD KEY `fk_user_id` (`fk_user_id`);

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indizes für die Tabelle `forum_user`
--
ALTER TABLE `forum_user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_account_status_id` (`fk_account_status_id`);

--
-- Indizes für die Tabelle `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indizes für die Tabelle `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `fk_cat_id` (`fk_cat_id`),
  ADD KEY `fk_user_id` (`fk_user_id`),
  ADD KEY `fk_status_id` (`fk_status_id`);

--
-- Indizes für die Tabelle `question_status`
--
ALTER TABLE `question_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indizes für die Tabelle `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`submenu_id`),
  ADD KEY `fk_parent_id` (`fk_parent_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `about`
--
ALTER TABLE `about`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `account_status`
--
ALTER TABLE `account_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `answer`
--
ALTER TABLE `answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `forum_user`
--
ALTER TABLE `forum_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT für Tabelle `question_status`
--
ALTER TABLE `question_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `submenu`
--
ALTER TABLE `submenu`
  MODIFY `submenu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `about`
--
ALTER TABLE `about`
  ADD CONSTRAINT `about_ibfk_1` FOREIGN KEY (`fk_user_id`) REFERENCES `forum_user` (`user_id`);

--
-- Constraints der Tabelle `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_ibfk_1` FOREIGN KEY (`fk_question_id`) REFERENCES `question` (`question_id`),
  ADD CONSTRAINT `answer_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `forum_user` (`user_id`);

--
-- Constraints der Tabelle `forum_user`
--
ALTER TABLE `forum_user`
  ADD CONSTRAINT `forum_user_ibfk_1` FOREIGN KEY (`fk_account_status_id`) REFERENCES `account_status` (`status_id`);

--
-- Constraints der Tabelle `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`fk_cat_id`) REFERENCES `category` (`cat_id`),
  ADD CONSTRAINT `question_ibfk_2` FOREIGN KEY (`fk_user_id`) REFERENCES `forum_user` (`user_id`),
  ADD CONSTRAINT `question_ibfk_3` FOREIGN KEY (`fk_status_id`) REFERENCES `question_status` (`status_id`);

--
-- Constraints der Tabelle `submenu`
--
ALTER TABLE `submenu`
  ADD CONSTRAINT `submenu_ibfk_1` FOREIGN KEY (`fk_parent_id`) REFERENCES `menu` (`menu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
