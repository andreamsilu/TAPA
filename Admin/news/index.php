<?php
session_start(); // Uncommented session_start()

include "navigation.php";
include "../../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}

$email = $_SESSION['email'];
// Total number of members
$totalMembersQuery = "SELECT COUNT(*) AS total_members FROM users";
$totalMembersResult = $conn->query($totalMembersQuery);
$totalMembers = $totalMembersResult->fetch_assoc()['total_members'];

// Total pending payments
$totalPendingQuery = "SELECT COUNT(*) AS total_pending FROM payments WHERE status = 'pending'";
$totalPendingResult = $conn->query($totalPendingQuery);
$totalPending = $totalPendingResult->fetch_assoc()['total_pending'];

// Total paid payments
$totalPaidQuery = "SELECT COUNT(*) AS total_paid FROM payments WHERE status = 'paid'";
$totalPaidResult = $conn->query($totalPaidQuery);
$totalPaid = $totalPaidResult->fetch_assoc()['total_paid'];

// Total unpaid payments
$totalUnpaidQuery = "SELECT COUNT(*) AS total_unpaid FROM payments WHERE status = 'unpaid'";
$totalUnpaidResult = $conn->query($totalUnpaidQuery);
$totalUnpaid = $totalUnpaidResult->fetch_assoc()['total_unpaid'];

// Total amount collected
$totalAmountQuery = "SELECT SUM(amount) AS total_amount FROM payments WHERE status = 'paid'";
$totalAmountResult = $conn->query($totalAmountQuery);
$totalAmount = $totalAmountResult->fetch_assoc()['total_amount'];


//total news
$totlaNewsQuery = "SELECT COUNT(*) AS total_news FROM news";
$totalNewsResult = $conn->query($totlaNewsQuery);
$totalNews = $totalNewsResult->fetch_assoc()['total_news'];
?>
<style>
    .icon1 {
        font-size: 50px;
    }
</style>
<div class="container mt-4">
    <h2 class="text-center">Dashboard</h2>
    <h3><?php echo $email ?></h3>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card bg-primary">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Amount(Tzs)</h5>
                    <p class="display-4"><?php echo $totalAmount; ?></p>
                    <i class="bi bi-currency-dollar fa-3x text-light  icon1"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-success">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Paid Payments</h5>
                    <p class="display-4"><?php echo $totalPaid; ?></p>
                    <i class="bi bi-cash-stack fa-3x text-light icon1"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-warning">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Pending fees</h5>
                    <p class="display-4"><?php echo $totalPending; ?></p>
                    <i class="bi bi-cash-coin fa-3x text-light icon1"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-4">
            <div class="card bg-danger">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Unpaid fees</h5>
                    <p class="display-4"><?php echo $totalUnpaid; ?></p>
                    <i class="bi bi-cash-coin fa-3x text-light icon1"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row  mt-4">
        <div class="col-md-3 mb-4">
            <div class="card bg-info">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Members</h5>
                    <p class="display-4"><?php echo $totalMembers; ?></p>
                    <i class="bi bi-people-fill fa-3x text-light icon1"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card bg-info">
                <div class="card-body text-center">
                    <h5 class="card-title">Total updates</h5>
                    <p class="display-4"><?php echo $totalNews; ?></p>
                    <i class="bi bi-people-fill fa-3x text-light icon1"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>