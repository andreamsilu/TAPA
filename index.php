<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TAPA - Home</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Owl Carousel CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <?php include("titleIcon.php"); ?>
  <meta name="description" content="Welcome to the Tanzanian Psychological Association (TAPA)! We are a professional organization dedicated to promoting psychology, mental health, and well-being in Tanzania. Our mission is to provide support and resources for psychologists, therapists, counselors, and mental health professionals. Explore our educational programs, workshops, and networking opportunities in various areas of psychology including clinical psychology, counseling, therapy, and more. Join TAPA to stay updated on the latest developments in the field, connect with peers, and contribute to the advancement of mental health awareness and advocacy in Tanzania.">
  <meta name="keywords" content="Tanzanian Psychological Association, TAPA, psychology, mental health, Tanzania, African psychology, therapy, counseling, psychotherapy, psychiatrist, psychologist, counselor, mental illness, mental well-being, emotional health, behavioral health, social psychology, clinical psychology, developmental psychology, educational psychology, industrial psychology, organizational psychology, counseling psychology, psychoanalysis, cognitive psychology, neuropsychology, positive psychology, community psychology, forensic psychology, child psychology, adolescent psychology, adult psychology, geriatric psychology, trauma, stress, anxiety, depression, OCD, PTSD, bipolar disorder, schizophrenia, personality disorders, addiction, substance abuse, family therapy, marriage counseling, group therapy, self-help, wellness, resilience, coping strategies, psychoeducation, mental health awareness, mental health advocacy, stigma, discrimination">
</head>


<?php
include "header.php";
?>

<body>
  <?php
  include "hero.php";
  ?>
  <div class="section-title">
    <h2 class="pt-5">UPDATES</h2>
  </div>
  <?php include "./Admin/news/read_news.php" ?>

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
            <h4>Professional Development</h4>
            <p>The association supports the professional growth of psychologists and related professionals through training, workshops, and conferences.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
          <div class="service-box">
            <img src="assets/img/service-img/advocay4.png" alt="" class="service-image">
            <h4>Advocacy</h4>
            <p>Advocating for mental health awareness, access to services, and policies supporting psychological research and practice.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
          <div class="service-box">
            <img src="assets/img/service-img/integrity.png" alt="" class="service-image">
            <h4>Ethics and Standards</h4>
            <p>Establishing and upholding ethical guidelines, providing resources, and supporting adherence to ethical principles.</p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
          <div class="service-box">
            <img src="assets/img/service-img/teacher.png" alt="" class="service-image">
            <h4>Continuing Education</h4>
            <p>Offering opportunities for continuous education and professional development to stay updated with field developments.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
          <div class="service-box">
            <img src="assets/img/service-img/research.png" alt="" class="service-image">
            <h4>Research and Education</h4>
            <p>Promoting research, supporting educational initiatives, and facilitating knowledge-sharing among members.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
          <div class="service-box">
            <img src="assets/img/service-img/community.png" alt="" class="service-image">
            <h4>Community Outreach and Networking</h4>
            <p>Building a supportive network of professionals and promoting mental health awareness in communities.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Services Section -->

  <?php include "division.php" ?>


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
                  1.Who and how can one join TAPA?
                </button>
              </h2>
              <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                <div class="accordion-body">
                  TAPA Membership is open to all Tanzanian citizens and non-Tanzanian citizens who are practitioners of Psychology or have an interest in the field of Psychology. We have different categories of membership. Visit <a href="membeship-category.php">here</a>
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-2">
                  2.What will I benefit from being a member of TAPA? </button>
              </h2>
              <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                <div class="accordion-body">
                  The benefits of becoming a member of TAPA include but are not limited to capacity building, mentorship, and supervision of members, members endorsement, participating in community outreaches for awareness and sensitization on mental health and psychological issues, and advocating for policies and laws reformation to support and promote psychological training and services in Tanzania.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-3">
                  3.Does TAPA have an office that provides counseling services?
                </button>
              </h2>
              <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                <div class="accordion-body">
                  TAPA as an association has no office offering counseling or psychological services. Our members are found in institutions where they offer services and some provide services as private practitioners. If you need counseling or psychological services, we advise you to consult private practitioners or organizations offering psychological services.
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
                  4.How can I get a practicing license if I want to practice as a psychologist in Tanzania? </button>
              </h2>
              <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                <div class="accordion-body">
                  Licensing practitioners is the responsibility of the government. Currently, the government of Tanzania has no act guiding psychology practices. If you want to practice in Tanzania, we advise you to get a work permit (if you are a foreign citizen) and register your business with the local authorities. Another option is to practice under an organization with legal local registration.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-2">
                  5.Do psychologists know what people are thinking by just looking at them?
                </button>
              </h2>
              <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                <div class="accordion-body">
                  Psychologists study behavior, which is an interaction of cognitive and affective states. They use various methods to study people’s behaviors and are skilled in reading non-verbal cues. They come to understand what people are experiencing by doing a thorough assessment through interviews, observation, and psychological tests. They can not know what people are thinking by simply looking at them.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2-content-3">
                  6.Does TAPA provide internship opportunities for students?
                </button>
              </h2>
              <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                <div class="accordion-body">
                  If you are looking for an internship opportunity, we advise you to look for an organization offering psychological services. TAPA has no office providing psychological services. Our principal objective is to support psychological training and services in Tanzania. TAPA implements various community outreach programs in which you can participate as a member or seasoned volunteer.
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