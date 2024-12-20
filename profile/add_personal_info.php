<?php
session_start();
include "navigation.php";
include "../forms/connection.php";

// Function to sanitize form data
function sanitizeData($data)
{
    return htmlspecialchars(trim($data));
}

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not authenticated
    header("Location: login.php");
    exit();
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
    <div class="card m-3">
        <div class="card-header">
            <h4><i class="bi bi-person-fill"></i> Personal Information</h4>
        </div>
        <div class="card-body">
            <form id="registrationForm" action="add_personal_info.php" method="post">
                <div class="row">
                    <!-- Gender -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gender"><i class="bi bi-gender"></i> Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    <!-- Nationality -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nationality"><i class="bi bi-flag"></i> Nationality</label>
                            <select class="form-control" id="nationality" name="nationality">
                                <option value="">Select Nationality</option>
                                <!-- JavaScript will populate this dropdown -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Date of Birth -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="dob"><i class="bi bi-calendar"></i> Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" placeholder="mm/dd/yyyy">
                        </div>
                    </div>
                    <!-- Country of Residence -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="countryResidence"><i class="bi bi-globe"></i> Country of Residence</label>
                            <select class="form-control" id="countryResidence" name="countryResidence">
                                <option value="">Select Country</option>
                                <!-- JavaScript will populate this dropdown -->
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Region of Residence -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="regionResidence"><i class="bi bi-map"></i> Region of Residence</label>
                            <select class="form-control" id="regionResidence" name="regionResidence">
                                <!-- Options will be dynamically added here -->
                            </select>
                        </div>
                    </div>
                    <!-- Practitioner License -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="license"><i class="bi bi-card-checklist"></i> Practitioner License</label>
                            <input type="text" class="form-control" id="license" name="license">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Languages -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="languages"><i class="bi bi-chat-left"></i> Languages</label>
                            <input type="text" class="form-control" id="languages" name="languages">
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary"><i class="bi bi-check"></i> Submit</button>
            </form>
        </div>
    </div>
</div>


<?php include "footer.php" ?>
<!-- Place this after your HTML elements -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // Fetch data from the REST Countries API and populate the dropdowns
    $(document).ready(function() {
        // Nationality dropdown
        var nationalityDropdown = $('#nationality');
        $.get('https://restcountries.com/v3.1/all', function(data) {
            data.forEach(function(country) {
                nationalityDropdown.append('<option value="' + country.name.common + '">' + country.name.common + '</option>');
            });
        });

        // Country of Residence dropdown
        var countryResidenceDropdown = $('#countryResidence');
        $.get('https://restcountries.com/v3.1/all', function(data) {
            data.forEach(function(country) {
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


    // Use cors-anywhere to fetch regions
    $.ajax({
        url: 'https://cors-anywhere.herokuapp.com/https://api.tanzania.go.tz/tanzania/regions',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Handle the response and populate the dropdown
            if (data.success) {
                var regions = data.data;
                var dropdown = $('#regionResidence');

                // Add an option for each region
                $.each(regions, function(index, region) {
                    dropdown.append($('<option>', {
                        value: region.region_name,
                        text: region.region_name
                    }));
                });
            } else {
                console.error('Error fetching regions: ' + data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching regions: ' + error);
        }
    });
</script>