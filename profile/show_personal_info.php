<?php include("navigation.php") ?>


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
      $sql = "SELECT * FROM users WHERE id = $userId";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
      ?>
        <div class="well">
          <p><strong>Name:</strong> <?php echo $row['fullname']; ?></p>
          <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
          <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
          <p><strong>Postal Address:</strong> <?php echo $row['postal_address']; ?></p>
          <p><strong>Date of Birth:</strong> <?php echo $row['birth_date']; ?></p>
          <p><strong>Physical address:</strong> <?php echo $row['physical_address']; ?></p>
          <p><strong>Membership type:</strong> <?php echo $row['membership_type']; ?></p>
          <p><strong>Practitioner License:</strong> <?php echo $row['yes_licensure']; ?></p>
          <p><strong>Cv:</strong> <?php echo $row['cv_file']; ?></p>
          <!-- Add other fields as needed -->

          <!-- Edit Button -->
          <a href="edit_personal_info.php?id=<?php echo $userId; ?>" class="btn btn-primary">Edit</a>
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
<?php include("footer.php") ?>