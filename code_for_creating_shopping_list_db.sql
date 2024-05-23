-- Create the database
CREATE DATABASE IF NOT EXISTS shopping_lists_db;

-- Use the database
USE shopping_lists_db;

-- Create the 'lists' table
CREATE TABLE IF NOT EXISTS lists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Create the 'items' table
CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    list_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2),
    FOREIGN KEY (list_id) REFERENCES lists(id) ON DELETE CASCADE
);
