<?php 

 
include('sessions.php'); 

// Check if the user is logged in
// if (!isset($_SESSION['member_id'])) {
  // Redirect to the login page if not logged in
  // header("Location: login.php");// Replace with your login page URL
  // exit();
// }

// Fetch user details based on their session user_id
$member_id = $_SESSION['member_id'];
$sql = "SELECT title, category, institution, completion_year, certificate_link FROM certifications WHERE member_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $member_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $row = $result->fetch_assoc();
  $title = $row["title"];
  $category = $row["category"];
  $institution = $row["institution"];
  $completion_year = $row["completion_year"];
  $certificate_link = $row["certificate_link"];
//   $profile_pic =$row["profile_pic"];
//   $about = $row["about"];
//   $membership_type = $row["membership_type"];
} else {
  // Handle the case where the user's details couldn't be retrieved
  // You can redirect to an error page or display an error message
  echo "certificate details not found.";
  exit();
}

$stmt->close();
$conn->close();
?>
