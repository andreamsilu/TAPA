<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['id'];
    $award = htmlspecialchars($_POST['award']);
    $institution = htmlspecialchars($_POST['institution']);
    $year = htmlspecialchars($_POST['year']);

    // Validate the form data (you can add more validation as needed)
    if (empty($award) || empty($institution) || empty($year)) {
        echo "All fields are required.";
    } else {
      include "../forms/connection.php";


        // Prepare and execute SQL query to update data in the 'education' table
        $sql = "UPDATE education SET award='$award', institution='$institution', year='$year' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "<h3>Data has been successfully updated in the database!</h3>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
} else {
    // Redirect or handle the case when the form is not submitted through a POST request
    echo "Invalid request.";
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Education Details</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <h2>Edit Education Details</h2>

  <?php
  // Retrieve education details from the database based on the ID
  $id = $_GET['id']; // Assuming you are passing the ID through the URL

  // Database connection settings
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "TAPA_DB";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Retrieve existing data from the database
  $sql = "SELECT * FROM education WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
  ?>
  <form method="post" action="update_data.php">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="form-group">
      <label for="awardSelect">Award</label>
      <select class="form-control" id="awardSelect" name="award">
        <option value="Bachelor" <?php echo ($row['award'] == 'Bachelor') ? 'selected' : ''; ?>>Bachelor</option>
        <option value="Diploma" <?php echo ($row['award'] == 'Diploma') ? 'selected' : ''; ?>>Diploma</option>
        <option value="Certificate" <?php echo ($row['award'] == 'Certificate') ? 'selected' : ''; ?>>Certificate</option>
      </select>
    </div>
    <div class="form-group">
      <label for="institutionInput">Institution</label>
      <input type="text" class="form-control" id="institutionInput" placeholder="Enter institution" name="institution" value="<?php echo $row['institution']; ?>">
    </div>
    <div class="form-group">
      <label for="yearInput">Year of Graduation</label>
      <input type="text" class="form-control" id="yearInput" placeholder="Enter year of graduation" name="year" value="<?php echo $row['year']; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
  </form>
  <?php
  } else {
      echo "No data found.";
  }

  // Close connection
  $conn->close();
  ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
