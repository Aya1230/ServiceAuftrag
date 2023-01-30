SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `service`
--

CREATE DATABASE IF NOT EXISTS service;
USE service;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `auftrag`
--

CREATE TABLE `auftrag` (
  `auftr_nr` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `details` varchar(128) DEFAULT NULL,
  `tag_nr` int(11) DEFAULT NULL,
  `s_nr` int(11) DEFAULT 1,
  `desired_date` datetime DEFAULT NULL,
  `start_date` datetime NOT NULL DEFAULT current_timestamp(),
  `end_date` datetime DEFAULT NULL,
  `costs` decimal(10,2) DEFAULT 50.00,
  `u_id` int(11) DEFAULT NULL,
  `k_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `berechtigungen`
--

CREATE TABLE `berechtigungen` (
  `b_id` int(11) NOT NULL,
  `berechtigung` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `berechtigungen`
--

INSERT INTO `berechtigungen` (`b_id`, `berechtigung`) VALUES
(1, 'Mitarbeiter'),
(2, 'Bereichsleiter'),
(3, 'Administator');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunde`
--

CREATE TABLE `kunde` (
  `k_id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `adresse` varchar(40) NOT NULL,
  `plz` smallint(6) NOT NULL,
  `ort` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `state`
--

CREATE TABLE `state` (
  `s_nr` int(11) NOT NULL,
  `state` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `state`
--

INSERT INTO `state` (`s_nr`, `state`) VALUES
(1, 'Backlog'),
(2, 'WIP'),
(3, 'Done');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tags`
--

CREATE TABLE `tags` (
  `tag_nr` int(11) NOT NULL,
  `tag` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tags`
--

INSERT INTO `tags` (`tag_nr`, `tag`) VALUES
(1, 'Leckreparatur'),
(2, 'Wasserspeicher'),
(3, 'Abwasserrohr'),
(4, 'Armaturreparatur'),
(5, 'Duschinstallation');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `pw` varchar(128) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `adresse` varchar(40) DEFAULT NULL,
  `plz` smallint(6) DEFAULT NULL,
  `ort` varchar(40) DEFAULT NULL,
  `b_id` int(11) NOT NULL DEFAULT 1,
  `attempts` tinyint(4) DEFAULT NULL,
  `disabled` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `auftrag`
--
ALTER TABLE `auftrag`
  ADD PRIMARY KEY (`auftr_nr`),
  ADD KEY `tag_nr` (`tag_nr`),
  ADD KEY `s_nr` (`s_nr`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `k_id` (`k_id`);

--
-- Indizes für die Tabelle `berechtigungen`
--
ALTER TABLE `berechtigungen`
  ADD PRIMARY KEY (`b_id`);

--
-- Indizes für die Tabelle `kunde`
--
ALTER TABLE `kunde`
  ADD PRIMARY KEY (`k_id`);

--
-- Indizes für die Tabelle `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`s_nr`);

--
-- Indizes für die Tabelle `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_nr`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`),
  ADD KEY `b_id` (`b_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `auftrag`
--
ALTER TABLE `auftrag`
  MODIFY `auftr_nr` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `berechtigungen`
--
ALTER TABLE `berechtigungen`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `kunde`
--
ALTER TABLE `kunde`
  MODIFY `k_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `state`
--
ALTER TABLE `state`
  MODIFY `s_nr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_nr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `auftrag`
--
ALTER TABLE `auftrag`
  ADD CONSTRAINT `auftrag_ibfk_1` FOREIGN KEY (`tag_nr`) REFERENCES `tags` (`tag_nr`),
  ADD CONSTRAINT `auftrag_ibfk_2` FOREIGN KEY (`s_nr`) REFERENCES `state` (`s_nr`),
  ADD CONSTRAINT `auftrag_ibfk_3` FOREIGN KEY (`u_id`) REFERENCES `users` (`u_id`),
  ADD CONSTRAINT `auftrag_ibfk_4` FOREIGN KEY (`k_id`) REFERENCES `kunde` (`k_id`);

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`b_id`) REFERENCES `berechtigungen` (`b_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
