<?php
class UserDataRetriever {
    private $conn;

    // Constructor to establish database connection
    public function __construct($connection) {
        $this->conn = $connection;
    }

    // Function to retrieve personal information
    public function getPersonalInformation($userId) {
        $sql = "SELECT * FROM personal_info WHERE user_id = $userId";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Function to retrieve contact information
    public function getContactInformation($userId) {
        $sql = "SELECT * FROM contact_info WHERE user_id = $userId";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    // Function to retrieve education information
    public function getEducationInformation($userId) {
        $sql = "SELECT * FROM education_info WHERE user_id = $userId";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}

// Usage example:
// Establish database connection
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create an instance of UserDataRetriever
$userDataRetriever = new UserDataRetriever($conn);

// Get user's personal information (assuming user ID is 1)
$personalInfo = $userDataRetriever->getPersonalInformation(1);
if ($personalInfo) {
    // Display or use the personal information
    print_r($personalInfo);
}

// Get user's contact information (assuming user ID is 1)
$contactInfo = $userDataRetriever->getContactInformation(1);
if ($contactInfo) {
    // Display or use the contact information
    print_r($contactInfo);
}

// Get user's education information (assuming user ID is 1)
$educationInfo = $userDataRetriever->getEducationInformation(1);
if ($educationInfo) {
    // Display or use the education information
    print_r($educationInfo);
}

// Close the database connection
$conn->close();
?>
