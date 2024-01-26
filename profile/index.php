<?php include "navigation.php" ?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TAPA_DB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Function to fetch progress based on your application's logic
function fetchProgress() {
   include "../forms/connection.php";
    // You can customize this function to fetch and calculate progress based on your application's requirements
    // Example: Fetching total number of completed forms out of the total number of forms
    $totalForms = 5; // Adjust this based on the total number of forms
    $completedFormsQuery = "SELECT COUNT(*) AS completedForms FROM personal_info WHERE status = 'completed'";
    $result = $conn->query($completedFormsQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $completedForms = $row['completedForms'];
        $progressPercentage = ($completedForms / $totalForms) * 100;

        echo '<p>Completed Forms: ' . $completedForms . ' out of ' . $totalForms . '</p>';
        echo '<div class="progress">';
        echo '<div class="progress-bar" role="progressbar" style="width: ' . $progressPercentage . '%" aria-valuenow="' . $progressPercentage . '" aria-valuemin="0" aria-valuemax="100"></div>';
        echo '</div>';
    } else {
        echo 'Error fetching progress.';
    }
}

// Close the database connection
$conn->close();
?>



<div class="container mt-5">
  <h2>Summary Page</h2>

  <h3>Personal Information</h3>
  <?php include '../profile/show_personal_info.php'; ?>

  <h3>Work Experience</h3>
  <?php include '../profile/show-exp.php'; ?>

  <h3>Certification Information</h3>
  <?php include '../profile/show-cert.php'; ?>

  <h3>Contact Information</h3>
  <?php include '../profile/show-cont.php'; ?>

  <h3>Personal CV</h3>
  <?php include '../profile/show-cv.php'; ?>

  <h3>Progress</h3>
  <!-- Display progress based on your application's logic -->
  <?php include '../profile/progress.php'; ?>
</div>

<?php include("footer.php") ?>