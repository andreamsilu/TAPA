# TAPA Simplified Registration System

## Overview

The TAPA (Tanzanian Psychological Association) registration system has been simplified to provide a streamlined user experience with OTP verification and SMS functionality using **NEXTSMS**.

## Key Features

### 🔐 **Simplified Registration**
- **Only 4 Required Fields**: Full name, email, phone, membership type
- **OTP Verification**: Phone number verification via SMS
- **Auto-generated Credentials**: Member ID and password automatically generated
- **SMS Notifications**: Login credentials sent via SMS

### 📱 **NEXTSMS Integration**
- **OTP Delivery**: 6-digit verification codes sent to phone
- **Login Credentials**: Member ID and password sent via SMS
- **Renewal Reminders**: Automatic SMS reminders for membership renewal
- **Tanzania Optimized**: Best coverage and pricing for Tanzania

### 🔑 **Dual Login System**
- **Member ID Login**: Primary login method using generated Member ID
- **Email Login**: Alternative login method for existing users
- **Password**: Same as Member ID (simplified for users)

### ⚠️ **Membership Renewal System**
- **Automatic Detection**: Checks membership status on login
- **Renewal Banners**: Displays warning banners for expired memberships
- **SMS Reminders**: Sends renewal reminders via SMS
- **Payment Integration**: Links to payment system for renewal

## File Structure

```
TAPA/
├── registration.php              # Main registration form
├── verify_otp.php               # OTP verification page
├── registration_success.php     # Success page with credentials
├── login.php                    # Updated login with dual system
├── profile/index.php            # Profile with renewal banners
├── includes/
│   └── sms_helper.php          # NEXTSMS integration helper
├── test_sms.php                # SMS testing utility
└── forms/
    └── connection.php           # Database connection
```

## Registration Flow

### 1. **Registration Form** (`registration.php`)
- User fills: Full name, email, phone, membership type
- System generates: Member ID, password, OTP
- OTP sent via NEXTSMS to user's phone
- Redirects to OTP verification

### 2. **OTP Verification** (`verify_otp.php`)
- User enters 6-digit OTP
- System verifies OTP and creates account
- Login credentials sent via NEXTSMS
- Redirects to success page

### 3. **Success Page** (`registration_success.php`)
- Displays Member ID and password
- Shows payment information
- Provides links to payment and login

## Login System

### **Member ID Login** (Primary)
- Username: Generated Member ID (e.g., FM2024ABC123)
- Password: Same as Member ID
- Example: `FM2024ABC123` / `FM2024ABC123`

### **Email Login** (Alternative)
- Username: Email address
- Password: User's password
- For existing users or admin access

## NEXTSMS Configuration

### **Environment Variables**
```bash
# NEXTSMS Configuration
NEXTSMS_API_KEY=your_nextsms_api_key
NEXTSMS_API_SECRET=your_nextsms_api_secret
NEXTSMS_SENDER_ID=TAPA
```

