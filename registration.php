<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Favicons -->
    <link href="assets/img/tapa.png" rel="icon">
    <link href="assets/img/tapa.png" rel="apple-touch-icon">

    <!-- Bootstrap CSS and Flatpickr CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<style>
/* Registration Section */
.registration {
    padding: 60px 0;
    background-color: #eee;
    font-family: 'Roboto', Sans-serif;
}

.registration h1 {
    font-size: 36px;
    font-weight: 700;
    text-align: center;
    margin-bottom: 40px;
    color: #0F718A;
}

.registration .form-control {
    border: #0c5b6d solid 1px;
    color: #000;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 18px;
    transition: background-color 0.3s;
}

.registration label {
    color: #0F718A;
    font-weight: 600;
}

.registration button[type="submit"] {
    color: #0F718A;
    border: solid #0F718A 2px;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
    width: 200px;
}

.registration button[type="submit"]:hover {
    background-color: #0c5b6d;
    color: #eee;
}

.form-control:hover {
    border: #0c5b6d solid 2px;
}

.registration .form-group {
    margin-bottom: 20px;
}

.registration a {
    color: #0F718A;
}

.registration a:hover {
    text-decoration: underline;
    color: #0c5b6d;
}

.error-message {
    color: red;
    font-size: 14px;
}
</style>

<body>
    <?php include "titleIcon.php"; ?>
    <?php include "header.php"; ?>

    <main>
        <!-- Breadcrumbs -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Membership registration</h2>
                    <ol>
                        <li><a href="index.php">Home</a></li>
                        <li>Membership registration</li>
                    </ol>
                </div>
            </div>
        </section>
        <!-- End Breadcrumbs -->

        <!-- Registration Section -->
        <section id="registration" class="registration">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="text-center"><i class="bi bi-person"></i> Membership Registration Form</h2>
                            </div>
                            <div class="card-body">
                                <form id="myForm" action="forms/register-script.php" method="post" role="form"
                                    enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="fullname"><i class="bi bi-person"></i> Full Name</label>
                                                <input type="text" name="fullname" class="form-control" id="fullname"
                                                    placeholder="Your full name" required>
                                                <small id="nameError" class="error-message"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="email"><i class="bi bi-envelope"></i> Email</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    placeholder="Your Email" required>
                                                <small id="emailError" class="error-message"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone"><i class="bi bi-telephone"></i> Phone</label>
                                                <input type="text" class="form-control" name="phone" id="phone"
                                                    placeholder="Your phone" required>
                                                <small id="phoneError" class="error-message"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="postal_address"><i class="bi bi-house-door"></i> Postal
                                                    Address</label>
                                                <input type="text" class="form-control" name="postal_address"
                                                    id="postal_address" placeholder="Postal address" required>
                                                <small id="postalAddressError" class="error-message"></small>
                                            </div>
                                            <div class="form-group">
                                                <label for="birth_date"><i class="bi bi-calendar"></i> Birth
                                                    date</label>
                                                <input type="text" class="form-control" name="birth_date"
                                                    id="birth_date" placeholder="Birthdate" required>
                                                <small id="birthDateError" class="error-message"></small>
                                            </div>

                                            <div class="form-group">
                                                <label for="cv"><i class="bi bi-file-earmark-pdf"></i> Upload your
                                                    CV</label>
                                                <input type="file" class="form-control" name="cv" id="cv"
                                                    placeholder="Upload your cv" accept=".pdf,.doc,.docx" required>
                                                <small id="cvError" class="error-message"></small>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Additional form fields here -->
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary accordion btn-block"
                                            data-toggle="modal" data-target="#termsModal">
                                            <i class="bi bi-file-earmark-text"></i> Read the terms and conditions
                                        </button>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="termsCheck"
                                            name="termsCheck" required>
                                        <label class="form-check-label" for="termsCheck">I agree to the terms and
                                            conditions</label>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-primary">Register</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Registration Section -->
    </main>

    <!-- JavaScript for real-time validation -->
    <script>
    document.getElementById("fullname").addEventListener("input", function() {
        var fullname = document.getElementById("fullname").value;
        var nameError = document.getElementById("nameError");
        if (fullname.length < 3) {
            nameError.textContent = "Full name must be at least 3 characters.";
        } else {
            nameError.textContent = "";
        }
    });

    document.getElementById("email").addEventListener("input", function() {
        var email = document.getElementById("email").value;
        var emailError = document.getElementById("emailError");
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            emailError.textContent = "Please enter a valid email address.";
        } else {
            emailError.textContent = "";
        }
    });

    document.getElementById("phone").addEventListener("input", function() {
        var phone = document.getElementById("phone").value;
        var phoneError = document.getElementById("phoneError");
        if (phone.length !== 10 || isNaN(phone)) {
            phoneError.textContent = "Phone number must be exactly 10 digits.";
        } else {
            phoneError.textContent = "";
        }
    });

    document.getElementById("postal_address").addEventListener("input", function() {
        var postalAddress = document.getElementById("postal_address").value;
        var postalAddressError = document.getElementById("postalAddressError");
        if (postalAddress.length < 5) {
            postalAddressError.textContent = "Postal address must be at least 5 characters.";
        } else {
            postalAddressError.textContent = "";
        }
    });

    document.getElementById("cv").addEventListener("change", function() {
        var cv = document.getElementById("cv").files[0];
        var cvError = document.getElementById("cvError");
        var allowedExtensions = /(\.pdf|\.doc|\.docx)$/i;
        if (!allowedExtensions.exec(cv.name)) {
            cvError.textContent = "Please upload a valid CV file (.pdf, .doc, .docx).";
        } else {
            cvError.textContent = "";
        }
    });
    </script>

    <!-- Bootstrap and jQuery JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>