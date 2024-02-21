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
  $sql = "SELECT u.id, u.fullname, u.email, u.phone, p.status, p.amount
          FROM users u
          LEFT JOIN payments p ON u.id = p.user_id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // Display user information and payment status in a striped table
      echo "<table class='table table-striped'>";
      echo "<thead class='thead-dark'><tr><th>ID</th><th>Fullname</th><th>Email</th><th>Phone</th><th>Payment Status</th><th>Amount</th><th>Actions</th></tr></thead>";
      echo "<tbody>";
      while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td><a href='view_member.php?id=" . $row['id'] . "'>" . $row['id'] . " view</a></td>";
          echo "<td>" . $row['fullname'] . "</td>";
          echo "<td>" . $row['email'] . "</td>";
          echo "<td>" . $row['phone'] . "</td>";
          echo "<td>" . $row['status'] . "</td>";
          echo "<td>" . $row['amount'] . "</td>";
          echo "<td>";
          if ($row['status'] == 'unpaid') {
              echo "<button class='btn btn-primary add-payment' data-user-id='" . $row['id'] . "'>Add</button>";
          }
          if ($row['status'] == 'pending') {
              echo "<button class='btn btn-info edit-payment' data-user-id='" . $row['id'] . "' data-status='" . $row['status'] . "' data-amount='" . $row['amount'] . "'>Edit</button>";
          }

          if ($row['status'] == 'paid') {
            echo "<button class='btn btn-info edit-payment' data-user-id='" . $row['id'] . "' data-status='" . $row['status'] . "' data-amount='" . $row['amount'] . "'>approved</button>";
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

<script>
  // Handle Add Payment button click
  $(document).on('click', '.add-payment', function() {
    var userId = $(this).data('user-id');
    $('#userId').val(userId);
    $('#paymentModal').modal('show');
  });

  // Handle Edit Payment button click
  $(document).on('click', '.edit-payment', function() {
    var userId = $(this).data('user-id');
    var status = $(this).data('status');
    var amount = $(this).data('amount');
    $('#editUserId').val(userId);
    $('#editStatus').val(status);
    $('#editAmount').val(amount);
    $('#editPaymentModal').modal('show');
  });

</script>


