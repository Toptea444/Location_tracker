CREATE DATABASE location_tracker;

USE location_tracker;

CREATE TABLE ip_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ip_address VARCHAR(45) NOT NULL,
    country VARCHAR(100),
    region VARCHAR(100),
    city VARCHAR(100),
    latitude VARCHAR(50),
    longitude VARCHAR(50),
    isp VARCHAR(150),
    timezone VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
