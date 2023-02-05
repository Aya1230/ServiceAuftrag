CREATE DATABASE IF NOT EXISTS service;
USE service;

CREATE TABLE IF NOT EXISTS users (
                                     u_id INT PRIMARY KEY AUTO_INCREMENT,
                                     anrede ENUM('Herr', 'Frau', 'Unbekannt') NOT NULL DEFAULT 'Unbekannt',
                                     name VARCHAR(25) NOT NULL UNIQUE,
                                     pw VARCHAR(128) NOT NULL,
                                     tel VARCHAR(20) NOT NULL,
                                     phone VARCHAR(20) NOT NULL,
                                     adresse VARCHAR(40) NOT NULL,
                                     plz SMALLINT NOT NULL,
                                     ort VARCHAR(40) NOT NULL,
                                     berechtigungen ENUM('Mitarbeiter', 'Bereichsleiter', 'Administator') NOT NULL DEFAULT 'Mitarbeiter'
);

INSERT INTO users (anrede, name, pw, tel, phone, adresse, plz, ort, berechtigungen)
VALUE ('Unbekannt', 'root', '99adc231b045331e514a516b4b7680f588e3823213abe901738bc3ad67b2f6fcb3c64efb93d18002588d3ccc1a49efbae1ce20cb43df36b38651f11fa75678e8', '123123', '123123', 'Strasse 123', 1234, 'Ort','Administator')
;

CREATE TABLE IF NOT EXISTS kunde (
                                     k_id INT PRIMARY KEY AUTO_INCREMENT,
                                     anrede ENUM('Herr', 'Frau', 'Unbekannt') NOT NULL DEFAULT 'Unbekannt',
                                     name VARCHAR(25) NOT NULL,
                                     tel VARCHAR(20) NOT NULL,
                                     phone VARCHAR(20) NOT NULL,
                                     adresse VARCHAR(40) NOT NULL,
                                     plz SMALLINT NOT NULL,
                                     ort VARCHAR(40) NOT NULL
);


CREATE TABLE IF NOT EXISTS tags (
                                    tag_nr INT PRIMARY KEY AUTO_INCREMENT,
                                    tag VARCHAR(25)
);

INSERT INTO tags (tag) VALUES
('Reperatur'),
('Sanitär'),
('Garantie'),
('Heizung')
;


CREATE TABLE IF NOT EXISTS state (
                                     s_nr INT PRIMARY KEY AUTO_INCREMENT,
                                     state VARCHAR(25)
);

INSERT INTO state (state) VALUES
('Backlog'),
('WIP'),
('Done')
;


CREATE TABLE IF NOT EXISTS auftrag (
                                       auftr_nr INT PRIMARY KEY AUTO_INCREMENT,
                                       auftr_name  VARCHAR(25) NOT NULL,
                                       details VARCHAR(128),
                                       tag_nr INT,
                                       FOREIGN KEY (tag_nr) REFERENCES tags(tag_nr),
                                       s_nr INT DEFAULT 1,
                                       FOREIGN KEY (s_nr) REFERENCES state(s_nr),
                                       date DATETIME NOT NULL DEFAULT current_timestamp(),
                                       desired_date DATE,
                                       anrede ENUM('Herr', 'Frau', 'Unbekannt') NOT NULL DEFAULT 'Unbekannt',
                                       name VARCHAR(25) NOT NULL,
                                       adresse VARCHAR(40) NOT NULL,
                                       plz SMALLINT NOT NULL,
                                       ort VARCHAR(40) NOT NULL,
                                       u_id INT NOT NULL,
                                       k_id INT NOT NULL,
                                       FOREIGN KEY (u_id) REFERENCES  users(u_id),
                                       FOREIGN KEY (k_id) REFERENCES  kunde(k_id)
);


