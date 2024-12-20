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
                    </div>

                </div>

            </div>
        </section>
        <!-- End About Section -->
        <!-- ======= Doctors Section ======= -->
        <style>
            .member_img img {
                width: 80%;
                /* Ensures responsiveness */
                height: 200px;
                /* Set a fixed height */
                object-fit: cover;
                /* Crops the image to fit the dimensions without distortion */
                border-radius: 50%;
                border-spacing: 20px;
                /* Makes images circular, optional */
            }
        </style>
        <section id="doctors" class="doctors section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>EXECUTIVE COMMITTEE</h2>
                </div>

                <div class="row">
                    <?php

                    // Include your database connection file
                    include('adminpanel/db.php'); // Adjust the path as needed

                    try {
                        // Prepare and execute the query
                        $query = "SELECT * FROM executive_committee";
                        $stmt = $conn->prepare($query);
                        $stmt->execute();

                        // Fetch all results
                        $leaders = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        // Check if leaders exist
                        if ($leaders) {
                            foreach ($leaders as $row) {
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
                                        <div class="member_img">
                                            <img src="adminpanel/<?php echo $image; ?>" class="img-fluid p-2 m-2" alt="">

                                            <div class="social mb-2">
                                                <?php if ($twitter) { ?><a href="<?php echo $twitter; ?>"><i
                                                            class="bi bi-twitter"></i></a><?php } ?>
                                                <?php if ($facebook) { ?><a href="<?php echo $facebook; ?>"><i
                                                            class="bi bi-facebook"></i></a><?php } ?>
                                                <?php if ($instagram) { ?><a href="<?php echo $instagram; ?>"><i
                                                            class="bi bi-instagram"></i></a><?php } ?>
                                                <?php if ($linkedin) { ?><a href="<?php echo $linkedin; ?>"><i
                                                            class="bi bi-linkedin"></i></a><?php } ?>
                                            </div>

                                            </d<div class="member-info">
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
                    } catch (PDOException $e) {
                        echo "Error fetching data: " . $e->getMessage();
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


        <!-- End #main -->

        <?php include "footer.php" ?>