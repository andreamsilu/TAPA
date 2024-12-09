<!-- ======= Doctors Section ======= -->
<section id="doctors" class="doctors section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>EXECUTIVE COMMITTEE</h2>
        </div>

        <div class="row">
            <?php
            // Enable error reporting for debugging
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            // Include your database connection file
            include('../adminpanel/db.php'); // Adjust the path as needed

            // Check if the connection is successful
            if (!$conn) {
                die("Database connection failed: " . mysqli_connect_error());
            }

            // Fetch leaders from the executive_committee table
            $query = "SELECT * FROM executive_committee";
            $result = mysqli_query($conn, $query);

            // Check if there are leaders in the database
            if ($result && mysqli_num_rows($result) > 0) {
                // Loop through the result and display each leader
                while ($row = mysqli_fetch_assoc($result)) {
                    $image = $row['image_url'];
                    $name = $row['name'];
                    $role = $row['position'];
                    $twitter = $row['twitter_link'];
                    $facebook = $row['facebook_link'];
                    $instagram = $row['instagram_link'];
                    $linkedin = $row['linkedin_link'];
            ?>
            <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                <div class="member" data-aos="fade-up" data-aos-delay="100">
                    <div class="member-img">
                        <img src="<?php echo $image; ?>" class="img-fluid" alt="">
                        <div class="social">
                            <?php if ($twitter) { ?><a href="<?php echo $twitter; ?>"><i
                                    class="bi bi-twitter"></i></a><?php } ?>
                            <?php if ($facebook) { ?><a href="<?php echo $facebook; ?>"><i
                                    class="bi bi-facebook"></i></a><?php } ?>
                            <?php if ($instagram) { ?><a href="<?php echo $instagram; ?>"><i
                                    class="bi bi-instagram"></i></a><?php } ?>
                            <?php if ($linkedin) { ?><a href="<?php echo $linkedin; ?>"><i
                                    class="bi bi-linkedin"></i></a><?php } ?>
                        </div>
                    </div>
                    <div class="member-info">
                        <h4><?php echo $name; ?></h4>
                        <span><?php echo $role; ?></span>
                    </div>
                </div>
            </div>
            <?php
                }
            } else {
                echo "<p>No leaders found.</p>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </div>

    </div>
</section>
<!-- End Doctors Section -->