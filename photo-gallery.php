<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Photo Gallery - TAPA</title>
  <?php 
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  include "titleIcon.php"; 
  ?>
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->
</head>
<body>
<?php include "header.php"; ?>
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

  <section id="portfolio" class="portfolio">
    <div class="container">
      <?php
      include 'adminpanel/db.php'; 
      
      // Fetch distinct event years
      $query = "SELECT DISTINCT event_year FROM gallery ORDER BY event_year DESC";
      $stmt = $conn->prepare($query);
      $stmt->execute();
      $years = $stmt->fetchAll(PDO::FETCH_ASSOC);
      ?>
      
      <!-- Tab Navigation -->
      <ul class="nav  nav-tabs mb-3" id="eventTabs">
        <li class="nav-item">
          <a class="nav-link   <?= !isset($_GET['event_year']) ? 'active' : '' ?>" href="photo-gallery.php">All</a>
        </li>
        <?php foreach ($years as $year): ?>
          <li class="nav-item">
            <a class="nav-link <?= (isset($_GET['event_year']) && $_GET['event_year'] == $year['event_year']) ? 'active' : '' ?>" 
               href="photo-gallery.php?event_year=<?= $year['event_year'] ?>">
              Events in   <?= $year['event_year'] ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>

      <div class="row portfolio-container">
        <?php
        // Get selected year or show all
        $filterYear = isset($_GET['event_year']) ? $_GET['event_year'] : null;

        // Adjust the query to filter images by event year
        $query = "SELECT * FROM gallery";
        if ($filterYear) {
            $query .= " WHERE event_year = :event_year";
        }
        $query .= " ORDER BY event_year DESC";
        
        // Prepare and execute the query
        $stmt = $conn->prepare($query);
        if ($filterYear) {
            $stmt->bindParam(':event_year', $filterYear, PDO::PARAM_STR);
        }
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Check if any images are returned
        if (!empty($images)) {
            foreach ($images as $row) {
                echo '<div class="col-lg-4 col-md-6 portfolio-item">
                        <img src="adminpanel/' . $row['image_path'] . '" class="img-fluid" alt="">
                        <div class="portfolio-info">
                          <h4>Events in   ' . $row['event_year'] . '</h4>
                          <p>Images</p>
                          <a href="adminpanel/' . $row['image_path'] . '" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link"><i class="bi bi-camera"></i></a>
                        </div>
                      </div>';
            }
        } else {
            echo '<p class="text-center">No images found for the selected year.</p>';
            if ($filterYear) {
                echo '<p class="text-center">Year Selected: ' . $filterYear . '</p>';
            }
        }
        ?>
      </div>
    </div>
  </section>
</main>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
<?php include "footer.php"; ?>
</body>
</html>
