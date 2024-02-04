<?php
session_start();
include "navigation.php";
include "../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not authenticated
    header("Location: login.php");
    exit();
}

// Function to sanitize form data
function sanitizeData($data) {
    return htmlspecialchars(trim($data));
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = sanitizeData($_POST["firstName"]);
    $lastName = sanitizeData($_POST["lastName"]);
    $email = sanitizeData($_POST["email"]);
    $phone = sanitizeData($_POST["phone"]);

    // File Upload Handling
    $targetDir = "uploads/";
    $cvFileName = basename($_FILES["cvFile"]["name"]);
    $targetFilePath = $targetDir . $cvFileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Valid file extensions
    $allowedExtensions = array("pdf", "doc", "docx");

    // Check file extension
    if (!in_array($fileType, $allowedExtensions)) {
        echo "Only PDF, DOC, and DOCX files are allowed.";
        exit();
    }

    // Move the uploaded file to the destination directory
    if (move_uploaded_file($_FILES["cvFile"]["tmp_name"], $targetFilePath)) {
        // Insert data into the database
        $sql = "INSERT INTO personal_cv (first_name, last_name, email, phone, cv_file) VALUES ('$firstName', '$lastName', '$email', '$phone', '$cvFileName')";

        if ($conn->query($sql) === TRUE) {
            echo "Personal CV saved successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading the file.";
    }
}

// Close the database connection
$conn->close();
?>



<form id="editPersonalCVForm" enctype="multipart/form-data">
      <!-- Personal Details -->
      <h4>Personal Details</h4>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="firstName">First Name</label>
          <input type="text" class="form-control" id="firstName" name="firstName"  required>
        </div>
        <div class="form-group col-md-6">
          <label for="lastName">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email"  required>
        </div>
        <div class="form-group col-md-6">
          <label for="phone">Phone</label>
          <input type="tel" class="form-control" id="phone" name="phone"  required>
        </div>
      </div>

      <!-- File Upload -->
      <h4>Upload CV</h4>
      <div class="form-group">
        <label for="cvFile">Choose File</label>
        <input type="file" class="form-control-file" id="cvFile" name="cvFile" accept=".pdf, .doc, .docx">
      </div>

      <!-- Hidden input to store the current CV file name -->
      <input type="hidden" name="currentCvFile" >

      <!-- Hidden input to store the CV ID -->
      <input type="hidden" name="cvId">

      <!-- Submit Button -->
      <button type="button" class="btn btn-primary" >Add</button>
    </form>

    <?php include('footer.php'); ?>