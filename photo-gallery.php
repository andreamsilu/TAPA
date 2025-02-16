<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  include 'adminpanel/db.php';  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Photo gallery - TAPA</title>
  <?php include "titleIcon.php"; ?>
</head>

<body>
<?php include "header.php"; ?>

<main id="main">
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center">
        <h2>Photo Gallery</h2>
        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Photo Gallery</li>
        </ol>
      </div>
    </div>
  </section>

  <section id="portfolio" class="portfolio">
    <div class="container">
      <div class="row" data-aos="fade-up">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-agm2021">AGM 2021</li>
            <li data-filter=".filter-agm2022">AGM 2022</li>
            <li data-filter=".filter-agm2023">AGM 2023</li>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container" data-aos="fade-up">
        <?php
        $query = "SELECT image_path, category FROM gallery";
        $result = mysqli_query($conn, $query);
        
        while ($row = mysqli_fetch_assoc($result)) {
          $categoryClass = strtolower(str_replace(' ', '', $row['category']));
          echo '<div class="col-lg-4 col-md-6 portfolio-item filter-' . $categoryClass . '">
                  <img src="' . $row['image_path'] . '" class="img-fluid" alt="">
                  <div class="portfolio-info">
                    <h4>' . htmlspecialchars($row['category']) . '</h4>
                    <p>Images</p>
                    <a href="' . $row['image_path'] . '" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link">
                      <i class="bi bi-camera"></i>
                    </a>
                  </div>
                </div>';
        }
        ?>
      </div>
    </div>
  </section>
</main>

<?php include "footer.php"; ?>
</body>
</html>
