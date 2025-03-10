<head>
    <?php include "titleIcon.php"; ?>

    <style>
    /*--------------------------------------------------------------
# Top Bar
--------------------------------------------------------------*/
    #topbar {
        background: #0F718A;
        color: #fff;
        height: 40px;
        font-size: 16px;
        font-weight: 600;
        z-index: 996;
        transition: all 0.5s;
    }

    #topbar.topbar-scrolled {
        top: -40px;
    }

    #topbar i {
        padding-right: 6px;
        line-height: 0;
    }

    /*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/
    #header {
        background: rgb(255, 255, 255, 0.7);
        transition: all 0.5s;
        z-index: 997;
        padding: 20px 0;
        top: 40px;
        box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 992px) {
        #header {
            padding: 15px 0;
        }
    }

    #header.header-scrolled {
        top: 0;
    }

    #header .logo {
        font-size: 28px;
        margin: 0;
        padding: 0;
        line-height: 1;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    #header .logo a {
        color: #555555;
    }

    #header .logo img {
        max-height: 80px;
        width: 150px;
    }

    /**
* Appointment Button
*/
    .appointment-btn {
        margin-left: 25px;
        background: #0F718A;
        color: #fff;
        border-radius: 4px;
        padding: 8px 25px;
        white-space: nowrap;
        transition: 0.3s;
        font-size: 14px;
        display: inline-block;
    }

    .appointment-btn:hover {
        background: #3fbbc0;
        color: #fff;
    }

    @media (max-width: 768px) {
        .appointment-btn {
            margin: 0 15px 0 0;
            padding: 6px 15px;
        }
    }

    /*--------------------------------------------------------------
# Navigation Menu
--------------------------------------------------------------*/
    /**
* Desktop Navigation 
*/
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
        color: #626262;
        white-space: nowrap;
        transition: 0.3s;
        text-transform: uppercase;
        font-weight: 500;
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
        background: #fff;
        box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
        transition: 0.3s;
        border-radius: 4px;
    }

    .navbar .dropdown ul li {
        min-width: 200px;
    }

    .navbar .dropdown ul a {
        padding: 10px 20px;
        text-transform: none;
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

    @media (max-width: 1366px) {
        .navbar .dropdown .dropdown ul {
            left: -90%;
        }

        .navbar .dropdown .dropdown:hover>ul {
            left: -100%;
        }
    }

    /**
* Mobile Navigation 
*/
    .mobile-nav-toggle {
        color: #555555;
        font-size: 28px;
        cursor: pointer;
        display: none;
        line-height: 0;
        transition: 0.5s;
    }

    .mobile-nav-toggle.bi-x {
        color: #fff;
    }

    @media (max-width: 991px) {
        .mobile-nav-toggle {
            display: block;
        }

        .navbar ul {
            display: none;
        }
    }

    .navbar-mobile {
        position: fixed;
        overflow: hidden;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        background: rgba(60, 60, 60, 0.9);
        transition: 0.3s;
        z-index: 999;
    }

    .navbar-mobile .mobile-nav-toggle {
        position: absolute;
        top: 15px;
        right: 15px;
    }

    .navbar-mobile ul {
        display: block;
        position: absolute;
        top: 55px;
        right: 15px;
        bottom: 15px;
        left: 15px;
        padding: 10px 0;
        border-radius: 8px;
        background-color: #fff;
        overflow-y: auto;
        transition: 0.3s;
    }

    .navbar-mobile a,
    .navbar-mobile a:focus {
        padding: 10px 20px;
        font-size: 15px;
        color: #555555;
    }

    .navbar-mobile a:hover,
    .navbar-mobile .active,
    .navbar-mobile li:hover>a {
        color: #3fbbc0;
    }

    .navbar-mobile .dropdown ul {
        position: static;
        display: none;
        margin: 10px 20px;
        padding: 10px 0;
        z-index: 99;
        opacity: 1;
        visibility: visible;
        background: #fff;
        box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
    }

    .navbar-mobile .dropdown ul li {
        min-width: 200px;
    }

    .navbar-mobile .dropdown ul a {
        padding: 10px 20px;
    }

    .navbar-mobile .dropdown ul a i {
        font-size: 12px;
    }

    .navbar-mobile .dropdown ul a:hover,
    .navbar-mobile .dropdown ul .active:hover,
    .navbar-mobile .dropdown ul li:hover>a {
        color: #3fbbc0;
    }

    .navbar-mobile .dropdown>.dropdown-active {
        display: block;
    }
    </style>
    <!-- ======= Top Bar ======= -->
    <div id="topbar" class="d-flex align-items-center fixed-top">
        <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
            <div class="align-items-center d-none d-md-flex">
                <i class="bi bi-clock"></i> Monday - Friday, 8AM to 4PM  (BY APPOINTMENT) 
            </div>
            <div class="d-flex align-items-center">
                <img src="assets/img/conference-poster/whatsap.png" alt="WhatsApp Icon"
                    style="width: 24px; height: 24px; margin-right: 5px;">
                <!-- Replace whatsapp_icon.png with the actual path to your WhatsApp icon -->
                <span> +255 679 256 256</span>
            </div>

        </div>
    </div>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <a href="index.php" class="logo me-auto"><img src="assets/img/tapa.png" alt=""></a>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <h1 class="logo me-auto"><a href="index.html">Medicio</a></h1> -->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto " href="index.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="about.php">About</a></li>
                    <li class="dropdown"><a href="membeship-category.php"><span>Membership</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="registration.php">Register</a></li>
                            <li><a href="login.php">Sign In</a></li>
                            <li><a href="pay_annual_fees.php">Pay Annual fees</a></li>

                        </ul>
                    </li>
                    <li><a class="nav-link scrollto" href="publication-resources.php">Publications</a></li>
                    <li><a class="nav-link scrollto" href="photo-gallery.php">Photo Gallery</a></li>
                    <li><a class="nav-link scrollto" href="news-page.php">News&Topics</a></li>
                    <li><a class="nav-link scrollto" href="contact.php">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <a href="login.php" class="appointment-btn scrollto"><span class="d-none d-md-inline"></span>Sign In</a>

        </div>
    </header>
    <!-- End Header -->
</head>

<body>
    <main id="main">

        <script>
        /**
         * Mobile nav toggle
         */
        on('click', '.mobile-nav-toggle', function(e) {
            select('#navbar').classList.toggle('navbar-mobile')
            this.classList.toggle('bi-list')
            this.classList.toggle('bi-x')
        })

        /**
         * Mobile nav dropdowns activate
         */
        on('click', '.navbar .dropdown > a', function(e) {
            if (select('#navbar').classList.contains('navbar-mobile')) {
                e.preventDefault()
                this.nextElementSibling.classList.toggle('dropdown-active')
            }
        }, true)
        </script>