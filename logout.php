<?php
// Initialize the session
session_start();

// Include database connection
$host = 'localhost';
$dbname = 'laboratory_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions on errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection error
    echo "Error connecting to database: " . $e->getMessage();
    die(); // Exit script
}

// Update logout time in login_logs table
$logout_time = date("Y-m-d H:i:s");
$updateLogSql = "UPDATE login_logs SET logout_time = ? WHERE full_name = ? AND logout_time IS NULL";
$stmtUpdateLog = $pdo->prepare($updateLogSql);
$stmtUpdateLog->execute([$logout_time, $name]);

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: login.php");
exit;
?>

