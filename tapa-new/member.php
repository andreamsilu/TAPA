<?php include 'header.php'; ?>
<div class="container mt-5">
    <h2>Member Management</h2>

    <!-- Button to Open Add Member Modal -->
    <a href="create_member.php" class="btn btn-primary mb-4">Add Member</a>

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

    <!-- Table to Display Members -->
    <table id="membersTable" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>SN</th>
                <th>Reg No</th>
                <th>Fname</th>
                <!-- <th>Mname</th> -->
                <th>Lname</th>
                <th>Email</th>
                <th>Phone</th>
                <!-- <th>Birthdate</th> -->
                <th>Education</th>
                <th>Country</th>
                <!-- <th>Physical Address</th> -->
                <th>Memb Type</th>
                <th>Reg Fee</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            require 'db.php';
            // Fetching members
            $result = $conn->query("SELECT * FROM member");
            $serialNo = 1;

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . $serialNo++ . "</td>
                    <td>{$row['regno']}</td>
                    <td>{$row['firstname']}</td>
                    <td>{$row['lastname']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['education']}</td>
                    <td>{$row['country']}</td>
                    <td>{$row['member_type_id']}</td>
                    <td>" . ($row['registration_fee_paid'] ? 'Yes' : 'No') . "</td>
                    <td>
                        <a href='edit_member.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id']}'>Delete</button>
                    </td>
                </tr>";
            }

            $conn->close(); // Close connection
            ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#membersTable').DataTable({
        dom: 'Bfrtip', // Enables search, filter, pagination, and buttons
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "pageLength": 10, // Default number of rows to display
        "lengthMenu": [5, 10, 25, 50, 100], // Allows users to select how many rows to show
        "order": [
            [0, 'asc']
        ] // Ensure serial number is sorted correctly
    });

    // Change number of entries shown based on dropdown selection
    $('#quantity').on('change', function() {
        var quantity = $(this).val();
        table.page.len(quantity).draw(); // Change page length and redraw table
    });

    // Delete Member
    $('.delete-btn').on('click', function() {
        const memberId = $(this).data('id');
        if (confirm('Are you sure you want to delete this member?')) {
            $.ajax({
                type: 'POST',
                url: 'delete_member.php',
                data: {
                    id: memberId
                },
                success: function(response) {
                    alert('Member deleted successfully!');
                    location.reload();
                }
            });
        }
    });
});
</script>

<style>
/* Custom styles for DataTable */
#membersTable {
    border-collapse: collapse;
    width: 100%;
}

#membersTable th,
#membersTable td {
    text-align: left;
    padding: 8px;
}

#membersTable tr:nth-child(even) {
    background-color: #f2f2f2;
    /* Light grey background for even rows */
}

#membersTable th {
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