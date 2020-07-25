<?php
session_start();
if(isset($_SESSION['login_user'])){
    unset($_SESSION['login_user']);
    header("Location: index.php"); // Redirecting To Home Page
}
