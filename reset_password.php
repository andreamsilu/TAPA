<?php
// Include database connection
include "forms/connection.php";

// Get token from URL
$token = $_GET['token'];

// Check if token exists and hasn't expired
$stmt = $conn->prepare("SELECT email FROM password_reset WHERE token = ? AND created_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
$stmt->bind_param("s", $token);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 0) {
    echo "Invalid or expired token.";
    exit();
}
$email = $result->fetch_assoc()['email'];
$stmt->close();

// Reset password form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit();
    }

    // Update user's password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashedPassword, $email);
    $stmt->execute();
    $stmt->close();

    // Delete token from database
    $stmt = $conn->prepare("DELETE FROM password_reset WHERE token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->close();

    // Redirect user to login page or home page
    header("Location: login.php");
    exit();
}
?>

<div class="card align-content-center m-auto">
    <div class="card-body">
        <h5 class="card-title">Reset Password</h5>
        <form action="reset_password.php" method="post">
            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
</div>
