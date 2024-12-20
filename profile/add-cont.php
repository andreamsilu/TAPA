<?php
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
function sanitizeData($data)
{
    return htmlspecialchars(trim($data));
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile1 = sanitizeData($_POST["mobile1"]);
    $mobile2 = sanitizeData($_POST["mobile2"]);
    $whatsappNumber = sanitizeData($_POST["whatsappNumber"]);
    $secondaryEmail = sanitizeData($_POST["secondaryEmail"]);
    $workEmail = sanitizeData($_POST["workEmail"]);
    $countryResidence = sanitizeData($_POST["countryResidence"]);
    $stateResidence = sanitizeData($_POST["stateResidence"]);
    $cityResidence = sanitizeData($_POST["cityResidence"]);
    $areaResidence = sanitizeData($_POST["areaResidence"]);
    $zipCode = sanitizeData($_POST["zipCode"]);

    // SQL query to insert data into the database
    $sql = "INSERT INTO contact_info (mobile1, mobile2, whatsapp_number, secondary_email, work_email, country_residence, state_residence, city_residence, area_residence, zip_code,user_id) 
            VALUES ('$mobile1', '$mobile2', '$whatsappNumber', '$secondaryEmail', '$workEmail', '$countryResidence', '$stateResidence', '$cityResidence', '$areaResidence', '$zipCode','$userId')";

    if ($conn->query($sql) === TRUE) {
        echo "Contact information saved successfully";
        header("Location: show-cont.php");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<?php 
include('navigation.php');
?>

<div class="container mt-5">
    <div class="card">
    <div class="card-header">
            <h4><i class="bi bi-file-earmark-plus"></i> Add contact information</h4>
        </div>
        <div class="card-body">
            <form id="contactInfoForm" action="add-cont.php" method="post">
                <div class="row">
                    <!-- Column 1 -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="mobile1"><i class="bi bi-phone"></i> Mobile 1</label>
                            <input type="tel" class="form-control" id="mobile1" name="mobile1" required>
                        </div>

                        <div class="form-group">
                            <label for="mobile2"><i class="bi bi-phone"></i> Mobile 2</label>
                            <input type="tel" class="form-control" id="mobile2" name="mobile2" required>
                        </div>

                        <div class="form-group">
                            <label for="whatsappNumber"><i class="bi bi-whatsapp"></i> Whatsapp Number</label>
                            <input type="tel" class="form-control" id="whatsappNumber" name="whatsappNumber" required>
                        </div>

                        <div class="form-group">
                            <label for="secondaryEmail"><i class="bi bi-envelope"></i> Secondary Email</label>
                            <input type="email" class="form-control" id="secondaryEmail" name="secondaryEmail" required>
                        </div>

                        <div class="form-group">
                            <label for="workEmail"><i class="bi bi-envelope"></i> Work Email</label>
                            <input type="email" class="form-control" id="workEmail" name="workEmail" required>
                        </div>
                    </div>

                    <!-- Column 2 -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="countryResidence"><i class="bi bi-globe"></i> Country of Residence</label>
                            <input type="text" class="form-control" id="countryResidence" name="countryResidence" required>
                        </div>

                        <div class="form-group">
                            <label for="stateResidence"><i class="bi bi-map"></i> State of Residence</label>
                            <input type="text" class="form-control" id="stateResidence" name="stateResidence" required>
                        </div>

                        <div class="form-group">
                            <label for="cityResidence"><i class="bi bi-map"></i> City of Residence</label>
                            <input type="text" class="form-control" id="cityResidence" name="cityResidence" required>
                        </div>

                        <div class="form-group">
                            <label for="areaResidence"><i class="bi bi-map"></i> Area of Residence</label>
                            <input type="text" class="form-control" id="areaResidence" name="areaResidence" required>
                        </div>

                        <div class="form-group">
                            <label for="zipCode"><i class="bi bi-envelope"></i> ZIP Code / PO Box</label>
                            <input type="text" class="form-control" id="zipCode" name="zipCode" required>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Submit</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php') ?>
