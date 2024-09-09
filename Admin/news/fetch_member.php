<?php
session_start();

// Database connection
include "../../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}

// Handle AJAX request for DataTables
if (isset($_GET['action']) && $_GET['action'] == 'fetchData') {
    // Total number of records without filtering
    $totalRecordsQuery = "SELECT COUNT(*) AS total FROM users";
    $totalRecordsResult = $conn->query($totalRecordsQuery);
    $totalRecords = $totalRecordsResult->fetch_assoc()['total'];

    // Get limit, start, and search values from DataTables request
    $limit = $_GET['length'];
    $start = $_GET['start'];
    $search = $_GET['search']['value'];

    // SQL Query with search functionality
    $sql = "SELECT u.id, u.fullname, u.phone, 
      CASE 
          WHEN p.status IS NULL THEN 'unpaid' 
          ELSE p.status 
      END AS status, 
      p.amount, p.payment_date
    FROM users u
    LEFT JOIN payments p ON u.id = p.user_id
    WHERE u.fullname LIKE '%$search%' OR u.phone LIKE '%$search%'
    LIMIT $start, $limit";

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
            'actions' => "<a href='view_member.php?id=" . $row['id'] . "' class='btn btn-sm btn-secondary'><i class='bi bi-eye'></i> View</a> " .
                         ($row['status'] == 'unpaid' ? "<button class='btn btn-sm btn-primary add-payment' data-user-id='" . $row['id'] . "'><i class='bi bi-plus'></i> Add</button>" : "") .
                         ($row['status'] == 'pending' ? "<a href='edit_payment.php?id=" . $row['id'] . "&status=" . $row['status'] . "&amount=" . $row['amount'] . "' class='btn btn-sm btn-warning'><i class='bi bi-pencil'></i> Edit</a>" : "") .
                         ($row['status'] == 'paid' ? "<button class='btn btn-sm btn-success' disabled><i class='bi bi-check'></i> Done</button> <a href='edit_payment.php?id=" . $row['id'] . "&status=" . $row['status'] . "&amount=" . $row['amount'] . "' class='btn btn-sm btn-warning mx-1'><i class='bi bi-pencil'></i> Edit</a>" : "")
        ];
    }

    // Total number of records after filtering (search)
    $filteredRecordsQuery = "SELECT COUNT(*) AS total FROM users u LEFT JOIN payments p ON u.id = p.user_id WHERE u.fullname LIKE '%$search%' OR u.phone LIKE '%$search%'";
    $filteredRecordsResult = $conn->query($filteredRecordsQuery);
    $filteredRecords = $filteredRecordsResult->fetch_assoc()['total'];

    // Output data as JSON
    echo json_encode([
        "draw" => intval($_GET['draw']),
        "recordsTotal" => $totalRecords,
        "recordsFiltered" => $filteredRecords,
        "data" => $data
    ]);

    // Close database connection
    $conn->close();
    exit();
}
?>