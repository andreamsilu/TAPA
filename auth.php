<?php
/**
 * Consolidated Authentication System
 * Handles login, registration, logout, and password reset functionality
 */

session_start();
include('forms/connection.php');

// CSRF Protection Class
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

// Authentication Class
class Auth {
    private $conn;
    
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    /**
     * Handle login process
     */
    public function login($email, $password) {
        if (!CSRFProtection::validateToken($_POST['csrf_token'] ?? '')) {
            return ['success' => false, 'message' => 'Invalid CSRF token'];
        }
        
        $stmt = $this->conn->prepare("SELECT id, password, role FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['email'] = $email;
                
                // Check user role and redirect accordingly
                if ($row['role'] == 1) {
                    // All users redirect to member profile page
                    return ['success' => true, 'redirect' => 'profile/index.php'];
                } else {
                    // Normal user
                    return ['success' => true, 'redirect' => 'profile/index.php'];
                }
            } else {
                return ['success' => false, 'message' => 'Invalid credentials'];
            }
        } else {
            return ['success' => false, 'message' => 'User not found'];
        }
    }
    
    /**
     * Handle registration process
     */
    public function register($data) {
        if (!CSRFProtection::validateToken($_POST['csrf_token'] ?? '')) {
            return ['success' => false, 'message' => 'Invalid CSRF token'];
        }
        
        try {
            // Validate and sanitize input
            $fullname = $this->sanitizeInput($data['fullname']);
            $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
            $phone = $this->sanitizeInput($data['phone']);
            $postal_address = $this->sanitizeInput($data['postal_address']);
            $birth_date = $this->sanitizeInput($data['birth_date']);
            $physical_address = $this->sanitizeInput($data['physical_address']);
            $membership_type = $this->sanitizeInput($data['membership_type']);
            $licensure = $this->sanitizeInput($data['licensure']);
            $yes_licensure = $this->sanitizeInput($data['yes_licensure']);
            $crime = $this->sanitizeInput($data['crime']);
            $yes_crime = $this->sanitizeInput($data['yes_crime']);
            $password = $data['password'];
            $confirm_password = $data['confirm_password'];
            
            // Validate password
            if (!$this->validatePassword($password, $confirm_password)) {
                return ['success' => false, 'message' => 'Password validation failed'];
            }
            
            // Check if email exists
            if ($this->emailExists($email)) {
                return ['success' => false, 'message' => 'Email already registered'];
            }
            
            // Hash password and create user
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(16));
            
            $sql = "INSERT INTO users(fullname, email, phone, postal_address, birth_date, physical_address, membership_type, licensure, yes_licensure, crime, yes_crime, password, token) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssssssssssss", $fullname, $email, $phone, $postal_address, $birth_date, $physical_address, $membership_type, $licensure, $yes_licensure, $crime, $yes_crime, $hashedPassword, $token);
            
            if ($stmt->execute()) {
                $this->sendRegistrationEmail($email, $fullname);
                return ['success' => true, 'message' => 'Registration successful'];
            } else {
                return ['success' => false, 'message' => 'Registration failed'];
            }
            
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
    
    /**
     * Handle logout
     */
    public function logout() {
        $_SESSION = [];
        session_destroy();
        return ['success' => true, 'redirect' => 'login.php'];
    }
    
    /**
     * Handle password reset
     */
    public function resetPassword($email) {
        $token = bin2hex(random_bytes(16));
        $stmt = $this->conn->prepare("INSERT INTO password_reset (email, token, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $email, $token);
        
        if ($stmt->execute()) {
            $this->sendPasswordResetEmail($email, $token);
            return ['success' => true, 'message' => 'Password reset link sent'];
        } else {
            return ['success' => false, 'message' => 'Failed to send reset link'];
        }
    }
    
    /**
     * Validate password
     */
    private function validatePassword($password, $confirm_password) {
        if (strlen($password) < 8) return false;
        if (!preg_match("/(?=.*[a-z])/", $password)) return false;
        if (!preg_match("/(?=.*[A-Z])/", $password)) return false;
        if (!preg_match("/(?=.*\d)/", $password)) return false;
        if ($password !== $confirm_password) return false;
        return true;
    }
    
    /**
     * Check if email exists
     */
    private function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
    
    /**
     * Sanitize input
     */
    private function sanitizeInput($input) {
        return trim(htmlspecialchars($input, ENT_QUOTES, 'UTF-8'));
    }
    
    /**
     * Send registration email
     */
    private function sendRegistrationEmail($email, $fullname) {
        $subject = 'Confirm Your Registration';
        $message = $this->getRegistrationEmailTemplate($fullname);
        $headers = "From: TAPA <admin@tapa.or.tz>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        $recipients = "$email, tapatz18@gmail.com";
        mail($recipients, $subject, $message, $headers);
    }
    
    /**
     * Send password reset email
     */
    private function sendPasswordResetEmail($email, $token) {
        $subject = "Password Reset";
        $resetLink = "reset_password.php?token=" . $token;
        $message = "Hello,\n\nPlease click on the following link to reset your password:\n\n$resetLink\n\nIf you didn't request this, you can ignore this email.";
        $headers = "From: TAPA <admin@tapa.or.tz>\r\n";
        
        mail($email, $subject, $message, $headers);
    }
    
    /**
     * Get registration email template
     */
    private function getRegistrationEmailTemplate($fullname) {
        return <<<EMAIL
<html>
<head>
    <title>Confirm Your Registration</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; padding: 10px; }
        h2 { color: #333; }
        .fees-table { margin-top: 20px; }
        .fees-table th { text-align: left; padding-right: 10px; }
        a { color: #0056b3; text-decoration: none; }
        .footer { margin-top: 20px; font-size: 0.9em; color: #555; }
    </style>
</head>
<body>
    <h2>Confirm Your Registration</h2>
    <p>Dear $fullname,</p>
    <p>Thank you for registering with TAPA. Your application has been received, and our team will get back to you after the application is processed and after payment of the fee. Your membership account will be activated only after paying the Registration and Annual Fees.</p>
    <table class="fees-table">
        <tr><th>Membership Type</th><th>Annual Fee</th></tr>
        <tr><td>Full Member</td><td>50,000 Tshs</td></tr>
        <tr><td>Associate Member I</td><td>20,000 Tshs</td></tr>
        <tr><td>Associate Member II</td><td>20,000 Tshs</td></tr>
        <tr><td>Student Member</td><td>10,000 Tshs</td></tr>
        <tr><td>Affiliates</td><td>30,000 Tshs</td></tr>
        <tr><td>Foreign Affiliates</td><td>50,000 Tshs</td></tr>
    </table>
    <p>For example, if you have a bachelor's degree in psychology, you qualify to become a Full Member. You would then deposit your annual fee of 50,000 Tshs plus the 10,000 Tshs one-time application fee. The total amount to deposit would be 60,000 TShs.</p>
    <p>BANK: NMB.<br>Account No: 20810008255<br>Account name: Tanzanian Psychological Association</p>
    <p>After payment upload proof of payment (receipt) <a href='https://tapa.or.tz/pay_annual_fees.php'>here</a>.</p>
    <p>For any inquiries, please email <a href='mailto:admin@tapa.or.tz'>admin@tapa.or.tz</a> or Whatsapp +255 719911575.</p>
    <p>If you did not register on our website, please ignore this message.</p>
    <div class="footer">
        Regards,<br>
        Administrative Assistant,<br>
        Tanzanian Psychological Association (TAPA)<br>
        +255 679 256 256
    </div>
</body>
</html>
EMAIL;
    }
}

// Initialize Auth class
$auth = new Auth($conn);

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'login':
            $result = $auth->login($_POST['email'], $_POST['password']);
            if ($result['success']) {
                header("Location: " . $result['redirect']);
                exit();
            } else {
                $_SESSION['error'] = $result['message'];
                header("Location: login.php");
                exit();
            }
            break;
            
        case 'register':
            $result = $auth->register($_POST);
            if ($result['success']) {
                header("Location: registration_success.php");
                exit();
            } else {
                $_SESSION['error'] = $result['message'];
                header("Location: registration.php");
                exit();
            }
            break;
            
        case 'logout':
            $result = $auth->logout();
            header("Location: " . $result['redirect']);
            exit();
            break;
            
        case 'reset_password':
            $result = $auth->resetPassword($_POST['email']);
            if ($result['success']) {
                header("Location: reset_link_sent.php");
                exit();
            } else {
                $_SESSION['error'] = $result['message'];
                header("Location: forgot_password.php");
                exit();
            }
            break;
    }
}
?> 