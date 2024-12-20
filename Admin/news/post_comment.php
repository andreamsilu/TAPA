<?php
// Database connection
include "../../forms/connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $news_id = $_POST['news_id']; // Assuming you have a hidden input for news_id in your form
    $user_name = $_POST['user_name'];
    $comment_text = $_POST['comment'];

    // Prepare and execute SQL query to insert the comment
    $stmt = $conn->prepare("INSERT INTO comments (news_id, user_name, comment_text, comment_date) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("iss", $news_id, $user_name, $comment_text);

    if ($stmt->execute()) {
        // Comment inserted successfully
        header("Location: full_news.php?id=$news_id"); // Redirect back to the news details page
        exit();
    } else {
        // Error occurred while inserting the comment
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
