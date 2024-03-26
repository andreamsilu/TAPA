<?php
session_start(); // Uncommented session_start()

// Database connection
include "../../forms/connection.php";
// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}
$paymentEmail = $_SESSION['email'];
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    // $paymentId = $_POST['paymentId'];
    $paymentEmail = $_POST['email'];
    $status = $_POST['status'];
    $amount = $_POST['amount'];

    // Update payment data in the database
    $sql = "UPDATE payments SET status = ?, amount = ? WHERE email = $paymentEmail";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $status, $amount);

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
