<?php
// Enable error reporting for debugging
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

// Database connection
include 'adminpanel/db.php';

// Fetch branches data from the database
$sql = "SELECT * FROM branches";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialize an array to store the branch data
$branches = [];
foreach ($result as $row) {
    // Store each branch's data into variables
    $branch = [
        'image_url' => htmlspecialchars($row['image_url']),
        'branch_name' => htmlspecialchars($row['branch_name']),
        'leader_name' => htmlspecialchars($row['leader_name']),
        'leader_role' => htmlspecialchars($row['leader_role']),
        'region_coverage' => htmlspecialchars($row['region_coverage']),
    ];
    // Append the branch data to the $branches array
    $branches[] = $branch;
}
?>

<!-- ======= zone Section ======= -->
<section id="zone" class="zone">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>BRANCHES</h2>
        </div>

        <div class="row gy-4">
            <?php
            // Loop through each branch stored in the $branches array and render the HTML using Bootstrap card
            foreach ($branches as $branch) {
                echo '
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="adminpanel/' . $branch['image_url'] . '" alt="' . $branch['branch_name'] . '">
                        <div class="card-body">
                            <h5 class="card-title">' . $branch['branch_name'] . '</h5>
                            <p class="card-text">Leader: ' . $branch['leader_name'] . ' (' . $branch['leader_role'] . ')</p>
                            <p class="card-text">Region: ' . $branch['region_coverage'] . '</p>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</section>
<!-- End zone Section -->
