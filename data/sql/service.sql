CREATE DATABASE IF NOT EXISTS service;
USE service;

CREATE TABLE IF NOT EXISTS berechtigungen (
    b_id INT PRIMARY KEY AUTO_INCREMENT,
    berechtigung VARCHAR(25)
);

INSERT INTO berechtigungen (berechtigung)
VALUES ('Mitarbeiter')
;

INSERT INTO berechtigungen (berechtigung)
VALUES ('Bereichsleiter')
;

INSERT INTO berechtigungen (berechtigung)
VALUES ('Administator')
;


CREATE TABLE IF NOT EXISTS users (
    u_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(25) NOT NULL,
    pw VARCHAR(128) NOT NULL,
    tel VARCHAR(20),
    adresse VARCHAR(40),
    plz SMALLINT,
    ort VARCHAR(40),
    b_id INT NOT NULL DEFAULT 1,
    FOREIGN KEY (b_id) REFERENCES berechtigungen(b_id),
    attempts TINYINT DEFAULT NULL,
    disabled TINYINT DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS kunde (
    k_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(25) NOT NULL,
    tel VARCHAR(20) NOT NULL,
    adresse VARCHAR(40) NOT NULL,
    plz SMALLINT NOT NULL,
    ort VARCHAR(40) NOT NULL
);


CREATE TABLE IF NOT EXISTS tags (
    tag_nr INT PRIMARY KEY AUTO_INCREMENT,
    tag VARCHAR(25)
);

INSERT INTO tags (tag)
VALUES ('Leckreparatur')
;

INSERT INTO tags (tag)
VALUES ('Wasserspeicher')
;

INSERT INTO tags (tag)
VALUES ('Abwasserrohr')
;

INSERT INTO tags (tag)
VALUES ('Armaturreparatur')
;

INSERT INTO tags (tag)
VALUES ('Duschinstallation')
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


CREATE TABLE IF NOT EXISTS auftrag (
    auftr_nr INT PRIMARY KEY AUTO_INCREMENT,
    name  VARCHAR(25) NOT NULL,
    details VARCHAR(128),
    tag_nr INT,
    FOREIGN KEY (tag_nr) REFERENCES tags(tag_nr),
    s_nr INT DEFAULT 1,
    FOREIGN KEY (s_nr) REFERENCES state(s_nr),
    desired_date DATETIME,
    start_date DATETIME NOT NULL DEFAULT current_timestamp(),
    end_date DATETIME,
    costs DECIMAL(10, 2) DEFAULT 50,
    u_id INT,
    k_id INT,
    FOREIGN KEY (u_id) REFERENCES  users(u_id),
    FOREIGN KEY (k_id) REFERENCES  kunde(k_id)
);
