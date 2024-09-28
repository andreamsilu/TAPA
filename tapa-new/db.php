<?php
// Database configuration
$host = "localhost";
$db_name = "TAPA_MOD";
$username = "msilu";
$password = "passw0rd";

// Create a connection
$conn = mysqli_connect($host, $username, $password, $db_name);

// Check the connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}