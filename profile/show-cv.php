<?php include("navigation.php") ?>


<div class="container mt-5">
  <?php
   include "../forms/connection.php";


  // Get the record to be displayed
  // $cvId = $_GET['id'];
  // $sql = "SELECT * FROM personal_cv WHERE id = $cvId";
  $sql = "SELECT * FROM personal_cv";

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
    <a href="uploads/<?php echo $row['cv_file']; ?>" target="_blank" class="btn btn-primary">Open</a>

    <!-- Edit Button -->
    <a href="edit_personal_cv.php?id=<?php echo $cvId; ?>" class="btn btn-warning">Edit</a>
  <?php
  } else {
      echo "Personal CV not found.";
  }

  // Close the database connection
  $conn->close();
  ?>

</div>
<?php include("footer.php") ?>

