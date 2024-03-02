<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Start the session if not already started


// Include the database connection
include "../../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}

// Check if the news ID and status are provided via POST method
if (isset($_POST['news_id']) && isset($_POST['status'])) {
    // Sanitize the input
    $news_id = $_POST['news_id'];
    $status = $_POST['status'];

    // Prepare and execute the SQL statement to update the status of the news article
    $stmt = $conn->prepare("UPDATE news SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $news_id); // 's' for string, 'i' for integer
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        // Redirect back to the page where the news article was being viewed
        header("Location: show_news_admin.php?id=$news_id");
        exit(); // Stop further execution
    } else {
        echo "Failed to update the status of the news article.";
    }

    // Close the statement
    $stmt->close();
}

// If the news ID or status is not provided, redirect back to the homepage or display an error message
header("Location: show_news.php");
exit(); // Stop further execution
?>
