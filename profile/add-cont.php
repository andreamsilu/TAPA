<?php include "navigation.php" ?>
<?php
   include "../forms/connection.php";


// Function to sanitize form data
function sanitizeData($data) {
    return htmlspecialchars(trim($data));
}

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $companyName = sanitizeData($_POST["companyName"]);
    $contactPerson = sanitizeData($_POST["contactPerson"]);
    $email = sanitizeData($_POST["email"]);
    $phoneNumber = sanitizeData($_POST["phoneNumber"]);
    $address = sanitizeData($_POST["address"]);

    // SQL query to insert data into the database
    $sql = "INSERT INTO contact_info (company_name, contact_person, email, phone_number, address) VALUES ('$companyName', '$contactPerson', '$email', '$phoneNumber', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "Contact information saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>


<div class="container mt-5">
  <form id="contactInfoForm">
    <!-- Company Name -->
    <div class="form-group">
      <label for="companyName">Company Name</label>
      <input type="text" class="form-control" id="companyName" name="companyName" required>
    </div>

    <!-- Contact Person Name -->
    <div class="form-group">
      <label for="contactPerson">Contact Person</label>
      <input type="text" class="form-control" id="contactPerson" name="contactPerson" required>
    </div>

    <!-- Email -->
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <!-- Phone Number -->
    <div class="form-group">
      <label for="phoneNumber">Phone Number</label>
      <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
    </div>

    <!-- Address -->
    <div class="form-group">
      <label for="address">Address</label>
      <textarea class="form-control" id="address" name="address" rows="4" required></textarea>
    </div>

    <!-- Submit Button -->
    <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button>
  </form>
</div>


<script>
  function submitForm() {
    // You can add your database-saving logic here
    // Example: Send the form data to a server using AJAX
    var formData = $("#contactInfoForm").serialize();
    $.ajax({
      type: "POST",
      url: "/save-contact-info.php", // Replace with your actual backend endpoint
      data: formData,
      success: function(response) {
        alert("Contact information saved successfully!");
        // Add any other logic you need after successful submission
      },
      error: function(error) {
        console.error("Error saving contact information:", error);
        // Handle errors here
      }
    });
  }
</script>

<?php include "footer.php" ?>
