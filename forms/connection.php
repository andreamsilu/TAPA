<?php
// db.php: Database connection
$host = 'localhost';
$dbname = 'u976524705_TAPA_DB_MOD';  
$username = 'u976524705_msilu';  
$password = 'Tapaortz@2025';  

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>