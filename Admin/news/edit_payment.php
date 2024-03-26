<?php
session_start(); // Ensure session is started

// Database connection
include "../../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit();
}

// Fetch the ID of the current logged-in user from the session
$userId = $_SESSION['id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $status = $_POST['status'];
    $amount = $_POST['amount'];

    // Update payment data in the database using prepared statement
    $sql = "UPDATE payments SET status = ?, amount = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        // Handle error if prepare() fails
        echo "Error in preparing statement: " . $conn->error;
        exit();
    }

    // Bind parameters
    $stmt->bind_param("ssi", $status, $amount, $userId);

    // Execute the statement
    if ($stmt->execute()) {
        // Payment updated successfully
        header('Location: member_list.php');
        exit(); // Terminate script execution after redirect
    } else {
        // Error occurred while updating payment
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
