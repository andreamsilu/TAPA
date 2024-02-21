<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Uncommented session_start()

include "../../forms/connection.php";

if(isset($_GET['id'])) {
    $news_id = $_GET['id'];

    $sql = "DELETE FROM news WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $news_id);

    if ($stmt->execute()) {
        echo "News article deleted successfully";
        exit();
    } else {
        echo "Error deleting news article: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "No news ID provided.";
}
?>
