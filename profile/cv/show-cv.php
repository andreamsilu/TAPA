<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Personal CV</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <?php
   include "../forms/connection.php";


  // Get the record to be displayed
  $cvId = $_GET['id'];
  $sql = "SELECT * FROM personal_cv WHERE id = $cvId";
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

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
