<?php
session_start(); // Uncommented session_start()

// Database connection
include "../../forms/connection.php";
include "navigation.php";
// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
  header("Location: ../../login.php");
  exit();
}
?>

<div class="container mt-4">
  <h2>User Information</h2>
  <?php
  // Fetch user information along with payment status
  $sql = "SELECT u.id, u.fullname, u.phone, 
  CASE 
      WHEN p.status IS NULL THEN 'unpaid' 
      ELSE p.status 
  END AS status, 
  p.amount, p.payment_date
FROM users u
LEFT JOIN payments p ON u.id = p.user_id
";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Display user information and payment status in a striped table
    echo "<table class='table table-striped'>";
    echo "<thead class='thead-dark'><tr><th>ID</th><th>Fullname</th><th>Time</th><th>Phone</th><th>Payment Status</th><th>Amount</th><th>Actions</th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {

      if ($row['status'] == 'paid' && !empty($row['payment_date'])) {
        $paymentDate = date('Y-m-d', strtotime($row['payment_date'])); // Format the date without hours, minutes, and seconds
      } else {
        $paymentDate = 'N/A';
      }
      echo "<tr>";
      echo "<td><a href='view_member.php?id=" . $row['id'] . "'>" . $row['id'] . " view</a></td>";
      echo "<td>" . $row['fullname'] . "</td>";
      echo "<td>" . $row['phone'] . "</td>";
      echo "<td>" . $paymentDate . "</td>";
      echo "<td>" . $row['status'] . "</td>";
      echo "<td>" . $row['amount'] . "</td>";
      echo "<td>";
      if ($row['status'] == 'unpaid') {
        echo "<button class='btn btn-primary add-payment' data-user-id='" . $row['id'] . "'><i class='bi bi-plus bi-fw'></i> Add</button>";
    }
    
    if ($row['status'] == 'pending') {
      echo "<a href='edit_payment.php?id=" . $row['id'] . "&status=" . $row['status'] . "&amount=" . $row['amount'] . "' class='btn btn-info bg-warning'><i class='bi bi-pencil bi-fw'></i> Edit</a>";
  }
  
  if ($row['status'] == 'paid') {
      echo "<button class='btn btn-info bg-success' disabled><i class='bi bi-check bi-fw'></i> Done</button>";
      echo "<a href='edit_payment.php?id=" . $row['id'] . "&status=" . $row['status'] . "&amount=" . $row['amount'] . "' class='btn btn-info bg-warning mx-1'><i class='bi bi-pencil bi-fw'></i> Edit</a>";
  }
    
    
      echo "</td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
  } else {
    echo "<p>No users found.</p>";
  }

  // Close database connection
  $conn->close();
  ?>
</div>

<!-- Payment Form Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel">Payment Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="paymentForm" action="add_payment.php" method="post">
          <input type="hidden" id="userId" name="userId">
          <div class="form-group">
            <label for="status">Payment Status:</label>
            <select class="form-control" id="status" name="status">
              <!-- Set the default value as "unpaid" -->
              <option value="unpaid" selected>Unpaid</option>
              <option value="paid">Paid</option>
              <option value="pending">Pending</option>
            </select>
          </div>
          <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="text" class="form-control" id="amount" name="amount">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Payment Form Modal -->
<div class="modal fade" id="editPaymentModal" tabindex="-1" role="dialog" aria-labelledby="editPaymentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPaymentModalLabel">Edit Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editPaymentForm" action="edit_payment.php" method="post">
          <input type="hidden" id="editUserId" name="userId">
          <div class="form-group">
            <label for="editStatus">Payment Status:</label>
            <select class="form-control" id="editStatus" name="status">
              <option value="paid">Paid</option>
              <option value="pending">Pending</option>
              <option value="unpaid">Unpaid</option>
            </select>
          </div>
          <div class="form-group">
            <label for="editAmount">Amount:</label>
            <input type="text" class="form-control" id="editAmount" name="amount">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php include "footer.php"; ?>

