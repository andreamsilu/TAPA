<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Start the session

if (!isset($_SESSION['email']) && !isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not authenticated
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION['user_id']; // Use the stored user ID from the session
$userEmail = $_SESSION['email']; // Use the stored user email from the session

include "../forms/connection.php";

// Get the user's information based on both ID and email
$sql = "SELECT * FROM users WHERE id = $userID AND email = '$userEmail' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
<?php include("navigation.php"); ?>
<style>
    i{
        color: #0F718A;
    }
</style>
<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5><i class="bi bi-person-circle"></i>  User Profile</h5>
            <a href="edit_personal_info.php?id=<?php echo $userID; ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
        </div>
        <div class="card-body">
            <div class="well">
                <div class="row">
                    <div class="col-md-6">
                        <p class="border-bottom"><strong><i class="bi bi-person-circle"></i> Name:</strong> <?php echo $row['fullname']; ?></p>
                        <p class="border-bottom"><strong><i class="bi bi-envelope"></i> Email:</strong> <?php echo $row['email']; ?></p>
                        <p class="border-bottom"><strong><i class="bi bi-telephone"></i> Phone:</strong> <?php echo $row['phone']; ?></p>
                        <p class="border-bottom"><strong><i class="bi bi-geo-alt"></i> Postal Address:</strong> <?php echo $row['postal_address']; ?></p>
                        <p class="border-bottom"><strong><i class="bi bi-calendar"></i> Date of Birth:</strong> <?php echo $row['birth_date']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class="border-bottom"><strong><i class="bi bi-geo-alt"></i> Physical address:</strong> <?php echo $row['physical_address']; ?></p>
                        <p class="border-bottom"><strong><i class="bi bi-person"></i> Membership type:</strong> <?php echo $row['membership_type']; ?></p>
                        <p class="border-bottom"><strong><i class="bi bi-card-checklist"></i> Practitioner License:</strong> <?php echo $row['yes_licensure']; ?></p>
                        <p class="border-bottom"><strong><i class="bi bi-file-earmark"></i> Cv:</strong> <?php echo $row['cv_file']; ?></p>
                        <!-- Add other fields as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
} else {
    echo "User not found.";
  echo " <a href='add_personal_info.php' class='btn btn-primary'>Add Personal Info</a>";

}

$conn->close();

include("footer.php");
?>
