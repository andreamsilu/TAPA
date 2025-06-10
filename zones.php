<?php
include('titleIcon.php');
include('header.php');
include('forms/connection.php');
?>
<link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <div class="section-title">
                        <h2 class="pt-1">TAPA ZONES</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                // Fetch zones/branches from database
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
                ?>
            </div>
        </div>
    </section>
    <?php include('footer.php'); ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html> 