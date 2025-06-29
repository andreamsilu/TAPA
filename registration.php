<?php
/**
 * TAPA Simplified Registration Form
 * Only requires: full name, email, phone, member type
 * Includes OTP verification and SMS functionality
 */

// Enable error display for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Start session first
session_start();

// Include required files
include('titleIcon.php');
include('header.php');
include('forms/connection.php');
include('includes/sms_helper.php');

// CSRF Protection
class CSRFProtection {
    public static function generateToken() {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    public static function validateToken($token) {
        if (!isset($_SESSION['csrf_token'])) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }
    
    public static function getTokenField() {
        $token = self::generateToken();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
    }
}

// Generate Member ID
function generateMemberID($membership_type) {
    $prefix = '';
    switch($membership_type) {
        case 'full_member': $prefix = 'FM'; break;
        case 'associate_one': $prefix = 'AM1'; break;
        case 'associate_two': $prefix = 'AM2'; break;
        case 'student': $prefix = 'SM'; break;
        case 'local_affiliate': $prefix = 'LA'; break;
        case 'foreign_affiliate': $prefix = 'FA'; break;
        default: $prefix = 'MB'; break;
    }
    
    $year = date('Y');
    $random = strtoupper(substr(md5(uniqid()), 0, 6));
    return $prefix . $year . $random;
}

// Generate OTP
function generateOTP() {
    return str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'register':
            if (!CSRFProtection::validateToken($_POST['csrf_token'] ?? '')) {
                $_SESSION['error'] = 'Invalid CSRF token';
                header("Location: registration.php");
                exit();
            }
            
            // Validate and sanitize input
            $fullname = trim(htmlspecialchars($_POST['fullname'] ?? '', ENT_QUOTES, 'UTF-8'));
            $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
            $phone = trim(htmlspecialchars($_POST['phone'] ?? '', ENT_QUOTES, 'UTF-8'));
            $membership_type = trim(htmlspecialchars($_POST['membership_type'] ?? '', ENT_QUOTES, 'UTF-8'));
            
            // Validation
            $errors = [];
            if (empty($fullname)) $errors[] = "Full name is required";
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required";
            if (empty($phone)) $errors[] = "Phone number is required";
            if (empty($membership_type)) $errors[] = "Membership type is required";
            
            // Check if email exists
            if ($conn) {
                $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->rowCount() > 0) {
                    $errors[] = "Email already registered";
                }
                
                // Check if phone exists
                $stmt = $conn->prepare("SELECT id FROM users WHERE phone = ?");
                $stmt->execute([$phone]);
                if ($stmt->rowCount() > 0) {
                    $errors[] = "Phone number already registered";
                }
            } else {
                $errors[] = "Database connection failed";
            }
            
            if (empty($errors)) {
                // Generate OTP using SMS helper
                $otp = generateOTP();
                $member_id = generateMemberID($membership_type);
                $password = strtolower($member_id); // Password same as member ID
                
                // Store registration data in session for OTP verification
                $_SESSION['registration_data'] = [
                    'fullname' => $fullname,
                    'email' => $email,
                    'phone' => $phone,
                    'membership_type' => $membership_type,
                    'member_id' => $member_id,
                    'password' => $password,
                    'otp' => $otp,
                    'otp_expires' => time() + 300 // 5 minutes expiry
                ];
                
                // Send OTP via SMS using NEXTSMS
                $otpMessage = "Your TAPA registration OTP is: $otp. Valid for 5 minutes.";
                if (function_exists('sendSMS') && sendSMS($phone, $otpMessage)) {
                    $_SESSION['success'] = "OTP sent to your phone number. Please verify to complete registration.";
                    header("Location: verify_otp.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Failed to send OTP. Please check your phone number and try again.";
                }
            } else {
                $_SESSION['error'] = implode("<br>", $errors);
            }
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAPA Membership Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .registration-form {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .form-section {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid #0F718A;
        }
        .form-section h4 {
            color: #0F718A;
            margin-bottom: 1rem;
        }
        .required {
            color: #dc3545;
        }
        .membership-info {
            background: #e3f2fd;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
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
        .step.active .step-number {
            background: #28a745;
        }
        .sms-provider-info {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            padding: 0.75rem;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="registration-form">
                        <div class="text-center mb-4">
                            <h2 class="text-primary">TAPA Membership Registration</h2>
                            <p class="text-muted">Join the Tanzanian Psychological Association</p>
                        </div>

                        <!-- SMS Provider Info -->
                        <div class="sms-provider-info">
                            <i class="bi bi-phone"></i>
                            <strong>SMS Powered by NEXTSMS:</strong> Your OTP and login credentials will be sent via SMS to your phone number.
                        </div>

                        <!-- Step Indicator -->
                        <div class="step-indicator">
                            <div class="step active">
                                <div class="step-number">1</div>
                                <span>Registration</span>
                            </div>
                            <div class="step">
                                <div class="step-number">2</div>
                                <span>Phone Verification</span>
                            </div>
                            <div class="step">
                                <div class="step-number">3</div>
                                <span>Complete</span>
                            </div>
                        </div>

                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger">
                                <?php 
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php endif; ?>

                        <form action="registration.php" method="post" id="registrationForm">
                            <input type="hidden" name="action" value="register">
                            <?php echo CSRFProtection::getTokenField(); ?>

                            <!-- Personal Information -->
                            <div class="form-section">
                                <h4><i class="bi bi-person"></i> Personal Information</h4>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="fullname" class="form-label">Full Name <span class="required">*</span></label>
                                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Address <span class="required">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone Number <span class="required">*</span></label>
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+255XXXXXXXXX" required>
                                        <small class="text-muted">Enter phone number with country code (e.g., +255)</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Membership Information -->
                            <div class="form-section">
                                <h4><i class="bi bi-award"></i> Membership Information</h4>
                                <div class="membership-info">
                                    <h6>Membership Categories & Fees:</h6>
                                    <ul class="mb-0">
                                        <li><strong>Full Member:</strong> 50,000 TSH (Bachelor's degree or above)</li>
                                        <li><strong>Associate Member I:</strong> 20,000 TSH (Diploma in psychology)</li>
                                        <li><strong>Associate Member II:</strong> 20,000 TSH (Certificate in psychology)</li>
                                        <li><strong>Student Member:</strong> 10,000 TSH (Registered psychology students)</li>
                                        <li><strong>Local Affiliate:</strong> 30,000 TSH (Local organizations)</li>
                                        <li><strong>Foreign Affiliate:</strong> 50,000 TSH (International organizations)</li>
                                    </ul>
                                </div>
                                <div class="mb-3">
                                    <label for="membership_type" class="form-label">Select Membership Category <span class="required">*</span></label>
                                    <select class="form-control" id="membership_type" name="membership_type" required>
                                        <option value="">Choose membership type...</option>
                                        <option value="full_member">Full Member - 50,000 TSH</option>
                                        <option value="associate_one">Associate Member I - 20,000 TSH</option>
                                        <option value="associate_two">Associate Member II - 20,000 TSH</option>
                                        <option value="student">Student Member - 10,000 TSH</option>
                                        <option value="local_affiliate">Local Affiliate - 30,000 TSH</option>
                                        <option value="foreign_affiliate">Foreign Affiliate - 50,000 TSH</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="bi bi-phone"></i> Send OTP & Continue
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <p>Already have an account? <a href="login.php">Sign in here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
