<!DOCTYPE html>
<html lang="en">
<head>
  <title>Education Details</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-qL4mqQJBLufXU4HJLaM3QpThT6fmbd9Tz4lxfxfS3g1TKI4D/EnDj6Iqe4CfjkymAKeSJegFjjzGzVXWfGg6sQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .card {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h2>Education Details</h2>

  <?php
    include "../forms/connection.php";


  // Retrieve education details from the 'education' table
  $sql = "SELECT * FROM education";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
  ?>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"><i class="fas fa-graduation-cap"></i> <?php echo $row['award']; ?></h5>
      <p class="card-text">Institution: <?php echo $row['institution']; ?></p>
      <p class="card-text">Year of Graduation: <?php echo $row['year']; ?></p>
      <a href="edit_edu.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
    </div>
  </div>
  <?php
      }
  } else {
      echo "No education details found.";
  }

  // Close connection
  $conn->close();
  ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" integrity="sha512-f3RykEUc/jFsdt1P/fh5f9xNd1ynMqVg3Z8vEM/yrwPQlFXW3c6zBtzW58yezuzqA14F6o7dBtdLBrPX8o1G6g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
