<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// session_start();
// $member_id = $_SESSION['member_id'];


// Establish a database connection (replace with your database details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TAPA_DB";

$conn = new mysqli($servername, $username, $password, $dbname);
//  echo  "connection successifully";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
