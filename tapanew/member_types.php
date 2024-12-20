<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require 'db.php'; // Ensure this file contains the database connection logic

// Add a new member type
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_member_type'])) {
    $name = $_POST['name'];

    // Check if the member type already exists
    $checkStmt = mysqli_prepare($conn, "SELECT COUNT(*) FROM member_type WHERE name = ?");
    mysqli_stmt_bind_param($checkStmt, "s", $name);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_bind_result($checkStmt, $count);
    mysqli_stmt_fetch($checkStmt);
    mysqli_stmt_close($checkStmt);

    if ($count > 0) {
        $errorMessage = "Member type already exists!";
    } else {
        // Prepare and execute the insert statement
        $stmt = mysqli_prepare($conn, "INSERT INTO member_type (name) VALUES (?)");
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        
        // Check for success
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $successMessage = "Member type added successfully!";
        }
        mysqli_stmt_close($stmt);
    }
}

// Assign fee amount to member type
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assign_fee'])) {
    $memberTypeId = $_POST['member_type_id'];
    $feeAmount = $_POST['fee_amount'];

    // Check if fee for the member type already exists
    $checkFeeStmt = mysqli_prepare($conn, "SELECT COUNT(*) FROM fee_per_type WHERE member_type_id = ?");
    mysqli_stmt_bind_param($checkFeeStmt, "i", $memberTypeId);
    mysqli_stmt_execute($checkFeeStmt);
    mysqli_stmt_bind_result($checkFeeStmt, $count);
    mysqli_stmt_fetch($checkFeeStmt);
    mysqli_stmt_close($checkFeeStmt);

    if ($count > 0) {
        $errorMessage = "Fee already assigned to this membership type!";
    } else {
        // Prepare and execute the insert statement
        $stmt = mysqli_prepare($conn, "INSERT INTO fee_per_type (member_type_id, fee_amount) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "id", $memberTypeId, $feeAmount);
        mysqli_stmt_execute($stmt);
        
        // Check for success
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $successMessage = "Fee amount assigned successfully!";
        }
        mysqli_stmt_close($stmt);
    }
}

// Edit membership type
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_member_type'])) {
    $memberTypeId = $_POST['member_type_id'];
    $newName = $_POST['new_name'];

    // Prepare and execute the update statement
    $stmt = mysqli_prepare($conn, "UPDATE member_type SET name = ? WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "si", $newName, $memberTypeId);
    mysqli_stmt_execute($stmt);
    
    // Check for success
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $successMessage = "Member type updated successfully!";
    } else {
        $errorMessage = "Failed to update member type or no changes made.";
    }
    mysqli_stmt_close($stmt);
}

// Delete membership type
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_member_type'])) {
    $memberTypeId = $_POST['member_type_id'];

    // Prepare and execute the delete statement
    $stmt = mysqli_prepare($conn, "DELETE FROM member_type WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $memberTypeId);
    mysqli_stmt_execute($stmt);
    
    // Check for success
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        $successMessage = "Member type deleted successfully!";
    } else {
        $errorMessage = "Failed to delete member type.";
    }
    mysqli_stmt_close($stmt);
}

// Fetch all member types with their assigned fee amounts
$query = "SELECT mt.id, mt.name, COALESCE(fpt.fee_amount, 0) AS fee_amount 
          FROM member_type mt 
          LEFT JOIN fee_per_type fpt ON mt.id = fpt.member_type_id";
$result = mysqli_query($conn, $query);
$memberTypes = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the connection
mysqli_close($conn);
?>

<?php include 'header.php' ?>

<div class="container mt-5">
    <h2>Membership Types</h2>

    <!-- Button to open the modal for adding new membership type -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addMemberTypeModal">
        Add New Membership Type
    </button>

    <!-- Button to open the modal for assigning fee -->
    <button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#assignFeeModal">
        Assign Fee Amount
    </button>

    <!-- DataTable for displaying member types -->
    <table id="memberTypesTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Membership Type Name</th>
                <th>Fee Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($memberTypes as $type): ?>
            <tr>
                <td><?php echo htmlspecialchars($type['id']); ?></td>
                <td><?php echo htmlspecialchars($type['name']); ?></td>
                <td><?php echo htmlspecialchars($type['fee_amount']); ?></td>
                <td>
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMemberTypeModal"
                        data-id="<?php echo $type['id']; ?>"
                        data-name="<?php echo htmlspecialchars($type['name']); ?>">Edit</button>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="member_type_id" value="<?php echo $type['id']; ?>">
                        <button type="submit" name="delete_member_type" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this member type?');">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal for adding new membership type -->
<div class="modal fade" id="addMemberTypeModal" tabindex="-1" aria-labelledby="addMemberTypeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMemberTypeModalLabel">Add New Membership Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="addMemberTypeForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Membership Type Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Membership Type Name"
                            required>
                    </div>
                    <button type="submit" name="add_member_type" class="btn btn-primary">Add Membership
                        Type</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for assigning fee amount -->
<div class="modal fade" id="assignFeeModal" tabindex="-1" aria-labelledby="assignFeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignFeeModalLabel">Assign Fee Amount</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="assignFeeForm">
                    <div class="mb-3">
                        <label for="member_type_id" class="form-label">Membership Type</label>
                        <select class="form-select" id="member_type_id" name="member_type_id" required>
                            <option value="" disabled selected>Select Membership Type</option>
                            <?php foreach ($memberTypes as $type): ?>
                            <option value="<?php echo htmlspecialchars($type['id']); ?>">
                                <?php echo htmlspecialchars($type['name']); ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fee_amount" class="form-label">Fee Amount</label>
                        <input type="number" step="0.01" class="form-control" id="fee_amount" name="fee_amount"
                            placeholder="Fee Amount" required>
                    </div>
                    <button type="submit" name="assign_fee" class="btn btn-primary">Assign Fee</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for editing membership type -->
<div class="modal fade" id="editMemberTypeModal" tabindex="-1" aria-labelledby="editMemberTypeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMemberTypeModalLabel">Edit Membership Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="editMemberTypeForm">
                    <input type="hidden" name="member_type_id" id="edit_member_type_id">
                    <div class="mb-3">
                        <label for="new_name" class="form-label">New Membership Type Name</label>
                        <input type="text" class="form-control" id="new_name" name="new_name" required>
                    </div>
                    <button type="submit" name="edit_member_type" class="btn btn-warning">Update Membership
                        Type</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#memberTypesTable').DataTable();

    // Handle edit button click
    $('#editMemberTypeModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var memberTypeId = button.data('id');
        var memberTypeName = button.data('name');

        var modal = $(this);
        modal.find('#edit_member_type_id').val(memberTypeId);
        modal.find('#new_name').val(memberTypeName);
    });

    // Display success or error messages in modal
    <?php if (isset($successMessage)): ?>
    alert('<?php echo htmlspecialchars($successMessage); ?>');
    <?php elseif (isset($errorMessage)): ?>
    alert('<?php echo htmlspecialchars($errorMessage); ?>');
    <?php endif; ?>
});
</script>
<?php include 'footer.php' ?>