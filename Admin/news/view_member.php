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

<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<style>
/* Custom styles for card and list */
.card-body {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.card-columns {
    column-count: 2;
}

.card-img-top {
    border-radius: 50%;
    width: 150px;
    height: 150px;
    object-fit: cover;
    margin-bottom: 10px;
}

ul.list-unstyled li {
    border: 1px solid #ddd;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    /* background-color: #f9f9f9; */
}

ul.list-unstyled li a {
    color: #007bff;
}
</style>

<h1 class="text-center">Member Information</h1>

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
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
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

        // Determine the profile picture URL
        $profilePicUrl = !empty($member['profile_pic']) ? htmlspecialchars($member['profile_pic']) : '../../assets/img/tapa/person1.png';

        // Determine the payment status
        $paymentStatus = $member['pay_status'] == 1 ? 'Paid' : 'Not Paid';

        // Display specific fields in a Bootstrap card
        echo '<div class="container mt-4">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<h5 class="card-title">Member Details</h5>';
        echo '<img src="../../forms/uploads/' . $profilePicUrl . '" class="card-img-top" alt="Profile Picture">';
        echo '<ul class="list-unstyled">';
        echo '<li><strong>Name:</strong> ' . htmlspecialchars($member['fullname']) . '</li>';
        echo '<li><strong>Email:</strong> ' . htmlspecialchars($member['email']) . '</li>';
        echo '<li><strong>Phone:</strong> ' . htmlspecialchars($member['phone']) . '</li>';
        echo '</ul>';
        echo '</div>';
        echo '<div class="col-md-6">';
        echo '<ul class="list-unstyled">';
        echo '<li><strong>Postal Address:</strong> ' . htmlspecialchars($member['postal_address']) . '</li>';
        echo '<li><strong>Physical Address:</strong> ' . htmlspecialchars($member['physical_address']) . '</li>';
        echo '<li><strong>Membership:</strong> ' . htmlspecialchars($member['membership_type']) . '</li>';
        echo '<li><strong>Annual Fees:</strong> ' . $paymentStatus . '</li>';
        echo '<li><strong>CV:</strong> <a href="' . htmlspecialchars($member['cv_file']) . '" target="_blank">View CV</a></li>';
        echo '<li><strong>Annual Receipt:</strong> <a href="../../forms/uploads/' . htmlspecialchars($member['receipt']) . '" target="_blank">View Receipt</a></li>';
        echo '</ul>';
        echo '</div>'; // Close col-md-6
        echo '</div>'; // Close row

        echo '<div class="row bg-light mt-4">';
        echo '<div class="col-md-4 d-flex align-items-center">';
        // Add a form to trigger QR code generation
        echo '<form method="POST">';
        echo '<input type="hidden" name="member_id" value="' . $member_id . '">';
        echo '<button type="submit" name="generate_qr" class="btn btn-sm btn-primary">Generate QR Code</button>';
        echo '</form>';
        echo '</div>'; // Close col-md-4

        echo '<div class="col-md-4 text-center">';
        // Check if the "Generate QR Code" button was clicked
        if (isset($_POST['generate_qr'])) {
            // Generate the QR code if the button is clicked
            $userInfo = "TANZANIAN PSYCHOLOGICAL ASSOCIATION "   . "\n" .
               "Membership information"   . "\n" .
               "Name: " . $member['fullname'] . "\n" .
                "Email: " . $member['email'] . "\n" .
                "Phone: " . $member['phone'] . "\n" .
                "Membership: " . $member['membership_type'] . "\n" .
                "Annual Fees: " . $paymentStatus ;

            // Generate the QR code
            $qrCode = Builder::create()
                ->writer(new PngWriter())
                ->data($userInfo)
                ->encoding(new Encoding('UTF-8'))
                ->errorCorrectionLevel(ErrorCorrectionLevel::High)
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
            echo '<h5 class="mt-3">QR Code</h5>';
            echo '<img src="qrcodes/user_' . $member_id . '.png" alt="User QR Code" class="img-fluid">';
        }
        echo '</div>'; // Close col-md-4

        echo '<div class="col-md-4 d-flex align-items-center justify-content-end">';
        // Add buttons for downloading the QR code
        if (isset($_POST['generate_qr'])) {
            echo '<a href="qrcodes/user_' . $member_id . '.png" download="user_qr_code.png" class="btn btn-sm btn-success">Download QR Code</a>';
        }
        echo '</div>'; // Close col-md-4
        echo '</div>'; // Close row
        echo '</div>'; // Close card-body
        echo '</div>'; // Close card
        echo '</div>'; // Close container

    } else {
        echo "<div class='alert alert-danger' role='alert'>No member found with the provided ID.</div>";
    }

    // Close statement
    $stmt->close();

    // Close database connection
    $conn->close();
} else {
    echo "<div class='alert alert-danger' role='alert'>No member ID provided.</div>";
}
?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php include "footer.php"; ?>