
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('connection.php'); // Include your database connection script
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitizeInput($_POST["email"]);
    $password = $_POST["password"];

    // Retrieve the user record from the database based on the provided email
    $sql = "SELECT member_id, email, password FROM members WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct
            $_SESSION["member_id"] == $row["member_id"];
            header("Location: ../profile.php"); // Redirect to a protected page
            exit();
        } else {
            $loginError = "Invalid email or password.";
            echo $loginError;
        }
    } else {                                                                                                                                                                      
        $loginError = "Invalid email or password.";
        echo $loginError;

    }

    $stmt->close();
}

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}   
?>
