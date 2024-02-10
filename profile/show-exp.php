<?php
session_start();
include "navigation.php";
include "../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not authenticated
    header("Location: login.php");
    exit();
}
?>


<div class="container mt-5">
    <?php
    include "../forms/connection.php";

    // Get work experience information
    $sql = "SELECT * FROM experience";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
            <div class="card experience-card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center bg-light ">
                    <h4><i class="bi bi-briefcase-fill"></i> Work Experience</h4>
                    <!-- Edit Icon -->
                    <a href="add-exp.php" class="btn btn-primary"><i class="bi bi-plus"></i> Add</a>
                </div>
                <div class="card-body">
                    <p><strong><i class="bi bi-building"></i> Company:</strong> <?php echo $row['company_name']; ?></p>
                    <p><strong><i class="bi bi-person"></i> Position:</strong> <?php echo $row['position']; ?></p>
                    <p><strong><i class="bi bi-calendar"></i> Start Date:</strong> <?php echo $row['start_date']; ?></p>
                    <p><strong><i class="bi bi-calendar"></i> End Date:</strong> <?php echo ($row['end_date']) ? $row['end_date'] : 'Present'; ?></p>
                    <p><strong><i class="bi bi-card-text"></i> Job Description:</strong> <?php echo $row['job_description']; ?></p>
                    <a href="edit-exp.php?id=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="bi bi-pencil-fill"></i> Edit</a>
                    <a href="delete-exp.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</a>
                </div>
            </div>
    <?php
        }
    } else {
        echo "No work experience found.";
        echo " <a href='add-exp.php' class='btn btn-primary  align-items-center'>Add experience</a>";
    }

    // Close the database connection
    $conn->close();
    ?>
</div>



    <?php include("footer.php") ?>