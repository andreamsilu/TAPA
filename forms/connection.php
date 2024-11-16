<?php
 ;

// Load environment variables from the .env file
// require_once __DIR__ . '../../vendor/autoload.php';
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();

// Access environment variables
// $servername = getenv('DB_HOST');
// $username = getenv('DB_USER');
// $password = getenv('DB_PASS');
// $dbname = getenv('DB_NAME');

$servername ='localhost';
$username = 'u976524705_tapaortz';
$password = 'Tapaortz@2024';
$dbname = 'u976524705_TAPA_DB';

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed. Please try again later.");
}
?>