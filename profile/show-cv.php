<?php

session_start();
include "navigation.php";
include "../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$userId = $_SESSION['user_id'];

?>

<div class="container mt-5">
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5><i class="bi bi-file-earmark-text"></i> CV details</h5>
      <?php
      // Check if CV exists for the user
      $sql = "SELECT * FROM personal_cv WHERE user_id = '$userId'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        // If CV exists, display "Edit" button with icon
        $row = $result->fetch_assoc();
      ?>
        <a href="edit-cv.php?id=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="bi bi-pencil"></i>Edit</a>
      <?php } else { ?>
        <!-- If CV doesn't exist, display "Add CV" button with icon -->
        <a href="add-cv.php" class="btn btn-primary"><i class="bi bi-file-earmark-plus"></i> Add your CV</a>
      <?php } ?>
    </div>
    <div class="card-body">
      <?php
      // Get the record to be displayed
      $cvId = $_GET['id'] = $row['id'];
      $sql = "SELECT * FROM personal_cv WHERE user_id = '$userId'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
      ?>
        <p class="border-bottom"><i class="bi bi-person"></i> <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></p>
        <p class="border-bottom"><i class="bi bi-envelope"></i> <strong>Email:</strong> <?php echo $row['email']; ?></p>
        <p class="border-bottom"><i class="bi bi-telephone"></i> <strong>Phone:</strong> <?php echo $row['phone']; ?></p>

        <!-- Display CV File -->
        <h4><i class="bi bi-file-earmark-text"></i> CV File</h4>
        <!-- <p><?php //echo $row['cv_file']; ?></p> -->
        <a href="../forms/uploads/<?php echo $row['cv_file']; ?>" target="_blank" class="btn btn-primary"><i class="bi bi-file-arrow-down"></i> Open</a>
      <?php } else {
        echo  '<div class="card-body  d-flex justify-content-center">
              <a href="add-cv.php" class="btn btn-primary  align-items-center">
              <i class="bi bi-plus"></i> 
                  Add  CV
              </a>
          </div>';
      echo "<div id='snackbar'>No cv info found.</div>";
      }
      ?>
    </div>

  </div>
</div>

<?php include("footer.php") ?>