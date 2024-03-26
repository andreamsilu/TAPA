<?php
session_start(); // Uncommented session_start()

// Database connection
include "../../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $userId = $_POST['userId'];
    $status = $_POST['status'];
    $amount = $_POST['amount'];

    // Check if there are any unpaid payments for the user
    $unpaidPaymentSql = "SELECT COUNT(*) as unpaid_count FROM payments WHERE user_id = ? AND status = 'unpaid'";
    $stmt = $conn->prepare($unpaidPaymentSql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $unpaidCount = $result->fetch_assoc()['unpaid_count'];
    
    // If there are unpaid payments, update them
    if ($unpaidCount > 0) {
        $updatePaymentSql = "UPDATE payments SET status = ?, amount = ? WHERE user_id = ? AND status = 'unpaid'";
        $stmt = $conn->prepare($updatePaymentSql);
        $stmt->bind_param("ssi", $status, $amount, $userId);
        if ($stmt->execute()) {
            // Payment updated successfully
            echo "Payment updated successfully";
            header('Location: member_list.php');

        } else {
            // Error occurred while updating payment
            echo "Error: " . $conn->error;
        }
    } else {
        // If there are no unpaid payments, add a new payment
        $insertPaymentSql = "INSERT INTO payments (user_id, status, amount) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insertPaymentSql);
        $stmt->bind_param("iss", $userId, $status, $amount);
        if ($stmt->execute()) {
            // Payment added successfully
            echo "Payment added successfully";
            // header('Location: member_list.php');
        } else {
            // Error occurred while adding payment
            echo "Error: " . $conn->error;
        }
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>

