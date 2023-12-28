<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Collect form data
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $postal_address = $_POST['postal_address'];
        $birth_date = $_POST['birth_date'];
        $physical_address = $_POST['pysical_address'];
        $membership_type = $_POST['membership_type'];
        $licensure = $_POST['licensure'] ?? '';
        $yes_licensure = $_POST['yes_licensure'] ?? '';
        $crime = $_POST['crime'] ?? '';
        $yes_crime = $_POST['yes_crime'] ?? '';
        $password = $_POST['password'];
        $cv = $_FILES["cv"]["name"];

        // File upload handling
        $targetDir = "../forms/uploads/"; // Define the directory for file uploads (added trailing slash)
        $fileName = basename($cv); // Get the name of the uploaded file
        $targetFilePath = $targetDir . $fileName; // Set the file's path

        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION)); // Get file extension

        // Allowed file extensions
        $allowedExtensions = array("pdf", "doc", "docx");

        // Check if the uploaded file extension is allowed
        if (!in_array($fileType, $allowedExtensions)) {
            throw new Exception("Only PDF, DOC, and DOCX files are allowed.");
        }

        // Move the uploaded file to the desired location
        if (!move_uploaded_file($_FILES["cv"]["tmp_name"], $targetFilePath)) {
            throw new Exception("File upload failed.");
        }

        // Perform further validations if necessary

        // Database connection parameters

        include "../forms/connection.php";

        // SQL query for insertion (modify table and column names accordingly)
        $sql = "INSERT INTO users(fullname, email, phone, postal_address, birth_date, physical_address, membership_type, licensure, yes_licensure, crime, yes_crime,cv_file password) 
        VALUES ('$fullname', '$email', '$phone', '$postal_address', '$birth_date', '$physical_address', '$membership_type', '$licensure', '$yes_licensure', '$crime', '$yes_crime','$fileName' '$password')";

        if ($conn->query($sql) === TRUE) {
            // Redirect after successful registration
            echo "Your registration is successifully";
            header("Location: login.php");
            exit();
        } else {
            throw new Exception("Error: " . $sql . "<br>" . $conn->error);
        }

        // Close connection
        $conn->close();
    } catch (Exception $e) {
        // Handle exceptions, log errors, or display error messages
        echo "An error occurred: " . $e->getMessage();
    }
}
