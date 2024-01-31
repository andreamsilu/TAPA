<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TAPA</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <?php include("titleIcon.php");
  ?>
  <style>
    /* General styles */
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      /* background-color: #0F718A; */
    }
  </style>
</head>

<?php
include "header.php";
// include "hero.php";

?>


<body>

  <?php
  // include "header.php";
  include "hero.php";

  ?>
  <!-- =====Hero section===== -->
  <!-- <section class="hero">
    <div class="container-fluid">
      <div class="row position-relative">
        <div class="hero-carousel">
          <img src="assets/img/carousel-images/group-therapy.png" alt="Image 1">
          <img src="assets/img/carousel-images/advocacy-removebg-preview.png" alt="Image 2">
          <img src="assets/img/carousel-images/3918491-removebg-preview.png" alt="Image 2">
          <img src="assets/img/carousel-images/relationship-counseling-.avif" alt="">
          <img src="assets/img/carousel-images/advocacy-removebg-preview.png" alt="Image 2"> -->

  <!-- Add more images as needed -->
  <!-- </div>
        <div class="col-lg-6 d-flex align-items-center">
          <div class="overlay card">
            <div class="card-body">
              <h2 class="card-title">About TAPA</h2>
              <p class="card-text">Tanzanian Psychological Association is an organization that represents psychologists and professionals in the field of psychology in Tanzanian. Its primary objectives typically include promoting the field of psychology, advancing the professional development of psychologists, and advocating for mental health and psychological well-being in the country.
              </p>
              <a href="about.php" class="btn">Learn More</a>
            </div>
          </div>

        </div>
        <div class="col-lg-5 p-0">
          <div class="card join-card">
            <div class="card-body">
              <h3>Membership in TAPA</h3>
              <p>Become a member of TAPA and be part of a community dedicated to advancing psychology.</p>
              <a href="membeship-category.php" class="btn">Learn More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <div class="section-title">
    <h2>TAPA NEWS</h2>
  </div>
  <?php include "Admin/news/read_news.php" ?>

  <!-- ======= Services Section ======= -->
  <section id="services" class="services section-bg">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>TAPA SERVICES AND ACTIVITIES</h2>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
          <div class="service-box">
            <img src="assets/img/service-img/progress.png" alt="" class="service-image">
            <h4><a href="#">Professional Development</a></h4>
            <p>The association supports the professional growth of psychologists and related professionals through training, workshops, and conferences.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
          <div class="service-box">
            <img src="assets/img/service-img/advocay4.png" alt="" class="service-image">
            <h4><a href="#">Advocacy</a></h4>
            <p>Advocating for mental health awareness, access to services, and policies supporting psychological research and practice.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
          <div class="service-box">
            <img src="assets/img/service-img/integrity.png" alt="" class="service-image">
            <h4><a href="#">Ethics and Standards</a></h4>
            <p>Establishing and upholding ethical guidelines, providing resources, and supporting adherence to ethical principles.</p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
          <div class="service-box">
            <img src="assets/img/service-img/teacher.png" alt="" class="service-image">
            <h4><a href="#">Continuing Education</a></h4>
            <p>Offering opportunities for continuous education and professional development to stay updated with field developments.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
          <div class="service-box">
            <img src="assets/img/service-img/research.png" alt="" class="service-image">
            <h4><a href="#">Research and Education</a></h4>
            <p>Promoting research, supporting educational initiatives, and facilitating knowledge-sharing among members.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
          <div class="service-box">
            <img src="assets/img/service-img/community.png" alt="" class="service-image">
            <h4><a href="#">Community Outreach and Networking</a></h4>
            <p>Building a supportive network of professionals and promoting mental health awareness in communities.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Services Section -->


  <!-- ======= F.A.Q Section ======= -->
  <section id="faq" class="faq">

    <div class="container" data-aos="fade-up">

      <header class="section-title">
        <!-- <h2>F.A.Q</h2> -->
        <h2>Frequently Asked Questions</h2>
      </header>

      <div class="row">
        <div class="col-lg-6">
          <!-- F.A.Q List 1-->
          <div class="accordion accordion-flush" id="faqlist1">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-1">
                  What is psychotherapy/counseling?
                </button>
              </h2>
              <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                <div class="accordion-body">
                  Psychotherapy or counseling is a professional process that helps individuals explore and manage their emotions, thoughts, and behaviors to improve mental well-being. </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                  How do I know if I need therapy? </button>
              </h2>
              <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                <div class="accordion-body">
                  If you're experiencing persistent emotional distress, behavioral issues, or difficulties in daily functioning, it may be time to consider therapy.

                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                  How do I choose the right therapist for me? </button>
              </h2>
              <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                <div class="accordion-body">
                  Choose a therapist based on their expertise, approach, and how comfortable you feel discussing your concerns with them.

                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-lg-6">

          <!-- F.A.Q List 2-->
          <div class="accordion accordion-flush" id="faqlist2">

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-1">
                  What can I expect in my first therapy session? </button>
              </h2>
              <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                <div class="accordion-body">
                  The first session involves getting to know each other, discussing your reasons for seeking therapy, and understanding the therapeutic process.

                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-2">
                  How long does therapy usually take? </button>
              </h2>
              <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                <div class="accordion-body">
                  Therapy duration varies depending on your needs and progress, ranging from a few sessions to several months or more.

                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-3">
                  What's the difference between a psychologist and a psychiatrist? </button>
              </h2>
              <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                <div class="accordion-body">
                  Psychologists provide therapy and counseling, while psychiatrists can prescribe medication in addition to therapy.

                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

    </div>
    <style>
  
    </style>
  </section>
  <!-- End F.A.Q Section -->


  <!-- ======= Our Clients Section ======= -->
  <!-- <section id="clients" class="clients">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Clients</h2>
      </div>

      <div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">

        <div class="col-lg-3 col-md-4 col-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-1.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-2.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-3.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-4.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-5.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-6.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-7.png" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-3 col-md-4 col-6">
          <div class="client-logo">
            <img src="assets/img/clients/client-8.png" class="img-fluid" alt="">
          </div>
        </div>

      </div>

    </div>
  </section>  -->
  <!-- End Our Clients Section -->


  <!-- jQuery and Bootstrap Bundle with Popper.js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <!-- Owl Carousel JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script>
   
  </script>
</body>

</html>
<?php include("footer.php") ?>