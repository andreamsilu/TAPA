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
    $newCvFileName = basename($_FILES["cvFile"]["name"]);
    $targetFilePath = $targetDir . $newCvFileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Valid file extensions
    $allowedExtensions = array("pdf", "doc", "docx");

    // Check file extension
    if (!in_array($fileType, $allowedExtensions)) {
        return "Only PDF, DOC, and DOCX files are allowed.";
    }

    // Move the uploaded file to the destination directory
    if (move_uploaded_file($_FILES["cvFile"]["tmp_name"], $targetFilePath)) {
        return $newCvFileName;
    } else {
        return "Error uploading the file.";
    }
}

// Get CV data for editing (if CV ID is provided)
$cvId = isset($_GET['id']) ? $_GET['id'] : null;
$cvData = array(); // Array to store CV data

if ($cvId) {
    // Check if $cvId is set before attempting to fetch data
    $sql = "SELECT first_name, last_name, email, phone, cv_file FROM personal_cv WHERE id = '$cvId' AND user_id = '$userId'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cvData['first_name'] = $row['first_name'];
        $cvData['last_name'] = $row['last_name'];
        $cvData['email'] = $row['email'];
        $cvData['phone'] = $row['phone'];
        $cvData['cv_file'] = $row['cv_file'];
    }

    $result->close();
}



// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cvId = sanitizeData($_POST["cv_id"]); // Assuming you have a hidden input in your form for cv_id
    $firstName = sanitizeData($_POST["firstName"]);
    $lastName = sanitizeData($_POST["lastName"]);
    $email = sanitizeData($_POST["email"]);
    $phone = sanitizeData($_POST["phone"]);

    // Handle file upload if a new file is provided
    $newCvFileName = '';
    if ($_FILES["cvFile"]["name"]) {
        $newCvFileName = handleFileUpload();
        if (strpos($newCvFileName, 'Error') !== false) {
            // File upload encountered an error
            echo $newCvFileName;
            exit();
        }
    } else {
        // No new file provided, keep the existing file name
        $newCvFileName = $currentCvFile;
    }

    // Update CV information in the database
    $sql = "UPDATE personal_cv SET first_name = ?, last_name = ?, email = ?, phone = ?, cv_file = ? WHERE id = ? AND user_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssii", $firstName, $lastName, $email, $phone, $newCvFileName, $cvId, $userId);

    if ($stmt->execute()) {
        echo "Personal CV updated successfully";
        header("Location: show-cv.php");
        exit();
    } else {
        echo "Error updating data in the database: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<?php include('navigation.php');  ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2><i class="bi bi-pencil-square"></i> Edit CV</h2>
        </div>
        <div class="card-body">
            <form action="update-cv.php" method="post" enctype="multipart/form-data">
                <!-- Hidden input for CV ID -->
                <input type="hidden" name="cv_id" value="<?php echo $cvId; ?>">

               

                <!-- Other CV details for editing -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="firstName"><i class="bi bi-person"></i> First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $cvData['first_name']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastName"><i class="bi bi-person"></i> Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $cvData['last_name']; ?>" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="email"><i class="bi bi-envelope"></i> Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $cvData['email']; ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="phone"><i class="bi bi-telephone"></i> Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $cvData['phone']; ?>" required>
                    </div>
                </div>

                 <!-- Existing CV File -->
                 <p><strong><i class="bi bi-file-earmark-text"></i> Current CV File:</strong><a href="../forms/uploads/<?php echo $cvData['cv_file']; ?>" target="_blank" rel="noopener noreferrer"> <?php echo $cvData['cv_file']; ?></a> </p>

<!-- Allow users to upload a new CV file -->
<div class="form-group">
    <label for="cvFile"><i class="bi bi-cloud-upload"></i> Upload New CV File:</label>
    <input type="file" class="form-control" id="cvFile" name="cvFile">
</div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update CV</button>
            </form>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
