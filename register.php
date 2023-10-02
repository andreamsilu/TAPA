<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connection.php');

// Process member registration
if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check the request method
    $firstname = sanitizeInput($_POST["firstname"]);   
    $lastname = sanitizeInput($_POST["lastname"]);
    $email = sanitizeInput($_POST["email"]);
    $phone = sanitizeInput($_POST["phone"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hash the password for security
    $address = sanitizeInput($_POST["address"]);
    $about = sanitizeInput($_POST["about"]);

    // Check if the email or phone already exists in the database
    $sql = "SELECT id FROM members WHERE email=? OR phone=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Phone or email already exists.";
    } else {
        // Insert the new user into the database using a prepared statement
        $sql = "INSERT INTO members (firstname, lastname, email, phone, password, address, about) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $firstname, $lastname, $email, $phone, $password, $address, $about);

        if ($stmt->execute()) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
}

// Function to sanitize user input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
