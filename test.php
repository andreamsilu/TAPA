<!DOCTYPE html> html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TAPA - Homepage</title>
  <meta content="" name="description">
  <meta content="" name="keywords">


  <?php include "titleIcon.php" ?>
</head>
<style>
  /* General styles */
  body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  /* Hero section styles */
  .hero {
    background-color: #f0f0f0;
    padding: 100px 0;
    text-align: center;
  }

  .hero h1 {
    font-size: 3em;
    color: #333;
  }

  .hero p {
    font-size: 1.5em;
    color: #666;
  }

  /* News section styles */
  .owl-carousel .owl-item {
    margin: 0 10px;
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

  .btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
    font-size: 0.9em;
  }

  .btn-primary:hover {
    background-color: #0056b3;
    color: #fff;
  }
</style>

<body>
  <?php include "header.php" ?>
  <?php //include "hero.php" ?>

  <main id="main">
    <!-- news section -->
    <!-- Hero section -->
    <div class="hero">
      <div class="container">
        <h1>Welcome to Psychological Association</h1>
        <p>Where we explore the depths of the human mind.</p>
        
      </div>
    </div>

    <!-- News section -->
    <div class="container">
      <h2>Psychological Association News</h2>
      <div id="newsCarousel" class="owl-carousel owl-theme">
        <!-- News Items -->
        <div class="item">
          <div class="news-item">
            <img src="assets/img/tapaImages/slide-1.jpg" alt="News 1">
            <div class="news-details">
              <h4>Workshop on Stress Management</h4>
              <p>Date: December 10, 2023</p>
              <p>The Tanzanian Psychological Association conducted a successful workshop focused on stress management techniques for professionals and the general public.</p>
              <a href="#" class="btn btn-primary">Read More</a>
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
              <a href="#" class="btn btn-primary">Read More</a>
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
              <a href="#" class="btn btn-primary">Read More</a>
            </div>
          </div>
        </div>
        <!-- Add more news items -->
        <!-- News Items -->
        <div class="item">
          <div class="news-item">
            <img src="assets/img/tapaImages/slide-4.jpg" alt="News 4">
            <div class="news-details">
              <h4>New Therapeutic Approaches</h4>
              <p>Date: September 28, 2023</p>
              <p>Discover the innovative therapeutic approaches introduced by the Psychological Association to aid individuals in their mental health journey.</p>
              <a href="#" class="btn btn-primary">Read More</a>
            </div>
          </div>
        </div>
        <!-- Add more news items -->
        <!-- News Items -->
        <div class="item">
          <div class="news-item">
            <img src="assets/img/tapaImages/slide-5.jpg" alt="News 5">
            <div class="news-details">
              <h4>Understanding Emotional Intelligence</h4>
              <p>Date: August 14, 2023</p>
              <p>Learn about emotional intelligence and its impact on mental well-being in our upcoming workshop.</p>
              <a href="#" class="btn btn-primary">Read More</a>
            </div>
          </div>
        </div>
        <!-- Add more news items -->
        <!-- News Items -->
        <div class="item">
          <div class="news-item">
            <img src="assets/img/tapaImages/slide-6.jpg" alt="News 6">
            <div class="news-details">
              <h4>Mental Health Awareness Month</h4>
              <p>Date: July 3, 2023</p>
              <p>Join us in observing Mental Health Awareness Month and explore the various activities lined up to promote mental health.</p>
              <a href="#" class="btn btn-primary">Read More</a>
            </div>
          </div>
        </div>
        <!-- Add more news items -->
      </div>
    </div>



    <!--====== End of news section =====-->

    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
      <div class="container" data-aos="fade-up">

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-right">
            
            <img src="assets/img/carousel-images/3918491-removebg-preview.png" alt="" width="500px">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
            <h4 style="color: #0F718A;">TANZANIAN PSYCHOLOGICAL ASSOCIATION</h4>

            <p>
              Tanzanian Psychological Association is an organization that represents psychologists and professionals in the field of psychology in Tanzanian. Its primary objectives typically include promoting the field of psychology, advancing the professional development of psychologists, and advocating for mental health and psychological well-being in the country.
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i>Proffessional development</li>
              <li><i class="ri-check-double-line"></i> Advocacy</li>
              <li><i class="ri-check-double-line"></i> Continuing educationn</li>
            </ul>
            
          </div>
        </div>

      </div>
    </section>
    <!-- End About Us Section -->

    <section id="services" class="services section-bg">
  <div class="container" data-aos="fade-up">
    <h2 class="section-title">TAPA SERVICES AND ACTIVITIES</h2>

    <div class="row">
      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
        <div class="icon-box">
          <img src="assets/img/service-img/progress.png" alt="" class="service-icon">
          <h4><a href="#">Professional Development</a></h4>
          <p>The association supports the professional growth of psychologists and related professionals through training, workshops, and conferences.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
        <div class="icon-box">
          <img src="assets/img/service-img/advocay4.png" alt="" class="service-icon">
          <h4><a href="#">Advocacy</a></h4>
          <p>Advocating for mental health awareness, access to services, and policies supporting psychological research and practice.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
        <div class="icon-box">
          <img src="assets/img/service-img/integrity.png" alt="" class="service-icon">
          <h4><a href="#">Ethics and Standards</a></h4>
          <p>Establishing and upholding ethical guidelines, providing resources, and supporting adherence to ethical principles.</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
        <div class="icon-box">
          <img src="assets/img/service-img/teacher.png" alt="" class="service-icon">
          <h4><a href="#">Continuing Education</a></h4>
          <p>Offering opportunities for continuous education and professional development to stay updated with field developments.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
        <div class="icon-box">
          <img src="assets/img/service-img/research.png" alt="" class="service-icon">
          <h4><a href="#">Research and Education</a></h4>
          <p>Promoting research, supporting educational initiatives, and facilitating knowledge-sharing among members.</p>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
        <div class="icon-box">
          <img src="assets/img/service-img/community.png" alt="" class="service-icon">
          <h4><a href="#">Community Outreach and Networking</a></h4>
          <p>Building a supportive network of professionals and promoting mental health awareness in communities.</p>
        </div>
      </div>
    </div>
  </div>
