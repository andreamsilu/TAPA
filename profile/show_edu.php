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
    .card {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h2><i class="bi bi-journal-text"></i> Education Details</h2>

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
      <h5 class="card-title"><i class="bi bi-award-fill"></i> <?php echo $row['award']; ?></h5>
      <p class="card-text"><i class="bi bi-building"></i> Institution: <?php echo $row['institution']; ?></p>
      <p class="card-text"><i class="bi bi-calendar-check"></i> Year of Graduation: <?php echo $row['year']; ?></p>
      <a href="edit_edu.php?id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="bi bi-pencil"></i> Edit</a>
    </div>
  </div>
  <?php
      }
  } else {
      echo "No education details found.";
  echo " <a href='add-edu.php' class='btn btn-primary'><i class='bi bi-plus'></i> Add</a>";

  }

  // Close connection
  $conn->close();
  ?>
</div>

<?php include("footer.php") ?>
