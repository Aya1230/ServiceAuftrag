CREATE DATABASE IF NOT EXISTS service;
USE service;

CREATE TABLE IF NOT EXISTS users (
                                     u_id INT PRIMARY KEY AUTO_INCREMENT,
                                     anrede ENUM('Herr', 'Frau', 'Unbekannt') NOT NULL DEFAULT 'Unbekannt',
                                     username VARCHAR(25) NOT NULL UNIQUE,
                                     pw VARCHAR(128) NOT NULL,
                                     tel VARCHAR(20) NOT NULL,
                                     phone VARCHAR(20) NOT NULL,
                                     adresse VARCHAR(40) NOT NULL,
                                     plz SMALLINT NOT NULL,
                                     ort VARCHAR(40) NOT NULL,
                                     berechtigungen ENUM('Mitarbeiter', 'Bereichsleiter', 'Administator') NOT NULL DEFAULT 'Mitarbeiter',
                                     attempts TINYINT DEFAULT NULL,
                                     disabled TINYINT DEFAULT NULL
);

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

INSERT INTO tags (tag)
VALUES ('Reperatur')
;

INSERT INTO tags (tag)
VALUES ('Sanitär')
;

INSERT INTO tags (tag)
VALUES ('Garantie')
;

INSERT INTO tags (tag)
VALUES ('Heizung')
;



CREATE TABLE IF NOT EXISTS state (
                                     s_nr INT PRIMARY KEY AUTO_INCREMENT,
                                     state VARCHAR(25)
);

INSERT INTO state (state)
VALUES ('Backlog')
;

INSERT INTO state (state)
VALUES ('WIP')
;

INSERT INTO state (state)
VALUES ('Done')
;


CREATE TABLE IF NOT EXISTS verrechung (
                                          v_id INT PRIMARY KEY AUTO_INCREMENT,
                                          anrede ENUM('Herr', 'Frau', 'Unbekannt') NOT NULL DEFAULT 'Unbekannt',
                                          name VARCHAR(25) NOT NULL,
                                          tel VARCHAR(20) NOT NULL,
                                          phone VARCHAR(20) NOT NULL,
                                          adresse VARCHAR(40) NOT NULL,
                                          plz SMALLINT NOT NULL,
                                          ort VARCHAR(40) NOT NULL,
                                          status TINYINT DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS auftrag (
                                       auftr_nr INT PRIMARY KEY AUTO_INCREMENT,
                                       name  VARCHAR(25) NOT NULL,
                                       details VARCHAR(128),
                                       tag_nr INT,
                                       FOREIGN KEY (tag_nr) REFERENCES tags(tag_nr),
                                       s_nr INT DEFAULT 1,
                                       FOREIGN KEY (s_nr) REFERENCES state(s_nr),
                                       date DATETIME NOT NULL DEFAULT current_timestamp(),
                                       desired_date DATETIME,
                                       u_id INT,
                                       k_id INT NOT NULL,
                                       v_id INT NOT NULL,
                                       FOREIGN KEY (u_id) REFERENCES  users(u_id),
                                       FOREIGN KEY (k_id) REFERENCES  kunde(k_id),
                                       FOREIGN KEY (v_id) REFERENCES  verrechung(v_id)
);

