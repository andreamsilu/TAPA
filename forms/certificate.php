<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('forms/connection.php');
include('forms/sessions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Validate and process the form data here
        $member_id = $_SESSION['member_id'];
        $title = $_POST["title"];
        $certificateCategory = $_POST["certificateCategory"];
        $institution = $_POST["institution"];
        $completionDate = $_POST["completionDate"];
        $certificationLink = $_POST["certificationLink"];

        // Prepare and execute an SQL query to insert the data
        $sql = "INSERT INTO certifications ( member_id,title, category, institution, completion_year, certificate_link) VALUES (?, ?, ?, ?, ?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssss", $member_id,$title, $certificateCategory, $institution, $completionDate, $certificationLink);
        $stmt->execute();

        // If the insertion is successful, redirect the user to a success page
        echo "certificate added succesfully";
        header("Location: ../profile.php");
        exit();
    } catch (Exception $e) {
        // Handle any exceptions or errors here
        echo "An error occurred: " . $e->getMessage();
    }
}


?>




