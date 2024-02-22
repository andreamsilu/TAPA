

<?php include "titleIcon.php" ?>

</head>

<body>
    <?php include "header.php" ?>
    <style>
                        .logo-container {
                            position: relative;
                            width: 100%;
                            height: 120px;
                            /* Adjust the height as needed */
                            overflow: hidden;
                            border: #0F718A 2px dashed;
                        }

                        .logo-container img {
                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            max-width: 70%;
                            max-height: 100%;
                        }

                        i {
                            color: #0F718A;
                            font-size: 20px;
                        }

                        .btn-primary{
                            background-color: #0F718A;
                            color: white;
                        }

                        .btn-primary i{
                            /* background-color: #0F718A; */
                            color: white;
                        }
                    </style>    

    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Login</h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>Login</li>
                    </ol>
                </div>

            </div>
        </section>
        <!-- End Breadcrumbs -->


        <!-- ======= login======= -->
        <section id="publication" class="publication">
            <div class="container" data-aos="fade-up">
                <div class="row g-0" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-xl-6 img-bg" style="background-image: url('assets/img/tapa/tapa-fam.JPG');background-color:white;opacity:0.6;">
                  
                </div>
                    <div class="col-xl-6 slides position-relative">


                        <!-- Login Card -->
                        <div class="card shadow p-4">
                            <div class="card-body p-5">
                                <div class="logo-container text-center mb-4">
                                    <img src="assets/img/tapa.png" class="img-fluid rounded-pill" alt="Logo">
                                </div>
                                <h5 class="card-title text-center">Login</h5>
                                <!-- Login Form -->
                                <form action="forms/login-script.php"  method="post">
                                    <div class="form-group">
                                        <label for="Email"> <i class="bi bi-envelope"></i> Email:</label>
                                        <input type="text" id="Email" name="email" class="form-control" required>
                                    </div>

                                    <div class="form-group position-relative pt-3">
                                        <label for="password"><i class="bi bi-lock-fill"></i> Password:</label>
                                        <div class="input-group">
                                            <input type="password" id="password" name="password" class="form-control" required>
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="text-center"> <!-- Centered the button -->
                                        <button type="submit" class="btn btn-primary mt-3"><i class="bi bi-box-arrow-in-right"></i> Login</button>
                                    </div>
                                </form>
                                <!-- Forgot Password -->
                                <div class="text-center mt-3">
                                    <a href="forgot_password.php"><i class="bi bi-question-circle-fill"></i> Forgot Password?</a>
                                </div>
                                <!-- Already have an account -->
                                <div class="text-center mt-2">
                                    <p class="mb-0">Don't have an account? <a href="membeship-category.php">Sign up</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <br>
        <br>
        <!-- End login Section -->
        <?php include "footer.php" ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const togglePassword = document.querySelector('.toggle-password');
                const password = document.querySelector('#password');

                togglePassword.addEventListener('click', function(e) {
                    // toggle the type attribute
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);

                    // toggle eye icon
                    const eyeIcon = document.querySelector('.bi-eye');
                    eyeIcon.classList.toggle('bi-eye');
                    eyeIcon.classList.toggle('bi-eye-slash');
                });
            });
        </script>
        <!-- ======= End login Section ======= -->
        <!-- End #main -->