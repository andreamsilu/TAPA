<?php include("titleIcon.php")?>
<?php include("header.php")?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Member Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            background-image: url('assets/img/login/login-bg2.jpg'); /* Replace with your background image path */
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .login-container {
            width: 90%;
            max-width: 1000px;
            background-color: rgba(255, 255, 255, 0.6); /* Semi-transparent background */
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .sign-in{
            border: solid 2px #0F718A;
            border-radius: 20px;
        }

        .sign-in:hover{
            background-color: #0F718A;
            color: white;
        }
        .a {
            text-decoration: none; /* Remove underlines from links */
        }
        .register-btn{
            border-radius: 20px;
            background-color: #0F718A;
        }
        .register-btn:hover{
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
                <!-- Login Form -->
                <div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                    <div class="login-container">
                        <h1>Welcome back,</h1>
                        <form action="https://www.TAPA.co.tz/auth/postLogin" name="frmLoginUser" id="frmLoginUser" method="post"
                            autocomplete="off">
                            <!-- Your form elements -->
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="username" id="username" class="form-control" placeholder="Email" required />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required />
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="remember" id="remember" value="1" />
                                    <label class="custom-control-label font-weight-normal" for="remember">Keep me logged in</label>
                                </div>
                            </div>
                            <div class="form-action">
                                <input type="submit" class="btn btn-transparent sign-in" value="Sign In">
                                <a href="https://www.TAPA.co.tz/forgot-password" class="login-link float-right gray">Forgot Password?</a>
                            </div>
                            <p class="gray">New to TAPA? <a href="membeship-category.php"
                                    class="gray btn font-blue small-font register-btn ml-sm-2">Register Now</a>
                            </p>
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
