<?php
session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['user_name'])) {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
    exit(); // Make sure to exit after redirection
}
?>
