<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}
?>

<?php include 'navigation.php'; ?>

<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<!-- DataTables Buttons CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

<div class="container mt-4">
    <h2>User Information</h2>
    <table id="userTable" class="display nowrap" style="width:100%">
        <!-- Thead will be generated dynamically by DataTables -->
    </table>
</div>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Include DataTables JS and Buttons extension -->
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
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
            url: 'fetch_member.php?action=fetchData', // AJAX URL to fetch data
            type: 'GET'
        },
        columns: [{
                title: 'ID',
                data: 'id'
            },
            {
                title: 'Fullname',
                data: 'fullname'
            },
            {
                title: 'Phone',
                data: 'phone'
            },
            {
                title: 'Payment Date',
                data: 'payment_date'
            },
            {
                title: 'Payment Status',
                data: 'status'
            },
            {
                title: 'Amount',
                data: 'amount'
            },
            {
                title: 'Actions',
                data: 'actions',
                orderable: false,
                searchable: false
            }
        ],
        pageLength: 10, // Pagination size
        lengthMenu: [10, 25, 50, 75, 100], // Pagination options
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: 'Export Excel',
                className: 'btn btn-sm btn-success'
            },
            {
                extend: 'pdfHtml5',
                text: 'Export PDF',
                className: 'btn btn-sm btn-danger'
            }
        ]
    });
});
</script>