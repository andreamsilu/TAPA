<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo "<h2>🔍 Database Debug - Executive Committee & Zones</h2>";
echo "<hr>";

// Test database connection
echo "<h3>1. Database Connection Test</h3>";
try {
    include_once 'forms/connection.php';
    
    if ($conn) {
        echo "<p style='color: green;'>✅ Database connection successful</p>";
        echo "<p><strong>Server:</strong> localhost</p>";
        echo "<p><strong>Database:</strong> u976524705_TAPA_DB</p>";
        echo "<p><strong>Username:</strong> u976524705_tapaortz</p>";
    } else {
        echo "<p style='color: red;'>❌ Database connection failed - \$conn is null</p>";
        exit();
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Database connection error: " . $e->getMessage() . "</p>";
    exit();
}

echo "<hr>";

// Test basic query
echo "<h3>2. Basic Query Test</h3>";
try {
    $test_query = "SELECT 1 as test";
    $result = $conn->query($test_query);
    
    if ($result) {
        echo "<p style='color: green;'>✅ Basic queries working</p>";
    } else {
        echo "<p style='color: red;'>❌ Basic queries failed: " . $conn->error . "</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Query error: " . $e->getMessage() . "</p>";
}

echo "<hr>";

// Check all tables
echo "<h3>3. All Database Tables</h3>";
try {
    $tables_query = "SHOW TABLES";
    $tables_result = $conn->query($tables_query);
    
    if ($tables_result && $tables_result->num_rows > 0) {
        echo "<p style='color: green;'>✅ Found " . $tables_result->num_rows . " tables:</p>";
        echo "<ul>";
        while ($table = $tables_result->fetch_array()) {
            echo "<li>" . $table[0] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p style='color: red;'>❌ No tables found or query failed</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error listing tables: " . $e->getMessage() . "</p>";
}

echo "<hr>";

// Check team_members table specifically
echo "<h3>4. Team Members Table Check</h3>";
try {
    // Check if table exists
    $table_check = $conn->query("SHOW TABLES LIKE 'team_members'");
    if ($table_check && $table_check->num_rows > 0) {
        echo "<p style='color: green;'>✅ team_members table exists</p>";
        
        // Check table structure
        $structure_query = "DESCRIBE team_members";
        $structure_result = $conn->query($structure_query);
        
        if ($structure_result && $structure_result->num_rows > 0) {
            echo "<p><strong>Table structure:</strong></p>";
            echo "<table border='1' style='border-collapse: collapse;'>";
            echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
            while ($field = $structure_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $field['Field'] . "</td>";
                echo "<td>" . $field['Type'] . "</td>";
                echo "<td>" . $field['Null'] . "</td>";
                echo "<td>" . $field['Key'] . "</td>";
                echo "<td>" . $field['Default'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        
        // Check data count
        $count_query = "SELECT COUNT(*) as count FROM team_members";
        $count_result = $conn->query($count_query);
        
        if ($count_result) {
            $count = $count_result->fetch_assoc()['count'];
            echo "<p><strong>Total records:</strong> $count</p>";
            
            if ($count > 0) {
                // Show sample data
                $sample_query = "SELECT * FROM team_members LIMIT 3";
                $sample_result = $conn->query($sample_query);
                
                if ($sample_result && $sample_result->num_rows > 0) {
                    echo "<p><strong>Sample data:</strong></p>";
                    echo "<table border='1' style='border-collapse: collapse;'>";
                    echo "<tr><th>ID</th><th>Name</th><th>Position</th><th>Image</th><th>Order</th></tr>";
                    while ($row = $sample_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['position']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['image_url'] ?? 'NULL') . "</td>";
                        echo "<td>" . $row['position_order'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            } else {
                echo "<p style='color: orange;'>⚠️ Table exists but has no data</p>";
            }
        }
        
    } else {
        echo "<p style='color: red;'>❌ team_members table does not exist</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error checking team_members: " . $e->getMessage() . "</p>";
}

echo "<hr>";

// Check zones table specifically
echo "<h3>5. Zones Table Check</h3>";
try {
    // Check if table exists
    $zones_check = $conn->query("SHOW TABLES LIKE 'zones'");
    if ($zones_check && $zones_check->num_rows > 0) {
        echo "<p style='color: green;'>✅ zones table exists</p>";
        
        // Check table structure
        $zones_structure_query = "DESCRIBE zones";
        $zones_structure_result = $conn->query($zones_structure_query);
        
        if ($zones_structure_result && $zones_structure_result->num_rows > 0) {
            echo "<p><strong>Table structure:</strong></p>";
            echo "<table border='1' style='border-collapse: collapse;'>";
            echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
            while ($field = $zones_structure_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $field['Field'] . "</td>";
                echo "<td>" . $field['Type'] . "</td>";
                echo "<td>" . $field['Null'] . "</td>";
                echo "<td>" . $field['Key'] . "</td>";
                echo "<td>" . $field['Default'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        
        // Check data count
        $zones_count_query = "SELECT COUNT(*) as count FROM zones";
        $zones_count_result = $conn->query($zones_count_query);
        
        if ($zones_count_result) {
            $zones_count = $zones_count_result->fetch_assoc()['count'];
            echo "<p><strong>Total records:</strong> $zones_count</p>";
            
            if ($zones_count > 0) {
                // Show sample data
                $zones_sample_query = "SELECT * FROM zones LIMIT 3";
                $zones_sample_result = $conn->query($zones_sample_query);
                
                if ($zones_sample_result && $zones_sample_result->num_rows > 0) {
                    echo "<p><strong>Sample data:</strong></p>";
                    echo "<table border='1' style='border-collapse: collapse;'>";
                    echo "<tr><th>ID</th><th>Zone Name</th><th>Description</th><th>Contact</th></tr>";
                    while ($zone = $zones_sample_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $zone['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($zone['zone_name']) . "</td>";
                        echo "<td>" . htmlspecialchars(substr($zone['description'] ?? '', 0, 50)) . "...</td>";
                        echo "<td>" . htmlspecialchars($zone['contact_info'] ?? 'NULL') . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            } else {
                echo "<p style='color: orange;'>⚠️ Table exists but has no data</p>";
            }
        }
        
    } else {
        echo "<p style='color: red;'>❌ zones table does not exist</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error checking zones: " . $e->getMessage() . "</p>";
}

echo "<hr>";

// Test the exact queries from about.php
echo "<h3>6. About Page Query Test</h3>";

// Test team_members query
echo "<h4>Team Members Query:</h4>";
try {
    $about_team_query = "SELECT * FROM team_members ORDER BY position_order";
    $about_team_result = $conn->query($about_team_query);
    
    if ($about_team_result) {
        echo "<p style='color: green;'>✅ Query executed successfully</p>";
        echo "<p><strong>Records found:</strong> " . $about_team_result->num_rows . "</p>";
    } else {
        echo "<p style='color: red;'>❌ Query failed: " . $conn->error . "</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Query error: " . $e->getMessage() . "</p>";
}

// Test zones query
echo "<h4>Zones Query:</h4>";
try {
    $about_zones_query = "SELECT * FROM zones ORDER BY zone_name";
    $about_zones_result = $conn->query($about_zones_query);
    
    if ($about_zones_result) {
        echo "<p style='color: green;'>✅ Query executed successfully</p>";
        echo "<p><strong>Records found:</strong> " . $about_zones_result->num_rows . "</p>";
    } else {
        echo "<p style='color: red;'>❌ Query failed: " . $conn->error . "</p>";
    }
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Query error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<p><strong>Debug completed. Check the results above to identify the issue.</strong></p>";
?> 