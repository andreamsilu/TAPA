<?php

error_reporting(E_ALL);
ini_set('display_errors', 0);
include "../forms/connection.php";

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
        function sanitize_input($input)
        {
            return trim(htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));
        }

        $phone = sanitize_input(filter_input(INPUT_POST, 'phone'));
        $postal_address = sanitize_input(filter_input(INPUT_POST, 'postal_address'));
        $birth_date = sanitize_input(filter_input(INPUT_POST, 'birth_date'));
        $physical_address = sanitize_input(filter_input(INPUT_POST, 'physical_address'));
        $membership_type = sanitize_input(filter_input(INPUT_POST, 'membership_type'));
        $licensure = sanitize_input(filter_input(INPUT_POST, 'licensure'));
        $yes_licensure = sanitize_input(filter_input(INPUT_POST, 'yes_licensure'));
        $crime = sanitize_input(filter_input(INPUT_POST, 'crime'));
        $yes_crime = sanitize_input(filter_input(INPUT_POST, 'yes_crime'));
        $password = sanitize_input(filter_input(INPUT_POST, 'password'));

        // Generate a unique token for email confirmation
        $token = bin2hex(random_bytes(16)); // Generates a 32-character hexadecimal string

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

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

            $message = <<<EMAIL
<html>
<head>
    <title>Confirm Your Registration</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6;color:white;padding: left 10px;padding: right 10px; }
        h2 { color: #333; }
        .fees-table { margin-top: 20px; }
        .fees-table th { text-align: left; padding-right: 10px; }
        a { color: #0056b3; text-decoration: none; }
        .footer { margin-top: 20px; font-size: 0.9em; color: #555; }
        p{color: #333;}
    </style>
</head>
<body>
    <h2>Confirm Your Registration</h2>
    <p>Dear $fullname,</p>
    <p>Thank you for registering with TAPA. Your application has been received, and our team will get back to you after the application is processed and after payment of the fee. Your membership account will be activated only after paying the Registration and Annual Fees.</p>
    <table class="fees-table">
        <tr><th>Membership Type</th><th>Annual Fee</th></tr>
        <tr><td>Full Member</td><td>50,000 Tshs</td></tr>
        <tr><td>Associate Member I</td><td>20,000 Tshs</td></tr>
        <tr><td>Associate Member II</td><td>20,000 Tshs</td></tr>
        <tr><td>Student Member</td><td>10,000 Tshs</td></tr>
        <tr><td>Affiliates</td><td>30,000 Tshs</td></tr>
        <tr><td>Foreign Affiliates</td><td>50,000 Tshs</td></tr>
    </table>
    <p>For example, if you have a bachelor’s degree in psychology, you qualify to become a Full Member. You would then deposit your annual fee of 50,000 Tshs plus the 10,000 Tshs one-time application fee. The total amount to deposit would be 60,000 TShs.</p>
    <p>BANK: NMB.<br>Account No: 20810008255<br>Account name: Tanzanian Psychological Association</p>
    <p>After payment upload proof of payment (receipt) <a href='https://tapa.or.tz/pay_annual_fees.php'>here</a>.</p>
    <p>For any inquiries, please email <a href='mailto:admin@tapa.or.tz'>admin@tapa.or.tz</a> or Whatsapp +255 719911575.</p>
    <p>If you did not register on our website, please ignore this message.</p>
    <div class="footer">
        Regards,<br>
        Administrative Assistant,<br>
        Tanzanian Psychological Association (TAPA)<br>
        +255 679 256 256
    </div>
</body>
</html>
EMAIL;

            $headers = "From: TAPA <admin@tapa.or.tz>\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            // Send email to the provided address and another address
            $recipients = "$email, tapatz18@gmail.com";

            if (mail($recipients, $subject, $message, $headers)) {
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
?>