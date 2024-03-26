<?php
session_start(); // Ensure session is started

// Database connection
include "../../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}

// Fetch the email of the current logged-in user from the session
$paymentEmail = $_SESSION['email'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $status = $_POST['status'];
    $amount = $_POST['amount'];

    // Update payment data in the database using prepared statement
    $sql = "UPDATE payments SET status = ?, amount = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sss", $status, $amount, $paymentEmail);

    // Execute the statement
    if ($stmt->execute()) {
        // Payment updated successfully
        header('Location: member_list.php');
        exit(); // Terminate script execution after redirect
    } else {
        // Error occurred while updating payment
        echo "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>
