

<!-- Settings Form -->
<div class="container mt-0 p-3">
  <!-- Tab Structure -->
  <ul class="nav nav-tabs" id="feeTabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="fee-tab" data-toggle="tab" href="#fee" role="tab" aria-controls="fee" aria-selected="true">Membership Fee</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Payment Status</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="add-payment-tab" data-toggle="tab" href="#add-payment" role="tab" aria-controls="add-payment" aria-selected="false">Add Payment</a>
    </li>
  </ul>
  <div class="tab-content" id="feeTabsContent">
    <!-- Membership Fee Tab Pane -->
    <div class="tab-pane fade show active" id="fee" role="tabpanel" aria-labelledby="fee-tab">
      <div class="container">
        <h4 class="mt-1 pt-2">Membership Fee</h4>
        <hr>
        <h5>Membership Fee Details</h5>
        <p>Membership Type: Premium</p>
        <p>Fee Amount: $100 per year</p>
        <p>Payment Due Date: January 15th</p>
        <!-- Add more membership fee details here -->
      </div>
    </div>
    <!-- Payment Status Tab Pane -->
    <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
      <div class="container">
        <h3 class="mt-4">Payment Status</h3>
        <hr>
        <p>Payment Status: Paid</p>
        <p>Payment Date: <?php echo date("hr") ?> </p>
        <!-- Add more payment status details here -->
      </div>
    </div>
    <!-- Add Payment Tab Pane -->
    <div class="tab-pane fade" id="add-payment" role="tabpanel" aria-labelledby="add-payment-tab">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Make a Payment</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" action="forms/fee-payment.php">
                            <div class="form-group">
                                <label for="paymentAmount">Payment Amount</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" step="0.01" class="form-control"name="paymentAmount"  id="paymentAmount" placeholder="Enter payment amount" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="paymentDate">Payment Date</label>
                                <input type="date" class="form-control" name="paymentDate" id="paymentDate" required>
                            </div>
                            <div class="form-group">
                                <label for="dueDate">Due Date</label>
                                <input type="date" class="form-control" name="dueDate" id="dueDate" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="paymentMethod">Select Payment Method</label>
                                <select class="form-control" id="paymentMethod"  name="paymentMethod"required>
                                    <option value="" disabled selected>Select payment method</option>
                                    <option value="mpesa">M-Pesa</option>
                                    <option value="tigopesa">Tigo Pesa</option>
                                    <option value="airtelmoney">Airtel Money</option>
                                    <option value="halopesa">Halo Pesa</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="tel" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="Enter your phone number" required>
                            </div>
                            <div class="form-group">
                                <label for="membership_type">Select Membership category</label>
                                <select class="form-control" id="membership_type"  name="membership_type"required>
                                    <option value="" disabled selected>Select membership category</option>
                                    <option value="student">Student Member</option>
                                    <option value="assiciate">Associate Mamber</option>
                                    <option value="affiliate">Affiliate Member</option>
                                    <option value="foreignAffiliate">Foreign Affiliate Member</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Submit Payment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
  </div>
  <!-- End of Tab Structure -->
</div>
<!-- End settings Form -->