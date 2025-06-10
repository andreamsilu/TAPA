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
  include "header.php";
  include "forms/connection.php";
  ?>
  <link rel="stylesheet" href="style.css">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->
</head>
<body>
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
      // Fetch gallery images from database
      $query = "SELECT * FROM gallery ORDER BY created_at DESC";
      $result = $conn->query($query);

      if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo '<div class="col-md-4 mb-4">
                      <div class="gallery-item">
                          <img src="uploads/gallery/' . $row['image_path'] . '" class="img-fluid" alt="">
                          <div class="gallery-info">
                              <h4>' . htmlspecialchars($row['title']) . '</h4>
                              <p>' . htmlspecialchars($row['description']) . '</p>
                              <a href="uploads/gallery/' . $row['image_path'] . '" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link">
                                  <i class="bi bi-camera"></i>
                              </a>
                          </div>
                      </div>
                  </div>';
          }
      } else {
          echo '<div class="col-12 text-center">
                  <p>No gallery images available at the moment.</p>
                </div>';
      }
      ?>
    </div>
  </section>
</main>

<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
<?php include "footer.php"; ?>
<script src="js/jquery.min.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
