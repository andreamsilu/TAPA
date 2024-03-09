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
        echo "<script>showSnackbar('Your message has been sent successfully. Thank you!', 'success');</script>";
    } else {
        echo "<script>showSnackbar('Failed to send message. Please try again later.', 'error');</script>";
    }
} else {
    echo "<script>showSnackbar('Invalid request method.', 'error');</script>";
}
?>
<script>
function showSnackbar(message, type) {
    var snackbar = document.createElement('div');
    snackbar.className = 'snackbar ' + type;
    snackbar.textContent = message;
    document.body.appendChild(snackbar);
    setTimeout(function() {
        snackbar.className = snackbar.className.replace('show', '');
        snackbar.parentNode.removeChild(snackbar);
    }, 3000);
}
</script>
