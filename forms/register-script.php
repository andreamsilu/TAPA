<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Collect form data
        // Sanitize input fields
        $fullname = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
        $postal_address = filter_input(INPUT_POST, 'postal_address', FILTER_SANITIZE_STRING);
        $birth_date = filter_input(INPUT_POST, 'birth_date', FILTER_SANITIZE_STRING);
        $physical_address = filter_input(INPUT_POST, 'pysical_address', FILTER_SANITIZE_STRING);
        $membership_type = filter_input(INPUT_POST, 'membership_type', FILTER_SANITIZE_STRING);
        $licensure = filter_input(INPUT_POST, 'licensure', FILTER_SANITIZE_STRING);
        $yes_licensure = filter_input(INPUT_POST, 'yes_licensure', FILTER_SANITIZE_STRING);
        $crime = filter_input(INPUT_POST, 'crime', FILTER_SANITIZE_STRING);
        $yes_crime = filter_input(INPUT_POST, 'yes_crime', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // $cv = $_FILES["cv"]["name"];

        try {
            // Check if the file input exists and has a value
            if (isset($_FILES["cv"]) && $_FILES["cv"]["name"]) {
                // File upload handling
                $targetDir = "../forms/uploads/";
                $fileName = basename($_FILES["cv"]["name"]);
                $targetFilePath = $targetDir . $fileName;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

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
            } else {
                throw new Exception("File not found or empty.");
            }
        } catch (Exception $e) {
            // Handle the exception (error) gracefully
            echo 'Error: ' . $e->getMessage();
        }

        //=========validation===========

        // Validate licensure fields
        if ($licensure !== 'yes' && $licensure !== 'no') {
            echo "Please select either 'yes' or 'no' for licensure.";
            header('location: registration.php');
            exit;
        }

        if ($licensure === 'yes' && empty($yes_licensure)) {
            echo "Please provide details of your licensure if you answered 'yes'.";
            header('location: registration.php');
            exit;
        }

        // Validate crime fields
        if ($crime !== 'yes' && $crime !== 'no') {
            echo "Please select either 'yes' or 'no' for crime.";
            header('location:login.php');
            exit;
        }

        if ($crime === 'yes' && empty($yes_crime)) {
            echo "Please provide details of the crime if you answered 'yes'.";
            header('location: registration.php');
            exit;
        }




        // Database connection parameters

        include "../forms/connection.php";

        // SQL query for insertion (modify table and column names accordingly)
        $sql = "INSERT INTO users(fullname, email, phone, postal_address, birth_date, physical_address, membership_type, licensure, yes_licensure, crime, yes_crime,cv_file, password) 
        VALUES ('$fullname', '$email', '$phone', '$postal_address', '$birth_date', '$physical_address', '$membership_type', '$licensure', '$yes_licensure', '$crime', '$yes_crime','$fileName', '$hashedPassword')";

        if ($conn->query($sql) === TRUE) {
            // Redirect after successful registration
            echo "Your registration is successifully";
            header("Location: ../login.php");
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
