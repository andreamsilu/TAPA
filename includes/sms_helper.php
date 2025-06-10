<?php
/**
 * SMS Helper for TAPA
 * Provides easy integration with SMS providers including NEXTSMS
 */

class SMSHelper {
    private $provider;
    private $config;
    
    public function __construct($provider = 'nextsms') {
        $this->provider = $provider;
        $this->loadConfig();
    }
    
    private function loadConfig() {
        // Load configuration from environment variables or config file
        $this->config = [
            'nextsms' => [
                'api_key' => getenv('NEXTSMS_API_KEY') ?: 'your_nextsms_api_key',
                'api_secret' => getenv('NEXTSMS_API_SECRET') ?: 'your_nextsms_api_secret',
                'sender_id' => getenv('NEXTSMS_SENDER_ID') ?: 'TAPA'
            ],
            'africas_talking' => [
                'username' => getenv('AT_USERNAME') ?: 'your_username',
                'api_key' => getenv('AT_API_KEY') ?: 'your_api_key',
                'sender_id' => getenv('AT_SENDER_ID') ?: 'TAPA'
            ],
            'twilio' => [
                'account_sid' => getenv('TWILIO_ACCOUNT_SID') ?: 'your_account_sid',
                'auth_token' => getenv('TWILIO_AUTH_TOKEN') ?: 'your_auth_token',
                'from_number' => getenv('TWILIO_FROM_NUMBER') ?: 'your_from_number'
            ]
        ];
    }
    
    /**
     * Send SMS using configured provider
     */
    public function sendSMS($phone, $message) {
        switch ($this->provider) {
            case 'nextsms':
                return $this->sendViaNextSMS($phone, $message);
            case 'africas_talking':
                return $this->sendViaAfricasTalking($phone, $message);
            case 'twilio':
                return $this->sendViaTwilio($phone, $message);
            default:
                return $this->sendViaNextSMS($phone, $message);
        }
    }
    
    /**
     * Send SMS via NEXTSMS (Primary - Recommended for Tanzania)
     * Based on actual NEXTSMS API documentation
     */
    private function sendViaNextSMS($phone, $message) {
        $config = $this->config['nextsms'];
        
        // NEXTSMS API endpoint (corrected based on documentation)
        $url = 'https://messaging-service.co.tz/api/sms/v1/text/single';
        
        // Prepare the request data according to NEXTSMS API
        $data = array(
            'from' => $config['sender_id'],
            'to' => $phone,
            'text' => $message
        );
        
        // Convert to JSON
        $jsonData = json_encode($data);
        
        // Prepare headers with Bearer token authentication
        $headers = array(
            'Authorization: Bearer ' . $config['api_key'],
            'Content-Type: application/json',
            'Accept: application/json'
        );
        
        // Initialize cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_USERAGENT, 'TAPA-SMS-Integration/1.0');
        
        // Execute the request
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        // Log the SMS attempt
        error_log("SMS to $phone via NEXTSMS: $message (HTTP: $httpCode, Response: $response, Error: $error)");
        
        // Check if the request was successful
        if ($httpCode == 200 || $httpCode == 201) {
            $responseData = json_decode($response, true);
            
            // Check NEXTSMS specific response format
            if (isset($responseData['messages']) && is_array($responseData['messages'])) {
                foreach ($responseData['messages'] as $msg) {
                    // Check for successful status
                    if (isset($msg['status']['groupName']) && 
                        ($msg['status']['groupName'] == 'PENDING' || 
                         $msg['status']['groupName'] == 'DELIVERED' ||
                         $msg['status']['groupName'] == 'SENT')) {
                        return true; // SMS sent successfully
                    }
                }
            }
            
            // Alternative response format check
            if (isset($responseData['status']) && $responseData['status'] == 'success') {
                return true;
            }
            
            // If response contains message ID, consider it successful
            if (isset($responseData['messageId']) || isset($responseData['id'])) {
                return true;
            }
        }
        
        return false; // SMS failed
    }
    
    /**
     * Send SMS via Africa's Talking
     */
    private function sendViaAfricasTalking($phone, $message) {
        $config = $this->config['africas_talking'];
        
        $url = 'https://api.africastalking.com/version1/messaging';
        $data = array(
            'username' => $config['username'],
            'to' => $phone,
            'message' => $message,
            'from' => $config['sender_id']
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'apiKey: ' . $config['api_key'],
            'Content-Type: application/x-www-form-urlencoded'
        ));
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // Log the SMS attempt
        error_log("SMS to $phone via Africa's Talking: $message (HTTP: $httpCode, Response: $response)");
        
