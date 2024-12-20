<?php
session_start(); // Uncommented session_start()

// Database connection
include "../../forms/connection.php";
// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $paymentId = $_POST['paymentId'];
    $status = $_POST['status'];
    $amount = $_POST['amount'];

    // Update payment data in the database
    $sql = "UPDATE payments SET status = ?, amount = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $status, $amount, $paymentId);

    // Execute the statement
    if ($stmt->execute()) {
        // Payment updated successfully
        header('Location: member_list.php');
        exit(); // Terminate script execution after redirect
    } else {
        // Error occurred while updating payment
        echo "Error: " . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Payment</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Edit Payment Status
                    </div>
                    <div class="card-body">
                            <form id="paymentForm" action="add_payment.php" method="post">
                                <input type="hidden" id="userId" name="userId">
                                <div class="form-group">
                                    <label for="status">Payment Status:</label>
                                    <select class="form-control" id="status" name="status">
                                        <!-- Set the default value as "unpaid" -->
                                        <option value="unpaid" selected>Unpaid</option>
                                        <option value="paid">Paid</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="amount">Amount:</label>
                                    <input type="text" class="form-control" id="amount" name="amount">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
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