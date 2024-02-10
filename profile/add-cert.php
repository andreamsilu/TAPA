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

// Initialize variables for storing certification data
$certificationName = "";
$certificationAuthority = "";
$certificationDate = "";
$expirationDate = "";

// Check if certification ID is provided for editing
$certId = isset($_GET['id']) ? $_GET['id'] : null;

if ($certId) {
    // Fetch existing certification data from the database
    $sql = "SELECT certification_name, certification_authority, certification_date, expiration_date 
            FROM certification 
            WHERE id = ? AND user_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $certId, $userId);
    $stmt->execute();
    $stmt->bind_result($certificationName, $certificationAuthority, $certificationDate, $expirationDate);
    $stmt->fetch();
    $stmt->close();
}

// Process form data for updating or inserting
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $certificationName = sanitizeData($_POST["certificationName"]);
    $certificationAuthority = sanitizeData($_POST["certificationAuthority"]);
    $certificationDate = sanitizeData($_POST["certificationDate"]);
    $expirationDate = sanitizeData($_POST["expirationDate"]);

    // Use prepared statements to prevent SQL injection
    if ($certId) {
        // Update existing certification information
        $sql = "UPDATE certification 
                SET certification_name = ?, certification_authority = ?, certification_date = ?, expiration_date = ? 
                WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $certificationName, $certificationAuthority, $certificationDate, $expirationDate, $certId, $userId);
    } else {
        // Insert new certification information
        $sql = "INSERT INTO certification (certification_name, certification_authority, certification_date, expiration_date, user_id) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $certificationName, $certificationAuthority, $certificationDate, $expirationDate, $userId);
    }

    if ($stmt->execute()) {
        echo "Certification information saved successfully";
        header("Location: show-cert.php");

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
<?php
include "navigation.php";
?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4><i class="bi bi-file-earmark-plus"></i> Certification Details</h4>
        </div>
        <div class="card-body">
            <form id="certificationForm" action="<?php echo $certId ? 'edit-cert.php?id=' . $certId : 'add-cert.php'; ?>" method="post">
                <!-- Certification Details -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="certificationName"><i class="bi bi-file-earmark-text"></i> Certification Name</label>
                        <input type="text" class="form-control" id="certificationName" name="certificationName" value="<?php echo $certificationName; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="certificationAuthority"><i class="bi bi-building"></i> Certification Authority</label>
                        <input type="text" class="form-control" id="certificationAuthority" name="certificationAuthority" value="<?php echo $certificationAuthority; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="certificationDate"><i class="bi bi-calendar"></i> Certification Date</label>
                        <input type="date" class="form-control" id="certificationDate" name="certificationDate" value="<?php echo $certificationDate; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="expirationDate"><i class="bi bi-calendar-x"></i> Expiration Date</label>
                        <input type="date" class="form-control" id="expirationDate" name="expirationDate" value="<?php echo $expirationDate; ?>">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Submit</button>
            </form>
        </div>
    </div>
</div>


<?php include "footer.php" ?>
