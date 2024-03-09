<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Collect form data
        // Sanitize input fields
        $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
        $postal_address = filter_input(INPUT_POST, 'postal_address', FILTER_SANITIZE_STRING);
        $birth_date = filter_input(INPUT_POST, 'birth_date', FILTER_SANITIZE_STRING);
        $physical_address = filter_input(INPUT_POST, 'pysical_address', FILTER_SANITIZE_STRING);
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

        // SQL query for insertion (modify table and column names accordingly)
        $sql = "INSERT INTO users(fullname, email, phone, postal_address, birth_date, physical_address, membership_type, licensure, yes_licensure, crime, yes_crime, password, token) 
        VALUES ('$fullname', '$email', '$phone', '$postal_address', '$birth_date', '$physical_address', '$membership_type', '$licensure', '$yes_licensure', '$crime', '$yes_crime', '$hashedPassword', '$token')";

        if ($conn->query($sql) === TRUE) {
            // Registration successful, send confirmation email
            $subject = 'Confirm Your Registration';
            $message = "Dear $fullname,\n\nThank you for registering with TAPA. Please click the following link to confirm your registration:\n\n";
            $message .= "https://tapa.or.tz/confirm.php?email=$email&token=$token\n\n";
            $message .= "If you did not register on our website, please ignore this message.\n\nBest regards,\nTAPA";
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

        // Close connection
        $conn->close();
    } catch (Exception $e) {
        // Handle exceptions, log errors, or display error messages
        echo "An error occurred: " . $e->getMessage();
    }
}

?>
