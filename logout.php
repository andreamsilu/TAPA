<?php
/**
 * Consolidated Logout Page
 * Handles user logout functionality
 */

session_start();

// Clear all session data
$_SESSION = [];

// Destroy the session
session_destroy();

// Clear session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect to login page
header("Location: login.php");
exit();
?> 