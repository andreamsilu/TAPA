<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Information</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .contact-card {
      margin-bottom: 20px;
    }

    .card-header {
      background-color: #28a745;
      color: #fff;
    }
  </style>
</head>
<body>

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
