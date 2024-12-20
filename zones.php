<?php
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

<!-- ======= Branches Section ======= -->
<section id="branches" class="branches">
    <div class="container">
        <div class="section-title">
            <h2>BRANCHES</h2>
        </div>

        <div class="row">
            <?php
            // Loop through each branch and render the cards
            foreach ($branches as $branch) {
                echo '
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card" style="width: 18rem;">
                        <img src="adminpanel/' . $branch['image_url'] . '" class="card-img-top" alt="' . $branch['branch_name'] . '">
                        <div class="card-body">
                            <h5 class="card-title">' . $branch['branch_name'] . '</h5>
                            <p class="card-text">Leader: ' . $branch['leader_name'] . '</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Role: ' . $branch['leader_role'] . '</li>
                            <li class="list-group-item">Region: ' . $branch['region_coverage'] . '</li>
                        </ul>
                        <div class="card-body">
                            <a href="#" class="card-link">Twitter</a>
                            <a href="#" class="card-link">Facebook</a>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</section>
<!-- End Branches Section -->
