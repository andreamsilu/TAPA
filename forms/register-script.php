<?php
// Enable error reporting and display errors for debugging
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
        $physical_address = filter_input(INPUT_POST, 'physical_address', FILTER_SANITIZE_STRING);
        $membership_type = filter_input(INPUT_POST, 'membership_type', FILTER_SANITIZE_STRING);
        $licensure = filter_input(INPUT_POST, 'licensure', FILTER_SANITIZE_STRING);
        $yes_licensure = filter_input(INPUT_POST, 'yes_licensure', FILTER_SANITIZE_STRING);
        $crime = filter_input(INPUT_POST, 'crime', FILTER_SANITIZE_STRING);
        $yes_crime = filter_input(INPUT_POST, 'yes_crime', FILTER_SANITIZE_STRING);
        // Generate a unique token for email confirmation
        $token = bin2hex(random_bytes(16)); // Generates a 32-character hexadecimal string

        // Database connection parameters
        include "../forms/connection.php";

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO users (fullname, email, phone, postal_address, birth_date, physical_address, membership_type, licensure, yes_licensure, crime, yes_crime, token) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssss", $fullname, $email, $phone, $postal_address, $birth_date, $physical_address, $membership_type, $licensure, $yes_licensure, $crime, $yes_crime, $token);

        // Execute SQL statement
        if ($stmt->execute()) {
            // Registration successful, send confirmation email
            $subject = 'Confirm Your Registration';
            $message = "Dear $fullname,\n\nThank you for registering with TAPA. Your application has been received, and our team will get back to you after the application is processed and after payment of the fee. Your membership account will be activated only after paying the Registration and Annual Fees.\n\nApplication fees for all categories is 10,000 Tshs.\nAnnual Fees is as follows:\n\ni. Full Member: 50,000 Tshs per annum\nii. Associate Member I: 20,000 Tshs per annum\niii. Associate Member II: 20,000 Tshs per annum\niv. Student Member: 10,000 Tshs per annum\nv. Affiliates: 30,000 Tshs per annum\nvi. Foreign Affiliates: 50,000 Tshs per annum\n\nFor example, if you have a bachelor’s degree in psychology, you qualify to become a Full Member. You would then deposit your annual fee of 50,000 Tshs plus the 10,000 Tshs one-time application fee. The total amount to deposit would be 60,000 TShs.\n\nAfter payment upload proof of payment (receipt) [here](link ya upload receipt).\n\nFor any inquiries, please email admin@tapa.or.tz or Whatsapp +255 719911575.\n\nRegards,\nAdministrative Assistant,\nTanzanian Psychological Association (TAPA)\n+255 719911575";

            // Add hyperlink button to pay annual fees
            $message .= "\n\n<a href='https://tapa.or.tz/pay_annual_fees.php'>Pay Annual Fees</a>";

            $headers = "From: TAPA <msiluandrew2020@gmail.com>\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            if (mail($email, $subject, $message, $headers)) {
                // Redirect to success page
                header("Location: ../../../pay_annual_fees.php");
                exit();
            } else {
                throw new Exception("Failed to send confirmation email.");
            }
        } else {
            throw new Exception("Error executing SQL statement: " . $stmt->error);
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        // Handle exceptions, log errors, or display error messages
        echo "An error occurred: " . $e->getMessage();

        // Log error to a file
        error_log("Database error: " . $e->getMessage(), 0);
    }
}
?>
