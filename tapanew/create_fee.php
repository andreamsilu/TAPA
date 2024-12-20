<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require 'db.php';

// Fetch members, membership years, and fee types for dropdowns
$members = $conn->query("SELECT id, firstname FROM member");
$years = $conn->query("SELECT id, year FROM membership_year");
$feeTypes = $conn->query("SELECT id, fee_amount FROM fee_per_type");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST['member_id'];
    $year_id = $_POST['year_id'];
    $fee_type_id = $_POST['fee_type_id'];
    $status = isset($_POST['status']) ? 1 : 0; // Checkbox for status

    // Insert the new fee record
    $stmt = $conn->prepare("INSERT INTO fees (member_id, year_id, fee_type_id, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiii", $member_id, $year_id, $fee_type_id, $status);
    if ($stmt->execute()) {
        header("Location: list_fees.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<?php include 'header.php' ?>

<div class="container mt-5">
    <h2>Add Fee</h2>
    <form method="POST" action="create_fee.php">
        <div class="form-group">
            <label for="member_id">Member:</label>
            <select name="member_id" class="form-control" required>
                <option value="">Select Member</option>
                <?php while ($row = $members->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['firstname']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="year_id">Membership Year:</label>
            <select name="year_id" class="form-control" required>
                <option value="">Select Year</option>
                <?php while ($row = $years->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['year']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="fee_type_id">Fee Type:</label>
            <select name="fee_type_id" class="form-control" required>
                <option value="">Select Fee Type</option>
                <?php while ($row = $feeTypes->fetch_assoc()) { ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['fee_amount']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="checkbox" name="status" value="1"> Paid
        </div>
        <button type="submit" class="btn btn-primary">Add Fee</button>
        <a href="list_fees.php" class="btn btn-secondary">Back</a>
    </form>
</div>
<?php include 'footer.php' ?>