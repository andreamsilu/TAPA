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
  <?php
   include "../forms/connection.php";


  // Get the record to be displayed
  $cvId = $_GET['id'];
  // $sql = "SELECT * FROM personal_cv WHERE id = $cvId";
  $sql = "SELECT * FROM personal_cv WHERE user_id = '$userId'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
  ?>
    <h2><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></h2>
    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
    <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>

    <!-- Display CV File -->
    <h4>CV File</h4>
    <p><?php echo $row['cv_file']; ?></p>
    <a href="../forms/uploads/<?php echo $row['cv_file']; ?>" target="_blank" class="btn btn-primary">Open</a>

    <!-- Edit Button -->
    <a href="edit-cv.php?id=<?php echo $cvId; ?>" class="btn btn-warning">Edit</a>
  <?php
  } else {
      // echo "Personal CV not found.";
  echo " <a href='add-cv.php' class='btn btn-primary'>Add your cv</a>";

  }

  // Close the database connection
  $conn->close();
  ?>

</div>
<?php include("footer.php") ?>

