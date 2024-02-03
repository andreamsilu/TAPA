<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Publications- TAPA </title>
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
          <h2>Publication & Resources</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Publications & Resources</li>
          </ol>
        </div>

      </div>
    </section>
    <!-- End Breadcrumbs -->

  
    <!-- ======= Why Choose Us Section ======= -->
    <section id="publication" class="publication">
      <div class="container" data-aos="fade-up">
        <div class="row g-0" data-aos="fade-up" data-aos-delay="200">
          <div class="col-xl-6 img-bg" style="background-image: url('assets/img/tapaImages/Sustain Digital-21.jpg')"></div>
          <div class="col-xl-6 slides  position-relative">
            <div class="slides-1 swiper">
              <div class="swiper-wrapper">

                <div class="swiper-slide">
                  <div class="item">
                    <h3 class="mb-0">TAPA CONSTITUTION</h3>
                     <br>
                    <p>TAPA Constitution is a foundational document that outlines the organization's structure, governance, and mission, ensuring transparent and accountable operations.</p>
                    <div class="btn-wrap">
                      <a href="assets/TAPA CONSTITUTION JUNE 2022 VERSION.pdf" style="border: 2px #0F718A solid;padding:10px;border-radius:5px;" text-center" target="_blank">Read now</a>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="item">
                    <h3 class="mb-0">CODE OF CONDUCT</h3>
                    <p>The TAPA Code of Ethics sets ethical standards for members, prioritizing professionalism, integrity, and client well-being in Tanzanian psychology and mental health services. </p>
                    <br>
                    <div class="btn-wrap">
                      <a href="assets/ethics-code.pdf" style="border: 2px #0F718A solid;padding:10px;border-radius:5px;" target="_blank">Read Now</a>
                    </div>
                  </div>
                </div>

                <!-- addd more slides for publications here -->
              </div>
              <div class="swiper-pagination"></div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
          </div>

        </div>

      </div>
    </section>
    <br>
    <br>
    <!-- End publication Section -->

    <?php include "footer.php" ?>


    <script>
      var swiper = new Swiper('.swiper', {
        slidesPerView: 1,
        spaceBetween: 30,
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
      });


      /**
       * Init swiper slider with 3 slides at once in desktop view
       */
      new Swiper('.slides-3', {
        speed: 600,
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false
        },
        slidesPerView: 'auto',
        pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        breakpoints: {
          320: {
            slidesPerView: 1,
            spaceBetween: 40
          },
          1200: {
            slidesPerView: 3,
          }
        }
      });
    </script>

    <!-- ======= End of publication Section ======= -->

    <!-- End #main -->