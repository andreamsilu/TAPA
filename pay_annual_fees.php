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

        // Check if the user exists in the users table
        $sql_select_user = "SELECT * FROM users WHERE email = ?";
        $stmt_select_user = $conn->prepare($sql_select_user);
        $stmt_select_user->bind_param("s", $email);
        $stmt_select_user->execute();
        $result_select_user = $stmt_select_user->get_result();

        if ($result_select_user->num_rows > 0) {
            // User exists, proceed with receipt upload and OTP generation
            $row = $result_select_user->fetch_assoc();
            $user_id = $row['id'];

            // Handle file upload
            $target_dir = "forms/uploads/";
            $target_file = $target_dir . basename($_FILES["receipt"]["name"]);

            if (move_uploaded_file($_FILES["receipt"]["tmp_name"], $target_file)) {
                // File uploaded successfully, generate one-time password
                $otp = generateOTP();

                // Store one-time password and receipt in the users table
                $hashedOTP = password_hash($otp, PASSWORD_DEFAULT);
                $sql_update_user = "UPDATE users SET password = ?, receipt = ? WHERE id = ?";
                $stmt_update_user = $conn->prepare($sql_update_user);
                $stmt_update_user->bind_param("ssi", $hashedOTP, $target_file, $user_id);
                $stmt_update_user->execute();

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
        } else {
            // User does not exist
            echo "User with the provided email does not exist.";
        }
        $stmt_select_user->close(); // Close the statement
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
