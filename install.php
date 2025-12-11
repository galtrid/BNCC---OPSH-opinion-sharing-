<?php
$host = 'localhost';
$username = 'root';
$password = '';

$pdo = new PDO("mysql:host=$host", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// made the database
$pdo->exec("CREATE DATABASE IF NOT EXISTS OPSH");
$pdo->exec("USE opsh");

// Create users table
$pdo->exec("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)");

// Create tweets table
$pdo->exec("CREATE TABLE IF NOT EXISTS tweets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    tweet VARCHAR(280) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
)");

// create likes table
$pdo->exec("CREATE TABLE IF NOT EXISTS likes (
    user_id INT,
    tweet_id INT,  
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (tweet_id) REFERENCES tweets(id) ON DELETE CASCADE,
    PRIMARY KEY (user_id, tweet_id)
)");

// Check if users exist
$countUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

if ($countUsers == 0) {
    // Initial users
    $pdo->exec("
        INSERT INTO users (username, password) VALUES
        ('alice', 'test'),
        ('bob', 'test'),
        ('charlie', 'test')
    ");
}

// check if tweets exist
$countTweets = $pdo->query("SELECT COUNT(*) FROM tweets")->fetchColumn();

if ($countTweets == 0) {
    // Initial tweets
    $pdo->exec("
        INSERT INTO tweets (user_id, tweet) VALUES
        (1, 'Hello! This is my first tweet.'),
        (2, 'Today I learned PHP and MySQL!'),
        (3, 'This project is fun!'),
        (1, 'Working on OPSH right now.'),
        (2, 'BNCC OPSH competition let’s go!')
    ");
}
