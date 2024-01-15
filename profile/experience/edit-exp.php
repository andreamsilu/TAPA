<?php
   include "../forms/connection.php";


// Function to sanitize form data
function sanitizeData($data) {
    return htmlspecialchars(trim($data));
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $workExperienceId = sanitizeData($_POST["id"]);
    $companyName = sanitizeData($_POST["companyName"]);
    $position = sanitizeData($_POST["position"]);
    $startDate = sanitizeData($_POST["startDate"]);
    $endDate = sanitizeData($_POST["endDate"]);
    $jobDescription = sanitizeData($_POST["jobDescription"]);

    // SQL query to update data in the database
    $sql = "UPDATE experience SET company_name = '$companyName', position = '$position', start_date = '$startDate', end_date = '$endDate', job_description = '$jobDescription' WHERE id = $workExperienceId";

    if ($conn->query($sql) === TRUE) {
        echo "Work experience updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Work Experience</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <?php
  // Replace these values with your actual database credentials
  $servername = "your_database_server";
  $username = "your_username";
  $password = "your_password";
  $database = "your_database_name";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Get the record to be edited
  $workExperienceId = $_GET['id'];
  $sql = "SELECT * FROM work_experience WHERE id = $workExperienceId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
  ?>
    <form id="editWorkExperienceForm">
      <!-- Company Name -->
      <div class="form-group">
        <label for="companyName">Company Name</label>
        <input type="text" class="form-control" id="companyName" name="companyName" value="<?php echo $row['company_name']; ?>" required>
      </div>

      <!-- Position -->
      <div class="form-group">
        <label for="position">Position</label>
        <input type="text" class="form-control" id="position" name="position" value="<?php echo $row['position']; ?>" required>
      </div>

      <!-- Start Date -->
      <div class="form-group">
        <label for="startDate">Start Date</label>
        <input type="text" class="form-control" id="startDate" name="startDate" placeholder="mm/dd/yyyy" value="<?php echo $row['start_date']; ?>" required>
      </div>

      <!-- End Date -->
      <div class="form-group">
        <label for="endDate">End Date</label>
        <input type="text" class="form-control" id="endDate" name="endDate" placeholder="mm/dd/yyyy" value="<?php echo $row['end_date']; ?>">
      </div>

      <!-- Job Description -->
      <div class="form-group">
        <label for="jobDescription">Job Description</label>
        <textarea class="form-control" id="jobDescription" name="jobDescription" rows="4" required><?php echo $row['job_description']; ?></textarea>
      </div>

      <!-- Submit Button -->
      <button type="button" class="btn btn-primary" onclick="updateForm()">Update</button>
    </form>
  <?php
  } else {
      echo "Work experience not found.";
  }

  // Close the database connection
  $conn->close();
  ?>

</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
  function updateForm() {
    // You can add your database-updating logic here
    // Example: Send the updated form data to a server using AJAX
    var formData = $("#editWorkExperienceForm").serialize();
    $.ajax({
      type: "POST",
      url: "/update-work-experience.php", // Replace with your actual backend endpoint
      data: formData,
      success: function(response) {
        alert("Work experience updated successfully!");
        // Add any other logic you need after successful update
      },
      error: function(error) {
        console.error("Error updating work experience:", error);
        // Handle errors here
      }
    });
  }
</script>

</body>
</html>
