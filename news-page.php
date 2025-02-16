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
  <?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include('header.php');
  ?>

  <section class="section">
    <div class="section-title">
      <h2 class="pt-1"> TAPA NEWS AND TOPICS</h2>
    </div>
    <div class="container">
      <div class="row mb-5">
        <?php
        include 'adminpanel/db.php'; 
        $sql = "SELECT * FROM news WHERE status ='1' ORDER BY date DESC";
        $stmt = $conn->prepare($sql);  // Use prepare statement for PDO
        $stmt->execute();  // Execute the query

        // Check if there are any rows returned
        if ($stmt->rowCount() > 0) {
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $date = $row['date'];
            $title = $row['title'];
            $content = substr($row['description'], 0, 100);
            $image = $row['image_url'];
            echo '<div class="col-md-4">
                    <div class="post-entry">
                        <a href="Admin/news/full_news.php?id=' . $row['id'] . '" class="d-block mb-4">
                            <img src="adminpanel/' . $image . '" alt="Image" class="img-fluid">
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

        $stmt = null;  // Close the statement
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
  </section>

  <?php include('footer.php'); ?>

</body>

</html>
