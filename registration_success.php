<?php
include('titleIcon.php');
include('header.php');
session_start();

// Redirect if no success data
if (!isset($_SESSION['registration_success'])) {
    header("Location: registration.php");
    exit();
}

$success_data = $_SESSION['registration_success'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful - TAPA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .success-container {
            background: #f8f9fa;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0,0,0,0.1);
            text-align: center;
        }
        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1rem;
        }
        .credentials-box {
            background: #e8f5e8;
            border: 2px solid #28a745;
            border-radius: 10px;
            padding: 2rem;
            margin: 2rem 0;
            text-align: left;
        }
        .credential-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid #dee2e6;
        }
        .credential-item:last-child {
            border-bottom: none;
        }
        .credential-label {
            font-weight: bold;
            color: #495057;
        }
        .credential-value {
            font-family: 'Courier New', monospace;
            background: #fff;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            border: 1px solid #ced4da;
        }
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }
        .step {
            display: flex;
            align-items: center;
            margin: 0 1rem;
        }
        .step-number {
            background: #0F718A;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 0.5rem;
        }
        .step.completed .step-number {
            background: #28a745;
        }
        .payment-info {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 1.5rem;
            margin: 2rem 0;
        }
    </style>
</head>
<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="success-container">
                        <!-- Step Indicator -->
                        <div class="step-indicator">
                            <div class="step completed">
                                <div class="step-number">1</div>
                                <span>Registration</span>
                            </div>
                            <div class="step completed">
                                <div class="step-number">2</div>
                                <span>Phone Verification</span>
                            </div>
                            <div class="step completed">
                                <div class="step-number">3</div>
                                <span>Complete</span>
                            </div>
                        </div>

                        <div class="success-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        
                        <h2 class="text-success mb-3">Registration Successful!</h2>
                        <p class="lead mb-4">Welcome to TAPA, <?php echo htmlspecialchars($success_data['fullname']); ?>!</p>
                        
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <strong>Login credentials have been sent to your phone via SMS.</strong>
                        </div>

                        <!-- Login Credentials -->
                        <div class="credentials-box">
                            <h4 class="text-center mb-3">
                                <i class="bi bi-person-badge"></i> Your Login Credentials
                            </h4>
                            <div class="credential-item">
                                <span class="credential-label">Member ID:</span>
                                <span class="credential-value"><?php echo htmlspecialchars($success_data['member_id']); ?></span>
                            </div>
                            <div class="credential-item">
                                <span class="credential-label">Password:</span>
                                <span class="credential-value"><?php echo htmlspecialchars($success_data['member_id']); ?></span>
                            </div>
                            <div class="credential-item">
                                <span class="credential-label">Membership Type:</span>
                                <span class="credential-value"><?php echo ucwords(str_replace('_', ' ', $success_data['membership_type'])); ?></span>
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="payment-info">
                            <h5><i class="bi bi-credit-card"></i> Complete Your Registration</h5>
                            <p class="mb-3">To activate your membership, please complete the payment process:</p>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>Bank Details:</h6>
                                    <ul class="list-unstyled">
                                        <li><strong>Bank:</strong> NMB Bank</li>
                                        <li><strong>Account No:</strong> 20810008255</li>
                                        <li><strong>Account Name:</strong> Tanzanian Psychological Association</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>Membership Fees:</h6>
                                    <ul class="list-unstyled">
                                        <li><strong>Registration Fee:</strong> 10,000 TSH</li>
                                        <li><strong>Annual Fee:</strong> 
                                            <?php
                                            $fees = [
                                                'full_member' => '50,000 TSH',
                                                'associate_one' => '20,000 TSH',
                                                'associate_two' => '20,000 TSH',
                                                'student' => '10,000 TSH',
                                                'local_affiliate' => '30,000 TSH',
                                                'foreign_affiliate' => '50,000 TSH'
                                            ];
                                            echo $fees[$success_data['membership_type']] ?? 'Contact Admin';
                                            ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="text-center mt-3">
                                <a href="pay_annual_fees.php" class="btn btn-warning">
                                    <i class="bi bi-upload"></i> Upload Payment Receipt
                                </a>
                            </div>
                        </div>

                        <!-- Next Steps -->
                        <div class="mt-4">
                            <h5>What's Next?</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <i class="bi bi-credit-card text-primary" style="font-size: 2rem;"></i>
                                        <p class="mt-2">1. Complete Payment</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <i class="bi bi-upload text-success" style="font-size: 2rem;"></i>
                                        <p class="mt-2">2. Upload Receipt</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="text-center">
                                        <i class="bi bi-person-check text-info" style="font-size: 2rem;"></i>
                                        <p class="mt-2">3. Account Activation</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-4">
                            <a href="login.php" class="btn btn-primary btn-lg me-3">
                                <i class="bi bi-box-arrow-in-right"></i> Login Now
                            </a>
                            <a href="index.php" class="btn btn-outline-secondary btn-lg">
                                <i class="bi bi-house"></i> Go to Homepage
                            </a>
                        </div>

                        <div class="mt-4">
                            <small class="text-muted">
                                <i class="bi bi-shield-check"></i> 
                                Your account is secure and your information is protected.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
// Clear success data after displaying
unset($_SESSION['registration_success']);
?>
