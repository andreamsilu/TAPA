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
            $message = "
            <html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        line-height: 1.6;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                    }
                    .header {
                        background-color: #f4f4f4;
                        padding: 20px;
                        text-align: center;
                    }
                    .content {
                        padding: 20px;
                    }
                    .footer {
                        background-color: #f4f4f4;
                        padding: 20px;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <h1>Welcome to TAPA</h1>
                    </div>
                    <div class='content'>
                        <p>Dear $fullname,</p>
                        <p>Thank you for registering with TAPA. Your application has been received, and our team will get back to you after the application is processed and after payment of the fee. Your membership account will be activated only after paying the Registration and Annual Fees.</p>
                        <p><strong>Application fees for all categories is 10,000 Tshs.</strong></p>
                        <p><strong>Annual Fees is as follows:</strong></p>
                        <ol>
                            <li>Full Member: 50,000 Tshs per annum</li>
                            <li>Associate Member I: 20,000 Tshs per annum</li>
                            <li>Associate Member II: 20,000 Tshs per annum</li>
                            <li>Student Member: 10,000 Tshs per annum</li>
                            <li>Affiliates: 30,000 Tshs per annum</li>
                            <li>Foreign Affiliates: 50,000 Tshs per annum</li>
                        </ol>
                        <p>For example, if you have a bachelor’s degree in psychology, you qualify to become a Full Member. You would then deposit your annual fee of 50,000 Tshs plus the 10,000 Tshs one-time application fee. The total amount to deposit would be 60,000 TShs.</p>
                        <p>After payment upload proof of payment (receipt) <a href='https://tapa.or.tz/pay_annual_fees.php'>here</a>.</p>
                        <p>For any inquiries, please email <a href='mailto:admin@tapa.or.tz'>admin@tapa.or.tz</a> or Whatsapp +255 719911575.</p>
                        <p>If you did not register on our website, please ignore this message.</p>
                    </div>
                    <div class='footer'>
                        <p>Regards,<br>Administrative Assistant,<br>Tanzanian Psychological Association (TAPA)<br>+255 719 911 575</p>
                    </div>
                </div>
            </body>
            </html>
        ";
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