</section>


    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">What is psychotherapy/counseling? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
                <p>
                  Psychotherapy or counseling is a professional process that helps individuals explore and manage their emotions, thoughts, and behaviors to improve mental well-being. </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="100">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">How do I know if I need therapy? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                <p>
                  If you're experiencing persistent emotional distress, behavioral issues, or difficulties in daily functioning, it may be time to consider therapy. </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">How do I choose the right therapist for me?<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Choose a therapist based on their expertise, approach, and how comfortable you feel discussing your concerns with them. </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">What can I expect in my first therapy session?<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                <p>
                  The first session involves getting to know each other, discussing your reasons for seeking therapy, and understanding the therapeutic process. </p>
                </p>
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">How long does therapy usually take? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Therapy duration varies depending on your needs and progress, ranging from a few sessions to several months or more.
              </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
              <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">What's the difference between a psychologist and a psychiatrist? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                <p>
                  Psychologists provide therapy and counseling, while psychiatrists can prescribe medication in addition to therapy
            </li>

          </ul>
        </div>

      </div>
    </section>
    <!-- End Frequently Asked Questions Section -->

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

  </main>
  <!-- End #main -->
  <script>
    $(document).ready(function() {
      $("#newsCarousel").owlCarousel({
        items: 3, // Show three items at a time
        loop: true,
        margin: 30,
        autoplay: true,
        autoplayTimeout: 3000, // 3 seconds autoplay interval
        autoplayHoverPause: true,
        responsive: {
          0: {
            items: 1
          },
          768: {
            items: 2
          },
          992: {
            items: 3
          }
        }
      });
    });
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

  <?php include "footer.php" ?>

  
