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

    <style>
        /* Custom Styles */
        .zone {
            padding: 60px 0;
        }

        .zone .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .zone .member {
            position: relative;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
        }

        .zone .member:hover {
            transform: translateY(-10px);
        }

        .zone .member-img {
            position: relative;
            overflow: hidden;
        }

        .zone .member-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
        }

        .zone .member-img:hover img {
            transform: scale(1.1);
        }

        .zone .social {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .zone .social a {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 8px;
            border-radius: 50%;
            color: #333;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .zone .social a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .zone .member-info {
            padding: 20px;
            text-align: center;
        }

        .zone .member-info h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .zone .member-info h4 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #555;
        }

        .zone .member-info span {
            display: block;
            margin-bottom: 10px;
            font-size: 14px;
            color: #777;
        }

        .zone .member-info p {
            font-size: 14px;
            color: #555;
            line-height: 1.5;
        }
    </style>
 

    <!-- ======= zone Section ======= -->
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
                    <div class="col-lg-4 col-md-6 d-flex align-items-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="member-img">
                                <img src="adminpanel/' . $branch['image_url'] . '" class="img-fluid" alt="' . $branch['branch_name'] . '">
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
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
 
