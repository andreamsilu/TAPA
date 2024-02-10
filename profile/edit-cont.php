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
function sanitizeData($data)
{
    return htmlspecialchars(trim($data));
}

// Process form data for updating contact information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contactId = sanitizeData($_POST["contactId"]);
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

    // SQL query to update contact information in the database
    $sql = "UPDATE contact_info 
            SET mobile1 = '$mobile1', mobile2 = '$mobile2', whatsapp_number = '$whatsappNumber', 
                secondary_email = '$secondaryEmail', work_email = '$workEmail', 
                country_residence = '$countryResidence', state_residence = '$stateResidence', 
                city_residence = '$cityResidence', area_residence = '$areaResidence', zip_code = '$zipCode' 
            WHERE id = $contactId AND user_id = $userId";

    if ($conn->query($sql) === TRUE) {
        echo "Contact information updated successfully";
    header("Location: show-cont.php");

    } else {
        echo "Error updating contact information: " . $conn->error;
    }
}

// Get the contact ID from the URL
$contactId = isset($_GET['id']) ? $_GET['id'] : null;

// Get the existing contact information for editing
$sql = "SELECT * FROM contact_info WHERE id = $contactId AND user_id = {$_SESSION['user_id']}";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    // Redirect to the contact list page if the contact ID is not valid
    header("Location: contact-list.php");
    exit();
}

$conn->close();
?>
<?php
include "navigation.php";
?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2> <i class="bi bi-pencil-square"></i>Edit Contact Information</h2>
        </div>
        <div class="card-body">
            <form id="editContactForm" action="edit-cont.php" method="post">
                <input type="hidden" name="contactId" value="<?php echo $contactId; ?>">
                <!-- Contact Details -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="mobile1"><i class="bi bi-telephone"></i> Mobile 1</label>
                        <input type="text" class="form-control" id="mobile1" name="mobile1" value="<?php echo $row['mobile1']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="mobile2"><i class="bi bi-telephone"></i> Mobile 2</label>
                        <input type="text" class="form-control" id="mobile2" name="mobile2" value="<?php echo $row['mobile2']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="whatsappNumber"><i class="bi bi-whatsapp"></i> Whatsapp Number</label>
                        <input type="text" class="form-control" id="whatsappNumber" name="whatsappNumber" value="<?php echo $row['whatsapp_number']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="secondaryEmail"><i class="bi bi-envelope"></i> Secondary Email</label>
                        <input type="email" class="form-control" id="secondaryEmail" name="secondaryEmail" value="<?php echo $row['secondary_email']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="workEmail"><i class="bi bi-envelope"></i> Work Email</label>
                        <input type="email" class="form-control" id="workEmail" name="workEmail" value="<?php echo $row['work_email']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="countryResidence"><i class="bi bi-globe"></i> Country of Residence</label>
                        <input type="text" class="form-control" id="countryResidence" name="countryResidence" value="<?php echo $row['country_residence']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="stateResidence"><i class="bi bi-geo-alt"></i> State of Residence</label>
                        <input type="text" class="form-control" id="stateResidence" name="stateResidence" value="<?php echo $row['state_residence']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="cityResidence"><i class="bi bi-geo-alt"></i> City of Residence</label>
                        <input type="text" class="form-control" id="cityResidence" name="cityResidence" value="<?php echo $row['city_residence']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="areaResidence"><i class="bi bi-geo-alt"></i> Area of Residence</label>
                        <input type="text" class="form-control" id="areaResidence" name="areaResidence" value="<?php echo $row['area_residence']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="zipCode"><i class="bi bi-envelope"></i> ZIP Code / PO Box</label>
                        <input type="text" class="form-control" id="zipCode" name="zipCode" value="<?php echo $row['zip_code']; ?>">
                    </div>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update Contact</button>
            </form>
        </div>
    </div>
</div>


<?php include "footer.php"; ?>
