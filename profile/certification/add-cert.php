<?php
   include "../forms/connection.php";

// Function to sanitize form data
function sanitizeData($data) {
    return htmlspecialchars(trim($data));
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $certificationName = sanitizeData($_POST["certificationName"]);
    $certificationAuthority = sanitizeData($_POST["certificationAuthority"]);
    $certificationDate = sanitizeData($_POST["certificationDate"]);
    $expirationDate = sanitizeData($_POST["expirationDate"]);

    // SQL query to insert data into the database
    $sql = "INSERT INTO certification (certification_name, certification_authority, certification_date, expiration_date) 
            VALUES ('$certificationName', '$certificationAuthority', '$certificationDate', '$expirationDate')";

    if ($conn->query($sql) === TRUE) {
        echo "Certification information saved successfully";
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
  <title>Certification Information Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <form id="certificationForm">
    <!-- Certification Details -->
    <h4>Certification Details</h4>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="certificationName">Certification Name</label>
        <input type="text" class="form-control" id="certificationName" name="certificationName" required>
      </div>
      <div class="form-group col-md-6">
        <label for="certificationAuthority">Certification Authority</label>
        <input type="text" class="form-control" id="certificationAuthority" name="certificationAuthority" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="certificationDate">Certification Date</label>
        <input type="date" class="form-control" id="certificationDate" name="certificationDate" required>
      </div>
      <div class="form-group col-md-6">
        <label for="expirationDate">Expiration Date</label>
        <input type="date" class="form-control" id="expirationDate" name="expirationDate">
      </div>
    </div>

    <!-- Submit Button -->
    <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
  </form>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<script>
  function submitForm() {
    // You can add your database-saving logic here
    // Example: Send the form data to a server using AJAX
    var formData = $("#certificationForm").serialize();
    $.ajax({
      type: "POST",
      url: "/save_certification.php", // Replace with your actual backend endpoint
      data: formData,
      success: function(response) {
        alert("Certification information saved successfully!");
        // Add any other logic you need after successful submission
      },
      error: function(error) {
        console.error("Error saving certification information:", error);
        // Handle errors here
      }
    });
  }
</script>

</body>
</html>
