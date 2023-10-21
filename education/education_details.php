
<?php
//include('../forms/connection.php'); // Include your database connection script

// Check if the user is logged in
 if (!isset($_SESSION['member_id'])) {
  // Redirect to the login page if not logged in
  header("Location: login.php"); // Replace with your login page URL
  exit();
}
// Fetch user details based on their session user_id
$member_id = $_SESSION['member_id'];
$sql = "SELECT qualification_category, education_level, institution, completion_year FROM education WHERE member_id= ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $member_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $row = $result->fetch_assoc();
  $qualification_category = $row["qualification_category"];
  $education_level = $row["education_level"];
  $institution = $row["institution"];
  $completion_year = $row["completion_year"];
} else {
  // Handle the case where the user's details couldn't be retrieved
  // You can redirect to an error page or display an error message
  echo "User education  details not found.";
  exit();
}

?>


