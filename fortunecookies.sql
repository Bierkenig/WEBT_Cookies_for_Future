-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Jun 2022 um 19:47
-- Server-Version: 10.4.24-MariaDB
-- PHP-Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `fortunecookies`
--

DROP DATABASE IF EXISTS fortunecookies;
CREATE DATABASE IF NOT EXISTS fortunecookies;
USE fortunecookies;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `access_records`
--

CREATE TABLE `access_records` (
  `pk_entry_id` int(11) NOT NULL,
  `timestamp` datetime DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `quote`
--

CREATE TABLE `quote` (
  `pk_quote_id` int(11) NOT NULL,
  `text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `quote`
--

INSERT INTO `quote` (`pk_quote_id`, `text`) VALUES
(1, 'The early bird gets the worm, but the second mouse gets the cheese.'),
(2, 'Be on the alert to recognize your prime at whatever time of your life it may occur.'),
(3, 'Your road to glory will be rocky, but fulfilling.'),
(4, 'Courage is not simply one of the virtues, but the form of every virtue at the testing point.'),
(5, 'Patience is your alley at the moment. Don’t worry!'),
(6, 'Nothing is impossible to a willing heart.'),
(7, 'Don’t worry about money. The best things in life are free.'),
(8, 'Don’t pursue happiness – create it.'),
(9, 'Courage is not the absence of fear; it is the conquest of it.'),
(10, 'Nothing is so much to be feared as fear.'),
(11, 'All things are difficult before they are easy.'),
(12, 'The real kindness comes from within you.'),
(13, 'A ship in harbor is safe, but that’s not why ships are built.'),
(14, 'You don’t need strength to let go of something. What you really need is understanding.'),
(15, 'If you want the rainbow, you have to tolerate the rain.'),
(16, 'Fear is interest paid on a debt you may not owe.'),
(17, 'Hardly anyone knows how much is gained by ignoring the future.'),
(18, 'The wise man is the one that makes you think that he is dumb.'),
(19, 'The usefulness of a cup is in its emptiness.'),
(20, 'He who throws mud loses ground.'),
(21, 'Success lies in the hands of those who wants it.'),
(22, 'To avoid criticism, do nothing, say nothing, be nothing.'),
(23, 'One that would have the fruit must climb the tree.'),
(24, 'It takes less time to do a thing right than it does to explain why you did it wrong.'),
(25, 'Big journeys begin with a single step.'),
(26, 'Of all our human resources, the most precious is the desire to improve.'),
(27, 'Do the thing you fear and the death of fear is certain.'),
(28, 'You never show your vulnerability, you are always self assured and confident.'),
(29, 'People learn little from success, but much from failure.'),
(30, 'Be not afraid of growing slowly, be afraid only of standing still.'),
(31, 'We must always have old memories and young hopes.'),
(32, 'A person who won’t read has no advantage over a person who can’t read.'),
(33, 'He who expects no gratitude shall never be disappointed.'),
(34, 'I hear and I forget. I see and I remember. I do and I understand.'),
(35, 'The best way to get rid of an enemy is to make a friend.'),
(36, 'It’s amazing how much good you can do if you don’t care who gets the credit.'),
(37, 'Never forget that a half truth is a whole lie.'),
(38, 'Happiness isn’t an outside job, it’s an inside job.'),
(39, 'If you do no run your subconscious mind yourself, someone else will.'),
(40, 'Yes by calling full, you created emptiness.');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `access_records`
--
ALTER TABLE `access_records`
  ADD PRIMARY KEY (`pk_entry_id`);

--
-- Indizes für die Tabelle `quote`
--
ALTER TABLE `quote`
  ADD PRIMARY KEY (`pk_quote_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `access_records`
--
ALTER TABLE `access_records`
  MODIFY `pk_entry_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `quote`
--
ALTER TABLE `quote`
  MODIFY `pk_quote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
