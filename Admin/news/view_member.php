<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "navigation.php"; 

?>

<style>
/* Updated table styles */
table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ddd;
    margin: 20px auto;
}

th,
td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
    /* Background color for table headers */
}

tr:nth-child(even) {
    background-color: #f9f9f9;
    /* Background color for even rows */
}

tr:hover {
    background-color: #f5f5f5;
    /* Background color on hover */
}

h1 {
    text-align: center;
}
</style>

<h1>Member Information</h1>

<?php
// Database connection
include "../../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    exit();
}

// Check if 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    $member_id = $_GET['id'];

    // Prepare a SELECT query to fetch specific member information by ID
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameter
    $stmt->bind_param("i", $member_id);

    // Execute the statement
    if (!$stmt->execute()) {
        die("Execution failed: " . $stmt->error);
    }

    // Get the result
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        $member = $result->fetch_assoc();

        // Display specific fields
        echo "<table>";
        echo "<tr><th>Name</th><td>" . htmlspecialchars($member['fullname']) . "</td></tr>";
        echo "<tr><th>Email</th><td>" . htmlspecialchars($member['email']) . "</td></tr>";
        echo "<tr><th>Phone</th><td>" . htmlspecialchars($member['phone']) . "</td></tr>";
        echo "<tr><th>Postal Address</th><td>" . htmlspecialchars($member['postal_address']) . "</td></tr>";
        echo "<tr><th>Physical Address</th><td>" . htmlspecialchars($member['postal_address']) . "</td></tr>";
        echo "<tr><th>Membership</th><td>" . htmlspecialchars($member['membership_type']) . "</td></tr>";
        echo "<tr><th>Annual Fees status</th><td>" . htmlspecialchars($member['pay_status']) . "</td></tr>";

        
        
        echo "</table>";
    } else {
        echo "No member found with the provided ID.";
    }

    // Close statement
    $stmt->close();
    
    // Close database connection
    $conn->close();
} else {
    echo "No member ID provided.";
}
?>

<?php include "footer.php"; ?>