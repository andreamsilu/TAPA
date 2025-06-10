<?php
/**
 * Database Setup Script for TAPA About Page
 * This script creates the necessary database tables
 */

// Include database connection
include_once 'forms/connection.php';

// SQL statements to create tables
$sql_statements = [
    // Team Members Table
    "CREATE TABLE IF NOT EXISTS `team_members` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `position` varchar(255) NOT NULL,
        `image_url` varchar(255) DEFAULT NULL,
        `position_order` int(11) DEFAULT 0,
        `email` varchar(255) DEFAULT NULL,
        `phone` varchar(50) DEFAULT NULL,
        `bio` text DEFAULT NULL,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",
    
    // Zones Table
    "CREATE TABLE IF NOT EXISTS `zones` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `zone_name` varchar(255) NOT NULL,
        `description` text DEFAULT NULL,
        `contact_info` varchar(255) DEFAULT NULL,
        `zone_coordinator` varchar(255) DEFAULT NULL,
        `email` varchar(255) DEFAULT NULL,
        `phone` varchar(50) DEFAULT NULL,
        `address` text DEFAULT NULL,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;",
    
    // Contact Messages Table
    "CREATE TABLE IF NOT EXISTS `contact_messages` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `subject` varchar(255) NOT NULL,
        `message` text NOT NULL,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        `is_read` tinyint(1) DEFAULT 0,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
];

echo "<h2>TAPA Database Setup</h2>";

// Execute each SQL statement
foreach ($sql_statements as $sql) {
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>✅ Table created successfully</p>";
    } else {
        echo "<p style='color: red;'>❌ Error creating table: " . $conn->error . "</p>";
    }
}

// Check if sample data already exists
$check_team = $conn->query("SELECT COUNT(*) as count FROM team_members");
$team_count = $check_team->fetch_assoc()['count'];

$check_zones = $conn->query("SELECT COUNT(*) as count FROM zones");
$zones_count = $check_zones->fetch_assoc()['count'];

// Insert sample data if tables are empty
if ($team_count == 0) {
    $sample_team = [
        "INSERT INTO `team_members` (`name`, `position`, `position_order`) VALUES ('Dr. John Doe', 'President', 1)",
        "INSERT INTO `team_members` (`name`, `position`, `position_order`) VALUES ('Dr. Jane Smith', 'Vice President', 2)",
        "INSERT INTO `team_members` (`name`, `position`, `position_order`) VALUES ('Dr. Michael Johnson', 'Secretary General', 3)",
        "INSERT INTO `team_members` (`name`, `position`, `position_order`) VALUES ('Dr. Sarah Wilson', 'Treasurer', 4)"
    ];
    
    foreach ($sample_team as $sql) {
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>✅ Sample team member added</p>";
        }
    }
}

if ($zones_count == 0) {
    $sample_zones = [
        "INSERT INTO `zones` (`zone_name`, `description`, `contact_info`) VALUES ('Dar es Salaam Zone', 'Main zone covering Dar es Salaam region', '+255 679 256 256')",
        "INSERT INTO `zones` (`zone_name`, `description`, `contact_info`) VALUES ('Arusha Zone', 'Northern zone covering Arusha region', '+255 679 256 257')",
        "INSERT INTO `zones` (`zone_name`, `description`, `contact_info`) VALUES ('Mwanza Zone', 'Lake zone covering Mwanza region', '+255 679 256 258')",
        "INSERT INTO `zones` (`zone_name`, `description`, `contact_info`) VALUES ('Mbeya Zone', 'Southern highlands zone', '+255 679 256 259')"
    ];
    
    foreach ($sample_zones as $sql) {
        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>✅ Sample zone added</p>";
        }
    }
}

echo "<h3>Setup Complete!</h3>";
echo "<p>The about page should now work properly. <a href='about.php'>Click here to view the about page</a></p>";

$conn->close();
?> 