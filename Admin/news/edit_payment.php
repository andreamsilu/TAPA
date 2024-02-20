<?php
// Database connection
include "../../forms/connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $paymentId = $_POST['paymentId'];
    $status = $_POST['status'];
    $amount = $_POST['amount'];

    // Update payment data in the database
    $sql = "UPDATE payments SET status = ?, amount = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $status, $amount, $paymentId);

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
