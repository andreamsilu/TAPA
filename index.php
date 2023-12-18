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
    }

    .btn {
      border: #0F718A solid 2px;
      border-radius: 20px;
      color: #0F718A;
    }

    .btn:hover {
      background-color: #0F718A;
      color: white;
      border-radius: 20px;
    }

    .hero {
      position: relative;
      overflow: hidden;
      height: 400px;
      /* Adjust the height as needed */
    }

    .hero-carousel {
      position: absolute;
      top: 0;
      left: 0;
      width: 200%;
      /* Twice the width for two images */
      height: 400px;
      display: flex;
      animation: carousel-slide 8s infinite linear;
    }

    .hero-carousel img {
      width: 100%;
      /* Half of the container for each image */
      height: 100%;
      object-fit: cover;
    }

    .overlay {
      position: absolute;
      top: 80%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(265, 255, 255, 0.9);
      /* Transparent background */
      width: 80%;
    }

    .overlay .card-body {
      padding: 20px;
      height: 300px;
      text-align: center;
    }

    .overlay h2 {
      /* color: #0F718A; */
      /* margin-bottom: 1px; */
    }

    .overlay p {
      color: #333;
      font-size: 18px;
      font-weight: 300;
      font-family: 'Roboto', sans-serif;
    }

    @keyframes carousel-slide {
      0% {
        transform: translateX(0);
      }

      100% {
        transform: translateX(-50%);
      }
    }

    .join-card {
      background-color: rgba(265, 255, 255, 0.9);

    }


    /*===== News section styles=====*/
    .owl-carousel .owl-item {
      margin-right: 10px;
    }

    .owl-carousel .owl-item .item {
      height: 300px;
      /* Fixed height for all news items */
      position: relative;
    }

    .news-item {
      border: 1px solid #ccc;
      position: relative;
      overflow: hidden;
      border-radius: 5px;
    }

    .news-item img {
      width: 100%;
      height: auto;
    }

    .news-details {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      padding: 15px;
      color: #fff;
      text-align: center;
    }

    .news-details h4 {
      margin-bottom: 10px;
      font-size: 1.5em;
    }

    .news-details p {
      margin-bottom: 5px;
      font-size: 0.9em;
    }


    /* =====Services Section=====*/
    .services {
      padding: 80px 0;
    }

    .section-title {
      font-size: 32px;
      font-weight: 700;
      text-align: center;
      color: #0F718A;
      margin-bottom: 10px;
    }

    .service-box {
      background: #ccc;
      padding: 30px;
      text-align: center;
      box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease-in-out;
      border-radius: 10px;
      margin: 10px;
    }

    .service-box:hover {
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.15);
      transform: translateY(-5px);
    }

    .service-box .service-image {
      max-width: 150px;
      margin-bottom: 20px;
    }

    .service-box h4 {
      font-size: 24px;
      font-weight: 600;
      color: #333;
      margin-bottom: 15px;
    }

    .service-box p {
      font-size: 16px;
      line-height: 1.6;
      color: #666;
    }

    /*--------------------------------------------------------------
# Frequently Asked Questions
--------------------------------------------------------------*/

    .faq h2 {
      color: #0F718A;
      text-align: center;
      margin-bottom: 40px;
      font-size: 28px;
    }

    .faq .faq-list {
      padding: 0 100px;
    }

    .faq .faq-list ul {
      padding: 0;
      list-style: none;
    }

    .faq .faq-list li+li {
      margin-top: 15px;
    }

    .faq .faq-list li {
      padding: 20px;
      background: #0F718A;
      border-radius: 4px;
      position: relative;
    }

    .faq .faq-list a {
      display: block;
      position: relative;
      font-family: "Poppins", sans-serif;
      font-size: 16px;
      line-height: 24px;
      font-weight: 500;
      padding: 0 30px;
      outline: none;
      cursor: pointer;
      color: #fff;
      text-decoration: none;
    }

    .faq .faq-list .icon-help {
      font-size: 24px;
      position: absolute;
      right: 0;
      left: 20px;
      color: #fff;
    }

    .faq .faq-list .icon-show,
    .faq .faq-list .icon-close {
      font-size: 24px;
      position: absolute;
      right: 0;
      top: 0;
    }

    .faq .faq-list p {
      margin-bottom: 0;
      padding: 10px 0 0 0;
      color: #fff;
    }

    .faq .faq-list .icon-show {
      display: none;
    }

    .faq .faq-list a.collapsed {
      color: #343a40;
      transition: 0.3s;
      /* background-color: #fff; */
      color: #fff;
      border: #0F718A solid 2px;
    }

    .faq .faq-list a.collapsed:hover {
      color: #fff;
    }

    .faq .faq-list a.collapsed .icon-show {
      display: inline-block;
    }

    .faq .faq-list a.collapsed .icon-close {
      display: none;
    }

    @media (max-width: 1200px) {
      .faq .faq-list {
        padding: 0;
      }
    }
  </style>
