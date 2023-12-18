<!-- ======= Header ======= -->
<header id="header" class="fixe-top">
  <div class="container d-flex align-items-right">
    <!-- Uncomment below if you prefer to use an image logo -->
    <a href="index.php" class="logo me-auto me-lg-0"><img src="assets/img/tapa.png" alt="" class="img-fluid"></a>

    <nav id="navbar" class="navbar order-last order-lg-0">
      <ul>
        <li><a href="index.php" class="active">Home</a></li>
        <li class="dropdown">
          <a href="membeship-category.php"><span>Membership</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="login.php">Login</a></li>
            <li><a href="registration.php">Register</a></li>
            <li><a href="membership.php">Search Practitioner</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#"><span>About</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="about.php">About Us</a></li>
            <li><a href="leadership.php">Leadership</a></li>
            <li><a href="commitees.php">Commitees</a></li>
            <li><a href="zones.php">Zone & Division</a></li>
          </ul>
        </li>
        <li><a href="publication-resources.php">Publication & resources</a></li>
        <li><a href="photo-gallery.php">Photo gallery</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
    <!-- .navbar -->

    <div class="d-flex nav-links">
      <a href="login.php" class="nav-link">Login/</a>
      <a href="membeship-category.php" class="nav-link">Registration</a>
    </div>
  </div>
</header>
<!-- End Header -->

<style>
  .nav-links {
    align-self: end;
    display: flex;
    text-align: center;
    padding: 4px;
    margin-left: 0px;
    font-size: 24px;
    border-radius: 30px;
    border: #0F718A solid 2px;
    /* background-color: #0F718A; */
  }


  .nav-links:hover{
    background-color: #0F718A;
    color: #fff;
  }

  .nav-link {
    display: inline-block;
    /* margin-right: 5px; */
    text-decoration: none;
    color: #333;
    font-weight: 400;
    padding: px;
  }

  .nav-link:hover {
    border-radius: 30px;
    color: #fff;
    transform: none;
    transition-property: all;
  }
</style>
