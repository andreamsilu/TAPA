<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Collect form data
        // Sanitize input fields
        $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
        if (!preg_match("/^[a-zA-Z ]+$/", $fullname)) {
            throw new Exception("Invalid full name. Only alphabetic characters and spaces are allowed.");
        }

        // Sanitize and validate email
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        // Check if the email is already registered
        $stmt_check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt_check_email->bind_param("s", $email);
        $stmt_check_email->execute();
        $stmt_check_email->store_result();
        if ($stmt_check_email->num_rows > 0) {
            throw new Exception("Email already registered. Please use a different email.");
        }
        $stmt_check_email->close();

        // Continue with other input sanitization
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
        $postal_address = filter_input(INPUT_POST, 'postal_address', FILTER_SANITIZE_STRING);
        $birth_date = filter_input(INPUT_POST, 'birth_date', FILTER_SANITIZE_STRING);
        $physical_address = filter_input(INPUT_POST, 'physical_address', FILTER_SANITIZE_STRING);
        $membership_type = filter_input(INPUT_POST, 'membership_type', FILTER_SANITIZE_STRING);
        $licensure = filter_input(INPUT_POST, 'licensure', FILTER_SANITIZE_STRING);
        $yes_licensure = filter_input(INPUT_POST, 'yes_licensure', FILTER_SANITIZE_STRING);
        $crime = filter_input(INPUT_POST, 'crime', FILTER_SANITIZE_STRING);
        $yes_crime = filter_input(INPUT_POST, 'yes_crime', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        // Generate a unique token for email confirmation
        $token = bin2hex(random_bytes(16)); // Generates a 32-character hexadecimal string

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Database connection parameters
        include "../forms/connection.php";

        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO users(fullname, email, phone, postal_address, birth_date, physical_address, membership_type, licensure, yes_licensure, crime, yes_crime, password, token) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind parameters to the placeholders
        $stmt->bind_param("sssssssssssss", $fullname, $email, $phone, $postal_address, $birth_date, $physical_address, $membership_type, $licensure, $yes_licensure, $crime, $yes_crime, $hashedPassword, $token);

        // Execute the statement
        if ($stmt->execute()) {
            // Registration successful, send confirmation email
            $subject = 'Confirm Your Registration';
            $message = "Dear $fullname,\nThank you for registering with TAPA. Your application has been received, and our team will get back to you after the application is processed and after payment of the fee. Your membership account will be activated only after paying the Registration and Annual Fees.\n\nApplication fees for all categories is 10,000 Tshs.\nAnnual Fees is as follows:\n\ni. Full Member: 50,000 Tshs per annum\nii. Associate Member I: 20,000 Tshs per annum\niii. Associate Member II: 20,000 Tshs per annum\niv. Student Member: 10,000 Tshs per annum\nv. Affiliates: 30,000 Tshs per annum\nvi. Foreign Affiliates: 50,000 Tshs per annum\n\nFor example, if you have a bachelor’s degree in psychology, you qualify to become a Full Member. You would then deposit your annual fee of 50,000 Tshs plus the 10,000 Tshs one-time application fee. The total amount to deposit would be 60,000 TShs.\n\nAfter payment upload proof of payment (receipt) here( https://tapa.or.tz/pay_annual_fees.php).\n\nFor any inquiries, please email admin@tapa.or.tz or Whatsapp +255 719911575.\n\nIf you did not register on our website, please ignore this message.\n\nRegards,\nAdministrative Assistant,\nTanzanian Psychological Association (TAPA)\n+255 719 911 575\n";
            $headers = "From: TAPA <msiluandrew2020@gmail.com>";

            if (mail($email, $subject, $message, $headers)) {
                // Redirect to success page
                header("Location: registration_success.php");
                exit();
            } else {
                throw new Exception("Failed to send confirmation email.");
            }
        } else {
            throw new Exception("Error: " . $sql . "<br>" . $conn->error);
        }

        // Close statement
        $stmt->close();

        // Close connection
        $conn->close();
    } catch (Exception $e) {
        // Handle exceptions, log errors, or display error messages
        echo "An error occurred: " . $e->getMessage();
    }
}
