<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);   


 session_start();
include("connection.php");

// Check if the user is authenticated
if (!isset($_SESSION['email'])) {
    // header("Location: ../../login.php");
    exit();
}
// SQL query to fetch users where role is 1
$sql = "SELECT * FROM users WHERE role = '1'";

// Execute the query
$result = $conn->query($sql);

include("navigation.php");

?>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center">User List</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Access individual user data here
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["fullname"] . "</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . $row["phone"] . "</td>";
                                echo "<td>" . $row["role"]='Admin' . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>0 results</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
// Close the database connection
// $conn->close();
include("footer.php");
?>

