<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../connection.php");
session_start(); // Start the session if not already started.

try {
    // Check database connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    // Retrieve the member_id from the session
    if (!isset($_SESSION["member_id"])) {
        throw new Exception("Member ID not found in session.");
    }

      // Custom function for string sanitation and validation
      function sanitizeAndValidateString($input) {
        // Remove leading/trailing white spaces
        $sanitized_input = trim($input);

        // Prevent XSS attacks by escaping HTML entities
        $sanitized_input = htmlspecialchars($sanitized_input, ENT_QUOTES, 'UTF-8');

        // Additional custom validation, e.g., length check
        if (strlen($sanitized_input) < 2 || strlen($sanitized_input) > 255) {
            throw new Exception("Invalid input. Please check your data.");
        }

        return $sanitized_input;
    }
    
    $member_id = (int)$_SESSION["member_id"];

    // Sanitize and validate user input
    $fee_amount = (float)$_POST['paymentAmount'];
    $payment_date = sanitizeAndValidateString($_POST['paymentDate']);
    $due_date = sanitizeAndValidateString($_POST['dueDate']);
    $payment_method = sanitizeAndValidateString($_POST['paymentMethod']);
    $phoneNumber = sanitizeAndValidateString($_POST['phoneNumber']);
    $membership_type = sanitizeAndValidateString($_POST['membership_type']);

    // Check if any required fields are empty or invalid
    if (!$member_id || !$fee_amount || !$payment_date || !$due_date || !$payment_method || !$phoneNumber || !$membership_type) {
        throw new Exception("Invalid input. Please check your data.");
    }

    // Create a prepared statement
    $stmt = $conn->prepare("INSERT INTO membership_fees (member_id, fee_amount, payment_date, due_date, paymentMethod, phoneNumber, membership_type) VALUES (?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        throw new Exception("Prepared statement error: " . $conn->error);
    }

    // Bind parameters and their data types
    $stmt->bind_param("isddsss", $member_id, $fee_amount, $payment_date, $due_date, $payment_method, $phoneNumber, $membership_type);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Membership fee added successfully!";
        header("Location: ../profile.php");
    } else {
        throw new Exception("Error: " . $stmt->error);
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
?>
