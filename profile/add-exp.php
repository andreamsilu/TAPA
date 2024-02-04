<?php include("navigation.php"); ?>

<?php
   include "../forms/connection.php";


// Function to sanitize form data
function sanitizeData($data) {
    return htmlspecialchars(trim($data));
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $companyName = sanitizeData($_POST["companyName"]);
    $position = sanitizeData($_POST["position"]);
    $startDate = sanitizeData($_POST["startDate"]);
    $endDate = sanitizeData($_POST["endDate"]);
    $jobDescription = sanitizeData($_POST["jobDescription"]);

    // SQL query to insert data into the database
    $sql = "INSERT INTO experience (company_name, position, start_date, end_date, job_description) VALUES ('$companyName', '$position', '$startDate', '$endDate', '$jobDescription')";

    if ($conn->query($sql) === TRUE) {
        echo "Work experience saved successfully";
        header('Location: show-exp.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>




<div class="container mt-5">
  <form id="workExperienceForm"  action="add-exp.php" method="post">
    <!-- Company Name -->
    <div class="form-group">
      <label for="companyName">Company Name</label>
      <input type="text" class="form-control" id="companyName" name="companyName" required>
    </div>

    <!-- Position -->
    <div class="form-group">
      <label for="position">Job title/position</label>
      <input type="text" class="form-control" id="position" name="position" required>
    </div>

    <!-- Start Date -->
    <div class="form-group">
      <label for="startDate">Start Date</label>
      <input type="date" class="form-control" id="startDate" name="startDate" placeholder="mm/dd/yyyy" required>
    </div>

    <!-- End Date -->
    <div class="form-group">
      <label for="endDate">End Date</label>
      <input type="date" class="form-control" id="endDate" name="endDate" placeholder="mm/dd/yyyy">
    </div>

    <!-- Job Description -->
    <div class="form-group">
      <label for="jobDescription">Job Description</label>
      <textarea class="form-control" id="jobDescription" name="jobDescription" rows="4" required></textarea>
    </div>

    <!-- Submit Button -->
    <button type="button" class="btn btn-primary">Submit</button>
  </form>
</div>


<script>
  function submitForm() {
    // You can add your database-saving logic here
    // Example: Send the form data to a server using AJAX
    var formData = $("#workExperienceForm").serialize();
    $.ajax({
      type: "POST",
      url: "/save-work-experience.php", // Replace with your actual backend endpoint
      data: formData,
      success: function(response) {
        alert("Work experience saved successfully!");
        // Add any other logic you need after successful submission
      },
      error: function(error) {
        console.error("Error saving work experience:", error);
        // Handle errors here
      }
    });
  }
</script>

<?php include("footer.php"); ?>

