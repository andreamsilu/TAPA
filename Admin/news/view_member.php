<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "navigation.php";
require '../../vendor/autoload.php'; // Autoload for the QR code library

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\LabelAlignment;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\RoundBlockSizeMode;
?>

<style>
/* Updated table styles */
table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ddd;
    margin: 20px auto;
}

th,
td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
    /* Background color for table headers */
}

tr:nth-child(even) {
    background-color: #f9f9f9;
    /* Background color for even rows */
}

tr:hover {
    background-color: #f5f5f5;
    /* Background color on hover */
}

h1 {
    text-align: center;
}
</style>

<h1>Member Information</h1>

<?php
// Database connection
include "../../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    exit();
}

// Check if 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    $member_id = $_GET['id'];

    // Prepare a SELECT query to fetch specific member information by ID
    $stmt = $conn->prepare("SELECT fullname, email, phone FROM users WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind the parameter
    $stmt->bind_param("i", $member_id);

    // Execute the statement
    if (!$stmt->execute()) {
        die("Execution failed: " . $stmt->error);
    }

    // Get the result
    $result = $stmt->get_result();

    // Check if any rows were returned
    if ($result->num_rows > 0) {
        $member = $result->fetch_assoc();

        // Display specific fields
        echo "<table>";
        echo "<tr><th>Name</th><td>" . htmlspecialchars($member['fullname']) . "</td></tr>";
        echo "<tr><th>Email</th><td>" . htmlspecialchars($member['email']) . "</td></tr>";
        echo "<tr><th>Phone</th><td>" . htmlspecialchars($member['phone']) . "</td></tr>";
        echo "</table>";

        // Add a form to trigger QR code generation
        echo '<form method="POST">';
        echo '<input type="hidden" name="member_id" value="' . $member_id . '">';
        echo '<button type="submit" name="generate_qr" class="btn btn-primary">Generate QR Code</button>';
        echo '</form>';

        // Check if the "Generate QR Code" button was clicked
        if (isset($_POST['generate_qr'])) {
            // Generate the QR code if the button is clicked
            $userInfo = "Name: " . $member['fullname'] . "\n" .
                "Email: " . $member['email'] . "\n" .
                "Phone: " . $member['phone'];

            // Generate the QR code
            $qrCode = Builder::create()
                ->writer(new PngWriter())
                ->data($userInfo)
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(ErrorCorrectionLevel::High) // Changed to use the static method
                ->size(300)
                ->margin(10)
                ->roundBlockSizeMode(RoundBlockSizeMode::Margin)
                ->labelText('Scan to view info')
                ->labelAlignment(LabelAlignment::Center)
                ->build();

            // Save QR code to file
            $qrCodePath = __DIR__ . '/qrcodes/user_' . $member_id . '.png';
            $qrCode->saveToFile($qrCodePath);

            // Display the QR code
            echo '<h2>QR Code</h2>';
            echo '<img src="qrcodes/user_' . $member_id . '.png" alt="User QR Code">';
            
            // Add buttons for downloading and sharing the QR code
            echo '<br><a href="qrcodes/user_' . $member_id . '.png" download="user_qr_code.png" class="btn btn-success">Download QR Code</a>';
            echo '<br><button id="shareBtn" class="btn btn-info">Share QR Code</button>';
            
            // Add JavaScript for the Share functionality
            echo '
            <script>
                const shareBtn = document.getElementById("shareBtn");
                shareBtn.addEventListener("click", async () => {
                    if (navigator.share) {
                        try {
                            await navigator.share({
                                title: "QR Code",
                                text: "Check out this QR code.",
                                files: [new File([await fetch("qrcodes/user_' . $member_id . '.png").then(r => r.blob())], "user_qr_code.png", { type: "image/png" })]
                            });
                            console.log("QR Code shared successfully.");
                        } catch (error) {
                            console.error("Error sharing QR Code: ", error);
                        }
                    } else {
                        alert("Sharing is not supported on your browser.");
                    }
                });
            </script>';
        }
    } else {
        echo "No member found with the provided ID.";
    }

    // Close statement
    $stmt->close();

    // Close database connection
    $conn->close();
} else {
    echo "No member ID provided.";
}

?>

<?php include "footer.php"; ?>