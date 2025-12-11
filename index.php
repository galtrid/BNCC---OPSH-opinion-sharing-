<?php
session_start();
require_once 'install.php';
require_once 'config/db.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/TweetController.php';

if (!isset($pdo)) { die("Database not connected. <a href='install.php'>Click here to install DB</a>"); }


if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home';
}

$auth = new AuthController($pdo);
$tweet = new TweetController($pdo);

switch ($page) {
    case 'login': 
        $auth->login(); break;
    case 'register': 
        $auth->register(); break;
    case 'logout': 
        $auth->logout(); break;
    case 'like': 
        $tweet->handleLike(); break; 
    case 'home': 
        $tweet->index(); break;
    default: 
        $tweet->index(); break;
}
?>