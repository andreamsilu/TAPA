<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    include('../forms/connection.php');

    // Query to fetch user details based on the provided email and pay_status condition
    $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        if ($row['pay_status'] == 1) {
            // Verify the provided password with the hashed password from the database
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $email;

                if ($row['role'] == 1) {
                    header("Location: ../Admin/news/index.php");
                } else {
                    header("Location: ../profile/index.php");
                }
                exit();
            } else {
                echo $error = "<script>alert('Invalid credentials. Please try again.')</script>";
                // header("Location: ../login.php");
            }
        } else {
            echo $error = "Please pay the annual fees or renew your membership to continue.";
            header("Location: ../login.php");
        }
    } else {
        echo $error = "User with this email does not exist.";
        header("Location: ../login.php");
    }

    $conn->close();
}
?>
