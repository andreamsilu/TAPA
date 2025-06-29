<?php
/**
 * Consolidated Login Page
 * Supports both email and member ID login
 * Checks membership renewal status and sends SMS reminders
 */

// Enable error display for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include('titleIcon.php');
include('header.php');
session_start();
include('forms/connection.php');
include('includes/sms_helper.php');

// Send SMS function
function sendSMS($phone, $message) {
    // TODO: Integrate with your SMS provider
    error_log("SMS to $phone: $message");
    return true; // Placeholder return
}

// Check membership renewal status
function checkMembershipRenewal($user_id, $conn) {
    $current_year = date('Y');
    try {
        $stmt = $conn->prepare("SELECT is_active, membership_year, phone, fullname, member_id FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            // Check if membership is active for current year
            if ($user['is_active'] == 0 || $user['membership_year'] != $current_year) {
                // Send SMS reminder for renewal
                $renewalMessage = "Dear {$user['fullname']}, your TAPA membership (ID: {$user['member_id']}) needs renewal for $current_year. Please visit tapa.or.tz to renew.";
                sendSMS($user['phone'], $renewalMessage);
                return [
                    'needs_renewal' => true,
                    'message' => 'Your membership needs renewal for the current year.',
                    'user' => $user
                ];
            }
        }
        return ['needs_renewal' => false];
    } catch (PDOException $e) {
        error_log("Membership renewal check error: " . $e->getMessage());
        return ['needs_renewal' => false];
    }
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'login') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        // Check if username is email or member ID
        $isEmail = filter_var($username, FILTER_VALIDATE_EMAIL);
        
        try {
            if ($isEmail) {
                // Login with email
                $stmt = $conn->prepare("SELECT id, password, role, is_active, membership_year FROM users WHERE email = ? LIMIT 1");
            } else {
                // Login with member ID
                $stmt = $conn->prepare("SELECT id, password, role, is_active, membership_year FROM users WHERE member_id = ? LIMIT 1");
            }
            
            $stmt->execute([$username]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                // Verify the provided password with the hashed password from the database
                if (password_verify($password, $row['password'])) {
                    // Password matches, create a session and store user information
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $username;
                    
                    // Check membership renewal status
                    $renewal_status = checkMembershipRenewal($row['id'], $conn);
                    if ($renewal_status['needs_renewal']) {
                        $_SESSION['renewal_warning'] = $renewal_status['message'];
                        $_SESSION['renewal_user'] = $renewal_status['user'];
                    }
                    
                    // Redirect to profile page
                    header("Location: profile/index.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Invalid credentials. Please try again.";
                }
            } else {
                if ($isEmail) {
                    $_SESSION['error'] = "User with this email does not exist.";
                } else {
                    $_SESSION['error'] = "Member ID not found. Please check and try again.";
                }
            }
        } catch (PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            $_SESSION['error'] = "An error occurred during login. Please try again.";
        }
    } else {
        $_SESSION['error'] = "Required fields are missing.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TAPA Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .renewal-banner {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24);
            color: white;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            text-align: center;
        }
        .renewal-banner h5 {
            margin-bottom: 0.5rem;
            color: white;
        }
        .login-type-toggle {
            text-align: center;
            margin-bottom: 1rem;
        }
        .toggle-btn {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 0.5rem 1rem;
            margin: 0 0.25rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .toggle-btn.active {
            background: #0F718A;
            color: white;
            border-color: #0F718A;
        }
        .login-form {
            display: none;
        }
        .login-form.active {
            display: block;
        }
    </style>
</head>
<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="section-title mt-5">
                    <h2 class="pt-1">SIGN IN WITH YOUR TAPA ACCOUNT</h2>
                </div>
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="img" style="background-image: url(assets/img/tapa/tapa-fam.JPG);">
                        </div>
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Sign In</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="https://www.facebook.com/profile.php?id=100092108256995"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-facebook"></span></a>
                                        <a href="https://x.com/tapa_tz?t=Xa40Dj9GacpBmaTJ863zqA&s=08"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-twitter"></span></a>
                                    </p>
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
                            
                            <!-- Login Type Toggle -->
                            <div class="login-type-toggle">
                                <button type="button" class="toggle-btn active" onclick="switchLoginType('member')">
                                    <i class="bi bi-person-badge"></i> Member ID
                                </button>
                                <button type="button" class="toggle-btn" onclick="switchLoginType('email')">
                                    <i class="bi bi-envelope"></i> Email
                                </button>
                            </div>
                            
                            <!-- Member ID Login Form -->
                            <form action="login.php" class="signin-form login-form active" id="memberLoginForm" method="post">
                                <input type="hidden" name="action" value="login">
                                <div class="form-group mb-3">
                                    <label class="label" for="member_id">Member ID</label>
                                    <input type="text" class="form-control" name="username" id="member_id"
                                        placeholder="e.g., FM2024ABC123" required>
                                    <small class="text-muted">Enter your TAPA Member ID</small>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="togglePassword"><i class="bi bi-eye"></i></button>
                                        </div>
                                    </div>
                                    <small class="text-muted">Your password is the same as your Member ID</small>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign
                                        In</button>
                                </div>
                            </form>
                            
                            <!-- Email Login Form -->
                            <form action="login.php" class="signin-form login-form" id="emailLoginForm" method="post">
                                <input type="hidden" name="action" value="login">
                                <div class="form-group mb-3">
                                    <label class="label" for="email">Email</label>
                                    <input type="email" class="form-control" name="username" id="email"
                                        placeholder="example@gmail.com" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password2">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password2" name="password"
                                            placeholder="Password" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button"
                                                id="togglePassword2"><i class="bi bi-eye"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign
                                        In</button>
                                </div>
                            </form>
                            
                            <div class="form-group d-md-flex">
                                <div class="w-50 text-left">
                                    <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="forgot_password.php">Forgot Password</a>
                                </div>
                            </div>
                            
                            <p class="text-center">Not a member? <a data-toggle="tab"
                                    href="registration.php">Register</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('footer.php'); ?>
    <script>
    // Login type toggle functionality
    function switchLoginType(type) {
        // Update toggle buttons
        document.querySelectorAll('.toggle-btn').forEach(btn => btn.classList.remove('active'));
        event.target.classList.add('active');
        
        // Show/hide forms
        document.querySelectorAll('.login-form').forEach(form => form.classList.remove('active'));
        if (type === 'member') {
            document.getElementById('memberLoginForm').classList.add('active');
        } else {
            document.getElementById('emailLoginForm').classList.add('active');
        }
    }
    
    // Password toggle functionality
    document.getElementById("togglePassword").addEventListener("click", function() {
        var passwordInput = document.getElementById("password");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
    
    document.getElementById("togglePassword2").addEventListener("click", function() {
        var passwordInput = document.getElementById("password2");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    });
    </script>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>

