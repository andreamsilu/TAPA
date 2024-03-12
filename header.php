<head> 
    <?php include "titleIcon.php"; ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.19.0/font/bootstrap-icons.css">

    <!-- Header -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.php">
                <img src="assets/img/tapa.png" alt="" class="img-fluid logo" width="400px" style="margin-right:1px;">
            </a>

            <!-- Desktop Navigation -->
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul class="desktop-nav">
                    <li><a class="" href="index.php">Home</a></li>
                    <li><a href="about.php">About us</a></li>
                    <li class="dropdown">
                        <a href="membeship-category.php">
                            <span>Membership</span> <i class="bi bi-chevron-down"></i>
                        </a>
                        <ul>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="membeship-category.php">Register</a></li>
                        </ul>
                    </li>
                    <li><a href="publication-resources.php">Publication & Resources</a></li>
                    <li><a href="photo-gallery.php">Photo Gallery</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="membeship-category.php">Register</a></li>
                </ul>
            </nav>

            <!-- Mobile Navigation Toggle -->
            <i class="bi bi-list mobile-nav-toggle"></i>
        </div>
    </header>

    <!-- Mobile Navigation -->
    <nav id="mobile-nav" class="mobile-nav">
        <ul class="nav-list">
            <li><a class="" href="index.php">Home</a></li>
            <li><a href="about.php">About us</a></li>
            <li class="dropdown">
                <a href="membeship-category.php">
                    <span>Membership</span> <i class="bi bi-chevron-down"></i>
                </a>
                <ul>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="membeship-category.php">Register</a></li>
                </ul>
            </li>
            <li><a href="publication-resources.php">Publication & Resources</a></li>
            <li><a href="photo-gallery.php">Photo Gallery</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="membeship-category.php">Register</a></li>
        </ul>
    </nav>

    <!-- Mobile Navigation Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".mobile-nav-toggle").click(function () {
                $("#mobile-nav").toggleClass("show");
            });
        });
    </script>

    <!-- Mobile Navigation CSS -->
    <style>
        /* Hide mobile nav by default */
        #mobile-nav {
            display: none;
        }

        /* Media query to show mobile nav only on small screens */
        @media (max-width: 767px) {
            #mobile-nav {
                display: block;
            }
            .desktop-nav {
                display: none;
            }
        }
    </style>
</head>
