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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $userId = $_POST['user_id'];

        // Collect form data
        // Collect form data
        $fullname = filter_input(INPUT_POST, 'fullname', FILTER_DEFAULT);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_DEFAULT);
        $postalAddress = filter_input(INPUT_POST, 'postal_address', FILTER_DEFAULT);
        $birthDate = filter_input(INPUT_POST, 'birth_date', FILTER_DEFAULT);
        $physicalAddress = filter_input(INPUT_POST, 'physical_address', FILTER_DEFAULT);
        $membershipType = filter_input(INPUT_POST, 'membership_type', FILTER_DEFAULT);
        $licensure = filter_input(INPUT_POST, 'licensure', FILTER_DEFAULT);
        $yesLicensure = filter_input(INPUT_POST, 'yes_licensure', FILTER_DEFAULT);
        $crime = filter_input(INPUT_POST, 'crime', FILTER_DEFAULT);
        $yesCrime = filter_input(INPUT_POST, 'yes_crime', FILTER_DEFAULT);
        $cvFileName = $_FILES["cv"]["name"];


        // $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Handle file upload
        if (!empty($cvFileName)) {
            $targetDir = "../forms/uploads/";
            $targetFilePath = $targetDir . $cvFileName;
            move_uploaded_file($_FILES["cv"]["tmp_name"], $targetFilePath);
        }

        // Update user information in the database
        $sql = "UPDATE users SET fullname='$fullname', email='$email', phone='$phone', postal_address='$postalAddress',
                birth_date='$birthDate', physical_address='$physicalAddress', membership_type='$membershipType',
                licensure='$licensure', yes_licensure='$yesLicensure', crime='$crime', yes_crime='$yesCrime',
                cv_file='$cvFileName', password='$hashedPassword' WHERE id='$userId'";

        if ($conn->query($sql) !== TRUE) {
            throw new Exception("Error updating user information: " . $conn->error);
        }

        // Redirect to the user profile page after successful update
        header("Location: index.php?id=$userId");
        exit();
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}

// Get the user's information for pre-filling the form
$userId = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = $userId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "User not found.";
}

// Close the database connection
$conn->close();
?>

<?php include("navigation.php") ?>

