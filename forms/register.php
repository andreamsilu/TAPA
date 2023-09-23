
<?php
include('forms/connection.php');
// Process user registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = sanitizeInput($_POST["username"]);
    $email = sanitizeInput($_POST["email"]);
    $phone = sanitizeInput($_POST["phone"]);
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hash the password for security
    $profile_pic = sanitizeInput($_POST["profile_pic"]);
    $region = sanitizeInput($_POST["region"]);
    $address = sanitizeInput($_POST["address"]);
    $about = sanitizeInput($_POST["about"]);
    $education_level = sanitizeInput($_POST["education_level"]);
    $awards = sanitizeInput($_POST["awards"]);
    $institution = sanitizeInput($_POST["institution"]);
    $working_at = sanitizeInput($_POST["working_at"]);
    $position = sanitizeInput($_POST["position"]);



    // Check if the username or email already exists in the database

    $sql = "SELECT id FROM members WHERE username='$username' OR email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Username or email already exists.";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO  members (name, email, phone,profile_pic,region,address,about,education_level,awards,institution,working_at,position,password) VALUES 
        ('$username', '$email', '$phone''$password','$profile_pic','$region','$address','$about','$education_level','$awards','$institution','$working_at','$position')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

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