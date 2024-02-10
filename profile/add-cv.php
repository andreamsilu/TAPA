<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$userId = $_SESSION['user_id'];

// Function to sanitize form data
function sanitizeData($data)
{
    return htmlspecialchars(trim($data));
}

// Function to handle file uploads
function handleFileUpload()
{
    $targetDir = "../forms/uploads/";
    $cvFileName = basename($_FILES["cvFile"]["name"]);
    $targetFilePath = $targetDir . $cvFileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Valid file extensions
    $allowedExtensions = array("pdf", "doc", "docx");

    // Check file extension
    if (!in_array($fileType, $allowedExtensions)) {
        return "Only PDF, DOC, and DOCX files are allowed.";
    }

    // Move the uploaded file to the destination directory
    if (move_uploaded_file($_FILES["cvFile"]["tmp_name"], $targetFilePath)) {
        return $cvFileName;
    } else {
        return "Error uploading the file.";
    }
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = sanitizeData($_POST["firstName"]);
    $lastName = sanitizeData($_POST["lastName"]);
    $email = sanitizeData($_POST["email"]);
    $phone = sanitizeData($_POST["phone"]);

    // Handle file upload
    $uploadedFileName = handleFileUpload();

    if (strpos($uploadedFileName, 'Error') === false) {
        // File uploaded successfully
        $sql = "INSERT INTO personal_cv (first_name, last_name, email, phone, cv_file, user_id) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $firstName, $lastName, $email, $phone, $uploadedFileName, $userId);

        if ($stmt->execute()) {
            echo "Personal CV added successfully";
            header("Location: show-cv.php");
        } else {
            echo "Error saving data to the database: " . $stmt->error;
        }

        $stmt->close();
    } else {
        // File upload encountered an error
        echo $uploadedFileName;
    }
}

// Close the database connection
$conn->close();
?>

<?php include('navigation.php'); ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4><i class="bi bi-file-earmark-plus"></i> Add CV Details</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form id="personalCVForm" action="add-cv.php" method="post" enctype="multipart/form-data">
                        <!-- Add values to input fields for editing -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstName"><i class="bi bi-person-badge"></i> First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastName"><i class="bi bi-person-badge"></i> Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email"><i class="bi bi-envelope"></i> Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone"><i class="bi bi-telephone"></i> Phone</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div class="form-group">
                            <label for="cvFile"><i class="bi bi-file-earmark-pdf"></i> Upload CV</label>
                            <input type="file" class="form-control-file" id="cvFile" name="cvFile" accept=".pdf, .doc, .docx">
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include('footer.php'); ?>
