<?php
// Enable error display
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);

echo "<h2>PHP Error Configuration</h2>";

// Show current error settings
echo "<h3>Current Error Settings:</h3>";
echo "<ul>";
echo "<li><strong>error_reporting:</strong> " . error_reporting() . "</li>";
echo "<li><strong>display_errors:</strong> " . (ini_get('display_errors') ? 'ON' : 'OFF') . "</li>";
echo "<li><strong>display_startup_errors:</strong> " . (ini_get('display_startup_errors') ? 'ON' : 'OFF') . "</li>";
echo "<li><strong>log_errors:</strong> " . (ini_get('log_errors') ? 'ON' : 'OFF') . "</li>";
echo "<li><strong>error_log:</strong> " . ini_get('error_log') . "</li>";
echo "</ul>";

// Test error display
echo "<h3>Testing Error Display:</h3>";
echo "<p>If you can see this message, PHP is working.</p>";

// Generate a test error
echo "<h4>Test Error (should be visible):</h4>";
$undefined_variable = $this_variable_does_not_exist;

echo "<h4>Test Warning (should be visible):</h4>";
$result = 10 / 0;

echo "<h4>Test Notice (should be visible):</h4>";
$array = ['test'];
echo $array[1]; // Undefined index

echo "<hr>";
echo "<h3>PHP Information:</h3>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Server Software:</strong> " . $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' . "</p>";
echo "<p><strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown' . "</p>";

// Check if we can modify settings
echo "<h3>Settings Modification Test:</h3>";
$original_display_errors = ini_get('display_errors');
ini_set('display_errors', 1);
$new_display_errors = ini_get('display_errors');
echo "<p><strong>Can modify display_errors:</strong> " . ($new_display_errors ? 'YES' : 'NO') . "</p>";

// Restore original setting
ini_set('display_errors', $original_display_errors);

echo "<hr>";
echo "<h3>Instructions:</h3>";
echo "<ol>";
echo "<li>If you can see the test errors above, error display is working.</li>";
echo "<li>If you don't see errors, check your php.ini file or contact your hosting provider.</li>";
echo "<li>Add these lines to the top of any PHP file to enable errors:</li>";
echo "</ol>";
echo "<pre style='background: #f4f4f4; padding: 10px; border: 1px solid #ddd;'>";
echo "&lt;?php\n";
echo "error_reporting(E_ALL);\n";
echo "ini_set('display_errors', 1);\n";
echo "ini_set('display_startup_errors', 1);\n";
echo "?&gt;";
echo "</pre>";
?> 