<?php
session_start();

include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['login'];
    $password = $_POST['password'];

    // Query to fetch user details based on the provided email
    $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];

        // Verify the provided password with the hashed password from the database
        if (password_verify($password, $hashedPassword)) {
            // Password matches, create a session and redirect to a success page
            $_SESSION['email'] = $email;
            header("Location: ../profile/index.php"); // Redirect to a success page
            exit();
        } else {
            // Incorrect password
            $error = "Invalid credentials. Please try again.";
            echo $error;
        }
    } else {
        // User not found
        $error = "User with this email does not exist.";
        echo $error;
    }
}
mysqli_close($conn);
?>