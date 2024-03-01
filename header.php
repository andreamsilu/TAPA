<head> 
<?php include "titleIcon.php"; ?>

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css">

<!-- Header -->
<header id="header" class="fixed-op">
  <div class="container d-flex align-items-right">

    <a href="index.php" class="me-auto m-lg-0">
      <img src="assets/img/tapa.png" alt="" class="img-fluid logo" width="400px" style="margin-right:1px;">
    </a>

    <nav id="navbar" class="navbar order-last order-lg-0">
      <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li class="dropdown">
          <a href="membeship-category.php">
            <span>Membership</span> <i class="bi bi-chevron-down"></i>
          </a>
          <ul>
            <li><a href="login.php">Login</a></li>
            <li><a href="membeship-category.php">Register</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#">
            <span>About</span> <i class="bi bi-chevron-down"></i>
          </a>
          <ul>
            <li><a href="about.php">About Us</a></li>
            <li><a href="commitees.php">Committees</a></li>
            <li><a href="zones.php">Zone & Division</a></li>
          </ul>
        </li>
        <li><a href="publication-resources.php">Publication & Resources</a></li>
        <li><a href="photo-gallery.php">Photo Gallery</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <!-- <i class="bi bi-list mobile-nav-toggle"></i> -->
    </nav>

    <div class="d-flex nav-links">
      <a href="login.php" class="nav-link">Login/</a>
      <a href="membeship-category.php" class="nav-link">Register</a>
    </div>
  </div>
</header>

<!-- Mobile Navigation Script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function () {
    $(".mobile-nav-toggle").click(function () {
      $("#navbar ul").toggleClass("show");
    });
  });
</script>
