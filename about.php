<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>About - TAPA</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-f6BQoo4W/2+n7va3l1F1K5pOH2j2apIvU/jq4NF94AfTtev6Bs5v0J5/V8mJv8aFgHvuy1bQe9iRzL1FmqU07Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?php include "titleIcon.php" ?>
    <?php include "forms/connection.php" ?>
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
                            <img src="assets/img/tapaImages/Sustain Digital-11.jpg" alt="TAPA About Image">
                        </div>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                        <h3><i class="bi bi-university"></i> Tanzanian Psychological Association</h3>
                        <p class="fs-italic">
                            TAPA is a professional association of Tanzanian Psychologists joined with the aim of advancing psychology as a science, profession and as a means of promoting human well being.
                        </p>

                        <h3><i class="bi bi-bullseye"></i> Mission</h3>
                        <p>
                            The Tanzanian Psychological Association is a non- profit organization
                            which has the mission to promote and to support psychological training and
                            services in Tanzania
                        </p>

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

        <!-- ======= Executive Committee Section ======= -->
        <style>
            .member {
                border: 2px solid #ddd;
                padding: 15px;
                border-radius: 10px;
                text-align: center;
                height: 350px;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .member_img {
                width: 100%;
                height: 200px;
                overflow: hidden;
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 15px;
            }

            .member_img img {
                width: 80%;
                height: 100%;
                object-fit: cover;
                border-radius: 50%;
                border: 5px solid #fff;
                padding: 10px;
            }

            .social {
                margin-top: auto;
            }

            .member-info h4 {
                margin-top: 10px;
                font-size: 1.2rem;
            }

            .member-info span {
                color: #777;
            }

            .social a {
                margin-right: 10px;
                color: #333;
            }

            .social a:hover {
                color: #007bff;
            }
        </style>

        <section id="doctors" class="doctors section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>EXECUTIVE COMMITTEE</h2>
                </div>

                <div class="row">
                    <?php
                    // Check if team_members table exists and fetch team members
                    try {
                        $tableCheck = $conn->query("SHOW TABLES LIKE 'team_members'");
                        if ($tableCheck && $tableCheck->num_rows > 0) {
                            $query = "SELECT * FROM team_members ORDER BY position_order";
                            $result = $conn->query($query);

                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $image = $row['image_url'] ?? 'default-profile.jpg';
                                    echo '<div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                                            <div class="member" data-aos="fade-up" data-aos-delay="100">
                                                <div class="member-img">
                                                    <img src="uploads/team/' . htmlspecialchars($image) . '" class="img-fluid p-2 m-2" alt="' . htmlspecialchars($row['name']) . '">
                                                </div>
                                                <div class="member-info">
                                                    <h4>' . htmlspecialchars($row['name']) . '</h4>
                                                    <span>' . htmlspecialchars($row['position']) . '</span>
                                                </div>
                                            </div>
                                        </div>';
                                }
                            } else {
                                echo '<div class="col-12 text-center">
                                        <p>Team information will be available soon.</p>
                                      </div>';
                            }
                        } else {
                            echo '<div class="col-12 text-center">
                                    <p>Executive committee information will be available soon.</p>
                                  </div>';
                        }
                    } catch (Exception $e) {
                        echo '<div class="col-12 text-center">
                                <p>Executive committee information will be available soon.</p>
                              </div>';
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- End Executive Committee Section -->

        <!-- Include Committees Section -->
        <?php include 'commitees.php'; ?>

        <!-- Include Zones Section -->
        <section id="zones" class="zones section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>TAPA ZONES</h2>
                </div>
                <div class="row">
                    <?php
                    // Check if zones table exists and fetch zones
                    try {
                        $tableCheck = $conn->query("SHOW TABLES LIKE 'zones'");
                        if ($tableCheck && $tableCheck->num_rows > 0) {
                            $query = "SELECT * FROM zones ORDER BY zone_name";
                            $result = $conn->query($query);

                            if ($result && $result->num_rows > 0) {
                                while ($zone = $result->fetch_assoc()) {
                                    echo '<div class="col-md-4 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body text-center">
                                                    <h5 class="card-title">' . htmlspecialchars($zone['zone_name']) . '</h5>
                                                    <p class="card-text">' . htmlspecialchars($zone['description']) . '</p>
                                                    <p class="card-text"><small class="text-muted">Contact: ' . htmlspecialchars($zone['contact_info']) . '</small></p>
                                                </div>
                                            </div>
                                        </div>';
                                }
                            } else {
                                echo '<div class="col-12 text-center">
                                        <p>No zones information available at the moment.</p>
                                      </div>';
                            }
                        } else {
                            echo '<div class="col-12 text-center">
                                    <p>Zones information will be available soon.</p>
                                  </div>';
                        }
                    } catch (Exception $e) {
                        echo '<div class="col-12 text-center">
                                <p>Zones information will be available soon.</p>
                              </div>';
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- End Zones Section -->

    </main>
    <!-- End #main -->

    <?php include "footer.php" ?>
</body>
</html>