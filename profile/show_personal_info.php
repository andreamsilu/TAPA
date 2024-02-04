<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Start the session

if (!isset($_SESSION['id'])) {
    // Redirect to the login page if the user is not authenticated
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION['id']; // Use the stored user ID from the session
$userEmail = $_SESSION['email']; // Use the stored user ID from the session


include "../forms/connection.php";

// Get the user's information
$sql = "SELECT * FROM users WHERE id = $userID";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
<?php include("navigation.php"); ?>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5>User Profile</h5>
            </div>
            <div class="card-body">
                <div class="well">
                    <p><strong>Name:</strong> <?php echo $row['fullname']; ?></p>
                    <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
                    <p><strong>Phone:</strong> <?php echo $row['phone']; ?></p>
                    <p><strong>Postal Address:</strong> <?php echo $row['postal_address']; ?></p>
                    <p><strong>Date of Birth:</strong> <?php echo $row['birth_date']; ?></p>
                    <p><strong>Physical address:</strong> <?php echo $row['physical_address']; ?></p>
                    <p><strong>Membership type:</strong> <?php echo $row['membership_type']; ?></p>
                    <p><strong>Practitioner License:</strong> <?php echo $row['yes_licensure']; ?></p>
                    <p><strong>Cv:</strong> <?php echo $row['cv_file']; ?></p>
                    <!-- Add other fields as needed -->

                    <!-- Edit Button -->
                    <a href="edit_personal_info.php?id=<?php echo $userID; ?>" class="btn btn-primary">Edit</a>
                </div>
            </div>
        </div>
    </div>
<?php
} else {
    echo "User not found.";
}

$conn->close();

include("footer.php");
?>
