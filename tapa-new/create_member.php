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

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $education = filter_var(trim($_POST['education']), FILTER_SANITIZE_SPECIAL_CHARS);

    // Validate birthdate
    if (empty($birthdate)) {
        $status = 'error';
        $message = 'Birthdate is required.';
    } else {
        // Retrieve the last registered regno from the database
        $sql = "SELECT regno FROM member ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $last_regno = $row['regno'];
            $last_number = intval(substr($last_regno, 4));
            $new_number = $last_number + 1;
            $regno = 'TAPA' . str_pad($new_number, 4, '0', STR_PAD_LEFT);
        } else {
            $regno = 'TAPA0001';
        }

        // Prepare SQL statement
        $sql = "INSERT INTO member (regno, email, phone, birthdate, country, physical_address, member_type_id, registration_fee_paid, firstname, middlename, lastname,education) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssssssissss", $regno, $email, $phone, $birthdate, $country, $physical_address, $member_type_id, $registration_fee_paid, $firstname, $middlename, $lastname,$education);
            if ($stmt->execute()) {
                $status = 'success';
                $message = 'Member added successfully with Registration Number: ' . $regno;
                header('Location:member.php');
            } else {
                $status = 'error';
                $message = 'Error adding member: ' . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        } else {
            $status = 'error';
            $message = 'Error preparing statement: ' . htmlspecialchars($conn->error);
        }
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
            <h4 class="card-title">Member Registration</h4>
        </div>
        <div class="card-body">
            <form action="" method="POST" class="row g-3">
                <!-- Form Fields -->
                <div class="col-md-6">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                </div>
                <div class="col-md-6">
                    <label for="middlename" class="form-label">Middle Name</label>
                    <input type="text" class="form-control" id="middlename" name="middlename">
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="col-md-6">
                    <label for="birthdate" class="form-label">Birthdate</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                </div>
                <div class="col-md-6">
                    <label for="education" class="form-label">Education</label>
                    <input type="text" class="form-control" id="education" name="education" required>
                </div>
                <div class="col-md-6">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" id="country" name="country" required>
                </div>
                <div class="col-md-6">
                    <label for="physical_address" class="form-label">Physical Address</label>
                    <input type="text" class="form-control" id="physical_address" name="physical_address" required>
                </div>
                <div class="col-md-6">
                    <label for="member_type_id" class="form-label">Member Type</label>
                    <select class="form-control" id="member_type_id" name="member_type_id" required>
                        <option value="">Select Member Type</option>
                        <?php foreach ($member_types as $type): ?>
                        <option value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="registration_fee_paid">
                        <input type="checkbox" id="registration_fee_paid" name="registration_fee_paid">
                        Registration Fee Paid
                    </label>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Feedback -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel">Form Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo $message; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Trigger Modal -->
<?php if (!empty($message)): ?>
<script>
var feedbackModal = new bootstrap.Modal(document.getElementById('feedbackModal'));
feedbackModal.show();
</script>
<?php endif; ?>
<?php include 'footer.php' ?>