<?php
// session_start();
include('connection.php'); // Include your database connection script

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page if not logged in
  header("Location: login.php"); // Replace with your login page URL
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $currentPassword = $_POST["password"];
  $newPassword = $_POST["newpassword"];
  $reenteredPassword = $_POST["renewpassword"];
  $user_id = $_SESSION['user_id'];

  // Retrieve the user's current password from the database
  $sql = "SELECT password FROM members WHERE id=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $hashedPassword = $row["password"];

    // Verify the current password
    if (password_verify($currentPassword, $hashedPassword)) {
      // Current password is correct

      // Check if the new password and reentered password match
      if ($newPassword === $reenteredPassword) {
        // Hash the new password for security
        $newHashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // Update the user's password in the database
        $updateSql = "UPDATE members SET password=? WHERE id=?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("si", $newHashedPassword, $user_id);

        if ($updateStmt->execute()) {
          echo "Password changed successfully!";
        } else {
          echo "Error changing password: " . $updateStmt->error;
        }

        $updateStmt->close();
      } else {
        echo "New password and re-entered password do not match.";
      }
    } else {
      echo "Invalid current password.";
    }
  } else {
    echo "User not found.";
  }

  $stmt->close();
  $conn->close();
}
?>