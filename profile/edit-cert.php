<?php
    session_start();
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
    $certificationId = sanitizeData($_POST["certificationId"]);
    $certificationName = sanitizeData($_POST["certificationName"]);
    $certificationAuthority = sanitizeData($_POST["certificationAuthority"]);
    $certificationDate = sanitizeData($_POST["certificationDate"]);
    $expirationDate = sanitizeData($_POST["expirationDate"]);

    // Update data in the database
    $sql = "UPDATE certification 
            SET certification_name = '$certificationName', 
                certification_authority = '$certificationAuthority', 
                certification_date = '$certificationDate', 
                expiration_date = '$expirationDate' 
            WHERE id = $certificationId";

    if ($conn->query($sql) === TRUE) {
        echo "Certification information updated successfully";
        header("Location: show-cert.php");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>


<?php include("navigation.php") ?>


<div class="container mt-5">
  <?php
   include "../forms/connection.php";


  // Get the record to be edited
  $certificationId = $_GET['id'];
  $sql = "SELECT * FROM certification WHERE id = $certificationId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
  ?>
    <form id="editCertificationForm" action="edit-cert.php" method="post">
      <!-- Certification Details -->
      <h4>Certification Details</h4>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="certificationName">Certification Name</label>
          <input type="text" class="form-control" id="certificationName" name="certificationName" value="<?php echo $row['certification_name']; ?>" required>
        </div>
        <div class="form-group col-md-6">
          <label for="certificationAuthority">Certification Authority</label>
          <input type="text" class="form-control" id="certificationAuthority" name="certificationAuthority" value="<?php echo $row['certification_authority']; ?>" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="certificationDate">Certification Date</label>
          <input type="date" class="form-control" id="certificationDate" name="certificationDate" value="<?php echo $row['certification_date']; ?>" required>
        </div>
        <div class="form-group col-md-6">
          <label for="expirationDate">Expiration Date</label>
          <input type="date" class="form-control" id="expirationDate" name="expirationDate" value="<?php echo $row['expiration_date']; ?>">
        </div>
      </div>

      <!-- Hidden input to store the certification ID -->
      <input type="hidden" name="certificationId" value="<?php echo $certificationId; ?>">

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary" >Update</button>
    </form>
  <?php
  } else {
      echo "Certification information not found.";
  }

  // Close the database connection
  $conn->close();
  ?>

</div>

<?php include("footer.php") ?>



