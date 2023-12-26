<?php
error_reporting(E_ALL);
 ini_set('display_errors', 1);

// Start a session to store user information
session_start();

// Include database connection file (replace with your actual connection details)
require_once '../forms/connection.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {

    // Sanitize all user input to prevent injection attacks
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $postal_address = mysqli_real_escape_string($conn, $_POST['postal_address']);
    $birth_date = mysqli_real_escape_string($conn, $_POST['birth_date']);
    $physical_address = mysqli_real_escape_string($conn, $_POST['physical_address']);
    $membership_type = mysqli_real_escape_string($conn, $_POST['membership_type']);
    $yes_licensure = mysqli_real_escape_string($conn, $_POST['yes_licensure']);
    $yes_crime = mysqli_real_escape_string($conn, $_POST['yes_crime']);
    $cv = $_FILES['cv']['name'];  // Handle file upload separately
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate user input thoroughly
    // (Add your specific validation rules here, e.g., for email format, password strength, etc.)
    if (empty($fullname)) {
        $_SESSION['error'] = "Please enter your full name.";
        header('location: register.php');
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Please enter a valid email address.";
        header('location: register.php');
        exit;
    }
    
    if (!preg_match("/^\d{10}$/", $phone)) {  // Assuming 10-digit phone number format
        $_SESSION['error'] = "Please enter a valid 10-digit phone number.";
        header('location: register.php');
        exit;
    }
    
    if (empty($postal_address)) {
        $_SESSION['error'] = "Please enter your postal address.";
        header('location: register.php');
        exit;
    }

    // Check for reCAPTCHA validation
    if (!isset($_POST['g-recaptcha-response'])) {
        $_SESSION['error'] = "Please complete the reCAPTCHA verification.";
        header('location: register.php');
        exit;
    }

    $secretKey = "YOUR_SECRET_KEY";  // Replace with your actual reCAPTCHA secret key
    $response = $_POST['g-recaptcha-response'];
    $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $response;
    $responseData = file_get_contents($verifyUrl);
    $responseData = json_decode($responseData);

    if ($responseData->success) {
        // If reCAPTCHA is valid, proceed with registration

        // Check if passwords match
        if ($password !== $confirm_password) {
            $_SESSION['error'] = "Passwords do not match.";
            header('location: registration.php');
            exit;
        }

        // Hash the password with a strong algorithm like bcrypt
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Generate a unique activation code
        $activation_code = md5(uniqid(rand(), true));

        // Prepare SQL query using prepared statements to prevent SQL injection
        $sql = "INSERT INTO users (fullname, email, phone, postal_address, birth_date, physical_address, membership_type, yes_licensure, yes_crime, cv, password, activation_code)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssss", $fullname, $email, $phone, $postal_address, $birth_date, $physical_address, $membership_type, $yes_licensure, $yes_crime, $cv, $hashed_password, $activation_code);

        // Handle file upload (if successful, move the uploaded file to a secure location)
        $target_dir = "../forms/uploads";
        $target_file = $target_dir . basename($cv);
        move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file);

        // Execute the query
        if ($stmt->execute()) {
            // Send an email with activation link
            // (Implement your email sending logic here)

            $_SESSION['success'] = "Registration successful! Please check your email for activation link.";
            header('location: login.php');
        }
    }
}