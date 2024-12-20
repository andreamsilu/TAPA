<?php
require 'db.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM fees WHERE id = $id");
$row = $result->fetch_assoc();

// Fetch members, membership years, and fee types for dropdowns
$members = $conn->query("SELECT id, name FROM members");
$years = $conn->query("SELECT id, year FROM membership_year");
$feeTypes = $conn->query("SELECT id, type_name FROM fee_types");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST['member_id'];
    $year_id = $_POST['year_id'];
    $fee_type_id = $_POST['fee_type_id'];
    $status = isset($_POST['status']) ? 1 : 0; // Checkbox for status

    // Update the fee record
    $stmt = $conn->prepare("UPDATE fees SET member_id = ?, year_id = ?, fee_type_id = ?, status = ? WHERE id = ?");
    $stmt->bind_param("iiiii", $member_id, $year_id, $fee_type_id, $status, $id);
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
    <h2>Edit Fee</h2>
    <form method="POST" action="edit_fee.php?id=<?php echo $id; ?>">
        <div class="form-group">
            <label for="member_id">Member:</label>
            <select name="member_id" class="form-control" required>
                <option value="">Select Member</option>
                <?php while ($rowMember = $members->fetch_assoc()) { ?>
                <option value="<?php echo $rowMember['id']; ?>"
                    <?php echo $rowMember['id'] == $row['member_id'] ? 'selected' : ''; ?>>
                    <?php echo $rowMember['name']; ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="year_id">Membership Year:</label>
            <select name="year_id" class="form-control" required>
                <option value="">Select Year</option>
                <?php while ($rowYear = $years->fetch_assoc()) { ?>
                <option value="<?php echo $rowYear['id']; ?>"
                    <?php echo $rowYear['id'] == $row['year_id'] ? 'selected' : ''; ?>>
                    <?php echo $rowYear['year']; ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="fee_type_id">Fee Type:</label>
            <select name="fee_type_id" class="form-control" required>
                <option value="">Select Fee Type</option>
                <?php while ($rowFeeType = $feeTypes->fetch_assoc()) { ?>
                <option value="<?php echo $rowFeeType['id']; ?>"
                    <?php echo $rowFeeType['id'] == $row['fee_type_id'] ? 'selected' : ''; ?>>
                    <?php echo $rowFeeType['type_name']; ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="checkbox" name="status" value="1" <?php echo $row['status'] ? 'checked' : ''; ?>> Paid
        </div>
        <button type="submit" class="btn btn-primary">Update Fee</button>
        <a href="list_fees.php" class="btn btn-secondary">Back</a>
    </form>
</div>
<?php include 'footer.php' ?>