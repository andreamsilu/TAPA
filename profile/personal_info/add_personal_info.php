<?php
   include "../forms/connection.php";


// Function to sanitize form data
function sanitizeData($data) {
    return htmlspecialchars(trim($data));
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gender = sanitizeData($_POST["gender"]);
    $nationality = sanitizeData($_POST["nationality"]);
    $dob = sanitizeData($_POST["dob"]);
    $countryResidence = sanitizeData($_POST["countryResidence"]);
    $cityResidence = sanitizeData($_POST["cityResidence"]);
    $license = sanitizeData($_POST["license"]);
    $languages = sanitizeData($_POST["languages"]);

    // SQL query to insert data into the database
    $sql = "INSERT INTO your_table_name (gender, nationality, dob, country_residence, city_residence, license, languages) VALUES ('$gender', '$nationality', '$dob', '$countryResidence', '$cityResidence', '$license', '$languages')";

    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully";
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
  <title>Registration Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
  <form id="registrationForm">
    <!-- Gender -->
    <div class="form-group">
      <label for="gender">Gender</label>
      <select class="form-control" id="gender" name="gender">
        <option value="">Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
      </select>
    </div>

    <!-- Nationality -->
    <div class="form-group">
      <label for="nationality">Nationality</label>
      <input type="text" class="form-control" id="nationality" name="nationality">
    </div>

    <!-- Date of Birth -->
    <div class="form-group">
      <label for="dob">Date of Birth</label>
      <input type="text" class="form-control" id="dob" name="dob" placeholder="mm/dd/yyyy">
    </div>

    <!-- Country of Residence -->
    <div class="form-group">
      <label for="countryResidence">Country of Residence</label>
      <input type="text" class="form-control" id="countryResidence" name="countryResidence">
    </div>

    <!-- City/Town of Residence -->
    <div class="form-group">
      <label for="cityResidence">City/Town of Residence</label>
      <input type="text" class="form-control" id="cityResidence" name="cityResidence">
    </div>

    <!-- Practitioner License -->
    <div class="form-group">
      <label for="license">Practitioner License</label>
      <input type="text" class="form-control" id="license" name="license">
    </div>

    <!-- Languages -->
    <div class="form-group">
      <label for="languages">Languages</label>
      <input type="text" class="form-control" id="languages" name="languages">
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
    var formData = $("#registrationForm").serialize();
    $.ajax({
      type: "POST",
      url: "/save-to-database.php", // Replace with your actual backend endpoint
      data: formData,
      success: function(response) {
        alert("Data saved successfully!");
        // Add any other logic you need after successful submission
      },
      error: function(error) {
        console.error("Error saving data:", error);
        // Handle errors here
      }
    });
  }
</script>

</body>
</html>
