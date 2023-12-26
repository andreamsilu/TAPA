<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hero Section with Carousel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    #hero {
      position: relative;
      overflow: hidden;
    }

    #heroCarousel .carousel-item {
      height: 100vh;
      background-size: cover;
      background-position: center;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .carousel-content {
      max-width: 7000px;
      margin: 0 auto;
      text-align: center;
      color: #fff;
      padding: 60px;
      border-radius: 10% 10% 50% 50% / 0 0 0 0;
      background: linear-gradient(45deg, #0F718A, #095d72);
    }

    .carousel-content h2 {
      font-size: 36px;
      font-weight: bold;
    }

    .carousel-content h3 {
      font-size: 28px;
      font-weight: bold;
    }

    .carousel-content p {
      font-size: 20px;
      line-height: 1.6;
    }

    .btn-get-started {
      display: inline-block;
      padding: 12px 24px;
      margin-top: 30px;
      font-size: 18px;
      font-weight: bold;
      color: #fff;
      background-color: #0F718A;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .btn-get-started:hover {
      background-color: #095d72;
    }

    /* Remove underline on links */
    a {
      text-decoration: none;
    }

    /* Remove underline on links only on hover */
    a:hover {
      text-decoration: none;
    }
  </style>
</head>

<body>

  <section id="hero">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <div class="carousel-inner" role="listbox">

              <!-- Slide 1 -->
              <div class="carousel-item active" style="background-image: url('assets/img/carousel-images/paper-brain-with-light-bulb.jpg');">
                <div class="carousel-content animate__animated animate__fadeInUp">
                  <h2><span>Latest updates</span></h2>
                  <h3>TAPA Launches Student Mentorship Program</h3>
                  <p>TAPA introduces a mentorship program to support the next generation of psychologists and promote excellence in the field.</p>
                  <div class="text-center"><a href="about.php" class="btn-get-started">Read More</a></div>
                </div>
              </div>

              <!-- Slide 2 -->
              <div class="carousel-item" style="background-image: url('assets/img/carousel-images/family-therapy.avif');">
                <div class="carousel-content animate__animated animate__fadeInUp">
                  <h2>Latest updates</h2>
                  <h3>TAPA Partners with NGOs to Support Trauma Survivors:</h3>
                  <p>TAPA collaborates with local non-governmental organizations to provide counseling and support services to individuals affected by trauma and disasters.</p>
                  <div class="text-center"><a href="/about.php" class="btn-get-started">Read More</a></div>
                </div>
              </div>

              <!-- Slide 3 -->
              <div class="carousel-item" style="background-image: url('assets/img/carousel-images/human-brain-with-many-flowers.jpg');">
                <div class="carousel-content animate__animated animate__fadeInUp">
                  <h2>Upcoming Events</h2>
                  <h3>Marks World Mental Health Day with Awareness Campaign</h3>
                  <p>TAPA joins the global community in raising awareness about mental health on World Mental Health Day through educational events and initiatives.</p>
                  <div class="text-center"><a href="/about.php" class="btn-get-started">Read More</a></div>
                </div>
              </div>

              <!-- Add more slides as needed -->

            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts.js"></script>
</body>

</html>