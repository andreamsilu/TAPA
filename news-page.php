<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>TAPA-News </title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
  <!-- ======= Header ======= -->
  <!-- <header id="header" class="fixed-top d-flex align-items-center"> -->
  <?php include('header.php') ?>
  <!-- </header> -->
  <!-- End Header -->
  <!-- <main id="main"> -->
  <!-- ======= Blog Section ======= -->
  <section class="hero-section inner-page">
    <!-- <div class="wave">
        <svg width="1920px" height="265px" viewBox="0 0 1920 265" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Apple-TV" transform="translate(0.000000, -402.000000)" fill="#FFFFFF">
              <path d="M0,439.134243 C175.04074,464.89273 327.944386,477.771974 458.710937,477.771974 C654.860765,477.771974 870.645295,442.632362 1205.9828,410.192501 C1429.54114,388.565926 1667.54687,411.092417 1920,477.771974 L1920,667 L1017.15166,667 L0,667 L0,439.134243 Z" id="Path"></path>
            </g>
          </g>
        </svg>
      </div> -->
    <!-- <div class="section-title">
      <h2 class="pt-1">MEMBERSHIP IN TAPA</h2>
    </div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="row justify-content-center">
            <div class="col-md-7 text-center hero-text">
              <h1 data-aos="fade-up" data-aos-delay="">Blog Posts</h1>
              <p class="mb-0" data-aos="fade-up" data-aos-delay="100">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
    <?php //include "./Admin/news/read_news.php" 
    ?>
    <section class="section">
      <div class="section-title">
        <h2 class="pt-1">MEMBERSHIP IN TAPA</h2>
      </div>
      <div class="container">
        <div class="row mb-5">
          <?php
          // Assuming you have established a database connection already
          include('./forms/connection.php');
          // Fetching data from the 'news' table, sorted by date in descending order
          $sql = "SELECT * FROM news ORDER BY date ASC";
          $result = mysqli_query($conn, $sql);

          // Check if there are any records
          if (mysqli_num_rows($result) > 0) {
            // Loop through each row of data
            while ($row = mysqli_fetch_assoc($result)) {
              // Extracting data from the current row
              $date = $row['date'];
              // $author = $row['author'];
              $title = $row['title'];
              $content = substr($row['description'], 0, 100);
              $image = $row['image_url'];
              // Outputting the HTML structure with the fetched data
              echo '<div class="col-md-4">
                    <div class="post-entry">
                        <a href="Admin/news/full_news.php?id=' . $row['id'] . '" class="d-block mb-4">
                            <img src="./Admin/news/' . $image . '" alt="Image" class="img-fluid">
                        </a>
                        <div class="post-text">
                            <span class="post-meta">' . $date . ' &bullet; By <a href="#">Admin</a></span>
                            <h3><a href="Admin/news/full_news.php?id=' . $row['id'] . '">' . $title . '</a></h3>
                            <p>' . $content . '...</p>
                            <p><a href="Admin/news/full_news.php?id=' . $row['id'] . '" class="readmore">Read more</a></p>
                        </div>
                    </div>
                </div>';
            }
          } else {
            echo "No news found!";
          }
          // Close the database connection
          mysqli_close($conn);
          ?>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center">
          <span class="p-3 active text-primary">1</span>
          <a href="#" class="p-3">2</a>
          <a href="#" class="p-3">3</a>
          <a href="#" class="p-3">4</a>
        </div>
      </div>
      </div>
    </section>
    </main><!-- End #main -->
    <!-- ======= Footer ======= -->
    <?php include('footer.php') ?>
    ```