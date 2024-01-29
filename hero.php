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

  <!-- ======= Hero Section ======= -->
<section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(assets/img/tapaImages/slide-1.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animated fadeInDown">Build spaces and empower <span>young people with skills development</span></h2>
              <p class="animated fadeInUp">We work closely with communities, providing self-employment and life skills training through mentorship, leadership programs, research, nature expeditions, photography explorations, advocacy, and community outreach programs</p>
              <a href="#about" class="btn-get-started animated fadeInUp scrollto">Read More</a>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(assets/img/tapaImages/slide-2.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animated fadeInDown">We use different methodologies with different partners to achieve our goals</h2>
              <p class="animated fadeInUp">Our hard-working young people use innovative ways to help communities value their environment, Human rights and recognize the value of the ecosystem around them.</p>
              <a href="#about" class="btn-get-started animated fadeInUp scrollto">Read More</a>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(assets/img/tapaImages/slide-3.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animated fadeInDown">Loving relationships should permeate every aspect of organizational life.</h2>
              <p class="animated fadeInUp">Equipping the youth with the knowledge and skills, and competence to act and drive sustainable change.</p>
              <a href="#about" class="btn-get-started animated fadeInUp scrollto">Read More</a>
            </div>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>
      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero --> 

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="scripts.js"></script>
</body>

</html>