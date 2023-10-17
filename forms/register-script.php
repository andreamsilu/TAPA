<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../connection.php");
// include('sessions.php');

try {
    // Check database connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and validate user input
    $firstname = sanitizeAndValidateString($_POST['firstname']);
    $lastname = sanitizeAndValidateString($_POST['lastname']);
    $email = sanitizeAndValidateEmail($_POST['email']);
    $phone = sanitizeAndValidateString($_POST['phone']);
    $password = $_POST['password']; // Password should be hashed (see note below)
    $confirmPassword = $_POST['confirm-password'];
    $address = sanitizeAndValidateString($_POST['address']);
    $membership_type = sanitizeAndValidateString($_POST['membership_type']);
    $about = sanitizeAndValidateString($_POST['about']);

    // Additional password validation
    if ($password !== $confirmPassword) {
        throw new Exception("Password and Confirm Password do not match.");
    }

    // Check if email already exists in the database (you should have a unique constraint on email)
    $sql = "SELECT member_id FROM members WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        throw new Exception("Email address is already registered.");
    }

    // Hash the password (use appropriate password hashing library)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Handle profile picture upload
    $profile_pic = handleProfilePictureUpload();

    // Insert user data into the database
    $sql = "INSERT INTO members (firstname, lastname, email, phone, password, address, membership_type, profile_pic, about) VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $firstname, $lastname, $email, $phone, $hashedPassword, $address, $membership_type,$profile_pic, $about);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: ../login.php");
    } else {
        throw new Exception("Error: " . $stmt->error);
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}

function sanitizeAndValidateString($input) {
    $sanitized_input = trim($input);
    $sanitized_input = htmlspecialchars($sanitized_input, ENT_QUOTES, 'UTF-8');
    
    if (strlen($sanitized_input) < 2 || strlen($sanitized_input) > 255) {
        throw new Exception("Invalid input. Please check your data.");
    }
    
    return $sanitized_input;
}

function sanitizeAndValidateEmail($email) {
    $sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    if (!filter_var($sanitized_email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email address.");
    }
    
    return $sanitized_email;
}

function handleProfilePictureUpload() {
    $validExtensions = array("jpg", "jpeg", "png", "gif");
    $maxFileSize = 5 * 1024 * 1024; // 5MB

    if (
        isset($_FILES["profile_pic"]) &&
        $_FILES["profile_pic"]["error"] === UPLOAD_ERR_OK &&
        in_array(pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION), $validExtensions) &&
        $_FILES["profile_pic"]["size"] <= $maxFileSize
    ) {
        $tempFilePath = $_FILES["profile_pic"]["tmp_name"];

        // Generate a unique filename (e.g., using a timestamp)
        $profilePicName = uniqid() . "." . pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION);

        // Define the target directory where you want to store the uploaded files
        $targetDir = "/opt/lampp/htdocs/websites/TAPA/forms/uploads/";

        // Define the target file path
        $targetFilePath = $targetDir . $profilePicName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($tempFilePath, $targetFilePath)) {
            return $profilePicName;
        } else {
            throw new Exception("Error uploading the profile picture.");
        }
    } else {
        throw new Exception("Invalid profile picture. Please upload a valid image file (JPG, JPEG, PNG, GIF) within 5MB.");
    }
}

