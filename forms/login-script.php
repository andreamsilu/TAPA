<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Uncommented session_start()

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

  include('../forms/connection.php');

    // Query to fetch user details based on the provided email
    $sql = "SELECT * FROM users WHERE email = '$email' AND pay_status =='1' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Verify the provided password with the hashed password from the database
        if (password_verify($password, $hashedPassword)) {
            // Password matches, create a session and store user information
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $email;
            
            // Check user role
            if ($row['role'] == 1) {
                // Admin user
                header("Location: ../Admin/news/index.php"); // Redirect to admin dashboard
            } else {
                // Normal user
                header("Location: ../profile/index.php"); // Redirect to user profile
            }
            exit();
        } else {
            // Incorrect password
            echo $error = "Invalid credentials. Please try again.";
            header("Location: ../login.php"); // Redirect to user profile

        }
    } else {
        // User not found
        echo $error = "User with this email does not exist.";
    }

    $conn->close();
}
?>