<div class="container mt-5">
    <h2>Edit User Information</h2>

    <form method="post" enctype="multipart/form-data" style="margin: 30px;">
        <input type="hidden" name="user_id" value="<?php echo $userId; ?>">

        <div class="row">
            <div class="col-md-6 form-group">
                <label for="fullname" class="col-form-label"><i class="bi bi-person"></i> Full Name</label>
                <input type="text" name="fullname" class="form-control" id="name" value="<?php echo $row['fullname']; ?>" required>
            </div>

            <div class="col-md-6 form-group mt-3 mt-md-0">
                <label for="email" class="col-form-label"><i class="bi bi-envelope"></i> Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 form-group mt-3 mt-md-0">
                <label for="phone" class="col-form-label"><i class="bi bi-telephone"></i> Phone</label>
                <input type="phone" class="form-control" name="phone" id="phone" value="<?php echo $row['phone']; ?>" required>
            </div>

            <div class=" col-md-6 form-group mt-3 mt-md-0">
                <label for="postal_address" class="col-form-label"><i class="bi bi-house-door"></i> Postal Address</label>
                <input type="text" class="form-control" name="postal_address" id="postal_addrress" placeholder="Postal address" value="<?php echo $row['postal_address']; ?>" required>
            </div>
        </div>

        <div class="form-group mt-3 mt-md-0">
            <label for="birth_date" class="col-form-label"><i class="bi bi-calendar"></i> Birth date</label>
            <input type="date" class="form-control" name="birth_date" id="birth_date" value="<?php echo $row['birth_date']; ?>" required>
        </div>

        <div class="row">
            <div class="col-md-6 form-group mt-3 mt-md-0">
                <label for="physical_address" class="col-form-label"><i class="bi bi-house"></i> Physical Address</label>
                <input type="text" class="form-control" name="pysical_address" id="physical_address" value="<?php echo $row['physical_address']; ?>" required>
            </div>

            <div class="col-md-6 form-group mt-3 mt-md-0">
                <label for="membership_type" class="col-form-label">Select Membership category</label>
                <select class="form-control" id="membership_type" name="membership_type" required>
                    <option value="" disabled selected>Select membership category</option>

                    <option value="full_member" <?php echo ($row['membership_type'] == 'full_member') ? 'selected' : ''; ?>>Full Member</option>
                    <option value="associate_one" <?php echo ($row['membership_type'] == 'associate_one') ? 'selected' : ''; ?>>Associate member I</option>
                    <option value="associate_two" <?php echo ($row['membership_type'] == 'associate_two') ? 'selected' : ''; ?>>Associate Member II</option>
                    <option value="student" <?php echo ($row['membership_type'] == 'student') ? 'selected' : ''; ?>>Student Member</option>
                    <option value="local_affiliate" <?php echo ($row['membership_type'] == 'local_affiliate') ? 'selected' : ''; ?>>Local Affiliate Member</option>
                    <option value="foreign_affiliate" <?php echo ($row['membership_type'] == 'foreign_affiliate') ? 'selected' : ''; ?>>Foreign Affiliate Member</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="row">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                    <label for="licensure" class="col-form-label">Licensure/Ethics <br> Are you licensed as a psychologist by a state or provincial psychology board outside of Tanzania?</label>
                    <div>
                        <input type="radio" name="licensure" value="yes" id="licensure_yes" <?php echo ($row['licensure'] == 'yes') ? 'checked' : ''; ?> required>
                        <label for="licensure_yes">Yes</label>
                    </div>
                    <div>
                        <input type="radio" name="licensure" value="no" id="licensure_no" <?php echo ($row['licensure'] == 'no') ? 'checked' : ''; ?> required>
                        <label for="licensure_no">No</label>
                    </div>

                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                    <label for="yes_crime" class="col-form-label"><i class="bi bi-exclamation-triangle"></i> If Yes, please explain below</label>
                    <textarea class="form-control" name="yes_crime" rows="3" value="<?php echo $row['yes_licensure']; ?>"></textarea>
                </div>



                <div class="row">
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        <label for="crimes" class="col-form-label"> Crimes <br> Have you at any time been convicted of a crime, sanctioned by any professional ethics body, licensing board, regulatory body, professional/scientific organization, or supervisory group for unethical behavior?</label>
                        <div>
                            <input type="radio" name="crime" value="yes" id="crime_yes" <?php echo ($row['crime'] == 'yes') ? 'checked' : ''; ?> required>
                            <label for="crime_yes">Yes</label>
                        </div>
                        <div>
                            <input type="radio" name="crime" value="no" id="crime_no" <?php echo ($row['crime'] == 'no') ? 'checked' : ''; ?> required>
                            <label for="crime_no">No</label>
                        </div>
                    </div>
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        <label for="yes_crime" class="col-form-label"><i class="bi bi-exclamation-triangle"></i> If Yes, please explain below</label>
                        <textarea class="form-control" name="yes_crime" rows="3" value="<?php echo $row['yes_crime']; ?>"></textarea>
                    </div>
                </div>

                <div class=" col-md-6 form-group mt-3 mt-md-0">
                    <label for="cv" class="col-form-label"><i class="bi bi-file-earmark-pdf"></i> Upload your CV</label>
                    <input type="file" class="form-control" name="cv" id="cv" accept=".pdf,.doc,.docx" >
                    <small class="text-muted">Accepted file formats: PDF, DOC, DOCX <span>value="<?php echo $row['cv_file']; ?>"</span></small>
                </div>

                <div class=" col-md-6 form-group mt-5 mt-md-5 ">
                </div>
                <button type="submit" class="btn btn-primary float-right">Update</button>

            </div>
    </form>
</div>
<?php include('footer.php'); ?>