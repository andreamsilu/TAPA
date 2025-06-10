<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Test About Page</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>About Page Test</h1>
        
        <?php
        // Test database connection
        echo "<h3>Database Connection Test:</h3>";
        include_once 'forms/connection.php';
        
        if ($conn) {
            echo "<p style='color: green;'>✅ Database connected</p>";
            
            // Test team_members table
            echo "<h4>Team Members Test:</h4>";
            try {
                $tableCheck = $conn->query("SHOW TABLES LIKE 'team_members'");
                if ($tableCheck && $tableCheck->num_rows > 0) {
                    echo "<p style='color: green;'>✅ team_members table exists</p>";
                    
                    $query = "SELECT * FROM team_members ORDER BY position_order LIMIT 3";
                    $result = $conn->query($query);
                    
                    if ($result && $result->num_rows > 0) {
                        echo "<p style='color: green;'>✅ Found " . $result->num_rows . " team members</p>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<p>- " . htmlspecialchars($row['name']) . " (" . htmlspecialchars($row['position']) . ")</p>";
                        }
                    } else {
                        echo "<p style='color: orange;'>⚠️ No team members found</p>";
                    }
                } else {
                    echo "<p style='color: red;'>❌ team_members table does not exist</p>";
                }
            } catch (Exception $e) {
                echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
            }
            
            // Test zones table
            echo "<h4>Zones Test:</h4>";
            try {
                $zonesCheck = $conn->query("SHOW TABLES LIKE 'zones'");
                if ($zonesCheck && $zonesCheck->num_rows > 0) {
                    echo "<p style='color: green;'>✅ zones table exists</p>";
                    
                    $zonesQuery = "SELECT * FROM zones ORDER BY zone_name LIMIT 3";
                    $zonesResult = $conn->query($zonesQuery);
                    
                    if ($zonesResult && $zonesResult->num_rows > 0) {
                        echo "<p style='color: green;'>✅ Found " . $zonesResult->num_rows . " zones</p>";
                        while ($zone = $zonesResult->fetch_assoc()) {
                            echo "<p>- " . htmlspecialchars($zone['zone_name']) . "</p>";
                        }
                    } else {
                        echo "<p style='color: orange;'>⚠️ No zones found</p>";
                    }
                } else {
                    echo "<p style='color: red;'>❌ zones table does not exist</p>";
                }
            } catch (Exception $e) {
                echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
            }
            
        } else {
            echo "<p style='color: red;'>❌ Database connection failed</p>";
        }
        ?>
        
        <hr>
        <h3>File Includes Test:</h3>
        <?php
        $files_to_test = [
            'titleIcon.php',
            'header.php',
            'footer.php',
            'commitees.php',
            'forms/connection.php'
        ];
        
        foreach ($files_to_test as $file) {
            if (file_exists($file)) {
                echo "<p style='color: green;'>✅ $file exists</p>";
            } else {
                echo "<p style='color: red;'>❌ $file missing</p>";
            }
        }
        ?>
    </div>
</body>
</html> 