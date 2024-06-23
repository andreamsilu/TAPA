<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Recipient email address
    $to = 'admin@tapa.or.tz'; // Change this to your email address

    // Email headers
    $headers = "From: $name <$email>" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";

    // Email content
    $email_content = "
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                padding: 20px;
            }
            h2 {
                color: #333;
                margin-bottom: 20px;
            }
            p {
                margin-bottom: 10px;
            }
            .success {
                color: #28a745;
                font-weight: bold;
            }
            .error {
                color: #dc3545;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Message:</strong><br>$message</p>
    </body>
    </html>
    ";

    // Send email
    if (mail($to, $subject, $email_content, $headers)) {
        echo "<p class='success'>Your message has been sent successfully. Thank you!</p>";
    } else {
        echo "<p class='error'>Failed to send message. Please try again later.</p>";
    }
} else {
    echo "<p class='error'>Invalid request method.</p>";
}
?>
