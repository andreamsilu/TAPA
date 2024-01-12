<?php
   include "../forms/connection.php";


// Function to sanitize form data
function sanitizeData($data) {
    return htmlspecialchars(trim($data));
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cvId = sanitizeData($_POST["cvId"]);
    $firstName = sanitizeData($_POST["firstName"]);
    $lastName = sanitizeData($_POST["lastName"]);
    $email = sanitizeData($_POST["email"]);
    $phone = sanitizeData($_POST["phone"]);
    $currentCvFile = sanitizeData($_POST["currentCvFile"]);

    // File Upload Handling
    $targetDir = "uploads/";
    $cvFileName = basename($_FILES["cvFile"]["name"]);
    $targetFilePath = $targetDir . $cvFileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Check if a new file is uploaded
    if ($_FILES["cvFile"]["size"] > 0) {
        // Valid file extensions
        $allowedExtensions = array("pdf", "doc", "docx");

        // Check file extension
        if (!in_array($fileType, $allowedExtensions)) {
            echo "Only PDF, DOC, and DOCX files are allowed.";
            exit();
        }

        // Move the uploaded file to the destination directory
        if (move_uploaded_file($_FILES["cvFile"]["tmp_name"], $targetFilePath)) {
            // Remove the previous CV file
            unlink($targetDir . $currentCvFile);
            $cvFileName = $cvFileName;
        } else {
            echo "Error uploading the new file.";
            exit();
        }
    } else {
        $cvFileName = $currentCvFile;
    }

    // Update data in the database
    $sql = "UPDATE personal_cv SET first_name = '$firstName', last_name = '$lastName', email = '$email', phone = '$phone', cv_file = '$cvFileName' WHERE id = $cvId";

    if ($conn->query($sql) === TRUE) {
        echo "Personal CV updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Personal CV</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <?php
  // Replace these values with your actual database credentials
  $servername = "your_database_server";
  $username = "your_username";
  $password = "your_password";
  $database = "your_database_name";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);

  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // Get the record to be edited
  $cvId = $_GET['id'];
  $sql = "SELECT * FROM personal_cv WHERE id = $cvId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
  ?>
    <form id="editPersonalCVForm" enctype="multipart/form-data">
      <!-- Personal Details -->
      <h4>Personal Details</h4>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="firstName">First Name</label>
          <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $row['first_name']; ?>" required>
        </div>
        <div class="form-group col-md-6">
          <label for="lastName">Last Name</label>
          <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $row['last_name']; ?>" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
        </div>
        <div class="form-group col-md-6">
          <label for="phone">Phone</label>
          <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required>
        </div>
      </div>

      <!-- File Upload -->
      <h4>Upload CV</h4>
      <div class="form-group">
        <label for="cvFile">Choose File</label>
        <input type="file" class="form-control-file" id="cvFile" name="cvFile" accept=".pdf, .doc, .docx">
      </div>

      <!-- Hidden input to store the current CV file name -->
      <input type="hidden" name="currentCvFile" value="<?php echo $row['cv_file']; ?>">

      <!-- Submit Button -->
      <button type="button" class="btn btn-primary" onclick="updateForm()">Update</button>
    </form>
  <?php
  } else {
      echo "Personal CV not found.";
  }

  // Close the database connection
  $conn->close();
  ?>

</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
  function updateForm() {
    // You can add your database-updating logic here
    // Example: Send the updated form data to a server using AJAX
    var formData = new FormData($("#editPersonalCVForm")[0]);
    $.ajax({
      type: "POST",
      url: "/update_personal_cv.php", // Replace with your actual backend endpoint
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        alert("Personal CV updated successfully!");
        // Add any other logic you need after successful update
      },
      error: function(error) {
        console.error("Error updating personal CV:", error);
        // Handle errors here
      }
    });
  }
</script>

</body>
</html>
