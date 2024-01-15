<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Work Experience</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
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

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