        return $httpCode == 201; // Success if HTTP 201
    }
    
    /**
     * Send SMS via Twilio
     */
    private function sendViaTwilio($phone, $message) {
        $config = $this->config['twilio'];
        
        $url = "https://api.twilio.com/2010-04-01/Accounts/{$config['account_sid']}/Messages.json";
        $data = array(
            'To' => $phone,
            'From' => $config['from_number'],
            'Body' => $message
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $config['account_sid'] . ':' . $config['auth_token']);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded'
        ));
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        // Log the SMS attempt
        error_log("SMS to $phone via Twilio: $message (HTTP: $httpCode, Response: $response)");
        
        return $httpCode == 201; // Success if HTTP 201
    }
    
    /**
     * Get SMS balance (NEXTSMS)
     */
    public function getBalance() {
        if ($this->provider !== 'nextsms') {
            return false;
        }
        
        $config = $this->config['nextsms'];
        $url = 'https://messaging-service.co.tz/api/sms/v1/balance';
        
        $headers = array(
            'Authorization: Bearer ' . $config['api_key'],
            'Content-Type: application/json',
            'Accept: application/json'
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode == 200) {
            $data = json_decode($response, true);
            return $data['balance'] ?? $data['credits'] ?? 0;
        }
        
        return false;
    }
    
    /**
     * Get SMS delivery status (NEXTSMS)
     */
    public function getDeliveryStatus($messageId) {
        if ($this->provider !== 'nextsms') {
            return false;
        }
        
        $config = $this->config['nextsms'];
        $url = "https://messaging-service.co.tz/api/sms/v1/reports?messageId=$messageId";
        
        $headers = array(
            'Authorization: Bearer ' . $config['api_key'],
            'Content-Type: application/json',
            'Accept: application/json'
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode == 200) {
            return json_decode($response, true);
        }
        
        return false;
    }
    
    /**
     * Generate OTP
     */
    public static function generateOTP($length = 6) {
        return str_pad(rand(0, pow(10, $length) - 1), $length, '0', STR_PAD_LEFT);
    }
    
    /**
     * Format phone number for SMS
     */
    public static function formatPhone($phone) {
        // Remove any non-digit characters except +
        $phone = preg_replace('/[^0-9+]/', '', $phone);
        
        // Ensure it starts with +
        if (!str_starts_with($phone, '+')) {
            // Assume Tanzania number if no country code
            if (strlen($phone) == 9 && str_starts_with($phone, '0')) {
                $phone = '+255' . substr($phone, 1);
            } elseif (strlen($phone) == 10 && str_starts_with($phone, '0')) {
                $phone = '+255' . substr($phone, 1);
            } else {
                $phone = '+255' . $phone;
            }
        }
        
        return $phone;
    }
    
    /**
     * Test SMS functionality
     */
    public function testSMS($phone) {
        $testMessage = "TAPA SMS Test: Your NEXTSMS integration is working correctly!";
        return $this->sendSMS($phone, $testMessage);
    }
    
    /**
     * Validate NEXTSMS credentials
     */
    public function validateCredentials() {
        if ($this->provider !== 'nextsms') {
            return false;
        }
        
        // Try to get balance to validate credentials
        $balance = $this->getBalance();
        return $balance !== false;
    }
}

// Global SMS function for easy use
function sendSMS($phone, $message) {
    static $smsHelper = null;
    
    if ($smsHelper === null) {
        $smsHelper = new SMSHelper('nextsms'); // Default to NEXTSMS
    }
    
    $formattedPhone = SMSHelper::formatPhone($phone);
    return $smsHelper->sendSMS($formattedPhone, $message);
}

// Global OTP generation function
function generateOTP($length = 6) {
    return SMSHelper::generateOTP($length);
}

// Global balance check function
function getSMSBalance() {
    static $smsHelper = null;
    
    if ($smsHelper === null) {
        $smsHelper = new SMSHelper('nextsms');
    }
    
    return $smsHelper->getBalance();
}

// Global test SMS function
function testSMS($phone) {
    static $smsHelper = null;
    
    if ($smsHelper === null) {
        $smsHelper = new SMSHelper('nextsms');
    }
    
    return $smsHelper->testSMS($phone);
}

// Global credential validation function
function validateSMSCredentials() {
    static $smsHelper = null;
    
    if ($smsHelper === null) {
        $smsHelper = new SMSHelper('nextsms');
    }
    
    return $smsHelper->validateCredentials();
}
?> 