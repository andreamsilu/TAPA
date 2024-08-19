<?php
session_start(); // Uncommented session_start()

// Database connection
include "../../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}

// Handle AJAX request for DataTables
if (isset($_GET['action']) && $_GET['action'] == 'fetchData') {
    $sql = "SELECT u.id, u.fullname, u.phone, 
      CASE 
          WHEN p.status IS NULL THEN 'unpaid' 
          ELSE p.status 
      END AS status, 
      p.amount, p.payment_date
    FROM users u
    LEFT JOIN payments p ON u.id = p.user_id";

    $result = $conn->query($sql);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $paymentDate = $row['status'] == 'paid' && !empty($row['payment_date']) ? date('Y-m-d', strtotime($row['payment_date'])) : 'N/A';
        $data[] = [
            'id' => $row['id'],
            'fullname' => $row['fullname'],
            'phone' => $row['phone'],
            'payment_date' => $paymentDate,
            'status' => $row['status'],
            'amount' => $row['amount'],
            'actions' => "<a href='view_member.php?id=" . $row['id'] . "' class='btn btn-secondary'><i class='bi bi-eye bi-fw'></i> View</a> " .
                         ($row['status'] == 'unpaid' ? "<button class='btn btn-primary add-payment' data-user-id='" . $row['id'] . "'><i class='bi bi-plus bi-fw'></i> Add</button>" : "") .
                         ($row['status'] == 'pending' ? "<a href='edit_payment.php?id=" . $row['id'] . "&status=" . $row['status'] . "&amount=" . $row['amount'] . "' class='btn btn-info bg-warning'><i class='bi bi-pencil bi-fw'></i> Edit</a>" : "") .
                         ($row['status'] == 'paid' ? "<button class='btn btn-info bg-success' disabled><i class='bi bi-check bi-fw'></i> Done</button> <a href='edit_payment.php?id=" . $row['id'] . "&status=" . $row['status'] . "&amount=" . $row['amount'] . "' class='btn btn-info bg-warning mx-1'><i class='bi bi-pencil bi-fw'></i> Edit</a>" : "")
        ];
    }

    // Output data as JSON
    echo json_encode(['data' => $data]);

    // Close database connection
    $conn->close();
    exit();
}
?>

<?php include 'navigation.php' ?>
<!-- <body> -->
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
            url: 'member_list.php?action=fetchData',
            type: 'GET'
        },
        dom: 'Bfrtip',
        buttons: [{
                extend: 'excelHtml5',
                text: 'Export Excel',
                className: 'btn btn-success'
            },
            {
                extend: 'pdfHtml5',
                text: 'Export PDF',
                className: 'btn btn-danger'
            }
        ]
    });
});
</script>
</body>

</html>