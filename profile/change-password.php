<?php
session_start();
include "../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not authenticated
    header("Location: login.php");
    exit();
}


// Function to sanitize form data
function sanitizeData($data)
{
    return htmlspecialchars(trim($data));
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a session or some way to identify the current user
    $userId = $_SESSION['user_id'];

    $currentPassword = sanitizeData($_POST["currentPassword"]);
    $newPassword = sanitizeData($_POST["newPassword"]);
    $confirmPassword = sanitizeData($_POST["confirmPassword"]);

    // Validate current password and new password match
    if ($newPassword !== $confirmPassword) {
        echo "alert('New password and confirm password do not match.')";
        exit();
    }

    // Hash the passwords before comparing or storing
    $currentPassword = password_hash($currentPassword, PASSWORD_DEFAULT);

    // Check if the current password matches the stored password
    $checkPasswordQuery = "SELECT password FROM users WHERE id = $userId";
    $result = $conn->query($checkPasswordQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['password'];

        if (password_verify($currentPassword, $storedPassword)) {
            // Update the password in the database
            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $updatePasswordQuery = "UPDATE users SET password = '$newPasswordHash' WHERE id = $userId";

            if ($conn->query($updatePasswordQuery) === TRUE) {
                echo " alert('Password changed successfully')";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "alert('Incorrect current password.')";
        }
    } else {
        echo "alert('User not found.')";
    }
}

// Close the database connection
$conn->close();
?>

<?php include("navigation.php"); ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header ">
            <h4 ><i class="bi bi-lock"></i> Change Password</h4>
        </div>
        <div class="card-body">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <form id="changePasswordForm" action="change-password.php" method="post">
                            <div class="form-group">
                                <label for="currentPassword"><i class="bi bi-key"></i> Current Password</label>
                                <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                            </div>

                            <div class="form-group">
                                <label for="newPassword"><i class="bi bi-unlock"></i> New Password</label>
                                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="confirmPassword"><i class="bi bi-check"></i> Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        <div class="form-group mt-5">
                            <button type="submit" class="btn btn-primary"><i class="bi bi-key"></i> Change Password</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>