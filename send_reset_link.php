<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// Include database connection
include "forms/connection.php";

// Check if email is provided
if(isset($_POST['email'])) {
    $email = $_POST['email'];

    // Generate token (random string)
    $token = bin2hex(random_bytes(16)); // Generate 16 bytes (32 characters) random string

    // Insert token into database
    $stmt = $conn->prepare("INSERT INTO password_reset (email, token, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $stmt->close();

    // Send reset link via email
    $subject = "Password Reset";
    $resetLink = "reset_password.php?token=" . $token; // Change this URL to your actual reset password page
    $message = "Hello,\n\nPlease click on the following link to reset your password:\n\n$resetLink\n\nIf you didn't request this, you can ignore this email.";
    $headers = "From: your@example.com\r\n"; // Replace with your email address

    // Send email
    if (mail($email, $subject, $message, $headers)) {
        // Redirect user to a confirmation page
        header("Location: reset_link_sent.php");
        exit();
    } else {
        // Handle email sending failure
        echo "Error: Failed to send reset link email.";
    }
} else {
    // Handle case when email is not provided
    echo "Error: Email address not provided.";
}
?>
