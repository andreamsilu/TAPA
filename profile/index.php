<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Summary Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2>Summary Page</h2>

  <h3>Personal Information</h3>
  <?php include 'fetch_personal_info.php'; ?>

  <h3>Work Experience</h3>
  <?php include 'fetch_work_experience.php'; ?>

  <h3>Certification Information</h3>
  <?php include 'fetch_certification_info.php'; ?>

  <h3>Contact Information</h3>
  <?php include 'fetch_contact_info.php'; ?>

  <h3>Personal CV</h3>
  <?php include 'fetch_personal_cv.php'; ?>

  <h3>Progress</h3>
  <!-- Display progress based on your application's logic -->
  <?php include 'progress.php'; ?>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
