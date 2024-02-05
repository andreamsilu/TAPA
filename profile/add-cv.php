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

// Get CV data for editing (if CV ID is provided)
$cvId = isset($_GET['cvId']) ? $_GET['cvId'] : null;
$currentCvFile = '';

if ($cvId) {
    $sql = "SELECT first_name, last_name, email, phone, cv_file FROM personal_cv WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $cvId, $userId);
    $stmt->execute();
    $stmt->bind_result($firstName, $lastName, $email, $phone, $currentCvFile);
    $stmt->fetch();
    $stmt->close();
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
        $sql = $cvId ? "UPDATE personal_cv SET first_name=?, last_name=?, email=?, phone=?, cv_file=? WHERE id=? AND user_id=?" :
            "INSERT INTO personal_cv (first_name, last_name, email, phone, cv_file, user_id) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        if ($cvId) {
            $stmt->bind_param("ssssiii", $firstName, $lastName, $email, $phone, $uploadedFileName, $cvId, $userId);
        } else {
            $stmt->bind_param("sssssi", $firstName, $lastName, $email, $phone, $uploadedFileName, $userId);
        }

        if ($stmt->execute()) {
            echo $cvId ? "Personal CV updated successfully" : "Personal CV added successfully";
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

<form id="personalCVForm" action="add-cv.php" method="post" enctype="multipart/form-data">
    <h4>Personal Details</h4>
    <!-- Add values to input fields for editing -->
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo isset($firstName) ? $firstName : ''; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="lastName">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo isset($lastName) ? $lastName : ''; ?>" required>
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
        </div>
        <div class="form-group col-md-6">
            <label for="phone">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>" required>
        </div>
    </div>

    <!-- File Upload -->
    <h4>Upload CV</h4>
    <div class="form-group">
        <label for="cvFile">Choose File</label>
        <input type="file" class="form-control-file" id="cvFile" name="cvFile" accept=".pdf, .doc, .docx">
    </div>

    <!-- Display current CV file for editing -->
    <?php if ($currentCvFile) : ?>
        <p>Current CV: <a href="../forms/uploads/<?php echo $currentCvFile; ?>" target="_blank"><?php echo $currentCvFile; ?></a></p>
        <input type="hidden" name="currentCvFile" value="<?php echo $currentCvFile; ?>">
    <?php endif; ?>

    <!-- Hidden input to store the CV ID for editing -->
    <input type="hidden" name="cvId" value="<?php echo $cvId; ?>">

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary"><?php echo $cvId ? 'Update' : 'Add'; ?></button>
</form>

<?php include('footer.php'); ?>
