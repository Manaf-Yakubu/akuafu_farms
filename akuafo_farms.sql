CREATE DATABASE IF NOT EXISTS akuafo_farms;

USE akuafo_farms;

CREATE TABLE subscriptions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    location VARCHAR(100) NOT NULL,
    preferred_produce VARCHAR(100) NOT NULL,
    frequency VARCHAR(50) NOT NULL,
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
