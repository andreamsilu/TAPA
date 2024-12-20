<?php
// Database connection
 require 'db.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get member ID from the request
if (isset($_GET['id'])) {
    $memberId = intval($_GET['id']);

    // Fetch member data
    $stmt = $conn->prepare("SELECT * FROM member WHERE id = ?");
    $stmt->bind_param("i", $memberId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if member exists
    if ($result->num_rows > 0) {
        $member = $result->fetch_assoc();
        // Send the response as JSON
        echo json_encode($member);
    } else {
        echo json_encode(["error" => "Member not found"]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid request"]);
}

$conn->close();
?>