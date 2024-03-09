<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Contact - TAPA </title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link rel="stylesheet" href="assets/css/style.css">

  <?php include "titleIcon.php" ?>

</head>

<body>

  <?php include "header.php" ?>


  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Contact</h2>
          <ol>
            <li><a href="index.php">Home</a></li>
            <li>Contact</li>
          </ol>
        </div>

      </div>
    </section>
    <!-- End Breadcrumbs -->


     <!-- ======= Contact Section =======  -->
    <section class="contact">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-sm-12">
            <div class="contact-map box">
              <div id="map" class="contact-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.005567122966!2d39.21630767427017!3d-6.769173893227598!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185c4e8c8e62e115%3A0x93230e52ebf04335!2sEtina%20Bar%20%26%20Restaurant!5e0!3m2!1sen!2sus!4v1704719859599!5m2!1sen!2sus" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
            </div>
          </div>
          <div class="row gx-lg-0 gy-4">
            <div class="col-lg-4">
              <div class="info-container d-flex flex-column align-items-center justify-content-center">
                <div class="info-item d-flex">
                  <i class="bi bi-geo-alt flex-shrink-0"></i>
                  <div>
                    <h4>Location:</h4>
                    <p>Esaurp Village, Near Mlimani City <br>Dar es Salaam, Tanzania</p>
                  </div>
                </div>
                <!-- End Info Item -->

                <div class="info-item d-flex">
                  <i class="bi bi-envelope flex-shrink-0"></i>
                  <div>
                    <h4>Email:</h4>
                    <p>info@tapa.or.tz</p>
                  </div>
                </div>
                <!-- End Info Item -->

                <div class="info-item d-flex">
                  <i class="bi bi-phone flex-shrink-0"></i>
                  <div>
                    <h4>Call:</h4>
                    <p>+255 719 911 575</p>
                  </div>
                </div>
                <!-- End Info Item -->

                <div class="info-item d-flex">
                  <i class="bi bi-clock flex-shrink-0"></i>
                  <div>
                    <h4>Open Hours:</h4>
                    <p>Mon-Sat: 08:00AM - 05:00PM</p>
                  </div>
                </div>
                <!-- End Info Item -->
              </div>
            </div>

            <div class="col-lg-8">
              <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                <div class="row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                  </div>
                  <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                </div>
                <div class="form-group mt-3">
                  <textarea class="form-control" name="message" rows="7" placeholder="Message" required></textarea>
                </div>
                <div class="my-3">
                  <div class="loading">Loading</div>
                  <!-- <div class="error-message"></div> -->
                  <!-- <div class="sent-message">Your message has been sent. Thank you!</div> -->
                </div>
                <div class="text-center"><button type="submit">Send Message</button></div>
              </form>
            </div>
            <!-- End Contact Form -->
          </div>
        </div>
    </section>
    <!-- End Contact Section-->
  </main>
  <!-- End #main -->
  <?php include "footer.php" ?>