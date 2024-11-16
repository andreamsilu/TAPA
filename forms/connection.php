<?php

// Enable error reporting for development
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Start session if needed
// session_start();
// $member_id = $_SESSION['member_id'];

// Load environment variables from the .env file
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Access environment variables
$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('DB_NAME');

// Establish a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Log the error instead of displaying it
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed. Please try again later.");
}

// echo "Connection successfully";

// Your code continues...

?>