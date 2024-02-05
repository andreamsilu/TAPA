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
    <form id="contactInfoForm" action="add-cont.php" method="post">
        <div class="row">
            <!-- Column 1 -->
            <div class="col-md-6">
                <!-- Mobile 1 -->
                <div class="form-group">
                    <label for="mobile1">Mobile 1</label>
                    <input type="tel" class="form-control" id="mobile1" name="mobile1"  required>
                </div>

                <!-- Mobile 2 -->
                <div class="form-group">
                    <label for="mobile2">Mobile 2</label>
                    <input type="tel" class="form-control" id="mobile2" name="mobile2"  required>
                </div>

                <!-- Whatsapp Number -->
                <div class="form-group">
                    <label for="whatsappNumber">Whatsapp Number</label>
                    <input type="tel" class="form-control" id="whatsappNumber" name="whatsappNumber"  required>
                </div>

                <!-- Secondary Email -->
                <div class="form-group">
                    <label for="secondaryEmail">Secondary Email</label>
                    <input type="email" class="form-control" id="secondaryEmail" name="secondaryEmail"  required>
                </div>

                <!-- Work Email -->
                <div class="form-group">
                    <label for="workEmail">Work Email</label>
                    <input type="email" class="form-control" id="workEmail" name="workEmail"  required>
                </div>
            </div>

            <!-- Column 2 -->
            <div class="col-md-6">
                <!-- Country of Residence -->
                <div class="form-group">
                    <label for="countryResidence">Country of Residence</label>
                    <input type="text" class="form-control" id="countryResidence" name="countryResidence"  required>
                </div>

                <!-- State of Residence -->
                <div class="form-group">
                    <label for="stateResidence">State of Residence</label>
                    <input type="text" class="form-control" id="stateResidence" name="stateResidence"  required>
                </div>

                <!-- City of Residence -->
                <div class="form-group">
                    <label for="cityResidence">City of Residence</label>
                    <input type="text" class="form-control" id="cityResidence" name="cityResidence"  required>
                </div>

                <!-- Area of Residence -->
                <div class="form-group">
                    <label for="areaResidence">Area of Residence</label>
                    <input type="text" class="form-control" id="areaResidence" name="areaResidence"  required>
                </div>

                <!-- ZIP Code / PO Box -->
                <div class="form-group">
                    <label for="zipCode">ZIP Code / PO Box</label>
                    <input type="text" class="form-control" id="zipCode" name="zipCode"  required>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

