

<?php
   session_start();
   include "navigation.php";
   include "../forms/connection.php";
   
   // Check if the user is authenticated
   if (!isset($_SESSION['user_id'])) {
       // Redirect to the login page if not authenticated
       header("Location: login.php");
       exit();
   }


// Function to sanitize form data
function sanitizeData($data) {
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
        echo "New password and confirm password do not match.";
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
                echo "Password changed successfully";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "Incorrect current password.";
        }
    } else {
        echo "User not found.";
    }
}

// Close the database connection
$conn->close();
?>

<?php include("navigation.php"); ?>
<div class="container mt-5">
  <h2>Change Password</h2>
  <form id="changePasswordForm">
    <div class="form-group">
      <label for="currentPassword">Current Password</label>
      <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
    </div>

    <div class="form-group">
      <label for="newPassword">New Password</label>
      <input type="password" class="form-control" id="newPassword" name="newPassword" required>
    </div>

    <div class="form-group">
      <label for="confirmPassword">Confirm New Password</label>
      <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
    </div>

    <button type="button" class="btn btn-primary">Change Password</button>
  </form>
</div>
<?php include("footer.php"); ?>




