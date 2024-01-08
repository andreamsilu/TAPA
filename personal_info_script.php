<?php
// Include the database connection file
include "../forms/connection.php";

// Check if the connection is established
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select submitted user data
$sql = "SELECT * FROM users";

// Execute the query and store the result
$result = $conn->query($sql);

// Check if any rows are returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Display or process the fetched data as needed
        echo "Full Name: " . $row["fullname"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "Phone: " . $row["phone"] . "<br>";
        // Display other fields similarly
        echo "<hr>";
    }
} else {
    echo "No submitted data found";
}

// Close the database connection
$conn->close();
?>
