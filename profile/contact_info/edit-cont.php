<?php
include "../forms/connection.php";


// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contactInfoId = sanitizeData($_POST["id"]);
    $companyName = sanitizeData($_POST["companyName"]);
    $contactPerson = sanitizeData($_POST["contactPerson"]);
    $email = sanitizeData($_POST["email"]);
    $phoneNumber = sanitizeData($_POST["phoneNumber"]);
    $address = sanitizeData($_POST["address"]);

    // SQL query to update data in the database
    $sql = "UPDATE contact_info SET company_name = '$companyName', contact_person = '$contactPerson', email = '$email', phone_number = '$phoneNumber', address = '$address' WHERE id = $contactInfoId";

    if ($conn->query($sql) === TRUE) {
        echo "Contact information updated successfully";
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
  <title>Edit Contact Information</title>
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
  $contactInfoId = $_GET['id'];
  $sql = "SELECT * FROM contact_info WHERE id = $contactInfoId";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
  ?>
    <form id="editContactInfoForm">
      <!-- Company Name -->
      <div class="form-group">
        <label for="companyName">Company Name</label>
        <input type="text" class="form-control" id="companyName" name="companyName" value="<?php echo $row['company_name']; ?>" required>
      </div>

      <!-- Contact Person Name -->
      <div class="form-group">
        <label for="contactPerson">Contact Person</label>
        <input type="text" class="form-control" id="contactPerson" name="contactPerson" value="<?php echo $row['contact_person']; ?>" required>
      </div>

      <!-- Email -->
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
      </div>

      <!-- Phone Number -->
      <div class="form-group">
        <label for="phoneNumber">Phone Number</label>
        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $row['phone_number']; ?>" required>
      </div>

      <!-- Address -->
      <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" id="address" name="address" rows="4" required><?php echo $row['address']; ?></textarea>
      </div>

      <!-- Submit Button -->
      <button type="button" class="btn btn-primary" onclick="updateForm()">Update</button>
    </form>
  <?php
  } else {
      echo "Contact information not found.";
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
    var formData = $("#editContactInfoForm").serialize();
    $.ajax({
      type: "POST",
      url: "/update-contact-info.php", // Replace with your actual backend endpoint
      data: formData,
      success: function(response) {
        alert("Contact information updated successfully!");
        // Add any other logic you need after successful update
      },
      error: function(error) {
        console.error("Error updating contact information:", error);
        // Handle errors here
      }
    });
  }
</script>

</body>
</html>
