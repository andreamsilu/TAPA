<?php
// Test database connection and table existence
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Database Connection Test</h2>";

// Include database connection
include_once 'forms/connection.php';

if ($conn) {
    echo "<p style='color: green;'>✅ Database connection successful!</p>";
    
    // Test if we can query the database
    $test_query = "SELECT 1";
    $result = $conn->query($test_query);
    
    if ($result) {
        echo "<p style='color: green;'>✅ Database queries working!</p>";
        
        // Check if team_members table exists
        $table_check = $conn->query("SHOW TABLES LIKE 'team_members'");
        if ($table_check && $table_check->num_rows > 0) {
            echo "<p style='color: green;'>✅ team_members table exists!</p>";
            
            // Count team members
            $count_query = "SELECT COUNT(*) as count FROM team_members";
            $count_result = $conn->query($count_query);
            if ($count_result) {
                $count = $count_result->fetch_assoc()['count'];
                echo "<p>📊 Found $count team members in database</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ team_members table does not exist!</p>";
        }
        
        // Check if zones table exists
        $zones_check = $conn->query("SHOW TABLES LIKE 'zones'");
        if ($zones_check && $zones_check->num_rows > 0) {
            echo "<p style='color: green;'>✅ zones table exists!</p>";
            
            // Count zones
            $zones_count_query = "SELECT COUNT(*) as count FROM zones";
            $zones_count_result = $conn->query($zones_count_query);
            if ($zones_count_result) {
                $zones_count = $zones_count_result->fetch_assoc()['count'];
                echo "<p>📊 Found $zones_count zones in database</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ zones table does not exist!</p>";
        }
        
        // Test a sample query from team_members
        echo "<h3>Sample Team Members:</h3>";
        $sample_query = "SELECT name, position FROM team_members LIMIT 3";
        $sample_result = $conn->query($sample_query);
        
        if ($sample_result && $sample_result->num_rows > 0) {
            echo "<ul>";
            while ($row = $sample_result->fetch_assoc()) {
                echo "<li>" . htmlspecialchars($row['name']) . " - " . htmlspecialchars($row['position']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p style='color: orange;'>⚠️ No team members found in database</p>";
        }
        
    } else {
        echo "<p style='color: red;'>❌ Database queries not working!</p>";
        echo "<p>Error: " . $conn->error . "</p>";
    }
    
} else {
    echo "<p style='color: red;'>❌ Database connection failed!</p>";
    echo "<p>Error: " . $conn->connect_error . "</p>";
}

echo "<hr>";
echo "<h3>Connection Details:</h3>";
echo "<p><strong>Server:</strong> localhost</p>";
echo "<p><strong>Database:</strong> u976524705_TAPA_DB</p>";
echo "<p><strong>Username:</strong> u976524705_tapaortz</p>";
?> 