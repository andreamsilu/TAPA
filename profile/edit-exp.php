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

// Check if an experience ID is provided in the URL
if (!isset($_GET['id'])) {
    echo "Experience ID not provided.";
    exit();
}

$userId = $_SESSION['user_id'];
$experienceId = $_GET['id'];

// Retrieve the existing experience details
$sql = "SELECT * FROM experience WHERE id = $experienceId AND user_id = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Process form data when the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $companyName = htmlspecialchars($_POST["companyName"]);
        $position = htmlspecialchars($_POST["position"]);
        $startDate = htmlspecialchars($_POST["startDate"]);
        $endDate = htmlspecialchars($_POST["endDate"]);
        $jobDescription = htmlspecialchars($_POST["jobDescription"]);

        // SQL query to update experience data
        $updateSql = "UPDATE experience SET
                      company_name = '$companyName',
                      position = '$position',
                      start_date = '$startDate',
                      end_date = '$endDate',
                      job_description = '$jobDescription'
                      WHERE id = $experienceId AND user_id = $userId";

        if ($conn->query($updateSql) === TRUE) {
            echo "Experience updated successfully!";
            header("Location: show-exp.php");
        } else {
            echo "Error updating experience: " . $conn->error;
        }
    }
} else {
    echo "Experience not found for the provided ID and user.";
}

// Close the database connection
$conn->close();
?>
<?php 
include "navigation.php";
?>
<!-- HTML form for editing experience details -->
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5><i class="bi bi-briefcase-fill"></i> Edit Experience</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form id="editExperienceForm" action="edit-exp.php?id=<?php echo $experienceId; ?>" method="post">
                        <!-- Company Name -->
                        <div class="form-group">
                            <label for="companyName"><i class="bi bi-building"></i> Company Name</label>
                            <input type="text" class="form-control" id="companyName" name="companyName" value="<?php echo $row['company_name']; ?>" required>
                        </div>

                        <!-- Position -->
                        <div class="form-group">
                            <label for="position"><i class="bi bi-briefcase"></i> Job title/position</label>
                            <input type="text" class="form-control" id="position" name="position" value="<?php echo $row['position']; ?>" required>
                        </div>

                        <!-- Start Date -->
                        <div class="form-group">
                            <label for="startDate"><i class="bi bi-calendar"></i> Start Date</label>
                            <input type="date" class="form-control" id="startDate" name="startDate" value="<?php echo $row['start_date']; ?>" required>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    <!-- End Date -->
                    <div class="form-group">
                        <label for="endDate"><i class="bi bi-calendar"></i> End Date</label>
                        <input type="date" class="form-control" id="endDate" name="endDate" value="<?php echo $row['end_date']; ?>">
                    </div>

                    <!-- Job Description -->
                    <div class="form-group">
                        <label for="jobDescription"><i class="bi bi-card-text"></i> Job Description</label>
                        <textarea class="form-control" id="jobDescription" name="jobDescription" rows="4" required><?php echo $row['job_description']; ?></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Update Experience</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
