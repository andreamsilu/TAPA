<?php include("titleIcon.php") ?>
<?php include("header.php") ?>

<!-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Member Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Include Bootstrap CSS -->
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">  -->
<style>
    body {
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .login-page {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-image: url('assets/img/login/login-bg2.jpg');
        /* Replace with your background image path */
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .login-container {
        margin: 50px 20px 20px 250px;
        width: 50%;
        /* max-width: 1000px; */
        background-color: rgba(255, 255, 255, 0.6);
        /* Semi-transparent background */
        padding: 50px;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .login-container {}

    .sign-in {
        border: solid 2px #0F718A;
        border-radius: 20px;
    }

    .sign-in:hover {
        background-color: #0F718A;
        color: white;
    }

    .a {
        text-decoration: none;
        /* Remove underlines from links */
    }

    .register-btn {
        border-radius: 20px;
        background-color: #0F718A;
    }

    .register-btn:hover {
        border-radius: 20px;
        color: white;
        background-color: #0F718A;
    }
</style>
</head>

<body>

    <main class="login-page">


        <!-- Login Container -->
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-10">
                    <div class="login-container">
                        <div>
                            <img src="assets/img/tapa/tapa-fam.JPG" class="img-fluid" height="200px" alt="Image">
                        </div>
                        <h1>Welcome back,</h1>
                        <form action="forms/login-script.php" method="post" autocomplete="off">
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required />
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="fas fa-lock"></i> Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required />
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" value="1" />
                                    <label class="custom-control-label font-weight-normal" for="remember">Keep me signed in</label>
                                </div>
                            </div>
                            <div class="form-action">
                                <input type="submit" class="btn btn-transparent sign-in" value="Sign In">
                                <a href="forgot-password.php" class="login-link float-right gray">Forgot Password?</a>
                            </div>
                            <p class="gray">New to TAPA? <a href="membeship-category.php" class="gray btn font-blue small-font register-btn ml-sm-2">Register Now</a></p>
                            <?php if (isset($error)) { ?>
                                <p><?php echo $error; ?></p>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>