</head>

<?php
include "header.php";
//include "hero.php";

?>

<body>

  <!-- =====Hero section===== -->
  <section class="hero">
    <div class="container-fluid">
      <div class="row position-relative">
        <div class="hero-carousel">
          <img src="assets/img/carousel-images/group-therapy.png" alt="Image 1">
          <img src="assets/img/carousel-images/advocacy-removebg-preview.png" alt="Image 2">
          <img src="assets/img/carousel-images/3918491-removebg-preview.png" alt="Image 2">
          <img src="assets/img/carousel-images/relationship-counseling-.avif" alt="">
          <img src="assets/img/carousel-images/advocacy-removebg-preview.png" alt="Image 2">

          <!-- Add more images as needed -->
        </div>
        <div class="col-lg-6 d-flex align-items-center">
          <div class="overlay card">
            <div class="card-body">
              <h2 class="card-title">About TAPA</h2>
              <p class="card-text">Tanzanian Psychological Association is an organization that represents psychologists and professionals in the field of psychology in Tanzanian. Its primary objectives typically include promoting the field of psychology, advancing the professional development of psychologists, and advocating for mental health and psychological well-being in the country.
              </p>
              <a href="#" class="btn ">Learn More</a>
            </div>
          </div>

        </div>
        <div class="col-lg-6 p-0">
          <div class="card join-card">
            <div class="card-body">
              <h3>Membership in TAPA</h3>
              <p>Become a member of TAPA and be part of a community dedicated to advancing psychology.</p>
              <a href="#membership" class="btn ">Learn More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!--===== News section =====-->
  <div class="container">
    <div class="section-title py-5">
      <h2>TAPA UPDATES</h2>
    </div>

    <!-- <h2 style="text-align: center; color:#0F718A; padding:40px">TAPA updates</h2> -->
    <div id="newsCarousel" class="owl-carousel owl-theme">
      <!-- News Items -->
      <div class="item">
        <div class="news-item">
          <img src="assets/img/tapaImages/slide-1.jpg" alt="News 1">
          <div class="news-details">
            <h4>Workshop on Stress Management</h4>
            <p>Date: December 10, 2023</p>
            <p>The Tanzanian Psychological Association conducted a successful workshop focused on stress management techniques for professionals and the general public.</p>
            <a href="post_description.php" class="btn ">Read More</a>
          </div>
        </div>
      </div>
      <!-- Add more news items -->
      <!-- News Items -->
      <div class="item">
        <div class="news-item">
          <img src="assets/img/tapaImages/slide-2.jpg" alt="News 2">
          <div class="news-details">
            <h4>Webinar on Mental Health Awareness</h4>
            <p>Date: November 25, 2023</p>
            <p>Join our upcoming webinar on mental health awareness where experts will discuss the importance of mental well-being in today's society.</p>
            <a href="post_description.php" class="btn ">Read More</a>
          </div>
        </div>
      </div>
      <!-- Add more news items -->
      <!-- News Items -->
      <div class="item">
        <div class="news-item">
          <img src="assets/img/tapaImages/slide-3.jpg" alt="News 3">
          <div class="news-details">
            <h4>Research Conference 2023</h4>
            <p>Date: October 15, 2023</p>
            <p>Our annual research conference showcased the latest advancements and studies in the field of psychology. Participants had insightful discussions on various topics.</p>
            <a href="post_description.php" class="btn ">Read More</a>
          </div>
        </div>
      </div>
      <!-- Add more news items -->
      <!-- News Items -->
      <div class="item">
        <div class="news-item">
          <img src="assets/img/tapaImages/Sustain Digital-2.jpg" alt="News 4">
          <div class="news-details">
            <h4>New Therapeutic Approaches</h4>
            <p>Date: September 28, 2023</p>
            <p>Discover the innovative therapeutic approaches introduced by the Psychological Association to aid individuals in their mental health journey.</p>
            <a href="post_description.php" class="btn ">Read More</a>
          </div>
        </div>
      </div>
      <!-- Add more news items -->
      <!-- News Items -->
      <div class="item">
        <div class="news-item">
          <img src="assets/img/tapaImages/Sustain Digital-3.jpg" alt="News 5">
          <div class="news-details">
            <h4>Understanding Emotional Intelligence</h4>
            <p>Date: August 14, 2023</p>
            <p>Learn about emotional intelligence and its impact on mental well-being in our upcoming workshop.</p>
            <a href="post_description.php" class="btn ">Read More</a>
          </div>
        </div>
      </div>
      <!-- Add more news items -->
      <!-- News Items -->
      <div class="item">
        <div class="news-item">
          <img src="assets/img/tapaImages/Sustain Digital-7.jpg" alt="News 6">
          <div class="news-details">
            <h4>Mental Health Awareness Month</h4>
            <p>Date: July 3, 2023</p>
            <p>Join us in observing Mental Health Awareness Month and explore the various activities lined up to promote mental health.</p>
            <a href="post_description.php" class="btn ">Read More</a>
          </div>
        </div>
      </div>
      <!-- Add more news items -->
    </div>
  </div>
  <!-- end of news -->
  <!--====== End of news section =====-->


  <!-- <section id="about-us" class="about-us">
  <div class="container" data-aos="fade-up">

    <div class="row content">
      <div class="col-lg-6" data-aos="fade-right">
        <img src="assets/img/carousel-images/3918491-removebg-preview.png" alt="Tanzanian Psychological Association" width="500px">
      </div>
      <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
        <h2 class="mb-4" style="color: #0F718A;">Tanzanian Psychological Association</h2>

        <p class="mb-3">
          The Tanzanian Psychological Association is dedicated to representing psychologists and professionals in the field within Tanzania. Our primary objectives are to promote psychology, advance the professional development of psychologists, and advocate for mental health and well-being in the country.
        </p>
        <p class="mb-3">
          We strive to achieve these goals through initiatives such as:
        </p>
        <ul class="mb-4">
          <li><i class="ri-check-double-line"></i> Professional development opportunities</li>
          <li><i class="ri-check-double-line"></i> Advocacy for mental health</li>
          <li><i class="ri-check-double-line"></i> Continuing education programs</li>
        </ul>
        <p>
          At the Tanzanian Psychological Association, we are committed to fostering a community of professionals dedicated to improving mental health and psychological understanding within our society.
        </p>
      </div>
    </div>

  </div>
