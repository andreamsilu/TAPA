<?php
// Database connection
include "navigation.php";
include "../../forms/connection.php";

// Check if 'id' parameter is provided in the URL
if(isset($_GET['id'])) {
    // Get the news ID from the URL
    $news_id = $_GET['id'];

    // Prepare a DELETE query to delete the news article by its ID
    $sql = "DELETE FROM news WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $news_id);

    if ($stmt->execute()) {
        // News article deleted successfully
        header("Location: read_news.php"); // Redirect to the page displaying all news articles
        exit();
    } else {
        echo "Error deleting news article: " . $conn->error;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "No news ID provided.";
}
?>
