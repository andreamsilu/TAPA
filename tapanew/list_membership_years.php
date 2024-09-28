<?php
require 'db.php';

// Fetch all membership years
$result = $conn->query("SELECT * FROM membership_year ORDER BY year DESC");
?>
<?php include 'header.php' ?>

<div class="container mt-5">
    <h2>Membership Years</h2>
    <a href="create_membership_year.php" class="btn btn-primary mb-4">Add Membership Year</a>

    <div class="card">
        <div class="card-body">
            <table id="membershipTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th> <!-- Serial Number Column -->
                        <th>Year</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $serialNumber = 1; // Initialize serial number
                    while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $serialNumber++; ?></td> <!-- Serial number increment -->
                        <td><?php echo $row['year']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td><?php echo $row['updated_at']; ?></td>
                        <td>
                            <a href="edit_membership_year.php?id=<?php echo $row['id']; ?>"
                                class="btn btn-warning btn-sm">Edit</a>
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

<script>
$(document).ready(function() {
    $('#membershipTable').DataTable();

    // Delete Membership Year
    $('.delete-btn').on('click', function() {
        const membershipId = $(this).data('id');
        if (confirm('Are you sure you want to delete this membership year?')) {
            $.ajax({
                type: 'POST',
                url: 'delete_membership_year.php',
                data: {
                    id: membershipId
                },
                success: function(response) {
                    alert('Membership year deleted successfully!');
                    location.reload();
                }
            });
        }
    });
});
</script>
<?php include 'footer.php' ?>