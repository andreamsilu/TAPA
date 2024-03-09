<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Recipient email address
    $to = 'msiluandrew2020@gmail.com'; // Change this to your email address

    // Email headers
    $headers = "From: $name <$email>" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";

    // Email content
    $email_content = "
    <html>
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
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "Invalid request method.";
}
?>
