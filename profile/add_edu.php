<?php include "navigation.php" ?>

<?php
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
        $sql = "INSERT INTO education (award, institution, year) VALUES ('$award', '$institution', '$year')";

        if ($conn->query($sql) === TRUE) {
            echo "<h3>Data has been successfully stored in the database!</h3>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close connection
        $conn->close();
    }
  
}

?>

<div class="container mt-5">
  <h2>Education Details</h2>
  <form action="add_edu.php" method="post">
    <div class="form-group">
      <label for="awardSelect">Award</label>
      <select class="form-control" id="awardSelect" name="award">
        <option value="Bachelor">Bachelor</option>
        <option value="Diploma">Diploma</option>
        <option value="Certificate">Certificate</option>
      </select>
    </div>
    <div class="form-group">
      <label for="institutionInput">Institution</label>
      <input type="text" class="form-control" id="institutionInput" placeholder="Enter institution" name="institution">
    </div>
    <div class="form-group">
      <label for="yearInput">Year of Graduation</label>
      <input type="text" class="form-control" id="yearInput" placeholder="Enter year of graduation" name="year">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

<?php include "footer.php" ?>