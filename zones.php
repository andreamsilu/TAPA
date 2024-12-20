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
<style>
/* General container styles */
#zone .container {
    max-width: 1200px;
    margin: 0 auto;
}

.section-title h2 {
    text-align: center;
    font-size: 2rem; /* Smaller font size */
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
}

/* zone card styles */
.zone {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 10px; /* Reduced border radius */
    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.zone:hover {
    transform: translateY(-5px); /* Slightly less hover effect */
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
}

/* zone image styles */
.zone-img {
    height: 250px; /* Smaller height */
    display: flex;
    align-items: center;
    justify-content: center;
}

.zone-img img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Ensure image covers the area */
}

.zone-img .social {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.zone-img:hover .social {
    opacity: 1;
}

.social a {
    background: #007bff;
    color: #fff;
    width: 25px; /* Smaller icons */
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 14px;
    transition: background 0.3s ease;
}

.social a:hover {
    background: #0056b3;
}

/* zone info styles */
.zone-info {
    text-align: center;
    padding: 15px; /* Reduced padding */
}

.zone-info h3 {
    font-size: 1.2rem; /* Smaller font size */
    color: #333;
    margin-bottom: 8px;
}

.zone-info h4 {
    font-size: 1rem;
    color: #555;
    margin-bottom: 5px;
}

.zone-info span {
    display: block;
    font-size: 0.9rem;
    color: #777;
    margin-bottom: 10px;
}

.zone-info p {
    font-size: 0.8rem; /* Reduced paragraph font size */
    color: #666;
    margin: 0;
}


</style>

<section id="zone" class="zone">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>BRANCHES</h2>
        </div>

        <div class="row gy-4">
            <?php
            // Loop through each branch stored in the $branches array and render the HTML
            foreach ($branches as $branch) {
                echo '
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                    <div class="zone">
                        <div class="zone-img">
                            <img src="adminpanel/' . $branch['image_url'] . '" class="img-fluid" alt="' . $branch['branch_name'] . '">
                            <div class="social">
                                <a href="#"><i class="bi bi-twitter"></i></a>
                                <a href="#"><i class="bi bi-facebook"></i></a>
                                <a href="#"><i class="bi bi-instagram"></i></a>
                                <a href="#"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="zone-info">
                            <h3>' . $branch['branch_name'] . '</h3>
                            <h4>' . $branch['leader_name'] . '</h4>
                            <span>' . $branch['leader_role'] . '</span>
                            <p>' . $branch['region_coverage'] . '</p>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</section>
<!-- End zone Section -->
