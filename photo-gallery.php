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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<main id="main">

  <!-- Portfolio Section -->
  <section id="portfolio" class="portfolio">
    <div class="container">
      
      <?php
      include 'adminpanel/db.php'; 

      // Fetch distinct event years for filtering
      $query = "SELECT DISTINCT event_year FROM gallery ORDER BY event_year DESC";
      $result = $conn->query($query);

      echo '<ul class="nav nav-tabs" id="eventTabs">';
      echo '<li class="nav-item"><a class="nav-link active" href="gallery.php">All</a></li>';
      while ($row = $result->fetch_assoc()) {
          $activeClass = (isset($_GET['event_year']) && $_GET['event_year'] == $row['event_year']) ? "active" : "";
          echo '<li class="nav-item"><a class="nav-link ' . $activeClass . '" href="gallery.php?event_year=' . $row['event_year'] . '">AGM ' . $row['event_year'] . '</a></li>';
      }
      echo '</ul>';
      ?>

      <div class="tab-content mt-4">
        <div class="row portfolio-container">
          <?php
          // Check if event_year is selected
          $filterYear = isset($_GET['event_year']) && !empty($_GET['event_year']) ? $_GET['event_year'] : null;

          // Fetch images based on the selected year or all if no filter applied
          $query = "SELECT * FROM gallery";
          if ($filterYear) {
              $query .= " WHERE event_year = '" . $conn->real_escape_string($filterYear) . "'";
          }
          $query .= " ORDER BY event_year DESC";

          $result = $conn->query($query);

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo '<div class="col-lg-4 col-md-6 portfolio-item">
                          <img src="' . $row['image_path'] . '" class="img-fluid" alt="">
                          <div class="portfolio-info">
                            <h4>AGM ' . $row['event_year'] . '</h4>
                            <p>Images</p>
                            <a href="' . $row['image_path'] . '" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link"><i class="bi bi-camera"></i></a>
                          </div>
                        </div>';
              }
          } else {
              echo '<p class="text-center">No images found for the selected year.</p>';
          }
          ?>
        </div>
      </div>

    </div>
  </section>

</main>

<?php include "footer.php"; ?>

</body>
</html>
