<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../forms/connection.php');
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form data
    $membera_id = $_SESSION['member_id'];
    $qualificationCategory = $_POST['qualificationCategory'];
    $level = $_POST['level'];
    $institution = $_POST['institution'];
    $completionYear = $_POST['currentlyStudyingAt'];


    // Insert data into the database
    $sql = "INSERT INTO education (member_id,qualification_category, education_level, institution, completion_year) 
            VALUES ('$membera_id','$qualificationCategory', '$level', '$institution', '$completionYear')";

    if (mysqli_query($conn, $sql)) {
        echo "Record inserted successfully!";
        header('Location: ../profile.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    // Close the database connection
    mysqli_close($conn);
}
?>
