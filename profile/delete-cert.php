<?php
// Include database connection or configuration file
include_once "../forms/connection.php";

// Check if ID parameter is set and not empty
if(isset($_GET["id"]) && !empty($_GET["id"])){
    // Prepare a delete statement
    $sql = "DELETE FROM certification WHERE id = ?";

    if($stmt = $conn->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = $_GET["id"];

        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Certificate deleted successfully, redirect to certificates page
            header("location: show-cert.php");
            exit();
        } else{
            // If execution failed, display an error message
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
