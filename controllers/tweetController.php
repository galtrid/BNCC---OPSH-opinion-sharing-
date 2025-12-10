<?php
require_once 'models/tweet.php';

class TweetController {
    private $tweetModel;

    public function __construct($pdo) {
        $this->tweetModel = new Tweet($pdo);
    }

    public function index() {
        if (!isset($_SESSION['user_id'])) {
            
            header('Location: warning.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tweet'])) {
            $content = $_POST['tweet'];
            $this->tweetModel->create($_SESSION['user_id'], $content);
        }

        $tweets = $this->tweetModel->getAll($_SESSION['user_id']);
        require 'views/home.php';
    }
    

    public function handleLike() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tweet_id'])) {
            $tweetId = $_POST['tweet_id'];
            $userId = $_SESSION['user_id'];
            
            $this->tweetModel->toggleLike($userId, $tweetId);
        
            header('Location: index.php?page=home');
            exit;
        }

        header('Location: index.php?page=home');
    }
}
?>