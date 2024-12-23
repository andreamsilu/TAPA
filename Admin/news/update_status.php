<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Start the session if not already started

// Include the database connection
include "db.php";

// Check if the user is authenticated
// if (!isset($_SESSION['email'])) {
//     header("Location: ../../login.php");
//     exit();
// }

if (isset($_POST['news_id']) && isset($_POST['status'])) {
    // Sanitize the input
    $news_id = $_POST['news_id'];
    $status = $_POST['status'];

    try {
        // Prepare and execute the SQL statement to update the status of the news article
        $stmt = $conn->prepare("UPDATE news SET status = :status WHERE id = :news_id");
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->bindParam(':news_id', $news_id, PDO::PARAM_INT);
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->rowCount() > 0) {
            // Redirect back to the page where the news article was being viewed
            header("Location: show_news_admin.php?id=$news_id");
            exit(); // Stop further execution
        } else {
            echo "<script>alert('Failed to update the status of the news article.'); window.location.href = 'show_news_admin.php';</script>";
        }
    } catch (PDOException $e) {
        echo "Error updating status: " . $e->getMessage();
    }
}

// If the news ID or status is not provided, redirect back to the homepage or display an error message
header("Location: news_details.php");
exit(); // Stop further execution
?>
