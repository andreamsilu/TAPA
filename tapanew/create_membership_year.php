<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require 'db.php';

$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the year input from the form
    $year = $_POST['year'];

    // Validate the input matches the format YYYY-YYYY
    if (preg_match('/^\d{4}-\d{4}$/', $year)) {
        // Extract the first and second years for validation
        list($startYear, $endYear) = explode('-', $year);

        // Ensure the second year is exactly 1 greater than the first year
        if ((int)$endYear === (int)$startYear + 1) {
            // Insert the new membership year into the database
            $stmt = $conn->prepare("INSERT INTO membership_year (year) VALUES (?)");
            $stmt->bind_param("s", $year);
            if ($stmt->execute()) {
                header("Location: list_membership_years.php"); // Redirect to list page
                exit();
            } else {
                $errorMessage = "Database Error: " . $conn->error;
            }
        } else {
            $errorMessage = "The second year must be exactly one year after the first.";
        }
    } else {
        $errorMessage = "Please enter a valid year format (e.g., 2023-2024).";
    }
}
?>

<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2>Add Membership Year</h2>
    <form method="POST" action="create_membership_year.php">
        <div class="form-group">
            <label for="year">Year:</label>
            <input type="text" name="year" class="form-control" placeholder="2023-2024" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Year</button>
        <a href="list_membership_years.php" class="btn btn-secondary">Back</a>
    </form>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php echo $errorMessage; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<!-- Bootstrap and JS dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Show the modal if there's an error
<?php if (!empty($errorMessage)) : ?>
var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
errorModal.show();
<?php endif; ?>
</script>