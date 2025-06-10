<?php
/**
 * TAPA OTP Verification Page
 * Verifies the OTP sent to user's phone and completes registration
 */

session_start();
include('titleIcon.php');
include('header.php');
include('forms/connection.php');
include('includes/sms_helper.php');

// Check if user has registration data
if (!isset($_SESSION['registration_data'])) {
    $_SESSION['error'] = 'No registration data found. Please start registration again.';
    header("Location: registration.php");
    exit();
}

$registration_data = $_SESSION['registration_data'];

// Check if OTP has expired
if (time() > $registration_data['otp_expires']) {
    unset($_SESSION['registration_data']);
    $_SESSION['error'] = 'OTP has expired. Please register again.';
    header("Location: registration.php");
    exit();
}

// Handle OTP verification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_otp = trim($_POST['otp'] ?? '');
    
    if (empty($entered_otp)) {
        $_SESSION['error'] = 'Please enter the OTP sent to your phone.';
    } elseif ($entered_otp === $registration_data['otp']) {
        // OTP is correct, create user account
        try {
            // Insert user into database
            $stmt = $conn->prepare("INSERT INTO users (fullname, email, phone, membership_type, member_id, password, is_active, membership_year, registration_date) VALUES (?, ?, ?, ?, ?, ?, 1, YEAR(CURDATE()), NOW())");
            
            $hashed_password = password_hash($registration_data['password'], PASSWORD_DEFAULT);
            
            $stmt->bind_param("ssssss", 
                $registration_data['fullname'],
                $registration_data['email'],
                $registration_data['phone'],
                $registration_data['membership_type'],
                $registration_data['member_id'],
                $hashed_password
            );
            
            if ($stmt->execute()) {
                $user_id = $conn->insert_id;
                
                // Send login credentials via SMS
                $credentials_message = "TAPA Registration Successful! Your Member ID: {$registration_data['member_id']}, Password: {$registration_data['password']}. Login at: " . $_SERVER['HTTP_HOST'] . "/login.php";
                
                if (sendSMS($registration_data['phone'], $credentials_message)) {
                    // Store success data for success page
                    $_SESSION['registration_success'] = [
                        'member_id' => $registration_data['member_id'],
                        'password' => $registration_data['password'],
                        'fullname' => $registration_data['fullname'],
                        'email' => $registration_data['email']
                    ];
                    
                    // Clear registration data
                    unset($_SESSION['registration_data']);
                    
                    header("Location: registration_success.php");
                    exit();
                } else {
                    $_SESSION['error'] = 'Registration successful but failed to send credentials. Please contact support.';
                }
            } else {
                $_SESSION['error'] = 'Failed to create account. Please try again.';
            }
            
            $stmt->close();
            
        } catch (Exception $e) {
            error_log("Registration error: " . $e->getMessage());
            $_SESSION['error'] = 'An error occurred during registration. Please try again.';
        }
    } else {
        $_SESSION['error'] = 'Invalid OTP. Please check and try again.';
    }
}

// Calculate remaining time
$remaining_time = $registration_data['otp_expires'] - time();
$remaining_minutes = floor($remaining_time / 60);
$remaining_seconds = $remaining_time % 60;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - TAPA Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .otp-form {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        .otp-input {
            text-align: center;
            font-size: 1.5rem;
            letter-spacing: 0.5rem;
            font-weight: bold;
        }
        .timer {
            font-size: 1.2rem;
            color: #dc3545;
            font-weight: bold;
        }
        .resend-btn {
            margin-top: 1rem;
        }
        .phone-display {
            background: #e3f2fd;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="otp-form">
                    <div class="text-center mb-4">
                        <h2><i class="bi bi-shield-check text-primary"></i> Verify OTP</h2>
                        <p class="text-muted">Enter the 6-digit code sent to your phone</p>
                    </div>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle"></i>
                            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <div class="phone-display">
                        <i class="bi bi-phone"></i>
                        <strong>Phone:</strong> <?php echo htmlspecialchars($registration_data['phone']); ?>
                    </div>

                    <div class="text-center mb-3">
                        <div class="timer" id="timer">
                            Time remaining: <span id="minutes"><?php echo $remaining_minutes; ?></span>:<span id="seconds"><?php echo str_pad($remaining_seconds, 2, '0', STR_PAD_LEFT); ?></span>
                        </div>
                    </div>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="otp" class="form-label">Enter OTP Code</label>
                            <input type="text" 
                                   class="form-control otp-input" 
                                   id="otp" 
                                   name="otp" 
                                   maxlength="6" 
                                   pattern="[0-9]{6}" 
                                   required 
                                   autocomplete="off"
                                   placeholder="000000">
                            <div class="form-text">Enter the 6-digit code sent to your phone</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-circle"></i> Verify & Complete Registration
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <a href="registration.php" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Back to Registration
                        </a>
                    </div>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            <i class="bi bi-info-circle"></i>
                            Didn't receive the code? Check your phone or contact support.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Countdown timer
        let timeLeft = <?php echo $remaining_time; ?>;
        
        function updateTimer() {
            if (timeLeft <= 0) {
                document.getElementById('timer').innerHTML = '<span style="color: red;">OTP Expired</span>';
                document.querySelector('button[type="submit"]').disabled = true;
                return;
            }
            
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            
            document.getElementById('minutes').textContent = minutes;
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
            
            timeLeft--;
            setTimeout(updateTimer, 1000);
        }
        
        updateTimer();
        
        // Auto-format OTP input
        document.getElementById('otp').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').substring(0, 6);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 