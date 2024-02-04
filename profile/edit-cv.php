<?php
session_start();
include "navigation.php";
include "../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if not authenticated
    header("Location: login.php");
    exit();
}

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

      <!-- Hidden input to store the CV ID -->
      <input type="hidden" name="cvId" value="<?php echo $cvId; ?>">

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

<?php include "footer.php"; ?>
