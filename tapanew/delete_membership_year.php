<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    
    // Delete the membership year
    $stmt = $conn->prepare("DELETE FROM membership_year WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Membership year deleted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>