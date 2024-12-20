<?php include "navigation.php" ?>
  <div class="container mt-5">
    <h1 class="text-center mb-4">Tapa Organization Annual Membership Fees</h1>
    <div class="row">
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
            <h3 class="card-title">Basic Membership</h3>
            <p class="card-text">Annual Fee: $50</p>
            <p class="card-text">Benefits:</p>
            <ul class="card-text">
              <li>Access to Tapa community events</li>
              <li>Monthly newsletters with organization updates</li>
              <li>Volunteer opportunities</li>
            </ul>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicMembershipModal">Join Basic Membership</button>

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
            <h3 class="card-title">Premium Membership</h3>
            <p class="card-text">Annual Fee: $100</p>
            <p class="card-text">Benefits:</p>
            <ul class="card-text">
              <li>All Basic Membership benefits</li>
              <li>Exclusive workshops and seminars</li>
              <li>Early access to event tickets</li>
            </ul>
            <!-- <a href="#" class="btn btn-primary">Join Premium Membership</a> -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicMembershipModal">Join Premium  Membership</button>

          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="card-body">
            <h3 class="card-title">Lifetime Membership</h3>
            <p class="card-text">One-time Fee: $500</p>
            <p class="card-text">Benefits:</p>
            <ul class="card-text">
              <li>All Premium Membership benefits</li>
              <li>Lifetime access to Tapa's exclusive network</li>
              <li>Special recognition in our annual report</li>
            </ul>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicMembershipModal">Join Lifetime  Membership</button>

            <!-- <a href="#" class="btn btn-primary">Join Lifetime Membership</a> -->
          </div>
        </div>
      </div>
    </div>
    <p class="text-muted text-center">For inquiries or assistance, contact us at [contact information].</p>
  </div>

  <!-- ... (Previous HTML code remains the same) ... -->

<!-- Payment Modal -->
<div class="modal fade" id="basicMembershipModal" tabindex="-1" role="dialog" aria-labelledby="basicMembershipModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="basicMembershipModalLabel">Basic Membership Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" class="form-control" id="fullName" placeholder="Enter your full name" required>
          </div>
          <div class="form-group">
            <label for="cardNumber">Card Number</label>
            <input type="text" class="form-control" id="cardNumber" placeholder="Enter your card number" required>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="expiryDate">Expiry Date</label>
              <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY" required>
            </div>
            <div class="form-group col-md-6">
              <label for="cvv">CVV</label>
              <input type="text" class="form-control" id="cvv" placeholder="CVV" required>
            </div>
          </div>
          <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" class="form-control" id="amount" placeholder="Enter the payment amount" required>
          </div>
          <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ... (Remaining HTML and scripts remain the same) ... -->


 <?php include "footer.php" ?>
