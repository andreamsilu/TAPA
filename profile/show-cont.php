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
?>

<style>
    .border-all {
        border: 1px solid #dee2e6;
        padding: 10px;
        border-radius: 5px;
    }

    .contact-card {
        margin-bottom: 20px;
    }

    /* .card-header {
        background-color: #28a745;
        color: #fff;
    } */

    .btn-icons {
        margin-top: 10px;
    }
</style>

<div class="container mt-5">
    <?php
    // Get user ID
    $userId = $_SESSION['user_id'];

    // Get contact information for the specific user
    $sql = "SELECT * FROM contact_info WHERE user_id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
            <div class="card contact-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5><i class="bi bi-telephone"></i> Contact Information</h5>
                    <div class="btn-icons">
                        <a href="edit-cont.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="border-all"><strong><i class="bi bi-phone"></i> Mobile 1:</strong> <?php echo $row['mobile1']; ?></p>
                            <p class="border-all"><strong><i class="bi bi-phone"></i> Mobile 2:</strong> <?php echo $row['mobile2']; ?></p>
                            <p class="border-all"><strong><i class="bi bi-whatsapp"></i> Whatsapp Number:</strong> <?php echo $row['whatsapp_number']; ?></p>
                            <p class="border-all"><strong><i class="bi bi-envelope"></i> Secondary Email:</strong> <?php echo $row['secondary_email']; ?></p>
                            <p class="border-all"><strong><i class="bi bi-envelope"></i> Work Email:</strong> <?php echo $row['work_email']; ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="border-all"><strong><i class="bi bi-geo-alt"></i> Country of Residence:</strong> <?php echo $row['country_residence']; ?></p>
                            <p class="border-all"><strong><i class="bi bi-geo-alt"></i> State of Residence:</strong> <?php echo $row['state_residence']; ?></p>
                            <p class="border-all"><strong><i class="bi bi-geo-alt"></i> City of Residence:</strong> <?php echo $row['city_residence']; ?></p>
                            <p class="border-all"><strong><i class="bi bi-geo-alt"></i> Area of Residence:</strong> <?php echo $row['area_residence']; ?></p>
                            <p class="border-all"><strong><i class="bi bi-geo-alt"></i> ZIP Code / PO Box:</strong> <?php echo $row['zip_code']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    } else {

        echo "<div id='snackbar'>No contact info found.</div>
        ";
        echo ' <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center bg-light ">
                      <h4><i class="bi bi-telephone"></i> Contact information</h4>
                      <!-- Edit Icon -->
                      <a href="add-cont.php" class="btn btn-primary"><i class="bi bi-plus"></i> Add</a>
                  </div>
          <div class="card-body  d-flex justify-content-center">
              <a href="add-cont.php" class="btn btn-primary  align-items-center">
              <i class="bi bi-plus"></i> 
                  Add Contact info
              </a>
          </div>
      </div>';
    }

    $conn->close();
?>
</div>

<?php include("footer.php") ?>