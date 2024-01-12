<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <?php
          include "../forms/connection.php";


        // Get the record to be edited
        $recordId = $_GET['id'];
        $sql = "SELECT * FROM your_table_name WHERE id = $recordId";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        ?>
            <form id="editForm">
                <!-- Populate the form with existing data -->
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender">
                        <option value="male" <?php echo ($row['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo ($row['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                        <option value="other" <?php echo ($row['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="nationality">Nationality</label>
                    <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $row['nationality']; ?>">
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="text" class="form-control" id="dob" name="dob" placeholder="mm/dd/yyyy" value="<?php echo $row['dob']; ?>">
                </div>

                <!-- Add other fields as needed -->

                <div class="form-group">
                    <label for="countryResidence">Country of Residence</label>
                    <input type="text" class="form-control" id="countryResidence" name="countryResidence" value="<?php echo $row['country_residence']; ?>">
                </div>

                <div class="form-group">
                    <label for="cityResidence">City/Town of Residence</label>
                    <input type="text" class="form-control" id="cityResidence" name="cityResidence" value="<?php echo $row['city_residence']; ?>">
                </div>

                <div class="form-group">
                    <label for="license">Practitioner License</label>
                    <input type="text" class="form-control" id="license" name="license" value="<?php echo $row['license']; ?>">
                </div>

                <div class="form-group">
                    <label for="languages">Languages</label>
                    <input type="text" class="form-control" id="languages" name="languages" value="<?php echo $row['languages']; ?>">
                </div>

                <!-- Submit Button -->
                <button type="button" class="btn btn-primary" onclick="updateForm()">Update</button>
            </form>
        <?php
        } else {
            echo "Record not found.";
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
            var formData = $("#editForm").serialize();
            $.ajax({
                type: "POST",
                url: "/update-in-database.php", // Replace with your actual backend endpoint
                data: formData,
                success: function(response) {
                    alert("Data updated successfully!");
                    // Add any other logic you need after successful update
                },
                error: function(error) {
                    console.error("Error updating data:", error);
                    // Handle errors here
                }
            });
        }
    </script>

</body>

</html>