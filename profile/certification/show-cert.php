<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>View Certification Information</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <h2>Certification Information</h2>
  <?php
     include "../forms/connection.php";


  // Fetch certification information from the database
  $sql = "SELECT * FROM certification_info";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      echo '<div class="table-responsive">';
      echo '<table class="table table-bordered table-striped">';
      echo '<thead>';
      echo '<tr>';
      echo '<th>Certification Name</th>';
      echo '<th>Certification Authority</th>';
      echo '<th>Certification Date</th>';
      echo '<th>Expiration Date</th>';
      echo '<th>Action</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';

      while ($row = $result->fetch_assoc()) {
          echo '<tr>';
          echo '<td>' . $row['certification_name'] . '</td>';
          echo '<td>' . $row['certification_authority'] . '</td>';
          echo '<td>' . $row['certification_date'] . '</td>';
          echo '<td>' . ($row['expiration_date'] ? $row['expiration_date'] : 'N/A') . '</td>';
          echo '<td><a href="edit_certification.php?id=' . $row['id'] . '" class="btn btn-warning">Edit</a></td>';
          echo '</tr>';
      }

      echo '</tbody>';
      echo '</table>';
      echo '</div>';
  } else {
      echo "No certification information found.";
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
