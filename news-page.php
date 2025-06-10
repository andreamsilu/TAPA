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
    include('titleIcon.php');
    include('header.php');
    include('forms/connection.php');
  ?>
  <link rel="stylesheet" href="style.css">
 <!-- ======= Breadcrumbs ======= -->
 <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>News</h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>News</li>
                    </ol>
                </div>

            </div>
        </section>
        <!-- End Breadcrumbs -->
  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 text-center mb-5">
          <div class="section-title">
            <h2 class="pt-1">NEWS & UPDATES</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <?php
        // Check if news table exists and get its structure
        $table_check = $conn->query("SHOW TABLES LIKE 'news'");
        
        if ($table_check && $table_check->num_rows > 0) {
            // Check what date columns are available
            $structure_query = "DESCRIBE news";
            $structure_result = $conn->query($structure_query);
            
            $date_column = 'id'; // Default fallback
            $has_status = false;
            
            if ($structure_result) {
                while ($field = $structure_result->fetch_assoc()) {
                    $field_name = $field['Field'];
                    $field_type = strtolower($field['Type']);
                    
                    // Look for date/time columns
                    if (strpos($field_type, 'date') !== false || 
                        strpos($field_type, 'time') !== false ||
                        strpos($field_type, 'timestamp') !== false) {
                        $date_column = $field_name;
                    }
                    
                    // Check if status column exists
                    if ($field_name === 'status') {
                        $has_status = true;
                    }
                }
            }
            
            // Build query based on available columns
            if ($has_status) {
                $query = "SELECT * FROM news WHERE status = 'published' ORDER BY $date_column DESC";
            } else {
                $query = "SELECT * FROM news ORDER BY $date_column DESC";
            }
            
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $image = $row['image_url'] ?? '';
                    
                    // Handle date formatting based on available columns
                    $date = 'Recent';
                    if (isset($row['created_at'])) {
                        $date = date('F j, Y', strtotime($row['created_at']));
                    } elseif (isset($row['date'])) {
                        $date = date('F j, Y', strtotime($row['date']));
                    } elseif (isset($row['timestamp'])) {
                        $date = date('F j, Y', strtotime($row['timestamp']));
                    } elseif (isset($row['id'])) {
                        $date = 'News #' . $row['id'];
                    }
                    
                    echo '<div class="col-md-6 mb-4">
                            <div class="card h-100">
                                ' . (!empty($image) ? '<img src="uploads/news/' . htmlspecialchars($image) . '" alt="News Image" class="img-fluid">' : '') . '
                                <div class="card-body">
                                    <h5 class="card-title">' . htmlspecialchars($row['title'] ?? 'Untitled') . '</h5>
                                    <p class="card-text">' . htmlspecialchars(substr($row['content'] ?? $row['description'] ?? 'No content available', 0, 200)) . '...</p>
                                    <p class="card-text"><small class="text-muted">' . $date . ' &bullet; By <a href="#">TAPA</a></small></p>
                                </div>
                                <div class="card-footer">
                                    <a href="full_news.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm">Read More</a>
                                </div>
                            </div>
                        </div>';
                }
            } else {
                echo '<div class="col-12 text-center">
                        <p>No news available at the moment.</p>
                      </div>';
            }
        } else {
            echo '<div class="col-12 text-center">
                    <p>News system is not available at the moment.</p>
                  </div>';
        }
        ?>
      </div>
    </div>
  </section>

  <?php include('footer.php'); ?>
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>
