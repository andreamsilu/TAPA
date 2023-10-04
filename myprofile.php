<?php
session_start();
include('connection.php'); // Include your database connection script

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page if not logged in
  header("Location: login.php"); // Replace with your login page URL
  exit();
}

// Fetch user details based on their session user_id
$user_id = $_SESSION['user_id'];
$sql = "SELECT firstname, lastname, email, phone, address, about FROM members WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $row = $result->fetch_assoc();
  $firstname = $row["firstname"];
  $lastname = $row["lastname"];
  $email = $row["email"];
  $phone = $row["phone"];
  $address = $row["address"];
  $about = $row["about"];
} else {
  // Handle the case where the user's details couldn't be retrieved
  // You can redirect to an error page or display an error message
  echo "User details not found.";
  exit();
}

$stmt->close();

// Check if the edit form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editProfile"])) {
  // Process the form data for editing
  $newFirstname = sanitizeInput($_POST["newFirstname"]);
  $newLastname = sanitizeInput($_POST["newLastname"]);
  $newEmail = sanitizeInput($_POST["newEmail"]);
  $newPhone = sanitizeInput($_POST["newPhone"]);
  $newAddress = sanitizeInput($_POST["newAddress"]);
  $newAbout = sanitizeInput($_POST["newAbout"]);

  // Update user details in the database
  $updateSql = "UPDATE members SET firstname=?, lastname=?, email=?, phone=?, address=?, about=? WHERE id=?";
  $updateStmt = $conn->prepare($updateSql);
  $updateStmt->bind_param("ssssssi", $newFirstname, $newLastname, $newEmail, $newPhone, $newAddress, $newAbout, $user_id);

  if ($updateStmt->execute()) {
    // Update successful, refresh the page
    $successMessage = "login succesfull";
    header("Location: profile.php");
    exit();
  } else {
    // Handle the case where the update fails
    $editError = "Error updating user details.";
  }

  $updateStmt->close();
}

// Function to sanitize user input
function sanitizeInput($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>