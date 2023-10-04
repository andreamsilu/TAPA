<!-- Settings Form -->
<div class="container mt-5">
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
                          <h2 class="mt-4">Membership Fee Page</h2>
                          <hr>
                          <h3>Membership Fee Details</h3>
                          <p>Membership Type: Premium</p>
                          <p>Fee Amount: $100 per year</p>
                          <p>Payment Due Date: January 15th</p>
                          <!-- Add more membership fee details here -->
                        </div>
                      </div>
                      <!-- Payment Status Tab Pane -->
                      <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
                        <div class="container">
                          <h2 class="mt-4">Payment Status</h2>
                          <hr>
                          <p>Payment Status: Paid</p>
                          <p>Payment Date: January 10th</p>
                          <!-- Add more payment status details here -->
                        </div>
                      </div>
                      <!-- Add Payment Tab Pane -->
                      <div class="tab-pane fade" id="add-payment" role="tabpanel" aria-labelledby="add-payment-tab">
                        <div class="container">
                          <h2 class="mt-4">Add Payment</h2>
                          <hr>
                          <!-- Payment form goes here -->
                          <form>
                            <div class="form-group">
                              <label for="paymentAmount">Payment Amount</label>
                              <input type="text" class="form-control" id="paymentAmount" placeholder="Enter payment amount">
                            </div>
                            <div class="form-group">
                              <label for="paymentDate">Payment Date</label>
                              <input type="date" class="form-control" id="paymentDate">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Payment</button>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- End of Tab Structure -->
                  </div>
                  <!-- End settings Form -->