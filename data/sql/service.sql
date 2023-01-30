CREATE DATABASE service;
USE service;

CREATE TABLE IF NOT EXISTS users (
    u_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(25) NOT NULL,
    name VARCHAR(25) DEFAULT NULL,
    pw VARCHAR(128) NOT NULL,
    tel DEC(15,0),
    adresse VARCHAR(25),
    plz DEC(6,0),
    ort VARCHAR(25),
    attempts BIT(3) DEFAULT NULL,
    disabled TINYINT(1) DEFAULT NULL,
    berechtigungen VARCHAR(25) NOT NULL
);

CREATE TABLE IF NOT EXISTS kunde (
    k_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(25) NOT NULL,
    tel DEC(15,0) NOT NULL,
    adresse VARCHAR(25) NOT NULL,
    plz DEC(6,0) NOT NULL,
    ort VARCHAR(25) NOT NULL
);

CREATE TABLE IF NOT EXISTS auftrag (
    auftr_nr INT PRIMARY KEY AUTO_INCREMENT,
    name  VARCHAR(25) NOT NULL,
    details VARCHAR(25),
    tags VARCHAR(25),
    date DATETIME NOT NULL DEFAULT current_timestamp(),
    state VARCHAR(25),
    terminwunsch DATETIME,
    start_date DATETIME NOT NULL DEFAULT current_timestamp(),
    end_date DATETIME,
    u_id INT,
    k_id INT,
    FOREIGN KEY (u_id) REFERENCES  users(u_id),
    FOREIGN KEY (k_id) REFERENCES  kunde(k_id)
);