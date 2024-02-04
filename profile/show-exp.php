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
?>

  <style>
    .experience-card {
      margin-bottom: 20px;
    }

    .card-header {
      background-color: #007bff;
      color: #fff;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <?php
    include "../forms/connection.php";


  // Get work experience information
  $sql = "SELECT * FROM experience";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
  ?>
        <div class="card experience-card">
          <div class="card-header">
            <h5><?php echo $row['company_name']; ?></h5>
          </div>
          <div class="card-body">
            <p><strong>Position:</strong> <?php echo $row['position']; ?></p>
            <p><strong>Start Date:</strong> <?php echo $row['start_date']; ?></p>
            <p><strong>End Date:</strong> <?php echo ($row['end_date']) ? $row['end_date'] : 'Present'; ?></p>
            <p><strong>Job Description:</strong> <?php echo $row['job_description']; ?></p>
          </div>
        </div>
  <?php
      }
  } else {
      echo "No work experience found.";
  }

  // Close the database connection
  $conn->close();
  ?>
</div>

<?php include("footer.php") ?>

