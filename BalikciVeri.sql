CREATE DATABASE IF NOT EXISTS fish_db;
USE fish_db;

CREATE TABLE IF NOT EXISTS fish_catches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fisher_name VARCHAR(100) NOT NULL,
    fish_type VARCHAR(100) NOT NULL,
    caught_date DATETIME NOT NULL,
    sealed_date DATETIME NOT NULL,
    qr_code_url VARCHAR(255)
);