### **Getting NEXTSMS Credentials**
1. **Sign up** at [messaging-service.co.tz](https://messaging-service.co.tz)
2. **Create an account** and verify your phone number
3. **Get API credentials** from your dashboard
4. **Set sender ID** (e.g., "TAPA")
5. **Add credit** to your account

### **SMS Helper Usage**
```php
// Include the SMS helper
require_once 'includes/sms_helper.php';

// Send SMS
sendSMS('+255123456789', 'Your OTP is: 123456');

// Generate OTP
$otp = generateOTP(6);

// Check SMS balance
$balance = getSMSBalance();

// Test SMS functionality
testSMS('+255123456789');
```

## Membership Types & Fees

| Type | Prefix | Annual Fee | Registration Fee |
|------|--------|------------|------------------|
| Full Member | FM | 50,000 TSH | 10,000 TSH |
| Associate Member I | AM1 | 20,000 TSH | 10,000 TSH |
| Associate Member II | AM2 | 20,000 TSH | 10,000 TSH |
| Student Member | SM | 10,000 TSH | 10,000 TSH |
| Local Affiliate | LA | 30,000 TSH | 10,000 TSH |
| Foreign Affiliate | FA | 50,000 TSH | 10,000 TSH |

## Member ID Format

**Format**: `{PREFIX}{YEAR}{RANDOM}`
- **PREFIX**: Based on membership type (FM, AM1, AM2, SM, LA, FA)
- **YEAR**: Current year (2024, 2025, etc.)
- **RANDOM**: 6-character random string

**Examples**:
- `FM2024ABC123` - Full Member 2024
- `SM2024XYZ789` - Student Member 2024
- `LA2024DEF456` - Local Affiliate 2024

## Database Schema Updates

### **Users Table**
```sql
ALTER TABLE users ADD COLUMN member_id VARCHAR(20) UNIQUE;
ALTER TABLE users ADD COLUMN is_active TINYINT(1) DEFAULT 1;
ALTER TABLE users ADD COLUMN membership_year YEAR DEFAULT YEAR(CURDATE());
ALTER TABLE users ADD COLUMN registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
```

## Security Features

### **CSRF Protection**
- All forms include CSRF tokens
- Prevents cross-site request forgery attacks

### **Input Validation**
- Email format validation
- Phone number formatting
- SQL injection prevention with prepared statements

### **Session Management**
- Secure session handling
- Automatic session cleanup
- Session-based OTP storage

## Setup Instructions

### 1. **Database Setup**
```sql
-- Add new columns to users table
ALTER TABLE users ADD COLUMN member_id VARCHAR(20) UNIQUE;
ALTER TABLE users ADD COLUMN is_active TINYINT(1) DEFAULT 1;
ALTER TABLE users ADD COLUMN membership_year YEAR DEFAULT YEAR(CURDATE());
ALTER TABLE users ADD COLUMN registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP;
```

### 2. **NEXTSMS Configuration**
- Sign up at [messaging-service.co.tz](https://messaging-service.co.tz)
- Get your API key and secret
- Set environment variables
- Test SMS functionality using `test_sms.php`

### 3. **File Permissions**
- Ensure `includes/` directory is writable
- Check file permissions for uploads

### 4. **Testing**
- Run `test_sms.php` to verify NEXTSMS integration
- Test registration flow
- Verify OTP delivery
- Check login functionality
- Test renewal banner display

## Testing SMS Integration

### **Using test_sms.php**
1. Set your NEXTSMS credentials as environment variables
2. Access `test_sms.php` in your browser
3. Enter your test phone number
4. Click "Send Test SMS"
5. Check your phone for the test message

### **Manual Testing**
```php
// Test SMS functionality
require_once 'includes/sms_helper.php';

// Test OTP generation
$otp = generateOTP();
echo "Generated OTP: $otp";

// Test SMS sending
$result = sendSMS('+255123456789', 'Test message from TAPA');
echo $result ? "SMS sent successfully" : "SMS failed";

// Check balance
$balance = getSMSBalance();
echo "SMS Balance: $balance";
```

## Troubleshooting

### **SMS Not Sending**
- Check NEXTSMS API credentials
- Verify phone number format (+255XXXXXXXXX)
- Check server logs for errors
- Ensure cURL is enabled
- Verify NEXTSMS account has credit

### **OTP Issues**
- Check session configuration
- Verify OTP expiry time (5 minutes)
- Ensure proper redirects

### **Login Problems**
- Check database connection
- Verify member_id uniqueness
- Check password hashing

### **NEXTSMS Specific Issues**
- **API Key Invalid**: Check your NEXTSMS API key
- **Insufficient Credit**: Add credit to your NEXTSMS account
- **Sender ID Not Approved**: Contact NEXTSMS support
- **Phone Number Format**: Ensure numbers start with +255

## NEXTSMS Pricing (Tanzania)

| Type | Cost per SMS |
|------|--------------|
| Local Numbers | ~15-25 TSH |
| International | Varies by country |
| Bulk SMS | Discounted rates |

## Future Enhancements

### **Planned Features**
- Email verification option
- Password reset via SMS
- Bulk SMS for announcements
- Payment status tracking
- Membership expiry notifications

### **Integration Opportunities**
- Payment gateway integration
- Email marketing integration
- Analytics and reporting
- Mobile app development

## Support

### **TAPA Support**
- Email: admin@tapa.or.tz
- WhatsApp: +255 719911575
- Website: tapa.or.tz

### **NEXTSMS Support**
- Website: [messaging-service.co.tz](https://messaging-service.co.tz)
- Email: support@messaging-service.co.tz
- Phone: +255 22 286 0000

---

**Last Updated**: January 2025
**Version**: 2.0
**SMS Provider**: NEXTSMS
**Developer**: TAPA Web Team 