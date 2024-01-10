

    <!-- Include any necessary CSS or stylesheets here -->
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
<?php include "navigation.php" ?>

    <h1>Member Information</h1>
    <?php
    // Database connection
    include "../../forms/connection.php";

    // Check if 'id' parameter is provided in the URL
    if (isset($_GET['id'])) {
        // Get the member ID from the URL
        $member_id = $_GET['id'];

        // Prepare a SELECT query to fetch specific member information by ID
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $member_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the member details
            $member = $result->fetch_assoc();

            // Display the member information in a table
            echo "<table>";
            foreach ($member as $key => $value) {
                echo "<tr><th>" . ucfirst(str_replace('_', ' ', $key)) . "</th><td>$value</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No member found with the provided ID.";
        }

        // Close statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "No member ID provided.";
    }
    ?>
<?php include "footer.php"; ?>