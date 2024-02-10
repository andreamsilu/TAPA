<?php
// Include database connection or any necessary files
include "../forms/connection.php";

// Check if the 'id' parameter is set in the URL
if(isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $experienceId = $_GET['id'];

    // Construct the SQL query to delete the experience entry
    $sql = "DELETE FROM experience WHERE id = $experienceId";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect to a success page or refresh the current page
        header("Location: show-exp.php");
        exit();
    } else {
        // Handle the case where the deletion fails
        echo "Error deleting record: " . $conn->error;
    }
} else {
    // Redirect to an error page or display an error message
    echo "Invalid request.";
}
// Close the database connection
$conn->close();
?>
