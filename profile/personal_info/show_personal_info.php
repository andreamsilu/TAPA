<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      <h5>User Profile</h5>
    </div>
    <div class="card-body">
      <?php
        include "../forms/connection.php";


      // Get the user's information
      $userId = 1;  // Replace with the actual user ID
      $sql = "SELECT * FROM your_table_name WHERE id = $userId";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
      ?>
        <div class="well">
          <p><strong>Name:</strong> <?php echo $row['name']; ?></p>
          <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
          <p><strong>Gender:</strong> <?php echo $row['gender']; ?></p>
          <p><strong>Nationality:</strong> <?php echo $row['nationality']; ?></p>
          <p><strong>Date of Birth:</strong> <?php echo $row['dob']; ?></p>
          <p><strong>Country of Residence:</strong> <?php echo $row['country_residence']; ?></p>
          <p><strong>City/Town of Residence:</strong> <?php echo $row['city_residence']; ?></p>
          <p><strong>Practitioner License:</strong> <?php echo $row['license']; ?></p>
          <p><strong>Languages:</strong> <?php echo $row['languages']; ?></p>
          <!-- Add other fields as needed -->

          <!-- Edit Button -->
          <a href="edit_personal_info.php" class="btn btn-primary">Edit</a>
        </div>
      <?php
      } else {
          echo "User not found.";
      }

      // Close the database connection
      $conn->close();
      ?>
    </div>
  </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
