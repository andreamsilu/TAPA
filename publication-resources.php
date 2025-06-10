<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Publications- TAPA </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <?php include "titleIcon.php" ?>
    <?php include "header.php" ?>
    <?php include "forms/connection.php" ?>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <div class="section-title">
                        <h2 class="pt-1">PUBLICATIONS & RESOURCES</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                // Fetch publications from database
                $query = "SELECT * FROM publications ORDER BY created_at DESC";
                $result = $conn->query($query);

                if ($result && $result->num_rows > 0) {
                    while ($publication = $result->fetch_assoc()) {
                        $thumbnail_path = $publication['thumbnail_url'] ?? '';
                        $thumbnail_display = "<img src='uploads/publications/{$thumbnail_path}' class='card-img-top' alt='Publication Thumbnail'>";
                        
                        if (empty($thumbnail_path)) {
                            $thumbnail_display = "<img src='assets/img/placeholder.jpg' class='card-img-top' alt='No Thumbnail'>";
                        }
                        
                        echo '<div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    ' . $thumbnail_display . '
                                    <div class="card-body">
                                        <h5 class="card-title">' . htmlspecialchars($publication['title']) . '</h5>
                                        <p class="card-text">' . htmlspecialchars(substr($publication['description'], 0, 150)) . '...</p>
                                        <p class="card-text"><small class="text-muted">Published: ' . date('M j, Y', strtotime($publication['created_at'])) . '</small></p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="view_publication.php?id=' . $publication['id'] . '" class="btn btn-primary btn-sm">Read More</a>
                                    </div>
                                </div>
                            </div>';
                    }
                } else {
                    echo '<div class="col-12 text-center">
                            <p>No publications available at the moment.</p>
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