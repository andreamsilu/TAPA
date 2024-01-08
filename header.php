<!-- This part goes in the <head> section of your HTML -->
<?php include "titleIcon.php"; ?>
<style>
  /* Desktop Navigation */
  .navbar {
    padding: 0;
  }

  .navbar ul {
    margin: 0;
    padding: 0;
    display: flex;
    list-style: none;
    align-items: center;
  }

  .navbar li {
    position: relative;
  }

  .navbar a,
  .navbar a:focus {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 0 10px 30px;
    font-family: "Roboto", sans-serif;
    font-size: 16px;
    font-weight: 600;
    color: #111;
    white-space: nowrap;
    text-transform: uppercase;
    transition: 0.3s;
  }

  .navbar a i,
  .navbar a:focus i {
    font-size: 12px;
    line-height: 0;
    margin-left: 5px;
  }

  .navbar a:hover,
  .navbar .active,
  .navbar .active:focus,
  .navbar li:hover>a {
    color: #0F718A;
  }

  .navbar .dropdown ul {
    display: block;
    position: absolute;
    left: 14px;
    top: calc(100% + 30px);
    margin: 0;
    padding: 10px 0;
    z-index: 99;
    opacity: 0;
    visibility: hidden;
    background: rgb(204, 204, 200);
    box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
    transition: 0.3s;
    border-top: 2px solid #0F718A;
  }

  .navbar .dropdown ul li {
    min-width: 200px;
  }

  .navbar .dropdown ul a {
    padding: 10px 20px;
    font-size: 16px;
    font-weight: 500;
    text-transform: none;
    color: #111;
  }

  .navbar .dropdown ul a i {
    font-size: 12px;
  }

  .navbar .dropdown ul a:hover,
  .navbar .dropdown ul .active:hover,
  .navbar .dropdown ul li:hover>a {
    color: #0F718A;
  }

  .navbar .dropdown:hover>ul {
    opacity: 1;
    top: 100%;
    visibility: visible;
  }

  .navbar .dropdown .dropdown ul {
    top: 0;
    left: calc(100% - 30px);
    visibility: hidden;
  }

  .navbar .dropdown .dropdown:hover>ul {
    opacity: 1;
    top: 0;
    left: 100%;
    visibility: visible;
  }

  /* Additional Styles for Navigation Links */
  .nav-links {
    align-self: flex-end;
    display: flex;
    text-align: center;
    padding: 1px;
    margin-left: 50px;
    font-size: 24px;
    border-radius: 10px;
    border: #0F718A solid 2px;
  }

  .nav-links:hover {
    background-color: #0F718A;
    color: #fff;
  }

  .nav-link {
    display: inline-block;
    text-decoration: none;
    color: #333;
    font-weight: 400;
    padding: 4px 6px;
    /* Adjust padding as needed */
    margin-right: 1px;
    /* Added spacing between links */
  }

  .nav-link:hover {
    border-radius: 30px;
    color: #fff;
  }
</style>

<!-- This part goes in the body of your HTML -->
<header id="header" class="fixd-top">
  <div class="container d-flex align-items-center">
    <!-- Image Logo -->
    <a href="index.php" class=" me-auto m-lg-0"><img src="assets/img/tapa.png" alt="" class="imgfluid" width="100px"></a>

    <!-- Main Navigation -->
    <nav id="navbar" class="navbar order-last order-lg-0">
      <ul>
        <li><a href="index.php" class="">Home</a></li>
        <li class="dropdown">
          <a href="membeship-category.php"><span>Membership</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="login.php">Login</a></li>
            <li><a href="registration.php">Register</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#"><span>About</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="about.php">About Us</a></li>
            <li><a href="leadership.php">Leadership</a></li>
            <li><a href="commitees.php">Committees</a></li>
            <li><a href="zones.php">Zone & Division</a></li>
          </ul>
        </li>
        <li><a href="publication-resources.php">Publication & Resources</a></li>
        <li><a href="photo-gallery.php">Photo Gallery</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
    <!-- End Main Navigation -->

    <!-- Additional Navigation Links -->
    <div class="d-flex nav-links">
      <a href="login.php" class="nav-link">Login/</a>
      <a href="membeship-category.php" class="nav-link">Registration</a>
    </div>
  </div>
</header>
<!-- End Header -->