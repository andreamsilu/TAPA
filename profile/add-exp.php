
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

   session_start();
   include "../forms/connection.php";
   
   // Check if the user is authenticated
   if (!isset($_SESSION['user_id'])) {
       // Redirect to the login page if not authenticated
       header("Location: login.php");
       exit();
   }

   $userId = $_SESSION['user_id'];
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
    $sql = "INSERT INTO experience (company_name, position, start_date, end_date, job_description, user_id)
    VALUES ('$companyName', '$position', '$startDate', '$endDate', '$jobDescription', '$userId')";
    
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



<?php              
   include "navigation.php";
?>
<div class="card">
    <div class="card-header">
        <h5 class="card-title"><i class="bi bi-briefcase-fill"></i> Work Experience Details</h5>
    </div>
    <div class="card-body">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <form id="workExperienceForm" action="add-exp.php" method="post">
                        <!-- Company Name -->
                        <div class="form-group">
                            <label for="companyName"><i class="bi bi-building"></i> Company Name</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" required>
                        </div>

                        <!-- Position -->
                        <div class="form-group">
                            <label for="position"><i class="bi bi-briefcase"></i> Job title/position</label>
                            <input type="text" class="form-control" id="position" name="position" required>
                        </div>

                        <!-- Start Date -->
                        <div class="form-group">
                            <label for="startDate"><i class="bi bi-calendar"></i> Start Date</label>
                            <input type="date" class="form-control" id="startDate" name="startDate" placeholder="mm/dd/yyyy" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- End Date -->
                        <div class="form-group">
                            <label for="endDate"><i class="bi bi-calendar"></i> End Date</label>
                            <input type="date" class="form-control" id="endDate" name="endDate" placeholder="mm/dd/yyyy">
                        </div>

                        <!-- Job Description -->
                        <div class="form-group">
                            <label for="jobDescription"><i class="bi bi-card-text"></i> Job Description</label>
                            <textarea class="form-control" id="jobDescription" name="jobDescription" rows="4" required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>



