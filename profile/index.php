<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../forms/connection.php');

try {
    // Check if the user is authenticated
    if (!isset($_SESSION['email'])) {
        throw new Exception("User is not authenticated.");
    }

    // Fetch user profile information including the profile picture
    $user_email = $_SESSION['email'];
    $query = "SELECT * FROM users WHERE email = '$user_email'";
    $result = $conn->query($query);

    if ($result === false) {
        throw new Exception("Error executing query: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $profile_picture = $row['profile_pic'];
        // Display user profile information including the profile picture
?>
        <?php
        include "navigation.php";
        ?>
        <div class="container mt-5 px-2">
            <div class="row">
                <div class="col-md-4">
                    <!-- <h2>Profile Page</h2> -->
                    <div class="profile-info p-2 pt-3">
                        <!-- Display profile picture if available or use placeholder avatar -->
                        <div class="profile-pic-container" style="background: url('../assets/img/tapa/ethics.jpg');background-size:cover;  background-position: center;background-repeat: no-repeat;">
                            <?php
                            // Display profile picture if available or use placeholder avatar
                            if (!empty($profile_picture)) {
                                echo '<a href="#" data-toggle="modal" data-target="#editProfileModal"><img src="' . $profile_picture . '" class="profile-pic" alt="Profile Picture"><i class="bi bi-pencil"></i></a>';
                            } else {
                                echo '<a href="#" data-toggle="modal" data-target="#addProfileModal"><img src="../assets/img/tapa/person1.png" class="profile-pic" alt="Placeholder Avatar"><i class="bi bi-pencil"></i></a>';
                            }
                            ?>
                        </div>
                        <?php
                        // Assuming $row contains user profile data fetched from the database

                        // Define the fields contributing to profile completion
                        $requiredFields = array('fullname', 'email', 'phone', 'profile_pic', 'cv');

                        // Calculate the percentage of completion
                        $totalFields = count($requiredFields);
                        $filledFields = 0;
                        foreach ($requiredFields as $field) {
                            if (!empty($row[$field])) {
                                $filledFields++;
                            }
                        }
                        $completionPercentage = ($filledFields / $totalFields) * 100;
                        ?>

                        <div class="progress mt-3 mb-3" style="height: 50px;">
                            <div class="progress-bar" role="progressbar" style="width: <?php echo $completionPercentage; ?>%;font-size: 25px;" aria-valuenow="<?php echo $completionPercentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $completionPercentage; ?>%</div>
                        </div>

                        <a href="edit_personal_info.php?id=<?php $userID; ?>" class="btn btn-primary  edit-info"><i class="bi bi-pencil-square"></i> Edit profile</a>
                    </div>


                    <!-- Add Profile Picture Modal -->
                    <div class="modal fade" id="addProfileModal" tabindex="-1" role="dialog" aria-labelledby="addProfileModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addProfileModalLabel"><i class="bi bi-plus"></i> Add Profile Picture</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="upload_profile_picture.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="profile-pic-input">Select Profile Picture:</label>
                                            <input type="file" name="profile_pic" id="profile-pic-input" class="form-control-file">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Profile Picture Modal -->
                    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editProfileModalLabel"><i class="bi bi-pencil"></i> Edit Profile Picture</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="upload_profile_picture.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="profile-pic-input">Select Profile Picture:</label>
                                            <input type="file" name="profile_pic" id="profile-pic-input" class="form-control-file">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Close profile-info div -->
                </div>
                <!-- Add more profile information fields as needed -->

                <div class="col-md-4">
                    <div class="profile-info bg-light w-100 p-2 m-3 border-info text-start">
                        <p><i class="bi bi-person m-3"></i> Name: <?php echo $row['fullname']; ?></p>
                    </div>
                    <div class="profile-info bg-light w-100 p-2 m-3 border-info">
                        <p><i class="bi bi-envelope"></i> Email: <?php echo $row['email']; ?></p>
                    </div>
                    <div class="profile-info bg-light w-100 p-2 m-3 border-info">
                        <p><i class="bi bi-phone"></i> Phone: <?php echo $row['phone']; ?></p>
                    </div>
                    <div class="profile-info bg-light w-100 p-2 m-3 border-info">
                        <p><i class="bi bi-person"></i> Membership: <?php echo $row['membership_type']; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                    // Assuming the selected year is provided via a POST or GET parameter named 'selected_year'

                    if (isset($_POST['selected_year'])) {
                        $selectedYear = $_POST['selected_year'];

                        // Fetch status and amount due for the selected year
                        $statusQuery = "SELECT status FROM payments WHERE YEAR(payment_date) = ?";
                        $amountQuery = "SELECT amount FROM payments WHERE YEAR(payment_date) = ?";

                        // Assuming $userId contains the user ID of the current user
                        $stmt = $conn->prepare($statusQuery);
                        $stmt->bind_param("i", $selectedYear);
                        $stmt->execute();
                        $statusResult = $stmt->get_result();

                        // Check if any rows are returned for status
                        if ($statusResult->num_rows > 0) {
                            $statusRow = $statusResult->fetch_assoc();
                            $status = $statusRow['status'];
                        } else {
                            $status = "No data available for the selected year";
                        }

                        $stmt = $conn->prepare($amountQuery);
                        $stmt->bind_param("i", $selectedYear);
                        $stmt->execute();
                        $amountResult = $stmt->get_result();

                        // Check if any rows are returned for amount
                        if ($amountResult->num_rows > 0) {
                            $amountRow = $amountResult->fetch_assoc();
                            $amountDue = $amountRow['amount'];
                        } else {
                            $amountDue = "No data available for the selected year";
                        }
                    }
                    ?>



                    <div class="profile-info bg-light w-100 p-2 m-3 border-info text-start">
                        <p><i class="bi bi-credit-card m-3"></i> ANNUAL MEMBERSHIP FEES</p>
                    </div>
                    <div class="profile-info bg-light w-100 p-2 m-3 border-info">
                        <!-- <p><i class="bi bi-calendar-check"></i> Select year</p> -->
                        <div class="form-group mr-2">
                            <form method="post" class="form-inline">
                                <div class="input-group m">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="bi bi-calendar-check"></i></span>
                                    </div>
                                    <select name="selected_year" id="selected_year" class="form-control">
                                        <option value="">Select year</option>
                                        <?php
                                        // Get the current year
                                        $currentYear = date('Y');

                                        // Generate options for years from 1900 to 2100
                                        for ($year = 2020; $year <= 2100; $year++) {
                                            // Check if the current year matches the iteration year
                                            $selected = ($year == $currentYear) ? 'selected' : '';
                                            echo '<option value="' . $year . '" ' . $selected . '>' . $year . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <button type="submit" class="btn btn-primary m">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="profile-info bg-light w-100 p-2 m-3 border-info">
                        <p><i class="bi bi-info-square"></i> Status: <?php echo isset($status) ? $status : "N/A"; ?></p>
                    </div>
                    <div class="profile-info bg-light w-100 p-2 m-3 border-info">
                        <p><i class="bi bi-cash"></i> Amount: <?php echo isset($amountDue) ? $amountDue : "N/A"; ?></p>
                    </div>
                </div>

            </div>
        </div>


        <div class="text-center mt-5 bg-success rounded pb-1 pt-2  fs-6 fw-bold text-white ">
            <h1>Membership updates</h1>
        </div>
        <!-- Close row div -->
        <!-- Close container div -->
    <?php
    } else {
        throw new Exception("No user profile found.");
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn->close();

?>
<style>

</style>
<div class="container mt-3 mb-5 p-3">
    <div class="row">
        <div class="col-md-4">
            <div class="card slide-from-left">
                <div class="card-body">
                    <h5 class="card-title">Update 1</h5>
                    <p class="card-text">This is the content of update 1.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card slide-from-left">
                <div class="card-body">
                    <h5 class="card-title">Update 2</h5>
                    <p class="card-text">This is the content of update 2.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card slide-from-left">
                <div class="card-body">
                    <h5 class="card-title">Update 3</h5>
                    <p class="card-text">This is the content of update 3.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include("footer.php");
?>
