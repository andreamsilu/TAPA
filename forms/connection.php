<?php
// Database connection configuration
// Load environment variables from the .env file (commented out for now)
// require_once __DIR__ . '../../vendor/autoload.php';
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();

// Access environment variables (commented out for now)
// $servername = getenv('DB_HOST');
// $username = getenv('DB_USER');
// $password = getenv('DB_PASS');
// $dbname = getenv('DB_NAME');

// Database configuration
$servername = 'localhost';
$username = 'u976524705_tapaortz';
$password = 'Tapaortz@2024';
$dbname = 'u976524705_TAPA_DB';

// Create connection with error handling
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        error_log("Database connection failed: " . $conn->connect_error);
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }
    
    // Set charset to utf8mb4
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    error_log("Database connection error: " . $e->getMessage());
    // Don't die here, let the calling script handle the error
    $conn = null;
}
?>