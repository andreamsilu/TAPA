<?php
 session_start();
 include "../forms/connection.php";
 
 // Check if the user is authenticated
 if (!isset($_SESSION['user_id'])) {
     // Redirect to the login page if not authenticated
     header("Location: login.php");
     exit();
 }
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
            header("Location:show_edu.php");
        } else {  // Retrieve education details from the database based on the ID

            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
}
?>

<?php 
 include "navigation.php";
?>
<div class="container mt-5">

  <?php
  $id = $_GET['id']; // Assuming you are passing the ID through the URL

  include "../forms/connection.php";

  // Retrieve existing data from the database
  $sql = "SELECT * FROM education WHERE id = $id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
  ?>
  <div class="card">
    <div class="card-header">
        <h4><i class="bi bi-pencil-square"></i>Edit Education Details</h4>
    </div>
    <div class="card-body">
        <form method="post" action="edit_edu.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="awardSelect"><i class="bi bi-award-fill"></i> Award</label>
                <select class="form-control" id="awardSelect" name="award">
                    <option value="Bachelor" <?php echo ($row['award'] == 'Bachelor') ? 'selected' : ''; ?>>Bachelor</option>
                    <option value="Diploma" <?php echo ($row['award'] == 'Diploma') ? 'selected' : ''; ?>>Diploma</option>
                    <option value="Certificate" <?php echo ($row['award'] == 'Certificate') ? 'selected' : ''; ?>>Certificate</option>
                </select>
            </div>
            <div class="form-group">
                <label for="institutionInput"><i class="bi bi-building"></i> Institution</label>
                <input type="text" class="form-control" id="institutionInput" placeholder="Enter institution" name="institution" value="<?php echo $row['institution']; ?>">
            </div>
            <div class="form-group">
                <label for="yearInput"><i class="bi bi-calendar-check"></i> Year of Graduation</label>
                <input type="text" class="form-control" id="yearInput" placeholder="Enter year of graduation" name="year" value="<?php echo $row['year']; ?>">
            </div>
            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
        </form>
    </div>
</div>

  <?php
  } else {
      echo "No data found.";
  }

  // Close connection
  $conn->close();
  ?>
</div>

<?php include("footer.php") ?>