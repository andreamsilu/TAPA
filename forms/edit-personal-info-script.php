<?php
// session_start();  
include('connection.php'); // Include your database connection script

// Check if the user is logged in
 if (!isset($_SESSION['member_id'])) {
  // Redirect to the login page if not logged in
   header("Location: login.php");// Replace with your login page URL
  exit();
 }
  $member_id = $_SESSION['member_id'];
// Handle the form submission to update user details
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Retrieve updated values from the form
  $newFirstname = $_POST["firstname"];
  $newLastname = $_POST["lastname"];
  $newEmail = $_POST["email"];
  $newPhone = $_POST["phone"];
  $newAddress = $_POST["address"];
  $newProfilePic = $_POST['profile_pic'];
  $newAbout = $_POST["about"];
  $newMembershipType = $_POST["membership_type"];

  // Update the user's details in the database
  $updateSql = "UPDATE members SET firstname=?, lastname=?, email=?, phone=?, address=?,profile_pic?    about=?, membership_type=? WHERE member_id= $member_id";
  $updateStmt = $conn->prepare($updateSql);
  $updateStmt->bind_param("sssssss", $newFirstname, $newLastname, $newEmail, $newPhone, $newAddress, $newAbout, $newMembershipType, );

  if ($updateStmt->execute()) {
      // User details updated successfully
      echo "personal information updated successifully";
      header("Location: profile.php"); // Redirect to the user's profile page
      exit();
  } else {
      // Handle the case where the update query fails
      echo "Error updating user details: " . $updateStmt->error;
  }

  $updateStmt->close();
}

$stmt->close();
$conn->close();
?>