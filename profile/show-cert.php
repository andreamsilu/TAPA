<?php

session_start();
include "navigation.php";
include "../forms/connection.php";

// Check if the user is authenticated
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if not authenticated
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
?>


<div class="container mt-5">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4><i class="bi bi-file-earmark-fill"></i>Certification Information</h4>
            <a href="add-cert.php" class="btn btn-success"><i class="bi bi-plus"></i> Add</a>
        </div>

        <div class="card-body">
            <?php
            include "../forms/connection.php";

            // Fetch certification information from the database
            $sql = "SELECT * FROM certification WHERE user_id ='$userId'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="table-responsive">';
                echo '<table class="table table-bordered table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Certification Name</th>';
                echo '<th>Certification Authority</th>';
                echo '<th>Certification Date</th>';
                echo '<th>Expiration Date</th>';
                echo '<th colspan="2">Action</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['certification_name'] . '</td>';
                    echo '<td>' . $row['certification_authority'] . '</td>';
                    echo '<td>' . $row['certification_date'] . '</td>';
                    echo '<td>' . ($row['expiration_date'] ? $row['expiration_date'] : 'N/A') . '</td>';
                    echo '<td><a href="edit-cert.php?id=' . $row['id'] . '" class="btn btn-warning"><i class="bi bi-pencil-fill"></i> Edit</a></td>';
                    echo '<td><a href="delete-cert.php?id=' . $row['id'] . '" class="btn btn-danger"><i class="bi bi-trash"></i> Delete</a></td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {

                echo  '<div class="card-body  d-flex justify-content-center">
              <a href="add-cert.php" class="btn btn-primary  align-items-center">
              <i class="bi bi-plus"></i> 
                  Add Certificate
              </a>
          </div>';
          echo '<div id="snackbar">No certificate info found.</div>';
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
    </div>
</div>


<?php include("footer.php") ?>