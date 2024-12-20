<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require 'db.php';

// Get the current date
$currentDate = date('Y-m-d');

// Determine the current membership year
$currentYearQuery = "SELECT id, year FROM membership_year 
                     WHERE '$currentDate' >= DATE_FORMAT(CONCAT(year, '-07-01'), '%Y-%m-%d') 
                     AND '$currentDate' < DATE_FORMAT(CONCAT(year + 1, '-07-01'), '%Y-%m-%d')";

$currentYearResult = $conn->query($currentYearQuery);
$currentYear = $currentYearResult->fetch_assoc();

// Fetch membership years for the dropdown
$yearsResult = $conn->query("SELECT id, year FROM membership_year");

// Initialize the query for fetching fees
$query = "SELECT f.id, m.firstname AS member_name, y.year AS membership_year, t.fee_amount AS fee_type, f.status, f.created_at 
          FROM fees f
          JOIN member m ON f.member_id = m.id
          JOIN membership_year y ON f.year_id = y.id
          JOIN fee_per_type t ON f.fee_type_id = t.id
          WHERE f.status = 1"; // Only fetch paid fees

// Check if a specific year is selected; if not, use the current year
if (isset($_POST['year_id']) && !empty($_POST['year_id'])) {
    $year_id = intval($_POST['year_id']);
    $query .= " AND f.year_id = $year_id"; // Filter by selected year
} else {
    if ($currentYear) {
        $query .= " AND f.year_id = " . $currentYear['id']; // Use current membership year
    }
}

$query .= " ORDER BY f.created_at DESC"; // Order results by date

// Fetch all fees based on the query
$result = $conn->query($query);

// Fetch the count of all entries for pagination
$totalEntries = $result->num_rows;
?>

<?php include 'header.php' ?>
<div class="container mt-5">
    <h2>ACTIVE MEMBERS FOR SELECTED MEMBERSHIP YEAR</h2>
    <a href="create_fee.php" class="btn btn-primary mb-4">Add Fee</a>

    <!-- Form to filter by Membership Year -->
    <form method="POST" class="mb-4">
        <div class="form-group">
            <label for="year_id">Select Membership Year:</label>
            <select name="year_id" class="form-control" required>
                <option value="">Select Year</option>
                <?php while ($rowYear = $yearsResult->fetch_assoc()) { ?>
                <option value="<?php echo $rowYear['id']; ?>"
                    <?php echo (isset($year_id) && $year_id == $rowYear['id']) ? 'selected' : ''; ?>>
                    <?php echo $rowYear['year']; ?>
                </option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- Dropdown to select quantity of entries per page -->
    <div class="form-group mb-4">
        <label for="quantity">Show:</label>
        <select id="quantity" class="form-control">
            <option value="10">10</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="300">300</option>
            <option value="500">500</option>
            <option value="1000">1000</option>
        </select>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="feesTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>S/N</th> <!-- Serial Number Column -->
                        <th>ID</th>
                        <th>Member</th>
                        <th>Membership Year</th>
                        <th>Fee Type</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $serialNumber = 1; // Initialize serial number
                    while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $serialNumber++; ?></td> <!-- Display Serial Number -->
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['member_name']; ?></td>
                        <td><?php echo $row['membership_year']; ?></td>
                        <td><?php echo $row['fee_type']; ?></td>
                        <td><?php echo $row['status'] ? 'Paid' : 'Unpaid'; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <a href="edit_fee.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-danger btn-sm delete-btn"
                                data-id="<?php echo $row['id']; ?>">Delete</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#feesTable').DataTable({
        dom: 'Bfrtip', // Define the position of the buttons
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print' // Export buttons
        ]
    });

    // Change number of entries shown based on dropdown selection
    $('#quantity').on('change', function() {
        var quantity = $(this).val();
        table.page.len(quantity).draw(); // Change page length and redraw table
    });

    // Delete Fee
    $('.delete-btn').on('click', function() {
        const feeId = $(this).data('id');
        if (confirm('Are you sure you want to delete this fee?')) {
            $.ajax({
                type: 'POST',
                url: 'delete_fee.php',
                data: {
                    id: feeId
                },
                success: function(response) {
                    alert('Fee deleted successfully!');
                    location.reload();
                }
            });
        }
    });
});
</script>

<style>
/* Custom styles for DataTable */
#feesTable {
    border-collapse: collapse;
    width: 100%;
}

#feesTable th,
#feesTable td {
    text-align: left;
    padding: 8px;
}

#feesTable tr:nth-child(even) {
    background-color: #f2f2f2;
    /* Light grey background for even rows */
}

#feesTable th {
    background-color: #007bff;
    /* Bootstrap primary color */
    color: white;
    /* White text for header */
}

.card-body {
    padding: 1.5rem;
    /* Increased padding for card body */
}
</style>

<?php include 'footer.php' ?>