<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Database connection parameters
include "./forms/connection.php";

// Function to generate a one-time password
function generateOTP() {
    return substr(md5(uniqid(rand(), true)), 0, 8); // Generate an 8-character alphanumeric password
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle receipt upload
    if (isset($_FILES['receipt'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        // Handle file upload
        $target_dir = "forms/uploads//receipts/";
        $target_file = $target_dir . basename($_FILES["receipt"]["name"]);

        if (move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file)) {
            // File uploaded successfully, generate one-time password
            $otp = generateOTP();

            // Store one-time password in the database
            $hashedOTP = password_hash($otp, PASSWORD_DEFAULT);
            $sql = "INSERT INTO otps (email, hashed_otp) VALUES ('$email', '$hashedOTP')";
            $conn->query($sql);

            // Send email with one-time password
            $subject = 'Your One-Time Password';
            $message = "Dear user,\n\nYour one-time password for completing the payment process is: $otp\n\nPlease enter this password on the payment confirmation page.\n\nRegards,\nTAPA";
            $headers = "From: TAPA <msiluandrew2020@gmail.com>";
            mail($email, $subject, $message, $headers);

            // Redirect to a page indicating successful receipt upload
            header("Location: login.php");
            exit();
        } else {
            // Error handling for file upload failure
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay Annual Fees</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Upload Receipt</h2>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="receipt">Receipt:</label>
                                <input type="file" name="receipt" id="receipt" class="form-control-file" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Upload Receipt</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
