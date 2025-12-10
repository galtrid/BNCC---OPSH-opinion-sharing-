<?php

require_once 'models/User.php';
class AuthController {
    private $userModel;
    public function __construct($pdo) { $this->userModel = new User($pdo); }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->userModel->register($_POST['username'], $_POST['password'])) {
                header('Location: index.php?page=login');
            } else { echo "<p style='color:red; text-align:center;'>Username taken</p>"; }
        }
        require 'views/register.php';
    }

public function login() {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            echo "<p style='color:red; text-align:center;'>Username and password are required.</p>";
        } else {
            $userId = $this->userModel->login($_POST['username'], $_POST['password']); 

            if ($userId) {
                $_SESSION['user_id'] = $userId;
                header('Location: index.php?page=home');
                exit; 
            } else {
                echo "<p style='color:red; text-align:center;'>Login failed. Check your username and password.</p>";
            }
        }
    }
    require 'views/login.php';
}
    public function logout() { 
        session_destroy(); 
        header('Location: index.php?page=login'); 
        exit;}
}
?>
