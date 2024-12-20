<?php
// Enable error reporting for debugging
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Include database connection
include('db.php');

// Initialize message and status variables
$message = '';
$status = '';

// Check if the member ID is provided in the query string
if (isset($_GET['id'])) {
    $member_id = intval($_GET['id']);

    // Fetch the existing data for the member from the database
    $sql = "SELECT * FROM member WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $member_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $member = $result->fetch_assoc();
        } else {
            $status = 'error';
            $message = 'Member not found.';
        }
        $stmt->close();
    } else {
        $status = 'error';
        $message = 'Error preparing statement: ' . htmlspecialchars($conn->error);
    }
} else {
    $status = 'error';
    $message = 'No member ID provided.';
}

// Process form submission for updating
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Validate and sanitize input data
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_SPECIAL_CHARS);
    $birthdate = $_POST['birthdate'];
    $country = filter_var(trim($_POST['country']), FILTER_SANITIZE_SPECIAL_CHARS);
    $physical_address = filter_var(trim($_POST['physical_address']), FILTER_SANITIZE_SPECIAL_CHARS);
    $member_type_id = intval($_POST['member_type_id']);
    $registration_fee_paid = isset($_POST['registration_fee_paid']) ? 1 : 0;

    $firstname = filter_var(trim($_POST['firstname']), FILTER_SANITIZE_SPECIAL_CHARS);
    $middlename = filter_var(trim($_POST['middlename']), FILTER_SANITIZE_SPECIAL_CHARS);
    $lastname = filter_var(trim($_POST['lastname']), FILTER_SANITIZE_SPECIAL_CHARS);

    // Prepare SQL statement to update member
    $sql = "UPDATE member SET email=?, phone=?, birthdate=?, country=?, physical_address=?, member_type_id=?, registration_fee_paid=?, firstname=?, middlename=?, lastname=? WHERE id=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssisssi", $email, $phone, $birthdate, $country, $physical_address, $member_type_id, $registration_fee_paid, $firstname, $middlename, $lastname, $member_id);
        if ($stmt->execute()) {
            $status = 'success';
            $message = 'Member updated successfully!';
            header('Location:member.php');
        } else {
            $status = 'error';
            $message = 'Error updating member: ' . htmlspecialchars($stmt->error);
        }
        $stmt->close();
    } else {
        $status = 'error';
        $message = 'Error preparing statement: ' . htmlspecialchars($conn->error);
    }
}

// Fetch member types from the database
$member_types = [];
$member_type_sql = "SELECT id, name FROM member_type";
if ($result = $conn->query($member_type_sql)) {
    while ($row = $result->fetch_assoc()) {
        $member_types[] = $row;
    }
    $result->free();
} else {
    $message = 'Error fetching member types: ' . htmlspecialchars($conn->error);
}

$conn->close();
?>

<?php include 'header.php' ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Member</h4>
        </div>
        <div class="card-body">
            <?php if ($status === 'error'): ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
            <?php elseif ($status === 'success'): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
            <?php endif; ?>

            <?php if (isset($member)): ?>
            <form action="" method="POST" class="row g-3">
                <div class="col-md-6">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname"
                        value="<?php echo htmlspecialchars($member['firstname']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="middlename" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middlename" name="middlename"
                        value="<?php echo htmlspecialchars($member['middlename']); ?>">
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname"
                        value="<?php echo htmlspecialchars($member['lastname']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?php echo htmlspecialchars($member['email']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="<?php echo htmlspecialchars($member['phone']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate"
                        value="<?php echo $member['birthdate']; ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" id="country" name="country"
                        value="<?php echo htmlspecialchars($member['country']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="physical_address" class="form-label">Physical Address</label>
                    <input type="text" class="form-control" id="physical_address" name="physical_address"
                        value="<?php echo htmlspecialchars($member['physical_address']); ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="member_type_id" class="form-label">Member Type</label>
                    <select class="form-control" id="member_type_id" name="member_type_id" required>
                        <option value="">Select Member Type</option>
                        <?php foreach ($member_types as $type): ?>
                        <option value="<?php echo $type['id']; ?>"
                            <?php echo ($member['member_type_id'] == $type['id']) ? 'selected' : ''; ?>>
                            <?php echo $type['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="registration_fee_paid">
                        <input type="checkbox" id="registration_fee_paid" name="registration_fee_paid"
                            <?php echo ($member['registration_fee_paid']) ? 'checked' : ''; ?>>
                        Registration Fee Paid
                    </label>
                </div>

                <div class="col-12">
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </div>
            </form>
            <?php else: ?>
            <p>No member data available to edit.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>