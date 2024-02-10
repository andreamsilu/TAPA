<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
  // Redirect to the login page if not authenticated
  header("Location: login.php");
  exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $award = htmlspecialchars($_POST['award']);
  $institution = htmlspecialchars($_POST['institution']);
  $year = htmlspecialchars($_POST['year']);

  // Validate the form data (you can add more validation as needed)
  if (empty($award) || empty($institution) || empty($year)) {
    echo "All fields are required.";
  } else {
    include "../forms/connection.php";

    // Prepare and execute SQL query to insert data into the 'education' table
    $sql = "INSERT INTO education (award, institution, year, user_id) VALUES ('$award', '$institution', '$year', '$userId')";

    if ($conn->query($sql) === TRUE) {
      echo "<h3>Data has been successfully stored in the database!</h3>";
      header('Location:show_edu.php');
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
  }
}
?>

<?php include("navigation.php"); ?>
<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      <h4><i class="bi bi-journal-text"></i> Education Details</h4>
    </div>
    <div class="card-body">
      <form action="add_edu.php" method="post">
        <div class="form-group">
          <label for="awardSelect"><i class="bi bi-award"></i> Award</label>
          <select class="form-control" id="awardSelect" name="award">
            <option value="Bachelor">Bachelor</option>
            <option value="Diploma">Diploma</option>
            <option value="Certificate">Certificate</option>
          </select>
        </div>
        <div class="form-group">
          <label for="institutionInput"><i class="bi bi-building"></i> Institution</label>
          <input type="text" class="form-control" id="institutionInput" placeholder="Enter institution" name="institution">
        </div>
        <div class="form-group">
          <label for="yearInput"><i class="bi bi-calendar-check"></i> Year of Graduation</label>
          <input type="text" class="form-control" id="yearInput" placeholder="Enter year of graduation" name="year">
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Submit</button>
      </form>
    </div>
  </div>
</div>

<?php include "footer.php" ?>