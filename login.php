<?php // include "forms/login-script.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Member Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <?php include "titleIcon.php" ?>
</head>

<body>
    <?php include "header.php" ?>
    <main>
        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Login</h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>Member login</li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- End Breadcrumbs -->
        <div class="container-fluid">
            <div class="row">
                <!-- Left side with image -->
                <div class="col-md-6 d-none d-md-block" style="background-image: url('assets/img/tapa/A2930-History-and-evolution-of-spacial-psychology.jpg'); background-size: cover;"></div>

                <!-- Right side with login form -->
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <div class="login-form">
                        <h2>Welcome back,</h2>
                        <form>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="keepLoggedIn">
                                <label class="form-check-label" for="keepLoggedIn">Keep me logged in</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                            <p><a href="#">Forgot Password?</a></p>
                            <p>New to TAPA? <a href="#">Register</a></p>
                        </form>
                    </div>
                </div>

            </div>
        </div>

    </main>
    <!-- End #main -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>
<?php include "footer.php" ?>