-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 17. Apr 2016 um 09:54
-- Server-Version: 10.1.10-MariaDB
-- PHP-Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mensadb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bewertung`
--

CREATE TABLE `bewertung` (
  `bewertungID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `gerichtID` int(11) NOT NULL,
  `datum` date DEFAULT NULL,
  `wertung` int(11) DEFAULT NULL,
  `salzig` tinyint(1) DEFAULT NULL,
  `groesse` tinyint(1) DEFAULT NULL,
  `reserve` int(11) DEFAULT NULL,
  `kommentar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gericht`
--

CREATE TABLE `gericht` (
  `gerichtID` int(11) NOT NULL,
  `gericht_name` varchar(255) DEFAULT NULL,
  `preis_student` decimal(10,0) DEFAULT NULL,
  `datum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `gericht`
--

INSERT INTO `gericht` (`gerichtID`, `gericht_name`, `preis_student`, `datum`) VALUES
(1, 'Essen1', '3', '2008-02-20'),
(3, 'Spaghetti mit feurigem Tomaten- Mangoragout (3,A,I)', '2', '2016-04-11'),
(4, 'Indischer Reissalat mit Fleischbällchen und Currydressing (3,A,C,G,L)', '2', '2016-04-11'),
(5, 'Rahmgulasch vom Schwein mit Kartoffelpüree (3,A,C,G)', '3', '2016-04-11'),
(6, 'Penne  italienisch mit Champignon (A,C,G)', '2', '2017-04-16'),
(7, 'Mediterrane Gemüsepfanne mit Kicherebsen und Kartoffeln (3)', '3', '2016-04-12'),
(8, 'Nuß-Nudeln mit Apfelkompott (3,A,C,G,H)', '3', '2016-04-12'),
(9, 'Schweine Hütten Cordon Bleu (2,3,8,A,C,G,I) ', '3', '2016-04-12'),
(10, 'Fusili nach Art Puttanesca (3,6,A,C,G)', '2', '2016-04-13'),
(11, 'Mozzarella mit Tomaten und Basilikum (1,3,5,16,G)', '3', '2016-04-13'),
(12, 'Paprikarahmschnitzel (2,3,A,G,I) mit Reis', '4', '2016-04-13'),
(13, 'Tilapiafilet an Kokosgemüse und Bio Basmatireis (3,A,D,I)', '4', '2016-04-13'),
(14, 'XXL Matterhorn Burger (1,2,3,A,C,G,I)', '6', '2016-04-13'),
(15, 'Kaaslaibchen auf Blattspinat (3,G,I)', '2', '2016-04-14'),
(16, 'Putenschnitzel paniert (A,C)', '3', '2016-04-14'),
(17, 'Feuertopf vom Rind mit Reis (A,F)', '4', '2016-04-14'),
(18, 'Quarktaler mit Zwetschgen (A,G)', '2', '2016-04-15'),
(19, 'Riesenrösti mit Gemüsepfanne und Schnittlauchdip (3,A,C,G)', '2', '2016-04-15'),
(20, 'Lachsfilet auf Melonenragout und Süßkartoffeln (D)', '6', '2016-04-15'),
(21, 'Spaghetti Bolognese (3,16,A,C,G,I)', '3', '2016-04-17'),
(22, 'Rosmarinkartoffel mit gebr. Gemuese u. Dip (6,8,F)', '3', '2016-04-17'),
(23, 'Rindergeschnetzeltes. mit Reis (A,G,I)', '4', '2016-04-17');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `student`
--

CREATE TABLE `student` (
  `userID` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `punkte` int(11) DEFAULT NULL,
  `letzteBewertung` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `student`
--

INSERT INTO `student` (`userID`, `email`, `punkte`, `letzteBewertung`) VALUES
(0, 'xaver.xelz@st.oth-regensburg.de', 0, NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bewertung`
--
ALTER TABLE `bewertung`
  ADD PRIMARY KEY (`bewertungID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `gerichtID` (`gerichtID`);

--
-- Indizes für die Tabelle `gericht`
--
ALTER TABLE `gericht`
  ADD PRIMARY KEY (`gerichtID`);

--
-- Indizes für die Tabelle `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bewertung`
--
ALTER TABLE `bewertung`
  MODIFY `bewertungID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `gericht`
--
ALTER TABLE `gericht`
  MODIFY `gerichtID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bewertung`
--
ALTER TABLE `bewertung`
  ADD CONSTRAINT `bewertung_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `student` (`userID`),
  ADD CONSTRAINT `bewertung_ibfk_2` FOREIGN KEY (`gerichtID`) REFERENCES `gericht` (`gerichtID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
