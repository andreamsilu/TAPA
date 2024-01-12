<?php
   include "../forms/connection.php";


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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

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

    <button type="button" class="btn btn-primary" onclick="changePassword()">Change Password</button>
  </form>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
  function changePassword() {
    // You can add your password-changing logic here
    // Example: Send the form data to a server using AJAX
    var formData = $("#changePasswordForm").serialize();
    $.ajax({
      type: "POST",
      url: "/change_password.php", // Replace with your actual backend endpoint
      data: formData,
      success: function(response) {
        alert(response);
        // Add any other logic you need after successful password change
      },
      error: function(error) {
        console.error("Error changing password:", error);
        // Handle errors here
      }
    });
  }
</script>

</body>
</html>
