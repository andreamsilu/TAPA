<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

// Database connection
include 'adminpanel/db.php';
?>

 

<!-- ======= zone Section ======= -->
<section id="zone" class="zone">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>BRANCHES</h2>
        </div>

        <div class="row gy-4">
            <?php
            // Fetch branches data from the database
            $sql = "SELECT * FROM branches";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Loop through each branch and display the data
            foreach ($result as $row) {
                echo '
                <div class="col-lg-4 col-md-6 d-flex align-items-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                        <div class="member-img">
                            <img src="adminpanel/' . htmlspecialchars($row['image_url']) . '" class="img-fluid" alt="' . htmlspecialchars($row['branch_name']) . '">
                            <div class="social">
                                <a href=""><i class="bi bi-twitter"></i></a>
                                <a href=""><i class="bi bi-facebook"></i></a>
                                <a href=""><i class="bi bi-instagram"></i></a>
                                <a href=""><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="member-info">
                            <h3>' . htmlspecialchars($row['branch_name']) . '</h3>
                            <h4>' . htmlspecialchars($row['leader_name']) . '</h4>
                            <span>' . htmlspecialchars($row['leader_role']) . '</span>
                            <p>' . htmlspecialchars($row['region_coverage']) . '</p>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
</section>
<!-- End zone Section -->
 
