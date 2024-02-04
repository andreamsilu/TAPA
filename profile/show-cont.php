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
    .contact-card {
      margin-bottom: 20px;
    }

    .card-header {
      background-color: #28a745;
      color: #fff;
    }
  </style>



<div class="container mt-5">
  <?php
    include "../forms/connection.php";


  // Get contact information
  $sql = "SELECT * FROM contact_info";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
  ?>
        <div class="card contact-card">
          <div class="card-header">
            <h5><?php echo $row['company_name']; ?></h5>
          </div>
          <div class="card-body">
            <p><strong>Contact Person:</strong> <?php echo $row['contact_person']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p><strong>Phone Number:</strong> <?php echo $row['phone_number']; ?></p>
            <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
          </div>
        </div>
  <?php
      }
  } else {
      echo "No contact information found.";
  }

  $conn->close();
  ?>
</div>

<?php include("footer.php") ?>
