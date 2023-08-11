<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Photo gallery - TAPA</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <?php include "titleIcon.php" ?>
</head>

<body>
<?php include "header.php" ?>

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Photo gallery</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Photo gallery</li>
          </ol>
        </div>

      </div>
    </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="row" data-aos="fade-up">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-web">Web</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container" data-aos="fade-up">

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="assets/img/tapaImages/Sustain Digital-11.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>AGM 2023</h4>
              <p>Images</p>
              <a href="assets/img/tapaImages/Sustain Digital-2.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 1"><i class="bi bi-eye"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="assets/img/tapaImages/Sustain Digital-3.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Web 3</h4>
              <p>Web</p>
              <a href="assets/img/tapaImages/Sustain Digital-7.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bi bi-eye"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="assets/img/tapaImages/Sustain Digital-10.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>AGM 2023</h4>
              <p>Images</p>
              <a href="assets/img/tapaImages/Sustain Digital-11.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 2"><i class="bi bi-eye"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="assets/img/tapaImages/Sustain Digital-15 (1).jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>AGM 2022</h4>
              <p>Images</p>
              <a href="assets/img/tapaImages/Sustain Digital-24.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 2"><i class="bi bi-eye"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="assets/img/tapaImages/Sustain Digital-31.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>AGM 2021</h4>
              <p>Web</p>
              <a href="assets/img/tapaImages/Sustain Digital-32.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 2"><i class="bi bi-eye"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <img src="assets/img/tapaImages/Sustain Digital-30.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>AGM 2020</h4>
              <p>Images</p>
              <a href="assets/img/tapaImages/Sustain Digital-38.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="App 3"><i class="bi bi-eye"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="assets/img/tapaImages/Sustain Digital-15.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>AGM 2020</h4>
              <p>Images</p>
              <a href="assets/img/tapaImages/Sustain Digital-15 (1).jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 1"><i class="bi bi-eye"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <img src="assets/img/tapaImages/Sustain Digital-5.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>AGM 2019</h4>
              <p>Images</p>
              <a href="assets/img/tapaImages/Sustain Digital-11.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Card 3"><i class="bi bi-eye"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <img src="assets/img/tapaImages/slide-3.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>AGM 2018</h4>
              <p>Images</p>
              <a href="assets/img/tapaImages/slide-2.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox preview-link" title="Web 3"><i class="bi bi-eye"></i></a>
            </div>
          </div>

        </div>

      </div>
    </section>
    <!-- End Portfolio Section -->

  </main>
  <!-- End #main -->

  <?php include "footer.php" ?>
