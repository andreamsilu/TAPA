<?php include "navigation.php"; 
session_start();
?>

<style>
    /* Updated table styles */
    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
        margin: 20px auto;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2; /* Background color for table headers */
    }
    tr:nth-child(even) {
        background-color: #f9f9f9; /* Background color for even rows */
    }
    tr:hover {
        background-color: #f5f5f5; /* Background color on hover */
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
    // header("Location: ../../login.php");
    exit();
}

// Check if 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    // Get the member ID from the URL
    $member_id = $_GET['id'];

    // Prepare a SELECT query to fetch specific member information by ID
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param("i", $member_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the member details
        $member = $result->fetch_assoc();

        // Display the member information in a table
        echo "<table>";
        foreach ($member as $key => $value) {
            echo "<tr><th>" . ucfirst(str_replace('_', ' ', $key)) . "</th><td>$value</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No member found with the provided ID.";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
} else {
    echo "No member ID provided.";
}
?>

<?php include "footer.php"; ?>
