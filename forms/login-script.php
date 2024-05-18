<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include('../forms/connection.php'); // Ensure the connection script is included once

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepared statement to prevent SQL Injection
        $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email); // 's' specifies the variable type => 'string'
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];

            // Verify the provided password with the hashed password from the database
            // if (password_verify($password, $hashedPassword)) {
                if ($password == $hashedPassword) {
                // Password matches, create a session and store user information
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $email;
                
                // Check user role
                if ($row['role'] == 1) {
                    // Admin user
                    header("Location: ../Admin/news/index.php"); // Redirect to admin dashboard
                    exit();
                } else {
                    // Normal user
                    header("Location: ../profile/index.php"); // Redirect to user profile
                    exit();
                }
            } else {
                // Incorrect password
                $_SESSION['error'] = "Invalid credentials. Please try again.";
                header("Location: ../login.php"); // Redirect to login page
                exit();
            }
        } else {
            // User not found
            $_SESSION['error'] = "User with this email does not exist.";
            header("Location: ../login.php"); // Redirect to login page
            exit();
        }

        $stmt->close(); // Close statement
        $conn->close(); // Close connection
    } else {
        $_SESSION['error'] = "Required fields are missing.";
        header("Location: ../login.php"); // Redirect to login page
        exit();
    }
}
?>
