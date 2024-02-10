<?php
// Check if the ID is provided in the URL
if(isset($_GET['id'])) {
    // Get the ID from the URL
    $id = $_GET['id'];

    // Perform database connection and deletion
    include "../forms/connection.php";

    // Prepare the SQL statement to delete the record with the provided ID
    $sql = "DELETE FROM education WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        header('Location:show_edu.php');
    } else {
        // Error occurred
        echo "Error deleting record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // ID is not provided in the URL
    echo "ID not provided";
}
?>
