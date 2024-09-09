<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}
?>

<?php include 'navigation.php'; ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<!-- DataTables Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

<div class="container mt-4">
    <h2>User Information</h2>
    <table id="userTable" class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Fullname</th>
                <th>Phone</th>
                <th>Payment Date</th>
                <th>Payment Status</th>
                <th>Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
</div>

<!-- jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#userTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: 'fetch_member.php?action=fetchData',
            type: 'GET'
        },
        columns: [{
                data: 'id'
            },
            {
                data: 'fullname'
            },
            {
                data: 'phone'
            },
            {
                data: 'payment_date'
            },
            {
                data: 'status'
            },
            {
                data: 'amount'
            },
            {
                data: 'actions',
                orderable: false,
                searchable: false
            }
        ],
        dom: 'Bfrtip',
        pageLength: 10, // Default number of entries
        lengthMenu: [
            [10, 25, 50, 75, 100, -1],
            [10, 25, 50, 75, 100, "All"]
        ], // Pagination options
        buttons: [{
                extend: 'excelHtml5',
                text: 'Export Excel',
                className: 'btn btn-xs btn-success' // Small button
            },
            {
                extend: 'pdfHtml5',
                text: 'Export PDF',
                className: 'btn btn-xs btn-danger' // Small button
            }
        ]
    });
});
</script>