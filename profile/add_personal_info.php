
<?php include "navigation.php" ?>

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
    $sql = "INSERT INTO users (gender, nationality, dob, country_residence, city_residence, license, languages) VALUES ('$gender', '$nationality', '$dob', '$countryResidence', '$cityResidence', '$license', '$languages')";

    if ($conn->query($sql) === TRUE) {
        echo "Data saved successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>


<div class="container mt-5">
  <form id="registrationForm" action="add_personal_info.php" method="post">
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
            <select class="form-control" id="nationality" name="nationality">
                <option value="">Select Nationality</option>
                <!-- JavaScript will populate this dropdown -->
            </select>
        </div>

    <!-- Date of Birth -->
    <div class="form-group">
      <label for="dob">Date of Birth</label>
      <input type="date" class="form-control" id="dob" name="dob" placeholder="mm/dd/yyyy">
    </div>

    <!-- Country of Residence -->
    <div class="form-group">
            <label for="countryResidence">Country of Residence</label>
            <select class="form-control" id="countryResidence" name="countryResidence">
                <option value="">Select Country</option>
                <!-- JavaScript will populate this dropdown -->
            </select>
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
    <button type="submit" class="btn btn-primary" onclick="submitForm()">Submit</button>
  </form>
</div>

<?php include "footer.php" ?>
<!-- Place this after your HTML elements -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // Fetch data from the REST Countries API and populate the dropdowns
    $(document).ready(function () {
        // Nationality dropdown
        var nationalityDropdown = $('#nationality');
        $.get('https://restcountries.com/v3.1/all', function (data) {
            data.forEach(function (country) {
                nationalityDropdown.append('<option value="' + country.name.common + '">' + country.name.common + '</option>');
            });
        });

        // Country of Residence dropdown
        var countryResidenceDropdown = $('#countryResidence');
        $.get('https://restcountries.com/v3.1/all', function (data) {
            data.forEach(function (country) {
                countryResidenceDropdown.append('<option value="' + country.name.common + '">' + country.name.common + '</option>');
            });
        });
    });



    function submitForm() {
        // You can add your database-saving logic here
        // Example: Send the form data to a server using AJAX
        var formData = $("#registrationForm").serialize();
        $.ajax({
            type: "POST",
            url: "/save-to-database.php", // Replace with your actual backend endpoint
            data: formData,
            success: function (response) {
                alert("Data saved successfully!");
                // Add any other logic you need after successful submission
            },
            error: function (error) {
                console.error("Error saving data:", error);
                // Handle errors here
            }
        });
    }
</script>

