<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if the user is not authenticated
    header("Location: ../login.php");
    exit();
}

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "TAPA_DB";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

include('../forms/connection.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the user's email
    $user_email = $_SESSION['email'];

    // Check if a file is uploaded
    if ($_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
        // Specify the directory where the uploaded file will be stored
        $target_dir = "../forms/uploads/";
        // Generate a unique filename for the uploaded file
        $target_file = $target_dir . uniqid() . '_' . basename($_FILES['profile_pic']['name']);
        
        // Check file type
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }
        
        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_file)) {
            // Update the profile_picture field in the users table using a prepared statement
            $stmt = $conn->prepare("UPDATE users SET profile_pic = ? WHERE email = ?");
            $stmt->bind_param("ss", $target_file, $user_email);
            if ($stmt->execute()) {
                // Redirect back to the profile page with a success message
                header("Location: index.php?upload_success=1");
                exit();
            } else {
                // Handle database error
                echo "Error updating profile picture: " . $stmt->error;
            }
            $stmt->close();
        } else {
            // Handle file upload error
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        // Handle file upload error
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    // Redirect to the profile page if the form is not submitted
    header("Location: profile.php");
    exit();
}

// Close the database connection
$conn->close();
?>
