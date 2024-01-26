<?php include("navigation.php") ?>
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

<?php include("footer.php") ?>
