<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>About </title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-f6BQoo4W/2+n7va3l1F1K5pOH2j2apIvU/jq4NF94AfTtev6Bs5v0J5/V8mJv8aFgHvuy1bQe9iRzL1FmqU07Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <?php include "titleIcon.php" ?>


</head>

<body>
    <?php include "header.php" ?>


    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>About</h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>About</li>
                    </ol>
                </div>

            </div>
        </section>
        <!-- End Breadcrumbs -->


        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="row">
                    <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
                        <div class="about-img">
                            <img src="assets/img/tapaImages/Sustain Digital-11.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                        <h3><i class="bi bi-university"></i> Tanzanian Psychological Association</h3>
                        <p class="fs-italic">
                            TAPA is the leading professional organization representing psychology in the Tanzania, with
                            a good number of researchers, educators, clinicians, consultants, and students as its
                            members.
                        </p>

                        <h3><i class="bi bi-bullseye"></i> Mission</h3>
                        <p>
                            The Tanzanian Psychological Association is a non- profit organization
                            which has the mission to promote and to support psychological training and
                            services in Tanzania</p>

                        <h3><i class="bi bi-people"></i> Principle objective</h3>
                        <p>
                            To promote the common interests of the members of the Association, who are
                            practitioners of or who are involved in the field of psychology.
                        </p>

                        <h3><i class="bi bi-eye"></i> Vision</h3>
                        <p>A mentally healthy Tanzania, where everyone has access to quality psychological care,
                            empowering them to thrive.</p>
                    </div>

                </div>

            </div>
        </section>
        <!-- End About Section -->


        <!-- ======= Doctors Section ======= -->
        <section id="doctors" class="doctors section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>EXECUTIVE COMMITTEE</h2>
                </div>

                <div class="row">
                    <?php
          // Include your database connection file
          include('adminpanel/db.php');

          // Fetch leaders from the executive_committee table
          $query = "SELECT * FROM executive_committee";
          $result = mysqli_query($conn, $query);

          // Check if there are leaders in the database
          if ($result) {
            // Loop through the result and display each leader
            while ($row = mysqli_fetch_assoc($result)) {
              $image = $row['image_url']; // Assuming 'image_url' is the column for the leader's image
              $name = $row['name']; // Assuming 'name' is the column for the leader's name
              $role = $row['role']; // Assuming 'role' is the column for the leader's role
              $twitter = $row['twitter']; // Assuming 'twitter' is the column for Twitter link
              $facebook = $row['facebook']; // Assuming 'facebook' is the column for Facebook link
              $instagram = $row['instagram']; // Assuming 'instagram' is the column for Instagram link
              $linkedin = $row['linkedin']; // Assuming 'linkedin' is the column for LinkedIn link
          ?>

                    <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                        <div class="member" data-aos="fade-up" data-aos-delay="100">
                            <div class="member-img">
                                <img src="adminpanel<?php echo $image; ?>" class="img-fluid" alt="">
                                <div class="social">
                                    <a href="<?php echo $twitter; ?>"><i class="bi bi-twitter"></i></a>
                                    <a href="<?php echo $facebook; ?>"><i class="bi bi-facebook"></i></a>
                                    <a href="<?php echo $instagram; ?>"><i class="bi bi-instagram"></i></a>
                                    <a href="<?php echo $linkedin; ?>"><i class="bi bi-linkedin"></i></a>
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
          ?>

                </div>

            </div>
        </section>

        <!-- End Doctors Section -->

        <?php
    include 'commitees.php';
    include 'zones.php';
    ?>

    </main>
    <!-- End #main -->

    <?php include "footer.php" ?>