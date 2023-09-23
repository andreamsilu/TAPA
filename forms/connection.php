<?php


// Establish a database connection (replace with your database details)
$servername = "localhost";
$username = "root";
$password = "j";
$dbname = "TAPA_DB";

$conn = new mysqli($servername, $username, $password, $dbname);
 echo "connection successifully";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
