-- Create the database
CREATE DATABASE IF NOT EXISTS cupo_db;

-- Use the database
USE cupo_db;

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

-- Create the 'products' table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2),
    category VARCHAR(255) NOT NULL,
    ingredients VARCHAR(255) NOT NULL,
    allergens VARCHAR(255) NOT NULL,
    vegetarian BIT(1),
    perishability VARCHAR(255) NOT NULL,
    region VARCHAR(255) NOT NULL,
    stores VARCHAR(255) NOT NULL,
    quantity VARCHAR(255) NOT NULL,
    brand VARCHAR(255) NOT NULL,
    originOfIngredients VARCHAR(255) NOT NULL,
    packaging VARCHAR(255) NOT NULL,
    NutriScore VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL
);

-- Create the 'users' table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    emailAdress VARCHAR(255) NOT NULL,
    phoneNumber VARCHAR(255) NOT NULL,
    vegetarian BIT(1),
    admin BIT(1)
);