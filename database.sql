CREATE DATABASE IF NOT EXISTS avito3_tickets_manager;

USE avito3_tickets_manager;

CREATE TABLE users (
    userId INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(200),
    email VARCHAR(500),
    password VARCHAR(500),
    imagePath TEXT
);
CREATE TABLE tickets (
    ticketId INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    title VARCHAR(200),
    description VARCHAR(200),
    status VARCHAR(500),
    tagId VARCHAR(500),
    priorety VARCHAR(500),
    FOREIGN KEY (userId) REFERENCES users(userId)
);
CREATE TABLE tags (
    tagId INT AUTO_INCREMENT PRIMARY KEY,
    tag VARCHAR(100)
);
CREATE TABLE assignments (
    assignmentId INT AUTO_INCREMENT PRIMARY KEY,
    ticketId INT,
    userId INT
);
CREATE TABLE comments (
    commentId INT AUTO_INCREMENT PRIMARY KEY,
    comment TEXT,
    ticketId INT,
    userId INT
);