</section> -->
  <!-- End About Us Section -->


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


  <section id="faq" class="faq section-bg" style="background:#ccc">
    <div class="container" data-aos="fade-up">
      <div class="section-title">
        <h2>Frequently Asked Questions</h2>
      </div>

      <div class="faq-list">
        <ul>
          <li data-aos="fade-up">
            <i class="bx bx-help-circle icon-help"></i>
            <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">What is psychotherapy/counseling? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
              <p>
                Psychotherapy or counseling is a professional process that helps individuals explore and manage their emotions, thoughts, and behaviors to improve mental well-being.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="100">
            <i class="bx bx-help-circle icon-help"></i>
            <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">How do I know if I need therapy? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
              <p>
                If you're experiencing persistent emotional distress, behavioral issues, or difficulties in daily functioning, it may be time to consider therapy.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="200">
            <i class="bx bx-help-circle icon-help"></i>
            <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">How do I choose the right therapist for me?<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
              <p>
                Choose a therapist based on their expertise, approach, and how comfortable you feel discussing your concerns with them.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="300">
            <i class="bx bx-help-circle icon-help"></i>
            <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">What can I expect in my first therapy session?<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
              <p>
                The first session involves getting to know each other, discussing your reasons for seeking therapy, and understanding the therapeutic process.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="400">
            <i class="bx bx-help-circle icon-help"></i>
            <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">How long does therapy usually take? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
              <p>
                Therapy duration varies depending on your needs and progress, ranging from a few sessions to several months or more.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="500">
            <i class="bx bx-help-circle icon-help"></i>
            <a data-bs-toggle="collapse" data-bs-target="#faq-list-6" class="collapsed">What's the difference between a psychologist and a psychiatrist? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-6" class="collapse" data-bs-parent=".faq-list">
              <p>
                Psychologists provide therapy and counseling, while psychiatrists can prescribe medication in addition to therapy.
              </p>
            </div>
          </li>

        </ul>
      </div>
    </div>
  </section>

  <!-- ======= Our Clients Section ======= -->
   <section id="clients" class="clients">
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
  </section> 
  <!-- End Our Clients Section -->


  <!-- jQuery and Bootstrap Bundle with Popper.js -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
  <!-- Owl Carousel JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script>
    $(document).ready(function() {
      $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        autoplay: true,
        autoplayTimeout: 2000, // Set autoplay interval in milliseconds (2000ms = 2s)
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 2
          },
          1000: {
            items: 3
          }
        }
      });
    });
  </script>
</body>

</html>
<?php include("footer.php") ?>