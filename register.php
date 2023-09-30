<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connection.php');

// Process user registration
if ($_SERVER["submit"] == "POST") {
    $username = sanitizeInput($_POST["username"]);
    $email = sanitizeInput($_POST["email"]);
    $phone = sanitizeInput($_POST["phone"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hash the password for security
    $region = sanitizeInput($_POST["region"]);
    $address = sanitizeInput($_POST["address"]);
    $about = sanitizeInput($_POST["about"]);
    $education_level = sanitizeInput($_POST["education_level"]);
    $awards = sanitizeInput($_POST["awards"]);
    $institution = sanitizeInput($_POST["institution"]);
    $working_at = sanitizeInput($_POST["working_at"]);
    $position = sanitizeInput($_POST["position"]);

    // Handle profile picture upload
    if ($_FILES["profile_pic"]["error"] === 0) {
        $uploadDir = "assets/img/memberprofile/"; // Specify the directory to store uploaded images
        $profile_pic = $uploadDir . $_FILES["profile_pic"]["name"];

        // Check if the file already exists
        if (file_exists($profile_pic)) {
            echo "File already exists.";
        } else {
            // Move the uploaded file to the specified directory
            move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $profile_pic);
        }
    } else {
        // Handle the case when no profile picture is uploaded
        $defaultAvatar = "default_avatar.jpg"; // Specify the default avatar image file name
        $profile_pic = "avatars/" . $defaultAvatar; // Adjust the path as needed
    }

    // Check if the username or email already exists in the database
    $sql = "SELECT id FROM members WHERE name=? OR email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Username or email already exists.";
    } else {
        // Insert the new user into the database using prepared statement
        $sql = "INSERT INTO members (name, email, phone, profile_pic, region, address, about, education_level, awards, institution, working_at, position, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssss", $username, $email, $phone,$password, $profile_pic, $region, $address, $about, $education_level, $awards, $institution, $working_at, $position);
        
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
