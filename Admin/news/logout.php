<?php
session_start();

function logout() {
    // Unset all session variables
    $_SESSION = [];

    // Destroy the session
    session_destroy();

    // Redirect to a login page or any other page after logout
    header("Location: ../../login.php");
    exit();
}

// Call the logout function to perform logout when needed
logout();
?>
