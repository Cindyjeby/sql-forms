CREATE DATABASE IF NOT EXISTS cbk;
USE cbk;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    national_id VARCHAR(20) NOT NULL UNIQUE,
    passport_no VARCHAR(20),
    kra_pin VARCHAR(20) NOT NULL,
    bank_name VARCHAR(50) NOT NULL,
    bank_account VARCHAR(30) NOT NULL,
    amount_usd DECIMAL(10,2) NOT NULL,
    account_status VARCHAR(20) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);