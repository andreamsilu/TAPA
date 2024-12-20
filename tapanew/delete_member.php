<?php
// Database connection
 require 'db.php';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get member ID from POST data
    $id = intval($_POST['id']); // Member ID to be deleted

    // Prepare the DELETE statement
    $stmt = $conn->prepare("DELETE FROM member WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement and check if successful
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Member deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "No member found with the specified ID."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

$conn->close();
?>